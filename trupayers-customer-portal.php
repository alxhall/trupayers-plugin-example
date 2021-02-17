<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://www.spinit.se
 * @since             1.0.0
 * @package           Trupayers_Customer_Portal
 *
 * @wordpress-plugin
 * Plugin Name:       Trupayers Customer Portal
 * Plugin URI:        https://www.spinit.se
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Spinit AB
 * Author URI:        https://www.spinit.se
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       trupayers-customer-portal
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'TRUPAYERS_CUSTOMER_PORTAL_VERSION', '1.0.0' );


/**
 * Our API base URL.
 */
define( 'TRUPAYERS_API_BASE_URL', 'xxxxxxxxxxxxxxxxxxx' );


/**
 * Store plugin base dir, for easier access later from other classes.
 * (eg. Include, pubic or admin)
 */
define( 'TRUPAYERS_CUSTOMER_PORTAL_BASE_DIR', plugin_dir_path( __FILE__ ) );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-trupayers-customer-portal-activator.php
 */
function activate_trupayers_customer_portal() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-trupayers-customer-portal-activator.php';
	Trupayers_Customer_Portal_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-trupayers-customer-portal-deactivator.php
 */
function deactivate_trupayers_customer_portal() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-trupayers-customer-portal-deactivator.php';
	Trupayers_Customer_Portal_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_trupayers_customer_portal' );
register_deactivation_hook( __FILE__, 'deactivate_trupayers_customer_portal' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-trupayers-customer-portal.php';

/**
 * Initialize custom template loader
 *
 * Template File Loaders in Plugins
 * Template file loaders like this are used in a lot of large-scale plugins in order to
 * provide greater flexibility and better control for advanced users that want to tailor
 * a plugin’s output more to their specific needs.
 *
 * @link https://github.com/pippinsplugins/pw-sample-template-loader-plugin
 * @link https://pippinsplugins.com/template-file-loaders-plugins/
 */
if( ! class_exists( 'Gamajo_Template_Loader' ) ) {
    require TRUPAYERS_CUSTOMER_PORTAL_BASE_DIR . 'includes/libraries/class-gamajo-template-loader.php';
}
require TRUPAYERS_CUSTOMER_PORTAL_BASE_DIR . 'includes/libraries/class-trupayers-customer-portal-template-loader.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_trupayers_customer_portal() {

	$plugin = new Trupayers_Customer_Portal();
	$plugin->run();

}
run_trupayers_customer_portal();


