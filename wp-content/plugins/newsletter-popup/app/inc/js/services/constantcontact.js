jQuery(document).ready(function(e) {
/* Constant Contact */
jQuery('#wp_newsletter_constantcontactapikeysave').click(function(e) {
	e.preventDefault();
   jQuery('#constantcontactlist').html('<span class="wait">Connecting to Constant Contact Server, Please Wait...</span>');
   jQuery('#constantcontactError').text('');
   var constantcontactapikey = jQuery('#wp_newsletter_constantcontactapikey').val();
   var constantcontactaccesstoken = jQuery('#wp_newsletter_constantcontactaccesstoken').val();
	   var service = 'constantcontact';   
	   var data = {
					'action': 'newsletter_service_validator',
					'service': service,
					'constantcontactapikey': constantcontactapikey,
					'constantcontactaccesstoken': constantcontactaccesstoken,
				};
				// We can also pass the url value separately from ajaxurl for front end AJAX implementations
				jQuery.post(ajaxurl , data, function(response) {
				var Data = jQuery.parseJSON(response);
				if(Data.success == true)
				{
					jQuery('#constantcontactError').text('');
					jQuery('#constantcontactlist').html(Data.data);
				}
				else
				{
					jQuery('#constantcontactlist').html('<span class="error">Some Problem Found! Check Error Message Above.</span>');
					jQuery('#constantcontactError').text(Data.message);
				}
				}); 
  });	
});