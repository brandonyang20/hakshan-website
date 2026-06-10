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
  .timeline__inner > div:first-child {
    position: sticky;
    top: calc(var(--nav-h, 65px) + 24px);
    align-self: start;
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
    grid-template-columns: 120px 1fr;
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
    .timeline__inner > div:first-child { position: static; }
    .portraits__grid { grid-template-columns: 1fr; }
    .tl-row {
      grid-template-columns: 1fr;
      gap: 10px;
      padding: 24px 0;
    }
    .tl-row .year { font-size: 36px; }
    .press__row { grid-template-columns: 1fr; gap: 8px; }
    .press__row .date { text-align: left; }
  }
</style>

<!-- ============== HERO ============== -->
<section class="story-hero">
  <h1>
    <span data-en>Three Generations<br/><em>One Recipe</em></span>
    <span data-zh>三代人，<br/><em>一菜谱</em></span>
  </h1>
  <p class="deck">
    <span data-en>Hakshan (客善) is a modern Hakka restaurant group, deeply rooted in authentic heritage cuisine and thoughtfully crafted for today's discerning diners. Our journey began with a belief that the rich, time-honoured flavours of Hakka cooking deserve to be preserved, respected, and shared with future generations.</span>
    <span data-zh>客善是一个深植于正宗客家传统美食的现代餐饮集团，专为今日的品味食客精心打造。我们的旅程始于一个坚定的信念：客家菜肴那份丰富、历久弥新的风味，值得被珍视、被尊重，并传承给下一代。</span>
  </p>
</section>

<!-- ============== TIMELINE ============== -->
<section class="timeline">
  <div class="timeline__inner">
    <div data-reveal>
      <span class="h-eyebrow"><span class="dot"></span>
        <span data-en>NEARLY A CENTURY, IN BRIEF</span>
        <span data-zh>近百年·简述</span>
      </span>
      <h2>
        <span data-en>A long, quiet<br/><em>line.</em></span>
        <span data-zh>一条长长，<br/><em>静静的线。</em></span>
      </h2>
    </div>
    <div class="timeline__list" data-reveal>
      <?php
      $timeline = array(
        array( 'year' => '1928', 'h_en' => 'A home kitchen, ancestral village', 'h_zh' => '唐 山 · 家 中 厨 房',
               'p_en' => 'The 1st generation cooks Hakka food at home in the ancestral village: salt-baked chicken, mui choy belly, rice-wine chicken soup. No restaurant. No staff. Just a stove, a wok, and a family that keeps showing up to eat.',
               'p_zh' => '第一代在唐山祖屋的厨房里煮客家菜：盐焗鸡、梅菜扣肉、糯米酒鸡汤。没有餐厅，没有员工。只有一个灶、一只镬，和一屋子总回来吃饭的家人。' ),
        array( 'year' => '1972', 'h_en' => 'The recipes cross the sea', 'h_zh' => '食 谱 南 下',
               'p_en' => 'The 2nd generation brings the recipes south to the Klang Valley and opens the family\'s first restaurant. For the first time, the dishes are written down: in pencil, on the backs of kuih paper. The recipes do not change. The kitchen, suddenly, has to feed strangers.',
               'p_zh' => '第二代把食谱南下带到巴生谷，开了家中第一家餐厅。第一次，那些菜被写下来：用铅笔，写在糕粿纸背面。食谱没变。厨房，第一次要招待陌生人。' ),
        array( 'year' => '2024', 'h_en' => 'Hakshan opens, USJ',          'h_zh' => '客 善 开 业 · USJ',
               'p_en' => 'February. The 3rd generation opens Hakshan in USJ: 客善, guest, kindness. Same recipes, new chairs. Part of every sale returned to the community.',
               'p_zh' => '二月，第三代在 USJ 开出客善：客者，善也。食谱不变，椅子换了。每一笔营业额的一部分，回馈社区。' ),
        array( 'year' => '2025', 'h_en' => 'Six more kitchens',           'h_zh' => '再 添 六 家',
               'p_en' => 'Six more outlets open across the Klang Valley. Seven Hakshan kitchens in total, each running the same recipes under the same kitchen discipline. One million meals served, a 4.7-star rating, and a place among Grab Signature Partners.',
               'p_zh' => '巴生谷再开六家。客善总计七家厨房，每一间用同一本食谱，同一套厨房纪律。累计服务超过一百万人次，平均 4.7 星好评，跻身 Grab Signature 合作伙伴。' ),
        array( 'year' => '2026', 'h_en' => 'Beyond Malaysia',              'h_zh' => '走 出 马 来 西 亚',
               'p_en' => 'By mid-year, thirteen Hakshan kitchens across the Klang Valley and Ipoh: ten outlets and three cloud kitchens. A roadmap to twenty outlets and twenty-five cloud kitchens across Malaysia and Indonesia by year-end. The recipes do not change. The kitchen discipline does not change. What scales is the reach.',
               'p_zh' => '到年中，客善在巴生谷与怡保已有十三家厨房：十家门店，三间云端厨房。目标到年底：在马来西亚与印尼，二十家门店、二十五间云端厨房。食谱不变，厨房纪律不变。扩张的是触达，不是做法。' ),
      );
      foreach ( $timeline as $row ) :
        ?>
        <div class="tl-row">
          <div class="year"><?php echo esc_html( $row['year'] ); ?></div>
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
      <span data-en>A SAYING IN OUR KITCHEN</span>
      <span data-zh>厨房里的一句老话</span>
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
      <span data-en>The book. <em>The fire.</em><br/>Every dish carries it.<br/><em>Written in, every meal.</em></span>
      <span data-zh>那本食谱。<em>那把火。</em><br/>每一道菜，承载着它。<br/><em>写进每一餐里。</em></span>
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
      <div class="portrait__num">FIRST GENERATION · 一 代</div>
      <h3>
        <span data-en>She cooked at home</span><span data-zh>她在家中下厨</span>
      </h3>
      <p>
        <span data-en>The ancestral village, from 1928. Hakka dishes cooked at home: salt-baked chicken, mui choy belly, rice-wine chicken soup. Never ran a restaurant. The recipes lived in her hands.</span>
        <span data-zh>1928年起，于唐山祖屋。家中烹客家菜：盐焗鸡、梅菜扣肉、糯米酒鸡汤。一生未开餐厅。食谱，在她手上。</span>
      </p>
    </div>
    <div class="portrait">
      <div class="portrait__num">SECOND GENERATION · 二 代</div>
      <h3>
        <span data-en>She wrote it down</span><span data-zh>她把食谱写下来</span>
      </h3>
      <p>
        <span data-en>Brought the recipes south to the Klang Valley in 1972 and opened the family's first restaurant. Wrote the dishes down for the first time: in pencil, on the back of kuih paper. The recipes did not change. The kitchen, suddenly, had to feed strangers.</span>
        <span data-zh>1972年，把食谱南下带到巴生谷，开了家中第一家餐厅。第一次把菜写下来：用铅笔，写在糕粿纸背面。食谱没变。厨房，第一次要招待陌生人。</span>
      </p>
    </div>
    <div class="portrait">
      <div class="portrait__num">THIRD GENERATION · 三 代</div>
      <h3>
        <span data-en>Same recipes, new room</span><span data-zh>同一本食谱，新的厅</span>
      </h3>
      <p>
        <span data-en>Opened Hakshan in USJ, February 2024. Same recipes. Same paper. New chairs, new price point, and a new rule: part of every sale returned to community causes.</span>
        <span data-zh>2024年2月，在 USJ 开出客善。食谱不变，纸不变。椅子换了，价位换了，规则也换了：每一笔营业额的一部分，回馈社区。</span>
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
        <span data-en>Pay it<br/><em>Forward.</em></span>
        <span data-zh>一菜<br/><em>一善。</em></span>
      </h2>
    </div>
    <div data-reveal>
      <p class="lead">
        <span data-en>Part of every sale at every outlet goes to community causes. Same rule, every kitchen, every day.</span>
        <span data-zh>每一家门店，每一笔营业额的一部分，拨入社区用途。同一条规则，每一天。</span>
      </p>
      <p>
        <span data-en>Three causes: education, elderly care, and animal welfare. Not a donation made out of profit. It sits in the kitchen's costs alongside rent, food, and staff. There's no flag to skip it.</span>
        <span data-zh>三个方向：教育、长者关怀、动物福利。不是从利润里抽出来的捐赠。它写在厨房成本里，与租金、食材、人工同行。没有可以跳过它的选项。</span>
      </p>
      <div class="charity-block__stats">
        <div><div class="num">9</div>
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
      <span data-en>OUR VISION</span>
      <span data-zh>我们的愿景</span>
    </span>
    <h2>
      <span data-en>Preserving Heritage,<br/><em>Growing with Purpose.</em></span>
      <span data-zh>传承文化，<br/><em>有目标地成长。</em></span>
    </h2>
    <span class="cn">客 来 茶 当 酒</span>
    <p style="margin-top: 32px; font-size: 17px; line-height: 1.7; color: var(--ink-soft); max-width: 50ch;">
      <span data-en>Our vision extends beyond serving exceptional food. We aspire to preserve and elevate authentic Hakka cuisine across the region, while building a trusted and scalable restaurant brand: a recognised name in heritage dining, a place where families return, communities trust, and markets respect.</span>
      <span data-zh>我们的愿景不仅止于提供卓越的美食。我们渴望在整个地区，保存并提升正宗客家菜肴的地位，同时建立一个值得信赖且可规模化的餐饮品牌：客家传统餐饮领域中备受认可的名字，一个家庭愿意回归、社区信任、市场尊重的品牌。</span>
    </p>
    <div class="story-close__buttons">
      <a class="btn" href="<?php echo esc_url( hakshan_nav_url( 'contact' ) . '#reserve' ); ?>"><span data-en>Reserve a table</span><span data-zh>预订座位</span><span class="arr">→</span></a>
      <a class="btn btn--ghost" href="<?php echo esc_url( hakshan_nav_url( 'menu' ) ); ?>"><span data-en>See the menu</span><span data-zh>查看菜单</span></a>
    </div>
  </div>
</section>

<?php
get_footer();
