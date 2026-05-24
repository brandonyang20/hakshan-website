<?php
/* Template Name: Menu */
get_header();

$categories = hakshan_dish_categories();
?>
<main>

<section class="page-head">
  <div>
    <span class="h-eyebrow"><span class="dot"></span>
      <span data-en>THE MENU · SPRING <?php echo date('Y'); ?></span>
      <span data-zh>菜 单 · <?php echo date('Y'); ?> 春</span>
    </span>
    <h1>
      <span data-en>What we cook,<br/><em>and why.</em></span>
      <span data-zh>菜 单<br/><em>之 全。</em></span>
    </h1>
  </div>
  <p>
    <span data-en>Forty dishes, six chapters. Some take an afternoon, some take three days. None of them have been re-engineered for speed. Walk-ins welcome; some dishes are limited daily — call ahead for groups.</span>
    <span data-zh>四十道菜，六个章节。有的需要一个下午，有的需要三天。我们没有为速度做任何「优化」。欢迎散客；部分菜每日限量，团客请先致电。</span>
  </p>
</section>

<nav class="menu-toc">
  <div class="menu-toc__inner">
    <?php foreach ($categories as $slug => $cat): ?>
      <a href="#<?php echo esc_attr($slug); ?>">
        <span data-en><?php echo esc_html($cat['en']); ?></span>
        <span data-zh><?php echo esc_html($cat['zh']); ?></span>
      </a>
    <?php endforeach; ?>
  </div>
</nav>

<?php foreach ($categories as $slug => $cat):
    $dishes = new WP_Query([
        'post_type'      => 'menu_item',
        'posts_per_page' => -1,
        'tax_query'      => [[
            'taxonomy' => 'dish_category',
            'field'    => 'slug',
            'terms'    => $slug,
        ]],
        'orderby' => 'menu_order',
        'order'   => 'ASC',
    ]);
?>
<section class="menu-section" id="<?php echo esc_attr($slug); ?>">
  <div class="menu-section__head">
    <div>
      <span class="ch"><?php echo esc_html($cat['ch']); ?></span>
      <h2>
        <span data-en><?php echo esc_html($cat['en']); ?></span>
        <span data-zh><?php echo esc_html($cat['zh']); ?></span>
        <span class="cn"><?php echo esc_html($cat['ch']); ?></span>
      </h2>
    </div>
    <p>
      <span data-en><?php echo esc_html($cat['desc_en']); ?></span>
      <span data-zh><?php echo esc_html($cat['desc_zh']); ?></span>
    </p>
  </div>

  <div class="menu-section__list">
    <?php if ($dishes->have_posts()):
        while ($dishes->have_posts()): $dishes->the_post();
            $zh_name = get_post_meta(get_the_ID(), '_hakshan_zh_name', true);
            $zh_desc = get_post_meta(get_the_ID(), '_hakshan_zh_description', true);
            $en_desc = get_the_excerpt() ?: wp_trim_words(get_the_content(), 25);
        ?>
        <div class="dish">
          <div class="dish__visual">
            <?php if (has_post_thumbnail()):
                echo get_the_post_thumbnail(null, 'dish-card', ['loading'=>'lazy']);
            else: ?>
              <div class="ph" data-label="<?php echo esc_attr(get_the_title()); ?>"></div>
            <?php endif; ?>
          </div>
          <div>
            <h3>
              <span data-en><?php the_title(); ?></span>
              <?php if ($zh_name): ?><span data-zh><?php echo esc_html($zh_name); ?></span><?php endif; ?>
              <?php if ($zh_name): ?><span class="cn"><?php echo esc_html($zh_name); ?></span><?php endif; ?>
            </h3>
            <p>
              <span data-en><?php echo esc_html($en_desc); ?></span>
              <?php if ($zh_desc): ?><span data-zh><?php echo esc_html($zh_desc); ?></span><?php endif; ?>
            </p>
          </div>
        </div>
        <?php
        endwhile;
        wp_reset_postdata();

    else:
        /* Fallback static content per category */
        $fallbacks = [
            'signatures'   => [
                ['en'=>'Salt-Baked Chicken','zh'=>'客家盐焗鸡','desc_en'=>'Whole free-range hen wrapped in kraft paper, baked in coarse sea salt over rambutan-wood embers.','desc_zh'=>'整只走地鸡，牛皮纸裹，红毛丹炭火粗海盐焗。','label'=>'salt-baked chicken · paper-wrapped'],
                ['en'=>'Mui Choy Pork Belly','zh'=>'梅菜扣肉','desc_en'=>'Five-spice belly, pickled mustard greens, two hours steaming.','desc_zh'=>'五香三层肉，自家腌梅干菜，两小时同蒸。','label'=>'mui choy pork belly'],
                ['en'=>'Abacus Seeds','zh'=>'算盘子','desc_en'=>'Hand-pinched taro & tapioca, stir-fried with mushroom, dried shrimp, chives.','desc_zh'=>'手捏芋头木薯，配冬菇、虾米、韭菜爆炒。','label'=>'abacus seeds'],
                ['en'=>'Thunder Tea Rice','zh'=>'擂茶饭','desc_en'=>'Twelve herbs, ground by mortar. Served with seven toppings.','desc_zh'=>'十二种香草现磨，搭配七味配料。','label'=>'thunder tea rice'],
                ['en'=>'Ginger-Sprout Braised Duck','zh'=>'姜芽焖鸭','desc_en'=>'Three hours on low flame, young ginger sprouts, dark caramel sauce.','desc_zh'=>'三小时慢火，姜芽爆香，老抽收汁。','label'=>'ginger-sprout braised duck'],
                ['en'=>'Rice-Wine Chicken Soup','zh'=>'糯米酒鸡汤','desc_en'=>'Glutinous rice wine, kampung chicken, ginger, sesame oil.','desc_zh'=>'糯米酒、甘榜鸡、老姜、麻油。','label'=>'rice-wine chicken soup'],
            ],
            'salt-smoke'   => [
                ['en'=>'Hakka Trio-Sauce Chicken','zh'=>'客家三杯鸡','desc_en'=>'Rice wine, soy, sesame oil. Equal parts.','desc_zh'=>'米酒、生抽、麻油等量。','label'=>'hakka trio-sauce chicken'],
                ['en'=>'Smoked Five-Spice Duck','zh'=>'五香烟熏鸭','desc_en'=>'Brined 24 hours, smoked over tea leaves and brown sugar.','desc_zh'=>'24小时盐渍，茶叶红糖熏制。','label'=>'smoked five-spice duck'],
                ['en'=>'Cured Pork Hash','zh'=>'客家咸肉','desc_en'=>'Air-cured 14 days, sliced and steamed over rice.','desc_zh'=>'风干14天，切片，米饭上同蒸。','label'=>'cured pork hash'],
                ['en'=>'Salt-Crusted Sea Bass','zh'=>'盐焗鲈鱼','desc_en'=>'Whole fish in a sea-salt crust, broken at the table.','desc_zh'=>'整条鲈鱼海盐封皮，桌边敲开。','label'=>'salt-crusted sea bass'],
            ],
            'braised'      => [
                ['en'=>'Pork Trotter, Vinegar & Ginger','zh'=>'姜醋猪脚','desc_en'=>'Sweet black vinegar, old ginger, hard-boiled egg.','desc_zh'=>'甜醋、老姜、白煮蛋。','label'=>'pork trotter vinegar ginger'],
                ['en'=>'Wild Boar Curry','zh'=>'野猪咖喱','desc_en'=>'Pahang wild boar, Hakka-style dry curry.','desc_zh'=>'彭亨山猪，客家干咖喱。','label'=>'wild boar curry'],
                ['en'=>'Stewed Tripe & Tendon','zh'=>'牛杂煲','desc_en'=>'Three hours, white peppercorns, daikon, charred ginger.','desc_zh'=>'三小时白胡椒粒、白萝卜、烤姜同煲。','label'=>'stewed tripe tendon'],
                ['en'=>'Red Wine Lees Pork','zh'=>'红糟肉','desc_en'=>'Pork shoulder marinated in red rice-wine lees, pan-fried crisp.','desc_zh'=>'红糟腌猪肩肉，干煎酥脆。','label'=>'red wine lees pork'],
            ],
            'yong-tau-foo' => [
                ['en'=>'Trio Yong Tau Foo','zh'=>'三宝酿豆腐','desc_en'=>'Bitter gourd, soft tofu, fried tofu — in fish-bone broth.','desc_zh'=>'苦瓜、嫩豆腐、豆卜，配鱼骨清汤。','label'=>'trio yong tau foo'],
                ['en'=>'Seven-Piece Yong Tau Foo','zh'=>'七宝酿豆腐','desc_en'=>'Brinjal, chilli, lady\'s finger, mushroom & the trio.','desc_zh'=>'茄子、辣椒、羊角豆、香菇与三宝同碗。','label'=>'seven-piece yong tau foo'],
                ['en'=>'Stuffed Fried Tofu Skin','zh'=>'酿腐皮','desc_en'=>'Fish paste, water chestnut, scallion, in a crisp tofu-skin pouch.','desc_zh'=>'鱼浆、马蹄、青葱，包入酥脆腐皮。','label'=>'stuffed fried tofu skin'],
                ['en'=>'Yong Foo Hot Pot','zh'=>'客家酿煲','desc_en'=>'Clay pot, ten pieces, dark soy, scallion oil.','desc_zh'=>'砂锅装，十件，老抽与葱油。','label'=>'yong foo hot pot'],
            ],
            'rice-noodles' => [
                ['en'=>'Ginger-Sprout Duck Rice','zh'=>'姜芽焖鸭饭','desc_en'=>'The signature, in a single bowl.','desc_zh'=>'招牌一份，一人份。','label'=>'ginger-sprout duck rice'],
                ['en'=>'Hakka Pan Mee','zh'=>'客家板面','desc_en'=>'Hand-torn noodles, minced pork, anchovies, sweet potato leaves.','desc_zh'=>'手撕面，肉碎、江鱼仔、番薯叶。','label'=>'hakka pan mee'],
                ['en'=>'Char Yoke Rice','zh'=>'炸肉饭','desc_en'=>'Five-spice deep-fried pork, scallion ginger sauce, rice.','desc_zh'=>'五香炸肉，葱姜酱，配饭。','label'=>'char yoke rice'],
                ['en'=>'Hakka Mee Suah','zh'=>'客家面线','desc_en'=>'Thin wheat noodles, pork lard, white pepper soup.','desc_zh'=>'细面线，猪油渣，白胡椒清汤。','label'=>'hakka mee suah'],
            ],
            'soups-wines'  => [
                ['en'=>'Old Cucumber, Pork & Honey Date Soup','zh'=>'老黄瓜煲','desc_en'=>'Four hours simmer.','desc_zh'=>'慢炖四小时，两人份砂锅。','label'=>'old cucumber pork soup'],
                ['en'=>'Black Chicken & Dang Gui','zh'=>'当归乌鸡','desc_en'=>'Restorative double-boiled soup, ten ingredients.','desc_zh'=>'十味当归乌鸡炖汤。','label'=>'black chicken dang gui'],
                ['en'=>'House Rice Wine, warm','zh'=>'糯米酒（温）','desc_en'=>'Fermented in-house, served at 50°C in a clay cup.','desc_zh'=>'自家发酵，砂杯温至50°C 上桌。','label'=>'house rice wine warm'],
                ['en'=>'Aged Tea, by the pot','zh'=>'老 茶 一 壶','desc_en'=>'Pu-erh, 12 years. Refilled freely.','desc_zh'=>'普洱，12年。免费续壶。','label'=>'aged pu-erh tea'],
            ],
            'sweet'        => [
                ['en'=>'Black Sesame Tang Yuan','zh'=>'黑芝麻汤圆','desc_en'=>'Hand-rolled, ginger syrup.','desc_zh'=>'手工汤圆，姜糖水。','label'=>'black sesame tang yuan'],
                ['en'=>'Steamed Honey Cake','zh'=>'蒸蜂蜜糕','desc_en'=>'Brown sugar, eight-hour steam.','desc_zh'=>'红糖，蒸八小时。','label'=>'steamed honey cake'],
                ['en'=>'Iced Soya Bean & Cincau','zh'=>'豆奶仙草','desc_en'=>'House-made soya milk, grass jelly, palm sugar.','desc_zh'=>'自家豆浆、仙草、椰糖。','label'=>'iced soya bean cincau'],
            ],
        ];

        $items = isset($fallbacks[$slug]) ? $fallbacks[$slug] : [];
        foreach ($items as $item): ?>
            <div class="dish">
              <div class="dish__visual">
                <div class="ph" data-label="<?php echo esc_attr($item['label']); ?>"></div>
              </div>
              <div>
                <h3>
                  <span data-en><?php echo esc_html($item['en']); ?></span>
                  <span data-zh><?php echo esc_html($item['zh']); ?></span>
                  <span class="cn"><?php echo esc_html($item['zh']); ?></span>
                </h3>
                <p>
                  <span data-en><?php echo esc_html($item['desc_en']); ?></span>
                  <span data-zh><?php echo esc_html($item['desc_zh']); ?></span>
                </p>
              </div>
            </div>
        <?php endforeach;
    endif; ?>
  </div>
</section>
<?php endforeach; ?>

<section class="section" style="text-align:center;">
  <span class="h-eyebrow"><span class="dot"></span>
    <span data-en>FULL MENU PDF</span><span data-zh>下 载 完 整 菜 单</span>
  </span>
  <div style="margin-top:24px;display:flex;gap:16px;justify-content:center;flex-wrap:wrap;">
    <a class="btn" href="#">
      <span data-en>Download PDF · 2.1MB</span><span data-zh>下载 PDF · 2.1MB</span>
      <span class="arr">↓</span>
    </a>
    <a class="btn btn--ghost" href="<?php echo esc_url(home_url('/outlets/')); ?>">
      <span data-en>Find an outlet</span><span data-zh>查找门店</span>
      <span class="arr">→</span>
    </a>
  </div>
</section>

</main>
<?php get_footer(); ?>
