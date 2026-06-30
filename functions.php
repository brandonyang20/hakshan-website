<?php
/**
 * Hakshan theme functions.
 *
 * @package Hakshan
 */

defined( 'ABSPATH' ) || exit;

if ( ! defined( 'HAKSHAN_THEME_VERSION' ) ) {
	define( 'HAKSHAN_THEME_VERSION', '1.4.124' );
}

require_once get_theme_file_path( 'inc/dish-cpt.php' );
require_once get_theme_file_path( 'inc/outlet-cpt.php' );
require_once get_theme_file_path( 'inc/seo.php' );
require_once get_theme_file_path( 'inc/customizer.php' );
require_once get_theme_file_path( 'inc/llms.php' );
require_once get_theme_file_path( 'inc/meta-pixel.php' );

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
		'https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;1,400;1,500&family=Inter:wght@300;400;500;600&family=Jost:wght@300;400;500&family=Noto+Serif+SC:wght@400;500;700&family=JetBrains+Mono:wght@400&display=swap',
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
		'menu'                  => 'menu',
		'outlets'               => 'outlets',
		'story'                 => 'story',
		'investors'             => 'investors',
		'contact'               => 'contact',
		'social-responsibility' => 'social',
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
	if ( 'social' === $key ) {
		$page = get_page_by_path( 'social-responsibility' );
		if ( $page instanceof WP_Post ) {
			return get_permalink( $page );
		}
		return home_url( '/social-responsibility/' );
	}
	$page = get_page_by_path( $key );
	if ( $page instanceof WP_Post ) {
		return get_permalink( $page );
	}
	return home_url( '/' . $key . '/' );
}

/**
 * Render a post title with bilingual fallback. If the post has a `post_title_zh`
 * meta field, output paired EN/ZH spans. Otherwise output plain text so the
 * title displays in both language modes (graceful fallback for migrated posts).
 *
 * @param int|null $post_id
 * @return string
 */
function hakshan_post_title_bilingual( $post_id = null ) {
	$post_id = $post_id ? (int) $post_id : get_the_ID();
	$en      = get_the_title( $post_id );
	$zh      = (string) get_post_meta( $post_id, 'post_title_zh', true );
	if ( '' === trim( $zh ) ) {
		return esc_html( $en );
	}
	return '<span data-en>' . esc_html( $en ) . '</span><span data-zh>' . esc_html( $zh ) . '</span>';
}

/**
 * Render a post excerpt with bilingual fallback. Mirrors the title helper:
 * uses `post_excerpt_zh` meta when present, falls back to plain EN text otherwise.
 *
 * @param int|null $post_id
 * @param int      $words
 * @return string
 */
function hakshan_post_excerpt_bilingual( $post_id = null, $words = 24 ) {
	$post_id = $post_id ? (int) $post_id : get_the_ID();
	$en_raw  = wp_strip_all_tags( get_the_excerpt( $post_id ) );
	$en      = wp_trim_words( $en_raw, $words, '…' );
	$zh_raw  = wp_strip_all_tags( (string) get_post_meta( $post_id, 'post_excerpt_zh', true ) );
	if ( '' === trim( $zh_raw ) ) {
		return esc_html( $en );
	}
	$zh = wp_trim_words( $zh_raw, $words, '…' );
	return '<span data-en>' . esc_html( $en ) . '</span><span data-zh>' . esc_html( $zh ) . '</span>';
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
			'book_href' => hakshan_nav_url( 'contact' ) . '#reserve',
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
			'key' => 'social',
			'en'  => 'Pay it Forward',
			'zh'  => '傳遞善意',
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

	$logo = 'https://hakshan.com/wp-content/uploads/2026/06/HAKSHAN_Secondary_H_Solid_Black-scaled.png';
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
				<span data-en>Daily 11:00–22:00</span>
				<span data-zh>每日 11:00–22:00</span>
			</div>
		</div>
		<div class="drawer__backdrop" aria-hidden="true"></div>
	</aside>
	<?php
}

/**
 * Bilingual post fields metabox — lets editors enter a ZH title and excerpt
 * for posts (used by the helpers above). Plain text inputs, no JS required.
 */
add_action( 'add_meta_boxes', 'hakshan_post_bilingual_metabox' );
function hakshan_post_bilingual_metabox() {
	add_meta_box(
		'hakshan_post_bilingual',
		'Chinese (中文) title & excerpt',
		'hakshan_post_bilingual_metabox_render',
		'post',
		'normal',
		'high'
	);
}

function hakshan_post_bilingual_metabox_render( $post ) {
	wp_nonce_field( 'hakshan_post_bilingual', 'hakshan_post_bilingual_nonce' );
	$title_zh   = (string) get_post_meta( $post->ID, 'post_title_zh', true );
	$excerpt_zh = (string) get_post_meta( $post->ID, 'post_excerpt_zh', true );
	?>
	<p>
		<label for="hakshan_post_title_zh"><strong>Title (中文)</strong></label><br/>
		<input type="text" id="hakshan_post_title_zh" name="hakshan_post_title_zh" value="<?php echo esc_attr( $title_zh ); ?>" style="width:100%;" />
		<span style="color:#666;font-size:12px;">Leave blank to fall back to the English title in both language modes.</span>
	</p>
	<p>
		<label for="hakshan_post_excerpt_zh"><strong>Excerpt (中文)</strong></label><br/>
		<textarea id="hakshan_post_excerpt_zh" name="hakshan_post_excerpt_zh" rows="3" style="width:100%;"><?php echo esc_textarea( $excerpt_zh ); ?></textarea>
		<span style="color:#666;font-size:12px;">Used on the Social Responsibility stories grid card. Leave blank to fall back to English.</span>
	</p>
	<?php
}

add_action( 'save_post_post', 'hakshan_post_bilingual_save', 10, 2 );
function hakshan_post_bilingual_save( $post_id, $post ) {
	if ( ! isset( $_POST['hakshan_post_bilingual_nonce'] ) ) {
		return;
	}
	if ( ! wp_verify_nonce( wp_unslash( $_POST['hakshan_post_bilingual_nonce'] ), 'hakshan_post_bilingual' ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	$title_zh = isset( $_POST['hakshan_post_title_zh'] ) ? sanitize_text_field( wp_unslash( $_POST['hakshan_post_title_zh'] ) ) : '';
	if ( '' === $title_zh ) {
		delete_post_meta( $post_id, 'post_title_zh' );
	} else {
		update_post_meta( $post_id, 'post_title_zh', $title_zh );
	}

	$excerpt_zh = isset( $_POST['hakshan_post_excerpt_zh'] ) ? sanitize_textarea_field( wp_unslash( $_POST['hakshan_post_excerpt_zh'] ) ) : '';
	if ( '' === $excerpt_zh ) {
		delete_post_meta( $post_id, 'post_excerpt_zh' );
	} else {
		update_post_meta( $post_id, 'post_excerpt_zh', $excerpt_zh );
	}
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
					<li><a href="<?php echo esc_url( $outlets_url ); ?>"><span data-en>See all outlets →</span><span data-zh>查看全部分店 →</span></a></li>
				</ul>
			</div>
			<div>
				<h5><span data-en>Explore</span><span data-zh>了解</span></h5>
				<ul>
					<li><a href="<?php echo esc_url( $story_url ); ?>"><span data-en>Our Story</span><span data-zh>三代故事</span></a></li>
					<li><a href="<?php echo esc_url( $menu_url ); ?>"><span data-en>Menu</span><span data-zh>菜单</span></a></li>
					<li><a href="<?php echo esc_url( hakshan_nav_url( 'social' ) ); ?>"><span data-en>Pay it Forward</span><span data-zh>傳遞善意</span></a></li>
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
					<li><a href="https://www.facebook.com/HakShanRestaurant/">Facebook</a></li>
				</ul>
			</div>
		</div>
		<div class="foot__bottom">
			<span>© <?php echo esc_html( date_i18n( 'Y' ) ); ?> Horvy Holding Sdn Bhd. · <span data-en>All rights reserved.</span><span data-zh>版权所有。</span></span>
			<span data-en>Three generations of Hakka.</span><span data-zh>三代人的传承</span>
		</div>
	</footer>
	<?php
}
