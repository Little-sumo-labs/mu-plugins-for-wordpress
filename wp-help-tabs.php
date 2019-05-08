<?php
/**
 * Plugin Name: WP Help Tabs
 * Description: Remove the help tabs, for non-administrator user
 * Version:     1.0
 * Author:      Guillaume RICHARD
 * Author URI:  https://guillaume-richard.fr/
 */

// Basic security, prevents file from being loaded directly.
defined( 'ABSPATH' ) or die( 'Cheatin&#8217; uh?' );

function help_tabs_user() {
    if ( is_user_logged_in() ) {
        $current_user = wp_get_current_user();

        if ($current_user->roles[0] !== "administrator") {
            function wpc_remove_help($old_help, $screen_id, $screen) {
                $screen->remove_help_tabs();
                return $old_help;
            }

            add_filter('contextual_help', 'wpc_remove_help', 999, 3);
        }
    }
}
add_action('init', 'help_tabs_user');