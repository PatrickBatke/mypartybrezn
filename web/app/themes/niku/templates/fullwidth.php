<?php

/**
 * Template Name: Blank Page
 * 
 * The Template for page template blog standard
 *
 * @author 		tokoo
 * @version     2.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

get_header(); ?>

<?php 
	/**
	 * tokoo_before_main_content hook
	 *
	 * @hooked tokoo_wrapper_start - 10 (outputs opening divs for the content)
	 */
	do_action( 'tokoo_before_main_content' );
?>

	<?php if ( have_posts() ) : ?>

		<?php while ( have_posts() ) : the_post(); ?>

			<?php the_content(); ?>

		<?php endwhile; ?>

	<?php endif; ?>
			
<?php 
	/**
	 * tokoo_after_main_content hook
	 *
	 * @hooked tokoo_wrapper_end - 10 (outputs closing divs for the content)
	 */
	do_action( 'tokoo_after_main_content' );
 ?>
<?php get_footer(); ?>
