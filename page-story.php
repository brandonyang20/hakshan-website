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

  /* ============== BRAND POSITIONING ============== */
  .sh-positioning {
    background: var(--cream);
    padding: clamp(80px, 12vw, 140px) var(--rail);
  }
  .sh-positioning__head {
    max-width: var(--maxw);
    margin: 0 auto clamp(40px, 5vw, 68px);
    text-align: center;
  }
  .sh-positioning__head .h-eyebrow { justify-content: center; }
  .sh-positioning__head h2 {
    font-family: var(--italic);
    font-style: italic;
    font-weight: 400;
    font-size: clamp(40px, 5.5vw, 76px);
    line-height: 1.1;
    margin: 14px 0 0;
    letter-spacing: -0.025em;
    text-wrap: balance;
  }
  .sh-positioning__head h2 em { color: var(--forest); }
  .sh-positioning__grid {
    max-width: var(--maxw);
    margin: 0 auto;
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 24px;
  }
  .sh-feature {
    background: var(--paper);
    border: 1px solid var(--line);
    padding: clamp(32px, 4vw, 52px);
  }
  .sh-feature__no {
    font-family: var(--mono);
    font-size: 12px;
    letter-spacing: 0.22em;
    color: var(--forest);
    display: block;
    margin-bottom: 28px;
  }
  .sh-feature h3 {
    font-family: var(--italic);
    font-style: italic;
    font-weight: 400;
    font-size: 26px;
    margin: 0 0 14px;
    line-height: 1.2;
  }
  .sh-feature h3 .cn {
    display: block;
    font-family: var(--cn);
    font-style: normal;
    font-size: 13px;
    letter-spacing: 0.2em;
    color: var(--forest);
    margin-bottom: 6px;
  }
  .sh-feature p {
    font-size: 16px;
    line-height: 1.7;
    color: var(--ink-soft);
    margin: 0;
  }

  /* ============== SIGNATURE SERIES ============== */
  .sh-series {
    padding: clamp(80px, 12vw, 140px) var(--rail);
    max-width: var(--maxw);
    margin: 0 auto;
  }
  .sh-series__head {
    margin-bottom: clamp(40px, 5vw, 72px);
  }
  .sh-series__head h2 {
    font-family: var(--italic);
    font-style: italic;
    font-weight: 400;
    font-size: clamp(40px, 5.5vw, 76px);
    line-height: 1.05;
    margin: 14px 0 0;
    letter-spacing: -0.025em;
    text-wrap: balance;
  }
  .sh-series__head h2 em { color: var(--forest); }
  .sh-series__row {
    display: grid;
    grid-template-columns: 1.05fr 1fr;
    gap: 60px;
    align-items: center;
    margin-bottom: clamp(60px, 8vw, 100px);
  }
  .sh-series__row:last-child { margin-bottom: 0; }
  .sh-series__row--reverse .sh-series__media { order: 2; }
  .sh-series__media {
    aspect-ratio: 4 / 3;
    overflow: hidden;
    background: var(--cream);
  }
  .sh-series__media img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
  }
  .sh-series__copy .cn {
    display: block;
    font-family: var(--cn);
    font-size: 13px;
    letter-spacing: 0.22em;
    color: var(--forest);
    margin-bottom: 14px;
  }
  .sh-series__copy h3 {
    font-family: var(--italic);
    font-style: italic;
    font-weight: 400;
    font-size: clamp(28px, 3.6vw, 48px);
    line-height: 1;
    letter-spacing: -0.02em;
    margin: 0 0 20px;
  }
  .sh-series__copy p {
    font-size: 16px;
    line-height: 1.75;
    color: var(--ink-soft);
    margin: 0 0 24px;
    max-width: 52ch;
  }
  .sh-series__tag {
    display: inline-block;
    font-family: var(--mono);
    font-size: 12px;
    letter-spacing: 0.18em;
    text-transform: uppercase;
    color: var(--ink-soft);
    border-top: 1px solid var(--line);
    padding-top: 18px;
    margin-top: 4px;
  }

  /* ============== PROOF / NUMBERS ============== */
  .sh-proof {
    background: #231A12;
    color: #F3EAD9;
    padding: clamp(70px, 10vw, 120px) var(--rail);
  }
  .sh-proof__inner {
    max-width: var(--maxw);
    margin: 0 auto;
    text-align: center;
  }
  .sh-proof__head .h-eyebrow {
    color: #C49B66;
    opacity: 1;
    justify-content: center;
    display: inline-flex;
  }
  .sh-proof__head .h-eyebrow .dot { background: #C49B66; }
  .sh-proof__head h2 {
    font-family: var(--italic);
    font-style: italic;
    font-weight: 400;
    font-size: clamp(40px, 5.5vw, 72px);
    line-height: 1;
    margin: 16px 0 48px;
    color: inherit;
    letter-spacing: -0.025em;
  }
  .sh-proof__grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 28px;
    padding: 36px;
    border: 1px solid rgba(243, 234, 217, 0.18);
  }
  .sh-stat__n {
    font-family: var(--italic);
    font-style: italic;
    font-weight: 400;
    font-size: clamp(40px, 5.2vw, 64px);
    line-height: 1;
    letter-spacing: -0.025em;
  }
  .sh-stat__n em {
    color: #C49B66;
    font-style: italic;
    font-size: 0.6em;
    margin-left: 2px;
  }
  .sh-stat__l {
    margin-top: 14px;
    font-family: var(--mono);
    font-size: 11px;
    letter-spacing: 0.2em;
    text-transform: uppercase;
    color: rgba(243, 234, 217, 0.65);
    line-height: 1.6;
  }

  /* ============== OUTLETS ============== */
  .sh-outlets {
    background: var(--cream);
    padding: clamp(80px, 12vw, 140px) var(--rail);
  }
  .sh-outlets__head {
    max-width: var(--maxw);
    margin: 0 auto clamp(40px, 5vw, 68px);
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 60px;
    align-items: center;
  }
  .sh-outlets__head h2 {
    font-family: var(--italic);
    font-style: italic;
    font-weight: 400;
    font-size: clamp(40px, 5.5vw, 76px);
    line-height: 1.05;
    margin: 14px 0 20px;
    letter-spacing: -0.025em;
    text-wrap: balance;
  }
  .sh-outlets__head h2 em { color: var(--forest); }
  .sh-outlets__head p {
    font-size: 16px;
    line-height: 1.75;
    color: var(--ink-soft);
    margin: 0;
    max-width: 52ch;
  }
  .sh-outlets__media {
    aspect-ratio: 16 / 9;
    overflow: hidden;
    background: var(--paper);
  }
  .sh-outlets__media img { width: 100%; height: 100%; object-fit: cover; display: block; }
  .sh-outlets__grid {
    max-width: var(--maxw);
    margin: 0 auto;
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 16px;
  }
  .sh-outlet {
    background: var(--paper);
    border: 1px solid var(--line);
    padding: 20px 22px;
  }
  .sh-outlet__city {
    font-family: var(--italic);
    font-style: italic;
    font-size: 22px;
    line-height: 1.1;
    margin: 0 0 6px;
  }
  .sh-outlet__meta {
    font-family: var(--mono);
    font-size: 11px;
    letter-spacing: 0.16em;
    text-transform: uppercase;
    color: var(--ink-soft);
    margin: 0 0 14px;
  }
  .sh-outlet__rate {
    display: flex;
    align-items: baseline;
    gap: 8px;
    font-family: var(--mono);
    font-size: 12px;
    color: var(--ink-soft);
  }
  .sh-outlet__rate b {
    font-family: var(--italic);
    font-style: italic;
    font-weight: 400;
    font-size: 18px;
    color: var(--ink);
  }
  .sh-outlet__rate .stars { color: #C49B66; letter-spacing: 0; }
  .sh-outlet--more {
    background: color-mix(in srgb, var(--forest) 10%, var(--paper));
    border-color: color-mix(in srgb, var(--forest) 30%, transparent);
    display: grid;
    place-content: center;
    text-align: center;
  }
  .sh-outlet--more .sh-outlet__city { color: var(--forest); margin: 0; }
  .sh-outlet--more .sh-outlet__meta { margin: 8px 0 0; }

  @media (max-width: 1080px) {
    .sh-positioning__grid { grid-template-columns: 1fr 1fr; }
    .sh-outlets__grid { grid-template-columns: repeat(3, 1fr); }
    .sh-proof__grid { grid-template-columns: 1fr 1fr; }
  }
  @media (max-width: 760px) {
    .sh-positioning__grid { grid-template-columns: 1fr; }
    .sh-series__row { grid-template-columns: 1fr; gap: 28px; }
    .sh-series__row--reverse .sh-series__media { order: 0; }
    .sh-outlets__head { grid-template-columns: 1fr; }
    .sh-outlets__grid { grid-template-columns: 1fr 1fr; }
    .sh-proof__grid { padding: 28px; gap: 22px; }
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

<!-- ============== BRAND POSITIONING ============== -->
<section class="sh-positioning">
  <div class="sh-positioning__head" data-reveal>
    <span class="h-eyebrow"><span class="dot"></span>
      <span data-en>BRAND POSITIONING</span>
      <span data-zh>品牌定位</span>
    </span>
    <h2>
      <span data-en>Authentic Hakka cuisine,<br/><em>a modern dining model.</em></span>
      <span data-zh>正宗客家菜，<br/><em>现代餐饮模式。</em></span>
    </h2>
  </div>
  <div class="sh-positioning__grid">
    <article class="sh-feature" data-reveal>
      <span class="sh-feature__no">01</span>
      <h3>
        <span class="cn">客家味</span>
        <span data-en>Authentic Recipes</span>
        <span data-zh>正宗食谱</span>
      </h3>
      <p>
        <span data-en>Time-honoured Hakka dishes, standardised with precision and perfected through tradition — consistent in every bowl, across every outlet.</span>
        <span data-zh>历久弥新的客家菜，以精准方式标准化，由传统打磨——每一碗，每一家店，味道一致。</span>
      </p>
    </article>
    <article class="sh-feature" data-reveal>
      <span class="sh-feature__no">02</span>
      <h3>
        <span class="cn">回馈社区</span>
        <span data-en>Charity Integration</span>
        <span data-zh>慈善融入</span>
      </h3>
      <p>
        <span data-en>Giving back sits at the heart of the brand. A share of every sale sustains the communities we serve while preserving the culture behind the food.</span>
        <span data-zh>回馈是品牌的核心。每一笔营业额的一部分回馈社区，让我们所服务的人群、以及食物背后的文化得以延续。</span>
      </p>
    </article>
    <article class="sh-feature" data-reveal>
      <span class="sh-feature__no">03</span>
      <h3>
        <span class="cn">系统管理</span>
        <span data-en>Systemized Management</span>
        <span data-zh>系统化管理</span>
      </h3>
      <p>
        <span data-en>From sourcing to service, every process is standardised and optimised — disciplined operations that make heritage dining repeatable and scalable.</span>
        <span data-zh>从采购到出餐，每一道流程都已标准化与优化——纪律严明的营运，让传统餐饮可复制、可扩张。</span>
      </p>
    </article>
  </div>
</section>

<!-- ============== SIGNATURE SERIES ============== -->
<section class="sh-series">
  <div class="sh-series__head" data-reveal>
    <span class="h-eyebrow"><span class="dot"></span>
      <span data-en>SIGNATURE SERIES</span>
      <span data-zh>招牌系列</span>
    </span>
    <h2>
      <span data-en>Three ways to <em>taste Hakka.</em></span>
      <span data-zh>三种方式，<em>尝客家味。</em></span>
    </h2>
  </div>

  <div class="sh-series__row" data-reveal>
    <div class="sh-series__media">
      <img src="<?php echo esc_url( get_theme_file_uri( 'assets/img/story-series-classics.jpg' ) ); ?>" alt="Braised Hakka pork dish" loading="lazy" />
    </div>
    <div class="sh-series__copy">
      <span class="cn">客家系列</span>
      <h3><span data-en>Hakka Classics</span><span data-zh>客家经典</span></h3>
      <p>
        <span data-en>Timeless recipes crafted with depth, balance and authenticity — rich, comforting flavours built on time-honoured techniques and carefully selected ingredients.</span>
        <span data-zh>历久不衰的食谱，讲究层次、平衡与正宗——浓郁、温暖的滋味，建立在传统技艺与精挑细选的食材之上。</span>
      </p>
      <span class="sh-series__tag">
        <span data-en>Braised pork · Abacus seeds · Pork knuckle vinegar</span>
        <span data-zh>梅菜扣肉 · 算盘子 · 姜醋猪脚</span>
      </span>
    </div>
  </div>

  <div class="sh-series__row sh-series__row--reverse" data-reveal>
    <div class="sh-series__media">
      <img src="<?php echo esc_url( get_theme_file_uri( 'assets/img/story-series-leicha.jpg' ) ); ?>" alt="Lei cha rice bowl with greens and grains" loading="lazy" />
    </div>
    <div class="sh-series__copy">
      <span class="cn">擂茶系列</span>
      <h3><span data-en>Lei Cha Series</span><span data-zh>擂茶系列</span></h3>
      <p>
        <span data-en>Ground by hand, balanced by nature. A wholesome harmony of grains, greens and herbs — one of the most iconic Hakka traditions, refined for today.</span>
        <span data-zh>手工研磨，自然平衡。谷物、青菜、草本的和谐共融——客家最具代表性的传统之一，以今日的形式重新呈现。</span>
      </p>
      <span class="sh-series__tag">
        <span data-en>Thunder tea rice · Hand-ground · Plant-forward</span>
        <span data-zh>擂茶饭 · 手工研磨 · 蔬食为本</span>
      </span>
    </div>
  </div>

  <div class="sh-series__row" data-reveal>
    <div class="sh-series__media">
      <img src="<?php echo esc_url( get_theme_file_uri( 'assets/img/story-series-nourishing.jpg' ) ); ?>" alt="Nourishing herbal chicken dish" loading="lazy" />
    </div>
    <div class="sh-series__copy">
      <span class="cn">养生系列</span>
      <h3><span data-en>Nourishing Series</span><span data-zh>养生系列</span></h3>
      <p>
        <span data-en>Slow-simmered, naturally balanced and crafted for everyday strength. Rooted in traditional Hakka herbal wisdom, refined for modern living.</span>
        <span data-zh>慢炖细煮，自然平衡，为日常补气。源自传统客家药膳智慧，为现代生活重新调配。</span>
      </p>
      <span class="sh-series__tag">
        <span data-en>Herbal soups · Black chicken · Restorative</span>
        <span data-zh>药膳汤品 · 乌鸡 · 滋补养生</span>
      </span>
    </div>
  </div>
</section>

<!-- ============== PROOF / NUMBERS ============== -->
<section class="sh-proof">
  <div class="sh-proof__inner" data-reveal>
    <div class="sh-proof__head">
      <span class="h-eyebrow"><span class="dot"></span>
        <span data-en>BY THE BOWL</span>
        <span data-zh>一碗见真章</span>
      </span>
      <h2>
        <span data-en>A taste people <em>return for.</em></span>
        <span data-zh>让人 <em>回头的味道。</em></span>
      </h2>
    </div>
    <div class="sh-proof__grid">
      <div>
        <div class="sh-stat__n">9</div>
        <div class="sh-stat__l"><span data-en>Outlets across the Klang Valley &amp; Ipoh</span><span data-zh>巴生谷与怡保门店</span></div>
      </div>
      <div>
        <div class="sh-stat__n">4.7<em>★</em></div>
        <div class="sh-stat__l"><span data-en>Average rating across branches</span><span data-zh>各分店平均评分</span></div>
      </div>
      <div>
        <div class="sh-stat__n">1<em>M+</em></div>
        <div class="sh-stat__l"><span data-en>Meals served</span><span data-zh>累计服务人次</span></div>
      </div>
      <div>
        <div class="sh-stat__n">75<em>%</em></div>
        <div class="sh-stat__l"><span data-en>Member retention rate</span><span data-zh>会员回头率</span></div>
      </div>
    </div>
  </div>
</section>

<!-- ============== OUTLETS · Seven homes, one standard ============== -->
<section class="sh-outlets">
  <div class="sh-outlets__head">
    <div data-reveal>
      <span class="h-eyebrow"><span class="dot"></span>
        <span data-en>OUR OUTLETS</span>
        <span data-zh>我们的门店</span>
      </span>
      <h2>
        <span data-en>Seven homes,<br/><em>one standard.</em></span>
        <span data-zh>九家厨房，<br/><em>同一套标准。</em></span>
      </h2>
      <p>
        <span data-en>Full-service restaurants designed around a single, repeatable model — consistent quality, warm rooms, and a menu the neighbourhood keeps coming back to.</span>
        <span data-zh>全服务餐厅，围绕同一套可复制的模式打造——稳定的品质，温暖的空间，邻里愿意一回再回的菜单。</span>
      </p>
    </div>
    <div data-reveal>
      <div class="sh-outlets__media">
        <img src="<?php echo esc_url( get_theme_file_uri( 'assets/img/story-outlet.jpg' ) ); ?>" alt="HAKSHAN outlet storefront" loading="lazy" />
      </div>
    </div>
  </div>
  <div class="sh-outlets__grid" data-reveal>
    <div class="sh-outlet">
      <div class="sh-outlet__city">USJ Taipan</div>
      <div class="sh-outlet__meta">RM 20–40 · 客家菜餐厅</div>
      <div class="sh-outlet__rate"><b>4.7</b><span class="stars">★★★★★</span><span>4,385</span></div>
    </div>
    <div class="sh-outlet">
      <div class="sh-outlet__city">Menjalara</div>
      <div class="sh-outlet__meta">RM 20–40 · 客家菜餐厅</div>
      <div class="sh-outlet__rate"><b>4.7</b><span class="stars">★★★★★</span><span>4,593</span></div>
    </div>
    <div class="sh-outlet">
      <div class="sh-outlet__city">Cheras · Trader Square</div>
      <div class="sh-outlet__meta">RM 20–40 · 客家菜餐厅</div>
      <div class="sh-outlet__rate"><b>4.8</b><span class="stars">★★★★★</span><span>3,491</span></div>
    </div>
    <div class="sh-outlet">
      <div class="sh-outlet__city">Bandar Puteri Puchong</div>
      <div class="sh-outlet__meta">RM 20–40 · 客家菜餐厅</div>
      <div class="sh-outlet__rate"><b>4.7</b><span class="stars">★★★★★</span><span>2,298</span></div>
    </div>
    <div class="sh-outlet">
      <div class="sh-outlet__city">Sri Petaling</div>
      <div class="sh-outlet__meta">RM 20–40 · 客家菜餐厅</div>
      <div class="sh-outlet__rate"><b>4.7</b><span class="stars">★★★★★</span><span>2,281</span></div>
    </div>
    <div class="sh-outlet">
      <div class="sh-outlet__city">SS2</div>
      <div class="sh-outlet__meta">RM 20–40 · 客家菜餐厅</div>
      <div class="sh-outlet__rate"><b>4.7</b><span class="stars">★★★★★</span><span>1,116</span></div>
    </div>
    <div class="sh-outlet">
      <div class="sh-outlet__city">Kota Damansara</div>
      <div class="sh-outlet__meta">RM 20–40 · 客家菜餐厅</div>
      <div class="sh-outlet__rate"><b>4.7</b><span class="stars">★★★★★</span><span>636</span></div>
    </div>
    <a class="sh-outlet sh-outlet--more" href="<?php echo esc_url( hakshan_nav_url( 'outlets' ) ); ?>">
      <div class="sh-outlet__city"><span data-en>+ more</span><span data-zh>更多门店</span></div>
      <div class="sh-outlet__meta"><span data-en>Ipoh · Klang · opening through 2026</span><span data-zh>怡保 · 巴生 · 持续扩张至 2026</span></div>
    </a>
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
