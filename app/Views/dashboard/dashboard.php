<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Undangin — Dashboard</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Pacifico&family=Nunito:wght@400;600;700;800;900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?=base_url()?>assets/css/style.css" />
</head>
<body>

<?php include('sidebar.php')?>

<!-- MAIN -->
<main class="main">

  <!-- TOP BAR -->
  <div class="topbar">
    <div style="display:flex;align-items:center;gap:10px;min-width:0;">
      <!-- <div class="hamburger" onclick="openDrawer()"><span></span><span></span><span></span></div> -->
      <div class="topbar-left">
        <h1>Halo, <?=$user['full_name']?>!</h1>
        <p>Rabu, 29 April 2026 · 6 undangan aktif</p>
      </div>
    </div>
    <div class="topbar-right">
      <button class="new-btn" onClick="window.location='<?=base_url('buat-undangan')?>'"><i class="fa-solid fa-plus"></i> Buat Undangan</button>
    </div>
  </div>

  <!-- STATS -->
  <div class="stat-grid">
    <div class="stat-card c1">
      <div class="stat-bg"></div>
      <div class="stat-icon"><i class="fa-solid fa-at"></i></div>
      <div class="stat-label">Total Undangan</div>
      <div class="stat-value"><?= $total_undangan ?></div>
      <div class="stat-change up">undangan dibuat</div>
    </div>
    <div class="stat-card c2">
      <div class="stat-bg"></div>
      <div class="stat-icon"><i class="fa-solid fa-people-group"></i></div>
      <div class="stat-label">Total Tamu</div>
      <div class="stat-value"><?= $total_tamu ?></div>
      <div class="stat-change up">dari semua undangan</div>
    </div>
    <div class="stat-card c3">
      <div class="stat-bg"></div>
      <div class="stat-icon"><i class="fa-solid fa-envelope-circle-check"></i></div>
      <div class="stat-label">Sudah RSVP</div>
      <div class="stat-value"><?= $total_rsvp ?></div>
      <div class="stat-change up"><?= $total_tamu > 0 ? round($total_rsvp / $total_tamu * 100) : 0 ?>% dari tamu</div>
    </div>
    <div class="stat-card c4">
      <div class="stat-bg"></div>
      <div class="stat-icon"><i class="fa-solid fa-eye"></i></div>
      <div class="stat-label">Total Views</div>
      <div class="stat-value"><?= $total_views ?></div>
      <div class="stat-change up">pengunjung unik</div>
    </div>
  </div>

  <!-- CONTENT GRID -->
  <div class="content-grid">

    <!-- UNDANGAN -->
    <div class="card">
      <div class="card-header">
        <div>
          <div class="card-title">Undanganku</div>
          <div class="card-sub">Kelola semua undangan digitalmu</div>
        </div>
        <div class="pill-tabs">
          <div class="pill-tab active">Semua</div>
          <div class="pill-tab">Aktif</div>
          <div class="pill-tab">Draft</div>
        </div>
      </div>

      <div class="invitation-grid">
        <?php foreach ($undangan_list as $inv): ?>
        <?php
          $pria   = $inv->nickname_men   ?: 'Pria';
          $wanita = $inv->nickname_women ?: 'Wanita';
          $pct    = $inv->total_tamu > 0
                    ? round($inv->total_rsvp / $inv->total_tamu * 100)
                    : 0;
          $tgl    = $inv->event_date
                    ? date('l, d F Y', strtotime($inv->event_date))
                    : '—';
          $tglFmt = $inv->event_date
                    ? date('d · m · Y', strtotime($inv->event_date))
                    : '— · — · —';
        ?>
        <div class="inv-card">
          <div class="inv-thumb wedding">
            <img src="<?=base_url()?>assets/img/preview/<?=$inv->cover?>">
          </div>
          <div class="inv-info">
            <div class="inv-name"><?= esc($pria) ?> & <?= esc($wanita) ?></div>
            <div class="inv-date">📅 <?= $tgl ?></div>
            <div class="inv-footer"><div class="inv-views"><?= $inv->total_tamu ?> tamu &bull; <?= $inv->total_rsvp ?> RSVP</div><span class="inv-status live">● Live</span></div>
          </div>
        </div>
        <?php endforeach; ?>
        <div class="inv-add" onClick="window.location='<?=base_url('buat-undangan')?>'">
          <div class="inv-add-inner">
            <div class="plus">＋</div>
            <span>Buat Baru</span>
          </div>
        </div>
      </div>
    </div>
    <div class="card">
      <div class="card-header">
        <div>
          <div class="card-title">Undanganku</div>
          <div class="card-sub">Kelola semua undangan digitalmu</div>
        </div>
        <div class="pill-tabs">
          <div class="pill-tab active">Semua</div>
          <div class="pill-tab">Aktif</div>
          <div class="pill-tab">Draft</div>
        </div>
      </div>

      <div class="invitation-grid">
        <?php foreach ($undangan_list as $inv): ?>
        <?php
          $pria   = $inv->nickname_men   ?: 'Pria';
          $wanita = $inv->nickname_women ?: 'Wanita';
          $pct    = $inv->total_tamu > 0
                    ? round($inv->total_rsvp / $inv->total_tamu * 100)
                    : 0;
          $tgl    = $inv->event_date
                    ? date('l, d F Y', strtotime($inv->event_date))
                    : '—';
          $tglFmt = $inv->event_date
                    ? date('d · m · Y', strtotime($inv->event_date))
                    : '— · — · —';
        ?>
        <div class="inv-card">
          <div class="inv-thumb wedding">
            <img src="<?=base_url()?>assets/img/preview/<?=$inv->cover?>">
          </div>
          <div class="inv-info">
            <div class="inv-name"><?= esc($pria) ?> & <?= esc($wanita) ?></div>
            <div class="inv-date">📅 <?= $tgl ?></div>
            <div class="inv-footer"><div class="inv-views"><?= $inv->total_tamu ?> tamu &bull; <?= $inv->total_rsvp ?> RSVP</div><span class="inv-status live">● Live</span></div>
          </div>
        </div>
        <?php endforeach; ?>
        <div class="inv-add" onClick="window.location='<?=base_url('buat-undangan')?>'">
          <div class="inv-add-inner">
            <div class="plus">＋</div>
            <span>Buat Baru</span>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- BOTTOM GRID -->
  <div class="bottom-grid">

    <div class="card">
      <div class="card-header" style="margin-bottom:0;">
        <div><div class="card-title">Views Harian</div><div class="card-sub">7 hari terakhir</div></div>
      </div>
      <div class="minichart">
        <div class="mbar-group"><div class="mbar" style="height:50%;background:var(--o100);"></div><div class="mbar-lbl">Sen</div></div>
        <div class="mbar-group"><div class="mbar" style="height:70%;background:var(--o200);"></div><div class="mbar-lbl">Sel</div></div>
        <div class="mbar-group"><div class="mbar" style="height:55%;background:var(--o100);"></div><div class="mbar-lbl">Rab</div></div>
        <div class="mbar-group"><div class="mbar" style="height:85%;background:var(--o300);"></div><div class="mbar-lbl">Kam</div></div>
        <div class="mbar-group"><div class="mbar" style="height:95%;background:var(--o400);"></div><div class="mbar-lbl">Jum</div></div>
        <div class="mbar-group"><div class="mbar" style="height:80%;background:var(--o300);"></div><div class="mbar-lbl">Sab</div></div>
        <div class="mbar-group"><div class="mbar" style="height:60%;background:var(--o200);"></div><div class="mbar-lbl">Min</div></div>
      </div>
      <div style="display:flex;gap:16px;margin-top:8px;">
        <div><div style="font-size:9.5px;color:var(--text4);font-weight:800;letter-spacing:.5px;">HARI INI</div><div style="font-family:'Pacifico',cursive;font-size:19px;color:var(--o500);">412</div></div>
        <div><div style="font-size:9.5px;color:var(--text4);font-weight:800;letter-spacing:.5px;">MINGGU INI</div><div style="font-family:'Pacifico',cursive;font-size:19px;color:var(--o500);">2.187</div></div>
      </div>
    </div>

    <div class="card">
        <div class="card-title">Rekap RSVP</div>
        <div class="card-sub">Pernikahan Rizki & Anisa</div>
        <div class="rsvp-donut">
          <svg width="84" height="84" viewBox="0 0 84 84" style="flex-shrink:0;">
            <circle cx="42" cy="42" r="31" fill="none" stroke="#B5D9C2" stroke-width="16"
              stroke-dasharray="194.8 0" transform="rotate(-90 42 42)"/>
            <circle cx="42" cy="42" r="31" fill="none" stroke="#FFD49A" stroke-width="16"
              stroke-dasharray="50.3 144.5" stroke-dashoffset="-144.5" transform="rotate(-90 42 42)"/>
            <circle cx="42" cy="42" r="31" fill="none" stroke="#FFBBA8" stroke-width="16"
              stroke-dasharray="21.5 173.3" stroke-dashoffset="-194.8" transform="rotate(-90 42 42)"/>
            <circle cx="42" cy="42" r="21" fill="white"/>
            <text x="42" y="39" text-anchor="middle" font-family="Pacifico,cursive" font-size="11" fill="#2C1A00">246</text>
            <text x="42" y="50" text-anchor="middle" font-family="Nunito,sans-serif" font-size="7" fill="#D8C0A0">tamu</text>
          </svg>
          <div class="donut-list">
            <div class="donut-item"><div class="donut-dot" style="background:var(--sage);"></div><span class="donut-label">Hadir</span><span class="donut-val">186</span></div>
            <div class="donut-item"><div class="donut-dot" style="background:var(--o200);"></div><span class="donut-label">Mungkin</span><span class="donut-val">42</span></div>
            <div class="donut-item"><div class="donut-dot" style="background:var(--coral);"></div><span class="donut-label">Tidak</span><span class="donut-val">18</span></div>
          </div>
        </div>
    </div>

    <div class="card">
        <div class="card-title">RSVP Terbaru</div>
        <div class="card-sub">Konfirmasi kehadiran masuk</div>
        <div class="guest-list">
          <?php if (empty($recent_activity)): ?>
            <div class="guest-item" style="opacity:0.3">
            <div><div class="guest-name">Belum ada aktivitas</div></div>
          </div>
          <?php else: ?>
          <?php foreach ($recent_activity as $act): ?>
          <?php
            $nama   = esc($act->guest_name);
            $couple = esc($act->nickname_men) . ' &amp; ' . esc($act->nickname_women);
            $waktu  = $act->viewed_date
                      ? date('j M Y, H:i', strtotime($act->viewed_date))
                      : '—';
          ?>
          <div class="guest-item">
            <div class="guest-avatar" style="background:var(--o100);"><?= $act->rsvp ? '✅' : '👁️' ?></div>
            <div><div class="guest-name"><?= $nama ?></div><div class="guest-inv"><?= $waktu ?></div></div>
            <span class="rsvp-pill hadir">Hadir</span>
          </div>
          <?php endforeach; ?>
        <?php endif; ?>
        </div>
      </div>

  </div>
</main>


<script src="<?=base_url()?>assets/js/dashboard.js"></script>
</body>
</html>