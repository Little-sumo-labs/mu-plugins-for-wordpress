<?php
/**
 * @link              https://guillaume-richard.fr/
 * @since             0.1.0
 * @package           mu-plugins
 *
 * @wordpress-plugin
 * Plugin URI:  https://guillaume-richard.fr/
 * Plugin Name: WP Hide Admin Bar
 * Description: Hides the Admin Bar (Works since WordPress 3.1, until the latest version)
 * Version:     0.1.0
 * Author:      Guillaume RICHARD (credits to Yoast, and Pete Mall)
 * Author URI:  https://guillaume-richard.fr/
 * License:     GNU General Public License v3 or later
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 * Domain Path: /languages
 * WordPress Available:  yes
 * Requires License:    no
 */

// Basic security, prevents file from being loaded directly.
defined( 'ABSPATH' ) or die( 'Cheatin&#8217; uh?' );

// Désactive la barre d'administration de WP
add_action('admin_print_scripts-profile.php', 'hide_admin_bar_prefs');
function hide_admin_bar_prefs() { ?>
    <style type="text/css">
        .show-admin-bar {display: none;}
    </style>
    <?php
}
add_filter('show_admin_bar', '__return_false');