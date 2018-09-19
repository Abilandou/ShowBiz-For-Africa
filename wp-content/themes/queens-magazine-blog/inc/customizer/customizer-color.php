<?php
/**
 * queens magazine blog Theme Customizer Color
 *
 * @package Postmagthemes
 * @subpackage queens_magazine_blog
 */


/**
 *  Customizer for color display
 */
function queens_magazine_blog_customize_color( $wp_customize ) {

	/////						Background color			//////

	$wp_customize->add_section( 'queens_magazine_blog_background_color',
		array(
			'title'      => __( 'Background Color', 'queens-magazine-blog' ),
			'priority'   => 50,
		) );

    $wp_customize->add_setting( 'queens_magazine_blog_theme_color', array(
		'default'   => __('#e4b31d', 'queens-magazine-blog'),
		'transport' => 'refresh',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'queens_magazine_blog_themes_color', array(
		'label'     => __( 'Theme color', 'queens-magazine-blog' ),
		'section'   => 'queens_magazine_blog_background_color',
		'settings'  => 'queens_magazine_blog_theme_color',
		'type'		=> 'color',
		) 
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'background_color', array(
		'label'     => __( 'Main background color', 'queens-magazine-blog' ),
		'section'   => 'queens_magazine_blog_background_color',
		'settings'  => 'background_color',
		'type'		=> 'color',
		) 
	) );

		////  					Text Color   					////
	
    $wp_customize->add_setting( 'queens_magazine_blog_theme_color', array(
		'default'   => __('#e4b31d', 'queens-magazine-blog'),
		'transport' => 'refresh',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'queens_magazine_blog_theme_color', array(
		'label'     => __( 'Theme color', 'queens-magazine-blog' ),
		'section'   => 'colors',
		'settings'  => 'queens_magazine_blog_theme_color',
		'type'		=> 'color',
		) 
	) );
	
}
add_action( 'customize_register', 'queens_magazine_blog_customize_color' );
