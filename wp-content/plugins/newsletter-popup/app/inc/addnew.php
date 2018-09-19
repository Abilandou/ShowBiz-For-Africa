<?php if ( ! defined( 'ABSPATH' ) ) exit;
global $wpdb;
$tbl = $wpdb->prefix.'mk_newsletter_data';
		$current_time =  date("Y-m-d h:i:s");
		$current_user = wp_get_current_user();
		$cuid = $current_user->ID; 
if(isset($_POST['nl_submit']) && wp_verify_nonce( $_POST['nlp_nonce_field'], 'nlp_action' ))
{
	$defaultName = sanitize_text_field($_POST['wp_newsletter_popupname']);	
    $status = sanitize_text_field($_POST['newsletter_status']);
	unset($_POST['nl_submit']);
	unset($_POST['wp_newsletter_popupname']);
	unset($_POST['newsletter_status']);
	unset($_POST['nlp_nonce_field']);
	unset($_POST['_wp_http_referer']);
	$formData = array();
	foreach($_POST as $key => $val)
	{
		$formData[$key] = $val;
	}
	$encodedData = json_encode($formData);
   $saveData = $this->saveData($defaultName, $encodedData, $current_time, $cuid, $status);	
	if($saveData)
	{
		$this->redirect('admin.php?page=wp_newsletter_edit_item&id='.$saveData.'&msg=1');
	}
}
?>	
<script>
var rid = "";
</script>
<?php
/*Default Setting of Slidein Newsletter*/
if($_GET['type'] == 'video')
{
	$wp_newsletter_heading_color = '#fff';
	$title_bck_color = '';
	$wp_newsletter_description_color ='';
	$wp_newsletter_privacy_color = '';
	$wp_newsletter_upper_part_color = '';
	$wp_newsletter_bottom_part_color = '';
	$arrow_position = 'top-left-inside';
	$wp_newsletter_backgroung_color = '';
	$wp_newsletter_width = "";
	$wp_newsletter_maxwidth = "";
	$wp_newsletter_mintopbottommargin = "";
	$wp_newsletter_popup_overlayopacity = "";
	$wp_newsletter_backgroundimage ='';
	$wp_newsletter_close_bg_color='';
	$wp_newsletter_close_hover='';	
}
if($_GET['type'] == 'slidein')
{
	$wp_newsletter_heading_color = '#fff';
	$title_bck_color = '#4792d6';
	$wp_newsletter_description_color ='#fff';
	$wp_newsletter_privacy_color = '#fff';
	$wp_newsletter_upper_part_color = '#4792d6';
	$wp_newsletter_bottom_part_color = '#4792d6';
	$arrow_position = 'top-left-inside';
	$wp_newsletter_backgroung_color = '';
	$wp_newsletter_width = "";
	$wp_newsletter_maxwidth = "";
	$wp_newsletter_mintopbottommargin = "";
	$wp_newsletter_popup_overlayopacity = "";
	$wp_newsletter_backgroundimage ='';
	$wp_newsletter_close_bg_color='';
	$wp_newsletter_close_hover='';	
}
/*Default Setting of lightbox Newsletter*/
if($_GET['type'] == 'lightbox')
{
	$wp_newsletter_heading_color = '#fff';
	$title_bck_color = '#4792d6';
	$wp_newsletter_description_color ='#333';
	$wp_newsletter_privacy_color = '#333';
	$wp_newsletter_upper_part_color = '';
	$wp_newsletter_bottom_part_color = '';
	$arrow_position = 'top-right-inside';
	$wp_newsletter_backgroung_color = '#fff';
	$wp_newsletter_width = "";
	$wp_newsletter_maxwidth = "";
	$wp_newsletter_mintopbottommargin = "50";
	$wp_newsletter_ribbon_show_checked = 'checked';
	$wp_newsletter_popup_overlayopacity = "";
	$wp_newsletter_backgroundimage ='';
	$wp_newsletter_close_bg_color='';
	$wp_newsletter_close_hover='';	
}
/*Default Setting of bar Newsletter*/
if($_GET['type'] == 'bar')
{
	$wp_newsletter_heading_color = '';
	$title_bck_color = '';
	$wp_newsletter_description_color ='#fff';
	$wp_newsletter_privacy_color = '#fff';
	$wp_newsletter_upper_part_color = '';
	$wp_newsletter_bottom_part_color = '';
	$wp_newsletter_backgroung_color = '#1998b8';
	$arrow_position = 'top-right-inside';
	$wp_newsletter_width = "";
	$wp_newsletter_maxwidth = "";
	$wp_newsletter_mintopbottommargin = "";
	$wp_newsletter_popup_overlayopacity = "";
	$wp_newsletter_backgroundimage ='';
	$wp_newsletter_close_bg_color='';
	$wp_newsletter_close_hover='';	
} 
/*Default Setting of popup Newsletter*/
if($_GET['type'] == 'popup')
{
	$wp_newsletter_heading_color = '';
	$title_bck_color = '';
	$wp_newsletter_description_color ='#333';
	$wp_newsletter_privacy_color = '#333';
	$wp_newsletter_upper_part_color = '';
	$wp_newsletter_bottom_part_color = '';
	$wp_newsletter_backgroung_color = '';
	$arrow_position = 'top-right-inside';
	$wp_newsletter_width = "100";
	$wp_newsletter_maxwidth = "760";
	$wp_newsletter_mintopbottommargin = "50";
	$wp_newsletter_popup_overlayopacity = "";
	$wp_newsletter_backgroundimage ='';
	$wp_newsletter_close_bg_color='';
	$wp_newsletter_close_hover='';	
} 
/*Default Setting of popup2 Newsletter*/
if($_GET['type'] == 'popup2')
{
	$wp_newsletter_heading_color = '';
	$title_bck_color = '';
	$wp_newsletter_description_color ='#fff';
	$wp_newsletter_privacy_color = '#333';
	$wp_newsletter_upper_part_color = '';
	$wp_newsletter_bottom_part_color = '';
	$wp_newsletter_backgroung_color = '';
	$arrow_position = 'top-right-inside';
	$wp_newsletter_width = "100";
	$wp_newsletter_maxwidth = "760";
	$wp_newsletter_mintopbottommargin = "50";
	$wp_newsletter_popup_overlayopacity = "1";
	$wp_newsletter_backgroundimage ='';
	$wp_newsletter_close_bg_color='';
	$wp_newsletter_close_hover='';	
} 
/*Default Setting of popup3 Newsletter*/
if($_GET['type'] == 'popup3')
{
	$wp_newsletter_heading_color = '';
	$title_bck_color = '';
	$wp_newsletter_description_color ='#333';
	$wp_newsletter_privacy_color = '#333';
	$wp_newsletter_upper_part_color = '';
	$wp_newsletter_bottom_part_color = '';
	$wp_newsletter_backgroung_color = '';
	$arrow_position = 'top-right-inside';
	$wp_newsletter_width = "100";
	$wp_newsletter_maxwidth = "760";
	$wp_newsletter_mintopbottommargin = "50";
	$wp_newsletter_popup_overlayopacity = "1";
	$wp_newsletter_backgroundimage ='';
	$wp_newsletter_close_bg_color='';
	$wp_newsletter_close_hover='';	
} 
/*Default Setting of popup4 Newsletter*/
if($_GET['type'] == 'popup4')
{
	$wp_newsletter_heading_color = '';
	$title_bck_color = '';
	$wp_newsletter_description_color ='';
	$wp_newsletter_privacy_color = '';
	$wp_newsletter_upper_part_color = '';
	$wp_newsletter_bottom_part_color = '';
	$wp_newsletter_backgroung_color = '';
	$arrow_position = 'top-right-inside';
	$wp_newsletter_width = "100";
	$wp_newsletter_maxwidth = "760";
	$wp_newsletter_mintopbottommargin = "50";
	$wp_newsletter_popup_overlayopacity = "1";
	$wp_newsletter_backgroundimage ='';
	$wp_newsletter_close_bg_color='';
	$wp_newsletter_close_hover='';	
}
/*Default Setting of popup5 Newsletter*/
if($_GET['type'] == 'popup5')
{
	$wp_newsletter_heading_color = '';
	$title_bck_color = '';
	$wp_newsletter_description_color ='';
	$wp_newsletter_privacy_color = '';
	$wp_newsletter_upper_part_color = '';
	$wp_newsletter_bottom_part_color = '';
	$wp_newsletter_backgroung_color = '#d8d8d8';
	$arrow_position = 'top-right-inside';
	$wp_newsletter_width = "100";
	$wp_newsletter_maxwidth = "760";
	$wp_newsletter_mintopbottommargin = "50";
	$wp_newsletter_popup_overlayopacity = "0.8";
	$wp_newsletter_backgroundimage ='';
	$wp_newsletter_close_bg_color='';
	$wp_newsletter_close_hover='';	
}  
/*Default Setting of popup6 Newsletter*/
if($_GET['type'] == 'popup6')
{
	$wp_newsletter_heading_color = '';
	$title_bck_color = '';
	$wp_newsletter_description_color ='';
	$wp_newsletter_privacy_color = '';
	$wp_newsletter_upper_part_color = '';
	$wp_newsletter_bottom_part_color = '';
	$wp_newsletter_backgroung_color = '';
	$arrow_position = 'top-right-inside';
	$wp_newsletter_width = "100";
	$wp_newsletter_maxwidth = "760";
	$wp_newsletter_mintopbottommargin = "50";
	$wp_newsletter_popup_overlayopacity = "0.8";
	$wp_newsletter_backgroundimage ='';
	$wp_newsletter_close_bg_color='';
	$wp_newsletter_close_hover='';	
} 
/*Default Setting of popup7 Newsletter*/
if($_GET['type'] == 'popup7')
{
	$wp_newsletter_heading_color = '';
	$title_bck_color = '';
	$wp_newsletter_description_color ='';
	$wp_newsletter_privacy_color = '';
	$wp_newsletter_upper_part_color = '';
	$wp_newsletter_bottom_part_color = '';
	$wp_newsletter_backgroung_color = '';
	$arrow_position = 'top-right-inside';
	$wp_newsletter_width = "100";
	$wp_newsletter_maxwidth = "760";
	$wp_newsletter_mintopbottommargin = "50";
	$wp_newsletter_popup_overlayopacity = "0.8";
	$wp_newsletter_backgroundimage ='';
	$wp_newsletter_close_bg_color='';
	$wp_newsletter_close_hover='';	
} 

if($_GET['type'] == 'popup8')
{
	$wp_newsletter_heading_color = '';
	$title_bck_color = '';
	$wp_newsletter_description_color ='';
	$wp_newsletter_privacy_color = '';
	$wp_newsletter_upper_part_color = '';
	$wp_newsletter_bottom_part_color = '';
	$wp_newsletter_backgroung_color = '';
	$arrow_position = 'top-right-inside';
	$wp_newsletter_width = "100";
	$wp_newsletter_maxwidth = "760";
	$wp_newsletter_mintopbottommargin = "50";
	$wp_newsletter_popup_overlayopacity = "0.8";
	$wp_newsletter_backgroundimage ='';
	$wp_newsletter_close_bg_color='';
	$wp_newsletter_close_hover='';	
}

if($_GET['type'] == 'popup_1_pro')
{
	$wp_newsletter_heading_color = '';
	$title_bck_color = '';
	$wp_newsletter_description_color ='';
	$wp_newsletter_privacy_color = '';
	$wp_newsletter_upper_part_color = '';
	$wp_newsletter_bottom_part_color = '';
	$wp_newsletter_backgroung_color = '';
	$arrow_position = 'top-right-inside';
	$wp_newsletter_width = "100";
	$wp_newsletter_maxwidth = "760";
	$wp_newsletter_mintopbottommargin = "50";
	$wp_newsletter_popup_overlayopacity = "1";
	$wp_newsletter_backgroundimage ='';
	$wp_newsletter_close_bg_color='';
	$wp_newsletter_close_hover='';	
}
if($_GET['type'] == 'popup_2_pro')
{
	$wp_newsletter_heading_color = '';
	$title_bck_color = '';
	$wp_newsletter_description_color ='';
	$wp_newsletter_privacy_color = '#fff';
	$wp_newsletter_upper_part_color = '';
	$wp_newsletter_bottom_part_color = '';
	$wp_newsletter_backgroung_color = '';
	$arrow_position = 'top-right-inside';
	$wp_newsletter_width = "100";
	$wp_newsletter_maxwidth = "760";
	$wp_newsletter_mintopbottommargin = "50";
	$wp_newsletter_popup_overlayopacity = "1";
	$wp_newsletter_backgroundimage ='';
	$wp_newsletter_close_bg_color='';
	$wp_newsletter_close_hover='';
}
if($_GET['type'] == 'popup_3_pro')
{
	$wp_newsletter_heading_color = '';
	$title_bck_color = '';
	$wp_newsletter_description_color ='';
	$wp_newsletter_privacy_color = '#fff';
	$wp_newsletter_upper_part_color = '';
	$wp_newsletter_bottom_part_color = '';
	$wp_newsletter_backgroung_color = '';
	$arrow_position = 'top-right-inside';
	$wp_newsletter_width = "100";
	$wp_newsletter_maxwidth = "760";
	$wp_newsletter_mintopbottommargin = "50";
	$wp_newsletter_popup_overlayopacity = "1";
	$wp_newsletter_backgroundimage ='';
	$wp_newsletter_close_bg_color='';
	$wp_newsletter_close_hover='';
}
if($_GET['type'] == 'popup_4_pro')
{
	$wp_newsletter_heading_color = '#404040';
	$title_bck_color = '';
	$wp_newsletter_description_color ='#404040';
	$wp_newsletter_privacy_color = '#fff';
	$wp_newsletter_upper_part_color = '';
	$wp_newsletter_bottom_part_color = '';
	$wp_newsletter_backgroung_color = '';
	$arrow_position = 'top-right-inside';
	$wp_newsletter_width = "100";
	$wp_newsletter_maxwidth = "760";
	$wp_newsletter_mintopbottommargin = "50";
	$wp_newsletter_popup_overlayopacity = "1";
	$wp_newsletter_backgroundimage ='';	
	$wp_newsletter_close_bg_color='';
	$wp_newsletter_close_hover='';
}
if($_GET['type'] == 'popup_5_pro')
{
	$wp_newsletter_heading_color = '#fff';
	$title_bck_color = '';
	$wp_newsletter_description_color ='#fff';
	$wp_newsletter_privacy_color = '#fff';
	$wp_newsletter_upper_part_color = '';
	$wp_newsletter_bottom_part_color = '';
	$wp_newsletter_backgroung_color = '';
	$arrow_position = 'top-right-inside';
	$wp_newsletter_width = "100";
	$wp_newsletter_maxwidth = "760";
	$wp_newsletter_mintopbottommargin = "50";
	$wp_newsletter_popup_overlayopacity = "1";
	$wp_newsletter_backgroundimage ='';	
	$wp_newsletter_close_bg_color='#e98422';
	$wp_newsletter_close_hover='#e98422';
}
if($_GET['type'] == 'popup_6_pro')
{
	$wp_newsletter_heading_color = '#fff';
	$title_bck_color = '';
	$wp_newsletter_description_color ='#fff';
	$wp_newsletter_privacy_color = '#fff';
	$wp_newsletter_upper_part_color = '';
	$wp_newsletter_bottom_part_color = '';
	$wp_newsletter_backgroung_color = '';
	$arrow_position = 'top-right-inside';
	$wp_newsletter_width = "100";
	$wp_newsletter_maxwidth = "760";
	$wp_newsletter_mintopbottommargin = "50";
	$wp_newsletter_popup_overlayopacity = "1";
	$wp_newsletter_backgroundimage ='';	
	$wp_newsletter_close_bg_color='#fff';
	$wp_newsletter_close_hover='#fff';
	$wp_newsletter_showcancel='';
}
if($_GET['type'] == 'popup_7_pro')
{
	$wp_newsletter_heading_color = '#fff';
	$title_bck_color = '';
	$wp_newsletter_description_color ='#fff';
	$wp_newsletter_privacy_color = '#fff';
	$wp_newsletter_upper_part_color = '';
	$wp_newsletter_bottom_part_color = '';
	$wp_newsletter_backgroung_color = '';
	$arrow_position = 'top-right-inside';
	$wp_newsletter_width = "100";
	$wp_newsletter_maxwidth = "760";
	$wp_newsletter_mintopbottommargin = "50";
	$wp_newsletter_popup_overlayopacity = "1";
	$wp_newsletter_backgroundimage ='';	
	$wp_newsletter_close_bg_color='#fff';
	$wp_newsletter_close_hover='#fff';
	$wp_newsletter_showcancel='';
}
if($_GET['type'] == 'popup_8_pro')
{
	$wp_newsletter_heading_color = '#0e4a66';
	$title_bck_color = '';
	$wp_newsletter_description_color ='#0e4a66';
	$wp_newsletter_privacy_color = '#0e4a66';
	$wp_newsletter_upper_part_color = '';
	$wp_newsletter_bottom_part_color = '';
	$wp_newsletter_backgroung_color = '';
	$arrow_position = 'top-right-inside';
	$wp_newsletter_width = "100";
	$wp_newsletter_maxwidth = "760";
	$wp_newsletter_mintopbottommargin = "50";
	$wp_newsletter_popup_overlayopacity = "1";
	$wp_newsletter_backgroundimage ='';	
	$wp_newsletter_close_bg_color='#fff';
	$wp_newsletter_close_hover='#fff';
	$wp_newsletter_showcancel='';
}
if($_GET['type'] == 'popup_9_pro')
{
	$wp_newsletter_heading_color = '#fff';
	$title_bck_color = '';
	$wp_newsletter_description_color ='#fff';
	$wp_newsletter_privacy_color = '#fff';
	$wp_newsletter_upper_part_color = '';
	$wp_newsletter_bottom_part_color = '';
	$wp_newsletter_backgroung_color = '';
	$arrow_position = 'top-right-inside';
	$wp_newsletter_width = "100";
	$wp_newsletter_maxwidth = "760";
	$wp_newsletter_mintopbottommargin = "50";
	$wp_newsletter_popup_overlayopacity = "1";
	$wp_newsletter_backgroundimage ='';	
	$wp_newsletter_close_bg_color='#fff';
	$wp_newsletter_close_hover='#fff';
	$wp_newsletter_showcancel='';
}
if($_GET['type'] == 'popup_10_pro')
{
	$wp_newsletter_heading_color = '#0e4a66';
	$title_bck_color = '';
	$wp_newsletter_description_color ='#0e4a66';
	$wp_newsletter_privacy_color = '#0e4a66';
	$wp_newsletter_upper_part_color = '';
	$wp_newsletter_bottom_part_color = '';
	$wp_newsletter_backgroung_color = '';
	$arrow_position = 'top-right-inside';
	$wp_newsletter_width = "100";
	$wp_newsletter_maxwidth = "760";
	$wp_newsletter_mintopbottommargin = "50";
	$wp_newsletter_popup_overlayopacity = "1";
	$wp_newsletter_backgroundimage ='';	
	$wp_newsletter_close_bg_color='#fff';
	$wp_newsletter_close_hover='#fff';
	$wp_newsletter_showcancel='';
}
?>
<div class="wrap">
<?php $this->load_help_desk();?>
<h2><?php _e('Add New', 'nlp'); ?></h2>
<form action="" method="post" name="nl_form">
<?php wp_nonce_field( 'nlp_action', 'nlp_nonce_field' ); ?>
<ul class='tabs'>
  <li><a href='#tab1'><?php _e('Design Rules', 'nlp'); ?></a></li>
  <li><a href='#tab2'><?php _e('Action', 'nlp'); ?></a></li>
  <li><a href='#tab3'><?php _e('Email Service', 'nlp'); ?></a></li>
  <li><label class="switch"><input type="checkbox" value="publish" checked="checked" name="newsletter_status" id="newsletter_status" /><div class="slider round"></div></label> <?php _e('Publish', 'nlp'); ?></li>
</ul>
<div id='tab1' class="some_rules">
<div id="newsletter_view"></div>
    <ul class='tabs subtabs'>
      <li><a href='#general'><?php _e('General', 'nlp'); ?></a></li>
      <li><a href='#content'><?php _e('Content', 'nlp'); ?></a></li>
      <li><a href='#background'><?php _e('Background', 'nlp'); ?></a></li>
      <li><a href='#form'><?php _e('Form', 'nlp'); ?></a></li>
    </ul>
<?php /* General */ ?>   
<div id="general">
<table class="wp_newsletter-form-table-noborder">
<tbody>									
<tr>
<th><?php _e('Name (not displayed on the popup)', 'nlp'); ?>:</th>
<td><input name="wp_newsletter_popupname" id="wp_newsletter_popupname" value="Untitled" class="wp_newsletter_option regular-text" type="text"></td>
</tr>	
							    <?php
									if($_GET['type'] == 'bar'){ ?>
									<tr style="display:table-row;">
									<th>Notification bar position:</th>
										<td>
										<label><select name="wp_newsletter-popup-barposition" id="wp_newsletter-popup-barposition" class="wp_newsletter-popup-option">
										<option value="bottom">Bottom</option>
										<option value="top" selected="">Top</option>
										</select></label>
										<br><label><input type="checkbox" name="wp_newsletter-popup-barfloat" id="wp_newsletter-popup-barfloat" value="1" class="wp_newsletter-popup-option"> Float on top of the web page</label>
									</td>
									</tr>	
								<?php	} else { ?>
                               <tr style="display:table-row;">
										<th><?php _e('Width (percent)', 'nlp'); ?>:</th>
										<td>
										<label><input name="wp_newsletter_width" id="wp_newsletter_width" value="<?php if(!empty($wp_newsletter_width)){echo $wp_newsletter_width; }else{echo "300";}?>" class="wp_newsletter_option small-text" type="number"></label>
										</td>
									</tr>
									
									<tr style="display:table-row;">
										<th><?php _e('Maximum width (px)', 'nlp'); ?>:</th>
										<td>
										<label><input name="wp_newsletter_maxwidth" id="wp_newsletter_maxwidth" value="<?php if(!empty($wp_newsletter_maxwidth)){echo $wp_newsletter_maxwidth;}else{echo '100';}?>" class="wp_newsletter_option small-text" type="number"></label>
										</td>
									</tr>
								<?php } ?>
									<tr style="display:table-row;">
										<th><?php _e('Margin on top and bottom of the Popup (px)', 'nlp'); ?>:</th>
										<td>
										<label><input name="wp_newsletter_mintopbottommargin" id="wp_newsletter_mintopbottommargin" value="<?php if(!empty($wp_newsletter_mintopbottommargin)){echo $wp_newsletter_mintopbottommargin;}else{echo "0";}?>" class="wp_newsletter_option small-text" type="number"></label>
										</td>
									</tr>
									<?php 
									
									if($_GET['type'] == 'slidein'):
									?>
									<tr style="display:table-row;">
									<th><?php _e('Slide in position', 'nlp'); ?>:</th>
										<td>
										<label><select name="wp_newsletter_slideinposition" id="wp_newsletter_slideinposition" class="wp_newsletter_option">
										<option value="bottom-right" selected="selected"><?php _e('Bottom Right', 'nlp'); ?></option>
										<option value="bottom-left"><?php _e('Bottom Left', 'nlp'); ?></option>
										<option value="bottom"><?php _e('Bottom', 'nlp'); ?></option>
										</select></label>
									</td>
									</tr>
									<?php endif;
									if($_GET['type'] == 'lightbox' || $_GET['type'] == 'video' || $_GET['type'] == 'popup' || $_GET['type'] == 'popup2' || $_GET['type'] == 'popup3' || $_GET['type'] == 'popup4' || $_GET['type'] == 'popup5' || $_GET['type'] == 'popup6' || $_GET['type'] == 'popup7' || $_GET['type'] == 'popup8'):
									?>
									<tr style="display:table-row;">
										<th><?php _e('Fullscreen mode', 'nlp'); ?>:</th>
										<td>
										<label><input type="checkbox" name="wp_newsletter-popup-fullscreen" id="wp_newsletter-popup-fullscreen" value="1" class="wp_newsletter-popup-option"><?php _e('Go to full screen mode when the screen width is less than (px)', 'nlp'); ?></label>
										<label><input name="wp_newsletter-popup-fullscreenwidth" type="number" id="wp_newsletter-popup-fullscreenwidth" value="600" class="wp_newsletter-popup-option small-text"></label>
										</td>
									</tr>
									<?php endif; ?>
								</tbody>
</table>
</div>  
<?php /* end General */ ?>  

<?php /* content start */ ?>

<div id="content">
<table class="wp_newsletter-form-table-noborder">
		<tbody>
			<?php
			if(($_GET['type'] == 'slidein') || ($_GET['type'] == 'bar') ||($_GET['type'] == 'video') ||($_GET['type'] == 'popup3') ||($_GET['type'] == 'popup6')  ):
			?>
			<tr id="wp_newsletter_design-logo" style="display: table-row;">
				<th><?php _e('Logo image URL', 'nlp'); ?>:</th>
				<td></td><td></td>
				<td><input name="wp_newsletter_logo" id="wp_newsletter_logo" value="" class="wp_newsletter_contentoption wp_newsletter_option regular-text" type="text">
				<input class="button wp_newsletter_select-image" data-textid="wp_newsletter_logo" id="wp_newsletter_logo-select-image" value="Upload" type="button" onclick="open_media_uploader_image('wp_newsletter_logo')">
				<span data-textid="wp_newsletter_logo" class="wp_newsletter_clear-image" onclick="clear_uploader_image('wp_newsletter_logo')"><?php _e('Clear', 'nlp'); ?></span>
				</td>
			</tr>
			<?php endif; ?>
			<tr id="wp_newsletter_design-heading" style="display: table-row;">
				<th><?php _e('Heading (HTML allowed)', 'nlp'); ?>:</th>
				<td></td>
				<td>
				<input type="text" name="wp_newsletter_heading_color" value="<?php if(!empty($title_heading_color)){echo$title_heading_color;}else{echo "dd3333";}?>" class="nl-color-picker" ></td>
					<td><textarea name="wp_newsletter_heading" id="wp_newsletter_heading"  class="wp_newsletter_contentoption wp_newsletter_option large-text" >Subscribe To Our Newsletter</textarea></td>
				</tr>
				<?php
				if(($_GET['type'] == 'bar')){
					
				} else {
				?>
				<tr id="wp_newsletter_design-description" style="display: table-row;">
					<th><?php _e('Description (HTML allowed)', 'nlp'); ?>:</th>
					<td></td><td><input type="text" name="wp_newsletter_description_color" value="<?php  
					if(isset($wp_newsletter_description_color)&& !(empty($wp_newsletter_description_color))){echo $wp_newsletter_description_color;}?>" class="nl-color-picker" ></td>
					<td><textarea name="wp_newsletter_description" id="wp_newsletter_description" class="wp_newsletter_contentoption wp_newsletter_option large-text" rows="2"><?php _e('Subscribe to our email newsletter today to receive updates on the latest news, tutorials and special offers!', 'nlp'); ?></textarea></td>
				</tr>
				<?php } if($_GET['type'] == 'video'): ?>
				<tr id="wp_newsletter-popup-design-video" style="display: table-row;">
					<th>Video iFrame URL:</th>
					<td></td><td></td>
					<td><input name="wp_newsletter-popup-video" type="text" id="wp_newsletter-popup-video" value="https://www.youtube.com/embed/Fj8BHxvebXs" class="wp_newsletter-popup-contentoption wp_newsletter-popup-option large-text">
					<p><label><input type="checkbox" name="wp_newsletter-popup-videoautoplay" id="wp_newsletter-popup-videoautoplay" value="1" class="wp_newsletter-popup-option"> Auto play video (do not work on mobile and tablets)</label></p>
					<p><label><input type="checkbox" name="wp_newsletter-popup-videoautoclose" id="wp_newsletter-popup-videoautoclose" value="1" class="wp_newsletter-popup-option"> Auto close the popup after the video has finished </label></p>
					<p><a href="https://www.wonderplugin.com/wp_newsletter-popup/youtube-lightbox-popup/" target="_blank">Tutorial: How to play YouTube, Vimeo and other iFrame videos</a></p>
					</td>
				</tr>
				<?php endif; ?>
				<tr id="wp_newsletter_design-privacy" style="display: table-row;">
					<th><?php _e('Privacy (HTML allowed)', 'nlp'); ?>:</th>
					<td>
				   <label class="switch"><input name="wp_newsletter_privacy_show" id="wp_newsletter_privacy_show" class="wp_newsletter_option" value="1" type="checkbox"><div class="slider round"></div></label>
					</td>
					<td>
					<input type="text" name="wp_newsletter_privacy_color" value="<?php if(!empty($wp_newsletter_privacy_color)){echo $wp_newsletter_privacy_color; }?>" class="nl-color-picker" >
					</td>
					<td><textarea name="wp_newsletter_privacy" id="wp_newsletter_privacy" class="wp_newsletter_contentoption wp_newsletter_option large-text">We respect your privacy. Your information is safe and will never be shared. </textarea></td>
				</tr>
				
				<tr id="wp_newsletter_design-ribbon">
					<th><?php _e('Ribbon image URL', 'nlp'); ?>:</th>
					<td><label class="switch"><input name="wp_newsletter_ribbon_show" <?php if(isset($wp_newsletter_ribbon_show_checked)&& !empty($wp_newsletter_ribbon_show_checked)){echo $wp_newsletter_ribbon_show_checked;}?> id="wp_newsletter_ribbon_show" class="wp_newsletter_option" value="1" type="checkbox"><div class="slider round"></div></label></td>
					<td></td><td><input name="wp_newsletter_ribbon" id="wp_newsletter_ribbon" value="<?php echo MK_NEWSLETTER_URL.'skins/ribbon-0.png'; ?>" class="wp_newsletter_contentoption wp_newsletter_option regular-text" type="text">
					<input class="button wp_newsletter_select-image" data-textid="wp_newsletter_ribbon" id="wp_newsletter_ribbon-select-image" value="Upload" type="button" onclick="open_media_uploader_image('wp_newsletter_ribbon')">
					<span data-textid="wp_newsletter_ribbon" class="wp_newsletter_clear-image" onclick="clear_uploader_image('wp_newsletter_ribbon')"><?php _e('Clear', 'nlp'); ?></span>
					<br><label><?php _e('Position CSS', 'nlp'); ?>: <input name="wp_newsletter_ribboncss" id="wp_newsletter_ribboncss" value="top:-8px;left:-8px;" class="wp_newsletter_option medium-text" type="text"></label>
					</td>
				</tr>
				
				<tr id="wp_newsletter_design-closetip">
					<th><?php _e('Tip on close', 'nlp'); ?>:</th>
					<td>
					<label class="switch"><input name="wp_newsletter_closetip_show" id="wp_newsletter_closetip_show" class="wp_newsletter_option" value="1" type="checkbox"><div class="slider round"></div></label>										
					</td>
					<td>                                       
					</td>
					<td><input name="wp_newsletter_closetip" id="wp_newsletter_closetip" value="Don't miss out. Subscribe today." class="wp_newsletter_contentoption wp_newsletter_option large-text" type="text"></td>
				</tr>
			<?php  if($_GET['type'] == 'slidein'):?>
				<tr id="wp_newsletter_design-hidebar" style="display:table-row;">
					<th><?php _e('Notification bar when the popup is hidden', 'nlp'); ?></th>
					<td></td>
					<td></td>
					<td>
					<input name="wp_newsletter_hidebartitle" id="wp_newsletter_hidebartitle" value="Subscribe To Our Newsletter" class="wp_newsletter_contentoption wp_newsletter_option large-text" type="text">
					</td>
				</tr>
				
				<tr id="wp_newsletter_design-hidebar-bck" style="display:table-row;">
					<th><?php _e('Background Color', 'nlp'); ?>: </th>
					<td><input type="text" name="wp_newsletter_hidebar_bg" value="" class="nl-color-picker" ></td>
					<th><?php _e('Text Color', 'nlp'); ?>:</th>
					<td><input type="text" name="wp_newsletter_hidebar_txt_color" value="" class="nl-color-picker" ></td>
				</tr> 
			<?php endif; ?>
	</tbody></table>
</div>
<?php /* content end */ ?>

<?php /* Background */ ?>
<div id="background">
<table class="wp_newsletter-form-table-noborder">
								
									<tbody><tr>
										<th><?php _e('Border radius (px)', 'nlp'); ?>:</th>
										<td><label><input name="wp_newsletter_radius" id="wp_newsletter_radius" value="0" class="wp_newsletter_option small-text" type="number">
										<?php _e('Shadow', 'nlp'); ?>: <input name="wp_newsletter_bordershadow" id="wp_newsletter_bordershadow" value="0px 1px 4px 0px rgba(0, 0, 0, 0.2)" class="wp_newsletter_option regular-text" type="text">
										</label></td>
									</tr>
									<?php  if($_GET['type'] == 'lightbox' || $_GET['type'] == 'popup' || $_GET['type'] == 'popup2' || $_GET['type'] == 'popup3' || $_GET['type'] == 'popup4'|| $_GET['type'] == 'popup5' || $_GET['type'] == 'popup6' || $_GET['type'] == 'popup7' || $_GET['type'] == 'popup8')  :?>
									<tr id="wp_newsletter-popup-design-overlaycolor" style="display:table-row;">
										<th><?php _e('Overlay background', 'nlp'); ?>:</th>
										<td><label class="withcolorpicker">
										<label><input type="text" name="wp_newsletter_overlaycolor" value="#333333" class="nl-color-picker" ></label><?php _e('Opacity', 'nlp'); ?>: <input name="wp_newsletter-popup-overlayopacity" type="number" id="wp_newsletter-popup-overlayopacity" value="<?php if(!empty($wp_newsletter_popup_overlayopacity)){echo '1';}else{echo '0.8';}?>" step="0.1" min="0" max="1" class="wp_newsletter-popup-option small-text"></label><label><input type="checkbox" name="wp_newsletter-popup-overlayclose" id="wp_newsletter-popup-overlayclose" value="1" class="wp_newsletter-popup-option"><?php _e(' Close popup when clicking on the overlay', 'nlp'); ?></label></td>
									</tr>
									<?php endif; ?>
									
									<tr id="wp_newsletter_design-close">
										<th><?php _e('Close button', 'nlp'); ?>:</th>
										<td>
                                        <label class="wp_newsletter-switch wp_newsletter-switch-small wp_newsletter-switch-checked"><input name="wp_newsletter_close_btn_show" id="wp_newsletter_close_btn_show" class="wp_newsletter_option" value="1" checked="" type="checkbox"><span class="wp_newsletter-switch-label-checked"><?php _e('Show', 'nlp'); ?></span></label> | 
                                        <?php _e('Hover Color', 'nlp'); ?>: <input type="text" name="wp_newsletter_close_hover" value="" class="nl-color-picker" > | 
                                        <?php _e('Background Color', 'nlp'); ?>: <input type="text" name="wp_newsletter_close_bg_color" value="" class="nl-color-picker" >																				
										<br>
										<label><?php _e('Position', 'nlp'); ?>: <select name="wp_newsletter_closeposition" id="wp_newsletter_closeposition" class="wp_newsletter_option">
										  <option value="top-right-inside" <?php if($arrow_position == "top-right-inside"){echo 'selected';}?>><?php _e('top-right-inside', 'nlp'); ?></option>
										  <option value="top-left-inside" <?php if($arrow_position == "top-left-inside"){echo 'selected';}?>><?php _e('top-left-inside', 'nlp'); ?></option>
										  <option value="top-right-outside" <?php if($arrow_position == "top-right-outside"){echo 'selected';}?>><?php _e('top-right-outside', 'nlp'); ?></option>
										  <option value="top-left-outside" <?php if($arrow_position == "top-left-outside"){echo 'selected';}?>><?php _e('top-left-outside', 'nlp'); ?></option>
										</select></label>
										<label><input name="wp_newsletter_closeshowshadow" id="wp_newsletter_closeshowshadow" value="1" checked="" class="wp_newsletter_option" type="checkbox"> <?php _e('Show shadow', 'nlp'); ?></label> 
										<input name="wp_newsletter_closeshadow" id="wp_newsletter_closeshadow" value="0px 2px 2px 0px rgba(0, 0, 0, 0.3)" class="wp_newsletter_option regular-text" type="text">
										</td>
									</tr>
									
									<tr id="wp_newsletter_design-backgroundcolor">
										<th><?php _e('Background color', 'nlp'); ?>:</th>
										<td><input type="text" name="wp_newsletter_backgroung_color" value="
										<?php if(!empty($wp_newsletter_backgroung_color)){echo $wp_newsletter_backgroung_color;}?>
										" class="nl-color-picker" ></td>
									</tr>
									
									<tr id="wp_newsletter_design-backgroundimage ">
										<th id="bg-align"><?php _e('Background image URL', 'nlp'); ?>:</th>
										<td><label><input name="wp_newsletter_backgroundimage" id="wp_newsletter_backgroundimage" value="" class="wp_newsletter_option regular-text" type="text">
										<input class="button wp_newsletter_select-image" data-textid="wp_newsletter_backgroundimage" id="wp_newsletter_backgroundimage-select-image" value="Upload" type="button" onclick="open_media_uploader_image('wp_newsletter_backgroundimage')">
										<span data-textid="wp_newsletter_backgroundimage" class="wp_newsletter_clear-image" onclick="clear_uploader_image('wp_newsletter_backgroundimage')"><?php _e('Clear', 'nlp'); ?></span>
										</label><br>
										<label><?php _e('Repeat', 'nlp'); ?>: <select name="wp_newsletter_backgroundimagerepeat" id="wp_newsletter_backgroundimagerepeat" class="wp_newsletter_option">
										  <option value="repeat" selected="selected"><?php _e('repeat', 'nlp'); ?></option>
										  <option value="no-repeat"><?php _e('no-repeat', 'nlp'); ?></option>
										  <option value="repeat-x"><?php _e('repeat-x', 'nlp'); ?></option>
										  <option value="repeat-y"><?php _e('repeat-y', 'nlp'); ?></option>
										</select>
										<?php _e('repeat-y', 'nlp'); ?>Position: <input name="wp_newsletter_backgroundimageposition" id="wp_newsletter_backgroundimageposition" value="0px 0px" class="wp_newsletter_option medium-text" type="text"></label>
										</td>
									</tr>
									
									<tr id="wp_newsletter_design-upperlower">
										<th><?php _e('Upper and lower', 'nlp'); ?>:</th>
										<td><?php _e('Upper Part Color', 'nlp'); ?> <input type="text" name="wp_newsletter_upper_part_color" value="<?php echo $wp_newsletter_upper_part_color; ?>" class="nl-color-picker" > | 
                                        <?php _e('Bottom Part Color', 'nlp'); ?> <input type="text" name="wp_newsletter_bottom_part_color" value="<?php echo $wp_newsletter_bottom_part_color; ?>" class="nl-color-picker" ></td>
									</tr>									
									
								</tbody></table>
</div>
<?php /* end background */ ?>

<?php /* Form */ ?>
<div id="form">							
<h3><?php _e('Fields', 'nlp'); ?></h3>
								<table class="wp_newsletter-form-table-noborder">
									
									<tbody><tr>
										<th></th>
										<td><!--<td-->
										</td><td class="td-heading"><?php _e('Size (px)', 'nlp'); ?></td>
										<td><?php _e('Post field name', 'nlp'); ?></td>
										<td><?php _e('Placeholder', 'nlp'); ?></td>
									</tr>
									
									<tr id="wp_newsletter_design-email">
										<th><?php _e('Email', 'nlp'); ?>:</th>
										<td><label class="wp_newsletter-switch wp_newsletter-switch-small wp_newsletter-switch-checked"><input name="wp_newsletter_showemail" id="wp_newsletter_showemail" class="wp_newsletter_option" value="1" checked="" type="checkbox"><span class="wp_newsletter-switch-label-checked"><?php _e('Show', 'nlp'); ?></span></label></td>
										<td><input name="wp_newsletter_emailinputwidth" id="wp_newsletter_emailinputwidth" value="300" class="wp_newsletter_option small-text" type="number"></td>
										<td><input name="wp_newsletter_emailfieldname" id="wp_newsletter_emailfieldname" value="EMAIL" class="wp_newsletter_option medium-text" type="text"></td>
										<td><input name="wp_newsletter_email" id="wp_newsletter_email" value="Enter your email address" class="wp_newsletter_option regular-text" type="text">
										</td>
									</tr>
																		
									<tr id="wp_newsletter_design-name">
										<th><?php _e('Name', 'nlp'); ?>:</th>
										<td><label class="wp_newsletter-switch wp_newsletter-switch-small wp_newsletter-switch-checked">
										
										 <?php 
									if($_GET['type'] == 'popup3' || $_GET['type'] == 'popup6' || $_GET['type'] == 'popup7' || $_GET['type'] == 'slidein'):
									?>
										<input name="wp_newsletter_showname" id="wp_newsletter_showname" class="wp_newsletter_option" value="1" checked="" type="checkbox">
									<?php else:?>
										<input name="wp_newsletter_showname" id="wp_newsletter_showname" class="wp_newsletter_option" value="1" type="checkbox">
									<?php endif;?>
										
										<span class="wp_newsletter-switch-label-checked"><?php _e('Show', 'nlp'); ?></span></label></td>
										<td><input name="wp_newsletter_nameinputwidth" id="wp_newsletter_nameinputwidth" value="300" class="wp_newsletter_option small-text" type="number"></td>
										<td><input name="wp_newsletter_namefieldname" id="wp_newsletter_namefieldname" value="NAME" class="wp_newsletter_option medium-text" type="text"></td>
										<td><input name="wp_newsletter_name" id="wp_newsletter_name" value="Enter your name" class="wp_newsletter_option regular-text" type="text">
										</td>
									</tr>
									
									<tr id="wp_newsletter_design-firstname">
										<th><?php _e('First name', 'nlp'); ?>:</th>
										<td><label class="wp_newsletter-switch wp_newsletter-switch-small "><input name="wp_newsletter_showfirstname" id="wp_newsletter_showfirstname" class="wp_newsletter_option" value="1" type="checkbox"><span class="wp_newsletter-switch-label-checked"><?php _e('Show', 'nlp'); ?></span></label></td>
										<td><input name="wp_newsletter_firstnameinputwidth" id="wp_newsletter_firstnameinputwidth" value="300" class="wp_newsletter_option small-text" type="number"></td>
										<td><input name="wp_newsletter_firstnamefieldname" id="wp_newsletter_firstnamefieldname" value="FNAME" class="wp_newsletter_option medium-text" type="text"></td>
										<td><input name="wp_newsletter_firstname" id="wp_newsletter_firstname" value="Enter your first name" class="wp_newsletter_option regular-text" type="text">
										</td>
									</tr>
									
									<tr id="wp_newsletter_design-lastname">
										<th><?php _e('Last name', 'nlp'); ?>:</th>
										<td><label class="wp_newsletter-switch wp_newsletter-switch-small "><input name="wp_newsletter_showlastname" id="wp_newsletter_showlastname" class="wp_newsletter_option" value="1" type="checkbox"><span class="wp_newsletter-switch-label-checked"><?php _e('Show', 'nlp'); ?></span></label></td>
										<td><input name="wp_newsletter_lastnameinputwidth" id="wp_newsletter_lastnameinputwidth" value="300" class="wp_newsletter_option small-text" type="number"></td>
										<td><input name="wp_newsletter_lastnamefieldname" id="wp_newsletter_lastnamefieldname" value="LNAME" class="wp_newsletter_option medium-text" type="text"></td>
										<td><input name="wp_newsletter_lastname" id="wp_newsletter_lastname" value="Enter your last name" class="wp_newsletter_option regular-text" type="text">
										</td>
									</tr>
									
									<tr id="wp_newsletter_design-phone">
										<th><?php _e('Phone', 'nlp'); ?>:</th>
										<td><label class="wp_newsletter-switch wp_newsletter-switch-small "><input name="wp_newsletter_showphone" id="wp_newsletter_showphone" class="wp_newsletter_option" value="1" type="checkbox"><span class="wp_newsletter-switch-label-checked"><?php _e('Show', 'nlp'); ?></span></label></td>
										<td><input name="wp_newsletter_phoneinputwidth" id="wp_newsletter_phoneinputwidth" value="300" class="wp_newsletter_option small-text" type="number"></td>
										<td><input name="wp_newsletter_phonefieldname" id="wp_newsletter_phonefieldname" value="PHONE" class="wp_newsletter_option medium-text" type="text"></td>
										<td><input name="wp_newsletter_phone" id="wp_newsletter_phone" value="Enter your phone number" class="wp_newsletter_option regular-text" type="text">
										</td>
									</tr>
									
									<tr id="wp_newsletter_design-company">
										<th><?php _e('Company name', 'nlp'); ?>:</th>
										<td><label class="wp_newsletter-switch wp_newsletter-switch-small "><input name="wp_newsletter_showcompany" id="wp_newsletter_showcompany" class="wp_newsletter_option" value="1" type="checkbox"><span class="wp_newsletter-switch-label-checked"><?php _e('Show', 'nlp'); ?></span></label></td>
										<td><input name="wp_newsletter_companyinputwidth" id="wp_newsletter_companyinputwidth" value="300" class="wp_newsletter_option small-text" type="number"></td>
										<td><input name="wp_newsletter_companyfieldname" id="wp_newsletter_companyfieldname" value="COMPANY" class="wp_newsletter_option medium-text" type="text"></td>
										<td><input name="wp_newsletter_company" id="wp_newsletter_company" value="Enter your company name" class="wp_newsletter_option regular-text" type="text">
										</td>
									</tr>
									
									<tr id="wp_newsletter_design-zip">
										<th><?php _e('Zip code', 'nlp'); ?>:</th>
										<td><label class="wp_newsletter-switch wp_newsletter-switch-small "><input name="wp_newsletter_showzip" id="wp_newsletter_showzip" class="wp_newsletter_option" value="1" type="checkbox"><span class="wp_newsletter-switch-label-checked"><?php _e('Show', 'nlp'); ?></span></label></td>
										<td><input name="wp_newsletter_zipinputwidth" id="wp_newsletter_zipinputwidth" value="300" class="wp_newsletter_option small-text" type="number"></td>
										<td><input name="wp_newsletter_zipfieldname" id="wp_newsletter_zipfieldname" value="ZIP" class="wp_newsletter_option medium-text" type="text"></td>
										<td><input name="wp_newsletter_zip" id="wp_newsletter_zip" value="Enter your zip code" class="wp_newsletter_option regular-text" type="text">
										</td>
									</tr>
									
									<tr id="wp_newsletter_design-message">
										<th><?php _e('Message', 'nlp'); ?>:</th>
										<td><label class="wp_newsletter-switch wp_newsletter-switch-small "><input name="wp_newsletter_showmessage" id="wp_newsletter_showmessage" class="wp_newsletter_option" value="1" type="checkbox"><span class="wp_newsletter-switch-label-checked"><?php _e('Show', 'nlp'); ?></span></label></td>
										<td><input name="wp_newsletter_messageinputwidth" id="wp_newsletter_messageinputwidth" value="300" class="wp_newsletter_option small-text" type="number">
										<?php _e('by', 'nlp'); ?> <input name="wp_newsletter_messageinputheight" id="wp_newsletter_messageinputheight" value="120" class="wp_newsletter_option small-text" type="number">
										</td>
										<td><input name="wp_newsletter_messagefieldname" id="wp_newsletter_messagefieldname" value="MESSAGE" class="wp_newsletter_option medium-text" type="text"></td>
										<td><input name="wp_newsletter_message" id="wp_newsletter_message" value="Enter your message" class="wp_newsletter_option regular-text" type="text">
										</td>
									</tr>
						</tbody></table>
						
						<h3><?php _e('Checkbox', 'nlp'); ?></h3>
						<table class="wp_newsletter-form-table-noborder">
						<tbody><tr>
							<th></th>
							<td><!--<td-->
							</td><td><?php _e('Must checked', 'nlp'); ?></td>
							<td><?php _e('Field name', 'nlp'); ?></td>
							<td><?php _e('Caption', 'nlp'); ?></td>
						</tr>
						<tr id="wp_newsletter_design-terms">
						<th><?php _e('Terms of Service', 'nlp'); ?></th>
						<td><label class="wp_newsletter-switch wp_newsletter-switch-small "><input name="wp_newsletter_showterms" id="wp_newsletter_showterms" class="wp_newsletter_option" value="1" type="checkbox"><span class="wp_newsletter-switch-label-checked"><?php _e('Show', 'nlp'); ?></span></label></td>
						<td><label class="wp_newsletter-switch wp_newsletter-switch-small wp_newsletter-switch-checked"><input name="wp_newsletter_termsrequired" id="wp_newsletter_termsrequired" class="wp_newsletter_option" value="1" checked="" type="checkbox"><span class="wp_newsletter-switch-label-checked"><?php _e('Yes', 'nlp'); ?></span></label></td>
						<td><input name="wp_newsletter_termsfieldname" id="wp_newsletter_termsfieldname" value="TERMS" class="wp_newsletter_option medium-text" type="text"></td>
						<td><input name="wp_newsletter_terms" id="wp_newsletter_terms" value="I agree to the Terms of Service" class="wp_newsletter_option regular-text" type="text">
						</td></tr>
						</tbody></table>						
						
						<h3><?php _e('Buttons', 'nlp'); ?></h3>			
						<table class="wp_newsletter-form-table-noborder">
						
									<tbody><tr id="wp_newsletter_design-action">
										<th><?php _e('Action', 'nlp'); ?>:</th>
										<td><label class="wp_newsletter-switch wp_newsletter-switch-small wp_newsletter-switch-checked"><input name="wp_newsletter_showaction" id="wp_newsletter_showaction" class="wp_newsletter_option" value="1" checked="" type="checkbox"><span class="wp_newsletter-switch-label-checked"><?php _e('Show', 'nlp'); ?></span></label></td>
										<td><input name="wp_newsletter_action" id="wp_newsletter_action" value="Subscribe Now" class="wp_newsletter_option regular-text" type="text">
										</td>
									</tr>
									
																		<tr id="wp_newsletter_design-cancel">
										<th><?php _e('Cancel', 'nlp'); ?>:</th>
										<td><label class="wp_newsletter-switch wp_newsletter-switch-small wp_newsletter-switch-checked"><input name="wp_newsletter_showcancel" id="wp_newsletter_showcancel" class="wp_newsletter_option" value="1" checked="" type="checkbox"><span class="wp_newsletter-switch-label-checked"><?php _e('Show', 'nlp'); ?></span></label></td>
										<td><input name="wp_newsletter_cancel" id="wp_newsletter_cancel" value="No Thanks" class="wp_newsletter_option regular-text" type="text"><div>	
										</div>
										</td>
									</tr>
																		
								</tbody></table>
</div>
<?php /* end form*/?>
</div>


<div id='tab2'>
<div class="some_rules action">
<?php /* Action Handler */ ?>
				
					<h3><?php _e('Behaviour After Clicking Action Button', 'nlp'); ?></h3>
					
					<div class="wp_newsletter-tab-row">
					<label><input name="wp_newsletter_afteraction" value="close" class="wp_newsletter_option" type="radio" checked="checked"> <?php _e('Close the popup silently', 'nlp'); ?></label>
					</div>
					<div class="wp_newsletter-tab-row">
					<label><input name="wp_newsletter_afteraction" value="redirect" class="wp_newsletter_option" type="radio"> <?php _e('Redirect to the URL', 'nlp'); ?>: </label>
					<input name="wp_newsletter_redirecturl" id="wp_newsletter_redirecturl" value="" class="wp_newsletter_option regular-text" type="text">
					</div>
					<div class="wp_newsletter-tab-row">
					<label><input name="wp_newsletter_afteraction" value="display" class="wp_newsletter_option" type="radio"> <?php _e('Display a message and a button inside the popup', 'nlp'); ?>:</label>
					<div class="wp_newsletter-tab-row-description">
					<textarea name="wp_newsletter_afteractionmessage" type="text" id="wp_newsletter_afteractionmessage" class="wp_newsletter_option large-text"><?php _e('Thanks for signing up. You must confirm your email address before we can send you. Please check your email and follow the instructions.', 'nlp'); ?></textarea>
					</div>
					<div class="wp_newsletter-tab-row-description">
					<?php _e('Button caption', 'nlp'); ?>: <input name="wp_newsletter_afteractionbutton" id="wp_newsletter_afteractionbutton" value="Close" class="wp_newsletter_option regular-text" type="text">
					</div>					
					</div>
					
					<h3><?php _e('Error Messages', 'nlp'); ?></h3>
					<table class="wp_newsletter-form-table-noborder error-table">
					<tbody><tr>
					<td><?php _e('Invalid Email address', 'nlp'); ?>:</td>
					<td><input name="wp_newsletter_invalidemailmessage" id="wp_newsletter_invalidemailmessage" class="wp_newsletter_option large-text" value="The email address is invalid." type="text"></td>
					</tr>
					<tr>
					<td><?php _e('Required field missing', 'nlp'); ?>:</td>
					<td><input name="wp_newsletter_fieldmissingmessage" id="wp_newsletter_fieldmissingmessage" class="wp_newsletter_option large-text" value="Please fill in the required field." type="text"></td>
					</tr>
					<tr>
					<td><?php _e('Terms field not checked', 'nlp'); ?>:</td>
					<td><input name="wp_newsletter_termsnotcheckedmessage" id="wp_newsletter_termsnotcheckedmessage" class="wp_newsletter_option large-text" value="You must agree to our Terms of Service." type="text"></td>
					</tr>
					<tr>
					<td><?php _e('Already subscribed', 'nlp'); ?>:</td>
					<td><input name="wp_newsletter_alreadysubscribedmessage" id="wp_newsletter_alreadysubscribedmessage" class="wp_newsletter_option large-text" value="The email address has already subscribed." type="text"></td>
					</tr>
					<tr>
					<td><?php _e('General error', 'nlp'); ?>:</td>
					<td><input name="wp_newsletter_generalerrormessage" id="wp_newsletter_generalerrormessage" class="wp_newsletter_option large-text" value="Something went wrong. Please try again later." type="text"></td>
					</tr>
					</tbody></table>
<?php /* End Action Handler*/ ?>
</div>
</div>

<div id="tab3">
<div class="some_rules email-service">
<h3><?php _e('Select an Email Subscription Service', 'nlp'); ?></h3>
<select name="wp_newsletter_subscription" id="wp_newsletter_subscription" class="wp_newsletter-popup-option">
						<option value="noservice" selected=""><?php _e('No Service', 'nlp'); ?></option>
                        <option value="activecampaign"><?php _e('Active Campaign', 'nlp'); ?></option> 
                        <option value="getresponse"><?php _e('GetResponse', 'nlp'); ?></option>
                        <option value="constantcontact"><?php _e('Constant Contact', 'nlp'); ?></option>
						<option value="mailchimp"><?php _e('MailChimp', 'nlp'); ?></option>
						<option value="mailpoet"><?php _e('MailPoet', 'nlp'); ?></option>
</select>
<label style="margin-left:24px;"><input name="wp_newsletter_savetolocal" id="wp_newsletter_savetolocal" value="1" class="wp_newsletter-option" type="checkbox"> <?php _e('Save to local database', 'nlp'); ?></label>

<div id="form_loading" style="display:none"><img src="<?php echo plugins_url('images/loading.gif', __FILE__);?>" /></div>
<div class="wp_newsletter_service_response" id="wp_newsletter_service_response"></div>                                     
</div>
</div>
<input type="hidden" name="newsletter_display_type" value="<?php echo sanitize_text_field($_GET['type']);?>" />
<p class="submit"><input name="nl_submit" id="nl_submit" class="button button-primary" value="Save Changes" type="submit"></p>
</form>
</div>
