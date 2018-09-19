<?php

/**
 * queens magazine blog CSS Customizer
 *
 * @package Postmagthemes
 * @subpackage queens_magazine_blog
 */

function queens_magazine_blog_customize_css() {
    $hex = esc_attr( get_theme_mod( 'queens_magazine_blog_theme_color', __('#b29700', 'queens-magazine-blog') ) );
	$percent  = -0.1;
	$final_color = queens_magazine_blog_color_luminance( $hex, $percent );
?>
	<style type="text/css">
    
    /* Theme color change */
    .menu li.has-children > a:after,
    .menu li li.has-children > a:after,
    .theme-text-color,
    .theme-hover:hover, 
    li:hover,
    .widget > ul > li > a:hover,
    .main-navigation ul li:hover,
    .nav-previous:hover,
    .nav-next:hover { 
        color: <?php echo  esc_attr( get_theme_mod( 'queens_magazine_blog_theme_color', __('#e4b31d', 'queens-magazine-blog') ) ); ?>;
    }
    
    /* Theme color change */
    .theme-background-color,
    .main-navigation ul li ul a:hover,
    .green {
        background: <?php echo  esc_attr( get_theme_mod( 'queens_magazine_blog_theme_color',__('#e4b31d', 'queens-magazine-blog') ) ); ?>;
    }
    
    /* Theme color change */
    .shape-1:before {
        border-color: transparent transparent transparent <?php echo  esc_attr( get_theme_mod( 'queens_magazine_blog_theme_color', __('#e4b31d', 'queens-magazine-blog'))); ?>;;  /* tail color */
    }

    /* highlight active menu */
    li.current-menu-item {   
        color: <?php echo esc_attr( $final_color ); ?>  ; 
    }
    
    /* Image size change on most commented */
    .image-changeon-most-commented {
    padding: <?php echo esc_attr( get_theme_mod( 'queens_magazine_blog_image_changeon_most_commented','0' ) ).'px';?> ;

    }
    /* Image size change on recent post */
    .image-changeon-recentpost {
        padding: <?php echo esc_attr( get_theme_mod( 'queens_magazine_blog_image_changeon_recentpost','0' ) ).'px';?> ;

    }
    /* Image size change on recent update */
    .image-changeon-recent-update {
    padding: <?php echo esc_attr( get_theme_mod( 'queens_magazine_blog_image_changeon_recent_update','0' ) ).'px';?> ;

    }

    /* main width */
    .container-fluid {
	width: <?php echo esc_attr( get_theme_mod( 'queens_magazine_blog_frontpage_width','92' )).'%';?> ;

    }
    
}
    </style>
<?php
}
add_action( 'wp_head', 'queens_magazine_blog_customize_css' );