<?php
/**
 * Advance Blogging Theme Customizer
 *
 * @package Advance Blogging
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function advance_blogging_customize_register( $wp_customize ) {

	//add home page setting pannel
	$wp_customize->add_panel( 'advance_blogging_panel_id', array(
	    'priority' => 10,
	    'capability' => 'edit_theme_options',
	    'theme_supports' => '',
	    'title' => __( 'Theme Settings', 'advance-blogging' ),
	    'description' => __( 'Description of what this panel does.', 'advance-blogging' )
	) );

	//Layouts
	$wp_customize->add_section( 'advance_blogging_left_right', array(
    	'title'      => __( 'Theme Layout Settings', 'advance-blogging' ),
		'priority'   => 30,
		'panel' => 'advance_blogging_panel_id'
	) );

	// Add Settings and Controls for Layout
	$wp_customize->add_setting('advance_blogging_theme_options',array(
        'default' => '',
        'sanitize_callback' => 'advance_blogging_sanitize_choices'
	)  );

	$wp_customize->add_control('advance_blogging_theme_options',
	    array(
	        'type' => 'radio',
	        'label' => __('Do you want this section','advance-blogging'),
	        'section' => 'advance_blogging_left_right',
	        'choices' => array(
	            'Left Sidebar' => __('Left Sidebar','advance-blogging'),
	            'Right Sidebar' => __('Right Sidebar','advance-blogging'),
	            'One Column' => __('One Column','advance-blogging'),
	            'Three Columns' => __('Three Columns','advance-blogging'),
	            'Four Columns' => __('Four Columns','advance-blogging'),
	            'Grid Layout' => __('Grid Layout','advance-blogging')
	        ),
	    )
    );
	
	//Top Header
	$wp_customize->add_section('advance_blogging_topbar_header',array(
		'title'	=> __('Top Header','advance-blogging'),
		'description'	=> __('Add Header Content here','advance-blogging'),
		'priority'	=> null,
		'panel' => 'advance_blogging_panel_id',
	));

	$wp_customize->add_setting('advance_blogging_facebook_url',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));	
	$wp_customize->add_control('advance_blogging_facebook_url',array(
		'label'	=> __('Add Facebook link','advance-blogging'),
		'section'	=> 'advance_blogging_topbar_header',
		'setting'	=> 'advance_blogging_facebook_url',
		'type'	=> 'url'
	));

	$wp_customize->add_setting('advance_blogging_twitter_url',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));	
	$wp_customize->add_control('advance_blogging_twitter_url',array(
		'label'	=> __('Add Twitter link','advance-blogging'),
		'section'	=> 'advance_blogging_topbar_header',
		'setting'	=> 'advance_blogging_twitter_url',
		'type'	=> 'url'
	));

	$wp_customize->add_setting('advance_blogging_googleplus_url',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));	
	$wp_customize->add_control('advance_blogging_googleplus_url',array(
		'label'	=> __('Add Google Plus link','advance-blogging'),
		'section'	=> 'advance_blogging_topbar_header',
		'setting'	=> 'advance_blogging_googleplus_url',
		'type'	=> 'url'
	));

	$wp_customize->add_setting('advance_blogging_pinterest_url',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));	
	$wp_customize->add_control('advance_blogging_pinterest_url',array(
		'label'	=> __('Add Pinterest link','advance-blogging'),
		'section'	=> 'advance_blogging_topbar_header',
		'setting'	=> 'advance_blogging_pinterest_url',
		'type'	=> 'url'
	));

	$wp_customize->add_setting('advance_blogging_linkedin_url',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));	
	$wp_customize->add_control('advance_blogging_linkedin_url',array(
		'label'	=> __('Add Linkedin link','advance-blogging'),
		'section'	=> 'advance_blogging_topbar_header',
		'setting'	=> 'advance_blogging_linkedin_url',
		'type'	=> 'url'
	));

	$wp_customize->add_setting('advance_blogging_insta_url',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));	
	$wp_customize->add_control('advance_blogging_insta_url',array(
		'label'	=> __('Add Instagram link','advance-blogging'),
		'section'	=> 'advance_blogging_topbar_header',
		'setting'	=> 'advance_blogging_insta_url',
		'type'	=> 'url'
	));

	$wp_customize->add_setting('advance_blogging_youtube_url',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));	
	$wp_customize->add_control('advance_blogging_youtube_url',array(
		'label'	=> __('Add Youtube link','advance-blogging'),
		'section'	=> 'advance_blogging_topbar_header',
		'setting'	=> 'advance_blogging_youtube_url',
		'type'		=> 'url'
	));

	//home page slider
	$wp_customize->add_section( 'advance_blogging_slider_section' , array(
    	'title'      => __( 'Slider Settings', 'advance-blogging' ),
		'priority'   => null,
		'panel' => 'advance_blogging_panel_id'
	) );

	for ( $count = 1; $count <= 4; $count++ ) {

		// Add color scheme setting and control.
		$wp_customize->add_setting( 'advance_blogging_slider_page' . $count, array(
			'default'           => '',
			'sanitize_callback' => 'advance_blogging_sanitize_dropdown_pages'
		) );
		$wp_customize->add_control( 'advance_blogging_slider_page' . $count, array(
			'label'    => __( 'Select Slide Image Page', 'advance-blogging' ),
			'section'  => 'advance_blogging_slider_section',
			'description' => 'Background Image Size (900x450 )',
			'type'     => 'dropdown-pages'
		) );
	}

	// Category Post
	$wp_customize->add_section('advance_blogging_category_post',array(
		'title'	=> __('Category Post','advance-blogging'),
		'description'=> __('This section will appear on the right side of slider.','advance-blogging'),
		'panel' => 'advance_blogging_panel_id',
	));

	$categories = get_categories();
	$cats = array();
	$i = 0;
	foreach($categories as $category){
	if($i==0){
	$default = $category->slug;
	$i++;
	}
	$cats[$category->slug] = $category->name;
	}

	$wp_customize->add_setting('advance_blogging_blogcategory_setting',array(
		'default'	=> 'select',
		'sanitize_callback' => 'sanitize_text_field',
	));
	$wp_customize->add_control('advance_blogging_blogcategory_setting',array(
		'type'    => 'select',
		'choices' => $cats,
		'label' => __('Select Category to display Latest Post','advance-blogging'),
		'section' => 'advance_blogging_category_post',
	));

	// Latest Post
	$wp_customize->add_section('advance_blogging_latest_post',array(
		'title'	=> __('Latest Post','advance-blogging'),
		'description'=> __('This section will appear below the slider.','advance-blogging'),
		'panel' => 'advance_blogging_panel_id',
	));

	$categories = get_categories();
	$cats = array();
	$i = 0;
	foreach($categories as $category){
	if($i==0){
	$default = $category->slug;
	$i++;
	}
	$cats[$category->slug] = $category->name;
	}

	$wp_customize->add_setting('advance_blogging_latest_post_setting',array(
		'default'	=> 'select',
		'sanitize_callback' => 'sanitize_text_field',
	));
	$wp_customize->add_control('advance_blogging_latest_post_setting',array(
		'type'    => 'select',
		'choices' => $cats,
		'label' => __('Select Category to display Latest Post','advance-blogging'),
		'section' => 'advance_blogging_latest_post',
	));

	//Footer
	$wp_customize->add_section('advance_blogging_footer',array(
		'title'	=> __('Footer Text','advance-blogging'),
		'description'=> __('This section will appear in the .','advance-blogging'),
		'panel' => 'advance_blogging_panel_id',
	));

	$wp_customize->add_setting('advance_blogging_footer_copy',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('advance_blogging_footer_copy',array(
		'label'	=> __('Text','advance-blogging'),
		'section'=> 'advance_blogging_footer',
		'setting'=> 'advance_blogging_footer_copy',
		'type'=> 'text'
	));	
}
add_action( 'customize_register', 'advance_blogging_customize_register' );

/**
 * Singleton class for handling the theme's customizer integration.
 *
 * @since  1.0.0
 * @access public
 */
final class Advance_Blogging_Customize {

	/**
	 * Returns the instance.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return object
	 */
	public static function get_instance() {

		static $instance = null;

		if ( is_null( $instance ) ) {
			$instance = new self;
			$instance->setup_actions();
		}

		return $instance;
	}

	/**
	 * Constructor method.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function __construct() {}

	/**
	 * Sets up initial actions.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function setup_actions() {

		// Register panels, sections, settings, controls, and partials.
		add_action( 'customize_register', array( $this, 'sections' ) );

		// Register scripts and styles for the controls.
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue_control_scripts' ), 0 );
	}

	/**
	 * Sets up the customizer sections.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  object  $manager
	 * @return void
	 */
	public function sections( $manager ) {

		// Load custom sections.
		load_template( trailingslashit( get_template_directory() ) . '/inc/section-pro.php' );
		
		// Register custom section types.
		$manager->register_section_type( 'Advance_Blogging_Customize_Section_Pro' );

		// Register sections.
		$manager->add_section(
			new Advance_Blogging_Customize_Section_Pro(
				$manager,
				'example_1',
				array(
					'priority'   => 9,
					'title'    => esc_html__( 'Advance Blogging', 'advance-blogging' ),
					'pro_text' => esc_html__( 'Go Pro',  'advance-blogging' ),
					'pro_url'  => esc_url( 'https://www.themescaliber.com/themes/blog-wordpress-theme/' ),
		 		)
			)
		);
	}

	/**
	 * Loads theme customizer CSS.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function enqueue_control_scripts() {

		wp_enqueue_script( 'advance-blogging-customize-controls', trailingslashit( get_template_directory_uri() ) . '/js/customize-controls.js', array( 'customize-controls' ) );

		wp_enqueue_style( 'advance-blogging-customize-controls', trailingslashit( get_template_directory_uri() ) . '/css/customize-controls.css' );
	}
}

// Doing this customizer thang!
Advance_Blogging_Customize::get_instance();