<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Buat Undangan — KlikSampaiSah</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=DM+Sans:ital,wght@0,300;0,400;0,500;0,600;1,400&family=Cormorant+Garamond:ital,wght@0,400;1,400&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="<?=base_url()?>assets/css/style.css" />
  <link rel="stylesheet" href="<?=base_url()?>assets/css/buat-undangan.css" />
</head>
<body>

<!-- ══ TOP BAR ══ -->
<header class="topbar">
  <a href="#" class="topbar-back">
    <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
      <path d="M10 3L5 8l5 5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
    </svg>
    <span class="topbar-back-text">Dashboard</span>
  </a>

  <div class="topbar-logo">Klik<span>Sampai</span>Sah</div>

  <div class="topbar-actions">
    <button class="btn-draft" id="btnDraft">Simpan</button>
    <button class="btn-publish" id="btnPublish">Beli ✦</button>
  </div>
</header>

<!-- ══ APP ══ -->
<div class="app">

  <!-- ─ WIZARD PANEL ─ -->
  <aside class="wz-panel">

    <!-- Progress header -->
    <div class="wz-head">
      <div class="wz-steps-scroll">
        <div class="wz-steps" id="wzSteps">

          <div class="wz-chip active" data-step="0">
            <div class="wz-chip-num"><span class="wz-chip-num-text">1</span></div>
            <span class="wz-chip-label">Template</span>
          </div>

          <div class="wz-chip" data-step="1">
            <div class="wz-chip-num"><span class="wz-chip-num-text">2</span></div>
            <span class="wz-chip-label">Undangan</span>
          </div>

          <div class="wz-chip" data-step="2">
            <div class="wz-chip-num"><span class="wz-chip-num-text">3</span></div>
            <span class="wz-chip-label">Pasangan</span>
          </div>

          <div class="wz-chip" data-step="3">
            <div class="wz-chip-num"><span class="wz-chip-num-text">4</span></div>
            <span class="wz-chip-label">Acara</span>
          </div>

          <div class="wz-chip" data-step="4">
            <div class="wz-chip-num"><span class="wz-chip-num-text">5</span></div>
            <span class="wz-chip-label">Cerita</span>
          </div>

          <div class="wz-chip" data-step="5">
            <div class="wz-chip-num"><span class="wz-chip-num-text">6</span></div>
            <span class="wz-chip-label">Media</span>
          </div>

        </div>
      </div>
      <div class="wz-bar-wrap">
        <div class="wz-bar-fill" id="wzBarFill" style="width:0%"></div>
      </div>
    </div>

    <!-- Pages -->
    <div class="wz-body" id="wzBody">

      <!-- PAGE 0: Template -->
      <div class="wz-page active" data-page="0">
        <div class="page-hd">
          <div class="page-hd-tag">Langkah 1 dari 7</div>
          <div class="page-hd-title">Pilih Template</div>
          <div class="page-hd-desc">Template menentukan tampilan undanganmu</div>
        </div>
        
        <div class="tpl-grid" id="tplGrid">
            <!-- Demo cards — ganti dengan PHP loop -->
          <?php foreach ($templates as $index => $template): ?>
            <label class="tpl-card" 
              data-tpl="<?=$template['id']?>"
              data-filename="<?= esc($template['file_path']) ?>"
              data-id="<?= $template['id'] ?>"
              data-name="<?= esc($template['template_name']) ?>">
              <input type="radio" name="tpl" value="">
              <div class="tpl-thumb">
                <div class="tpl-thumb-mini">
                  <div class="tpl-thumb-bar"></div>
                  <div class="tpl-thumb-text">A & B</div>
                </div>
              </div>
              <div class="tpl-name"><?=$template['template_name']?></div>
              <div class="tpl-price">Rp <?=number_format($template['price'], 0, ',', '.')?></div>
              <div class="tpl-check">✓</div>
            </label>
          <?php endforeach; ?>
        </div>
      </div>

      <!-- PAGE 1: Data Undangan -->
      <div class="wz-page" data-page="1">
        <div class="page-hd">
          <div class="page-hd-tag">Langkah 2 dari 7</div>
          <div class="page-hd-title">Data Undangan</div>
          <div class="page-hd-desc">Informasi dasar identitas undangan</div>
        </div>
        <div class="field-grid">
          <div class="field field-full">
            <label>URL Undangan</label>
            <input type="text" id="urlName" placeholder="cth. rizal-ayu-2025" autocomplete="off" />
            <span style="font-size:11px;color:var(--ink-soft);margin-top:2px;">kliks.id/<span id="urlPreview" style="color:var(--orange);font-weight:600;">rizal-ayu-2025</span></span>
          </div>
          <div class="field field-full">
            <label>Judul Undangan</label>
            <input type="text" id="judulUndangan" placeholder="cth. Pernikahan Rizal & Ayu" />
          </div>
          <div class="field field-full">
            <label>Keterangan</label>
            <textarea id="keterangan" rows="3" placeholder="Dengan penuh syukur dan kebahagiaan, kami..."></textarea>
          </div>
        </div>
      </div>

      <!-- PAGE 2: Pasangan -->
      <div class="wz-page" data-page="2">
        <div class="page-hd">
          <div class="page-hd-tag">Langkah 3 dari 7</div>
          <div class="page-hd-title">Data Pasangan</div>
          <div class="page-hd-desc">Nama yang akan tampil di undangan</div>
        </div>
        <div class="field-grid">
          <div class="field">
            <label>Nama Pengantin Pria <span class="req">*</span></label>
            <input type="text" id="groomName" placeholder="cth. Muhammad Rizal" />
          </div>
          <div class="field">
            <label>Nama Pengantin Wanita <span class="req">*</span></label>
            <input type="text" id="brideName" placeholder="cth. Ayu Wijaya" />
          </div>
          <div class="field">
            <label>Panggilan Pria</label>
            <input type="text" id="groomNickname" placeholder="cth. Rizal" />
          </div>
          <div class="field">
            <label>Panggilan Wanita</label>
            <input type="text" id="brideNickname" placeholder="cth. Ayu" />
          </div>
          <div class="field">
            <label>Ayah Pengantin Pria</label>
            <input type="text" id="groomFather" placeholder="Bpk. Ahmad Santoso" />
          </div>
          <div class="field">
            <label>Ayah Pengantin Wanita</label>
            <input type="text" id="brideFather" placeholder="Bpk. Hendra Kusuma" />
          </div>
          <div class="field">
            <label>Ibu Pengantin Pria</label>
            <input type="text" id="groomMother" placeholder="Ibu Siti Rahayu" />
          </div>
          <div class="field">
            <label>Ibu Pengantin Wanita</label>
            <input type="text" id="brideMother" placeholder="Ibu Dewi Lestari" />
          </div>
        </div>
      </div>

      <!-- PAGE 3: Akad -->
      <div class="wz-page" data-page="3">
        <div class="page-hd">
          <div class="page-hd-tag">Langkah 4 dari 7</div>
          <div class="page-hd-title">Acara</div>
          <div class="page-hd-desc">Nama, waktu dan tempat acara</div>
        </div>
        <div class="event-block">
          <div class="field-grid">
            <div class="field field-full">
              <label>Nama Acara <span class="req">*</span></label>
              <input type="text" id="akadVenue" placeholder="Akad" />
            </div>
            <div class="field">
              <label>Tanggal <span class="req">*</span></label>
              <input type="date" id="akadDate" />
            </div>
            <div class="field">
              <label>Hari</label>
              <input type="text" id="akadDay" placeholder="Sabtu" readonly />
            </div>
            <div class="field">
              <label>Mulai</label>
              <input type="time" id="akadTimeStart" value="09:00" />
            </div>
            <div class="field">
              <label>Selesai</label>
              <input type="time" id="akadTimeEnd" value="11:00" />
            </div>
            <div class="field field-full">
              <label>Nama Tempat <span class="req">*</span></label>
              <input type="text" id="akadVenue" placeholder="cth. Masjid Al-Ikhlas" />
            </div>
            <div class="field field-full">
              <label>Alamat Lengkap</label>
              <textarea id="akadAddress" rows="2" placeholder="Jl. Sudirman No. 10, Jakarta Selatan"></textarea>
            </div>
            <div class="field field-full">
              <label>Link Google Maps</label>
              <input type="url" id="akadMaps" placeholder="https://maps.google.com/..." />
            </div>
          </div>
        </div>
      </div>

      <!-- PAGE 5: Cerita -->
      <div class="wz-page" data-page="4">
        <div class="page-hd">
          <div class="page-hd-tag">Langkah 6 dari 7</div>
          <div class="page-hd-title">Cerita & Ucapan</div>
          <div class="page-hd-desc">Sentuhan personal untuk undanganmu</div>
        </div>
        <div class="field-grid">
          <div class="field field-full">
            <label>Kutipan / Ayat Pembuka</label>
            <textarea id="quoteText" rows="4" placeholder=""Dan di antara tanda-tanda kekuasaan-Nya..." (QS. Ar-Rum: 21)"></textarea>
          </div>
          <div class="field field-full">
            <label>Kata Sambutan dari Pasangan</label>
            <textarea id="loveStory" rows="5" placeholder="Dengan penuh rasa syukur dan kebahagiaan, kami mengundang Bapak/Ibu/Saudara/i untuk hadir..."></textarea>
          </div>
        </div>
      </div>

      <!-- PAGE 6: Media + Summary -->
      <div class="wz-page" data-page="5">
        <div class="page-hd">
          <div class="page-hd-tag">Langkah 7 dari 7</div>
          <div class="page-hd-title">Foto & Media</div>
          <div class="page-hd-desc">Foto prewedding dan musik latar</div>
        </div>
        <div class="field-grid">
          <div class="field field-full">
            <label>Foto Utama (Cover)</label>
            <div class="upload-zone" id="uploadCover">
              <div class="upload-icon">🖼</div>
              <div class="upload-text">Ketuk untuk pilih foto</div>
              <div class="upload-sub">JPG, PNG — maks. 5MB</div>
            </div>
          </div>
          <div class="field field-full">
            <label>Musik Latar</label>
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

        <!-- Summary -->
        <div class="summary-card" id="wzSummary">
          <div class="summary-title">✦ Ringkasan Undangan</div>
          <div id="summaryRows"></div>
        </div>
      </div>

    </div><!-- end wz-body -->

    <!-- Footer Nav -->
    <div class="wz-footer">
      <div class="wz-footer-info">
        <div class="wz-footer-step">Step <strong id="wzNum">1</strong>/7</div>
        <div class="wz-footer-name" id="wzStepName">Pilih Template</div>
      </div>
      <div class="wz-nav">
        <button class="wz-btn wz-btn-prev" id="wzPrev" style="display:none;">← Kembali</button>
        <button class="wz-btn wz-btn-next" id="wzNext">Lanjut →</button>
      </div>
    </div>

  </aside>

  <!-- ─ PREVIEW PANEL (desktop only) ─ -->
  <main class="preview-panel">
    <div class="preview-inner">
      <div class="preview-label">
        <div class="preview-dot"></div>
        Pratinjau Langsung
      </div>
      <div class="phone">
        <div class="phone-notch"><div class="phone-camera"></div></div>
        <div class="phone-screen">
          <iframe id="templateFrame" class="template-frame" src="about:blank"></iframe>
        </div>
        <div class="phone-home"></div>
      </div>
      <div class="preview-tpl-name" id="previewTplName">Floral Romance</div>
    </div>
  </main>

</div><!-- end app -->

<!-- Mobile: floating preview button -->
<button class="mobile-preview-btn" id="mobilePreviewBtn">
  👁 Pratinjau
</button>

<!-- Mobile: preview drawer -->
<div class="preview-drawer" id="previewDrawer">
  <div class="preview-drawer-inner">
    <div class="preview-drawer-handle"></div>
    <button class="preview-drawer-close" id="drawerClose">✕</button>
    <div class="preview-inner" style="padding-top:0;">
      <div class="preview-label">
        <div class="preview-dot"></div>
        Pratinjau
      </div>
      <div class="phone">
        <div class="phone-notch"><div class="phone-camera"></div></div>
        <div class="phone-screen">
          <iframe id="templateFrameMobile" src="about:blank"></iframe>
        </div>
        <div class="phone-home"></div>
      </div>
    </div>
  </div>
</div>

<script>
// ═════════════════════════════════════════════
//  WIZARD CONTROLLER
// ═════════════════════════════════════════════
(function () {
  const TOTAL = 6;
  const STEP_NAMES = [
    'Pilih Template', 'Data Undangan', 'Data Pasangan',
    'Acara', 'Cerita & Ucapan', 'Foto & Media'
  ];

  let cur = 0;

  const pages   = document.querySelectorAll('.wz-page');
  const chips   = document.querySelectorAll('.wz-chip');
  const barFill = document.getElementById('wzBarFill');
  const btnPrev = document.getElementById('wzPrev');
  const btnNext = document.getElementById('wzNext');
  const numEl   = document.getElementById('wzNum');
  const nameEl  = document.getElementById('wzStepName');

  // ── Scroll active chip into view ──
  function scrollChipIntoView(idx) {
    const chip = chips[idx];
    if (!chip) return;
    chip.scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'center' });
  }

  // ── Go to step ──
  function goTo(next) {
    if (next < 0 || next >= TOTAL) return;

    // Animate out
    const leaving = pages[cur];
    leaving.classList.remove('active');
    if (next > cur) {
      leaving.classList.add('exit-left');
      setTimeout(() => leaving.classList.remove('exit-left'), 300);
    }

    // Chip states
    chips.forEach((c, i) => {
      c.classList.remove('active');
      if (i < next) c.classList.add('done');
      else if (i > next) c.classList.remove('done');
    });

    cur = next;

    // Animate in
    requestAnimationFrame(() => {
      pages[cur].classList.add('active');
      pages[cur].scrollTop = 0;
    });

    chips[cur].classList.add('active');
    chips[cur].classList.remove('done');

    // Progress bar
    barFill.style.width = (cur / (TOTAL - 1) * 100) + '%';

    // Footer
    numEl.textContent = cur + 1;
    nameEl.textContent = STEP_NAMES[cur];
    btnPrev.style.display = cur === 0 ? 'none' : '';

    if (cur === TOTAL - 1) {
      btnNext.textContent = '🎉 Selesai';
      btnNext.classList.add('finish');
      renderSummary();
    } else {
      btnNext.textContent = 'Lanjut →';
      btnNext.classList.remove('finish');
    }

    scrollChipIntoView(cur);
    sendToIframe();
  }

  chips.forEach((c, i) => c.addEventListener('click', () => goTo(i)));
  btnPrev.addEventListener('click', () => goTo(cur - 1));
  btnNext.addEventListener('click', () => {
    if (cur === TOTAL - 1) document.getElementById('btnPublish')?.click();
    else goTo(cur + 1);
  });

  // ── URL slug preview ──
  const urlInput = document.getElementById('urlName');
  const urlPreview = document.getElementById('urlPreview');
  if (urlInput && urlPreview) {
    urlInput.addEventListener('input', () => {
      const slug = urlInput.value.trim().toLowerCase().replace(/\s+/g, '-') || 'nama-undangan';
      urlPreview.textContent = slug;
    });
  }

  // ── Auto-fill day ──
  const DAYS = ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'];
  function getDay(v) { return v ? DAYS[new Date(v + 'T00:00:00').getDay()] : ''; }

  document.getElementById('akadDate')?.addEventListener('change', e => {
    document.getElementById('akadDay').value = getDay(e.target.value);
    sendToIframe();
  });
  document.getElementById('resepsiDate')?.addEventListener('change', e => {
    document.getElementById('resepsiDay').value = getDay(e.target.value);
    sendToIframe();
  });

  // ── Same venue ──
  document.getElementById('sameVenue')?.addEventListener('change', function () {
    const rFields = document.getElementById('resepsiFields');
    const inputs  = rFields.querySelectorAll('input:not([type=date]):not([type=time]), textarea');
    if (this.checked) {
      document.getElementById('resepsiDate').value    = document.getElementById('akadDate').value;
      document.getElementById('resepsiDay').value     = document.getElementById('akadDay').value;
      document.getElementById('resepsiVenue').value   = document.getElementById('akadVenue').value;
      document.getElementById('resepsiAddress').value = document.getElementById('akadAddress').value;
      document.getElementById('resepsiMaps').value    = document.getElementById('akadMaps').value;
      inputs.forEach(i => i.setAttribute('readonly', ''));
    } else {
      inputs.forEach(i => i.removeAttribute('readonly'));
    }
    sendToIframe();
  });

  // ── Template picker ──
  document.querySelectorAll('.tpl-card').forEach(card => {
    card.addEventListener('click', function () {
      document.querySelectorAll('.tpl-card').forEach(c => c.classList.remove('selected'));
      this.classList.add('selected');
      const name = this.dataset.name;
      document.getElementById('previewTplName').textContent = name;

      const filename = this.dataset.filename;
      if (filename) loadTemplate(filename, name);
    });
  });

  // ── Upload zone ──
  const uploadZone = document.getElementById('uploadCover');
  uploadZone?.addEventListener('click', () => {
    const inp = document.createElement('input');
    inp.type = 'file'; inp.accept = 'image/*';
    inp.onchange = e => {
      const f = e.target.files[0]; if (!f) return;
      const r = new FileReader();
      r.onload = ev => {
        uploadZone.style.background = `url(${ev.target.result}) center/cover`;
        uploadZone.innerHTML = `<div style="background:rgba(0,0,0,.45);border-radius:8px;padding:8px 14px;color:#fff;font-size:13px;font-weight:600;">✓ ${f.name}</div>`;
      };
      r.readAsDataURL(f);
    };
    inp.click();
  });

  // ── Summary ──
  function g(id) { const el = document.getElementById(id); return el ? el.value.trim() : ''; }
  function renderSummary() {
    const sel = document.querySelector('.tpl-card.selected .tpl-name')?.textContent || '—';
    const rows = [
      ['Template',         sel],
      ['Pengantin Pria',   g('groomName')    || '—'],
      ['Pengantin Wanita', g('brideName')    || '—'],
      ['Tanggal Akad',     g('akadDate')     || '—'],
      ['Tempat Akad',      g('akadVenue')    || '—'],
      ['Tanggal Resepsi',  g('resepsiDate')  || '—'],
      ['Tempat Resepsi',   g('resepsiVenue') || '—'],
      ['Musik',            g('musicChoice')  || 'Tanpa Musik'],
    ];
    document.getElementById('summaryRows').innerHTML = rows.map(([k, v]) => `
      <div class="summary-row">
        <span class="summary-key">${k}</span>
        <span class="summary-val">${v}</span>
      </div>`).join('');
  }

  // ── Save draft ──
  document.getElementById('btnDraft')?.addEventListener('click', function () {
    this.textContent = '✓ Tersimpan';
    this.classList.add('saved');
    setTimeout(() => { this.textContent = 'Simpan'; this.classList.remove('saved'); }, 2000);
  });

  // ── Mobile preview drawer ──
  document.getElementById('mobilePreviewBtn')?.addEventListener('click', () => {
    document.getElementById('previewDrawer').classList.add('open');
  });
  document.getElementById('drawerClose')?.addEventListener('click', () => {
    document.getElementById('previewDrawer').classList.remove('open');
  });
  document.getElementById('previewDrawer')?.addEventListener('click', function (e) {
    if (e.target === this) this.classList.remove('open');
  });

  // ── postMessage to iframe ──
  const FIELD_IDS = [
    'urlName','judulUndangan','keterangan',
    'groomName','brideName','groomNickname','brideNickname',
    'groomFather','groomMother','brideFather','brideMother',
    'akadDate','akadDay','akadTimeStart','akadTimeEnd','akadVenue','akadAddress','akadMaps',
    'resepsiDate','resepsiDay','resepsiTimeStart','resepsiTimeEnd','resepsiVenue','resepsiAddress','resepsiMaps',
    'quoteText','loveStory','musicChoice'
  ];

  let iframeReady = false;
  const iframe = document.getElementById('templateFrame');

  function collectData() {
    const data = {};
    FIELD_IDS.forEach(id => {
      const el = document.getElementById(id);
      if (el) data[id] = el.value;
    });
    return data;
  }

  function sendToIframe() {
    if (!iframeReady || !iframe?.contentWindow) return;
    try {
      iframe.contentWindow.postMessage({ type: 'updateForm', data: collectData() }, '*');
    } catch (e) {}
  }

  function loadTemplate(filename, name) {
    iframeReady = false;
    iframe.src = `/cek-template/load/${filename}`;
    iframe.onload = () => { iframeReady = true; sendToIframe(); };
  }

  <?php if (!empty($templates)): ?>
  loadTemplate('<?= $templates[0]['file_path'] ?>', '<?= esc($templates[0]['template_name'], 'js') ?>');
  <?php endif; ?>

  // listen for ready signal from iframe
  window.addEventListener('message', e => {
    if (e.data?.type === 'iframeReady') { iframeReady = true; sendToIframe(); }
  });

  // attach live listeners
  FIELD_IDS.forEach(id => {
    const el = document.getElementById(id);
    if (!el) return;
    const ev = (el.tagName === 'SELECT' || ['date','time','checkbox'].includes(el.type)) ? 'change' : 'input';
    el.addEventListener(ev, sendToIframe);
  });

  // init
  goTo(0);
})();


</script>

</body>
</html>
