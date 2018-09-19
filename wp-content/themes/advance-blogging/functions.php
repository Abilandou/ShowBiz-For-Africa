<?php
/**
 * Advance Blogging functions and definitions
 *
 * @package Advance Blogging
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */

if ( ! function_exists( 'advance_blogging_setup' ) ) :

/* Theme Setup */
function advance_blogging_setup() {

	$GLOBALS['content_width'] = apply_filters( 'advance_blogging_content_width', 640 );

	load_theme_textdomain( 'advance-blogging', get_template_directory() . '/languages' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'woocommerce' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'custom-logo', array(
		'height'      => 240,
		'width'       => 240,
		'flex-height' => true,
	) );
	add_image_size('advance-blogging-homepage-thumb',240,145,true);
	
       register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'advance-blogging' ),
	) );

	add_theme_support( 'custom-background', array(
		'default-color' => 'ffffff'
	) );

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	 */
	add_editor_style( array( 'css/editor-style.css', advance_blogging_font_url() ) );
}
endif;
add_action( 'after_setup_theme', 'advance_blogging_setup' );

/* Theme Widgets Setup */
function advance_blogging_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Blog Sidebar', 'advance-blogging' ),
		'description'   => __( 'Appears on blog page sidebar', 'advance-blogging' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	
	register_sidebar( array(
		'name'          => __( 'Page Sidebar', 'advance-blogging' ),
		'description'   => __( 'Appears on page sidebar', 'advance-blogging' ),
		'id'            => 'sidebar-2',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Thid Column Sidebar', 'advance-blogging' ),
		'description'   => __( 'Appears on page sidebar', 'advance-blogging' ),
		'id'            => 'sidebar-3',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer Nav 1', 'advance-blogging' ),
		'description'   => __( 'Appears on footer', 'advance-blogging' ),
		'id'            => 'footer-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer Nav 2', 'advance-blogging' ),
		'description'   => __( 'Appears on footer', 'advance-blogging' ),
		'id'            => 'footer-2',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer Nav 3', 'advance-blogging' ),
		'description'   => __( 'Appears on footer', 'advance-blogging' ),
		'id'            => 'footer-3',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer Nav 4', 'advance-blogging' ),
		'description'   => __( 'Appears on footer', 'advance-blogging' ),
		'id'            => 'footer-4',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Home Page Sidebar', 'advance-blogging' ),
		'description'   => __( 'Appears on page sidebar', 'advance-blogging' ),
		'id'            => 'home',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'advance_blogging_widgets_init' );

/* Theme Font URL */
function advance_blogging_font_url(){
	$font_url = '';
	$font_family = array();
	$font_family[] = 'Kavoon';
	$font_family[] = 'Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600';
	$font_family[] = 'Playfair+Display:400,400i,700,700i,900,900i';

	$query_args = array(
		'family'	=> rawurlencode(implode('|',$font_family)),
	);
	$font_url = add_query_arg($query_args,'//fonts.googleapis.com/css');
	return $font_url;
}

/* Theme enqueue scripts */
function advance_blogging_scripts() {
	wp_enqueue_style( 'advance-blogging-font', advance_blogging_font_url(), array() );
	wp_enqueue_style( 'bootstrap', get_template_directory_uri().'/css/bootstrap.css' );	
	wp_style_add_data( 'advance-blogging-style', 'rtl', 'replace' );
	wp_enqueue_style( 'advance-blogging-basic-style', get_stylesheet_uri() );
	wp_enqueue_style( 'font-awesome', get_template_directory_uri().'/css/fontawesome-all.css' );
	wp_enqueue_script( 'advance-blogging-customscripts', get_template_directory_uri() . '/js/custom.js', array('jquery') );
	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.js', array('jquery') );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	/* Enqueue the Dashicons script */
	wp_enqueue_style( 'dashicons' );
	wp_enqueue_style('advance-blogging-ie', get_template_directory_uri().'/css/ie.css');
}
add_action( 'wp_enqueue_scripts', 'advance_blogging_scripts' );

/*Dropdown sanitization*/
function advance_blogging_sanitize_dropdown_pages( $page_id, $setting ) {
  // Ensure $input is an absolute integer.
  $page_id = absint( $page_id );
  // If $page_id is an ID of a published page, return it; otherwise, return the default.
  return ( 'publish' == get_post_status( $page_id ) ? $page_id : $setting->default );
}

/*radio button sanitization*/
function advance_blogging_sanitize_choices( $input, $setting ) {
    global $wp_customize; 
    $control = $wp_customize->get_control( $setting->id ); 
    if ( array_key_exists( $input, $control->choices ) ) {
        return $input;
    } else {
        return $setting->default;
    }
}

/* Excerpt Limit Begin */
function advance_blogging_string_limit_words($string, $word_limit) {
	$words = explode(' ', $string, ($word_limit + 1));
	if(count($words) > $word_limit)
	array_pop($words);
	return implode(' ', $words);
}

// URL DEFINES
define('ADVANCE_BLOGGING_SITE_URL','https://www.themescaliber.com/');

function advance_blogging_credit_link() {
    echo "<a href=".esc_url(ADVANCE_BLOGGING_SITE_URL)." target='_blank'>".esc_html__('ThemesCaliber','advance-blogging')."</a>";
}

/* Custom template tags for this theme. */
require get_template_directory() . '/inc/template-tags.php';

/* Implement the Custom Header feature. */
require get_template_directory() . '/inc/custom-header.php';

/* Customizer additions. */
require get_template_directory() . '/inc/customizer.php';
/* TGM. */
require get_parent_theme_file_path( '/inc/tgm.php' );