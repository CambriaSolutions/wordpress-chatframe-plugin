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
 * Check if the any part of our current path contains
 * our white-listed paths, if so, mark enqueue scripts to
 * true and terminate the loop
 */

foreach($arrayOfParsedUrlPath as $thisPath){
	if(in_array($thisPath, $acceptedPathArray)){
		run_cambria_chatframe();
	} 
}

add_action('admin_menu', 'my_admin_menu');

function my_admin_menu() {
	add_menu_page( 'Settings Menue', 'Chatframe Settings', 'manage_options', 'wordpress-chatframe-plugin/cambria-chatframe-admin-page.php', 'cambria_chatframe_admin_page', '
	dashicons-testimonial', 6  );
}

function cambria_chatframe_admin_page(){
		?>
		  <div>
		  <?php screen_icon(); ?>
		  <h2>My Plugin Page Title</h2>
		  <form method="post" action="options.php">
		  <?php settings_fields( 'myplugin_options_group' ); ?>
		  <h3>This is my option</h3>
		  <p>Some text here.</p>
		  <table>
		  <tr valign="top">
		  <th scope="row"><label for="myplugin_option_name">Label</label></th>
		  <td><input type="text" id="myplugin_option_name" name="myplugin_option_name" value="<?php echo get_option('myplugin_option_name'); ?>" /></td>
		  </tr>
		  </table>
		  <?php  submit_button(); ?>
		  </form>
		  </div>
		<?php
		} ?>