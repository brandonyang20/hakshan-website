<?php
/**
 * Dish custom post type + Menu Section taxonomy.
 *
 * Drives the Menu page sections/dishes and the homepage Signatures carousel
 * from a single editable source in WP admin.
 *
 * @package Hakshan
 */

defined( 'ABSPATH' ) || exit;

/* ---------------------------------------------------------------------------
 * Post type + taxonomy registration
 * ------------------------------------------------------------------------- */

function hakshan_register_dish_cpt() {
	register_post_type(
		'dish',
		array(
			'labels'        => array(
				'name'               => __( 'Menu Dishes', 'hakshan' ),
				'singular_name'      => __( 'Dish', 'hakshan' ),
				'add_new'            => __( 'Add New Dish', 'hakshan' ),
				'add_new_item'       => __( 'Add New Dish', 'hakshan' ),
				'edit_item'          => __( 'Edit Dish', 'hakshan' ),
				'new_item'           => __( 'New Dish', 'hakshan' ),
				'view_item'          => __( 'View Dish', 'hakshan' ),
				'search_items'       => __( 'Search Dishes', 'hakshan' ),
				'not_found'          => __( 'No dishes found.', 'hakshan' ),
				'menu_name'          => __( 'Menu Dishes', 'hakshan' ),
				'all_items'          => __( 'All Dishes', 'hakshan' ),
			),
			'public'        => false,
			'show_ui'       => true,
			'show_in_menu'  => true,
			'menu_icon'     => 'dashicons-food',
			'menu_position' => 5,
			'supports'      => array( 'title', 'thumbnail', 'page-attributes' ),
			'has_archive'   => false,
			'rewrite'       => false,
		)
	);
}
add_action( 'init', 'hakshan_register_dish_cpt' );

function hakshan_register_dish_section_tax() {
	register_taxonomy(
		'dish_section',
		'dish',
		array(
			'labels'            => array(
				'name'          => __( 'Menu Sections', 'hakshan' ),
				'singular_name' => __( 'Menu Section', 'hakshan' ),
				'add_new_item'  => __( 'Add Menu Section', 'hakshan' ),
				'edit_item'     => __( 'Edit Menu Section', 'hakshan' ),
				'all_items'     => __( 'All Sections', 'hakshan' ),
				'menu_name'     => __( 'Sections', 'hakshan' ),
			),
			'public'            => false,
			'show_ui'           => true,
			'show_admin_column' => true,
			'hierarchical'      => false,
			'rewrite'           => false,
			'meta_box_cb'       => 'hakshan_dish_section_metabox',
			'show_in_rest'      => false,
		)
	);
}
add_action( 'init', 'hakshan_register_dish_section_tax' );

/* ---------------------------------------------------------------------------
 * Section single-select metabox (replaces the default checkbox UI)
 * ------------------------------------------------------------------------- */

function hakshan_dish_section_metabox( $post ) {
	$terms   = get_terms(
		array(
			'taxonomy'   => 'dish_section',
			'hide_empty' => false,
		)
	);
	$current = wp_get_object_terms( $post->ID, 'dish_section', array( 'fields' => 'ids' ) );
	$current = ( ! is_wp_error( $current ) && ! empty( $current ) ) ? (int) $current[0] : 0;

	wp_nonce_field( 'hakshan_dish_section_save', 'hakshan_dish_section_nonce' );

	if ( is_wp_error( $terms ) || empty( $terms ) ) {
		echo '<p>' . esc_html__( 'No menu sections yet. Add one under Menu Dishes → Sections.', 'hakshan' ) . '</p>';
		return;
	}

	// Sort by sort_order term meta if available.
	usort(
		$terms,
		static function ( $a, $b ) {
			$oa = (int) get_term_meta( $a->term_id, 'sort_order', true );
			$ob = (int) get_term_meta( $b->term_id, 'sort_order', true );
			return $oa <=> $ob;
		}
	);

	echo '<select name="hakshan_dish_section" style="width:100%;">';
	echo '<option value="">' . esc_html__( 'Select section…', 'hakshan' ) . '</option>';
	foreach ( $terms as $term ) {
		printf(
			'<option value="%d"%s>%s</option>',
			(int) $term->term_id,
			selected( $current, $term->term_id, false ),
			esc_html( $term->name )
		);
	}
	echo '</select>';
}

function hakshan_save_dish_section( $post_id ) {
	if ( ! isset( $_POST['hakshan_dish_section_nonce'] ) ) {
		return;
	}
	if ( ! wp_verify_nonce( sanitize_key( wp_unslash( $_POST['hakshan_dish_section_nonce'] ) ), 'hakshan_dish_section_save' ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	$term_id = isset( $_POST['hakshan_dish_section'] ) ? (int) $_POST['hakshan_dish_section'] : 0;
	if ( $term_id > 0 ) {
		wp_set_object_terms( $post_id, array( $term_id ), 'dish_section', false );
	} else {
		wp_set_object_terms( $post_id, array(), 'dish_section', false );
	}
}
add_action( 'save_post_dish', 'hakshan_save_dish_section' );

/* ---------------------------------------------------------------------------
 * Dish meta box (bilingual names + descriptions + caption)
 * ------------------------------------------------------------------------- */

function hakshan_dish_field_schema() {
	return array(
		'dish_zh'           => array(
			'label'       => __( 'Chinese name, display (e.g. 盐 焗 鸡)', 'hakshan' ),
			'type'        => 'text',
			'placeholder' => '盐 焗 鸡',
		),
		'dish_label'        => array(
			'label'       => __( 'Image caption / placeholder label (English, lowercase)', 'hakshan' ),
			'type'        => 'text',
			'placeholder' => 'mui choy pork belly · clay pot',
		),
		'dish_desc_en'      => array(
			'label'       => __( 'Description (English)', 'hakshan' ),
			'type'        => 'textarea',
			'placeholder' => '',
		),
		'dish_desc_zh'      => array(
			'label'       => __( 'Description (Chinese)', 'hakshan' ),
			'type'        => 'textarea',
			'placeholder' => '',
		),
		'dish_price_normal' => array(
			'label'       => __( 'Price, normal (e.g. RM 18). Shown struck-through if a member price is also set.', 'hakshan' ),
			'type'        => 'text',
			'placeholder' => 'RM 18',
		),
		'dish_price_member' => array(
			'label'       => __( 'Price, member (e.g. RM 15). Highlighted as the active price. Leave empty if the dish has no member discount.', 'hakshan' ),
			'type'        => 'text',
			'placeholder' => 'RM 15',
		),
	);
}

function hakshan_add_dish_meta_box() {
	add_meta_box(
		'hakshan_dish_fields',
		__( 'Dish Details', 'hakshan' ),
		'hakshan_render_dish_meta_box',
		'dish',
		'normal',
		'high'
	);
}
add_action( 'add_meta_boxes', 'hakshan_add_dish_meta_box' );

function hakshan_render_dish_meta_box( $post ) {
	wp_nonce_field( 'hakshan_dish_fields_save', 'hakshan_dish_fields_nonce' );

	echo '<style>
		.hakshan-dish-fields label { display:block; font-weight:600; margin:14px 0 4px; }
		.hakshan-dish-fields input[type=text],
		.hakshan-dish-fields textarea { width:100%; }
		.hakshan-dish-fields textarea { min-height: 70px; }
	</style>';

	echo '<div class="hakshan-dish-fields">';
	echo '<p class="description">' . esc_html__( 'The post title above is used as the English name. Featured image becomes the dish photo. Use the "Order" field under Page Attributes (in the sidebar) to control position within a section. Lower numbers appear first.', 'hakshan' ) . '</p>';

	foreach ( hakshan_dish_field_schema() as $key => $field ) {
		$value = get_post_meta( $post->ID, $key, true );
		printf(
			'<label for="%1$s">%2$s</label>',
			esc_attr( $key ),
			esc_html( $field['label'] )
		);
		if ( 'textarea' === $field['type'] ) {
			printf(
				'<textarea name="%1$s" id="%1$s" rows="3" placeholder="%2$s">%3$s</textarea>',
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

function hakshan_save_dish_meta( $post_id ) {
	if ( ! isset( $_POST['hakshan_dish_fields_nonce'] ) ) {
		return;
	}
	if ( ! wp_verify_nonce( sanitize_key( wp_unslash( $_POST['hakshan_dish_fields_nonce'] ) ), 'hakshan_dish_fields_save' ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	foreach ( array_keys( hakshan_dish_field_schema() ) as $key ) {
		if ( isset( $_POST[ $key ] ) ) {
			$raw = wp_unslash( $_POST[ $key ] );
			update_post_meta( $post_id, $key, wp_kses_post( $raw ) );
		}
	}
}
add_action( 'save_post_dish', 'hakshan_save_dish_meta' );

/* ---------------------------------------------------------------------------
 * Section term meta (bilingual title + lead + sort order)
 * ------------------------------------------------------------------------- */

function hakshan_section_term_field_schema() {
	return array(
		'title_zh'   => __( 'Title, Chinese (display, e.g. 招 牌)', 'hakshan' ),
		'title_cn'   => __( 'Title, Chinese (compact)', 'hakshan' ),
		'ch'         => __( 'Eyebrow label (small Chinese above title, e.g. 招 牌)', 'hakshan' ),
		'lead_en'    => __( 'Lead paragraph (English)', 'hakshan' ),
		'lead_zh'    => __( 'Lead paragraph (Chinese)', 'hakshan' ),
		'sort_order' => __( 'Sort order (lower = earlier; e.g. 1, 2, 3)', 'hakshan' ),
	);
}

function hakshan_section_add_meta_fields() {
	foreach ( hakshan_section_term_field_schema() as $key => $label ) {
		$is_textarea = in_array( $key, array( 'lead_en', 'lead_zh' ), true );
		echo '<div class="form-field">';
		printf( '<label for="%1$s">%2$s</label>', esc_attr( $key ), esc_html( $label ) );
		if ( $is_textarea ) {
			printf( '<textarea name="%1$s" id="%1$s" rows="3"></textarea>', esc_attr( $key ) );
		} else {
			printf( '<input type="text" name="%1$s" id="%1$s" value="" />', esc_attr( $key ) );
		}
		echo '</div>';
	}
}
add_action( 'dish_section_add_form_fields', 'hakshan_section_add_meta_fields' );

function hakshan_section_edit_meta_fields( $term ) {
	foreach ( hakshan_section_term_field_schema() as $key => $label ) {
		$value       = get_term_meta( $term->term_id, $key, true );
		$is_textarea = in_array( $key, array( 'lead_en', 'lead_zh' ), true );
		echo '<tr class="form-field">';
		printf( '<th scope="row"><label for="%1$s">%2$s</label></th>', esc_attr( $key ), esc_html( $label ) );
		echo '<td>';
		if ( $is_textarea ) {
			printf(
				'<textarea name="%1$s" id="%1$s" rows="3">%2$s</textarea>',
				esc_attr( $key ),
				esc_textarea( $value )
			);
		} else {
			printf(
				'<input type="text" name="%1$s" id="%1$s" value="%2$s" />',
				esc_attr( $key ),
				esc_attr( $value )
			);
		}
		echo '</td></tr>';
	}
}
add_action( 'dish_section_edit_form_fields', 'hakshan_section_edit_meta_fields' );

function hakshan_save_section_meta( $term_id ) {
	if ( ! current_user_can( 'manage_categories' ) ) {
		return;
	}
	foreach ( array_keys( hakshan_section_term_field_schema() ) as $key ) {
		if ( isset( $_POST[ $key ] ) ) {
			$raw = wp_unslash( $_POST[ $key ] );
			update_term_meta( $term_id, $key, wp_kses_post( $raw ) );
		}
	}
}
add_action( 'edited_dish_section', 'hakshan_save_section_meta' );
add_action( 'create_dish_section', 'hakshan_save_section_meta' );

/* ---------------------------------------------------------------------------
 * Helpers — query menu sections + dishes for templates
 * ------------------------------------------------------------------------- */

/**
 * Return the ordered list of section terms.
 *
 * @return WP_Term[]
 */
function hakshan_get_menu_sections() {
	$terms = get_terms(
		array(
			'taxonomy'   => 'dish_section',
			'hide_empty' => false,
		)
	);
	if ( is_wp_error( $terms ) || empty( $terms ) ) {
		return array();
	}
	usort(
		$terms,
		static function ( $a, $b ) {
			$oa = (int) get_term_meta( $a->term_id, 'sort_order', true );
			$ob = (int) get_term_meta( $b->term_id, 'sort_order', true );
			if ( $oa === $ob ) {
				return strcmp( $a->name, $b->name );
			}
			return $oa <=> $ob;
		}
	);
	return $terms;
}

/**
 * Get dishes belonging to a section term, ordered by menu_order.
 *
 * @param int $term_id Section term ID.
 * @param int $limit   Max items, -1 for all.
 * @return WP_Post[]
 */
function hakshan_get_dishes_for_section( $term_id, $limit = -1 ) {
	$query = new WP_Query(
		array(
			'post_type'      => 'dish',
			'posts_per_page' => $limit,
			'orderby'        => array(
				'menu_order' => 'ASC',
				'date'       => 'ASC',
			),
			'tax_query'      => array(
				array(
					'taxonomy' => 'dish_section',
					'field'    => 'term_id',
					'terms'    => (int) $term_id,
				),
			),
			'no_found_rows'  => true,
		)
	);
	return $query->posts;
}

/**
 * Get the dishes for the homepage carousel. The category is picked
 * in Customizer (Homepage Sections → Signatures carousel category).
 * "auto" preserves the original behaviour of finding a "Signatures"
 * section by slug or name.
 *
 * @param int $limit Max items.
 * @return WP_Post[]
 */
function hakshan_get_signature_dishes( $limit = 6 ) {
	$chosen = function_exists( 'get_theme_mod' )
		? get_theme_mod( 'hakshan_signatures_section', 'auto' )
		: 'auto';

	if ( $chosen && 'auto' !== $chosen ) {
		$picked = get_term_by( 'slug', $chosen, 'dish_section' );
		if ( $picked && ! is_wp_error( $picked ) ) {
			$picked_posts = hakshan_get_dishes_for_section( $picked->term_id, $limit );
			if ( ! empty( $picked_posts ) ) {
				return $picked_posts;
			}
		}
	}

	$term = get_term_by( 'slug', 'signatures', 'dish_section' );

	if ( ! $term || is_wp_error( $term ) ) {
		$candidates = get_terms(
			array(
				'taxonomy'   => 'dish_section',
				'hide_empty' => false,
			)
		);
		if ( ! is_wp_error( $candidates ) ) {
			foreach ( $candidates as $candidate ) {
				$slug_match = ( 0 === strpos( $candidate->slug, 'signature' ) );
				$name_match = ( false !== stripos( $candidate->name, 'signature' ) )
					|| ( false !== strpos( $candidate->name, '招牌' ) );
				if ( $slug_match || $name_match ) {
					$term = $candidate;
					break;
				}
			}
		}
	}

	if ( $term && ! is_wp_error( $term ) ) {
		$posts = hakshan_get_dishes_for_section( $term->term_id, $limit );
		if ( ! empty( $posts ) ) {
			return $posts;
		}
	}

	// Final fallback: first N dishes by menu_order, so the carousel reflects
	// live CPT content even when no section matches "signatures".
	$query = new WP_Query(
		array(
			'post_type'      => 'dish',
			'posts_per_page' => $limit,
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
 * Pull all the bilingual fields for a dish as a flat array.
 *
 * @param int $post_id Dish post ID.
 * @return array
 */
function hakshan_get_dish_data( $post_id ) {
	return array(
		'en'           => get_the_title( $post_id ),
		'zh'           => get_post_meta( $post_id, 'dish_zh', true ),
		'cn'           => get_post_meta( $post_id, 'dish_cn', true ),
		'label'        => get_post_meta( $post_id, 'dish_label', true ),
		'desc_en'      => get_post_meta( $post_id, 'dish_desc_en', true ),
		'desc_zh'      => get_post_meta( $post_id, 'dish_desc_zh', true ),
		'price_normal' => get_post_meta( $post_id, 'dish_price_normal', true ),
		'price_member' => get_post_meta( $post_id, 'dish_price_member', true ),
		'image_id'     => (int) get_post_thumbnail_id( $post_id ),
		'image_html'   => get_the_post_thumbnail( $post_id, 'large' ),
	);
}

/* ---------------------------------------------------------------------------
 * One-time seeder — load existing menu content on first run
 * ------------------------------------------------------------------------- */

function hakshan_seed_menu_data() {
	if ( get_option( 'hakshan_menu_seeded' ) ) {
		return;
	}
	// Only run in admin to avoid affecting front-end requests.
	if ( ! is_admin() ) {
		return;
	}
	// Wait until our post type/taxonomy are registered.
	if ( ! post_type_exists( 'dish' ) || ! taxonomy_exists( 'dish_section' ) ) {
		return;
	}

	$sections = hakshan_menu_seed_data();
	$order    = 1;

	foreach ( $sections as $slug => $section ) {
		$existing = get_term_by( 'slug', $slug, 'dish_section' );
		if ( $existing ) {
			$term_id = (int) $existing->term_id;
		} else {
			$created = wp_insert_term(
				$section['title_en'],
				'dish_section',
				array(
					'slug'        => $slug,
					'description' => $section['lead_en'],
				)
			);
			if ( is_wp_error( $created ) ) {
				continue;
			}
			$term_id = (int) $created['term_id'];
		}

		update_term_meta( $term_id, 'title_zh', $section['title_zh'] );
		update_term_meta( $term_id, 'title_cn', $section['title_cn'] );
		update_term_meta( $term_id, 'ch', $section['ch'] );
		update_term_meta( $term_id, 'lead_en', $section['lead_en'] );
		update_term_meta( $term_id, 'lead_zh', $section['lead_zh'] );
		update_term_meta( $term_id, 'sort_order', $order );
		++$order;

		$dish_order = 1;
		foreach ( $section['dishes'] as $dish ) {
			// Skip if a dish with this exact title already exists in this section.
			$exists = get_posts(
				array(
					'post_type'      => 'dish',
					'post_status'    => 'any',
					'title'          => $dish['en'],
					'posts_per_page' => 1,
					'fields'         => 'ids',
					'tax_query'      => array(
						array(
							'taxonomy' => 'dish_section',
							'field'    => 'term_id',
							'terms'    => $term_id,
						),
					),
				)
			);
			if ( ! empty( $exists ) ) {
				++$dish_order;
				continue;
			}

			$post_id = wp_insert_post(
				array(
					'post_type'   => 'dish',
					'post_status' => 'publish',
					'post_title'  => $dish['en'],
					'menu_order'  => $dish_order,
				),
				true
			);
			if ( is_wp_error( $post_id ) || ! $post_id ) {
				continue;
			}

			update_post_meta( $post_id, 'dish_zh', $dish['zh'] );
			update_post_meta( $post_id, 'dish_cn', $dish['cn'] );
			update_post_meta( $post_id, 'dish_label', $dish['label'] );
			update_post_meta( $post_id, 'dish_desc_en', $dish['desc_en'] );
			update_post_meta( $post_id, 'dish_desc_zh', $dish['desc_zh'] );
			wp_set_object_terms( $post_id, array( $term_id ), 'dish_section', false );

			++$dish_order;
		}
	}

	update_option( 'hakshan_menu_seeded', 1 );
}
add_action( 'admin_init', 'hakshan_seed_menu_data' );

/**
 * Raw seed data — mirrors the previous hardcoded arrays in page-menu.php
 * and front-page.php so the site keeps its existing content after switch-over.
 */
function hakshan_menu_seed_data() {
	return array(
		'signatures' => array(
			'title_en' => 'Signatures',
			'title_zh' => '招 牌 菜',
			'title_cn' => '招 牌',
			'ch'       => '招 牌',
			'lead_en'  => "Six dishes the kitchen will never take off the menu. Ah Por's six.",
			'lead_zh'  => '六道我们永远不会下架的菜，阿婆留下的六道。',
			'dishes'   => array(
				array( 'label' => 'drunken chicken with rice wine', 'en' => 'Drunken Chicken with Rice Wine', 'zh' => '黄 酒 醉 鸡', 'cn' => '醉 鸡', 'desc_en' => 'Chicken thigh infused with rice wine, ginger, wood ear, served warm.', 'desc_zh' => '鸡 腿 用 黄 酒 浸 透，姜、木 耳 同 焖，温 暖 上 桌。' ),
				array( 'label' => 'mui choy kau yuk · braised pork belly',     'en' => 'Mui Choy Pork Belly',          'zh' => '梅 菜 扣 肉', 'cn' => '梅 菜 扣 肉',       'desc_en' => 'Five-spice belly steamed with pickled mustard greens, the way Ah Por taught it.', 'desc_zh' => '五 香 三 层 肉，与 阿 婆 腌 的 梅 干 菜 同 蒸。' ),
				array( 'label' => 'abacus seeds · suan pan zi',                'en' => 'Abacus Seeds',                 'zh' => '算 盘 子',     'cn' => '算 盘 子',         'desc_en' => 'Taro and tapioca, pinched by hand. Chewy at the centre, savoury at the edge.', 'desc_zh' => '芋 头 与 木 薯，一 颗 颗 手 捏，中 心 软 糯，边 缘 咸 香。' ),
				array( 'label' => 'lei cha · thunder tea rice',                'en' => 'Thunder Tea Rice',             'zh' => '擂 茶 饭',     'cn' => '擂 茶 饭',         'desc_en' => 'Twelve herbs, ground in a wooden mortar. A bowl that drinks like a meal.', 'desc_zh' => '十 二 种 香 草，杵 臼 现 磨。一 碗 茶，也 是 一 顿 饭。' ),
				array( 'label' => 'ginger-sprout braised duck',                'en' => 'Ginger-Sprout Braised Duck',   'zh' => '姜 芽 焖 鸭', 'cn' => '姜 芽 焖 鸭',       'desc_en' => 'Three hours on low flame, young ginger sprouts, dark caramel sauce.', 'desc_zh' => '三 小 时 慢 火，姜 芽 爆 香，老 抽 收 汁。' ),
				array( 'label' => 'rice-wine chicken soup · clay pot',         'en' => 'Rice-Wine Chicken Soup',       'zh' => '糯 米 酒 鸡 汤', 'cn' => '糯 米 酒 鸡 汤',  'desc_en' => 'Glutinous rice wine, kampung chicken, ginger, sesame oil.', 'desc_zh' => '糯 米 酒、甘 榜 鸡、老 姜、麻 油。' ),
			),
		),
		'chicken'    => array(
			'title_en' => 'Salt & Smoke',
			'title_zh' => '盐 与 烟',
			'title_cn' => '盐 烟',
			'ch'       => '盐 与 烟',
			'lead_en'  => 'What the Hakka did when there was no fridge.',
			'lead_zh'  => '客家人在没有冰箱年代留下来的味道。',
			'dishes'   => array(
				array( 'label' => 'hakka trio-sauce chicken', 'en' => 'Hakka Trio-Sauce Chicken', 'zh' => '客 家 三 杯 鸡', 'cn' => '三 杯 鸡',   'desc_en' => 'Rice wine, soy, sesame oil. Equal parts.', 'desc_zh' => '米 酒、生 抽、麻 油 等 量。' ),
				array( 'label' => 'smoked five-spice duck',   'en' => 'Smoked Five-Spice Duck',   'zh' => '五 香 烟 熏 鸭', 'cn' => '烟 熏 鸭',   'desc_en' => 'Brined 24 hours, smoked over tea leaves and brown sugar.', 'desc_zh' => '24 小 时 盐 渍，茶 叶 红 糖 熏 制。' ),
				array( 'label' => 'cured pork hash · sliced', 'en' => 'Cured Pork Hash',          'zh' => '客 家 咸 肉',    'cn' => '咸 肉',     'desc_en' => 'Air-cured 14 days, sliced and steamed over rice.', 'desc_zh' => '风 干 14 天，切 片，米 饭 上 同 蒸。' ),
				array( 'label' => 'salt-crusted sea bass',    'en' => 'Salt-Crusted Sea Bass',    'zh' => '盐 焗 鲈 鱼',    'cn' => '盐 焗 鲈 鱼', 'desc_en' => 'Whole fish in a sea-salt crust, broken at the table.', 'desc_zh' => '整 条 鲈 鱼 海 盐 封 皮，桌 边 敲 开。' ),
			),
		),
		'braised'    => array(
			'title_en' => 'Braised & Stewed',
			'title_zh' => '焖 与 炖',
			'title_cn' => '焖 炖',
			'ch'       => '焖 与 炖',
			'lead_en'  => 'Dishes that benefit from being made the day before.',
			'lead_zh'  => '过夜更入味的那一类。',
			'dishes'   => array(
				array( 'label' => 'pork trotter · vinegar & ginger',  'en' => 'Pork Trotter, Vinegar & Ginger', 'zh' => '姜 醋 猪 脚', 'cn' => '姜 醋 猪 脚', 'desc_en' => 'Sweet black vinegar, old ginger, hard-boiled egg.', 'desc_zh' => '甜 醋、老 姜、白 煮 蛋。' ),
				array( 'label' => 'wild boar curry · dry style',      'en' => 'Wild Boar Curry',                'zh' => '野 猪 咖 喱', 'cn' => '山 猪 咖 喱', 'desc_en' => 'Pahang wild boar, Hakka-style dry curry.', 'desc_zh' => '彭 亨 山 猪，客 家 干 咖 喱。' ),
				array( 'label' => 'stewed tripe & tendon · clay pot', 'en' => 'Stewed Tripe & Tendon',          'zh' => '牛 杂 煲',    'cn' => '牛 杂 煲',   'desc_en' => 'Three hours, white peppercorns, daikon, charred ginger.', 'desc_zh' => '三 小 时 白 胡 椒 粒、白 萝 卜、烤 姜 同 煲。' ),
				array( 'label' => 'red wine lees pork · crisp',       'en' => 'Red Wine Lees Pork',             'zh' => '红 糟 肉',    'cn' => '红 糟 肉',   'desc_en' => 'Pork shoulder marinated in red rice-wine lees, pan-fried crisp.', 'desc_zh' => '红 糟 腌 猪 肩 肉，干 煎 酥 脆。' ),
			),
		),
		'yong'       => array(
			'title_en' => 'Yong Tau Foo',
			'title_zh' => '酿 豆 腐',
			'title_cn' => '酿 豆 腐',
			'ch'       => '酿 豆 腐',
			'lead_en'  => 'Fish paste pounded by hand at 6am. Stuffed by 10am. Sold out by 9pm.',
			'lead_zh'  => '清晨六点手工捶打鱼浆，十点酿好，晚上九点前卖完。',
			'dishes'   => array(
				array( 'label' => 'trio yong tau foo',         'en' => 'Trio Yong Tau Foo',         'zh' => '三 宝 酿 豆 腐', 'cn' => '三 宝',     'desc_en' => 'Bitter gourd, soft tofu, fried tofu in fish-bone broth.', 'desc_zh' => '苦 瓜、嫩 豆 腐、豆 卜，配 鱼 骨 清 汤。' ),
				array( 'label' => 'seven-piece yong tau foo',  'en' => 'Seven-Piece Yong Tau Foo',  'zh' => '七 宝 酿 豆 腐', 'cn' => '七 宝',     'desc_en' => "Brinjal, chilli, lady's finger, mushroom & the trio.", 'desc_zh' => '茄 子、辣 椒、羊 角 豆、香 菇 与 三 宝 同 碗。' ),
				array( 'label' => 'stuffed fried tofu skin',   'en' => 'Stuffed Fried Tofu Skin',   'zh' => '酿 腐 皮',       'cn' => '酿 腐 皮',  'desc_en' => 'Fish paste, water chestnut, scallion, in a crisp tofu-skin pouch.', 'desc_zh' => '鱼 浆、马 蹄、青 葱，包 入 酥 脆 腐 皮。' ),
				array( 'label' => 'yong foo hot pot',          'en' => 'Yong Foo Hot Pot',          'zh' => '客 家 酿 煲',    'cn' => '酿 煲',    'desc_en' => 'Clay pot, ten pieces, dark soy, scallion oil.', 'desc_zh' => '砂 锅 装，十 件，老 抽 与 葱 油。' ),
			),
		),
		'rice'       => array(
			'title_en' => 'Rice & Noodles',
			'title_zh' => '饭 与 面',
			'title_cn' => '饭 面',
			'ch'       => '饭 与 面',
			'lead_en'  => 'Wheat for cold days, rice for everything else.',
			'lead_zh'  => '冷天吃麦，其他时候吃饭。',
			'dishes'   => array(
				array( 'label' => 'ginger-sprout duck rice', 'en' => 'Ginger-Sprout Duck Rice', 'zh' => '姜 芽 焖 鸭 饭', 'cn' => '姜 芽 鸭 饭', 'desc_en' => 'The signature, in a single bowl.', 'desc_zh' => '招 牌 一 份，一 人 份。' ),
				array( 'label' => 'hakka pan mee',           'en' => 'Hakka Pan Mee',           'zh' => '客 家 板 面',    'cn' => '板 面',     'desc_en' => 'Hand-torn noodles, minced pork, anchovies, sweet potato leaves.', 'desc_zh' => '手 撕 面，肉 碎、江 鱼 仔、番 薯 叶。' ),
				array( 'label' => 'char yoke rice',          'en' => 'Char Yoke Rice',          'zh' => '炸 肉 饭',       'cn' => '炸 肉 饭',  'desc_en' => 'Five-spice deep-fried pork, scallion ginger sauce, rice.', 'desc_zh' => '五 香 炸 肉，葱 姜 酱，配 饭。' ),
				array( 'label' => 'hakka mee suah',          'en' => 'Hakka Mee Suah',          'zh' => '客 家 面 线',    'cn' => '面 线',     'desc_en' => 'Thin wheat noodles, pork lard, white pepper soup.', 'desc_zh' => '细 面 线，猪 油 渣，白 胡 椒 清 汤。' ),
			),
		),
		'soup'       => array(
			'title_en' => 'Soups & Wines',
			'title_zh' => '汤 与 酒',
			'title_cn' => '汤 酒',
			'ch'       => '汤 与 酒',
			'lead_en'  => 'Hakka women drank rice wine against the cold. Hakka men drank it too, just less honestly.',
			'lead_zh'  => '客家妇女用米酒驱寒，客家男人也喝，只是没那么坦白。',
			'dishes'   => array(
				array( 'label' => 'old cucumber & pork soup', 'en' => 'Old Cucumber, Pork & Honey Date Soup', 'zh' => '老 黄 瓜 煲',     'cn' => '老 黄 瓜',     'desc_en' => 'Four hours simmer.', 'desc_zh' => '慢 炖 四 小 时，两 人 份 砂 锅。' ),
				array( 'label' => 'black chicken & dang gui', 'en' => 'Black Chicken & Dang Gui',             'zh' => '当 归 乌 鸡',     'cn' => '当 归 乌 鸡', 'desc_en' => 'Restorative double-boiled soup, ten ingredients.', 'desc_zh' => '十 味 当 归 乌 鸡 炖 汤。' ),
				array( 'label' => 'house rice wine, warm',    'en' => 'House Rice Wine, warm',                'zh' => '糯 米 酒（温）', 'cn' => '糯 米 酒',     'desc_en' => 'Fermented in-house, served at 50°C in a clay cup.', 'desc_zh' => '自 家 发 酵，砂 杯 温 至 50°C 上 桌。' ),
				array( 'label' => 'aged pu-erh tea',          'en' => 'Aged Tea, by the pot',                 'zh' => '老 茶 一 壶',     'cn' => '老 茶',         'desc_en' => 'Pu-erh, 12 years. Refilled freely.', 'desc_zh' => '普 洱，12 年。免 费 续 壶。' ),
			),
		),
		'sweet'      => array(
			'title_en' => 'Sweet',
			'title_zh' => '甜 品',
			'title_cn' => '甜',
			'ch'       => '甜 品',
			'lead_en'  => 'Three options. Two of them are warm.',
			'lead_zh'  => '三种甜，其中两种是热的。',
			'dishes'   => array(
				array( 'label' => 'black sesame tang yuan',   'en' => 'Black Sesame Tang Yuan',     'zh' => '黑 芝 麻 汤 圆', 'cn' => '汤 圆',       'desc_en' => 'Hand-rolled, ginger syrup.', 'desc_zh' => '手 工 汤 圆，姜 糖 水。' ),
				array( 'label' => 'steamed honey cake',       'en' => 'Steamed Honey Cake',         'zh' => '蒸 蜂 蜜 糕',    'cn' => '蜂 蜜 糕',    'desc_en' => 'Brown sugar, eight-hour steam.', 'desc_zh' => '红 糖，蒸 八 小 时。' ),
				array( 'label' => 'iced soya bean & cincau',  'en' => 'Iced Soya Bean & Cincau',    'zh' => '豆 奶 仙 草',    'cn' => '豆 奶 仙 草', 'desc_en' => 'House-made soya milk, grass jelly, palm sugar.', 'desc_zh' => '自 家 豆 浆、仙 草、椰 糖。' ),
			),
		),
	);
}

/**
 * One-time import (Oct 2026): dishes sold in the POS but missing from the
 * website menu. Created as DRAFTS on the next wp-admin load so photos can be
 * added and copy checked before publishing. Skips any dish whose Chinese name
 * already exists (any status), so it never duplicates. Matches the live menu
 * convention: Chinese description only, no prices.
 */
function hakshan_import_missing_dishes_2026_10() {
	if ( get_option( 'hakshan_dishes_import_2026_10' ) || ! current_user_can( 'edit_posts' ) ) {
		return;
	}
	$dishes = array(
		array( 'new-dish', 'Dragon Chives with Shimeji Mushrooms', '蒜香青龙菜炒白玉菇', '青龙菜清脆鲜嫩，配上白玉菇大火快炒，蒜香扑鼻，口感爽脆中带着菇香，清爽又下饭。' ),
		array( 'new-dish', 'Claypot Curry Mixed Vegetables', '咖哩鲜蔬煲', '多种新鲜时蔬以香浓咖哩慢煮入味，瓦煲上桌热气腾腾，微辣浓郁，配饭一流。' ),
		array( 'new-dish', 'Golden Salted Egg Bitter Gourd', '金沙苦瓜王', '苦瓜裹上金黄咸蛋酱，外层咸香酥脆，入口带着淡淡甘苦回甘，越吃越停不下来。' ),
		array( 'new-dish', 'Bok Choy with Garlic', '蒜香清炒奶白菜', '嫩滑奶白菜加蒜蓉快炒，保留蔬菜原有的清甜，简单清爽，是餐桌上少不了的一道时蔬。' ),
		array( 'new-dish', 'Traditional Hakka Stir-Fry', '客家风味小炒', '传承客家家常小炒做法，多种食材大火爆炒，锅气十足，咸香惹味，最适合配一碗白饭。' ),
		array( 'new-dish', 'Hakka Pork with Leeks', '客家咸香肉', '咸香猪肉配上蒜苗同炒，肉香咸鲜入味，蒜苗清香爽口，是道地的客家下饭菜。' ),
		array( 'new-dish', 'Pan-Seared Grouper with Superior Soy Sauce', '半煎焗石班魚', '石斑鱼半煎至外皮金香，再淋上特制豉油焗香，鱼肉鲜嫩多汁，酱香浓郁。' ),
		array( 'vegetable-tofu', 'Stir-Fry Water Spinach', '清炒空心菜', '新鲜空心菜大火清炒，翠绿爽脆，带着淡淡蒜香，清爽开胃。' ),
		array( 'vegetable-tofu', 'Choy Sum With Scallion', '葱油菜心', '嫩菜心淋上香葱热油，清甜爽口，葱香四溢，简单却很耐吃。' ),
	);
	$order = 900;
	foreach ( $dishes as $d ) {
		list( $section, $en, $zh, $desc_zh ) = $d;
		$order++;
		$exists = get_posts(
			array(
				'post_type'      => 'dish',
				'post_status'    => 'any',
				'posts_per_page' => 1,
				'fields'         => 'ids',
				'meta_key'       => 'dish_zh', // phpcs:ignore WordPress.DB.SlowDBQuery
				'meta_value'     => $zh,       // phpcs:ignore WordPress.DB.SlowDBQuery
			)
		);
		if ( $exists ) {
			continue;
		}
		$post_id = wp_insert_post(
			array(
				'post_type'   => 'dish',
				'post_status' => 'draft',
				'post_title'  => $en,
				'menu_order'  => $order,
				'meta_input'  => array(
					'dish_zh'      => $zh,
					'dish_label'   => strtolower( $en ),
					'dish_desc_en' => '',
					'dish_desc_zh' => $desc_zh,
				),
			),
			true
		);
		if ( is_wp_error( $post_id ) ) {
			continue;
		}
		$term = get_term_by( 'slug', $section, 'dish_section' );
		if ( $term && ! is_wp_error( $term ) ) {
			wp_set_object_terms( $post_id, array( (int) $term->term_id ), 'dish_section', false );
		}
	}
	update_option( 'hakshan_dishes_import_2026_10', 1 );
}
add_action( 'admin_init', 'hakshan_import_missing_dishes_2026_10', 20 );

/**
 * One-time: pull photos for the Oct 2026 dishes from the POS (FeedMe) and set
 * them as featured images. Matched by dish_zh; dishes that already have a
 * featured image are left alone. Retries (at most every 10 min) until all done.
 */
function hakshan_import_dish_photos_2026_10() {
	if ( get_option( 'hakshan_dish_photos_2026_10' ) || ! current_user_can( 'upload_files' ) || get_transient( 'hakshan_dish_photos_2026_10_lock' ) ) {
		return;
	}
	set_transient( 'hakshan_dish_photos_2026_10_lock', 1, 10 * MINUTE_IN_SECONDS );

	require_once ABSPATH . 'wp-admin/includes/file.php';
	require_once ABSPATH . 'wp-admin/includes/media.php';
	require_once ABSPATH . 'wp-admin/includes/image.php';

	$base   = 'https://image.feedme.cc/';
	$photos = array( /* dish_zh => FeedMe path */
		'蒜香青龙菜炒白玉菇' => 'menu/699d5da687c570001c7a9840/item_2026_08_11T13_19_47_036Z_kbd3ow_msooyevz',
		'咖哩鲜蔬煲'       => 'menu/699d5da687c570001c7a9840/item_2026_08_11T13_15_19_396Z_hhprw0_msooxg8i',
		'金沙苦瓜王'       => 'menu/699d5da687c570001c7a9840/item_2026_08_11T13_17_56_303Z_98e198_msooy5xg',
		'蒜香清炒奶白菜'     => 'menu/699d5da687c570001c7a9840/item_2026_08_11T13_20_40_593Z_6rgcjv_msoow4uy',
		'客家风味小炒'      => 'menu/699d5da687c570001c7a9840/item_2026_08_11T13_16_50_439Z_n0pgl6_msooxr6v',
		'客家咸香肉'       => 'menu/699d5da687c570001c7a9840/item_2026_08_11T13_14_28_236Z_1mb4ot_msoox7tm',
		'半煎焗石班魚'      => 'media-image/699d5da687c570001c7a9840/product/item_2026-08-11T13_10_37.150Z_5fumsh/2026_09_06T12_47_10_076Z_nw8n',
		'清炒空心菜'       => 'menu/699d5da687c570001c7a9840/item_2026_02_25T07_30_00_603Z_shtlae_ms6ayi1b',
		'葱油菜心'        => 'menu/699d5da687c570001c7a9840/item_2026_02_25T07_30_00_603Z_jxcugp_ms6axqvl',
	);
	$exts   = array(
		'image/jpeg' => 'jpg',
		'image/png'  => 'png',
		'image/webp' => 'webp',
		'image/gif'  => 'gif',
	);

	$all_done = true;
	foreach ( $photos as $zh => $path ) {
		$ids = get_posts(
			array(
				'post_type'      => 'dish',
				'post_status'    => 'any',
				'posts_per_page' => 1,
				'fields'         => 'ids',
				'meta_key'       => 'dish_zh', // phpcs:ignore WordPress.DB.SlowDBQuery
				'meta_value'     => $zh,       // phpcs:ignore WordPress.DB.SlowDBQuery
			)
		);
		if ( ! $ids || has_post_thumbnail( $ids[0] ) ) {
			continue;
		}
		$post_id = (int) $ids[0];

		$tmp = download_url( $base . $path, 30 );
		if ( is_wp_error( $tmp ) ) {
			$all_done = false;
			continue;
		}
		$mime = wp_get_image_mime( $tmp );
		if ( ! $mime || ! isset( $exts[ $mime ] ) ) {
			wp_delete_file( $tmp );
			$all_done = false;
			continue;
		}
		$file = array(
			'name'     => sanitize_title( get_the_title( $post_id ) ) . '.' . $exts[ $mime ],
			'tmp_name' => $tmp,
		);
		$att_id = media_handle_sideload( $file, $post_id, get_the_title( $post_id ) );
		if ( is_wp_error( $att_id ) ) {
			wp_delete_file( $tmp );
			$all_done = false;
			continue;
		}
		update_post_meta( $att_id, '_wp_attachment_image_alt', get_the_title( $post_id ) . ' ' . $zh );
		set_post_thumbnail( $post_id, $att_id );
	}

	if ( $all_done ) {
		update_option( 'hakshan_dish_photos_2026_10', 1 );
		delete_transient( 'hakshan_dish_photos_2026_10_lock' );
	}
}
add_action( 'admin_init', 'hakshan_import_dish_photos_2026_10', 30 );

/**
 * One-time: publish the Oct 2026 dishes once their photos were checked.
 * Only drafts are touched; anything already published/trashed is left alone.
 */
function hakshan_publish_dishes_2026_10() {
	if ( get_option( 'hakshan_dishes_publish_2026_10' ) || ! current_user_can( 'publish_posts' ) ) {
		return;
	}
	$zhs = array( '蒜香青龙菜炒白玉菇', '咖哩鲜蔬煲', '金沙苦瓜王', '蒜香清炒奶白菜', '客家风味小炒', '客家咸香肉', '半煎焗石班魚', '清炒空心菜', '葱油菜心' );
	foreach ( $zhs as $zh ) {
		$ids = get_posts(
			array(
				'post_type'      => 'dish',
				'post_status'    => 'draft',
				'posts_per_page' => 1,
				'fields'         => 'ids',
				'meta_key'       => 'dish_zh', // phpcs:ignore WordPress.DB.SlowDBQuery
				'meta_value'     => $zh,       // phpcs:ignore WordPress.DB.SlowDBQuery
			)
		);
		if ( $ids ) {
			wp_update_post(
				array(
					'ID'          => (int) $ids[0],
					'post_status' => 'publish',
				)
			);
		}
	}
	update_option( 'hakshan_dishes_publish_2026_10', 1 );
}
add_action( 'admin_init', 'hakshan_publish_dishes_2026_10', 40 );

/**
 * One-time: set menu prices from the POS / order.hakshan.com menu (Oct 2026).
 * "Price" = the POS base (compare-with) price; "member price" = the current
 * selling price. Single-price items get no member price. Matched by trimmed
 * dish_zh; dishes not listed here are left untouched.
 */
function hakshan_set_dish_prices_2026_10() {
	if ( get_option( 'hakshan_dish_prices_2026_10c' ) || ! current_user_can( 'edit_posts' ) ) {
		return;
	}
	$prices = array( /* dish_zh => array( price, member price ) */
		'三杯醇香肥肠' => array( 'RM 30', 'RM 25' ),
		'传统擂茶炒饭' => array( 'RM 25', 'RM 20' ),
		'冬菜蒸肉饼' => array( 'RM 30', 'RM 25' ),
		'冬菜蒸肉饼饭' => array( 'RM 20', 'RM 15' ),
		'冰凉酸梅桔子汁' => array( 'RM 8.90', '' ),
		'冰糖炖雪梨' => array( 'RM 5', '' ),
		'半煎焗石班魚' => array( 'RM 50', 'RM 45' ),
		'南乳炸肉' => array( 'RM 30', 'RM 25' ),
		'南乳炸肉饭' => array( 'RM 20', 'RM 15' ),
		'南乳炸鸡饭' => array( 'RM 20', 'RM 15' ),
		'吊片西芹蒸肉饼' => array( 'RM 40', 'RM 35' ),
		'咕噜肉' => array( 'RM 25', 'RM 20' ),
		'咕噜肉饭' => array( 'RM 20', 'RM 15' ),
		'咖哩鲜蔬煲' => array( 'RM 35', 'RM 30' ),
		'咸蛋苏东' => array( 'RM 30', 'RM 25' ),
		'咸蛋虾球' => array( 'RM 35', 'RM 30' ),
		'咸蛋石斑魚片' => array( 'RM 40', 'RM 35' ),
		'奶油苏东' => array( 'RM 30', 'RM 25' ),
		'奶油石斑魚片' => array( 'RM 40', 'RM 35' ),
		'奶油鷄塊飯' => array( 'RM 20', 'RM 15' ),
		'奶油鸡塊' => array( 'RM 25', 'RM 20' ),
		'姜丝油浸鱼石斑鱼' => array( 'RM 55', 'RM 50' ),
		'姜糖汤圆' => array( 'RM 11.90', 'RM 7' ),
		'姜芽焖鸭' => array( 'RM 40', 'RM 35' ),
		'姜芽焖鸭饭' => array( 'RM 25', 'RM 20' ),
		'姜葱炒鱼片' => array( 'RM 40', 'RM 35' ),
		'姜酒鸡面线' => array( 'RM 20', 'RM 15' ),
		'客家三杯鸡' => array( 'RM 40', 'RM 35' ),
		'客家养生姜炖鸡汤' => array( 'RM 25', 'RM 20' ),
		'客家咸香肉' => array( 'RM 30', 'RM 25' ),
		'客家山珍菌菇' => array( 'RM 25', 'RM 20' ),
		'客家擂茶冷面' => array( 'RM 25', 'RM 20' ),
		'客家擂茶撈麵' => array( 'RM 23', 'RM 18' ),
		'客家炒三宝 - 三味合一' => array( 'RM 25', 'RM 20' ),
		'客家焖肉焖木耳' => array( 'RM 30', 'RM 25' ),
		'客家焖肉焖木耳饭' => array( 'RM 20', 'RM 15' ),
		'客家算盘子' => array( 'RM 25', 'RM 20' ),
		'客家肉碎蒸矮瓜' => array( 'RM 25', 'RM 20' ),
		'客家肉碎饭' => array( 'RM 20', 'RM 15' ),
		'客家酿四宝' => array( 'RM 40', 'RM 35' ),
		'客家酿四宝饭' => array( 'RM 25', 'RM 20' ),
		'客家风味小炒' => array( 'RM 30', 'RM 25' ),
		'客家风味梅菜炒石斑鱼片' => array( 'RM 50', 'RM 45' ),
		'客家香炒粒粒' => array( 'RM 20', 'RM 15' ),
		'山药莲藕时蔬' => array( 'RM 25', 'RM 20' ),
		'擂茶豆奶湯圓' => array( 'RM 12.90', 'RM 8' ),
		'新鲜石榴汁' => array( 'RM 9.90', '' ),
		'桂花糕' => array( 'RM 5', '' ),
		'梅菜扣肉' => array( 'RM 30', 'RM 25' ),
		'梅香黄金炒饭' => array( 'RM 20', 'RM 15' ),
		'橄榄菜肉碎炒四季豆' => array( 'RM 20', 'RM 15' ),
		'正宗擂茶拌饭' => array( 'RM 23', 'RM 18' ),
		'清炒油麦胆' => array( 'RM 20', 'RM 15' ),
		'清炒空心菜' => array( 'RM 20', 'RM 15' ),
		'清爽柳橙汁' => array( 'RM 9.90', '' ),
		'清韵擂茶奶茶' => array( 'RM 11.90', 'RM 7' ),
		'热带芒果汁' => array( 'RM 9.90', '' ),
		'猪脚醋' => array( 'RM 35', 'RM 30' ),
		'猪脚醋饭' => array( 'RM 25', 'RM 20' ),
		'瑶柱水瓜滑蛋' => array( 'RM 25', 'RM 20' ),
		'瓦煲肉碎豆腐羹' => array( 'RM 25', 'RM 20' ),
		'红糖姜茶' => array( 'RM 5', '' ),
		'纯天然蜂蜜柠檬' => array( 'RM 8.90', '' ),
		'纯香擂茶豆奶' => array( 'RM 11.90', 'RM 7' ),
		'罗宋汤 (ABC汤)' => array( 'RM 20', 'RM 15' ),
		'胡椒猪肚汤' => array( 'RM 25', 'RM 20' ),
		'芋香扣肉' => array( 'RM 35', 'RM 30' ),
		'芒果布丁' => array( 'RM 5', '' ),
		'芙蓉蛋' => array( 'RM 25', 'RM 20' ),
		'花雕醉明虾' => array( 'RM 45', 'RM 40' ),
		'药材鸡汤' => array( 'RM 20', 'RM 15' ),
		'药膳盐焗鸡' => array( 'RM 40', 'RM 35' ),
		'药膳盐焗鸡饭' => array( 'RM 25', 'RM 20' ),
		'莲藕花生汤' => array( 'RM 20', 'RM 15' ),
		'菜莆煎蛋' => array( 'RM 25', 'RM 20' ),
		'菜莆肉碎豆腐' => array( 'RM 25', 'RM 20' ),
		'葱油白切鸡' => array( 'RM 40', 'RM 35' ),
		'葱油白切鸡饭' => array( 'RM 25', 'RM 20' ),
		'葱油菜心' => array( 'RM 25', 'RM 20' ),
		'蒜香清炒奶白菜' => array( 'RM 20', 'RM 15' ),
		'蒜香青龙菜炒白玉菇' => array( 'RM 20', 'RM 15' ),
		'虾仁煎蛋' => array( 'RM 30', 'RM 25' ),
		'虾油葱油豆腐' => array( 'RM 20', 'RM 15' ),
		'虾球西兰花' => array( 'RM 30', 'RM 25' ),
		'豆浆水' => array( 'RM 5', '' ),
		'酥炸明虾球' => array( 'RM 35', 'RM 30' ),
		'酥炸苏东' => array( 'RM 30', 'RM 25' ),
		'酸甜百香果汁' => array( 'RM 8.90', '' ),
		'酸甜虾球' => array( 'RM 35', 'RM 30' ),
		'酸甜石斑魚片' => array( 'RM 40', 'RM 35' ),
		'酸甜鸡丁' => array( 'RM 25', 'RM 20' ),
		'醇香猪肚板面' => array( 'RM 20', 'RM 15' ),
		'金沙苦瓜王' => array( 'RM 25', 'RM 20' ),
		'鴛鴦糍粑' => array( 'RM 12.90', 'RM 8' ),
		'黄梨酸香肥肠' => array( 'RM 25', 'RM 20' ),
		'黄酒醉鸡' => array( 'RM 40', 'RM 35' ),
		'黄酒醉鸡饭' => array( 'RM 25', 'RM 20' ),
		'黑豆乌鸡汤' => array( 'RM 20', 'RM 15' ),
		'龟苓膏' => array( 'RM 5', '' ),
		'八宝凉茶' => array( 'RM 5', '' ),
		/* Dine-in only (from Brand Dashboard POS sales) */
		'4人套餐' => array( 'RM 188', 'RM 158' ),
		'6人套餐' => array( 'RM 288', 'RM 218' ),
		'传统客家炒面' => array( 'RM 20', 'RM 15' ),
		'客家刀嬷切' => array( 'RM 20', 'RM 15' ),
		'秘制肉碎客家面' => array( 'RM 20', 'RM 15' ),
		'香辣口水鸡面' => array( 'RM 25', 'RM 20' ),
		'客家咸香鸭' => array( 'RM 40', 'RM 35' ),
		'铁观音' => array( 'RM 10', 'RM 5' ),
		'普洱' => array( 'RM 10', 'RM 5' ),
		'绿茶' => array( 'RM 10', 'RM 5' ),
		'茉莉香片' => array( 'RM 10', 'RM 5' ),
		'玫瑰紅棗桂圓茶' => array( 'RM 10', 'RM 5' ),
		'山楂枸杞胎菊茶' => array( 'RM 10', 'RM 5' ),
		'百合茉莉枸杞茶' => array( 'RM 10', 'RM 5' ),
		'紅棗桂圓枸杞茶' => array( 'RM 10', 'RM 5' ),
		'玫瑰茉莉胎菊茶' => array( 'RM 10', 'RM 5' ),
	);
	$ids = get_posts(
		array(
			'post_type'      => 'dish',
			'post_status'    => 'any',
			'posts_per_page' => -1,
			'fields'         => 'ids',
		)
	);
	foreach ( $ids as $id ) {
		$zh = trim( (string) get_post_meta( $id, 'dish_zh', true ) );
		if ( isset( $prices[ $zh ] ) ) {
			update_post_meta( $id, 'dish_price_normal', $prices[ $zh ][0] );
			update_post_meta( $id, 'dish_price_member', $prices[ $zh ][1] );
		}
	}
	update_option( 'hakshan_dish_prices_2026_10c', 1 );
	do_action( 'litespeed_purge_all' );
}
add_action( 'admin_init', 'hakshan_set_dish_prices_2026_10', 50 );
