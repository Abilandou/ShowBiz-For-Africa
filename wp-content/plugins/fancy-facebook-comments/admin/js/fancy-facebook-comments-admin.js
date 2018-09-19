var heateorFfcReferrer = null, heateorFfcReferrerVal = '', heateorFfcReferrerTabId = '';
jQuery(document).ready(function() {
	heateorFfcReferrer = jQuery('input[name=_wp_http_referer]'), heateorFfcReferrerVal = jQuery('input[name=_wp_http_referer]').val(), heateorFfcReferrerTabId = location.href.indexOf('#') > 0 ? location.href.substring(location.href.indexOf('#'), location.href.length) : '';
    if(heateorFfcReferrerTabId){heateorFfcSetReferrer(heateorFfcReferrerTabId) }
    jQuery("#tabs").tabs(), jQuery("#heateor_ffc_login_redirection_column").find("input[type=radio]").click(function() {
        jQuery(this).attr("id") && "heateor_ffc_login_redirection_custom" == jQuery(this).attr("id") ? jQuery("#heateor_ffc_login_redirection_url").css("display", "block") : jQuery("#heateor_ffc_login_redirection_url").css("display", "none")
    }), jQuery(".heateor_ffc_help_bubble").attr("title", heateorFfcHelpBubbleTitle), jQuery(".heateor_ffc_help_bubble").toggle(function() {
        jQuery("#" + jQuery(this).attr("id") + "_cont").show(), jQuery(this).attr("title", heateorFfcHelpBubbleCollapseTitle)
    }, function() {
        jQuery("#" + jQuery(this).attr("id") + "_cont").hide(), jQuery(this).attr("title", heateorFfcHelpBubbleTitle)
    })
    jQuery('#tabs ul a').click(function(){
    	heateorFfcSetReferrer(jQuery(this).attr('href'));
    });
    jQuery("#heateor_ffc_url_to_comment_column").find("input[type=radio]").click(function() {
        jQuery(this).attr("id") && "heateor_ffc_url_to_comment_custom" == jQuery(this).attr("id") ? jQuery("#heateor_ffc_url_to_comment_custom_url").css("display", "block") : jQuery("#heateor_ffc_url_to_comment_custom_url").css("display", "none")
    });
    jQuery("#heateor_ffc_url_to_comment_custom").is(":checked") ? jQuery("#heateor_ffc_url_to_comment_custom_url").css("display", "block") : jQuery("#heateor_ffc_url_to_comment_custom_url").css("display", "none"), jQuery("#heateor_ffc_vertical_url_to_comment_custom").is(":checked") ? jQuery("#heateor_ffc_vertical_url_to_comment_custom_url").css("display", "block") : jQuery("#heateor_ffc_vertical_url_to_comment_custom_url").css("display", "none")
});
function heateorFfcSetReferrer(href){
	jQuery(heateorFfcReferrer).val( heateorFfcReferrerVal.substring(0, heateorFfcReferrerVal.indexOf('#') > 0 ? heateorFfcReferrerVal.indexOf('#') : heateorFfcReferrerVal.length) + href );
}
jQuery("html, body").animate({ scrollTop: 0 });