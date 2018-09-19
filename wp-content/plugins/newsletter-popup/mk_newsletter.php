<?php
/*
Plugin Name: Newsletter Popup
Plugin URI: http://www.webdesi9.com/newsletter-popup
Description: WordPress Newsletter Popup Plugin
Version: 1.2
Author: mndpsingh287
Author URI: https://profiles.wordpress.org/mndpsingh287/
*/
if (defined('MK_NEWSLETTER_VERSION'))
	return;
define('MK_NEWSLETTER_VERSION', '1.2');
define('MK_NEWSLETTER_URL', plugin_dir_url( __FILE__ ));
define('MK_NEWSLETTER_PATH', plugin_dir_path( __FILE__ ));
define('MK_NEWSLETTER_PLUGIN', basename(dirname(__FILE__)) . '/' . basename(__FILE__));
define('MK_NEWSLETTER_PLUGIN_VERSION', '1.2');
if(!function_exists('wp_get_current_user')) {
    include(ABSPATH . "wp-includes/pluggable.php"); 
}
$apps = array('mk_newsletter_controller', 'mk_newsletter_service_validator', 'mk_newsletter_send');
foreach($apps as $app)
{
	if(!class_exists($app))
	{
	  require_once('app/'.$app.'.php');
	}
}
if(!class_exists('newsletter_popup'))
{
	class newsletter_popup
	{
	  /*
	  Construct
	  */
	  public function __construct()
	  {
		  $timeZone = get_option('timezone_string');
		  if(!empty($timeZone)) {
		  date_default_timezone_set(get_option('timezone_string'));
		  }
		  else {
		   date_default_timezone_set("Asia/Kolkata");
		  }
		  $this->init();
	  }
	  /*
	  init
	  */
	  public function init()
	  {
		  
		$this->controller = new mk_newsletter_controller(); 
		
		$this->service_validator_controller = new mk_newsletter_service_validator();  
		
		$this->send =  new mk_newsletter_send();
		
	    add_action( 'admin_menu', array($this, 'register_menu') );
		
		register_activation_hook(__FILE__, array(&$this,'mk_newsletter_activation_process'));
		
		add_action('wp_footer', array(&$this, 'mk_newsletter_footer'));
		   
		add_action( 'wp_ajax_save_newsletter', array(&$this, 'save_newsletter_callback'));
		
        add_action( 'wp_ajax_nopriv_save_newsletter', array(&$this, 'save_newsletter_callback'));  
		
		add_action( 'wp_ajax_newsletter_service_form', array(&$this, 'newsletter_service_form'));
		
        add_action( 'wp_ajax_nopriv_newsletter_service_form', array(&$this, 'newsletter_service_form'));  
		
		add_action( 'wp_ajax_newsletter_service_validator', array(&$this, 'newsletter_service_validator'));
		
        add_action( 'wp_ajax_nopriv_newsletter_service_validator', array(&$this, 'newsletter_service_validator'));  
		
		add_action("wp_ajax_mk_np_close_np_help", array($this, "mk_np_close_np_help"));
		 
		add_action( 'admin_init', array(&$this, 'enqueue_script') );
		    
		add_action( 'admin_post_newsletter_popup_export_csv', array($this, 'export_csv') );
		  
	  }
	  /*
	  Register Menus
	  */
	  public function register_menu()
	  {
		$setting_options = get_option('mk_newsletter_settings');
		if(empty($setting_options['userrole'])){  
		$userrole = 'manage_options';  
		}
		else{
	    $userrole = $setting_options['userrole'];		
		}
		$menu = add_menu_page(
				__('Newsletter Popup', 'wp_newsletter_popup'),
				__('Newsletter Popup', 'wp_newsletter_popup'),
				$userrole,
				'wp_newsletter_overview',
				array($this, 'show_overview'),
				MK_NEWSLETTER_URL . 'images/logo-16.png' );
		
		$menu = add_submenu_page(
				'wp_newsletter_overview',
				__('Overview', 'wp_newsletter_popup'),
				__('Overview', 'wp_newsletter_popup'),
				$userrole,
				'wp_newsletter_overview',
				array($this, 'show_overview' ));
						
		$menu = add_submenu_page(
				'wp_newsletter_overview',
				__('Add New', 'wp_newsletter_popup'),
				__('Add New', 'wp_newsletter_popup'),
				$userrole,
				'wp_newsletter_type',
				array($this, 'newsletter_type' ));
		
		$menu = add_submenu_page(
				'wp_newsletter_overview',
				__('Manage Newsletters', 'wp_newsletter_popup'),
				__('Manage Newsletters', 'wp_newsletter_popup'),
				$userrole,
				'wp_newsletter_show_items',
				array($this, 'show_items' ));
		
		$menu = add_submenu_page(
				'wp_newsletter_overview',
				__('Local Record', 'wp_newsletter_popup'),
				__('Local Record', 'wp_newsletter_popup'),
				$userrole,
				'wp_newsletter_show_localrecord',
				array($this, 'show_localrecord' ));
		
		$menu = add_submenu_page(
				'wp_newsletter_overview',
				__('Settings', 'wp_newsletter_popup'),
				__('Settings', 'wp_newsletter_popup'),
				'manage_options',
				'wp_newsletter_edit_settings',
				array($this, 'edit_settings' ) );
				
		$menu = add_submenu_page(
				'wp_newsletter_overview',
				__('Buy PRO', 'wp_newsletter_popup'),
				__('Buy PRO', 'wp_newsletter_popup'),
				'manage_options',
				'wp_newsletter_buy_pro',
				array($this, 'newsletterBuyPro' ) );
		
		$menu = add_submenu_page(
				null,
				__('Edit Newsletter', 'wp_newsletter_popup'),
				__('Edit Newsletter', 'wp_newsletter_popup'),
				$userrole,
				'wp_newsletter_edit_item',
				array($this, 'edit_item' ) );	
		$menu = add_submenu_page(
				null,
				__('Add New', 'wp_newsletter_popup'),
				__('Add New', 'wp_newsletter_popup'),
				$userrole,
				'wp_newsletter_add_new',
				array($this, 'add_new' ));		
	  }
	  /*
	  Admin Script
	  */
	  public function enqueue_script()
	  {
		if(is_admin())
		{  
		     $page = isset($_GET['page']) ? $_GET['page'] : '';
			  wp_enqueue_style( 'nl_ad_css', plugins_url('/app/inc/css/nl_ad.css', __FILE__));
			  wp_enqueue_script( 'nl_ad_js', plugins_url('/app/inc/js/nl_ad.js', __FILE__) );
			 if(!empty($page))
			 {
			   switch($page)
			   {
				 case 'wp_newsletter_show_localrecord':  
				     add_thickbox();
					 wp_enqueue_style( 'lkgbtcss', plugins_url('/app/inc/css/bootstrap.min.css', __FILE__) );
					 wp_enqueue_style( 'dataTables', plugins_url('/app/inc/css/dataTables.bootstrap.min.css', __FILE__));
					 wp_enqueue_script( 'lkgbtjs', plugins_url('/app/inc/js/jquery.dataTables.min.js', __FILE__) );
					 wp_enqueue_script( 'dataTables', plugins_url('/app/inc/js/dataTables.bootstrap.min.js', __FILE__));
					 wp_enqueue_script( 'dataTbl', plugins_url('/app/inc/js/dataTbl.js', __FILE__));
				 break;
				 case 'wp_newsletter_add_new':
				 case 'wp_newsletter_edit_item':
				    wp_enqueue_script("jquery");
				    wp_enqueue_media();
					wp_enqueue_style('wp-color-picker'); 
					wp_enqueue_script("wp-color-picker");
					wp_enqueue_script( 'dataTbl', plugins_url('/app/inc/js/add_edit.js', __FILE__));	
					wp_enqueue_style( 'dataTblcss', plugins_url('/app/inc/css/add_edit.css', __FILE__));		 
				 break;
			   }
			 }
		}
	  }
	  /*
	  Activation Hook
	  */
	  public function mk_newsletter_activation_process()
	  {
		    global $wpdb;
			$tbl = $wpdb->prefix.'mk_newsletter_data';
			$tbl2 = $wpdb->prefix.'mk_newsletter_local_records';
			require_once(ABSPATH.'wp-admin/includes/upgrade.php');
            $sql = "CREATE TABLE IF NOT EXISTS `".$tbl."` (
			  `id` int(11) NOT NULL AUTO_INCREMENT,
			  `name` tinytext NOT NULL,
			  `data` mediumtext NOT NULL,
			  `time` datetime NOT NULL,
			  `authorid` tinytext NOT NULL,
			  `status` mediumtext NOT NULL,
			  PRIMARY KEY (`id`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_general_ci";
			  dbDelta($sql);
            $sql2 = "CREATE TABLE IF NOT EXISTS `".$tbl2."` (
			  `rid` int(11) NOT NULL AUTO_INCREMENT,
			  `nl_id` tinytext NOT NULL,
			  `nl_name` mediumtext NOT NULL,
			  `nl_data` tinytext NOT NULL,
			  PRIMARY KEY (`rid`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_general_ci";
			  dbDelta($sql2);
			         $defaultsettings = array(
											 'userrole' => 'manage_options',
											 'keepdata' => '1',
											 'sanitizehtmlcontent' => '1'
											 );
					$opt = get_option('mk_newsletter_settings');
					if(!$opt['userrole']) {
						update_option('mk_newsletter_settings', $defaultsettings);
					} 	
	  }
	  /* Overview */
	  public function show_overview()
	  {
         $this->controller->overview();
	  }
	  /* Newsletter Type */
	  public function newsletter_type()
	  {
		 $this->controller->newslettertype(); 
	  }
	  /* Add New */
	  public function add_new()
	  {
		 $this->controller->addnew();  
	  }
	  /* Show Items */
	  public function show_items()
	  {
		 $this->controller->showitems();    
	  }
	  /* show localrecord */
	  public function show_localrecord()
	  {
		 $this->controller->showlocalrecord();    
	  }
	   /* edit settings */
	  public function edit_settings()
	  {
		$this->controller->editsettings();    
	  }
	  /* edit items */
	  public function edit_item()
	  {
		$this->controller->edititem();  
	  }
	  /* Export CSV */
	  public function export_csv()
	  {
		 $this->controller->export_csv();
	  }
	  /* Footer newsletter*/
	  public function mk_newsletter_footer()
	  {
		  $this->controller->newsletter_footer_slidein();
	  }
	  public function newsletterBuyPro()
	  {
		  $this->controller->buypro();  
	  }
	  /* newsletter service form */
	  public function newsletter_service_form()
	  {
		$service = sanitize_text_field($_POST['service']); 
		$rid =  isset($_POST['rid']) ? intval($_POST['rid']) : '';
		$this->controller->newsletter_service_form($service, $rid);  
		die;
	  }
	  /* Ajax */
	  public function save_newsletter_callback()
	  {
		global $wpdb;
		
		$tblname = $wpdb->prefix.'mk_newsletter_local_records';
		
		$tbl = $wpdb->prefix.'mk_newsletter_data';
		
		$value = array();
		 
        parse_str($_POST['nl_data'], $value); 
		
		$nl_data = json_encode($value);
		
		$nl_id = intval($_POST['nl_id']);
		
		$nl_name = sanitize_text_field($_POST['nl_name']);
		
		$data = $wpdb->get_row("select * from  ".$tbl." where id = '".$nl_id."'"); 
		
		$data = json_decode($data->data, true);
		
		$action = $data['wp_newsletter_afteraction'];
		
		$service = $data['wp_newsletter_subscription'];
		
		$save_Local = $data['wp_newsletter_savetolocal'];
		 
		$options = $this->controller->decoded_nl_data($nl_id); 
		
		$decoded_nl_data = json_decode($nl_data, true);
		
		if($service == 'constantcontact')
		{
		   $this->send->constantcontact_subscribe($decoded_nl_data, $options);
		   if($options['wp_newsletter_savetolocal'] != '1')
		   {
			 $saveNewsletter =  true;  
		   }
		}
		else if($service == 'mailchimp')
		{		     
		   $this->send->mailchimp_subscribe($decoded_nl_data, $options);
		   if($options['wp_newsletter_savetolocal'] != '1')
		   {
			 $saveNewsletter =  true;  
		   }
		}
		else if($service == 'mailpoet')
		{		
		   $this->send->mailpoet_subscribe($decoded_nl_data, $options);
		   if($options['wp_newsletter_savetolocal'] != '1')
		   {
			 $saveNewsletter =  true;  
		   }
		}
		else if($service == 'getresponse')
		{
		   $this->send->getresponse_subscribe($decoded_nl_data, $options);
		   if($options['wp_newsletter_savetolocal'] != '1')
		   {
			 $saveNewsletter =  true;  
		   }
		}
		else if($service == 'activecampaign')
		{
		  $this->send->activecampaign_subscribe($decoded_nl_data, $options);	
		  if($options['wp_newsletter_savetolocal'] != '1')
		   {
			 $saveNewsletter =  true;  
		   }
		}
		else if($service == 'noservice')
		{
			if($options['wp_newsletter_savetolocal'] != '1')
		   {
			 $saveNewsletter =  true;  
		   }
		}
		if($options['wp_newsletter_savetolocal'] == '1')
		{
		  $saveNewsletter = $wpdb->insert($tblname, array('nl_id' => $nl_id, 'nl_name' => $nl_name, 'nl_data' => $nl_data),array('%d','%s','%s'));	
		}	
			//echo $saveNewsletter;		
		if($saveNewsletter)
		{			
		   /* setting Cookie */	
		    setcookie('newsletter_'.$nl_id.'', 'subscribed', time() + (86400 * 30), "/");
			
			if(!empty($action))
			{
				
			  switch($action)
			  {
				  
				  case 'close':			 
				  
				  echo json_encode(array('action' => 'close', 'redirect' => ''));
				  
				  break;
				  
				  case 'redirect':
				  
				  echo json_encode(array('action' => 'redirect', 'redirect' => $data['wp_newsletter_redirecturl']));
				  
				  break;
				  
				  case 'display':
				  
				  echo json_encode(array('action' => 'display', 'redirect' => $data['wp_newsletter_afteractionmessage']));
				  
				  break;
				  
				  default:
				  
				  echo json_encode(array('action' => 'close', 'redirect' => ''));
				  
			  }
			}
		}
		die;  
	  }
	 /* Service Validator */
	 public function newsletter_service_validator()
	 {
	    $service = sanitize_text_field($_POST['service']);		
		/* Mail Chimp */
		if($service == 'mailchimp')
		{ 
		   $apikey = $_POST['mailchimp_apikey'];
		   $validate = $this->service_validator_controller->mailchimp_validate($apikey);
		   if($validate['success'])
		   {
			 $selectBox .='<h4>Select a MailChimp List</h4>';  
			 $mailchimp_form_data_lists = json_decode($validate['data'],true);
			 $selectBox .= '<select name="wp_newsletter_mailchimplists" id="wp_newsletter_mailchimplists">';
			 foreach($mailchimp_form_data_lists as $key => $val)
			 {
				$selectBox .= '<option value="'.$mailchimp_form_data_lists[$key]['id'].'">ID: '.$mailchimp_form_data_lists[$key]['id'].', Name: '.$mailchimp_form_data_lists[$key]['name'].'</option>';
			 }
			
			 $selectBox .= '</select>';
			 echo json_encode(array('success' => true, 'data' => $selectBox)); 
		   }
		   else
		   {
			 echo json_encode($validate);  
		   }
		}
		/* Mail Poet */
		else if($service == 'mailpoet')
		{
			 $validate = $this->service_validator_controller->mailpoet_validate();
			 if($validate['success'])
		     {
			 $selectBox .='<h4>Select Email List:</h4>';  
			 $mailpoet_form_data_lists = json_decode($validate['data'],true);
			 $selectBox .= '<select name="wp_newsletter_mailpoetlists" id="wp_newsletter_mailpoetlists">';
			 foreach($mailpoet_form_data_lists as $key => $val)
			 {
				 $selectBox .= '<option value="'.$mailpoet_form_data_lists[$key]['id'].'">ID: '.$mailpoet_form_data_lists[$key]['id'].', Name: '.$mailpoet_form_data_lists[$key]['name'].'</option>';
			 }
			
			 $selectBox .= '</select>';
			 echo json_encode(array('success' => true, 'data' => $selectBox)); 
		   }
		   else
		   {
			 echo json_encode($validate);  
		   }
		}
	  /* Constant Contact */
	  else if($service == 'constantcontact')
	  {
		  $apikey = $_POST['constantcontactapikey'];
		  $accesstoken = $_POST['constantcontactaccesstoken'];
		  $validate = $this->service_validator_controller->constantcontact_validate($apikey, $accesstoken); 
		  if($validate['success'])
		     {
			 $selectBox .='<h4>Select a Contacts List:</h4>';  
			 $constantcontact_form_data_lists = json_decode($validate['data'],true);
			 $selectBox .= '<select name="wp_newsletter_constantcontactlists" id="wp_newsletter_constantcontactlists">';
			 foreach($constantcontact_form_data_lists as $key => $val)
			 {
				 $selectBox .= '<option value="'.$constantcontact_form_data_lists[$key]['id'].'">ID: '.$constantcontact_form_data_lists[$key]['id'].', Name: '.$constantcontact_form_data_lists[$key]['name'].'</option>';
			 }
			
			 $selectBox .= '</select>';
			 echo json_encode(array('success' => true, 'data' => $selectBox)); 
		   }
		   else
		   {
			 echo json_encode($validate);  
		   }
	  }
	  /* Get Response */
	  else if($service == 'getresponse')
	  {
		  $apikey = $_POST['getresponseapikey'];
		  $validate = $this->service_validator_controller->getresponse_getcampaigns($apikey);
		  if($validate['success'])
		  {
			 $selectBox .='<h4>Select a Get Response List:</h4>';  
			 $getresponse_form_data_lists = json_decode($validate['data'],true);
			 $selectBox .= '<select name="wp_newsletter_getresponsecampaignid" id="wp_newsletter_getresponsecampaignid">';
			 foreach($getresponse_form_data_lists as $key => $val)
			 {
				 $selectBox .= '<option value="'.$getresponse_form_data_lists[$key]['id'].'">ID: '.$getresponse_form_data_lists[$key]['id'].', Name: '.$getresponse_form_data_lists[$key]['name'].'</option>';
			 }			
			 $selectBox .= '</select>';
			 echo json_encode(array('success' => true, 'data' => $selectBox));   
		  }
		  else
		  {
			echo json_encode($validate);   
		  }
	  }
	  else if($service == 'activecampaign')
	  {
		  $apiurl = $_POST['activecampaignapiurl'];
		  $apikey = $_POST['activecampaignapikey'];
		  $validate = $this->service_validator_controller->activecampaign_getlists($apiurl, $apikey);
		   if($validate['success'])
		  {
			 $selectBox .='<h4>Select Active Campaign:</h4>';  
			 $activecampaign_form_data_lists = json_decode($validate['data'],true);
			 $selectBox .= '<select name="wp_newsletter_activecampaignlistid" id="wp_newsletter_activecampaignlistid">';
			 foreach($activecampaign_form_data_lists as $key => $val)
			 {
				 $selectBox .= '<option value="'.$activecampaign_form_data_lists[$key]['id'].'">ID: '.$activecampaign_form_data_lists[$key]['id'].', Name: '.$activecampaign_form_data_lists[$key]['name'].'</option>';
			 }			
			 $selectBox .= '</select>';
			 echo json_encode(array('success' => true, 'data' => $selectBox));   
		  }
		  else
		  {
			echo json_encode($validate);   
		  }
	  }
	  die;	
	 }
	  /*
	  * set 
	  */	
	 public function mk_np_close_np_help() {
		   $what_to_do = sanitize_text_field($_POST['what_to_do']);
		   $expire_time = 15;
		  if($what_to_do == 'rate_now' || $what_to_do == 'rate_never') {
			 $expire_time = 365;
		  } else if($what_to_do == 'rate_later') {
			 $expire_time = 15;
		  }	
		  if ( false === ( $mk_np_close_np_help_c = get_transient( 'mk_np_close_np_help_c' ) ) ) {
			   $set =  set_transient( 'mk_np_close_np_help_c', 'mk_np_close_np_help_c', 60 * 60 * 24 * $expire_time );
				 if($set) {
					 echo 'ok';
				 } else {
					 echo 'oh';
				 }
			   } else {
				    echo 'ac';
			   }
		   die;
	   }
	}
	new newsletter_popup();
}