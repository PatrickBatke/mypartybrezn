<?php 

// ===============================================================================================
// -----------------------------------------------------------------------------------------------
// Advanced Section
// -----------------------------------------------------------------------------------------------
// ===============================================================================================
add_filter( 'tokoo_new_customizer_data', 'tokoo_advanced_settings_data' );
function tokoo_advanced_settings_data( $tokoo_options ) {

	/* ===========================================================================================*
	 *  Advanced Panel + Settings + data 										 												*
	 * ===========================================================================================*/
	$tokoo_options[] = array(
		'slug'		=> 'tokoo_advanced_settings',
		'label'		=> esc_html__( 'Advanced Settings', 'tokoo' ),
		'priority'	=> 3,
		'type' 		=> 'panel'
	);

		/* ==================================================== *
		 *  Page Settings Section                               *
		 * ==================================================== */
		$tokoo_options[] = array(
			'slug'		=> 'tokoo_page_settings',
			'label'		=> esc_html__( 'Page Settings', 'tokoo' ),
			'panel' 	=> 'tokoo_advanced_settings',
			'priority'	=> 1,
			'type' 		=> 'section'
		);

			/* ============================================================ *
			 *  Page Settings Data                                          *
			 * ============================================================ */
			$tokoo_options[] = array(
				'slug'		=> 'tokoo_post_author',
				'default'	=> 1,
				'priority'	=> 1,
				'label'		=> esc_html__( 'Post Author Box', 'tokoo' ),
				'section'	=> 'tokoo_page_settings',
				'selector'	=> '.post-author',
				'transport'	=> 'postMessage',
				'type' 		=> 'checkbox'
			);

			$tokoo_options[] = array(
				'slug'		=> 'tokoo_comment_form',
				'default'	=> 1,
				'priority'	=> 2,
				'label'		=> esc_html__( 'Post/Page Comments', 'tokoo' ),
				'section'	=> 'tokoo_page_settings',
				'selector'	=> '.comments-area',
				'transport'	=> 'postMessage',
				'type' 		=> 'checkbox'
			);

			$tokoo_options[] = array(
				'slug'		=> 'tokoo_social_share',
				'default'	=> 1,
				'priority'	=> 3,
				'label'		=> esc_html__( 'Social Share Buttons', 'tokoo' ),
				'section'	=> 'tokoo_page_settings',
				'selector'	=> '.social-share-holder',
				'transport'	=> 'postMessage',
				'type' 		=> 'checkbox'
			);

		/* ==================================================== *
		 *  Related Post Section                               *
		 * ==================================================== */
		$tokoo_options[] = array(
			'slug'		=> 'tokoo_related_settings',
			'label'		=> esc_html__( 'Related Post Settings', 'tokoo' ),
			'panel' 	=> 'tokoo_advanced_settings',
			'priority'	=> 1,
			'type' 		=> 'section'
		);

			/* ============================================================ *
			 *  Related Data                                          *
			 * ============================================================ */
			$tokoo_options[] = array(
				'slug'		=> 'tokoo_disallow_by_category',
				'default'	=> '',
				'priority'	=> 1,
				'label'		=> esc_html__( 'Disallow by Category', 'tokoo' ),
				'section'	=> 'tokoo_related_settings',
				'transport'	=> 'refresh',
				'type' 		=> 'category_dropdown'
			);

			$tags = get_tags();

			if ( $tags ) {
				$tags_choices[] = esc_html__( '--none--', 'tokoo' );
				foreach ( $tags as $tag ) {
					$tags_choices[$tag->term_id] = $tag->name;
				}
				$tokoo_options[] = array(
					'slug'		=> 'tokoo_disallow_by_tags',
					'default'	=> '',
					'priority'	=> 2,
					'label'		=> esc_html__( 'Disallow by Tag', 'tokoo' ),
					'section'	=> 'tokoo_related_settings',
					'transport'	=> 'refresh',
					'type' 		=> 'select',
					'choices'   => $tags_choices
				);
			}

			$tokoo_options[] = array(
				'slug'		=> 'tokoo_related_title',
				'default'	=> esc_html__( 'Related', 'tokoo' ),
				'priority'	=> 3,
				'label'		=> esc_html__( 'Related Title', 'tokoo' ),
				'section'	=> 'tokoo_related_settings',
				'transport'	=> 'refresh',
				'type' 		=> 'text'
			);

			$tokoo_options[] = array(
				'slug'		=> 'tokoo_related_number',
				'default'	=> 3,
				'priority'	=> 4,
				'label'		=> esc_html__( 'Display Per Page', 'tokoo' ),
				'section'	=> 'tokoo_related_settings',
				'transport'	=> 'refresh',
				'type' 		=> 'text'
			);

	return $tokoo_options;
}