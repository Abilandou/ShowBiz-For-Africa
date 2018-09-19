<?php
/**
 * Define Constants
 */
define('ILOVEWP_SHORTNAME', 'videoblog'); 
define('ILOVEWP_PAGE_BASENAME', 'videoblog-doc'); 

/**
 * Specify Hooks/Filters
 */
add_action( 'admin_menu', 'ilovewp_add_menu' );

/**
* The admin menu pages
*/
function ilovewp_add_menu(){
	
	add_theme_page( __('Videoblog Theme','videoblog'), __('Videoblog Theme','videoblog'), 'manage_options', ILOVEWP_PAGE_BASENAME, 'ilovewp_settings_page_doc' ); 

}

// ************************************************************************************************************

/*
 * Theme Documentation Page HTML
 * 
 * @return echoes output
 */
function ilovewp_settings_page_doc() {
	// get the settings sections array
	$theme_data = wp_get_theme();
	?>
	
	<div class="ilovewp-wrapper">
		<div class="ilovewp-header">
			<div id="ilovewp-theme-info">
				<p><?php 

					echo sprintf( 
					/* translators: Theme name and version */
					__( '<span class="theme-name">%1$s Theme</span> <span class="theme-version">(version %2$s)</span> by', 'videoblog' ), 
					esc_html($theme_data->name),
					esc_html($theme_data->version)
					); ?></p>
			</div><!-- #ilovewp-theme-info -->
			<div id="ilovewp-logo">
				<a href="https://www.ilovewp.com/" target="_blank" rel="noopener"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/ilovewp-admin/images/ilovewp-options-logo.png" width="153" height="33" alt="<?php esc_html_e('ILoveWP.com Logo','videoblog'); ?>" /></a>
			</div><!-- #ilovewp-logo -->
		</div><!-- .ilovewp-header -->
		
		<div class="ilovewp-subheader">
			<ul>
				<li><span class="dashicons dashicons-info"></span> <a href="https://www.ilovewp.com/documentation/videoblog/"><?php esc_html_e('Videoblog Documentation','videoblog'); ?></a></li>
				<li><span class="dashicons dashicons-editor-help"></span> <a href="https://wordpress.org/support/theme/videoblog/"><?php esc_html_e('Videoblog Support Forum','videoblog'); ?></a></li>
				<li><span class="dashicons dashicons-testimonial"></span> <a href="https://wordpress.org/support/theme/videoblog/reviews/#new-post"><?php esc_html_e('Leave a Review','videoblog'); ?></a></li>
				<li><span class="dashicons dashicons-email-alt"></span> <a href="https://www.ilovewp.com/contact/"><?php esc_html_e('Contact the Developer','videoblog'); ?></a></li>
			</ul>
			<div class="cleaner">&nbsp;</div>
		</div><!-- .ilovewp-subheader -->
		
		<div class="ilovewp-documentation">
			<div class="ilovewp-theme-intro">

				<?php
				$message = sprintf( __( 'Thank you for installing Videoblog', 'videoblog' ) );
				printf( '<h2>%s</h2>', $message );
				?>
				<p><?php echo $theme_data->description; ?></p>

				<p><a class="button button-primary" href="https://www.ilovewp.com/themes/videoblog/" rel="noopener" target="_blank"><?php esc_html_e('Videoblog Official Page','videoblog'); ?></a>
				<a class="button button-primary" href="http://demo.ilovewp.com/?theme=videoblog" rel="noopener" target="_blank"><?php esc_html_e('Videoblog Live Demo','videoblog'); ?></a></p>

			</div>

			<hr />

			<ul class="ilovewp-doc-columns clearfix">
				<li class="ilovewp-doc-column">
					<div class="ilovewp-doc-column-wrapper">
						<h3 class="column-title"><?php esc_html_e('Videoblog Documentation and Support','videoblog'); ?></h3>
						<div class="ilovewp-doc-column-text-wrapper">
							<p><?php 
							echo sprintf( 
							/* translators: Theme name and link to WordPress.org Support forum for the theme */
							__( 'Support for %1$s Theme is provided in the official <a href="%2$s" target="_blank" rel="noopener">WordPress.org community support forums</a>. You can expect a response to your questions in less than 24 hours.', 'videoblog' ), 
							esc_html($theme_data->name),
							'https://wordpress.org/support/theme/videoblog/'
							); ?></p>

							<p><a class="button button-primary" href="https://www.ilovewp.com/documentation/videoblog/" rel="noopener" target="_blank"><?php esc_html_e('View Videoblog Documentation','videoblog'); ?></a>
							<a class="button button-secondary" href="https://wordpress.org/support/theme/videoblog/" rel="noopener" target="_blank"><?php esc_html_e('Go to Videoblog Support Forum','videoblog'); ?></a></p>

						</div><!-- .ilovewp-doc-column-text-wrapper-->
					</div><!-- .ilovewp-doc-column-wrapper -->
				</li><!-- .ilovewp-doc-column -->
				<!-- .ilovewp-doc-column --><li class="ilovewp-doc-column">
					<div class="ilovewp-doc-column-wrapper">
						<h3 class="column-title"><?php esc_html_e('Help us help you','videoblog'); ?></h3>
						<div class="ilovewp-doc-column-text-wrapper">
							<p><?php esc_html_e('There are a few ways that you could support us in our efforts to continue developing and maintaining free WordPress themes.','videoblog'); ?></p>
							<p><?php esc_html_e('ILOVEWP.com relies on donations for much of its funding. If you would like to support us donations are very welcome.','videoblog'); ?></p>
							<p><?php esc_html_e('Another way is to write a review for Videoblog on the WordPress.org website. It helps and motivates us to continue updating and providing support for our Videoblog Theme.','videoblog'); ?></p>

							<p><a class="button button-primary" href="https://wordpress.org/support/theme/videoblog/reviews/#new-post" rel="noopener" target="_blank"><?php esc_html_e('Write a Review for Videoblog','videoblog'); ?></a><a class="button button-primary button-donate" href="https://www.ilovewp.com/donate/" rel="noopener" target="_blank"><?php esc_html_e('Make a Donation','videoblog'); ?></a></p>

						</div><!-- .ilovewp-doc-column-text-wrapper-->
					</div><!-- .ilovewp-doc-column-wrapper -->
				</li><!-- .ilovewp-doc-column --><li class="ilovewp-doc-column">
					<div class="ilovewp-doc-column-wrapper">
						<h3 class="column-title"><?php esc_html_e('WordPress Themes and Resources','videoblog'); ?></h3>
						<div class="ilovewp-doc-column-text-wrapper">
							<p><?php esc_html_e('Videoblog is just one of the many free WordPress themes that we have developed. ','videoblog'); ?></p>
							<p><a class="button button-primary" href="https://www.ilovewp.com/theme-shops/ilovewp/" rel="noopener" target="_blank"><?php esc_html_e('Browse our WordPress Themes','videoblog'); ?></a></p>

							<p><?php esc_html_e('We have a great collection of guides and articles on how to create WordPress websites for: Photographers, Hotels, Schools, Universities, Churches, Museums, Doctors, Hospitals, Lawyers and other types of organizations and businesses.','videoblog'); ?></p>
							<p><a class="button button-primary" href="https://www.ilovewp.com/resources/" rel="noopener" target="_blank"><?php esc_html_e('Browse our WordPress Resources','videoblog'); ?></a></p>

						</div><!-- .ilovewp-doc-column-text-wrapper-->
					</div><!-- .ilovewp-doc-column-wrapper -->
				</li><!-- .ilovewp-doc-column --><li class="ilovewp-doc-column">
					<div class="ilovewp-doc-column-wrapper">
						<h3 class="column-title"><?php esc_html_e('Considering a new web hosting provider?','videoblog'); ?></h3>
						<div class="ilovewp-doc-column-text-wrapper">

							<p><?php esc_html_e('Even though most hosts can host PHP websites (the programming language in which WordPress is coded in), there are providers that can provide better performance for WordPress websites than regular hosts.','videoblog'); ?></p>
							<p><?php esc_html_e('We have a small list of handpicked hosting providers that have a great reputation in the developers community.','videoblog'); ?></p>
							<p><a class="button button-primary" href="https://www.ilovewp.com/resources/wordpress-hosting/" rel="noopener" target="_blank"><?php esc_html_e('Popular WordPress Hosting Providers','videoblog'); ?></a></p>

						</div><!-- .ilovewp-doc-column-text-wrapper-->
					</div><!-- .ilovewp-doc-column-wrapper -->
				</li><!-- .ilovewp-doc-column -->
			</ul><!-- .ilovewp-doc-columns -->

			<div style="clear: both;">

		</div><!-- .ilovewp-documentation -->

	</div><!-- .ilovewp-wrapper -->

<?php }