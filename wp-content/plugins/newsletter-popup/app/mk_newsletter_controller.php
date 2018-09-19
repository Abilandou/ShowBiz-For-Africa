<?php
class mk_newsletter_controller
{
	/*
	* Render
	*/
	public function render($path = '', $file = '')
	{
		if(!empty($path) && !empty($file)):
	      include($path.'/'.$file.'.php');
		endif;  	
	}
	/*
	* Overview Page
	*/
	public function overview()
	{
		$this->render('inc','overview');
	}
	/*
	* newslettertype
	*/
	public function newslettertype()
	{
		$this->render('inc','newsletter_type');
	}
	/*
	*  Add New
	*/
	public function addnew()
	{
		$this->render('inc','addnew');
	}
	/*
	* Show Items
	*/
	public function showitems()
	{
		$this->render('inc','showitems');
	}
	/*
	*  Show local Record
	*/
	public function showlocalrecord()
	{
		$this->render('inc','showlocalrecord');
	}
	/*
	* Edit Settings
	*/
	public function editsettings()
	{
		$this->render('inc','editsettings');
	}
	/*
	* Edit Item
	*/
	public function edititem()
	{
		$this->render('inc','edititem');
	}
	/*
	* Export CSV
	*/
	public function export_csv()
	{
	   $this->render('inc','export_csv');	
	}
	/*
	* Newsletter Fotter
	*/
	public function newsletter_footer_slidein()
	{
		global $wpdb;
		
		$tbl = $wpdb->prefix.'mk_newsletter_data';
		
	    $newsletters = $wpdb->get_results("select * from ".$tbl." where status = 'publish'");
		
		foreach($newsletters as $newsletter):
		
			$data = json_decode($newsletter->data, true);
			
			$newsletter_type =  $data['newsletter_display_type'];
			
			if(!empty($newsletter_type))
			{
			 $this->render('inc/front','newsletter_footer_'.$newsletter_type);			
			}
		
		endforeach;
	}
	/*
	* Save Data
	*/
	public function saveData($defaultName, $encodedData, $current_time, $cuid, $status)
	  {
		global $wpdb;
		$tbl = $wpdb->prefix.'mk_newsletter_data';
		if(empty($status))
		{
			$status = 'pending';
		}
		$saveData = $wpdb->insert($tbl, array('name' => $defaultName, 'data' => $encodedData, 'time' => $current_time, 'authorid' => $cuid, 'status' => $status));
		if($saveData)
		{
			return $wpdb->insert_id;
		}
		else
		{
			return false;
		}
	  }
	/*
	* Update Data
	*/
	public function updateData($defaultName, $encodedData, $current_time, $cuid, $status, $nid)
	{
	   global $wpdb;
	   $tbl = $wpdb->prefix.'mk_newsletter_data';
	   if(empty($status))
		{
			$status = 'pending';
		}
	   $updateData = $wpdb->update($tbl, array('name' => $defaultName, 'data' => $encodedData, 'time' => $current_time, 'authorid' => $cuid, 'status' => $status), array('id' => $nid));
	   if($updateData)
	   {
		   return true;
	   }
	   else
	   {
		  return false; 
	   }
	}
	/*
	* Decoded Data Fetch
	*/  
	public function decoded_data($id, $authorid)
	  {
		  global $wpdb;
		  
		  $tbl = $wpdb->prefix.'mk_newsletter_data';
		  
		  $getJsonData = $wpdb->get_row("select * from  ".$tbl." where id = '".$id."' AND authorid = '".$authorid."'");
		  
		  if(count($getJsonData) == '1')
		  {
		  return json_decode($getJsonData->data, true);
		  }
		  else
		  {
			  $this->redirect('?page=wp_newsletter_type');
		  }
	  } 
	/*
	* Decoded Data withour uid
	*/  
	public function decoded_nl_data($id)
	{
	     global $wpdb;
		  
		  $tbl = $wpdb->prefix.'mk_newsletter_data';
		  
		  $getJsonData = $wpdb->get_row("select * from  ".$tbl." where id = '".$id."'");
		  
		  if(count($getJsonData) == '1')
		  {
		  return json_decode($getJsonData->data, true);
		  }	
	}
	 /*
	 * count Items
	 */
	 public function countitems($status = '') 
	 {
		 global $wpdb;
         $tbl = $wpdb->prefix.'mk_newsletter_data';	 
			if(!empty($status)){
			 $newsletters = $wpdb->get_results("select * from ".$tbl." where status = '".$status."'"); 	
			}
			else{
			 $newsletters = $wpdb->get_results("select * from ".$tbl.""); 
			}
		return count($newsletters);	
	 }
	 /*
	 Actions
	 */
	 public function action($action = '')
	 {
		 global $wpdb;
         $tbl = $wpdb->prefix.'mk_newsletter_data';
		 if(!empty($action))
			{
				switch($action)
				{
						/* Disable */
						case 'disable':
						$id = intval($_GET['id']);
						$draftIt = $wpdb->update($tbl, array('status' => 'draft'), array('id' => $id));
						if($draftIt)
						{
							echo 'Updating please Wait..';
							$this->redirect('admin.php?page=wp_newsletter_show_items&msg=3');
							die;
						}
						break;
						/* Active */
						case 'active':
						case 'restore':
						$id = intval($_GET['id']);
						$draftIt = $wpdb->update($tbl, array('status' => 'publish'), array('id' => $id));
						if($draftIt)
						{
							echo 'Updating please Wait..';
							$this->redirect('admin.php?page=wp_newsletter_show_items&msg=4');
							die;
						}
						break;
						/* trash */
						case 'trash':
						$id = intval($_GET['id']);
						$draftIt = $wpdb->update($tbl, array('status' => 'trash'), array('id' => $id));
						if($draftIt)
						{
							echo 'Trashing please Wait..';
							$this->redirect('admin.php?page=wp_newsletter_show_items&msg=5');
							die;
						}
						break;
						/* clone */
						case 'clone':
						$id = intval($_GET['id']);
						$old = $wpdb->get_row("select * from ".$tbl." where id = '".$id."'"); 
						if(count($old) == 1)
						{
							echo 'Cloning please Wait..';
							$cloneData = $this->saveData($old->name, $old->data, $old->time, $old->authorid, $old->status);	
							if($cloneData)
							{		
							 $this->redirect('admin.php?page=wp_newsletter_show_items&msg=6');
							 die;
							}
						}
						break;
						/* delete */
						case 'delete':
						$id = intval($_GET['id']);
						$delete = $wpdb->delete($tbl, array('id' => $id), array('%d'));
						if($delete)
						{
						$this->redirect('admin.php?page=wp_newsletter_show_items&msg=7');
						die;	
						}
						break;
						
					}
				}
	 }
	 /*
	 * All Action
	 */
	 public function actions($action = '', $ids = '')
	 {
		global $wpdb;
        $tbl = $wpdb->prefix.'mk_newsletter_data';
		$success = false; 
		if(is_array($ids) && !empty($action))
		{
			echo 'Please Wait ...';
			switch($action)
			{
				case 'trash':
				     foreach($ids as $id):	
					  $TrashIt = $wpdb->update($tbl, array('status' => 'trash'), array('id' => $id));
					  if($TrashIt)
					  {
						 $success = true; 
					  }
					  else
					  {
						 $success = false; 
					  }
					 endforeach;
					 if($success)
					 {
						 $this->redirect('admin.php?page=wp_newsletter_show_items&msg=5');
					 }
			  break;
			  case 'restore':
			         foreach($ids as $id):	
					  $restoreIt = $wpdb->update($tbl, array('status' => 'publish'), array('id' => $id));
					  if($restoreIt)
					  {
						 $success = true; 
					  }
					  else
					  {
						 $success = false; 
					  }
					 endforeach;
					 if($success)
					 {
						 $this->redirect('admin.php?page=wp_newsletter_show_items&msg=10');
					 }
			  break;
			  case 'delete':
			        foreach($ids as $id):
					 $delete = $wpdb->delete($tbl, array('id' => $id), array('%d'));
					 if($delete)
					  {
						 $success = true; 
					  }
					  else
					  {
						 $success = false; 
					  }
					endforeach;
					if($success)
					 {
						 $this->redirect('admin.php?page=wp_newsletter_show_items&msg=7');
					 }
			  break;
			}
		}
	 }
	 /*
	 Flash message
	 */
	 public function flash($msgid = '')
	 {
		 if(!empty($msgid))
		 {
	    echo '<div id="setting-error-settings_updated" class="updated settings-error notice is-dismissible"><p><strong>';		 
			switch($msgid){
			case 1:
			 echo 'Newsletter Added Successfully !';
			break;
			case 2:
			 echo 'Newsletter Updated Successfully !';
			break;
			case 3:
			 echo 'Newsletter Disabled Successfully !';
			break;
			case 4:
			 echo 'Newsletter Activated Successfully !';
			break;
			case 5:
			 echo 'Newsletter Trashed Successfully !';
			break;
			case 6:
			 echo 'Newsletter Cloned Successfully !';
			break;
			case 7:
			 echo 'Newsletter Deleted Successfully !';
			break;
			case 8:
			 echo 'Settings Saved Successfully !';
			break;	
			case 9:
			 echo 'Subscriber Deleted Successfully !';
			break;
			case 10:
			 echo 'Newsletters Restored Successfully !';
			break;
			}
		echo '</strong></p><button type="button" class="notice-dismiss"><span class="screen-reader-text">Dismiss this notice.</span></button></div>';	
		   }
	 }
	 /* Service Forms */
	 public function newsletter_service_form($service, $rid = '')
	 { 
	    if(!empty($rid))
		{
		  include('inc/newsletter_service_form_edit.php'); 	
		}
		else
		{
		  include('inc/newsletter_service_form.php'); 
		}
	 }
	 public function buypro(){
		include('inc/buy_pro.php');  
	 }
	 /* Redirect */
	 public function redirect($url)
	 {
	  $redirect = '<script>';
	  $redirect .= 'window.location.href="'.$url.'"';
	  $redirect .= '</script>';
	  echo $redirect;
	 }
	  /*
	 * Load Help Desk
	 */
	 public function load_help_desk() {
			$mkcontent = '';
			$mkcontent .='<div class="nlhdm" style="display:none;">';
			$mkcontent .='<div class="l_nlhdm">';
			$mkcontent .='';
			$mkcontent .='</div>';
            $mkcontent .='<div class="r_nlhdm">';
            $mkcontent .='<a class="close_nl_help fm_close_btn" href="javascript:void(0)" data-ct="rate_later" title="close">X</a><strong>Newsletter Popup</strong><p>We love and care about you. Our team is putting maximum efforts to provide you the best functionalities. It would be highly appreciable if you could spend a couple of seconds to give a Nice Review to the plugin to appreciate our efforts. So we can work hard to provide new features regularly :)</p></div><a class="close_nl_help fm_close_btn_1" href="javascript:void(0)" data-ct="rate_later" title="Remind me later">Later</a> <a class="close_nl_help fm_close_btn_2" href="https://wordpress.org/support/plugin/newsletter-popup/reviews/?filter=5" data-ct="rate_now" title="Rate us now" target="_blank">Rate Us</a> <a class="close_nl_help fm_close_btn_3" href="javascript:void(0)" data-ct="rate_never" title="Not interested">Never</a>';
			$mkcontent .='<div class="clear"></div></div>';
           if ( false === ( $mk_np_close_np_help_c = get_transient( 'mk_np_close_np_help_c' ) ) ) {
			  	echo apply_filters('the_content', $mkcontent);  
		   }
		}
}
