<?php
/*
Plugin Name: wordpress like system  
Plugin URI: wferwe
Description: پست های مرتبط
Version: 1.0.0
Author: moham madhossein aalipor
Author URI: https://automattic.com/wordpress-plugins/
License: GPLv2 or later

*/
defined('ABSPATH') || exit;
define('LS_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('LS_PLUGIN_URL', plugin_dir_url(__FILE__));
// css and js register front:
function wp_ls_register_assets()
{
    //css
    wp_enqueue_style('ls-style', LS_PLUGIN_URL . 'assets/css/front/style.css');
    wp_enqueue_style('ls-toast-style', LS_PLUGIN_URL . 'assets/css/front/jquery.toast.min.css');
    //js
    wp_enqueue_script('ls-main', LS_PLUGIN_URL . 'assets/js/front/main.js', ['jquery'], '1.0.0', true);
    wp_enqueue_script('ls-toast-jquery', LS_PLUGIN_URL . 'assets/js/front/jquery.toast.min.js', ['jquery'], '1.0.0', true);
    wp_enqueue_script('ls-ajax-jquery', LS_PLUGIN_URL . 'assets/js/front/ajax.js', ['jquery'], '1.0.0', true);
    wp_localize_script('ls-ajax-jquery', 'ls_ajax_plugin', [
        'ajaxUrl_ls' => admin_url('admin-ajax.php'),
        '_nonce_ls' => wp_create_nonce(),
        'user_id' => get_current_user_id()
    ]);
}
add_action('wp_enqueue_scripts', 'wp_ls_register_assets');
function ls_admin_register_assets()
{
    //css
    wp_enqueue_style('ls-admin-style', LS_PLUGIN_URL . 'assets/css/admin/style.css');
    //js
    wp_enqueue_script('ls-admin-js', LS_PLUGIN_URL . 'assets/js/admin/admin-js.js', ['jquery'], '1.0.0', true);
}
add_action('admin_enqueue_scripts', 'ls_admin_register_assets');
//include files
include_once LS_PLUGIN_DIR . 'view/front/like-post.php';
include_once LS_PLUGIN_DIR . '_inc/like-post.php';
include_once LS_PLUGIN_DIR . '_inc/unlike-post.php';
include_once LS_PLUGIN_DIR . '_inc/setting/menu.php';
