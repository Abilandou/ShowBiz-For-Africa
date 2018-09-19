<?php
/**
 * queens magazine blog Theme Customizer Other
 *
 * @package queens_magazine_blog
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function queens_magazine_blog_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'queens_magazine_blog_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'queens_magazine_blog_customize_partial_blogdescription',
		) );
	}
}
add_action( 'customize_register', 'queens_magazine_blog_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function queens_magazine_blog_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function queens_magazine_blog_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function queens_magazine_blog_customize_preview_js() {
	wp_enqueue_script( 'queens-magazine-blog-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'queens_magazine_blog_customize_preview_js' );

/**
 *  Customizer for post date, comments, tag , etc display
 */
function queens_magazine_blog_customize_other( $wp_customize ) {
	/////DEAFULT SITE IDENTITY ADDED CONTROL STARTS//////
		// first control
		$wp_customize->add_setting( 'title_date_display', 
			array(
				'default'     => 1,
				'sanitize_callback' => 'queens_magazine_blog_sanitize_radio'
			) 
		);
				
		$wp_customize->add_control( 'title_date_display', 
			array(
				'label' 	=> __( 'Title Date Display', 'queens-magazine-blog' ),
				'section'	=> 'title_tagline',
				'settings' 	=> 'title_date_display',
				'type' 		=> 'radio',
				'choices' 	=> 
					array(
						'1' => __( 'Show Date', 'queens-magazine-blog' ),
						'2'	=> __( 'Hide Date', 'queens-magazine-blog' ),
					),
			) 
		);
		// THEME OPTION panel
		$wp_customize->add_panel( 'queens_magazine_blog_theme_option_panel', array(
			'priority'	=> 21,
			'title'		=> __( 'Theme options', 'queens-magazine-blog' )
		) );

		
		// 'Most commented section'
		$wp_customize->add_section( 'queens_magazine_blog_most_commented_section',
		array(
			'title'      => __( 'Most commented section', 'queens-magazine-blog' ),
			'priority'   => 20,
			'panel'		=> 'queens_magazine_blog_theme_option_panel'
		) );

		$wp_customize->add_setting( 'queens_magazine_blog_most_commented_enable', 
		array(
			
			'default'     => 1,
			'sanitize_callback' => 'queens_magazine_blog_sanitize_checkbox'
		) );

		$wp_customize->add_control( 'queens_magazine_blog_most_commented_enable', 
			array(
				'label' 	=> __( 'Display Most commented posts among all posts', 'queens-magazine-blog' ),
				'section'	=> 'queens_magazine_blog_most_commented_section',
				'settings' 	=> 'queens_magazine_blog_most_commented_enable',
				'type'      => 'checkbox',

			) 
		);

		$wp_customize->add_setting( 'queens_magazine_blog_most_commented', 
		array(
			'default'     => __('MOST COMMENT','queens-magazine-blog'),
			'sanitize_callback' => 'sanitize_text_field'
		) );

		$wp_customize->add_control( 'queens_magazine_blog_most_commented', 
			array(
				'label' 	=> __( 'Title', 'queens-magazine-blog' ),
				'section'	=> 'queens_magazine_blog_most_commented_section',
				'settings' 	=> 'queens_magazine_blog_most_commented',
				'type' 		=> 'text',
			) 
		);

		$wp_customize->add_setting( 'queens_magazine_blog_most_commented_noofpost', 
		array(
			'default'     => 7,
			'sanitize_callback' => 'queens_magazine_blog_sanitize_positive_integer'
		) );

		$wp_customize->add_control( 'queens_magazine_blog_most_commented_noofpost', 
			array(
				'label' 	=> __( 'Number of post to show', 'queens-magazine-blog' ),
				'section'	=> 'queens_magazine_blog_most_commented_section',
				'settings' 	=> 'queens_magazine_blog_most_commented_noofpost',
				'type' 		=> 'number',
				'description' => __('Setting not applicable for widget content', 'queens-magazine-blog'),
			) 
		);

		$post_taxonomy_arrays = array(__('Comment & Tag','queens-magazine-blog'),__('Author','queens-magazine-blog'),__('Date','queens-magazine-blog'),__('Category','queens-magazine-blog'));
		foreach ($post_taxonomy_arrays as  $post_taxonomy) {
			$wp_customize->add_setting( 'queens_magazine_blog_most_commented_post_taxonomy_'.$post_taxonomy, array(
			'capability'            => 'edit_theme_options',
			'default'               => 1,
			'sanitize_callback' => 'queens_magazine_blog_sanitize_checkbox'
			) );

			$wp_customize->add_control( 'queens_magazine_blog_most_commented_post_taxonomy_'.$post_taxonomy, array(
				/* translators: %s: Label */ 
				'label'                 =>  sprintf( __( '%s display', 'queens-magazine-blog' ), $post_taxonomy ),
				'section'               => 'queens_magazine_blog_most_commented_section',
				'type'                  => 'checkbox',
				'settings' => 'queens_magazine_blog_most_commented_post_taxonomy_'.$post_taxonomy,
				'description' => __('Setting applicable for widget too', 'queens-magazine-blog'),

			) );
		}


		$wp_customize->add_setting( 'queens_magazine_blog_image_changeon_most_commented', 
		array(
			'default'     => 0,
			'sanitize_callback' => 'queens_magazine_blog_sanitize_positive_integer'
		) );

		$wp_customize->add_control( 'queens_magazine_blog_image_changeon_most_commented', 
			array(
				'label' 	=> __( 'Box display size change', 'queens-magazine-blog' ),
				'section'	=> 'queens_magazine_blog_most_commented_section',
				'settings' 	=> 'queens_magazine_blog_image_changeon_most_commented',
				'description' => __('Recommended Range ( 0 to 20 padding )', 'queens-magazine-blog'),
				'type' 		=> 'number',
				'input_attrs' => array(
					'min'		=> 0,
					'max' 	  	=> 20,
					'step'    	=> 1,
				),
			) 
		);

		// 'Most recent section'
		$wp_customize->add_section( 'queens_magazine_blog_most_recent_section',
		array(
			'title'      => __( 'Most recent section', 'queens-magazine-blog' ),
			'priority'   => 20,
			'panel'		=> 'queens_magazine_blog_theme_option_panel'
		) );
		
		$wp_customize->add_setting( 'queens_magazine_blog_most_recent', 
		array(
			'default'     => __('MOST RECENT','queens-magazine-blog'),
			'sanitize_callback' => 'sanitize_text_field'
		) );

		$wp_customize->add_control( 'queens_magazine_blog_most_recent', 
			array(
				'label' 	=> __( 'Title', 'queens-magazine-blog' ),
				'section'	=> 'queens_magazine_blog_most_recent_section',
				'settings' 	=> 'queens_magazine_blog_most_recent',
				'description' => __(' Goto ( Settings >> Reading ) to limit the no. of post to show', 'queens-magazine-blog'),
				'type' 		=> 'text',
			) 
		);

		$wp_customize->add_setting( 'queens_magazine_blog_most_recent_listgrid', 
		array(
			'default'     => 2,
			'sanitize_callback' => 'queens_magazine_blog_sanitize_select'
		) );

		$wp_customize->add_control( 'queens_magazine_blog_most_recent_listgrid', 
			array(
				'label' 	=> __( 'List / Grid selection', 'queens-magazine-blog' ),
				'section'	=> 'queens_magazine_blog_most_recent_section',
				'settings' 	=> 'queens_magazine_blog_most_recent_listgrid',
				'description' => __('Setting applicable for widget too', 'queens-magazine-blog'),
				'type'		=> 'select',
				'choices' 	=> 
					array(
						'1' => __( 'List', 'queens-magazine-blog' ),
						'2'	=> __( 'Grid', 'queens-magazine-blog' ),
					),
			) 
		);

		$post_taxonomy_arrays = array(__('Comment & Tag','queens-magazine-blog'),__('Author','queens-magazine-blog'),__('Date','queens-magazine-blog'),__('Category','queens-magazine-blog'));
		foreach ($post_taxonomy_arrays as  $post_taxonomy) {
			$wp_customize->add_setting( 'queens_magazine_blog_most_recent_post_taxonomy_'.$post_taxonomy, array(
			'capability'            => 'edit_theme_options',
			'default'               => 1,
			'sanitize_callback' => 'queens_magazine_blog_sanitize_checkbox'
			) );

			$wp_customize->add_control( 'queens_magazine_blog_most_recent_post_taxonomy_'.$post_taxonomy, array(
				/* translators: %s: Label */ 
				'label'                 =>  sprintf( __( '%s display', 'queens-magazine-blog' ), $post_taxonomy ),
				'section'               => 'queens_magazine_blog_most_recent_section',
				'type'                  => 'checkbox',
				'settings' => 'queens_magazine_blog_most_recent_post_taxonomy_'.$post_taxonomy,
				'description' => __('Setting applicable for widget too', 'queens-magazine-blog'),
			) );
		}
		
		$wp_customize->add_setting( 'queens_magazine_blog_image_changeon_recentpost', 
		array(
			'default'     => 0,
			'sanitize_callback' => 'queens_magazine_blog_sanitize_positive_integer'
		) );

		$wp_customize->add_control( 'queens_magazine_blog_image_changeon_recentpost', 
			array(
				'label' 	=> __( 'Box display size change', 'queens-magazine-blog' ),
				'section'	=> 'queens_magazine_blog_most_recent_section',
				'settings' 	=> 'queens_magazine_blog_image_changeon_recentpost',
				'description' => __('Recommended Range ( 0 to 20 padding )', 'queens-magazine-blog'),
				'type'		=> 'number',
				'input_attrs' => array(
					'min'		=> 0,
					'max' 	  	=> 20,
					'step'    	=> 1,
				),
			) 
		);

		// 'Social link' section
		$wp_customize->add_section( 'queens_magazine_blog_section_social_section',
		array(
			'title'      => __( 'Social link section', 'queens-magazine-blog' ),
			'priority'   => 20,
			'panel'		=> 'queens_magazine_blog_theme_option_panel'
		) );
		
		// Socail url
		$social_name_arrays = array(__('Facebook','queens-magazine-blog'),__('Twitter','queens-magazine-blog'),__('Youtube','queens-magazine-blog'),__('Googleplus','queens-magazine-blog'));
		foreach ($social_name_arrays as  $social_name) {
			$wp_customize->add_setting( 'queens_magazine_blog_social_url_'.$social_name, array(
			'capability'            => 'edit_theme_options',
			'default'               => '',
			'sanitize_callback' => 'queens_magazine_blog_sanitize_url'
			) );

			$wp_customize->add_control( 'queens_magazine_blog_social_url_'.$social_name, array(
				/* translators: %s: Label */ 
				'label'                 =>  sprintf( __( '%s Url', 'queens-magazine-blog' ), $social_name ),
				'section'               => 'queens_magazine_blog_section_social_section',
				'type'                  => 'url',
				'settings' => 'queens_magazine_blog_social_url_'.$social_name,
			) );
		}
		//Socail Url Enable or disable by checkboxs

		$wp_customize->add_setting( 'queens_magazine_blog_facebook_url_enable', array(
			'capability'            => 'edit_theme_options',
			'default'               => 0,
			'sanitize_callback'     => 'queens_magazine_blog_sanitize_checkbox'
		) );

		$wp_customize->add_control( 'queens_magazine_blog_facebook_url_enable', array(
			'label'                 =>  __( 'Enable facebook Icon', 'queens-magazine-blog' ),
			'section'               => 'queens_magazine_blog_section_social_section',
			'type'                  => 'checkbox',
			'settings'              => 'queens_magazine_blog_facebook_url_enable',
		) );
		$wp_customize->add_setting( 'queens_magazine_blog_twitter_url_enable', array(
			'capability'            => 'edit_theme_options',
			'default'               => 0,
			'sanitize_callback'     => 'queens_magazine_blog_sanitize_checkbox'
		) );

		$wp_customize->add_control( 'queens_magazine_blog_twitter_url_enable', array(
			'label'                 =>  __( 'Enable twitter Icon', 'queens-magazine-blog' ),
			'section'               => 'queens_magazine_blog_section_social_section',
			'type'                  => 'checkbox',
			'settings'              => 'queens_magazine_blog_twitter_url_enable',
		) );
		$wp_customize->add_setting( 'queens_magazine_blog_googlplus_url_enable', array(
			'capability'            => 'edit_theme_options',
			'default'               => 0,
			'sanitize_callback'     => 'queens_magazine_blog_sanitize_checkbox'
		) );

		$wp_customize->add_control( 'queens_magazine_blog_googlplus_url_enable', array(
			'label'                 =>  __( 'Enable google plus Icon', 'queens-magazine-blog' ),
			'section'               => 'queens_magazine_blog_section_social_section',
			'type'                  => 'checkbox',
			'settings'              => 'queens_magazine_blog_googlplus_url_enable',
		) );
		$wp_customize->add_setting( 'queens_magazine_blog_youtube_url_enable', array(
			'capability'            => 'edit_theme_options',
			'default'               => 0,
			'sanitize_callback'     => 'queens_magazine_blog_sanitize_checkbox'
		) );

		$wp_customize->add_control( 'queens_magazine_blog_youtube_url_enable', array(
			'label'                 =>  __( 'Enable youtube Icon', 'queens-magazine-blog' ),
			'section'               => 'queens_magazine_blog_section_social_section',
			'type'                  => 'checkbox',
			'settings'              => 'queens_magazine_blog_youtube_url_enable',
		) );
		
		// 'Recent update section'
		$wp_customize->add_section( 'queens_magazine_blog_recent_update_section',
		array(
			'title'      => __( 'Recent update section', 'queens-magazine-blog' ),
			'priority'   => 20,
			'panel'		=> 'queens_magazine_blog_theme_option_panel'
		) );
		
		$wp_customize->add_setting( 'queens_magazine_blog_recent_update_enable', 
		array(
			
			'default'     => 1,
			'sanitize_callback' => 'queens_magazine_blog_sanitize_checkbox'
		) );

		$wp_customize->add_control( 'queens_magazine_blog_recent_update_enable', 
			array(
				'label' 	=> __( 'Display recent updated posts among all posts ', 'queens-magazine-blog' ),
				'section'	=> 'queens_magazine_blog_recent_update_section',
				'settings' 	=> 'queens_magazine_blog_recent_update_enable',
				'type'      => 'checkbox',

			) 
		);

		$wp_customize->add_setting( 'queens_magazine_blog_recent_update', 
		array(
			'default'     => __('RECENT UPDATE','queens-magazine-blog'),
			'sanitize_callback' => 'sanitize_text_field'
		) );

		$wp_customize->add_control( 'queens_magazine_blog_recent_update', 
			array(
				'label' 	=> __( 'Title', 'queens-magazine-blog' ),
				'section'	=> 'queens_magazine_blog_recent_update_section',
				'settings' 	=> 'queens_magazine_blog_recent_update',
				'type' 		=> 'text',
			) 
		);

		$wp_customize->add_setting( 'queens_magazine_blog_recent_update_noofpost', 
		array(
			'default'     => 4,
			'sanitize_callback' => 'queens_magazine_blog_sanitize_positive_integer'
		) );

		$wp_customize->add_control( 'queens_magazine_blog_recent_update_noofpost', 
			array(
				'label' 	=> __( 'Number of post to show', 'queens-magazine-blog' ),
				'section'	=> 'queens_magazine_blog_recent_update_section',
				'settings' 	=> 'queens_magazine_blog_recent_update_noofpost',
				'type' 		=> 'number',
				'description' => __('Setting not applicable for widget content', 'queens-magazine-blog'),
			) 
		);

		$post_taxonomy_arrays = array(__('Comment & Tag','queens-magazine-blog'),__('Author','queens-magazine-blog'),__('Date','queens-magazine-blog'),__('Category','queens-magazine-blog'));
		foreach ($post_taxonomy_arrays as  $post_taxonomy) {
			$wp_customize->add_setting( 'queens_magazine_blog_recent_update_taxonomy_'.$post_taxonomy, array(
			'capability'            => 'edit_theme_options',
			'default'               => 1,
			'sanitize_callback' => 'queens_magazine_blog_sanitize_checkbox'
			) );

			$wp_customize->add_control( 'queens_magazine_blog_recent_update_taxonomy_'.$post_taxonomy, array(
				/* translators: %s: Label */ 
				'label'                 =>  sprintf( __( '%s display', 'queens-magazine-blog' ), $post_taxonomy ),
				'section'               => 'queens_magazine_blog_recent_update_section',
				'type'                  => 'checkbox',
				'settings' => 'queens_magazine_blog_recent_update_taxonomy_'.$post_taxonomy,
				'description' => __('Setting applicable for widget too', 'queens-magazine-blog'),
			) );
		}
		$wp_customize->add_setting( 'queens_magazine_blog_image_changeon_recent_update', 
		array(
			'default'     => 0,
			'sanitize_callback' => 'queens_magazine_blog_sanitize_positive_integer'
		) );

		$wp_customize->add_control( 'queens_magazine_blog_image_changeon_recent_update', 
			array(
				'label' 	=> __( 'Box display size change', 'queens-magazine-blog' ),
				'section'	=> 'queens_magazine_blog_recent_update_section',
				'settings' 	=> 'queens_magazine_blog_image_changeon_recent_update',
				'description' => __('Recommended Range ( 0 to 20 padding )', 'queens-magazine-blog'),
				'type'		=> 'number',
				'input_attrs' => array(
					'min'		=> 0,
					'max' 	  	=> 20,
					'step'    	=> 1,
				),
			) 
		);

		// 'Section Footer section'
		$wp_customize->add_section( 'queens_magazine_blog_section_footer_section',
		array(
			'title'      => __( 'Footer section', 'queens-magazine-blog' ),
			'priority'   => 20,
			'panel'		=> 'queens_magazine_blog_theme_option_panel'
		) );

		$wp_customize->add_setting( 'queens_magazine_blog_most_used_categories_text',
		array(
			'capability'            => 'edit_theme_options',
			'default'               => __('Most Used Categories','queens-magazine-blog'),
			'sanitize_callback' => 'sanitize_text_field'
		) );

		$wp_customize->add_control( 'queens_magazine_blog_most_used_categories_text', 
			array(
				'label' 	=> __( 'Most used categories header text', 'queens-magazine-blog' ),
				'section'	=> 'queens_magazine_blog_section_footer_section',
				'settings' 	=> 'queens_magazine_blog_most_used_categories_text',
				'type'      => 'text',
			) 
		);

		$wp_customize->add_setting( 'queens_magazine_blog_most_used_categories_enable',
		array(
			'capability'            => 'edit_theme_options',
			'default'               => 0,
			'sanitize_callback' => 'queens_magazine_blog_sanitize_checkbox'
		) );

		$wp_customize->add_control( 'queens_magazine_blog_most_used_categories_enable', 
			array(
				'label' 	=> __( 'Enable 4 Most used categories', 'queens-magazine-blog' ),
				'section'	=> 'queens_magazine_blog_section_footer_section',
				'settings' 	=> 'queens_magazine_blog_most_used_categories_enable',
				'type'      => 'checkbox',
			) 
		);

		// 'Section Footer' section MOST COMMENTED POST
		$wp_customize->add_setting( 'queens_magazine_blog_most_commented_post_text',
		array(
			'capability'            => 'edit_theme_options',
			'default'               => __('Most Commented Post','queens-magazine-blog'),
			'sanitize_callback' => 'sanitize_text_field'
		) );

		$wp_customize->add_control( 'queens_magazine_blog_most_commented_post_text', 
			array(
				'label' 	=> __( 'Most commented post header text', 'queens-magazine-blog' ),
				'section'	=> 'queens_magazine_blog_section_footer_section',
				'settings' 	=> 'queens_magazine_blog_most_commented_post_text',
				'type'      => 'text',
			) 
		);

		$wp_customize->add_setting( 'queens_magazine_blog_most_commented_post_enable', 
		array(
			
			'default'     => 0,
			'sanitize_callback' => 'queens_magazine_blog_sanitize_checkbox'
		) );

		$wp_customize->add_control( 'queens_magazine_blog_most_commented_post_enable', 
			array(
				'label' 	=> __( 'Enable 4 Most commented post', 'queens-magazine-blog' ),
				'section'	=> 'queens_magazine_blog_section_footer_section',
				'settings' 	=> 'queens_magazine_blog_most_commented_post_enable',
				'type'      => 'checkbox',

			) 
		);

		// 'Section Footer' section About us
		$wp_customize->add_setting( 'queens_magazine_blog_about_text', 
		array(
			'default'     => __('about us','queens-magazine-blog'),
			'sanitize_callback' => 'sanitize_text_field'
		) );

		$wp_customize->add_control( 'queens_magazine_blog_about_text', 
			array(
				'label' 	=> __( 'About us header text', 'queens-magazine-blog' ),
				'section'	=> 'queens_magazine_blog_section_footer_section',
				'settings' 	=> 'queens_magazine_blog_about_text',
				'type' 		=> 'text',
		) );

		$wp_customize->add_setting( 'queens_magazine_blog_copyright_statement', 
		array(
			'default'     => __('copyright@','queens-magazine-blog' ),
			'sanitize_callback' => 'sanitize_textarea_field'
		) );

		$wp_customize->add_control( 'queens_magazine_blog_copyright_statement', 
			array(
				'label' 	=> __( 'Detail', 'queens-magazine-blog' ),
				'section'	=> 'queens_magazine_blog_section_footer_section',
				'settings' 	=> 'queens_magazine_blog_copyright_statement',
				'type' 		=> 'textarea',
			) 
		);

		$wp_customize->add_setting( 'queens_magazine_blog_copyright_enable', 
		array(
			
			'default'     => 0,
			'sanitize_callback' => 'queens_magazine_blog_sanitize_checkbox'
		) );

		$wp_customize->add_control( 'queens_magazine_blog_copyright_enable', 
			array(
				'label' 	=> __( 'Enable copyright', 'queens-magazine-blog' ),
				'section'	=> 'queens_magazine_blog_section_footer_section',
				'settings' 	=> 'queens_magazine_blog_copyright_enable',
				'type'      => 'checkbox',

			) 
		);
		// 'General setting '
		$wp_customize->add_section( 'queens_magazine_blog_section_general_setting',
		array(
			'title'      => __( 'General setting for all', 'queens-magazine-blog' ),
			'priority'   => 20,
			'panel'		=> 'queens_magazine_blog_theme_option_panel'
		) );

		$wp_customize->add_setting( 'queens_magazine_blog_frontpage_width',
		array(
			'default'               => 92,
			'sanitize_callback' => 'queens_magazine_blog_sanitize_positive_integer'
		) );

		$wp_customize->add_control( 'queens_magazine_blog_frontpage_width', 
			array(
				'label' 	=> __( 'Frontpage width', 'queens-magazine-blog' ),
				'section'	=> 'queens_magazine_blog_section_general_setting',
				'settings' 	=> 'queens_magazine_blog_frontpage_width',
				'description' => __('Recommended Range ( 80 % to 100 %)', 'queens-magazine-blog'),
				'type'		=> 'number',
				'input_attrs' => array(
					'min'		=> 80,
					'max' 	  	=> 100,
					'step'    	=> 1,
				),
			) 
		);
}
add_action( 'customize_register', 'queens_magazine_blog_customize_other' );