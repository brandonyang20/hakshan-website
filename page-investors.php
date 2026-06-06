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
      <span data-en>A family brand,<br/><em>an open door.</em></span>
      <span data-zh>家的味道，<br/><em>新开一扇门。</em></span>
    </h1>
  </div>
  <p>
    <span data-en>Hakshan (客善) is a Hakka cuisine family business. Three generations of recipes, eighteen years of running kitchens, opening new outlets at the pace we can do them right. If you'd like to join the family, we'd like to meet.</span>
    <span data-zh>客善是一家客家料理家族企业。三代人的食谱，十八年的厨房经营，一间一间地开，按我们能做好的节奏。若你想加入这个家族，欢迎认识。</span>
  </p>
</section>

<!-- ============== NARRATIVE — WHO WE ARE ============== -->
<section class="inv-narrative">
  <div data-reveal>
    <span class="h-eyebrow"><span class="dot"></span>
      <span data-en>OUR STORY</span>
      <span data-zh>我们的故事</span>
    </span>
    <h2>
      <span data-en>Affordable food,<br/><em>with intent.</em></span>
      <span data-zh>平价的食物，<br/><em>有心的经营。</em></span>
    </h2>
  </div>
  <div class="inv-narrative__body" data-reveal>
    <p class="lead">
      <span data-en>Three generations of cooking. One family. One way of doing things, kept whole.</span>
      <span data-zh>三代人下厨。一个家族。一种做法，原味原样。</span>
    </p>
    <p>
      <span data-en>We've spent eighteen years learning how to run a kitchen well. With Hakshan, we're not selling franchises. We're inviting people to join. Investors share in the work and the outcomes the way the family does: by being part of the kitchen, not separate from it.</span>
      <span data-zh>我们花了十八年学习怎样做好一间厨房。客善不是加盟生意，而是邀请人一起做。投资人参与厨房的方式，和家族成员一样：在厨房里，而不是站在外面。</span>
    </p>
    <span class="small"><span data-en>WHAT STAYS THE SAME</span><span data-zh>保 持 不 变</span></span>
    <p>
      <span data-en>The recipe book has never been retyped. The supplier relationships go back nearly two decades. Every kitchen lead is trained by the wok master in person. The community contribution sits inside the cost structure, not bolted onto profit. These don't change.</span>
      <span data-zh>食谱本从未重打。供应商关系将近二十年。每一位厨房主管由主厨亲自培训。社区回馈写在成本里，不是从利润里抽出来的。这些，不会变。</span>
    </p>
    <span class="small"><span data-en>HOW WE'RE GROWING</span><span data-zh>我 们 的 节 奏</span></span>
    <p>
      <span data-en>We open new outlets one at a time, when the supply chain and the team can carry them. We choose locations by the people who live there, not the rent. Slow on purpose. There's room for the right partners.</span>
      <span data-zh>我们一间一间开，等供应链与团队都能撑得住的时候才开。选址看的是社区，不是租金。慢，是有意为之。我们留有空间，等合适的伙伴。</span>
    </p>
  </div>
</section>

<!-- ============== FOOTPRINT ============== -->
<section class="footprint" id="footprint">
  <div class="footprint__inner">
    <div class="footprint__head" data-reveal>
      <div>
        <span class="h-eyebrow"><span class="dot"></span>
          <span data-en>WHERE WE ARE</span>
          <span data-zh>我们在哪里</span>
        </span>
        <h2>
          <span data-en>Where the kitchens<br/><em>are, and aren't yet.</em></span>
          <span data-zh>厨房现在哪里，<br/><em>下一步在哪里。</em></span>
        </h2>
      </div>
      <p>
        <span data-en>We grow at the pace of our supply chain and our people, not our capital. Every new location is chosen for community fit. No outlet has been closed since launch.</span>
        <span data-zh>我们按供应链与团队的节奏成长，不是资金的节奏。每一个新址都看社区气质。开业以来没有一家门店关闭。</span>
      </p>
    </div>

    <div class="fp-grid" data-reveal>
      <div class="fp-row">
        <h4><span data-en>TODAY</span><span data-zh>今 天</span></h4>
        <div class="name"><span data-en>9 kitchens, Klang Valley</span><span data-zh>9 间 厨 房 · 巴 生 谷</span></div>
        <p><span data-en>Nine Hakshan outlets across the Klang Valley, from USJ to Mont Kiara. Every kitchen runs the same recipes, the same way.</span>
          <span data-zh>巴生谷九家门店，从 USJ 到满家乐。每一间厨房，用同一本食谱，同一套做法。</span></p>
      </div>
      <div class="fp-row">
        <h4><span data-en>NEXT</span><span data-zh>下 一 步</span></h4>
        <div class="name"><span data-en>More on the way</span><span data-zh>陆 续 开 业</span></div>
        <p><span data-en>The brand is still young. New outlets are in the pipeline. We open them when we're ready, not when the market asks.</span>
          <span data-zh>品牌还年轻。新店在准备中。我们准备好了才开，不被市场推着走。</span></p>
      </div>
      <div class="fp-row">
        <h4><span data-en>WHAT STAYS</span><span data-zh>不 变 的</span></h4>
        <div class="name"><span data-en>The recipe book</span><span data-zh>食 谱 本</span></div>
        <p><span data-en>The recipe book is not for franchise sale. The wok master trains every kitchen lead in person. Some things don't scale through paperwork.</span>
          <span data-zh>食谱不对外出售。每一位厨房主管由主厨亲自培训。有些事情，不靠纸张扩张。</span></p>
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
