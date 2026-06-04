<?php
/**
 * Template Name: Menu
 * Template Post Type: page
 *
 * @package Hakshan
 */

get_header();
?>

<section class="page-head">
  <div>
    <h1>
      <span data-en>What we <em>cook</em>.</span>
      <span data-zh>我们做的<em>菜</em>。</span>
    </h1>
  </div>
  <p>
    <span data-en>Forty dishes, six chapters. Some take an afternoon, some take three days. None of them have been re-engineered for speed. Walk-ins welcome; some dishes are limited daily — call ahead for groups.</span>
    <span data-zh>四十道菜，六个章节。有的需要一个下午，有的需要三天。我们没有为速度做任何「优化」。欢迎散客；部分菜每日限量，团客请先致电。</span>
  </p>
</section>

<?php
// Pull live sections from the CPT once; reuse for both the TOC and the
// body below so the two can never drift out of sync.
$toc_sections = function_exists( 'hakshan_get_menu_sections' ) ? hakshan_get_menu_sections() : array();

$menu_sections_fallback = array(
  array(
    'id'        => 'signatures',
    'ch'        => '招 牌',
    'title_en'  => 'Signatures',
    'title_zh'  => '招 牌 菜',
    'title_cn'  => '招 牌',
    'lead_en'   => 'Six dishes the kitchen will never take off the menu.',
    'lead_zh'   => '六道我们永远不会下架的菜。',
    'dishes'    => array(
      array( 'label' => 'salt-baked chicken · paper-wrapped',   'en' => 'Salt-Baked Chicken',       'zh' => '客家盐焗鸡', 'cn' => '客家盐焗鸡', 'desc_en' => 'Whole free-range hen wrapped in kraft paper, baked in coarse sea salt over rambutan-wood embers.', 'desc_zh' => '整只走地鸡，牛皮纸裹，红毛丹炭火粗海盐焗。' ),
      array( 'label' => 'mui choy pork belly · cross-section',  'en' => 'Mui Choy Pork Belly',      'zh' => '梅菜扣肉',   'cn' => '梅菜扣肉',   'desc_en' => 'Five-spice belly, pickled mustard greens, two hours steaming.', 'desc_zh' => '五香三层肉，自家腌梅干菜，两小时同蒸。' ),
      array( 'label' => 'abacus seeds · stir-fried',            'en' => 'Abacus Seeds',             'zh' => '算盘子',     'cn' => '算盘子',     'desc_en' => 'Hand-pinched taro &amp; tapioca, stir-fried with mushroom, dried shrimp, chives.', 'desc_zh' => '手捏芋头木薯，配冬菇、虾米、韭菜爆炒。' ),
      array( 'label' => 'thunder tea rice · green broth',       'en' => 'Thunder Tea Rice',         'zh' => '擂茶饭',     'cn' => '擂茶饭',     'desc_en' => 'Twelve herbs, ground by mortar. Served with seven toppings.', 'desc_zh' => '十二种香草现磨，搭配七味配料。' ),
      array( 'label' => 'ginger-sprout braised duck',           'en' => 'Ginger-Sprout Braised Duck', 'zh' => '姜芽焖鸭', 'cn' => '姜芽焖鸭',   'desc_en' => 'Three hours on low flame, young ginger sprouts, dark caramel sauce.', 'desc_zh' => '三小时慢火，姜芽爆香，老抽收汁。' ),
      array( 'label' => 'rice-wine chicken soup · clay pot',    'en' => 'Rice-Wine Chicken Soup',   'zh' => '糯米酒鸡汤', 'cn' => '糯米酒鸡汤', 'desc_en' => 'Glutinous rice wine, kampung chicken, ginger, sesame oil.', 'desc_zh' => '糯米酒、甘榜鸡、老姜、麻油。' ),
    ),
  ),
  array(
    'id'        => 'chicken',
    'ch'        => '盐 与 烟',
    'title_en'  => 'Salt &amp; Smoke',
    'title_zh'  => '盐 与 烟',
    'title_cn'  => '盐 烟',
    'lead_en'   => 'What the Hakka did when there was no fridge.',
    'lead_zh'   => '客家人在没有冰箱年代留下来的味道。',
    'dishes'    => array(
      array( 'label' => 'hakka trio-sauce chicken',     'en' => 'Hakka Trio-Sauce Chicken', 'zh' => '客家三杯鸡', 'cn' => '三杯鸡',   'desc_en' => 'Rice wine, soy, sesame oil. Equal parts.', 'desc_zh' => '米酒、生抽、麻油等量。' ),
      array( 'label' => 'smoked five-spice duck',       'en' => 'Smoked Five-Spice Duck',   'zh' => '五香烟熏鸭', 'cn' => '烟熏鸭',   'desc_en' => 'Brined 24 hours, smoked over tea leaves and brown sugar.', 'desc_zh' => '24小时盐渍，茶叶红糖熏制。' ),
      array( 'label' => 'cured pork hash · sliced',     'en' => 'Cured Pork Hash',          'zh' => '客家咸肉',   'cn' => '咸肉',     'desc_en' => 'Air-cured 14 days, sliced and steamed over rice.', 'desc_zh' => '风干14天，切片，米饭上同蒸。' ),
      array( 'label' => 'salt-crusted sea bass',        'en' => 'Salt-Crusted Sea Bass',    'zh' => '盐焗鲈鱼',   'cn' => '盐焗鲈鱼', 'desc_en' => 'Whole fish in a sea-salt crust, broken at the table.', 'desc_zh' => '整条鲈鱼海盐封皮，桌边敲开。' ),
    ),
  ),
  array(
    'id'        => 'braised',
    'ch'        => '焖 与 炖',
    'title_en'  => 'Braised &amp; Stewed',
    'title_zh'  => '焖 与 炖',
    'title_cn'  => '焖 炖',
    'lead_en'   => 'Dishes that benefit from being made the day before.',
    'lead_zh'   => '过夜更入味的那一类。',
    'dishes'    => array(
      array( 'label' => 'pork trotter · vinegar & ginger',    'en' => 'Pork Trotter, Vinegar &amp; Ginger', 'zh' => '姜醋猪脚', 'cn' => '姜醋猪脚', 'desc_en' => 'Sweet black vinegar, old ginger, hard-boiled egg.', 'desc_zh' => '甜醋、老姜、白煮蛋。' ),
      array( 'label' => 'wild boar curry · dry style',        'en' => 'Wild Boar Curry',                    'zh' => '野猪咖喱', 'cn' => '山猪咖喱', 'desc_en' => 'Pahang wild boar, Hakka-style dry curry.', 'desc_zh' => '彭亨山猪，客家干咖喱。' ),
      array( 'label' => 'stewed tripe & tendon · clay pot',   'en' => 'Stewed Tripe &amp; Tendon',          'zh' => '牛杂煲',   'cn' => '牛杂煲',   'desc_en' => 'Three hours, white peppercorns, daikon, charred ginger.', 'desc_zh' => '三小时白胡椒粒、白萝卜、烤姜同煲。' ),
      array( 'label' => 'red wine lees pork · crisp',         'en' => 'Red Wine Lees Pork',                 'zh' => '红糟肉',   'cn' => '红糟肉',   'desc_en' => 'Pork shoulder marinated in red rice-wine lees, pan-fried crisp.', 'desc_zh' => '红糟腌猪肩肉，干煎酥脆。' ),
    ),
  ),
  array(
    'id'        => 'yong',
    'ch'        => '酿 豆 腐',
    'title_en'  => 'Yong Tau Foo',
    'title_zh'  => '酿 豆 腐',
    'title_cn'  => '酿 豆 腐',
    'lead_en'   => 'Fish paste pounded by hand at 6am. Stuffed by 10am. Sold out by 9pm.',
    'lead_zh'   => '清晨六点手工捶打鱼浆，十点酿好，晚上九点前卖完。',
    'dishes'    => array(
      array( 'label' => 'trio yong tau foo',         'en' => 'Trio Yong Tau Foo',         'zh' => '三宝酿豆腐', 'cn' => '三宝',     'desc_en' => 'Bitter gourd, soft tofu, fried tofu — in fish-bone broth.', 'desc_zh' => '苦瓜、嫩豆腐、豆卜，配鱼骨清汤。' ),
      array( 'label' => 'seven-piece yong tau foo',  'en' => 'Seven-Piece Yong Tau Foo',  'zh' => '七宝酿豆腐', 'cn' => '七宝',     'desc_en' => 'Brinjal, chilli, lady\'s finger, mushroom &amp; the trio.', 'desc_zh' => '茄子、辣椒、羊角豆、香菇与三宝同碗。' ),
      array( 'label' => 'stuffed fried tofu skin',   'en' => 'Stuffed Fried Tofu Skin',   'zh' => '酿腐皮',     'cn' => '酿腐皮',   'desc_en' => 'Fish paste, water chestnut, scallion, in a crisp tofu-skin pouch.', 'desc_zh' => '鱼浆、马蹄、青葱，包入酥脆腐皮。' ),
      array( 'label' => 'yong foo hot pot',          'en' => 'Yong Foo Hot Pot',          'zh' => '客家酿煲',   'cn' => '酿 煲',    'desc_en' => 'Clay pot, ten pieces, dark soy, scallion oil.', 'desc_zh' => '砂锅装，十件，老抽与葱油。' ),
    ),
  ),
  array(
    'id'        => 'rice',
    'ch'        => '饭 与 面',
    'title_en'  => 'Rice &amp; Noodles',
    'title_zh'  => '饭 与 面',
    'title_cn'  => '饭 面',
    'lead_en'   => 'Wheat for cold days, rice for everything else.',
    'lead_zh'   => '冷天吃麦，其他时候吃饭。',
    'dishes'    => array(
      array( 'label' => 'ginger-sprout duck rice', 'en' => 'Ginger-Sprout Duck Rice', 'zh' => '姜芽焖鸭饭', 'cn' => '姜芽鸭饭', 'desc_en' => 'The signature, in a single bowl.', 'desc_zh' => '招牌一份，一人份。' ),
      array( 'label' => 'hakka pan mee',           'en' => 'Hakka Pan Mee',           'zh' => '客家板面',   'cn' => '板面',     'desc_en' => 'Hand-torn noodles, minced pork, anchovies, sweet potato leaves.', 'desc_zh' => '手撕面，肉碎、江鱼仔、番薯叶。' ),
      array( 'label' => 'char yoke rice',          'en' => 'Char Yoke Rice',          'zh' => '炸肉饭',     'cn' => '炸 肉 饭', 'desc_en' => 'Five-spice deep-fried pork, scallion ginger sauce, rice.', 'desc_zh' => '五香炸肉，葱姜酱，配饭。' ),
      array( 'label' => 'hakka mee suah',          'en' => 'Hakka Mee Suah',          'zh' => '客家面线',   'cn' => '面 线',    'desc_en' => 'Thin wheat noodles, pork lard, white pepper soup.', 'desc_zh' => '细面线，猪油渣，白胡椒清汤。' ),
    ),
  ),
  array(
    'id'        => 'soup',
    'ch'        => '汤 与 酒',
    'title_en'  => 'Soups &amp; Wines',
    'title_zh'  => '汤 与 酒',
    'title_cn'  => '汤 酒',
    'lead_en'   => 'Hakka women drank rice wine against the cold. Hakka men drank it too — just less honestly.',
    'lead_zh'   => '客家妇女用米酒驱寒，客家男人也喝 — 只是没那么坦白。',
    'dishes'    => array(
      array( 'label' => 'old cucumber & pork soup',   'en' => 'Old Cucumber, Pork &amp; Honey Date Soup', 'zh' => '老黄瓜煲',   'cn' => '老黄瓜',   'desc_en' => 'Four hours simmer.', 'desc_zh' => '慢炖四小时，两人份砂锅。' ),
      array( 'label' => 'black chicken & dang gui',   'en' => 'Black Chicken &amp; Dang Gui',             'zh' => '当归乌鸡',   'cn' => '当归乌鸡', 'desc_en' => 'Restorative double-boiled soup, ten ingredients.', 'desc_zh' => '十味当归乌鸡炖汤。' ),
      array( 'label' => 'house rice wine, warm',      'en' => 'House Rice Wine, warm',                    'zh' => '糯米酒（温）','cn' => '糯米酒',    'desc_en' => 'Fermented in-house, served at 50°C in a clay cup.', 'desc_zh' => '自家发酵，砂杯温至50°C 上桌。' ),
      array( 'label' => 'aged pu-erh tea',            'en' => 'Aged Tea, by the pot',                     'zh' => '老 茶 一 壶','cn' => '老 茶',     'desc_en' => 'Pu-erh, 12 years. Refilled freely.', 'desc_zh' => '普洱，12年。免费续壶。' ),
    ),
  ),
  array(
    'id'        => 'sweet',
    'ch'        => '甜 品',
    'title_en'  => 'Sweet',
    'title_zh'  => '甜 品',
    'title_cn'  => '甜',
    'lead_en'   => 'Three options. Two of them are warm.',
    'lead_zh'   => '三种甜，其中两种是热的。',
    'dishes'    => array(
      array( 'label' => 'black sesame tang yuan', 'en' => 'Black Sesame Tang Yuan', 'zh' => '黑芝麻汤圆', 'cn' => '汤 圆',       'desc_en' => 'Hand-rolled, ginger syrup.', 'desc_zh' => '手工汤圆，姜糖水。' ),
      array( 'label' => 'steamed honey cake',     'en' => 'Steamed Honey Cake',     'zh' => '蒸蜂蜜糕',   'cn' => '蜂 蜜 糕',    'desc_en' => 'Brown sugar, eight-hour steam.', 'desc_zh' => '红糖，蒸八小时。' ),
      array( 'label' => 'iced soya bean & cincau','en' => 'Iced Soya Bean &amp; Cincau', 'zh' => '豆奶仙草','cn' => '豆 奶 仙 草', 'desc_en' => 'House-made soya milk, grass jelly, palm sugar.', 'desc_zh' => '自家豆浆、仙草、椰糖。' ),
    ),
  ),
);

// $toc_sections (collected at the top of the file) drives the TOC; we re-use
// the same value here so the TOC and rendered sections can never drift.
$section_terms = $toc_sections;
?>
<nav class="menu-toc">
  <div class="menu-toc__inner">
    <?php if ( ! empty( $section_terms ) ) :
      foreach ( $section_terms as $toc_term ) :
        $toc_zh = get_term_meta( $toc_term->term_id, 'title_zh', true );
        ?>
        <a href="#<?php echo esc_attr( $toc_term->slug ); ?>">
          <span data-en><?php echo esc_html( $toc_term->name ); ?></span>
          <span data-zh><?php echo esc_html( $toc_zh ? $toc_zh : $toc_term->name ); ?></span>
        </a>
      <?php endforeach;
    else :
      foreach ( $menu_sections_fallback as $fallback_section ) : ?>
        <a href="#<?php echo esc_attr( $fallback_section['id'] ); ?>">
          <span data-en><?php echo wp_kses_post( $fallback_section['title_en'] ); ?></span>
          <span data-zh><?php echo esc_html( $fallback_section['title_zh'] ); ?></span>
        </a>
      <?php endforeach;
    endif; ?>
  </div>
</nav>

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
      $d = hakshan_get_dish_data( $dish_post->ID );
      ?>
    <div class="dish"><div class="dish__visual"><?php if ( $d['image_html'] ) : echo $d['image_html']; else : ?><div class="ph" data-label="<?php echo esc_attr( $d['label'] ); ?>"></div><?php endif; ?></div><div>
      <h3><span data-en><?php echo esc_html( $d['en'] ); ?></span><span data-zh><?php echo esc_html( $d['zh'] ); ?></span></h3>
      <p><span data-en><?php echo wp_kses_post( $d['desc_en'] ); ?></span>
        <span data-zh><?php echo esc_html( $d['desc_zh'] ); ?></span></p>
    </div></div>
    <?php endforeach; ?>
  </div>
</section>
  <?php endforeach;
else :
  // Fallback: render from the hardcoded array if nothing's in the DB yet.
  foreach ( $menu_sections_fallback as $section ) :
    ?>
<section class="menu-section" id="<?php echo esc_attr( $section['id'] ); ?>">
  <div class="menu-section__head">
    <div>
      <span class="ch"><?php echo esc_html( $section['ch'] ); ?></span>
      <h2><span data-en><?php echo wp_kses_post( $section['title_en'] ); ?></span><span data-zh><?php echo esc_html( $section['title_zh'] ); ?></span><span class="cn"><?php echo esc_html( $section['title_cn'] ); ?></span></h2>
    </div>
    <p><span data-en><?php echo wp_kses_post( $section['lead_en'] ); ?></span>
      <span data-zh><?php echo esc_html( $section['lead_zh'] ); ?></span></p>
  </div>
  <div class="menu-section__list">
    <?php foreach ( $section['dishes'] as $dish ) : ?>
    <div class="dish"><div class="dish__visual"><div class="ph" data-label="<?php echo esc_attr( $dish['label'] ); ?>"></div></div><div>
      <h3><span data-en><?php echo esc_html( $dish['en'] ); ?></span><span data-zh><?php echo esc_html( $dish['zh'] ); ?></span></h3>
      <p><span data-en><?php echo wp_kses_post( $dish['desc_en'] ); ?></span>
        <span data-zh><?php echo esc_html( $dish['desc_zh'] ); ?></span></p>
    </div></div>
    <?php endforeach; ?>
  </div>
</section>
  <?php endforeach;
endif;
?>

<section class="section" style="text-align: center;">
  <div style="display: flex; gap: 16px; justify-content: center; flex-wrap: wrap;">
    <a class="btn btn--ghost" href="<?php echo esc_url( hakshan_nav_url( 'outlets' ) ); ?>"><span data-en>Find an outlet</span><span data-zh>查找门店</span><span class="arr">→</span></a>
  </div>
</section>

<?php
get_footer();
