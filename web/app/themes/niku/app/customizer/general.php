<?php 

// ===============================================================================================
// -----------------------------------------------------------------------------------------------
// General Section
// -----------------------------------------------------------------------------------------------
// ===============================================================================================
add_filter( 'tokoo_new_customizer_data', 'tokoo_general_settings_data' );
function tokoo_general_settings_data( $tokoo_options ) {

	/* ======================================================================================*
	 *  General Settings Panel + Settings + data 										 												*
	 * ======================================================================================*/
	$tokoo_options[] = array(
		'slug'		=> 'tokoo_general_settings',
		'label'		=> esc_html__( 'General Settings', 'tokoo' ),
		'priority'	=> 1,
		'type' 		=> 'panel'
	);

		/* ==================================================== *
		 *  Site Section  										*
		 * ==================================================== */
		$tokoo_options[] = array(
			'slug'		=> 'tokoo_site_settings',
			'label'		=> esc_html__( 'Site Settings', 'tokoo' ),
			'panel' 	=> 'tokoo_general_settings',
			'priority'	=> 1,
			'type' 		=> 'section'
		);

			/* ============================================================ *
			 *  Site Data  													*
			 * ============================================================ */
			$tokoo_options[] = array(
				'slug'		=> 'tokoo_custom_logo',
				'default'	=> '',
				'priority'	=> 1,
				'label'		=> esc_html__( 'Custom Logo', 'tokoo' ),
				'section'	=> 'tokoo_site_settings',
				'output'    => false,
				'transport'	=> 'postMessage',
				'type' 		=> 'images'
			);

			$tokoo_options[] = array(
				'slug'		=> 'tokoo_custom_logo_dark',
				'default'	=> '',
				'priority'	=> 2,
				'label'		=> esc_html__( 'Custom Logo Dark', 'tokoo' ),
				'section'	=> 'tokoo_site_settings',
				'output'    => false,
				'transport'	=> 'postMessage',
				'type' 		=> 'images'
			);


		/* ==================================================== *
		 *  Top Menu Section  									*
		 * ==================================================== */
		$tokoo_options[] = array(
			'slug'		=> 'tokoo_header_text_settings',
			'label'		=> esc_html__( 'Top Header', 'tokoo' ),
			'panel' 	=> 'tokoo_general_settings',
			'priority'	=> 4,
			'type' 		=> 'section'
		);

			$tokoo_options[] = array(
				'slug'		=> 'tokoo_menu_top_style',
				'default'	=> '',
				'priority'	=> 2,
				'label'		=> 'Top Header Content',
				'section'	=> 'tokoo_header_text_settings',
				'type' 		=> 'select',
				'transport'	=> 'refresh',
				'choices'  => array(
					'topmenu' 		=> esc_html__( 'Top Menu', 'tokoo' ),
					'headertext'	=> esc_html__( 'Top Header Text', 'tokoo' ),
				),
			);

			$tokoo_options[] = array(
				'slug'		=> 'tokoo_contactus_text',
				'default'	=> '',
				'priority'	=> 3,
				'label'		=> esc_html__( 'Contact Us Text', 'tokoo' ),
				'section'	=> 'tokoo_header_text_settings',
				'output'    => false,
				'transport'	=> 'refresh',
				'type' 		=> 'text'
			);

			$tokoo_options[] = array(
				'slug'		=> 'tokoo_contactus_phone',
				'default'	=> '',
				'priority'	=> 4,
				'label'		=> esc_html__( 'Contact Us Phone', 'tokoo' ),
				'section'	=> 'tokoo_header_text_settings',
				'output'    => false,
				'transport'	=> 'refresh',
				'type' 		=> 'text'
			);

			$tokoo_options[] = array(
				'slug'		=> 'tokoo_reservation_text',
				'default'	=> '',
				'priority'	=> 5,
				'label'		=> esc_html__( 'Reservation Text', 'tokoo' ),
				'section'	=> 'tokoo_header_text_settings',
				'output'    => false,
				'transport'	=> 'refresh',
				'type' 		=> 'text'
			);

			$tokoo_options[] = array(
				'slug'		=> 'tokoo_reservation_link',
				'default'	=> '',
				'priority'	=> 6,
				'label'		=> esc_html__( 'Link Reservation', 'tokoo' ),
				'section'	=> 'tokoo_header_text_settings',
				'output'    => false,
				'transport'	=> 'refresh',
				'type' 		=> 'text'
			);

		/* ==================================================== *
		 *  Site Header Section  										*
		 * ==================================================== */
		$tokoo_options[] = array(
			'slug'		=> 'tokoo_site_header_settings',
			'label'		=> esc_html__( 'Site Header', 'tokoo' ),
			'panel' 	=> 'tokoo_general_settings',
			'priority'	=> 3,
			'type' 		=> 'section'
		);

			/* ============================================================ *
			 *  Site Layout Data  													*
			 * ============================================================ */
			$tokoo_options[] = array(
				'slug'		=> 'tokoo_sticky_header_when_scrolling',
				'default'	=> false,
				'priority'	=> 1,
				'label'		=> esc_html__( 'Sticky Header When Scrolling', 'tokoo' ),
				'section'	=> 'tokoo_site_header_settings',
				'transport'	=> 'refresh',
				'type' 		=> 'checkbox',
			);

			$tokoo_options[] = array(
				'slug'		=> 'tokoo_header_style',
				'default'	=> '',
				'priority'	=> 2,
				'label'		=> 'Header Style',
				'section'	=> 'tokoo_site_header_settings',
				'type' 		=> 'select',
				'transport'	=> 'refresh',
				'choices'  => array(
					'variant-1' => esc_html__( 'Default', 'tokoo' ),
					'variant-2' => esc_html__( 'Variant 2', 'tokoo' ),
					'variant-3' => esc_html__( 'Variant 3', 'tokoo' ),
				),
			);

			$tokoo_options[] = array(
				'slug'		=> 'tokoo_header_background_type',
				'default'	=> '',
				'priority'	=> 3,
				'label'		=> 'Header Background Type',
				'section'	=> 'tokoo_site_header_settings',
				'type' 		=> 'select',
				'transport'	=> 'refresh',
				'choices'  => array(
					'image'	=> esc_html__( 'Background Image', 'tokoo' ),
					'color'	=> esc_html__( 'Background Color', 'tokoo' ),
				),
			);

			$tokoo_options[] = array(
				'slug'		=> 'tokoo_header_background_color',
				'default'	=> '#ff7133',
				'priority'	=> 4,
				'label'		=> esc_html__( 'Background Color', 'tokoo' ),
				'section'	=> 'tokoo_site_header_settings',
				'output'	=> false,
				'transport'	=> 'postMessage',
				'type' 		=> 'color_special'
			);

			$tokoo_options[] = array(
				'slug'		=> 'tokoo_header_background_image',
				'default'	=> '',
				'priority'	=> 5,
				'label'		=> esc_html__( 'Background Image', 'tokoo' ),
				'section'	=> 'tokoo_site_header_settings',
				'output'    => false,
				'transport'	=> 'postMessage',
				'type' 		=> 'images'
			);

		/* ==================================================== *
		 *  Social Icons Section  								*
		 * ==================================================== */
		$tokoo_options[] = array(
			'slug'		=> 'tokoo_social_icons_settings',
			'label'		=> esc_html__( 'Social Icons', 'tokoo' ),
			'panel' 	=> 'tokoo_general_settings',
			'priority'	=> 4,
			'type' 		=> 'section'
		);

			/* ============================================================ *
			 * Account Data  												*
			 * ============================================================ */
			$tokoo_options[] = array(
				'slug'		=> 'tokoo_fb',
				'default'	=> '',
				'priority'	=> 1,
				'label'		=> esc_html__( 'Facebook Username', 'tokoo' ),
				'section'	=> 'tokoo_social_icons_settings',
				'type' 		=> 'text',
				'transport'	=> 'refresh',
			);
			$tokoo_options[] = array(
				'slug'		=> 'tokoo_tw',
				'default'	=> '',
				'priority'	=> 2,
				'label'		=> esc_html__( 'Twitter Username', 'tokoo' ),
				'section'	=> 'tokoo_social_icons_settings',
				'type' 		=> 'text',
				'transport'	=> 'refresh',
			);
			$tokoo_options[] = array(
				'slug'		=> 'tokoo_gplus',
				'default'	=> '',
				'priority'	=> 5,
				'label'		=> esc_html__( 'Google Plus Username', 'tokoo' ),
				'section'	=> 'tokoo_social_icons_settings',
				'type' 		=> 'text',
				'transport'	=> 'refresh',
			);
			$tokoo_options[] = array(
				'slug'		=> 'tokoo_pinterest',
				'default'	=> '',
				'priority'	=> 6,
				'label'		=> esc_html__( 'Pinterest Username', 'tokoo' ),
				'section'	=> 'tokoo_social_icons_settings',
				'type' 		=> 'text',
				'transport'	=> 'refresh',
			);


	return $tokoo_options;
}

