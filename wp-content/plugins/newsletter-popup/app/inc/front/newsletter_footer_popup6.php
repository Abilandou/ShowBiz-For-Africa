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
  padding: 0px 50px;
  box-sizing:border-box;
	-webkit-box-sizing:border-box;
	
}

.newsLetter
{
	width:<?php echo $decodedData['wp_newsletter_width']; ?>%;
	max-width:<?php echo $decodedData['wp_newsletter_maxwidth']; ?>px;
    padding: 60px;
    border-radius: 3px;
    background:url(<?php echo plugins_url( 'images/manbg.jpg',__FILE__) ?>);
    background-size: cover !important;
    margin: <?php echo $decodedData['wp_newsletter_mintopbottommargin'] ?>px auto;
    position: relative;
    z-index: 9999;
    background-repeat: no-repeat;
    background-position: right bottom;
}

.newsLetter h1
{
	color: #252525;
	font-weight: bold;
	font-size: 35px;
	text-transform: uppercase;
	text-align: left;
	letter-spacing: 1px;
	font-family: 'Montserrat', sans-serif;
}
.newsLetter .bluetext
{
	color: #2697d2;
	font-family: 'Montserrat', sans-serif;
}
.newsLetter p
{
	text-align: left;
    line-height: 25px;
    /* padding: 15px 0 0; */
    color: #333;
    font-family: 'Poppins', sans-serif;
    font-size: 18px;
    font-style: italic;
    margin: 0 0 15px;
}
.newsLetter .terms-box
	{
    width: 100%;
   font-size:16px;
    display: block;
    margin: 5px 15px 0;
    box-sizing: border-box;
    padding: 0;
    color: #333;
}
.newsLetter .feature-text
{
	font-family: 'Poppins', sans-serif;
	color: #808080;
	text-transform: uppercase;
	font-weight: bold;
	/* margin: 10px 25px; */
}
.newsLetter .subscribeThreebutton
{
	font-family: 'Poppins', sans-serif;
    background: #e4971d;
    color: #fff;
    padding: 23px;
    text-transform: uppercase;
    margin: 10px auto 0 15px;
    display: inline-block;
    border: none;
    font-weight: 600;
    letter-spacing: 2px;
    max-width: 230px;
    width: 100%;
}
.newsLetter .email-textbox
{
	padding: 22px;
    width: 100%;
    max-width: 205px;
    margin: 10px auto 0 15px;
    display: block;
    box-sizing: border-box;
    font-family: 'Open Sans', sans-serif;
    font-size: 15px;
    color: #808080;
    float: left;
}
.newsLetter .iconImg
{
	width: 60%;
	text-align: center;
	position: relative;
	display: block;
	margin: auto;
}
.newsLetter .icon
{
	position: relative;
	display: inline-block;
	background: #fff;
	width: 50px;
}

.newsLetter .iconImg:before
{
	content: '';
	border-top: solid 1px #ccc;
	position: absolute;
	width: 100%;
	height: 2px;
	top: 15px;
	left: 0;
}
.forbesImg
{
	max-width: 280px;
    width: 100%;
}
.newsLetter .close-button {
  position: absolute;
  right: -17px;
  top: -11px;
  width: 40px;
  height: 40px;
  /* opacity: 0.2; */
  border-radius: 100%;
  /* border: solid 2px #e4971d; */
  padding: 6px 0;
  background: #fff;
}
.newsLetter .close-button:before, .close-button:after {
  position: absolute;
  left: 19px;
  content: ' ';
  height: 23px;
  width: 2px;
  background-color: #333;
  top: 8px;
}
.newsLetter .close-button:before {
  transform: rotate(45deg);
}
.newsLetter .close-button:after {
  transform: rotate(-45deg);
}
.error_container {
    text-align: center;
	color:#ff0000 !important;
}
.newsLetter .terms-box p {
    text-align: center;
    color: #ff0000;
	font-size: 100%;
	font-style:inherit;
}
@media only screen and (max-width:991px)
{
	.newsLetter .email-textbox{ max-width: inherit !important; margin: 10px 0;}
	.newsLetter  .news-box{overflow-y:auto;	max-height:100vh;}
}
@media only screen and (max-width:767px)
{
	.newsLetter .bottom-bluediv{padding:30px 10px;}
	.newsLetter .subscribeThreebutton{width:100%; max-width: inherit;margin: 5px auto;}
	.newsLetter h1{font-size: 60px;}
}
@media only screen and (max-width:479px)
{
	.newsLetter h1{font-size: 45px;}
}
@media only screen and (max-width:374px)
{
	.newsLetter h1{font-size: 35px;}
}
</style>
<?php 
/*style of arrow btn*/

if($decodedData['wp_newsletter_closeposition']=="top-left-inside")
{?>
<style>
.newsLetter .close-button {
    left: -1px;
    top: 0px;
    background: none;
}
</style>
<?php }else if($decodedData['wp_newsletter_closeposition']=="top-right-inside")
{
	?>
<style>
   .newsLetter .close-button {
    right: 0px;
    top: 0px;
	 background: none;
}

</style>
<?php }else if($decodedData['wp_newsletter_closeposition']=="top-left-outside")
{?>
<style>
.newsLetter .close-button 
{
    left: -17px;
    top: -11px;
}}

</style>
<?php }else if($decodedData['wp_newsletter_closeposition']=="top-right-outside")
{?>
<style>
.newsLetter .close-button 
{
    right:-17px;
    top: -11px;
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
				
				<div id="popupfoot"><a href="#" class="close-button close_<?php echo $newsletter->id;?>"></a></div>
		<?php if(!empty($decodedData['wp_newsletter_description'])) {
							$pcolor = $decodedData['wp_newsletter_description_color'];
						if(empty($pcolor))
						{
							$pcolor = '#000';
						}	
						?>
				<p style="color:<?php echo $pcolor; ?>" ><?php echo $decodedData['wp_newsletter_description']; ?></p>
				<?php } ?>
		<div class="feature-text">
			Featured in
			<div >
		    <img class="forbesImg" src="<?php echo ($decodedData['wp_newsletter_logo'] !='' ) ? $decodedData['wp_newsletter_logo'] :  plugins_url( 'images/forbes.jpg',__FILE__) ; ?>" width="280" height="48" alt=""/> </div>
		    <div class="error_container">                     
			 <span class="error" id="error_<?php echo $newsletter->id;?>"></span> 
			 <span class="subscribe-box-afteractionmessage"></span>
             </div> 
			 <form class="subscribe-box-form" name="nl_<?php echo $newsletter->id;?>" id="nl_<?php echo $newsletter->id;?>">
				<!-- Email -->
				<?php if(isset($decodedData['wp_newsletter_showemail'])&& $decodedData['wp_newsletter_showemail'] == '1') { $count++;?>
				<input class="email-textbox subscribe-box-email validate_<?php echo $newsletter->id;?> email_validate_<?php echo $newsletter->id;?> custom-input" name="<?php echo $decodedData['wp_newsletter_emailfieldname'];?>" placeholder="<?php echo $decodedData['wp_newsletter_email'];?>" type="text">
				<?php } ?>
				
				<!-- Name -->
				<?php if(isset($decodedData['wp_newsletter_showname'])&&  $decodedData['wp_newsletter_showname'] == '1') {$count++; ?>
				<input class="email-textbox subscribe-box-email validate_<?php echo $newsletter->id;?> custom-input" name="<?php echo $decodedData['wp_newsletter_namefieldname'];?>" placeholder="<?php echo $decodedData['wp_newsletter_name'];?>" type="text">
				<?php } ?>
				
	<!-- First Name -->
	<?php if(isset($decodedData['wp_newsletter_showfirstname'])&&  $decodedData['wp_newsletter_showfirstname'] == '1') { $count++;?>
	<input class="email-textbox subscribe-box-email validate_<?php echo $newsletter->id;?> custom-input" name="<?php echo $decodedData['wp_newsletter_firstnamefieldname'];?>" placeholder="<?php echo $decodedData['wp_newsletter_firstname'];?>" type="text">
	<?php } ?>
	
	<!-- Last Name -->
	<?php if(isset($decodedData['wp_newsletter_showlastname'])&& $decodedData['wp_newsletter_showlastname'] == '1') { $count++;?>
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
	<?php if(isset($decodedData['wp_newsletter_showmessage'])&& $decodedData['wp_newsletter_showmessage'] == '1') {$count++; ?>
	<textarea class="email-textbox subscribe-box-email validate_<?php echo $newsletter->id;?> custom-input" name="<?php echo $decodedData['wp_newsletter_messagefieldname'];?>" placeholder="<?php echo $decodedData['wp_newsletter_message'];?>"></textarea>
	<?php } ?>
	<!-- terms -->
	<div class="terms-box">
		<?php $wp_newsletter_showterms=1; if(isset($decodedData['wp_newsletter_showterms'])&& $decodedData['wp_newsletter_showterms'] == '1') { ?>
	<input type="checkbox" value="Yes" name="TERMS" <?php echo(isset($decodedData['wp_newsletter_termsrequired'])&& $decodedData['wp_newsletter_termsrequired'] == '1') ? 'required' : '';?>/ <?php if(isset($decodedData['wp_newsletter_termsrequired'])&& $decodedData['wp_newsletter_termsrequired'] == '1') {?>id="term_<?php echo $newsletter->id;?>"<?php }?>> <?php echo $decodedData['wp_newsletter_terms'];?>
<span id="error_terms_<?php echo $newsletter->id;?>" class="error"></span>
	<?php }else{$wp_newsletter_showterms=0;} ?>
	</div>	
	
	<?php if(isset($decodedData['wp_newsletter_showaction'])&&  $decodedData['wp_newsletter_showaction'] == '1')?>
	<input class="subscribe-box-action subscribeThreebutton" name="subscribe-box-action" value="<?php echo $decodedData['wp_newsletter_action'];?>" type="button" id="subscribe-box-action-<?php echo $newsletter->id;?>">
	<div class="subscribe-box-afteractionmessage" style="display: none;"></div>
	<input type="hidden" value="<?php echo date("Y-m-d h:i:s");?>" name="TIME" />
	</form>
	        </div>
			</div>
		</div>
		 <?php
		  if($count == 1 && $wp_newsletter_showterms == 0):?>
		  <style>
		  .newsLetter .email-textbox {
			max-width: 350px;
		  margin: 10px 0;}
			
		  </style>
		 <?php endif;
		  if($count == 1 && isset($decodedData['wp_newsletter_showterms'])&& $decodedData['wp_newsletter_showterms'] == '1')
		  {?>
		  <style>
		  .newsLetter .email-textbox { max-width: 350px; margin: 10px; float: left;}
		  .newsLetter .terms-box { display: inline-block; margin: 5px 15px 0;}
		  .newsLetter .subscribeThreebutton {padding: 23px;margin: 10px; display: block; max-width: 350px;}
		  </style>
		  <?php }?>
		 <?php
		if($count == 2 && $wp_newsletter_showterms == 0):
		?>
		<style>
		.newsLetter .email-textbox {
			max-width: 205px;
			margin: 5px 0px;
			display: block;
			float: left;
		}
		.newsLetter .subscribeThreebutton {
			padding: 22px 0;
			max-width: 200px;
			margin: 5px 2px;
		}

		</style>
		<?php endif;?>
		
		 <?php
		if($count == 2 && $wp_newsletter_showterms == 1):
		echo "hello";
		?>
		<style>
		.newsLetter .email-textbox {
		max-width: 300px;
		margin: 5px 5px;
		display: block;
		float: left;
}
		.newsLetter .subscribeThreebutton {
		padding: 22px 0;
		max-width: 200px;
		margin: 5px auto;
		display: block;
}
		.newsLetter .terms-box {
		display: inline-block;
		margin: 5px auto;
		text-align: center;
}
		</style>
		<?php endif;?>
		<?php
		if($count == 3 || $count == 5 || $count == 7 ||$count == 9):
		?>
		<style>	
		  .newsLetter form{ padding: 0px;}
			 .newsLetter .email-textbox {
    padding: 10px;
     max-width: 300px;
    margin: 10px 2px;
			 }
			 .newsLetter .subscribeThreebutton {
   
    margin: 10px auto;
    display: block;
			 }
			 .newsLetter .box-center {
				margin: auto !important;
				display: block!important;
				float: none !important;
			}
		 .newsLetter .terms-box {
			display: block;
			margin: 5px auto;
			text-align: center;
			}
		</style>
		<?php elseif($count == 4|| $count == 6|| $count == 8):?>
		<style>
		 .newsLetter .email-textbox {
				max-width: 300px;
				margin: 5px 10px;
				float: left;
				padding:10px;
			}
		 .newsLetter .terms-box {
			display: inline-block;
			margin: 5px;
			text-align: center;
			width:100%;
		}
		.newsLetter  .subscribeThreebutton {
			padding: 23px;
			margin: 10px auto;
			display: block;
		}
		</style>
		<?php endif;?>
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
	  
       