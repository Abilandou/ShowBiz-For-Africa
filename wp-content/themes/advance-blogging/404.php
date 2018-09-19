<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package Advance Blogging
 */

get_header(); ?>

	<div id="content-aa">
		<div class="container">
            <div class="page-content">
				<h1><?php esc_html_e( '404 Not Found', 'advance-blogging' ); ?></h1>
				<p class="text-404"><?php esc_html_e( 'Looks like you have taken a wrong turn', 'advance-blogging' ); ?></p>
				<p class="text-404"><?php esc_html_e( 'Dont worry it happens to the best of us.', 'advance-blogging' ); ?></p>
				<div class="read-moresec">
            		<a href="<?php echo esc_url( home_url() ); ?>" class="button"><?php esc_html_e( 'Back to Home Page', 'advance-blogging' ); ?></a>
				</div>
				<div class="clearfix"></div>
            </div>
		</div>
	</div>
	
<?php get_footer(); ?>