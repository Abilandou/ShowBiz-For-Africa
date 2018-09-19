<?php if ( ! defined( 'ABSPATH' ) ) exit;
if(!isset($_GET['id']) && empty($_GET['id']))
{
	$this->redirect('?page=wp_newsletter_add_new');
	die;
}
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
		$formData[$key] = stripslashes(wp_filter_post_kses(addslashes($val)));
	}
	$encodedData = json_encode($formData);
    $updateData = $this->updateData($defaultName, $encodedData, $current_time, $cuid, $status, intval($_GET['id']));	
	if($updateData)
	{
	$this->redirect('admin.php?page=wp_newsletter_edit_item&id='.$_GET['id'].'&msg=2');
	}
}
$opt = $this->decoded_data(intval($_GET['id']), $cuid);
$title = $wpdb->get_row("select * from  ".$tbl." where id = '".$_GET['id']."' AND authorid = '".$cuid."'"); 

//print_r($opt);
?>	
<script>
var rid = "<?php echo intval($_GET['id'])?>";
</script>
<div class="wrap">
<?php $this->load_help_desk();?>
<h2><?php _e('Edit Popup', 'nlp'); ?></h2>
<?php if(isset($_GET['msg'])) { $this->flash($_GET['msg']); } ?>
<form action="" method="post" name="nl_form">
<?php wp_nonce_field( 'nlp_action', 'nlp_nonce_field' ); ?>
<ul class='tabs'>
  <li><a href='#tab1'><?php _e('Design Rules', 'nlp'); ?></a></li>
  <li><a href='#tab2'><?php _e('Action', 'nlp'); ?></a></li>
  <li><a href='#tab3'><?php _e('Email Service', 'nlp'); ?></a></li>
  <li><label class="switch"><input type="checkbox" value="publish" <?php echo($title->status == 'publish') ? 'checked="checked"' : '' ?> name="newsletter_status" id="newsletter_status" /><div class="slider round"></div></label> <?php _e('Publish', 'nlp'); ?></li>
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
<?php $newsletter_type =  $opt['newsletter_display_type']; ?>
<th><?php _e('Name (not displayed on the PopUp)', 'nlp'); ?>:</th>
<td><input name="wp_newsletter_popupname" id="wp_newsletter_popupname" value="<?php echo $title->name;?>" class="wp_newsletter_option regular-text" type="text"></td>
</tr>
								 <?php
									if($opt['newsletter_display_type'] == 'bar'){ ?>
									<tr style="display:table-row;">
									<th>Notification bar position:</th>
										<td>
										<label>
										<?php if(!empty($opt['wp_newsletter-popup-barposition'])):?>
										<select name="wp_newsletter-popup-barposition" id="wp_newsletter-popup-barposition" class="wp_newsletter-popup-option"><option value="bottom" <?php echo $opt['wp_newsletter-popup-barposition'] =='bottom'  ? 'selected=selected' : ''; ?>>Bottom</option>
										<option value="top" <?php echo  $opt['wp_newsletter-popup-barposition'] =='top'  ? 'selected=selected' : ''; ?>>Top</option>
										</select>
										<?php endif; ?></label>
										<br><label><input type="checkbox" name="wp_newsletter-popup-barfloat" id="wp_newsletter-popup-barfloat" value="1" class="wp_newsletter-popup-option"> Float on top of the web page</label>
									</td>
									</tr>	
								<?php	} else { ?>
                               <tr style="display:table-row;">
										<th><?php _e('Width (percent)', 'nlp'); ?>:</th>
										<td>
										<label><input name="wp_newsletter_width" id="wp_newsletter_width" value="<?php echo $opt['wp_newsletter_width']; ?>" class="wp_newsletter_option small-text" type="number"></label>
										</td>
									</tr>
									
									<tr style="display:table-row;">
										<th><?php _e('Maximum width (px)', 'nlp'); ?>:</th>
										<td>
										<label><input name="wp_newsletter_maxwidth" id="wp_newsletter_maxwidth" value="<?php echo $opt['wp_newsletter_maxwidth']; ?>" class="wp_newsletter_option small-text" type="number"></label>
										</td>
									</tr>
								<?php } ?>
									<tr style="display:table-row;">
										<th><?php _e('Margin on top and bottom of the Popup (px)', 'nlp'); ?>:</th>
										<td>
										<label><input name="wp_newsletter_mintopbottommargin" id="wp_newsletter_mintopbottommargin" value="<?php echo $opt['wp_newsletter_mintopbottommargin']; ?>" class="wp_newsletter_option small-text" type="number"></label>
										</td>
									</tr>
									<?php if($newsletter_type == 'slidein'):?>
									<tr style="display:table-row;">
									<th><?php _e('Slide in position', 'nlp'); ?>:</th>
										<td>
										<label><select name="wp_newsletter_slideinposition" id="wp_newsletter_slideinposition" class="wp_newsletter_option">
										<option value="bottom-right" <?php echo ($opt['wp_newsletter_slideinposition'] == 'bottom-right' ) ? 'selected="selected"' : '' ?>><?php _e('Bottom Right', 'nlp'); ?></option>
										<option value="bottom-left" <?php echo ($opt['wp_newsletter_slideinposition'] == 'bottom-left' ) ? 'selected="selected"' : '' ?>><?php _e('Bottom Left', 'nlp'); ?></option>
										<option value="bottom" <?php echo ($opt['wp_newsletter_slideinposition'] == 'bottom' ) ? 'selected="selected"' : '' ?>><?php _e('Bottom', 'nlp'); ?></option>
										</select></label>
									</td>
									</tr>	
									<?php endif; 
									if($newsletter_type == 'lightbox' || $newsletter_type == 'popup' || $newsletter_type == 'popup2' || $newsletter_type == 'popup3'  || $newsletter_type == 'popup4' || $newsletter_type == 'popup5' || $newsletter_type == 'popup6' || $newsletter_type == 'popup7' || $newsletter_type == 'popup8'):
									?>
									<tr style="display:table-row;">
										<th><?php _e('Fullscreen mode', 'nlp'); ?>:</th>
										<td>
										<label><input type="checkbox" name="wp_newsletter-popup-fullscreen" id="wp_newsletter-popup-fullscreen" value="1" <?php if(isset($opt['wp_newsletter-popup-fullscreen'])&& $opt['wp_newsletter-popup-fullscreen'] == '1'){ echo "checked = checked"; } ?> class="wp_newsletter-popup-option"><?php _e('Go to full screen mode when the screen width is less than (px)', 'nlp'); ?></label>
										<label><input name="wp_newsletter-popup-fullscreenwidth" type="number" id="wp_newsletter-popup-fullscreenwidth" value="<?php echo $opt['wp_newsletter-popup-fullscreenwidth']; ?>" class="wp_newsletter-popup-option small-text"></label>
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
									<?php if($newsletter_type == 'slidein' || ($newsletter_type == 'bar') ||($newsletter_type == 'video') ||($newsletter_type == 'popup3') ||($newsletter_type == 'popup6')):?>
									<tr id="wp_newsletter_design-logo" style="display: table-row;">
										<th><?php _e('Logo image URL', 'nlp'); ?>:</th>
										<td></td><td></td>
										<td><input name="wp_newsletter_logo" id="wp_newsletter_logo" value="<?php echo $opt['wp_newsletter_logo']; ?>" class="wp_newsletter_contentoption wp_newsletter_option regular-text" type="text">
										<input class="button wp_newsletter_select-image" data-textid="wp_newsletter_logo" id="wp_newsletter_logo-select-image" value="Upload" type="button" onclick="open_media_uploader_image('wp_newsletter_logo')">
										<span data-textid="wp_newsletter_logo" class="wp_newsletter_clear-image" onclick="clear_uploader_image('wp_newsletter_logo')"><?php _e('Clear', 'nlp'); ?></span>
										</td>
									</tr>
									<?php endif;
									 if($newsletter_type ==  'video'): ?>
									<tr id="wp_newsletter-popup-design-video" style="display: table-row;">
										<th>Video iFrame URL:</th>
										<td></td><td></td>
										<td><input name="wp_newsletter-popup-video" type="text" id="wp_newsletter-popup-video" value="<?php echo $opt['wp_newsletter-popup-video']; ?>" class="wp_newsletter-popup-contentoption wp_newsletter-popup-option large-text">
										<p><label><input type="checkbox" name="wp_newsletter-popup-videoautoplay" id="wp_newsletter-popup-videoautoplay" value="1" class="wp_newsletter-popup-option" <?php  if(isset($opt['wp_newsletter-popup-videoautoplay'])&& $opt['wp_newsletter-popup-videoautoplay'] == 1) { echo  "checked=checked" ; }?>> Auto play video (do not work on mobile and tablets)</label></p>
										<p><label><input type="checkbox" name="wp_newsletter-popup-videoautoclose" id="wp_newsletter-popup-videoautoclose" value="1" class="wp_newsletter-popup-option" <?php  if(isset($opt['wp_newsletter-popup-videoautoclose'])&& $opt['wp_newsletter-popup-videoautoclose'] == 1) { echo "checked=checked" ; }?>> Auto close the popup after the video has finished </label></p>
										<p><a href="https://www.wonderplugin.com/wp_newsletter-popup/youtube-lightbox-popup/" target="_blank">Tutorial: How to play YouTube, Vimeo and other iFrame videos</a></p>
										</td>
									</tr>
                                    <?php endif;?>
									<tr id="wp_newsletter_design-heading" style="display: table-row;">
										<th><?php _e('Heading (HTML allowed)', 'nlp'); ?>:</th>
                                        <td></td>
                                        <td><input type="text" name="wp_newsletter_heading_color" value="<?php echo $opt['wp_newsletter_heading_color']; ?>" class="nl-color-picker" ></td>
										<td><textarea name="wp_newsletter_heading" id="wp_newsletter_heading" class="wp_newsletter_contentoption wp_newsletter_option large-text" ><?php echo $opt['wp_newsletter_heading']; ?></textarea></td>
									</tr>
									<?php  /*if($newsletter_type == 'slidein' || ($newsletter_type == 'video') ||($newsletter_type == 'popup3') ||($newsletter_type == 'popup6')|| ($newsletter_type == 'lightbox')|| ($newsletter_type == 'popup') || ($newsletter_type == 'popup2')||($newsletter_type == 'popup4') ||($newsletter_type == 'popup5')||($newsletter_type == 'popup7')||($newsletter_type == 'popup8')):*/?>
									<tr id="wp_newsletter_design-description" style="display: table-row;">
										<th><?php _e('Description (HTML allowed)', 'nlp'); ?>:</th>
										<td></td><td><input type="text" name="wp_newsletter_description_color" value="<?php if(isset($opt['wp_newsletter_description_color'])&& !empty($opt['wp_newsletter_description_color'])){echo $opt['wp_newsletter_description_color'];} ?>" class="nl-color-picker" ></td>
										<td><textarea name="wp_newsletter_description" id="wp_newsletter_description" class="wp_newsletter_contentoption wp_newsletter_option large-text" rows="2"><?php if(isset($opt['wp_newsletter_description'])&& !empty($opt['wp_newsletter_description'])){echo $opt['wp_newsletter_description'];} ?></textarea></td>
									</tr>
									<?php //endif;?>
									<tr id="wp_newsletter_design-privacy" style="display: table-row;">
										<th><?php _e('Privacy (HTML allowed)', 'nlp'); ?>:</th>
										<td>
                                         <label class="switch"><input name="wp_newsletter_privacy_show" id="wp_newsletter_privacy_show" class="wp_newsletter_option" value="1" <?php echo (isset($opt['wp_newsletter_privacy_show'])&& $opt['wp_newsletter_privacy_show'] == 1) ? 'checked="checked"' : '' ?> type="checkbox"><div class="slider round"></div></label>
										</td>
										<td>
										<input type="text" name="wp_newsletter_privacy_color" value="<?php echo $opt['wp_newsletter_privacy_color']; ?>" class="nl-color-picker" >
                                        </td>
										<td><textarea name="wp_newsletter_privacy" class="wp_newsletter_contentoption wp_newsletter_option large-text" id="wp_newsletter_privacy"><?php echo $opt['wp_newsletter_privacy']; ?></textarea></td>
									</tr>
									
									<tr id="wp_newsletter_design-ribbon">
										<th><?php _e('Ribbon image URL', 'nlp'); ?>:</th>
										<td><label class="switch"><input name="wp_newsletter_ribbon_show" id="wp_newsletter_ribbon_show" class="wp_newsletter_option" value="1" <?php echo (isset($opt['wp_newsletter_ribbon_show'])&& $opt['wp_newsletter_ribbon_show'] == '1') ? 'checked="checked"' : '';?> type="checkbox"><div class="slider round"></div></label></td>
										<td></td><td><input name="wp_newsletter_ribbon" id="wp_newsletter_ribbon" value="<?php echo $opt['wp_newsletter_ribbon']; ?>" class="wp_newsletter_contentoption wp_newsletter_option regular-text" type="text">
										<input class="button wp_newsletter_select-image" data-textid="wp_newsletter_ribbon" id="wp_newsletter_ribbon-select-image" value="Upload" type="button" onclick="open_media_uploader_image('wp_newsletter_ribbon')">
										<span data-textid="wp_newsletter_ribbon" class="wp_newsletter_clear-image" onclick="clear_uploader_image('wp_newsletter_ribbon')"><?php _e('Clear', 'nlp'); ?></span>
										<br><label><?php _e('Position CSS', 'nlp'); ?>: <input name="wp_newsletter_ribboncss" id="wp_newsletter_ribboncss" value="<?php echo $opt['wp_newsletter_ribboncss']; ?>" class="wp_newsletter_option medium-text" type="text"></label>
										</td>
									</tr>
									
									<tr id="wp_newsletter_design-closetip">
										<th><?php _e('Tip on close', 'nlp'); ?>:</th>
										<td>
                                        <label class="switch"><input name="wp_newsletter_closetip_show" id="wp_newsletter_closetip_show" class="wp_newsletter_option" value="1" <?php echo isset($opt['wp_newsletter_closetip_show'])&&($opt['wp_newsletter_closetip_show'] == '1') ? 'checked="checked"' : '';?> type="checkbox"><div class="slider round"></div></label></td>
										<td>
										</td>
                                        <td><input name="wp_newsletter_closetip" id="wp_newsletter_closetip" value="<?php echo stripslashes($opt['wp_newsletter_closetip']); ?>" class="wp_newsletter_contentoption wp_newsletter_option large-text" type="text"></td>
									</tr>
								<?php if($newsletter_type == 'slidein'):?>
									<tr id="wp_newsletter_design-hidebar" style="display:table-row;">
										<th><?php _e('Notification bar when the popup is hidden', 'nlp'); ?></th>
                                        <td></td>
                                        <td></td>
										<td>
										<input name="wp_newsletter_hidebartitle" id="wp_newsletter_hidebartitle" value="<?php echo $opt['wp_newsletter_hidebartitle']; ?>" class="wp_newsletter_contentoption wp_newsletter_option large-text" type="text">
										</td>
									</tr>
                                    
                                   	<tr id="wp_newsletter_design-hidebar-bck" style="display:table-row;">
										<th><?php _e('Background Color', 'nlp'); ?>:</th>
                                        <td><input type="text" name="wp_newsletter_hidebar_bg" value="<?php echo $opt['wp_newsletter_hidebar_bg'];?>" class="nl-color-picker" ></td>
                                        <th><?php _e('Text Color', 'nlp'); ?>:</th>
										<td><input type="text" name="wp_newsletter_hidebar_txt_color" value="<?php echo $opt['wp_newsletter_hidebar_txt_color'];?>" class="nl-color-picker" ></td>
									</tr> 
								<?php endif; ?>
								</tbody></table>
								</div>
								<?php /* content end */ ?>

								<?php /* Background */ ?>
								<div id="background">
								<table class="wp_newsletter-form-table-noborder">
								
									<tbody>
									<tr>
										<th><?php _e('Border radius (px)', 'nlp'); ?>:</th>
										<td><label><input name="wp_newsletter_radius" id="wp_newsletter_radius" value="<?php echo $opt['wp_newsletter_radius']?>" class="wp_newsletter_option small-text" type="number">
										<?php _e('Shadow', 'nlp'); ?>: <input name="wp_newsletter_bordershadow" id="wp_newsletter_bordershadow" value="<?php echo $opt['wp_newsletter_bordershadow']?>" class="wp_newsletter_option regular-text" type="text">
										</label></td>
									</tr>
									<?php  if($newsletter_type == 'lightbox' || $newsletter_type == 'popup' || $newsletter_type == 'popup2' || $newsletter_type == 'popup3' || $newsletter_type == 'popup4' || $newsletter_type == 'popup5' || $newsletter_type == 'popup6' || $newsletter_type == 'popup7' || $newsletter_type == 'popup8') : ?>
									<tr id="wp_newsletter-popup-design-overlaycolor" style="display:table-row;">
										<th><?php _e('Overlay background', 'nlp'); ?>:</th>
										<td><label class="withcolorpicker">
										
									<label>
									<input type="text" name="wp_newsletter_overlaycolor" value="<?php if(!empty($opt['wp_newsletter_overlaycolor'])){ echo  $opt['wp_newsletter_overlaycolor']; }else { ?> #333333 <?php } ?>" class="nl-color-picker" ></label><?php _e('Opacity', 'nlp'); ?>: <input name="wp_newsletter-popup-overlayopacity" type="number" id="wp_newsletter-popup-overlayopacity" value="<?php if(!empty($opt['wp_newsletter-popup-overlayopacity'])){ echo  $opt['wp_newsletter-popup-overlayopacity']; }else { ?> 0.8 <?php } ?>" step="0.1" min="0" max="1" class="wp_newsletter-popup-option small-text"></label><label><input type="checkbox" name="wp_newsletter-popup-overlayclose" id="wp_newsletter-popup-overlayclose" value="1" <?php 
									if(isset($opt['wp_newsletter-popup-overlayclose'])&& $opt['wp_newsletter-popup-overlayclose'] == '1'){ echo "checked = checked"; } ?> class="wp_newsletter-popup-option"><?php _e(' Close popup when clicking on the overlay', 'nlp'); ?></label></td>
									</tr>
									<?php endif; ?>
									<tr id="wp_newsletter_design-close">
										<th><?php _e('Close button', 'nlp'); ?>:</th>
										<td>
                                        <label class="wp_newsletter-switch wp_newsletter-switch-small wp_newsletter-switch-checked"><input name="wp_newsletter_close_btn_show" id="wp_newsletter_close_btn_show" class="wp_newsletter_option" value="1" <?php echo($opt['wp_newsletter_close_btn_show'] == '1')? 'checked="checked"' : '' ?> type="checkbox"><span class="wp_newsletter-switch-label-checked">Show</span></label> | 
                                        <?php _e('Hover Color', 'nlp'); ?>: <input type="text" name="wp_newsletter_close_hover" value="<?php echo $opt['wp_newsletter_close_hover'];?>" class="nl-color-picker" > | 
                                        <?php _e('Background Color', 'nlp'); ?>: <input type="text" name="wp_newsletter_close_bg_color" value="<?php echo $opt['wp_newsletter_close_bg_color'];?>" class="nl-color-picker" >																				
										<br>
										<label><?php _e('Position', 'nlp'); ?>: <select name="wp_newsletter_closeposition" id="wp_newsletter_closeposition" class="wp_newsletter_option">
										  <option value="top-right-inside" <?php echo($opt['wp_newsletter_closeposition'] == 'top-right-inside')? 'selected="selected"' : '' ?>><?php _e('top-right-inside', 'nlp'); ?></option>
										  <option value="top-left-inside" <?php echo($opt['wp_newsletter_closeposition'] == 'top-left-inside')? 'selected="selected"' : '' ?>><?php _e('top-left-inside', 'nlp'); ?></option>
										  <option value="top-right-outside" <?php echo($opt['wp_newsletter_closeposition'] == 'top-right-outside')? 'selected="selected"' : '' ?>><?php _e('top-right-outside', 'nlp'); ?></option>
										  <option value="top-left-outside" <?php echo($opt['wp_newsletter_closeposition'] == 'top-left-outside')? 'selected="selected"' : '' ?>><?php _e('top-left-outside', 'nlp'); ?></option>
										</select></label>
										<label><input name="wp_newsletter_closeshowshadow" id="wp_newsletter_closeshowshadow" value="1"  class="wp_newsletter_option" type="checkbox" <?php echo($opt['wp_newsletter_closeshowshadow'] == '1')? 'checked="checked"' : '' ?>> Show shadow</label> 
										<input name="wp_newsletter_closeshadow" id="wp_newsletter_closeshadow" value="<?php echo $opt['wp_newsletter_closeshadow'];?>" class="wp_newsletter_option regular-text" type="text">
										</td>
									</tr>
									
									<tr id="wp_newsletter_design-backgroundcolor">
										<th><?php _e('Background color', 'nlp'); ?>:</th>
										<td><input type="text" name="wp_newsletter_backgroung_color" value="<?php echo $opt['wp_newsletter_backgroung_color'];?>" class="nl-color-picker" ></td>
									</tr>
									
									<tr id="wp_newsletter_design-backgroundimage">
										<th id="bg-align"><?php _e('Background image URL', 'nlp'); ?>:</th>
										<td><label><input name="wp_newsletter_backgroundimage" id="wp_newsletter_backgroundimage" value="<?php echo $opt['wp_newsletter_backgroundimage'];?>" class="wp_newsletter_option regular-text" type="text">
										<input class="button wp_newsletter_select-image" data-textid="wp_newsletter_backgroundimage" id="wp_newsletter_backgroundimage-select-image" value="Upload" type="button" onclick="open_media_uploader_image('wp_newsletter_backgroundimage')">
										<span data-textid="wp_newsletter_backgroundimage" class="wp_newsletter_clear-image" onclick="clear_uploader_image('wp_newsletter_backgroundimage')"><?php _e('Clear', 'nlp'); ?></span>
										</label><br>
										<label><?php _e('Repeat', 'nlp'); ?>: <select name="wp_newsletter_backgroundimagerepeat" id="wp_newsletter_backgroundimagerepeat" class="wp_newsletter_option">
										  <option value="repeat" <?php echo($opt['wp_newsletter_backgroundimagerepeat'] == 'repeat')? 'selected="selected"' : ''; ?>><?php _e('repeat', 'nlp'); ?></option>
										  <option value="no-repeat" <?php echo($opt['wp_newsletter_backgroundimagerepeat'] == 'no-repeat')? 'selected="selected"' : ''; ?>><?php _e('no-repeat', 'nlp'); ?></option>
										  <option value="repeat-x" <?php echo($opt['wp_newsletter_backgroundimagerepeat'] == 'repeat-x')? 'selected="selected"' : ''; ?>><?php _e('repeat-x', 'nlp'); ?></option>
										  <option value="repeat-y" <?php echo($opt['wp_newsletter_backgroundimagerepeat'] == 'repeat-y')? 'selected="selected"' : ''; ?>><?php _e('repeat-y', 'nlp'); ?></option>
										</select>
										<?php _e('Position', 'nlp'); ?>: <input name="wp_newsletter_backgroundimageposition" id="wp_newsletter_backgroundimageposition" value="<?php echo $opt['wp_newsletter_backgroundimageposition'];?>" class="wp_newsletter_option medium-text" type="text"></label>
										</td>
									</tr>
									
									<tr id="wp_newsletter_design-upperlower">
										<th><?php _e('Upper and lower', 'nlp'); ?>:</th>
										<td><?php _e('Upper Part Color', 'nlp'); ?> <input type="text" name="wp_newsletter_upper_part_color" value="<?php echo $opt['wp_newsletter_upper_part_color'];?>" class="nl-color-picker" > | 
                                        <?php _e('Bottom Part Color', 'nlp'); ?> <input type="text" name="wp_newsletter_bottom_part_color" value="<?php echo $opt['wp_newsletter_bottom_part_color'];?>" class="nl-color-picker" ></td>
									</tr>									
									
								</tbody></table>
</div>
<?php /* end background */ ?>

<?php /* Form */ ?>
<div id="form">							
<h3>Fields</h3>
								<table class="wp_newsletter-form-table-noborder">
									
									<tbody><tr>
										<th></th>
										<td ><!--<td-->
										</td><td class="td-heading"><?php _e('Size (px)', 'nlp'); ?></td>
										<td class="td-heading"><?php _e('Post field name', 'nlp'); ?></td>
										<td class="td-heading"><?php _e('Placeholder', 'nlp'); ?></td>
									</tr>
									
									<tr id="wp_newsletter_design-email">
										<th><?php _e('Email', 'nlp'); ?>:</th>
										<td><label class="wp_newsletter-switch wp_newsletter-switch-small wp_newsletter-switch-checked"><input name="wp_newsletter_showemail" id="wp_newsletter_showemail" class="wp_newsletter_option" value="1" <?php echo isset($opt['wp_newsletter_showemail'])&& ($opt['wp_newsletter_showemail'] == '1')? 'checked="checked"' : '' ?> type="checkbox"><span class="wp_newsletter-switch-label-checked"><?php _e('Show', 'nlp'); ?></span></label></td>
										<td><input name="wp_newsletter_emailinputwidth" id="wp_newsletter_emailinputwidth" value="<?php echo $opt['wp_newsletter_emailinputwidth'];?>" class="wp_newsletter_option small-text" type="number"></td>
										<td><input name="wp_newsletter_emailfieldname" id="wp_newsletter_emailfieldname" value="<?php echo $opt['wp_newsletter_emailfieldname'];?>" class="wp_newsletter_option medium-text" type="text"></td>
										<td><input name="wp_newsletter_email" id="wp_newsletter_email" value="<?php echo $opt['wp_newsletter_email'];?>" class="wp_newsletter_option regular-text" type="text">
										</td>
									</tr>
																		
									<tr id="wp_newsletter_design-name">
										<th><?php _e('Name', 'nlp'); ?>:</th>
										<td><label class="wp_newsletter-switch wp_newsletter-switch-small wp_newsletter-switch-checked"><input name="wp_newsletter_showname" id="wp_newsletter_showname" class="wp_newsletter_option" value="1" <?php echo isset($opt['wp_newsletter_showname'])&&($opt['wp_newsletter_showname'] == '1')? 'checked="checked"' : '' ?> type="checkbox"><span class="wp_newsletter-switch-label-checked"><?php _e('Show', 'nlp'); ?></span></label></td>
										<td><input name="wp_newsletter_nameinputwidth" id="wp_newsletter_nameinputwidth" value="<?php echo $opt['wp_newsletter_nameinputwidth'];?>" class="wp_newsletter_option small-text" type="number"></td>
										<td><input name="wp_newsletter_namefieldname" id="wp_newsletter_namefieldname" value="<?php echo $opt['wp_newsletter_namefieldname'];?>" class="wp_newsletter_option medium-text" type="text"></td>
										<td><input name="wp_newsletter_name" id="wp_newsletter_name" value="<?php echo $opt['wp_newsletter_name'];?>" class="wp_newsletter_option regular-text" type="text">
										</td>
									</tr>
									
									<tr id="wp_newsletter_design-firstname">
										<th><?php _e('First name', 'nlp'); ?>:</th>
										<td><label class="wp_newsletter-switch wp_newsletter-switch-small "><input name="wp_newsletter_showfirstname" id="wp_newsletter_showfirstname" class="wp_newsletter_option" value="1" type="checkbox" <?php echo isset($opt['wp_newsletter_showfirstname']) &&($opt['wp_newsletter_showfirstname'] == '1')? 'checked="checked"' : '' ?>><span class="wp_newsletter-switch-label-checked"><?php _e('Show', 'nlp'); ?></span></label></td>
										<td><input name="wp_newsletter_firstnameinputwidth" id="wp_newsletter_firstnameinputwidth" value="<?php echo $opt['wp_newsletter_firstnameinputwidth'];?>" class="wp_newsletter_option small-text" type="number"></td>
										<td><input name="wp_newsletter_firstnamefieldname" id="wp_newsletter_firstnamefieldname" value="<?php echo $opt['wp_newsletter_firstnamefieldname'];?>" class="wp_newsletter_option medium-text" type="text"></td>
										<td><input name="wp_newsletter_firstname" id="wp_newsletter_firstname" value="<?php echo $opt['wp_newsletter_firstname'];?>" class="wp_newsletter_option regular-text" type="text">
										</td>
									</tr>
																
									<tr id="wp_newsletter_design-lastname">
										<th><?php _e('Last name', 'nlp'); ?>:</th>
										<td><label class="wp_newsletter-switch wp_newsletter-switch-small "><input name="wp_newsletter_showlastname" id="wp_newsletter_showlastname" class="wp_newsletter_option" value="1" type="checkbox" <?php echo isset($opt['wp_newsletter_showlastname'])&&($opt['wp_newsletter_showlastname'] == '1')? 'checked="checked"' : '' ?>><span class="wp_newsletter-switch-label-checked"><?php _e('Show', 'nlp'); ?></span></label></td>
										<td><input name="wp_newsletter_lastnameinputwidth" id="wp_newsletter_lastnameinputwidth" value="<?php echo $opt['wp_newsletter_lastnameinputwidth'];?>" class="wp_newsletter_option small-text" type="number"></td>
										<td><input name="wp_newsletter_lastnamefieldname" id="wp_newsletter_lastnamefieldname" value="<?php echo $opt['wp_newsletter_lastnamefieldname'];?>" class="wp_newsletter_option medium-text" type="text"></td>
										<td><input name="wp_newsletter_lastname" id="wp_newsletter_lastname" value="<?php echo $opt['wp_newsletter_lastname'];?>" class="wp_newsletter_option regular-text" type="text">
										</td>
									</tr>
									
									<tr id="wp_newsletter_design-phone">
										<th><?php _e('Phone', 'nlp'); ?>:</th>
					<td><label class="wp_newsletter-switch wp_newsletter-switch-small "><input name="wp_newsletter_showphone" id="wp_newsletter_showphone" class="wp_newsletter_option" value="1" type="checkbox" <?php echo isset($opt['wp_newsletter_showphone'])&& ($opt['wp_newsletter_showphone'] == '1')? 'checked="checked"' : '' ?>><span class="wp_newsletter-switch-label-checked"><?php _e('Show', 'nlp'); ?></span></label></td>
										<td><input name="wp_newsletter_phoneinputwidth" id="wp_newsletter_phoneinputwidth" value="<?php echo $opt['wp_newsletter_phoneinputwidth'];?>" class="wp_newsletter_option small-text" type="number"></td>
										<td><input name="wp_newsletter_phonefieldname" id="wp_newsletter_phonefieldname" value="<?php echo $opt['wp_newsletter_phonefieldname'];?>" class="wp_newsletter_option medium-text" type="text"></td>
										<td><input name="wp_newsletter_phone" id="wp_newsletter_phone" value="<?php echo $opt['wp_newsletter_phone'];?>" class="wp_newsletter_option regular-text" type="text">
										</td>
									</tr>
									
									<tr id="wp_newsletter_design-company">
										<th><?php _e('Company name', 'nlp'); ?>:</th>
										<td><label class="wp_newsletter-switch wp_newsletter-switch-small "><input name="wp_newsletter_showcompany" id="wp_newsletter_showcompany" class="wp_newsletter_option" value="1" type="checkbox" <?php echo isset($opt['wp_newsletter_showcompany'])&& ($opt['wp_newsletter_showcompany'] == '1')? 'checked="checked"' : '' ?>><span class="wp_newsletter-switch-label-checked"><?php _e('Show', 'nlp'); ?></span></label></td>
										<td><input name="wp_newsletter_companyinputwidth" id="wp_newsletter_companyinputwidth" value="<?php echo $opt['wp_newsletter_companyinputwidth'];?>" class="wp_newsletter_option small-text" type="number"></td>
										<td><input name="wp_newsletter_companyfieldname" id="wp_newsletter_companyfieldname" value="<?php echo $opt['wp_newsletter_companyfieldname'];?>" class="wp_newsletter_option medium-text" type="text"></td>
										<td><input name="wp_newsletter_company" id="wp_newsletter_company" value="<?php echo $opt['wp_newsletter_company'];?>" class="wp_newsletter_option regular-text" type="text">
										</td>
									</tr>
									
									<tr id="wp_newsletter_design-zip">
										<th><?php _e('Zip code', 'nlp'); ?>:</th>
										<td><label class="wp_newsletter-switch wp_newsletter-switch-small "><input name="wp_newsletter_showzip" id="wp_newsletter_showzip" class="wp_newsletter_option" value="1" type="checkbox" <?php echo isset($opt['wp_newsletter_showzip'])&& ($opt['wp_newsletter_showzip'] == '1')? 'checked="checked"' : '' ?>><span class="wp_newsletter-switch-label-checked"><?php _e('Show', 'nlp'); ?></span></label></td>
										<td><input name="wp_newsletter_zipinputwidth" id="wp_newsletter_zipinputwidth" value="<?php echo $opt['wp_newsletter_zipinputwidth'];?>" class="wp_newsletter_option small-text" type="number"></td>
										<td><input name="wp_newsletter_zipfieldname" id="wp_newsletter_zipfieldname" value="<?php echo $opt['wp_newsletter_zipfieldname'];?>" class="wp_newsletter_option medium-text" type="text"></td>
										<td><input name="wp_newsletter_zip" id="wp_newsletter_zip" value="<?php echo $opt['wp_newsletter_zip'];?>" class="wp_newsletter_option regular-text" type="text">
										</td>
									</tr>
									
									<tr id="wp_newsletter_design-message">
										<th><?php _e('Message', 'nlp'); ?>:</th>
										<td><label class="wp_newsletter-switch wp_newsletter-switch-small "><input name="wp_newsletter_showmessage" id="wp_newsletter_showmessage" class="wp_newsletter_option" value="1" type="checkbox" <?php echo isset($opt['wp_newsletter_showmessage'])&& ($opt['wp_newsletter_showmessage'] == '1')? 'checked="checked"' : '' ?>><span class="wp_newsletter-switch-label-checked"><?php _e('Show', 'nlp'); ?></span></label></td>
										<td><input name="wp_newsletter_messageinputwidth" id="wp_newsletter_messageinputwidth" value="<?php echo $opt['wp_newsletter_messageinputwidth'];?>" class="wp_newsletter_option small-text" type="number">
										<?php _e('by', 'nlp'); ?> <input name="wp_newsletter_messageinputheight" id="wp_newsletter_messageinputheight" value="<?php echo $opt['wp_newsletter_messageinputheight'];?>" class="wp_newsletter_option small-text" type="number">
										</td>
										<td><input name="wp_newsletter_messagefieldname" id="wp_newsletter_messagefieldname" value="<?php echo $opt['wp_newsletter_messagefieldname'];?>" class="wp_newsletter_option medium-text" type="text"></td>
										<td><input name="wp_newsletter_message" id="wp_newsletter_message" value="<?php echo $opt['wp_newsletter_message'];?>" class="wp_newsletter_option regular-text" type="text">
										</td>
									</tr>
						</tbody></table>
						
						<h3><?php _e('Checkbox', 'nlp'); ?></h3>
						<table class="wp_newsletter-form-table-noborder">
						<tbody>
                        <tr>
                            <th></th>
							<td></td>
                            <td class="td-heading"><?php _e('Must checked', 'nlp'); ?></td>
							<td class="td-heading"><?php _e('Field name', 'nlp'); ?></td>
							<td class="td-heading"><?php _e('Caption', 'nlp'); ?></td>
						</tr>
						<tr id="wp_newsletter_design-terms">
						<th><?php _e('Terms of Service', 'nlp'); ?></th>
						<td><label class="wp_newsletter-switch wp_newsletter-switch-small "><input name="wp_newsletter_showterms" id="wp_newsletter_showterms" class="wp_newsletter_option" value="1" type="checkbox" <?php echo isset($opt['wp_newsletter_showterms'])&&($opt['wp_newsletter_showterms'] == '1')? 'checked="checked"' : '' ?>><span class="wp_newsletter-switch-label-checked"><?php _e('Show', 'nlp'); ?></span></label></td>
						<td><label class="wp_newsletter-switch wp_newsletter-switch-small wp_newsletter-switch-checked"><input name="wp_newsletter_termsrequired" id="wp_newsletter_termsrequired" class="wp_newsletter_option" value="1" <?php echo isset($opt['wp_newsletter_termsrequired'])&& ($opt['wp_newsletter_termsrequired'] == '1')? 'checked="checked"' : '' ?> type="checkbox"><span class="wp_newsletter-switch-label-checked"><?php _e('Yes', 'nlp'); ?></span></label></td>
						<td><input name="wp_newsletter_termsfieldname" id="wp_newsletter_termsfieldname" value="<?php echo $opt['wp_newsletter_termsfieldname'];?>" class="wp_newsletter_option medium-text" type="text"></td>
						<td><input name="wp_newsletter_terms" id="wp_newsletter_terms" value="<?php echo $opt['wp_newsletter_terms'];?>" class="wp_newsletter_option regular-text" type="text">
						</td></tr>
						</tbody></table>						
						
						<h3><?php _e('Buttons', 'nlp'); ?></h3>			
						<table class="wp_newsletter-form-table-noborder">
						
									<tbody><tr id="wp_newsletter_design-action">
										<th><?php _e('Action', 'nlp'); ?>:</th>
										<td><label class="wp_newsletter-switch wp_newsletter-switch-small wp_newsletter-switch-checked"><input name="wp_newsletter_showaction" id="wp_newsletter_showaction" class="wp_newsletter_option" value="1" <?php echo isset($opt['wp_newsletter_showaction']) && ($opt['wp_newsletter_showaction'] == '1')? 'checked="checked"' : '' ?> type="checkbox"><span class="wp_newsletter-switch-label-checked"><?php _e('Show', 'nlp'); ?></span></label></td>
										<td><input name="wp_newsletter_action" id="wp_newsletter_action" value="<?php echo $opt['wp_newsletter_action'];?>" class="wp_newsletter_option regular-text" type="text">
										</td>
									</tr>
									
										<tr id="wp_newsletter_design-cancel">
										<th><?php _e('Cancel', 'nlp'); ?>:</th>
										<td><label class="wp_newsletter-switch wp_newsletter-switch-small wp_newsletter-switch-checked"><input name="wp_newsletter_showcancel" id="wp_newsletter_showcancel" class="wp_newsletter_option" value="1" <?php echo($opt['wp_newsletter_showcancel'] == '1')? 'checked="checked"' : '' ?> type="checkbox"><span class="wp_newsletter-switch-label-checked"><?php _e('Show', 'nlp'); ?></span></label></td>
										<td><input name="wp_newsletter_cancel" id="wp_newsletter_cancel" value="<?php echo $opt['wp_newsletter_cancel'];?>" class="wp_newsletter_option regular-text" type="text"><div>	
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
					<h3><?php _e('Cancel', 'nlp'); ?><?php _e('Behaviour After Clicking Action Button', 'nlp'); ?></h3>
					
					<div class="wp_newsletter-tab-row">
					<label><input name="wp_newsletter_afteraction" value="close" class="wp_newsletter_option" type="radio" <?php echo ($opt['wp_newsletter_afteraction'] == 'close') ? 'checked="checked"' : '';?>> <?php _e('Close the popup silently', 'nlp'); ?></label>
					</div>
					<div class="wp_newsletter-tab-row">
					<label><input name="wp_newsletter_afteraction" value="redirect" class="wp_newsletter_option" type="radio" <?php echo ($opt['wp_newsletter_afteraction'] == 'redirect') ? 'checked="checked"' : '';?>> <?php _e('Redirect to the URL', 'nlp'); ?>: </label>
					<input name="wp_newsletter_redirecturl" id="wp_newsletter_redirecturl" value="<?php if(!empty($opt['wp_newsletter_redirecturl'])){echo trim($opt['wp_newsletter_redirecturl']);}?>" class="wp_newsletter_option regular-text" type="text">
					</div>
					<div class="wp_newsletter-tab-row">
					<label><input name="wp_newsletter_afteraction" value="display" class="wp_newsletter_option" type="radio" <?php echo ($opt['wp_newsletter_afteraction'] == 'display') ? 'checked="checked"' : '';?>> <?php _e('Display a message and a button inside the popup', 'nlp'); ?>:</label>
					<div class="wp_newsletter-tab-row-description">
					<textarea name="wp_newsletter_afteractionmessage" type="text" id="wp_newsletter_afteractionmessage" class="wp_newsletter_option large-text"><?php echo $opt['wp_newsletter_afteractionmessage']; ?></textarea>
					</div>
					<div class="wp_newsletter-tab-row-description">
					<?php _e('Button caption', 'nlp'); ?>: <input name="wp_newsletter_afteractionbutton" id="wp_newsletter_afteractionbutton" value="<?php echo $opt['wp_newsletter_afteractionbutton']; ?>" class="wp_newsletter_option regular-text" type="text">
					</div>					
					</div>
					
					<h3><?php _e('Error Messages', 'nlp'); ?></h3>
					<table class="wp_newsletter-form-table-noborder error-table">
					<tbody><tr>
					<td><?php _e('Invalid Email address', 'nlp'); ?>:</td>
					<td><input name="wp_newsletter_invalidemailmessage" id="wp_newsletter_invalidemailmessage" class="wp_newsletter_option large-text" value="<?php echo $opt['wp_newsletter_invalidemailmessage']; ?>" type="text"></td>
					</tr>
					<tr>
					<td><?php _e('Required field missing', 'nlp'); ?>:</td>
					<td><input name="wp_newsletter_fieldmissingmessage" id="wp_newsletter_fieldmissingmessage" class="wp_newsletter_option large-text" value="<?php echo $opt['wp_newsletter_fieldmissingmessage']; ?>" type="text"></td>
					</tr>
					<tr>
					<td><?php _e('Terms field not checked', 'nlp'); ?>:</td>
					<td><input name="wp_newsletter_termsnotcheckedmessage" id="wp_newsletter_termsnotcheckedmessage" class="wp_newsletter_option large-text" value="<?php echo $opt['wp_newsletter_termsnotcheckedmessage']; ?>" type="text"></td>
					</tr>
					<tr>
					<td><?php _e('Already subscribed', 'nlp'); ?>:</td>
					<td><input name="wp_newsletter_alreadysubscribedmessage" id="wp_newsletter_alreadysubscribedmessage" class="wp_newsletter_option large-text" value="<?php echo $opt['wp_newsletter_alreadysubscribedmessage']; ?>" type="text"></td>
					</tr>
					<tr>
					<td><?php _e('General error', 'nlp'); ?>:</td>
					<td><input name="wp_newsletter_generalerrormessage" id="wp_newsletter_generalerrormessage" class="wp_newsletter_option large-text" value="<?php echo $opt['wp_newsletter_generalerrormessage']; ?>" type="text"></td>
					</tr>
					</tbody></table>
<?php /* End Action Handler*/ ?>
</div>
</div>
<div id="tab3">
<div class="some_rules email-service">
<h3><?php _e('Select an Email Subscription Service', 'nlp'); ?></h3>
<select name="wp_newsletter_subscription" id="wp_newsletter_subscription" class="wp_newsletter-popup-option">
						<option value="noservice" <?php echo($opt['wp_newsletter_subscription'] == 'noservice' ? 'selected=""' : '');?>><?php _e('No Service', 'nlp'); ?></option>
                        <option value="activecampaign" <?php echo($opt['wp_newsletter_subscription'] == 'activecampaign' ? 'selected=""' : '');?>><?php _e('Active Campaign', 'nlp'); ?></option> 
                        <option value="getresponse" <?php echo($opt['wp_newsletter_subscription'] == 'getresponse' ? 'selected=""' : '');?>><?php _e('GetResponse', 'nlp'); ?></option>
                        <option value="constantcontact" <?php echo($opt['wp_newsletter_subscription'] == 'constantcontact' ? 'selected=""' : '');?>><?php _e('Constant Contact', 'nlp'); ?></option>
						<option value="mailchimp" <?php echo($opt['wp_newsletter_subscription'] == 'mailchimp' ? 'selected=""' : '');?>><?php _e('MailChimp', 'nlp'); ?></option>
						<option value="mailpoet" <?php echo($opt['wp_newsletter_subscription'] == 'mailpoet' ? 'selected=""' : '');?>><?php _e('MailPoet', 'nlp'); ?></option>
</select>
<label style="margin-left:24px;"><input name="wp_newsletter_savetolocal" id="wp_newsletter_savetolocal" value="1" class="wp_newsletter-option" type="checkbox" <?php echo isset($opt['wp_newsletter_savetolocal'])&& ($opt['wp_newsletter_savetolocal'] == '1')? 'checked="checked"' : '' ?> > <?php _e('Save to local database', 'nlp'); ?></label>

<div id="form_loading" style="display:none"><img src="<?php echo plugins_url('images/loading.gif', __FILE__);?>" /></div>
<div class="wp_newsletter_service_response" id="wp_newsletter_service_response"></div>                                     
</div>
</div>
<input type="hidden" name="newsletter_display_type" value="<?php echo sanitize_text_field($newsletter_type);?>" />
<p class="submit"><input name="nl_submit" id="nl_submit" class="button button-primary" value="Save Changes" type="submit"></p>
</form>
</div>