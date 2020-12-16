<?php

/**
 * The Related post HTML template.
 *
 * @link       https://www.wecodeart.com/
 * @since      1.0.0
 *
 * @package    WCA\EXT\Related
 * @subpackage WCA\EXT\Related\Views
 */

defined( 'ABSPATH' ) || exit();

use function WeCodeArt\Functions\get_prop;
use function WCA\EXT\Related\template;

$config = wp_parse_args( [
    'postId' => $current_ID,
], $config );

$default_classes = [ 'related-posts', 'overflow-hiden', 'mb-5' ];
$classes = isset( $classes ) ? wp_parse_args( (array) $classes, $default_classes ) : $default_classes;
?>
<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>"
    data-plugin-related data-options="<?php echo esc_attr( wp_json_encode( $config ) ); ?>">
    <div class="row justify-content-center gx-0">
        <?php foreach( range( 1, absint( get_prop( $config['query'], 'amount', 4 ) ) ) as $col ) { ?>
        <article class="related-posts__item related-post col-12 col-md-6"><?php
        
            template( 'loading', [
                'class' => 'm-3'
            ] );
            
        ?></article>
        <?php } ?>
    </div>
</div>