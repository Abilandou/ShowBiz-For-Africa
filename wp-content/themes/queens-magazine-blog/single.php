<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Postmagthemes
 * @subpackage queens_magazine_blog
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main ">
			<div class ="row " >
			
			<?php get_template_part( 'inc/layout/layout-1' ); ?>
			
			</div>
    	</main><!--- #main -->
	</div>
<?php get_footer();