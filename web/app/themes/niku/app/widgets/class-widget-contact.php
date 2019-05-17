<?php

if ( class_exists( 'Tokoo_Widget' ) ) {

// Create custom widget class extending WPH_Widget
class Tokoo_Contact_Info extends Tokoo_Widget {

	function __construct() {

		$args = array(
			'label' 		=> esc_html__( 'Tokoo - Contact Info', 'tokoo' ),
			'description' 	=> esc_html__( 'A custom widget to display your contact details.', 'tokoo' ),
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
				'std' 		=> esc_html__( 'Contact Info', 'tokoo' ),
				'validate' 	=> 'alpha_dash',
				'filter' 	=> 'strip_tags|esc_attr'
			 ),

			// Summary
			array(
				'name'		=> esc_html__( 'Summary :', 'tokoo' ),
				'id' 		=> 'summary',
				'type'		=> 'textarea',
				'class' 	=> 'widefat',
				'rows' 		=> 4,
				'cols' 		=> 4,
				'std' 		=> '',
			 ),

			 // Address
			array(
				'name'		=> esc_html__( 'Address :', 'tokoo' ),
				'id' 		=> 'address',
				'type'		=> 'textarea',
				'class' 	=> 'widefat',
				'rows' 		=> 4,
				'cols' 		=> 4,
				'std' 		=> '',
			 ),

			// Email
			array(
				'name' 		=> esc_html__( 'Email', 'tokoo' ),
				'desc' 		=> esc_html__( 'Enter the email address', 'tokoo' ),
				'id' 		=> 'email',
				'type'		=> 'text',
				'class' 	=> 'widefat',
				'std' 		=> '',
				'filter'	=> 'esc_attr',
			 ),

			 // Phone
			array(
				'name' 		=> esc_html__( 'Phone', 'tokoo' ),
				'desc' 		=> esc_html__( 'Enter the phone number', 'tokoo' ),
				'id' 		=> 'phone',
				'type'		=> 'text',
				'class' 	=> 'widefat',
				'std' 		=> '',
				'filter'	=> 'esc_attr',
			 ),

			// Fax
			array(
				'name' 		=> esc_html__( 'Fax', 'tokoo' ),
				'desc' 		=> esc_html__( 'Enter the fax number', 'tokoo' ),
				'id' 		=> 'fax',
				'type'		=> 'text',
				'class' 	=> 'widefat',
				'std' 		=> '',
				'filter'	=> 'esc_attr',
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
		$summary 	= stripslashes( $instance['summary'] );
		$address 	= stripslashes( $instance['address'] );
		$email 		= antispambot( $instance['email'] );
		$phone 		= strip_tags( $instance['phone'] );
		$fax 		= strip_tags( $instance['fax'] );

		printf( $before_widget );

		if ( ! empty( $title ) )
			printf( '%s %s %s', $args['before_title'], $title, $args['after_title'] );

			if( $summary ) {
				echo wpautop( $summary );
			}
			if( $address ) {
				echo wpautop( $address );
			}
			if( $email ) {
				echo '<span class="contact-email">Mail : <a href="mailto:' . $email . '">' . $email . '</a></span><br>';
			}
			if( $phone ) {
				echo '<span class="contact-phone">Phone : <a href="tel:' . $phone . '">' . $phone . '</a></span><br>';
			}
			if( $fax ) {
				echo '<span class="contact-fax">Fax : ' . $fax . '</span>';
			}

		printf( $after_widget );
	}

} // class

}
