<?php
/**
 * Template Name: Menu
 * Template Post Type: page
 *
 * @package Hakshan
 */

get_header();
?>

<?php
// Pull live sections from the CPT once; reuse for the hero count, the TOC,
// and the body below so they can never drift out of sync.
$toc_sections   = function_exists( 'hakshan_get_menu_sections' ) ? hakshan_get_menu_sections() : array();
$total_dishes   = 0;
$total_sections = count( $toc_sections );
foreach ( $toc_sections as $count_term ) {
	$total_dishes += (int) $count_term->count;
}

// Spell out small numbers EN-side so the lead reads as prose, not a stat block.
$en_numerals = array(
	1 => 'One', 2 => 'Two', 3 => 'Three', 4 => 'Four', 5 => 'Five',
	6 => 'Six', 7 => 'Seven', 8 => 'Eight', 9 => 'Nine', 10 => 'Ten',
	11 => 'Eleven', 12 => 'Twelve',
);
$zh_numerals = array(
	1 => '一', 2 => '二', 3 => '三', 4 => '四', 5 => '五',
	6 => '六', 7 => '七', 8 => '八', 9 => '九', 10 => '十',
	11 => '十一', 12 => '十二',
);
$dish_word_en    = isset( $en_numerals[ $total_dishes ] ) ? $en_numerals[ $total_dishes ] : (string) $total_dishes;
$section_word_en = isset( $en_numerals[ $total_sections ] ) ? strtolower( $en_numerals[ $total_sections ] ) : (string) $total_sections;
$dish_word_zh    = isset( $zh_numerals[ $total_dishes ] ) ? $zh_numerals[ $total_dishes ] : (string) $total_dishes;
$section_word_zh = isset( $zh_numerals[ $total_sections ] ) ? $zh_numerals[ $total_sections ] : (string) $total_sections;
?>

<section class="page-head">
  <div>
    <h1>
      <span data-en>What we <em>cook</em>.</span>
      <span data-zh>我们做的<em>菜</em>。</span>
    </h1>
  </div>
  <p class="page-head__hakka" style="font-size: 17px; line-height: 1.65; color: var(--ink-soft); max-width: 56ch; margin-bottom: 18px;">
    <span data-en>Hakka food is salt-cured, slow-braised, made to last in a kitchen without a fridge. It's the cooking of a Chinese migrant community that settled across southern Malaysia. What follows is the menu we've been cooking from since 1928.</span>
    <span data-zh>客家菜，是盐渍、慢炖，原本是没有冰箱年代留下的味道。是落脚南马的华人移民社群留下来的家常。下面这一份，是我们家从1928年起就在做的菜。</span>
  </p>
  <?php if ( $total_dishes > 0 && $total_sections > 0 ) : ?>
  <p>
    <span data-en><?php echo esc_html( $dish_word_en ); ?> dishes, <?php echo esc_html( $section_word_en ); ?> chapters. Some take an afternoon, some take three days. None of them have been re-engineered for speed. Walk-ins welcome; some dishes are limited daily, so call ahead for groups.</span>
    <span data-zh><?php echo esc_html( $dish_word_zh ); ?>道菜，<?php echo esc_html( $section_word_zh ); ?>个章节。有的需要一个下午，有的需要三天。我们没有为速度做任何「优化」。欢迎散客；部分菜每日限量，团客请先致电。</span>
  </p>
  <?php else : ?>
  <p>
    <span data-en>Some take an afternoon, some take three days. None of them have been re-engineered for speed. Walk-ins welcome; some dishes are limited daily, so call ahead for groups.</span>
    <span data-zh>有的需要一个下午，有的需要三天。我们没有为速度做任何「优化」。欢迎散客；部分菜每日限量，团客请先致电。</span>
  </p>
  <?php endif; ?>
</section>

<?php $section_terms = $toc_sections; ?>

<?php if ( ! empty( $section_terms ) ) : ?>
<nav class="menu-toc">
  <div class="menu-toc__inner">
    <?php foreach ( $section_terms as $toc_term ) :
      $toc_zh = get_term_meta( $toc_term->term_id, 'title_zh', true ); ?>
      <a href="#<?php echo esc_attr( $toc_term->slug ); ?>">
        <span data-en><?php echo esc_html( $toc_term->name ); ?></span>
        <span data-zh><?php echo esc_html( $toc_zh ? $toc_zh : $toc_term->name ); ?></span>
      </a>
    <?php endforeach; ?>
  </div>
</nav>
<?php endif; ?>

<?php
if ( ! empty( $section_terms ) ) :
  foreach ( $section_terms as $section_term ) :
    $dishes = hakshan_get_dishes_for_section( $section_term->term_id );
    if ( empty( $dishes ) ) {
      continue;
    }
    $title_zh = get_term_meta( $section_term->term_id, 'title_zh', true );
    $title_cn = get_term_meta( $section_term->term_id, 'title_cn', true );
    $ch       = get_term_meta( $section_term->term_id, 'ch', true );
    $lead_en  = get_term_meta( $section_term->term_id, 'lead_en', true );
    $lead_zh  = get_term_meta( $section_term->term_id, 'lead_zh', true );
    ?>
<section class="menu-section" id="<?php echo esc_attr( $section_term->slug ); ?>">
  <div class="menu-section__head">
    <div>
      <span class="ch"><?php echo esc_html( $ch ); ?></span>
      <h2><span data-en><?php echo wp_kses_post( $section_term->name ); ?></span><span data-zh><?php echo esc_html( $title_zh ); ?></span><span class="cn"><?php echo esc_html( $title_cn ); ?></span></h2>
    </div>
    <p><span data-en><?php echo wp_kses_post( $lead_en ); ?></span>
      <span data-zh><?php echo esc_html( $lead_zh ); ?></span></p>
  </div>
  <div class="menu-section__list">
    <?php foreach ( $dishes as $dish_post ) :
      $d            = hakshan_get_dish_data( $dish_post->ID );
      $has_normal   = ! empty( $d['price_normal'] );
      $has_member   = ! empty( $d['price_member'] );
      ?>
    <div class="dish"><div class="dish__visual"><?php if ( $d['image_html'] ) : echo $d['image_html']; else : ?><div class="ph" data-label="<?php echo esc_attr( $d['label'] ); ?>"></div><?php endif; ?></div><div>
      <h3><span data-en><?php echo esc_html( $d['en'] ); ?></span><span data-zh><?php echo esc_html( $d['zh'] ); ?></span></h3>
      <?php if ( $has_normal || $has_member ) : ?>
        <div class="price">
          <?php if ( $has_normal && $has_member ) : ?>
            <span class="price__normal"><?php echo esc_html( $d['price_normal'] ); ?></span>
            <span class="price__member"><?php echo esc_html( $d['price_member'] ); ?></span>
            <span class="price__tag"><span data-en>member</span><span data-zh>会员价</span></span>
          <?php elseif ( $has_member ) : ?>
            <span class="price__member"><?php echo esc_html( $d['price_member'] ); ?></span>
          <?php else : ?>
            <span class="price__single"><?php echo esc_html( $d['price_normal'] ); ?></span>
          <?php endif; ?>
        </div>
      <?php endif; ?>
      <p><span data-en><?php echo wp_kses_post( $d['desc_en'] ); ?></span>
        <span data-zh><?php echo esc_html( $d['desc_zh'] ); ?></span></p>
    </div></div>
    <?php endforeach; ?>
  </div>
</section>
  <?php endforeach;
else : ?>
<section class="section" style="text-align: center; padding: 80px var(--rail);">
  <p style="font-family: var(--serif); font-style: italic; font-size: 24px; color: var(--ink-soft);">
    <span data-en>Menu coming soon.</span>
    <span data-zh>菜单整理中。</span>
  </p>
</section>
<?php endif; ?>

<section class="section" style="text-align: center;">
  <div style="display: flex; gap: 16px; justify-content: center; flex-wrap: wrap;">
    <a class="btn btn--ghost" href="<?php echo esc_url( hakshan_nav_url( 'outlets' ) ); ?>"><span data-en>Find an outlet</span><span data-zh>查找门店</span><span class="arr">→</span></a>
  </div>
</section>

<?php
get_footer();
