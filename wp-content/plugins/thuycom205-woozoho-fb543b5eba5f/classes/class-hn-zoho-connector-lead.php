<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class HN_Zoho_Lead_Connector extends HN_Zoho_Connector {
	
	public function __construct() {
		parent::__construct();
		$this->target_url =  $this->base_url . 'Leads';
		$this->log_type = 'lead from registered user';
		
		//if the admin enable transmitting customer to lead then do it
		if (get_option('zoho_crm_user_to_lead') == 'yes')
		add_action('user_register', array($this, 'user_register_observer'));
	}
	
	/**
	 * capture user reigster as a lead if he does not purchase any product
	 * Zoho CRM side : Company , Last Name is mandatory fields
	 * 
	 * @param int $user_id        	
	 */
	public function user_register_observer($user_id = 1) {
		$this->woo_side_id = $user_id;
		$user_data = get_userdata ( $user_id );
		
		$lead_data = array ();
		$email = $user_data->data->user_email;
		// var_dump($user_data->data);
		
		$customer_data = get_user_meta ( $user_id, null, 'true' );
		
		$lastname = get_user_meta ( $user_id, 'last_name', 'true' );
		$firstname = get_user_meta ( $user_id, 'first_name', 'true' );
		if (! $lastname) {
			$lastname = $user_data->data->display_name;
		}
		
		$lead_data['lastname'] = $lastname;
		$lead_data['email'] = $email;
		// compare with fields mappping setting
		
		/**
		 * Title
		 */
		$options = $this->getMappingOption ( 'lead-zoho-title' );
		
		if (! is_null ( $options ) && $options ['enable'] == 1 && $options ['value'])
			$lead_data ['title'] = $options ['value'];
		
		/** lead-zoho-company */
		$options = $this->getMappingOption ( 'lead-zoho-company' );
		
		if (! is_null ( $options ) && $options ['enable'] == 1 && $options ['value']) {
			$woo = $options ['value'];
				
			if (isset ( $customer_data [$woo] ) && $customer_data [$woo] [0])
				$lead_data ['company'] = $customer_data [$woo] [0];
		}
		/**
		 * Phone
		 */
		$options = $this->getMappingOption ( 'lead-zoho-phone' );
		
		if (! is_null ( $options ) && $options ['enable'] == 1 && $options ['value']) {
			$woo = $options ['value'];
			
			if (isset ( $customer_data [$woo] ) && $customer_data [$woo] [0])
				$lead_data ['phone'] = $customer_data [$woo] [0];
		}
		/**
		 * Mobile
		 */
		$options = $this->getMappingOption ( 'lead-zoho-mobile' );
		
		if (! is_null ( $options ) && $options ['enable'] == 1 && $options ['value']) {
			$woo = $options ['value'];
			if (isset ( $customer_data [$woo] ) && $customer_data [$woo] [0])
				$lead_data ['mobile'] = $customer_data [$woo] [0];
		}
		/**
		 * street
		 */
		$options = $this->getMappingOption ( 'lead-zoho-street' );
		
		if (! is_null ( $options ) && $options ['enable'] == 1 && $options ['value']) {
			$woo = $options ['value'] . '_1';
			if (isset ( $customer_data [$woo] ) && $customer_data [$woo] [0])
				$lead_data ['street'] = $customer_data [$woo] [0];
			
			$woo = $options ['value'] . '_2';
			if (isset ( $customer_data [$woo] ) && $customer_data [$woo] [0])
				$lead_data ['street'] .= $customer_data [$woo] [0];
		}
		/**
		 * lead-zoho-city
		 */
		
		$options = $this->getMappingOption ( 'lead-zoho-city' );
		
		if (! is_null ( $options ) && $options ['enable'] == 1 && $options ['value']) {
			$woo = $options ['value'];
			if (isset ( $customer_data [$woo] ) && $customer_data [$woo] [0])
				$lead_data ['city'] = $customer_data [$woo] [0];
		}
		/**
		 * lead-zoho-state
		 */
		
		$options = $this->getMappingOption ( 'lead-zoho-state' );
		
		if (! is_null ( $options ) && $options ['enable'] == 1 && $options ['value']) {
			$woo = $options ['value'];
			if (isset ( $customer_data [$woo] ) && $customer_data [$woo] [0])
				$lead_data ['state'] = $customer_data [$woo] [0];
		}
		/**
		 * lead-zoho-zipcode
		 */
		
		$options = $this->getMappingOption ( 'lead-zoho-zipcode' );
		
		if (! is_null ( $options ) && $options ['enable'] == 1 && $options ['value']) {
			$woo = $options ['value'];
			if (isset ( $customer_data [$woo] ) && $customer_data [$woo] [0])
				$lead_data ['zipcode'] = $customer_data [$woo] [0];
		}
		/**
		 * lead-zoho-country
		 */
		
		$options = $this->getMappingOption ( 'lead-zoho-country' );
		
		if (! is_null ( $options ) && $options ['enable'] == 1 && $options ['value']) {
			$woo = $options ['value'];
			if (isset ( $customer_data [$woo] ) && $customer_data [$woo] [0])
				$lead_data ['country'] = $customer_data [$woo] [0];
		}
		/**
		 * lead-zoho-description
		 */
		
		$options = $this->getMappingOption ( 'lead-zoho-description' );
		
		if (! is_null ( $options ) && $options ['enable'] == 1 && $options ['value']) {
			$description = $options ['value'];
			if ($description)
				$lead_data ['description'] = $description;
		}
		
		if (!isset($lead_data['company']) || !$lead_data['company']) 
			$lead_data['company'] = 'NA';
		
		//call zoho api to insert lead
		$this->insert_lead($lead_data);
	}
	
	/**
	 *
	 * @param array $params        	
	 */
	public function insert_lead($params) {
		if (! empty ( $params )) {
			$postXml = '<Leads>\n<row no="1">\n';
			$postXml .= '<FL val="Last Name">'.$params['lastname'].'</FL>\n';
			$postXml .= '<FL val="Email">'.$params['email'].'</FL>\n';
			$postXml .=  '<FL val="Company">'.$params['company'].'</FL>\n';
			
			//First Name 
			if (isset($params['firstname'])) $postXml .= '<FL val="First Name">'.$params['firstname'].'</FL>\n';
			
			//Title
			if (isset($params['title'])) $postXml .= '<FL val="Title">'.$params['title'].'</FL>\n';
			
			//Phone
			if (isset($params['phone'])) $postXml .= '<FL val="Phone">'.$params['phone'].'</FL>\n';
			
			//Mobile
			if (isset($params['mobile'])) $postXml .= '<FL val="Mobile">'.$params['mobile'].'</FL>\n';
			
			//Street
			if (isset($params['street'])) $postXml .= '<FL val="Street">'.$params['street'].'</FL>\n';
			
			//City
			if (isset($params['city'])) $postXml .= '<FL val="City">'.$params['city'].'</FL>\n';
			
			//State
			if (isset($params['state'])) $postXml .= '<FL val="State">'.$params['state'].'</FL>\n';
			
			//Zip Code
			if (isset($params['zipcode'])) $postXml .= '<FL val="Zip Code">'.$params['zipcode'].'</FL>\n';
			
			//Country
			if (isset($params['country'])) $postXml .= '<FL val="Country">'.$params['country'].'</FL>\n';
			
			//Description
			if (isset($params['description'])) $postXml .= '<FL val="Description">'.$params['description'].'</FL>\n';
			$postXml .= '</row>\n</Leads>';
			

			//insert register customer to Lead record on Zoho side
			$result = $this->sendCurlRequest('insertRecords' , $postXml);
			
			$this->log($result, $this->log_type );
		}
	}
	
}
return new HN_Zoho_Lead_Connector();