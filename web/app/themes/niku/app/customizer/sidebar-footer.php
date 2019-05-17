<?php 

// ===============================================================================================
// -----------------------------------------------------------------------------------------------
// Sidebar Footer Section
// -----------------------------------------------------------------------------------------------
// ===============================================================================================
add_filter( 'tokoo_new_customizer_data', 'tokoo_sidebar_footer_settings_data' );
function tokoo_sidebar_footer_settings_data( $tokoo_options ) {

	/* ==================================================== *
	 *  Theme Updater Section  										*
	 * ==================================================== */
	$tokoo_options[] = array(
		'slug'		=> 'tokoo_footer_settings',
		'label'		=> esc_html__( 'Footer Settings', 'tokoo' ),
		'priority'	=> 101,
		'panel' 	=> 'tokoo_general_settings',
		'type' 		=> 'section'
	);

		$tokoo_options[] = array(
			'slug'		=> 'tokoo_sidebar_footer_columns',
			'default'	=> '2',
			'priority'	=> 1,
			'label'		=> esc_html__( 'Sidebar Footer Columns', 'tokoo' ),
			'section'	=> 'tokoo_footer_settings',
			'transport'	=> 'refresh',
			'type' 		=> 'select',
			'choices' 	=> array(
				'2' 	=> '2',
				'3' 	=> '3',
				'4' 	=> '4',
			),
		);


	return $tokoo_options;
}