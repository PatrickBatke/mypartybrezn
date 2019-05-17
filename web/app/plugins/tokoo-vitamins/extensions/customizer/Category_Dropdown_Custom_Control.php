<?php

/**
 * A class to create a dropdown for all categories in your wordpress site
 */
 class Tokoo_Category_Dropdown_Custom_Control extends WP_Customize_Control {
		private $cats = false;

		public function __construct( $manager, $id, $args = array(), $options = array() ) {
			$this->cats = get_categories($options);
			parent::__construct( $manager, $id, $args );
		}

		/**
		 * Render the content of the category dropdown
		 *
		 * @return HTML
		 */
		public function render_content() {
			if ( ! empty( $this->cats ) ) {
				echo '<label>';
					echo '<span class="customize-control-title">'.esc_html( $this->label ).'</span>';
					echo '<select '. $this->get_link().'>';
							echo '<option value="">' . esc_html__( '--none--', 'festiven' )  . '</option>';
							foreach ( $this->cats as $cat ) {
								printf('<option value="%s" %s>%s</option>', $cat->term_id, selected( $this->value(), $cat->term_id, false ), $cat->name );
							}
					echo '</select>';
				echo '</label>';
			}
		}
}
