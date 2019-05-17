<?php

if ( class_exists( 'Tokoo_Widget' ) ) {

// Create custom widget class extending WPH_Widget
class Tokoo_Restaurant_Hours extends Tokoo_Widget {

	function __construct() {

		$args = array(
			'label' 		=> esc_html__( 'Tokoo - Restaurant Hours', 'tokoo' ),
			'description' 	=> esc_html__( 'A custom widget to display your restaurant hours.', 'tokoo' ),
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
				'std' 		=> esc_html__( 'Restaurant Hours', 'tokoo' ),
				'validate' 	=> 'alpha_dash',
				'filter' 	=> 'strip_tags|esc_attr'
			 ),

			// Name 1
			array(
				'name'		=> esc_html__( 'Hours Operation Name 1', 'tokoo' ),
				'id' 		=> 'hours_name_1',
				'type'		=> 'text',
				'class' 	=> 'widefat',
				'std' 		=> '',
			 ),

			 // Desc 1
			array(
				'name'		=> esc_html__( 'Hours Description 1', 'tokoo' ),
				'id' 		=> 'hours_desc_1',
				'type'		=> 'text',
				'class' 	=> 'widefat',
				'std' 		=> '',
			 ),

			// Name 2
			array(
				'name'		=> esc_html__( 'Hours Operation Name 2', 'tokoo' ),
				'id' 		=> 'hours_name_2',
				'type'		=> 'text',
				'class' 	=> 'widefat',
				'std' 		=> '',
			 ),

			// Desc 2
			array(
				'name'		=> esc_html__( 'Hours Description 2', 'tokoo' ),
				'id' 		=> 'hours_desc_2',
				'type'		=> 'text',
				'class' 	=> 'widefat',
				'std' 		=> '',
			 ),

			 // Name 3
			array(
				'name'		=> esc_html__( 'Hours Operation Name 3', 'tokoo' ),
				'id' 		=> 'hours_name_3',
				'type'		=> 'text',
				'class' 	=> 'widefat',
				'std' 		=> '',
			 ),

			// Desc 3
			array(
				'name'		=> esc_html__( 'Hours Description 3', 'tokoo' ),
				'id' 		=> 'hours_desc_3',
				'type'		=> 'text',
				'class' 	=> 'widefat',
				'std' 		=> '',
			 ),

			  // Name 4
			array(
				'name'		=> esc_html__( 'Hours Operation Name 4', 'tokoo' ),
				'id' 		=> 'hours_name_4',
				'type'		=> 'text',
				'class' 	=> 'widefat',
				'std' 		=> '',
			 ),

			// Desc 4
			array(
				'name'		=> esc_html__( 'Hours Description 4', 'tokoo' ),
				'id' 		=> 'hours_desc_4',
				'type'		=> 'text',
				'class' 	=> 'widefat',
				'std' 		=> '',
			 ),



		 ); // fields array

		$args['options'] 	= array(
				'width'		=> 350,
				'height'	=> 350,
				'classname'	=> 'widget-office-hours',
			);

		// create widget
		$this->create_widget( $args );
	}


	// Output function
	function widget( $args, $instance ) {

		extract( $args );

		$title 				= apply_filters( 'widget_title', $instance['title'] );
		$hours_name_1 		= esc_attr( $instance['hours_name_1'] );
		$hours_name_2 		= esc_attr( $instance['hours_name_2'] );
		$hours_name_3 		= esc_attr( $instance['hours_name_3'] );
		$hours_name_4 		= esc_attr( $instance['hours_name_4'] );
		$hours_desc_1 		= esc_attr( $instance['hours_desc_1'] );
		$hours_desc_2 		= esc_attr( $instance['hours_desc_2'] );
		$hours_desc_3 		= esc_attr( $instance['hours_desc_3'] );
		$hours_desc_4 		= esc_attr( $instance['hours_desc_4'] );

		printf( $before_widget );

		if ( ! empty( $title ) )
			printf( '%s %s %s', $args['before_title'], $title, $args['after_title'] ); ?>

			<ul class="open-hour">
				<?php if ($hours_name_1): ?>
					<li><span><?php echo esc_attr( $hours_name_1 ); ?></span><span><?php echo esc_attr( $hours_desc_1 ); ?></span></li>	
				<?php endif ?>

				<?php if ($hours_name_2): ?>
					<li><span><?php echo esc_attr( $hours_name_2 ); ?></span><span><?php echo esc_attr( $hours_desc_2 ); ?></span></li>
				<?php endif ?>
				
				<?php if ($hours_name_3): ?>
					<li><span><?php echo esc_attr( $hours_name_3 ); ?></span><span><?php echo esc_attr( $hours_desc_3 ); ?></span></li>
				<?php endif ?>
				
				<?php if ($hours_name_4): ?>
					<li><span><?php echo esc_attr( $hours_name_4 ); ?></span><span class="closed"><?php echo esc_attr( $hours_desc_4 ); ?></span></li>
				<?php endif ?>
				
			</ul>

	<?php

		printf( $after_widget );
	}

} // class

}
