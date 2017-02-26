<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Plugin_Name
 * @subpackage Plugin_Name/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Plugin_Name
 * @subpackage Plugin_Name/admin
 * @author     Your Name <email@example.com>
 */
class Minigal_Nano_Wp_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $minigal_nano_wp;

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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $minigal_nano_wp, $version ) {
		$this->minigal_nano_wp = $minigal_nano_wp;
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

		// wp_enqueue_style( $this->minigal_nano_wp, plugin_dir_url( __FILE__ ) . 'css/plugin-name-admin.css', array(), $this->version, 'all' );

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

		// wp_enqueue_script( $this->minigal_nano_wp, plugin_dir_url( __FILE__ ) . 'js/plugin-name-admin.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Register the settings page
	 *
	 * @since    1.0.0
	 */
	public function add_admin_menu() {
	    add_options_page( 'Minigal Nano WP', __('Minigal Nano WP', 'minigal-nano-wp'), 'manage_options', 'minigal_nano_wp_option_page', array($this, 'create_admin_interface'));
	}

	/**
	 * Callback function for the admin settings page.
	 *
	 * @since    1.0.0
	 */
	public function create_admin_interface(){

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/admin-display.php';

	}

	/**
	 * Creates our settings sections with fields etc.
	 *
	 * @since    1.0.0
	 */
	public function settings_api_init(){

		/**
		 * Sections functions
		 */

		// The basic section
	 	add_settings_section(
			'minigal_nano_wp_basic_settings_section',
			__('Basic Setup', 'minigal-nano-wp'),
			array($this, 'setting_section_callback_function'),
			'basic-settings'
		);

		// The Advanced section
	 	add_settings_section(
			'minigal_nano_wp_filters_advanced_settings_section',
			__('Advanced settings', 'minigal-nano-wp'),
				array($this, 'advanced_setting_section_callback_function'),
			'advanced-minigal-nano-wp-filters'
		);

		/**
		 * Basic settings
		 */

		// Add the field with the post types
	 	add_settings_field(
			'minigal_nano_wp_filters_customize',
			__('Edit settings below to customize your gallery', 'minigal-nano-wp'),
			array($this, 'customize_setting_callback_function'),
			'basic-settings',
			'minigal_nano_wp_basic_settings_section'
		);

		//register basic settings
		register_setting( 'basic-settings', 'minigal_nano_wp_filters_customize' );

		/**
		 * Advanced settings
		 */
		// Add checkbox to let users opt in to use the AJAX based dropdown relationship
	 	add_settings_field(
			'minigal_nano_wp_filters_settings',
			__('Edit advanced settings below to customize your gallery:', 'minigal-nano-wp-filters'),
			array($this, 'advanced_customize_setting_callback_function'),
			'advanced-minigal-nano-wp-filters',
			'minigal_nano_wp_filters_advanced_settings_section'
		);

		/**
		 * Register the new setting that should eventually hold all settings as an associative array
		 */
		register_setting( 'advanced-minigal-nano-wp-filters', 'minigal_nano_wp_filters_settings' );
	}

	/**
	 * Callback functions for settings
	 */

	/*
	 * Basic
	 */

	// The basic section
	function setting_section_callback_function(){
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/basic/basic-section-display.php';
	}

	// Select setttings
	function customize_setting_callback_function() {
 		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/basic/customize-settings-display.php';
 	}


 	/*
	 * Advanced
	 */

	// the advanced section
	function advanced_setting_section_callback_function(){
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/advanced/advanced-section-display.php';
	}

	// Disable Select2
 	function advanced_customize_setting_callback_function() {
 		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/advanced/advanced-customize-settings-display.php';
 	}
}
