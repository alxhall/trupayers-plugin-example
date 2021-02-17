<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://www.spinit.se
 * @since      1.0.0
 *
 * @package    Trupayers_Customer_Portal
 * @subpackage Trupayers_Customer_Portal/includes
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
 * @package    Trupayers_Customer_Portal
 * @subpackage Trupayers_Customer_Portal/includes
 * @author     Spinit AB <info@spinit.se>
 */
class Trupayers_Customer_Portal {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Trupayers_Customer_Portal_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

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
	public function __construct() {
		if ( defined( 'TRUPAYERS_CUSTOMER_PORTAL_VERSION' ) ) {
			$this->version = TRUPAYERS_CUSTOMER_PORTAL_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'trupayers-customer-portal';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();
		$this->define_shortcode_hooks();
	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Trupayers_Customer_Portal_Loader. Orchestrates the hooks of the plugin.
	 * - Trupayers_Customer_Portal_i18n. Defines internationalization functionality.
	 * - Trupayers_Customer_Portal_Admin. Defines all hooks for the admin area.
	 * - Trupayers_Customer_Portal_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-trupayers-customer-portal-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-trupayers-customer-portal-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-trupayers-customer-portal-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-trupayers-customer-portal-public.php';

		/**
		 * API wrapper helper class
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/api/class-trupayers-customer-portal-api-wrapper.php';

		/**
		 * Shortcode classes
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/shortcodes/trp-destination-list.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/shortcodes/trp-destination-single.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/shortcodes/trp-transaction-list.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/shortcodes/trp-invoice-list.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/shortcodes/trp-display-card.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/shortcodes/trp-user-profile.php';

		$this->loader = new Trupayers_Customer_Portal_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Trupayers_Customer_Portal_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Trupayers_Customer_Portal_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Trupayers_Customer_Portal_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Trupayers_Customer_Portal_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

	}

	/**
	 * Register all of the shortcodes related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_shortcode_hooks() {

		$classes = [];
		$classes['trp_destination_list'] = new Trupayers_Customer_Portal_Shortcode_Destination_List($this->plugin_name, $this->version);
		$classes['trp_destination_single'] = new Trupayers_Customer_Portal_Shortcode_Destination_Single($this->plugin_name, $this->version);
		$classes['trp_transaction_list'] = new Trupayers_Customer_Portal_Shortcode_Transaction_List($this->plugin_name, $this->version);
		$classes['trp_invoice_list'] = new Trupayers_Customer_Portal_Shortcode_Invoice_List($this->plugin_name, $this->version);
		$classes['trp_display_card'] = new Trupayers_Customer_Portal_Shortcode_Display_Card($this->plugin_name, $this->version);
		$classes['trp_user_profile'] = new Trupayers_Customer_Portal_Shortcode_User_Profile($this->plugin_name, $this->version);

		foreach($classes as $class) {
			$this->loader->add_action( 'init', $class, 'register', 10 );
		}

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Trupayers_Customer_Portal_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
