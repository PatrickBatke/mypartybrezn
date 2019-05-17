<?php

if ( class_exists( 'Tokoo_Widget' ) ) {

// Create custom widget class extending WPH_Widget
class Tokoo_Our_Location extends Tokoo_Widget {

	function __construct() {

		$args = array(
			'label' 		=> esc_html__( 'Tokoo - Our Location', 'tokoo' ),
			'description' 	=> esc_html__( 'A custom widget to display your location details.', 'tokoo' ),
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
				'std' 		=> esc_html__( 'Our Location', 'tokoo' ),
				'validate' 	=> 'alpha_dash',
				'filter' 	=> 'strip_tags|esc_attr'
			 ),

			// Office Name
			array(
				'name'		=> esc_html__( 'Office Name :', 'tokoo' ),
				'id' 		=> 'office_name',
				'type'		=> 'text',
				'class' 	=> 'widefat',
				'std' 		=> '',
			 ),

			 // Address
			array(
				'name'		=> esc_html__( 'Full Address :', 'tokoo' ),
				'id' 		=> 'address',
				'type'		=> 'textarea',
				'class' 	=> 'widefat',
				'rows' 		=> 4,
				'cols' 		=> 4,
				'std' 		=> '',
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

			 // Map Latitude
			array(
				'name'		=> esc_html__( 'Map Latitude :', 'tokoo' ),
				'id' 		=> 'map_latitude',
				'type'		=> 'text',
				'class' 	=> 'widefat',
				'std' 		=> '',
			 ),

			  // Map Longitude
			array(
				'name'		=> esc_html__( 'Map Longitude :', 'tokoo' ),
				'id' 		=> 'map_longitude',
				'type'		=> 'text',
				'class' 	=> 'widefat',
				'std' 		=> '',
			 ),

		 ); // fields array

		$args['options'] 	= array(
				'width'		=> 350,
				'height'	=> 350,
				'classname'	=> 'widget-office-address',
			);

		// create widget
		$this->create_widget( $args );
	}


	// Output function
	function widget( $args, $instance ) {

		extract( $args );

		global $tokoo_use_maps;

		$tokoo_use_maps 	= 'yes';
		$title 				= apply_filters( 'widget_title', $instance['title'] );
		$office_name 		= stripslashes( $instance['office_name'] );
		$address 			= stripslashes( $instance['address'] );
		$email 				= antispambot( $instance['email'] );
		$phone 				= strip_tags( $instance['phone'] );
		$map_latitude 		= ! empty( $instance['map_latitude'] ) ? $instance['map_latitude'] : -6.903932;
		$map_longitude 		= ! empty( $instance['map_longitude'] ) ? $instance['map_longitude'] : 107.610344;

		printf( $before_widget );

		if ( ! empty( $title ) )

			printf( '%s %s %s', $args['before_title'], $title, $args['after_title'] );

			echo '<div class="contact-info" data-squery="max-width:500px=small">'; ?>
				<?php $id = 'tkmap' . rand(); ?>
				<div class="tokoo-dynamic-maps-no-marker" style="overflow: hidden;">
				<?php $url = 'https://maps.google.com/maps?q=' . $map_latitude . ',' . $map_longitude . '&hl=es&zoom=15;z=15&amp;output=embed'; ?>
					<iframe width="200" height="200"  frameborder="0"  scrolling="no"  marginheight="0"  marginwidth="0" src="<?php echo '' . $url; ?>" ></iframe>
				 </div>

				<?php echo '<address>';

					echo '<div class="address contact-item">';
						if ( $office_name ) {
							echo '<strong><i class="drip-icon-location"></i> '.$office_name.'</strong>';
						}

						if ( $address ) {
							echo wpautop( $address );
						}
					echo '</div>';


				if ( $email ) {
					echo '<div class="mail contact-item"><i class="drip-icon-mail"></i> <a href="mailto:'.$email.'">'.$email.'</a></div>';
				}
				if ( $phone ) {

					echo '<div class="phone contact-item"><i class="drip-icon-phone"></i> '.$phone.'</div>';
				}

				echo '</address>';
			echo '</div>'; ?>

		<?php  printf( $after_widget );
	}

} // class

}
