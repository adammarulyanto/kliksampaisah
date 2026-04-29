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
  <a href="<?=base_url()?>" class="topbar-back">
    <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
      <path d="M10 3L5 8l5 5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
    </svg>
    <span class="topbar-back-text">Dashboard</span>
  </a>

  <div class="topbar-logo">Klik<span>Sampai</span>Sah</div>

  <div class="topbar-actions">
    <?php if (session()->getFlashdata('success')): ?>
      <div class="alert alert-success" id="alertBox">
        <span class="alert-icon">✓</span>
        <span class="alert-msg"><?= session()->getFlashdata('success') ?></span>
        <button class="alert-close" onclick="this.parentElement.remove()">✕</button>
      </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
      <div class="alert alert-error" id="alertBox">
        <span class="alert-icon">✕</span>
        <span class="alert-msg"><?= session()->getFlashdata('error') ?></span>
        <button class="alert-close" onclick="this.parentElement.remove()">✕</button>
      </div>
    <?php endif; ?>
    <button type="button" class="btn-draft" id="btnDraft">Simpan</button>
    <button type="button" class="btn-publish" id="btnPublish">Beli ✦</button>
  </div>
</header>

<!-- ══ APP ══ -->
<div class="app">

  <!-- ─ WIZARD PANEL ─ -->
  <form id="undanganForm" action="<?=base_url('buat-undangan/save')?>" method="POST" enctype="multipart/form-data">
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
            <div class="wz-chip" data-step="6">
              <div class="wz-chip-num"><span class="wz-chip-num-text">7</span></div>
              <span class="wz-chip-label">Ringkasan</span>
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
            <?php foreach ($templates as $index => $template): ?>
              <label class="tpl-card" 
                data-tpl="<?=$template['id']?>"
                data-filename="<?= esc($template['file_path']) ?>"
                data-id="<?= $template['id'] ?>"
                data-name="<?= esc($template['template_name']) ?>"
                data-max-photo="<?= $template['max_photo'] ?? 10 ?>">
                <input type="radio" name="template_id" value="<?=$template['id']?>">
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
              <label>URL Undangan <span class="req">*</span></label>
              <input type="text" 
                id="urlName" 
                name="url_name"
                class="form-control" 
                placeholder="contoh: adit-qailah" 
                autocomplete="off"
                required />
              <div id="urlError" class="error-message" style="display:none;color:red;font-size:11px;"></div>
              <div id="urlSuccess" class="success-message" style="display:none;color:green;font-size:11px;"></div>
              <span style="font-size:11px;color:var(--ink-soft);margin-top:2px;"><?=base_url()?>/<span id="urlPreview" style="color:var(--orange);font-weight:600;">nama-undangan</span></span>
              <span style="font-size:11px;color:var(--ink-soft);margin-top:2px;">Hanya huruf kecil, angka, dash (-), dan underscore (_). Minimal 3 karakter.</span>
            </div>
            <div class="field field-full">
              <label>Judul Undangan</label>
              <input type="text" id="judulUndangan" name="judul_undangan" placeholder="cth. Pernikahan Rizal & Ayu" />
            </div>
            <div class="field field-full">
              <label>Keterangan</label>
              <textarea id="keterangan" name="keterangan" rows="3" placeholder="Dengan penuh syukur dan kebahagiaan, kami..."></textarea>
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
              <input type="text" id="groomName" name="groom_name" placeholder="cth. Muhammad Rizal" />
            </div>
            <div class="field">
              <label>Nama Pengantin Wanita <span class="req">*</span></label>
              <input type="text" id="brideName" name="bride_name" placeholder="cth. Ayu Wijaya" />
            </div>
            <div class="field">
              <label>Panggilan Pria</label>
              <input type="text" id="groomNickname" name="groom_nickname" placeholder="cth. Rizal" />
            </div>
            <div class="field">
              <label>Panggilan Wanita</label>
              <input type="text" id="brideNickname" name="bride_nickname" placeholder="cth. Ayu" />
            </div>
            <div class="field">
              <label>Ayah Pengantin Pria</label>
              <input type="text" id="groomFather" name="groom_father" placeholder="Bpk. Ahmad Santoso" />
            </div>
            <div class="field">
              <label>Ayah Pengantin Wanita</label>
              <input type="text" id="brideFather" name="bride_father" placeholder="Bpk. Hendra Kusuma" />
            </div>
            <div class="field">
              <label>Ibu Pengantin Pria</label>
              <input type="text" id="groomMother" name="groom_mother" placeholder="Ibu Siti Rahayu" />
            </div>
            <div class="field">
              <label>Ibu Pengantin Wanita</label>
              <input type="text" id="brideMother" name="bride_mother" placeholder="Ibu Dewi Lestari" />
            </div>
          </div>
        </div>

        <!-- PAGE 3: Acara -->
        <div class="wz-page" data-page="3">
          <div class="page-hd">
            <div class="page-hd-tag">Langkah 4 dari 7</div>
            <div class="page-hd-title">Acara</div>
            <div class="page-hd-desc">Nama, waktu dan tempat acara</div>
          </div>

          <div id="acaraList">
            <div class="event-block" data-index="0">
              <div class="event-block-header">
                <span class="event-block-label">Acara 1</span>
                <label class="main-event-radio">
                  <input type="radio" name="main_event" value="0" checked />
                  <span class="main-event-badge">⭐ Acara Utama</span>
                </label>
                <button type="button" class="btn-remove-acara" style="display:none;" title="Hapus acara">✕</button>
              </div>
              <div class="field-grid">
                <div class="field field-full">
                  <label>Nama Acara <span class="req">*</span></label>
                  <input type="text" name="acara[0][nama]" placeholder="Contoh : Akad, Resepsi" />
                </div>
                <div class="field">
                  <label>Tanggal <span class="req">*</span></label>
                  <input type="date" name="acara[0][tanggal]" class="acara-date" />
                </div>
                <div class="field">
                  <label>Hari</label>
                  <input type="text" name="acara[0][hari]" placeholder="Sabtu" readonly class="acara-day" />
                </div>
                <div class="field">
                  <label>Mulai</label>
                  <input type="time" name="acara[0][mulai]" value="09:00" />
                </div>
                <div class="field">
                  <label>Selesai</label>
                  <input type="time" name="acara[0][selesai]" value="11:00" />
                </div>
                <div class="field field-full">
                  <label>Nama Tempat <span class="req">*</span></label>
                  <input type="text" name="acara[0][tempat]" placeholder="cth. Masjid Al-Ikhlas" />
                </div>
                <div class="field field-full">
                  <label>Alamat Lengkap</label>
                  <textarea name="acara[0][alamat]" rows="2" placeholder="Jl. Sudirman No. 10, Jakarta Selatan"></textarea>
                </div>
                <div class="field field-full">
                  <label>Link Google Maps</label>
                  <input type="url" name="acara[0][maps]" placeholder="https://maps.google.com/..." />
                </div>
              </div>
            </div>
          </div>

          <button type="button" class="btn-add-acara" id="btnTambahAcara">
            <span>＋</span> Tambah Acara
          </button>
        </div>

        <!-- PAGE 4: Cerita -->
        <div class="wz-page" data-page="4">
          <div class="page-hd">
            <div class="page-hd-tag">Langkah 5 dari 7</div>
            <div class="page-hd-title">Cerita & Ucapan</div>
            <div class="page-hd-desc">Sentuhan personal untuk undanganmu</div>
          </div>
          <div class="field-grid">
            <div class="field field-full">
              <label>Kutipan / Ayat Pembuka</label>
              <textarea id="quoteText" name="quote_text" rows="4" placeholder="Dan di antara tanda-tanda kekuasaan-Nya... (QS. Ar-Rum: 21)"></textarea>
            </div>
            <div class="field field-full">
              <label>Kata Sambutan dari Pasangan</label>
              <textarea id="loveStory" name="love_story" rows="5" placeholder="Dengan penuh rasa syukur dan kebahagiaan, kami mengundang Bapak/Ibu/Saudara/i untuk hadir..."></textarea>
            </div>
          </div>
        </div>

        <!-- PAGE 5: Musik -->
        <div class="wz-page" data-page="5">
          <div class="page-hd">
            <div class="page-hd-tag">Langkah 6 dari 7</div>
            <div class="page-hd-title">Media</div>
            <div class="page-hd-desc">Musik latar undangan & Foto Gallery</div>
          </div>
          <div class="field-grid">
            <div class="field field-full">
              <label>Musik Latar</label>
              <div class="music-list" id="musicList">
                <label class="music-item" data-src="assets/music/canon-in-d.mp3">
                  <input type="radio" name="music_choice" value="canon-in-d" />
                  <div class="music-item-info">
                    <div class="music-item-icon">🎵</div>
                    <div>
                      <div class="music-item-title">Canon in D</div>
                      <div class="music-item-artist">Pachelbel</div>
                    </div>
                  </div>
                  <button type="button" class="music-play-btn" title="Preview">▶</button>
                </label>

                <label class="music-item" data-src="assets/music/perfect-edsheeran.mp3">
                  <input type="radio" name="music_choice" value="perfect-piano" />
                  <div class="music-item-info">
                    <div class="music-item-icon">🎵</div>
                    <div>
                      <div class="music-item-title">Perfect</div>
                      <div class="music-item-artist">Ed Sheeran — Piano Cover</div>
                    </div>
                  </div>
                  <button type="button" class="music-play-btn" title="Preview">▶</button>
                </label>

                <label class="music-item" data-src="assets/music/a-thousand-years.mp3">
                  <input type="radio" name="music_choice" value="a-thousand-years" />
                  <div class="music-item-info">
                    <div class="music-item-icon">🎵</div>
                    <div>
                      <div class="music-item-title">A Thousand Years</div>
                      <div class="music-item-artist">Christina Perri — Piano</div>
                    </div>
                  </div>
                  <button type="button" class="music-play-btn" title="Preview">▶</button>
                </label>

                <label class="music-item" data-src="assets/music/symphony.mp3">
                  <input type="radio" name="music_choice" value="symphony" />
                  <div class="music-item-info">
                    <div class="music-item-icon">🎵</div>
                    <div>
                      <div class="music-item-title">Symphony</div>
                      <div class="music-item-artist">Clean Bandit</div>
                    </div>
                  </div>
                  <button type="button" class="music-play-btn" title="Preview">▶</button>
                </label>

                <label class="music-item music-item-none">
                  <input type="radio" name="music_choice" value="" checked />
                  <div class="music-item-info">
                    <div class="music-item-icon">🔇</div>
                    <div>
                      <div class="music-item-title">Tanpa Musik</div>
                      <div class="music-item-artist">Undangan hening</div>
                    </div>
                  </div>
                </label>
              </div>

              <!-- Mini player -->
              <div class="music-player" id="musicPlayer" style="display:none;">
                <div class="music-player-info">
                  <span class="music-player-dot"></span>
                  <span id="musicPlayerTitle">—</span>
                </div>
                <div class="music-player-controls">
                  <button type="button" id="musicPlayPause">⏸</button>
                  <div class="music-progress-wrap">
                    <div class="music-progress-bar">
                      <div class="music-progress-fill" id="musicProgressFill"></div>
                    </div>
                    <div class="music-time" id="musicTime">0:00</div>
                  </div>
                  <button type="button" id="musicStop">■</button>
                </div>
              </div>

              <div class="field field-full" style="margin-top:16px;">
              <label>Foto Galeri</label>
              <div class="gallery-upload-area" id="galleryUploadArea">
                <input 
                  type="file" 
                  id="galleryInput" 
                  name="gallery[]" 
                  multiple 
                  accept="image/*"
                  style="display:none;" 
                />
                <div class="gallery-drop-zone" id="galleryDropZone">
                  <div class="gallery-drop-icon">🖼️</div>
                  <div class="gallery-drop-text">Klik atau drag foto ke sini</div>
                  <div class="gallery-drop-sub" id="galleryDropSub">Maksimal <strong id="maxPhotoLabel">10</strong> foto</div>
                  <button type="button" class="gallery-pick-btn" id="galleryPickBtn">Pilih Foto</button>
                </div>
                <div class="gallery-preview-grid" id="galleryPreviewGrid"></div>
                <div class="gallery-count" id="galleryCount" style="font-size:11px;color:var(--ink-soft);margin-top:6px;"></div>
              </div>
            </div>
            </div>
          </div>
        </div>

        <!-- PAGE 6: Ringkasan -->
        <div class="wz-page" data-page="6">
          <div class="page-hd">
            <div class="page-hd-tag">Langkah 7 dari 7</div>
            <div class="page-hd-title">Ringkasan</div>
            <div class="page-hd-desc">Periksa kembali semua data undanganmu</div>
          </div>

          <div class="summary-v2" id="wzSummary">
            <div class="sum-section">
              <div class="sum-section-title">🎨 Template</div>
              <div class="sum-row"><span class="sum-key">Template Dipilih</span><span class="sum-val" id="sumTemplate">—</span></div>
            </div>

            <div class="sum-section">
              <div class="sum-section-title">📋 Data Undangan</div>
              <div class="sum-row"><span class="sum-key">URL</span><span class="sum-val"><?=base_url()?>/<span id="sumUrl" style="color:var(--orange,#e07b4a);font-weight:600;">—</span></span></div>
              <div class="sum-row"><span class="sum-key">Judul</span><span class="sum-val" id="sumJudul">—</span></div>
              <div class="sum-row"><span class="sum-key">Keterangan</span><span class="sum-val sum-val-multiline" id="sumKeterangan">—</span></div>
            </div>

            <div class="sum-section">
              <div class="sum-section-title">💑 Pasangan</div>
              <div class="sum-row"><span class="sum-key">Pengantin Pria</span><span class="sum-val" id="sumGroomName">—</span></div>
              <div class="sum-row"><span class="sum-key">Panggilan</span><span class="sum-val" id="sumGroomNick">—</span></div>
              <div class="sum-row"><span class="sum-key">Orang Tua Pria</span><span class="sum-val" id="sumGroomParents">—</span></div>
              <div class="sum-row"><span class="sum-key">Pengantin Wanita</span><span class="sum-val" id="sumBrideName">—</span></div>
              <div class="sum-row"><span class="sum-key">Panggilan</span><span class="sum-val" id="sumBrideNick">—</span></div>
              <div class="sum-row"><span class="sum-key">Orang Tua Wanita</span><span class="sum-val" id="sumBrideParents">—</span></div>
            </div>

            <div class="sum-section">
              <div class="sum-section-title">📅 Acara</div>
              <div id="sumAcaraList"></div>
            </div>

            <div class="sum-section">
              <div class="sum-section-title">✍️ Cerita & Ucapan</div>
              <div class="sum-row"><span class="sum-key">Kutipan</span><span class="sum-val sum-val-multiline" id="sumQuote">—</span></div>
              <div class="sum-row"><span class="sum-key">Kata Sambutan</span><span class="sum-val sum-val-multiline" id="sumLoveStory">—</span></div>
            </div>

            <div class="sum-section">
              <div class="sum-section-title">🎵 Media</div>
              <div class="sum-row"><span class="sum-key">Musik</span><span class="sum-val" id="sumMusik">Tanpa Musik</span></div>
            </div>
            
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
          <button type="button" class="wz-btn wz-btn-prev" id="wzPrev" style="display:none;">← Kembali</button>
          <button type="button" class="wz-btn wz-btn-next" id="wzNext">Lanjut →</button>
        </div>
      </div>

  </aside>
  </form>

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
  const TOTAL = 7;
  const STEP_NAMES = [
    'Pilih Template', 'Data Undangan', 'Data Pasangan',
    'Acara', 'Cerita & Ucapan', 'Musik', 'Ringkasan'
  ];

  let cur = 0;

  const pages   = document.querySelectorAll('.wz-page');
  const chips   = document.querySelectorAll('.wz-chip');
  const barFill = document.getElementById('wzBarFill');
  const btnPrev = document.getElementById('wzPrev');
  const btnNext = document.getElementById('wzNext');
  const numEl   = document.getElementById('wzNum');
  const nameEl  = document.getElementById('wzStepName');

  function scrollChipIntoView(idx) {
    const chip = chips[idx];
    if (!chip) return;
    chip.scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'center' });
  }

  function goTo(next) {
    if (next < 0 || next >= TOTAL) return;

    const leaving = pages[cur];
    leaving.classList.remove('active');
    if (next > cur) {
      leaving.classList.add('exit-left');
      setTimeout(() => leaving.classList.remove('exit-left'), 300);
    }

    chips.forEach((c, i) => {
      c.classList.remove('active');
      if (i < next) c.classList.add('done');
      else if (i > next) c.classList.remove('done');
    });

    cur = next;

    requestAnimationFrame(() => {
      pages[cur].classList.add('active');
      pages[cur].scrollTop = 0;
    });

    chips[cur].classList.add('active');
    chips[cur].classList.remove('done');

    barFill.style.width = (cur / (TOTAL - 1) * 100) + '%';

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
      if (cur === TOTAL - 1) {

          const form     = document.getElementById('undanganForm');
          const formData = new FormData(form);

          // Hapus gallery[] bawaan form (isinya kosong)
          formData.delete('gallery[]');

          // Append dari window.galleryFiles
          const gFiles = window.galleryFiles || [];
          console.log('gallery files saat submit:', gFiles.length);

          gFiles.forEach(file => {
              formData.append('gallery[]', file);
          });

          // Debug: cek semua entry gallery
          for (let [k, v] of formData.entries()) {
              if (k === 'gallery[]') console.log('→', k, v.name, v.size);
          }

          fetch('<?= base_url('buat-undangan/save') ?>', {
              method: 'POST',
              body: formData
          })
          .then(r => r.text())
          .then(html => {
              document.open();
              document.write(html);
              document.close();
          })
          .catch(err => console.error('Submit error:', err));

      } else {
          goTo(cur + 1);
      }
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

  // ── Template picker ──
  document.querySelectorAll('.tpl-card').forEach(card => {
      card.addEventListener('click', function () {
          document.querySelectorAll('.tpl-card').forEach(c => c.classList.remove('selected'));
          this.classList.add('selected');

          const radio = this.querySelector('input[type="radio"]');
          if (radio) radio.checked = true;

          const name = this.dataset.name;
          document.getElementById('previewTplName').textContent = name;

          // ← Update max photo sesuai template dipilih
          const maxPhoto = parseInt(this.dataset.maxPhoto) || 10;
          if (window.gallerySetMax) window.gallerySetMax(maxPhoto);

          const filename = this.dataset.filename;
          if (filename) loadTemplate(filename, name);
      });
  });

  // ── Summary ──
  function g(id) { const el = document.getElementById(id); return el ? el.value.trim() : ''; }
  
  // ════════════════════════════════
  //  MUSIC PLAYER
  // ════════════════════════════════
  (function () {
    let audio = null;
    let activeItem = null;
    const player = document.getElementById('musicPlayer');
    const playerTitle = document.getElementById('musicPlayerTitle');
    const playPauseBtn = document.getElementById('musicPlayPause');
    const stopBtn = document.getElementById('musicStop');
    const progressFill = document.getElementById('musicProgressFill');
    const timeEl = document.getElementById('musicTime');

    function fmtTime(s) {
      const m = Math.floor(s / 60);
      const sec = Math.floor(s % 60);
      return `${m}:${sec.toString().padStart(2, '0')}`;
    }

    function stopAudio() {
      if (audio) { audio.pause(); audio.currentTime = 0; }
      progressFill.style.width = '0%';
      timeEl.textContent = '0:00';
      playPauseBtn.textContent = '▶';
      player.style.display = 'none';
      document.querySelectorAll('.music-play-btn').forEach(b => b.classList.remove('active'));
      document.querySelectorAll('.music-item').forEach(b => b.classList.remove('playing'));
      activeItem = null;
    }

    function playItem(item) {
      const src = item.dataset.src;
      if (!src) return;

      if (activeItem === item) {
        if (audio.paused) { audio.play(); playPauseBtn.textContent = '⏸'; }
        else { audio.pause(); playPauseBtn.textContent = '▶'; }
        return;
      }

      stopAudio();
      activeItem = item;

      audio = new Audio(src);

      audio.addEventListener('timeupdate', () => {
        if (!audio.duration) return;
        const pct = (audio.currentTime / audio.duration) * 100;
        progressFill.style.width = pct + '%';
        timeEl.textContent = fmtTime(audio.currentTime);
      });
      audio.addEventListener('ended', stopAudio);

      audio.play().catch(() => {});

      const title = item.querySelector('.music-item-title')?.textContent || '—';
      const artist = item.querySelector('.music-item-artist')?.textContent || '';
      playerTitle.textContent = `${title} — ${artist}`;
      playPauseBtn.textContent = '⏸';
      player.style.display = '';
      item.querySelector('.music-play-btn')?.classList.add('active');
      item.classList.add('playing');
    }

    document.querySelectorAll('.music-item').forEach(item => {
      item.querySelector('.music-play-btn')?.addEventListener('click', e => {
        e.preventDefault();
        e.stopPropagation();
        playItem(item);
      });
    });

    playPauseBtn?.addEventListener('click', () => {
      if (!audio || !activeItem) return;
      if (audio.paused) { audio.play(); playPauseBtn.textContent = '⏸'; }
      else { audio.pause(); playPauseBtn.textContent = '▶'; }
    });

    stopBtn?.addEventListener('click', stopAudio);

    document.querySelector('.music-progress-bar')?.addEventListener('click', e => {
      if (!audio || !audio.duration) return;
      const rect = e.currentTarget.getBoundingClientRect();
      const pct = (e.clientX - rect.left) / rect.width;
      audio.currentTime = pct * audio.duration;
    });

    document.querySelectorAll('.music-item input[type="radio"]').forEach(radio => {
      radio.addEventListener('change', () => {
        stopAudio();
        sendToIframe();
      });
    });
  })();

  // ════════════════════════════════
  //  RENDER SUMMARY
  // ════════════════════════════════
  function renderSummary() {
    function g(id) {
      const el = document.getElementById(id);
      return el ? el.value.trim() : '';
    }
    function orDash(v) { return v || '—'; }

    document.getElementById('sumTemplate').textContent =
      orDash(document.querySelector('.tpl-card.selected .tpl-name')?.textContent);

    document.getElementById('sumUrl').textContent = orDash(g('urlName'));
    document.getElementById('sumJudul').textContent = orDash(g('judulUndangan'));
    document.getElementById('sumKeterangan').textContent = orDash(g('keterangan'));

    document.getElementById('sumGroomName').textContent = orDash(g('groomName'));
    document.getElementById('sumGroomNick').textContent = orDash(g('groomNickname'));
    document.getElementById('sumBrideName').textContent = orDash(g('brideName'));
    document.getElementById('sumBrideNick').textContent = orDash(g('brideNickname'));

    const gFather = g('groomFather'), gMother = g('groomMother');
    document.getElementById('sumGroomParents').textContent =
      [gFather, gMother].filter(Boolean).join(' & ') || '—';

    const bFather = g('brideFather'), bMother = g('brideMother');
    document.getElementById('sumBrideParents').textContent =
      [bFather, bMother].filter(Boolean).join(' & ') || '—';

    const acaraContainer = document.getElementById('sumAcaraList');
    acaraContainer.innerHTML = '';
    document.querySelectorAll('#acaraList .event-block').forEach((block, i) => {
      const val = name => block.querySelector(`[name="acara[${i}][${name}]"]`)?.value.trim() || '';
      const nama   = val('nama');
      const tgl    = val('tanggal');
      const hari   = val('hari');
      const mulai  = val('mulai');
      const selesai = val('selesai');
      const tempat = val('tempat');
      const alamat = val('alamat');

      const div = document.createElement('div');
      div.className = 'sum-acara-block';
      div.innerHTML = `
        <div class="sum-acara-name">📍 ${nama || `Acara ${i+1}`}</div>
        <div class="sum-acara-detail">
          ${hari ? hari + ', ' : ''}${tgl || '—'} &nbsp;·&nbsp; ${mulai}–${selesai}<br>
          ${tempat || '—'}<br>
          ${alamat || ''}
        </div>`;
      
      // Gallery count
      const galleryFiles = document.getElementById('galleryInput')?.files;
      const galleryCount = galleryFiles ? galleryFiles.length : 0;
      document.getElementById('sumMusik').closest('.sum-section')
        .insertAdjacentHTML('beforeend', `
          <div class="sum-row">
            <span class="sum-key">Foto Galeri</span>
            <span class="sum-val">${galleryCount > 0 ? galleryCount + ' foto dipilih' : '—'}</span>
          </div>
        `);

      acaraContainer.appendChild(div);
    });

    document.getElementById('sumQuote').textContent = orDash(g('quoteText'));
    document.getElementById('sumLoveStory').textContent = orDash(g('loveStory'));

    const musicRadio = document.querySelector('input[name="music_choice"]:checked');
    const musicLabel = musicRadio?.closest('.music-item')?.querySelector('.music-item-title')?.textContent;
    document.getElementById('sumMusik').textContent = musicLabel || 'Tanpa Musik';
  }

  // ── Save draft ──
  document.getElementById('btnDraft')?.addEventListener('click', function () {
    // Collect all form data
    const form = document.getElementById('undanganForm');
    const formData = new FormData(form);
    
    fetch('<?=base_url('buat-undangan/save')?>', {
      method: 'POST',
      body: formData
    }).then(response => response.json())
      .then(data => {
        this.textContent = '✓ Tersimpan';
        this.classList.add('saved');
        setTimeout(() => { this.textContent = 'Simpan'; this.classList.remove('saved'); }, 2000);
      }).catch(() => {
        this.textContent = '✗ Gagal';
        setTimeout(() => { this.textContent = 'Simpan'; }, 2000);
      });
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
    'urlName', 'judulUndangan', 'keterangan',
    'groomName', 'brideName', 'groomNickname', 'brideNickname',
    'groomFather', 'groomMother', 'brideFather', 'brideMother',
    'quoteText', 'loveStory'
  ];

  let iframeReady = false;
  const iframe = document.getElementById('templateFrame');

  function collectData() {
    const data = {};
    FIELD_IDS.forEach(id => {
      const el = document.getElementById(id);
      if (el) data[id] = el.value;
    });
    // Add acara data
    const acaraData = [];
    document.querySelectorAll('#acaraList .event-block').forEach((block, i) => {
      const acara = {
        nama: block.querySelector('[name^="acara"][name$="[nama]"]')?.value || '',
        tanggal: block.querySelector('[name^="acara"][name$="[tanggal]"]')?.value || '',
        hari: block.querySelector('[name^="acara"][name$="[hari]"]')?.value || '',
        mulai: block.querySelector('[name^="acara"][name$="[mulai]"]')?.value || '',
        selesai: block.querySelector('[name^="acara"][name$="[selesai]"]')?.value || '',
        tempat: block.querySelector('[name^="acara"][name$="[tempat]"]')?.value || '',
        alamat: block.querySelector('[name^="acara"][name$="[alamat]"]')?.value || '',
        maps: block.querySelector('[name^="acara"][name$="[maps]"]')?.value || ''
      };
      acaraData.push(acara);
    });
    data.acara_list = acaraData;
    
    // Add music choice
    const musicRadio = document.querySelector('input[name="music_choice"]:checked');
    data.music_choice = musicRadio ? musicRadio.value : '';
    
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

  window.addEventListener('message', e => {
    if (e.data?.type === 'iframeReady') { iframeReady = true; sendToIframe(); }
  });

  FIELD_IDS.forEach(id => {
    const el = document.getElementById(id);
    if (!el) return;
    const ev = (el.tagName === 'SELECT' || ['date','time'].includes(el.type)) ? 'change' : 'input';
    el.addEventListener(ev, sendToIframe);
  });

  // ── Tambah / Hapus Acara ──
  const DAYS_LIST = ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'];
  let acaraCount = 1;

  function reindexAcara() {
      document.querySelectorAll('#acaraList .event-block').forEach((block, i) => {
          block.dataset.index = i;
          block.querySelector('.event-block-label').textContent = `Acara ${i + 1}`;

          block.querySelectorAll('[name]').forEach(el => {
              el.name = el.name.replace(/acara\[\d+\]/, `acara[${i}]`);
          });

          // Update value radio main_event sesuai index
          const radio = block.querySelector('input[name="main_event"]');
          if (radio) radio.value = i;

          const removeBtn = block.querySelector('.btn-remove-acara');
          const total = document.querySelectorAll('#acaraList .event-block').length;
          removeBtn.style.display = total > 1 ? '' : 'none';
      });
  }

  function bindAcaraEvents(block) {
    const dateInput = block.querySelector('.acara-date');
    const dayInput  = block.querySelector('.acara-day');
    dateInput?.addEventListener('change', e => {
      dayInput.value = e.target.value
        ? DAYS_LIST[new Date(e.target.value + 'T00:00:00').getDay()]
        : '';
      sendToIframe();
    });

    block.querySelectorAll('input, textarea, select').forEach(el => {
      const ev = (['date','time'].includes(el.type) || el.tagName === 'SELECT') ? 'change' : 'input';
      el.addEventListener(ev, sendToIframe);
    });

    block.querySelector('.btn-remove-acara')?.addEventListener('click', () => {
      block.remove();
      reindexAcara();
      sendToIframe();
    });
  }

  bindAcaraEvents(document.querySelector('#acaraList .event-block'));

  document.getElementById('btnTambahAcara')?.addEventListener('click', () => {
      const idx      = acaraCount++;
      const template = document.querySelector('#acaraList .event-block');
      const clone    = template.cloneNode(true);

      clone.querySelectorAll('input, textarea').forEach(el => {
          if (el.type === 'time') {
              el.value = el.name.includes('selesai') ? '11:00' : '09:00';
          } else if (el.type === 'radio' && el.name === 'main_event') {
              el.checked = false;   // acara baru bukan utama
              el.value   = idx;
          } else if (el.type !== 'radio' && el.type !== 'checkbox') {
              el.value = '';
          }
      });

      clone.querySelectorAll('[name]').forEach(el => {
          if (el.name !== 'main_event') {
              el.name = el.name.replace(/acara\[\d+\]/, `acara[${idx}]`);
          }
      });

      document.getElementById('acaraList').appendChild(clone);
      reindexAcara();
      bindAcaraEvents(clone);
      clone.scrollIntoView({ behavior: 'smooth', block: 'start' });
  });

  // init
  goTo(0);
})();
</script>

<script>
// Validasi URL slug
function validateUrlSlug(slug) {
    if (!slug || slug.length === 0) {
        return { valid: false, message: 'URL tidak boleh kosong' };
    }
    if (slug.length < 3) {
        return { valid: false, message: 'URL minimal 3 karakter' };
    }
    if (slug.length > 100) {
        return { valid: false, message: 'URL maksimal 100 karakter' };
    }
    const pattern = /^[a-z0-9-_]+$/;
    if (!pattern.test(slug)) {
        return { valid: false, message: 'Hanya huruf kecil (a-z), angka (0-9), dash (-), dan underscore (_)' };
    }
    if (slug.startsWith('-') || slug.startsWith('_') || slug.endsWith('-') || slug.endsWith('_')) {
        return { valid: false, message: 'Tidak boleh diawali atau diakhiri dengan dash (-) atau underscore (_)' };
    }
    if (slug.includes('--') || slug.includes('__') || slug.includes('_-') || slug.includes('-_')) {
        return { valid: false, message: 'Tidak boleh menggunakan karakter ganda (--, __, -_, _-)' };
    }
    if (/^\d+$/.test(slug)) {
        return { valid: false, message: 'Tidak boleh hanya terdiri dari angka' };
    }
    const reservedKeywords = [
        'index', 'create', 'edit', 'delete', 'update', 'store', 'show',
        'admin', 'api', 'login', 'register', 'dashboard', 'user', 'users'
    ];
    if (reservedKeywords.includes(slug.toLowerCase())) {
        return { valid: false, message: 'URL ini tidak bisa digunakan karena merupakan kata terlarang' };
    }
    return { valid: true, message: 'URL tersedia!' };
}

function autoFormatUrl(input) {
    let value = input.value;
    value = value.toLowerCase();
    value = value.replace(/\s+/g, '-');
    value = value.replace(/[^a-z0-9\-_]/g, '');
    value = value.replace(/-{2,}/g, '-');
    value = value.replace(/_{2,}/g, '_');
    input.value = value;
    return value;
}

async function checkAvailability(slug) {
    if (!slug || slug.length < 3) return;
    
    try {
        const response = await fetch(`<?=base_url('/check-url') ?>?slug=${encodeURIComponent(slug)}`);
        const data = await response.json();
        
        const urlInput = document.getElementById('urlName');
        if (data.available) {
            urlInput.classList.remove('is-invalid');
            urlInput.classList.add('is-valid');
            const errorDiv = document.getElementById('urlError');
            const successDiv = document.getElementById('urlSuccess');
            if (errorDiv) errorDiv.style.display = 'none';
            if (successDiv) {
                successDiv.style.display = 'block';
                successDiv.innerHTML = '✓ URL tersedia!';
            }
        } else {
            urlInput.classList.remove('is-valid');
            urlInput.classList.add('is-invalid');
            const errorDiv = document.getElementById('urlError');
            const successDiv = document.getElementById('urlSuccess');
            if (successDiv) successDiv.style.display = 'none';
            if (errorDiv) {
                errorDiv.style.display = 'block';
                errorDiv.innerHTML = data.message || 'URL sudah digunakan';
            }
        }
    } catch (error) {
        console.error('Error checking URL:', error);
    }
}

document.addEventListener('DOMContentLoaded', function() {
    const urlInput = document.getElementById('urlName');
    if (!urlInput) return;
    
    urlInput.addEventListener('input', function(e) {
        autoFormatUrl(this);
        const validation = validateUrlSlug(this.value);
        
        if (!validation.valid) {
            this.classList.remove('is-valid');
            this.classList.add('is-invalid');
            const errorDiv = document.getElementById('urlError');
            const successDiv = document.getElementById('urlSuccess');
            if (errorDiv) {
                errorDiv.style.display = 'block';
                errorDiv.innerHTML = '✗ ' + validation.message;
            }
            if (successDiv) successDiv.style.display = 'none';
        } else {
            this.classList.remove('is-invalid');
            const errorDiv = document.getElementById('urlError');
            if (errorDiv) errorDiv.style.display = 'none';
        }
    });
    
    urlInput.addEventListener('blur', function() {
        const validation = validateUrlSlug(this.value);
        if (validation.valid && this.value.length >= 3) {
            checkAvailability(this.value);
        }
    });
    
    const form = urlInput.closest('form');
    if (form) {
        form.addEventListener('submit', function(e) {
            const validation = validateUrlSlug(urlInput.value);
            if (!validation.valid) {
                e.preventDefault();
                alert('URL tidak valid: ' + validation.message);
                urlInput.focus();
            }
        });
    }
});
// ════════════════════════════════
//  GALLERY UPLOAD
// ════════════════════════════════
(function () {
  const input       = document.getElementById('galleryInput');
  const dropZone    = document.getElementById('galleryDropZone');
  const pickBtn     = document.getElementById('galleryPickBtn');
  const previewGrid = document.getElementById('galleryPreviewGrid');
  const countEl     = document.getElementById('galleryCount');
  const maxLabel    = document.getElementById('maxPhotoLabel');

  let MAX_PHOTO = 10;
  let files = [];  // array internal

  // Expose sebagai getter — selalu baca array terbaru
  Object.defineProperty(window, 'galleryFiles', {
    get: function() { return files; },
    configurable: true
  });

  window.gallerySetMax = function(max) {
    MAX_PHOTO = parseInt(max) || 10;
    if (maxLabel) maxLabel.textContent = MAX_PHOTO;
    updateCount();
  };

  function updateCount() {
    if (countEl) countEl.textContent = files.length > 0
      ? `${files.length} / ${MAX_PHOTO} foto dipilih`
      : '';
  }

  function addFiles(newFiles) {
    const remaining = MAX_PHOTO - files.length;
    if (remaining <= 0) {
      alert(`Maksimal ${MAX_PHOTO} foto.`);
      return;
    }
    const toAdd = Array.from(newFiles).slice(0, remaining);
    if (Array.from(newFiles).length > remaining) {
      alert(`Hanya ${remaining} foto lagi yang bisa ditambahkan.`);
    }
    toAdd.forEach(f => files.push(f));
    console.log('gallery files after add:', files.length);
    renderPreviews();
    updateCount();
  }

  function renderPreviews() {
    previewGrid.innerHTML = '';
    files.forEach((file, idx) => {
      const reader = new FileReader();
      reader.onload = e => {
        const wrap = document.createElement('div');
        wrap.className = 'gallery-thumb';
        wrap.innerHTML = `
          <img src="${e.target.result}" alt="foto ${idx+1}" />
          <button type="button" class="gallery-thumb-remove" data-idx="${idx}" title="Hapus">✕</button>
          <div class="gallery-thumb-num">${idx + 1}</div>
        `;
        wrap.querySelector('.gallery-thumb-remove').addEventListener('click', () => {
          files.splice(idx, 1);
          renderPreviews();
          updateCount();
        });
        previewGrid.appendChild(wrap);
      };
      reader.readAsDataURL(file);
    });
  }

  if (pickBtn) pickBtn.addEventListener('click', () => input.click());

  if (input) input.addEventListener('change', () => {
    addFiles(input.files);
    input.value = '';
  });

  if (dropZone) {
    dropZone.addEventListener('dragover', e => {
      e.preventDefault();
      dropZone.classList.add('drag-over');
    });
    dropZone.addEventListener('dragleave', () => {
      dropZone.classList.remove('drag-over');
    });
    dropZone.addEventListener('drop', e => {
      e.preventDefault();
      dropZone.classList.remove('drag-over');
      addFiles(e.dataTransfer.files);
    });
  }
})();
</script>

</body>
</html>