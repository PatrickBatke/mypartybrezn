<?php

/**
 * Class to create a custom post control
 */
class Tokoo_Chosen_Custom_Control extends WP_Customize_Control {
	public $choices = false;

	public function __construct( $manager, $id, $args = array(), $options = array() ) {

		parent::__construct( $manager, $id, $args );
	}

	/**
	* Render the content on the theme customizer page
	*/
	public function render_content() {

		if ( ! empty( $this->choices ) ) {
			echo '<label>';
				echo '<span class="customize-control-title">'.esc_html( $this->label ).'</span>';
				echo '<select' .$this->get_link().' class="koo-chosen" style="width:100%;">';
					foreach ( $this->choices as $value => $label )
						echo '<option value="' . esc_attr( $value ) . '"' . selected( $this->value(), $value, false ) . '>' . $label . '</option>';
				echo '</select>';
			echo '</label>';
		}
	}
}
