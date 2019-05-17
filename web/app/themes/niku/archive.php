<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
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

	<?php if ( have_posts() ) : ?>

		<div class="posts-holder minimal-layout">
			
			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', get_post_format() ); ?>

			<?php endwhile; ?>

		</div> <!-- .post-holder -->

		<?php if ( get_previous_posts_link() || get_next_posts_link() ) : ?>
			<div class="posts-navigation">
				<div class="pagination">
					<?php get_template_part( 'loop', 'nav' ); ?>
				</div><!-- .pagination -->
			</div>
		<?php endif; ?>	

	<?php else : ?>

		<?php get_template_part( 'content', 'none' ); ?>

	<?php endif; ?>

	<?php 
		/**
		 * tokoo_after_main_content hook
		 *
		 * @hooked tokoo_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action( 'tokoo_after_main_content' );
	 ?>

	<?php get_sidebar(); ?>
	
<?php get_footer(); ?>
