<?php

/**
 * Get all categories
 *
 * @return void
 * @author tokoo
 **/
function tokoo_get_categories() {

	$cats 	= get_categories( array( 'hide_empty' => 0 ) );
	$result = array();
	foreach ( $cats as $cat ) {
		$result[$cat->cat_ID] = $cat->name;
	}

	return $result;
}

/**
 * Get all users
 *
 * @return void
 * @author tokoo
 **/
function tokoo_get_users() {
	$users 		= get_users();
	$result 	= array();
	foreach ( $users as $user ) {
		$result[] = array( 'value' => $user['id'], 'label' => $user['display_name'] );
	}
	return $result;
}

/**
 * Get all posts
 *
 * @return void
 * @author
 **/
function tokoo_get_posts() {

	$posts = get_posts( array(
		'posts_per_page' => -1,
	));

	$result = array();
	foreach ( $posts as $post )	{
		$result[$post->ID] = $post->post_title;
	}
	return $result;
}

/**
 * Get all pages
 *
 * @return void
 * @author tokoo
 **/
function tokoo_get_pages() {
	$pages 	= get_pages();
	$result = array();
	foreach ( $pages as $page ) {
		$result[$page->ID] = $page->post_title;
	}
	return $result;
}

/**
 * Get all tags
 *
 * @return void
 * @author tokoo
 **/
function tokoo_get_tags() {
	$tags 	= get_tags( array( 'hide_empty' => 0 ) );
	$result = array();
	foreach ( $tags as $tag ) {
		$result[$tag->term_id] = $tag->name;
	}
	return $result;
}

/**
 * Get Revolution Slider list
 *
 * @return void
 * @author tokoo
 **/
function tokoo_get_revolsider_list() {
	/**
	 * Get Revo Slider list
	 *
	 * @link https://github.com/WebDevStudios/Custom-Metaboxes-and-Fields-for-WordPress/issues/375
	 */
	global $wpdb;
	$sql 			= 'SELECT * FROM ' . $wpdb->prefix . 'revslider_sliders';
	$get_sliders 	= $wpdb->get_results( $wpdb->prepare( $sql ), ARRAY_A );

	if ( ! empty( $get_sliders ) ) {
		$revsliders['Default'] =  esc_html__( 'Select a Slider', 'tokoo' );
		foreach( $get_sliders as $slider ) {
			$revsliders[$slider->title] = $slider->alias;
		}
	} else {
		$revsliders['None'] =  esc_html__( 'No Slider Found', 'tokoo' );
	}

	return $revsliders;
}

/**
 * Get all registered sidebar
 *
 * @return void
 * @author tokoo
 **/
function tokoo_get_all_sidebars() {
	global $wp_registered_sidebars;
	$all_sidebars = array();
	if ( $wp_registered_sidebars && ! is_wp_error( $wp_registered_sidebars ) ) {
		foreach ( $wp_registered_sidebars as $sidebar ) {
			$all_sidebars[$sidebar['id']] = $sidebar['name'];
		}
	}
	return $all_sidebars;
}

/**
 * Get all ninja form list
 *
 * @return void
 * @author tokoo
 **/
function tokoo_get_all_ninja_forms() {

	if ( function_exists( 'ninja_forms_get_all_forms' ) ) {
		$ninja_forms = ninja_forms_get_all_forms();
		if ( ! empty( $ninja_forms ) ) {
			foreach( $ninja_forms as $form ){
				$all_forms[0] 			= esc_html__( '-- None --', 'tokoo' );
				$all_forms[$form['id']] = $form['name'];
			}
		} else {
			$all_forms[0] 		= esc_html__( 'No Form Available', 'tokoo' );
		}

		return $all_forms;
	} else {
		return array( 0 => esc_html__( 'Ninja Form not installed', 'tokoo' ) );
	}
}


/**
 * Get all registered post type
 *
 * @return void
 * @author tokoo
 **/
function tokoo_get_registered_post_types() {

	$types = get_post_types( array( 'public'   => true, ), 'objects' );
	$results = array();
	foreach ( $types as $type ) {
		$result[$type->name] = $type->labels->singular_name;
	}

	return $results;
}


/**
 * Get all categories for widget field
 *
 * @return void
 * @author tokoo
 **/
function tokoo_widget_get_categories() {

	$cats 	= get_categories( array( 'hide_empty' => 0 ) );
	$results = array();
	foreach ( $cats as $cat ) {
		$results[] = array(
			'name' 	=> $cat->slug,
			'value' => $cat->name
			);
	}

	return $results;
}

/**
 * Get all registered post type for widget field
 *
 * @return void
 * @author tokoo
 **/
function tokoo_widget_get_registered_post_types() {

	$types = get_post_types( array( 'public'   => true, ), 'objects' );
	$results = array();
	foreach ( $types as $type ) {
		$results[] = array(
			'name' 		=> $type->labels->singular_name,
			'value' 	=> $type->name
		);
	}

	return $results;
}