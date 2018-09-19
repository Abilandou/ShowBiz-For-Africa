<?php

/**
 * Options page
 *
 * @since    1.0
 */
defined( 'ABSPATH' ) or die("Cheating........Uh!!");
?>

<div id="fb-root"></div>

<div class="metabox-holder columns-2" id="post-body">
		<h1>Fancy Facebook Comments</h1>
		<div class="menu_div" id="tabs">
			<form id="heateor_ffc_form" action="options.php" method="post">
			<?php settings_fields( 'heateor_ffc_options' ); ?>
			
			<h2 class="nav-tab-wrapper" style="height:34px">
				<ul>
					<li><a style="margin:0; height: 23px" class="nav-tab" href="#tabs-1"><?php _e( 'Settings', 'fancy-facebook-comments' ) ?></a></li>
					<li style="margin-left:9px"><a style="margin:0; height:23px" class="nav-tab" href="#tabs-2"><?php _e( 'Shortcode and Widget', 'fancy-facebook-comments' ) ?></a></li>
					<li style="margin-left:9px"><a style="margin:0; height:23px" class="nav-tab" href="#tabs-3"><?php _e( 'FAQ', 'fancy-facebook-comments' ) ?></a></li>
				</ul>
			</h2>

			<div class="menu_containt_div" id="tabs-1">
				<div class="clear"></div>
				<div class="heateor_ffc_left_column">
				<div class="stuffbox">
					<h3><label><?php _e( 'Settings', 'fancy-facebook-comments' );?></label></h3>
					<div class="inside">
					<table width="100%" border="0" cellspacing="0" cellpadding="0" class="form-table editcomment menu_content_table">
						<tr>
							<td colspan="2">
							<div>
							<a href="https://www.heateor.com/add-ons" target="_blank" style="text-decoration:none"><input type="button" value="<?php _e( 'Enable Facebook Comments notification and moderation', 'fancy-facebook-comments' ) ?>" class="ss_demo" /></a>
							</div>
							</td>
						</tr>

						<tr>
							<th>
							<img id="heateor_ffc_commenting_title_help" class="heateor_ffc_help_bubble" src="<?php echo plugins_url('../../images/info.png', __FILE__) ?>" />
							<label for="heateor_ffc_commenting_title"><?php _e("Comment box title", 'fancy-facebook-comments' ); ?></label>
							</th>
							<td>
							<input id="heateor_ffc_commenting_title" name="heateor_ffc[commenting_label]" type="text" value="<?php echo $options['commenting_label']; ?>" />
							</td>
						</tr>

						<tr class="heateor_ffc_help_content" id="heateor_ffc_commenting_title_help_cont">
							<td colspan="2">
							<div>
								<?php _e( 'Title to show above Facebook Comments box', 'fancy-facebook-comments' ) ?>
							</div>
							</td>
						</tr>

						<tr>
							<th>
							<img id="heateor_ffc_title_color_help" class="heateor_ffc_help_bubble" src="<?php echo plugins_url('../../images/info.png', __FILE__) ?>" />
							<label for="heateor_ffc_title_color"><?php _e("Title text color", 'fancy-facebook-comments' ); ?></label>
							</th>
							<td>
							<input id="heateor_ffc_commenting_title" name="heateor_ffc[title_color]" type="text" value="<?php echo $options['title_color']; ?>" />
							</td>
						</tr>

						<tr class="heateor_ffc_help_content" id="heateor_ffc_title_color_help_cont">
							<td colspan="2">
							<div>
							<?php _e( 'Specify the color or hex code (example #cc78e0) of the title text to show above Facebook Comments box. Leave empty for default. You can get the hex code of the required color from <a href="http://www.colorpicker.com/" target="_blank">this link</a>', 'fancy-facebook-comments' ) ?>
							</div>
							</td>
						</tr>

						<tr>
							<th>
							<img id="heateor_ffc_hor_alignment_help" class="heateor_ffc_help_bubble" src="<?php echo plugins_url('../../images/info.png', __FILE__) ?>" />
							<label for="heateor_ffc_hor_alignment"><?php _e("Font family of the Title", 'fancy-facebook-comments' ); ?></label>
							</th>
							<td>
							<select id="heateor_ffc_hor_alignment" name="heateor_ffc[title_font_family]">
   								<option value="Arial,Helvetica Neue,Helvetica,sans-serif" <?php echo $options['title_font_family'] == 'Arial,Helvetica Neue,Helvetica,sans-serif' ? 'selected' : ''; ?>>Arial,Helvetica Neue,Helvetica,sans-serif</option>
						        <option value="Arial Black,Arial Bold,Arial,sans-serif" <?php echo $options['title_font_family'] == 'Arial Black,Arial Bold,Arial,sans-serif' ? 'selected' : ''; ?>>Arial Black,Arial Bold,Arial,sans-serif</option>
						        <option value="Arial Narrow,Arial,Helvetica Neue,Helvetica,sans-serif" <?php echo $options['title_font_family'] == 'Arial Narrow,Arial,Helvetica Neue,Helvetica,sans-serif' ? 'selected' : ''; ?>>Arial Narrow,Arial,Helvetica Neue,Helvetica,sans-serif</option>
						        <option value="Courier,Verdana,sans-serif" <?php echo $options['title_font_family'] == 'Courier,Verdana,sans-serif' ? 'selected' : ''; ?>>Courier,Verdana,sans-serif</option>
						        <option value="Georgia,Times New Roman,Times,serif" <?php echo $options['title_font_family'] == 'Georgia,Times New Roman,Times,serif' ? 'selected' : ''; ?>>Georgia,Times New Roman,Times,serif</option>
						        <option value="Times New Roman,Times,Georgia,serif" <?php echo $options['title_font_family'] == 'Times New Roman,Times,Georgia,serif' ? 'selected' : ''; ?>>Times New Roman,Times,Georgia,serif</option>
						        <option value="Trebuchet MS,Lucida Grande,Lucida Sans Unicode,Lucida Sans,Arial,sans-serif" <?php echo $options['title_font_family'] == 'Trebuchet MS,Lucida Grande,Lucida Sans Unicode,Lucida Sans,Arial,sans-serif' ? 'selected' : ''; ?>>Trebuchet MS,Lucida Grande,Lucida Sans Unicode,Lucida Sans,Arial,sans-serif</option>
						        <option value="Verdana,sans-serif" <?php echo $options['title_font_family'] == 'Verdana,sans-serif' ? 'selected' : ''; ?>>Verdana,sans-serif</option>
						        <option value="American Typewriter,Georgia,serif" <?php echo $options['title_font_family'] == 'American Typewriter,Georgia,serif' ? 'selected' : ''; ?>>American Typewriter,Georgia,serif</option>
						        <option value="Andale Mono,Consolas,Monaco,Courier,Courier New,Verdana,sans-serif" <?php echo $options['title_font_family'] == 'Andale Mono,Consolas,Monaco,Courier,Courier New,Verdana,sans-serif' ? 'selected' : ''; ?>>Andale Mono,Consolas,Monaco,Courier,Courier New,Verdana,sans-serif</option>
						        <option value="Baskerville,Times New Roman,Times,serif" <?php echo $options['title_font_family'] == 'Baskerville,Times New Roman,Times,serif' ? 'selected' : ''; ?>>Baskerville,Times New Roman,Times,serif</option>
						        <option value="Bookman Old Style,Georgia,Times New Roman,Times,serif" <?php echo $options['title_font_family'] == 'Bookman Old Style,Georgia,Times New Roman,Times,serif' ? 'selected' : ''; ?>>Bookman Old Style,Georgia,Times New Roman,Times,serif</option>
						        <option value="Calibri,Helvetica Neue,Helvetica,Arial,Verdana,sans-serif" <?php echo $options['title_font_family'] == 'Calibri,Helvetica Neue,Helvetica,Arial,Verdana,sans-serif' ? 'selected' : ''; ?>>Calibri,Helvetica Neue,Helvetica,Arial,Verdana,sans-serif</option>
						        <option value="Cambria,Georgia,Times New Roman,Times,serif" <?php echo $options['title_font_family'] == 'Cambria,Georgia,Times New Roman,Times,serif' ? 'selected' : ''; ?>>Cambria,Georgia,Times New Roman,Times,serif</option>
						        <option value="Candara,Verdana,sans-serif" <?php echo $options['title_font_family'] == 'Candara,Verdana,sans-serif' ? 'selected' : ''; ?>>Candara,Verdana,sans-serif</option>
						        <option value="Century Gothic,Apple Gothic,Verdana,sans-serif" <?php echo $options['title_font_family'] == 'Century Gothic,Apple Gothic,Verdana,sans-serif' ? 'selected' : ''; ?>>Century Gothic,Apple Gothic,Verdana,sans-serif</option>
						        <option value="Century Schoolbook,Georgia,Times New Roman,Times,serif" <?php echo $options['title_font_family'] == 'Century Schoolbook,Georgia,Times New Roman,Times,serif' ? 'selected' : ''; ?>>Century Schoolbook,Georgia,Times New Roman,Times,serif</option>
						        <option value="Consolas,Andale Mono,Monaco,Courier,Courier New,Verdana,sans-serif" <?php echo $options['title_font_family'] == 'Consolas,Andale Mono,Monaco,Courier,Courier New,Verdana,sans-serif' ? 'selected' : ''; ?>>Consolas,Andale Mono,Monaco,Courier,Courier New,Verdana,sans-serif</option>
						        <option value="Constantia,Georgia,Times New Roman,Times,serif" <?php echo $options['title_font_family'] == 'Constantia,Georgia,Times New Roman,Times,serif' ? 'selected' : ''; ?>>Constantia,Georgia,Times New Roman,Times,serif</option>
						        <option value="Corbel,Lucida Grande,Lucida Sans Unicode,Arial,sans-serif" <?php echo $options['title_font_family'] == 'Corbel,Lucida Grande,Lucida Sans Unicode,Arial,sans-serif' ? 'selected' : ''; ?>>Corbel,Lucida Grande,Lucida Sans Unicode,Arial,sans-serif</option>
						        <option value="Franklin Gothic Medium,Arial,sans-serif" <?php echo $options['title_font_family'] == 'Franklin Gothic Medium,Arial,sans-serif' ? 'selected' : ''; ?>>Franklin Gothic Medium,Arial,sans-serif</option>
						        <option value="Garamond,Hoefler Text,Times New Roman,Times,serif" <?php echo $options['title_font_family'] == 'Garamond,Hoefler Text,Times New Roman,Times,serif' ? 'selected' : ''; ?>>Garamond,Hoefler Text,Times New Roman,Times,serif</option>
						        <option value="Gill Sans MT,Gill Sans,Calibri,Trebuchet MS,sans-serif" <?php echo $options['title_font_family'] == 'Gill Sans MT,Gill Sans,Calibri,Trebuchet MS,sans-serif' ? 'selected' : ''; ?>>Gill Sans MT,Gill Sans,Calibri,Trebuchet MS,sans-serif</option>
						        <option value="Helvetica Neue,Helvetica,Arial,sans-serif" <?php echo $options['title_font_family'] == 'Helvetica Neue,Helvetica,Arial,sans-serif' ? 'selected' : ''; ?>>Helvetica Neue,Helvetica,Arial,sans-serif</option>
						        <option value="Hoefler Text,Garamond,Times New Roman,Times,sans-serif" <?php echo $options['title_font_family'] == 'Hoefler Text,Garamond,Times New Roman,Times,sans-serif' ? 'selected' : ''; ?>>Hoefler Text,Garamond,Times New Roman,Times,sans-serif</option>
						        <option value="Lucida Bright,Cambria,Georgia,Times New Roman,Times,serif" <?php echo $options['title_font_family'] == 'Lucida Bright,Cambria,Georgia,Times New Roman,Times,serif' ? 'selected' : ''; ?>>Lucida Bright,Cambria,Georgia,Times New Roman,Times,serif</option>
						        <option value="Lucida Grande,Lucida Sans,Lucida Sans Unicode,sans-serif" <?php echo $options['title_font_family'] == 'Lucida Grande,Lucida Sans,Lucida Sans Unicode,sans-serif' ? 'selected' : ''; ?>>Lucida Grande,Lucida Sans,Lucida Sans Unicode,sans-serif</option>
						        <option value="monospace" <?php echo $options['title_font_family'] == 'monospace' ? 'selected' : ''; ?>>Monospace</option>
						        <option value="Palatino Linotype,Palatino,Georgia,Times New Roman,Times,serif" <?php echo $options['title_font_family'] == 'Palatino Linotype,Palatino,Georgia,Times New Roman,Times,serif' ? 'selected' : ''; ?>>Palatino Linotype,Palatino,Georgia,Times New Roman,Times,serif</option>
						        <option value="Tahoma,Geneva,Verdana,sans-serif" <?php echo $options['title_font_family'] == 'Tahoma,Geneva,Verdana,sans-serif' ? 'selected' : ''; ?>>Tahoma,Geneva,Verdana,sans-serif</option>
						        <option value="Rockwell, Arial Black, Arial Bold, Arial, sans-serif" <?php echo $options['title_font_family'] == 'Rockwell, Arial Black, Arial Bold, Arial, sans-serif' ? 'selected' : ''; ?>>Rockwell, Arial Black, Arial Bold, Arial, sans-serif</option>
						    </select>
							</td>
						</tr>
						
						<tr class="heateor_ffc_help_content" id="heateor_ffc_hor_alignment_help_cont">
							<td colspan="2">
							<div>
							<?php _e( 'Font family of the title', 'fancy-facebook-comments' ) ?>
							</div>
							</td>
						</tr>

						<tr>
							<th>
							<img id="heateor_ffc_heading_tag_help" class="heateor_ffc_help_bubble" src="<?php echo plugins_url('../../images/info.png', __FILE__) ?>" />
							<label for="heateor_ffc_heading_tag"><?php _e("HTML tag for Title", 'fancy-facebook-comments' ); ?></label>
							</th>
							<td>
							<select id="heateor_ffc_heading_tag" name="heateor_ffc[heading_tag]">
								<option value="h1" <?php echo $options['heading_tag'] == 'h1' ? 'selected' : '' ; ?>>H1</option>
								<option value="h2" <?php echo $options['heading_tag'] == 'h2' ? 'selected' : '' ; ?>>H2</option>
								<option value="h3" <?php echo $options['heading_tag'] == 'h3' ? 'selected' : '' ; ?>>H3</option>
								<option value="h4" <?php echo $options['heading_tag'] == 'h4' ? 'selected' : '' ; ?>>H4</option>
								<option value="h5" <?php echo $options['heading_tag'] == 'h5' ? 'selected' : '' ; ?>>H5</option>
								<option value="h6" <?php echo $options['heading_tag'] == 'h6' ? 'selected' : '' ; ?>>H6</option>
								<option value="div" <?php echo $options['heading_tag'] == 'div' ? 'selected' : '' ; ?>>Div</option>
								<option value="span" <?php echo $options['heading_tag'] == 'span' ? 'selected' : '' ; ?>>Span</option>
							</select>
							</td>
						</tr>
						
						<tr class="heateor_ffc_help_content" id="heateor_ffc_heading_tag_help_cont">
							<td colspan="2">
							<div>
							<?php _e( 'HTML tag to use for title text', 'fancy-facebook-comments' ) ?>
							</div>
							</td>
						</tr>

						<tr>
							<th>
							<img id="heateor_ffc_title_font_size_help" class="heateor_ffc_help_bubble" src="<?php echo plugins_url('../../images/info.png', __FILE__) ?>" />
							<label for="heateor_ffc_title_font_size"><?php _e("Title-font size", 'fancy-facebook-comments' ); ?></label>
							</th>
							<td>
							<input id="heateor_ffc_title_font_size" name="heateor_ffc[title_font_size]" type="text" value="<?php echo $options['title_font_size']; ?>" />px
							</td>
						</tr>

						<tr class="heateor_ffc_help_content" id="heateor_ffc_title_font_size_help_cont">
							<td colspan="2">
							<div>
							<?php _e( 'Font-size of the title text', 'fancy-facebook-comments' ) ?>
							</div>
							</td>
						</tr>

						<tr>
							<th>
							<img id="heateor_ffc_title_alignment_help" class="heateor_ffc_help_bubble" src="<?php echo plugins_url('../../images/info.png', __FILE__) ?>" />
							<label for="heateor_ffc_title_alignment"><?php _e("Title alignment", 'fancy-facebook-comments' ); ?></label>
							</th>
							<td>
							<select id="heateor_ffc_title_alignment" name="heateor_ffc[title_alignment]">
								<option value="left" <?php echo $options['title_alignment'] == 'left' ? 'selected="selected"' : '' ?>><?php _e( 'Left', 'fancy-facebook-comments' ) ?></option>
								<option value="center" <?php echo $options['title_alignment'] == 'center' ? 'selected="selected"' : '' ?>><?php _e( 'Center', 'fancy-facebook-comments' ) ?></option>
								<option value="right" <?php echo $options['title_alignment'] == 'right' ? 'selected="selected"' : '' ?>><?php _e( 'Right', 'fancy-facebook-comments' ) ?></option>
							</select>
							</td>
						</tr>
						
						<tr class="heateor_ffc_help_content" id="heateor_ffc_title_alignment_help_cont">
							<td colspan="2">
							<div>
							<?php _e( 'Horizontal alignment of the title', 'fancy-facebook-comments' ) ?>
							</div>
							</td>
						</tr>

						<tr>
							<th>
							<img id="heateor_ffc_bg_color_help" class="heateor_ffc_help_bubble" src="<?php echo plugins_url('../../images/info.png', __FILE__) ?>" />
							<label for="heateor_ffc_bg_color"><?php _e("Background color", 'fancy-facebook-comments' ); ?></label>
							</th>
							<td>
							<input id="heateor_ffc_bg_color" name="heateor_ffc[bg_color]" type="text" value="<?php echo $options['bg_color']; ?>" />
							</td>
						</tr>

						<tr class="heateor_ffc_help_content" id="heateor_ffc_bg_color_help_cont">
							<td colspan="2">
							<div>
							<?php _e( 'Specify the color or hex code (example #cc78e0) of the background of Facebook Comments interface. Leave empty for transparent. You can get the hex code of the required color from <a href="http://www.colorpicker.com/" target="_blank">this link</a>', 'fancy-facebook-comments' ) ?>
							</div>
							</td>
						</tr>

						<tr>
							<th>
							<img id="heateor_ffc_priority_help" class="heateor_ffc_help_bubble" src="<?php echo plugins_url( '../../images/info.png', __FILE__ ) ?>" />
							<label for="heateor_ffc_priority"><?php _e( "Priority for Facebook Comments to appear at front-end", 'fancy-facebook-comments' ); ?></label>
							</th>
							<td>
							<input id="heateor_ffc_priority" name="heateor_ffc[priority]" type="text" value="<?php echo $options['priority'] ?>" />
							</td>
						</tr>

						<tr class="heateor_ffc_help_content" id="heateor_ffc_priority_help_cont">
							<td colspan="2">
							<div>
							<?php _e( "Higher number causes Facebook Comments to appear below the other elements at the webpage.", 'fancy-facebook-comments' ) ?>
							</div>
							</td>
						</tr>

						<?php
						$post_types = get_post_types( array( 'public' => true ), 'names', 'and' );
						?>
						<tr>
							<th>
							<img id="heateor_ffc_comments_location_help" class="heateor_ffc_help_bubble" src="<?php echo plugins_url('../../images/info.png', __FILE__) ?>" />
							<label><?php _e("Enable Social Commenting at", 'fancy-facebook-comments' ); ?></label>
							</th>
							<td>
							<input id="heateor_ffc_home" name="heateor_ffc[home]" type="checkbox" <?php echo isset( $options['home'] ) ? 'checked = "checked"' : '';?> value="1" />
							<label for="heateor_ffc_home"><?php _e( 'Homepage', 'fancy-facebook-comments' ) ?></label><br/>
							<?php
							if ( count( $post_types ) > 0 ) {
								foreach ( $post_types as $post_type ) {
									?>
									<input id="heateor_ffc_comments_<?php echo $post_type ?>" name="heateor_ffc[<?php echo $post_type ?>]" type="checkbox" <?php echo isset($options['' . $post_type]) ? 'checked = "checked"' : '';?> value="1" />
									<label for="heateor_ffc_comments_<?php echo $post_type ?>"><?php echo ucfirst( $post_type ) . '(s)'; ?></label><br/>
									<?php
								}
							}
							?>
							<input id="heateor_ffc_category" name="heateor_ffc[category]" type="checkbox" <?php echo isset( $options['category'] ) ? 'checked = "checked"' : '';?> value="1" />
							<label for="heateor_ffc_category"><?php _e( 'Category Archives', 'fancy-facebook-comments' ) ?></label><br/>
							<input id="heateor_ffc_archive" name="heateor_ffc[archive]" type="checkbox" <?php echo isset( $options['archive'] ) ? 'checked = "checked"' : '';?> value="1" />
							<label for="heateor_ffc_archive"><?php _e( 'Archive Pages (Category, Tag, Author or Date based pages)', 'fancy-facebook-comments' ) ?></label><br/>
							<?php
							if ( $this->is_bp_active) {
								?>
								<input id="heateor_ffc_bp_activity" name="heateor_ffc[bp_activity]" type="checkbox" <?php echo isset( $options['bp_activity'] ) ? 'checked = "checked"' : '';?> value="1" />
								<label for="heateor_ffc_bp_activity"><?php _e( 'BuddyPress activity', 'fancy-facebook-comments' ) ?></label><br/>
								<input id="heateor_ffc_bp_group" name="heateor_ffc[bp_group]" type="checkbox" <?php echo isset( $options['bp_group'] ) ? 'checked = "checked"' : '';?> value="1" />
								<label for="heateor_ffc_bp_group"><?php _e( 'BuddyPress group (only at top of content)', 'fancy-facebook-comments' ) ?></label><br/>
								<?php
							}
							if ( function_exists( 'is_bbpress' ) ) {
								?>
								<input id="heateor_ffc_bb_forum" name="heateor_ffc[bb_forum]" type="checkbox" <?php echo isset( $options['bb_forum'] ) ? 'checked = "checked"' : '';?> value="1" />
								<label for="heateor_ffc_bb_forum"><?php _e( 'BBPress forum', 'fancy-facebook-comments' ) ?></label>
								<br/>
								<input id="heateor_ffc_bb_topic" name="heateor_ffc[bb_topic]" type="checkbox" <?php echo isset( $options['bb_topic'] ) ? 'checked = "checked"' : '';?> value="1" />
								<label for="heateor_ffc_bb_topic"><?php _e( 'BBPress topic', 'fancy-facebook-comments' ) ?></label>
								<br/>
								<input id="heateor_ffc_bb_reply" name="heateor_ffc[bb_reply]" type="checkbox" <?php echo isset( $options['bb_reply'] ) ? 'checked = "checked"' : '';?> value="1" />
								<label for="heateor_ffc_bb_reply"><?php _e( 'BBPress reply', 'fancy-facebook-comments' ) ?></label>
								<br/>
								<?php
							}
							if ( $this->is_plugin_active( 'woocommerce/woocommerce.php' ) ) {
								?>
								<input id="heateor_ffc_woocom_shop" name="heateor_ffc[woocom_shop]" type="checkbox" <?php echo isset( $options['woocom_shop'] ) ? 'checked = "checked"' : '';?> value="1" />
								<label for="heateor_ffc_woocom_shop"><?php _e( 'After individual product at WooCommerce Shop page', 'fancy-facebook-comments' ) ?></label>
								<br/>
								<input id="heateor_ffc_woocom_product" name="heateor_ffc[woocom_product]" type="checkbox" <?php echo isset( $options['woocom_product'] ) ? 'checked = "checked"' : '';?> value="1" />
								<label for="heateor_ffc_woocom_product"><?php _e( 'WooCommerce Product Page', 'fancy-facebook-comments' ) ?></label>
								<br/>
								<input id="heateor_ffc_woocom_thankyou" name="heateor_ffc[woocom_thankyou]" type="checkbox" <?php echo isset( $options['woocom_thankyou'] ) ? 'checked = "checked"' : '';?> value="1" />
								<label for="heateor_ffc_woocom_thankyou"><?php _e( 'WooCommerce Thankyou Page', 'fancy-facebook-comments' ) ?></label>
								<br/>
								<?php
							}
							?>
							</td>
						</tr>

						<tr class="heateor_ffc_help_content" id="heateor_ffc_comments_location_help_cont">
							<td colspan="2">
							<div>
							<?php _e( 'Specify the page/post groups where you want to enable Social Commenting', 'fancy-facebook-comments' ) ?>
							</div>
							</td>
						</tr>

						<tr>
							<th>
							<img id="heateor_ffc_position_help" class="heateor_ffc_help_bubble" src="<?php echo plugins_url('../../images/info.png', __FILE__) ?>" />
							<label><?php _e( "Position of Comment Box", 'fancy-facebook-comments' ); ?></label>
							</th>
							<td>
							<input id="heateor_ffc_top" name="heateor_ffc[top]" type="checkbox" <?php echo isset( $options['top'] ) ? 'checked = "checked"' : '';?> value="1" />
							<label for="heateor_ffc_top"><?php _e( 'Top of the content', 'fancy-facebook-comments' ) ?></label><br/>
							<input id="heateor_ffc_bottom" name="heateor_ffc[bottom]" type="checkbox" <?php echo isset( $options['bottom'] ) ? 'checked = "checked"' : '';?> value="1" />
							<label for="heateor_ffc_bottom"><?php _e( 'Bottom of the content', 'fancy-facebook-comments' ) ?></label>
							</td>
						</tr>
						
						<tr class="heateor_ffc_help_content" id="heateor_ffc_position_help_cont">
							<td colspan="2">
							<div>
							<?php _e( 'Specify position of the Facebook comment box with respect to the content', 'fancy-facebook-comments' ) ?>
							</div>
							</td>
						</tr>

						<tr>
							<th>
							<img id="heateor_ffc_fb_comment_url_help" class="heateor_ffc_help_bubble" src="<?php echo plugins_url('../../images/info.png', __FILE__) ?>" />
							<label for="heateor_ffc_comment_url"><?php _e( 'Load comments for', 'fancy-facebook-comments' ); ?></label>
							</th>
							<td id="heateor_ffc_url_to_comment_column">
							<input id="heateor_ffc_url_to_comment_default" name="heateor_ffc[url_to_comment]" type="radio" <?php echo $options['url_to_comment'] == 'default' ? 'checked = "checked"' : '';?> value="default" />
							<label for="heateor_ffc_url_to_comment_default"><?php _e( 'Url of the webpage where Facebook Comments box is placed (default)', 'fancy-facebook-comments' ) ?></label><br/>
							<input id="heateor_ffc_url_to_comment_home" name="heateor_ffc[url_to_comment]" type="radio" <?php echo $options['url_to_comment'] == 'home' ? 'checked = "checked"' : '';?> value="home" />
							<label for="heateor_ffc_url_to_comment_home"><?php _e( 'Url of the homepage of your website', 'fancy-facebook-comments' ) ?></label><br/>
							<input id="heateor_ffc_url_to_comment_custom" name="heateor_ffc[url_to_comment]" type="radio" <?php echo $options['url_to_comment'] == 'custom' ? 'checked = "checked"' : '';?> value="custom" />
							<label for="heateor_ffc_url_to_comment_custom"><?php _e( 'Custom url', 'fancy-facebook-comments' ) ?></label><br/>
							<input id="heateor_ffc_url_to_comment_custom_url" name="heateor_ffc[url_to_comment_custom]" type="text" value="<?php echo $options['url_to_comment_custom']; ?>" />
							</td>
						</tr>
						
						<tr class="heateor_ffc_help_content" id="heateor_ffc_fb_comment_url_help_cont">
							<td colspan="2">
							<div>
							<?php _e( 'The absolute URL that comments posted will be permanently associated with. Stories on Facebook about comments posted, will link to this URL', 'fancy-facebook-comments' ) ?>
							</div>
							</td>
						</tr>
						
						<tr>
							<td colspan="2">
							<div>
							<a href="https://www.heateor.com/facebook-comments-moderation" target="_blank" style="text-decoration:none"><input type="button" value="<?php _e( 'Show Recent Facebook Comments in a Widget', 'fancy-facebook-comments' ) ?>" class="ss_demo" /></a>
							</div>
							</td>
						</tr>

						<tr>
							<th>
							<img id="heateor_ffc_fb_comment_width_help" class="heateor_ffc_help_bubble" src="<?php echo plugins_url('../../images/info.png', __FILE__) ?>" />
							<label for="heateor_ffc_fbcomment_width"><?php _e( 'Width', 'fancy-facebook-comments' ); ?></label>
							</th>
							<td>
							<input id="heateor_ffc_fbcomment_width" name="heateor_ffc[comment_width]" type="text" value="<?php echo $options['comment_width']; ?>" />px
							</td>
						</tr>
						
						<tr class="heateor_ffc_help_content" id="heateor_ffc_fb_comment_width_help_cont">
							<td colspan="2">
							<div>
							<?php _e( 'Leave empty to auto-adjust the width. The width (in pixels) of the Comments block.', 'fancy-facebook-comments' ) ?>
							</div>
							</td>
						</tr>
						
						<tr>
							<th>
							<img id="heateor_ffc_fb_comment_numposts_help" class="heateor_ffc_help_bubble" src="<?php echo plugins_url('../../images/info.png', __FILE__) ?>" />
							<label for="heateor_ffc_fbcomment_numposts"><?php _e( 'Number of comments', 'fancy-facebook-comments' ); ?></label>
							</th>
							<td>
							<input id="heateor_ffc_fbcomment_numposts" name="heateor_ffc[comment_numposts]" type="text" value="<?php echo $options['comment_numposts']; ?>" />
							</td>
						</tr>
						
						<tr class="heateor_ffc_help_content" id="heateor_ffc_fb_comment_numposts_help_cont">
							<td colspan="2">
							<div>
							<?php _e( 'The number of comments to show by default. The minimum value is 1. Defaults to 10', 'fancy-facebook-comments' ) ?>
							</div>
							</td>
						</tr>
						
						<tr>
							<th>
							<img id="heateor_ffc_fb_comment_orderby_help" class="heateor_ffc_help_bubble" src="<?php echo plugins_url('../../images/info.png', __FILE__) ?>" />
							<label for="heateor_ffc_fbcomment_orderby"><?php _e( 'Order by', 'fancy-facebook-comments' ); ?></label>
							</th>
							<td>
							<select id="heateor_ffc_fbcomment_orderby" name="heateor_ffc[comment_orderby]">
								<option value="social" <?php echo $options['comment_orderby'] == 'social' ? 'selected="selected"' : '' ?>><?php _e( 'Social', 'fancy-facebook-comments' ) ?></option>
								<option value="reverse_time" <?php echo $options['comment_orderby'] == 'reverse_time' ? 'selected="selected"' : '' ?>><?php _e( 'Reverse Time', 'fancy-facebook-comments' ) ?></option>
								<option value="time" <?php echo $options['comment_orderby'] == 'time' ? 'selected="selected"' : '' ?>><?php _e( 'Time', 'fancy-facebook-comments' ) ?></option>
							</select>
							</td>
						</tr>
						
						<tr class="heateor_ffc_help_content" id="heateor_ffc_fb_comment_orderby_help_cont">
							<td colspan="2">
							<div>
							<?php _e( 'The order to use when displaying comments.', 'fancy-facebook-comments' ) ?>
							</div>
							</td>
						</tr>
						
						<tr>
							<td colspan="2">
							<div>
							<a href="https://www.heateor.com/facebook-comments-moderation" target="_blank" style="text-decoration:none"><input type="button" value="<?php _e( 'Recover Facebook Comments Lost After Moving to SSL/Https', 'fancy-facebook-comments' ) ?>" class="ss_demo" /></a>
							</div>
							</td>
						</tr>

						<tr>
							<th>
							<img id="heateor_ffc_fb_comment_lang_help" class="heateor_ffc_help_bubble" src="<?php echo plugins_url('../../images/info.png', __FILE__) ?>" />
							<label for="heateor_ffc_fbcomment_lang"><?php _e( 'Language', 'fancy-facebook-comments' ); ?></label>
							</th>
							<td>
							<input id="heateor_ffc_fbcomment_lang" name="heateor_ffc[comment_lang]" type="text" value="<?php echo $options['comment_lang']; ?>" />
							</td>
						</tr>
						
						<tr class="heateor_ffc_help_content" id="heateor_ffc_fb_comment_lang_help_cont">
							<td colspan="2">
							<div>
							<?php echo sprintf(__('Enter the code of the language you want to use to display commenting. You can find the language codes at <a href="%s" target="_blank">this link</a>. Leave it empty for default language(English)', 'fancy-facebook-comments' ), '//www.facebook.com/translations/FacebookLocales.xml') ?>
							</div>
							</td>
						</tr>

						<tr>
							<th>
							<img id="heateor_ffc_delete_options_help" class="heateor_ffc_help_bubble" src="<?php echo plugins_url( '../../images/info.png', __FILE__ ) ?>" />
							<label for="heateor_ffc_delete_options"><?php _e("Delete all the options on plugin deletion", 'fancy-facebook-comments' ); ?></label>
							</th>
							<td>
							<input id="heateor_ffc_delete_options" name="heateor_ffc[delete_options]" type="checkbox" <?php echo isset( $options['delete_options'] ) ? 'checked = "checked"' : '';?> value="1" />
							</td>
						</tr>
						
						<tr class="heateor_ffc_help_content" id="heateor_ffc_delete_options_help_cont">
							<td colspan="2">
							<div>
							<?php _e( 'If enabled, plugin options will get deleted when plugin is deleted/uninstalled and you will need to reconfigure the options when you install the plugin next time.', 'fancy-facebook-comments' ) ?>
							</div>
							</td>
						</tr>
					</table>
					</div>
				</div>
				</div>
				<?php include 'fancy-facebook-comments-about.php'; ?>
			</div>
			
			<div class="menu_containt_div" id="tabs-2">
				<div class="clear"></div>
				<div class="heateor_ffc_left_column">
				<div class="stuffbox">
					<h3><label><?php _e( 'Shortcode', 'fancy-facebook-comments' );?></label></h3>
					<div class="inside">
						<p>[Fancy_Facebook_Comments]</p>
						<p><a style="text-decoration:none" href="http://support.heateor.com/fancy-facebook-comments-shortcode/" target="_blank"><?php _e( 'More details', 'fancy-facebook-comments' ) ?></a></p>
					</div>
				</div>
				<div class="stuffbox">
					<h3><label><?php _e( 'Widget', 'fancy-facebook-comments' );?></label></h3>
					<div class="inside">
						<p><?php echo sprintf( __( 'You can enable Fancy Facebook Comments widget from <a style="text-decoration:none" href="%s" target="_blank">Appearance > Widgets</a> page', 'fancy-facebook-comments' ), admin_url() . 'widgets.php' ); ?></p>
					</div>
				</div>
				</div>
				<?php include 'fancy-facebook-comments-about.php'; ?>
			</div>

			<div class="menu_containt_div" id="tabs-3">
				<div class="clear"></div>
				<div class="heateor_ffc_left_column">
				<div class="stuffbox">
					<h3><label><?php _e( 'FAQ', 'fancy-facebook-comments' ) ?></label></h3>
					<div class="inside faq">
						<div class="inside">
							<p><a style="text-decoration:none" href="https://www.heateor.com/facebook-comments-moderation" target="_blank"><?php _e('How to show recent Facebook Comments from all over the website in a widget?', 'fancy-facebook-comments' ) ?></a></p>
							<p><a style="text-decoration:none" href="http://support.heateor.com/recover-facebook-comments-wordpress-moving-to-https-ssl/" target="_blank"><?php _e('How to recover the Facebook Comments lost after moving my website to SSL/Https?', 'fancy-facebook-comments' ) ?></a></p>
							<p><a style="text-decoration:none" href="http://support.heateor.com/disable-facebook-comments-individual-posts" target="_blank"><?php _e( 'How to Disable Facebook Comments at Individual Posts?', 'fancy-facebook-comments' ) ?></a></p>
							<p><a style="text-decoration:none" href="http://support.heateor.com/browser-blocking-social-features/" target="_blank"><?php _e('Why is my browser blocking some features of the plugin?', 'fancy-facebook-comments' ) ?></a></p>
						</div>
					</div>
				</div>

				</div>
				<?php include 'fancy-facebook-comments-about.php'; ?>
			</div>
			
			<div class="heateor_ffc_clear"></div>
			<p class="submit">
				<input style="margin-left:8px" type="submit" name="save" class="button button-primary" value="<?php _e( "Save Changes", 'fancy-facebook-comments' ); ?>" />
			</p>
			</form>
			<div class="stuffbox">
				<h3><label>Instagram Shoutout</label></h3>
				<div class="inside">
				<p><?php _e( 'If you can send (to hello@heateor.com) how our plugin is helping your business, we can share it on Instagram. You can also send any relevant hashtags and people to mention in the Instagram post.', 'fancy-facebook-comments' ) ?></p>
				<p><?php _e( '<b>Example</b> - Blah-Blah Online Coaching teaches various programming language courses through their website. They have emerged as one of the most popular online coaching websites in the past year. Anyone can become proficient in programming language of their choice in a very easy way in no time.', 'fancy-facebook-comments' ) ?></p>
				<p><?php _e( '@blahblahonlinecoaching proudly use #FancyFacebookComments to let visitors comment using their Facebook accounts at their website. Be sure to visit their website at blahblahonlinecoaching.com where you can browse a variety of programming language courses.', 'fancy-facebook-comments' ) ?></p>
				</div>
			</div>
		</div>
</div>
