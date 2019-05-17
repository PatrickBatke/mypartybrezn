<?php

/*-----------------------------------------------------------------------------------*/
/*	Koo Section Title Shortcodes
/*-----------------------------------------------------------------------------------*/
$css 		= '';
$atts 		= vc_map_get_attributes( $this->getShortcode(), $atts );

extract( $atts );

$the_title_color = ! empty( $title_color ) ? "style=color:{$title_color}" : '';

switch ( $alignment ) {
	case 'left':
		$text_alignment = 'left';
		break;

	case 'right':
		$text_alignment = 'right';
		break;

	default:
		$text_alignment = 'center';
		break;
}

if ( ! empty( $font_size ) ) {
	$the_font_size = $font_size;
}

?>

<?php if ( $title ) : ?>
	<h2 class="section-title" style="text-align:<?php echo esc_attr( $text_alignment ); ?>;font-size:<?php echo esc_attr( $the_font_size ); ?>">
		<span <?php echo esc_attr( $the_title_color ); ?>><?php echo esc_attr( $title ); ?></span>
	</h2>
<?php endif ?>