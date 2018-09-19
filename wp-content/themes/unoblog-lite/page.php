<?php get_header(); ?>
	
	<div class="container">
	
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
							
		<?php get_template_part('template-parts/content', 'page'); ?>
							
	<?php endwhile; endif; ?>

<?php get_footer(); ?>