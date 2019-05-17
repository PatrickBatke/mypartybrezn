<?php

/**
 * Class to create a custom tags control
 */
class Tokoo_Slider_Input_Custom_Control extends WP_Customize_Control {
	
	public $min, $max;

	public function __construct( $manager, $id, $args = array(), $options = array() ) {
		
		$this->min = $args['min'];
		$this->max = $args['max'];

		parent::__construct( $manager, $id, $args );
	}
	/**
	* Render the content on the theme customizer page
	*/
	public function render_content() {
		?>
		<div class="tokoo-slider-control">
			<label for="">
				<span class="customize-category-select-control"><?php echo esc_html( $this->label ); ?></span>
			</label>
			<div class="slider-control-wrap">
				<div class="tokoo-slider-input" data-min="<?php echo $this->min ?>" data-max="<?php echo $this->max ?>"></div>
				<input class="tokoo-slider-value" type="number" min="<?php echo $this->min ?>" max="<?php echo $this->max ?>" <?php $this->link(); ?> value="<?php echo $this->value(); ?>">
			</div>
			
		</div>
		<?php
	}
}
