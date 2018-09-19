<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>

    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11" />

    <?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>


    <nav id="navigation">

        <div class="container">

            <div id="navigation-wrapper">
                <?php wp_nav_menu( array( 'container'=> false, 'theme_location' => 'main-menu', 'menu_class' => 'menu' ) ); ?>
            </div>

            <div class="menu-mobile"></div>

            <div id="top-search">
               <a href="#"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/img/searchicon.png" /></a>
            </div>
            <div class="show-search">
                <?php get_search_form(); ?>
            </div>
          
        </div>

    </nav>

    <header id="header">

        <div class="container">

            <div id="brand">   

                <?php the_custom_logo(); ?>    

                <?php if ( is_front_page() ) : ?>
                <h1><a class="site-title" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                <?php else : ?>
                <h2><a class="site-title-two" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h2>
                <?php endif; ?>

                <?php
                $description = get_bloginfo( 'description', 'display' );
               
                if ( $description || is_customize_preview()) :
                ?>

                <p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
                <?php endif; ?>
            </div><!-- .brand -->
            
            <div style="clear:both;"></div>

        </div>

    </header>
