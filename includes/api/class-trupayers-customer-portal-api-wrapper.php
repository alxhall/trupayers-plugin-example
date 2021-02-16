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

    public function get_destinations( string $url, array $args ) {

        // do some filtering and validation before calling API

        //$result = wp_remote_get( $url, $args );

        $result = "Fake result from api_wrapper->get_destinations()";

        return $result;

    }

    public function get_transactions( string $url, array $args ) {

        // do some filtering and validation before calling API

        //$result = wp_remote_get( $url, $args );

        $result = "Fake result from api_wrapper->get_transactions()";

        return $result;

    }

    // etc.

}
