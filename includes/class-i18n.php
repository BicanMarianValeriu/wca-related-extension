<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://www.wecodeart.com/
 * @since      1.0.0
 *
 * @package    WCA\EXT\Related
 * @subpackage WCA\EXT\Related\I18N
 */

namespace WCA\EXT\Related;

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    WCA\EXT\Related
 * @subpackage WCA\EXT\Related\I18N
 * @author     Bican Marian Valeriu <marianvaleriubican@gmail.com>
 */
class I18N {

	use \WeCodeArt\Singleton;
	
	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {
		load_plugin_textdomain( 'wca-related-entries', false, dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages' );
	}

	/**
     * Set Script Translation
	 *
	 * @return void
     */
	public function set_script_translations() {
		$handle = 'wca-ext-woo-related-entries-frontend';
        wp_set_script_translations( $handle, 'wca-related-entries', dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages' );
    }
}
