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
  .g5 { grid-column: 1 / 5;  grid-row: span 3; }
  .g6 { grid-column: 5 / 13; grid-row: span 3; }

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
    .hero-a, .anchor, .gens, .charity { grid-template-columns: 1fr; gap: 48px; }
    .outlets__head, .sigs__head { flex-direction: column; align-items: start; }
    .oc-nav__progress { display: none; }
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

<?php if ( hakshan_show_section( 'hakshan_show_three_gens' ) ) : ?>
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

<?php if ( hakshan_show_section( 'hakshan_show_reserve_cta' ) ) : ?>
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
  initCarousel("scCarousel", "scPrev", "scNext", "scFill", "scCount");
  initCarousel("ocCarousel", "ocPrev", "ocNext", "ocFill", "ocCount");
</script>

<?php
get_footer();
