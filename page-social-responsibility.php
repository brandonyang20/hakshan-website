<?php
/**
 * Template Name: Social Responsibility
 * Template Post Type: page
 *
 * Hakshan's "Pay it Forward" social responsibility page. Sits at
 * /social-responsibility/. Linked from the top nav as "Pay it Forward"
 * (行善) and from the footer.
 *
 * @package Hakshan
 */

get_header();
?>
<style>
  /* Hero */
  .sr-hero {
    padding: clamp(80px, 12vw, 140px) var(--rail) clamp(60px, 8vw, 100px);
    max-width: var(--maxw);
    margin: 0 auto;
    display: grid;
    grid-template-columns: 1.1fr 1fr;
    gap: 80px;
    align-items: end;
  }
  .sr-hero h1 {
    font-family: var(--serif);
    font-style: italic;
    font-size: clamp(64px, 10vw, 168px);
    line-height: 0.92;
    margin: 16px 0 0;
    letter-spacing: -0.03em;
  }
  .sr-hero h1 em { color: var(--forest); }
  .sr-hero h1 .cn {
    display: block;
    margin-top: 16px;
    font-family: var(--cn);
    font-style: normal;
    font-size: 0.26em;
    color: var(--forest);
    letter-spacing: 0.28em;
  }
  .sr-hero p.lead {
    font-family: var(--serif);
    font-style: italic;
    font-size: clamp(20px, 2.4vw, 28px);
    line-height: 1.45;
    color: var(--forest);
    margin: 0;
    max-width: 36ch;
  }
  .sr-hero__buttons {
    margin-top: 28px;
    display: flex;
    gap: 16px;
    flex-wrap: wrap;
  }

  /* Founder's vision — intimate cream slab */
  /* Dark, full-bleed origin band — same treatment as the story-page
     hero. Copy on the left over the dark panel, photo on the right
     bleeding edge-to-edge, soft gradient blend between them. */
  .sr-origin {
    background: #231A12;
    color: #F3EAD9;
    overflow: hidden;
  }
  .sr-origin__inner {
    max-width: none;
    margin: 0;
    display: grid;
    grid-template-columns: 1fr 1fr;
    min-height: min(86vh, 760px);
  }
  .sr-origin__copy {
    display: flex;
    flex-direction: column;
    justify-content: center;
    padding: clamp(60px, 7vw, 100px) clamp(40px, 6vw, 80px) clamp(60px, 7vw, 100px) clamp(40px, 8vw, 120px);
    grid-column: 1;
    grid-row: 1;
  }
  .sr-origin .h-eyebrow {
    color: #C49B66;
    opacity: 1;
  }
  .sr-origin .h-eyebrow .dot { background: #C49B66; }
  .sr-origin h2 {
    font-family: var(--serif);
    font-style: italic;
    font-size: clamp(44px, 6vw, 88px);
    line-height: 1.02;
    margin: 18px 0 0;
    letter-spacing: -0.025em;
    color: #F3EAD9;
    text-wrap: balance;
  }
  .sr-origin h2 em { color: #C49B66; }
  .sr-origin p {
    font-size: 16px;
    line-height: 1.75;
    color: rgba(243, 234, 217, 0.78);
    margin: 0 0 16px;
    max-width: 52ch;
  }
  .sr-origin p:last-child { margin-bottom: 0; }
  .sr-origin p.lead {
    font-family: var(--serif);
    font-style: italic;
    font-size: 22px;
    line-height: 1.45;
    color: #C49B66;
    margin: 28px 0 18px;
  }
  .sr-origin__media {
    grid-column: 2;
    grid-row: 1;
    position: relative;
    min-height: 360px;
    background: #1a130c;
  }
  .sr-origin__media img {
    position: absolute;
    inset: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
  }
  /* Left-edge fade on the photo so it blends into the dark copy area
     instead of butting up against a hard column line. */
  .sr-origin__media::after {
    content: "";
    position: absolute;
    inset: 0;
    background: linear-gradient(90deg, #231A12 0%, rgba(35, 26, 18, 0.65) 14%, transparent 45%);
    pointer-events: none;
  }
  @media (max-width: 860px) {
    .sr-origin__inner { grid-template-columns: 1fr; min-height: 0; }
    .sr-origin__copy { padding: clamp(48px, 9vw, 80px) clamp(20px, 6vw, 40px); grid-row: 2; }
    .sr-origin__media { min-height: 320px; grid-row: 1; }
    .sr-origin__media::after {
      background: linear-gradient(0deg, #231A12 1%, transparent 45%);
    }
  }

  /* The model — paper background slab */
  .sr-model {
    background: var(--paper);
    padding: clamp(80px, 12vw, 140px) var(--rail);
    border-top: 1px solid var(--line-soft);
    border-bottom: 1px solid var(--line-soft);
  }
  .sr-model__inner {
    max-width: var(--maxw);
    margin: 0 auto;
    display: grid;
    grid-template-columns: 1fr 1.4fr;
    gap: 80px;
    align-items: start;
  }
  .sr-model h2 {
    font-family: var(--serif);
    font-style: italic;
    font-size: clamp(40px, 5.6vw, 76px);
    line-height: 1;
    margin: 12px 0 0;
    letter-spacing: -0.025em;
    max-width: 14ch;
  }
  .sr-model h2 em { color: var(--forest); }
  .sr-model p {
    font-size: 17px;
    line-height: 1.75;
    color: var(--ink);
    margin: 0 0 18px;
    max-width: 60ch;
  }
  .sr-model p.lead {
    font-family: var(--serif);
    font-style: italic;
    font-size: 24px;
    line-height: 1.45;
    color: var(--forest);
    margin-bottom: 28px;
  }

  /* Three pillars */
  .sr-pillars {
    padding: clamp(80px, 12vw, 140px) var(--rail);
    max-width: var(--maxw);
    margin: 0 auto;
  }
  .sr-pillars__head { text-align: center; margin-bottom: 64px; }
  .sr-pillars__head h2 {
    font-family: var(--serif);
    font-style: italic;
    font-size: clamp(40px, 6vw, 80px);
    line-height: 0.95;
    margin: 12px auto 0;
    max-width: 22ch;
    letter-spacing: -0.02em;
  }
  .sr-pillars__head h2 em { color: var(--forest); }
  .sr-pillars__grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 40px;
  }
  .sr-pillar {
    display: flex;
    flex-direction: column;
    background: var(--paper);
    border-radius: 14px;
    overflow: hidden;
    box-shadow:
      0 1px 2px rgba(42, 46, 39, 0.04),
      0 18px 32px -18px rgba(42, 46, 39, 0.18),
      0 30px 60px -28px rgba(42, 46, 39, 0.12);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
  }
  .sr-pillar:hover {
    transform: translateY(-4px);
    box-shadow:
      0 1px 2px rgba(42, 46, 39, 0.06),
      0 22px 40px -18px rgba(42, 46, 39, 0.26),
      0 40px 80px -32px rgba(42, 46, 39, 0.18);
  }
  .sr-pillar__media {
    aspect-ratio: 16 / 11;
    overflow: hidden;
    background: var(--cream);
  }
  .sr-pillar__media img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
  }
  .sr-pillar__body {
    padding: clamp(24px, 2.6vw, 36px);
    display: flex;
    flex-direction: column;
    gap: 14px;
  }
  .sr-pillar .ix {
    font-family: var(--mono);
    font-size: 12px;
    letter-spacing: 0.16em;
    text-transform: uppercase;
    color: var(--forest);
  }
  .sr-pillar h3 {
    font-family: var(--serif);
    font-style: italic;
    font-size: 32px;
    margin: 0;
    line-height: 1.1;
    letter-spacing: -0.015em;
  }
  .sr-pillar h3 .cn {
    display: block;
    font-family: var(--cn);
    font-style: normal;
    font-size: 16px;
    color: var(--forest);
    letter-spacing: 0.2em;
    margin-top: 8px;
    opacity: 0.75;
  }
  .sr-pillar p {
    font-size: 15px;
    line-height: 1.7;
    color: var(--ink-soft);
    margin: 0;
  }

  /* Numbers band — forest background */
  .sr-numbers {
    background: var(--forest);
    color: var(--cream);
    padding: clamp(80px, 12vw, 140px) var(--rail);
  }
  .sr-numbers__inner {
    max-width: var(--maxw);
    margin: 0 auto;
    display: grid;
    grid-template-columns: 1fr 1.4fr;
    gap: 80px;
    align-items: start;
  }
  .sr-numbers h2 {
    font-family: var(--serif);
    font-style: italic;
    font-size: clamp(40px, 5.6vw, 76px);
    line-height: 1;
    margin: 12px 0 0;
    letter-spacing: -0.025em;
  }
  .sr-numbers .h-eyebrow { color: var(--cream); opacity: 0.7; }
  .sr-numbers .h-eyebrow .dot { background: var(--cream); }
  .sr-numbers__grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 32px;
    padding-top: 8px;
  }
  .sr-stat {
    padding-top: 24px;
    border-top: 1px solid rgba(235, 223, 196, 0.25);
  }
  .sr-stat .num {
    font-family: var(--serif);
    font-style: italic;
    font-size: 64px;
    line-height: 1;
    letter-spacing: -0.025em;
  }
  .sr-stat .lbl {
    font-family: var(--mono);
    font-size: 12px;
    letter-spacing: 0.16em;
    text-transform: uppercase;
    color: rgba(235, 223, 196, 0.7);
    margin-top: 10px;
  }
  .sr-stat .sub {
    font-size: 14px;
    line-height: 1.6;
    opacity: 0.85;
    margin-top: 8px;
  }

  /* Pull quote */
  .sr-quote {
    padding: clamp(80px, 12vw, 140px) var(--rail);
    text-align: center;
    background: var(--cream);
  }
  .sr-quote .inner { max-width: 900px; margin: 0 auto; }
  .sr-quote p {
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
  .sr-quote .by {
    margin-top: 32px;
    font-family: var(--mono);
    font-size: 12px;
    letter-spacing: 0.18em;
    text-transform: uppercase;
    color: var(--mute);
  }

  /* Close CTA */
  .sr-close {
    padding: clamp(80px, 12vw, 140px) var(--rail);
    text-align: center;
    background: var(--paper);
  }
  .sr-close__inner { max-width: 760px; margin: 0 auto; }
  .sr-close h2 {
    font-family: var(--serif);
    font-style: italic;
    font-size: clamp(48px, 7vw, 88px);
    line-height: 1;
    margin: 12px 0 24px;
    letter-spacing: -0.025em;
  }
  .sr-close h2 em { color: var(--forest); }
  .sr-close p {
    font-size: 17px;
    line-height: 1.7;
    color: var(--ink-soft);
    max-width: 50ch;
    margin: 0 auto 32px;
  }
  .sr-close__buttons {
    display: flex;
    gap: 16px;
    justify-content: center;
    flex-wrap: wrap;
  }

  /* Stories grid */
  .sr-stories {
    padding: clamp(80px, 12vw, 140px) var(--rail);
    max-width: var(--maxw);
    margin: 0 auto;
  }
  .sr-stories__head {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 64px;
    align-items: end;
    margin-bottom: 56px;
  }
  .sr-stories__head h2 {
    font-family: var(--serif);
    font-style: italic;
    font-size: clamp(40px, 5.6vw, 76px);
    line-height: 1;
    margin: 12px 0 0;
    letter-spacing: -0.025em;
    max-width: 14ch;
  }
  .sr-stories__head h2 em { color: var(--forest); }
  .sr-stories__head p {
    font-size: 16px;
    line-height: 1.7;
    color: var(--ink-soft);
    margin: 0;
    max-width: 56ch;
  }
  .sr-stories__grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 32px;
  }
  .sr-story {
    background: var(--paper);
    border: 1px solid var(--line);
    display: grid;
    text-decoration: none;
    color: inherit;
    transition: background 0.3s ease, transform 0.3s ease;
  }
  .sr-story:hover { background: var(--cream); transform: translateY(-4px); }
  .sr-story__visual {
    aspect-ratio: 4 / 3;
    position: relative;
    overflow: hidden;
    background: var(--cream);
  }
  .sr-story__visual img {
    position: absolute;
    inset: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.6s ease;
  }
  .sr-story:hover .sr-story__visual img { transform: scale(1.04); }
  .sr-story__body {
    padding: 24px 24px 28px;
    display: grid;
    gap: 12px;
    align-content: start;
  }
  .sr-story__date {
    font-family: var(--mono);
    font-size: 12px;
    letter-spacing: 0.18em;
    text-transform: uppercase;
    color: var(--forest);
  }
  .sr-story__title {
    font-family: var(--serif);
    font-style: italic;
    font-size: 22px;
    line-height: 1.2;
    margin: 0;
    letter-spacing: -0.01em;
  }
  .sr-story__excerpt {
    font-size: 14px;
    line-height: 1.6;
    color: var(--ink-soft);
    margin: 0;
  }
  .sr-story__more {
    margin-top: 4px;
    font-family: var(--mono);
    font-size: 12px;
    letter-spacing: 0.16em;
    text-transform: uppercase;
    color: var(--forest);
    display: inline-flex;
    align-items: center;
    gap: 8px;
  }
  .sr-story__more .arr {
    font-family: var(--serif);
    font-style: italic;
    font-size: 18px;
    transition: transform 0.25s ease;
  }
  .sr-story:hover .sr-story__more .arr { transform: translateX(4px); }
  .sr-stories__empty {
    padding: 40px 0;
    border-top: 1px solid var(--line);
    text-align: center;
    color: var(--mute);
    font-family: var(--serif);
    font-style: italic;
    font-size: 18px;
  }

  @media (max-width: 980px) {
    .sr-hero, .sr-origin__inner, .sr-model__inner, .sr-numbers__inner,
    .sr-stories__head { grid-template-columns: 1fr; gap: 32px; }
    .sr-pillars__grid, .sr-stories__grid { grid-template-columns: 1fr; }
  }
</style>

<!-- ============== HERO ============== -->
<section class="sr-hero">
  <div data-reveal>
    <h1>
      <span data-en>Pay it<br/><em>Forward.</em></span>
      <span data-zh>一菜<br/><em>一善。</em></span>
    </h1>
  </div>
  <div data-reveal>
    <p class="lead">
      <span data-en>Part of every sale at every Hakshan outlet goes to community causes. Same rule, every kitchen, every day.</span>
      <span data-zh>每一家门店，每一笔营业额的一部分，拨入社区用途。同一条规则，每一天。</span>
    </p>
    <div class="sr-hero__buttons">
      <a class="btn" href="<?php echo esc_url( hakshan_nav_url( 'outlets' ) ); ?>"><span data-en>Visit an outlet</span><span data-zh>到店</span><span class="arr">→</span></a>
      <a class="btn btn--ghost" href="<?php echo esc_url( hakshan_nav_url( 'story' ) ); ?>"><span data-en>Read our story</span><span data-zh>阅读故事</span></a>
    </div>
  </div>
</section>

<!-- ============== WHERE IT BEGAN ============== -->
<section class="sr-origin">
  <div class="sr-origin__inner">
    <div class="sr-origin__copy" data-reveal>
      <span class="h-eyebrow"><span class="dot"></span>
        <span data-en>WHERE IT BEGAN</span>
        <span data-zh>故事的起点</span>
      </span>
      <h2>
        <span data-en>A founder <em>on the road.</em></span>
        <span data-zh>一个创办人，<em>在路上。</em></span>
      </h2>
      <p class="lead">
        <span data-en>It didn't start in a Hakka kitchen.</span>
        <span data-zh>故事不是从客家厨房开始的。</span>
      </p>
      <p>
        <span data-en>On his travels, the founder saw children whose daily meal was uncertain — in places far from home, where a single bowl of rice is not a given. The image stayed with him.</span>
        <span data-zh>创办人在旅途中，看见过吃不饱饭的孩子——在远离家乡的地方，一碗饭都不是理所当然。那一幕留了下来。</span>
      </p>
      <p>
        <span data-en>He came home and built a restaurant. But he didn't separate the two: the success of a kitchen, and the responsibility to anyone — wherever they are — who hasn't eaten today.</span>
        <span data-zh>他回到家，开了一家餐厅。但他没有把这两件事分开：厨房的成功，与对今天还没吃上饭的人的责任——不管那人在哪里。</span>
      </p>
      <p>
        <span data-en>So when Hakshan opened in February 2024, the rule was already in place. Part of every sale, every kitchen, every day, goes to community causes. The contribution starts close to home — education, elderly care, animal welfare. The principle, though, was set on that road.</span>
        <span data-zh>所以2024年2月客善开业的那一天，规则已经在那里了。每一笔营业额的一部分，每一家厨房，每一天，拨入社区用途。投入从离家最近的方向开始——教育、长者关怀、动物福利。但那条原则，是在路上就立下的。</span>
      </p>
    </div>
    <div class="sr-origin__media" data-reveal>
      <img src="https://hakshan.com/wp-content/uploads/2026/06/horvard-charity.jpeg" alt="The founder, on the road" loading="lazy" />
    </div>
  </div>
</section>

<!-- ============== THE MODEL ============== -->
<section class="sr-model">
  <div class="sr-model__inner">
    <div data-reveal>
      <span class="h-eyebrow"><span class="dot"></span>
        <span data-en>HOW IT WORKS</span>
        <span data-zh>规则</span>
      </span>
      <h2>
        <span data-en>Built in,<br/><em>not bolted on.</em></span>
        <span data-zh>制度<br/><em>而非附加。</em></span>
      </h2>
    </div>
    <div data-reveal>
      <p class="lead">
        <span data-en>It's not a donation made out of profit. It sits in the kitchen's costs, alongside rent, food, and staff. There's no flag to skip it.</span>
        <span data-zh>不是从利润里抽出来的捐赠。它写在厨房成本里，与租金、食材、人工同行。没有可以跳过它的选项。</span>
      </p>
      <p>
        <span data-en>Every dish costs what it costs to make, plus the contribution to community causes. The contribution doesn't depend on this month's profit, or this quarter's mood. It is part of the kitchen — like salt, like fire.</span>
        <span data-zh>一道菜的成本，是它的实际成本，加上拨入社区的份额。这份份额不取决于本月的利润，也不取决于本季度的心情。它是厨房的一部分——像盐，像火。</span>
      </p>
      <p>
        <span data-en>The rule was set on day one — February 2024, the first day Hakshan opened. We didn't add it after success. It is how we eat.</span>
        <span data-zh>规则在第一天就立下——2024年2月，客善开业的那一天。不是成功之后才加上的。这就是我们的方式。</span>
      </p>
    </div>
  </div>
</section>

<!-- ============== THREE PILLARS ============== -->
<section class="sr-pillars">
  <div class="sr-pillars__head" data-reveal>
    <h2>
      <span data-en>Where the<br/>contribution <em>goes.</em></span>
      <span data-zh>钱<br/><em>去 了 哪 里。</em></span>
    </h2>
  </div>
  <div class="sr-pillars__grid" data-reveal>
    <div class="sr-pillar">
      <div class="sr-pillar__media">
        <img src="https://hakshan.com/wp-content/uploads/2024/04/batch_ss汇聚力量.携手同心.jpg" alt="Education — Hakshan community support" loading="lazy" />
      </div>
      <div class="sr-pillar__body">
        <h3>
          <span data-en>Education</span><span data-zh>教 育</span>
        </h3>
        <p>
          <span data-en>Supporting school programmes, learning materials, and educational access for students in the communities around our outlets. Every child who learns is a small future kept open.</span>
          <span data-zh>支持学校项目、学习物资，以及门店所在社区学生的受教机会。每一个能继续读书的孩子，都是一份未被关上的未来。</span>
        </p>
      </div>
    </div>
    <div class="sr-pillar">
      <div class="sr-pillar__media">
        <img src="https://hakshan.com/wp-content/uploads/2024/07/Compress_DSC5350.jpg" alt="Elderly care — Hakshan community support" loading="lazy" />
      </div>
      <div class="sr-pillar__body">
        <h3>
          <span data-en>Elderly care</span><span data-zh>长 者 关 怀</span>
        </h3>
        <p>
          <span data-en>Meals for elderly residents in care homes, support for community elder programmes, and small monthly visits — because the recipes we cook came from grandmothers, and we don't forget that.</span>
          <span data-zh>为养老院的长者送餐，支持社区长者项目，每月定期探访——因为我们的食谱来自祖母，这件事我们没有忘。</span>
        </p>
      </div>
    </div>
    <div class="sr-pillar">
      <div class="sr-pillar__media">
        <img src="https://hakshan.com/wp-content/uploads/2026/06/DSC_5201.jpg" alt="Animal welfare — Hakshan community support" loading="lazy" />
      </div>
      <div class="sr-pillar__body">
        <h3>
          <span data-en>Animal welfare</span><span data-zh>动 物 福 利</span>
        </h3>
        <p>
          <span data-en>Support for animal shelters, sterilisation programmes, and rescue work for strays in the Klang Valley and beyond. The smallest voices, the ones nobody else speaks for.</span>
          <span data-zh>支持流浪动物收容所、绝育项目，以及巴生谷及更远地区的救援工作。最小的声音，没有人替他们说话的那一群。</span>
        </p>
      </div>
    </div>
  </div>
</section>

<!-- ============== NUMBERS ============== -->
<section class="sr-numbers">
  <div class="sr-numbers__inner">
    <div data-reveal>
      <span class="h-eyebrow"><span class="dot"></span>
        <span data-en>BY THE NUMBERS</span>
        <span data-zh>数 字 上</span>
      </span>
      <h2>
        <span data-en>The rule,<br/><em>across nine kitchens.</em></span>
        <span data-zh>九 间 厨 房，<br/><em>同 一 条 规 则。</em></span>
      </h2>
    </div>
    <div class="sr-numbers__grid" data-reveal>
      <div class="sr-stat">
        <div class="num">9</div>
        <div class="lbl"><span data-en>Outlets giving</span><span data-zh>参 与 门 店</span></div>
        <div class="sub"><span data-en>Every outlet, no exceptions.</span><span data-zh>每 一 家 门 店，无 例 外。</span></div>
      </div>
      <div class="sr-stat">
        <div class="num">3</div>
        <div class="lbl"><span data-en>Focus areas</span><span data-zh>三 个 方 向</span></div>
        <div class="sub"><span data-en>Education, elderly care, animal welfare.</span><span data-zh>教 育、长 者、动 物。</span></div>
      </div>
      <div class="sr-stat">
        <div class="num">Feb 2024</div>
        <div class="lbl"><span data-en>Built in from day one</span><span data-zh>开 业 即 制 度</span></div>
        <div class="sub"><span data-en>Not bolted on after success.</span><span data-zh>非 事 后 附 加。</span></div>
      </div>
      <div class="sr-stat">
        <div class="num">1M+</div>
        <div class="lbl"><span data-en>Meals served</span><span data-zh>累 计 服 务 餐 次</span></div>
        <div class="sub"><span data-en>Every one of them carried the rule.</span><span data-zh>每 一 餐，都 带 着 这 条 规 则。</span></div>
      </div>
    </div>
  </div>
</section>

<!-- ============== PULL QUOTE ============== -->
<section class="sr-quote">
  <div class="inner" data-reveal>
    <p>
      <span data-en>A good person inspires <em>goodness in others.</em></span>
      <span data-zh>善人者，<em>人必善之。</em></span>
    </p>
    <div class="by">
      <span data-en>THE BELIEF BEHIND HAKSHAN</span>
      <span data-zh>客善的信念</span>
    </div>
  </div>
</section>

<!-- ============== STORIES (posts in the 'social-responsibility' category) ============== -->
<?php
$sr_category = get_category_by_slug( 'social-responsibility' );
$sr_stories  = $sr_category
	? new WP_Query(
		array(
			'post_type'      => 'post',
			'posts_per_page' => 9,
			'cat'            => $sr_category->term_id,
			'orderby'        => 'date',
			'order'          => 'DESC',
			'no_found_rows'  => true,
		)
	)
	: null;
?>
<?php if ( $sr_stories && $sr_stories->have_posts() ) : ?>
<section class="sr-stories">
  <div class="sr-stories__head" data-reveal>
    <div>
      <span class="h-eyebrow"><span class="dot"></span>
        <span data-en>STORIES &amp; UPDATES</span>
        <span data-zh>故事与近况</span>
      </span>
      <h2>
        <span data-en>From the<br/><em>kitchens.</em></span>
        <span data-zh>来自<br/><em>厨房的故事。</em></span>
      </h2>
    </div>
    <p>
      <span data-en>Recent stories from the rule in action — beneficiary visits, partner programmes, charity-table updates.</span>
      <span data-zh>这条规则在日常里的故事——受惠探访、合作项目、慈善桌的近况。</span>
    </p>
  </div>
  <div class="sr-stories__grid" data-reveal>
    <?php while ( $sr_stories->have_posts() ) : $sr_stories->the_post(); ?>
      <a class="sr-story" href="<?php the_permalink(); ?>">
        <?php if ( has_post_thumbnail() ) : ?>
          <div class="sr-story__visual">
            <?php the_post_thumbnail( 'large' ); ?>
          </div>
        <?php endif; ?>
        <div class="sr-story__body">
          <div class="sr-story__date"><?php echo esc_html( get_the_date( 'M Y' ) ); ?></div>
          <h3 class="sr-story__title"><?php echo hakshan_post_title_bilingual(); ?></h3>
          <?php $sr_excerpt_raw = wp_strip_all_tags( get_the_excerpt() ); ?>
          <?php if ( $sr_excerpt_raw ) : ?>
            <p class="sr-story__excerpt"><?php echo hakshan_post_excerpt_bilingual( null, 24 ); ?></p>
          <?php endif; ?>
          <span class="sr-story__more">
            <span data-en>Read more</span><span data-zh>继续阅读</span>
            <span class="arr">→</span>
          </span>
        </div>
      </a>
    <?php endwhile; wp_reset_postdata(); ?>
  </div>
</section>
<?php endif; ?>

<!-- ============== CLOSE ============== -->
<section class="sr-close">
  <div class="sr-close__inner" data-reveal>
    <span class="h-eyebrow"><span class="dot"></span>
      <span data-en>EAT WITH PURPOSE</span>
      <span data-zh>用餐即行善</span>
    </span>
    <h2>
      <span data-en>Eat at any outlet,<br/><em>you're part of this.</em></span>
      <span data-zh>到任何一家用餐，<br/><em>你就是其中一份。</em></span>
    </h2>
    <p>
      <span data-en>Every meal at Hakshan funds the rule — quietly, automatically, every kitchen, every day. Walk in, sit down, order something. That is enough.</span>
      <span data-zh>客善的每一餐都在为这条规则供给——安静地，自动地，每一家厨房，每一天。走进来，坐下，点菜。这就够了。</span>
    </p>
    <div class="sr-close__buttons">
      <a class="btn" href="<?php echo esc_url( hakshan_nav_url( 'outlets' ) ); ?>"><span data-en>Find an outlet</span><span data-zh>查找门店</span><span class="arr">→</span></a>
      <a class="btn btn--ghost" href="<?php echo esc_url( hakshan_nav_url( 'menu' ) ); ?>"><span data-en>See the menu</span><span data-zh>查看菜单</span></a>
    </div>
  </div>
</section>

<?php
get_footer();
