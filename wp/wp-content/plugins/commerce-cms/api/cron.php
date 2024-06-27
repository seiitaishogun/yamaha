<?php
/**
*  
*
*/
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
} 
class Cron {
	public function __construct()
	{
		// include_once(ABSPATH . WPINC . '/rest-api.php');
		// $this->DOMAIN = get_site_url();
	} 
	public function APICheckMcInventory(){
		
		global $wpdb;
		$table_dealers_inventory = $wpdb->prefix.'dealers_inventory';
		$table_postmeta = $wpdb->prefix.'postmeta';
		$table_posts = $wpdb->prefix.'posts';

		$plugin_dir = ABSPATH . 'wp-content/plugins/commerce-cms/';		
		include_once($plugin_dir.'api/sf_api.php');	 		
		$SF_API = new SF_API();

		$data_inventorys = [];
		$data_pos = [];
		$data_pos['modelCodes'] = [];

		// $postmeta = $wpdb->get_results( "SELECT * FROM {$table_postmeta} WHERE meta_key LIKE 'Products CRM_products_code_%'; "); 
		$postmeta = $wpdb->get_results( "SELECT {$table_postmeta}.*,{$table_posts}.post_type FROM {$table_postmeta} LEFT JOIN {$table_posts} ON ({$table_postmeta}.post_id = {$table_posts}.ID) WHERE meta_key = 'product_code' AND {$table_posts}.post_type = 'product'"); 
		if($postmeta){
			foreach ($postmeta as $key => $value) {

				if($value->meta_value){
					$data_pos['modelCodes'][] = $value->meta_value;
					$data_inventorys[$value->meta_value] = $value->post_id;
				}		
			}
		}

		// $data_pos['modelCodes'] = '55P300';

		$res = $SF_API->sendPost('APICheckMcInventory',$data_pos);

		// json_decode($response, true);
		if($res && $res['data']){
			foreach ($res['data'] as $key => $value) {
				foreach ($value['inventorys'] as $key => $value_inventory) {
					// var_dump($value_inventory);die();
					$data_dealers_inventory = [];
					$data_dealers_inventory['dealer_code'] = $value_inventory['dealercode'];
					$data_dealers_inventory['color_code'] = $value_inventory['colorcode'];
					$data_dealers_inventory['inventory'] = $value_inventory['status'];
					$data_dealers_inventory['product_type'] = 'product';
					$data_dealers_inventory['item_id'] = $data_inventorys[$value['modelcode']];
					$data_dealers_inventory['product_code'] = $value['modelcode'];

					$postmeta_dealer = $wpdb->get_row( "SELECT * FROM {$table_postmeta} WHERE meta_key = 'dealer_code' and meta_value ='{$data_dealers_inventory['dealer_code']}'; "); 
					if($postmeta_dealer){
						$data_dealers_inventory['dealer_id'] = $postmeta_dealer->post_id;
					}

					$inventory = $wpdb->get_row( "SELECT * FROM {$table_dealers_inventory} WHERE dealer_code = '{$data_dealers_inventory['dealer_code']}' and color_code = '{$data_dealers_inventory['color_code']}' and product_type = '{$data_dealers_inventory['product_type']}' and item_id = '{$data_dealers_inventory['item_id']}' and product_code = '{$data_dealers_inventory['product_code']}'; ");   
					if($inventory ){
						if($inventory->inventory != $data_dealers_inventory['inventory'] || $inventory->dealer_id != $data_dealers_inventory['dealer_id']){
							$success = $wpdb->update($table_dealers_inventory,  array('inventory' => $data_dealers_inventory['inventory'],'dealer_id' => $data_dealers_inventory['dealer_id']), $where = array('ID'=>$inventory->ID));
						}
						else{
							$success = 1;
						}
						
					}
					else{
						$success = $wpdb->insert($table_dealers_inventory, $data_dealers_inventory);
					}
				}

			}
		}
		// return $res;
	}

	public function APICheckPCAInventory(){
		global $wpdb;
		$table_dealers_inventory = $wpdb->prefix.'dealers_inventory';
		$table_postmeta = $wpdb->prefix.'postmeta';
		$table_posts = $wpdb->prefix.'posts';

		$plugin_dir = ABSPATH . 'wp-content/plugins/commerce-cms/';		
		include_once($plugin_dir.'api/sf_api.php');	 		
		$SF_API = new SF_API();

		$data_inventorys = [];
		$data_pos = [];
		$data_pos['productCodes'] = [];
		// $postmeta = $wpdb->get_row( "SELECT * FROM {$table_postmeta} WHERE meta_key LIKE 'products_crm_Proruct Codes_%'; ");  
		$postmeta = $wpdb->get_results( "SELECT {$table_postmeta}.*,{$table_posts}.post_type FROM {$table_postmeta} LEFT JOIN {$table_posts} ON ({$table_postmeta}.post_id = {$table_posts}.ID) WHERE meta_key = 'product_code' AND {$table_posts}.post_type = 'item'"); 
		
		if($postmeta){
			foreach ($postmeta as $key => $value) {
				if($value->meta_value){
					$data_pos['productCodes'][] = $value['meta_value'];
					$data_inventorys[$value->meta_value] = $value->post_id;
				}
			}
		}
		// $data_pos['productCodes'] = 'BBR-SH390-M2-BL';

		$res = $SF_API->sendPost('APICheckPCAInventory',$data_pos);

		if($res && $res['data']){
			foreach ($res['data'] as $key => $value) {
				foreach ($value['inventorys'] as $key => $value_inventory) {
					// var_dump($value_inventory);die();
					$data_dealers_inventory = [];
					$data_dealers_inventory['dealer_code'] = $value_inventory['dealercode'];
					$data_dealers_inventory['color_code'] = $value_inventory['colorcode'];
					$data_dealers_inventory['inventory'] = $value_inventory['status'];
					$data_dealers_inventory['product_type'] = 'item';
					$data_dealers_inventory['item_id'] = $data_inventorys[$value['modelcode']];
					$data_dealers_inventory['product_code'] = $value['modelcode'];
					$postmeta_dealer = $wpdb->get_row( "SELECT * FROM {$table_postmeta} WHERE meta_key = 'dealer_code' and meta_value ='{$data_dealers_inventory['dealer_code']}'; "); 
					if($postmeta_dealer){
						$data_dealers_inventory['dealer_id'] = $postmeta_dealer->post_id;
					}
					$inventory = $wpdb->get_row( "SELECT * FROM {$table_dealers_inventory} WHERE dealer_code = '{$data_dealers_inventory['dealer_code']}' and color_code = '{$data_dealers_inventory['color_code']}' and product_type = '{$data_dealers_inventory['product_type']}' and item_id = '{$data_dealers_inventory['item_id']}' and product_code = '{$data_dealers_inventory['product_code']}'; ");   
					if($inventory ){
						if($inventory->inventory != $data_dealers_inventory['inventory'] || $inventory->dealer_id != $data_dealers_inventory['dealer_id']){
							$success = $wpdb->update($table_dealers_inventory,  array('inventory' => $data_dealers_inventory['inventory'],'dealer_id' => $data_dealers_inventory['dealer_id']), $where = array('ID'=>$inventory->ID));
						}
						else{
							$success = 1;
						}
						
					}
					else{
						$success = $wpdb->insert($table_dealers_inventory, $data_dealers_inventory);
					}
				}

			}
		}
		return $res;

	}	
}