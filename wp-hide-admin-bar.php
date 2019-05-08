<?php
/**
 * Plugin Name: WP Hide Admin Bar
 * Description: Hides the Admin Bar (Works since WordPress 3.1, until the latest version)
 * Version:     1.0
 * Author:      Guillaume RICHARD (credits to Yoast, and Pete Mall)
 * Author URI:  https://guillaume-richard.fr/
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