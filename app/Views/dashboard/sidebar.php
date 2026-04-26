<!-- ── Sidebar ─────────────────────────────────────────── -->
  <aside class="sidebar">
    <div class="sidebar-header">
      <a href="#" class="sidebar-logo">Invi<span>ta</span></a>
    </div>

    <?php
    $current_url = current_url();
    $segment = service('uri')->getSegment(1); // Mendapatkan 'dashboard' dari URL
    ?>

    <nav class="sidebar-nav">
        <a href="<?= base_url('dashboard') ?>" class="nav-item <?= ($segment == 'dashboard') ? 'active' : '' ?>" data-icon="📊">
            <span class="nav-icon">📊</span>
            <span class="nav-label">Dashboard</span>
        </a>
        <a href="<?= base_url('undangan-saya')?>" class="nav-item <?= ($segment == 'undangan-saya') ? 'active' : '' ?>" data-icon="📝">
            <span class="nav-icon">📝</span>
            <span class="nav-label">Undangan Saya</span>
        </a>
        <a href="<?= base_url('template') ?>" class="nav-item <?= ($segment == 'template') ? 'active' : '' ?>" data-icon="⭐">
            <span class="nav-icon">⭐</span>
            <span class="nav-label">Template</span>
        </a>
    </nav>

    <div class="sidebar-footer">
      <a href="<?=base_url('logout')?>" class="nav-item logout">
        <span class="nav-icon">🚪</span>
        <span class="nav-label">Keluar</span>
      </a>
    </div>
  </aside>