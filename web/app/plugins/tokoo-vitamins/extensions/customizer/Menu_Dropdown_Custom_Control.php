<?php

/**
 * Class to create a custom menu control
 */
class Tokoo_Menu_Dropdown_Custom_Control extends WP_Customize_Control {
	private $menus = false;

	public function __construct( $manager, $id, $args = array(), $options = array() ) {
		$this->menus = wp_get_nav_menus( $options );
		parent::__construct( $manager, $id, $args );
	}

	/**
	 * Render the content on the theme customizer page
	*/
	public function render_content() {
		if ( ! empty( $this->menus ) ) {
			echo '<label>';
				echo '<span class="customize-control-title">'.esc_html( $this->label ).'</span>';
				echo '<select name="'.$this->id.'" id="'.$this->id.'">';
					foreach ( $this->menus as $menu ) {
						printf('<option value="%s" %s>%s</option>', $menu->term_id, selected( $this->value(), $menu->term_id, false ), $menu->name );
					}
				echo '</select>';
			echo '</label>';
		}
	}
}
