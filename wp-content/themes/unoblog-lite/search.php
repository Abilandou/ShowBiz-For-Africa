<?php get_header(); ?>
	
	<?php if (have_posts()) : ?>
	
	<div class="archive-box">
		
		<h1 class="page-title">
		<?php 
		/* translators: used search keyword */
		printf( esc_html__( 'Search Results for: %s', 'unoblog-lite' ), '<span>' . get_search_query() . '</span>' ); 
		?>
		</h1>
		
	</div>
	
	<div class="container unoblog_lite_sidebar">
	
		<div id="main">
	
		<ul class="unoblog-grid">
	
		<?php while (have_posts()) : the_post(); ?>
							
			<?php get_template_part('template-parts/content'); ?>
				
		<?php endwhile; ?>
		
		</ul>
		
		</div>
		
	<?php else : ?>
		
		<div class="archive-box">
	
			<h1 class="page-title">
			<?php 
			/* translators: used search keyword */
			printf( esc_html__( 'Search Results for: %s', 'unoblog-lite' ), '<span>' . get_search_query() . '</span>' ); 
			?>
			</h1>
			
		</div>
		
		<div class="container unoblog_lite_sidebar">
			
			<div id="main">
			
				<p class="nothing"><?php esc_html_e( 'Sorry, no posts were found. Try searching for something else.', 'unoblog-lite' ); ?></p>
			
			</div>
		
	<?php endif; ?>

<?php get_sidebar(); ?>
<?php get_footer(); ?>