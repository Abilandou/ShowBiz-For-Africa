<?php get_header(); ?>
	
	<div class="container unoblog_lite_sidebar">
	
	<div id="main">
	
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
							
		<?php get_template_part('template-parts/content'); ?>
							
	<?php endwhile; endif; ?>
	
	</div>
	
<?php get_sidebar(); ?>
<?php get_footer(); ?>