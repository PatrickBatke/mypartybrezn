<?php
/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Brezn_Configurator
 * @subpackage Brezn_Configurator/includes
 */
/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Brezn_Configurator
 * @subpackage Brezn_Configurator/includes
 * @author     Your Name <email@example.com>
 */
class Brezn_Configurator
{
    /**
     * The loader that's responsible for maintaining and registering all hooks that power
     * the plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      Brezn_Configurator_Loader    $loader    Maintains and registers all hooks for the plugin.
     */
    protected $loader;
    /**
     * The unique identifier of this plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      string    $brezn_Configurator   The string used to uniquely identify this plugin.
     */
    protected $brezn_configurator;
    /**
     * The current version of the plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      string    $version    The current version of the plugin.
     */
    protected $version;
    /**
     * Define the core functionality of the plugin.
     *
     * Set the plugin name and the plugin version that can be used throughout the plugin.
     * Load the dependencies, define the locale, and set the hooks for the admin area and
     * the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function __construct()
    {
        if (defined('Brezn_Configurator_VERSION')) {
            $this->version = Brezn_Configurator_VERSION;
        } else {
            $this->version = '1.0.0';
        }
        $this->Brezn_Configurator = 'plugin-name';
        $this->load_dependencies();
        $this->set_locale();
        $this->define_admin_hooks();
        $this->define_public_hooks();
    }
    /**
     * Load the required dependencies for this plugin.
     *
     * Include the following files that make up the plugin:
     *
     * - Brezn_Configurator_Loader. Orchestrates the hooks of the plugin.
     * - Brezn_Configurator_i18n. Defines internationalization functionality.
     * - Brezn_Configurator_Admin. Defines all hooks for the admin area.
     * - Brezn_Configurator_Public. Defines all hooks for the public side of the site.
     *
     * Create an instance of the loader which will be used to register the hooks
     * with WordPress.
     *
     * @since    1.0.0
     * @access   private
     */
    private function load_dependencies()
    {
        /**
         * The class responsible for orchestrating the actions and filters of the
         * core plugin.
         */
        require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-brezn-configurator-loader.php';
        /**
         * The class responsible for defining internationalization functionality
         * of the plugin.
         */
        require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-brezn-configurator-i18n.php';
        /**
         * The class responsible for defining all actions that occur in the admin area.
         */
        require_once plugin_dir_path(dirname(__FILE__)) . 'admin/class-brezn-configurator-admin.php';
        /**
         * The class responsible for defining all actions that occur in the public-facing
         * side of the site.
         */
        require_once plugin_dir_path(dirname(__FILE__)) . 'public/class-brezn-configurator-public.php';

        $this->loader = new Brezn_Configurator_Loader();
    }

    /**
     * Define the locale for this plugin for internationalization.
     *
     * Uses the Brezn_Configurator_i18n class in order to set the domain and to register the hook
     * with WordPress.
     *
     * @since    1.0.0
     * @access   private
     */
    private function set_locale()
    {
        $plugin_i18n = new Brezn_Configurator_i18n();
        $this->loader->add_action('plugins_loaded', $plugin_i18n, 'load_plugin_textdomain');
    }

    /**
     * Register all of the hooks related to the admin area functionality
     * of the plugin.
     *
     * @since    1.0.0
     * @access   private
     */
    private function define_admin_hooks()
    {
        $plugin_admin = new Brezn_Configurator_Admin($this->get_Brezn_Configurator(), $this->get_version());
        $this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_styles');
        $this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts');
    }

    /**
     * Register all of the hooks related to the public-facing functionality
     * of the plugin.
     *
     * @since    1.0.0
     * @access   private
     */
    private function define_public_hooks()
    {
        $plugin_public = new Brezn_Configurator_Public($this->get_Brezn_Configurator(), $this->get_version());
        $this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'enqueue_styles');
        $this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'enqueue_scripts');
    }

    /**
     * Run the loader to execute all of the hooks with WordPress.
     *
     * @since    1.0.0
     */
    public function run()
    {
        $this->loader->run();
    }

    /**
     * The name of the plugin used to uniquely identify it within the context of
     * WordPress and to define internationalization functionality.
     *
     * @since     1.0.0
     * @return    string    The name of the plugin.
     */
    public function get_Brezn_Configurator()
    {
        return $this->Brezn_Configurator;
    }

    /**
     * The reference to the class that orchestrates the hooks with the plugin.
     *
     * @since     1.0.0
     * @return    Brezn_Configurator_Loader    Orchestrates the hooks of the plugin.
     */
    public function get_loader()
    {
        return $this->loader;
    }

    /**
     * Retrieve the version number of the plugin.
     *
     * @since     1.0.0
     * @return    string    The version number of the plugin.
     */
    public function get_version()
    {
        return $this->version;
    }

    /**
     * Load the template files.
     *
     */
    public static function load_templates()
    {
        require_once plugin_dir_path(dirname(__FILE__)) . 'templates/wrap.php';
    }
    
    /**
     * Save the basic options of the product from the first step of the configurator.
     * 
     */
    public static function save_basic()
    {
        $response = array(
          'success' => true,
        );

        $values = array();
        parse_str($_POST['form'], $values);

        $_SESSION['persons'] = $values['persons'];
        $_SESSION['type'] = $values['type'];
        $_SESSION['type-digit'] = $values['type-digit'];
        $_SESSION['dough'] = $values['dough'];
        $_SESSION['zones'] = $values['zones'];

        if (!$_SESSION['type']) {
            $response = array(
              'success' => false,
            );
        }

        echo json_encode($response);

        die();
    }

    /**
     * Get the previously set options and use them to display data in the second step
     * 
     */
    public static function get_basic()
    {
        $response = array(
            $_SESSION['persons'],
            $_SESSION['type'],
            $_SESSION['type-digit'],
            $_SESSION['dough'],
            $_SESSION['zones']
        );

        echo json_encode($response);

        die();
    }

    /**
     * Get the basic price of the product to show in the first step and further calculate based on the ingredients
     * 
     */
    public static function get_initial_price()
    {
        global $wpdb;

        $table_name = $wpdb->prefix . 'brezn_ingredients';
        $price = $wpdb->get_var("SELECT price FROM $table_name WHERE name='Brezn Semmelteig'");

        $_SESSION['initial_price'] = $price;
    }

    /**
     * Update the initial price in step 1 after selection of the basic options
     * 
     */
    public static function update_initial_price()
    {
        global $wpdb;

        $table_name = $wpdb->prefix . 'brezn_ingredients';

        $column = ($_POST['type'] == 'standard') ? 'price' : 'price_secondary';
        $price = $wpdb->get_var("SELECT $column FROM $table_name WHERE name='Brezn Semmelteig'");

        $_SESSION['initial_price'] = $price;

        echo json_encode($_SESSION['initial_price']);

        die();
    }

    /**
     * Get the ingredients with their prices from the database
     */
    public static function get_ingredients()
    {
        global $wpdb;

        $table_name = $wpdb->prefix . 'brezn_ingredients';
        $ingredient_groups_result = $wpdb->get_results("SELECT DISTINCT ingredient_group FROM $table_name");

        $ingredient_groups = [];
        $ingredients = [];

        foreach ($ingredient_groups_result as $ingredient_group) {
            $ingredients_result = $wpdb->get_results("SELECT * FROM $table_name WHERE ingredient_group = '$ingredient_group->ingredient_group'");

            foreach ($ingredients_result as $ingredient) {
                $ingredients[$ingredient_group->ingredient_group][] = $ingredient;
            }
        }

        return $ingredients;
    }

    /**
     * Calculate the price of the product in step 2 when selecting ingredients
     */
    public static function calculate_price()
    {
        $_SESSION['product'] = [];
        $_SESSION['final_price'] = 0;

        global $wpdb;

        $productPrice = 0;

        $table_name = $wpdb->prefix . 'brezn_ingredients';

        $column = ($_POST['type'] == 'standard') ? 'price' : 'price_secondary';

        foreach ($_POST['zoneOneTopping'] as $topping) {
            $ingredients_result = $wpdb->get_results("SELECT $column, ingredient_group FROM $table_name WHERE id=$topping[0]");

            foreach ($ingredients_result as $ingredient) {
                $price = $ingredient->price;
                $ingredient_group = $ingredient->ingredient_group;
            }

            $price *= $topping[1];

            /* if 2 zones are selected, the basic ingredient price will be split across the zones */
            if ($_SESSION['zones'] == 2 && $ingredient_group == 'Aufstrich') {
                $productPrice += $price / 2;
            } else {
                $productPrice += $price;
            }

            $_SESSION['product']['zone1'][] = array(
              'id' => $topping[0],
              'amount' => $topping[1],
              'name' => $topping[2]
            );
        }

        foreach ($_POST['zoneTwoTopping'] as $topping) {
            $ingredients_result = $wpdb->get_results("SELECT $column, ingredient_group FROM $table_name WHERE id=$topping[0]");

            foreach ($ingredients_result as $ingredient) {
                $price = $ingredient->price;
                $ingredient_group = $ingredient->ingredient_group;
            }

            $price *= $topping[1];

            /* if 2 zones are selected, the basic ingredient price will be split across the zones */
            if ($_SESSION['zones'] == 2 && ($ingredient_group == 'Aufstrich' || $ingredient_group == 'Garnierung')) {
                $productPrice += $price / 2;
            } else {
                $productPrice += $price;
            }

            $_SESSION['product']['zone2'][] = array(
              'id' => $topping[0],
              'amount' => $topping[1],
              'name' => $topping[2]
            );
        }

        $_SESSION['final_price'] = $_SESSION['initial_price'] + $productPrice;

        echo json_encode($_SESSION['final_price']);

        die();
    }

    /**
     * Add the product to the cart and show the custom options in the cart
     */
    public static function configurator_add_cart()
    {
        $form_basic = array();
        parse_str($_POST['form_basic'], $form_basic);

        $form_topping = array();
        parse_str($_POST['form_topping'], $form_topping);

        $custom_info = '<b>Grundoptionen</b><br/>';
        $custom_info .= '<ul>';
        $custom_info .= '<li>';

        foreach (explode('-', $form_basic['type']) as $substring) {
            $custom_info .= ucfirst($substring) . ' ';
        }

        $custom_info .= '</li>';

        if ($form_basic['type'] == 'formbrezn') {
            $custom_info .= '<li>';
            $custom_info .= 'Ziffer: ' . $form_basic['type-digit'];
            $custom_info .= '</li>';
        }

        $custom_info .= '<li>';

        foreach (explode('-', $form_basic['dough']) as $substring) {
            $custom_info .= ucfirst($substring) . ' ';
        }

        $custom_info .= '</li>';

        $custom_info .= '<li>';

        foreach (explode('-', $form_basic['zones']) as $substring) {
            $custom_info .= ucfirst($substring) . ' ';
        }

        $custom_info .= '</li>';
        $custom_info .= '</ul>';

        $custom_info .= '<br/><b>Belag</b>';

        if ($form_basic['zones'] == '2-zonen') {
            $custom_info .= '<br/><u>Zone 1:</u>';
        }

        $custom_info .= '<br />Aufstrich: ' . $form_topping['aufstrich-zone1'] . '<br /><br />';

        /*
         * Add all ingredients if they were selected and their respective amount.
         */
        $categories = [
            'wurst' => false,
            'rohwurst' => false,
            'schinken' => false,
            'kaese' => false,
            'gebratenes' => false,
            'garnierung' => false
        ];
        
        $zones = ($form_basic['zones'] == '2-zonen') ? 2 : 1;
        

        for ($i = 1; $i <= $zones ; $i++) { 
            if ($i == 2) {
                $custom_info .= '<u class="zone-underline">Zone 2:</u><br />';
                $custom_info .= 'Aufstrich: ' . $form_topping['aufstrich-zone2'] . '<br /><br />';
            }
        
            foreach ($categories as $category => $value) {
                $category_info = ucfirst($category) . ': <ul>';
            
        
                foreach ($form_topping as $key => $value ) { 
                    if (preg_match('~\b' . $category . '\b~', $key) && strpos($key, '-zone' . $i) !== false) { 
                        if ($value > 0 || preg_match('/[a-zA-Z]/', $value) != 0) { 
                            $categories[$category] = true;  
                        }             
                    }
         
                    
                    if ($categories[$category] === true) {
                        if (preg_match('~\b' . $category . '\b~', $key) && strpos($key, '-zone' . $i) !== false) {
                            if ($value != 0 || preg_match('/[a-zA-Z]/', $value) != 0) {
                                $substr = explode('-', $key)[1];
                                $ingredient = ucfirst(explode('-', $substr)[0]);
                
                                if ($value != 0) {
                                    $category_info .= '<li>' . $ingredient . ': ' . $form_topping[$key] . ' g</li>';
                                } else {
                                    $category_info .= '<li>' . $form_topping[$key] . '</li>';
                                }                    
                            }
                        } 
                    }
                }
            
        
                if ($categories[$category] === true) {
                    $custom_info .= $category_info . '</ul>';
                } else {            
                    $category_info = str_replace(ucfirst($category) . ': <ul>', '', $category_info);
                    $custom_info .= $category_info . '</ul>';
                } 
        
                $categories[$category] = false;
            }    
        }
        
        $custom_info = str_replace('ae', 'ä', $custom_info);


        global $woocommerce;

        WC()->cart->empty_cart();

        $_SESSION['custom_price'] = $_POST['custom_price'];

        $cart_item_data = array(
            'custom_price' => $_SESSION['custom_price'],
            'custom_info' => $custom_info
        );

        $woocommerce->cart->add_to_cart(420, 1, $variation_id, $variation, $cart_item_data);
        // Calculate totals
        $woocommerce->cart->calculate_totals();
        // Save cart to session
        $woocommerce->cart->set_session();
        // Maybe set cart cookies
        $woocommerce->cart->maybe_set_cart_cookies();

        echo json_encode($custom_info);

        die();
    }
}