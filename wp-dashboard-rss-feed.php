<?php
/**
 * Plugin Name: WP Dashboard RSS Feed
 * Description: Add Widget in Admin Dashboard
 * Version:     1.0
 * Author:      Guillaume RICHARD
 * Author URI:  https://guillaume-richard.fr/
 */

/**
 * Inspiration :
 * Flux RSS wpmarmite - https://feedpress.me/wpmarmite
 * https://codex.wordpress.org/Function_Reference/wp_add_dashboard_widget
 */

add_action('wp_dashboard_setup', 'sf_dashboard_widgets');
function sf_dashboard_widgets() {
    if ( current_user_can('update_core') ) {
        wp_add_dashboard_widget('custom_help_widget', 'Flux RSS WPMarmite', 'rss_feed_widget');
    }
}

function rss_feed_widget() {
    $data       = [];
    $feed       = "https://feedpress.me/wpmarmite";
    $error_msg  = "Erreur lors du chargement du flux RSS";

    $html_error = isError($feed);
    if (200 !== $html_error) {
        echo "<p>Affichage impossible : retour d'erreur $html_error</p>";
        return;
    }

    if (read_xml($feed) === true) {
        $flux = simplexml_load_file($feed);

        foreach ($flux->channel->item as $item) {
            $tmp["title"]   = $item->title;
            $tmp["link"]    = extract_link($item->link);
            $tmp["date"]    = extract_date($item->pubDate, "d/m/Y");

            $data[] = $tmp;
        }

        $data = limit($data);

        foreach ($data as $info) {
            echo $info['date'] . " : <a target='_blank' href=".$info['link'].">".$info['title']."</a><br />";
        }
    }
}

/**
 * @param string $url
 * @return int
 */
function isError(string $url):int {
    $headers = get_headers($url);
    return (int)substr($headers[0], 9, 3);
}

/**
 * display errors when loading the XML file
 * @param string $feed
 * @return bool
 */
function read_xml($feed) {
    libxml_use_internal_errors(true);
    $rssfeed = file_get_contents($feed, true);

    if ($rssfeed !== false) { return true; }

    foreach(libxml_get_errors() as $error) {
        echo "\t", $error->message;
    }
    return false;
}

/**
 * Return the date in the requested format
 * @url https://www.php.net/manual/fr/function.date.php
 * @param $date
 * @param string $output_format
 * @return false|string
 */
function extract_date($date, $output_format = "d-m-Y") {
    $arr = array(1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr', 5 => 'May', 6 => 'Jun', 7 => 'Jul', 8 => 'Aug', 9 => 'Sep', 10 => 'Oct', 11 => 'Nov', 12 => 'Dec');
    [$week, $day, $month, $year, $hour, $minute, $second] = multiexplode([" ", ":"],$date);

    if (in_array($month, $arr))
        $month = array_search($month, $arr);

    return date($output_format, mktime($hour, $minute, $second, $month, $day, $year));
}

/**
 * Extract the URL set as parameter
 * @param $link
 * @return int
 */
function extract_link($link) {
    $pos = strpos($link, "?");
    return substr($link, 0, $pos);
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
    return array_slice($items, 0, $limit);
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