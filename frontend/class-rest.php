<?php
/**
 * The plugin REST.
 *
 * @link       https://www.wecodeart.com/
 * @since      1.0.0
 *
 * @package    WCA\EXT\Related
 * @subpackage WCA\EXT\Related\Frontend\Rest
 */

namespace WCA\EXT\Related\Frontend;

use WeCodeArt\Core\Entry\Media;
use function WeCodeArt\Functions\get_prop;
use function WeCodeArt\Functions\wp_parse_args_r;

/**
 * Rest Support
 */
trait Rest {
    /**
	 * Register Route
	 */
	public function rest_api_init() {
		register_rest_route( 'wp/v2', '/posts/(?P<post_id>[\d]+)/related', [
			'methods' 	=> 'GET',
			'callback' 	=> [ $this, 'get_related_entries' ],
			'permission_callback' => '__return_true',
			'args' 		=> [
				'per_page' => [ 
					'validate_callback' => function( $param, $request, $key ) {
						return is_numeric( $param );
					}
				]
			],
		] );
	}

	/**
	 * No cache headers
	 */
	public function rest_send_nocache_headers() {
		$send_no_cache_headers = apply_filters( 'rest_send_nocache_headers', is_user_logged_in() );
		if ( ! $send_no_cache_headers && ! is_admin() && $_SERVER['REQUEST_METHOD'] == 'GET' ) {
			$_SERVER['HTTP_X_WP_NONCE'] = wp_create_nonce( 'wp_rest' );
		}
	}

	/**
	 * Related
	 */
	public function get_related_entries( $request ) {
		$post_id 	= absint( $request['post_id'] );
		$parameters = $request->get_query_params();

		$uposts = get_posts( [
			'post_type'		=> 'post',
			'category__in'	=> wp_get_post_categories( $post_id ),
			'numberposts' 	=> isset( $parameters['per_page'] ) ? $parameters['per_page'] : 4,
			'post__not_in'	=> array( $post_id ),
			'orderby'		=> 'rand',
		] );

		$related = [];
		
		if( $uposts ) :

			$controller = new \WP_REST_Posts_Controller( 'post' );

			$avatar_size = apply_filters( 'wecodeart/filter/ext/related/gravatar_size', 30 );

			foreach ( $uposts as $post ) {
				if ( ! $controller->check_read_permission( $post ) ) {
					continue;
				}
				
				$author_id 		= $post->post_author;
				$author_name 	= get_the_author_meta( 'display_name', $author_id );
				$avatar_alt  	= sprintf( esc_html__( "%s's gravatar", 'wca-related' ), $author_name );
				$author_avatar	= get_avatar( get_the_author_meta( 'email', $author_id ), $avatar_size, '', $avatar_alt );

				$data			= $controller->prepare_item_for_response( $post, $request );

				$has_size		= isset( $parameters['image_size'] ) ? Media::get_image_sizes( $parameters['image_size'] ) : false;
				$media_size		= $has_size ? $parameters['image_size'] : 'large';

				$media  = [
					'post_id' 	=> $post->ID,
					'dummy'		=> false,
					'size'    	=> $media_size
				];

				$related[] = wp_parse_args( [
					'author'	=> [
						'name' 		=> $author_name,
						'avatar'	=> $author_avatar
					],
					'featured_media' => [
						'ID' 	=> Media::get_media_id( 'image', 0, $post->ID ),
						'html'	=> Media::get_image( $media ),					
						'url' 	=> Media::get_image( wp_parse_args( [
							'format' => 'url',
						], $media ) ),
						'_size'	=> $has_size ? $media_size : __( 'Size not found, loading large fallback.', 'wca-related' ),
					]
				], $controller->prepare_response_for_collection( $data ) );
			}
		endif;
		
    	return new \WP_REST_Response( $related, 200 );
	}
} 