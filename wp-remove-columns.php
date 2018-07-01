<?php
/**
 * @link              https://guillaume-richard.fr/
 * @since             0.1.0
 * @package           mu-plugins
 *
 * @wordpress-plugin
 * Plugin URI:  https://guillaume-richard.fr/
 * Plugin Name: WP Remove Columns
 * Description: Remove columns and Media columns in list view
 * Version:     0.1.0
 * Author:      Guillaume RICHARD
 * Author URI:  https://guillaume-richard.fr/
 * License:     GNU General Public License v3 or later
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 * Domain Path: /languages
 * WordPress Available:  yes
 * Requires License:    no
 */

// Basic security, prevents file from being loaded directly.
defined( 'ABSPATH' ) or die( 'Cheatin&#8217; uh?' );

// Page d'inspiration : https://developer.wordpress.org/reference/hooks/manage_media_columns/

// Remove columns in list view
function wpc_remove_columns() {
    remove_post_type_support( 'post', 'author' );
    remove_post_type_support( 'post', 'comments' );
}

function wpc_remove_media_columns( $columns ) {
    unset( $columns['author'] );
    unset( $columns['comments'] );

    return $columns;
}

add_action( 'admin_init', 'wpc_remove_columns' );
add_filter( 'manage_media_columns', 'wpc_remove_media_columns' );