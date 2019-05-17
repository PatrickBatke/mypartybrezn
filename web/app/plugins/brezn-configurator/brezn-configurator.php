<?php
/**
 * Plugin Name: Brezn Configurator
 * Description: A custom brezn product configurator for woocommerce
 * Version: 1.0.0
 * Author: Neuherz & Partner
 * Author URI: https://neuherz.at
 *
 */
 // If this file is called directly, abort.
 if (! defined('WPINC')) {
     die;
 }
 /**
  * The code that runs during plugin activation.
  * This action is documented in includes/class-brezn-configurator-activator.php
  */
 function activate_brezn_configurator()
 {
     require_once plugin_dir_path(__FILE__) . 'includes/class-brezn-configurator-activator.php';
     Brezn_Configurator_Activator::activate();
 }

 /**
  * The code that runs during plugin deactivation.
  * This action is documented in includes/class-brezn-configurator-deactivator.php
  */
 function deactivate_brezn_configurator()
 {
     require_once plugin_dir_path(__FILE__) . 'includes/class-brezn-configurator-deactivator.php';
     Brezn_Configurator_Deactivator::deactivate();
 }

 register_activation_hook(__FILE__, 'activate_brezn_configurator');
 register_deactivation_hook(__FILE__, 'deactivate_brezn_configurator');

 /**
  * The core plugin class that is used to define internationalization,
  * admin-specific hooks, and public-facing site hooks.
  */
 require plugin_dir_path(__FILE__) . 'includes/class-brezn-configurator.php';
 /**
  * Begins execution of the plugin.
  *
  * Since everything within the plugin is registered via hooks,
  * then kicking off the plugin from this point in the file does
  * not affect the page life cycle.
  *
  * @since    1.0.0
  */
 function run_brezn_configurator()
 {
     $plugin = new Brezn_Configurator();
     $plugin->run();
 }

 run_brezn_configurator();

 function brezn_configurator_options()
 {
     if (!current_user_can('manage_options')) {
         wp_die(__('No permission to view this page.'));
     }
 }

add_action('initialize_configurator', array('Brezn_Configurator', 'load_templates'));

add_action('wp_ajax_save_basic', array('Brezn_Configurator', 'save_basic'));
add_action('wp_ajax_nopriv_save_basic', array('Brezn_Configurator', 'save_basic'));

add_action('wp_ajax_get_basic', array('Brezn_Configurator', 'get_basic'));
add_action('wp_ajax_nopriv_get_basic', array('Brezn_Configurator', 'get_basic'));

add_action('get_initial_price', array('Brezn_Configurator', 'get_initial_price'));
add_action('wp_ajax_update_initial_price', array('Brezn_Configurator', 'update_initial_price'));
add_action('wp_ajax_nopriv_update_initial_price', array('Brezn_Configurator', 'update_initial_price'));

add_filter('get_ingredients', array('Brezn_Configurator', 'get_ingredients'));

add_action('wp_ajax_calculate_price', array('Brezn_Configurator', 'calculate_price'));
add_action('wp_ajax_nopriv_calculate_price', array('Brezn_Configurator', 'calculate_price'));

add_action('wp_ajax_configurator_add_cart', array('Brezn_Configurator', 'configurator_add_cart'));
add_action('wp_ajax_nopriv_configurator_add_cart', array('Brezn_Configurator', 'configurator_add_cart'));


add_action('admin_post_update_locations', 'update_locations');
add_action('admin_post_update_ingredients', 'update_ingredients');


add_action('admin_menu', 'store_selection_menu');

function store_selection_menu()
{
    add_menu_page('Store Selection Options', 'Mypartybrezn', 'manage_options', 'mypartybrezn-options', 'mypartybrezn_options');
    add_submenu_page('mypartybrezn-options', 'Marktverwaltung', 'Marktverwaltung', 'manage_options', 'manage-locations', 'manage_locations');
    add_submenu_page('mypartybrezn-options', 'Zutatenliste', 'Zutatenliste', 'manage_options', 'manage-ingredients', 'manage_ingredients');
    remove_submenu_page('mypartybrezn-options', 'mypartybrezn-options');
}

function manage_locations()
{
    if (!current_user_can('manage_options')) {
        wp_die(__('No permission to view this page.'));
    }

    do_action('fetch_stores');

    global $wpdb;
    global $stores;
    ?>

    <form action="<?php echo esc_url( admin_url('admin-post.php') ); ?>" method="post">
      <div class="page-title">
        <div class="label">
          <h1 class="wp-heading-inline">Marktverwaltung</h1>
        </div>
      </div>

      <div class="backend-stores">
        <table>
          <th>Markt</th>
          <th>Straße</th>
          <th>PLZ</th>
          <th>Ort</th>
          <th>E-Mail</th>
          <th>Telefon</th>
          <th>Öffnungszeit Wochentage</th>
          <th>Schlusszeit Wochentage</th>
          <th>Öffnungszeit Samstag</th>
          <th>Schlusszeit Samstag</th>
          <th>Kapazität</th>
          <th>Kapazität Expressbrezn</th>
          <?php
          foreach ($stores as $store)  {
          ?>
          <tr>
            <td><label for="data-update-id"><?php echo $store->store ?></label></td>
            <td><input type="text" name="street-<?php echo $store->id ?>" value="<?php echo $store->street ?>" /></td>
            <td><input type="text" name="zip-<?php echo $store->id ?>" value="<?php echo $store->zip ?>" /></td>
            <td><input type="text" name="place-<?php echo $store->id ?>" value="<?php echo $store->place ?>" /></td>
            <td><input type="text" name="email-<?php echo $store->id ?>" value="<?php echo $store->email ?>" /></td>
            <td><input type="text" name="tel-<?php echo $store->id ?>" value="<?php echo $store->tel ?>" /></td>
            <td><input type="text" name="opening-weekdays-<?php echo $store->id ?>" value="<?php echo $store->opening_weekdays ?>" /></td>
            <td><input type="text" name="closing-weekdays-<?php echo $store->id ?>" value="<?php echo $store->closing_weekdays ?>" /></td>
            <td><input type="text" name="opening-saturday-<?php echo $store->id ?>" value="<?php echo $store->opening_saturday ?>" /></td>
            <td><input type="text" name="closing-saturday-<?php echo $store->id ?>" value="<?php echo $store->closing_saturday ?>" /></td>
            <td><input type="text" name="capacity-<?php echo $store->id ?>" value="<?php echo $store->capacity ?>" /></td>
            <td><input type="text" name="capacity-express-<?php echo $store->id ?>" value="<?php echo $store->capacity_express ?>" /></td>
            <td><input type="hidden" name="item-id-<?php echo $store->id ?>" value="<?php echo $store->id ?>"></td>
          </tr>
          <?php
          }
        ?>
      </table>
      </div>

      <input type="hidden" name="action" value="update_locations">

      <div class="asl-button asl-button-brezn">
        <input type="submit" name="submit" value="Aktualisieren">
      </div>
    </form>

    <?php
}

function manage_ingredients()
{
    if (!current_user_can('manage_options')) {
        wp_die(__('No permission to view this page.'));
    }

    global $wpdb;

    $ingredients = apply_filters('get_ingredients', 10, 3);

    ?>

    <form action="<?php echo esc_url( admin_url('admin-post.php') ); ?>" method="post">
      <div class="page-title">
        <div class="label">
          <h1 class="wp-heading-inline">Zutatenliste</h1>
        </div>
      </div>

      <div class="backend-ingredient-group">
        <h2 class="backend-ingredient-heading">Aufstrich</h2>
        <table>
          <th>Zutat</th>
          <th>Preis</th>
          <th>Preis XL</th>
          <?php
          foreach ($ingredients['Aufstrich'] as $aufstrich => $value) {
          ?>
          <tr>
            <td width="150"><label for="data-update-id"><?php echo $value->name ?></label></td>
            <td><input type="text" name="price-<?php echo $value->id ?>" value="<?php echo $value->price ?>" /></td>
            <td><input type="text" name="price-secondary-<?php echo $value->id ?>" value="<?php echo $value->price_secondary ?>" /></td>
            <td><input type="hidden" name="item-id" value="<?php echo $value->id ?>"></td>
          </tr>
          <?php
          }
        ?>
      </table>
      </div>

      <div class="backend-ingredient-group">
        <h2 class="backend-ingredient-heading">Wurst</h2>
        <table>
          <th>Zutat</th>
          <th>Preis</th>
          <th>Preis XL</th>
          <?php
          foreach ($ingredients['Wurst'] as $wurst => $value) {
          ?>
          <tr>
            <td width="150"><label for="data-update-id"><?php echo $value->name ?></label></td>
            <td><input type="text" name="price-<?php echo $value->id ?>" value="<?php echo $value->price ?>" /></td>
            <td><input type="text" name="price-secondary-<?php echo $value->id ?>" value="<?php echo $value->price_secondary ?>" /></td>
            <td><input type="hidden" name="item-id-<?php echo $value->id ?>" value="<?php echo $value->id ?>"></td>
          </tr>
          <?php
          }
        ?>
      </table>
      </div>

      <div class="backend-ingredient-group">
        <h2 class="backend-ingredient-heading">Rohwurst</h2>
        <table>
          <th>Zutat</th>
          <th>Preis</th>
          <th>Preis XL</th>
          <?php
          foreach ($ingredients['Rohwurst'] as $aufstrich => $value) {
          ?>
          <tr>
            <td width="150"><label for="data-update-id"><?php echo $value->name ?></label></td>
            <td><input type="text" name="price-<?php echo $value->id ?>" value="<?php echo $value->price ?>" /></td>
            <td><input type="text" name="price-secondary-<?php echo $value->id ?>" value="<?php echo $value->price_secondary ?>" /></td>
            <td><input type="hidden" name="item-id-<?php echo $value->id ?>" value="<?php echo $value->id ?>"></td>
          </tr>
          <?php
          }
        ?>
      </table>
      </div>

      <div class="backend-ingredient-group">
        <h2 class="backend-ingredient-heading">Schinken</h2>
        <table>
          <th>Zutat</th>
          <th>Preis</th>
          <th>Preis XL</th>
          <?php
          foreach ($ingredients['Schinken'] as $aufstrich => $value) {
          ?>
          <tr>
            <td width="150"><label for="data-update-id"><?php echo $value->name ?></label></td>
            <td><input type="text" name="price-<?php echo $value->id ?>" value="<?php echo $value->price ?>" /></td>
            <td><input type="text" name="price-secondary-<?php echo $value->id ?>" value="<?php echo $value->price_secondary ?>" /></td>
            <td><input type="hidden" name="item-id-<?php echo $value->id ?>" value="<?php echo $value->id ?>"></td>
          </tr>
          <?php
          }
        ?>
      </table>
      </div>

      <div class="backend-ingredient-group">
        <h2 class="backend-ingredient-heading">Gebratenes</h2>
        <table>
          <th>Zutat</th>
          <th>Preis</th>
          <th>Preis XL</th>
          <?php
          foreach ($ingredients['Gebratenes'] as $aufstrich => $value) {
          ?>
          <tr>
            <td width="150"><label for="data-update-id"><?php echo $value->name ?></label></td>
            <td><input type="text" name="price-<?php echo $value->id ?>" value="<?php echo $value->price ?>" /></td>
            <td><input type="text" name="price-secondary-<?php echo $value->id ?>" value="<?php echo $value->price_secondary ?>" /></td>
            <td><input type="hidden" name="item-id-<?php echo $value->id ?>" value="<?php echo $value->id ?>"></td>
          </tr>
          <?php
          }
        ?>
      </table>
      </div>

      <div class="backend-ingredient-group">
        <h2 class="backend-ingredient-heading">Käse</h2>
        <table>
          <th>Zutat</th>
          <th>Preis</th>
          <th>Preis XL</th>
          <?php
          foreach ($ingredients['Käse'] as $aufstrich => $value) {
          ?>
          <tr>
            <td width="150"><label for="data-update-id"><?php echo $value->name ?></label></td>
            <td><input type="text" name="price-<?php echo $value->id ?>" value="<?php echo $value->price ?>" /></td>
            <td><input type="text" name="price-secondary-<?php echo $value->id ?>" value="<?php echo $value->price_secondary ?>" /></td>
            <td><input type="hidden" name="item-id-<?php echo $value->id ?>" value="<?php echo $value->id ?>"></td>
          </tr>
          <?php
          }
        ?>
      </table>
      </div>

      <div class="backend-ingredient-group">
        <h2 class="backend-ingredient-heading">Garnierung</h2>
        <table>
          <th>Zutat</th>
          <th>Preis</th>
          <th>Preis XL</th>
          <?php
          foreach ($ingredients['Garnierung'] as $aufstrich => $value) {
          ?>
          <tr>
            <td width="150"><label for="data-update-id"><?php echo $value->name ?></label></td>
            <td><input type="text" name="price-<?php echo $value->id ?>" value="<?php echo $value->price ?>" /></td>
            <td><input type="text" name="price-secondary-<?php echo $value->id ?>" value="<?php echo $value->price_secondary ?>" /></td>
            <td><input type="hidden" name="item-id-<?php echo $value->id ?>" value="<?php echo $value->id ?>"></td>
          </tr>
          <?php
          }
        ?>
      </table>
      </div>

      <input type="hidden" name="action" value="update_ingredients">

      <div class="asl-button asl-button-brezn">
        <input type="submit" name="submit" value="Aktualisieren">
      </div>
    </form>

    <?php
}

function update_locations() {
    global $wpdb;

    $table_name = $wpdb->prefix . 'store_selection';

    for ($i = 1; $i <= 7; $i++) {
        $wpdb->update(
            $table_name,
            array(
                'street' => $_POST['street-' . $i],
                'zip' => $_POST['zip-' . $i],
                'place' => $_POST['place-' . $i],
                'email' => $_POST['email-' . $i],
                'tel' => $_POST['tel-' . $i],
                'opening_weekdays' => $_POST['opening-weekdays-' . $i],
                'closing_weekdays' => $_POST['closing-weekdays-' . $i],
                'opening_saturday' => $_POST['opening-saturday-' . $i],
                'closing_saturday' => $_POST['closing-saturday-' . $i],
                'capacity' => $_POST['capacity-' . $i],
                'capacity_express' => $_POST['capacity-express-' . $i],
            ),
            array('id' => $i),
            array('%s', '%d', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%d', '%d'));
    }

    wp_redirect($_SERVER['HTTP_REFERER']);
}

function update_ingredients() {
    global $wpdb;

    wp_redirect($_SERVER['HTTP_REFERER']);
}
