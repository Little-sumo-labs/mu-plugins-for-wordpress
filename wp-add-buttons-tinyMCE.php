<?php
/**
 * @link              https://guillaume-richard.fr/
 * @since             0.1.0
 * @package           mu-plugins
 *
 * @wordpress-plugin
 * Plugin URI:  https://guillaume-richard.fr/
 * Plugin Name: WP Add tinyMCE buttons
 * Description: Add new buttons in the tinyMCE Editor
 * Version:     0.1.0
 * Author:      AJ Clarke
 * Author URI:  http://www.wpexplorer.com/wordpress-tinymce-tweaks/
 * License:     GNU General Public License v3 or later
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 * Domain Path: /languages
 * WordPress Available:  yes
 * Requires License:    no
 */

// Basic security, prevents file from being loaded directly.
defined( 'ABSPATH' ) or die( 'Cheatin&#8217; uh?' );

// Enable full TinyMCE by default
function wpc_myformatTinyMCE( $in ) {
    $in['wordpress_adv_hidden'] = FALSE;
    return $in;
}

// Add buttons in TinyMCE
function wpc_add_more_buttons($buttons) {
    $buttons[] = 'charmap';
    $buttons[] = 'cut';
    $buttons[] = 'copy';
    $buttons[] = 'paste';

    return $buttons;
}

add_filter("mce_buttons", "wpc_add_more_buttons");
add_filter( 'tiny_mce_before_init', 'wpc_myformatTinyMCE' );