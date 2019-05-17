<?php

/*-----------------------------------------------------------------------------------*/
/*	Koo Section Title Shortcodes
/*-----------------------------------------------------------------------------------*/
$css 		= '';
$atts 		= vc_map_get_attributes( $this->getShortcode(), $atts );

extract( $atts );

$style_property = '';
if ( ! empty( $margin_top ) ) {
	$style_property .= 'margin-top:'.$margin_top.';';
}
if ( ! empty( $margin_bottom ) ) {
	$style_property .= 'margin-bottom:'.$margin_bottom.';';
}
if ( ! empty( $margin_top ) || ! empty( $margin_bottom ) ) {
	$styles = 'style="'.esc_attr( $style_property ).'"';
} else {
	$styles = '';
}
?>

<hr class="tokoo-separator" <?php echo ''. $styles ?>>