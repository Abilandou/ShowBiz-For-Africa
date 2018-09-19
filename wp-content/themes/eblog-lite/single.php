<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package eBlog Lite
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php
		while ( have_posts() ) : the_post();

			?>
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php
		if ( is_singular() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;

		if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php eblog_lite_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php
		endif; ?>
	</header><!-- .entry-header -->
		<div class="entry-content">
			<?php 
				$single_page_id = get_the_ID();
				$single_page_url = get_the_permalink($single_page_id);
				$single_page_title = get_the_title($single_page_id);
				$single_page_desc = get_the_excerpt( $single_page_id );
			
			?>
			<div class="social-links">
				
				<!-- Email -->
				<a href="mailto:?Subject=<?php echo $single_page_title; ?>&amp;Body=<?php echo $single_page_desc; ?> <?php echo $single_page_url; ?>">
					<img src="<?php echo get_template_directory_uri(); ?>/assets/images/social/email.png" alt="Email" />
				</a>

				<!-- Facebook -->
				<a href="http://www.facebook.com/sharer.php?u=<?php echo $single_page_url; ?>" target="_blank">
					<img src="<?php echo get_template_directory_uri(); ?>/assets/images/social/social.png" alt="Facebook" />
				</a>

				<!-- Google+ -->
				<a href="https://plus.google.com/share?url=<?php echo $single_page_url; ?>" target="_blank">
					<img src="<?php echo get_template_directory_uri(); ?>/assets/images/social/google-plus.png" alt="Google" />
				</a>

				<!-- Twitter -->
				<a href="https://twitter.com/share?url=<?php echo $single_page_url; ?>&amp;text=<?php echo $single_page_title; ?>&amp;hashtags=simplesharebuttons" target="_blank">
					<img src="<?php echo get_template_directory_uri(); ?>/assets/images/social/twitter_circle-512.png" alt="Twitter" />
				</a>

				<!-- LinkedIn -->
				<a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo $single_page_url; ?>" target="_blank">
					<img src="<?php echo get_template_directory_uri(); ?>/assets/images/social/linkedin.png" alt="LinkedIn" />
				</a>

			</div>
		<?php

			if(has_post_thumbnail()){
				the_post_thumbnail();
			}
			
			the_content( sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'eblog-lite' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			) );

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'eblog-lite' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->
	<!-- Related Posts  -->
	<div class="related-post">
		<div class=" post-header ">
			<h2><?php echo esc_html__('Related Posts','eblog-lite'); ?></h2>
		</div>
		<div id="related_posts" class="related-post ">
			<div class="row">
			<?php 
				$related = get_posts( array( 'category__in' => wp_get_post_categories($post->ID), 'numberposts' => 6, 'post__not_in' => array($post->ID) ) );
				if( $related ) foreach( $related as $post ) {
				setup_postdata($post); 
			?>
				<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 col-xs-12">
					<article class="post-article">
						<figure class="post-image"> 
							<a class="image-link" href="<?php the_permalink(); ?>">
								<?php the_post_thumbnail( 'medium' ); ?>
							</a>
						</figure>
						<div class ="section-meta">
							<span class="meta-date"><i class="fa fa-clock-o" aria-hidden="true"></i><?php the_time(get_option('date_format' )); ?></span>
							<?php  if (get_theme_mod('eblog_lite_viewe_enable',false)): echo getPostViews( get_the_ID() ); endif;?>
							<h4 class="meta-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
							
						</div>
					</article>        
				</div>
				<?php } 
					wp_reset_query();
				?>
			</div>
		</div>
	</div>
	<!-- ./Related Posts --> 

	<footer class="entry-footer">
		<?php eblog_lite_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
			<?php
			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
setPostViews(get_the_ID());
get_sidebar();
get_footer();
