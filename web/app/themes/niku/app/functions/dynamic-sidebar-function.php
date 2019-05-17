<?php 

/**
 * Tokoo Dynamic Sidebar Left
 *
 * @return void
 * @author tokoo
 **/
function tokoo_maybe_has_sidebar_left() {

	$page_layout 	= theme_layouts_get_layout();
	$get_sidebar 	= tokoo_get_meta( '_page_details' );
	$get_sidebar_id = isset( $get_sidebar['page_sidebar_left'] ) ? $get_sidebar['page_sidebar_left'] : '' ;

	if ( 'layout-3c' == $page_layout || 'layout-2c-r' == $page_layout  ) :

		// get custom sidebar metabox for single Post and/or Page only
		if ( is_singular() ) {
			$sidebar_id = $get_sidebar_id;
		} else {
			$sidebar_id = '';
		}

		if ( isset( $sidebar_id ) && '' !== $sidebar_id  ) {
			$the_sidebar = get_sidebar( 'alt' );
		} else {
			$the_sidebar = get_sidebar( 'secondary' );
		}

		return $the_sidebar;

	endif;

}

/**
 * Tokoo Dynamic Sidebar Right
 *
 * @return void
 * @author tokoo
 **/
function tokoo_maybe_has_sidebar_right() {
	
	$page_layout 	= theme_layouts_get_layout();
	$get_sidebar 	= tokoo_get_meta( '_page_details' );
	$get_sidebar_id = isset( $get_sidebar['page_sidebar_right'] ) ? $get_sidebar['page_sidebar_right'] : '';

	if ( 'layout-1c' !== $page_layout && 'layout-2c-r' !== $page_layout ) : 

		// get custom sidebar metabox for single Post and/or Page only
		if ( is_singular() ) {
			$sidebar_id = $get_sidebar_id;
		} else {
			$sidebar_id = '';
		}

		if ( isset( $sidebar_id ) && '' !== $sidebar_id  ) {
			$the_sidebar = get_sidebar();
		} else {
			$the_sidebar = get_sidebar( 'primary' );
		}

		return $the_sidebar;
	
	endif;

}

/**
 * Tokoo Dynamic Sidebar
 *
 * @return void
 * @author tokoo
 **/
function tokoo_maybe_has_sidebar( $default='primary' ) {
	
	$get_sidebar 	= tokoo_get_meta( '_page_details' );
	$get_sidebar_id = isset( $get_sidebar['custom_sidebar'] ) ? $get_sidebar['custom_sidebar'] : '';

	// get custom sidebar metabox for single Post and/or Page only
	if ( is_singular() ) {
		$sidebar_id = $get_sidebar_id;
	} else {
		$sidebar_id = '';
	}

	if ( isset( $sidebar_id ) && '' !== $sidebar_id  ) {
		$the_sidebar = get_sidebar();
	} else {
		$the_sidebar = get_sidebar( $default );
	}

	return $the_sidebar;

}