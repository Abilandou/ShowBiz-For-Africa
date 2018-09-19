<?php


/**
 * eBlog Lite  Social Links
 */
 if ( ! function_exists( 'eblog_lite_social_links' ) ) {
	function eblog_lite_social_links( ) {	
        $facebook_url = get_theme_mod('facebook_url', 'www.facebook.com/');
        $googleplus_url = get_theme_mod('google_plus', 'www.plus.google.com');
        $twitter_url = get_theme_mod('twitter_url', 'www.twitter.comm');
        $rss_url = get_theme_mod('rss_url');
        $linkedin_url = get_theme_mod('linkedin_url', 'www.linkedin.com');
        $instagram = get_theme_mod('instagram_url','www.instagram.com');

        $social_links_enable = get_theme_mod('eblog_lite_social_links_enable', true);
        if($social_links_enable == true){
            ?>
            <ul class="inline-mode">
                <?php if(!empty( $facebook_url) ) { ?><li class="social-network fb"><a title="<?php esc_attr('Connect us on Facebook','eblog-lite') ?>" target="_blank" href="<?php echo esc_url($facebook_url);  ?>"><i class="fa fa-facebook"></i></a></li><?php } ?>
                <?php if(!empty( $googleplus_url) ) { ?><li class="social-network googleplus"><a title="<?php esc_attr('Connect us on Google+','eblog-lite'); ?>" target="_blank" href="<?php echo esc_url($googleplus_url); ?>"><i class="fa fa-google-plus"></i></a></li><?php } ?>
                <?php if(!empty( $twitter_url) ) { ?><li class="social-network tw"><a title="<?php esc_attr('Connect us on Twitter','eblog-lite'); ?>" target="_blank" href="<?php echo esc_url($twitter_url);  ?>"><i class="fa fa-twitter"></i></a></li><?php } ?>
                <?php if(!empty( $rss_url) ) { ?><li class="social-network rss"><a title="<?php esc_attr('Connect us on Instagram','eblog-lite'); ?>" target="_blank" href="<?php echo esc_url($rss_url);  ?>"><i class="fa fa-rss"></i></a></li><?php } ?>
                <?php if(!empty( $linkedin_url) ) { ?><li class="social-network linkedin"><a title="<?php esc_attr('Connect us on Linkedin','eblog-lite'); ?>" target="_blank" href="<?php echo esc_url($linkedin_url); ?>"><i class="fa fa-linkedin"></i></a></li><?php } ?>
                <?php if(!empty( $instagram) ) { ?><li class="social-network instagram"><a title="<?php esc_attr('Connect us on Instagram','eblog-lite'); ?>" target="_blank" href="<?php echo esc_url($instagram);  ?>"><i class="fa fa-instagram"></i></a></li><?php } ?>
            </ul>    
    	<?php }
	}
}
add_action( 'eblog_lite_footer_social_links', 'eblog_lite_social_links');



/****************************************************************************
 *              Post viewer Count In Wordpress Theme
 ****************************************************************************/
function getPostViews($postID){
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0 ";
    }
    return '<span class="meta-viewer"><i class="fa fa-eye" aria-hidden="true"></i>'.$count.'</span>';
}

// function to count views.
function setPostViews($postID) {
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}

/**
 * Required the plugins
 */
function eblog_lite_register_required_plugins() {
    /*
    * The list of Plugin Requird List
    */
    $plugins = array(
         array(
			'name' => esc_attr__( 'One Click Demo Import', 'eblog-lite'),
			'slug' => 'one-click-demo-import',
			'required' => false,
		),
    );

    /*
        * Array of configuration settings. Amend each line as needed. 
    */
    $config = array(
        'id'           => 'eblog-lite',                 
        'default_path' => '',                      
        'menu'         => 'tgmpa-install-plugins', 
        'has_notices'  => true,                    
        'dismissable'  => true,                    
        'dismiss_msg'  => '',                       
        'is_automatic' => false,                   
        'message'      => '',                      
        
    );

    tgmpa( $plugins, $config );
}
add_action( 'tgmpa_register','eblog_lite_register_required_plugins' );//Register