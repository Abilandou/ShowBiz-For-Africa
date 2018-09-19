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
  background: <?php echo $decodedData['wp_newsletter_overlaycolor'] ?>;
  opacity: <?php echo $decodedData['wp_newsletter-popup-overlayopacity'] ?>;
  padding: 0px 15px;
  box-sizing:border-box;
	-webkit-box-sizing:border-box;
	overflow-x: auto;
	padding: 0 50px;
}
.newsLetter
{
	width: 100%;
	max-width: 760px;
	padding: 10px;
	border-radius: 3px;
	background:#144f5c;
	background-size: 100%;
	margin: <?php echo $decodedData['wp_newsletter_mintopbottommargin'] ?>px auto;
	position: relative;
	z-index: 9999;
	background-repeat:repeat-y;
	background-position: right bottom;
}
.newsLetter .border-div
{
	border:1px dotted #fff;
	padding: 15px 15px 80px;
	position: relative;
}
.newsLetter  .border-div:after {
    content: '';
    display: table;
    clear: both;
}
.newsLetter .border-div p
{
	text-align: center;
	line-height: 25px;
	margin: 30px 0;
	color: #fff;
	font-family: 'Poppins', sans-serif;
	font-size: 18px;
}
.newsLetter .subscribeThreebutton
{
	font-family: 'Oswald', sans-serif;
    background: #66bd2c;
    color: #fff;
    padding: 23px;
    text-transform: uppercase;
    margin: 0 auto;
    border: none;
    font-weight: 600;
    letter-spacing: 2px;
    max-width: 400px;
    width: 100%;
    border-radius: 50px;
    display: block;
}
.newsLetter .email-textbox
{
    padding: 24px;
    width: 100%;
    max-width: 400px;
    margin: 15px auto;
    font-family: 'Raleway', sans-serif;
    font-size: 15px;
    color: #808080;
    border-radius: 100px;
    border: none;
    display: block;
}
.newsLetter .arrowImg 
{
	width:100%;
	max-width:115px;
}
.newsLetter .arrowImg  img
{
	position: absolute;
	left: -50px;
	z-index: 99999;
	overflow: scroll;
	top: 80px;
}
.newsLetter .arrow1Img
{
	width:100%;
	max-width:120px;
}
.newsLetter .arrow1Img  img
{
	position: absolute;
	top: 75px;
	right: -47px;
}
.forbesImg
{
	max-width: 280px;
    width: 100%;
}
.newsLetter .left-div
{
	width:45%;
	float: left;
	position: relative;
	height: 100%;
}
.newsLetter .right-div
{
	width:55%;
	float: right;
}
.newsLetter .border-div h1
{
	font-size: 45px;
	font-family: 'Oswald', sans-serif;
	font-weight: bold;
	color: #fff;
	text-align: center;
	text-transform: uppercase;
	letter-spacing: 2px;
	margin: 25px;
}
.newsLetter .right-div p
{
	font-style:normal;
	text-align: center;
}
.mobileImg
{
	position: absolute;
	bottom: 0;
}
.newsLetter .green-circle
{
	width:100%;
	max-width:160px;
	margin: auto;
	height: 100px;
}
	.newsLetter .terms-box
	{
	width: 100%;
    max-width: 330px;
    display: block;
    margin: auto;
    box-sizing: border-box;
    padding: 10px 0;
    color: #fff;
	}
.newsLetter .green-circle img
{
	position: absolute;
	margin-top: -74px;
}
.newsLetter .close-button {
  position: absolute;
  right: -10px;
  top: -11px;
  width: 40px;
  height: 40px;
  border-radius: 100%;
  padding: 6px 0;
  
}
.error_container {
    text-align: center;
    color: #ff0000;
}
.newsLetter .terms-box p {
    text-align: center;
    color: #ff0000;
	font-size: 100%;
	font-style:inherit;
}
.newsLetter .close-button:before, .close-button:after {
  position: absolute;
  left: 5px;
  content: ' ';
  height: 23px;
  width: 2px;
  background-color: #66bd2c;
  top: 20px;
}
.newsLetter .close-button:before {
  transform: rotate(45deg);
}
.newsLetter .close-button:after {
  transform: rotate(-45deg);
}
.error_container {
    color: red;
    text-align: center;
}
@media only screen and (min-width:767px) and (max-width:991px)
{
	.newsLetter .email-textbox{width:100%;max-width: inherit;ma;margin: 10px 0;border-radius: 50px;box-sizing: border-box;}
	.newsLetter .bottom-bluediv{padding:30px 10px;}
	.newsLetter .subscribeThreebutton{width:100%;max-width: inherit;margin: 10px auto 0 0;border-radius: 50px;}
}
	
@media only screen and (max-width:767px)
{
	.newsLetter .email-textbox{width:100%;max-width: inherit;ma;margin: 10px 0;border-radius: 50px;box-sizing: border-box;}
	.newsLetter .bottom-bluediv{padding:30px 10px;}
	.newsLetter .subscribeThreebutton{width:100%;max-width: inherit;margin: 10px auto 0 0;border-radius: 50px;}
	.newsLetter h1{font-size: 60px;}
	.newsLetter .right-div{width:100%;}
	.mobileImg{position: relative;}
	.newsLetter .right-div h1{ font-size:35px;}
	.mobileImg img{width:100%; max-width: 260px; margin: auto;}
	.newsLetter{ padding-bottom: 0;}
}
@media only screen and (max-width:479px)
{
	.newsLetter h1{font-size: 45px;}
	.newsLetter .right-div{width:100%;}
	.mobileImg{position: relative;}
	.newsLetter .right-div h1{ font-size:18px;}
	.newsLetter .arrow1Img  img{max-width:80px;}
	.newsLetter .arrowImg  img{max-width:80px;}
	
	}
@media only screen and (max-width:374px)
{
	.newsLetter h1{font-size: 35px;}
	.newsLetter .right-div{width:100%;}
	.mobileImg{position: relative;}
	.newsLetter .right-div h1{ font-size:18px;}
}
</style>
<?php 
/*style of arrow btn*/
if($decodedData['wp_newsletter_closeposition']=="top-left-inside")
{?>
<style>
.newsLetter .close-button {
    left: 10px;
    top: -11px;
}
</style>
<?php }else if($decodedData['wp_newsletter_closeposition']=="top-right-inside")
{
	?>
<style>
 .newsLetter .close-button {
    right: -10px;
    top: -11px;
}

</style>
<?php }else if($decodedData['wp_newsletter_closeposition']=="top-left-outside")
{?>
<style>
.newsLetter .close-button {
    left: -25px;
    top: -32px;
    background: #fff;
}
.newsLetter .close-button:before, .close-button:after {
    left: 18px;
    top: 9px;
}

</style>
<?php }else if($decodedData['wp_newsletter_closeposition']=="top-right-outside")
{?>
<style>
.newsLetter .close-button {
    right: -35px;
    top: -32px;
    background: #fff;
}
.newsLetter .close-button:before, .close-button:after {
    left: 19px;
    top: 9px;
}

</style>
<?php }?>
<?php $count = 0;?>
	<div id="main-div" class="subscribebox_<?php echo $newsletter->id;?>" style="display: none;">
	<div class="newsLetter" style="border-radius:<?php echo $decodedData['wp_newsletter_radius']; ?>; box-shadow:<?php echo $decodedData['wp_newsletter_bordershadow']; ?>;<?php if(!empty($decodedData['wp_newsletter_backgroundimage'])){ ?>background:url(<?php echo $decodedData['wp_newsletter_backgroundimage'];?>);background-repeat:<?php echo $decodedData['wp_newsletter_backgroundimagerepeat'];?>;background-position:<?php echo $decodedData['wp_newsletter_backgroundimageposition'];?>;<?php } else {?>background:<?php echo $decodedData['wp_newsletter_backgroung_color']; }?>;">
	<?php if(!empty($decodedData['wp_newsletter_ribbon_show']) && ($decodedData['wp_newsletter_ribbon_show'] == 1)):?>
				<div class="ribbon" style="<?php echo $decodedData['wp_newsletter_ribboncss'];?>position:absolute;"><img src=" <?php echo $decodedData['wp_newsletter_ribbon']; ?>" /></div>
				<?php endif;?>
			<div class="border-div">
				<div class="green-circle">
				<img src="<?php echo plugin_dir_url( __FILE__ ).'images/green-circle.png';?>" width="159" height="159" alt=""/></div>
			  	<?php if(!empty($decodedData['wp_newsletter_heading'])) { 
					$color = $decodedData['wp_newsletter_heading_color'];
					if(empty($color))
					{
						$color = '#fff';
					}
				
				?>
			<h1 style="color:<?php echo $color;?>"><?php echo $decodedData['wp_newsletter_heading'];?></h1>
		<?php } ?>
				<div class="arrowImg">
			    <img src="<?php echo plugin_dir_url( __FILE__ ).'images/arrow-1.png';?>"  alt=""/>
			     </div>
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
                     <!--<span class="subscribe-box-afteractionmessage"></span>-->
                     </div> 
			 <form class="subscribe-box-form" name="nl_<?php echo $newsletter->id;?>" id="nl_<?php echo $newsletter->id;?>">
	<!-- Email -->
	<?php if(isset($decodedData['wp_newsletter_showaction'])&&  $decodedData['wp_newsletter_showemail'] == '1') { 
	$count++;
	?>
	<input class="email-textbox subscribe-box-email validate_<?php echo $newsletter->id;?> email_validate_<?php echo $newsletter->id;?> custom-input" name="<?php echo $decodedData['wp_newsletter_emailfieldname'];?>" placeholder="<?php echo $decodedData['wp_newsletter_email'];?>" type="text">
	<?php } ?>
	
	<!-- Name -->
	<?php if(isset($decodedData['wp_newsletter_showname'])&&  $decodedData['wp_newsletter_showname'] == '1') { $count++;?>
	<input class="email-textbox subscribe-box-email validate_<?php echo $newsletter->id;?> custom-input" name="<?php echo $decodedData['wp_newsletter_namefieldname'];?>" placeholder="<?php echo $decodedData['wp_newsletter_name'];?>" type="text">
	<?php } ?>
	
	<!-- First Name -->
	<?php if(isset($decodedData['wp_newsletter_showfirstname'])&&  $decodedData['wp_newsletter_showfirstname'] == '1') { $count++;?>
	<input class="email-textbox subscribe-box-email validate_<?php echo $newsletter->id;?> custom-input" name="<?php echo $decodedData['wp_newsletter_firstnamefieldname'];?>" placeholder="<?php echo $decodedData['wp_newsletter_firstname'];?>" type="text">
	<?php } ?>
	
	<!-- Last Name -->
	<?php if(isset($decodedData['wp_newsletter_showlastname'])&& $decodedData['wp_newsletter_showlastname'] == '1') {$count++; ?>
	<input class="email-textbox subscribe-box-email validate_<?php echo $newsletter->id;?> custom-input" name="<?php echo $decodedData['wp_newsletter_lastnamefieldname'];?>" placeholder="<?php echo $decodedData['wp_newsletter_lastname'];?>" type="text">
	<?php } ?>
	
	<!-- Phone -->
	<?php if(isset($decodedData['wp_newsletter_showphone'])&& $decodedData['wp_newsletter_showphone'] == '1') { $count++;?>
	<input class="email-textbox subscribe-box-email validate_<?php echo $newsletter->id;?> custom-input" name="<?php echo $decodedData['wp_newsletter_phonefieldname'];?>" placeholder="<?php echo $decodedData['wp_newsletter_phone'];?>" type="text">
	<?php } ?>
	
	<!-- company -->
	<?php if(isset($decodedData['wp_newsletter_showcompany'])&& $decodedData['wp_newsletter_showcompany'] == '1') {$count++; ?>
	<input class="email-textbox subscribe-box-email validate_<?php echo $newsletter->id;?> custom-input" name="<?php echo $decodedData['wp_newsletter_companyfieldname'];?>" placeholder="<?php echo $decodedData['wp_newsletter_company'];?>" type="text">
	<?php } ?>
	
	<!-- zip -->
	<?php if(isset($decodedData['wp_newsletter_showzip'])&& $decodedData['wp_newsletter_showzip'] == '1') {$count++; ?>
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
	
	<?php if(isset($decodedData['wp_newsletter_showaction'])&& $decodedData['wp_newsletter_showaction'] == '1'):?>
	<input class="subscribe-box-action subscribeThreebutton" name="subscribe-box-action" value="<?php echo $decodedData['wp_newsletter_action'];?>" type="button" id="subscribe-box-action-<?php echo $newsletter->id;?>">
	<div class="subscribe-box-afteractionmessage" style="display: none;"></div>
	<input type="hidden" value="<?php echo date("Y-m-d h:i:s");?>" name="TIME" />
	<?php endif;?>
		<?php if(!empty($decodedData['wp_newsletter_privacy_show']) && ($decodedData['wp_newsletter_privacy_show']==1) ):?>
		<div class="privacy-text" style="color:<?php echo $decodedData['wp_newsletter_privacy_color']."!important"; ?>"><?php echo $decodedData['wp_newsletter_privacy'];?></div>
		<?php endif; ?>	
	</form>
				<div class="arrow1Img">
			    <img src="<?php echo plugin_dir_url( __FILE__ ).'images/arrow-2.png';?>"  alt=""/>
			     </div>			
		</div>			
		
			<div class="clear"></div>
	  </div>
			
    </div>
	<?php

if($count == 3 || $count == 5 || $count == 7):
?>
<style>	
.newsLetter .email-textbox {
    max-width: 345px;
    margin: 15px auto;
    float: left;
    margin: 4px;
    margin-bottom: 15px;
}
.newsLetter .box-center
{
	margin:auto;
	display:block;
	float:none;
}
</style>
<?php elseif($count == 2 || $count == 4|| $count == 6|| $count == 8):?>
<style>

.newsLetter .email-textbox {
    max-width: 345px;
    margin: 15px auto;
    float: left;
    margin: 4px;
    margin-bottom: 15px;
}
</style>
<?php endif;?>
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