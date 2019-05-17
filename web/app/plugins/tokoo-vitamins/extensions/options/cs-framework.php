<?php


if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.


/**
 *
 * ----------------------------------------------------------------------------------------------------
 *
 * Codestar Framework
 * A Lightweight and easy-to-use WordPress Options Framework
 *
 * Plugin Name: Codestar Framework
 * Plugin URI: http://codestarframework.com/
 * Author: Codestar
 * Author URI: http://codestarlive.com/
 * Version: 1.0.0
 * Description: A Lightweight and easy-to-use WordPress Options Framework
 * License: GPLv2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain: cs-framework
 *
 * ----------------------------------------------------------------------------------------------------
 *
 * Copyright 2015 Codestar <info@codestarlive.com>
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 *
 * ----------------------------------------------------------------------------------------------------
 *
 */

class CS_Framework {

	/**
	 * Constructor function
	 *
	 * @return void
	 * @author alispx
	 **/
	public function __construct() {
		$this->define_constants();

		add_action( 'init', array( $this, 'includes' ) );

		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
	}

	/**
	 * Define constant
	 *
	 * @return void
	 * @author alispx
	 **/
	public function define_constants() {
		// active modules
		defined( 'CS_VERSION' )     or  define( 'CS_VERSION',     '1.0.0' );
		defined( 'CS_OPTION' )      or  define( 'CS_OPTION',      'tokoo_options' );
		defined( 'CS_CUSTOMIZE' )   or  define( 'CS_CUSTOMIZE',  '_tokoo_customize_options' );
		define( 'CS_ACTIVE_METABOX',    true );
		define( 'CS_ACTIVE_SHORTCODE',  false );
		define( 'CS_ACTIVE_CUSTOMIZE',  true );
		define( 'CS_OPTION_DIR',       plugin_dir_path( __FILE__ ) );
		define( 'CS_OPTION_URI',       plugin_dir_url( __FILE__ ) );
	}

	/**
	 * enqueue scripts
	 *
	 * @return void
	 * @author alispx
	 **/
	public function enqueue_scripts() {

		// admin utilities
		wp_enqueue_media();

		// wp core styles
		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_style( 'wp-jquery-ui-dialog' );

		// framework core styles
		wp_enqueue_style( 'cs-framework', CS_OPTION_URI .'/assets/css/cs-framework.css', array(), '1.0.0', 'all' );
		wp_enqueue_style( 'font-awesome', CS_OPTION_URI .'/assets/css/font-awesome.css', array(), '4.2.0', 'all' );

		// wp core scripts
		wp_enqueue_script( 'wp-color-picker' );
		wp_enqueue_script( 'jquery-ui-dialog' );
		wp_enqueue_script( 'jquery-ui-sortable' );
		wp_enqueue_script( 'jquery-ui-accordion' );

		// framework core scripts
		wp_enqueue_script( 'cs-wysiwyg',    CS_OPTION_URI .'/assets/js/cs-wyswyg-editor.js',    array("jquery"), '1.0.0', true );
		wp_enqueue_script( 'cs-plugins',    CS_OPTION_URI .'/assets/js/cs-plugins.js',    array(), '1.0.0', true );
		wp_enqueue_script( 'cs-framework',  CS_OPTION_URI .'/assets/js/cs-framework.js',  array( 'cs-plugins' ), '1.0.1', true );
		wp_enqueue_script( 'cd-wysiwyg-fix',  CS_OPTION_URI .'/assets/js/cs-wyswyg-fix.js',  array( 'jquery' ), '1.0.1', true );

		$ap_vars = array(
			'url' => get_home_url(),
			'includes_url' => includes_url()
		);
		wp_localize_script( 'cs-wysiwyg', 'ap_vars', $ap_vars );
	}

	/**
	 * Include required files
	 *
	 * @return void
	 * @author alispx
	 **/
	public function includes() {
		require_once CS_OPTION_DIR . 'functions/deprecated.php';
		require_once CS_OPTION_DIR . 'functions/helpers.php';
		require_once CS_OPTION_DIR . 'functions/actions.php';
		require_once CS_OPTION_DIR . 'functions/sanitize.php';
		require_once CS_OPTION_DIR . 'functions/validate.php';

		require_once CS_OPTION_DIR . 'classes/metabox.class.php';
		require_once CS_OPTION_DIR . 'classes/options.class.php';
		require_once CS_OPTION_DIR . 'classes/framework.class.php';
		require_once CS_OPTION_DIR . 'classes/customize.class.php';
	}

}

/**
 *
 * Get option
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if ( ! function_exists( 'cs_get_option' ) ) {
  function cs_get_option( $option_name = '', $default = '' ) {
	$options = apply_filters( 'tokoo_get_option', get_option( CS_OPTION ), $option_name, $default );
	if( ! empty( $option_name ) && ! empty( $options[$option_name] ) ) {
	  return $options[$option_name];
	} else {
	  return ( ! empty( $default ) ) ? $default : null;
	}
  }
}

/**
 *
 * Set option
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if ( ! function_exists( 'cs_set_option' ) ) {
  function cs_set_option( $option_name = '', $new_value = '' ) {
	$options = apply_filters( 'tokoo_set_option', get_option( CS_OPTION ), $option_name, $new_value );
	if( ! empty( $option_name ) ) {
	  $options[$option_name] = $new_value;
	  update_option( CS_OPTION, $options );
	}
  }
}
/**
 *
 * Get all option
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if ( ! function_exists( 'cs_get_all_option' ) ) {
  function cs_get_all_option() {
	return get_option( CS_OPTION );
  }
}

new CS_Framework();

