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

?>
