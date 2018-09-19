<?php
/**
 * --------------------------------------------
 * Enqueue scripts and styles for the backend.
 *
 * @since Videoblog 1.3.6
 * --------------------------------------------
 */

if ( ! function_exists( 'videoblog_scripts_admin' ) ) {
	/**
	 * Enqueue admin styles and scripts
	 *
	 * @since  1.6.0
	 * @return void
	 */
	function videoblog_scripts_admin( $hook ) {
		// if ( 'widgets.php' !== $hook ) return;

		// Styles
		wp_enqueue_style(
			'videoblog-style-admin',
			get_template_directory_uri() . '/ilovewp-admin/css/ilovewp_theme_settings.css',
			'', ILOVEWP_VERSION, 'all'
		);
	}
}
add_action( 'admin_enqueue_scripts', 'videoblog_scripts_admin' );

/*
** Notice after Theme Activation and Update.
*/
function videoblog_activation_notice() {

	$screen = get_current_screen();

	if ( $screen->id == 'appearance_page_videoblog-doc' ) {
		return;
	}

	$theme_data	 = wp_get_theme();

	echo '<div class="notice notice-success videoblog-activation-notice">';
	
		echo '<h1>';
			/* translators: %s theme name */
			printf( esc_html__( 'Welcome to %s', 'videoblog' ), esc_html( $theme_data->Name ) );
		echo '</h1>';

		echo '<p>';
			/* translators: %1$s: theme name, %2$s link */
			printf( __( 'Thank you for choosing %1$s! To fully take advantage of the best our theme can offer please make sure you visit our <a href="%2$s">Welcome page</a>', 'videoblog' ), esc_html( $theme_data->Name ), esc_url( admin_url( 'themes.php?page=videoblog-doc' ) ) );
		echo '</p>';

		echo '<p><a href="'. esc_url( admin_url( 'themes.php?page=videoblog-doc' ) ) .'" class="button button-primary button-hero">';
			/* translators: %s theme name */
			printf( esc_html__( 'Get started with %s', 'videoblog' ), esc_html( $theme_data->Name ) );
		echo '</a></p>';

	echo '</div>';
}

/**
* Display custom admin notice for the recommended number of posts per archive page.
*
* @since Videoblog 1.3.6
*/

// update_user_meta( get_current_user_id(), 'videoblog_admin_notice_postsnum', 'no' );

function videoblog_admin_notice_postsnum() {

	if ( !current_user_can('edit_theme_options') ) {
		return;
	}

	// Bail if the user has previously dismissed the notice (doesn't show the notice)
	if ( get_user_meta( get_current_user_id(), 'videoblog_admin_notice_postsnum', true ) === 'dismissed' ) {
		return;
	}
	
	$videoblog_option_posts_per_page = get_option( 'posts_per_page' );

	if ( $videoblog_option_posts_per_page % 4 == 0 ) {
		return;
	}

	$current_user = wp_get_current_user();

	?><div id="videoblog-admin-notice-postsnum" class="notice notice-info is-dismissible">
		<p><strong><?php _e('Improvement Recommendation:', 'videoblog'); ?></strong> <?php 

		echo sprintf( 
			/* translators: User Display Name, Number of Posts per Archive Page, Link to Settings > Reading, Link to Theme About Page */
			__( '%1$s, your website is set up to display <strong>%2$s</strong> posts per page, but <a href="%4$s">Videoblog Theme</a> works best with multiples of 4, as it displays posts in a grid of 4 (by default). 
				<br>We recommend going to <a href="%3$s">Settings > Reading</a> and changing the <strong>Blog pages show at most</strong> value to a multiple of 4: 4, 8, 12, 16, 20, etc.', 'videoblog' ), 
			$current_user->display_name,
			$videoblog_option_posts_per_page,
			esc_url( admin_url( 'options-reading.php' ) ),
			esc_url( admin_url( 'themes.php?page=videoblog-doc' ) )
			);
		?></p>
	</div><!-- #videoblog-admin-notice-postsnum .notice notice-info .is-dismissible --><?php
}

add_action('admin_notices', 'videoblog_admin_notice_postsnum');

function videoblog_enqueue_admin_scripts() {
	// Add the admin JS if the notice has not been dismissed
	if ( is_admin() && get_user_meta( get_current_user_id(), 'videoblog_admin_notice_postsnum', true ) !== 'dismissed' ) {

		// Adds our JS file to the queue that WordPress will load
		wp_enqueue_script( 'videoblog_admin_notice_script', get_template_directory_uri() . '/inc/theme-enhancements.js', array( 'jquery' ), '20180914', true );

		// Make some data available to our JS file
		wp_localize_script( 'videoblog_admin_notice_script', 'videoblog_admin_notice_postsnum', array(
			'videoblog_admin_notice_nonce' => wp_create_nonce( 'videoblog_admin_notice_nonce' ),
		));
	}
}
add_action( 'admin_enqueue_scripts', 'videoblog_enqueue_admin_scripts' );

/**
 *	Process the AJAX request on the server and send a response back to the JS.
 *	If nonce is valid, update the current user's meta to prevent notice from displaying.
 */
function videoblog_dismiss_admin_notice_postsnum() {
	// Verify the security nonce and die if it fails
	if ( ! isset( $_POST['videoblog_admin_notice_nonce'] ) || ! wp_verify_nonce( $_POST['videoblog_admin_notice_nonce'], 'videoblog_admin_notice_nonce' ) ) {
		wp_die( __( 'Your request failed permission check.', 'videoblog' ) );
	}
	// Store the user's dimissal so that the notice doesn't show again
	update_user_meta( get_current_user_id(), 'videoblog_admin_notice_postsnum', 'dismissed' );
	// Send success message
	wp_send_json( array(
		'status' => 'success',
		'message' => __( 'Your request was processed. See ya!', 'videoblog' )
	) );
}

add_action( 'wp_ajax_videoblog_admin_notice_postsnum', 'videoblog_dismiss_admin_notice_postsnum' );