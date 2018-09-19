<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		
	<div class="post-header">
		
		<h1><?php the_title(); ?></h1>
		
	</div>
	
	<?php if ( (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) ) : ?>
	<div class="post-image">
		<a href="<?php echo esc_url(get_permalink()); ?>"><?php the_post_thumbnail('unoblog-lite-full-thumb'); ?></a>
	</div>
	<?php endif; ?>
	
	<div class="post-entry">
	
		<?php the_content(); ?>
		<?php wp_link_pages(); ?>
	
	</div>
	
	<?php comments_template( '', true );  ?>
	
</article>