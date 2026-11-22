<?php
/**
 * Preview page for the new homepage design.
 *
 * Creates a private page using template-home-new.php the first time an admin
 * opens WordPress, so the design can be checked on the real site while logged
 * in. Private pages are hidden from visitors and search engines. To launch,
 * set this page as the homepage in Settings → Reading.
 *
 * @package Hakshan
 */

function hakshan_create_home_preview_page() {
	if ( get_option( 'hakshan_home_preview_page' ) || ! current_user_can( 'publish_pages' ) ) {
		return;
	}
	$existing = get_page_by_path( 'home-preview' );
	if ( $existing instanceof WP_Post ) {
		update_option( 'hakshan_home_preview_page', $existing->ID );
		return;
	}
	$page_id = wp_insert_post(
		array(
			'post_type'   => 'page',
			'post_status' => 'private',
			'post_title'  => 'Home (new design preview)',
			'post_name'   => 'home-preview',
			'meta_input'  => array( '_wp_page_template' => 'template-home-new.php' ),
		),
		true
	);
	if ( ! is_wp_error( $page_id ) ) {
		update_option( 'hakshan_home_preview_page', $page_id );
	}
}
add_action( 'admin_init', 'hakshan_create_home_preview_page', 70 );
