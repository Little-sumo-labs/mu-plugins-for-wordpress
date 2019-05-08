<?php
/**
 * Plugin Name: WP Delete Version
 * Description: Remove the version number of Wordpress
 * Version:     1.0
 * Author:      Guillaume RICHARD
 * Author URI:  https://guillaume-richard.fr/
 */

// Basic security, prevents file from being loaded directly.
defined( 'ABSPATH' ) or die( 'Cheatin&#8217; uh?' );

// Remove version in footer
function wpc_remove_version_footer() {
    remove_filter('update_footer', 'core_update_footer');
}
add_filter('admin_menu', 'wpc_remove_version_footer');

// Remove version in RSS Feeds
function remove_version_generator() {
    return  '';
}
add_filter('the_generator', 'remove_version_generator');

// Cacher le numéro de version de WordPress via les appels aux scripts.
function removeVersionCallback($matches) {
    return "ver=".md5(print_r($matches, true)."");
}
function removeVersion($url) {
    return preg_replace_callback("/ver=[^&]*/", 'removeVersionCallback', $url);
}
add_filter( 'style_loader_src', 'removeVersion');
add_filter( 'script_loader_src', 'removeVersion');