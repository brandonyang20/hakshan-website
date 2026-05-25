<?php
/**
 * Template Name: Our Story
 * Template Post Type: page
 *
 * @package Hakshan
 */

get_header();
?>
<style>
  /* Story-specific extras */
  .timeline {
    background: var(--cream);
    padding: clamp(80px, 12vw, 140px) var(--rail);
    border-top: 1px solid var(--line-soft);
    border-bottom: 1px solid var(--line-soft);
  }
  .timeline__inner {
    max-width: var(--maxw);
    margin: 0 auto;
    display: grid;
    grid-template-columns: 1fr 2fr;
    gap: 80px;
    align-items: start;
  }
  .timeline__inner > div:first-child .h-eyebrow .dot { background: var(--forest); }
  .timeline__inner h2 {
    font-family: var(--serif);
    font-style: italic;
    font-size: clamp(48px, 7vw, 96px);
    line-height: 0.95;
    margin: 16px 0 0;
    letter-spacing: -0.025em;
    max-width: 12ch;
  }
  .timeline__inner h2 em { color: var(--forest); }
  .timeline__list { display: grid; gap: 0; }
  .tl-row {
    display: grid;
    grid-template-columns: 120px 100px 1fr;
    gap: 32px;
    padding: 32px 0;
    border-top: 1px solid var(--line);
    align-items: start;
  }
  .tl-row:last-child { border-bottom: 1px solid var(--line); }
  .tl-row .year {
    font-family: var(--serif);
    font-style: italic;
    font-size: 44px;
    line-height: 1;
    color: var(--forest);
    letter-spacing: -0.02em;
  }
  .tl-row .cn-big {
    font-family: var(--cn);
    font-size: 30px;
    line-height: 1;
    color: var(--ink);
    letter-spacing: 0.05em;
  }
  .tl-row h3 {
    font-family: var(--serif);
    font-style: italic;
    font-size: 28px;
    margin: 0 0 10px;
    letter-spacing: -0.01em;
  }
  .tl-row p {
    font-size: 14px;
    line-height: 1.65;
    color: var(--ink-soft);
    margin: 0;
    max-width: 50ch;
  }

  /* Three portraits */
  .portraits {
    padding: clamp(80px, 12vw, 140px) var(--rail);
    max-width: var(--maxw);
    margin: 0 auto;
  }
  .portraits__head { text-align: center; margin-bottom: 56px; }
  .portraits__head h2 {
    font-family: var(--serif);
    font-style: italic;
    font-size: clamp(40px, 6vw, 80px);
    line-height: 0.95;
    margin: 12px auto 0;
    max-width: 22ch;
    letter-spacing: -0.02em;
  }
  .portraits__head h2 em { color: var(--forest); }
  .portraits__grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 32px;
  }
  .portrait {
    display: grid;
    gap: 18px;
  }
  .portrait__visual {
    aspect-ratio: 3/4;
    position: relative;
  }
  .portrait__visual .ph { position: absolute; inset: 0; }
  .portrait__num {
    font-family: var(--mono);
    font-size: 11px;
    letter-spacing: 0.16em;
    color: var(--forest);
  }
  .portrait h3 {
    font-family: var(--serif);
    font-style: italic;
    font-size: 28px;
    margin: 0;
    letter-spacing: -0.01em;
  }
  .portrait h3 .cn {
    font-family: var(--cn);
    font-style: normal;
    font-size: 14px;
    color: var(--forest);
    letter-spacing: 0.2em;
    margin-left: 12px;
    opacity: 0.7;
  }
  .portrait p {
    font-size: 14px;
    line-height: 1.65;
    color: var(--ink-soft);
    margin: 0;
  }

  /* Cinematic break (same vocabulary as v1) */
  .cinema-break {
    position: relative;
    min-height: 70vh;
    overflow: hidden;
    display: grid;
    place-items: center;
    background:
      radial-gradient(ellipse at 50% 60%, rgba(196, 177, 138, 0.22) 0%, transparent 55%),
      linear-gradient(180deg, #1a1410 0%, #2a1f15 45%, #14181a 100%);
    color: #EBDFC4;
    padding: 120px var(--rail);
  }
  .cinema-break::before {
    content: ""; position: absolute; inset: 0;
    background: radial-gradient(ellipse at center, transparent 30%, rgba(0,0,0,0.55) 100%);
    pointer-events: none;
  }
  .cinema-break::after {
    content: ""; position: absolute; inset: 0;
    background-image: url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='240' height='240'><filter id='n'><feTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='3' stitchTiles='stitch'/><feColorMatrix values='0 0 0 0 0.9 0 0 0 0 0.85 0 0 0 0 0.65 0 0 0 0.1 0'/></filter><rect width='100%' height='100%' filter='url(%23n)'/></svg>");
    mix-blend-mode: overlay;
    opacity: 0.35;
    pointer-events: none;
  }
  .cinema-break__inner {
    position: relative; z-index: 2;
    text-align: center;
    max-width: 1000px;
  }
  .cinema-break .small {
    font-family: var(--mono);
    font-size: 11px;
    letter-spacing: 0.32em;
    text-transform: uppercase;
    color: rgba(235, 223, 196, 0.6);
    margin-bottom: 32px;
  }
  .cinema-break .small .cn { font-family: var(--cn); margin-right: 14px; letter-spacing: 0.5em; }
  .cinema-break .line {
    font-family: var(--serif);
    font-style: italic;
    font-size: clamp(36px, 5.4vw, 80px);
    line-height: 1.15;
    margin: 0;
    text-wrap: balance;
    text-shadow: 0 2px 32px rgba(0, 0, 0, 0.55);
  }
  .cinema-break .line em { color: #c4b18a; }

  /* Charity block */
  .charity-block {
    background: var(--forest);
    color: var(--cream);
    padding: clamp(100px, 14vw, 160px) var(--rail);
  }
  .charity-block__inner {
    max-width: var(--maxw);
    margin: 0 auto;
    display: grid;
    grid-template-columns: 1fr 1.2fr;
    gap: 80px;
    align-items: start;
  }
  .charity-block .h-eyebrow { color: var(--cream); opacity: 0.7; }
  .charity-block .h-eyebrow .dot { background: var(--cream); }
  .charity-block h2 {
    font-family: var(--serif);
    font-style: italic;
    font-size: clamp(48px, 7vw, 96px);
    line-height: 0.95;
    margin: 12px 0 0;
    letter-spacing: -0.025em;
  }
  .charity-block h2 em { color: var(--cream); border-bottom: 2px solid var(--cream); padding-bottom: 2px; }
  .charity-block p {
    font-size: 17px;
    line-height: 1.75;
    opacity: 0.9;
    margin: 0 0 20px;
    max-width: 56ch;
  }
  .charity-block .lead {
    font-family: var(--serif);
    font-style: italic;
    font-size: 22px;
    opacity: 1;
  }
  .charity-block__stats {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 32px;
    margin-top: 40px;
    padding-top: 32px;
    border-top: 1px solid rgba(235, 223, 196, 0.2);
  }
  .charity-block__stats .num {
    font-family: var(--serif);
    font-style: italic;
    font-size: 64px;
    line-height: 1;
    letter-spacing: -0.025em;
  }
  .charity-block__stats .lbl {
    margin-top: 8px;
    font-family: var(--mono);
    font-size: 10px;
    letter-spacing: 0.2em;
    text-transform: uppercase;
    opacity: 0.7;
    line-height: 1.5;
  }

  /* Press snippets */
  .press {
    padding: clamp(80px, 12vw, 140px) var(--rail);
    max-width: var(--maxw);
    margin: 0 auto;
  }
  .press__head { text-align: center; margin-bottom: 56px; }
  .press__head h2 {
    font-family: var(--serif);
    font-style: italic;
    font-size: clamp(40px, 5.6vw, 72px);
    line-height: 1;
    margin: 12px 0 0;
    letter-spacing: -0.02em;
  }
  .press__list {
    display: grid;
    border-top: 1px solid var(--line);
  }
  .press__row {
    display: grid;
    grid-template-columns: 180px 1fr 180px;
    gap: 32px;
    padding: 32px 0;
    border-bottom: 1px solid var(--line);
    align-items: baseline;
  }
  .press__row .who {
    font-family: var(--mono);
    font-size: 11px;
    letter-spacing: 0.18em;
    text-transform: uppercase;
    color: var(--forest);
  }
  .press__row blockquote {
    font-family: var(--serif);
    font-style: italic;
    font-size: 22px;
    line-height: 1.4;
    margin: 0;
    color: var(--ink);
    letter-spacing: -0.005em;
  }
  .press__row .date {
    font-family: var(--mono);
    font-size: 11px;
    letter-spacing: 0.16em;
    color: var(--mute);
    text-align: right;
  }

  /* Closing CTA */
  .story-close {
    padding: clamp(80px, 12vw, 140px) var(--rail);
    text-align: center;
    background: var(--cream);
  }
  .story-close__inner { max-width: 760px; margin: 0 auto; }
  .story-close h2 {
    font-family: var(--serif);
    font-style: italic;
    font-size: clamp(48px, 7vw, 88px);
    line-height: 1;
    margin: 12px 0 24px;
    letter-spacing: -0.025em;
  }
  .story-close h2 em { color: var(--forest); }
  .story-close .cn {
    font-family: var(--cn);
    font-size: 16px;
    letter-spacing: 0.5em;
    color: var(--forest);
    padding-left: 0.5em;
    margin-bottom: 32px;
    display: block;
    opacity: 0.7;
  }
  .story-close__buttons {
    display: flex;
    gap: 16px;
    justify-content: center;
    flex-wrap: wrap;
  }

  @media (max-width: 980px) {
    .timeline__inner, .charity-block__inner { grid-template-columns: 1fr; gap: 32px; }
    .portraits__grid { grid-template-columns: 1fr; }
    .tl-row { grid-template-columns: 1fr 1fr; }
    .tl-row p { grid-column: 1 / -1; }
    .press__row { grid-template-columns: 1fr; gap: 8px; }
    .press__row .date { text-align: left; }
  }
</style>

<!-- ============== HERO ============== -->
<section class="story-hero">
  <span class="h-eyebrow"><span class="dot"></span>
    <span data-en>OUR STORY · 三 代 故 事</span>
    <span data-zh>三代故事</span>
  </span>
  <h1>
    <span data-en>Three generations.<br/><em>One recipe book.</em></span>
    <span data-zh>三代人，<br/><em>一本食谱。</em></span>
  </h1>
  <p class="deck">
    <span data-en>It is not really a book. It is a stack of yellowed paper, pencilled notes, and three generations of cooks who never quite agreed on how dark the wok should look. We are still cooking out of it.</span>
    <span data-zh>那其实不是一本书。是一沓泛黄的纸、铅笔的字，与三代下厨的人 — 他们从没真正同意过镬要黑到什么程度。我们至今还在照着它做菜。</span>
  </p>
</section>

<!-- ============== TIMELINE ============== -->
<section class="timeline">
  <div class="timeline__inner">
    <div data-reveal>
      <span class="h-eyebrow"><span class="dot"></span>
        <span data-en>SIXTY-EIGHT YEARS, IN BRIEF</span>
        <span data-zh>六十八年·简述</span>
      </span>
      <h2>
        <span data-en>A long, quiet<br/><em>line.</em></span>
        <span data-zh>一条长长，<br/><em>静静的线。</em></span>
      </h2>
    </div>
    <div class="timeline__list" data-reveal>
      <?php
      $timeline = array(
        array( 'year' => '1958', 'cn' => '第 一 代', 'h_en' => 'A home kitchen, Seremban',     'h_zh' => '芙 蓉 · 家 中 厨 房',
               'p_en' => 'The first generation cooks Hakka food at home — salt-baked chicken, mui choy belly, rice-wine chicken soup. No restaurant. No staff. Just a stove, a wok, and a family that keeps showing up to eat.',
               'p_zh' => '第一代在家中煮客家菜 — 盐焗鸡、梅菜扣肉、糯米酒鸡汤。没有餐厅，没有员工。只有一个灶、一只镬，和一屋子总回来吃饭的家人。' ),
        array( 'year' => '2008', 'cn' => '第 二 代', 'h_en' => 'The recipes head north',      'h_zh' => '食 谱 北 上',
               'p_en' => 'The daughter moves to Kuala Lumpur and opens the family\'s first restaurant. For the first time, the dishes are written down — in pencil, on the backs of kuih paper. The recipes do not change. The kitchen, suddenly, has to feed strangers.',
               'p_zh' => '女儿北上吉隆坡，开了家中第一家餐厅。第一次，那些菜被写下来 — 用铅笔，写在糕粿纸背面。食谱没变。厨房，第一次要招待陌生人。' ),
        array( 'year' => '2024', 'cn' => '第 三 代', 'h_en' => 'Hakshan opens, USJ',          'h_zh' => '客 善 开 业 · USJ',
               'p_en' => 'February 2024. The third generation opens Hakshan in USJ. Same recipes — refined by every cook who has held the book since 1958. Same paper. New chairs. A new price point: an RM 15 set. A new rule: fifteen percent of every bill, written into the kitchen\'s costs, returned to community causes.',
               'p_zh' => '2024年2月。第三代在 USJ 开出客善。食谱还是那一本 — 自1958年起，每一位下厨的人都留了一笔。纸还是那叠纸。椅子换了。价位换了 — RM 15套餐。规则也换了 — 每一张账单的15%，写进厨房的成本里，回馈社区。' ),
        array( 'year' => '2025', 'cn' => '巴 生 谷', 'h_en' => 'Eight more kitchens',         'h_zh' => '再 添 八 家',
               'p_en' => 'Eight more outlets open within twenty-two months — Menjalara, Cheras, Bandar Puteri Puchong, IOI Conezion, Budiman Park Kajang, Arcoris Mont Kiara, The Waterfront ParkCity, Plaza Arkadia. Same recipes, same standards, same pencilled paper in every kitchen.',
               'p_zh' => '二十二个月内，再开八家 — 满家拉、蕉赖、蒲种 Bandar Puteri、IOI Conezion、加影、满家乐、ParkCity、Plaza Arkadia。同样的食谱，同样的标准，同样那叠铅笔字的纸。' ),
        array( 'year' => '2026', 'cn' => '今 天',    'h_en' => 'Ten kitchens, one book',      'h_zh' => '十 家 厨 房，一 本 食 谱',
               'p_en' => 'Nine retail outlets and one cloud kitchen across the Klang Valley. The tenth retail outlet and the third cloud kitchen open next month. Penang follows in the second quarter. The book stays in the central kitchen.',
               'p_zh' => '巴生谷九家门店与一家云厨房。第十家门店与第三家云厨房将于下月开业。槟城紧随其后，第二季度开业。那本书，留在中央厨房。' ),
      );
      foreach ( $timeline as $row ) :
        ?>
        <div class="tl-row">
          <div class="year"><?php echo esc_html( $row['year'] ); ?></div>
          <div class="cn-big"><?php echo esc_html( $row['cn'] ); ?></div>
          <div>
            <h3><span data-en><?php echo esc_html( $row['h_en'] ); ?></span><span data-zh><?php echo esc_html( $row['h_zh'] ); ?></span></h3>
            <p><span data-en><?php echo esc_html( $row['p_en'] ); ?></span>
              <span data-zh><?php echo esc_html( $row['p_zh'] ); ?></span></p>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ============== PULL QUOTE ============== -->
<section class="story-pull">
  <div data-reveal>
    <p class="quote">
      <span data-en>"You don't season this dish. <em>You wait for it.</em>"</span>
      <span data-zh>「这道菜不靠调味，<em>靠的是等。</em>」</span>
    </p>
    <div class="by">
      <span data-en>— A SAYING IN OUR KITCHEN</span>
      <span data-zh>— 厨房里的一句老话</span>
    </div>
  </div>
</section>

<!-- ============== STORY BODY ============== -->
<section class="story-body">
  <div data-reveal>
    <span class="small"><span data-en>I · IN SEREMBAN, A STOVE</span><span data-zh>一·芙蓉，一个灶</span></span>
    <p style="font-size: 22px; line-height: 1.5;">
      <span data-en>In 1958, the first generation cooked Hakka food at home in Seremban. Not in a restaurant. Not for a customer. For a family. The stove was wood-fired. The recipes lived in her hands. Nothing was written down — she didn't think she needed to, and she didn't think anyone else would.</span>
      <span data-zh>1958年，第一代在芙蓉的家中煮客家菜。不是餐厅，不是给客人 — 是给家人。灶是柴火灶。食谱在她手里。一字未落于纸 — 她不觉得自己需要，也不觉得别人会需要。</span>
    </p>

    <div class="figure">
      <div class="ph" data-label="First generation · a home kitchen in Seremban, c. 1958"></div>
      <div class="caption"><span data-en>↑ Pl. 01 · A home kitchen in Seremban, c. 1958</span><span data-zh>↑ 图一·芙蓉的家中厨房，约1958</span></div>
    </div>

    <span class="small"><span data-en>II · THE RECIPES GO NORTH</span><span data-zh>二·食谱北上</span></span>
    <p>
      <span data-en>Fifty years later, the second generation moved to Kuala Lumpur and opened the family's first restaurant — a place that would have to feed people who weren't family. For the first time, the dishes were written down. The paper was kuih paper. The ink was pencil. The notes — which kampung the chicken should come from, how dark the wok should look before the pork belly went in, how long to wait — were written in the spaces where they wouldn't slow service down.</span>
      <span data-zh>五十年后，第二代北上。她把食谱带到吉隆坡，开了家中第一家餐厅 — 一间要招待陌生人的餐厅。第一次，那些菜被写下来。纸是糕粿纸。字是铅笔字。批注 — 鸡要从哪个甘榜来、镬要黑到什么程度才下三层肉、要等多久 — 都写在不妨碍出餐的空白处。</span>
    </p>
    <p>
      <span data-en>The recipes did not change. The kitchen, suddenly, had to feed strangers.</span>
      <span data-zh>食谱没变。厨房，第一次要招待陌生人。</span>
    </p>

    <div class="figure">
      <div class="ph" data-label="Second generation · pencil notes on kuih paper, c. 2008"></div>
      <div class="caption"><span data-en>↑ Pl. 02 · The first written copy of the family recipes, c. 2008</span><span data-zh>↑ 图二·家中食谱首次落笔，约2008</span></div>
    </div>

    <h3><span data-en>The third generation opens a door</span><span data-zh>第 三 代 推 开 一 扇 门</span></h3>
    <p>
      <span data-en>In February 2024, the third generation opened Hakshan (客善) in USJ — guest, kindness. Same recipes, refined by every cook who has held the book since 1958. Same paper — the original sits in the central kitchen; pencilled copies hang in every outlet that opens. The chairs are new.</span>
      <span data-zh>2024年2月，第三代在 USJ 开出客善 — 客者，善也。食谱还是那一本 — 自1958年起，每一位下厨的人都留了一笔。纸还是那叠纸 — 原稿留在中央厨房，新开的每一家门店都挂着铅笔字的复印本。椅子换了。</span>
    </p>
    <p>
      <span data-en>The price point is new too — an RM 15 set, more accessible than any restaurant the family has run before. And the discipline that comes with it: fifteen percent of every bill is written into the kitchen's costs and returned to community causes. Not from the profit. From every ringgit. The receipt doesn't say so. You just know.</span>
      <span data-zh>价位也是新的 — RM 15套餐，比家中任何一个餐厅都平易。配套的还有一份纪律：每一张账单的15%，直接写进厨房的成本里，回馈社区。不是从利润出 — 是从营收出。收据上不写。但你心里清楚。</span>
    </p>

    <div class="figure">
      <div class="ph" data-label="Third generation · the central kitchen, Feb 2024"></div>
      <div class="caption"><span data-en>↑ Pl. 03 · The central kitchen, the same recipes, ready for service · USJ, Feb 2024</span>
        <span data-zh>↑ 图三·中央厨房·同一本食谱，准备出餐· USJ，2024年2月</span></div>
    </div>
  </div>
</section>

<!-- ============== CINEMATIC BREAK ============== -->
<section class="cinema-break">
  <div class="cinema-break__inner" data-reveal>
    <div class="small">
      <span class="cn">慢 火</span>
      <span data-en>WHAT WE'VE KEPT</span>
      <span data-zh>我们留下的</span>
    </div>
    <p class="line">
      <span data-en>The book. <em>The fire.</em><br/>The share that always belongs<br/>to <em>someone else.</em></span>
      <span data-zh>那本食谱。<em>那把火。</em><br/>那一份 — <em>永远属于别人的。</em></span>
    </p>
  </div>
</section>

<!-- ============== THREE PORTRAITS ============== -->
<section class="portraits">
  <div class="portraits__head" data-reveal>
    <span class="h-eyebrow"><span class="dot"></span>
      <span data-en>THE FAMILY · 一 家 三 代</span>
      <span data-zh>家·三代</span>
    </span>
    <h2>
      <span data-en>The people who<br/>made the <em>book.</em></span>
      <span data-zh>把食谱<br/>留下来的 <em>人。</em></span>
    </h2>
  </div>
  <div class="portraits__grid" data-reveal>
    <div class="portrait">
      <div class="portrait__visual"><div class="ph" data-label="First generation · a home kitchen in Seremban, c. 1958"></div></div>
      <div class="portrait__num">FIRST GENERATION · 一 代</div>
      <h3>
        <span data-en>She cooked at home</span><span data-zh>她在家中下厨</span>
      </h3>
      <p>
        <span data-en>Seremban, from 1958. Hakka dishes cooked at home — salt-baked chicken, mui choy belly, rice-wine chicken soup. Never ran a restaurant. The recipes lived in her hands.</span>
        <span data-zh>1958年起，于芙蓉。家中烹客家菜 — 盐焗鸡、梅菜扣肉、糯米酒鸡汤。一生未开餐厅。食谱，在她手上。</span>
      </p>
    </div>
    <div class="portrait">
      <div class="portrait__visual"><div class="ph" data-label="Second generation · pencil notes on kuih paper, c. 2008"></div></div>
      <div class="portrait__num">SECOND GENERATION · 二 代</div>
      <h3>
        <span data-en>She wrote it down</span><span data-zh>她把食谱写下来</span>
      </h3>
      <p>
        <span data-en>Brought the recipes north to Kuala Lumpur around 2008 and opened the family's first restaurant. Wrote the dishes down for the first time — in pencil, on the back of kuih paper. The recipes did not change. The kitchen, suddenly, had to feed strangers.</span>
        <span data-zh>约2008年，把食谱带到吉隆坡，开了家中第一家餐厅。第一次把菜写下来 — 用铅笔，写在糕粿纸背面。食谱没变。厨房，第一次要招待陌生人。</span>
      </p>
    </div>
    <div class="portrait">
      <div class="portrait__visual"><div class="ph" data-label="Third generation · the central kitchen, Feb 2024"></div></div>
      <div class="portrait__num">THIRD GENERATION · 三 代</div>
      <h3>
        <span data-en>Same recipes, new room</span><span data-zh>同一本食谱，新的厅</span>
      </h3>
      <p>
        <span data-en>Opened Hakshan in USJ, February 2024. Same recipes. Same paper. New chairs, new price point, and a new rule: fifteen percent of every bill, written into the kitchen's costs, returned to community causes.</span>
        <span data-zh>2024年2月，在 USJ 开出客善。食谱不变，纸不变。椅子换了，价位换了，规则也换了 — 每一张账单的15%，写进厨房的成本里，回馈社区。</span>
      </p>
    </div>
  </div>
</section>

<!-- ============== CHARITY ============== -->
<section class="charity-block" id="charity">
  <div class="charity-block__inner">
    <div data-reveal>
      <span class="h-eyebrow"><span class="dot"></span>
        <span data-en>DINING WITH PURPOSE</span>
        <span data-zh>用餐慈善</span>
      </span>
      <h2>
        <span data-en>Every plate<br/>buys <em>one more.</em></span>
        <span data-zh>一菜<br/><em>一善。</em></span>
      </h2>
    </div>
    <div data-reveal>
      <p class="lead">
        <span data-en>Fifteen percent of every bill at every outlet leaves the till at the end of service. We do not print the amount on the receipt. You just know.</span>
        <span data-zh>每一家门店的每一张账单，15% 在营业结束时即离开钱箱。我们不把金额印在收据上。但你心里清楚。</span>
      </p>
      <p>
        <span data-en>A fixed share of every ringgit is allocated to three focus areas: education, elderly care, and animal welfare. It is not a donation made out of profit. It is written into the kitchen's cost structure — at the same line as rent, food, and staff. It cannot be skipped because there isn't a flag to skip it.</span>
        <span data-zh>每一元营收的固定比例，投入三个方向：教育、长者关怀、动物福利。这不是用利润做的捐赠，而是写进厨房成本结构里的一行 — 与租金、食材、人工同一行。无法被跳过，因为根本没有跳过它的选项。</span>
      </p>
      <div class="charity-block__stats">
        <div><div class="num">15<span style="font-size: 0.55em; opacity: 0.7;">%</span></div>
          <div class="lbl"><span data-en>Of every ringgit</span><span data-zh>每 一 元 营 收</span></div></div>
        <div><div class="num">9 + 1</div>
          <div class="lbl"><span data-en>Outlets participating · all of them</span><span data-zh>参 与 门 店 · 全 部</span></div></div>
        <div><div class="num">3</div>
          <div class="lbl"><span data-en>Focus areas · education, elders, animals</span><span data-zh>三 个 方 向 · 教 育、长 者、动 物</span></div></div>
        <div><div class="num">Feb 2024</div>
          <div class="lbl"><span data-en>Built in from day one · not bolted on later</span><span data-zh>开 业 即 制 度 · 非 事 后 附 加</span></div></div>
      </div>
    </div>
  </div>
</section>

<!-- ============== CLOSE ============== -->
<section class="story-close">
  <div class="story-close__inner" data-reveal>
    <span class="h-eyebrow"><span class="dot"></span>
      <span data-en>COME EAT WITH US</span>
      <span data-zh>来同桌</span>
    </span>
    <h2>
      <span data-en>The book is<br/><em>open.</em></span>
      <span data-zh>那本书，<br/><em>翻开着。</em></span>
    </h2>
    <span class="cn">客 来 茶 当 酒</span>
    <div class="story-close__buttons">
      <a class="btn" href="<?php echo esc_url( hakshan_nav_url( 'contact' ) . '#reserve' ); ?>"><span data-en>Reserve a table</span><span data-zh>预订座位</span><span class="arr">→</span></a>
      <a class="btn btn--ghost" href="<?php echo esc_url( hakshan_nav_url( 'menu' ) ); ?>"><span data-en>See the menu</span><span data-zh>查看菜单</span></a>
    </div>
  </div>
</section>

<?php
get_footer();
