<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?=$groom_nickname ?? 'Grooms'?> & <?=$bride_nickname ?? 'Brides'?> — Wedding Invitation</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;1,300;1,400&family=Tenor+Sans&family=EB+Garamond:ital,wght@0,400;1,400&display=swap" rel="stylesheet">
<style>
*, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }

:root {
  --cream: #f5f0e8;
  --warm-white: #faf8f4;
  --dark: #1a1612;
  --brown: #3d2e1e;
  --muted: rgba(245,240,232,0.65);
  --font-display: 'Cormorant Garamond', Georgia, serif;
  --font-sans: 'Tenor Sans', sans-serif;
  --font-body: 'EB Garamond', Georgia, serif;
}

html, body {
  height: 100%;
  overflow: hidden;
  background: #1a1612;
  color: var(--cream);
}

/* ===================== COVER ===================== */
#cover {
  position: fixed;
  inset: 0;
  z-index: 200;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  background: #1a1612;
  transition: opacity 0.9s ease, visibility 0.9s ease;
}

#cover.hidden {
  opacity: 0;
  visibility: hidden;
  pointer-events: none;
}

.cover-bg {
  position: absolute;
  inset: 0;
  background: url('https://images.unsplash.com/photo-1606216794074-735e91aa2c92?w=1400&q=80') center/cover no-repeat;
  opacity: 0.55;
}

.cover-overlay {
  position: absolute;
  inset: 0;
  background: radial-gradient(ellipse at center, rgba(26,22,18,0.3) 0%, rgba(26,22,18,0.72) 100%);
}

.cover-content {
  position: relative;
  z-index: 2;
  display: flex;
  flex-direction: column;
  align-items: center;
  text-align: center;
  animation: coverFadeIn 1.4s ease forwards;
}

@keyframes coverFadeIn {
  from { opacity: 0; transform: translateY(20px); }
  to { opacity: 1; transform: translateY(0); }
}

.cover-tag {
  font-family: var(--font-sans);
  font-size: 0.65rem;
  letter-spacing: 0.3em;
  text-transform: uppercase;
  color: var(--muted);
  margin-bottom: 1.25rem;
}

.cover-names {
  font-family: var(--font-display);
  font-size: clamp(4rem, 10vw, 7.5rem);
  font-weight: 300;
  line-height: 0.92;
  color: var(--warm-white);
  letter-spacing: -0.01em;
  position:relative;
}

.cover-names .amp {
  font-size: 1.2em;
  font-style: italic;
  color: rgba(245,240,232,0.7);
  display: inline-block;
  margin-left: 0.08em;
  position:absolute;
  left:50%;
  top:50%;
  transform:translate(-50%,-50%);
  opacity:0.5
}

.cover-date {
  font-family: var(--font-sans);
  font-size: 0.7rem;
  letter-spacing: 0.22em;
  color: var(--muted);
  margin-top: 1.5rem;
  text-transform: uppercase;
}

.cover-guest {
  margin-top: 3.5rem;
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 0.3rem;
}

.cover-guest .dear {
  font-family: var(--font-body);
  font-style: italic;
  font-size: 1rem;
  color: var(--muted);
}

.cover-guest .guest-name {
  font-family: var(--font-display);
  font-size: 1.6rem;
  font-weight: 600;
  color: var(--warm-white);
  letter-spacing: 0.04em;
}

.cover-guest .apologize {
  font-family: var(--font-body);
  font-style: italic;
  font-size: 0.75rem;
  color: rgba(245,240,232,0.4);
  margin-top: 0.15rem;
}

.btn-open {
  margin-top: 2.25rem;
  display: flex;
  align-items: center;
  gap: 0.6rem;
  padding: 0.8rem 2.25rem;
  background: rgba(245,240,232,0.1);
  border: 1px solid rgba(245,240,232,0.35);
  color: var(--warm-white);
  font-family: var(--font-sans);
  font-size: 0.7rem;
  letter-spacing: 0.2em;
  text-transform: uppercase;
  cursor: pointer;
  transition: background 0.3s, border-color 0.3s;
  backdrop-filter: blur(8px);
}

.btn-open:hover {
  background: rgba(245,240,232,0.18);
  border-color: rgba(245,240,232,0.6);
}

.btn-open svg {
  width: 14px;
  height: 14px;
  opacity: 0.8;
}

/* ===================== MAIN ===================== */
#main {
  position: fixed;
  inset: 0;
  display: flex;
  opacity: 0;
  visibility: hidden;
  transition: opacity 0.9s ease 0.2s, visibility 0.9s ease 0.2s;
  overflow: hidden;
}

#main.visible {
  opacity: 1;
  visibility: visible;
}

/* LEFT — desktop only, full photo */
.main-left {
  flex: 1;
  position: relative;
  overflow: hidden;
  display: none;
}

@media (min-width: 768px) {
  .main-left { display: block; }
}

.main-left-bg {
  position: absolute;
  inset: 0;
  background: url('https://images.unsplash.com/photo-1606216794074-735e91aa2c92?w=1400&q=80') center/cover no-repeat;
  transition: transform 12s ease;
}

.main-left-bg:hover { transform: scale(1.03); }

.main-left-overlay {
  position: absolute;
  inset: 0;
  background: linear-gradient(to right, rgba(26,22,18,0.2) 0%, rgba(26,22,18,0.5) 100%);
}

.main-left-content {
  position: absolute;
  bottom: 2.75rem;
  left: 2.75rem;
  z-index: 2;
}

.left-tag {
  font-family: var(--font-sans);
  font-size: 0.6rem;
  letter-spacing: 0.28em;
  text-transform: uppercase;
  color: rgba(245,240,232,0.6);
  margin-bottom: 0.6rem;
}

.left-names {
  font-family: var(--font-display);
  font-size: clamp(2.5rem, 4vw, 4.5rem);
  font-weight: 300;
  line-height: 0.92;
  color: var(--warm-white);
  position:relative;
}

.left-names .amp {
  display: block;
  font-style: italic;
  font-size: 0.65em;
  color: rgba(245,240,232,0.6);
  margin-top: 0.1em;
  position:absolute;
  left:50%;
  top:50%;
  transform:translate(-50%,-50%);
  opacity:0.5;
}

/* Hamburger top right desktop */
.main-menu {
  position: absolute;
  top: 2rem;
  right: 2rem;
  z-index: 50;
  display: none;
  flex-direction: column;
  gap: 5px;
  cursor: pointer;
  padding: 6px;
}

@media (min-width: 768px) { .main-menu { display: flex; } }

.main-menu span {
  display: block;
  width: 22px;
  height: 1px;
  background: var(--muted);
}

/* RIGHT — mobile panel */
.main-right {
  width: 100%;
  max-width: 420px;
  height: 100vh;
  background: #1e1a16;
  overflow-y: scroll;
  scroll-snap-type: y mandatory;
  position: relative;
  flex-shrink: 0;
}

/* On mobile, take full width */
@media (max-width: 767px) {
  .main-right {
    max-width: 100%;
    width: 100%;
  }
}

/* SCROLL label — desktop only */
.scroll-label {
  position: absolute;
  bottom: 4rem;
  right: 2.5rem;
  z-index: 10;
  display: none;
  writing-mode: vertical-rl;
  font-family: var(--font-sans);
  font-size: 0.6rem;
  letter-spacing: 0.22em;
  text-transform: uppercase;
  color: rgba(245,240,232,0.4);
  align-items: center;
  gap: 1rem;
}

.scroll-label::after {
  content: '';
  display: block;
  width: 1px;
  height: 48px;
  background: rgba(245,240,232,0.3);
}

@media (min-width: 768px) { .scroll-label { display: flex; } }

/* ===================== MOBILE SECTIONS ===================== */
.m-section {
  scroll-snap-align: start;
  scroll-snap-stop: always;
  height: 100vh;
  width: 100%;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  position: relative;
  overflow: hidden;
  padding: 2.5rem 2rem;
}

/* Section M1 — Cover repeat in mobile panel */
.ms1 {
  background: #1e1a16;
  text-align: center;
  gap: 0.25rem;
}

.ms1-bg {
  position: absolute;
  inset: 0;
  background: url('https://images.unsplash.com/photo-1606216794074-735e91aa2c92?w=600&q=75') center/cover no-repeat;
  opacity: 0.35;
}

.ms1-overlay {
  position: absolute;
  inset: 0;
  background: linear-gradient(to bottom, rgba(30,26,22,0.4) 0%, rgba(30,26,22,0.8) 100%);
}

.m-tag {
  font-family: var(--font-sans);
  font-size: 0.6rem;
  letter-spacing: 0.25em;
  text-transform: uppercase;
  color: rgba(245,240,232,0.55);
  position: relative;
  z-index: 2;
}

.m-names-big {
  font-family: var(--font-display);
  font-size: clamp(3rem, 14vw, 4.5rem);
  font-weight: 300;
  line-height: 0.92;
  color: var(--warm-white);
  position: relative;
  z-index: 2;
  margin-top: 0.5rem;
}

.m-names-big .amp {
  font-style: italic;
  color: rgba(245,240,232,0.55);
  font-size: 1.2em;
  position:absolute;
  left:50%;
  top:50%;
  transform:translate(-50%,-50%);
  opacity:0.5;
}

.m-date {
  font-family: var(--font-sans);
  font-size: 0.62rem;
  letter-spacing: 0.22em;
  text-transform: uppercase;
  color: rgba(245,240,232,0.5);
  position: relative;
  z-index: 2;
  margin-top: 1.25rem;
}

.scroll-down-hint {
  position: absolute;
  bottom: 2rem;
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 6px;
  opacity: 0.35;
  z-index: 2;
}

.scroll-down-hint span {
  font-family: var(--font-sans);
  font-size: 0.55rem;
  letter-spacing: 0.2em;
  text-transform: uppercase;
  color: var(--cream);
}

.scroll-down-hint::after {
  content: '';
  display: block;
  width: 1px;
  height: 36px;
  background: var(--cream);
  animation: lineDown 1.8s infinite;
}

@keyframes lineDown {
  0% { transform: scaleY(0); transform-origin: top; }
  50% { transform: scaleY(1); transform-origin: top; }
  51% { transform: scaleY(1); transform-origin: bottom; }
  100% { transform: scaleY(0); transform-origin: bottom; }
}

/* Section M2 — The Couple */
.ms2 {
  background: #211d19;
  gap: 2rem;
  text-align: center;
}

.ornament {
  font-size: 1.4rem;
  opacity: 0.35;
  letter-spacing: 0.3em;
}

.section-eyebrow {
  font-family: var(--font-sans);
  font-size: 0.6rem;
  letter-spacing: 0.28em;
  text-transform: uppercase;
  color: rgba(245,240,232,0.45);
}

.event-name {
  font-family: var(--font-sans);
  font-size: 1rem;
  letter-spacing: 0.28em;
  text-transform: uppercase;
  color: rgba(245,240,232,0.45);
}

.couple-block {
  display: flex;
  flex-direction: column;
  gap: 2rem;
  width: 100%;
}

.person {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 0.3rem;
}

.person-name {
  font-family: var(--font-display);
  font-size: 2rem;
  font-weight: 300;
  color: var(--warm-white);
  letter-spacing: 0.02em;
}

.person-full {
  font-family: var(--font-body);
  font-style: italic;
  font-size: 0.9rem;
  color: rgba(245,240,232,0.5);
}

.person-parents {
  font-family: var(--font-sans);
  font-size: 0.62rem;
  letter-spacing: 0.08em;
  color: rgba(245,240,232,0.4);
  text-align: center;
  line-height: 1.8;
}

.divider-amp {
  font-family: var(--font-display);
  font-size: 2.5rem;
  font-style: italic;
  font-weight: 300;
  color: rgba(245,240,232,0.2);
  line-height: 1;
}

/* Section M3 — Date & Time */
.ms3 {
  background: #1a1612;
  gap: 1.5rem;
  text-align: center;
}

.date-big {
  font-family: var(--font-display);
  font-size: clamp(3rem, 16vw, 5rem);
  font-weight: 300;
  color: var(--warm-white);
  line-height: 0.9;
}

.date-big .day-num {
  display: block;
  font-size: 1.3em;
  font-weight: 600;
}

.time-row {
  display: flex;
  align-items: center;
  gap: 1.5rem;
  justify-content: center;
}

.time-block {
  text-align: center;
}

.time-val {
  font-family: var(--font-display);
  font-size: 1.6rem;
  font-weight: 300;
  color: var(--warm-white);
}

.time-lbl {
  font-family: var(--font-sans);
  font-size: 0.55rem;
  letter-spacing: 0.2em;
  text-transform: uppercase;
  color: rgba(245,240,232,0.4);
  margin-top: 0.2rem;
}

.time-sep {
  width: 1px;
  height: 40px;
  background: rgba(245,240,232,0.15);
}

.location-block {
  border-top: 1px solid rgba(245,240,232,0.1);
  padding-top: 1.5rem;
  width: 100%;
}

.location-name {
  font-family: var(--font-display);
  font-size: 1.3rem;
  font-weight: 400;
  color: var(--warm-white);
  margin-bottom: 0.4rem;
}

.location-addr {
  font-family: var(--font-body);
  font-style: italic;
  font-size: 0.82rem;
  color: rgba(245,240,232,0.45);
  line-height: 1.6;
}

/* Section M4 — Countdown */
.ms4 {
  background: #211d19;
  gap: 1.75rem;
  text-align: center;
}

.countdown-grid {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 0.75rem;
  width: 100%;
}

.cd-box {
  background: rgba(245,240,232,0.04);
  border: 1px solid rgba(245,240,232,0.08);
  padding: 1.25rem 0.5rem;
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 0.4rem;
}

.cd-num {
  font-family: var(--font-display);
  font-size: 2.2rem;
  font-weight: 300;
  color: var(--warm-white);
  line-height: 1;
  min-width: 2ch;
}

.cd-lbl {
  font-family: var(--font-sans);
  font-size: 0.52rem;
  letter-spacing: 0.15em;
  text-transform: uppercase;
  color: rgba(245,240,232,0.35);
}

.ms4-verse {
  font-family: var(--font-body);
  font-style: italic;
  font-size: 0.85rem;
  color: rgba(245,240,232,0.4);
  line-height: 1.8;
  max-width: 280px;
  text-align: center;
}

/* Section M5 — Gallery peek */
/* Section M5 — Gallery */
.ms5 {
  background: #1a1612;
  gap: 1.25rem;
  padding: 2rem 0 2rem 0;
  overflow: hidden;
}

.gallery-slider-wrap {
  width: 100%;
  overflow: hidden;
  position: relative;
  flex: 1;
  max-height: 58vh;
  touch-action: pan-y; /* biarkan scroll vertikal, horizontal kita handle manual */
}

.gallery-slider-wrap.dragging { cursor: grabbing; }

.gallery-slider-track {
  display: flex;
  height: 100%;
  /* HAPUS transition di sini — diatur via JS saat snap */
}

.gallery-page {
  flex: 0 0 100%;
  width: 100%;
  height: 100%;
  display: grid;
  grid-template-columns: 1fr 1fr;
  grid-template-rows: 1fr 1fr;
  gap: 6px;
  padding: 0 1.5rem;
  box-sizing: border-box;
}

.gallery-page img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  filter: grayscale(15%) brightness(0.82);
  transition: filter 0.4s;
  display: block;
}

.gallery-page img:hover { filter: grayscale(0%) brightness(1); }

/* Lightbox */
.gallery-lightbox {
  position: fixed;
  inset: 0;
  z-index: 999;
  background: rgba(15,12,9,0.96);
  display: flex;
  align-items: center;
  justify-content: center;
  opacity: 0;
  visibility: hidden;
  transition: opacity 0.35s ease, visibility 0.35s ease;
}

.gallery-lightbox.open {
  opacity: 1;
  visibility: visible;
}

.gallery-lightbox img {
  max-width: 92vw;
  max-height: 88vh;
  object-fit: contain;
  display: block;
}

.lightbox-close {
  position: absolute;
  top: 1.25rem;
  right: 1.5rem;
  background: none;
  border: none;
  color: rgba(245,240,232,0.6);
  font-size: 1.8rem;
  cursor: pointer;
  line-height: 1;
  font-family: var(--font-sans);
  transition: color 0.2s;
}

.lightbox-close:hover { color: var(--cream); }

.lightbox-nav {
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
  background: rgba(245,240,232,0.08);
  border: 1px solid rgba(245,240,232,0.15);
  color: rgba(245,240,232,0.6);
  font-size: 1.2rem;
  width: 2.5rem;
  height: 2.5rem;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  transition: background 0.2s, color 0.2s;
}

.lightbox-nav:hover { background: rgba(245,240,232,0.15); color: var(--cream); }
.lightbox-nav.prev { left: 1rem; }
.lightbox-nav.next { right: 1rem; }

/* Dots indicator */
.gallery-dots {
  display: flex;
  gap: 6px;
  justify-content: center;
  align-items: center;
}

.gallery-dot {
  width: 5px;
  height: 5px;
  border-radius: 50%;
  background: rgba(245,240,232,0.2);
  transition: background 0.3s, transform 0.3s;
  cursor: pointer;
}

.gallery-dot.active {
  background: rgba(245,240,232,0.7);
  transform: scale(1.3);
}

/* Section M6 — RSVP */
.ms6 {
  background: #211d19;
  gap: 1.75rem;
  text-align: center;
}

.rsvp-form {
  display: flex;
  flex-direction: column;
  gap: 0.85rem;
  width: 100%;
}

.rsvp-input {
  background: rgba(245,240,232,0.05);
  border: 1px solid rgba(245,240,232,0.12);
  padding: 0.85rem 1rem;
  color: var(--cream);
  font-family: var(--font-body);
  font-size: 0.9rem;
  font-style: italic;
  outline: none;
  width: 100%;
  transition: border-color 0.2s;
}

.rsvp-input::placeholder { color: rgba(245,240,232,0.3); }
.rsvp-input:focus { border-color: rgba(245,240,232,0.35); }

.rsvp-radio-group {
  display: flex;
  gap: 0;
}

.rsvp-radio-btn {
  flex: 1;
  padding: 0.75rem;
  background: rgba(245,240,232,0.04);
  border: 1px solid rgba(245,240,232,0.12);
  color: rgba(245,240,232,0.45);
  font-family: var(--font-sans);
  font-size: 0.62rem;
  letter-spacing: 0.15em;
  text-transform: uppercase;
  cursor: pointer;
  transition: all 0.2s;
  text-align: center;
}

.rsvp-radio-btn:first-child { border-right: none; }

.rsvp-radio-btn.active,
.rsvp-radio-btn:hover {
  background: rgba(245,240,232,0.1);
  color: var(--cream);
  border-color: rgba(245,240,232,0.3);
}

.btn-rsvp {
  padding: 0.9rem;
  background: rgba(245,240,232,0.08);
  border: 1px solid rgba(245,240,232,0.25);
  color: var(--cream);
  font-family: var(--font-sans);
  font-size: 0.65rem;
  letter-spacing: 0.22em;
  text-transform: uppercase;
  cursor: pointer;
  transition: background 0.3s;
  margin-top: 0.25rem;
}

.btn-rsvp:hover { background: rgba(245,240,232,0.15); }

/* ===== WISHES SECTION ===== */
.wishes-pager {
  width: 100%;
  display: flex;
  flex-direction: column;
  gap: 0.65rem;
  flex: 1;
}

.wish-card {
  background: rgba(245,240,232,0.04);
  border: 1px solid rgba(245,240,232,0.08);
  padding: 0.8rem 1rem;
  display: flex;
  flex-direction: column;
  gap: 0.28rem;
  transition: background 0.2s;
}

.wish-card:hover { background: rgba(245,240,232,0.07); }

.wish-name {
  font-family: var(--font-sans);
  font-size: 0.62rem;
  letter-spacing: 0.15em;
  text-transform: uppercase;
  color: rgba(245,240,232,0.6);
  display: flex;
  align-items: center;
  gap: 0.5rem;
}

.wish-name::before {
  content: '';
  display: inline-block;
  width: 14px;
  height: 1px;
  background: rgba(245,240,232,0.25);
  flex-shrink: 0;
}

.wish-text {
  font-family: var(--font-body);
  font-style: italic;
  font-size: 0.86rem;
  color: rgba(245,240,232,0.5);
  line-height: 1.6;
  padding-left: 1.4rem;
}

.wish-badge {
  font-family: var(--font-sans);
  font-size: 0.52rem;
  letter-spacing: 0.1em;
  text-transform: uppercase;
  padding: 0.18rem 0.45rem;
  flex-shrink: 0;
}

.wish-badge.hadir  { background: rgba(29,158,117,0.15); color: rgba(91,210,163,0.85); }
.wish-badge.tidak  { background: rgba(216,90,48,0.12);  color: rgba(240,153,123,0.75); }

.pager-nav {
  display: flex;
  align-items: center;
  justify-content: space-between;
  width: 100%;
  margin-top: 0.5rem;
}

.pager-dots { display: flex; gap: 6px; align-items: center; }

.pager-dot {
  width: 5px; height: 5px;
  border-radius: 50%;
  background: rgba(245,240,232,0.2);
  border: none; padding: 0; cursor: pointer;
  transition: background 0.3s, transform 0.3s;
}

.pager-dot.active {
  background: rgba(245,240,232,0.7);
  transform: scale(1.3);
}

.pager-btn {
  background: rgba(245,240,232,0.05);
  border: 1px solid rgba(245,240,232,0.12);
  color: rgba(245,240,232,0.45);
  font-family: var(--font-sans);
  font-size: 0.58rem;
  letter-spacing: 0.15em;
  text-transform: uppercase;
  padding: 0.5rem 0.9rem;
  cursor: pointer;
  transition: all 0.2s;
}

.pager-btn:hover:not(:disabled)

/* ===== GIFT SECTION ===== */
.gift-content {
  width: 100%;
  display: flex;
  flex-direction: column;
  gap: 1.25rem;
  overflow-y: auto;
  max-height: calc(100vh - 14rem);
}

.gift-content::-webkit-scrollbar { display: none; }
.gift-content { -ms-overflow-style: none; scrollbar-width: none; }

.gift-block {
  display: flex;
  flex-direction: column;
  gap: 0.6rem;
}

.gift-label {
  font-family: var(--font-sans);
  font-size: 0.55rem;
  letter-spacing: 0.25em;
  text-transform: uppercase;
  color: rgba(245,240,232,0.3);
  margin-bottom: 0.1rem;
}

.gift-card {
  background: rgba(245,240,232,0.04);
  border: 1px solid rgba(245,240,232,0.08);
  padding: 0.85rem 1rem;
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 0.75rem;
  transition: background 0.2s;
}

.gift-card:hover { background: rgba(245,240,232,0.07); }

.gift-card--address { align-items: flex-start; }

.gift-card-left {
  display: flex;
  flex-direction: column;
  gap: 0.18rem;
  flex: 1;
  min-width: 0;
}

.gift-bank {
  font-family: var(--font-sans);
  font-size: 0.6rem;
  letter-spacing: 0.2em;
  text-transform: uppercase;
  color: rgba(245,240,232,0.5);
}

.gift-accname {
  font-family: var(--font-body);
  font-style: italic;
  font-size: 0.85rem;
  color: rgba(245,240,232,0.6);
}

.gift-accnum {
  font-family: var(--font-display);
  font-size: 1.2rem;
  font-weight: 400;
  color: var(--warm-white);
  letter-spacing: 0.06em;
}

.gift-address-text {
  font-style: italic;
  font-size: 0.8rem;
  line-height: 1.6;
  color: rgba(245,240,232,0.5);
}

.gift-card-actions {
  display: flex;
  flex-direction: column;
  gap: 0.4rem;
  flex-shrink: 0;
}

.gift-copy-btn,
.gift-maps-btn {
  display: flex;
  align-items: center;
  gap: 0.35rem;
  padding: 0.45rem 0.75rem;
  background: rgba(245,240,232,0.05);
  border: 1px solid rgba(245,240,232,0.12);
  color: rgba(245,240,232,0.5);
  font-family: var(--font-sans);
  font-size: 0.55rem;
  letter-spacing: 0.12em;
  text-transform: uppercase;
  cursor: pointer;
  transition: all 0.2s;
  text-decoration: none;
  white-space: nowrap;
  flex-shrink: 0;
}

.gift-copy-btn:hover,
.gift-maps-btn:hover {
  background: rgba(245,240,232,0.12);
  color: var(--cream);
  border-color: rgba(245,240,232,0.25);
}

.gift-copy-btn.copied {
  background: rgba(29,158,117,0.15);
  border-color: rgba(91,210,163,0.3);
  color: rgba(91,210,163,0.85);
}

.gift-maps-btn {
  background: rgba(245,240,232,0.05);
}

.gift-divider {
  margin: 20px 0;
  width: 100%;
  height: 1px;
  background: rgba(245,240,232,0.08);
}

/* Section M7 — Thank You */
.ms7 {
  background: #1a1612;
  text-align: center;
  gap: 1.25rem;
}

.ms7-bg {
  position: absolute;
  inset: 0;
  background: url('https://images.unsplash.com/photo-1606216794074-735e91aa2c92?w=600&q=60') center/cover no-repeat;
  opacity: 0.18;
}

.ms7-overlay {
  position: absolute;
  inset: 0;
  background: linear-gradient(to top, rgba(26,22,18,0.9) 0%, rgba(26,22,18,0.5) 100%);
}

.thankyou-big {
  font-family: var(--font-display);
  font-size: clamp(2.8rem, 13vw, 4.5rem);
  font-weight: 300;
  font-style: italic;
  color: var(--warm-white);
  line-height: 1;
  position: relative;
  text-align: center;
  z-index: 2;
}

.thankyou-sub {
  font-family: var(--font-body);
  font-style: italic;
  font-size: 0.85rem;
  color: rgba(245,240,232,0.45);
  line-height: 1.9;
  max-width: 280px;
  position: relative;
  z-index: 2;
}

.love-sig {
  font-family: var(--font-display);
  font-size: 1.6rem;
  font-weight: 300;
  font-style: italic;
  color: rgba(245,240,232,0.5);
  position: relative;
  z-index: 2;
  margin-top: 0.5rem;
}

/* Scrollbar hide */
.main-right::-webkit-scrollbar { display: none; }
.main-right { -ms-overflow-style: none; scrollbar-width: none; }

/* Section title shared */
.m-section-title {
  font-family: var(--font-display);
  font-size: clamp(2rem, 9vw, 2.8rem);
  font-weight: 300;
  color: var(--warm-white);
  letter-spacing: -0.01em;
}

.m-section-title em {
  font-style: italic;
  font-weight: 400;
}

/* ===================== ANIMATIONS ===================== */

/* --- Keyframes --- */
@keyframes fadeRise {
  from { opacity: 0; transform: translateY(22px); }
  to   { opacity: 1; transform: translateY(0); }
}

@keyframes fadeRiseSlow {
  from { opacity: 0; transform: translateY(14px); }
  to   { opacity: 1; transform: translateY(0); }
}

@keyframes wordReveal {
  from { opacity: 0; transform: translateY(30px) skewY(2deg); clip-path: inset(0 0 100% 0); }
  to   { opacity: 1; transform: translateY(0) skewY(0deg);   clip-path: inset(0 0 0% 0); }
}

@keyframes lineGrow {
  from { transform: scaleX(0); }
  to   { transform: scaleX(1); }
}

@keyframes lineGrowV {
  from { transform: scaleY(0); }
  to   { transform: scaleY(1); }
}

@keyframes shimmer {
  0%   { opacity: 0.2; letter-spacing: 0.15em; }
  50%  { opacity: 0.7; letter-spacing: 0.35em; }
  100% { opacity: 0.35; letter-spacing: 0.3em; }
}

@keyframes coverTagReveal {
  from { opacity: 0; letter-spacing: 0.55em; }
  to   { opacity: 1; letter-spacing: 0.3em; }
}

/* --- Animated elements default state (hidden, pre-animation) --- */
.anim-el {
  opacity: 0;
}

/* --- Active state — played when .section-active is on parent .m-section --- */
.section-active .anim-fade {
  animation: fadeRise 0.85s cubic-bezier(0.22,1,0.36,1) forwards;
}

.section-active .anim-fade-slow {
  animation: fadeRiseSlow 1.1s cubic-bezier(0.22,1,0.36,1) forwards;
}

.section-active .anim-word {
  animation: wordReveal 0.9s cubic-bezier(0.22,1,0.36,1) forwards;
}

.section-active .anim-line-h {
  animation: lineGrow 1s cubic-bezier(0.22,1,0.36,1) forwards;
  transform-origin: left center;
}

.section-active .anim-line-v {
  animation: lineGrowV 0.9s cubic-bezier(0.22,1,0.36,1) forwards;
  transform-origin: top center;
}

.section-active .anim-shimmer {
  animation: shimmer 2.2s ease forwards;
}

/* Stagger helpers */
.d0  { animation-delay: 0ms !important; }
.d1  { animation-delay: 120ms !important; }
.d2  { animation-delay: 240ms !important; }
.d3  { animation-delay: 380ms !important; }
.d4  { animation-delay: 520ms !important; }
.d5  { animation-delay: 680ms !important; }
.d6  { animation-delay: 850ms !important; }
.d7  { animation-delay: 1050ms !important; }
.d8  { animation-delay: 1280ms !important; }

/* Cover stagger (plays immediately on load) */
.cover-tag    { opacity:0; animation: coverTagReveal 1.1s ease 0.3s forwards; }
.cover-names  { opacity:0; animation: wordReveal 1.1s cubic-bezier(0.22,1,0.36,1) 0.65s forwards; }
.cover-date   { opacity:0; animation: fadeRise 0.9s ease 1.1s forwards; }
.cover-guest  { opacity:0; animation: fadeRise 0.9s ease 1.45s forwards; }
.btn-open     { opacity:0; animation: fadeRise 0.9s ease 1.8s forwards; }

/* Decorative horizontal rule used in sections */
.deco-line {
  display: block;
  width: 48px;
  height: 1px;
  background: rgba(245,240,232,0.25);
  transform: scaleX(0);
  transform-origin: left;
}

/* Word-split wrapper */
.word-wrap {
  display: inline-block;
  overflow: hidden;
  vertical-align: bottom;
  padding-bottom: 0.06em;
}

</style>
</head>
<body>

<!-- ============ COVER ============ -->
<div id="cover">
  <div class="cover-bg"></div>
  <div class="cover-overlay"></div>
  <div class="cover-content">
    <p class="cover-tag">The Wedding of</p>
    <h1 class="cover-names">
      <?=$bride_nickname ?? 'Brides'?><br><?=$groom_nickname ?? 'Grooms'?><span class="amp">&amp;</span>
    </h1>
    <p class="cover-date">
        <?= $acara_utama['hari'] ?? 'Saturday' ?>, 
        <?= isset($acara_utama['tanggal']) && $acara_utama['tanggal'] ? date('d/m/Y', strtotime($acara_utama['tanggal'])) : '11/04/2026' ?>
    </p>
    <div class="cover-guest">
      <span class="dear">Dear,</span>
      <span class="guest-name"><?=$nama_tamu ?? 'Guest'?></span>
      <span class="apologize">We apologize if there is any misspelling of name or title.</span>
    </div>
    <button class="btn-open" onclick="openInvitation()">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
        <path d="M3 8l9 6 9-6M3 8v10a1 1 0 001 1h16a1 1 0 001-1V8M3 8a1 1 0 011-1h16a1 1 0 011 1"/>
      </svg>
      Open Invitation
    </button>
  </div>
</div>

<!-- ============ MAIN ============ -->
<div id="main">

  <!-- Left panel: full photo, desktop only -->
  <div class="main-left">
    <div class="main-left-bg"></div>
    <div class="main-left-overlay"></div>
    <div class="main-left-content">
      <p class="left-tag">The Wedding of</p>
      <h2 class="left-names">
        <?=$bride_nickname ?? 'Brides'?><br>
        <span class="amp">&amp;</span>
        <?=$groom_nickname ?? 'Grooms'?>
      </h2>
    </div>
  </div>

  <!-- Hamburger menu (desktop) -->
  <div class="main-menu" aria-label="Menu">
    <span></span><span></span>
  </div>

  <!-- Scroll label -->
  <div class="scroll-label">Scroll</div>

  <!-- Right panel: mobile scrollable -->
  <div class="main-right" id="mobilePanel">

    <!-- M1: Hero -->
    <div class="m-section ms1">
      <div class="ms1-bg"></div>
      <div class="ms1-overlay"></div>
      <p class="m-tag anim-el anim-fade d0" style="position:relative;z-index:2;">The Wedding of</p>
      <h2 class="m-names-big anim-el anim-word d1">
        <?=$bride_nickname ?? 'Brides'?><br><?=$groom_nickname ?? 'Grooms'?><span class="amp">&amp;</span>
      </h2>
      <p class="m-date anim-el anim-word d2">
          <?= $acara_utama['hari'] ?? 'Saturday' ?>, 
          <?= isset($acara_utama['tanggal']) && $acara_utama['tanggal'] ? date('d/m/Y', strtotime($acara_utama['tanggal'])) : '11/04/2026' ?>
      </p>
      <div class="scroll-down-hint anim-el anim-fade d5">
        <span>Scroll</span>
      </div>
    </div>

    <!-- M2: The Couple -->
    <div class="m-section ms2">
      <p class="section-eyebrow anim-el anim-fade d0">The Couple</p>
      <div class="couple-block">
        <div class="person">
          <div class="person-name anim-el anim-word d1"><?=$bride_nickname ?? 'Brides'?></div>
          <div class="person-full anim-el anim-fade d2"><?=$bride_name ?? 'Zahra Aulia, S.Pd.'?></div>
          <div class="person-parents anim-el anim-fade-slow d3">Putri dari Bapak <?=$bride_father ?? 'H. Ridwan Fauzi'?><br>&amp; Ibu <?=$bride_mother ?? 'Hj. Nurul Hidayah'?></div>
        </div>
        <div class="divider-amp anim-el anim-fade d4">&amp;</div>
        <div class="person">
          <div class="person-name anim-el anim-word d5"><?=$groom_nickname ?? 'Grooms'?></div>
          <div class="person-full anim-el anim-fade d6"><?=$groom_name ?? 'Grooms, S.T.'?></div>
          <div class="person-parents anim-el anim-fade-slow d7">Putra dari Bapak <?=$groom_father ?? 'H. Darmawan'?><br>&amp; Ibu <?=$groom_mother ?? 'Hj. Siti Rahayu'?></div>
        </div>
      </div>
      <div class="ornament anim-el anim-shimmer d8">— ✦ —</div>
    </div>

    
    <?php if(!empty($acara)):?>
    <?php foreach ($acara as $row): ?>
    <!-- M3: Date & Venue -->
    <div class="m-section ms3">
      <p class="section-eyebrow anim-el anim-fade d0">Save the Date</p>
      <div class="date-big anim-el anim-word d1">
        <span class="event-name"><?=$row['nama']?></span>
        <span class="day-num"><?=date('d', strtotime($row['tanggal']))?></span>
        <?=date('M Y', strtotime($row['tanggal']))?>
      </div>
      <div class="time-row anim-el anim-fade d3">
        <div class="time-block">
          <div class="time-val"><?=date('H:i', strtotime($row['mulai']))?> <span class='time-lbl'>s/d</span> <?=date('H:i', strtotime($row['selesai']))?></div>
          <div class="time-lbl">Waktu Acara </div>
        </div>
      </div>
      <div class="location-block anim-el anim-fade-slow d5" style="text-align:center;">
        <div class="location-name"><?=$row['tempat']?></div>
        <div class="location-addr"><?=$row['alamat']?></div>
        <div style="margin-top:1rem;">
          <a href="<?=$row['maps']?>" target="_blank"
            style="font-family:var(--font-sans);font-size:0.6rem;letter-spacing:0.18em;text-transform:uppercase;color:rgba(245,240,232,0.45);text-decoration:none;border-bottom:1px solid rgba(245,240,232,0.2);padding-bottom:2px;">
            Open in Maps →
          </a>
        </div>
      </div>
    </div>
    <?php endforeach; ?>
    <?php else:?>
    <!-- M3: Date & Venue -->
    <div class="m-section ms3">
      <p class="section-eyebrow anim-el anim-fade d0">Save the Date</p>
      <div class="date-big anim-el anim-word d1">
        <span class="event-name">Akad Nikah</span>
        <span class="day-num">11</span>
        April 2026
      </div>
      <div class="time-row anim-el anim-fade d3">
        <div class="time-block">
          <div class="time-val">09.00</div>
          <div class="time-lbl">sampai 11.00</div>
        </div>
      </div>
      <div class="location-block anim-el anim-fade-slow d5" style="text-align:center;">
        <div class="location-name">Gereja Katedral Jakarta</div>
        <div class="location-addr">Jl. Katedral No.7B, Ps. Baru,<br>Kec. Sawah Besar, Jakarta Pusat</div>
        <div style="margin-top:1rem;">
          <a href="https://maps.google.com" target="_blank"
            style="font-family:var(--font-sans);font-size:0.6rem;letter-spacing:0.18em;text-transform:uppercase;color:rgba(245,240,232,0.45);text-decoration:none;border-bottom:1px solid rgba(245,240,232,0.2);padding-bottom:2px;">
            Open in Maps →
          </a>
        </div>
      </div>
    </div>
    <?php endif;?>

    <!-- M4: Countdown -->
    <div class="m-section ms4">
      <p class="section-eyebrow anim-el anim-fade d0">Counting Down</p>
      <h3 class="m-section-title anim-el anim-word d1"><em>Our Day</em></h3>
      <div class="countdown-grid anim-el anim-fade d3" id="countdown">
        <div class="cd-box"><div class="cd-num" id="cd-d">000</div><div class="cd-lbl">Days</div></div>
        <div class="cd-box"><div class="cd-num" id="cd-h">00</div><div class="cd-lbl">Hours</div></div>
        <div class="cd-box"><div class="cd-num" id="cd-m">00</div><div class="cd-lbl">Mins</div></div>
        <div class="cd-box"><div class="cd-num" id="cd-s">00</div><div class="cd-lbl">Secs</div></div>
      </div>
      <p class="ms4-verse anim-el anim-fade-slow d5">"Kasihilah seorang akan yang lain, sebagaimana Aku telah mengasihi kamu."<br><span style="font-size:0.75rem;opacity:0.6;">— Yohanes 15:12</span></p>
    </div>

    <!-- M5: Gallery -->
    <div class="m-section ms5">
      <p class="section-eyebrow anim-el anim-fade d0" style="align-self:flex-start;padding-left:1.5rem;">Our Story</p>
      <h3 class="m-section-title anim-el anim-word d1" style="align-self:flex-start;padding-left:1.5rem;"><em>Gallery</em></h3>
      <div class="gallery-slider-wrap anim-el anim-fade-slow d3" id="gallerySliderWrap">
        <div class="gallery-slider-track" id="galleryTrack">
          <!-- Pages will be built by JS from galleryImages array -->
        </div>
      </div>
      <div class="gallery-dots anim-el anim-fade d5" id="galleryDots"></div>
    </div>

    <!-- Lightbox -->
    <div class="gallery-lightbox" id="galleryLightbox">
      <button class="lightbox-close" id="lightboxClose">×</button>
      <button class="lightbox-nav prev" id="lightboxPrev">‹</button>
      <img src="" alt="" id="lightboxImg">
      <button class="lightbox-nav next" id="lightboxNext">›</button>
    </div>

    <!-- M6: RSVP -->
    <div class="m-section ms6">
      <p class="section-eyebrow anim-el anim-fade d0">Konfirmasi Kehadiran</p>
      <h3 class="m-section-title anim-el anim-word d1"><em>RSVP</em></h3>
      <div class="rsvp-form anim-el anim-fade d3">
        <input class="rsvp-input" type="text" placeholder="Nama lengkap Anda...">
        <input class="rsvp-input" type="number" placeholder="Jumlah tamu (termasuk Anda)...">
        <div class="rsvp-radio-group">
          <div class="rsvp-radio-btn active" onclick="selectAttend(this, 'hadir')">✓ Hadir</div>
          <div class="rsvp-radio-btn" onclick="selectAttend(this, 'tidak')">✗ Tidak Hadir</div>
        </div>
        <textarea class="rsvp-input" rows="2" placeholder="Ucapan &amp; doa untuk kami..." style="resize:none;font-style:italic;"></textarea>
        <button class="btn-rsvp">Kirim Konfirmasi</button>
      </div>
    </div>

    
    <!-- M6b: Doa & Ucapan -->
    <div class="m-section ms6" id="sectionWishes">
      <p class="section-eyebrow anim-el anim-fade d0">Kata Sahabat</p>
      <h3 class="m-section-title anim-el anim-word d1"><em>Doa &amp; Ucapan</em></h3>

      <div class="wishes-pager anim-el anim-fade d3" id="wishesPager"></div>

      <div class="pager-nav anim-el anim-fade d4">
        <button class="pager-btn" id="wishPrevBtn" onclick="wishChangePage(-1)">← Prev</button>
        <div style="display:flex;flex-direction:column;align-items:center;gap:6px;">
          <div class="pager-dots" id="wishDots"></div>
          <span class="pager-info" id="wishInfo"></span>
        </div>
        <button class="pager-btn" id="wishNextBtn" onclick="wishChangePage(1)">Next →</button>
      </div>
    </div>

    <!-- M6c: Gift & Alamat -->
    <div class="m-section ms6" id="sectionGift">
      <p class="section-eyebrow anim-el anim-fade d0">Hadiah & Kehadiran</p>
      <h3 class="m-section-title anim-el anim-word d1"><em>Gift</em></h3>

      <div class="gift-content anim-el anim-fade d2">

        <!-- Rekening -->
        <div class="gift-block">
          <p class="gift-label">Transfer</p>
          <?php foreach ($rekening ?? [] as $rek): ?>
          <div class="gift-card">
            <div class="gift-card-left">
              <span class="gift-bank"><?= htmlspecialchars($rek['bank']) ?></span>
              <span class="gift-accname"><?= htmlspecialchars($rek['nama']) ?></span>
              <span class="gift-accnum" id="rek-<?= $loop->index ?? uniqid() ?>"><?= htmlspecialchars($rek['nomor']) ?></span>
            </div>
            <button class="gift-copy-btn" onclick="copyText('<?= htmlspecialchars($rek['nomor']) ?>', this)">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" width="14" height="14">
                <rect x="9" y="9" width="13" height="13" rx="1"/><path d="M5 15H4a2 2 0 01-2-2V4a2 2 0 012-2h9a2 2 0 012 2v1"/>
              </svg>
              <span>Salin</span>
            </button>
          </div>
          <?php endforeach; ?>

          <!-- Fallback jika $rekening kosong -->
          <?php if (empty($rekening)): ?>
          <div class="gift-card">
            <div class="gift-card-left">
              <span class="gift-bank">BCA</span>
              <span class="gift-accname">Zahra Aulia</span>
              <span class="gift-accnum">1234567890</span>
            </div>
            <button class="gift-copy-btn" onclick="copyText('1234567890', this)">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" width="14" height="14">
                <rect x="9" y="9" width="13" height="13" rx="1"/><path d="M5 15H4a2 2 0 01-2-2V4a2 2 0 012-2h9a2 2 0 012 2v1"/>
              </svg>
              <span>Salin</span>
            </button>
          </div>
          <div class="gift-card">
            <div class="gift-card-left">
              <span class="gift-bank">Mandiri</span>
              <span class="gift-accname">Ahmad Fauzan</span>
              <span class="gift-accnum">0987654321</span>
            </div>
            <button class="gift-copy-btn" onclick="copyText('0987654321', this)">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" width="14" height="14">
                <rect x="9" y="9" width="13" height="13" rx="1"/><path d="M5 15H4a2 2 0 01-2-2V4a2 2 0 012-2h9a2 2 0 012 2v1"/>
              </svg>
              <span>Salin</span>
            </button>
          </div>
          <?php endif; ?>
        </div>

        <!-- Divider -->
        <div class="gift-divider"></div>

        <!-- Alamat Rumah -->
        <div class="gift-block">
          <p class="gift-label">Kirim ke Alamat</p>
          <div class="gift-card gift-card--address">
            <div class="gift-card-left">
              <span class="gift-bank"><?= htmlspecialchars($alamat_rumah['nama'] ?? 'Rumah Mempelai Wanita') ?></span>
              <span class="gift-accname gift-address-text"><?= htmlspecialchars($alamat_rumah['alamat'] ?? 'Jl. Mawar No. 12, RT 03/RW 05, Kel. Menteng, Kec. Menteng, Jakarta Pusat, DKI Jakarta 10310') ?></span>
            </div>
            <div class="gift-card-actions">
              <button class="gift-copy-btn" onclick="copyText('<?= htmlspecialchars($alamat_rumah['alamat'] ?? 'Jl. Mawar No. 12, RT 03/RW 05, Kel. Menteng, Kec. Menteng, Jakarta Pusat, DKI Jakarta 10310') ?>', this)">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" width="14" height="14">
                  <rect x="9" y="9" width="13" height="13" rx="1"/><path d="M5 15H4a2 2 0 01-2-2V4a2 2 0 012-2h9a2 2 0 012 2v1"/>
                </svg>
                <span>Salin</span>
              </button>
              <a class="gift-maps-btn" href="<?= htmlspecialchars($alamat_rumah['maps'] ?? 'https://maps.google.com') ?>" target="_blank">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" width="14" height="14">
                  <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7z"/><circle cx="12" cy="9" r="2.5"/>
                </svg>
                <span>Maps</span>
              </a>
            </div>
          </div>
        </div>

      </div>
    </div>

    <!-- M7: Thank You -->
    <div class="m-section ms7">
      <div class="ms7-bg"></div>
      <div class="ms7-overlay"></div>
      <div class="ornament anim-el anim-shimmer d0" style="position:relative;z-index:2;">— ✦ —</div>
      <h2 class="thankyou-big anim-el anim-word d2">Thank<br>You</h2>
      <p class="thankyou-sub anim-el anim-fade-slow d4"><?=$msg_to_guest_bot ?? '-'?></p>
      <p class="love-sig anim-el anim-fade d6"><?=$groom_nickname ?? 'Grooms'?> &amp; <?=$bride_nickname ?? 'Brides'?></p>
      <p class="section-eyebrow anim-el anim-fade d7" style="position:relative;z-index:2;margin-top:0.5rem;"><?= date('d.m.Y', strtotime($acara_utama['tanggal'] ?? '11.04.2026'))?></p>
    </div>

  </div><!-- end .main-right -->
</div><!-- end #main -->

<script>
  /* ---- Open invitation ---- */
  function openInvitation() {
    document.getElementById('cover').classList.add('hidden');
    const main = document.getElementById('main');
    main.classList.add('visible');
    document.body.style.overflow = 'hidden';
    startCountdown();
    // Trigger first section animation after main fades in
    setTimeout(() => activateSection(document.querySelector('.m-section')), 400);
  }

  /* ---- Activate a section: reset then animate ---- */
  function activateSection(section) {
    if (!section) return;
    // Reset all anim-el in this section (so re-entering replays)
    section.querySelectorAll('.anim-el').forEach(el => {
      el.style.animation = 'none';
      el.offsetHeight; // reflow
      el.style.animation = '';
    });
    section.classList.remove('section-active');
    requestAnimationFrame(() => {
      requestAnimationFrame(() => {
        section.classList.add('section-active');
      });
    });
  }

  /* ---- IntersectionObserver on panel scroll ---- */
  const panel = document.getElementById('mobilePanel');

  const sectionObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting && entry.intersectionRatio >= 0.6) {
        activateSection(entry.target);
      }
    });
  }, {
    root: panel,
    threshold: 0.6
  });

  document.querySelectorAll('.m-section').forEach(s => sectionObserver.observe(s));

  /* ---- RSVP attend toggle ---- */
  function selectAttend(el) {
    document.querySelectorAll('.rsvp-radio-btn').forEach(b => b.classList.remove('active'));
    el.classList.add('active');
  }

  /* ---- Countdown to April 11, 2026 ---- */
  function startCountdown() {
    const target = new Date('<?= date('Y-m-d', strtotime($acara_utama['tanggal'] ?? '2026-12-31')) . 'T' . date('H:i:s', strtotime($row['mulai'] ?? '09:00:00')) ?>');
    function tick() {
      const diff = target - new Date();
      if (diff <= 0) { document.getElementById('cd-d').textContent = '000'; return; }
      const d = Math.floor(diff / 86400000);
      const h = Math.floor((diff % 86400000) / 3600000);
      const m = Math.floor((diff % 3600000) / 60000);
      const s = Math.floor((diff % 60000) / 1000);
      document.getElementById('cd-d').textContent = d < 100 
      ? String(d).padStart(2,'0') 
      : String(d).padStart(3,'0');
      document.getElementById('cd-h').textContent = String(h).padStart(2,'0');
      document.getElementById('cd-m').textContent = String(m).padStart(2,'0');
      document.getElementById('cd-s').textContent = String(s).padStart(2,'0');
    }
    tick();
    setInterval(tick, 1000);
  }

  /* ---- Left photo parallax ---- */
  const leftBg = document.querySelector('.main-left-bg');
  if (panel && leftBg) {
    panel.addEventListener('scroll', () => {
      const pct = panel.scrollTop / (panel.scrollHeight - panel.clientHeight);
      leftBg.style.transform = `scale(1.05) translateY(${pct * -4}%)`;
    });
  }
  

  /* ---- Gallery Slider + Lightbox ---- */
  const galleryImages = <?= json_encode(array_map(function($path) {
      return [
          'src' => base_url($path),
          'alt' => 'Gallery photo',
      ];
  }, $gallery ?? [])) ?>;

  (function initGallery() {
    const track = document.getElementById('galleryTrack');
    const wrap = document.getElementById('gallerySliderWrap');
    const dotsEl = document.getElementById('galleryDots');
    const lightbox = document.getElementById('galleryLightbox');
    const lbImg = document.getElementById('lightboxImg');
    const lbClose = document.getElementById('lightboxClose');
    const lbPrev = document.getElementById('lightboxPrev');
    const lbNext = document.getElementById('lightboxNext');

    const PER_PAGE = 4;
    const pages = Math.ceil(galleryImages.length / PER_PAGE);
    let currentPage = 0;
    let lbIndex = 0;

    /* Build pages */
    for (let p = 0; p < pages; p++) {
      const pageEl = document.createElement('div');
      pageEl.className = 'gallery-page';
      const slice = galleryImages.slice(p * PER_PAGE, p * PER_PAGE + PER_PAGE);
      while (slice.length < PER_PAGE) slice.push(null);
      slice.forEach((img, i) => {
        if (img) {
          const el = document.createElement('img');
          el.src = img.src;
          el.alt = img.alt;
          el.loading = 'lazy';
          el.dataset.index = p * PER_PAGE + i;
          el.addEventListener('click', () => openLightbox(parseInt(el.dataset.index)));
          pageEl.appendChild(el);
        } else {
          const ph = document.createElement('div');
          ph.style.cssText = 'background:rgba(245,240,232,0.03);';
          pageEl.appendChild(ph);
        }
      });
      track.appendChild(pageEl);
    }

    /* Dots */
    for (let p = 0; p < pages; p++) {
      const dot = document.createElement('div');
      dot.className = 'gallery-dot' + (p === 0 ? ' active' : '');
      dot.addEventListener('click', () => goToPage(p));
      dotsEl.appendChild(dot);
    }

    function setTrack(offset, animate) {
      track.style.transition = animate ? 'transform 0.42s cubic-bezier(0.25,1,0.5,1)' : 'none';
      track.style.transform = 'translateX(' + offset + 'px)';
    }

    function goToPage(p, animate) {
      currentPage = Math.max(0, Math.min(pages - 1, p));
      setTrack(-(currentPage * wrap.offsetWidth), animate !== false);
      dotsEl.querySelectorAll('.gallery-dot').forEach((d, i) =>
        d.classList.toggle('active', i === currentPage)
      );
    }

    /* ---- Touch events (passive:false supaya bisa preventDefault) ---- */
    let touchStartX = 0;
    let touchStartY = 0;
    let touchCurX = 0;
    let lockAxis = null; /* 'h' | 'v' | null */
    let isDragging = false;

    wrap.addEventListener('touchstart', function(e) {
      touchStartX = e.touches[0].clientX;
      touchStartY = e.touches[0].clientY;
      touchCurX = touchStartX;
      lockAxis = null;
      isDragging = false;
      /* Matikan transition saat mulai drag */
      track.style.transition = 'none';
    }, { passive: true });

    wrap.addEventListener('touchmove', function(e) {
      const dx = e.touches[0].clientX - touchStartX;
      const dy = e.touches[0].clientY - touchStartY;

      /* Tentukan axis sekali saja di awal */
      if (!lockAxis) {
        if (Math.abs(dx) > Math.abs(dy) + 4) {
          lockAxis = 'h';
          isDragging = true;
        } else if (Math.abs(dy) > Math.abs(dx) + 4) {
          lockAxis = 'v';
        }
      }

      if (lockAxis !== 'h') return; /* Biarkan scroll vertikal berjalan */

      e.preventDefault(); /* Cegah scroll vertikal saat swipe horizontal */

      touchCurX = e.touches[0].clientX;
      const base = -(currentPage * wrap.offsetWidth);
      const delta = touchCurX - touchStartX;

      /* Rubber-band di ujung */
      let offset = base + delta;
      if (currentPage === 0 && delta > 0) offset = base + delta * 0.25;
      if (currentPage === pages - 1 && delta < 0) offset = base + delta * 0.25;

      setTrack(offset, false);
    }, { passive: false });

    wrap.addEventListener('touchend', function() {
      if (!isDragging) return;
      const delta = touchCurX - touchStartX;
      const threshold = wrap.offsetWidth * 0.25; /* 25% lebar = snap */

      if (delta < -threshold) goToPage(currentPage + 1);
      else if (delta > threshold) goToPage(currentPage - 1);
      else goToPage(currentPage);

      isDragging = false;
      lockAxis = null;
    }, { passive: true });

    /* ---- Mouse drag (desktop) ---- */
    let mouseStartX = 0;
    let mouseCurX = 0;
    let mouseDown = false;

    wrap.addEventListener('mousedown', function(e) {
      mouseStartX = e.clientX;
      mouseCurX = mouseStartX;
      mouseDown = true;
      track.style.transition = 'none';
      wrap.style.cursor = 'grabbing';
    });

    window.addEventListener('mousemove', function(e) {
      if (!mouseDown) return;
      mouseCurX = e.clientX;
      const base = -(currentPage * wrap.offsetWidth);
      const delta = mouseCurX - mouseStartX;
      let offset = base + delta;
      if (currentPage === 0 && delta > 0) offset = base + delta * 0.25;
      if (currentPage === pages - 1 && delta < 0) offset = base + delta * 0.25;
      setTrack(offset, false);
    });

    window.addEventListener('mouseup', function() {
      if (!mouseDown) return;
      mouseDown = false;
      wrap.style.cursor = 'grab';
      const delta = mouseCurX - mouseStartX;
      const threshold = wrap.offsetWidth * 0.25;
      if (delta < -threshold) goToPage(currentPage + 1);
      else if (delta > threshold) goToPage(currentPage - 1);
      else goToPage(currentPage);
    });

    /* Cegah drag image default browser */
    wrap.addEventListener('dragstart', e => e.preventDefault());

    /* ---- Lightbox ---- */
    function openLightbox(index) {
      lbIndex = index;
      lbImg.src = galleryImages[lbIndex].src;
      lightbox.classList.add('open');
    }

    lbClose.addEventListener('click', () => lightbox.classList.remove('open'));
    lightbox.addEventListener('click', e => { if (e.target === lightbox) lightbox.classList.remove('open'); });

    lbNext.addEventListener('click', e => {
      e.stopPropagation();
      lbIndex = (lbIndex + 1) % galleryImages.length;
      lbImg.src = galleryImages[lbIndex].src;
    });

    lbPrev.addEventListener('click', e => {
      e.stopPropagation();
      lbIndex = (lbIndex - 1 + galleryImages.length) % galleryImages.length;
      lbImg.src = galleryImages[lbIndex].src;
    });

    document.addEventListener('keydown', e => {
      if (!lightbox.classList.contains('open')) return;
      if (e.key === 'ArrowRight') lbNext.click();
      if (e.key === 'ArrowLeft') lbPrev.click();
      if (e.key === 'Escape') lightbox.classList.remove('open');
    });
  })();

/* ---- Wishes Pager ---- */
  (function initWishes() {
    const wishes = <?= json_encode(array_map(function($r) {
      return [
        'name'       => htmlspecialchars($r['nama'] ?? ''),
        'attendance' => $r['kehadiran'] ?? 'hadir',
        'text'       => htmlspecialchars($r['ucapan'] ?? ''),
      ];
    }, $wishes ?? [])) ?>;

    const PER_PAGE = 5;
    let page = 0;
    const total = Math.ceil(wishes.length / PER_PAGE);

    const pager   = document.getElementById('wishesPager');
    const dotsEl  = document.getElementById('wishDots');
    const infoEl  = document.getElementById('wishInfo');
    const prevBtn = document.getElementById('wishPrevBtn');
    const nextBtn = document.getElementById('wishNextBtn');

    function buildDots() {
      dotsEl.innerHTML = '';
      for (let i = 0; i < total; i++) {
        const d = document.createElement('button');
        d.className = 'pager-dot' + (i === page ? ' active' : '');
        d.setAttribute('aria-label', 'Halaman ' + (i + 1));
        d.onclick = function() { page = i; render(); };
        dotsEl.appendChild(d);
      }
    }

    function render() {
      pager.innerHTML = '';
      const start = page * PER_PAGE;
      const slice = wishes.slice(start, start + PER_PAGE);

      if (!slice.length) {
        pager.innerHTML = '<div class="wishes-empty">Belum ada ucapan.</div>';
      } else {
        slice.forEach(function(w, i) {
          const card = document.createElement('div');
          card.className = 'wish-card anim-el anim-fade d' + i;
          const badge = w.attendance === 'hadir'
            ? '<span class="wish-badge hadir">Hadir</span>'
            : '<span class="wish-badge tidak">Tidak Hadir</span>';
          card.innerHTML =
            '<div class="wish-name">' + w.name + badge + '</div>' +
            '<div class="wish-text">' + w.text + '</div>';
          pager.appendChild(card);
        });

        // trigger animasi
        const section = document.getElementById('sectionWishes');
        if (section.classList.contains('section-active')) {
          section.querySelectorAll('.wish-card').forEach(function(el) {
            el.style.animation = 'none';
            el.offsetHeight;
            el.style.animation = '';
          });
        }
      }

      const end = Math.min(start + PER_PAGE, wishes.length);
      prevBtn.disabled = page === 0;
      nextBtn.disabled = page >= total - 1;
      buildDots();
    }

    window.wishChangePage = function(dir) {
      page = Math.max(0, Math.min(total - 1, page + dir));
      render();
    };

    render();
  })();

  /* ---- Copy to clipboard ---- */
  function copyText(text, btn) {
    navigator.clipboard.writeText(text).then(function() {
      const span = btn.querySelector('span');
      const original = span.textContent;
      btn.classList.add('copied');
      span.textContent = 'Tersalin!';
      setTimeout(function() {
        btn.classList.remove('copied');
        span.textContent = original;
      }, 2000);
    }).catch(function() {
      /* fallback untuk browser lama */
      const el = document.createElement('textarea');
      el.value = text;
      el.style.cssText = 'position:fixed;opacity:0;';
      document.body.appendChild(el);
      el.select();
      document.execCommand('copy');
      document.body.removeChild(el);
      const span = btn.querySelector('span');
      const original = span.textContent;
      btn.classList.add('copied');
      span.textContent = 'Tersalin!';
      setTimeout(function() {
        btn.classList.remove('copied');
        span.textContent = original;
      }, 2000);
    });
  }
</script>

</body>
</html>