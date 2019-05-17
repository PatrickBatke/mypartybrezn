<?php
if (!session_id()) {
    session_start();
}

/**
 * Theme functions file
 *
 * Contains all of the Theme's setup functions, custom functions,
 * custom hooks and Theme settings.
 *
 * @package niku-child
 * @license license.txt
 * @since   1.0
 *
 */
add_action('after_setup_theme', 'niku_load_childtheme_languages', 5);

function niku_load_childtheme_languages()
{
    /* this theme supports localization */
    load_child_theme_textdomain('tokoo', get_stylesheet_directory_uri() . '/languages');
}

/* Adds the child theme setup function to the 'after_setup_theme' hook. */
add_action('after_setup_theme', 'niku_child_theme_setup', 11);

/**
 * Setup function. All child themes should run their setup within this function. The idea is to add/remove
 * filters and actions after the parent theme has been set up. This function provides you that opportunity.
 *
 * @since 1.0
 */
function niku_child_theme_setup()
{
}

/**
* Enqueue typekit fonts into WordPress using wp_enqueue_scripts.
*
**/
add_action('wp_enqueue_scripts', 'prefix_enqueue_scripts');
/**
 * Loads the main typekit Javascript. Replace your-id-here with the script name
 * provided in your Kit Editor.
 *
 * @todo Replace prefix with your theme or plugin prefix
 */
function prefix_enqueue_scripts()
{
    wp_enqueue_script('jquery-ui', get_stylesheet_directory_uri() . '/assets/js/jquery-ui.min.js', array(), '1.0.0');
    wp_enqueue_style('jquery-ui', get_stylesheet_directory_uri() . '/assets/css/jquery-ui.min.css', array(), '1.0.0');
    wp_enqueue_script('jquery-ui-datepicker-de', get_stylesheet_directory_uri() . '/assets/js/jquery-ui-datepicker-de.js', array(), '1.0.0');
    wp_enqueue_script('jquery-timepicker-js', get_stylesheet_directory_uri() . '/assets/js/jquery.timepicker.min.js', array(), '1.0.0');
    wp_enqueue_style('jquery-timepicker', get_stylesheet_directory_uri() . '/assets/css/jquery.timepicker.min.css', false, '1.1', 'all');
}

add_action('wp_head', 'google_analytics_tracking_code');

function google_analytics_tracking_code()
{
  	$propertyID = 'UA-236529-18';
    ?>
  		<script type="text/javascript">
  		  var _gaq = _gaq || [];
  		  _gaq.push(['_setAccount', '<?php echo $propertyID; ?>']);
  		  _gaq.push(['_trackPageview']);

  		  (function() {
  		    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
  		    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
  		    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  		  })();
  		</script>
      <?php
}

add_action('woocommerce_before_single_product_summary', 'add_product_title', 15);

function add_product_title()
{
    global $product; ?>

    <div class="row row-divider">
    	<div class="col col-md-8 mx-auto">
        <div class="text-box">
    		  <h2 class="step-headline">
            <span class="step-headline-number">2</span><?php echo $product->get_title(); ?>
          </h2>

          <?php get_template_part('partials/order-information', 'order-information'); ?>

          </div>
    		</div>
    </div>

    <?php
    do_action('choose_location');
}

include_once('inc/ajax.php');
include_once('inc/mypartybrezn.php');

/* add New Pay Button Text */
add_filter('woocommerce_product_single_add_to_cart_text', 'themeprefix_cart_button_text');

function themeprefix_cart_button_text()
{
    return __('Jetzt bestellen', 'woocommerce');
}

/* remove add to cart message */
add_filter('wc_add_to_cart_message_html', 'empty_wc_add_to_cart_message');

function empty_wc_add_to_cart_message()
{
    return '';
};

/* remove checkout in cart  */
remove_action('woocommerce_proceed_to_checkout', 'woocommerce_button_proceed_to_checkout', 20);

/* remove links to products in cart */
add_filter('woocommerce_cart_item_permalink', '__return_false');

/* remove cart and redirect to checkout */
add_filter('woocommerce_add_to_cart_redirect', 'themeprefix_add_to_cart_redirect');

function themeprefix_add_to_cart_redirect()
{
    global $woocommerce;

    $checkout_url = wc_get_checkout_url();

    return $checkout_url;
}

/* remove view cart button in mini cart */
remove_action('woocommerce_widget_shopping_cart_buttons', 'woocommerce_widget_shopping_cart_button_view_cart', 10);

/* remove add to cart buttons on archive */
add_action('woocommerce_after_shop_loop_item', 'remove_add_to_cart_buttons', 1);

function remove_add_to_cart_buttons()
{
    if (is_product_category() || is_shop()) {
        remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart');
    }
}

/* empty cart after logout */
add_action('wp_login', 'account_empty_cart');
add_action('wp_logout', 'account_empty_cart');

function account_empty_cart()
{
    if (function_exists('WC')) {
        WC()->cart->empty_cart();
    }
}
