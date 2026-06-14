<?php
/**
 * Homepage section visibility — exposes a "Homepage Sections" panel in
 * Appearance → Customize so each homepage section can be toggled on/off
 * without editing the template.
 *
 * @package Hakshan
 */

defined( 'ABSPATH' ) || exit;

/**
 * Map of section keys → human labels. Order here is the order they
 * appear in the Customizer panel.
 *
 * @return array<string, string>
 */
function hakshan_homepage_section_map() {
	return array(
		'hakshan_show_three_gens'   => __( 'Three Generations', 'hakshan' ),
		'hakshan_show_signatures'   => __( 'Signature Dishes', 'hakshan' ),
		'hakshan_show_cinema'       => __( 'Cinematic Break', 'hakshan' ),
		'hakshan_show_charity'      => __( 'Pay it Forward (Charity)', 'hakshan' ),
		'hakshan_show_outlets_home' => __( 'Outlets Carousel', 'hakshan' ),
		'hakshan_show_gallery'      => __( 'Atmosphere Gallery', 'hakshan' ),
		'hakshan_show_reserve_cta'  => __( 'Reserve a Table CTA', 'hakshan' ),
	);
}

/**
 * Whether the given homepage section should render. Defaults to true
 * so the homepage works the same as before until an admin opts out.
 *
 * @param string $key Setting id, e.g. 'hakshan_show_signatures'.
 */
function hakshan_show_section( $key ) {
	return (bool) get_theme_mod( $key, true );
}

/**
 * Register the Customizer panel + checkbox controls for each section.
 */
add_action(
	'customize_register',
	function ( $wp_customize ) {
		$wp_customize->add_section(
			'hakshan_homepage_sections',
			array(
				'title'       => __( 'Homepage Sections', 'hakshan' ),
				'priority'    => 35,
				'description' => __( 'Choose which sections appear on the homepage. The hero is always on.', 'hakshan' ),
			)
		);

		foreach ( hakshan_homepage_section_map() as $setting_id => $label ) {
			$wp_customize->add_setting(
				$setting_id,
				array(
					'default'           => true,
					'transport'         => 'refresh',
					'sanitize_callback' => 'rest_sanitize_boolean',
				)
			);
			$wp_customize->add_control(
				$setting_id,
				array(
					'label'   => $label,
					'section' => 'hakshan_homepage_sections',
					'type'    => 'checkbox',
				)
			);
		}
	}
);
