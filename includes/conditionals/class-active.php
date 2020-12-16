<?php
/**
 * Fired during plugin activation
 *
 * @link       https://www.wecodeart.com/
 * @since      1.0.0
 *
 * @package    WCA\EXT\Related
 * @subpackage WCA\EXT\Related\Conditionals
 */

namespace WCA\EXT\Related\Conditionals;

use WeCodeArt\Conditional\Interfaces\ConditionalInterface;

/**
 * Conditional that is only met when in the admin.
 */
class Active implements ConditionalInterface {

	/**
	 * @inheritdoc
	 */
	public function is_met() {
		return wecodeart( 'integrations' )->has( 'extension/related' );
	}
}