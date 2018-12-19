<?php

/**
 * The admin-facing functionality of the plugin.
 *
 * @link       cambriasolutions.com
 * @since      1.0.0
 *
 * @package    Cambria_Chatframe
 * @subpackage Cambria_Chatframe/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 *
 * @package    Cambria_Chatframe
 * @subpackage Cambria_Chatframe/admin
 * @author     Cambria Solutions <marketing@cambriasolutions.com>
 */
class Cambria_Chatframe_Admin {

	/**
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name   cambria-chatframe
	 */
	private $plugin_name;

	/**
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version   1.0.0
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name    
	 * @param      string    $version    
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

    /**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {
		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Plugin_Name_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Plugin_Name_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/cambria-chatframe-admin.css', array(), $this->version, 'all' );
    }
 
	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {
		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Plugin_Name_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Plugin_Name_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/cambria-chatframe-admin.js', array( 'jquery' ), $this->version, false );
	}
}
