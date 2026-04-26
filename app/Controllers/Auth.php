<?php

namespace App\Controllers;

use App\Models\UserModel;
use Google\Client as GoogleClient;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Auth extends BaseController
{
    protected $session;
    protected $userModel;
    protected $validation;
    
    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->validation = \Config\Services::validation();
        helper(['form', 'url', 'cookie']);
        $this->session = \Config\Services::session();
        
        // Start session if not already started
        if (session_status() == PHP_SESSION_NONE) {
            session()->start();
        }
    }
    
    // ==================== LOGIN METHODS ====================
    
    public function login()
    {
        if (session()->get('isLoggedIn')) {
            return redirect()->to('/dashboard');
        }
        
        $data = [
            'title' => 'Login',
            'googleAuthUrl' => $this->getGoogleAuthUrl()
        ];
        
        return view('auth/login', $data);
    }
    
    public function processLogin()
    {
        $rules = [
            'email' => 'required|valid_email',
            'password' => 'required|min_length[6]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $remember = $this->request->getPost('remember') == 'on';

        // 1. Cek user exist dulu
        $user = $this->userModel->where('email', $email)->first();

        if (!$user) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Email tidak ditemukan');
        }

        // 2. Cek verified
        if (!$user['is_verified']) {
            session()->set('temp_email', $email);
            return redirect()->to('/verify')
                ->with('warning', 'Silakan verifikasi email Anda terlebih dahulu');
        }

        // 3. Cek active
        if (isset($user['is_active']) && !$user['is_active']) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Akun Anda telah dinonaktifkan');
        }

        // 4. Verifikasi password — BARU boleh lanjut
        if (!password_verify($password, $user['password'])) {
            // Log failed attempt
            $this->userModel->logFailedAttempt($email);
            
            // Get failed attempt count
            $failedAttempts = $this->userModel->getFailedAttemptCount($email);
            
            // Lock account after 5 failed attempts
            if ($failedAttempts >= 5) {
                $this->userModel->lockAccount($email);
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Akun Anda telah terkunci karena terlalu banyak percobaan login gagal. Silakan hubungi admin.');
            }
            
            return redirect()->back()
                ->withInput()
                ->with('error', 'Password salah. Sisa percobaan: ' . (5 - $failedAttempts));
        }

        // 5. Update last login (TANPA update password!)
        $this->userModel->update($user['id'], [
            'last_login' => date('Y-m-d H:i:s'),
            'failed_attempts' => 0
        ]);

        // 6. Set session
        $this->setUserSession($user);

        if ($remember) {
            $this->setRememberMe($user['id']);
        }

        return redirect()->to('/dashboard');
    }
    
    // ==================== REGISTER METHODS ====================
    
    public function register()
    {
        if (session()->get('isLoggedIn')) {
            return redirect()->to('/dashboard');
        }
        
        $data['title'] = 'Register';
        return view('auth/register', $data);
    }
    
    public function processRegister()
    {
        $rules = [
            'full_name' => 'required|min_length[3]|max_length[100]',
            'email' => 'required|valid_email|is_unique[users.email]',
            'username' => 'required|min_length[3]|max_length[50]|is_unique[users.username]|alpha_numeric',
            'password' => 'required|min_length[6]|max_length[255]'
        ];
        
        if (!$this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }
        
        $verificationCode = $this->userModel->generateVerificationCode();
        
        $data = [
            'full_name' => $this->request->getPost('full_name'),
            'email' => $this->request->getPost('email'),
            'username' => $this->request->getPost('username'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'verification_code' => $verificationCode,
            'code_expiry' => date('Y-m-d H:i:s', strtotime('+30 minutes')),
            'is_verified' => false,
            'is_active' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        
        if ($this->userModel->insert($data)) {
            // Send verification email
            $this->sendVerificationEmail($data['email'], $verificationCode);
            
            // Store email temporarily
            session()->set('temp_email', $data['email']);
            
            return redirect()->to('/verify')
                ->with('success', 'Registrasi berhasil! Silakan cek email Anda untuk kode verifikasi');
        }
        
        return redirect()->back()
            ->withInput()
            ->with('error', 'Gagal mendaftar. Silakan coba lagi.');
    }
    
    // ==================== VERIFICATION METHODS ====================
    
    public function verify()
    {
        // Check if temp email exists
        if (!session()->get('temp_email')) {
            return redirect()->to('/login')->with('error', 'Silakan registrasi terlebih dahulu');
        }
        
        return view('auth/verify', ['title' => 'Verifikasi Email']);
    }
    
    public function processVerify()
    {
        $rules = [
            'code' => 'required|numeric|exact_length[6]'
        ];
        
        if (!$this->validate($rules)) {
            return redirect()->back()
                ->with('errors', $this->validator->getErrors());
        }
        
        $code = $this->request->getPost('code');
        $email = session()->get('temp_email');
        
        if (!$email) {
            return redirect()->to('/login')->with('error', 'Sesi verifikasi kadaluarsa');
        }
        
        $user = $this->userModel->verifyCode($email, $code);
        
        if ($user) {
            $this->userModel->update($user['id'], [
                'is_verified' => true,
                'verification_code' => null,
                'code_expiry' => null,
                'email_verified_at' => date('Y-m-d H:i:s')
            ]);
            
            session()->remove('temp_email');
            return redirect()->to('/login')
                ->with('success', 'Email berhasil diverifikasi! Silakan login.');
        }
        
        return redirect()->back()
            ->with('error', 'Kode verifikasi tidak valid atau sudah kadaluarsa');
    }
    
    public function resendCode()
    {
        $email = session()->get('temp_email');
        
        if (!$email) {
            return redirect()->to('/login')->with('error', 'Silakan registrasi terlebih dahulu');
        }
        
        $user = $this->userModel->where('email', $email)->first();
        
        if ($user && !$user['is_verified']) {
            $newCode = $this->userModel->generateVerificationCode();
            $this->userModel->update($user['id'], [
                'verification_code' => $newCode,
                'code_expiry' => date('Y-m-d H:i:s', strtotime('+30 minutes'))
            ]);
            
            $this->sendVerificationEmail($email, $newCode);
            return redirect()->back()
                ->with('success', 'Kode verifikasi baru telah dikirim ke email Anda');
        }
        
        return redirect()->back()
            ->with('error', 'Email tidak ditemukan atau sudah terverifikasi');
    }
    
    // ==================== FORGOT PASSWORD METHODS ====================
    
    public function forgotPassword()
    {
        return view('auth/forgot_password', ['title' => 'Lupa Password']);
    }
    
    public function processForgotPassword()
    {
        $rules = [
            'email' => 'required|valid_email'
        ];
        
        if (!$this->validate($rules)) {
            return redirect()->back()
                ->with('errors', $this->validator->getErrors());
        }
        
        $email = $this->request->getPost('email');
        $user = $this->userModel->where('email', $email)->first();
        
        if ($user && $user['is_verified']) {
            // Generate reset token
            $resetToken = bin2hex(random_bytes(32));
            $resetExpiry = date('Y-m-d H:i:s', strtotime('+1 hour'));
            
            $this->userModel->update($user['id'], [
                'reset_token' => $resetToken,
                'reset_expiry' => $resetExpiry
            ]);
            
            // Send reset email
            $this->sendResetPasswordEmail($email, $resetToken);
            
            return redirect()->to('/login')
                ->with('success', 'Link reset password telah dikirim ke email Anda');
        }
        
        // Don't reveal if email exists or not for security
        return redirect()->to('/login')
            ->with('success', 'Jika email terdaftar, link reset password akan dikirim');
    }
    
    public function resetPassword($token)
    {
        $user = $this->userModel
            ->where('reset_token', $token)
            ->where('reset_expiry >', date('Y-m-d H:i:s'))
            ->first();
        
        if (!$user) {
            return redirect()->to('/login')
                ->with('error', 'Token reset password tidak valid atau sudah kadaluarsa');
        }
        
        return view('auth/reset_password', [
            'title' => 'Reset Password',
            'token' => $token
        ]);
    }
    
    public function processResetPassword()
    {
        $rules = [
            'token' => 'required',
            'password' => 'required|min_length[6]',
            'confirm_password' => 'required|matches[password]'
        ];
        
        if (!$this->validate($rules)) {
            return redirect()->back()
                ->with('errors', $this->validator->getErrors());
        }
        
        $token = $this->request->getPost('token');
        $user = $this->userModel
            ->where('reset_token', $token)
            ->where('reset_expiry >', date('Y-m-d H:i:s'))
            ->first();
        
        if (!$user) {
            return redirect()->to('/login')
                ->with('error', 'Token reset password tidak valid atau sudah kadaluarsa');
        }
        
        // Update password
        $this->userModel->update($user['id'], [
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'reset_token' => null,
            'reset_expiry' => null
        ]);
        
        return redirect()->to('/login')
            ->with('success', 'Password berhasil direset! Silakan login dengan password baru Anda');
    }
    
    // ==================== GOOGLE AUTH METHODS ====================
    
    private function getGoogleAuthUrl()
    {
        try {
            $googleClient = new GoogleClient();
            $googleClient->setClientId(config('Google')->clientId);
            $googleClient->setClientSecret(config('Google')->clientSecret);
            $googleClient->setRedirectUri(config('Google')->redirectUri);
            $googleClient->addScope('email');
            $googleClient->addScope('profile');
            
            return $googleClient->createAuthUrl();
        } catch (\Exception $e) {
            log_message('error', 'Google Auth URL Error: ' . $e->getMessage());
            return '#';
        }
    }
    
    public function googleAuth()
    {
        $googleClient = new GoogleClient();
        $googleClient->setClientId(config('Google')->clientId);
        $googleClient->setClientSecret(config('Google')->clientSecret);
        $googleClient->setRedirectUri(config('Google')->redirectUri);
        
        if ($this->request->getGet('code')) {
            try {
                // Fetch token from Google
                $token = $googleClient->fetchAccessTokenWithAuthCode($this->request->getGet('code'));
                
                if (isset($token['error'])) {
                    log_message('error', 'Google Token Error: ' . json_encode($token));
                    return redirect()->to('/login')->with('error', 'Gagal autentikasi dengan Google');
                }
                
                $googleClient->setAccessToken($token);
                $googleService = new \Google\Service\Oauth2($googleClient);
                $googleUser = $googleService->userinfo->get();
                
                // Check if user already exists
                $user = $this->userModel->where('email', $googleUser->email)->first();
                
                if (!$user) {
                    // Create unique username
                    $username = explode('@', $googleUser->email)[0];
                    $originalUsername = $username;
                    $counter = 1;
                    
                    while ($this->userModel->where('username', $username)->first()) {
                        $username = $originalUsername . $counter;
                        $counter++;
                    }
                    
                    // Prepare user data
                    $userData = [
                        'email' => $googleUser->email,
                        'full_name' => $googleUser->name,
                        'google_id' => $googleUser->id,
                        'avatar' => $googleUser->picture,
                        'username' => $username,
                        'is_verified' => true,
                        'is_active' => 1,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    ];
                    
                    // Save to database
                    if (!$this->userModel->insert($userData)) {
                        $errors = $this->userModel->errors();
                        log_message('error', 'Insert error: ' . json_encode($errors));
                        return redirect()->to('/login')->with('error', 'Gagal menyimpan data: ' . implode(', ', $errors));
                    }
                    
                    // Get the newly created user
                    $user = $this->userModel->where('email', $googleUser->email)->first();
                    
                    if (!$user) {
                        return redirect()->to('/login')->with('error', 'User tidak ditemukan setelah disimpan');
                    }
                }
                
                // Check if user is active
                if (isset($user['is_active']) && !$user['is_active']) {
                    return redirect()->to('/login')->with('error', 'Akun Anda telah dinonaktifkan');
                }
                
                // Update last login
                $this->userModel->update($user['id'], [
                    'last_login' => date('Y-m-d H:i:s')
                ]);
                
                // Set session
                $this->setUserSession($user);
                
                return redirect()->to('/dashboard')->with('success', 'Selamat datang ' . $user['full_name']);
                
            } catch (\Exception $e) {
                log_message('error', 'Google Auth Exception: ' . $e->getMessage());
                log_message('error', 'Stack trace: ' . $e->getTraceAsString());
                return redirect()->to('/login')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
            }
        }
        
        return redirect()->to('/login');
    }
    
    // ==================== HELPER METHODS ====================
    
    private function setUserSession($user)
    {
        $sessionData = [
            'user_id' => $user['id'],
            'email' => $user['email'],
            'full_name' => $user['full_name'],
            'username' => $user['username'],
            'avatar' => $user['avatar'] ?? null,
            'isLoggedIn' => true,
            'login_time' => time()
        ];
        
        session()->set($sessionData);
        
        // Regenerate session ID for security
        session()->regenerate();
        
        log_message('debug', 'Session set for user: ' . $user['email']);
    }
    
    private function setRememberMe($userId)
    {
        $token = bin2hex(random_bytes(32));
        $expiry = time() + (86400 * 30); // 30 days
        
        // Store token in database
        $this->userModel->update($userId, [
            'remember_token' => password_hash($token, PASSWORD_DEFAULT),
            'remember_expiry' => date('Y-m-d H:i:s', $expiry)
        ]);
        
        // Set cookie
        setcookie('remember_token', $token, $expiry, '/', '', false, true);
        setcookie('user_id', $userId, $expiry, '/', '', false, true);
    }
    
    private function checkRememberMe()
    {
        if (isset($_COOKIE['remember_token']) && isset($_COOKIE['user_id'])) {
            $userId = $_COOKIE['user_id'];
            $token = $_COOKIE['remember_token'];
            
            $user = $this->userModel->find($userId);
            
            if ($user && password_verify($token, $user['remember_token']) && 
                strtotime($user['remember_expiry']) > time()) {
                $this->setUserSession($user);
                return true;
            }
        }
        return false;
    }
    
    // ==================== EMAIL METHODS ====================
    
    private function sendVerificationEmail($email, $code)
    {
        try {
            $mail = new PHPMailer(true);
            
            // Server settings
            $mail->isSMTP();
            $mail->Host       = getenv('SMTP_HOST') ?: 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = getenv('SMTP_USER') ?: 'adammarulyanto@gmail.com';
            $mail->Password   = getenv('SMTP_PASS') ?: '192Uitai-';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = getenv('SMTP_PORT') ?: 587;
            
            // Recipients
            $mail->setFrom(getenv('SMTP_FROM') ?: 'noreply@kliksampaisah.com', getenv('APP_NAME') ?: 'Klik Sampai Sah');
            $mail->addAddress($email);
            
            // Content
            $mail->isHTML(true);
            $mail->Subject = 'Verifikasi Email Anda';
            $mail->Body    = $this->getVerificationEmailTemplate($code);
            $mail->AltBody = "Kode verifikasi Anda: $code\n\nKode ini akan kadaluarsa dalam 30 menit.";
            
            $mail->send();
            log_message('info', "Verification email sent to: $email");
        } catch (\Exception $e) {
            log_message('error', "Email could not be sent. Error: {$mail->ErrorInfo}");
        }
    }
    
    private function sendResetPasswordEmail($email, $token)
    {
        try {
            $mail = new PHPMailer(true);
            
            $mail->isSMTP();
            $mail->Host       = getenv('SMTP_HOST') ?: 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = getenv('SMTP_USER') ?: 'adammarulyanto@gmail.com';
            $mail->Password   = getenv('SMTP_PASS') ?: '192Uitai-';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = getenv('SMTP_PORT') ?: 587;
            
            $mail->setFrom(getenv('SMTP_FROM') ?: 'noreply@yourapp.com', getenv('APP_NAME') ?: 'Your App');
            $mail->addAddress($email);
            
            $resetLink = base_url("reset-password/$token");
            
            $mail->isHTML(true);
            $mail->Subject = 'Reset Password Anda';
            $mail->Body    = $this->getResetPasswordEmailTemplate($resetLink);
            $mail->AltBody = "Reset password Anda: $resetLink\n\nLink ini akan kadaluarsa dalam 1 jam.";
            
            $mail->send();
            log_message('info', "Reset password email sent to: $email");
        } catch (\Exception $e) {
            log_message('error', "Reset email could not be sent. Error: {$mail->ErrorInfo}");
        }
    }
    
    private function getVerificationEmailTemplate($code)
    {
        return '
        <!DOCTYPE html>
        <html>
        <head>
            <style>
                body { font-family: Arial, sans-serif; }
                .container { max-width: 600px; margin: 0 auto; padding: 20px; }
                .code { font-size: 32px; font-weight: bold; color: #4CAF50; padding: 20px; text-align: center; }
                .footer { margin-top: 30px; font-size: 12px; color: #999; text-align: center; }
            </style>
        </head>
        <body>
            <div class="container">
                <h2>Verifikasi Email Anda</h2>
                <p>Terima kasih telah mendaftar. Gunakan kode verifikasi di bawah ini untuk mengaktifkan akun Anda:</p>
                <div class="code">' . $code . '</div>
                <p>Kode ini akan kadaluarsa dalam <strong>30 menit</strong>.</p>
                <p>Jika Anda tidak melakukan pendaftaran, abaikan email ini.</p>
                <div class="footer">
                    <p>&copy; ' . date('Y') . ' ' . getenv('APP_NAME') . '. All rights reserved.</p>
                </div>
            </div>
        </body>
        </html>
        ';
    }
    
    private function getResetPasswordEmailTemplate($resetLink)
    {
        return '
        <!DOCTYPE html>
        <html>
        <head>
            <style>
                body { font-family: Arial, sans-serif; }
                .container { max-width: 600px; margin: 0 auto; padding: 20px; }
                .button { display: inline-block; padding: 12px 24px; background-color: #4CAF50; color: white; text-decoration: none; border-radius: 4px; }
                .footer { margin-top: 30px; font-size: 12px; color: #999; text-align: center; }
            </style>
        </head>
        <body>
            <div class="container">
                <h2>Reset Password</h2>
                <p>Kami menerima permintaan untuk mereset password akun Anda. Klik tombol di bawah ini untuk melanjutkan:</p>
                <p style="text-align: center;">
                    <a href="' . $resetLink . '" class="button">Reset Password</a>
                </p>
                <p>Atau copy link ini ke browser Anda: <br>' . $resetLink . '</p>
                <p>Link ini akan kadaluarsa dalam <strong>1 jam</strong>.</p>
                <p>Jika Anda tidak meminta reset password, abaikan email ini.</p>
                <div class="footer">
                    <p>&copy; ' . date('Y') . ' ' . getenv('APP_NAME') . '. All rights reserved.</p>
                </div>
            </div>
        </body>
        </html>
        ';
    }
    
    // ==================== DASHBOARD & LOGOUT ====================
    
    public function dashboard()
    {
        if (!session()->get('isLoggedIn')) {
            // Check remember me
            if (!$this->checkRememberMe()) {
                return redirect()->to('/login');
            }
        }
        
        $data = [
            'title' => 'Dashboard',
            'user' => [
                'name' => session()->get('full_name'),
                'email' => session()->get('email'),
                'username' => session()->get('username'),
                'avatar' => session()->get('avatar')
            ]
        ];
        
        return view('dashboard', $data);
    }
    
    public function logout()
    {
        // Clear remember me cookies
        setcookie('remember_token', '', time() - 3600, '/');
        setcookie('user_id', '', time() - 3600, '/');
        
        // Clear session
        session()->destroy();
        
        return redirect()->to('/login')->with('success', 'Anda telah logout');
    }
}