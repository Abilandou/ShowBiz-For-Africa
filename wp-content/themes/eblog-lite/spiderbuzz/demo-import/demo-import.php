<?php
/**
 * ecommerce Lite Import Options 
 * Demo Import File 
 */
function eblog_lite_import_files() {
    return array(
      array(
        'import_file_name'           => 'Default',
        'categories'                 => array( 'Blog'),
        'import_file_url'            =>  get_template_directory_uri() . '/spiderbuzz/demo-import/eblog_lite.xml',
        'import_widget_file_url'     =>  get_template_directory_uri() . '/spiderbuzz/demo-import/eblog_lite.wie',
        'import_customizer_file_url' =>  get_template_directory_uri() . '/spiderbuzz/demo-import/eblog_lite.dat',
        
        'import_preview_image_url'   =>  get_template_directory_uri() . '/screenshot.png',
        'import_notice'              => __( 'After you import this demo, you will have to setup the slider separately.', 'eblog-lite' ),
        'preview_url'                => 'http://demo.spiderbuzz.com/eblog-lite',
      ),
      array(
        'import_file_name'           => 'Default',
        'categories'                 => array( 'Blog'),
        'import_file_url'            =>  get_template_directory_uri() . '/spiderbuzz/demo-import/eblog_lite.xml',
        'import_widget_file_url'     =>  get_template_directory_uri() . '/spiderbuzz/demo-import/eblog_lite.wie',
        'import_customizer_file_url' =>  get_template_directory_uri() . '/spiderbuzz/demo-import/eblog_lite.dat',
        
        'import_preview_image_url'   =>  get_template_directory_uri() . '/screenshot.png',
        'import_notice'              => __( 'After you import this demo, you will have to setup the slider separately.', 'eblog-lite' ),
        'preview_url'                => 'http://demo.spiderbuzz.com/eblog-lite',
      ),
      
    );
  }
  add_filter( 'pt-ocdi/import_files', 'eblog_lite_import_files' );


  
/*****************************************************************
*         After Demo Import Functions
*************************************************************/
function eblog_lite_after_import_setup() {
  // Assign menus to their locations.
  $main_menu = get_term_by( 'name', 'Primary Menu', 'nav_menu' );
  $top_menu = get_term_by( 'name', 'td-demo-top-menu', 'nav_menu' );
  
  set_theme_mod( 'nav_menu_locations', array(
    'top-bar-menu' => $top_menu->term_id,
    'menu-1' => $main_menu->term_id,
    )
  );

}
add_action( 'pt-ocdi/after_import', 'eblog_lite_after_import_setup' );


