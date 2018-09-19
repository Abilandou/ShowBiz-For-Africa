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
  background: <?php echo $decodedData['wp_newsletter_overlaycolor'] ?>;
  opacity: <?php echo $decodedData['wp_newsletter-popup-overlayopacity'] ?>;
  padding: 0px 50px;
  box-sizing:border-box;
  overflow-x: auto;
  -webkit-box-sizing:border-box;
}

.newsletter-box
{
	width:<?php echo $decodedData['wp_newsletter_width']; ?>%;
	max-width:<?php echo $decodedData['wp_newsletter_maxwidth']; ?>px;
	background:<?php if(!empty($decodedData['wp_newsletter_backgroundimage'])): echo 'url("'.$decodedData['wp_newsletter_backgroundimage'].'")'; elseif(!empty($decodedData['wp_newsletter_backgroung_color'])): echo $decodedData['wp_newsletter_backgroung_color']; endif;?>;
	background-size: cover;
	margin:<?php echo $decodedData['wp_newsletter_mintopbottommargin'] ?>px auto;
	position: relative;
	padding: 10px;
	z-index:99999;
	border-radius:<?php if(!empty($decodedData['wp_newsletter_radius'])): echo $decodedData['wp_newsletter_radius'];endif;?>px;
	box-shadow:<?php if(!empty($decodedData['wp_newsletter_bordershadow'])): echo $decodedData['wp_newsletter_bordershadow'];endif;?>;
	
	}
.newsletter-box::after
{
	content: "";
	display: table;
	clear: both;
}
.newsletter-box .take-text
{
	font-family: 'Lora', serif;
	font-size: 65px;
    color: #404040;
    text-align: center;
    text-transform: uppercase;
    letter-spacing: 4px;
}
.newsletter-box .purchase-text
{
	font-family: 'Lora', serif;
	font-weight: bold;
	font-size: 22px;
	text-align: center;
	color: #9a3fc4;
	padding: 15px;
}
.newsletter-box .email-textbox
{
	padding: 20px;
    width: 100%;
    max-width: 320px;
    margin: 15px auto 0;
    display: block;
	box-sizing: border-box;
	font-family: 'Open Sans', sans-serif;
	font-size: 15px;
	color: #808080;
}
.newsletter-box .subscribe-button
{
	width: 100%;
    max-width: 320px;
    background: #7aa931;
    color: #fff;
    font-family: 'Oswald', sans-serif;
    border: none;
    margin: 15px auto;
    display: block;
    padding: 20px;
    font-size: 17px;
    text-transform: uppercase;
    letter-spacing: 3px;
    border-radius: 9px;
}
.newsletter-box .coupon-text
{
	margin: 5px;
	text-align: center;
	padding: 15px 0 25px;
}
.newsletter-box .coupon-text a
{
	color: #404040;
	text-decoration: underline;
	font-size: 18px;	
	font-family: 'Open Sans', sans-serif;
}
.newsletter-box .right-div
{
	width:40%;
	float: left;
}
.newsletter-box .right-div .rt_dv_inner{
	background: #393147;

}
.newsletter-box .visitor-text
{
	font-size: 25px;
	font-family: 'Open Sans', sans-serif;
	text-align: center;
	margin: 5px ;
	padding: 55% 0;
	color: #fff;
	text-transform: uppercase;
	line-height: 35px;
}
.newsletter-box .yellow-text
{
	color: #e9af3a;
	text-transform: uppercase;
	font-size: 38px;
}
.newsletter-box .left-div
{
	width:60%;
	float: left;
}
.newsletter-box .left-div h1
{
	color: #616161;
	font-family: 'Oswald', sans-serif;
	font-size: 17px;
	text-align: center;
	font-weight: 300;
	padding: 10px 0 0;
}
.newsletter-box .left-div p
{
	font-family: 'Open Sans', sans-serif;
    font-size: 25px;
    color: #404040;
    text-align: center;
    line-height: 30px;
    margin: 10px;
}
.newsletter-box .month-text
{
	color: #3b3248;
    font-size: 35px;
    font-weight: 800;
    text-transform: uppercase;
    font-family: 'Oswald', sans-serif;
    text-align: center;
    letter-spacing: 2px;
}
.newsletter-box .close-button {
     position: absolute;
     right: -32px;
     top: -20px;
     height: 50px;
     opacity: 1;
     padding: 15px 0px;
     background: #ffffff;
     width: 50px;     
     border-radius: 50%;
}
.newsletter-box .close-button:before, .newsletter-box .close-button:after {
      position: absolute;
      left: 24px;
      content: ' ';
      height: 21px;
      width: 3px;
      background-color: #484848;
      top: 15px;
}
.newsletter-box .close-button:before {
  transform: rotate(45deg);
}
.newsletter-box .close-button:after {
  transform: rotate(-45deg);
}
.newsletter-box form{ padding: 0px 10px;}
.newsletter-box .privacy-text {
    text-align: center;
}
.newsletter-box .terms-box {
			width:100%;
			display: block;
			margin: 5px;
			text-align: center;
}
.error_container {
    text-align: center;
	color:#ff0000 !important;
}
.newsletter-box .terms-box p {
    text-align: center;
    color: #ff0000;
	 font-size: 100%;

}
@media only screen and (max-width:767px)
{
	.newsletter-box h1{ font-size: 14px;}
	.newsletter-box .take-text{font-size: 35px;}
	.newsletter-box .close-button{height: 30px;}
	.newsletter-box .left-div{width:100%;}
	.newsletter-box .right-div{width:100%;}
}
@media only screen and (max-width:374px)
{
	
}
</style>
<?php 
/*style of arrow btn*/
if($decodedData['wp_newsletter_closeposition']=="top-left-inside")
{?>
<style>

.newsletter-box .close-button {
    left: -6px;
    top: -9px;
    background: none;
}
.newsletter-box .close-button:before, .newsletter-box .close-button:after {
    left: 20px;
 }
</style>
<?php }elseif($decodedData['wp_newsletter_closeposition']=="top-right-inside"){?>
<style>
 .newsletter-box .close-button {
    right: -6px;
    top: -9px;
    background: none;
}
 .newsletter-box .close-button:before, .newsletter-box .close-button:after {
      left: 18px;
    top: 10px;
}
</style>
<?php }elseif($decodedData['wp_newsletter_closeposition']=="top-left-outside"){?>

<style>
.newsletter-box .close-button {    
	left: -15px;
    top: -20px;
    border-radius: 50%;
	background: #ffffff;
}
.newsletter-box .close-button:before, .newsletter-box .close-button:after {
    left: 23px;
    height: 25px;
    top: 12px;
}

</style>
<?php }elseif($decodedData['wp_newsletter_closeposition']=="top-right-outside"){?>
<style>
.newsletter-box #close {
    position: absolute;
    right: -5px;
    top: -9px;
    width: 32px;
    height: 32px;
    opacity: 1;
    color: #fff;
    background: #333;
    border-radius: 100px;
    z-index: 99999;
}
#close:before, #close:after {
    position: absolute;
    left: 15px;
    content: ' ';
    height: 15px;
    width: 2px;
    background-color: #fff;
    top: 8px;
}
#close:before {transform: rotate(45deg);}
#close:after {transform: rotate(-45deg);}
</style>
<?php }
$count = 0;?>
	<div id="main-div" class="subscribebox_<?php echo $newsletter->id;?>" style="display: none;">
           <div class="newsletter-box" style="border-radius:<?php echo $decodedData['wp_newsletter_radius']; ?>; box-shadow:<?php echo $decodedData['wp_newsletter_bordershadow']; ?>;<?php if(!empty($decodedData['wp_newsletter_backgroundimage'])){ ?>background:url(<?php echo $decodedData['wp_newsletter_backgroundimage'];?>);background-repeat:<?php echo $decodedData['wp_newsletter_backgroundimagerepeat'];?>;background-position:<?php echo $decodedData['wp_newsletter_backgroundimageposition'];?>;<?php } else {?>background:<?php echo $decodedData['wp_newsletter_backgroung_color']; }?>;">
				 <?php if(!empty($decodedData['wp_newsletter_ribbon_show']) && ($decodedData['wp_newsletter_ribbon_show'] == 1)):?>
				<div class="ribbon" style="<?php echo $decodedData['wp_newsletter_ribboncss'];?>position:absolute;"><img src=" <?php echo $decodedData['wp_newsletter_ribbon']; ?>" /></div>
				<?php endif;?>
					 <div class="left-div">
					<?php if(!empty($decodedData['wp_newsletter_heading'])) { 
					$color = $decodedData['wp_newsletter_heading_color'];
					if(empty($color))
					{
						$color = '#fff';
					}
				?>
			<p style="color:<?php echo $color;?>"><?php echo $decodedData['wp_newsletter_heading'];?></p>
		<?php } ?>
					<?php if(!empty($decodedData['wp_newsletter_description'])) {
							$pcolor = $decodedData['wp_newsletter_description_color'];
						if(empty($pcolor))
						{
							$pcolor = '#000';
						}	
						?>
				<p style="color:<?php echo $pcolor; ?>" ><?php echo $decodedData['wp_newsletter_description']; ?></p>
				<?php } ?>
					 <div id="popupfoot"><a href="#" class="close-button close_<?php echo $newsletter->id;?>"></a></div>
					 <div class="error_container">                     
                     <span class="error" id="error_<?php echo $newsletter->id;?>"></span> 
                     <span class="subscribe-box-afteractionmessage"></span>
                     </div> 
			 <form class="subscribe-box-form" name="nl_<?php echo $newsletter->id;?>" id="nl_<?php echo $newsletter->id;?>">
	<!-- Email -->
	<?php if(isset($decodedData['wp_newsletter_showemail'])&& $decodedData['wp_newsletter_showemail'] == '1') {$count++; ?>
	<input class="email-textbox subscribe-box-email validate_<?php echo $newsletter->id;?> email_validate_<?php echo $newsletter->id;?> custom-input" name="<?php echo $decodedData['wp_newsletter_emailfieldname'];?>" placeholder="<?php echo $decodedData['wp_newsletter_email'];?>" type="text">
	<?php } ?>
	
	<!-- Name -->
	<?php if(isset($decodedData['wp_newsletter_showname'])&& $decodedData['wp_newsletter_showname'] == '1') {$count++;  ?>
	<input class="email-textbox subscribe-box-email validate_<?php echo $newsletter->id;?> custom-input" name="<?php echo $decodedData['wp_newsletter_namefieldname'];?>" placeholder="<?php echo $decodedData['wp_newsletter_name'];?>" type="text">
	<?php } ?>
	
	<!-- First Name -->
	<?php if(isset($decodedData['wp_newsletter_showfirstname'])&& $decodedData['wp_newsletter_showfirstname'] == '1') {$count++;  ?>
	<input class="email-textbox subscribe-box-email validate_<?php echo $newsletter->id;?> custom-input" name="<?php echo $decodedData['wp_newsletter_firstnamefieldname'];?>" placeholder="<?php echo $decodedData['wp_newsletter_firstname'];?>" type="text">
	<?php } ?>
	
	<!-- Last Name -->
	<?php if(isset($decodedData['wp_newsletter_showlastname'])&& $decodedData['wp_newsletter_showlastname'] == '1') {$count++;  ?>
	<input class="email-textbox subscribe-box-email validate_<?php echo $newsletter->id;?> custom-input" name="<?php echo $decodedData['wp_newsletter_lastnamefieldname'];?>" placeholder="<?php echo $decodedData['wp_newsletter_lastname'];?>" type="text">
	<?php } ?>
	
	<!-- Phone -->
	<?php if(isset($decodedData['wp_newsletter_showphone'])&& $decodedData['wp_newsletter_showphone'] == '1') {$count++;  ?>
	<input class="email-textbox subscribe-box-email validate_<?php echo $newsletter->id;?> custom-input" name="<?php echo $decodedData['wp_newsletter_phonefieldname'];?>" placeholder="<?php echo $decodedData['wp_newsletter_phone'];?>" type="text">
	<?php } ?>
	
	<!-- company -->
	<?php if(isset($decodedData['wp_newsletter_showcompany'])&& $decodedData['wp_newsletter_showcompany'] == '1') {$count++;  ?>
	<input class="email-textbox subscribe-box-email validate_<?php echo $newsletter->id;?> custom-input" name="<?php echo $decodedData['wp_newsletter_companyfieldname'];?>" placeholder="<?php echo $decodedData['wp_newsletter_company'];?>" type="text">
	<?php } ?>
	
	<!-- zip -->
	<?php if(isset($decodedData['wp_newsletter_showzip'])&& $decodedData['wp_newsletter_showzip'] == '1') {$count++;  ?>
	<input class="email-textbox subscribe-box-email validate_<?php echo $newsletter->id;?> custom-input" name="<?php echo $decodedData['wp_newsletter_zipfieldname'];?>" placeholder="<?php echo $decodedData['wp_newsletter_zip'];?>" type="text">
	<?php } ?>
	
	<!-- msg -->
	<?php if(isset($decodedData['wp_newsletter_showmessage'])&& $decodedData['wp_newsletter_showmessage'] == '1') {$count++;  ?>
	<textarea class="email-textbox subscribe-box-email validate_<?php echo $newsletter->id;?> custom-input" name="<?php echo $decodedData['wp_newsletter_messagefieldname'];?>" placeholder="<?php echo $decodedData['wp_newsletter_message'];?>"></textarea>
	<?php } ?>
	<div class="terms-box">
	<!-- terms -->
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
	<?php if(!empty($decodedData['wp_newsletter_privacy_show']) && ($decodedData['wp_newsletter_privacy_show']==1) ):?>
		<div class="privacy-text" style="color:<?php echo $decodedData['wp_newsletter_privacy_color']."!important"; ?>"><?php echo $decodedData['wp_newsletter_privacy'];?></div>
	<?php endif; ?>	
	</form>
					 
		 </div>
		 <div class="right-div">
		 <div class="rt_dv_inner">
			 <div class="visitor-text">How to get <span class="yellow-text">+25.000.000</span> Visitors</div>
			 </div>
	  </div>
		 </div>
		 <div class="clear"></div>
		 <div style="width: 100% !important; font-size: 32pt; color:white; height: 602px; display: none; opacity: 0.8;" id="mask"></div>
	</div>
		<?php
		if($count == 3 || $count == 5 || $count == 7 ||$count == 9):
		?>
		<style>	
		  .newsletter-box form{ padding: 0px;}
			 .newsletter-box .email-textbox {
				max-width: 200px;
				margin: 5px;
				float: left;
			}
			 .newsletter-box .box-center {
				margin: auto !important;
				display: block!important;
				float: none !important;
			}
		 .newsletter-box .terms-box {
			display: block;
			margin: 5px auto;
			text-align: center;
			}
		</style>
		<?php elseif($count == 2 || $count == 4|| $count == 6|| $count == 8):?>
		<style>
			.newsletter-box .email-textbox {
				max-width: 200px;
				margin: 15px 1px;
				float: left;
			}
		.newsletter-box .terms-box {
			display: inline-block;
			margin: 5px;
			text-align: center;
			width:100%;
		}
		</style>
		<?php endif;?>
    <script>
	 jQuery(document).ready(function() {
		jQuery( ".custom-input" ).each(function( i ) {
		if(parseInt(i)==2 ||parseInt(i)==4 ||parseInt(i)==6){
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
	  