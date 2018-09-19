<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		
		<?php if(has_post_format('gallery')) : ?>
	
		<?php $images = get_post_meta( $post->ID, '_format_gallery_images', true ); ?>
		
		<?php if(has_post_thumbnail()) : ?>

		<div class="post-image">
			<a href="<?php echo esc_url(get_permalink()); ?>"><?php the_post_thumbnail('unoblog-lite-full-thumb'); ?></a>
		</div>

		<?php endif; ?>
		
	<?php endif; ?>

	<div class="post-header">
		
		<span class="cat"><?php unoblog_lite_category(', '); ?></span>
		
		<?php if(is_single()) : ?>
			<h1><?php the_title(); ?></h1>
		<?php else : ?>
			<h2><a href="<?php echo esc_url(get_permalink()); ?>"><?php the_title(); ?></a></h2>
		<?php endif; ?>
		
		<span class="date"><?php the_time( get_option('date_format') ); ?></span>
		
	</div>

	<div class="post-entry">

		<?php the_content(__('Continue Reading...', 'unoblog-lite')); ?>
		<?php wp_link_pages(); ?>
		
		<?php if(is_single()) : ?>
			<div class="post-tags">
				<?php the_tags("",""); ?>
			</div>
		<?php endif; ?>

	</div>
	
	
	<?php if(is_single()) : ?>
		<?php get_template_part('inc/templates/about_author'); ?>
	<?php endif; ?>
	
	<?php comments_template( '', true );  ?>
	
	<?php if(is_single()) : ?>
		<?php get_template_part('inc/templates/post_pagination'); ?>
	<?php endif; ?>
	
</article>