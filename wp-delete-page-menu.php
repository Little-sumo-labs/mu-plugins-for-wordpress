<?php
/**
 * Plugin Name: WP Remove Menu
 * Description: Deleting page from the WP administration menu
 * Version:     1.0
 * Author:      Guillaume RICHARD
 * Author URI:  https://guillaume-richard.fr/
 */

// Basic security, prevents file from being loaded directly.
defined( 'ABSPATH' ) or die( 'Cheatin&#8217; uh?' );

// Liste des pages qu'il faut enlever du menu
// $pages = ['tools'];
$pages = [];

// Fonction de suppression des pages
function remove_menus() {
    // Ajouter la notion de rôle pour chaques modifications
    global $pages;

    foreach( $pages as $page )
        remove_menu_page($page.'.php');
}
add_filter('admin_menu', 'remove_menus');


// Redirect users to Dashboard based on Admin
foreach( $pages as $page )
    add_action( "load-".$page.".php", 'wpc_block_users' );

function wpc_block_users() {
    wp_redirect(admin_url());
    exit();
}