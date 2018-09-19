<?php
/* Template Name: Home page */
get_header(); ?>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <?php dynamic_sidebar( 'fullwidth-home-page-widget' ); ?>
        </div>
    </div>
    <div id="content" class="site-content">
        <?php if ( is_active_sidebar( 'home-page-widget' ) ) :?>
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    <?php dynamic_sidebar( 'home-page-widget' ); ?>
                </div>
                
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 ">
                    <?php dynamic_sidebar( 'sidebar-1' ); ?>
                </div>
            </div>
        <?php endif; ?>
<?php
get_footer();
