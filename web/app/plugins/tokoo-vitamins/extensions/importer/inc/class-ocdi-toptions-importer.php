<?php
/**
 * Class for the widget importer used in the One Click Demo Import plugin.
 *
 * Code is mostly from the Widget Importer & Exporter plugin.
 *
 * @see https://wordpress.org/plugins/widget-importer-exporter/
 * @package ocdi
 */

class OCDI_Toptions_Importer {

	/**
	 * Imports widgets from a json file.
	 *
	 * @param string $data_file path to json file with WordPress widget export data.
	 */
	public static function import_theme_options( $import_file_path ) {

		// Make sure we have an import file.
		if ( ! file_exists( $import_file_path ) ) {
			return new WP_Error(
				'missing_toptions_import_file',
				sprintf(
					esc_html__( 'The theme options import file is missing! File path: %s', 'tokoo-vitamins' ),
					$import_file_path
				)
			);
		}

		// Get the upload data.
		$raw  = OCDI_Helpers::data_from_file( $import_file_path );

		// Make sure we got the data.
		if ( is_wp_error( $raw ) ) {
			return $raw;
		}

		$data = unserialize( gzuncompress( stripslashes( call_user_func( 'base'. '64' .'_decode', rtrim( strtr( $raw, '-_', '+/' ), '=' ) ) ) ) );

		if ( is_array( $data ) ) {
			update_option( 'multipress_options', $data );
		}
	}
}
