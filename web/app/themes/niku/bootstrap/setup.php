<?php

/**
 * Initial setup theme
 *
 * @return void
 * @author tokoo
 **/
add_action( 'after_setup_theme', 'tokoo_setup' );
function tokoo_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 */
	load_theme_textdomain( 'tokoo', get_template_directory() . '/languages' );

	/**
	 * Set the content width based on the theme's design and stylesheet.
	 */
	global $content_width;
	if ( ! isset( $content_width ) ) {
		$content_width = 667; /* pixels */
	}

	add_theme_support( 'title-tag' );
	add_theme_support( 'automatic-feed-links' );
	$args = array(
		'wp-head-callback'	=> 'tokoo_header_image_style',
		'flex-height'		=> true,
		'flex-width'		=> true,
		'width'				=> 1600,
		'height'			=> 200,
	);
	//add_theme_support( 'custom-header', $args );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}

/**
 * Register base sidebar
 *
 * @return void
 * @author Kreativ
 **/
add_action( 'widgets_init', 'tokoo_register_primary_sidebar' );
function tokoo_register_primary_sidebar() {

	$sidebars = include( get_template_directory() . '/app/config/sidebars-config.php' );

	if ( is_array( $sidebars ) && ! empty( $sidebars ) ) {
		foreach ( $sidebars as $sidebar ) {
			$sidebar['name'] = $sidebar['name'];

			if ( isset( $sidebar['description'] ) ) {
				$sidebar['description'] = $sidebar['description'];
			}

			register_sidebar( $sidebar );
		}
	}

}


/** ======================================================================== *
 *  Load All Configuration 													 *
 ** ======================================================================== */

	new Tokoo_Autoloaders();

/* ================================ END =================================== */

