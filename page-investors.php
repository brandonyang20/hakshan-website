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
  /* Investor-specific extras */
  .inv-narrative {
    padding: clamp(80px, 12vw, 140px) var(--rail);
    max-width: var(--maxw);
    margin: 0 auto;
    display: grid;
    grid-template-columns: 1fr 1.4fr;
    gap: 80px;
    align-items: start;
  }
  .inv-narrative > div:first-child h2 {
    font-family: var(--serif);
    font-style: italic;
    font-size: clamp(40px, 5.6vw, 76px);
    line-height: 1;
    margin: 12px 0 0;
    letter-spacing: -0.025em;
    max-width: 12ch;
  }
  .inv-narrative > div:first-child h2 em { color: var(--forest); }
  .inv-narrative__body p {
    font-size: 17px;
    line-height: 1.75;
    color: var(--ink);
    margin: 0 0 18px;
    max-width: 60ch;
  }
  .inv-narrative__body p.lead {
    font-family: var(--serif);
    font-style: italic;
    font-size: 24px;
    line-height: 1.45;
    color: var(--forest);
    margin-bottom: 28px;
  }
  .inv-narrative__body .small {
    display: block;
    margin: 32px 0 8px;
    font-family: var(--mono);
    font-size: 11px;
    letter-spacing: 0.18em;
    text-transform: uppercase;
    color: var(--forest);
  }

  /* Charity / Unit-economics flow */
  .model {
    padding: clamp(80px, 12vw, 140px) var(--rail);
    max-width: var(--maxw);
    margin: 0 auto;
  }
  .model__head {
    display: grid;
    grid-template-columns: 1fr 1.4fr;
    gap: 64px;
    align-items: end;
    margin-bottom: 56px;
  }
  .model__head h2 {
    font-family: var(--serif);
    font-style: italic;
    font-size: clamp(40px, 5.6vw, 76px);
    line-height: 1;
    margin: 12px 0 0;
    letter-spacing: -0.025em;
    max-width: 14ch;
  }
  .model__head h2 em { color: var(--forest); }
  .model__head p {
    font-size: 16px;
    line-height: 1.7;
    color: var(--ink-soft);
    margin: 0;
    max-width: 56ch;
  }
  .model__flow {
    display: grid;
    grid-template-columns: repeat(5, 1fr);
    gap: 24px;
    margin-bottom: 56px;
  }
  .model-node {
    padding: 24px;
    border: 1px solid var(--line);
    background: var(--paper);
    display: grid;
    gap: 14px;
    position: relative;
  }
  .model-node::after {
    content: "→";
    position: absolute;
    top: 50%; right: -18px;
    transform: translateY(-50%);
    font-family: var(--serif);
    font-style: italic;
    font-size: 22px;
    color: var(--forest);
    z-index: 2;
  }
  .model-node:last-child::after { display: none; }
  .model-node .ix {
    font-family: var(--mono);
    font-size: 10px;
    letter-spacing: 0.16em;
    color: var(--forest);
  }
  .model-node h4 {
    font-family: var(--serif);
    font-style: italic;
    font-size: 22px;
    margin: 0;
    line-height: 1.1;
    letter-spacing: -0.005em;
  }
  .model-node h4 .cn {
    font-family: var(--cn);
    font-style: normal;
    font-size: 12px;
    color: var(--forest);
    letter-spacing: 0.2em;
    display: block;
    margin-top: 6px;
    opacity: 0.7;
  }
  .model-node p {
    font-size: 13px;
    line-height: 1.6;
    color: var(--ink-soft);
    margin: 0;
  }
  .model-node.accent { background: var(--cream); }

  /* Footprint list */
  .footprint {
    background: var(--cream);
    padding: clamp(80px, 12vw, 140px) var(--rail);
    border-top: 1px solid var(--line-soft);
    border-bottom: 1px solid var(--line-soft);
  }
  .footprint__inner { max-width: var(--maxw); margin: 0 auto; }
  .footprint__head {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 64px;
    align-items: end;
    margin-bottom: 56px;
  }
  .footprint__head h2 {
    font-family: var(--serif);
    font-style: italic;
    font-size: clamp(36px, 5vw, 64px);
    line-height: 1;
    margin: 12px 0 0;
    letter-spacing: -0.02em;
  }
  .footprint__head h2 em { color: var(--forest); }
  .footprint__head p {
    font-size: 15px;
    color: var(--ink-soft);
    line-height: 1.7;
    margin: 0;
  }
  .fp-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 0;
    border-top: 1px solid var(--line);
  }
  .fp-row {
    padding: 28px 32px 28px 0;
    border-bottom: 1px solid var(--line);
  }
  .fp-row + .fp-row { border-left: 1px solid var(--line); padding-left: 32px; }
  .fp-row:nth-child(3n+1) { padding-left: 0; border-left: none; }
  .fp-row h4 {
    font-family: var(--mono);
    font-size: 11px;
    letter-spacing: 0.16em;
    text-transform: uppercase;
    color: var(--forest);
    margin: 0 0 12px;
  }
  .fp-row .name {
    font-family: var(--serif);
    font-style: italic;
    font-size: 26px;
    margin: 0 0 6px;
    letter-spacing: -0.01em;
  }
  .fp-row p {
    font-size: 13px;
    line-height: 1.6;
    color: var(--ink-soft);
    margin: 0;
  }

  /* Investment terms */
  .terms {
    padding: clamp(80px, 12vw, 140px) var(--rail);
    max-width: var(--maxw);
    margin: 0 auto;
  }
  .terms__head { margin-bottom: 48px; max-width: 800px; }
  .terms__head h2 {
    font-family: var(--serif);
    font-style: italic;
    font-size: clamp(40px, 5.6vw, 76px);
    line-height: 1;
    margin: 12px 0 0;
    letter-spacing: -0.025em;
  }
  .terms__head h2 em { color: var(--forest); }
  .terms__grid {
    display: grid;
    grid-template-columns: 1.2fr 1fr 1fr;
    gap: 24px;
    align-items: stretch;
  }
  .terms-card {
    padding: 32px;
    border: 1px solid var(--line);
    background: var(--paper);
    display: flex;
    flex-direction: column;
    gap: 18px;
  }
  .terms-card.accent { background: var(--cream); border-color: var(--forest); }
  .terms-card .ix {
    font-family: var(--mono);
    font-size: 10px;
    letter-spacing: 0.16em;
    color: var(--forest);
    text-transform: uppercase;
  }
  .terms-card h3 {
    font-family: var(--serif);
    font-style: italic;
    font-size: 28px;
    margin: 0;
    line-height: 1.1;
    letter-spacing: -0.01em;
  }
  .terms-card h3 em { color: var(--forest); }
  .terms-card .vals { display: grid; gap: 12px; margin-top: 4px; }
  .terms-card .vals .row {
    display: flex; justify-content: space-between; align-items: baseline;
    padding-bottom: 12px;
    border-bottom: 1px dashed var(--line);
    gap: 16px;
  }
  .terms-card .vals .row:last-child { border-bottom: none; padding-bottom: 0; }
  .terms-card .vals dt {
    font-family: var(--mono);
    font-size: 10px;
    letter-spacing: 0.14em;
    text-transform: uppercase;
    color: var(--mute);
    flex-shrink: 0;
  }
  .terms-card .vals dd {
    margin: 0;
    font-family: var(--serif);
    font-style: italic;
    font-size: 18px;
    color: var(--ink);
    text-align: right;
  }
  .terms-card p {
    font-size: 14px;
    line-height: 1.65;
    color: var(--ink-soft);
    margin: 0;
  }
  .terms-card .pill {
    align-self: flex-start;
    font-family: var(--mono);
    font-size: 10px;
    letter-spacing: 0.16em;
    text-transform: uppercase;
    background: var(--forest);
    color: var(--cream);
    padding: 4px 10px;
    border-radius: 999px;
  }
  .terms-card.accent .pill { background: var(--ink); }
  .terms__note {
    margin-top: 40px;
    padding: 20px 24px;
    border-left: 3px solid var(--forest);
    background: var(--cream);
    font-size: 13px;
    line-height: 1.7;
    color: var(--ink-soft);
    max-width: 64ch;
  }

  /* Returns row (reuses governance grid pattern) */
  .returns {
    background: var(--cream);
    padding: clamp(80px, 12vw, 140px) var(--rail);
    border-top: 1px solid var(--line-soft);
    border-bottom: 1px solid var(--line-soft);
  }
  .returns__inner { max-width: var(--maxw); margin: 0 auto; }
  .returns__head { margin-bottom: 48px; max-width: 800px; }
  .returns__head h2 {
    font-family: var(--serif);
    font-style: italic;
    font-size: clamp(36px, 5vw, 64px);
    line-height: 1;
    margin: 12px 0 0;
    letter-spacing: -0.02em;
  }
  .returns__head h2 em { color: var(--forest); }
  .returns__list {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 0;
    border-top: 1px solid var(--line);
  }
  .ret-row {
    padding: 28px 32px 28px 0;
    border-bottom: 1px solid var(--line);
  }
  .ret-row + .ret-row { border-left: 1px solid var(--line); padding-left: 32px; }
  .ret-row:nth-child(3n+1) { padding-left: 0; border-left: none; }
  .ret-row h4 {
    font-family: var(--mono);
    font-size: 11px;
    letter-spacing: 0.16em;
    text-transform: uppercase;
    color: var(--forest);
    margin: 0 0 12px;
  }
  .ret-row .name {
    font-family: var(--serif);
    font-style: italic;
    font-size: 26px;
    margin: 0 0 6px;
    letter-spacing: -0.01em;
  }
  .ret-row p {
    font-size: 13px;
    line-height: 1.6;
    color: var(--ink-soft);
    margin: 0;
  }
  .returns__note {
    margin-top: 32px;
    font-family: var(--mono);
    font-size: 11px;
    letter-spacing: 0.14em;
    text-transform: uppercase;
    color: var(--mute);
  }

  /* Pull quote */
  .pull-quote {
    padding: clamp(80px, 12vw, 140px) var(--rail);
    text-align: center;
  }
  .pull-quote .inner {
    max-width: 960px;
    margin: 0 auto;
  }
  .pull-quote p {
    font-family: var(--serif);
    font-style: italic;
    font-size: clamp(32px, 4.5vw, 56px);
    line-height: 1.3;
    color: var(--forest);
    margin: 0;
    max-width: 24ch;
    margin-left: auto;
    margin-right: auto;
    letter-spacing: -0.015em;
    text-wrap: balance;
  }
  .pull-quote .by {
    margin-top: 32px;
    font-family: var(--mono);
    font-size: 11px;
    letter-spacing: 0.18em;
    text-transform: uppercase;
    color: var(--mute);
  }

  /* Inv stats: adjust internal layout for richer cells */
  .inv-stats {
    padding-top: clamp(60px, 8vw, 100px);
    padding-bottom: clamp(60px, 8vw, 100px);
  }

  /* ------------------------------------------------------------------
     Holding-structure diagram (Ecosystem section)
     ------------------------------------------------------------------ */
  .org {
    margin-top: clamp(56px, 8vw, 88px);
    border-top: 1px solid var(--line);
    padding-top: clamp(40px, 6vw, 64px);
  }
  .org__caption {
    font-family: var(--mono);
    font-size: 10px;
    letter-spacing: 0.18em;
    text-transform: uppercase;
    color: var(--mute);
    text-align: center;
    margin: 0 0 clamp(24px, 4vw, 40px);
  }

  .org-tier { display: grid; gap: 16px; justify-content: center; }
  .org-tier--holding { grid-template-columns: minmax(220px, 280px); }
  .org-tier--subs    { grid-template-columns: repeat(5, 1fr); }
  .org-tier--outlets { grid-template-columns: repeat(5, 1fr); }

  .org-node {
    background: var(--paper);
    border: 1px solid var(--line);
    padding: 18px 20px;
    display: flex;
    flex-direction: column;
    gap: 6px;
    text-align: left;
    position: relative;
  }
  .org-node .ix {
    font-family: var(--mono);
    font-size: 9px;
    letter-spacing: 0.16em;
    text-transform: uppercase;
    color: var(--forest);
  }
  .org-node h4,
  .org-node .org-node__name {
    font-family: var(--serif);
    font-style: italic;
    font-size: 20px;
    line-height: 1.15;
    margin: 0;
    letter-spacing: -0.01em;
    color: var(--ink);
  }
  .org-node .org-node__name { font-size: 17px; }
  .org-node .org-node__name em { color: var(--forest); font-style: normal; }
  .org-node .org-node__zh,
  .org-node .org-node__sub {
    font-family: var(--mono);
    font-size: 10px;
    letter-spacing: 0.06em;
    color: var(--ink-soft);
    margin: 2px 0 0;
  }
  .org-node--holding {
    background: var(--ink);
    border-color: var(--ink);
    text-align: center;
    align-items: center;
    padding: 24px 28px;
  }
  .org-node--holding .ix { color: rgba(214, 196, 145, 0.85); }
  .org-node--holding h4 { color: var(--cream); font-size: 26px; }
  .org-node--holding h4 em { color: var(--forest); font-style: normal; }
  .org-node--holding .org-node__zh { color: rgba(245, 240, 226, 0.7); }
  .org-node--sub { background: var(--cream); }
  .org-node--outlet { padding: 14px 16px; }
  .org-node--outlet .org-node__name { font-size: 15px; }
  .org-node--outlet .org-node__sub { font-size: 9.5px; letter-spacing: 0.1em; text-transform: uppercase; }

  /* Rails: vertical stems + horizontal bar connecting tiers */
  .org-rail {
    position: relative;
    width: 100%;
    margin: 0 auto;
    pointer-events: none;
  }
  .org-rail--branch { height: 56px; }
  .org-rail--branch::before {
    content: ''; position: absolute;
    top: 0; left: 50%;
    width: 1px; height: 28px;
    background: var(--line);
  }
  .org-rail--branch::after {
    content: ''; position: absolute;
    top: 28px;
    left: 10%; right: 10%;
    height: 1px;
    background: var(--line);
  }
  .org-rail--branch .drops {
    position: absolute;
    top: 28px; left: 0; right: 0;
    height: 28px;
    display: grid;
    grid-template-columns: repeat(5, 1fr);
    gap: 16px;
  }
  .org-rail--branch .drops span {
    width: 1px;
    background: var(--line);
    justify-self: center;
    height: 100%;
  }
  .org-rail--single { height: 56px; }
  .org-rail--single::before {
    content: ''; position: absolute;
    top: 0; left: 50%;
    width: 1px; height: 100%;
    background: var(--line);
  }

  @media (max-width: 900px) {
    .org-tier--subs    { grid-template-columns: repeat(2, 1fr); }
    .org-tier--outlets { grid-template-columns: repeat(2, 1fr); }
    /* Collapse the branched rail to a single central stem on narrow viewports. */
    .org-rail--branch::after,
    .org-rail--branch .drops { display: none; }
    .org-rail--branch::before { height: 100%; }
  }
  @media (max-width: 560px) {
    .org-tier--subs    { grid-template-columns: 1fr; }
    .org-tier--outlets { grid-template-columns: 1fr; }
  }

  /* Investor contact form embed */
  .inv-contact .form-wrap {
    background: var(--cream);
    padding: 28px;
    color: var(--ink);
  }
  .inv-contact .form-wrap h4 {
    font-family: var(--mono);
    font-size: 11px;
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
    .inv-narrative, .footprint__head, .model__head { grid-template-columns: 1fr; gap: 32px; }
    .model__flow { grid-template-columns: 1fr 1fr; gap: 32px; }
    .model-node::after { display: none; }
    .fp-grid, .returns__list { grid-template-columns: 1fr; }
    .fp-row, .fp-row + .fp-row,
    .ret-row, .ret-row + .ret-row { padding-left: 0; border-left: none; }
    .inv-stats__grid { grid-template-columns: 1fr 1fr; }
    .terms__grid { grid-template-columns: 1fr; }
  }
</style>

<!-- ============== HERO ============== -->
<section class="inv-hero">
  <div>
    <span class="h-eyebrow"><span class="dot"></span>
      <span data-en>INVESTOR RELATIONS · 投 资 者 关 系</span>
      <span data-zh>投资者关系</span>
    </span>
    <h1>
      <span data-en>Shaping the future<br/>of <em>heritage dining.</em></span>
      <span data-zh>重新定义<br/><em>传统餐饮的未来。</em></span>
    </h1>
  </div>
  <p>
    <span data-en>Hakshan stands at the intersection of culinary tradition and strategic innovation. We're building a scalable, integrated food and beverage ecosystem that redefines heritage cuisine for the modern era through disciplined growth and operational excellence.</span>
    <span data-zh>客善将文化传承与商业创新完美融合。我们正通过严谨的增长与卓越的运营，构建一个可规模化的综合餐饮生态，为现代社会重新定义传统美食。</span>
  </p>
</section>

<!-- ============== CORE STRATEGIC POTENTIAL ============== -->
<section class="footprint" id="strategy">
  <div class="footprint__inner">
    <div class="footprint__head" data-reveal>
      <div>
        <span class="h-eyebrow"><span class="dot"></span>
          <span data-en>CORE STRATEGIC POTENTIAL</span>
          <span data-zh>核 心 战 略 潜 力</span>
        </span>
        <h2>
          <span data-en>What we're<br/><em>built on.</em></span>
          <span data-zh>我们的<br/><em>立足之本。</em></span>
        </h2>
      </div>
      <p>
        <span data-en>Three pillars hold the model together: the way we cook, the way we standardise, and the way we scale.</span>
        <span data-zh>支撑模式的三根柱子：我们怎么做菜，怎么标准化，怎么扩张。</span>
      </p>
    </div>

    <div class="fp-grid" data-reveal>
      <div class="fp-row">
        <h4><span data-en>TRADITION + INNOVATION</span><span data-zh>传 承 与 创 新</span></h4>
        <div class="name"><span data-en>Elevating tradition</span><span data-zh>升 华 传 统</span></div>
        <p><span data-en>Authentic Hakka flavours in a sophisticated, contemporary dining environment. By bridging ancestral recipes with modern lifestyles, we've created a refined concept that resonates with a diverse, loyal audience.</span>
          <span data-zh>正宗客家风味，精致而现代的餐饮空间。我们在祖传食谱与今日生活之间架起桥梁，创造了一个深受市场青睐的精致餐饮概念。</span></p>
      </div>
      <div class="fp-row">
        <h4><span data-en>PRECISION + CONSISTENCY</span><span data-zh>精 准 与 一 致</span></h4>
        <div class="name"><span data-en>Standardised at every kitchen</span><span data-zh>每 间 厨 房 标 准 化</span></div>
        <p><span data-en>Our culinary foundation is built on standardised artisan recipes. Traditional methods, modern food technology. Every outlet delivers the same high-quality flavours, every time.</span>
          <span data-zh>我们的烹饪基石是标准化的工匠配方。传统工艺，现代食品科技。每家门店，每一次出餐，风味始终如一。</span></p>
      </div>
      <div class="fp-row">
        <h4><span data-en>OPERATIONAL SCALABILITY</span><span data-zh>运 营 可 扩 展</span></h4>
        <div class="name"><span data-en>Built to scale</span><span data-zh>为 扩 张 而 建</span></div>
        <p><span data-en>From procurement to delivery, our systems run end to end. Controlled expansion, exceptional cost management, food costs held under 30%.</span>
          <span data-zh>从采购到交付，系统贯通。受控扩张，卓越成本管理，食材成本稳定在 30% 以下。</span></p>
      </div>
    </div>
  </div>
</section>

<!-- ============== MULTI-LAYERED ECOSYSTEM ============== -->
<section class="footprint" id="ecosystem">
  <div class="footprint__inner">
    <div class="footprint__head" data-reveal>
      <div>
        <span class="h-eyebrow"><span class="dot"></span>
          <span data-en>OUR ECOSYSTEM</span>
          <span data-zh>多 层 次 生 态</span>
        </span>
        <h2>
          <span data-en>Three layers,<br/><em>one business.</em></span>
          <span data-zh>三层结构，<br/><em>一盘生意。</em></span>
        </h2>
      </div>
      <p>
        <span data-en>Hakshan is more than a restaurant brand. Under one holding sit five integrated entities — central kitchen, food trading, food technology, construction, and marketing — supplying the outlets and powering regional expansion store by store.</span>
        <span data-zh>客善不只是一个餐饮品牌。控股之下，五个整合实体：中央厨房、食品贸易、食品科技、装修工程与营销，为门店供给、为区域扩张提供动力。</span>
      </p>
    </div>

    <div class="fp-grid" data-reveal>
      <div class="fp-row">
        <h4><span data-en>I · MARKET LAYER</span><span data-zh>一 · 市 场 层</span></h4>
        <div class="name"><span data-en>Outlets</span><span data-zh>门 店</span></div>
        <p><span data-en>Our physical locations are high-performance revenue generators, operating on a validated single-store profit model with strong market acceptance.</span>
          <span data-zh>实体门店是高效的收入中心，基于经验证的单店盈利模型运营，市场认可度强。</span></p>
      </div>
      <div class="fp-row">
        <h4><span data-en>II · SOLUTIONS LAYER</span><span data-zh>二 · 解 决 方 案 层</span></h4>
        <div class="name"><span data-en>Synergy</span><span data-zh>协 同</span></div>
        <p><span data-en>Five integrated entities under the holding: central kitchen, food trading, food technology, construction, and marketing. Support systems that optimise profitability and act as the growth engine for both internal expansion and external opportunities.</span>
          <span data-zh>控股之下，五个整合实体：中央厨房、食品贸易、食品科技、装修工程、营销。综合支持系统优化盈利能力，是内部扩张与外部机会的增长引擎。</span></p>
      </div>
      <div class="fp-row">
        <h4><span data-en>III · STRATEGIC LAYER</span><span data-zh>三 · 战 略 层</span></h4>
        <div class="name"><span data-en>Leadership</span><span data-zh>领 航</span></div>
        <p><span data-en>Our holding structure provides the capital allocation and strategic foresight needed for large-scale regional expansion.</span>
          <span data-zh>控股结构提供大规模区域扩张所需的资本配置与战略远见。</span></p>
      </div>
    </div>

    <?php
    $org_subs = array(
      array( 'name_en' => 'Central Kitchen',  'name_zh' => '中央厨房',     'sub_en' => 'Supply · standards · throughput',    'sub_zh' => 'SUPPLY · STANDARDS' ),
      array( 'name_en' => 'Food Trading',     'name_zh' => '食品贸易',     'sub_en' => 'Procurement · distribution',         'sub_zh' => 'PROCUREMENT' ),
      array( 'name_en' => 'Food Technology',  'name_zh' => '食品科技',     'sub_en' => 'R&D · process · shelf life',         'sub_zh' => 'R&D · PROCESS' ),
      array( 'name_en' => 'Construction',     'name_zh' => '装修工程',     'sub_en' => 'Fit-out · build · roll-out',         'sub_zh' => 'FIT-OUT · BUILD' ),
      array( 'name_en' => 'Marketing',        'name_zh' => '营销公司',     'sub_en' => 'Brand · channels · community',       'sub_zh' => 'BRAND · CHANNELS' ),
    );
    $org_outlets = function_exists( 'hakshan_get_outlets' ) ? hakshan_get_outlets() : array();
    ?>
    <div class="org" data-reveal aria-label="Hakshan organisational structure">
      <p class="org__caption">
        <span data-en>HOW THE BUSINESS IS BUILT &nbsp;·&nbsp; HOLDING · FIVE ENTITIES · OUTLETS</span>
        <span data-zh>商业结构 &nbsp;·&nbsp; 控股 · 五个实体 · 门店</span>
      </p>

      <!-- Tier 1: Holding -->
      <div class="org-tier org-tier--holding">
        <div class="org-node org-node--holding">
          <span class="ix">N° 00 · HOLDING</span>
          <h4><span data-en>Hakshan Group</span><span data-zh>客善控股</span></h4>
          <div class="org-node__zh"><span data-en>Capital, strategy, regional vision.</span><span data-zh>资本 · 战略 · 区域视野</span></div>
        </div>
      </div>

      <!-- Rail: holding → subs -->
      <div class="org-rail org-rail--branch" aria-hidden="true">
        <div class="drops">
          <?php for ( $i = 0; $i < 5; $i++ ) : ?><span></span><?php endfor; ?>
        </div>
      </div>

      <!-- Tier 2: 5 subsidiaries -->
      <div class="org-tier org-tier--subs">
        <?php foreach ( $org_subs as $i => $sub ) : ?>
          <div class="org-node org-node--sub">
            <span class="ix">N° <?php echo sprintf( '%02d', $i + 1 ); ?></span>
            <div class="org-node__name"><span data-en><?php echo esc_html( $sub['name_en'] ); ?></span><span data-zh><?php echo esc_html( $sub['name_zh'] ); ?></span></div>
            <div class="org-node__sub"><span data-en><?php echo esc_html( $sub['sub_en'] ); ?></span><span data-zh><?php echo esc_html( $sub['sub_zh'] ); ?></span></div>
          </div>
        <?php endforeach; ?>
      </div>

      <?php if ( ! empty( $org_outlets ) ) : ?>
        <!-- Rail: subs → outlets -->
        <div class="org-rail org-rail--single" aria-hidden="true"></div>

        <!-- Tier 3: outlets, pulled from CPT -->
        <div class="org-tier org-tier--outlets">
          <?php
          foreach ( $org_outlets as $i => $outlet ) :
            $data = hakshan_get_outlet_data( $outlet->ID );
            if ( empty( $data['name'] ) ) {
              continue;
            }
            $city = ! empty( $data['city'] ) ? ucwords( strtolower( $data['city'] ) ) : '';
            ?>
            <div class="org-node org-node--outlet">
              <span class="ix">N° <?php echo sprintf( '%02d', $i + 1 ); ?></span>
              <div class="org-node__name"><?php echo esc_html( $data['name'] ); ?></div>
              <?php if ( $city ) : ?>
                <div class="org-node__sub"><?php echo esc_html( $city ); ?></div>
              <?php endif; ?>
            </div>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>
    </div>
  </div>
</section>

<!-- ============== PROVEN SUCCESS TRAJECTORY ============== -->
<section class="inv-stats">
  <div class="footprint__head" data-reveal style="max-width: var(--maxw); margin: 0 auto 60px; padding: 0 var(--rail);">
    <div>
      <span class="h-eyebrow"><span class="dot"></span>
        <span data-en>PROVEN SUCCESS TRAJECTORY</span>
        <span data-zh>经 验 证 的 轨 迹</span>
      </span>
      <h2>
        <span data-en>Where we've been,<br/><em>where we're going.</em></span>
        <span data-zh>已 走 过 的 路，<br/><em>还 要 走 的 路。</em></span>
      </h2>
    </div>
    <p>
      <span data-en>Real numbers, not projections wrapped as facts. The growth is happening; the trajectory is documented; the next chapter is funded by the work already done.</span>
      <span data-zh>真实的数字，不是把预测当作事实。增长正在发生，轨迹有据可查，下一章靠已经做出来的工作支撑。</span>
    </p>
  </div>
  <div class="inv-stats__grid" data-reveal>
    <div class="inv-stat">
      <div class="num">13<span class="unit"> → 45</span></div>
      <div class="lbl"><span data-en>Kitchens, by 2026</span><span data-zh>厨 房 · 至 2026</span></div>
      <div class="sub"><span data-en>Thirteen kitchens today (ten outlets, three cloud kitchens). Roadmap to twenty outlets and twenty-five cloud kitchens across Malaysia and Indonesia by year-end.</span><span data-zh>今天十三家厨房（十家门店、三间云端厨房）。目标：年底前在马来西亚与印尼达成二十家门店与二十五间云端厨房。</span></div>
    </div>
    <div class="inv-stat">
      <div class="num">RM <span style="font-size: 0.7em;">74</span><span class="unit">M</span></div>
      <div class="lbl"><span data-en>Projected revenue, 2026</span><span data-zh>预 计 营 收 · 2026</span></div>
      <div class="sub"><span data-en>RM 20 million in 2025, projected at RM 74 million by 2026.</span><span data-zh>2025 年 2,000 万马币，2026 年预计 7,400 万马币。</span></div>
    </div>
    <div class="inv-stat">
      <div class="num">1M<span class="unit">+</span></div>
      <div class="lbl"><span data-en>Meals served · 4.7 ★</span><span data-zh>服 务 餐 次 · 4.7 星</span></div>
      <div class="sub"><span data-en>Over a million meals served. A trusted Grab Signature Partner, leading in both dine-in and delivery.</span><span data-zh>累计服务超过一百万人次，平均 4.7 星好评，跻身 Grab Signature 合作伙伴。</span></div>
    </div>
  </div>
</section>

<!-- ============== PULL QUOTE ============== -->
<section class="pull-quote">
  <div class="inner" data-reveal>
    <p>
      <span data-en>A good person inspires <em>goodness in others.</em></span>
      <span data-zh>善人者，<em>人必善之。</em></span>
    </p>
    <div class="by">
      <span data-en>THE PHILOSOPHY BEHIND HAKSHAN'S BUSINESS MODEL</span>
      <span data-zh>客善商业模式的信念</span>
    </div>
  </div>
</section>

<!-- ============== INV CONTACT ============== -->
<section class="inv-contact" id="contact">
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
      <div class="card" style="margin-top: 32px;">
        <h4><span data-en>Direct contact</span><span data-zh>直 接 联 系</span></h4>
        <p><a href="mailto:hello@hakshan.com" style="color: var(--cream);">hello@hakshan.com</a></p>
      </div>
    </div>
    <div data-reveal>
      <div class="form-wrap">
        <h4><span data-en>Tell us about you</span><span data-zh>请 留 下 您 的 信 息</span></h4>
        <?php
        // Contact Form 7 embed.
        // Replace REPLACE_ME with the actual form ID once the investor form is created in WP admin
        // (Contact → Contact Forms). Until then, the placeholder below renders nothing on the front-end.
        $investor_form_shortcode = '[contact-form-7 id="REPLACE_ME" title="Investor Inquiry"]';
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

<?php
get_footer();
