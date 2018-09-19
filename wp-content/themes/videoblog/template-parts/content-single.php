<?php
/**
 * Template part for displaying single posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Videoblog
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="ilovewp-page-intro ilovewp-page-inner">
		<h1 class="title-page"><?php the_title(); ?></h1>
		<p class="post-meta"><?php _e('By','videoblog'); ?> <?php echo esc_url( the_author_posts_link() ); ?> 
		<?php _e('in','videoblog'); ?> <span class="post-meta-category"><?php the_category(' '); ?></span> <span class="posted-on"><span class="genericon genericon-time"></span> <time class="entry-date published" datetime="<?php echo get_the_date('c'); ?>"><?php echo get_the_date(); ?></time></span></p>
	</header><!-- .ilovewp-page-intro -->

	<div class="post-single clearfix">

		<?php
			the_content( sprintf(
				/* translators: %s: Name of current post. */
				wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'videoblog' ), array( 'span' => array( 'class' => array() ) ) ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) );
		?>

		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'videoblog' ),
				'after'  => '</div>',
			) );
		?>

		<?php
		$tags_list = get_the_tag_list( '', esc_html__( ', ', 'videoblog' ) );
		if ( $tags_list ) {
			/* translators: List of tags */ printf( '<p class="tags-links">' . esc_html__( 'Tags: %1$s', 'videoblog' ) . '</p>', $tags_list ); // WPCS: XSS OK.
		}
		?>

	</div><!-- .post-single -->

</article><!-- #post-<?php the_ID(); ?> -->