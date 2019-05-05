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
    $feed = "https://wpvulndb.com/feed.xml";

    read_xml($feed, $msg = "Erreur lors du chargement du flux RSS");

    $wpvulndb = simplexml_load_file($feed);
    foreach ($wpvulndb->entry as $entry) {
        $tmp["id"]      = extract_id($entry->id);
        $tmp["title"]   = $entry->title;
        $tmp["link"]    = $entry->link['href'];
        $tmp["date"]    = extract_date($entry->published);

        $data[] = $tmp;
    }

    $data = orderBy($data, 'id', 'desc');
    $data = limit($data);

    foreach ($data as $info) {
        echo $info['date'] . " : <a target='_blank' href=".$info['link'].">".$info['title']."</a><br />";
    }
}

/**
 * display errors when loading the XML file
 * @param string $feed
 * @param string $msg
 */
function read_xml($feed, $msg) {
    libxml_use_internal_errors(true);
    if (file_get_contents($feed) === false) {
        foreach(libxml_get_errors() as $error) {
            echo "\t", $error->message;
        }
        exit($msg);
    }
}

/**
 * Return the date in the requested format
 * @url https://www.php.net/manual/fr/function.date.php
 * @param $date
 * @param string $output_format
 * @return false|string
 */
function extract_date($date, $output_format = "d-m-Y") {
    [$year, $month, $day, $hour, $minute, $second] = multiexplode(["-","T",":","Z"],$date);
    $output_date = date($output_format, mktime($hour, $minute, $second, $month, $day, $year));

    return $output_date;
}

/**
 * Extract the ID of the URL set as parameter
 * @param string $id
 * @return int $value
 */
function extract_id($id) {
    [$url, $value] = $pieces = explode("/", $id);

    return (int)$value;
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

/**
 * return the first N elements of an array
 * @param array $items
 * @param int $limit
 * @return array $output
 */
function limit($items, $limit = 20) {
    $output = array_slice($items, 0, $limit);

    return $output;
}

/**
 * Splits a string into segments, via multiple delimiters
 * @param array $delimiters
 * @param string $string
 * @return array $launch
 */
function multiexplode($delimiters,$string) {

    $ready = str_replace($delimiters, $delimiters[0], $string);
    $launch = explode($delimiters[0], $ready);
    return $launch;
}