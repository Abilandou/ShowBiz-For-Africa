<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Postmagthemes
 * @subpackage queens_magazine_blog
 */

?>
	</div><!-- #content -->
	</div><!-- #page -->
	<footer id="colophon" class=" site-footer container-fluid " >
		
		<div class="site-info row footer-background ">
			<div class = "col-lg-12 col-md-12 margin-section mt-5 foot-top" >
				<div  class = "col-lg-3 col-md-3 float-left wow fadeInLeftBig"  >
					<?php 
					dynamic_sidebar( 'sidebar-five '); 
					if ( absint( get_theme_mod('queens_magazine_blog_most_used_categories_enable','0')) == 1) {
						?>
						<div class="widget widget_categories">
							<h2 class="widget-title"><?php echo esc_html( get_theme_mod('queens_magazine_blog_most_used_categories_text', __('Most Used Categories','queens-magazine-blog' )) ) ?></h2>
							<ul>
								<?php
								wp_list_categories( array(
									'orderby'    => 'count',
									'order'      => 'DESC',
									'show_count' => 1,
									'title_li'   => '',
									'number'     => 4,
								) );
								?>
							</ul>
						</div><!-- .widget -->
					<?php } ?>
				</div>
				
				<div  class = "col-lg-6 col-md-6 float-left" >
					<?php dynamic_sidebar( 'sidebar-six ');
					if ( absint( get_theme_mod('queens_magazine_blog_most_commented_post_enable','0')) == 1) {
					?>
						<div class="widget widget_categories">
						<h2 class="widget-title"><?php echo esc_html( get_theme_mod('queens_magazine_blog_most_commented_post_text', __('Most Commented Post','queens-magazine-blog' ) )); ?></h2>
						<ul> <?php
						$args = array( 
							'post_type'      => 'post',
							'orderby' => array( 'comment_count' => 'DSC', 'date' => 'DSC'),
							'order'     => 'DSC',
							'posts_per_page' => '4',
						);
						$listings = new WP_Query( $args );
						if ( $listings->have_posts() ) :
							while ( $listings->have_posts() ) :
								$listings->the_post();
								?><li class="cat-item cat-item-1 ">
								<?php echo '<span class="comments-link pr-1 pl-2 float-right">';
								comments_popup_link(
									sprintf(
										wp_kses(
											/* translators: %s: post title */
											__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'queens-magazine-blog' ),
											array(
												'span' => array(
													'class' => array(''),
												),
											)
										),
										get_the_title()
									)
								);
								echo '</span>'; ?>
								<a class="" href = "<?php the_permalink(); ?>" title = "<?php the_title_attribute(); ?>" ><?php the_title(); ?></a>
								
								</li>
								<?php
							 endwhile;
							 wp_reset_postdata();
						endif;
						 ?></ul>
						</div><!-- .widget -->
						<div class ="clearfix"> </div>
					<?php } ?>
				</div>

				<div  class = "col-lg-3 col-md-3 float-left wow fadeInRightBig" >
					<?php 
					dynamic_sidebar( 'sidebar-seven');
					if ( absint( get_theme_mod('queens_magazine_blog_copyright_enable','0')) == 1) {
					?>
					<div class="widget widget_categories">
						<h2 class="widget-title"><?php echo esc_html( get_theme_mod( 'queens_magazine_blog_about_text', __('About us','queens-magazine-blog' ) ) ); ?></h2>
						<ul>
							<li>
								<?php echo esc_html( get_theme_mod('queens_magazine_blog_copyright_statement',__( 'copyright@', 'queens-magazine-blog' ) ) ); ?>
							</li>
						</ul>
					</div><!-- .widget -->
					<?php } ?>
				</div>
				<div class ="clearfix"> </div>
			</div>
		</div><!-- .site-info -->
			<div class ="text-center">
				<a href="<?php echo esc_url( __( 'https://abeboh.org/', 'queens-magazine-blog' ) ); ?>"><?php
					/* translators: %s: CMS name, i.e. WordPress. */
					printf( esc_html__( 'Proudly powered by %s', '' ), 'ABEBOH' );
				?></a>
				<span class="sep">  </span>
				<a href="<?php echo esc_url( __( 'https://www.postmagthemes.com/', 'queens-magazine-blog' ) ); ?>"><?php
					/* translators: %s: CMS name */
					printf( esc_html__( '', '' ), 'Postmagthemes' );
				?></a>
				<span class="sep">  </span>
	        </div>
			<div> </div>
		
	</footer><!-- #colophon -->


<?php wp_footer(); ?>

</body>
</html>
