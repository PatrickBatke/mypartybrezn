<?php

/**
 * Template Name: Blog Classic
 *
 * The Template for page template blog standard
 *
 * @author 		tokoo
 * @version     2.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>

<?php get_header(); // Loads the header.php template. ?>

<?php
	/**
	 * tokoo_before_main_content hook
	 *
	 * @hooked tokoo_wrapper_start - 10 (outputs opening divs for the content)
	 */
	do_action( 'tokoo_before_main_content' );
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
		'post_type' 		=> 'post',
		'posts_per_page' 	=> get_option( 'posts_per_page' ),
		'paged' 			=> $paged
	);

	$temp 		= $wp_query;
	$wp_query 	= null;
	$wp_query 	= new WP_Query();
	$wp_query->query( $block_args );
?>

<?php if ( $wp_query->have_posts() ) : ?>

	<div class="posts-holder">

		<?php while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>

			<?php get_template_part( 'content', get_post_format() ); ?>

		<?php endwhile; // End while loop. ?>


	<?php if ( get_previous_posts_link() || get_next_posts_link() ) : ?>
			<div class="posts-navigation pagination">
				<?php get_template_part( 'loop', 'nav' ); ?>
			</div> <!-- .pagination -->
		<?php endif; ?>

	<?php else : ?>

		<?php get_template_part( 'content', 'none' ); ?>

<?php
	endif;
	$wp_query = null;
	$wp_query = $temp;  // Reset
?>

<?php wp_reset_postdata(); ?>

<?php
	/**
	 * tokoo_after_main_content hook
	 *
	 * @hooked tokoo_wrapper_end - 10 (outputs closing divs for the content)
	 */
	do_action( 'tokoo_after_main_content' );
 ?>

<?php get_footer(); // Loads the footer.php template. ?>