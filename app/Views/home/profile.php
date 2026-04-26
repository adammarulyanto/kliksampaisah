<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?> - Aplikasi CI4</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f4f4f4;
        }
        
        .navbar {
            background: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .logo {
            font-size: 1.5rem;
            font-weight: bold;
            color: #667eea;
        }
        
        .nav-links a {
            margin-left: 1.5rem;
            text-decoration: none;
            color: #333;
        }
        
        .nav-links a:hover {
            color: #667eea;
        }
        
        .container {
            max-width: 800px;
            margin: 2rem auto;
            padding: 0 2rem;
        }
        
        .profile-card {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .profile-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 2rem;
            text-align: center;
            color: white;
        }
        
        .profile-avatar {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            border: 4px solid white;
            margin-bottom: 1rem;
            object-fit: cover;
        }
        
        .profile-body {
            padding: 2rem;
        }
        
        .info-group {
            margin-bottom: 1.5rem;
        }
        
        .info-label {
            font-weight: bold;
            color: #666;
            margin-bottom: 0.25rem;
        }
        
        .info-value {
            font-size: 1.1rem;
            color: #333;
            padding: 0.5rem;
            background: #f8f9fa;
            border-radius: 5px;
        }
        
        .btn-back {
            display: inline-block;
            background: #667eea;
            color: white;
            padding: 0.75rem 1.5rem;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 1rem;
        }
        
        .btn-back:hover {
            background: #5a67d8;
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="logo">Aplikasi CI4</div>
        <div class="nav-links">
            <a href="/dashboard">Dashboard</a>
            <a href="/profile">Profile</a>
            <a href="/logout">Logout</a>
        </div>
    </nav>
    
    <div class="container">
        <div class="profile-card">
            <div class="profile-header">
                <?php if ($user['avatar']): ?>
                    <img src="<?= $user['avatar'] ?>" alt="Avatar" class="profile-avatar">
                <?php else: ?>
                    <div class="profile-avatar" style="background: white; display: flex; align-items: center; justify-content: center; color: #667eea; font-size: 3rem;">
                        <?= strtoupper(substr($user['full_name'], 0, 1)) ?>
                    </div>
                <?php endif; ?>
                <h2><?= $user['full_name'] ?></h2>
                <p><?= $user['email'] ?></p>
            </div>
            
            <div class="profile-body">
                <div class="info-group">
                    <div class="info-label">Username</div>
                    <div class="info-value"><?= $user['username'] ?></div>
                </div>
                
                <div class="info-group">
                    <div class="info-label">Email</div>
                    <div class="info-value"><?= $user['email'] ?></div>
                </div>
                
                <div class="info-group">
                    <div class="info-label">Status Verifikasi</div>
                    <div class="info-value">
                        <?= $user['is_verified'] ? '✓ Terverifikasi' : '✗ Belum diverifikasi' ?>
                    </div>
                </div>
                
                <div class="info-group">
                    <div class="info-label">Login Method</div>
                    <div class="info-value">
                        <?= $user['google_id'] ? 'Google SSO' : 'Email/Password' ?>
                    </div>
                </div>
                
                <div class="info-group">
                    <div class="info-label">Member Since</div>
                    <div class="info-value">
                        <?= date('d F Y H:i', strtotime($user['created_at'])) ?>
                    </div>
                </div>
                
                <a href="/dashboard" class="btn-back">← Kembali ke Dashboard</a>
            </div>
        </div>
    </div>
</body>
</html>