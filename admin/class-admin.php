<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://www.wecodeart.com/
 * @since      1.0.0
 *
 * @package    WCA\EXT\Related
 * @subpackage WCA\EXT\Related\Admin
 */

namespace WCA\EXT\Related;

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    WCA\EXT\Related
 * @subpackage WCA\EXT\Related\Admin
 * @author     Bican Marian Valeriu <marianvaleriubican@gmail.com>
 */
class Admin {

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
	 * Check if active
	 *
	 * @since    1.0.0
	 */
	public function if_active() {
		if( (bool) get_transient( 'wecodeart/ext/related-entries/notice' ) === true ) return;

		add_action( 'admin_notices', [ $this, 'admin_notice' ] );
		set_transient( 'wecodeart/ext/related-entries/notice', true );
	}
	
	/**
	 * Add admin Notice
	 *
	 * @since	1.0.0
	 * @version	1.0.0
	 */
	public function admin_notice() {
		?>
		<div class="notice notice-success is-dismissible">
			<div class="notice__container"><?php

				printf(
					'<h3 class="notice__heading" style="margin-bottom:0px">%1$s</h3>
					<div class="notice__content">
						<p>%2$s</p>
						<p>
							<a href="%3$s" class="button button-primary">%4$s</a>
						</p>
					</div>',
					esc_html__( 'Awesome, WCA: Related Entries Extension is activated!', 'wca-related-entries' ),
					esc_html__( 'Go to WP Customizer and check the options.', 'wca-related-entries' ),
					esc_url( admin_url( '/customize.php' ) ),
					esc_html__( 'Awesome, show me the options', 'wca-related-entries' )
				);
		
			?></div>
		</div>
		<?php
	}
}
