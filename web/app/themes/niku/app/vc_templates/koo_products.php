<?php

/*-----------------------------------------------------------------------------------*/
/*	Koo Products Shortcodes
/*-----------------------------------------------------------------------------------*/
$css 		= '';
$atts 		= vc_map_get_attributes( $this->getShortcode(), $atts );

extract( $atts );

global $product, $woocommerce_loop, $wp_query;

if ( 0 != get_query_var( 'paged' ) ) {
	$paged = absint( get_query_var( 'paged' ) );
} elseif ( 0 != get_query_var( 'page' ) ) {
	$paged = absint( get_query_var( 'page' ) );
} else {
	$paged = 1;
}

$query_args = array(
	'post_type'           	=> 'product',
	'post_status'         	=> 'publish',
	'ignore_sticky_posts' 	=> 1,
	'orderby'             	=> $orderby,
	'order'               	=> $order,
	'posts_per_page'      	=> $per_page,
	'meta_query'          	=> WC()->query->get_meta_query(),
	'paged'					=> $paged,
);

if ( ! empty( $skus ) ) {
	$query_args['meta_query'][] = array(
		'key'     => '_sku',
		'value'   => array_map( 'trim', explode( ',', $skus ) ),
		'compare' => 'IN'
	);
}

if ( ! empty( $ids ) ) {
	$query_args['post__in'] = array_map( 'trim', explode( ',', $ids ) );
}
if ( ! empty( $offset ) ) {
	$query_args['offset'] = $offset;
}

$columns                     = absint( $columns );
$woocommerce_loop['columns'] = $columns;
$woo_products 	= new WP_Query( apply_filters( 'woocommerce_shortcode_products_query', $query_args ) );

echo '<div class="woocommerce columns-' . $columns . '">';

	if ( $woo_products->have_posts() ) : 

		switch ( $product_image_style ) {
			case 'gid_square':
				$ul_class = 'products--grid-classic';
				break;

			case 'list_square':
				$ul_class = 'products--list square-image';
				break;

			case 'list_circle':
				$ul_class = 'products--list square-circle';
				break;
			
			default:
				$ul_class = '';
				break;
		}
		?>

		<ul class="products <?php echo esc_attr( $ul_class ); ?>">

			<?php while ( $woo_products->have_posts() ) : $woo_products->the_post(); ?>

				<?php
					// Store loop count we're currently on
					if ( empty( $woocommerce_loop['loop'] ) ) {
						$woocommerce_loop['loop'] = 0;
					}

					// Increase loop count
					$woocommerce_loop['loop']++;

					$classes = array();
					// Extra post classes
					if ( 0 == ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] || 1 == $woocommerce_loop['columns'] ) {
						$classes[] = 'first';
					}
					if ( 0 == $woocommerce_loop['loop'] % $woocommerce_loop['columns'] ) {
						$classes[] = 'last';
					}
					?>

					<li <?php post_class( $classes ); ?>>

						<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>

						<figure class="product__image">
							<a href="<?php the_permalink(); ?>">
								<?php tokoo_product_sale_flash();  ?>
								<?php if ( has_post_thumbnail() ) :
									$default_size 	= get_option('shop_catalog_image_size' );
									$thum_width 	= $default_size['width'];
									$thum_height 	= $default_size['height'];
									if ( ! empty( $thumbnail_size ) ) {
										$image_size = explode( 'x', $thumbnail_size );
										if ( ! empty( $image_size ) ) {
											$thum_width 	= $image_size[0];
											$thum_height 	= $image_size[1];
										}
									} ?>
									<img src="<?php echo tokoo_resize( tokoo_get_featured_image_url(), $thum_width, $thum_height ); ?>" alt="<?php the_title(); ?>">
								<?php endif; ?>
							</a>
							<div class="addon">
								<?php
								if ( class_exists( 'YITH_WCQV' ) ) :
									$label = esc_html( get_option( 'yith-wcqv-button-label' ) );
									echo '<a href="#" class="yith-wcqv-button quickview" data-product_id="' . get_the_ID() . '"><i class="simple-icon-eye"></i></a>';
								endif;
								?>
								<?php
									if ( class_exists( 'YITH_WCWL' ) ) : ?>
										<?php echo do_shortcode( '[yith_wcwl_add_to_wishlist label= ""]' );  ?>
									<?php
									endif;
								?>
							</div>
						</figure>
						<div class="product__detail">
							<?php tokoo_product_title(); ?>
							<?php tokoo_product_category(); ?>

							<div class="product__action">
								<?php
									/**
									 * woocommerce_after_shop_loop_item_title hook
									 *
									 * @hooked woocommerce_template_loop_rating - 5: removed
									 * @hooked woocommerce_template_loop_price - 10
									 */
									do_action( 'woocommerce_after_shop_loop_item_title' );
								?>

								<?php
									/**
									 * woocommerce_after_shop_loop_item hook
									 *
									 * @hooked woocommerce_template_loop_add_to_cart - 10
									 */
									do_action( 'woocommerce_after_shop_loop_item' );
								?>
							</div>
						</div>

					</li>

			<?php endwhile; // end of the loop. ?>
			<?php
				wp_reset_postdata();
			?>
		<?php woocommerce_product_loop_end(); ?>

	<?php
		endif;

echo '</div>';