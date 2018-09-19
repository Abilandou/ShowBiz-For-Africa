<?php

/**
 * Unoblog Lite functions and definitions
 *
 * @link https://www.themebounce.com/themes/unoblog/
 *
 * @package WordPress
 * @subpackage Unoblog Lite
 * @since 1.0
 */

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function unoblog_lite_setup(){
	
	/*
	 * Make theme available for translation.
	 */
	load_theme_textdomain( 'unoblog-lite' );
	
	// Add default posts and comments RSS feed links to head.
	add_theme_support('automatic-feed-links');

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( "title-tag" );

	/* 
	 * Custom Background
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded tags.
	 */
	add_theme_support( "custom-background" );

	/* 
	 * Custom Header
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded tags.
	 */
	add_theme_support( "custom-header" );	

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support('post-thumbnails');
	add_image_size('unoblog-lite-full-thumb', 940, 0, true);
	add_image_size('unoblog-lite-slider-thumb', 650, 440, true);
	add_image_size('unoblog-lite-thumb', 440, 294, true);
	
	// Set the default content width.
	$GLOBALS['content_width'] = 940;

	// Theme wp_nav_menu().
	register_nav_menus( array(
		'main-menu' => __('Primary Menu', 'unoblog-lite' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
		'gallery',
		'audio',
	) );

	// Add theme support for Custom Logo.
	add_theme_support( 'custom-logo', array(
		'width'       => 250,
		'height'      => 250,
		'flex-width'  => true,
	) );

}

add_action('after_setup_theme', 'unoblog_lite_setup');

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
if ( function_exists('register_sidebar') ) {
	register_sidebar(array(
		'id'   => 'sidebar',
		'name' => __( 'Sidebar', 'unoblog-lite' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
	));
	register_sidebar(array(
		'id'   => 'footer1',
		'name' => __( 'Footer 1', 'unoblog-lite' ),
		'before_widget' => '<div id="%1$s" class="widget first %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
	));
	register_sidebar(array(
		'id'   => 'footer2',
		'name' => __( 'Footer 2', 'unoblog-lite' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
	));
	
	register_sidebar(array(
		'id'   => 'footer3',
		'name' => __( 'Footer 3', 'unoblog-lite' ),
		'before_widget' => '<div id="%1$s" class="widget last %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
	));

	
}
if (function_exists('register_sidebar')) {
	function unoblog_lite_widgets_init(){}	
add_action('widgets_init', 'unoblog_lite_widgets_init');
}

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with ... and
 * a 'Continue reading' link.
 *
 * @since Unoblog 1.0
 *
 * @param string $link Link to single post/page.
 * @return &hellip.
 */
function unoblog_lite_excerpt_more( $link ) {
	if ( is_admin() ) {
		return $link;
	}

	$link = sprintf( '<p class="link-more"><a href="%1$s" class="more-link">%2$s</a></p>',
		esc_url( get_permalink( get_the_ID() ) ),
		/* translators: %s: Name of current post */
		sprintf( __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'unoblog-lite' ), get_the_title( get_the_ID() ) )
	);
	return ' &hellip; ' ;
}
add_filter( 'excerpt_more', 'unoblog_lite_excerpt_more' );

/**
 * Register Google fonts.
 */
function unoblog_lite_fonts_url() {
		$fonts_url = '';
		$fonts     = array();
		$subsets   = 'latin,latin-ext';

		if ( 'off' !== _x( 'on', 'Lato: on or off', 'unoblog-lite' ) ) {
			$fonts[] = 'Lato:400,700';
		}	
		if ( 'off' !== _x( 'on', 'Source Sans Pro: on or off', 'unoblog-lite' ) ) {
			$fonts[] = 'Source Sans Pro:400,700';
		}
		if ( 'off' !== _x( 'on', 'Open Sans: on or off', 'unoblog-lite' ) ) {
			$fonts[] = 'Open Sans:700';
		}			

		if ( $fonts ) {
			$fonts_url = add_query_arg( array(
				'family' => urlencode( implode( '|', $fonts ) ),
				'subset' => urlencode( $subsets ),
			), 'https://fonts.googleapis.com/css' );
		}

		return $fonts_url;
	}

/**
 * Enqueue scripts and styles.
 */
function unoblog_lite_load_scripts()
{	
	//Theme stylesheet.
	wp_enqueue_style('unoblog-lite-style', get_stylesheet_directory_uri() . '/style.css');

	wp_enqueue_style('font-awesome', get_template_directory_uri() . '/assets/css/font-awesome.min.css');

	wp_enqueue_style( 'unoblog-lite-fonts', unoblog_lite_fonts_url(), array(), null );
	
	wp_enqueue_script('unoblog-lite-scripts', get_template_directory_uri() . '/assets/js/unoblog.js', array( 'jquery' ));
	wp_enqueue_script('unoblog-lite-slicknav', get_template_directory_uri() . '/assets/js/slicknav.js', array( 'jquery' ));

	if (is_singular() && get_option('thread_comments')) wp_enqueue_script('comment-reply');
}
	add_action('wp_enqueue_scripts', 'unoblog_lite_load_scripts');

/**
 * COMMENTS LAYOUT.
 */
function unoblog_lite_comments($comment, $args, $depth) {
		$GLOBALS['comment'] = $comment;	// WPCS: override ok.
		
		?>
		<li <?php comment_class(); ?> id="comment-<?php comment_ID() ?>">
			
			<div class="thecomment">
						
				<div class="author-img">
					<?php echo get_avatar($comment,$args['avatar_size']); ?>
				</div>
				
				<div class="comment-text">
					<span class="reply">
						<?php comment_reply_link(array_merge( $args, array('reply_text' => __('Reply', 'unoblog-lite'), 'depth' => $depth, 'max_depth' => $args['max_depth'])), $comment->comment_ID); ?>
						<?php edit_comment_link(__('Edit', 'unoblog-lite')); ?>
					</span>
					<span class="author"><?php echo get_comment_author_link(); ?></span>
					<span class="date"><?php printf( esc_html__('%1$s at %2$s', 'unoblog-lite'), get_comment_date(),  get_comment_time()) ?></span>
					<?php if ($comment->comment_approved == '0') : ?>
						<em><i class="icon-info-sign"></i> <?php _e('Comment awaiting approval', 'unoblog-lite'); ?></em>
						<br />
					<?php endif; ?>
					<?php comment_text(); ?>
				</div>
						
			</div>
			
			
		</li>

		<?php 
	}


/**
 * EXCLUDE FEATURED CATEGORY.
 */
function unoblog_lite_category($separator) {
		
		$first_time = 1;
		foreach((get_the_category()) as $category) {
			if ($first_time == 1) {
				echo wp_kses_post('<a href="' . get_category_link( $category->term_id ) . '" title="' . sprintf( esc_html__( "View all posts in %s", "unoblog-lite" ), $category->name ) . '" ' . '>'  . $category->name.'</a>');
				$first_time = 0;
			} else {
				echo wp_kses_post($separator . '<a href="' . get_category_link( $category->term_id ) . '" title="' . sprintf( esc_html__( "View all posts in %s", "unoblog-lite" ), $category->name ) . '" ' . '>' . $category->name.'</a>');
			}
		}
	
}
