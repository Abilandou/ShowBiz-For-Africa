<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Postmagthemes
 * @subpackage queens_magazine_blog
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main mb-4">
		<div class ="row mark-embose-line " >
			<!-- below is to show pages content -->
			<div class = "col-lg-9 col-md-9 pt-4 central-background" >
					
				<?php
				while ( have_posts() ) :
					the_post();

					get_template_part( 'template-parts/content', 'page' );
					
					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;

				endwhile; // End of the loop. 
				?>
						
			</div>
			<div class = "col-lg-3 col-md-3 pr-0 pl-0 right-background" >
				<div class ="sidebar-misc">
					<?php get_sidebar(); ?>
				</div>

			</div>
		</div>
		<?php if( absint(get_theme_mod( 'queens_magazine_blog_social_url_enable','0' )) == 1 ) :?>
				<div class = " text-center mt-5 " >
					<a href = "<?php echo esc_url(get_theme_mod( 'queens_magazine_blog_social_url_'.'Facebook'))?>" target="_blank" class = "fa socialwidget fa-facebook-official facebook" ></a>
					<a href = "<?php echo esc_url(get_theme_mod( 'queens_magazine_blog_social_url_'.'Twitter'))?>" target="_blank" class = "fa socialwidget fa-twitter-square twitter" ></a>
					<a href = "<?php echo esc_url(get_theme_mod( 'queens_magazine_blog_social_url_'.'Googleplus'))?>" target="_blank" class = "fa socialwidget fa-google-plus-square googleplus" ></a>
					<a href = "<?php echo esc_url(get_theme_mod( 'queens_magazine_blog_social_url_'.'Youtube'))?>" target="_blank" class = "fa fa-youtube-square youtube" ></a>
				</div>
			<?php endif;
			if ( absint(get_theme_mod('queens_magazine_blog_recent_update_enable','0')) == 1) { ?>
				<div class="row mt-5 mb-5 central-background mark-embose-line"  >
					<?php get_template_part( 'inc/postmagthemes/recent-updated' ); ?>
					<div class="row  mr-0 ml-0 pl-3 pr-3 " >
					<div class="image-changeon-recent-update">
						<?php get_sidebar( 'secondarybar' );?>
						</div>
					</div>

				</div>
			<?php } ?>

			
		</main><!-- #main -->
	</div><!-- #primary -->

<?php

get_footer();
