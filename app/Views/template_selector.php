<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Template Selector - Realtime Change</title>
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f0f2f5;
        }
        
        .container {
            display: flex;
            min-height: 100vh;
        }
        
        /* Sidebar */
        .sidebar {
            width: 320px;
            background: #2c3e50;
            padding: 20px;
            color: white;
            overflow-y: auto;
        }
        
        .sidebar h3 {
            margin-bottom: 20px;
            text-align: center;
            border-bottom: 2px solid #3498db;
            padding-bottom: 10px;
        }
        
        /* Input group untuk realtime change */
        .input-group {
            background: #34495e;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        
        .input-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            font-size: 14px;
        }
        
        .input-group input {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            font-size: 14px;
            margin-bottom: 10px;
        }
        
        .input-group input:focus {
            outline: none;
            box-shadow: 0 0 5px #3498db;
        }
        
        .live-preview {
            font-size: 12px;
            color: #3498db;
            margin-top: 8px;
            font-style: italic;
        }
        
        .template-list {
            list-style: none;
            margin-top: 20px;
        }
        
        .template-item {
            margin-bottom: 10px;
        }
        
        .btn-template {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 14px;
            font-weight: bold;
            transition: all 0.3s;
            text-align: left;
            background: #34495e;
            color: white;
        }
        
        .btn-template:hover {
            transform: translateX(5px);
            background: #3498db;
        }
        
        .btn-template.active {
            background: #3498db;
            border-left: 3px solid #f1c40f;
        }
        
        /* Area kanan */
        .content-area {
            flex: 1;
            padding: 20px;
            background: #ecf0f1;
        }
        
        .info-bar {
            background: white;
            padding: 10px 15px;
            margin-bottom: 15px;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            font-size: 14px;
        }
        
        .template-frame {
            width: 100%;
            height: 80vh;
            border: none;
            border-radius: 10px;
            background: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Sidebar Kiri -->
        <div class="sidebar">
            <h3>📁 Template Manager</h3>
            
            <!-- Input untuk realtime change -->
            <div class="input-group">
                <label>✏️ Real-time Text Input:</label>
                <input 
                    type="text" 
                    id="liveInput" 
                    placeholder="Ketik sesuatu..."
                    autocomplete="off"
                >
                <div class="live-preview" id="previewText">
                    Preview akan muncul di template
                </div>
            </div>
            
            <!-- Daftar template -->
            <div class="input-group">
                <label>📄 Pilih Template:</label>
                <ul class="template-list" id="templateList">
                    <?php if (!empty($templates)): ?>
                        <?php foreach ($templates as $template): ?>
                            <li class="template-item">
                                <button 
                                    class="btn-template" 
                                    data-filename="<?= esc($template['file_path']) ?>"
                                    data-id="<?= $template['id'] ?>"
                                    data-name="<?= esc($template['template_name']) ?>"
                                >
                                    <?= esc($template['template_name']) ?>
                                    <small style="display: block; font-size: 10px; color: #bdc3c7;">
                                        <?= esc($template->description ?? 'No description') ?>
                                    </small>
                                </button>
                            </li>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <li>Tidak ada template tersedia</li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>

        <!-- Area Kanan: Iframe -->
        <div class="content-area">
            <div class="info-bar" id="infoBar">
                💡 Pilih template dan ketik sesuatu di sebelah kiri untuk realtime update
            </div>
            <iframe id="templateFrame" class="template-frame" src="about:blank"></iframe>
        </div>
    </div>

    <script>
        const buttons = document.querySelectorAll('.btn-template');
        const iframe = document.getElementById('templateFrame');
        const infoBar = document.getElementById('infoBar');
        const liveInput = document.getElementById('liveInput');
        const previewText = document.getElementById('previewText');
        
        const baseUrl = '<?= base_url() ?>';
        let currentTemplate = null;
        let iframeReady = false;
        
        // Fungsi untuk load template ke iframe
        function loadTemplate(filename, templateName) {
            currentTemplate = { filename, templateName };
            
            infoBar.innerHTML = `⏳ Loading template: <strong>${templateName}</strong> (${filename}) ...`;
            
            const templateUrl = `${baseUrl}/cek-template/load/${filename}`;
            iframe.src = templateUrl;
            
            // Reset iframe ready state
            iframeReady = false;
            
            // Tunggu iframe selesai loading
            iframe.onload = function() {
                infoBar.innerHTML = `✅ Active template: <strong>${templateName}</strong> | File: ${filename}`;
                
                // Tandai iframe sudah siap
                iframeReady = true;
                
                // Kirim nilai input saat ini ke iframe
                sendMessageToIframe();
            };
            
            // Update active state
            buttons.forEach(btn => {
                btn.classList.remove('active');
                if (btn.getAttribute('data-filename') === filename) {
                    btn.classList.add('active');
                }
            });
        }
        
        // Fungsi untuk mengirim pesan ke iframe
        function sendMessageToIframe() {
            if (!iframeReady || !iframe.contentWindow) {
                return;
            }
            
            const message = {
                type: 'updateText',
                value: liveInput.value,
                timestamp: new Date().toISOString()
            };
            
            try {
                iframe.contentWindow.postMessage(message, '*');
                previewText.innerHTML = `📤 Mengirim: "${liveInput.value || '(kosong)'}"`;
            } catch (error) {
                console.error('Error sending message:', error);
            }
        }
        
        // Event listener untuk input text (realtime)
        liveInput.addEventListener('input', function() {
            const preview = this.value || '(kosong)';
            previewText.innerHTML = `📤 Mengirim: "${preview}" - realtime`;
            
            // Kirim pesan ke iframe setiap kali ada perubahan
            sendMessageToIframe();
        });
        
        // Event listener untuk tombol template
        buttons.forEach(button => {
            button.addEventListener('click', function() {
                const filename = this.getAttribute('data-filename');
                const templateName = this.getAttribute('data-name');
                loadTemplate(filename, templateName);
            });
        });
        
        // Optional: Load template pertama otomatis
        <?php if (!empty($templates)): ?>
        // loadTemplate('<?= $templates[0]['file_path'] ?>', '<?= esc($templates[0]['template_name'], 'js') ?>');
        <?php endif; ?>
    </script>
</body>
</html>