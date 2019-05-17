<?php

/*-----------------------------------------------------------------------------------*/
/*	Koo Maps Shortcodes
/*-----------------------------------------------------------------------------------*/
$css 		= '';
$atts 		= vc_map_get_attributes( $this->getShortcode(), $atts );

extract( $atts ); ?>

<div id="map-component" style="height:<?php echo esc_attr( $height ); ?>px" data-lat="<?php echo esc_attr( $latitude ); ?>" data-long="<?php echo esc_attr( $longitude ); ?>" data-marker-title="<?php echo esc_attr( $marker_title ); ?>" data-marker-content="<?php echo esc_html( $marker_content ); ?>"></div>