<?php
/**
 * Template part for displaying posts in singular post
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package queens_magazine_blog
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class = " parrent" >
		<header class="entry-header text-center">
		<h2 class="singlepost-title theme-hover "><a title = "<?php the_title_attribute(); ?>" ><?php the_title(); ?></a></h2>
<br>
			<?php
			if ( ! has_post_thumbnail() ) {
				if ( strpos( esc_attr(get_the_content()), __('video width=','queens-magazine-blog') ) or strpos( esc_attr(get_the_content()), __('iframe width=','queens-magazine-blog') ) or strpos( esc_attr(get_the_content()), __('youtube/watch','queens-magazine-blog') ) or strpos( esc_attr(get_the_content()), __('.tv/','queens-magazine-blog') )) {
			?>	
				<!--show blank  -->
				<?php } else { ?>
					<img class= "" src = "<?php echo esc_url( get_template_directory_uri() ); ?>/images/photo1_square.jpeg " >
				<?php }
			} else if ( has_post_thumbnail() ) {
				queens_magazine_blog_post_thumbnail();
			}
			?>
		</header><!-- .entry-header -->
		
		<footer class="entry-footer">
		
			<div>
			
				<p class =" float-left hvr-grow category3 theme-text-color pl-2 pr-2 pt-1 pb-1" > <?php the_category( ' / ' ); ?> </p>
				<div class ="clearfix" ></div>

				<?php if ( 'post' === get_post_type() ) : ?>
					<div class="entry-meta post-auther-edit-2 theme-hover">
						<?php
						queens_magazine_blog_posted_on();
						queens_magazine_blog_posted_by();
						?>
					</div><!-- .entry-meta -->
				<?php endif; ?>
				<div class = " post-auther-edit-2 theme-hover magazine-color "> <?php queens_magazine_blog_entry_footer(); ?> </div>

			</div>
		
		</footer><!-- .entry-footer -->
	</div>
	
</article><!-- #post-<?php the_ID(); ?> -->
