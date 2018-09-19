<?php if ( ! defined( 'ABSPATH' ) ) exit;
global $wpdb;
$tbl = $wpdb->prefix.'mk_newsletter_local_records';
if(isset($_POST['export_csv']) && $_POST['export_csv'] == 'Export To CSV' && wp_verify_nonce( $_POST['export_csv_field'], 'export_csv' ))
{
$popupformid = intval($_POST['popupid']);
$local_records = $wpdb->get_results('select * from '.$tbl.' where nl_id="'.$popupformid.'" order by rid DESC');
$csv_header = '';
$csv_row ='';
if(!empty($local_records))
{
	   /* CSV Header Data */
	    $csv_header .= '"RECORDID",';
		$decodeDataHeader = json_decode($local_records[0]->nl_data, true);
		if(!empty($decodeDataHeader) && is_array($decodeDataHeader))
		{
			foreach($decodeDataHeader as $key => $val)
				{
				 $csv_header .= '"' .$key. '",';	
				}
			}
	    $csv_header .= "\n";
	  /* CSV Row */
		   foreach($local_records as $mkkey => $local_record)
		   {
			   $decodeDatarows = json_decode($local_record->nl_data, true);
			   $csv_row .= '"' .$local_record->rid. '",'; 
			   foreach($decodeDatarows as $key => $decodeDatarow)
			   {
			    $csv_row .= '"' .$decodeDatarows[$key]. '",'; 
			   }
			   $csv_row .= "\n";
		   }   
/* Download as CSV File */
header('Content-type: application/csv');
header('Content-Disposition: attachment; filename=newsletter_popup_'.$popupformid.'.csv');
echo $csv_header . $csv_row;
exit;			
}
}
?>