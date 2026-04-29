<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Undangan Pernikahan – Rizky & Zahra</title>
<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;1,300;1,400&family=Cinzel+Decorative:wght@400&family=IM+Fell+English:ital@0;1&display=swap" rel="stylesheet">
<style>
  :root {
    --gold: #c9a96e;
    --gold-light: #e8cc99;
    --gold-dark: #8b6914;
    --cream: #faf6ee;
    --deep: #1a1208;
    --mid: #3d2e12;
    --accent: #7a4f2d;
  }

  * { margin: 0; padding: 0; box-sizing: border-box; }

  body {
    background: var(--deep);
    font-family: 'Cormorant Garamond', serif;
    color: var(--cream);
    overflow-x: hidden;
  }

  /* ── COVER ── */
  .cover {
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-align: center;
    position: relative;
    overflow: hidden;
    padding: 40px 20px;
    background: radial-gradient(ellipse at 50% 30%, #2e1d08 0%, #0e0a04 70%);
  }

  .cover::before {
    content: '';
    position: absolute;
    inset: 0;
    background-image:
      repeating-linear-gradient(0deg, transparent, transparent 48px, rgba(201,169,110,.04) 48px, rgba(201,169,110,.04) 49px),
      repeating-linear-gradient(90deg, transparent, transparent 48px, rgba(201,169,110,.04) 48px, rgba(201,169,110,.04) 49px);
    pointer-events: none;
  }

  /* corner ornaments */
  .corner { position: absolute; width: 120px; height: 120px; opacity: .55; }
  .corner svg { width: 100%; height: 100%; }
  .corner.tl { top: 18px; left: 18px; }
  .corner.tr { top: 18px; right: 18px; transform: scaleX(-1); }
  .corner.bl { bottom: 18px; left: 18px; transform: scaleY(-1); }
  .corner.br { bottom: 18px; right: 18px; transform: scale(-1); }

  .cover-inner {
    position: relative;
    z-index: 2;
    animation: fadeUp 1.4s ease both;
  }

  .label-bismillah {
    font-family: 'IM Fell English', serif;
    font-style: italic;
    font-size: clamp(13px, 2vw, 16px);
    letter-spacing: .25em;
    color: var(--gold);
    text-transform: uppercase;
    margin-bottom: 28px;
    opacity: .85;
  }

  .divider-ornament {
    display: flex; align-items: center; gap: 12px;
    justify-content: center;
    margin: 20px auto;
    color: var(--gold);
    font-size: 22px;
    letter-spacing: 4px;
    opacity: .7;
  }
  .divider-ornament::before,
  .divider-ornament::after {
    content: '';
    display: block;
    width: 60px; height: 1px;
    background: linear-gradient(90deg, transparent, var(--gold));
  }
  .divider-ornament::after { background: linear-gradient(90deg, var(--gold), transparent); }

  .couple-name {
    font-family: 'Cinzel Decorative', serif;
    font-size: clamp(28px, 6vw, 56px);
    line-height: 1.25;
    color: var(--gold-light);
    text-shadow: 0 0 40px rgba(201,169,110,.35);
    margin: 10px 0;
    letter-spacing: .04em;
  }
  .couple-name .ampersand {
    display: block;
    font-family: 'Cormorant Garamond', serif;
    font-style: italic;
    font-size: .6em;
    color: var(--gold);
    opacity: .8;
    margin: 4px 0;
  }

  .cover-tagline {
    font-style: italic;
    font-size: clamp(14px, 2.2vw, 18px);
    color: var(--gold-light);
    opacity: .7;
    margin-top: 14px;
    letter-spacing: .12em;
  }

  .scroll-hint {
    margin-top: 52px;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 8px;
    font-size: 12px;
    letter-spacing: .2em;
    text-transform: uppercase;
    color: var(--gold);
    opacity: .55;
    animation: pulse 2s ease infinite;
  }
  .scroll-hint svg { width: 20px; opacity: .7; }

  /* ── SECTIONS ── */
  section {
    max-width: 680px;
    margin: 0 auto;
    padding: 80px 28px;
    text-align: center;
    position: relative;
  }

  .section-label {
    font-family: 'IM Fell English', serif;
    font-style: italic;
    font-size: 13px;
    letter-spacing: .3em;
    text-transform: uppercase;
    color: var(--gold);
    opacity: .75;
    margin-bottom: 18px;
  }

  h2 {
    font-family: 'Cinzel Decorative', serif;
    font-size: clamp(20px, 4vw, 30px);
    color: var(--gold-light);
    letter-spacing: .06em;
    margin-bottom: 22px;
  }

  p {
    font-size: clamp(15px, 2.2vw, 18px);
    line-height: 1.85;
    color: rgba(250,246,238,.78);
  }

  /* ── MEMPELAI ── */
  .mempelai-grid {
    display: grid;
    grid-template-columns: 1fr auto 1fr;
    align-items: center;
    gap: 24px;
    margin-top: 44px;
  }
  .mempelai-card { text-align: center; }
  .avatar {
    width: 100px; height: 100px;
    border-radius: 50%;
    margin: 0 auto 16px;
    border: 2px solid var(--gold);
    box-shadow: 0 0 30px rgba(201,169,110,.2);
    overflow: hidden;
    background: linear-gradient(135deg, #2e1d08, #4a2e10);
    display: flex; align-items: center; justify-content: center;
    font-size: 38px;
  }
  .mempelai-name {
    font-family: 'Cinzel Decorative', serif;
    font-size: clamp(14px, 2.8vw, 20px);
    color: var(--gold-light);
    margin-bottom: 6px;
  }
  .mempelai-parents {
    font-style: italic;
    font-size: clamp(12px, 1.8vw, 14px);
    color: rgba(232,204,153,.6);
    line-height: 1.6;
  }
  .and-symbol {
    font-family: 'Cormorant Garamond', serif;
    font-style: italic;
    font-size: clamp(36px, 6vw, 56px);
    color: var(--gold);
    opacity: .6;
    line-height: 1;
  }

  /* ── ACARA ── */
  .acara-wrapper {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 24px;
    margin-top: 44px;
  }
  @media(max-width: 520px) { .acara-wrapper { grid-template-columns: 1fr; } }

  .acara-card {
    border: 1px solid rgba(201,169,110,.25);
    padding: 30px 22px;
    background: rgba(255,255,255,.02);
    backdrop-filter: blur(4px);
    position: relative;
  }
  .acara-card::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 2px;
    background: linear-gradient(90deg, transparent, var(--gold), transparent);
  }
  .acara-type {
    font-family: 'Cinzel Decorative', serif;
    font-size: 13px;
    color: var(--gold);
    letter-spacing: .12em;
    margin-bottom: 16px;
  }
  .acara-date {
    font-size: clamp(26px, 4vw, 36px);
    font-weight: 300;
    color: var(--gold-light);
    line-height: 1.1;
    margin-bottom: 4px;
  }
  .acara-month {
    font-style: italic;
    font-size: 14px;
    color: var(--gold);
    opacity: .7;
    letter-spacing: .15em;
    margin-bottom: 14px;
  }
  .acara-time {
    font-size: 15px;
    color: rgba(250,246,238,.8);
    margin-bottom: 12px;
  }
  .acara-venue {
    font-style: italic;
    font-size: 13px;
    color: rgba(232,204,153,.6);
    line-height: 1.6;
  }

  /* ── COUNTDOWN ── */
  .countdown-wrap {
    display: flex;
    justify-content: center;
    gap: 20px;
    margin-top: 40px;
    flex-wrap: wrap;
  }
  .count-item { text-align: center; min-width: 64px; }
  .count-num {
    font-family: 'Cinzel Decorative', serif;
    font-size: clamp(28px, 5vw, 44px);
    color: var(--gold-light);
    display: block;
    line-height: 1;
  }
  .count-label {
    font-size: 11px;
    letter-spacing: .25em;
    text-transform: uppercase;
    color: var(--gold);
    opacity: .65;
    margin-top: 6px;
  }
  .count-sep {
    font-size: clamp(24px, 4vw, 40px);
    color: var(--gold);
    opacity: .3;
    align-self: flex-start;
    padding-top: 8px;
  }

  /* ── LOCATION ── */
  .map-embed {
    margin-top: 36px;
    border: 1px solid rgba(201,169,110,.2);
    overflow: hidden;
    position: relative;
  }
  .map-embed::before {
    content: '';
    position: absolute;
    inset: 0;
    border: 3px solid rgba(201,169,110,.08);
    z-index: 1;
    pointer-events: none;
  }
  .map-embed iframe {
    width: 100%; height: 260px;
    display: block; border: 0;
    filter: sepia(.4) brightness(.8) contrast(1.1);
  }
  .map-btn {
    display: inline-block;
    margin-top: 20px;
    padding: 12px 32px;
    border: 1px solid var(--gold);
    color: var(--gold);
    font-family: 'Cormorant Garamond', serif;
    font-size: 14px;
    letter-spacing: .2em;
    text-transform: uppercase;
    text-decoration: none;
    transition: all .3s;
    background: transparent;
    cursor: pointer;
  }
  .map-btn:hover {
    background: var(--gold);
    color: var(--deep);
  }

  /* ── RSVP ── */
  .rsvp-form {
    margin-top: 40px;
    display: flex;
    flex-direction: column;
    gap: 14px;
    text-align: left;
  }
  .rsvp-form input,
  .rsvp-form select,
  .rsvp-form textarea {
    width: 100%;
    background: rgba(255,255,255,.04);
    border: 1px solid rgba(201,169,110,.25);
    padding: 14px 18px;
    color: var(--cream);
    font-family: 'Cormorant Garamond', serif;
    font-size: 16px;
    outline: none;
    transition: border-color .3s;
  }
  .rsvp-form input:focus,
  .rsvp-form select:focus,
  .rsvp-form textarea:focus { border-color: var(--gold); }
  .rsvp-form select option { background: #1a1208; }
  .rsvp-form textarea { resize: vertical; min-height: 90px; }
  .rsvp-submit {
    padding: 15px;
    background: linear-gradient(135deg, var(--gold-dark), var(--gold));
    border: none;
    color: var(--deep);
    font-family: 'Cinzel Decorative', serif;
    font-size: 13px;
    letter-spacing: .15em;
    cursor: pointer;
    transition: opacity .3s;
  }
  .rsvp-submit:hover { opacity: .85; }

  /* ── WISHES ── */
  .wish-card {
    border-left: 2px solid rgba(201,169,110,.3);
    padding: 16px 20px;
    margin-bottom: 16px;
    text-align: left;
    background: rgba(255,255,255,.02);
  }
  .wish-author {
    font-family: 'Cinzel Decorative', serif;
    font-size: 12px;
    color: var(--gold);
    margin-bottom: 6px;
    letter-spacing: .1em;
  }
  .wish-text {
    font-style: italic;
    font-size: 15px;
    line-height: 1.7;
    color: rgba(250,246,238,.7);
  }

  /* ── GALLERY ── */
  .gallery-section {
    max-width: 100%;
    padding: 80px 0;
    text-align: center;
    position: relative;
  }
  .gallery-section .section-label,
  .gallery-section h2,
  .gallery-section .sep-line,
  .gallery-section > p {
    max-width: 680px;
    margin-left: auto;
    margin-right: auto;
    padding: 0 28px;
  }
  .gallery-section > p { padding-bottom: 0; }

  /* masonry grid */
  .gallery-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    grid-template-rows: auto;
    gap: 6px;
    margin-top: 40px;
    padding: 0 6px;
  }
  .gallery-grid .g-item {
    position: relative;
    overflow: hidden;
    cursor: pointer;
    background: #120d04;
  }
  /* featured big items */
  .gallery-grid .g-item:nth-child(1) { grid-column: span 2; grid-row: span 2; }
  .gallery-grid .g-item:nth-child(6) { grid-column: span 2; }

  .g-item .g-inner {
    width: 100%; height: 100%;
    min-height: 160px;
    display: flex; align-items: center; justify-content: center;
    font-size: clamp(32px, 5vw, 56px);
    transition: transform .5s cubic-bezier(.25,.46,.45,.94);
    position: relative;
    overflow: hidden;
  }
  .g-item:nth-child(1) .g-inner { min-height: 340px; }

  /* placeholder gradient backgrounds simulating photos */
  .g-item:nth-child(1) .g-inner { background: linear-gradient(135deg, #3d2410 0%, #1e0e04 50%, #2a1808 100%); }
  .g-item:nth-child(2) .g-inner { background: linear-gradient(135deg, #1e1205 0%, #3a2010 100%); }
  .g-item:nth-child(3) .g-inner { background: linear-gradient(135deg, #2e1a08 0%, #150a02 100%); }
  .g-item:nth-child(4) .g-inner { background: linear-gradient(135deg, #120a02 0%, #3a2612 100%); }
  .g-item:nth-child(5) .g-inner { background: linear-gradient(135deg, #251508 0%, #1a0e04 100%); }
  .g-item:nth-child(6) .g-inner { background: linear-gradient(135deg, #1e1005 0%, #3d2410 100%); }
  .g-item:nth-child(7) .g-inner { background: linear-gradient(135deg, #2a1606 0%, #130802 100%); }

  /* decorative texture overlay per card */
  .g-inner::before {
    content: '';
    position: absolute; inset: 0;
    background: repeating-linear-gradient(
      45deg,
      transparent, transparent 20px,
      rgba(201,169,110,.03) 20px, rgba(201,169,110,.03) 21px
    );
    pointer-events: none;
  }

  /* gold border on hover */
  .g-item::after {
    content: '';
    position: absolute; inset: 0;
    border: 2px solid rgba(201,169,110,0);
    transition: border-color .35s;
    z-index: 2;
    pointer-events: none;
  }
  .g-item:hover::after { border-color: rgba(201,169,110,.6); }
  .g-item:hover .g-inner { transform: scale(1.04); }

  /* caption overlay */
  .g-caption {
    position: absolute;
    bottom: 0; left: 0; right: 0;
    padding: 28px 16px 14px;
    background: linear-gradient(to top, rgba(10,6,2,.85) 0%, transparent 100%);
    font-style: italic;
    font-size: 13px;
    color: rgba(232,204,153,.75);
    letter-spacing: .08em;
    z-index: 3;
    transform: translateY(4px);
    opacity: 0;
    transition: all .35s;
  }
  .g-item:hover .g-caption { opacity: 1; transform: translateY(0); }

  /* emoji illustration inside each card */
  .g-emoji {
    font-size: clamp(36px, 6vw, 64px);
    position: relative;
    z-index: 1;
    filter: drop-shadow(0 4px 16px rgba(0,0,0,.5));
    transition: transform .5s;
  }
  .g-item:hover .g-emoji { transform: scale(1.08) rotate(-2deg); }
  .g-item:nth-child(1) .g-emoji { font-size: clamp(52px, 8vw, 88px); }

  /* lightbox */
  .lightbox {
    display: none;
    position: fixed; inset: 0;
    background: rgba(8,5,2,.92);
    z-index: 9999;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    gap: 20px;
    padding: 40px;
    backdrop-filter: blur(8px);
  }
  .lightbox.open { display: flex; }
  .lightbox-inner {
    max-width: 560px; width: 100%;
    text-align: center;
    animation: fadeUp .4s ease both;
  }
  .lightbox-img {
    width: 100%;
    aspect-ratio: 4/3;
    background: linear-gradient(135deg, #3d2410, #1a0e04);
    display: flex; align-items: center; justify-content: center;
    font-size: 80px;
    border: 1px solid rgba(201,169,110,.25);
    box-shadow: 0 0 60px rgba(0,0,0,.6);
    margin-bottom: 18px;
  }
  .lightbox-caption {
    font-style: italic;
    font-size: 16px;
    color: var(--gold);
    letter-spacing: .1em;
  }
  .lightbox-close {
    position: absolute;
    top: 20px; right: 24px;
    background: none; border: 1px solid rgba(201,169,110,.3);
    color: var(--gold); font-size: 20px;
    width: 40px; height: 40px;
    cursor: pointer; display: flex; align-items: center; justify-content: center;
    transition: border-color .3s;
  }
  .lightbox-close:hover { border-color: var(--gold); }
  .lightbox-nav {
    display: flex; gap: 12px; justify-content: center; margin-top: 16px;
  }
  .lightbox-nav button {
    background: none; border: 1px solid rgba(201,169,110,.3);
    color: var(--gold); font-size: 18px; padding: 8px 20px;
    cursor: pointer; font-family: inherit;
    transition: all .3s;
  }
  .lightbox-nav button:hover { background: rgba(201,169,110,.1); border-color: var(--gold); }

  /* ── FOOTER ── */
  footer {
    text-align: center;
    padding: 60px 20px;
    border-top: 1px solid rgba(201,169,110,.12);
  }
  footer .footer-title {
    font-family: 'Cinzel Decorative', serif;
    font-size: clamp(16px, 3vw, 22px);
    color: var(--gold-light);
    margin-bottom: 10px;
  }
  footer p { font-style: italic; font-size: 14px; opacity: .5; margin-top: 28px; }

  /* separator line */
  .sep-line {
    width: 100px; height: 1px;
    background: linear-gradient(90deg, transparent, var(--gold), transparent);
    margin: 0 auto 32px;
  }

  /* ── ANIMATIONS ── */
  @keyframes fadeUp {
    from { opacity: 0; transform: translateY(30px); }
    to   { opacity: 1; transform: translateY(0); }
  }
  @keyframes pulse {
    0%, 100% { opacity: .4; }
    50%       { opacity: .8; }
  }

  .reveal {
    opacity: 0;
    transform: translateY(24px);
    transition: opacity .9s ease, transform .9s ease;
  }
  .reveal.visible { opacity: 1; transform: translateY(0); }

  /* horizontal rule between sections */
  .section-rule {
    border: none;
    border-top: 1px solid rgba(201,169,110,.1);
    max-width: 680px;
    margin: 0 auto;
  }

  /* music toggle */
  .music-btn {
    position: fixed;
    bottom: 22px; right: 22px;
    width: 48px; height: 48px;
    border-radius: 50%;
    background: rgba(20,12,4,.85);
    border: 1px solid var(--gold);
    color: var(--gold);
    font-size: 18px;
    cursor: pointer;
    z-index: 999;
    display: flex; align-items: center; justify-content: center;
    transition: background .3s;
  }
  .music-btn:hover { background: rgba(201,169,110,.15); }

  @media(max-width: 500px) {
    .mempelai-grid { grid-template-columns: 1fr; }
    .and-symbol { font-size: 32px; }
    .corner { width: 70px; height: 70px; }
  }
</style>
</head>
<body>

<!-- ══════════════════════════════════════ COVER ══════════════════════════════════════ -->
<div class="cover">
  <!-- corner ornaments -->
  <div class="corner tl">
    <svg viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
      <path d="M5 5 L5 60" stroke="#c9a96e" stroke-width="1.5"/>
      <path d="M5 5 L60 5" stroke="#c9a96e" stroke-width="1.5"/>
      <path d="M5 5 L25 25" stroke="#c9a96e" stroke-width=".8" opacity=".5"/>
      <circle cx="5" cy="5" r="3" fill="#c9a96e"/>
      <circle cx="5" cy="60" r="2" fill="#c9a96e" opacity=".5"/>
      <circle cx="60" cy="5" r="2" fill="#c9a96e" opacity=".5"/>
      <path d="M20 5 Q30 20 5 30" stroke="#c9a96e" stroke-width=".7" fill="none" opacity=".45"/>
    </svg>
  </div>
  <div class="corner tr">
    <svg viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
      <path d="M5 5 L5 60" stroke="#c9a96e" stroke-width="1.5"/>
      <path d="M5 5 L60 5" stroke="#c9a96e" stroke-width="1.5"/>
      <path d="M5 5 L25 25" stroke="#c9a96e" stroke-width=".8" opacity=".5"/>
      <circle cx="5" cy="5" r="3" fill="#c9a96e"/>
      <circle cx="5" cy="60" r="2" fill="#c9a96e" opacity=".5"/>
      <circle cx="60" cy="5" r="2" fill="#c9a96e" opacity=".5"/>
      <path d="M20 5 Q30 20 5 30" stroke="#c9a96e" stroke-width=".7" fill="none" opacity=".45"/>
    </svg>
  </div>
  <div class="corner bl">
    <svg viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
      <path d="M5 5 L5 60" stroke="#c9a96e" stroke-width="1.5"/>
      <path d="M5 5 L60 5" stroke="#c9a96e" stroke-width="1.5"/>
      <circle cx="5" cy="5" r="3" fill="#c9a96e"/>
    </svg>
  </div>
  <div class="corner br">
    <svg viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
      <path d="M5 5 L5 60" stroke="#c9a96e" stroke-width="1.5"/>
      <path d="M5 5 L60 5" stroke="#c9a96e" stroke-width="1.5"/>
      <circle cx="5" cy="5" r="3" fill="#c9a96e"/>
    </svg>
  </div>

  <div class="cover-inner">
    <div class="label-bismillah">Bismillahirrahmanirrahim</div>
    <p style="font-size:13px;letter-spacing:.25em;text-transform:uppercase;color:var(--gold);opacity:.6;margin-bottom:32px;">Undangan Pernikahan</p>

    <div class="divider-ornament">✦</div>

    <div class="couple-name">
      <span id="tpl-groom-name"><?=$groom_nickname ?? 'Grooms Name'?></span>
      <span class="ampersand">&amp;</span>
      <span id="tpl-bride-name"><?=$bride_nickname ?? 'Grooms Name'?></span>
    </div>

    <div class="divider-ornament">✦</div>

    <p class="cover-tagline" id="tpl-cover-tagline"><?=$acara_utama['tanggal']?></p>

    <div class="scroll-hint">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M12 5v14M5 12l7 7 7-7"/></svg>
      Gulir ke bawah
    </div>
  </div>
</div>

<!-- ══════════════════════════════════════ PEMBUKA ══════════════════════════════════════ -->
<section class="reveal">
  <p class="section-label">Dengan Penuh Bahagia</p>
  <div class="sep-line"></div>
  <p id="tpl-love-story">
        <?=$love_story?>
  </p>
</section>

<hr class="section-rule">

<!-- ══════════════════════════════════════ MEMPELAI ══════════════════════════════════════ -->
<section class="reveal">
  <p class="section-label">Kedua Mempelai</p>
  <h2>Yang Berbahagia</h2>
  <div class="sep-line"></div>

  <div class="mempelai-grid">
    <div class="mempelai-card">
      <div class="avatar">🤵</div>
      <div class="mempelai-name" id="tpl-groom-fullname">Rizky Pratama, S.T.</div>
        <div class="mempelai-parents" id="tpl-groom-parents">
          Putra pertama dari<br>Bapak H. Darmawan &amp; Ibu Hj. Siti Rahayu
        </div>
    </div>

    <div class="and-symbol">&amp;</div>

    <div class="mempelai-card">
      <div class="avatar">👰</div>
      <div class="mempelai-name" id="tpl-bride-fullname">Zahra Aulia, S.Pd.</div>
      <div class="mempelai-parents" id="tpl-bride-parents">
        Putri kedua dari<br>Bapak H. Ridwan Fauzi &amp; Ibu Hj. Nurul Hidayah
      </div>
    </div>
  </div>
</section>

<hr class="section-rule">

<!-- ══════════════════════════════════════ ACARA ══════════════════════════════════════ -->
<section class="reveal">
  <p class="section-label">Rangkaian Acara</p>
  <h2>Jadwal Pelaksanaan</h2>
  <div class="sep-line"></div>

  <div class="acara-wrapper">
    <div class="acara-card">
      <div class="acara-type">Akad Nikah</div>
      <div class="acara-date" id="tpl-akad-date">14</div>
      <div class="acara-month" id="tpl-akad-month">Juni 2025</div>
      <div class="acara-time" id="tpl-akad-time">08.00 – 10.00 WIB</div>
      <div class="acara-venue" id="tpl-akad-venue">Masjid Al-Ikhlas</div>
      <div class="acara-address" id="tpl-akad-address">Jl. Merdeka No. 12, Bandung</div>
      <a id="tpl-akad-maps-btn" href="#" target="_blank">Buka Maps</a>
    </div>

    <div class="acara-card">
      <div class="acara-type">Resepsi</div>
      <div class="acara-date" id="tpl-resepsi-date">14</div>
      <div class="acara-month" id="tpl-resepsi-month">Juni 2025</div>
      <div class="acara-time" id="tpl-resepsi-time">11.00 – 15.00 WIB</div>
      <div class="acara-venue" id="tpl-resepsi-venue">Gedung Serbaguna Permata</div>
      <div class="acara-address" id="tpl-resepsi-address">Jl. Sudirman No. 88, Bandung</div>
      <a id="tpl-resepsi-maps-btn" href="#" target="_blank">Buka Maps</a>
    </div>
  </div>
</section>

<hr class="section-rule">

<!-- ══════════════════════════════════════ COUNTDOWN ══════════════════════════════════════ -->
<section class="reveal">
  <p class="section-label">Menghitung Hari</p>
  <h2>Hitung Mundur</h2>
  <div class="sep-line"></div>

  <div class="countdown-wrap">
    <div class="count-item">
      <span class="count-num" id="cd-days">–</span>
      <div class="count-label">Hari</div>
    </div>
    <div class="count-sep">:</div>
    <div class="count-item">
      <span class="count-num" id="cd-hours">–</span>
      <div class="count-label">Jam</div>
    </div>
    <div class="count-sep">:</div>
    <div class="count-item">
      <span class="count-num" id="cd-mins">–</span>
      <div class="count-label">Menit</div>
    </div>
    <div class="count-sep">:</div>
    <div class="count-item">
      <span class="count-num" id="cd-secs">–</span>
      <div class="count-label">Detik</div>
    </div>
  </div>
</section>

<hr class="section-rule">

<!-- ══════════════════════════════════════ LOKASI ══════════════════════════════════════ -->
<section class="reveal">
  <p class="section-label">Lokasi Acara</p>
  <h2 id="tpl-resepsi-venue-maps">Gedung Serbaguna Permata</h2>
  <div class="sep-line"></div>
  <p id="tpl-resepsi-address-maps">Jl. Jend. Sudirman No. 88, Sumur Bandung,<br>Kota Bandung, Jawa Barat 40111</p>

  <div class="map-embed">
    <iframe
      src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.9001!2d107.6191!3d-6.9175!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e6398252477f%3A0x146a1f93d3e815a2!2sBandung%2C%20Kota%20Bandung%2C%20Jawa%20Barat!5e0!3m2!1sen!2sid!4v1680000000000!5m2!1sen!2sid"
      allowfullscreen loading="lazy"
      referrerpolicy="no-referrer-when-downgrade">
    </iframe>
  </div>

  <a class="map-btn" href="https://maps.google.com/?q=Bandung+Jawa+Barat" target="_blank">
    Buka di Google Maps
  </a>
</section>

<hr class="section-rule">

<!-- ══════════════════════════════════════ GALLERY ══════════════════════════════════════ -->
<hr class="section-rule">

<section class="gallery-section reveal">
  <p class="section-label">Momen Kami</p>
  <h2>Galeri Foto</h2>
  <div class="sep-line"></div>
  <p style="max-width:500px;font-style:italic;opacity:.7;font-size:15px;">Setiap momen adalah kenangan yang akan selalu kami ingat — dari pertemuan pertama hingga hari yang paling istimewa.</p>

  <div class="gallery-grid" id="gallery-grid">
    <div class="g-item" data-index="0">
      <div class="g-inner">
        <span class="g-emoji">💑</span>
      </div>
      <div class="g-caption">Pertunangan – Desember 2024</div>
    </div>
    <div class="g-item" data-index="1">
      <div class="g-inner">
        <span class="g-emoji">💐</span>
      </div>
      <div class="g-caption">Seserahan</div>
    </div>
    <div class="g-item" data-index="2">
      <div class="g-inner">
        <span class="g-emoji">🌸</span>
      </div>
      <div class="g-caption">Prewedding di Kebun</div>
    </div>
    <div class="g-item" data-index="3">
      <div class="g-inner">
        <span class="g-emoji">🕌</span>
      </div>
      <div class="g-caption">Lokasi Akad Nikah</div>
    </div>
    <div class="g-item" data-index="4">
      <div class="g-inner">
        <span class="g-emoji">🌅</span>
      </div>
      <div class="g-caption">Golden Hour Bandung</div>
    </div>
    <div class="g-item" data-index="5">
      <div class="g-inner">
        <span class="g-emoji">🎊</span>
      </div>
      <div class="g-caption">Henna Night – Keluarga Besar</div>
    </div>
    <div class="g-item" data-index="6">
      <div class="g-inner">
        <span class="g-emoji">💍</span>
      </div>
      <div class="g-caption">Cincin Pernikahan</div>
    </div>
  </div>
</section>

<!-- Lightbox -->
<div class="lightbox" id="lightbox">
  <button class="lightbox-close" id="lb-close">✕</button>
  <div class="lightbox-inner">
    <div class="lightbox-img" id="lb-img"></div>
    <div class="lightbox-caption" id="lb-caption"></div>
    <div class="lightbox-nav">
      <button id="lb-prev">← Sebelumnya</button>
      <button id="lb-next">Berikutnya →</button>
    </div>
  </div>
</div>

<!-- ══════════════════════════════════════ RSVP ══════════════════════════════════════ -->
<section class="reveal">
  <p class="section-label">Konfirmasi Kehadiran</p>
  <h2>RSVP</h2>
  <div class="sep-line"></div>
  <p>Mohon konfirmasi kehadiran Anda paling lambat <strong style="color:var(--gold)">7 Juni 2025</strong> agar kami dapat mempersiapkan segalanya dengan baik.</p>

  <div class="rsvp-form">
    <input type="text" placeholder="Nama Lengkap" id="rsvp-name">
    <select id="rsvp-attend">
      <option value="" disabled selected>Kehadiran</option>
      <option value="hadir">✓ Insyaallah Hadir</option>
      <option value="tidak">✗ Berhalangan Hadir</option>
    </select>
    <input type="number" placeholder="Jumlah Tamu (termasuk Anda)" min="1" max="5" id="rsvp-guests">
    <textarea placeholder="Ucapan &amp; Doa untuk Kedua Mempelai…" id="rsvp-message"></textarea>
    <button class="rsvp-submit" onclick="submitRSVP()">Kirim Konfirmasi</button>
  </div>
</section>

<hr class="section-rule">

<!-- ══════════════════════════════════════ UCAPAN ══════════════════════════════════════ -->
<section class="reveal">
  <p class="section-label">Doa &amp; Ucapan</p>
  <h2>Kata Sahabat</h2>
  <div class="sep-line"></div>

  <div id="wishes-list">
    <div class="wish-card">
      <div class="wish-author">Rina Maharani</div>
      <div class="wish-text">Barakallahu lakuma wa baraka 'alaikuma wa jama'a bainakuma fi khair. Semoga kalian menjadi pasangan yang sakinah, mawaddah, warahmah. Selamat menempuh hidup baru! 🌸</div>
    </div>
    <div class="wish-card">
      <div class="wish-author">Fajar Nugroho</div>
      <div class="wish-text">Selamat untuk Rizky dan Zahra! Semoga rumah tangga kalian dipenuhi kebahagiaan, kesehatan, dan rezeki yang berlimpah. Aamiin.</div>
    </div>
    <div class="wish-card">
      <div class="wish-author">Keluarga Besar Santoso</div>
      <div class="wish-text">Doa terbaik dari kami untuk kedua mempelai. Semoga menjadi keluarga yang harmonis dan selalu dalam lindungan Allah SWT.</div>
    </div>
  </div>
</section>

<!-- ══════════════════════════════════════ FOOTER ══════════════════════════════════════ -->
<footer>
  <div class="sep-line"></div>
  <div class="footer-title">Rizky &amp; Zahra</div>
  <div class="divider-ornament">✦</div>
  <p style="font-size:15px;opacity:.75;font-style:italic;margin-top:0;" id="tpl-quote">
    "Dan di antara tanda-tanda (kebesaran)-Nya ialah Dia menciptakan pasangan-pasangan untukmu dari jenismu sendiri, agar kamu cenderung dan merasa tenteram kepadanya."<br>
    <span style="font-size:12px;opacity:.6">— Q.S. Ar-Rum: 21</span>
  </p>
  <p>Dibuat dengan cinta · © 2025 Keluarga Darmawan &amp; Ridwan</p>
</footer>

<!-- Music button (cosmetic) -->
<button class="music-btn" id="music-btn" title="Musik">♪</button>

<script>
  // ── Countdown ──
  const weddingDate = new Date('2025-06-14T08:00:00');
  
  function updateCountdown() {
    const now = new Date();
    const diff = weddingDate - now;
    if (diff <= 0) {
      document.getElementById('cd-days').textContent = '00';
      document.getElementById('cd-hours').textContent = '00';
      document.getElementById('cd-mins').textContent = '00';
      document.getElementById('cd-secs').textContent = '00';
      return;
    }
    const d = Math.floor(diff / 86400000);
    const h = Math.floor((diff % 86400000) / 3600000);
    const m = Math.floor((diff % 3600000) / 60000);
    const s = Math.floor((diff % 60000) / 1000);
    document.getElementById('cd-days').textContent  = String(d).padStart(2,'0');
    document.getElementById('cd-hours').textContent = String(h).padStart(2,'0');
    document.getElementById('cd-mins').textContent  = String(m).padStart(2,'0');
    document.getElementById('cd-secs').textContent  = String(s).padStart(2,'0');
  }
  updateCountdown();
  setInterval(updateCountdown, 1000);

  // ── Scroll reveal ──
  const reveals = document.querySelectorAll('.reveal');
  const io = new IntersectionObserver(entries => {
    entries.forEach(e => { if (e.isIntersecting) e.target.classList.add('visible'); });
  }, { threshold: .12 });
  reveals.forEach(el => io.observe(el));

  // ── RSVP submit ──
  function submitRSVP() {
    const name    = document.getElementById('rsvp-name').value.trim();
    const attend  = document.getElementById('rsvp-attend').value;
    const message = document.getElementById('rsvp-message').value.trim();

    if (!name || !attend) {
      alert('Mohon isi nama dan konfirmasi kehadiran Anda terlebih dahulu.');
      return;
    }

    // Append to wishes list
    if (message) {
      const card = document.createElement('div');
      card.className = 'wish-card';
      card.innerHTML = `<div class="wish-author">${name}</div><div class="wish-text">${message}</div>`;
      document.getElementById('wishes-list').prepend(card);
    }

    alert(`Terima kasih, ${name}! ${attend === 'hadir' ? 'Kami sangat menantikan kehadiran Anda 🎉' : 'Kami menghargai kabar Anda. Doa terbaik dari kami 🤍'}`);

    document.getElementById('rsvp-name').value    = '';
    document.getElementById('rsvp-attend').value  = '';
    document.getElementById('rsvp-guests').value  = '';
    document.getElementById('rsvp-message').value = '';
  }

  // ── Gallery lightbox ──
  const galleryData = [
    { emoji: '💑', caption: 'Pertunangan – Desember 2024' },
    { emoji: '💐', caption: 'Seserahan' },
    { emoji: '🌸', caption: 'Prewedding di Kebun' },
    { emoji: '🕌', caption: 'Lokasi Akad Nikah' },
    { emoji: '🌅', caption: 'Golden Hour Bandung' },
    { emoji: '🎊', caption: 'Henna Night – Keluarga Besar' },
    { emoji: '💍', caption: 'Cincin Pernikahan' },
  ];
  let lbIndex = 0;

  function openLightbox(idx) {
    lbIndex = idx;
    renderLightbox();
    document.getElementById('lightbox').classList.add('open');
    document.body.style.overflow = 'hidden';
  }
  function closeLightbox() {
    document.getElementById('lightbox').classList.remove('open');
    document.body.style.overflow = '';
  }
  function renderLightbox() {
    const d = galleryData[lbIndex];
    document.getElementById('lb-img').textContent = d.emoji;
    document.getElementById('lb-caption').textContent = d.caption;
  }

  document.querySelectorAll('.g-item').forEach(el => {
    el.addEventListener('click', () => openLightbox(+el.dataset.index));
  });
  document.getElementById('lb-close').addEventListener('click', closeLightbox);
  document.getElementById('lb-prev').addEventListener('click', () => {
    lbIndex = (lbIndex - 1 + galleryData.length) % galleryData.length;
    renderLightbox();
  });
  document.getElementById('lb-next').addEventListener('click', () => {
    lbIndex = (lbIndex + 1) % galleryData.length;
    renderLightbox();
  });
  document.getElementById('lightbox').addEventListener('click', e => {
    if (e.target === document.getElementById('lightbox')) closeLightbox();
  });
  document.addEventListener('keydown', e => {
    if (!document.getElementById('lightbox').classList.contains('open')) return;
    if (e.key === 'Escape') closeLightbox();
    if (e.key === 'ArrowLeft') { lbIndex = (lbIndex - 1 + galleryData.length) % galleryData.length; renderLightbox(); }
    if (e.key === 'ArrowRight') { lbIndex = (lbIndex + 1) % galleryData.length; renderLightbox(); }
  });

  // ── Music toggle (cosmetic) ──
  let playing = false;
  document.getElementById('music-btn').addEventListener('click', function() {
    playing = !playing;
    this.textContent = playing ? '♬' : '♪';
    this.style.color = playing ? '#e8cc99' : '';
  });
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
