<?php
/**
 * The template for displaying the footer.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Videoblog
 */

$ilovewp_logo = get_template_directory_uri() . '/images/ilovewp-logo-white.png';

?>

	<footer class="site-footer" role="contentinfo">
	
		<div class="wrapper wrapper-footer">

			<?php get_sidebar( 'footer' ); ?>
			
			<div class="wrapper-copy">
				<p class="copy"><?php _e('Copyright &copy;','videoblog');?> <?php echo date_i18n(__("Y","videoblog")); ?> <?php bloginfo('name'); ?>. <?php _e('All Rights Reserved', 'videoblog');?>. </p>
				<p class="copy-ilovewp"><span class="theme-credit"><?php _e( 'Theme by', 'videoblog' ); ?><a href="http://www.ilovewp.com/" rel="designer" class="footer-logo-ilovewp"><img src="<?php echo esc_url($ilovewp_logo); ?>" width="51" height="11" alt="<?php esc_attr_e('Video WordPress Theme', 'videoblog');?>" /></a></span></p>
			</div><!-- .wrapper-copy -->

		</div><!-- .wrapper .wrapper-footer -->
	
	</footer><!-- .site-footer -->

</div><!-- #container -->

<?php wp_footer(); ?>

</body>
</html>