<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Buat Undangan — KlikSampaiSah</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=DM+Sans:ital,wght@0,300;0,400;0,500;0,600;1,400&family=Cormorant+Garamond:ital,wght@0,400;1,400&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <link rel="stylesheet" href="<?=base_url()?>assets/css/style-buat-undangan.css" />
  <link rel="stylesheet" href="<?=base_url()?>assets/css/buat-undangan.css" />
  <style>
    /* ══ TOAST ══ */
    .toast-stack {
      position: fixed; top: 72px; right: 16px; z-index: 9999;
      display: flex; flex-direction: column; gap: 8px; pointer-events: none;
    }
    .toast {
      background: var(--white, #fff); border: 0.5px solid #ddd;
      border-radius: 12px; padding: 12px 16px; min-width: 260px; max-width: 340px;
      pointer-events: auto; display: flex; align-items: flex-start; gap: 10px;
      animation: toastSlide .2s ease; box-shadow: 0 4px 16px rgba(0,0,0,.08);
    }
    .toast.toast-error  { border-left: 3px solid #E24B4A; }
    .toast.toast-success{ border-left: 3px solid #1D9E75; }
    .toast-icon {
      width: 20px; height: 20px; border-radius: 50%; display: flex;
      align-items: center; justify-content: center; font-size: 11px;
      font-weight: 600; flex-shrink: 0; margin-top: 1px;
    }
    .toast-error  .toast-icon { background: #FCEBEB; color: #A32D2D; }
    .toast-success .toast-icon { background: #EAF3DE; color: #3B6D11; }
    .toast-body   { flex: 1; }
    .toast-title  { font-size: 13px; font-weight: 600; color: #1a1a1a; margin: 0 0 2px; }
    .toast-list   { margin: 4px 0 0; padding-left: 16px; font-size: 12px; color: #555; line-height: 1.8; }
    .toast-close  {
      font-size: 14px; color: #aaa; cursor: pointer; background: none;
      border: none; padding: 0; line-height: 1; flex-shrink: 0;
    }
    .toast-close:hover { color: #333; }
    @keyframes toastSlide {
      from { opacity: 0; transform: translateX(12px); }
      to   { opacity: 1; transform: none; }
    }

    /* ══ FIELD ERROR ══ */
    .field-error input, .field-error textarea, .field-error select {
      border-color: #E24B4A !important; background: #fff8f8;
    }
    .field-shake { animation: shake .3s ease; }
    @keyframes shake {
      0%, 100% { transform: translateX(0); }
      25%       { transform: translateX(-4px); }
      75%       { transform: translateX(4px); }
    }

    /* ══ GIFT BLOCK ══ */
    .gift-block {
      background: var(--white, #fff);
      border: 0.5px solid #e0ddd8;
      border-radius: 12px;
      padding: 16px;
      margin-bottom: 12px;
      transition: box-shadow .2s;
    }
    .gift-block:hover { box-shadow: 0 2px 12px rgba(0,0,0,.06); }

    .gift-block-header {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin-bottom: 14px;
    }

    .gift-block-label {
      font-size: 11px;
      font-weight: 600;
      letter-spacing: 0.08em;
      text-transform: uppercase;
      color: var(--ink-soft, #888);
    }

    .btn-remove-gift {
      background: none;
      border: 0.5px solid #e0ddd8;
      border-radius: 6px;
      color: #aaa;
      font-size: 12px;
      padding: 3px 8px;
      cursor: pointer;
      transition: border-color .2s, color .2s;
      line-height: 1.5;
    }
    .btn-remove-gift:hover {
      border-color: #E24B4A;
      color: #E24B4A;
    }

    /* Type selector */
    .gift-type-selector {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 8px;
      margin-bottom: 16px;
    }

    .gift-type-opt {
      cursor: pointer;
      display: block;
    }

    .gift-type-opt input[type="radio"] {
      position: absolute;
      opacity: 0;
      width: 0;
      height: 0;
      pointer-events: none;
    }

    .gift-type-box {
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 6px;
      padding: 12px 8px;
      border: 1.5px solid #e0ddd8;
      border-radius: 10px;
      background: #fafaf9;
      transition: border-color .2s, background .2s, box-shadow .2s;
      text-align: center;
      user-select: none;
    }

    .gift-type-opt:hover .gift-type-box {
      border-color: #c9c5be;
      background: #f5f3ef;
    }

    .gift-type-opt input[type="radio"]:checked + .gift-type-box {
      border-color: var(--orange, #E8703A);
      background: #fff8f4;
      box-shadow: 0 0 0 3px rgba(232,112,58,.1);
    }

    .gift-type-icon {
      font-size: 22px;
      line-height: 1;
    }

    .gift-type-label {
      font-size: 12px;
      font-weight: 500;
      color: var(--ink, #1a1a1a);
      line-height: 1.3;
    }

    /* Fields */
    .gift-fields {
      display: flex;
      flex-direction: column;
    }

    .gift-fields .field {
      margin-bottom: 10px;
    }

    .gift-fields .field:last-child {
      margin-bottom: 0;
    }

    /* Fields rekening: 2 kolom untuk bank & nomor */
    .gift-fields-rekening .gift-row-2 {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 10px;
    }

    /* Add gift button */
    .btn-add-gift {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 6px;
      width: 100%;
      padding: 10px 14px;
      background: none;
      border: 1.5px dashed #ccc;
      border-radius: 10px;
      color: var(--ink-soft, #888);
      font-size: 13px;
      font-weight: 500;
      cursor: pointer;
      transition: border-color .2s, color .2s;
      margin-top: 4px;
    }
    .btn-add-gift:hover {
      border-color: var(--orange, #E8703A);
      color: var(--orange, #E8703A);
    }

    /* Gift list container */
    #giftList {
      display: flex;
      flex-direction: column;
    }
  </style>
</head>
<body>

<?php
$defaultPages = [
  [
    'section'     => 'Info',
    'fields_html' => '
      <div class="field field-full">
        <label>URL Undangan <span class="req">*</span></label>
        <input type="text" id="urlName" name="url_name" placeholder="contoh: adit-qailah" autocomplete="off" />
        <div id="urlError"   style="display:none;color:red;font-size:11px;"></div>
        <div id="urlSuccess" style="display:none;color:green;font-size:11px;"></div>
        <span style="font-size:11px;color:var(--ink-soft);margin-top:2px;">'.base_url().'<span id="urlPreview" style="color:var(--orange);font-weight:600;">nama-undangan</span></span>
        <span style="font-size:11px;color:var(--ink-soft);margin-top:2px;">Huruf kecil, angka, dash (-), underscore (_). Min 3 karakter.</span>
      </div>
      <div class="field field-full">
        <label>Judul Undangan</label>
        <input type="text" id="judulUndangan" name="judul_undangan" placeholder="cth. Pernikahan Rizal &amp; Ayu" />
      </div>
      <div class="field field-full">
        <label>Keterangan</label>
        <textarea id="keterangan" name="keterangan" rows="3" placeholder="Dengan penuh syukur dan kebahagiaan, kami..."></textarea>
      </div>',
  ],
  [
    'section'     => 'The Couple',
    'fields_html' => '
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
      </div>',
  ],
  [
    'section'     => 'Events',
    'fields_html' => '<!-- ACARA_BLOCK -->',
  ],
  [
    'section'     => 'Gift',
    'fields_html' => '<!-- GIFT_BLOCK -->',
  ],
  [
    'section'     => 'Media',
    'fields_html' => '<!-- MEDIA_BLOCK -->',
  ],
];

$formSectionsJson = json_encode($formSections ?? [], JSON_HEX_TAG | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
$defaultPagesJson = json_encode($defaultPages,   JSON_HEX_TAG | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
?>

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
      <div class="alert alert-success">
        <span class="alert-icon">✓</span>
        <span class="alert-msg"><?= session()->getFlashdata('success') ?></span>
        <button class="alert-close" onclick="this.parentElement.remove()">✕</button>
      </div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('error')): ?>
      <div class="alert alert-error">
        <span class="alert-icon">✕</span>
        <span class="alert-msg"><?= session()->getFlashdata('error') ?></span>
        <button class="alert-close" onclick="this.parentElement.remove()">✕</button>
      </div>
    <?php endif; ?>
    <button type="button" class="btn-publish" id="btnPublish">Buat Undangan ✦</button>
  </div>
</header>

<div class="app">

  <form id="undanganForm" action="<?=base_url('buat-undangan/save')?>" method="POST" enctype="multipart/form-data">
  <aside class="wz-panel">

    <div class="wz-head">
      <div class="wz-steps-scroll">
        <div class="wz-steps" id="wzSteps">
          <div class="wz-chip active" data-step="0">
            <div class="wz-chip-num"><span class="wz-chip-num-text">1</span></div>
            <span class="wz-chip-label">Template</span>
          </div>
        </div>
      </div>
      <div class="wz-bar-wrap">
        <div class="wz-bar-fill" id="wzBarFill" style="width:0%"></div>
      </div>
    </div>

    <div class="wz-body" id="wzBody">

      <!-- PAGE 0: Template -->
      <div class="wz-page active" data-page="0">
        <div class="page-hd">
          <div class="page-hd-tag">Langkah 1</div>
          <div class="page-hd-title">Pilih Template</div>
          <div class="page-hd-desc">Template menentukan tampilan undanganmu</div>
        </div>
        <div class="tpl-grid" id="tplGrid">
          <?php foreach ($templates as $template): ?>
            <label class="tpl-card"
              data-tpl="<?=$template['id']?>"
              data-filename="<?=esc($template['file_path'])?>"
              data-id="<?=$template['id']?>"
              data-name="<?=esc($template['template_name'])?>"
              data-max-photo="<?=$template['max_photo'] ?? 10?>">
              <input type="radio" name="template_id" value="<?=$template['id']?>">
              <input type="hidden" name="ownership_template_id" value="<?=$template['ownership_template_id']?>">
              <div class="tpl-thumb">
                <div class="tpl-thumb-mini">
                  <div class="tpl-thumb-bar"></div>
                  <div class="tpl-thumb-text">A & B</div>
                </div>
              </div>
              <div class="tpl-name"><?=$template['template_name']?></div>
              <div class="tpl-check">✓</div>
            </label>
          <?php endforeach; ?>
          <label class="tpl-card-buy" onclick="window.location='<?=base_url('template')?>'">
            <div class="tpl-thumb-buy">
              <div class="tpl-thumb-text-buy">
                <i class="fa-solid fa-plus"></i><br>
                <span class="tpl-thumb-text-buy-beli">Beli Template</span>
              </div>
            </div>
          </label>
        </div>
      </div>

      <!-- PAGE DINAMIS -->
      <div id="wzDynamicPages"></div>

      <!-- PAGE RINGKASAN -->
      <div class="wz-page" id="wzSummaryPage" data-page="summary">
        <div class="page-hd">
          <div class="page-hd-tag" id="sumStepTag">Langkah Terakhir</div>
          <div class="page-hd-title">Ringkasan</div>
          <div class="page-hd-desc">Periksa kembali semua data undanganmu</div>
        </div>
        <div class="summary-v2" id="wzSummary">
          <div class="sum-section">
            <div class="sum-section-title">🎨 Template</div>
            <div class="sum-row"><span class="sum-key">Template</span><span class="sum-val" id="sumTemplate">—</span></div>
          </div>
          <div id="sumDynamicContent"></div>
          <div class="sum-section" id="sumAcaraSection" style="display:none;">
            <div class="sum-section-title">📅 Acara</div>
            <div id="sumAcaraList"></div>
          </div>
          <div class="sum-section" id="sumGiftSection" style="display:none;">
            <div class="sum-section-title">🎁 Gift</div>
            <div id="sumGiftList"></div>
          </div>
          <div class="sum-section" id="sumMediaSection">
            <div class="sum-section-title">🎵 Media</div>
            <div class="sum-row"><span class="sum-key">Musik</span><span class="sum-val" id="sumMusik">Tanpa Musik</span></div>
          </div>
        </div>
      </div>

    </div><!-- end wz-body -->

    <div class="wz-footer">
      <div class="wz-footer-info">
        <div class="wz-footer-step">Step <strong id="wzNum">1</strong>/<span id="wzTotal">?</span></div>
        <div class="wz-footer-name" id="wzStepName">Pilih Template</div>
      </div>
      <div class="wz-nav">
        <button type="button" class="wz-btn wz-btn-prev" id="wzPrev" style="display:none;">← Kembali</button>
        <button type="button" class="wz-btn wz-btn-next" id="wzNext">Lanjut →</button>
      </div>
    </div>

  </aside>
  </form>

  <main class="preview-panel">
    <div class="preview-inner">
      <div class="preview-label"><div class="preview-dot"></div>Pratinjau Langsung</div>
      <div class="phone">
        <div class="phone-notch"><div class="phone-camera"></div></div>
        <div class="phone-screen">
          <iframe id="templateFrame" class="template-frame" src="about:blank"></iframe>
        </div>
        <div class="phone-home"></div>
      </div>
      <div class="preview-tpl-name" id="previewTplName">—</div>
    </div>
  </main>
</div>

<button class="mobile-preview-btn" id="mobilePreviewBtn">👁 Pratinjau</button>
<div class="preview-drawer" id="previewDrawer">
  <div class="preview-drawer-inner">
    <div class="preview-drawer-handle"></div>
    <button class="preview-drawer-close" id="drawerClose">✕</button>
    <div class="preview-inner" style="padding-top:0;">
      <div class="preview-label"><div class="preview-dot"></div>Pratinjau</div>
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

<!-- Data PHP → JS -->
<script>
  window.DB_FORM_SECTIONS = <?= $formSectionsJson ?>;
  window.DEFAULT_PAGES    = <?= $defaultPagesJson ?>;
</script>

<!-- ══ ACARA TEMPLATE (hidden) ══ -->
<template id="acaraBlockTemplate">
  <div class="event-block">
    <div class="event-block-header">
      <span class="event-block-label">Acara 1</span>
      <label class="main-event-radio">
        <input type="radio" name="main_event" value="0" />
        <span class="main-event-badge">⭐ Acara Utama</span>
      </label>
      <button type="button" class="btn-remove-acara" style="display:none;" title="Hapus">✕</button>
    </div>
    <div class="field-grid">
      <div class="field field-full">
        <label>Nama Acara <span class="req">*</span></label>
        <input type="text" name="acara[0][nama]" placeholder="Contoh: Akad, Resepsi" />
      </div>
      <div class="field">
        <label>Tanggal <span class="req">*</span></label>
        <input type="date" name="acara[0][tanggal]" class="acara-date" />
      </div>
      <div class="field">
        <label>Hari</label>
        <input type="text" name="acara[0][hari]" readonly class="acara-day" placeholder="Sabtu" />
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
</template>

<!-- ══ GIFT TEMPLATE (hidden) ══ -->
<template id="giftBlockTemplate">
  <div class="gift-block">
    <div class="gift-block-header">
      <span class="gift-block-label">Gift 1</span>
      <button type="button" class="btn-remove-gift" style="display:none;" title="Hapus">✕</button>
    </div>

    <!-- Type Selector -->
    <div class="gift-type-selector">
      <label class="gift-type-opt">
        <input type="radio" name="gift[0][type]" value="rekening" checked />
        <span class="gift-type-box">
          <span class="gift-type-icon">🏦</span>
          <span class="gift-type-label">Nomor Rekening</span>
        </span>
      </label>
      <label class="gift-type-opt">
        <input type="radio" name="gift[0][type]" value="alamat" />
        <span class="gift-type-box">
          <span class="gift-type-icon">📦</span>
          <span class="gift-type-label">Alamat Pengiriman</span>
        </span>
      </label>
    </div>

    <!-- Fields: Rekening -->
    <div class="gift-fields gift-fields-rekening">
      <div class="field field-full">
        <label>Nama Pemilik Rekening <span class="req">*</span></label>
        <input type="text" name="gift[0][rekening_nama]" placeholder="cth. Ahmad Fauzan" />
      </div>
      <div class="gift-row-2">
        <div class="field">
          <label>Bank <span class="req">*</span></label>
          <input type="text" name="gift[0][rekening_bank]" placeholder="cth. BCA, Mandiri" />
        </div>
        <div class="field">
          <label>Nomor Rekening <span class="req">*</span></label>
          <input type="text" name="gift[0][rekening_nomor]" placeholder="cth. 1234567890" inputmode="numeric" />
        </div>
      </div>
    </div>

    <!-- Fields: Alamat -->
    <div class="gift-fields gift-fields-alamat" style="display:none;">
      <div class="field field-full">
        <label>Nama Penerima <span class="req">*</span></label>
        <input type="text" name="gift[0][alamat_nama]" placeholder="cth. Zahra Aulia" />
      </div>
      <div class="field field-full">
        <label>Alamat Lengkap <span class="req">*</span></label>
        <textarea name="gift[0][alamat_detail]" rows="3" placeholder="Jl. Mawar No. 12, RT 03/RW 05, Kel. Menteng, Jakarta Pusat 10310"></textarea>
      </div>
    </div>
  </div>
</template>

<!-- ══ MEDIA TEMPLATE (hidden) ══ -->
<template id="mediaBlockTemplate">
  <!-- MUSIK -->
  <div class="media-block-musik">
    <div class="field-label-standalone" style="font-size:13px;font-weight:600;color:var(--ink,#1a1a1a);margin-bottom:10px;">Musik Latar</div>
    <div class="music-list">
      <label class="music-item" data-src="assets/music/canon-in-d.mp3">
        <input type="radio" name="music_choice" value="canon-in-d" />
        <div class="music-item-info">
          <div class="music-item-icon">🎵</div>
          <div><div class="music-item-title">Canon in D</div><div class="music-item-artist">Pachelbel</div></div>
        </div>
        <button type="button" class="music-play-btn" title="Preview">▶</button>
      </label>
      <label class="music-item" data-src="assets/music/perfect-edsheeran.mp3">
        <input type="radio" name="music_choice" value="perfect-piano" />
        <div class="music-item-info">
          <div class="music-item-icon">🎵</div>
          <div><div class="music-item-title">Perfect</div><div class="music-item-artist">Ed Sheeran — Piano Cover</div></div>
        </div>
        <button type="button" class="music-play-btn" title="Preview">▶</button>
      </label>
      <label class="music-item" data-src="assets/music/a-thousand-years.mp3">
        <input type="radio" name="music_choice" value="a-thousand-years" />
        <div class="music-item-info">
          <div class="music-item-icon">🎵</div>
          <div><div class="music-item-title">A Thousand Years</div><div class="music-item-artist">Christina Perri — Piano</div></div>
        </div>
        <button type="button" class="music-play-btn" title="Preview">▶</button>
      </label>
      <label class="music-item" data-src="assets/music/symphony.mp3">
        <input type="radio" name="music_choice" value="symphony" />
        <div class="music-item-info">
          <div class="music-item-icon">🎵</div>
          <div><div class="music-item-title">Symphony</div><div class="music-item-artist">Clean Bandit</div></div>
        </div>
        <button type="button" class="music-play-btn" title="Preview">▶</button>
      </label>
      <label class="music-item music-item-none">
        <input type="radio" name="music_choice" value="" checked />
        <div class="music-item-info">
          <div class="music-item-icon">🔇</div>
          <div><div class="music-item-title">Tanpa Musik</div><div class="music-item-artist">Undangan hening</div></div>
        </div>
      </label>
    </div>
    <!-- Mini player -->
    <div class="music-player" id="musicPlayer" style="display:none;margin-top:10px;">
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
  </div>

  <!-- GALLERY -->
  <div class="media-block-gallery" style="margin-top:20px;">
    <div class="field-label-standalone" style="font-size:13px;font-weight:600;color:var(--ink,#1a1a1a);margin-bottom:10px;">Foto Galeri</div>
    <div class="gallery-upload-area">
      <input type="file" id="galleryInput" name="gallery[]" multiple accept="image/jpeg,image/png,image/webp,image/gif" style="position:absolute;width:1px;height:1px;opacity:0;pointer-events:none;" />
      <div class="gallery-drop-zone" id="galleryDropZone" style="cursor:pointer;">
        <div class="gallery-drop-icon">🖼️</div>
        <div class="gallery-drop-text">Klik atau drag foto ke sini</div>
        <div class="gallery-drop-sub">Maksimal <strong id="maxPhotoLabel">10</strong> foto</div>
        <button type="button" class="gallery-pick-btn" id="galleryPickBtn">Pilih Foto</button>
      </div>
      <div class="gallery-preview-grid" id="galleryPreviewGrid" style="margin-top:12px;display:flex;flex-wrap:wrap;gap:8px;"></div>
      <div id="galleryCount" style="font-size:11px;color:var(--ink-soft,#888);margin-top:6px;"></div>
    </div>
  </div>
</template>

<script>
(function () {
  'use strict';

  // ── State ─────────────────────────────────────────────────────────
  let cur      = 0;
  let TOTAL    = 2;
  let pageConfigs = [];   // { section, pageEl, isAcara, isGift, isMedia }

  const DAYS = ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'];

  const wzBody      = document.getElementById('wzBody');
  const wzSteps     = document.getElementById('wzSteps');
  const wzBarFill   = document.getElementById('wzBarFill');
  const btnPrev     = document.getElementById('wzPrev');
  const btnNext     = document.getElementById('wzNext');
  const numEl       = document.getElementById('wzNum');
  const totalEl     = document.getElementById('wzTotal');
  const nameEl      = document.getElementById('wzStepName');
  const dynamicDiv  = document.getElementById('wzDynamicPages');
  const summaryPage = document.getElementById('wzSummaryPage');
  const iframe      = document.getElementById('templateFrame');
  let iframeReady   = false;

  // ════════════════════════════════════════════════════════
  //  1. getPagesForTemplate
  // ════════════════════════════════════════════════════════
  function getPagesForTemplate(templateId) {
    const defaultPages = window.DEFAULT_PAGES || [];
    const db = window.DB_FORM_SECTIONS || {};
    const dbTemplate = db[templateId];

    if (!dbTemplate || Object.keys(dbTemplate).length === 0) {
      return defaultPages;
    }

    const dbMap = {};
    Object.entries(dbTemplate).forEach(([section, rows]) => {
      const key = section.toLowerCase().trim();
      dbMap[key] = {
        section,
        fields_html: rows.map(r => r.form_html).join('\n'),
      };
    });

    const merged = defaultPages.map(defPage => {
      const key = defPage.section.toLowerCase().trim();
      if (dbMap[key]) {
        const replaced = { ...defPage, fields_html: dbMap[key].fields_html };
        delete dbMap[key];
        return replaced;
      }
      return defPage;
    });

    const extraSections = Object.values(dbMap).map(v => ({
      section: v.section,
      fields_html: v.fields_html,
    }));

    if (extraSections.length === 0) return merged;

    const mediaIdx = merged.findLastIndex(p => {
      const { isMedia } = detectSectionType(p.section, p.fields_html);
      return isMedia;
    });

    if (mediaIdx === -1) {
      return [...merged, ...extraSections];
    }

    return [
      ...merged.slice(0, mediaIdx),
      ...extraSections,
      ...merged.slice(mediaIdx),
    ];
  }

  // ════════════════════════════════════════════════════════
  //  2. detectSectionType
  // ════════════════════════════════════════════════════════
  function detectSectionType(section, fieldsHtml) {
    const s = section.toLowerCase();
    const h = fieldsHtml.toLowerCase();

    const isAcara = h.includes('<!-- acara_block -->') ||
                    h.includes('acara[0][nama]') ||
                    h.includes('event-block') ||
                    s.includes('acara') || s.includes('event');

    const isGift  = h.includes('<!-- gift_block -->') ||
                    h.includes('gift[0][type]') ||
                    h.includes('gift-block') ||
                    s.includes('gift') || s.includes('hadiah');

    const isMedia = h.includes('<!-- media_block -->') ||
                    h.includes('music_choice') ||
                    h.includes('music-list') ||
                    h.includes('galleryinput') ||
                    h.includes('gallery[]') ||
                    h.includes('gallery-upload') ||
                    h.includes('gallery-drop-zone') ||
                    s.includes('media') || s.includes('gallery') || s.includes('musik');

    return { isAcara, isGift, isMedia };
  }

  // ════════════════════════════════════════════════════════
  //  3. buildWizard
  // ════════════════════════════════════════════════════════
  function buildWizard(templateId) {
    const pagesData = getPagesForTemplate(templateId);

    dynamicDiv.innerHTML = '';
    pageConfigs = [];

    pagesData.forEach((pd, i) => {
      const pageIdx = i + 1;
      const { isAcara, isGift, isMedia } = detectSectionType(pd.section, pd.fields_html);

      const pageEl = document.createElement('div');
      pageEl.className    = 'wz-page';
      pageEl.dataset.page = String(pageIdx);

      const hd = document.createElement('div');
      hd.className = 'page-hd';
      hd.innerHTML = `
        <div class="page-hd-tag">Langkah ${pageIdx + 1}</div>
        <div class="page-hd-title">${esc(pd.section)}</div>
        <div class="page-hd-desc">&nbsp;</div>`;
      pageEl.appendChild(hd);

      if (isAcara) {
        buildAcaraSection(pageEl);
      } else if (isGift) {
        buildGiftSection(pageEl);
      } else if (isMedia) {
        const mediaWrap = document.createElement('div');
        mediaWrap.className = 'media-section-wrap';
        mediaWrap.style.cssText = 'display:flex;flex-direction:column;gap:24px;padding:0 2px;';
        const tpl   = document.getElementById('mediaBlockTemplate');
        const clone = tpl.content.cloneNode(true);
        mediaWrap.appendChild(clone);
        pageEl.appendChild(mediaWrap);
      } else {
        const grid = document.createElement('div');
        grid.className = 'field-grid';
        grid.innerHTML  = pd.fields_html;
        pageEl.appendChild(grid);
      }

      dynamicDiv.appendChild(pageEl);

      if (isAcara) bindAcaraPage(pageEl);
      if (isGift)  bindGiftPage(pageEl);
      if (isMedia) bindMediaPage(pageEl);

      pageConfigs.push({ section: pd.section, pageEl, isAcara, isGift, isMedia });
    });

    const summaryIdx = 1 + pagesData.length;
    summaryPage.dataset.page = String(summaryIdx);
    document.getElementById('sumStepTag').textContent =
      `Langkah ${summaryIdx + 1} dari ${summaryIdx + 1}`;

    TOTAL = summaryIdx + 1;

    rebuildChips(pagesData);

    dynamicDiv.querySelectorAll('input, textarea, select').forEach(el => {
      const ev = (['date','time','radio','checkbox'].includes(el.type) ||
                  el.tagName === 'SELECT') ? 'change' : 'input';
      el.addEventListener(ev, sendToIframe);
    });

    goTo(1);
  }

  // ════════════════════════════════════════════════════════
  //  4. buildAcaraSection
  // ════════════════════════════════════════════════════════
  function buildAcaraSection(pageEl) {
    const list = document.createElement('div');
    list.id = 'acaraList';
    appendAcaraBlock(list, 0, true);
    pageEl.appendChild(list);

    const addBtn = document.createElement('button');
    addBtn.type      = 'button';
    addBtn.className = 'btn-add-acara';
    addBtn.innerHTML = '<span>＋</span> Tambah Acara';
    pageEl.appendChild(addBtn);
  }

  // ════════════════════════════════════════════════════════
  //  5. appendAcaraBlock
  // ════════════════════════════════════════════════════════
  function appendAcaraBlock(list, idx, isFirst) {
    const tpl   = document.getElementById('acaraBlockTemplate');
    const clone = tpl.content.cloneNode(true);
    const block = clone.querySelector('.event-block');

    block.querySelector('.event-block-label').textContent = `Acara ${idx + 1}`;

    block.querySelectorAll('[name]').forEach(el => {
      if (el.name !== 'main_event') {
        el.name = el.name.replace(/acara\[0\]/, `acara[${idx}]`);
      }
    });

    const radio = block.querySelector('input[name="main_event"]');
    if (radio) {
      radio.value   = idx;
      radio.checked = isFirst;
    }

    block.querySelector('.btn-remove-acara').style.display = 'none';

    list.appendChild(block);
    bindAcaraBlock(block);
    updateAcaraRemoveBtns(list);
  }

  // ════════════════════════════════════════════════════════
  //  6. bindAcaraPage
  // ════════════════════════════════════════════════════════
  function bindAcaraPage(pageEl) {
    const addBtn = pageEl.querySelector('.btn-add-acara');
    if (!addBtn) return;

    addBtn.addEventListener('click', () => {
      const list = pageEl.querySelector('#acaraList');
      if (!list) return;
      const newIdx = list.querySelectorAll('.event-block').length;
      appendAcaraBlock(list, newIdx, false);
      list.lastElementChild?.scrollIntoView({ behavior: 'smooth', block: 'start' });
      sendToIframe();
    });
  }

  // ════════════════════════════════════════════════════════
  //  7. bindAcaraBlock
  // ════════════════════════════════════════════════════════
  function bindAcaraBlock(block) {
    if (!block) return;

    const dateInput = block.querySelector('.acara-date');
    const dayInput  = block.querySelector('.acara-day');

    dateInput?.addEventListener('change', e => {
      dayInput.value = e.target.value
        ? DAYS[new Date(e.target.value + 'T00:00:00').getDay()]
        : '';
      sendToIframe();
    });

    block.querySelectorAll('input, textarea, select').forEach(el => {
      const ev = (['date','time'].includes(el.type) || el.tagName === 'SELECT')
        ? 'change' : 'input';
      el.addEventListener(ev, sendToIframe);
    });

    block.querySelector('.btn-remove-acara')?.addEventListener('click', () => {
      const list = block.closest('#acaraList');
      block.remove();
      reindexAcara(list);
      sendToIframe();
    });
  }

  // ════════════════════════════════════════════════════════
  //  8. reindexAcara
  // ════════════════════════════════════════════════════════
  function reindexAcara(list) {
    if (!list) return;
    list.querySelectorAll('.event-block').forEach((block, i) => {
      block.querySelector('.event-block-label').textContent = `Acara ${i + 1}`;
      block.querySelectorAll('[name]').forEach(el => {
        if (el.name !== 'main_event') {
          el.name = el.name.replace(/acara\[\d+\]/, `acara[${i}]`);
        }
      });
      const radio = block.querySelector('input[name="main_event"]');
      if (radio) radio.value = i;
    });
    updateAcaraRemoveBtns(list);
  }

  function updateAcaraRemoveBtns(list) {
    const blocks = list?.querySelectorAll('.event-block');
    if (!blocks) return;
    blocks.forEach(b => {
      b.querySelector('.btn-remove-acara').style.display =
        blocks.length > 1 ? '' : 'none';
    });
  }

  // ════════════════════════════════════════════════════════
  //  9. buildGiftSection
  // ════════════════════════════════════════════════════════
  function buildGiftSection(pageEl) {
    const list = document.createElement('div');
    list.id = 'giftList';
    appendGiftBlock(list, 0);
    pageEl.appendChild(list);

    const addBtn = document.createElement('button');
    addBtn.type      = 'button';
    addBtn.className = 'btn-add-gift';
    addBtn.innerHTML = '<span>＋</span> Tambah Gift';
    pageEl.appendChild(addBtn);
  }

  // ════════════════════════════════════════════════════════
  //  10. appendGiftBlock
  // ════════════════════════════════════════════════════════
  function appendGiftBlock(list, idx) {
    const tpl   = document.getElementById('giftBlockTemplate');
    const clone = tpl.content.cloneNode(true);
    const block = clone.querySelector('.gift-block');

    block.querySelector('.gift-block-label').textContent = `Gift ${idx + 1}`;

    block.querySelectorAll('[name]').forEach(el => {
      el.name = el.name.replace(/gift\[0\]/, `gift[${idx}]`);
    });

    list.appendChild(block);
    bindGiftBlock(block);
    updateGiftRemoveBtns(list);
  }

  // ════════════════════════════════════════════════════════
  //  11. bindGiftPage
  // ════════════════════════════════════════════════════════
  function bindGiftPage(pageEl) {
    const addBtn = pageEl.querySelector('.btn-add-gift');
    if (!addBtn) return;

    addBtn.addEventListener('click', () => {
      const list = pageEl.querySelector('#giftList');
      if (!list) return;
      const newIdx = list.querySelectorAll('.gift-block').length;
      appendGiftBlock(list, newIdx);
      list.lastElementChild?.scrollIntoView({ behavior: 'smooth', block: 'start' });
      sendToIframe();
    });
  }

  // ════════════════════════════════════════════════════════
  //  12. bindGiftBlock
  // ════════════════════════════════════════════════════════
  function bindGiftBlock(block) {
    if (!block) return;

    // Toggle type
    const radios = block.querySelectorAll('input[type="radio"][name$="[type]"]');
    radios.forEach(radio => {
      radio.addEventListener('change', () => {
        toggleGiftFields(block, radio.value);
        sendToIframe();
      });
    });

    // Set initial visibility
    const checked = block.querySelector('input[type="radio"][name$="[type]"]:checked');
    if (checked) toggleGiftFields(block, checked.value);

    // Input events
    block.querySelectorAll('input:not([type="radio"]), textarea').forEach(el => {
      el.addEventListener('input', sendToIframe);
    });

    // Remove button
    block.querySelector('.btn-remove-gift')?.addEventListener('click', () => {
      const list = block.closest('#giftList');
      block.remove();
      reindexGift(list);
      updateGiftRemoveBtns(list);
      sendToIframe();
    });
  }

  // ════════════════════════════════════════════════════════
  //  13. toggleGiftFields
  // ════════════════════════════════════════════════════════
  function toggleGiftFields(block, type) {
    const rekeningFields = block.querySelector('.gift-fields-rekening');
    const alamatFields   = block.querySelector('.gift-fields-alamat');
    if (!rekeningFields || !alamatFields) return;

    if (type === 'rekening') {
      rekeningFields.style.display = '';
      alamatFields.style.display   = 'none';
      alamatFields.querySelectorAll('input, textarea').forEach(el => el.value = '');
    } else {
      rekeningFields.style.display = 'none';
      alamatFields.style.display   = '';
      rekeningFields.querySelectorAll('input, textarea').forEach(el => el.value = '');
    }
  }

  // ════════════════════════════════════════════════════════
  //  14. reindexGift
  // ════════════════════════════════════════════════════════
  function reindexGift(list) {
    if (!list) return;
    list.querySelectorAll('.gift-block').forEach((block, i) => {
      block.querySelector('.gift-block-label').textContent = `Gift ${i + 1}`;
      block.querySelectorAll('[name]').forEach(el => {
        el.name = el.name.replace(/gift\[\d+\]/, `gift[${i}]`);
      });
    });
  }

  function updateGiftRemoveBtns(list) {
    const blocks = list?.querySelectorAll('.gift-block');
    if (!blocks) return;
    blocks.forEach(b => {
      b.querySelector('.btn-remove-gift').style.display =
        blocks.length > 1 ? '' : 'none';
    });
  }

  // ════════════════════════════════════════════════════════
  //  15. bindMediaPage
  // ════════════════════════════════════════════════════════
  function bindMediaPage(pageEl) {
    initMusicPlayer(pageEl);
    initGalleryUpload(pageEl);
  }

  // ════════════════════════════════════════════════════════
  //  16. rebuildChips
  // ════════════════════════════════════════════════════════
  function rebuildChips(pagesData) {
    wzSteps.innerHTML = '';
    addChip(0, 'Template');
    pagesData.forEach((pd, i) => addChip(i + 1, pd.section));
    addChip(1 + pagesData.length, 'Ringkasan');
    totalEl.textContent = TOTAL;
  }

  function addChip(idx, label) {
    const div = document.createElement('div');
    div.className    = 'wz-chip' + (idx === cur ? ' active' : '');
    div.dataset.step = idx;
    div.innerHTML    = `
      <div class="wz-chip-num"><span class="wz-chip-num-text">${idx + 1}</span></div>
      <span class="wz-chip-label">${esc(label)}</span>`;
    div.addEventListener('click', () => goTo(idx));
    wzSteps.appendChild(div);
  }

  // ════════════════════════════════════════════════════════
  //  17. goTo
  // ════════════════════════════════════════════════════════
  function goTo(next) {
    if (next < 0 || next >= TOTAL) return;

    wzBody.querySelectorAll('.wz-page').forEach(p => {
      if (parseInt(p.dataset.page) === cur ||
          (p === summaryPage && cur === TOTAL - 1)) {
        p.classList.remove('active');
        if (next > cur) {
          p.classList.add('exit-left');
          setTimeout(() => p.classList.remove('exit-left'), 300);
        }
      }
    });

    cur = next;

    const target = wzBody.querySelector(`.wz-page[data-page="${cur}"]`);
    if (target) {
      requestAnimationFrame(() => {
        target.classList.add('active');
        target.scrollTop = 0;
      });
    }

    wzSteps.querySelectorAll('.wz-chip').forEach((c, i) => {
      c.classList.remove('active', 'done');
      if (i < cur)        c.classList.add('done');
      else if (i === cur) c.classList.add('active');
    });

    wzBarFill.style.width = (TOTAL > 1 ? (cur / (TOTAL - 1) * 100) : 0) + '%';
    numEl.textContent   = cur + 1;
    totalEl.textContent = TOTAL;

    const names = ['Template', ...pageConfigs.map(p => p.section), 'Ringkasan'];
    nameEl.textContent    = names[cur] || '';
    btnPrev.style.display = cur === 0 ? 'none' : '';

    if (cur === TOTAL - 1) {
      btnNext.textContent = 'Selesai ✦';
      btnNext.classList.add('finish');
      renderSummary();
    } else {
      btnNext.textContent = 'Lanjut →';
      btnNext.classList.remove('finish');
    }

    wzSteps.querySelector('.wz-chip.active')
      ?.scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'center' });

    sendToIframe();
  }

  // ════════════════════════════════════════════════════════
  //  18. renderSummary
  // ════════════════════════════════════════════════════════
  function renderSummary() {
    document.getElementById('sumTemplate').textContent =
      document.querySelector('.tpl-card.selected .tpl-name')?.textContent || '—';

    const sumDyn = document.getElementById('sumDynamicContent');
    sumDyn.innerHTML = '';

    pageConfigs.forEach(cfg => {
      if (cfg.isAcara || cfg.isGift || cfg.isMedia) return;

      const sec = document.createElement('div');
      sec.className = 'sum-section';
      sec.innerHTML = `<div class="sum-section-title">📋 ${esc(cfg.section)}</div>`;

      const urlEl = cfg.pageEl.querySelector('#urlName');
      if (urlEl) {
        const r = document.createElement('div');
        r.className = 'sum-row';
        r.innerHTML = `<span class="sum-key">URL</span>
          <span class="sum-val"><?=base_url()?>/<span style="color:var(--orange);font-weight:600;">${esc(urlEl.value||'—')}</span></span>`;
        sec.appendChild(r);
      }

      cfg.pageEl.querySelectorAll(
        'input:not([type=radio]):not([type=checkbox]):not([type=file]):not(#urlName), textarea'
      ).forEach(el => {
        if (!el.name) return;
        const label = el.closest('.field')?.querySelector('label')
          ?.textContent.replace('*','').trim() || el.name;
        const r = document.createElement('div');
        r.className = 'sum-row';
        r.innerHTML = `<span class="sum-key">${esc(label)}</span>
          <span class="sum-val sum-val-multiline">${esc(el.value.trim()||'—')}</span>`;
        sec.appendChild(r);
      });

      sumDyn.appendChild(sec);
    });

    // ── Summary Acara ──────────────────────────────────
    const acaraList = document.getElementById('acaraList');
    const sumAcaraSection = document.getElementById('sumAcaraSection');
    if (acaraList) {
      sumAcaraSection.style.display = '';
      const sumAcara = document.getElementById('sumAcaraList');
      sumAcara.innerHTML = '';
      acaraList.querySelectorAll('.event-block').forEach((block, i) => {
        const v = k => block.querySelector(`[name="acara[${i}][${k}]"]`)?.value.trim() || '';
        const d = document.createElement('div');
        d.className = 'sum-acara-block';
        d.innerHTML = `
          <div class="sum-acara-name">📍 ${esc(v('nama') || `Acara ${i+1}`)}</div>
          <div class="sum-acara-detail">
            ${v('hari') ? v('hari') + ', ' : ''}${v('tanggal') || '—'} · ${v('mulai')}–${v('selesai')}<br>
            ${esc(v('tempat') || '—')}<br>${esc(v('alamat'))}
          </div>`;
        sumAcara.appendChild(d);
      });
    } else {
      sumAcaraSection.style.display = 'none';
    }

    // ── Summary Gift ───────────────────────────────────
    const giftList = document.getElementById('giftList');
    const sumGiftSection = document.getElementById('sumGiftSection');
    if (giftList) {
      sumGiftSection.style.display = '';
      const sumGift = document.getElementById('sumGiftList');
      sumGift.innerHTML = '';
      giftList.querySelectorAll('.gift-block').forEach((block, i) => {
        const typeChecked = block.querySelector(`input[name="gift[${i}][type]"]:checked`);
        const type = typeChecked?.value || 'rekening';
        const d = document.createElement('div');
        d.className = 'sum-acara-block';

        if (type === 'rekening') {
          const nama  = block.querySelector(`[name="gift[${i}][rekening_nama]"]`)?.value.trim() || '—';
          const bank  = block.querySelector(`[name="gift[${i}][rekening_bank]"]`)?.value.trim() || '—';
          const nomor = block.querySelector(`[name="gift[${i}][rekening_nomor]"]`)?.value.trim() || '—';
          d.innerHTML = `
            <div class="sum-acara-name">🏦 ${esc(nama)}</div>
            <div class="sum-acara-detail">${esc(bank)} · ${esc(nomor)}</div>`;
        } else {
          const nama   = block.querySelector(`[name="gift[${i}][alamat_nama]"]`)?.value.trim() || '—';
          const alamat = block.querySelector(`[name="gift[${i}][alamat_detail]"]`)?.value.trim() || '—';
          d.innerHTML = `
            <div class="sum-acara-name">📦 ${esc(nama)}</div>
            <div class="sum-acara-detail">${esc(alamat)}</div>`;
        }
        sumGift.appendChild(d);
      });
    } else {
      sumGiftSection.style.display = 'none';
    }

    // ── Summary Musik ──────────────────────────────────
    const mRadio = document.querySelector('input[name="music_choice"]:checked');
    document.getElementById('sumMusik').textContent =
      mRadio?.closest('.music-item')?.querySelector('.music-item-title')?.textContent || 'Tanpa Musik';

    // ── Summary Gallery ────────────────────────────────
    const gc = (window.galleryFiles || []).length;
    const sumMedia = document.getElementById('sumMediaSection');
    sumMedia.querySelectorAll('.sum-row-gallery').forEach(el => el.remove());
    const gr = document.createElement('div');
    gr.className = 'sum-row sum-row-gallery';
    gr.innerHTML = `<span class="sum-key">Foto Galeri</span>
      <span class="sum-val">${gc > 0 ? gc + ' foto dipilih' : '—'}</span>`;
    sumMedia.appendChild(gr);
  }

  // ════════════════════════════════════════════════════════
  //  19. iframe postMessage
  // ════════════════════════════════════════════════════════
  function collectData() {
    const data = {};
    document.querySelectorAll(
      '#wzBody input:not([type=radio]):not([type=checkbox]):not([type=file]), #wzBody textarea'
    ).forEach(el => {
      if (el.id)   data[el.id]   = el.value;
      if (el.name) data[el.name] = el.value;
    });

    // Acara
    const acaraData = [];
    document.querySelectorAll('#acaraList .event-block').forEach((block, i) => {
      acaraData.push({
        nama:    block.querySelector(`[name="acara[${i}][nama]"]`)?.value    || '',
        tanggal: block.querySelector(`[name="acara[${i}][tanggal]"]`)?.value || '',
        hari:    block.querySelector(`[name="acara[${i}][hari]"]`)?.value    || '',
        mulai:   block.querySelector(`[name="acara[${i}][mulai]"]`)?.value   || '',
        selesai: block.querySelector(`[name="acara[${i}][selesai]"]`)?.value || '',
        tempat:  block.querySelector(`[name="acara[${i}][tempat]"]`)?.value  || '',
        alamat:  block.querySelector(`[name="acara[${i}][alamat]"]`)?.value  || '',
        maps:    block.querySelector(`[name="acara[${i}][maps]"]`)?.value    || '',
      });
    });
    data.acara_list = acaraData;

    // Gift
    const giftData = [];
    document.querySelectorAll('#giftList .gift-block').forEach((block, i) => {
      const typeChecked = block.querySelector(`input[name="gift[${i}][type]"]:checked`);
      const type = typeChecked?.value || 'rekening';
      const item = { type };
      if (type === 'rekening') {
        item.rekening_nama  = block.querySelector(`[name="gift[${i}][rekening_nama]"]`)?.value  || '';
        item.rekening_bank  = block.querySelector(`[name="gift[${i}][rekening_bank]"]`)?.value  || '';
        item.rekening_nomor = block.querySelector(`[name="gift[${i}][rekening_nomor]"]`)?.value || '';
      } else {
        item.alamat_nama   = block.querySelector(`[name="gift[${i}][alamat_nama]"]`)?.value   || '';
        item.alamat_detail = block.querySelector(`[name="gift[${i}][alamat_detail]"]`)?.value || '';
      }
      giftData.push(item);
    });
    data.gift_list = giftData;

    data.music_choice = document.querySelector('input[name="music_choice"]:checked')?.value || '';
    return data;
  }

  function sendToIframe() {
    if (!iframeReady || !iframe?.contentWindow) return;
    try { iframe.contentWindow.postMessage({ type: 'updateForm', data: collectData() }, '*'); }
    catch(e) {}
  }

  function loadTemplate(filename) {
    iframeReady = false;
    iframe.src  = `/cek-template/load/${filename}`;
    iframe.onload = () => { iframeReady = true; sendToIframe(); };
  }

  window.addEventListener('message', e => {
    if (e.data?.type === 'iframeReady') { iframeReady = true; sendToIframe(); }
  });

  // ════════════════════════════════════════════════════════
  //  20. Template picker
  // ════════════════════════════════════════════════════════
  document.querySelectorAll('.tpl-card').forEach(card => {
    card.addEventListener('click', function () {
      document.querySelectorAll('.tpl-card').forEach(c => c.classList.remove('selected'));
      this.classList.add('selected');
      this.querySelector('input[type="radio"]').checked = true;

      const { name, filename, id: tplId, maxPhoto } = this.dataset;
      document.getElementById('previewTplName').textContent = name;
      if (window.gallerySetMax) window.gallerySetMax(parseInt(maxPhoto) || 10);

      buildWizard(tplId);
      if (filename) loadTemplate(filename);
    });
  });

  // ════════════════════════════════════════════════════════
  //  21. Next / Prev
  // ════════════════════════════════════════════════════════
  btnPrev.addEventListener('click', () => goTo(cur - 1));

  btnNext.addEventListener('click', () => {
    if (cur === TOTAL - 1) {
      const form     = document.getElementById('undanganForm');
      const formData = new FormData(form);
      formData.delete('gallery[]');
      (window.galleryFiles || []).forEach(f => formData.append('gallery[]', f));
      fetch('<?=base_url('buat-undangan/save')?>', { method: 'POST', body: formData })
        .then(r => r.text())
        .then(html => { document.open(); document.write(html); document.close(); })
        .catch(err => console.error(err));
    } else {
      goTo(cur + 1);
    }
  });

  // ════════════════════════════════════════════════════════
  //  22. Mobile drawer
  // ════════════════════════════════════════════════════════
  document.getElementById('mobilePreviewBtn')?.addEventListener('click', () =>
    document.getElementById('previewDrawer').classList.add('open'));
  document.getElementById('drawerClose')?.addEventListener('click', () =>
    document.getElementById('previewDrawer').classList.remove('open'));
  document.getElementById('previewDrawer')?.addEventListener('click', function(e) {
    if (e.target === this) this.classList.remove('open');
  });

  // ════════════════════════════════════════════════════════
  //  23. Music player
  // ════════════════════════════════════════════════════════
  function initMusicPlayer(pageEl) {
    let audio = null, activeItem = null;
    const player      = pageEl.querySelector('#musicPlayer');
    const playerTitle = pageEl.querySelector('#musicPlayerTitle');
    const playPauseBtn= pageEl.querySelector('#musicPlayPause');
    const stopBtn     = pageEl.querySelector('#musicStop');
    const progressFill= pageEl.querySelector('#musicProgressFill');
    const timeEl      = pageEl.querySelector('#musicTime');

    function fmt(s) {
      return `${Math.floor(s/60)}:${String(Math.floor(s%60)).padStart(2,'0')}`;
    }
    function stopAll() {
      if (audio) { audio.pause(); audio.currentTime = 0; }
      if (progressFill) progressFill.style.width = '0%';
      if (timeEl)       timeEl.textContent = '0:00';
      if (playPauseBtn) playPauseBtn.textContent = '▶';
      if (player)       player.style.display = 'none';
      pageEl.querySelectorAll('.music-play-btn').forEach(b => b.classList.remove('active'));
      pageEl.querySelectorAll('.music-item').forEach(b => b.classList.remove('playing'));
      activeItem = null;
    }
    function play(item) {
      if (!item.dataset.src) return;
      if (activeItem === item) {
        audio.paused ? (audio.play(), playPauseBtn && (playPauseBtn.textContent='⏸'))
                     : (audio.pause(), playPauseBtn && (playPauseBtn.textContent='▶'));
        return;
      }
      stopAll(); activeItem = item;
      audio = new Audio(item.dataset.src);
      audio.addEventListener('timeupdate', () => {
        if (!audio.duration) return;
        if (progressFill) progressFill.style.width = (audio.currentTime/audio.duration*100)+'%';
        if (timeEl)       timeEl.textContent = fmt(audio.currentTime);
      });
      audio.addEventListener('ended', stopAll);
      audio.play().catch(()=>{});
      if (playerTitle)  playerTitle.textContent =
        `${item.querySelector('.music-item-title')?.textContent||'—'} — ${item.querySelector('.music-item-artist')?.textContent||''}`;
      if (playPauseBtn) playPauseBtn.textContent = '⏸';
      if (player)       player.style.display = '';
      item.querySelector('.music-play-btn')?.classList.add('active');
      item.classList.add('playing');
    }

    pageEl.querySelectorAll('.music-item').forEach(item => {
      const playBtn = item.querySelector('.music-play-btn');
      if (playBtn) {
        playBtn.addEventListener('click', e => {
          e.preventDefault();
          e.stopImmediatePropagation();
          play(item);
        });
      }
      item.addEventListener('click', e => {
        if (e.target.closest('.music-play-btn')) return;
        setTimeout(() => { stopAll(); sendToIframe(); }, 0);
      });
    });
    playPauseBtn?.addEventListener('click', () => {
      if (!audio || !activeItem) return;
      audio.paused ? (audio.play(), (playPauseBtn.textContent='⏸'))
                   : (audio.pause(),(playPauseBtn.textContent='▶'));
    });
    stopBtn?.addEventListener('click', stopAll);
    pageEl.querySelector('.music-progress-bar')?.addEventListener('click', e => {
      if (!audio?.duration) return;
      const r = e.currentTarget.getBoundingClientRect();
      audio.currentTime = ((e.clientX-r.left)/r.width)*audio.duration;
    });
    pageEl.querySelectorAll('.music-item input[type="radio"]').forEach(r =>
      r.addEventListener('change', () => { stopAll(); sendToIframe(); }));
  }

  // ════════════════════════════════════════════════════════
  //  24. Gallery upload
  // ════════════════════════════════════════════════════════
  function initGalleryUpload(pageEl) {
    const input       = pageEl.querySelector('#galleryInput');
    const dropZone    = pageEl.querySelector('#galleryDropZone');
    const pickBtn     = pageEl.querySelector('#galleryPickBtn');
    const previewGrid = pageEl.querySelector('#galleryPreviewGrid');
    const countEl     = pageEl.querySelector('#galleryCount');
    const maxLabel    = pageEl.querySelector('#maxPhotoLabel');

    if (!input) {
      console.warn('[Gallery] #galleryInput tidak ditemukan di pageEl', pageEl);
      return;
    }

    let MAX = parseInt(document.querySelector('.tpl-card.selected')?.dataset.maxPhoto) || 10;
    let files = [];

    Object.defineProperty(window, 'galleryFiles', { get: () => files, configurable: true });

    window.gallerySetMax = max => {
      MAX = parseInt(max) || 10;
      if (maxLabel) maxLabel.textContent = MAX;
      updateCount();
    };

    function updateCount() {
      if (countEl) countEl.textContent = files.length
        ? `${files.length} / ${MAX} foto dipilih` : '';
    }

    function addFiles(newFiles) {
      const rem = MAX - files.length;
      if (rem <= 0) { alert(`Maksimal ${MAX} foto.`); return; }
      const arr   = Array.from(newFiles);
      const toAdd = arr.slice(0, rem);
      if (arr.length > rem) alert(`Hanya ${rem} foto lagi yang bisa ditambahkan.`);
      toAdd.forEach(f => files.push(f));
      renderPreviews();
      updateCount();
    }

    function renderPreviews() {
      if (!previewGrid) return;
      previewGrid.innerHTML = '';
      files.forEach((file, idx) => {
        const reader = new FileReader();
        reader.onload = ev => {
          const wrap = document.createElement('div');
          wrap.className = 'gallery-thumb';
          wrap.innerHTML = `
            <img src="${ev.target.result}" alt="foto ${idx+1}" />
            <button type="button" class="gallery-thumb-remove" title="Hapus">✕</button>
            <div class="gallery-thumb-num">${idx + 1}</div>`;
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

    pickBtn?.addEventListener('click', e => {
      e.preventDefault();
      e.stopPropagation();
      input.click();
    });

    input.addEventListener('change', () => {
      if (input.files.length) addFiles(input.files);
      input.value = '';
    });

    dropZone?.addEventListener('dragover', e => {
      e.preventDefault();
      dropZone.classList.add('drag-over');
    });
    dropZone?.addEventListener('dragleave', () => {
      dropZone.classList.remove('drag-over');
    });
    dropZone?.addEventListener('drop', e => {
      e.preventDefault();
      dropZone.classList.remove('drag-over');
      if (e.dataTransfer.files.length) addFiles(e.dataTransfer.files);
    });

    dropZone?.addEventListener('click', e => {
      if (e.target.closest('.gallery-pick-btn')) return;
      input.click();
    });

    if (maxLabel) maxLabel.textContent = MAX;
  }

  // ════════════════════════════════════════════════════════
  //  25. showToast (global)
  // ════════════════════════════════════════════════════════
  window.showToast = function(type, title, items) {
    let stack = document.getElementById('toastStack');
    if (!stack) {
      stack = Object.assign(document.createElement('div'),
        { id: 'toastStack', className: 'toast-stack' });
      document.body.appendChild(stack);
    }
    const toast = document.createElement('div');
    toast.className = `toast toast-${type}`;
    toast.innerHTML = `
      <div class="toast-icon">${type==='error'?'✕':'✓'}</div>
      <div class="toast-body">
        <p class="toast-title">${title}</p>
        ${(items||[]).length ? '<ul class="toast-list">'+items.map(i=>`<li>${i}</li>`).join('')+'</ul>' : ''}
      </div>
      <button class="toast-close" onclick="this.closest('.toast').remove()">✕</button>`;
    stack.appendChild(toast);
    setTimeout(() => toast.remove(), 6000);
  };

  // ── Helper ─────────────────────────────────────────────
  function esc(s) {
    if (!s) return '';
    return String(s).replace(/&/g,'&amp;').replace(/</g,'&lt;')
                    .replace(/>/g,'&gt;').replace(/"/g,'&quot;');
  }

  // Init state
  totalEl.textContent = '?';

})();
</script>

<!-- ══ URL VALIDATION ══ -->
<script>
function validateUrlSlug(slug) {
  if (!slug)            return { valid:false, message:'URL tidak boleh kosong' };
  if (slug.length < 3)  return { valid:false, message:'URL minimal 3 karakter' };
  if (slug.length > 100)return { valid:false, message:'URL maksimal 100 karakter' };
  if (!/^[a-z0-9\-_]+$/.test(slug)) return { valid:false, message:'Hanya huruf kecil, angka, dash, underscore' };
  if (/^[-_]|[-_]$/.test(slug))     return { valid:false, message:'Tidak boleh diawali/diakhiri dash atau underscore' };
  if (/--|__|_-|-_/.test(slug))      return { valid:false, message:'Tidak boleh karakter ganda' };
  if (/^\d+$/.test(slug))            return { valid:false, message:'Tidak boleh hanya angka' };
  if (['index','create','edit','delete','update','store','show',
       'admin','api','login','register','dashboard','user','users'].includes(slug))
    return { valid:false, message:'URL ini kata terlarang' };
  return { valid:true };
}
function autoFormatUrl(input) {
  input.value = input.value.toLowerCase()
    .replace(/\s+/g,'-').replace(/[^a-z0-9\-_]/g,'')
    .replace(/-{2,}/g,'-').replace(/_{2,}/g,'_');
}
async function checkAvailability(slug) {
  if (!slug || slug.length < 3) return;
  try {
    const res  = await fetch(`<?=base_url('/check-url')?>?slug=${encodeURIComponent(slug)}`);
    const data = await res.json();
    const urlEl = document.getElementById('urlName');
    const errEl = document.getElementById('urlError');
    const okEl  = document.getElementById('urlSuccess');
    if (!urlEl) return;
    if (data.available) {
      urlEl.classList.remove('is-invalid'); urlEl.classList.add('is-valid');
      if (errEl) errEl.style.display = 'none';
      if (okEl)  { okEl.style.display='block'; okEl.innerHTML='✓ URL tersedia!'; }
    } else {
      urlEl.classList.remove('is-valid'); urlEl.classList.add('is-invalid');
      if (okEl)  okEl.style.display = 'none';
      if (errEl) { errEl.style.display='block'; errEl.innerHTML=data.message||'URL sudah digunakan'; }
    }
  } catch(e) { console.error(e); }
}
document.addEventListener('input', e => {
  if (e.target.id !== 'urlName') return;
  autoFormatUrl(e.target);
  const vld = validateUrlSlug(e.target.value);
  const preview = document.getElementById('urlPreview');
  if (preview) preview.textContent = e.target.value || 'nama-undangan';
  const errEl = document.getElementById('urlError');
  const okEl  = document.getElementById('urlSuccess');
  if (!vld.valid) {
    e.target.classList.remove('is-valid'); e.target.classList.add('is-invalid');
    if (errEl) { errEl.style.display='block'; errEl.innerHTML='✗ '+vld.message; }
    if (okEl)    okEl.style.display='none';
  } else {
    e.target.classList.remove('is-invalid');
    if (errEl) errEl.style.display='none';
  }
});
document.addEventListener('blur', e => {
  if (e.target.id !== 'urlName') return;
  if (validateUrlSlug(e.target.value).valid) checkAvailability(e.target.value);
}, true);
</script>

<!-- ══ VALIDASI PER STEP ══ -->
<script>
(function () {
  function markError(el) {
    const wrap = el.closest?.('.field');
    if (wrap) wrap.classList.add('field-error','field-shake');
    setTimeout(() => wrap?.classList.remove('field-shake'), 400);
    ['input','change'].forEach(ev =>
      el.addEventListener(ev, () => wrap?.classList.remove('field-error'), { once:true }));
  }

  function validateCurrentPage() {
    const page = document.querySelector('.wz-page.active');
    if (!page) return [];
    const errors = [];

    // Validasi required standar
    page.querySelectorAll('input[required], select[required], textarea[required]').forEach(el => {
      if (!el.value.trim()) {
        const label = el.closest('.field')?.querySelector('label')
          ?.textContent.replace('*','').trim() || el.name;
        errors.push({ label: `${label} wajib diisi`, el });
      }
    });

    // Validasi URL
    const urlEl = page.querySelector('#urlName');
    if (urlEl) {
      const errEl = page.querySelector('#urlError');
      if (!urlEl.value.trim())
        errors.push({ label:'URL Undangan wajib diisi', el:urlEl });
      else if (urlEl.classList.contains('is-invalid'))
        errors.push({ label:'URL tidak valid atau sudah dipakai', el:urlEl });
      else if (errEl?.style.display !== 'none' && errEl?.textContent.trim())
        errors.push({ label: errEl.textContent.replace(/^[✗✕]\s*/,'').trim(), el:urlEl });
    }

    // Validasi Gift — hanya field yang visible
    page.querySelectorAll('.gift-block').forEach((block, i) => {
      const typeChecked = block.querySelector(`input[name="gift[${i}][type]"]:checked`);
      const type = typeChecked?.value || 'rekening';

      if (type === 'rekening') {
        const fields = [
          { name: `gift[${i}][rekening_nama]`,  label: 'Nama Pemilik Rekening' },
          { name: `gift[${i}][rekening_bank]`,  label: 'Bank' },
          { name: `gift[${i}][rekening_nomor]`, label: 'Nomor Rekening' },
        ];
        fields.forEach(f => {
          const el = block.querySelector(`[name="${f.name}"]`);
          if (el && !el.value.trim()) errors.push({ label: `${f.label} wajib diisi (Gift ${i+1})`, el });
        });
      } else {
        const fields = [
          { name: `gift[${i}][alamat_nama]`,   label: 'Nama Penerima' },
          { name: `gift[${i}][alamat_detail]`, label: 'Alamat Lengkap' },
        ];
        fields.forEach(f => {
          const el = block.querySelector(`[name="${f.name}"]`);
          if (el && !el.value.trim()) errors.push({ label: `${f.label} wajib diisi (Gift ${i+1})`, el });
        });
      }
    });

    return errors;
  }

  document.getElementById('wzNext')?.addEventListener('click', function(e) {
    const page = document.querySelector('.wz-page.active');
    if (!page) return;

    if (page.dataset.page === '0') {
      if (!document.querySelector('input[name="template_id"]:checked')) {
        e.stopImmediatePropagation();
        window.showToast?.('error','Pilih template terlebih dahulu',[]);
      }
      return;
    }
    if (page === document.getElementById('wzSummaryPage')) return;

    const errors = validateCurrentPage();
    if (!errors.length) return;
    e.stopImmediatePropagation();
    errors.forEach(err => { if (err.el?.tagName !== 'DIV') markError(err.el); });
    window.showToast?.('error', `${errors.length} field wajib belum diisi`, errors.map(e=>e.label));
  }, true);
})();
</script>

</body>
</html>