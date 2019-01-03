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

//https://www.sitepoint.com/wordpress-settings-api-build-custom-admin-page/ 

add_action( 'admin_init', 'stp_api_settings_init' );

// Create the admin menu 
function add_chatframe_admin_menu (){
	add_options_page(
		'Chatframe Display Options', 				// The title to be displayed in the browser window for this page.
		'Chatframe Display Options',				// The text to be displayed for this menu item
		'administrator',							// Which type of users can see this menu item
		'chatframe-display-options',				// The unique ID - that is, the slug - for this menu item
		'chatframe_options_page' 					// The name of the function to call when rendering the page for this menu
	);
}
add_action('admin_menu', 'add_chatframe_admin_menu');


function stp_api_settings_init(  ) {
	add_settings_section(
		'chatframe_plugin_section',					// ID used to identify this section and with which to register options
		'Chatframe Display Options',				// Title to be displayed on the administration page
		'chatframe_settings_section_description',	// Callback used to render the description of the section
		'chatframePlugin'							// Page on which to add this section of options
	);
	
	add_settings_field(
		'homepage_option_checkbox',					// ID used to identify the field throughout the theme
		'Display on Home Page',	                    // The label to the left of the option interface element
		'chatframe_homepage_field',					 // The name of the function responsible for rendering the option interface
		'chatframePlugin',							// The page on which this option will be displayed
		'chatframe_plugin_section'					// The name of the section to which this field belongs
	);
	
	add_settings_field(
		'desired_pages_text_field',
		'Desired Pages',
		'desired_pages_text_field_render',
		'chatframePlugin',
		'chatframe_plugin_section'
	);

	// Register the fields with WordPress
	register_setting( 'chatframePlugin', 'chatframe_settings' );
}

function chatframe_homepage_field() {
	$options = get_option( 'chatframe_settings' );
	?>
	<input type="checkbox" id="homepage-checkbox" name="homepage-checkbox[chatframe_settings]"/>
	
	<?php
}

function desired_pages_text_field_render() {
	$options = get_option( 'chatframe_settings' );
	?>
	<input type='text' name='chatframe_settings[chatframe_settings]' value='<?php echo $options['chatframe_settings']; ?>'>
	<?php
}

		
function chatframe_settings_section_description(  ) {
	echo 'This Section Description';
}
		
function chatframe_options_page(  ) {
	$options = get_option( 'chatframe_settings' );
	echo implode($options);
	?>
	<form action='options.php' method='post'>
		<?php
		settings_fields( 'chatframePlugin' );
		do_settings_sections( 'chatframePlugin' );
		submit_button();
		?>
	</form>
	<?php
}
