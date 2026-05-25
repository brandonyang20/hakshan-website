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
    <span data-zh>三 代 故 事</span>
  </span>
  <h1>
    <span data-en>Three generations.<br/><em>One recipe book.</em></span>
    <span data-zh>三 代 人，<br/><em>一 本 食 谱。</em></span>
  </h1>
  <p class="deck">
    <span data-en>It is not really a book. It is a stack of yellowed paper, pencilled notes, and three generations of cooks who never quite agreed on how dark the wok should look. We are still cooking out of it.</span>
    <span data-zh>那 其 实 不 是 一 本 书。是 一 沓 泛 黄 的 纸、铅 笔 的 字，与 三 代 下 厨 的 人 — 他 们 从 没 真 正 同 意 过 镬 要 黑 到 什 么 程 度。我 们 至 今 还 在 照 着 它 做 菜。</span>
  </p>
</section>

<!-- ============== TIMELINE ============== -->
<section class="timeline">
  <div class="timeline__inner">
    <div data-reveal>
      <span class="h-eyebrow"><span class="dot"></span>
        <span data-en>SIXTY-EIGHT YEARS, IN BRIEF</span>
        <span data-zh>六 十 八 年 · 简 述</span>
      </span>
      <h2>
        <span data-en>A long, quiet<br/><em>line.</em></span>
        <span data-zh>一 条 长 长，<br/><em>静 静 的 线。</em></span>
      </h2>
    </div>
    <div class="timeline__list" data-reveal>
      <?php
      $timeline = array(
        array( 'year' => '1958', 'cn' => '第 一 代', 'h_en' => 'A home kitchen, Seremban',     'h_zh' => '芙 蓉 · 家 中 厨 房',
               'p_en' => 'The first generation cooks Hakka food at home — salt-baked chicken, mui choy belly, rice-wine chicken soup. No restaurant. No staff. Just a stove, a wok, and a family that keeps showing up to eat.',
               'p_zh' => '第 一 代 在 家 中 煮 客 家 菜 — 盐 焗 鸡、梅 菜 扣 肉、糯 米 酒 鸡 汤。没 有 餐 厅，没 有 员 工。只 有 一 个 灶、一 只 镬，和 一 屋 子 总 回 来 吃 饭 的 家 人。' ),
        array( 'year' => '2008', 'cn' => '第 二 代', 'h_en' => 'The recipes head north',      'h_zh' => '食 谱 北 上',
               'p_en' => 'The daughter moves to Kuala Lumpur and opens the family\'s first restaurant. For the first time, the dishes are written down — in pencil, on the backs of kuih paper. The recipes do not change. The kitchen, suddenly, has to feed strangers.',
               'p_zh' => '女 儿 北 上 吉 隆 坡，开 了 家 中 第 一 家 餐 厅。第 一 次，那 些 菜 被 写 下 来 — 用 铅 笔，写 在 糕 粿 纸 背 面。食 谱 没 变。厨 房，第 一 次 要 招 待 陌 生 人。' ),
        array( 'year' => '2024', 'cn' => '第 三 代', 'h_en' => 'Hakshan opens, USJ',          'h_zh' => '客 善 开 业 · USJ',
               'p_en' => 'February 2024. The third generation opens Hakshan in USJ. Same recipes — refined by every cook who has held the book since 1958. Same paper. New chairs. A new price point: an RM 15 set. A new rule: fifteen percent of every bill, written into the kitchen\'s costs, returned to community causes.',
               'p_zh' => '2024 年 2 月。第 三 代 在 USJ 开 出 客 善。食 谱 还 是 那 一 本 — 自 1958 年 起，每 一 位 下 厨 的 人 都 留 了 一 笔。纸 还 是 那 叠 纸。椅 子 换 了。价 位 换 了 — RM 15 套 餐。规 则 也 换 了 — 每 一 张 账 单 的 15%，写 进 厨 房 的 成 本 里，回 馈 社 区。' ),
        array( 'year' => '2025', 'cn' => '巴 生 谷', 'h_en' => 'Eight more kitchens',         'h_zh' => '再 添 八 家',
               'p_en' => 'Eight more outlets open within twenty-two months — Menjalara, Cheras, Bandar Puteri Puchong, IOI Conezion, Budiman Park Kajang, Arcoris Mont Kiara, The Waterfront ParkCity, Plaza Arkadia. Same recipes, same standards, same pencilled paper in every kitchen.',
               'p_zh' => '二 十 二 个 月 内，再 开 八 家 — 满 家 拉、蕉 赖、蒲 种 Bandar Puteri、IOI Conezion、加 影、满 家 乐、ParkCity、Plaza Arkadia。同 样 的 食 谱，同 样 的 标 准，同 样 那 叠 铅 笔 字 的 纸。' ),
        array( 'year' => '2026', 'cn' => '今 天',    'h_en' => 'Ten kitchens, one book',      'h_zh' => '十 家 厨 房，一 本 食 谱',
               'p_en' => 'Nine retail outlets and one cloud kitchen across the Klang Valley. The tenth retail outlet and the third cloud kitchen open next month. Penang follows in the second quarter. The book stays in the central kitchen.',
               'p_zh' => '巴 生 谷 九 家 门 店 与 一 家 云 厨 房。第 十 家 门 店 与 第 三 家 云 厨 房 将 于 下 月 开 业。槟 城 紧 随 其 后，第 二 季 度 开 业。那 本 书，留 在 中 央 厨 房。' ),
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
      <span data-zh>「这 道 菜 不 靠 调 味，<em>靠 的 是 等。</em>」</span>
    </p>
    <div class="by">
      <span data-en>— A SAYING IN OUR KITCHEN</span>
      <span data-zh>— 厨 房 里 的 一 句 老 话</span>
    </div>
  </div>
</section>

<!-- ============== STORY BODY ============== -->
<section class="story-body">
  <div data-reveal>
    <span class="small"><span data-en>I · IN SEREMBAN, A STOVE</span><span data-zh>一 · 芙 蓉，一 个 灶</span></span>
    <p style="font-size: 22px; line-height: 1.5;">
      <span data-en>In 1958, the first generation cooked Hakka food at home in Seremban. Not in a restaurant. Not for a customer. For a family. The stove was wood-fired. The recipes lived in her hands. Nothing was written down — she didn't think she needed to, and she didn't think anyone else would.</span>
      <span data-zh>1958 年，第 一 代 在 芙 蓉 的 家 中 煮 客 家 菜。不 是 餐 厅，不 是 给 客 人 — 是 给 家 人。灶 是 柴 火 灶。食 谱 在 她 手 里。一 字 未 落 于 纸 — 她 不 觉 得 自 己 需 要，也 不 觉 得 别 人 会 需 要。</span>
    </p>

    <div class="figure">
      <div class="ph" data-label="First generation · a home kitchen in Seremban, c. 1958"></div>
      <div class="caption"><span data-en>↑ Pl. 01 · A home kitchen in Seremban, c. 1958</span><span data-zh>↑ 图 一 · 芙 蓉 的 家 中 厨 房，约 1958</span></div>
    </div>

    <span class="small"><span data-en>II · THE RECIPES GO NORTH</span><span data-zh>二 · 食 谱 北 上</span></span>
    <p>
      <span data-en>Fifty years later, the second generation moved to Kuala Lumpur and opened the family's first restaurant — a place that would have to feed people who weren't family. For the first time, the dishes were written down. The paper was kuih paper. The ink was pencil. The notes — which kampung the chicken should come from, how dark the wok should look before the pork belly went in, how long to wait — were written in the spaces where they wouldn't slow service down.</span>
      <span data-zh>五 十 年 后，第 二 代 北 上。她 把 食 谱 带 到 吉 隆 坡，开 了 家 中 第 一 家 餐 厅 — 一 间 要 招 待 陌 生 人 的 餐 厅。第 一 次，那 些 菜 被 写 下 来。纸 是 糕 粿 纸。字 是 铅 笔 字。批 注 — 鸡 要 从 哪 个 甘 榜 来、镬 要 黑 到 什 么 程 度 才 下 三 层 肉、要 等 多 久 — 都 写 在 不 妨 碍 出 餐 的 空 白 处。</span>
    </p>
    <p>
      <span data-en>The recipes did not change. The kitchen, suddenly, had to feed strangers.</span>
      <span data-zh>食 谱 没 变。厨 房，第 一 次 要 招 待 陌 生 人。</span>
    </p>

    <div class="figure">
      <div class="ph" data-label="Second generation · pencil notes on kuih paper, c. 2008"></div>
      <div class="caption"><span data-en>↑ Pl. 02 · The first written copy of the family recipes, c. 2008</span><span data-zh>↑ 图 二 · 家 中 食 谱 首 次 落 笔，约 2008</span></div>
    </div>

    <h3><span data-en>The third generation opens a door</span><span data-zh>第 三 代 推 开 一 扇 门</span></h3>
    <p>
      <span data-en>In February 2024, the third generation opened Hakshan (客善) in USJ — guest, kindness. Same recipes, refined by every cook who has held the book since 1958. Same paper — the original sits in the central kitchen; pencilled copies hang in every outlet that opens. The chairs are new.</span>
      <span data-zh>2024 年 2 月，第 三 代 在 USJ 开 出 客 善 — 客 者，善 也。食 谱 还 是 那 一 本 — 自 1958 年 起，每 一 位 下 厨 的 人 都 留 了 一 笔。纸 还 是 那 叠 纸 — 原 稿 留 在 中 央 厨 房，新 开 的 每 一 家 门 店 都 挂 着 铅 笔 字 的 复 印 本。椅 子 换 了。</span>
    </p>
    <p>
      <span data-en>The price point is new too — an RM 15 set, more accessible than any restaurant the family has run before. And the discipline that comes with it: fifteen percent of every bill is written into the kitchen's costs and returned to community causes. Not from the profit. From every ringgit. The receipt doesn't say so. You just know.</span>
      <span data-zh>价 位 也 是 新 的 — RM 15 套 餐，比 家 中 任 何 一 个 餐 厅 都 平 易。配 套 的 还 有 一 份 纪 律：每 一 张 账 单 的 15%，直 接 写 进 厨 房 的 成 本 里，回 馈 社 区。不 是 从 利 润 出 — 是 从 营 收 出。收 据 上 不 写。但 你 心 里 清 楚。</span>
    </p>

    <div class="figure">
      <div class="ph" data-label="Third generation · the central kitchen, Feb 2024"></div>
      <div class="caption"><span data-en>↑ Pl. 03 · The central kitchen, the same recipes, ready for service · USJ, Feb 2024</span>
        <span data-zh>↑ 图 三 · 中 央 厨 房 · 同 一 本 食 谱，准 备 出 餐 · USJ，2024 年 2 月</span></div>
    </div>
  </div>
</section>

<!-- ============== CINEMATIC BREAK ============== -->
<section class="cinema-break">
  <div class="cinema-break__inner" data-reveal>
    <div class="small">
      <span class="cn">慢 火</span>
      <span data-en>WHAT WE'VE KEPT</span>
      <span data-zh>我 们 留 下 的</span>
    </div>
    <p class="line">
      <span data-en>The book. <em>The fire.</em><br/>The share that always belongs<br/>to <em>someone else.</em></span>
      <span data-zh>那 本 食 谱。<em>那 把 火。</em><br/>那 一 份 — <em>永 远 属 于 别 人 的。</em></span>
    </p>
  </div>
</section>

<!-- ============== THREE PORTRAITS ============== -->
<section class="portraits">
  <div class="portraits__head" data-reveal>
    <span class="h-eyebrow"><span class="dot"></span>
      <span data-en>THE FAMILY · 一 家 三 代</span>
      <span data-zh>家 · 三 代</span>
    </span>
    <h2>
      <span data-en>The people who<br/>made the <em>book.</em></span>
      <span data-zh>把 食 谱<br/>留 下 来 的 <em>人。</em></span>
    </h2>
  </div>
  <div class="portraits__grid" data-reveal>
    <div class="portrait">
      <div class="portrait__visual"><div class="ph" data-label="First generation · a home kitchen in Seremban, c. 1958"></div></div>
      <div class="portrait__num">FIRST GENERATION · 一 代</div>
      <h3>
        <span data-en>She cooked at home</span><span data-zh>她 在 家 中 下 厨</span>
      </h3>
      <p>
        <span data-en>Seremban, from 1958. Hakka dishes cooked at home — salt-baked chicken, mui choy belly, rice-wine chicken soup. Never ran a restaurant. The recipes lived in her hands.</span>
        <span data-zh>1958 年 起，于 芙 蓉。家 中 烹 客 家 菜 — 盐 焗 鸡、梅 菜 扣 肉、糯 米 酒 鸡 汤。一 生 未 开 餐 厅。食 谱，在 她 手 上。</span>
      </p>
    </div>
    <div class="portrait">
      <div class="portrait__visual"><div class="ph" data-label="Second generation · pencil notes on kuih paper, c. 2008"></div></div>
      <div class="portrait__num">SECOND GENERATION · 二 代</div>
      <h3>
        <span data-en>She wrote it down</span><span data-zh>她 把 食 谱 写 下 来</span>
      </h3>
      <p>
        <span data-en>Brought the recipes north to Kuala Lumpur around 2008 and opened the family's first restaurant. Wrote the dishes down for the first time — in pencil, on the back of kuih paper. The recipes did not change. The kitchen, suddenly, had to feed strangers.</span>
        <span data-zh>约 2008 年，把 食 谱 带 到 吉 隆 坡，开 了 家 中 第 一 家 餐 厅。第 一 次 把 菜 写 下 来 — 用 铅 笔，写 在 糕 粿 纸 背 面。食 谱 没 变。厨 房，第 一 次 要 招 待 陌 生 人。</span>
      </p>
    </div>
    <div class="portrait">
      <div class="portrait__visual"><div class="ph" data-label="Third generation · the central kitchen, Feb 2024"></div></div>
      <div class="portrait__num">THIRD GENERATION · 三 代</div>
      <h3>
        <span data-en>Same recipes, new room</span><span data-zh>同 一 本 食 谱，新 的 厅</span>
      </h3>
      <p>
        <span data-en>Opened Hakshan in USJ, February 2024. Same recipes. Same paper. New chairs, new price point, and a new rule: fifteen percent of every bill, written into the kitchen's costs, returned to community causes.</span>
        <span data-zh>2024 年 2 月，在 USJ 开 出 客 善。食 谱 不 变，纸 不 变。椅 子 换 了，价 位 换 了，规 则 也 换 了 — 每 一 张 账 单 的 15%，写 进 厨 房 的 成 本 里，回 馈 社 区。</span>
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
        <span data-zh>用 餐 慈 善</span>
      </span>
      <h2>
        <span data-en>Every plate<br/>buys <em>one more.</em></span>
        <span data-zh>一 菜<br/><em>一 善。</em></span>
      </h2>
    </div>
    <div data-reveal>
      <p class="lead">
        <span data-en>Fifteen percent of every bill at every outlet leaves the till at the end of service. We do not print the amount on the receipt. You just know.</span>
        <span data-zh>每 一 家 门 店 的 每 一 张 账 单，15% 在 营 业 结 束 时 即 离 开 钱 箱。我 们 不 把 金 额 印 在 收 据 上。但 你 心 里 清 楚。</span>
      </p>
      <p>
        <span data-en>A fixed share of every ringgit is allocated to three focus areas: education, elderly care, and animal welfare. It is not a donation made out of profit. It is written into the kitchen's cost structure — at the same line as rent, food, and staff. It cannot be skipped because there isn't a flag to skip it.</span>
        <span data-zh>每 一 元 营 收 的 固 定 比 例，投 入 三 个 方 向：教 育、长 者 关 怀、动 物 福 利。这 不 是 用 利 润 做 的 捐 赠，而 是 写 进 厨 房 成 本 结 构 里 的 一 行 — 与 租 金、食 材、人 工 同 一 行。无 法 被 跳 过，因 为 根 本 没 有 跳 过 它 的 选 项。</span>
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
      <span data-zh>来 同 桌</span>
    </span>
    <h2>
      <span data-en>The book is<br/><em>open.</em></span>
      <span data-zh>那 本 书，<br/><em>翻 开 着。</em></span>
    </h2>
    <span class="cn">客 来 茶 当 酒</span>
    <div class="story-close__buttons">
      <a class="btn" href="<?php echo esc_url( hakshan_nav_url( 'contact' ) . '#reserve' ); ?>"><span data-en>Reserve a table</span><span data-zh>预 订 座 位</span><span class="arr">→</span></a>
      <a class="btn btn--ghost" href="<?php echo esc_url( hakshan_nav_url( 'menu' ) ); ?>"><span data-en>See the menu</span><span data-zh>查 看 菜 单</span></a>
    </div>
  </div>
</section>

<?php
get_footer();
