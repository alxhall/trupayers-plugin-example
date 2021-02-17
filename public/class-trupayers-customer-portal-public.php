<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://www.spinit.se
 * @since      1.0.0
 *
 * @package    Trupayers_Customer_Portal
 * @subpackage Trupayers_Customer_Portal/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Trupayers_Customer_Portal
 * @subpackage Trupayers_Customer_Portal/public
 * @author     Spinit AB <info@spinit.se>
 */
class Trupayers_Customer_Portal_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Trupayers_Customer_Portal_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Trupayers_Customer_Portal_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/trupayers-customer-portal-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Trupayers_Customer_Portal_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Trupayers_Customer_Portal_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/trupayers-customer-portal-public.js', array( 'jquery' ), $this->version, false );


		/* Using wp_localize_script to pass variables from PHP to javascript */
		wp_register_script( 'trp_destination_list_js', plugin_dir_url( __FILE__ ) . 'js/trp-destination-list.js', array('jquery'), $this->version, false );

		wp_localize_script( 
			'trp_destination_list_js',
			'trpjs',
			array(
				'ajaxurl' => admin_url( 'admin-ajax.php' ),
				'nonce' => wp_create_nonce("trp_destination_list_nonce"),
				'is_user_logged_in' => is_user_logged_in(),
				'user_id' => get_current_user_id(),
				'custom_prop' => "Hello Custom Prop"
			)
		);

		wp_enqueue_script('trp_destination_list_js');

	}

}
