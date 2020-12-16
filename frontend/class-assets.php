<?php
/**
 * The plugin Assets.
 *
 * @link       https://www.wecodeart.com/
 * @since      1.0.0
 *
 * @package    WCA\EXT\Related
 * @subpackage WCA\EXT\Related\Frontend
 */

namespace WCA\EXT\Related\Frontend;

use function WeCodeArt\Functions\get_prop;
use function WeCodeArt\Functions\wp_parse_args_r;

/**
 * Assets Support
 */
trait Assets {

    use \WeCodeArt\Core\Scripts\Base;

    /**
     * Listens for newsletter form submissions
     */
    public function enqueue_assets() {
		global $post;
		
		if( self::should_enqueue_assets() === false ) return;

        $default = [
			'version' => wecodeart( 'version' ),
		];
		$data = $default;

		// CSS
		$deps = sprintf( '%s/assets/css/%s.php', untrailingslashit( plugin_dir_path( __DIR__ ) ), 'frontend.asset' );
		if( is_readable( $deps ) ) {
			$file = require $deps;
			$data = wp_parse_args_r( $file, $default );
		}

		wp_register_style(
			$this->make_handle(), 
			plugin_dir_url( __DIR__ ) . 'assets/css/frontend.css',
			[],
			$data['version']
		);

		wp_enqueue_style( $this->make_handle() );

		// JS
		$deps = sprintf( '%s/assets/js/%s.php', untrailingslashit( plugin_dir_path( __DIR__ ) ), 'frontend.asset' );
		$data = wp_parse_args( [
			'dependencies'	=> [ 'wecodeart-core-scripts', 'wp-api-fetch', 'wp-url' ]
		], $default );

		if( is_readable( $deps ) ) {
			$file = require $deps;
			$data = wp_parse_args_r( $file, $data );
		}

		wp_register_script( 
			$this->make_handle(),
			plugin_dir_url( __DIR__ ) . 'assets/js/frontend.js',
			$data['dependencies'], 
			$data['version'], 
			true 
		);

		wp_enqueue_script( $this->make_handle() );
	}
	
	/**
     * Check if should enqueue assets
	 *
	 * @return bool
     */
	public static function should_enqueue_assets() {
		if( ! is_singular( 'post' ) ) return;
		
		if( ! empty( self::$config ) ) {
			$locations 	= array_filter( self::$config, function( $item ) {
				return $item !== false;
			} );
		} else {
			$locations	= [1];
		}

		if( count( $locations ) !== 0 ) return true;
		
		return false;
	}

	/**
     * Maybe add body route
	 *
	 * @param 	array $classes
	 * @return 	array $classes;
     */
	public function maybe_add_body_class( $classes ) {
		if( self::should_enqueue_assets() ) {
			$classes[] = 'wca-ext';
			$classes[] = 'wca-ext--related-entries';
		}

		return array_unique( $classes );
	}

	/**
	 * Filter Localize JS args
	 *
	 * @see 	wecodeart/filter/scripts/localize_js
	 * @return 	array
	 */
	public function localized_js( $args ) {
		if( ! isset( $args['REST'] ) ) {
			$args['REST'] = rest_url();
		}

		return $args;
	}
} 