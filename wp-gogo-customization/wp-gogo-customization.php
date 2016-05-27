<?php

/*
 * Plugin Name: Gogodigital Customization
 * Plugin URI: https://github.com/cinghie/wordpress-gogo-customization
 * Description: Customize your Wordpress site
 * Author: Gogodigital S.r.l.s.
 * Version: 1.0.3
 * Author URI: http://www.gogodigital.it
 */

/**
 * Remove breadcrumbs from the Original Theme
 */
add_filter( 'breadcrumb_trail', '__return_false' );

/**
 * Remove Woocommerce Breadcrumbs from the Original Theme
 */
function remove_woocommerce_breadcrumbcrumbs(){
   remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
}
add_action('init','remove_woocommerce_breadcrumbcrumbs');

/*
 * Add custom js on a Custom Post Type in backend
 */
function add_js_on_custom_post_type_backend()
{
    $post_type = get_post_types();

    if($post_type['MYPOSTYPE'] == "MYPOSTYPE")
    {
        wp_enqueue_script( 'script_search_key_siti', plugin_dir_url( __FILE__ ) . 'wp-gogo-customization/js/MYCUSTOMJS.js' );
    }
}
add_action( 'admin_enqueue_scripts', 'add_js_on_custom_post_type_backend' );

?>
