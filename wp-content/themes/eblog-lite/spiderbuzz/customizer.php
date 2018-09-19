<?php
    /**
    * eBlog Lite Theme Customizer
    *
    * @package eBlog Lite
    */

    /**
    * Add postMessage support for site title and description for the Theme Customizer.
    *
    * @param WP_Customize_Manager $wp_customize Theme Customizer object.
    */

    class eblogliteCustomizer{
        function __construct(){
            add_action( 'customize_register', array($this,'eblog_lite_general_customize') );
            
            
            add_action('customize_register',array($this,'eblog_lite_social_links_customizer'));
    
        }
        function __destruct() {
            $vars = array_keys(get_defined_vars());
            for ($i = 0; $i < sizeOf($vars); $i++) {
                unset($vars[$i]);
            }
            unset($vars,$i);
        }
        public static function get_instance() {
            static $instance;
            $class = __CLASS__;
            if( ! $instance instanceof $class) {
                $instance = new $class;
            }
            return $instance;
        }

        function eblog_lite_general_customize( $wp_customize ) {
            $wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
            $wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
            $wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

            if ( isset( $wp_customize->selective_refresh ) ) {
                $wp_customize->selective_refresh->add_partial( 'blogname', array(
                    'selector'        => '.site-title a',
                    'render_callback' => 'eblog_lite_customize_partial_blogname',
                ) );
                $wp_customize->selective_refresh->add_partial( 'blogdescription', array(
                    'selector'        => '.site-description',
                    'render_callback' => 'eblog_lite_customize_partial_blogdescription',
                ) );
            }
            /**
            * General Settings Panel
            */
            $wp_customize->add_panel('eblog_lite_general_settings', array(
                'priority' => 1,
                'title' => esc_html__('General Settings', 'eblog-lite')
            ));

            $wp_customize->get_section('title_tagline')->panel = 'eblog_lite_general_settings';
            $wp_customize->get_section('title_tagline' )->priority = 1;

            $wp_customize->get_section('header_image')->panel = 'eblog_lite_general_settings';
            $wp_customize->get_section('header_image' )->priority = 2;

            $wp_customize->get_section('colors')->panel = 'eblog_lite_general_settings';
            $wp_customize->get_section('background_image')->panel = 'eblog_lite_general_settings';
            $wp_customize->get_section('header_image' )->priority = 4;

            // General Settings 
            $wp_customize->add_section('eblog_settings_section',array(
                'title'     =>esc_html__('General Settings','eblog-lite'),
                'description'=>esc_html__('Theme General Settings','eblog-lite'),
                'priority'  =>1,
                'panel'     => 'eblog_lite_general_settings'
            ));


            $wp_customize->add_setting('eblog_lite_viewe_enable', array(
                'default' => true,
                'sanitize_callback' => 'eblog_lite_sanitize_checkbox'
            ));  
            $wp_customize->add_control( 'eblog_lite_viewe_enable', array(
                'label' => esc_html__('Enable Viewes Display', 'eblog-lite'),
                'description'=>esc_html__('Enable Related Post','eblog-lite'),
                'section' => 'eblog_settings_section',
                'type'     =>'checkbox',
                'priority'=> 1
            ));

            /** Slider Section */
            $wp_customize->add_setting( 
                'eblog_lite_slider_enable', 
                array(
                    'default' => true,
                    'sanitize_callback'=>'eblog_lite_sanitize_checkbox'
                )
            );
            $wp_customize->add_control( 
                'eblog_lite_slider_enable', 
                array(
                    'label' => esc_html__( 'Enable Slider Display', 'eblog-lite' ),
                    'section' => 'eblog_settings_section',
                    'type' => 'checkbox'
                )
            ); 


            // Category Enable
            $wp_customize->add_setting('eblog_lite_category_section_enable', array(
                'default' => true,
                'sanitize_callback' => 'eblog_lite_sanitize_checkbox'
            ));  
            $wp_customize->add_control( 'eblog_lite_category_section_enable', array(
                'label' => esc_html__('Enable Category', 'eblog-lite'),
                'description'=>esc_html__('Enable Category Section.','eblog-lite'),
                'section' => 'eblog_settings_section',
                'type'     =>'checkbox',
                'priority'=> 2
            ));

            /**
             * Archive page Settings
             */
            $wp_customize->add_section('eblog_lite_archive_settings_section',array(
                'title'     =>esc_html__('Archive Page Settings','eblog-lite'),
                'description'=>esc_html__('Blog and archive page settings.','eblog-lite'),
                'priority'  =>10,
                'panel'     => 'eblog_lite_general_settings'
            ));

            //Slider Post exclusive post
            $wp_customize->add_setting( 
                'eblog_lite_archive_slider_post_exclusive', 
                array(
                    'sanitize_callback' => 'eblog_lite_sanitize_radio',
                    'default'           => false
                )
            );
            $wp_customize->add_control( 
                'eblog_lite_archive_slider_post_exclusive', 
                array(
                    'label' => esc_html__( 'Inclusive And Exclusive Slider Post.', 'eblog-lite' ),
                    'section' => 'eblog_lite_archive_settings_section',
                    'type' => 'radio',
                    'choices' => array(
                        true => esc_html__('Inclusive','eblog-lite'),
                        false => esc_html__('Exclusive','eblog-lite'),              
                    )
                )
            );
            
            //Slider post post count
            $wp_customize->add_setting( 
                'eblog_lite_num_post_slide', 
                array(
                    'sanitize_callback' => 'absint', //converts value to a non-negative integer
                    'default'           => 4,
                )
            );
            $wp_customize->add_control( 
                'eblog_lite_num_post_slide', 
                array(
                    'label' => esc_html__( 'Number of Post Slider', 'eblog-lite' ),
                    'section' => 'eblog_lite_archive_settings_section',
                    'type' => 'number'
                )
            );

            

            /******************************
            *Category Color 
            **********************************/
            $wp_customize->add_section('eblog_lite_category_color_setting', array(
                'title' => esc_html__('Category Color Settings', 'eblog-lite'),
            
            ));

            $i = 1;
            $args = array(
                'orderby' => 'id',
                'hide_empty' => 0
            );

            $categories = get_categories( $args );

            $wp_category_list = array();

            foreach ($categories as $category_list ) {

                $wp_category_list[$category_list->cat_ID] = $category_list->cat_name;
                $wp_customize->add_setting('eblog_lite_category_color_'.get_cat_id( $wp_category_list[ $category_list->cat_ID ] ), array(
                    'default' => '',
                    'capability' => 'edit_theme_options',
                    'sanitize_js_callback' => 'eblog_lite_color_escaping_option_sanitize'
                ));
                $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'eblog_lite_category_color_'.get_cat_id( $wp_category_list[ $category_list->cat_ID ] ), array(
                    'label' => sprintf( '%1$s', $wp_category_list[ $category_list->cat_ID ] ),
                    'section' => 'eblog_lite_category_color_setting',
                    'settings' => 'eblog_lite_category_color_'.get_cat_id( $wp_category_list[ $category_list->cat_ID ] ),
                    'priority' => $i
                )));
                $i++;
            }
        

        }

        

        //Social Links
        function eblog_lite_social_links_customizer($wp_customize) {
            $customizer = KCustomizer::get_instance($wp_customize);
            $default = array(
                'section' => array(
                        'id'        => "eblog_lite_social_links",
                        'label'     => __("Social Links", 'eblog-lite'),
                        'priority'  => 2
                    ),
                    'fields' => array(
                        array(
                            // for settigns
                            'default'   => true,
                            'transport' => 'refresh',
                            //for control
                            'id'    => "eblog_lite_social_links_enable",
                            'type'  => 'checkbox',
                            'label' => __("Enabel", 'eblog-lite')
                        ),
                        array(
                                // for settigns
                                'default'   => "https://www.facebook.com/",
                                'transport' => 'postMessage',
                                //for control
                                'id'    => "facebook_url",
                                'type'  => 'url',
                                'label' => __("Facebook URL", 'eblog-lite')
                            ),
                            array(
                                // for settigns
                                'default'   => "https://www.plus.google.com/",
                                'transport' => 'postMessage',
                                //for control
                                'id'    => "google_plus",
                                'type'  => 'url',
                                'label' => __("Google Plus", 'eblog-lite')
                            ),
                            array(
                                // for settigns
                                'default'   => "https://www.twitter.com",
                                'transport' => 'postMessage',
                                //for control
                                'id'    => "twitter_url",
                                'type'  => 'url',
                                'label' => __("Twitter URL", 'eblog-lite')
                            ),
                            array(
                                // for settigns
                                'default'   => "https://www.rss.com",
                                'transport' => 'postMessage',
                                //for control
                                'id'    => "rss_url",
                                'type'  => 'url',
                                'label' => __("RSS URL", 'eblog-lite')
                            ),
                            array(
                                // for settigns
                                'default'   => "https://www.linkedin.com",
                                'transport' => 'postMessage',
                                //for control
                                'id'    => "linkedin_url",
                                'type'  => 'url',
                                'label' => __("Linkedin URL", 'eblog-lite')
                            ),
                            array(
                                // for settigns
                                'default'   => "https://www.instagram.com",
                                'transport' => 'postMessage',
                                //for control
                                'id'    => "instagram_url",
                                'type'  => 'url',
                                'label' => __("Instagram URL", 'eblog-lite')
                            ),
                            
                    )
                );
            $customizer->prepare( $default );
        }

        

    }
eblogliteCustomizer::get_instance();

        /*******************************************
         * Eblog Lite Layout
         *******************************************/
        function eblog_lite_page_layout_customizer( $wp_customize ) {
            
            /******************************************
             * Page Layout
             ******************************************/
            $wp_customize->add_section('eblog_lite_page_layout',array(
                'title'     =>esc_html__('Theme Layout','eblog-lite'),
                'description'=>esc_html__('Eblog Lite Theme Layout','eblog-lite'),
                'priority'  =>3,
            ));

            // Breadcrumb Archive Page Layout
            $wp_customize->add_setting( 'eblog_lite_theme_layout', array(
                'capability' => 'edit_theme_options',
                'sanitize_callback' => 'eblog_lite_sanitize_select',
                'default' => 'box-layout',
            ) );
            
            $wp_customize->add_control( 'eblog_lite_theme_layout', array(
                'type' => 'select',
                'section' => 'eblog_lite_page_layout', // Add a default or your own section
                'label' => esc_html__( 'Theme Layout','eblog-lite' ),
                'description' => esc_html__( 'Select Theme Layout.','eblog-lite' ),
                'choices' => array(
                    'normal' => esc_html__( 'Full Width', 'eblog-lite' ),
                    'box-layout' => esc_html__( 'Box Layout', 'eblog-lite' ),
                ),
            ) );


        }
        add_action( 'customize_register', 'eblog_lite_page_layout_customizer');


    /**
     * Checkbox Santi
     */
    function eblog_lite_sanitize_select( $input, $setting ) {

        // Ensure input is a slug.
        $input = sanitize_key( $input );
        // Get list of choices from the control associated with the setting.
        $choices = $setting->manager->get_control( $setting->id )->choices;
        // If the input is a valid key, return it; otherwise, return the default.
        return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
    }

    /** Category Color Senitize */
    function eblog_lite_color_escaping_option_sanitize($input) {
        $input = esc_attr($input);
        return $input;
      }

    //Checkbox  
    function eblog_lite_sanitize_checkbox( $checked ){
        // Boolean check.
        return ( ( isset( $checked ) && true == $checked ) ? true : false );
    }

    //radio box sanitization function
    function eblog_lite_sanitize_radio( $input, $setting ){
         
        //input must be a slug: lowercase alphanumeric characters, dashes and underscores are allowed only
        $input = sanitize_key($input);

        //get the list of possible radio box options 
        $choices = $setting->manager->get_control( $setting->id )->choices;
                         
        //return input if valid or return default option
        return ( array_key_exists( $input, $choices ) ? $input : $setting->default );                
         
    }