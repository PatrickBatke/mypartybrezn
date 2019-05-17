<?php

/*-----------------------------------------------------------------------------------*/
/*	Koo Booking Form Shortcodes
/*-----------------------------------------------------------------------------------*/
$css 		= '';
$atts 		= vc_map_get_attributes( $this->getShortcode(), $atts );

extract( $atts );

echo do_shortcode( '[booking-form]' );