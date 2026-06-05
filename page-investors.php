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
      <span data-en>An 18-year kitchen,<br/><em>a new door.</em></span>
      <span data-zh>十八年的厨房，<br/><em>新开一扇门。</em></span>
    </h1>
  </div>
  <p>
    <span data-en>Hakshan Cuisines (客善) was established as an independent venture in February 2024, led by the team behind Ying Ker Lou (迎客楼), an eighteen-year-old Hakka cuisine brand they grew to thirteen retail outlets across Malaysia's major shopping malls. Hakshan applies the same operating discipline to a more accessible price point: an RM 15 set, with a portion of every sale structurally returned to community causes. Nine retail outlets and one cloud kitchen are in operation today; the tenth retail outlet and third cloud kitchen open next month.</span>
    <span data-zh>客善于2024年2月以独立实体成立，由迎客楼的创始团队主理。迎客楼是团队历时十八年打造、于各大商场开设过十三家门店的客家料理老字号。客善把同一套运营纪律带到更平易的价位：RM 15套餐，每一笔营业额的一部分，以制度形式回馈社区。目前营运中共九家门店与一家云厨房，第十家门店与第三家云厨房将于下月开业。</span>
  </p>
</section>

<!-- ============== KEY STATS ============== -->
<section class="inv-stats">
  <div class="inv-stats__grid" data-reveal>
    <div class="inv-stat">
      <div class="num">18<span class="unit">yrs</span></div>
      <div class="lbl"><span data-en>The team's operating track record</span><span data-zh>团 队 经 营 资 历</span></div>
      <div class="sub"><span data-en>Eighteen years building Ying Ker Lou</span><span data-zh>十八年经营迎客楼</span></div>
    </div>
    <div class="inv-stat">
      <div class="num">13</div>
      <div class="lbl"><span data-en>Outlets opened by the same team</span><span data-zh>同 团 队 历 来 开 设 门 店</span></div>
      <div class="sub"><span data-en>Across major Malaysian shopping malls</span><span data-zh>分布于各大商场</span></div>
    </div>
    <div class="inv-stat">
      <div class="num">9 + 1</div>
      <div class="lbl"><span data-en>Hakshan outlets, since Feb 2024</span><span data-zh>客 善 门 店 · 2024 年 2 月 至 今</span></div>
      <div class="sub"><span data-en>10th retail &amp; 3rd cloud kitchen · next month</span><span data-zh>第10家门店与第3家云厨房·下月</span></div>
    </div>
    <div class="inv-stat">
      <div class="num">15<span class="unit">%</span></div>
      <div class="lbl"><span data-en>Of revenue to charity</span><span data-zh>营 收 投 入 慈 善</span></div>
      <div class="sub"><span data-en>Structural · not a side initiative</span><span data-zh>制度化·非附加项目</span></div>
    </div>
  </div>
</section>

<!-- ============== NARRATIVE — INVESTMENT CASE ============== -->
<section class="inv-narrative">
  <div data-reveal>
    <span class="h-eyebrow"><span class="dot"></span>
      <span data-en>I · THE INVESTMENT CASE</span>
      <span data-zh>一·投资要点</span>
    </span>
    <h2>
      <span data-en>Affordable food,<br/><em>with intent.</em></span>
      <span data-zh>平价的食物，<br/><em>有心的经营。</em></span>
    </h2>
  </div>
  <div class="inv-narrative__body" data-reveal>
    <p class="lead">
      <span data-en>A portion of every sale, written into the cost structure, not bolted onto the profit. Philanthropy and profit share the same line item.</span>
      <span data-zh>每一笔营业额的一部分，写进成本结构里，不是从利润里抽出来的。慈善与盈利，写在同一行。</span>
    </p>
    <p>
      <span data-en>Hakshan's proposition begins with eighteen years of accumulated operating experience. The founding team built Ying Ker Lou into a thirteen-outlet Hakka cuisine brand across major Malaysian malls. With Hakshan, they apply the same operating discipline to a more accessible price point: an RM 15 set, with a portion of every sale committed to community causes. The expertise is not new. The brand, the price point, and the discipline of giving are.</span>
      <span data-zh>客善的提案，始于团队累积的十八年经验。这支曾一手打造迎客楼、于各大商场开出十三家客家门店的团队，如今以客善把同一套运营纪律带到更平易的价位：RM 15套餐，每一笔营业额的一部分，制度化地回馈社区。经验不是新的，新的是品牌、价位，与这份给予的纪律。</span>
    </p>
    <span class="small"><span data-en>WHAT MAKES THE MODEL DEFENSIBLE</span><span data-zh>模式的护城河</span></span>
    <p>
      <span data-en>The full back-of-house (preparation, sourcing, training) built and operated by the team. Standard Operating Procedures honed across eighteen years and thirteen prior outlets, applied to every Hakshan outlet from day one, not invented under deadline. Supplier relationships eighteen years deep. Zero wastage as a kitchen discipline, not a marketing line. And a recipe book, three generations of Hakka cuisine, that is not for franchise sale.</span>
      <span data-zh>整条后厨（预备、采购、培训）由团队自建自营。标准作业流程经十八年、十三家门店沉淀，自第一间客善门店开业之日起即投入使用，不是临时拼凑出来的。十八年累积的供应商关系。「零浪费」是厨房纪律，不是营销口号。三代人的客家食谱，不对外出售。</span>
    </p>
    <span class="small"><span data-en>WHY NOW</span><span data-zh>为何此时</span></span>
    <p>
      <span data-en>Expansion is already in motion. The 10th retail outlet and the 3rd cloud kitchen open next month. A Penang outlet (Tanjong Tokong) is targeted for Q2 2026. Pipeline locations include Damansara Uptown, SS15 Subang, the Sunway University area, SS2 Petaling Jaya and Section 14 Petaling Jaya. Each chosen for its community profile, not its rent yield.</span>
      <span data-zh>扩张已在进行。第十家门店与第三家云厨房将于下月开业。槟城丹绒道光店计划于2026年第二季度开业。待进入的地段包括：白沙罗上城、梳邦 SS15、双威大学一带、八打灵 SS2、八打灵14区。选址看的是社区气质，不是租金回报。</span>
    </p>
  </div>
</section>

<!-- ============== UNIT ECONOMICS — FRANCHISE COST FLOW ============== -->
<section class="model" id="model">
  <div class="model__head" data-reveal>
    <div>
      <span class="h-eyebrow"><span class="dot"></span>
        <span data-en>II · UNIT ECONOMICS</span>
        <span data-zh>二·单店经济学</span>
      </span>
      <h2>
        <span data-en>Every ringgit,<br/><em>accounted for.</em></span>
        <span data-zh>每一元，<br/><em>都有去处。</em></span>
      </h2>
    </div>
    <p>
      <span data-en>Each franchise is engineered around a fixed cost structure. Food is held at 30% of revenue; operating expense (rent, utilities, ~10 staff) at 21%; the charity contribution sits in the cost structure, non-negotiable. What's left is the net margin, which the model targets at approximately one-third of revenue.</span>
      <span data-zh>每一家加盟店的成本结构固定：食材30%；运营费用（租金、水电、约10名员工）21%；慈善的部分写在成本结构里，不可调整。剩下的，便是净利率，模型大致定在营收的三分之一。</span>
    </p>
  </div>

  <div class="model__flow" data-reveal>
    <div class="model-node">
      <div class="ix">01 · REVENUE</div>
      <h4><span data-en>Revenue</span><span data-zh>营 业 额</span><span class="cn">营 业 额</span></h4>
      <p><span data-en>RM 15 set as the core price anchor. Per-franchise monthly target supplied on request.</span>
        <span data-zh>RM 15套餐为核心锚点。单店月度目标应求提供。</span></p>
    </div>
    <div class="model-node">
      <div class="ix">02 · FOOD</div>
      <h4><span data-en>Food cost</span><span data-zh>食 材 成 本</span><span class="cn">食 材 成 本</span></h4>
      <p><span data-en>30% of revenue. Fresh ingredients sourced through the in-house supply chain.</span>
        <span data-zh>占营收30%。新鲜食材由自营供应链统一采购。</span></p>
    </div>
    <div class="model-node">
      <div class="ix">03 · OPEX</div>
      <h4><span data-en>Operating expense</span><span data-zh>运 营 费 用</span><span class="cn">运 营 费 用</span></h4>
      <p><span data-en>21% covers rent, utilities, and a team of around ten per outlet.</span>
        <span data-zh>占21%，含租金、水电、约十人团队。</span></p>
    </div>
    <div class="model-node accent">
      <div class="ix">04 · CHARITY</div>
      <h4><span data-en>Charity contribution</span><span data-zh>慈 善 投 入</span><span class="cn">慈 善 投 入</span></h4>
      <p><span data-en>A portion of every sale, structural. Allocated to education, elderly care and animal welfare.</span>
        <span data-zh>每一笔营业额的一部分，制度化。用于教育、敬老、关爱流浪动物。</span></p>
    </div>
    <div class="model-node">
      <div class="ix">05 · NET</div>
      <h4><span data-en>Net margin</span><span data-zh>净 利 率</span><span class="cn">净 利 率</span></h4>
      <p><span data-en>Targeted at ~33.5% of revenue. Full per-franchise figures available on request.</span>
        <span data-zh>目标约为营收的33.5%。完整单店财务数据应求提供。</span></p>
    </div>
  </div>
</section>

<!-- ============== FOOTPRINT & EXPANSION ============== -->
<section class="footprint" id="footprint">
  <div class="footprint__inner">
    <div class="footprint__head" data-reveal>
      <div>
        <span class="h-eyebrow"><span class="dot"></span>
          <span data-en>III · FOOTPRINT &amp; EXPANSION</span>
          <span data-zh>三·现有与扩张</span>
        </span>
        <h2>
          <span data-en>Where the kitchens<br/><em>are, and aren't yet.</em></span>
          <span data-zh>厨房现在哪里，<br/><em>下一步在哪里。</em></span>
        </h2>
      </div>
      <p>
        <span data-en>Hakshan grows at the pace of its supply chain, not its capital. Every new location is chosen for its community profile and its fit with the existing supply network. No outlet has been closed since launch.</span>
        <span data-zh>客善的扩张节奏，跟着供应链，而非资金。每一个新址，都看社区气质与现有供应网络的契合。开业以来无一家门店关闭。</span>
      </p>
    </div>

    <div class="fp-grid" data-reveal>
      <div class="fp-row">
        <h4><span data-en>OPERATING NOW</span><span data-zh>目 前 营 运</span></h4>
        <div class="name"><span data-en>9 retail + 1 cloud</span><span data-zh>9 门 店 + 1 云 厨 房</span></div>
        <p><span data-en>Klang Valley: USJ Taipan, Menjalara, Cheras Traders Sq., Bandar Puteri Puchong, IOI Conezion, Budiman Park Kajang, Arcoris Mont Kiara, The Waterfront ParkCity, Plaza Arkadia.</span>
          <span data-zh>巴生谷：USJ Taipan、满家拉、蕉赖 Traders、蒲种 Bandar Puteri、布城 IOI Conezion、加影 Budiman Park、满家乐 Arcoris、ParkCity Waterfront、Plaza Arkadia。</span></p>
      </div>
      <div class="fp-row">
        <h4><span data-en>OPENING NEXT MONTH</span><span data-zh>下 月 开 业</span></h4>
        <div class="name"><span data-en>10th retail · 3rd cloud</span><span data-zh>第 10 门 店 · 第 3 云 厨 房</span></div>
        <p><span data-en>Tenth retail outlet and third cloud kitchen go live. Capacity for the year's catering and delivery demand effectively doubles.</span>
          <span data-zh>第十家门店与第三家云厨房同步启用。今年外送与包办产能大致翻倍。</span></p>
      </div>
      <div class="fp-row">
        <h4><span data-en>Q2 2026 · PENANG</span><span data-zh>2026 Q2 · 槟 城</span></h4>
        <div class="name"><span data-en>Tanjong Tokong</span><span data-zh>丹 绒 道 光</span></div>
        <p><span data-en>First outlet outside the Klang Valley. Soft launch invitations open via the investor mailing list.</span>
          <span data-zh>巴生谷以外的首店。软开邀请通过投资人名单发出。</span></p>
      </div>
      <div class="fp-row">
        <h4><span data-en>PIPELINE · 2026–2027</span><span data-zh>规 划 中 · 2026–2027</span></h4>
        <div class="name"><span data-en>Five Klang Valley sites</span><span data-zh>五 个 巴 生 谷 地 段</span></div>
        <p><span data-en>Damansara Uptown · SS15 Subang · Sunway University · SS2 Petaling Jaya · Section 14 Petaling Jaya. Each shortlisted for community fit, not footfall alone.</span>
          <span data-zh>白沙罗上城·梳邦 SS15·双威大学一带·八打灵 SS2·八打灵14区。看社区气质，不只看人流。</span></p>
      </div>
      <div class="fp-row">
        <h4><span data-en>ON THE HORIZON</span><span data-zh>远 期 规 划</span></h4>
        <div class="name"><span data-en>Singapore</span><span data-zh>新 加 坡</span></div>
        <p><span data-en>First overseas market under study. No commitments made; supply-chain feasibility under review.</span>
          <span data-zh>首个海外市场研究中。尚未承诺；供应链可行性评估进行中。</span></p>
      </div>
      <div class="fp-row">
        <h4><span data-en>NEVER</span><span data-zh>不 会 做 的</span></h4>
        <div class="name"><span data-en>The recipe book</span><span data-zh>食 谱 本</span></div>
        <p><span data-en>The recipe book is not for franchise sale. The wok master trains every kitchen lead in person.</span>
          <span data-zh>食谱不对外出售。每一位厨房主管由主厨亲自培训。</span></p>
      </div>
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

<!-- ============== INVESTMENT TERMS ============== -->
<section class="terms" id="terms">
  <div class="terms__head" data-reveal>
    <span class="h-eyebrow"><span class="dot"></span>
      <span data-en>IV · INVESTMENT TERMS</span>
      <span data-zh>四·投资条款</span>
    </span>
    <h2>
      <span data-en>The shape<br/>of the <em>offer.</em></span>
      <span data-zh>这一轮的 <em>形状。</em></span>
    </h2>
  </div>

  <div class="terms__grid" data-reveal>
    <div class="terms-card">
      <span class="pill"><span data-en>STRUCTURE</span><span data-zh>结 构</span></span>
      <h3><span data-en>Per-franchise <em>equity</em></span><span data-zh>按 单 店 <em>认 购</em></span></h3>
      <dl class="vals">
        <div class="row"><dt><span data-en>Valuation</span><span data-zh>估值</span></dt><dd>RM 1,000,000</dd></div>
        <div class="row"><dt><span data-en>Open for investment</span><span data-zh>开放认购</span></dt><dd>RM 400,000 (40%)</dd></div>
        <div class="row"><dt><span data-en>Share type</span><span data-zh>股份类型</span></dt><dd><span data-en>Ordinary</span><span data-zh>普通股</span></dd></div>
        <div class="row"><dt><span data-en>Per lot</span><span data-zh>每单位</span></dt><dd>RM 20,000 · 2%</dd></div>
      </dl>
    </div>

    <div class="terms-card">
      <span class="pill"><span data-en>PACKAGE A</span><span data-zh>方 案 A</span></span>
      <h3><span data-en>Under <em>5 lots</em></span><span data-zh>少 于 <em>五 单 位</em></span></h3>
      <p><span data-en>Investment below RM 100,000. Equity stake in a single Hakshan retail outlet, with profit-share once initial capital is recovered.</span>
        <span data-zh>认购金额低于 RM 100,000。持有单一客善门店股权，资本收回后参与利润分享。</span></p>
    </div>

    <div class="terms-card accent">
      <span class="pill"><span data-en>PACKAGE B</span><span data-zh>方 案 B</span></span>
      <h3><span data-en>5 lots <em>and above</em></span><span data-zh>五 单 位 <em>及 以 上</em></span></h3>
      <p><span data-en>Investment from RM 100,000. Shareholder owns one retail outlet plus access to up to three cloud kitchens. This is the company's structural safety net for outlet-level underperformance.</span>
        <span data-zh>认购金额 RM 100,000以上。持有一间门店，并可配置至多三间云厨房。这是公司用以对冲单店表现的制度性安排。</span></p>
    </div>
  </div>

  <div class="terms__note" data-reveal>
    <span data-en><strong>Cloud Kitchen safety net.</strong> If a retail outlet under-performs against the model, the company may open up to three cloud kitchens under the investor in non-competing areas, with the intent of supplementing revenue. Specific allocations are agreed case-by-case.</span>
    <span data-zh><strong>云厨房兜底机制。</strong>若门店表现不及模型预期，公司可在不与现有门店竞争的地段，为该投资人开设至多三间云厨房，用以补充营收。具体安排视个案商定。</span>
  </div>
</section>

<!-- ============== RETURNS & ASSURANCE ============== -->
<section class="returns" id="returns">
  <div class="returns__inner">
    <div class="returns__head" data-reveal>
      <span class="h-eyebrow"><span class="dot"></span>
        <span data-en>V · RETURNS &amp; ASSURANCE</span>
        <span data-zh>五·回报与保障</span>
      </span>
      <h2>
        <span data-en>Capital <em>first.</em><br/>Profit-share <em>after.</em></span>
        <span data-zh><em>先还本，</em><br/><em>后分润。</em></span>
      </h2>
    </div>
    <div class="returns__list" data-reveal>
      <div class="ret-row">
        <h4><span data-en>CAPITAL RECOVERY</span><span data-zh>本 金 回 收</span></h4>
        <div class="name"><span data-en>100% of net profit</span><span data-zh>净 利 100%</span></div>
        <p><span data-en>Until each investor has fully recovered their initial investment, 100% of the franchise's net profit is directed back to investors before any other distribution.</span>
          <span data-zh>在投资人本金完全收回之前，门店净利的100% 优先用于偿还本金，再进行其他分配。</span></p>
      </div>
      <div class="ret-row">
        <h4><span data-en>TARGET PAYBACK</span><span data-zh>预 期 回 本</span></h4>
        <div class="name"><span data-en>Within the first year</span><span data-zh>首 年 内</span></div>
        <p><span data-en>Internal modelling targets capital recovery within the first year of operation. Projection only. Actual payback depends on outlet performance and is not guaranteed.</span>
          <span data-zh>内部模型以开业首年内回本为目标。仅为预测。实际回本视门店表现，不构成担保。</span></p>
      </div>
      <div class="ret-row">
        <h4><span data-en>POST-RECOVERY</span><span data-zh>回 本 之 后</span></h4>
        <div class="name"><span data-en>Ongoing profit-share</span><span data-zh>持 续 利 润 分 享</span></div>
        <p><span data-en>Once capital is recovered, investors participate in the franchise's ongoing profits according to their equity stake.</span>
          <span data-zh>本金收回后，投资人按持股比例参与门店的持续利润分配。</span></p>
      </div>
    </div>
    <div class="returns__note">
      <span data-en>* PROJECTIONS, NOT GUARANTEES. ACTUAL OUTCOMES DEPEND ON OUTLET PERFORMANCE.</span>
      <span data-zh>* 上述为预测，不构成担保。实际结果取决于门店表现。</span>
    </div>
  </div>
</section>

<!-- ============== INV CONTACT ============== -->
<section class="inv-contact" id="contact">
  <div class="inv-contact__inner">
    <div data-reveal>
      <span class="h-eyebrow"><span class="dot"></span>
        <span data-en>VI · REQUEST THE PACK</span>
        <span data-zh>六·索取投资资料</span>
      </span>
      <h2>
        <span data-en>For the<br/>longer<br/><em>conversations.</em></span>
        <span data-zh>更长的<br/><em>对话。</em></span>
      </h2>
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
