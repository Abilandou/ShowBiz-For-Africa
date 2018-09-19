<?php
/* Template Name: Home page */
get_header(); ?>
    <?php dynamic_sidebar('fullwidth-home-page-widget'); ?>
    <div id="content" class="site-content">
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                <?php dynamic_sidebar( 'home-page-widget' ); ?>
            </div>
            
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 ">
                <?php dynamic_sidebar( 'sidebar-1' ); ?>
            </div>
        </div>
<?php
get_footer();
