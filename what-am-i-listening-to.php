<?php
/**
 * What Am I Listening To?
 *
 * @package           What Am I Listening To?
 * @author            Umuthan Uyan
 * @copyright         2019
 * @license           GPL-3.0-or-later
 *
 * @wordpress-plugin
 * Plugin Name:       What Am I Listening To?
 * Plugin URI:        https://wordpress.org/plugins/what-am-i-listening-to/
 * Description:       Last.fm scrobbler web service to get what are you listening to
 * Version:           1.0.0
 * Requires at least: 4.0
 * Requires PHP:      5.0
 * Author:            Umuthan Uyan
 * Author URI:        http://umuthan.com
 * Text Domain:       what-am-i-listening-to
 * License:           GPL v3 or later
 * License URI:       http://www.gnu.org/licenses/gpl-3.0.txt
 */

$lastFMApiKey = esc_attr( get_option('wailt_lastfm_api_key') );
$lastFMUserName = esc_attr( get_option('wailt_lastfm_user_name') );

$jsonAddress = 'https://ws.audioscrobbler.com/2.0/?method=user.getrecenttracks&user='.$lastFMUserName.'&format=json&api_key='.$lastFMApiKey;

include('includes/functions.php');
include('includes/shortcode.php');
include('includes/settings_page.php');

/**
 * Add css to frontend
 */
add_action('wp_enqueue_scripts', 'wailt_callback_for_setting_up_script');
function wailt_callback_for_setting_up_script() {
  wp_register_style( 'what-am-listening-to-css', plugin_dir_url( __FILE__ ).'css/style.css' );
  wp_enqueue_style( 'what-am-listening-to-css' );
}
