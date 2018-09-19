<?php
/**
 * The template part for displaying slider
 *
 * @package Advance Blogging
 * @subpackage tc_blog
 * @since Advance Blogging 1.0
 */
?>
<div class="col-md-4 col-sm-4">
    <div id="post-<?php the_ID(); ?>" <?php post_class('inner-service'); ?>>
        <div class="smallpostimage">
            <div class="postimage">
                <?php 
                    if(has_post_thumbnail()) { ?>
                    <?php the_post_thumbnail();  ?>
                <?php } ?>
            </div>
            <div class="box-content">
                <h2><?php the_title();?></h2>
                <p><?php echo the_excerpt(); ?></p>
                <a href="<?php echo esc_url( the_permalink() );?>" class="blogbutton-small" title="<?php esc_attr_e( 'READ MORE', 'advance-blogging' ); ?>"><?php esc_html_e('READ MORE','advance-blogging'); ?></a>
            </div>
            <div class="clearfix"></div> 
        </div>
    </div>
</div>