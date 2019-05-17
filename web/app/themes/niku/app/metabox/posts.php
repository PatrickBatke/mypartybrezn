<?php

/**
 * Define metabox field for posts
 *
 * @return void
 * @author tokoo
 **/
add_filter( 'tokoo_metabox_options', 'tokoo_posts_metabox' );
function tokoo_posts_metabox( $metaboxes ) {

	$metaboxes[]    = array(
		'id'        => '_embedded_link',
		'title'     => 'Embedded Link',
		'post_type' => 'post',
		'context'   => 'normal',
		'priority'  => 'high',
		'sections'  => array(
			array(
				'name'  => 'embedded',
				'title' => 'Embedded Link Section',
				'icon'  => 'fa fa-cog',
				'fields' => array(
					array(
						'id'    => 'embedded_link',
						'type'  => 'wysiwyg',
						'title' => 'Embedded Link',
						'desc'  => 'Input Embedded Code from social sites.',
					),

				), // end: fields
			), // end: a section
		),
	);

	$metaboxes[]    = array(
		'id'        => '_page_details',
		'title'     => 'Page Details',
		'post_type' => 'post',
		'context'   => 'normal',
		'priority'  => 'high',
		'sections'  => array(
			array(
				'name'  => 'page_section',
				'title' => 'Page Section',
				'icon'  => 'fa fa-cog',
				'fields' => array(
					array(
						'id'    	=> 'custom_sidebar',
						'type'  	=> 'select',
						'title' 	=> esc_html__( 'Custom Sidebar', 'tokoo' ),
						'desc'  	=> esc_html__( 'Choose custom sidebar for this page', 'tokoo' ),
						'options'	=> tokoo_get_all_sidebars(),
					),

				), // end: fields
			), // end: a section
		),
	);

	return $metaboxes;
}