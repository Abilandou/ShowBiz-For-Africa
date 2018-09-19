<?php
/**
 * Template Name:Page with Left Sidebar
 */

get_header(); ?>

<?php do_action( 'advance_blogging_header_page_left' ); ?>

<div class="container">
    <div class="middle-align row">       
		<div class="col-md-4" id="sidebar">
			<?php dynamic_sidebar('sidebar-2'); ?>
		</div>		 
		<div class="col-md-8" id="content-aa" >
            <?php while ( have_posts() ) : the_post(); ?>
                <img src="<?php the_post_thumbnail_url('full'); ?>" width="100%">
                <h1><?php the_title(); ?></h1>
                <?php the_content();?>
            <?php endwhile; // end of the loop. ?>
            <?php
                //If comments are open or we have at least one comment, load up the comment template
                if ( comments_open() || '0' != get_comments_number() )
                    comments_template();
            ?>
            <div class="clear"></div> 
        </div>  
    </div>
</div>

<?php do_action( 'advance_blogging_footer_page_left' ); ?>

<?php get_footer(); ?>