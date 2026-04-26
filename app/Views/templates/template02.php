<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Undangan Pernikahan - Template 2</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Georgia', serif;
            background: #fef3e2;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }
        .hero {
            background: #d4a373;
            color: white;
            text-align: center;
            padding: 60px 20px;
        }
        .hero h1 {
            font-size: 48px;
            margin-bottom: 10px;
        }
        .content {
            padding: 40px;
        }
        .invitation-text {
            text-align: center;
            margin-bottom: 40px;
        }
        .couple {
            display: flex;
            justify-content: space-around;
            margin: 40px 0;
            text-align: center;
        }
        .guest {
            text-align: center;
            padding: 20px;
            background: #fef3e2;
            border-radius: 10px;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="hero">
            <h1>Wedding Invitation</h1>
            <p>Adam & Aulia</p>
        </div>
        
        <div class="content">
            <div class="invitation-text">
                <p>Dengan hormat,</p>
                <p>Kami mengundang Bapak/Ibu/Saudara/i untuk hadir di acara pernikahan kami</p>
            </div>
            
            <?php if (!empty($nama_tamu)): ?>
                <div class="guest">
                    <p>Kepada:</p>
                    <h3><?= esc($nama_tamu) ?></h3>
                </div>
            <?php endif; ?>
            
            <div class="couple">
                <div>
                    <h3>Adam Prasetyo</h3>
                    <p>Putra dari Bapak Bambang<br>dan Ibu Siti</p>
                </div>
                <div>
                    <h3>&</h3>
                </div>
                <div>
                    <h3>Aulia Rahman</h3>
                    <p>Putri dari Bapak Hendra<br>dan Ibu Dewi</p>
                </div>
            </div>
            
            <div style="text-align: center; margin-top: 40px;">
                <p>📅 Sabtu, 15 Januari 2025</p>
                <p>⏰ 10:00 WIB - Selesai</p>
                <p>📍 Ballroom Hotel Permata, Jakarta</p>
            </div>
        </div>
    </div>
</body>
</html>