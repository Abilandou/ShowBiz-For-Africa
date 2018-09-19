<?php
/**
* package KCustomizerClass
* this package is for wordpress customizer, it helps to create customizer using array no need to create panel, section and settings and controller
* 
**/
class KCustomizer{
    public $wp_customize;
    static $default;
    function __construct( $customizer = null ){
        if($customizer === null ){
            wp_die("Invalid args: please pass wp_customize vaiable");
        }
        $this->wp_customize = $customizer;
    }
    function __destruct() {
        $vars = array_keys(get_defined_vars());
        for ($i = 0; $i < sizeOf($vars); $i++) {
            unset($vars[$i]);
        }
        unset($vars,$i);
    }
    public static function get_instance($customizer) {
        static $instance;
        $class = __CLASS__;
        if( ! $instance instanceof $class) {
            $instance = new KCustomizer($customizer);
        }
        return $instance;
    }
    
    //convert array to object
    function arrayToObject( $array ){
        foreach( $array as $key => $value ){
            if( is_array( $value ) ) $array[ $key ] = $this->arrayToObject( $value );
        }
        return (object) $array;
    }
    
    //prepare customizer
    function prepare( $args){
        $default = wp_parse_args( $args, self::$default );
        $attrs = $this->arrayToObject( $default);
        
        if( isset( $attrs->panel ) ){
            $this->wp_customize->add_panel( $attrs->panel->id, array(
                'title' => $attrs->panel->label,
                'description' => $attrs->panel->desc,
                'priority' => $attrs->panel->priority
            ) );
        }
        // for single section 
        if( isset($attrs->section)){
            $panel = $this->wp_customize->add_section( $attrs->section->id, array(
                'title' => $attrs->section->label,
                'priority' => $attrs->section->priority
            ));

            if( isset($attrs->panel)){
                $panel->panel = $attrs->panel->id;
            }

            // fields loop for setting and control
            foreach( $attrs->fields as $field ){
                $section = $attrs->section;
                $this->get_customizer_field($field, $section);
            }

        }

        // multiple section and fields
        if( isset($attrs->sections)){
            foreach($attrs->sections as $section ){
                if( empty($section->section) or empty($section->fields)){
                    wp_die("invalid args");
                }
                $fields = $section->fields;
                $section = $section->section;

                $panel = $this->wp_customize->add_section( $section->id, array(
                    'title' => $section->label,
                    'priority' => $section->priority
                ));

                if( isset($attrs->panel)){
                    $panel->panel = $attrs->panel->id;
                }

                // fields loop for seting and control
                foreach( $fields as $field ){
                    $this->get_customizer_field($field, $section);
                }
            }
        }
    }
    
    function get_customizer_field($field, $section){
        switch($field->type){
            case "file":
                $this->get_file_settigns_and_controller($field, $section);
                break;
            case "category":
                $this->get_category_settigns_and_controller($field, $section);
                break;
            case "color":
                $this->get_color_settigns_and_controller($field, $section);
                break;
            case "image":            
                $this->get_image_settigns_and_controller($field, $section);
                break;
            case "radio":
                $this->get_radio_settigns_and_controller($field, $section);
                break;
            case "woselect":
                $this->get_select_settigns_and_controller($field, $section);
                break;
            
            default:
                $this->get_setting_and_controller( $field, $section);
            break;

        }    
    }

    function get_field_info($field, $section){
        $modify = array(
                "settings"  => $field->id,
                'section'   => $section->id,
                'type'      => 'text'
            );
        $field = wp_parse_args( $field, $modify );
        return $field;
    }
    // Default controller and settigns 
    function get_setting_and_controller( $field, $section){
        $this->wp_customize->add_setting( $field->id, array( 
            'sanitize_callback' => $this->get_santize_callback($field->type),
            'default'           => $field->default,
            'transport'         => $field->transport,
        ));
        $this->wp_customize->add_control( $field->id, $this->get_field_info($field, $section));
    }
    //file type controller and settigns 
    //  =============================
    //  = File Upload               =
    //  =============================
    function get_file_settigns_and_controller($field, $section){
        $this->wp_customize->add_setting($field->id, array(
            'default'           => 'arse',
            'capability'        => 'edit_theme_options',
            'type'           => 'option',
    
        ));
        $this->wp_customize->add_control( new WP_Customize_Upload_Control($this->wp_customize, $field->id, array(
            'label'    => $field->label,
            'section'  => $section->id,
            'settings' => $field->id,
        )));
    }
    //  =============================
    //  = Image Upload              =
    //  =============================
    function get_image_settigns_and_controller($field, $section){
        $this->wp_customize->add_setting($field->id, array(
            'default'           => $field->default,
            'capability'        => 'edit_theme_options',
            'type'              => 'option',
    
        ));
        $this->wp_customize->add_control( new WP_Customize_Image_Control($this->wp_customize, $field->id, $this->get_field_info($field, $section)));
    }
    //  =============================
    //  = Color Picker              =
    //  =============================
    function get_color_settigns_and_controller($field, $section){
        $this->wp_customize->add_setting($field->id, array(
            'default'           => $field->default,
            'sanitize_callback' => 'sanitize_hex_color',
            'capability'        => 'edit_theme_options',
            'type'           => 'option'
        ));
        $this->wp_customize->add_control( new WP_Customize_Color_Control($this->wp_customize, $field->id, $this->get_field_info($field, $section)));
    }

    
    function get_radio_settigns_and_controller($field, $section){
    
        $this->wp_customize->add_setting($field->id, array(
            'default'        => $field->default
        ));
        $field->type = "radio"; 
        $this->wp_customize->add_control( $field->id, $this->get_field_info($field, $section));
    }
    // =====================
    //  = Select Dropdown =
    //  =====================
    
    function get_select_settigns_and_controller($field, $section){
        $cats = array();
        $args = array(
            'orderby'    => 'title',
            'order'      => 'ASC'
        );
        $product_wocategories = get_terms( 'product_cat', $args );

        $i = 0;
        foreach($product_wocategories as $category){
            if($i==0){
                $default = $category->slug;
                $i++;
            }
            $cats[$category->slug] = $category->name;
        }

        $this->wp_customize->add_setting($field->id, array(
            'default'        => $field->default
        ));
        $field->type = "select"; 
        $field->choices = $cats;
        $this->wp_customize->add_control( $field->id, $this->get_field_info($field, $section));
    }


    // =====================
    //  = Category Dropdown =
    //  =====================
    function get_category_settigns_and_controller($field, $section){
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
    
        $this->wp_customize->add_setting($field->id, array(
            'default'        => $field->default
        ));
        $field->type = "select"; 
        $field->choices = $cats;
        $this->wp_customize->add_control( $field->id, $this->get_field_info($field, $section));
    }

    function get_santize_callback($field){
        $abcd = new KCustomizer('');
        switch($field){
            case "text":
            case "textarea":
                return array($this, 'eblog_lite_textbox_sanitize');
                break;
            case 'number': 
                return array($this, 'eblog_lite_number_sanitize');
                break;
            case "radio":
                return array($this, 'eblog_lite_radio_enable_sanitize');
                break;
            
            default:
                return null;
        }
    }

    // santization for checkbox
    function eblog_lite_checkbox_sanitize($input){
        if ( $input == 1 ) {
            return 1;
        } else {
            return 0;
      }
    }
    /**
	 * Enable/Disable Sanitization
	*/
    function eblog_lite_radio_enable_sanitize($input) {
        $valid_keys = array(
           'enable' => esc_html__('Enable', 'eblog-lite'),
	       'disable' => esc_html__('Disable', 'eblog-lite'),
        );
        if ( array_key_exists( $input, $valid_keys ) ) {
          return $input;
        } else {
          return '';
        }
    }
    /**
	* number santization
	*/
    function eblog_lite_number_sanitize( $int ) {
        return absint( $int );
    }
    /**
	* Text Sanitization
	*/
    function eblog_lite_textbox_sanitize( $input ) {
        return wp_kses_post( force_balance_tags( $input ) );
    }
}
KCustomizer::$default = array(
    'section' => null,
    'fields' => array(
        array(
            // for settigns
            'default'   => null,
            'callback'  => null,
            'transport' => 'postMessage',
            //for control
            'id'    => "fields_id",
            'type'  => 'text',
            'label' => "Field Label",
            'section' => '',
            "settigns" => ''
        )
    ),
    'sections' => null
);