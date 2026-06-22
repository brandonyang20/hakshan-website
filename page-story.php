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
  /* ============== HERO ============== */
  .sh-hero {
    position: relative;
    background: #231A12;
    color: #F3EAD9;
    overflow: hidden;
  }
  .sh-hero__grid {
    max-width: var(--maxw);
    margin: 0 auto;
    display: grid;
    grid-template-columns: 1.05fr .95fr;
    min-height: min(86vh, 760px);
  }
  .sh-hero__copy {
    display: flex;
    flex-direction: column;
    justify-content: center;
    padding: clamp(60px, 7vw, 100px) var(--rail);
  }
  .sh-hero__cjk {
    display: block;
    font-family: var(--cn);
    font-size: clamp(18px, 2vw, 26px);
    letter-spacing: 0.3em;
    color: #C49B66;
    margin-bottom: 26px;
  }
  .sh-hero h1 {
    font-family: var(--serif);
    font-weight: 400;
    font-size: clamp(56px, 9vw, 128px);
    letter-spacing: 0.06em;
    line-height: 1;
    margin: 0;
    color: inherit;
  }
  .sh-hero__sub {
    font-size: clamp(17px, 1.6vw, 21px);
    line-height: 1.6;
    color: rgba(243, 234, 217, 0.78);
    max-width: 36ch;
    margin: 30px 0 36px;
  }
  .sh-hero__actions {
    display: flex;
    gap: 14px;
    flex-wrap: wrap;
  }
  .sh-hero__actions .btn {
    background: #F3EAD9;
    color: #231A12;
    border-color: transparent;
  }
  .sh-hero__actions .btn:hover {
    background: #C49B66;
    color: #F3EAD9;
  }
  .sh-hero__actions .btn--ghost {
    background: transparent;
    color: #F3EAD9;
    border: 1px solid rgba(243, 234, 217, 0.4);
  }
  .sh-hero__actions .btn--ghost:hover {
    border-color: #F3EAD9;
    background: transparent;
    color: #F3EAD9;
  }
  .sh-hero__media {
    position: relative;
    min-height: 360px;
  }
  .sh-hero__media img {
    position: absolute;
    inset: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
  }
  .sh-hero__media::after {
    content: "";
    position: absolute;
    inset: 0;
    background: linear-gradient(270deg, transparent 60%, rgba(35, 26, 18, 0.55) 100%);
    pointer-events: none;
  }
  @media (max-width: 860px) {
    .sh-hero__grid { grid-template-columns: 1fr; }
    .sh-hero__media {
      min-height: 320px;
      order: -1;
    }
    .sh-hero__media::after {
      background: linear-gradient(0deg, #231A12 2%, transparent 50%);
    }
  }

  /* ============== INTRO (the moved "Three Generations / One Recipe") ============== */
  .sh-intro {
    padding: clamp(80px, 12vw, 140px) var(--rail);
    max-width: 880px;
    margin: 0 auto;
    text-align: center;
  }
  .sh-intro h2 {
    font-family: var(--italic);
    font-style: italic;
    font-weight: 400;
    font-size: clamp(48px, 7vw, 96px);
    line-height: 1;
    margin: 0 0 28px;
    letter-spacing: -0.025em;
    text-wrap: balance;
  }
  .sh-intro h2 em { color: var(--forest); }
  .sh-intro .deck {
    font-size: 18px;
    line-height: 1.75;
    color: var(--ink-soft);
    max-width: 60ch;
    margin: 0 auto;
  }

  /* ============== TIMELINE (unchanged) ============== */
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
    font-size: 16px;
    line-height: 1.7;
    color: var(--ink-soft);
    margin: 0;
    max-width: 56ch;
  }

  /* ============== CHARITY / PAY IT FORWARD (unchanged) ============== */
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
    font-size: 12px;
    letter-spacing: 0.2em;
    text-transform: uppercase;
    opacity: 0.7;
    line-height: 1.5;
  }

  @media (max-width: 980px) {
    .timeline__inner, .charity-block__inner { grid-template-columns: 1fr; gap: 32px; }
    .timeline__inner > div:first-child { position: static; }
    .tl-row {
      grid-template-columns: 1fr;
      gap: 10px;
      padding: 24px 0;
    }
    .tl-row .year { font-size: 36px; }
  }
</style>

<!-- ============== HERO ============== -->
<section class="sh-hero">
  <div class="sh-hero__grid">
    <div class="sh-hero__copy" data-reveal>
      <span class="sh-hero__cjk">三代人的传承</span>
      <h1>HAKSHAN</h1>
      <p class="sh-hero__sub">
        <span data-en>Three generations of authentic Hakka cuisine — slow-simmered, carefully sourced, and served the way it has always been.</span>
        <span data-zh>三代人的客家菜——慢炖细煮，用料讲究，依旧是当年的味道。</span>
      </p>
      <div class="sh-hero__actions">
        <a class="btn" href="<?php echo esc_url( hakshan_nav_url( 'menu' ) ); ?>">
          <span data-en>Explore the cuisine</span><span data-zh>查看菜单</span>
          <span class="arr">→</span>
        </a>
        <a class="btn btn--ghost" href="#intro">
          <span data-en>Our story</span><span data-zh>阅读故事</span>
        </a>
      </div>
    </div>
    <div class="sh-hero__media">
      <img src="<?php echo esc_url( get_theme_file_uri( 'assets/img/story-hero.jpg' ) ); ?>"
           alt="A steaming bowl of Hakka noodles held in two hands"
           loading="eager" decoding="async" width="1090" height="1080" />
    </div>
  </div>
</section>

<!-- ============== INTRO · Three Generations, One Recipe ============== -->
<section class="sh-intro" id="intro">
  <div data-reveal>
    <h2>
      <span data-en>Three Generations<br/><em>One Recipe</em></span>
      <span data-zh>三代人，<br/><em>一菜谱。</em></span>
    </h2>
    <p class="deck">
      <span data-en>Hakshan (客善) is a modern Hakka restaurant group, deeply rooted in authentic heritage cuisine and thoughtfully crafted for today's discerning diners. Our journey began with a belief that the rich, time-honoured flavours of Hakka cooking deserve to be preserved, respected, and shared with future generations.</span>
      <span data-zh>客善是一个深植于正宗客家传统美食的现代餐饮集团，专为今日的品味食客精心打造。我们的旅程始于一个坚定的信念：客家菜肴那份丰富、历久弥新的风味，值得被珍视、被尊重，并传承给下一代。</span>
    </p>
  </div>
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
        array( 'year' => '1928', 'h_en' => 'A home kitchen, ancestral village', 'h_zh' => '祖 屋 · 家 中 厨 房',
               'p_en' => 'The 1st generation cooks Hakka food at home in the ancestral village: three-cup chicken, mui choy belly, rice-wine chicken soup. No restaurant. No staff. Just a stove, a wok, and a family that keeps showing up to eat.',
               'p_zh' => '第一代在祖屋的厨房里煮客家菜：三杯鸡、梅菜扣肉、糯米酒鸡汤。没有餐厅，没有员工。只有一个灶、一只镬，和一屋子总回来吃饭的家人。' ),
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

<!-- ============== CHARITY · Pay it Forward ============== -->
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

<?php
get_footer();
