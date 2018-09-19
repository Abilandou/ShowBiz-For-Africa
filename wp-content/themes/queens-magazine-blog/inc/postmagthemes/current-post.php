<?php
/**
 * Sub Template part for displaying current posts.
 *
 *
 * @package Postmagthemes
 * @subpackage queens_magazine_blog
 */
?>
<header class="page-header ">
    <div >
        <h2 id="current-post" class ="most1 theme-text-color"> <?php  esc_html_e(' CURRENT POST ','queens-magazine-blog') ?> </h2>
    </div>
</header><!-- .page-header -->
<div class="all-border-white row mr-0 ml-0" >

    <?php
    while ( have_posts() ) :
        
        the_post();
    ?>
        <div class="entry-content wow fadeInUp col-lg-12 pr-3 pl-3">
        <?php 
            the_post_navigation();
            get_template_part( 'template-parts/content-singular' );
            the_content( sprintf(
                wp_kses(
                    /* translators: %s: Name of current post. Only visible to screen readers */
                    __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'queens-magazine-blog' ),
                    array(
                        'span' => array(
                            'class' => array(),
                        ),
                    )
                ),
                esc_html( get_the_title() )
            ) );
            wp_link_pages( array(
                'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'queens-magazine-blog' ),
                'after'  => '</div>',
            ) );   
            
            // If comments are open or we have at least one comment, load up the comment template.
            if ( comments_open() || get_comments_number() ) :
                comments_template();
            endif;
            the_post_navigation();
        ?>
        </div><!-- .entry-content -->
        <?php
    endwhile; ?>
</div>