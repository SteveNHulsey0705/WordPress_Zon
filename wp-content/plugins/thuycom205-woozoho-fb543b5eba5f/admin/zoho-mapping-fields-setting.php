<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if (  !class_exists( 'HN_Zoho_Fields_Mapping' ) ) {
	class HN_Zoho_Fields_Mapping {
		
		/**
		 * Get option in Fields Mapping
		 * @param string $option
		 */
		public  function getOption($option) {
			global  $wpdb;
			$mapTbl = $wpdb->prefix . 'hn_zoho_crm_field_mapping';
			
			$query =  "select * from {$mapTbl} where op =" . '"' . $option . '"';
			$row = $wpdb->get_row( $query , ARRAY_A);
			
			return $row;
		}
		public function process() {
			global  $wpdb;
			$mapTbl = $wpdb->prefix . 'hn_zoho_crm_field_mapping';
			
		
			
			if (!empty($_POST)) {
				foreach ($_POST as $key=> $value) {
					$enable = isset($_POST[$key. '-enable']) && $_POST[$key. '-enable'] ?1 :0;
					
					$data = array('op' =>$key , 'value' => $value , 'enable' => $enable );
					
					//insert into db
					$option  = $this->getOption($key);
					if (!$option  || $option == null)  {
					$wpdb->insert($mapTbl, $data);}
					else {
						$wpdb->update($mapTbl, $data, array('id' =>$option['id'] ));
					}
				}
			} 
			
		}
	 public function render_checkbox($key) {
	 	$checked ='';
	 	$option  = $this->getOption($key);
	 	if (!$option || empty($option) || !isset($option['enable']) || $option['enable'] != 1) {
	 		$checked ='';
	 	}  else {
	 		$checked ="checked='checked'";
	 	}
	 	 return $checked;
	 }
	 public function render_selected($key,$value) {
	 	$select ='';
	 	$option  = $this->getOption($key);
	 	if (!$option || empty($option) || !isset($option['value']) || $option['value'] != $value) {
	 		$select ='';
	 	}  else {
	 		$select  ="selected='selected'";
	 	}
	 	 return $select;
	 }
		public function output() {
			
			if (isset($_POST['zoho-crm-mapping']) ) {
				$this->process() ;
			} 
			$this->show_grid_view();
		}
		public function show_grid_view() {
			?>
<style>
<!--

-->
td {text-align: center;}
td select {width: 100%; text-align: center;}
</style>			
<form name="lead-mapping-for-zohocrm" id="lead-mapping-for-zohocrm"
	method="post"
	action="<?php echo admin_url('admin.php?page=zoho-field-mapping')?>">
	<div id="lead-accordion-wrapper">
	<h3><?php echo __('Lead mapping', ZOHO_TEXT_DOMAIN) ?></h3>
	<table id="lead-mapping-table">
	<colgroup>
       <col span="1" style="width: 15%;">
       <col span="1" style="width: 35%;">
       <col span="1" style="width: 35%;">
       <col span="1" style="width: 15%;">
    </colgroup>
		<thead>
			<tr>
				<th>
	 	<?php echo __('Label')?>
	 	</th>

				<th>
	 	<?php echo __('Woocommerce Side')?>
	 	</th>

				<th>
	 	<?php echo __('ZohoCRM Side')?>
	 	</th>
				<th>
	 	<?php echo __('Enable')?>
	 	</th>
			</tr>
		</thead>

		<tbody>
			<tr>
				<td><?php echo __('Title')?></td>
				<td></td>
				<td><input type="text" name="lead-zoho-title" value="<?php $v = $this->getOption('lead-zoho-title'); if (isset($v['value'])) echo $v['value'] ?>"/></td>
				<td><input type="checkbox" name="lead-zoho-title-enable"
					placeholder="Enter title for lead" value="1" /> <input
					type="hidden" name="zoho-crm-mapping" value="1" /></td>
			</tr>
			<tr>
				<td><?php echo __('Phone')?></td>
				<td><select name="lead-zoho-phone">
						<option <?php echo $this->render_selected('lead-zoho-phone', 'billing_phone') ?> value="billing_phone"> <?php echo __('Billing Phone') ?> </option>
						<option <?php echo $this->render_selected('lead-zoho-phone', 'shipping_phone') ?> value="shipping_phone"> <?php echo __('Shipping Phone') ?> </option>
				</select></td>
				<td><?php echo __('->Phone') ?></td>
				<td><input type="checkbox" <?php echo $this->render_checkbox('lead-zoho-phone') ?> value="1" name="lead-zoho-phone-enable" /></td>
			</tr>
			<tr>
				<td><?php echo __('Mobile')?></td>
				<td><select name="lead-zoho-mobile">
						<option <?php echo $this->render_selected('lead-zoho-mobile', 'billing_phone') ?>  value="billing_phone"> <?php echo __('Billing Phone') ?> </option>
						<option <?php echo $this->render_selected('lead-zoho-mobile', 'shipping_phone') ?> value="shipping_phone"> <?php echo __('Shipping Phone') ?> </option>
				</select></td>
				<td><?php echo __('->Mobile') ?></td>
				<td><input type="checkbox" value="1" name="lead-zoho-mobile-enable" <?php echo $this->render_checkbox('lead-zoho-mobile') ?> /></td>

			</tr>
			<tr>
				<td><?php echo __('Company')?></td>
				<td><select name="lead-zoho-company">
						<option <?php echo $this->render_selected('lead-zoho-company', 'billing_company') ?> value="billing_company"> <?php echo __('Billing Company') ?> </option>
						<option <?php echo $this->render_selected('lead-zoho-company', 'shipping_company') ?> value="shipping_company"> <?php echo __('Shipping Company') ?> </option>
				</select></td>
				<td><?php echo __('-> Company') ?></td>
				<td><input type="checkbox" value="1" name="lead-zoho-company-enable" <?php echo $this->render_checkbox('lead-zoho-company') ?> /></td>

			</tr>

			<!-- Address part -->
			<tr>
				<td><?php echo __('Street')?></td>
				<td><select name="lead-zoho-street">
						<option <?php echo $this->render_selected('lead-zoho-street', 'billing_address') ?>  value="billing_address"> <?php echo __('Billing Street') ?> </option>
						<option <?php echo $this->render_selected('lead-zoho-street', 'shipping_address') ?> value="shipping_address"> <?php echo __('Shipping Street') ?> </option>
				</select></td>
				<td><?php echo __('-> Street') ?></td>
				<td><input type="checkbox" value="1" name="lead-zoho-street-enable" <?php echo $this->render_checkbox('lead-zoho-street') ?> /></td>

			</tr>
			<tr>
				<td><?php echo __('City')?></td>
				<td><select name="lead-zoho-city">
						<option <?php echo $this->render_selected('lead-zoho-city', 'billing_city') ?>  value="billing_city"> <?php echo __('Billing City') ?> </option>
						<option <?php echo $this->render_selected('lead-zoho-city', 'shipping_city') ?> value="shipping_city"> <?php echo __('Shipping City') ?> </option>
				</select></td>
				<td><?php echo __('-> City') ?></td>
				<td><input type="checkbox" value="1" name="lead-zoho-city-enable" <?php echo $this->render_checkbox('lead-zoho-city') ?>/></td>

			</tr>
			<tr>
				<td><?php echo __('State')?></td>
				<td><select name="lead-zoho-state">
						<option <?php echo $this->render_selected('lead-zoho-state', 'billing_state') ?> value="billing_state"> <?php echo __('Billing State') ?> </option>
						<option  <?php echo $this->render_selected('lead-zoho-state', 'shipping_state') ?> value="shipping_state"> <?php echo __('Shipping State') ?> </option>
				</select></td>
				<td><?php echo __('-> State') ?></td>
				<td><input type="checkbox" value="1" name="lead-zoho-state-enable" <?php echo $this->render_checkbox('lead-zoho-state') ?> /></td>

			</tr>
			<tr>
				<td><?php echo __('Zipcode')?></td>
				<td><select name="lead-zoho-zipcode">
						<option value="billing_postcode" <?php echo $this->render_selected('lead-zoho-zipcode', 'billing_postcode') ?> > <?php echo __('Billing Zipcode') ?> </option>
						<option value="shipping_postcode" <?php echo $this->render_selected('lead-zoho-zipcode', 'shipping_postcode') ?>> <?php echo __('Shipping Zipcode') ?> </option>
				</select></td>
				<td><?php echo __('-> Zipcode') ?></td>
				<td><input type="checkbox" value="1" name="lead-zoho-zipcode-enable" <?php echo $this->render_checkbox('lead-zoho-zipcode') ?> /></td>

			</tr>
			<tr>
				<td><?php echo __('Country')?></td>
				<td><select name="lead-zoho-country">
						<option value="billing_country" <?php echo $this->render_selected('lead-zoho-country', 'billing_country') ?>> <?php echo __('Billing Company') ?> </option>
						<option value="shipping_country" <?php echo $this->render_selected('lead-zoho-country', 'shipping_country') ?> > <?php echo __('Shipping Company') ?> </option>
				</select></td>
				<td><?php echo __('-> Country') ?></td>
				<td><input type="checkbox" value="1" name="lead-zoho-country-enable" <?php echo $this->render_checkbox('lead-zoho-country') ?>/></td>

			</tr>
			<tr>
				<td><?php echo __('Description')?></td>
				<td></td>
				<td><textarea name="lead-zoho-description" rows="" cols=""
						placeholder="enter your description for lead which is synch from woocommerce store"><?php $v = $this->getOption('lead-zoho-description'); if (isset($v['value'])) echo $v['value'] ?></textarea></td>
				<td><input type="checkbox" value="1"
					name="lead-zoho-description-enable" <?php echo $this->render_checkbox('lead-zoho-description') ?>/></td>

			</tr>
		</tbody>
	</table>
</div>

	<hr>
	<div id="account-accordion-wrapper">
	
	<!-- account mapping -->
	<h3> <?php echo __('Fields Mapping for Account of ZohoCRM') ?></h3>
	<table>
		<thead>
			<tr>
				<th>
	 	<?php echo __('Label')?>
	 	</th>

				<th>
	 	<?php echo __('Woocommerce Side')?>
	 	</th>

				<th>
	 	<?php echo __('ZohoCRM Side')?>
	 	</th>
				<th>
	 	<?php echo __('Enable')?>
	 	</th>
			</tr>
		</thead>

		<tbody>
			
			<tr>
				<td><?php echo __('Phone')?></td>
				<td><select name="account-phone">
						<option value="billing_phone" <?php echo $this->render_selected('account-phone', 'billing_phone') ?> > <?php echo __('Billing Phone') ?> </option>
						<option value="shipping_phone" <?php echo $this->render_selected('account-phone', 'shipping_phone') ?>> <?php echo __('Shipping Phone') ?> </option>
				</select></td>
				<td>  <?php echo __('Phone') ?></td>
				<td><input type="checkbox" value="1" name="account-phone-enable" <?php echo $this->render_checkbox('account-phone') ?> /></td>
			</tr>

			<!-- contact email mapping -->
			<tr>
				<td><?php echo __('Description')?></td>
				<td></td>
				<td><textarea name="account-description" rows="" cols=""><?php $v = $this->getOption('account-description'); if (isset($v['value'])) echo $v['value'] ?></textarea>
				</td>
				
				<td><input type="checkbox" value="1"
					name="account-description-enable" <?php echo $this->render_checkbox('account-description') ?>/></td>
			</tr>
		</tbody>
	</table>
</div>
	<!-- contact mapping -->
	<hr>
	<div id="contact-accordion-wrapper" >
	<h3><?php echo __('Contact Mapping Setting')?></h3>
	<table id="contact-mapping">
		<thead>
			<tr>
				<th>
	 	<?php echo __('Label')?>
	 	</th>

				<th>
	 	<?php echo __('Woocommerce Side')?>
	 	</th>

				<th>
	 	<?php echo __('ZohoCRM Side')?>
	 	</th>
				<th>
	 	<?php echo __('Enable')?>
	 	</th>
			</tr>
		</thead>

		<tbody>
			<tr>
				<td><?php echo __('Title')?></td>
				<td></td>
				<td><input name="contact-title" value="<?php $v = $this->getOption('contact-title'); if (isset($v['value'])) echo $v['value'] ?>"/></td>
				<td><input type="checkbox" value="1" name="contact-title-enable" <?php echo $this->render_checkbox('contact-title') ?>/></td>
			</tr>
			<tr>
			<td><?php echo __('Description')?></td>
				<td></td>
				<td><input name="contact-description" value="<?php $v = $this->getOption('contact-description'); if (isset($v['value'])) echo $v['value'] ?>"/></td>
				<td><input type="checkbox" value="1" name="contact-description-enable" <?php echo $this->render_checkbox('contact-description') ?>/></td>
			</tr>
		</tbody>
	</table>
	</div>
	<input type="submit" name="submit" value="Submit" />
</form>


<script type="text/javascript">
jQuery(document).ready(function(){
	jQuery('#lead-accordion-wrapper').accordion({ collapsible: true });
	jQuery('#account-accordion-wrapper').accordion({ collapsible: true });
	jQuery('#contact-accordion-wrapper').accordion({ collapsible: true });
	//account-accordion-wrapper
		} ) ;
</script>
<?php 
		}
	}
	

}

return new HN_Zoho_Fields_Mapping();

