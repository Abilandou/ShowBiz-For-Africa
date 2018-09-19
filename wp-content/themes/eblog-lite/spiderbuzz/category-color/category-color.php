<?php
/**
 * Color Category
*/
if ( !function_exists('eblog_lite_color_category') ){
    function eblog_lite_color_category() {
        if( get_theme_mod('eblog_lite_category_section_enable',false) == true ){
                global $post;
                $categories = get_the_category();
                $separator = '&nbsp;';
                $output = '';
                if($categories) {
                    $output .= '<div class="colorful-cat">';
                        foreach($categories as $category) {
                            $color_code = eblog_lite_category_color( get_cat_id( $category->cat_name ) );
                            if (!empty($color_code)) {
                                $output .= '<a href="'.get_category_link( $category->term_id ).'" style="background:' . eblog_lite_category_color( get_cat_id( $category->cat_name ) ) . '" rel="category tag">'.esc_attr( $category->cat_name ).'</a>'.$separator;
                            } else {
                                $output .= '<a href="'.get_category_link( $category->term_id ).'"  rel="category tag">'.$category->cat_name.'</a>'.$separator;
                            }
                        }
                    $output .='</div>';
                    echo trim( $output, $separator );
                }
        }#end Category Section
    }
}

if ( ! function_exists( 'eblog_lite_category_color' ) ){
    function eblog_lite_category_color( $wp_category_id ) {
        $args = array(
			'orderby' => 'id',
			'hide_empty' => 0
        );
        $category = get_categories( $args );
        foreach ( $category as $category_list ) {
			$color = get_theme_mod( 'eblog_lite_category_color_'.$wp_category_id );
			return $color;
        }
    }
}