<style>
.wp_newsletter_typeitem {
    box-sizing: border-box;
    display: inline-block;
    margin: 4px;
    overflow: visible;
    padding: 12px;
    position: relative;
    text-align: center;
    vertical-align: bottom;
    width: 320px;
}
.wp_newsletter_typeitem img {
    max-width: 90%;
}
.wp_newsletter_typeitem img:hover {
    outline: 4px solid #009;
}
.wp_newsletter_typeitem-title {
    color: #333333;
    font-size: 18px;
    font-weight: 700;
    line-height: 18px;
    text-align: center;
    margin: 15px 0;
}
.wp_newsletter_typeitem-title a {
    text-decoration: none;
}
.custom_pop_k{
	position:fixed;
	width:100%;
	height:100%;
	top:0;
	left:0;
	background:rgba(0,0,0,0.6);
	display:none;
	z-index:9999;
}
.custom_pop_k .custom_pop_k_tbl{
	display:table;
	height:100%;
	width:100%;
}
.custom_pop_k .custom_pop_k_tbl .custom_pop_k_cel{
	display:table-cell;
	vertical-align:middle;
}
.custom_pop_k .custom_pop_k_tbl .custom_pop_k_cel .custom_pop_k_inner{
	background:#fff;
	max-width:550px;
	width:100%;
	margin:0 auto;
	position: relative;
	padding:15px;
	box-shadow:0px 1px 6px #222;
}
.custom_pop_k .custom_pop_k_tbl .custom_pop_k_cel .custom_pop_k_inner .close_k_pop {
	right: -15px;
	position: absolute;
	display: inline-block;
	background: red;
	width: 20px;
	height: 20px;
	color: #fff;
	font-weight:bold;
	border-radius: 20px;
	text-align: center;
	text-decoration: none;
	padding: 4px;
	top: -15px;
}

.wp_newsletter_type_btns{ 
	display:none;
}
.wp_newsletter_typeimage{ 
	position:relative;
}
.wp_newsletter_typeimage .overlay-text{ 
	display:none;
}
.wp_newsletter_typeimage:hover .overlay-text {
	display: block;
	background: rgba(0,0,0,0.7);
	width: 100%;
	height: 100%;
	z-index: 1;
	position: absolute;
	top:0;
	transition: all 0.5s ease;
	-ms-transition: all 0.5s ease;
	-webkit-transition: all 0.5s ease;
	-moz-transition: all 0.5s ease;
	-o-transition: all 0.5s ease;
}
.wp_newsletter_typeimage:hover .wp_newsletter_type_btns{ 
	display:block;
	position:absolute;
	top:44%;
	left:30%;
	text-align:center;	
	z-index:2;
}
.wp_newsletter_type_btns a{
	text-decoration:none;
	color:#fff;
}
.wp_newsletter_type_btns span{
	font-size:40px;
	padding:0 15px;
}

a:hover,
a:active,
a:focus {
     box-shadow:none;
	 -webkit-box-shadow:none;
}
</style>
<?php
$urlJqueryUI = esc_url("https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js");
wp_register_script('my-jquery-ui', $urlJqueryUI, false, '', false);
wp_enqueue_script('my-jquery-ui');
/* Free Stuff */
$newsletters = array('newsletters' => array(
      'Popup type 1 - PRO' => array('type'=>'popup_1_pro', 'image' => '0BxzGa77-1XKXV00zV3dZc3JYZHc','des' => 'Create a lightbox popup that displays in the center of the web browser'),
	  'Popup type 2 - PRO' => array('type'=>'popup_2_pro', 'image' => '0BxzGa77-1XKXdi1fSnZVQThBQVk','des' => 'Create a lightbox popup that displays in the center of the web browser'),
	  'Popup type 3 - PRO' => array('type'=>'popup_3_pro', 'image' => '0BxzGa77-1XKXQWxXQlM4d05rQlU','des' => 'Create a lightbox popup that displays in the center of the web browser'),
	  'Popup type 4 - PRO' => array('type'=>'popup_4_pro', 'image' => '0BxzGa77-1XKXNm92NERURHRfQWc','des' => 'Create a lightbox popup that displays in the center of the web browser'),
	  'Popup type 5 - PRO' => array('type'=>'popup_5_pro', 'image' => '0BxzGa77-1XKXN0VlQlJ4bEVSczA','des' => 'Create a lightbox popup that displays in the center of the web browser'),
	  'Popup type 6 - PRO' => array('type'=>'popup_6_pro', 'image' => '0BxzGa77-1XKXRTBVUW5pNDVoMFE','des' => 'Create a lightbox popup that displays in the center of the web browser'),
	  'Popup type 7 - PRO' => array('type'=>'popup_7_pro', 'image' => '0BxzGa77-1XKXNzhFVEtqMy1nSUU','des' => 'Create a lightbox popup that displays in the center of the web browser'),
	  'Popup type 8 - PRO' => array('type'=>'popup_8_pro', 'image' => '0BxzGa77-1XKXOXAzaWIxaWFDQ28','des' => 'Create a lightbox popup that displays in the center of the web browser'),
	  'Popup type 9 - PRO' => array('type'=>'popup_9_pro', 'image' => '0BxzGa77-1XKXZy1zOC02RXdxbVU','des' => 'Create a lightbox popup that displays in the center of the web browser'),
	  'Popup type 10 - PRO' => array('type'=>'popup_10_pro', 'image' => '0BxzGa77-1XKXSkpNUmRkME12V00','des' => 'Create a lightbox popup that displays in the center of the web browser'),
	'Lightbox' => array('type'=>'lightbox', 'image' => '0BxzGa77-1XKXQk1XOThqWmNWZXc','des' => 'Create a lightbox popup that displays in the center of the web browser'),
	'Embed video' => array('type'=>'video', 'image' => '0BxzGa77-1XKXZ2dYQ3BzbnBrUG8','des' => 'Embed Youtube videos'),
	'Slide In' => array('type'=>'slidein', 'image' => '0BxzGa77-1XKXOFhRdzB2VTk0UUU','des' => 'Create a popup that slides in from corner'),
	'Lightbox' => array('type'=>'lightbox', 'image' => '0BxzGa77-1XKXQk1XOThqWmNWZXc','des' => 'Create a lightbox popup that displays in the center of the web browser'),
	 'Notification Bar' => array('type'=>'bar', 'image' => '0BxzGa77-1XKXQ3hxc0RfU1k4OVk','des' => 'Create a bar that displays on top or bottom of the web page'),			
        'Popup' => array('type'=>'popup', 'image' => '0BxzGa77-1XKXaGlremFSTU94eEE','des' => 'Create a lightbox popup that displays in the center of the web browser'),	
	  'Popup type 2' => array('type'=>'popup2', 'image' => '0BxzGa77-1XKXZnYxQ3VDalRQNTQ','des' => 'Create a lightbox popup that displays in the center of the web browser'),	
	  'Popup type 3' => array('type'=>'popup3', 'image' => '0BxzGa77-1XKXRGdXRVFWR3JvYnM','des' => 'Create a lightbox popup that displays in the center of the web browser'),
	  'Popup type 4' => array('type'=>'popup4', 'image' => '0BxzGa77-1XKXN0tpQ3U0S3AtcUU','des' => 'Create a lightbox popup that displays in the center of the web browser'),
	  'Popup type 5' => array('type'=>'popup5', 'image' => '0BxzGa77-1XKXZGdPTFlSODNTMTg','des' => 'Create a lightbox popup that displays in the center of the web browser'),	
	  'Popup type 6' => array('type'=>'popup6', 'image' => '0BxzGa77-1XKXelhCU2U3aU9kUGc','des' => 'Create a lightbox popup that displays in the center of the web browser'),
	  'Popup type 7' => array('type'=>'popup7', 'image' => '0BxzGa77-1XKXQUZJNDhoc08zS1E','des' => 'Create a lightbox popup that displays in the center of the web browser'),	
	  'Popup type 8' => array('type'=>'popup8', 'image' => '0BxzGa77-1XKXTjlmcUd2NUcwWEU','des' => 'Create a lightbox popup that displays in the center of the web browser'),
)); 
/* PRO Stuff */
?>
<div class="wrap">
<?php $this->load_help_desk();?>
		<div id="icon-wp_newsletter-popup" class="icon32"><br></div>
			
		<h2><?php _e('New Popup','nlp');?> <a href="?page=wp_newsletter_show_items" class="add-new-h2"> <?php _e('Manage Popups','nlp');?>  </a></h2>
		
			<div style="text-align:center;">
			<p style="font-size:24px;"><?php _e('Select A Display Type','nlp');?></p>
		<?php foreach($newsletters['newsletters'] as $name => $newsletter) { ?>
               <div class="wp_newsletter_typeitem">
					<div class="wp_newsletter_typeimage">
						<a href="?page=wp_newsletter_add_new&amp;type=<?php echo $newsletter['type']?>"><img src="https://drive.google.com/uc?export=view&id=<?php echo $newsletter['image']?>"></a>
						
						<div class="overlay-text"></div>

						<div class="wp_newsletter_type_btns">
						<a href="?page=wp_newsletter_add_new&amp;type=<?php echo $newsletter['type']?>"><span class="dashicons dashicons-plus-alt"></span></a>
						<a href="javascript:void(0);" class="openpop_k" id="<?php echo $newsletter['type']?>" data-image="https://drive.google.com/uc?export=view&id=<?php echo $newsletter['image']?>"><span class="dashicons dashicons-search"></span></a>
						</div>
					</div>
					
					<div class="wp_newsletter_typetext">
					<p class="wp_newsletter_typeitem-title"><a href="?page=wp_newsletter_add_new&amp;type=<?php echo $newsletter['type']?>"><?php echo $name; ?></a></p>
					<p class="wp_newsletter_typeitem-description"><?php echo $newsletter['des']?></p>
					</div>
			
				</div>
        <?php } ?>	
				    <div class="custom_pop_k" id="pop_<?php echo $newsletter['type']?>">
						<div class="custom_pop_k_tbl">
							<div class="custom_pop_k_cel">
								<div class="custom_pop_k_inner">
									<a class="close_k_pop" id="close_<?php echo $newsletter['type']?>" href="javascript:void(0)">X</a>
									<img src="" id="popImg" class="popImg" width="100%">
								</div> <!--custom_pop_k_inner-->
							</div> <!--custom_pop_k_cel-->
						</div> <!--custom_pop_k_tbl-->
					</div> <!--custom_pop_k-->
       	<div style="clear:both;"></div>
			</div>
            
            <hr />     		
<div class="clear"></div>
<div>
<script>
jQuery(document).ready(function(e){
	jQuery('.custom_pop_k').hide();
	jQuery('.openpop_k').click(function(e) {
		e.preventDefault();
		var imageValue = jQuery(this).attr('data-image');
		jQuery('img.popImg').attr("src",imageValue);
		jQuery('.custom_pop_k').show();		
    });
	 jQuery('.close_k_pop').click(function() {
		jQuery('.custom_pop_k').hide();
	 });
	  jQuery('.custom_pop_k').click(function() {
		jQuery('.custom_pop_k').hide();
	 });
	
});
</script>