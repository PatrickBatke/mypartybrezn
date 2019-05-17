<?php 

/**
 * Helper function for post type tokoo-portfolio
 *
 * @since 1.0
 **/

/**
 * Get client name
 *
 * @return void
 * @author tokoo
 **/
function tokoo_portfolio_get_client_name() {
	$meta 			= get_post_meta( get_the_ID(), '_project_details', true );
	$client_name 	= ! empty( $meta['client'] ) ? $meta['client'] : '';

	return esc_attr( $client_name );
}

/**
 * Get project url
 *
 * @return void
 * @author tokoo
 **/
function tokoo_portfolio_get_url() {
	$meta 	= get_post_meta( get_the_ID(), '_project_details', true );
	$url 	= ! empty( $meta['url'] ) ? $meta['url'] : '';

	return esc_url( $url );
} 

/**
 * Get project gallery ids
 *
 * @return void
 * @author tokoo
 **/
function tokoo_portfolio_get_gallery_ids() {
	$meta 		= get_post_meta( get_the_ID(), '_project_details', true );
	$gallery 	= ! empty( $meta['gallery'] ) ? explode( ',', $meta['gallery'] ) : '';
	
	return $gallery;
}

/**
 * Get project gallery images
 *
 * @return void
 * @author tokoo
 **/
function tokoo_portfolio_gallery_images( $before_image = '', $after_image = '', $image_size = 'medium' ) {
	
	$meta 		= get_post_meta( get_the_ID(), '_project_details', true );

	if ( empty( $meta['gallery'] ) ) return;
		
	$galleries 	= explode( ',', $meta['gallery'] );
	
	if ( ! empty( $galleries ) ) {
		foreach ( $galleries as $gallery ) {
			$image_url = wp_get_attachment_image_src( $gallery, $image_size );
			printf( $before_image );
			echo '<img src="'.esc_url( $image_url[0] ).'" alt="'.__( 'Project Gallery', 'tokoo' ).'">';
			printf( $after_image );

		}
	}
}

/**
 * Get Portfolio Category 
 *
 * @return void
 * @author tokoo
 **/
function tokoo_portfolio_get_categories() {
	$cats 			= wp_get_object_terms( get_the_ID(), 'project_categories' ); 
	$i 				= 0;
	$cats_length 	= count( $cats ); 
	if ( ! empty( $cats ) ) {
		foreach ( $cats as $cat ) { 
			$separator = ( $i !== $cats_length - 1 ) ? ', ' : ''; ?>
			<a href="<?php echo esc_url( get_term_link( $cat->slug, 'project_categories' ) ); ?>" class="portfolio-category"><?php echo esc_attr( $cat->name ) . $separator; ?></a>
		<?php $i++;
		}
	} 
}

/**
 * Get Portfolio Tags 
 *
 * @return void
 * @author tokoo
 **/
function tokoo_portfolio_get_tags() {
	$cats 			= wp_get_object_terms( get_the_ID(), 'project_tags' ); 
	$i 				= 0;
	$cats_length 	= count( $cats ); 
	foreach ( $cats as $cat ) { 
		$separator = ( $i !== $cats_length - 1 ) ? ', ' : ''; ?>
		<a href="<?php echo esc_url( get_term_link( $cat->slug, 'project_tags' ) ); ?>" class="portfolio-tags"><?php echo esc_attr( $cat->name ) . $separator; ?></a>
	<?php $i++;
	} 
}