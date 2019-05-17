<?php
/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.5.0
 */

if (! defined('ABSPATH')) {
    exit;
}

do_action('woocommerce_before_checkout_form', $checkout);

// If checkout registration is disabled and not logged in, the user cannot checkout.
if (! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in()) {
    echo esc_html(apply_filters('woocommerce_checkout_must_be_logged_in_message', __('You must be logged in to checkout.', 'woocommerce')));
    return;
}

do_action('check_store_selection');
do_action('calculate_capacity');

?>
<div class="container">
  <div class="row">
    <div class="col col-md-8 mx-auto">
      <h2 class="step-headline">Mypartybrezn</h2>
      <div class="stepwizard">
          <div class="stepwizard-row">
              <div class="stepwizard-step">
                <span class="step-circle">1</span>
                <p>Produktwahl</p>
              </div>
              <div class="stepwizard-step">
                <span class="step-circle">2</span>
                <p>Zusammenstellung</p>
              </div>
              <div class="stepwizard-step">
                <span class="step-circle active">3</span>
                <p>Bestellung</p>
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
            <span class="step-headline-number">3</span>Bestellung abschicken
          </h2>

          <?php get_template_part('partials/order-information', 'order-information'); ?>

        </div>
      </div>
    </div>

    <form name="checkout" method="post" class="checkout woocommerce-checkout pt-5" action="<?php echo esc_url(wc_get_checkout_url()); ?>" enctype="multipart/form-data">

    	<?php if ($checkout->get_checkout_fields()) : ?>

    		<?php do_action('woocommerce_checkout_before_customer_details'); ?>

    		<div class="row" id="customer_details">
    			<div class="col-12 col-lg-6">
    				<?php do_action('woocommerce_checkout_billing'); ?>
    			</div>

    			<div class="col-12 col-lg-6">
    				<?php do_action('woocommerce_checkout_shipping'); ?>
    			</div>
    		</div>

    		<?php do_action('woocommerce_checkout_after_customer_details'); ?>

    	<?php endif; ?>

    	<h3 id="order_review_heading"><?php esc_html_e('Your order', 'woocommerce'); ?></h3>

    	<?php do_action('woocommerce_checkout_before_order_review'); ?>

    	<div id="order_review" class="woocommerce-checkout-review-order">
    		<?php do_action('woocommerce_checkout_order_review'); ?>
    	</div>

    	<?php do_action('woocommerce_checkout_after_order_review'); ?>

      <div class="pt-5">
        <p>Bitte alle * Pflichtfelder ausfüllen. Bitte beachten Sie, dass die Abholung nur während der Maximarkt-Öffnungszeiten möglich ist!<p/>
        <b>Maximarkt wünscht Ihnen ein gelungenes Fest!</b>
      </div>

    </form>

  </div>
</div>

<?php do_action('woocommerce_after_checkout_form', $checkout); ?>
