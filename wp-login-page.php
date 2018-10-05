<?php
/**
 * @link              https://guillaume-richard.fr/
 * @since             0.1.0
 * @package           mu-plugins
 *
 * @wordpress-plugin
 * Plugin URI:  https://guillaume-richard.fr/
 * Plugin Name: WP Login Page
 * Description: Remember Me checked & Change the connection error message
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

// the "remember_me" case is checked
function wpc_login_checked_remember_me() {
    add_filter('login_footer', 'wpc_rememberme_checked');
}
add_action('init', 'wpc_login_checked_remember_me');

function wpc_rememberme_checked() {
    echo "<script>document.getElementById('rememberme').checked = true</script>";
}

// change the connection error message
add_filter('login_errors', function($no_login_error) {
    return "Mauvais identifiants";
});