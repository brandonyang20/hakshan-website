<?php
/**
 * Template Name: Outlets
 * Template Post Type: page
 *
 * @package Hakshan
 */

get_header();
?>
<style>
  /* Map header */
  .outlets-hero { padding: clamp(80px, 12vw, 140px) var(--rail) 60px; }
  .outlets-hero__inner {
    max-width: var(--maxw);
    margin: 0 auto;
    display: grid;
    grid-template-columns: 1.2fr 1fr;
    gap: 80px;
    align-items: end;
  }
  .outlets-hero h1 {
    font-family: var(--serif);
    font-style: italic;
    font-size: clamp(64px, 10vw, 168px);
    line-height: 0.9;
    margin: 16px 0 0;
    letter-spacing: -0.03em;
  }
  .outlets-hero h1 em { color: var(--forest); }
  .outlets-hero p { font-size: 17px; line-height: 1.7; color: var(--ink-soft); max-width: 50ch; margin: 0; }

  .map-band {
    background: var(--cream);
    padding: 24px var(--rail);
    border-top: 1px solid var(--line);
    border-bottom: 1px solid var(--line);
    font-family: var(--mono);
    font-size: 11px;
    letter-spacing: 0.14em;
    text-transform: uppercase;
    color: var(--forest);
    display: flex;
    gap: 32px;
    overflow-x: auto;
    max-width: var(--maxw);
    margin: 0 auto;
    scrollbar-width: none;
  }
  .map-band::-webkit-scrollbar { display: none; }
  .map-band a { white-space: nowrap; opacity: 0.7; cursor: pointer; }
  .map-band a:hover { opacity: 1; }

  /* 9-card grid */
  .outlets-grid {
    max-width: var(--maxw);
    margin: 60px auto;
    padding: 0 var(--rail);
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 24px;
  }
  .og-card {
    background: var(--paper);
    border: 1px solid var(--line);
    padding: 24px;
    display: grid;
    gap: 18px;
    transition: background 0.3s ease, transform 0.3s ease;
    cursor: pointer;
    text-align: left;
    font: inherit;
    color: inherit;
    width: 100%;
  }
  .og-card:hover { background: var(--cream); transform: translateY(-4px); }
  .og-card__visual {
    aspect-ratio: 4/3;
    position: relative;
    margin: -24px -24px 0;
  }
  .og-card__visual .ph { position: absolute; inset: 0; }
  .og-card__visual .num {
    position: absolute;
    top: 14px; left: 14px;
    background: rgba(249, 247, 242, 0.92);
    backdrop-filter: blur(4px);
    padding: 4px 10px;
    border-radius: 999px;
    font-family: var(--mono);
    font-size: 10px;
    letter-spacing: 0.16em;
    color: var(--forest);
    z-index: 2;
  }
  .og-card__visual .badge {
    position: absolute;
    top: 14px; right: 14px;
    background: var(--forest);
    color: var(--cream);
    padding: 4px 10px;
    border-radius: 999px;
    font-family: var(--mono);
    font-size: 9px;
    letter-spacing: 0.18em;
    text-transform: uppercase;
    z-index: 2;
  }
  .og-card h3 {
    font-family: var(--serif);
    font-style: italic;
    font-size: 26px;
    margin: 0 0 4px;
    letter-spacing: -0.01em;
  }
  .og-card .city {
    font-family: var(--mono);
    font-size: 10px;
    letter-spacing: 0.18em;
    text-transform: uppercase;
    color: var(--forest);
    opacity: 0.75;
  }
  .og-card .meta {
    margin-top: auto;
    padding-top: 14px;
    border-top: 1px solid var(--line);
    display: flex;
    justify-content: space-between;
    align-items: baseline;
    font-family: var(--mono);
    font-size: 11px;
    letter-spacing: 0.08em;
    color: var(--ink-soft);
  }
  .og-card .meta .arr {
    font-family: var(--serif);
    font-size: 22px;
    color: var(--forest);
    transition: transform 0.25s ease;
  }
  .og-card:hover .meta .arr { transform: translateX(6px); }

  /* ====== MODAL ====== */
  .om-backdrop {
    position: fixed;
    inset: 0;
    background: rgba(42, 46, 39, 0.55);
    backdrop-filter: blur(6px);
    -webkit-backdrop-filter: blur(6px);
    z-index: 100;
    display: grid;
    place-items: center;
    padding: 32px;
    opacity: 0;
    pointer-events: none;
    transition: opacity 0.35s ease;
  }
  .om-backdrop.is-open {
    opacity: 1;
    pointer-events: auto;
  }
  .om-dialog {
    background: var(--paper);
    width: min(1080px, 100%);
    max-height: 90vh;
    overflow-y: auto;
    position: relative;
    box-shadow: 0 40px 100px -40px rgba(42, 46, 39, 0.6);
    display: grid;
    grid-template-columns: 1.1fr 1fr;
    transform: translateY(20px) scale(0.98);
    transition: transform 0.4s cubic-bezier(.2,.7,.2,1);
  }
  .om-backdrop.is-open .om-dialog { transform: translateY(0) scale(1); }
  .om-dialog__visual {
    position: relative;
    min-height: 360px;
  }
  .om-dialog__visual .ph { position: absolute; inset: 0; }
  .om-dialog__visual .num {
    position: absolute;
    top: 24px; left: 24px;
    background: rgba(249, 247, 242, 0.92);
    backdrop-filter: blur(4px);
    padding: 6px 12px;
    border-radius: 999px;
    font-family: var(--mono);
    font-size: 11px;
    letter-spacing: 0.18em;
    color: var(--forest);
    z-index: 2;
  }
  .om-dialog__visual .badge {
    position: absolute;
    top: 24px; right: 24px;
    background: var(--forest);
    color: var(--cream);
    padding: 6px 12px;
    border-radius: 999px;
    font-family: var(--mono);
    font-size: 10px;
    letter-spacing: 0.18em;
    text-transform: uppercase;
    z-index: 2;
  }
  .om-dialog__visual .badge:empty { display: none; }

  .om-dialog__body {
    padding: 56px 48px 48px;
    display: grid;
    align-content: start;
    gap: 16px;
  }
  .om-dialog__city {
    font-family: var(--mono);
    font-size: 11px;
    letter-spacing: 0.18em;
    text-transform: uppercase;
    color: var(--forest);
  }
  .om-dialog h2 {
    font-family: var(--serif);
    font-style: italic;
    font-size: clamp(40px, 5vw, 64px);
    line-height: 1;
    margin: 0;
    letter-spacing: -0.02em;
  }
  .om-dialog h2 .cn {
    font-family: var(--cn);
    font-style: normal;
    font-size: 0.32em;
    color: var(--forest);
    letter-spacing: 0.28em;
    display: block;
    margin-top: 10px;
  }
  .om-dialog__meta {
    margin-top: 8px;
    padding-top: 24px;
    border-top: 1px solid var(--line);
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 24px;
  }
  .om-dialog__meta dt {
    font-family: var(--mono);
    font-size: 10px;
    letter-spacing: 0.16em;
    text-transform: uppercase;
    color: var(--forest);
    margin-bottom: 6px;
    opacity: 0.85;
  }
  .om-dialog__meta dd {
    margin: 0;
    font-size: 14px;
    line-height: 1.5;
    color: var(--ink);
  }
  .om-dialog__buttons {
    margin-top: 16px;
    display: flex;
    gap: 12px;
    flex-wrap: wrap;
  }
  .om-close {
    position: absolute;
    top: 16px; right: 16px;
    width: 40px; height: 40px;
    border-radius: 50%;
    background: var(--paper);
    border: 1px solid var(--line);
    cursor: pointer;
    font-family: var(--serif);
    font-style: italic;
    font-size: 22px;
    color: var(--forest);
    display: grid;
    place-items: center;
    z-index: 4;
    transition: background 0.2s, color 0.2s;
  }
  .om-close:hover { background: var(--forest); color: var(--cream); border-color: var(--forest); }

  @media (max-width: 980px) { .outlets-grid { grid-template-columns: 1fr 1fr; } }
  @media (max-width: 700px) {
    .outlets-grid { grid-template-columns: 1fr; }
    .om-dialog {
      display: flex;
      flex-direction: column;
      grid-template-columns: unset;
      max-height: 92vh;
    }
    .om-dialog__visual {
      flex: 0 0 auto;
      aspect-ratio: 16/10;
      min-height: 0;
      width: 100%;
    }
    .om-dialog__body {
      flex: 1 1 auto;
      padding: 28px 22px 24px;
    }
    .om-dialog__meta { grid-template-columns: 1fr; gap: 16px; }
  }
  @media (max-width: 900px) {
    .outlets-hero__inner { grid-template-columns: 1fr; gap: 32px; }
  }
</style>

<section class="outlets-hero">
  <div class="outlets-hero__inner">
    <div>
      <span class="h-eyebrow"><span class="dot"></span>
        <span data-en>NINE OUTLETS · KLANG VALLEY</span><span data-zh>九 家 门 店 · 巴 生 谷</span>
      </span>
      <h1>
        <span data-en>Find your<br/><em>nearest.</em></span>
        <span data-zh>就 近<br/><em>而 来。</em></span>
      </h1>
    </div>
    <p>
      <span data-en>Every outlet runs the same recipe and the same kitchen discipline — the central kitchen prepares, every outlet plates. Click any room to see the address, hours, and seating.</span>
      <span data-zh>每家分店都用同一本食谱、同一套厨房纪律 — 中央厨房统一预备，各分店现场出菜。点击任意一家可查看地址、营业时间与座位。</span>
    </p>
  </div>
</section>

<?php
// Pull outlets from the CPT; fall back to a hardcoded list if nothing is in the DB yet.
$outlets        = array();
$outlet_posts   = function_exists( 'hakshan_get_outlets' ) ? hakshan_get_outlets() : array();
$outlet_has_img = array();

if ( ! empty( $outlet_posts ) ) {
	foreach ( $outlet_posts as $outlet_post ) {
		$data       = hakshan_get_outlet_data( $outlet_post->ID );
		$outlets[]  = $data;
		$outlet_has_img[ $data['slug'] ] = ! empty( $data['image_html'] );
	}
} else {
	$outlets = array(
		array( 'slug' => 'usj',       'name' => 'USJ Taipan',         'cn' => '梳 邦 再 也',         'city' => 'SUBANG JAYA',  'label' => 'USJ Taipan · main dining hall, evening',
		       'addr' => 'Block A, USJ 10 Taipan Business Centre, 47620 Subang Jaya, Selangor',
		       'hours'=> 'Daily 11:00 — 22:00', 'seats' => '120 + private 24', 'phone' => '+60 16-246 2970', 'image_html' => '', 'image_url' => '' ),
		array( 'slug' => 'menjalara', 'name' => 'Menjalara',          'cn' => '甲 洞 · 满 家 拉',      'city' => 'KEPONG',       'label' => 'Menjalara · entrance and brass signage',
		       'addr' => 'Unit R1-G-3, R1 Gallery, No 10, Jalan Idaman 1/62A, Bandar Menjalara, 52200 KL',
		       'hours'=> 'Daily 11:00 — 22:00', 'seats' => '96 + private 18',  'phone' => '+60 3-6266 3211', 'image_html' => '', 'image_url' => '' ),
		array( 'slug' => 'cheras',    'name' => 'Cheras Traders Sq.', 'cn' => '蕉 赖',               'city' => 'CHERAS',       'label' => 'Cheras Traders Square · open kitchen',
		       'addr' => 'Lot G-32, Cheras Traders Square, Jalan Cheras 56100, Kuala Lumpur',
		       'hours'=> 'Daily 11:00 — 22:00', 'seats' => '110',              'phone' => '+60 3-9101 6622', 'image_html' => '', 'image_url' => '' ),
		array( 'slug' => 'puchong',   'name' => 'Bandar Puteri',      'cn' => '蒲 种',               'city' => 'PUCHONG',      'label' => 'Bandar Puteri Puchong · dining hall',
		       'addr' => '53G, Jalan Puteri 1/4, Bandar Puteri Puchong, 47100 Selangor',
		       'hours'=> 'Daily 11:00 — 22:00', 'seats' => '88',               'phone' => '+60 3-8068 9933', 'image_html' => '', 'image_url' => '' ),
		array( 'slug' => 'conezion',  'name' => 'IOI Conezion',       'cn' => '布 城',               'city' => 'PUTRAJAYA',    'label' => 'IOI Conezion · terrace, evening',
		       'addr' => 'B-G-06, IOI Conezion, Persiaran IRC 3, IOI Resort City, 62502 Putrajaya',
		       'hours'=> 'Daily 11:00 — 22:00', 'seats' => '104',              'phone' => '+60 3-8911 2030', 'image_html' => '', 'image_url' => '' ),
		array( 'slug' => 'kajang',    'name' => 'Budiman Park',       'cn' => '加 影 · 步 帝 文',     'city' => 'KAJANG',       'label' => 'Budiman Park · entrance',
		       'addr' => '23A, Jalan Budiman, Off Jalan Sungai Long, Budiman Business Park, 43000 Kajang',
		       'hours'=> 'Daily 11:00 — 22:00', 'seats' => '72',               'phone' => '+60 3-8732 4567', 'image_html' => '', 'image_url' => '' ),
		array( 'slug' => 'kiara',     'name' => 'Arcoris Plaza',      'cn' => '满 家 乐',             'city' => 'MONT KIARA',   'label' => 'Arcoris Mont Kiara · main hall',
		       'addr' => 'Unit G-16 & G-17, Ground Level, Arcoris Plaza, 10 Jalan Kiara, 50480 Mont Kiara',
		       'hours'=> 'Daily 11:00 — 22:00', 'seats' => '132 + private 28', 'phone' => '+60 3-6203 9988', 'image_html' => '', 'image_url' => '' ),
		array( 'slug' => 'parkcity',  'name' => 'The Waterfront',     'cn' => '公 园 城',             'city' => 'DESA PARKCITY','label' => 'The Waterfront ParkCity · evening',
		       'addr' => 'Lot GF-05, The Waterfront @ ParkCity, Persiaran Residen, 52200 Desa ParkCity',
		       'hours'=> 'Daily 11:00 — 22:00', 'seats' => '92',               'phone' => '+60 3-6280 1100', 'image_html' => '', 'image_url' => '' ),
		array( 'slug' => 'arkadia',   'name' => 'Plaza Arkadia',      'cn' => '阿 卡 迪 亚',          'city' => 'DESA PARKCITY','label' => 'Plaza Arkadia · open kitchen',
		       'addr' => 'Unit F-G-7, Plaza Arkadia, 3 Jalan Intisari Perdana, 52200 Desa ParkCity',
		       'hours'=> 'Daily 11:00 — 22:00', 'seats' => '78',               'phone' => '+60 3-6263 8800', 'image_html' => '', 'image_url' => '' ),
	);
}
?>

<nav class="map-band">
  <?php foreach ( $outlets as $o ) : ?>
    <a data-open="<?php echo esc_attr( $o['slug'] ); ?>"><?php echo esc_html( $o['name'] ); ?></a>
  <?php endforeach; ?>
</nav>

<!-- 9-card grid overview -->
<section class="outlets-grid">
  <?php foreach ( $outlets as $o ) : ?>
    <button class="og-card" data-open="<?php echo esc_attr( $o['slug'] ); ?>" data-reveal>
      <div class="og-card__visual"><?php if ( ! empty( $o['image_html'] ) ) : echo $o['image_html']; else : ?><div class="ph" data-label="<?php echo esc_attr( $o['label'] ); ?>"></div><?php endif; ?></div>
      <div><h3><?php echo esc_html( $o['name'] ); ?></h3><div class="city"><?php echo esc_html( ucwords( strtolower( $o['city'] ) ) ); ?></div></div>
      <div class="meta"><span></span><span class="arr">→</span></div>
    </button>
  <?php endforeach; ?>
</section>

<section class="section" style="text-align: center;">
  <span class="h-eyebrow"><span class="dot"></span>
    <span data-en>EXPANSION 2026 — SINGAPORE · PENANG</span>
    <span data-zh>2026 拓 展 — 新 加 坡 · 槟 城</span>
  </span>
  <h2 style="font-family: var(--serif); font-style: italic; font-size: clamp(40px, 6vw, 80px); line-height: 0.95; margin: 16px 0 24px; letter-spacing: -0.025em;">
    <span data-en>Outlet <em>10</em> opens next month.</span>
    <span data-zh>第 <em>十</em> 家 · 下 月 开 业。</span>
  </h2>
  <p style="color: var(--ink-soft); max-width: 50ch; margin: 0 auto 32px;">
    <span data-en>The 10th retail outlet opens locally next month, alongside the 3rd cloud kitchen. Penang (Tanjong Tokong) follows in Q2 2026. Sign up to be invited to the soft launch.</span>
    <span data-zh>第 10 家 门 店 与 第 3 家 云 厨 房 将 于 下 月 同 步 开 业。槟 城 丹 绒 道 光 店 紧 随 其 后，2026 年 第 二 季 度 开 业。订 阅 即 可 获 得 软 开 邀 请。</span>
  </p>
  <a class="btn" href="<?php echo esc_url( hakshan_nav_url( 'contact' ) ); ?>"><span data-en>Join the list</span><span data-zh>加入名单</span><span class="arr">→</span></a>
</section>

<!-- ============== MODAL ============== -->
<div class="om-backdrop" id="omBackdrop" aria-hidden="true">
  <div class="om-dialog" role="dialog" aria-modal="true" aria-labelledby="omTitle">
    <button class="om-close" id="omClose" aria-label="Close">×</button>
    <div class="om-dialog__visual">
      <span class="badge" id="omBadge"></span>
      <div class="ph" id="omPh" data-label=""></div>
    </div>
    <div class="om-dialog__body">
      <span class="om-dialog__city" id="omCity">SUBANG JAYA</span>
      <h2 id="omTitle">USJ Taipan<span class="cn" id="omCn">梳 邦 再 也</span></h2>
      <dl class="om-dialog__meta">
        <div><dt><span data-en>Address</span><span data-zh>地址</span></dt><dd id="omAddr"></dd></div>
        <div><dt><span data-en>Hours</span><span data-zh>营业</span></dt><dd id="omHours"></dd></div>
        <div><dt><span data-en>Seats</span><span data-zh>座位</span></dt><dd id="omSeats"></dd></div>
        <div><dt><span data-en>Phone</span><span data-zh>电话</span></dt><dd id="omPhone"></dd></div>
      </dl>
      <div class="om-dialog__buttons">
        <a class="btn" id="omReserve" href="<?php echo esc_url( hakshan_nav_url( 'contact' ) . '#reserve' ); ?>"><span data-en>Reserve</span><span data-zh>预订</span><span class="arr">→</span></a>
        <a class="btn btn--ghost" id="omDir" href="#" target="_blank" rel="noopener"><span data-en>Directions</span><span data-zh>路线</span><span class="arr">→</span></a>
      </div>
    </div>
  </div>
</div>

<script>
  // Outlet data (PHP → JSON)
  const OUTLETS = <?php
    $js_outlets = array();
    foreach ( $outlets as $o ) {
      $js_outlets[ $o['slug'] ] = array(
        'num'      => str_pad( (string) ( array_search( $o['slug'], array_column( $outlets, 'slug' ), true ) + 1 ), 2, '0', STR_PAD_LEFT ),
        'badge'    => '',
        'badgeZh'  => '',
        'name'     => $o['name'],
        'cn'       => $o['cn'],
        'city'     => $o['city'],
        'addr'     => $o['addr'],
        'hours'    => $o['hours'],
        'seats'    => $o['seats'],
        'phone'    => $o['phone'],
        'photo'    => $o['label'],
        'imageUrl' => ! empty( $o['image_url'] ) ? $o['image_url'] : '',
      );
    }
    echo wp_json_encode( $js_outlets );
  ?>;

  // Modal logic
  const backdrop = document.getElementById("omBackdrop");
  const dlg = backdrop.querySelector(".om-dialog");

  function openOutlet(key) {
    const o = OUTLETS[key];
    if (!o) return;
    const badgeEl = document.getElementById("omBadge");
    if (o.badge) {
      const lang = document.body.getAttribute("data-lang") || "en";
      badgeEl.textContent = lang === "zh" ? o.badgeZh : o.badge;
      badgeEl.style.display = "";
    } else {
      badgeEl.style.display = "none";
    }
    const omPh = document.getElementById("omPh");
    if (o.imageUrl) {
      omPh.style.backgroundImage = "url('" + o.imageUrl + "')";
      omPh.style.backgroundSize = "cover";
      omPh.style.backgroundPosition = "center";
      omPh.setAttribute("data-label", "");
    } else {
      omPh.style.backgroundImage = "";
      omPh.setAttribute("data-label", o.photo);
    }
    document.getElementById("omCity").textContent = o.city;
    const title = document.getElementById("omTitle");
    title.innerHTML = o.name + '<span class="cn">' + o.cn + '</span>';
    document.getElementById("omAddr").textContent = o.addr;
    document.getElementById("omHours").textContent = o.hours;
    document.getElementById("omSeats").textContent = o.seats;
    document.getElementById("omPhone").textContent = o.phone;
    document.getElementById("omDir").setAttribute(
      "href",
      "https://www.google.com/maps/search/?api=1&query=" + encodeURIComponent("Hakshan " + o.name + " " + o.addr)
    );
    backdrop.classList.add("is-open");
    backdrop.setAttribute("aria-hidden", "false");
    document.body.style.overflow = "hidden";
    history.replaceState(null, "", "#" + key);
  }
  function closeModal() {
    backdrop.classList.remove("is-open");
    backdrop.setAttribute("aria-hidden", "true");
    document.body.style.overflow = "";
    if (location.hash) history.replaceState(null, "", location.pathname);
  }

  document.querySelectorAll("[data-open]").forEach(el => {
    el.addEventListener("click", (e) => {
      e.preventDefault();
      openOutlet(el.getAttribute("data-open"));
    });
  });
  document.getElementById("omClose").addEventListener("click", closeModal);
  backdrop.addEventListener("click", (e) => { if (e.target === backdrop) closeModal(); });
  document.addEventListener("keydown", (e) => { if (e.key === "Escape" && backdrop.classList.contains("is-open")) closeModal(); });

  if (location.hash) {
    const key = location.hash.slice(1);
    if (OUTLETS[key]) setTimeout(() => openOutlet(key), 100);
  }
</script>

<?php
get_footer();
