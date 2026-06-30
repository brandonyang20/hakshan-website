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
  .iv-bar__cap {
    position: absolute;
    top: -22px;
    left: 50%;
    transform: translateX(-50%);
    font-family: var(--serif);
    font-size: 11px;
    color: var(--ink-soft);
    white-space: nowrap;
    opacity: 0;
    transition: opacity 0.2s;
  }
  .iv-bar:hover .iv-bar__cap { opacity: 1; }
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
</style>

<div class="iv">

<!-- ============== 1. HERO ============== -->
<section class="iv-section iv-section--dark iv-hero">
  <div class="iv-wrap">
    <div class="iv-shead" data-reveal style="max-width:none;">
      <span class="h-eyebrow"><span class="dot"></span>
        <span data-en>INVESTMENT PROPOSAL · 2026</span>
        <span data-zh>投资计划书 · 2026</span>
      </span>
      <h1>
        <span data-en>A scalable F&amp;B ecosystem, <em>rooted in heritage.</em></span>
        <span data-zh>可规模化的餐饮生态系统，<em>根植于传承。</em></span>
      </h1>
      <p class="iv-hero__lead">
        <span data-en>Hakshan has grown from a single Hakka restaurant into a disciplined, multi-layer F&amp;B group — proven unit economics, a fast capital payback, and a clear runway across Malaysia, Indonesia and Bangkok.</span>
        <span data-zh>客善从一家客家餐厅起步，发展成纪律严明的多层级餐饮集团——单店经济模型已被验证，资本回收周期短，并在马来西亚、印尼与曼谷拥有清晰的扩张路径。</span>
      </p>
    </div>
    <div class="iv-metrics" data-reveal>
      <div>
        <div class="iv-metric__n">RM <em>800K</em></div>
        <div class="iv-metric__l"><span data-en>Equity round now open</span><span data-zh>本轮融资金额</span></div>
      </div>
      <div>
        <div class="iv-metric__n">RM <em>2.0M</em></div>
        <div class="iv-metric__l"><span data-en>Pre-money valuation</span><span data-zh>投前估值</span></div>
      </div>
      <div>
        <div class="iv-metric__n">40<em>%</em></div>
        <div class="iv-metric__l"><span data-en>Equity offered to investors</span><span data-zh>开放股权比例</span></div>
      </div>
      <div>
        <div class="iv-metric__n">~1<em>yr</em></div>
        <div class="iv-metric__l"><span data-en>Projected capital payback</span><span data-zh>预计资本回收期</span></div>
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
    <div class="iv-miles" data-reveal>
      <div class="iv-mile">
        <div class="iv-mile__tag"><span data-en>Achieved</span><span data-zh>已达成</span></div>
        <div class="iv-mile__yr">2025</div>
        <div class="iv-mile__list">
          <div class="iv-mile__item"><b>7 Outlets</b><span><span data-en>Operating across Kuala Lumpur</span><span data-zh>吉隆坡已开门店</span></span></div>
          <div class="iv-mile__item"><b>RM 20M</b><span><span data-en>Annual revenue</span><span data-zh>年营业额</span></span></div>
          <div class="iv-mile__item"><b>1,000,000+</b><span><span data-en>Meals served</span><span data-zh>累计服务餐数</span></span></div>
          <div class="iv-mile__item"><b>Grab Partner</b><span><span data-en>Achieved within one year</span><span data-zh>开业一年内获得</span></span></div>
        </div>
      </div>
      <div class="iv-mile iv-mile--accent">
        <div class="iv-mile__tag"><span data-en>Projected</span><span data-zh>规划目标</span></div>
        <div class="iv-mile__yr">2026</div>
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
<section class="iv-section iv-section--alt">
  <div class="iv-wrap">
    <div class="iv-shead" data-reveal>
      <span class="h-eyebrow"><span class="dot"></span>
        <span data-en>PERFORMANCE DATA</span>
        <span data-zh>业绩表现</span>
      </span>
      <h2><span data-en>Revenue, <em>climbing.</em></span><span data-zh>营业额，<em>持续攀升。</em></span></h2>
      <p class="lead">
        <span data-en>Fourteen months of monthly revenue — eleven actual, three projected — on a steady upward curve.</span>
        <span data-zh>十四个月的月营业额——十一个月实际、三个月预测——稳步向上。</span>
      </p>
    </div>
    <div class="iv-chart" data-reveal>
      <div class="iv-chart__bars" id="iv-bars">
        <div class="iv-bar"><div class="iv-bar__cap">RM 673K</div><div class="iv-bar__fill" data-h="13.8"></div><div class="iv-bar__lbl">Jul 25</div></div>
        <div class="iv-bar"><div class="iv-bar__cap">RM 784K</div><div class="iv-bar__fill" data-h="16.1"></div><div class="iv-bar__lbl">Aug 25</div></div>
        <div class="iv-bar"><div class="iv-bar__cap">RM 955K</div><div class="iv-bar__fill" data-h="19.6"></div><div class="iv-bar__lbl">Sep 25</div></div>
        <div class="iv-bar"><div class="iv-bar__cap">RM 1.06M</div><div class="iv-bar__fill" data-h="21.7"></div><div class="iv-bar__lbl">Oct 25</div></div>
        <div class="iv-bar"><div class="iv-bar__cap">RM 1.04M</div><div class="iv-bar__fill" data-h="21.2"></div><div class="iv-bar__lbl">Nov 25</div></div>
        <div class="iv-bar"><div class="iv-bar__cap">RM 1.19M</div><div class="iv-bar__fill" data-h="24.4"></div><div class="iv-bar__lbl">Dec 25</div></div>
        <div class="iv-bar"><div class="iv-bar__cap">RM 1.51M</div><div class="iv-bar__fill" data-h="30.9"></div><div class="iv-bar__lbl">Jan 26</div></div>
        <div class="iv-bar"><div class="iv-bar__cap">RM 1.72M</div><div class="iv-bar__fill" data-h="35.3"></div><div class="iv-bar__lbl">Feb 26</div></div>
        <div class="iv-bar"><div class="iv-bar__cap">RM 1.95M</div><div class="iv-bar__fill" data-h="40.0"></div><div class="iv-bar__lbl">Mar 26</div></div>
        <div class="iv-bar"><div class="iv-bar__cap">RM 2.20M</div><div class="iv-bar__fill" data-h="45.1"></div><div class="iv-bar__lbl">Apr 26</div></div>
        <div class="iv-bar"><div class="iv-bar__cap">RM 2.81M</div><div class="iv-bar__fill" data-h="57.7"></div><div class="iv-bar__lbl">May 26</div></div>
        <div class="iv-bar iv-bar--proj"><div class="iv-bar__cap">RM 3.30M</div><div class="iv-bar__fill" data-h="67.6"></div><div class="iv-bar__lbl">Jun 26</div></div>
        <div class="iv-bar iv-bar--proj"><div class="iv-bar__cap">RM 4.45M</div><div class="iv-bar__fill" data-h="91.2"></div><div class="iv-bar__lbl">Jul 26</div></div>
        <div class="iv-bar iv-bar--proj"><div class="iv-bar__cap">RM 4.88M</div><div class="iv-bar__fill" data-h="100"></div><div class="iv-bar__lbl">Aug 26</div></div>
      </div>
      <div class="iv-chart__split">
        <div class="iv-chart__tot"><b>RM 15.9M</b><span><span data-en>11 months actual</span><span data-zh>11 个月实际</span></span></div>
        <div class="iv-chart__tot"><b>RM 12.6M</b><span><span data-en>3 months projected</span><span data-zh>3 个月预测</span></span></div>
      </div>
    </div>
  </div>
</section>

<!-- ============== 4. MARKET VALIDATION ============== -->
<section class="iv-section">
  <div class="iv-wrap">
    <div class="iv-validation__grid">
      <div data-reveal>
        <div class="iv-shead">
          <span class="h-eyebrow"><span class="dot"></span>
            <span data-en>TARGET AUDIENCE &amp; VALIDATION</span>
            <span data-zh>目标客群 &amp; 市场验证</span>
          </span>
          <h2 style="font-size:clamp(28px,3.8vw,46px);">
            <span data-en>Built on repeat,<br/><em>everyday demand.</em></span>
            <span data-zh>建立在反复回流的<br/><em>日常需求之上。</em></span>
          </h2>
        </div>
        <div class="iv-pyramid">
          <div class="iv-pyr iv-pyr-1"><span data-en>White-collar workers</span><span data-zh>白领上班族</span></div>
          <div class="iv-pyr iv-pyr-2"><span data-en>Middle-aged &amp; senior consumers</span><span data-zh>中老年消费者</span></div>
          <div class="iv-pyr iv-pyr-3"><span data-en>Families</span><span data-zh>家庭客群</span></div>
        </div>
      </div>
      <div data-reveal>
        <div class="iv-vstats">
          <div class="iv-vstat">
            <div class="iv-vstat__n">&gt;75<em>%</em></div>
            <div class="iv-vstat__l"><span data-en>Member retention rate</span><span data-zh>会员回头率</span></div>
          </div>
          <div class="iv-vstat">
            <div class="iv-vstat__n">8.36<em>×</em></div>
            <div class="iv-vstat__l"><span data-en>Monthly average visit frequency</span><span data-zh>月均到店次数</span></div>
          </div>
          <div class="iv-vstat">
            <div class="iv-vstat__n">RM 42.45</div>
            <div class="iv-vstat__l"><span data-en>Average spending per customer</span><span data-zh>人均消费</span></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ============== 4b. ORG CHART · Multi-layer F&B Business Model ============== -->
<section class="iv-org" id="structure">
  <div class="iv-org__wrap">
    <h2 class="iv-org__title"><span data-en>Multi-Layer F&amp;B Business Model</span><span data-zh>多层级餐饮商业模式</span></h2>

    <div class="iv-org__chart" data-reveal>
      <!-- Tier 1: Holding -->
      <div class="iv-org__tier">
        <div class="iv-org__node iv-org__node--holding">
          <b><span data-en>Holding Company</span><span data-zh>控股公司</span></b>
        </div>
      </div>

      <!-- Stem down from Holding into the 5-drop bus -->
      <div class="iv-org__stem"></div>
      <div class="iv-org__rail iv-org__rail--5" aria-hidden="true">
        <i></i><i></i><i></i><i></i><i></i>
      </div>

      <!-- Tier 2: Integrated solutions -->
      <div class="iv-org__tier">
        <div class="iv-org__node"><span data-en>Food Trading</span><span data-zh>食材贸易</span></div>
        <div class="iv-org__node"><span data-en>Food Tech</span><span data-zh>餐饮科技</span></div>
        <div class="iv-org__node"><span data-en>Central Kitchen</span><span data-zh>中央厨房</span></div>
        <div class="iv-org__node"><span data-en>Renovation Company</span><span data-zh>装修公司</span></div>
        <div class="iv-org__node"><span data-en>Marketing Company</span><span data-zh>营销公司</span></div>
      </div>

      <!-- Stem down into the outlet bus. Seven drops align with the top
           row of the 7+6 outlet grid; the second row hangs below it. -->
      <div class="iv-org__stem"></div>
      <div class="iv-org__rail iv-org__rail--13" aria-hidden="true">
        <i></i><i></i><i></i><i></i><i></i><i></i><i></i>
      </div>

      <!-- Tier 3: Outlets -->
      <div class="iv-org__tier">
        <div class="iv-org__node iv-org__node--outlet"><b>Outlet 01</b>USJ Taipan</div>
        <div class="iv-org__node iv-org__node--outlet"><b>Outlet 02</b>Menjalara</div>
        <div class="iv-org__node iv-org__node--outlet"><b>Outlet 03</b>Cheras C180</div>
        <div class="iv-org__node iv-org__node--outlet"><b>Outlet 04</b>Bandar Puteri Puchong</div>
        <div class="iv-org__node iv-org__node--outlet"><b>Outlet 05</b>SS2</div>
        <div class="iv-org__node iv-org__node--outlet"><b>Outlet 06</b>Sri Petaling</div>
        <div class="iv-org__node iv-org__node--outlet"><b>Outlet 07</b>Sunway Mentari</div>
        <div class="iv-org__node iv-org__node--outlet"><b>Outlet 08</b>Kota Damansara</div>
        <div class="iv-org__node iv-org__node--outlet"><b>Outlet 09</b>Plaza Damansara</div>
        <div class="iv-org__node iv-org__node--outlet"><b>Outlet 10</b>Pudu Plaza</div>
        <div class="iv-org__node iv-org__node--outlet"><b>Outlet 11</b>Ipoh</div>
        <div class="iv-org__node iv-org__node--outlet"><b>Outlet 12</b>Bukit Tinggi</div>
        <div class="iv-org__node iv-org__node--outlet"><b>Outlet 13</b>Taman Segar</div>
      </div>
    </div>
  </div>
</section>

<!-- ============== 5. BUSINESS MODEL ============== -->
<section class="iv-section iv-section--alt" id="model">
  <div class="iv-wrap">
    <div class="iv-shead" data-reveal>
      <span class="h-eyebrow"><span class="dot"></span>
        <span data-en>BUSINESS MODEL</span>
        <span data-zh>商业模式</span>
      </span>
      <h2>
        <span data-en>One group,<br/><em>three value layers.</em></span>
        <span data-zh>一个集团，<br/><em>三层价值结构。</em></span>
      </h2>
      <p class="lead">
        <span data-en>From single-layer restaurant operations to an integrated, scalable F&amp;B group — each layer compounds margin and reach.</span>
        <span data-zh>从单层餐厅运营，发展为整合且可规模化的餐饮集团——每一层都为利润与触达加乘。</span>
      </p>
    </div>
    <div class="iv-layers" data-reveal>
      <div class="iv-layer">
        <div class="iv-layer__tag">Layer 01</div>
        <div>
          <h3><span data-en>Market Layer — Outlets &amp; Cloud Kitchens</span><span data-zh>市场层 — 门店与云端厨房</span></h3>
          <p>
            <span data-en>The group's core revenue driver. Scalable full-service outlets and delivery-focused cloud kitchens, run on standardised operations and disciplined cost structures for sustainable profitability.</span>
            <span data-zh>集团的核心营收来源。可规模化的全服务门店与外卖导向的云端厨房，以标准化运营与纪律成本结构，实现可持续盈利。</span>
          </p>
          <div class="iv-layer__chips">
            <span class="iv-chip"><span data-en>Direct revenue</span><span data-zh>直营营收</span></span>
            <span class="iv-chip"><span data-en>Brand presence</span><span data-zh>品牌触达</span></span>
            <span class="iv-chip"><span data-en>Proven unit economics</span><span data-zh>已验证的单店模型</span></span>
          </div>
        </div>
        <div class="iv-layer__no">01</div>
      </div>
      <div class="iv-layer">
        <div class="iv-layer__tag">Layer 02</div>
        <div>
          <h3><span data-en>Integrated F&amp;B Solutions</span><span data-zh>整合餐饮解决方案</span></h3>
          <p>
            <span data-en>A shared support ecosystem — central kitchen, food trading, renovation, food technology and marketing — that serves both internal brands and external partners, enhancing margin and efficiency.</span>
            <span data-zh>共享的支援生态——中央厨房、食材贸易、装修、餐饮科技与市场营销——同时服务内部品牌与外部伙伴，提升毛利与效率。</span>
          </p>
          <div class="iv-layer__chips">
            <span class="iv-chip"><span data-en>Food cost −25%</span><span data-zh>食材成本 −25%</span></span>
            <span class="iv-chip"><span data-en>Renovation −30%</span><span data-zh>装修成本 −30%</span></span>
            <span class="iv-chip"><span data-en>Central kitchen</span><span data-zh>中央厨房</span></span>
            <span class="iv-chip"><span data-en>POS &amp; data</span><span data-zh>POS &amp; 数据</span></span>
          </div>
        </div>
        <div class="iv-layer__no">02</div>
      </div>
      <div class="iv-layer">
        <div class="iv-layer__tag">Layer 03</div>
        <div>
          <h3><span data-en>Capital &amp; Strategic Integration</span><span data-zh>资本与战略整合</span></h3>
          <p>
            <span data-en>The holding company consolidates profit, allocates capital and enables scalable expansion — unified governance built for enduring, aligned growth.</span>
            <span data-zh>控股公司整合利润、配置资本，并推动可规模化的扩张——统一的治理结构，为长期且一致的成长而设。</span>
          </p>
          <div class="iv-layer__chips">
            <span class="iv-chip"><span data-en>Consolidated profit</span><span data-zh>合并利润</span></span>
            <span class="iv-chip"><span data-en>Capital allocation</span><span data-zh>资本配置</span></span>
            <span class="iv-chip"><span data-en>Scalable expansion</span><span data-zh>可规模化扩张</span></span>
          </div>
        </div>
        <div class="iv-layer__no">03</div>
      </div>
    </div>
    <div class="iv-engine" data-reveal>
      <div class="iv-engine__media">
        <img src="<?php echo esc_url( get_theme_file_uri( 'assets/img/investor-kitchen.jpg' ) ); ?>" alt="HAKSHAN central kitchen" loading="lazy" />
      </div>
      <div>
        <h3><span data-en>The engine behind the margin.</span><span data-zh>毛利背后的引擎。</span></h3>
        <p>
          <span data-en>Centralised production, bulk procurement and standardised setup compress cost volatility and shorten every outlet's launch cycle — turning capability into repeatable growth.</span>
          <span data-zh>中央化生产、集中采购与标准化建店，压低成本波动，缩短每一家门店的开业周期——把能力转化为可复制的成长。</span>
        </p>
      </div>
    </div>
  </div>
</section>

<!-- ============== 6. EXPANSION ============== -->
<section class="iv-section iv-expansion" id="expansion">
  <div class="iv-wrap">
    <div class="iv-shead" data-reveal>
      <span class="h-eyebrow"><span class="dot"></span>
        <span data-en>STORE EXPANSION &amp; COVERAGE</span>
        <span data-zh>门店扩张 &amp; 覆盖</span>
      </span>
      <h2>
        <span data-en>From Kuala Lumpur<br/><em>to the region.</em></span>
        <span data-zh>从吉隆坡，<br/><em>走向区域市场。</em></span>
      </h2>
    </div>
    <div class="iv-miles" data-reveal>
      <div class="iv-mile">
        <div class="iv-mile__map">
          <img src="https://hakshan.com/wp-content/uploads/2026/06/map-2025.png" alt="HAKSHAN 2025 footprint — seven branches across Kuala Lumpur" loading="lazy" />
        </div>
        <div class="iv-mile__tag">2025 · Malaysia</div>
        <div class="iv-mile__yr"><span data-en>7 branches</span><span data-zh>7 间分店</span></div>
        <p>
          <span data-en>All within Kuala Lumpur. Annual revenue potential of <b style="color:var(--ink)">RM 20M</b>, based on an average RM 230K monthly revenue per outlet.</span>
          <span data-zh>全部位于吉隆坡。年营业额潜力 <b style="color:var(--ink)">RM 20M</b>，按每店月均 RM 230K 计算。</span>
        </p>
      </div>
      <div class="iv-mile iv-mile--accent">
        <div class="iv-mile__map">
          <img src="https://hakshan.com/wp-content/uploads/2026/06/map-2026.png" alt="HAKSHAN 2026 footprint — 17 outlets and 25 cloud kitchens in Malaysia plus regional expansion" loading="lazy" />
        </div>
        <div class="iv-mile__tag">2026 · Regional</div>
        <div class="iv-mile__yr">17 + 25 + 4</div>
        <div class="iv-mile__list">
          <div class="iv-mile__item"><b>17 outlets</b><span><span data-en>Malaysia</span><span data-zh>马来西亚</span></span></div>
          <div class="iv-mile__item"><b>25 cloud kitchens</b><span><span data-en>Malaysia</span><span data-zh>马来西亚</span></span></div>
          <div class="iv-mile__item"><b>2 + 2 outlets</b><span><span data-en>Indonesia &amp; Bangkok</span><span data-zh>印尼 &amp; 曼谷</span></span></div>
          <div class="iv-mile__item"><b>RM 74M</b><span><span data-en>Annual revenue potential</span><span data-zh>年营业额潜力</span></span></div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ============== 6c. TEAM ============== -->
<section class="iv-team" id="team">
  <div class="iv-shead" data-reveal>
    <span class="h-eyebrow"><span class="dot"></span>
      <span data-en>HAKSHAN TEAM</span>
      <span data-zh>客善团队</span>
    </span>
    <h2><span data-en>Operators behind <em>the bowl.</em></span><span data-zh>碗背后的<em>经营者。</em></span></h2>
  </div>
  <?php
  // Team portraits — full WP-media URLs.
  $iv_team_photos = array(
    'ceo' => 'https://hakshan.com/wp-content/uploads/2026/06/Horvard.png',
    'coo' => 'https://hakshan.com/wp-content/uploads/2026/06/Jordan.png',
    'cxo' => 'https://hakshan.com/wp-content/uploads/2026/06/Aaron.png',
    'cfo' => 'https://hakshan.com/wp-content/uploads/2026/06/Layming.png',
    'cpo' => 'https://hakshan.com/wp-content/uploads/2026/06/Madam.png',
  );
  function hakshan_iv_member_photo( $slot, $name ) {
    global $iv_team_photos;
    if ( empty( $iv_team_photos[ $slot ] ) ) {
      return;
    }
    echo '<div class="iv-member__photo">';
    echo '<img src="' . esc_url( $iv_team_photos[ $slot ] ) . '" alt="' . esc_attr( $name ) . '" loading="lazy" />';
    echo '</div>';
  }
  ?>
  <div class="iv-team__grid" data-reveal>
    <article class="iv-member">
      <?php hakshan_iv_member_photo( 'ceo', 'Horvard Chong' ); ?>
      <div class="iv-member__body">
        <p class="iv-member__role">CEO</p>
        <h3 class="iv-member__name">Horvard Chong</h3>
        <ul class="iv-member__bio">
          <li><span data-en>Founder of 營在今銷企業社 (Taiwan), Horvy Supercharge (HK), Horvy Holding Sdn Bhd</span><span data-zh>營在今銷企業社（台湾）、Horvy Supercharge（香港）、Horvy Holding Sdn Bhd 创办人</span></li>
          <li><span data-en>Business Director EMEA of Vertis Media (UK); Managing Director of AJM Marketing Msia</span><span data-zh>Vertis Media（英国）EMEA 业务总监；AJM Marketing 马来西亚董事经理</span></li>
          <li><span data-en>Board Member of M.CACA (NGO)</span><span data-zh>M.CACA（NGO）理事</span></li>
          <li><span data-en>A decade in performance marketing &amp; e-commerce — data-driven strategy, conversion optimisation, revenue growth.</span><span data-zh>十年绩效营销与电商经验——数据驱动策略、转化率优化、营收增长。</span></li>
        </ul>
      </div>
    </article>

    <article class="iv-member">
      <?php hakshan_iv_member_photo( 'coo', 'Jordan Lim' ); ?>
      <div class="iv-member__body">
        <p class="iv-member__role">COO</p>
        <h3 class="iv-member__name">Jordan Lim</h3>
        <ul class="iv-member__bio">
          <li><span data-en>Managing Director of AJM Marketing (Malaysia)</span><span data-zh>AJM Marketing（马来西亚）董事经理</span></li>
          <li><span data-en>Specialises in market strategy and business operations</span><span data-zh>专长于市场策略与业务营运</span></li>
          <li><span data-en>Focuses on brand growth and expansion</span><span data-zh>主导品牌增长与扩张</span></li>
        </ul>
      </div>
    </article>

    <article class="iv-member">
      <?php hakshan_iv_member_photo( 'cxo', 'Aaron Ee' ); ?>
      <div class="iv-member__body">
        <p class="iv-member__role">CBDO</p>
        <h3 class="iv-member__name">Aaron Ee</h3>
        <ul class="iv-member__bio">
          <li><span data-en>Founder &amp; CEO of AJM Marketing (Malaysia)</span><span data-zh>AJM Marketing（马来西亚）创办人兼 CEO</span></li>
          <li><span data-en>Founder &amp; CEO of The Niang's</span><span data-zh>The Niang's 创办人兼 CEO</span></li>
          <li><span data-en>Founder &amp; CEO of Horvy Super Charge (Hong Kong)</span><span data-zh>Horvy Super Charge（香港）创办人兼 CEO</span></li>
          <li><span data-en>Founder &amp; CBDO of HAKSHAN</span><span data-zh>客善创办人兼 CBDO</span></li>
        </ul>
      </div>
    </article>

    <article class="iv-member">
      <?php hakshan_iv_member_photo( 'cfo', 'Lay Ming' ); ?>
      <div class="iv-member__body">
        <p class="iv-member__role">CFO</p>
        <h3 class="iv-member__name">Lay Ming</h3>
        <ul class="iv-member__bio">
          <li><span data-en>13+ years in accounting, tax &amp; audit — corporate finance and regulatory compliance.</span><span data-zh>13 年以上会计、税务与审计经验——擅长企业财务与合规。</span></li>
          <li><span data-en>Former Accountant of a U.S.-listed company — international financial perspective.</span><span data-zh>曾任美国上市公司会计——具备国际财务视角。</span></li>
          <li><span data-en>MIA Chartered Accountant &amp; LSS Green Belt — financial optimisation and efficiency.</span><span data-zh>马来西亚特许会计师 &amp; 精益六西格玛绿带——财务优化与流程效率。</span></li>
          <li><span data-en>IPO &amp; corporate-structuring experience — preparation, compliance, structuring.</span><span data-zh>IPO 与企业架构经验——上市准备、合规与架构搭建。</span></li>
        </ul>
      </div>
    </article>

    <article class="iv-member">
      <?php hakshan_iv_member_photo( 'cpo', 'Madam Siow' ); ?>
      <div class="iv-member__body">
        <p class="iv-member__role">CPO</p>
        <h3 class="iv-member__name">Madam Siow</h3>
        <ul class="iv-member__bio">
          <li><span data-en>Founder of Ying Ker Lou (迎客楼)</span><span data-zh>迎客楼创办人</span></li>
          <li><span data-en>40+ years in the F&amp;B industry</span><span data-zh>四十多年餐饮业经验</span></li>
          <li><span data-en>Mastery of traditional and modern culinary techniques</span><span data-zh>精通传统与现代烹饪技艺</span></li>
        </ul>
      </div>
    </article>
  </div>
</section>

<!-- ============== 7. EQUITY STRUCTURE ============== -->
<section class="iv-section iv-section--dark" id="invest">
  <div class="iv-wrap">
    <div class="iv-shead" data-reveal>
      <span class="h-eyebrow"><span class="dot"></span>
        <span data-en>THE OPPORTUNITY</span>
        <span data-zh>投资机会</span>
      </span>
      <h2>
        <span data-en>Own a stake <em>in the group.</em></span>
        <span data-zh>持有集团的<em>一份股权。</em></span>
      </h2>
    </div>
    <div class="iv-equity" data-reveal>
      <div>
        <div class="iv-donut">
          <div class="iv-donut__lab iv-donut__lab--inv"><b>40%</b><span><span data-en>Open to investment</span><span data-zh>开放融资</span></span></div>
          <div class="iv-donut__lab iv-donut__lab--hold"><b>60%</b><span><span data-en>Holding</span><span data-zh>持股方</span></span></div>
        </div>
      </div>
      <div class="iv-eq__rows">
        <div class="iv-eq__row"><span class="k"><span data-en>Pre-money valuation</span><span data-zh>投前估值</span></span><span class="v">RM <em>2,000,000</em></span></div>
        <div class="iv-eq__row"><span class="k"><span data-en>Equity open this round</span><span data-zh>本轮开放股权</span></span><span class="v">RM <em>800,000</em> · 40%</span></div>
        <div class="iv-eq__row"><span class="k"><span data-en>Share type</span><span data-zh>股权类型</span></span><span class="v"><span data-en>Ordinary share</span><span data-zh>普通股</span></span></div>
        <div class="iv-eq__row"><span class="k"><span data-en>Per lot (2%)</span><span data-zh>每份额(2%)</span></span><span class="v">RM <em>40,000</em></span></div>
        <div class="iv-eq__row"><span class="k"><span data-en>Investment range</span><span data-zh>投资区间</span></span><span class="v"><span data-en>1–5 lots · 2%–10%</span><span data-zh>1–5 份 · 2%–10%</span></span></div>
      </div>
    </div>
  </div>
</section>

<!-- ============== 8. INVESTMENT MODEL ============== -->
<section class="iv-section">
  <div class="iv-wrap">
    <div class="iv-shead" data-reveal>
      <span class="h-eyebrow"><span class="dot"></span>
        <span data-en>INVESTMENT MODEL</span>
        <span data-zh>投资模式</span>
      </span>
      <h2>
        <span data-en>Fast payback,<br/><em>then steady returns.</em></span>
        <span data-zh>快速回本，<br/><em>稳定回报。</em></span>
      </h2>
      <p class="lead">
        <span data-en>A model built to recover capital in about a year — where the conventional restaurant takes three — then reward patient holders with stable dividends.</span>
        <span data-zh>一套约一年即可回本的模式——传统餐厅通常需要三年——之后以稳定分红回报长期股东。</span>
      </p>
    </div>

    <div class="iv-journey" data-reveal>
      <div class="iv-jstep iv-jstep--key"><div class="iv-jstep__dot"></div><div class="iv-jstep__yr">Year 0</div><div class="iv-jstep__v">RM 200,000</div><div class="iv-jstep__d"><span data-en>Invest · 10% stake (5 lots)</span><span data-zh>投资 · 10% 股权 (5 份)</span></div></div>
      <div class="iv-jstep iv-jstep--key"><div class="iv-jstep__dot"></div><div class="iv-jstep__yr">Year 1</div><div class="iv-jstep__v">RM 200,000</div><div class="iv-jstep__d"><span data-en>Profit share · capital fully recovered</span><span data-zh>分红 · 资本全数回收</span></div></div>
      <div class="iv-jstep"><div class="iv-jstep__dot"></div><div class="iv-jstep__yr">Year 2</div><div class="iv-jstep__v">+ RM 45,000</div><div class="iv-jstep__d"><span data-en>Profit share · exit option opens</span><span data-zh>分红 · 可选择退出</span></div></div>
      <div class="iv-jstep"><div class="iv-jstep__dot"></div><div class="iv-jstep__yr">Year 3</div><div class="iv-jstep__v">+ RM 45,000</div><div class="iv-jstep__d"><span data-en>Continue holding</span><span data-zh>继续持有</span></div></div>
      <div class="iv-jstep"><div class="iv-jstep__dot"></div><div class="iv-jstep__yr">Year 4</div><div class="iv-jstep__v">+ RM 45,000</div><div class="iv-jstep__d"><span data-en>Continue holding</span><span data-zh>继续持有</span></div></div>
      <div class="iv-jstep"><div class="iv-jstep__dot"></div><div class="iv-jstep__yr">Year 5</div><div class="iv-jstep__v">+ RM 45,000</div><div class="iv-jstep__d"><span data-en>Continue holding</span><span data-zh>继续持有</span></div></div>
    </div>

    <div class="iv-terms" data-reveal>
      <div class="iv-term"><div class="iv-term__l"><span data-en>Entry — Valuation</span><span data-zh>入场 · 估值</span></div><div class="iv-term__v">RM 2.0M</div></div>
      <div class="iv-term"><div class="iv-term__l"><span data-en>Open for investment</span><span data-zh>开放融资</span></div><div class="iv-term__v">RM 800K</div></div>
      <div class="iv-term"><div class="iv-term__l"><span data-en>Per lot</span><span data-zh>每份</span></div><div class="iv-term__v">RM 40K<small><span data-en>2% · ordinary share</span><span data-zh>2% · 普通股</span></small></div></div>
      <div class="iv-term"><div class="iv-term__l"><span data-en>Exit — after 2 years</span><span data-zh>退出 · 满 2 年后</span></div><div class="iv-term__v"><span data-en>3 options</span><span data-zh>3 种方式</span><small><span data-en>Hold · sell to investors · sell to company</span><span data-zh>继续持有 · 转让其他投资人 · 回售公司</span></small></div></div>
    </div>
    <p class="iv-note">
      <span data-en>Three exit options after two years: continue holding for dividends, sell shares to other investors, or sell back to the company — at market value assessed by a third-party valuer.</span>
      <span data-zh>满两年后三种退出方式：继续持有分红、转让予其他投资人、或回售给公司——价格由独立第三方估值机构按市值评估。</span>
    </p>
  </div>
</section>

<!-- ============== 9. MINIMUM GUARANTEE ============== -->
<section class="iv-section iv-section--alt">
  <div class="iv-wrap">
    <div class="iv-shead" data-reveal>
      <span class="h-eyebrow"><span class="dot"></span>
        <span data-en>MINIMUM GUARANTEE PLAN</span>
        <span data-zh>最低保障方案</span>
      </span>
      <h2><span data-en>Downside, <em>covered.</em></span><span data-zh>下行风险，<em>已被覆盖。</em></span></h2>
    </div>
    <div class="iv-split" data-reveal>
      <div class="iv-split__media">
        <img src="<?php echo esc_url( get_theme_file_uri( 'assets/img/investor-cloud.jpg' ) ); ?>" alt="HAKSHAN cloud kitchen model" loading="lazy" />
      </div>
      <div class="iv-checklist">
        <div class="iv-check">
          <span class="iv-check__i"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4"><path d="M20 6 9 17l-5-5"></path></svg></span>
          <p>
            <span data-en>If a store's revenue falls short, the company activates a <b>Cloud Kitchen plan</b> — delivery-focused outlets in non-competing areas — to supplement returns.</span>
            <span data-zh>若门店营收未达标，公司将启动 <b>云端厨房方案</b>——在不竞争的区域设立外卖型门店——用以补足回报。</span>
          </p>
        </div>
        <div class="iv-check">
          <span class="iv-check__i"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4"><path d="M20 6 9 17l-5-5"></path></svg></span>
          <p>
            <span data-en>Each investor may hold up to <b>1 physical outlet + 3 cloud kitchens</b>.</span>
            <span data-zh>每位投资人可持有最多 <b>1 间实体门店 + 3 间云端厨房</b>。</span>
          </p>
        </div>
        <div class="iv-check">
          <span class="iv-check__i"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4"><path d="M20 6 9 17l-5-5"></path></svg></span>
          <p>
            <span data-en>Each cloud kitchen is expected to generate <b>RM 30,000</b> in monthly revenue.</span>
            <span data-zh>每间云端厨房预计月营业额 <b>RM 30,000</b>。</span>
          </p>
        </div>
        <div class="iv-check">
          <span class="iv-check__i"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4"><path d="M20 6 9 17l-5-5"></path></svg></span>
          <p>
            <span data-en>Each cloud kitchen is projected to earn <b>RM 10,000</b> net profit per month.</span>
            <span data-zh>每间云端厨房预计月净利 <b>RM 10,000</b>。</span>
          </p>
        </div>
      </div>
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

<?php
get_footer();
