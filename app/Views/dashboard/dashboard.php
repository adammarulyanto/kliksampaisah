<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard — Invita</title>
  <link rel="stylesheet" href="<?=base_url()?>assets/css/style.css" />
  <link rel="stylesheet" href="<?=base_url()?>assets/css/dashboard.css" />
</head>
<body>

<div class="dashboard-layout">

  <?php include('sidebar.php')?>

  <!-- ── Main Content ───────────────────────────────────── -->
  <main class="dashboard-content">

    <!-- Header Bar -->
    <header class="dashboard-header">
      <div class="header-left">
        <h1>Halo, <?=$user['full_name']?></h1>
        <p>Kelola undangan digital kamu di sini</p>
      </div>
      <div class="header-right">
        <button class="btn-primary btn-new-invite" onClick="window.location='<?=base_url('buat-undangan')?>'">
          <span>➕</span> Buat Undangan Baru
        </button>
      </div>
    </header>

    <!-- Stats Cards -->
    <!-- Stats Cards -->
    <section class="stats-cards">
      <div class="stat-card">
        <div class="stat-card-icon">📋</div>
        <div class="stat-card-content">
          <div class="stat-card-label">Total Undangan</div>
          <div class="stat-card-value"><?= $total_undangan ?></div>
          <div class="stat-card-sub">undangan dibuat</div>
        </div>
      </div>
      <div class="stat-card">
        <div class="stat-card-icon">👥</div>
        <div class="stat-card-content">
          <div class="stat-card-label">Total Tamu</div>
          <div class="stat-card-value"><?= $total_tamu ?></div>
          <div class="stat-card-sub">dari semua undangan</div>
        </div>
      </div>
      <div class="stat-card">
        <div class="stat-card-icon">✅</div>
        <div class="stat-card-content">
          <div class="stat-card-label">Sudah RSVP</div>
          <div class="stat-card-value"><?= $total_rsvp ?></div>
          <div class="stat-card-sub">
            <?= $total_tamu > 0 ? round($total_rsvp / $total_tamu * 100) : 0 ?>% dari tamu
          </div>
        </div>
      </div>
      <div class="stat-card">
        <div class="stat-card-icon">👁️</div>
        <div class="stat-card-content">
          <div class="stat-card-label">Total Views</div>
          <div class="stat-card-value"><?= $total_views ?></div>
          <div class="stat-card-sub">pengunjung unik</div>
        </div>
      </div>
    </section>

    <!-- My Invitations -->
    <section class="my-invitations">
      <div class="section-title-bar">
        <h2>Undangan Saya</h2>
        <a href="<?=base_url('undangan-saya')?>" class="link-secondary">Lihat Semua →</a>
      </div>

      <div class="invitations-grid">

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
        <div class="invitation-card">
          <div class="invite-card-thumb">
            <div class="invite-preview-large">
              <div class="invite-top" style="width:36px;"></div>
              <div class="invite-sub">The Wedding of</div>
              <div class="invite-names">
                <?= esc($pria) ?><br>&amp;<br><?= esc($wanita) ?>
              </div>
              <div class="invite-divider"></div>
              <div class="invite-date"><?= $tglFmt ?></div>
            </div>
          </div>
          <div class="invite-card-body">
            <h3 class="invite-card-title"><?= esc($pria) ?> &amp; <?= esc($wanita) ?></h3>
            <p class="invite-card-date"><?= $tgl ?></p>
            <p class="invite-card-guests">
              <?= $inv->total_tamu ?> tamu &bull; <?= $inv->total_rsvp ?> RSVP
            </p>
            <div class="invite-card-progress">
              <div class="progress-bar">
                <div class="progress-fill" style="width:<?= $pct ?>%;"></div>
              </div>
              <span class="progress-text"><?= $pct ?>% konfirmasi</span>
            </div>
            <div class="invite-card-actions">
              <a href="<?= base_url($inv->url_name) ?>" 
                class="btn-small btn-primary" target="_blank">Lihat</a>
              <a href="<?= base_url('undangan/edit/' . $inv->id) ?>" 
                class="btn-small btn-outline">Edit</a>
            </div>
          </div>
        </div>
        <?php endforeach; ?>

        <!-- Empty Card -->
        <div class="invitation-card invitation-card-empty">
          <div class="empty-content">
            <div class="empty-icon">➕</div>
            <h3>Buat Undangan Baru</h3>
            <p>Mulai dengan memilih template favorit</p>
            <a href="<?=base_url('buat-undangan')?>" 
              class="btn-primary" style="margin-top:16px;">Mulai</a>
          </div>
        </div>

      </div>
    </section>

    <!-- Recent Activity -->
    <section class="recent-activity">
      <h2>Aktivitas Terbaru</h2>
      <div class="activity-list">

        <?php if (empty($recent_activity)): ?>
          <div class="activity-item">
            <div class="activity-icon">📭</div>
            <div class="activity-content">
              <p class="activity-title">Belum ada aktivitas</p>
            </div>
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
          <div class="activity-item">
            <div class="activity-icon">
              <?= $act->rsvp ? '✅' : '👁️' ?>
            </div>
            <div class="activity-content">
              <?php if ($act->rsvp): ?>
                <p class="activity-title">
                  <strong><?= $nama ?></strong> sudah RSVP di undangan 
                  <strong><?= $couple ?></strong>
                </p>
              <?php else: ?>
                <p class="activity-title">
                  <strong><?= $nama ?></strong> melihat undangan 
                  <strong><?= $couple ?></strong>
                </p>
              <?php endif; ?>
              <p class="activity-time"><?= $waktu ?></p>
            </div>
          </div>
          <?php endforeach; ?>
        <?php endif; ?>

      </div>
    </section>

  </main>

</div>

<script>


  // Card animation on scroll
  const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry, i) => {
      if (entry.isIntersecting) {
        entry.target.style.opacity = '1';
        entry.target.style.transform = 'translateY(0)';
        observer.unobserve(entry.target);
      }
    });
  }, { threshold: 0.1 });

  document.querySelectorAll('.invitation-card').forEach((card, i) => {
    card.style.opacity = '0';
    card.style.transform = 'translateY(24px)';
    card.style.transition = `opacity 0.5s ease ${i * 0.1}s, transform 0.5s ease ${i * 0.1}s`;
    observer.observe(card);
  });

  document.querySelectorAll('.stat-card').forEach((card, i) => {
    card.style.opacity = '0';
    card.style.transform = 'translateY(20px)';
    card.style.transition = `opacity 0.5s ease ${i * 0.08}s, transform 0.5s ease ${i * 0.08}s`;
    observer.observe(card);
  });
</script>

</body>
</html>
