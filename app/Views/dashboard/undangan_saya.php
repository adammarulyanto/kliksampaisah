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
<link rel="stylesheet" href="<?=base_url()?>assets/css/undangan-saya.css" />
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

    <!-- ── Summary Bar (Dynamic) ─── -->
    <?php 
    // Hitung summary dari data
    $total_undangan = count($wedding_data);
    $total_tamu = array_sum(array_column($wedding_data, 'tamu'));
    $total_rsvp = array_sum(array_column($wedding_data, 'rsvp'));
    $total_views = array_sum(array_column($wedding_data, 'viewed'));
    $avg_rsvp_rate = $total_tamu > 0 ? round(($total_rsvp / $total_tamu) * 100) : 0;
    
    // Hitung upcoming & past
    $upcoming_count = 0;
    $past_count = 0;
    foreach ($wedding_data as $w) {
        if ($w->days_left > 0) $upcoming_count++;
        else if ($w->days_left < 0) $past_count++;
    }
    ?>


  <!-- STATS -->
  <div class="stat-grid">
    <div class="stat-card c1">
      <div class="stat-bg"></div>
      <div class="stat-icon"><i class="fa-solid fa-at"></i></div>
      <div class="stat-label">Total Undangan</div>
      <div class="stat-value"><?= esc($total_undangan) ?></div>
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

    <div class="card"  style="margin-bottom:20px;">
  <!-- ── Filter & Sort Bar ─── -->
    <div class="filter-bar">
      <div class="filter-tabs">
        <button class="filter-tab active" data-filter="all">Semua</button>
        <button class="filter-tab" data-filter="upcoming">Akan Datang</button>
        <button class="filter-tab" data-filter="past">Sudah Lewat</button>
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
  <!-- CONTENT GRID -->
    <?php if (!empty($wedding_data)): ?>
        <?php foreach ($wedding_data as $row): ?>
          <?php 
          // Tentukan status
          if ($row->days_left > 0) {
              $status = 'upcoming';
              $status_text = 'Akan Datang';
              $status_class = 'status-upcoming';
          } elseif ($row->days_left == 0) {
              $status = 'today';
              $status_text = 'Hari Ini!';
              $status_class = 'status-today';
          } else {
              $status = 'past';
              $status_text = 'Sudah Lewat';
              $status_class = 'status-past';
          }
          
          // Format tanggal
          $formatted_date = date('l, d F Y', strtotime($row->event_date));
          
          // Hitung persentase RSVP
          $rsvp_percent = $row->tamu > 0 ? round(($row->rsvp / $row->tamu) * 100) : 0;
          $belum_rsvp = $row->tamu - $row->rsvp;
          
          // Format days_left
          $days_left_abs = abs($row->days_left);
          $days_text = $row->days_left > 0 ? "$days_left_abs hari lagi" : ($row->days_left == 0 ? "Hari ini!" : "Sudah lewat $days_left_abs hari");
          ?>
          <article class="us-card" data-status="<?= $status ?>" data-name="<?= strtolower(esc($row->nickname_men . ' ' . $row->nickname_women)) ?>">
              <!-- Thumbnail side -->
              <div class="us-card-thumb">
                <div class="us-thumb-bg bg-floral">
                  <div class="us-invite-mock style-floral">
                    <div class="invite-top" style="width:32px;"></div>
                    <div class="invite-sub">The Wedding of</div>
                    <div class="invite-names"><?= esc($row->nickname_men) ?><br>&amp;<br><?= esc($row->nickname_women) ?></div>
                    <div class="invite-divider"></div>
                    <div class="invite-date"><?= date('d/m/Y', strtotime($row->event_date)) ?></div>
                  </div>
                </div>
                <span class="us-status-badge <?= $status_class ?>"><?= $status_text ?></span>
                <div class="us-thumb-actions">
                  <button class="thumb-action-btn" title="Lihat Undangan" onclick="window.location='<?= base_url($row->url_name) ?>'">👁️</button>
                  <button class="thumb-action-btn copy-link-btn" title="Salin Link" data-link="<?= base_url($row->url_name) ?>">🔗</button>
                  <button class="thumb-action-btn share-btn" title="Bagikan" data-link="<?= base_url($row->url_name) ?>">📤</button>
                </div>
              </div>

              <!-- Info side -->
              <div class="us-card-body">
                <div class="us-card-top">
                  <div>
                    <h2 class="us-card-title"><?= esc($row->nickname_men) ?> & <?= esc($row->nickname_women) ?></h2>
                    <p class="us-card-template">Template: <?= esc($row->template_name) ?></p>
                  </div>
                  <div class="us-card-menu">
                    <button class="menu-btn" title="Opsi lainnya">⋯</button>
                  </div>
                </div>

                <!-- Date & Venue -->
                <div class="us-meta-row">
                  <div class="us-meta-item">
                    <span class="us-meta-icon">💌</span>
                    <span><?=esc($row->event_name)?></span>
                  </div>
                  <div class="us-meta-item">
                    <span class="us-meta-icon">📅</span>
                    <span><?= $formatted_date ?></span>
                  </div>
                  <div class="us-meta-item">
                    <span class="us-meta-icon">📍</span>
                    <span><?= esc($row->location) ?></span>
                  </div>
                  <div class="us-meta-item">
                    <span class="us-meta-icon">⏰</span>
                    <span><?= esc($row->start_at) ?> – <?= esc($row->end_at) ?></span>
                  </div>
                </div>

                <!-- Stats Row -->
                <div class="us-stats-row">
                  <div class="us-mini-stat">
                    <div class="us-mini-stat-val"><?= esc($row->tamu) ?></div>
                    <div class="us-mini-stat-label">Tamu</div>
                  </div>
                  <div class="us-mini-stat">
                    <div class="us-mini-stat-val"><?= esc($row->rsvp) ?></div>
                    <div class="us-mini-stat-label">RSVP</div>
                  </div>
                  <div class="us-mini-stat">
                    <div class="us-mini-stat-val"><?= esc($belum_rsvp) ?></div>
                    <div class="us-mini-stat-label">Belum</div>
                  </div>
                  <div class="us-mini-stat">
                    <div class="us-mini-stat-val"><?= esc($row->viewed) ?></div>
                    <div class="us-mini-stat-label">Views</div>
                  </div>
                </div>

                <!-- RSVP Progress -->
                <div class="us-progress-block">
                  <div class="us-progress-header">
                    <span class="us-progress-label">Konfirmasi Kehadiran</span>
                    <span class="us-progress-pct"><?= $rsvp_percent ?>%</span>
                  </div>
                  <div class="us-progress-bar">
                    <div class="us-progress-fill" style="width:<?= $rsvp_percent ?>%;"></div>
                  </div>
                  <div class="us-progress-breakdown">
                    <span class="breakdown-dot dot-hadir"></span><span><?= esc($row->rsvp) ?> Hadir</span>
                    <span class="breakdown-dot dot-belum" style="margin-left:12px;"></span><span><?= esc($belum_rsvp) ?> Belum konfirmasi</span>
                  </div>
                </div>

                <!-- Countdown -->
                <div class="us-countdown-row">
                  <span class="us-meta-icon">⏳</span>
                  <span class="us-countdown-text"><?= $days_text ?></span>
                  <span class="us-countdown-sub">menuju hari H</span>
                </div>

                <!-- Actions -->
                <div class="us-actions">
                  <button class="btn-save btn-small" onclick="window.location='<?= base_url('undangan/' . $row->url_name . '/guest-list') ?>'">Daftar Tamu</button>
                  <button class="btn-cancel btn-small" onclick="window.location='<?= base_url('undangan/' . $row->url_name . '/edit') ?>'">Edit</button>
                </div>
              </div>
            </article>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>
</main>



<script src="<?=base_url()?>assets/js/dashboard.js"></script>

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

  // ── Copy link functionality ─────────────────────────
  function copyToClipboard(text, btn) {
    navigator.clipboard.writeText(text).then(() => {
      const originalText = btn.textContent;
      btn.textContent = '✅';
      setTimeout(() => { btn.textContent = originalText; }, 1500);
    });
  }

  document.querySelectorAll('.copy-link-btn').forEach(btn => {
    btn.addEventListener('click', (e) => {
      e.stopPropagation();
      const link = btn.dataset.link;
      copyToClipboard(link, btn);
    });
  });

  // ── Share functionality ────────────────────────────
  document.querySelectorAll('.share-btn').forEach(btn => {
    btn.addEventListener('click', async (e) => {
      e.stopPropagation();
      const link = btn.dataset.link;
      if (navigator.share) {
        try {
          await navigator.share({
            title: 'Undangan Pernikahan',
            text: 'Anda diundang!',
            url: link
          });
        } catch (err) {
          console.log('Error sharing:', err);
        }
      } else {
        copyToClipboard(link, btn);
      }
    });
  });

  // ── Delete confirmation ────────────────────────────
  document.querySelectorAll('.delete-btn').forEach(btn => {
    btn.addEventListener('click', (e) => {
      e.stopPropagation();
      const id = btn.dataset.id;
      if (confirm('Apakah Anda yakin ingin menghapus undangan ini?')) {
        window.location.href = `<?= base_url('dashboard/hapus/') ?>${id}`;
      }
    });
  });
</script>
</body>
</html>