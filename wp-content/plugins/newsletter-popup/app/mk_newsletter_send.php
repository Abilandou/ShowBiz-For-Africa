<?php
class mk_newsletter_send
{
	    /*
		* Mailchimp Subscribe
		*/
	 public function mailchimp_subscribe($data, $options)
		{			
			$email = strtolower($data[$options['wp_newsletter_emailfieldname']]); //email address
			unset($data[$options['wp_newsletter_emailfieldname']]);			
			$apikey = $options['wp_newsletter_mailchimpapikey']; //api key
			$listid = $options['wp_newsletter_mailchimplists']; //list ID
			$parts = explode('-', $apikey);
			if ( count($parts) <= 1)
			{
				return array( 
						'success'	=> 	false, 
						'errorcode'	=> 	5,
						'message'	=> 	'Error: invalid email service configuration'
				);
			}	
			$server = end( $parts );
			
			
			$apiurl = 'https://' . $server . '.api.mailchimp.com/3.0/lists/' . $listid . '/members/' . md5($email);
			$args = array(
					'headers' 	=> 	array(
							'Authorization' => 'Basic ' . base64_encode( 'user:' . $apikey )
					)
			);
			$raw_response = wp_remote_get( $apiurl, $args );
			if ( !is_wp_error( $raw_response ) && isset($raw_response['body']) && isset($raw_response['response']['code']) && $raw_response['response']['code'] == 200)
			{	
				$response = json_decode($raw_response['body'], true);	
				if ( isset($response['status']) && $response['status'] == 'subscribed' )
				{
					return 	array( 
							'success'	=> 	false, 
							'errorcode'	=> 	-1,
							'message'	=> 	'Error: the email address has already subscribed.'
					);
				}
				else if ( isset($response['status']) && $response['status'] == 'pending' )
				{
					return 	array(
							'success'	=> 	false,
							'errorcode'	=> 	-2,
							'message'	=> 	'Error: the email address has already subscribed. You must confirm your email address before we can send you. Please check your email and follow the instructions.'
					);
				}
			}
			
			$apiurl = 'https://' . $server . '.api.mailchimp.com/3.0/lists/' . $listid . '/members/';
			//$status = (isset($options['mailchimpdoubleoptin']) && $options['mailchimpdoubleoptin']) ? 'pending': 'subscribed';
			$body = array(
						'email_address'		=> $email,
						'status'			=> 'pending'
					);
			
			if ( !empty($data) )
				$body['merge_fields'] = $data;
			
			$args = array(
					'method'    => 'POST',
					'headers' 	=> 	array(
							'Authorization' => 'Basic ' . base64_encode( 'user:' . $apikey )
					),
					'body'		=>	json_encode($body)
			);
			
			$raw_response = wp_remote_request( $apiurl, $args );
			if ( !is_wp_error( $raw_response ) && isset($raw_response['body']) )
			{			
				if ( isset($raw_response['response']['code']) && $raw_response['response']['code'] == 200 )
				{
					return array(
						'success'	=> 	true
					);					
				}
				else
				{
					return array(
						'success'	=> 	false,
						'errorcode'	=> 	6,
						'message'	=> 	'Error: bad request to email service'
					);				
				}			
			}	
			else
			{
				return 	array(
						'success'	=> 	false,
						'errorcode'	=> 	7,
						'message'	=> 	'Error: unable to connect to email service'
				);
			}
	   }
		 /* 
		 * Mail poet subscribe 
		 */
	 public function mailpoet_subscribe($decoded_nl_data, $options)
	 {		 
	 		$user_data = array(
					'email' => $decoded_nl_data[$options['wp_newsletter_emailfieldname']]
				  );				  
			if(!empty($decoded_nl_data[$options['wp_newsletter_firstnamefieldname']]))
			{	  
			 $user_data['firstname'] = $decoded_nl_data[$options['wp_newsletter_firstnamefieldname']];
			}
			else
			{
		     $user_data['firstname'] = $decoded_nl_data[$options['wp_newsletter_namefieldname']];	
			}			
		   if(!empty($decoded_nl_data[$options['wp_newsletter_lastnamefieldname']]))
		   {
			$user_data['lastname'] = $decoded_nl_data[$options['wp_newsletter_lastnamefieldname']];	
		   }	
		   
			if( !class_exists( 'WYSIJA' ) )
			{
				return array(
						'success'	=> 	false,
						'message'	=> 	'Error: MailPoet is not installed or activated'
				);
			}
			
			$data_subscriber = array(
					'user' => $user_data,
					'user_list' => array('list_ids' => array($options['wp_newsletter_mailpoetlists']) )
			);
			
			$helper_user = WYSIJA::get('user','helper');
			$result = $helper_user->addSubscriber($data_subscriber);
			
			return array(
				 'success'  => 	true
			);
		
	 }
		 /* 
		 * Constant contact 
		 */
	  public function constantcontact_subscribe($data, $options)
		{
			if ($options['wp_newsletter_subscription'] != 'constantcontact' || empty($options['wp_newsletter_constantcontactapikey']) || empty($options['wp_newsletter_constantcontactaccesstoken']) || empty($options['wp_newsletter_constantcontactlists']))
			{
				return array(
						'success'	=> 	false,
						'errorcode'	=> 	3,
						'message'	=> 	'Error: no email service configured'
				);
			}
			
			$apikey = $options['wp_newsletter_constantcontactapikey'];
			$accesstoken = $options['wp_newsletter_constantcontactaccesstoken'];
			$listid = $options['wp_newsletter_constantcontactlists'];
			
			$apiurl = 'https://api.constantcontact.com/v2/contacts?action_by=ACTION_BY_VISITOR&api_key=' . $apikey;
					
			$email = strtolower($data[$options['wp_newsletter_emailfieldname']]);
			unset($data[$options['wp_newsletter_emailfieldname']]);
			
			$body = array(
					'email_addresses' 	=> array(
												array( 'email_address'	=> $email )
											),
					'lists'				=> array(
												array( 'id' 	=> $listid )
											)
			);
			
			if ( $options['wp_newsletter_showfirstname'] && array_key_exists($options['wp_newsletter_firstnamefieldname'], $data) )
			{
				$body['first_name'] = $data[$options['wp_newsletter_firstnamefieldname']];
				unset($data[$options['wp_newsletter_firstnamefieldname']]);
			}
			
			if ( $options['wp_newsletter_showlastname'] && array_key_exists($options['wp_newsletter_lastnamefieldname'], $data) )
			{
				$body['last_name'] = $data[$options['wp_newsletter_lastnamefieldname']];
				unset($data[$options['wp_newsletter_lastnamefieldname']]);
			}
			
			if ( $options['wp_newsletter_showcompany'] && array_key_exists($options['wp_newsletter_companyfieldname'], $data) )
			{
				$body['company_name'] = $data[$options['wp_newsletter_companyfieldname']];
				unset($data[$options['wp_newsletter_companyfieldname']]);
			}
			
			$constantcontact_params = array('cell_phone', 'company_name', 'fax', 'home_phone', 'job_title', 'prefix_name', 'source', 'work_phone');
			foreach($data as $key => $value)
			{
				if ( in_array($key, $constantcontact_params) )
					$body[$key] = $value;
			}
			
			$args = array(
					'headers' 	=> array(
							'Authorization' => 'Bearer ' . $accesstoken,
							'Content-Type'	=> 'application/json'
					),
					'method'	=> 'POST',
					'body'		=> json_encode($body)
			);
			
			$raw_response = wp_remote_post( $apiurl, $args );
			if ( !is_wp_error( $raw_response ) )
			{
				if ( isset($raw_response['response']['code']) && $raw_response['response']['code'] == 201 )
				{
					return array(
							'success'	=> true
					);
				}
				else if ( isset($raw_response['response']['code']) )
				{
					if ( isset($raw_response['body']) )
					{
						$response_body = json_decode($raw_response['body'], true);	
						$message = isset($response_body[0]['error_message']) ? $response_body[0]['error_message'] : '';;
						return array(
								'success'	=> false,
								'errorcode'	=> ( $raw_response['response']['code'] == 409) ? -1 : 6,
								'message'	=> $message
						);
					}
					else
					{
						$message = isset($raw_response['response']['message']) ? $raw_response['response']['message'] : '';
						return array(
								'success'	=> false,
								'errorcode'	=> ( $raw_response['response']['code'] == 409) ? -1 : 6,
								'message'	=> $message
						);
					}
				}
				else
				{	
					return array(
							'success'	=> false,
							'errorcode'	=> 7,
							'message'	=> 'Error connect to Constant Contact service'
					);
				}
			}
		}
	 /* 
	 * Get Response 
	 */
	 public function getresponse_subscribe($data, $options)
	 {
		require_once 'getresponse/jsonRPCClient.php';
		
		if ($options['wp_newsletter_subscription'] != 'getresponse' || empty($options['wp_newsletter_getresponseapikey']) || empty($options['wp_newsletter_getresponsecampaignid']))
		{
			return array(
					'success'	=> 	false,
					'errorcode'	=> 	3,
					'message'	=> 	'Error: no email service configured'
			);
		}
		
		$email = strtolower($data[$options['wp_newsletter_emailfieldname']]);
		unset($data[$options['wp_newsletter_emailfieldname']]);
		
		$name = '';
		if ( $options['wp_newsletter_showname'] && array_key_exists($options['wp_newsletter_namefieldname'], $data) )
		{
			$name = $data[$options['wp_newsletter_namefieldname']];
			unset($data[$options['wp_newsletter_namefieldname']]);
		}
		else
		{
			if ( $options['wp_newsletter_showfirstname'] && array_key_exists($options['wp_newsletter_firstnamefieldname'], $data) )
			{
				$name .= $data[$options['wp_newsletter_firstnamefieldname']];
				unset($data[$options['wp_newsletter_firstnamefieldname']]);
			}
			
			if ( $options['wp_newsletter_showlastname'] && array_key_exists($options['wp_newsletter_lastnamefieldname'], $data) )
			{
				$name .= ( !empty($name) ? ' ' : '') . $data[$options['wp_newsletter_lastnamefieldname']];
				unset($data[$options['wp_newsletter_lastnamefieldname']]);
			}
		}
			
		$apikey = $options['wp_newsletter_getresponseapikey'];
		$campaignid = $options['wp_newsletter_getresponsecampaignid'];
		
		$apiurl = 'https://api2.getresponse.com';
		
		$client = new jsonRPCClient($apiurl);
		
		$args = array(
				'campaign'  => $campaignid,
				'email'		=> $email
			);
		
		if (!empty($name))
			$args['name'] = $name;
		
		if (!empty($data))
		{
			$customs = array();
			foreach($data as $key => $value)
			{
				$customs[] = array(
						'name'		=> $key,
						'content'	=> $value
						);
			}
			$args['customs'] = $customs;
		}
		
		try {
				
			$result = $client->add_contact(
				$apikey,
				$args
			);

			if (isset($result) && isset($result['queued']) && $result['queued'] == 1)
			{
				return array(
						'success'	=> true
				);
			}
			else if ( isset($result) && isset($result['code']) && isset($result['message']) )
			{
				return array(
						'success'	=> false,
						'errorcode'	=> (($result['code'] == -1) ? -1 : 6),
						'message'	=> $result['message']
				);
			}
			else
			{
				return array(
						'success'	=> false,
						'errorcode'	=> 	7,
						'message'	=> 'Error connect to GetResponse service'
				);
			}
		
		} catch (Exception $e) {
		
			return array(
					'success'	=> false,
					'errorcode'	=> 7,
					'message'	=> $e->getMessage()
			);
		}
	}
	/*
	* Active Campaign
	*/
	 public function activecampaign_subscribe($data, $options) 
	{
		if ($options['subscription'] != 'activecampaign' || empty($options['wp_newsletter_activecampaignapiurl']) || empty($options['wp_newsletter_activecampaignapikey']) || empty($options['wp_newsletter_activecampaignlistid']))
		{
			return array(
					'success'	=> 	false,
					'errorcode'	=> 	3,
					'message'	=> 	'Error: no email service configured'
			);
		}
		
		$apiurl = $options['wp_newsletter_activecampaignapiurl'];
		$apikey = $options['wp_newsletter_activecampaignapikey'];
		$listid = $options['wp_newsletter_activecampaignlistid'];
		
		$args = array(
				'api_key'      	=> $apikey,
				'api_action'   	=> 'contact_add',
				'api_output'   	=> 'json'
		);
		
		$query = '';
		foreach( $args as $key => $value )
		{
			$query .= $key . '=' . urlencode($value) . '&';
		}
		$query = rtrim($query, '& ');
		
		$apiurl = rtrim($apiurl, '/ ') . '/admin/api.php?' . $query;
		
		
		$email = strtolower($data[$options['wp_newsletter_emailfieldname']]);
		
		$firstname = null;
		$lastname = null;
		
		if ( $options['wp_newsletter_showname'] && array_key_exists($options['wp_newsletter_namefieldname'], $data) )
		{
			$names = explode(' ', $data[$options['wp_newsletter_namefieldname']]);
			$firstname = $names[0];
			$lastname = ( count($names) > 1 ) ? array_pop($names) : null;
		}
		
		if ( $options['wp_newsletter_showfirstname'] && array_key_exists($options['wp_newsletter_firstnamefieldname'], $data) )
			$firstname = $data[$options['wp_newsletter_firstnamefieldname']];
		
		if ( $options['wp_newsletter_showlastname'] && array_key_exists($options['wp_newsletter_lastnamefieldname'], $data) )
			$lastname =  $data[$options['wp_newsletter_lastnamefieldname']];
		
		$phone = ( $options['wp_newsletter_showphone'] && array_key_exists($options['wp_newsletter_phonefieldname'], $data) ) ? $data[$options['wp_newsletter_phonefieldname']] : null;
		$orgname = ( $options['wp_newsletter_showcompany'] && array_key_exists($options['wp_newsletter_companyfieldname'], $data) ) ? $data[$options['wp_newsletter_companyfieldname']] : null;
				
		$body = array(
				'email'													=> $email,
				'p[' . $options['wp_newsletter_activecampaignlistid'] . ']'			=> $options['wp_newsletter_activecampaignlistid'],
				'status[' . $options['wp_newsletter_activecampaignlistid'] . ']'		=> 1
		);
		
		if (!empty($firstname))
			$body['first_name'] = $firstname;
		
		if (!empty($lastname))
			$body['last_name'] = $lastname;
		
		if (!empty($phone))
			$body['phone'] = $phone;
		
		if (!empty($orgname))
			$body['orgname'] = $orgname;

		if (!empty($options['activecampaignformid']))
			$body['form'] = $options['activecampaignformid'];
		
		$args = array(
				'method'	=> 'POST',
				'body'		=> $body
		);
		
		$raw_response = wp_remote_post( $apiurl, $args );
		
		if ( !is_wp_error( $raw_response ) && isset($raw_response['body']) && isset($raw_response['response']['code']) && $raw_response['response']['code'] == 200)
		{
			$response = json_decode($raw_response['body'], true);
			if ( isset($response['result_code']) ) 
			{
				if ( $response['result_code'] == 1 )
				{
					return array(
							'success'	=> 	true
					);
				}
				else
				{
					return 	array(
							'success'	=> 	false,
							'errorcode'	=> 	-2,
							'message'	=> 	(isset($response['result_message']) ? $response['result_message'] : '')
					);
				}
			}
			else
			{
				return array(
						'success'	=> 	false,
						'errorcode'	=> 	6,
						'message'	=> 	'Error: bad request to email service'
				);
			}
		}
		else
		{
			return 	array(
					'success'	=> 	false,
					'errorcode'	=> 	7,
					'message'	=> 	'Error: unable to connect to email service'
			);
		}
	}
	
}