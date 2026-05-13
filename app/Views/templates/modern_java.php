<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Undangan Pernikahan – Sekar & Bagas</title>
<link href="https://fonts.googleapis.com/css2?family=Yeseva+One&family=Raleway:wght@300;400;500&family=Great+Vibes&display=swap" rel="stylesheet">
<style>
:root{
  --maroon:#7B1C2E;
  --maroon-dark:#4D0D1A;
  --maroon-light:#A8324A;
  --gold:#C4953A;
  --gold-light:#E8C97A;
  --gold-dim:rgba(196,149,58,0.15);
  --ivory:#FAF3E8;
  --ivory-mid:#EDE0C8;
  --ivory-dark:#C4A87A;
  --dark:#1A0A0F;
}
*,*::before,*::after{margin:0;padding:0;box-sizing:border-box}
html{scroll-behavior:smooth}
body{background:var(--maroon-dark);color:var(--maroon-dark);font-family:'Raleway',sans-serif;overflow-x:hidden}

/* BATIK PATTERN BG */
.batik-bg{
  background-image:
    repeating-linear-gradient(45deg,rgba(196,149,58,0.035) 0,rgba(196,149,58,0.035) 1px,transparent 0,transparent 50%),
    repeating-linear-gradient(-45deg,rgba(123,28,46,0.03) 0,rgba(123,28,46,0.03) 1px,transparent 0,transparent 50%);
  background-size:24px 24px;
}

/* NAV */
nav{position:fixed;top:0;left:0;right:0;z-index:100;background:rgba(250,243,232,0.95);backdrop-filter:blur(10px);border-bottom:2px solid var(--maroon)}
.nav-inner{max-width:640px;margin:0 auto;display:flex;overflow-x:auto;scrollbar-width:none}
.nav-inner::-webkit-scrollbar{display:none}
.nav-inner a{flex-shrink:0;padding:13px 16px;font-family:'Raleway',sans-serif;font-size:9px;letter-spacing:.3em;color:var(--maroon);text-decoration:none;text-transform:uppercase;font-weight:500;transition:all .3s;border-bottom:2px solid transparent;margin-bottom:-2px;white-space:nowrap}
.nav-inner a:hover{color:var(--gold);border-bottom-color:var(--gold)}

.page{max-width:640px;margin:0 auto}

/* ─── 1. COVER ─── */
#cover{min-height:100vh;display:flex;flex-direction:column;align-items:center;justify-content:center;padding:100px 40px 60px;text-align:center;background:var(--maroon-dark);position:relative;overflow:hidden}

/* Decorative corner motifs */
/* #cover::before{content:'';position:absolute;top:0;left:0;width:220px;height:220px;background:
  radial-gradient(circle at 0 0,rgba(196,149,58,0.15) 0%,transparent 60%);pointer-events:none}
#cover::after{content:'';position:absolute;bottom:0;right:0;width:220px;height:220px;background:
  radial-gradient(circle at 100% 100%,rgba(196,149,58,0.12) 0%,transparent 60%);pointer-events:none} */

.cover-frame{position:relative;padding:48px;z-index:1;width:100%}
/* Ornate frame border */
.cover-frame::before,.cover-frame::after{content:'';position:absolute;border-style:solid;border-color:rgba(196,149,58,0.4)}
.cover-frame::before{top:0;left:0;right:0;bottom:0;border-width:1px}
/* Corner accents */
.cover-corner{position:absolute;width:24px;height:24px;border-color:var(--gold);border-style:solid}
.cover-corner.tl{top:-1px;left:-1px;border-width:2px 0 0 2px}
.cover-corner.tr{top:-1px;right:-1px;border-width:2px 2px 0 0}
.cover-corner.bl{bottom:-1px;left:-1px;border-width:0 0 2px 2px}
.cover-corner.br{bottom:-1px;right:-1px;border-width:0 2px 2px 0}

.cover-ornament{margin-bottom:32px;opacity:0;animation:fadeIn 1.2s ease .1s forwards}
.cover-toptext{font-family:'Raleway',sans-serif;font-size:9px;letter-spacing:.5em;color:var(--gold-light);text-transform:uppercase;margin-bottom:24px;opacity:0;animation:fadeIn 1s ease .3s forwards}
.cover-title-small{font-family:'Raleway',sans-serif;font-size:11px;letter-spacing:.35em;color:var(--ivory-dark);text-transform:uppercase;margin-bottom:20px;opacity:0;animation:fadeIn 1s ease .5s forwards}
.cover-bride{font-family:'Great Vibes',cursive;font-size:62px;color:var(--gold-light);line-height:1.05;display:block;opacity:0;animation:fadeIn 1s ease .6s forwards}
.cover-amp{font-family:'Yeseva One',serif;font-size:32px;color:var(--gold);display:block;margin:4px 0;letter-spacing:.15em;opacity:0;animation:fadeIn 1s ease .7s forwards}
.cover-groom{font-family:'Great Vibes',cursive;font-size:62px;color:var(--gold-light);line-height:1.05;display:block;opacity:0;animation:fadeIn 1s ease .8s forwards}
.cover-date-row{margin-top:32px;opacity:0;animation:fadeIn 1s ease 1s forwards}
.cover-date-inner{display:flex;align-items:center;gap:16px;justify-content:center}
.cover-date-line{flex:1;height:1px;background:linear-gradient(to right,transparent,rgba(196,149,58,0.5),transparent)}
.cover-date-text{font-family:'Raleway',sans-serif;font-size:10px;letter-spacing:.3em;color:var(--gold-light);text-transform:uppercase;white-space:nowrap}
.cover-scroll{position:absolute;bottom:28px;left:50%;transform:translateX(-50%);display:flex;flex-direction:column;align-items:center;gap:6px;opacity:0;animation:fadeIn 1s ease 1.5s forwards;z-index:2}
.cover-scroll span{font-size:8px;letter-spacing:.4em;color:rgba(196,149,58,.5);text-transform:uppercase}
.cover-scrollline{width:1px;height:32px;background:linear-gradient(to bottom,var(--gold),transparent);animation:pulse 2s infinite}

/* SECTION BASE */
section{padding:80px 48px}
.sec-top{text-align:center;margin-bottom:40px}
.sec-label2{font-family:'Raleway',sans-serif;font-size:9px;letter-spacing:.45em;color:var(--gold);text-transform:uppercase;display:block;margin-bottom:10px}
.sec-head2{font-family:'Yeseva One',serif;font-size:34px;color:var(--maroon);line-height:1.15}
.sec-head2 span{color:var(--gold)}
.batik-divider{display:flex;align-items:center;gap:12px;margin:24px 0}
.batik-divider .bl2{flex:1;height:1px;background:linear-gradient(to right,transparent,rgba(123,28,46,0.2),transparent)}
.batik-divider .bm{width:8px;height:8px;background:var(--gold);transform:rotate(45deg);flex-shrink:0}

/* ─── 2. PENGANTAR ─── */
#pengantar{background:var(--maroon);color:var(--ivory);text-align:center}
#pengantar .sec-head2{color:var(--gold-light)}
#pengantar .sec-label2{color:rgba(196,149,58,.7)}
.quran-wrap{background:rgba(196,149,58,.08);border:1px solid rgba(196,149,58,.2);padding:32px;margin-bottom:28px;position:relative}
.quran-wrap::before,.quran-wrap::after{content:'';position:absolute;width:16px;height:16px;border-color:rgba(196,149,58,.4);border-style:solid}
.quran-wrap::before{top:-1px;left:-1px;border-width:2px 0 0 2px}
.quran-wrap::after{bottom:-1px;right:-1px;border-width:0 2px 2px 0}
.q-ar{font-family:'Yeseva One',serif;font-size:20px;color:var(--gold-light);line-height:1.9;margin-bottom:12px;direction:rtl}
.q-tr{font-size:13px;color:rgba(250,243,232,.7);line-height:1.9;font-style:italic;margin-bottom:10px}
.q-ref{font-size:9px;letter-spacing:.3em;color:var(--gold);text-transform:uppercase}
.peng-text{font-size:14px;color:rgba(250,243,232,.75);line-height:2.1;font-weight:300;max-width:480px;margin:0 auto}

/* ─── 3. MEMPELAI ─── */
#mempelai{background:var(--ivory) url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='60' height='60'%3E%3Cpath d='M0 30 Q15 0 30 30 Q45 60 60 30' stroke='rgba(123,28,46,0.04)' stroke-width='1' fill='none'/%3E%3C/svg%3E") repeat}
.mempelai-layout{display:grid;grid-template-columns:1fr 60px 1fr;gap:20px;align-items:center}
.mp-side{text-align:center}
.mp-frame{width:148px;height:148px;margin:0 auto 18px;border-radius:50%;background:var(--ivory-mid);border:3px solid var(--maroon);position:relative;display:flex;align-items:center;justify-content:center;box-shadow:0 0 0 6px rgba(123,28,46,.08)}
.mp-frame svg{width:52px;opacity:.3}
.mp-name-script{font-family:'Great Vibes',cursive;font-size:32px;color:var(--maroon);margin-bottom:4px}
.mp-name-formal{font-family:'Raleway',sans-serif;font-size:12px;color:var(--ivory-dark);font-style:italic;margin-bottom:14px;font-weight:400}
.mp-parents-tag{font-family:'Raleway',sans-serif;font-size:9px;letter-spacing:.25em;text-transform:uppercase;color:var(--gold);display:block;margin-bottom:6px}
.mp-parents{font-size:13px;color:var(--maroon-light);line-height:1.9;font-weight:300}
.mp-mid{display:flex;align-items:center;justify-content:center}
.mp-and{font-family:'Yeseva One',serif;font-size:44px;color:var(--maroon);writing-mode:vertical-rl;line-height:1}

/* ─── 4. ACARA ─── */
#acara{background:var(--maroon-dark) url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='40' height='40'%3E%3Crect x='0' y='0' width='40' height='40' fill='none'/%3E%3Ccircle cx='20' cy='20' r='1.5' fill='rgba(196,149,58,0.1)'/%3E%3C/svg%3E") repeat;color:var(--ivory)}
#acara .sec-head2{color:var(--gold-light)}
.acara-cards{display:flex;flex-direction:column;gap:14px}
.acara-card{display:grid;grid-template-columns:72px 1fr;border:1px solid rgba(196,149,58,.18);background:rgba(196,149,58,.04);transition:background .3s}
.acara-card:hover{background:rgba(196,149,58,.08)}
.acara-num{background:var(--gold);display:flex;align-items:center;justify-content:center;font-family:'Yeseva One',serif;font-size:28px;color:var(--maroon-dark);flex-shrink:0}
.acara-body{padding:18px 22px}
.acara-tag2{font-size:9px;letter-spacing:.3em;color:var(--gold);text-transform:uppercase;display:block;margin-bottom:5px;font-family:'Raleway';font-weight:500}
.acara-name2{font-family:'Yeseva One',serif;font-size:20px;color:var(--ivory);margin-bottom:6px}
.acara-detail{font-size:13px;color:rgba(250,243,232,.65);line-height:1.9;font-weight:300}
.dress-tag{display:inline-block;margin-top:8px;padding:3px 12px;border:1px solid rgba(196,149,58,.3);font-size:9px;color:var(--gold-light);letter-spacing:.15em}

/* ─── 5. LOKASI ─── */
#lokasi{background:var(--ivory)}
.map-wrap{border:2px solid var(--maroon);overflow:hidden;margin-bottom:18px;position:relative}
.map-wrap iframe{width:100%;height:300px;display:block;filter:sepia(20%) saturate(0.8) brightness(1)}
.map-badge{position:absolute;bottom:12px;left:12px;background:var(--maroon);padding:8px 16px}
.map-badge span{font-size:9px;letter-spacing:.3em;color:var(--gold-light);text-transform:uppercase;font-family:'Raleway';font-weight:500}
.venue-card2{background:var(--maroon);color:var(--ivory);padding:24px 28px;display:grid;grid-template-columns:1fr auto;gap:16px;align-items:center}
.vn2{font-family:'Yeseva One',serif;font-size:20px;color:var(--gold-light);margin-bottom:5px}
.va2{font-size:13px;color:rgba(250,243,232,.7);line-height:1.9;font-weight:300;font-style:italic}
.maps-btn{display:inline-block;padding:11px 22px;background:var(--gold);color:var(--maroon-dark);font-family:'Raleway';font-size:9px;letter-spacing:.3em;text-transform:uppercase;font-weight:700;text-decoration:none;white-space:nowrap;transition:background .3s;flex-shrink:0}
.maps-btn:hover{background:var(--gold-light)}

/* ─── 6. GALLERY ─── */
#gallery{background:var(--ivory-mid)}
.gal-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:5px}
.gal2{aspect-ratio:1;overflow:hidden;cursor:pointer;position:relative;background:var(--ivory)}
.gal2-inner{width:100%;height:100%;display:flex;flex-direction:column;align-items:center;justify-content:center;gap:8px;transition:transform .4s}
.gal2:hover .gal2-inner{transform:scale(1.06)}
.gal2::after{content:'';position:absolute;inset:0;background:rgba(123,28,46,0.0);transition:background .3s;pointer-events:none}
.gal2:hover::after{background:rgba(123,28,46,0.12)}
.gal2-inner svg{width:28px;opacity:.2}
.gal2-inner span{font-size:7px;letter-spacing:.3em;color:var(--ivory-dark);text-transform:uppercase;opacity:.6}
.lb3{display:none;position:fixed;inset:0;background:rgba(26,10,15,.95);z-index:200;align-items:center;justify-content:center}
.lb3.open{display:flex}
.lb3-img{max-width:85vw;max-height:85vh;object-fit:contain;border:2px solid rgba(196,149,58,.3)}
.lb3-x{position:fixed;top:20px;right:20px;width:38px;height:38px;background:var(--gold);border:none;cursor:pointer;font-size:20px;color:var(--maroon-dark);display:flex;align-items:center;justify-content:center;font-family:'Yeseva One',serif}

/* ─── 7. RSVP ─── */
#rsvp{background:var(--maroon)}
#rsvp .sec-head2{color:var(--gold-light)}
.rsvp3{max-width:480px;margin:0 auto;background:rgba(196,149,58,.06);border:1px solid rgba(196,149,58,.2);padding:44px 40px;position:relative}
.rsvp3::before,.rsvp3::after{content:'';position:absolute;width:16px;height:16px;border-color:var(--gold);border-style:solid}
.rsvp3::before{top:-1px;left:-1px;border-width:2px 0 0 2px}
.rsvp3::after{bottom:-1px;right:-1px;border-width:0 2px 2px 0}
.rsvp3-form{display:flex;flex-direction:column;gap:16px}
.rl{font-family:'Raleway';font-size:9px;letter-spacing:.35em;color:var(--gold);text-transform:uppercase;display:block;margin-bottom:5px;font-weight:500}
.ri,.rs,.rt{width:100%;background:rgba(196,149,58,.06);border:1px solid rgba(196,149,58,.2);color:var(--ivory);font-family:'Raleway';font-size:14px;padding:12px 16px;outline:none;transition:border-color .3s}
.ri:focus,.rs:focus,.rt:focus{border-color:var(--gold)}
.rt{height:88px;resize:none}
.rs{appearance:none}
.rs option{background:var(--maroon-dark)}
.rsvp3-btn{padding:14px;background:var(--gold);border:none;color:var(--maroon-dark);font-family:'Raleway';font-size:10px;letter-spacing:.4em;text-transform:uppercase;cursor:pointer;font-weight:700;transition:background .3s}
.rsvp3-btn:hover{background:var(--gold-light)}
.rsvp3-ok{display:none;text-align:center;padding:32px 0;font-family:'Great Vibes';font-size:32px;color:var(--gold-light)}

/* ─── 8. UCAPAN ─── */
#ucapan{background:var(--ivory)}
.wl3{display:flex;flex-direction:column;gap:14px;max-height:440px;overflow-y:auto;padding-right:4px;scrollbar-width:thin;scrollbar-color:rgba(123,28,46,.2) transparent;margin-bottom:24px}
.wc3{border:1px solid rgba(123,28,46,.12);padding:20px 24px;background:var(--ivory);position:relative;padding-left:20px}
.wc3::before{content:'';position:absolute;top:0;left:0;bottom:0;width:3px;background:var(--gold)}
.wt3{font-size:14px;line-height:1.9;color:var(--maroon-light);font-style:italic;font-weight:300;margin-bottom:10px}
.wf3{display:flex;justify-content:space-between;align-items:center}
.wn3{font-family:'Raleway';font-size:9px;letter-spacing:.25em;color:var(--maroon);text-transform:uppercase;font-weight:500}
.ws3{font-size:10px;color:var(--ivory-dark)}
.add3{background:var(--ivory-mid);border:1px solid rgba(123,28,46,.1);padding:28px}
.add3-row{display:grid;grid-template-columns:1fr 1fr;gap:12px;margin-bottom:12px}
.add3-btn{padding:11px 28px;background:var(--maroon);border:none;color:var(--gold-light);font-family:'Raleway';font-size:9px;letter-spacing:.3em;text-transform:uppercase;cursor:pointer;font-weight:500;transition:background .3s}
.add3-btn:hover{background:var(--maroon-light)}

/* ─── 9. FOOTER ─── */
#footer{background:var(--maroon-dark);padding:70px 40px;text-align:center;color:var(--ivory);position:relative;overflow:hidden}
#footer::before{content:'';position:absolute;top:0;left:0;right:0;height:3px;background:linear-gradient(to right,transparent,var(--gold),transparent)}
.ft3-dec{margin-bottom:28px}
.ft3-names{font-family:'Great Vibes',cursive;font-size:48px;color:var(--gold-light);margin-bottom:10px}
.ft3-tagline{font-size:13px;color:rgba(250,243,232,.6);font-style:italic;margin-bottom:18px;font-weight:300}
.ft3-date{font-family:'Raleway';font-size:9px;letter-spacing:.4em;color:var(--gold);text-transform:uppercase;margin-bottom:40px}
.ft3-copy{font-size:11px;color:rgba(250,243,232,.25);letter-spacing:.15em}

/* ANIMATIONS */
@keyframes fadeIn{from{opacity:0;transform:translateY(20px)}to{opacity:1;transform:translateY(0)}}
@keyframes pulse{0%,100%{opacity:.4}50%{opacity:1}}
.reveal{opacity:0;transform:translateY(28px);transition:opacity .8s ease,transform .8s ease}
.reveal.visible{opacity:1;transform:translateY(0)}

@media(max-width:480px){
  .mempelai-layout{grid-template-columns:1fr;gap:0}
  .mp-mid{padding:12px 0}
  .mp-and{writing-mode:horizontal-tb;font-size:36px}
  .mp-frame{width:120px;height:120px}
  section{padding:60px 24px}
  .rsvp3{padding:32px 20px}
  .add3-row{grid-template-columns:1fr}
  .venue-card2{grid-template-columns:1fr}
  .cover-bride,.cover-groom{font-size:48px}
  .cover-frame{padding:32px 24px}
}
</style>
</head>
<body>

<div class="page">

<!-- 1. COVER -->
<section id="cover">
  <div class="cover-frame">
    <div class="cover-corner tl"></div>
    <div class="cover-corner tr"></div>
    <div class="cover-corner bl"></div>
    <div class="cover-corner br"></div>

    <div class="cover-ornament">
      <svg viewBox="0 0 280 50" width="240" fill="none" xmlns="http://www.w3.org/2000/svg">
        <line x1="0" y1="25" x2="90" y2="25" stroke="rgba(196,149,58,0.5)" stroke-width=".8"/>
        <path d="M96 25 L104 17 L112 25 L104 33 Z" stroke="rgba(196,149,58,0.7)" stroke-width=".8" fill="none"/>
        <path d="M118 25 L126 17 L134 25 L126 33 Z" stroke="rgba(196,149,58,0.5)" stroke-width=".8" fill="none"/>
        <circle cx="140" cy="25" r="8" stroke="rgba(196,149,58,0.6)" stroke-width=".8" fill="none"/>
        <circle cx="140" cy="25" r="2.5" fill="rgba(196,149,58,0.6)"/>
        <path d="M146 25 L154 17 L162 25 L154 33 Z" stroke="rgba(196,149,58,0.5)" stroke-width=".8" fill="none"/>
        <path d="M168 25 L176 17 L184 25 L176 33 Z" stroke="rgba(196,149,58,0.7)" stroke-width=".8" fill="none"/>
        <line x1="190" y1="25" x2="280" y2="25" stroke="rgba(196,149,58,0.5)" stroke-width=".8"/>
      </svg>
    </div>

    <p class="cover-toptext">Undangan Pernikahan</p>
    <p class="cover-title-small">Dengan Rahmat Allah SWT kami mengundang</p>
    <span class="cover-bride">Sekar Ayu</span>
    <span class="cover-amp">& </span>
    <span class="cover-groom">Bagas Wicaksono</span>
    <div class="cover-date-row">
      <div class="cover-date-inner">
        <div class="cover-date-line"></div>
        <span class="cover-date-text">Sabtu · 5 Juli 2025 · Yogyakarta</span>
        <div class="cover-date-line"></div>
      </div>
    </div>
  </div>
  <div class="cover-scroll">
    <span>Gulir kebawah</span>
    <div class="cover-scrollline"></div>
  </div>
</section>

<!-- 2. PENGANTAR -->
<section id="pengantar">
  <div class="sec-top">
    <span class="sec-label2 reveal">Bismillahirrahmanirrahim</span>
    <h2 class="sec-head2 reveal">Kata <span>Pengantar</span></h2>
  </div>
  <div class="quran-wrap reveal">
    <p class="q-ar">وَمِنْ آيَاتِهِ أَنْ خَلَقَ لَكُم مِّنْ أَنفُسِكُمْ أَزْوَاجًا</p>
    <p class="q-tr">"Dan di antara tanda-tanda kekuasaan-Nya ialah Dia menciptakan untukmu pasangan dari jenismu sendiri, supaya kamu cenderung dan merasa tentram kepadanya, dan dijadikan-Nya di antaramu rasa kasih dan sayang."</p>
    <span class="q-ref">— QS. Ar-Rum: 21</span>
  </div>
  <p class="peng-text reveal">
    Assalamu'alaikum Warahmatullahi Wabarakatuh.<br><br>
    Alhamdulillah, puji syukur ke hadirat Allah SWT yang telah mempertemukan dan menyatukan dua hati dalam ikatan suci pernikahan.<br><br>
    Dengan penuh kebahagiaan dan kerendahan hati, kami mengundang Bapak/Ibu/Saudara/i untuk hadir memberikan doa dan restu kepada putra-putri kami dalam melangsungkan pernikahan.
  </p>
</section>

<!-- 3. MEMPELAI -->
<section id="mempelai">
  <div class="sec-top">
    <span class="sec-label2 reveal">Kedua Mempelai</span>
    <h2 class="sec-head2 reveal">Dua <span>Insan</span> yang Bersatu</h2>
  </div>
  <div class="mempelai-layout reveal">
    <div class="mp-side">
      <div class="mp-frame">
        <svg viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="40" cy="28" r="16" stroke="#7B1C2E" stroke-width="1.5"/><path d="M12 72 C12 52 68 52 68 72" stroke="#7B1C2E" stroke-width="1.5" fill="none"/></svg>
      </div>
      <div class="mp-name-script">Sekar Ayu</div>
      <div class="mp-name-formal">Sekar Ayu Puspita, S.Sos.</div>
      <div class="batik-divider" style="max-width:160px;margin:10px auto 14px"><div class="bl2"></div><div class="bm"></div><div class="bl2"></div></div>
      <span class="mp-parents-tag">Putri dari</span>
      <p class="mp-parents">Bapak KRT. Haryanto Kusumo<br>& Ibu Rr. Sri Wahyuni</p>
    </div>
    <div class="mp-mid">
      <div class="mp-and">&</div>
    </div>
    <div class="mp-side">
      <div class="mp-frame">
        <svg viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="40" cy="28" r="16" stroke="#7B1C2E" stroke-width="1.5"/><path d="M12 72 C12 52 68 52 68 72" stroke="#7B1C2E" stroke-width="1.5" fill="none"/></svg>
      </div>
      <div class="mp-name-script">Bagas Wicaksono</div>
      <div class="mp-name-formal">Bagas Wicaksono, S.T., M.T.</div>
      <div class="batik-divider" style="max-width:160px;margin:10px auto 14px"><div class="bl2"></div><div class="bm"></div><div class="bl2"></div></div>
      <span class="mp-parents-tag">Putra dari</span>
      <p class="mp-parents">Bapak H. Drs. Suwanto<br>& Ibu Hj. Tutik Rahayu</p>
    </div>
  </div>
</section>

<!-- 4. ACARA -->
<section id="acara">
  <div class="sec-top">
    <span class="sec-label2 reveal">Jadwal</span>
    <h2 class="sec-head2 reveal" style="color:var(--gold-light)">Rangkaian <span style="color:var(--gold)">Acara</span></h2>
  </div>
  <div class="acara-cards">
    <div class="acara-card reveal">
      <div class="acara-num">I</div>
      <div class="acara-body">
        <span class="acara-tag2">Jumat · 4 Juli 2025</span>
        <div class="acara-name2">Midodareni & Pengajian</div>
        <div class="acara-detail">19:00 – 22:00 WIB<br>Ndalem Kusumo, Kotagede Yogyakarta<br>Jl. Tegal Gendu No. 16, Yogyakarta</div>
        <span class="dress-tag">Kebaya & Batik Jawa</span>
      </div>
    </div>
    <div class="acara-card reveal">
      <div class="acara-num">II</div>
      <div class="acara-body">
        <span class="acara-tag2">Sabtu · 5 Juli 2025 · Pagi</span>
        <div class="acara-name2">Akad Nikah</div>
        <div class="acara-detail">08:00 – 10:00 WIB<br>Masjid Gedhe Kauman Yogyakarta<br>Jl. Kauman, Keraton, Yogyakarta</div>
        <span class="dress-tag">Formal – Putih & Gold</span>
      </div>
    </div>
    <div class="acara-card reveal">
      <div class="acara-num">III</div>
      <div class="acara-body">
        <span class="acara-tag2">Sabtu · 5 Juli 2025 · Siang</span>
        <div class="acara-name2">Resepsi Pernikahan</div>
        <div class="acara-detail">11:00 – 15:00 WIB<br>The Royal Ambarrukmo Yogyakarta<br>Jl. Laksda Adisucipto No. 81</div>
        <span class="dress-tag">Batik Nusantara</span>
      </div>
    </div>
    <div class="acara-card reveal">
      <div class="acara-num">IV</div>
      <div class="acara-body">
        <span class="acara-tag2">Minggu · 6 Juli 2025</span>
        <div class="acara-name2">Syukuran & Walimah</div>
        <div class="acara-detail">09:00 – 13:00 WIB<br>Kediaman Keluarga Mempelai Pria<br>Jl. Godean KM. 5, Sleman</div>
      </div>
    </div>
  </div>
</section>

<!-- 5. LOKASI -->
<section id="lokasi" class="batik-bg">
  <div class="sec-top">
    <span class="sec-label2 reveal">Venue</span>
    <h2 class="sec-head2 reveal">Lokasi <span>Acara</span></h2>
  </div>
  <div class="map-wrap reveal">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3953.0!2d110.4096!3d-7.7827!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a59b9a4095e33%3A0xe8b72a5dbc36f1d1!2sThe%20Royal%20Ambarrukmo!5e0!3m2!1sen!2sid!4v1" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    <div class="map-badge"><span>Venue Resepsi</span></div>
  </div>
  <div class="venue-card2 reveal">
    <div>
      <div class="vn2">The Royal Ambarrukmo</div>
      <div class="va2">Jl. Laksda Adisucipto No. 81<br>Yogyakarta 55281, DIY</div>
    </div>
    <a class="maps-btn" href="https://maps.google.com/?q=The+Royal+Ambarrukmo+Yogyakarta" target="_blank">Buka Maps</a>
  </div>
</section>

<!-- 6. GALLERY -->
<section id="gallery">
  <div class="sec-top">
    <span class="sec-label2 reveal">Kenangan</span>
    <h2 class="sec-head2 reveal">Galeri <span>Foto</span></h2>
  </div>
  <div class="gal-grid reveal">
    <script>
      const lbl3=['Pre-Wedding','Pertunangan','Bersama','Kenangan','Cinta','Bahagia','Momen','Keluarga','Jalan Bersama'];
      document.currentScript.insertAdjacentHTML('afterend',lbl3.map((l,i)=>`
        <div class="gal2" onclick="openLb3(${i})">
          <div class="gal2-inner">
            <svg viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg"><rect x="4" y="7" width="32" height="26" rx="2" stroke="#7B1C2E" stroke-width="1.2" opacity=".3"/><circle cx="20" cy="20" r="7" stroke="#C4953A" stroke-width="1" opacity=".4"/><circle cx="29" cy="12" r="2" fill="#C4953A" opacity=".3"/></svg>
            <span>${l}</span>
          </div>
        </div>`).join(''));
    </script>
  </div>
  <p style="text-align:center;margin-top:14px;font-size:12px;font-style:italic;color:var(--ivory-dark)" class="reveal">Ganti placeholder dengan foto pre-wedding Anda</p>
  <div class="lb3" id="lb3" onclick="closeLb3()">
    <button class="lb3-x" onclick="closeLb3()">×</button>
    <img class="lb3-img" id="lbImg3" src="" alt="">
  </div>
</section>

<!-- 7. RSVP -->
<section id="rsvp">
  <div class="sec-top">
    <span class="sec-label2 reveal">Konfirmasi</span>
    <h2 class="sec-head2 reveal" style="color:var(--gold-light)">RSVP</h2>
  </div>
  <div class="rsvp3 reveal">
    <form class="rsvp3-form" id="rsvpForm3" onsubmit="submitRsvp3(event)">
      <div><label class="rl">Nama Lengkap</label><input class="ri" type="text" placeholder="Nama Anda" required></div>
      <div><label class="rl">Nomor Whatsapp</label><input class="ri" type="tel" placeholder="08xx-xxxx-xxxx"></div>
      <div><label class="rl">Kehadiran</label>
        <select class="rs">
          <option value="">Pilih konfirmasi</option>
          <option>✓ Insya Allah saya akan hadir</option>
          <option>✗ Mohon maaf tidak dapat hadir</option>
          <option>? Belum dapat memastikan</option>
        </select>
      </div>
      <div><label class="rl">Jumlah Tamu</label>
        <select class="rs"><option>1 orang</option><option>2 orang</option><option>3 orang</option><option>4 orang</option></select>
      </div>
      <button type="submit" class="rsvp3-btn">Kirim Konfirmasi</button>
    </form>
    <div class="rsvp3-ok" id="rsvpOk3">Matur Nuwun! 🙏<br><small style="font-family:Raleway;font-size:14px;color:var(--gold-light)">Kami menantikan kehadiran Anda</small></div>
  </div>
</section>

<!-- 8. UCAPAN -->
<section id="ucapan" class="batik-bg">
  <div class="sec-top">
    <span class="sec-label2 reveal">Doa & Harapan</span>
    <h2 class="sec-head2 reveal">Kata <span>Sahabat</span></h2>
  </div>
  <div class="wl3 reveal" id="wishList3">
    <div class="wc3">
      <p class="wt3">Mugi-mugi dados keluarga ingkang sakinah, mawaddah, wa rahmah. Barakallahu lakuma wa baraka 'alaikuma. Selamat menempuh hidup baru Mas Bagas & Mbak Sekar!</p>
      <div class="wf3"><span class="wn3">Raden Mas Anggoro</span><span class="ws3">✓ Hadir</span></div>
    </div>
    <div class="wc3">
      <p class="wt3">Alhamdulillah, akhirnya hari yang ditunggu tiba. Semoga pernikahan kalian membawa berkah dan kebahagiaan yang abadi. Salam dari keluarga kami.</p>
      <div class="wf3"><span class="wn3">Keluarga Besar Santoso</span><span class="ws3">✓ Hadir</span></div>
    </div>
    <div class="wc3">
      <p class="wt3">Matur nuwun undangannya, sayang sekali tidak bisa hadir langsung. Doa terbaik selalu menyertai langkah indah kalian berdua.</p>
      <div class="wf3"><span class="wn3">Putri Handayani</span><span class="ws3">✗ Tidak Hadir</span></div>
    </div>
  </div>
  <div class="add3 reveal">
    <div class="add3-row">
      <div><label class="rl" style="color:var(--maroon)">Nama Anda</label><input class="ri" style="border-color:rgba(123,28,46,.2);background:var(--ivory);color:var(--maroon-dark)" id="wn3i" type="text" placeholder="Nama Anda"></div>
      <div><label class="rl" style="color:var(--maroon)">Kehadiran</label><select class="rs" style="border-color:rgba(123,28,46,.2);background:var(--ivory);color:var(--maroon-dark)" id="wh3i"><option>✓ Hadir</option><option>✗ Tidak Hadir</option></select></div>
    </div>
    <div style="margin-bottom:14px"><label class="rl" style="color:var(--maroon)">Ucapan & Doa</label><textarea class="rt" style="border-color:rgba(123,28,46,.2);background:var(--ivory);color:var(--maroon-dark)" id="wt3i" placeholder="Tuliskan ucapan dan doa terbaik Anda…"></textarea></div>
    <button class="add3-btn" onclick="addWish3()">Kirim Ucapan</button>
  </div>
</section>

<!-- 9. FOOTER -->
<footer id="footer">
  <div class="ft3-dec">
    <svg viewBox="0 0 240 40" width="200" fill="none" xmlns="http://www.w3.org/2000/svg">
      <line x1="0" y1="20" x2="85" y2="20" stroke="rgba(196,149,58,0.4)" stroke-width=".8"/>
      <path d="M91 20 L99 12 L107 20 L99 28 Z" stroke="rgba(196,149,58,0.5)" stroke-width=".8" fill="none"/>
      <circle cx="120" cy="20" r="9" stroke="rgba(196,149,58,0.4)" stroke-width=".8" fill="none"/>
      <circle cx="120" cy="20" r="2.5" fill="rgba(196,149,58,0.4)"/>
      <path d="M133 20 L141 12 L149 20 L141 28 Z" stroke="rgba(196,149,58,0.5)" stroke-width=".8" fill="none"/>
      <line x1="155" y1="20" x2="240" y2="20" stroke="rgba(196,149,58,0.4)" stroke-width=".8"/>
    </svg>
  </div>
  <div class="ft3-names">Sekar & Bagas</div>
  <p class="ft3-tagline">Dua Hati, Satu Ikrar, Satu Tujuan Mulia</p>
  <div class="ft3-date">Sabtu · 5 Juli 2025 · Yogyakarta</div>
  <p class="ft3-copy">Undangan Digital · Dibuat dengan Cinta 🏛️ 2025</p>
</footer>

</div>

<script>
const obs3 = new IntersectionObserver(entries=>{
  entries.forEach((e,i)=>{if(e.isIntersecting)setTimeout(()=>e.target.classList.add('visible'),i*70)});
},{threshold:.1});
document.querySelectorAll('.reveal').forEach(r=>obs3.observe(r));
function submitRsvp3(e){e.preventDefault();document.getElementById('rsvpForm3').style.display='none';document.getElementById('rsvpOk3').style.display='block'}
function openLb3(i){document.getElementById('lb3').classList.add('open')}
function closeLb3(){document.getElementById('lb3').classList.remove('open')}
function addWish3(){
  const n=document.getElementById('wn3i').value.trim();
  const h=document.getElementById('wh3i').value;
  const t=document.getElementById('wt3i').value.trim();
  if(!n||!t){alert('Mohon isi nama dan ucapan Anda');return}
  const c=document.createElement('div');c.className='wc3';
  c.innerHTML=`<p class="wt3">${t}</p><div class="wf3"><span class="wn3">${n}</span><span class="ws3">${h}</span></div>`;
  document.getElementById('wishList3').prepend(c);
  document.getElementById('wn3i').value='';document.getElementById('wt3i').value='';
}
</script>
</body>
</html>