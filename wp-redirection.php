<?php
/**
 * Plugin Name:     WP-Redirection.
 * Description:     WP-CLI command. Manage post revisions.
 * Version:         1.0
 * Author:          Trepmal
 * Author URI:      http://trepmal.com
 * Documentation:   https://github.com/trepmal/wp-revisions-cli
 */

// Basic security, prevents file from being loaded directly.
defined( 'ABSPATH' ) or die( 'Cheatin&#8217; uh?' );

function index_redirection() {
    if ( is_user_logged_in() ) {
        $current_user = wp_get_current_user();

        if ($current_user->roles[0] !== "administrator") {
            add_action('admin_init', function () {
                global $pagenow;
                if ('index.php' === $pagenow) {
                    wp_redirect(admin_url('/edit.php'));
                    exit;
                }
            });
        }
    }
}

function remove_links_tab_menu_pages() {
    if ( is_user_logged_in() ) {
        $current_user = wp_get_current_user();
        if ($current_user->roles[0] !== "administrator") {
            remove_menu_page('index.php');
        }
    }
}

add_action('init', 'index_redirection');
add_action( 'admin_menu', 'remove_links_tab_menu_pages' );