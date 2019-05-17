<?php 

print_r( do_action( 'pt-ocdi/after_import' ) );
add_action( 'pt-ocdi/after_import', 'tokoo_after_import_handling' );
function tokoo_after_import_handling( $selected_import ) {

	print_r( $selected_import['import_revosliders_url'] );
	if ( isset( $selected_import['import_revosliders_url'] ) ) {
		if ( class_exists( 'RevSlider' ) ) {
			$sliders_array = $selected_import['import_revosliders_url'];

			if ( is_array( $sliders_array ) ) {
				foreach ( $sliders_array as $slider_path ) {
					if ( ! empty( $slider_path ) && file_exists( $slider_path ) ) {
						$slider = new RevSlider();
						$slider->importSliderFromPost( true, true, $slider_path );
					}
				}
			} 
		}
	}

	// Set Home
	if ( isset( $selected_import['import_home_page'] ) ) {
		$page = get_page_by_title( $selected_import['import_home_page'] );
		
		if ( isset( $page->ID ) ) {
			update_option( 'page_on_front', $page->ID );
			update_option( 'show_on_front', 'page' );
		}
	}
	
	// Set Blog
	if ( isset( $selected_import['import_blog_page'] ) ) {
		$page = get_page_by_title( $selected_import['import_blog_page'] );
		
		if ( isset( $page->ID ) ) {
			update_option( 'page_for_posts', $page->ID );
			update_option( 'show_on_front', 'page' );
		}
	}

	// Store All Menu
	$menu_locations = array();
	if ( ! empty( $selected_import['import_available_menus'] ) ) {
		foreach ( $selected_import['import_available_menus'] as $key => $value ) {
			$menu = get_term_by( 'name', $value, 'nav_menu' );
			if ( isset( $menu->term_id ) ) {
				$menu_locations[$key] = $menu->term_id;
			}
		}
		// Set Menu If has
		if ( isset( $menu_locations ) ) {
			set_theme_mod( 'nav_menu_locations', $menu_locations );
		}
	}
}
