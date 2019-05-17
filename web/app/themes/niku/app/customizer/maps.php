<?php 

// ===============================================================================================
// -----------------------------------------------------------------------------------------------
// MAPS Section
// -----------------------------------------------------------------------------------------------
// ===============================================================================================
add_filter( 'tokoo_new_customizer_data', 'tokoo_maps_settings_data' );
function tokoo_maps_settings_data( $tokoo_options ) {

	/* ==================================================== *
	 *  Theme Updater Section  										*
	 * ==================================================== */
	$tokoo_options[] = array(
		'slug'		=> 'tokoo_maps_settings',
		'label'		=> esc_html__( 'Map Setting', 'tokoo' ),
		'priority'	=> 100,
		'panel' 	=> 'tokoo_general_settings',
		'type' 		=> 'section'
	);

		$tokoo_options[] = array(
			'slug'		=> 'tokoo_map_api_key',
			'default'	=> '',
			'priority'	=> 1,
			'label'		=> esc_html__( 'Google Map API Key', 'tokoo' ),
			'section'	=> 'tokoo_maps_settings',
			'transport'	=> 'refresh',
			'type' 		=> 'text',
		);

	return $tokoo_options;
}