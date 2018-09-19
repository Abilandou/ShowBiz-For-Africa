<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Videoblog
 */

?>

<?php global $videoblog_i; $videoblog_i++; ?>

<?php $classes = array('ilovewp-post','ilovewp-post-archive','ilovewp-post-'.$videoblog_i, 'clearfix'); ?>

<li <?php post_class($classes); ?>>

	<article id="post-<?php the_ID(); ?>">
	
		<?php if ( has_post_thumbnail() ) : ?>
		<div class="post-cover-wrapper">
			<div class="post-cover">
				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
				<?php the_post_thumbnail(); ?>
				</a>
			</div><!-- .post-cover -->
		</div><!-- .post-cover-wrapper -->
		<?php endif; ?>
	
		<div class="post-preview">
			<span class="post-meta-category"><?php the_category(esc_html_x( ', ', 'Used on archive and post pages to separate multiple categories.', 'videoblog' )); ?></span>
			<?php the_title( /* translators: post URL */ sprintf( '<h2 class="title-post"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
			<p class="post-meta">
				<span class="posted-on"><span class="genericon genericon-time"></span> <time class="entry-date published" datetime="<?php echo get_the_date('c'); ?>"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php /* translators: %s = human-readable time difference */ printf( _x( '%s ago', '%s = human-readable time difference', 'videoblog' ), human_time_diff( get_the_time( 'U' ), current_time( 'timestamp' ) ) ); ?></a></time></span>
			</p><!-- .post-meta -->
		</div><!-- .post-preview -->
	
	</article><!-- #post-<?php the_ID(); ?> -->

</li><!-- .ilovewp-post .ilovewp-post-archive .clearfix -->

<?php if ( $videoblog_i == 4) { $videoblog_i = 0; } ?>