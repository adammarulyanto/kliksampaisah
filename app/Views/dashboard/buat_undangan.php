<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Buat Undangan — Invita</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400;1,700&family=DM+Sans:wght@300;400;500;600&family=Cormorant+Garamond:ital,wght@0,400;0,600;1,400;1,600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="<?=base_url()?>assets/css/style.css" />
  <link rel="stylesheet" href="<?=base_url()?>assets/css/buat-undangan.css" />
</head>
<style>      
        .template-frame {
            width: 100%;
            height: 100%;
            border: none;
            border-radius: 10px;
            background: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
</style>
<body>

<!-- ── Top Bar ─────────────────────────────────────── -->
<header class="bu-topbar">
  <a href="<?=base_url('dashboard')?>" class="bu-back-btn">
    <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
      <path d="M10 3L5 8l5 5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
    </svg>
    Kembali ke Dashboard
  </a>

  <div class="bu-topbar-center">
    <span class="bu-topbar-logo">Klik<span>Sampai</span>Sah</span>
    <span class="bu-topbar-sep">·</span>
    <span class="bu-topbar-title">Buat Undangan Baru</span>
  </div>

  <div class="bu-topbar-actions">
    <button class="bu-btn-save" id="btnSaveDraft">Simpan Draft</button>
    <button class="bu-btn-publish" id="btnPublish">Beli & Simpan ✦</button>
  </div>
</header>

<!-- ── Main Split Layout ───────────────────────────── -->
<div class="bu-layout">

  <!-- ════════════════════════════════════
       LEFT PANEL — Template + Form
  ════════════════════════════════════ -->
  <div class="bu-left" id="buLeft">

    <!-- ── Progress Header ── -->
    <div class="wz-header">
      <div class="wz-progress-bar">
        <div class="wz-progress-fill" id="wzProgressFill" style="width:0%"></div>
      </div>
      <div class="wz-steps" id="wzSteps">

        <div class="wz-step active" data-step="0">
          <div class="wz-step-num"><span>1</span></div>
          <span class="wz-step-label">Template</span>
        </div>
        <div class="wz-sep"></div>

        <div class="wz-step" data-step="1">
          <div class="wz-step-num"><span>2</span></div>
          <span class="wz-step-label">Undangan</span>
        </div>
        <div class="wz-sep"></div>

        <div class="wz-step" data-step="2">
          <div class="wz-step-num"><span>3</span></div>
          <span class="wz-step-label">Pasangan</span>
        </div>
        <div class="wz-sep"></div>

        <div class="wz-step" data-step="3">
          <div class="wz-step-num"><span>4</span></div>
          <span class="wz-step-label">Acara</span>
        </div>
        <div class="wz-sep"></div>

        <div class="wz-step" data-step="4">
          <div class="wz-step-num"><span>5</span></div>
          <span class="wz-step-label">Cerita</span>
        </div>
        <div class="wz-sep"></div>

        <div class="wz-step" data-step="5">
          <div class="wz-step-num"><span>6</span></div>
          <span class="wz-step-label">Media</span>
        </div>

      </div>
    </div>

    <!-- ── Pages Container ── -->
    <div class="wz-pages" id="wzPages">

      <!-- PAGE 0 — Template -->
      <div class="wz-page active" data-page="0">
        <div class="wz-page-title">Pilih Template</div>
        <div class="wz-page-desc">Template menentukan tampilan dan nuansa undanganmu</div>

        <div class="tpl-picker" id="tplPicker">
          <?php foreach ($templates as $index => $template): ?>
            <label class="tpl-pick-item"
              data-tpl="<?=$template['id']?>"
              data-filename="<?= esc($template['file_path']) ?>"
              data-id="<?= $template['id'] ?>"
              data-name="<?= esc($template['template_name']) ?>">
              <input type="radio" name="template" value="floral" hidden />
              <div class="tpl-pick-thumb tpt-floral">
                <div class="tpt-mini">
                  <div style="height:2px;width:20px;background:var(--orange);margin:0 auto 4px;border-radius:2px;"></div>
                  <div style="font-family:'Playfair Display',serif;font-size:7px;font-style:italic;color:var(--orange);">A & B</div>
                </div>
              </div>
              <div class="tpl-pick-info">
                <span class="tpl-pick-name"><?=$template['template_name']?></span>
                <span class="tpl-pick-price free-p">Rp. <?=number_format($template['price'], 0, ',', '.')?></span>
              </div>
              <div class="tpl-pick-check">✓</div>
            </label>
          <?php endforeach; ?>
        </div>
      </div>

      <!-- PAGE 1 — Data Undangan -->
      <div class="wz-page" data-page="1">
        <div class="wz-page-title">Data Undangan</div>
        <div class="wz-page-desc">Informasi dasar identitas undangan</div>

        <div class="bu-form-grid">
          <div class="bu-field bu-field-full">
            <label>URL Name</label>
            <input type="text" id="urlName" placeholder="cth. rizal-ayu-2025" />
          </div>
          <div class="bu-field bu-field-full">
            <label>Judul Undangan</label>
            <input type="text" id="judulUndangan" placeholder="cth. Pernikahan Rizal & Ayu" />
          </div>
          <div class="bu-field bu-field-full">
            <label>Keterangan</label>
            <textarea id="keterangan" rows="3" placeholder="cth. Dengan penuh syukur kami mengumumkan..."></textarea>
          </div>
        </div>
      </div>

      <!-- PAGE 2 — Data Pasangan -->
      <div class="wz-page" data-page="2">
        <div class="wz-page-title">Data Pasangan</div>
        <div class="wz-page-desc">Nama yang akan tampil di undangan</div>

        <div class="bu-form-grid">
          <div class="bu-field bu-field-full">
            <label>Nama Panggilan Pria</label>
            <input type="text" id="groomNickname" placeholder="cth. Rizal" />
          </div>
          <div class="bu-field bu-field-full">
            <label>Nama Panggilan Wanita</label>
            <input type="text" id="brideNickname" placeholder="cth. Ayu" />
          </div>
          <div class="bu-field">
            <label>Nama Pengantin Pria <span class="req">*</span></label>
            <input type="text" id="groomName" placeholder="cth. Muhammad Rizal" />
          </div>
          <div class="bu-field">
            <label>Nama Pengantin Wanita <span class="req">*</span></label>
            <input type="text" id="brideName" placeholder="cth. Ayu Wijaya" />
          </div>
          <div class="bu-field">
            <label>Nama Ayah Pengantin Pria</label>
            <input type="text" id="groomFather" placeholder="cth. Bpk. Ahmad Santoso" />
          </div>
          <div class="bu-field">
            <label>Nama Ibu Pengantin Pria</label>
            <input type="text" id="groomMother" placeholder="cth. Ibu Siti Rahayu" />
          </div>
          <div class="bu-field">
            <label>Nama Ayah Pengantin Wanita</label>
            <input type="text" id="brideFather" placeholder="cth. Bpk. Hendra Kusuma" />
          </div>
          <div class="bu-field">
            <label>Nama Ibu Pengantin Wanita</label>
            <input type="text" id="brideMother" placeholder="cth. Ibu Dewi Lestari" />
          </div>
        </div>
      </div>

      <!-- PAGE 3 — Detail Acara -->
      <div class="wz-page" data-page="3">
        <div class="wz-page-title">Detail Acara</div>
        <div class="wz-page-desc">Informasi waktu dan tempat acara</div>

        <!-- Akad -->
        <div class="bu-event-block">
          <div class="bu-event-label">
            <span class="bu-event-dot"></span>
            Akad Nikah
          </div>
          <div class="bu-form-grid">
            <div class="bu-field">
              <label>Tanggal Akad <span class="req">*</span></label>
              <input type="date" id="akadDate" />
            </div>
            <div class="bu-field">
              <label>Hari</label>
              <input type="text" id="akadDay" placeholder="cth. Sabtu" readonly />
            </div>
            <div class="bu-field">
              <label>Waktu Mulai</label>
              <input type="time" id="akadTimeStart" value="09:00" />
            </div>
            <div class="bu-field">
              <label>Waktu Selesai</label>
              <input type="time" id="akadTimeEnd" value="11:00" />
            </div>
            <div class="bu-field bu-field-full">
              <label>Nama Gedung / Tempat Akad <span class="req">*</span></label>
              <input type="text" id="akadVenue" placeholder="cth. Masjid Al-Ikhlas" />
            </div>
            <div class="bu-field bu-field-full">
              <label>Alamat Lengkap Akad</label>
              <textarea id="akadAddress" rows="2" placeholder="cth. Jl. Sudirman No. 10, Jakarta Selatan"></textarea>
            </div>
            <div class="bu-field bu-field-full">
              <label>Link Google Maps Akad</label>
              <input type="url" id="akadMaps" placeholder="https://maps.google.com/..." />
            </div>
          </div>
        </div>

        <!-- Resepsi -->
        <div class="bu-event-block">
          <div class="bu-event-label">
            <span class="bu-event-dot" style="background:var(--coral);"></span>
            Resepsi
          </div>
          <div class="bu-field bu-field-full" style="margin-bottom:14px;">
            <label class="bu-checkbox-label">
              <input type="checkbox" id="sameVenue" />
              <span class="bu-checkmark"></span>
              Tempat resepsi sama dengan akad
            </label>
          </div>
          <div class="bu-form-grid" id="resepsiFields">
            <div class="bu-field">
              <label>Tanggal Resepsi <span class="req">*</span></label>
              <input type="date" id="resepsiDate" />
            </div>
            <div class="bu-field">
              <label>Hari</label>
              <input type="text" id="resepsiDay" placeholder="cth. Sabtu" readonly />
            </div>
            <div class="bu-field">
              <label>Waktu Mulai</label>
              <input type="time" id="resepsiTimeStart" value="11:00" />
            </div>
            <div class="bu-field">
              <label>Waktu Selesai</label>
              <input type="time" id="resepsiTimeEnd" value="14:00" />
            </div>
            <div class="bu-field bu-field-full">
              <label>Nama Gedung / Tempat Resepsi</label>
              <input type="text" id="resepsiVenue" placeholder="cth. Gedung Harmoni Ballroom" />
            </div>
            <div class="bu-field bu-field-full">
              <label>Alamat Lengkap Resepsi</label>
              <textarea id="resepsiAddress" rows="2" placeholder="cth. Jl. Gatot Subroto No. 5, Jakarta Selatan"></textarea>
            </div>
            <div class="bu-field bu-field-full">
              <label>Link Google Maps Resepsi</label>
              <input type="url" id="resepsiMaps" placeholder="https://maps.google.com/..." />
            </div>
          </div>
        </div>
      </div>

      <!-- PAGE 4 — Cerita & Ucapan -->
      <div class="wz-page" data-page="4">
        <div class="wz-page-title">Cerita & Ucapan</div>
        <div class="wz-page-desc">Sentuhan personal untuk undanganmu</div>

        <div class="bu-form-grid">
          <div class="bu-field bu-field-full">
            <label>Kutipan / Ayat Pembuka</label>
            <textarea id="quoteText" rows="4" placeholder="cth. "Dan di antara tanda-tanda kekuasaan-Nya ialah Dia menciptakan untukmu istri-istri dari jenismu sendiri..." (QS. Ar-Rum: 21)"></textarea>
          </div>
          <div class="bu-field bu-field-full">
            <label>Kata Sambutan dari Pasangan</label>
            <textarea id="loveStory" rows="5" placeholder="cth. Dengan penuh rasa syukur dan kebahagiaan, kami mengundang Bapak/Ibu/Saudara/i untuk hadir di hari istimewa kami..."></textarea>
          </div>
        </div>
      </div>

      <!-- PAGE 5 — Foto & Media -->
      <div class="wz-page" data-page="5">
        <div class="wz-page-title">Foto & Media</div>
        <div class="wz-page-desc">Foto prewedding dan lagu latar</div>

        <div class="bu-form-grid">
          <div class="bu-field bu-field-full">
            <label>Foto Utama (Cover)</label>
            <div class="bu-upload-zone" id="uploadCover">
              <div class="bu-upload-icon">🖼</div>
              <div class="bu-upload-text">Klik atau drag foto di sini</div>
              <div class="bu-upload-sub">JPG, PNG — maks. 5MB</div>
            </div>
          </div>
          <div class="bu-field bu-field-full">
            <label>Musik Latar (Opsional)</label>
            <div class="bu-music-field">
              <select id="musicChoice">
                <option value="">— Tanpa Musik —</option>
                <option value="canon">Canon in D — Pachelbel</option>
                <option value="perfect">Perfect — Ed Sheeran (Piano)</option>
                <option value="thousand">A Thousand Years — Piano</option>
                <option value="symphony">Symphony — Clean Bandit</option>
                <option value="custom">Upload musik sendiri...</option>
              </select>
            </div>
          </div>
        </div>

        <!-- Summary card di step terakhir -->
        <div style="margin-top:28px;padding:18px 20px;background:#fdf9f5;border:1px solid #f0e8df;border-radius:10px;">
          <div style="font-family:'Playfair Display',serif;font-size:14px;font-weight:600;color:#2c1f14;margin-bottom:12px;">✦ Ringkasan Undangan</div>
          <div id="wzSummary" style="font-size:13px;color:#6b5e52;font-family:'DM Sans',sans-serif;line-height:1.7;"></div>
        </div>
      </div>

    </div><!-- end wz-pages -->

    <!-- ── Footer Nav ── -->
    <div class="wz-footer">
      <div style="display:flex;align-items:center;gap:10px;">
        <div class="wz-dots" id="wzDots"></div>
        <div class="wz-info">Step <strong id="wzCurrentNum">1</strong> dari <strong>6</strong></div>
      </div>
      <div class="wz-nav-btns">
        <button class="wz-btn wz-btn-prev" id="wzBtnPrev" style="display:none;">
          ← Kembali
        </button>
        <button class="wz-btn wz-btn-next" id="wzBtnNext">
          Lanjut →
        </button>
      </div>
    </div>

  </div><!-- end bu-left -->

  <!-- ════════════════════════════════════
       RIGHT PANEL — Phone Mockup
  ════════════════════════════════════ -->
  <div class="bu-right">
    <div class="bu-right-sticky">

      <div class="bu-preview-label">
        <span class="bu-preview-dot"></span>
        Pratinjau Langsung
      </div>

      <!-- Phone mockup -->
      <div class="phone-mockup">
        <div class="phone-shell">
          <!-- Notch -->
          <div class="phone-notch">
            <div class="phone-camera"></div>
          </div>

          <!-- Screen -->
          <div class="phone-screen" id="phoneScreen">
              <iframe id="templateFrame" class="template-frame" src="about:blank"></iframe>
          </div><!-- end phone-screen -->

          <!-- Home bar -->
          <div class="phone-home-bar"></div>
        </div><!-- end phone-shell -->
      </div><!-- end phone-mockup -->

      <!-- Template name below phone -->
      <div class="bu-active-tpl" id="activeTplLabel">
        <span class="tpl-dot-floral"></span>
        Floral Romance
      </div>

    </div><!-- end bu-right-sticky -->
  </div><!-- end bu-right -->

</div><!-- end bu-layout -->

<script>
// ══════════════════════════════════════════════════════
//  HELPER FUNCTIONS
// ══════════════════════════════════════════════════════

const DAYS_ID = ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'];
const MONTHS_ID = ['Januari','Februari','Maret','April','Mei','Juni',
                   'Juli','Agustus','September','Oktober','November','Desember'];

function formatDate(dateStr) {
  if (!dateStr) return '';
  const d = new Date(dateStr + 'T00:00:00');
  return `${DAYS_ID[d.getDay()]}, ${d.getDate()} ${MONTHS_ID[d.getMonth()]} ${d.getFullYear()}`;
}

function formatDateShort(dateStr) {
  if (!dateStr) return '';
  const d = new Date(dateStr + 'T00:00:00');
  const dd = String(d.getDate()).padStart(2,'0');
  const mm = String(d.getMonth()+1).padStart(2,'0');
  return `${dd} · ${mm} · ${d.getFullYear()}`;
}

function getDay(dateStr) {
  if (!dateStr) return '';
  const d = new Date(dateStr + 'T00:00:00');
  return DAYS_ID[d.getDay()];
}

// ══════════════════════════════════════════════════════
//  TEMPLATE SWITCHER
// ══════════════════════════════════════════════════════

const tplItems = document.querySelectorAll('.tpl-pick-item');

function switchTemplate(tpl) {
  // Update picker selection
  tplItems.forEach(item => {
    item.classList.toggle('selected', item.dataset.tpl === tpl);
  });
}

tplItems.forEach(item => {
  item.addEventListener('click', () => switchTemplate(item.dataset.tpl));
});

// ══════════════════════════════════════════════════════
//  LIVE PREVIEW — update phone screen from form values
// ══════════════════════════════════════════════════════

function val(id) {
  const el = document.getElementById(id);
  return el ? el.value.trim() : '';
}

function set(id, text, fallback='') {
  const el = document.getElementById(id);
  if (el) el.textContent = text || fallback;
}

// ── Auto-fill "Hari" from date pickers ──
document.getElementById('akadDate').addEventListener('change', e => {
  document.getElementById('akadDay').value = getDay(e.target.value);
});
document.getElementById('resepsiDate').addEventListener('change', e => {
  document.getElementById('resepsiDay').value = getDay(e.target.value);
});

// ── Same venue checkbox ──
document.getElementById('sameVenue').addEventListener('change', function() {
  const fields = document.getElementById('resepsiFields');
  const inputs = fields.querySelectorAll('input:not([type=date]):not([type=time]), textarea');
  if (this.checked) {
    document.getElementById('resepsiDate').value  = document.getElementById('akadDate').value;
    document.getElementById('resepsiDay').value   = document.getElementById('akadDay').value;
    document.getElementById('resepsiVenue').value = document.getElementById('akadVenue').value;
    document.getElementById('resepsiAddress').value = document.getElementById('akadAddress').value;
    document.getElementById('resepsiMaps').value  = document.getElementById('akadMaps').value;
    inputs.forEach(i => i.setAttribute('readonly',''));
  } else {
    inputs.forEach(i => i.removeAttribute('readonly'));
  }
});

// ══════════════════════════════════════════════════════
//  UPLOAD ZONE (visual only)
// ══════════════════════════════════════════════════════
const uploadZone = document.getElementById('uploadCover');
uploadZone.addEventListener('click', () => {
  const inp = document.createElement('input');
  inp.type = 'file';
  inp.accept = 'image/*';
  inp.onchange = e => {
    const file = e.target.files[0];
    if (!file) return;
    const reader = new FileReader();
    reader.onload = ev => {
      uploadZone.style.background = `url(${ev.target.result}) center/cover`;
      uploadZone.innerHTML = `<div style="background:rgba(0,0,0,0.45);border-radius:10px;padding:8px 14px;color:white;font-size:12px;font-weight:600;">✓ ${file.name}</div>`;
    };
    reader.readAsDataURL(file);
  };
  inp.click();
});

uploadZone.addEventListener('dragover', e => { e.preventDefault(); uploadZone.classList.add('drag-over'); });
uploadZone.addEventListener('dragleave', () => uploadZone.classList.remove('drag-over'));
uploadZone.addEventListener('drop', e => {
  e.preventDefault();
  uploadZone.classList.remove('drag-over');
  const file = e.dataTransfer.files[0];
  if (!file || !file.type.startsWith('image/')) return;
  const reader = new FileReader();
  reader.onload = ev => {
    uploadZone.style.background = `url(${ev.target.result}) center/cover`;
    uploadZone.innerHTML = `<div style="background:rgba(0,0,0,0.45);border-radius:10px;padding:8px 14px;color:white;font-size:12px;font-weight:600;">✓ ${file.name}</div>`;
  };
  reader.readAsDataURL(file);
});

// ══════════════════════════════════════════════════════
//  SAVE / PUBLISH BUTTONS
// ══════════════════════════════════════════════════════
document.getElementById('btnSaveDraft').addEventListener('click', () => {
  const btn = document.getElementById('btnSaveDraft');
  btn.textContent = '✓ Tersimpan';
  btn.style.color = '#3aab6d';
  setTimeout(() => { btn.textContent = 'Simpan Draft'; btn.style.color = ''; }, 2000);
});

</script>

<script>
    const iframe = document.getElementById('templateFrame');
    const baseUrl = '<?= base_url() ?>';
    let iframeReady = false;

    // ── Semua field ID yang akan dikirim ke iframe ──
    const FIELD_IDS = [
        'groomName', 'brideName', 'groomNickname', 'brideNickname',
        'groomFather', 'groomMother', 'brideFather', 'brideMother',
        'akadDate', 'akadDay', 'akadTimeStart', 'akadTimeEnd',
        'akadVenue', 'akadAddress', 'akadMaps',
        'resepsiDate', 'resepsiDay', 'resepsiTimeStart', 'resepsiTimeEnd',
        'resepsiVenue', 'resepsiAddress', 'resepsiMaps',
        'quoteText', 'loveStory', 'musicChoice'
    ];

    // ── Kumpulkan semua nilai field saat ini ──
    function collectFormData() {
        const data = {};
        FIELD_IDS.forEach(id => {
            const el = document.getElementById(id);
            if (el) data[id] = el.value;
        });
        return data;
    }

    // ── Kirim semua data ke iframe ──
    function sendMessageToIframe() {
        if (!iframeReady || !iframe.contentWindow) return;

        const message = {
            type: 'updateForm',
            data: collectFormData(),
            timestamp: new Date().toISOString()
        };

        try {
            iframe.contentWindow.postMessage(message, '*');
        } catch (error) {
            console.error('Error sending message to iframe:', error);
        }
    }

    // ── Load template ke iframe ──
    function loadTemplate(filename, templateName) {
        iframeReady = false;

        const templateUrl = `${baseUrl}/cek-template/load/${filename}`;
        iframe.src = templateUrl;

        iframe.onload = function () {
            iframeReady = true;
            sendMessageToIframe(); // langsung kirim data yang sudah ada
        };

        // Update label di bawah phone mockup
        const label = document.getElementById('activeTplLabel');
        if (label) label.innerHTML = `<span class="tpl-dot-floral"></span> ${templateName}`;
    }

    // ── Pasang event listener ke semua field ──
    FIELD_IDS.forEach(id => {
        const el = document.getElementById(id);
        if (!el) return;

        const eventType = (el.tagName === 'SELECT' || el.type === 'date' || el.type === 'time' || el.type === 'checkbox')
            ? 'change'
            : 'input';

        el.addEventListener(eventType, sendMessageToIframe);
    });

    // ── Klik template → load ──
    document.querySelectorAll('.tpl-pick-item').forEach(label => {
        label.addEventListener('click', function () {
            const filename = this.getAttribute('data-filename');
            const templateName = this.getAttribute('data-name');
            loadTemplate(filename, templateName);
        });
    });

    // ── Auto load template pertama (opsional) ──
    <?php if (!empty($templates)): ?>
    loadTemplate('<?= $templates[0]['file_path'] ?>', '<?= esc($templates[0]['template_name'], 'js') ?>');
    <?php endif; ?>
</script>
<script>
(function() {
  const TOTAL_STEPS = 6;
  let currentStep = 0;

  const pages     = document.querySelectorAll('.wz-page');
  const stepEls   = document.querySelectorAll('.wz-step');
  const fill      = document.getElementById('wzProgressFill');
  const btnPrev   = document.getElementById('wzBtnPrev');
  const btnNext   = document.getElementById('wzBtnNext');
  const currentNum = document.getElementById('wzCurrentNum');
  const dotsWrap  = document.getElementById('wzDots');

  // ── Build dots ──
  for (let i = 0; i < TOTAL_STEPS; i++) {
    const dot = document.createElement('button');
    dot.className = 'wz-dot' + (i === 0 ? ' active' : '');
    dot.title = `Step ${i + 1}`;
    dot.addEventListener('click', () => goTo(i));
    dotsWrap.appendChild(dot);
  }

  function getDots() { return dotsWrap.querySelectorAll('.wz-dot'); }

  // ── Go to step ──
  function goTo(next) {
    if (next < 0 || next >= TOTAL_STEPS) return;

    // Animate out current page
    pages[currentStep].classList.add('exit-left');
    pages[currentStep].classList.remove('active');
    setTimeout(() => pages[currentStep].classList.remove('exit-left'), 320);

    // Mark old step done if moving forward
    if (next > currentStep) {
      stepEls[currentStep].classList.remove('active');
      stepEls[currentStep].classList.add('done');
    } else {
      // Going back — remove done from steps after next
      for (let i = next + 1; i < TOTAL_STEPS; i++) {
        stepEls[i].classList.remove('done', 'active');
      }
      stepEls[currentStep].classList.remove('active', 'done');
    }

    currentStep = next;

    // Activate new page
    requestAnimationFrame(() => {
      pages[currentStep].classList.add('active');
    });

    // Update step pills
    stepEls.forEach((el, i) => {
      el.classList.toggle('active', i === currentStep);
    });

    // Update progress bar
    const pct = (currentStep / (TOTAL_STEPS - 1)) * 100;
    fill.style.width = pct + '%';

    // Update counter
    currentNum.textContent = currentStep + 1;

    // Update dots
    getDots().forEach((dot, i) => {
      dot.classList.toggle('active', i === currentStep);
      dot.classList.toggle('done', i < currentStep);
    });

    // Show/hide buttons
    btnPrev.style.display = currentStep === 0 ? 'none' : '';
    btnNext.textContent   = currentStep === TOTAL_STEPS - 1 ? '🎉 Selesai' : 'Lanjut →';

    // Scroll page content to top
    pages[currentStep].scrollTop = 0;

    // If last step, refresh summary
    if (currentStep === TOTAL_STEPS - 1) renderSummary();
  }

  // ── Click step pill → jump directly ──
  stepEls.forEach((el, i) => {
    el.addEventListener('click', () => goTo(i));
  });

  btnPrev.addEventListener('click', () => goTo(currentStep - 1));
  btnNext.addEventListener('click', () => {
    if (currentStep === TOTAL_STEPS - 1) {
      // Trigger publish action
      document.getElementById('btnPublish')?.click();
    } else {
      goTo(currentStep + 1);
    }
  });

  // ── Summary ──
  function g(id) {
    const el = document.getElementById(id);
    return el ? el.value.trim() : '';
  }
  function renderSummary() {
    const rows = [
      ['Template',      document.querySelector('.tpl-pick-item.selected .tpl-pick-name')?.textContent || '—'],
      ['Pengantin Pria', g('groomName') || '—'],
      ['Pengantin Wanita', g('brideName') || '—'],
      ['Tanggal Akad',  g('akadDate')   || '—'],
      ['Tempat Akad',   g('akadVenue')  || '—'],
      ['Tanggal Resepsi', g('resepsiDate') || '—'],
      ['Tempat Resepsi',  g('resepsiVenue') || '—'],
      ['Musik',         g('musicChoice') || 'Tanpa Musik'],
    ];
    document.getElementById('wzSummary').innerHTML = rows
      .map(([k, v]) => `<div style="display:flex;gap:8px;padding:4px 0;border-bottom:1px solid #f0e8df;">
        <span style="min-width:130px;color:#b0a496;">${k}</span>
        <span style="font-weight:500;color:#3d2e1e;">${v}</span>
      </div>`)
      .join('');
  }

  // Init
  goTo(0);
})();
</script>

</body>
</html>
