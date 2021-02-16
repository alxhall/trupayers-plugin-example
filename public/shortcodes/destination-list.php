<?php

/**
 * Shortcode for displaying list of destinations.
 *
 * @link       http://www.spinit.se
 * @since      1.0.0
 *
 */

class Trupayers_Customer_Portal_Shortcode_Destination_List {

    /**
	 * The instance of the helpers class.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
    private $api_wrapper;

    /**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct($plugin_name, $version) {
        $this->plugin_name = $plugin_name;
		$this->version = $version;

        $this->api_wrapper = new Trupayers_Customer_Portal_Api_Wrapper($this->plugin_name, $this->version);

        // Register Ajax functions, should be defined in a separate class and might not be necessary with alpine.js
        // add_action( 'wp_ajax_get_destinations', array( $actions, 'get_destinations' ) );
        // add_action( 'wp_ajax_nopriv_get_destinations', array( $actions, 'get_destinations' ) );
    }

	/**
	 * @since    1.0.0
	 */
	public function register() {
        add_shortcode('trp_destination_list', [$this, 'add_shortcode']);
    }

    /**
     * The shortcode function
     *
     * @param [type] $atts
     * @return void
     */
    public function add_shortcode( $atts ) {

        $args = shortcode_atts([
            'arg1' => '',
            'arg2' => '',
        ], $atts, 'trp_destination_list' );

        $params = [
            'first' => 1,
            'second' => 2
        ];

        $result = $this->api_wrapper->get_destinations("test", $params);

        $html = $result;

        return $html;

    }
}