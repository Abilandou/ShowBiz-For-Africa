<?php

/**
 * The file that defines classes for widgets
 *
 * Class definitions that include functions used for widgets.
 *
 * @since    1.0
 *
 */

/**
 * Facebook Comments Widget class.
 *
 * This is used to define functions for Facebook Comments Widget.
 *
 * @since    1.0
 */
class Fancy_Facebook_Comments_Widget extends WP_Widget { 
	
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
	 * Assign plugin options to private member $options and define widget title, description etc.
	 *
	 * @since    1.0
	 */
	public function __construct() { 
		
		global $heateor_ffc;

		$this->options = $heateor_ffc->options;

		$this->public_class_object = new Fancy_Facebook_Comments_Public( $heateor_ffc->options, HEATEOR_FFC_VERSION );

		parent::__construct( 
			'Heateor_FFC_Facebook_Comments', // unique id 
			__( 'Fancy Facebook Comments Widget' ), // Widget title 
			array( 'description' => __( 'Fancy Facebook Comments widget. Enable Facebook Comments box in the widget area of your choice.', 'fancy-facebook-comments' ) )
		); 
	}  

	/**
	 * Render widget at front-end
	 *
	 * @since    1.0
	 */
	public function widget( $args, $instance ) { 
		
		extract( $args );
		
		$url = html_entity_decode( esc_url( $this->public_class_object->get_http_protocol() . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"] ) );
		
		if ( isset( $instance['target_url'] ) ) {
			if ( $instance['target_url'] == 'homepage' ) {
				$url = home_url();
			} elseif ( $instance['target_url'] == 'custom' && trim( $instance['target_url_custom'] ) ) {
				$url = trim( $instance['target_url_custom'] );
			}
		}
		
		echo $before_widget;

		if ( ! empty( $instance['before_widget_content'] ) ) { 
			echo '<div>' . $instance['before_widget_content'] . '</div>'; 
		}

		echo "<div class='heateor_ffc_facebook_comments'>";
		
		if ( ! empty( $instance['title'] ) ) {
			echo $before_title;
			echo '<' . $instance['heading_tag'] . ' class="heateor_ffc_facebook_comments_title">'; 
			echo $instance['title'];
			echo '</' . $instance['heading_tag'] . '>';
			echo $after_title;
		}

		$html = '<script type="text/javascript">!function(e,n,t){var o,c=e.getElementsByTagName(n)[0];e.getElementById(t)||(o=e.createElement(n),o.id=t,o.src="//connect.facebook.net/' . $instance['language'] . '/sdk.js#xfbml=1&version=v2.9",c.parentNode.insertBefore(o,c))}(document,"script","facebook-jssdk");</script>';
		$html .= $this->public_class_object->facebook_comments_moderation_optin();
		$html .= $this->public_class_object->facebook_comments_notifier_optin();
		$html .= '<div class="fb-comments" data-href="' . $url . '"';
	    $html .= ' data-numposts="' . $instance['num_comments'] . '"';
	    $html .= ' data-colorscheme="light"';
	    $html .= ' data-order-by="' . $instance['order_by'] . '"';
	    $html .= ' data-width="100%"';
	    $html .= ' ></div>';
	    $html .= $this->public_class_object->facebook_comments_moderation_optin_script();
	    $html .= $this->public_class_object->facebook_comments_notifier_optin_script();
	    echo $html;

		if ( ! empty( $instance['after_widget_content'] ) ) { 
			echo '<div>' . $instance['after_widget_content'] . '</div>'; 
		}
		
		echo '</div>';
		
		echo $after_widget;
	} 

	/** 
	 * Everything which should happen when user edit widget at admin panel
	 *
	 * @since    1.0
	 */
	public function update( $new_instance, $old_instance ) { 
		
		$instance = $old_instance; 
		$instance['title'] = strip_tags( $new_instance['title'] ); 
		$instance['heading_tag'] = $new_instance['heading_tag'];
		$instance['target_url'] = $new_instance['target_url'];
		$instance['target_url_custom'] = $new_instance['target_url_custom'];
		$instance['num_comments'] = $new_instance['num_comments'];
		$instance['order_by'] = $new_instance['order_by'];
		$instance['language'] = $new_instance['language']; 
		$instance['before_widget_content'] = $new_instance['before_widget_content']; 
		$instance['after_widget_content'] = $new_instance['after_widget_content'];  

		return $instance; 

	}  

	/** 
	 * Widget options form at admin panel.
	 *
	 * @since    1.0
	 */
	public function form( $instance ) { 
		
		// default widget settings
		$defaults = array( 'title' => 'Facebook Comments', 'heading_tag' => 'h3', 'total_shares' => 0, 'target_url' => 'default', 'target_url_custom' => '', 'num_comments' => '', 'order_by' => 'social', 'language' => get_locale(), 'before_widget_content' => '', 'after_widget_content' => '' );

		foreach ( $instance as $key => $value ) {
			if ( is_string( $value ) ) {
				$instance[ $key ] = esc_attr( trim( $value ) );
			}
		}
		
		$instance = wp_parse_args( ( array ) $instance, $defaults );
		?> 
		<script type="text/javascript">
			function heateorFfcToggleTargetUrl(val) {
				if (val == 'custom' ) {
					jQuery( '.heateorFfcTargetUrl' ).css( 'display', 'block' );
				} else {
					jQuery( '.heateorFfcTargetUrl' ).css( 'display', 'none' );
				}
			}
		</script>
		<p>  
			<label for="<?php echo $this->get_field_id( 'before_widget_content' ); ?>"><?php _e( 'Before widget content:', 'fancy-facebook-comments' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'before_widget_content' ); ?>" name="<?php echo $this->get_field_name( 'before_widget_content' ); ?>" type="text" value="<?php echo $instance['before_widget_content']; ?>" /> 
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title', 'fancy-facebook-comments' ); ?></label> 
			<input style="width: 95%" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $instance['title']; ?>" /> <br/>
			<label for="<?php echo $this->get_field_id( 'heading_tag' ); ?>"><?php _e( 'HTML Tag for Title', 'fancy-facebook-comments' ); ?></label> 
			<select style="width: 95%" class="widefat" id="<?php echo $this->get_field_id( 'heading_tag' ); ?>" name="<?php echo $this->get_field_name( 'heading_tag' ); ?>">
				<option value="h1" <?php echo isset($instance['heading_tag']) && $instance['heading_tag'] == 'h1' ? 'selected' : '' ; ?>>H1</option>
				<option value="h2" <?php echo isset($instance['heading_tag']) && $instance['heading_tag'] == 'h2' ? 'selected' : '' ; ?>>H2</option>
				<option value="h3" <?php echo !isset($instance['heading_tag']) || $instance['heading_tag'] == 'h3' ? 'selected' : '' ; ?>>H3</option>
				<option value="h4" <?php echo isset($instance['heading_tag']) && $instance['heading_tag'] == 'h4' ? 'selected' : '' ; ?>>H4</option>
				<option value="h5" <?php echo isset($instance['heading_tag']) && $instance['heading_tag'] == 'h5' ? 'selected' : '' ; ?>>H5</option>
				<option value="h6" <?php echo isset($instance['heading_tag']) && $instance['heading_tag'] == 'h6' ? 'selected' : '' ; ?>>H6</option>
				<option value="div" <?php echo isset($instance['heading_tag']) && $instance['heading_tag'] == 'div' ? 'selected' : '' ; ?>>Div</option>
				<option value="span" <?php echo isset($instance['heading_tag']) && $instance['heading_tag'] == 'span' ? 'selected' : '' ; ?>>Span</option>
			</select><br/>
			<label for="<?php echo $this->get_field_id( 'target_url' ); ?>"><?php _e( 'Load comments for', 'fancy-facebook-comments' ); ?></label> 
			<select style="width: 95%" onchange="heateorFfcToggleTargetUrl(this.value)" class="widefat" id="<?php echo $this->get_field_id( 'target_url' ); ?>" name="<?php echo $this->get_field_name( 'target_url' ); ?>">
				<option value="default" <?php echo isset( $instance['target_url'] ) && $instance['target_url'] == 'default' ? 'selected' : '' ; ?>><?php _e( 'Url of the webpage where Facebook Comments box is placed (default)', 'fancy-facebook-comments' ) ?></option>
				<option value="homepage" <?php echo isset( $instance['target_url'] ) && $instance['target_url'] == 'homepage' ? 'selected' : '' ; ?>><?php _e( 'Url of the homepage of your website', 'fancy-facebook-comments' ) ?></option>
				<option value="custom" <?php echo isset( $instance['target_url'] ) && $instance['target_url'] == 'custom' ? 'selected' : '' ; ?>><?php _e( 'Custom url', 'fancy-facebook-comments' ) ?></option>
			</select>
			<input placeholder="Custom url" style="margin-top: 5px; <?php echo ! isset( $instance['target_url'] ) || $instance['target_url'] != 'custom' ? 'display: none' : '' ; ?>" class="widefat heateorFfcTargetUrl" id="<?php echo $this->get_field_id( 'target_url_custom' ); ?>" name="<?php echo $this->get_field_name( 'target_url_custom' ); ?>" type="text" value="<?php echo isset( $instance['target_url_custom'] ) ? $instance['target_url_custom'] : ''; ?>" /><br/>
			<label for="<?php echo $this->get_field_id( 'num_comments' ); ?>"><?php _e( 'Number of comments', 'fancy-facebook-comments' ); ?></label> 
			<input style="width: 95%" class="widefat" id="<?php echo $this->get_field_id( 'num_comments' ); ?>" name="<?php echo $this->get_field_name( 'num_comments' ); ?>" type="text" value="<?php echo $instance['num_comments']; ?>" /> <br/>
			<label for="<?php echo $this->get_field_id( 'order_by' ); ?>"><?php _e( 'Order By', 'fancy-facebook-comments' ); ?></label> 
			<select style="width: 95%" class="widefat" id="<?php echo $this->get_field_id( 'order_by' ); ?>" name="<?php echo $this->get_field_name( 'order_by' ); ?>">
				<option value="social" <?php echo isset( $instance['order_by'] ) && $instance['order_by'] == 'social' ? 'selected' : '' ; ?>><?php _e( 'Social', 'fancy-facebook-comments' ) ?></option>
				<option value="reverse_time" <?php echo isset( $instance['order_by'] ) && $instance['order_by'] == 'reverse_time' ? 'selected' : '' ; ?>><?php _e( 'Reverse Time', 'fancy-facebook-comments' ) ?></option>
				<option value="time" <?php echo isset( $instance['order_by'] ) && $instance['order_by'] == 'time' ? 'selected' : '' ; ?>><?php _e( 'Time', 'fancy-facebook-comments' ) ?></option>
			</select><br/>
			<label for="<?php echo $this->get_field_id( 'language' ); ?>"><?php _e( 'Language', 'fancy-facebook-comments' ); ?></label> 
			<input style="width: 95%" class="widefat" id="<?php echo $this->get_field_id( 'language' ); ?>" name="<?php echo $this->get_field_name( 'language' ); ?>" type="text" value="<?php echo $instance['language']; ?>" /> <br/>
			<label for="<?php echo $this->get_field_id( 'after_widget_content' ); ?>"><?php _e( 'After widget content', 'fancy-facebook-comments' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'after_widget_content' ); ?>" name="<?php echo $this->get_field_name( 'after_widget_content' ); ?>" type="text" value="<?php echo $instance['after_widget_content']; ?>" /> 
		</p> 
	<?php 
    }

} 