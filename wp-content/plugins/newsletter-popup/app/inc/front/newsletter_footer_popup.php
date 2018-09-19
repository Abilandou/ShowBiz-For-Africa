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
	overflow-x: auto;
	
}
.newsletter-bg
{
	width:<?php echo $decodedData['wp_newsletter_width'] ?>%;
	max-width:<?php echo $decodedData['wp_newsletter_maxwidth'] ?>px;
	background:url(<?php echo plugins_url( 'images/newsletter-bg.jpg', __FILE__ ) ?>);
	background-size: cover !important;
	margin:1px auto;
	position: relative;
	margin-top:<?php echo $decodedData['wp_newsletter_mintopbottommargin'] ?>px;
}
.newsletter-bg h1
{
	font-size: 20px;
	color: #404040;
	text-align: center;
	padding: 25px 0 25px ;
	font-family: 'Playfair Display', serif;
	font-style: italic;
}
.newsletter-bg .take-text
{
	font-family: 'Lora', serif;
	font-size: 25px;
    color: #404040;
    text-align: center;
    text-transform: uppercase;
    letter-spacing: 4px;
}
.newsletter-bg .purchase-text
{
	font-family: 'Lora', serif;
    font-weight: bold;
    font-size: 22px;
    text-align: center;
    color: #9a3fc4;
    padding: 10px;
}
.newsletter-bg .email-textbox
{
	padding: 20px;
    width: 100%;
    max-width: 400px;
    margin: 5px auto;
    display: block;
	box-sizing: border-box;
	font-family: 'Open Sans', sans-serif;
	font-size: 15px;
	color: #808080;
}
.newsletter-bg .terms-box
	{
		width:100%;
		max-width: 400px;
		display: block;
		margin: auto;
		box-sizing: border-box;
	}
.newsletter-bg .subscribe-button
{
	width: 100%;
    max-width: 400px;
    background: #e4971d;
    color: #fff;
    font-family: 'Oswald', sans-serif;
    border: none;
    margin: 15px auto;
	display: block;
	padding: 20px;
    font-size: 17px;
    text-transform: uppercase;
    letter-spacing: 3px;
}
.newsletter-bg .coupon-text
{
	margin: 5px;
	text-align: center;
	padding: 5px 0 50px;
}
.newsletter-bg .coupon-text a
{
	color: #404040;
	text-decoration: underline;
	font-size: 18px;	
	font-family: 'Open Sans', sans-serif;
}

.close-button {
     position: absolute;
     height: 60px;
     opacity: 1;
     padding: 15px 0px;
     background: #ffffff;
     width: 60px;
     border-bottom: solid 1px #ccc;
     border-left: solid 1px #ccc;
}
.close-button:before, .close-button:after {
    position: absolute;
    content: ' ';
    height: 30px;
    width: 2px;
    background-color: #484848;
}
.close-button:before {
  transform: rotate(45deg);
}
.close-button:after {
  transform: rotate(-45deg);
}
form{ padding: 0px 15px;}
@media only screen and (max-width:767px)
{
	.newsletter-bg h1{ font-size: 14px;}
	.newsletter-bg .take-text{font-size: 35px;}
	.close-button{height: 30px;}
}
#mask {
  position:absolute;
  left:0;
  top:0;
  z-index:9000;
  background-color:#000;
  display:none;
}  
.maintext{
	text-align: center;
  font-family: "Segoe UI", sans-serif;
  text-decoration: none;
}
#popupfoot{
	font-family: "Segoe UI", sans-serif;
	font-size: 16pt;
}
#popupfoot a{
	text-decoration: none;
}
/*.agree:hover{
  background-color: #D1D1D1;
}*/
.popupoption:hover{
	background-color:#D1D1D1;
	color: green;
}
.popupoption2:hover{
	
	color: red;
}
.error_container {
    text-align: center;
	color:red;
}
</style>
<?php 
/*style of arrow btn*/
if($decodedData['wp_newsletter_closeposition']=="top-left-inside")
{?>
<style>
.close-button {
    left: 0;
	top:0;
    border-bottom: solid 1px #ccc;
    border-right: solid 1px #ccc;
	background:none;
}
.close-button:before, .close-button:after {
    left: 25px;
}

</style>
<?php }else if($decodedData['wp_newsletter_closeposition']=="top-right-inside")
{?>
<style>
.close-button {
    
    right: 0;
    top: 0px;
    border-left: solid 1px #ccc;
}
.close-button:before, .close-button:after {
  left: 30px;

}

</style>
<?php }else if($decodedData['wp_newsletter_closeposition']=="top-left-outside")
{?>
<style>
 .close-button {
    left: -15px;
    top: -15px;
    height: 40px;
    background: #ffffff;
    width: 40px;
    border-radius: 100px;
}
.close-button:before, .close-button:after {
    position: absolute;
    left: 18px;
    height: 20px;
    width: 2px;
    top: 10px;
}

</style>
<?php }else if($decodedData['wp_newsletter_closeposition']=="top-right-outside")
{?>
<style>
.close-button {
    right: -25px;
    top: -15px;
    height: 40px;
    width: 40px;
    border-radius: 100px;
}
.close-button:before, .close-button:after {
     left: 18px;    height: 20px;
    width: 2px;
    background-color: #484848;
    top: 10px;
}
</style>
<?php }?>

<?php $count = 0;?>
	<div id="main-div" class="subscribebox_<?php echo $newsletter->id;?>" style="display: none;">
		<div class="newsletter-bg"  style="border-radius:<?php echo $decodedData['wp_newsletter_radius']; ?>; box-shadow:<?php echo $decodedData['wp_newsletter_bordershadow']; ?>;<?php if(!empty($decodedData['wp_newsletter_backgroundimage'])){ ?>background:url(<?php echo $decodedData['wp_newsletter_backgroundimage'];?>);background-repeat:<?php echo $decodedData['wp_newsletter_backgroundimagerepeat'];?>;background-position:<?php echo $decodedData['wp_newsletter_backgroundimageposition'];?>;<?php } else {?>background:<?php echo $decodedData['wp_newsletter_backgroung_color']; }?>;">
			<?php if(!empty($decodedData['wp_newsletter_ribbon_show']) && ($decodedData['wp_newsletter_ribbon_show'] == 1)):?>
				<div class="ribbon" style="<?php echo $decodedData['wp_newsletter_ribboncss'];?>position:absolute;"><img src=" <?php echo $decodedData['wp_newsletter_ribbon']; ?>" /></div>
				<?php endif;?>
		<h1>Welcome to <?php echo get_bloginfo( 'name' ); ?></h1>
		<?php if(!empty($decodedData['wp_newsletter_heading'])) { 
			$color = $decodedData['wp_newsletter_heading_color'];
			if(empty($color))
			{
				$color = '#fff';
			}?>
		<div class="take-text" style="color:<?php echo $color;?>">
		<?php echo $decodedData['wp_newsletter_heading'];?>
			</div>
		<?php } ?>
			<div id="popupfoot"><a href="#" class="close-button close_<?php echo $newsletter->id;?>"></a></div>
			<?php if(!empty($decodedData['wp_newsletter_description'])) {
							$pcolor = $decodedData['wp_newsletter_description_color'];
						if(empty($pcolor))
						{
							$pcolor = '#333';
						}	
						?>
			<div class="purchase-text" style="color:<?php echo $pcolor; ?>">
			<?php echo $decodedData['wp_newsletter_description']; ?>
			</div>
			<?php } ?>
			 <div class="error_container">                     
                     <span class="error" id="error_<?php echo $newsletter->id;?>"></span> 
                     <span class="subscribe-box-afteractionmessage"></span>
                     </div> 
			 <form class="subscribe-box-form" name="nl_<?php echo $newsletter->id;?>" id="nl_<?php echo $newsletter->id;?>">
	<!-- Email -->
	<?php if(isset($decodedData['wp_newsletter_showemail'])&& $decodedData['wp_newsletter_showemail'] == '1') { 
	$count++;
	
	?>
	<input class="email-textbox subscribe-box-email validate_<?php echo $newsletter->id;?> email_validate_<?php echo $newsletter->id;?> custom-input" name="<?php echo $decodedData['wp_newsletter_emailfieldname'];?>" placeholder="<?php echo $decodedData['wp_newsletter_email'];?>" type="text">
	<?php } ?>
	
	<!-- Name -->
	<?php if(isset($decodedData['wp_newsletter_showname'])&& $decodedData['wp_newsletter_showname'] == '1') { $count++;

	?>
	<input class="email-textbox subscribe-box-email validate_<?php echo $newsletter->id;?> custom-input" name="<?php echo $decodedData['wp_newsletter_namefieldname'];?>" placeholder="<?php echo $decodedData['wp_newsletter_name'];?>" type="text">
	<?php } ?>
	
	<!-- First Name -->
	<?php if(isset($decodedData['wp_newsletter_showfirstname'])&& $decodedData['wp_newsletter_showfirstname'] == '1') {$count++; ?>
	<input class="email-textbox subscribe-box-email validate_<?php echo $newsletter->id;?> custom-input" name="<?php echo $decodedData['wp_newsletter_firstnamefieldname'];?>" placeholder="<?php echo $decodedData['wp_newsletter_firstname'];?>" type="text">
	<?php } ?>
	
	<!-- Last Name -->
	<?php if(isset($decodedData['wp_newsletter_showlastname'])&& $decodedData['wp_newsletter_showlastname'] == '1') {$count++; ?>
	<input class="email-textbox subscribe-box-email custom-input validate_<?php echo $newsletter->id;?> " name="<?php echo $decodedData['wp_newsletter_lastnamefieldname'];?>" placeholder="<?php echo $decodedData['wp_newsletter_lastname'];?>" type="text">
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
	<?php if(isset($decodedData['wp_newsletter_showzip'])&& $decodedData['wp_newsletter_showzip'] == '1') {$count++; ?>
	<input class="email-textbox subscribe-box-email validate_<?php echo $newsletter->id;?>" name="<?php echo $decodedData['wp_newsletter_zipfieldname'];?>" placeholder="<?php echo $decodedData['wp_newsletter_zip'];?>" type="text">
	<?php } ?>
	
	<!-- msg -->
	<?php if(isset($decodedData['wp_newsletter_showmessage'])&& $decodedData['wp_newsletter_showmessage'] == '1') {$count++; ?>
	<textarea class="email-textbox subscribe-box-email validate_<?php echo $newsletter->id;?> custom-input" name="<?php echo $decodedData['wp_newsletter_messagefieldname'];?>" placeholder="<?php echo $decodedData['wp_newsletter_message'];?>"></textarea>
	<?php } ?>
	<!-- terms -->
	<div class="terms-box">
			<?php if(isset($decodedData['wp_newsletter_showterms'])&& $decodedData['wp_newsletter_showterms'] == '1') { ?>
	<input type="checkbox" value="Yes" name="TERMS" <?php echo($decodedData['wp_newsletter_termsrequired'] == '1') ? 'required' : '';?>/ <?php if($decodedData['wp_newsletter_termsrequired'] == '1') {?>id="term_<?php echo $newsletter->id;?>"<?php }?>> <?php echo $decodedData['wp_newsletter_terms'];?>
<span id="error_terms_<?php echo $newsletter->id;?>" class="error"></span>
	<?php } ?>
		 
	</div>
	
	<?php if(isset($decodedData['wp_newsletter_showaction'])&& $decodedData['wp_newsletter_showaction'] == '1'):?>
	<input class="subscribe-box-action subscribe-button" name="subscribe-box-action" value="<?php echo $decodedData['wp_newsletter_action'];?>" type="button" id="subscribe-box-action-<?php echo $newsletter->id;?>">
	<div class="subscribe-box-afteractionmessage" style="display: none;"></div>
	<input type="hidden" value="<?php echo date("Y-m-d h:i:s");?>" name="TIME" />
	<?php endif;?>
	</form>
	
             <div class="coupon-text">
             <a href="javascript:void(0)" class="close_<?php echo $newsletter->id;?>">Enter Site Without Coupon</a>
			 
<?php if(!empty($decodedData['wp_newsletter_privacy_show']) && ($decodedData['wp_newsletter_privacy_show']==1) ):?>
					<div class="privacy-text" style="color:<?php echo $decodedData['wp_newsletter_privacy_color']; ?>"><?php echo $decodedData['wp_newsletter_privacy'];?></div>
					<?php endif; ?>		
</div>  					
             </div>
	</div>       
                <?php
				
				if($count == 3 || $count == 5 || $count == 7):
			
				?>
					<style>
					 
					 .newsletter-bg .terms-box {
						width: 100%;
						max-width: 400px;
						display: block;
						margin: 5px auto;
						padding-left: 25px;
					}
					.newsletter-bg .email-textbox {
						 max-width: 350px;
						margin: 10px 7px;
						 float: left;
					}
					.box-center {
						margin: 15px auto !important;;
						display: block !important;
						float: none !important;
					}
					</style>
					<?php elseif($count == 2 || $count == 4|| $count == 6|| $count == 8):?>
					<style>
						.newsletter-bg .email-textbox {
						   max-width: 350px;
						  margin: 10px 7px;
						  float: left;
						}
					 .newsletter-bg .email-textbox {
						 max-width: 350px;
						 margin: 10px 7px;
						 float: left;
					 }
					</style>
				<?php endif;?>
		
<script>
	jQuery(document).ready(function() {
		jQuery( ".custom-input" ).each(function( i ) {
   
   if(parseInt(i)==2 ||parseInt(i)==4 ||parseInt(i)==6)
   {
	  jQuery('.custom-input:last').addClass("box-center");
   } 
  });
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

<?php } } ?>
