<?php

/*-----------------------------------------------------------------------------------*/
/*	Testimonial Box Shortcodes
/*-----------------------------------------------------------------------------------*/
$css 		= '';
$atts 		= vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$google_fonts_field 			= $this->getParamData( 'google_fonts' );
$font_container_field 			= $this->getParamData( 'font_container' );
$font_container_obj 			= new Vc_Font_Container();
$google_fonts_obj 				= new Vc_Google_Fonts();
$font_container_field_settings 	= isset( $font_container_field['settings'], $font_container_field['settings']['fields'] ) ? $font_container_field['settings']['fields'] : array();
$google_fonts_field_settings 	= isset( $google_fonts_field['settings'], $google_fonts_field['settings']['fields'] ) ? $google_fonts_field['settings']['fields'] : array();
$google_fonts_data 				= strlen( $google_fonts ) > 0 ? $google_fonts_obj->_vc_google_fonts_parse_attributes( $google_fonts_field_settings, $google_fonts ) : '';
$google_fonts_family 			= ! empty( $google_fonts_data ) ? explode( ':', $google_fonts_data['values']['font_family'] ) : '';

$settings = get_option( 'wpb_js_google_fonts_subsets' );
if ( is_array( $settings ) && ! empty( $settings ) ) {
	$subsets = '&subset=' . implode( ',', $settings );
} else {
	$subsets = '';
}

$font_families = ( isset( $google_fonts_family[0] ) && ! empty( $google_fonts_family[0] ) ) ? $google_fonts_family[0] : 'Open_Sans';
$values_font_families = ( isset( $google_fonts_data['values']['font_family'] ) && ! empty( $google_fonts_data['values']['font_family'] ) ) ? $google_fonts_data['values']['font_family'] : 'Open+Sans';
if ( isset( $google_fonts_family ) ) {
	wp_enqueue_style( 'vc_google_fonts_' . $font_families, '//fonts.googleapis.com/css?family=' . $values_font_families . $subsets );
}

$font_family = '';
if ( ! empty( $google_fonts_family[0] ) ) {
	$font_family = 'font-family:'.$google_fonts_family[0].';';
}

$content_attributes = '';
if ( ! empty( $content_color ) ) {
	$content_attributes .= 'color:'.$content_color.';';
}
$content_styles = 'style="'.$content_attributes.$font_family.'"';

$name_attributes = '';
if ( ! empty( $name_color ) ) {
	$name_attributes .= 'color:'.$name_color.';';
}
$name_styles = 'style="'.esc_attr( $name_attributes ).'"';

$position_attributes = '';
if ( ! empty( $position_color ) ) {
	$position_attributes .= 'color:'.$position_color.';';
}
$position_styles = 'style="'.esc_attr( $position_attributes ).'"';

$css_class 	= apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );

?>

 <div class="testimonial-box <?php echo esc_attr( $css_class ); ?>">
	<div class="testimonial-content" <?php printf( '%s', $content_styles ); ?>>
		<?php if ( ! empty( $testimonial_content ) ) : ?>
			<blockquote>
				<?php echo wpautop( $testimonial_content ); ?>
			</blockquote>
		<?php endif ?>

	</div>
 	<?php if ( ! empty( $picture ) ) : ?>
 		<?php $url = wp_get_attachment_image_src( $picture, 'full', false ); ?>
		<div class="testimonial-image">
			<img src="<?php echo esc_url( tokoo_resize( $url[0], 48, 48 ) ); ?>" alt="<?php printf( '%s', $name ); ?>" width=48 height=48>
		</div>
 	<?php endif; ?>

	<cite>
		<?php if ( ! empty( $name ) ) : ?>
			<strong <?php printf( '%s', $name_styles ); ?>><?php printf( '%s', $name ); ?></strong>
		<?php endif; ?>
		<?php if ( ! empty( $position ) ) : ?>
			<small <?php printf( '%s', $position_styles ); ?>><?php printf( '%s', $position ); ?></small>
		<?php endif; ?>
	</cite>
</div>
