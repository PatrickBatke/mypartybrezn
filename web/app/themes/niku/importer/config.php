<?php 

/**
 * 20 demo list for Frontend Product
 *
 * @return void
 * @author Kreativenesia
 **/
add_filter( 'tokoo_importer_configs', 'tokoo_config_import_files' );
function tokoo_config_import_files( $configs ) {
	
	$configs[] = array(
		'import_file_name'              => 'Restaurant',
		'import_file_url'               => 'https://bitbucket.org/tokomoo/tokoo-demo-content/raw/c3c0883f1f3f4025c7d0f7fe7f2467fc647d11e4/Niku/restaurant/content.xml',
		'import_widget_file_url'        => 'https://bitbucket.org/tokomoo/tokoo-demo-content/raw/6f279f4f5972c8ac766dad9445f85ed93795899f/Niku/restaurant/widgets.json',
		'import_customizer_file_url'    => 'https://bitbucket.org/tokomoo/tokoo-demo-content/raw/e630f0b8d7d9071eb55f920c5b6fdc31b2d87a6e/Niku/restaurant/customizer.dat',
		'import_preview_image_url'      => 'https://bytebucket.org/tokomoo/tokoo-demo-content/raw/170731b22c27376f56957531b8d0bb4dbbc5845a/Niku/restaurant/screenshot.jpg',
		'import_revosliders_url'      	=> array(
			'Food Four' 	=> get_template_directory() . '/importer/revosliders/food-four.zip',
			'Food Three' 	=> get_template_directory() . '/importer/revosliders/food-three.zip',
			'Food Two' 		=> get_template_directory() . '/importer/revosliders/food-two.zip',
			'Food One' 		=> get_template_directory() . '/importer/revosliders/food-one.zip',
		),
		'import_notice'                 => '',
		'import_demo_url'               => 'http://demo.tokomoo.com/niku/resto/',
		'import_home_page'              => 'Homepage v6',
		'import_blog_page'              => 'Blog',
		'import_available_menus'        => array(
			'primary'		=> 'Lefts Menus',
			'primary-left'	=> 'Main Menu',
			'primary-right'	=> 'Right Menu 2',
			'bottom'		=> 'second-menu',
			'top'			=> 'top menu',
		)
	);

		
	return $configs;
}
