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
	//print_r($decodedData);
	?> 
	<script>
	jQuery(window).load(function(e) {
        jQuery(".subscribebox_<?php echo $newsletter->id;?>").slideDown();
    });
	jQuery(document).ready(function(){
		 jQuery(".close_<?php echo $newsletter->id;?>").click(function(e){
			 e.preventDefault();
			jQuery(".subscribebox_<?php echo $newsletter->id;?>").fadeOut();
		});
	});
	</script>
<style>

#main_bar{
 width:100%;
 position: fixed;
 z-index:99999;
 <?php echo $decodedData['wp_newsletter-popup-barposition']?>:<?php echo $decodedData['wp_newsletter_mintopbottommargin'] ?>px;
}
.subscribe_bar_pop .newsletter-box2{
 width:100%;
 background:#1998b8;
 margin: 0px auto;
 padding: 15px;
 position: relative;
 text-align:center;
}
.subscribe_bar_pop .subscribeTwobox{

    margin: 5px;
    padding: 15px;
    display: inline-block;
}
.subscribe_bar_pop .subscribeTwobox h1{
 color:#fff;
 text-transform:uppercase;
 font-size: 17px;
 line-height: 19px;
 / font-weight: 800; /
}
.subscribe_bar_pop .name-textbox{
 background: #fff !important;
    color: #808080 !important;
    padding: 15px !important;
    border: none !important;
    / margin: 10px; /
    font-size: 16px !important;
    border-radius: 0px !important;
    box-sizing: border-box !important;
    -moz-box-sizing: border-box !important;
    -webkit-box-sizing: border-box !important;
    / float: left; /
    margin: 5px;
}
.subscribe_bar_pop .subscribeTwobutton{
 margin: 20px !important;
    color: #fff !important;
    text-transform: uppercase !important;
    padding: 15px !important;
    background: #5bb55d;
    border: none !important;
    font-size: 15px;
    font-weight: 600 !important;
    width: 175px !important;
    border: solid 2px #fff !important;
    border-radius: 5px !important;
}
.subscribe_bar_pop .newsletter-box-logo{
 text-align:center;
}
.subscribe_bar_pop .thanksTxt{
 padding:10px 0 0;
}
.subscribe_bar_pop .thanksTxt a{
 text-decoration: underline;
    font-size: 14px;
    color: #fff;
    / padding: 10px 30px; /
    margin: auto;
    /*float: left;*/
    margin: 5px;
}
.subscribe_bar_pop .error {
    color: #ff0000;
    text-align: center;
	display:block;
}
</style>
<?php 
/*style of arrow btn*/
if($decodedData['wp_newsletter_closeposition']=="top-left-inside")
{?>
<style>
.subscribe_bar_pop #close {
    position: absolute;
    left:-2px;
    top: 4px;
    width: 32px;
    height: 32px;
    opacity: 1;
    color: #fff;
}
.subscribe_bar_pop #close:before, .subscribe_bar_pop #close:after {
  position: absolute;
  left: 15px;
  content: ' ';
  height: 20px;
  width: 2px;
  background-color: #fff;
}
</style>
<?php }else if($decodedData['wp_newsletter_closeposition']=="top-right-inside")
{?>
<style>
.subscribe_bar_pop #close {
    position: absolute;
    right: -1px;
    top: 5px;
    width: 32px;
    height: 32px;
    opacity: 1;
    color: #fff;
    border-radius: 100px;
}
.subscribe_bar_pop #close:before, .subscribe_bar_pop #close:after {
    position: absolute;
    left: 15px;
    content: ' ';
    height: 15px;
    width: 2px;
    background-color: #fff;
    top: 7px;
}
</style>
<?php }else if($decodedData['wp_newsletter_closeposition']=="top-right-outside")
{?>
<style>
.subscribe_bar_pop #close {
    position: absolute;
    right: -1px;
    top: -15px;
    width: 32px;
    height: 32px;
    opacity: 1;
    color: #fff;
    background: #333;
    border-radius: 100px;
}
.subscribe_bar_pop #close:before, .subscribe_bar_pop #close:after {
    position: absolute;
    left: 15px;
    content: ' ';
    height: 15px;
    width: 2px;
    background-color: #fff;
    top: 7px;
}
</style>
<?php }else if($decodedData['wp_newsletter_closeposition']=="top-left-outside")
{?>
<style>
.subscribe_bar_pop #close {
    position: absolute;
    left: -1px;
    top: -15px;
    width: 32px;
    height: 32px;
    opacity: 1;
    color: #fff;
    background: #333;
    border-radius: 100px;
}
.subscribe_bar_pop #close:before, .subscribe_bar_pop #close:after {
    position: absolute;
    left: 15px;
    content: ' ';
    height: 15px;
    width: 2px;
    background-color: #fff;
    top: 7px;
}

</style>
<?php }?>

<style>

.subscribe_bar_pop #close:before {
  transform: rotate(45deg);
}
.subscribe_bar_pop #close:after {
  transform: rotate(-45deg);
}
.subscribe_bar_pop .chk_dv{
 color:#fff;
}
.subscribe_bar_pop .bot_wrap .btn_dv{
 /*display:block;
 padding:0px 20px;*/
}
.subscribe_bar_pop .bot_wrap
{
 display:inline-block;
}
.subscribe-box-form
{
 display:inline-block;
}
.subscribe_bar_pop .privacy-text {
  display: inline-block;
 margin:10px;
 color:#fff;
 width:100%;
}

@media (max-width:1024px){
.subscribe_bar_pop .subscribeTwobox{padding:5px !important;}
.subscribe_bar_pop .newsletter-box2 {
    overflow-y: auto;
}
.subscribe-box-form {
    padding: 5px 175px !important;
}
.subscribe_bar_pop .subscribeTwobox h1{padding:5px !important;}
}
@media (max-width:991px){
.subscribe-box-form {padding: 5px 60px !important;}
}

@media (max-width:800px){
.subscribe_bar_pop .subscribeTwobox{width: 100%;padding:0;}
.subscribe_bar_pop .newsletter-box2{padding:0;}
.subscribe_bar_pop .subscribeTwobox h1{text-align: center;padding: 15px;}
.subscribe_bar_pop .privacy-text{ margin:10px 0;}
.subscribe_bar_pop #close {left: -2px; top: 4px;}
}
@media (max-width:767px){
.subscribe_bar_pop .newsletter-box2 {
    overflow-y: auto;
	max-height:80vh;
}
.subscribe-box-form {
    padding: 5px !important;
}
}
@media (max-width:739px){
.subscribe_bar_pop .subscribeTwobox{ padding: 22px; }
.subscribe_bar_pop .newsletter-box2{padding: 10px;width: auto;}
.subscribe_bar_pop .subscribeTwobox h1{text-align: center; padding: 15px;}
.subscribe_bar_pop .thanksTxt {padding: 0 0 0 !important;}
.subscribe_bar_pop .name-textbox{float: none !important;padding: 15px;margin: 10px 0;}
.subscribe_bar_pop .textcenter{ text-align:center;}
.subscribe_bar_pop .subscribeTwobutton{width:100%;margin:0;}
.subscribe_bar_pop .subscribeTwobox h1{text-align: center;padding: 15px;font-size: 17px;}
}
@media (max-width:480px)
{
 .subscribe_bar_pop .thanksTxt{margin: auto; display:block;padding: 0 0 15px;}
}
@media (max-width:320px)
{
.subscribe_bar_pop .name-textbox{margin:10px 0 !important;}
.subscribe_bar_pop .newsletter-box2{padding:5px;}
.subscribe_bar_pop .subscribeTwobox h1 {font-size: 18px;line-height: 25px;}
.subscribe_bar_pop #close {left: -1px;top: 3px;}
}


</style>
<?php $count =0;?>

    		<div id="main_bar" class="subscribe_bar_pop subscribebox_<?php echo $newsletter->id;?>" style="display: none;">
				<div class="newsletter-box2" style="border-radius:<?php echo $decodedData['wp_newsletter_radius']; ?>; box-shadow:<?php echo $decodedData['wp_newsletter_bordershadow']; ?>;<?php if(!empty($decodedData['wp_newsletter_backgroundimage'])){ ?>background:<?php echo $decodedData['wp_newsletter_backgroundimage'];?>;background-repeat:<?php echo $decodedData['wp_newsletter_backgroundimagerepeat'];?>;background-position:<?php echo $decodedData['wp_newsletter_backgroundimageposition'];?>;<?php } else {?>background:<?php echo $decodedData['wp_newsletter_backgroung_color']; }?>;">
				<?php if(!empty($decodedData['wp_newsletter_ribbon_show']) && ($decodedData['wp_newsletter_ribbon_show'] == 1)):?>
				<div class="ribbon" style="<?php echo $decodedData['wp_newsletter_ribboncss'];?>position:absolute;"><img src=" <?php echo $decodedData['wp_newsletter_ribbon']; ?>" /></div>
				<?php endif; if(!empty($decodedData['wp_newsletter_logo'])): ?>
				<div class="newsletter-box-logo"><img src="<?php echo $decodedData['wp_newsletter_logo']; ?>"></div>
				<?php endif; ?>
					<div class="subscribeTwobox">
					<h1 style="color:<?php echo $decodedData['wp_newsletter_heading_color'];?>"><?php echo $decodedData['wp_newsletter_heading']; ?></h1>
						<?php if(!empty($decodedData['wp_newsletter_close_btn_show']) && ($decodedData['wp_newsletter_close_btn_show'] == 1)):?>
						 <a href="javascript:void(0)" id="close"  class="close_<?php echo $newsletter->id;?>"></a>
						 <?php endif; ?>
					</div>
					<span class="error" id="error_<?php echo $newsletter->id;?>"></span>                
         <form class="subscribe-box-form" name="nl_<?php echo $newsletter->id;?>" id="nl_<?php echo $newsletter->id;?>">
	<!-- Email -->
	<?php if(isset($decodedData['wp_newsletter_showemail'])&& $decodedData['wp_newsletter_showemail'] == '1') {
$count++;		?>
	<input class="name-textbox subscribe-box-email validate_<?php echo $newsletter->id;?> email_validate_<?php echo $newsletter->id;?> custom-input" name="<?php echo $decodedData['wp_newsletter_emailfieldname'];?>" placeholder="<?php echo $decodedData['wp_newsletter_email'];?>"  style="width:<?php echo $decodedData['wp_newsletter_emailinputwidth'];?>px;" type="text">
	<?php } ?>
	
	<!-- Name -->
	<?php if(isset($decodedData['wp_newsletter_showname'])&& $decodedData['wp_newsletter_showname'] == '1') {
$count++;?>
	<input class="name-textbox subscribe-box-email validate_<?php echo $newsletter->id;?> custom-input" name="<?php echo $decodedData['wp_newsletter_namefieldname'];?>"  style="width:<?php echo $decodedData['wp_newsletter_nameinputwidth'];?>px;" placeholder="<?php echo $decodedData['wp_newsletter_name'];?>" type="text">
	<?php } ?>
	
	<!-- First Name -->
	<?php if(isset($decodedData['wp_newsletter_showfirstname'])&& $decodedData['wp_newsletter_showfirstname'] == '1') { 
	$count++;?>
	<input class="name-textbox subscribe-box-email validate_<?php echo $newsletter->id;?> custom-input" name="<?php echo $decodedData['wp_newsletter_firstnamefieldname'];?>" style="width:<?php echo $decodedData['wp_newsletter_firstnameinputwidth'];?>px;" placeholder="<?php echo $decodedData['wp_newsletter_firstname'];?>" type="text">
	<?php } ?>
	
	<!-- Last Name -->
	<?php if(isset($decodedData['wp_newsletter_showlastname'])&& $decodedData['wp_newsletter_showlastname'] == '1') {$count++;	?>
	<input class="name-textbox subscribe-box-email validate_<?php echo $newsletter->id;?> custom-input" name="<?php echo $decodedData['wp_newsletter_lastnamefieldname'];?>"  style="width:<?php echo $decodedData['wp_newsletter_lastnameinputwidth'];?>px;"placeholder="<?php echo $decodedData['wp_newsletter_lastname'];?>" type="text">
	<?php } ?>
	
	<!-- Phone -->
	<?php if(isset($decodedData['wp_newsletter_showphone'])&& $decodedData['wp_newsletter_showphone'] == '1') {
$count++;	?>
	<input class="name-textbox subscribe-box-email validate_<?php echo $newsletter->id;?> custom-input" name="<?php echo $decodedData['wp_newsletter_phonefieldname'];?>" style="width:<?php echo $decodedData['wp_newsletter_phoneinputwidth'];?>px;" placeholder="<?php echo $decodedData['wp_newsletter_phone'];?>" type="text">
	<?php } ?>
	
	<!-- company -->
	<?php if(isset($decodedData['wp_newsletter_showcompany'])&& $decodedData['wp_newsletter_showcompany'] == '1') {
$count++;	?>
	<input class="name-textbox subscribe-box-email validate_<?php echo $newsletter->id;?> custom-input" name="<?php echo $decodedData['wp_newsletter_companyfieldname'];?>" style="width:<?php echo $decodedData['wp_newsletter_companyinputwidth'];?>px;" placeholder="<?php echo $decodedData['wp_newsletter_company'];?>" type="text">
	<?php } ?>
	
	<!-- zip -->
	<?php if(isset($decodedData['wp_newsletter_showzip'])&& $decodedData['wp_newsletter_showzip'] == '1') {
$count++;	?>
	<input class="name-textbox subscribe-box-email validate_<?php echo $newsletter->id;?> custom-input" name="<?php echo $decodedData['wp_newsletter_zipfieldname'];?>" style="width:<?php echo $decodedData['wp_newsletter_zipinputwidth'];?>px;" placeholder="<?php echo $decodedData['wp_newsletter_zip'];?>" type="text">
	<?php } ?>
	
	<!-- msg -->
	<?php if(isset($decodedData['wp_newsletter_showmessage'])&& $decodedData['wp_newsletter_showmessage'] == '1') {$count++; ?>
	<textarea class="name-textbox subscribe-box-email validate_<?php echo $newsletter->id;?> custom-input" name="<?php echo $decodedData['wp_newsletter_messagefieldname'];?>" placeholder="<?php echo $decodedData['wp_newsletter_message'];?>" style="width:<?php echo $decodedData['wp_newsletter_messageinputwidth'];?>px;"></textarea>
	<?php } ?>
	<!-- terms -->
    <div class="bot_wrap">
    <span class="chk_dv">
	<?php if(isset($decodedData['wp_newsletter_showterms'])&& $decodedData['wp_newsletter_showterms'] == '1') { ?>
	<input type="checkbox" value="Yes" name="TERMS" <?php echo($decodedData['wp_newsletter_termsrequired'] == '1') ? 'required' : '';?>/ <?php if($decodedData['wp_newsletter_termsrequired'] == '1') {?>id="term_<?php echo $newsletter->id;?>"<?php }?>> <?php echo $decodedData['wp_newsletter_terms'];?>
<span id="error_terms_<?php echo $newsletter->id;?>" class="error"></span>
	<?php }else{ $wp_newsletter_showterms=0;} ?> </span>
					<span class="btn_dv"><input class="subscribe-box-action subscribeTwobutton" name="subscribe-box-action" value="<?php if(!empty($decodedData['wp_newsletter_action'])) { echo  $decodedData['wp_newsletter_action']; } else { echo "Subscribe";  } ?>" id="subscribe-box-action-<?php echo $newsletter->id;?>" type="button">			</span>		
					<span class="thanksTxt"> <a href="#" class="thanksTxt close_<?php echo $newsletter->id;?>"><?php if(!empty($decodedData['wp_newsletter_cancel'])) { echo  $decodedData['wp_newsletter_cancel']; } else { echo "No Thanks";  } ?></a></span> </div> <!--bot_wrap-->
				          <div class="subscribe-box-afteractionmessage" style="display:none"></div>
				</form> 
					<?php if(!empty($decodedData['wp_newsletter_privacy_show']) && ($decodedData['wp_newsletter_privacy_show']==1)){
						if($count == 4):
						?>
					<style>
					.subscribe_bar_pop .thanksTxt a{display:block !important;}
					</style>
							
						<?php endif;
						?>
					<div class="privacy-text" style="color:<?php echo $decodedData['wp_newsletter_privacy_color']; ?>"><?php echo $decodedData['wp_newsletter_privacy'];?></div>
					<?php } ?>				
			    </div>            
            </div>
            
            
            
				<?php

/*Code without terms and conditions*/
if(($count == 1  || $count == 2 ) && isset($wp_newsletter_showterms)&& $wp_newsletter_showterms == '0' )
{?>
  <style>
  .subscribe_bar_pop .newsletter-box2 {
    padding: 5px 55px;
}
.subscribe_bar_pop .subscribeTwobox {
    margin: 10px;
    padding: 22px 0;
    float: left;
    text-align: right;
}
.subscribe_bar_pop .name-textbox {
    float: left;
    margin: 5px 5px;
}
.subscribe-box-form {
 display: block;
 line-height:2px;
 padding:10px;
 }

	.subscribe_bar_pop .bot_wrap {
    overflow: auto;
	display:block;
	}
	.subscribe_bar_pop .subscribeTwobutton {
    float: left;
	margin: 5px 15px !important;
	padding: 18px !important;
}
.subscribe_bar_pop .thanksTxt {
    padding: 10px 0;
}
.subscribe_bar_pop .thanksTxt a {
    color: #fff;
    float: left;
    margin: 20px 0;
}
	</style>
<?php }
if(($count == 1 ) && isset($wp_newsletter_showterms)&& $wp_newsletter_showterms == '0' ){
?>
<style>
.subscribe-box-form {
    display: inline-block;
    line-height: 2px;
    padding: 10px;
}
.subscribe_bar_pop .bot_wrap {
    overflow: auto;
    display: inline-block;
}

.subscribe_bar_pop .newsletter-box2 {
    padding: 5px 200px;
}
.subscribe_bar_pop .subscribeTwobox {
    margin: 10px;
    padding: 22px 0;
    float: left;
    text-align: left;
}
</style>
<?php }
if(( $count == 4 || $count == 8) && isset($wp_newsletter_showterms)&& $wp_newsletter_showterms == '0' )
{?>
	
 <style>
	.subscribe_bar_pop .subscribeTwobox {
    
    margin: 5px auto;
    padding: 15px;
    display: block;
}
.subscribe_bar_pop .name-textbox {
    float: left;
    margin: 10px;
}
.newsLetter .email-textbox {
    max-width: 345px;
    margin: 15px auto;
    float: left;
    margin: 4px;
    margin-bottom: 15px;
}
.subscribe-box-form {
    display: inline-block;
    padding: 5px 15px;
}
.subscribe_bar_pop .subscribeTwobutton {
    margin: 7px auto;
    display: block;
}

	</style>
<?php }
if(( $count == 3|| $count == 6) && isset($wp_newsletter_showterms)&& $wp_newsletter_showterms == '0' )
{?>
	
 <style>
	.subscribe_bar_pop .subscribeTwobox {
    
    margin: 5px auto;
    padding: 15px;
    display: block;
}
.subscribe_bar_pop .name-textbox {
    float: left;
    margin: 10px;
}
.subscribe_bar_pop .name-textbox {
    max-width: 350px;
    width: 100%;
}
.subscribe_bar_pop .subscribeTwobutton {
    margin: 7px auto;
    display: block;
}
.subscribe-box-form {
    padding: 8px 150px;
    margin: 0;
}
</style>
<?php }
if(( $count == 5|| $count == 7) && isset($wp_newsletter_showterms)&& $wp_newsletter_showterms == '0' )
{?>
<style>
.subscribe_bar_pop .bot_wrap {
    display: block;
}
.subscribe_bar_pop .chk_dv {
    color: #fff;
    display: block;
    margin: auto;
}
.subscribe_bar_pop .subscribeTwobutton {
    margin: 10px auto !important;
    display: block;
}
.subscribe_bar_pop .name-textbox {
    float: none;
	margin:10px;
    display: inline-block;
}
.subscribe-box-form {
    display: inline-block;
    padding: 5px 175px;
}
</style>
<?php }?>


<?php 
/*style With Terms and conditions*/
if(isset($decodedData['wp_newsletter_showterms'])&& $decodedData['wp_newsletter_showterms'] == '1') {
if($count == 7):
?>
<style>
	.subscribe_bar_pop .subscribeTwobox {
  
    margin: 5px auto;
    padding: 15px;
    display: block;
}
.subscribe_bar_pop .name-textbox {
    float: left;
    margin: 5px 10px 15px;

}
.subscribe_bar_pop .name-textbox {
    max-width: 350px;
    width: 100%;
}
.subscribe_bar_pop .subscribeTwobutton {
    margin: 10px auto !important;
    display: block;
}
.subscribe-box-form {
    padding: 5px 179px;
    margin: 0;
}
.box-center {
    display: block !important;
    float: none !important;
    margin: 10px auto !important;
}


	</style>
<?php elseif($count == 4 || $count == 8):
?>
<style>
.subscribe_bar_pop .subscribeTwobox {
    
    margin: 5px auto;
    padding: 15px;
    display: block;
}
.subscribe_bar_pop .name-textbox {
    float: left;
    margin: 10px;
}
.newsLetter .email-textbox {
    max-width: 345px;
    margin: 15px auto;
    float: left;
    margin: 4px;
    margin-bottom: 15px;
}
.subscribe-box-form {
    display: inline-block;
    padding: 5px 15px;
}
.subscribe_bar_pop .subscribeTwobutton {
    margin: 7px auto;
    display: block;
}
</style>
<?php elseif($count == 3 || $count == 6):?>
 <style>
	.subscribe_bar_pop .subscribeTwobox {
   
    margin: 5px auto;
    padding: 15px;
    display: block;
}
.subscribe_bar_pop .name-textbox {
    float: left;
    margin: 10px;
}
.subscribe_bar_pop .subscribeTwobutton {
    margin: 7px auto;
    display: block;
}
.subscribe-box-form {
    padding: 8px 150px;
    margin: 0;
}
</style>
<?php elseif($count == 1 || $count == 2):?>
<style>
.subscribe_bar_pop .subscribeTwobox {
    display: block;
    margin: auto;
}
.subscribe_bar_pop .name-textbox {
    float: none;
    margin: 5px 5px;
    display: inline-block;
}
.subscribe_bar_pop .subscribeTwobutton {
    margin: 10px auto !important;
    display: block;
}
.subscribe_bar_pop .bot_wrap {
    display: block;
}
.subscribe_bar_pop .chk_dv {
    display: inline-block;
    margin: 10px 0 0;
}
</style>
<?php elseif($count == 5):?>
<style>
.subscribe_bar_pop .bot_wrap {
    display: block;
}
.subscribe_bar_pop .chk_dv {
    color: #fff;
    display: block;
    margin: auto;
}
.subscribe_bar_pop .subscribeTwobutton {
    margin: 10px auto !important;
    display: block;
}
.subscribe_bar_pop .name-textbox {
    float: none;
	margin:10px;
    display: inline-block;
}
.subscribe-box-form {
    display: inline-block;
    padding: 5px 175px;
}
</style>
<?php endif;
}?>



			<script>
	jQuery(document).ready(function() {
		var count = 0;
		jQuery( ".custom-input" ).each(function( i ) {			
			count++;
		});
		//alert(count);
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
					//alert(response);
				var obj = jQuery.parseJSON(response);
				var action = obj.action;
				if(action == 'close')
				{
				   jQuery(".subscribebox_<?php echo $newsletter->id;?>").hide();
				   jQuery("subscribebox_<?php echo $newsletter->id;?>").hide();	
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
<?php }} ?> 