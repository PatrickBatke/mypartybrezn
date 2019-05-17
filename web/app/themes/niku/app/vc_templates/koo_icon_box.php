<?php

/*-----------------------------------------------------------------------------------*/
/*	Icon Box Shortcodes
/*-----------------------------------------------------------------------------------*/
$css 		= '';
$atts 		= vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

	switch ( $icon_library ) {
		case 'openiconic':
			$icon_name = $icon_openiconic;
			break;
		case 'typicons':
			$icon_name = $icon_typicons;
			break;
		case 'entypo':
			$icon_name = $icon_entypo;
			break;
		case 'linecons':
			$icon_name = $icon_linecons;
			break;
		default:
			$icon_name = $icon_fontawesome;
			break;
	}

	vc_icon_element_fonts_enqueue( $icon_library );

	$css_class 	= apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );
	switch ( $icon_type ) {
		case 'left':
			$type_class = 'koo-icon-box--left-icon';
			break;
		case 'right':
			$type_class = 'koo-icon-box--right-icon';
			break;
		default:
			$type_class = '';
			break;
	}
	switch ( $icon_style ) {
		case 'circle-outline':
			$icon_style_class = 'koo-icon-box__icon--circle-outline';
			break;
		case 'circle':
			$icon_style_class = 'koo-icon-box__icon--circle';
			break;
		default:
			$icon_style_class = '';
			break;
	}
	switch ( $text_alignment ) {
		case 'left':
			$alignment_class = 'text-align-left';
			break;
		case 'right':
			$alignment_class = 'text-align-right';
			break;
		default:
			$alignment_class = ' ';
			break;
	}
	$style_property = '';
	if ( ! empty( $icon_color ) ) {
		$style_property .= 'color:'.$icon_color.';';
	}
	if ( ! empty( $background_color ) ) {
		$style_property .= 'background-color:'.$background_color.';';
	}
	if ( ! empty( $border_color ) ) {
		$style_property .= 'border-color:'.$border_color.';';
	}
	if ( ! empty( $icon_size ) ) {
		$style_property .= 'font-size:'.$icon_size.'px;';
	}

	$styles = 'style="'.$style_property.'"';

	$title_attributes = '';
	if ( ! empty( $title_size ) ) {
		$title_attributes .= 'font-size:'.$title_size.';';
	}
	if ( ! empty( $title_letter_spacing ) ) {
		$title_attributes .= 'letter-spacing:'.$title_letter_spacing.';';
	}
	$title_styles = 'style="'.esc_attr( $title_attributes ).'"';

	$content_attributes = '';
	if ( ! empty( $content_size ) ) {
		$content_attributes .= 'font-size:'.$content_size.';';
	}
	$content_styles = 'style="'.esc_attr( $content_attributes ).'"';
	?>

	<div class="koo-icon-box <?php echo esc_attr( $type_class ); ?> <?php echo esc_attr( $css_class ); ?>">
		<div class="koo-icon-box__icon <?php echo esc_attr( $icon_style_class ); ?>" <?php printf( $styles ); ?>>
			<?php if ( 'image' == $icon_source ) : ?>
				<?php $get_image_icon = wp_get_attachment_image_src( $image, 'full' ); ?>
				<?php if ( ! empty( $get_image_icon ) ) : ?>
					<img src="<?php echo esc_url( $get_image_icon[0] ); ?>" alt="image icon">
				<?php endif; ?>
			<?php else : ?>
				<i class="<?php echo esc_attr( $icon_name ); ?>"></i>
			<?php endif; ?>
		</div>
		<div class="koo-icon-box__content <?php echo esc_attr( $alignment_class ); ?>" <?php printf( '%s', $content_styles ); ?>>
			<h2 class="koo-icon-box__title  <?php echo esc_attr( $alignment_class ); ?>" <?php printf( '%s', $title_styles ); ?>><?php echo esc_attr( $title ); ?></h2>
			<?php if ( ! empty( $the_content ) ) : ?>
				<?php echo wpautop( $the_content ); ?>
			<?php endif; ?>
			<?php if ( ! empty( $more ) ) : ?>
				<a href="<?php echo esc_url( $more_link ); ?>" class="icon-box__link"><?php echo esc_attr( $more_text ); ?></a>
			<?php endif; ?>
		</div>
	</div><?php printf( '%s', $this->endBlockComment( 'koo_icon_box' ) ); ?>

