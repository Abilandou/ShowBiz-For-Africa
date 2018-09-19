<?php 
/**
 * Register widget area.
 
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar 
 * 
 * @package Postmagthemes
 * @subpackage queens_magazine_blog
 */
function queens_magazine_blog_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Right Sidebar', 'queens-magazine-blog' ),
		'id'            => 'sidebar-one',
		'description'   => esc_html__( 'Recommended for Most commented widget.', 'queens-magazine-blog' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Left Sidebar', 'queens-magazine-blog' ),
		'id'            => 'sidebar-two',
		'description'   => esc_html__( 'Recommended for in built widget.', 'queens-magazine-blog' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Primary bar', 'queens-magazine-blog' ),
		'id'            => 'sidebar-three',
		'description'   => esc_html__( 'Recommended for Most recent widget.', 'queens-magazine-blog' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Secondary bar', 'queens-magazine-blog' ),
		'id'            => 'sidebar-four',
		'description'   => esc_html__( 'Recommended for Recently update widget.', 'queens-magazine-blog' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s mb-5 mt-5 central-background ">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Sidebar one', 'queens-magazine-blog' ),
		'id'            => 'sidebar-five',
		'description'   => esc_html__( 'Add widgets here.', 'queens-magazine-blog' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Sidebar two', 'queens-magazine-blog' ),
		'id'            => 'sidebar-six',
		'description'   => esc_html__( 'Add widgets here.', 'queens-magazine-blog' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Sidebar three', 'queens-magazine-blog' ),
		'id'            => 'sidebar-seven',
		'description'   => esc_html__( 'Add widgets here.', 'queens-magazine-blog' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'queens_magazine_blog_widgets_init' );