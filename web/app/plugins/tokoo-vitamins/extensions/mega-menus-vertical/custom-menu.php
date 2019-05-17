<?php
/*
Plugin Name: Tokokoo Mega Menu
Plugin URL: http://tokokoo.com
Description: A Vitamin for Wordpress Menus, make it able to show Mega Menu and adding icon to menu item
Version: 1.0
Author: Ariona, Rian
Author URI: http://ariona.net
*/

class Tokoo_Mega_Menus {

	protected $has_custom_walker = null;

	/**
	 * Initializes the plugin by setting localization, filters, and administration functions.
	 */
	function __construct() {

		$this->constants();
		$this->load_files();

		add_action( 'admin_enqueue_scripts', array( $this, 'custom_menu_script' ), 10 );
		add_action( 'wp_enqueue_scripts', array( $this, 'load_font_icons' ), 10 );

		add_filter( 'wp_setup_nav_menu_item', array( $this, 'tokoo_add_custom_nav_fields' ) );
		add_action( 'wp_update_nav_menu_item', array( $this, 'tokoo_update_custom_nav_fields' ), 10, 3 );
		add_filter( 'wp_edit_nav_menu_walker', array( $this, 'tokoo_edit_walker' ), 10, 2 );

		// @TO DO  == Add Custom Menu Item
		// add_action( 'admin_init', array( $this, 'add_nav_menu_meta_boxes' ) );


	} // end constructor

	/**
	 * Define constants
	 *
	 * @return void
	 * @author tokoo
	 **/
	function constants() {
		define( 'TOKOO_MEGAMENUS_DIR', trailingslashit( plugin_dir_path( __FILE__ ) ) );
		define( 'TOKOO_MEGAMENUS_URI', trailingslashit( plugin_dir_url( __FILE__ ) ) );
	}

	/**
	 * Load required files
	 *
	 * @return void
	 * @author tokoo
	 **/
	function load_files() {
		require_once( 'edit_custom_walker.php' );
		require_once( 'custom_walker.php' );
	}

	/**
	 * Enqueue Script for admin page menus
	 *
	 * @return void
	 * @author tokoo
	 **/
	function custom_menu_script() {

		wp_enqueue_media();
		wp_enqueue_style( 'custom-menu-style',   TOKOO_MEGAMENUS_URI . '/css/custom-menu.css' );
		wp_enqueue_style( 'font-picker',         TOKOO_MEGAMENUS_URI . '/css/jquery.fonticonpicker.min.css' );
		wp_enqueue_style( 'font-picker-theme',   TOKOO_MEGAMENUS_URI . '/css/jquery.fonticonpicker.grey.min.css' );
		wp_enqueue_style( 'icomoon-icon',        TOKOO_MEGAMENUS_URI . '/fonts/icomoon/style.css' );
		wp_enqueue_style( 'fontello-icon',       TOKOO_MEGAMENUS_URI . '/fonts/fontello-7275ca86/css/fontello.css' );
		wp_enqueue_style( 'themify-icon',        TOKOO_MEGAMENUS_URI . '/fonts/themify-icons/themify-icons.css' );
		wp_enqueue_script( 'font-picker',        TOKOO_MEGAMENUS_URI . '/js/jquery.fonticonpicker.min.js', array('jquery'), '20150526', true );
		wp_enqueue_script( 'custom-menu-script', TOKOO_MEGAMENUS_URI . '/js/custom-menu.js', array('jquery','font-picker'), '20150526', true );

	}

	/**
	 * Enqueue Scripts frontend
	 *
	 * @return void
	 * @author tokoo
	 **/
	function load_font_icons(){
		wp_enqueue_style ( 'icomoon-icon',  TOKOO_MEGAMENUS_URI . '/fonts/icomoon/style.css' );
		wp_enqueue_style ( 'fontello-icon', TOKOO_MEGAMENUS_URI . '/fonts/fontello-7275ca86/css/fontello.css' );
		wp_enqueue_style ( 'themify-icon', TOKOO_MEGAMENUS_URI . '/fonts/themify-icons/themify-icons.css' );
	}

	/**
	 * Add custom fields to $item nav object
	 * in order to be used in custom Walker
	 *
	 * @access      public
	 * @since       1.0
	 * @return      void
	*/
	function tokoo_add_custom_nav_fields( $menu_item ) {

		$menu_item->mega_menu      = get_post_meta( $menu_item->ID, '_menu_item_mega_menu', true );
		$menu_item->background_url = get_post_meta( $menu_item->ID, '_menu_item_background_url', true );
		$menu_item->mm_pb          = get_post_meta( $menu_item->ID, '_menu_item_mm_pb', true );
		$menu_item->mm_pr          = get_post_meta( $menu_item->ID, '_menu_item_mm_pr', true );
		$menu_item->icon_code      = get_post_meta( $menu_item->ID, '_menu_item_icon_code', true );

		return $menu_item;
	}

	/**
	 * Save menu custom fields
	 *
	 * @access      public
	 * @since       1.0
	 * @return      void
	*/
	function tokoo_update_custom_nav_fields( $menu_id, $menu_item_db_id, $args ) {


		if ( isset( $_REQUEST['menu-item-mega_menu'] ) && is_array( $_REQUEST['menu-item-mega_menu'] ) ) {
			$mega_menu_value = $_REQUEST['menu-item-mega_menu'][$menu_item_db_id];
			update_post_meta( $menu_item_db_id, '_menu_item_mega_menu', $mega_menu_value );
		}

		if ( isset( $_REQUEST['menu-item-background_url'] ) && is_array( $_REQUEST['menu-item-background_url'] ) ) {
			$background_url_value = $_REQUEST['menu-item-background_url'][$menu_item_db_id];
			update_post_meta( $menu_item_db_id, '_menu_item_background_url', $background_url_value );
		}

		if ( isset( $_REQUEST['menu-item-mm_pb'] ) && is_array( $_REQUEST['menu-item-mm_pb'] ) ) {
			$mm_pb_value = $_REQUEST['menu-item-mm_pb'][$menu_item_db_id];
			update_post_meta( $menu_item_db_id, '_menu_item_mm_pb', $mm_pb_value );
		}

		if ( isset( $_REQUEST['menu-item-mm_pr'] ) && is_array( $_REQUEST['menu-item-mm_pr'] ) ) {
			$mm_pr_value = $_REQUEST['menu-item-mm_pr'][$menu_item_db_id];
			update_post_meta( $menu_item_db_id, '_menu_item_mm_pr', $mm_pr_value );
		}

		if ( isset( $_REQUEST['menu-item-icon_code'] ) && is_array( $_REQUEST['menu-item-icon_code'] ) ) {
			$menu_item_value = $_REQUEST['menu-item-icon_code'][$menu_item_db_id];
			update_post_meta( $menu_item_db_id, '_menu_item_icon_code', $menu_item_value );
		}

	}

	/**
	 * Define new Walker edit
	 *
	 * @access      public
	 * @since       1.0
	 * @return      void
	*/
	function tokoo_edit_walker( $walker, $menu_id ) {
		return 'Walker_Nav_Menu_Edit_Custom';
	}

}

$GLOBALS['tokoo_mega_menus'] = new Tokoo_Mega_Menus();


