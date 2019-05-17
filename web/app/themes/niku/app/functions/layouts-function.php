<?php

/**
 * Site Layout:
 * - Standard
 * - Boxed
 * - Fullwidth
 */
function tokoo_site_layout() {
	$layout = '';

	if ( null !== tokoo_get_option( 'site_layout' ) ) {
		$layout = ' ' . tokoo_get_option( 'site_layout' );
	}

	printf ( $layout );
}

/**
 * Add class sticky menu when the sticky menu is activated
 *
 * @return void
 * @author tokoo
 **/
add_filter( 'body_class', 'tokoo_body_class_filter' );
function tokoo_body_class_filter( $classes ) {
	$sticky 			= get_theme_mod( 'tokoo_sticky_header_when_scrolling' );
	$main_product_style = get_theme_mod( 'tokoo_product_style' );
	if ( true == $sticky ) {
		$classes[] = 'has-sticky-header';
	}

	if ( ! empty( get_custom_header()->thumbnail_url ) ) {
		$classes[] = 'has-header-bg';
	}

	if ( ! empty( $main_product_style ) ) {
		if ( is_singular( 'product' ) ) {
			$classes[] = 'layout-'.$main_product_style;
		}
	}
	
	return $classes;
}

