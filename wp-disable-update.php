<?php
/**
 * @link              https://guillaume-richard.fr/
 * @since             0.1.0
 * @package           mu-plugins
 *
 * @wordpress-plugin
 * Plugin URI:  https://guillaume-richard.fr/
 * Plugin Name: WP Disable Update
 * Description: 7 Ways to Disable Update Notifications and Maintenance Nags in WordPress
 * Version:     0.1.0
 * Author:      wpoptimus
 * Author URI:  http://www.wpoptimus.com/626/7-ways-disable-update-wordpress-notifications/
 * License:     GNU General Public License v3 or later
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 * Domain Path: /languages
 * WordPress Available:  yes
 * Requires License:    no
 */

// Basic security, prevents file from being loaded directly.
defined( 'ABSPATH' ) or die( 'Cheatin&#8217; uh?' );

/////////////////////
//  "is_user_logged_in" is a pluggable function
//  Use the code below, otherwise you could get a fatal error.
/////////////////////
function disable_update() {
    if ( is_user_logged_in() ) {
        $current_user = wp_get_current_user();

        if ($current_user->roles[0] === "administrator") {
            // Disable Update WordPress nag
            add_action('after_setup_theme','wpc_remove_core_updates');

            // Disable Plugin Update Notifications
            remove_action('load-update-core.php','wp_update_plugins');
            add_filter('pre_site_transient_update_plugins','__return_null');

            // Disable all the Nags & Notifications
            function wpc_remove_core_updates(){
                global $wp_version;

                return(object) array(
                    'last_checked'=> time(),
                    'version_checked'=> $wp_version
                );
            }

            add_filter('pre_site_transient_update_core','wpc_remove_core_updates');
            add_filter('pre_site_transient_update_plugins','wpc_remove_core_updates');
            add_filter('pre_site_transient_update_themes','wpc_remove_core_updates');

            add_action('admin_menu', 'wpc_wphidenag'); // Hide WordPress Update Alert
            function wpc_wphidenag() {
                remove_action('admin_notices', 'update_nag', 3);
            }
        }
    }
}
add_action('init', 'disable_update');