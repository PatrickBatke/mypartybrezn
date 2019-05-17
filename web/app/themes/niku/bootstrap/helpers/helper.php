<?php

/**
 * Function echo the string to avoid using echo dollar directly.
 *
 * @return void
 * @author tokoo
 **/
function tokoo_echo( $string ) {
	printf( $string );
}

/**
 * Wrapping print_r function
 *
 * @return string
 * @author tokoo
 **/
function tokoo_dump( $string ) {
	echo '<pre>';
	var_dump( $string );
	echo '</pre>';
}

/**
* Wrapper function for the Hybrid_Media_Grabber class.  Returns the HTML output for the found media.
*
* @since  1.6.0
* @access public
* @param  array
* @return string
*/
function tokoo_media_grabber( $args = array() ) {
	$media = new MediaGrabber( $args );
	return $media->get_media();
}

/**
* This is just a tiny wrapper function for the class above so that there is no
* need to change any code in your own WP themes. Usage is still the same :)
*/
function tokoo_resize( $url, $width = null, $height = null ) {
	$aq_resize = Aq_Resize::getInstance();
	return $aq_resize->process( $url, $width, $height, true, true, true );
}

/**
 * tokoo primary menu
 *
 * @since  1.0
 * @author tokoo
 **/
function tokoo_header_menu() {
	get_template_part( 'menu', 'primary' );
}

/**
 * tokoo secondary menu
 *
 * @since  2.0
 * @author tokoo
 **/
function tokoo_footer_menu() {
	get_template_part( 'menu', 'secondary' );
}

/**
 * tokoo Metadata
 *
 * @since  1.0
 * @author tokoo
 **/
function tokoo_get_meta( $meta = '', $single = true ) {
	if ( is_singular() ) {
		return get_post_meta( get_the_ID(), $meta, $single );
	} else {
		return false;
	}
}

/*
 * Funcion To Call Option
 *
 * @since  1.0
 */
function tokoo_get_option( $name, $default = null ) {
	return get_theme_mod( "tokoo_" . $name, $default );
}

/**
 * Replaces "[...]" with just ...
 *
 * @since 1.0
 */
add_filter( 'excerpt_more', 'tokoo_auto_excerpt_more' );
function tokoo_auto_excerpt_more( $more ) {
	return ' &hellip;';
}

/**
 * Forked from hybrid_get_the_post_format_url.
 * Filters 'get_the_post_format_url' to make for a more robust and back-compatible function.  If WP did
 * not find a URL, check the post content for one.  If nothing is found, return the post permalink.
 *
 * @since 2.0
 */
function tokoo_get_the_post_format_url( $url = '', $post = null ) {

	if ( empty( $url ) ) {

		$post = is_null( $post ) ? get_post() : $post;

		/* Catch links that are not wrapped in an '<a>' tag. */
		$content_url = preg_match( '/<a\s[^>]*?href=[\'"](.+?)[\'"]/is', make_clickable( $post->post_content ), $matches );

		$content_url = ! empty( $matches[1] ) ? esc_url_raw( $matches[1] ) : '';

		$url = ! empty( $content_url ) ? $content_url : get_permalink( $post->ID );
	}

	return $url;

}

/**
 * Featured Image URL
 *
 * @return void
 * @author tokoo
 **/
function tokoo_get_featured_image_url( $size = 'full' ) {
	$url = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), $size, false );
	return esc_url( $url[0] );
}


/**
 * http://erricgunawan.com/blog/2012/06/30/menampilkan-tanggal-relatif-di-wordpress/
 */
function tokoo_time_since( $older_date, $newer_date = false ) {
	$chunks = array(
		'year'   => 60 * 60 * 24 * 365,
		'month'  => 60 * 60 * 24 * 30,
		'week'   => 60 * 60 * 24 * 7,
		'day'    => 60 * 60 * 24,
		'hour'   => 60 * 60,
		'minute' => 60,
		'second' => 1
	);

	$newer_date = ( $newer_date == false ) ? ( time() + ( 60 * 60 * get_option( "gmt_offset" ) ) ) : $newer_date;
	$since = $newer_date - $older_date;

	foreach ( $chunks as $key => $seconds )
		if ( ( $count = floor( $since / $seconds ) ) != 0 ) break;

	$messages = array(
		'year'   => _n( '%s year ago', '%s years ago', $count, 'tokoo' ),
		'month'  => _n( '%s month ago', '%s months ago', $count, 'tokoo' ),
		'week'   => _n( '%s week ago', '%s weeks ago', $count, 'tokoo' ),
		'day'    => _n( '%s day ago', '%s days ago', $count, 'tokoo' ),
		'hour'   => _n( '%s hour ago', '%s hours ago', $count, 'tokoo' ),
		'minute' => _n( '%s minute ago', '%s minutes ago', $count, 'tokoo' ),
		'second' => _n( '%s second ago', '%s seconds ago', $count, 'tokoo' )
		);
	return sprintf( $messages[$key], $count );
}

/**
 * Get widget template in the folder templates/widget
 *
 * @return void
 * @author tokoo
 **/
function tokoo_get_widget_template( $slug ) {
	return get_template_part( 'templates/widgets/'.$slug );
}

function tokoo_get_customize_option( $option_name = '', $default = '' ) {

	$options = get_option( '_tokoo_customize_options' );

	if( ! empty( $option_name ) && ! empty( $options[$option_name] ) ) {
		return $options[$option_name];
	} else {
		return ( ! empty( $default ) ) ? $default : null;
	}

}