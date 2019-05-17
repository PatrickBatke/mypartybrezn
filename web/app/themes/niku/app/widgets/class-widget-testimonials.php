<?php

if ( class_exists( 'Tokoo_Widget' ) ) {

// Create custom widget class extending WPH_Widget
class Tokoo_Testimonials extends Tokoo_Widget {

	function __construct() {

		$args = array(
			'label' 		=> esc_html__( 'Tokoo - Testimonials', 'tokoo' ),
			'description' 	=> esc_html__( 'A custom widget that display three testimonials.', 'tokoo' ),
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
				'std' 		=> esc_html__( 'Testimonials', 'tokoo' ),
				'validate' 	=> 'alpha_dash',
				'filter' 	=> 'strip_tags|esc_attr'
			 ),

			// Number
			array(
				'name' 		=> esc_html__( 'Number', 'tokoo' ),
				'id' 		=> 'number',
				'type'		=> 'text',
				'class' 	=> 'widefat',
				'std' 		=> 5,
				'filter'	=> 'esc_attr',
			 ),

			// Display Type
			array(
				'name' 		=> esc_html__( 'Display Type', 'tokoo' ),
				'id' 		=> 'display_type',
				'type'		=> 'select',
				'class' 	=> 'widefat',
				'std' 		=> '',
				'filter'	=> 'esc_attr',
				'fields' 	=> array(
						array(
							'name'  => esc_html__( 'List', 'tokoo' ),
							'value' => 'list'
						 ),
						array(
							'name'  => esc_html__( 'Slide', 'tokoo' ),
							'value' => 'slide'
						 ),
				 ),
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

		extract( $args );

		$title 			= apply_filters( 'widget_title', $instance['title'] );
		$number 		= $instance['number'];
		$display_type 	= isset( $instance['display_type'] ) ? $instance['display_type'] : 'list';
		$ul_class 		= ( 'slide' == $display_type ) ? 'slides' : 'testimonials-list';
		$testimonials_wrapper_start = ( 'slide' == $display_type ) ? '<div class="testimonial-slider slider">' : '';
		$testimonials_wrapper_end 	= ( 'slide' == $display_type ) ? '</div>' : '';
		// Begin Widget
		printf( $before_widget );

		if ( $title ) {
			printf( '%s %s %s', $args['before_title'], $title, $args['after_title'] );
		}

			$args = array(
				'post_type'   			=> 'tokoo-testimonials',
				'ignore_sticky_posts' 	=> true,
				'order'               	=> 'DESC',
				'orderby'             	=> 'date',
			);

		$query = new WP_Query( $args );

		if ( $query->have_posts() ) :

			printf( '%s', $testimonials_wrapper_start );

				echo '<ul class="'.$ul_class.'">';

			while ( $query->have_posts() ) : $query->the_post();

				$testimonials = tokoo_get_meta( '_testimonials_details' ); ?>

				<li>
					<blockquote>

						<?php echo wpautop( tokoo_testimonials_get_content() ); ?>

						<?php $link = ! empty( $testimonials['link'] ) ? $testimonials['link'] : ''; ?>
				    	<cite><a href="<?php echo esc_url( $link ); ?>"><?php the_title(); ?></a></cite>

				    	<?php if ( isset( $testimonials['position'] ) && ! empty( $testimonials['position'] ) ) : ?>
				    		<span class="position"><?php echo esc_attr( $testimonials['position'] ); ?></span>
				    	<?php endif; ?>

						<figure>
							<?php if ( has_post_thumbnail() ) : ?>
								<?php the_post_thumbnail( 'small' ); ?>
							<?php endif; ?>
						</figure>

					</blockquote>
				</li>

			<?php endwhile;

			echo '</ul>';

		printf( '%s', $testimonials_wrapper_end );

		endif;
		wp_reset_postdata();

		printf( $after_widget );
		// End Widget
	}

} // class

}
