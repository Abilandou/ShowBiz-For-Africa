<?php

/**
 * The file that defines Shortcodes class
 *
 * A class definition that includes functions used for Shortcodes.
 *
 * @since      1.0
 *
 */

/**
 * Shortcodes class.
 *
 * This is used to define functions for Shortcodes.
 *
 * @since      1.0
 */
class Fancy_Facebook_Comments_Shortcodes {

	/**
	 * Options saved in database.
	 *
	 * @since    1.0
	 */
	private $options;

	/**
	 * Member to assign object of Fancy_Facebook_Comments_Public Class.
	 *
	 * @since    1.0
	 */
	private $public_class_object;

	/**
	 * Assign plugin options to private member $options.
	 *
	 * @since    1.0
	 */
	public function __construct( $options, $public_class_object ) {

		$this->options = $options;
		$this->public_class_object = $public_class_object;

	}

	/** 
	 * Shortcode for Facebook Comments
	 *
	 * @since    1.0
	 */ 
	public function facebook_comments_shortcode( $params ) {

		extract( shortcode_atts( array(
			'style' => '',
			'title' => '',
			'url' => '',
			'heading_tag' => 'div',
			'num_comments' => '',
			'order_by' => 'social',
			'language' => 'en_US',
			'width' => '',
		), $params ) );

		$html = '<div style="'. $style .'" class="heateor_ffc_facebook_comments">';
		if( $title != '' ) {
			$html .= '<' . $heading_tag . ' class="heateor_ffc_facebook_comments_title">' . $title . '</' . $heading_tag . '>';
		}
		$html .= '<script type="text/javascript">!function(e,n,t){var o,c=e.getElementsByTagName(n)[0];e.getElementById(t)||(o=e.createElement(n),o.id=t,o.src="//connect.facebook.net/' . $language . '/sdk.js#xfbml=1&version=v2.9",c.parentNode.insertBefore(o,c))}(document,"script","facebook-jssdk");</script>';
		$html .= $this->public_class_object->facebook_comments_moderation_optin();
		$html .= $this->public_class_object->facebook_comments_notifier_optin();
		$target_url = html_entity_decode( esc_url( $this->public_class_object->get_http_protocol() . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"] ) );
		global $post;
		$target_url = apply_filters( 'heateor_ffc_facebook_comments_target_url', $target_url, $post );
		$html .= '<div class="fb-comments" data-href="' .( $url == '' ? $target_url : $url ). '"';
	    $html .= ' data-numposts="' . $num_comments . '"';
	    $html .= ' data-colorscheme="light"';
	    $html .= ' data-order-by="' . $order_by . '"';
	    $html .= ' data-width="' . ( $width == '' ? '100%' : $width ) . '"';
	    $html .= ' ></div></div>';
	    $html .= $this->public_class_object->facebook_comments_moderation_optin_script();
	    $html .= $this->public_class_object->facebook_comments_notifier_optin_script();
		
		return $html;
	
	}

}
