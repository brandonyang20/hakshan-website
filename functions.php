<?php
/**
 * Hakshan theme functions.
 *
 * @package Hakshan
 */

defined( 'ABSPATH' ) || exit;

if ( ! defined( 'HAKSHAN_THEME_VERSION' ) ) {
	define( 'HAKSHAN_THEME_VERSION', '1.0.8' );
}

require_once get_theme_file_path( 'inc/dish-cpt.php' );
require_once get_theme_file_path( 'inc/outlet-cpt.php' );

/**
 * Theme setup — features and supports.
 */
function hakshan_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support(
		'html5',
		array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' )
	);
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'automatic-feed-links' );

	register_nav_menus(
		array(
			'primary' => __( 'Primary navigation', 'hakshan' ),
		)
	);
}
add_action( 'after_setup_theme', 'hakshan_setup' );

/**
 * Enqueue front-end assets.
 */
function hakshan_enqueue_assets() {
	wp_enqueue_style(
		'hakshan-google-fonts',
		'https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;1,400;1,500&family=Inter:wght@300;400;500;600&family=Noto+Serif+SC:wght@400;500;700&family=JetBrains+Mono:wght@400&display=swap',
		array(),
		null
	);

	wp_enqueue_style(
		'hakshan-styles',
		get_theme_file_uri( 'assets/css/styles.css' ),
		array( 'hakshan-google-fonts' ),
		HAKSHAN_THEME_VERSION
	);

	if ( ! is_front_page() ) {
		wp_enqueue_style(
			'hakshan-inner',
			get_theme_file_uri( 'assets/css/inner.css' ),
			array( 'hakshan-styles' ),
			HAKSHAN_THEME_VERSION
		);
	}

	wp_enqueue_script(
		'hakshan-shell',
		get_theme_file_uri( 'assets/js/shell.js' ),
		array(),
		HAKSHAN_THEME_VERSION,
		true
	);
}
add_action( 'wp_enqueue_scripts', 'hakshan_enqueue_assets' );

/**
 * Preconnect to Google Fonts (the design depends on it).
 */
function hakshan_resource_hints( $hints, $relation ) {
	if ( 'preconnect' === $relation ) {
		$hints[] = array( 'href' => 'https://fonts.googleapis.com' );
		$hints[] = array(
			'href'        => 'https://fonts.gstatic.com',
			'crossorigin' => 'anonymous',
		);
	}
	return $hints;
}
add_filter( 'wp_resource_hints', 'hakshan_resource_hints', 10, 2 );

/**
 * Map the current request to a nav key (matches the design's `active` keys).
 *
 * @return string
 */
function hakshan_active_nav_key() {
	if ( is_front_page() ) {
		return 'home';
	}
	$slug_to_key = array(
		'menu'      => 'menu',
		'outlets'   => 'outlets',
		'story'     => 'story',
		'investors' => 'investors',
		'contact'   => 'contact',
	);
	$post = get_queried_object();
	if ( $post instanceof WP_Post && isset( $slug_to_key[ $post->post_name ] ) ) {
		return $slug_to_key[ $post->post_name ];
	}
	return '';
}

/**
 * Resolve a nav key to a URL. Falls back to a hash for unknown keys so the
 * theme works before pages have been created in the admin.
 *
 * @param string $key One of: home, menu, outlets, story, investors, contact.
 * @return string
 */
function hakshan_nav_url( $key ) {
	if ( 'home' === $key ) {
		return home_url( '/' );
	}
	$page = get_page_by_path( $key );
	if ( $page instanceof WP_Post ) {
		return get_permalink( $page );
	}
	return home_url( '/' . $key . '/' );
}

/**
 * Render the shared top navigation. Mirrors `partials.js#navHTML`.
 *
 * @param array $args { dark: bool, book_href: string }
 */
function hakshan_render_nav( $args = array() ) {
	$args      = wp_parse_args(
		$args,
		array(
			'dark'      => false,
			'book_href' => '#book',
		)
	);
	$dark      = ! empty( $args['dark'] ) ? ' nav--dark' : '';
	$active    = hakshan_active_nav_key();
	$book_href = $args['book_href'];

	$links = array(
		array(
			'key' => 'home',
			'en'  => 'Home',
			'zh'  => '首页',
		),
		array(
			'key' => 'menu',
			'en'  => 'Menu',
			'zh'  => '菜单',
		),
		array(
			'key' => 'outlets',
			'en'  => 'Outlets',
			'zh'  => '门店',
		),
		array(
			'key' => 'story',
			'en'  => 'Our Story',
			'zh'  => '三代故事',
		),
		array(
			'key' => 'investors',
			'en'  => 'Investors',
			'zh'  => '投资者',
		),
		array(
			'key' => 'contact',
			'en'  => 'Contact',
			'zh'  => '联系我们',
		),
	);

	$logo = esc_url( get_theme_file_uri( 'assets/brand/hakshan-horizontal.png' ) );
	?>
	<header class="nav<?php echo esc_attr( $dark ); ?>">
		<a class="nav__brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
			<img src="<?php echo esc_url( $logo ); ?>" alt="Hakshan 客善" />
		</a>
		<nav class="nav__links" aria-label="Primary">
			<?php foreach ( $links as $link ) : ?>
				<a href="<?php echo esc_url( hakshan_nav_url( $link['key'] ) ); ?>"
				   class="<?php echo $active === $link['key'] ? 'is-active' : ''; ?>">
					<span data-en><?php echo esc_html( $link['en'] ); ?></span>
					<span data-zh><?php echo esc_html( $link['zh'] ); ?></span>
				</a>
			<?php endforeach; ?>
		</nav>
		<div class="nav__right">
			<div class="lang-toggle" role="group" aria-label="Language">
				<button data-lang-btn="en"><span>EN</span></button>
				<button data-lang-btn="zh"><span>中</span></button>
			</div>
			<a class="nav__cta" href="<?php echo esc_url( $book_href ); ?>">
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
				<a class="drawer__brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
					<img src="<?php echo esc_url( $logo ); ?>" alt="Hakshan 客善" />
				</a>
				<button class="drawer__close" aria-label="Close menu">&times;</button>
			</div>
			<nav class="drawer__links" aria-label="Primary, mobile">
				<?php foreach ( $links as $link ) : ?>
					<a href="<?php echo esc_url( hakshan_nav_url( $link['key'] ) ); ?>"
					   class="<?php echo $active === $link['key'] ? 'is-active' : ''; ?>">
						<span data-en><?php echo esc_html( $link['en'] ); ?></span>
						<span data-zh><?php echo esc_html( $link['zh'] ); ?></span>
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
			<a class="drawer__cta" href="<?php echo esc_url( $book_href ); ?>">
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
	<?php
}

/**
 * Render the shared footer. Mirrors `partials.js#footerHTML`.
 */
function hakshan_render_footer() {
	$outlets_url   = hakshan_nav_url( 'outlets' );
	$story_url     = hakshan_nav_url( 'story' );
	$menu_url      = hakshan_nav_url( 'menu' );
	$investors_url = hakshan_nav_url( 'investors' );
	$contact_url   = hakshan_nav_url( 'contact' );
	?>
	<footer class="foot">
		<div class="foot__grid">
			<div class="foot__brand">
				<span class="word">Hakshan</span>
				<span class="cn">客 善</span>
			</div>
			<div>
				<h5><span data-en>Visit</span><span data-zh>到访</span></h5>
				<ul>
					<li><a href="<?php echo esc_url( $outlets_url ); ?>"><span data-en>USJ Taipan</span><span data-zh>梳邦再也</span></a></li>
					<li><a href="<?php echo esc_url( $outlets_url ); ?>"><span data-en>Menjalara Kepong</span><span data-zh>甲洞</span></a></li>
					<li><a href="<?php echo esc_url( $outlets_url ); ?>"><span data-en>Cheras Traders Sq.</span><span data-zh>蕉赖</span></a></li>
					<li><a href="<?php echo esc_url( $outlets_url ); ?>"><span data-en>Bandar Puteri Puchong</span><span data-zh>蒲种</span></a></li>
					<li><a href="<?php echo esc_url( $outlets_url ); ?>"><span data-en>IOI Conezion, Putrajaya</span><span data-zh>布城</span></a></li>
					<li><a href="<?php echo esc_url( $outlets_url ); ?>"><span data-en>See all 9 outlets →</span><span data-zh>查看全部 9 家分店 →</span></a></li>
				</ul>
			</div>
			<div>
				<h5><span data-en>Explore</span><span data-zh>了解</span></h5>
				<ul>
					<li><a href="<?php echo esc_url( $story_url ); ?>"><span data-en>Our Story</span><span data-zh>三代故事</span></a></li>
					<li><a href="<?php echo esc_url( $menu_url ); ?>"><span data-en>Menu</span><span data-zh>菜单</span></a></li>
					<li><a href="<?php echo esc_url( $story_url ); ?>#charity"><span data-en>Dining with Purpose</span><span data-zh>用餐慈善</span></a></li>
					<li><a href="<?php echo esc_url( $investors_url ); ?>"><span data-en>Investor Relations</span><span data-zh>投资者关系</span></a></li>
					<li><a href="<?php echo esc_url( $contact_url ); ?>"><span data-en>Press &amp; Media</span><span data-zh>媒体咨询</span></a></li>
				</ul>
			</div>
			<div>
				<h5><span data-en>Contact</span><span data-zh>联系</span></h5>
				<ul>
					<li>+60 16-246 2970</li>
					<li>hello@hakshan.com</li>
					<li><a href="https://instagram.com/hakshan_">Instagram</a></li>
					<li><a href="#">Facebook</a></li>
					<li><a href="#">WeChat</a></li>
				</ul>
			</div>
		</div>
		<div class="foot__bottom">
			<span>© <?php echo esc_html( date_i18n( 'Y' ) ); ?> Hakshan Sdn. Bhd. — <span data-en>All rights reserved.</span><span data-zh>版权所有。</span></span>
			<span data-en>Three generations of Hakka.</span><span data-zh>三代人的传承</span>
		</div>
	</footer>
	<?php
}
