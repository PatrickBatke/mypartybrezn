<?php 

/**
 * Helper function for post type tokoo-testimonials
 *
 * @since 1.0
 **/

/**
 * Get testimony link
 *
 * @return void
 * @author tokoo
 **/
function tokoo_testimonials_get_link() {
	$meta 	= get_post_meta( get_the_ID(), '_testimonials_details', true );
	$link 	= ! empty( $meta['link'] ) ? $meta['link'] : '';

	return $link;
}

/**
 * Get testimony position
 *
 * @return void
 * @author tokoo
 **/
function tokoo_testimonials_get_position() {
	$meta 		= get_post_meta( get_the_ID(), '_testimonials_details', true );
	$position 	= ! empty( $meta['position'] ) ? $meta['position'] : '';

	return $position;
}

/**
 * Get testimony content
 *
 * @return void
 * @author tokoo
 **/
function tokoo_testimonials_get_content() {
	$meta 		= get_post_meta( get_the_ID(), '_testimonials_details', true );
	$content 	= ! empty( $meta['testimony_content'] ) ? $meta['testimony_content'] : '';

	return $content;
}