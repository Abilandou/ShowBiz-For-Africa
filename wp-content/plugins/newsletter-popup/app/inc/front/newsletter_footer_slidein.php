<?php 
if ( ! defined( 'ABSPATH' ) ) exit; 
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
	//if(!isset($_COOKIE['newsletter_'.$newsletter->id])) { ?>
	<script>
	jQuery(document).ready(function(){
		jQuery(".subscribe_<?php echo $newsletter->id;?>").click(function(){
			jQuery(this).slideUp();		
			jQuery(".subscribe-box_<?php echo $newsletter->id;?>").show("");
		});
		 jQuery(".close_<?php echo $newsletter->id;?>").click(function(){
			jQuery(".subscribe-box_<?php echo $newsletter->id;?>").hide("");
			jQuery(".subscribe_<?php echo $newsletter->id;?>").slideDown();
		});
	});
	</script>
<style>
.newsletter-box .ribbon{
	background:url(<?php echo $decodedData['wp_newsletter_ribbon']; ?>) no-repeat;
	position:absolute;
	top: -8px;
	left: -8px;
	z-index :999;
}
.newsletter-box .subscribe_<?php echo $newsletter->id;?> {
	display: block; 
	z-index: 9999; 
	cursor: pointer; 
	margin: 0px auto;  
	background-color: <?php echo($decodedData['wp_newsletter_hidebar_bg']) ? $decodedData['wp_newsletter_hidebar_bg'] : '#4791d6';?>; 
	color: rgb(255, 255, 255); 
	animation-duration: 0.5s;
	font-weight: 400;
	vertical-align: middle;	
	box-sizing: border-box;
	padding: 8px 27px;
	font-family: arial;
	font-size: 18px;
	position:relative;
	width: 100%;
	box-sizing:border-box;
	-webkit-box-sizing:border-box;
	}
.error{	color: #c00909;	}
.newsletter-box {
	width: 100%;
	
	position: fixed;
	bottom: 0;
	right: 15px;
	max-width: 360px;
	
	z-index: 99999;
}

.newsletter-box .subscribe
{	position:relative;
	width: 100% !important;
	display:none;
}
.newsletter-box .subscribe h1
{
	background:<?php  if(!empty($decodedData['wp_newsletter_upper_part_color'])){echo $decodedData['wp_newsletter_upper_part_color']; }else{ echo "#2d5eb7";} ?>;	
	color:#fff;
	line-height:25px;
	text-transform:uppercase;
	padding:15px;
	font-family: 'Roboto', sans-serif;
	font-weight:500;
	font-size:20px;
	/* width: 100%; */
	    text-align: center;
    padding: 25px;
}
.newsletter-box .subscribe-box
{	background:<?php  if(!empty($decodedData['wp_newsletter_bottom_part_color'])){echo $decodedData['wp_newsletter_bottom_part_color']; }else{ echo "#fff";} ?>;
	padding: 0px 15px;
	/*border:solid 1px #ccc;*/
	width: 100%;
	box-sizing: border-box;
}
.newsletter-box .email-text
{	color:<?php  if(!empty($decodedData['wp_newsletter_bottom_part_color'])){echo $decodedData['wp_newsletter_bottom_part_color']; }else{ echo "#2d5eb7";} ?>;
	text-align:center;
	font-size:16px;
	/*padding:15px 0px;*/
	 padding-bottom: 20px;
}
.newsletter-box .email-textbox
{	background:#f4f4f4;
	color:#808080;
	padding:10px;
	border:none;
	width: 100%;
	/*margin: 10px;*/
	font-size:16px;
	box-sizing:border-box;
	margin-bottom: 15px;
	border: 1px solid #ddd;
}
.newsletter-box .message-textarea
{	background:#f4f4f4;
	color:#808080;
	padding:15px;
	border:none;
	width: 100%;
	margin: 10px;
	font-size:16px;
	font-family: 'Roboto', sans-serif;
	max-width: 300px;
}
.newsletter-box .subscribe-button
{	color:#fff;
	text-transform:uppercase;
	padding: 15px;
	background:#7dca21 !important;
	border:none;
	font-size:18px;
	font-weight:600;
	width: 100%;
	margin-top: 20px;
}
.newsletter-box .thanksText{padding:10px 0 0;}
.newsletter-box .thanksText a
{ 	text-decoration:underline;
	font-size:14px;
	color:#fff;
	padding:15px;
}
.newsletter-box .textcenter{text-align:center;}
.newsletter-box .popupText{
	font-size:14px;
	color:#404040;
	padding:10px 0px; margin: 0;
	}

@media (max-width:419px){
.newsletter-box {
	max-width: 280px;
	box-sizing: border-box;
	-webkit-box-sizing: border-box;
}
.newsletter-box .subscribe_15 {
	padding: 8px 5px;
}
}
@media (max-width:374px){
.email-textbox {margin: 0;margin-top: 10px;}
.subscribe-button{margin: 0;margin-top: 10px;max-width: 330px;}
.email-text{padding:22px;}
.subscribe-box{padding: 0;}
}
</style>
<?php 
/*style of arrow btn*/
if($decodedData['wp_newsletter_closeposition']=="top-left-inside")
{?>
<style>

.newsletter-box #close {
    position: absolute;
    left: -11px;
    top: -6px;
    width: 32px;
    height: 32px;
    opacity: 1;
    color: #fff;
    border-radius: 100px;
    z-index: 99999;
}
 #close:before, #close:after {
    position: absolute;
    left: 27px;
    content: ' ';
    height: 15px;
    width: 2px;
    background-color: #fff;
    top: 14px;
}
#close:before {transform: rotate(45deg);}
#close:after {transform: rotate(-45deg);}
</style>
<?php }elseif($decodedData['wp_newsletter_closeposition']=="top-right-inside"){?>
<style>
  .newsletter-box #close {
    position: absolute;
    right: 15px;
    top: -6px;
    width: 32px;
    height: 32px;
    opacity: 1;
    color: #fff;
    border-radius: 100px;
    z-index: 99999;
}
 #close:before, #close:after {
     position: absolute;
    right: 5px;
    content: ' ';
    height: 15px;
    width: 2px;
    background-color: #fff;
    top: 14px;
}
#close:before {transform: rotate(45deg);}
#close:after {transform: rotate(-45deg);}
</style>
<?php }elseif($decodedData['wp_newsletter_closeposition']=="top-left-outside"){?>

<style>
.newsletter-box {
 width: 100%;
 / float: right; /
 position: fixed;
 bottom: 0;
 right: 15px;
 max-width: 360px;
 z-index: 99999;
}
.newsletter-box .subscribe
{ position: relative;
    width: 100% !important;
    display: none;
    overflow-y: auto;
    max-height: 80vh;
}
.newsletter-box #close { 
 position: absolute;
    left: -11px;
    top: -6px;
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
<?php }?>

<?php $count =0;?>
<div class="newsletter-box newsletter_<?php echo $newsletter->id;?>" id="<?php echo $newsletter->id;?>">
<?php if(!empty($decodedData['wp_newsletter_ribbon_show']) && ($decodedData['wp_newsletter_ribbon_show'] == 1)):?>
<div class="ribbon"><img src="<?php echo $decodedData['wp_newsletter_ribbon']; ?>"></div>
<?php endif;?>
<div id="custom_slidein" class="subscribe_<?php echo $newsletter->id;?>">  <div class="title"> <span>+</span> <?php echo $decodedData['wp_newsletter_heading'];?> </div>  </div>
<a href="#" id="close" class="close_<?php echo $newsletter->id;?>"></a>
  <div class="subscribe subscribe-box_<?php echo $newsletter->id;?>">
  <?php if(!empty($decodedData['wp_newsletter_heading'])) { 
	$color = $decodedData['wp_newsletter_heading_color'];
	if(empty($color))
	{
		$color = '#fff';
	}
	?>
            	<h1 style="color:<?php echo $color;?>"> <?php echo $decodedData['wp_newsletter_heading'];?></h1>
 <?php } ?>               
               	 
<!--                <a href="#close" class="sb-close-btn">x</a>
-->                <div class="subscribe-box">
                       <?php if(!empty($decodedData['wp_newsletter_description'])) {
		$pcolor = $decodedData['wp_newsletter_description_color'];
	if(empty($pcolor))
	{
		$pcolor = '#333';
	}	
	?>
						<div class="email-text" style="color:<?php echo $pcolor; ?>">
                			<?php echo $decodedData['wp_newsletter_description'];?>
               			 </div>
     <?php } ?>    
     	<span class="error" id="error_<?php echo $newsletter->id;?>"></span>                
                         <form class="subscribe-box-form" name="nl_<?php echo $newsletter->id;?>" id="nl_<?php echo $newsletter->id;?>">
	<!-- Email -->
	<?php if(isset($decodedData['wp_newsletter_showemail'])&& $decodedData['wp_newsletter_showemail'] == '1') { $count++;?>
	<input class="email-textbox subscribe-box-email validate_<?php echo $newsletter->id;?> email_validate_<?php echo $newsletter->id;?>" name="<?php echo $decodedData['wp_newsletter_emailfieldname'];?>" placeholder="<?php echo $decodedData['wp_newsletter_email'];?>" type="text">
	<?php } ?>
	
	<!-- Name -->
	<?php if(isset($decodedData['wp_newsletter_showname'])&& $decodedData['wp_newsletter_showname'] == '1') {$count++; ?>
	<input class="email-textbox subscribe-box-email validate_<?php echo $newsletter->id;?>" name="<?php echo $decodedData['wp_newsletter_namefieldname'];?>" placeholder="<?php echo $decodedData['wp_newsletter_name'];?>" type="text">
	<?php } ?>
	
	<!-- First Name -->
	<?php if(isset($decodedData['wp_newsletter_showfirstname'])&& $decodedData['wp_newsletter_showfirstname'] == '1') { $count++;?>
	<input class="email-textbox subscribe-box-email validate_<?php echo $newsletter->id;?>" name="<?php echo $decodedData['wp_newsletter_firstnamefieldname'];?>" placeholder="<?php echo $decodedData['wp_newsletter_firstname'];?>" type="text">
	<?php } ?>
	
	<!-- Last Name -->
	<?php if(isset($decodedData['wp_newsletter_showlastname'])&& $decodedData['wp_newsletter_showlastname'] == '1') {$count++; ?>
	<input class="email-textbox subscribe-box-email validate_<?php echo $newsletter->id;?>" name="<?php echo $decodedData['wp_newsletter_lastnamefieldname'];?>" placeholder="<?php echo $decodedData['wp_newsletter_lastname'];?>" type="text">
	<?php } ?>
	
	<!-- Phone -->
	<?php if(isset($decodedData['wp_newsletter_showphone'])&& $decodedData['wp_newsletter_showphone'] == '1') {$count++; ?>
	<input class="email-textbox subscribe-box-email validate_<?php echo $newsletter->id;?>" name="<?php echo $decodedData['wp_newsletter_phonefieldname'];?>" placeholder="<?php echo $decodedData['wp_newsletter_phone'];?>" type="text">
	<?php } ?>
	
	<!-- company -->
	<?php if(isset($decodedData['wp_newsletter_showcompany'])&& $decodedData['wp_newsletter_showcompany'] == '1') {$count++; ?>
	<input class="email-textbox subscribe-box-email validate_<?php echo $newsletter->id;?>" name="<?php echo $decodedData['wp_newsletter_companyfieldname'];?>" placeholder="<?php echo $decodedData['wp_newsletter_company'];?>" type="text">
	<?php } ?>
	
	<!-- zip -->
	<?php if(isset($decodedData['wp_newsletter_showzip'])&& $decodedData['wp_newsletter_showzip'] == '1') {$count++; ?>
	<input class="email-textbox subscribe-box-email validate_<?php echo $newsletter->id;?>" name="<?php echo $decodedData['wp_newsletter_zipfieldname'];?>" placeholder="<?php echo $decodedData['wp_newsletter_zip'];?>" type="text">
	<?php } ?>
	
	<!-- msg -->
	<?php if(isset($decodedData['wp_newsletter_showmessage'])&& $decodedData['wp_newsletter_showmessage'] == '1') {$count++; ?>
	<textarea class="email-textbox subscribe-box-email validate_<?php echo $newsletter->id;?>" name="<?php echo $decodedData['wp_newsletter_messagefieldname'];?>" placeholder="<?php echo $decodedData['wp_newsletter_message'];?>"></textarea>
	<?php } ?>
	<!-- terms -->
	<?php if(isset($decodedData['wp_newsletter_showterms'])&& $decodedData['wp_newsletter_showterms'] == '1') { ?>
	<input type="checkbox" value="Yes" name="TERMS" <?php echo($decodedData['wp_newsletter_termsrequired'] == '1') ? 'required' : '';?>/ <?php if($decodedData['wp_newsletter_termsrequired'] == '1') {?>id="term_<?php echo $newsletter->id;?>"<?php }?>> <?php echo $decodedData['wp_newsletter_terms'];?>
<span id="error_terms_<?php echo $newsletter->id;?>" class="error"></span>
	<?php } ?>
	
	<?php if($decodedData['wp_newsletter_showaction'] == '1')?>
	<input class="subscribe-box-action subscribe-button" name="subscribe-box-action" value="<?php echo $decodedData['wp_newsletter_action'];?>" type="button" id="subscribe-box-action-<?php echo $newsletter->id;?>">
	<div class="subscribe-box-afteractionmessage" style="display: none;"></div>
	<input type="hidden" value="<?php echo date("Y-m-d h:i:s");?>" name="TIME" />
	</form>
    	<?php if(isset($opt['wp_newsletter_savetolocal'])&& $decodedData['wp_newsletter_privacy_show'] == '1') {?>
	<div class="subscribe-box-privacy"><?php echo $decodedData['wp_newsletter_privacy'];?></div>
	<?php } ?>
      <div class="textcenter">
      	<?php if(!empty($decodedData['wp_newsletter_cancel'])) { ?>
      <div class="subscribe-box-cancel close_<?php echo $newsletter->id;?> thanksText"><a href="#" class="thanksText"><?php echo $decodedData['wp_newsletter_cancel'];?></a></div>
      <?php } ?>
       <p class="popupText" style="<?php if(isset($decodedData['wp_newsletter_privacy_show'])&& $decodedData['wp_newsletter_privacy_show'] == '1'){echo "color:".$decodedData['wp_newsletter_privacy_color'];}?>"><?php if(isset($decodedData['wp_newsletter_privacy_show'])&& $decodedData['wp_newsletter_privacy_show'] == '1'){echo $decodedData['wp_newsletter_privacy'];}?></p>
       </div>
					</div>
            </div>
            <div class="clear"></div>
        </div>
		<?php if($count>4):?>
		<style>
		.newsletter-box {
    overflow-y: auto;
    max-height: 80vh;
}
		</style>
		<?php endif;?>
<script>
	jQuery(document).ready(function() {
		/*code added by @vps */
		jQuery('#close').hide();
		jQuery('.newsletter-box .ribbon').hide();
		jQuery("#close").click(function(){
			jQuery('#close').hide();
			jQuery('.newsletter-box .ribbon').hide();
		});
		jQuery('#custom_slidein').click(function(){
			jQuery('#close').show();
			jQuery('.newsletter-box .ribbon').show();
		});
        jQuery('.thanksText').click(function(){
			jQuery('#close').hide();
			jQuery('.newsletter-box .ribbon').hide();
		});
		/*end of code*/
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
				   jQuery(".subscribe-box").hide();
				   jQuery(".subscribe").hide();	
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
