<?php get_header(); ?>
	
	<?php if (have_posts()) : ?>
	
	<div class="archive-box">
		
	<h1 class="page-title">
    <?php 
    /* translators: Tag titile */
    printf( esc_html__( 'Browsing Tag: %s', 'unoblog-lite' ), '<span>' . single_tag_title( '', false ) . '</span>' ); 
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
		
		<?php the_posts_pagination( 
            array(
                'mid_size'  => 2,
                'prev_text' => __( '&laquo; Previous', 'unoblog-lite' ),
                'next_text' => __( 'Next &raquo;', 'unoblog-lite' ),
            ) 
        );?>
		
		<?php endif; ?>
		
	</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>