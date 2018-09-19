<?php get_header(); ?>
	
	<?php if (have_posts()) : ?>
	
	
	<div class="container">
	
	<div id="main">
	
		<ul class="unoblog-grid">
	
		<?php while (have_posts()) : the_post(); ?>
							
			<?php get_template_part('template-parts/content'); ?>
				
		<?php endwhile; ?>
		
		</ul>
		
		<?php the_posts_pagination( 
			array(
				'mid_size' 	=> 2,
				'prev_text' => esc_html__( '&laquo; Previous', 'unoblog-lite' ),
				'next_text' => esc_html__( 'Next &raquo;', 'unoblog-lite' ),
			) 
		);?>
		
		<?php endif; ?>
		
	</div>
	
<?php get_footer(); ?>