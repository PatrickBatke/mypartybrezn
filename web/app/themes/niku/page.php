<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package tokoo
 */

get_header(); ?>

	<?php 
		/**
		 * tokoo_before_main_content hook
		 *
		 * @hooked tokoo_wrapper_start - 10 (outputs opening divs for the content)
		 */
		do_action( 'tokoo_before_main_content' );
	 ?>

		<div class="posts-holder">
		
			<?php if ( have_posts() ) : ?>

				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'content', 'page' ); ?>

				<?php endwhile; ?>

			<?php endif; ?>

		</div>
		
	<?php 
		/**
		 * tokoo_after_main_content hook
		 *
		 * @hooked tokoo_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action( 'tokoo_after_main_content' );
	 ?>

<?php get_footer(); ?>
