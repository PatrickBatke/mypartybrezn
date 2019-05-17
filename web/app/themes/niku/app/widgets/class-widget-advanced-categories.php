<?php

if ( class_exists( 'Tokoo_Widget' ) ) {

	// Create custom widget class extending WPH_Widget
	class Tokoo_Advanced_Categories extends Tokoo_Widget {

		function __construct() {

			$args = array(
				'label' 		=> esc_html__( 'Tokoo - Advanced Categories', 'tokoo' ),
				'description' 	=> esc_html__( 'A list or dropdown of categories with limitation', 'tokoo' ),
			 );

			// fields array
			$args['fields'] = array(

				// Title field
				array(
					'name' 		=> esc_html__( 'Title', 'tokoo' ),
					'desc' 		=> esc_html__( 'Enter the widget title.', 'tokoo' ),
					'id' 		=> 'title',
					'type' 		=> 'text',
					'class' 	=> 'widefat',
					'std' 		=> esc_html__( 'Advanced Categories', 'tokoo' ),
					'validate' 	=> 'alpha_dash',
					'filter' 	=> 'strip_tags|esc_attr'
				 ),

				// Limit Display Categories
				array(
					'name'		=> esc_html__( 'Limit Category Display', 'tokoo' ),
					'desc' 		=> esc_html__( 'Enter how many categories to show.', 'tokoo' ),
					'id' 		=> 'per_page',
					'type'		=> 'text',
					'std' 		=> 10,
				 ),

				// Display Categories as Dropdown
				array(
					'name' 		=> esc_html__( 'Display as Dropdown', 'tokoo' ),
					'id' 		=> 'dropdown',
					'type'		=> 'checkbox',
					'std' 		=> 0, // 0 or 1
					'filter'	=> 'strip_tags|esc_attr',
				 ),

				 // Show Post Count
				array(
					'name' 		=> esc_html__( 'Show Post Count', 'tokoo' ),
					'id' 		=> 'count',
					'type'		=> 'checkbox',
					'std' 		=> 0, // 0 or 1
					'filter'	=> 'strip_tags|esc_attr',
				 ),

				 // Show Hierarchy
				array(
					'name' 		=> esc_html__( 'Show Hierarchy', 'tokoo' ),
					'id' 		=> 'hierarchical',
					'type'		=> 'checkbox',
					'std' 		=> 0, // 0 or 1
					'filter'	=> 'strip_tags|esc_attr',
				 ),

			 ); // fields array

			$args['options'] 	= array(
					'width'		=> 350,
					'height'	=> 350
				);

			// create widget
			$this->create_widget( $args );
		}


		// Output function
		function widget( $args, $instance ) {

			/** This filter is documented in wp-includes/default-widgets.php */
			$title 		= apply_filters( 'widget_title', empty( $instance['title'] ) ? esc_html__( 'Advance Categories', 'tokoo' ) : $instance['title'], $instance, $this->id_base );
			$c 			= ! empty( $instance['count'] ) ? '1' : '0';
			$h 			= ! empty( $instance['hierarchical'] ) ? '1' : '0';
			$d 			= ! empty( $instance['dropdown'] ) ? '1' : '0';
			$per_page 	= $instance['per_page'];

			printf( $args['before_widget'] );

			if ( $title ) {
				printf( '%s %s %s', $args['before_title'], $title, $args['after_title'] );
			}

			$cat_args = array( 'orderby' => 'name', 'show_count' => $c, 'hierarchical' => $h );

			if ( $d ) :
				$cat_args['show_option_none'] = esc_html__( 'Select Category', 'tokoo' );

				/**
				 * Filter the arguments for the Advance Categories widget drop-down.
				 *
				 * @since 2.8.0
				 *
				 * @see wp_dropdown_categories()
				 *
				 * @param array $cat_args An array of Advance Categories widget drop-down arguments.
				 */
				wp_dropdown_categories( apply_filters( 'advance_categories_dropdown_args', $cat_args ) );
			?>

			<script type='text/javascript'>
			/* <![CDATA[ */
				var dropdown = document.getElementById("cat");
				function onCatChange() {
					if ( dropdown.options[dropdown.selectedIndex].value > 0 ) {
						location.href = "<?php echo esc_url( home_url( '/' ) ); ?>/?cat="+dropdown.options[dropdown.selectedIndex].value;
					}
				}
				dropdown.onchange = onCatChange;
			/* ]]> */
			</script>

			<?php

			else :

				echo '<ul>';

				$cat_args = array(
					"number" 	=> $per_page,
					"orderby" 	=> "count",
					"order"		=> "DESC"
				);

				$cat_args['number'] 	= $per_page;

				/**
				 * Filter the arguments for the Categories widget.
				 *
				 * @since 2.8.0
				 *
				 * @param array $cat_args An array of Categories widget options.
				 */

				// wp_list_categories( apply_filters( 'advance_categories_args', $cat_args ) );
				$categories = get_terms( "category", $cat_args );
				$separator = ' ';

				if ( $categories ) {
					foreach ( $categories as $category ) {
						$cat_id 	= $category->term_id;
					    $cat_color 	= get_option( "category_$cat_id" ); ?>

						<li <?php echo ( isset( $cat_color["catBG"] ) ) ? 'style="background-color:'.$cat_color['catBG'].'"': "" ?> >
							<a href="<?php echo esc_url( get_category_link( $category->term_id ) ); ?>" title="<?php echo esc_attr( sprintf( esc_html__( "View all posts in %s", "tokoo" ), $category->name ) )  ?>"><?php echo esc_attr( $category->name ); ?></a>
							<?php if ( $c ): ?>
								<span class="count"><?php echo esc_attr( $category->count ); ?></span>
							<?php endif; ?>
						</li>
					<?php }
				}
				echo '</ul>';

			endif;

			printf( $args['after_widget'] );
		}

	} // class

}
