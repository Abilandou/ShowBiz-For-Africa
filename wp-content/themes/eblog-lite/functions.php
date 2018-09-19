<?php
/**
 * eBlog Lite functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package eBlog Lite
 */

if ( ! function_exists( 'eblog_lite_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 */
	
	function eblog_lite_setup() {
		/*
		 * Make theme available for translation.
		 */
		load_theme_textdomain( 'eblog', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/**
		 * Add the Defaul Image Size
		 */
		add_image_size( 'eblog-lite-thumbnail-slider', 600, 400, true );

		/*
		 * Let WordPress manage the document title.
		*/
		add_theme_support( 'title-tag' );

		
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'eblog-lite' ),
			'top-bar-menu' => esc_html__( 'Top Bar Menu', 'eblog-lite' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'eblog_lite_custom_background_args', array(
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
add_action( 'after_setup_theme', 'eblog_lite_setup' );


/**
 * Apply theme's stylesheet to the visual editor.
 */
function eblog_lite_add_editor_styles() {
 add_editor_style( get_stylesheet_uri() );
}
add_action( 'after_setup_theme', 'eblog_lite_add_editor_styles' );


/*File are Excerpt */
function eblog_lite_excerpt_length( $length ) {
	if(is_admin()){
		return $length;
	}

    return 50;
}
add_filter( 'excerpt_length', 'eblog_lite_excerpt_length', 999 );


/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 */
function eblog_lite_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'eblog_lite_content_width', 640 );
}
add_action( 'after_setup_theme', 'eblog_lite_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function eblog_lite_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'eblog-lite' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'eblog-lite' ),
		'before_widget' => '<section id="%1$s" class="sidebar widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="sidebar widget-title">',
		'after_title'   => '</h2>',
	) );

	/*Homepage widt sidebar Widget */
	register_sidebar( array(
		'name'          => esc_html__( 'Fullwidth: Homepage', 'eblog-lite' ),
		'id'            => 'fullwidth-home-page-widget',
		'description'   => esc_html__( 'Add the homepag widget.', 'eblog-lite' ),
		'before_widget' => '<section id="%1$s" class="footer footer-widget widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	
	/*Homepage widt sidebar Widget */
	register_sidebar( array(
		'name'          => esc_html__( 'Homepage With Sidebar', 'eblog-lite' ),
		'id'            => 'home-page-widget',
		'description'   => esc_html__( 'Add the homepag widget.', 'eblog-lite' ),
		'before_widget' => '<section id="%1$s" class="footer footer-widget widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	/*Footer Widget */
	register_sidebar( array(
		'name'          => esc_html__( 'Footer: First Widget', 'eblog-lite' ),
		'id'            => 'footer-widget-1',
		'description'   => esc_html__( 'Add widgets here.', 'eblog-lite' ),
		'before_widget' => '<section id="%1$s" class="footer footer-widget widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer: Second Widget', 'eblog-lite' ),
		'id'            => 'footer-widget-2',
		'description'   => esc_html__( 'Add widgets here.', 'eblog-lite' ),
		'before_widget' => '<section id="%1$s" class="footer footer-widget widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer: Third Widget', 'eblog-lite' ),
		'id'            => 'footer-widget-3',
		'description'   => esc_html__( 'Add widgets here.', 'eblog-lite' ),
		'before_widget' => '<section id="%1$s" class="footer footer-widget widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	/*Header Add Section */
	register_sidebar( array(
		'name'          => esc_html__( 'Add: Header Add Widget', 'eblog-lite' ),
		'id'            => 'header-add-widget',
		'description'   => esc_html__( 'Add widgets here.', 'eblog-lite' ),
		'before_widget' => '<section id="%1$s" class="">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );



}
add_action( 'widgets_init', 'eblog_lite_widgets_init' );
/**
 * Enqueue scripts and styles.
 */
function eblog_lite_scripts() {
	
	wp_enqueue_style('bootstrap',get_template_directory_uri().'/assets/css/bootstrap.css');
	wp_enqueue_style('font-awesome',get_template_directory_uri().'/assets/font-awesome/css/font-awesome.css');
	wp_enqueue_style('owl-carousel',get_template_directory_uri().'/assets/library/owl-carousel/css/owl.carousel.css');
	wp_enqueue_style('eblog-lite-custom',get_template_directory_uri().'/assets/css/custom.css');
	
	
	wp_enqueue_style( 'eblog-lite-style', get_stylesheet_uri() );

	wp_enqueue_script( 'owl-carousel', get_template_directory_uri() . '/assets/library/owl-carousel/js/owl.carousel.js', array(), '20151215', true );
	wp_enqueue_script( 'eblog-lite-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );
	wp_enqueue_script( 'jquery-match-Height', get_template_directory_uri() . '/assets/js/jquery.matchHeight.js', array(), '20151215', true );
	wp_enqueue_script( 'eblog-lite-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );
	wp_enqueue_script( 'eblog-lite-js', get_template_directory_uri() . '/assets/js/eblog-lite.js', array('jquery'), '20151215', true );
	
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	$eblog_lite_theme_layout = get_theme_mod('eblog_lite_theme_layout','box-layout');
	if( $eblog_lite_theme_layout == 'box-layout' ){

		$custom_css = "
		/*
		* Border Section
		*/
		/* Desktops and laptops ----------- */
		@media only screen
		and (min-width : 1224px) {
		div#page {
			width:1200px;
		    margin: 0 auto;
		    box-shadow: 0 0 20px rgba(0,0,0,0.3);
		}
		}

		/* iPads (portrait) ----------- */
		@media only screen
		and (min-width : 768px)
		and (max-width : 1024px) {
		div#page {
			margin: 0 auto;
		    box-shadow: 0 0 20px rgba(0,0,0,0.3);
			width:100%;
		}
		}

		/* iPads (portrait) ----------- */
		@media only screen
		and (min-width : 248px)
		and (max-width : 425px) {
		div#page {
			width: 100%;
		} 
	";
	wp_add_inline_style( 'eblog-lite-style', $custom_css );

	}

}
add_action( 'wp_enqueue_scripts', 'eblog_lite_scripts' );



/**
 * Enqueue scripts and styles.
 */
if ( ! function_exists( 'eblog_lite_scripts' ) ) {

	function eblog_lite_scripts() {
		$eblog_lite_theme = wp_get_theme();
		$theme_version = $eblog_lite_theme->get( 'Version' );

		/* Metro Store Bootstrap */
	    wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/assets/css/style.css', esc_attr( $theme_version ) );

	}
}
add_action( 'wp_enqueue_scripts', 'eblog_lite_scripts' );


/***
 * Widgets Color Section
 */
function eblog_lite_dashboard_scripts($hook) {
	if( $hook != 'widgets.php' ) 
		return;

	$custom_css = "
	#widget-list [id*='_eblog_lite_'] .widget-top, #widget-list [id*='_eblog_lite_'] h3 {
		background: #0074a2;
		color: #fff;
	}    
	";
	wp_add_inline_style( 'admin-bar', $custom_css );
	
}
add_action('admin_enqueue_scripts', 'eblog_lite_dashboard_scripts');



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

/**
 * Load init file.
 */
	require get_template_directory() . '/spiderbuzz/init.php';

/**
 * Load class-tgm-plugin-activation file.
 */
require get_template_directory() . '/inc/class-tgm-plugin-activation.php';


/**
 * Filter the except length to 20 words.
 */
function wpdocs_custom_excerpt_length( $length ) {
    return 20;
}
add_filter( 'excerpt_length', 'wpdocs_custom_excerpt_length', 999 );