<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Edit Undangan — KlikSampaiSah</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=DM+Sans:ital,wght@0,300;0,400;0,500;0,600;1,400&family=Cormorant+Garamond:ital,wght@0,400;1,400&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="<?=base_url()?>assets/css/style-buat-undangan.css" />
  <link rel="stylesheet" href="<?=base_url()?>assets/css/buat-undangan.css" />
  <style>
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
    .field-error input, .field-error textarea, .field-error select {
      border-color: #E24B4A !important; background: #fff8f8;
    }
    .field-shake { animation: shake .3s ease; }
    @keyframes shake {
      0%, 100% { transform: translateX(0); }
      25%       { transform: translateX(-4px); }
      75%       { transform: translateX(4px); }
    }
  </style>
</head>
<body>

<?php
/**
 * DATA DARI CONTROLLER (edit mode):
 * - $undangan_id            : int
 * - $url_name               : string
 * - $current_template       : int (template_id aktif)
 * - $current_template_name  : string
 * - $current_max_photo      : int
 * - $templates              : array of template rows
 * - $formSections           : array grouped by template_id → section → rows
 * - $existingParams         : array [ param_name => param_value ] dari undangan_param
 * - $groom_name, $groom_nickname, $bride_name, $bride_nickname : string
 * - $acara                  : array of acara rows
 * - $gallery                : array of file paths (existing)
 * - $gift                   : array of gift rows (existing)  ← BARU
 * - $music_choice           : string
 */

function epv($existingParams, $key, $default = '') {
    return old($key, $existingParams[$key] ?? $default);
}

$defaultPages = [
  [
    'section'     => 'Info',
    'fields_html' => '
      <div class="field field-full">
        <label>URL Undangan <span class="req">*</span></label>
        <input type="text" id="urlName" name="url_name"
          value="'.esc($url_name ?? '').'"
          style="background-color:#e6e6e6" disabled autocomplete="off" />
        <input type="hidden" name="url_name" value="'.esc($url_name ?? '').'" />
        <span style="font-size:11px;color:var(--ink-soft);margin-top:2px;">'.base_url().'<span id="urlPreview" style="color:var(--orange);font-weight:600;">'.esc($url_name ?? 'nama-undangan').'</span></span>
      </div>
      <div class="field field-full">
        <label>Judul Undangan</label>
        <input type="text" id="judulUndangan" name="judul_undangan"
          placeholder="cth. Pernikahan Rizal &amp; Ayu"
          value="'.epv($existingParams ?? [], 'judul_undangan').'" />
      </div>
      <div class="field field-full">
        <label>Keterangan</label>
        <textarea id="keterangan" name="keterangan" rows="3"
          placeholder="Dengan penuh syukur dan kebahagiaan, kami...">'.epv($existingParams ?? [], 'keterangan').'</textarea>
      </div>',
  ],
  [
    'section'     => 'The Couple',
    'fields_html' => '
      <div class="field">
        <label>Nama Pengantin Pria <span class="req">*</span></label>
        <input type="text" id="groomName" name="groom_name"
          placeholder="cth. Muhammad Rizal"
          value="'.esc(old('groom_name', $groom_name ?? '')).'" />
      </div>
      <div class="field">
        <label>Nama Pengantin Wanita <span class="req">*</span></label>
        <input type="text" id="brideName" name="bride_name"
          placeholder="cth. Ayu Wijaya"
          value="'.esc(old('bride_name', $bride_name ?? '')).'" />
      </div>
      <div class="field">
        <label>Panggilan Pria</label>
        <input type="text" id="groomNickname" name="groom_nickname"
          placeholder="cth. Rizal"
          value="'.esc(old('groom_nickname', $groom_nickname ?? '')).'" />
      </div>
      <div class="field">
        <label>Panggilan Wanita</label>
        <input type="text" id="brideNickname" name="bride_nickname"
          placeholder="cth. Ayu"
          value="'.esc(old('bride_nickname', $bride_nickname ?? '')).'" />
      </div>
      <div class="field">
        <label>Ayah Pengantin Pria</label>
        <input type="text" id="groomFather" name="groom_father"
          placeholder="Bpk. Ahmad Santoso"
          value="'.epv($existingParams ?? [], 'groom_father').'" />
      </div>
      <div class="field">
        <label>Ayah Pengantin Wanita</label>
        <input type="text" id="brideFather" name="bride_father"
          placeholder="Bpk. Hendra Kusuma"
          value="'.epv($existingParams ?? [], 'bride_father').'" />
      </div>
      <div class="field">
        <label>Ibu Pengantin Pria</label>
        <input type="text" id="groomMother" name="groom_mother"
          placeholder="Ibu Siti Rahayu"
          value="'.epv($existingParams ?? [], 'groom_mother').'" />
      </div>
      <div class="field">
        <label>Ibu Pengantin Wanita</label>
        <input type="text" id="brideMother" name="bride_mother"
          placeholder="Ibu Dewi Lestari"
          value="'.epv($existingParams ?? [], 'bride_mother').'" />
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

$existingParamsJson  = json_encode($existingParams  ?? [], JSON_HEX_TAG | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
$formSectionsJson    = json_encode($formSections    ?? [], JSON_HEX_TAG | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
$defaultPagesJson    = json_encode($defaultPages,          JSON_HEX_TAG | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
$acaraJson           = json_encode($acara           ?? [], JSON_HEX_TAG | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
$galleryJson         = json_encode($gallery         ?? [], JSON_HEX_TAG | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
$giftJson            = json_encode($gift            ?? [], JSON_HEX_TAG | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
$musicChoice         = esc($music_choice            ?? '');
$currentTemplateId   = (int) ($current_template     ?? 0);
$currentMaxPhoto     = (int) ($current_max_photo    ?? 10);
?>

<!-- ══ TOP BAR ══ -->
<header class="topbar">
  <a href="<?=base_url('dashboard')?>" class="topbar-back">
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
    <button type="button" class="btn-draft" id="btnUpdate">Update</button>
    <a href="<?=base_url('undangan/'.($url_name ?? ''))?>" class="btn-publish" target="_blank">Lihat Undangan ✦</a>
  </div>
</header>

<div class="app">

  <form id="undanganForm" action="<?=base_url('undangan/update/'.($undangan_id ?? ''))?>" method="POST" enctype="multipart/form-data">
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
            <label class="tpl-card <?= $current_template == $template['id'] ? 'selected' : '' ?>"
              data-tpl="<?=$template['id']?>"
              data-filename="<?=esc($template['file_path'])?>"
              data-id="<?=$template['id']?>"
              data-name="<?=esc($template['template_name'])?>"
              data-max-photo="<?=$template['max_photo'] ?? 10?>">
              <input type="radio" name="template_id" value="<?=$template['id']?>"
                <?= $current_template == $template['id'] ? 'checked' : '' ?>>
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
        </div>
      </div>

      <!-- PAGE DINAMIS (diisi JS) -->
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
          <!-- sumGiftSection disisipkan oleh JS di sini -->
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
      <div class="preview-tpl-name" id="previewTplName"><?= esc($current_template_name ?? '—') ?></div>
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

<!-- ══ GIFT BLOCK TEMPLATE (hidden) ══ -->
<template id="giftBlockTemplate">
  <div class="gift-block">
    <div class="gift-block-header">
      <span class="gift-block-label">Gift 1</span>
      <button type="button" class="btn-remove-gift" style="display:none;">✕ Hapus</button>
    </div>
    <div class="gift-type-selector">
      <label class="gift-type-opt">
        <input type="radio" name="gift[0][type]" value="rekening" checked />
        <div class="gift-type-box">
          <div class="gift-type-icon">🏦</div>
          <div class="gift-type-label">Transfer<br>Rekening</div>
        </div>
      </label>
      <label class="gift-type-opt">
        <input type="radio" name="gift[0][type]" value="alamat" />
        <div class="gift-type-box">
          <div class="gift-type-icon">📦</div>
          <div class="gift-type-label">Kirim ke<br>Alamat</div>
        </div>
      </label>
    </div>
    <div class="gift-fields gift-rekening-fields">
      <div class="field">
        <label>Nama Pemilik Rekening</label>
        <input type="text" name="gift[0][rekening_nama]" placeholder="cth. Ahmad Fauzan" />
      </div>
      <div class="field">
        <label>Bank</label>
        <input type="text" name="gift[0][rekening_bank]" placeholder="cth. BCA, Mandiri, BNI" />
      </div>
      <div class="field">
        <label>Nomor Rekening</label>
        <input type="text" name="gift[0][rekening_nomor]" placeholder="cth. 1234567890" />
      </div>
    </div>
    <div class="gift-fields gift-alamat-fields" style="display:none;">
      <div class="field">
        <label>Nama Penerima</label>
        <input type="text" name="gift[0][alamat_nama]" placeholder="cth. Rumah Mempelai Wanita" />
      </div>
      <div class="field">
        <label>Alamat Lengkap</label>
        <textarea name="gift[0][alamat_detail]" rows="3" placeholder="Jl. Mawar No. 12..."></textarea>
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
      <input type="file" id="galleryInput" name="gallery[]" multiple accept="image/jpeg,image/png,image/webp,image/gif"
        style="position:absolute;width:1px;height:1px;opacity:0;pointer-events:none;" />
      <div id="existingGalleryInputs"></div>
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

<!-- ══ DATA PHP → JS ══ -->
<script>
  window.DB_FORM_SECTIONS  = <?= $formSectionsJson ?>;
  window.DEFAULT_PAGES     = <?= $defaultPagesJson ?>;
  window.EXISTING_PARAMS   = <?= $existingParamsJson ?>;
  window.EXISTING_ACARA    = <?= $acaraJson ?>;
  window.EXISTING_GALLERY  = <?= $galleryJson ?>;
  window.EXISTING_GIFT     = <?= $giftJson ?>;
  window.CURRENT_MUSIC     = <?= json_encode($musicChoice) ?>;
  window.CURRENT_TEMPLATE  = <?= $currentTemplateId ?>;
  window.CURRENT_MAX_PHOTO = <?= $currentMaxPhoto ?>;
  window.IS_EDIT_MODE      = true;
</script>

<script>
(function () {
  'use strict';

  // ── State ─────────────────────────────────────────────────────────
  let cur         = 0;
  let TOTAL       = 2;
  let pageConfigs = [];

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
    const db           = window.DB_FORM_SECTIONS || {};
    const dbTemplate   = db[templateId];

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

    if (mediaIdx === -1) return [...merged, ...extraSections];

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
    const s = (section    || '').toLowerCase();
    const h = (fieldsHtml || '').toLowerCase();

    const isAcara = h.includes('<!-- acara_block -->') ||
                    h.includes('acara[0][nama]') ||
                    h.includes('event-block') ||
                    s.includes('acara') || s.includes('event');

    const isGift  = h.includes('<!-- gift_block -->') ||
                    h.includes('gift[0][type]') ||
                    h.includes('gift-block') ||
                    s === 'gift' || s === 'hadiah' || s === 'kado';

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

      // Bind events
      if (isAcara) {
        bindAcaraPage(pageEl);
      } else if (isGift) {
        bindGiftPage(pageEl);
      } else if (isMedia) {
        requestAnimationFrame(() => {
          prefillMusic(pageEl);
          bindMediaPage(pageEl);
        });
      } else {
        prefillCustomFields(pageEl);
      }

      pageConfigs.push({ section: pd.section, pageEl, isAcara, isGift, isMedia });
    });

    // Summary index
    const summaryIdx = 1 + pagesData.length;
    summaryPage.dataset.page = String(summaryIdx);
    document.getElementById('sumStepTag').textContent =
      `Langkah ${summaryIdx + 1} dari ${summaryIdx + 1}`;

    TOTAL = summaryIdx + 1;

    rebuildChips(pagesData);

    // Bind semua input baru → iframe
    dynamicDiv.querySelectorAll('input, textarea, select').forEach(el => {
      const ev = (['date','time','radio','checkbox'].includes(el.type) ||
                  el.tagName === 'SELECT') ? 'change' : 'input';
      el.addEventListener(ev, sendToIframe);
    });

    // Edit mode: langsung loncat ke step 1
    goTo(1);
  }

  // ════════════════════════════════════════════════════════
  //  4. prefillCustomFields
  // ════════════════════════════════════════════════════════
  function prefillCustomFields(pageEl) {
    const params = window.EXISTING_PARAMS || {};
    pageEl.querySelectorAll(
      'input[name]:not([type=radio]):not([type=checkbox]):not([type=file]), textarea[name], select[name]'
    ).forEach(el => {
      const name = el.name;
      if (el.value && el.value.trim()) return;
      if (params[name] !== undefined && params[name] !== '') {
        el.value = params[name];
      }
    });
  }

  // ════════════════════════════════════════════════════════
  //  5. prefillMusic
  // ════════════════════════════════════════════════════════
  function prefillMusic(pageEl) {
    const current = window.CURRENT_MUSIC || '';
    pageEl.querySelectorAll('input[name="music_choice"]').forEach(radio => {
      radio.checked = (radio.value === current);
      if (radio.checked) {
        radio.closest('.music-item')?.classList.add('playing');
      }
    });
  }

  // ════════════════════════════════════════════════════════
  //  6. buildAcaraSection
  // ════════════════════════════════════════════════════════
  function buildAcaraSection(pageEl) {
    const list = document.createElement('div');
    list.id = 'acaraList';

    const existingAcara = window.EXISTING_ACARA || [];

    if (existingAcara.length > 0) {
      existingAcara.forEach((item, idx) => {
        appendAcaraBlock(list, idx, idx === 0, item);
      });
    } else {
      appendAcaraBlock(list, 0, true, null);
    }

    pageEl.appendChild(list);

    const addBtn = document.createElement('button');
    addBtn.type      = 'button';
    addBtn.className = 'btn-add-acara';
    addBtn.innerHTML = '<span>＋</span> Tambah Acara';
    pageEl.appendChild(addBtn);
  }

  // ════════════════════════════════════════════════════════
  //  7. appendAcaraBlock
  // ════════════════════════════════════════════════════════
  function appendAcaraBlock(list, idx, isFirst, data) {
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
      radio.checked = data ? (data.main_event == 1) : isFirst;
    }

    if (data) {
      const fields = ['nama','tanggal','hari','mulai','selesai','tempat','alamat','maps'];
      fields.forEach(key => {
        const el = block.querySelector(`[name="acara[${idx}][${key}]"]`);
        if (el && data[key]) {
          if (el.tagName === 'TEXTAREA') el.textContent = data[key];
          else el.value = data[key];
        }
      });
    }

    block.querySelector('.btn-remove-acara').style.display = 'none';

    list.appendChild(block);
    bindAcaraBlock(block);
    updateAcaraRemoveBtns(list);
  }

  // ════════════════════════════════════════════════════════
  //  8. bindAcaraPage
  // ════════════════════════════════════════════════════════
  function bindAcaraPage(pageEl) {
    const addBtn = pageEl.querySelector('.btn-add-acara');
    if (!addBtn) return;

    addBtn.addEventListener('click', () => {
      const list   = pageEl.querySelector('#acaraList');
      if (!list) return;
      const newIdx = list.querySelectorAll('.event-block').length;
      appendAcaraBlock(list, newIdx, false, null);
      list.lastElementChild?.scrollIntoView({ behavior: 'smooth', block: 'start' });
      sendToIframe();
    });
  }

  // ════════════════════════════════════════════════════════
  //  9. bindAcaraBlock
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
  //  10. reindexAcara
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
  //  11. buildGiftSection  ← BARU
  // ════════════════════════════════════════════════════════
  function buildGiftSection(pageEl) {
    const list = document.createElement('div');
    list.id = 'giftList';

    const existingGift = window.EXISTING_GIFT || [];

    if (existingGift.length > 0) {
      existingGift.forEach((item, idx) => appendGiftBlock(list, idx, item));
    } else {
      appendGiftBlock(list, 0, null);
    }

    pageEl.appendChild(list);

    const addBtn = document.createElement('button');
    addBtn.type      = 'button';
    addBtn.className = 'btn-add-gift';
    addBtn.innerHTML = '<span>＋</span> Tambah Rekening / Alamat';
    pageEl.appendChild(addBtn);
  }

  // ════════════════════════════════════════════════════════
  //  12. appendGiftBlock  ← BARU
  //  data = null → kosong; data = { type, rekening_nama, ... }
  // ════════════════════════════════════════════════════════
  function appendGiftBlock(list, idx, data) {
    const tpl   = document.getElementById('giftBlockTemplate');
    const clone = tpl.content.cloneNode(true);
    const block = clone.querySelector('.gift-block');

    // Update label
    block.querySelector('.gift-block-label').textContent = `Gift ${idx + 1}`;

    // Reindex semua [name] dari gift[0] → gift[idx]
    block.querySelectorAll('[name]').forEach(el => {
      el.name = el.name.replace(/gift\[0\]/, `gift[${idx}]`);
    });

    // Prefill dari data existing
    if (data) {
      const type = data.type || 'rekening';

      const typeRadio = block.querySelector(`input[name="gift[${idx}][type]"][value="${type}"]`);
      if (typeRadio) typeRadio.checked = true;

      block.querySelector('.gift-rekening-fields').style.display = type === 'rekening' ? '' : 'none';
      block.querySelector('.gift-alamat-fields').style.display   = type === 'alamat'   ? '' : 'none';

      if (type === 'rekening') {
        ['rekening_nama', 'rekening_bank', 'rekening_nomor'].forEach(f => {
          const el = block.querySelector(`[name="gift[${idx}][${f}]"]`);
          if (el && data[f]) el.value = data[f];
        });
      } else {
        ['alamat_nama', 'alamat_detail'].forEach(f => {
          const el = block.querySelector(`[name="gift[${idx}][${f}]"]`);
          if (el && data[f]) {
            if (el.tagName === 'TEXTAREA') el.textContent = data[f];
            else el.value = data[f];
          }
        });
      }
    }

    block.querySelector('.btn-remove-gift').style.display = 'none';

    list.appendChild(block);
    bindGiftBlock(block);
    updateGiftRemoveBtns(list);
  }

  // ════════════════════════════════════════════════════════
  //  13. bindGiftPage  ← BARU
  // ════════════════════════════════════════════════════════
  function bindGiftPage(pageEl) {
    const addBtn = pageEl.querySelector('.btn-add-gift');
    if (!addBtn) return;

    addBtn.addEventListener('click', () => {
      const list   = pageEl.querySelector('#giftList');
      if (!list) return;
      const newIdx = list.querySelectorAll('.gift-block').length;
      appendGiftBlock(list, newIdx, null);
      list.lastElementChild?.scrollIntoView({ behavior: 'smooth', block: 'start' });
    });
  }

  // ════════════════════════════════════════════════════════
  //  14. bindGiftBlock  ← BARU
  // ════════════════════════════════════════════════════════
  function bindGiftBlock(block) {
    if (!block) return;

    // Toggle rekening ↔ alamat fields saat type berubah
    block.querySelectorAll('input[name*="[type]"]').forEach(radio => {
      radio.addEventListener('change', () => {
        const isRek = radio.value === 'rekening';
        block.querySelector('.gift-rekening-fields').style.display = isRek ? '' : 'none';
        block.querySelector('.gift-alamat-fields').style.display   = isRek ? 'none' : '';
      });
    });

    // Remove button
    block.querySelector('.btn-remove-gift')?.addEventListener('click', () => {
      const list = block.closest('#giftList');
      block.remove();
      reindexGift(list);
    });
  }

  // ════════════════════════════════════════════════════════
  //  15. reindexGift  ← BARU
  // ════════════════════════════════════════════════════════
  function reindexGift(list) {
    if (!list) return;
    list.querySelectorAll('.gift-block').forEach((block, i) => {
      block.querySelector('.gift-block-label').textContent = `Gift ${i + 1}`;
      block.querySelectorAll('[name]').forEach(el => {
        el.name = el.name.replace(/gift\[\d+\]/, `gift[${i}]`);
      });
    });
    updateGiftRemoveBtns(list);
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
  //  16. bindMediaPage — musik + gallery
  // ════════════════════════════════════════════════════════
  function bindMediaPage(pageEl) {
    initMusicPlayer(pageEl);
    initGalleryUpload(pageEl);
  }

  // ════════════════════════════════════════════════════════
  //  17. rebuildChips
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
  //  18. goTo
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
      btnNext.textContent = '💾 Update Sekarang';
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
  //  19. renderSummary
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

      const urlHidden = cfg.pageEl.querySelector('input[name="url_name"][type="hidden"]');
      if (urlHidden) {
        const r = document.createElement('div');
        r.className = 'sum-row';
        r.innerHTML = `<span class="sum-key">URL</span>
          <span class="sum-val"><?=base_url()?>/<span style="color:var(--orange);font-weight:600;">${esc(urlHidden.value||'—')}</span></span>`;
        sec.appendChild(r);
      }

      cfg.pageEl.querySelectorAll(
        'input:not([type=radio]):not([type=checkbox]):not([type=file]):not([name="url_name"]), textarea'
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

    // ── Ringkasan Acara ──────────────────────────────────
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

    // ── Ringkasan Gift ← BARU ────────────────────────────
    document.getElementById('sumGiftSection')?.remove();

    const giftList = document.getElementById('giftList');
    if (giftList) {
      const giftSec = document.createElement('div');
      giftSec.id        = 'sumGiftSection';
      giftSec.className = 'sum-section';
      giftSec.innerHTML = `<div class="sum-section-title">🎁 Gift</div>`;

      const blocks = giftList.querySelectorAll('.gift-block');
      if (blocks.length === 0) {
        const empty = document.createElement('div');
        empty.className = 'sum-row';
        empty.innerHTML = `<span class="sum-key">—</span><span class="sum-val" style="color:var(--ink-soft)">Belum ada gift</span>`;
        giftSec.appendChild(empty);
      } else {
        blocks.forEach((block, i) => {
          const typeRadio = block.querySelector(`input[name="gift[${i}][type]"]:checked`);
          const type      = typeRadio?.value || 'rekening';
          const d         = document.createElement('div');
          d.className     = 'sum-acara-block';

          if (type === 'rekening') {
            const nama  = block.querySelector(`[name="gift[${i}][rekening_nama]"]`)?.value  || '—';
            const bank  = block.querySelector(`[name="gift[${i}][rekening_bank]"]`)?.value  || '—';
            const nomor = block.querySelector(`[name="gift[${i}][rekening_nomor]"]`)?.value || '—';
            d.innerHTML = `
              <div class="sum-acara-name">🏦 Transfer Rekening</div>
              <div class="sum-acara-detail">${esc(nama)} · ${esc(bank)}<br>${esc(nomor)}</div>`;
          } else {
            const nama   = block.querySelector(`[name="gift[${i}][alamat_nama]"]`)?.value   || '—';
            const detail = block.querySelector(`[name="gift[${i}][alamat_detail]"]`)?.value || '—';
            d.innerHTML = `
              <div class="sum-acara-name">📦 Kirim ke Alamat</div>
              <div class="sum-acara-detail">${esc(nama)}<br>${esc(detail)}</div>`;
          }
          giftSec.appendChild(d);
        });
      }

      // Sisipkan sebelum section media
      const sumMedia = document.getElementById('sumMediaSection');
      sumMedia.parentNode.insertBefore(giftSec, sumMedia);
    }

    // ── Ringkasan Musik ──────────────────────────────────
    const mRadio = document.querySelector('input[name="music_choice"]:checked');
    document.getElementById('sumMusik').textContent =
      mRadio?.closest('.music-item')?.querySelector('.music-item-title')?.textContent || 'Tanpa Musik';

    // ── Ringkasan Gallery ────────────────────────────────
    const existingCount = document.querySelectorAll('#galleryPreviewGrid .gallery-thumb[data-existing]').length;
    const newCount      = (window.galleryFiles || []).length;
    const total         = existingCount + newCount;
    const sumMedia = document.getElementById('sumMediaSection');
    sumMedia.querySelectorAll('.sum-row-gallery').forEach(el => el.remove());
    const gr = document.createElement('div');
    gr.className = 'sum-row sum-row-gallery';
    gr.innerHTML = `<span class="sum-key">Foto Galeri</span>
      <span class="sum-val">${total > 0 ? total + ' foto' : '—'}</span>`;
    sumMedia.appendChild(gr);
  }

  // ════════════════════════════════════════════════════════
  //  20. iframe postMessage
  // ════════════════════════════════════════════════════════
  function collectData() {
    const data = {};
    document.querySelectorAll(
      '#wzBody input:not([type=radio]):not([type=checkbox]):not([type=file]), #wzBody textarea'
    ).forEach(el => {
      if (el.id)   data[el.id]   = el.value;
      if (el.name) data[el.name] = el.value;
    });

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
    data.acara_list   = acaraData;
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
  //  21. Template picker
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
  //  22. Next / Prev
  // ════════════════════════════════════════════════════════
  btnPrev.addEventListener('click', () => goTo(cur - 1));

  btnNext.addEventListener('click', () => {
    if (cur === TOTAL - 1) {
      submitForm();
    } else {
      goTo(cur + 1);
    }
  });

  // ════════════════════════════════════════════════════════
  //  23. submitForm
  // ════════════════════════════════════════════════════════
  window.submitForm = function () {
    const btn = document.getElementById('btnUpdate');
    if (btn) { btn.textContent = 'Menyimpan...'; btn.disabled = true; }

    const form     = document.getElementById('undanganForm');
    const formData = new FormData(form);

    formData.delete('gallery[]');
    (window.galleryFiles || []).forEach(f => formData.append('gallery[]', f));

    fetch(form.action, { method: 'POST', body: formData })
      .then(r => {
        if (r.redirected) { window.location.href = r.url; return null; }
        return r.text();
      })
      .then(html => {
        if (!html) return;
        try {
          const json = JSON.parse(html);
          if (json.redirect) { window.location.href = json.redirect; return; }
          if (!json.success) {
            window.showToast?.('error', 'Gagal menyimpan', [json.message || 'Terjadi kesalahan']);
          }
        } catch (e) {
          document.open(); document.write(html); document.close();
        }
      })
      .catch(err => {
        console.error(err);
        window.showToast?.('error', 'Terjadi kesalahan', ['Silakan coba lagi']);
      })
      .finally(() => {
        if (btn) { btn.textContent = 'Update'; btn.disabled = false; }
      });
  };

  document.getElementById('btnUpdate')?.addEventListener('click', () => window.submitForm());

  // ════════════════════════════════════════════════════════
  //  24. Mobile drawer
  // ════════════════════════════════════════════════════════
  document.getElementById('mobilePreviewBtn')?.addEventListener('click', () =>
    document.getElementById('previewDrawer').classList.add('open'));
  document.getElementById('drawerClose')?.addEventListener('click', () =>
    document.getElementById('previewDrawer').classList.remove('open'));
  document.getElementById('previewDrawer')?.addEventListener('click', function(e) {
    if (e.target === this) this.classList.remove('open');
  });

  // ════════════════════════════════════════════════════════
  //  25. Music player
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
  //  26. Gallery upload (edit mode: existing + new)
  // ════════════════════════════════════════════════════════
  function initGalleryUpload(pageEl) {
    const input           = pageEl.querySelector('#galleryInput');
    const dropZone        = pageEl.querySelector('#galleryDropZone');
    const pickBtn         = pageEl.querySelector('#galleryPickBtn');
    const previewGrid     = pageEl.querySelector('#galleryPreviewGrid');
    const countEl         = pageEl.querySelector('#galleryCount');
    const maxLabel        = pageEl.querySelector('#maxPhotoLabel');
    const existingInputs  = pageEl.querySelector('#existingGalleryInputs');

    if (!input) {
      console.warn('[Gallery] #galleryInput tidak ditemukan', pageEl);
      return;
    }

    let MAX = parseInt(document.querySelector('.tpl-card.selected')?.dataset.maxPhoto)
            || window.CURRENT_MAX_PHOTO || 10;
    let newFiles = [];

    Object.defineProperty(window, 'galleryFiles', { get: () => newFiles, configurable: true });

    window.gallerySetMax = max => {
      MAX = parseInt(max) || 10;
      if (maxLabel) maxLabel.textContent = MAX;
      updateCount();
    };

    if (maxLabel) maxLabel.textContent = MAX;

    function countAll() {
      return previewGrid.querySelectorAll('.gallery-thumb[data-existing]').length
           + newFiles.length;
    }

    function updateCount() {
      if (countEl) countEl.textContent = countAll() > 0
        ? `${countAll()} / ${MAX} foto dipilih` : '';
    }

    function renumber() {
      previewGrid.querySelectorAll('.gallery-thumb').forEach((t, i) => {
        const n = t.querySelector('.gallery-thumb-num');
        if (n) n.textContent = i + 1;
      });
    }

    // ── Render foto EXISTING ──────────────────────────────
    const existingGallery = window.EXISTING_GALLERY || [];
    existingGallery.forEach((filePath, idx) => {
      if (existingInputs) {
        const hidden = document.createElement('input');
        hidden.type  = 'hidden';
        hidden.name  = 'existing_gallery[]';
        hidden.value = filePath;
        existingInputs.appendChild(hidden);
      }

      const wrap = document.createElement('div');
      wrap.className        = 'gallery-thumb';
      wrap.dataset.existing = filePath;
      wrap.innerHTML = `
        <img src="<?=base_url()?>${filePath}" alt="foto ${idx+1}" />
        <button type="button" class="gallery-thumb-remove" data-file="${filePath}" title="Hapus">✕</button>
        <div class="gallery-thumb-num">${idx+1}</div>`;
      wrap.querySelector('.gallery-thumb-remove').addEventListener('click', function() {
        const h = existingInputs?.querySelector(`input[value="${this.dataset.file}"]`);
        if (h) h.remove();
        wrap.remove();
        renumber();
        updateCount();
      });
      previewGrid.appendChild(wrap);
    });

    updateCount();

    // ── Tambah file baru ──────────────────────────────────
    function addFiles(selectedFiles) {
      const rem = MAX - countAll();
      if (rem <= 0) { alert(`Maksimal ${MAX} foto.`); return; }
      const arr   = Array.from(selectedFiles);
      const toAdd = arr.slice(0, rem);
      if (arr.length > rem) alert(`Hanya ${rem} foto lagi yang bisa ditambahkan.`);

      toAdd.forEach(file => {
        const fileIdx = newFiles.length;
        newFiles.push(file);

        const reader = new FileReader();
        reader.onload = ev => {
          const wrap = document.createElement('div');
          wrap.className      = 'gallery-thumb';
          wrap.dataset.newIdx = fileIdx;
          wrap.innerHTML = `
            <img src="${ev.target.result}" alt="foto baru" />
            <button type="button" class="gallery-thumb-remove" title="Hapus">✕</button>
            <div class="gallery-thumb-num"></div>`;
          wrap.querySelector('.gallery-thumb-remove').addEventListener('click', () => {
            const i = parseInt(wrap.dataset.newIdx);
            newFiles.splice(i, 1);
            wrap.remove();
            previewGrid.querySelectorAll('.gallery-thumb[data-new-idx]').forEach((t, j) => {
              t.dataset.newIdx = j;
            });
            renumber();
            updateCount();
          });
          previewGrid.appendChild(wrap);
          renumber();
          updateCount();
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
    dropZone?.addEventListener('dragover', e => { e.preventDefault(); dropZone.classList.add('drag-over'); });
    dropZone?.addEventListener('dragleave', () => dropZone.classList.remove('drag-over'));
    dropZone?.addEventListener('drop', e => {
      e.preventDefault();
      dropZone.classList.remove('drag-over');
      if (e.dataTransfer.files.length) addFiles(e.dataTransfer.files);
    });
    dropZone?.addEventListener('click', e => {
      if (e.target.closest('.gallery-pick-btn')) return;
      input.click();
    });
  }

  // ════════════════════════════════════════════════════════
  //  27. showToast (global)
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

  // ── Helper esc ─────────────────────────────────────────
  function esc(s) {
    if (!s) return '';
    return String(s).replace(/&/g,'&amp;').replace(/</g,'&lt;')
                    .replace(/>/g,'&gt;').replace(/"/g,'&quot;');
  }

  // ════════════════════════════════════════════════════════
  //  INIT
  // ════════════════════════════════════════════════════════
  (function init() {
    const selectedCard = document.querySelector('.tpl-card.selected');
    const tplId        = selectedCard?.dataset.id || String(window.CURRENT_TEMPLATE);
    const filename     = selectedCard?.dataset.filename;

    if (tplId) buildWizard(tplId);

    if (filename) {
      iframe.src = `/cek-template/load/${filename}`;
      iframe.onload = () => { iframeReady = true; sendToIframe(); };

      const iframeMobile = document.getElementById('templateFrameMobile');
      if (iframeMobile) iframeMobile.src = `/cek-template/load/${filename}`;
    }

    totalEl.textContent = TOTAL;
  })();

})();
</script>

</body>
</html>