<div class="post-author">
		
	<div class="author-img">
		<?php echo get_avatar( get_the_author_meta('email'), '100' ); ?>
	</div>
	
	<div class="author-content">
		<h5><?php the_author_posts_link(); ?></h5>
		<p><?php the_author_meta('description'); ?></p>
	</div>
	
</div>