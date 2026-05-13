<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Template — Invita</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Pacifico&family=Nunito:wght@400;600;700;800;900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="<?=base_url()?>/assets/css/style.css" />
  <link rel="stylesheet" href="<?=base_url()?>/assets/css/template.css" />
</head>
<style>
    @media (max-width: 768px) {
      .tpl-modal-overlay{
        padding:0;
      }
      .tpl-modal{
        margin:0;
        border-radius:0;
        height: 100vh;
      }
      .modal-right{
        overflow-y:scroll;
        height:60vh;
        padding-bottom:150px;
      }
      .modal-actions{
        position:fixed;
        bottom:0;
        left:0;
        width: 100%;
        margin:0;
        padding:20px;
        background:white;
      }
    }
</style>
<body>

  <!-- ── Sidebar ─────────────────────────────────────────── -->
  <?php include('sidebar.php')?>
  
  <!-- ── Main Content ───────────────────────────────────── -->
  <main class="main">

    <!-- ── Page Header ─── -->
    <header class="tpl-header">
      <div class="tpl-header-text">
        <span class="tag">Koleksi Template</span>
        <h1>Pilih template <em>impianmu</em></h1>
        <p>5 desain eksklusif yang bisa dikustomisasi sepenuhnya — warna, foto, musik, dan detail acaramu.</p>
      </div>
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
      <?php if (!empty($templates)): ?>
        <?php foreach ($templates as $index => $template): ?>
          <!-- ══ Template Card ══ -->
          <div class="tpl-card" 
               data-cat="<?= esc(strtolower(str_replace(' ', '', $template['category'] ?? 'modern'))) ?> <?= ($template['price'] > 0) ? 'premium' : 'free' ?>" 
               data-name="<?= esc(strtolower($template['template_name'])) ?>"
               data-id="<?= $template['id'] ?>">
            
            <div class="tpl-card-thumb">
              <div class="tpl-thumb-bg tb-modern">
                <img src="<?=base_url()?>assets/img/preview/<?=$template['cover']?>">
              </div>
              <div class="tpl-thumb-overlay">
                <button class="tpl-preview-btn" data-id="<?= $template['id'] ?>">
                  <span>👁</span> Preview
                </button>
              </div>
              <div class="tpl-badges">
                <?php if ($template['price'] > 0): ?>
                  <span class="tpl-badge badge-premium">★ PREMIUM</span>
                <?php else: ?>
                  <span class="tpl-badge badge-free">GRATIS</span>
                <?php endif; ?>
              </div>
            </div>

            <div class="tpl-card-body">
              <div class="tpl-card-info">
                <div>
                  <h3 class="tpl-name"><?= esc($template['template_name']) ?></h3>
                  <p class="tpl-desc"><?= esc($template['description'] ?? 'Desain undangan digital yang elegan dan modern.') ?></p>
                </div>
                <div class="tpl-price-tag <?= ($template['price'] > 0) ? 'premium-tag' : 'free-tag' ?>">
                  <?= ($template['price'] > 0) ? 'Rp ' . number_format($template['price'], 0, ',', '.') : 'Gratis' ?>
                </div>
              </div>

              <div class="tpl-features" id="features-<?= $template['id'] ?>">
                <!-- Features akan diisi oleh JavaScript -->
              </div>

              <div class="tpl-card-footer">
                <div class="tpl-rating">
                  <span class="stars">★★★★★</span>
                  <span class="rating-num">4.8</span>
                  <span class="rating-count">(145)</span>
                </div>
                <button class="tpl-use-btn" data-id="<?= $template['id'] ?>">Lihat Detail</button>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>

    <!-- Empty state -->
    <div class="tpl-empty" id="tplEmpty" style="display:none;">
      <div style="font-size:64px;margin-bottom:16px;">🔍</div>
      <h3>Template tidak ditemukan</h3>
      <p>Coba kata kunci atau filter lain</p>
    </div>

  </main>

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
          <!-- DYNAMIC LIVE PREVIEW BUTTON: sekarang menggunakan event listener untuk redirect ke halaman preview dinamis -->
          <button class="btn-outline modal-wish" id="modalLivePreviewBtn">♡ Live Preview</button>
        </div>
        <!-- <p class="modal-guarantee">
          🛡️ Pembelian dilindungi — refund dalam 7 hari jika belum digunakan
        </p> -->
      </div>
    </div>
  </div>

  <script>
    // ─── Data from PHP ────────────────────────────────────────
    const templatesData = <?= json_encode($templates) ?>;
    // Base URL untuk redirect dinamis (sama seperti PHP base_url)
    const BASE_URL = "<?= base_url() ?>";
    
    // Mapping untuk fitur dan tags dari global_param
    const paramMap = {
      1: '🎵 Musik Latar',
      2: '🖼 Galeri Foto',
      3: '✅ Form RSVP',
      4: '🗺 Google Maps',
      5: '📱 Mobile Friendly',
      6: '💬 Ucapan Tamu',
      7: '💝 Kado untuk Mempelai',
      8: 'Garden Party',
      9: 'Outdoor Wedding',
      10: 'Romantic',
      11: 'Feminim',
      12: 'Elegant',
      13: 'Kado untuk Mempelai',
      14: 'Indoor Wedding'
    };

    // Helper untuk render features berdasarkan array ID
    function renderFeatures(featureIds) {
      if (!featureIds || featureIds.length === 0) return '';
      return featureIds.map(id => {
        const feature = paramMap[id] || `Fitur ${id}`;
        return `<span class="tpl-feat">${feature}</span>`;
      }).join('');
    }

    // Helper untuk render tags berdasarkan array ID
    function renderTags(tagIds) {
      if (!tagIds || tagIds.length === 0) return '';
      return tagIds.map(id => {
        const tag = paramMap[id] || `Tag ${id}`;
        return `<span class="modal-tag">${tag}</span>`;
      }).join('');
    }

    // Helper untuk get price display
    function getPriceDisplay(price) {
      if (price > 0) {
        return `Rp ${new Intl.NumberFormat('id-ID').format(price)}`;
      }
      return 'Gratis';
    }

    // Helper untuk get rating display (mock)
    function getRatingDisplay() {
      const rating = (Math.random() * (5 - 4) + 4).toFixed(1);
      const count = Math.floor(Math.random() * (200 - 20) + 20);
      return {
        stars: '★★★★★',
        rating: rating,
        count: count
      };
    }

    // ========= DINAMIS FUNGSI PREVIEW / MOCK PREVIEW BERDASARKAN TEMPLATE =========
    // Membuat tampilan preview mock yang dinamis sesuai tema template
    function generateDynamicPreview(template) {
      // Cek jika template memiliki file_path (gambar asli) maka tampilkan gambar
      if (template.cover) {
        return `<img 
          src="${BASE_URL}assets/img/preview/${template.cover}" 
          alt="${template.template_name}" 
          loading="lazy"
          style="width:100%; height:100%; object-fit:cover; object-position:right; transform:scale(1.1);"
          onerror="this.style.display='none'; this.parentElement.innerHTML='<div style=\'display:flex;align-items:center;justify-content:center;height:100%;color:#aaa;\'>Preview tidak tersedia</div>'"
        >`;
      }
      
      // Jika tidak ada gambar, buat mock preview berdasarkan kategori / nama template
      const name = template.template_name.toLowerCase();
      const category = (template.category || 'modern').toLowerCase();
      let titleFont = 'Pacifico';
      let bgGradient = 'linear-gradient(135deg, #fff6f0, #fde9e0)';
      let accentColor = '#b8735c';
      let namesText = 'Grooms<br>✧<br>Bride';
      let subText = 'WEDDING INVITATION';
      let dateText = '22 . 08 . 2025';
      let venueText = 'GARDEN & BALLROOM';
      
      if (name.includes('floral') || category === 'floral') {
        bgGradient = 'linear-gradient(145deg, #fef5e8, #fcead8)';
        accentColor = '#c27e5c';
        subText = 'FLORAL WEDDING';
        namesText = 'Alexandra<br>&<br>Jonathan';
        venueText = 'BALI BOTANIC GARDEN';
      } else if (name.includes('modern') || category === 'modern') {
        bgGradient = 'linear-gradient(125deg, #f9f5f0, #efe3da)';
        accentColor = '#a8654f';
        subText = 'MODERN INVITATION';
        namesText = 'MILES<br>✦<br>ELLA';
        dateText = '12 . 09 . 2025';
        venueText = 'SKY LOFT · JAKARTA';
      } else if (name.includes('classic') || category === 'classic') {
        bgGradient = 'linear-gradient(120deg, #fcf6ea, #f3e5d2)';
        accentColor = '#a55d3e';
        subText = 'CLASSIC SOIREÉ';
        namesText = 'William<br>♥<br>Catherine';
        dateText = '05 . 10 . 2025';
        venueText = 'GRAND BALLROOM';
      } else if (name.includes('nature') || category === 'nature') {
        bgGradient = 'linear-gradient(135deg, #eff4e8, #e2e6d5)';
        accentColor = '#6f8f5c';
        subText = 'NATURE ESCAPE';
        namesText = 'Ryan<br>🍃<br>Maya';
        venueText = 'FOREST PAVILION';
      }
      
      return `
        <div class="mock-preview" style="background: ${bgGradient}; width:100%; height:100%; display:flex; flex-direction:column; justify-content:center; align-items:center; text-align:center; padding:1rem;">
          <div style="font-family:'${titleFont}', cursive; font-size:1.6rem; color:${accentColor}; margin-bottom:0.5rem;">&</div>
          <div style="font-size:0.65rem; letter-spacing:2px; font-weight:700; color:${accentColor}; background:rgba(0,0,0,0.03); padding:0.2rem 0.8rem; border-radius:30px;">${subText}</div>
          <div style="font-size:1.4rem; font-weight:800; margin:0.7rem 0; color:#3a2c28; font-family:'Nunito', sans-serif;">${namesText}</div>
          <div style="width:40px; height:2px; background:${accentColor}; margin:0.3rem 0;"></div>
          <div style="font-size:0.9rem; font-weight:700; color:#5e3e2e;">${dateText}</div>
          <div style="font-size:0.65rem; letter-spacing:1px; margin-top:0.5rem; color:#7b5a48;">${venueText}</div>
        </div>
      `;
    }

    // Render fitur di tiap card (existing)
    document.querySelectorAll('.tpl-card').forEach(card => {
      const id = card.dataset.id;
      const template = templatesData.find(t => t.id == id);
      if (template && template.feature) {
        const featuresContainer = document.getElementById(`features-${id}`);
        if (featuresContainer) {
          featuresContainer.innerHTML = renderFeatures(template.feature);
        }
      }
    });

    // ─── Modal Logic with Dynamic Live Preview ─────────────────
    const overlay = document.getElementById('modalOverlay');
    const modalClose = document.getElementById('modalClose');
    let currentLivePreviewId = null;
    let currentTemplateId = null;


    function openModal(id) {
      const template = templatesData.find(t => t.id == id);
      if (!template) return;
      
      currentTemplateId = id;

      currentLivePreviewId = id;
      const rating = getRatingDisplay();
      const isFree = template.price === 0 || template.price === null;
      
      // Badge row
      const badgeEl = document.getElementById('modalBadgeRow');
      let badges = [];
      if (isFree) {
        badges.push('<span class="tpl-badge badge-free">GRATIS</span>');
      } else {
        badges.push('<span class="tpl-badge badge-premium">★ PREMIUM</span>');
      }
      if (template.max_photo && template.max_photo > 15) {
        badges.push('<span class="tpl-badge badge-popular">🔥 TERPOPULER</span>');
      }
      badgeEl.innerHTML = badges.join('');

      document.getElementById('modalTitle').textContent = template.template_name;
      document.getElementById('modalDesc').textContent = template.description || 'Desain undangan digital yang elegan dan modern. Dapat dikustomisasi sesuai keinginan Anda.';

      // Price
      const priceEl = document.getElementById('modalPrice');
      priceEl.textContent = getPriceDisplay(template.price);
      priceEl.className = 'modal-price ' + (isFree ? 'price-free' : 'price-paid');

      // Rating
      document.getElementById('modalRating').innerHTML =
        `<span style="color:#f59e0b;">${rating.stars}</span> <strong>${rating.rating}</strong> <span style="color:var(--grey-400);">(${rating.count} ulasan)</span>`;

      // Features
      document.getElementById('modalFeatures').innerHTML = 
        template.feature && template.feature.length > 0 
          ? renderFeatures(template.feature) 
          : '<span class="modal-feat">🎵 Musik Latar</span><span class="modal-feat">📱 Mobile Friendly</span>';

      // Tags / Fit To
      document.getElementById('modalTags').innerHTML = 
        template.fit_to && template.fit_to.length > 0
          ? renderTags(template.fit_to)
          : '<span class="modal-tag">Modern</span><span class="modal-tag">Elegan</span><span class="modal-tag">Romantis</span>';

      // Preview frame DINAMIS berdasarkan data template (Gambar atau mock)
      const previewFrame = document.getElementById('modalPreviewFrame');
      // menggunakan generateDynamicPreview yang akan menampilkan gambar jika ada, atau mock artistik
      previewFrame.innerHTML = generateDynamicPreview(template);
      
      // ========== MEMBUAT LIVE PREVIEW BUTTON DINAMIS ==========
      // Ambil tombol 'modalLivePreviewBtn' dan set event listener baru sekaligus menghapus listener lama (gunakan clone untuk clean)
      const livePreviewBtn = document.getElementById('modalLivePreviewBtn');
      const newLiveBtn = livePreviewBtn.cloneNode(true);
      livePreviewBtn.parentNode.replaceChild(newLiveBtn, livePreviewBtn);
      // Set ulang ID dan event
      newLiveBtn.id = 'modalLivePreviewBtn';
      newLiveBtn.textContent = '♡ Live Preview';
      
      // TAMBAHKAN EVENT DINAMIS: Redirect ke halaman live preview dengan ID template yang benar
      newLiveBtn.addEventListener('click', (e) => {
        e.preventDefault();
        // Membangun URL live preview yang dinamis sesuai base_url dan ID template
        const previewUrl = `${BASE_URL}template/preview/${template.id}`;
        // Bisa dibuka di tab baru atau window.location, sesuai permintaan: "buat button live preview dinamis"
        window.open(previewUrl, '_blank');  // membuka preview di tab baru untuk pengalaman live
        // Alternatif jika ingin redirect halaman yang sama: window.location.href = previewUrl;
      });
      
      const cta = document.getElementById('modalCta');
      const ctaClone = cta.cloneNode(true);
      cta.parentNode.replaceChild(ctaClone, cta);
      ctaClone.id = 'modalCta';
      ctaClone.textContent = isFree ? 'Gunakan Template Ini — Gratis' : `Beli Sekarang — ${getPriceDisplay(template.price)}`;
      ctaClone.addEventListener('click', () => {
          const form = document.createElement('form');
          form.method = 'POST';
          form.action = '<?= base_url('template/purchase') ?>';
          
          // Ambil CSRF token dari meta tag atau data yang sudah ada
          const csrfName = '<?= csrf_token() ?>';
          const csrfHash = '<?= csrf_hash() ?>';
          
          const csrfInput = document.createElement('input');
          csrfInput.type = 'hidden';
          csrfInput.name = csrfName;
          csrfInput.value = csrfHash;
          
          const input = document.createElement('input');
          input.type = 'hidden';
          input.name = 'template_id';
          input.value = template.id;

          form.appendChild(csrfInput);
          form.appendChild(input);
          document.body.appendChild(form);
          form.submit();
      });
      
      // Mengganti juga tombol wish/outline lainnya jika perlu (tapi sudah diatur by newLiveBtn)
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

    // Event listeners untuk preview dan use buttons (membuka modal)
    document.querySelectorAll('.tpl-preview-btn').forEach(btn => {
      btn.addEventListener('click', () => openModal(parseInt(btn.dataset.id)));
    });

    document.querySelectorAll('.tpl-use-btn').forEach(btn => {
      btn.addEventListener('click', () => openModal(parseInt(btn.dataset.id)));
    });

    // Berikutnya, untuk memastikan jika ada tombol 'modalWish' (live preview sebelumnya) sudah diganti
    // Live preview akan selalu merujuk ke ID template yang terakhir dibuka
    
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
    
    // Pastikan jika modal dibuka dengan template yang tidak memiliki image, mock dinamis tetap elegant
    console.log("Invita Template Ready — Live Preview button dinamis siap membuka /template/preview/:id");

    
  </script>
</body>
</html>