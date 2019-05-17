<?php

if ( class_exists( 'Tokoo_Widget' ) ) {

/**
 * @package Image Upload Widget
 */

class Tokoo_Banner_Image extends WP_Widget {

	/**
	 * Register widget with Wordcodess.
	 */
	public function __construct() {
		parent::__construct(
			'Tokoo_Banner_Image', // Base ID
			esc_html__( 'Tokoo - Banner Image / Advertisement', 'tokoo' ), // Name

			array(
				'classname' => 'widget-advertisement no-padding ads-block',
				'description' => esc_html__( 'A widget to display banner image attachment', 'tokoo' )
			) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		extract( $args );
		$title 		= apply_filters( 'widget_title', $instance['title'] );
		$link 		= apply_filters( 'widget_link', $instance['link'] );
		$image_uri 	= apply_filters( 'widget_image_uri', $instance['image_uri'] );
		$size 		= apply_filters( 'widget_image_size', $instance['image_size'] );

		printf( $args['before_widget'] );

		if ( ! empty( $title ) )
			printf( '%s %s %s', $args['before_title'], $title, $args['after_title'] );

		?>
			<?php if ( ! empty( $size ) ) : ?>
				<?php
					$banner_size 	= explode( 'x', $size );
					$img_width 		= $banner_size[0];
					$img_height 	= $banner_size[1];
				 ?>
			<?php else : ?>
				<?php
					$img_width 		= 336;
					$img_height 	= 280;
				 ?>
			<?php endif; ?>

			<div class="ads-wrapper">
				<a href="<?php echo esc_url( $instance['link'] ); ?>">
					<img src="<?php echo esc_url( tokoo_resize( $image_uri, $img_width, $img_height ) ); ?>" width="<?php echo esc_attr( $img_width ); ?>" height="<?php echo esc_attr( $img_height ); ?>" alt="<?php echo esc_attr( $title ); ?>" />
				</a>
			</div>

	<?php
		printf( $args['after_widget'] );
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance 				= array();
		$instance['title'] 		= ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['link'] 		= ( ! empty( $new_instance['link'] ) ) ? strip_tags( $new_instance['link'] ) : '';
		$instance['image_uri'] 	= ( ! empty( $new_instance['image_uri'] ) ) ? strip_tags( $new_instance['image_uri'] ) : '';
		$instance['image_size'] = ( ! empty( $new_instance['image_size'] ) ) ? strip_tags( $new_instance['image_size'] ) : '';
		return $instance;
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		if ( isset( $instance[ 'image_uri' ] ) ) {
			$image_uri = $instance[ 'image_uri' ];
		}
		else {
			$image_uri = '';
		}

		if ( isset( $instance[ 'image_size' ] ) ) {
			$size = $instance[ 'image_size' ];
		}
		else {
			$size = '406x338';
		}

		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}
		else {
			$title = esc_html__( 'New title', 'tokoo' );
		}
		if ( isset( $instance[ 'link' ] ) ) {
			$link = $instance[ 'link' ];
		}
		else {
			$link = '';
		}
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title', 'tokoo' ); ?></label><br />
			<input type="text" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" value="<?php echo esc_attr( $title ); ?>" class="widefat" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'link' ) ); ?>"><?php esc_html_e( 'Link', 'tokoo' ); ?></label><br />
			<input type="text" name="<?php echo esc_attr( $this->get_field_name( 'link' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'link' ) ); ?>" value="<?php echo esc_attr( $link ); ?>" class="widefat" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'image_size' ) ); ?>"><?php esc_html_e( 'Size', 'tokoo' ); ?></label><br />
			<input type="text" name="<?php echo esc_attr( $this->get_field_name( 'image_size' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'image_size' ) ); ?>" value="<?php echo esc_attr( $size ); ?>" class="widefat" />
			<?php esc_html_e( 'Set the banner image size <code>Ex: 406x338</code>', 'tokoo' ); ?>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'image_uri' ) ); ?>"><?php esc_html_e( 'Image', 'tokoo' ); ?></label><br />
			<img class="custom_media_image" src="<?php echo esc_url( $image_uri ); ?>" style="margin:0;padding:0;max-width:100%;float:left;display:inline-block" />
			<input type="text" class="widefat custom_media_url" name="<?php echo esc_attr( $this->get_field_name( 'image_uri' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'image_uri' ) ); ?>" value="<?php echo esc_attr( $image_uri ); ?>">
		</p>
		<p>
			<input type="button" value="<?php esc_html_e( 'Upload Image', 'tokoo' ); ?>" class="button custom_media_upload" id="custom_image_uploader"/>
		</p>
		<?php
	}

}

}
