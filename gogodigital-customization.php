<?php

/*
 * Plugin Name: Gogodigital Customization
 * Plugin URI: https://github.com/cinghie/wordpress-gogo-customization
 * Description: Simple Customization plugin for a Wordpress site
 * Author: Gogodigital S.r.l.s.
 * Author URI: http://www.gogodigital.it
 * Version: 1.0.10
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
        wp_enqueue_script( 'script_search_key_siti', plugin_dir_url( __FILE__ ) . 'js/MYCUSTOMJS.js' );
    }
}

add_action( 'admin_enqueue_scripts', 'add_js_on_custom_post_type_backend' );

/*
 * Remove "Category:" from Archive Title
 */
add_filter( 'get_the_archive_title', function ($title) {
	if ( is_category() ) {
		$title = single_cat_title( '', false );
	} elseif ( is_tag() ) {
		$title = single_tag_title( '', false );
	} elseif ( is_author() ) {
		$title = '<span class="vcard">' . get_the_author() . '</span>' ;
	}
	return $title;
});

/**
 * Filter the except length to 100 characters.
 *
 * @param $length
 *
 * @return int
 */
function wpdocs_custom_excerpt_length($length)
{
	if(is_home() || is_front_page()) {
		return 25;
	}

	return 100;
}

add_filter( 'excerpt_length', 'wpdocs_custom_excerpt_length', 999 );

/**
 * Get the first image in post_content.
 */
function catch_that_image()
{
    global $post, $posts;
    $first_img = '';
    ob_start();
    ob_end_clean();
    $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
    $first_img = $matches [1] [0];

	//Defines a default image
    if(empty($first_img)){
        $first_img = '/images/default.jpg';
    }
	
    return $first_img;
}

/**
 * Ensure that a specific theme is never updated. This works by removing the
 * theme from the list of available updates.
 */
add_filter( 'http_request_args', function ( $response, $url ) {
	if ( 0 === strpos( $url, 'https://api.wordpress.org/themes/update-check' ) ) {
		$themes = json_decode( $response['body']['themes'] );
		unset( $themes->themes->{get_option( 'template' )} );
		unset( $themes->themes->{get_option( 'stylesheet' )} );
		$response['body']['themes'] = json_encode( $themes );
	}
	return $response;
}, 10, 2 );

/**
 * Redirect to custom url on failed login attempt
 *
 * @param $username
 */
function front_end_login_fail($username)
{
    $referrer = $_SERVER['HTTP_REFERER'];  // where did the post submission come from?

    // if there's a valid referrer, and it's not the default log-in screen
    if ( !empty($referrer) && !strstr($referrer,'wp-login') && !strstr($referrer,'wp-admin') )
    {
        $pos = strpos($referrer, '?login=failed');

        if($pos === false) {
            // add the failed
            wp_redirect( $referrer . '?login=failed' );  // let's append some     information (login=failed) to the URL for the theme to use
        } else {
            // already has the failed don't appened it again
            wp_redirect( $referrer );  // already appeneded redirect back
        }

        exit;
    }
}

add_action( 'wp_login_failed', 'front_end_login_fail' );

/**
 * Prevent update notification for plugin
 * http://www.thecreativedev.com/disable-updates-for-specific-plugin-in-wordpress/
 * Place in theme functions.php or at bottom of wp-config.php
 *
 * @param $value
 *
 * @return mixed
 */
function disable_plugin_updates($value)
{
    if (isset($value) && is_object($value))
    {
		if(isset( $value->response['plugin-folder/plugin.php'] ) )
		{
            unset( $value->response['plugin-folder/plugin.php'] );
		}
    }
	
    return $value;
}

add_filter( 'site_transient_update_plugins', 'disable_plugin_updates' );

/**
 * Disable Yoast SEO on Custom Post Type
 */
function my_remove_wp_seo_meta_box() {
	remove_meta_box('wpseo_meta', YOUR_POST_TYPE_NAME_HERE, 'normal');
}

add_action('add_meta_boxes', 'my_remove_wp_seo_meta_box', 100);

