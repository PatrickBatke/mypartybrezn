<?php
/*
* Modified version of koo-shortcodes
* This shortcodes plugin is a fork version from ZillaShortcodes - http://www.themezilla.com/plugins/zillashortcodes
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! class_exists( 'Koo_Shortcodes' ) ) :

class Koo_Shortcodes {

	/**
	 * PHP5 constructor method.
	 *
	 * @since 0.1
	 */
	public function __construct() {
		add_action( 'plugins_loaded', array( &$this, 'constants' ), 1 );
		add_action( 'plugins_loaded', array( &$this, 'includes' ), 3 );
		add_action( 'wp_enqueue_scripts', array( &$this, 'enqueue_frontend_scripts' ) );
		add_action( 'init', array( &$this, 'tinymce' ) );
		add_action( 'admin_enqueue_scripts', array( &$this, 'enqueue_admin_scripts' ) );
	}

	/**
	 * Defines constants used by the plugin.
	 *
	 * @since 0.1
	 */
	public function constants() {
		define( 'SHORTCODE_DIR', trailingslashit( plugin_dir_path( __FILE__ ) ) );
		define( 'SHORTCODE_URI', trailingslashit( plugin_dir_url( __FILE__ ) ) );
		define( 'SHORTCODE_MCE_DIR', SHORTCODE_DIR .'tinymce' );
		define( 'SHORTCODE_MCE_URI', SHORTCODE_URI .'tinymce' );
	}


	/**
	 * Loads the initial files needed by the plugin.
	 *
	 * @since 0.1
	 */
	public function includes() {
		require_once( SHORTCODE_DIR .'shortcodes.php' );
	}
	
	/**
	 * Enqueue scripts & styles for the front-end
	 *
	 * @since 0.1
	 */
	public function enqueue_frontend_scripts() {
		wp_enqueue_script( 'jquery-ui-accordion' );
		wp_enqueue_script( 'jquery-ui-tabs' );
	}
	
	/**
	 * Registers TinyMCE rich editor buttons
	 *
	 * @since 0.1
	 */
	public function tinymce() {
		
		if ( ! current_user_can( 'edit_posts' ) && ! current_user_can( 'edit_pages' ) )
			return;
	
		if ( get_user_option('rich_editing') == 'true' ) {
			add_filter( 'mce_external_plugins', array( &$this, 'add_rich_plugins' ) );
			add_filter( 'mce_buttons', array( &$this, 'register_rich_buttons' ) );
		}

	}
	
	/**
	 * Defins TinyMCE rich editor js plugin
	 *
	 * @since 0.1
	 */
	function add_rich_plugins( $plugin_array ) {
		$plugin_array['kooShortcodes'] = SHORTCODE_MCE_URI . '/plugin.js';
		return $plugin_array;
	}
	
	/**
	 * Adds TinyMCE rich editor buttons
	 *
	 * @since 0.1
	 */
	function register_rich_buttons( $buttons ) {
		array_push( $buttons, "|", 'koo_button' );
		return $buttons;
	}
	
	/**
	 * Enqueue scripts and styles for the admin page
	 *
	 * @since 0.1
	 */
	public function enqueue_admin_scripts() {
		// css
		wp_enqueue_style( 'koo-popup', SHORTCODE_MCE_URI . '/css/popup.css', false, '1.0', 'all' );
		
		// js
		wp_enqueue_script( 'jquery-ui-sortable' );
		wp_enqueue_script( 'jquery-livequery', SHORTCODE_MCE_URI . '/js/jquery.livequery.js', false, '1.1.1', false );
		wp_enqueue_script( 'jquery-appendo', SHORTCODE_MCE_URI . '/js/jquery.appendo.js', false, '1.0', false );
		wp_enqueue_script( 'koo-base64', SHORTCODE_MCE_URI . '/js/base64.js', false, '1.0', false );
		wp_enqueue_script( 'koo-popup', SHORTCODE_MCE_URI . '/js/popup.js', false, '1.0', false );
	}
	
}

	$koo_shortcodes = new Koo_Shortcodes();

endif;
