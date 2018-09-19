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
  padding: 0px 15px;
  overflow-x: auto;
  box-sizing:border-box;
  -webkit-box-sizing:border-box;
  margin-top:<?php echo $decodedData['wp_newsletter_mintopbottommargin'] ?>px;
}
.newsLetter
{
	width:<?php echo $decodedData['wp_newsletter_width']; ?>%;
	max-width:<?php echo $decodedData['wp_newsletter_maxwidth']; ?>px;
	padding: 60px 0 50px;
	border-radius:3px;
	background:url(<?php echo plugins_url( 'images/bg3.jpg',__FILE__) ?>);
	background-size:cover !important;
	margin:50px auto;
	position: relative;
	z-index:9999;
}
.newsLetter h1
{
	color:#fff;
	font-weight:bold;
	font-size:30px;
	text-transform:uppercase;
	text-align:center;
	letter-spacing:2px;
	padding: 30px 0 10px;
	font-family: 'Montserrat', sans-serif;
}
.newsLetter p
{
	text-align:center;
	line-height:25px;
	color:#fff !important;
	margin:15px;
	font-family: 'Lora', serif;
	font-size: 18px;
}
.newsLetter .news-box{overflow-y:auto;max-height:80vh;}
.newsLetter .subscribeThreebutton
{
	font-family: 'Raleway', sans-serif;
	background: #e4971d;
	color: #fff;
	padding: 18px;
	border-radius: 200px;
	text-transform: uppercase;
	margin: 20px auto;
	display: block;
	border: none;
	font-weight:600;
	letter-spacing:2px;
	box-shadow: 0px 5px 16px 0px #888;
	max-width: 250px;
    width: 100%;
}
.newsLetter .email-textbox
{
	padding: 15px;
    width: 100%;
    max-width: 330px;
    margin: 30px auto 0;
    display: block;
	box-sizing: border-box;
	font-family: 'Open Sans', sans-serif;
	font-size: 15px;
	color: #808080;
}
.newsLetter .terms-box
{
	width: 100%;
	max-width: 330px;
	display: block;
	margin: auto;
	box-sizing: border-box;
	padding: 10px 0 0;
}
.newsLetter .close-button {
  position: absolute;
  right: 17px;
  top: 5px;
  width: 35px;
  height: 35px;
  border-radius: 100%;
  padding: 6px 0;
}
.newsLetter .close-button:before, .close-button:after {
  position: absolute;
  left: 15px;
  content: ' ';
  height: 26px;
  width: 2px;
  background-color: #7aa931;
}
.newsLetter .close-button:before {
  transform: rotate(45deg);
}
.newsLetter .close-button:after {
  transform: rotate(-45deg);
}
.newsLetter .subscribe-box-form{padding:10px;}
.newsLetter .privacy-text
{
    color: #fff;
    text-align: center;
    margin:20px 0 0;
}
.error_container {
    text-align: center;
    color: #ff0000;
}
</style>
<?php 
/*style of arrow btn*/
if($decodedData['wp_newsletter_closeposition']=="top-left-inside")
{?>
<style>
.newsLetter .close-button {
    position: absolute;
    left: 18px;
    top: 5px;
}
.newsLetter .close-button:before, .close-button:after {
    left: -9px;
    height: 16px;
    width: 2px;
}
.newsLetter .close-button{border-radius:0px !important;}
</style>
<?php }else if($decodedData['wp_newsletter_closeposition']=="top-right-inside")
{?>
<style>
.newsLetter .close-button {
    position: absolute;
    right: 17px;
    top: 5px;
    width: 35px;
    height: 35px;   
}

</style>
<?php }else if($decodedData['wp_newsletter_closeposition']=="top-left-outside")
{?>
<style>
.newsLetter .close-button {
    left: -9px;
    top: -12px;
    width: 35px;
    height: 35px;
    background: #fff;
}
.newsLetter .close-button:before, .close-button:after { 
    left: 16px;
    height: 20px;
    top: 7px;
}

</style>
<?php }else if($decodedData['wp_newsletter_closeposition']=="top-right-outside")
{?>
<style>
.newsLetter .close-button {
    right:-9px;
    top: -12px;
    width: 35px;
    height: 35px;
    background: #fff;
}
.newsLetter .close-button:before, .close-button:after {  
    left: 16px;
    height: 20px;
    top: 7px;
}
</style>
<?php }?>
<?php $count = 0;?>
		<div id="main-div" class="subscribebox_<?php echo $newsletter->id;?>" style="display: none;">
			<div class="newsLetter news-box" style="border-radius:<?php echo $decodedData['wp_newsletter_radius']; ?>; box-shadow:<?php echo $decodedData['wp_newsletter_bordershadow']; ?>;<?php if(!empty($decodedData['wp_newsletter_backgroundimage'])){ ?>background:url(<?php echo $decodedData['wp_newsletter_backgroundimage'];?>);background-repeat:<?php echo $decodedData['wp_newsletter_backgroundimagerepeat'];?>;background-position:<?php echo $decodedData['wp_newsletter_backgroundimageposition'];?>;<?php } else {?>background:<?php echo $decodedData['wp_newsletter_backgroung_color']; }?>;">
			<?php if(!empty($decodedData['wp_newsletter_ribbon_show']) && ($decodedData['wp_newsletter_ribbon_show'] == 1)):?>
			
				<div class="ribbon" style="<?php echo $decodedData['wp_newsletter_ribboncss'];?>position:absolute;"><img src=" <?php echo $decodedData['wp_newsletter_ribbon']; ?>" /></div>
				<?php endif;?>
			
		<?php if(!empty($decodedData['wp_newsletter_heading'])) { 
					$color = $decodedData['wp_newsletter_heading_color'];
					if(empty($color))
					{
						$color = '#fff';
					}
				?>
				<h1 style="color:<?php echo $color;?>"><?php echo $decodedData['wp_newsletter_heading'];?></h1>
		<?php } ?>
				<div id="popupfoot"><a href="#" class="close-button  close_<?php echo $newsletter->id;?>"></a></div>
				<?php 				
				if(!empty($decodedData['wp_newsletter_description'])) {
						$pcolor = $decodedData['wp_newsletter_description_color'];
						if(empty($pcolor))
						{
							$pcolor = '#333';
						}	
						?>
				<p style="color:<?php echo $pcolor."!important;"; ?> " ><?php echo $decodedData['wp_newsletter_description']; ?></p>
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
	<?php if(isset($decodedData['wp_newsletter_showname'])&& $decodedData['wp_newsletter_showname'] == '1') {$count++; ?>
	<input class="email-textbox subscribe-box-email validate_<?php echo $newsletter->id;?> custom-input" name="<?php echo $decodedData['wp_newsletter_namefieldname'];?>" placeholder="<?php echo $decodedData['wp_newsletter_name'];?>" type="text">
	<?php } ?>
	
	<!-- First Name -->
	<?php if(isset($decodedData['wp_newsletter_showfirstname'])&& $decodedData['wp_newsletter_showfirstname'] == '1') {$count++; ?>
	<input class="email-textbox subscribe-box-email validate_<?php echo $newsletter->id;?> custom-input" name="<?php echo $decodedData['wp_newsletter_firstnamefieldname'];?>" placeholder="<?php echo $decodedData['wp_newsletter_firstname'];?>" type="text">
	<?php } ?>
	
	<!-- Last Name -->
	<?php if(isset($decodedData['wp_newsletter_showlastname'])&& $decodedData['wp_newsletter_showlastname'] == '1') {$count++; ?>
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
	<?php if(isset($decodedData['wp_newsletter_showzip'])&& $decodedData['wp_newsletter_showzip'] == '1') { $count++;?>
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
	</div>	
</div>
	<?php
		if($count == 3 || $count == 5 || $count == 7):
		?>
			<style>
			 .newsLetter .email-textbox {
				max-width: 350px;
				margin: 10px 7px;
				float: left !important;
				margin-bottom: 20px !important;
			}
			.newsLetter .box-center {
				margin: auto;
				display: block;
				float: none !important;
			}
			</style>
		<?php elseif($count == 2 || $count == 4|| $count == 6|| $count == 8):?>
		<style>
			.newsLetter .email-textbox {
			max-width: 350px;
			margin: 10px 7px;
			 float: left;
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