<?php

/**
 * Class to create a custom post control
 */
class Tokoo_Post_Dropdown_Custom_Control extends WP_Customize_Control {
	private $posts = false;

	public function __construct( $manager, $id, $args = array(), $options = array() ) {
		$postargs 		= wp_parse_args( $options, array( 'numberposts' => '-1', 'post_type' => 'page' ) );
		$this->posts 	= get_posts( $postargs );

		parent::__construct( $manager, $id, $args );
	}

	/**
	* Render the content on the theme customizer page
	*/
	public function render_content() {
		if ( ! empty( $this->posts ) ) {
			echo '<label>';
				echo '<span class="customize-control-title">'.esc_html( $this->label ).'</span>';
				echo '<select name="'.$this->id.'" id="'.$this->id.'">';
					foreach ( $this->posts as $post ) {
						printf( '<option value="%s" %s>%s</option>', $post->ID, selected( $this->value(), $post->ID, false ), $post->post_title );
					}
				echo '</select>';
			echo '</label>';
		}
	}
}
