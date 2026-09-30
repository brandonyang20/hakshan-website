<?php
/**
 * Template Name: Investors
 * Template Post Type: page
 *
 * @package Hakshan
 */

get_header();
?>
<style>
  /* ============================================================
     Investor page — ported from the Claude Design (Investor.html)
     into the Hakshan brand system. All .iv-* classes are scoped
     to this template; only the existing .inv-contact form embed at
     the bottom is preserved.
     ============================================================ */

  /* ---- Local palette derived from the design + brand vars ---- */
  .iv {
    --iv-dark: #231A12;
    --iv-dark-2: #2D2219;
    --iv-on-dark: #F3EAD9;
    --iv-on-dark-soft: rgba(243, 234, 217, 0.66);
    --iv-on-dark-faint: rgba(243, 234, 217, 0.42);
    --iv-accent: #C49B66;
    --iv-accent-deep: #9C7843;
    --iv-line-dark: rgba(243, 234, 217, 0.18);
  }

  .iv-section {
    padding: clamp(70px, 9vw, 120px) var(--rail);
  }
  .iv-section--alt { background: var(--cream); }
  .iv-section--dark {
    background: #231A12;
    color: #F3EAD9;
  }
  .iv-wrap {
    max-width: var(--maxw);
    margin: 0 auto;
  }

  /* ---- Shared section head ---- */
  .iv-shead .h-eyebrow .dot { background: var(--forest); }
  .iv-section--dark .iv-shead .h-eyebrow { color: #C49B66; opacity: 1; }
  .iv-section--dark .iv-shead .h-eyebrow .dot { background: #C49B66; }
  .iv-shead h2 {
    font-family: var(--serif);
    font-weight: 400;
    font-size: clamp(36px, 5.2vw, 72px);
    line-height: 1.05;
    margin: 14px 0 0;
    letter-spacing: -0.02em;
    text-wrap: balance;
  }
  .iv-section--dark .iv-shead h2 { color: #F3EAD9; }
  .iv-shead h2 em { color: var(--forest); }
  .iv-section--dark .iv-shead h2 em { color: #C49B66; }
  .iv-shead .lead {
    font-size: clamp(17px, 1.5vw, 19px);
    line-height: 1.6;
    color: var(--ink-soft);
    max-width: 60ch;
    margin: 24px 0 0;
  }
  .iv-section--dark .iv-shead .lead { color: rgba(243, 234, 217, 0.74); }

  /* ============== 1. HERO ============== */
  .iv-hero h1 {
    font-family: var(--serif);
    font-weight: 400;
    font-size: clamp(40px, 6.2vw, 88px);
    line-height: 1.04;
    letter-spacing: -0.02em;
    color: #F3EAD9;
    max-width: 18ch;
    margin: 20px 0 0;
    text-wrap: balance;
  }
  .iv-hero h1 em { color: #C49B66; font-style: italic; }
  .iv-hero__lead {
    font-size: clamp(17px, 1.5vw, 19px);
    line-height: 1.6;
    color: rgba(243, 234, 217, 0.74);
    max-width: 54ch;
    margin: 24px 0 0;
  }
  .iv-metrics {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: clamp(16px, 2.4vw, 32px);
    margin-top: clamp(48px, 6vw, 76px);
    padding-top: clamp(28px, 3vw, 40px);
    border-top: 1px solid rgba(243, 234, 217, 0.18);
  }
  .iv-metric__n {
    font-family: var(--serif);
    font-weight: 400;
    font-size: clamp(34px, 4.4vw, 60px);
    line-height: 1;
    color: #F3EAD9;
    letter-spacing: -0.02em;
  }
  .iv-metric__n em { font-style: normal; color: #C49B66; }
  .iv-metric__l {
    font-size: 13px;
    color: rgba(243, 234, 217, 0.66);
    margin-top: 12px;
    letter-spacing: 0.02em;
  }

  /* ============== 2. TRACK RECORD ============== */
  .iv-miles {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: clamp(20px, 3vw, 40px);
    margin-top: clamp(36px, 4vw, 56px);
  }
  .iv-mile {
    border: 1px solid var(--line);
    padding: clamp(26px, 3vw, 40px);
    background: var(--paper);
    position: relative;
  }
  .iv-mile--accent {
    background: #231A12;
    color: #F3EAD9;
    border-color: transparent;
  }
  .iv-mile__tag {
    font-family: var(--mono);
    letter-spacing: 0.12em;
    text-transform: uppercase;
    font-size: 12px;
    color: var(--ink-soft);
  }
  .iv-mile--accent .iv-mile__tag { color: #C49B66; }
  .iv-mile__yr {
    font-family: var(--serif);
    font-size: clamp(40px, 5vw, 68px);
    font-weight: 400;
    letter-spacing: 0.02em;
    line-height: 1;
    margin-top: 6px;
  }
  .iv-mile--accent .iv-mile__yr { color: #C49B66; }
  .iv-mile__list {
    margin-top: 24px;
    display: flex;
    flex-direction: column;
    gap: 12px;
  }
  .iv-mile__item {
    display: flex;
    justify-content: space-between;
    gap: 16px;
    border-top: 1px solid var(--line);
    padding-top: 12px;
    align-items: baseline;
  }
  .iv-mile--accent .iv-mile__item { border-color: rgba(243, 234, 217, 0.18); }
  .iv-mile__item b {
    font-family: var(--serif);
    font-weight: 500;
    font-size: 19px;
    white-space: nowrap;
  }
  .iv-mile__item span {
    color: var(--ink-soft);
    font-size: 14px;
    text-align: right;
  }
  .iv-mile--accent .iv-mile__item span { color: rgba(243, 234, 217, 0.66); }

  /* ============== 3. PERFORMANCE CHART ============== */
  .iv-chart { margin-top: 40px; }
  .iv-chart__bars {
    display: grid;
    grid-auto-flow: column;
    /* minmax(0, 1fr) — keep all 14 columns at exactly 1/14th of the
       chart width even when labels are wider than that share. Without
       this, no-wrap labels push columns wider and the chart overflows. */
    grid-auto-columns: minmax(0, 1fr);
    gap: clamp(3px, 0.7vw, 9px);
    align-items: end;
    height: clamp(240px, 32vw, 360px);
    border-bottom: 1.5px solid var(--line);
    padding-top: 30px;
  }
  .iv-bar {
    position: relative;
    display: flex;
    flex-direction: column;
    justify-content: flex-end;
    height: 100%;
  }
  .iv-bar__fill {
    width: 100%;
    border-radius: 3px 3px 0 0;
    background: linear-gradient(180deg, #C49B66, #6B4F2F);
    height: 0;
    transition: height 0.8s cubic-bezier(0.4, 0, 0.2, 1);
  }
  .iv-bar--proj .iv-bar__fill {
    background: linear-gradient(180deg, rgba(196, 155, 102, 0.6), rgba(196, 155, 102, 0.18));
    outline: 1px dashed rgba(196, 155, 102, 0.5);
    outline-offset: -1px;
  }
  .iv-bar__lbl {
    font-family: var(--mono);
    font-size: 10.5px;
    color: var(--mute);
    text-align: center;
    margin-top: 9px;
    letter-spacing: 0.02em;
    white-space: nowrap;
  }
  .iv-bar__fill { position: relative; }
  /* Label sits on top of its own bar (anchored to the fill, not the
     full-height column), and only appears on hover / tap. */
  .iv-bar__cap {
    position: absolute;
    bottom: calc(100% + 7px);
    left: 50%;
    transform: translate(-50%, 4px);
    padding: 4px 8px;
    border-radius: 999px;
    background: #231A12;
    color: #F3EAD9;
    font-family: var(--serif);
    font-size: 11.5px;
    line-height: 1.2;
    white-space: nowrap;
    pointer-events: none;
    opacity: 0;
    transition: opacity 0.2s ease, transform 0.2s ease;
    z-index: 2;
  }
  .iv-bar__cap::after {
    content: "";
    position: absolute;
    top: 100%;
    left: 50%;
    transform: translateX(-50%);
    border: 4px solid transparent;
    border-top-color: #231A12;
  }
  .iv-bar:hover .iv-bar__cap,
  .iv-bar.is-on .iv-bar__cap { opacity: 1; transform: translate(-50%, 0); }
  .iv-bar:hover .iv-bar__fill,
  .iv-bar.is-on .iv-bar__fill { filter: brightness(1.08); }
  .iv-bar { cursor: default; }
  .iv-chart__split {
    display: flex;
    justify-content: space-between;
    margin-top: 20px;
    flex-wrap: wrap;
    gap: 16px;
  }
  .iv-chart__tot {
    display: flex;
    align-items: baseline;
    gap: 10px;
  }
  .iv-chart__tot b {
    font-family: var(--serif);
    font-weight: 400;
    font-size: clamp(24px, 2.8vw, 36px);
  }
  .iv-chart__tot span {
    font-family: var(--mono);
    font-size: 12px;
    letter-spacing: 0.06em;
    text-transform: uppercase;
    color: var(--mute);
  }

  /* ============== 4. MARKET VALIDATION ============== */
  .iv-validation__grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: clamp(40px, 6vw, 80px);
    align-items: center;
    margin-top: clamp(30px, 4vw, 48px);
  }
  .iv-pyramid {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 8px;
    margin-top: 18px;
  }
  .iv-pyr {
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    padding: 18px 24px;
    border-radius: 4px;
    color: var(--ink);
    font-family: var(--serif);
  }
  .iv-pyr-1 { width: 52%; font-size: 15px; background: color-mix(in srgb, var(--forest) 28%, var(--paper)); }
  .iv-pyr-2 { width: 76%; font-size: 16px; background: color-mix(in srgb, var(--forest) 18%, var(--paper)); }
  .iv-pyr-3 { width: 100%; font-size: 18px; background: color-mix(in srgb, var(--forest) 10%, var(--paper)); }
  .iv-vstats { display: flex; flex-direction: column; }
  .iv-vstat {
    border-top: 1px solid var(--line);
    padding: 22px 0;
  }
  .iv-vstat:last-child { border-bottom: 1px solid var(--line); }
  .iv-vstat__n {
    font-family: var(--serif);
    font-weight: 400;
    font-size: clamp(34px, 4.6vw, 56px);
    line-height: 1;
    letter-spacing: -0.02em;
  }
  .iv-vstat__n em { font-style: normal; color: var(--forest); }
  .iv-vstat__l {
    font-size: 15px;
    color: var(--ink-soft);
    margin-top: 8px;
  }

  /* ============== 5. BUSINESS MODEL ============== */
  .iv-layers { display: flex; flex-direction: column; gap: 18px; margin-top: clamp(36px, 4vw, 56px); }
  .iv-layer {
    display: grid;
    grid-template-columns: auto 1fr;
    gap: clamp(20px, 3vw, 44px);
    align-items: center;
    border: 1px solid var(--line);
    padding: clamp(24px, 3vw, 40px);
    background: var(--paper);
    position: relative;
    overflow: hidden;
  }
  .iv-layer__tag {
    font-family: var(--mono);
    writing-mode: vertical-rl;
    transform: rotate(180deg);
    text-transform: uppercase;
    letter-spacing: 0.2em;
    font-size: 12px;
    color: var(--forest);
    font-weight: 500;
  }
  .iv-layer__no {
    position: absolute;
    right: clamp(20px, 3vw, 44px);
    top: 50%;
    transform: translateY(-50%);
    font-family: var(--serif);
    font-weight: 400;
    font-size: clamp(80px, 11vw, 150px);
    color: var(--line);
    line-height: 1;
    pointer-events: none;
  }
  .iv-layer h3 {
    font-family: var(--serif);
    font-size: clamp(22px, 2.6vw, 30px);
    font-weight: 400;
    margin: 0 0 12px;
    line-height: 1.2;
  }
  .iv-layer p {
    margin: 0;
    color: var(--ink-soft);
    max-width: 60ch;
    line-height: 1.7;
  }
  .iv-layer__chips {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
    margin-top: 18px;
  }
  .iv-chip {
    font-family: var(--mono);
    font-size: 11px;
    letter-spacing: 0.14em;
    text-transform: uppercase;
    color: var(--forest);
    padding: 6px 12px;
    border: 1px solid var(--line);
    border-radius: 999px;
    background: var(--cream);
  }
  .iv-engine {
    display: grid;
    grid-template-columns: 1.4fr 1fr;
    gap: clamp(28px, 4vw, 60px);
    align-items: center;
    margin-top: clamp(28px, 4vw, 48px);
  }
  .iv-engine__media {
    aspect-ratio: 16/9;
    overflow: hidden;
    background: var(--paper);
  }
  .iv-engine__media img { width: 100%; height: 100%; object-fit: cover; display: block; }
  .iv-engine h3 {
    font-family: var(--serif);
    font-weight: 400;
    font-size: clamp(22px, 2.6vw, 30px);
    margin: 0 0 12px;
  }
  .iv-engine p {
    margin: 0;
    color: var(--ink-soft);
    line-height: 1.7;
  }

  /* ============== 6. EXPANSION ============== */
  /* Reuses .iv-miles + .iv-mile from track record. */
  .iv-expansion .iv-mile__yr { font-size: clamp(28px, 4vw, 46px); }
  .iv-expansion .iv-mile p { margin: 14px 0 0; color: var(--ink-soft); line-height: 1.7; }
  .iv-expansion .iv-mile--accent p { color: rgba(243, 234, 217, 0.7); }
  .iv-mile__map {
    margin: calc(clamp(26px, 3vw, 40px) * -1) calc(clamp(26px, 3vw, 40px) * -1) clamp(22px, 2.4vw, 32px);
    aspect-ratio: 16 / 9;
    overflow: hidden;
    background: rgba(0, 0, 0, 0.05);
  }
  .iv-mile--accent .iv-mile__map { background: rgba(243, 234, 217, 0.06); }
  .iv-mile__map img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
  }

  /* ============== 6b. ORG CHART — Multi-layer F&B model ============== */
  .iv-org {
    background: #231A12;
    color: #F3EAD9;
    padding: clamp(70px, 9vw, 120px) var(--rail);
    position: relative;
    overflow: hidden;
  }
  .iv-org__wrap {
    max-width: var(--maxw);
    margin: 0 auto;
    position: relative;
  }
  .iv-org__title {
    text-align: center;
    font-family: var(--serif);
    font-size: clamp(28px, 3.6vw, 46px);
    font-weight: 400;
    letter-spacing: 0.04em;
    text-transform: uppercase;
    color: #F3EAD9;
    margin: 0 0 clamp(40px, 5vw, 64px);
    line-height: 1.15;
    text-wrap: balance;
  }
  /* Chart frame — stacked tiers with explicit rails between them. */
  .iv-org__chart {
    --node-w: 112px;
    --gap: clamp(8px, 1.4vw, 22px);
    --rail-color: rgba(196, 155, 102, 0.55);
    display: flex;
    flex-direction: column;
    align-items: center;
    overflow-x: auto;
    padding-bottom: 4px;
  }
  .iv-org__chart::-webkit-scrollbar { display: none; }
  .iv-org__tier {
    display: flex;
    justify-content: center;
    gap: var(--gap);
    flex-wrap: nowrap;
  }
  .iv-org__node {
    background: linear-gradient(180deg, #3a2c1c, #251c11);
    border: 1px solid var(--rail-color);
    color: #F3EAD9;
    padding: 14px 18px;
    text-align: center;
    font-family: var(--serif);
    font-size: 14px;
    line-height: 1.25;
    width: var(--node-w);
    flex: 0 0 var(--node-w);
    border-radius: 4px;
  }
  .iv-org__node--holding {
    width: auto;
    flex: 0 0 auto;
    padding: 22px 36px;
    font-size: 18px;
    background: linear-gradient(180deg, #C49B66, #8A6A40);
    color: #1a1209;
    border-color: #C49B66;
    box-shadow: 0 12px 30px -16px rgba(196, 155, 102, 0.7);
  }
  .iv-org__node--holding b { display: block; font-weight: 400; letter-spacing: 0.04em; }
  .iv-org__node--outlet { padding: 12px 14px; font-size: 12.5px; }
  .iv-org__node--outlet b {
    display: block;
    font-family: var(--mono);
    font-size: 10px;
    letter-spacing: 0.16em;
    text-transform: uppercase;
    color: #C49B66;
    margin-bottom: 6px;
  }

  /* Vertical stem (single line between two tiers) */
  .iv-org__stem {
    width: 1px;
    height: 28px;
    background: var(--rail-color);
  }
  /* Branching rail: a horizontal bus with vertical drops to each child */
  .iv-org__rail {
    position: relative;
    height: 28px;
    display: flex;
    justify-content: center;
    gap: var(--gap);
  }
  .iv-org__rail i {
    display: block;
    width: var(--node-w);
    height: 100%;
    position: relative;
  }
  .iv-org__rail i::after {
    content: "";
    position: absolute;
    left: 50%;
    top: 0;
    bottom: 0;
    width: 1px;
    background: var(--rail-color);
  }
  /* Horizontal bus spans from the centre of the first drop to the centre of
     the last drop. Width derived from drop count and the same gap/node-w. */
  .iv-org__rail::before {
    content: "";
    position: absolute;
    top: 0;
    height: 1px;
    background: var(--rail-color);
    left: 50%;
    transform: translateX(-50%);
  }
  .iv-org__rail--5::before { width: calc(4 * (var(--node-w) + var(--gap))); }
  .iv-org__rail--7::before { width: calc(6 * (var(--node-w) + var(--gap))); }
  .iv-org__rail--10::before { width: calc(9 * (var(--node-w) + var(--gap))); }
  /* 13 outlets wrap to a 7+6 grid on desktop. The rail carries seven
     drops aligned to the top row, with the bus spanning that row, so it
     reads as a tree above the grid (the 2nd row hangs below the bus). */
  .iv-org__rail--13::before { width: calc(6 * (var(--node-w) + var(--gap))); }
  .iv-org__rail--13 + .iv-org__tier {
    display: grid;
    grid-template-columns: repeat(7, var(--node-w));
    gap: var(--gap);
    width: max-content;
    margin: 0 auto;
  }

  @media (max-width: 880px) {
    /* No more horizontal scroll on phones. Chart becomes a vertical
       stack: holding box centred at the top, single vertical stem
       between tiers, solution + outlet nodes wrap to a 2-col grid. */
    .iv-org__chart {
      overflow-x: visible;
      padding: 0 var(--rail);
      align-items: stretch;
    }
    .iv-org__tier {
      flex-wrap: wrap;
      gap: 8px;
      width: 100%;
      justify-content: center;
    }
    /* Drop the desktop's between-tier .iv-org__stem element — without
       it being centred, the 1px stem rendered along the left edge of
       the flex column and looked like a second, off-centre line. The
       single centred line comes from the rail's ::before below. */
    .iv-org__stem { display: none; }
    /* Drop the per-node drop fingers and convert the rail's bus into
       a single vertical stem between tiers. */
    .iv-org__rail {
      height: 36px;
      width: 100%;
      justify-content: center;
    }
    .iv-org__rail i { display: none; }
    .iv-org__rail--5::before,
    .iv-org__rail--7::before,
    .iv-org__rail--10::before,
    .iv-org__rail--13::before {
      top: 0;
      left: 50%;
      width: 1px;
      height: 100%;
      transform: translateX(-50%);
    }
    /* Solution tier — three across so it lines up with the outlet grid. */
    .iv-org__node {
      width: auto;
      flex: 0 0 calc((100% - 16px) / 3);
      min-width: 0;
      padding: 12px 10px;
      font-size: 12.5px;
    }
    .iv-org__node--holding {
      flex: 0 0 auto;
      width: auto;
      padding: 16px 32px;
      font-size: 16px;
    }
    .iv-org__node--outlet {
      padding: 10px 8px;
      font-size: 11.5px;
    }
    /* Outlet tier — override the desktop 7-col max-content grid (which
       overflowed the phone) with a fitted 3-col grid. minmax(0,1fr)
       keeps long names from pushing columns past the viewport. */
    .iv-org__rail--13 + .iv-org__tier {
      display: grid;
      grid-template-columns: repeat(3, minmax(0, 1fr));
      width: 100%;
      gap: 8px;
      margin: 0;
    }
    /* Bar-chart labels — rotate -45° on mobile so 'Jul 25' style
       labels fit under their narrow columns. Position them absolutely
       below the .iv-bar so they're outside the bars container's layout
       box; otherwise the rotated layout-box still pushes the border-
       bottom down past the bars, where the line ends up slashing
       through the rotated text. */
    .iv-bar { position: relative; }
    .iv-bar__lbl {
      position: absolute;
      top: calc(100% + 6px);
      right: 50%;
      transform: translateX(50%) rotate(-45deg);
      transform-origin: top right;
      font-size: 9px;
      width: max-content;
      text-align: right;
    }
    .iv-chart__bars { margin-bottom: 56px; }
  }

  /* ============== 6c. TEAM ============== */
  .iv-team {
    padding: clamp(80px, 12vw, 140px) var(--rail);
    max-width: var(--maxw);
    margin: 0 auto;
  }
  .iv-team__grid {
    display: grid;
    grid-template-columns: repeat(5, 1fr);
    gap: 18px;
    margin-top: clamp(36px, 4vw, 56px);
  }
  .iv-member {
    background: var(--paper);
    border: 1px solid var(--line);
    display: flex;
    flex-direction: column;
    overflow: hidden;
  }
  .iv-member__photo {
    aspect-ratio: 4 / 5;
    background: #231A12;
    overflow: hidden;
  }
  .iv-member__photo img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center top;
    display: block;
  }
  .iv-member__body {
    padding: clamp(22px, 2.4vw, 32px);
    display: flex;
    flex-direction: column;
  }
  .iv-member__role {
    font-family: var(--mono);
    font-size: 12px;
    letter-spacing: 0.18em;
    text-transform: uppercase;
    color: var(--forest);
    margin: 0 0 8px;
  }
  .iv-member__name {
    font-family: var(--serif);
    font-size: clamp(20px, 2vw, 26px);
    font-weight: 400;
    margin: 0 0 16px;
    line-height: 1.15;
    letter-spacing: -0.01em;
  }
  .iv-member__bio {
    font-size: 13.5px;
    line-height: 1.65;
    color: var(--ink-soft);
    margin: 0;
    padding: 0;
  }
  .iv-member__bio li {
    list-style: none;
    margin-bottom: 10px;
    padding: 0;
    display: flex;
    gap: 8px;
    align-items: baseline;
  }
  .iv-member__bio li::before {
    content: "·";
    color: var(--forest);
    flex-shrink: 0;
    line-height: 1;
  }
  .iv-member__bio li:last-child { margin-bottom: 0; }
  /* Desktop layout: 5 columns. Reorder visually so CEO sits dead-centre
     (position 3), with COO/CFO flanking and CBDO/CPO on the outside.
     HTML order is kept CEO-first for screen readers and tab-flow. */
  .iv-team__grid > .iv-member:nth-child(1) { order: 3; } /* CEO  -> centre */
  .iv-team__grid > .iv-member:nth-child(2) { order: 2; } /* COO  -> left of centre */
  .iv-team__grid > .iv-member:nth-child(3) { order: 1; } /* CBDO -> far left */
  .iv-team__grid > .iv-member:nth-child(4) { order: 4; } /* CFO  -> right of centre */
  .iv-team__grid > .iv-member:nth-child(5) { order: 5; } /* CPO  -> far right */
  @media (max-width: 980px) {
    .iv-team__grid { grid-template-columns: repeat(2, 1fr); }
    /* Below the 5-col desktop layout, reset to natural HTML order so CEO
       is first in the stack instead of buried in the middle. Each
       :nth-child rule is re-targeted here so specificity matches the
       desktop overrides above — otherwise those win and the mobile
       stack keeps CBDO at the top. */
    .iv-team__grid > .iv-member:nth-child(1),
    .iv-team__grid > .iv-member:nth-child(2),
    .iv-team__grid > .iv-member:nth-child(3),
    .iv-team__grid > .iv-member:nth-child(4),
    .iv-team__grid > .iv-member:nth-child(5) {
      order: 0;
    }
  }
  @media (max-width: 560px) {
    .iv-team__grid { grid-template-columns: 1fr; }
  }

  /* ============== 7. EQUITY STRUCTURE ============== */
  .iv-equity {
    display: grid;
    grid-template-columns: 1fr 1.2fr;
    gap: clamp(40px, 6vw, 80px);
    align-items: center;
    margin-top: clamp(40px, 5vw, 64px);
  }
  .iv-donut {
    aspect-ratio: 1;
    max-width: 340px;
    margin: 0 auto;
    border-radius: 50%;
    position: relative;
    background: conic-gradient(#C49B66 0 40%, #F3EAD9 40% 100%);
  }
  .iv-donut::after {
    content: "";
    position: absolute;
    inset: 22%;
    background: #231A12;
    border-radius: 50%;
  }
  .iv-donut__lab {
    position: absolute;
    font-family: var(--serif);
    text-align: center;
    line-height: 1.15;
    z-index: 1;
    color: #2A2018;
    transform: translate(-50%, -50%);
    width: max-content;
    max-width: 30%;
  }
  .iv-donut__lab b { display: block; font-size: 26px; font-weight: 400; }
  .iv-donut__lab span { display: block; font-size: 11px; letter-spacing: 0.04em; opacity: 0.78; margin-top: 2px; }
  /* Geometric midpoints of each sector along the ring centreline (radius ≈ 39%
     of the container, measured from centre). 40% sector midpoint at 72° from
     12-o'clock; 60% sector midpoint at 252°. */
  .iv-donut__lab--inv { top: 38%; left: 87%; }
  .iv-donut__lab--hold { top: 62%; left: 13%; }
  .iv-eq__rows { display: flex; flex-direction: column; }
  .iv-eq__row {
    display: flex;
    justify-content: space-between;
    align-items: baseline;
    gap: 20px;
    border-top: 1px solid rgba(243, 234, 217, 0.18);
    padding: 18px 0;
    color: #F3EAD9;
  }
  .iv-eq__row:last-child { border-bottom: 1px solid rgba(243, 234, 217, 0.18); }
  .iv-eq__row .k { color: rgba(243, 234, 217, 0.66); font-size: 15px; }
  .iv-eq__row .v {
    font-family: var(--serif);
    font-size: clamp(20px, 2.4vw, 26px);
    font-weight: 400;
  }
  .iv-eq__row .v em { font-style: normal; color: #C49B66; }

  /* ============== 8. INVESTMENT MODEL ============== */
  .iv-journey {
    display: grid;
    grid-template-columns: repeat(6, 1fr);
    gap: 8px;
    margin: clamp(36px, 4vw, 56px) 0;
  }
  .iv-jstep {
    text-align: center;
    position: relative;
    padding-top: 34px;
  }
  .iv-jstep::before {
    content: "";
    position: absolute;
    top: 9px;
    left: 0;
    right: 0;
    height: 1px;
    background: var(--line);
  }
  .iv-jstep:first-child::before { left: 50%; }
  .iv-jstep:last-child::before { right: 50%; }
  .iv-jstep__dot {
    position: absolute;
    top: 3px;
    left: 50%;
    transform: translateX(-50%);
    width: 13px;
    height: 13px;
    border-radius: 50%;
    background: var(--paper);
    border: 2px solid var(--forest);
  }
  .iv-jstep--key .iv-jstep__dot { background: var(--forest); }
  .iv-jstep__yr {
    font-family: var(--mono);
    font-size: 12px;
    letter-spacing: 0.12em;
    color: var(--forest);
    text-transform: uppercase;
  }
  .iv-jstep__v {
    font-family: var(--serif);
    font-size: clamp(17px, 1.9vw, 21px);
    margin-top: 6px;
  }
  .iv-jstep__d {
    font-size: 12px;
    color: var(--mute);
    margin-top: 5px;
    line-height: 1.4;
  }
  .iv-terms {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 16px;
  }
  .iv-term {
    background: #231A12;
    color: #F3EAD9;
    padding: 26px 24px;
    text-align: center;
  }
  .iv-term__l {
    font-family: var(--mono);
    font-size: 11px;
    letter-spacing: 0.14em;
    text-transform: uppercase;
    color: rgba(243, 234, 217, 0.6);
    min-height: 2.6em;
    display: flex;
    align-items: center;
    justify-content: center;
  }
  .iv-term__v {
    font-family: var(--serif);
    font-weight: 400;
    font-size: clamp(22px, 2.6vw, 30px);
    margin-top: 14px;
    color: #C49B66;
  }
  .iv-term__v small {
    display: block;
    font-family: var(--sans);
    font-size: 12px;
    color: rgba(243, 234, 217, 0.6);
    letter-spacing: 0.02em;
    margin-top: 6px;
  }
  .iv-note {
    font-size: 14px;
    color: var(--ink-soft);
    margin-top: 22px;
    max-width: 68ch;
    line-height: 1.7;
  }

  /* ============== 9. MINIMUM GUARANTEE ============== */
  .iv-split {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: clamp(40px, 6vw, 72px);
    align-items: center;
    margin-top: clamp(30px, 4vw, 48px);
  }
  .iv-split__media {
    aspect-ratio: 4/3;
    overflow: hidden;
    background: var(--paper);
  }
  .iv-split__media img { width: 100%; height: 100%; object-fit: cover; display: block; }
  .iv-checklist {
    display: flex;
    flex-direction: column;
    gap: 22px;
  }
  .iv-check {
    display: grid;
    grid-template-columns: auto 1fr;
    gap: 16px;
    align-items: start;
  }
  .iv-check__i {
    width: 26px;
    height: 26px;
    border-radius: 50%;
    border: 1.5px solid var(--forest);
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    margin-top: 2px;
    color: var(--forest);
  }
  .iv-check__i svg { width: 13px; height: 13px; }
  .iv-check p {
    margin: 0;
    color: var(--ink-soft);
    line-height: 1.7;
  }
  .iv-check b { color: var(--ink); font-weight: 600; }

  /* ============== RESPONSIVE ============== */
  @media (max-width: 980px) {
    .iv-metrics { grid-template-columns: 1fr 1fr; }
    .iv-miles { grid-template-columns: 1fr; }
    .iv-terms { grid-template-columns: 1fr 1fr; }
    .iv-validation__grid,
    .iv-engine,
    .iv-equity,
    .iv-split { grid-template-columns: 1fr; gap: 40px; }
    .iv-journey { grid-template-columns: repeat(3, 1fr); gap: 28px 12px; }
    .iv-jstep::before { display: none; }
  }
  @media (max-width: 640px) {
    .iv-metrics { grid-template-columns: 1fr 1fr; gap: 24px; }
    .iv-terms { grid-template-columns: 1fr 1fr; }
    .iv-journey { grid-template-columns: 1fr 1fr; }
    .iv-layer { grid-template-columns: 1fr; }
    .iv-layer__tag { writing-mode: horizontal-tb; transform: none; }
    .iv-layer__no { display: none; }
  }

  /* ============== CONTACT (preserved from prior page) ============== */
  .inv-contact {
    background: var(--forest);
    color: var(--cream);
    padding: clamp(80px, 12vw, 140px) var(--rail);
  }
  .inv-contact__inner {
    max-width: var(--maxw);
    margin: 0 auto;
    display: grid;
    grid-template-columns: 1fr 1.1fr;
    gap: 60px;
    align-items: start;
  }
  .inv-contact .h-eyebrow { color: var(--cream); opacity: 0.8; }
  .inv-contact .h-eyebrow .dot { background: var(--cream); }
  .inv-contact h2 {
    font-family: var(--serif);
    font-weight: 400;
    font-size: clamp(40px, 5.5vw, 76px);
    line-height: 1.05;
    margin: 12px 0 0;
    letter-spacing: -0.025em;
    color: var(--cream);
  }
  .inv-contact h2 em { color: var(--cream); border-bottom: 2px solid var(--cream); padding-bottom: 2px; }
  .inv-contact .form-wrap {
    background: var(--cream);
    padding: 28px;
    color: var(--ink);
  }
  .inv-contact .form-wrap h4 {
    font-family: var(--mono);
    font-size: 12px;
    letter-spacing: 0.16em;
    text-transform: uppercase;
    margin: 0 0 16px;
    color: var(--forest);
  }
  .inv-contact .form-wrap p,
  .inv-contact .form-wrap label {
    font-family: var(--sans);
    font-style: normal;
    font-size: 14px;
    color: var(--ink);
  }
  @media (max-width: 980px) {
    .inv-contact__inner { grid-template-columns: 1fr; gap: 36px; }
  }
  /* ============ HERO SLIDESHOW (light, per-slide copy) ============ */
  /* Sized to the banners' own 1920x645 proportions so the whole image
     shows, with its faded left side sitting behind the copy. */
  .iv-hero2{position:relative;display:grid;background:#FBF8F1;color:#2A1A0F;overflow:hidden}
  .iv-hero2__slide{grid-area:1/1;position:relative;display:flex;align-items:center;aspect-ratio:1920/645;min-height:340px;opacity:0;visibility:hidden;transition:opacity .9s ease,visibility 0s linear .9s}
  .iv-hero2__slide.is-on{opacity:1;visibility:visible;transition-delay:0s}
  .iv-hero2__bg{position:absolute;inset:0;background-size:cover;background-position:right center}
  .iv-hero2__inner{position:relative;z-index:2;width:100%;max-width:var(--maxw);margin:0 auto;padding:clamp(20px,3vw,48px) var(--rail)}
  .iv-hero2__eyebrow{display:block;font-family:var(--mono);font-weight:500;font-size:clamp(10px,1vw,14px);letter-spacing:.14em;text-transform:uppercase;color:#4A3524}
  .iv .iv-hero2__title{font-family:var(--serif);font-weight:700;text-transform:uppercase;line-height:1.04;letter-spacing:0;color:#2A1A0F;margin:.45em 0 .4em}
  .iv .iv-hero2__title--lg{font-size:clamp(30px,3.95vw,64px)}
  .iv .iv-hero2__title--sm{font-size:clamp(24px,2.85vw,46px)}
  .iv-hero2__title em{font-style:normal;color:#6E4323}
  .iv .iv-hero2__lead{font-size:clamp(12px,1.06vw,16px);line-height:1.5;color:#4A3B2E;max-width:26em;margin:0}
  .iv .iv-hero2__lead--strong{max-width:none;font-weight:600;color:#6E4323;font-size:clamp(13px,1.38vw,21px);line-height:1.35}
  .iv-hero2__btns{display:flex;gap:clamp(8px,1.1vw,14px);flex-wrap:wrap;margin-top:clamp(16px,2.4vw,30px)}
  .iv-hero2__cta,.iv-hero2__ghost{display:inline-flex;align-items:center;gap:.5em;padding:.62em 1.3em;border-radius:999px;font-family:var(--mono);font-weight:500;font-size:clamp(10px,.95vw,13px);letter-spacing:.08em;text-transform:uppercase;text-decoration:none;transition:background .2s ease,color .2s ease,transform .2s ease}
  .iv-hero2__cta{background:#4F5D48;color:#F9F7F2;border:1px solid #4F5D48}
  .iv-hero2__cta:hover{background:#3c4737;transform:translateY(-1px)}
  .iv-hero2__cta .arr{transition:transform .2s ease}
  .iv-hero2__cta:hover .arr{transform:translateX(3px)}
  .iv-hero2__ghost{background:transparent;color:#2A1A0F;border:1px solid #2A1A0F}
  .iv-hero2__ghost:hover{background:#2A1A0F;color:#F9F7F2}
  .iv-hero2__dots{position:absolute;z-index:3;bottom:14px;left:50%;transform:translateX(-50%);display:flex;gap:8px}
  .iv-hero2__dot{width:8px;height:8px;padding:0;border:0;border-radius:50%;background:rgba(42,26,15,.22);cursor:pointer;transition:background .25s ease,width .25s ease}
  .iv-hero2__dot.is-on{background:#4F5D48;width:22px;border-radius:999px}
  /* Narrower screens: the image starts to crop, so wash the text side. */
  @media(max-width:1100px){
    .iv-hero2__bg::after{content:"";position:absolute;inset:0;background:linear-gradient(90deg,#FBF8F1 0%,rgba(251,248,241,.88) 34%,rgba(251,248,241,0) 62%)}
  }
  @media(max-width:760px){
    .iv-hero2__slide{aspect-ratio:auto;min-height:480px;align-items:flex-end}
    .iv-hero2__bg{background-position:72% center}
    .iv-hero2__bg::after{background:linear-gradient(180deg,rgba(251,248,241,.5) 0%,rgba(251,248,241,.9) 52%,#FBF8F1 100%)}
    .iv-hero2__inner{padding-bottom:52px}
    .iv .iv-hero2__title--lg{font-size:34px}
    .iv .iv-hero2__title--sm{font-size:27px}
    .iv .iv-hero2__lead{font-size:14px}
    .iv .iv-hero2__lead--strong{font-size:16px}
    .iv-hero2__cta,.iv-hero2__ghost{font-size:11px}
  }
  /* ============ LIVE PERFORMANCE ============ */
  .iv-live{background:#FDFBF6;padding-top:clamp(44px,5.5vw,72px)}
  .iv-live__eyebrow{text-align:center;margin-bottom:clamp(34px,5vw,62px)}
  .iv-live__eyebrow .h-eyebrow{font-size:clamp(15px,1.55vw,20px);letter-spacing:.04em;color:#6E4323}
  .iv-live__eyebrow .h-eyebrow .dot{background:#6E4323;width:7px;height:7px}
  .iv-live__row{display:grid;grid-template-columns:repeat(3,auto);justify-content:center;align-items:stretch;margin:0 auto}
  .iv-live__stat{text-align:center;padding:0 clamp(14px,3.2vw,56px)}
  .iv-live__stat+.iv-live__stat{border-left:1px solid rgba(42,46,39,.55)}
  .iv-live__n{font-family:var(--serif);font-size:clamp(38px,5.4vw,68px);line-height:1;letter-spacing:-.02em;color:#4F5D48;white-space:nowrap}
  .iv-live__n em{font-style:normal;font-size:.74em;letter-spacing:-.01em}
  .iv-live__l{margin-top:clamp(10px,1.4vw,18px);font-family:var(--mono);font-size:clamp(13px,1.45vw,19px);letter-spacing:.02em;text-transform:uppercase;color:#6E4323;white-space:nowrap}
  .iv-live__band{display:grid;grid-template-columns:auto 1fr;gap:clamp(20px,3vw,44px);align-items:center;max-width:1160px;margin:clamp(40px,5.5vw,64px) auto 0}
  .iv-live__cap{background:#4F5D48;color:#F9F7F2;border-radius:18px;padding:clamp(18px,2.2vw,24px) clamp(18px,2.2vw,22px);min-width:clamp(200px,20vw,232px)}
  .iv-live__capl{font-family:var(--mono);font-size:clamp(14px,1.4vw,18px);line-height:1.3}
  .iv-live__capn{font-family:var(--serif);font-size:clamp(21px,2.3vw,29px);line-height:1.2;margin-top:1px;font-weight:500}
  .iv-live__tally{display:grid;grid-template-columns:repeat(3,minmax(0,1fr));align-items:center;gap:clamp(10px,1.6vw,24px)}
  .iv-live__brand{display:flex;align-items:center;justify-content:center;gap:clamp(8px,1vw,14px);min-width:0}
  .iv-live__brandtxt{flex:0 0 auto}
  .iv-live__brandimg{flex:0 1 auto;min-width:0;height:clamp(58px,7vw,100px);display:flex;align-items:flex-end}
  .iv-live__brandimg img{height:100%;width:auto;max-width:min(100%,150px);object-fit:contain;display:block}
  .iv-live__brandph{display:block;width:clamp(90px,10vw,130px);height:100%;background:repeating-linear-gradient(135deg,rgba(79,93,72,.07) 0 7px,rgba(79,93,72,.02) 7px 14px),linear-gradient(180deg,#e4dcc6,#d3c9ad);border-radius:8px}
  .iv-live__brandn{font-family:var(--serif);font-weight:600;font-size:clamp(22px,2.3vw,29px);line-height:1;color:#3A2412;white-space:nowrap}
  .iv-live__brandn small{font-family:var(--sans);font-weight:400;font-size:11px;margin-left:4px;color:#6E4323;vertical-align:middle}
  .iv-live__brandname{font-family:var(--mono);font-weight:700;font-size:clamp(13px,1.3vw,16px);letter-spacing:.06em;text-transform:uppercase;color:#5A3A1E;margin-top:4px;white-space:nowrap}
  @media(max-width:860px){
    .iv-live__row{grid-template-columns:1fr;justify-content:stretch;gap:26px}
    .iv-live__stat+.iv-live__stat{border-left:0;border-top:1px solid rgba(42,46,39,.3);padding-top:22px}
    .iv-live__band{grid-template-columns:1fr;gap:28px}
    .iv-live__cap{justify-self:center;text-align:center}
    .iv-live__tally{gap:12px}
    .iv-live__brand{flex-direction:column;gap:8px;text-align:center}
    .iv-live__brandimg{height:58px;justify-content:center}
    .iv-live__brandn small{display:block;margin:4px 0 0}
  }
  /* ============ PORTFOLIO ============ */
  .iv-port__head{display:flex;align-items:flex-start;justify-content:space-between;gap:24px;flex-wrap:wrap}
  .iv-port__h2{font-family:var(--serif);font-size:clamp(30px,4.6vw,52px);line-height:1.02;letter-spacing:-.02em;margin:14px 0 8px;text-transform:uppercase}
  .iv-port__all{font-size:14px;color:var(--ink);text-decoration:none;white-space:nowrap;padding-top:6px}
  .iv-port__all:hover{color:var(--forest)}
  .iv-port__all .arr{transition:transform .2s ease;display:inline-block}
  .iv-port__all:hover .arr{transform:translateX(3px)}
  .iv-port__grid{display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:clamp(14px,2vw,26px);margin-top:clamp(28px,4vw,44px)}
  .iv-port__card{display:flex;flex-direction:column;background:var(--paper,#F9F7F2);border:1px solid var(--line-soft,#DDD2B5);border-radius:12px;overflow:hidden;cursor:pointer;transition:transform .25s cubic-bezier(.22,1,.36,1),box-shadow .25s ease}
  .iv-port__card:hover{transform:translateY(-3px);box-shadow:0 20px 44px -28px rgba(42,46,39,.6)}
  .iv-port__card:focus-visible{outline:2px solid var(--forest);outline-offset:3px}
  .iv-port__media{aspect-ratio:16/10;overflow:hidden;background:var(--cream)}
  .iv-port__media img{width:100%;height:100%;object-fit:cover;display:block}
  .iv-port__body{padding:clamp(18px,2.2vw,26px);display:flex;flex-direction:column;flex:1}
  .iv-port__name{font-family:var(--serif);font-size:clamp(19px,2.2vw,24px);margin:0 0 3px;letter-spacing:-.01em;text-transform:uppercase}
  .iv-port__kind{font-size:13px;color:var(--iv-accent-deep,#9C7843);font-weight:500}
  .iv-port__rule{display:block;width:30px;height:2px;background:var(--iv-accent,#C49B66);margin:12px 0 14px}
  .iv-port__copy{font-size:14px;line-height:1.6;color:var(--ink-soft);margin:0 0 20px}
  .iv-port__stats{display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:10px;margin-top:auto}
  .iv-port__stat{display:flex;flex-direction:column;gap:3px;min-width:0}
  .iv-port__stat b{font-family:var(--serif);font-size:clamp(13px,1.4vw,16px);color:var(--iv-accent-deep,#9C7843);line-height:1.15}
  .iv-port__stat span{font-size:10.5px;line-height:1.3;color:var(--mute,#8A8775)}
  .iv-port__cta{display:flex;align-items:center;justify-content:center;gap:9px;margin-top:20px;padding:11px 18px;border-radius:999px;background:var(--forest,#4F5D48);color:var(--cream,#EBDFC4);font-family:var(--sans);font-weight:600;font-size:12px;letter-spacing:.1em;text-transform:uppercase;transition:background .2s ease}
  .iv-port__card:hover .iv-port__cta{background:#3c4737}
  .iv-port__cta .arr{transition:transform .2s ease}
  .iv-port__card:hover .iv-port__cta .arr{transform:translateX(3px)}
  @media(max-width:900px){.iv-port__grid{grid-template-columns:1fr}}
  /* ============ INVESTOR NEWS ============ */
  .iv-news__grid{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:clamp(14px,2vw,26px);margin-top:clamp(28px,4vw,44px)}
  .iv-news__card{display:flex;flex-direction:column;background:var(--paper,#F9F7F2);border:1px solid var(--line,#C9BE9F);border-radius:12px;overflow:hidden}
  .iv-news__media{aspect-ratio:16/9;overflow:hidden;background:var(--cream)}
  .iv-news__media img{width:100%;height:100%;object-fit:cover;display:block}
  .iv-news__body{padding:clamp(18px,2.2vw,26px);display:flex;flex-direction:column;flex:1}
  .iv-news__date{font-family:var(--mono);font-size:10.5px;letter-spacing:.18em;text-transform:uppercase;color:var(--forest);margin-bottom:10px}
  .iv-news__card h3{font-family:var(--serif);font-size:clamp(18px,2.1vw,22px);line-height:1.25;margin:0 0 10px}
  .iv-news__card p{font-size:14.5px;line-height:1.6;color:var(--ink-soft);margin:0 0 14px}
  .iv-news__tags{font-family:var(--mono);font-size:10.5px;letter-spacing:.1em;text-transform:uppercase;color:var(--mute,#8A8775);line-height:1.6;margin-bottom:16px}
  .iv-news__foot{display:flex;align-items:center;justify-content:space-between;gap:14px;margin-top:auto;padding-top:14px;border-top:1px solid var(--line-soft,#DDD2B5);flex-wrap:wrap}
  .iv-news__site{font-family:var(--mono);font-size:11px;color:var(--ink)}
  .iv-news__cta{display:inline-flex;align-items:center;gap:8px;font-family:var(--mono);font-size:11px;letter-spacing:.14em;text-transform:uppercase;color:var(--forest);text-decoration:none}
  .iv-news__cta .arr{transition:transform .2s ease}
  .iv-news__cta:hover .arr{transform:translateX(3px)}
  @media(max-width:900px){.iv-news__grid{grid-template-columns:1fr}}
  /* ============ NEWS CAROUSEL ============ */
  .iv-news__head{display:flex;align-items:flex-end;justify-content:space-between;gap:24px;flex-wrap:wrap}
  .iv-news__nav{display:flex;gap:8px}
  .iv-news__arrow{width:42px;height:42px;border:1px solid var(--line,#C9BE9F);background:transparent;border-radius:50%;color:var(--ink);font-size:16px;cursor:pointer;transition:background .2s ease,color .2s ease}
  .iv-news__arrow:hover{background:var(--forest);color:var(--cream);border-color:var(--forest)}
  .iv-news__track{display:flex;gap:clamp(14px,2vw,24px);margin-top:clamp(28px,4vw,44px);overflow-x:auto;scroll-snap-type:x mandatory;scrollbar-width:none;-webkit-overflow-scrolling:touch;padding-bottom:4px}
  .iv-news__track::-webkit-scrollbar{display:none}
  .iv-news__card{flex:0 0 clamp(268px,31%,380px);scroll-snap-align:start;display:flex;flex-direction:column;background:var(--paper,#F9F7F2);border:1px solid var(--line,#C9BE9F);border-radius:12px;overflow:hidden;text-decoration:none;color:inherit;transition:transform .25s cubic-bezier(.22,1,.36,1),box-shadow .25s ease}
  .iv-news__card:hover{transform:translateY(-3px);box-shadow:0 18px 40px -26px rgba(42,46,39,.6)}
  .iv-news__media{aspect-ratio:16/9;overflow:hidden;background:var(--cream);position:relative}
  .iv-news__media img{width:100%;height:100%;object-fit:cover;display:block}
  .iv-news__ph{position:absolute;inset:0;background:repeating-linear-gradient(135deg,rgba(79,93,72,.06) 0 8px,rgba(79,93,72,.02) 8px 16px),linear-gradient(180deg,#d8cfb3,#c4ba98)}
  .iv-news__body{padding:clamp(16px,2vw,24px);display:flex;flex-direction:column;flex:1}
  .iv-news__date{font-family:var(--mono);font-size:10.5px;letter-spacing:.18em;text-transform:uppercase;color:var(--forest);margin-bottom:10px}
  .iv-news__card h3{font-family:var(--serif);font-size:clamp(17px,2vw,21px);line-height:1.25;margin:0 0 10px}
  .iv-news__card p{font-size:14px;line-height:1.6;color:var(--ink-soft);margin:0 0 16px}
  .iv-news__cta{display:inline-flex;align-items:center;gap:8px;margin-top:auto;font-family:var(--mono);font-size:11px;letter-spacing:.14em;text-transform:uppercase;color:var(--forest)}
  .iv-news__cta .arr{transition:transform .2s ease}
  .iv-news__card:hover .iv-news__cta .arr{transform:translateX(3px)}
  @media(max-width:700px){.iv-news__card{flex-basis:82%}.iv-news__nav{display:none}}

  /* ============ BRAND MODAL ============ */
  .iv-port__card{cursor:pointer;transition:transform .25s cubic-bezier(.22,1,.36,1),box-shadow .25s ease}
  .iv-port__card:hover{transform:translateY(-3px);box-shadow:0 20px 44px -28px rgba(42,46,39,.6)}
  .iv-port__card:focus-visible{outline:2px solid var(--forest);outline-offset:3px}
  .iv-modal{position:fixed;inset:0;z-index:9200;display:flex;align-items:center;justify-content:center;padding:18px}
  .iv-modal[hidden]{display:none}
  .iv-modal__backdrop{position:absolute;inset:0;background:rgba(28,22,16,.7);backdrop-filter:blur(3px);-webkit-backdrop-filter:blur(3px)}
  .iv-modal__box{position:relative;width:100%;max-width:640px;max-height:calc(100vh - 36px);max-height:calc(100dvh - 36px);overflow-y:auto;background:var(--paper,#F9F7F2);border-radius:14px;box-shadow:0 44px 90px -34px rgba(0,0,0,.7);animation:ivModalIn .4s cubic-bezier(.22,1,.36,1)}
  @keyframes ivModalIn{from{opacity:0;transform:translateY(16px) scale(.98)}to{opacity:1;transform:none}}
  .iv-modal__x{position:absolute;top:10px;right:10px;z-index:2;width:34px;height:34px;border:0;border-radius:50%;background:rgba(249,247,242,.92);color:var(--ink);font-size:22px;line-height:1;cursor:pointer}
  .iv-modal__media{aspect-ratio:16/9;overflow:hidden;background:var(--cream)}
  .iv-modal__media img{width:100%;height:100%;object-fit:cover;display:block}
  .iv-modal__body{padding:clamp(22px,3vw,34px)}
  .iv-modal__name{font-family:var(--serif);font-size:clamp(22px,3vw,30px);margin:0 0 4px}
  .iv-modal__kind{font-family:var(--mono);font-size:10.5px;letter-spacing:.18em;text-transform:uppercase;color:var(--forest);margin-bottom:16px}
  .iv-modal__copy{font-size:15px;line-height:1.7;color:var(--ink-soft)}
  .iv-modal__copy p{margin:0 0 12px}
  .iv-modal__copy ul{margin:14px 0 0;padding-inline-start:18px}
  .iv-modal__copy li{margin-bottom:6px}

  /* ============ ORG CHART POPOVER ============ */
  .iv-org__wrap{position:relative}
  .iv-org__node--pop{cursor:pointer}
  .iv-org__node--pop:hover,.iv-org__node--pop:focus-visible{border-color:var(--iv-accent,#C49B66);outline:none}
  .iv-org__node--pop.is-active{border-color:var(--iv-accent,#C49B66);box-shadow:0 0 0 1px var(--iv-accent,#C49B66)}
  .iv-pop{position:absolute;z-index:40;width:min(320px,calc(100vw - 40px));padding:16px 18px;background:#2D2219;border:1px solid var(--iv-accent,#C49B66);border-radius:10px;box-shadow:0 26px 54px -26px rgba(0,0,0,.85);pointer-events:none}
  .iv-pop[hidden]{display:none}
  .iv-pop__kicker{font-family:var(--mono);font-size:9.5px;letter-spacing:.2em;text-transform:uppercase;color:var(--iv-accent,#C49B66);margin-bottom:6px}
  .iv-pop__title{font-family:var(--serif);font-size:17px;color:#F3EAD9;margin-bottom:8px}
  .iv-pop__body{font-size:13px;line-height:1.6;color:rgba(243,234,217,.78);margin:0}
  .iv-pop__chips{display:flex;flex-wrap:wrap;gap:6px;margin-top:11px;padding-top:11px;border-top:1px solid rgba(243,234,217,.18)}
  .iv-pop__chips span{font-family:var(--mono);font-size:9.5px;letter-spacing:.1em;text-transform:uppercase;color:var(--iv-accent,#C49B66);border:1px solid rgba(196,155,102,.45);border-radius:999px;padding:3px 8px}
  /* ============ TRACK RECORD · 2025 OUTLET GALLERY ============ */
  .iv-ostack{display:flex;flex-wrap:wrap;justify-content:center;gap:10px;margin:22px 0 4px}
  .iv-ost{position:relative;flex:0 0 calc((100% - 30px)/4);text-decoration:none;color:inherit}
  .iv-ost__img{display:block;aspect-ratio:4/3;border-radius:8px;overflow:hidden;background:var(--cream);border:1px solid var(--line-soft,#DDD2B5);transition:transform .3s cubic-bezier(.22,1,.36,1),box-shadow .3s ease}
  .iv-ost__img img{width:100%;height:100%;object-fit:cover;display:block}
  .iv-ost__ph{display:block;width:100%;height:100%;background:repeating-linear-gradient(135deg,rgba(79,93,72,.07) 0 7px,rgba(79,93,72,.02) 7px 14px),linear-gradient(180deg,#d8cfb3,#c4ba98)}
  .iv-ost:hover .iv-ost__img,.iv-ost:focus-visible .iv-ost__img{transform:scale(1.14);box-shadow:0 18px 34px -18px rgba(42,46,39,.7);position:relative;z-index:3}
  .iv-ost__card{position:absolute;bottom:calc(100% + 12px);left:50%;transform:translateX(-50%) translateY(5px);z-index:6;width:max-content;max-width:210px;display:flex;flex-direction:column;gap:3px;padding:11px 13px;background:var(--paper,#F9F7F2);border:1px solid var(--line,#C9BE9F);border-radius:9px;box-shadow:0 20px 40px -20px rgba(42,46,39,.6);opacity:0;visibility:hidden;pointer-events:none;transition:opacity .22s ease,transform .22s cubic-bezier(.22,1,.36,1),visibility 0s linear .22s}
  .iv-ost:hover .iv-ost__card,.iv-ost:focus-visible .iv-ost__card{opacity:1;visibility:visible;transform:translateX(-50%) translateY(0);transition-delay:0s}
  .iv-ost__card::after{content:"";position:absolute;top:100%;left:50%;transform:translateX(-50%);border:6px solid transparent;border-top-color:var(--line,#C9BE9F)}
  .iv-ost__name{font-family:var(--serif);font-size:14px;line-height:1.2;color:var(--ink)}
  .iv-ost__meta{font-size:11.5px;line-height:1.35;color:var(--ink-soft)}
  .iv-ost__go{margin-top:5px;padding-top:6px;border-top:1px solid var(--line-soft,#DDD2B5);font-family:var(--mono);font-size:9.5px;letter-spacing:.14em;text-transform:uppercase;color:var(--forest)}
  @media(max-width:620px){.iv-ost{flex-basis:calc((100% - 20px)/3)}.iv-ost__card{max-width:170px}}
  /* ---- track record, aligned to the 2026 deck ---- */
  .iv-miles{grid-template-columns:1fr 1px 1fr;gap:clamp(20px,3vw,48px)}
  .iv-miles::before{content:"";grid-column:2;grid-row:1;background:var(--line,#C9BE9F);align-self:stretch}
  /* Pin each column: the divider is the grid's first item, so without
     explicit placement 2025 auto-flowed into column 3 (right) and 2026
     wrapped onto a second row. */
  .iv-miles>.iv-mile:not(.iv-mile--accent){grid-column:1;grid-row:1}
  .iv-miles>.iv-mile--accent{grid-column:3;grid-row:1}
  .iv-mile,.iv-mile--accent{border:0;background:transparent;color:inherit;padding:0}
  .iv-mile__head{font-family:var(--serif);font-size:clamp(22px,2.8vw,32px);color:var(--iv-accent-deep,#9C7843);margin-bottom:6px}
  .iv-mile--accent .iv-mile__head{color:var(--iv-accent-deep,#9C7843)}
  .iv-mile__list{display:grid;grid-template-columns:1fr 1fr;gap:clamp(16px,2.4vw,26px);margin-top:20px}
  .iv-mile__item{display:block;border-top:0;padding-top:0}
  .iv-mile--accent .iv-mile__item{border-color:transparent}
  .iv-mile__item b{display:block;font-family:var(--serif);font-size:clamp(19px,2.3vw,26px);white-space:normal;line-height:1.15;color:var(--ink)}
  .iv-mile__item span{display:block;text-align:left;font-size:13px;margin-top:3px;color:var(--ink-soft)}
  .iv-mile--accent .iv-mile__item b,.iv-mile--accent .iv-mile__item span{color:var(--mute,#8A8775)}
  @media(max-width:860px){
    .iv-miles{grid-template-columns:1fr}
    .iv-miles::before{display:none}
    .iv-miles>.iv-mile:not(.iv-mile--accent),.iv-miles>.iv-mile--accent{grid-column:auto;grid-row:auto}
    .iv-mile--accent{padding-top:26px;border-top:1px solid var(--line,#C9BE9F)}
  }
  /* ============ INVESTOR TYPOGRAPHY ============
     Scoped to .iv so the page body reads as a financial document while
     the site nav and footer keep the house style. Jost (the wordmark
     face) for headings, figures and labels; Inter for running text.
     CJK falls through to system sans rather than inheriting the site's
     Noto Serif SC, which reads too ornamental for an investor page. */
  .iv {
    --iv-cjk: "PingFang SC", "Hiragino Sans GB", "Microsoft YaHei", "Noto Sans SC", sans-serif;
    --serif:   "Jost", "Inter", -apple-system, BlinkMacSystemFont, "Helvetica Neue", var(--iv-cjk);
    --display: "Jost", "Inter", -apple-system, BlinkMacSystemFont, "Helvetica Neue", var(--iv-cjk);
    --sans:    "Inter", -apple-system, BlinkMacSystemFont, "Helvetica Neue", var(--iv-cjk);
    --mono:    "Jost", "Inter", -apple-system, BlinkMacSystemFont, "Helvetica Neue", var(--iv-cjk);
    font-family: var(--sans);
    font-feature-settings: "lnum" 1, "kern" 1;
  }
  body[data-lang="zh"] .iv { font-family: var(--sans); }

  /* Heading weights: Jost at 400 is too light for section titles. */
  .iv h1 { font-weight: 500; letter-spacing: -0.015em; }
  .iv h2, .iv .iv-port__h2     { font-weight: 600; letter-spacing: -0.01em; }
  .iv h3, .iv .iv-port__name,
  .iv .iv-modal__name          { font-weight: 600; }

  /* Figures: medium weight, tabular so columns of numbers align. */
  .iv .iv-live__n, .iv .iv-live__capn, .iv .iv-live__brandn,
  .iv .iv-mile__item b, .iv .iv-port__stat b, .iv .iv-bar__cap,
  .iv .iv-metric__n { font-weight: 500; font-variant-numeric: tabular-nums lining-nums; }

  /* Eyebrows and small caps labels: Jost medium reads cleaner than a
     monospace at these sizes. */
  .iv .h-eyebrow { font-family: var(--mono); font-weight: 500; }
  .iv .iv-live__l, .iv .iv-port__kind, .iv .iv-news__date,
  .iv .iv-news__cta, .iv .iv-bar__lbl, .iv .iv-pop__kicker,
  .iv .iv-ost__go, .iv .iv-live__capl { font-weight: 500; }

  /* Body copy: Inter, slightly tighter leading than the brand serif. */
  .iv p, .iv .iv-lead, .iv .iv-port__copy, .iv .iv-news__card p,
  .iv .iv-modal__copy { font-family: var(--sans); font-weight: 400; }
  /* Cut-out storefront renders float free: no crop, frame or fill. */
  .iv-ost__img{background:transparent;border:0;border-radius:0}
  .iv-ost__img img{object-fit:contain}
  .iv-ost:hover .iv-ost__img,.iv-ost:focus-visible .iv-ost__img{box-shadow:none;filter:drop-shadow(0 14px 16px rgba(42,46,39,.28))}
  .iv-live__brandimg{overflow:visible;border-radius:0}
  .iv-port__media img,.iv-news__media img{transition:transform .5s cubic-bezier(.22,1,.36,1)}
  .iv-port__card:hover .iv-port__media img,.iv-news__card:hover .iv-news__media img{transform:scale(1.04)}
  /* ============ MULTI-LAYER BUSINESS MODEL (interactive) ============ */
  .iv-bm{background:#FDFBF6;padding:clamp(60px,8vw,110px) var(--rail) clamp(80px,10vw,130px)}
  .iv-bm__head{text-align:center;max-width:860px;margin:0 auto clamp(34px,5vw,56px)}
  .iv .iv-bm__title{font-family:var(--serif);font-weight:700;text-transform:uppercase;font-size:clamp(24px,3.2vw,40px);letter-spacing:.005em;line-height:1.1;color:#2A1A0F;margin:0}
  .iv-bm__sub{display:inline-block;margin-top:12px;padding:6px clamp(14px,1.6vw,20px);border-radius:999px;background:#4F5D48;color:#F3EAD9;font-family:var(--serif);font-weight:500;text-transform:uppercase;font-size:clamp(15px,1.8vw,24px);letter-spacing:.01em;line-height:1.25}
  .iv-bm__lead{margin:16px auto 0;font-size:clamp(14px,1.2vw,16px);line-height:1.6;color:#5A4636;max-width:70ch}
  .iv-bm__hint{margin:10px 0 0;font-family:var(--mono);font-weight:500;font-size:11px;letter-spacing:.16em;text-transform:uppercase;color:#9C7843}
  .iv-bm__hint--tap{display:none}
  @media (hover:none){.iv-bm__hint--hover{display:none}.iv-bm__hint--tap{display:inline}}

  .iv-bm__chart{--line:#CDB896;max-width:1160px;margin:0 auto;position:relative}
  .iv-bm__layer{position:relative}
  .iv-bm__row{position:relative;outline:none;transition:opacity .3s ease}
  .iv-bm__row:focus-visible{outline:2px dashed #9C7843;outline-offset:8px;border-radius:14px}
  .iv-bm__stem{width:2px;height:clamp(22px,3vw,34px);background:var(--line);margin:0 auto}
  /* Emphasise the hovered layer, recede the rest. */
  .iv-bm__chart.has-open .iv-bm__layer:not(.is-open) .iv-bm__row{opacity:.45}
  .iv-bm__row{cursor:pointer}

  /* Layer 01 */
  .iv-bm__row--hold{width:fit-content;margin:0 auto;cursor:default}
  .iv-bm__hold{padding:clamp(10px,1.2vw,14px) clamp(22px,2.6vw,34px);border-radius:26px;background:#9D8B75;color:#fff;font-family:var(--serif);font-weight:600;text-transform:uppercase;font-size:clamp(17px,2vw,26px);letter-spacing:.02em;transition:transform .25s ease,box-shadow .25s ease}
  .iv-bm__row--hold:hover .iv-bm__hold{transform:translateY(-2px);box-shadow:0 14px 28px -16px rgba(42,26,15,.6)}

  /* Layer 02: five logo marks on a bus with drops */
  .iv-bm__row--cos{--g:clamp(6px,1vw,14px);display:grid;grid-template-columns:repeat(5,minmax(0,1fr));gap:var(--g);padding-top:clamp(22px,2.8vw,34px)}
  /* Bus runs exactly from the first column's centre to the last's: with 5
     columns and gap g, a centre sits at (W - 4g)/10 from the edge. */
  .iv-bm__row--cos::before{content:"";position:absolute;top:0;left:calc((100% - 4 * var(--g)) / 10 - 1px);right:calc((100% - 4 * var(--g)) / 10 - 1px);height:2px;background:var(--line)}
  .iv-bm__co{position:relative;display:flex;align-items:center;justify-content:center;gap:clamp(6px,.7vw,10px);min-width:0;font-size:clamp(9px,.95vw,14px);transition:transform .25s ease}
  .iv-bm__co::before{content:"";position:absolute;bottom:100%;left:calc(50% - 1px);width:2px;height:clamp(22px,2.8vw,34px);background:var(--line)}
  .iv-bm__row--cos:hover .iv-bm__co{transform:translateY(-2px)}
  .iv-bm__mark{display:inline-flex;gap:3px;flex:0 0 auto}
  .iv-bm__mark i{display:block;width:clamp(6px,.65vw,9px);height:clamp(26px,2.9vw,38px);transform:skewY(-20deg)}
  .iv-bm__mark i:first-child{background:var(--c)}
  .iv-bm__mark i:last-child{background:#777;margin-top:clamp(5px,.6vw,8px)}
  /* Name sits hard against the divider; the tiny tagline right-aligns
     beneath it, so the mark and wordmark read as one compact logo. */
  .iv-bm__word{display:grid;justify-items:start;padding-left:clamp(6px,.7vw,10px);border-left:1px solid #D9D3C7;min-width:0}
  .iv-bm__name{font-family:var(--serif);font-weight:400;color:#6E6E6E;font-size:1em;line-height:1;letter-spacing:.02em;white-space:nowrap}
  .iv-bm__name b{font-weight:600;font-size:1.45em;letter-spacing:.01em}
  .iv-bm__tag{justify-self:end;margin-top:.35em;font-family:var(--sans);font-size:max(5px,.3em);letter-spacing:.06em;text-transform:uppercase;color:#8A8A8A;white-space:nowrap}

  /* Layer 03: outlet pills; bus + drops positioned by JS for the first row */
  .iv-bm__row--outlets{display:flex;flex-wrap:wrap;justify-content:center;gap:clamp(10px,1.3vw,18px) clamp(10px,1.4vw,20px);padding-top:clamp(22px,2.8vw,34px)}
  .iv-bm__bus{position:absolute;top:0;height:2px;background:var(--line);left:0;width:0}
  .iv-bm__outlet{position:relative;display:flex;flex-direction:column;align-items:center;padding:clamp(7px,.8vw,10px) clamp(12px,1.4vw,18px);border-radius:10px;background:#9C6E36;color:#fff;text-align:center;font-family:var(--serif);font-weight:500;font-size:clamp(12px,1.2vw,16px);line-height:1.25;white-space:nowrap;transition:transform .25s ease,box-shadow .25s ease}
  .iv-bm__outlet b{font-weight:600;letter-spacing:.02em}
  .iv-bm__outlet.is-top::before{content:"";position:absolute;bottom:100%;left:calc(50% - 1px);width:2px;height:clamp(22px,2.8vw,34px);background:var(--line)}
  .iv-bm__outlet:hover{transform:translateY(-2px);box-shadow:0 12px 22px -14px rgba(42,26,15,.7)}

  /* Detail drawer: opens a real gap under its row (pushing the layers
     below down) and carries a stem so the connector runs through it. */
  .iv-bm__drawer{display:grid;grid-template-rows:0fr;transition:grid-template-rows .42s cubic-bezier(.22,1,.36,1)}
  .iv-bm__dinner{min-height:0;overflow:hidden;display:flex;flex-direction:column;align-items:center}
  .iv-bm__dstem{flex:0 0 auto;width:2px;height:clamp(16px,2vw,22px);background:var(--line)}
  .iv-bm__card{width:min(820px,100%);display:grid;grid-template-columns:1fr auto;gap:clamp(14px,2.4vw,34px);align-items:center;margin-bottom:2px;padding:clamp(16px,1.8vw,22px) clamp(18px,2.4vw,30px);background:#fff;border:1px solid #EFE6D6;border-radius:14px;box-shadow:0 18px 40px -22px rgba(42,26,15,.35);text-align:left;opacity:0;transform:translateY(-8px);transition:opacity .3s ease,transform .42s cubic-bezier(.22,1,.36,1)}
  .iv-bm__layer.is-open .iv-bm__drawer{grid-template-rows:1fr}
  .iv-bm__layer.is-open .iv-bm__card{opacity:1;transform:none;transition-delay:.06s}
  /* Without JS, fall back to plain CSS hover. */
  .iv-bm__chart:not(.js) .iv-bm__layer:hover .iv-bm__drawer{grid-template-rows:1fr}
  .iv-bm__chart:not(.js) .iv-bm__layer:hover .iv-bm__card{opacity:1;transform:none}
  @media (prefers-reduced-motion:reduce){.iv-bm__drawer,.iv-bm__card{transition:none}}
  .iv-bm__ctag{font-family:var(--mono);font-weight:600;font-size:12px;letter-spacing:.06em;color:#8A5A2B}
  .iv .iv-bm__ctitle{margin-top:3px;font-family:var(--serif);font-weight:600;text-transform:uppercase;font-size:clamp(14px,1.5vw,19px);letter-spacing:.01em;line-height:1.25;color:#3A2412}
  .iv .iv-bm__cbody{margin:6px 0 0;font-size:clamp(12.5px,1vw,14px);line-height:1.5;color:#4A4038}
  .iv-bm__cpts{list-style:none;margin:0;padding:0;display:grid;gap:6px}
  .iv-bm__cpts li{position:relative;padding-left:14px;font-family:var(--mono);font-weight:600;font-size:clamp(11px,1vw,13.5px);letter-spacing:.04em;text-transform:uppercase;color:#9C6E36;white-space:nowrap}
  .iv-bm__cpts li::before{content:"";position:absolute;left:0;top:.5em;width:6px;height:6px;border-radius:50%;background:#9C6E36}

  @media (max-width:760px){
    .iv-bm__row--cos{grid-template-columns:repeat(2,minmax(0,1fr));row-gap:18px;padding-top:0}
    .iv-bm__co:last-child{grid-column:1/-1}
    .iv-bm__name{white-space:normal;text-align:right;line-height:1.1}
    .iv-bm__row--cos::before,.iv-bm__co::before,.iv-bm__bus,.iv-bm__outlet.is-top::before{display:none}
    .iv-bm__row--outlets{padding-top:0}
    .iv-bm__name{font-size:12px}
    .iv-bm__tag{display:none}
    .iv-bm__card{grid-template-columns:1fr}
    .iv-bm__cpts{grid-template-columns:1fr 1fr}
    .iv-bm__cpts li{white-space:normal}
  }
  /* Keep hidden tooltips from widening the page on phones. The 2025 row's
     cards can extend past the edge tiles, so clip horizontally at the
     section; and pin the first/last revenue labels inside the chart. */
  #track{overflow-x:clip}
  .iv-bar:first-child .iv-bar__cap{left:0;transform:translate(0,4px)}
  .iv-bar:last-child .iv-bar__cap{left:auto;right:0;transform:translate(0,4px)}
  .iv-bar:first-child:hover .iv-bar__cap,.iv-bar:first-child.is-on .iv-bar__cap,
  .iv-bar:last-child:hover .iv-bar__cap,.iv-bar:last-child.is-on .iv-bar__cap{transform:translate(0,0)}
  .iv-bar:first-child .iv-bar__cap::after{left:14px}
  .iv-bar:last-child .iv-bar__cap::after{left:auto;right:14px;transform:none}
  /* Revenue chart, 2026 deck styling: olive bars, faint gridlines, bold months. */
  .iv-chart__bars{background-image:repeating-linear-gradient(to top,transparent 0,transparent calc(100% / 7 - 1px),rgba(79,93,72,.13) calc(100% / 7 - 1px),rgba(79,93,72,.13) calc(100% / 7))}
  .iv-bar__fill{background:#4F5D48;border-radius:2px 2px 0 0}
  .iv-bar--proj .iv-bar__fill{background:rgba(79,93,72,.28);outline:1px dashed rgba(79,93,72,.6);outline-offset:-1px}
  .iv .iv-bar__lbl{font-family:var(--mono);font-weight:600;font-size:clamp(10px,1vw,13px);letter-spacing:.04em;color:#2A2E27}
  .iv-chart__split .iv-chart__tot:last-child b{color:#7B8674}
  /* Revenue chart, exactly as the deck: white panel, tight uppercase head,
     solid olive bars, the figure printed above every bar. */
  .iv-chartsec{background:#fff;padding-top:clamp(40px,5vw,64px)}
  .iv-chartsec .iv-shead{max-width:none}
  .iv-chartsec .h-eyebrow{font-size:clamp(14px,1.35vw,17px);letter-spacing:.02em;color:#6E4323}
  .iv-chartsec .h-eyebrow .dot{background:#6E4323}
  .iv .iv-chartsec h2{font-family:var(--serif);font-weight:700;text-transform:uppercase;font-size:clamp(24px,2.6vw,34px);line-height:1.1;letter-spacing:0;color:#2A1A0F;margin:6px 0 4px}
  .iv .iv-chartsec .lead{font-size:clamp(13px,1.1vw,15px);color:#555;margin:0;max-width:none}
  .iv-chartsec .iv-chart{margin-top:clamp(28px,4vw,48px)}
  .iv-chartsec .iv-chart__bars{background-image:repeating-linear-gradient(to top,transparent 0,transparent calc(100% / 7 - 1px),rgba(0,0,0,.07) calc(100% / 7 - 1px),rgba(0,0,0,.07) calc(100% / 7));border-bottom-color:#E4E4E4}
  .iv-chartsec .iv-bar__fill{background:#4B5233;border-radius:0}
  .iv .iv-chartsec .iv-bar__lbl{color:#1E1E1E}
  @media (min-width:761px){
    .iv-chartsec .iv-bar__cap,
    .iv-chartsec .iv-bar:first-child .iv-bar__cap,
    .iv-chartsec .iv-bar:last-child .iv-bar__cap{left:50%;right:auto;bottom:calc(100% + 5px);transform:translateX(-50%)!important;opacity:1;padding:0;border-radius:0;background:none;color:#1E1E1E;font-family:var(--mono);font-weight:500;font-size:clamp(9px,.82vw,12px)}
    .iv-chartsec .iv-bar__cap::after{display:none}
    .iv-chartsec .iv-bar:hover .iv-bar__fill{filter:none}
  }
  /* 2025 outlet cards: reachable and clickable. The card floats 12px above
     the tile; a transparent bridge spans that gap so moving the pointer up
     keeps the tile hovered, and a short close delay forgives small slips. */
  .iv-ost__card{transition:opacity .22s ease,transform .22s cubic-bezier(.22,1,.36,1),visibility 0s linear .28s;transition-delay:.12s,.12s,.28s}
  .iv-ost:hover .iv-ost__card,.iv-ost:focus-visible .iv-ost__card,.iv-ost:focus-within .iv-ost__card{pointer-events:auto;transition-delay:0s,0s,0s}
  .iv-ost__card::before{content:"";position:absolute;left:-10px;right:-10px;top:100%;height:18px}
  .iv-ost__go{cursor:pointer;transition:color .2s ease}
  .iv-ost__card:hover .iv-ost__go{color:#2A1A0F;text-decoration:underline;text-underline-offset:3px}
  /* ---- Year toggles: outlet rows start hidden; the arrow opens space and
     the storefronts rise in one by one. ---- */
  .iv-mile__head{display:flex;align-items:center;gap:14px}
  .iv-yr-toggle{flex:0 0 auto;display:grid;place-items:center;width:clamp(30px,2.6vw,38px);height:clamp(30px,2.6vw,38px);padding:0;border-radius:50%;border:1px solid rgba(156,120,67,.5);background:transparent;color:#9C7843;cursor:pointer;transition:background .2s ease,color .2s ease,border-color .2s ease,transform .2s ease}
  .iv-yr-toggle svg{width:46%;height:46%;transition:transform .4s cubic-bezier(.22,1,.36,1)}
  .iv-yr-toggle:hover{background:#9C7843;border-color:#9C7843;color:#fff;transform:translateY(1px)}
  .iv-yr-toggle:focus-visible{outline:2px solid #9C7843;outline-offset:3px}
  .iv-yr-toggle[aria-expanded="true"] svg{transform:rotate(180deg)}
  .iv-ostwrap{display:grid;grid-template-rows:0fr;transition:grid-template-rows .5s cubic-bezier(.22,1,.36,1)}
  .iv-ostwrap.is-open{grid-template-rows:1fr}
  .iv-ostwrap__in{min-height:0;overflow:hidden}
  /* Once open, let hover cards spill over the row's edges. */
  .iv-ostwrap.is-settled .iv-ostwrap__in{overflow:visible}
  .iv-ostwrap .iv-ost{opacity:0;transform:translateY(18px) scale(.94);transition:opacity .42s ease,transform .55s cubic-bezier(.22,1,.36,1);transition-delay:0s}
  .iv-ostwrap.is-open .iv-ost{opacity:1;transform:none;transition-delay:calc(var(--i) * 110ms + 140ms)}
  .iv-ost.is-soon .iv-ost__img img{opacity:.55;filter:grayscale(.35)}
  @media (prefers-reduced-motion:reduce){
    .iv-ostwrap,.iv-ostwrap .iv-ost,.iv-yr-toggle svg{transition:none}
  }
  /* Layer 03 outlets as storefront tiles: render, then number and name.
     Fixed tile width keeps rows aligned; the row is capped at seven tiles
     so the 13 outlets sit as 7 + 6, both centred. */
  .iv-bm__row--outlets{--tw:clamp(92px,9.6vw,138px);--tg:clamp(10px,1.4vw,20px);gap:clamp(14px,1.8vw,22px) var(--tg);max-width:calc(var(--tw) * 7 + var(--tg) * 6 + 2px);margin:0 auto}
  .iv-bm__outlet{flex:0 0 var(--tw);width:var(--tw);padding:0;border-radius:0;background:none;color:#2A1A0F;white-space:normal;gap:2px;box-shadow:none}
  .iv-bm__outlet:hover{transform:none;box-shadow:none}
  .iv-bm__oimg{display:block;width:100%;aspect-ratio:480/293;margin-bottom:6px;transition:transform .3s cubic-bezier(.22,1,.36,1),filter .3s ease}
  .iv-bm__oimg img{width:100%;height:100%;object-fit:contain;display:block}
  .iv-bm__outlet:hover .iv-bm__oimg{transform:translateY(-4px) scale(1.04);filter:drop-shadow(0 12px 12px rgba(42,26,15,.22))}
  .iv-bm__outlet b{font-family:var(--mono);font-weight:600;font-size:clamp(10px,.85vw,12px);letter-spacing:.1em;color:#9C6E36}
  .iv-bm__oname{font-family:var(--serif);font-weight:600;font-size:clamp(11.5px,1vw,14px);line-height:1.2;color:#2A1A0F;text-align:center}
  @media (max-width:760px){
    .iv-bm__row--outlets{--tg:12px;max-width:none}
    .iv-bm__outlet{flex-basis:calc((100% - 2 * var(--tg)) / 3);width:calc((100% - 2 * var(--tg)) / 3)}
  }
</style>

<div class="iv">

<!-- ============== 1. HERO · slideshow ============== -->
<?php
// Investor imagery ships with the theme (assets/img/investor/). Returns ''
// when a file is missing so every slot degrades to its placeholder.
if ( ! function_exists( 'hakshan_iv_img' ) ) {
  function hakshan_iv_img( $name ) {
    $rel = 'assets/img/investor/' . $name;
    return file_exists( get_theme_file_path( $rel ) ) ? get_theme_file_uri( $rel ) : '';
  }
}

// Each slide carries its own headline, as in the proposal deck. The photo
// sits right; its left side fades to cream so the copy reads over it.
$iv_hero_slides = array(
  array(
    'img'        => hakshan_iv_img( 'hero-1.webp' ),
    'eyebrow_en' => 'Invest · Build · Grow · Together',
    'eyebrow_zh' => '投资 · 共建 · 成长 · 同行',
    'title_en'   => 'Real food.<br/>Lasting value.',
    'title_zh'   => '真材实料，<br/>长久价值。',
    'lead_en'    => 'Invest in homegrown F&amp;B brands,<br/>built for people, profit and the long term.',
    'lead_zh'    => '投资本土餐饮品牌——为人而建，为利而营，为长远而立。',
    'strong'     => true,
    'buttons'    => true,
    'size'       => 'lg',
  ),
  array(
    'img'        => hakshan_iv_img( 'hero-2.webp' ),
    'eyebrow_en' => 'Investment Proposal · 2026',
    'eyebrow_zh' => '投资计划书 · 2026',
    'title_en'   => 'A scalable<br/>F&amp;B ecosystem<br/><em>rooted in heritage.</em>',
    'title_zh'   => '可规模化的<br/>餐饮生态系统，<br/><em>根植于传承。</em>',
    'lead_en'    => 'Hakshan has grown from a single Hakka restaurant into a disciplined, multi-layer F&amp;B group — proven unit economics, a fast capital payback, and a clear runway across Malaysia, Indonesia and Bangkok.',
    'lead_zh'    => '客善从一家客家餐厅起步，发展成纪律严明的多层级餐饮集团——单店经济模型已被验证，资本回收周期短，并在马来西亚、印尼与曼谷拥有清晰的扩张路径。',
    'strong'     => false,
    'buttons'    => false,
    'size'       => 'sm',
  ),
);
$iv_hero_count = count( $iv_hero_slides );
?>
<section class="iv-hero2" id="top" aria-roledescription="carousel">
  <?php foreach ( $iv_hero_slides as $i => $sl ) : $iv_tag = 0 === $i ? 'h1' : 'h2'; ?>
    <div class="iv-hero2__slide<?php echo 0 === $i ? ' is-on' : ''; ?>" aria-hidden="<?php echo 0 === $i ? 'false' : 'true'; ?>">
      <?php if ( $sl['img'] ) : ?>
        <div class="iv-hero2__bg" style="background-image:url('<?php echo esc_url( $sl['img'] ); ?>');"></div>
      <?php endif; ?>
      <div class="iv-hero2__inner">
        <span class="iv-hero2__eyebrow"><span data-en><?php echo esc_html( $sl['eyebrow_en'] ); ?></span><span data-zh><?php echo esc_html( $sl['eyebrow_zh'] ); ?></span></span>
        <<?php echo $iv_tag; ?> class="iv-hero2__title iv-hero2__title--<?php echo esc_attr( $sl['size'] ); ?>">
          <span data-en><?php echo wp_kses_post( $sl['title_en'] ); ?></span>
          <span data-zh><?php echo wp_kses_post( $sl['title_zh'] ); ?></span>
        </<?php echo $iv_tag; ?>>
        <p class="iv-hero2__lead<?php echo $sl['strong'] ? ' iv-hero2__lead--strong' : ''; ?>">
          <span data-en><?php echo wp_kses_post( $sl['lead_en'] ); ?></span>
          <span data-zh><?php echo esc_html( $sl['lead_zh'] ); ?></span>
        </p>
        <?php if ( $sl['buttons'] ) : ?>
          <div class="iv-hero2__btns">
            <a class="iv-hero2__cta" href="#portfolio">
              <span data-en>Explore Opportunities</span><span data-zh>探索投资机会</span> <span class="arr">&rarr;</span>
            </a>
            <a class="iv-hero2__ghost" href="https://shareholder.hakshan.com/" target="_blank" rel="noopener">
              <span data-en>Investor Login</span><span data-zh>投资者登录</span>
            </a>
          </div>
        <?php endif; ?>
      </div>
    </div>
  <?php endforeach; ?>

  <?php if ( $iv_hero_count > 1 ) : ?>
    <div class="iv-hero2__dots" role="tablist" aria-label="Hero slides">
      <?php for ( $i = 0; $i < $iv_hero_count; $i++ ) : ?>
        <button type="button" class="iv-hero2__dot<?php echo 0 === $i ? ' is-on' : ''; ?>"
                data-iv-slide="<?php echo (int) $i; ?>"
                aria-label="<?php echo esc_attr( sprintf( 'Slide %d', $i + 1 ) ); ?>"></button>
      <?php endfor; ?>
    </div>
  <?php endif; ?>
</section>

<!-- ============== 1b. LIVE PERFORMANCE IN 2026 ============== -->
<?php
// Brand tallies. Add an `img` (WP media URL) to show the storefront render
// beside each count; without one the row is just the number and brand.
$iv_tally = array(
  array( 'n' => '17', 'unit_en' => 'Outlets', 'unit_zh' => '家', 'name' => 'HAKSHAN',      'img' => hakshan_iv_img( 'render-hakshan.webp' ) ),
  array( 'n' => '2',  'unit_en' => 'Outlets', 'unit_zh' => '家', 'name' => 'THE NIANG&rsquo;S', 'img' => hakshan_iv_img( 'render-niangs.webp' ) ),
  array( 'n' => '1',  'unit_en' => 'Outlet',  'unit_zh' => '家', 'name' => 'TAISHAN',      'img' => hakshan_iv_img( 'render-taishan.webp' ) ),
);
?>
<section class="iv-section iv-live" id="live">
  <div class="iv-wrap">
    <div class="iv-live__eyebrow" data-reveal>
      <span class="h-eyebrow"><span class="dot"></span>
        <span data-en>LIVE PERFORMANCE IN 2026</span>
        <span data-zh>2026 实时业绩</span>
      </span>
    </div>

    <div class="iv-live__row" data-reveal>
      <div class="iv-live__stat">
        <div class="iv-live__n">30<em>%</em></div>
        <div class="iv-live__l"><span data-en>ROI Generated (YTD)</span><span data-zh>年初至今投资回报</span></div>
      </div>
      <div class="iv-live__stat">
        <div class="iv-live__n">1 - 1.5 <em>Yrs</em></div>
        <div class="iv-live__l"><span data-en>Projected Capital Payback</span><span data-zh>预计资本回收期</span></div>
      </div>
      <div class="iv-live__stat">
        <div class="iv-live__n">RM36.9 <em>Mil</em></div>
        <div class="iv-live__l"><span data-en>Revenue Generated</span><span data-zh>已实现营收</span></div>
      </div>
    </div>

    <div class="iv-live__band" data-reveal>
      <div class="iv-live__cap">
        <div class="iv-live__capl"><span data-en>Capital received</span><span data-zh>已募集资本</span></div>
        <div class="iv-live__capn">RM 10,100,000</div>
        <div class="iv-live__capl" style="margin-top:14px;"><span data-en>Total stores</span><span data-zh>门店总数</span></div>
        <div class="iv-live__capn">20 <span data-en>Outlets</span><span data-zh>家</span></div>
      </div>

      <div class="iv-live__tally">
        <?php foreach ( $iv_tally as $t ) : ?>
          <div class="iv-live__brand">
            <div class="iv-live__brandimg">
              <?php if ( ! empty( $t['img'] ) ) : ?>
                <img src="<?php echo esc_url( $t['img'] ); ?>" alt="" loading="lazy" />
              <?php else : ?>
                <span class="iv-live__brandph" aria-hidden="true"></span>
              <?php endif; ?>
            </div>
            <div class="iv-live__brandtxt">
              <div class="iv-live__brandn"><?php echo esc_html( $t['n'] ); ?><small>( <span data-en><?php echo esc_html( $t['unit_en'] ); ?></span><span data-zh><?php echo esc_html( $t['unit_zh'] ); ?></span> )</small></div>
              <div class="iv-live__brandname"><?php echo wp_kses_post( $t['name'] ); ?></div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</section>

<!-- ============== 1c. OUR GROWING PORTFOLIO ============== -->
<?php
// Brand portfolio. Add an `img` (WP media URL) to show a photo on a card.
$iv_brands = array(
  array(
    'img'      => hakshan_iv_img( 'brand-hakshan.webp' ),
    'name'     => 'HAKSHAN 客善',
    'kind_en'  => 'Hakka Family Dining',
    'kind_zh'  => '客家家庭餐饮',
    'body_en'  => 'A proven Hakka dining concept built around repeat family dining and scalable unit economics.',
    'body_zh'  => '经验证的客家餐饮模式，围绕家庭回头客与可复制的单店经济模型而建。',
    'stats'    => array(
      array( 'RM 40M+', 'Capital Deployed', '已投入资本' ),
      array( '23',      'Outlets Opened',   '累计开业门店' ),
      array( 'Since 2019', 'In Malaysia',   '于马来西亚' ),
    ),
    'cta_en'   => 'EXPLORE HAKSHAN',
    'cta_zh'   => '了解客善',
    'url'      => '',
    'detail_en'=> '<p>Hakshan is the group&rsquo;s founding brand and its proof of concept. Three generations of Hakka recipes, cooked to one standard across every outlet, with a menu built for repeat family dining rather than one-off visits.</p><p>The model is deliberately unglamorous: standardised prep through the central kitchen, disciplined food cost, and an outlet footprint sized to its catchment. That is what makes it repeatable.</p><ul><li>Average 30% food cost, held through 2025</li><li>Capital payback of roughly 1&ndash;1.5 years per outlet</li><li>17 outlets trading across Malaysia</li></ul>',
    'detail_zh'=> '<p>客善是集团的创始品牌，也是模式的验证。三代客家食谱，在每一家门店以同一套标准烹调；菜单为家庭回头客而设，而非一次性到访。</p><p>这套模式刻意不追求花俏：中央厨房统一备料、严格控制食材成本、门店面积与商圈相匹配。这正是它可复制的原因。</p><ul><li>食材成本平均 30%，2025 年全年维持</li><li>单店资本回收期约 1&ndash;1.5 年</li><li>全马 17 家门店营运中</li></ul>',
  ),
  array(
    'img'      => hakshan_iv_img( 'brand-niangs.webp' ),
    'name'     => 'THE NIANG&rsquo;S 娘家',
    'kind_en'  => 'Modern Peranakan Dining',
    'kind_zh'  => '现代娘惹餐饮',
    'body_en'  => 'A contemporary take on Nyonya heritage, making traditional flavours more accessible everyday.',
    'body_zh'  => '以当代手法演绎娘惹传统，让经典风味更贴近日常。',
    'stats'    => array(
      array( 'RM 2M+', 'Capital Deployed',  '已投入资本' ),
      array( '2',      'Outlets Opened',    '已开门店' ),
      array( 'Growing', 'Across Malaysia',  '遍及马来西亚' ),
    ),
    'cta_en'   => 'EXPLORE THE NIANG&rsquo;S',
    'cta_zh'   => '了解娘家',
    'url'      => '',
    'detail_en'=> '<p>The Niang&rsquo;s takes Nyonya cooking &mdash; normally reserved for occasions &mdash; and makes it an everyday proposition. Same heritage, lighter format, accessible price point.</p><p>It runs on the same group infrastructure as Hakshan: shared sourcing, shared central kitchen capacity, shared build-out team. A second brand costs the group far less to open than the first one did.</p><ul><li>2 outlets opened, both trading</li><li>RM 2M+ capital deployed to date</li><li>Built on existing group infrastructure</li></ul>',
    'detail_zh'=> '<p>娘家把原本只在节庆出现的娘惹菜，变成日常可及的选择。同样的传承，更轻盈的形式，更亲民的价格。</p><p>它与客善共用同一套集团基础设施：共同采购、共享中央厨房产能、同一支工程团队。开第二个品牌的成本，远低于第一个。</p><ul><li>已开 2 家门店，均在营运</li><li>累计投入资本 RM 2M+</li><li>建立在既有集团基础设施之上</li></ul>',
  ),
  array(
    'img'      => hakshan_iv_img( 'brand-taishan.webp' ),
    'name'     => 'TAISHAN 台善',
    'kind_en'  => 'Taiwanese Family Dining',
    'kind_zh'  => '台式家庭餐饮',
    'body_en'  => 'Bringing the authentic taste of Taiwan to modern Malaysia, from set meals to hearty family dining.',
    'body_zh'  => '把道地台湾味带到当代马来西亚，从定食到丰盛的家庭料理。',
    'stats'    => array(
      array( 'Upcoming', 'First Launch',      '首店筹备中' ),
      array( 'A New Chapter', 'In Progress',  '进行中' ),
      array( '2026',     'Planned Expansion', '计划扩张' ),
    ),
    'cta_en'   => 'EXPLORE TAISHAN',
    'cta_zh'   => '了解台善',
    'url'      => '',
    'detail_en'=> '<p>Taishan is the group&rsquo;s next chapter: Taiwanese family dining, from set meals to shared plates, aimed at the same repeat-visit customer Hakshan already serves well.</p><p>First launch is planned for 2026. The brand enters with the group&rsquo;s supply chain, kitchen standards and opening playbook already in place &mdash; the parts that usually take a new concept years to build.</p><ul><li>First outlet planned for 2026</li><li>Enters on proven group infrastructure</li><li>Targeting the established family-dining segment</li></ul>',
    'detail_zh'=> '<p>台善是集团的下一章：台式家庭餐饮，从定食到合菜，面向客善已经服务得很好的同一批回头客。</p><p>首店计划于 2026 年开出。这个品牌一进场就已具备集团的供应链、厨房标准与开店流程——这些通常要花新品牌好几年才建得起来。</p><ul><li>首店计划 2026 年开业</li><li>建立在已验证的集团基础设施上</li><li>目标为成熟的家庭餐饮客群</li></ul>',
  ),
);
?>
<section class="iv-section iv-section--alt iv-port" id="portfolio">
  <div class="iv-wrap">
    <div class="iv-port__head" data-reveal>
      <div>
        <span class="h-eyebrow"><span class="dot"></span>
          <span data-en>INVESTMENT OPPORTUNITIES</span>
          <span data-zh>投资机会</span>
        </span>
        <h2 class="iv-port__h2">
          <span data-en>Our Growing Portfolio</span>
          <span data-zh>不断成长的品牌组合</span>
        </h2>
        <p class="iv-lead">
          <span data-en>Distinct brands. A shared purpose. Greater possibilities.</span>
          <span data-zh>品牌各异，初心如一，可能更广。</span>
        </p>
      </div>
      <a class="iv-port__all" href="#updates">
        <span data-en>View All Opportunities</span><span data-zh>查看全部机会</span> <span class="arr">&rarr;</span>
      </a>
    </div>

    <div class="iv-port__grid" data-reveal>
      <?php foreach ( $iv_brands as $b ) : ?>
        <article class="iv-port__card" tabindex="0" role="button"
          data-iv-brand
          data-name="<?php echo esc_attr( wp_strip_all_tags( $b['name'] ) ); ?>"
          data-kind-en="<?php echo esc_attr( $b['kind_en'] ); ?>"
          data-kind-zh="<?php echo esc_attr( $b['kind_zh'] ); ?>"
          data-detail-en="<?php echo esc_attr( $b['detail_en'] ); ?>"
          data-detail-zh="<?php echo esc_attr( $b['detail_zh'] ); ?>"
          data-img="<?php echo esc_attr( $b['img'] ); ?>">
          <?php if ( ! empty( $b['img'] ) ) : ?>
            <div class="iv-port__media"><img src="<?php echo esc_url( $b['img'] ); ?>" alt="" loading="lazy" /></div>
          <?php endif; ?>
          <div class="iv-port__body">
            <h3 class="iv-port__name"><?php echo wp_kses_post( $b['name'] ); ?></h3>
            <div class="iv-port__kind"><span data-en><?php echo esc_html( $b['kind_en'] ); ?></span><span data-zh><?php echo esc_html( $b['kind_zh'] ); ?></span></div>
            <span class="iv-port__rule" aria-hidden="true"></span>
            <p class="iv-port__copy"><span data-en><?php echo esc_html( $b['body_en'] ); ?></span><span data-zh><?php echo esc_html( $b['body_zh'] ); ?></span></p>
            <div class="iv-port__stats">
              <?php foreach ( $b['stats'] as $st ) : ?>
                <div class="iv-port__stat">
                  <b><?php echo esc_html( $st[0] ); ?></b>
                  <span data-en><?php echo esc_html( $st[1] ); ?></span><span data-zh><?php echo esc_html( $st[2] ); ?></span>
                </div>
              <?php endforeach; ?>
            </div>
            <span class="iv-port__cta">
              <span data-en><?php echo wp_kses_post( $b['cta_en'] ); ?></span><span data-zh><?php echo esc_html( $b['cta_zh'] ); ?></span><span class="arr">&rarr;</span>
            </span>
          </div>
        </article>
      <?php endforeach; ?>
    </div>
  </div>

  <div class="iv-modal" id="ivBrandModal" hidden>
    <div class="iv-modal__backdrop" data-iv-brand-close></div>
    <div class="iv-modal__box" role="dialog" aria-modal="true" aria-labelledby="ivBrandName">
      <button type="button" class="iv-modal__x" data-iv-brand-close aria-label="Close">&times;</button>
      <div class="iv-modal__media" id="ivBrandMedia" hidden><img src="" alt="" id="ivBrandImg" /></div>
      <div class="iv-modal__body">
        <h3 class="iv-modal__name" id="ivBrandName"></h3>
        <div class="iv-modal__kind" id="ivBrandKind"></div>
        <div class="iv-modal__copy" id="ivBrandCopy"></div>
      </div>
    </div>
  </div>
</section>

<!-- ============== 2. TRACK RECORD ============== -->
<section class="iv-section" id="track">
  <div class="iv-wrap">
    <div class="iv-shead" data-reveal>
      <span class="h-eyebrow"><span class="dot"></span>
        <span data-en>TRACK RECORD &amp; TRAJECTORY</span>
        <span data-zh>过往业绩 &amp; 增长轨迹</span>
      </span>
      <h2>
        <span data-en>Proven in 2025.<br/><em>Scaling through 2026.</em></span>
        <span data-zh>2025 年已验证。<br/><em>2026 年持续扩张。</em></span>
      </h2>
    </div>
    <?php
    // Outlet rows for both years, detected from each outlet's Opening date:
    //  - 2025: outlets open on or before 31 Dec 2025 (cumulative), by date.
    //  - 2026: outlets dated 2026, plus every "(Coming Soon)" outlet (the
    //    2026 pipeline), dated ones first.
    // With no dates entered yet, 2025 falls back to the first seven
    // operating outlets and 2026 to the coming-soon outlets.
    $iv_cutoff     = gmmktime( 23, 59, 59, 12, 31, 2025 );
    $iv_2025       = array();
    $iv_2026       = array();
    $iv_ops        = array();
    $iv_any_dated  = false;
    foreach ( ( function_exists( 'hakshan_get_outlets' ) ? hakshan_get_outlets() : array() ) as $iv_tr_o ) {
      $iv_title = trim( wp_strip_all_tags( get_the_title( $iv_tr_o->ID ) ) );
      if ( '' === $iv_title ) {
        continue;
      }
      $iv_soon = false !== stripos( $iv_title, 'coming soon' );
      $iv_d    = function_exists( 'hakshan_get_outlet_data' ) ? hakshan_get_outlet_data( $iv_tr_o->ID ) : array();
      $iv_op   = ! empty( $iv_d['opened_parts'] ) ? $iv_d['opened_parts'] : null;
      if ( $iv_op ) {
        $iv_any_dated = true;
      }
      $iv_row = array(
        'name'   => $iv_soon ? trim( preg_replace( '/^\(\s*coming soon\s*\)\s*/i', '', $iv_title ) ) : $iv_title,
        'city'   => ! empty( $iv_d['city'] ) ? ucwords( strtolower( $iv_d['city'] ) ) : '',
        'opened' => $iv_op ? $iv_op['label'] : '',
        'ts'     => $iv_op ? $iv_op['ts'] : PHP_INT_MAX,
        'soon'   => $iv_soon,
        'img'    => hakshan_iv_img( 'render-hakshan.webp' ),
        'url'    => get_permalink( $iv_tr_o->ID ),
      );
      if ( $iv_soon ) {
        $iv_2026[] = $iv_row;
        continue;
      }
      if ( $iv_op && $iv_op['ts'] <= $iv_cutoff ) {
        $iv_2025[] = $iv_row;
      } elseif ( $iv_op && 2026 === $iv_op['year'] ) {
        $iv_2026[] = $iv_row;
      }
      $iv_ops[] = $iv_row;
    }
    $iv_by_date = static function ( $a, $b ) { return $a['ts'] <=> $b['ts']; };
    if ( $iv_any_dated ) {
      usort( $iv_2025, $iv_by_date );
    } else {
      $iv_2025 = array_slice( $iv_ops, 0, 7 );
    }
    usort( $iv_2026, $iv_by_date );

    if ( ! function_exists( 'hakshan_iv_yr_toggle' ) ) {
      // Round arrow beside a year heading; opens that year's outlet row.
      function hakshan_iv_yr_toggle( $id, $year ) {
        ?>
        <button type="button" class="iv-yr-toggle" aria-expanded="false" aria-controls="<?php echo esc_attr( $id ); ?>"
                aria-label="<?php echo esc_attr( sprintf( 'Show %s outlets', $year ) ); ?>" title="<?php echo esc_attr( sprintf( 'Show %s outlets', $year ) ); ?>">
          <svg viewBox="0 0 16 16" aria-hidden="true"><path d="M3.5 6l4.5 4.5L12.5 6" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </button>
        <?php
      }
    }
    if ( ! function_exists( 'hakshan_iv_ost_row' ) ) {
      // Hidden row of storefront tiles; each tile carries its index (--i)
      // so they rise in one by one when the row opens.
      function hakshan_iv_ost_row( $rows, $id ) {
        ?>
        <div class="iv-ostwrap" id="<?php echo esc_attr( $id ); ?>" inert>
          <div class="iv-ostwrap__in">
            <div class="iv-ostack">
              <?php foreach ( $rows as $i => $r ) : ?>
                <a class="iv-ost<?php echo $r['soon'] ? ' is-soon' : ''; ?>" href="<?php echo esc_url( $r['url'] ); ?>" style="--i:<?php echo (int) $i; ?>">
                  <span class="iv-ost__img">
                    <?php if ( $r['img'] ) : ?>
                      <img src="<?php echo esc_url( $r['img'] ); ?>" alt="<?php echo esc_attr( $r['name'] ); ?>" loading="lazy" />
                    <?php else : ?>
                      <span class="iv-ost__ph" aria-hidden="true"></span>
                    <?php endif; ?>
                  </span>
                  <span class="iv-ost__card">
                    <span class="iv-ost__name"><?php echo esc_html( $r['name'] ); ?></span>
                    <?php if ( $r['city'] ) : ?>
                      <span class="iv-ost__meta">&#9679; <?php echo esc_html( $r['city'] ); ?></span>
                    <?php endif; ?>
                    <?php if ( $r['soon'] ) : ?>
                      <span class="iv-ost__meta">&#9642; <span data-en>Coming soon</span><span data-zh>即将开业</span></span>
                    <?php elseif ( $r['opened'] ) : ?>
                      <span class="iv-ost__meta">&#9642; <span data-en>Opened</span><span data-zh>开业</span> <?php echo esc_html( $r['opened'] ); ?></span>
                    <?php endif; ?>
                    <span class="iv-ost__go"><span data-en>View Outlet</span><span data-zh>查看门店</span> &rarr;</span>
                  </span>
                </a>
              <?php endforeach; ?>
            </div>
          </div>
        </div>
        <?php
      }
    }
    ?>
    <div class="iv-miles" data-reveal>
      <div class="iv-mile">
        <div class="iv-mile__head">
          <span class="iv-mile__htext"><span data-en>Achieved</span><span data-zh>已达成</span> 2025</span>
          <?php if ( $iv_2025 ) { hakshan_iv_yr_toggle( 'ivOst2025', '2025' ); } ?>
        </div>
        <?php if ( $iv_2025 ) { hakshan_iv_ost_row( $iv_2025, 'ivOst2025' ); } ?>

        <div class="iv-mile__list">
          <div class="iv-mile__item"><b>7 Outlets</b><span><span data-en>Operating across Kuala Lumpur</span><span data-zh>吉隆坡已开门店</span></span></div>
          <div class="iv-mile__item"><b>RM 20M</b><span><span data-en>Annual revenue</span><span data-zh>年营业额</span></span></div>
          <div class="iv-mile__item"><b>1,000,000+</b><span><span data-en>Meals served</span><span data-zh>累计服务餐数</span></span></div>
          <div class="iv-mile__item"><b>Grab Partner</b><span><span data-en>Achieved within one year</span><span data-zh>开业一年内获得</span></span></div>
        </div>
      </div>
      <div class="iv-mile iv-mile--accent">
        <div class="iv-mile__head">
          <span class="iv-mile__htext"><span data-en>Projected</span><span data-zh>规划目标</span> 2026</span>
          <?php if ( $iv_2026 ) { hakshan_iv_yr_toggle( 'ivOst2026', '2026' ); } ?>
        </div>
        <?php if ( $iv_2026 ) { hakshan_iv_ost_row( $iv_2026, 'ivOst2026' ); } ?>
        <div class="iv-mile__list">
          <div class="iv-mile__item"><b>20 Outlets</b><span><span data-en>+ 25 cloud kitchens</span><span data-zh>+ 25 间云端厨房</span></span></div>
          <div class="iv-mile__item"><b>RM 74M</b><span><span data-en>Annual revenue potential</span><span data-zh>年营业额潜力</span></span></div>
          <div class="iv-mile__item"><b>3 Markets</b><span><span data-en>Malaysia · Indonesia · Bangkok</span><span data-zh>马来西亚 · 印尼 · 曼谷</span></span></div>
          <div class="iv-mile__item"><b>30% food cost</b><span><span data-en>Disciplined margin control</span><span data-zh>毛利率纪律控制</span></span></div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ============== 3. PERFORMANCE CHART ============== -->
<section class="iv-section iv-chartsec">
  <div class="iv-wrap">
    <div class="iv-shead" data-reveal>
      <span class="h-eyebrow"><span class="dot"></span>
        <span data-en>PERFORMANCE DATA</span>
        <span data-zh>业绩表现</span>
      </span>
      <h2><span data-en>Revenue, climbing.</span><span data-zh>营业额，持续攀升。</span></h2>
      <p class="lead">
        <span data-en>Fourteen months of monthly revenue — eleven actual, three projected — on a steady upward curve.</span>
        <span data-zh>十四个月的月营业额——十一个月实际、三个月预测——稳步向上。</span>
      </p>
    </div>
    <div class="iv-chart" data-reveal>
      <div class="iv-chart__bars" id="iv-bars">
        <div class="iv-bar"><div class="iv-bar__fill" data-h="24.8"><div class="iv-bar__cap">1,508,042.75</div></div><div class="iv-bar__lbl">JAN</div></div>
        <div class="iv-bar"><div class="iv-bar__fill" data-h="28.4"><div class="iv-bar__cap">1,723,142.6</div></div><div class="iv-bar__lbl">FEB</div></div>
        <div class="iv-bar"><div class="iv-bar__fill" data-h="29.7"><div class="iv-bar__cap">1,802,425.3</div></div><div class="iv-bar__lbl">MAR</div></div>
        <div class="iv-bar"><div class="iv-bar__fill" data-h="32.3"><div class="iv-bar__cap">1,959,399.32</div></div><div class="iv-bar__lbl">APR</div></div>
        <div class="iv-bar"><div class="iv-bar__fill" data-h="35.8"><div class="iv-bar__cap">2,176,344.25</div></div><div class="iv-bar__lbl">MAY</div></div>
        <div class="iv-bar"><div class="iv-bar__fill" data-h="42"><div class="iv-bar__cap">2,551,340.75</div></div><div class="iv-bar__lbl">JUN</div></div>
        <div class="iv-bar"><div class="iv-bar__fill" data-h="45.7"><div class="iv-bar__cap">2,777,731.22</div></div><div class="iv-bar__lbl">JUL</div></div>
        <div class="iv-bar"><div class="iv-bar__fill" data-h="54.3"><div class="iv-bar__cap">3,297,316.43</div></div><div class="iv-bar__lbl">AUG</div></div>
        <div class="iv-bar"><div class="iv-bar__fill" data-h="64.2"><div class="iv-bar__cap">3,896,685.72</div></div><div class="iv-bar__lbl">SEP</div></div>
        <div class="iv-bar"><div class="iv-bar__fill" data-h="70.4"><div class="iv-bar__cap">4,273,912.38</div></div><div class="iv-bar__lbl">OCT</div></div>
        <div class="iv-bar"><div class="iv-bar__fill" data-h="80.6"><div class="iv-bar__cap">4,897,760.51</div></div><div class="iv-bar__lbl">NOV</div></div>
        <div class="iv-bar"><div class="iv-bar__fill" data-h="100"><div class="iv-bar__cap">6,072,987.76</div></div><div class="iv-bar__lbl">DEC</div></div>
      </div>
    </div>
  </div>
</section>

<!-- ============== 4. MULTI-LAYER F&B BUSINESS MODEL (interactive) ============== -->
<?php
// The three value layers, numbered top-down as in the proposal deck.
$iv_bm_layers = array(
  1 => array(
    'title_en' => 'Capital &amp; Strategic Integration',
    'title_zh' => '资本与战略整合',
    'body_en'  => 'The holding company consolidates profit, allocates capital and enables scalable expansion — unified governance built for enduring, aligned growth.',
    'body_zh'  => '控股公司整合利润、配置资本，并推动可规模化的扩张——统一的治理结构，为长期且一致的成长而设。',
    'pts'      => array( array( 'Consolidated profit', '合并利润' ), array( 'Capital allocation', '资本配置' ), array( 'Scalable expansion', '可规模化扩张' ) ),
  ),
  2 => array(
    'title_en' => 'Integrated F&amp;B Solutions',
    'title_zh' => '整合餐饮解决方案',
    'body_en'  => 'A shared support ecosystem — central kitchen, food trading, renovation, food technology and marketing — that serves both internal brands and external partners, enhancing margin and efficiency.',
    'body_zh'  => '共享的支援生态——中央厨房、食材贸易、装修、餐饮科技与市场营销——同时服务内部品牌与外部伙伴，提升毛利与效率。',
    'pts'      => array( array( 'Food cost &minus;25%', '食材成本 &minus;25%' ), array( 'Renovation &minus;30%', '装修成本 &minus;30%' ), array( 'Central kitchen', '中央厨房' ), array( 'POS &amp; data', 'POS 与数据' ) ),
  ),
  3 => array(
    'title_en' => 'Market Layer — Outlets &amp; Cloud Kitchens',
    'title_zh' => '市场层 — 门店与云端厨房',
    'body_en'  => 'The group&rsquo;s core revenue driver. Scalable full-service outlets and delivery-focused cloud kitchens, run on standardised operations and disciplined cost structures for sustainable profitability.',
    'body_zh'  => '集团的核心营收来源。可规模化的全服务门店与外卖导向的云端厨房，以标准化运营与纪律成本结构，实现可持续盈利。',
    'pts'      => array( array( 'Direct revenue', '直营营收' ), array( 'Brand presence', '品牌触达' ), array( 'Proven unit economics', '已验证的单店模型' ) ),
  ),
);

// Layer 02 companies, drawn as CSS logo marks (brand bar + grey bar,
// divider, wordmark, tagline) so they stay crisp at any size.
$iv_bm_cos = array(
  array( 'FOOD',       'TRADE',   '#8ACF7A', 'Quality · Consistency · Reliability', '食材贸易' ),
  array( 'FOOD',       'TECH',    '#8FD3E6', 'Innovation · Efficiency · Progress',  '餐饮科技' ),
  array( 'DESIGN',     '',        '#F2DC52', 'Vision · Creativity · Function',      '设计工程' ),
  array( 'CULINARY',   'ACADEMY', '#E88A6E', 'Passion · Learning · Mastery',        '厨艺学院' ),
  array( 'ACCOUNTING', '',        '#9CC3EC', 'Accuracy · Compliance · Insight',     '财务会计' ),
);

// Layer 03: operating outlets from the Outlet CPT. "(Coming Soon)" entries
// are left out and the "HAKSHAN" prefix is dropped, as in the deck.
$iv_bm_outlets = array();
if ( function_exists( 'hakshan_get_outlets' ) ) {
  foreach ( hakshan_get_outlets() as $iv_bm_o ) {
    $iv_bm_t = trim( wp_strip_all_tags( get_the_title( $iv_bm_o->ID ) ) );
    if ( '' === $iv_bm_t || false !== stripos( $iv_bm_t, 'coming soon' ) ) {
      continue;
    }
    $iv_bm_outlets[] = trim( preg_replace( '/^hakshan\s+/i', '', $iv_bm_t ) );
  }
}
if ( ! $iv_bm_outlets ) {
  $iv_bm_outlets = array( 'USJ Taipan', 'Menjalara', 'Cheras C180', 'Bandar Puteri Puchong', 'SS2', 'Sri Petaling',
    'Sunway Mentari', 'Kota Damansara', 'Plaza Damansara', 'Pudu Plaza', 'Ipoh', 'Bukit Tinggi', 'Taman Segar' );
}

// One detail card, rendered under whichever layer row it belongs to.
if ( ! function_exists( 'hakshan_iv_bm_card' ) ) {
  function hakshan_iv_bm_card( $n, $l ) {
    ?>
    <div class="iv-bm__drawer" id="ivBmCard<?php echo (int) $n; ?>">
    <div class="iv-bm__dinner">
    <span class="iv-bm__dstem" aria-hidden="true"></span>
    <div class="iv-bm__card">
      <div class="iv-bm__cmain">
        <div class="iv-bm__ctag">&#9679; LAYER <?php echo esc_html( sprintf( '%02d', $n ) ); ?></div>
        <div class="iv-bm__ctitle"><span data-en><?php echo wp_kses_post( $l['title_en'] ); ?></span><span data-zh><?php echo esc_html( $l['title_zh'] ); ?></span></div>
        <p class="iv-bm__cbody"><span data-en><?php echo wp_kses_post( $l['body_en'] ); ?></span><span data-zh><?php echo esc_html( $l['body_zh'] ); ?></span></p>
      </div>
      <ul class="iv-bm__cpts">
        <?php foreach ( $l['pts'] as $pt ) : ?>
          <li><span data-en><?php echo wp_kses_post( $pt[0] ); ?></span><span data-zh><?php echo wp_kses_post( $pt[1] ); ?></span></li>
        <?php endforeach; ?>
      </ul>
    </div>
    </div>
    </div>
    <?php
  }
}
?>
<section class="iv-bm" id="structure">
  <div class="iv-wrap">
    <header class="iv-bm__head" data-reveal>
      <h2 class="iv-bm__title"><span data-en>Multi-Layer F&amp;B Business Model</span><span data-zh>多层级餐饮商业模式</span></h2>
      <div class="iv-bm__sub"><span data-en>One group, three value layers.</span><span data-zh>一个集团，三层价值结构。</span></div>
      <p class="iv-bm__lead">
        <span data-en>From single-layer restaurant operations to an integrated, scalable F&amp;B group — each layer compounds margin and reach.</span>
        <span data-zh>从单层餐厅运营，发展为整合且可规模化的餐饮集团——每一层都为利润与触达加乘。</span>
      </p>
      <p class="iv-bm__hint">
        <span class="iv-bm__hint--hover"><span data-en>Hover over a layer to explore it</span><span data-zh>将鼠标移至各层查看详情</span></span>
        <span class="iv-bm__hint--tap"><span data-en>Tap a layer to explore it</span><span data-zh>点按各层查看详情</span></span>
      </p>
    </header>

    <div class="iv-bm__chart" data-reveal>
      <!-- Layer 01 · Holding -->
      <div class="iv-bm__layer" data-layer="1">
        <div class="iv-bm__row iv-bm__row--hold" tabindex="0" role="button" aria-expanded="false" aria-controls="ivBmCard1">
          <div class="iv-bm__hold"><span data-en>Holding Company</span><span data-zh>控股公司</span></div>
        </div>
        <?php hakshan_iv_bm_card( 1, $iv_bm_layers[1] ); ?>
      </div>

      <div class="iv-bm__stem" aria-hidden="true"></div>

      <!-- Layer 02 · Integrated F&B solutions -->
      <div class="iv-bm__layer" data-layer="2">
        <div class="iv-bm__row iv-bm__row--cos" tabindex="0" role="button" aria-expanded="false" aria-controls="ivBmCard2">
          <?php foreach ( $iv_bm_cos as $co ) : $iv_bm_label = trim( $co[0] . ' ' . $co[1] ); ?>
            <div class="iv-bm__co" style="--c:<?php echo esc_attr( $co[2] ); ?>" aria-label="<?php echo esc_attr( ucwords( strtolower( $iv_bm_label ) ) . ' / ' . $co[4] ); ?>">
              <span class="iv-bm__mark" aria-hidden="true"><i></i><i></i></span>
              <span class="iv-bm__word" aria-hidden="true">
                <span class="iv-bm__name"><b><?php echo esc_html( $co[0] ); ?></b><?php if ( $co[1] ) : ?> <?php echo esc_html( $co[1] ); ?><?php endif; ?></span>
                <span class="iv-bm__tag"><?php echo esc_html( $co[3] ); ?></span>
              </span>
            </div>
          <?php endforeach; ?>
        </div>
        <?php hakshan_iv_bm_card( 2, $iv_bm_layers[2] ); ?>
      </div>

      <div class="iv-bm__stem" aria-hidden="true"></div>

      <!-- Layer 03 · Outlets -->
      <div class="iv-bm__layer" data-layer="3">
        <div class="iv-bm__row iv-bm__row--outlets" tabindex="0" role="button" aria-expanded="false" aria-controls="ivBmCard3">
          <span class="iv-bm__bus" aria-hidden="true"></span>
          <?php $iv_bm_render = hakshan_iv_img( 'render-hakshan.webp' ); ?>
          <?php foreach ( $iv_bm_outlets as $iv_bm_i => $iv_bm_name ) : ?>
            <div class="iv-bm__outlet">
              <span class="iv-bm__oimg"><img src="<?php echo esc_url( $iv_bm_render ); ?>" alt="" loading="lazy" /></span>
              <b><?php echo esc_html( sprintf( 'OUTLET %02d', $iv_bm_i + 1 ) ); ?></b>
              <span class="iv-bm__oname"><?php echo esc_html( $iv_bm_name ); ?></span>
            </div>
          <?php endforeach; ?>
        </div>
        <?php hakshan_iv_bm_card( 3, $iv_bm_layers[3] ); ?>
      </div>
    </div>
  </div>
</section>

<!-- ============== 7. INVESTOR UPDATES · press carousel ============== -->
<?php
// Pull press releases / investor updates from WordPress. Tries the
// "investor-updates" category first, then "press". Editors publish a normal
// post in that category and it appears here automatically, linking through
// to the full article. Falls back to the platform announcements when the
// category is empty, so the section is never blank.
$iv_up_cat = get_category_by_slug( 'investor-updates' );
if ( ! $iv_up_cat ) {
  $iv_up_cat = get_category_by_slug( 'press' );
}
$iv_up_q = $iv_up_cat
  ? new WP_Query(
      array(
        'post_type'           => 'post',
        'posts_per_page'      => 9,
        'cat'                 => $iv_up_cat->term_id,
        'ignore_sticky_posts' => true,
      )
    )
  : null;
$iv_has_posts = ( $iv_up_q && $iv_up_q->have_posts() );

// Fallback cards — used only when no posts exist in the category yet.
$iv_news = array(
  array(
    'date'     => '1 Sep 2026',
    'title_en' => 'From Grab Delivery to Hakshan&rsquo;s Official Ordering Platform',
    'title_zh' => '从 Grab 外送到客善自有订餐平台',
    'body_en'  => 'Hakshan launched its own ordering platform to build a more direct relationship with customers, reduce reliance on third-party platforms and improve long-term margin control.',
    'body_zh'  => '客善推出自有订餐平台，与顾客建立更直接的关系，降低对第三方平台的依赖，并改善长期毛利控制。',
    'url'      => 'https://order.hakshan.com/',
    'ext'      => true,
    'img'      => hakshan_iv_img( 'news-ordering.webp' ),
  ),
  array(
    'date'     => '1 Sep 2026',
    'title_en' => 'Launching Hakshan&rsquo;s Investor Portal',
    'title_zh' => '客善投资者平台上线',
    'body_en'  => 'A dedicated platform giving investors clearer visibility into outlet progress, business performance, financial updates and key milestones.',
    'body_zh'  => '专属平台，让投资者更清楚地掌握门店进度、经营表现、财务更新与重要里程碑。',
    'url'      => 'https://shareholder.hakshan.com/',
    'ext'      => true,
    'img'      => hakshan_iv_img( 'news-portal.webp' ),
  ),
);
?>
<section class="iv-section iv-news" id="updates">
  <div class="iv-wrap">
    <div class="iv-news__head" data-reveal>
      <div class="iv-shead" style="margin:0;">
        <span class="h-eyebrow"><span class="dot"></span>
          <span data-en>INVESTOR UPDATES</span><span data-zh>投资者动态</span>
        </span>
        <h2>
          <span data-en>Latest News &amp; Milestones</span>
          <span data-zh>最新消息与里程碑</span>
        </h2>
        <p class="iv-lead">
          <span data-en>Stay updated with our latest developments, from new openings to product innovation.</span>
          <span data-zh>了解我们的最新进展，从新店开业到产品创新。</span>
        </p>
      </div>
      <div class="iv-news__nav">
        <button type="button" class="iv-news__arrow" data-iv-news="prev" aria-label="Previous">&larr;</button>
        <button type="button" class="iv-news__arrow" data-iv-news="next" aria-label="Next">&rarr;</button>
      </div>
    </div>

    <div class="iv-news__track" id="ivNewsTrack" data-reveal>
      <?php if ( $iv_has_posts ) : ?>
        <?php
        while ( $iv_up_q->have_posts() ) :
          $iv_up_q->the_post();
          ?>
          <a class="iv-news__card" href="<?php the_permalink(); ?>">
            <div class="iv-news__media">
              <?php if ( has_post_thumbnail() ) : ?>
                <?php the_post_thumbnail( 'medium_large' ); ?>
              <?php else : ?>
                <div class="iv-news__ph" aria-hidden="true"></div>
              <?php endif; ?>
            </div>
            <div class="iv-news__body">
              <div class="iv-news__date"><?php echo esc_html( get_the_date( 'j M Y' ) ); ?></div>
              <h3><?php echo hakshan_post_title_bilingual(); ?></h3>
              <p><?php echo hakshan_post_excerpt_bilingual( null, 22 ); ?></p>
              <span class="iv-news__cta">
                <span data-en>Read more</span><span data-zh>阅读全文</span><span class="arr">&rarr;</span>
              </span>
            </div>
          </a>
        <?php endwhile; wp_reset_postdata(); ?>
      <?php else : ?>
        <?php foreach ( $iv_news as $n ) : ?>
          <a class="iv-news__card" href="<?php echo esc_url( $n['url'] ); ?>"<?php echo ! empty( $n['ext'] ) ? ' target="_blank" rel="noopener"' : ''; ?>>
            <div class="iv-news__media">
              <?php if ( ! empty( $n['img'] ) ) : ?>
                <img src="<?php echo esc_url( $n['img'] ); ?>" alt="" loading="lazy" />
              <?php else : ?>
                <div class="iv-news__ph" aria-hidden="true"></div>
              <?php endif; ?>
            </div>
            <div class="iv-news__body">
              <div class="iv-news__date"><?php echo esc_html( $n['date'] ); ?></div>
              <h3><span data-en><?php echo wp_kses_post( $n['title_en'] ); ?></span><span data-zh><?php echo wp_kses_post( $n['title_zh'] ); ?></span></h3>
              <p><span data-en><?php echo esc_html( $n['body_en'] ); ?></span><span data-zh><?php echo esc_html( $n['body_zh'] ); ?></span></p>
              <span class="iv-news__cta">
                <span data-en>Read more</span><span data-zh>阅读全文</span><span class="arr">&rarr;</span>
              </span>
            </div>
          </a>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>
  </div>
</section>

</div><!-- /.iv -->

<!-- ============== CONTACT (CF7 form, preserved) ============== -->
<section class="inv-contact cf7-form-block" id="contact">
  <div class="inv-contact__inner">
    <div data-reveal>
      <span class="h-eyebrow"><span class="dot"></span>
        <span data-en>COME MEET US</span>
        <span data-zh>来认识我们</span>
      </span>
      <h2>
        <span data-en>For the<br/>longer<br/><em>conversations.</em></span>
        <span data-zh>更长的<br/><em>对话。</em></span>
      </h2>
      <p style="margin-top: 24px; color: var(--cream); opacity: 0.85; max-width: 36ch;">
        <span data-en>If you'd like to know more about Hakshan, the family, or what joining us could look like, we'd rather talk than send a pack. Drop us a note. We'll come back to you.</span>
        <span data-zh>如果你想了解客善、了解这个家族，或者想知道加入我们的方式，我们更愿意聊聊，而不是寄一份资料。写信给我们，我们会回。</span>
      </p>
    </div>
    <div data-reveal>
      <div class="form-wrap">
        <h4><span data-en>Tell us about you</span><span data-zh>请 留 下 您 的 信 息</span></h4>
        <?php
        $investor_form_shortcode = '[contact-form-7 id="e36b2ea" title="Investor Inquiry"]';
        $rendered = do_shortcode( $investor_form_shortcode );
        if ( trim( $rendered ) === trim( $investor_form_shortcode ) || empty( $rendered ) ) {
          echo '<p><em>' . esc_html__( 'Contact form not yet configured. Please email hello@hakshan.com in the meantime.', 'hakshan' ) . '</em></p>';
        } else {
          echo $rendered;
        }
        ?>
      </div>
    </div>
  </div>
</section>

<script>
  // Bar-chart animation — read data-h on each .iv-bar__fill and set
  // its height. Defer until the chart enters the viewport so the
  // upward growth is the first thing the reader sees.
  (function () {
    var bars = document.querySelectorAll('.iv-bar__fill');
    if (!bars.length) return;
    function reveal() {
      bars.forEach(function (el) {
        var h = el.getAttribute('data-h');
        if (h) el.style.height = h + '%';
      });
    }
    if ('IntersectionObserver' in window) {
      var chart = document.getElementById('iv-bars');
      if (!chart) { reveal(); return; }
      var seen = false;
      var io = new IntersectionObserver(function (entries) {
        entries.forEach(function (e) {
          if (e.isIntersecting && !seen) {
            seen = true;
            reveal();
            io.disconnect();
          }
        });
      }, { threshold: 0.2 });
      io.observe(chart);
    } else {
      reveal();
    }
  })();
</script>

<script>
  // Hero slideshow — cross-fade with dots. Pauses on hover and when the
  // tab is hidden; does nothing when there is only one slide.
  (function () {
    var slides = document.querySelectorAll('.iv-hero2__slide');
    var dots   = document.querySelectorAll('.iv-hero2__dot');
    if (slides.length < 2) return;
    var i = 0, timer = null, DELAY = 5500;
    function go(n) {
      i = (n + slides.length) % slides.length;
      slides.forEach(function (s, k) { s.classList.toggle('is-on', k === i); });
      dots.forEach(function (d, k) { d.classList.toggle('is-on', k === i); });
    }
    function play()  { stop(); timer = setInterval(function () { go(i + 1); }, DELAY); }
    function stop()  { if (timer) { clearInterval(timer); timer = null; } }
    dots.forEach(function (d) {
      d.addEventListener('click', function () {
        go(parseInt(d.getAttribute('data-iv-slide'), 10) || 0);
        play();
      });
    });
    var hero = document.querySelector('.iv-hero2');
    if (hero) {
      hero.addEventListener('mouseenter', stop);
      hero.addEventListener('mouseleave', play);
    }
    document.addEventListener('visibilitychange', function () {
      if (document.hidden) { stop(); } else { play(); }
    });
    play();
  })();
</script>

<script>
  // News carousel arrows — scroll by one card width.
  (function () {
    var track = document.getElementById('ivNewsTrack');
    if (!track) return;
    function step() {
      var card = track.querySelector('.iv-news__card');
      return card ? card.getBoundingClientRect().width + 20 : 320;
    }
    document.querySelectorAll('[data-iv-news]').forEach(function (b) {
      b.addEventListener('click', function () {
        var dir = b.getAttribute('data-iv-news') === 'prev' ? -1 : 1;
        track.scrollBy({ left: dir * step(), behavior: 'smooth' });
      });
    });
  })();

  // Brand detail modal.
  (function () {
    var modal = document.getElementById('ivBrandModal');
    if (!modal) return;
    var nameEl = document.getElementById('ivBrandName');
    var kindEl = document.getElementById('ivBrandKind');
    var copyEl = document.getElementById('ivBrandCopy');
    var mediaEl = document.getElementById('ivBrandMedia');
    var imgEl = document.getElementById('ivBrandImg');
    var last = null;

    function zh() { return document.body.getAttribute('data-lang') === 'zh'; }

    function open(card) {
      last = card;
      nameEl.textContent = card.getAttribute('data-name') || '';
      kindEl.textContent = (zh() ? card.getAttribute('data-kind-zh') : card.getAttribute('data-kind-en')) || '';
      copyEl.innerHTML   = (zh() ? card.getAttribute('data-detail-zh') : card.getAttribute('data-detail-en')) || '';
      var img = card.getAttribute('data-img');
      if (img) { imgEl.src = img; mediaEl.hidden = false; } else { mediaEl.hidden = true; }
      modal.hidden = false;
      document.body.style.overflow = 'hidden';
      var x = modal.querySelector('.iv-modal__x');
      if (x) x.focus();
    }
    function close() {
      modal.hidden = true;
      document.body.style.overflow = '';
      if (last) last.focus();
    }

    document.querySelectorAll('[data-iv-brand]').forEach(function (card) {
      card.addEventListener('click', function () { open(card); });
      card.addEventListener('keydown', function (e) {
        if (e.key === 'Enter' || e.key === ' ') { e.preventDefault(); open(card); }
      });
    });
    modal.querySelectorAll('[data-iv-brand-close]').forEach(function (b) {
      b.addEventListener('click', close);
    });
    document.addEventListener('keydown', function (e) {
      if (e.key === 'Escape' && !modal.hidden) close();
    });
  })();

  // Org-chart popover — hover on pointer devices, tap/click everywhere.
  (function () {
    var wrap = document.querySelector('.iv-org__wrap');
    var pop  = document.getElementById('ivPop');
    if (!wrap || !pop) return;
    var kicker = document.getElementById('ivPopKicker');
    var title  = document.getElementById('ivPopTitle');
    var body   = document.getElementById('ivPopBody');
    var chips  = document.getElementById('ivPopChips');
    var active = null;
    var canHover = window.matchMedia('(hover:hover) and (pointer:fine)').matches;

    function zh() { return document.body.getAttribute('data-lang') === 'zh'; }

    function show(node) {
      kicker.textContent = node.getAttribute('data-pop-kicker') || '';
      title.textContent  = (zh() ? node.getAttribute('data-pop-title-zh') : node.getAttribute('data-pop-title')) || '';
      body.textContent   = (zh() ? node.getAttribute('data-pop-body-zh') : node.getAttribute('data-pop-body')) || '';
      var raw = node.getAttribute('data-pop-chips');
      if (raw) {
        chips.innerHTML = raw.split('|').map(function (c) {
          return '<span>' + c + '</span>';
        }).join('');
        chips.hidden = false;
      } else {
        chips.hidden = true;
      }
      pop.hidden = false;

      var wr = wrap.getBoundingClientRect();
      var nr = node.getBoundingClientRect();
      var pw = pop.offsetWidth;
      var left = (nr.left - wr.left) + (nr.width / 2) - (pw / 2);
      left = Math.max(8, Math.min(left, wr.width - pw - 8));
      pop.style.left = left + 'px';
      pop.style.top  = ((nr.bottom - wr.top) + 10) + 'px';

      if (active) active.classList.remove('is-active');
      active = node;
      node.classList.add('is-active');
    }
    function hide() {
      pop.hidden = true;
      if (active) { active.classList.remove('is-active'); active = null; }
    }

    document.querySelectorAll('[data-iv-pop]').forEach(function (node) {
      if (canHover) {
        node.addEventListener('mouseenter', function () { show(node); });
        node.addEventListener('mouseleave', hide);
      }
      node.addEventListener('click', function (e) {
        e.stopPropagation();
        if (active === node) { hide(); } else { show(node); }
      });
      node.addEventListener('focus', function () { show(node); });
      node.addEventListener('blur', hide);
    });
    document.addEventListener('click', function (e) {
      if (!pop.hidden && !e.target.closest('[data-iv-pop]')) hide();
    });
    window.addEventListener('resize', hide);
    document.addEventListener('keydown', function (e) { if (e.key === 'Escape') hide(); });
  })();
</script>

<script>
  // Revenue chart: tap a bar to show its value on touch devices.
  (function () {
    var bars = document.querySelectorAll('.iv-bar');
    if (!bars.length || window.matchMedia('(hover:hover)').matches) return;
    bars.forEach(function (b) {
      b.addEventListener('click', function () {
        var on = b.classList.contains('is-on');
        bars.forEach(function (x) { x.classList.remove('is-on'); });
        if (!on) b.classList.add('is-on');
      });
    });
  })();
</script>

<script>
  // Business-model chart: draw the outlet bus + drops over whichever pills
  // land on the first row, and handle tap-to-open on touch screens.
  (function () {
    var chart = document.querySelector('.iv-bm__chart');
    if (!chart) return;
    var row = chart.querySelector('.iv-bm__row--outlets');
    var bus = row ? row.querySelector('.iv-bm__bus') : null;

    function layoutBus() {
      if (!row || !bus) return;
      var pills = Array.prototype.slice.call(row.querySelectorAll('.iv-bm__outlet'));
      if (!pills.length) return;
      var top = pills[0].offsetTop;
      var first = null, last = null;
      pills.forEach(function (p) {
        var onTop = Math.abs(p.offsetTop - top) < 4;
        p.classList.toggle('is-top', onTop);
        if (onTop) { if (!first) first = p; last = p; }
      });
      // Sub-pixel positions (offsetLeft/offsetWidth round to whole pixels,
      // which left the bus ends up to ~1px off the drops).
      var rr = row.getBoundingClientRect();
      var fr = first.getBoundingClientRect(), lr = last.getBoundingClientRect();
      var a = fr.left - rr.left + fr.width / 2;
      var b = lr.left - rr.left + lr.width / 2;
      bus.style.left = (a - 1) + 'px';
      bus.style.width = Math.max(0, b - a + 2) + 'px';
    }
    layoutBus();
    window.addEventListener('resize', layoutBus);
    window.addEventListener('load', layoutBus);
    if (document.fonts && document.fonts.ready) document.fonts.ready.then(layoutBus);

    // Open/close controller. A layer stays open until another is hovered
    // or the pointer leaves the chart, so the reflow never pulls the next
    // row under the cursor and flickers. Hover is ignored mid-scroll.
    chart.classList.add('js');
    var layers = Array.prototype.slice.call(chart.querySelectorAll('.iv-bm__layer'));
    var current = null, openT = null, closeT = null, lastScroll = 0;
    var canHover = window.matchMedia('(hover:hover)').matches;
    window.addEventListener('scroll', function () { lastScroll = Date.now(); }, { passive: true });

    function setOpen(layer) {
      current = layer;
      layers.forEach(function (l) {
        var on = l === layer;
        l.classList.toggle('is-open', on);
        var r = l.querySelector('.iv-bm__row');
        if (r) r.setAttribute('aria-expanded', on ? 'true' : 'false');
      });
      chart.classList.toggle('has-open', !!layer);
    }

    layers.forEach(function (layer) {
      var r = layer.querySelector('.iv-bm__row');
      if (!r) return;
      if (canHover) {
        r.addEventListener('mousemove', function () {
          clearTimeout(closeT);
          if (current === layer || Date.now() - lastScroll < 200) return;
          clearTimeout(openT);
          openT = setTimeout(function () { setOpen(layer); }, 90);
        });
        r.addEventListener('mouseleave', function () { clearTimeout(openT); });
      }
      r.addEventListener('click', function (e) {
        e.stopPropagation();
        setOpen(current === layer ? null : layer);
      });
      r.addEventListener('keydown', function (e) {
        if (e.key === 'Enter' || e.key === ' ') { e.preventDefault(); setOpen(current === layer ? null : layer); }
        if (e.key === 'Escape') setOpen(null);
      });
    });
    if (canHover) {
      chart.addEventListener('mouseleave', function () {
        clearTimeout(openT);
        closeT = setTimeout(function () { setOpen(null); }, 350);
      });
      chart.addEventListener('mouseenter', function () { clearTimeout(closeT); });
    }
    document.addEventListener('click', function (e) {
      if (!chart.contains(e.target)) setOpen(null);
    });
  })();
</script>

<script>
  // Year toggles: open/close a year's outlet row. Tiles stagger in via
  // their --i delay; the row is inert while closed so hidden links cannot
  // be tabbed to.
  (function () {
    document.querySelectorAll('.iv-yr-toggle').forEach(function (btn) {
      var panel = document.getElementById(btn.getAttribute('aria-controls'));
      if (!panel) return;
      var timer = null;
      btn.addEventListener('click', function () {
        var open = btn.getAttribute('aria-expanded') !== 'true';
        btn.setAttribute('aria-expanded', open ? 'true' : 'false');
        clearTimeout(timer);
        panel.classList.remove('is-settled');
        panel.classList.toggle('is-open', open);
        if (open) {
          panel.removeAttribute('inert');
          timer = setTimeout(function () { panel.classList.add('is-settled'); }, 520);
        } else {
          panel.setAttribute('inert', '');
        }
      });
    });
  })();
</script>

<?php
get_footer();
