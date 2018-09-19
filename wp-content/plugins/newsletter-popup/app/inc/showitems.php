<?php if ( ! defined( 'ABSPATH' ) ) exit; 
global $wpdb;
$tbl = $wpdb->prefix.'mk_newsletter_data';
$status = isset($_GET['item_status']) ? $_GET['item_status'] : '';
if(!empty($status))
{
$newsletters = $wpdb->get_results("select * from ".$tbl." where status = '".$status."' order by id DESC"); 	
}
else
{
$newsletters = $wpdb->get_results("select * from ".$tbl." where status != 'trash' order by id DESC"); 
} 
?>
<div class="wrap">
<?php $this->load_help_desk();?>
<h2><?php _e('Manage Newsletter', 'nlp'); ?> <a href="admin.php?page=wp_newsletter_type" class="add-new-h2"> <?php _e('New Newsletter', 'nlp'); ?></a> <!--a href="admin.php?page=wp_newsletter_show_items&action=delete_cookies" class="add-new-h2"> <?php _e('Delete Newsletter Cookies', 'nlp'); ?></a--></h2>
<?php if(isset($_GET['msg'])) { $this->flash($_GET['msg']); } ?>
<?php
/* Actions */
$action = isset($_GET['action']) ? $_GET['action'] : '';
if(!empty($action))
{
$this->action($action);
}
$actions = isset($_POST['apply_submit']) ? true : false;
if($actions)
{
  $this->actions($_POST['bulk_action'], $_POST['itemid']);
}
?>
<form id="popup-list-table" method="post">
<ul class="subsubsub">
	<li class="all"><a href="admin.php?page=wp_newsletter_show_items" class="current"><?php _e('All', 'nlp'); ?> (<?php echo $this->countitems();?>)</a> |</li>
	<li class="publish"><a href="admin.php?page=wp_newsletter_show_items&amp;item_status=publish"><?php _e('Published', 'nlp'); ?> (<?php echo $this->countitems('publish');?>)</a> |</li>
	<li class="trash"><a href="admin.php?page=wp_newsletter_show_items&amp;item_status=trash"><?php _e('Trash', 'nlp'); ?> (<?php echo $this->countitems('trash');?>)</a></li>
</ul><div class="tablenav top">
<div class="alignleft actions bulkactions">
<label for="bulk-action-selector-top" class="screen-reader-text"><?php _e('Select bulk action', 'nlp'); ?></label>
<select name="bulk_action" id="bulk-action-selector-top">
<option value="-1"><?php _e('Bulk Actions', 'nlp'); ?></option>
<?php if($status == 'trash') { ?>
<option value="restore"><?php _e('Restore', 'nlp'); ?></option>
<option value="delete"><?php _e('Delete permanently', 'nlp'); ?></option>
<?php  } else { ?>
<option value="trash"><?php _e('Trash', 'nlp'); ?></option>
<?php } ?>
</select>
<input id="doaction" class="button action" value="Apply" type="submit" name="apply_submit">
		</div>
		
		<br class="clear">
	</div>
<table class="wp-list-table widefat fixed striped wp-newsletter_page_wp_newsletter_popup_show_items">
	<thead>
	<tr>
		<td id="cb" class="manage-column column-cb check-column"><label class="screen-reader-text" for="cb-select-all-1"><?php _e('Select All', 'nlp'); ?></label><input id="cb-select-all-1" type="checkbox"></td>
        <th scope="col" id="id" class="manage-column column-id column-primary"><?php _e('ID', 'nlp'); ?></th>
        <th scope="col" id="name" class="manage-column column-name sortable"><?php _e('Name', 'nlp'); ?></th>
        <th scope="col" id="status" class="manage-column column-status"><?php _e('Type', 'nlp'); ?></th>
        <th scope="col" id="status" class="manage-column column-status"><?php _e('Status', 'nlp'); ?></th>
        <th scope="col" id="time" class="manage-column column-time"><?php _e('Created', 'nlp'); ?></th>	
  </tr>
	</thead>

	<tbody id="the-list">
    <?php if(!empty($newsletters) && is_array($newsletters)) {
		foreach($newsletters as $newsletter) { 
		$data = json_decode($newsletter->data, true);
		$newsletter_type =  $data['newsletter_display_type'];
		?>
		<tr>
        <th scope="row" class="check-column"><input name="itemid[]" value="<?php echo $newsletter->id; ?>" type="checkbox"></th>
        <td class="id column-id has-row-actions column-primary" data-colname="ID"><?php echo $newsletter->id; ?>
        <div class="row-actions">
        <?php if($status == 'trash') {?>
        <span class="clone"><a href="?page=wp_newsletter_show_items&amp;action=restore&amp;id=<?php echo $newsletter->id; ?>"  onclick="return confirm('Do you want to restore this item ?')"><?php _e('Restore', 'nlp'); ?></a> | </span>
        <span class="trash"><a href="?page=wp_newsletter_show_items&amp;action=delete&amp;id=<?php echo $newsletter->id; ?>" onclick="return confirm('Do you want to permanently delete this item ?')"><?php _e('Delete Permanently', 'nlp'); ?></a></span>
        
        <?php } else {?>
        
        <span class="trash">
        <a href="?page=wp_newsletter_show_items&amp;action=trash&amp;id=<?php echo $newsletter->id; ?>"  onclick="return confirm('Do you want to trash this item ?')"><?php _e('Trash', 'nlp'); ?></a> | </span><span class="clone"><a href="?page=wp_newsletter_show_items&amp;action=clone&amp;id=<?php echo $newsletter->id; ?>" onclick="return confirm('Do you want to clone this item ?')"><?php _e('Clone', 'nlp'); ?></a> | </span><span class="edit"><a href="?page=wp_newsletter_edit_item&amp;id=<?php echo $newsletter->id; ?>"><?php _e('Edit', 'nlp'); ?></a></span>
        
        <?php } ?>
        </div>
        </td>
        <td class="name column-name" data-colname="Name"><?php echo $newsletter->name; ?></td>
        <td class="name column-name" data-colname="Type"><?php echo $newsletter_type; ?></td>
        <td class="status column-status" data-colname="Status"><strong><?php echo ucwords($newsletter->status); ?></strong><div class="row-actions"><span class="disable">
        <?php if($newsletter->status == 'publish') {?>
        <a href="?page=wp_newsletter_show_items&amp;action=disable&amp;id=<?php echo $newsletter->id; ?>"><?php _e('Disable', 'nlp'); ?></a>
        <?php } else { ?>
        <a href="?page=wp_newsletter_show_items&amp;action=active&amp;id=<?php echo $newsletter->id; ?>"><?php _e('Active', 'nlp'); ?></a>
        <?php } ?>
        </span>
        
        </div>
        </td>
        <td class="time column-time" data-colname="Created"><?php echo $newsletter->time; ?></td>
        </tr>
    <?php } } ?>
        </tbody>

	<tfoot>
<tr>
		<td id="cb" class="manage-column column-cb check-column"><label class="screen-reader-text" for="cb-select-all-1"><?php _e('Select All', 'nlp'); ?></label><input id="cb-select-all-1" type="checkbox"></td>
        <th scope="col" id="id" class="manage-column column-id column-primary"><?php _e('ID', 'nlp'); ?></th>
        <th scope="col" id="name" class="manage-column column-name sortable"><?php _e('Name', 'nlp'); ?></th>
        <th scope="col" id="status" class="manage-column column-status"><?php _e('Type', 'nlp'); ?></th>
        <th scope="col" id="status" class="manage-column column-status"><?php _e('Status', 'nlp'); ?></th>
        <th scope="col" id="time" class="manage-column column-time"><?php _e('Created', 'nlp'); ?></th>	
  </tr>
	</tfoot>

</table>
	<div class="tablenav bottom">

				<div class="alignleft actions bulkactions">
			<label for="bulk-action-selector-bottom" class="screen-reader-text"><?php _e('Select bulk action', 'nlp'); ?></label><select name="action2" id="bulk-action-selector-bottom">
<option value="-1"><?php _e('Bulk Actions', 'nlp'); ?></option>
	<option value="trash"><?php _e('Trash', 'nlp'); ?></option>
</select>
<input id="doaction2" class="button action" value="Apply" type="submit">
		</div>
		
		<br class="clear">
	</div>								
        </form>
</div>