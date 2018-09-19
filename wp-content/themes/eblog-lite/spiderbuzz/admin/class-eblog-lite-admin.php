<?php
/**
 * eBlog Lite Admin Class.
 *
 * @author  Spiderbuzz
 * @package eBlog Lite
 * @since   
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Eblog_Lite_Admin' ) ) :

/**
 * Eblog_Lite_Admin Class.
 */
class Eblog_Lite_Admin {

	/**
	 * Constructor.
	 */
	public function __construct() {
		add_action( 'admin_menu', array( $this, 'admin_menu' ) );
		add_action( 'wp_loaded', array( __CLASS__, 'hide_notices' ) );
		add_action( 'load-themes.php', array( $this, 'admin_notice' ) );
	}

	/**
	 * Add admin menu.
	 */
	public function admin_menu() {
		$theme = wp_get_theme( get_template() );

		$page = add_theme_page( esc_html__( 'About', 'eblog-lite' ) . ' ' . $theme->display( 'Name' ), esc_html__( 'About', 'eblog-lite' ) . ' ' . $theme->display( 'Name' ), 'activate_plugins', 'eblog-lite-welcome', array( $this, 'welcome_screen' ) );
		add_action( 'admin_print_styles-' . $page, array( $this, 'enqueue_styles' ) );
	}

	/**
	 * Enqueue styles.
	 */
	public function enqueue_styles() {
		global $eblog_lite_version;
		//Enqueue the admin css file
		wp_enqueue_style( 'eblog-lite-welcome', get_template_directory_uri() . '/spiderbuzz/admin/css/admin-welcome.css', array(), $eblog_lite_version );
	}

	/**
	 * Add admin notice.
	 */
	public function admin_notice() {
		global $eblog_lite_version, $pagenow;

		wp_enqueue_style( 'eblog-lite-message', get_template_directory_uri() . '/spiderbuzz/admin/css/admin-welcome.css', array(), $eblog_lite_version );

		// Let's bail on theme activation.
		if ( 'themes.php' == $pagenow && isset( $_GET['activated'] ) ) {
			add_action( 'admin_notices', array( $this, 'welcome_notice' ) );
			update_option( 'eblog_lite_admin_notice_welcome', 1 );

		// No option? Let run the notice wizard again..
		} elseif( ! get_option( 'eblog_lite_admin_notice_welcome' ) ) {
			add_action( 'admin_notices', array( $this, 'welcome_notice' ) );
		}
	}

	/**
	 * Hide a notice if the GET variable is set.
	 */
	public static function hide_notices() {
		if ( isset( $_GET['eblog-lite-hide-notice'] ) && isset( $_GET['eblog_lite_notice_nonce'] ) ) {
			if ( ! wp_verify_nonce( $_GET['eblog_lite_notice_nonce'], 'eblog_lite_hide_notices_nonce' ) ) {
				wp_die( __( 'Action failed. Please refresh the page and retry.', 'eblog-lite' ) );
			}

			if ( ! current_user_can( 'manage_options' ) ) {
				wp_die( __( 'Cheatin&#8217; huh?', 'eblog-lite' ) );
			}

			$hide_notice = sanitize_text_field( $_GET['eblog-lite-hide-notice'] );
			update_option( 'eblog_lite_admin_notice_welcome' . $hide_notice, 1 );
		}
	}

	/**
	 * Show welcome notice.
	 */
	public function welcome_notice() {
		?>
		<div id="message" class="updated eblog-lite-message">
			<a class="eblog-lite-message-close notice-dismiss" href="<?php echo esc_url( wp_nonce_url( remove_query_arg( array( 'activated' ), add_query_arg( 'eblog-lite-hide-notice', 'welcome' ) ), 'eblog_lite_hide_notices_nonce', 'eblog_lite_notice_nonce' ) ); ?>"><?php esc_html_e( 'Dismiss', 'eblog-lite' ); ?></a>
			<p><?php printf( esc_html__( 'Welcome! Thank you for choosing this theme! To fully take advantage of the best our theme can offer please make sure you visit our %swelcome page%s.', 'eblog-lite' ), '<a href="' . esc_url( admin_url( 'themes.php?page=eblog-lite-welcome' ) ) . '">', '</a>' ); ?></p>
			<p class="submit">
				<a class="button-secondary" href="<?php echo esc_url( admin_url( 'themes.php?page=eblog-lite-welcome' ) ); ?>"><?php esc_html_e( 'Get started with eBlog Lite', 'eblog-lite' ); ?></a>
			</p>
		</div>
		<?php
	}

	/**
	 * Intro text/links shown to all about pages.
	 *
	 * @access private
	 */
	private function intro() {
		global $eblog_lite_version;
		$theme = wp_get_theme( get_template() );

		// Drop minor version if 0
		$major_version = substr( $eblog_lite_version, 0, 3 );
		?>
		<div class="eblog-lite-theme-info">
				<h1>
					<?php esc_html_e('About', 'eblog-lite'); ?>
					<?php echo $theme->display( 'Name' ); ?>
					<?php printf( '%s', $major_version ); ?>
				</h1>

			<div class="welcome-description-wrap">
				<div class="about-text"><?php echo $theme->display( 'Description' ); ?></div>

				<div class="eblog-lite-screenshot">
					<img src="<?php echo esc_url( get_template_directory_uri() ) . '/screenshot.png'; ?>" />
				</div>
			</div>
		</div>

		<p class="eblog-lite-actions">
			<!-- Theme Demo -->
			<a href="<?php echo esc_url( 'http://demo.spiderbuzz.com/eblog-lite/' ); ?>" class="button button-secondary" target="_blank"><?php esc_html_e( 'Theme Demo', 'eblog-lite' ); ?></a>

			<!-- Theme Details -->
			<a href="<?php echo esc_url('https://spiderbuzz.com/wordpress-themes/eblog-lite/'); ?>" class="button button-primary docs" target="_blank"><?php esc_html_e( 'Theme Details', 'eblog-lite' ); ?></a>

			<!-- Theme Documentaion  -->
			<a href="<?php echo esc_url( 'http://docs.spiderbuzz.com/eblog-lite/' ); ?>" class="button button-secondary docs" target="_blank"><?php esc_html_e( 'Documentation', 'eblog-lite' ); ?></a>

			<!-- Go To Pro -->
			<a href="<?php echo esc_url( 'https://spiderbuzz.com/wordpress-themes/eblog-pro/' ); ?>" class="button button-primary docs" target="_blank"><?php esc_html_e( 'eBlog Lite Pro', 'eblog-lite' ); ?></a>
		</p>

		<h2 class="nav-tab-wrapper">
			<a class="nav-tab <?php if ( empty( $_GET['tab'] ) && $_GET['page'] == 'eblog-lite-welcome' ) echo 'nav-tab-active'; ?>" href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' => 'eblog-lite-welcome' ), 'themes.php' ) ) ); ?>">
				<?php echo $theme->display( 'Name' ); ?>
			</a>
			
			<a class="nav-tab <?php if ( isset( $_GET['tab'] ) && $_GET['tab'] == 'free_vs_pro' ) echo 'nav-tab-active'; ?>" href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' => 'eblog-lite-welcome', 'tab' => 'free_vs_pro' ), 'themes.php' ) ) ); ?>">
				<?php esc_html_e( 'Free Vs Pro', 'eblog-lite' ); ?>
			</a>

			<a class="nav-tab <?php if ( isset( $_GET['tab'] ) && $_GET['tab'] == 'more_themes' ) echo 'nav-tab-active'; ?>" href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' => 'eblog-lite-welcome', 'tab' => 'more_themes' ), 'themes.php' ) ) ); ?>">
				<?php esc_html_e( 'More Themes', 'eblog-lite' ); ?>
			</a>

			<a class="nav-tab <?php if ( isset( $_GET['tab'] ) && $_GET['tab'] == 'changelog' ) echo 'nav-tab-active'; ?>" href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' => 'eblog-lite-welcome', 'tab' => 'changelog' ), 'themes.php' ) ) ); ?>">
				<?php esc_html_e( 'Changelog', 'eblog-lite' ); ?>
			</a>
		</h2>
		<?php
	}

	/**
	 * Welcome screen page.
	 */
	public function welcome_screen() {
		$current_tab = empty( $_GET['tab'] ) ? 'about' : sanitize_title( $_GET['tab'] );

		// Look for a {$current_tab}_screen method.
		if ( is_callable( array( $this, $current_tab . '_screen' ) ) ) {
			return $this->{ $current_tab . '_screen' }();
		}

		// Fallback to about screen.
		return $this->about_screen();
	}

	/**
	 * Output the about screen.
	 */
	public function about_screen() {
		$theme = wp_get_theme( get_template() );
		?>
		<div class="wrap about-wrap">

			<?php $this->intro(); ?>

			<div class="changelog point-releases">
				<div class="under-the-hood two-col">
               
					<div class="col">
						<h3><?php esc_html_e( 'Theme Customizer', 'eblog-lite' ); ?></h3>
						<p><?php esc_html_e( 'All Theme Options are available via Customize screen.', 'eblog-lite' ) ?></p>
						<p><a href="<?php echo admin_url( 'customize.php' ); ?>" class="button button-secondary"><?php esc_html_e( 'Customize', 'eblog-lite' ); ?></a></p>
					</div>

					<div class="col">
						<h3><?php esc_html_e( 'Documentation', 'eblog-lite' ); ?></h3>
						<p><?php esc_html_e( 'Please view our documentation page to setup the theme.', 'eblog-lite' ) ?></p>
						<p><a href="<?php echo esc_url( 'http://docs.spiderbuzz.com/eblog-lite/','eblog-lite' ); ?>" class="button button-secondary"><?php esc_html_e( 'Documentation', 'eblog-lite' ); ?></a></p>
					</div>

					<div class="col">
						<h3><?php esc_html_e( 'Got theme support question?', 'eblog-lite' ); ?></h3>
						<p><?php esc_html_e( 'Please put it in our dedicated support forum.', 'eblog-lite' ) ?></p>
						<p><a href="<?php echo esc_url( 'https://spiderbuzz.com/' ); ?>" class="button button-secondary"><?php esc_html_e( 'Support', 'eblog-lite' ); ?></a></p>
					</div>

					<div class="col">
						<h3><?php esc_html_e( 'Need more features?', 'eblog-lite' ); ?></h3>
						<p><?php esc_html_e( 'Upgrade to PRO version for more exciting features.', 'eblog-lite' ) ?></p>
						<p><a href="<?php echo esc_url( 'https://spiderbuzz.com/wordpress-themes/eblog-pro/' ); ?>" class="button button-secondary"><?php esc_html_e( 'View PRO version', 'eblog-lite' ); ?></a></p>
					</div>

					<div class="col">
						<h3>
							<?php
								esc_html_e( 'Translate', 'eblog-lite' );
								echo ' ' . $theme->display( 'Name' );
							?>
						</h3>
						<p><?php esc_html_e( 'Click below to translate this theme into your own language.', 'eblog-lite' ) ?></p>
						<p>
							<a href="<?php echo esc_url( 'https://translate.wordpress.org/projects/wp-themes/eblog-lite' ); ?>" class="button button-secondary">
								<?php
									esc_html_e( 'Translate', 'eblog-lite' );
									echo ' ' . $theme->display( 'Name' );
								?>
							</a>
						</p>
					</div>

				</div>
			</div>

			<div class="return-to-dashboard">
				<?php if ( current_user_can( 'update_core' ) && isset( $_GET['updated'] ) ) : ?>
					<a href="<?php echo esc_url( self_admin_url( 'update-core.php' ) ); ?>">
						<?php is_multisite() ? esc_html_e( 'Return to Updates', 'eblog-lite' ) : esc_html_e( 'Return to Dashboard &rarr; Updates', 'eblog-lite' ); ?>
					</a> |
				<?php endif; ?>
				<a href="<?php echo esc_url( self_admin_url() ); ?>"><?php is_blog_admin() ? esc_html_e( 'Go to Dashboard &rarr; Home', 'eblog-lite' ) : esc_html_e( 'Go to Dashboard', 'eblog-lite' ); ?></a>
			</div>

		</div>
		<?php
	}

		/**
	 * Output the changelog screen.
	 */
	public function changelog_screen() {
		global $wp_filesystem;

		?>
		<div class="wrap about-wrap">

			<?php $this->intro(); ?>

			<p class="about-description"><?php esc_html_e( 'View changelog below:', 'eblog-lite' ); ?></p>

			<?php
				$changelog_file = apply_filters( 'eblog_lite_changelog_file', get_template_directory() . '/readme.txt' );

				// Check if the changelog file exists and is readable.
				if ( $changelog_file && is_readable( $changelog_file ) ) {
					WP_Filesystem();
					$changelog = $wp_filesystem->get_contents( $changelog_file );
					$changelog_list = $this->parse_changelog( $changelog );

					echo wp_kses_post( $changelog_list );
				}
			?>
		</div>
		<?php
	}

	/**
	 * Parse changelog from readme file.
	 * @param  string $content
	 * @return string
	 */
	private function parse_changelog( $content ) {
		$matches   = null;
		$regexp    = '~==\s*Changelog\s*==(.*)($)~Uis';
		$changelog = '';

		if ( preg_match( $regexp, $content, $matches ) ) {
			$changes = explode( '\r\n', trim( $matches[1] ) );

			$changelog .= '<pre class="changelog">';

			foreach ( $changes as $index => $line ) {
				$changelog .= wp_kses_post( preg_replace( '~(=\s*Version\s*(\d+(?:\.\d+)+)\s*=|$)~Uis', '<span class="title">${1}</span>', $line ) );
			}

			$changelog .= '</pre>';
		}

		return wp_kses_post( $changelog );
	}


	/**
	 * Output the free vs pro screen.
	 */
	public function free_vs_pro_screen() {
		?>
		<div class="wrap about-wrap">

			<?php $this->intro(); ?>

			<p class="about-description"><?php esc_html_e( 'Upgrade to PRO version for more exciting features.', 'eblog-lite' ); ?></p>

			<table>
				<thead>
					<tr>
						<th class="table-feature-title"><h3><?php esc_html_e('Features', 'eblog-lite'); ?></h3></th>
						<th><h3><?php esc_html_e('eBlog Lite', 'eblog-lite'); ?></h3></th>
						<th><h3 class="eblog-lite-pro-header"><a href="<?php echo esc_url('https://spiderbuzz.com/wordpress-themes/eblog-pro/'); ?>"><?php esc_html_e('eBlog Lite Pro', 'eblog-lite'); ?></a></h3></th>
					</tr>
					
					<!-- Header Section -->				
					
					<tr>
						<td><h3><?php esc_html_e('Header Mega Menu', 'eblog-lite'); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><?php echo esc_html_e('3','eblog-lite') ?></span></td>
					</tr>

					<tr>
						<td><h3><?php esc_html_e('Demo Import', 'eblog-lite'); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><?php echo esc_html_e('7','eblog-lite'); ?></td>
					</tr>

					<tr>
						<td><h3><?php esc_html_e('Custom Support', 'eblog-lite'); ?></h3></td>
						<td><span class="dashicons dashicons-yes"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>

					<tr>
						<td><h3><?php esc_html_e('Category Color Control In Customizer', 'eblog-lite'); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>

					<tr>
						<td><h3><?php esc_html_e('Viewer Counter  Options', 'eblog-lite'); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>

					<tr>
						<td><h3><?php esc_html_e('Edit The Footer Copyright Text', 'eblog-lite'); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>


					<tr>
						<td><h3><?php esc_html_e('Fonts , Fonts Size , Text Color', 'eblog-lite'); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><?php esc_html_e('600+', 'eblog-lite'); ?></td>
					</tr>
					
					<tr>
						<td><h3><?php esc_html_e('Custom Archive Page Layout', 'eblog-lite'); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>

					<tr>
						<td><h3><?php esc_html_e('Homepage Template', 'eblog-lite'); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>

					<tr>
						<td><h3><?php esc_html_e('Boxed layout', 'eblog-lite'); ?></h3></td>
						<td><span class="dashicons dashicons-yes"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					
					<tr>
						<td><h3><?php esc_html_e('14+ Different Widgets Layout', 'eblog-lite'); ?></h3></td>
						<td><?php esc_html_e('2', 'eblog-lite'); ?></td>
						<td><?php esc_html_e('14+', 'eblog-lite'); ?></td>
					</tr>

					<tr>
						<td><h3><?php esc_html_e('Theme Color Control in Customizer', 'eblog-lite'); ?></h3></td>
						<td><span class="dashicons dashicons-no"></td>
						<td><span class="dashicons dashicons-yes"></td>
					</tr>

					<tr>
						<td></td>
						<td></td>
						<td class="btn-wrapper">
							<a href="<?php echo esc_url( 'https://spiderbuzz.com/wordpress-themes/eblog-pro/' ); ?>" class="button button-secondary docs" target="_blank"><?php esc_html_e('View Pro','eblog-lite'); ?></a>
						</td>
					</tr>

				</tbody>
			</table>

		</div>
		<?php
	}

	/**
	 * Output the more themes screen
	 */
	public function more_themes_screen() {
		?>
		<div class="wrap about-wrap">

			<?php $this->intro(); ?>
			<div class="theme-browser rendered">
				<div class="themes wp-clearfix">
					<?php
						// Set the argument array with author name.
						$args = array(
							'author' => 'spiderbuzz',
						);
						// Set the $request array.
						$request = array(
							'body' => array(
								'action'  => 'query_themes',
								'request' => serialize( (object)$args )
							)
						);
						$themes = $this->spiderbuzz_get_themes( $request );
						$active_theme = wp_get_theme()->get( 'Name' );
						$counter = 1;

						// For currently active theme.
						foreach ( $themes->themes as $theme ) {
							if( $active_theme == $theme->name ) { ?>

								<div id="<?php echo $theme->slug; ?>" class="theme active">
									<div class="theme-screenshot">
										<img src="<?php echo $theme->screenshot_url ?>"/>
									</div>
									<h3 class="theme-name" ><strong><?php _e( 'Active', 'eblog-lite' ); ?></strong>: <?php echo $theme->name; ?></h3>
									<div class="theme-actions">
										<a class="button button-primary customize load-customize hide-if-no-customize" href="<?php echo get_site_url(). '/wp-admin/customize.php' ?>"><?php _e( 'Customize', 'eblog-lite' ); ?></a>
									</div>
								</div><!-- .theme active -->
							<?php
							$counter++;
							break;
							}
						}

						// For all other themes.
						foreach ( $themes->themes as $theme ) {
							if( $active_theme != $theme->name ) {
								// Set the argument array with author name.
								$args = array(
									'slug' => $theme->slug,
								);
								// Set the $request array.
								$request = array(
									'body' => array(
										'action'  => 'theme_information',
										'request' => serialize( (object)$args )
									)
								);
								$theme_details = $this->spiderbuzz_get_themes( $request );
							?>
								<div id="<?php echo $theme->slug; ?>" class="theme">
									<div class="theme-screenshot">
										<img src="<?php echo $theme->screenshot_url ?>"/>
									</div>

									<h3 class="theme-name"><?php echo $theme->name; ?></h3>

									<div class="theme-actions">
										<?php if( wp_get_theme( $theme->slug )->exists() ) { ?>											
											<!-- Activate Button -->
											<a  class="button button-secondary activate"
												href="<?php echo wp_nonce_url( admin_url( 'themes.php?action=activate&amp;stylesheet=' . urlencode( $theme->slug ) ), 'switch-theme_' . $theme->slug );?>" ><?php _e( 'Activate', 'eblog-lite' ) ?></a>
										<?php } else {
											// Set the install url for the theme.
											$install_url = add_query_arg( array(
													'action' => 'install-theme',
													'theme'  => $theme->slug,
												), self_admin_url( 'update.php' ) );
										?>
											<!-- Install Button -->
											<a data-toggle="tooltip" data-placement="bottom" title="<?php echo 'Downloaded ' . number_format( $theme_details->downloaded ) . ' times'; ?>" class="button button-secondary activate" href="<?php echo esc_url( wp_nonce_url( $install_url, 'install-theme_' . $theme->slug ) ); ?>" ><?php _e( 'Install Now', 'eblog-lite' ); ?></a>
										<?php } ?>

										<a class="button button-primary load-customize hide-if-no-customize" target="_blank" href="<?php echo $theme->preview_url; ?>"><?php _e( 'Live Preview', 'eblog-lite' ); ?></a>
									</div>
								</div><!-- .theme -->
								<?php
							}
						}


					?>
				</div>
			</div><!-- .end div -->
		</div><!-- .ena wrapper -->
		<?php
	}

	/** 
	 * Get all our themes by using API.
	 */
	private function spiderbuzz_get_themes( $request ) {

		// Generate a cache key that would hold the response for this request:
		$key = 'eblog-lite_' . md5( serialize( $request ) );

		// Check transient. If it's there - use that, if not re fetch the theme
		if ( false === ( $themes = get_transient( $key ) ) ) {

			// Transient expired/does not exist. Send request to the API.
			$response = wp_remote_post( 'http://api.wordpress.org/themes/info/1.0/', $request );

			// Check for the error.
			if ( !is_wp_error( $response ) ) {

				$themes = unserialize( wp_remote_retrieve_body( $response ) );

				if ( !is_object( $themes ) && !is_array( $themes ) ) {

					// Response body does not contain an object/array
					return new WP_Error( 'theme_api_error', 'An unexpected error has occurred' );
				}

				// Set transient for next time... keep it for 24 hours should be good
				set_transient( $key, $themes, 60 * 60 * 24 );
			}
			else {
				// Error object returned
				return $response;
			}
		}
		return $themes;
	}


}

endif;

return new Eblog_Lite_Admin();