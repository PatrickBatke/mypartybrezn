<?php

// ===============================================================================================
// -----------------------------------------------------------------------------------------------
// Typography Section
// -----------------------------------------------------------------------------------------------
// ===============================================================================================
add_filter( 'tokoo_new_customizer_data', 'tokoo_typography_settings_data' );
function tokoo_typography_settings_data( $tokoo_options ) {

	/* ==================================================== *
	 *  Typography Settings Section                         *
	 * ==================================================== */
	$tokoo_options[] = array(
		'slug'		=> 'tokoo_font_settings',
		'label'		=> esc_html__( 'Font Settings', 'tokoo' ),
		'priority'	=> 4,
		'type' 		=> 'section'
	);

		/* ============================================================ *
		 *  Typography Color Settings Data                              *
		 * ============================================================ */
		$tokoo_options[] = array(
			'slug'		=> 'tokoo_heading_font',
			'default'	=> 'Montserrat',
			'priority'	=> 1,
			'label'		=> esc_html__( 'Heading Font', 'tokoo' ),
			'section'	=> 'tokoo_font_settings',
			'transport'	=> 'refresh',
			'font_amount'	=> 5000,
			'type' 		=> 'google_font',
		); 

		$tokoo_options[] = array(
			'slug'		=> 'tokoo_heading_font_weight',
			'default'   => '700',
			'priority'  => 2,
			'label'     => esc_html__( 'Heading Font Weight', 'tokoo' ),
			'section'	=> 'tokoo_font_settings',
			'output'    => 'false',
			'transport' => 'refresh',
			'type'      => 'select',
			'choices'	=> array(
				'300'	=> '300',
				'400'	=> '400',
				'500'	=> '500',
				'700'	=> '700',
			)
		);

		$tokoo_options[] = array(
			'slug'		=> 'tokoo_heading_letter_spacing',
			'default'   => '0',
			'priority'  => 3,
			'label'     => esc_html__( 'Heading Letter Spacing', 'tokoo' ),
			'section'	=> 'tokoo_font_settings',
			'output'    => 'false',
			'transport' => 'refresh',
			'type'      => 'text'
		);

		$tokoo_options[] = array(
			'slug'		=> 'tokoo_heading_line_height',
			'default'   => '38px',
			'priority'  => 4,
			'label'     => esc_html__( 'Heading Line Height', 'tokoo' ),
			'section'	=> 'tokoo_font_settings',
			'output'    => 'false',
			'transport' => 'refresh',
			'type'      => 'text'
		);

		$tokoo_options[] = array(
			'slug'		=> 'tokoo_body_font',
			'default'	=> 'Montserrat',
			'priority'	=> 5,
			'label'		=> esc_html__( 'Body Font', 'tokoo' ),
			'section'	=> 'tokoo_font_settings',
			'transport'	=> 'refresh',
			'font_amount'	=> 5000,
			'type' 		=> 'google_font',
		); 

		$tokoo_options[] = array(
			'slug'		=> 'tokoo_body_font_size', 
			'default'   => '13px',
			'priority'  => 6,
			'label'     => esc_html__( 'Body Font Size', 'tokoo' ),
			'section'	=> 'tokoo_font_settings',
			'output'    => 'false',
			'transport' => 'refresh',
			'type'      => 'text'
		);

		$tokoo_options[] = array(
			'slug'		=> 'tokoo_body_font_weight',
			'default'   => '400',
			'priority'  => 7,
			'label'     => esc_html__( 'Body Font Weight', 'tokoo' ),
			'section'	=> 'tokoo_font_settings',
			'output'    => 'false',
			'transport' => 'refresh',
			'type'      => 'select',
			'choices'	=> array(
				'300'	=> '300',
				'400'	=> '400',
				'500'	=> '500',
				'700'	=> '700',
			)
		);

		$tokoo_options[] = array(
			'slug'		=> 'tokoo_body_line_height',
			'default'   => '25px',
			'priority'  => 8,
			'label'     => esc_html__( 'Body Line Height in px', 'tokoo' ),
			'section'	=> 'tokoo_font_settings',
			'output'    => 'false',
			'transport' => 'refresh',
			'type'      => 'text'
		);

		$tokoo_options[] = array(
			'slug'		=> 'tokoo_body_letter_spacing',
			'default'   => '0',
			'priority'  => 9,
			'label'     => esc_html__( 'Body Letter Spacing', 'tokoo' ),
			'section'	=> 'tokoo_font_settings',
			'output'    => 'false',
			'transport' => 'refresh',
			'type'      => 'text'
		);

		$tokoo_options[] = array(
			'slug'		=> 'tokoo_decoration_font',
			'default'   => 'Amatic SC',
			'priority'  => 10,
			'label'     => esc_html__( 'Decoration Font', 'tokoo' ),
			'section'	=> 'tokoo_font_settings',
			'output'    => 'false',
			'transport' => 'refresh',
			'font_amount'	=> 5000,
			'type'      => 'google_font'
		);


	return $tokoo_options;
}