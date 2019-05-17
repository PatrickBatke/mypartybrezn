<?php

/**
 * Template Name: Archive
 *
 * The Template for page template archive
 *
 * @author 		tokoo
 * @version     1.0
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

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<div class="post-content">
			<div class="content">
				<div class="entry-content">

					<div class="archive-wrap">

						<div class="latest-archive">
							<h3 class="section-title"><span><?php esc_html_e( 'Last 20 Posts', 'tokoo' ); ?></span></h3>

							<?php
								$archive_args = array(
									'post_type'		=> 'post',
									'post_status'	=> 'publish',
									'posts_per_page'=> 20,
									'orderby'		=> 'date',
									'order'			=> 'DESC'
								);

								$latest = new WP_Query( $archive_args );
							 ?>

							<?php if ( $latest->have_posts() ) : ?>

								<ul class="archive-list latest-posts-list">

									<?php while ( $latest->have_posts() ) : $latest->the_post(); ?>
										<li>
											<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
											<span>
												- <?php echo tokoo_published_date(); ?>
											</span>
											<span>
												- <?php comments_popup_link( 'No comments yet', '1 comment', '% comments', 'comments-link', 'Comments are off for this post' ); ?>
											</span>
										</li>
									<?php endwhile; ?>
									<?php wp_reset_postdata(); ?>

									</ul>

							<?php endif; ?>

						</div><!-- .col-md-9-archive -->

						<div class="month-archive">
							<h3 class="section-title"><span><?php esc_html_e( 'Monthly Archives', 'tokoo' ); ?></span></h3>
							<ul class="archive-list">
								<?php
								$variable = wp_get_archives( array( 'type' => 'monthly', 'show_post_count' => 'true', 'echo' => 0 ) );
								$variable = str_replace( '&nbsp;(', '<span class="cat-count">', $variable );
								$variable = str_replace( ')', '</span>', $variable );
								printf( $variable );
								?>
							</ul>
						</div><!-- .month-archive -->

						<div class="page-archive">
							<h3 class="section-title"><span><?php esc_html_e( 'Page Archives', 'tokoo' ); ?></span></h3>
							<ul class="archive-list">
								<?php wp_list_pages('title_li=&depth=2'); ?>
							</ul>
						</div><!-- .page-archive -->



						<div class="cat-archive">
							<h3 class="section-title"><span><?php esc_html_e( 'Categories', 'tokoo' ); ?></span></h3>
							<ul class="archive-list">
								<?php wp_list_categories( 'depth=0&title_li=&show_count=1' ); ?>
							</ul>
						</div><!-- .cat-archive -->

					</div><!-- .archive-wrap -->

				</div><!-- .entry-content -->
			</div><!-- .content -->
		</div><!-- .post-content -->

	</article>

	<?php
		/**
		 * tokoo_after_main_content hook
		 *
		 * @hooked tokoo_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action( 'tokoo_after_main_content' );
	?>

<?php get_footer(); ?>