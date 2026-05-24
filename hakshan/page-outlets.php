<?php
/* Template Name: Outlets */
get_header();

/* Build OUTLETS data from CPT — falls back to static data if CPT is empty */
$outlets_arr = [];
$oc_query = new WP_Query([
    'post_type'      => 'outlet',
    'posts_per_page' => -1,
    'orderby'        => 'menu_order',
    'order'          => 'ASC',
]);
if ($oc_query->have_posts()):
    while ($oc_query->have_posts()): $oc_query->the_post();
        $id   = get_the_ID();
        $slug = get_post_field('post_name');
        $outlets_arr[$slug] = hakshan_outlet_data($id);
    endwhile;
    wp_reset_postdata();
endif;

/* Static fallback */
if (empty($outlets_arr)) {
    $outlets_arr = [
        'usj'       => ['name'=>'USJ Taipan','cn'=>'梳 邦 再 也','city'=>'SUBANG JAYA','addr'=>'Block A, USJ 10 Taipan Business Centre, 47620 Subang Jaya, Selangor','hours'=>'Daily 11:00 — 22:00','seats'=>'120 + private 24 · Charity table','phone'=>'+60 16-246 2970','maps'=>'','photo'=>'','photo_card'=>''],
        'menjalara' => ['name'=>'Menjalara','cn'=>'甲 洞 · 满 家 拉','city'=>'KEPONG','addr'=>'Unit R1-G-3, R1 Gallery, No 10, Jalan Idaman 1/62A, Bandar Menjalara, 52200 KL','hours'=>'Daily 11:00 — 22:00','seats'=>'96 + private 18 · Charity table','phone'=>'+60 3-6266 3211','maps'=>'','photo'=>'','photo_card'=>''],
        'cheras'    => ['name'=>'Cheras Traders Sq.','cn'=>'蕉 赖','city'=>'CHERAS','addr'=>'Lot G-32, Cheras Traders Square, Jalan Cheras 56100, Kuala Lumpur','hours'=>'Daily 11:00 — 22:00','seats'=>'110 · Charity table','phone'=>'+60 3-9101 6622','maps'=>'','photo'=>'','photo_card'=>''],
        'puchong'   => ['name'=>'Bandar Puteri','cn'=>'蒲 种','city'=>'PUCHONG','addr'=>'53G, Jalan Puteri 1/4, Bandar Puteri Puchong, 47100 Selangor','hours'=>'Daily 11:00 — 22:00','seats'=>'88 · Charity table','phone'=>'+60 3-8068 9933','maps'=>'','photo'=>'','photo_card'=>''],
        'conezion'  => ['name'=>'IOI Conezion','cn'=>'布 城','city'=>'PUTRAJAYA','addr'=>'B-G-06, IOI Conezion, Persiaran IRC 3, IOI Resort City, 62502 Putrajaya','hours'=>'Daily 11:00 — 22:00','seats'=>'104 · Charity table','phone'=>'+60 3-8911 2030','maps'=>'','photo'=>'','photo_card'=>''],
        'kajang'    => ['name'=>'Budiman Park','cn'=>'加 影 · 步 帝 文','city'=>'KAJANG','addr'=>'23A, Jalan Budiman, Off Jalan Sungai Long, Budiman Business Park, 43000 Kajang','hours'=>'Daily 11:00 — 22:00','seats'=>'72 · Charity table','phone'=>'+60 3-8732 4567','maps'=>'','photo'=>'','photo_card'=>''],
        'kiara'     => ['name'=>'Arcoris Plaza','cn'=>'满 家 乐','city'=>'MONT KIARA','addr'=>'Unit G-16 & G-17, Ground Level, Arcoris Plaza, 10 Jalan Kiara, 50480 Mont Kiara','hours'=>'Daily 11:00 — 22:00','seats'=>'132 + private 28 · Charity table','phone'=>'+60 3-6203 9988','maps'=>'','photo'=>'','photo_card'=>''],
        'parkcity'  => ['name'=>'The Waterfront','cn'=>'公 园 城','city'=>'DESA PARKCITY','addr'=>'Lot GF-05, The Waterfront @ ParkCity, Persiaran Residen, 52200 Desa ParkCity','hours'=>'Daily 11:00 — 22:00','seats'=>'92 · Charity table','phone'=>'+60 3-6280 1100','maps'=>'','photo'=>'','photo_card'=>''],
        'arkadia'   => ['name'=>'Plaza Arkadia','cn'=>'阿 卡 迪 亚','city'=>'DESA PARKCITY','addr'=>'Unit F-G-7, Plaza Arkadia, 3 Jalan Intisari Perdana, 52200 Desa ParkCity','hours'=>'Daily 11:00 — 22:00','seats'=>'78 · Charity table','phone'=>'+60 3-6263 8800','maps'=>'','photo'=>'','photo_card'=>''],
    ];
}
?>
<style>
  .outlets-hero { padding: clamp(80px,12vw,140px) var(--rail) 60px; }
  .outlets-hero__inner { max-width: var(--maxw); margin: 0 auto; display: grid; grid-template-columns: 1.2fr 1fr; gap: 80px; align-items: end; }
  .outlets-hero h1 { font-family: var(--serif); font-style: italic; font-size: clamp(64px,10vw,168px); line-height: .9; margin: 16px 0 0; letter-spacing: -.03em; }
  .outlets-hero h1 em { color: var(--forest); }
  .outlets-hero p { font-size: 17px; line-height: 1.7; color: var(--ink-soft); max-width: 50ch; margin: 0; }
  .map-band { background: var(--cream); padding: 24px var(--rail); border-top: 1px solid var(--line); border-bottom: 1px solid var(--line); font-family: var(--mono); font-size: 11px; letter-spacing: .14em; text-transform: uppercase; color: var(--forest); display: flex; gap: 32px; overflow-x: auto; max-width: 100%; scrollbar-width: none; }
  .map-band::-webkit-scrollbar { display: none; }
  .map-band a { white-space: nowrap; opacity: .7; cursor: pointer; }
  .map-band a:hover { opacity: 1; }
  .outlets-grid { max-width: var(--maxw); margin: 60px auto; padding: 0 var(--rail); display: grid; grid-template-columns: repeat(3,1fr); gap: 24px; }
  .og-card { background: var(--paper); border: 1px solid var(--line); padding: 24px; display: grid; gap: 18px; transition: background .3s ease, transform .3s ease; cursor: pointer; text-align: left; font: inherit; color: inherit; width: 100%; }
  .og-card:hover { background: var(--cream); transform: translateY(-4px); }
  .og-card__visual { aspect-ratio: 4/3; position: relative; overflow: hidden; margin: -24px -24px 0; }
  .og-card__visual .ph { position: absolute; inset: 0; }
  .og-card__visual img { position: absolute; inset: 0; width: 100%; height: 100%; object-fit: cover; }
  .og-card h3 { font-family: var(--serif); font-style: italic; font-size: 26px; margin: 0 0 4px; letter-spacing: -.01em; }
  .og-card .city { font-family: var(--mono); font-size: 10px; letter-spacing: .18em; text-transform: uppercase; color: var(--forest); opacity: .75; }
  .og-card .meta { margin-top: auto; padding-top: 14px; border-top: 1px solid var(--line); display: flex; justify-content: space-between; align-items: baseline; font-family: var(--mono); font-size: 11px; color: var(--ink-soft); }
  .og-card .meta .arr { font-family: var(--serif); font-size: 22px; color: var(--forest); transition: transform .25s ease; }
  .og-card:hover .meta .arr { transform: translateX(6px); }
  /* Modal */
  .om-backdrop { position: fixed; inset: 0; background: rgba(42,46,39,.55); backdrop-filter: blur(6px); -webkit-backdrop-filter: blur(6px); z-index: 100; display: grid; place-items: center; padding: 32px; opacity: 0; pointer-events: none; transition: opacity .35s ease; }
  .om-backdrop.is-open { opacity: 1; pointer-events: auto; }
  .om-dialog { background: var(--paper); width: min(1080px,100%); max-height: 90vh; overflow-y: auto; position: relative; box-shadow: 0 40px 100px -40px rgba(42,46,39,.6); display: grid; grid-template-columns: 1.1fr 1fr; transform: translateY(20px) scale(.98); transition: transform .4s cubic-bezier(.2,.7,.2,1); }
  .om-backdrop.is-open .om-dialog { transform: translateY(0) scale(1); }
  .om-dialog__visual { position: relative; min-height: 360px; }
  .om-dialog__visual .ph { position: absolute; inset: 0; }
  .om-dialog__visual img { position: absolute; inset: 0; width: 100%; height: 100%; object-fit: cover; }
  .om-dialog__body { padding: 56px 48px 48px; display: grid; align-content: start; gap: 16px; }
  .om-dialog__city { font-family: var(--mono); font-size: 11px; letter-spacing: .18em; text-transform: uppercase; color: var(--forest); }
  .om-dialog h2 { font-family: var(--serif); font-style: italic; font-size: clamp(40px,5vw,64px); line-height: 1; margin: 0; letter-spacing: -.02em; }
  .om-dialog h2 .cn { font-family: var(--cn); font-style: normal; font-size: .32em; color: var(--forest); letter-spacing: .28em; display: block; margin-top: 10px; }
  .om-dialog__meta { margin-top: 8px; padding-top: 24px; border-top: 1px solid var(--line); display: grid; grid-template-columns: 1fr 1fr; gap: 24px; }
  .om-dialog__meta dt { font-family: var(--mono); font-size: 10px; letter-spacing: .16em; text-transform: uppercase; color: var(--forest); margin-bottom: 6px; opacity: .85; }
  .om-dialog__meta dd { margin: 0; font-size: 14px; line-height: 1.5; color: var(--ink); }
  .om-dialog__buttons { margin-top: 16px; display: flex; gap: 12px; flex-wrap: wrap; }
  .om-close { position: absolute; top: 16px; right: 16px; width: 40px; height: 40px; border-radius: 50%; background: var(--paper); border: 1px solid var(--line); cursor: pointer; font-family: var(--serif); font-style: italic; font-size: 22px; color: var(--forest); display: grid; place-items: center; z-index: 4; transition: background .2s, color .2s; }
  .om-close:hover { background: var(--forest); color: var(--cream); border-color: var(--forest); }
  @media (max-width: 980px) { .outlets-grid { grid-template-columns: 1fr 1fr; } }
  @media (max-width: 700px) {
    .outlets-grid { grid-template-columns: 1fr; }
    .om-dialog { display: flex; flex-direction: column; grid-template-columns: unset; max-height: 92vh; }
    .om-dialog__visual { flex: 0 0 auto; aspect-ratio: 16/10; min-height: 0; width: 100%; }
    .om-dialog__body { flex: 1 1 auto; padding: 28px 22px 24px; }
    .om-dialog__meta { grid-template-columns: 1fr; gap: 16px; }
  }
  @media (max-width: 900px) { .outlets-hero__inner { grid-template-columns: 1fr; gap: 32px; } }
</style>

<main>

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
      <span data-en>Every outlet runs the same recipe book, the same charity table, and the same kitchen master from KL. Click any room to see the address, hours, and seating.</span>
      <span data-zh>每家分店都用同一本食谱、设同一张慈善桌、由 KL 来的同一位主厨监督。点击任意一家可查看地址、营业时间与座位。</span>
    </p>
  </div>
</section>

<nav class="map-band">
  <?php foreach ($outlets_arr as $slug => $o): ?>
    <a data-open="<?php echo esc_attr($slug); ?>"><?php echo esc_html($o['name']); ?></a>
  <?php endforeach; ?>
</nav>

<section class="outlets-grid">
  <?php foreach ($outlets_arr as $slug => $o): ?>
    <button class="og-card" data-open="<?php echo esc_attr($slug); ?>" data-reveal>
      <div class="og-card__visual">
        <?php if (!empty($o['photo_card'])): ?>
          <img src="<?php echo esc_url($o['photo_card']); ?>" alt="<?php echo esc_attr($o['name']); ?>" loading="lazy" />
        <?php else: ?>
          <div class="ph" data-label="<?php echo esc_attr($o['name'] . ' · ' . strtolower($o['city'])); ?>"></div>
        <?php endif; ?>
      </div>
      <div>
        <h3><?php echo esc_html($o['name']); ?></h3>
        <div class="city"><?php echo esc_html(ucwords(strtolower($o['city']))); ?></div>
      </div>
      <div class="meta"><span></span><span class="arr">→</span></div>
    </button>
  <?php endforeach; ?>
</section>

<section class="section" style="text-align:center;">
  <span class="h-eyebrow"><span class="dot"></span>
    <span data-en>EXPANSION 2026 — SINGAPORE · PENANG</span>
    <span data-zh>2026 拓 展 — 新 加 坡 · 槟 城</span>
  </span>
  <h2 style="font-family:var(--serif);font-style:italic;font-size:clamp(40px,6vw,80px);line-height:.95;margin:16px 0 24px;letter-spacing:-.025em;">
    <span data-en>Outlet <em>10</em> opens in spring.</span>
    <span data-zh>第 <em>十</em> 家 春 季 开 业。</span>
  </h2>
  <p style="color:var(--ink-soft);max-width:50ch;margin:0 auto 32px;">
    <span data-en>Penang, Tanjong Tokong — opening April 2026. Sign up to be invited to the soft launch.</span>
    <span data-zh>槟城丹绒道光 — 2026 年 4 月开业。订阅即可获得软开邀请。</span>
  </p>
  <a class="btn" href="<?php echo esc_url(home_url('/contact/')); ?>">
    <span data-en>Join the list</span><span data-zh>加入名单</span><span class="arr">→</span>
  </a>
</section>

<!-- Modal -->
<div class="om-backdrop" id="omBackdrop" aria-hidden="true">
  <div class="om-dialog" role="dialog" aria-modal="true" aria-labelledby="omTitle">
    <button class="om-close" id="omClose" aria-label="Close">×</button>
    <div class="om-dialog__visual">
      <div class="ph" id="omPh" data-label=""></div>
    </div>
    <div class="om-dialog__body">
      <span class="om-dialog__city" id="omCity"></span>
      <h2 id="omTitle">—<span class="cn" id="omCn"></span></h2>
      <dl class="om-dialog__meta">
        <div><dt><span data-en>Address</span><span data-zh>地址</span></dt><dd id="omAddr"></dd></div>
        <div><dt><span data-en>Hours</span><span data-zh>营业</span></dt><dd id="omHours"></dd></div>
        <div><dt><span data-en>Seats</span><span data-zh>座位</span></dt><dd id="omSeats"></dd></div>
        <div><dt><span data-en>Phone</span><span data-zh>电话</span></dt><dd id="omPhone"></dd></div>
      </dl>
      <div class="om-dialog__buttons">
        <a class="btn" id="omReserve" href="<?php echo esc_url(home_url('/contact/#reserve')); ?>">
          <span data-en>Reserve</span><span data-zh>预订</span><span class="arr">→</span>
        </a>
        <a class="btn btn--ghost" id="omDir" href="#" target="_blank" rel="noopener">
          <span data-en>Directions</span><span data-zh>路线</span><span class="arr">→</span>
        </a>
      </div>
    </div>
  </div>
</div>

</main>

<script>
/* PHP-rendered outlet data for the JS modal */
var OUTLETS = <?php echo wp_json_encode($outlets_arr); ?>;
</script>
<?php get_footer(); ?>
