<?php

/**
 * The Template for displaying content of 404 page
 *
 * @author 		tokoo
 * @version     1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>

<article <?php post_class( 'type-page' ); ?>>

	<div class="inner-post">

		<header class="entry-header">
			<strong class="fourohfour">404</strong>
			<h1 class="entry-title"><?php esc_html_e( 'Oops! That page can\'t be found.', 'tokoo' ); ?></h1>
		</header><!-- .entry-header -->

		<div class="entry-content">

			<div class="page-search">
				<p><?php esc_html_e( 'Use search form below to find what you are looking for, and checkout our latest articles below', 'tokoo' ); ?></p>

				<?php the_widget( 'WP_Widget_Search' ); ?>
			</div>

			<hr class="tokoo-separator">

			<section class="random-posts">
				<h3 class="section-title">
					<span>
						<?php
							if ( class_exists( 'WooCommerce' ) ) {
								esc_html_e( 'YOU MAY WANT TO ORDER', 'tokoo' );
		 					} else {
		 						esc_html_e( 'Here is some article you might like', 'tokoo' );
		 					} 
		 				?>
					</span>
				</h3>
				<div class="row">

				<?php
					if ( class_exists( 'WooCommerce' ) ) {
						$post_type = 'product';
 					} else {
 						$post_type = 'post';
 					}

					$post_args 	= array(
								'post_type' 			=> $post_type,
								'posts_per_page' 		=> 4,
								'post_status' 			=> 'publish',
								'orderby' 				=> 'date',
								'order' 				=> 'rand',
								'ignore_sticky_posts'	=> 1
							);
					$randoms 		= new WP_Query( $post_args );

				if ( $randoms->have_posts() ) : ?>
					<?php
					if ( class_exists( 'WooCommerce' ) ) { ?>
						<ul class="products">
							<?php while ( $randoms->have_posts() ) : $randoms->the_post(); ?>
								<?php wc_get_template_part( 'content', 'product' ); ?> 
							<?php endwhile; ?>
						</ul>
 					<?php } else { ?>
 						<?php while ( $randoms->have_posts() ) : $randoms->the_post(); ?>
							<div class="col-md-3">
								<div class="post">
									<?php tokoo_single_post_featured_image( 'random_thumbnail', 'http://lorempixel.com/300/300' ); ?>
									<h4 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
									<small><?php echo tokoo_published_date(); ?></small>
									<p><?php echo wp_trim_words( $post->post_content, 15 ); ?></p>
								</div>
							</div>
						<?php endwhile; ?>
 					<?php } ?>					
				<?php endif; ?>

				</div>
			</section>

		</div><!-- .entry-content -->

	</div><!-- .inner-post -->
</article><!-- #post-0 -->