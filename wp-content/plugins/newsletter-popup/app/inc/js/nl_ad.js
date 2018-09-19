jQuery(window).load(function(e) {
				jQuery('.nlhdm').delay( 5000 ).slideDown('slow');
			});
   jQuery(document).ready(function() {			
				jQuery('.close_nl_help').on('click', function(e) {
					var what_to_do = jQuery(this).data('ct');
					 jQuery.ajax({
						 type : "post",
						 url : ajaxurl,
						 data : {action: "mk_np_close_np_help", what_to_do : what_to_do},
						 success: function(response) {
							jQuery('.nlhdm').slideUp('slow');
						 }
						});	});
});