<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package eBlog Lite
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'eblog-lite' ); ?></a>

	<div id="navArea">
		<div class="container">
			<div class="top_header_menu">
				<nav  class="main-navigation">
					<?php
						wp_nav_menu( array(
							'theme_location' => 'top-bar-menu',
							'menu_id'        => 'top-bar-menuu',
						) );
					?>
					<div class="header-social">
						<?php do_action('eblog_lite_footer_social_links'); ?>
					</div>
				</nav>
			</div>
		</div>
	</div>
	<header id="masthead" class="site-header" style="background:url(<?php echo esc_url(get_header_image())?>) center no-repeat;">
		<div class="container">
		<div class="site-branding">
			<?php
			the_custom_logo();
			if ( is_front_page() && is_home() ) : ?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<?php else : ?>
				<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
			<?php
			endif;

			$description = get_bloginfo( 'description', 'display' );
			if ( $description || is_customize_preview() ) : ?>
				<p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
			<?php
			endif; ?>
			
		</div><!-- .site-branding -->
		<?php if (  is_active_sidebar( 'header-add-widget' ) ) { ?>
				<div class="header-add  hidden-xs">
					<?php  dynamic_sidebar( 'header-add-widget' ); ?> 
				</div>
			<?php } ?>
		</div>

		<nav id="site-navigation" class="main-navigation">
		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-1">
			<span class="sr-only"><?php esc_html_e('Toggle navigation','eblog-lite'); ?></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
			<?php
				wp_nav_menu( array(
					'theme_location' => 'menu-1',
					'menu_id'        => 'primary-menu',
				) );
			?>
		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->

	<?php if( !( is_front_page() ) ) ://Show Static Blog Page ?>
		<div id="content" class="site-content">
	<?php endif ?>
