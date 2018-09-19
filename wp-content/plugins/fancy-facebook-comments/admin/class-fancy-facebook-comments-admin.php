<?php

/**
 * Contains functions responsible for functionality at admin side
 *
 * @since      1.0
 *
 */

/**
 * This class defines all code necessary for functionality at admin side
 *
 * @since      1.0
 *
 */
class Fancy_Facebook_Comments_Admin {

	/**
	 * Options saved in database.
	 *
	 * @since    1.0
	 */
	private $options;

	/**
	 * Current version of the plugin.
	 *
	 * @since    1.0
	 */
	private $version;

	/**
	 * Flag to check if BuddyPress is active.
	 *
	 * @since    1.0
	 */
	private $is_bp_active = false;

	/**
	 * Get saved options.
	 *
	 * @since    1.0
     * @param    array    $options    Plugin options saved in database
	 */
	public function __construct( $options, $version ) {

		$this->options = $options;
		$this->version = $version;

	}

	/**
	 * Creates plugin menu in admin area
	 *
	 * @since    1.0
	 */
	public function create_admin_menu() {

		$page = add_menu_page( __( 'Fancy Facebook Comments by Heateor', 'fancy-facebook-comments' ), 'Fancy Facebook Comments', 'manage_options', 'heateor-ffc-options', array( $this, 'options_page' ), plugins_url( '../images/logo.png', __FILE__ ) );
		// options
		$options_page = add_submenu_page( 'heateor-ffc-options', __( "Fancy Facebook Comments - General Options", 'fancy-facebook-comments' ), __( "Fancy Facebook Comments", 'fancy-facebook-comments' ), 'manage_options', 'heateor-ffc-options', array( $this, 'options_page' ) );
		add_action( 'admin_print_scripts-' . $page, array( $this, 'admin_scripts' ) );
		add_action( 'admin_print_scripts-' . $page, array( $this, 'admin_style' ) );
		add_action( 'admin_print_scripts-' . $page, array( $this, 'fb_sdk_script' ) );
		add_action( 'admin_print_scripts-' . $options_page, array( $this, 'admin_scripts' ) );
		add_action( 'admin_print_scripts-' . $options_page, array( $this, 'fb_sdk_script' ) );
		add_action( 'admin_print_styles-' . $options_page, array( $this, 'admin_style' ) );
	
	}

	/**
	 * Register plugin settings and its sanitization callback.
	 *
	 * @since    1.0
	 */
	public function options_init() {

		register_setting( 'heateor_ffc_options', 'heateor_ffc', array( $this, 'validate_options' ) );

		// show option to disable Facebook Comments on individual page/post
		$post_types = get_post_types( array( 'public' => true ), 'names', 'and' );
		$post_types = array_unique( array_merge( $post_types, array( 'post', 'page' ) ) );
		foreach ( $post_types as $type ) {
			add_meta_box( 'heateor_ffc_meta', 'Fancy Facebook Comments', array( $this, 'meta_options_setup' ), $type );
		}
		// save sharing meta on post/page save
		add_action( 'save_post', array( $this, 'save_meta_options' ) );
		
	}

	/**
	 * Show meta options
	 *
	 * @since    1.1.1
	 */
	public function meta_options_setup() {

		global $post;
		$postType = $post->post_type;
		$meta = get_post_meta( $post->ID, '_heateor_ffc_meta', true );
		?>
		<p>
			<label for="heateor_ffc">
				<input type="checkbox" name="_heateor_ffc_meta[facebook_comments]" id="heateor_ffc" value="1" <?php checked( '1', @$meta['facebook_comments'] ); ?> />
				<?php _e( 'Disable Facebook Comments on this ' . $postType, 'fancy-facebook-comments' ) ?>
			</label>
		</p>
		<?php
	    echo '<input type="hidden" name="heateor_ffc_meta_nonce" value="' . wp_create_nonce( __FILE__ ) . '" />';
	
	}

	/**
	 * Save meta fields
	 *
	 * @since    1.1.1
	 */
	public function save_meta_options( $post_id ) {
	    
	    // make sure data came from our meta box
	    if ( ! isset( $_POST['heateor_ffc_meta_nonce'] ) || ! wp_verify_nonce( $_POST['heateor_ffc_meta_nonce'], __FILE__ ) ) {
			return $post_id;
	 	}
	    // check user permissions
	    if ( $_POST['post_type'] == 'page' ) {
	        if ( ! current_user_can( 'edit_page', $post_id ) ) {
				return $post_id;
	    	}
		} else {
	        if ( ! current_user_can( 'edit_post', $post_id ) ) {
				return $post_id;
	    	}
		}
	    if ( isset( $_POST['_heateor_ffc_meta'] ) ) {
			$newData = $_POST['_heateor_ffc_meta'];
		} else {
			$newData = array( 'facebook_comments' => 0 );
		}
		update_post_meta( $post_id, '_heateor_ffc_meta', $newData );

	    return $post_id;

	}

	/**
	 * Update options in all the old blogs.
	 *
	 * @since    1.0
	 */
	public function update_old_blogs( $old_config ) {
		
		$option_parts = explode( '_', current_filter() );
		$option = $option_parts[2] . '_' . $option_parts[3] . '_' . $option_parts[4];
		$new_config = get_option( $option );
		if ( isset( $new_config['config_multisite'] ) && $new_config['config_multisite'] == 1 ) {
			$blogs = get_blog_list( 0, 'all' );
			foreach ( $blogs as $blog ) {
				update_blog_option( $blog['blog_id'], $option, $new_config );
			}
		}
	
	}

	/**
	 * Replicate the options to the new blog created.
	 *
	 * @since    1.0
	 */
	public function replicate_settings( $blog_id ) {

		add_blog_option( $blog_id, 'heateor_ffc', $this->options );
	
	}

	/** 
	 * Sanitization callback for plugin options.
	 *
     * @since    1.0
	 */ 
	public function validate_options( $heateorFfcOptions ) {
		
		foreach ( $heateorFfcOptions as $k => $v ) {
			if ( is_string( $v ) ) {
				$heateorFfcOptions[$k] = esc_attr( trim( $v ) );
			}
		}
		return $heateorFfcOptions;

	}

	/**
	 * Include Javascript SDK in admin.
	 *
	 * @since    1.0
	 */	
	public function fb_sdk_script() {

		wp_enqueue_script( 'heateor_ffc_fb_sdk_script', plugins_url( 'js/fancy-facebook-comments-fb-sdk.js', __FILE__ ), false, $this->version );
	
	}

	/**
	 * Include CSS files in admin.
	 *
	 * @since    1.0
	 */	
	public function admin_style() {

		wp_enqueue_style( 'heateor_ffc_admin_style', plugins_url( 'css/fancy-facebook-comments-admin.css', __FILE__ ), false, $this->version );
	
	}

	/**
	 * Include javascript files in admin.
	 *
	 * @since    1.0
	 */	
	public function admin_scripts() {
		
		?>
		<script type="text/javascript">var heateorFfcWebsiteUrl = '<?php echo home_url() ?>', heateorFfcHelpBubbleTitle = "<?php echo __( 'Click to show help', 'fancy-facebook-comments' ) ?>", heateorFfcHelpBubbleCollapseTitle = "<?php echo __( 'Click to hide help', 'fancy-facebook-comments' ) ?>", heateorFfcAjaxUrl = '<?php echo get_admin_url() ?>admin-ajax.php';</script>
		<?php
		wp_enqueue_script( 'heateor_ffc_admin_script', plugins_url( 'js/fancy-facebook-comments-admin.js', __FILE__ ), array( 'jquery', 'jquery-ui-tabs' ), $this->version );
	
	}

	/**
	 * Renders options page
	 *
	 * @since    1.0
	 */
	public function options_page() {

		// message on saving options
		echo $this->settings_saved_notification();
		$options = $this->options;
		/**
		 * The file rendering options page
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/fancy-facebook-comments-options-page.php';
	
	}

	/**
	 * Display notification message when plugin options are saved
	 *
	 * @since    1.0
     * @return   string    Notification after saving options
	 */
	private function settings_saved_notification() {

		if ( isset( $_GET['settings-updated'] ) && $_GET['settings-updated'] == 'true' ) {
			return '<div id="setting-error-settings_updated" class="updated settings-error notice is-dismissible below-h2"> 
	<p><strong>' . __( 'Settings saved', 'fancy-facebook-comments' ) . '</strong></p><button type="button" class="notice-dismiss"><span class="screen-reader-text">' . __( 'Dismiss this notice', 'fancy-facebook-comments' ) . '</span></button></div>';
		}
	
	}

	/**
	 * Check if plugin is active
	 *
	 * @since    1.0
	 */
	private function is_plugin_active( $plugin_file ) {
		
		return in_array( $plugin_file, apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) );
	
	}

	/**
	 * Set BuddyPress active flag to true
	 *
	 * @since    1.0
	 */
	public function is_bp_loaded() {
		
		$this->is_bp_active = true;
	
	}

	/**
	 * Show links at "Plugins" page in admin area
	 *
	 * @since    1.0
	 */
	public function add_links( $links ) {
	    
	    $addons_link = '<a href="https://www.heateor.com/add-ons" target="_blank">' . __( 'Add-Ons', 'fancy-facebook-comments' ) . '</a>';
	    $support_link = '<a href="http://support.heateor.com" target="_blank">' . __( 'Support Documentation', 'fancy-facebook-comments' ) . '</a>';
	    $settings_link = '<a href="admin.php?page=heateor-ffc-options">' . __( 'Settings', 'fancy-facebook-comments' ) . '</a>';
	    
	    // place it before other links
		array_unshift( $links, $settings_link );
		
		$links[] = $addons_link;
		$links[] = $support_link;
		
		return $links;

	}

	/**
	 * Update options based on plugin version
	 *
	 * @since    1.1.1
	 */
	public function update_db_check() {

		$current_version = get_option( 'heateor_ffc_version' );
		if ( $current_version != $this->version ) {
			if ( version_compare( '1.1.1', $current_version ) > 0 ) {
				$this->options['priority'] = 99;
				update_option( 'heateor_ffc', $this->options );
			}

			// update plugin version in database
			update_option( 'heateor_ffc_version', $this->version );
		}
	
	}

	/**
	 * Save GDPR notification flag in DB
	 *
	 * @since    1.1.5
	 */
	public function gdpr_notification_read() {

		update_option( 'heateor_ffc_gdpr_notification_read', '1' );
		die;
	
	}

	/**
	 * Show add-on/plugin update notifications
	 *
	 * @since    1.1.5
	 */
	public function addon_update_notifications() {

		$current_version = get_option( 'heateor_ffc_version' );

		if ( current_user_can( 'manage_options' ) ) {
			if ( defined( 'HEATEOR_FB_COM_MOD_VERSION' ) && version_compare( '1.2.4', HEATEOR_FB_COM_MOD_VERSION ) > 0 ) {
				?>
				<div class="error notice">
					<h3>Facebook Comments Moderation</h3>
					<p><?php _e( 'Update "Facebook Comments Moderation" add-on for compatibility with current version of Fancy Facebook Comments', 'fancy-facebook-comments' ) ?></p>
				</div>
				<?php
			}

			if ( defined( 'HEATEOR_FB_COM_NOT_VERSION' ) && version_compare( '1.1.6', HEATEOR_FB_COM_NOT_VERSION ) > 0 ) {
				?>
				<div class="error notice">
					<h3>Facebook Comments Notifier</h3>
					<p><?php _e( 'Update "Facebook Comments Notifier" add-on for compatibility with current version of Fancy Facebook Comments', 'fancy-facebook-comments' ) ?></p>
				</div>
				<?php
			}

			if ( version_compare( '1.1.5', $current_version ) <= 0 ) {
				if ( ! get_option( 'heateor_ffc_gdpr_notification_read' ) ) {
					?>
					<script type="text/javascript">
					function heateorFfcGDPRNotificationRead(){
						jQuery.ajax({
							type: 'GET',
							url: '<?php echo get_admin_url() ?>admin-ajax.php',
							data: {
								action: 'heateor_ffc_gdpr_notification_read'
							},
							success: function(data, textStatus, XMLHttpRequest){
								jQuery('#heateor_ffc_gdpr_notification').fadeOut();
							}
						});
					}
					</script>
					<div id="heateor_ffc_gdpr_notification" class="update-nag">
						<h3>Fancy Facebook Comments</h3>
						<p><?php echo sprintf( __( 'This plugin is GDPR compliant. You need to update the privacy policy of your website regarding the personal data this plugin saves, as mentioned <a href="%s" target="_blank">here</a>', 'fancy-facebook-comments' ), 'http://support.heateor.com/gdpr-and-our-plugins' ); ?><input type="button" onclick="heateorFfcGDPRNotificationRead()" style="margin-left: 5px;" class="button button-primary" value="<?php _e( 'Okay', 'fancy-facebook-comments' ) ?>" /></p>
					</div>
					<?php
				}
			}
		}
	
	}

}
