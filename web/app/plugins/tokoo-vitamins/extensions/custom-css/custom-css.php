<?php
/**
 * Custom CSS manager
 * 
 * @package TokooVitamins
 * @version 1.0
 * @author Tokoo
 * @copyright Copyright (c) 2015, Tokoo
 * @license license.txt
 */

define( 'TOKOO_CUSTOMCSS_DIR', trailingslashit( plugin_dir_path( __FILE__ ) ) );
define( 'TOKOO_CUSTOMCSS_URI', trailingslashit( plugin_dir_url( __FILE__ ) ) );

/**
 * Enqueue script for Custom CSS related features.
 * 
 * @since 1.0
 */
add_action( 'admin_enqueue_scripts', 'tokoo_custom_css_enqueue' );
function tokoo_custom_css_enqueue( $hook_suffix ) {

	if ( 'appearance_page_tokoo-custom-css' == $hook_suffix ) {
		wp_enqueue_script( 'codemirror', TOKOO_CUSTOMCSS_URI . 'codemirror/lib/codemirror.min.js', array(), '2.3' );
		wp_enqueue_script( 'codemirror-mode-css', TOKOO_CUSTOMCSS_URI . 'codemirror/mode/css/css.min.js', array(), '2.3' );
		wp_enqueue_style( 'codemirror', TOKOO_CUSTOMCSS_URI . 'codemirror/lib/codemirror.css', array(), '2.3' );
		wp_enqueue_style( 'codemirror-theme-neat', TOKOO_CUSTOMCSS_URI . 'codemirror/theme/monokai.css', array(), '2.3' );
		wp_enqueue_script( 'custom-css-js', TOKOO_CUSTOMCSS_URI . 'codemirror/custom-css.js', array( 'jquery' ) );
	}

}

/**
 * Register the form setting.
 *
 * @since 1.0
 */
add_action( 'admin_init', 'tokoo_register_custom_css_setting' );
function tokoo_register_custom_css_setting() {
	register_setting( 'tokoo_custom_css', 'tokoo_custom_css' );
}

/**
 * Add the custom css menu to the admin menu.
 *
 * @since 1.0
 */
add_action( 'admin_menu', 'tokoo_custom_css_menu', 20 );
function tokoo_custom_css_menu() {

	$settings = add_theme_page( __( 'Custom CSS', 'tokoo-vitamins' ), __( 'Custom CSS', 'tokoo-vitamins' ), 'edit_theme_options', 'tokoo-custom-css', 'tokoo_custom_css_page' );

	if ( ! $settings )
		return;

}

/**
 * Render the custom CSS page
 *
 * @since  1.0
 */
function tokoo_custom_css_page() {
	$options 	= get_option( 'tokoo_custom_css' );
	$custom_css = isset( $options['custom_css'] ) ? $options['custom_css']: '';
	$theme 		= wp_get_theme( get_template(), get_theme_root( get_template_directory() ) );
	?>

	<div class="wrap">
		<div id="icon-tools" class="icon32"><br></div>
		<h2><?php _e( 'Custom CSS', 'tokoo-vitamins' ) ?></h2>
		<?php settings_errors(); ?>
	
		<form action="options.php" method="post" style="margin-top:25px">
			<?php settings_fields( 'tokoo_custom_css' ); ?>
			<div id="custom-css-container" style="border:1px solid #DFDFDF;">
				<textarea name="tokoo_custom_css[custom_css]" id="custom-css-textarea"><?php echo ''.$custom_css; ?></textarea>
			</div>
			<p class="description">
				<?php printf( __( 'Easily add custom css rules to %s theme and its child themes', 'tokoo-vitamins' ), ucfirst( $theme->get( 'Name' ) ) ); ?>
			</p>
			<?php submit_button( esc_attr__( 'Save CSS', 'tokoo-vitamins' ) ); ?>
		</form>
	</div>
	<?php
}

/**
 * Sanitize and validate form input.
 *
 * @since 1.0
 */
function tokoo_custom_css_setting_validate( $input ) {
	$input['custom_css'] = $input['custom_css'];
	return $input;
}

/**
 * Hook the data to the wp_head.
 *
 * @since 1.0
 */
add_action( 'wp_head', 'tokoo_custom_css_display', 10 );
function tokoo_custom_css_display() {
	$custom_css = get_option( 'tokoo_custom_css' );
	
	if ( $custom_css != '' ) {
		echo "<!-- Custom Styling -->\n<style type=\"text/css\">\n" . $custom_css['custom_css'] . "\n</style>\n";
	}
}
