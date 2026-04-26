<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Undangan Saya — Invita</title>
  <link rel="stylesheet" href="<?=base_url()?>/assets/css/style.css" />
  <link rel="stylesheet" href="<?=base_url()?>/assets/css/dashboard.css" />
  <link rel="stylesheet" href="<?=base_url()?>/assets/css/undangan-saya.css" />
</head>
<body>

<div class="dashboard-layout">

  <!-- ── Sidebar ─────────────────────────────────────────── -->
  <?php include('sidebar.php')?>

  <!-- ── Main Content ───────────────────────────────────── -->
  <main class="dashboard-content us-content">

    <!-- ── Page Header ─── -->
    <header class="dashboard-header">
      <div class="header-left">
        <h1>Undangan Saya</h1>
        <p>Kelola dan pantau semua undangan digitalmu</p>
      </div>
      <div class="header-right">
        <button class="btn-primary btn-new-invite" id="btnNewInvite" onClick="window.location='<?=base_url('buat-undangan')?>'">
          ➕ Buat Undangan Baru
        </button>
      </div>
    </header>

    <!-- ── Summary Bar ─── -->
    <div class="summary-bar">
      <div class="summary-item">
        <span class="summary-num">3</span>
        <span class="summary-label">Total Undangan</span>
      </div>
      <div class="summary-divider"></div>
      <div class="summary-item">
        <span class="summary-num">594</span>
        <span class="summary-label">Total Tamu</span>
      </div>
      <div class="summary-divider"></div>
      <div class="summary-item">
        <span class="summary-num">290</span>
        <span class="summary-label">Sudah RSVP</span>
      </div>
      <div class="summary-divider"></div>
      <div class="summary-item">
        <span class="summary-num">1.284</span>
        <span class="summary-label">Total Views</span>
      </div>
      <div class="summary-divider"></div>
      <div class="summary-item">
        <span class="summary-num summary-num--accent">49%</span>
        <span class="summary-label">Avg. RSVP Rate</span>
      </div>
    </div>

    <!-- ── Filter & Sort Bar ─── -->
    <div class="filter-bar">
      <div class="filter-tabs">
        <button class="filter-tab active" data-filter="all">Semua (3)</button>
        <button class="filter-tab" data-filter="upcoming">Akan Datang (2)</button>
        <button class="filter-tab" data-filter="past">Sudah Lewat (1)</button>
      </div>
      <div class="filter-actions">
        <div class="search-box">
          <span class="search-icon">🔍</span>
          <input type="text" placeholder="Cari undangan..." id="searchInput" />
        </div>
        <div class="view-toggle">
          <button class="view-btn active" id="viewGrid" title="Grid View">
            <svg width="16" height="16" viewBox="0 0 16 16" fill="none"><rect x="1" y="1" width="6" height="6" rx="1.5" fill="currentColor"/><rect x="9" y="1" width="6" height="6" rx="1.5" fill="currentColor"/><rect x="1" y="9" width="6" height="6" rx="1.5" fill="currentColor"/><rect x="9" y="9" width="6" height="6" rx="1.5" fill="currentColor"/></svg>
          </button>
          <button class="view-btn" id="viewList" title="List View">
            <svg width="16" height="16" viewBox="0 0 16 16" fill="none"><rect x="1" y="2" width="14" height="2.5" rx="1.25" fill="currentColor"/><rect x="1" y="6.75" width="14" height="2.5" rx="1.25" fill="currentColor"/><rect x="1" y="11.5" width="14" height="2.5" rx="1.25" fill="currentColor"/></svg>
          </button>
        </div>
      </div>
    </div>

    <!-- ── Invitations Container ─── -->
    <div class="invitations-container" id="invitationsContainer">

      <!-- ============================
           CARD 1 — Ayu & Dimas
           Status: Upcoming
      ============================= -->
      <article class="us-card" data-status="upcoming" data-name="ayu dimas">
        <!-- Thumbnail side -->
        <div class="us-card-thumb">
          <div class="us-thumb-bg bg-floral">
            <div class="us-invite-mock style-floral">
              <div class="invite-top" style="width:32px;"></div>
              <div class="invite-sub">The Wedding of</div>
              <div class="invite-names">Ayu<br>&amp;<br>Dimas</div>
              <div class="invite-divider"></div>
              <div class="invite-date">14 · 06 · 2025</div>
            </div>
          </div>
          <span class="us-status-badge status-upcoming">Akan Datang</span>
          <div class="us-thumb-actions">
            <button class="thumb-action-btn" title="Lihat Undangan">👁️</button>
            <button class="thumb-action-btn" title="Salin Link">🔗</button>
            <button class="thumb-action-btn" title="Bagikan">📤</button>
          </div>
        </div>

        <!-- Info side -->
        <div class="us-card-body">
          <div class="us-card-top">
            <div>
              <h2 class="us-card-title">Ayu & Dimas</h2>
              <p class="us-card-template">Template: Floral Romance</p>
            </div>
            <div class="us-card-menu">
              <button class="menu-btn" title="Opsi lainnya">⋯</button>
            </div>
          </div>

          <!-- Date & Venue -->
          <div class="us-meta-row">
            <div class="us-meta-item">
              <span class="us-meta-icon">📅</span>
              <span>Sabtu, 14 Juni 2025</span>
            </div>
            <div class="us-meta-item">
              <span class="us-meta-icon">📍</span>
              <span>Gedung Harmoni, Jakarta Selatan</span>
            </div>
            <div class="us-meta-item">
              <span class="us-meta-icon">⏰</span>
              <span>09.00 – 13.00 WIB</span>
            </div>
          </div>

          <!-- Stats Row -->
          <div class="us-stats-row">
            <div class="us-mini-stat">
              <div class="us-mini-stat-val">287</div>
              <div class="us-mini-stat-label">Tamu</div>
            </div>
            <div class="us-mini-stat">
              <div class="us-mini-stat-val" style="color:var(--orange);">156</div>
              <div class="us-mini-stat-label">RSVP</div>
            </div>
            <div class="us-mini-stat">
              <div class="us-mini-stat-val" style="color:#e07b2a;">131</div>
              <div class="us-mini-stat-label">Belum</div>
            </div>
            <div class="us-mini-stat">
              <div class="us-mini-stat-val" style="color:var(--grey-600);">542</div>
              <div class="us-mini-stat-label">Views</div>
            </div>
          </div>

          <!-- RSVP Progress -->
          <div class="us-progress-block">
            <div class="us-progress-header">
              <span class="us-progress-label">Konfirmasi Kehadiran</span>
              <span class="us-progress-pct">54%</span>
            </div>
            <div class="us-progress-bar">
              <div class="us-progress-fill" style="width:54%;"></div>
            </div>
            <div class="us-progress-breakdown">
              <span class="breakdown-dot dot-hadir"></span><span>156 Hadir</span>
              <span class="breakdown-dot dot-belum" style="margin-left:12px;"></span><span>131 Belum konfirmasi</span>
            </div>
          </div>

          <!-- Countdown -->
          <div class="us-countdown-row">
            <span class="us-meta-icon">⏳</span>
            <span class="us-countdown-text">50 hari lagi</span>
            <span class="us-countdown-sub">menuju hari H</span>
          </div>

          <!-- Actions -->
          <div class="us-actions">
            <button class="btn-primary btn-small">Lihat Undangan</button>
            <button class="btn-outline btn-small">Edit</button>
            <button class="btn-icon" title="Salin Link">🔗</button>
            <button class="btn-icon" title="Statistik">📊</button>
            <button class="btn-icon btn-icon-danger" title="Hapus">🗑️</button>
          </div>
        </div>
      </article>

      <!-- ============================
           CARD 2 — Rina & Bagas
           Status: Upcoming
      ============================= -->
      <article class="us-card" data-status="upcoming" data-name="rina bagas">
        <div class="us-card-thumb">
          <div class="us-thumb-bg bg-modern">
            <div class="us-invite-mock style-modern">
              <div class="invite-top" style="width:32px;"></div>
              <div class="invite-sub">The Wedding of</div>
              <div class="invite-names">Rina<br>&amp;<br>Bagas</div>
              <div class="invite-divider"></div>
              <div class="invite-date">08 · 11 · 2025</div>
            </div>
          </div>
          <span class="us-status-badge status-upcoming">Akan Datang</span>
          <div class="us-thumb-actions">
            <button class="thumb-action-btn" title="Lihat Undangan">👁️</button>
            <button class="thumb-action-btn" title="Salin Link">🔗</button>
            <button class="thumb-action-btn" title="Bagikan">📤</button>
          </div>
        </div>

        <div class="us-card-body">
          <div class="us-card-top">
            <div>
              <h2 class="us-card-title">Rina & Bagas</h2>
              <p class="us-card-template">Template: Modern Luxe</p>
            </div>
            <div class="us-card-menu">
              <button class="menu-btn">⋯</button>
            </div>
          </div>

          <div class="us-meta-row">
            <div class="us-meta-item">
              <span class="us-meta-icon">📅</span>
              <span>Minggu, 8 November 2025</span>
            </div>
            <div class="us-meta-item">
              <span class="us-meta-icon">📍</span>
              <span>The Ritz-Carlton, Bali</span>
            </div>
            <div class="us-meta-item">
              <span class="us-meta-icon">⏰</span>
              <span>17.00 – 21.00 WITA</span>
            </div>
          </div>

          <div class="us-stats-row">
            <div class="us-mini-stat">
              <div class="us-mini-stat-val">142</div>
              <div class="us-mini-stat-label">Tamu</div>
            </div>
            <div class="us-mini-stat">
              <div class="us-mini-stat-val" style="color:var(--orange);">89</div>
              <div class="us-mini-stat-label">RSVP</div>
            </div>
            <div class="us-mini-stat">
              <div class="us-mini-stat-val" style="color:#e07b2a;">53</div>
              <div class="us-mini-stat-label">Belum</div>
            </div>
            <div class="us-mini-stat">
              <div class="us-mini-stat-val" style="color:var(--grey-600);">398</div>
              <div class="us-mini-stat-label">Views</div>
            </div>
          </div>

          <div class="us-progress-block">
            <div class="us-progress-header">
              <span class="us-progress-label">Konfirmasi Kehadiran</span>
              <span class="us-progress-pct">63%</span>
            </div>
            <div class="us-progress-bar">
              <div class="us-progress-fill" style="width:63%;"></div>
            </div>
            <div class="us-progress-breakdown">
              <span class="breakdown-dot dot-hadir"></span><span>89 Hadir</span>
              <span class="breakdown-dot dot-belum" style="margin-left:12px;"></span><span>53 Belum konfirmasi</span>
            </div>
          </div>

          <div class="us-countdown-row">
            <span class="us-meta-icon">⏳</span>
            <span class="us-countdown-text">197 hari lagi</span>
            <span class="us-countdown-sub">menuju hari H</span>
          </div>

          <div class="us-actions">
            <button class="btn-primary btn-small">Lihat Undangan</button>
            <button class="btn-outline btn-small">Edit</button>
            <button class="btn-icon" title="Salin Link">🔗</button>
            <button class="btn-icon" title="Statistik">📊</button>
            <button class="btn-icon btn-icon-danger" title="Hapus">🗑️</button>
          </div>
        </div>
      </article>

      <!-- ============================
           CARD 3 — Sinta & Hendra
           Status: Past
      ============================= -->
      <article class="us-card" data-status="past" data-name="sinta hendra">
        <div class="us-card-thumb">
          <div class="us-thumb-bg bg-gold us-thumb-faded">
            <div class="us-invite-mock style-gold">
              <div class="invite-top" style="width:32px;"></div>
              <div class="invite-sub">The Wedding of</div>
              <div class="invite-names">Sinta<br>&amp;<br>Hendra</div>
              <div class="invite-divider"></div>
              <div class="invite-date">10 · 01 · 2025</div>
            </div>
          </div>
          <span class="us-status-badge status-past">Selesai</span>
          <div class="us-thumb-actions">
            <button class="thumb-action-btn" title="Lihat Undangan">👁️</button>
            <button class="thumb-action-btn" title="Salin Link">🔗</button>
            <button class="thumb-action-btn" title="Bagikan">📤</button>
          </div>
        </div>

        <div class="us-card-body us-card-body--faded">
          <div class="us-card-top">
            <div>
              <h2 class="us-card-title">Sinta & Hendra</h2>
              <p class="us-card-template">Template: Golden Hour</p>
            </div>
            <div class="us-card-menu">
              <button class="menu-btn">⋯</button>
            </div>
          </div>

          <div class="us-meta-row">
            <div class="us-meta-item">
              <span class="us-meta-icon">📅</span>
              <span>Jumat, 10 Januari 2025</span>
            </div>
            <div class="us-meta-item">
              <span class="us-meta-icon">📍</span>
              <span>Ballroom Mulia, Bandung</span>
            </div>
            <div class="us-meta-item">
              <span class="us-meta-icon">⏰</span>
              <span>11.00 – 15.00 WIB</span>
            </div>
          </div>

          <div class="us-stats-row">
            <div class="us-mini-stat">
              <div class="us-mini-stat-val">165</div>
              <div class="us-mini-stat-label">Diundang</div>
            </div>
            <div class="us-mini-stat">
              <div class="us-mini-stat-val" style="color:#3aab6d;">148</div>
              <div class="us-mini-stat-label">Hadir</div>
            </div>
            <div class="us-mini-stat">
              <div class="us-mini-stat-val" style="color:var(--coral);">17</div>
              <div class="us-mini-stat-label">Tidak Hadir</div>
            </div>
            <div class="us-mini-stat">
              <div class="us-mini-stat-val" style="color:var(--grey-600);">344</div>
              <div class="us-mini-stat-label">Views</div>
            </div>
          </div>

          <div class="us-progress-block">
            <div class="us-progress-header">
              <span class="us-progress-label">Tingkat Kehadiran</span>
              <span class="us-progress-pct" style="color:#3aab6d;">90%</span>
            </div>
            <div class="us-progress-bar">
              <div class="us-progress-fill" style="width:90%; background: linear-gradient(90deg, #3aab6d, #27ae60);"></div>
            </div>
            <div class="us-progress-breakdown">
              <span class="breakdown-dot" style="background:#3aab6d;"></span><span>148 Hadir</span>
              <span class="breakdown-dot" style="background:var(--coral); margin-left:12px;"></span><span>17 Tidak hadir</span>
            </div>
          </div>

          <!-- Recap badge -->
          <div class="us-recap-badge">
            <span>🎉</span>
            <span>Acara selesai dengan kehadiran <strong>90%</strong> — Luar biasa!</span>
          </div>

          <div class="us-actions">
            <button class="btn-primary btn-small">Lihat Rekap</button>
            <button class="btn-outline btn-small">Duplikat</button>
            <button class="btn-icon" title="Unduh Laporan">📥</button>
            <button class="btn-icon btn-icon-danger" title="Hapus">🗑️</button>
          </div>
        </div>
      </article>

    </div><!-- end invitations-container -->

    <!-- ── Empty State (hidden by default) ─── -->
    <div class="us-empty-state" id="emptyState" style="display:none;">
      <div class="us-empty-icon">📭</div>
      <h3>Tidak ada undangan ditemukan</h3>
      <p>Coba ubah filter atau kata kunci pencarian</p>
    </div>

  </main>
</div>

<script>
  // ── Filter Tabs ──────────────────────────────────
  const tabs = document.querySelectorAll('.filter-tab');
  const cards = document.querySelectorAll('.us-card');
  const emptyState = document.getElementById('emptyState');
  let activeFilter = 'all';
  let searchQuery = '';

  function applyFilters() {
    let visibleCount = 0;
    cards.forEach(card => {
      const status = card.dataset.status;
      const name = card.dataset.name;
      const matchFilter = activeFilter === 'all' || status === activeFilter;
      const matchSearch = name.includes(searchQuery.toLowerCase().trim());
      if (matchFilter && matchSearch) {
        card.style.display = '';
        visibleCount++;
      } else {
        card.style.display = 'none';
      }
    });
    emptyState.style.display = visibleCount === 0 ? 'flex' : 'none';
  }

  tabs.forEach(tab => {
    tab.addEventListener('click', () => {
      tabs.forEach(t => t.classList.remove('active'));
      tab.classList.add('active');
      activeFilter = tab.dataset.filter;
      applyFilters();
    });
  });

  document.getElementById('searchInput').addEventListener('input', e => {
    searchQuery = e.target.value;
    applyFilters();
  });

  // ── View Toggle (Grid / List) ─────────────────────
  const container = document.getElementById('invitationsContainer');
  document.getElementById('viewGrid').addEventListener('click', () => {
    container.classList.remove('list-view');
    document.getElementById('viewGrid').classList.add('active');
    document.getElementById('viewList').classList.remove('active');
  });
  document.getElementById('viewList').addEventListener('click', () => {
    container.classList.add('list-view');
    document.getElementById('viewList').classList.add('active');
    document.getElementById('viewGrid').classList.remove('active');
  });

  // ── Card entrance animations ──────────────────────
  const observer = new IntersectionObserver(entries => {
    entries.forEach((entry, i) => {
      if (entry.isIntersecting) {
        entry.target.style.opacity = '1';
        entry.target.style.transform = 'translateY(0)';
        observer.unobserve(entry.target);
      }
    });
  }, { threshold: 0.08 });

  cards.forEach((card, i) => {
    card.style.opacity = '0';
    card.style.transform = 'translateY(28px)';
    card.style.transition = `opacity 0.5s ease ${i * 0.12}s, transform 0.5s ease ${i * 0.12}s`;
    observer.observe(card);
  });


  // ── Copy link buttons ─────────────────────────────
  document.querySelectorAll('[title="Salin Link"]').forEach(btn => {
    btn.addEventListener('click', () => {
      navigator.clipboard?.writeText('https://invita.id/u/ayu-dimas-2025');
      btn.textContent = '✅';
      setTimeout(() => { btn.textContent = '🔗'; }, 1500);
    });
  });
</script>

</body>
</html>
