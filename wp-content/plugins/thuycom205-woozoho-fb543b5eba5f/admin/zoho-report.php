<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! class_exists( 'HN_Zoho_Report' ) ) :
class HN_Zoho_Report  {
	public function output() {
		$this->showGrid();
	}
	public function show_table_body($rows) {
		foreach ( $rows as $row ) {
			?>
	<tr>
		<td> <?php echo $row['id'] ?></td>
		<td> <?php echo $row['woocommerce_id'] ?></td>
		<td> <?php echo $row['zoho_id'] ?></td>
		<td> <?php echo $row['type'] ?></td>
		<td> <?php 
					$phpdate = strtotime( $row['created'] );
					$created = date('d M, Y h:i A', $phpdate);
					
					echo $created;
					 ?></td>
	</tr>
	<?php 
				}
			}
		
	public function get_collection() {
		global $wpdb;
		$mail_queue_table = $wpdb->prefix . 'hn_zoho_crm_report';
		$query = "select * from {$mail_queue_table} ORDER BY id DESC";
		$rows = $wpdb->get_results ( $query, ARRAY_A );
			
		return $rows;
	}
	
	public function showGrid() {
	
	
		//show the list of mail log in the queue
		$rows = $this->get_collection();
		if (empty($rows))  {
			echo __("There is no record");
		} else {
		 ?>
	<table id="report-table">
		<thead>
			<tr>
				<th>
		 	<?php echo __('ID')?>
		 	</th>
	
				<th>
		 	<?php echo __('Woocommerce ID')?>
		 	</th>
	
				<th>
		 	<?php echo __('ZohoCRM ID')?>
		 	</th>
				<th>
		 	<?php echo __('Type')?>
		 	</th>
				<th>
		 	<?php echo __('Created time')?>
		 	</th>
	
			</tr>
		</thead>
		
		<tbody>
		<?php $this->show_table_body($rows);?>
		</tbody>
	</table>
	
	<script type="text/javascript">
	jQuery(document).ready( function () {
	    jQuery('#report-table').DataTable();
	} );
	</script>
	<?php 
		} }
		
}
endif;

return new HN_Zoho_Report();