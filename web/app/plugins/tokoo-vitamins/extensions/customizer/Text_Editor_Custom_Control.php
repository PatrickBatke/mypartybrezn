<?php

/**
 * Class to create a custom tags control
 */
class Tokoo_Text_Editor_Custom_Control extends WP_Customize_Control {
	/**
	* Render the content on the theme customizer page
	*/
	public function render_content() {
		echo '<label>';
			echo '<span class="customize-control-title">'.esc_html( $this->label ).'</span>';
				$settings = array(
					'textarea_name' 	=> $this->id,
					'drag_drop_upload'=> true,
					'media_buttons' 	=> false,
					'textarea_rows' 	=> 10
				);

				wp_editor( $this->value(), $this->id, $settings );
				do_action( 'admin_print_footer_scripts' );
		echo '</label>';
	}
}
