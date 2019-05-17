<?php

class Tokoo_Post_Types {

	public function __construct() {
		add_action( 'init', array( $this, 'vitamin_register_post_types' ), 5 );
	}

	/**
	 * Register post type portfolio
	 *
	 * @return void
	 * @author alispx
	 **/
	public function vitamin_register_post_types() {

		/* Load the portfolio post type file if supported. */
		if ( current_theme_supports( 'tokoo-portfolio' ) ) {

			$portfolio_type_name = apply_filters( 'tokoo_portfolio_post_type_name', 'tokoo-portfolio' );
			register_extended_post_type( $portfolio_type_name,
					array(
						'admin_cols' => array(
							'title' 			=> array(
									'title'			=> 'Project Name'
							),
							'featured_image' 	=> array(
								'title'          	=> 'Project Cover',
								'featured_image' 	=> 'thumbnail',
								'height' 			=> 80,
								'width' 			=> 80

							),
							'project_categories' 	=> array(
								'title' 			=> 'Project Category',
								'taxonomy'			=> apply_filters( 'tokoo_project_categories_name', 'project_categories' )
							),
							'project_tags' 			=> array(
								'title' 			=> 'Project Tag',
								'taxonomy'			=> 'project_tags'
							),
							'date'
						),
						'filters' => array(
							'project_categories' => array(
								'title'    => 'Project Categories',
								'taxonomy' => 'project_categories'
							),
							'project_tags' => array(
								'title'    => 'Project Tags',
								'taxonomy' => apply_filters( 'tokoo_project_tags_name', 'project_tags' )
							),
						),
						'supports'      => array( 'title', 'editor', 'thumbnail' ),
						'menu_icon' 	=> 'dashicons-category',
						'menu_position' => 28.35,
					),
					array(
						# Override the base names used for labels:
						'singular' => 'Project',
						'plural'   => 'Projects',
						'slug'     => 'project',
					)
				);

			// Register Taxonomy project categories
			register_extended_taxonomy( apply_filters( 'tokoo_project_categories_name', 'project_categories' ), $portfolio_type_name, array(),
				array(
					'singular' 	=> 'Project Category',
					'plural' 	=> 'Project Categories',
					'slug'		=> apply_filters( 'tokoo_project_categories_slug', 'project_cat' ),
					)
			);

			// Register Taxonomy project tags
			register_extended_taxonomy( apply_filters( 'tokoo_project_tags_name', 'project_tags' ), $portfolio_type_name,
				array(
					'hierarchical' => false
				),
				array(
					'singular' 	=> 'Project Tag',
					'plural' 	=> 'Project Tags',
					'slug'		=> apply_filters( 'tokoo_project_tag_slug', 'project_tag' ),
				)
			);

		}

		/* Load the team post type file if supported. */
		if ( current_theme_supports( 'tokoo-team' ) ) {

			$team_type_name = apply_filters( 'tokoo_team_post_type_name', 'tokoo-team' );
			register_extended_post_type( $team_type_name,
				array(
					'admin_cols' => array(
						'title' 			=> array(
								'title'			=> 'Name'
						),
						'featured_image' 	=> array(
							'title'          	=> 'Picture',
							'featured_image' 	=> 'thumbnail',
							'height' 			=> 80,
							'width' 			=> 80

						),
						'date'
					),
					'supports'      => array( 'title', 'thumbnail' ),
					'menu_icon' 	=> 'dashicons-businessman',
					'menu_position' => 30.35,
				),
				array(
					# Override the base names used for labels:
					'singular' => 'Team Member',
					'plural'   => 'Team Members',
					'slug'     => apply_filters( 'tokoo_team_post_type_slug', 'tokoo-team' ),
				)
			);

		}

		/* Load the testimonials post type file if supported. */
		if ( current_theme_supports( 'tokoo-testimonials' ) ) {

			$testimonials_type_name = apply_filters( 'tokoo_testimonials_post_type_name', 'tokoo-testimonials' );
			register_extended_post_type( $testimonials_type_name,
				array(
					'admin_cols' => array(
						'title' 			=> array(
								'title'			=> 'Name'
						),
						'featured_image' 	=> array(
							'title'          	=> 'Picture',
							'featured_image' 	=> 'thumbnail',
							'height' 			=> 80,
							'width' 			=> 80

						),
						'date'
					),
					'supports'      => array( 'title', 'thumbnail' ),
					'menu_icon' 	=> 'dashicons-format-status',
					'menu_position' => 29.35,
				),
				array(
					# Override the base names used for labels:
					'singular' => 'Testimony',
					'plural'   => 'Testimonials',
					'slug'     => apply_filters( 'tokoo_testimonials_post_type_slug', 'testimony' ),
				)
			);

		}

		if ( current_theme_supports( 'portfolio' ) ) {

			$old_portfolio_type_name = apply_filters( 'tokoo_old_portfolio_post_type_name', 'portfolio' );
			register_extended_post_type( $old_portfolio_type_name,
				array(
					'admin_cols' => array(
						'title' 			=> array(
								'title'			=> 'Name'
						),
						'featured_image' 	=> array(
							'title'          	=> 'Picture',
							'featured_image' 	=> 'thumbnail',
							'height' 			=> 80,
							'width' 			=> 80

						),
						'category' => array(
							'taxonomy' => 'portfolio_cat'
						),
						'role' => array(
							'taxonomy' => 'role'
						),
						'date'
					),
					'supports'      => array( 'title', 'thumbnail', 'editor' ),
					'menu_icon' 	=> 'dashicons-category',
					'menu_position' => 30.35,
				),
				array(
					# Override the base names used for labels:
					'singular' => 'Portfolio',
					'plural'   => 'Portfolios',
					'slug'     => apply_filters( 'tokoo_old_portfolio_post_type_slug', 'project' ),
				)
			);

			// Register Taxonomy portfolio cat
			register_extended_taxonomy( apply_filters( 'tokoo_old_portfolio_categories_name', 'portfolio_cat' ), $old_portfolio_type_name, array(),
				array(
					'singular' 	=> 'Category',
					'plural' 	=> 'Categories',
					'slug'		=> apply_filters( 'tokoo_old_portfolio_categories_slug', 'portfolio_cat' ),
				)
			);

			// Register Taxonomy roles
			register_extended_taxonomy( apply_filters( 'tokoo_old_portfolio_tags_name', 'role' ), $old_portfolio_type_name,
				array(
					'hierarchical' => false
				),
				array(
					'singular' 	=> 'Role',
					'plural' 	=> 'Roles',
					'slug'		=> apply_filters( 'tokoo_old_portfolio_tag_slug', 'role' ),
				)
			);

		}

		if ( current_theme_supports( 'testimonials' ) ) {

			$old_testimonials_type_name = apply_filters( 'tokoo_old_testimonials_post_type_name', 'testimonials' );
			register_extended_post_type( $old_testimonials_type_name,
				array(
					'admin_cols' => array(
						'title' 			=> array(
								'title'			=> 'Name'
						),
						'featured_image' 	=> array(
							'title'          	=> 'Picture',
							'featured_image' 	=> 'thumbnail',
							'height' 			=> 80,
							'width' 			=> 80

						),
						'date'
					),
					'supports'      => array( 'title', 'thumbnail' ),
					'menu_icon' 	=> 'dashicons-format-chat',
					'menu_position' => 31.35,
				),
				array(
					# Override the base names used for labels:
					'singular' => 'Testimonial',
					'plural'   => 'Testimonials',
					'slug'     => apply_filters( 'tokoo_old_testimonials_post_type_slug', 'testimonials' ),
				)
			);
		}

		if ( current_theme_supports( 'team-member' ) ) {

			$old_team_member_type_name = apply_filters( 'tokoo_old_team_member_post_type_name', 'team-member' );
			register_extended_post_type( $old_team_member_type_name,
				array(
					'admin_cols' => array(
						'title' 			=> array(
								'title'			=> 'Name'
						),
						'featured_image' 	=> array(
							'title'          	=> 'Picture',
							'featured_image' 	=> 'thumbnail',
							'height' 			=> 80,
							'width' 			=> 80

						),
						'date'
					),
					'supports'      => array( 'title', 'thumbnail' ),
					'menu_icon' 	=> 'dashicons-businessman',
					'menu_position' => 31.50,
				),
				array(
					# Override the base names used for labels:
					'singular' => 'Team Member',
					'plural'   => 'Team Members',
					'slug'     => apply_filters( 'tokoo_old_team_member_post_type_slug', 'team-member' ),
				)
			);
		}

		if ( current_theme_supports( 'tokoo-slider' ) ) {

			$tokoo_slider_post_type = apply_filters( 'tokoo_slider_post_type', 'tokoo-slider' );
			register_extended_post_type( $tokoo_slider_post_type,
				array(
					'admin_cols' => array(
						'title' 			=> array(
							'title'			=> 'Slide Title'
						),
						'featured_image' 	=> array(
							'title'          	=> 'Image',
							'featured_image' 	=> 'thumbnail',
							'height' 			=> 80,
							'width' 			=> 80

						),
						'date'
					),
					'supports'      => array( 'title' ),
					'menu_icon' 	=> 'dashicons-format-gallery',
					'menu_position' => 33.50,
				),
				array(
					# Override the base names used for labels:
					'singular' => 'Slider',
					'plural'   => 'Sliders',
					'slug'     => apply_filters( 'tokoo_slider_post_type_slug', 'slides' ),
				)
			);
		}

	}
}

