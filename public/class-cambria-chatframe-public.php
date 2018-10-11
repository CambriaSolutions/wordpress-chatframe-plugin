<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       cambriasolutions.com
 * @since      1.0.0
 *
 * @package    Cambria_Chatframe
 * @subpackage Cambria_Chatframe/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Cambria_Chatframe
 * @subpackage Cambria_Chatframe/public
 * @author     Cambria Solutions <marketing@cambriasolutions.com>
 */
class Cambria_Chatframe_Public {

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

	/** 
	 * Register the div with id "demo"
	 * to be populated by our chat window
	 */

	public function display() {
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/partials/cambria-chatframe-public-display.php';
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {
		global $wp;
		$currentUrl =  home_url( $wp->request );
		$acceptedUrl = "child-support";
		$parsedUrl = parse_url($currentUrl, PHP_URL_PATH);

		if(strpos($parsedUrl, $acceptedUrl) !== false){
			$JSfiles = scandir(dirname(__FILE__) . '/app/build/static/js/');
			   $react_js_to_load = '';
			   foreach($JSfiles as $filename) {
				   if(strpos($filename,'.js')&&!strpos($filename,'.js.map')) {
					   $react_js_to_load = plugin_dir_url( __FILE__ ) . 'app/build/static/js/' . $filename;
					   echo "<script>console.log( \"$react_js_to_load\" );</script>";
					   wp_enqueue_script($filename, $react_js_to_load, array(), $this->version, true);
				   }
			   }
		}
	}
}
