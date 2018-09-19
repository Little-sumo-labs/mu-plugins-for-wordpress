<?php
/**
 * @link              https://guillaume-richard.fr/
 * @since             0.1.0
 * @package           mu-plugins
 *
 * @wordpress-plugin
 * Plugin URI:  https://guillaume-richard.fr/
 * Plugin Name: WP Secure API
 * Description: Disable or lock the WordPress REST API and XML RPC
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

// Page d'inspiration : // http://www.geekpress.fr/desactiver-rest-api-xml-rpc-wordpress/

// laisse l'API activée, mais verrouille l'accès pour les personnes non connecté
function secure_api( $result ) {
    if ( ! empty( $result ) ) {
        return $result;
    }
    if ( ! is_user_logged_in() || current_user_can('edit_posts')) {
        return new WP_Error( 'rest_not_logged_in', 'You are not currently logged in.', array( 'status' => 401 ) );
    }
    return $result;
}

add_filter('rest_authentication_errors', 'secure_api');

// DESACTIVER Le XML RPC
add_filter( 'xmlrpc_enabled', '__return_false' );
remove_action( 'wp_head', 'rsd_link' );