<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://webfoundry.solutions
 * @since             1.0.0
 * @package           Wpcsi
 *
 * @wordpress-plugin
 * Plugin Name:       custom script insert
 * Plugin URI:        https://webfoundry.solutions
 * Description:       Custom script insert plugin for header and footer
 * Version:           1.0.0
 * Author:            Norbert Feria
 * Author URI:        https://webfoundry.solutions
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wpcsi
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
define( 'WPCSI_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-wpcsi-activator.php
 */
function activate_wpcsi() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wpcsi-activator.php';
	Wpcsi_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-wpcsi-deactivator.php
 */
function deactivate_wpcsi() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wpcsi-deactivator.php';
	Wpcsi_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_wpcsi' );
register_deactivation_hook( __FILE__, 'deactivate_wpcsi' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-wpcsi.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_wpcsi() {

	$plugin = new Wpcsi();
	$plugin->run();

}
run_wpcsi();
