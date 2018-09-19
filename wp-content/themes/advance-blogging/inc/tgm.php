<?php
require get_template_directory() . '/inc/class-tgm-plugin-activation.php';
/**
* Recommended plugins.
*/
function advance_blogging_register_recommended_plugins() {
	$plugins = array(
		array(
			'name'      => 'WooCommerce',
			'slug'      => 'woocommerce',
			'required'  => true,
		)
	);
	$config = array();
	tgmpa( $plugins, $config );
}
add_action( 'tgmpa_register', 'advance_blogging_register_recommended_plugins' );