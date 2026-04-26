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
    <section class="stats-cards">
      <div class="stat-card">
        <div class="stat-card-icon">📋</div>
        <div class="stat-card-content">
          <div class="stat-card-label">Total Undangan</div>
          <div class="stat-card-value">3</div>
          <div class="stat-card-sub">undangan dibuat</div>
        </div>
      </div>
      <div class="stat-card">
        <div class="stat-card-icon">👥</div>
        <div class="stat-card-content">
          <div class="stat-card-label">Total Tamu</div>
          <div class="stat-card-value">287</div>
          <div class="stat-card-sub">dari semua undangan</div>
        </div>
      </div>
      <div class="stat-card">
        <div class="stat-card-icon">✅</div>
        <div class="stat-card-content">
          <div class="stat-card-label">Sudah RSVP</div>
          <div class="stat-card-value">156</div>
          <div class="stat-card-sub">54% dari tamu</div>
        </div>
      </div>
      <div class="stat-card">
        <div class="stat-card-icon">👁️</div>
        <div class="stat-card-content">
          <div class="stat-card-label">Total Views</div>
          <div class="stat-card-value">542</div>
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

        <!-- Invitation Card 1 -->
        <div class="invitation-card">
          <div class="invite-card-thumb">
            <div class="invite-preview-large style-floral">
              <div class="invite-top" style="width:36px;"></div>
              <div class="invite-sub">The Wedding of</div>
              <div class="invite-names">Ayu<br>&amp;<br>Dimas</div>
              <div class="invite-divider"></div>
              <div class="invite-date">14 · 06 · 2025</div>
            </div>
          </div>
          <div class="invite-card-body">
            <h3 class="invite-card-title">Ayu & Dimas</h3>
            <p class="invite-card-date">Sabtu, 14 Juni 2025</p>
            <p class="invite-card-guests">287 tamu • 156 RSVP</p>
            
            <div class="invite-card-progress">
              <div class="progress-bar">
                <div class="progress-fill" style="width: 54%;"></div>
              </div>
              <span class="progress-text">54% konfirmasi</span>
            </div>

            <div class="invite-card-actions">
              <button class="btn-small btn-primary">Lihat</button>
              <button class="btn-small btn-outline">Edit</button>
            </div>
          </div>
        </div>

        <!-- Invitation Card 2 -->
        <div class="invitation-card">
          <div class="invite-card-thumb">
            <div class="invite-preview-large style-modern">
              <div class="invite-top" style="width:36px;"></div>
              <div class="invite-sub">The Wedding of</div>
              <div class="invite-names">Rina<br>&amp;<br>Bagas</div>
              <div class="invite-divider"></div>
              <div class="invite-date">08 · 11 · 2025</div>
            </div>
          </div>
          <div class="invite-card-body">
            <h3 class="invite-card-title">Rina & Bagas</h3>
            <p class="invite-card-date">Minggu, 8 November 2025</p>
            <p class="invite-card-guests">142 tamu • 89 RSVP</p>
            
            <div class="invite-card-progress">
              <div class="progress-bar">
                <div class="progress-fill" style="width: 63%;"></div>
              </div>
              <span class="progress-text">63% konfirmasi</span>
            </div>

            <div class="invite-card-actions">
              <button class="btn-small btn-primary">Lihat</button>
              <button class="btn-small btn-outline">Edit</button>
            </div>
          </div>
        </div>

        <!-- Invitation Card 3 -->
        <div class="invitation-card">
          <div class="invite-card-thumb">
            <div class="invite-preview-large style-gold">
              <div class="invite-top" style="width:36px;"></div>
              <div class="invite-sub">The Wedding of</div>
              <div class="invite-names">Sinta<br>&amp;<br>Hendra</div>
              <div class="invite-divider"></div>
              <div class="invite-date">15 · 03 · 2026</div>
            </div>
          </div>
          <div class="invite-card-body">
            <h3 class="invite-card-title">Sinta & Hendra</h3>
            <p class="invite-card-date">Jumat, 15 Maret 2026</p>
            <p class="invite-card-guests">165 tamu • 45 RSVP</p>
            
            <div class="invite-card-progress">
              <div class="progress-bar">
                <div class="progress-fill" style="width: 27%;"></div>
              </div>
              <span class="progress-text">27% konfirmasi</span>
            </div>

            <div class="invite-card-actions">
              <button class="btn-small btn-primary">Lihat</button>
              <button class="btn-small btn-outline">Edit</button>
            </div>
          </div>
        </div>

        <!-- Empty Card - Buat Baru -->
        <div class="invitation-card invitation-card-empty">
          <div class="empty-content">
            <div class="empty-icon">➕</div>
            <h3>Buat Undangan Baru</h3>
            <p>Mulai dengan memilih template favorit</p>
            <a href="<?=base_url('buat-undangan')?>" class="btn-primary" style="margin-top: 16px;">Mulai</a>
          </div>
        </div>

      </div>
    </section>

    <!-- Recent Activity -->
    <section class="recent-activity">
      <h2>Aktivitas Terbaru</h2>
      
      <div class="activity-list">
        <div class="activity-item">
          <div class="activity-icon">👁️</div>
          <div class="activity-content">
            <p class="activity-title"><strong>Ayu & Dimas</strong> — 45 orang melihat undangan</p>
            <p class="activity-time">3 jam yang lalu</p>
          </div>
        </div>

        <div class="activity-item">
          <div class="activity-icon">✅</div>
          <div class="activity-content">
            <p class="activity-title"><strong>Budi Santoso</strong> sudah RSVP di undangan Ayu & Dimas</p>
            <p class="activity-time">5 jam yang lalu</p>
          </div>
        </div>

        <div class="activity-item">
          <div class="activity-icon">💬</div>
          <div class="activity-content">
            <p class="activity-title"><strong>Siti Nurhaliza</strong> menambahkan pesan: "Gak bisa hadir, mohon maaf"</p>
            <p class="activity-time">1 hari yang lalu</p>
          </div>
        </div>

        <div class="activity-item">
          <div class="activity-icon">🎨</div>
          <div class="activity-content">
            <p class="activity-title">Kamu membuat undangan baru <strong>Sinta & Hendra</strong></p>
            <p class="activity-time">2 hari yang lalu</p>
          </div>
        </div>

        <div class="activity-item">
          <div class="activity-icon">🔗</div>
          <div class="activity-content">
            <p class="activity-title">Link undangan <strong>Rina & Bagas</strong> dibagikan 12 kali</p>
            <p class="activity-time">3 hari yang lalu</p>
          </div>
        </div>
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
