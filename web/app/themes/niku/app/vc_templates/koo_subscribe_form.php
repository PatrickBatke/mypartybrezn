<?php

/*-----------------------------------------------------------------------------------*/
/*	Koo Subscribe Form Shortcodes
/*-----------------------------------------------------------------------------------*/
$css 		= '';
$atts 		= vc_map_get_attributes( $this->getShortcode(), $atts );

extract( $atts ); ?>

<div class="subscribe-section">
	<div class="subscribe-title">
		<span><?php esc_html_e( 'Subscribe', 'tokoo' ); ?></span>
		<strong><?php esc_html_e( 'Newsletter', 'tokoo' ); ?></strong>
		<?php if ( $title ) : ?>
			<small><?php echo esc_attr( $title ); ?></small>
		<?php endif; ?>
	</div>
	<div class="subscribe-form">
		<?php echo do_shortcode( '[mc4wp_form id="{$shortcode}"]' ); ?>
	</div>
</div>