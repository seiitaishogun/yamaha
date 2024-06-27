<?php
/*
Plugin Name: Favorites
Plugin URI: http://shino.vn
Description: Simple and flexible favorite buttons for any post type.
Version: 2.3.3
Author: SHUT
Author URI: https://github.com/
Text Domain: favorites
Domain Path: /languages/
License: GPLv2 or later.
Copyright: SHUT
*/

/*  Copyright 2021 SHUT */

/**
* Check Wordpress and PHP versions before instantiating plugin
*/
register_activation_hook( __FILE__, 'favorites_check_versions' );

define( 'FAVORITES_PLUGIN_FILE', __FILE__ );

function favorites_check_versions( $wp = '3.9', $php = '5.6' ) {
    global $wp_version;
    if ( version_compare( PHP_VERSION, $php, '<' ) ) $flag = 'PHP';
    elseif ( version_compare( $wp_version, $wp, '<' ) ) $flag = 'WordPress';
    else return;
    $version = 'PHP' == $flag ? $php : $wp;
    
    if (function_exists('deactivate_plugins')){
        deactivate_plugins( basename( __FILE__ ) );
    }
    
    wp_die('<p>The <strong>Favorites</strong> plugin requires'.$flag.'  version '.$version.' or greater.</p>','Plugin Activation Error',  array( 'response'=>200, 'back_link'=>TRUE ) );
}

if( !class_exists('Bootstrap') ) :
    favorites_check_versions();
    require_once(__DIR__ . '/vendor/autoload.php');
    require_once(__DIR__ . '/app/Favorites.php');
    require_once(__DIR__ . '/app/API/functions.php');
    Favorites::init();
endif;