<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Template — Invita</title>
  <link rel="stylesheet" href="<?=base_url()?>/assets/css/style.css" />
  <link rel="stylesheet" href="<?=base_url()?>/assets/css/dashboard.css" />
  <link rel="stylesheet" href="<?=base_url()?>/assets/css/template.css" />
</head>
<body>

<div class="dashboard-layout">

  <!-- ── Sidebar ─────────────────────────────────────────── -->
  <?php include('sidebar.php')?>

  <!-- ── Main Content ───────────────────────────────────── -->
  <main class="dashboard-content tpl-content">

    <!-- ── Page Header ─── -->
    <header class="tpl-header">
      <div class="tpl-header-text">
        <span class="tag">Koleksi Template</span>
        <h1>Pilih template <em>impianmu</em></h1>
        <p>5 desain eksklusif yang bisa dikustomisasi sepenuhnya — warna, foto, musik, dan detail acaramu.</p>
      </div>
      <!-- <div class="tpl-header-stats">
        <div class="tpl-hstat">
          <span class="tpl-hstat-num">5</span>
          <span class="tpl-hstat-label">Template Tersedia</span>
        </div>
        <div class="tpl-hstat-div"></div>
        <div class="tpl-hstat">
          <span class="tpl-hstat-num">2</span>
          <span class="tpl-hstat-label">Gratis</span>
        </div>
        <div class="tpl-hstat-div"></div>
        <div class="tpl-hstat">
          <span class="tpl-hstat-num">3</span>
          <span class="tpl-hstat-label">Premium</span>
        </div>
      </div> -->
    </header>

    <!-- ── Filter & Search ─── -->
    <div class="tpl-controls">
      <div class="tpl-filter-tabs">
        <button class="tpl-tab active" data-cat="all">Semua</button>
        <button class="tpl-tab" data-cat="free">
          <span class="free-dot"></span>Gratis
        </button>
        <button class="tpl-tab" data-cat="premium">
          <span class="premium-star">★</span>Premium
        </button>
        <button class="tpl-tab" data-cat="floral">Floral</button>
        <button class="tpl-tab" data-cat="modern">Modern</button>
        <button class="tpl-tab" data-cat="classic">Klasik</button>
        <button class="tpl-tab" data-cat="nature">Alam</button>
      </div>
      <div class="tpl-search">
        <span>🔍</span>
        <input type="text" placeholder="Cari template..." id="tplSearch" />
      </div>
    </div>

    <!-- ── Template Grid ─── -->
    <div class="tpl-grid" id="tplGrid">

      <!-- ══ CARD 1: Floral Romance ══ -->
      <div class="tpl-card" data-cat="floral free" data-name="floral romance">
        <div class="tpl-card-thumb">
          <div class="tpl-thumb-bg tb-floral">
            <!-- Mock invitation preview -->
            <div class="tpl-mock mock-floral">
              <div class="tm-deco tm-deco-top">✿ ✾ ✿</div>
              <div class="tm-line" style="background:var(--orange);width:36px;"></div>
              <div class="tm-sub">The Wedding of</div>
              <div class="tm-names tm-names-floral">Ayu<br><span class="tm-amp">&</span><br>Dimas</div>
              <div class="tm-line tm-line-thin" style="background:var(--orange);width:28px;"></div>
              <div class="tm-date">Sabtu, 14 Juni 2025</div>
              <div class="tm-venue">Gedung Harmoni · Jakarta</div>
              <div class="tm-deco tm-deco-bot">✿ ✾ ✿</div>
            </div>
          </div>

          <!-- Overlay on hover -->
          <div class="tpl-thumb-overlay">
            <button class="tpl-preview-btn" data-id="1">
              <span>👁</span> Preview
            </button>
          </div>

          <!-- Badges -->
          <div class="tpl-badges">
            <span class="tpl-badge badge-free">GRATIS</span>
            <span class="tpl-badge badge-popular">🔥 Terpopuler</span>
          </div>
        </div>

        <div class="tpl-card-body">
          <div class="tpl-card-info">
            <div>
              <h3 class="tpl-name">Floral Romance</h3>
              <p class="tpl-desc">Nuansa bunga yang lembut dan romantis. Cocok untuk garden party.</p>
            </div>
            <div class="tpl-price-tag free-tag">Gratis</div>
          </div>

          <div class="tpl-features">
            <span class="tpl-feat">🎵 Musik</span>
            <span class="tpl-feat">🖼 Galeri</span>
            <span class="tpl-feat">✅ RSVP</span>
            <span class="tpl-feat">🗺 Maps</span>
          </div>

          <div class="tpl-card-footer">
            <div class="tpl-rating">
              <span class="stars">★★★★★</span>
              <span class="rating-num">4.9</span>
              <span class="rating-count">(238)</span>
            </div>
            <button class="tpl-use-btn" data-id="1">Gunakan</button>
          </div>
        </div>
      </div>

      <!-- ══ CARD 2: Modern Luxe ══ -->
      <div class="tpl-card" data-cat="modern premium" data-name="modern luxe">
        <div class="tpl-card-thumb">
          <div class="tpl-thumb-bg tb-modern">
            <div class="tpl-mock mock-modern">
              <div class="tm-line-h"></div>
              <div class="tm-sub tm-sub-modern">WEDDING INVITATION</div>
              <div class="tm-names tm-names-modern">CLARA<br><span class="tm-amp-modern">×</span><br>ARIF</div>
              <div class="tm-line-h"></div>
              <div class="tm-date tm-date-modern">22 · 08 · 2025</div>
              <div class="tm-venue tm-venue-modern">THE RITZ-CARLTON · BALI</div>
            </div>
          </div>
          <div class="tpl-thumb-overlay">
            <button class="tpl-preview-btn" data-id="2">
              <span>👁</span> Preview
            </button>
          </div>
          <div class="tpl-badges">
            <span class="tpl-badge badge-premium">★ PREMIUM</span>
          </div>
        </div>

        <div class="tpl-card-body">
          <div class="tpl-card-info">
            <div>
              <h3 class="tpl-name">Modern Luxe</h3>
              <p class="tpl-desc">Desain modern yang bersih dengan sentuhan mewah dan elegan.</p>
            </div>
            <div class="tpl-price-tag premium-tag">Rp 99.000</div>
          </div>

          <div class="tpl-features">
            <span class="tpl-feat">🎵 Musik</span>
            <span class="tpl-feat">🖼 Galeri</span>
            <span class="tpl-feat">✅ RSVP</span>
            <span class="tpl-feat">🗺 Maps</span>
            <span class="tpl-feat">💌 Amplop Digital</span>
          </div>

          <div class="tpl-card-footer">
            <div class="tpl-rating">
              <span class="stars">★★★★★</span>
              <span class="rating-num">4.8</span>
              <span class="rating-count">(145)</span>
            </div>
            <button class="tpl-use-btn" data-id="2">Gunakan</button>
          </div>
        </div>
      </div>

      <!-- ══ CARD 3: Golden Hour ══ -->
      <div class="tpl-card" data-cat="classic premium" data-name="golden hour">
        <div class="tpl-card-thumb">
          <div class="tpl-thumb-bg tb-gold">
            <div class="tpl-mock mock-gold">
              <div class="tm-gold-border">
                <div class="tm-corner tmc-tl">◆</div>
                <div class="tm-corner tmc-tr">◆</div>
                <div class="tm-sub" style="color:#b8860b;letter-spacing:0.18em;">THE WEDDING OF</div>
                <div class="tm-names tm-names-gold">Nisa<br><span>&amp;</span><br>Yusuf</div>
                <div class="tm-gold-ornament">— ◇ —</div>
                <div class="tm-date" style="color:#b8860b;">10 Oktober 2025</div>
                <div class="tm-corner tmc-bl">◆</div>
                <div class="tm-corner tmc-br">◆</div>
              </div>
            </div>
          </div>
          <div class="tpl-thumb-overlay">
            <button class="tpl-preview-btn" data-id="3">
              <span>👁</span> Preview
            </button>
          </div>
          <div class="tpl-badges">
            <span class="tpl-badge badge-premium">★ PREMIUM</span>
            <span class="tpl-badge badge-new">BARU</span>
          </div>
        </div>

        <div class="tpl-card-body">
          <div class="tpl-card-info">
            <div>
              <h3 class="tpl-name">Golden Hour</h3>
              <p class="tpl-desc">Tema emas klasik yang hangat — mewah di setiap detail ornamen.</p>
            </div>
            <div class="tpl-price-tag premium-tag">Rp 149.000</div>
          </div>

          <div class="tpl-features">
            <span class="tpl-feat">🎵 Musik</span>
            <span class="tpl-feat">🖼 Galeri</span>
            <span class="tpl-feat">✅ RSVP</span>
            <span class="tpl-feat">🗺 Maps</span>
            <span class="tpl-feat">💌 Amplop Digital</span>
            <span class="tpl-feat">🎞 Cinematic Intro</span>
          </div>

          <div class="tpl-card-footer">
            <div class="tpl-rating">
              <span class="stars">★★★★★</span>
              <span class="rating-num">5.0</span>
              <span class="rating-count">(42)</span>
            </div>
            <button class="tpl-use-btn" data-id="3">Gunakan</button>
          </div>
        </div>
      </div>

      <!-- ══ CARD 4: Minimalist ══ -->
      <div class="tpl-card" data-cat="modern free" data-name="minimalist">
        <div class="tpl-card-thumb">
          <div class="tpl-thumb-bg tb-minimal">
            <div class="tpl-mock mock-minimal">
              <div class="tm-minimal-line"></div>
              <div class="tm-sub" style="font-size:7px;letter-spacing:0.22em;color:#888;">WEDDING OF</div>
              <div class="tm-names tm-names-minimal">Sinta<br><span style="font-size:10px;font-style:normal;color:#aaa;">dan</span><br>Dimas</div>
              <div class="tm-minimal-line"></div>
              <div style="font-size:8px;letter-spacing:0.14em;color:#888;text-transform:uppercase;">7 Desember 2025</div>
            </div>
          </div>
          <div class="tpl-thumb-overlay">
            <button class="tpl-preview-btn" data-id="4">
              <span>👁</span> Preview
            </button>
          </div>
          <div class="tpl-badges">
            <span class="tpl-badge badge-free">GRATIS</span>
          </div>
        </div>

        <div class="tpl-card-body">
          <div class="tpl-card-info">
            <div>
              <h3 class="tpl-name">Minimalist</h3>
              <p class="tpl-desc">Bersih, elegan, dan tak lekang waktu. Untuk tampilan yang simpel.</p>
            </div>
            <div class="tpl-price-tag free-tag">Gratis</div>
          </div>

          <div class="tpl-features">
            <span class="tpl-feat">🎵 Musik</span>
            <span class="tpl-feat">✅ RSVP</span>
            <span class="tpl-feat">🗺 Maps</span>
          </div>

          <div class="tpl-card-footer">
            <div class="tpl-rating">
              <span class="stars">★★★★☆</span>
              <span class="rating-num">4.6</span>
              <span class="rating-count">(89)</span>
            </div>
            <button class="tpl-use-btn" data-id="4">Gunakan</button>
          </div>
        </div>
      </div>

      <!-- ══ CARD 5: Garden Bloom ══ -->
      <div class="tpl-card" data-cat="nature floral premium" data-name="garden bloom">
        <div class="tpl-card-thumb">
          <div class="tpl-thumb-bg tb-garden">
            <div class="tpl-mock mock-garden">
              <div class="tm-leaf-top">🌿</div>
              <div class="tm-sub" style="color:#4a8c5a;letter-spacing:0.12em;">the wedding of</div>
              <div class="tm-names tm-names-garden">Putri<br><span style="color:#6aab7a;font-style:italic;font-size:11px;">bersama</span><br>Hendra</div>
              <div class="tm-garden-stem">|</div>
              <div class="tm-date" style="color:#4a8c5a;font-size:8px;">15 · Februari · 2026</div>
              <div class="tm-leaf-bot">🌿</div>
            </div>
          </div>
          <div class="tpl-thumb-overlay">
            <button class="tpl-preview-btn" data-id="5">
              <span>👁</span> Preview
            </button>
          </div>
          <div class="tpl-badges">
            <span class="tpl-badge badge-premium">★ PREMIUM</span>
          </div>
        </div>

        <div class="tpl-card-body">
          <div class="tpl-card-info">
            <div>
              <h3 class="tpl-name">Garden Bloom</h3>
              <p class="tpl-desc">Segar dan natural seperti taman musim semi yang penuh bunga.</p>
            </div>
            <div class="tpl-price-tag premium-tag">Rp 99.000</div>
          </div>

          <div class="tpl-features">
            <span class="tpl-feat">🎵 Musik</span>
            <span class="tpl-feat">🖼 Galeri</span>
            <span class="tpl-feat">✅ RSVP</span>
            <span class="tpl-feat">🗺 Maps</span>
            <span class="tpl-feat">💌 Amplop Digital</span>
          </div>

          <div class="tpl-card-footer">
            <div class="tpl-rating">
              <span class="stars">★★★★★</span>
              <span class="rating-num">4.7</span>
              <span class="rating-count">(73)</span>
            </div>
            <button class="tpl-use-btn" data-id="5">Gunakan</button>
          </div>
        </div>
      </div>

    </div><!-- end tpl-grid -->

    <!-- Empty state -->
    <div class="tpl-empty" id="tplEmpty" style="display:none;">
      <div style="font-size:64px;margin-bottom:16px;">🔍</div>
      <h3>Template tidak ditemukan</h3>
      <p>Coba kata kunci atau filter lain</p>
    </div>

  </main>
</div>

<!-- ══ Preview Modal ══════════════════════════════════════ -->
<div class="tpl-modal-overlay" id="modalOverlay">
  <div class="tpl-modal">
    <button class="modal-close" id="modalClose">✕</button>

    <div class="modal-left">
      <div class="modal-preview-frame" id="modalPreviewFrame">
        <!-- Filled by JS -->
      </div>
    </div>

    <div class="modal-right">
      <div class="modal-badge-row" id="modalBadgeRow"></div>
      <h2 class="modal-title" id="modalTitle"></h2>
      <p class="modal-desc" id="modalDesc"></p>

      <div class="modal-price-row">
        <span class="modal-price" id="modalPrice"></span>
        <div class="modal-rating" id="modalRating"></div>
      </div>

      <div class="modal-section-label">Fitur Termasuk</div>
      <div class="modal-features" id="modalFeatures"></div>

      <div class="modal-section-label">Cocok untuk</div>
      <div class="modal-tags" id="modalTags"></div>

      <div class="modal-actions">
        <button class="btn-primary modal-cta" id="modalCta">Gunakan Template Ini</button>
        <button class="btn-outline modal-wish" id="modalWish">♡ Simpan</button>
      </div>

      <p class="modal-guarantee">
        🛡️ Pembelian dilindungi — refund dalam 7 hari jika belum digunakan
      </p>
    </div>
  </div>
</div>

<script>
// ─── Template Data ────────────────────────────────────────
const templates = {
  1: {
    title: 'Floral Romance',
    desc: 'Nuansa bunga yang lembut dan romantis. Ideal untuk garden party, outdoor wedding, atau pasangan yang suka estetika bunga yang hangat dan feminin.',
    price: 'Gratis',
    isFree: true,
    rating: '4.9',
    count: '238',
    badges: ['GRATIS', '🔥 Terpopuler'],
    features: ['🎵 Musik Latar', '🖼 Galeri Foto', '✅ Form RSVP', '🗺 Google Maps', '📱 Mobile Friendly', '💬 Ucapan Tamu'],
    tags: ['Garden Party', 'Outdoor Wedding', 'Romantic', 'Feminin'],
    color: 'var(--orange)',
    previewColor: '#fff3ec',
  },
  2: {
    title: 'Modern Luxe',
    desc: 'Desain modern yang bersih dan elegan dengan tipografi bold. Untuk pasangan yang menginginkan tampilan profesional dan sophisticated.',
    price: 'Rp 99.000',
    isFree: false,
    rating: '4.8',
    count: '145',
    badges: ['★ PREMIUM'],
    features: ['🎵 Musik Latar', '🖼 Galeri Foto', '✅ Form RSVP', '🗺 Google Maps', '💌 Amplop Digital', '📱 Mobile Friendly', '💬 Ucapan Tamu', '🔢 Countdown Timer'],
    tags: ['Modern', 'Mewah', 'Minimalis', 'Ballroom'],
    color: '#7c5cbf',
    previewColor: '#f0ebe6',
  },
  3: {
    title: 'Golden Hour',
    desc: 'Kemewahan ornamen emas klasik yang memukau. Lengkap dengan intro sinematik dan amplop digital. Untuk pernikahan bertema mewah dan berkesan.',
    price: 'Rp 149.000',
    isFree: false,
    rating: '5.0',
    count: '42',
    badges: ['★ PREMIUM', 'BARU'],
    features: ['🎵 Musik Latar', '🖼 Galeri Foto', '✅ Form RSVP', '🗺 Google Maps', '💌 Amplop Digital', '🎞 Cinematic Intro', '📱 Mobile Friendly', '💬 Ucapan Tamu', '🔢 Countdown Timer'],
    tags: ['Klasik', 'Mewah', 'Gold Theme', 'Ballroom'],
    color: '#c9a84c',
    previewColor: '#fdf8e8',
  },
  4: {
    title: 'Minimalist',
    desc: 'Bersih, elegan, dan tidak berlebihan. Desain yang membiarkan nama pasangan jadi bintang utama tanpa distraksi apapun.',
    price: 'Gratis',
    isFree: true,
    rating: '4.6',
    count: '89',
    badges: ['GRATIS'],
    features: ['🎵 Musik Latar', '✅ Form RSVP', '🗺 Google Maps', '📱 Mobile Friendly', '💬 Ucapan Tamu'],
    tags: ['Minimalis', 'Modern', 'Simpel', 'Casual'],
    color: '#333',
    previewColor: '#faf6f3',
  },
  5: {
    title: 'Garden Bloom',
    desc: 'Segar dan natural layaknya taman musim semi. Warna hijau sage yang menenangkan, sempurna untuk intimate wedding di alam terbuka.',
    price: 'Rp 99.000',
    isFree: false,
    rating: '4.7',
    count: '73',
    badges: ['★ PREMIUM'],
    features: ['🎵 Musik Latar', '🖼 Galeri Foto', '✅ Form RSVP', '🗺 Google Maps', '💌 Amplop Digital', '📱 Mobile Friendly', '💬 Ucapan Tamu', '🔢 Countdown Timer'],
    tags: ['Alam', 'Garden', 'Intimate', 'Outdoor'],
    color: '#4a8c5a',
    previewColor: '#f0f8ef',
  },
};

// ─── Modal Logic ──────────────────────────────────────────
const overlay = document.getElementById('modalOverlay');
const modalClose = document.getElementById('modalClose');

function openModal(id) {
  const t = templates[id];
  if (!t) return;

  // Badge row
  const badgeEl = document.getElementById('modalBadgeRow');
  badgeEl.innerHTML = t.badges.map(b =>
    b.includes('GRATIS') ? `<span class="tpl-badge badge-free">${b}</span>` :
    b.includes('PREMIUM') ? `<span class="tpl-badge badge-premium">${b}</span>` :
    b.includes('Terpopuler') ? `<span class="tpl-badge badge-popular">${b}</span>` :
    `<span class="tpl-badge badge-new">${b}</span>`
  ).join('');

  document.getElementById('modalTitle').textContent = t.title;
  document.getElementById('modalDesc').textContent = t.desc;

  // Price
  const priceEl = document.getElementById('modalPrice');
  priceEl.textContent = t.price;
  priceEl.className = 'modal-price ' + (t.isFree ? 'price-free' : 'price-paid');

  // Rating
  document.getElementById('modalRating').innerHTML =
    `<span style="color:#f59e0b;">★★★★★</span> <strong>${t.rating}</strong> <span style="color:var(--grey-400);">(${t.count} ulasan)</span>`;

  // Features
  document.getElementById('modalFeatures').innerHTML =
    t.features.map(f => `<span class="modal-feat">${f}</span>`).join('');

  // Tags
  document.getElementById('modalTags').innerHTML =
    t.tags.map(tag => `<span class="modal-tag">${tag}</span>`).join('');

  // Preview frame
  document.getElementById('modalPreviewFrame').style.background = t.previewColor;

  // CTA
  const cta = document.getElementById('modalCta');
  cta.textContent = t.isFree ? 'Gunakan Template Ini — Gratis' : `Beli & Gunakan — ${t.price}`;

  overlay.classList.add('active');
  document.body.style.overflow = 'hidden';
}

function closeModal() {
  overlay.classList.remove('active');
  document.body.style.overflow = '';
}

modalClose.addEventListener('click', closeModal);
overlay.addEventListener('click', e => { if (e.target === overlay) closeModal(); });
document.addEventListener('keydown', e => { if (e.key === 'Escape') closeModal(); });

document.querySelectorAll('.tpl-preview-btn').forEach(btn => {
  btn.addEventListener('click', () => openModal(+btn.dataset.id));
});

document.querySelectorAll('.tpl-use-btn').forEach(btn => {
  btn.addEventListener('click', () => openModal(+btn.dataset.id));
});

document.getElementById('modalCta').addEventListener('click', () => {
  alert('Diarahkan ke halaman pembayaran / pembuatan undangan');
  closeModal();
});

// ─── Filter & Search ──────────────────────────────────────
const tabs = document.querySelectorAll('.tpl-tab');
const cards = document.querySelectorAll('.tpl-card');
const tplEmpty = document.getElementById('tplEmpty');
let activeCategory = 'all';
let searchQuery = '';

function applyFilters() {
  let visible = 0;
  cards.forEach(card => {
    const cat = card.dataset.cat || '';
    const name = card.dataset.name || '';
    const matchCat = activeCategory === 'all' || cat.includes(activeCategory);
    const matchSearch = name.includes(searchQuery.toLowerCase().trim());
    const show = matchCat && matchSearch;
    card.style.display = show ? '' : 'none';
    if (show) visible++;
  });
  tplEmpty.style.display = visible === 0 ? 'flex' : 'none';
}

tabs.forEach(tab => {
  tab.addEventListener('click', () => {
    tabs.forEach(t => t.classList.remove('active'));
    tab.classList.add('active');
    activeCategory = tab.dataset.cat;
    applyFilters();
  });
});

document.getElementById('tplSearch').addEventListener('input', e => {
  searchQuery = e.target.value;
  applyFilters();
});

// ─── Card Entrance Animation ──────────────────────────────
const observer = new IntersectionObserver(entries => {
  entries.forEach((entry, i) => {
    if (entry.isIntersecting) {
      entry.target.style.opacity = '1';
      entry.target.style.transform = 'translateY(0) scale(1)';
      observer.unobserve(entry.target);
    }
  });
}, { threshold: 0.08 });

cards.forEach((card, i) => {
  card.style.opacity = '0';
  card.style.transform = 'translateY(32px) scale(0.97)';
  card.style.transition = `opacity 0.55s ease ${i * 0.1}s, transform 0.55s ease ${i * 0.1}s`;
  observer.observe(card);
});
</script>

</body>
</html>