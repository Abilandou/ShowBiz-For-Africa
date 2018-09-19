jQuery(document).ready(function(e) {
/* Mail chimp */
jQuery('#wp_newsletter_mailchimpapikeysave').click(function(e) {
	e.preventDefault();
   var mailchimp_key = jQuery('#wp_newsletter_mailchimpapikey').val();
   jQuery('#mailchimplist').html('');
   jQuery('#mailchimpError').text('');
	   var service = 'mailchimp';   
	   var data = {
					'action': 'newsletter_service_validator',
					'service': service,
					'mailchimp_apikey': mailchimp_key
				};
				// We can also pass the url value separately from ajaxurl for front end AJAX implementations
				jQuery.post(ajaxurl , data, function(response) {
				var Data = jQuery.parseJSON(response);
				if(Data.success == true)
				{
					jQuery('#mailchimpError').text('');
					jQuery('#mailchimplist').html(Data.data);
				}
				else
				{
					jQuery('#mailchimpError').text('');
					jQuery('#mailchimpError').text(Data.message);
				}
				}); 
  });	
});