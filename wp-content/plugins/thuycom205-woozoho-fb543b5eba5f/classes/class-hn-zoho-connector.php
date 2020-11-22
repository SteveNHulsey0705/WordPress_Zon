<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class HN_Zoho_Connector {
	public $target_url;
	public $log_type;
	public $base_url ;
	public $woo_side_id;
	public function __construct() {
		$this->base_url = "https://crm.zoho.com/crm/private/xml/";
	}
	
	public function getMappingOption($option) {
		if (  !class_exists( 'HN_Zoho_Fields_Mapping' ) ) {
			require_once HNZOHO_PATH .'admin/zoho-mapping-fields-setting.php';
		}
		$m = new HN_Zoho_Fields_Mapping();
		return $m->getOption($option);
	}
	
	public function log($message, $type ) {
		global $wpdb;
		$logTbl = $wpdb->prefix . 'hn_zoho_crm_log';
		$wpdb->insert($logTbl, array('mess' => $message ,'type'=>$type));
	}
	
	public function insert_report($woocommerce_id,$zoho_id, $type ) {
		global $wpdb;
		$tbl = $wpdb->prefix . 'hn_zoho_crm_report';
		$wpdb->insert($tbl, array('woocommerce_id' => $woocommerce_id,'zoho_id'=>$zoho_id ,'type'=>$type));
	}
	
	public function getAuthKey(){
		$authkey = get_option('zoho_crm_api_auth_key');
		
		if (!$authkey) {
			$username = get_option('zoho_crm_user_id');
			$password = get_option('zoho_crm_user_password');
		
			if (!$username || !$password)  {
				$this->log('do not set zohocrm userid or password', 'get Auth key');
				return 'admin do not set zohoCRM username or password';
			}
				
			$authkey = $this->getAuth($username,$password);
		
			if (!$authkey) {
				$message = "The ZohoCRM user name or password is invalid";
				return ;
			} else {
				update_option('zoho_crm_api_auth_key', $authkey);
			}
		
		}
		
		return $authkey;
	}
	
	public function sendCurlRequest( $methodname, $param) {

		try {
			$url = $this->target_url ."/".$methodname;
			$parameter = 'scope=crmapi';
			$parameter .= '&duplicateCheck=2';
			$parameter .= "&authtoken={$this->getAuthKey()}";//Give your authtoken
		    $parameter .= "&xmlData={$param}";
			/* initialize curl handle */
			$ch = curl_init ();
			/* set url to send post request */
			curl_setopt ( $ch, CURLOPT_URL, $url );
			/* allow redirects */
			curl_setopt ( $ch, CURLOPT_FOLLOWLOCATION, 1 );
			/* return a response into a variable */
			curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
			/* times out after 300s */
			curl_setopt ( $ch, CURLOPT_TIMEOUT, 300 );
			/* set POST method */
			curl_setopt ( $ch, CURLOPT_POST, 1 );
			/* add POST fields parameters */
			curl_setopt ( $ch, CURLOPT_POSTFIELDS, $parameter );
			/* execute the cURL */
			$result = curl_exec ( $ch );

			if (strpos($result, 'xml') > -1) {
				$xmlParse = simplexml_load_string($result);
				
				if ($xmlParse->result->recorddetail) {
					$fl = $xmlParse->result->recorddetail->FL[0];
					
					/** @var $fl SimpleXMLElement */
					
					$id_of_zoho =(string) $fl;
					$zoho_mess = (string)$xmlParse->result->message;
					$this->insert_report($this->woo_side_id, $id_of_zoho, $this->log_type);
				}
			}
			return $result;
		} catch ( Exception $exception ) {
			echo 'Exception Message: ' . $exception->getMessage () . '<br/>';
			echo 'Exception Trace: ' . $exception->getTraceAsString ();
		}
	}
	
	/**
	 * get Auth Key from Zoho
	 * example 
	 * string(87) "# #Wed Nov 12 06:50:51 PST 2014 AUTHTOKEN=4e3426bbeebd7296d149ca0cf0872229 RESULT=TRUE " {"authToken":"4e3426bbeebd7296d149ca0cf0872229","result":"TRUE"}NULL
	 */
	public function getAuth($username,$password) {
		   
			$param = "SCOPE=ZohoCRM/crmapi&EMAIL_ID=" . $username . "&PASSWORD=" . $password;
			$ch = curl_init ( "https://accounts.zoho.com/apiauthtoken/nb/create" );
			curl_setopt ( $ch, CURLOPT_POST, true );
			curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
			curl_setopt ( $ch, CURLOPT_POSTFIELDS, $param );
			$result = curl_exec ( $ch );
			
			$this->log($result, 'get Auth key');
			
			$anArray = explode ( "\n", $result );
			$authToken = explode ( "=", $anArray ['2'] );
			$cmp = strcmp ( $authToken ['0'], "AUTHTOKEN" );
			if ($cmp == 0) {
				return  $authToken ['1'];
				//$return_array ['authToken'] = $authToken ['1'];
			}
			$return_result = explode ( "=", $anArray ['3'] );
			$cmp1 = strcmp ( $return_result ['0'], "RESULT" );
			//if ($cmp1 == 0) {
				//$return_array ['result'] = $return_result ['1'];
			//}
			if ($return_result [1] == 'FALSE') {
				$return_cause = explode ( "=", $anArray [2] );
				$cmp2 = strcmp ( $return_cause [0], 'CAUSE' );
				//if ($cmp2 == 0)
				//	$return_array ['cause'] = $return_cause [1];
			}
			//echo json_encode ( $return_array );
			curl_close ( $ch );
	}
	
	public function searchProduct($data){
	
		$url = "https://crm.zoho.com/crm/private/xml/Products/searchRecords";
		
		if( $data['product_code'] ) {
			$param = "authtoken=".$this->getAuthKey()."&scope=crmapi&criteria=((Product Name:".$data['product_name'].")AND(Product Code:".$data['product_code']."))";
		} else {
			$param = "authtoken=".$this->getAuthKey()."&scope=crmapi&criteria=((Product Name:".$data['product_name']."))";
		}

		$ch = curl_init ();
		/* set url to send post request */
		curl_setopt ( $ch, CURLOPT_URL, $url );
		/* allow redirects */
		curl_setopt ( $ch, CURLOPT_FOLLOWLOCATION, 1 );
		/* return a response into a variable */
		curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
		/* times out after 300s */
		curl_setopt ( $ch, CURLOPT_TIMEOUT, 300 );
		/* set POST method */
		curl_setopt ( $ch, CURLOPT_POST, 1 );
		/* add POST fields parameters */
		curl_setopt ( $ch, CURLOPT_POSTFIELDS, $param );
		$result = curl_exec($ch);
		curl_close ( $ch );

		//convert result fomart XML from Zoho to array
		$p = xml_parser_create();
		xml_parse_into_struct($p, $result, $vals, $index);
		xml_parser_free($p);
		if($vals[1]['tag']=='RESULT'){
			$product_id = $vals[4]['value'];
			return $product_id;
		}
		
	}
	

}