<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://www.spinit.se
 * @since      1.0.0
 *
 * @package    Trupayers_Customer_Portal
 * @subpackage Trupayers_Customer_Portal/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Trupayers_Customer_Portal
 * @subpackage Trupayers_Customer_Portal/includes
 * @author     Spinit AB <info@spinit.se>
 */
class Trupayers_Customer_Portal_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'trupayers-customer-portal',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
