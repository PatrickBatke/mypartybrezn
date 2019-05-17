<?php 

// ===============================================================================================
// -----------------------------------------------------------------------------------------------
// Theme Updater Section
// -----------------------------------------------------------------------------------------------
// ===============================================================================================
add_filter( 'tokoo_new_customizer_data', 'tokoo_theme_updater_settings_data' );
function tokoo_theme_updater_settings_data( $tokoo_options ) {

	/* ==================================================== *
	 *  Theme Updater Section  										*
	 * ==================================================== */
	$tokoo_options[] = array(
		'slug'		=> 'tokoo_theme_updater_settings',
		'label'		=> esc_html__( 'Theme Updater', 'tokoo' ),
		'priority'	=> 99,
		'panel' 	=> 'tokoo_general_settings',
		'type' 		=> 'section'
	);

		$tokoo_options[] = array(
			'slug'		=> 'tokoo_purchase_code',
			'default'	=> '',
			'priority'	=> 1,
			'label'		=> esc_html__( 'Purchase Code', 'tokoo' ),
			'section'	=> 'tokoo_theme_updater_settings',
			'transport'	=> 'refresh',
			'type' 		=> 'text',
		);

		$tokoo_options[] = array(
			'slug'		=> 'tokoo_personal_access_token',
			'default'	=> '',
			'priority'	=> 2,
			'label'		=> esc_html__( 'Personal Access Token', 'tokoo' ),
			'section'	=> 'tokoo_theme_updater_settings',
			'transport'	=> 'refresh',
			'type' 		=> 'text',
		);

	return $tokoo_options;
}