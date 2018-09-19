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
.webdesign .newsLetterFour
{
	width: 100%;
	max-width: 640px;
	padding: 25px 0 25px;
	border: 30px solid;
	-webkit-border-image: url(<?php echo plugins_url( 'images/borderbg.png',__FILE__); ?>) 30 round; /* Safari 3.1-5 */
	-o-border-image: url(<?php echo plugins_url( 'images/borderbg.png',__FILE__); ?>) 30 round; /* Opera 11-12.1 */
	border-image: url(<?php echo plugins_url( 'images/borderbg.png',__FILE__); ?>) 30 round;
	margin: 0px auto;
	position: relative;
	z-index: 9999;
	background: #f4f4ee;
	margin-top: <?php echo $decodedData['wp_newsletter_mintopbottommargin'].''.'px';?>;
}

.webdesign .newsLetterFour h1
{
	color: <?php if(isset($decodedData['wp_newsletter_heading_color'])&& !empty($decodedData['wp_newsletter_heading_color'])) { echo $decodedData['wp_newsletter_heading_color']; }else{ echo "#404040";}?>;
	font-weight: bold;
	font-size: 40px;
	text-align: center;
	letter-spacing: 1px;
	font-family: 'Oswald', sans-serif;
	margin:25px 0px 0px;
}
.webdesign  .newsLetterFour p
{
	text-align: center;
	line-height: 25px;
	padding: 15px 0;
	color: #333;
	font-family: 'Open Sans', sans-serif;
	font-size: 16px;
}
.webdesign .newsLetterFour .subscribeThreebutton
{
	font-family: 'Poppins', sans-serif;
	background: #7ab52d;
	color: #fff;
	padding: 24px;
	border-radius: 0px 100px 100px 0;
	text-transform: uppercase;
	margin: 10px 0;
	display: inline-block;
	border: none;
	font-weight:600;
	letter-spacing:2px;
	max-width: 200px;
	width: 100%;
}
.webdesign  .newsLetterFour .email-textbox
{
	padding: 19px;
	width: 100%;
	max-width: 360px;
	margin: 10px 0px 0 10px;
	display: block;
	box-sizing: border-box;
	font-family: 'Open Sans', sans-serif;
	font-size: 15px;
	color: #808080;
	float: left;
	border-radius: 100px 0 0 100px;
}
.webdesign  .newsLetterFour .iconImg
{
	width: 60%;
	text-align: center;
	position: relative;
	display: block;
	margin: auto;
}
.webdesign  .newsLetterFour .icon
{
	position: relative;
	margin: auto;
	display: block;
	width: 100%;
	padding: 15px 0 25px;
	max-width: 100px;
}
.webdesign .newsLetterFour .iconImg:before
{
	content: '';
	border-top: solid 1px #ccc;
	position: absolute;
	width: 100%;
	height: 2px;
	top: 15px;
	left: 0;
}
.webdesign  .newsLetterFour .thanksText
{
	width:100%;
	text-align:center;
}
.forbesImg
{
	max-width: 280px;
    width: 100%;
}
.webdesign  .newsLetterFour .close-button {
  position: absolute;
  right: -17px;
  top: -11px;
  width: 40px;
  height: 40px;
  border-radius: 100%;
   background: <?php if(isset($decodedData['wp_newsletter_close_bg_color']) && !empty($decodedData['wp_newsletter_close_bg_color'])){ echo $decodedData['wp_newsletter_close_bg_color'];}else{ echo "#fff;";}?>;
  padding: 6px 0;
  z-index:99999;
}
.webdesign .newsLetterFour .close-button:hover {
    background: <?php if(isset($decodedData['wp_newsletter_close_hover']) && !empty($decodedData['wp_newsletter_close_hover'])){ echo $decodedData['wp_newsletter_close_hover'];}else{ echo "#fff;";}?>;
    transition: .2s;
}

.webdesign  .newsLetterFour .close-button:before, .close-button:after {
  position: absolute;
  left: 0px;
  content: ' ';
  height: 23px;
  width: 2px;
  background-color: #df4444;
  top: 10px;
}
.webdesign  .newsLetterFour .close-button:before {
  transform: rotate(45deg);
}
.webdesign  .newsLetterFour .close-button:after {
  transform: rotate(-45deg);
}
.webdesign .newsLetterFour .terms-box
{
	width:100%;
	display:block;
	text-align:center;
}
@media only screen and (max-width:1024px)
{
	.webdesign  .newsLetterFour .email-textbox{;max-width: inherit;margin: 10px 0;border-radius: 100px;}
	.webdesign  .newsLetterFour .subscribeThreebutton{width:100%;max-width: inherit;margin: 10px auto 0 0;border-radius: 100px;}
}
@media only screen and (max-width:767px)
{
	.webdesign  .newsLetterFour h1{font-size: 60px;}
	.webdesign  .newsLetterFour .email-textbox{;max-width: inherit !important;}
	.webdesign  .news-box{overflow-y:auto; max-height:80vh; overflow-x:hidden;}
}
@media only screen and (max-width:479px)
{
	.webdesign  .newsLetterFour h1{font-size: 30px;}
	.webdesign  .newsLetterFour{padding: 10px;}
}
@media only screen and (max-width:374px)
{
	.webdesign  .newsLetterFour h1{font-size: 26px;}
}
@media only screen and (max-width:320px)
{
	.webdesign  .newsLetterFour .subscribeThreebutton{ padding:15px;}
	.webdesign  .newsLetterFour .email-textbox{padding:10px;}
}
.error_container {
    text-align: center;
    color: #ff0000;
}
.ribbon{
	background:url(<?php echo $decodedData['wp_newsletter_ribbon']; ?>) no-repeat;
	position:absolute;
	top: -37px !important;
    left: -38px !important;
	z-index: 99999;
}
.privacy-text {
    text-align: center;
	color:#333;
}
</style>

<?php 
/*style of arrow btn*/
if($decodedData['wp_newsletter_closeposition']=="top-left-inside")
{?>
<style>
.webdesign .newsLetterFour .close-button {
    left: -19px;
    top: -39px;
	background:none;
}
.webdesign .newsLetterFour .close-button:hover{
	background:none;
}
</style>
<?php }else if($decodedData['wp_newsletter_closeposition']=="top-right-inside")
{	?>
<style>
.webdesign .newsLetterFour .close-button {
     right: -20px;
    top: -11px;
	background:none;
}
.webdesign .newsLetterFour .close-button:before, .close-button:after {
    left: 20px;
}
.webdesign .newsLetterFour .close-button:hover{
	background:none;
}
</style>
<?php }else if($decodedData['wp_newsletter_closeposition']=="top-left-outside")
{?>
<style>
.webdesign .newsLetterFour .close-button {
    left: -45px;
    top: -40px;
    background: #fff;
}
.webdesign .newsLetterFour .close-button:before, .close-button:after {
    left: 18px;
	top:9px;
}
</style>
<?php }else if($decodedData['wp_newsletter_closeposition']=="top-right-outside")
{?>
<style>
.webdesign .newsLetterFour .close-button {
    right: -45px;
    top: -42px;
    background: #fff;
}
.webdesign .newsLetterFour .close-button:before, .close-button:after {
    left: 19px;
	top:9px;
}
</style>
<?php }?>
<?php $count = 0;?>
<div id="main-div" class="subscribebox_<?php echo $newsletter->id;?>" style="display: none;">

	<div class="webdesign">
    <div class="animated <?php echo $decodedData['wp_newsletter_animation'];?>">
    <div class="newsLetterFour" style="border-radius:<?php echo $decodedData['wp_newsletter_radius'].'px'; ?>; box-shadow:<?php echo $decodedData['wp_newsletter_bordershadow']; ?>;<?php if(!empty($decodedData['wp_newsletter_backgroundimage'])){ ?>background:url(<?php echo $decodedData['wp_newsletter_backgroundimage'];?>);background-repeat:<?php echo $decodedData['wp_newsletter_backgroundimagerepeat'];?>;background-position:<?php echo $decodedData['wp_newsletter_backgroundimageposition'];?>;<?php } else {?>background:<?php echo $decodedData['wp_newsletter_backgroung_color']; }?>;">
            <div class="news-box">
         <?php
	if(isset($decodedData['wp_newsletter_ribbon_show'])&& $decodedData['wp_newsletter_ribbon_show'] == '1') {
		?>
	<div class="ribbon" style="<?php echo $decodedData['wp_newsletter_ribboncss'];?>"><img src=" <?php echo $decodedData['wp_newsletter_ribbon']; ?>" /></div>
	<?php }?>
			<div class="icon">
			  <img src="<?php echo plugins_url( 'images/icon-1.png',__FILE__); ?>"/> 
			 </div>
			<h1><?php echo $decodedData['wp_newsletter_heading'];?></h1>
			<div id="popupfoot">
				<a href="#" title="<?php if(isset($decodedData['wp_newsletter_closetip_show'])&& $decodedData['wp_newsletter_closetip_show'] == '1'){echo stripslashes($decodedData['wp_newsletter_closetip']);}?>" class="close-button close_<?php echo $newsletter->id;?> agree"></a>
			</div>
			<p style="color:<?php if(isset($decodedData['wp_newsletter_description_color'])&& !empty($decodedData['wp_newsletter_description_color'])) { echo $decodedData['wp_newsletter_description_color']; }else{ echo "#333";}?>;"><?php echo $decodedData['wp_newsletter_description'];?></p>
			<div class="feature-text">
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
					<?php }else {   $wp_newsletter_terms =0; }


					?>		
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
		
</div></div>

<?php 

if($count == 1 && $wp_newsletter_terms == 0){
	?>
	<style>
	.webdesign .newsLetterFour .subscribeThreebutton {padding: 24px 24px !important;}
		</style>
<?php }?>
<?php
if($count == 1 && (isset($decodedData['wp_newsletter_showterms'])&& $decodedData['wp_newsletter_showterms'] == '1')){
	?>
	<style>
	.webdesign  .newsLetterFour .email-textbox	{margin: 10px auto;display: block;float: none;border-radius: 100px;}
	.webdesign .newsLetterFour .subscribeThreebutton {border-radius: 100px; margin: 10px auto;display: block;}
	</style>
	
<?php }?>
<?php
if($count == 3 || $count == 5 || $count==7){?>
	<style>
.webdesign .newsLetterFour{padding: 0px 0;}
.webdesign .newsLetterFour .email-textbox {margin: 3px 3px;border-radius: 100px;max-width:280px; padding:10px 20px;display: inline-block; vertical-align:top;float:none;}
.webdesign .newsLetterFour .terms-box {display: inline-block;text-align: center;}
.webdesign .newsLetterFour .subscribeThreebutton{display:block; border-radius:100px; margin:5px auto;}
.webdesign .newsLetterFour h1 {font-size: 25px;}
.webdesign .newsLetterFour p {padding: 0px;margin:0px;}
.webdesign .newsLetterFour .subscribeThreebutton{padding:15px;}
.webdesign  .newsLetterFour .icon{padding:0px;}
.webdesign  .newsLetterFour .box-center{float:none; display:block; margin:5px auto;}
</style>	
<?php
}elseif($count == 2 || $count == 4 || $count==6 || $count==8)
{?>
<style>
.webdesign .newsLetterFour{padding: 0px 0;}
.webdesign .newsLetterFour .email-textbox {margin: 3px 3px;display: inline-block;border-radius: 100px;max-width:280px; padding:10px 20px;vertical-align:top; float:none;}
.webdesign .newsLetterFour .terms-box {display: inline-block;text-align: center;}
.webdesign .newsLetterFour .subscribeThreebutton{display:block; border-radius:100px; margin:5px auto;}
.webdesign .newsLetterFour h1 {font-size: 25px;}
.webdesign .newsLetterFour p {padding: 0px 0;margin:0px;}
.webdesign .newsLetterFour .subscribeThreebutton{padding:15px;}
.webdesign  .newsLetterFour .icon{padding:0px;}
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