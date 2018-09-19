<?php

/**
 * Contains functions responsible for functionality at front-end of website
 *
 * @since      1.0
 *
 */

/**
 * This class defines all code necessary for functionality at front-end of website
 *
 * @since      1.0
 *
 */
class Fancy_Facebook_Comments_Public {

	/**
	 * Options saved in database.
	 *
	 * @since    1.0
	 */
	private $options;

	/**
	 * Current version of the plugin.
	 *
	 * @since    1.0
	 */
	private $version;

	/**
	 * Get saved options.
	 *
	 * @since    1.0
     * @param    array     $options    Plugin options saved in database
     * @param    string    $version    Current version of the plugin
	 */
	public function __construct( $options, $version ) {

		$this->options = $options;
		$this->version = $version;

	}

	/**
	 * Get http/https protocol at the website
	 *
	 * @since    1.0
	 */
	public function get_http_protocol() {
		
		if ( isset( $_SERVER['HTTPS'] ) && ! empty( $_SERVER['HTTPS'] ) && $_SERVER['HTTPS'] != 'off' ) {
			return "https://";
		} else {
			return "http://";
		}
	
	}
	
	/**
	 * Render Facebook Comments at posts/pages
	 *
	 * @since    1.1.1
	 */
	public function render_facebook_comments_at_posts() {

		add_filter( 'the_content', array( $this, 'render_facebook_comments' ), intval( $this->options['priority'] ) );
		add_filter( 'the_excerpt', array( $this, 'render_facebook_comments' ), intval( $this->options['priority'] ) );

	}

	/**
	 * Enable Facebook Comments at selected pages
	 *
	 * @since    1.0
	 */
	public function render_facebook_comments( $content ) {

		global $post;
		
		if ( ! $post ) {
			return $content;
		}

		$post_meta = get_post_meta( $post->ID, '_heateor_ffc_meta', true );

		if ( isset( $post_meta['facebook_comments'] ) && $post_meta['facebook_comments'] == 1 && ( ! is_front_page() || ( is_front_page() && 'page' == get_option( 'show_on_front' ) ) ) ) {
			return $content;
		}

		$bp_activity = false;

		if ( current_filter() == 'bp_activity_entry_meta' ) {
			if ( isset( $this->options['bp_activity'] ) ) {
				$bp_activity = true;
			}
		}
		
		$post_types = get_post_types( array( 'public' => true ), 'names', 'and' );
		$post_types = array_diff( $post_types, array( 'post', 'page' ) );

		// default post url
		$post_url = get_permalink( $post->ID );
		if ( $bp_activity ) {
			$post_url = bp_get_activity_thread_permalink();
		} else {
			if ( $this->options['url_to_comment'] == 'default' ) {
				$post_url = get_permalink( $post->ID );
				if ( $post_url == '' ) {
					$post_url = html_entity_decode( esc_url( $this->get_http_protocol() . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"] ) );
				}
			} elseif ( $this->options['url_to_comment'] == 'home' ) {
				$post_url = home_url();
			} elseif ( $this->options['url_to_comment'] == 'custom' ) {
				$post_url = $this->options['url_to_comment_custom'] ? $this->options['url_to_comment_custom'] : get_permalink( $post->ID );
			}
		}
		
		$facebook_comments_style = '<style type="text/css">.fb-comments,.fb-comments span,.fb-comments span iframe[style]{min-width:100%!important;width:100%!important}</style><div id="fb-root"></div>';
		$post_url = apply_filters( 'heateor_ffc_facebook_comments_target_url', $post_url, $post );
		$facebook_comments_html = $this->facebook_comments_html( $post_url );
		$container_style = 'width:100%;text-align:' . $this->options['title_alignment'] . ';';
		if ( $this->options['bg_color'] ) {
			$container_style .= 'background-color:' . $this->options['bg_color'] . ';';
		}
		$title_style = 'padding:10px;';
		if ( $this->options['title_font_size'] ) {
			$title_style .= 'font-size:' . $this->options['title_font_size'] . 'px;';
		}
		if ( $this->options['title_font_family'] ) {
			$title_style .= 'font-family:' . $this->options['title_font_family'] . ';';
		}
		if ( $this->options['title_color'] ) {
			$title_style .= 'color:' . $this->options['title_color'] . ';';
		}

		$horizontal_div = "<div class='heateorFfcClear'></div><div style='". $container_style ."' class='heateor_ffc_facebook_comments'><" . $this->options['heading_tag'] . " class='heateor_ffc_facebook_comments_title' style='" . $title_style . "' >" . ucfirst( $this->options['commenting_label'] ) . "</" . $this->options['heading_tag'] . ">" . $facebook_comments_html . "</div><div class='heateorFfcClear'></div>";
		if ( $bp_activity ) {
			echo $horizontal_div;
		}
		// show Facebook Comments box
		if ( ( isset( $this->options['home'] ) && is_front_page() ) || ( isset( $this->options['category'] ) && is_category() ) || ( isset( $this->options['archive'] ) && is_archive() ) || ( isset( $this->options['post'] ) && is_single() && isset( $post -> post_type ) && $post -> post_type == 'post' ) || ( isset( $this->options['page'] ) && is_page() && isset( $post -> post_type ) && $post -> post_type == 'page' ) || ( isset( $this->options['excerpt'] ) && (is_home() || current_filter() == 'the_excerpt' ) ) || ( isset( $this->options['bb_reply'] ) && current_filter() == 'bbp_get_reply_content' ) || ( isset( $this->options['bb_forum'] ) && ( isset( $this->options['top'] ) && current_filter() == 'bbp_template_before_single_forum' || isset( $this->options['bottom'] ) && current_filter() == 'bbp_template_after_single_forum' ) ) || ( isset( $this->options['bb_topic'] ) && ( isset( $this->options['top'] ) && in_array( current_filter(), array( 'bbp_template_before_single_topic', 'bbp_template_before_lead_topic' ) ) || isset( $this->options['bottom'] ) && in_array( current_filter(), array( 'bbp_template_after_single_topic', 'bbp_template_after_lead_topic' ) ) ) ) || ( isset( $this->options['woocom_shop'] ) && current_filter() == 'woocommerce_after_shop_loop_item' ) || ( isset( $this->options['woocom_product'] ) && current_filter() == 'woocommerce_share' ) || ( isset( $this->options['woocom_thankyou'] ) && current_filter() == 'woocommerce_thankyou' ) || (current_filter() == 'bp_before_group_header' && isset( $this->options['bp_group'] ) ) ) {
			if ( in_array( current_filter(), array( 'bbp_template_before_single_topic', 'bbp_template_before_lead_topic', 'bbp_template_before_single_forum', 'bbp_template_after_single_topic', 'bbp_template_after_lead_topic', 'bbp_template_after_single_forum', 'woocommerce_after_shop_loop_item', 'woocommerce_share', 'woocommerce_thankyou', 'bp_before_group_header' ) ) ) {
				echo '<div class="heateorFfcClear"></div>' . $horizontal_div . '<div class="heateorFfcClear"></div>';
			} else {
				if ( isset( $this->options['top'] ) && isset( $this->options['bottom'] ) ) {
					$content = $horizontal_div . '<br/>' . $content . '<br/>' . $horizontal_div;
				} else {
					if ( isset( $this->options['top'] ) ) {
						$content = $horizontal_div.$content;
					} elseif ( isset( $this->options['bottom'] ) ) {
						$content = $content.$horizontal_div;
					}
				}
				$content = $facebook_comments_style . $content;
			}
		} elseif ( count( $post_types ) ) {
			foreach ( $post_types as $post_type ) {
				if ( isset( $this->options[$post_type] ) && ( is_single() || is_page() ) && isset( $post -> post_type ) && $post -> post_type == $post_type ) {
					if ( isset( $this->options['top'] ) && isset( $this->options['bottom'] ) ) {
						$content = $horizontal_div . '<br/>' . $content.'<br/>'.$horizontal_div;
					} else {
						if ( isset( $this->options['top'] ) ) {
							$content = $horizontal_div.$content;
						} elseif ( isset( $this->options['bottom'] ) ) {
							$content = $content.$horizontal_div;
						}
					}
					$content = $facebook_comments_style . $content;
				}
			}
		}
		return $content;
	}

	/**
	 * Show opt-in for Facebook Comments Moderation add-on
	 *
	 * @since    1.1.5
	 */
	public function facebook_comments_moderation_optin() {

		global $heateor_fcm_options;
		if ( defined( 'HEATEOR_FB_COM_MOD_VERSION' ) && version_compare( '1.2.4', HEATEOR_FB_COM_MOD_VERSION ) < 0 && isset( $heateor_fcm_options['gdpr_enable'] ) ) {
			return '<div class="heateor_ss_fb_comments_optin_container"><label><input type="checkbox" class="heateor_ss_fb_comments_optin" value="1" />' . str_replace( $heateor_fcm_options['ppu_placeholder'], '<a href="'. $heateor_fcm_options['privacy_policy_url'] .'" target="_blank">' . $heateor_fcm_options['ppu_placeholder'] . '</a>', wp_strip_all_tags( $heateor_fcm_options['privacy_policy_optin_text'] ) ) . '</label></div>';
		}
		return '';

	}

	/**
	 * Show opt-in for Facebook Comments Notifier add-on
	 *
	 * @since    1.1.5
	 */
	public function facebook_comments_notifier_optin() {

		global $heateor_fcn_options;
		if ( defined( 'HEATEOR_FB_COM_NOT_VERSION' ) && version_compare( '1.1.6', HEATEOR_FB_COM_NOT_VERSION ) < 0 && isset( $heateor_fcn_options['gdpr_enable'] ) ) {
			return '<div class="heateor_ss_fb_comments_notifier_optin_container"><label><input type="checkbox" class="heateor_ss_fb_comments_notifier_optin" value="1" />' . str_replace( $heateor_fcn_options['ppu_placeholder'], '<a href="' . $heateor_fcn_options['privacy_policy_url'] . '" target="_blank">' . $heateor_fcn_options['ppu_placeholder'] . '</a>', wp_strip_all_tags( $heateor_fcn_options['privacy_policy_optin_text'] ) ) . '</label></div>';
		}
		return '';

	}

	/**
	 * Script for GDPR optin of Facebook Comments Moderation add-on
	 *
	 * @since    1.1.5
	 */
	public function facebook_comments_moderation_optin_script() {

		if ( defined( 'HEATEOR_FB_COM_MOD_VERSION' ) && version_compare( '1.2.3', HEATEOR_FB_COM_MOD_VERSION ) < 0 ) {
			return '<script type="text/javascript">jQuery(window).load(function(){null!=heateorFcmGetCookie("heateorFcmOptin")&&jQuery("input.heateor_ss_fb_comments_optin").prop("checked",!0),jQuery("input.heateor_ss_fb_comments_optin").click(function(){if(jQuery(this).is(":checked")){if(heateorFcmOptin=1,null==heateorFcmGetCookie("heateorFcmOptin")){var e=new Date;e.setTime(e.getTime()+31536e6),document.cookie="heateorFcmOptin=1; expires="+e.toUTCString()+"; path=/"}}else heateorFcmOptin=0,document.cookie="heateorFcmOptin=; expires=Fri, 02 Jan 1970 00:00:00 UTC; path=/"});});</script>';
		}
		return '';

	}

	/**
	 * Script for GDPR optin of Facebook Comments Notifier add-on
	 *
	 * @since    1.1.5
	 */
	public function facebook_comments_notifier_optin_script() {

		if ( defined( 'HEATEOR_FB_COM_NOT_VERSION' ) && version_compare( '1.1.5', HEATEOR_FB_COM_NOT_VERSION ) < 0 ) {
		    return '<script type="text/javascript">jQuery(window).load(function(){null!=heateorFcnGetCookie("heateorFcnOptin")&&jQuery("input.heateor_ss_fb_comments_notifier_optin").prop("checked",!0),jQuery("input.heateor_ss_fb_comments_notifier_optin").click(function(){if(jQuery(this).is(":checked")){if(heateorFcnOptin=1,null==heateorFcnGetCookie("heateorFcnOptin")){var e=new Date;e.setTime(e.getTime()+31536e6),document.cookie="heateorFcnOptin=1; expires="+e.toUTCString()+"; path=/"}}else heateorFcnOptin=0,document.cookie="heateorFcnOptin=; expires=Fri, 02 Jan 1970 00:00:00 UTC; path=/"});});</script>';
		}
		return '';

	}

	/**
	 * Return Facebook Comments HTML
	 *
	 * @since    1.0
	 */
	public function facebook_comments_html( $post_url ) {

		$commenting_html = '<script type="text/javascript">!function(e,n,t){var o,c=e.getElementsByTagName(n)[0];e.getElementById(t)||(o=e.createElement(n),o.id=t,o.src="//connect.facebook.net/' . ( $this->options['comment_lang'] != '' ? $this->options["comment_lang"] : 'en_US' ) . '/sdk.js#xfbml=1&version=v2.9",c.parentNode.insertBefore(o,c))}(document,"script","facebook-jssdk");</script>';
		$commenting_html .= $this->facebook_comments_moderation_optin();
		$commenting_html .= $this->facebook_comments_notifier_optin();
		$commenting_html .= '<div class="fb-comments" data-href="' . $post_url . '" data-colorscheme="light" data-numposts="' . ( $this->options['comment_numposts'] != '' ? $this->options["comment_numposts"] : '' ) . '" data-width="' . ( $this->options['comment_width'] != '' ? $this->options["comment_width"] : '100%' ) . '" data-order-by="' . ( $this->options['comment_orderby'] != '' ? $this->options["comment_orderby"] : '' ) . '" ></div>';
		$commenting_html .= $this->facebook_comments_moderation_optin_script();
		$commenting_html .= $this->facebook_comments_notifier_optin_script();
		return $commenting_html;

	}

}