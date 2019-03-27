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
 * Current plugin version.
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

// Include array of url paths that we want our window to be present
include 'white-listed-pages.php'; 

/**
 * Grab the current url
 * and separate by the / character
 */

$parsedUrlPath = $_SERVER['REQUEST_URI'];
$arrayOfParsedUrlPath = explode("/", $parsedUrlPath);

/**
 * Check if the any part of our current path contains the root path or
 * our white-listed paths, if so, mark enqueue scripts to true and 
 * terminate the loop
 */
if($parsedUrlPath === "/"){
	run_cambria_chatframe();
}else {
	foreach($arrayOfParsedUrlPath as $thisPath){
		if(in_array($thisPath, $acceptedPathArray)){
			run_cambria_chatframe();
		} 
	}
};