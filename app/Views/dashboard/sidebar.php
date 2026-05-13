
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<?php
$current_url = current_url();
$segment = service('uri')->getSegment(1); // Mendapatkan 'dashboard' dari URL
?>

<!-- SIDEBAR desktop -->
<aside class="sidebar">
  <div class="logo"><div class="logo-icon"><i class="fa-solid fa-at"></i></span></div> Undangin</div>

  <div class="nav-section">Pembuatan</div>
  <a class="nav-item <?= ($segment == 'dashboard') ? 'active' : '' ?>" href="<?= base_url('dashboard')?>"><span class="nav-icon"><i class="fas fa-home"></i></span> Dashboard</a>
  <a class="nav-item <?= ($segment == 'undangan-saya' or $segment == 'undangan') ? 'active' : '' ?>" href="<?= base_url('undangan-saya')?>"><span class="nav-icon"><i class="fa-solid fa-at"></i></span> Undanganku </a>
  <a class="nav-item <?= ($segment == 'template') ? 'active' : '' ?>" href="<?= base_url('template')?>"><span class="nav-icon"><i class="fa-solid fa-square-poll-horizontal"></i></span> Template</a>
  
  <div class="sidebar-bottom">
    <div class="user-card">
      <div><div class="user-name"><?=$user['full_name']?></div><div class="user-plan">✨ Basic Plan</div></div>
      <a class="logout-btn" href="<?=base_url('logout')?>" style="margin-left:70px"><i class="fa-solid fa-arrow-right-from-bracket"></i></a>
    </div>
  </div>
</aside>

<!-- DRAWER mobile -->
<div class="drawer-overlay" id="overlay" onclick="closeDrawer()"></div>
<div class="drawer" id="drawer">
  <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:22px;">
    <div class="logo" style="margin-bottom:0;"><div class="logo-icon"><i class="fa-solid fa-at"></i></div> Undangin</div>
    <div onclick="closeDrawer()" style="font-size:18px;cursor:pointer;color:var(--text3);padding:4px 8px;">✕</div>
  </div>

  <div class="nav-section">Pembuatan</div>
  <a class="nav-item <?= ($segment == 'dashboard') ? 'active' : '' ?>" href="<?= base_url('dashboard')?>" onclick="closeDrawer()"><span class="nav-icon"><i class="fas fa-home"></i></span> Dashboard</a>
  <a class="nav-item <?= ($segment == 'undangan-saya') ? 'active' : '' ?>" href="<?= base_url('undangan-saya')?>" onclick="closeDrawer()"><span class="nav-icon"><i class="fa-solid fa-at"></i></span> Undanganku </a>
  <a class="nav-item <?= ($segment == 'template') ? 'active' : '' ?>" href="<?= base_url('template')?>" onclick="closeDrawer()"><span class="nav-icon"><i class="fa-solid fa-square-poll-horizontal"></i></span> Template</a>

  <div class="sidebar-bottom">
    <div class="user-card">
      <div><div class="user-name"><?=$user['full_name']?></div><div class="user-plan">✨ Pro Plan</div></div>
      <a class="logout-btn" href="<?=base_url('logout')?>" style="margin-left:70px"><i class="fa-solid fa-arrow-right-from-bracket"></i></a>
    </div>
  </div>
</div>


<!-- BOTTOM NAV mobile -->
<nav class="bottom-nav">
  <a href="<?= base_url() ?>" class="bnav-item <?= ($segment == 'dashboard') ? 'active' : '' ?>">
    <div class="bnav-icon"><i class="fas fa-home"></i></div>Beranda
  </a>
  <a href="<?= base_url('undangan-saya') ?>" class="bnav-item <?= ($segment == 'undangan-saya' or $segment == 'undangan') ? 'active' : '' ?>">
    <div class="bnav-icon"><i class="fa-solid fa-at"></i></div>Undangan
  </a>
  <div class="bnav-fab" 
    <?= ($segment == 'undangan') 
      ? 'onclick="openAddModal()"' 
      : 'onclick="window.location=\'' . base_url('buat-undangan') . '\'"' ?>>
    <?= ($segment == 'undangan') ? '<i class="fa-solid fa-user-plus"></i>' : '<i class="fa-solid fa-plus"></i>' ?>
  </div>
  <a href="<?= base_url('template') ?>" class="bnav-item <?= ($segment == 'template') ? 'active' : '' ?>">
    <div class="bnav-icon"><i class="fa-solid fa-square-poll-horizontal"></i></div>Template
  </a>
  <a href="<?= base_url('akun') ?>" class="bnav-item <?= ($segment == 'akun') ? 'active' : '' ?>">
    <div class="bnav-icon"><i class="fa-solid fa-user"></i></div>Akun
  </a>
</nav>