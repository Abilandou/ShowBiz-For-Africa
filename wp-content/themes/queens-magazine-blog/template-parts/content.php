<?php
/**
 * Template part for displaying post with overlay image in 16:9
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package queens_magazine_blog
 */

?>
<article class ="" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class = " parrent containers overflow-hidden " >
		<header class="entry-header text-center" >
			<?php
			if ( ! has_post_thumbnail() ) {
				if ( strpos( esc_attr(get_the_content()), 'video width=' ) ) {
			?>		
					<div class  = "embed-responsive-16by9 margin-bottom" >
						<?php echo queens_magazine_blog_get_embedded_media(); ?>
					</div>
				<?php } else if ( strpos( esc_attr(get_the_content()), __('iframe width=','queens-magazine-blog') ) or strpos( esc_attr(get_the_content()), __('youtube.com/watch','queens-magazine-blog') ) or strpos( esc_attr(get_the_content()), __('.tv/','queens-magazine-blog') )) { ?>
					<div class  = "embed-responsive embed-responsive-16by9 margin-bottom" >
						<?php echo queens_magazine_blog_get_embedded_media();?>
					</div>
				<?php } else { ?>
					<div>
					<img  src = "<?php echo esc_url( get_template_directory_uri() ); ?>/images/photo1_169.jpeg " >
				</div>
				<?php }
			} else if ( has_post_thumbnail() ) {
				queens_magazine_blog_post_thumbnail();
			}
			?>
		</header><!-- .entry-header -->
		
		
			<div class = "overlays" > 
				<?php if ( absint( get_theme_mod( 'queens_magazine_blog_most_commented_post_taxonomy_'.__('Category','queens-magazine-blog'),'1' )) == 1  ) : ?>
					<p class =" float-left hvr-grow category1 theme-text-color  pl-1 pr-1 pt-1 pb-1" > <?php the_category( ' / ' ); ?> </p>
				<?php endif; ?>

				<h3 class="post-title theme-hover text-center"><a href = "<?php the_permalink(); ?>" title = "<?php the_title_attribute(); ?>" ><?php the_title(); ?></a></h3>
				
				<?php if ( 'post' === get_post_type() ) : ?>
					<div class="entry-meta post-auther-edit-1 theme-hover pl-1">
						<?php
						if ( absint( get_theme_mod( 'queens_magazine_blog_most_commented_post_taxonomy_'.__('Date','queens-magazine-blog'),'1' ) )== 1 ) :
			
							queens_magazine_blog_posted_on();
						
						endif;
						if ( absint( get_theme_mod( 'queens_magazine_blog_most_commented_post_taxonomy_'.__('Author','queens-magazine-blog'),'1' ) )== 1 ):
						
							queens_magazine_blog_posted_by();
						endif;
						?>
					</div><!-- .entry-meta -->
				<?php endif; 

				if ( absint( get_theme_mod( 'queens_magazine_blog_most_commented_post_taxonomy_'.__('Comment & Tag','queens-magazine-blog'),'1' ) )== 1  ) :
				?> <div class = " post-auther-edit-1 theme-hover magazine-color pl-1"> <?php queens_magazine_blog_entry_footer(); ?> </div> <?php
				endif; ?>

			</div>
			
	
	</div>
	
</article><!-- #post-<?php the_ID(); ?> -->
