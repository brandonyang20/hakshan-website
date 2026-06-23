<?php
/**
 * Front page template — Hakshan home.
 *
 * @package Hakshan
 */

get_header();
?>
<style>
  /* ===== Direction A · Quiet Editorial ===== */
  body { background: var(--paper); }

  .hero-a {
    position: relative;
    min-height: 100vh;
    margin-top: -77px; /* pull behind the sticky nav so logo gets the full screen */
    padding-top: 77px;
    display: grid;
    place-items: center;
    overflow: hidden;
  }
  /* Warm wash + grain on the cream paper */
  .hero-a::before {
    content: "";
    position: absolute;
    inset: 0;
    background:
      radial-gradient(ellipse at 50% 40%, rgba(235, 223, 196, 0.55) 0%, transparent 60%),
      radial-gradient(ellipse at 50% 100%, rgba(201, 190, 159, 0.22) 0%, transparent 65%);
    pointer-events: none;
  }
  .hero-a::after {
    content: "";
    position: absolute;
    inset: 0;
    background-image: url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='240' height='240'><filter id='n'><feTurbulence type='fractalNoise' baseFrequency='0.85' numOctaves='2' stitchTiles='stitch'/><feColorMatrix values='0 0 0 0 0.32  0 0 0 0 0.36  0 0 0 0 0.28  0 0 0 0.05 0'/></filter><rect width='100%' height='100%' filter='url(%23n)'/></svg>");
    mix-blend-mode: multiply;
    opacity: 0.4;
    pointer-events: none;
  }
  .hero-a__logo {
    position: relative;
    z-index: 2;
    text-align: center;
    padding: 0 var(--rail);
  }
  .hero-a__logo img {
    width: clamp(200px, 35vw, 500px);
    max-height: 53vh;
    height: auto;
    object-fit: contain;
    display: block;
    margin: 0 auto;
    user-select: none;
    -webkit-user-drag: none;
  }
  .hero-a__scroll {
    position: absolute;
    bottom: 32px;
    left: 50%;
    transform: translateX(-50%);
    z-index: 2;
    font-family: var(--mono);
    font-size: 13px;
    letter-spacing: 0.36em;
    text-transform: uppercase;
    color: var(--forest);
    opacity: 0.55;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 12px;
    animation: scrollNudge 2.4s ease-in-out infinite;
  }
  .hero-a__scroll::after {
    content: "";
    width: 1px;
    height: 28px;
    background: var(--forest);
    opacity: 0.4;
  }
  @keyframes scrollNudge {
    0%, 100% { transform: translate(-50%, 0); opacity: 0.55; }
    50%      { transform: translate(-50%, 6px); opacity: 0.9; }
  }

  .marquee {
    background: var(--cream);
    border-top: 1px solid var(--line);
    border-bottom: 1px solid var(--line);
    overflow: hidden;
    white-space: nowrap;
    padding: 22px 0;
    font-family: var(--serif);
    font-style: italic;
    font-size: 28px;
    color: var(--forest);
  }
  .marquee__track {
    display: inline-block;
    animation: marquee 40s linear infinite;
  }
  .marquee__track span {
    margin: 0 36px;
    opacity: 0.8;
  }
  .marquee__track .dot {
    color: var(--ink);
    font-style: normal;
  }
  @keyframes marquee {
    from { transform: translateX(0); }
    to   { transform: translateX(-50%); }
  }

  /* Signature dish — single anchor */
  .anchor {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 80px;
    align-items: center;
    max-width: var(--maxw);
    margin: 0 auto;
  }
  .anchor__visual {
    aspect-ratio: 1/1;
    position: relative;
  }
  .anchor__visual .ph { position: absolute; inset: 0; }
  .anchor__num {
    font-family: var(--serif);
    font-style: italic;
    font-size: 200px;
    line-height: 1;
    color: var(--cream);
    position: absolute;
    top: -40px; left: -28px;
    z-index: -1;
  }
  .anchor h2 {
    font-family: var(--serif);
    font-style: italic;
    font-size: clamp(40px, 5.6vw, 76px);
    line-height: 1;
    margin: 16px 0 24px;
    letter-spacing: -0.02em;
  }
  .anchor h2 .cn {
    font-family: var(--cn);
    font-style: normal;
    display: block;
    font-size: 0.45em;
    color: var(--forest);
    letter-spacing: 0.2em;
    margin-top: 14px;
  }
  .anchor p { color: var(--ink-soft); }
  .anchor__row {
    display: flex;
    gap: 24px;
    margin-top: 32px;
    padding-top: 24px;
    border-top: 1px solid var(--line);
    align-items: center;
  }

  /* Signatures carousel (uses .oc-card pattern) */
  .sigs {
    background: var(--cream);
  }
  .sigs__head {
    display: flex;
    justify-content: space-between;
    align-items: end;
    max-width: var(--maxw);
    margin: 0 auto 56px;
    gap: 48px;
  }
  .sigs__head h2 {
    font-family: var(--serif);
    font-style: italic;
    font-size: clamp(40px, 6vw, 80px);
    line-height: 1;
    margin: 12px 0 0;
    letter-spacing: -0.02em;
  }
  .sigs__carousel-wrap {
    position: relative;
    max-width: var(--maxw);
    margin: 0 auto;
  }
  .sigs__side-btn {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    z-index: 2;
    width: 52px;
    height: 52px;
    border-radius: 50%;
    border: 1px solid var(--forest);
    background: rgba(249, 247, 242, 0.94);
    backdrop-filter: blur(6px);
    -webkit-backdrop-filter: blur(6px);
    color: var(--forest);
    font-family: var(--serif);
    font-size: 22px;
    cursor: pointer;
    display: grid;
    place-items: center;
    padding: 0;
    transition: background 0.2s ease, color 0.2s ease, transform 0.2s ease;
  }
  .sigs__side-btn:hover {
    background: var(--forest);
    color: var(--cream);
    transform: translateY(-50%) scale(1.06);
  }
  .sigs__side-btn--prev { left: clamp(8px, 1.5vw, 24px); }
  .sigs__side-btn--next { right: clamp(8px, 1.5vw, 24px); }
  @media (max-width: 600px) {
    .sigs__side-btn { width: 42px; height: 42px; font-size: 18px; }
  }
  /* Viewport — clips the track horizontally, captures pointer events
     for drag. No native scroll: the JS slider drives the track's
     translateX directly so we control wrap, momentum, and animation. */
  .sigs__viewport {
    position: relative;
    overflow: hidden;
    width: 100%;
    cursor: grab;
    user-select: none;
    padding: 30px 0 50px;
    touch-action: pan-y; /* allow vertical page scroll, let JS handle horizontal */
  }
  .sigs__viewport.is-dragging { cursor: grabbing; }
  .sigs__carousel {
    display: flex;
    gap: 24px;
    will-change: transform;
  }
  .sc-card {
    flex: 0 0 clamp(280px, 28vw, 360px);
    background: var(--paper);
    border: 1px solid rgba(201, 190, 159, 0.4);
    border-radius: 14px;
    box-shadow:
      0 1px 2px rgba(42, 46, 39, 0.04),
      0 18px 32px -18px rgba(42, 46, 39, 0.22),
      0 30px 60px -28px rgba(42, 46, 39, 0.16);
    display: grid;
    transition: background 0.3s ease, box-shadow 0.3s ease;
    cursor: pointer;
    overflow: hidden;
    /* Curve: JS owns transform per frame; rotation pivots from the
       bottom so cards fan outward like a deck spread. */
    transform-origin: center bottom;
    will-change: transform;
    /* Stop the browser's native link-drag and text-selection gestures
       from stealing pointer events from the slider's drag handler. */
    -webkit-user-drag: none;
    user-select: none;
    -webkit-user-select: none;
    -webkit-tap-highlight-color: transparent;
  }
  /* Images inside cards: disable image-drag and let pointer events fall
     through to the card so the slider's pointerdown handler always wins. */
  .sc-card img {
    -webkit-user-drag: none;
    user-select: none;
    -webkit-user-select: none;
    pointer-events: none;
  }
  .sc-card:hover {
    background: #fefcf7;
    box-shadow:
      0 1px 2px rgba(42, 46, 39, 0.05),
      0 22px 40px -18px rgba(42, 46, 39, 0.3),
      0 40px 80px -32px rgba(42, 46, 39, 0.2);
  }
  .sc-card__visual {
    aspect-ratio: 1/1;
    position: relative;
  }
  .sc-card__visual .ph { position: absolute; inset: 0; }
  .sc-card__visual .num {
    position: absolute;
    top: 14px; left: 14px;
    background: rgba(249, 247, 242, 0.92);
    backdrop-filter: blur(4px);
    padding: 4px 10px;
    border-radius: 999px;
    font-family: var(--mono);
    font-size: 12px;
    letter-spacing: 0.16em;
    color: var(--forest);
    z-index: 2;
  }
  .sc-card__visual .tag {
    position: absolute;
    top: 14px; right: 14px;
    background: var(--forest);
    color: var(--cream);
    padding: 4px 10px;
    border-radius: 999px;
    font-family: var(--mono);
    font-size: 12px;
    letter-spacing: 0.18em;
    text-transform: uppercase;
    z-index: 2;
  }
  .sc-card__body {
    padding: 22px 24px;
    display: grid;
    gap: 10px;
    align-content: start;
  }
  .sc-card h3 {
    font-family: var(--serif);
    font-style: italic;
    font-size: 24px;
    margin: 0 0 4px;
    letter-spacing: -0.01em;
    line-height: 1.1;
  }
  .sc-card h3 .cn {
    display: block;
    font-family: var(--cn);
    font-style: normal;
    font-weight: 400;
    font-size: 13px;
    color: var(--forest);
    letter-spacing: 0.2em;
    margin: 8px 0 0;
    opacity: 0.7;
  }
  .sc-card p {
    font-size: 13px;
    line-height: 1.6;
    color: var(--ink-soft);
    margin: 0;
  }
  .sc-card__foot {
    margin-top: auto;
    padding-top: 14px;
    border-top: 1px solid var(--line);
    display: flex;
    justify-content: space-between;
    align-items: baseline;
    font-family: var(--mono);
    font-size: 12px;
    color: var(--forest);
  }
  .sc-card__foot .arr {
    font-family: var(--serif);
    font-size: 22px;
    transition: transform 0.25s ease;
  }
  .sc-card:hover .sc-card__foot .arr { transform: translateX(6px); }

  /* Three Generations — sticky-stack layout
     Intro header sits at the top of the section, full width. Below it,
     each kitchen card is sticky at the same top offset, so scrolling
     past one pins it; the next card scrolls up and visually covers it. */
  .kitchens {
    background: var(--paper);
    padding: clamp(80px, 10vw, 120px) var(--rail);
  }
  .kitchens__inner {
    max-width: var(--maxw);
    margin: 0 auto;
  }
  .kitchens__copy {
    max-width: 880px;
    margin: 0 0 clamp(48px, 7vw, 96px);
  }
  .kitchens__copy h2 {
    font-family: var(--serif);
    font-size: clamp(48px, 7vw, 92px);
    line-height: 1;
    margin: 18px 0 28px;
    letter-spacing: -0.025em;
  }
  .kitchens__copy h2 em { color: var(--forest); }
  .kitchens__copy p {
    font-size: 17px;
    line-height: 1.7;
    color: var(--ink-soft);
    margin: 0 0 16px;
    max-width: 52ch;
  }
  .kitchens__copy .btn { margin-top: 18px; }
  .kitchens__stack {
    display: flex;
    flex-direction: column;
    gap: 24px;
  }
  .kitchen {
    position: -webkit-sticky;
    position: sticky;
    top: calc(var(--nav-h, 65px) + 48px);
    background: var(--paper);
    display: grid;
    grid-template-columns: 1.15fr 1fr;
    gap: 0;
    min-height: clamp(460px, 65vh, 680px);
    overflow: hidden;
  }
  .kitchen__photo {
    position: relative;
    min-width: 0;
    height: 100%;
    overflow: hidden;
    background: var(--cream);
  }
  .kitchen__photo img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
  }
  /* Soft blend — the image's right edge fades into the paper background
     so the photo and text sit on the same surface instead of being
     divided by a hard column gutter. Same idea as the story-page hero. */
  .kitchen__photo::after {
    content: "";
    position: absolute;
    inset: 0;
    background: linear-gradient(90deg,
      transparent 55%,
      rgba(249, 247, 242, 0.45) 78%,
      var(--paper) 100%);
    pointer-events: none;
  }
  .kitchen__text {
    min-width: 0;
    padding: clamp(32px, 4vw, 56px) clamp(28px, 3.5vw, 48px) clamp(32px, 4vw, 56px) clamp(36px, 4.5vw, 64px);
    display: flex;
    flex-direction: column;
    justify-content: center;
    gap: 14px;
  }
  .kitchen__year {
    font-family: var(--mono);
    font-size: 12px;
    letter-spacing: 0.22em;
    color: var(--forest);
    margin-bottom: 4px;
  }
  .kitchen h3 {
    font-family: var(--serif);
    font-size: clamp(30px, 3.4vw, 52px);
    line-height: 1.1;
    margin: 0 0 18px;
    letter-spacing: -0.02em;
    text-wrap: balance;
  }
  .kitchen p {
    margin: 0;
    font-size: 16px;
    line-height: 1.7;
    color: var(--ink-soft);
    max-width: 38ch;
  }
  @media (max-width: 900px) {
    .kitchens__copy {
      margin-bottom: 40px;
    }
    /* Sticky-stack still applies on mobile so each card scrolls up and
       covers the one before it. Layout collapses to photo-on-top /
       text-below within each card, and the blend gradient is dropped
       because it only makes sense in a side-by-side composition. */
    .kitchen {
      grid-template-columns: 1fr;
      min-height: 92vh;
    }
    .kitchen__photo {
      aspect-ratio: 4 / 3;
      height: auto;
    }
    .kitchen__photo::after { display: none; }
    .kitchen__text {
      padding: clamp(20px, 5vw, 32px) clamp(24px, 6vw, 36px) clamp(24px, 6vw, 40px);
      justify-content: flex-start;
    }
  }

  /* Charity band */
  .charity {
    background: var(--forest);
    color: var(--cream);
    padding: clamp(80px, 12vw, 140px) var(--rail);
  }
  .charity__inner {
    max-width: var(--maxw);
    margin: 0 auto;
    display: grid;
    grid-template-columns: 1fr 1.4fr;
    gap: 80px;
    align-items: start;
  }
  .charity h2 {
    font-family: var(--serif);
    font-style: italic;
    font-size: clamp(48px, 6.5vw, 88px);
    line-height: 0.95;
    margin: 16px 0 0;
    letter-spacing: -0.02em;
  }
  .charity h2 em { font-style: italic; }
  .charity h2 .underline { border-bottom: 2px solid var(--cream); padding-bottom: 4px; }
  .charity .h-eyebrow { color: var(--cream); opacity: 0.7; }
  .charity .h-eyebrow .dot { background: var(--cream); }
  .charity p { font-size: 17px; line-height: 1.7; opacity: 0.85; max-width: 60ch; }
  .charity__stats {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 32px;
    margin-top: 40px;
    padding-top: 32px;
    border-top: 1px solid rgba(235, 223, 196, 0.2);
  }
  .charity__stats .num {
    font-family: var(--serif);
    font-style: italic;
    font-size: 56px;
    line-height: 1;
    letter-spacing: -0.02em;
  }
  .charity__stats .lbl {
    font-size: 12px;
    letter-spacing: 0.14em;
    text-transform: uppercase;
    opacity: 0.7;
    margin-top: 8px;
  }

  /* Atmosphere gallery */
  .gallery {
    max-width: var(--maxw);
    margin: 0 auto;
    display: grid;
    grid-template-columns: repeat(12, 1fr);
    grid-auto-rows: 120px;
    gap: 16px;
  }
  .gallery .ph { position: relative; }
  .gallery .g-tile {
    position: relative;
    overflow: hidden;
    display: block;
  }
  .gallery .g-tile img {
    position: absolute;
    inset: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.6s ease;
  }
  .gallery .g-tile:hover img { transform: scale(1.04); }
  .g1 { grid-column: 1 / 7;  grid-row: span 4; }
  .g2 { grid-column: 7 / 13; grid-row: span 4; }
  .g3 { grid-column: 7 / 10; grid-row: span 3; }
  .g4 { grid-column: 10 / 13; grid-row: span 3; }
  .g5 { grid-column: 1 / 5;  grid-row: span 5; }
  .g6 { grid-column: 5 / 13; grid-row: span 3; }

  /* The 12-col mosaic collapses to a two-column mobile layout where
     the wide landscape tiles (g1, g6) span full-width and the four
     portrait/square tiles sit beside each other 2 across. */
  @media (max-width: 768px) {
    .gallery {
      grid-template-columns: 1fr 1fr;
      grid-auto-rows: auto;
      gap: 10px;
    }
    .gallery > * {
      grid-column: auto;
      grid-row: auto;
    }
    .g1, .g6 { grid-column: 1 / -1; aspect-ratio: 16 / 10; }
    .g2, .g3, .g4, .g5 { aspect-ratio: 1 / 1; }
  }

  /* Outlets carousel band */
  .outlets {
    max-width: var(--maxw);
    margin: 0 auto;
  }
  .outlets__head {
    display: flex;
    justify-content: space-between;
    align-items: end;
    margin-bottom: 56px;
    gap: 48px;
  }
  .outlets__head h2 {
    font-family: var(--serif);
    font-style: italic;
    font-size: clamp(40px, 6vw, 80px);
    line-height: 1;
    margin: 12px 0 0;
    letter-spacing: -0.02em;
  }
  .outlets__carousel-wrap {
    position: relative;
  }
  .outlets__carousel {
    display: flex;
    gap: 24px;
    overflow-x: auto;
    scroll-snap-type: x mandatory;
    scrollbar-width: none;
    padding: 4px 0 8px;
    margin: 0 calc(var(--rail) * -1);
    padding-left: max(var(--rail), 6vw);
    padding-right: max(var(--rail), 6vw);
    scroll-padding-left: max(var(--rail), 6vw);
    scroll-behavior: smooth;
  }
  .outlets__carousel::-webkit-scrollbar { display: none; }
  .oc-card {
    flex: 0 0 clamp(280px, 30vw, 380px);
    scroll-snap-align: start;
    background: var(--paper);
    border: 1px solid var(--line);
    padding: 24px;
    display: grid;
    gap: 18px;
    transition: background 0.3s ease, transform 0.3s ease;
    cursor: pointer;
  }
  .oc-card:hover { background: var(--cream); transform: translateY(-4px); }
  .oc-card__visual {
    aspect-ratio: 4/3;
    position: relative;
    margin: -24px -24px 0;
  }
  .oc-card__visual .ph { position: absolute; inset: 0; }
  .oc-card__visual .num {
    position: absolute;
    top: 14px; left: 14px;
    background: rgba(249, 247, 242, 0.92);
    backdrop-filter: blur(4px);
    padding: 4px 10px;
    border-radius: 999px;
    font-family: var(--mono);
    font-size: 12px;
    letter-spacing: 0.16em;
    color: var(--forest);
    z-index: 2;
  }
  .oc-card__visual .badge {
    position: absolute;
    top: 14px; right: 14px;
    background: var(--forest);
    color: var(--cream);
    padding: 4px 10px;
    border-radius: 999px;
    font-family: var(--mono);
    font-size: 12px;
    letter-spacing: 0.18em;
    text-transform: uppercase;
    z-index: 2;
  }
  .oc-card h3 {
    font-family: var(--serif);
    font-style: italic;
    font-size: 26px;
    margin: 0;
    letter-spacing: -0.01em;
  }
  .oc-card__body { display: grid; gap: 6px; }
  .oc-card__head {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    gap: 16px;
  }
  .oc-card__head .arr {
    align-self: flex-end;
    align-self: last baseline;
    flex-shrink: 0;
  }
  .oc-card .city {
    font-family: var(--mono);
    font-size: 12px;
    letter-spacing: 0.18em;
    text-transform: uppercase;
    color: var(--forest);
    opacity: 0.75;
  }
  .oc-card .arr {
    font-family: var(--serif);
    font-size: 22px;
    color: var(--forest);
    transition: transform 0.25s ease;
  }
  .oc-card:hover .arr { transform: translateX(6px); }

  /* Carousel controls */
  .oc-nav {
    margin-top: 32px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 32px;
  }
  .oc-nav__buttons { display: flex; gap: 12px; }
  .oc-nav__btn {
    width: 56px; height: 56px;
    border: 1px solid var(--forest);
    background: transparent;
    color: var(--forest);
    border-radius: 50%;
    cursor: pointer;
    font-family: var(--serif);
    font-style: italic;
    font-size: 22px;
    display: grid;
    place-items: center;
    transition: background 0.2s, color 0.2s;
    padding: 0;
  }
  .oc-nav__btn:hover { background: var(--forest); color: var(--cream); }
  .oc-nav__btn:disabled { opacity: 0.3; cursor: default; background: transparent; color: var(--forest); }
  .oc-nav__progress {
    flex: 1;
    height: 1px;
    background: var(--line);
    position: relative;
    max-width: 360px;
  }
  .oc-nav__progress .fill {
    position: absolute;
    top: -1px; left: 0;
    height: 3px;
    background: var(--forest);
    transition: width 0.3s ease, transform 0.3s ease;
    width: 30%;
  }
  .oc-nav__count {
    font-family: var(--mono);
    font-size: 12px;
    letter-spacing: 0.16em;
    color: var(--forest);
    white-space: nowrap;
  }
  .oc-nav__count strong { font-family: var(--serif); font-style: italic; font-size: 18px; color: var(--ink); letter-spacing: -0.005em; }

  /* Reservation CTA */
  .book {
    background: var(--cream);
    padding: clamp(80px, 12vw, 160px) var(--rail);
    text-align: center;
  }
  .book .inner { max-width: 900px; margin: 0 auto; }
  .book h2 {
    font-family: var(--serif);
    font-style: italic;
    font-size: clamp(56px, 9vw, 132px);
    line-height: 0.95;
    margin: 16px 0 32px;
    letter-spacing: -0.025em;
  }
  .book h2 .cn {
    font-family: var(--cn);
    font-style: normal;
    display: block;
    font-size: 0.3em;
    color: var(--forest);
    letter-spacing: 0.3em;
    margin-top: 16px;
  }
  .book p { color: var(--ink-soft); max-width: 50ch; margin: 0 auto 40px; }
  .book__buttons { display: flex; gap: 16px; justify-content: center; flex-wrap: wrap; }

  /* Cinematic dark band — section break between Generations and Charity */
  .cinema-break {
    position: relative;
    min-height: 78vh;
    overflow: hidden;
    display: grid;
    place-items: center;
    background:
      radial-gradient(ellipse at 50% 60%, rgba(196, 177, 138, 0.22) 0%, transparent 55%),
      radial-gradient(ellipse at 30% 30%, rgba(196, 177, 138, 0.08) 0%, transparent 40%),
      linear-gradient(180deg, #1a1410 0%, #2a1f15 45%, #14181a 100%);
    color: #EBDFC4;
    padding: 120px var(--rail);
  }
  .cinema-break::before {
    content: "";
    position: absolute; inset: 0;
    background: radial-gradient(ellipse at center, transparent 30%, rgba(0,0,0,0.55) 100%);
    pointer-events: none;
  }
  .cinema-break::after {
    /* film grain */
    content: "";
    position: absolute; inset: 0;
    background-image: url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='240' height='240'><filter id='n'><feTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='3' stitchTiles='stitch'/><feColorMatrix values='0 0 0 0 0.9 0 0 0 0 0.85 0 0 0 0 0.65 0 0 0 0.1 0'/></filter><rect width='100%' height='100%' filter='url(%23n)'/></svg>");
    mix-blend-mode: overlay;
    opacity: 0.35;
    pointer-events: none;
  }
  /* steam wisps */
  .cinema-break .steam {
    position: absolute;
    inset: auto 0 0 0;
    height: 60%;
    pointer-events: none;
    z-index: 1;
  }
  .cinema-break .steam span {
    position: absolute;
    bottom: 20%;
    width: 260px; height: 260px;
    border-radius: 50%;
    background: radial-gradient(circle, rgba(235, 223, 196, 0.18) 0%, transparent 60%);
    filter: blur(20px);
    animation: cinema-rise 9s ease-in-out infinite;
  }
  .cinema-break .steam span:nth-child(1) { left: 38%; animation-delay: 0s; }
  .cinema-break .steam span:nth-child(2) { left: 50%; animation-delay: 2.6s; width: 300px; height: 300px; }
  .cinema-break .steam span:nth-child(3) { left: 60%; animation-delay: 5.2s; }
  @keyframes cinema-rise {
    0%   { transform: translateY(0) scale(0.8); opacity: 0; }
    25%  { opacity: 0.55; }
    100% { transform: translateY(-260px) scale(1.6); opacity: 0; }
  }
  .cinema-break__inner {
    position: relative;
    z-index: 2;
    max-width: 1100px;
    text-align: center;
  }
  .cinema-break__top {
    font-family: var(--mono);
    font-size: 12px;
    letter-spacing: 0.32em;
    text-transform: uppercase;
    color: rgba(235, 223, 196, 0.6);
    margin-bottom: 40px;
  }
  .cinema-break__top .cn {
    font-family: var(--cn);
    margin-right: 14px;
    opacity: 0.85;
    letter-spacing: 0.5em;
  }
  .cinema-break p {
    font-family: var(--serif);
    font-style: italic;
    font-weight: 400;
    font-size: clamp(40px, 6vw, 92px);
    line-height: 1.1;
    margin: 0;
    color: #EBDFC4;
    letter-spacing: -0.005em;
    text-wrap: balance;
    text-shadow: 0 2px 32px rgba(0, 0, 0, 0.55);
  }
  .cinema-break p em { color: #c4b18a; }
  .cinema-break p .cn-line {
    font-family: var(--cn);
    font-style: normal;
    font-weight: 400;
    letter-spacing: 0.04em;
    display: block;
    font-size: 0.55em;
    margin-top: 32px;
    opacity: 0.85;
  }
  .cinema-break__foot {
    margin-top: 56px;
    font-family: var(--mono);
    font-size: 12px;
    letter-spacing: 0.32em;
    text-transform: uppercase;
    color: rgba(235, 223, 196, 0.55);
  }

  @media (max-width: 980px) {
    .hero-a, .anchor, .gens, .charity__inner { grid-template-columns: 1fr; gap: 48px; }
    .charity__stats { grid-template-columns: 1fr 1fr; gap: 24px; }
    .outlets__head, .sigs__head { flex-direction: column; align-items: start; }
    .oc-nav__progress { display: none; }
  }

  /* ============== Menu flipbook modal ============== */
  .menu-modal {
    position: fixed;
    inset: 0;
    z-index: 9999;
    display: none;
    align-items: center;
    justify-content: center;
  }
  .menu-modal.is-open { display: flex; }
  .menu-modal__backdrop {
    position: absolute;
    inset: 0;
    background: rgba(20, 16, 10, 0.94);
    backdrop-filter: blur(4px);
    -webkit-backdrop-filter: blur(4px);
    cursor: pointer;
    animation: menuModalFade 0.3s ease;
  }
  @keyframes menuModalFade {
    from { opacity: 0; }
    to   { opacity: 1; }
  }
  .menu-modal__inner {
    position: relative;
    z-index: 1;
    width: 100%;
    max-width: 1200px;
    height: 100%;
    max-height: 92vh;
    padding: clamp(20px, 4vw, 56px) clamp(12px, 2vw, 24px);
    display: flex;
    align-items: center;
    justify-content: center;
  }
  .menu-modal__close {
    position: absolute;
    top: clamp(12px, 2vw, 28px);
    right: clamp(12px, 2vw, 28px);
    width: 48px; height: 48px;
    border-radius: 50%;
    border: 1px solid rgba(243, 234, 217, 0.32);
    background: rgba(243, 234, 217, 0.06);
    color: #F3EAD9;
    font-size: 24px;
    font-family: var(--mono);
    line-height: 1;
    cursor: pointer;
    display: grid;
    place-items: center;
    padding: 0;
    z-index: 3;
    transition: background 0.2s ease, transform 0.2s ease;
  }
  .menu-modal__close:hover {
    background: rgba(243, 234, 217, 0.18);
    transform: scale(1.05);
  }
  .menu-modal__book {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
  }
  .menu-page {
    background: var(--paper);
    overflow: hidden;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.35);
  }
  .menu-page canvas {
    display: block;
    width: 100% !important;
    height: 100% !important;
  }
  .menu-book__status {
    color: #F3EAD9;
    font-family: var(--serif);
    font-size: 18px;
    text-align: center;
    padding: 80px 32px;
    opacity: 0.85;
  }
  .menu-book__status a {
    color: #C49B66;
    border-bottom: 1px solid currentColor;
    padding-bottom: 1px;
  }
  body.menu-modal-open { overflow: hidden; }
</style>

<!-- ============== HERO ============== -->
<section class="hero-a">
  <h1 class="sr-only">
    <span data-en>Hakshan · Hakka cooking, three generations, thirteen kitchens in Malaysia.</span>
    <span data-zh>客善 · 三代人的客家菜，十三家厨房，遍布马来西亚。</span>
  </h1>
  <div class="hero-a__logo" data-reveal>
    <img src="<?php echo esc_url( get_theme_file_uri( 'assets/brand/hakshan-logo-ground.png' ) ); ?>" alt="Hakshan 客善 · 三代人的传承" />
  </div>
  <div class="hero-a__scroll" aria-hidden="true">
    <span data-en>SCROLL</span>
    <span data-zh>下滑</span>
  </div>
</section>

<?php if ( hakshan_show_section( 'hakshan_show_three_gens' ) ) : ?>
<!-- ============== THREE GENERATIONS (sticky stack) ============== -->
<section class="kitchens">
  <div class="kitchens__inner">
    <aside class="kitchens__copy" data-reveal>
      <span class="h-eyebrow"><span class="dot"></span>
        <span data-en>OUR STORY</span><span data-zh>我们的故事</span>
      </span>
      <h2>
        <span data-en>Three Generations,<br/><em>One Recipe.</em></span>
        <span data-zh>三代人，<br/><em>一菜谱。</em></span>
      </h2>
      <p>
        <span data-en>Since 1928, the recipes have moved through three generations and countless family tables.</span>
        <span data-zh>自 1928 年起，同一份食谱穿过三代人，走过无数张家中的餐桌。</span>
      </p>
      <p>
        <span data-en>Same recipes. Different generations. Still cooked the same way.</span>
        <span data-zh>食谱不变，传承不息，做法如初。</span>
      </p>
      <a class="btn btn--ghost" href="<?php echo esc_url( hakshan_nav_url( 'story' ) ); ?>">
        <span data-en>Explore our story</span><span data-zh>阅读完整故事</span>
        <span class="arr">→</span>
      </a>
    </aside>

    <div class="kitchens__stack">
      <article class="kitchen" data-reveal>
        <div class="kitchen__photo">
          <img src="https://hakshan.com/wp-content/uploads/2026/06/gen-1928.png" alt="The first generation — ancestral village kitchen, 1928" loading="lazy" />
        </div>
        <div class="kitchen__text">
          <div class="kitchen__year">1928</div>
          <h3><span data-en>The First Kitchen</span><span data-zh>第一间厨房</span></h3>
          <p>
            <span data-en>A grandmother cooking over firewood in the ancestral village.</span>
            <span data-zh>祖屋里，祖母在柴火灶前下厨。</span>
          </p>
          <p>
            <span data-en>Nothing was written down. The recipes lived in her hands.</span>
            <span data-zh>食谱一字未落于纸——只在她手上。</span>
          </p>
        </div>
      </article>

      <article class="kitchen" data-reveal>
        <div class="kitchen__photo">
          <img src="https://hakshan.com/wp-content/uploads/2026/06/gen-1972.png" alt="The second generation — Klang Valley kitchen, 1972" loading="lazy" />
        </div>
        <div class="kitchen__text">
          <div class="kitchen__year">1972</div>
          <h3><span data-en>The Second Kitchen</span><span data-zh>第二间厨房</span></h3>
          <p>
            <span data-en>The family arrives in Malaysia.</span>
            <span data-zh>家人南下马来西亚。</span>
          </p>
          <p>
            <span data-en>The dishes leave home for the first time, serving customers in the Klang Valley.</span>
            <span data-zh>家中的菜第一次走出家门，在巴生谷招待客人。</span>
          </p>
          <p>
            <span data-en>Same recipes, sharpened by service.</span>
            <span data-zh>食谱不变，在餐桌上越做越精。</span>
          </p>
        </div>
      </article>

      <article class="kitchen" data-reveal>
        <div class="kitchen__photo">
          <img src="https://hakshan.com/wp-content/uploads/2026/06/gen-2024.png" alt="The third generation — Hakshan USJ, 2024" loading="lazy" />
        </div>
        <div class="kitchen__text">
          <div class="kitchen__year">2024</div>
          <h3><span data-en>The Third Kitchen</span><span data-zh>第三间厨房</span></h3>
          <p>
            <span data-en>Hakshan opens its dining rooms.</span>
            <span data-zh>客善的门店一间间打开。</span>
          </p>
          <p>
            <span data-en>Same recipes. More tables. More families.</span>
            <span data-zh>食谱不变，桌子更多，家人更多。</span>
          </p>
        </div>
      </article>
    </div>
  </div>
</section>
<?php endif; ?>

<?php if ( hakshan_show_section( 'hakshan_show_signatures' ) ) : ?>
<!-- ============== SIGNATURES CAROUSEL ============== -->
<section class="section sigs">
  <div class="sigs__head">
    <div data-reveal>
      <span class="h-eyebrow"><span class="dot"></span>
        <span data-en>SIGNATURES</span><span data-zh>招牌菜单</span>
      </span>
      <h2>
        <span data-en>What we <em>cook</em>.</span>
        <span data-zh>我们做的<em>菜</em>。</span>
      </h2>
      <p class="h-body" style="max-width: 50ch; margin-top: 20px;">
        <span data-en>Hakka signature dishes. Salt-cured, slow-braised, cooked the same way since 1928.</span>
        <span data-zh>客家招牌菜。盐渍、慢炖，1928年至今做法未变。</span>
      </p>
    </div>
    <a class="btn btn--ghost" href="<?php echo esc_url( hakshan_nav_url( 'menu' ) ); ?>" data-reveal data-menu-modal-trigger>
      <span data-en>Full menu</span><span data-zh>完整菜单</span>
      <span class="arr">→</span>
    </a>
  </div>

  <div class="sigs__carousel-wrap" data-reveal>
    <div class="sigs__viewport" id="scViewport">
      <div class="sigs__carousel" id="scCarousel">
        <?php
        $menu_url   = hakshan_nav_url( 'menu' ) . '#signatures';
      $signatures = function_exists( 'hakshan_get_signature_dishes' ) ? hakshan_get_signature_dishes( 6 ) : array();

      if ( ! empty( $signatures ) ) :
        foreach ( $signatures as $sig_post ) :
          $s = hakshan_get_dish_data( $sig_post->ID );
          ?>
        <a class="sc-card" href="<?php echo esc_url( $menu_url ); ?>">
          <div class="sc-card__visual"><?php if ( $s['image_html'] ) : echo $s['image_html']; else : ?><div class="ph" data-label="<?php echo esc_attr( $s['label'] ); ?>"></div><?php endif; ?></div>
          <div class="sc-card__body">
            <h3><span data-en><?php echo esc_html( $s['en'] ); ?></span><span data-zh><?php echo esc_html( $s['zh'] ); ?></span></h3>
            <p><span data-en><?php echo esc_html( $s['desc_en'] ); ?></span>
              <span data-zh><?php echo esc_html( $s['desc_zh'] ); ?></span></p>
          </div>
        </a>
        <?php endforeach;
      else :
        // Fallback before the seeder has populated the CPT.
        $signatures_fallback = array(
          array( 'label' => 'hakka three-cup chicken · clay pot', 'en' => 'Hakka Three-Cup Chicken', 'zh' => '客 家 三 杯 鸡', 'cn' => '三 杯 鸡', 'desc_en' => 'Rice wine, soy, sesame oil. Equal parts, in a clay pot.', 'desc_zh' => '米 酒、生 抽、麻 油 等 量，砂 锅 同 焗。' ),
          array( 'label' => 'mui choy kau yuk · braised pork belly', 'en' => 'Mui Choy Pork Belly', 'zh' => '梅 菜 扣 肉', 'cn' => '梅 菜 扣 肉', 'desc_en' => 'Five-spice belly steamed with pickled mustard greens, in the family tradition.', 'desc_zh' => '五 香 三 层 肉，与 家 中 自 腌 的 梅 干 菜 同 蒸。' ),
          array( 'label' => 'abacus seeds · suan pan zi', 'en' => 'Abacus Seeds', 'zh' => '算 盘 子', 'cn' => '算 盘 子', 'desc_en' => 'Taro and tapioca, pinched by hand. Chewy at the centre, savoury at the edge.', 'desc_zh' => '芋 头 与 木 薯，一 颗 颗 手 捏，中 心 软 糯，边 缘 咸 香。' ),
          array( 'label' => 'lei cha · thunder tea rice', 'en' => 'Thunder Tea Rice', 'zh' => '擂 茶 饭', 'cn' => '擂 茶 饭', 'desc_en' => 'Twelve herbs, ground in a wooden mortar. A bowl that drinks like a meal.', 'desc_zh' => '十 二 种 香 草，杵 臼 现 磨。一 碗 茶，也 是 一 顿 饭。' ),
          array( 'label' => 'ginger-sprout braised duck', 'en' => 'Ginger-Sprout Duck', 'zh' => '姜 芽 焖 鸭', 'cn' => '姜 芽 焖 鸭', 'desc_en' => 'Three hours on low flame, young ginger sprouts, dark caramel sauce.', 'desc_zh' => '三 小 时 慢 火，姜 芽 爆 香，老 抽 收 汁。' ),
          array( 'label' => 'rice-wine chicken soup · clay pot', 'en' => 'Rice-Wine Chicken Soup', 'zh' => '糯 米 酒 鸡 汤', 'cn' => '糯 米 酒 鸡 汤', 'desc_en' => 'Glutinous rice wine, kampung chicken, ginger, sesame oil.', 'desc_zh' => '糯 米 酒、甘 榜 鸡、老 姜、麻 油。' ),
        );
        foreach ( $signatures_fallback as $s ) :
          ?>
        <a class="sc-card" href="<?php echo esc_url( $menu_url ); ?>">
          <div class="sc-card__visual"><div class="ph" data-label="<?php echo esc_attr( $s['label'] ); ?>"></div></div>
          <div class="sc-card__body">
            <h3><span data-en><?php echo esc_html( $s['en'] ); ?></span><span data-zh><?php echo esc_html( $s['zh'] ); ?></span></h3>
            <p><span data-en><?php echo esc_html( $s['desc_en'] ); ?></span>
              <span data-zh><?php echo esc_html( $s['desc_zh'] ); ?></span></p>
          </div>
        </a>
        <?php endforeach;
      endif;
      ?>
      </div>
    </div>

    <button class="sigs__side-btn sigs__side-btn--prev" id="scPrev" aria-label="Previous dish">←</button>
    <button class="sigs__side-btn sigs__side-btn--next" id="scNext" aria-label="Next dish">→</button>
  </div>
</section>
<?php endif; ?>

<?php if ( hakshan_show_section( 'hakshan_show_cinema' ) ) : ?>
<!-- ============== CINEMATIC BREAK ============== -->
<section class="cinema-break">
  <div class="steam" aria-hidden="true"><span></span><span></span><span></span></div>
  <div class="cinema-break__inner" data-reveal>
    <div class="cinema-break__top">
      <span class="cn">慢 火</span>
      <span data-en>SLOW FIRE, LONG SIMMER</span>
      <span data-zh>慢 火 细 炖</span>
    </div>
    <p>
      <span data-en>Some dishes <em>take their time.</em><br/>That's how Hakka cooking<br/><em>has always been done.</em></span>
      <span data-zh>有些菜，<em>急 不 得。</em><br/>客 家 菜，<br/><em>向 来 如 此。</em></span>
      <span class="cn-line">慢 火 细 炖 · 自 1928</span>
    </p>
    <div class="cinema-break__foot">
      <span data-en>↓ DINING WITH PURPOSE ↓</span>
      <span data-zh>↓ 用餐即行善 ↓</span>
    </div>
  </div>
</section>
<?php endif; ?>

<?php if ( hakshan_show_section( 'hakshan_show_charity' ) ) : ?>
<!-- ============== CHARITY ============== -->
<section class="charity">
  <div class="charity__inner">
    <div data-reveal>
      <span class="h-eyebrow"><span class="dot"></span>
        <span data-en>DINING WITH PURPOSE</span><span data-zh>用餐慈善</span>
      </span>
      <h2>
        <span data-en>Pay it<br/><em class="underline">Forward</em>.</span>
        <span data-zh>一菜<br/>一<em class="underline">善</em>。</span>
      </h2>
    </div>
    <div data-reveal>
      <p>
        <span data-en>Part of every sale at every outlet goes to community causes. Same rule, every kitchen, every day.</span>
        <span data-zh>每一家门店，每一笔营业额的一部分，拨入社区用途。同一条规则，每一天。</span>
      </p>
      <div class="charity__stats">
      <div>
        <div class="num">9</div>
        <div class="lbl"><span data-en>Outlets giving</span><span data-zh>参 与 门 店</span></div>
      </div>
      <div>
        <div class="num">3</div>
        <div class="lbl"><span data-en>Focus areas · education, elders, animals</span><span data-zh>三 个 方 向 · 教 育、长 者、动 物</span></div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php endif; ?>

<?php if ( hakshan_show_section( 'hakshan_show_outlets_home' ) ) : ?>
<!-- ============== OUTLETS ============== -->
<section class="section">
  <div class="outlets">
    <div class="outlets__head" data-reveal>
      <div>
        <span class="h-eyebrow"><span class="dot"></span>
          <span data-en>VISIT US</span><span data-zh>到访</span>
        </span>
        <h2>
          <span data-en>Nine<br/><em>kitchens.</em></span>
          <span data-zh>九间<br/><em>厨房。</em></span>
        </h2>
      </div>
      <a class="btn btn--ghost" href="<?php echo esc_url( hakshan_nav_url( 'outlets' ) ); ?>">
        <span data-en>All outlets &amp; map</span><span data-zh>所有门店与地图</span>
        <span class="arr">→</span>
      </a>
    </div>
    <div class="outlets__carousel-wrap" data-reveal>
      <div class="outlets__carousel" id="ocCarousel">
        <?php
        $outlets_url      = hakshan_nav_url( 'outlets' );
        $outlet_post_list = function_exists( 'hakshan_get_outlets' ) ? hakshan_get_outlets() : array();

        if ( ! empty( $outlet_post_list ) ) :
          foreach ( $outlet_post_list as $outlet_post ) :
            $o = hakshan_get_outlet_data( $outlet_post->ID );
            $city_display = $o['city'] ? ucwords( strtolower( $o['city'] ) ) : '';
            ?>
            <a class="oc-card" href="<?php echo esc_url( $outlets_url . '#' . $o['slug'] ); ?>">
              <div class="oc-card__visual"><?php if ( ! empty( $o['image_html'] ) ) : echo $o['image_html']; else : ?><div class="ph" data-label="<?php echo esc_attr( $o['label'] ); ?>"></div><?php endif; ?></div>
              <div class="oc-card__body">
                <div class="oc-card__head">
                  <h3><?php echo esc_html( $o['name'] ); ?></h3>
                  <span class="arr" aria-hidden="true">&rarr;</span>
                </div>
                <div class="city"><?php echo esc_html( $city_display ); ?></div>
              </div>
            </a>
          <?php endforeach;
        else :
          $outlets_fallback = array(
            array( 'slug' => 'usj',       'label' => 'USJ Taipan · main dining hall', 'name' => 'USJ Taipan',     'city' => 'Subang Jaya' ),
            array( 'slug' => 'menjalara', 'label' => 'Menjalara · entrance',          'name' => 'Menjalara',      'city' => 'Kepong' ),
            array( 'slug' => 'cheras',    'label' => 'Cheras Traders · open kitchen', 'name' => 'Cheras Traders', 'city' => 'Cheras' ),
            array( 'slug' => 'puchong',   'label' => 'Bandar Puteri · dining hall',   'name' => 'Bandar Puteri',  'city' => 'Puchong' ),
            array( 'slug' => 'conezion',  'label' => 'IOI Conezion · terrace',        'name' => 'IOI Conezion',   'city' => 'Putrajaya' ),
            array( 'slug' => 'kajang',    'label' => 'Budiman Park · entrance',       'name' => 'Budiman Park',   'city' => 'Kajang' ),
            array( 'slug' => 'kiara',     'label' => 'Arcoris Mont Kiara · main hall','name' => 'Arcoris Plaza',  'city' => 'Mont Kiara' ),
            array( 'slug' => 'parkcity',  'label' => 'The Waterfront · evening service','name' => 'The Waterfront','city' => 'Desa ParkCity' ),
            array( 'slug' => 'arkadia',   'label' => 'Plaza Arkadia · open kitchen',  'name' => 'Plaza Arkadia',  'city' => 'Desa ParkCity' ),
          );
          foreach ( $outlets_fallback as $o ) :
            ?>
            <a class="oc-card" href="<?php echo esc_url( $outlets_url . '#' . $o['slug'] ); ?>">
              <div class="oc-card__visual"><div class="ph" data-label="<?php echo esc_attr( $o['label'] ); ?>"></div></div>
              <div class="oc-card__body">
                <div class="oc-card__head">
                  <h3><?php echo esc_html( $o['name'] ); ?></h3>
                  <span class="arr" aria-hidden="true">&rarr;</span>
                </div>
                <div class="city"><?php echo esc_html( $o['city'] ); ?></div>
              </div>
            </a>
          <?php endforeach;
        endif;
        ?>
      </div>

      <div class="oc-nav">
        <div class="oc-nav__count">
          <strong id="ocCount">1</strong>
          <span> / <?php echo esc_html( ! empty( $outlet_post_list ) ? count( $outlet_post_list ) : count( $outlets_fallback ) ); ?></span>
        </div>
        <div class="oc-nav__progress"><div class="fill" id="ocFill"></div></div>
        <div class="oc-nav__buttons">
          <button class="oc-nav__btn" id="ocPrev" aria-label="Previous">←</button>
          <button class="oc-nav__btn" id="ocNext" aria-label="Next">→</button>
        </div>
      </div>
    </div>
  </div>
</section>
<?php endif; ?>

<?php if ( hakshan_show_section( 'hakshan_show_gallery' ) ) : ?>
<!-- ============== GALLERY ============== -->
<section class="section">
  <div style="max-width: var(--maxw); margin: 0 auto 56px;" data-reveal>
    <span class="h-eyebrow"><span class="dot"></span>
      <span data-en>ATMOSPHERE</span><span data-zh>空间</span>
    </span>
    <h2 style="font-family: var(--serif); font-style: italic; font-size: clamp(40px, 6vw, 80px); line-height: 1; margin: 12px 0 0; letter-spacing: -0.02em; max-width: 14ch;">
      <span data-en>Wood, paper,<br/>warm light, <em>low voices.</em></span>
      <span data-zh>木、纸、<br/>暖光、<em>轻声。</em></span>
    </h2>
  </div>
  <div class="gallery" data-reveal>
    <div class="g-tile g1">
      <img src="/wp-content/uploads/2026/06/hf_20260614_163317_1f8b7b31-da36-4b26-baf9-ab98396f6d1b-scaled.png"
           alt="Hakshan dining room with light oak tables, wishbone chairs, dried wheat sprays in vases, and large daylit windows"
           loading="lazy"/>
    </div>
    <div class="g-tile g2">
      <img src="/wp-content/uploads/2026/06/SaveClip.App_476275457_122213662208196129_979495312290091736_n.jpg"
           alt="A guest at a Hakshan table reading the menu booklet over a small Hakka dish, chopsticks, and sauces"
           loading="lazy"/>
    </div>
    <div class="g-tile g3">
      <img src="/wp-content/uploads/2026/06/SaveClip.App_473719755_122209079966196129_8098557174058037329_n.jpg"
           alt="An elderly diner eating a Hakshan Hakka set meal, taken in close portrait"
           loading="lazy"/>
    </div>
    <div class="g-tile g4">
      <img src="/wp-content/uploads/2026/06/659576500_17944366659157266_2923855057428786443_n.jpg"
           alt="Yellow Hakka stir-fried egg noodles airborne above a carbon-steel wok over a bright orange flame"
           loading="lazy"/>
    </div>
    <div class="g-tile g5">
      <img src="/wp-content/uploads/2026/06/SaveClip.App_471764503_122205621596196129_8892444678232792210_n.jpg"
           alt="A Hakshan chef in a cap and dark apron working at the open-kitchen wok station, flame visible"
           loading="lazy"/>
    </div>
    <div class="g-tile g6">
      <img src="/wp-content/uploads/2026/06/SaveClip.App_476383046_122213662124196129_8518853883524923681_n.jpg"
           alt="A long oak Hakshan dining table set for shared dining, surrounded by wishbone chairs, with a dried wheat spray on the wall ledge"
           loading="lazy"/>
    </div>
  </div>
</section>
<?php endif; ?>

<?php
// TEMPORARY: hide the 'Pull up a chair' Reserve a Table section on
// the homepage. Flip $hakshan_show_reserve_cta_force back to true to
// hand control back to the Customizer toggle.
$hakshan_show_reserve_cta_force = false;
if ( $hakshan_show_reserve_cta_force && hakshan_show_section( 'hakshan_show_reserve_cta' ) ) : ?>
<!-- ============== BOOK ============== -->
<section class="book" id="book">
  <div class="inner" data-reveal>
    <span class="h-eyebrow"><span class="dot"></span>
      <span data-en>RESERVE A TABLE</span><span data-zh>预订座位</span>
    </span>
    <h2>
      <span data-en>Pull up<br/><em>a chair.</em></span>
      <span data-zh>来 坐<br/><em>一 坐。</em></span>
      <span class="cn" data-en>客来茶当酒</span>
    </h2>
    <p>
      <span data-en>Walk-ins welcome at every outlet. For parties of six or more, private rooms, or signature dishes that need pre-ordering, please book ahead.</span>
      <span data-zh>所有门店欢迎散客。六人以上、包房，或须提前预订的招牌菜，请来电预约。</span>
    </p>
    <div class="book__buttons">
      <a class="btn" href="<?php echo esc_url( hakshan_nav_url( 'contact' ) . '#reserve' ); ?>"><span data-en>Reserve online</span><span data-zh>在线预订</span><span class="arr">→</span></a>
      <a class="btn btn--ghost" href="tel:+60162462970"><span data-en>Call +60 16-246 2970</span><span data-zh>致电 +60 16-246 2970</span></a>
    </div>
  </div>
</section>
<?php endif; ?>

<script>
  // Generic carousel — wires up any [track, prev, next, fill, count] quartet
  function initCarousel(trackId, prevId, nextId, fillId, countId) {
    const track = document.getElementById(trackId);
    const prev = document.getElementById(prevId);
    const next = document.getElementById(nextId);
    const fill = document.getElementById(fillId);
    const count = document.getElementById(countId);
    if (!track) return;
    const cards = track.children;
    function step() {
      const card = cards[0];
      const style = getComputedStyle(track);
      const gap = parseFloat(style.gap) || 24;
      return card.getBoundingClientRect().width + gap;
    }
    function update() {
      const s = step();
      const idx = Math.round(track.scrollLeft / s);
      const max = Math.max(1, cards.length - 1);
      const pct = Math.min(100, (idx / max) * 100);
      if (fill) fill.style.width = Math.max(10, pct) + "%";
      if (count) count.textContent = (idx + 1).toString().padStart(2, "0");
      if (prev) prev.disabled = track.scrollLeft <= 4;
      if (next) next.disabled = track.scrollLeft + track.clientWidth >= track.scrollWidth - 4;
    }
    if (prev) prev.addEventListener("click", () => track.scrollBy({ left: -step(), behavior: "smooth" }));
    if (next) next.addEventListener("click", () => track.scrollBy({ left: step(), behavior: "smooth" }));
    track.addEventListener("scroll", update, { passive: true });
    window.addEventListener("resize", update);
    update();
  }
  initCarousel("ocCarousel", "ocPrev", "ocNext", "ocFill", "ocCount");

  // Transform-based infinite slider for the signatures carousel.
  //   - No native overflow scrolling. The track's translateX is the
  //     single source of truth; we animate it ourselves.
  //   - Clones the full set of cards once at the start and once at the
  //     end, then wraps `offset` so it lives in [setW, 2*setW). When
  //     the user crosses a boundary, we silently shift offset by setW.
  //     Because clones look identical, the loop is seamless.
  //   - Pointer-event drag (mouse + touch + pen) updates offset
  //     directly during the gesture; velocity is captured for a small
  //     momentum throw on release.
  //   - Prev/Next animate target by one card-step. Each click queues a
  //     new target, so spamming the button advances repeatedly.
  //   - Curve effect: each card's translateY + rotate is computed from
  //     its distance to the viewport centre, applied on every tick.
  function initSlider(viewportId, trackId, prevId, nextId, opts) {
    const viewport = document.getElementById(viewportId);
    const track    = document.getElementById(trackId);
    if (!viewport || !track) return;

    const originals = Array.from(track.children);
    const N = originals.length;
    if (N < 2) return;

    const MAX_ROT  = (opts && opts.rot)  != null ? opts.rot  : 7;
    const MAX_DROP = (opts && opts.drop) != null ? opts.drop : 22;
    const EASE     = 0.18;        // approach rate per frame for the smooth animation
    const DRAG_THRESH = 6;        // px before a pointerdown counts as a drag

    // Clone the full set once at the end and once at the start.
    for (let i = 0; i < N; i++) {
      const c = originals[i].cloneNode(true);
      c.setAttribute("aria-hidden", "true");
      track.appendChild(c);
    }
    for (let i = N - 1; i >= 0; i--) {
      const c = originals[i].cloneNode(true);
      c.setAttribute("aria-hidden", "true");
      track.insertBefore(c, track.firstChild);
    }
    const cards = Array.from(track.children); // 3N cards

    // Native link-drag and image-drag steal pointer events from us.
    // Belt + braces: kill the draggable attribute on every image, set
    // the card's own draggable to false. CSS handles the rest.
    cards.forEach(card => {
      card.setAttribute("draggable", "false");
      card.querySelectorAll("img").forEach(img => {
        img.setAttribute("draggable", "false");
      });
    });

    let cardW = 0, gap = 0, stepW = 0, setW = 0;
    let offset = 0;
    let target = 0;
    let rafId = null;

    function measure() {
      // Reset per-card transforms so getBoundingClientRect reads natural size.
      cards.forEach(c => { c.style.transform = "none"; });
      const f = cards[0];
      if (!f) return;
      const r = f.getBoundingClientRect();
      cardW = r.width;
      gap   = parseFloat(getComputedStyle(track).gap) || 24;
      stepW = cardW + gap;
      setW  = stepW * N;
    }

    function wrap(v) {
      if (setW <= 0) return v;
      while (v < setW)        v += setW;
      while (v >= setW * 2)   v -= setW;
      return v;
    }

    function applyCurve() {
      const vp = viewport.getBoundingClientRect();
      const vpCenter = vp.left + vp.width / 2;
      const reach = Math.max(1, vp.width / 2);
      for (let i = 0; i < cards.length; i++) {
        const r = cards[i].getBoundingClientRect();
        const cc = r.left + r.width / 2;
        const d  = Math.max(-1, Math.min(1, (cc - vpCenter) / reach));
        const rot = d * MAX_ROT;
        const drop = Math.abs(d) * MAX_DROP;
        cards[i].style.transform = "translateY(" + drop + "px) rotate(" + rot + "deg)";
      }
    }

    function render() {
      offset = wrap(offset);
      // Keep target wrapped relative to offset so it stays close (prevents
      // huge animation overshoots after long drags).
      while (target - offset > setW)  target -= setW;
      while (target - offset < -setW) target += setW;
      track.style.transform = "translate3d(" + (-offset) + "px, 0, 0)";
      applyCurve();
    }

    function tick() {
      const delta = target - offset;
      if (Math.abs(delta) < 0.5) {
        offset = target;
        render();
        rafId = null;
        return;
      }
      offset += delta * EASE;
      render();
      rafId = requestAnimationFrame(tick);
    }

    function animateTo(t) {
      target = t;
      if (rafId == null) rafId = requestAnimationFrame(tick);
    }

    // ---- Drag ----
    let dragging = false;
    let dragStartX = 0;
    let dragStartOffset = 0;
    let dragMoved = false;
    let lastMoveX = 0;
    let lastMoveT = 0;
    let velocity = 0;

    function onPointerDown(e) {
      if (e.pointerType === "mouse" && e.button !== 0) return;
      dragging = true;
      dragMoved = false;
      dragStartX = e.clientX;
      dragStartOffset = offset;
      lastMoveX = e.clientX;
      lastMoveT = performance.now();
      velocity = 0;
      if (rafId != null) { cancelAnimationFrame(rafId); rafId = null; }
      try { viewport.setPointerCapture(e.pointerId); } catch (_) {}
    }
    function onPointerMove(e) {
      if (!dragging) return;
      const dx = e.clientX - dragStartX;
      if (!dragMoved && Math.abs(dx) > DRAG_THRESH) {
        dragMoved = true;
        viewport.classList.add("is-dragging");
      }
      if (!dragMoved) return;
      const now = performance.now();
      offset = dragStartOffset - dx;
      render();
      const dt = Math.max(1, now - lastMoveT);
      velocity = (e.clientX - lastMoveX) / dt;
      lastMoveX = e.clientX;
      lastMoveT = now;
    }
    function onPointerEnd(e) {
      if (!dragging) return;
      const wasMoved = dragMoved;
      dragging = false;
      dragMoved = false;
      viewport.classList.remove("is-dragging");
      try { viewport.releasePointerCapture(e.pointerId); } catch (_) {}
      if (!wasMoved) return;
      // Momentum: throw a bit further based on velocity, then snap to nearest card.
      const throwDist = velocity * 220;
      let t = offset - throwDist;
      t = Math.round(t / stepW) * stepW;
      animateTo(t);
    }
    viewport.addEventListener("pointerdown",   onPointerDown);
    viewport.addEventListener("pointermove",   onPointerMove);
    viewport.addEventListener("pointerup",     onPointerEnd);
    viewport.addEventListener("pointercancel", onPointerEnd);
    viewport.addEventListener("pointerleave",  onPointerEnd);

    // Cancel the click that follows a drag so card links don't fire on release.
    viewport.addEventListener("click", e => {
      if (Math.abs(offset - dragStartOffset) > DRAG_THRESH) {
        e.preventDefault();
        e.stopPropagation();
      }
    }, true);

    // ---- Buttons ----
    const prevBtn = document.getElementById(prevId);
    const nextBtn = document.getElementById(nextId);
    if (prevBtn) prevBtn.addEventListener("click", () => animateTo(target - stepW));
    if (nextBtn) nextBtn.addEventListener("click", () => animateTo(target + stepW));

    // ---- Wheel (trackpad horizontal swipe) ----
    let wheelAccum = 0;
    let wheelTimer = null;
    viewport.addEventListener("wheel", e => {
      if (Math.abs(e.deltaX) < Math.abs(e.deltaY)) return;
      e.preventDefault();
      wheelAccum += e.deltaX;
      if (wheelTimer) clearTimeout(wheelTimer);
      wheelTimer = setTimeout(() => {
        const steps = Math.sign(wheelAccum) * Math.max(1, Math.round(Math.abs(wheelAccum) / stepW));
        animateTo(Math.round((target + steps * stepW) / stepW) * stepW);
        wheelAccum = 0;
      }, 80);
    }, { passive: false });

    // ---- Init + resize ----
    function init() {
      measure();
      if (setW <= 0) return;
      offset = setW;
      target = setW;
      render();
    }
    window.addEventListener("resize", () => {
      const prevSet = setW;
      measure();
      if (setW <= 0) return;
      // Preserve approximate card index across resize.
      const cardIdx = prevSet ? Math.round((offset - prevSet) / (prevSet / N)) : 0;
      offset = setW + cardIdx * stepW;
      target = offset;
      render();
    });

    // Wait one frame for layout (cloned cards + custom fonts).
    requestAnimationFrame(init);
  }
  initSlider("scViewport", "scCarousel", "scPrev", "scNext", { rot: 7, drop: 22 });

  // ============== Menu flipbook modal ==============
  // Opens a fullscreen modal containing a real page-flip menu, rendered
  // from a PDF via PDF.js + StPageFlip. Both libraries are lazy-loaded
  // the first time the modal is opened so the homepage's initial JS
  // payload stays small. The /menu/ page still works as a normal
  // fallback link (data-menu-modal-trigger preventDefault'd here, but
  // if JS fails the anchor href routes there normally).
  var HAKSHAN_MENU_PDF_URL = "https://hakshan.com/wp-content/uploads/2026/06/hakshan-menu.pdf";
  var __menuFlipbook = { loading: false, ready: false, instance: null };

  function loadFlipbookAssets() {
    if (window.pdfjsLib && window.St && window.St.PageFlip) return Promise.resolve();
    function loadScript(src) {
      return new Promise(function (resolve, reject) {
        var s = document.createElement("script");
        s.src = src;
        s.async = true;
        s.onload = resolve;
        s.onerror = function () { reject(new Error("Failed to load " + src)); };
        document.head.appendChild(s);
      });
    }
    return loadScript("https://cdnjs.cloudflare.com/ajax/libs/pdf.js/4.0.379/pdf.min.js")
      .then(function () {
        window.pdfjsLib.GlobalWorkerOptions.workerSrc = "https://cdnjs.cloudflare.com/ajax/libs/pdf.js/4.0.379/pdf.worker.min.js";
        return loadScript("https://cdn.jsdelivr.net/npm/page-flip@2.0.7/dist/js/page-flip.browser.js");
      });
  }

  async function buildFlipbook() {
    var bookEl = document.getElementById("menuBook");
    if (!bookEl) return;
    bookEl.innerHTML = '<div class="menu-book__status">Loading menu…</div>';
    try {
      var pdf = await window.pdfjsLib.getDocument(HAKSHAN_MENU_PDF_URL).promise;
      bookEl.innerHTML = "";
      // StPageFlip wants page elements pre-mounted in the container.
      var pageEls = [];
      // Render at 1.5x for sharp text without blowing up file size.
      var scale = 1.5;
      for (var i = 1; i <= pdf.numPages; i++) {
        var page = await pdf.getPage(i);
        var viewport = page.getViewport({ scale: scale });
        var canvas = document.createElement("canvas");
        var ctx = canvas.getContext("2d");
        canvas.width = viewport.width;
        canvas.height = viewport.height;
        await page.render({ canvasContext: ctx, viewport: viewport }).promise;
        var pageDiv = document.createElement("div");
        pageDiv.className = "menu-page";
        pageDiv.appendChild(canvas);
        bookEl.appendChild(pageDiv);
        pageEls.push(pageDiv);
      }
      // Aspect ratio derived from the rendered canvases.
      var firstCanvas = pageEls[0].querySelector("canvas");
      var ratio = firstCanvas.height / firstCanvas.width;
      var displayW = Math.min(600, Math.floor((window.innerWidth - 80) / 2));
      var displayH = Math.floor(displayW * ratio);
      __menuFlipbook.instance = new window.St.PageFlip(bookEl, {
        width: displayW,
        height: displayH,
        size: "stretch",
        minWidth: 280,
        maxWidth: 1000,
        minHeight: Math.floor(280 * ratio),
        maxHeight: Math.floor(1000 * ratio),
        maxShadowOpacity: 0.5,
        showCover: false,
        usePortrait: true,
        mobileScrollSupport: false,
        drawShadow: true,
        flippingTime: 800
      });
      __menuFlipbook.instance.loadFromHTML(bookEl.querySelectorAll(".menu-page"));
      __menuFlipbook.ready = true;
    } catch (e) {
      console.error(e);
      bookEl.innerHTML = '<div class="menu-book__status">Could not load the menu. <a href="/menu/">View the full menu page →</a></div>';
    }
  }

  function openMenuModal() {
    var modal = document.getElementById("menuModal");
    if (!modal) return;
    modal.classList.add("is-open");
    modal.setAttribute("aria-hidden", "false");
    document.body.classList.add("menu-modal-open");
    if (!__menuFlipbook.ready && !__menuFlipbook.loading) {
      __menuFlipbook.loading = true;
      loadFlipbookAssets()
        .then(buildFlipbook)
        .catch(function (err) {
          var bookEl = document.getElementById("menuBook");
          if (bookEl) bookEl.innerHTML = '<div class="menu-book__status">Could not load the menu. <a href="/menu/">View the full menu page →</a></div>';
          console.error(err);
        })
        .finally(function () { __menuFlipbook.loading = false; });
    }
  }
  function closeMenuModal() {
    var modal = document.getElementById("menuModal");
    if (!modal) return;
    modal.classList.remove("is-open");
    modal.setAttribute("aria-hidden", "true");
    document.body.classList.remove("menu-modal-open");
  }

  document.querySelectorAll("[data-menu-modal-trigger]").forEach(function (el) {
    el.addEventListener("click", function (e) {
      e.preventDefault();
      openMenuModal();
    });
  });
  document.querySelectorAll("[data-menu-close]").forEach(function (el) {
    el.addEventListener("click", closeMenuModal);
  });
  document.addEventListener("keydown", function (e) {
    if (e.key === "Escape") {
      var m = document.getElementById("menuModal");
      if (m && m.classList.contains("is-open")) closeMenuModal();
    }
  });
</script>

<!-- Menu flipbook modal — opened from any [data-menu-modal-trigger] element -->
<div class="menu-modal" id="menuModal" aria-hidden="true" role="dialog" aria-label="Hakshan menu">
  <div class="menu-modal__backdrop" data-menu-close></div>
  <div class="menu-modal__inner">
    <button class="menu-modal__close" data-menu-close aria-label="Close menu">×</button>
    <div class="menu-modal__book" id="menuBook"></div>
  </div>
</div>

<?php
get_footer();
