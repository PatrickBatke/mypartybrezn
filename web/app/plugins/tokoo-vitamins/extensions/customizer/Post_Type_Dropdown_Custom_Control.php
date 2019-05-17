<?php

/**
 * Class to create a custom post type control
 */
class Tokoo_Post_Type_Dropdown_Custom_Control extends WP_Customize_Control {
	private $postTypes = false;

	public function __construct( $manager, $id, $args = array(), $options = array() ) {
		$postargs = wp_parse_args( $options, array( 'public' => true ) );
		$this->postTypes = get_post_types( $postargs, 'object' );

		parent::__construct( $manager, $id, $args );
	}

	/**
	* Render the content on the theme customizer page
	*/
	public function render_content() {
		if ( empty( $this->postTypes ) ) {
			return false;
		}
		echo '<label>';
			echo '<span class="customize-control-title">'.esc_html( $this->label ).'</span>';
			echo '<select name="'.$this->id.'" id="'.$this->id.'">';
				foreach ( $this->postTypes as $k => $post_type ) {
					printf('<option value="%s" %s>%s</option>', $k, selected( $this->value(), $k, false ), $post_type->labels->name );
				}
			echo '</select>';
		echo '</label>';
	}
}
