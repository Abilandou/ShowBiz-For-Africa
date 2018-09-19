<?php if ( ! defined( 'ABSPATH' ) ) exit; 
global $wpdb;
$tbl = $wpdb->prefix.'mk_newsletter_local_records';
$tbll = $wpdb->prefix.'mk_newsletter_data';
$newsPopups = $wpdb->get_results('select * from '.$tbll.' order by id DESC');
if(isset($_GET['action']) && $_GET['action'] == 'delete') {
$delete = $wpdb->delete($tbl, array('rid' => $_GET['rid']));
if($delete)
{
	$this->redirect('?page=wp_newsletter_show_localrecord&msg=9');
}
} ?>
<div class="wrap">
<?php $this->load_help_desk();?>
<h2><?php _e('Subscribers List', 'nlp'); ?></h2>
<?php if(isset($_GET['msg'])) { $this->flash($_GET['msg']); } ?>
<div style="margin:12px 0px;">
<form action="" name="popupform" method="post">
<?php wp_nonce_field( 'popupform', 'popupform_field' ); ?>
<select name="popupNames">
<?php if(!empty($newsPopups) && is_array($newsPopups)) {
foreach($newsPopups as $newsPopup) {?>
<option value="<?php echo $newsPopup->id;?>"><?php echo $newsPopup->id;?> : <?php echo $newsPopup->name;?></option>
<?php } } ?>
</select>
<input type="submit" name="show_popup_data" value="Show Record" class="button button-primary" />
</form>
</div>
<?php
if(isset($_POST['show_popup_data']) && $_POST['show_popup_data'] == 'Show Record' && wp_verify_nonce( $_POST['popupform_field'], 'popupform' ))
{
$popupformid = intval($_POST['popupNames']);	
$local_records = $wpdb->get_results('select * from '.$tbl.' where nl_id="'.$popupformid.'" order by rid DESC'); ?>
<div style="margin:24px 0px;">
<div id="setting-error-settings_updated" class="updated settings-error notice is-dismissible"> 
<p><strong><?php echo count($local_records);?> <?php echo(count($local_records) > 1) ? 'Records Found.' : 'Record Found.';?></strong></p><button type="button" class="notice-dismiss"><span class="screen-reader-text"></span></button></div>
<?php if(count($local_records) > 0) {?>
<form action="admin-post.php?action=newsletter_popup_export_csv" method="post">
<?php wp_nonce_field( 'export_csv', 'export_csv_field' ); ?>
<input type="hidden" name="popupid" value="<?php echo $popupformid;?>"/>
<input type="submit" name="export_csv" value="Export To CSV" class="button button-primary" />
</form>
<?php } ?>
</div>
<table id="nlp" class="table table-striped table-bordered" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th><?php _e('Time', 'nlp'); ?></th>
                <th><?php _e('Subscription Form Name', 'nlp'); ?></th>
                <th><?php _e('Email', 'nlp'); ?></th>
                <th><?php _e('Name', 'nlp'); ?></th>
                <th><?php _e('Details', 'nlp'); ?></th>
                <th></th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th><?php _e('Time', 'nlp'); ?></th>
                <th><?php _e('Subscription Form Name', 'nlp'); ?></th>
                <th><?php _e('Email', 'nlp'); ?></th>
                <th><?php _e('Name', 'nlp'); ?></th>
                <th><?php _e('Details', 'nlp'); ?></th>
                <th></th>
            </tr>
        </tfoot>
        <tbody>
        <?php if(!empty($local_records) && is_array($local_records)) { 
		foreach($local_records as $key => $local_record) { 
		$decodeData = json_decode($local_record->nl_data, true);
        $newslettersData = $wpdb->get_row("select * from ".$tbll." where id = '".$local_record->nl_id."'");
		$NldecodedData = json_decode($newslettersData->data, true);
		?>
          <tr>
                <td><?php if(isset($decodeData['TIME'])&& !(empty($decodeData['TIME']))):
				echo $decodeData['TIME'];endif;?></td>
                <td><?php echo $local_record->nl_name;?></td>
                <td><?php echo $decodeData[$NldecodedData['wp_newsletter_emailfieldname']];?></td>
                <td><?php //echo $decodeData[$NldecodedData['wp_newsletter_namefieldname']];?>
				<?php if(isset($decodeData[$NldecodedData['wp_newsletter_namefieldname']])&& !(empty($decodeData[$NldecodedData['wp_newsletter_namefieldname']]))):
				echo $decodeData[$NldecodedData['wp_newsletter_namefieldname']];endif;?>
				</td>
                <td><a class='button thickbox' title='View Full Details' href='#TB_inline?width=400&height=500&inlineId=nl_container_<?php echo $local_record->rid; ?>'><?php _e('View Details', 'nlp'); ?></a> 
                </td>
                <td><a href="?page=wp_newsletter_show_localrecord&action=delete&rid=<?php echo $local_record->rid; ?>" onclick="return confirm('Are you sure want to delete ?');"><?php _e('Delete', 'nlp'); ?></a></td>
            </tr>
            	<div id="nl_container_<?php echo $local_record->rid; ?>" style="display:none;">
                <div style="display: block;" class="">
                  <p><strong><?php _e('Subscription Form Name', 'nlp'); ?> : </strong><?php echo $local_record->nl_name;?></p>
                  <?php if(!empty($decodeData)) { 
				  foreach($decodeData as $NAME => $VAL) { ?>
                  <p><strong><?php echo $NAME; ?> : </strong><?php echo $VAL; ?></p>
                  <?php } } ?>
                </div>
                </div>
         <?php } } ?>   
        </tbody>
    </table>
<?php } ?>    
</div>