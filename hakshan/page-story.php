<?php
/* Template Name: Our Story */
get_header();
?>
<main>

<style>
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
  .portrait { display: grid; gap: 18px; }
  .portrait__visual { aspect-ratio: 3/4; position: relative; }
  .portrait__visual .ph { position: absolute; inset: 0; }
  .portrait__visual img { position: absolute; inset: 0; width: 100%; height: 100%; object-fit: cover; }
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
  .cinema-break__inner { position: relative; z-index: 2; text-align: center; max-width: 1000px; }
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
  .press__list { display: grid; border-top: 1px solid var(--line); }
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
  .story-close__buttons { display: flex; gap: 16px; justify-content: center; flex-wrap: wrap; }

  @media (max-width: 980px) {
    .timeline__inner, .charity-block__inner { grid-template-columns: 1fr; gap: 32px; }
    .portraits__grid { grid-template-columns: 1fr; }
    .tl-row { grid-template-columns: 1fr 1fr; }
    .tl-row p { grid-column: 1 / -1; }
    .press__row { grid-template-columns: 1fr; gap: 8px; }
    .press__row .date { text-align: left; }
  }
</style>

<!-- HERO -->
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
    <span data-en>It is not really a book. It is a stack of yellowed paper, soy stains, and margin notes our grandmother kept in a tin under the rice barrel. We are still cooking out of it.</span>
    <span data-zh>那 其 实 不 是 一 本 书。那 是 一 沓 泛 黄 的 纸，沾 着 酱 油 渍、写 满 旁 批，奶 奶 藏 在 米 缸 下 的 铁 罐 里。我 们 至 今 还 在 照 着 它 做 菜。</span>
  </p>
</section>

<!-- TIMELINE -->
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
      <div class="tl-row">
        <div class="year">1958</div>
        <div class="cn-big">阿婆</div>
        <div>
          <h3><span data-en>Ah Por opens a stove</span><span data-zh>阿 婆 开 灶</span></h3>
          <p><span data-en>A tin-roofed kitchen in Hulu Selangor. Salt-baked chicken in kraft paper, mui choy belly that takes the better part of a Saturday, rice-wine soup for any woman who has just given birth.</span>
            <span data-zh>乌鲁雪兰莪一间锌板顶小厨房。牛皮纸盐焗鸡、要做大半个星期六的梅菜扣肉、谁家添丁就煮的糯米酒汤。</span></p>
        </div>
      </div>
      <div class="tl-row">
        <div class="year">1962</div>
        <div class="cn-big">食 谱</div>
        <div>
          <h3><span data-en>The tin under the rice barrel</span><span data-zh>米 缸 下 的 铁 罐</span></h3>
          <p><span data-en>Ah Por starts writing things down on the backs of kuih paper. She does it because she suspects she won't always remember. She is right.</span>
            <span data-zh>阿婆开始把方子写在糕粿纸的背面 — 因为她怀疑自己总有一天会忘。她猜对了。</span></p>
        </div>
      </div>
      <div class="tl-row">
        <div class="year">1986</div>
        <div class="cn-big">爸爸</div>
        <div>
          <h3><span data-en>The shophouse years, Kepong</span><span data-zh>店 屋 时 代 · 甲 洞</span></h3>
          <p><span data-en>Father takes the recipe book to a two-table shophouse on Jalan Kepong. He doesn't rename anything. He doesn't modernise anything. He just keeps cooking, and people keep showing up.</span>
            <span data-zh>父亲把食谱带到甲洞一间两张桌的店屋。他没改名，没现代化任何菜式，只是继续煮 — 而人，也继续来。</span></p>
        </div>
      </div>
      <div class="tl-row">
        <div class="year">2018</div>
        <div class="cn-big">客 善</div>
        <div>
          <h3><span data-en>Hakshan opens, USJ Taipan</span><span data-zh>客 善 开 业 · USJ</span></h3>
          <p><span data-en>The third generation opens the first dining room. Same dishes. Same book. New chairs, warmer light, a seat reserved every night for someone who can't pay.</span>
            <span data-zh>第三代开出第一间餐厅。菜不变、食谱不变，只换了椅子；并每晚为付不起饭钱的人留下一张桌。</span></p>
        </div>
      </div>
      <div class="tl-row">
        <div class="year">2021</div>
        <div class="cn-big">三 家</div>
        <div>
          <h3><span data-en>Three rooms, no compromises</span><span data-zh>三 家 · 不 妥 协</span></h3>
          <p><span data-en>Cheras and Menjalara open within eight months of each other. The wok master from KL personally cooks the first service at each new outlet — a habit we have not broken since.</span>
            <span data-zh>蕉赖与满家拉前后八个月内开张。KL 的主厨亲自掌勺新店头一日 — 这个习惯至今未改。</span></p>
        </div>
      </div>
      <div class="tl-row">
        <div class="year">2026</div>
        <div class="cn-big">九 家</div>
        <div>
          <h3><span data-en>Nine kitchens, one ledger</span><span data-zh>九 家 厨 房 · 一 本 账</span></h3>
          <p><span data-en>Nine dining rooms across the Klang Valley. Every outlet runs the same recipe book and the same charity table. Outlet 10 opens in Penang this April.</span>
            <span data-zh>九家分店遍布巴生谷，同一本食谱、同一张慈善桌。第十家 2026 年 4 月落户槟城。</span></p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- PULL QUOTE -->
<section class="story-pull">
  <div data-reveal>
    <p class="quote">
      <span data-en>"You don't season this dish. <em>You wait for it.</em>"</span>
      <span data-zh>「这 道 菜 不 靠 调 味，<em>靠 的 是 等。</em>」</span>
    </p>
    <div class="by">
      <span data-en>— AH POR, on her salt-baked chicken, c. 1986</span>
      <span data-zh>— 阿 婆 谈 盐 焗 鸡，约 1986</span>
    </div>
  </div>
</section>

<!-- STORY BODY -->
<section class="story-body">
  <div data-reveal>
    <span class="small"><span data-en>I · A KITCHEN, A STOVE, SIX CHILDREN</span><span data-zh>一 · 一 厨 一 灶 六 个 孩 子</span></span>
    <p style="font-size: 22px; line-height: 1.5;">
      <span data-en>Ah Por started cooking for her village in 1958. She did not have a restaurant. She had a stove, six children, and a long list of rubber tappers who walked past her gate at 7pm hungry. The salted chicken came out at 7:15. Whatever was left in the wok at 9pm went home with whoever was still there.</span>
      <span data-zh>1958 年，阿婆开始为村里人煮饭。她没有餐厅，只有一个炉灶、六个孩子，和一长串晚上七点路过她家门、饿着肚子的橡胶工。盐焗鸡七点一刻准时出炉。九点锅里剩下的，就分给还没走的人。</span>
    </p>

    <div class="figure">
      <div class="ph" data-label="Ah Por, c. 1962 · Hulu Selangor"></div>
      <div class="caption"><span data-en>↑ Pl. 01 · Ah Por, Hulu Selangor, c. 1962</span><span data-zh>↑ 图 一 · 阿 婆 于 乌 鲁 雪 兰 莪，约 1962</span></div>
    </div>

    <span class="small"><span data-en>II · A FATHER WHO DID NOT CHANGE MUCH</span><span data-zh>二 · 一 个 没 改 太 多 的 父 亲</span></span>
    <p>
      <span data-en>Father moved the family to Kepong in 1986. He opened a two-table shophouse and put a wok and a rice cooker behind the counter. He could have modernised the menu. He could have hired a chef. Instead he carried Ah Por's recipe book downstairs every morning and cooked out of it himself until 2014.</span>
      <span data-zh>1986 年，父亲把全家搬到甲洞，开了一间两张桌的店屋，柜台后摆一个炒锅、一个电饭煲。他完全可以现代化菜单，可以请大厨；但他每天早上把阿婆的食谱抱下楼，照着它一路煮到 2014 年。</span>
    </p>
    <p>
      <span data-en>He did make one change. He started writing his own notes in the margins, in the spaces Ah Por had left blank. He never showed us. We found them after he died.</span>
      <span data-zh>他确实改了一件事 — 他开始在阿婆的空白处加批注。从未给我们看过。直到他过世，我们整理那本食谱时才发现。</span>
    </p>

    <h3><span data-en>The third generation opens a door</span><span data-zh>第 三 代 推 开 一 扇 门</span></h3>
    <p>
      <span data-en>In 2018 we opened the first dining room under the name Hakshan 客善 — guest, kindness. The name was Father's idea. He was eighty-one. He insisted the receipt show no charity contribution. "If you're going to give," he said, "give quietly. Don't make the guest feel like they bought you a halo."</span>
      <span data-zh>2018 年，我们以「客善」之名开出第一间餐厅 — 客者，善也。这名字是父亲起的。他八十一岁。他坚持收据上不能印任何慈善捐款金额。「要给，就静静地给，」他说，「别让客人觉得他给你买了个光环。」</span>
    </p>
    <p>
      <span data-en>So we don't. The charity model runs quietly in the back of the house. The receipt shows nothing. The chair — one per outlet, every night — is always set, always laid, always waiting. Whoever needs it knows where it is.</span>
      <span data-zh>所以我们没有。慈善的部分静静运转在后厨。收据上什么也没有。那张桌 — 每家分店一张，每晚都摆好、铺好、等着 — 谁需要，谁就知道在哪。</span>
    </p>

    <div class="figure">
      <div class="ph" data-label="The recipe book · open spread, 1958–present"></div>
      <div class="caption"><span data-en>↑ Pl. 02 · The recipe book, opened to mui choy belly · margin in Ah Por's hand (left), in Father's hand (right)</span>
        <span data-zh>↑ 图 二 · 食 谱 翻 至 梅 菜 扣 肉 · 左 为 阿 婆 笔 迹，右 为 父 亲 笔 迹</span></div>
    </div>
  </div>
</section>

<!-- CINEMATIC BREAK -->
<section class="cinema-break">
  <div class="cinema-break__inner" data-reveal>
    <div class="small">
      <span class="cn">慢 火</span>
      <span data-en>WHAT WE'VE KEPT</span>
      <span data-zh>我 们 留 下 的</span>
    </div>
    <p class="line">
      <span data-en>The book. <em>The fire.</em><br/>The seat that always belongs<br/>to <em>someone else.</em></span>
      <span data-zh>那 本 食 谱。<em>那 把 火。</em><br/>那 张 桌 — <em>永 远 留 给 别 人 的。</em></span>
    </p>
  </div>
</section>

<!-- THREE PORTRAITS -->
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
      <div class="portrait__visual"><div class="ph" data-label="Tan Mui Lan (Ah Por) · 1962"></div></div>
      <div class="portrait__num">FIRST GENERATION · 一 代</div>
      <h3>
        <span data-en>Tan Mui Lan</span><span data-zh>陈 梅 兰</span>
        <span class="cn">阿 婆</span>
      </h3>
      <p>
        <span data-en>Born Sungai Lembing 1932. Cooked for her village from 1958 until she could no longer stand at the stove. Wrote the book on the backs of kuih paper.</span>
        <span data-zh>1932 年生于双溪宁宜。自 1958 起为全村煮饭，直至无法久站。把食谱写在糕粿纸背面。</span>
      </p>
    </div>
    <div class="portrait">
      <div class="portrait__visual"><div class="ph" data-label="Tan Wei Keong · 1992, Kepong shophouse"></div></div>
      <div class="portrait__num">SECOND GENERATION · 二 代</div>
      <h3>
        <span data-en>Tan Wei Keong</span><span data-zh>陈 伟 强</span>
        <span class="cn">爸 爸</span>
      </h3>
      <p>
        <span data-en>Born 1944. Moved the kitchen to Kepong in 1986. Cooked behind the same wok for twenty-eight years. Added his own marginalia, in red ink.</span>
        <span data-zh>1944 年生。1986 年将厨房迁至甲洞。在同一只炒锅后做了二十八年。以红笔在阿婆的食谱旁添批注。</span>
      </p>
    </div>
    <div class="portrait">
      <div class="portrait__visual"><div class="ph" data-label="Tan Wei Ming &amp; siblings · 2018, USJ kitchen"></div></div>
      <div class="portrait__num">THIRD GENERATION · 三 代</div>
      <h3>
        <span data-en>Wei Ming &amp; siblings</span><span data-zh>伟 明 与 兄 妹</span>
        <span class="cn">我 们</span>
      </h3>
      <p>
        <span data-en>Opened Hakshan in 2018, USJ Taipan. Run the kitchens. Wrote the charity model. Have not yet added our own marginalia — but we are taking notes.</span>
        <span data-zh>2018 年于 USJ 创立客善。掌厨、运营、起草慈善模式。我们还没在食谱上添过批注 — 但已开始记录。</span>
      </p>
    </div>
  </div>
</section>

<!-- CHARITY -->
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
        <span data-en>Hakshan is Malaysia's first dining-with-charity restaurant. We do not print the amount on the receipt. You just know.</span>
        <span data-zh>客善是马来西亚首家「用餐即行善」的餐厅。我们不把金额印在收据上 — 但你心里清楚。</span>
      </p>
      <p>
        <span data-en>A fixed share of every bill leaves the till the same night and arrives at someone else's table — community kitchens, elder-care meals, and scholarships for kitchen apprentices from rural Hakka villages. Every outlet runs a charity table: one seat that always belongs to someone else.</span>
        <span data-zh>每一张账单的固定比例，当晚就离开钱箱，到别人的饭桌上 — 社区厨房、长者送餐、与乡村客家学徒奖学金。每家分店都设有一张「慈善桌」 — 那张桌永远留给别人。</span>
      </p>
      <div class="charity-block__stats">
        <div><div class="num">186<span style="font-size: 0.55em; opacity: 0.7;">k</span></div>
          <div class="lbl"><span data-en>Meals donated · 42 partner kitchens</span><span data-zh>已 捐 餐 数 · 42 家 合 作 厨 房</span></div></div>
        <div><div class="num">RM 2.4M</div>
          <div class="lbl"><span data-en>Contributed since 2018 · MyCare audited</span><span data-zh>自 2018 累 计 · MyCare 审 计</span></div></div>
        <div><div class="num">9 / 9</div>
          <div class="lbl"><span data-en>Outlets with a charity table · every night</span><span data-zh>设 慈 善 桌 分 店 · 每 晚 不 间 断</span></div></div>
        <div><div class="num">9</div>
          <div class="lbl"><span data-en>Apprentices per year · Hulu Selangor, Bentong</span><span data-zh>每 年 学 徒 · 乌鲁雪兰莪、文 冬</span></div></div>
      </div>
    </div>
  </div>
</section>

<!-- PRESS -->
<section class="press" id="press">
  <div class="press__head" data-reveal>
    <span class="h-eyebrow"><span class="dot"></span>
      <span data-en>WHAT OTHERS HAVE SAID</span>
      <span data-zh>外 界 之 声</span>
    </span>
    <h2>
      <span data-en>In the<br/><em>press.</em></span>
      <span data-zh><em>报 章</em> 之 间。</span>
    </h2>
  </div>
  <div class="press__list" data-reveal>
    <div class="press__row">
      <div class="who">The Edge Malaysia</div>
      <blockquote>
        <span data-en>"The most quietly radical restaurant in the Klang Valley — a Hakka grandmother's recipe book, scaled into nine kitchens, with the till politely turned away from the camera."</span>
        <span data-zh>「巴 生 谷 最 静 默 而 激 进 的 餐 厅 — 一 本 客 家 奶 奶 的 食 谱，扩 至 九 家 厨 房，钱 箱 始 终 礼 貌 地 别 过 镜 头。」</span>
      </blockquote>
      <div class="date">22 Mar 2024</div>
    </div>
    <div class="press__row">
      <div class="who">Tatler Asia</div>
      <blockquote>
        <span data-en>"Hakshan does not sell heritage. It practises it — three hours at a time, on a low flame."</span>
        <span data-zh>「客 善 不 出 售『传 承』 — 它 实 践 它，每 次 三 小 时，慢 火 细 炖。」</span>
      </blockquote>
      <div class="date">08 Nov 2023</div>
    </div>
    <div class="press__row">
      <div class="who">South China Morning Post</div>
      <blockquote>
        <span data-en>"The empty seat at every Hakshan outlet is the most generous design decision in Malaysian dining this decade."</span>
        <span data-zh>「客 善 每 家 分 店 的 那 张 空 桌 — 是 这 十 年 大 马 餐 饮 最 慷 慨 的 设 计。」</span>
      </blockquote>
      <div class="date">14 Jun 2023</div>
    </div>
    <div class="press__row">
      <div class="who">星 洲 日 报 · Sin Chew</div>
      <blockquote>
        <span data-en>"三 代 人 守 一 本 书 — 没 有 故 事 营 销，只 有 一 锅 又 一 锅 煮 给 客 人 的 饭。"</span>
        <span data-zh>「三 代 人 守 一 本 书 — 没 有 故 事 营 销，只 有 一 锅 又 一 锅 煮 给 客 人 的 饭。」</span>
      </blockquote>
      <div class="date">02 Feb 2023</div>
    </div>
  </div>
</section>

<!-- CLOSE -->
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
      <a class="btn" href="<?php echo esc_url(home_url('/contact/#reserve')); ?>">
        <span data-en>Reserve a table</span><span data-zh>预 订 座 位</span><span class="arr">→</span>
      </a>
      <a class="btn btn--ghost" href="<?php echo esc_url(home_url('/menu/')); ?>">
        <span data-en>See the menu</span><span data-zh>查 看 菜 单</span>
      </a>
    </div>
  </div>
</section>

</main>
<?php get_footer(); ?>
