<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Masuk — Invita</title>
  <link rel="stylesheet" href="<?=base_url()?>/assets/css/style.css" />
</head>
<body>

<div class="login-page">
  <!-- ── Left Visual Panel ─────────────────────────── -->
  <div class="login-visual">
    <div class="visual-content">

      <div class="visual-logo" style="cursor:pointer" onClick="window.location='<?=base_url()?>'">Klik<span>Sampai</span>Sah</div>

      <!-- Floating invitation mockups -->
      <div class="invite-mockups">
        <div class="mock-card mock-card-1">
          <div class="mock-line" style="width:28px;"></div>
          <div class="mock-name">Sarah<br>&amp; Daniel</div>
          <div class="mock-date">12 · 09 · 2025</div>
        </div>
        <div class="mock-card mock-card-2">
          <div class="mock-line coral" style="width:28px;"></div>
          <div class="mock-name coral">Rina<br>&amp; Bagas</div>
          <div class="mock-date">08 · 11 · 2025</div>
        </div>
        <div class="mock-card mock-card-3">
          <div class="mock-line gold" style="width:28px;"></div>
          <div class="mock-name gold">Dita<br>&amp; Fahmi</div>
          <div class="mock-date">15 · 03 · 2026</div>
        </div>
      </div>

      <p class="visual-tagline">
        Buat undangan<br>
        yang <em>tak terlupakan</em>
      </p>
      <p class="visual-sub">
        Ratusan template indah siap kamu personalisasi.<br>
        Bagikan dengan satu link, tanpa biaya cetak.
      </p>

    </div>
  </div>

  <!-- ── Right Form Panel ────────────────────────── -->
  <div class="login-panel">
    <div class="login-form-wrap">

      <!-- Mobile logo (hidden on desktop via CSS visual panel) -->
      <div class="visual-logo" style="display:none; margin-bottom:32px; font-size:22px;">
        Klik<span>Sampai</span>Sah
      </div>

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

      <div class="form-header">
        <h1>Selamat datang</h1>
        <p>Belum punya akun? <a href="/register">Daftar gratis</a></p>
      </div>

      <form class="login-form" action="<?=base_url('login')?>" method="post">
        <?= csrf_field() ?>
        <!-- Email -->
        <div class="form-group">
          <label for="email">Alamat Email</label>
          <input
            type="email"
            id="email"
            name="email"
            placeholder="nama@email.com"
            autocomplete="email"
          />
        </div>

        <!-- Password -->
        <div class="form-group">
          <label for="password">Password</label>
          <input
            type="password"
            id="password"
            name="password"
            placeholder="Masukkan password"
            autocomplete="current-password"
          />
        </div>

        <!-- Forgot password -->
        <div class="form-row-link">
          <a href="#">Lupa password?</a>
        </div>

        <!-- Submit -->
        <button type="submit" class="btn-primary login-submit">
          Masuk
        </button>

        <!-- Divider -->
        <div class="divider">atau</div>

        <!-- Google -->
        <button type="button" class="btn-google" onclick="window.location='<?= $googleAuthUrl ?>'">
          <!-- Google "G" icon -->
          <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M17.64 9.205c0-.639-.057-1.252-.164-1.841H9v3.481h4.844a4.14 4.14 0 0 1-1.796 2.716v2.259h2.908c1.702-1.567 2.684-3.875 2.684-6.615Z" fill="#4285F4"/>
            <path d="M9 18c2.43 0 4.467-.806 5.956-2.18l-2.908-2.259c-.806.54-1.837.86-3.048.86-2.344 0-4.328-1.584-5.036-3.711H.957v2.332A8.997 8.997 0 0 0 9 18Z" fill="#34A853"/>
            <path d="M3.964 10.71A5.41 5.41 0 0 1 3.682 9c0-.593.102-1.17.282-1.71V4.958H.957A8.996 8.996 0 0 0 0 9c0 1.452.348 2.827.957 4.042l3.007-2.332Z" fill="#FBBC05"/>
            <path d="M9 3.58c1.321 0 2.508.454 3.44 1.345l2.582-2.58C13.463.891 11.426 0 9 0A8.997 8.997 0 0 0 .957 4.958L3.964 7.29C4.672 5.163 6.656 3.58 9 3.58Z" fill="#EA4335"/>
          </svg>
          Lanjutkan dengan Google
        </button>

      </form>

      <p style="margin-top: 28px; font-size: 12px; color: var(--grey-400); text-align: center; line-height: 1.7;">
        Dengan masuk, kamu menyetujui
        <a href="#" style="color: var(--pink);">Syarat &amp; Ketentuan</a>
        dan
        <a href="#" style="color: var(--pink);">Kebijakan Privasi</a> kami.
      </p>

    </div>
  </div>

</div>

<script>
  // Show mobile logo when visual panel is hidden
  const visualPanel = document.querySelector('.login-visual');
  const mobileLogo = document.querySelector('.login-form-wrap .visual-logo');

  function checkLayout() {
    if (window.innerWidth <= 900) {
      mobileLogo.style.display = 'block';
    } else {
      mobileLogo.style.display = 'none';
    }
  }

  checkLayout();
  window.addEventListener('resize', checkLayout);

  // Input focus animation
  document.querySelectorAll('.form-group input').forEach(input => {
    input.addEventListener('focus', () => {
      input.parentElement.style.transform = 'translateX(2px)';
      input.parentElement.style.transition = 'transform 0.2s ease';
    });
    input.addEventListener('blur', () => {
      input.parentElement.style.transform = '';
    });
  });
</script>

</body>
</html>
