<?php

/**
 * Fired during plugin deactivation
 *
 * @link       https://www.wecodeart.com/
 * @since      1.0.0
 *
 * @package    WCA\EXT\Related
 * @subpackage WCA\EXT\Related\DeActivator
 */

namespace WCA\EXT\Related;

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    WCA\EXT\Related
 * @subpackage WCA\EXT\Related\DeActivator
 * @author     Bican Marian Valeriu <marianvaleriubican@gmail.com>
 */
class Deactivator {
	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate() {
		delete_transient( 'wecodeart/ext/related-entries/notice' );
	}
}
