<?php
/**
 * @link              https://guillaume-richard.fr/
 * @since             1.0.0
 * @package           mu-plugins
 *
 * @wordpress-plugin
 * Plugin URI:  https://guillaume-richard.fr/
 * Plugin Name: WP Wpvulndb Widget
 * Description: Add wpvulndb Widget in Admin Dashboard (Plugins vulnerabilities)
 * Version:     1.0.0
 * Author:      Guillaume RICHARD
 * Author URI:  https://guillaume-richard.fr/
 * License:     GNU General Public License v3 or later
 * License URI: http://www.gnu.org/licenses/gpl-3.0.htmlx
 * WordPress Available:  yes
 * Requires License:    no
 */

/**
 * Inspiration :
 * Flux RSS wpvulndb - https://wpvulndb.com/feed.xml
 * https://www.screenfeed.fr/blog/personnaliser-administration-wordpress-0327/
 * https://codex.wordpress.org/Function_Reference/wp_add_dashboard_widget
 */

add_action('wp_dashboard_setup', 'sf_dashboard_widgets');
function sf_dashboard_widgets() {
    if ( current_user_can('update_core') ) {
        wp_add_dashboard_widget('custom_help_widget', 'WPScan Vulnerability Database', 'wpvulndb_widget');
    }
}

function wpvulndb_widget() {
    $data = [];
    $wpvulndb = simplexml_load_file('https://wpvulndb.com/feed.xml');
    foreach ($wpvulndb->entry as $entry) {
        $tmp["title"] = $entry->title;
        $tmp["link"] = $entry->link['href'];
        $tmp["date"] = extract_date($entry->updated);

        $data[] = $tmp;
    }

    $data = orderBy($data, 'date', 'desc');

    foreach ($data as $info) {
        echo $info['date'] . " : <a target='_blank' href=".$info['link'].">".$info['title']."</a><br />";
    }
}

/**
 * @param date $date
 * @return string $dateFr
 */
function extract_date($date) {
    $year   = substr($date,0,4);
    $month  = substr($date,5,2);
    $day    = substr($date,8,2);

    $dateFr = $day."-".$month."-".$year;

    return $dateFr;
}

/**
 * Sorts a collection of arrays or objects by key.
 * @param array $items
 * @param string $attr
 * @param string $order
 * @return array $sortedItems
 */
function orderBy($items, $attr, $order)
{
    $sortedItems = [];
    foreach ($items as $item) {
        $key = is_object($item) ? $item->{$attr} : $item[$attr];
        $sortedItems[$key] = $item;
    }
    if ($order === 'desc') {
        krsort($sortedItems);
    } else {
        ksort($sortedItems);
    }

    return array_values($sortedItems);
}