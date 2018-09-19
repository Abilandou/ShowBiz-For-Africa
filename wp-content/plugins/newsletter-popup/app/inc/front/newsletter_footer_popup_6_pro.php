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
.webdesign-newsLetterSix
{
	width:100%;
	max-width: 640px;
	padding: 30px;
	border-radius: 1px;
	background:url(<?php echo plugins_url( 'images/popupbg5.jpg',__FILE__); ?>) no-repeat;
	background-size:cover;
	margin: 30px auto;
	position: relative;
	z-index:9999;
	background-size: cover !important;
	background-position: right bottom;
	margin-top: <?php echo $decodedData['wp_newsletter_mintopbottommargin'].''.'px';?>;
}
.webdesign-newsLetterSix .left-div
{
	width: 100%;
	float:left;
	position: relative;
}

.webdesign-newsLetterSix .left-div h1
{
	color: #fff;
	font-weight: 900;
	font-size: 34px;
	text-align: center;
	letter-spacing:2px;
	padding: 0;
	font-family: 'Raleway', sans-serif;
	line-height: 47px;
	text-transform:uppercase;
}
.webdesign-newsLetterSix .toolicon
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
.webdesign-newsLetterSix p
{
	text-align: center;
	line-height:25px;
	color:#fff;
	margin: 30px 0;
	font-size: 24px;
	font-family: 'Oswald';
	font-weight: 100;
	letter-spacing: 1px;
}
.webdesign-newsLetterSix .subscribeThreebutton
{
	font-family: 'Raleway', sans-serif;
	background: #7ab52d;
	color: #fff;
	padding: 24px;
	text-transform: uppercase;
	margin: auto;
	border: none;
	font-weight:600;
	letter-spacing:2px;
	max-width: 370px;
	width: 100%;
	display: block;
}
.webdesign-newsLetterSix .email-textbox
{
	padding: 20px;
	width: 100%;
	max-width: 370px;
	margin: 25px auto 0;
	box-sizing: border-box;
	font-family: 'Open Sans', sans-serif;
	font-size: 15px;
	box-shadow: none;
	border: none;
	display: block;
}
.webdesign-newsLetterSix form
{
	 margin: 0px 0 0;
}
input::-webkit-input-placeholder {
color: #808080 !important;
}
.webdesign-newsLetterSix .close-button {
  position: absolute;
  right: -10px;
  top: -12px;
  width: 35px;
  height: 35px;
  border-radius: 100%;
  background: <?php if(isset($decodedData['wp_newsletter_close_bg_color']) && !empty($decodedData['wp_newsletter_close_bg_color'])){ echo $decodedData['wp_newsletter_close_bg_color'];}else{ echo "#e98422";}?>;
  padding: 6px 0;
  z-index:99999;
}

.webdesign-newsLetterSix .close-button:hover {
    background: <?php if(isset($decodedData['wp_newsletter_close_hover']) && !empty($decodedData['wp_newsletter_close_hover'])){ echo $decodedData['wp_newsletter_close_hover'];}else{ echo "#e98422";}?>;
    transition: .2s;
}

.webdesign-newsLetterSix .close-button:before, .close-button:after {
  position: absolute;
  left: 17px;
  content: ' ';
  height: 21px;
  width: 3px;
  background-color: #333;
  top: 7px;
}
.webdesign-newsLetterSix .close-button:before {
  transform: rotate(45deg);
}
.webdesign-newsLetterSix .close-button:after {
  transform: rotate(-45deg);
}
.webdesign-newsLetterSix .thanksText{width:100%; margin:5px 0; text-align:center;}
.webdesign-newsLetterSix .terms-box{width:100%; text-align:center; margin:5px;}
.webdesign-newsLetterSix .privacy-text {width:100%; text-align: center;}
@media screen and (max-width: 767px)
{
	.webdesign-newsLetterSix .toolicon{left: 70px;}
	.toolicon img{max-width: 160px;left: -75px;top: 10px;}
	.webdesign-newsLetterSix .toolicon{width: 160px;}
	.webdesign-newsLetterSix .email-textbox {padding: 10px;max-width:inherit !important;margin: 3px 0 !important;}
	.webdesign-newsLetterSix .subscribeThreebutton{margin: 0px 0px 30px;max-width:inherit;}
	.webdesign-newsLetterSix .news-box{overflow-y:auto; max-height:85vh;}
	.webdesign-newsLetterSix{padding:0px !important;}
	.webdesign-newsLetterSix form {padding: 10px; padding-bottom:0px;}
	.webdesign-newsLetterSix .subscribeThreebutton {margin: auto;}
	.webdesign-newsLetterSix .left-div h1{font-size: 30px !important;margin: 30px 0  0!important;}

}
@media screen and (max-width: 600px)
{
	.toolicon img{max-width: 160px;left: -72px;top: 30px;}
	.webdesign-newsLetterSix .toolicon{width: 110px;}
	.webdesign-newsLetterSix p{font-size: 22px;}
}
@media screen and (max-width: 480px)
{
	.webdesign-newsLetterSix p{ font-size:19px;}
	.webdesign-newsLetterSix{ padding:20px;}
	.webdesign-newsLetterSix .left-div h1{font-size: 50px;margin: 30px 0;}
	.toolicon img{max-width:120px;left: -46px;top: 8px;}
	.webdesign-newsLetterSix .toolicon{left: 45px;top: 25px;}
	.webdesign-newsLetterSix .toolicon{max-width:130px;}	
	.webdesign-newsLetterSix .box-center{ margin: 3px 0 !important;}
	.webdesign-newsLetterSix .left-div h1 {font-size: 19px;margin: 70px 0 0 !important;line-height: 25px;}
}
@media screen and (max-width:374px)
{
	.webdesign-newsLetterSix .toolicon{left: 38px;top: 26px;}
	.webdesign-newsLetterSix .left-div h1{font-size: 18px; line-height:30px;}
	.toolicon img{max-width: 92px;left: -35px;top: 16px;}
	.webdesign-newsLetterSix .toolicon{width:100px;}
	.webdesign-newsLetterSix .left-div h1{margin: 70px 0 0 !important; font-size:20px !important;}
	.webdesign-newsLetterSix form {padding: 10px; padding-bottom:0px;}
	.webdesign-newsLetterSix .privacy-text {font-size: 13px;}
}

.error_container {
    text-align: center;
    color: #ff0000;
}
.error p {
    color: #ff0000;
}
.ribbon{
	background:url(<?php echo $decodedData['wp_newsletter_ribbon']; ?>) no-repeat;
	position:absolute;
	top: -8px;
	left: -8px;
	z-index: 99999;
}

.subscribe-box-afteractionmessage {
    text-align: center;
    color: #fff;
}
</style>
</style>
<?php 
/*style of arrow btn*/
if($decodedData['wp_newsletter_closeposition']=="top-left-inside")
{?>
<style>
.webdesign-newsLetterSix .close-button {
    left: -6px;
    top: -4px;
    background: none !important;
}
</style>
<?php }else if($decodedData['wp_newsletter_closeposition']=="top-right-inside")
{	?>
<style>
.webdesign-newsLetterSix .close-button {
   right: 0px;
    top: -4px;
    background: none !important;
}

</style>
<?php }else if($decodedData['wp_newsletter_closeposition']=="top-left-outside")
{?>
<style>
.webdesign-newsLetterSix .close-button {
    left: -10px;
    top: -12px;
}
</style>
<?php }else if($decodedData['wp_newsletter_closeposition']=="top-right-outside")
{?>
<style>
.webdesign-newsLetterSix .close-button {
    right: -10px;
    top: -12px;
}
</style>
<?php }?>
<?php $count = 0;?>
<div id="main-div" class="subscribebox_<?php echo $newsletter->id;?>" style="display: none;">
 <div class="animated <?php echo $decodedData['wp_newsletter_animation'];?>">
<div class="webdesign-newsLetterSix" style="border-radius:<?php echo $decodedData['wp_newsletter_radius'].'px'; ?>; box-shadow:<?php echo $decodedData['wp_newsletter_bordershadow']; ?>;<?php if(!empty($decodedData['wp_newsletter_backgroundimage'])){ ?>background:url(<?php echo $decodedData['wp_newsletter_backgroundimage'];?>);background-repeat:<?php echo $decodedData['wp_newsletter_backgroundimagerepeat'];?>;background-position:<?php echo $decodedData['wp_newsletter_backgroundimageposition'];?>;<?php } else {?>background:<?php echo $decodedData['wp_newsletter_backgroung_color']; }?>;">
    <div class="news-box">
    <?php
	/*For Ribbon icon*/
	if(isset($decodedData['wp_newsletter_ribbon_show'])&& $decodedData['wp_newsletter_ribbon_show'] == '1')
	{?>
	<div class="ribbon" style="<?php echo $decodedData['wp_newsletter_ribboncss'];?>"><img src=" <?php echo $decodedData['wp_newsletter_ribbon']; ?>" /></div>
	<?php }?>
		<div class="left-div">
			<!--For Heading--->
			<h1 style="color:<?php if(isset($decodedData['wp_newsletter_heading_color'])&& !empty($decodedData['wp_newsletter_heading_color'])) { echo $decodedData['wp_newsletter_heading_color']; }else{ echo "#fff";}?>;"><?php echo $decodedData['wp_newsletter_heading'];?></h1>
			<!--For Description--->
			<p style="color:<?php if(isset($decodedData['wp_newsletter_description_color'])&& !empty($decodedData['wp_newsletter_description_color'])) { echo $decodedData['wp_newsletter_description_color']; }else{ echo "#333";}?>;"><?php echo $decodedData['wp_newsletter_description'];?></p>
		</div>
		<div class="right-div">
			<!---For close arrow --->
			<div id="popupfoot"><a href="#" title="<?php if(isset($decodedData['wp_newsletter_closetip_show'])&& $decodedData['wp_newsletter_closetip_show'] == '1'){echo stripslashes($decodedData['wp_newsletter_closetip']);}?>" class="close-button close_<?php echo $newsletter->id;?> agree"></a></div>
		</div>
		<!---For Error Message --->
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
			<?php } ?>		
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
if($count == 1 || $count ==2 || $count== 3){
	?>	
<?php }?>
<?php
if($count == 3 || $count == 5 || $count==7){?>
<style>
.webdesign-newsLetterSix{padding: 55px 15px;background-size:cover;margin: 30px auto;background-size: cover !important;}
.webdesign-newsLetterSix .left-div h1 {padding: 0;margin: 0;}
.webdesign-newsLetterSix p {margin: 5px; padding: 5px;}
.webdesign-newsLetterSix .email-textbox {padding: 10px;max-width: 295px;margin: 5px;display: block;float: left;}
.webdesign-newsLetterSix .terms-box {display: inline-block;}
.webdesign-newsLetterSix .box-center{ float:none; display:block; margin:5px auto;}
.webdesign-newsLetterSix .subscribeThreebutton{max-width:200px; padding:20px;}
</style>
<?php
}elseif($count == 2 || $count == 4 || $count==6 || $count==8)
{?>
<style>
.webdesign-newsLetterSix{padding: 55px 15px;background-size:cover;margin: 30px auto;background-size: cover !important;}
.webdesign-newsLetterSix .left-div h1 {padding: 0;margin: 0;}
.webdesign-newsLetterSix p {margin: 5px; padding: 5px;}
.webdesign-newsLetterSix .email-textbox {padding: 10px;max-width: 295px;margin: 5px;display: block;float: left;}.webdesign-newsLetterSix .terms-box {display: inline-block;}
.webdesign-newsLetterSix .subscribeThreebutton{max-width:200px; padding:15px;}
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