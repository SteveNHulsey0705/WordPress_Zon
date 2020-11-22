<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class HN_Zoho_Account_Connector extends HN_Zoho_Connector {
	
	public function __construct() {
		parent::__construct();
		
		add_action('woocommerce_checkout_order_processed', array($this, 'create_account'));
	}
	
	/**
	 * when user place an order create account for the order
	 * However, need to be consider what???
	 * @param int $order_id 
	 */
	function create_account($order_id) {
		$this->woo_side_id = $order_id;
		$crm_data = array();
		/** @var $order WC_Order */
		$order = wc_get_order($order_id);
		
		
		/** @var $user WC_User */
		$user = $order->get_user();
		if ( !$user) {
			// order is by guest
		}
		
		$billing_add = $order->get_formatted_billing_address();
		
		$billing_street = $order->billing_address_1 . ' ' .$order ->  billing_address_1;
		$billing_city = $order->billing_city;
		$billing_state  = $order->billing_state;
		
		$billing_postcode  =  $order->billing_postcode;
		$billing_country    = $order->billing_country ;
		$billing_email = $order->billing_email;
		$billing_phone = $order->billing_phone;
		
		$billing_lastname = $order->billing_last_name;
		$billing_firstname = $order->billing_first_name;
		
		$billing_company = $order->billing_company;
		
		$crm_data['email'] = $billing_email;
		
		if ($billing_street)
		$crm_data['street']  = $billing_street;
		
		if ($billing_city) {
			$crm_data['city'] = $billing_city;
		} 
		
		if ($billing_state) {
			$crm_data['state'] = $billing_state;
		} 
		
		if ($billing_postcode) {
			$crm_data['zipcode'] = $billing_postcode;
		} 
		
		if ($billing_country) {
			$crm_data['country'] = $billing_country;
		} 
		
		/** Shipping address */

		$order->shipping_address_1 . ' ' .$order ->  shipping_address_1;
		$shipping_city = $order->shipping_city;
		$shipping_state  = $order->shipping_state;
		
		$shipping_postcode  =  $order->shipping_postcode;
		$shipping_country    = $order->shipping_country ;
		$shipping_email = $order->shipping_email;
		$shipping_phone = $order->shipping_phone;
		
		
		$extra_info =  get_post( $order_id );
		
		
		///////////////////////////////////////////////////////////////////////////
		//////////////////////////////////////////Mapping//////////////////////////
		///////////////////////////////////////////////////////////////////////////
		
		/** Account phone */
		$options = $this->getMappingOption ( 'account-phone' );
		if (! is_null ( $options ) && $options ['enable'] == 1 && $options ['value']) {
			if ($options ['value'] == 'billing_phone' && $billing_phone) {
				$crm_data ['phone'] = $billing_phone;
			} elseif ($options ['value'] == 'shipping_phone' && $shipping_phone) {
				$crm_data ['phone'] = $shipping_phone;
			}
		}
		
		/** account-description */
		$options = $this->getMappingOption ( 'account-description' );
		if (! is_null ( $options ) && $options ['enable'] == 1 && $options ['value']) { 
			$crm_data['description'] = $options ['value'];
		}
		
		$crm_data['account_name'] = $billing_firstname . ' ' . $billing_firstname;
		
		
		if (get_option ( 'zoho_crm_order_to_account' )=='yes') {
			$this->insert_account ( $crm_data );
		}
		///////////////////////////////////////////////////////////////////////////
		/////////////////////////////////INSERT CONTACT////////////////////////////
		///////////////////////////////////////////////////////////////////////////
		$crm_data['lastname'] = $billing_lastname;
		
		$options = $this->getMappingOption('contact-description');
		
		if (! is_null ( $options ) && $options ['enable'] == 1 && $options ['value']) {
			$crm_data['description'] = $options ['value'];
		}
		
		if (get_option('zoho_crm_order_to_contact')=='yes' ) 
		$this->insert_contact($crm_data);
	}
	public function insert_account($params) {
		if (! empty ( $params )) {
			$postXml = '<Accounts>\n<row no="1">\n';
			$postXml .= '<FL val="E-mail">'.$params['email'].'</FL>\n';
			$postXml .=  '<FL val="Account Name">'.$params['account_name'].'</FL>\n';
				
				
			//Title
				
			//Phone
			if (isset($params['phone'])) $postXml .= '<FL val="Phone">'.$params['phone'].'</FL>\n';
				
			//$postXml .= '<FL val="Billing Address">';
			//Street
			if (isset($params['street'])) $postXml .= '<FL val="Billing Street">'.$params['street'].'</FL>\n';
				
			//City
			if (isset($params['city'])) $postXml .= '<FL val="Billing City">'.$params['city'].'</FL>\n';
				
			//State
			if (isset($params['state'])) $postXml .= '<FL val="Billing State">'.$params['state'].'</FL>\n';
				
			//Zip Code
			if (isset($params['zipcode'])) $postXml .= '<FL val="Billing Code">'.$params['zipcode'].'</FL>\n';
				
			//Country
			if (isset($params['country'])) $postXml .= '<FL val="Billing Country">'.$params['country'].'</FL>\n';
			//$postXml .= '</FL>';
			//Description
			if (isset($params['description'])) $postXml .= '<FL val="Description">'.$params['description'].'</FL>\n';
			$postXml .= '</row>\n</Accounts>';
				
			//insert register customer to Lead record on Zoho side
			$this->target_url =  $this->base_url . 'Accounts';
			
			$this->log_type = 'account from order';
			$result = $this->sendCurlRequest('insertRecords' , $postXml);
			$this->log($result, $this->log_type );
			
		}
	}
	
	/**
	 * insert contact to ZohoCRM 
	 * @param array $params
	 */
	public function insert_contact($params) {
		if (! empty ( $params )) {
			$postXml = '<Contacts>\n<row no="1">\n';
			$postXml .= '<FL val="Email">'.$params['email'].'</FL>\n';
			$postXml .=  '<FL val="Last Name">'.$params['lastname'].'</FL>\n';
		
		
			//Title
		
			//Phone
			if (isset($params['phone'])) $postXml .= '<FL val="Phone">'.$params['phone'].'</FL>\n';
		
			//Street
			if (isset($params['street'])) $postXml .= '<FL val="Mailing Street">'.$params['street'].'</FL>\n';
		
			//City
			if (isset($params['city'])) $postXml .= '<FL val="Mailing City">'.$params['city'].'</FL>\n';
		
			//State
			if (isset($params['state'])) $postXml .= '<FL val="Mailing State">'.$params['state'].'</FL>\n';
		
			//Zip Code
			if (isset($params['zipcode'])) $postXml .= '<FL val="Mailing Zip">'.$params['zipcode'].'</FL>\n';
		
			//Country
			if (isset($params['country'])) $postXml .= '<FL val="Mailing Country">'.$params['country'].'</FL>\n';
			//Description
			if (isset($params['description'])) $postXml .= '<FL val="Description">'.$params['description'].'</FL>\n';
			$postXml .= '</row>\n</Contacts>';
			//insert register customer to Lead record on Zoho side
			$this->target_url =  $this->base_url . 'Contacts';
			$this->log_type = 'contact from order';
			$result = $this->sendCurlRequest('insertRecords' , $postXml);
			$this->log($result, $this->log_type );
		}
	}
}

return new HN_Zoho_Account_Connector();