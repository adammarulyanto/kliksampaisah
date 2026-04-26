<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Invita — Undangan Digital yang Indah</title>
  <link rel="stylesheet" href="<?=base_url()?>/assets/css/style.css" />
</head>
<body>

<!-- ── Navbar ──────────────────────────────────────── -->
<header class="navbar">
  <div class="navbar-inner">
    <a href="#" class="logo">Invi<span>ta</span></a>

    <nav>
      <ul class="nav-links">
        <li><a href="#">Template</a></li>
        <li><a href="#">Cara Kerja</a></li>
        <li><a href="#">Harga</a></li>
        <li><a href="#">Blog</a></li>
      </ul>
    </nav>

    <div class="nav-actions">
      <?php if ($user['full_name']): ?>
      <a href="<?=base_url('profile')?>" class="btn-outline" style="padding: 9px 20px; font-size: 14px;"><?= $user['full_name'] ?></a>
      <a href="<?=base_url('logout')?>" class="btn-primary" style="padding: 9px 20px; font-size: 14px;">Logout</a>
      <?php else: ?>
      <a href="<?=base_url('login')?>" class="btn-outline" style="padding: 9px 20px; font-size: 14px;">Masuk</a>
      <a href="<?=base_url('logout')?>" class="btn-primary" style="padding: 9px 20px; font-size: 14px;">Mulai Gratis</a>
      <?php endif; ?>
    </div>
  </div>
</header>

<!-- ── Hero ────────────────────────────────────────── -->
<section class="hero">
  <div class="hero-content">
    <span class="tag">
      <svg width="10" height="10" viewBox="0 0 10 10" fill="none"><circle cx="5" cy="5" r="4" fill="currentColor" opacity=".5"/><circle cx="5" cy="5" r="2.5" fill="currentColor"/></svg>
      Undangan Digital Terpercaya
    </span>
    <h1>Undangan pernikahan<br><em>indah & berkesan</em></h1>
    <p>
      Buat undangan digital yang elegan dalam menit. Pilih dari ratusan template cantik,
      personalisasi sesuai tema, dan bagikan lewat link ke semua tamu.
    </p>
    <div class="hero-cta">
      <a href="login.html" class="btn-primary" style="padding: 15px 36px; font-size: 16px;">
        Buat Undangan Gratis
        <svg width="16" height="16" viewBox="0 0 16 16" fill="none"><path d="M3 8h10M9 4l4 4-4 4" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
      </a>
      <a href="#katalog" class="btn-outline" style="padding: 15px 36px; font-size: 16px;">Lihat Template</a>
    </div>
  </div>
</section>

<!-- ── Stats Strip ──────────────────────────────────── -->
<div class="stats-strip">
  <div class="stats-inner">
    <div class="stat">
      <span class="stat-number">Coba Gratis</span>
      <span class="stat-label">Untuk Memulai</span>
    </div>
    <div class="stat">
      <span class="stat-number">5 Menit</span>
      <span class="stat-label">Waktu Pembuatan</span>
    </div>
    <div class="stat">
      <span class="stat-number">Mudah</span>
      <span class="stat-label">Isi form langsung jadi</span>
    </div>
    <div class="stat">
      <span class="stat-number">Whatsapp-Ready</span>
      <span class="stat-label">Kirim ke semua tamu</span>
    </div>
  </div>
</div>

<!-- ── Catalog ─────────────────────────────────────── -->
<section class="catalog-section" id="katalog">
  <div class="container">
    <div class="section-header">
      <span class="tag">Katalog Template</span>
      <h2>Pilih yang cocok<br>untuk hari istimewamu</h2>
      <p>Setiap template dapat dikustomisasi warna, foto, musik, dan detail acaramu.</p>
    </div>

    <div class="catalog-grid">

      <!-- Card 1 — Floral Romance -->
      <div class="card">
        <div class="card-thumb card-thumb-floral">
          <div class="badge">Terpopuler</div>
          <div class="invite-preview style-floral">
            <div class="invite-top" style="width:32px;"></div>
            <div class="invite-sub">The Wedding of</div>
            <div class="invite-names">Ayu<br>&amp;<br>Reza</div>
            <div class="invite-divider"></div>
            <div class="invite-date">Sabtu, 14 Juni 2025</div>
          </div>
        </div>
        <div class="card-body">
          <div class="card-title">Floral Romance</div>
          <div class="card-desc">Nuansa bunga yang lembut dan romantis. Cocok untuk pernikahan bertema garden party.</div>
          <div class="card-footer">
            <div class="card-price"><span class="free">Gratis</span></div>
            <button class="card-btn">
              Gunakan
              <svg width="12" height="12" viewBox="0 0 12 12" fill="none"><path d="M2 6h8M6 2l4 4-4 4" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </button>
          </div>
        </div>
      </div>

      <!-- Card 2 — Modern Luxe -->
      <div class="card">
        <div class="card-thumb card-thumb-modern">
          <div class="badge">Premium</div>
          <div class="invite-preview style-modern">
            <div class="invite-top" style="width:32px;"></div>
            <div class="invite-sub">The Wedding of</div>
            <div class="invite-names">Clara<br>&amp;<br>Arif</div>
            <div class="invite-divider"></div>
            <div class="invite-date">Minggu, 22 Agustus 2025</div>
          </div>
        </div>
        <div class="card-body">
          <div class="card-title">Modern Luxe</div>
          <div class="card-desc">Desain modern yang bersih dengan sentuhan mewah. Ideal untuk pernikahan berkelas.</div>
          <div class="card-footer">
            <div class="card-price"><span class="paid">Rp 99.000</span></div>
            <button class="card-btn">
              Gunakan
              <svg width="12" height="12" viewBox="0 0 12 12" fill="none"><path d="M2 6h8M6 2l4 4-4 4" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </button>
          </div>
        </div>
      </div>

      <!-- Card 3 — Golden Hour -->
      <div class="card">
        <div class="card-thumb card-thumb-gold">
          <div class="invite-preview style-gold">
            <div class="invite-top" style="width:32px;"></div>
            <div class="invite-sub">The Wedding of</div>
            <div class="invite-names">Nisa<br>&amp;<br>Yusuf</div>
            <div class="invite-divider"></div>
            <div class="invite-date">Jumat, 10 Oktober 2025</div>
          </div>
        </div>
        <div class="card-body">
          <div class="card-title">Golden Hour</div>
          <div class="card-desc">Tema emas yang hangat dan elegan. Menciptakan kesan mewah di setiap detail.</div>
          <div class="card-footer">
            <div class="card-price"><span class="paid">Rp 149.000</span></div>
            <button class="card-btn">
              Gunakan
              <svg width="12" height="12" viewBox="0 0 12 12" fill="none"><path d="M2 6h8M6 2l4 4-4 4" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </button>
          </div>
        </div>
      </div>

      <!-- Card 4 — Minimalist -->
      <div class="card">
        <div class="card-thumb card-thumb-minimal">
          <div class="badge badge-free">Gratis</div>
          <div class="invite-preview style-minimal">
            <div class="invite-top" style="width:32px;"></div>
            <div class="invite-sub">The Wedding of</div>
            <div class="invite-names">Sinta<br>&amp;<br>Dimas</div>
            <div class="invite-divider"></div>
            <div class="invite-date">Sabtu, 7 Desember 2025</div>
          </div>
        </div>
        <div class="card-body">
          <div class="card-title">Minimalist</div>
          <div class="card-desc">Bersih, elegan, dan tak lekang waktu. Pilihan sempurna untuk tampilan yang simpel.</div>
          <div class="card-footer">
            <div class="card-price"><span class="free">Gratis</span></div>
            <button class="card-btn">
              Gunakan
              <svg width="12" height="12" viewBox="0 0 12 12" fill="none"><path d="M2 6h8M6 2l4 4-4 4" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </button>
          </div>
        </div>
      </div>

      <!-- Card 5 — Garden Bloom -->
      <div class="card">
        <div class="card-thumb card-thumb-garden">
          <div class="invite-preview style-garden">
            <div class="invite-top" style="width:32px;"></div>
            <div class="invite-sub">The Wedding of</div>
            <div class="invite-names">Putri<br>&amp;<br>Hendra</div>
            <div class="invite-divider"></div>
            <div class="invite-date">Minggu, 15 Februari 2026</div>
          </div>
        </div>
        <div class="card-body">
          <div class="card-title">Garden Bloom</div>
          <div class="card-desc">Segar dan natural seperti taman musim semi. Nuansa hijau yang menenangkan.</div>
          <div class="card-footer">
            <div class="card-price"><span class="paid">Rp 99.000</span></div>
            <button class="card-btn">
              Gunakan
              <svg width="12" height="12" viewBox="0 0 12 12" fill="none"><path d="M2 6h8M6 2l4 4-4 4" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </button>
          </div>
        </div>
      </div>

      <!-- Card 6 — Royal Violet -->
      <div class="card">
        <div class="card-thumb card-thumb-royal">
          <div class="badge">Baru</div>
          <div class="invite-preview style-royal">
            <div class="invite-top" style="width:32px;"></div>
            <div class="invite-sub">The Wedding of</div>
            <div class="invite-names">Dewi<br>&amp;<br>Rizal</div>
            <div class="invite-divider"></div>
            <div class="invite-date">Jumat, 20 Maret 2026</div>
          </div>
        </div>
        <div class="card-body">
          <div class="card-title">Royal Violet</div>
          <div class="card-desc">Ungu kerajaan yang megah dan berkarakter. Tampilan premium yang berkesan.</div>
          <div class="card-footer">
            <div class="card-price"><span class="paid">Rp 149.000</span></div>
            <button class="card-btn">
              Gunakan
              <svg width="12" height="12" viewBox="0 0 12 12" fill="none"><path d="M2 6h8M6 2l4 4-4 4" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </button>
          </div>
        </div>
      </div>

    </div>

    <!-- View all -->
    <div style="text-align:center; margin-top: 44px;">
      <a href="#" class="btn-outline" style="padding: 13px 36px;">
        Lihat Semua Template
        <svg width="14" height="14" viewBox="0 0 14 14" fill="none"><path d="M2 7h10M8 3l4 4-4 4" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
      </a>
    </div>
  </div>
</section>

<!-- ── CTA Banner ───────────────────────────────────── -->
<div class="container">
  <div class="cta-banner">
    <div class="cta-text">
      <h2>Siap membuat undangan<br>impianmu?</h2>
      <p>Bergabung dengan ribuan pasangan yang telah mempercayakan hari spesial mereka kepada Invita. Mulai gratis, tanpa kartu kredit.</p>
    </div>
    <div class="cta-actions">
      <a href="login.html" class="btn-white">
        Mulai Sekarang
        <svg width="14" height="14" viewBox="0 0 14 14" fill="none"><path d="M2 7h10M8 3l4 4-4 4" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
      </a>
      <a href="#" class="btn-ghost-white">Lihat Contoh</a>
    </div>
  </div>
</div>

<!-- ── Footer ───────────────────────────────────────── -->
<footer class="footer">
  <div class="footer-brand">Invi<span>ta</span></div>
  <p>© 2025 Invita. Dibuat dengan ♥ untuk hari istimewamu.</p>
</footer>

<script>
  // Smooth card entrance animation
  const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry, i) => {
      if (entry.isIntersecting) {
        entry.target.style.opacity = '1';
        entry.target.style.transform = 'translateY(0)';
        observer.unobserve(entry.target);
      }
    });
  }, { threshold: 0.1 });

  document.querySelectorAll('.card').forEach((card, i) => {
    card.style.opacity = '0';
    card.style.transform = 'translateY(32px)';
    card.style.transition = `opacity 0.5s ease ${i * 0.08}s, transform 0.5s ease ${i * 0.08}s`;
    observer.observe(card);
  });
</script>

</body>
</html>
