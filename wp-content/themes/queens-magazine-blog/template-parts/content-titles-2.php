<?php
/**
 * Template part for displaying title and comments in Most recent.
 *
 * @package Postmagthemes
 * @subpackage queens_magazine_blog
 */
?>

	<?php
				if ( absint( get_theme_mod( 'queens_magazine_blog_most_recent_post_taxonomy_'.__('Category','queens-magazine-blog'),'1' ) ) == 1  ) : ?>

					<p class =" float-left hvr-grow category2 theme-text-color pl-1 pr-1 pt-1 pb-1" > <?php the_category( ' / ' ); ?> </p>
				<?php endif; ?>
					<h2 class="post-title-2 theme-hover text-center"><a href = "<?php the_permalink(); ?>" title = "<?php the_title_attribute(); ?>" ><?php the_title(); ?></a></h2>
				
				<?php if ( 'post' === get_post_type() ) : ?>
					<div class="entry-meta post-auther-edit-2 theme-hover" >
						<?php
						if ( absint( get_theme_mod( 'queens_magazine_blog_most_recent_post_taxonomy_'.__('Date','queens-magazine-blog'),'1' ) )== 1 ) :
						queens_magazine_blog_posted_on();
						endif;
						if ( absint( get_theme_mod( 'queens_magazine_blog_most_recent_post_taxonomy_'.__('Author','queens-magazine-blog'),'1' ) )== 1 ) :
						queens_magazine_blog_posted_by();
						endif;
						?>
					</div><!-- .entry-meta -->
				<?php endif; 

				if ( absint( get_theme_mod( 'queens_magazine_blog_most_recent_post_taxonomy_'.__('Comment & Tag','queens-magazine-blog'),'1' )) == 1) :
					?> <div class = " post-auther-edit-2 theme-hover tag-border-line "> <?php queens_magazine_blog_entry_footer(); ?> </div> <?php
				endif; ?>
				<div  class = "conetentline excerpt"  >
					<?php the_excerpt(); ?>
					<p class=" shadow read-more theme-hover"> <a href="<?php the_permalink(); ?>"><?php esc_html_e( 'READ MORE', 'queens-magazine-blog'); ?></a></p>
				</div>