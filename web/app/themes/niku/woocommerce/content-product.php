<?php
/**
 * The template for displaying product content within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product.php
 *
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 	3.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

// Ensure visibility
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}
?>

<li <?php post_class(); ?>>

	<?php
		/**
		 * woocommerce_before_shop_loop_item hook.
		 *
		 * @hooked woocommerce_template_loop_product_link_open - 10
		 */
		do_action( 'woocommerce_before_shop_loop_item' );
	?>

		<figure class="product__image">
			<a href="<?php the_permalink(); ?>">
				<?php
					/**
					 * woocommerce_before_shop_loop_item_title hook
					 *
					 * @hooked woocommerce_show_product_loop_sale_flash - 10
					 * @hooked woocommerce_template_loop_product_thumbnail - 10
					 */
					do_action( 'woocommerce_before_shop_loop_item_title' );
				?>

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

			<div class="product__desc"><?php the_excerpt(); ?></div>

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
					 * woocommerce_after_shop_loop_item hook.
					 *
					 * @hooked woocommerce_template_loop_product_link_close - 5
					 * @hooked woocommerce_template_loop_add_to_cart - 10
					 */
					do_action( 'woocommerce_after_shop_loop_item' );
				?>
			</div>
		</div>
</li>