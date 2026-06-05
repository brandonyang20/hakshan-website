<?php
/**
 * Template Name: Contact
 * Template Post Type: page
 *
 * @package Hakshan
 */

get_header();
?>
<style>
  /* Contact-specific extras */
  .contact-section {
    padding: clamp(60px, 8vw, 100px) var(--rail);
    max-width: var(--maxw);
    margin: 0 auto;
  }
  .contact-section + .contact-section { padding-top: 0; }
  .contact-section.dark {
    background: var(--cream);
    max-width: none;
    margin: 0;
    padding-left: var(--rail);
    padding-right: var(--rail);
    border-top: 1px solid var(--line-soft);
    border-bottom: 1px solid var(--line-soft);
  }
  .contact-section.dark .inner {
    max-width: var(--maxw);
    margin: 0 auto;
  }
  .section-head {
    display: grid;
    grid-template-columns: 1fr 2fr;
    gap: 64px;
    padding-bottom: 32px;
    border-bottom: 1px solid var(--line);
    margin-bottom: 40px;
    align-items: end;
  }
  .section-head h2 {
    font-family: var(--serif);
    font-style: italic;
    font-size: clamp(36px, 5vw, 64px);
    line-height: 1;
    margin: 12px 0 0;
    letter-spacing: -0.02em;
  }
  .section-head h2 em { color: var(--forest); }
  .section-head p {
    font-size: 16px;
    line-height: 1.7;
    color: var(--ink-soft);
    margin: 0;
    max-width: 50ch;
  }

  /* Reservation specifics */
  .reserve-form-block {
    display: grid;
    grid-template-columns: 1.4fr 1fr;
    gap: 80px;
    align-items: start;
  }
  .reserve-info {
    display: grid;
    gap: 24px;
    align-content: start;
  }
  .reserve-info .card {
    padding: 24px;
    background: var(--cream);
    border: 1px solid var(--line-soft);
  }
  .reserve-info .card h4 {
    font-family: var(--mono);
    font-size: 11px;
    letter-spacing: 0.16em;
    text-transform: uppercase;
    color: var(--forest);
    margin: 0 0 10px;
  }
  .reserve-info .card p {
    font-family: var(--serif);
    font-style: italic;
    font-size: 20px;
    line-height: 1.4;
    margin: 0;
    letter-spacing: -0.005em;
    color: var(--ink);
  }
  .reserve-info .card .small {
    font-family: var(--sans);
    font-style: normal;
    font-size: 13px;
    color: var(--ink-soft);
    line-height: 1.6;
    margin-top: 8px;
  }

  /* Outlet pick row inside form */
  .pick-row {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 8px;
    margin-top: 8px;
  }
  .pick-row .chip {
    border: 1px solid var(--line);
    padding: 12px 14px;
    font-family: var(--serif);
    font-style: italic;
    font-size: 16px;
    color: var(--ink);
    background: transparent;
    cursor: pointer;
    transition: all 0.2s ease;
    letter-spacing: -0.005em;
  }
  .pick-row .chip:hover { background: var(--cream); border-color: var(--forest); }
  .pick-row .chip.is-on {
    background: var(--forest);
    color: var(--cream);
    border-color: var(--forest);
  }

  .submit-row {
    margin-top: 16px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 24px;
    padding-top: 24px;
    border-top: 1px solid var(--line);
  }
  .submit-row .terms {
    font-family: var(--mono);
    font-size: 11px;
    letter-spacing: 0.06em;
    color: var(--mute);
    max-width: 40ch;
    line-height: 1.5;
  }

  /* Press grid */
  .press-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 24px;
  }
  .press-card {
    padding: 32px;
    border: 1px solid var(--line);
    display: grid;
    gap: 16px;
    align-content: start;
    transition: background 0.3s ease;
  }
  .press-card:hover { background: var(--cream); }
  .press-card h4 {
    font-family: var(--mono);
    font-size: 11px;
    letter-spacing: 0.16em;
    text-transform: uppercase;
    color: var(--forest);
    margin: 0;
  }
  .press-card h3 {
    font-family: var(--serif);
    font-style: italic;
    font-size: 26px;
    margin: 0;
    letter-spacing: -0.01em;
    line-height: 1.1;
  }
  .press-card p {
    font-size: 14px;
    line-height: 1.6;
    color: var(--ink-soft);
    margin: 0;
  }
  .press-card .link {
    margin-top: auto;
    padding-top: 12px;
    border-top: 1px solid var(--line);
    font-family: var(--mono);
    font-size: 11px;
    letter-spacing: 0.12em;
    color: var(--forest);
  }
  .press-card .link .arr { transition: transform 0.2s; display: inline-block; margin-left: 6px; }
  .press-card:hover .arr { transform: translateX(4px); }

  /* Careers list */
  .careers-list {
    display: grid;
    border-top: 1px solid var(--line);
  }
  .career {
    display: grid;
    grid-template-columns: 80px 1.4fr 1fr 1fr 60px;
    gap: 32px;
    padding: 28px 0;
    border-bottom: 1px solid var(--line);
    align-items: center;
    transition: padding 0.2s ease, background 0.2s ease;
    cursor: pointer;
  }
  .career:hover { padding-left: 16px; background: var(--cream); }
  .career .ix {
    font-family: var(--mono);
    font-size: 11px;
    letter-spacing: 0.16em;
    color: var(--forest);
  }
  .career h3 {
    font-family: var(--serif);
    font-style: italic;
    font-size: 26px;
    margin: 0 0 4px;
    letter-spacing: -0.01em;
  }
  .career .sub {
    font-family: var(--mono);
    font-size: 11px;
    letter-spacing: 0.12em;
    text-transform: uppercase;
    color: var(--mute);
  }
  .career .where, .career .when {
    font-family: var(--mono);
    font-size: 12px;
    color: var(--ink-soft);
    letter-spacing: 0.04em;
  }
  .career .arr {
    font-family: var(--serif);
    font-style: italic;
    font-size: 22px;
    color: var(--forest);
    text-align: right;
    transition: transform 0.2s;
  }
  .career:hover .arr { transform: translateX(8px); }

  /* General info row */
  .info-row {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 32px;
    padding-top: 32px;
    border-top: 1px solid var(--line);
  }
  .info-cell h4 {
    font-family: var(--mono);
    font-size: 11px;
    letter-spacing: 0.16em;
    text-transform: uppercase;
    color: var(--forest);
    margin: 0 0 14px;
  }
  .info-cell a, .info-cell p {
    font-family: var(--serif);
    font-style: italic;
    font-size: 22px;
    line-height: 1.4;
    color: var(--ink);
    margin: 0;
    letter-spacing: -0.005em;
    display: block;
  }
  .info-cell .small {
    font-family: var(--sans);
    font-style: normal;
    font-size: 13px;
    color: var(--ink-soft);
    margin-top: 8px;
    line-height: 1.6;
  }

  /* Quiet closer */
  .quiet-close {
    padding: clamp(80px, 12vw, 140px) var(--rail);
    text-align: center;
    background: var(--paper);
  }
  .quiet-close h2 {
    font-family: var(--serif);
    font-style: italic;
    font-size: clamp(40px, 6vw, 80px);
    line-height: 1;
    margin: 0 0 24px;
    letter-spacing: -0.02em;
    color: var(--ink);
    max-width: 22ch;
    text-wrap: balance;
    margin-left: auto;
    margin-right: auto;
  }
  .quiet-close h2 em { color: var(--forest); }
  .quiet-close .cn {
    font-family: var(--cn);
    font-size: 14px;
    letter-spacing: 0.55em;
    color: var(--forest);
    padding-left: 0.55em;
    opacity: 0.7;
  }

  @media (max-width: 980px) {
    .reserve-form-block { grid-template-columns: 1fr; gap: 48px; }
    .section-head, .info-row, .press-grid { grid-template-columns: 1fr; gap: 24px; }
    .career { grid-template-columns: 50px 1fr 60px; }
    .career .where, .career .when { display: none; }
    .pick-row { grid-template-columns: 1fr 1fr; }
  }
</style>

<!-- ============== HERO ============== -->
<section class="page-head">
  <div>
    <span class="h-eyebrow"><span class="dot"></span>
      <span data-en>GET IN TOUCH · 联 系 我 们</span>
      <span data-zh>联系我们</span>
    </span>
    <h1>
      <span data-en>Open<br/><em>door.</em></span>
      <span data-zh>开着<br/><em>的门。</em></span>
    </h1>
  </div>
  <p>
    <span data-en>Reservations, press, careers, kitchen apprenticeships, and the rare invitation to cook with us. Walk-ins are always welcome at every outlet; everything else is below.</span>
    <span data-zh>预订、媒体、招聘、厨房学徒，以及偶尔邀请与我们一起下厨。每家门店均欢迎散客；其余事项详见下方。</span>
  </p>
</section>

<!-- ============== RESERVATIONS ============== -->
<section class="contact-section dark" id="reserve">
  <div class="inner">
    <div class="section-head" data-reveal>
      <div>
        <span class="h-eyebrow"><span class="dot"></span>
          <span data-en>I · RESERVATIONS</span>
          <span data-zh>一·预订座位</span>
        </span>
        <h2>
          <span data-en>Reserve a<br/><em>table.</em></span>
          <span data-zh>预订 <em>座位。</em></span>
        </h2>
      </div>
      <p>
        <span data-en>Walk-ins welcome at every outlet. Book ahead for parties of six or more, private rooms, or pre-orders of dishes that take more than an afternoon to prepare.</span>
        <span data-zh>所有门店欢迎散客。六人以上、包房，或需提前准备半日以上的菜式，请提前预约。</span>
      </p>
    </div>

    <div class="reserve-form-block">
      <form class="contact-form" data-reveal onsubmit="event.preventDefault(); alert('Reservation submitted — we will confirm by phone within an hour.');">
        <div>
          <label><span data-en>Outlet</span><span data-zh>分店</span></label>
          <div class="pick-row" id="outletPick">
            <button type="button" class="chip is-on" data-val="usj">USJ Taipan</button>
            <button type="button" class="chip" data-val="menjalara">Menjalara</button>
            <button type="button" class="chip" data-val="cheras">Cheras Traders</button>
            <button type="button" class="chip" data-val="puchong">Bandar Puteri</button>
            <button type="button" class="chip" data-val="conezion">IOI Conezion</button>
            <button type="button" class="chip" data-val="kajang">Budiman Park</button>
            <button type="button" class="chip" data-val="kiara">Mont Kiara</button>
            <button type="button" class="chip" data-val="parkcity">The Waterfront</button>
            <button type="button" class="chip" data-val="arkadia">Plaza Arkadia</button>
          </div>
        </div>

        <div class="contact-row">
          <div>
            <label><span data-en>Date</span><span data-zh>日期</span></label>
            <input type="date" name="date" />
          </div>
          <div>
            <label><span data-en>Time</span><span data-zh>时间</span></label>
            <input type="time" name="time" />
          </div>
        </div>

        <div class="contact-row">
          <div>
            <label><span data-en>Party size</span><span data-zh>人数</span></label>
            <input type="number" name="party" min="1" max="20" placeholder="4" />
          </div>
          <div>
            <label><span data-en>Occasion · optional</span><span data-zh>场合·可选</span></label>
            <select name="occasion">
              <option>None · 无</option>
              <option>Birthday · 生 日</option>
              <option>Family gathering · 家 宴</option>
              <option>Business · 商 务</option>
              <option>Anniversary · 周 年</option>
            </select>
          </div>
        </div>

        <div>
          <label><span data-en>Your name</span><span data-zh>姓名</span></label>
          <input type="text" name="name" placeholder="Your full name" />
        </div>

        <div class="contact-row">
          <div>
            <label><span data-en>Phone</span><span data-zh>电话</span></label>
            <input type="tel" name="phone" placeholder="+60 12-345 6789" />
          </div>
          <div>
            <label><span data-en>Email</span><span data-zh>电邮</span></label>
            <input type="email" name="email" placeholder="you@email.com" />
          </div>
        </div>

        <div>
          <label><span data-en>Notes — allergies, pre-orders, the second pot of tea</span><span data-zh>备注 — 过敏、预订菜、加一壶茶</span></label>
          <textarea name="notes" rows="3" placeholder="—"></textarea>
        </div>

        <div class="submit-row">
          <span class="terms">
            <span data-en>WE'LL CONFIRM BY PHONE WITHIN ONE HOUR · 11:00 — 22:00</span>
            <span data-zh>我们将在一小时内电话确认·11:00 — 22:00</span>
          </span>
          <button class="btn" type="submit"><span data-en>Reserve</span><span data-zh>提交预订</span><span class="arr">→</span></button>
        </div>
      </form>

      <div class="reserve-info" data-reveal>
        <div class="card">
          <h4><span data-en>Call directly</span><span data-zh>电 话 预 订</span></h4>
          <p>+60 16-246 2970</p>
          <div class="small"><span data-en>Daily 11:00 — 22:00 · all reservations route through the USJ flagship and are forwarded.</span>
            <span data-zh>每日11:00 — 22:00·所有预订通过 USJ 旗舰店统一接待后转至各分店。</span></div>
        </div>
        <div class="card">
          <h4><span data-en>Whatsapp</span><span data-zh>WhatsApp</span></h4>
          <p>+60 16-246 2970</p>
          <div class="small"><span data-en>Send a screenshot of the outlet you want, your party size, and a date. We'll reply with a slot.</span>
            <span data-zh>把想去的分店截图给我们，附人数与日期。我们回你一个时段。</span></div>
        </div>
        <div class="card">
          <h4><span data-en>Large party · private room</span><span data-zh>包 房 · 大 桌</span></h4>
          <p><span data-en>Twenty people and up.</span><span data-zh>二十人以上。</span></p>
          <div class="small"><span data-en>Tell us the outlet, the date and the headcount, and we'll set the room. Same kitchen, longer table.</span>
            <span data-zh>告诉我们分店、日期与人数，我们把房间留好。同一个厨房，桌子长一些。</span></div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ============== PRESS ============== -->
<section class="contact-section">
  <div class="section-head" data-reveal>
    <div>
      <span class="h-eyebrow"><span class="dot"></span>
        <span data-en>II · PRESS &amp; MEDIA</span>
        <span data-zh>二·媒体联络</span>
      </span>
      <h2>
        <span data-en>For the<br/><em>journalists.</em></span>
        <span data-zh>媒体 <em>查询。</em></span>
      </h2>
    </div>
    <p>
      <span data-en>Stories, interviews, behind-the-pass photography, the recipe book in person. We answer within two business days. We do not pay for placement.</span>
      <span data-zh>报道、访谈、厨房跟拍、食谱实物取材。两个工作日内回复。我们不购买任何媒体位置。</span>
    </p>
  </div>
  <div class="press-grid" data-reveal>
    <div class="press-card">
      <h4><span data-en>PRESS INQUIRIES</span><span data-zh>媒 体 查 询</span></h4>
      <h3><span data-en>Press desk</span><span data-zh>媒 体 联 络</span></h3>
      <p><span data-en>Interviews, statements, kitchen visits, founder availability. We reply within two business days.</span>
        <span data-zh>访谈、声明、入厨拍摄、创办人档期。两个工作日内回复。</span></p>
      <div class="link"><a href="mailto:press@hakshan.com" style="color: inherit;">press@hakshan.com <span class="arr">→</span></a></div>
    </div>
    <div class="press-card">
      <h4><span data-en>BRAND ASSETS</span><span data-zh>品 牌 素 材</span></h4>
      <h3><span data-en>Press kit on request</span><span data-zh>媒 体 包 · 应 求 提 供</span></h3>
      <p><span data-en>Logo, photography library, charity model fact sheet — sent by email on request.</span>
        <span data-zh>标志、图库、慈善模式简报 — 应求以电邮寄送。</span></p>
      <div class="link"><a href="mailto:press@hakshan.com?subject=Press%20kit%20request" style="color: inherit;">Request kit <span class="arr">→</span></a></div>
    </div>
    <div class="press-card">
      <h4><span data-en>KITCHEN VISITS</span><span data-zh>厨 房 探 访</span></h4>
      <h3><span data-en>By appointment</span><span data-zh>预 约 制</span></h3>
      <p><span data-en>Behind-the-pass photography and kitchen tours, arranged in advance — outside service hours, so the line keeps moving.</span>
        <span data-zh>厨房跟拍与厨房参观，须提前预约 — 安排在营业时段之外，避免影响出餐。</span></p>
      <div class="link"><a href="mailto:press@hakshan.com?subject=Kitchen%20visit" style="color: inherit;">Arrange a visit <span class="arr">→</span></a></div>
    </div>
  </div>
</section>

<!-- ============== CAREERS ============== -->
<section class="contact-section dark">
  <div class="inner">
    <div class="section-head" data-reveal>
      <div>
        <span class="h-eyebrow"><span class="dot"></span>
          <span data-en>III · CAREERS &amp; APPRENTICESHIPS</span>
          <span data-zh>三·招聘与学徒</span>
        </span>
        <h2>
          <span data-en>Come<br/>cook with <em>us.</em></span>
          <span data-zh>来同<br/><em>掌厨。</em></span>
        </h2>
      </div>
      <p>
        <span data-en>We hire slowly. Apprentices are trained in-house before they ever stand at an outlet wok — every kitchen lead at every outlet went through this pipeline.</span>
        <span data-zh>招人不急。学徒先在内部受训，然后才进入门店。每一家门店的厨房主管，皆由此路培养而来。</span>
      </p>
    </div>
    <div class="careers-list" data-reveal>
      <?php
      $careers = array(
        array( 'ix' => 'N° 01', 'h_en' => 'Kitchen Apprentice',               'h_zh' => '厨 房 学 徒',               's_en' => 'In-house training · 12-month programme',         's_zh' => '内 部 培 训 · 十 二 个 月',         'where' => 'USJ Taipan · HQ', 'w_en' => 'Applications · rolling',        'w_zh' => '滚 动 招 募' ),
        array( 'ix' => 'N° 02', 'h_en' => 'Outlet Kitchen Lead',              'h_zh' => '门 店 厨 房 主 管',         's_en' => 'Lead a single outlet kitchen',                   's_zh' => '独 立 主 持 一 间 门 店 厨 房',   'where' => 'Mont Kiara',     'w_en' => 'Applications · rolling',        'w_zh' => '滚 动 招 募' ),
        array( 'ix' => 'N° 03', 'h_en' => 'Service Captain',                  'h_zh' => '领 班',                     's_en' => 'Daily 11:00 — 22:00, bilingual',                's_zh' => '每 日 11:00 — 22:00，双 语',     'where' => 'Cheras Traders', 'w_en' => 'Applications · rolling',        'w_zh' => '滚 动 招 募' ),
        array( 'ix' => 'N° 04', 'h_en' => 'Community Programmes Officer',     'h_zh' => '社 区 项 目 主 任',         's_en' => 'Coordinate the per-dish community allocation',   's_zh' => '统 筹 每 道 菜 的 社 区 投 入',  'where' => 'USJ Taipan · HQ','w_en' => 'Applications · rolling',        'w_zh' => '滚 动 招 募' ),
        array( 'ix' => 'N° 05', 'h_en' => 'Front-of-House',                   'h_zh' => '门 店 前 厅',               's_en' => 'Daily service, all outlets',                     's_zh' => '日 常 服 务，各 门 店',           'where' => 'Klang Valley',   'w_en' => 'Applications · rolling',        'w_zh' => '滚 动 招 募' ),
      );
      foreach ( $careers as $c ) :
        ?>
        <a class="career" href="#">
          <span class="ix"><?php echo esc_html( $c['ix'] ); ?></span>
          <div>
            <h3><span data-en><?php echo wp_kses_post( $c['h_en'] ); ?></span><span data-zh><?php echo esc_html( $c['h_zh'] ); ?></span></h3>
            <div class="sub"><span data-en><?php echo wp_kses_post( $c['s_en'] ); ?></span><span data-zh><?php echo esc_html( $c['s_zh'] ); ?></span></div>
          </div>
          <div class="where"><?php echo esc_html( $c['where'] ); ?></div>
          <div class="when"><span data-en><?php echo esc_html( $c['w_en'] ); ?></span><span data-zh><?php echo esc_html( $c['w_zh'] ); ?></span></div>
          <div class="arr">→</div>
        </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ============== GENERAL INFO ============== -->
<section class="contact-section">
  <div class="section-head" data-reveal>
    <div>
      <span class="h-eyebrow"><span class="dot"></span>
        <span data-en>IV · GENERAL · INVESTORS · PARTNERS</span>
        <span data-zh>四·一般·投资·合作</span>
      </span>
      <h2>
        <span data-en>Other<br/><em>ways in.</em></span>
        <span data-zh>其他 <em>入口。</em></span>
      </h2>
    </div>
    <p>
      <span data-en>For investor relations, supplier inquiries, community partnerships, and anything that doesn't fit a category above.</span>
      <span data-zh>投资者关系、供应商联络、社区合作，以及不属于上述类别的任何事项。</span>
    </p>
  </div>
  <div class="info-row" data-reveal>
    <div class="info-cell">
      <h4><span data-en>General</span><span data-zh>一 般 联 络</span></h4>
      <a href="mailto:hello@hakshan.com">hello@hakshan.com</a>
      <div class="small"><span data-en>For anything that doesn't fit a category above.</span><span data-zh>不属上述类别的任何事项。</span></div>
    </div>
    <div class="info-cell">
      <h4><span data-en>Investors</span><span data-zh>投 资 者</span></h4>
      <a href="mailto:ir@hakshan.com">ir@hakshan.com</a>
      <div class="small">
        <span data-en><a href="<?php echo esc_url( hakshan_nav_url( 'investors' ) ); ?>">Investor relations page →</a></span>
        <span data-zh><a href="<?php echo esc_url( hakshan_nav_url( 'investors' ) ); ?>">投资者关系页 →</a></span>
      </div>
    </div>
    <div class="info-cell">
      <h4><span data-en>Suppliers</span><span data-zh>供 应 商</span></h4>
      <a href="mailto:procurement@hakshan.com">procurement@hakshan.com</a>
      <div class="small"><span data-en>We source mostly within 80km of every outlet.</span><span data-zh>我们大多在各门店80公里内采购。</span></div>
    </div>
    <div class="info-cell">
      <h4><span data-en>Community partners</span><span data-zh>社 区 合 作</span></h4>
      <a href="mailto:hello@hakshan.com">hello@hakshan.com</a>
      <div class="small"><span data-en>RM 5 from every dish ordered goes to community causes. Partners welcome.</span><span data-zh>每点一道菜，RM 5 投入社区用途。欢迎合作。</span></div>
    </div>
  </div>
</section>

<!-- ============== QUIET CLOSER ============== -->
<section class="quiet-close">
  <div data-reveal>
    <h2>
      <span data-en>Or just<br/><em>walk in.</em></span>
      <span data-zh>或者，<br/><em>径自推门。</em></span>
    </h2>
    <span class="cn">客 来 茶 当 酒</span>
  </div>
</section>

<script>
  // Outlet chip picker
  (function() {
    const chips = document.querySelectorAll("#outletPick .chip");
    chips.forEach(c => c.addEventListener("click", () => {
      chips.forEach(x => x.classList.remove("is-on"));
      c.classList.add("is-on");
    }));
  })();
</script>

<?php
get_footer();
