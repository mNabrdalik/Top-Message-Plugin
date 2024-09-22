<?php
/**
 * Plugin Name:      Message on top OOP
 * Description:       An exercise to undestand OOP in php, simple plugin to add customize text on top of pages
 * Version:           0.1.0
 * Requires at least: 6.1
 * Requires PHP:      7.0
 * Author:            MN
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       msg-oop
 */


 //load autolaoder from composer
 require_once __DIR__ . '/vendor/autoload.php';

use PixelPath\TopMessagePlugin\Classes\SimpleMSG;
use PixelPath\TopMessagePlugin\Classes\SettingsPage;

//style init
add_action( 'wp_enqueue_scripts','enqueue_styles');

//enque style function
function enqueue_styles() {
    wp_register_style('top-msg-style', plugins_url('style.css',__FILE__));
    wp_enqueue_style('top-msg-style');
}

//settings page with options
new SettingsPage();

//text content in top of the page
new SimpleMSG(
    get_option('top_msg_content', 'Welcome on our page'), //text content
    get_option('top_msg_bg_color', '#FFFFFF'),  //div background
    get_option('top_msg_text_color', '#000000'), //text color
    get_option('top_msg_visible', 'false'), //is visible on frontend?
);
