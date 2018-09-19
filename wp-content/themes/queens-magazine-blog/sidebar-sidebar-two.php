<?php
/**
 * The sidebar containing the widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Postmagthemes
 * @subpackage queens_magazine_blog
 */

if ( ! is_active_sidebar( 'sidebar-two' ) ) {
	return;
}
?>

<aside id="secondary" class="widget-area ">
	<div id = "sidebar2" class= " wow fadeInUp">
		<?php dynamic_sidebar( 'sidebar-two' );?>
	</div>
</aside><!-- #secondary -->