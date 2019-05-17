<?php
/**
 * Fired during plugin activation
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Brezn_Configurator
 * @subpackage Brezn_Configurator/includes
 */
/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Brezn_Configurator
 * @subpackage Brezn_Configurator/includes
 * @author     Your Name <email@example.com>
 */
class Brezn_Configurator_Activator
{
    /**
     * Short Description. (use period)
     *
     * Long Description.
     *
     * @since    1.0.0
     */

    public static $ingredients = [
      ['Brezn Semmelteig', 13.00, 19.00, 'Riesenbrezn'],
      ['Brezn 3-Korn-Teig', 13.00, 19.00, 'Riesenbrezn'],
      ['Brezn Roggenteig', 13.00, 19.00, 'Riesenbrezn'],

      ['ohne Aufstrich', 0.00, 0.00, 'Aufstrich'],
      ['Hummus pikant', 3.00, 5.00, 'Aufstrich'],
      ['Frischkäse natur', 3.00, 5.00, 'Aufstrich'],
      ['Mayonnaise 50% Fett', 3.00, 5.00, 'Aufstrich'],

      ['Krakauer', 1.49, 1.49, 'Wurst'],
      ['Pikant', 1.09, 1.09, 'Wurst'],
      ['Käswurst', 1.99, 1.99, 'Wurst'],
      ['Wiener', 1.29, 1.29, 'Wurst'],
      ['Beskada', 2.29, 2.29, 'Wurst'],
      ['Polnische', 2.19, 2.19, 'Wurst'],

      ['Haussalami', 2.19, 2.19, 'Rohwurst'],
      ['Kantwurst', 1.79, 1.79, 'Rohwurst'],
      ['Schinkenrohwurst', 2.90, 2.90, 'Rohwurst'],
      ['Parmesansalami', 2.69, 2.69, 'Rohwurst'],
      ['Pfeffersalami', 2.69, 2.69, 'Rohwurst'],

      ['Putenschinken', 1.59, 1.59, 'Schinken'],
      ['Beinschinken', 1.79, 1.79, 'Schinken'],
      ['Farmerschinken', 1.99, 1.99, 'Schinken'],
      ['Backofenschinken', 1.99, 1.99, 'Schinken'],
      ['Wellnessschinken', 1.99, 1.99, 'Schinken'],
      ['Linzer Beinschinken', 1.79, 1.79, 'Schinken'],
      ['Saunaschinken', 1.79, 1.79, 'Schinken'],

      ['Praterstelze', 1.99, 1.99, 'Gebratenes'],
      ['Bauchfleisch', 1.39, 1.39, 'Gebratenes'],
      ['Karree', 1.59, 1.59, 'Gebratenes'],
      ['Schulter', 1.49, 1.49, 'Gebratenes'],

      ['Bergbaron', 1.55, 1.55, 'Käse'],
      ['Gouda', 1.45, 1.45, 'Käse'],
      ['Emmentaler', 1.59, 1.59, 'Käse'],
      ['Gmundner Berg', 1.55, 1.55, 'Käse'],
      ['Rollino', 1.55, 1.55, 'Käse'],
      ['Brie', 1.55, 1.55, 'Käse'],
      ['Österkron', 1.55, 1.55, 'Käse'],

      ['Gurke', 1.50, 2.50, 'Garnierung'],
      ['Paprika', 2.00, 3.00, 'Garnierung'],
      ['Ei', 3.00, 4.50, 'Garnierung'],
      ['Sandwichgurken', 1.50, 2.50, 'Garnierung'],
      ['Pfefferoni mild', 1.50, 2.50, 'Garnierung'],
      ['Pfefferoni scharf', 1.50, 2.50, 'Garnierung']
    ];

    public static $stores = [
      ['Linz/Wegscheid', 'Bäckermühlweg 61', 4030, 'Linz', 'info.linz@maximarkt.at', '0732/37 57 77-0', '7:30', '19:30', '7:30', '18:00', 30, 10, 0, 0],
      ['Vöcklabruck', 'Robert-Kunz-Straße 4', 4840, 'Vöcklabruck', 'info.vbrk@maximarkt.at', '07672/24 4 81-0', '7:30', '19:30', '7:30', '18:00', 30, 10, 0, 0],
      ['Haid', 'Ikea-Platz 2', 4053, 'Haid', 'kiosk.haid@maximarkt.at', '07229/79 5 30-0', '8:00', '19:30', '8:00', '18:00', 30, 10, 0, 0],
      ['Anif', 'Waldbadstraße 2 ', 5081, 'Anif', 'info.anif@maximarkt.at', '06246/89 55-0', '7:30', '19:30', '7:30', '18:00', 30, 10, 0, 0],
      ['Wels', 'Gunskirchener Straße 7', 4600, 'Wels', 'info.wels@maximarkt.at', '07242/46 9 31-0', '8:00', '19:30', '8:00', '18:00', 30, 10, 0, 0],
      ['Bruck a.d. Glocknerstraße', 'Kaprunerstraße 50', 5671, 'Bruck a.d. Glocknerstraße', 'info.bruck@maximarkt.at', '06545/222 91-0', '7:30', '19:30', '7:30', '18:00', 30, 10, 0, 0],
      ['Ried', 'Riedauer Straße 37', 4910, 'Ried', 'kiosk.ried@maximarkt.at', '07752/84 4 76-0', '7:30', '19:30', '7:30', '18:00', 30, 0, 0, 0]
    ];

    public static function activate()
    {
        self::create_ingredients_table();
        self::create_stores_table();
        self::create_pickup_dates_table();
    }

    /*
     * Create the table for the ingredients used in the configurator
     */
    public static function create_ingredients_table()
    {
        global $wpdb;

        $table_name = $wpdb->prefix . 'brezn_ingredients';

        $version = get_option('brezn_configurator_version', '1.0');
        $charset_collate = $wpdb->get_charset_collate();

        $sql = "CREATE TABLE $table_name (
              id mediumint(9) NOT NULL AUTO_INCREMENT,
              name varchar(255) NOT NULL,
              price float(10,2) NOT NULL,
              price_secondary float(10,2) NOT NULL,
              ingredient_group varchar(255) NOT NULL,
              PRIMARY KEY  (id)
            ) $charset_collate;";

        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);

        /*
         * Populate the table with ingredients
         */

        $count_query = "SELECT COUNT(*) FROM $table_name";
        $num = $wpdb->get_var($count_query);

        if ($num == 0) {
            foreach (self::$ingredients as $ingredient) {
                $name = $ingredient[0];
                $price = $ingredient[1];
                $price_secondary = $ingredient[2];
                $ingredient_group = $ingredient[3];

                $wpdb->insert($table_name, array(
              'name' => $name,
              'price' => $price,
              'price_secondary' => $price_secondary,
              'ingredient_group' => $ingredient_group
            ));
            }
        }
    }

    /*
     * Create the table for the different store locations
     */
    public static function create_stores_table()
    {
        global $wpdb;

        $table_name = $wpdb->prefix . 'store_selection';

        $version = get_option('brezn_configurator_version', '1.0');
        $charset_collate = $wpdb->get_charset_collate();

        $sql = "CREATE TABLE $table_name (
              id mediumint(9) NOT NULL AUTO_INCREMENT,
              store varchar(255) NOT NULL,
              street varchar(255) NOT NULL,
              zip mediumint(9) NOT NULL,
              place varchar(255) NOT NULL,
              email varchar(255) NOT NULL,
              tel varchar(255) NOT NULL,
              opening_weekdays varchar(255) NOT NULL,
              closing_weekdays varchar(255) NOT NULL,
              opening_saturday varchar(255) NOT NULL,
              closing_saturday varchar(255) NOT NULL,
              capacity int(11) NOT NULL,
              capacity_express int(11) NOT NULL,
              capacity_buffer int(11) NOT NULL,
              capacity_express_buffer int(11) NOT NULL,
              PRIMARY KEY  (id)
            ) $charset_collate;";

        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);

        $count_query = "SELECT COUNT(*) FROM $table_name";
        $num = $wpdb->get_var($count_query);

        /*
         * Populate the table with store information
         */

        if ($num == 0) {
            foreach (self::$stores as $store) {
                $wpdb->insert($table_name, array(
              'store' => $store[0],
              'street' => $store[1],
              'zip' => $store[2],
              'place' => $store[3],
              'email' => $store[4],
              'tel' => $store[5],
              'opening_weekdays' => $store[6],
              'closing_weekdays' => $store[7],
              'opening_saturday' => $store[8],
              'closing_saturday' => $store[9],
              'capacity' => $store[10],
              'capacity_express' => $store[11],
              'capacity_buffer' => $store[12]
            ));
            }
        }
    }

    /*
     * Create the table for the pickup dates and the actual capacity usage
     */
    public static function create_pickup_dates_table()
    {
        global $wpdb;

        $table_name = $wpdb->prefix . 'pickup_dates';

        $version = get_option('brezn_configurator_version', '1.0');
        $charset_collate = $wpdb->get_charset_collate();

        $sql = "CREATE TABLE $table_name (
          id mediumint(9) NOT NULL AUTO_INCREMENT,
          store_id mediumint(9) NOT NULL,
          pickup_date date NOT NULL,
          capacity mediumint(9) NOT NULL,
          capacity_express mediumint(9) NOT NULL,
          PRIMARY KEY  (id),
          FOREIGN KEY (store_id) REFERENCES " . $wpdb->prefix . "store_selection (id)
        ) $charset_collate;";

        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
    }
}
