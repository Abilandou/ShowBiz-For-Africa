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
::-webkit-input-placeholder { color:#404040;font-size:13px; }
::-moz-placeholder { color:#404040;font-size:13px }
:-ms-input-placeholder { color:#404040; font-size:13px; }
input:-moz-placeholder { color:#404040;font-size:13px; }
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
.webdesign .newsletterTen
{
	width: 100%;
	max-width: 640px;
	padding: 45px;
	border-radius: 3px;
	background:url(<?php echo plugins_url( 'images/popupbg9.jpg',__FILE__); ?>);
	background-size: 100%;
	margin: 1px auto;
	position: relative;
	z-index: 9999;
	background-repeat:repeat-y;
	background-position: right bottom;
	margin-top: <?php echo $decodedData['wp_newsletter_mintopbottommargin'].''.'px';?>;
}
.webdesign .newsletterTen::after{ display:table; content:''; clear:both;}

.webdesign .newsletterTen p
{
	text-align: left;
	line-height: 25px;
	padding: 15px 0;
	color: #333;
	font-family: 'Lora', serif;
	font-size: 18px;
	font-style: italic;
	
}
.webdesign .newsletterTen .wordpress-text
{
	text-transform:uppercase;
	font-weight: bold;
}
.webdesign .newsletterTen .subscribeThreebutton
{
	font-family: 'Poppins', sans-serif;
	background: #2c83aa;
	color: #fff;
	padding: 22px;
	text-transform: uppercase;
	margin: 0;
	display: block;
	border: none;
	font-weight: 600;
	letter-spacing: 2px;
	max-width: 350px;
	width: 100%;
}
.webdesign .newsletterTen .email-textbox
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
	vertical-align:top;
}
.forbesImg
{
	max-width: 280px;
    width: 100%;
}
.webdesign .newsletterTen .left-div
{
	width: 50%;
	float: left;
	position: relative;
	height: 100%;
}
.webdesign .newsletterTen .right-div
{
	width: 50%;
	float: right;
}
.webdesign .newsletterTen .right-div h1
{
	font-size: 29px;
	font-family: 'Poppins', sans-serif;
	font-weight: 100;
	color: #0e4a66;
	text-align: left;
	text-transform:uppercase;
}
.webdesign .newsletterTen .right-div p
{
	font-style:normal;
	text-align: left;
	padding: 10px;
	font-size: 15px;
	font-family: 'Lora', serif;
}
.mobileImg
{
	position: absolute;
	top: 110px;
	left: 10px;
}
.webdesign .newsletterTen .close-button {
  position: absolute;
  right: -17px;
  top: -11px;
  width: 40px;
  height: 40px;
  border-radius: 100%;
  padding: 6px 0;
  background: <?php if(isset($decodedData['wp_newsletter_close_bg_color']) && !empty($decodedData['wp_newsletter_close_bg_color'])){ echo $decodedData['wp_newsletter_close_bg_color'];}else{ echo "#2c83aa;";}?>;
  z-index:99999;
}

.webdesign .newsletterTen .close-button:hover {
    background: <?php if(isset($decodedData['wp_newsletter_close_hover']) && !empty($decodedData['wp_newsletter_close_hover'])){ echo $decodedData['wp_newsletter_close_hover'];}else{ echo "#05a396;";}?>;
    transition: .2s;
	
}
.webdesign .newsletterTen .close-button:before, .close-button:after {
  position: absolute;
  left: 19px;
  content: ' ';
  height: 23px;
  width: 2px;
  background-color: #fff;
  top: 8px;
}
.webdesign .newsletterTen .close-button:before {
  transform: rotate(45deg);
}
.webdesign .newsletterTen .close-button:after {
  transform: rotate(-45deg);
}
.webdesign .newsletterTen .terms-box{width:100%; text-align:center; margin:10px 0px;}
@media only screen and (max-width:1024px)
{
		.webdesign .newsletterTen .right-div p{padding: 10px 0 !important; margin:0px;}

}
@media only screen and (max-width:767px)
{
	.webdesign .newsletterTen .email-textbox{max-width: inherit !important; margin: 10px 0;}
	.webdesign .newsletterTen .bottom-bluediv{padding:30px 10px;}
	.webdesign .newsletterTen .subscribeThreebutton{max-width: inherit !important;margin: 10px auto 0 0;}
	.webdesign .newsletterTen h1{font-size: 60px;}
	.webdesign .newsletterTen .right-div{width:100% !important; float:none !important;}
	.mobileImg{position: relative; top:0;}
	.webdesign .newsletterTen .right-div h1{ font-size:33px !important; text-align:right !important;}
	.mobileImg img{width:100%; max-width: 260px; margin: auto;}
	.webdesign .newsletterTen{ padding-bottom: 0;}
	.news-box{overflow-y:auto; overflow-x:hidden; max-height:80vh;}
	.webdesign .newsletterTen{padding:0px  !important;}
	.webdesign .newsletterTen .subscribe-box-form{padding:15px}
}
@media only screen and (max-width:479px)
{
	.webdesign .newsletterTen h1{font-size: 45px;}
	.webdesign .newsletterTen .right-div{width:100%;}
	.mobileImg{position: relative;}
	.webdesign .newsletterTen .right-div h1{font-size:18px;}
	.mobileImg img{max-width:100px;}
	.webdesign .newsletterTen .right-div p {text-align: center;padding: 10px 10px 0;margin: 0;}
	.webdesign .newsletterTen .right-div h1 {font-size: 25px !important;text-align: right !important;padding: 15px;}
	}
@media only screen and (max-width:374px)
{
	.webdesign .newsletterTen h1{font-size: 35px;}
	.webdesign .newsletterTen .right-div{width:100%;}
	.mobileImg{position: relative;}
	.webdesign .newsletterTen .right-div h1{ font-size:18px; text-align:right;}
	.webdesign .newsletterTen .right-div h1 {font-size: 17px !important; text-align: right!important;margin: 35px 5px 0;}
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
.webdesign .newsletterTen .close-button {
    background: none;
    left: -5px;
    top: -7px;
}
</style>
<?php }else if($decodedData['wp_newsletter_closeposition']=="top-right-inside")
{	?>
<style>
.webdesign .newsletterTen .close-button{
	background:none;	
	right: 5px;
    top: 5px;
}
</style>
<?php }else if($decodedData['wp_newsletter_closeposition']=="top-left-outside")
{?>
<style>
.webdesign .newsletterTen .close-button {
    left: -17px;
}
</style>
<?php }else if($decodedData['wp_newsletter_closeposition']=="top-right-outside")
{?>
<style>
.webdesign .newsletterTen .close-button {
    right: -17px;
}
</style>
<?php }?>
<?php $count = 0;?>
<div id="main-div" class="subscribebox_<?php echo $newsletter->id;?>" style="display: none;">
 <div class="animated <?php echo $decodedData['wp_newsletter_animation'];?>">
<div class="webdesign">
		<div class="newsletterTen" style="border-radius:<?php echo $decodedData['wp_newsletter_radius'].'px'; ?>; box-shadow:<?php echo $decodedData['wp_newsletter_bordershadow']; ?>;<?php if(!empty($decodedData['wp_newsletter_backgroundimage'])){ ?>background:url(<?php echo $decodedData['wp_newsletter_backgroundimage'];?>);background-repeat:<?php echo $decodedData['wp_newsletter_backgroundimagerepeat'];?>;background-position:<?php echo $decodedData['wp_newsletter_backgroundimageposition'];?>;<?php } else {?>background:<?php echo $decodedData['wp_newsletter_backgroung_color']; }?>;">
        <div class="news-box">
		<?php
		/*For Ribbon icon*/
		if(isset($decodedData['wp_newsletter_ribbon_show'])&& $decodedData['wp_newsletter_ribbon_show'] == '1')
		{?>
		<div class="ribbon" style="<?php echo $decodedData['wp_newsletter_ribboncss'];?>"><img src=" <?php echo $decodedData['wp_newsletter_ribbon']; ?>" /></div>
		<?php }?>
			<div class="right-div">
				<!--For Heading--->
				<h1 style="color:<?php if(isset($decodedData['wp_newsletter_heading_color'])&& !empty($decodedData['wp_newsletter_heading_color'])) { echo $decodedData['wp_newsletter_heading_color']; }else{ echo "#fff";}?>;"><?php echo $decodedData['wp_newsletter_heading'];?></h1>
				<!--For Description--->
				<p style="color:<?php if(isset($decodedData['wp_newsletter_description_color'])&& !empty($decodedData['wp_newsletter_description_color'])) { echo $decodedData['wp_newsletter_description_color']; }else{ echo "#333";}?>;"><?php echo $decodedData['wp_newsletter_description'];?></p>
				<!---For close arrow --->
				<div id="popupfoot"><a href="#" title="<?php if(isset($decodedData['wp_newsletter_closetip_show'])&& $decodedData['wp_newsletter_closetip_show'] == '1'){echo $decodedData['wp_newsletter_closetip'];}?>" class="close-button close_<?php echo $newsletter->id;?> agree"></a></div>
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
			<div class="mobileImg">
				<!--img src="<?php //echo plugins_url( 'images/book.png',__FILE__); ?>" alt=""/-->
			</div>
		</div>
    </div>
</div>
</div>
	
</div>
<?php

if($count == 1 && (isset($wp_newsletter_showterms)&& $wp_newsletter_showterms == '0'))
{
	?>
	<style>
	
	</style>
<?php 
}
?>
<?php
if($count == 1 && (isset($decodedData['wp_newsletter_showterms'])&& $decodedData['wp_newsletter_showterms'] == '1')){
	?>
	<style>
	
	</style>
	
<?php }elseif($count == 3 || $count == 5 || $count==7){?>
	<style>
.webdesign .newsletterTen{padding: 45px 10px;}
.webdesign .newsletterTen .right-div{width:60%;}
.webdesign .newsletterTen .email-textbox{ margin:5px 0; max-width:180px; padding:10px; display:inline-block;}
.webdesign .newsletterTen .subscribeThreebutton{max-width:365px; margin:10px 0; padding:15px;}
.webdesign .newsletterTen .right-div p{padding:5px 0px 0px; margin:5px 0;}
.webdesign .newsletterTen .right-div h1{ font-size:21px; font-weight:500;}
.webdesign .newsletterTen .right-div .box-center{ float:none; display:block; margin:5px auto;}

	</style>
	
<?php
}elseif($count == 2 || $count == 4 || $count==6 || $count==8)
{?>
<style>
.webdesign .newsletterTen{padding: 45px 10px;}
.webdesign .newsletterTen .right-div{width:60%;}
.webdesign .newsletterTen .email-textbox{ margin:5px 0; max-width:180px; padding:10px; display:inline-block;}
.webdesign .newsletterTen .subscribeThreebutton{max-width:365px; margin:5px 0;padding:15px;}
.webdesign .newsletterTen .right-div p{padding:5px 0px 0px; margin:5px 0;}
.webdesign .newsletterTen .right-div h1{ font-size:21px; font-weight:500;}
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
	}/* End of foreach loop */
 }
 } /* End if */
?>