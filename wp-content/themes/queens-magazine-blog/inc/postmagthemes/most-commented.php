<?php
/**
 * Sub Template part for displaying Most commented section.
 *
 *
 * @package Postmagthemes
 * @subpackage queens_magazine_blog
 */
?>

<header class="page-header  theme-background-color">
    <div >
        <h2 id="most-commented" class ="most1"> <?php echo esc_html(get_theme_mod('queens_magazine_blog_most_commented', __('MOST COMMENTED', 'queens-magazine-blog') )) ?> </h2>
    </div>
</header><!-- .page-header -->
<div class="row pt-5 " >
    <?php
    $noofpost = get_theme_mod ('queens_magazine_blog_most_commented_noofpost', '7') ;

    $args = array( 
            'post_type'      => 'post',
            'orderby' => array( 'comment_count' => 'DSC', 'date' => 'DSC'),
            'order'     => 'DSC',
            'posts_per_page' => absint( $noofpost ),
        );
    $listings = new WP_Query( $args );
    if ( $listings->have_posts() ) :

        /* Start the Loop */
        while ( $listings->have_posts() ) :
            $listings->the_post();

            /*
            * Include the Post-Type-specific template for the content.
            * If you want to override this in a child theme, then include a file
            * called content-___.php (where ___ is the Post Type name) and that will be used instead.
            */
            if (is_sticky()) {
                // ignore sticy post
            } else {
                // Normal post content
                ?>
                <div class = "col-lg-12 col-md-12 wow fadeInUp mb-5" >
                    <?php get_template_part( 'template-parts/content' ); ?>
                </div>
                <?php
            }
                
            endwhile; 
            wp_reset_postdata();
    else :
        get_template_part( 'template-parts/content', 'none' );
    endif; ?>

</div>