<?php
/**
 * SEO module — per-page meta, Open Graph, Twitter Card, canonical, favicons,
 * robots.txt, and JSON-LD (Organization, Restaurant, Menu, Article,
 * BreadcrumbList).
 *
 * Hooks into wp_head + the robots_txt filter. No plugin dependency.
 *
 * @package Hakshan
 */

defined( 'ABSPATH' ) || exit;

/* ---------------------------------------------------------------------------
 * Brand constants
 * ------------------------------------------------------------------------- */

if ( ! defined( 'HAKSHAN_BRAND_NAME' ) ) {
	define( 'HAKSHAN_BRAND_NAME', 'Hakshan' );
}
if ( ! defined( 'HAKSHAN_BRAND_CN' ) ) {
	define( 'HAKSHAN_BRAND_CN', '客善' );
}
if ( ! defined( 'HAKSHAN_BRAND_PHONE' ) ) {
	define( 'HAKSHAN_BRAND_PHONE', '+60 16-246 2970' );
}
if ( ! defined( 'HAKSHAN_BRAND_EMAIL' ) ) {
	define( 'HAKSHAN_BRAND_EMAIL', 'hello@hakshan.com' );
}
if ( ! defined( 'HAKSHAN_BRAND_HOURS_TEXT' ) ) {
	define( 'HAKSHAN_BRAND_HOURS_TEXT', 'Daily 11:00–22:00' );
}

/* ---------------------------------------------------------------------------
 * Page-context detection
 * ------------------------------------------------------------------------- */

/**
 * Return a short context key for the current request. Used to look up the
 * right title / description / schema strategy.
 *
 * @return string One of: home, story, menu, outlets, single_outlet, contact,
 *                investors, press, page, other.
 */
function hakshan_seo_context() {
	if ( is_front_page() ) {
		return 'home';
	}
	if ( is_singular( 'outlet' ) ) {
		return 'single_outlet';
	}
	$post = get_queried_object();
	if ( $post instanceof WP_Post ) {
		switch ( $post->post_name ) {
			case 'story':
				return 'story';
			case 'menu':
				return 'menu';
			case 'outlets':
				return 'outlets';
			case 'contact':
				return 'contact';
			case 'investors':
				return 'investors';
			case 'press':
			case 'press-media':
				return 'press';
		}
		return 'page';
	}
	return 'other';
}

/* ---------------------------------------------------------------------------
 * Per-page meta lookup
 * ------------------------------------------------------------------------- */

/**
 * Return [title, description] for the current page. Brand voice — short,
 * concrete, local-search friendly.
 *
 * @return array{title:string,description:string}
 */
function hakshan_seo_meta_for_context() {
	$ctx = hakshan_seo_context();

	switch ( $ctx ) {
		case 'home':
			return array(
				'title'       => 'Hakshan · Hakka cooking, three generations, nine kitchens in Malaysia',
				'description' => 'Hakshan (客善). Traditional Hakka Chinese cooking, three generations of the same recipes since 1958. Salt-baked chicken, mui choy pork belly, abacus seeds, thunder tea rice. Nine outlets across the Klang Valley. Part of every sale goes to community causes.',
			);

		case 'story':
			return array(
				'title'       => 'Our story · three generations of Hakka cooking · Hakshan',
				'description' => 'Three generations of Hakka cooking, the same recipes since 1958. Now nine Hakka restaurants across the Klang Valley.',
			);

		case 'menu':
			return array(
				'title'       => 'Menu · Hakka dishes at Hakshan · USJ, Mont Kiara, Cheras, Puchong & more',
				'description' => 'The full Hakshan menu: salt-baked chicken, mui choy pork belly, abacus seeds, thunder tea rice, yong tau foo, Hakka pan mee. Hakka Chinese cooking in Malaysia, six chapters, member pricing.',
			);

		case 'outlets':
			return array(
				'title'       => 'Outlets · find your nearest Hakshan · 9 Hakka restaurants in Klang Valley',
				'description' => 'All nine Hakshan outlets: USJ Taipan, Menjalara, Cheras Traders Square, Bandar Puteri Puchong, IOI Conezion Putrajaya, Budiman Park Kajang, Arcoris Mont Kiara, and two at Desa ParkCity. Daily 11:00–22:00.',
			);

		case 'single_outlet':
			$outlet = get_queried_object();
			$name   = is_object( $outlet ) ? get_the_title( $outlet->ID ) : '';
			$city   = is_object( $outlet ) ? get_post_meta( $outlet->ID, 'outlet_city', true ) : '';
			$addr   = is_object( $outlet ) ? get_post_meta( $outlet->ID, 'outlet_addr', true ) : '';
			$city_t = $city ? ucwords( strtolower( $city ) ) : '';

			$title = $name && $city_t
				? sprintf( '%s · Hakshan Hakka restaurant in %s', $name, $city_t )
				: trim( $name . ' · Hakshan' );

			$description = $addr
				? sprintf( 'Hakshan %s. Hakka cooking, three generations, daily 11:00–22:00. %s. Reservations welcome.', $name, $addr )
				: sprintf( 'Hakshan %s, a Hakka Chinese restaurant. Daily 11:00–22:00. Reservations welcome.', $name );

			return array(
				'title'       => $title,
				'description' => $description,
			);

		case 'contact':
			return array(
				'title'       => 'Reservations & contact · Hakshan',
				'description' => 'Book a table at any Hakshan outlet, get in touch with press, careers, or investor relations. Walk-ins welcome; book ahead for parties of six or more.',
			);

		case 'investors':
			return array(
				'title'       => 'Investor relations · an 18-year kitchen, a new door · Hakshan',
				'description' => 'Hakshan grows out of an 18-year Hakka kitchen (Ying Ker Lou / 迎客楼). Unit economics, footprint, and the structural per-sale charity contribution built into every menu price.',
			);

		case 'press':
			return array(
				'title'       => 'Press & media · Hakshan',
				'description' => 'Press kit, brand assets, and media contact for Hakshan, a Hakka Chinese restaurant in Malaysia.',
			);
	}

	// Generic page / fallback.
	$post  = get_queried_object();
	$title = $post instanceof WP_Post ? get_the_title( $post ) . ' · Hakshan' : 'Hakshan';
	return array(
		'title'       => $title,
		'description' => 'Hakshan, a Hakka Chinese restaurant in Malaysia. Three generations, nine kitchens. Part of every sale goes to community causes.',
	);
}

/* ---------------------------------------------------------------------------
 * <title> override
 * ------------------------------------------------------------------------- */

add_filter(
	'pre_get_document_title',
	function ( $title ) {
		$meta = hakshan_seo_meta_for_context();
		return $meta['title'];
	},
	20
);

/* ---------------------------------------------------------------------------
 * wp_head emitter — meta description, canonical, OG, Twitter, favicons
 * ------------------------------------------------------------------------- */

add_action(
	'wp_head',
	function () {
		$meta        = hakshan_seo_meta_for_context();
		$canonical   = hakshan_seo_canonical_url();
		$og_image    = esc_url( get_theme_file_uri( 'assets/img/og-default.png' ) );
		$og_type     = hakshan_seo_og_type();
		$site_name   = HAKSHAN_BRAND_NAME;
		$theme_color = '#EBDFC4';
		$img_base    = trailingslashit( get_theme_file_uri( 'assets/img' ) );

		echo "\n<!-- Hakshan SEO -->\n";
		printf( '<meta name="description" content="%s" />' . "\n", esc_attr( $meta['description'] ) );
		printf( '<link rel="canonical" href="%s" />' . "\n", esc_url( $canonical ) );
		printf( '<meta name="theme-color" content="%s" />' . "\n", esc_attr( $theme_color ) );

		// Favicons + PWA.
		printf( '<link rel="icon" type="image/png" sizes="32x32" href="%sfavicon-32.png" />' . "\n", esc_url( $img_base ) );
		printf( '<link rel="icon" type="image/png" sizes="16x16" href="%sfavicon-16.png" />' . "\n", esc_url( $img_base ) );
		printf( '<link rel="apple-touch-icon" sizes="180x180" href="%sapple-touch-icon.png" />' . "\n", esc_url( $img_base ) );
		printf( '<link rel="manifest" href="%ssite.webmanifest" />' . "\n", esc_url( $img_base ) );

		// Open Graph.
		printf( '<meta property="og:type" content="%s" />' . "\n", esc_attr( $og_type ) );
		printf( '<meta property="og:site_name" content="%s" />' . "\n", esc_attr( $site_name ) );
		printf( '<meta property="og:title" content="%s" />' . "\n", esc_attr( $meta['title'] ) );
		printf( '<meta property="og:description" content="%s" />' . "\n", esc_attr( $meta['description'] ) );
		printf( '<meta property="og:url" content="%s" />' . "\n", esc_url( $canonical ) );
		printf( '<meta property="og:image" content="%s" />' . "\n", esc_url( $og_image ) );
		printf( '<meta property="og:image:width" content="1200" />' . "\n" );
		printf( '<meta property="og:image:height" content="630" />' . "\n" );
		printf( '<meta property="og:locale" content="en_MY" />' . "\n" );
		printf( '<meta property="og:locale:alternate" content="zh_CN" />' . "\n" );

		// Twitter Card.
		printf( '<meta name="twitter:card" content="summary_large_image" />' . "\n" );
		printf( '<meta name="twitter:title" content="%s" />' . "\n", esc_attr( $meta['title'] ) );
		printf( '<meta name="twitter:description" content="%s" />' . "\n", esc_attr( $meta['description'] ) );
		printf( '<meta name="twitter:image" content="%s" />' . "\n", esc_url( $og_image ) );

		// JSON-LD payload.
		hakshan_seo_render_jsonld();

		echo "<!-- /Hakshan SEO -->\n\n";
	},
	1
);

/* ---------------------------------------------------------------------------
 * Helpers — canonical URL + OG type
 * ------------------------------------------------------------------------- */

function hakshan_seo_canonical_url() {
	if ( is_front_page() ) {
		return home_url( '/' );
	}
	if ( is_singular() ) {
		$id = get_queried_object_id();
		if ( $id ) {
			return get_permalink( $id );
		}
	}
	if ( is_archive() ) {
		$url = home_url( add_query_arg( null, null ) );
		return strtok( $url, '?' );
	}
	return home_url( add_query_arg( null, null ) );
}

function hakshan_seo_og_type() {
	$ctx = hakshan_seo_context();
	if ( 'home' === $ctx || 'single_outlet' === $ctx ) {
		return 'restaurant.restaurant';
	}
	if ( 'story' === $ctx ) {
		return 'article';
	}
	return 'website';
}

/* ---------------------------------------------------------------------------
 * JSON-LD emitter
 * ------------------------------------------------------------------------- */

function hakshan_seo_render_jsonld() {
	$ctx     = hakshan_seo_context();
	$payload = array();

	// Sitewide: Organization + WebSite, on every page.
	$payload[] = hakshan_seo_organization_node();
	$payload[] = hakshan_seo_website_node();

	switch ( $ctx ) {
		case 'home':
			// Flagship Restaurant schema for the brand on the homepage.
			$flagship = hakshan_seo_flagship_restaurant_node();
			if ( $flagship ) {
				$payload[] = $flagship;
			}
			break;

		case 'single_outlet':
			$outlet_node = hakshan_seo_outlet_restaurant_node( get_queried_object() );
			if ( $outlet_node ) {
				$payload[] = $outlet_node;
			}
			$payload[] = hakshan_seo_breadcrumb_node(
				array(
					array( 'name' => 'Outlets', 'url' => hakshan_nav_url( 'outlets' ) ),
					array( 'name' => get_the_title( get_queried_object_id() ), 'url' => hakshan_seo_canonical_url() ),
				)
			);
			break;

		case 'menu':
			$menu_node = hakshan_seo_menu_node();
			if ( $menu_node ) {
				$payload[] = $menu_node;
			}
			$payload[] = hakshan_seo_breadcrumb_node(
				array( array( 'name' => 'Menu', 'url' => hakshan_seo_canonical_url() ) )
			);
			break;

		case 'story':
			$payload[] = hakshan_seo_story_article_node();
			$payload[] = hakshan_seo_breadcrumb_node(
				array( array( 'name' => 'Our Story', 'url' => hakshan_seo_canonical_url() ) )
			);
			break;

		case 'outlets':
		case 'contact':
		case 'investors':
		case 'press':
		case 'page':
			$meta      = hakshan_seo_meta_for_context();
			$title     = $meta['title'];
			$short     = explode( ' · ', $title );
			$payload[] = hakshan_seo_breadcrumb_node(
				array( array( 'name' => $short[0], 'url' => hakshan_seo_canonical_url() ) )
			);
			break;
	}

	foreach ( $payload as $node ) {
		echo '<script type="application/ld+json">';
		echo wp_json_encode( $node, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );
		echo "</script>\n";
	}
}

/* ---------------------------------------------------------------------------
 * Schema.org node builders
 * ------------------------------------------------------------------------- */

function hakshan_seo_organization_node() {
	return array(
		'@context'      => 'https://schema.org',
		'@type'         => 'Organization',
		'name'          => HAKSHAN_BRAND_NAME,
		'alternateName' => HAKSHAN_BRAND_CN,
		'url'           => home_url( '/' ),
		'logo'          => esc_url_raw( get_theme_file_uri( 'assets/brand/hakshan-logo-ground.png' ) ),
		'sameAs'        => array(
			'https://instagram.com/hakshan_',
		),
		'contactPoint'  => array(
			array(
				'@type'             => 'ContactPoint',
				'contactType'       => 'reservations',
				'telephone'         => HAKSHAN_BRAND_PHONE,
				'email'             => HAKSHAN_BRAND_EMAIL,
				'areaServed'        => 'MY',
				'availableLanguage' => array( 'en', 'zh' ),
			),
		),
	);
}

function hakshan_seo_website_node() {
	return array(
		'@context'      => 'https://schema.org',
		'@type'         => 'WebSite',
		'name'          => HAKSHAN_BRAND_NAME,
		'alternateName' => HAKSHAN_BRAND_CN,
		'url'           => home_url( '/' ),
		'inLanguage'    => array( 'en-MY', 'zh-Hans' ),
	);
}

/**
 * Flagship Restaurant node for the homepage. Uses the USJ outlet's address
 * (the first outlet by menu_order in the CPT, or the one with slug 'usj').
 */
function hakshan_seo_flagship_restaurant_node() {
	if ( ! function_exists( 'hakshan_get_outlets' ) ) {
		return null;
	}
	$flagship = null;
	$by_slug  = get_page_by_path( 'usj', OBJECT, 'outlet' );
	if ( $by_slug instanceof WP_Post ) {
		$flagship = $by_slug;
	} else {
		$outlets = hakshan_get_outlets();
		if ( ! empty( $outlets ) ) {
			$flagship = $outlets[0];
		}
	}
	if ( ! $flagship ) {
		return null;
	}
	$node = hakshan_seo_outlet_restaurant_node( $flagship );
	if ( $node ) {
		// Brand-level overrides for the flagship node on the homepage.
		$node['@id']  = home_url( '/#restaurant' );
		$node['url']  = home_url( '/' );
		$node['name'] = HAKSHAN_BRAND_NAME;
	}
	return $node;
}

/**
 * Build a Restaurant schema node from an outlet post.
 *
 * @param WP_Post|null $outlet Outlet post.
 * @return array|null
 */
function hakshan_seo_outlet_restaurant_node( $outlet ) {
	if ( ! $outlet instanceof WP_Post ) {
		return null;
	}
	$d = hakshan_get_outlet_data( $outlet->ID );
	if ( empty( $d ) ) {
		return null;
	}

	$node = array(
		'@context'        => 'https://schema.org',
		'@type'           => 'Restaurant',
		'@id'             => get_permalink( $outlet->ID ) . '#restaurant',
		'name'            => sprintf( '%s · %s', HAKSHAN_BRAND_NAME, $d['name'] ),
		'alternateName'   => trim( HAKSHAN_BRAND_CN . ' ' . $d['cn'] ),
		'url'             => get_permalink( $outlet->ID ),
		'image'           => array(
			$d['image_url'] ? $d['image_url'] : esc_url_raw( get_theme_file_uri( 'assets/img/og-default.png' ) ),
		),
		'logo'            => esc_url_raw( get_theme_file_uri( 'assets/brand/hakshan-logo-ground.png' ) ),
		'servesCuisine'   => array( 'Hakka', 'Chinese', 'Malaysian Chinese' ),
		'priceRange'      => 'RM 15–RM 80',
		'acceptsReservations' => true,
		'menu'            => hakshan_nav_url( 'menu' ),
		'telephone'       => $d['phone'] ? $d['phone'] : HAKSHAN_BRAND_PHONE,
	);

	if ( ! empty( $d['addr'] ) ) {
		$node['address'] = hakshan_seo_postal_address( $d['addr'], $d['city'] );
	}

	$node['openingHoursSpecification'] = array(
		array(
			'@type'     => 'OpeningHoursSpecification',
			'dayOfWeek' => array( 'Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday' ),
			'opens'     => '11:00',
			'closes'    => '22:00',
		),
	);

	// Parent organisation — links the outlet to the brand.
	$node['parentOrganization'] = array(
		'@type' => 'Organization',
		'name'  => HAKSHAN_BRAND_NAME,
		'url'   => home_url( '/' ),
	);

	return $node;
}

/**
 * Parse the free-form address line into a PostalAddress node.
 * Format expected: "<street>, <postcode> <locality>, <region>"
 * Falls back to streetAddress-only if it can't be split cleanly.
 *
 * @param string $addr Free-form address line.
 * @param string $city Outlet city tag (uppercase).
 * @return array
 */
function hakshan_seo_postal_address( $addr, $city = '' ) {
	$base = array(
		'@type'         => 'PostalAddress',
		'streetAddress' => $addr,
		'addressLocality' => $city ? ucwords( strtolower( $city ) ) : 'Klang Valley',
		'addressRegion'   => 'Selangor',
		'addressCountry'  => 'MY',
	);

	// Best-effort postcode extraction: 5 digits.
	if ( preg_match( '/\b(\d{5})\b/', $addr, $m ) ) {
		$base['postalCode'] = $m[1];
	}

	return $base;
}

/**
 * Menu schema — one MenuSection per dish_section term, with nested MenuItem
 * entries. Reads exclusively from the Dish CPT helpers; no hardcoded data.
 */
function hakshan_seo_menu_node() {
	if ( ! function_exists( 'hakshan_get_menu_sections' ) ) {
		return null;
	}
	$sections = hakshan_get_menu_sections();
	if ( empty( $sections ) ) {
		return null;
	}

	$menu_sections = array();
	foreach ( $sections as $section ) {
		$dishes = hakshan_get_dishes_for_section( $section->term_id );
		if ( empty( $dishes ) ) {
			continue;
		}
		$items = array();
		foreach ( $dishes as $dish_post ) {
			$item = hakshan_seo_menu_item_node( $dish_post );
			if ( $item ) {
				$items[] = $item;
			}
		}
		if ( empty( $items ) ) {
			continue;
		}
		$ms = array(
			'@type' => 'MenuSection',
			'name'  => $section->name,
		);
		$lead_en = get_term_meta( $section->term_id, 'lead_en', true );
		if ( $lead_en ) {
			$ms['description'] = wp_strip_all_tags( $lead_en );
		}
		$ms['hasMenuItem'] = $items;
		$menu_sections[]   = $ms;
	}

	if ( empty( $menu_sections ) ) {
		return null;
	}

	return array(
		'@context'       => 'https://schema.org',
		'@type'          => 'Menu',
		'name'           => 'Hakshan menu',
		'inLanguage'     => array( 'en', 'zh-Hans' ),
		'hasMenuSection' => $menu_sections,
	);
}

function hakshan_seo_menu_item_node( $dish_post ) {
	if ( ! $dish_post instanceof WP_Post ) {
		return null;
	}
	$d = hakshan_get_dish_data( $dish_post->ID );

	$item = array(
		'@type' => 'MenuItem',
		'name'  => $d['en'],
	);
	if ( ! empty( $d['zh'] ) ) {
		$item['alternateName'] = $d['zh'];
	}
	if ( ! empty( $d['desc_en'] ) ) {
		$item['description'] = wp_strip_all_tags( $d['desc_en'] );
	}
	$thumb = $d['image_id'] ? wp_get_attachment_image_url( $d['image_id'], 'large' ) : '';
	if ( $thumb ) {
		$item['image'] = $thumb;
	}

	$normal = hakshan_seo_parse_price( $d['price_normal'] );
	$member = hakshan_seo_parse_price( $d['price_member'] );

	if ( null !== $normal || null !== $member ) {
		$specs = array();
		if ( null !== $normal ) {
			$specs[] = array(
				'@type'         => 'UnitPriceSpecification',
				'price'         => $normal,
				'priceCurrency' => 'MYR',
				'name'          => 'Walk-in price',
			);
		}
		if ( null !== $member ) {
			$specs[] = array(
				'@type'         => 'UnitPriceSpecification',
				'price'         => $member,
				'priceCurrency' => 'MYR',
				'name'          => 'Member price',
				'eligibleCustomerType' => 'https://schema.org/CustomerType/Member',
			);
		}
		$primary = null !== $member ? $member : $normal;
		$item['offers'] = array(
			'@type'             => 'Offer',
			'price'             => $primary,
			'priceCurrency'     => 'MYR',
			'priceSpecification' => $specs,
			'availability'      => 'https://schema.org/InStock',
		);
	}

	return $item;
}

/**
 * Parse a price string like "RM 18" or "RM18.50" into a numeric value.
 *
 * @param string $raw Price input.
 * @return float|null
 */
function hakshan_seo_parse_price( $raw ) {
	if ( ! is_string( $raw ) || '' === trim( $raw ) ) {
		return null;
	}
	if ( preg_match( '/(\d+(?:\.\d+)?)/', $raw, $m ) ) {
		return (float) $m[1];
	}
	return null;
}

function hakshan_seo_story_article_node() {
	$canonical = hakshan_seo_canonical_url();
	$meta      = hakshan_seo_meta_for_context();
	return array(
		'@context'         => 'https://schema.org',
		'@type'            => 'Article',
		'headline'         => 'Three Generations, One Recipe',
		'description'      => $meta['description'],
		'inLanguage'       => 'en',
		'image'            => esc_url_raw( get_theme_file_uri( 'assets/img/og-default.png' ) ),
		'mainEntityOfPage' => array(
			'@type' => 'WebPage',
			'@id'   => $canonical,
		),
		'author'           => array(
			'@type' => 'Organization',
			'name'  => HAKSHAN_BRAND_NAME,
			'url'   => home_url( '/' ),
		),
		'publisher'        => array(
			'@type' => 'Organization',
			'name'  => HAKSHAN_BRAND_NAME,
			'url'   => home_url( '/' ),
			'logo'  => array(
				'@type' => 'ImageObject',
				'url'   => esc_url_raw( get_theme_file_uri( 'assets/brand/hakshan-logo-ground.png' ) ),
			),
		),
	);
}

/**
 * Build a BreadcrumbList node. The "Home" crumb is prepended automatically.
 *
 * @param array $crumbs List of ['name' => string, 'url' => string].
 * @return array
 */
function hakshan_seo_breadcrumb_node( $crumbs ) {
	$items   = array();
	$all     = array_merge(
		array( array( 'name' => 'Home', 'url' => home_url( '/' ) ) ),
		$crumbs
	);
	$position = 1;
	foreach ( $all as $crumb ) {
		$items[] = array(
			'@type'    => 'ListItem',
			'position' => $position++,
			'name'     => $crumb['name'],
			'item'     => $crumb['url'],
		);
	}
	return array(
		'@context'        => 'https://schema.org',
		'@type'           => 'BreadcrumbList',
		'itemListElement' => $items,
	);
}

/* ---------------------------------------------------------------------------
 * robots.txt — allow all, disallow admin, point to the WP core sitemap
 * ------------------------------------------------------------------------- */

add_filter(
	'robots_txt',
	function ( $output, $public ) {
		if ( ! $public ) {
			return $output;
		}
		$sitemap = home_url( '/wp-sitemap.xml' );
		return "User-agent: *\nDisallow: /wp-admin/\nAllow: /wp-admin/admin-ajax.php\n\nSitemap: {$sitemap}\n";
	},
	10,
	2
);
