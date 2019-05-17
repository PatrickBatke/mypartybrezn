<?php

/**
 * tokoo functions and definitions
 *
 * @package tokoo
 */

/* Define static constant */
define( 'TOKOO_THEME_DIR', get_template_directory() );
define( 'TOKOO_THEME_URI', get_template_directory_uri() );
define( 'TOKOO_THEME_APP_DIR', TOKOO_THEME_DIR . '/app' );
define( 'TOKOO_THEME_APP_URI', TOKOO_THEME_URI . '/app' );
define( 'TOKOO_THEME_CORE_DIR', TOKOO_THEME_DIR . '/bootstrap/Tokoo' );
define( 'TOKOO_THEME_CORE_URI', TOKOO_THEME_URI . '/bootstrap/Tokoo' );
define( 'TOKOO_THEME_ASSETS_DIR', TOKOO_THEME_APP_DIR . '/assets' );
define( 'TOKOO_THEME_ASSETS_URI', TOKOO_THEME_APP_URI . '/assets' );
define( 'TOKOO_THEME_VERSION', '2.1.10' );

/**
 * Initial setup
 *
 * @return void
 * @author tokoo
 **/
require_once( TOKOO_THEME_DIR . '/bootstrap/TGM-plugin-activation.php' );
require_once( TOKOO_THEME_DIR . '/bootstrap/plugins.php');
require_once( TOKOO_THEME_DIR . '/bootstrap/class-autoloaders.php');
require_once( TOKOO_THEME_DIR . '/bootstrap/setup.php');
require_once( TOKOO_THEME_DIR . '/importer/config.php' );
require_once( TOKOO_THEME_DIR . '/importer/after-import.php' );
require_once( TOKOO_THEME_DIR . '/niku-updater/envato-wp-theme-updater.php' );

add_action( 'update_wpmu_options', 'tokoo_updater_network_setting' );
function tokoo_updater_network_setting() {
	$get_purchase_code 			= get_theme_mod( 'tokoo_purchase_code' );
	$get_personal_access_token 	= get_theme_mod( 'tokoo_personal_access_token' );
	update_site_option( 'tokoo_purchase_code', $get_purchase_code );
	update_site_option( 'tokoo_personal_access_token', $get_personal_access_token );
}

add_action( 'init' , 'niku_theme_update' );
function niku_theme_update() {
	$get_purchase_code 			= tokoo_get_option( 'purchase_code' );
	$get_personal_access_token 	= tokoo_get_option( 'personal_access_token' );

	if ( is_multisite() ) {
		$purchase_code 			= get_site_option( 'tokoo_purchase_code' );
		$personal_access_token 	= get_site_option( 'tokoo_personal_access_token' );
	} else {
		$purchase_code 			= $get_purchase_code;
		$personal_access_token 	= $get_personal_access_token;
	}

	if ( class_exists( 'Niku_Envato_Theme_Update' ) ) {
		new Niku_Envato_Theme_Update( basename( get_template_directory() ) , 
			$purchase_code,
			$personal_access_token,
			true 
		);
	}
}


