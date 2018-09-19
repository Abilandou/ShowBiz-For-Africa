<?php if ( ! defined( 'ABSPATH' ) ) exit; 
global $wpdb;
$tbl = $wpdb->prefix.'mk_newsletter_data';
$newsletters = $wpdb->get_results("select * from ".$tbl." where status = 'publish'");
$action = isset($_GET['action']) ? $_GET['action'] : '';
$cookieDelete = false;
if(!empty($newsletters) && is_array($newsletters ))
{ 
 foreach($newsletters  as $newsletter) {
	$decodedData = json_decode($newsletter->data, true);
	if(!isset($_COOKIE['newsletter_'.$newsletter->id])) { 
	?>
<script>
<?php if($decodedData['wp_newsletter_popup_show_on_window_close'] == 'enable') {?>
window.onbeforeunload = function(e){ 
 return jQuery(".subscribebox_<?php echo $newsletter->id;?>").fadeIn();
}
<?php } ?>
	<?php if(isset($decodedData['wp_newsletter_popup_time']) && !empty($decodedData['wp_newsletter_popup_time'])) { ?>
	setTimeout(function(){ jQuery(".subscribebox_<?php echo $newsletter->id;?>").fadeIn(); }, <?php echo ($decodedData['wp_newsletter_popup_time'] * 1000);?>);
	<?php } else { ?>
	jQuery(window).load(function(e) {
        jQuery(".subscribebox_<?php echo $newsletter->id;?>").fadeIn();
    });
	<?php } ?>
	jQuery('.nlp_show_oc_<?php echo $newsletter->id;?>').live('click', function(e) {
		jQuery(".subscribebox_<?php echo $newsletter->id;?>").fadeIn();
	});
	jQuery(document).ready(function(){
		 jQuery(".close_<?php echo $newsletter->id;?>").click(function(e){
			 e.preventDefault();
			jQuery(".subscribebox_<?php echo $newsletter->id;?>").fadeOut();
		});
	});
</script>
<style>
.thanksText{color:#fff;}
#main-div
{
	width:100%;
	margin: auto;
	padding: 25px;
	height: 100vh;
    left: 0;
    position: fixed;
    z-index: 9999;
    background: rgba(0, 0, 0, 0.8);
    padding: 0px 15px;
    box-sizing: border-box;
    -webkit-box-sizing: border-box;
	top: 0;
}
.webdesign-newsLetterSeven
{
	width:100%;
	max-width: 640px;
	padding: 10px 0 45px;
	border-radius: 1px;
	background:url(<?php echo plugins_url( 'images/popupbg6.jpg',__FILE__); ?>) no-repeat;
	background-size:cover;
	margin: 30px auto;
	position: relative;
	z-index:9999;
	margin-top: <?php echo $decodedData['wp_newsletter_mintopbottommargin'].''.'px';?>;
}
.webdesign-newsLetterSeven .left-div
{
	width: 20%;
	float:left;
	position: relative;
}
.webdesign-newsLetterSeven .right-div
{
	width: 80%;
	float:right;
	position: relative;
}
.webdesign-newsLetterSeven .blue-text
{
	color:#44d1d6;
	font-family: 'Playfair Display', serif;
	font-style: italic;
	font-weight: 900;
}
.webdesign-newsLetterSeven .right-div h1
{
	color: #fff;
	font-weight: 900;
	font-size: 42px;
	text-align: right;
	letter-spacing:2px;
	padding: 0;
	font-family: 'Playfair Display', serif;
	line-height: 55px;
	margin: 22px;
}
.webdesign-newsLetterSeven .toolicon
{
	display:inline-block;
	width: 159px;
	height: 77px;
	position: relative;
}
.toolicon img
{
	width:100%;
	max-width:159px;
	position: absolute;
	left: 0;
	top: 5px;
}
.webdesign-newsLetterSeven p
{
	text-align: right;
	line-height:25px;
	color:#fff;
	margin: 30px;
	font-size: 15px;
	font-family: 'Open Sans', sans-serif;
	font-weight: 100;
	letter-spacing: 1px;
}
.webdesign-newsLetterSeven .subscribeThreebutton
{
	font-family: 'Open Sans', sans-serif;
	background: transparent;
	color: #fff;
	padding: 22px;
	text-transform: uppercase;
	margin: 5px 0px;
	border: none;
	font-weight:600;
	letter-spacing: 0px;
	max-width: 200px;
	width: 100%;
	border: 2px solid #fff;
}
.webdesign-newsLetterSeven .email-textbox
{
	padding: 20px;
	width: 100%;
	max-width: 380px;
	margin: 5px 20px;
	box-sizing: border-box;
	font-family: 'Open Sans', sans-serif;
	font-size: 15px;
	box-shadow: none;
	border: none;
	display: inline-block;
    vertical-align: top;
}
.webdesign-newsLetterSeven form
{
	 margin: 0px 0 0;
}
input::-webkit-input-placeholder {
color: #808080 !important;
}
.webdesign-newsLetterSeven .close-button {
  position: absolute;
  right: -10px;
  top: -12px;
  width: 35px;
  height: 35px;
  border-radius: 100%;
  background: none;
  padding: 6px 0;
  z-index:99999;
}

.webdesign-newsLetterSeven .close-button:before, .close-button:after {
  position: absolute;
  left: -6px;
  content: ' ';
  height: 21px;
  width: 3px;
  background-color: #44d1d6;
  top: 22px;
}
.webdesign-newsLetterSeven .close-button:before {
  transform: rotate(45deg);
}
.webdesign-newsLetterSeven .close-button:after {
  transform: rotate(-45deg);
}
.webdesign-newsLetterSeven .terms-box{width:100%; display:block; text-align:center;}
.webdesign-newsLetterSeven form{padding:0px 7px 0px;}

@media screen and (max-width: 767px)
{
	.webdesign-newsLetterSeven .email-textbox{max-width:inherit !important;margin: 5px 0px !important;}
	.webdesign-newsLetterSeven .subscribeThreebutton{margin: 0px 0px;max-width:inherit !important;}
	.webdesign-newsLetterSeven .right-div{width:100%;}
	.webdesign-newsLetterSeven{padding:15px;}
	.webdesign-newsLetterSeven{padding:0;}
	.webdesign-newsLetterSeven .right-div h1{margin: 45px 20px 0 !important;padding: 0px; text-align:center;}
	.webdesign-newsLetterSeven p {margin: 5px 30px;padding: 0px;text-align: center;}
	.webdesign-newsLetterSeven .news-box{overflow-y:auto; max-height:80vh;}
	.webdesign-newsLetterSeven form{padding:15px;}
}
@media screen and (max-width: 600px)
{
	.webdesign-newsLetterSeven .left-div h1{font-size: 70px;}
	.toolicon img{max-width: 160px;left: -72px;top: 30px;}
	.webdesign-newsLetterSeven .toolicon{width: 110px;}
	.webdesign-newsLetterSeven p{font-size: 22px;}
}
@media screen and (max-width: 480px)
{
		.webdesign-newsLetterSeven p{ font-size:19px;}
		.webdesign-newsLetterSeven{ padding:0px;}
		.webdesign-newsLetterSeven .email-textbox{margin: 30px 0px 0;max-width:inherit;}
		.webdesign-newsLetterSeven .subscribeThreebutton{margin: 8px 0px;}
}
@media screen and (max-width:320px)
{
	
	.webdesign-newsLetterSeven .right-div h1{ font-size:50px;}
}
.error_container {
    text-align: center;
    color: #ff0000;
	width: 100%;
    display: inline-block;
}
.error p {
    color: #ff0000;
}
.ribbon{
	background:url(<?php echo $decodedData['wp_newsletter_ribbon']; ?>) no-repeat;
	position:absolute;
	top: -8px;
	left: -8px;
	z-index:99999;
}
.privacy-text {
    text-align: center;
	
}
.subscribe-box-afteractionmessage {
    text-align: center;
    color: #fff;
}
.subscribe-box-cancel .thanksText {
    margin: 10px 0;
    text-align: center;
    width: 100%;
    display: block;
}
</style>

<?php 
/*style of arrow btn*/
if($decodedData['wp_newsletter_closeposition']=="top-left-inside")
{?>
<style>
.webdesign-newsLetterSeven .close-button {
    position: absolute;
    left: 19px;
    top: -21px;}
</style>
<?php }else if($decodedData['wp_newsletter_closeposition']=="top-right-inside")
{	?>
<style>
.webdesign-newsLetterSix .close-button {
   right: 11px;
    top: 11px;
    background: none !important;
}

</style>
<?php }else if($decodedData['wp_newsletter_closeposition']=="top-left-outside")
{?>
<style>
.webdesign-newsLetterSeven .close-button { left: -10px;top: -12px;padding: 6px 0; background:#fff;}
.webdesign-newsLetterSeven .close-button:before, .close-button:after {left: 16px;top: 7px;}
</style>
<?php }else if($decodedData['wp_newsletter_closeposition']=="top-right-outside")
{?>
<style>
.webdesign-newsLetterSeven .close-button { right: -10px;top: -12px;padding: 6px 0; background:#fff;}
.webdesign-newsLetterSeven .close-button:before, .close-button:after {left: 16px;top: 7px;}
</style>
<?php }?>
<?php $count = 0;?>
<div id="main-div" class="subscribebox_<?php echo $newsletter->id;?>" style="display: none;">
<div class="animated <?php echo $decodedData['wp_newsletter_animation'];?>">
<div class="webdesign-newsLetterSeven" style="border-radius:<?php echo $decodedData['wp_newsletter_radius'].'px'; ?>; box-shadow:<?php echo $decodedData['wp_newsletter_bordershadow']; ?>;<?php if(!empty($decodedData['wp_newsletter_backgroundimage'])){ ?>background:url(<?php echo $decodedData['wp_newsletter_backgroundimage'];?>);background-repeat:<?php echo $decodedData['wp_newsletter_backgroundimagerepeat'];?>;background-position:<?php echo $decodedData['wp_newsletter_backgroundimageposition'];?>;<?php } else {?>background:<?php echo $decodedData['wp_newsletter_backgroung_color']; }?>;">
    <div class="news-box">
	<?php
	/*For Ribbon icon*/
	if(isset($decodedData['wp_newsletter_ribbon_show'])&& $decodedData['wp_newsletter_ribbon_show'] == '1')
	{?>
	<div class="ribbon" style="<?php echo $decodedData['wp_newsletter_ribboncss'];?>"><img src=" <?php echo $decodedData['wp_newsletter_ribbon']; ?>" /></div>
	<?php }?>
		<div class="left-div">
		</div>
		<div class="right-div">
			<!--For Heading--->
			<h1 style="color:<?php if(isset($decodedData['wp_newsletter_heading_color'])&& !empty($decodedData['wp_newsletter_heading_color'])) { echo $decodedData['wp_newsletter_heading_color']; }else{ echo "#fff";}?>;"><?php echo $decodedData['wp_newsletter_heading'];?></h1>
			<!--For Description--->
			<p style="color:<?php if(isset($decodedData['wp_newsletter_description_color'])&& !empty($decodedData['wp_newsletter_description_color'])) { echo $decodedData['wp_newsletter_description_color']; }else{ echo "#333";}?>;"><?php echo $decodedData['wp_newsletter_description'];?></p>
		</div>
		<!---For close arrow --->
		<div id="popupfoot"><a href="#" title="<?php if(isset($decodedData['wp_newsletter_closetip_show'])&& $decodedData['wp_newsletter_closetip_show'] == '1'){echo stripslashes($decodedData['wp_newsletter_closetip']);}?>" class="close-button close_<?php echo $newsletter->id;?> agree"></a></div>
		<div class="error_container">                     
			<span class="error" id="error_<?php echo $newsletter->id;?>"></span> 
		</div> 
		<form class="subscribe-box-form" name="nl_<?php echo $newsletter->id;?>"  id="nl_<?php echo $newsletter->id;?>">
			<!-- Email -->
			<?php if(isset($decodedData['wp_newsletter_showaction'])&&  $decodedData['wp_newsletter_showemail'] == '1') { 
			$count++;
			?>
			<input class="email-textbox  subscribe-box-email validate_<?php echo $newsletter->id;?> email_validate_<?php echo $newsletter->id;?> custom-input" name="<?php echo $decodedData['wp_newsletter_emailfieldname'];?>" placeholder="<?php echo $decodedData['wp_newsletter_email'];?>" type="text">
			<?php } ?>
			<!-- Name -->
			<?php if(isset($decodedData['wp_newsletter_showname'])&& $decodedData['wp_newsletter_showname'] == '1'){
			$count ++;
			?>
			<input class="email-textbox subscribe-box-email validate_<?php echo $newsletter->id;?> custom-input" name="<?php echo $decodedData['wp_newsletter_namefieldname'];?>" placeholder="<?php echo $decodedData['wp_newsletter_name'];?>" type="text">
			<?php } ?>
			
			<!-- First Name -->
			<?php if(isset($decodedData['wp_newsletter_showfirstname'])&& $decodedData['wp_newsletter_showfirstname'] == '1') {$count++; ?>
			<input class="email-textbox subscribe-box-email validate_<?php echo $newsletter->id;?> custom-input" name="<?php echo $decodedData['wp_newsletter_firstnamefieldname'];?>" placeholder="<?php echo $decodedData['wp_newsletter_firstname'];?>" type="text">
			<?php } ?>
		
			<!-- Last Name -->
			<?php if(isset($decodedData['wp_newsletter_showlastname'])&& $decodedData['wp_newsletter_showlastname'] == '1') { $count++;?>
			<input class="email-textbox subscribe-box-email validate_<?php echo $newsletter->id;?> custom-input" name="<?php echo $decodedData['wp_newsletter_lastnamefieldname'];?>" placeholder="<?php echo $decodedData['wp_newsletter_lastname'];?>" type="text">
			<?php } ?>
			
			<!-- Phone -->
			<?php if(isset($decodedData['wp_newsletter_showphone'])&& $decodedData['wp_newsletter_showphone'] == '1') {$count++; ?>
			<input class="email-textbox subscribe-box-email validate_<?php echo $newsletter->id;?> custom-input" name="<?php echo $decodedData['wp_newsletter_phonefieldname'];?>" placeholder="<?php echo $decodedData['wp_newsletter_phone'];?>" type="text">
			<?php } ?>
		
			<!-- company -->
			<?php if(isset($decodedData['wp_newsletter_showcompany'])&& $decodedData['wp_newsletter_showcompany'] == '1') { $count++;?>
			<input class="email-textbox subscribe-box-email validate_<?php echo $newsletter->id;?> custom-input" name="<?php echo $decodedData['wp_newsletter_companyfieldname'];?>" placeholder="<?php echo $decodedData['wp_newsletter_company'];?>" type="text">
			<?php } ?>
		
			<!-- zip -->
			<?php if(isset($decodedData['wp_newsletter_showzip'])&& $decodedData['wp_newsletter_showzip'] == '1') {
			$count++;?>
			<input class="email-textbox subscribe-box-email validate_<?php echo $newsletter->id;?> custom-input" name="<?php echo $decodedData['wp_newsletter_zipfieldname'];?>" placeholder="<?php echo $decodedData['wp_newsletter_zip'];?>" type="text">
			<?php } ?>
			
			<!-- msg -->
			<?php if(isset($decodedData['wp_newsletter_showmessage'])&& $decodedData['wp_newsletter_showmessage'] == '1') { $count++;?>
			<textarea class="email-textbox subscribe-box-email validate_<?php echo $newsletter->id;?> custom-input" name="<?php echo $decodedData['wp_newsletter_messagefieldname'];?>" placeholder="<?php echo $decodedData['wp_newsletter_message'];?>"></textarea>
			<?php } ?>
			
			<!-- terms -->
			<div class="terms-box">
			<?php if(isset($decodedData['wp_newsletter_showterms'])&& $decodedData['wp_newsletter_showterms'] == '1') { ?>
			<input type="checkbox" value="Yes" name="TERMS" <?php echo($decodedData['wp_newsletter_termsrequired'] == '1') ? 'required' : '';?>/ <?php if($decodedData['wp_newsletter_termsrequired'] == '1') {?>id="term_<?php echo $newsletter->id;?>"<?php }?>> <?php echo $decodedData['wp_newsletter_terms'];?>
			<span id="error_terms_<?php echo $newsletter->id;?>" class="error"></span>
			<?php } else { $wp_newsletter_showterms = 0;}?>		
			</div>
			<!--Subscribe Now Button--->
			<?php if(isset($decodedData['wp_newsletter_showaction'])&& $decodedData['wp_newsletter_showaction'] == '1'):?>
				<input class="subscribe-box-action subscribeThreebutton" name="subscribe-box-action" value="<?php echo $decodedData['wp_newsletter_action'];?>" id="subscribe-box-action-<?php echo $newsletter->id;?>" type="button">
				<div class="subscribe-box-afteractionmessage" style="display: none;"></div>
			<?php endif;?>
			<!--Cancel Button-->
			<?php if(isset($decodedData['wp_newsletter_showcancel'])&& $decodedData['wp_newsletter_showcancel'] == '1') { ?>
			<div class="subscribe-box-cancel close_<?php echo $newsletter->id;?> thanksText"><a href="#" class="thanksText"><?php echo $decodedData['wp_newsletter_cancel'];?></a></div>
			<?php } ?>
             <input type="hidden" value="<?php echo date("Y-m-d h:i:s");?>" name="TIME"/>
            <input type="hidden" name="nl_pop_page" value="<?php echo (is_home() ? 'blog' : $post->ID);?>" />
		</form>
		<!--Privacy Text--->
		<?php if(!empty($decodedData['wp_newsletter_privacy_show']) && ($decodedData['wp_newsletter_privacy_show']==1) ):?>
			<div class="privacy-text" style="color:<?php echo $decodedData['wp_newsletter_privacy_color']."!important"; ?>"><?php echo $decodedData['wp_newsletter_privacy'];?></div>
		<?php endif;?>	
	</div>
</div>
</div>
	
</div>
<?php

if($count == 1 && (isset($wp_newsletter_showterms)&& $wp_newsletter_showterms == '0'))
{
	?>
	<style>
	.webdesign-newsLetterSeven .email-textbox {margin: 5px 10px 5px 15px;max-width: 380px;padding: 21px; float:left;}
	.webdesign-newsLetterSeven .terms-box{display:block !important;}
	.webdesign-newsLetterSeven .subscribeThreebutton {padding:23px; }
	</style>
<?php 
}
?>
<?php
if($count == 1 && (isset($decodedData['wp_newsletter_showterms'])&& $decodedData['wp_newsletter_showterms'] == '1')){
	?>
	<style>
	.webdesign-newsLetterSeven .email-textbox {margin: 5px auto; display: block;}
	.webdesign-newsLetterSeven .subscribeThreebutton {margin: 5px auto; display: block;padding:23px;max-width:380px; font-size:  }
	</style>
	
<?php }elseif($count == 3 || $count == 5 || $count==7){?>
	<style>
.webdesign-newsLetterSeven .email-textbox{   padding: 10px; max-width: 300px; margin: 5px 5px;}
.webdesign-newsLetterSeven .subscribeThreebutton { padding: 10px;margin: 10px auto;max-width: 200px;display: block;}
.webdesign-newsLetterSeven .right-div h1 {margin: 5px 20px;padding: 0px;}
.webdesign-newsLetterSeven p { margin: 5px 30px; padding: 0px;}
.webdesign-newsLetterSeven .box-center{ margin:5px auto; display:block; float:none;}
	</style>
	
<?php
}elseif($count == 2 || $count == 4 || $count==6 || $count==8)
{?>
<style>
.webdesign-newsLetterSeven .email-textbox{   padding: 10px; max-width: 300px; margin: 5px 5px;}
.webdesign-newsLetterSeven .subscribeThreebutton { padding: 10px;margin: 10px auto;max-width: 200px;display: block;}
.webdesign-newsLetterSeven .right-div h1 {margin: 5px 20px;padding: 0px;}
.webdesign-newsLetterSeven p { margin: 5px 30px; padding: 0px;}
</style>
<?php 
}
?>

<script>
	jQuery(document).ready(function() {		
	    var count = 0;
		jQuery( ".custom-input" ).each(function( i ) {			
			count++;
		});
		if(parseInt(count) == 3 || parseInt(count)== 5 || parseInt(count)== 7){
			jQuery('.custom-input:last').addClass("box-center");
		}
		var ajax_url = "<?php echo admin_url('admin-ajax.php');?>";
		jQuery('#subscribe-box-action-<?php echo $newsletter->id;?>').click(function(e) {
			e.preventDefault();
			var go_ahead = true; 
			var required = false;
			jQuery(".validate_<?php echo $newsletter->id;?>").each(function() { 
			var val = jQuery(this).val();
			 if(val == '')
			 {
				go_ahead = false; 
				required = true;
			 }
			 else
			 {
				go_ahead = true; 
				required = false;
			 }
			});
			if(required)
			{
				jQuery('#error_<?php echo $newsletter->id;?>').text('<?php echo $decodedData['wp_newsletter_fieldmissingmessage'];?>');
			}
			else if(!ValidateEmail<?php echo $newsletter->id;?>(jQuery('.email_validate_<?php echo $newsletter->id;?>').val()))
			{
				jQuery('#error_<?php echo $newsletter->id;?>').text('<?php echo $decodedData['wp_newsletter_invalidemailmessage'];?>');
				go_ahead = false; 
			}
			else if(jQuery('#term_<?php echo $newsletter->id;?>').length)
			{
				if(!jQuery('#term_<?php echo $newsletter->id;?>').is(':checked'))
				{
					jQuery('#error_terms_<?php echo $newsletter->id;?>').html('<p><?php echo $decodedData['wp_newsletter_termsnotcheckedmessage'];?></p>');
					go_ahead = false; 
				}
			}
			else
			{
				jQuery('#error_terms_<?php echo $newsletter->id;?>').text('');
				jQuery('#error_<?php echo $newsletter->id;?>').text('');
				
			}
			if(go_ahead) 
			{
				var data = {
					'action': 'save_newsletter',
					'nl_id': '<?php echo $newsletter->id;?>',
					'nl_name': '<?php echo $newsletter->name;?>',
					'nl_data': jQuery("#nl_<?php echo $newsletter->id;?>").serialize()
				};
				// We can also pass the url value separately from ajaxurl for front end AJAX implementations
				jQuery.post(ajax_url, data, function(response) {
				var obj = jQuery.parseJSON(response);
				var action = obj.action;
				if(action == 'close')
				{
				   jQuery(".subscribebox_<?php echo $newsletter->id;?>").hide();
				}
				else if(action == 'redirect')
				{
					var redirect = obj.redirect;
					window.location.href = redirect;
				}
				else if(action == 'display')
				{
					var redirect = obj.redirect;
					jQuery('.subscribe-box-afteractionmessage').show().text(redirect);
					jQuery(".validate_<?php echo $newsletter->id;?>").each(function() { 
					var val = jQuery(this).val('');
					});
				 }
				}); 
			}
			});
	});
	function ValidateEmail<?php echo $newsletter->id;?>(email) {
			var expr = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
			return expr.test(email);
	};
	</script>
<?php
	}/*End of foreach loop*/
 }
 } /*End if */
?>