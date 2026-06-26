<?php
/**
 * Single outlet template — one URL per location.
 *
 * Renders /outlets/{slug}/ for each Outlet CPT entry. Address, hours,
 * phone, seating + a Google Maps embed and reservation CTAs. Restaurant
 * JSON-LD for this outlet is emitted by inc/seo.php.
 *
 * @package Hakshan
 */

get_header();

if ( ! have_posts() ) {
	get_footer();
	return;
}
the_post();

$outlet_id = get_the_ID();
$o         = hakshan_get_outlet_data( $outlet_id );
$city_pretty = $o['city'] ? ucwords( strtolower( $o['city'] ) ) : '';
$maps_url  = $o['addr']
	? 'https://www.google.com/maps/search/?api=1&query=' . rawurlencode( 'Hakshan ' . $o['name'] . ' ' . $o['addr'] )
	: '';
$maps_embed = $o['addr']
	? 'https://maps.google.com/maps?q=' . rawurlencode( 'Hakshan ' . $o['name'] . ' ' . $o['addr'] ) . '&output=embed'
	: '';
?>

<style>
  .so-hero {
    padding: clamp(60px, 9vw, 110px) var(--rail) 40px;
    max-width: var(--maxw);
    margin: 0 auto;
  }
  .so-hero__crumb {
    font-family: var(--mono);
    font-size: 12px;
    letter-spacing: 0.2em;
    text-transform: uppercase;
    color: var(--forest);
    margin-bottom: 16px;
    display: inline-flex;
    gap: 10px;
    align-items: center;
  }
  .so-hero__crumb a { color: var(--forest); text-decoration: none; }
  .so-hero__crumb a:hover { text-decoration: underline; }
  .so-hero__city {
    font-family: var(--mono);
    font-size: 12px;
    letter-spacing: 0.22em;
    text-transform: uppercase;
    color: var(--forest);
  }
  .so-hero h1 {
    font-family: var(--serif);
    font-style: italic;
    font-size: clamp(56px, 9vw, 144px);
    line-height: 0.92;
    margin: 14px 0 24px;
    letter-spacing: -0.025em;
  }
  .so-hero h1 .cn {
    display: block;
    margin-top: 16px;
    font-family: var(--cn);
    font-style: normal;
    font-size: 0.26em;
    color: var(--forest);
    letter-spacing: 0.28em;
  }
  .so-hero__sub {
    font-family: var(--mono);
    font-size: 13px;
    letter-spacing: 0.18em;
    text-transform: uppercase;
    color: var(--forest);
    margin: 0 0 24px;
  }
  .so-hero p.lead {
    font-size: 18px;
    line-height: 1.65;
    color: var(--ink-soft);
    max-width: 60ch;
    margin: 0;
  }

  .so-grid {
    max-width: var(--maxw);
    margin: 40px auto 80px;
    padding: 0 var(--rail);
    display: grid;
    grid-template-columns: 1.1fr 1fr;
    gap: 60px;
    align-items: start;
  }

  .so-meta { display: grid; gap: 28px; }
  .so-meta__row {
    display: grid;
    grid-template-columns: 110px 1fr;
    gap: 24px;
    padding-bottom: 22px;
    border-bottom: 1px solid var(--line);
  }
  .so-meta__row:last-of-type { border-bottom: 0; }
  .so-meta dt {
    font-family: var(--mono);
    font-size: 12px;
    letter-spacing: 0.18em;
    text-transform: uppercase;
    color: var(--forest);
    margin: 0;
    padding-top: 2px;
  }
  .so-meta dd {
    margin: 0;
    font-size: 16px;
    line-height: 1.55;
    color: var(--ink);
  }
  .so-meta dd a { color: var(--ink); }

  .so-map {
    position: relative;
    aspect-ratio: 4/3;
    background: var(--cream);
    border: 1px solid var(--line);
    overflow: hidden;
  }
  .so-map iframe {
    position: absolute;
    inset: 0;
    width: 100%;
    height: 100%;
    border: 0;
  }
  .so-map__placeholder {
    position: absolute;
    inset: 0;
    display: grid;
    place-items: center;
    color: var(--forest);
    font-family: var(--mono);
    font-size: 12px;
    letter-spacing: 0.22em;
    text-transform: uppercase;
  }

  .so-cta {
    margin: 32px 0 0;
    display: flex;
    gap: 12px;
    flex-wrap: wrap;
  }

  .so-foot {
    max-width: var(--maxw);
    margin: 0 auto 120px;
    padding: 60px var(--rail) 0;
    border-top: 1px solid var(--line);
    text-align: center;
  }
  .so-foot p {
    font-family: var(--serif);
    font-style: italic;
    font-size: 22px;
    line-height: 1.55;
    color: var(--ink-soft);
    max-width: 50ch;
    margin: 0 auto 24px;
  }

  /* ===== Gallery — populated from the outlet's admin Gallery field. ===== */
  .so-gallery {
    max-width: var(--maxw);
    margin: 0 auto;
    padding: clamp(60px, 9vw, 100px) var(--rail);
  }
  .so-gallery__head {
    display: flex;
    justify-content: space-between;
    align-items: end;
    gap: 24px;
    margin-bottom: clamp(28px, 4vw, 48px);
    flex-wrap: wrap;
  }
  .so-gallery__head h2 {
    font-family: var(--serif);
    font-style: italic;
    font-size: clamp(32px, 4.4vw, 56px);
    line-height: 1;
    margin: 12px 0 0;
    letter-spacing: -0.02em;
  }
  .so-gallery__head h2 em { color: var(--forest); }
  .so-gallery__grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: clamp(8px, 1vw, 14px);
  }
  /* Masked slide-up reveal.
     The figure is the mask (overflow:hidden, fixed aspect).
     The image inside translates up from below the frame into place,
     while a thin curtain layer slides up behind it for depth. */
  .so-gallery__item {
    margin: 0;
    aspect-ratio: 4 / 3;
    overflow: hidden;
    background: var(--cream);
    border-radius: 4px;
    position: relative;
    isolation: isolate;
  }
  .so-gallery__item img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
    transform: translate3d(0, 102%, 0);
    transition: transform 1.1s cubic-bezier(0.22, 1, 0.36, 1);
    will-change: transform;
  }
  .so-gallery__item.is-in img {
    transform: translate3d(0, 0, 0);
    transition-delay: 0.12s; /* lets the curtain lead by ~120ms */
  }
  /* Curtain — sits behind the image and slides up just ahead of it,
     so the frame fills with colour first, then the photo locks in. */
  .so-gallery__item::before {
    content: "";
    position: absolute;
    inset: 0;
    z-index: -1;
    background: var(--forest, #1f3a2e);
    transform: translate3d(0, 100%, 0);
    transition: transform 1.1s cubic-bezier(0.22, 1, 0.36, 1);
  }
  .so-gallery__item.is-in::before {
    transform: translate3d(0, 0, 0);
  }
  /* Hover: gentle zoom only after the reveal has settled. */
  .so-gallery__item img { transition-property: transform; }
  .so-gallery__item.is-in:hover img {
    transform: translate3d(0, 0, 0) scale(1.04);
    transition-duration: 0.6s;
  }
  @media (prefers-reduced-motion: reduce) {
    .so-gallery__item img { transform: none; transition: none; }
    .so-gallery__item::before { display: none; }
  }

  @media (max-width: 900px) {
    .so-grid { grid-template-columns: 1fr; gap: 40px; }
    .so-gallery__grid { grid-template-columns: repeat(2, 1fr); }
  }
  @media (max-width: 540px) {
    .so-gallery__grid { grid-template-columns: 1fr; }
    .so-gallery__item { aspect-ratio: 5 / 4; }
  }
</style>

<section class="so-hero">
  <div class="so-hero__crumb">
    <a href="<?php echo esc_url( hakshan_nav_url( 'outlets' ) ); ?>"><span data-en>← All outlets</span><span data-zh>← 所有门店</span></a>
    <span aria-hidden="true">·</span>
    <span class="so-hero__city"><?php echo esc_html( $city_pretty ); ?></span>
  </div>

  <h1>
    <?php echo esc_html( $o['name'] ); ?>
    <?php if ( ! empty( $o['cn'] ) ) : ?>
      <span class="cn"><?php echo esc_html( $o['cn'] ); ?></span>
    <?php endif; ?>
  </h1>

  <?php if ( $city_pretty ) : ?>
  <p class="so-hero__sub">
    <span data-en>Hakka Chinese Restaurant · <?php echo esc_html( $city_pretty ); ?></span>
    <span data-zh>客家中餐厅 · <?php echo esc_html( $city_pretty ); ?></span>
  </p>
  <?php endif; ?>

  <p class="lead">
    <span data-en>Hakshan <?php echo esc_html( $o['name'] ); ?> — a Hakka Chinese restaurant in <?php echo esc_html( $city_pretty ); ?>. Same recipes since 1928, same kitchen discipline as every other outlet. Lei cha (thunder tea rice), Hakka mee, mui choy pork belly, three-cup chicken, drunken chicken with rice wine — traditional Hakka cooking: salt-cured, slow-braised, made to last.</span>
    <span data-zh>客善<?php echo esc_html( $o['name'] ); ?>——位于<?php echo esc_html( $city_pretty ); ?>的客家中餐厅。同一份食谱，1928年至今未变，与每一间门店同一套厨房纪律。擂茶饭、客家板面、梅菜扣肉、三杯鸡、黄酒醉鸡——传统客家菜：盐渍、慢炖，做出来是耐放的味道。</span>
  </p>
</section>

<section class="so-grid">
  <dl class="so-meta">
    <?php if ( ! empty( $o['addr'] ) ) : ?>
    <div class="so-meta__row">
      <dt><span data-en>Address</span><span data-zh>地址</span></dt>
      <dd><?php echo esc_html( $o['addr'] ); ?></dd>
    </div>
    <?php endif; ?>

    <?php if ( ! empty( $o['hours'] ) ) : ?>
    <div class="so-meta__row">
      <dt><span data-en>Hours</span><span data-zh>营业</span></dt>
      <dd><?php echo esc_html( $o['hours'] ); ?></dd>
    </div>
    <?php endif; ?>

    <?php if ( ! empty( $o['seats'] ) ) : ?>
    <div class="so-meta__row">
      <dt><span data-en>Seats</span><span data-zh>座位</span></dt>
      <dd><?php echo esc_html( $o['seats'] ); ?></dd>
    </div>
    <?php endif; ?>

    <?php if ( ! empty( $o['phone'] ) ) : ?>
    <div class="so-meta__row">
      <dt><span data-en>Phone</span><span data-zh>电话</span></dt>
      <dd><a href="tel:<?php echo esc_attr( preg_replace( '/[^+\d]/', '', $o['phone'] ) ); ?>"><?php echo esc_html( $o['phone'] ); ?></a></dd>
    </div>
    <?php endif; ?>

    <div class="so-cta">
      <?php $so_has_booking = ! empty( $o['booking_url'] ); ?>
      <a class="btn" href="<?php echo esc_url( $so_has_booking ? $o['booking_url'] : hakshan_nav_url( 'contact' ) . '#reserve' ); ?>"<?php echo $so_has_booking ? ' target="_blank" rel="noopener"' : ''; ?>>
        <span data-en>Reserve a table</span><span data-zh>预订座位</span><span class="arr">→</span>
      </a>
      <?php if ( $maps_url ) : ?>
        <a class="btn btn--ghost" href="<?php echo esc_url( $maps_url ); ?>" target="_blank" rel="noopener">
          <span data-en>Directions</span><span data-zh>路线</span><span class="arr">→</span>
        </a>
      <?php endif; ?>
      <a class="btn btn--ghost" href="<?php echo esc_url( hakshan_nav_url( 'menu' ) ); ?>">
        <span data-en>See the menu</span><span data-zh>查看菜单</span><span class="arr">→</span>
      </a>
    </div>
  </dl>

  <div class="so-map">
    <?php if ( $maps_embed ) : ?>
      <iframe
        src="<?php echo esc_url( $maps_embed ); ?>"
        loading="lazy"
        allowfullscreen
        referrerpolicy="no-referrer-when-downgrade"
        title="<?php echo esc_attr( sprintf( 'Map of Hakshan %s, %s', $o['name'], $city_pretty ) ); ?>"
      ></iframe>
    <?php else : ?>
      <div class="so-map__placeholder">
        <span data-en>Map unavailable</span><span data-zh>地图暂缺</span>
      </div>
    <?php endif; ?>
  </div>
</section>

<?php
// Gallery — only render the section when the outlet has at least one
// image added under its admin "Gallery" field. Otherwise it stays
// invisible and there's nothing for the editor to manage publicly.
$so_gallery = function_exists( 'hakshan_get_outlet_gallery' ) ? hakshan_get_outlet_gallery( $outlet_id ) : array();
if ( ! empty( $so_gallery ) ) :
?>
<section class="so-gallery">
  <div class="so-gallery__head">
    <h2>
      <span data-en>Inside <em><?php echo esc_html( $o['name'] ); ?>.</em></span>
      <span data-zh>店内<em>一瞥。</em></span>
    </h2>
  </div>
  <div class="so-gallery__grid">
    <?php foreach ( $so_gallery as $i => $img ) :
      // Stagger reveal: every 3rd item resets the delay so each row
      // animates in as a wave rather than the last image waiting forever.
      $delay = ( $i % 3 ) * 120; // ms
    ?>
      <figure
        class="so-gallery__item"
        data-reveal
        style="transition-delay: <?php echo (int) $delay; ?>ms;"
      >
        <img
          src="<?php echo esc_url( $img['url'] ); ?>"
          <?php if ( $img['srcset'] ) : ?>srcset="<?php echo esc_attr( $img['srcset'] ); ?>" sizes="<?php echo esc_attr( $img['sizes'] ); ?>"<?php endif; ?>
          alt="<?php echo esc_attr( $img['alt'] ? $img['alt'] : $o['name'] ); ?>"
          loading="lazy"
        />
      </figure>
    <?php endforeach; ?>
  </div>
</section>
<?php endif; ?>

<section class="so-foot">
  <p>
    <span data-en>The book has never been retyped. The original is kept safe; pencilled copies hang in every kitchen, including this one.</span>
    <span data-zh>那叠纸至今没有重打过。原稿仍是原稿，铅笔字的复印本挂在每一家厨房，包括这一家。</span>
  </p>
  <a class="btn btn--ghost" href="<?php echo esc_url( hakshan_nav_url( 'story' ) ); ?>">
    <span data-en>Read the story</span><span data-zh>阅读故事</span><span class="arr">→</span>
  </a>
</section>

<?php
get_footer();
