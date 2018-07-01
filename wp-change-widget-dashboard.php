<?php
/**
 * @link              https://guillaume-richard.fr/
 * @since             0.1.0
 * @package           mu-plugins
 *
 * @wordpress-plugin
 * Plugin URI:  https://guillaume-richard.fr/
 * Plugin Name: WP remove/add Widget Dashboard
 * Description: For non-administrator users, remove widgets from the dashboard, and add new widgets
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

function current_dashboard_user() {
    if ( is_user_logged_in() ) {
        $current_user = wp_get_current_user();

        if ($current_user->roles[0] !== "administrator") {
            /////////////////////
            // Remove the dashboard widget
            /////////////////////
            function wpc_remove_dashboard_widget() {
                global $wp_meta_boxes;

                unset($wp_meta_boxes["dashboard"]["normal"]["core"]["dashboard_right_now"]);
                unset($wp_meta_boxes["dashboard"]["normal"]["core"]["dashboard_activity"]);
                unset($wp_meta_boxes["dashboard"]["side"]["core"]["dashboard_quick_press"]);
                unset($wp_meta_boxes["dashboard"]["side"]["core"]["dashboard_primary"]);
            }

            add_action('wp_dashboard_setup', 'wpc_remove_dashboard_widget');
            add_filter('screen_options_show_screen', '__return_false');

            /////////////////////
            // Add another widget in the dashboard
            /////////////////////
            function dashboard_widget_function() {
                // Cron Tab, Informations, liens vers pages, etc...
                echo 'Vous êtes maintenant connecté à l\'espace d\'administration';
            }

            function dashboard_new_widget_function() {
                // Cron Tab, Informations, liens vers pages, etc...
                echo 'Code HTML du super widget';
            }

            function add_dashboard_widgets() {
                wp_add_dashboard_widget('summary_dashboard_widget', 'Bienvenue','dashboard_widget_function');
                wp_add_dashboard_widget('summary_dashboard_newwidget', 'New Widget','dashboard_new_widget_function');
            }

            add_action('wp_dashboard_setup', 'add_dashboard_widgets');
        }
    }
}
add_action('init', 'current_dashboard_user');