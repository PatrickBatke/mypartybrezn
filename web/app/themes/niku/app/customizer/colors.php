<?php 

// ===============================================================================================
// -----------------------------------------------------------------------------------------------
// Color Section
// -----------------------------------------------------------------------------------------------
// ===============================================================================================
add_filter( 'tokoo_new_customizer_data', 'tokoo_color_settings_data' );
function tokoo_color_settings_data( $tokoo_options ) {

	/* ==================================================== *
	 *  Accent Color Settings Section | No Panel            *
	 * ==================================================== */
	$tokoo_options[] = array(
		'slug'		=> 'tokoo_color_settings',
		'label'		=> esc_html__( 'Color Settings', 'tokoo' ),
		'priority'	=> 5,
		'type' 		=> 'section'
	);

		/* ============================================================ *
		 *  Accent Color Settings Data                                  *
		 * ============================================================ */
		$tokoo_options[] = array(
			'slug'		=> 'tokoo_accent_color',
			'default'	=> '#ff4e00',
			'priority'	=> 1,
			'label'		=> esc_html__( 'Accent Color', 'tokoo' ),
			'section'	=> 'tokoo_color_settings',
			'output'	=> false,
			'transport' => 'refresh',
			'type' 		=> 'color'
		);
		$tokoo_options[] = array(
			'slug'		=> 'tokoo_heading_color',
			'default'	=> '#24292d',
			'priority'	=> 2,
			'label'		=> esc_html__( 'Heading Color', 'tokoo' ),
			'section'	=> 'tokoo_color_settings',
			'output'	=> false,
			'transport'	=> 'refresh',
			'type' 		=> 'color'
		);
		$tokoo_options[] = array(
			'slug'		=> 'tokoo_body_color',
			'default'	=> '#77828b',
			'priority'	=> 3,
			'label'		=> esc_html__( 'Body Color', 'tokoo' ),
			'section'	=> 'tokoo_color_settings',
			'selector'	=> 'body',
			'property'	=> 'color',
			'output'	=> true,
			'transport'	=> 'refresh',
			'type' 		=> 'color'
		);
		$tokoo_options[] = array(
			'slug'		=> 'tokoo_link_color',
			'default'	=> '#ff4e00',
			'priority'	=> 4,
			'label'		=> esc_html__( 'Link Color', 'tokoo' ),
			'section'	=> 'tokoo_color_settings',
			'selector'	=> 'a',
			'property'	=> 'color',
			'output'	=> true,
			'transport'	=> 'refresh',
			'type' 		=> 'color'
		);
		$tokoo_options[] = array(
			'slug'		=> 'tokoo_link_hover_color',
			'default'	=> '#ff8d5b',
			'priority'	=> 5,
			'label'		=> esc_html__( 'Link Hover Color', 'tokoo' ),
			'section'	=> 'tokoo_color_settings',
			'output'	=> true,
			'selector'	=> 'a:hover, a:active',
			'property'	=> 'color',
			'transport'	=> 'refresh',
			'type' 		=> 'color'
		);

		$tokoo_options[] = array(
			'slug'		=> 'tokoo_button_color',
			'default'	=> '#ffffff',
			'priority'	=> 6,
			'label'		=> esc_html__( 'Button Color', 'tokoo' ),
			'section'	=> 'tokoo_color_settings',
			'output'	=> false,
			'transport'	=> 'refresh',
			'type' 		=> 'color'
		);
		$tokoo_options[] = array(
			'slug'		=> 'tokoo_button_hover_color',
			'default'	=> '#ffffff',
			'priority'	=> 7,
			'label'		=> esc_html__( 'Button Hover Color', 'tokoo' ),
			'section'	=> 'tokoo_color_settings',
			'output'	=> false,
			'transport'	=> 'refresh',
			'type' 		=> 'color'
		);
		$tokoo_options[] = array(
			'slug'		=> 'tokoo_button_background_color',
			'default'	=> '#24292d',
			'priority'	=> 8,
			'label'		=> esc_html__( 'Button Background Color', 'tokoo' ),
			'section'	=> 'tokoo_color_settings',
			'output'	=> false,
			'transport'	=> 'refresh',
			'type' 		=> 'color'
		);
		$tokoo_options[] = array(
			'slug'		=> 'tokoo_button_background_hover_color',
			'default'	=> '#ff4e00',
			'priority'	=> 9,
			'label'		=> esc_html__( 'Button Background Hover Color', 'tokoo' ),
			'section'	=> 'tokoo_color_settings',
			'output'	=> false,
			'transport'	=> 'refresh',
			'type' 		=> 'color'
		);

		$tokoo_options[] = array(
			'slug'		=> 'tokoo_top_header_bg',
			'default'	=> '#1f2326',
			'priority'	=> 10,
			'label'		=> esc_html__( 'Top Header Background', 'tokoo' ),
			'section'	=> 'tokoo_color_settings',
			'output'	=> false,
			'transport'	=> 'refresh',
			'type' 		=> 'color'
		);

		$tokoo_options[] = array(
			'slug'		=> 'tokoo_top_header_color',
			'default'	=> '#ffffff',
			'priority'	=> 11,
			'label'		=> esc_html__( 'Top Header Color', 'tokoo' ),
			'section'	=> 'tokoo_color_settings',
			'output'	=> false,
			'transport'	=> 'refresh',
			'type' 		=> 'color'
		);

		$tokoo_options[] = array(
			'slug'		=> 'tokoo_footer_bg',
			'default'	=> '#1f2326',
			'priority'	=> 12,
			'label'		=> esc_html__( 'Footer Background', 'tokoo' ),
			'section'	=> 'tokoo_color_settings',
			'output'	=> false,
			'transport'	=> 'refresh',
			'type' 		=> 'color'
		);
		$tokoo_options[] = array(
			'slug'		=> 'tokoo_footer_color',
			'default'	=> '#ffffff',
			'priority'	=> 13,
			'label'		=> esc_html__( 'Footer Color', 'tokoo' ),
			'section'	=> 'tokoo_color_settings',
			'output'	=> false,
			'transport'	=> 'refresh',
			'type' 		=> 'color'
		);

		$tokoo_options[] = array(
			'slug'		=> 'tokoo_footer_link_color',
			'default'	=> '#fafafa',
			'priority'	=> 14,
			'label'		=> esc_html__( 'Footer Link Color', 'tokoo' ),
			'section'	=> 'tokoo_color_settings',
			'output'	=> false,
			'transport'	=> 'refresh',
			'type' 		=> 'color'
		);

		$tokoo_options[] = array(
			'slug'		=> 'tokoo_footer_link_hover_color',
			'default'	=> '#ffffff',
			'priority'	=> 15,
			'label'		=> esc_html__( 'Footer Link Hover Color', 'tokoo' ),
			'section'	=> 'tokoo_color_settings',
			'output'	=> false,
			'transport'	=> 'refresh',
			'type' 		=> 'color'
		);

		$tokoo_options[] = array(
			'slug'		=> 'tokoo_footer_widget_title_color',
			'default'	=> '#ffffff',
			'priority'	=> 16,
			'label'		=> esc_html__( 'Footer Widget Title Color', 'tokoo' ),
			'section'	=> 'tokoo_color_settings',
			'output'	=> false,
			'transport'	=> 'refresh',
			'type' 		=> 'color'
		);
		
	return $tokoo_options;
}
