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
/** Newsletter 3 **/
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
.webdesign-newsLetter
{
	width: 100%;
	max-width: 640px;
	padding: 58px;
	border-radius: 3px;
	background:url(<?php echo plugins_url( 'images/bluebg.jpg',__FILE__) ?>);
	background-size: 100%;
	margin: 1px auto;
	position: relative;
	z-index: 9999;
	background-repeat:repeat-y;
	background-position: right bottom;
}
.webdesign-newsLetter p
{
	text-align: left;
	line-height: 25px;
	padding: 15px 0;
	color: #333;
	font-family: 'Roboto', sans-serif;
	font-size: 18px;
	font-style: italic;
}
.webdesign-newsLetter .subscribeGreenbutton
{
	font-family: 'Poppins', sans-serif;
	background: #7ab52d;
	color: #fff;
	padding: 15px;
	text-transform: uppercase;
	margin: 4px;
	border: none;
	font-weight: 600;
	letter-spacing: 2px;
	max-width: 160px;
	width: 100%;
	float: left;
	border-radius: 5px;
	font-size: 20px;
}
.webdesign-newsLetter .subscribeRedbutton
{
	font-family: 'Poppins', sans-serif;
	background: #df4444;
	color: #fff;
	padding: 15px;
	text-transform: uppercase;
	margin: 4px;
	border: none;
	font-weight: 600;
	letter-spacing: 2px;
	max-width: 160px;
	width: 100%;
	float: left;
	border-radius: 5px;
	font-size: 20px;
}
.webdesign-newsLetter .email-textbox
{
	padding: 22px;
	width: 100%;
	max-width: 350px;
	margin: 10px 0;
	display: block;
	box-sizing: border-box;
	font-family: 'Raleway', sans-serif;
	font-size: 15px;
	color: #808080;
}
.forbesImg
{
	max-width: 280px;
    width: 100%;
}
.webdesign-newsLetter .right-div
{
	width: 30%;
	float: right;
	position: relative;
	height: 100%;
}
.webdesign-newsLetter .left-div
{
	width: 70%;
	float: left;
}
.webdesign-newsLetter .left-div h1
{
	font-size: 40px;
	font-family: 'Poppins', sans-serif;
	font-weight: bold;
	color: #2c3c62;
	text-align: left;
	line-height:45px;
}
.webdesign-newsLetter .left-div p
{
	font-style:normal;
	text-align: left;
	margin:0px;
}
.mobileImg
{
	position: absolute;
	top: 33px;
	right: 0px;
}
.webdesign-newsLetter .close-button {
  position: absolute;
  right: -17px;
  top: -11px;
  width: 40px;
  height: 40px;
  border-radius: 100%;
  padding: 6px 0;
}
.webdesign-newsLetter .close-button:before, .close-button:after {
  position: absolute;
  left: 0px;
  content: ' ';
  height: 23px;
  width: 3px;
  background-color: #fff;
  top: 22px;
}
.webdesign-newsLetter .close-button:before {
  transform: rotate(45deg);
}
.webdesign-newsLetter .close-button:after {
  transform: rotate(-45deg);
}
.webdesign-newsLetter .subscribeThreebutton
{
	background: #7ab52d;
	color: #fff;
	padding: 24px;
	text-transform: uppercase;
	margin: 0;
	border: none;
	font-weight:600;
	letter-spacing:2px;
	max-width: 350px;
	width: 100%;
}
@media only screen and (max-width:767px)
{
	.webdesign-newsLetter .email-textbox{width:100%; max-width: inherit; margin: 10px 0;}
	.webdesign-newsLetter .bottom-bluediv{padding:30px 10px;}
	.webdesign-newsLetter .subscribeThreebutton{width:100%; max-width: inherit;margin: 10px auto 0 0;}
	.webdesign-newsLetter h1{font-size: 60px;}
	.webdesign-newsLetter .right-div{width:100%;}
	.mobileImg{right:-30px;}
	.webdesign-newsLetter .left-div h1{ font-size:22px;}
	.webdesign-newsLetter .right-div h1{ font-size:35px;}
	.mobileImg img{width:100%; max-width: 260px; margin: auto;}
	.webdesign-newsLetter{ padding-bottom: 0;}
}
@media only screen and (max-width:479px)
{
	.webdesign-newsLetter h1{font-size: 45px;}
	.webdesign-newsLetter .right-div{width:100%;}
	.webdesign-newsLetter .right-div h1{ font-size:18px;}
	.webdesign-newsLetter{padding:15px;}
	.webdesign-newsLetter .mobileImg{right: -10px;}
	.mobileImg img{width: 130px;}
	
	}
@media only screen and (max-width:374px)
{
	.webdesign-newsLetter h1{font-size: 35px;}
	.webdesign-newsLetter .right-div{width:100%;}
	.webdesign-newsLetter .right-div h1{ font-size:18px;}
	.webdesign-newsLetter{padding:15px;}
	.webdesign-newsLetter .mobileImg{ right:-4px;}
	.mobileImg img{width:100px;}
}
.error_container {
    text-align: center;
    color: #ff0000;
}
.webdesign-newsLetter form {
    margin: 20px auto;
}
</style>
<?php 
/*style of arrow btn*/
if($decodedData['wp_newsletter_closeposition']=="top-left-inside")
{?>
<style>
.webdesign-newsLetter .close-button {
    left: 1px;
    top: 1px;
    width: 25px;
    height: 25px;
}
.webdesign-newsLetter .close-button:before, .close-button:after {
   left: 10px;
   height: 14px;
   top: 4px;
}
</style>
<?php }else if($decodedData['wp_newsletter_closeposition']=="top-right-inside")
{
	?>
<style>
.webdesign-newsLetter .close-button { 
	right: -20px;
	top: 13px;
}
</style>
<?php }else if($decodedData['wp_newsletter_closeposition']=="top-left-outside")
{?>
<style>
.webdesign-newsLetter .close-button { 
	left: -18px;
    top: -18px;
	background:#333;
}
.webdesign-newsLetter .close-button:before, .close-button:after {
    left: 17px;
    top: 23px;
}
</style>
<?php }else if($decodedData['wp_newsletter_closeposition']=="top-right-outside")
{?>
<style>
.webdesign-newsLetter .close-button { 
	right: -17px;
	top: -12px;
	background:#333;
}
.webdesign-newsLetter .close-button:before, .close-button:after {left: 19px; top: 10px;}
</style>
<?php }?>
<div id="main-div">
 <div class="animated <?php echo $decodedData['wp_newsletter_animation'];?>">
 <div class="webdesign-newsLetter">
		<div class="left-div">
		 <h1><?php _e('Growth hacking</br> Your Startup','nl');?></h1>
		 <p><?php _e('Download my free 7,000+  pdf ebook to start growing your start up','nl');?></p>
		 <div id="popupfoot"><a href="#" class="close-button close agree"></a></div>
			<form class="subscribe-box-form" name="nl_<?php echo $newsletter->id;?>"  id="nl_<?php echo $newsletter->id;?>">
				<!-- Email -->
				<input class="email-textbox  subscribe-box-email validate_<?php echo $newsletter->id;?> email_validate_<?php echo $newsletter->id;?> custom-input" name="<?php echo $decodedData['wp_newsletter_emailfieldname'];?>" placeholder="<?php echo $decodedData['wp_newsletter_email'];?>" type="text">
				<!-- Name -->
				<?php if(isset($decodedData['wp_newsletter_showname'])&& $decodedData['wp_newsletter_showname'] == '1'){?>
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
                 <input type="hidden" value="<?php echo date("Y-m-d h:i:s");?>" name="TIME"/>
            <input type="hidden" name="nl_pop_page" value="<?php echo (is_home() ? 'blog' : $post->ID);?>" />
			</form>
			<!--Privacy Text--->
			<?php if(!empty($decodedData['wp_newsletter_privacy_show']) && ($decodedData['wp_newsletter_privacy_show']==1) ):?>
				<div class="privacy-text" style="color:<?php echo $decodedData['wp_newsletter_privacy_color']."!important"; ?>"><?php echo $decodedData['wp_newsletter_privacy'];?></div>
			<?php endif; ?>	
		</div>
        <div class="right-div">
	    </div>
		<div class="mobileImg">
			<img src="<?php echo plugins_url( 'images/mobile1.png',__FILE__) ?>" alt=""/>
		</div>
		<div class="clear"></div>
	</div></div>
	
</div>
<script>
	jQuery(document).ready(function() {		
		var ajax_url = "<?php echo admin_url('admin-ajax.php');?>";
		jQuery('#subscribe-box-action-<?php echo $newsletter->id;?>').click(function(e) {
			//alert('working');
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
	} 
	}/*End of foreach loop*/
 } /*End if */
?>