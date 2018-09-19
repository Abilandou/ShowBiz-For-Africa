<?php
/**
 * template for layout-1
 * Left Sidebar / Primarybar / Right Sidebar
 * @package Postmagthemes
 * @subpackage queens_magazine_blog
 */
?>
<div class=" col-lg-3 col-md-4 left-background pr-0 pl-0 " >

    <?php if ( absint(get_theme_mod('queens_magazine_blog_most_commented_enable','1')) == 1) { ?>
        <div class ="image-changeon-most-commented">
            <?php get_template_part( 'inc/postmagthemes/most-commented' ); ?>
        </div>
    <?php } ?>

    <div>
        <?php get_sidebar( 'sidebar-two' );?>
    </div>

</div>

<div id="most-recent" class = " col-lg-6 col-md-8 central-background" >

    <div class ="image-changeon-recentpost">
        <?php if ( is_singular() ) {
            get_template_part( 'inc/postmagthemes/current-post' ); 
        } else {
            get_template_part( 'inc/postmagthemes/all' ); 

        }
        ?>

    </div>

    <div>
        <?php get_sidebar( 'primarybar' );?>
    </div>
</div>

<div class = "col-lg-3 col-md-12 pr-0 pl-0 right-background" >
    
    <div class ="sidebar-misc">
        <?php get_sidebar(); ?>
    </div>

</div>
