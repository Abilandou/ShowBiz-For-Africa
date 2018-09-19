<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 * 
 * @package Postmagthemes
 * @subpackage queens_magazine_blog
 */

get_header();
?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			<section class="error-404 not-found row">
				<div class="page-content col-lg-9 col-md-9">
					<header class="page-header">
						<h2 class="page-title"><?php esc_html_e( 'Oops! That page can not be found.', 'queens-magazine-blog' ); ?></h2>
					</header><!-- .page-header -->
					<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below?', 'queens-magazine-blog' ); ?></p>
					<?php
					?>
					<div class="widget widget_categories">
						<h2 class="widget-title"><?php esc_html_e( 'Most Used Categories', 'queens-magazine-blog' ); ?></h2>
						<ul>
							<?php
							wp_list_categories( array(
								'orderby'    => 'count',
								'order'      => 'DESC',
								'show_count' => 1,
								'title_li'   => '',
								'number'     => 10,
							) );
							?>
						</ul>
						
					</div><!-- .widget -->

					<?php
					/* translators: %1$s: smiley */
					$queens_magazine_blog_archive_content = '<p>' . sprintf( esc_html__( 'Try looking in the monthly archives. %1$s', 'queens-magazine-blog' ), convert_smilies( ':)' ) ) . '</p>';
					the_widget( 'WP_Widget_Archives', 'dropdown=1', "after_title=</h2>$queens_magazine_blog_archive_content" );

					the_widget( 'WP_Widget_Tag_Cloud' );
					?>

				</div><!-- .page-content -->
				<div class = "col-lg-3 col-md-3 right-background" >
				<?php get_sidebar(); ?>
				</div>
				
			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
