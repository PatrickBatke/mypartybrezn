<?php

/*-----------------------------------------------------------------------------------*/
/*	Price Box Shortcodes
/*-----------------------------------------------------------------------------------*/
$atts 		= vc_map_get_attributes( $this->getShortcode(), $atts );

extract( $atts );

$css_class 	= apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );
?>

<div class="price-box <?php echo esc_attr( $css_class ); ?>">

	<div class="price-type">
		<?php if ( ! empty( $price ) ) : ?>
			<div class="price"><?php echo esc_attr( $price ); ?></div>
		<?php endif; ?>
		<?php if ( ! empty( $price_title ) ) : ?>
			<div class="price-title"><?php echo esc_attr( $price_title ); ?></div>
		<?php endif; ?>
	</div>

	<div class="price-detail">
		<?php if ( ! empty( $features_title ) ) : ?>
			<h2 class="feature-title"><?php echo esc_attr( $features_title ); ?></h2>
		<?php endif; ?>

		<?php if ( ! empty( $features_list ) ) : ?>
			<ul>
				<?php $features = explode( ',', $features_list ); ?>
				<?php foreach ( $features as $feature ) : ?>
					<li><?php echo esc_attr( $feature ); ?></li>
				<?php endforeach; ?>
			</ul>
		<?php endif; ?>

		<?php if ( ! empty( $button_label ) ) : ?>
			<a href="<?php echo esc_attr( $button_link ); ?>" class="button"><?php echo esc_attr( $button_label ); ?></a>
		<?php endif; ?>
	</div>

</div>
