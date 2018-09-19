<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content-aa">
 *
 * @package Advance Blogging
 */

?><!DOCTYPE html>

<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width">
  <link rel="profile" href="<?php echo esc_url( __( 'http://gmpg.org/xfn/11', 'advance-blogging' ) ); ?>">
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?> class="main-bodybox">
  <div class="toggle"><a class="toggleMenu" href="#"><?php esc_html_e('Menu','advance-blogging'); ?></a></div>

  <div class="topbar">
    <div class="container">    
      <div class="row">
        <div class="col-md-11 social-icons ">
          <?php if( get_theme_mod( 'advance_blogging_facebook_url' ) != '') { ?>
            <a href="<?php echo esc_url( get_theme_mod( 'advance_blogging_facebook_url','' ) ); ?>"><i class="fab fa-facebook-f" aria-hidden="true"></i></a>
          <?php } ?>
          <?php if( get_theme_mod( 'advance_blogging_twitter_url' ) != '') { ?>
            <a href="<?php echo esc_url( get_theme_mod( 'advance_blogging_twitter_url','' ) ); ?>"><i class="fab fa-twitter" aria-hidden="true"></i></a>
          <?php } ?>
          <?php if( get_theme_mod( 'advance_blogging_googleplus_url' ) != '') { ?>
            <a href="<?php echo esc_url( get_theme_mod( 'advance_blogging_googleplus_url','' ) ); ?>"><i class="fab fa-google-plus-g"></i></a>
          <?php } ?>
          <?php if( get_theme_mod( 'advance_blogging_pinterest_url' ) != '') { ?>
            <a href="<?php echo esc_url( get_theme_mod( 'advance_blogging_pinterest_url','' ) ); ?>"><i class="fab fa-pinterest-p"></i></a>
          <?php } ?>
          <?php if( get_theme_mod( 'advance_blogging_linkedin_url' ) != '') { ?>
            <a href="<?php echo esc_url( get_theme_mod( 'advance_blogging_linkedin_url','' ) ); ?>"><i class="fab fa-linkedin-in"></i></a>
          <?php } ?>
          <?php if( get_theme_mod( 'advance_blogging_insta_url' ) != '') { ?>
            <a href="<?php echo esc_url( get_theme_mod( 'advance_blogging_insta_url','' ) ); ?>"><i class="fab fa-instagram"></i></a>
          <?php } ?>
          <?php if( get_theme_mod( 'advance_blogging_youtube_url' ) != '') { ?>
            <a href="<?php echo esc_url( get_theme_mod( 'advance_blogging_youtube_url','' ) ); ?>"><i class="fab fa-youtube" aria-hidden="true"></i></a>
          <?php } ?>
        </div>
        <div class="search-box col-md-1 col-sm-1">
          <span class="search-icon"><i class="fas fa-search"></i></span>
        </div>
      </div>  
       <div class="serach_outer">
        <div class="closepop"><i class="far fa-window-close"></i></div>
        <div class="serach_inner">
          <?php get_search_form(); ?>
        </div>
      </div>
    </div>
  </div>
  <div id="header">
      <div class="logo">
        <?php if( has_custom_logo() ){ advance_blogging_the_custom_logo();
           }else{ ?>
          <h1><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
          <?php $description = get_bloginfo( 'description', 'display' );
          if ( $description || is_customize_preview() ) : ?> 
            <p class="site-description"><?php echo esc_html($description); ?></p>       
        <?php endif; }?>
      </div>
    <div class="container">
      <div class="row menu-cart">
        <div class="col-md-10 col-sm-10 p-0">
          <div class="menubox nav">
            <?php wp_nav_menu( array('theme_location'  => 'primary') ); ?>
          </div>
          <div class="clear"></div>
        </div>
        <div class=" col-md-2 col-sm-2 cart m-0">
          <?php if(class_exists('woocommerce')){ ?>
            <span class="cart-box"><i class="fab fa-opencart"></i><?php  esc_html_e( 'CART','advance-blogging' ); ?></span></a> 
            <div class="top-cart-content">
               <?php the_widget( 'WC_Widget_Cart', 'title=' ); ?>
            </div>
          <?php } ?>      
        </div> 
      </div> 
    </div>
  </div>