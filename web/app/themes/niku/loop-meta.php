<?php

/**
 * The Template for displaying loop meta
 * used in Taxonomy Pages
 *
 * @author 		tokoo
 * @version     2.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( is_page_template( 'templates/fullwidth.php' ) ) {
	return;
}
?>

<?php
	$get_shop_page_id = get_option( 'woocommerce_shop_page_id' );

	if ( class_exists( 'WooCommerce' ) && ( is_shop() || is_product_category() || is_product_tag() || is_product() || is_woocommerce() || is_account_page() ) ) {
		$the_page_id = $get_shop_page_id;
	} elseif ( is_home() ) {
  		$the_page_id = get_option( 'page_for_posts' );
	} else {
		$the_page_id = get_the_ID();
	}

	//get type background
	$background_type 		= get_theme_mod( 'tokoo_header_background_type' );
	$page_header_background = '';

	if ( 'image' == $background_type ) {
		//if background image
		$page_meta		= get_post_meta( $the_page_id , '_page_details', true );
		$default_image	= get_theme_mod( 'tokoo_header_background_image' );
		
		if ( ! empty( $page_meta['page_header_background'] ) ) {
			//if the background use with page
			$page_header_background = 'background:url(' . wp_get_attachment_url( $page_meta["page_header_background"] ) . ');';
		} else {
			if ( ! empty( $default_image ) ) {
				//if the background with customizer
				$page_header_background = 'background:url(' . $default_image . ');';
			} else {
				//if the backgournd customizer empty
				$page_header_background = 'background:url(' . get_template_directory_uri() . '/app/assets/img/header_default.jpg);';
			}
		}
	} else {
		if ( 'color' == $background_type ) {
			//if background color
			$default_color	= get_theme_mod( 'tokoo_header_background_color' );

			if ( ! empty( $default_color ) ) {
				//if use the background color with customizer
				$page_header_background = 'background:' . $default_color . ';';
			} else {
				//if the backgournd customizer empty
				$page_header_background = 'background:url(' . get_template_directory_uri() . '/app/assets/img/header_default.jpg);';	
			}
		}
	}
	
?>

<div class="page-header" style="<?php echo esc_attr( $page_header_background ); ?>">

	<?php if ( is_home() ) { ?>
		<h2 class="page-title"><?php esc_html_e( 'Blog', 'tokoo' ); ?></h2>
	<?php } elseif ( is_404() ) { ?>

		<h2 class="page-title"><?php esc_html_e( 'Page Not Found', 'tokoo' ); ?></h2>

	<?php } elseif ( is_category() ) { ?>

		<?php $cat_title = single_cat_title( '', false ); ?>
		<h2 class="page-title"><?php printf( wp_kses( __( 'Category: <strong>%s</strong>', 'tokoo' ), array( 'strong' => array() ) ), $cat_title ); ?></h2>

	<?php } elseif ( is_tag() ) { ?>

		<?php $tag_title = single_tag_title( '', false ); ?>
		<h2 class="page-title"><?php printf( wp_kses( __( 'Tag: <strong>%s</strong>', 'tokoo' ), array( 'strong' => array() ) ), $tag_title ); ?></h2>

	<?php } elseif ( is_tax() ) { ?>

		<h2 class="page-title"><?php single_term_title(); ?></h2>

		<div class="loop-description">
			<?php echo term_description( '', get_query_var( 'taxonomy' ) ); ?>
		</div><!-- .loop-description -->

	<?php } elseif ( is_author() ) { ?>

		<?php $author_name = get_the_author_meta( 'display_name', get_query_var( 'author' ) ); ?>
		<h2 class="page-title fn n"><?php printf( wp_kses( __( 'Author: <strong>%s</strong>', 'tokoo' ), array( 'strong' => array() ) ), $author_name ); ?></h2>

		<div class="loop-description">
			<?php echo wpautop( get_the_author_meta( 'description', get_query_var( 'author' ) ) ); ?>
		</div><!-- .loop-description -->

	<?php } elseif ( is_search() ) { ?>

		<h2 class="page-title"><?php echo esc_attr( get_search_query() ); ?></h2>

	<?php } elseif ( is_post_type_archive() ) { ?>

		<?php $post_type = get_post_type_object( get_query_var( 'post_type' ) ); ?>

		<h2 class="page-title">
			<?php
			if ( is_post_type_archive( 'product' ) ) {
				woocommerce_page_title();
			} else {
				post_type_archive_title();
			}
			?>
		</h2>

	<?php } elseif ( is_day() || is_month() || is_year() ) { ?>

		<?php
			if ( is_day() )
				$date = get_the_time( __( 'F d, Y', 'tokoo' ) );
			elseif ( is_month() )
				$date = get_the_time( __( 'F Y', 'tokoo' ) );
			elseif ( is_year() )
				$date = get_the_time( __( 'Y', 'tokoo' ) );
		?>

		<h2 class="page-title"><?php printf( $date ); ?></h2>

	<?php } elseif ( get_page_template_slug( get_the_ID() ) ) { // check if the page using page template ?>

		<h2 class="page-title"><?php echo get_post_field( 'post_title', get_queried_object_id() ); ?></h2>

	<?php } elseif ( is_singular() ) { ?>

		<h2 class="page-title"><?php single_post_title(); ?></h2>

	<?php } // End if check ?>

	<?php get_template_part( 'breadcrumbs' ); ?>

</div> <!-- .page-header -->

