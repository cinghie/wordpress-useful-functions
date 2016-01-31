<?php

/**
 * @package WP_GOGO_CUSTOMIZATION
 * @version 1.0
 */

/*
Plugin Name: WP Gogo Customization
Plugin URI: http://www.gogodigital.it
Description: Customize your Wordpress site
Author: Gogodigital S.r.l.s.
Version: 1.0.0
Author URI: http://www.gogodigital.it
*/

/**
 * Remove breadcrumbs from the Original Theme
 */
add_filter( 'breadcrumb_trail', '__return_false' );

?>
