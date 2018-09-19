<?php
if(!empty($service))
{ 
$current_user = wp_get_current_user();
$cuid = $current_user->ID; 
$opt = $this->decoded_data($rid, $cuid);
?>
<script src="<?php echo plugins_url('js/services/'.$service.'.js', __FILE__);?>"></script>
<?php	
	/* Active Campaign */
	if($service == 'activecampaign')
	{ ?>						<h4>Active Campaign Options</h4>	
						<table class="wp_newsletter-form-table-options">
						
						<tbody><tr><td>Your Active Campaign API Access URL:
						</td><td><input name="wp_newsletter_activecampaignapiurl" id="wp_newsletter_activecampaignapiurl" value="<?php echo $opt['wp_newsletter_activecampaignapiurl'];?>" class="wp_newsletter_option regular-text" type="text">
						</td>
						</tr>
						
						<tr><td>Your Active Campaign API Access Key:
						</td><td><input name="wp_newsletter_activecampaignapikey" id="wp_newsletter_activecampaignapikey" value="<?php echo $opt['wp_newsletter_activecampaignapikey'];?>" class="wp_newsletter_option regular-text" type="text">
						<input name="wp_newsletter_activecampaignapikeysave" id="wp_newsletter_activecampaignapikeysave" class="button button-primary" value="Apply" type="submit"></td>
						</tr>
						<tr><td></td><td><a href="https://www.wonderplugin.com/wordpress-popup/active-campaign-wordpress-email-subscription-form/" target="_blank">Where do I get the API Access URL and Key</a></td></tr>
												
						</tbody></table>
 <?php } 
 else if($service == 'campaignmonitor')
 { ?>
						<h4>Campaign Monitor Options</h4>	
						<table class="wp_newsletter-form-table-options">
						
						<tbody><tr><td>Your Campaign Monitor API key:
						</td><td><input name="wp_newsletter_campaignmonitorapikey" id="wp_newsletter_campaignmonitorapikey" value="<?php echo $opt['wp_newsletter_campaignmonitorapikey'];?>" class="wp_newsletter_option regular-text" type="text">
						</td>
						</tr>
						
						<tr><td>Your Campaign Monitor client ID:
						</td><td><input name="wp_newsletter_campaignmonitorclientid" id="wp_newsletter_campaignmonitorclientid" value="<?php echo $opt['wp_newsletter_campaignmonitorclientid'];?>" class="wp_newsletter_option regular-text" type="text">
						<input name="wp_newsletter_campaignmonitorapikeysave" id="wp_newsletter_campaignmonitorapikeysave" class="button button-primary" value="Apply" type="submit"></td>
						</tr>
						<tr><td></td><td><a href="https://www.wonderplugin.com/wordpress-popup/campaign-monitor-wordpress-email-subscription-form/" target="_blank">Where do I find the API key and client ID</a></td></tr>
												
						</tbody></table>
 <?php }
 else if($service == 'constantcontact')
 { ?>
						<h4>Constant Contact Options</h4>	
                        <span id="constantcontactError" class="error"></span>
						<table class="wp_newsletter-form-table-options">
						
						<tbody><tr><td>Your Constant Contact App API key:
						</td><td><input name="wp_newsletter_constantcontactapikey" id="wp_newsletter_constantcontactapikey" value="<?php echo $opt['wp_newsletter_constantcontactapikey'];?>" class="wp_newsletter_option regular-text" type="text">
						</td>
						</tr>
						
						<tr><td>Your Constant Contact Access Token:
						</td><td><input name="wp_newsletter_constantcontactaccesstoken" id="wp_newsletter_constantcontactaccesstoken" value="<?php echo $opt['wp_newsletter_constantcontactaccesstoken'];?>" class="wp_newsletter_option regular-text" type="text">
						<input name="wp_newsletter_constantcontactapikeysave" id="wp_newsletter_constantcontactapikeysave" class="button button-primary" value="Apply" type="submit"></td>
						</tr>
						<tr><td></td><td><a href="https://www.wonderplugin.com/wordpress-popup/constant-contact-wordpress-email-subscription-form/" target="_blank">Where do I get an API Key and the Access Token</a></td></tr>
												
						</tbody></table>
						<div id="constantcontactlist"></div>
                        
                       
<?php } else if($service == 'icontact') { ?>  
						<h4>iContact Options</h4>	
						<table class="wp_newsletter-form-table-options">
						
						<tbody><tr><td>Your iContact Username (maybe your email address):
						</td><td><input name="wp_newsletter_icontactusername" id="wp_newsletter_icontactusername" value="<?php echo $opt['wp_newsletter_icontactusername'];?>" class="wp_newsletter_option regular-text" type="text">
						</td>
						</tr>
						
						<tr><td>Your iContact Application ID:
						</td><td><input name="wp_newsletter_icontactappid" id="wp_newsletter_icontactappid" value="<?php echo $opt['wp_newsletter_icontactappid'];?>" class="wp_newsletter_option regular-text" type="text">
						</td>
						</tr>
						
						<tr><td>Your iContact Application Password:
						</td><td><input name="wp_newsletter_icontactapppassword" id="wp_newsletter_icontactapppassword" value="<?php echo $opt['wp_newsletter_icontactapppassword'];?>" class="wp_newsletter_option regular-text" type="text">
						<input name="wp_newsletter_icontactsave" id="wp_newsletter_icontactsave" class="button button-primary" value="Apply" type="submit"></td>
						</tr>
						<tr><td></td><td><a href="https://www.wonderplugin.com/wordpress-popup/icontact-wordpress-email-subscription-form/" target="_blank">Where do I get an Application ID and the Application Password</a></td></tr>
												
						</tbody></table>	
<?php } else if($service == 'infusionsoft') { ?>
						<h4>Infusionsoft Options</h4>	
						<table class="wp_newsletter-form-table-options">
						
						<tbody><tr><td>Your Infusionsoft Subdomain:
						</td><td><input name="wp_newsletter_infusionsoftsubdomain" id="wp_newsletter_infusionsoftsubdomain" value="<?php echo $opt['wp_newsletter_infusionsoftsubdomain'];?>" class="wp_newsletter_option medium-text" type="text">.infusionsoft.com
						</td>
						</tr>
						
						<tr><td>Your Infusionsoft API Key:
						</td><td><input name="wp_newsletter_infusionsoftapikey" id="wp_newsletter_infusionsoftapikey" value="<?php echo $opt['wp_newsletter_infusionsoftapikey'];?>" class="wp_newsletter_option regular-text" type="text">
						<input name="wp_newsletter_infusionsoftapikeysave" id="wp_newsletter_infusionsoftapikeysave" class="button button-primary" value="Apply" type="submit"></td>
						</tr>
						<tr><td></td><td><a href="https://www.wonderplugin.com/wordpress-popup/infusionsoft-wordpress-email-subscription-form/" target="_blank">Where do I find the subdomain and the API Key</a></td></tr>
												
						</tbody></table>
<?php } else if($service == 'getresponse') {?>
						<h4>GetResponse Options</h4>	
						<table class="wp_newsletter-form-table-options">
						
						<tbody><tr><td>Your GetResponse API key:
						</td><td><input name="wp_newsletter_getresponseapikey" id="wp_newsletter_getresponseapikey" value="<?php echo $opt['wp_newsletter_getresponseapikey'];?>" class="wp_newsletter_option regular-text" type="text">
						<input name="wp_newsletter_getresponseapikeysave" id="wp_newsletter_getresponseapikeysave" class="button button-primary" value="Apply" type="submit"></td>
						</tr>
						<tr><td></td><td><a href="https://www.wonderplugin.com/wordpress-popup/getresponse-wordpress-email-subscription-form/" target="_blank">Where do I find the API key</a></td></tr>
												</tbody></table>
<?php } else if($service == 'mailchimp') {?>
						<h4>MailChimp Options</h4>	
                        <span id="mailchimpError" class="error"></span>
						<table class="wp_newsletter-form-table-options">
						
						<tbody><tr><td>Double opt-in:
						</td><td>
						<label><input name="wp_newsletter_mailchimpdoubleoptin" id="wp_newsletter_mailchimpdoubleoptin" value="1" <?php echo ($opt['wp_newsletter_mailchimpdoubleoptin'] == '1') ? 'checked = "checked"' : '';?> class="wp_newsletter_option" type="checkbox"> The subscribers must confirm their email address before being subscribed.</label>
						</td></tr>
						
						<tr><td>Your MailChimp API key:
						</td><td><input name="wp_newsletter_mailchimpapikey" id="wp_newsletter_mailchimpapikey" value="<?php echo $opt['wp_newsletter_mailchimpapikey'];?>" class="wp_newsletter_option regular-text" type="text">
						<input name="wp_newsletter_mailchimpapikeysave" id="wp_newsletter_mailchimpapikeysave" class="button button-primary" value="Apply" type="submit"></td>
						</tr>
						<tr><td></td><td><a href="https://www.wonderplugin.com/wordpress-popup/mailchimp-wordpress-email-subscription-form/" target="_blank">Where do I find the API key</a></td></tr>
												
						</tbody></table>
					<div id="mailchimplist"></div>
<?php } else if($service == 'mailpoet') {?>
						<h4>MailPoet Options</h4>	
                        <span id="mailpoetError" class="error"></span>
						<table class="wp_newsletter-form-table-options">						
						<tbody><tr><td><input name="wp_newsletter_mailpoetsave" id="wp_newsletter_mailpoetsave" class="button button-primary" value="Retrieve MailPoet Lists" type="submit"></td>
						<td>
						</td></tr>
												
						</tbody></table>
						<div id="mailpoetlist"></div>
<?php } ?>                 
<?php } ?>