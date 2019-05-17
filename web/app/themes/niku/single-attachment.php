<?php
/**
 * The template for displaying all single attachment.
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

			<?php while ( have_posts() ) : the_post(); ?>

				<div id="post-<?php the_ID(); ?>" <?php post_class( 'type-post' ); ?>>

					<div class="inner-post">

						<?php tokoo_single_post_meta(); ?>

						<div class="entry-details">

							<?php tokoo_single_post_featured_image( 'full' ); ?>
							<h2 class="entry-title"><?php single_post_title(); ?></h2>

							<div class="entry-content">

								<?php if ( has_excerpt() ) : ?>
									<div class="leading"><?php the_excerpt(); ?></div>
								<?php endif; ?>

								<?php the_content(); ?>
								 <?php wp_link_pages( array( 'before' => '<div class="article-paging">' . '<strong>' . esc_html__( 'Pages:', 'tokoo' ) . '</strong>', 'after' => '</div>' ) ); ?>

							</div> <!-- .entry-content -->

						</div><!-- .entry-details -->

					</div> <!-- .inner-post -->

				</div>

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
