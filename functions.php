<?php
/**
 * kaneko functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package kaneko
 */

if ( ! function_exists( 'kaneko_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function kaneko_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on kaneko, use a find and replace
	 * to change 'kaneko' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'kaneko', get_template_directory() . '/languages' );

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
	add_image_size('large-thumb', 1060, 650, true);
	add_image_size('index-thumb', 900, 250, true);

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'kaneko' ),
		'social' => esc_html__( 'Social Menu', 'kaneko'),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'kaneko_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // kaneko_setup
add_action( 'after_setup_theme', 'kaneko_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function kaneko_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'kaneko_content_width', 640 );
}
add_action( 'after_setup_theme', 'kaneko_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function kaneko_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'kaneko' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

		register_sidebar( array(
		'name'          => esc_html__( 'Footer Widgets', 'kaneko' ),
		'id'            => 'footer-area',
		'description'   => 'Zone du footer',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'kaneko_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function kaneko_scripts() {

	        // Get the current layout setting (sidebar left or right)
        $kaneko_layout = get_option( 'layout_setting' );
        if ( is_page_template( 'full-width-page.php' ) || ! is_active_sidebar( 'sidebar-1' ) ) {
            $layout_stylesheet = '/layouts/full.css';
        } elseif ( 'left-sidebar' == $kaneko_layout ) {
            $layout_stylesheet =  '/layouts/sidebar-content.css';
        } else {
            $layout_stylesheet = '/layouts/content-sidebar.css';
        }
	
	wp_enqueue_style ( 'kaneko-style', get_stylesheet_uri() );

	wp_enqueue_style ( 'kaneko-layout' , get_template_directory_uri() . $layout_stylesheet );

	wp_enqueue_style ( 'kaneko-google-fonts', 'http://fonts.googleapis.com/css?family=Roboto:400,300,500,700' );
                    
	wp_enqueue_style ( 'kaneko_fontawesome', 'http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css' );

	wp_enqueue_script ( 'kaneko-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script ( 'kaneko-hide-search', get_template_directory_uri() . '/js/hide-search.js', array(), '20150101', true );

	wp_enqueue_script( 'kaneko-masonry', get_template_directory_uri() . '/js/masonry-settings.js', array('masonry'), '20150101', true );

	wp_enqueue_script ( 'kaneko-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'kaneko_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';
