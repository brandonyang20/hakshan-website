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
    font-size: 10px;
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
  .sigs__carousel {
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
  .sigs__carousel::-webkit-scrollbar { display: none; }
  .sc-card {
    flex: 0 0 clamp(280px, 28vw, 360px);
    scroll-snap-align: start;
    background: var(--paper);
    border: 1px solid var(--line);
    display: grid;
    transition: background 0.3s ease, transform 0.3s ease;
    cursor: pointer;
  }
  .sc-card:hover { background: #fefcf7; transform: translateY(-4px); }
  .sc-card__visual {
    aspect-ratio: 4/5;
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
    font-size: 10px;
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
    font-size: 9px;
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
    font-size: 11px;
    color: var(--forest);
  }
  .sc-card__foot .arr {
    font-family: var(--serif);
    font-size: 22px;
    transition: transform 0.25s ease;
  }
  .sc-card:hover .sc-card__foot .arr { transform: translateX(6px); }

  /* Three Generations */
  .gens {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 80px;
    max-width: var(--maxw);
    margin: 0 auto;
    align-items: start;
  }
  .gens__copy h2 {
    font-family: var(--serif);
    font-style: italic;
    font-size: clamp(48px, 7vw, 96px);
    line-height: 0.95;
    margin: 16px 0 32px;
    letter-spacing: -0.025em;
  }
  .gens__timeline {
    display: grid;
    gap: 0;
  }
  .gen {
    padding: 32px 0;
    border-bottom: 1px solid var(--line);
    display: grid;
    grid-template-columns: 80px 1fr;
    gap: 32px;
    align-items: start;
  }
  .gen:last-child { border-bottom: none; }
  .gen__year {
    font-family: var(--mono);
    font-size: 12px;
    letter-spacing: 0.12em;
    color: var(--forest);
    padding-top: 6px;
  }
  .gen h3 {
    font-family: var(--serif);
    font-style: italic;
    font-size: 30px;
    margin: 0 0 8px;
    letter-spacing: -0.01em;
  }
  .gen p {
    margin: 0;
    font-size: 14px;
    line-height: 1.65;
    color: var(--ink-soft);
  }

  /* Charity band */
  .charity {
    background: var(--forest);
    color: var(--cream);
    padding: clamp(80px, 12vw, 140px) var(--rail);
    display: grid;
    grid-template-columns: 1fr 1.4fr;
    gap: 80px;
    align-items: center;
  }
  .charity__inner { max-width: var(--maxw); margin: 0 auto; display: contents; }
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
  .g1 { grid-column: 1 / 7;  grid-row: span 4; }
  .g2 { grid-column: 7 / 13; grid-row: span 3; }
  .g3 { grid-column: 7 / 10; grid-row: span 3; }
  .g4 { grid-column: 10 / 13; grid-row: span 3; }
  .g5 { grid-column: 1 / 5;  grid-row: span 2; }
  .g6 { grid-column: 5 / 13; grid-row: span 2; }

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
    font-size: 10px;
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
    font-size: 9px;
    letter-spacing: 0.18em;
    text-transform: uppercase;
    z-index: 2;
  }
  .oc-card h3 {
    font-family: var(--serif);
    font-style: italic;
    font-size: 26px;
    margin: 0 0 4px;
    letter-spacing: -0.01em;
  }
  .oc-card .city {
    font-family: var(--mono);
    font-size: 10px;
    letter-spacing: 0.18em;
    text-transform: uppercase;
    color: var(--forest);
    opacity: 0.75;
  }
  .oc-card .meta {
    margin-top: auto;
    padding-top: 14px;
    border-top: 1px solid var(--line);
    display: flex;
    justify-content: space-between;
    align-items: baseline;
    font-family: var(--mono);
    font-size: 11px;
    color: var(--ink-soft);
  }
  .oc-card .meta .arr {
    font-family: var(--serif);
    font-size: 22px;
    color: var(--forest);
    transition: transform 0.25s ease;
  }
  .oc-card:hover .meta .arr { transform: translateX(6px); }

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
    font-size: 11px;
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
    font-size: 11px;
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
    font-size: 10px;
    letter-spacing: 0.32em;
    text-transform: uppercase;
    color: rgba(235, 223, 196, 0.55);
  }

  @media (max-width: 980px) {
    .hero-a, .anchor, .gens, .charity { grid-template-columns: 1fr; gap: 48px; }
    .outlets__head, .sigs__head { flex-direction: column; align-items: start; }
    .oc-nav__progress { display: none; }
  }

  /* ------------------------------------------------------------------
     Scroll-pulled noodle bowl (between hero and gens)
     ------------------------------------------------------------------ */
  .noodles {
    --p: 0;
    position: relative;
    height: 220vh;
    background: var(--paper);
    border-top: 1px solid var(--line-soft);
    border-bottom: 1px solid var(--line-soft);
  }
  .noodles__sticky {
    position: sticky;
    top: 0;
    height: 100vh;
    overflow: hidden;
    display: grid;
    grid-template-columns: 1fr 1fr;
    align-items: center;
    padding: 0 var(--rail);
  }
  .noodles__copy {
    z-index: 4;
    max-width: 480px;
    justify-self: start;
    opacity: calc(0.15 + var(--p) * 0.85);
    transform: translateY(calc((1 - var(--p)) * 24px));
    transition: opacity 0.1s linear, transform 0.1s linear;
  }
  .noodles__copy .h-eyebrow { margin-bottom: 18px; }
  .noodles__copy h2 {
    font-family: var(--serif);
    font-style: italic;
    font-size: clamp(40px, 5.5vw, 76px);
    line-height: 1;
    margin: 0;
    letter-spacing: -0.025em;
  }
  .noodles__copy h2 em { color: var(--forest); }
  .noodles__copy p {
    margin: 24px 0 0;
    font-size: 16px;
    line-height: 1.7;
    color: var(--ink-soft);
    max-width: 38ch;
  }
  .noodles__copy .accent-cn {
    display: block;
    margin-top: 28px;
    font-family: var(--cn);
    font-size: 14px;
    letter-spacing: 0.5em;
    color: var(--mute);
  }

  .noodles__scene {
    position: relative;
    height: 100%;
    width: 100%;
    justify-self: end;
  }
  .noodles__scene .layer {
    position: absolute;
    left: 50%;
    pointer-events: none;
    color: var(--forest);
  }
  .noodles__scene .layer svg { display: block; width: 100%; height: auto; }
  .noodles__scene .layer-steam {
    width: 140px;
    margin-left: -70px;
    bottom: 56vh;
    opacity: calc(0.45 - var(--p) * 0.4);
    transform: translateY(calc(var(--p) * -120px));
  }
  .noodles__scene .layer-chops {
    width: 90px;
    margin-left: -45px;
    bottom: 32vh;
    z-index: 3;
    transform: translateY(calc(var(--p) * -260px));
  }
  .noodles__scene .layer-strands {
    width: 180px;
    margin-left: -90px;
    bottom: 24vh;
    transform-origin: 50% 100%;
    transform: scaleY(calc(1 + var(--p) * 2.2));
    z-index: 2;
  }
  .noodles__scene .layer-strands svg { vector-effect: non-scaling-stroke; }
  .noodles__scene .layer-strands svg * { vector-effect: non-scaling-stroke; }
  .noodles__scene .layer-bowl {
    width: 320px;
    margin-left: -160px;
    bottom: 16vh;
    z-index: 4;
    color: var(--ink);
  }
  .noodles__scene .layer-shadow {
    width: 280px;
    margin-left: -140px;
    bottom: calc(16vh - 6px);
    z-index: 1;
    color: rgba(42, 46, 39, 0.18);
  }

  @media (max-width: 900px) {
    .noodles { height: 200vh; }
    .noodles__sticky { grid-template-columns: 1fr; }
    .noodles__copy {
      justify-self: center;
      text-align: center;
      max-width: 100%;
      position: absolute;
      top: 7vh;
      left: 0; right: 0;
      padding: 0 var(--rail);
    }
    .noodles__copy p { margin-left: auto; margin-right: auto; }
    .noodles__scene { width: 100%; height: 100%; }
  }

  @media (prefers-reduced-motion: reduce) {
    .noodles { --p: 0.45; height: auto; }
    .noodles__sticky { position: relative; height: 80vh; }
    .noodles__scene .layer-chops { transform: translateY(-120px); }
    .noodles__scene .layer-strands { transform: scaleY(1.8); }
    .noodles__scene .layer-steam { transform: none; opacity: 0.35; }
    .noodles__copy { opacity: 1; transform: none; }
  }
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

<!-- ============== SCROLL-PULLED NOODLE BOWL ============== -->
<section class="noodles" id="noodles" aria-label="Hakka noodles, pulled long by hand">
  <div class="noodles__sticky">
    <div class="noodles__copy">
      <span class="h-eyebrow"><span class="dot"></span>
        <span data-en>BY HAND · PULLED LONG</span>
        <span data-zh>手 拉 · 不 断</span>
      </span>
      <h2>
        <span data-en>Pulled long,<br/><em>by hand.</em></span>
        <span data-zh>手 拉<br/><em>不 断。</em></span>
      </h2>
      <p>
        <span data-en>Hakka noodles, drawn out by chopstick and patience. The way they've been served at our table since 1928.</span>
        <span data-zh>客家面，用筷子与耐心一根一根拉长。从 1928 年起，我们家就这样吃。</span>
      </p>
      <span class="accent-cn">慢 火 · 长 寿 面</span>
    </div>

    <div class="noodles__scene" aria-hidden="true">
      <!-- Steam: drifts up, fades out -->
      <div class="layer layer-steam">
        <svg viewBox="0 0 140 220" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="1.4" stroke-linecap="round">
          <path d="M 40 210 C 28 160, 56 130, 38 70 C 30 45, 50 30, 44 8"/>
          <path d="M 72 215 C 86 170, 60 130, 80 80 C 92 56, 70 38, 84 12"/>
          <path d="M 102 210 C 92 165, 116 130, 100 78 C 90 52, 108 32, 96 8"/>
        </svg>
      </div>

      <!-- Chopsticks: tapered, tilted slightly -->
      <div class="layer layer-chops">
        <svg viewBox="0 0 90 320" xmlns="http://www.w3.org/2000/svg">
          <!-- Left chopstick -->
          <polygon points="22,8 30,8 44,310 40,310" fill="var(--forest)" />
          <!-- Right chopstick -->
          <polygon points="60,8 68,8 54,310 50,310" fill="#2A2E27" />
          <!-- Subtle highlight on each -->
          <line x1="24" y1="14" x2="42" y2="304" stroke="rgba(255,255,255,0.12)" stroke-width="1.2"/>
          <line x1="62" y1="14" x2="52" y2="304" stroke="rgba(255,255,255,0.10)" stroke-width="1.2"/>
        </svg>
      </div>

      <!-- Noodle strands: anchored at bowl rim, scaleY stretches them upward -->
      <div class="layer layer-strands">
        <svg viewBox="0 0 180 240" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-linecap="round" stroke-width="1.6">
          <path d="M 70 240 C 58 180, 86 130, 72 60 S 92 18, 86 4"/>
          <path d="M 86 240 C 96 190, 74 140, 90 70 S 78 20, 88 4"/>
          <path d="M 96 240 C 86 195, 110 145, 96 78 S 110 22, 100 6"/>
          <path d="M 110 240 C 122 195, 98 140, 116 72 S 100 18, 112 4"/>
          <path d="M 78 240 C 90 200, 70 150, 84 86 S 70 24, 80 6"/>
          <path d="M 102 240 C 92 200, 116 150, 102 80 S 116 24, 106 8"/>
          <path d="M 64 240 C 76 210, 56 160, 70 100 S 56 38, 68 10"/>
        </svg>
      </div>

      <!-- Bowl: static, foreground -->
      <div class="layer layer-bowl">
        <svg viewBox="0 0 320 180" xmlns="http://www.w3.org/2000/svg">
          <!-- Bowl interior tint -->
          <ellipse cx="160" cy="38" rx="142" ry="20" fill="rgba(212, 195, 156, 0.45)"/>
          <!-- Outer body curve -->
          <path d="M 16 38 Q 36 168, 160 178 Q 284 168, 304 38" fill="var(--paper)" stroke="currentColor" stroke-width="2.2" stroke-linejoin="round"/>
          <!-- Rim ellipse -->
          <ellipse cx="160" cy="38" rx="144" ry="20" fill="none" stroke="currentColor" stroke-width="2"/>
          <!-- Inner rim highlight -->
          <ellipse cx="160" cy="38" rx="132" ry="15" fill="none" stroke="rgba(42,46,39,0.25)" stroke-width="1"/>
          <!-- Foot ring -->
          <path d="M 116 178 L 116 175 Q 116 170, 124 170 L 196 170 Q 204 170, 204 175 L 204 178" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
        </svg>
      </div>

      <!-- Bowl shadow ellipse beneath -->
      <div class="layer layer-shadow">
        <svg viewBox="0 0 280 40" xmlns="http://www.w3.org/2000/svg">
          <ellipse cx="140" cy="20" rx="130" ry="12" fill="currentColor"/>
        </svg>
      </div>
    </div>
  </div>
</section>

<!-- ============== THREE GENERATIONS ============== -->
<section class="section">
  <div class="gens">
    <div class="gens__copy" data-reveal>
      <span class="h-eyebrow"><span class="dot"></span>
        <span data-en>OUR STORY</span><span data-zh>我们的故事</span>
      </span>
      <h2>
        <span data-en>Three Generations<br/><em>One Recipe</em></span>
        <span data-zh>三代人，<br/><em>一菜谱</em></span>
      </h2>
      <p class="h-body">
        <span data-en>Traditional Hakka cooking, kept whole. Three generations of the same recipes since 1928, now in thirteen kitchens.</span>
        <span data-zh>传统客家菜，原味原样。三代人，同一份食谱，1928年至今，已遍及十三家厨房。</span>
      </p>
      <a class="btn btn--ghost" href="<?php echo esc_url( hakshan_nav_url( 'story' ) ); ?>" style="margin-top: 24px;">
        <span data-en>Read the story</span><span data-zh>阅读故事</span>
        <span class="arr">→</span>
      </a>
    </div>
    <div class="gens__timeline" data-reveal>
      <div class="gen">
        <div class="gen__year">1928</div>
        <div>
          <h3><span data-en>The first generation</span><span data-zh>第 一 代</span></h3>
          <p><span data-en>A home kitchen in the ancestral village. Every meal is hers; every meal is for the family. The recipes live in her hands. Nothing is written down.</span>
            <span data-zh>祖屋里的厨房。每一餐都是她下厨，每一餐都给家人。食谱在她手上，一字未落于纸。</span></p>
        </div>
      </div>
      <div class="gen">
        <div class="gen__year">1972</div>
        <div>
          <h3><span data-en>The second generation</span><span data-zh>第 二 代</span></h3>
          <p><span data-en>The second generation brings the kitchen south to the Klang Valley and opens the family's first restaurant. The recipes leave home for the first time. Same dishes, sharpened by service.</span>
            <span data-zh>第二代把厨房南下带到巴生谷，开了家中第一家餐厅。食谱第一次走出家门。同样的菜，越做越精到。</span></p>
        </div>
      </div>
      <div class="gen">
        <div class="gen__year">2024</div>
        <div>
          <h3><span data-en>The third generation</span><span data-zh>第 三 代</span></h3>
          <p><span data-en>In February 2024, Hakshan opens its first dining room in USJ. Same dishes, same recipe, new chairs.</span>
            <span data-zh>2024年2月，客善在 USJ 开出第一间餐厅。菜没变，食谱没变，椅子换了。</span></p>
        </div>
      </div>
      <div class="gen">
        <div class="gen__year">2026</div>
        <div>
          <h3><span data-en>Three generations on</span><span data-zh>三 代 之 后</span></h3>
          <p><span data-en>Thirteen kitchens across the Klang Valley and Ipoh: ten outlets and three cloud kitchens. Same recipes, same standards, sharpened by every generation that cooked them.</span>
            <span data-zh>巴生谷与怡保共十三家厨房：十家门店，三间云端厨房。同样的食谱，同样的标准，每一代下厨的人都把它做得更精到。</span></p>
        </div>
      </div>
    </div>
  </div>
</section>

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
    <a class="btn btn--ghost" href="<?php echo esc_url( hakshan_nav_url( 'menu' ) ); ?>" data-reveal>
      <span data-en>Full menu</span><span data-zh>完整菜单</span>
      <span class="arr">→</span>
    </a>
  </div>

  <div class="sigs__carousel-wrap" data-reveal>
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
          array( 'label' => 'salt-baked chicken · whole, paper-wrapped', 'en' => 'Salt-Baked Chicken', 'zh' => '盐 焗 鸡', 'cn' => '客 家 盐 焗 鸡', 'desc_en' => 'Free-range hen, sea salt, kraft paper. Forty minutes in the embers.', 'desc_zh' => '走 地 鸡、海 盐、牛 皮 纸，炭 火 中 四 十 分 钟。' ),
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

    <div class="oc-nav">
      <div class="oc-nav__count">
        <strong id="scCount">01</strong>
        <span> / 6</span>
      </div>
      <div class="oc-nav__progress"><div class="fill" id="scFill"></div></div>
      <div class="oc-nav__buttons">
        <button class="oc-nav__btn" id="scPrev" aria-label="Previous">←</button>
        <button class="oc-nav__btn" id="scNext" aria-label="Next">→</button>
      </div>
    </div>
  </div>
</section>

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

<!-- ============== CHARITY ============== -->
<section class="charity">
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
</section>

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
              <div><h3><?php echo esc_html( $o['name'] ); ?></h3><div class="city"><?php echo esc_html( $city_display ); ?></div></div>
              <div class="meta"><span></span><span class="arr">→</span></div>
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
              <div><h3><?php echo esc_html( $o['name'] ); ?></h3><div class="city"><?php echo esc_html( $o['city'] ); ?></div></div>
              <div class="meta"><span></span><span class="arr">→</span></div>
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
    <div class="ph g1" data-label="dining room · warm light"></div>
    <div class="ph g2" data-label="bar counter · tea station"></div>
    <div class="ph g3" data-label="private room · round table 10"></div>
    <div class="ph g4" data-label="open kitchen · wok station"></div>
    <div class="ph g5" data-label="entrance · brass signage"></div>
    <div class="ph g6" data-label="terrace · evening service"></div>
  </div>
</section>

<!-- ============== BOOK ============== -->
<section class="book" id="book">
  <div class="inner" data-reveal>
    <span class="h-eyebrow"><span class="dot"></span>
      <span data-en>RESERVE A TABLE</span><span data-zh>预订座位</span>
    </span>
    <h2>
      <span data-en>Pull up<br/><em>a chair.</em></span>
      <span data-zh>来 <br/><em>坐 坐。</em></span>
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
  initCarousel("scCarousel", "scPrev", "scNext", "scFill", "scCount");
  initCarousel("ocCarousel", "ocPrev", "ocNext", "ocFill", "ocCount");

  // Scroll-pulled noodle scene: maps section scroll progress to --p (0..1).
  (function () {
    const noodles = document.getElementById("noodles");
    if (!noodles) return;
    const reduce = window.matchMedia && window.matchMedia("(prefers-reduced-motion: reduce)").matches;
    if (reduce) return;

    let ticking = false;
    function update() {
      const rect = noodles.getBoundingClientRect();
      const runway = rect.height - window.innerHeight;
      const passed = -rect.top;
      let p = runway > 0 ? passed / runway : 0;
      if (p < 0) p = 0;
      if (p > 1) p = 1;
      noodles.style.setProperty("--p", p.toFixed(4));
      ticking = false;
    }
    function onScroll() {
      if (ticking) return;
      ticking = true;
      requestAnimationFrame(update);
    }
    window.addEventListener("scroll", onScroll, { passive: true });
    window.addEventListener("resize", onScroll);
    update();
  })();
</script>

<?php
get_footer();
