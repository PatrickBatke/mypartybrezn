<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * Override this template by copying it to yourtheme/woocommerce/content-single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version 	3.4.0
 */

if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

/**
 * brezn_configurator check_store_selection hook
 *
 *
 * @hooked check_store_selection
 */
do_action('check_store_selection');

/**
 * brezn_configurator get_store_capacity hook
 *
 *
 * @hooked store_selection
 */
do_action('get_store_capacity');
?>

<?php
    /**
     * woocommerce_before_single_product hook
     *
     * @hooked wc_print_notices - 10
     */
     do_action('woocommerce_before_single_product');

     if (post_password_required()) {
         echo get_the_password_form();
         return;
     }
?>
<div class="row">
  <div class="col col-md-8 mx-auto">
    <h2 class="step-headline">Riesenbrezn & Riesengebäck</h2>
    <div class="stepwizard">
        <div class="stepwizard-row">
            <div class="stepwizard-step">
              <span class="step-circle">1</span>
              <p>Produktwahl</p>
            </div>
            <div class="stepwizard-step">
              <span class="step-circle active">2</span>
              <p>Detailansicht</p>
            </div>
            <div class="stepwizard-step">
              <span class="step-circle">3</span>
              <p>Warenkorb</p>
            </div>
        </div>
    </div>
  </div>
</div>

<article id="product-<?php the_ID(); ?>" <?php post_class('type-page'); ?>>

  <div class="shadow-bow-top shadow-bow-bottom">
    <div class="container">

  		<div class="product-overview">

  				<?php
                      /**
                       * woocommerce_before_single_product_summary hook
                       *
                       * @hooked woocommerce_show_product_sale_flash - 10
                       * @hooked woocommerce_show_product_images - 20
                       */
                      do_action('woocommerce_before_single_product_summary');
                  ?>

  				<div class="product-summary">
            <div class="row">
  					<?php

                          /**
                           * woocommerce_single_product_summary hook
                           *
                           * @hooked woocommerce_template_single_title - 5
                           * @hooked woocommerce_template_single_rating - 10
                           * @hooked woocommerce_template_single_price - 10
                           * @hooked woocommerce_template_single_excerpt - 20 : removed
                           * @hooked woocommerce_template_single_add_to_cart - 30 : removed
                           * @hooked woocommerce_template_single_meta - 40: removed
                           * @hooked woocommerce_template_single_sharing - 50
                           */

                          #do_action('woocommerce_single_product_summary');

                          wc_get_template('single-product/price.php');
                          wc_get_template('single-product/tabs/description.php');
                      ?>

  					<?php #tokoo_single_excerpt();?>
  					<?php tokoo_single_add_to_cart(); ?>
  					<?php #tokoo_single_meta();
                /**
                 * woocommerce_after_single_product_summary hook
                 *
                 * @hooked woocommerce_output_product_data_tabs - 10: removed
                 * @hooked woocommerce_upsell_display - 15
                 * @hooked woocommerce_output_related_products - 20
                 */
                do_action('woocommerce_after_single_product_summary');
            ?>
            </div>
  				</div>
  		</div><!-- .product-review -->

      </div>
    </div>

    <!--
		<div class="product-details">
			<?php #woocommerce_output_product_data_tabs();?>
		</div>
    -->

		<?php get_template_part('partials/prefer-self', 'prefer-self');
        ?>

		<meta itemprop="url" content="<?php the_permalink(); ?>" />

</article><!-- #product-<?php the_ID(); ?> -->

<?php
    /**
     * @hooked tokoo_single_product_categories_list - 10
     */
    do_action('woocommerce_after_single_product');
?>
