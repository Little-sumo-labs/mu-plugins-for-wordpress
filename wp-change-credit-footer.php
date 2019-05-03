<?php
/**
 * @link              https://guillaume-richard.fr/
 * @since             1.0.0
 * @package           mu-plugins
 *
 * @wordpress-plugin
 * Plugin URI:  https://guillaume-richard.fr/
 * Plugin Name: WP Change Credits Footer
 * Description: Change the basic credits footer for another one
 * Version:     1.0.0
 * Author:      Guillaume RICHARD
 * Author URI:  https://guillaume-richard.fr/
 * License:     GNU General Public License v3 or later
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 * WordPress Available:  yes
 * Requires License:    no
 */

// Basic security, prevents file from being loaded directly.
defined( 'ABSPATH' ) or die( 'Cheatin&#8217; uh?' );

// Change the credits footer
function wpc_remove_footer_admin() {
    return 'Réalisation par <a href="https://guillaume-richard.fr/">Guillaume RICHARD</a>. 2018 - '.date('Y');
}
add_filter('admin_footer_text', 'wpc_remove_footer_admin');