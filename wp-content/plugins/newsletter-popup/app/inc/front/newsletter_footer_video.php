<?php if ( ! defined( 'ABSPATH' ) ) exit; 
global $wpdb;
$tbl = $wpdb->prefix.'mk_newsletter_data';
$newsletters = $wpdb->get_results("select * from ".$tbl." where status = 'publish'");
$action = isset($_GET['action']) ? $_GET['action'] : '';
$cookieDelete = false;
if(!empty($newsletters) && is_array($newsletters )) { 
	foreach($newsletters  as $newsletter) {
		$decodedData = json_decode($newsletter->data, true);
?>
    <script>
	jQuery(window).load(function(e) {
        jQuery(".subscribebox_<?php echo $newsletter->id;?>").fadeIn();
    });
	jQuery(document).ready(function(){
		 jQuery(".close_<?php echo $newsletter->id;?>").click(function(e){
			 e.preventDefault();
			jQuery(".subscribebox_<?php echo $newsletter->id;?>").fadeOut();
				jQuery('#subscribebox_IFrameID').attr('src','');
		});
	});
	</script>
<style>
#main-newsletter-video{
	position:fixed;
	width:100%;
	height:100%;
	top:0;
	left:0;
	z-index: 99999;
	background: rgba(0, 0, 0, 0.32);
	padding: 0px 15px;
	box-sizing:border-box;
	-webkit-box-sizing:border-box;
}
#main-newsletter-video .newsletter-video-box{
	margin:0 auto;
	width:100%;
	margin-top: 4%;
}
.subscribe_vieo_pop .newsLetter{
	width:100%;
	max-width:760px;
	padding: 25px 0 10px;
	border-radius:3px;
	background: #f1ede6;
	background-size:cover;
	margin:1px auto;
	z-index: 9999;
	position: relative;
}
.subscribe_vieo_pop .newsLetter h1{
	color:#404040;
	font-weight:bold;
	font-size: 22px;
	text-transform:uppercase;
	text-align:center;
	letter-spacing:2px;
	padding: 20px 0 10px;
	position: relative;
	display: inline-block;
}
.subscribe_vieo_pop .newsLetter h1::before{
	content:"";
	background:url(../images/logo.png) no-repeat;
	width: 36px;
	height:36px;
	position: absolute;
	left: -44px;
	top: 24%;
}
.subscribe_vieo_pop .newsLetter p{
	text-align:center;
	line-height:25px;
	color:#404040;
	padding: 10px;
	font-family: 'Roboto Condensed', sans-serif;
	font-size: 16px;
	margin: 0;
}
.subscribe_vieo_pop .youtube-text{
	font-size: 34px;
	color:#404040;
	font-family: 'Oswald', sans-serif;
	text-align:center;
	letter-spacing: 3px;
	text-transform: uppercase;
	padding: 20px 0 0px;
	font-weight: 700;
}
.subscribe_vieo_pop .video-box{
	width:100%;
	display:block;
	padding: 10px;
	box-sizing: border-box;
	-webkit-box-sizing: border-box;
}
.subscribe_vieo_pop iframe{margin:auto;display:block;max-width: 700px;width: 100%;}
.subscribe_vieo_pop .textcenter{ text-align:center;}
.subscribe_vieo_pop .close-button {
	position: absolute;
	right: 17px;
	top: 14px;
	width: 35px;
	height: 35px;
	border-radius: 100%;
	border: solid 2px #7dca21;
	display: inline-block;
}
.subscribe_vieo_pop .close-button:before, .subscribe_vieo_pop .close-button:after {
  position: absolute;
  left: 16px;
  top:7px;
  content: ' ';
  height: 20px;
  width: 2px;
  background-color: #7dca21;
}
.subscribe_vieo_pop .close-button:before {
  transform: rotate(45deg);
}
.subscribe_vieo_pop .close-button:after {
  transform: rotate(-45deg);
}
@media only screen and (max-width:767px){
	.subscribe_vieo_pop .youtube-text {
	font-size: 24px;
}
#main-newsletter-video {
	overflow: auto;
}
}

</style>
    <div id="main-newsletter-video" class="subscribe_vieo_pop subscribebox_<?php echo $newsletter->id;?>" style="display: none;">
        <div class="newsletter-video-box" id="dialog" class="window">        
            <div class="newsLetter" style="background:<?php echo ($decodedData['wp_newsletter_backgroundimage'] !='' ) ? $decodedData['wp_newsletter_backgroundimage'] : $decodedData['wp_newsletter_backgroung_color']; ?>;background-repeat:<?php echo  $decodedData['wp_newsletter_backgroundimagerepeat'] ?>;background-position:<?php  echo $decodedData['wp_newsletter_backgroundimageposition']?>;" >
                <div class="textcenter"><img src="<?php echo ($decodedData['wp_newsletter_logo'] !='' ) ? $decodedData['wp_newsletter_logo'] : ''; ?>"></div>
                <div class="youtube-text" style="color:<?php echo ($decodedData['wp_newsletter_heading_color'] !='' ) ? $decodedData['wp_newsletter_heading_color'] : '#000'; ?>"><?php echo ($decodedData['wp_newsletter_heading'] !='' ) ? $decodedData['wp_newsletter_heading'] : 'YouTube Lightbox Popup'; ?></div>
				<div id="popupfoot"><a href="javascript:void(0)" class="close-button close agree close_<?php echo $newsletter->id;?>"></a></div>
				<?php if(!empty($decodedData['wp_newsletter_description'])): ?>
                <p style="color:<?php echo ($decodedData['wp_newsletter_description_color'] !='' ) ? $decodedData['wp_newsletter_description_color'] : '#000'; ?>"><?php echo $decodedData['wp_newsletter_description']; ?></p>
				<?php endif; ?>
				<div class="video-box">
					<iframe width="700" id="subscribebox_IFrameID" height="315" src="<?php echo ($decodedData['wp_newsletter-popup-video'] !='' ) ? $decodedData['wp_newsletter-popup-video'] : ''; ?>?autoplay=<?php echo ($decodedData['wp_newsletter-popup-videoautoplay'] !='' ) ? $decodedData['wp_newsletter-popup-videoautoplay'] : '0'; ?>" frameborder="0" allowfullscreen></iframe>
				</div>
            </div>
            <div class="clear"></div>
        </div>
        <div style="width: 1478px; font-size: 32pt; color:white; height: 602px; display: none; opacity: 0.8;" id="mask"></div>        
    </div> 

<?php } } ?>			  