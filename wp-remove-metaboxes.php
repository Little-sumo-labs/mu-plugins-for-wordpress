<?php
/**
 * Plugin Name: WP Remove Metaboxes
 * Description: Deleting unnecessary Metabox in Posts
 * Version:     1.0
 * Author:      Guillaume RICHARD
 * Author URI:  https://guillaume-richard.fr/
 */

// Basic security, prevents file from being loaded directly.
defined( 'ABSPATH' ) or die( 'Cheatin&#8217; uh?' );

// Page d'inspiration : http://codex.wordpress.org/Function_Reference/remove_meta_box

// Remove metaboxes in post
function wpc_remove_meta_boxes() {
    remove_meta_box('authordiv', 'post', 'normal');
    remove_meta_box('commentstatusdiv', 'post', 'normal');
    remove_meta_box('commentsdiv', 'post', 'normal');
    remove_meta_box('formatdiv', 'post', 'normal');
    remove_meta_box('pageparentdiv', 'post', 'normal');
    remove_meta_box('postcustom', 'post', 'normal');
    remove_meta_box('postexcerpt', 'post', 'normal');
    remove_meta_box('revisionsdiv', 'post', 'normal');
    remove_meta_box('slugdiv', 'post', 'normal');
    remove_meta_box('tagsdiv-post_tag', 'post', 'normal');
    remove_meta_box('trackbacksdiv', 'post', 'normal');
}

add_action( 'admin_menu', 'wpc_remove_meta_boxes' );