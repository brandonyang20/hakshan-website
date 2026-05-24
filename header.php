<!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?> data-lang="en">

<?php
$nav_links = [
    ['url' => home_url('/'),                            'en' => 'Home',      'zh' => '首页',    'key' => 'home'],
    ['url' => home_url('/menu/'),                       'en' => 'Menu',      'zh' => '菜单',    'key' => 'menu'],
    ['url' => home_url('/outlets/'),                    'en' => 'Outlets',   'zh' => '门店',    'key' => 'outlets'],
    ['url' => home_url('/story/'),                      'en' => 'Our Story', 'zh' => '三代故事','key' => 'story'],
    ['url' => home_url('/investors/'),                  'en' => 'Investors', 'zh' => '投资者',  'key' => 'investors'],
    ['url' => home_url('/contact/'),                    'en' => 'Contact',   'zh' => '联系我们','key' => 'contact'],
];

$current_slug = basename(get_permalink()) ?: 'home';
if (is_front_page()) $current_slug = 'home';

$logo_url = get_template_directory_uri() . '/assets/brand/hakshan-horizontal.png';
$book_href = is_page('contact') ? '#reserve' : home_url('/contact/#reserve');
?>

<header class="nav">
  <a class="nav__brand" href="<?php echo esc_url(home_url('/')); ?>">
    <img src="<?php echo esc_url($logo_url); ?>" alt="Hakshan 客善" width="180" height="44" />
  </a>

  <nav class="nav__links" aria-label="Primary">
    <?php foreach ($nav_links as $link):
        $is_active = (is_front_page() && $link['key'] === 'home')
                  || (!is_front_page() && is_page($link['key']));
        $cls = $is_active ? ' class="is-active"' : '';
    ?>
      <a href="<?php echo esc_url($link['url']); ?>"<?php echo $cls; ?>>
        <span data-en><?php echo esc_html($link['en']); ?></span><span data-zh><?php echo esc_html($link['zh']); ?></span>
      </a>
    <?php endforeach; ?>
  </nav>

  <div class="nav__right">
    <div class="lang-toggle" role="group" aria-label="Language">
      <button data-lang-btn="en"><span>EN</span></button>
      <button data-lang-btn="zh"><span>中</span></button>
    </div>
    <a class="nav__cta" href="<?php echo esc_url($book_href); ?>">
      <span data-en>Reserve</span><span data-zh>订位</span>
    </a>
  </div>

  <button class="nav__burger" aria-label="Open menu" aria-expanded="false">
    <span></span><span></span><span></span>
  </button>
</header>

<aside class="drawer" aria-hidden="true">
  <div class="drawer__panel">
    <div class="drawer__head">
      <a class="drawer__brand" href="<?php echo esc_url(home_url('/')); ?>">
        <img src="<?php echo esc_url($logo_url); ?>" alt="Hakshan 客善" width="160" height="36" />
      </a>
      <button class="drawer__close" aria-label="Close menu">&times;</button>
    </div>
    <nav class="drawer__links" aria-label="Primary, mobile">
      <?php foreach ($nav_links as $link):
          $is_active = (is_front_page() && $link['key'] === 'home')
                    || (!is_front_page() && is_page($link['key']));
          $cls = $is_active ? ' class="is-active"' : '';
      ?>
        <a href="<?php echo esc_url($link['url']); ?>"<?php echo $cls; ?>>
          <span data-en><?php echo esc_html($link['en']); ?></span>
          <span data-zh><?php echo esc_html($link['zh']); ?></span>
        </a>
      <?php endforeach; ?>
    </nav>
    <div class="drawer__divider"></div>
    <div class="drawer__lang">
      <span class="drawer__label"><span data-en>Language</span><span data-zh>语言</span></span>
      <div class="lang-toggle" role="group" aria-label="Language">
        <button data-lang-btn="en"><span>EN</span></button>
        <button data-lang-btn="zh"><span>中</span></button>
      </div>
    </div>
    <a class="drawer__cta" href="<?php echo esc_url($book_href); ?>">
      <span data-en>Reserve a table</span><span data-zh>预订座位</span>
      <span class="arr">→</span>
    </a>
    <div class="drawer__foot">
      <span>+60 16-246 2970</span>
      <span data-en>Daily 11:00 — 22:00</span>
      <span data-zh>每日 11:00 — 22:00</span>
    </div>
  </div>
  <div class="drawer__backdrop" aria-hidden="true"></div>
</aside>
