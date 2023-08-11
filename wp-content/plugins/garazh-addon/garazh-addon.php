<?php

/**
 * Plugin Name: Garazh Addon
 * Description: Custom Elementor addon.
 * Version:     1.0.0
 * Author:      Iryna Ivanytska
 * Text Domain: garazh
 */

function garazh_addon() {

    // Load plugin file
    require_once( __DIR__ . '/plugin.php' );

   \Garazh_Addon\Plugin::instance();

}

add_action( 'plugins_loaded', 'garazh_addon' );