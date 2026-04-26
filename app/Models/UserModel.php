<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'email', 'password', 'username', 'full_name', 
        'google_id', 'avatar', 'is_verified', 
        'verification_code', 'code_expiry','last_login','failed_attempts','is_active'
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $skipValidation = true; // Temporarily disable validation for debugging
    
    protected $validationRules = [
        'email' => 'required|valid_email|is_unique[users.email]',
        'password' => 'required|min_length[6]',
        'username' => 'required|min_length[3]|is_unique[users.username]'
    ];
    
    public function generateVerificationCode()
    {
        return sprintf("%06d", mt_rand(1, 999999));
    }
    
    public function verifyCode($email, $code)
    {
        return $this->where('email', $email)
                    ->where('verification_code', $code)
                    ->where('code_expiry >', date('Y-m-d H:i:s'))
                    ->first();
    }

    protected $validationMessages = [
        'email' => [
            'required' => 'Email wajib diisi',
            'valid_email' => 'Format email tidak valid',
            'is_unique' => 'Email sudah terdaftar',
        ],
        'password' => [
            'required' => 'Password wajib diisi',
            'min_length' => 'Password minimal 6 karakter',
        ],
    ];

    protected $beforeInsert = ['hashPassword'];
    protected $beforeUpdate = ['hashPassword'];

    protected function hashPassword(array $data)
    {
        if (isset($data['data']['password'])) {
            $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
        }
        return $data;
    }

    public function verifyPassword($plainPassword, $hashedPassword)
    {
        return password_verify($plainPassword, $hashedPassword);
    }

    public function logFailedAttempt($email) {
        // Increment failed attempts counter
        $this->db->table('users')
            ->set('failed_attempts', 'failed_attempts + 1', false)
            ->set('last_failed', 'NOW()', false)
            ->where('email', $email)
            ->update();
    }

    public function getFailedAttemptCount($email) {
        $result = $this->db->table('users')
            ->select('failed_attempts')
            ->where('email', $email)
            ->get()
            ->getRow();
        
        return $result ? $result->failed_attempts : 0;
    }

    public function lockAccount($email) {
        $this->db->table('users')
            ->set('is_active', 0)
            ->set('last_inactive', 'NOW()', false)
            ->where('email', $email)
            ->update();
    }
}