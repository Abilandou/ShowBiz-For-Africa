<?php 
/*
* Class mk_newsletter_service_validator
* Description: Validate Newsletters Third Party Services APIs
*/
class mk_newsletter_service_validator
{	
    /* Mail Chimp Validate */
	public function mailchimp_validate($apikey)
	{
	 	$parts = explode('-', $apikey);
		if ( count($parts) <= 1)
		{
			return array(
					'success'	=> false,
					'message'	=> 'The API key is invalid.'
			);
		}
		
		$server = end( $parts );
		$apiurl = 'https://' . $server . '.api.mailchimp.com/3.0/lists';
		
		$args = array(
				'headers' => array(
						'Authorization' => 'Basic ' . base64_encode( 'user:' . $apikey )
				)
		);
		
		$raw_response = wp_remote_request( $apiurl, $args );
		if ( !is_wp_error( $raw_response ) )
		{
			if ( isset($raw_response['body']) )
			{
				$data = json_decode($raw_response['body'], true);
			
				if (isset($raw_response['response']['code']) && $raw_response['response']['code'] == 200)
				{
					$lists = array();					
					if ( isset($data['lists']) )
					{
						foreach($data['lists'] as $list)
						{
							$lists[] = array(
								'id'	=> $list['id'],
								'name'	=> $list['name']
							);
						}
					}
					
					if (count($lists) <= 0)
					{
						return array(
								'success'	=> false,
								'message'	=> 'No list defined in MailChimp'
						);
					}
					else
					{
						return array(
							'success'	=> true,
							'data'		=> json_encode($lists)
						);
					}
				}
				else
				{
					return array(
						'success'	=> false,
						'message'	=> (isset($data['title']) ? $data['title'] : '') . ': ' . (isset($data['detail']) ? $data['detail'] : '')
					);
				}
			}
		}
	
	}
    /* Mail Poet Validate */
	public function mailpoet_validate()
	{
	  
		if( !class_exists( 'WYSIJA' ) )
		{
			return array(
					'success'	=> false,
					'message'	=> 'MailPoet is not installed or activated'
			);
		}
		
		$model_list = WYSIJA::get('list', 'model');
		$mailpoet_lists = $model_list->get(array('name', 'list_id'), array('is_enabled' => 1));
		
		$lists = array();
		foreach ($mailpoet_lists as $list)
		{
			if (is_array($list) && isset($list['list_id']) && isset($list['name']))
			{
				$lists[] = array(
						'id'	=> $list['list_id'],
						'name'	=> $list['name']
				);
			}
		}
			
		if (count($lists) <= 0)
		{
			return array(
					'success'	=> false,
					'message'	=> 'No list defined in MailPoet'
			);
		}
		else
		{
			return array(
					'success'	=> true,
					'data'		=> json_encode($lists)
			);
		}
		
	}
	/* Constant Contact */
	public function constantcontact_validate($apikey, $accesstoken)
	{
		
		if ( empty($apikey) || empty($accesstoken) )
		{
			return array(
					'success'	=> false,
					'message'	=> 'The API Key or Access Token is invalid.'
			);
		}
		
		$apiurl = 'https://api.constantcontact.com/v2/lists?api_key=' . $apikey;
				
		$args = array(
				'headers' => array(
						'Authorization' => 'Bearer ' . $accesstoken
				)
		);
		
		$raw_response = wp_remote_request( $apiurl, $args );
				
		if ( !is_wp_error( $raw_response ) )
		{
			if ( isset($raw_response['response']['code']) && isset($raw_response['body']) )
			{
				if ( $raw_response['response']['code'] == 200 )
				{
					$lists= array();
					$items = json_decode($raw_response['body'], true);
					foreach ($items as $item)
					{
						if ($item['status'] == 'ACTIVE')
						{
							$lists[] = array(
									'id'	=> $item['id'],
									'name'	=> $item['name']
							);
						}
					}
					
					if (count($lists) <= 0)
					{
						return array(
								'success'	=> false,
								'message'	=> 'No list defined in Constant Contact'
						);
					}
					else
					{
						return array(
								'success'	=> true,
								'data'		=> json_encode($lists)
						);
					}
				}
				else
				{
					$data = json_decode($raw_response['body'], true);
					if ( isset($data[0]['error_message']) )
					{
						return array(
								'success'	=> false,
								'message'	=> $data[0]['error_message']
						);
					}
				}
			}
		}
		else
		{
			return array(
					'success'	=> false,
					'message'	=> 'Error connect to Constant Contact Co service'
			);
		}
	
	}
	/*
	get Response
	*/
	function getresponse_getcampaigns($apikey)
	{
		require_once 'getresponse/jsonRPCClient.php';
		
		if ( empty($apikey) )
		{
			return array(
					'success'	=> false,
					'message'	=> 'The API key is invalid.'
			);
		}
		
		$apiurl = 'https://api2.getresponse.com';
		
		$client = new jsonRPCClient($apiurl);
		
		try {
			
			$campaigns = $client->get_campaigns( $apikey );
			
			$lists = array();
			foreach( $campaigns as $key => $campaign )
			{
				$lists[] = array(
						'id'	=> $key,
						'name'	=> $campaign['name']
				);
			}
			
			if (count($lists) <= 0)
			{
				return array(
						'success'	=> false,
						'message'	=> 'No list defined in GetResponse'
				);
			}
			else
			{
				return array(
						'success'	=> true,
						'data'		=> json_encode($lists)
				);
			}
		
		} catch (Exception $e) {
						
			return array(
					'success'	=> false,
					'message'	=> $e->getMessage()
			);
		}
		
	}
	/*
	* Active Campaign List
	*/
	public function activecampaign_getlists($apiurl, $apikey)
	{	
		if ( empty($apiurl) || empty($apikey) )
		{
			return array(
					'success'	=> false,
					'message'	=> 'The API URL or key is invalid.'
			);
		}
				
		$args = array(
				'api_key'      	=> $apikey,
				'api_action'   	=> 'list_list',
				'api_output'   	=> 'json',
				'ids'			=> 'all',
				'full'			=> 0
		);
		
		$query = '';
		foreach( $args as $key => $value ) 
		{
			$query .= $key . '=' . urlencode($value) . '&';
		}
		$query = rtrim($query, '& ');
		
		$apiurl = rtrim($apiurl, '/ ') . '/admin/api.php?' . $query;
				
		$raw_response = wp_remote_get( $apiurl );
		if ( !is_wp_error( $raw_response ) )
		{							
			if ( isset($raw_response['body']) )
			{
				$data = json_decode($raw_response['body'], true);		
									
				if (!empty($data) && isset($data['result_code']) &&  $data['result_code'] == 1 && isset($raw_response['response']['code']) && $raw_response['response']['code'] == 200)
				{
					unset($data['result_code']);
					unset($data['result_message']);
					unset($data['result_output']);
					
					$lists = array();
					foreach ($data as $list)
					{
						if (is_array($list) && isset($list['id']) && isset($list['name']))
						{
							$lists[] = array(
									'id'	=> $list['id'],
									'name'	=> $list['name']
							);
						}
					}

					if (count($lists) <= 0)
					{
						return array(
								'success'	=> false,
								'message'	=> 'No list defined in Active Campaign'
						);
					}
					else
					{
						return array(
								'success'	=> true,
								'data'		=> json_encode($lists)
						);
					}
				}
				else
				{
					$message = '';
					
					if (!empty($data) && isset($data['result_message']) )
						$message = $data['result_message'];
					else if (strpos($raw_response['body'], 'Not Found') !== false)
						$message = 'The API Access URL you entered can not be found.';
						
					return array(
							'success'	=> false,
							'message'	=> $message
					);
				}

			}
		}
	}
}