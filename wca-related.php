<?php
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://www.wecodeart.com/
 * @since             1.0.0
 * @package           WCA\EXT\Related
 *
 * @wordpress-plugin
 * Plugin Name:       WCA: Related Entries Extension
 * Plugin URI:        https://www.wecodeart.com/
 * Description:       WCA Related Entries Extension for WeCodeArt Framework - Displays related posts under single posts.
 * Version:           1.0.0
 * Author:            Bican Marian Valeriu
 * Author URI:        https://www.wecodeart.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wca-related-entries
 * Domain Path:       /languages
 */
namespace WCA\EXT\Related;

// If this file is called directly, abort.
defined( 'WPINC' ) || die;

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'WCA_RELATED_EXT_VERSION', '1.0.0' );

require_once( __DIR__ . '/includes/class-autoloader.php' );

new Autoloader( 'WCA\EXT\Related', __DIR__ . '/includes' );
new Autoloader( 'WCA\EXT\Related', __DIR__ . '/frontend' );
new Autoloader( 'WCA\EXT\Related', __DIR__ . '/admin' );

/**
 * The code that runs during plugin activation.
 */
function activate() {
	Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 */
function deactivate() {
	Deactivator::deactivate();
}

register_activation_hook( __FILE__, __NAMESPACE__ . '\\activate' );
register_deactivation_hook( __FILE__, __NAMESPACE__ . '\\deactivate' );

/**
 * The code used to get the templates.
 */
function template( $file, $data = [], $echo = true  ) {
	$template 	= new \WeCodeArt\Markup\Template( new \WeCodeArt\Config( [
		'paths' => [
			'directory' => untrailingslashit( plugin_dir_path( __FILE__ ) ),
		],
		'directories' => [
			'views'     => 'views',
		],
		'views' => [
			'extension' => '.tpl.php'
		]
	] ) );

	$template->set_file( $file );
	
	if( (bool) $echo ) {
		return $template->render( $data );
	}
	
	return $template->compile( $data );
}

/**
 * Hook the extension after WeCodeArt is Loaded
 */
add_action( 'wecodeart/theme/loaded', function() {
	wecodeart( 'conditionals' )->register( 'has_related_extension',	Conditionals\Active::class );
	wecodeart( 'integrations' )->register( 'extension/related',	\WCA\EXT\Related::class );
} );