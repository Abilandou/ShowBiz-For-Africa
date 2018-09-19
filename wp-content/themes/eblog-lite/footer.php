<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package eBlog Lite
 */
?>
	</div><!-- #content -->	
	<footer id="colophon" class="site-footer">
		<?php if ( is_active_sidebar( 'footer-widget-1' ) ||  is_active_sidebar( 'footer-widget-2' )  || is_active_sidebar( 'footer-widget-3' )  || is_active_sidebar( 'footer-widget-4' )) : ?>
			<div class="footer-widget">
				<div class="container">
					<div class="row">
						<div class="col-xs-12 col-md-4">
							<div >
								<?php dynamic_sidebar( 'footer-widget-1' ); ?>
							</div><!-- #secondary -->
						</div>
						<div class="col-xs-12 col-md-4">
							<div >
								<?php dynamic_sidebar( 'footer-widget-2' ); ?>
							</div><!-- #secondary -->
						</div>
						<div class="col-xs-12 col-md-4">
							<div >
								<?php dynamic_sidebar( 'footer-widget-3' ); ?>
							</div><!-- #secondary -->
						</div>
						
					</div>
				</div>
			</div>
		<?php endif; ?>

		<div class="site-info">
			<div class="container">
			<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'eblog-lite' ) ); ?>"><?php
				/* translators: %s: CMS name, i.e. WordPress. */
				printf( esc_html__( 'Proudly powered by %s', 'eblog-lite' ), 'WordPress' );
			?></a>
			<span class="sep"> | </span> <a href="<?php echo esc_url('https://spiderbuzz.com','eblog-lite') ?>">
			<?php
				/* translators: 1: Theme name, 2: Theme author. */
				printf( esc_html__( 'Theme: %1$s by %2$s.', 'eblog-lite' ), 'eBlog Lite', 'SpiderBuzz' );
			?>
			</a>
		</div>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
