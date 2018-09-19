<?php

/**
 * Plugin bootstrap file
 *
 * @fancy-facebook-comments
 * Plugin Name:       Fancy Facebook Comments
 * Plugin URI:        https://www.heateor.com/fancy-facebook-comments/#live_demo
 * Description:       Enable Facebook Comments at your website in the easiest possible way
 * Version:           1.1.9
 * Author:            Team Heateor
 * Author URI:        https://www.heateor.com
 * Text Domain:       fancy-facebook-comments
 * Domain Path:       /languages
 */

defined( 'ABSPATH' ) or die( "Cheating........Uh!!" );

// If this file is called directly, halt.
if ( ! defined( 'WPINC' ) ) {
	die;
}

define( 'HEATEOR_FFC_VERSION', '1.1.9' );
define( 'HEATEOR_FFC_PLUGIN_DIR', plugin_dir_path(__FILE__) );

// plugin core class object
$heateor_ffc = null;

/**
 * Save default plugin options
 */
function heateor_ffc_save_default_options() {

	// default options
	add_option( 'heateor_ffc', array(
	   'commenting_label' => 'Facebook Comments',
	   'title_color' => '',
	   'title_font_family' => 'Arial,Helvetica Neue,Helvetica,sans-serif',
	   'heading_tag' => 'h4',
	   'title_font_size' => '',
	   'title_alignment' => 'left',
	   'bg_color' => '',
	   'priority' => 99,
	   'post' => '1',
	   'page' => '1',
	   'bottom' => '1',
	   'url_to_comment' => 'default',
	   'url_to_comment_custom' => '',
	   'comment_width' => '',
	   'comment_numposts' => '',
	   'comment_orderby' => 'social',
	   'comment_lang' => get_locale(),
	   'delete_options' => '1'
	) );

	// plugin version
	add_option( 'heateor_ffc_version', HEATEOR_FFC_VERSION );

}

/**
 * Plugin activation function
 */
function heateor_ffc_activate_plugin( $network_wide ) {

	global $wpdb;

	if ( function_exists( 'is_multisite' ) && is_multisite() ) {
		if ( $network_wide ) {
			$old_blog =  $wpdb->blogid;
			//Get all blog ids
			$blog_ids =  $wpdb->get_col( "SELECT blog_id FROM $wpdb->blogs" );

			foreach ( $blog_ids as $blog_id ) {
				switch_to_blog( $blog_id );
				heateor_ffc_save_default_options();
			}
			switch_to_blog( $old_blog );
			return;
		}
	}
	heateor_ffc_save_default_options();

}
register_activation_hook( __FILE__, 'heateor_ffc_activate_plugin' );

/**
 * Save default options for the new subsite created
 */
function heateor_ffc_new_subsite_default_options( $blog_id, $user_id, $domain, $path, $site_id, $meta ) {

    if ( is_plugin_active_for_network( 'fancy-facebook-comments/fancy-facebook-comments.php' ) ) { 
        switch_to_blog( $blog_id );
        heateor_ffc_save_default_options();
        restore_current_blog();
    }

}
add_action( 'wpmu_new_blog', 'heateor_ffc_new_subsite_default_options', 10, 6 );

/**
 * The core plugin class
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-fancy-facebook-comments.php';

/**
 * Begins execution of the plugin.
 *
 * @since    1.0
 */
function heateor_ffc_run() {

	global $heateor_ffc;
	$heateor_ffc = new Fancy_Facebook_Comments( HEATEOR_FFC_VERSION );

}
heateor_ffc_run();
