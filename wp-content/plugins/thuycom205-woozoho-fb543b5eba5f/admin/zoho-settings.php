<?php
/**
 * Hungnam ZohoCRM Integration Settings
 *
 */
if (! defined ( 'ABSPATH' ))
	exit (); // Exit if accessed directly

if (! class_exists ( 'HN_Zoho_Settings' )) :

if (!class_exists('WC_Settings_Page')) 
	include_once dirname (HNZOHO_PATH) . '/woocommerce/includes/admin/settings/class-wc-settings-page.php';
	
	/**
	 * WC_Settings_Accounts
	 */
	class HN_Zoho_Settings extends WC_Settings_Page {
		
		/**
		 * Constructor.
		 */
		public function __construct() {
			$this->id = 'hnzoho';
			$this->label = __ ( 'ZohoCRM integration', ZOHO_TEXT_DOMAIN );
			
			add_filter ( 'woocommerce_settings_tabs_array', array ( $this, 'add_settings_page' ), 20 );
			add_action ( 'woocommerce_settings_' . $this->id, array ( $this, 'output' ) );
			add_action ( 'woocommerce_settings_save_' . $this->id, array ( $this, 'save' ) );
		}
		
		/**
		 * Get settings array
		 *
		 * @return array
		 */
		public function get_settings() {
			
			$api_limit_note = __("This event will be incurred when our module calls Zoho api excedd maximum number of calls per day. To view called number time of your zoho account let open your Zoho CRM page > set up > Developer  Space > CRM API Usage Information",ZOHO_TEXT_DOMAIN) ;
			$api_auth_key_note  = __('The plugin will generate auth key automatically when you enter user and password of ZohoCRM', ZOHO_TEXT_DOMAIN);
			
			$options = apply_filters ( 'woocommerce_zohocrm_settings', array (
					
					array (
							'title' => __ ( 'Zoho CRM Integration Options', ZOHO_TEXT_DOMAIN ),
							'type' => 'title',
							'id' => 'zoho_processing_options_title' 
					),
					
					array (
							'title' => __ ( 'Zoho CRM User ID', ZOHO_TEXT_DOMAIN ),
							'id' => 'zoho_crm_user_id',
							'type' => 'text',
							'autoload' => false 
					),
					
					array (
							'name' => __ ( 'Zoho CRM Password', ZOHO_TEXT_DOMAIN ),
							'id' => 'zoho_crm_user_password',
							'type' => 'text',
					),
					
// 					array (
// 							'title' => __ ( 'Zoho API limit event', ZOHO_TEXT_DOMAIN ),
// 							'desc' => __ ( $api_limit_note, ZOHO_TEXT_DOMAIN ),
// 							'id' => 'zoho_crm_api_limit_event',
// 							'type' => 'text',
// 							'autoload' => false 
// 					) ,
					array (
							'title' => __ ( 'Zoho API Auth Token', ZOHO_TEXT_DOMAIN ),
							'desc' => __ ( $api_auth_key_note, ZOHO_TEXT_DOMAIN ),
							'id' => 'zoho_crm_api_auth_key',
							'type' => 'text',
							'autoload' => false
					) ,
					array (
							'title' => __ ( 'Manual set Auth Token', ZOHO_TEXT_DOMAIN ),
							'desc' => __ ( 'Check this checkbox if you want to  manually enter Auth Token instead get Auth key automatically', ZOHO_TEXT_DOMAIN ),
							'id' => 'manual_set_auth_token',
							'type' => 'checkbox',
							'autoload' => false ,
					) ,
				
					array (
							'title' => __ ( 'Register User to Lead', ZOHO_TEXT_DOMAIN ),
							'desc' => __ ( 'Transmit registed users in Woocommerce to Lead in Zoho CRM', ZOHO_TEXT_DOMAIN ),
							'id' => 'zoho_crm_user_to_lead',
							'type' => 'checkbox',
							'autoload' => false ,
					) ,
				
					array (
							'title' => __ ( 'Orders in Woocommerce  into Account of Zoho CRM', ZOHO_TEXT_DOMAIN ),
							'desc' => __ ( 'Transmit Orders in Woocommerce  into Account of Zoho CRM', ZOHO_TEXT_DOMAIN ),
							'id' => 'zoho_crm_order_to_account',
							'type' => 'checkbox',
							'autoload' => false 
					) ,
					array (
							'title' => __ ( 'Orders in Woocommerce  into Contact of Zoho CRM', ZOHO_TEXT_DOMAIN ),
							'desc' => __ ( 'Transmit Orders in Woocommerce  into Contact of Zoho CRM', ZOHO_TEXT_DOMAIN ),
							'id' => 'zoho_crm_order_to_contact',
							'type' => 'checkbox',
							'autoload' => false 
					) 
			)
			 );
			
			return $options;
		}
		
		public function output() {
			parent::output();
			$js =  '<script type="text/javascript">';
			$js .= 'jQuery(document).ready(function() {
					jQuery("#zoho_crm_api_auth_key").parent().parent()  .hide();
					jQuery("#manual_set_auth_token").change(function() {
					  if(this.checked) {
					//alert("test");
					jQuery("#zoho_crm_api_auth_key").parent().parent() .show();
                 //Do stuff
           } else { 
		       jQuery("#zoho_crm_api_auth_key").parent().parent()  .hide();
					
		}
		});
		}); </script>';
			echo $js;
		}
	}


endif;

return new HN_Zoho_Settings ();

return new HN_Zoho_Settings ();