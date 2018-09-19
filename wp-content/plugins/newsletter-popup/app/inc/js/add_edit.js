jQuery(document).ready(function(e) {
jQuery('ul.tabs').each(function(){
  // For each set of tabs, we want to keep track of
  // which tab is active and its associated content
  var active, content, links = jQuery(this).find('a');

  // If the location.hash matches one of the links, use that as the active tab.
  // If no match is found, use the first link as the initial active tab.
  active = jQuery(links.filter('[href="'+location.hash+'"]')[0] || links[0]);
  active.addClass('active');

  content = (active[0].hash);

  // Hide the remaining content
  links.not(active).each(function () {
    jQuery(this.hash).hide();
  });

  // Bind the click event handler
  jQuery(this).on('click', 'a', function(e){
    // Make the old tab inactive.
    active.removeClass('active');
    jQuery(content).hide();

    // Update the variables with the new link and content
    active = jQuery(this);
    content = jQuery(this.hash);

    // Make the tab active.
    active.addClass('active');
    jQuery(content).show();

    // Prevent the anchor's default click action
    e.preventDefault();
  });
});
});
/* Uploader */
function open_media_uploader_image(id)
{

			media_uploader = wp.media({
				frame:    "post", 
				state:    "insert",
				multiple: false
			});

			media_uploader.on("insert", function(){
		
			var length = media_uploader.state().get("selection").length;
			var images = media_uploader.state().get("selection").models;
			
			for(var iii = 0; iii < length; iii++)
			{
				var image_url = images[iii].changed.url;
				var image_caption = images[iii].changed.caption;
				var image_title = images[iii].changed.title;
                jQuery('#'+id).val(image_url);			
			}
		});
			media_uploader.open();
			
}
function clear_uploader_image(id)
{
 jQuery('#'+id).val('');		
}
jQuery(document).ready(function(e) {
     jQuery('.nl-color-picker').wpColorPicker();
  var option = jQuery('#wp_newsletter_subscription').find('option:selected').val();
   if(option != 'noservice')
   {
	jQuery('#wp_newsletter_service_response').html('');    
   	jQuery('#form_loading').show();
     var data = {
					'action': 'newsletter_service_form',
					'service': option,
					'rid' : rid
				};
				// We can also pass the url value separately from ajaxurl for front end AJAX implementations
				jQuery.post(ajaxurl , data, function(response) {
					jQuery('#form_loading').hide();
					jQuery('#wp_newsletter_service_response').html(response);
					});
   }
   else
   {
	jQuery('#form_loading').hide();
	jQuery('#wp_newsletter_service_response').html('');   
   } 
	 
	 
	 
/* Subscribe Service Change*/	 
jQuery('#wp_newsletter_subscription').change(function(e) {
   var option = jQuery(this).find('option:selected').val();
   if(option != 'noservice')
   {
	jQuery('#wp_newsletter_service_response').html('');    
   	jQuery('#form_loading').show();
     var data = {
					'action': 'newsletter_service_form',
					'service': option,
					'rid' : rid
				};
				// We can also pass the url value separately from ajaxurl for front end AJAX implementations
				jQuery.post(ajaxurl , data, function(response) {
					jQuery('#form_loading').hide();
					jQuery('#wp_newsletter_service_response').html(response);
					});
   }
   else
   {
	jQuery('#form_loading').hide();
	jQuery('#wp_newsletter_service_response').html('');   
   }
});  
});