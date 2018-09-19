jQuery(document).ready(function($) {

	/**
	 *	Process request to dismiss our admin notice
	 */
	$('#videoblog-admin-notice-postsnum .notice-dismiss').click(function() {

		//* Data to make available via the $_POST variable
		data = {
			action: 'videoblog_admin_notice_postsnum',
			videoblog_admin_notice_nonce: videoblog_admin_notice_postsnum.videoblog_admin_notice_nonce
		};

		//* Process the AJAX POST request
		$.post( ajaxurl, data );

		return false;
	});
});