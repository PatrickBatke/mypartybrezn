<?php


/**
 * Display admin error message if PHP version is older than 5.3.2.
 * Otherwise execute the main plugin class.
 */
if ( version_compare( phpversion(), '5.3.2', '<' ) ) {

	/**
	 * Display an admin error notice when PHP is older the version 5.3.2.
	 * Hook it to the 'admin_notices' action.
	 */
	add_action( 'admin_notices', 'multipress_old_php_admin_error_notice' );
	function multipress_old_php_admin_error_notice() {
		$message = sprintf( esc_html__( 'The %2$sOne Click Demo Import%3$s plugin requires %2$sPHP 5.3.2+%3$s to run properly. Please contact your hosting company and ask them to update the PHP version of your site to at least PHP 5.3.2.%4$s Your current version of PHP: %2$s%1$s%3$s', 'multipress' ), phpversion(), '<strong>', '</strong>', '<br>' );

		printf( '<div class="notice notice-error"><p>%1$s</p></div>', wp_kses_post( $message ) );
	}
}
else {

	// Current version of the plugin.
	define( 'PT_OCDI_VERSION', '1.2.0' );

	// Path/URL to root of this plugin, with trailing slash.
	define( 'PT_OCDI_PATH', TOKOO_VITAMINS_PATH . '/extensions/importer/' );
	define( 'PT_OCDI_URL', TOKOO_VITAMINS_URL . '/extensions/importer/' );

	// Require main plugin file.
	require PT_OCDI_PATH . 'inc/class-ocdi-main.php';

	// Instantiate the main plugin class *Singleton*.
	$pt_one_click_demo_import = PT_One_Click_Demo_Import::getInstance();
}
