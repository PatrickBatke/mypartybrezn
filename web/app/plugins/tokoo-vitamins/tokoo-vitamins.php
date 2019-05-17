<?php

/**
 *
 * @link              http://tokoo.id
 * @since             1.0
 * @package           Tokoo Vitamins
 *
 * @wordpress-plugin
 * Plugin Name:       Tokoo Vitamins
 * Plugin URI:        http://tokoo.id
 * Description:       Extension for tokoo themes.
 * Version:           6.2.2
 * Author:            alispx
 * Author URI:        http://alispx.me/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       tokokoo-vitamins
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

define( 'TOKOO_VITAMINS_PATH', plugin_dir_path( __FILE__ ) );
define( 'TOKOO_VITAMINS_URL', plugin_dir_url( __FILE__ ) );
define( 'TOKOO_VITAMINS_VERSION', '6.2.2' );

require_once plugin_dir_path( __FILE__ ) . 'includes/class-tokoo-vitamins-activator.php';
require_once plugin_dir_path( __FILE__ ) . 'includes/class-tokoo-vitamins-deactivator.php';
require_once plugin_dir_path( __FILE__ ) . 'includes/class-tokoo-vitamins.php';

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-tokoo-vitamins-activator.php
 */
function activate_plugin_name() {
	Tokoo_Vitamins_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-tokoo-vitamins-deactivator.php
 */
function deactivate_plugin_name() {
	Tokoo_Vitamins_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_plugin_name' );
register_deactivation_hook( __FILE__, 'deactivate_plugin_name' );

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0
 */
function run_tokoo_vitamins() {
	$plugin = new Tokoo_Vitamins();
	$plugin->run();
}
run_tokoo_vitamins();

