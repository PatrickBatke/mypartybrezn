<?php
/**
 * WooCommerce Uninstall
 *
 * Uninstalling WooCommerce deletes user roles, pages, tables, and options.
 *
 * @package WooCommerce\Uninstaller
 * @version 2.3.0
 */

defined('WP_UNINSTALL_PLUGIN') || exit;

global $wpdb, $wp_version;

function uninstall_brezn_configurator()
{
    $table_name = $wpdb->prefix . 'brezn_ingredients';

    $wpdb->query("DROP TABLE IF EXISTS $table_name");
}
/*
$options = array(
    'myplugin_option_1',
    'myplugin_option_2',
    'myplugin_option_3',
);

foreach ($options as $option) {
    if (get_option($option)) {
        delete_option($option);
    }
}*/

/*
wp_clear_scheduled_hook('woocommerce_scheduled_sales');

if (defined('WC_REMOVE_ALL_DATA') && true === WC_REMOVE_ALL_DATA) {
    include_once dirname(__FILE__) . '/includes/class-wc-install.php';

    // Pages.


    if ($wpdb->get_var("SHOW TABLES LIKE '{$wpdb->prefix}woocommerce_attribute_taxonomies';")) {
        $wc_attributes = array_filter((array) $wpdb->get_col("SELECT attribute_name FROM {$wpdb->prefix}woocommerce_attribute_taxonomies;"));
    } else {
        $wc_attributes = array();
    }

}
*/
