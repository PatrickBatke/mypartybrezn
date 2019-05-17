<?php

/**
 * Template Name: Shop With Sidebar
 *
 * The Template for page template blog standard
 *
 * @author 		tokoo
 * @version     2.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! class_exists( 'WooCommerce' ) ) {
	echo esc_html__( 'This page only working if WooCommerce plugin activated', 'tokoo' );
	return;
}
?>

<?php get_header(); // Loads the header.php template. ?>

	<?php
			/**
			 * woocommerce_before_main_content hook
			 *
			 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
			 */
			do_action( 'woocommerce_before_main_content' );
		?>

	<?php
		if ( 0 != get_query_var( 'paged' ) ) {
			$paged = absint( get_query_var( 'paged' ) );
		} elseif ( 0 != get_query_var( 'page' ) ) {
			$paged = absint( get_query_var( 'page' ) );
		} else {
			$paged = 1;
		}

		$block_args = array(
			'post_type' 		=> 'product',
			'posts_per_page' 	=> get_option( 'posts_per_page' ),
			'paged' 			=> $paged
		);

		$temp 		= $wp_query;
		$wp_query 	= null;
		$wp_query 	= new WP_Query();
		$wp_query->query( $block_args );
	?>

	<?php if ( $wp_query->have_posts() ) : ?>

		<div class="products-sorting">

			<?php
				/**
				 * woocommerce_before_shop_loop hook
				 *
				 * @hooked woocommerce_result_count - 20: removed
				 * @hooked woocommerce_catalog_ordering - 30: removed
				 * @hooked tokoo_product_browse_by_tags - 20
				 * @hooked tokoo_product_loop_nav_above - 30
				 */
				do_action( 'woocommerce_before_shop_loop' );
			?>

		</div> <!-- productsorting -->

		<?php woocommerce_product_loop_start(); ?>

			<?php while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>

				<?php wc_get_template_part( 'content', 'product' ); ?>

			<?php endwhile; // End while loop. ?>

		<?php woocommerce_product_loop_end(); ?>

		<?php if ( get_previous_posts_link() || get_next_posts_link() ) : ?>
				<div class="posts-navigation pagination">
					<?php get_template_part( 'loop', 'nav' ); ?>
				</div> <!-- .pagination -->
			<?php endif; ?>

		<?php else : ?>

			<?php wc_get_template( 'loop/no-products-found.php' ); ?>

	<?php
		endif;
		$wp_query = null;
		$wp_query = $temp;  // Reset
	?>

	<?php wp_reset_postdata(); ?>

	<?php
		/**
		 * woocommerce_after_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action( 'woocommerce_after_main_content' );
	?>

<?php get_footer(); // Loads the footer.php template. ?>