jQuery(document).ready(function(e) {
/* Mailpoet */
jQuery('#wp_newsletter_mailpoetsave').click(function(e) {
	e.preventDefault();
   jQuery('#mailpoetlist').html('');
   jQuery('#mailpoetError').text('');
	   var service = 'mailpoet';   
	   var data = {
					'action': 'newsletter_service_validator',
					'service': service,
				};
				// We can also pass the url value separately from ajaxurl for front end AJAX implementations
				jQuery.post(ajaxurl , data, function(response) {
				var Data = jQuery.parseJSON(response);
				if(Data.success == true)
				{
					jQuery('#mailpoetError').text('');
					jQuery('#mailpoetlist').html(Data.data);
				}
				else
				{
					jQuery('#mailpoetError').text(Data.message);
					  jQuery('#mailpoetlist').html('');
				}
				}); 
  });	
});