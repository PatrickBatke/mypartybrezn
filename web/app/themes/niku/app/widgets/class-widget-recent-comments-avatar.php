<?php

if ( class_exists( 'Tokoo_Widget' ) ) {

// Create custom widget class extending WPH_Widget
class Tokoo_Recent_Comment_Avatar extends Tokoo_Widget {

	function __construct() {

		$args = array(
			'label' 		=> esc_html__( 'Tokoo - Recent Comments with Avatar', 'tokoo' ),
			'description' 	=> esc_html__( 'A custom widget to display recent comments with avatars', 'tokoo' ),
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
				'std' 		=> esc_html__( 'Recent Comments With Avatar', 'tokoo' ),
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

		$title 	= apply_filters( 'widget_title', $instance['title'] );
		$number = $instance['number'];

		// Begin Widget
		printf( $before_widget );

		if ( $title ) {
			printf( '%s %s %s', $args['before_title'], $title, $args['after_title'] );
		}

		?>

			<ul class="post-list">

			<?php
				$args = array(
						'status' 		=> 'approve',
						'post_status' 	=> 'publish',
						'type' 			=> 'comment',
						'number' 		=> $number,
					);
				$comments = get_comments( $args );

				if ( $comments ) {
					foreach ( $comments as $comment ) {
						ob_start();
				?>

					<li>
						<a href="">
							<span class="author-link">
								<?php echo get_avatar( $comment, $size = '50' ); ?>
							</span>
						</a>

						<div class="post-detail">
							<span>
								<?php echo get_comment_author_link( $comment->comment_ID ); ?>
								<?php esc_html_e( 'on', 'tokoo' ); ?>
							</span>
							<h4 class="entry-title">
								<a href="<?php echo esc_url( get_permalink( $comment->comment_post_ID ) . '#comment-' . $comment->comment_ID ); ?>">
									<?php echo get_the_title( $comment->comment_post_ID ) ?>
								</a>
							</h4>
							<small class="date">
								<span class="drip-icon-calendar"></span>
								<?php echo get_the_time( 'j F Y' ); ?>
							</small>
						</div>

					</li>

					<?php ob_end_flush();
					}
				} else { // If no comments  ?>

					<li><?php esc_html_e( 'No comments.', 'tokoo' ); ?></li>

			<?php } ?>

			</ul>

		<?php

		printf( $after_widget );
		// End Widget
	}

} // class

}
