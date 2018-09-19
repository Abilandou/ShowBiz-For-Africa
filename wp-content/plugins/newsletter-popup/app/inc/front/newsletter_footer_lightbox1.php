<?php if ( ! defined( 'ABSPATH' ) ) exit; 
global $wpdb;
$tbl = $wpdb->prefix.'mk_newsletter_data';
$newsletters = $wpdb->get_results("select * from ".$tbl." where status = 'publish'");
$action = isset($_GET['action']) ? $_GET['action'] : '';
$cookieDelete = false;
if(!empty($newsletters) && is_array($newsletters ))
{ 
foreach($newsletters  as $newsletter) {
	$decodedData = json_decode($newsletter->data, true); ?>
    <script>
	jQuery(window).load(function(e) {
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
.error
	{
		color: #c00909;
	}
#main-div {
  height: 100vh;
  left: 0;
  margin: auto;
  position: fixed;
  top: 0;
  width: 100%;
  z-index: 9999;
  background: rgba(0, 0, 0, 0.8);
  padding: 0px 15px;
  box-sizing:border-box;
	-webkit-box-sizing:border-box;
}
.subscribe_lightbox_pop .newsLetter{
	width:100%;
	max-width:760px;
	padding: 60px 0 70px;
	background:#fff;
	background-size:cover;
	margin:0 auto;
	position: relative;
	margin-top:10%;
}
.subscribe_lightbox_pop .newsLetter h1{
	color:#404040;
	font-weight:bold;
	font-size: 34px;
	text-transform:uppercase;
	text-align:center;
	letter-spacing:5px;
	padding: 5px 0 10px;
	line-height: 45px;
}
.subscribe_lightbox_pop .newsLetter p{
	text-align:center;
	line-height:25px;
	color:#404040;
	font-size: 17px;
	font-family: 'Montserrat', sans-serif;
	text-transform:uppercase;
	letter-spacing:2px;
	font-weight:700;
	margin-top: 0px;
}
.subscribe_lightbox_pop .ribbon{
	background:url(<?php echo $decodedData['wp_newsletter_ribbon']; ?>) no-repeat;
	position:absolute;
	top: -8px;
	left: -8px;
}
.subscribe_lightbox_pop .heading_txt{
	padding:0 8%;
}
.subscribe_lightbox_pop .privacyTxt{
	padding: 35px;
	margin: auto;
	display: block;
	text-align: center;
}
.subscribe_lightbox_pop .privacyTxt a{
	text-decoration:underline;
	font-size:14px;
	color:#404040;
	padding:15px;
	margin: auto;
	text-align: center;
	font-family: 'Open Sans', sans-serif;
	letter-spacing: 1px;
}
.subscribe_lightbox_pop .email-textbox{
	font-family: 'Montserrat', sans-serif !important;
	background: #fafafa !important;
	color:#808080 !important;
	padding: 20px !important;
	margin:5px auto !important;
	font-size: 16px !important;
	width: 70% !important;
	box-sizing: border-box !important;
	-moz-box-sizing: border-box !important;
	-webkit-box-sizing: border-box !important;
	border: 1px solid #ddd !important;
	float: left ;
	font-weight:100 ;
	border-radius:0px !important;
	-webkit-border-radius:0px !important;
	border-right:none !important;
	height: 60px;
}
.subscribe_lightbox_pop .subscribeFourbutton{
	font-family: 'Montserrat', sans-serif !important;
	background: #e4971d !important;
	color: #fff !important;
	padding: 20px !important;
	text-transform: uppercase !important;
	border: none !important;
	font-weight: bold !important;
	letter-spacing: 2px !important;
	font-size: 16px !important;
	width: 30%;
	height: 60px;
}
.subscribe_lightbox_pop #close-button {
  position: absolute;
  right: 17px;
  top: 10px;
  width: 35px;
  height: 35px;
  opacity: 1;
  padding: 6px 0;
}
.subscribe_lightbox_pop #close-button:before, .subscribe_lightbox_pop #close-button:after {
  position: absolute;
  left: 15px;
  content: ' ';
  height: 30px;
  width: 2px;
  background-color: #333;
}
.subscribe_lightbox_pop #close-button:before {
  transform: rotate(45deg);
}
.subscribe_lightbox_pop #close-button:after {
  transform: rotate(-45deg);
}
.subscribe_lightbox_pop form{padding: 0 80px;}
.subscribe_lightbox_pop .error_container { width: 100%; text-align:center;} 
.subscribe_lightbox_pop .subscribe-box-afteractionmessage {color:#060;}

@media only screen and (max-width:767px){
.subscribe_lightbox_pop .newsLetter h1 {
	font-size: 24px;
	line-height: 34px;
}
.subscribe_lightbox_pop .subscribeFourbutton {
	padding: 20px 5px !important;
	width: 50%;
}
.subscribe_lightbox_pop .email-textbox {
	width: 50% !important;
}
.subscribe_lightbox_pop form {
	padding: 0 20px;
}
.subscribe_lightbox_pop .heading_txt {
	padding: 0 5%;
}
.subscribe_lightbox_pop .newsLetter p {
	line-height: 22px;
	font-size: 15px;
}
}
@media only screen and (max-width:374px){
	.subscribe_lightbox_pop .newsLetter h1 {
	font-size: 20px;
	line-height: 30px;
}
}
</style>
    		<div id="main-div" class="subscribe_lightbox_pop subscribebox_<?php echo $newsletter->id;?>" style="display: none;">
            	<div class="newsLetter">				
                <div class="ribbon"><img src=" <?php echo $decodedData['wp_newsletter_ribbon']; ?>" /></div>
				<?php if(!empty($decodedData['wp_newsletter_heading'])) { 
					$color = $decodedData['wp_newsletter_heading_color'];
					if(empty($color))
					{
						$color = '#fff';
					}
				
				?>
                <div class="heading_txt">
                	<h1 style="color:<?php echo $color;?>"> <?php echo $decodedData['wp_newsletter_heading'];?></h1>
				<?php } ?>
                     <a href="#" id="close-button" class="close_<?php echo $newsletter->id;?>"></a>
					 <?php if(!empty($decodedData['wp_newsletter_description'])) {
							$pcolor = $decodedData['wp_newsletter_description_color'];
						if(empty($pcolor))
						{
							$pcolor = '#333';
						}	
						?>
                    <p style="color:<?php echo $pcolor; ?>"><?php echo $decodedData['wp_newsletter_description']; ?></p>
					 <?php }?>
                     </div> <!--heading_txt-->
                     <div class="error_container">                     
                     <span class="error" id="error_<?php echo $newsletter->id;?>"></span> 
                     <span class="subscribe-box-afteractionmessage"></span>
                     </div> 
	 <form class="subscribe-box-form" name="nl_<?php echo $newsletter->id;?>" id="nl_<?php echo $newsletter->id;?>">
     
             <input class="email-textbox  subscribe-box-email validate_<?php echo $newsletter->id;?> email_validate_<?php echo $newsletter->id;?>" name="<?php echo $decodedData['wp_newsletter_emailfieldname'];?>" placeholder="<?php echo $decodedData['wp_newsletter_email'];?>" type="text">
			 
			 <!-- Name -->
		<?php if(isset($decodedData['wp_newsletter_showname'])&& $decodedData['wp_newsletter_showname'] == '1') { ?>
		<input class="email-textbox subscribe-box-email validate_<?php echo $newsletter->id;?>" name="<?php echo $decodedData['wp_newsletter_namefieldname'];?>" placeholder="<?php echo $decodedData['wp_newsletter_name'];?>" type="text">
		<?php } ?>
	
		<!-- First Name -->
		<?php if(isset($decodedData['wp_newsletter_showfirstname'])&& $decodedData['wp_newsletter_showfirstname'] == '1') { ?>
		<input class="email-textbox subscribe-box-email validate_<?php echo $newsletter->id;?>" name="<?php echo $decodedData['wp_newsletter_firstnamefieldname'];?>" placeholder="<?php echo $decodedData['wp_newsletter_firstname'];?>" type="text">
		<?php } ?>
	
		<!-- Last Name -->
		<?php if(isset($decodedData['wp_newsletter_showlastname'])&& $decodedData['wp_newsletter_showlastname'] == '1') { ?>
		<input class="email-textbox subscribe-box-email validate_<?php echo $newsletter->id;?>" name="<?php echo $decodedData['wp_newsletter_lastnamefieldname'];?>" placeholder="<?php echo $decodedData['wp_newsletter_lastname'];?>" type="text">
		<?php } ?>
		
		<!-- Phone -->
		<?php if(isset($decodedData['wp_newsletter_showphone'])&& $decodedData['wp_newsletter_showphone'] == '1') { ?>
		<input class="email-textbox subscribe-box-email validate_<?php echo $newsletter->id;?>" name="<?php echo $decodedData['wp_newsletter_phonefieldname'];?>" placeholder="<?php echo $decodedData['wp_newsletter_phone'];?>" type="text">
		<?php } ?>
	
	<!-- company -->
	<?php if(isset($decodedData['wp_newsletter_showcompany'])&& $decodedData['wp_newsletter_showcompany'] == '1') { ?>
	<input class="email-textbox subscribe-box-email validate_<?php echo $newsletter->id;?>" name="<?php echo $decodedData['wp_newsletter_companyfieldname'];?>" placeholder="<?php echo $decodedData['wp_newsletter_company'];?>" type="text">
	<?php } ?>
	
	<!-- zip -->
	<?php if(isset($decodedData['wp_newsletter_showzip'])&& $decodedData['wp_newsletter_showzip'] == '1') { ?>
	<input class="email-textbox subscribe-box-email validate_<?php echo $newsletter->id;?>" name="<?php echo $decodedData['wp_newsletter_zipfieldname'];?>" placeholder="<?php echo $decodedData['wp_newsletter_zip'];?>" type="text">
	<?php } ?>
	<!-- msg -->
	<?php if(isset($decodedData['wp_newsletter_showmessage'])&& $decodedData['wp_newsletter_showmessage'] == '1') { ?>
	<textarea class="email-textbox subscribe-box-email validate_<?php echo $newsletter->id;?>" name="<?php echo $decodedData['wp_newsletter_messagefieldname'];?>" placeholder="<?php echo $decodedData['wp_newsletter_message'];?>"></textarea>
	<?php } ?> 
	
	<!-- terms -->
	<?php if(isset($decodedData['wp_newsletter_showterms'])&& $decodedData['wp_newsletter_showterms'] == '1') { ?>
	<input type="checkbox" value="Yes" name="TERMS" <?php echo($decodedData['wp_newsletter_termsrequired'] == '1') ? 'required' : '';?>/ <?php if($decodedData['wp_newsletter_termsrequired'] == '1') {?>id="term_<?php echo $newsletter->id;?>"<?php }?>> <?php echo $decodedData['wp_newsletter_terms'];?>
    <span id="error_terms_<?php echo $newsletter->id;?>" class="error"></span>
	<?php } ?>
	
              <input class="subscribe-box-action subscribeFourbutton" name="subscribe-box-action" value="Subscribe" id="subscribe-box-action-<?php echo $newsletter->id;?>" type="button">
              
             </form>
			 
			 
			 <?php if(isset($decodedData['wp_newsletter_privacy_show'])&& $decodedData['wp_newsletter_privacy_show'] == '1') {
				$pcolor = $decodedData['wp_newsletter_privacy_color'];
						if(empty($pcolor))
						{
							$pcolor = '#333';
						}	
						?> 
				
	 <div class="privacyTxt" > <a style="color:<?php echo $pcolor; ?>" ><?php echo $decodedData['wp_newsletter_privacy'];?></a></div>
	<?php } ?>
    		
    	
              </div>
            <div class="clear"></div>
            </div>
            <script>
	jQuery(document).ready(function() {
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
<?php } } ?>