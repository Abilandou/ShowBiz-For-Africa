<?php get_header(); ?>
	
	<div class="container unoblog_lite_sidebar">
	
	<div id="main">
	
	<ul class="unoblog-grid">
	<?php $post_counter=0; ?>
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
						
		<?php get_template_part('template-parts/content', 'grid'); ?>

	<?php endwhile; ?>
	
	</ul>
	
	<?php the_posts_pagination( 
			array(
				'mid_size' 	=> 2,
				'prev_text' => __( '&laquo; Previous', 'unoblog-lite' ),
				'next_text' => __( 'Next &raquo;', 'unoblog-lite' ),
			) 
	);?>
	
	<?php endif; ?>
	
	</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>