<?php

/**
 * Define metabox field for pages
 *
 * @return void
 * @author tokoo
 **/
add_filter( 'tokoo_metabox_options', 'tokoo_pages_metabox' );
function tokoo_pages_metabox( $metaboxes ) {

	$metaboxes[]    = array(
		'id'        => '_contact_maps',
		'title'     => esc_html__( 'Contact Maps', 'tokoo' ),
		'post_type' => 'page',
		'context'   => 'normal',
		'priority'  => 'high',
		'sections'  => array(
			array(
				'name'  => 'contact_form_section',
				'title' => esc_html__( 'Contact Form', 'tokoo' ),
				'icon'  => 'fa fa-envelope',
				'fields' => array( 
					array(
						'id'    	=> 'contact_form',
						'type'  	=> 'select',
						'title' 	=> esc_html__( 'Select Contact Form', 'tokoo' ),
						'desc'  	=> esc_html__( 'Type the contact form from ninja form plugin', 'tokoo' ),
						'options'	=> tokoo_get_all_ninja_forms(),
					),

				), // end: fields
			), // end: a section

			array(
				'name'  => 'contact_map_section',
				'title' => esc_html__( 'Contact Maps', 'tokoo' ),
				'icon'  => 'fa fa-map-marker',
				'fields' => array(
					array(
						'id'    	=> 'map_iframe',
						'type'  	=> 'textarea',
						'title' 	=> esc_html__( 'Map Location:', 'tokoo' ),
						'desc'  	=> esc_html__( 'Go to Google Maps and searh your Location. Click on menu near search text => Share or embed map => Embed map. Next copy iframe to this field', 'tokoo' ),
						'sanitize' 	=> false,
					),
					array(
						'id'    => 'map_height',
						'type'  => 'text',
						'title' => esc_html__( 'Height', 'tokoo' ),
						'desc'  => esc_html__( 'Map Height (px):', 'tokoo' ),
					),
					array(
						'id'    	=> 'tagline',
						'type'  	=> 'textarea',
						'title' 	=> esc_html__( 'Company Tagline', 'tokoo' ),
						'desc'  	=> esc_html__( 'Type the company tagline', 'tokoo' ),
					),
					array(
						'id'    	=> 'phone_number',
						'type'  	=> 'text',
						'title' 	=> esc_html__( 'Phone Number', 'tokoo' ),
						'desc'  	=> esc_html__( 'Type the phone number', 'tokoo' ),
					),
					array(
						'id'    	=> 'address',
						'type'  	=> 'wysiwyg',
						'title' 	=> esc_html__( 'Company Address', 'tokoo' ),
						'desc'  	=> esc_html__( 'Type the company address', 'tokoo' ),
						'settings' => array(
							'textarea_rows'	=> 5,
							'tinymce'		=> false,
							'media_buttons'	=> false,
						)
					),

				), // end: fields
			), // end: a section
		),
	);

	$metaboxes[]    = array(
		'id'        => '_page_details',
		'title'     => esc_html__( 'Page Details', 'tokoo' ),
		'post_type' => 'page',
		'context'   => 'normal',
		'priority'  => 'high',
		'sections'  => array(
			array(
				'name'  => 'page_section',
				'title' => esc_html__( 'Page Section', 'tokoo' ),
				'icon'  => 'fa fa-cog',
				'fields' => array(
					array(
						'id'    	=> 'custom_sidebar',
						'type'  	=> 'select',
						'title' 	=> esc_html__( 'Custom Sidebar', 'tokoo' ),
						'desc'  	=> esc_html__( 'Choose custom sidebar for this page', 'tokoo' ),
						'options'	=> tokoo_get_all_sidebars(),
					),
					array(
						'id'    	=> 'per_page',
						'type'  	=> 'number',
						'title' 	=> esc_html__( 'Post Per Page', 'tokoo' ),
						'desc'  	=> esc_html__( 'Enter how many item will be displayed', 'tokoo' ),
						'default' 	=> 12,
					),
					array(
						'id'    	=> 'social_share',
						'type'  	=> 'switcher',
						'title' 	=> esc_html__( 'Display Social Share', 'tokoo' ),
						'label' 	=> esc_html__( 'Do you want to display social share in this page?', 'tokoo' ),
						'default' 	=> true,
					),
					array(
						'id'    	=> 'header_style',
						'type'  	=> 'select',
						'title' 	=> esc_html__( 'Header Style', 'tokoo' ),
						'label' 	=> esc_html__( 'Select your preferred header style', 'tokoo' ),
						'default' 	=> false,
						'options'        => array(
							'variant-1' => esc_html__( 'Default', 'tokoo' ),
							'variant-2' => esc_html__( 'Variant 2', 'tokoo' ),
							'variant-3' => esc_html__( 'Variant 3', 'tokoo' ),
						),
					),

					array(
						'id'    	=> 'page_header_background',
						'type'      => 'image',
						'title' 	=> esc_html__( 'Header Background', 'tokoo' ),
						'label' 	=> esc_html__( 'Select your preferred header background', 'tokoo' ),
					),

				), // end: fields
			), // end: a section
		),
	);

	return $metaboxes;
}