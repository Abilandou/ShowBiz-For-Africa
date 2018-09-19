<?php
/**
  * One Click Demo Import v2.5.0
 * Available under License: GPLv3 or later
 * Contributors   capuderg, cyman, Prelc
 *
 * @link http://proteusthemes.github.io/one-click-demo-import/
 * @package Postmagthemes
 * @subpackage queens_magazine_blog
 */
// ************** theme setting function for one time DEMO ****************//
function ocdi_import_files() {
	return array(
	  	array(
		'import_file_name'             => 'Demo Import',
		'categories'                   => array( 'Category A' ),
		'import_file_url' 	           => esc_url( 'https://www.postmagthemes.com/download/queensmagazineblog/ocdi/queensmagazinetheme.wordpress.2018-09-14.xml'),
		'import_widget_file_url'	     => esc_url( 'https://www.postmagthemes.com/download/queensmagazineblog/ocdi/postmagthemes.com-demoqeensmagazineblog-widgets.wie'),
		'import_customizer_file_url'	 => esc_url( 'https://www.postmagthemes.com/download/queensmagazineblog/ocdi/queens-magazine-blog-export.dat'),
		'import_redux'	           		 => array( ),
		// 'import_preview_image_url'     => esc_url( 'https://www.postmagthemes.com/download/queensmagazineblog/ocdi/screenshotAocdi.png' ),
		'import_notice'                => __( 'Welcom to download DEMO. This will download 10 new posts, 7 categories and 7 images. Multiple download will not download same post multiple times. It only creates menu and widget multiple time in each download. Hence you are free to do many time download if any gets failed. You will get message ----Thats it, all done!.--- after sucessfull download.  ', 'queens-magazine-blog' ),
		'preview_url'                  => esc_url( 'https://postmagthemes.com/demoqeensmagazineblog/' ),
		),
		
	);
  }
  add_filter( 'pt-ocdi/import_files', 'ocdi_import_files' );

  // ************** default value after import function ****************//
  function ocdi_after_import_setup() {
	  // Assign menus to their locations. Header is menu name created from GU
	  $header_menu = get_term_by( 'name', 'Primary', 'nav_menu' );
	//   $footer_menu = get_term_by( 'name', 'Footer', 'nav_menu' );
	  set_theme_mod( 'nav_menu_locations', array(
			  'menu-1' => $header_menu->term_id,
			//   'primary_footer' => $footer_menu->term_id,
		  )
	  );
	  // Assign front page and posts page (blog page).
	  $front_page_id = get_page_by_title( 'Home' );
	  $blog_page_id  = get_page_by_title( 'Blog' );
	  update_option( 'show_on_front', 'posts' );
	  update_option( 'page_on_front', $front_page_id->ID );
	  update_option( 'page_for_posts', $blog_page_id->ID );
  }
  add_action( 'pt-ocdi/after_import', 'ocdi_after_import_setup' );