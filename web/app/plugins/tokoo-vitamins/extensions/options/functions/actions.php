<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.
/**
 *
 * Get icons from admin ajax
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( ! function_exists( 'cs_get_icons' ) ) {
	function cs_get_icons() {

		$jsons = glob( CS_OPTION_DIR . 'fields/icon/*.json' );

		if( ! empty( $jsons ) ) {
			foreach ( $jsons as $path ) {

				$object = json_decode( cs_filesystem()->get_contents( CS_OPTION_URI .'fields/icon/'. basename( $path ) ) );

				echo ( count( $jsons ) >= 2 ) ? '<h4 class="cs-icon-title">'. $object->name .'</h4>' : '';

				foreach ( $object->icons as $icon ) {
					echo '<a class="cs-icon-tooltip" data-icon="'. $icon .'" data-title="'. $icon .'"><span class="cs-icon cs-selector"><i class="'. $icon .'"></i></span></a>';
				}

			}
		}

		do_action( 'cs_add_icons' );

		die();
	}
	add_action( 'wp_ajax_cs-get-icons', 'cs_get_icons' );
}

/**
 *
 * Set icons for wp dialog
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( ! function_exists( 'cs_set_icons' ) ) {
	function cs_set_icons() {

		echo '<div id="cs-icon-dialog" class="cs-dialog" title="'. __( 'Add Icon', 'tokoo-vitamins' ) .'">';
		echo '<div class="cs-dialog-header cs-text-center"><input type="text" placeholder='. __( 'Search a Icon...', 'tokoo-vitamins' ) .'" class="cs-icon-search" /></div>';
		echo '<div class="cs-dialog-load"><div class="cs-icon-loading">'. __( 'Loading...', 'tokoo-vitamins' ) .'</div></div>';
		echo '</div>';

	}
	add_action( 'admin_footer', 'cs_set_icons' );
	add_action( 'customize_controls_print_footer_scripts', 'cs_set_icons' );
}
