<?php
/**
 * garazh functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package garazh
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function garazh_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on garazh, use a find and replace
		* to change 'garazh' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'garazh', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'garazh' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'garazh_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'garazh_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function garazh_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'garazh_content_width', 640 );
}
add_action( 'after_setup_theme', 'garazh_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function garazh_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'garazh' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'garazh' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'garazh_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function garazh_scripts() {

	wp_enqueue_style( 'garazh-animate', get_template_directory_uri() . '/lib/animate/animate.min.css', array(), _S_VERSION );
	wp_enqueue_style( 'garazh-owlcarousel', get_template_directory_uri() . '/lib/owlcarousel/assets/owl.carousel.min.css', array(), _S_VERSION );
	wp_enqueue_style( 'garazh-tempusdominus', get_template_directory_uri() . '/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css', array(), _S_VERSION );
	wp_enqueue_style( 'garazh-bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), _S_VERSION );
	wp_enqueue_style( 'garazh-theme', get_template_directory_uri() . '/css/style.css', ['garazh-bootstrap'], _S_VERSION );
	wp_enqueue_style( 'garazh-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'garazh-style', 'rtl', 'replace' );

	wp_enqueue_script( 'garazh-jquery',  'https://code.jquery.com/jquery-3.4.1.min.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'garazh-bootstrap',  'https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'garazh-wow', get_template_directory_uri() . '/lib/wow/wow.min.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'garazh-easing', get_template_directory_uri() . '/lib/easing/easing.min.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'garazh-waypoints', get_template_directory_uri() . '/lib/waypoints/waypoints.min.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'garazh-counterup', get_template_directory_uri() . '/lib/counterup/counterup.min.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'garazh-owlcarousel', get_template_directory_uri() . '/lib/owlcarousel/owl.carousel.min.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'garazh-moment', get_template_directory_uri() . '/lib/tempusdominus/js/moment.min.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'garazh-moment-timezone', get_template_directory_uri() . '/lib/tempusdominus/js/moment-timezone.min.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'garazh-tempusdominus', get_template_directory_uri() . '/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'garazh-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'garazh-main', get_template_directory_uri() . '/js/main.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'garazh_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

