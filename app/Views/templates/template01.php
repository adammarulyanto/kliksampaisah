<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Undangan Pernikahan - Template 1</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .invitation-card {
            background: white;
            border-radius: 20px;
            padding: 40px;
            max-width: 600px;
            margin: 20px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
            text-align: center;
        }
        .title {
            color: #764ba2;
            font-size: 32px;
            margin-bottom: 10px;
        }
        .couple-name {
            font-size: 48px;
            color: #667eea;
            margin: 20px 0;
        }
        .message {
            font-size: 18px;
            color: #666;
            line-height: 1.6;
            margin: 30px 0;
        }
        .guest-name {
            font-size: 24px;
            color: #764ba2;
            font-weight: bold;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <div class="invitation-card">
        <h1 class="title">The Wedding of</h1>
        <div class="couple-name">
            Adam & <div id="bride-name">Wanita</div>
        </div>
        
        <?php if (!empty($nama_tamu)): ?>
            <div class="guest-name">
                Kepada Yth. <?= esc($nama_tamu) ?>
            </div>
        <?php endif; ?>
        
        <div class="message">
            Dengan penuh rasa syukur, kami mengundang Anda<br>
            untuk hadir dalam acara pernikahan kami.
        </div>
        
        <div class="message">
            📍 Lokasi: Gedung Serbaguna<br>
            📅 Tanggal: 15 Januari 2025<br>
            ⏰ Waktu: 10:00 WIB
        </div>
    </div>
</body>
</html>

<script>
    // Mendengarkan pesan dari parent (template_selector)
    window.addEventListener('message', function(event) {
        // Cek tipe pesan
        if (event.data.type === 'updateText') {
            const textValue = event.data.value || 'BrideName';
            const timestamp = event.data.timestamp;
            
            // Update div dengan id "bride-name"
            const fNameDiv = document.getElementById('bride-name');
            const timestampDiv = document.getElementById('timestamp');
            
            if (fNameDiv) {
                // Update teks
                fNameDiv.innerHTML = textValue;
                
                // Tambahkan animasi
                fNameDiv.classList.add('updated');
                setTimeout(() => {
                    fNameDiv.classList.remove('updated');
                }, 300);
            }
            
            if (timestampDiv) {
                const date = new Date(timestamp);
                timestampDiv.innerHTML = `Terakhir update: ${date.toLocaleTimeString()}`;
            }
            
            console.log('Received message:', event.data);
        }
    });
    
    // Beri tahu parent bahwa iframe sudah siap
    window.parent.postMessage({ type: 'iframeReady' }, '*');
</script>