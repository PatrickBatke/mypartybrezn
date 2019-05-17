<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       http://tokoo.id
 * @since      1.0
 *
 * @package    Tokoo_Vitamins
 * @subpackage Tokoo_Vitamins/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0
 * @package    Tokoo_Vitamins
 * @subpackage Tokoo_Vitamins/includes
 * @author     alispx <alispx@gmail.com>
 */
class Tokoo_Vitamins {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0
	 * @access   protected
	 * @var      Tokoo_Vitamins_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0
	 */
	public function __construct() {

		$this->plugin_name 	= 'tokoo-vitamins';
		$this->version 		= '6.2.2';

		$this->load_libraries();
		$this->load_files();
		$this->load_dependencies();
		$this->load_extensions();
		$this->set_locale();

	}

	public function load_libraries() {
		require_once TOKOO_VITAMINS_PATH . '/includes/library/extended-taxos.php';
		require_once TOKOO_VITAMINS_PATH . '/includes/library/extended-cpts.php';
		require_once TOKOO_VITAMINS_PATH . '/includes/library/extended-twitter-api.php';
		require_once TOKOO_VITAMINS_PATH . '/includes/library/extended-widget-fields.php';
	}

	/**
	 * Load helper file
	 *
	 * @return void
	 * @author alispx
	 **/
	public function load_files() {
		require_once TOKOO_VITAMINS_PATH . '/includes/tokoo-vitamins-functions.php';
		require_once TOKOO_VITAMINS_PATH . '/includes/tokoo-vitamins-metabox.php';
		require_once TOKOO_VITAMINS_PATH . '/extensions/options/cs-framework.php';
		require_once TOKOO_VITAMINS_PATH . '/extensions/shortcodes/class-koo-shortcodes.php';
		require_once TOKOO_VITAMINS_PATH . '/extensions/custom-css/custom-css.php';
		require_once TOKOO_VITAMINS_PATH . '/extensions/taxonomy-metabox/Tax-meta-class.php';
		require_once TOKOO_VITAMINS_PATH . '/extensions/importer/one-click-demo-import.php';

		if ( ! class_exists( 'Carbon_Fields\Container' ) ) {
			require_once TOKOO_VITAMINS_PATH . '/extensions/carbon-fields/carbon-fields-plugin.php';
		}

		if ( 'pustaka' == get_option( 'template' ) ){
			require_once TOKOO_VITAMINS_PATH . '/extensions/mega-menus-vertical/custom-menu.php';
		} else {
			require_once TOKOO_VITAMINS_PATH . '/extensions/mega-menus/custom-menu.php';
		}

		// Widgets
		if ( class_exists( 'WP_Customize_Control' ) ) {
			require_once TOKOO_VITAMINS_PATH . '/extensions/widgets/class-widget-instagram-grid.php';
			require_once TOKOO_VITAMINS_PATH . '/extensions/widgets/class-widget-instagram-slides.php';
			require_once TOKOO_VITAMINS_PATH . '/extensions/widgets/class-widget-recent-tweets.php';
		}

		// Customizer Font Addon
		require_once TOKOO_VITAMINS_PATH . '/extensions/customizer/TokooCustomizer.php';
		new Tokoo_New_Customizer();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Tokoo_Vitamins_Loader. Orchestrates the hooks of the plugin.
	 * - Tokoo_Vitamins_i18n. Defines internationalization functionality.
	 * - Tokoo_Vitamins_Admin. Defines all hooks for the admin area.
	 * - Tokoo_Vitamins_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0
	 * @access   private
	 */
	private function load_dependencies() {
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-tokoo-vitamins-loader.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-tokoo-vitamins-post-types.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-tokoo-vitamins-i18n.php';

		$this->loader = new Tokoo_Vitamins_Loader();
	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Tokoo_Vitamins_Loader. Orchestrates the hooks of the plugin.
	 * - Tokoo_Vitamins_i18n. Defines internationalization functionality.
	 * - Tokoo_Vitamins_Admin. Defines all hooks for the admin area.
	 * - Tokoo_Vitamins_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0
	 * @access   private
	 */
	private function load_extensions() {
		// new Mega_Menu();
		new Tokoo_Post_Types();
	}


	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Tokoo_Vitamins_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0
	 * @access   private
	 */
	private function set_locale() {
		$plugin_i18n = new Tokoo_Vitamins_i18n();
		$plugin_i18n->set_domain( $this->get_plugin_name() );
		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );
	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Tokoo_Vitamins_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
