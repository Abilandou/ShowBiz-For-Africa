<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package eBlog Lite
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="row">
		<?php if(has_post_thumbnail()){ ?>
			<div class=" col-lg-6"><a href="<?php the_permalink(); ?>">
					<?php  the_post_thumbnail(); ?>
				</a>
			</div>
		<?php } ?>
		<?php if(has_post_thumbnail()): ?>
			<div class="  col-lg-6">
		<?php else: ?>
			<div class="col-sm-12 col-lg-12 ">
		<?php endif; ?>
			<header class="entry-header">
				<div class="header-title">
					<?php
					if ( is_singular() ) :
						the_title( '<h1 class="entry-title">', '</h1>' );
					else :
						the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
					endif; ?>
				</div>
				
			</header><!-- .entry-header -->

			<div class="entry-content">
				<?php

					the_excerpt( sprintf(
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
				<div class="entry-more"> <a href="<?php echo esc_url(get_the_permalink()); ?>" class="button"><?php echo esc_html__('Continus reading','eblog-lite'); ?> &nbsp; <i class="fa fa-angle-double-right"></i></a> </div>
			</div><!-- .entry-content -->

			<footer class="entry-footer">
				<?php eblog_lite_entry_footer(); ?>
			</footer><!-- .entry-footer -->
		</div>
	</div>