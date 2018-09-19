<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package eBlog Lite
 */
get_header();

	if ( have_posts() ) :
		
		
		//Conctions for the post display
		$post_list = array();
		$first_post = array();
		$count = 0 ;
		$eblog_lite_num_post_slide = get_theme_mod('eblog_lite_num_post_slide',4);
		$eblog_lite_post_is_exclusive  = get_theme_mod('eblog_lite_archive_slider_post_exclusive',false);

		
		//Start While Loop
		while ( have_posts() ) : the_post();
			$post_list[] = $post;
			if( $count < $eblog_lite_num_post_slide and has_post_thumbnail( ) ):
				if( $eblog_lite_post_is_exclusive ):
					$first_post[] = array_shift($post_list);
				elseif( has_post_thumbnail() ):
					$first_post[] = $post;
					
				endif;
			endif;
			$count++;//increment the file
		endwhile; // End of the loop.
		
		//eBlog Lite Post Slider Section
		if( get_theme_mod( 'eblog_lite_slider_enable',true ) == true ):

			?>
			<!-- Slider start -->
			<div id="eblog_lite_main_slider" class="owl-carousel owl-theme center-owl-nav">
				
				<?php foreach ( $first_post as $post ) : setup_postdata( $post ); ?>
				
					<!-- post slider loop stat -->
					<article class="article thumb-article">
						<div class="article-img">
							<?php the_post_thumbnail('eblog-lite-thumbnail-slider'); ?>
						</div>
						<div class="article-body">
							<?php the_category(); ?>
							<h2 class="article-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
							<ul class="article-meta">
								<li><i class="fa fa-clock-o"></i><?php the_time(get_option('date_format' )); ?></li>
								<li><?php  echo getPostViews( get_the_ID() ); ?></li>
								<li><i class="fa fa-comments"></i> <?php printf( esc_html( _n( '%d Comment', '%d Comments', get_comments_number(), 'eblog-lite'  ) ), esc_html(number_format_i18n(get_comments_number()))); ?></li>
							</ul>
						</div>
					</article>
					<!-- /slider loop stat -->

				<?php endforeach; ?>
			</div>
		<?php endif; ?>
	<!-- /Slider Section -->
	<div id="content" class="site-content">
	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php
			if ( is_home() && ! is_front_page() ) : ?>
				<header>
					<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
				</header>

			<?php
			endif;

				/* Start the Loop */
				foreach( $post_list as $post): setup_postdata($post);

					/*
					* Include the Post-Format-specific template for the content.
					*/
					get_template_part( 'template-parts/content', get_post_format() );
				endforeach; // End of the loop.

				?>

				<div class="pagination wraper-pagination">
				<?php the_posts_pagination( array(
						'mid_size' => 2,
						'prev_text' => __( '<', 'eblog-lite' ),
						'next_text' => __( '>', 'eblog-lite' ),
					) ); ?>
				</div>
				<?php
		else :
			get_template_part( 'template-parts/content', 'none' );
			?>
		<?php endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
