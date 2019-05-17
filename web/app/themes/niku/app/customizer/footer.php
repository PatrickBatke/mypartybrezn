<?php

// ===============================================================================================
// -----------------------------------------------------------------------------------------------
// Footer Section
// -----------------------------------------------------------------------------------------------
// ===============================================================================================
add_filter( 'tokoo_customize_options', 'tokoo_footer_settings_data' );
function tokoo_footer_settings_data( $tokoo_options ) {

	// -----------------------------------------
	// Customize Panel Options Fields          -
	// -----------------------------------------
	$tokoo_options[]     = array(
		'name'              => 'tokoo_advanced_settings',
		'title'             => 'Advance Settings',
		'description'       => '',
		'sections'          => array(
			array(
				'name'          => 'tokoo_additional_footer_settings',
				'title'         => 'Footer Additional Settings',
				'settings'      => array(
					array(
						'name'      => 'tokoo_enable_footer_testimonials_slider',
						'control'	=> array(
							'type' 		=> 'cs_field',
							'options'	=> array(
								'type'    	=> 'checkbox',
								'title'   	=> 'Enable Footer Testimonials',
								'label'   	=> 'Yes, Please do it.',
								'default' 	=> true,
							),
						),
					),
					array(
						'name' 			=> 'tokoo_footer_testimonials_slider',
						'control'		=> array(
							'type'			=> 'cs_field',
							'options' 		=> array(
								'type'				=> 'select',
								'title'				=> 'Select the testimonials post',
								'options'			=> 'posts',
								'class'				=> 'chosen',
								'attributes' 		=> array(
									'placeholder' => 'Select the testimonials',
									'multiple'    => 'multiple',
								),
								'query_args'     => array(
							'post_type'    => 'tokoo-testimonials',
							'orderby'      => 'post_date',
							'order'        => 'DESC',
							),
							),
						),
					),
					array(
						'name'          => 'tokoo_footer_testimonials_content_color',
						'default'       => '#77828b',
						'control'       => array(
							'label'       	=> 'Testimonials Content Color',
							'type'        	=> 'color',
						),
					),
					array(
						'name'          => 'tokoo_footer_testimonials_cite_color',
						'default'       => '#77828b',
						'control'       => array(
							'label'       	=> 'Testimonials Cite Color',
							'type'        	=> 'color',
						),
					),
					array(
						'name' 			=> 'tokoo_footer_testimonials_background_color',
						'control'       => array(
							'type'			=> 'cs_field',
							'options' 		=> array(
								'title'       	=> 'Testimonials Background Color',
								'type'        	=> 'color_picker',
							),
						),
					),
					array(
						'name' 			=> 'tokoo_footer_testimonials_background_image',
						'control'       => array(
							'type'			=> 'cs_field',
							'options' 		=> array(
								'title'       	=> 'Testimonials Background Image',
								'type'        	=> 'image',
							),
						),
					),
				),
			),
		),
	);

	return $tokoo_options;
}