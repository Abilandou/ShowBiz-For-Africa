<?php
/**
 * This contains customizer function for value
 *
 * @package Postmagthemes
 * @subpackage queens_magazine_blog
 */

/* Pagination Function*/
function queens_magazine_blog_pagination($pages = '', $range = 1)
{  
     $showitems = ($range * 2) + 1;  
     $paged = get_query_var( 'paged');
    
     if(empty($paged)) $paged = 1;
     if($pages == '')
     {
         global $wp_query; 
		 $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }   
 
     if(1 != $pages)
    {
       	echo '<ul class="pagination">';
         if($paged > 1 ) echo "<li class='prev'><a href='".esc_url(get_pagenum_link($paged - 1))."'><i class='fa fa-angle-double-left'></i></a></li>";
         for ($i=1; $i <= $pages; $i++)
         {
            if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                echo ($paged == $i)? "<li class=\"active\"><a href='".esc_url(get_pagenum_link($i))."'>".esc_html($i)."</a></li>":"<li><a href='".esc_url(get_pagenum_link($i))."'>".esc_html($i)."</a></li>";
             }
         }
 
         if ($paged < $pages ) echo "<li class='next'><a href=\"".esc_url(get_pagenum_link($paged + 1))."\"><i class='fa fa-angle-double-right'></i></a></li>";  
         echo "</ul>";
    }
}

/// to get thumbnail for video///
function queens_magazine_blog_get_embedded_media( $type = array( 'video', 'iframe' ) ) {
	$content = apply_filters( 'the_content', get_the_content() );
	$embed = get_media_embedded_in_content( $content, $type );
	if (! $embed == null) {
		esc_attr( $output = str_replace( '?visual =true', '?visual=false', $embed[0] ) );
	} else {   /* this will ouput if no image but mistakenly video = width found in content or video can not be fetched   */
        ?> 
        <div class  = "videonotfetch"  >
        </div>
        <?php
		$output = null;
	}
	return $output ;
}
/**
 * Change the excerpt more string
 */

function queens_magazine_blog_custom_excerpt_length( $length ) {
	if ( is_admin() ) {
		return $length;
	}
	return 32;
}
add_filter( 'excerpt_length', 'queens_magazine_blog_custom_excerpt_length', 999 );

// add arrows to menu parent 
function queens_magazine_blog_add_menu_parent_class( $items ) {
 
    $parents = array();
    foreach ( $items as $item ) {
    if ( $item->menu_item_parent && $item->menu_item_parent > 0 ) {
    $parents[] = $item->menu_item_parent;
    }
    }
    
    foreach ( $items as $item ) {
    if ( in_array( $item->ID, $parents ) ) {
    $item->classes[] = 'has-children';
    }
    }
    
    return $items;
   }
add_filter( 'wp_nav_menu_objects', 'queens_magazine_blog_add_menu_parent_class' );