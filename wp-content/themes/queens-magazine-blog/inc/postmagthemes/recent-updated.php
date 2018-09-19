<?php
/**
 * Sub Template part for displaying recent update posts.
 *
 *
 * @package Postmagthemes
 * @subpackage queens_magazine_blog
 */
?>
<header class="page-header most3"  >
    <div >
        <h2 id="recent-update" class ="most3 theme-text-color" > <?php echo esc_html(get_theme_mod('queens_magazine_blog_recent_update', __('RECENT UPDATE', 'queens-magazine-blog') )) ?> </h2>
    </div>
</header><!-- .page-header -->
<div class="row w-100 mr-0 ml-0 pt-4" >
    <?php
    $noofpost = get_theme_mod('queens_magazine_blog_recent_update_noofpost','4'); 
    $args = array( 
        'post_type'      => 'post',
        'orderby' => 'modified',
        'order'     => 'DSC',
        'posts_per_page' => -1,

    );
    $i = 1;
    $listings = new WP_Query( $args );
    if ( $listings->have_posts() ) :

        if ( is_home() && ! is_front_page() ) :
            ?>
            <header>
                <h1 class="page-title screen-reader-text"><?php echo esc_html(single_post_title()); ?></h1>
            </header>
            <?php
        endif;
        
        /* Start the Loop */
        while ( $listings->have_posts() ) :
            $listings->the_post();

            if (is_sticky()) {
                // ignore sticy post
            } else {
            
                // Normal post content
            
                $pub = esc_attr( get_the_time('Y-m-d-g:i a', $listings->ID) ); // date when post was published
                $mod = esc_attr( get_the_modified_time('Y-m-d-g:i a', $listings->ID) ); // date when post was last modified
                if ($i <= $noofpost) :
                    if ( $mod > $pub) :
                    ?>
                    <div class = "row mb-4 mr-0 ml-0 col-lg-6 col-md-12" >
                        <div class = "col-lg-6 pr-0 pl-0 text-center" > 
                            <?php get_template_part( 'template-parts/content-titles-1' ); ?>
                        </div>
                        <div id="title2-section" class = "col-lg-6 col-md-6 wow fadeInUp pr-0 pl-4"  >
                            <?php get_template_part( 'template-parts/content-rupdate-2' ); ?>
                        </div>
                    </div>
                    <?php
                    $i = $i + 1;
                    endif;
                    
                endif;
            }
                
        endwhile;

        wp_reset_postdata();
        
    endif;
    if ($i == 1) :
        ?>
            <div class = "col-lg-12 col-md-12 text-right ml-0 mr-0" >
                <?php esc_html_e( '..recently there is no post updated', 'queens-magazine-blog'); ?>
             </div>
        <?php
        $i = $i + 1;
    endif;
    
    ?>


</div>