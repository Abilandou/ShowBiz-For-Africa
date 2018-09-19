<li>
	<article id="post-<?php the_ID(); ?>" class="item">
		
		<a href="<?php echo esc_url(get_permalink()); ?>"><?php the_post_thumbnail('unoblog-lite-thumb'); ?></a>
		
		<div class="item-content">
			<h2><a href="<?php echo esc_url(get_permalink()); ?>"><?php the_title(); ?></a></h2>
			<?php the_excerpt(); ?>
			<span class="date"><?php the_time( get_option('date_format') ); ?></span>
		
		</div>
		
	</article>
</li>