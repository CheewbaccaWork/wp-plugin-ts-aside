<?php 
/**
 * Plugin Name: Tradesmarter aside
 * Description: Display aside using shortcode to insert in a page 
 * Version: 2.1.0
 * Text Domain: github-updater
 * GitHub Plugin URI: https://github.com/CheewbaccaWork/wp-plugin-ts-aside
 * GitHub Branch: main
 */

require_once __DIR__ . '/AsideClass.php';
require_once __DIR__ . '/TopPanelClass.php';
require_once __DIR__ . '/GeneralClass.php';
require_once __DIR__ . '/FaqClass.php';

register_activation_hook( __FILE__, array('AsideClass', 'install'));
register_activation_hook( __FILE__, array('TopPanelClass', 'install'));
register_activation_hook( __FILE__, array('FaqClass', 'install'));
register_uninstall_hook( __FILE__, array('GeneralClass', 'uninstall'));
register_activation_hook( __FILE__, array('GeneralClass', 'install'));

function remove_admin_login_header() {
    remove_action('wp_head', '_admin_bar_bump_cb');
}

add_action('get_header', 'remove_admin_login_header');

$hook = add_action('admin_menu', array('GeneralClass', 'addMenuItem'));
$hook_aside = add_action('admin_menu', array('AsideClass', 'addMenuItem'));
$hook_top_panel = add_action('admin_menu', array('TopPanelClass', 'addMenuItem'));
$hook_faq = add_action('admin_menu', array('FaqClass', 'addMenuItem'));

add_action( "load-$hook", [ 'GeneralClass', 'screen_option' ] );
add_action( "load-$hook_aside", [ 'AsideClass', 'screen_option' ] );    
add_action( "load-$hook_top_panel", [ 'TopPanelClass', 'screen_option' ] );
add_action( "load-$hook_faq", [ 'FaqClass', 'screen_option' ] );

function enqueue_style() {
    wp_enqueue_style(
        'aside-page-styles',
        plugin_dir_url( __FILE__ ) . '/public/main.css',
        array(),
        get_stylesheet_directory(plugin_dir_url( __FILE__ ) . '/public/main.css'),
        false
    );
}

function enqueue_scripts() {
    wp_enqueue_script( 'aside_js', plugins_url( 'public/aside.js', __FILE__ ));
}

add_action( 'wp_enqueue_scripts', 'enqueue_style' );

add_action('wp_enqueue_scripts', 'enqueue_scripts');

add_action( 'admin_enqueue_scripts', 'image_js' );
 
function image_js() {
  
	if ( ! did_action( 'wp_enqueue_media' ) ) {
		wp_enqueue_media();
	}
 
     wp_enqueue_script( 'image_scripts', plugins_url( 'admin/image.js', __FILE__ ), array( 'jquery' ) );
     wp_enqueue_script( 'admin-scripts', plugins_url( 'admin/admin.js', __FILE__ ), array( 'jquery' ) );

     wp_enqueue_style( 
        'aside-admin-styles',
        plugin_dir_url( __FILE__ ) . '/admin/aside-admin.css',
        array(),
        get_stylesheet_directory(plugin_dir_url( __FILE__ ) . '/admin/aside-admin.css'),
        false
    );
}

function create_plugin_menu() {
    register_nav_menu('aside', 'Aside Menu' );
}

function add_admin_iris_scripts( $hook ){
	wp_enqueue_script( 'wp-color-picker' );
	wp_enqueue_style( 'wp-color-picker' );

	wp_enqueue_script('color-picker', plugins_url('admin/colors.js', __FILE__), array('wp-color-picker'), false, 1 );
}

add_action( 'admin_enqueue_scripts', 'add_admin_iris_scripts' );

add_shortcode( 'aside', array( 'GeneralClass', 'shortcodeHandler' ) );

