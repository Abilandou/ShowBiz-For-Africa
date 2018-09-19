<?php
/**
 * queens magazine blog functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Postmagthemes
 * @subpackage queens_magazine_blog
 */


if ( ! function_exists( 'queens_magazine_blog_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function queens_magazine_blog_setup() {
		
		/*
		 * Make theme available for translation.
		 *
		 * If you're building a theme based on Queens Magazine blog, use a find and replace
		 * to change 'queens-magazine-blog' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'queens-magazine-blog' );

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
		add_image_size('queens-magazine-blog-post-thumbnail-square', 600, 600, array( 'center','top'));
		add_image_size('queens-magazine-blog-post-thumbnail', 640, 427, array( 'center','top'));

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'queens-magazine-blog' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'queens_magazine_blog_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'queens_magazine_blog_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function queens_magazine_blog_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'queens_magazine_blog_content_width', 640 );
}
add_action( 'after_setup_theme', 'queens_magazine_blog_content_width', 0 );

/**
 * Enqueue scripts and styles.
 */
function queens_magazine_blog_scripts() {
	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.js', array( 'jquery' ), '4.1.0', true );
	wp_enqueue_script( 'wowscript', get_template_directory_uri() . '/js/wow/wow.js', array( 'jquery'), '2018', true );
	wp_enqueue_script( 'queens-magazine-blog-navigation', get_template_directory_uri() . '/js/navigation.js', array( 'jquery'), '20151215', true );
	wp_enqueue_script( 'queens-magazine-blog-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array( 'jquery'), '20151215', true );
	wp_enqueue_script('EQCSS', get_template_directory_uri() . '/js/EQCSS.js', array('jquery'), '1.0.0' , true);

	wp_enqueue_style('queens-magazine-blog-webfonts', '//fonts.googleapis.com/css?family=Aclonica|Anton|Oswald', array(), NULL);

	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/fontawesome/css/font-awesome.css', array(), '4.7.0.', 'all' );
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.css', array(), '4.2.0', 'all' );
	wp_enqueue_style( 'wow', get_template_directory_uri() . '/css/wow/animate.css', array(), '3.0.0', 'all' );
	wp_enqueue_style( 'queens-magazine-blog-style', get_stylesheet_uri() );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'queens_magazine_blog_scripts' );

/**
 * Configure for max number of Tag display
 */
add_filter('term_links-post_tag','queens_magazine_blog_limit_to_five_tags');
function queens_magazine_blog_limit_to_five_tags($terms) {
return array_slice($terms,0,3,true);
}

/**
 * Add View Demo on menu Appearene
 */

function queens_magazine_blog_theme_settings(){
	require_once( trailingslashit( get_template_directory() ). '/inc/about.php' );
}
function queens_magazine_blog_theme_settings_pro(){
	require_once( trailingslashit( get_template_directory() ). '/inc/buypro.php' );
}
function queens_magazine_blog_menu_add() {
	add_theme_page(__('Title queens magazine blog','queens-magazine-blog'), __('Important Notes','queens-magazine-blog'), 'edit_theme_options', 'scratch-identifier-1', 'queens_magazine_blog_theme_settings');
	add_theme_page(__('Title queens magazine blog pro','queens-magazine-blog'), __('Buy Pro','queens-magazine-blog'), 'edit_theme_options', 'scratch-identifier-2', 'queens_magazine_blog_theme_settings_pro');
}
add_action('admin_menu', 'queens_magazine_blog_menu_add');
/**
 * Implement the Custom Header feature.
 */
require_once( trailingslashit( get_template_directory() ). '/inc/custom-header.php' );

/**
 * Custom template tags for this theme.
 */
require_once( trailingslashit( get_template_directory() ). '/inc/template-tags.php' );

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require_once( trailingslashit( get_template_directory() ). '/inc/template-functions.php' );

/**
 * Customizer additions.
 */
require_once( trailingslashit( get_template_directory() ). '/inc/customizer/customizer.php') ;

/**
 * Customizer-color additions.
 */
require_once( trailingslashit(  get_template_directory() ). '/inc/customizer/customizer-color.php' );


/**
 * Customizer-CSS additions.
 */
require_once( trailingslashit( get_template_directory() ) . '/inc/css/css-customize.php' );

/**
 * Color-Luminance additions.
 */
require_once( trailingslashit( get_template_directory() ). '/inc/css/color-luminance.php' );

/**
 *  Extra function.
 */
require_once( trailingslashit( get_template_directory() ) . 'inc/other-functions/customize-function.php' );

/**
 *  register-widgets.
 */
require_once( trailingslashit( get_template_directory() ) . 'inc/widgets/register-widgets-sidebar.php' );

/**
 *  load sanitize.
 */
require_once( trailingslashit( get_template_directory() ) . 'inc/sanitize.php' );

/**
 *  OCDI.
 */
require_once( trailingslashit( get_template_directory() ) . 'inc/ocdi/ocdi.php' );
require_once( trailingslashit( get_template_directory() ) . 'inc/ocdi/class-import.php' );
require_once( trailingslashit( get_template_directory() ) . 'inc/ocdi/import.php' );