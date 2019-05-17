<?php
/**
 * The template for displaying product category thumbnails within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product_cat.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.6.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>
<div <?php wc_product_cat_class( 'card-item', $category ); ?>>

	<div class="inner-product card-inner">

		<?php do_action( 'woocommerce_before_subcategory', $category ); ?>

		<?php
			/**
			 * woocommerce_before_subcategory_title hook
			 *
			 * @hooked woocommerce_subcategory_thumbnail - 10: removed
			 * @hooked tokoo_woocommerce_subcategory_thumbnail - 10
			 */
			do_action( 'woocommerce_before_subcategory_title', $category );
		?>

		<a class="product-detail" href="<?php echo esc_url( get_term_link( $category->slug, 'product_cat' ) ); ?>">

			<div class="product-data card-valigned-content">
				<h3 class="product-category-name">
					<?php
					echo esc_attr( $category->name );

					if ( $category->count > 0 )
						echo apply_filters( 'woocommerce_subcategory_count_html', ' <mark class="count">' . $category->count . '</mark>', $category );
				?>
				</h3>
				<small class="product-category-desc"><?php echo esc_attr( $category->description ); ?></small>

				<span class="button button--outline"><?php esc_html_e( 'Browse shop', 'tokoo' ); ?></span>
			</div>

			<?php
				/**
				 * woocommerce_after_subcategory_title hook
				 */
				do_action( 'woocommerce_after_subcategory_title', $category );
			?>

		</a>

		<?php do_action( 'woocommerce_after_subcategory', $category ); ?>

	</div><!-- .inner-product -->

</div><!-- .product-category -->
