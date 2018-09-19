	
	<!-- END CONTAINER -->
	</div>
	
	<div id="widget-area">
	
		<div class="container">
			
			<div class="footer-widget-wrapper">
				<?php	/* Widgetised Area */	if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Footer 1') ) ?>
			</div>
			
			<div class="footer-widget-wrapper">
				<?php	/* Widgetised Area */	if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Footer 2') ) ?>
			</div>
			
			<div class="footer-widget-wrapper last">
				<?php	/* Widgetised Area */	if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Footer 3') ) ?>
			</div>
			
		</div>
		
	</div>
	
	<footer id="footer-copyright">
		
		<div class="container">
	
			
			<p><?php esc_html_e('&copy;', 'unoblog-lite' ); echo date('Y'); /* WPCS: xss ok. */ ?> <span class="sep"> | </span> 
			<?php
			/* translators: 1: name of theme, 2: Link of author */
            printf( esc_html__( '%1$s by %2$s', 'unoblog-lite' ), '<a href="'.esc_url(home_url()).'">'.esc_attr(get_bloginfo( "name" )).'</a>', '<a href="'.esc_url('https://www.themebounce.com').'" target="_blank">Theme Bounce</a>'); 
			?></p>
			<a href="#" class="to-top"><?php esc_html_e( 'Back to top ', 'unoblog-lite' ); ?> <i class="fa fa-angle-double-up"></i></a>

		</div>
		
	</footer>
	
	<?php wp_footer(); ?>
	
</body>

</html>