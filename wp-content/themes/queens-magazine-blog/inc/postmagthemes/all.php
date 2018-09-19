<?php
/**
 * Sub Template part for displaying single, category, author , search and archive posts.
 *
 *
 * @package Postmagthemes
 * @subpackage queens_magazine_blog
 */
?>
<header class="page-header ">
    <div >
        <?php if ( is_category() ) { ?>
            <h2 id = "category" class ="most2 theme-text-color" > <?php echo esc_html( the_archive_title() ); ?> </h2>
        <?php } else if ( is_tag() ) { ?>
            <h2 id ="tag" class ="most2 theme-text-color" > <?php esc_html_e(' TAG ','queens-magazine-blog'); echo esc_html( single_tag_title() ) ?> </h2>
        <?php } else if ( is_author() ) { ?>
            <h2 id ="auther" class ="most2 theme-text-color" ><?php esc_html_e(' AUTHOR ','queens-magazine-blog'); the_author();  ?> </h2>
        <?php } else if ( is_archive() ) { ?>
            <h2 id ="archive" class ="most2 theme-text-color" ><?php esc_html_e(' ARCHIVE ','queens-magazine-blog'); echo esc_html( single_month_title() );  ?></h2> 
        <?php } else if ( is_home() ) { ?>
            <h2 id ="home" class ="most2 theme-text-color"><?php echo esc_html( get_theme_mod('queens_magazine_blog_most_recent', __('MOST RECENT','queens-magazine-blog'))) ?></h2> 
            <?php } else if ( is_search() ) { ?>
            <h2 id ="home" class ="most2 theme-text-color">
            <?php
                /* translators: %s: search query. */
                printf( esc_html__( 'SEARCH RESULTS FOR: %s', 'queens-magazine-blog' ), '<span>' . get_search_query() . '</span>' );
                ?>
            </h2> 
        <?php } ?> 
    </div>

</header><!-- .page-header -->
    <div class=" row pt-4 all-border-white mr-0 ml-0" >
        <?php
        if ( have_posts() ){
            while ( have_posts() ){
                the_post();
                if (absint(get_theme_mod('queens_magazine_blog_most_recent_listgrid','2')) == 1) {
                    $mode1 = 12;
                    $mode2 = 6;
                    ?> <div  class = " row mr-0 ml-0 mb-4 wow fadeInUp col-lg-<?php echo absint($mode1) ?> col-md-6 pr-1 pl-1"  >
                    <?php
                } else {
                    $mode1 = 6;
                    $mode2 = 12;
                    ?> <div class = " d-inline row mr-0 ml-0 mb-4 wow fadeInUp col-lg-<?php echo absint($mode1) ?> col-md-6 pr-1 pl-1"  >
                    <?php
                }
                if (is_sticky()) {
                ?>
                    <div class = " border rounded border-dark col-lg-<?php echo esc_attr($mode2) ?> col-md-12 "> 
                        <?php get_template_part( 'template-parts/content-titles-1' ); ?>
                    </div>
                <?php } else {
        ?>
                    <div class = "col-lg-<?php echo esc_attr($mode2) ?> col-md-12 "> 
                        <?php get_template_part( 'template-parts/content-titles-1' ); ?>
                    </div>
                <?php } ?>
                    <div id="title2-section" class = " col-lg-<?php echo absint($mode2) ?> col-md-12 "  >
                        <?php get_template_part( 'template-parts/content-titles-2' ); ?>
                    </div>
            </div>
                
            <?php }
            
        } else {
        get_template_part( 'template-parts/content', 'none' );
        } ?>
        
    </div>

<div class=" text-center mb-5">
    <?php 
    if ( is_search() ) { 
        the_posts_pagination( array(
            'pre_text' => __('Previous', 'queens-magazine-blog'),
            'next_text' => __('Next', 'queens-magazine-blog'),
        )); 
    } else if (function_exists("queens_magazine_blog_pagination")) {
    queens_magazine_blog_pagination();
    }
    ?>
</div>
 
