<?php

/**
 * The frontend-specific functionality of the plugin.
 *
 * @link       https://www.wecodeart.com/
 * @since      1.0.0
 *
 * @package    WCA\EXT\Related
 * @subpackage WCA\EXT\Related\Frontend
 */

namespace WCA\EXT\Related;

use function WCA\EXT\Related\template;

/**
 * The frontend-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the frontend-specific stylesheet and JavaScript.
 *
 * @package    WCA\EXT\Related
 * @subpackage WCA\EXT\Related\Frontend
 * @author     Bican Marian Valeriu <marianvaleriubican@gmail.com>
 */
class Frontend {

	use Frontend\Rest;
	use Frontend\Assets;

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
	 * @since	1.0.0
	 * @access	private
	 * @var		string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * The config of this plugin.
	 *
	 * @since	1.0.0
	 * @access	private
	 * @var		string    $config    The current config of this plugin.
	 */
	private $config;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since	1.0.0
	 * @param	string    $plugin_name	The name of this plugin.
	 * @param	string    $version		The version of this plugin.
	 * @param	string    $config		The config of this plugin.
	 */
	public function __construct( $plugin_name, $version, $config ) {
		$this->plugin_name	= $plugin_name;
		$this->version 		= $version;
		$this->config 		= $config;
	}

	/**
	 * Related Posts
	 *
	 * @since 	1.0.0
	 * @version	1.0.0
	 *
	 * @return 	string
	 */
	public function render_related_posts() {
		if( ! $this->config || ! is_singular( 'post' ) ) return;

		if( isset( $this->config['post'] ) && $this->config['post'] === false ) return;

		template( 'index', [
			'current_ID' 	=> get_the_ID(),
			'config'		=> $this->config
		] );
	}
}
