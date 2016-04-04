<?php

/*
 * Plugin Name: Gogodigital Customization
 * Plugin URI: https://github.com/cinghie/wordpress-gogo-customization
 * Description: Customize your Wordpress site
 * Author: Gogodigital S.r.l.s.
 * Version: 1.0.2
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


?>
