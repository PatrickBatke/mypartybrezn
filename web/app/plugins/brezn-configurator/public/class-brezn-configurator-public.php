<?php
/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Brezn_Configurator
 * @subpackage Brezn_Configurator/public
 */
/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Brezn_Configurator
 * @subpackage Brezn_Configurator/public
 * @author     Your Name <email@example.com>
 */
class Brezn_Configurator_Public
{
    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $brezn_configurator    The ID of this plugin.
     */
    private $brezn_configurator;
    /**
     * The version of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $version    The current version of this plugin.
     */
    private $version;
    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     * @param      string    $brezn_configurator      The name of the plugin.
     * @param      string    $version    The version of this plugin.
     */
    public function __construct($brezn_configurator, $version)
    {
        $this->brezn_configurator = $brezn_configurator;
        $this->version = $version;
    }
    /**
     * Register the stylesheets for the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function enqueue_styles()
    {
        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Brezn_Configurator_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Brezn_Configurator_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */
        #wp_enqueue_style('jquery-timepicker-style', plugin_dir_url(__FILE__) . 'css/jquery.timepicker.min.css', false, '1.1', 'all');
    }
    /**
     * Register the JavaScript for the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts()
    {
        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Brezn_Configurator_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Brezn_Configurator_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */
        wp_enqueue_script($this->brezn_configurator, plugin_dir_url(__FILE__) . 'js/brezn-configurator.js', array( 'jquery' ), $this->version, false);
    }
}
