<?php
/**
 * Videoblog Theme Customizer.
 *
 * @package Videoblog
 */

/**
 * Sets up the WordPress core custom header and custom background features.
 *
 * @since Videoblog 1.0
 *
 * @see videoblog_header_style()
 */
function videoblog_custom_header_and_background() {
	$color_scheme             = videoblog_get_color_scheme();
	$default_background_color = sanitize_hex_color_no_hash( $color_scheme[0], '#' );
	$default_text_color       = sanitize_hex_color_no_hash( $color_scheme[4], '#' );

	/**
	 * Filter the arguments used when adding 'custom-background' support in Videoblog.
	 *
	 * @since Videoblog 1.0
	 *
	 * @param array $args {
	 *     An array of custom-background support arguments.
	 *
	 *     @type string $default-color Default color of the background.
	 * }
	 */
	add_theme_support( 'custom-background', apply_filters( 'videoblog_custom_background_args', array(
		'default-color' => $default_background_color,
	) ) );

}
add_action( 'after_setup_theme', 'videoblog_custom_header_and_background' );

// Extra styles
function videoblog_customizer_stylesheet() {
	
	// Stylesheet
	wp_enqueue_style( 'videoblog-customizer-css', get_template_directory_uri().'/inc/customizer-styles.css', NULL, NULL, 'all' );
	
}

if ( ! function_exists( 'videoblog_header_style' ) ) :
/**
 * Styles the header text displayed on the site.
 *
 * Create your own videoblog_header_style() function to override in a child theme.
 *
 * @since Videoblog 1.0.0
 *
 * @see videoblog_custom_header_and_background().
 */
	function videoblog_header_style() {
	// If the header text option is untouched, let's bail.
	if ( display_header_text() ) {
		return;
	}

	// If the header text has been hidden.
	?>
	<style type="text/css" id="videoblog-header-css">
		.site-branding .site-title,
		.site-branding .site-description {
			clip: rect(1px, 1px, 1px, 1px);
			position: absolute;
		}
	</style>
	<?php
	}
endif; // videoblog_header_style

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function videoblog_customize_register( $wp_customize ) {

	// Custom help section
	class Videoblog_WP_Help_Customize_Control extends WP_Customize_Control {
		public $type = 'text_help';
		public function render_content() {
			$videoblog_ep_activated = '';
			if ( get_option( 'videoblog_ep_license_status' ) == 'valid' ) {
				$videoblog_ep_activated = 'bnt-customizer-ep-active';
			}
			echo '
				<div class="bnt-customizer-help">
					<a class="bnt-customizer-link bnt-support-link" href="https://www.ilovewp.com/documentation/videoblog/" target="_blank">
						<span class="dashicons dashicons-book">
						</span>
						'.esc_html__( 'Theme Documentation', 'videoblog' ).'
					</a>
					<a class="bnt-customizer-link bnt-support-link" href="https://www.ilovewp.com/themes/videoblog/" target="_blank">
						<span class="dashicons dashicons-info">
						</span>
						'.esc_html__( 'Official Theme Page', 'videoblog' ).'
					</a>
					<a class="bnt-customizer-link bnt-support-link" href="https://wordpress.org/support/theme/videoblog/" target="_blank">
						<span class="dashicons dashicons-sos">
						</span>
						'.esc_html__( 'Support Forum', 'videoblog' ).'
					</a>
					<a class="bnt-customizer-link bnt-rate-link" href="https://wordpress.org/support/theme/videoblog/reviews/" target="_blank">
						<span class="dashicons dashicons-heart">
						</span>
						'.esc_html__( 'Rate Videoblog', 'videoblog' ).'
					</a>
				</div>
			';
		}
	}

	$color_scheme = videoblog_get_color_scheme();
	
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';

		$wp_customize->add_section( 
			'videoblog_theme_support', 
			array(
				'title' => esc_html__( 'Theme Help & Support', 'videoblog' ),
				'priority' => 19,
			) 
		);
		
		$wp_customize->add_setting( 
			'videoblog_support', 
			array(
				'type' => 'theme_mod',
				'default' => '',
				'sanitize_callback' => 'esc_attr',
			)
		);
		$wp_customize->add_control(
			new Videoblog_WP_Help_Customize_Control(
			$wp_customize,
			'videoblog_support', 
				array(
					'section' => 'videoblog_theme_support',
					'type' => 'text_help',
				)
			)
		);

		// Add page background color setting and control.
		$wp_customize->add_setting( 'page_background_color', array(
			'default'           => $color_scheme[1],
			'sanitize_callback' => 'sanitize_hex_color',
		) );
	
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'page_background_color', array(
			'label'       => __( 'Page Background Color', 'videoblog' ),
			'section'     => 'colors',
		) ) );

		$wp_customize->add_setting( 'header_background_color', array(
			'default'           => $color_scheme[2],
			'sanitize_callback' => 'sanitize_hex_color',
		) );
	
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_background_color', array(
			'label'       => __( 'Header Background Color', 'videoblog' ),
			'section'     => 'colors',
		) ) );

		$wp_customize->add_setting( 'footer_background_color', array(
			'default'           => $color_scheme[7],
			'sanitize_callback' => 'sanitize_hex_color',
		) );
	
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer_background_color', array(
			'label'       => __( 'Footer Background Color', 'videoblog' ),
			'section'     => 'colors',
		) ) );
	
		// Remove the core header textcolor control, as it shares the main text color.
		$wp_customize->remove_control( 'header_textcolor' );
	
		// Add link color setting and control.
		$wp_customize->add_setting( 'link_color', array(
			'default'           => $color_scheme[3],
			'sanitize_callback' => 'sanitize_hex_color',
		) );
	
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'link_color', array(
			'label'       => __( 'Link Color', 'videoblog' ),
			'section'     => 'colors',
		) ) );

		// Add link color setting and control.
		$wp_customize->add_setting( 'link_color_hover', array(
			'default'           => $color_scheme[4],
			'sanitize_callback' => 'sanitize_hex_color',
		) );
	
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'link_color_hover', array(
			'label'       => __( 'Link Color :hover', 'videoblog' ),
			'section'     => 'colors',
		) ) );
	
		// Add main text color setting and control.
		$wp_customize->add_setting( 'main_text_color', array(
			'default'           => $color_scheme[5],
			'sanitize_callback' => 'sanitize_hex_color',
		) );
	
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'main_text_color', array(
			'label'       => __( 'Main Text Color', 'videoblog' ),
			'section'     => 'colors',
		) ) );
	
		// Add secondary text color setting and control.
		$wp_customize->add_setting( 'secondary_text_color', array(
			'default'           => $color_scheme[6],
			'sanitize_callback' => 'sanitize_hex_color',
		) );
	
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'secondary_text_color', array(
			'label'       => __( 'Secondary Text Color', 'videoblog' ),
			'section'     => 'colors',
		) ) );

		$wp_customize->add_setting( 'main_menu_background_color', array(
			'default'           => $color_scheme[8],
			'sanitize_callback' => 'sanitize_hex_color',
		) );
	
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'main_menu_background_color', array(
			'label'       => __( 'Main Menu Background Color', 'videoblog' ),
			'section'     => 'colors',
		) ) );

		$wp_customize->add_setting( 'highlight_background_color', array(
			'default'           => $color_scheme[9],
			'sanitize_callback' => 'sanitize_hex_color',
		) );
	
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'highlight_background_color', array(
			'label'       => __( 'Highlight Background Color', 'videoblog' ),
			'section'     => 'colors',
		) ) );

	$wp_customize->add_panel( 'videoblog_panel', array(
		'priority'       => 130,
		'capability'     => 'edit_theme_options',
		'theme_supports' => '',
		'title'          => esc_html__( 'Theme Options', 'videoblog' ),
		'description'    => esc_html__( 'Videoblog Theme Options', 'videoblog' ),
	) );

	$wp_customize->add_section( 'videoblog_front_page', array(
		'title'		  => esc_html__( 'Front Page', 'videoblog' ),
		'panel'		  => 'videoblog_panel',
	) );

		// Featured Posts checkbox
		$wp_customize->add_setting( 'videoblog_front_featured_posts', array(
			'default'           => 1,
			'sanitize_callback' => 'videoblog_sanitize_checkbox',
		) );

		$wp_customize->add_control( 'videoblog_front_featured_posts', array(
			'label'             => esc_html__( 'Show Featured Posts Section on the Front Page', 'videoblog' ),
			'section'           => 'videoblog_front_page',
			'type'              => 'checkbox',
		) );

		// Featured Posts Options
		$wp_customize->add_setting( 'videoblog_featured_term_1', array(
			'default'           => 'featured',
			'sanitize_callback' => 'videoblog_sanitize_terms',
		) );

		$wp_customize->add_control( 'videoblog_featured_term_1', array(
			'label'             => esc_html__( 'Front Page: Featured Tag', 'videoblog' ),
			'description'		=> /* translators: posts tags URL */ sprintf( wp_kses( __( 'This list is populated with <a href="%1$s">Post Tags</a>.', 'videoblog' ), array( 'a' => array( 'href' => array() ) ) ), esc_url( admin_url( 'edit-tags.php?taxonomy=post_tag' ) ) ),
			'section'           => 'videoblog_front_page',
			'type'              => 'select',
			'choices' 			=> videoblog_get_terms(),
		) );

		// Featured Categories checkbox
		$wp_customize->add_setting( 'videoblog_front_featured_categories', array(
			'default'           => 0,
			'sanitize_callback' => 'videoblog_sanitize_checkbox',
		) );

		$wp_customize->add_control( 'videoblog_front_featured_categories', array(
			'label'             => esc_html__( 'Show Featured Categories Section on the Front Page', 'videoblog' ),
			'section'           => 'videoblog_front_page',
			'type'              => 'checkbox',
		) );
		
		// Featured Categories
		$wp_customize->add_setting( 'videoblog_featured_category_1', array(
			'default'           => 'none',
			'sanitize_callback' => 'videoblog_sanitize_categories',
		) );

		$wp_customize->add_control( 'videoblog_featured_category_1', array(
			'label'             => esc_html__( 'Front Page: Featured Category #1', 'videoblog' ),
			'description'		=> /* translators: posts categories URL */ sprintf( wp_kses( __( 'This list is populated with <a href="%1$s">Categories</a>.', 'videoblog' ), array( 'a' => array( 'href' => array() ) ) ), esc_url( admin_url( 'edit-tags.php?taxonomy=category' ) ) ),
			'section'           => 'videoblog_front_page',
			'type'              => 'select',
			'choices' 			=> videoblog_get_categories(),
		) );

		$wp_customize->add_setting( 'videoblog_featured_category_color_1', array(
			'default'           => 'black',
			'sanitize_callback' => 'videoblog_sanitize_widget_style'
		) );

		$wp_customize->add_control( 'videoblog_featured_category_color_1', array(
		'label'       => esc_html__( 'Featured Category #1 Color Style', 'videoblog' ),
		'section'     => 'videoblog_front_page',
		'type'        => 'select',
		'description' => esc_html( 'Set the color for the category title.', 'videoblog' ),
		'choices'     => array(
			'black' => esc_html__( 'Black', 'videoblog' ),
			'blue' => esc_html__( 'Blue', 'videoblog' ),
			'green' => esc_html__( 'Green', 'videoblog' ),
			'red' => esc_html__( 'Red', 'videoblog' ),
			'yellow'   => esc_html__( 'Yellow', 'videoblog' ),
		),
		) );

		$wp_customize->add_setting( 'videoblog_featured_category_2', array(
			'default'           => 'none',
			'sanitize_callback' => 'videoblog_sanitize_categories',
		) );

		$wp_customize->add_control( 'videoblog_featured_category_2', array(
			'label'             => esc_html__( 'Front Page: Featured Category #2', 'videoblog' ),
			'description'		=> /* translators: posts categories URL */ sprintf( wp_kses( __( 'This list is populated with <a href="%1$s">Categories</a>.', 'videoblog' ), array( 'a' => array( 'href' => array() ) ) ), esc_url( admin_url( 'edit-tags.php?taxonomy=category' ) ) ),
			'section'           => 'videoblog_front_page',
			'type'              => 'select',
			'choices' 			=> videoblog_get_categories(),
		) );

		$wp_customize->add_setting( 'videoblog_featured_category_color_2', array(
			'default'           => 'black',
			'sanitize_callback' => 'videoblog_sanitize_widget_style'
		) );

		$wp_customize->add_control( 'videoblog_featured_category_color_2', array(
		'label'       => esc_html__( 'Featured Category #2 Color Style', 'videoblog' ),
		'section'     => 'videoblog_front_page',
		'type'        => 'select',
		'description' => esc_html( 'Set the color for the category title.', 'videoblog' ),
		'choices'     => array(
			'black' => esc_html__( 'Black', 'videoblog' ),
			'blue' => esc_html__( 'Blue', 'videoblog' ),
			'green' => esc_html__( 'Green', 'videoblog' ),
			'red' => esc_html__( 'Red', 'videoblog' ),
			'yellow'   => esc_html__( 'Yellow', 'videoblog' ),
		),
		) );
		
		$wp_customize->add_setting( 'videoblog_featured_category_3', array(
			'default'           => 'none',
			'sanitize_callback' => 'videoblog_sanitize_categories',
		) );

		$wp_customize->add_control( 'videoblog_featured_category_3', array(
			'label'             => esc_html__( 'Front Page: Featured Category #3', 'videoblog' ),
			'description'		=> /* translators: posts categories URL */ sprintf( wp_kses( __( 'This list is populated with <a href="%1$s">Categories</a>.', 'videoblog' ), array( 'a' => array( 'href' => array() ) ) ), esc_url( admin_url( 'edit-tags.php?taxonomy=category' ) ) ),
			'section'           => 'videoblog_front_page',
			'type'              => 'select',
			'choices' 			=> videoblog_get_categories(),
		) );

		$wp_customize->add_setting( 'videoblog_featured_category_color_3', array(
			'default'           => 'black',
			'sanitize_callback' => 'videoblog_sanitize_widget_style'
		) );

		$wp_customize->add_control( 'videoblog_featured_category_color_3', array(
		'label'       => esc_html__( 'Featured Category #3 Color Style', 'videoblog' ),
		'section'     => 'videoblog_front_page',
		'type'        => 'select',
		'description' => esc_html( 'Set the color for the category title.', 'videoblog' ),
		'choices'     => array(
			'black' => esc_html__( 'Black', 'videoblog' ),
			'blue' => esc_html__( 'Blue', 'videoblog' ),
			'green' => esc_html__( 'Green', 'videoblog' ),
			'red' => esc_html__( 'Red', 'videoblog' ),
			'yellow'   => esc_html__( 'Yellow', 'videoblog' ),
		),
		) );

	return $wp_customize;

}
add_action( 'customize_register', 'videoblog_customize_register' );


if ( ! function_exists( 'videoblog_get_terms' ) ) :
/**
 * Return an array of tag names and slugs
 *
 * @since 1.0.0.
 *
 * @return array                The list of terms.
 */
function videoblog_get_terms() {

	$choices = array( 0 );

	// Default
	$choices = array( 'none' => esc_html__( 'None', 'videoblog' ) );

	// Post Tags
	$type_terms = get_terms( 'post_tag' );
	if ( ! empty( $type_terms ) ) {
		$type_slugs = wp_list_pluck( $type_terms, 'slug' );
		$type_names = wp_list_pluck( $type_terms, 'name' );
		$type_list = array_combine( $type_slugs, $type_names );
		$choices = $choices + $type_list;
	}

	return apply_filters( 'videoblog_get_terms', $choices );
}
endif;

if ( ! function_exists( 'videoblog_sanitize_terms' ) ) :
/**
 * Sanitize a value from a list of allowed values.
 *
 * @since 1.0.0.
 *
 * @param  mixed    $value      The value to sanitize.
 * @return mixed                The sanitized value.
 */
function videoblog_sanitize_terms( $value ) {

	$choices = videoblog_get_terms();
	$valid	 = array_keys( $choices );

	if ( ! in_array( $value, $valid ) ) {
		$value = 'none';
	}

	return $value;
}
endif;

if ( ! function_exists( 'videoblog_get_categories' ) ) :
/**
 * Return an array of tag names and slugs
 *
 * @since 1.0.0.
 *
 * @return array                The list of terms.
 */
function videoblog_get_categories() {

	$choices = array( 0 );

	// Default
	$choices = array( 'none' => esc_html__( 'None', 'videoblog' ) );

	// Categories
	$type_terms = get_terms( 'category' );
	if ( ! empty( $type_terms ) ) {

		$type_names = wp_list_pluck( $type_terms, 'name', 'term_id' );
		$choices = $choices + $type_names;

	}

	return apply_filters( 'videoblog_get_categories', $choices );
}
endif;

if ( ! function_exists( 'videoblog_sanitize_categories' ) ) :
/**
 * Sanitize a value from a list of allowed values.
 *
 * @since 1.0.0.
 *
 * @param  mixed    $value      The value to sanitize.
 * @return mixed                The sanitized value.
 */
function videoblog_sanitize_categories( $value ) {

	$choices = videoblog_get_categories();
	$valid	 = array_keys( $choices );

	if ( ! in_array( $value, $valid ) ) {
		$value = 'none';
	}

	return $value;
}
endif;

if ( ! function_exists( 'videoblog_sanitize_checkbox' ) ) :
/**
 * Sanitize the checkbox.
 *
 * @param  mixed 	$input.
 * @return boolean	(true|false).
 */
function videoblog_sanitize_checkbox( $input ) {
	if ( 1 == $input ) {
		return true;
	} else {
		return false;
	}
}
endif;

if ( ! function_exists( 'videoblog_sanitize_widget_style' ) ) :
/**
 * Sanitize the Featured Category color style.
 *
 * @param  boolean	$input.
 * @return boolean	(true|false).
 */
function videoblog_sanitize_widget_style( $input ) {
	$choices = array( 'black', 'blue', 'green', 'red', 'yellow' );

	if ( ! in_array( $input, $choices ) ) {
		$input = 'black';
	}

	return $input;
}
endif;

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function videoblog_customize_preview_js() {
	wp_enqueue_script( 'videoblog_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20160513', true );
}
add_action( 'customize_preview_init', 'videoblog_customize_preview_js' );

/**
 * Registers color schemes for Videoblog.
 *
 * Can be filtered with {@see 'videoblog_color_schemes'}.
 *
 * The order of colors in a colors array:
 * 1. Main Background Color.
 * 2. Page Background Color.
 * 3. Link Color.
 * 4. Main Text Color.
 * 5. Secondary Text Color.
 *
 * @since Videoblog 1.0
 *
 * @return array An associative array of color scheme options.
 */
function videoblog_get_color_schemes() {
	/**
	 * Filter the color schemes registered for use with Videoblog.
	 *
	 * The default schemes include 'default', 'dark', 'gray', 'red', and 'yellow'.
	 *
	 * @since Videoblog 1.0
	 *
	 * @param array $schemes {
	 *     Associative array of color schemes data.
	 *
	 *     @type array $slug {
	 *         Associative array of information for setting up the color scheme.
	 *
	 *         @type string $label  Color scheme label.
	 *         @type array  $colors HEX codes for default colors prepended with a hash symbol ('#').
	 *                              Colors are defined in the following order: Main background, page
	 *                              background, link, main text, secondary text.
	 *     }
	 * }
	 */
	 
	return apply_filters( 'videoblog_color_schemes', array(
		'default' => array(
			'label'  => __( 'Default', 'videoblog' ),
			'colors' => array(
				'#ffffff', // [0] background color 
				'#ffffff', // [1] content container background color
				'#ffffff', // [2] header background color 
				'#007ac9', // [3] link color
				'#e95445', // [4] link :hover color
				'#393939', // [5] main text color
				'#888888', // [6] secondary text color
				'#1a1a1a', // [7] footer background color
				'#262626', // [8] main menu background color
				'#78bf6b', // [9] highlight background color
			),
		),
	) );
}

if ( ! function_exists( 'videoblog_get_color_scheme' ) ) :
/**
 * Retrieves the current Videoblog color scheme.
 *
 * Create your own videoblog_get_color_scheme() function to override in a child theme.
 *
 * @since Videoblog 1.0
 *
 * @return array An associative array of either the current or default color scheme HEX values.
 */
function videoblog_get_color_scheme() {
	$color_scheme_option = get_theme_mod( 'color_scheme', 'default' );
	$color_schemes       = videoblog_get_color_schemes();

	if ( array_key_exists( $color_scheme_option, $color_schemes ) ) {
		return $color_schemes[ $color_scheme_option ]['colors'];
	}

	return $color_schemes['default']['colors'];
}
endif; // videoblog_get_color_scheme


/**
 * Enqueues front-end CSS for the page background color.
 *
 * @since Videoblog 1.0
 *
 * @see wp_add_inline_style()
 */
function videoblog_page_background_color_css() {
	$color_scheme          = videoblog_get_color_scheme();
	$default_color         = $color_scheme[1];
	$page_background_color = get_theme_mod( 'page_background_color', $default_color );

	// Don't do anything if the current color is the default.
	if ( $page_background_color === $default_color ) {
		return;
	}

	$css = '
		/* Custom Page Background Color */
		.site-content-wrapper {
			background-color: %1$s;
		}
	';

	wp_add_inline_style( 'videoblog-style', sprintf( $css, esc_attr($page_background_color ) ) );
}
add_action( 'wp_enqueue_scripts', 'videoblog_page_background_color_css', 11 );

/**
 * Enqueues front-end CSS for the header background color.
 *
 * @since Videoblog 1.0
 *
 * @see wp_add_inline_style()
 */
function videoblog_header_background_color_css() {
	$color_scheme          = videoblog_get_color_scheme();
	$default_color         = $color_scheme[1];
	$header_background_color = get_theme_mod( 'header_background_color', $default_color );

	// Don't do anything if the current color is the default.
	if ( $header_background_color === $default_color ) {
		return;
	}

	$css = '
		/* Custom Header Background Color */
		.site-header {
			background-color: %1$s;
		}
	';

	wp_add_inline_style( 'videoblog-style', sprintf( $css, esc_attr($header_background_color ) ) );
}
add_action( 'wp_enqueue_scripts', 'videoblog_header_background_color_css', 11 );

/**
 * Enqueues front-end CSS for the footer background color.
 *
 * @since Videoblog 1.0
 *
 * @see wp_add_inline_style()
 */
function videoblog_footer_background_color_css() {
	$color_scheme          = videoblog_get_color_scheme();
	$default_color         = $color_scheme[1];
	$footer_background_color = get_theme_mod( 'footer_background_color', $default_color );

	// Don't do anything if the current color is the default.
	if ( $footer_background_color === $default_color ) {
		return;
	}

	$css = '
		/* Custom Footer Background Color */
		.site-footer {
			background-color: %1$s;
		}
	';

	wp_add_inline_style( 'videoblog-style', sprintf( $css, esc_attr($footer_background_color ) ) );
}
add_action( 'wp_enqueue_scripts', 'videoblog_footer_background_color_css', 11 );

/**
 * Enqueues front-end CSS for the Main Menu background color.
 *
 * @since Videoblog 1.0
 *
 * @see wp_add_inline_style()
 */
function videoblog_main_menu_background_color_css() {
	$color_scheme          = videoblog_get_color_scheme();
	$default_color         = $color_scheme[8];
	$menu_background_color = get_theme_mod( 'main_menu_background_color', $default_color );

	// Don't do anything if the current color is the default.
	if ( $menu_background_color === $default_color ) {
		return;
	}

	$css = '
		/* Custom Main Menu Background Color */
		#menu-main {
			background-color: %1$s;
		}

		.site-header .wrapper-header a:hover,
		.site-header .wrapper-header a:focus,
		.site-footer a:hover,
		.site-footer a:focus {
			color: %1$s;
		}
	';

	wp_add_inline_style( 'videoblog-style', sprintf( $css, esc_attr($menu_background_color ) ) );
}
add_action( 'wp_enqueue_scripts', 'videoblog_main_menu_background_color_css', 11 );

/**
 * Enqueues front-end CSS for the Highlights background color.
 *
 * @since Videoblog 1.0
 *
 * @see wp_add_inline_style()
 */
function videoblog_highlight_background_color_css() {
	$color_scheme          = videoblog_get_color_scheme();
	$default_color         = $color_scheme[9];
	$highlight_background_color = get_theme_mod( 'highlight_background_color', $default_color );

	// Don't do anything if the current color is the default.
	if ( $highlight_background_color === $default_color ) {
		return;
	}

	$css = '
		/* Custom Highlight Background Color */
		.infinite-scroll #infinite-handle span{
			background-color: %1$s;
		}
	';

	wp_add_inline_style( 'videoblog-style', sprintf( $css, esc_attr($highlight_background_color ) ) );
}
add_action( 'wp_enqueue_scripts', 'videoblog_highlight_background_color_css', 11 );

/**
 * Enqueues front-end CSS for the link color.
 *
 * @since Videoblog 1.0
 *
 * @see wp_add_inline_style()
 */
function videoblog_link_color_css() {
	$color_scheme    = videoblog_get_color_scheme();
	$default_color   = $color_scheme[2];
	$link_color = get_theme_mod( 'link_color', $default_color );

	// Don't do anything if the current color is the default.
	if ( $link_color === $default_color ) {
		return;
	}

	$css = '
		/* Custom Link Color */
		a {
			color: %1$s;
		}
	';

	wp_add_inline_style( 'videoblog-style', sprintf( $css, esc_attr($link_color ) ) );
}
add_action( 'wp_enqueue_scripts', 'videoblog_link_color_css', 11 );

/**
 * Enqueues front-end CSS for the link :hover color.
 *
 * @since Videoblog 1.0
 *
 * @see wp_add_inline_style()
 */
function videoblog_link_color_hover_css() {
	$color_scheme    = videoblog_get_color_scheme();
	$default_color   = $color_scheme[3];
	$link_color = get_theme_mod( 'link_color_hover', $default_color );

	// Don't do anything if the current color is the default.
	if ( $link_color === $default_color ) {
		return;
	}

	$css = '
		/* Custom Link:hover Color */
		a:hover,
		a:focus,
		.ilovewp-post .post-meta .entry-date a:hover,
		.ilovewp-post .post-meta .entry-date a:focus,
		h1 a:hover, h2 a:hover, h3 a:hover, h4 a:hover, h5 a:hover, h6 a:hover,
		h1 a:focus, h2 a:focus, h3 a:focus, h4 a:focus, h5 a:focus, h6 a:focus {
			color: %1$s;
		}
	';

	wp_add_inline_style( 'videoblog-style', sprintf( $css, esc_attr($link_color ) ) );
}
add_action( 'wp_enqueue_scripts', 'videoblog_link_color_hover_css', 11 );

/**
 * Enqueues front-end CSS for the main text color.
 *
 * @since Videoblog 1.0
 *
 * @see wp_add_inline_style()
 */
function videoblog_main_text_color_css() {
	$color_scheme    = videoblog_get_color_scheme();
	$default_color   = $color_scheme[4];
	$main_text_color = get_theme_mod( 'main_text_color', $default_color );

	// Don't do anything if the current color is the default.
	if ( $main_text_color === $default_color ) {
		return;
	}

	$css = '
		/* Custom Main Text Color */
		body {
			color: %1$s
		}
	';

	wp_add_inline_style( 'videoblog-style', sprintf( $css, esc_attr($main_text_color ) ) );
}
add_action( 'wp_enqueue_scripts', 'videoblog_main_text_color_css', 11 );

/**
 * Enqueues front-end CSS for the secondary text color.
 *
 * @since Videoblog 1.0
 *
 * @see wp_add_inline_style()
 */
function videoblog_secondary_text_color_css() {
	$color_scheme    = videoblog_get_color_scheme();
	$default_color   = $color_scheme[4];
	$secondary_text_color = get_theme_mod( 'secondary_text_color', $default_color );

	// Don't do anything if the current color is the default.
	if ( $secondary_text_color === $default_color ) {
		return;
	}

	$css = '
		/* Custom Secondary Text Color */

		body:not(.search-results) .entry-summary {
			color: %1$s;
		}

		.post-meta,
		.ilovewp-post .post-meta {
			color: %1$s;
		}
	';

	wp_add_inline_style( 'videoblog-style', sprintf( $css, esc_attr($secondary_text_color ) ) );
}
add_action( 'wp_enqueue_scripts', 'videoblog_secondary_text_color_css', 11 );