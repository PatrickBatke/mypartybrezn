<?php

/*-----------------------------------------------------------------------------------*/
/*	Image Box Shortcodes
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
$google_fonts_family 			= explode( ':', $google_fonts_data['values']['font_family'] );

$settings = get_option( 'wpb_js_google_fonts_subsets' );
if ( is_array( $settings ) && ! empty( $settings ) ) {
	$subsets = '&subset=' . implode( ',', $settings );
} else {
	$subsets = '';
}


if ( isset( $google_fonts_family ) ) {
	wp_enqueue_style( 'vc_google_fonts_' . $google_fonts_family[0], '//fonts.googleapis.com/css?family=' . $google_fonts_data['values']['font_family'] . $subsets );
}

	$css_class 	= apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );

	if ( ! empty( $height ) ) {
		$another_styles = 'min-height:'.$height.'px;"';
	} else {
		$another_styles = '';
	}

	if ( ! empty( $google_fonts_family[0] ) ) {
		$font_family = 'font-family:'.$google_fonts_family[0].'"';
	} else {
		$font_family = '';
	}
	$styles = 'style="'.$another_styles.$font_family;

	if ( ! empty( $title_color ) ) {
		$title_styles = 'color:'.$title_color.';"';
	} else {
		$title_styles = '';
	}
	if ( ! empty( $title_font_size ) ) {
		$title_font = 'font-size:'.$title_font_size.'"';
	} else {
		$title_font = '';
	}
	$title_attributes = 'style="'.$title_styles.$title_font.'"';

	if ( ! empty( $content_color ) ) {
		$content_styles = 'style="color:'.$content_color.'"';
	} else {
		$content_styles = '';
	}
	if ( ! empty( $link_color ) ) {
		$link_styles = 'style="color:'.$link_color.'"';
	} else {
		$link_styles = '';
	}
?>

<div class="imagebox imagebox--align-<?php echo esc_attr( $content_alignment ); ?> bg-<?php echo esc_attr( $bg_position ); ?> <?php echo esc_attr( $css_class ); ?>" <?php printf( '%s', $styles ); ?>>
	<?php if ( ! empty( $overlay_color ) ) : ?>
		<div class="imagebox__overlay" style="background-color: <?php echo esc_attr( $overlay_color ); ?>"></div>
	<?php endif; ?>
	<?php if ( ! empty( $title ) ) : ?>
		<h2 class="imagebox__title" <?php printf( '%s', $title_attributes ); ?>><?php echo esc_attr( $title ); ?></h2>
	<?php endif; ?>
	<div class="imagebox__desc" <?php printf( '%s', $content_styles ); ?>>
		<?php if ( ! empty( $content ) ) : ?>
			<?php echo ''. $content; ?>
		<?php endif; ?>
	</div>
	<?php if ( ! empty( $more_link ) ) : ?>
		<a href="<?php echo esc_url( $more_link ); ?>" class="imagebox__action" <?php printf( '%s', $link_styles ); ?>><?php  echo esc_attr( $more_text ); ?></a>
	<?php endif; ?>

	<?php if ( ! empty( $block_link ) ) : ?>
		<a href="<?php echo esc_url( $more_link ); ?>" class="imagebox__block-link"></a>
	<?php endif; ?>

</div><?php printf( '%s', $this->endBlockComment( 'koo_image_box' ) ); ?>


