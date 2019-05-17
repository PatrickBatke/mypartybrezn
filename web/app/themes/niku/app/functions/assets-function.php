<?php

/**
 * Loads the admin styles & scripts.
 *
 * @since 1.0
 */
add_action( 'admin_enqueue_scripts', 'tokoo_admin_scripts' );
function tokoo_admin_scripts( $hook ) {

	/* Get theme version in style.css. */
	$theme = wp_get_theme( get_template(), get_theme_root( get_template_directory() ) );

	/* Load style for custom widgets. */
	// wp_enqueue_style( 'tokoo-admin', TOKOO_THEME_ASSETS_URI . '/css/admin.css', array(), $theme->Version );

	if ( 'post.php' == $hook || 'post-new.php' == $hook ) {
		wp_enqueue_script( 'tokoo-metabox-control-page', TOKOO_THEME_URI . '/bootstrap/Assets/js/page-metabox.js', array( 'jquery' ), '', true );
	}

	do_action( 'tokoo_admin_scripts' );
}

/**
 * Load widgets js
 *
 * @return void
 * @author tokoo
 **/
add_action( 'admin_enqueue_scripts', 'tokoo_widget_scripts' );
function tokoo_widget_scripts( $hook ) {
	if ( 'widgets.php' === $hook ) {
		wp_enqueue_media();
		wp_enqueue_script( 'tokoo_widgets', TOKOO_THEME_URI . '/bootstrap/Assets/js/tokoo-widgets.js', array( 'jquery' ), '', true );
	}
}

/**
 * Load Shortcode scripts and styles
 *
 * @return void
 * @author
 **/
add_action( 'wp_enqueue_scripts', 'tokoo_koo_shortcodes_scripts' );
function tokoo_koo_shortcodes_scripts() {
	if ( class_exists( 'Koo_Shortcodes' ) ) {
		wp_enqueue_script( 'tokoo_shortcodes_scripts', TOKOO_THEME_URI . '/bootstrap/Assets/js/koo-shortcodes.js', array( 'jquery' ), '', true );
		wp_enqueue_style( 'tokoo_shortcodes_style', TOKOO_THEME_URI . '/bootstrap/Assets/css/koo-shortcodes.css' );
	}
	wp_enqueue_script( 'tokoo_widgets_scripts', TOKOO_THEME_URI . '/bootstrap/Assets/js/tokoo-widgets-frontend.js', array( 'jquery' ), '', true );
	wp_enqueue_style( 'tokoo_widgets_style', TOKOO_THEME_URI . '/bootstrap/Assets/css/koo-widgets.css' );
	wp_enqueue_style( 'tokoo_social_stream', TOKOO_THEME_URI . '/bootstrap/Assets/css/social-stream.css' );
	wp_enqueue_script( 'tokoo-social-streamer', TOKOO_THEME_URI . '/bootstrap/Assets/js/social-streamer.js', array( 'jquery' ), '', false );

}

/**
 * Loads the theme styles & scripts.
 *
 * @since 1.0
 */
add_action( 'wp_enqueue_scripts', 'tokoo_frontend_scripts' );
function tokoo_frontend_scripts() {

	/* Get theme version in style.css. */
	$theme = wp_get_theme( get_template(), get_theme_root( get_template_directory() ) );

	/* Load parent style.css in child theme. */
	if ( is_child_theme() )
		wp_enqueue_style( 'tokoo-parent-style', TOKOO_THEME_ASSETS_URI . '/css/screen.css', array(), $theme->Version );

	/* Load google fonts. */
	wp_enqueue_style( 'tokoo-fonts', '//fonts.googleapis.com/css?family=Montserrat:400,700|Shadows+Into+Light:400|Amatic+SC:400,700', array(), $theme->Version, 'all' );

	/* Load theme fonts */
	wp_enqueue_style( 'tokoo-font-icons', TOKOO_THEME_ASSETS_URI . '/css/font-icons.css', array(), $theme->Version );

	/* Load main style.css */
	wp_enqueue_style( 'style', get_stylesheet_uri(), array(), $theme->Version );
	wp_enqueue_style( 'tokoo-style-main', TOKOO_THEME_ASSETS_URI . '/css/screen.css', array(), $theme->Version );

	/* Load comment reply. */
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	/* Load bundled jQuery. */
	wp_enqueue_script( 'html5', TOKOO_THEME_ASSETS_URI . '/js/ie-support/html5.js', array( 'jquery' ), $theme->Version, true );
	wp_enqueue_script( 'respondjs', TOKOO_THEME_ASSETS_URI . '/js/ie-support/respond.js', array( 'jquery' ), $theme->Version, true );
	wp_script_add_data( 'html5', 'conditional', 'lt IE 9' );
	wp_script_add_data( 'respondjs', 'conditional', 'lt IE 9' );

	/* Load custom js plugins. */
	wp_enqueue_script( 'tokoo-plugins', TOKOO_THEME_ASSETS_URI . '/js/plugins.js', array( 'jquery' ), $theme->Version, true );

	/* Load custom js method. */
	wp_enqueue_script( 'tokoo-main', TOKOO_THEME_ASSETS_URI . '/js/app.js', array( 'jquery', 'tokoo-plugins' ), $theme->Version, true );

	do_action( 'tokoo_frontend_scripts' );
}

/**
 * Custom header callback function
 *
 * @return void
 * @author tokoo
 **/
function tokoo_header_image_style() {
	$style 	= '';
	$style .= '.bottom-header{background-image:url('.get_header_image().')}';
	$style 	= "\n".'<style type="text/css">'.trim( $style ).'</style>'."\n";
	printf( '%s', $style );
}

/**
 * Logo margin top if variant 3
 *
 * @return void
 * @author tokoo
 **/
add_action( 'wp_head', 'tokoo_logo_margin_top', 50 );
function tokoo_logo_margin_top() {
	$margin_top = get_theme_mod( 'tokoo_logo_margin_top' );
	$style 	= '';
	$style .= '.site-header--type-3 .branding{margin-top:'.$margin_top.'px}';
	$style 	= "\n".'<style type="text/css">'.trim( $style ).'</style>'."\n";
	if ( ! empty( $margin_top ) ) {
		printf( '%s', $style );
	}
}

/**
 * shortcode in
 *
 * @return void
 * @author tokoo
 **/
add_filter( 'widget_text' , 'do_shortcode' );