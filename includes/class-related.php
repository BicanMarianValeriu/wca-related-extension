<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://www.wecodeart.com/
 * @since      1.0.0
 *
 * @package    WCA\EXT
 * @subpackage WCA\EXT\Related
 */

namespace WCA\EXT;

use WeCodeArt\Support\Interfaces\Integration;
use function WeCodeArt\Functions\get_prop;

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    WCA\EXT
 * @subpackage WCA\EXT\Related
 * @author     Bican Marian Valeriu <marianvaleriubican@gmail.com>
 */
class Related implements Integration {

	use \WeCodeArt\Singleton;
	use \WeCodeArt\Conditional\Traits\No_Conditionals;

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      WCA\EXT\Related\Loader $loader Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * The current config of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $config    The current config of the plugin.
	 */
	protected $config;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function init() {
		$this->plugin_name = 'wca-related-entries';
		if ( defined( 'WCA_RELATED_EXT_VERSION' ) ) {
			$this->version = WCA_RELATED_EXT_VERSION;
		} else {
			$this->version = wecodeart( 'version' );
		}

		$this->load_dependencies();
		$this->set_locale();
		$this->set_config();
		$this->define_admin_hooks();
		$this->define_public_hooks();
	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function register_hooks() {
		$this->loader->run();
	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - WCA\EXT\Related\Loader. Orchestrates the hooks of the plugin.
	 * - WCA\EXT\Related\I18n. Defines internationalization functionality.
	 * - WCA\EXT\Related\Admin. Defines all hooks for the admin area.
	 * - WCA\EXT\Related\Frontend. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {
		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		$this->loader = Related\Loader::get_instance();
	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the IAmBican\Includes\I18N class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {
		$i18n = Related\I18N::get_instance();

		$this->loader->add_action( 'plugins_loaded',	$i18n, 'load_plugin_textdomain' );
		$this->loader->add_action( 'init',				$i18n, 'set_script_translations' );
	}
	
	/**
	 * Define the config.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_config() {
		$this->config = wp_parse_args( get_prop( wecodeart_config( 'extensions' ), 'related-entries', [] ), [
			'query'	 => [
				'amount' => 4
			]
		] );
	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {
		$admin = new Related\Admin( $this->get_plugin_name(), $this->get_version(), $this->get_config() );

		$this->loader->add_action( 'admin_init', $admin, 'if_active'	);
		//$this->loader->add_filter( 'wecodeart/filter/customizer/defaults',		$admin, 'meta_defaults', 5 );
		//$this->loader->add_filter( 'wecodeart/filter/customizer/configurations', 	$admin, 'register_config', 40, 2 );
	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {
		$public = new Related\Frontend( $this->get_plugin_name(), $this->get_version(), $this->get_config() );

		$this->loader->add_action( 'wp_enqueue_scripts',	$public, 'enqueue_assets' );
		$this->loader->add_action( 'rest_api_init',			$public, 'rest_api_init' );
		$this->loader->add_filter( 'body_class',			$public, 'maybe_add_body_class' );
		$this->loader->add_action( 'wecodeart/filter/core/scripts/localize', 	$public, 'localized_js' );
		$this->loader->add_action( 'wecodeart/hook/entry/footer', $public, 'render_related_posts', 20 );
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Related    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

	/**
	 * Retrieve the config of the plugin.
	 *
	 * @since     1.0.0
	 * @return    mixed    The config array of the plugin.
	 */
	public function get_config() {
		return $this->config;
	}
}