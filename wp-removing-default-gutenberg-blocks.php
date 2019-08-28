<?php
/**
 * @link              https://guillaume-richard.fr/
 * @since             1.0.0
 * @package           mu-plugins
 *
 * @wordpress-plugin
 * Plugin URI:  https://guillaume-richard.fr/
 * Plugin Name: WP Removing Default Gutenberg Blocks
 * Description: Removing Default Gutenberg Blocks
 * Version:     1.0.0
 * Author:      Misha Rudrastyh
 * Author URI:  https://rudrastyh.com/gutenberg/remove-default-blocks.html
 * License:     GNU General Public License v3 or later
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 * WordPress Available:  yes
 * Requires License:    no
 */

// Basic security, prevents file from being loaded directly.
defined( 'ABSPATH' ) or die( 'Cheatin&#8217; uh?' );


// add_filter( 'allowed_block_types', 'misha_allowed_block_types', 10, 2 );

function misha_allowed_block_types( $allowed_blocks, $post ) {

    $allowed_blocks = array(
        'core/image',
        'core/paragraph',
        'core/heading',
        'core/list'
    );

    if( $post->post_type === 'page' ) {
        $allowed_blocks[] = 'core/shortcode';
    }

    return $allowed_blocks;

}

