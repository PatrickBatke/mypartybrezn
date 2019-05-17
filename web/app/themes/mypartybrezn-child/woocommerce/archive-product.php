<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive.
 *
 * Override this template by copying it to yourtheme/woocommerce/archive-product.php
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

get_header('shop'); ?>

	<?php
        /**
         * woocommerce_before_main_content hook
         *
         * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
         */
        do_action('woocommerce_before_main_content');
    ?>

	<?php // do_action( 'woocommerce_archive_description' ); // move to loop-meta?>

	<?php if (have_posts()) : ?>

		<!--<div class="products-sorting">

			<?php
                /**
                 * woocommerce_before_shop_loop hook
                 *
                 * @hooked woocommerce_result_count - 20: removed
                 * @hooked woocommerce_catalog_ordering - 30: removed
                 * @hooked tokoo_product_browse_by_tags - 20
                 * @hooked tokoo_product_loop_nav_above - 30
                 */
                #do_action('woocommerce_before_shop_loop');
            ?>

		</div> productsorting -->

    <div class="container">
      <div class="row">
        <div class="col col-md-8 mx-auto">
          <h2 class="step-headline">Riesenbrezn & Riesengebäck</h2>
          <div class="stepwizard">
              <div class="stepwizard-row">
                  <div class="stepwizard-step">
                    <span class="step-circle active">1</span>
                    <p>Produktwahl</p>
                  </div>
                  <div class="stepwizard-step">
                    <span class="step-circle">2</span>
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
    </div>

    <div class="shadow-bow-top">
      <div class="container">
    		<div class="row row-divider">
    			<div class="col col-md-8 mx-auto">
            <div class="text-box">
    				  <h2 class="step-headline">
                <span class="step-headline-number">1</span>Produktwahl
              </h2>

              <?php get_template_part('partials/order-information', 'order-information'); ?>

            </div>
    			</div>
    		</div>
      </div>
    </div>

    <div class="container">
      <?php get_template_part('partials/choose-location', 'choose-location'); ?>
    </div>

    <div class="container">
  		<?php woocommerce_product_loop_start();?>

  			<?php if (wc_get_loop_prop('total')) {
                while (have_posts()) {
                    the_post();

                    /**
                     * Hook: woocommerce_shop_loop.
                     *
                     * @hooked WC_Structured_Data::generate_product_data() - 10
                     */
                    do_action('woocommerce_shop_loop');

                    wc_get_template_part('content', 'product');
                }
            }
               ?>

  		<?php woocommerce_product_loop_end(); ?>
    </div>

		<?php
            /**
             * woocommerce_after_shop_loop hook
             *
             * @hooked woocommerce_pagination - 10: removed
             * @hooked tokoo_product_loop_nav_below - 10
             */
            do_action('woocommerce_after_shop_loop');
        ?>

	<?php elseif (! woocommerce_product_subcategories(array( 'before' => woocommerce_product_loop_start(false), 'after' => woocommerce_product_loop_end(false) ))) : ?>

		<?php wc_get_template('loop/no-products-found.php'); ?>

	<?php endif; ?>

	<?php
        /**
         * woocommerce_after_main_content hook
         *
         * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
         */
        do_action('woocommerce_after_main_content');
    ?>

	<?php
        /**
         * woocommerce_sidebar hook
         *
         * @hooked woocommerce_get_sidebar - 10
         */
        do_action('woocommerce_sidebar');
    ?>

    <div class="shadow-bow-bottom">
      <div class="container">
        <div class="row row-divider mb-5">
          <div class="col col-md-8 mx-auto">
            <div class="text-box">
              <p class="text-information">
                *Symbolbild
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <?php get_template_part('partials/prefer-self', 'prefer-self'); ?>

<?php get_footer('shop'); ?>
