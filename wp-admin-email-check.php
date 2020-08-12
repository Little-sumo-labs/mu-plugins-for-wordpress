<?php
/**
 * Plugin Name:     WP admin email check
 * Description:
 * Version:         1.0
 * Author:          Guillaume RICHARD
 * Author URI:      https://guillaume-richard.fr/
 * Documentation:   https://guillaume-richard.fr/
 */

// Basic security, prevents file from being loaded directly.
defined( 'ABSPATH' ) or die( 'Cheatin&#8217; uh?' );

add_filter('admin_email_check_interval', '__return_false');