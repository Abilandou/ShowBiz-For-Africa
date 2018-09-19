<?php
/**
 * The template part for displaying slider
 *
 * @package Advance Blogging
 * @subpackage advance_blogging
 * @since Advance Blogging 1.0
 */
?>

<div id="post-<?php the_ID(); ?>" <?php post_class('inner-service'); ?>>
    <div class="postbox smallpostimage">
        <div class="postimage">
            <?php 
                if(has_post_thumbnail()) { ?>
                    <?php the_post_thumbnail();  ?>
                <div class="metabox">
                    <div class="dateday"><?php echo esc_html( get_the_date( 'd') ); ?></div>
                    <hr class="metahr m-0 p-0">
                    <div class="month"><?php echo esc_html( get_the_date( 'M' ) ); ?></div>
                    <div class="year"><?php echo esc_html( get_the_date( 'Y' ) ); ?></div>
                </div>
            <?php } ?>
        </div>
        <div class="new-text">
            <div class="box-content">
                <h2><?php the_title();?></h2>
                <p><?php echo the_excerpt(); ?></p>
                <a href="<?php echo esc_url( the_permalink() );?>" class="blogbutton-small" title="<?php esc_attr_e( 'READ MORE', 'advance-blogging' ); ?>"><?php esc_html_e('READ MORE','advance-blogging'); ?></a>
            </div>
        </div>
        <div class="clearfix"></div> 
    </div> 
</div>