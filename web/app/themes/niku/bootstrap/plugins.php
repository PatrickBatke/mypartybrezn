<?php

/**
 * Register the required plugins for this theme.
 *
 * @since 1.0
 */
add_action( 'tgmpa_register', 'tokoo_register_required_plugins' );
function tokoo_register_required_plugins() {

	/* Plugins lists. */
	$plugins = array(

		array(
			'name'     				=> 'Tokoo Vitamins',
			'slug'     				=> 'tokoo-vitamins',
			'source'   				=> 'https://bitbucket.org/tokomoo/tokoo-premium-plugins/raw/227eb29b5607bcb31fcad38c9f170b5825d7276e/tokoo-vitamins-6.2.2.zip',
			'required' 				=> true,
			'version' 				=> '6.2.2',
			'force_activation' 		=> false,
			'force_deactivation' 	=> false
		),

		array(
			'name' 		=> 'Regenerate Thumbnails',
			'slug' 		=> 'regenerate-thumbnails',
			'required' 	=> false,
		),

		array(
			'name' 		=> 'Widget Import / Export',
			'slug' 		=> 'widget-importer-exporter',
			'required' 	=> false,
		),

		array(
			'name' 		=> 'Ninja Forms',
			'slug' 		=> 'ninja-forms',
			'required' 	=> false,
		),

		array(
			'name'     => 'MailChimp for WordPress',
			'slug'     => 'mailchimp-for-wp',
			'required' => false
		),

		array(
			'name'     => 'WooCommerce',
			'slug'     => 'woocommerce',
			'required' => false
		),

		array(
			'name'     => 'YITH WooCommerce Wishlist',
			'slug'     => 'yith-woocommerce-wishlist',
			'required' => false
		),

		array(
			'name'     	=> 'YITH WooCommerce Quick View',
			'slug'     	=> 'yith-woocommerce-quick-view',
			'required' 	=> false
		),

		array(
			'name'     => 'Visual Composer',
			'slug'     => 'js_composer',
			'source'   => 'https://bitbucket.org/tokomoo/tokoo-premium-plugins/raw/f4ef06c175385329b30ca796f776413daf192c04/js_composer.5.5.5.zip',
			'required' => false,
			'version'  => '5.5.5'
		),

		array(
			'name'     => 'Revolution Slider',
			'slug'     => 'revslider',
			'source'   => 'https://bitbucket.org/tokomoo/tokoo-premium-plugins/raw/6def2e9ab03ae3b140dacce20092c5f25f669cd0/revslider.5.4.8.zip',
			'required' => false,
			'version'  => '5.4.8'
		),

		array( 
			'name'     => 'Restaurant Reservation',
			'slug'     => 'restaurant-reservations',
			'required' => false
		),

		array(
			'name'     => 'Food and Drink Menu',
			'slug'     => 'food-and-drink-menu',
			'required' => false
		),

		array(
			'name'     => 'Sidebars Generator',
			'slug'     => 'smk-sidebar-generator',
			'required' => false
		),

	);

	$theme_text_domain = 'tokoo';
	$config = array(
		'domain'            => $theme_text_domain,          // Text domain - likely want to be the same as your theme.
		'default_path'      => '',                      // Default absolute path to pre-packaged plugins.
		'menu'              => 'tokoo-install-plugins', // Menu slug.
		'has_notices'       => true,                    // Show admin notices or not.
		'dismissable'       => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'       => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic'      => false,                   // Automatically activate plugins after installation or not.
		'message'           => '',                          // Message to output right before the plugins table
	);

	tgmpa( $plugins, $config );

}