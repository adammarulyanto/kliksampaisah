<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Undangan Pernikahan – Alya & Reza</title>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;1,400;1,500&family=Lato:wght@300;400&family=Dancing+Script:wght@500;700&display=swap" rel="stylesheet">
<style>
:root{
  --sage:#7A9E7E;
  --sage-dark:#4F7352;
  --sage-light:#B8D4BB;
  --sage-dim:rgba(122,158,126,0.12);
  --cream:#FAF6EF;
  --cream-mid:#EDE5D4;
  --cream-dark:#C5B49A;
  --brown:#5C4A35;
  --brown-mid:#8C7055;
  --white:#FFFFFF;
}
*,*::before,*::after{margin:0;padding:0;box-sizing:border-box}
html{scroll-behavior:smooth}
body{background:var(--cream);color:var(--brown);font-family:'Lato',sans-serif;overflow-x:hidden}

/* LEAF DECORATIONS SVG inline backgrounds */

/* NAV */
nav{position:fixed;top:0;left:0;right:0;z-index:100;background:rgba(250,246,239,0.94);backdrop-filter:blur(10px);border-bottom:1px solid rgba(122,158,126,0.2)}
.nav-inner{max-width:640px;margin:0 auto;display:flex;gap:0;overflow-x:auto;scrollbar-width:none}
.nav-inner::-webkit-scrollbar{display:none}
.nav-inner a{flex-shrink:0;padding:13px 16px;font-family:'Lato',sans-serif;font-size:10px;letter-spacing:.25em;color:var(--brown-mid);text-decoration:none;text-transform:uppercase;font-weight:400;transition:color .3s;white-space:nowrap}
.nav-inner a:hover{color:var(--sage-dark)}

.page{max-width:640px;margin:0 auto}

/* ─── 1. COVER ─── */
#cover{min-height:100vh;display:flex;flex-direction:column;align-items:center;justify-content:center;padding:100px 40px 60px;text-align:center;position:relative;background:var(--cream);overflow:hidden}

/* Botanical SVG background leaves */
#cover::before{content:'';position:absolute;top:-40px;left:-60px;width:260px;height:260px;background:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 200 200'%3E%3Cpath d='M20 180 C20 100 80 20 160 20 C80 20 160 80 120 160 C80 180 40 200 20 180Z' fill='%237A9E7E' opacity='0.12'/%3E%3Cpath d='M10 160 Q60 80 140 40' stroke='%237A9E7E' stroke-width='1' fill='none' opacity='0.2'/%3E%3Cpath d='M40 160 Q70 110 110 80' stroke='%237A9E7E' stroke-width='.8' fill='none' opacity='0.15'/%3E%3C/svg%3E") no-repeat center/contain;pointer-events:none}
#cover::after{content:'';position:absolute;bottom:-40px;right:-60px;width:260px;height:260px;background:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 200 200'%3E%3Cpath d='M180 20 C180 100 120 180 40 180 C120 180 40 120 80 40 C120 20 160 0 180 20Z' fill='%237A9E7E' opacity='0.12'/%3E%3Cpath d='M190 40 Q140 120 60 160' stroke='%237A9E7E' stroke-width='1' fill='none' opacity='0.2'/%3E%3C/svg%3E") no-repeat center/contain;pointer-events:none}

.cover-badge{display:inline-block;background:var(--sage-dim);border:1px solid rgba(122,158,126,0.3);color:var(--sage-dark);font-size:9px;letter-spacing:.4em;text-transform:uppercase;padding:7px 22px;margin-bottom:32px;font-family:'Lato';font-weight:400;opacity:0;animation:fadeUp 1s ease .2s forwards}
.cover-script{font-family:'Dancing Script',cursive;font-size:22px;color:var(--sage);margin-bottom:12px;opacity:0;animation:fadeUp 1s ease .4s forwards}
.cover-names{font-family:'Playfair Display',serif;font-size:64px;font-weight:400;line-height:1.05;color:var(--brown);margin-bottom:6px;opacity:0;animation:fadeUp 1s ease .6s forwards}
.cover-names em{display:block;font-style:italic;color:var(--sage-dark)}
.cover-amp{font-family:'Dancing Script',cursive;font-size:56px;color:var(--sage);display:block;line-height:1;margin:0 0 6px;opacity:0;animation:fadeUp 1s ease .5s forwards}
.cover-tagline{font-size:14px;color:var(--brown-mid);letter-spacing:.1em;margin-top:28px;font-style:italic;font-weight:300;opacity:0;animation:fadeUp 1s ease .8s forwards}
.cover-date-wrap{margin-top:36px;opacity:0;animation:fadeUp 1s ease 1s forwards}
.leaf-divider{display:flex;align-items:center;gap:12px;justify-content:center;margin-bottom:12px}
.leaf-divider svg{width:60px;opacity:.5}
.leaf-divider .midline{width:60px;height:1px;background:var(--sage)}
.cover-date-text{font-size:13px;color:var(--brown-mid);letter-spacing:.3em;text-transform:uppercase}
.scroll-cue{position:absolute;bottom:32px;display:flex;flex-direction:column;align-items:center;gap:6px;opacity:0;animation:fadeUp 1s ease 1.4s forwards}
.scroll-cue span{font-size:8px;letter-spacing:.35em;color:var(--cream-dark);text-transform:uppercase}
.scroll-line{width:1px;height:36px;background:linear-gradient(to bottom,var(--sage),transparent);animation:pulse 2s ease-in-out infinite}

/* SECTION BASE */
section{padding:80px 48px;border-top:1px solid rgba(122,158,126,0.15)}
.sec-label{font-size:9px;letter-spacing:.45em;color:var(--sage-dark);text-transform:uppercase;text-align:center;display:block;margin-bottom:12px}
.sec-heading{font-family:'Playfair Display',serif;font-size:36px;font-weight:400;text-align:center;color:var(--brown);margin-bottom:36px;line-height:1.2}
.sec-heading em{font-style:italic;color:var(--sage-dark)}
.herb-divider{display:flex;align-items:center;gap:12px;margin:28px 0}
.herb-divider .hl{flex:1;height:1px;background:linear-gradient(to right,transparent,rgba(122,158,126,0.4),transparent)}
.herb-divider svg{width:20px;flex-shrink:0;opacity:.6}

/* ─── 2. PENGANTAR ─── */
#pengantar{background:var(--white);text-align:center;position:relative;overflow:hidden}
#pengantar::before{content:'';position:absolute;top:0;left:0;bottom:0;width:6px;background:linear-gradient(to bottom,var(--sage-light),var(--sage),var(--sage-light))}
.quran-box{background:var(--sage-dim);border:1px solid rgba(122,158,126,0.25);border-radius:4px;padding:32px;margin-bottom:32px;position:relative}
.quran-ar{font-family:'Playfair Display',serif;font-size:22px;font-style:italic;color:var(--sage-dark);line-height:1.8;margin-bottom:12px;direction:rtl}
.quran-tr{font-size:13px;font-style:italic;color:var(--brown-mid);line-height:1.9;margin-bottom:10px}
.quran-ref{font-size:10px;letter-spacing:.25em;color:var(--sage);text-transform:uppercase}
.pengantar-body{font-size:15px;line-height:2.1;color:var(--brown-mid);font-weight:300;max-width:480px;margin:0 auto}

/* ─── 3. MEMPELAI ─── */
#mempelai{background:var(--cream)}
.couple-wrap{display:grid;grid-template-columns:1fr 80px 1fr;gap:24px;align-items:center}
.bride-card,.groom-card{text-align:center}
.avatar-ring{width:150px;height:150px;margin:0 auto 20px;border-radius:50%;border:2px solid rgba(122,158,126,0.35);background:var(--white);display:flex;align-items:center;justify-content:center;position:relative}
.avatar-ring::before{content:'';position:absolute;inset:-6px;border-radius:50%;border:1px dashed rgba(122,158,126,0.3)}
.avatar-ring svg{width:56px;opacity:.35}
.mp-script{font-family:'Dancing Script',cursive;font-size:28px;color:var(--sage-dark);margin-bottom:4px}
.mp-full{font-size:13px;font-style:italic;color:var(--brown-mid);margin-bottom:16px}
.parents-tag{font-size:10px;letter-spacing:.2em;text-transform:uppercase;color:var(--sage);display:block;margin-bottom:6px}
.parents-name{font-size:14px;color:var(--brown-mid);line-height:1.9;font-weight:300}
.and-center{display:flex;flex-direction:column;align-items:center;justify-content:center;gap:0}
.and-script{font-family:'Dancing Script',cursive;font-size:52px;color:var(--sage);line-height:1}

/* ─── 4. ACARA ─── */
#acara{background:var(--white)}
.timeline{position:relative;padding-left:36px}
.timeline::before{content:'';position:absolute;left:6px;top:8px;bottom:8px;width:1px;background:linear-gradient(to bottom,var(--sage-light),var(--sage),var(--sage-light))}
.tl-item{position:relative;margin-bottom:36px;padding-left:20px}
.tl-dot{position:absolute;left:-32px;top:6px;width:14px;height:14px;border-radius:50%;border:2px solid var(--sage);background:var(--cream);display:flex;align-items:center;justify-content:center}
.tl-dot::after{content:'';width:5px;height:5px;border-radius:50%;background:var(--sage)}
.tl-tag{font-size:9px;letter-spacing:.3em;color:var(--sage);text-transform:uppercase;margin-bottom:4px;display:block}
.tl-title{font-family:'Playfair Display',serif;font-size:20px;color:var(--brown);margin-bottom:6px}
.tl-meta{font-size:13px;color:var(--brown-mid);line-height:1.9;font-weight:300}
.tl-badge{display:inline-block;margin-top:8px;padding:3px 12px;border:1px solid rgba(122,158,126,0.3);font-size:10px;color:var(--sage-dark);letter-spacing:.15em;border-radius:99px}

/* ─── 5. LOKASI ─── */
#lokasi{background:var(--cream)}
.map-frame{border:1px solid rgba(122,158,126,0.25);overflow:hidden;margin-bottom:20px;position:relative}
.map-frame iframe{width:100%;height:300px;display:block;filter:saturate(0.5) brightness(1.05)}
.map-tag{position:absolute;bottom:14px;left:14px;background:rgba(250,246,239,0.93);border:1px solid rgba(122,158,126,0.3);padding:8px 16px;backdrop-filter:blur(8px)}
.map-tag span{font-size:9px;letter-spacing:.3em;color:var(--sage-dark);text-transform:uppercase}
.venue-info{display:grid;grid-template-columns:1fr auto;gap:20px;align-items:center;background:var(--white);border:1px solid rgba(122,158,126,0.18);padding:24px 28px}
.venue-n{font-family:'Playfair Display',serif;font-size:20px;color:var(--brown);margin-bottom:4px}
.venue-a{font-size:13px;color:var(--brown-mid);line-height:1.9;font-weight:300;font-style:italic}
.map-link{padding:11px 22px;border:1px solid var(--sage);color:var(--sage-dark);font-size:9px;letter-spacing:.3em;text-decoration:none;text-transform:uppercase;white-space:nowrap;transition:all .3s}
.map-link:hover{background:var(--sage);color:var(--white)}

/* ─── 6. GALLERY ─── */
#gallery{background:var(--white)}
.gallery-masonry{display:grid;grid-template-columns:repeat(3,1fr);gap:6px}
.gal-item{aspect-ratio:1;overflow:hidden;cursor:pointer;position:relative;background:var(--cream-mid)}
.gal-item:hover .gal-overlay{opacity:1}
.gal-placeholder{width:100%;height:100%;display:flex;flex-direction:column;align-items:center;justify-content:center;gap:8px;background:var(--cream-mid);transition:transform .4s ease}
.gal-item:hover .gal-placeholder{transform:scale(1.05)}
.gal-placeholder svg{width:28px;opacity:.25}
.gal-placeholder span{font-size:8px;letter-spacing:.3em;color:var(--cream-dark);text-transform:uppercase;opacity:.7}
.gal-overlay{position:absolute;inset:0;background:rgba(79,115,82,0.25);display:flex;align-items:center;justify-content:center;opacity:0;transition:opacity .3s}
.gal-overlay svg{width:24px}

/* lightbox */
.lb{display:none;position:fixed;inset:0;background:rgba(0,0,0,.88);z-index:200;align-items:center;justify-content:center}
.lb.open{display:flex}
.lb-img{max-width:85vw;max-height:85vh;object-fit:contain;border:2px solid rgba(122,158,126,.3)}
.lb-close{position:fixed;top:20px;right:20px;width:40px;height:40px;background:var(--sage);border:none;cursor:pointer;color:white;font-size:20px;display:flex;align-items:center;justify-content:center;border-radius:50%}

/* ─── 7. RSVP ─── */
#rsvp{background:var(--cream)}
.rsvp-wrap{max-width:480px;margin:0 auto;background:var(--white);border:1px solid rgba(122,158,126,0.2);padding:44px 40px;position:relative}
.rsvp-wrap::before{content:'';position:absolute;top:0;left:0;right:0;height:4px;background:linear-gradient(to right,var(--sage-light),var(--sage),var(--sage-light))}
.rsvp-form{display:flex;flex-direction:column;gap:16px}
.fl{font-size:9px;letter-spacing:.35em;color:var(--sage-dark);text-transform:uppercase;display:block;margin-bottom:5px}
.fi,.fs,.ft{width:100%;border:1px solid rgba(122,158,126,0.25);background:var(--cream);color:var(--brown);font-family:'Lato';font-size:15px;padding:11px 16px;outline:none;transition:border-color .3s}
.fi:focus,.fs:focus,.ft:focus{border-color:var(--sage)}
.ft{height:88px;resize:none}
.fs{appearance:none;cursor:pointer}
.fs option{background:var(--white)}
.rsvp-cta{padding:14px;background:var(--sage);border:none;color:var(--white);font-family:'Lato';font-size:10px;letter-spacing:.4em;text-transform:uppercase;cursor:pointer;transition:background .3s}
.rsvp-cta:hover{background:var(--sage-dark)}
.rsvp-ok{display:none;text-align:center;padding:28px 0;color:var(--sage-dark);font-family:'Dancing Script';font-size:28px}

/* ─── 8. UCAPAN ─── */
#ucapan{background:var(--white)}
.wish-stream{display:flex;flex-direction:column;gap:16px;max-height:440px;overflow-y:auto;padding-right:6px;scrollbar-width:thin;scrollbar-color:rgba(122,158,126,.3) transparent;margin-bottom:28px}
.w-card{background:var(--cream);border-left:3px solid var(--sage-light);padding:20px 22px}
.w-text{font-size:15px;line-height:1.9;color:var(--brown-mid);font-weight:300;font-style:italic;margin-bottom:12px}
.w-footer{display:flex;align-items:center;justify-content:space-between}
.w-name{font-size:10px;letter-spacing:.25em;color:var(--sage-dark);text-transform:uppercase}
.w-status{font-size:10px;color:var(--cream-dark)}
.add-wish{background:var(--cream);border:1px solid rgba(122,158,126,0.2);padding:28px}
.add-wish-row{display:grid;grid-template-columns:1fr 1fr;gap:12px;margin-bottom:12px}
.wish-submit{padding:11px 28px;background:var(--sage-dim);border:1px solid var(--sage);color:var(--sage-dark);font-size:9px;letter-spacing:.3em;text-transform:uppercase;cursor:pointer;font-family:'Lato';transition:all .3s}
.wish-submit:hover{background:var(--sage);color:var(--white)}

/* ─── 9. FOOTER ─── */
#footer{background:var(--sage-dark);padding:64px 40px;text-align:center;color:var(--cream)}
.ft-leaf{margin-bottom:28px;opacity:.5}
.ft-names{font-family:'Dancing Script',cursive;font-size:40px;color:var(--cream);margin-bottom:8px}
.ft-tagline{font-size:14px;color:rgba(250,246,239,.7);font-style:italic;margin-bottom:20px;font-weight:300}
.ft-date{font-size:10px;letter-spacing:.35em;text-transform:uppercase;color:var(--sage-light);margin-bottom:40px}
.ft-copy{font-size:11px;color:rgba(250,246,239,.35);letter-spacing:.15em}

/* ANIMATIONS */
@keyframes fadeUp{from{opacity:0;transform:translateY(24px)}to{opacity:1;transform:translateY(0)}}
@keyframes pulse{0%,100%{opacity:.5}50%{opacity:1}}
.reveal{opacity:0;transform:translateY(28px);transition:opacity .8s ease,transform .8s ease}
.reveal.visible{opacity:1;transform:translateY(0)}

@media(max-width:480px){
  .cover-names{font-size:44px}
  .couple-wrap{grid-template-columns:1fr;gap:8px}
  .and-center{flex-direction:row;gap:16px;padding:8px 0}
  .and-script{font-size:36px}
  section{padding:60px 24px}
  .rsvp-wrap{padding:32px 24px}
  .add-wish-row{grid-template-columns:1fr}
  .venue-info{grid-template-columns:1fr}
  .gallery-masonry{grid-template-columns:repeat(3,1fr)}
}
</style>
</head>
<body>

<div class="page">

<!-- 1. COVER -->
<section id="cover">
  <!-- <span class="cover-badge">Undangan Pernikahan</span> -->
  <p class="cover-script">Dengan penuh cinta & syukur</p>
  <div class="cover-names">
    <span id="tpl-bride-name"><em>Alya Safira</em></span>
    <span class="cover-amp">&</span>
    <span id="tpl-groom-name">Reza Firmansyah</span>
  </div>
  <p class="cover-tagline">"Dua jiwa, satu perjalanan, satu tujuan."</p>
  <div class="cover-date-wrap">
    <div class="leaf-divider">
      <svg viewBox="0 0 60 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M2 10 C10 2 30 0 58 10" stroke="#7A9E7E" stroke-width="1.2" fill="none"/><path d="M20 10 C25 4 35 3 45 10" stroke="#7A9E7E" stroke-width=".7" fill="none" opacity=".5"/></svg>
      <div class="midline"></div>
      <svg viewBox="0 0 60 20" fill="none" xmlns="http://www.w3.org/2000/svg" style="transform:scaleX(-1)"><path d="M2 10 C10 2 30 0 58 10" stroke="#7A9E7E" stroke-width="1.2" fill="none"/></svg>
    </div>
    <p class="cover-date-text"><span id="tpl-resepsi-day">Minggu</span> · <span id ="tpl-resepsi-date">29 Juni 2025</span> · Bandung</p>
  </div>
  <div class="scroll-cue">
    <span>Gulir ke bawah</span>
    <div class="scroll-line"></div>
  </div>
</section>

<!-- 2. PENGANTAR -->
<section id="pengantar">
  <span class="sec-label reveal">Bismillah</span>
  <h2 class="sec-heading reveal">Kata <em>Pengantar</em></h2>
  <div class="quran-box reveal">
    <p class="quran-tr">"Dan di antara tanda-tanda kekuasaan-Nya ialah Dia menciptakan untukmu istri-istri dari jenismu sendiri, supaya kamu cenderung dan merasa tentram kepadanya."</p>
    <span class="quran-ref">— QS. Ar-Rum: 21</span>
  </div>
  <p class="pengantar-body reveal">
    Assalamu'alaikum Warahmatullahi Wabarakatuh.<br><br>
    Maha Suci Allah yang telah menciptakan makhluk-Nya berpasang-pasangan. Ya Allah, perkenankanlah kami menyatukan dua hati yang saling mencintai dalam ikatan suci pernikahan.<br><br>
    Dengan segala kerendahan hati, kami mengundang Bapak/Ibu/Saudara/i untuk turut merayakan hari bahagia ini dan memberikan doa restu yang tulus untuk pernikahan kami.
  </p>
</section>

<!-- 3. MEMPELAI -->
<section id="mempelai">
  <span class="sec-label reveal">Kedua Mempelai</span>
  <h2 class="sec-heading reveal">Mereka yang <em>Bersatu</em></h2>
  <div class="couple-wrap reveal">
    <div class="bride-card">
      <div class="avatar-ring">
        <svg viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="40" cy="28" r="16" stroke="#7A9E7E" stroke-width="1.5"/><path d="M12 72 C12 52 68 52 68 72" stroke="#7A9E7E" stroke-width="1.5" fill="none"/></svg>
      </div>
      <div class="mp-script">Alya Safira</div>
      <div class="mp-full">Alya Safira Dewi, S.Psi.</div>
      <div class="herb-divider" style="margin:12px 0"><div class="hl"></div><svg viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M10 2 C4 8 4 16 10 18 C16 16 16 8 10 2Z" fill="#7A9E7E" opacity=".5"/></svg><div class="hl"></div></div>
      <span class="parents-tag">Putri dari</span>
      <p class="parents-name">Bapak Ir. Hendra Wijaya<br>& Ibu dr. Sari Wulandari</p>
    </div>
    <div class="and-center">
      <div class="and-script">&</div>
    </div>
    <div class="groom-card">
      <div class="avatar-ring">
        <svg viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="40" cy="28" r="16" stroke="#7A9E7E" stroke-width="1.5"/><path d="M12 72 C12 52 68 52 68 72" stroke="#7A9E7E" stroke-width="1.5" fill="none"/></svg>
      </div>
      <div class="mp-script">Reza Firmansyah</div>
      <div class="mp-full">Reza Firmansyah, S.E., M.M.</div>
      <div class="herb-divider" style="margin:12px 0"><div class="hl"></div><svg viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M10 2 C4 8 4 16 10 18 C16 16 16 8 10 2Z" fill="#7A9E7E" opacity=".5"/></svg><div class="hl"></div></div>
      <span class="parents-tag">Putra dari</span>
      <p class="parents-name">Bapak H. Bambang Firmansyah<br>& Ibu Hj. Ratna Dewi</p>
    </div>
  </div>
</section>

<!-- 4. ACARA -->
<section id="acara">
  <span class="sec-label reveal">Jadwal</span>
  <h2 class="sec-heading reveal">Rangkaian <em>Acara</em></h2>
  <div class="timeline reveal">
    <div class="tl-item">
      <div class="tl-dot"></div>
      <span class="tl-tag">Sabtu, 28 Juni 2025</span>
      <div class="tl-title">Siraman & Pengajian</div>
      <p class="tl-meta">16:00 – 21:00 WIB<br>Kediaman Keluarga Mempelai Wanita<br>Jl. Cihampelas No. 22, Bandung</p>
      <span class="tl-badge">Keluarga & Kerabat Dekat</span>
    </div>
    <div class="tl-item">
      <div class="tl-dot"></div>
      <span class="tl-tag">Minggu, 29 Juni 2025 · Pagi</span>
      <div class="tl-title">Akad Nikah</div>
      <p class="tl-meta">08:00 – 10:00 WIB<br>Masjid Agung Kota Bandung<br>Alun-Alun Kota Bandung</p>
      <span class="tl-badge">Dress Code: Putih & Sage Green</span>
    </div>
    <div class="tl-item">
      <div class="tl-dot"></div>
      <span class="tl-tag">Minggu, 29 Juni 2025 · Siang</span>
      <div class="tl-title">Resepsi Pernikahan</div>
      <p class="tl-meta">11:00 – 15:00 WIB<br>The Trans Luxury Hotel Bandung<br>Jl. Gatot Subroto No. 289, Bandung</p>
      <span class="tl-badge">Smart Formal Attire</span>
    </div>
    <div class="tl-item" style="margin-bottom:0">
      <div class="tl-dot"></div>
      <span class="tl-tag">Senin, 30 Juni 2025</span>
      <div class="tl-title">Walimah Syukuran</div>
      <p class="tl-meta">09:00 – 13:00 WIB<br>Kediaman Keluarga Mempelai Pria<br>Jl. Pasirkaliki No. 55, Bandung</p>
    </div>
  </div>
</section>

<!-- 5. LOKASI -->
<section id="lokasi">
  <span class="sec-label reveal">Venue</span>
  <h2 class="sec-heading reveal">Lokasi <em>Acara</em></h2>
  <div class="map-frame reveal">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.6!2d107.6098!3d-6.9175!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e6398252477f%3A0xcb8a66a7c5a8af6a!2sThe%20Trans%20Luxury%20Hotel%20Bandung!5e0!3m2!1sen!2sid!4v1" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    <div class="map-tag"><span>Venue Resepsi</span></div>
  </div>
  <div class="venue-info reveal">
    <div>
      <div class="venue-n">The Trans Luxury Hotel</div>
      <div class="venue-a">Jl. Gatot Subroto No. 289<br>Bandung, Jawa Barat 40274</div>
    </div>
    <a class="map-link" href="https://maps.google.com/?q=The+Trans+Luxury+Hotel+Bandung" target="_blank">Buka Maps</a>
  </div>
</section>

<!-- 6. GALLERY -->
<section id="gallery">
  <span class="sec-label reveal">Kenangan</span>
  <h2 class="sec-heading reveal">Galeri <em>Foto</em></h2>
  <div class="gallery-masonry reveal" id="galleryGrid2">
    <script>
      const lbls=['Pre-Wedding','Pertunangan','Kebersamaan','Momen Indah','Bersama Keluarga','Pre-Wedding','Cinta','Bahagia','Kenangan'];
      document.currentScript.insertAdjacentHTML('afterend', lbls.map((l,i)=>`
        <div class="gal-item" onclick="openLb2(${i})">
          <div class="gal-placeholder">
            <svg viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M5 30 C8 18 20 10 35 14" stroke="#7A9E7E" stroke-width="1.2" fill="none" opacity=".4"/><circle cx="20" cy="20" r="10" stroke="#7A9E7E" stroke-width="1" opacity=".25"/><circle cx="26" cy="14" r="3" fill="#7A9E7E" opacity=".2"/></svg>
            <span>${l}</span>
          </div>
          <div class="gal-overlay"><svg viewBox="0 0 24 24" fill="none"><path d="M12 5 C8 5 4 8 4 12 C4 16 8 19 12 19 C16 19 20 16 20 12" stroke="white" stroke-width="1.5"/><circle cx="12" cy="12" r="3" stroke="white" stroke-width="1.5"/></svg></div>
        </div>`).join(''));
    </script>
  </div>
  <p style="text-align:center;margin-top:16px;font-size:12px;font-style:italic;color:var(--cream-dark)" class="reveal">Ganti placeholder dengan foto pre-wedding Anda</p>
  <div class="lb" id="lb2" onclick="closeLb2()">
    <button class="lb-close" onclick="closeLb2()">×</button>
    <img class="lb-img" id="lbImg2" src="" alt="">
  </div>
</section>

<!-- 7. RSVP -->
<section id="rsvp">
  <span class="sec-label reveal">Konfirmasi</span>
  <h2 class="sec-heading reveal">RSVP</h2>
  <div class="rsvp-wrap reveal">
    <form class="rsvp-form" id="rsvpForm2" onsubmit="submitRsvp2(event)">
      <div><label class="fl">Nama Lengkap</label><input class="fi" type="text" placeholder="Nama Anda" required></div>
      <div><label class="fl">Nomor Whatsapp</label><input class="fi" type="tel" placeholder="08xx-xxxx-xxxx"></div>
      <div><label class="fl">Kehadiran</label>
        <select class="fs">
          <option value="">Pilih konfirmasi</option>
          <option>✓ Saya akan hadir</option>
          <option>✗ Tidak dapat hadir</option>
          <option>? Masih belum pasti</option>
        </select>
      </div>
      <div><label class="fl">Pesan</label>
        <textarea class="ft" id="wText2" placeholder="Tuliskan ucapan terbaik Anda…"></textarea>
      </div>
      <button type="submit" class="rsvp-cta">Kirim Konfirmasi</button>
    </form>
    <div class="rsvp-ok" id="rsvpOk2">Terima kasih! 🌿<br>Kami menantikan kehadiran Anda</div>
  </div>
</section>

<!-- 8. UCAPAN -->
<section id="ucapan">
  <span class="sec-label reveal">Doa & Harapan</span>
  <h2 class="sec-heading reveal">Kata <em>Sahabat</em></h2>
  <div class="wish-stream reveal" id="wishList2">
    <div class="w-card">
      <p class="w-text">Barakallahu lakuma wa baraka 'alaikuma wa jama'a bainakuma fi khair. Semoga menjadi keluarga yang sakinah, mawaddah, wa rahmah selalu.</p>
      <div class="w-footer"><span class="w-name">Siti Nurhaliza</span><span class="w-status">✓ Hadir</span></div>
    </div>
    <div class="w-card">
      <p class="w-text">Selamat menempuh hidup baru, semoga pernikahan kalian membawa kebahagiaan yang tak terhingga. Titip salam untuk keluarga besar.</p>
      <div class="w-footer"><span class="w-name">Andika Pratama</span><span class="w-status">✓ Hadir</span></div>
    </div>
    <div class="w-card">
      <p class="w-text">Wah sudah menikah! Semoga selalu dalam lindungan-Nya dan dilimpahi keberkahan. Maaf tidak bisa hadir langsung ya.</p>
      <div class="w-footer"><span class="w-name">Mega Putri</span><span class="w-status">✗ Tidak Hadir</span></div>
    </div>
  </div>
</section>

<!-- 9. FOOTER -->
<footer id="footer">
  <div class="ft-leaf">
    <svg viewBox="0 0 200 40" width="160" fill="none" xmlns="http://www.w3.org/2000/svg">
      <path d="M20 20 C60 5 140 5 180 20" stroke="rgba(184,212,187,0.6)" stroke-width="1" fill="none"/>
      <path d="M40 20 C80 10 120 10 160 20" stroke="rgba(184,212,187,0.4)" stroke-width=".7" fill="none"/>
      <circle cx="100" cy="20" r="4" fill="rgba(184,212,187,0.5)"/>
    </svg>
  </div>
  <div class="ft-names">Alya & Reza</div>
  <p class="ft-tagline">Bersatu dalam Cinta, Tumbuh Bersama dalam Iman</p>
  <div class="ft-date">Minggu · 29 Juni 2025 · Bandung</div>
  <p class="ft-copy">Undangan Digital · Dibuat dengan Cinta 🌿 2025</p>
</footer>

</div>

<script>
const obs2 = new IntersectionObserver(entries=>{
  entries.forEach((e,i)=>{if(e.isIntersecting)setTimeout(()=>e.target.classList.add('visible'),i*70)});
},{threshold:.1});
document.querySelectorAll('.reveal').forEach(r=>obs2.observe(r));
function submitRsvp2(e){e.preventDefault();document.getElementById('rsvpForm2').style.display='none';document.getElementById('rsvpOk2').style.display='block'}
function openLb2(i){document.getElementById('lb2').classList.add('open')}
function closeLb2(){document.getElementById('lb2').classList.remove('open')}
function addWish2(){
  const n=document.getElementById('wNama2').value.trim();
  const h=document.getElementById('wHadir2').value;
  const t=document.getElementById('wText2').value.trim();
  if(!n||!t){alert('Mohon isi nama dan ucapan Anda');return}
  const c=document.createElement('div');c.className='w-card';
  c.innerHTML=`<p class="w-text">${t}</p><div class="w-footer"><span class="w-name">${n}</span><span class="w-status">${h}</span></div>`;
  document.getElementById('wishList2').prepend(c);
  document.getElementById('wNama2').value='';document.getElementById('wText2').value='';
}
</script>

<script>
    window.addEventListener('message', function(event) {
        const msg = event.data;
        if (!msg || msg.type !== 'updateForm') return;

        const d = msg.data;

        // ── Helper ──
        function setText(id, value, fallback = '') {
            const el = document.getElementById(id);
            if (el) el.textContent = value || fallback;
        }
        function setHtml(id, value, fallback = '') {
            const el = document.getElementById(id);
            if (el) el.innerHTML = value || fallback;
        }
        function setHref(id, value) {
            const el = document.getElementById(id);
            if (el && value) el.href = value;
        }

        // ── Helpers format tanggal ──
        const DAYS_ID   = ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'];
        const MONTHS_ID = ['Januari','Februari','Maret','April','Mei','Juni',
                           'Juli','Agustus','September','Oktober','November','Desember'];

        function fmtDate(dateStr) {
            if (!dateStr) return '';
            const d = new Date(dateStr + 'T00:00:00');
            return `${DAYS_ID[d.getDay()]}, ${d.getDate()} ${MONTHS_ID[d.getMonth()]} ${d.getFullYear()}`;
        }
        function fmtDay(dateStr) {
            if (!dateStr) return '';
            return DAYS_ID[new Date(dateStr + 'T00:00:00').getDay()];
        }
        function fmtMonth(dateStr) {
            if (!dateStr) return '';
            const d = new Date(dateStr + 'T00:00:00');
            return `${MONTHS_ID[d.getMonth()]} ${d.getFullYear()}`;
        }
        function fmtTime(t1, t2) {
            if (!t1 && !t2) return '';
            return `${t1 || '--:--'} – ${t2 || '--:--'} WIB`;
        }

        // ══════════════════════════════════════
        //  COVER
        // ══════════════════════════════════════
        setText('tpl-groom-name',    d.groomNickname,     'Grooms');
        setText('tpl-bride-name',    d.brideNickname,     'Bride');
        setText('tpl-cover-tagline', fmtDate(d.akadDate));

        // ══════════════════════════════════════
        //  MEMPELAI — nama & orang tua
        // ══════════════════════════════════════
        setText('tpl-groom-fullname', d.groomName,    'Pengantin Pria');
        setText('tpl-bride-fullname', d.brideName,    'Pengantin Wanita');
        setHtml('tpl-groom-parents',
            `Putra dari<br>${d.groomFather || 'Nama Ayah'} &amp; ${d.groomMother || 'Nama Ibu'}`);
        setHtml('tpl-bride-parents',
            `Putri dari<br>${d.brideFather || 'Nama Ayah'} &amp; ${d.brideMother || 'Nama Ibu'}`);

        // ══════════════════════════════════════
        //  ACARA — Akad
        // ══════════════════════════════════════
        setText('tpl-akad-day',        fmtDay(d.akadDate));
        setText('tpl-akad-date',       d.akadDate ? new Date(d.akadDate + 'T00:00:00').getDate() : '—');
        setText('tpl-akad-month',      fmtMonth(d.akadDate));
        setText('tpl-akad-time',       fmtTime(d.akadTimeStart, d.akadTimeEnd));
        setText('tpl-akad-venue',      d.akadVenue,   'Nama Tempat Akad');
        setText('tpl-akad-address',    d.akadAddress, 'Alamat Akad');
        setHref('tpl-akad-maps-btn',   d.akadMaps);

        // ══════════════════════════════════════
        //  ACARA — Resepsi
        // ══════════════════════════════════════
        setText('tpl-resepsi-day',     fmtDay(d.resepsiDate));
        setText('tpl-resepsi-date',    d.resepsiDate ? new Date(d.resepsiDate + 'T00:00:00').getDate() : '—');
        setText('tpl-resepsi-month',   fmtMonth(d.resepsiDate));
        setText('tpl-resepsi-time',    fmtTime(d.resepsiTimeStart, d.resepsiTimeEnd));
        setText('tpl-resepsi-venue',   d.resepsiVenue,   'Nama Tempat Resepsi');
        setText('tpl-resepsi-venue-maps',   d.resepsiVenue,   'Nama Tempat Resepsi');
        setText('tpl-resepsi-address', d.resepsiAddress, 'Alamat Resepsi');
        setText('tpl-resepsi-address-maps', d.resepsiAddress, 'Alamat Resepsi');
        setHref('tpl-resepsi-maps-btn', d.resepsiMaps);

        // ══════════════════════════════════════
        //  COUNTDOWN — update target tanggal
        // ══════════════════════════════════════
        if (d.akadDate) {
            window._weddingDate = new Date(d.akadDate + 'T' + (d.akadTimeStart || '08:00') + ':00');
        }

        // ══════════════════════════════════════
        //  KUTIPAN & SAMBUTAN
        // ══════════════════════════════════════
        setText('tpl-quote',      d.quoteText,  '');
        setText('tpl-love-story', d.loveStory,  '');

    });

    // Beri tahu parent bahwa iframe sudah siap
    window.parent.postMessage({ type: 'iframeReady' }, '*');
</script>
</body>
</html>