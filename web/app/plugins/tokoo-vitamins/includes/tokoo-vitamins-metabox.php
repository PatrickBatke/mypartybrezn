<?php 

/**
 * Metabox for custom post type tokoo
 *
 * @return void
 * @author alispx
 **/
add_filter( 'tokoo_metabox_options', 'vitamins_register_metabox', 5 );
function vitamins_register_metabox( $options ) {
		
	// -----------------------------------------
	// Define portfolio metabox               -
	// -----------------------------------------
	$options[]    = array(
		'id'        => '_project_details',
		'title'     => 'Project Details',
		'post_type' => 'tokoo-portfolio',
		'context'   => 'normal',
		'priority'  => 'high',
		'sections'  => array(
			array(
				'name'  => 'portfolio_section',
				'title' => 'Portfolio Section',
				'icon'  => 'fa fa-cog',
				'fields' => array(
					array(
						'id'    => 'client',
						'type'  => 'text',
						'title' => 'Client Name',
						'desc'  => 'Enter the client name',
					),
					array(
						'id'    => 'url',
						'type'  => 'text',
						'title' => 'URL',
						'desc'  => 'Enter the project URL',
					),
					array(
					  'id'          => 'gallery',
					  'type'        => 'gallery',
					  'title'       => 'Project Gallery',
					  'desc'        => 'Add project gallery images',
					  'add_title'   => 'Add Images',
					  'edit_title'  => 'Edit Images',
					  'clear_title' => 'Remove Images',
					),

				), // end: fields
			), // end: a section
		),
	);


	// -----------------------------------------
	// Define team metabox               -
	// -----------------------------------------
	$options[]    = array(
		'id'        => '_team_details',
		'title'     => 'Team Details',
		'post_type' => 'tokoo-team',
		'context'   => 'normal',
		'priority'  => 'high',
		'sections'  => array(
			array(
				'name'  => 'team_section',
				'title' => 'Team Section',
				'icon'  => 'fa fa-cog',
				'fields' => array(
					array(
						'id'    => 'role',
						'type'  => 'text',
						'title' => 'Role',
						'desc'  => 'Enter the role',
					),
					array(
						'id'              => 'social_account',
						'type'            => 'group',
						'title'           => 'Socials Account',
						'info'            => 'You can use any option field on group',
						'button_title'    => 'Add New Account',
						'accordion_title' => 'Adding More Account',
						'fields'          => array(
								array(
									'id'          => 'name',
									'type'        => 'text',
									'title'       => 'Enter The Account Name',
									),
								array(
									'id'          => 'url',
									'type'        => 'text',
									'title'       => 'Enter The account URL',
								),
								array(
									'id'          => 'icon',
									'type'        => 'icon',
									'title'       => 'Choose The icon',
								),
							),
					),
					array(
						'id'       => 'biography',
						'type'     => 'wysiwyg',
						'title'    => 'Enter the biography',
						'settings' => array(
							'textarea_rows' => 5,
							'tinymce'       => false,
							'media_buttons' => false,
						)
					),
					array(
						'id'              => 'skill',
						'type'            => 'group',
						'title'           => 'Skills',
						'info'            => 'You can use any option field on group',
						'button_title'    => 'Add New Skill',
						'accordion_title' => 'Adding More Skill',
						'fields'          => array(
								array(
									'id'          => 'skill_name',
									'type'        => 'text',
									'title'       => 'Enter The Skill Name',
									),
								array(
									'id'          => 'skill_level',
									'type'        => 'number',
									'title'       => 'Enter The Skill Level 1 - 100',
								),
							),
						),
					)
				), // end: fields
		), // end: a section
	);
	

	// -----------------------------------------
	// Define testimonials metabox             -
	// -----------------------------------------
	$options[]    = array(
		'id'        => '_testimonials_details',
		'title'     => 'Testimony Details',
		'post_type' => 'tokoo-testimonials',
		'context'   => 'normal',
		'priority'  => 'high',
		'sections'  => array(
			array(
				'name'  => 'testimony_section',
				'title' => 'Testimony Section',
				'icon'  => 'fa fa-cog',
				'fields' => array(
					array(
						'id'    => 'link',
						'type'  => 'text',
						'title' => 'Testimony Link',
						'desc'  => 'Enter the link',
					),
					array(
						'id'    => 'position',
						'type'  => 'text',
						'title' => 'Position',
						'desc'  => 'Enter the position',
					),
					array(
						'id'       => 'testimony_content',
						'type'     => 'wysiwyg',
						'title'    => 'Enter the testimony content',
						'settings' => array(
							'textarea_rows' => 5,
							'tinymce'       => false,
							'media_buttons' => false,
						)
					),
				), // end: fields
			), // end: a section
		),
	);

	return $options;
}
