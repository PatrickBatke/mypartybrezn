<?php

if ( class_exists( 'Tokoo_Widget' ) ) {

// Create custom widget class extending WPH_Widget
class Tokoo_Mailchimp_Subscribe_Form extends Tokoo_Widget {

	function __construct() {

		$args = array(
			'label' 		=> esc_html__( 'Tokoo - MailChimp Subscribe Form', 'tokoo' ),
			'description' 	=> esc_html__( 'Displays your MailChimp for WordPress Subscribe form', 'tokoo' ),
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
				'std' 		=> esc_html__( 'Subscribe Newsletter', 'tokoo' ),
				'validate' 	=> 'alpha_dash',
				'filter' 	=> 'strip_tags|esc_attr'
			 ),

			array(
				'name' 		=> esc_html__( 'Mailchimp Form ID', 'tokoo' ),
				'desc' 		=> esc_html__( 'Enter the Mailchimp Form ID.', 'tokoo' ),
				'id' 		=> 'form_id',
				'type' 		=> 'text',
				'class' 	=> 'widefat',
				'validate' 	=> 'alpha_dash',
				'filter' 	=> 'strip_tags|esc_attr'
			 ),

			// Description
			array(
				'name'		=> esc_html__( 'Description', 'tokoo' ),
				'id' 		=> 'description',
				'type'		=> 'textarea',
				'class' 	=> 'widefat',
				'rows' 		=> 4,
				'cols' 		=> 4,
				'std' 		=> '',
			 ),

			// Disable Widget Wrapper
			array(
				'name' 		=> esc_html__( 'Disable Widget Wrapper', 'tokoo' ),
				'id' 		=> 'widget_wrapper',
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

		$title          = apply_filters( 'widget_title', $instance['title'] );
		$desc           = isset( $instance['description'] ) ? $instance['description'] : '';
		$widget_wrapper = isset( $instance['widget_wrapper'] ) ? $instance['widget_wrapper'] : 1;

		extract( $args );

		if ( 0 == $widget_wrapper ) {
			printf( $before_widget );
		}

		if ( ! empty( $title ) ) {
			printf( '%s %s %s', $args['before_title'], $title, $args['after_title'] );
		}

		// make sure template functions exist (for usage in avia layout builder)
		if ( function_exists( 'mc4wp_show_form' ) ) {
			echo '<p>'.$desc.'</p>';
			if ( ! empty( $instance['form_id'] ) ) {
				mc4wp_show_form( $instance['form_id'] );
			}
		}

		if ( 0 == $widget_wrapper ) {
			printf( $after_widget );
		}
	}

} // class

}
