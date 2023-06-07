<?php

/**
 *
 * @link              https://github.com/norbertferia
 * @since             1.0.0
 * @package           Wpcsi
 *
 * @wordpress-plugin
 * Plugin Name:       custom script insert
 * Plugin URI:        https://github.com/NorbertFeria/wpcustomscriptinsert
 * Description:       Custom script insert plugin for header and footer plus shortcode creation and insertion.
 * Version:           1.0.0
 * Author:            Norbert Feria
 * Author URI:        https://github.com/norbertferia
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
 * @since    1.0.0
 */
function run_wpcsi() {

	$plugin = new Wpcsi();
	$plugin->run();

}
run_wpcsi();
