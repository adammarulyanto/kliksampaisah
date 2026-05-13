<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Undangan Pernikahan – Nadia & Farhan</title>
<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;1,300;1,400&family=Cinzel:wght@400;500&family=Cinzel+Decorative&family=Jost:wght@300;400&display=swap" rel="stylesheet">
<style>
:root {
  --gold: #C9A84C;
  --gold-light: #E8D5A3;
  --gold-dim: rgba(201,168,76,0.15);
  --black: #09080A;
  --black-mid: #131117;
  --black-card: #1A1820;
  --cream: #F2EAD9;
  --cream-dim: #A89878;
}
*,*::before,*::after{margin:0;padding:0;box-sizing:border-box}
html{scroll-behavior:smooth}
body{background:var(--black);color:var(--cream);font-family:'Cormorant Garamond',serif;overflow-x:hidden}
body::before{content:'';position:fixed;inset:0;background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='200' height='200'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4'/%3E%3C/filter%3E%3Crect width='200' height='200' filter='url(%23n)' opacity='0.04'/%3E%3C/svg%3E");pointer-events:none;z-index:0;opacity:.5}

/* NAV */
nav{position:fixed;top:0;left:0;right:0;z-index:100;background:rgba(9,8,10,0.92);backdrop-filter:blur(12px);border-bottom:1px solid rgba(201,168,76,0.12)}
.nav-inner{max-width:600px;margin:0 auto;display:flex;gap:0;overflow-x:auto;scrollbar-width:none}
.nav-inner::-webkit-scrollbar{display:none}
.nav-inner a{flex-shrink:0;padding:14px 18px;font-family:'Cinzel',serif;font-size:9px;letter-spacing:.35em;color:var(--cream-dim);text-decoration:none;text-transform:uppercase;transition:color .3s;white-space:nowrap}
.nav-inner a:hover{color:var(--gold)}

/* SECTIONS WRAPPER */
.page{position:relative;z-index:1;max-width:600px;margin:0 auto}

/* ─── 1. COVER ─── */
#cover{min-height:100vh;display:flex;flex-direction:column;align-items:center;justify-content:center;padding:8px 40px 60px;text-align:center;position:relative;overflow:hidden}
#cover::before{content:'';position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);width:600px;height:600px;background:radial-gradient(ellipse,rgba(201,168,76,0.06) 0%,transparent 70%);pointer-events:none}
.cover-ornament{margin-bottom:40px;opacity:0;animation:riseIn 1.2s ease .1s forwards}
.cover-eyebrow{font-family:'Cinzel',serif;font-size:9px;letter-spacing:.55em;color:var(--gold);text-transform:uppercase;margin-bottom:28px;opacity:0;animation:riseIn 1s ease .3s forwards}
.cover-names{opacity:0;animation:riseIn 1s ease .5s forwards}
.cover-name{font-family:'Cinzel Decorative',serif;font-size:52px;font-weight:400;line-height:1.05;color:var(--gold-light);display:block}
.cover-amp{font-family:'Cormorant Garamond',serif;font-style:italic;font-size:80px;color:var(--gold);line-height:1;display:block;margin:4px 0}
.cover-date-block{margin-top:40px;opacity:0;animation:riseIn 1s ease .7s forwards}
.cover-date-line{display:flex;align-items:center;gap:16px;justify-content:center;margin-bottom:12px}
.cover-date-line .line{flex:1;height:1px;background:linear-gradient(to right,transparent,var(--gold),transparent)}
.cover-date-line .diam{width:7px;height:7px;background:var(--gold);transform:rotate(45deg);flex-shrink:0}
.cover-date-text{font-family:'Cinzel',serif;font-size:11px;letter-spacing:.3em;color:var(--gold-light)}
.scroll-hint{position:absolute;bottom:36px;left:50%;transform:translateX(-50%);display:flex;flex-direction:column;align-items:center;gap:8px;opacity:0;animation:riseIn 1s ease 1.4s forwards}
.scroll-hint span{font-family:'Cinzel',serif;font-size:8px;letter-spacing:.4em;color:var(--cream-dim);text-transform:uppercase}
.scroll-arrow{width:1px;height:40px;background:linear-gradient(to bottom,var(--gold),transparent);animation:scrollPulse 2s ease-in-out infinite}

/* ─── SECTION BASE ─── */
section{padding:80px 40px;border-top:1px solid rgba(201,168,76,0.08)}
.sec-eyebrow{font-family:'Cinzel',serif;font-size:9px;letter-spacing:.45em;color:var(--gold);text-transform:uppercase;text-align:center;margin-bottom:16px;display:block}
.sec-title{font-family:'Cormorant Garamond',serif;font-size:38px;font-weight:300;text-align:center;margin-bottom:40px;line-height:1.2}
.sec-title em{font-style:italic;color:var(--gold-light)}
.gold-divider{display:flex;align-items:center;gap:14px;margin:32px 0}
.gold-divider .l{flex:1;height:1px;background:linear-gradient(to right,transparent,var(--gold),transparent)}
.gold-divider .d{width:6px;height:6px;background:var(--gold);transform:rotate(45deg)}

/* ─── 2. KATA PENGANTAR ─── */
#pengantar{text-align:center;background:var(--black-mid)}
.quran-verse{font-size:28px;font-style:italic;line-height:1.8;color:var(--gold-light);margin-bottom:20px;font-weight:300}
.quran-ref{font-family:'Cinzel',serif;font-size:9px;letter-spacing:.3em;color:var(--gold);display:block;margin-bottom:36px}
.pengantar-text{font-size:16px;line-height:2;color:var(--cream-dim);max-width:440px;margin:0 auto}

/* ─── 3. MEMPELAI ─── */
#mempelai{background:var(--black)}
.couple-grid{display:grid;grid-template-columns:1fr auto 1fr;gap:32px;align-items:start;margin-bottom:0}
.couple-card{text-align:center}
.couple-avatar{width:140px;height:140px;margin:0 auto 20px;border-radius:50%;border:2px solid var(--gold-dim);background:var(--black-card);position:relative;overflow:hidden;display:flex;align-items:center;justify-content:center}
.couple-avatar svg{width:60px;height:60px;opacity:.4}
.couple-avatar::after{content:'';position:absolute;inset:4px;border-radius:50%;border:1px solid rgba(201,168,76,0.2)}
.couple-name-big{font-family:'Cinzel Decorative',serif;font-size:22px;color:var(--gold-light);margin-bottom:6px;line-height:1.2}
.couple-fullname{font-size:14px;font-style:italic;color:var(--cream-dim);margin-bottom:16px}
.couple-parents{font-size:13px;color:var(--cream-dim);line-height:2}
.couple-parents strong{color:var(--cream);display:block;font-style:normal;font-size:12px;font-family:'Cinzel',serif;letter-spacing:.1em;margin-bottom:2px}
.couple-separator{display:flex;flex-direction:column;align-items:center;justify-content:center;padding-top:60px}
.amp-big{font-family:'Cormorant Garamond',serif;font-style:italic;font-size:64px;color:var(--gold);line-height:1}

/* ─── 4. ACARA ─── */
#acara{background:var(--black-mid)}
.events-list{display:flex;flex-direction:column;gap:16px}
.event-item{display:grid;grid-template-columns:auto 1fr;gap:0;background:var(--black-card);border:1px solid rgba(201,168,76,0.15);position:relative;overflow:hidden}
.event-item::before{content:'';position:absolute;top:0;left:0;width:3px;height:100%;background:var(--gold)}
.event-num{padding:24px 20px;border-right:1px solid rgba(201,168,76,0.1);display:flex;align-items:center;justify-content:center;min-width:60px}
.event-num span{font-family:'Cinzel Decorative',serif;font-size:28px;color:var(--gold-dim-2, rgba(201,168,76,0.3));line-height:1}
.event-body{padding:20px 24px}
.event-type{font-family:'Cinzel',serif;font-size:9px;letter-spacing:.35em;color:var(--gold);text-transform:uppercase;display:block;margin-bottom:6px}
.event-name{font-size:20px;font-weight:400;color:var(--cream);margin-bottom:8px}
.event-meta{font-size:13px;color:var(--cream-dim);line-height:1.9}

/* ─── 5. LOKASI ─── */
#lokasi{background:var(--black)}
.map-container{border:1px solid rgba(201,168,76,0.2);overflow:hidden;margin-bottom:24px;position:relative}
.map-container iframe{width:100%;height:320px;display:block;filter:grayscale(80%) contrast(1.1) brightness(0.7) sepia(20%)}
.map-overlay-tag{position:absolute;bottom:16px;left:16px;background:rgba(9,8,10,0.9);border:1px solid var(--gold-dim);padding:10px 16px;backdrop-filter:blur(8px)}
.map-overlay-tag span{font-family:'Cinzel',serif;font-size:9px;letter-spacing:.25em;color:var(--gold);display:block}
.venue-detail{background:var(--black-card);border:1px solid rgba(201,168,76,0.12);padding:28px 32px;display:grid;grid-template-columns:1fr auto;gap:20px;align-items:center}
.venue-name-big{font-size:22px;margin-bottom:6px;color:var(--cream)}
.venue-addr{font-size:14px;color:var(--cream-dim);line-height:1.8;font-style:italic}
.map-btn{display:inline-block;padding:12px 24px;border:1px solid var(--gold);color:var(--gold);font-family:'Cinzel',serif;font-size:9px;letter-spacing:.3em;text-decoration:none;text-transform:uppercase;white-space:nowrap;transition:all .3s;flex-shrink:0}
.map-btn:hover{background:var(--gold);color:var(--black)}

/* ─── 6. GALLERY ─── */
#gallery{background:var(--black-mid)}
.gallery-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:4px}
.gallery-item{aspect-ratio:1;overflow:hidden;position:relative;cursor:pointer;background:var(--black-card)}
.gallery-item img,.gallery-placeholder{width:100%;height:100%;object-fit:cover;display:block;transition:transform .5s ease}
.gallery-placeholder{display:flex;align-items:center;justify-content:center;background:var(--black-card);flex-direction:column;gap:8px}
.gallery-placeholder svg{opacity:.2;width:32px}
.gallery-placeholder span{font-family:'Cinzel',serif;font-size:7px;letter-spacing:.3em;color:var(--cream-dim);opacity:.4;text-transform:uppercase}
.gallery-item::after{content:'';position:absolute;inset:0;background:linear-gradient(to top,rgba(201,168,76,0.15),transparent);opacity:0;transition:opacity .3s}
.gallery-item:hover::after{opacity:1}
.gallery-item:hover .gallery-placeholder{transform:scale(1.04)}
.gallery-note{text-align:center;margin-top:20px;font-size:13px;font-style:italic;color:var(--cream-dim)}

/* Lightbox */
.lightbox{display:none;position:fixed;inset:0;background:rgba(0,0,0,.92);z-index:200;align-items:center;justify-content:center;padding:20px}
.lightbox.open{display:flex}
.lightbox-inner{max-width:80vw;max-height:80vh;position:relative}
.lightbox-inner img{max-width:100%;max-height:80vh;object-fit:contain;border:1px solid var(--gold-dim)}
.lightbox-close{position:absolute;top:-16px;right:-16px;width:36px;height:36px;background:var(--gold);color:var(--black);border:none;cursor:pointer;font-size:18px;display:flex;align-items:center;justify-content:center;font-family:'Cinzel',serif}

/* ─── 7. RSVP ─── */
#rsvp{background:var(--black)}
.rsvp-box{background:var(--black-card);border:1px solid rgba(201,168,76,0.2);padding:48px 40px;max-width:480px;margin:0 auto;position:relative}
.rsvp-box::before,.rsvp-box::after{content:'';position:absolute;width:14px;height:14px;border-color:var(--gold);border-style:solid}
.rsvp-box::before{top:-1px;left:-1px;border-width:2px 0 0 2px}
.rsvp-box::after{bottom:-1px;right:-1px;border-width:0 2px 2px 0}
.rsvp-form{display:flex;flex-direction:column;gap:18px}
.form-group{display:flex;flex-direction:column;gap:6px}
.form-label{font-family:'Cinzel',serif;font-size:9px;letter-spacing:.35em;color:var(--gold);text-transform:uppercase}
.form-input,.form-select,.form-textarea{background:rgba(201,168,76,0.04);border:1px solid rgba(201,168,76,0.2);color:var(--cream);font-family:'Cormorant Garamond',serif;font-size:16px;padding:12px 16px;outline:none;transition:border-color .3s;width:100%}
.form-input:focus,.form-select:focus,.form-textarea:focus{border-color:var(--gold)}
.form-select{appearance:none;cursor:pointer}
.form-textarea{height:90px;resize:none}
.form-select option{background:var(--black-card);color:var(--cream)}
.rsvp-btn{padding:14px;background:transparent;border:1px solid var(--gold);color:var(--gold);font-family:'Cinzel',serif;font-size:10px;letter-spacing:.4em;text-transform:uppercase;cursor:pointer;transition:all .3s;position:relative;overflow:hidden}
.rsvp-btn::before{content:'';position:absolute;inset:0;background:var(--gold);transform:scaleX(0);transform-origin:left;transition:transform .4s ease;z-index:0}
.rsvp-btn span{position:relative;z-index:1}
.rsvp-btn:hover{color:var(--black)}
.rsvp-btn:hover::before{transform:scaleX(1)}
.rsvp-success{display:none;text-align:center;padding:24px;font-size:18px;color:var(--gold-light);font-style:italic}

/* ─── 8. KATA SAHABAT ─── */
#ucapan{background:var(--black-mid)}
.wishes-list{display:flex;flex-direction:column;gap:20px;max-height:480px;overflow-y:auto;padding-right:4px;scrollbar-width:thin;scrollbar-color:var(--gold-dim) transparent}
.wish-card{background:var(--black-card);border:1px solid rgba(201,168,76,0.12);padding:24px 28px;position:relative}
.wish-card::before{content:'\201C';font-family:'Cormorant Garamond',serif;font-size:60px;color:var(--gold-dim);position:absolute;top:8px;left:16px;line-height:1}
.wish-text{font-size:15px;line-height:1.9;color:var(--cream-dim);padding-top:16px;font-style:italic}
.wish-name{font-family:'Cinzel',serif;font-size:9px;letter-spacing:.3em;color:var(--gold);margin-top:14px;display:block;text-transform:uppercase}
.wish-hadir{display:inline-block;margin-top:6px;font-size:10px;padding:3px 10px;border:1px solid rgba(201,168,76,0.25);color:var(--cream-dim)}
.ucapan-form{margin-top:32px;background:var(--black-card);border:1px solid rgba(201,168,76,0.12);padding:28px}
.ucapan-form .form-input,.ucapan-form .form-textarea{margin-top:0}
.ucapan-fields{display:grid;grid-template-columns:1fr 1fr;gap:14px;margin-bottom:14px}
.ucapan-submit{padding:12px 32px;background:transparent;border:1px solid var(--gold);color:var(--gold);font-family:'Cinzel',serif;font-size:9px;letter-spacing:.3em;text-transform:uppercase;cursor:pointer;transition:all .3s}
.ucapan-submit:hover{background:var(--gold);color:var(--black)}

/* ─── 9. FOOTER ─── */
#footer{background:var(--black);padding:60px 40px;text-align:center;border-top:1px solid rgba(201,168,76,0.1)}
.footer-ornament{margin-bottom:28px}
.footer-names{font-family:'Cinzel Decorative',serif;font-size:22px;color:var(--gold-light);margin-bottom:12px}
.footer-tagline{font-size:15px;font-style:italic;color:var(--cream-dim);margin-bottom:28px}
.footer-date{font-family:'Cinzel',serif;font-size:9px;letter-spacing:.4em;color:var(--gold);text-transform:uppercase;margin-bottom:40px}
.footer-copy{font-size:11px;color:rgba(168,152,120,0.4);font-family:'Jost',sans-serif;font-weight:300;letter-spacing:.1em}

/* ANIMATIONS */
@keyframes riseIn{from{opacity:0;transform:translateY(28px)}to{opacity:1;transform:translateY(0)}}
@keyframes scrollPulse{0%,100%{opacity:.6}50%{opacity:1}}
.reveal{opacity:0;transform:translateY(32px);transition:opacity .8s ease,transform .8s ease}
.reveal.visible{opacity:1;transform:translateY(0)}

@media(max-width:480px){
  .cover-name{font-size:36px}
  .cover-amp{font-size:60px}
  .couple-grid{grid-template-columns:1fr;gap:12px}
  .couple-separator{padding-top:0;flex-direction:row;gap:20px}
  .amp-big{font-size:40px}
  .gallery-grid{grid-template-columns:repeat(3,1fr)}
  .venue-detail{grid-template-columns:1fr}
  .ucapan-fields{grid-template-columns:1fr}
  section{padding:60px 24px}
  #rsvp .rsvp-box{padding:32px 24px}
}
</style>
</head>
<body>

<div class="page">

<!-- ═══════════════════════════════════════ -->
<!-- 1. COVER -->
<!-- ═══════════════════════════════════════ -->
<section id="cover">
  <div class="cover-ornament">
    <svg viewBox="0 0 300 70" width="260" fill="none" xmlns="http://www.w3.org/2000/svg">
      <line x1="0" y1="35" x2="105" y2="35" stroke="#C9A84C" stroke-width=".6"/>
      <polygon points="115,35 122,28 129,35 122,42" stroke="#C9A84C" stroke-width=".8" fill="none"/>
      <line x1="135" y1="35" x2="165" y2="35" stroke="#C9A84C" stroke-width=".6"/>
      <circle cx="150" cy="35" r="10" stroke="#C9A84C" stroke-width=".6" fill="none"/>
      <circle cx="150" cy="35" r="3" fill="#C9A84C"/>
      <line x1="165" y1="35" x2="171" y2="35" stroke="#C9A84C" stroke-width=".6"/>
      <polygon points="171,35 178,28 185,35 178,42" stroke="#C9A84C" stroke-width=".8" fill="none"/>
      <line x1="191" y1="35" x2="300" y2="35" stroke="#C9A84C" stroke-width=".6"/>
      <line x1="150" y1="10" x2="150" y2="25" stroke="#C9A84C" stroke-width=".6"/>
      <line x1="150" y1="45" x2="150" y2="60" stroke="#C9A84C" stroke-width=".6"/>
    </svg>
  </div>
  <p class="cover-eyebrow">Dengan Penuh Kebahagiaan Kami Mengundang Anda</p>
  <div class="cover-names">
    <span class="cover-name">Nadia</span>
    <span class="cover-amp">&</span>
    <span class="cover-name">Farhan</span>
  </div>
  <div class="cover-date-block">
    <div class="cover-date-line">
      <div class="line"></div>
      <div class="diam"></div>
      <div class="line"></div>
    </div>
    <p class="cover-date-text">Sabtu, 14 Juni 2025 &nbsp;·&nbsp; Jakarta</p>
  </div>
  <div class="scroll-hint">
    <span>Gulir ke bawah</span>
    <div class="scroll-arrow"></div>
  </div>
</section>

<!-- ═══════════════════════════════════════ -->
<!-- 2. KATA PENGANTAR -->
<!-- ═══════════════════════════════════════ -->
<section id="pengantar">
  <span class="sec-eyebrow reveal">Bismillah</span>
  <h2 class="sec-title reveal">Kata <em>Pengantar</em></h2>
  <p class="quran-verse reveal">"وَمِنْ آيَاتِهِ أَنْ خَلَقَ لَكُم مِّنْ أَنفُسِكُمْ أَزْوَاجًا"</p>
  <span class="quran-ref reveal">QS. Ar-Rum: 21</span>
  <div class="gold-divider reveal"><div class="l"></div><div class="d"></div><div class="l"></div></div>
  <p class="pengantar-text reveal">
    Assalamu'alaikum Warahmatullahi Wabarakatuh.<br><br>
    Dengan memohon Rahmat dan Ridho Allah SWT, kami bermaksud menyelenggarakan pernikahan putra-putri kami. Tanpa mengurangi rasa hormat, perkenankan kami mengundang Bapak/Ibu/Saudara/i untuk hadir dan memberikan doa restu dalam pernikahan kami.<br><br>
    Merupakan suatu kehormatan dan kebahagiaan bagi kami apabila Bapak/Ibu/Saudara/i berkenan hadir untuk memberikan doa dan restu kepada kedua mempelai.
  </p>
</section>

<!-- ═══════════════════════════════════════ -->
<!-- 3. MEMPELAI -->
<!-- ═══════════════════════════════════════ -->
<section id="mempelai">
  <span class="sec-eyebrow reveal">Kedua Mempelai</span>
  <h2 class="sec-title reveal">Bersatunya Dua <em>Keluarga</em></h2>
  <div class="couple-grid reveal">
    <div class="couple-card">
      <div class="couple-avatar">
        <svg viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg">
          <circle cx="40" cy="28" r="16" stroke="#C9A84C" stroke-width="1.5"/>
          <path d="M10 72 C10 52 70 52 70 72" stroke="#C9A84C" stroke-width="1.5" fill="none"/>
        </svg>
      </div>
      <div class="couple-name-big">Nadia Rahmawati</div>
      <div class="couple-fullname">Nadia Rahmawati, S.Pd.</div>
      <div class="gold-divider" style="margin:12px 0"><div class="l"></div><div class="d"></div><div class="l"></div></div>
      <div class="couple-parents">
        <strong>Putri dari</strong>
        Bapak H. Mahmud Hasan<br>& Ibu Hj. Siti Romlah
      </div>
    </div>
    <div class="couple-separator">
      <div class="amp-big">&</div>
    </div>
    <div class="couple-card">
      <div class="couple-avatar">
        <svg viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg">
          <circle cx="40" cy="28" r="16" stroke="#C9A84C" stroke-width="1.5"/>
          <path d="M10 72 C10 52 70 52 70 72" stroke="#C9A84C" stroke-width="1.5" fill="none"/>
        </svg>
      </div>
      <div class="couple-name-big">Farhan Rizky</div>
      <div class="couple-fullname">Muhammad Farhan Rizky, S.T.</div>
      <div class="gold-divider" style="margin:12px 0"><div class="l"></div><div class="d"></div><div class="l"></div></div>
      <div class="couple-parents">
        <strong>Putra dari</strong>
        Bapak Drs. Ahmad Fauzi<br>& Ibu Dra. Nurhayati
      </div>
    </div>
  </div>
</section>

<!-- ═══════════════════════════════════════ -->
<!-- 4. RANGKAIAN ACARA -->
<!-- ═══════════════════════════════════════ -->
<section id="acara">
  <span class="sec-eyebrow reveal">Jadwal</span>
  <h2 class="sec-title reveal">Rangkaian <em>Acara</em></h2>
  <div class="events-list">
    <div class="event-item reveal">
      <div class="event-num"><span>I</span></div>
      <div class="event-body">
        <span class="event-type">Hari Pertama · Jumat, 13 Juni 2025</span>
        <div class="event-name">Pengajian & Malam Tasyakuran</div>
        <div class="event-meta">19:00 – 22:00 WIB<br>Kediaman Keluarga Mempelai Wanita<br>Jl. Mawar No. 12, Jakarta Selatan</div>
      </div>
    </div>
    <div class="event-item reveal">
      <div class="event-num"><span>II</span></div>
      <div class="event-body">
        <span class="event-type">Hari Kedua · Sabtu, 14 Juni 2025</span>
        <div class="event-name">Akad Nikah</div>
        <div class="event-meta">08:00 – 10:00 WIB<br>Masjid Al-Hikmah, Jakarta Selatan<br><em>Dress code: Formal – Putih & Gold</em></div>
      </div>
    </div>
    <div class="event-item reveal">
      <div class="event-num"><span>III</span></div>
      <div class="event-body">
        <span class="event-type">Hari Kedua · Sabtu, 14 Juni 2025</span>
        <div class="event-name">Resepsi Pernikahan</div>
        <div class="event-meta">11:00 – 15:00 WIB<br>The Ritz-Carlton Jakarta, Mega Kuningan<br><em>Dress code: Smart Formal</em></div>
      </div>
    </div>
    <div class="event-item reveal">
      <div class="event-num"><span>IV</span></div>
      <div class="event-body">
        <span class="event-type">Hari Ketiga · Minggu, 15 Juni 2025</span>
        <div class="event-name">Walimah & Syukuran</div>
        <div class="event-meta">10:00 – 14:00 WIB<br>Kediaman Keluarga Mempelai Pria<br>Jl. Dahlia No. 7, Jakarta Timur</div>
      </div>
    </div>
  </div>
</section>

<!-- ═══════════════════════════════════════ -->
<!-- 5. LOKASI -->
<!-- ═══════════════════════════════════════ -->
<section id="lokasi">
  <span class="sec-eyebrow reveal">Venue</span>
  <h2 class="sec-title reveal">Lokasi <em>Acara</em></h2>
  <div class="map-container reveal">
    <iframe
      src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.052!2d106.8310!3d-6.2297!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f3e945e34b9d%3A0x5371bf0fdad786a2!2sThe%20Ritz-Carlton%20Jakarta%2C%20Mega%20Kuningan!5e0!3m2!1sen!2sid!4v1"
      allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
    </iframe>
    <div class="map-overlay-tag">
      <span>VENUE RESEPSI</span>
    </div>
  </div>
  <div class="venue-detail reveal">
    <div>
      <div class="venue-name-big">The Ritz-Carlton Jakarta</div>
      <div class="venue-addr">Mega Kuningan, Jl. DR. Ide Anak Agung<br>Gde Agung Kav. E.1.1, Jakarta 12950</div>
    </div>
    <a class="map-btn" href="https://maps.google.com/?q=The+Ritz-Carlton+Jakarta+Mega+Kuningan" target="_blank">Buka Maps</a>
  </div>
</section>

<!-- ═══════════════════════════════════════ -->
<!-- 6. GALLERY -->
<!-- ═══════════════════════════════════════ -->
<section id="gallery">
  <span class="sec-eyebrow reveal">Kenangan</span>
  <h2 class="sec-title reveal">Galeri <em>Foto</em></h2>
  <div class="gallery-grid reveal" id="galleryGrid">
    <!-- 9 placeholder photos -->
    <script>
      const captions = ['Pre-Wedding','Pre-Wedding','Pertunangan','Pre-Wedding','Bersama','Keluarga','Momen','Bahagia','Cinta'];
      document.currentScript.insertAdjacentHTML('afterend',captions.map((c,i)=>`
        <div class="gallery-item" onclick="openLightbox(${i})">
          <div class="gallery-placeholder">
            <svg viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg"><rect x="4" y="8" width="32" height="24" rx="2" stroke="#C9A84C" stroke-width="1.2"/><circle cx="20" cy="20" r="6" stroke="#C9A84C" stroke-width="1.2"/><circle cx="30" cy="13" r="2" fill="#C9A84C" opacity=".4"/></svg>
            <span>${c}</span>
          </div>
        </div>`).join(''));
    </script>
  </div>
  <p class="gallery-note reveal">Ganti gambar placeholder dengan foto pre-wedding Anda</p>
  <div class="lightbox" id="lightbox" onclick="closeLightbox()">
    <div class="lightbox-inner">
      <button class="lightbox-close" onclick="closeLightbox()">×</button>
      <img id="lightboxImg" src="" alt="Photo">
    </div>
  </div>
</section>

<!-- ═══════════════════════════════════════ -->
<!-- 7. RSVP -->
<!-- ═══════════════════════════════════════ -->
<section id="rsvp">
  <span class="sec-eyebrow reveal">Konfirmasi</span>
  <h2 class="sec-title reveal">RSVP</h2>
  <div class="rsvp-box reveal">
    <form class="rsvp-form" id="rsvpForm" onsubmit="submitRSVP(event)">
      <div class="form-group">
        <label class="form-label">Nama Lengkap</label>
        <input class="form-input" type="text" placeholder="Nama Anda" required>
      </div>
      <div class="form-group">
        <label class="form-label">Nomor Whatsapp</label>
        <input class="form-input" type="tel" placeholder="08xx-xxxx-xxxx">
      </div>
      <div class="form-group">
        <label class="form-label">Kehadiran</label>
        <select class="form-select">
          <option value="">Pilih konfirmasi</option>
          <option value="hadir">✓ Saya akan hadir</option>
          <option value="tidak">✗ Tidak dapat hadir</option>
          <option value="mungkin">? Belum bisa memastikan</option>
        </select>
      </div>
      <div class="form-group">
        <label class="form-label">Jumlah Tamu</label>
        <select class="form-select">
          <option value="1">1 orang</option>
          <option value="2">2 orang</option>
          <option value="3">3 orang</option>
          <option value="4">4 orang</option>
        </select>
      </div>
      <button type="submit" class="rsvp-btn"><span>Kirim Konfirmasi</span></button>
    </form>
    <div class="rsvp-success" id="rsvpSuccess">
      Terima kasih atas konfirmasi Anda ✦<br>Kami menantikan kehadiran Anda
    </div>
  </div>
</section>

<!-- ═══════════════════════════════════════ -->
<!-- 8. KATA SAHABAT -->
<!-- ═══════════════════════════════════════ -->
<section id="ucapan">
  <span class="sec-eyebrow reveal">Doa & Harapan</span>
  <h2 class="sec-title reveal">Kata <em>Sahabat</em></h2>
  <div class="wishes-list reveal" id="wishesList">
    <div class="wish-card">
      <p class="wish-text">Semoga menjadi keluarga yang sakinah, mawaddah, wa rahmah. Barakallahu lakuma wa baraka 'alaikuma wa jama'a bainakuma fi khair.</p>
      <span class="wish-name">Rina Kusuma</span>
      <span class="wish-hadir">✓ Hadir</span>
    </div>
    <div class="wish-card">
      <p class="wish-text">Selamat menempuh hidup baru! Semoga cinta kalian selalu tumbuh dan keluarga kalian selalu dilimpahi keberkahan dari Allah SWT.</p>
      <span class="wish-name">Budi Santoso</span>
      <span class="wish-hadir">✓ Hadir</span>
    </div>
    <div class="wish-card">
      <p class="wish-text">Maaf tidak bisa hadir langsung, tapi doa terbaik selalu menyertai perjalanan indah kalian berdua. Bahagia selalu ya!</p>
      <span class="wish-name">Dewi Anggraini</span>
      <span class="wish-hadir">✗ Tidak Hadir</span>
    </div>
  </div>
  <div class="ucapan-form reveal">
    <div class="ucapan-fields">
      <div class="form-group">
        <label class="form-label">Nama Anda</label>
        <input class="form-input" id="ucapanNama" type="text" placeholder="Nama Anda">
      </div>
      <div class="form-group">
        <label class="form-label">Kehadiran</label>
        <select class="form-select" id="ucapanHadir">
          <option value="Hadir">✓ Hadir</option>
          <option value="Tidak Hadir">✗ Tidak Hadir</option>
        </select>
      </div>
    </div>
    <div class="form-group" style="margin-bottom:16px">
      <label class="form-label">Ucapan & Doa</label>
      <textarea class="form-textarea" id="ucapanText" placeholder="Tuliskan ucapan dan doa terbaik Anda…"></textarea>
    </div>
    <button class="ucapan-submit" onclick="submitUcapan()">Kirim Ucapan</button>
  </div>
</section>

<!-- ═══════════════════════════════════════ -->
<!-- 9. FOOTER -->
<!-- ═══════════════════════════════════════ -->
<footer id="footer">
  <div class="footer-ornament">
    <svg viewBox="0 0 200 30" width="180" fill="none" xmlns="http://www.w3.org/2000/svg">
      <line x1="0" y1="15" x2="85" y2="15" stroke="#C9A84C" stroke-width=".6" opacity=".5"/>
      <circle cx="100" cy="15" r="8" stroke="#C9A84C" stroke-width=".6" opacity=".6" fill="none"/>
      <circle cx="100" cy="15" r="2" fill="#C9A84C" opacity=".6"/>
      <line x1="115" y1="15" x2="200" y2="15" stroke="#C9A84C" stroke-width=".6" opacity=".5"/>
    </svg>
  </div>
  <div class="footer-names">Nadia & Farhan</div>
  <p class="footer-tagline">Bersatu dalam Cinta, Diikat dalam Iman</p>
  <div class="footer-date">Sabtu, 14 Juni 2025</div>
  <div class="gold-divider" style="max-width:200px;margin:0 auto 32px"><div class="l"></div><div class="d"></div><div class="l"></div></div>
  <p class="footer-copy">Undangan Digital · Dibuat dengan Cinta ✦ 2025</p>
</footer>

</div><!-- .page -->

<script>
// Reveal on scroll
const reveals = document.querySelectorAll('.reveal');
const observer = new IntersectionObserver(entries => {
  entries.forEach((e,i) => {
    if(e.isIntersecting){ setTimeout(()=>e.target.classList.add('visible'), i*80); }
  });
}, {threshold:0.12});
reveals.forEach(r => observer.observe(r));

// RSVP submit
function submitRSVP(e){
  e.preventDefault();
  document.getElementById('rsvpForm').style.display='none';
  document.getElementById('rsvpSuccess').style.display='block';
}

// Gallery lightbox
function openLightbox(i){
  document.getElementById('lightbox').classList.add('open');
  document.getElementById('lightboxImg').src='';
  document.getElementById('lightboxImg').alt='Foto '+(i+1);
}
function closeLightbox(){
  document.getElementById('lightbox').classList.remove('open');
}

// Submit ucapan
function submitUcapan(){
  const nama = document.getElementById('ucapanNama').value.trim();
  const hadir = document.getElementById('ucapanHadir').value;
  const text = document.getElementById('ucapanText').value.trim();
  if(!nama||!text){ alert('Mohon isi nama dan ucapan Anda'); return; }
  const card = document.createElement('div');
  card.className='wish-card';
  card.innerHTML=`<p class="wish-text">${text}</p><span class="wish-name">${nama}</span><span class="wish-hadir">${hadir==='Hadir'?'✓':'✗'} ${hadir}</span>`;
  document.getElementById('wishesList').prepend(card);
  document.getElementById('ucapanNama').value='';
  document.getElementById('ucapanText').value='';
}
</script>
</body>
</html>