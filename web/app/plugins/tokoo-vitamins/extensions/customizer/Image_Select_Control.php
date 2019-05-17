<?php

/**
 * Class to create a image select
 */
class Tokoo_Image_Select_Control extends WP_Customize_Control {

	public function render_content() {
		$name = '_customize-radio-' . $this->id;
		?>
		<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
		<?php foreach ( $this->choices as $value => $image ) : ?>
			<?php $class_selected = ( $this->value() == $value ) ? ' mie-radio-img-selected' : ''; ?>
			<label class="image-radio-control">
				<input type="radio" value="<?php echo esc_attr( $value ); ?>" name="<?php echo esc_attr( $name ); ?>" <?php $this->link(); checked( $this->value(), $value ); ?> class="screen-reader-text" />
				<span class="control-image">
					<img src="<?php echo esc_html( $image ); ?>" class="mie-radio-img<?php echo esc_attr( $class_selected ); ?>"/>
				</span>
			</label>
		<?php endforeach;
	}
}