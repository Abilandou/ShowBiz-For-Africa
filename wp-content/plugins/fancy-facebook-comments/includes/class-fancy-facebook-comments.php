<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @since      1.0
 *
 */

/**
 * The core plugin class.
 *
 * This is used to define hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0
 */
class Fancy_Facebook_Comments {

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0
	 */
	protected $plugin_slug;

	/**
	 * Current version of the plugin.
	 *
	 * @since    1.0
	 */
	protected $version;

	/**
	 * Options saved in database.
	 *
	 * @since    1.0
	 */
	public $options;

	/**
	 * Member to assign object of Fancy_Facebook_Comments_Public Class.
	 *
	 * @since    1.0
	 */
	public $plugin_public;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * @since    1.0
	 */
	public function __construct( $version ) {

		$this->plugin_slug = 'fancy-facebook-comments';
		$this->version = $version;
		$this->options = get_option( 'heateor_ffc' );

		$this->load_dependencies();
		$this->set_locale();
		$this->call_admin_hooks();
		$this->call_public_hooks();
	
		$this->define_shortcodes();
		$this->define_widgets();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * @since    1.0
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for defining all functions for the functionality that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-fancy-facebook-comments-admin.php';

		/**
		 * The class responsible for defining all functions for the functionality that occur at front-end of website.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-fancy-facebook-comments-public.php';

		/**
		 * The class responsible for defining all functions for widgets.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-fancy-facebook-comments-widgets.php';

		/**
		 * The class responsible for defining all shortcode functions.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-fancy-facebook-comments-shortcodes.php';

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * @since    1.0
	 */
	private function set_locale() {

		load_plugin_textdomain( 'fancy-facebook-comments', false, plugin_dir_path( dirname( __FILE__ ) ) . '/languages/' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality of the plugin.
	 *
	 * @since    1.0
	 */
	private function call_admin_hooks() {

		// create object of admin class to pass options
		$plugin_admin = new Fancy_Facebook_Comments_Admin( $this->options, $this->version );
		
		// hook to upate plugin db/options based on version
		add_action( 'plugins_loaded', array( $plugin_admin, 'update_db_check' ) );
		// hook to show notification related to add-on/plugin updates
		add_action( 'admin_notices', array( $plugin_admin, 'addon_update_notifications' ) );
		// save GDPR notification flag in DB
		add_action( 'wp_ajax_heateor_ffc_gdpr_notification_read', array( $plugin_admin, 'gdpr_notification_read' ) );
		// create admin menu
		add_action( 'admin_menu', array( $plugin_admin, 'create_admin_menu' ) );
		// check if BuddyPress is active
		add_action( 'bp_include', array( $plugin_admin, 'is_bp_loaded' ) );
		// set sanitization callback for plugin options
		add_action( 'admin_init', array( $plugin_admin, 'options_init' ) );
		// if multisite is enabled and this is the main website
		if ( is_multisite() && is_main_site() ) {
			// replicate the options to the new blog created
			add_action( 'wpmu_new_blog', array( $plugin_admin, 'replicate_settings' ) );
			// update the options in all the old blogs
			add_action( 'update_option_heateor_ffc', array( $plugin_admin, 'update_old_blogs' ) );
		}
		// add links to settings, add-ons etc. to show at "Plugins" page
		add_filter( 'plugin_action_links_fancy-facebook-comments/fancy-facebook-comments.php', array( $plugin_admin, 'add_links' ) );

	}

	/**
	 * Register all of the hooks related to the front-end functionality of the plugin.
	 *
	 * @since    1.0
	 */
	private function call_public_hooks() {

		// create object of public class to pass options
		$plugin_public = new Fancy_Facebook_Comments_Public( $this->options, $this->version );
		$this->plugin_public = $plugin_public;

		// hooks to enable Facebook Comments
		add_action( 'init', array( $plugin_public, 'render_facebook_comments_at_posts' ) );
		
		if ( isset( $this->options['bp_activity'] ) ) {
			add_action( 'bp_activity_entry_meta', array( $plugin_public, 'render_facebook_comments' ), 999 );
		}
		if ( isset( $this->options['bp_group'] ) || isset( $this->options['vertical_bp_group'] ) ) {
			add_action( 'bp_before_group_header', array( $plugin_public, 'render_facebook_comments' ) );
		}
		add_filter( 'bbp_get_reply_content', array( $plugin_public, 'render_facebook_comments' ) );
		add_filter( 'bbp_template_before_single_forum', array( $plugin_public, 'render_facebook_comments' ) );
		add_filter( 'bbp_template_before_single_topic', array( $plugin_public, 'render_facebook_comments' ) );
		add_filter( 'bbp_template_before_lead_topic', array( $plugin_public, 'render_facebook_comments' ) );
		add_filter( 'bbp_template_after_single_forum', array( $plugin_public, 'render_facebook_comments' ) );
		add_filter( 'bbp_template_after_single_topic', array( $plugin_public, 'render_facebook_comments' ) );
		add_filter( 'bbp_template_after_lead_topic', array( $plugin_public, 'render_facebook_comments' ) );
		// Facebook Comments at WooCommerce pages
		if ( isset( $this->options['woocom_shop'] ) ) {
			add_action( 'woocommerce_after_shop_loop_item', array( $plugin_public, 'render_facebook_comments' ) );
		}
		if ( isset( $this->options['woocom_product'] ) ) {
			add_action( 'woocommerce_share', array( $plugin_public, 'render_facebook_comments' ) );
		}
		if ( isset( $this->options['woocom_thankyou'] ) ) {
			add_action( 'woocommerce_thankyou', array( $plugin_public, 'render_facebook_comments' ) );
		}

	}

	/**
	 * Define widgets
	 *
	 * @since    1.0
	 */
	private function define_widgets() {

		// Facebook Comments widget
		add_action( 'widgets_init', function() { return register_widget( "Fancy_Facebook_Comments_Widget" ); } );
		
	}

	/**
	 * Define shortcodes
	 *
	 * @since    1.0
	 */
	private function define_shortcodes() {

		// create object of shortcode class
		$plugin_shortcodes = new Fancy_Facebook_Comments_Shortcodes( $this->options, $this->plugin_public );

		// shortcode
		add_shortcode( 'Fancy_Facebook_Comments', array( $plugin_shortcodes, 'facebook_comments_shortcode' ) );
		
	}

	/**
	 * Returns the plugin slug
	 *
	 * @since     1.0
	 * @return    string    The plugin slug.
	 */
	public function get_plugin_slug() {

		return $this->plugin_slug;
	
	}

	/**
	 * Retrieve the version number of the plugin
	 *
	 * @since     1.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {

		return $this->version;
	
	}

}
