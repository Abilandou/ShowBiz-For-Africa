<?php
/**
 * About Demo import configuration
 * @package Postmagthemes
 * @subpackage queens_magazine_blog
 */

$importconfig = array(
	'menu_name' => esc_html__( 'About Demo import', 'queens-magazine-blog' ),
	'page_name' => esc_html__( 'About Demo import', 'queens-magazine-blog' ),
	// Tabs.
	'tabs' => array(
		
		'recommended_actions' => esc_html__( 'Recommended Actions', 'queens-magazine-blog' ),
		'support'             => esc_html__( 'Upgrade to Pro', 'queens-magazine-blog' ),
		
	),

	// Recommended actions.
	'recommended_actions' => array(
		'content' => array(

			'one-click-demo-ma' => array(
				'title'       => esc_html__( 'One Click Demo Import', 'queens-magazine-blog' ),
				'description' => esc_html__( 'Get the plugin "One Click Demo Import". After activation go to Appearance   >>   Import Demo Data and import it. It will import 7 media files, 10 posts and 7 categories.', 'queens-magazine-blog' ),
				'check'       => class_exists( 'OCDI_Plugin' ),
				'plugin_slug' => 'one-click-demo-import',
				'id'          => 'one-click-demo-import',
				
			),
			
		),
		
	),

	// Support.
	'support_content' => array(
		'first' => array(
			'title'        => esc_html__( 'Contact Support', 'queens-magazine-blog' ),
			'icon'         => 'dashicons dashicons-sos',
			'text'         => esc_html__( 'Contact support@Postmagthemes.com', 'queens-magazine-blog' ),
			'button_label' => esc_html__( 'Contact Support', 'queens-magazine-blog' ),
			'button_link'  => esc_url( '#' ),
			'is_button'    => true,
			'is_new_tab'   => true,
		),
		'second' => array(
			'title'        => esc_html__( 'UPgrade to PRO', 'queens-magazine-blog' ),
			'icon'         => 'dashicons dashicons-book-alt',
			'text'         => esc_html__( 'Check for UPgrade.', 'queens-magazine-blog' ),
			'button_label' => esc_html__( 'Check for UPgrade', 'queens-magazine-blog' ),
			'button_link'  => esc_url( 'https://www.postmagthemes.com/downloads/pro-queens-magazine-blog-wordppress-theme/','queens-magazine-blog' ),
			'is_button'    => true,
			'is_new_tab'   => true,

		),
	),
);
queens_magazine_blog_About::init( apply_filters( 'queens_magazine_blog_about_filter', $importconfig ) );