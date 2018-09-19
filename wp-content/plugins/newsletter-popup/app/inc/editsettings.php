<div class="wrap">	
<?php $this->load_help_desk();?>	
<h2><?php _e('Settings', 'nlp'); ?> </h2>
<?php if(isset($_GET['msg'])) { $this->flash($_GET['msg']); } ?>        
<?php $setting_options = get_option('mk_newsletter_settings');
if(isset($_POST['save-nl-options']) && wp_verify_nonce( $_POST['nlp_settings_nonce_field'], 'nlp_settings_action' ) )
{
	unset($_POST['save-nl-options']);
	$updatedOptions = update_option('mk_newsletter_settings',$_POST);
	if($updatedOptions){
		echo 'Updating...';
		$this->redirect('?page=wp_newsletter_edit_settings&msg=8');
	}
}
?>
<h3><?php _e('This page is only available for users of Administrator role.', 'nlp'); ?></h3>
        <form method="post"> 
        <?php wp_nonce_field( 'nlp_settings_action', 'nlp_settings_nonce_field' ); ?>               
        <table class="form-table">        
        <tbody><tr valign="top">
			<th scope="row"><?php _e('Set minimum user role', 'nlp'); ?></th>
			<td>
				<select name="userrole">
				  <option value="manage_options" <?php echo($setting_options['userrole'] == 'manager_options' ? 'selected="selected"' : '');?>><?php _e('Administrator', 'nlp'); ?></option>
				  <option value="moderate_comments" <?php echo($setting_options['userrole'] == 'moderate_comments' ? 'selected="selected"' : '');?>><?php _e('Editor', 'nlp'); ?></option>
				  <option value="upload_files" <?php echo($setting_options['userrole'] == 'upload_files' ? 'selected="selected"' : '');?>><?php _e('Author', 'nlp'); ?></option>
				</select>
			</td>
		</tr>
			
		<tr>
			<th><?php _e('Data option', 'nlp'); ?></th>
			<td><label><input name="keepdata" id="keepdata" <?php echo($setting_options['keepdata'] == '1' ? 'checked="checked"' : '');?> type="checkbox" value="1"> <?php _e('Keep data when deleting the plugin', 'nlp'); ?></label>
			</td>
		</tr>

		<tr>
			<th><?php _e('HTML content', 'nlp'); ?></th>
			<td><label><input name="sanitizehtmlcontent" id="sanitizehtmlcontent" <?php echo($setting_options['sanitizehtmlcontent'] == '1' ? 'checked="checked"' : '');?> type="checkbox" value="1"> <?php _e('Sanitize HTML content', 'nlp'); ?></label>
			</td>
		</tr>
		
        </tbody></table>
        
        <p class="submit"><input name="save-nl-options" id="save-nl-options" class="button button-primary" value="Save Changes" type="submit"></p>
        
        </form>
        
		</div>