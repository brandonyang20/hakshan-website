<?php
/**
 * Outlet custom post type — drives the Outlets page (grid + modal) and the
 * homepage outlets carousel from a single editable source in WP admin.
 *
 * @package Hakshan
 */

defined( 'ABSPATH' ) || exit;

/* ---------------------------------------------------------------------------
 * Post type registration
 * ------------------------------------------------------------------------- */

function hakshan_register_outlet_cpt() {
	register_post_type(
		'outlet',
		array(
			'labels'        => array(
				'name'               => __( 'Outlets', 'hakshan' ),
				'singular_name'      => __( 'Outlet', 'hakshan' ),
				'add_new'            => __( 'Add New Outlet', 'hakshan' ),
				'add_new_item'       => __( 'Add New Outlet', 'hakshan' ),
				'edit_item'          => __( 'Edit Outlet', 'hakshan' ),
				'new_item'           => __( 'New Outlet', 'hakshan' ),
				'view_item'          => __( 'View Outlet', 'hakshan' ),
				'search_items'       => __( 'Search Outlets', 'hakshan' ),
				'not_found'          => __( 'No outlets found.', 'hakshan' ),
				'menu_name'          => __( 'Outlets', 'hakshan' ),
				'all_items'          => __( 'All Outlets', 'hakshan' ),
			),
			'public'              => true,
			'publicly_queryable'  => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'menu_icon'           => 'dashicons-store',
			'menu_position'       => 6,
			'supports'            => array( 'title', 'thumbnail', 'page-attributes' ),
			'has_archive'         => false,
			'rewrite'             => array(
				'slug'       => 'outlets',
				'with_front' => false,
			),
			'exclude_from_search' => false,
		)
	);
}
add_action( 'init', 'hakshan_register_outlet_cpt' );

/**
 * Auto-flush rewrite rules when the theme version changes — the CPT slug
 * went from "no rewrite" to /outlets/{slug}/ in version 1.1.0, and admin
 * users won't think to visit Settings → Permalinks. One-shot per version.
 */
function hakshan_maybe_flush_rewrite() {
	$stored = get_option( 'hakshan_rewrite_version' );
	if ( $stored !== HAKSHAN_THEME_VERSION ) {
		flush_rewrite_rules( false );
		update_option( 'hakshan_rewrite_version', HAKSHAN_THEME_VERSION );
	}
}
add_action( 'init', 'hakshan_maybe_flush_rewrite', 20 );

/* ---------------------------------------------------------------------------
 * Outlet meta box
 * ------------------------------------------------------------------------- */

function hakshan_outlet_field_schema() {
	return array(
		'outlet_cn'    => array(
			'label'       => __( 'Chinese name (display, e.g. 梳 邦 再 也)', 'hakshan' ),
			'type'        => 'text',
			'placeholder' => '梳 邦 再 也',
		),
		'outlet_city'  => array(
			'label'       => __( 'City (uppercase, e.g. SUBANG JAYA)', 'hakshan' ),
			'type'        => 'text',
			'placeholder' => 'SUBANG JAYA',
		),
		'outlet_label' => array(
			'label'       => __( 'Image caption / placeholder label (English, lowercase)', 'hakshan' ),
			'type'        => 'text',
			'placeholder' => 'USJ Taipan · main dining hall, evening',
		),
		'outlet_addr'  => array(
			'label'       => __( 'Full address', 'hakshan' ),
			'type'        => 'textarea',
			'placeholder' => 'Block A, USJ 10 Taipan Business Centre, 47620 Subang Jaya, Selangor',
		),
		'outlet_hours' => array(
			'label'       => __( 'Hours', 'hakshan' ),
			'type'        => 'text',
			'placeholder' => 'Daily 11:00–22:00',
		),
		'outlet_seats' => array(
			'label'       => __( 'Seats / capacity line', 'hakshan' ),
			'type'        => 'text',
			'placeholder' => '120 + private 24 · Charity table',
		),
		'outlet_phone' => array(
			'label'       => __( 'Phone', 'hakshan' ),
			'type'        => 'text',
			'placeholder' => '+60 16-246 2970',
		),
	);
}

function hakshan_add_outlet_meta_box() {
	add_meta_box(
		'hakshan_outlet_fields',
		__( 'Outlet Details', 'hakshan' ),
		'hakshan_render_outlet_meta_box',
		'outlet',
		'normal',
		'high'
	);
}
add_action( 'add_meta_boxes', 'hakshan_add_outlet_meta_box' );

function hakshan_render_outlet_meta_box( $post ) {
	wp_nonce_field( 'hakshan_outlet_fields_save', 'hakshan_outlet_fields_nonce' );

	echo '<style>
		.hakshan-outlet-fields label { display:block; font-weight:600; margin:14px 0 4px; }
		.hakshan-outlet-fields input[type=text],
		.hakshan-outlet-fields textarea { width:100%; }
		.hakshan-outlet-fields textarea { min-height: 60px; }
	</style>';

	echo '<div class="hakshan-outlet-fields">';
	echo '<p class="description">' . esc_html__( 'Post title = English name (e.g. "USJ Taipan"). Featured image = outlet photo. The URL slug is used for anchor links from the homepage carousel (e.g. /outlets#usj); change it carefully via the Permalink field at the top of the page. Use Page Attributes → Order to control position (lower = earlier).', 'hakshan' ) . '</p>';

	foreach ( hakshan_outlet_field_schema() as $key => $field ) {
		$value = get_post_meta( $post->ID, $key, true );
		printf( '<label for="%1$s">%2$s</label>', esc_attr( $key ), esc_html( $field['label'] ) );
		if ( 'textarea' === $field['type'] ) {
			printf(
				'<textarea name="%1$s" id="%1$s" rows="2" placeholder="%2$s">%3$s</textarea>',
				esc_attr( $key ),
				esc_attr( $field['placeholder'] ),
				esc_textarea( $value )
			);
		} else {
			printf(
				'<input type="text" name="%1$s" id="%1$s" value="%2$s" placeholder="%3$s" />',
				esc_attr( $key ),
				esc_attr( $value ),
				esc_attr( $field['placeholder'] )
			);
		}
	}
	echo '</div>';
}

function hakshan_save_outlet_meta( $post_id ) {
	if ( ! isset( $_POST['hakshan_outlet_fields_nonce'] ) ) {
		return;
	}
	if ( ! wp_verify_nonce( sanitize_key( wp_unslash( $_POST['hakshan_outlet_fields_nonce'] ) ), 'hakshan_outlet_fields_save' ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	foreach ( array_keys( hakshan_outlet_field_schema() ) as $key ) {
		if ( isset( $_POST[ $key ] ) ) {
			$raw = wp_unslash( $_POST[ $key ] );
			update_post_meta( $post_id, $key, wp_kses_post( $raw ) );
		}
	}
}
add_action( 'save_post_outlet', 'hakshan_save_outlet_meta' );

/* ---------------------------------------------------------------------------
 * Helpers for templates
 * ------------------------------------------------------------------------- */

/**
 * Return all outlets ordered by menu_order then date.
 *
 * @return WP_Post[]
 */
function hakshan_get_outlets() {
	$query = new WP_Query(
		array(
			'post_type'      => 'outlet',
			'posts_per_page' => -1,
			'orderby'        => array(
				'menu_order' => 'ASC',
				'date'       => 'ASC',
			),
			'no_found_rows'  => true,
		)
	);
	return $query->posts;
}

/**
 * Flatten an outlet post into the array shape the templates use.
 *
 * @param int $post_id Outlet post ID.
 * @return array
 */
function hakshan_get_outlet_data( $post_id ) {
	$post = get_post( $post_id );
	if ( ! $post ) {
		return array();
	}
	return array(
		'id'         => $post_id,
		'slug'       => $post->post_name,
		'name'       => get_the_title( $post_id ),
		'cn'         => get_post_meta( $post_id, 'outlet_cn', true ),
		'city'       => get_post_meta( $post_id, 'outlet_city', true ),
		'label'      => get_post_meta( $post_id, 'outlet_label', true ),
		'addr'       => get_post_meta( $post_id, 'outlet_addr', true ),
		'hours'      => get_post_meta( $post_id, 'outlet_hours', true ),
		'seats'      => get_post_meta( $post_id, 'outlet_seats', true ),
		'phone'      => get_post_meta( $post_id, 'outlet_phone', true ),
		'image_id'   => (int) get_post_thumbnail_id( $post_id ),
		'image_html' => get_the_post_thumbnail( $post_id, 'large' ),
		'image_url'  => get_the_post_thumbnail_url( $post_id, 'large' ),
	);
}

/* ---------------------------------------------------------------------------
 * One-time seeder
 * ------------------------------------------------------------------------- */

function hakshan_seed_outlet_data() {
	if ( get_option( 'hakshan_outlets_seeded' ) ) {
		return;
	}
	if ( ! is_admin() ) {
		return;
	}
	if ( ! post_type_exists( 'outlet' ) ) {
		return;
	}

	$order = 1;
	foreach ( hakshan_outlet_seed_data() as $outlet ) {
		// Skip if an outlet with this slug already exists.
		$existing = get_page_by_path( $outlet['slug'], OBJECT, 'outlet' );
		if ( $existing ) {
			++$order;
			continue;
		}

		$post_id = wp_insert_post(
			array(
				'post_type'   => 'outlet',
				'post_status' => 'publish',
				'post_title'  => $outlet['name'],
				'post_name'   => $outlet['slug'],
				'menu_order'  => $order,
			),
			true
		);
		if ( is_wp_error( $post_id ) || ! $post_id ) {
			++$order;
			continue;
		}

		update_post_meta( $post_id, 'outlet_cn', $outlet['cn'] );
		update_post_meta( $post_id, 'outlet_city', $outlet['city'] );
		update_post_meta( $post_id, 'outlet_label', $outlet['label'] );
		update_post_meta( $post_id, 'outlet_addr', $outlet['addr'] );
		update_post_meta( $post_id, 'outlet_hours', $outlet['hours'] );
		update_post_meta( $post_id, 'outlet_seats', $outlet['seats'] );
		update_post_meta( $post_id, 'outlet_phone', $outlet['phone'] );

		++$order;
	}

	update_option( 'hakshan_outlets_seeded', 1 );
}
add_action( 'admin_init', 'hakshan_seed_outlet_data' );

function hakshan_outlet_seed_data() {
	return array(
		array( 'slug' => 'usj',       'name' => 'USJ Taipan',         'cn' => '梳 邦 再 也',         'city' => 'SUBANG JAYA',  'label' => 'USJ Taipan · main dining hall, evening',
		       'addr' => 'Block A, USJ 10 Taipan Business Centre, 47620 Subang Jaya, Selangor',
		       'hours' => 'Daily 11:00–22:00', 'seats' => '120 + private 24 · Charity table', 'phone' => '+60 16-246 2970' ),
		array( 'slug' => 'menjalara', 'name' => 'Menjalara',          'cn' => '甲 洞 · 满 家 拉',      'city' => 'KEPONG',       'label' => 'Menjalara · entrance and brass signage',
		       'addr' => 'Unit R1-G-3, R1 Gallery, No 10, Jalan Idaman 1/62A, Bandar Menjalara, 52200 KL',
		       'hours' => 'Daily 11:00–22:00', 'seats' => '96 + private 18 · Charity table',  'phone' => '+60 3-6266 3211' ),
		array( 'slug' => 'cheras',    'name' => 'Cheras Traders Sq.', 'cn' => '蕉 赖',               'city' => 'CHERAS',       'label' => 'Cheras Traders Square · open kitchen',
		       'addr' => 'Lot G-32, Cheras Traders Square, Jalan Cheras 56100, Kuala Lumpur',
		       'hours' => 'Daily 11:00–22:00', 'seats' => '110 · Charity table',              'phone' => '+60 3-9101 6622' ),
		array( 'slug' => 'puchong',   'name' => 'Bandar Puteri',      'cn' => '蒲 种',               'city' => 'PUCHONG',      'label' => 'Bandar Puteri Puchong · dining hall',
		       'addr' => '53G, Jalan Puteri 1/4, Bandar Puteri Puchong, 47100 Selangor',
		       'hours' => 'Daily 11:00–22:00', 'seats' => '88 · Charity table',               'phone' => '+60 3-8068 9933' ),
		array( 'slug' => 'conezion',  'name' => 'IOI Conezion',       'cn' => '布 城',               'city' => 'PUTRAJAYA',    'label' => 'IOI Conezion · terrace, evening',
		       'addr' => 'B-G-06, IOI Conezion, Persiaran IRC 3, IOI Resort City, 62502 Putrajaya',
		       'hours' => 'Daily 11:00–22:00', 'seats' => '104 · Charity table',              'phone' => '+60 3-8911 2030' ),
		array( 'slug' => 'kajang',    'name' => 'Budiman Park',       'cn' => '加 影 · 步 帝 文',     'city' => 'KAJANG',       'label' => 'Budiman Park · entrance',
		       'addr' => '23A, Jalan Budiman, Off Jalan Sungai Long, Budiman Business Park, 43000 Kajang',
		       'hours' => 'Daily 11:00–22:00', 'seats' => '72 · Charity table',               'phone' => '+60 3-8732 4567' ),
		array( 'slug' => 'kiara',     'name' => 'Arcoris Plaza',      'cn' => '满 家 乐',             'city' => 'MONT KIARA',   'label' => 'Arcoris Mont Kiara · main hall',
		       'addr' => 'Unit G-16 & G-17, Ground Level, Arcoris Plaza, 10 Jalan Kiara, 50480 Mont Kiara',
		       'hours' => 'Daily 11:00–22:00', 'seats' => '132 + private 28 · Charity table', 'phone' => '+60 3-6203 9988' ),
		array( 'slug' => 'parkcity',  'name' => 'The Waterfront',     'cn' => '公 园 城',             'city' => 'DESA PARKCITY','label' => 'The Waterfront ParkCity · evening',
		       'addr' => 'Lot GF-05, The Waterfront @ ParkCity, Persiaran Residen, 52200 Desa ParkCity',
		       'hours' => 'Daily 11:00–22:00', 'seats' => '92 · Charity table',               'phone' => '+60 3-6280 1100' ),
		array( 'slug' => 'arkadia',   'name' => 'Plaza Arkadia',      'cn' => '阿 卡 迪 亚',          'city' => 'DESA PARKCITY','label' => 'Plaza Arkadia · open kitchen',
		       'addr' => 'Unit F-G-7, Plaza Arkadia, 3 Jalan Intisari Perdana, 52200 Desa ParkCity',
		       'hours' => 'Daily 11:00–22:00', 'seats' => '78 · Charity table',               'phone' => '+60 3-6263 8800' ),
	);
}
