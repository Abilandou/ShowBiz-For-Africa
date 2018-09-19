<?php
class mk_newsletter_controller
{
	/*
	* Overview Page
	*/
	public function overview()
	{
		include('inc/overview.php');
	}
	/*
	* newslettertype
	*/
	public function newslettertype()
	{
		include('inc/newsletter_type.php');
	}
	/*
	*  Add New
	*/
	public function addnew()
	{
		include('inc/addnew.php');
	}
	/*
	* Show Items
	*/
	public function showitems()
	{
		include('inc/showitems.php');
	}
	/*
	*  Show local Record
	*/
	public function showlocalrecord()
	{
		include('inc/showlocalrecord.php');
	}
	/*
	* Edit Settings
	*/
	public function editsettings()
	{
		include('inc/editsettings.php');
	}
	/*
	* Edit Item
	*/
	public function edititem()
	{
		include('inc/edititem.php');
	}
	/*
	* Export CSV
	*/
	public function export_csv()
	{
	include('inc/export_csv.php');	
	}
	/*
	* Newsletter Fotter
	*/
	public function newsletter_footer_slidein()
	{
		include('inc/newsletter_footer_slidein.php');
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
			  $this->redirect('?page=wp_newsletter_add_new');
		  }
	  } 
	 /*
	 * count Items
	 */
	 public function countitems($status = '') 
	 {
		 global $wpdb;
         $tbl = $wpdb->prefix.'mk_newsletter_data';	 
			if(!empty($status))
			{
			 $newsletters = $wpdb->get_results("select * from ".$tbl." where status = '".$status."'"); 	
			}
			else
			{
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
			}
		echo '</strong></p><button type="button" class="notice-dismiss"><span class="screen-reader-text">Dismiss this notice.</span></button></div>';	
		   }
	 }
	 /* Service Forms */
	 public function newsletter_service_form($service)
	 { 
		include('inc/newsletter_service_form.php'); 
	 }
	 /* Redirect */
	 public function redirect($url)
	 {
	  $redirect = '<script>';
	  $redirect .= 'window.location.href="'.$url.'"';
	  $redirect .= '</script>';
	  echo $redirect;
	 }
}