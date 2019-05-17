<?php
/**
 * Displayed when no products are found matching the current query.
 *
 * Override this template by copying it to yourtheme/woocommerce/loop/no-products-found.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>
<article <?php post_class( 'type-page' ); ?>>

	<div class="inner-post">

		<header class="entry-header">
			<strong class="fourohfour">Not Found</strong>
			<h1 class="entry-title"><?php echo esc_html__( 'YOU ARE BROWSING THE SEARCH RESULT FOR ', 'tokoo' ); echo '"' . get_search_query() . '"'; ?></h1>
		</header><!-- .entry-header -->

		<div class="entry-content">

			<div class="page-search">
				<p><?php esc_html_e( 'Use search form below to find what you are looking for, and checkout our latest articles below', 'tokoo' ); ?></p>

				<?php the_widget( 'WP_Widget_Search' ); ?>
			</div>
			
			<hr class="tokoo-separator">
			
			<section class="random-posts">
				<h3 class="section-title"> <span><?php esc_html_e( 'YOU MAY WANT TO ORDER', 'tokoo' ); ?> </span> </h3>

				<div class="row">
				<?php
					$post_args 	= array(
								'post_type' 			=> 'product',
								'posts_per_page' 		=> 4,
								'post_status' 			=> 'publish',
								'orderby' 				=> 'date',
								'order' 				=> 'rand',
								'ignore_sticky_posts'	=> 1
							);
					$randoms 		= new WP_Query( $post_args );

				if ( $randoms->have_posts() ) : ?>
					<ul class="products">
						<?php while ( $randoms->have_posts() ) : $randoms->the_post(); ?>
							<?php wc_get_template_part( 'content', 'product' ); ?> 
						<?php endwhile; ?>
					</ul>
				<?php endif; ?>

				</div>
			</section>

		</div><!-- .entry-content -->

	</div><!-- .inner-post -->
</article><!-- #post-0 -->
