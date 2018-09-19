<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Postmagthemes
 * @subpackage queens_magazine_blog
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main ">
			<div class ="row " >

			<?php get_template_part( 'inc/layout/layout-1' ); ?>
			
			</div>
				
				<div class = " text-center mt-5 " >
					<?php if( absint(get_theme_mod( 'queens_magazine_blog_facebook_url_enable','0' )) == 1 ) :?>
						<a href = "<?php echo esc_url(get_theme_mod( 'queens_magazine_blog_social_url_'.'Facebook'))?>" target="_blank" class = "fa socialwidget fa-facebook-official facebook" ></a>
					<?php endif;
					if( absint(get_theme_mod( 'queens_magazine_blog_twitter_url_enable','0' )) == 1 ) :?>
						<a href = "<?php echo esc_url(get_theme_mod( 'queens_magazine_blog_social_url_'.'Twitter'))?>" target="_blank" class = "fa socialwidget fa-twitter-square twitter" ></a>
					<?php endif;
					if( absint(get_theme_mod( 'queens_magazine_blog_googlplus_url_enable','0' )) == 1 ) :?>
						<a href = "<?php echo esc_url(get_theme_mod( 'queens_magazine_blog_social_url_'.'Googleplus'))?>" target="_blank" class = "fa socialwidget fa-google-plus-square googleplus" ></a>
					<?php endif;
					if( absint(get_theme_mod( 'queens_magazine_blog_youtube_url_enable','0' )) == 1 ) :?>
						<a href = "<?php echo esc_url(get_theme_mod( 'queens_magazine_blog_social_url_'.'Youtube'))?>" target="_blank" class = "fa fa-youtube-square youtube" ></a>
					<?php endif; ?>				
				</div>

			<div class ="row"> 
				<?php if ( absint(get_theme_mod('queens_magazine_blog_recent_update_enable','1') == 1)) { ?>
					<div class="  mt-5  central-background image-changeon-recent-update w-100"  >
						<?php get_template_part( 'inc/postmagthemes/recent-updated' ); ?>
					</div>
				<?php } ?>
				
				<div class=" w-100" >
					
					<?php get_sidebar( 'secondarybar' );?>

				</div>
			</div>
    	</main><!--- #main -->
	</div>
<?php get_footer();