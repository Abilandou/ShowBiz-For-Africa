<?php
/**
 * Template part for displaying image in square.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 * @package Postmagthemes
 * @subpackage queens_magazine_blog
 */
?>

<?php
if ( ! has_post_thumbnail() ) {
	if ( strpos( esc_attr(get_the_content()), 'video width=' ) ) {
?>		
		<div class  = "embed-responsive-16by9 margin-bottom" >
			<?php echo queens_magazine_blog_get_embedded_media(); ?>
		</div>
	<?php } else if ( strpos( esc_attr(get_the_content()), __('iframe width=','queens-magazine-blog' ) ) or strpos( esc_attr(get_the_content()), __('youtube.com/watch','queens-magazine-blog' ) ) or strpos( esc_attr(get_the_content()), __('.tv/','queens-magazine-blog' ) )) { ?>
		<div class  = "embed-responsive embed-responsive-16by9 margin-bottom" >
			<?php echo queens_magazine_blog_get_embedded_media();?>
		</div>
	<?php } else { ?>
		<div>
		<img src = "<?php echo esc_url( get_template_directory_uri() ); ?>/images/photo1_square.jpeg " >
		</div>
	<?php }
} else if ( has_post_thumbnail() ) {
	queens_magazine_blog_post_thumbnail_recent();
}
?>
