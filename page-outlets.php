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

  /* Outlets nav uses the shared .menu-toc styles from inner.css —
     sticky top, drag-to-scroll, 13px mono uppercase, bold active. */

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
    text-align: left;
    font: inherit;
    color: inherit;
    text-decoration: none;
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
  .og-card__body { display: grid; gap: 6px; }
  .og-card__head {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    gap: 16px;
  }
  .og-card__head .arr {
    align-self: flex-end;
    align-self: last baseline;
    flex-shrink: 0;
  }
  .og-card h3 {
    font-family: var(--serif);
    font-style: italic;
    font-size: 26px;
    margin: 0;
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
  .og-card .arr {
    font-family: var(--serif);
    font-size: 22px;
    color: var(--forest);
    transition: transform 0.25s ease;
  }
  .og-card:hover .arr { transform: translateX(6px); }

  @media (max-width: 980px) { .outlets-grid { grid-template-columns: 1fr 1fr; } }
  @media (max-width: 700px) { .outlets-grid { grid-template-columns: 1fr; } }
  @media (max-width: 900px) {
    .outlets-hero__inner { grid-template-columns: 1fr; gap: 32px; }
  }
</style>

<section class="outlets-hero">
  <div class="outlets-hero__inner">
    <div>
      <h1>
        <span data-en>Find your<br/><em>nearest.</em></span>
        <span data-zh>离你<br/><em>最近。</em></span>
      </h1>
    </div>
    <p>
      <span data-en>Every outlet runs the same recipe and the same kitchen discipline. Click any room to see the address, hours, and seating.</span>
      <span data-zh>每家分店都用同一本食谱、同一套厨房纪律。点击任意一家可查看地址、营业时间与座位。</span>
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

<!-- 9-card grid overview — cards link to the per-outlet pages -->
<section class="outlets-grid">
  <?php foreach ( $outlets as $o ) :
    $outlet_permalink = isset( $o['id'] ) && $o['id'] ? get_permalink( $o['id'] ) : '';
    ?>
    <a class="og-card" href="<?php echo esc_url( $outlet_permalink ? $outlet_permalink : '#' . $o['slug'] ); ?>" data-reveal>
      <div class="og-card__visual"><?php if ( ! empty( $o['image_html'] ) ) : echo $o['image_html']; else : ?><div class="ph" data-label="<?php echo esc_attr( $o['label'] ); ?>"></div><?php endif; ?></div>
      <div class="og-card__body">
        <div class="og-card__head">
          <h3><?php echo esc_html( $o['name'] ); ?></h3>
          <span class="arr">→</span>
        </div>
        <div class="city"><?php echo esc_html( ucwords( strtolower( $o['city'] ) ) ); ?></div>
      </div>
    </a>
  <?php endforeach; ?>
</section>

<section class="section" style="text-align: center;">
  <span class="h-eyebrow"><span class="dot"></span>
    <span data-en>EXPANSION 2026 — SINGAPORE · PENANG</span>
    <span data-zh>2026拓展 — 新加坡·槟城</span>
  </span>
  <h2 style="font-family: var(--serif); font-style: italic; font-size: clamp(40px, 6vw, 80px); line-height: 0.95; margin: 16px 0 24px; letter-spacing: -0.025em;">
    <span data-en>Outlet <em>10</em> opens next month.</span>
    <span data-zh>第 <em>十</em> 家·下月开业。</span>
  </h2>
  <p style="color: var(--ink-soft); max-width: 50ch; margin: 0 auto 32px;">
    <span data-en>The 10th retail outlet opens locally next month, alongside the 3rd cloud kitchen. Penang (Tanjong Tokong) follows in Q2 2026. Sign up to be invited to the soft launch.</span>
    <span data-zh>第10家门店与第3家云厨房将于下月同步开业。槟城丹绒道光店紧随其后，2026年第二季度开业。订阅即可获得软开邀请。</span>
  </p>
  <a class="btn" href="<?php echo esc_url( hakshan_nav_url( 'contact' ) ); ?>"><span data-en>Join the list</span><span data-zh>加入名单</span><span class="arr">→</span></a>
</section>

<?php
get_footer();
