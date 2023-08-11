<?php
namespace Test_Addon;

final class Plugin {

    private static $_instance = null;

    const MINIMUM_ELEMENTOR_VERSION = '3.2.0';
    const MINIMUM_PHP_VERSION = '7.0';

    public static function instance() {
        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function __construct() {
        if ( $this->is_compatible() ) {
            add_action( 'elementor/init', [ $this, 'init' ] );
        }
    }

    public function is_compatible() {

        // Check if Elementor is installed and activated
        if ( ! did_action( 'elementor/loaded' ) ) {
            add_action( 'admin_notices', [ $this, 'admin_notice_missing_main_plugin' ] );
            return false;
        }

        // Check for required Elementor version
        if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
            add_action( 'admin_notices', [ $this, 'admin_notice_minimum_elementor_version' ] );
            return false;
        }

        // Check for required PHP version
        if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
            add_action( 'admin_notices', [ $this, 'admin_notice_minimum_php_version' ] );
            return false;
        }

        return true;

    }
    public function init() {
        add_action( 'elementor/frontend/after_enqueue_styles', [ $this, 'frontend_styles' ] );
        add_action( 'elementor/frontend/after_register_scripts', [ $this, 'frontend_scripts' ] );

        add_action( 'elementor/widgets/register', [ $this, 'register_widgets' ] );
        add_action( 'elementor/elements/categories_registered', [ $this, 'add_elementor_widget_categories' ] );

    }

    public function frontend_styles() {

        wp_register_style( 'bootstrap-css', 'https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css' );
        wp_register_style( 'hero-heading-css', plugins_url( 'assets/css/hero-heading.css', __FILE__ ) );
        wp_register_style( 'global-css', plugins_url( 'assets/css/global.css', __FILE__ ) );

        wp_enqueue_style( 'bootstrap-css' );
        wp_enqueue_style( 'global-css' );

    }

    public function frontend_scripts() {

        wp_register_script( 'hero-heading-js', plugins_url( 'assets/js/hero-heading.js', __FILE__ ) );

        wp_enqueue_script( 'hero-heading-js' );


    }

    public function admin_notice_missing_main_plugin() {

        if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

        $message = sprintf(
        /* translators: 1: Plugin name 2: Elementor */
            esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'elementor-test-addon' ),
            '<strong>' . esc_html__( 'Elementor Test Addon', 'elementor-test-addon' ) . '</strong>',
            '<strong>' . esc_html__( 'Elementor', 'elementor-test-addon' ) . '</strong>'
        );

        printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

    }

    public function admin_notice_minimum_elementor_version() {

        if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

        $message = sprintf(
        /* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
            esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'elementor-test-addon' ),
            '<strong>' . esc_html__( 'Elementor Test Addon', 'elementor-test-addon' ) . '</strong>',
            '<strong>' . esc_html__( 'Elementor', 'elementor-test-addon' ) . '</strong>',
            self::MINIMUM_ELEMENTOR_VERSION
        );

        printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

    }

    public function admin_notice_minimum_php_version() {

        if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

        $message = sprintf(
        /* translators: 1: Plugin name 2: PHP 3: Required PHP version */
            esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'elementor-test-addon' ),
            '<strong>' . esc_html__( 'Elementor Test Addon', 'elementor-test-addon' ) . '</strong>',
            '<strong>' . esc_html__( 'PHP', 'elementor-test-addon' ) . '</strong>',
            self::MINIMUM_PHP_VERSION
        );

        printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

    }

    public function register_widgets( $widgets_manager ) {

        require_once( __DIR__ . '/widgets/hero-heading.php' );

        $widgets_manager->register( new \HeroHeading() );

    }

    function add_elementor_widget_categories( $elements_manager ) {

//        $elements_manager->add_category(
//            'test_addon',
//            [
//                'title' => esc_html__( 'Test Addon', 'test-addon' ),
//                'icon' => 'fa fa-plug',
//            ]
//        );
        $categories = [];
        $categories['test_addon'] =
            [
                'title' => esc_html__( 'Test Addon', 'test-addon' ),
                'icon'  => 'fa fa-plug'
            ];

        $old_categories = $elements_manager->get_categories();
        $categories = array_merge($categories, $old_categories);

        $set_categories = function ( $categories ) {
            $this->categories = $categories;
        };

        $set_categories->call( $elements_manager, $categories );
    }

}