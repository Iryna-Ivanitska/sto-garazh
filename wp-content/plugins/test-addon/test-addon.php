<?php


/**
 * Plugin Name: Test Addon
 * Description: Custom Elementor addon.
 * Version:     1.0.0
 * Author:      Iryna Ivanytska
 * Text Domain: test-addon
 */

function test_addon() {

    // Load plugin file
    require_once( __DIR__ . '/plugin.php' );

    \Test_Addon\Plugin::instance();

}

add_action( 'plugins_loaded', 'test_addon' );