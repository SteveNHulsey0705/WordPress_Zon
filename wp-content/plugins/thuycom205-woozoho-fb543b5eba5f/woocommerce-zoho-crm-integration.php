<?php
/**
 * Plugin Name: WooCommerce Zoho CRM Integration
 * Plugin URI: http://hungnamecommerce.com/index.php/woocommerce-zoho-crm-integration
 * Description: Export customer and order information to Zoho crm via the
 * Author: Hungnam
 * Author URI:http://hungnamecommerce.com
 * Version: 1.1
 * Text Domain: woocommerce-zoho-crm-integration
 * Domain Path: /languages/
 *
 * Copyright: (c) 2011-2014 Hungnam. (info@hungnamecommerce.com)
 *
 *
 * @package   woocommerce-zoho-crm-integration
 * @author    Hungnam
 * @category  Integration
 * @copyright Copyright (c) 2014, Hunganm, Inc.
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


if (! defined ('ZOHO_TEXT_DOMAIN'))
	define ( 'ZOHO_TEXT_DOMAIN', 'hn_zoho_integration' );

// Plugin Folder Path
if (! defined ('HNZOHO_PATH'))
	define ('HNZOHO_PATH', plugin_dir_path ( __FILE__ ) );

// Plugin Folder URL
if (! defined ('HNZOHO_URL'))
	define ('HNZOHO_URL', plugins_url ( 'woocommerce-zoho-crm-integration', 'woocommerce-zoho-crm-integration.php' ) );

// Plugin Root File
if (! defined ('HNZOHO_FILE'))
	define ('HNZOHO_FILE', plugin_basename ( __FILE__ ) );

class HN_Zoho_Integration {
	
	private static $hnzoho_instance;
	
	/** plugin version number */
	const VERSION = '1.1';
	
	/** plugin text domain */
	const TEXT_DOMAIN = 'hn_zoho_integration';
	
    public  $logger ;
	
	public function __construct() {
		global $wpdb;
		
		
		
		register_activation_hook ( HNZOHO_FILE, array ($this,'install' ) );
		
		add_action ( 'init', array ($this,'load_domain' ), 1 );
		
		add_filter ( 'woocommerce_get_settings_pages', array ($this,'add_settings_page' ), 10, 1 );
		
		$this->include_for_frontend();
		
		if (is_admin ()) {
			add_action ( 'admin_menu', array ( $this, 'admin_menu' ), 5 );
			$this->include_for_admin ();
		}
	}
	
	/**
	 * Load the Text Domain for i18n
	 *
	 * @return void
	 * @access public
	 */
	function load_domain() {
		load_plugin_textdomain ( ZOHO_TEXT_DOMAIN, false, 'woocommerce-zoho-crm-integration/languages/' );
	}
	/**
	 * Queue up the JavaScript file for the admin page, only on our admin page
	 *
	 * @param string $hook
	 *   The current page in the admin
	 * @return void
	 * @access public
	 */
	public function load_custom_scripts($hook) {
		global $woocommerce;
		
		if (is_object($woocommerce))
		
		wp_enqueue_style ( 'woocommerce_admin_styles', $woocommerce->plugin_url () . '/assets/css/admin.css' );
		wp_enqueue_style('datatables' , HNZOHO_URL .'/js/datatables/css/jquery.dataTables.min.css');
	
		$jquery_version = isset ( $wp_scripts->registered ['jquery-ui-core']->ver ) ? $wp_scripts->registered ['jquery-ui-core']->ver : '1.9.2';
	
		wp_enqueue_script ( 'woocommerce_writepanel' );
	
		wp_enqueue_script ( 'jquery' );
	
		wp_enqueue_script('datatables-for-fue' , HNZOHO_URL. '/js/datatables/js/jquery.dataTables.min.js');
		
		wp_enqueue_style( 'jquery-ui', 'http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css' );
		
		wp_enqueue_style( 'jquery-ui-style');
		wp_enqueue_style( 'jquery-ui-core');
		wp_enqueue_style( 'jquery-ui-accordion');
		wp_enqueue_script('jquery-ui-core');
		wp_enqueue_script('jquery-ui-datepicker');
		
		wp_enqueue_script('jquery-ui-accordion');
	}
	/**
	 * Run every time.  Used since the activation hook is not executed when updating a plugin
	 *
	 * @since 0.1
	 */
	public function install() {
		global $wpdb;
		// get current version to check for upgrade
		$installed_version = get_option( 'hn_zoho_integration_version' );
		
		// install
		if ( ! $installed_version ) {
				
			// install default settings, terms, etc
			
			if (!function_exists('dbDelta')) {
				require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
				
			}
			$prefix = $wpdb->prefix;
			
			$query = "CREATE TABLE IF NOT EXISTS `{$prefix}hn_zoho_crm_field_mapping` (
			`id` int(11) unsigned NOT NULL auto_increment,
			`op` varchar (255)  NOT NULL,
			`value` varchar (255)  NOT NULL,
			`enable` tinyint  NOT NULL,
			PRIMARY KEY (`id`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8 ;";
			
			dbDelta( $query );
			$query = "CREATE TABLE IF NOT EXISTS `{$prefix}hn_zoho_crm_log` (
			`id` int(11) unsigned NOT NULL auto_increment,
			`mess` text NULL,
			`type` varchar (255) NULL,
			`created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
			PRIMARY KEY (`id`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8 ;";
			
			dbDelta( $query );
			
			$query = "CREATE TABLE IF NOT EXISTS `{$prefix}hn_zoho_crm_report` (
			`id` int(11) unsigned NOT NULL auto_increment,
			`woocommerce_id` varchar (255) NULL,
			`zoho_id` varchar (255) NULL,
			`type` varchar (255) NULL,
			`created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
			PRIMARY KEY (`id`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8 ;";
			
			dbDelta( $query );
			//WC_Form_Handler
			update_option( 'hn_zoho_integration_version', self::VERSION );
				
		}
	
		// upgrade if installed version lower than plugin version
		if ( -1 === version_compare( $installed_version, self::VERSION ) )
		$this->upgrade( $installed_version );
	}
	
	
	/**
	 * Perform any version-related changes
	 *
	 * @since 1.0
	 * @param int $installed_version the currently installed version of the plugin
	 */
	public function upgrade( $installed_version ) {
	
		// update the installed version option
		update_option( 'hn_zoho_integration_version', self::VERSION );
	}
	
	/**
	 * add menu items
	 */
	public function admin_menu() {
		global $menu;
	
		add_menu_page(__('Zoho CRM Integration'), __('Zoho CRM Integration'), 'manage_woocommerce','zoho-crm-integration', array($this,'zoho_crm_integration' ));
		
		add_submenu_page ( 'zoho-crm-integration', __ ( 'Fields Mapping Settings', 'woocommerce' ), __ ( 'Fields Mapping Settings', 'woocommerce' ), 'manage_woocommerce', 'zoho-field-mapping', array ( $this, 'zoho_field_mapping' ) );
	
		add_submenu_page ( 'zoho-crm-integration', __ ( 'Report', 'woocommerce' ), __ ( 'Report', 'woocommerce' ), 'manage_woocommerce', 'zoho-report', array ( $this, 'zoho_report' ) );
	
	}
	
	public function zoho_crm_integration() {
		$setting_page = admin_url('admin.php?page=wc-settings&tab=hnzoho');
		
	   $out =   sprintf('<a href="%s" >%s </a>' , $setting_page, __('ZohoCRM Integration Setting' , ZOHO_TEXT_DOMAIN) );
	   echo $out;
	}
	
	/**
	 * Page that allow admin setting mapping fields between Woocommerce and ZohoCRM
	 */
	public function zoho_field_mapping() {
		
		$fields_mapping = include  HNZOHO_PATH.'admin/zoho-mapping-fields-setting.php';
		$fields_mapping->output();
	}
	
	public function zoho_report() {
		$report= include  HNZOHO_PATH.'admin/zoho-report.php';
		$report->output();
	}
	
	public function add_settings_page() {
		$settings [] = include (HNZOHO_PATH. 'admin/zoho-settings.php');
		
		return apply_filters ( 'hnzoho_setting_classes', $settings );
	}
	
	/**
	 *include necessary files for frontend function 
	 */
	public function include_for_frontend() {
		require_once plugin_dir_path ( __FILE__ ) . 'classes/class-hn-zoho-connector.php';
		require_once plugin_dir_path ( __FILE__ ) . 'classes/class-hn-zoho-connector-lead.php';
		require_once plugin_dir_path ( __FILE__ ) . 'classes/class-hn-zoho-connector-account.php';
		require_once plugin_dir_path ( __FILE__ ) . 'classes/class-hn-zoho-connector-order.php';
		require_once plugin_dir_path ( __FILE__ ) . 'classes/class-hn-zoho-connector-invoice.php';
	}
	
	/**
	 * include necessary files for backend function
	 */
	public function include_for_admin() {
		add_action ( 'admin_enqueue_scripts', array ($this,'load_custom_scripts' ), 99 );
		
		require_once plugin_dir_path ( __FILE__ ). 'admin/zoho-mapping-fields-setting.php';
		require_once plugin_dir_path ( __FILE__ ). 'admin/zoho-report.php';
	}
	
	/**
	 * Get the singleton instance of our plugin
	 *
	 * @return class The Instance
	 * @access public
	 */
	public static function getInstance() {
		if (! self::$hnzoho_instance) {
			self::$hnzoho_instance = new HN_Zoho_Integration();
		}
	
		return self::$hnzoho_instance;
	}
}

$hnzoho_loaded = HN_Zoho_Integration::getInstance ();
