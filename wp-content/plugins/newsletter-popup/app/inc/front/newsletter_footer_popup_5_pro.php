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
.webdesign-newsLetterFive
{
	width:100%;
	max-width: 640px;
	padding: 30px 40px 40px;
	border-radius: 1px;
	background:url(<?php echo plugins_url( 'images/popupbg4.jpg',__FILE__); ?>) no-repeat;
	background-size:cover !important;
	margin: 10px auto;
	position: relative;
	z-index:9999;
	background-position: right bottom;
	margin-top: <?php echo $decodedData['wp_newsletter_mintopbottommargin'].''.'px';?>;
}
.webdesign-newsLetterFive .left-div
{
	width: 60%;
	float:left;
}

.webdesign-newsLetterFive .right-div
{
	width: 40%;
	float: right;
}

.webdesign-newsLetterFive .left-div h1
{
	color: #fff;
	font-weight:bold;
	font-size: 38px;
	text-align: left;
	letter-spacing:2px;
	padding: 0;
	font-family: 'Raleway', sans-serif;
	line-height: 47px;
	text-transform:uppercase;
}
.webdesign-newsLetterFive  .left-div .community-text
{
	color: #c9752e;
	font-size: 31px;
	text-align: left;
	font-family: 'Raleway', sans-serif;
	margin: 30px 0 10px;
	font-weight: bold;
}
.webdesign-newsLetterFive p
{
	text-align: left;
	line-height:25px;
	color:#fff;
	margin: 10px 0;
	font-size: 17px;
	font-family: 'Open Sans', sans-serif;
}
.webdesign-newsLetterFive .subscribeThreebutton
{
	font-family: 'Raleway', sans-serif;
	background: #e98422;
	color: #fff;
	padding: 24px;
	text-transform: uppercase;
	margin: 0;
    border-radius: 5px;
	font-weight:600;
	letter-spacing:2px;
	max-width: 370px;
	width: 100%;
}
.webdesign-newsLetterFive .email-textbox
{
	padding: 20px;
	width: 100%;
	max-width: 370px;
	margin: 15px 0;
	box-sizing: border-box;
	font-family: 'Open Sans', sans-serif;
	font-size: 15px;
	box-shadow: none;
	border: none;
	display: block;
}

.webdesign-newsLetterFive form
{
	 margin: 5px 0 0;
}
input::-webkit-input-placeholder {
color: #808080 !important;
}
.webdesign-newsLetterFive .privacy-text {
    text-align: center;
	margin:15px 0;
	width:100%;
}
.webdesign-newsLetterFive .thanksText{width:100%; margin:5px 0; text-align:center;}
.webdesign-newsLetterFive .terms-box {
	width:100%;
    text-align: center;
	margin:15px 0;
}
.webdesign-newsLetterFive .close-button {
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

.webdesign-newsLetterFive .close-button:hover {
    background: <?php if(isset($decodedData['wp_newsletter_close_hover']) && !empty($decodedData['wp_newsletter_close_hover'])){ echo $decodedData['wp_newsletter_close_hover'];}else{ echo "#e98422";}?>;
    transition: .2s;
}

.webdesign-newsLetterFive .close-button:before, .close-button:after {
  position: absolute;
  left: 17px;
  content: ' ';
  height: 21px;
  width: 3px;
  background-color: #fff;
  top: 7px;
}
.webdesign-newsLetterFive .close-button:before {
  transform: rotate(45deg);
}
.webdesign-newsLetterFive .close-button:after {
  transform: rotate(-45deg);
}
.webdesign-newsLetterFive .email-textbox::after{ display:table; clear:both; content:'';}
@media screen and (max-width: 767px)
{
	.webdesign-newsLetterFive .email-textbox {max-width: inherit !important; margin:5px 0px !important; }
	.webdesign-newsLetterFive .news-box{ overflow-y:auto; max-height:100vh;}
	.webdesign-newsLetterFive{padding:0px !important;}
	.webdesign-newsLetterFive form{padding:10px;}
	.webdesign-newsLetterFive p {margin: 10px;}
	.webdesign-newsLetterFive .left-div h1{padding: 0 10px !important;}
}
@media screen and (max-width: 480px)
{
	.webdesign-newsLetterFive .left-div {float: left;width:100%;}
	.webdesign-newsLetterFive .right-div {float: left;}
	.right-div .wordpress-text {font-size: 41px;}
	.webdesign-newsLetterFive .email-textbox{ margin:30px 0px;  max-width:inherit;}
	.webdesign-newsLetterFive .subscribeThreebutton{margin: 0;max-width:inherit !important;}
}
@media screen and (max-width: 320px)
{
	.webdesign-newsLetterFive .subscribeThreebutton{margin: 0;max-width:inherit;font-size: 10px;padding: 25px 5px;}
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
.webdesign-newsLetterFive .close-button {left:-6px;top:-3px; background:none;}
</style>
<?php }else if($decodedData['wp_newsletter_closeposition']=="top-right-inside")
{	?>
<style>
.webdesign-newsLetterFive .close-button {right: -2px;top: 2px; background:none;}
</style>
<?php }else if($decodedData['wp_newsletter_closeposition']=="top-left-outside")
{?>
<style>
.webdesign-newsLetterFive .close-button {left: -10px;top: -12px;}
.webdesign-newsLetterFive .close-button:before, .close-button:after {left: 16px;top: 7px;}
</style>
<?php }else if($decodedData['wp_newsletter_closeposition']=="top-right-outside")
{?>
<style>
.webdesign-newsLetterFive .close-button {right:-10px;top: -12px;}
.webdesign-newsLetterFive .close-button:before, .close-button:after {left: 16px;top: 7px;}
</style>
<?php }?>
<?php $count = 0;?>
<div id="main-div" class="subscribebox_<?php echo $newsletter->id;?>" style="display: none;">
	 <div class="animated <?php echo $decodedData['wp_newsletter_animation'];?>">
    <div class="webdesign-newsLetterFive" style="border-radius:<?php echo $decodedData['wp_newsletter_radius'].'px'; ?>; box-shadow:<?php echo $decodedData['wp_newsletter_bordershadow']; ?>;<?php if(!empty($decodedData['wp_newsletter_backgroundimage'])){ ?>background:url(<?php echo $decodedData['wp_newsletter_backgroundimage'];?>);background-repeat:<?php echo $decodedData['wp_newsletter_backgroundimagerepeat'];?>;background-position:<?php echo $decodedData['wp_newsletter_backgroundimageposition'];?>;<?php } else {?>background:<?php echo $decodedData['wp_newsletter_backgroung_color']; }?>;">
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
			<div id="popupfoot">
				<a href="#" title="<?php if(isset($decodedData['wp_newsletter_closetip_show'])&& $decodedData['wp_newsletter_closetip_show'] == '1'){echo stripslashes($decodedData['wp_newsletter_closetip']);}?>" class="close-button close_<?php echo $newsletter->id;?> agree"></a>
			</div>
		</div>
		<div class="clear"></div>
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
if($count == 1 && (isset($decodedData['wp_newsletter_showterms'])&& $decodedData['wp_newsletter_showterms'] == '1')){
	?>
	<style>
	.webdesign-newsLetterFive .email-textbox	{margin: 10px;display: block;}
	.webdesign-newsLetterFive .subscribeThreebutton {margin: 10px;display: block;}
	.webdesign-newsLetterFive .terms-box {text-align: left; margin: 15px 10px;}
	</style>
	
<?php }?>
<?php
if($count == 3 || $count == 5 || $count==7){?>
<style>
.webdesign-newsLetterFive {padding: 30px 20px 40px;}
.webdesign-newsLetterFive .email-textbox {padding: 20px;max-width: 290px;margin: 5px 4px;display:inline-block;float: none;vertical-align:top;}
.webdesign-newsLetterFive .terms-box {text-align: center; margin:10px 0;}
.webdesign-newsLetterFive .subscribeThreebutton {padding: 15px; max-width: 200px; margin: 5px auto;display: block;}
.webdesign-newsLetterFive .email-textbox{padding:10px;}
.webdesign-newsLetterFive .left-div h1 {font-size: 38px;padding: 0;line-height: 40px;margin: 0;}
.webdesign-newsLetterFive .box-center{float:none; display:block; margin:5px auto;}
</style>
<?php
}elseif($count == 2 || $count == 4 || $count==6 || $count==8)
{?>
<style>
.webdesign-newsLetterFive {padding: 30px 20px 40px;}
.webdesign-newsLetterFive .email-textbox {padding: 20px;max-width: 290px;margin: 5px 4px;display:inline-block;float: none; vertical-align:top;}
.webdesign-newsLetterFive .terms-box {text-align: center; margin:10px 0;}
.webdesign-newsLetterFive .subscribeThreebutton {padding: 15px; max-width: 200px; margin: 5px auto;display: block;}
.webdesign-newsLetterFive .email-textbox{padding:10px;}
.webdesign-newsLetterFive .left-div h1 {font-size: 38px;padding: 0;line-height: 40px;margin:15px 5px 5px !important;}
.webdesign-newsLetterFive p{margin:10px 5px 0;}
</style>
<?php 
}
?>
<style>
.terms-box{
	color:#fff;
}
.thanksText{color:#fff;}
</style>
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