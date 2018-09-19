<?php
/**
 * eBlog Lite functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package eBlog Lite
 */

if( !function_exists('eblog_lite_file_directory') ){

    function eblog_lite_file_directory( $file_path ){
        if( file_exists( trailingslashit( get_stylesheet_directory() ) . $file_path) ) {
            return trailingslashit( get_stylesheet_directory() ) . $file_path;
        }
        else{
            return trailingslashit( get_template_directory() ) . $file_path;
        }
    }
}
/**
* Customizer
**/
require eblog_lite_file_directory('spiderbuzz/customizer.php');

require eblog_lite_file_directory('spiderbuzz/KCustomizer.php');


/**
* Hooks File
**/
require eblog_lite_file_directory('spiderbuzz/hooks/eblog-hooks.php');

/**
 * Home Page Widget
 */
require eblog_lite_file_directory('spiderbuzz/widgets/sidebar-list.php');
require eblog_lite_file_directory('spiderbuzz/widgets/grid-post-widget.php');
require eblog_lite_file_directory('spiderbuzz/widgets/homepage-slider.php');
require eblog_lite_file_directory('spiderbuzz/widgets/homepage-list.php');


/** 
 * Category Color Functions
 */ 
 require eblog_lite_file_directory('spiderbuzz/category-color/category-color.php');

 /**
 * eBlog Lite About Page
 */ 
require eblog_lite_file_directory('spiderbuzz/admin/class-eblog-lite-admin.php');


/**
 * Demo Import
 */
require eblog_lite_file_directory('spiderbuzz/demo-import/demo-import.php');
