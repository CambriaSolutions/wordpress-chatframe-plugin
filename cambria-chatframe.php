<?php

/**
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              cambriasolutions.com
 * @since             1.0.0
 * @package           Cambria_Chatframe
 *
 * @wordpress-plugin
 * Plugin Name:       cambria-chatframe
 * Plugin URI:        cambriasolutions.com
 * Description:       This plugin generates a chat window on specified pages containing a dialogflow agent
 * Version:           1.0.0
 * Author:            Cambria Solutions
 * Author URI:        cambriasolutions.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 */
define( 'PLUGIN_NAME_VERSION', '1.0.0' );

/**
 * The core plugin class that is used to define public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-cambria-chatframe.php';

/**
 * Begins execution of the plugin.
 *
 * @since    1.0.0
 */
function run_cambria_chatframe() {

	$plugin = new Cambria_Chatframe();
	$plugin->run();

}
run_cambria_chatframe();
