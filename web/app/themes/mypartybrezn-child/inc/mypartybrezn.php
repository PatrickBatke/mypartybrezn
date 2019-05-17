<?php
add_action('fetch_stores', 'fetch_stores');
add_filter('get_store', 'get_store');
add_action('get_store_capacity', 'get_store_capacity');

add_action('wp_ajax_select_store', 'select_store');
add_action('wp_ajax_nopriv_select_store', 'select_store');

add_action('wp_ajax_update_pickup_time', 'update_pickup_time');
add_action('wp_ajax_nopriv_update_pickup_time', 'update_pickup_time');

/**
 * Fetch the stores from the database
 */
function fetch_stores()
{
    global $stores;
    global $wpdb;

    $table_name = $wpdb->prefix . 'store_selection';
    $stores_result = $wpdb->get_results("SELECT * FROM $table_name");

    foreach ($stores_result as $store) {
        $stores[] = $store;
    }
}

/**
 * Return the name of the store to display it on the selection page
 */
function get_store()
{
    if (isset($_SESSION['store_name'])) {
        switch ($_SESSION['store_name']) {
            case 'Linz/Wegscheid':
                  $storeName = 'linz';
                  break;
            case 'Vöcklabruck':
                  $storeName = 'voecklabruck';
                  break;
            case 'Bruck a.d. Glocknerstraße':
                  $storeName = 'bruck';
                  break;
            default:
                  $storeName = $_SESSION['store_name'];
      }
    } else {
        $_SESSION['store_name'] = 'Linz/Wegscheid';
        setcookie('store_name', 'Linz/Wegscheid', time() + 86400, '/');

        $storeName = 'linz';
    }

    $storeName = strtolower($storeName);

    return 'https://mypartybrezn.blob.core.windows.net/mypartybrezn/2018/12/header_maximarkt_' . $storeName . '.jpg';
}

/**
 * Select the store in the frontend and empty the cart
 */
function select_store()
{
    global $wpdb;

    $_SESSION['store_name'] = $_POST['store_name'];
    setcookie('store_name', $_POST['store_name'], time() + 86400, '/');

    WC()->cart->empty_cart();

    echo json_encode($_SESSION['store_name']);

    die();
}

/**
 * Check if a store was located and redirect if no store has been selected before
 */
add_action('check_store_selection', 'check_store_selection');

function check_store_selection()
{
    if (!$_SESSION['store_name']) {
        $_SESSION['store_name'] = 'Linz/Wegscheid';
        setcookie('store_name', 'Linz/Wegscheid', time() + 86400, '/');

        global $post;

        $_SESSION['referrer'] = $post->post_name;

        wp_redirect(get_permalink(243));
    }
}

/**
 * Get the store capacity and display it later on the single product view
 */
function get_store_capacity()
{
    global $wpdb;

    $table_name = $wpdb->prefix . 'store_selection';

    $store = $_SESSION['store_name'];
    $stores_result = $wpdb->get_results("SELECT capacity, capacity_express, capacity_buffer, capacity_express_buffer FROM $table_name WHERE store = '$store'");

    $_SESSION['capacity'] = $stores_result[0]->capacity;
    $_SESSION['capacity_express'] = $stores_result[0]->capacity_express;
}

/**
 * Display the cart capacity from the previous function on the single product view
 */
add_action('woocommerce_after_single_product_summary', 'display_store_capacity', 10);

function display_store_capacity()
{
    $product = wc_get_product();
    $product_id = $product->get_id();

    if ($product_id == 117 && $_SESSION['store_name'] != 'Ried') {
        if ($_SESSION['capacity_express'] == 0) {
            echo '<p class="text-information"><b>Bitte beachten Sie:</b> Aufgrund des derzeitigen Bestellvolumens im ausgewählten Maximarkt ' . $_SESSION['store_name'] . ' kann sich das Abholdatum von 3 Stunden verschieben. <br /><br />Bitte wählen Sie den nächsten verfügbaren Termin im Bestellvorgang aus.</p>';
        }
    } elseif ($product_id != 117) {
        if ($_SESSION['capacity'] == 0) {
            echo '<p class="text-information"><b>Bitte beachten Sie:</b> Aufgrund des derzeitigen Bestellvolumens im ausgewählten Maximarkt ' . $_SESSION['store_name'] . ' kann sich das Abholdatum von 48 Stunden verschieben. <br /><br />Bitte wählen Sie den nächsten verfügbaren Termin im Bestellvorgang aus.</p>';
        }
    }
}

/**
 * Exclude products from a particular category based on the chosen location on the shop page
 */
if (isset($_SESSION['store_name']) && $_SESSION['store_name'] == 'Ried') {
    add_action('woocommerce_before_single_product', 'remove_addcart_location');
}

function remove_addcart_location()
{
    $product = wc_get_product();
    $product_id = $product->get_id();

    if ($product_id == 117) {
        remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart');
        remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30);
        remove_action('woocommerce_simple_add_to_cart', 'woocommerce_simple_add_to_cart', 30);
        remove_action('woocommerce_grouped_add_to_cart', 'woocommerce_grouped_add_to_cart', 30);
        remove_action('woocommerce_variable_add_to_cart', 'woocommerce_variable_add_to_cart', 30);
        remove_action('woocommerce_external_add_to_cart', 'woocommerce_external_add_to_cart', 30);

        add_filter('woocommerce_single_product_summary', 'add_text_after_excerpt_single_product', 20, 1);
        add_action('woocommerce_after_single_product_summary', 'add_text_after_excerpt_single_product', 25);
    }
}

function add_text_after_excerpt_single_product()
{
    echo '<p class="text-information"><b>Bitte beachten Sie: </b>Die Expressbrezn ist im ausgewähten Maximarkt Ried derzeit erst ab 3.Juni.2019 verfügbar.</p>';
}

/**
 * Hide configurable product from shop overview
 */
add_action('woocommerce_product_query', 'store_hide_configurator');

function store_hide_configurator($q)
{
    $tax_query = (array) $q->get('tax_query');

    $tax_query[] = array(
         'taxonomy' => 'product_cat',
         'field' => 'slug',
         'terms' => array('Configurator'),
         'operator' => 'NOT IN'
    );

    $q->set('tax_query', $tax_query);
}

/**
 * Disable the product pages completely on certain conditions (based on location and configurator product as well)
 */
add_action('woocommerce_before_single_product_summary', 'disable_single_product', 2);

function disable_single_product()
{
    $product_cats = wp_get_post_terms(get_the_ID(), 'product_cat');

    if ($product_cats && ! is_wp_error($product_cats)) {
        $single_cat = array_shift($product_cats);

        if ($single_cat->name == 'Configurator') {
            exit;
        }
    }
}

/**
 * Register custom hook for the inclusion of the choose location snippet
 */
add_action('choose_location', 'choose_location');

function choose_location()
{
    get_template_part('partials/choose-location', 'choose-location');
}

/* Allowing adding only one unique item to cart and displaying an error message  */
add_filter('woocommerce_add_to_cart_validation', 'add_to_cart_validation', 10, 3);

function add_to_cart_validation($passed, $product_id, $quantity)
{
    $in_cart = false;

    if (!WC()->cart->is_empty()) {
        foreach (WC()->cart->get_cart() as $cart_item) {
            $product_in_cart = $cart_item['product_id'];

            if ($product_in_cart === $product_id) {
                $in_cart = true;
            }
        }

        if ($in_cart) {
            $passed = true;

            return $passed;
        }

        wc_add_notice(__('Derzeit ist leider nur die Bestellung eines Produktes gleichzeitig möglich.', 'woocommerce'), 'error');

        $passed = false;
    }


    return $passed;
}

/**
 * Add custom information for products that are stored in cart item data as custom values
 */
add_filter('woocommerce_cart_item_name', 'cart_variation_description', 20, 3);

function cart_variation_description($name, $cart_item, $cart_item_key)
{
    if (isset($cart_item['custom_info'])) {
        $product_item = $cart_item['custom_info'];
    } else {
        $product_item = $name;
    }

    return $product_item;
}

/**
 * Override the default price with the calculated price of configurable products
 */
add_action('woocommerce_before_calculate_totals', 'woocommerce_custom_price_to_cart_item', 99);

function woocommerce_custom_price_to_cart_item($cart_item)
{
    if (!WC()->session->__isset('reload_checkout')) {
        foreach ($cart_item->cart_contents as $key => $value) {
            if (isset($value['custom_price'])) {
                $value['data']->set_price($value['custom_price']);
            }
        }
    }
}

add_action('woocommerce_after_order_notes', 'checkout_display_store', 10, 1);

function checkout_display_store()
{
    echo '
      <h3>Abholmarkt</h3>
      <p>' . $_SESSION['store_name'] . '</p>
    ';
}

add_action('calculate_capacity', 'calculate_capacity');

/**
 * Calculate the available capacity based on the location
 */
function calculate_capacity()
{
    global $wpdb;

    $table_name = $wpdb->prefix . 'store_selection';

    $store = $_SESSION['store_name'];
    $stores_result = $wpdb->get_results("SELECT * FROM $table_name WHERE store = '$store'");

    $_SESSION['opening_weekdays'] = $stores_result[0]->opening_weekdays;
    $_SESSION['closing_weekdays'] = $stores_result[0]->closing_weekdays;
    $_SESSION['opening_saturday'] = $stores_result[0]->opening_saturday;
    $_SESSION['closing_saturday'] = $stores_result[0]->closing_saturday;

    $_SESSION['capacity'] = $stores_result[0]->capacity;
    $_SESSION['capacity_express'] = $stores_result[0]->capacity_express;
    $_SESSION['capacity_buffer'] = $stores_result[0]->capacity_buffer;
    $_SESSION['capacity_express_buffer'] = $stores_result[0]->capacity_express_buffer;

    $product_id_express = 117;
    $express_in_cart = false;
    $item_quantity = 1;

    if (!WC()->cart->is_empty()) {
        foreach (WC()->cart->get_cart() as $cart_item) {
            $product_in_cart = $cart_item['product_id'];
            $item_quantity = $cart_item['quantity'];

            if ($product_in_cart === $product_id_express) {
                $express_in_cart = true;
            }
        }
    } else {
        wp_redirect(get_permalink(5));
    }

    /* Time calculation */
    date_default_timezone_set('Europe/Vienna');

    $order_date = date('Y-m-d', time());
    $order_time = date('H:i');

    /*
    ** Determine the name of the day and the opening/closing hours of the selected shop
    **            
    */

    $order_dayname = date('l', strtotime($order_date));

    switch ($order_dayname) {
        case 'Saturday':
            $_SESSION['min_time'] = $_SESSION['opening_saturday'];
            $_SESSION['max_time'] = date("H:i", strtotime($_SESSION['closing_saturday'] . "-30 minutes"));            
            break;
        default:
            $_SESSION['min_time'] = $_SESSION['opening_weekdays'];
            $_SESSION['max_time'] = date("H:i", strtotime($_SESSION['closing_weekdays'] . "-30 minutes"));
    }

    /*
    * If the mimimum pickup time for a store is below, set the value to 8 am.
    * This is required because different stores have different opening times.
    *            
    */
    if ($_SESSION['min_time'] < '08:00') {
        $_SESSION['min_time'] = '08:00';
    }
    
    /*$order_dayname = 'Thursday';
    $order_time = '19:32';
    echo 'Bestelltag: ' . $order_date . '<br>Bestellzeit: ' . $order_time;*/

    $free_days = [
      '01-01',
      '01-06',
      '04-22',
      '05-01',
      '05-30',
      '06-10',
      '06-20',
      '08-15',
      '10-26',
      '11-01',
      '12-08',
      '12-25',
      '12-26',
      '01-11',
      '01-12'
    ];

    $special_days = [
      ['12-08', '10:00', '18:00'],
      ['12-24', '07:00', '13:00'],
      ['12-31', '07:00', '14:00']
    ];

    /*
    ** Determine the timeframe when the order is done to check whether its during opening hours or not
    **            
    */
    $order_timeframe;

    if ($order_time >= '00:00' && $order_time < $_SESSION['min_time']) {
        $order_timeframe = 'before';
    } elseif ($order_time >= $_SESSION['min_time'] && $order_time < $_SESSION['max_time']) {
        $order_timeframe = 'during';
    } elseif ($order_time >= $_SESSION['max_time']) {
        $order_timeframe = 'after';
    }

    $pickup_date;
    $pickup_time;

    if (!$express_in_cart) {
        // base offset
        $pickup_offset = 2;

        if ($_SESSION['capacity'] > 0) {

            /*
            ** Calculate the offset for the pickup day based on the order day and order time
            **            
            */
            switch ($order_dayname) {
                case 'Friday':
                case 'Saturday':
                    switch ($order_timeframe) {
                        case 'before':
                            $pickup_offset += 1;
                            $pickup_time = $_SESSION['min_time'];
                            break;
                        case 'during':
                            $pickup_offset += 1;
                            $pickup_time = $order_time;
                            break;
                        case 'after':
                            $pickup_offset += 2;
                            $pickup_time = $_SESSION['min_time'];
                            break;
                    }

                    break;
                case 'Sunday':
                    $pickup_offset += 1;
                    $pickup_time = $_SESSION['min_time'];
                    break;
                default:
                    switch ($order_timeframe) {
                        case 'before':
                            $pickup_time = $_SESSION['min_time'];
                            break;
                        case 'during':
                            $pickup_time = $order_time;
                            break;
                        case 'after':
                            $pickup_offset += 1;
                            $pickup_time = $_SESSION['min_time'];
                            break;
                    }
                    
                    /*
                    ** Different closing times on saturday can lead to a smaller amount than the minimum required 48 hours.
                    ** The difference in opening hours has to be added to the pickup time of the next day.
                    */
                    if ($order_dayname == 'Thursday') {
                        if ($order_time > date("H:i", strtotime($_SESSION['closing_saturday'] . "-30 minutes"))) {
                            if ($order_timeframe == 'during') {
                                $pickup_offset += 1;
                            }                            
                            
                            $minute_difference = (strtotime($order_time) - strtotime($_SESSION['closing_saturday'] . "-30 minutes")) / 60;

                            if ($minute_difference > 90) $minute_difference = 90;

                            $pickup_time = date("H:i", strtotime($_SESSION['min_time'] . "+" . $minute_difference . " minutes"));
                        }
                    }
            }


            /* add new entry inside pickup table */
        } elseif ($_SESSION['capacity'] < 0) {
            /* add new entry inside pickup table */

            $pickup_offset += 1;
        }
    } else {
        if ($_SESSION['capacity_express'] > 0) {
            $pickup_offset = 0;

            /* add new entry inside pickup table */
        } elseif ($_SESSION['capacity_express'] < 0) {
            $pickup_offset += 1;

            /* add new entry inside pickup table */            
        }

        /*
        ** Expressbrezn: calculate the offset for the pickup day based on the order day and order time
        **            
        */
        if ($order_time < $_SESSION['min_time']) {
            $pickup_time = date("H:i", strtotime($_SESSION['min_time'] . "+3 hours"));
        } 
        if ($order_time >= $_SESSION['min_time']) {
            if ($order_time < date('H:i', strtotime('14:00'))) {
                $pickup_time = date('H:i', strtotime($order_time . "+3 hours"));
            } else {
                $pickup_offset += 1;
                $pickup_time = date("H:i", strtotime($_SESSION['min_time'] . "+3 hours"));
            }
        } 
    }
    
    
    /*
    ** Based on the offset, the pickup date is calculated and the pickup dayname is determined to provide the possible pickup time
    **            
    */
    $_SESSION['pickup_date'] = date('Y-m-d', time() + 86400 * $pickup_offset);

    $pickup_dayname = date('l', strtotime($_SESSION['pickup_date']));

    switch ($pickup_dayname) {
        case 'Saturday':
            $_SESSION['max_time'] = date("H:i", strtotime($_SESSION['closing_saturday'] . "-30 minutes"));
            break;
        default:
            $_SESSION['max_time'] = date("H:i", strtotime($_SESSION['closing_weekdays'] . "-30 minutes"));
    }

    $_SESSION['min_time'] = $pickup_time;


    /**
     * Holiday Exceptions and pickup date delay
     * 
     * 
     */

    /* if the pickup date is based on a holiday, then the next day will be chosen recursively */
    foreach ($free_days as $key => $value) {
        /* if a holiday is based within a time-frame of 3 days, then 1 day will be added to the pickup time */
        if (date('Y-m-d', time() + 1 * 86400) == date('2019-' . $free_days[$key]) || date('Y-m-d', time() + 2 * 86400) == date('2019-' . $free_days[$key])) {
            $_SESSION['pickup_date'] = date('Y-m-d', strtotime($_SESSION['pickup_date'] . "+1 day"));
        }
    }

    /* Override the closing time if the day is a day with special opening hours */
    foreach ($special_days as $key => $value) {
        if ($_SESSION['pickup_date'] == date('2019-' . $special_days[$key][0])) {
            $_SESSION['min_time'] = $special_days[$key][1];
            $_SESSION['max_time'] = $special_days[$key][2];
        }
    }

    add_action('woocommerce_after_order_notes', 'checkout_field_date', 10, 1);
    add_action('woocommerce_after_order_notes', 'checkout_field_time', 10, 1);
}

/**
 * Update pickup time on date change by user
 */
function update_pickup_time() {
    $free_days = [
      '01-01',
      '01-06',
      '04-22',
      '05-01',
      '05-30',
      '06-10',
      '06-20',
      '08-15',
      '10-26',
      '11-01',
      '12-08',
      '12-25',
      '12-26',
    ];

    $special_days = [
      ['12-08', '10:00', '18:00'],
      ['12-24', '07:00', '13:00'],
      ['12-31', '07:00', '14:00']
    ];

    $selected_date = date('Y-m-d', strtotime($_POST['selected_date']));

    $day_name = date('l', strtotime($_POST['selected_date']));

    switch ($day_name) {
        case 'Saturday':
            $min_time = $_SESSION['opening_saturday'];
            $max_time = date("H:i", strtotime($_SESSION['closing_saturday'] . "-30 minutes"));
            break;
        default:
            $min_time = $_SESSION['opening_weekdays'];
            $max_time = date("H:i", strtotime($_SESSION['closing_weekdays'] . "-30 minutes"));
    }

    /* reset pickup times if initial pickup day is chosen again */
    if ($selected_date == $_SESSION['pickup_date']) {
        $min_time = $_SESSION['min_time'];
        $max_time = $_SESSION['max_time'];
    }

    if ($min_time < '08:00') {
        $min_time = '08:00';
    }

    $pickup_times = [
        'min_time' => $min_time,
        'max_time' => $max_time
    ];

    echo json_encode($pickup_times);

    die();
}

/**
 * Call datepicker functionality in your custom text field
 */
function checkout_field_date($checkout)
{
    date_default_timezone_set('Europe/Berlin');
    $mydateoptions = array('' => __('Select PickupDate', 'woocommerce'));

    echo '<div id="checkout_field_date">
    <h3>'.__('Abholtermin').'</h3>';

    echo '
    <script>
        var date = new Date();
        var disabledDays = [
            "01-01",
            "01-06",
            "04-22",
            "05-01",
            "05-30",
            "06-10",
            "06-20",
            "08-15",
            "10-26",
            "11-01",
            "12-08",
            "12-25",
            "12-26"
        ];

        var pickup_date = "' . $_SESSION['pickup_date'] . '";
        var max_date = new Date("' . $_SESSION['pickup_date'] . '");

        max_date.setMonth(max_date.getMonth() + 2);
        var day = max_date.getDate();
        max_date.setDate(day);

        jQuery(function($){
            jQuery("#datepicker").datepicker({
              minDate: new Date(pickup_date),
              maxDate: max_date,
              changeMonth: true,
              dateFormat: "DD, dd.mm.yy",
              beforeShowDay: function(date) {
                  var string = jQuery.datepicker.formatDate("mm-dd", date);
                  var day = date.getDay();

                  var isDisabled = ($.inArray(string, disabledDays) != -1);
                  
                  return [day != 0 && !isDisabled];
              }
            }).attr("readonly", "readonly");
        });
    </script>';

    woocommerce_form_field('order_pickup_date', array(
        'type'          => 'text',
        'class'         => array('my-field-class form-row-wide'),
        'id'            => 'datepicker',
        'required'      => true,
        'label'         => __('Abholdatum'),
        'placeholder'       => __('Tag auswählen'),
        'options'     =>   $mydateoptions
        ), $checkout->get_value('order_pickup_date'));

    echo '</div>';
}
/**
 * Call timepicker functionality in your custom text field
 */
function checkout_field_time($checkout)
{
    date_default_timezone_set('Europe/Berlin');
    $mydateoptions = array('' => __('Select PickupDate', 'woocommerce'));

    echo '<div id="checkout_field_time">';

    echo '
    <script>
        var opening_time = "' . $_SESSION['min_time'] . '";
        var closing_time = "' . $_SESSION['max_time'] . '";
        var now = new Date();
        now.setMinutes(0);

        jQuery(function($){
            jQuery("#timepicker").timepicker({
              minTime: opening_time,
              maxTime: closing_time,
              defaultTime: opening_time,
              forceRoundTime: true,
              timeFormat: "H:i",
              scrollDefault: opening_time
            }).attr("onkeydown", "return false");
        });
    </script>';

    woocommerce_form_field('order_pickup_time', array(
        'type'          => 'text',
        'class'         => array('my-field-class form-row-wide'),
        'id'            => 'timepicker',
        'required'      => true,
        'label'         => __('Abholzeit'),
        'placeholder'       => __('Zeit auswählen'),
        'options'     =>   $mydateoptions
      ), $checkout->get_value('order_pickup_time'));

    echo '</div>';
}

/**
 * Checkout Process
 */

add_action('woocommerce_checkout_process', 'customise_checkout_field_process');

function customise_checkout_field_process()
{
    // if the field is set, if not then show an error message.
    if (!$_POST['order_pickup_date'] && !$_POST['order_pickup_time']) {
        wc_add_notice(__('Bitte wählen Sie Tag und Uhrzeit für die Abholung aus.'), 'error');
    } elseif (!$_POST['order_pickup_date']) {
        wc_add_notice(__('Bitte wählen Sie den Tag für die Abholung aus.'), 'error');
    } elseif (!$_POST['order_pickup_time']) {
        wc_add_notice(__('Bitte wählen Sie die Uhrzeit für die Abholung aus.'), 'error');
    }
}

/**
 * Change order comment text and Remove mandatory fields from the checkout process
 */
add_filter('woocommerce_checkout_fields', 'customize_checkout_fields');

function customize_checkout_fields($fields)
{
    $fields['billing']['billing_phone']['required'] = false;
    unset($fields['billing']['billing_address_1']);
    unset($fields['billing']['billing_postcode']);
    unset($fields['billing']['billing_city']);
    unset($fields['billing']['billing_country']);
    unset($fields['order']['order_comments']);

    return $fields;
}

add_action('woocommerce_review_order_before_submit', 'add_checkout_privacy_policy', 9);

function add_checkout_privacy_policy()
{
    woocommerce_form_field('privacy_policy', array(
      'type'          => 'checkbox',
      'class'         => array('form-row privacy'),
      'label_class'   => array('woocommerce-form__label woocommerce-form__label-for-checkbox checkbox'),
      'input_class'   => array('woocommerce-form__input woocommerce-form__input-checkbox input-checkbox'),
      'required'      => true,
      'label'         => 'Ich habe die <a href="/datenschutz/">Datenschutzerklärung</a> gelesen und akzeptiert.',
    ));
}

/**
 * Show notice if customer doesn't tick
 */
add_action('woocommerce_checkout_process', 'privacy_not_approved');

function privacy_not_approved()
{
    if (! (int) isset($_POST['privacy_policy'])) {
        wc_add_notice(__('Bitte Stimmen Sie der Datenschutzerklärung zu'), 'error');
    }
}

/**
 * Change place order button text
 */
add_filter('woocommerce_order_button_text', 'woo_custom_order_button_text');

function woo_custom_order_button_text()
{
    return __('Bestellung zahlungspflichtig abschicken', 'woocommerce');
}

add_action('woocommerce_checkout_create_order_line_item', 'order_add_custom_info', 10, 4);

/**
 * Update value of field
 */
add_action('woocommerce_checkout_update_order_meta', 'customise_checkout_field_update_order_meta');

function customise_checkout_field_update_order_meta($order_id)
{
    if (isset($_SESSION['store_name'])) {
      $store = $_SESSION['store_name'];
    }

    if (!isset($_SESSION['store_name'])) {
      if (isset($_COOKIE['store_name'])) {
        $store = $_COOKIE['store_name'];
      }
    }

    if (!isset($_SESSION['store_name']) && !isset($_COOKIE['store_name'])) {
      $store = 'Linz/Wegscheid';
    }

    if ($store == '') {
      $store = 'Linz/Wegscheid';
    }

    update_post_meta($order_id, 'Abholmarkt', sanitize_text_field($store));

    if (!empty($_POST['order_pickup_date'])) {
        update_post_meta($order_id, 'Abholdatum', sanitize_text_field($_POST['order_pickup_date']));
    }

    if (!empty($_POST['order_pickup_time'])) {
        update_post_meta($order_id, 'Abholzeit', sanitize_text_field($_POST['order_pickup_time']));
    }
}

/**
 * Add the custom information for configurable products to the order
 */
function order_add_custom_info($item, $cart_item_key, $values, $order)
{
    if (empty($values['custom-info'])) {
        #return;
    }
    $item->add_meta_data(__('Zutaten', 'ingredients'), $values['custom_info']);
}

/**
 * Fetch the store mail for the email notifications after checkout
 */
function fetch_store_mail_address()
{
    global $wpdb;

    $table_name = $wpdb->prefix . 'store_selection';

    if (isset($_SESSION['store_name'])) {
      $store = $_SESSION['store_name'];
    }

    if (!isset($_SESSION['store_name'])) {
      if (isset($_COOKIE['store_name'])) {
        $store = $_COOKIE['store_name'];
      }
    }

    if (!isset($_SESSION['store_name']) && !isset($_COOKIE['store_name'])) {
      $store = 'Linz/Wegscheid';
    }

    if ($store == '') {
      $store = 'Linz/Wegscheid';
    }

    $stores_result = $wpdb->get_results("SELECT email FROM $table_name WHERE store = '$store'");

    return $stores_result[0]->email;
}

/**
 * Override the default admin notification mail address for order notifications based on store location
 */
add_filter('woocommerce_email_recipient_new_order', 'store_location_email_recipient', 10, 2);
add_filter('woocommerce_email_recipient_cancelled_order', 'store_location_email_recipient', 10, 2);
add_filter('woocommerce_email_recipient_failed_order', 'store_location_email_recipient', 10, 2);

function store_location_email_recipient($recipient, $order)
{
    // Bail on WC settings pages since the order object isn't yet set yet
    $page = $_GET['page'] = isset($_GET['page']) ? $_GET['page'] : '';

    if ('wc-settings' === $page) {
        return $recipient;
    }

    if (!$order instanceof WC_Order) {
        return $recipient;
    }

    // fetch store email address
    $recipient = fetch_store_mail_address();
    $recipient .= ', gerald.bamberger@maximarkt.at, franjo.antunovic@neuherz.at';

    return $recipient;
}

/**
 * Set a new subject for the admin mails and add additional information based on products
 */
add_filter('woocommerce_email_subject_new_order', 'change_admin_email_subject', 1, 2);

function change_admin_email_subject($subject, $order)
{
    global $woocommerce;

    $items = $order->get_items();

    foreach ($items as $item) {
        $product_id = $item->get_product_id();
    }

    if ($product_id == 117) {
        $subject = 'Mypartybrezn Expressbrezn: Neue Bestellung ' . $order->get_order_number();
    } else {
        $subject = 'Mypartybrezn: Neue Bestellung ' . $order->get_order_number();
    }

    return $subject;
}

/**
 * Add custom fields (in an order) to the emails
 */
add_action('woocommerce_email_after_order_table', 'woocommerce_email_after_order_table_func');

function woocommerce_email_after_order_table_func($order)
{
    ?>

<h2>Abholdaten</h2>
<div style="margin-bottom: 40px;">
    <table class="td" cellspacing="0" cellpadding="6"
        style="width: 100%; font-family: 'Barlow Condensed', 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif;">
        <tbody>
            <tr>
                <td style="border: 1px solid #e1e1e1;">Abholmarkt: </td>
                <td style="border: 1px solid #e1e1e1;">
                    <?php echo wptexturize(get_post_meta($order->get_id(), 'Abholmarkt', true)); ?></td>
            </tr>
            <tr>
                <td style="border: 1px solid #e1e1e1;">Abholdatum: </td>
                <td style="border: 1px solid #e1e1e1;">
                    <?php echo wptexturize(get_post_meta($order->get_id(), 'Abholdatum', true)); ?></td>
            </tr>
            <tr>
                <td style="border: 1px solid #e1e1e1;">Abholzeit: </td>
                <td style="border: 1px solid #e1e1e1;">
                    <?php echo wptexturize(get_post_meta($order->get_id(), 'Abholzeit', true)); ?></td>
            </tr>
        </tbody>
    </table>
</div>

<?php
}

/**
 * Send an alert email if no store was provided by the user
 */
add_action('woocommerce_thankyou', 'emergency_alert_for_missing_store', 1, 1);

function emergency_alert_for_missing_store($order_id) {
    $order = wc_get_order($order_id);

    if (get_post_meta($order->get_id(), 'Abholmarkt', true) == '') {
        $contact_data = $order->get_billing_first_name() . ' ' . $order->get_billing_last_name() . '<br>' . $order->get_billing_email() . '<br>' . $order->get_billing_phone();
        $headers = array('Content-Type: text/html; charset=UTF-8');

        $body = 'Bei der Bestellung ' . $order->get_order_number() . ' wurde kein Abholmarkt angegeben. Wir bitten um Kontaktierung des Kunden mit folgenden Kontaktdaten:<br><br>' . $contact_data;

        wp_mail('kundenservice@maximarkt.at', 'MYPARTYBREZN - WARNUNG - Fehlender Abholmarkt', $body, $headers);
    }
}

/**
 * Update the store capacity after a successful order
 */
#add_action('woocommerce_checkout_order_processed', 'update_store_capacity', 1, 1);
add_action('woocommerce_new_order', 'update_store_capacity', 1, 1);

function update_store_capacity()
{
    global $wpdb;

    $table_name = $wpdb->prefix . 'store_selection';

    $wpdb->update(
    $table_name,
    array(
      'capacity' => $_SESSION['capacity'],
      'capacity_buffer' => $_SESSION['capacity_buffer'],
      'capacity_express' => $_SESSION['capacity_express'],
      'capacity_express_buffer' => $_SESSION['capacity_express_buffer'],
    ),
    array('store' => $_SESSION['store_name']),
    array('%d', '%d', '%d', '%d')
  );
}