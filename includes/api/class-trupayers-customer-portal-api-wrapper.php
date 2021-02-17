<?php

/**
 * Trupayers API wrapper with helper functions.
 *
 * @link       https://www.spinit.se
 * @since      1.0.0
 *
 * @package    Trupayers_Customer_Portal
 * @subpackage Trupayers_Customer_Portal/includes/api
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
class Trupayers_Customer_Portal_Api_Wrapper {

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
	 * API base URL.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $api_base_url    The base URL for the API.
	 */
	private $api_base_url;

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

        if ( defined( 'TRUPAYERS_API_BASE_URL' ) ) {
			$this->api_base_url = TRUPAYERS_API_BASE_URL;
		} else {
			$this->api_base_url = 'yyy';
		}

        // Register Ajax functions
        add_action( 'wp_ajax_trp_get_destinations', array( $this, 'get_destinations_json' ) );
        add_action( 'wp_ajax_nopriv_trp_get_destinations', array( $this, 'get_destinations_json' ) );

        add_action( 'wp_ajax_trp_get_transactions', array( $this, 'get_transactions_json' ) );
        add_action( 'wp_ajax_nopriv_trp_get_transactions', array( $this, 'get_transactions_json' ) );

	}

    private function get_destinations(array $params) {

        // Do some filtering and validation before calling API

        if ( empty( $params ) ) {
            return false;
        }

        // Make the request
        // $result = wp_remote_get( $url );

        // Check that WordPress was able to send the request, otherwise error
        // if ( is_wp_error( $result ) ) {
        //     echo $result->get_error_message();
        //     return false;
        // }

        // Decode the response so we can use it
        // $data = json_decode( $result['body'] );

        // if ( $result['response']['code'] == 200 ) {
        //     return $data;
        // } else {
        //     return false;
        // }

        $user_id = $params['user_id'];

        $fake_data = [
            [
                "name" => "Copenhagen",
                "fromDate" => "20200115",
                "toDate" => "20200120",
                "user_id" => $user_id
            ], 
            [
                "name" => "Malmö",
                "fromDate" => "20200115",
                "toDate" => "20200120",
                "user_id" => $user_id
            ]
        ];

        $result = $fake_data;

        return $result;

    }

    public function get_destinations_json() {
        if ( !wp_verify_nonce( $_REQUEST['nonce'], "trp_destination_list_nonce")) {
            exit("Invalid request");
        }

        $data = $_REQUEST;

        $api_result = $this->get_destinations( $data );

        $result = [
            'code' => 200,
            'message' => 'success',
            'data' => $api_result
        ];

        wp_send_json($result);

    }



    public function get_transactions( string $url, array $args ) {

        // do some filtering and validation before calling API

        //$result = wp_remote_get( $url, $args );

        $result = "Fake result from api_wrapper->get_transactions()";

        return $result;

    }

    // etc.

}
