<?php


if ( class_exists( 'Tokoo_Widget' ) ) {

// Create custom widget class extending WPH_Widget
class Tokoo_Video extends Tokoo_Widget {

	function __construct() {

		$args = array(
			'label' 		=> esc_html__( 'Tokoo - Video', 'tokoo' ),
			'description' 	=> esc_html__( 'A custom widget to display video such as from youtube, vimeo and etc.', 'tokoo' ),
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
				'std' 		=> esc_html__( 'Video', 'tokoo' ),
				'validate' 	=> 'alpha_dash',
				'filter' 	=> 'strip_tags|esc_attr'
			 ),

			 // Show Post Count
			array(
				'name' 		=> esc_html__( 'Video URL', 'tokoo' ),
				'desc' 		=> esc_html__( 'Enter video URL', 'tokoo' ),
				'id' 		=> 'video_url',
				'type'		=> 'text',
				'class' 	=> 'widefat',
				'std' 		=> '',
				'filter'	=> 'esc_url',
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

		$title 		= apply_filters( 'widget_title', $instance['title'] );
		$video_url 	= esc_url( $instance['video_url'] );

		printf( $args['before_widget'] );

		if ( $title ) {
			printf( '%s %s %s', $args['before_title'], $title, $args['after_title'] );
		}

		$output = get_transient( 'videowidget_' . $widget_id );

		if ( !empty( $video_url ) ) {

			echo '<div class="video-widget">';
			echo do_shortcode('[video src="' . $video_url . '"]' );
			echo '</div>';

		}


		printf( $args['after_widget'] );
	}

} // class

}
