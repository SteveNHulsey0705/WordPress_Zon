<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class HN_Zoho_Invoice_Connector extends HN_Zoho_Connector {
	public function __construct() {
		parent::__construct();
		add_action ( 'woocommerce_order_status_completed', array ( $this, 'invoice_observer') );
	}
	
	/**
	 * capture user reigster as a lead if he does not purchase any product
	 * @param int $user_id
	 */
	public function invoice_observer($order_id) {
		
		//$order = new WC_Order($order_id); deprecated
		$order = wc_get_order($order_id);
		$order_param['subject'] = 'Invoice #' . $order->id;
		$order_param['duedate'] = $order->post->post_date;
		$order_param['subtotal'] = $order->get_subtotal();
		$order_param['tax'] 	 = $order->get_total_tax();
		$order_param['adjustment'] = $order->get_total_discount();
		$order_param['grandtotal'] = $order->get_total();
		$order_param['billingcity'] = $order->billing_city;
		$order_param['billingstate'] = $order->billing_state;
		$order_param['billingpostcode'] = $order->billing_postcode;
		$order_param['billingcountry'] = $order->billing_country;
		$order_param['shippingcity'] = $order->shipping_city;
		$order_param['shippingstate'] = $order->shipping_state;
		$order_param['shippingpostcode'] = $order->shipping_postcode;
		$order_param['shippingcountry'] = $order->shipping_country;
		$order_param['customeruser'] = $order->billing_first_name . ' ' . $order->billing_last_name;
		$order_param['status'] = $order->get_status();
		
		// product details
		$product_params = array();
		foreach($order->get_items() as $item){
			$product_id = $item['product_id'];
			$param = array(
					'product_id' 	=> $product_id,
					'product_code'	=> get_post_meta( $product_id, '_sku', true),
					'product_name'	=> $item['name'],
					'qty'			=> $item['qty'],
					'line_total'	=> $item['line_total'],
					'line_tax'		=> $item['line_tax'],
					'price'			=> get_post_meta($product_id, '_price')[0]
			);
			
			$stock_status = get_post_meta($product_id, '_stock_status')[0];
			$param['stock_status'] = $stock_status == 'instock' ? 'Available' : '0';
			
			//Product description
			$cp_attrs = get_post_meta( $product_id, '_product_attributes' )[0]; // Current product attributes
			$cp_attr_terms[] = array();
			$des = '';
			foreach( $cp_attrs as $cp_attr ) {
				preg_match( '/pa_/', $cp_attr['name'], $match );
				if( empty( $match ) ) {
					$cp_attr_terms[] = $cp_attr['value'];
					$des .= $cp_attr['name'] . ': ' . $cp_attr['value'] . ', ';
				} else {
					foreach( woocommerce_get_product_terms( $product_id, $cp_attr['name'] ) as $item ) {
						$cp_attr_terms[] = $item->term_id;
						$des .= wc_attribute_label( $cp_attr['name'] ) . ': ' . $item->name . ', ';
					}
				}
			}
			$product = get_product($product_id);
			$param['description'] = $product->post->post_excerpt . ' ' . $product->post->post_content . ' ' . $des;
			
			// product category
			$product_cats = wp_get_post_terms( $product_id, 'product_cat' );
			$first = true;
			foreach( $product_cats as $product_cat ) {
				if( $first == true ) {
					$categories = $product_cat->name;
				} else {
					$categories .= ', ' . $product_cat->name;
					$first = false;
				}
			}
			$param['categories'] = $categories;
			array_push($product_params, $param);
		}
		
		$this->insert_invoice($order_param, $product_params);
	}
	

	/**
	 * insert order to ZohoCRM
	 * @param array $params
	 */
	public function insert_invoice($param, $products) {
		if ( $param ) {
				$postXml = '<Invoices>
<row no="1">
<FL val="Subject">' . $param['subject'] . '</FL>
<FL val="Due Date">' . $param['duedate'] . '</FL>
<FL val="Sub Total">' . $param['subtotal'] . '</FL>
<FL val="Tax">' . $param['tax'] . '</FL>
<FL val="Adjustment">' . $param['adjustment'] . '</FL>
<FL val="Grand Total">' . $param['grandtotal'] . '</FL>
<FL val="Billing City">' . $param['billingcity'] . '</FL>
<FL val="Shipping City">' . $param['shippingcity'] . '</FL>
<FL val="Billing State">' . $param['billingstate'] . '</FL>
<FL val="Shipping State">' . $param['shippingstate'] . '</FL>
<FL val="Billing Code">' . $param['billingpostcode'] . '</FL>
<FL val="Shipping Code">' . $param['shippingpostcode'] . '</FL>
<FL val="Billing Country">' . $param['billingcountry'] . '</FL>
<FL val="Shipping Country">' . $param['shippingcountry'] . '</FL>
<FL val="Account Name">' . $param['customeruser'] . '</FL>
';
				$count = 0;
				$postXml .= '<FL val="Product Details">';
				foreach( $products as $param ) {
					$count ++;
					$postXml .= '<product no="' . $count . '">
<FL val="Product Id">' . $this->searchProduct( $param ) . '</FL>
<FL val="Product Name">' . $param['product_name'] . '</FL>
<FL val="Unit Price">' . $param['price'] . '</FL>
<FL val="Qty Ordered">' . $param['qty'] . '</FL>
<FL val="Total">' . $param['line_total'] . '</FL>
<FL val="Tax">' . $param['line_tax'] . '</FL>
<FL val="Product Category">' . $param['categories'] . '</FL>
<FL val="Description">' . $param['description'] . '</FL>
</product>';
				}
				$postXml .= '</FL>';
				$postXml .= '
</row>
</Invoices>';
				//insert register customer to Lead record on Zoho side
				$this->target_url =  $this->base_url . 'Invoices';
				$this->log_type = 'invoice';
				$result = $this->sendCurlRequest('insertRecords' , $postXml);
				$this->log($result, $this->log_type );
		}
	}
	
}

return new HN_Zoho_Invoice_Connector();