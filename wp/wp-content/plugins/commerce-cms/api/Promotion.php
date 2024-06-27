<?php
/**
*  
*
*/
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
} 
date_default_timezone_set("Asia/Ho_Chi_Minh");

class PROMOTION {
	
	public $promotion_data = array();
	public $promotion_item_data = array();
	public $promotion_pack_data = array(); 
	public $promotion_product_data = array();
	
	public function __construct()
	{ 
		global $wpdb; 
		
		$this->DOMAIN = get_site_url();
		$this->JSON_URL = 'wp-json';
		$this->NAMESPACE = 'promotion';
		$this->GET_URL = $this->NAMESPACE.'/getPromotion'; 
		$this->UPDATE_URL = $this->NAMESPACE.'/updatePromotion/'; 
		$this->CREATE_URL = $this->NAMESPACE.'/createPromotion/'; 
		$this->DELETE_URL = $this->NAMESPACE.'/deletePromotion/'; 
		
		$this->web_promotions = $wpdb->prefix.'promotions';
		$this->tb_sf_promotions = $wpdb->prefix.'sf_promotions';
		$this->tb_sf_promotion_items = $wpdb->prefix.'sf_promotion_items';
		$this->tb_sf_promotion_pack = $wpdb->prefix.'sf_promotion_pack'; 
		$this->tb_sf_promotion_product = $wpdb->prefix.'sf_promotion_product';
		
		
		
		$this->promotion_data = array(
			'ID' => 0,
			'promotion_id' => '', 
			'promotion_code' => '',
			'promotion_name' => '' 
		) ;
		
		$this->promotion_item_data = array(
			'ID' => 0,
			'sf_record_type' => '', 
			'promotion_type' => '',
			'promotion_id' => '',
			'promotion_item_id' => '',
			'promotion_item_code' => '',
			'promotion_item_name' => '',			
			'valid_from' => null,
			'valid_to' => null,
			'voucher_amount' => 0,
			'discount' => 0,
			'description' => '',
		) ; 
		$this->promotion_pack_data = array(
			'ID' => 0, 
			'promotion_item_id' => '',
			'item_pack_id' => '',
			'promotion_pack_code' => '', 
			'promotion_pack_name' => '' 
		) ;  
		
		$this->promotion_product_data = array(
			'ID' => 0,
			'record_type' => '',
			'promotion_item_id' => '',
			'product_code' => '', 
			'color_code' => '',
			'discount' => '',
			'list_price' => 0,
			'sale_price' => 0 
		) ;
		
	} 
	
	public function update_promotion($data=false){
		global $wpdb;
		date_default_timezone_set("Asia/Ho_Chi_Minh");
		
		$id = 0;
		
		if(!$data) return 0;
		
		$this->promotion_data = array(
			'ID' => 0,
			'promotion_id' => '',
			//'record_type' => '',
			'promotion_code' => '',
			'promotion_name' => '' 
		) ;
		
		$dataU['ID'] 				= intval($data['ID']);
		//$dataU['record_type'] 		= sanitize_text_field($data['record_type']);
		$dataU['promotion_id'] 		= sanitize_text_field($data['promotion_id']);
		$dataU['promotion_code'] 	= sanitize_text_field($data['promotion_code']);
		$dataU['promotion_name'] 	= sanitize_text_field($data['promotion_name']); 
		
		// KIEM TRA PROMOTION TON TAI?
		$promotion = $this->get_promotion_by_FIELD('promotion_id', $dataU['promotion_id']);		
		if($promotion){ $dataU['ID'] = $data['ID'] = $promotion->ID ; }		
		
		if($data['ID'] > 0){
			$id = $wpdb->update($this->tb_sf_promotions, $dataU, array('ID'=>$dataU['ID']));
			$id = $dataU['ID'];
		}			
		else{
			$id = $wpdb->insert($this->tb_sf_promotions, $dataU);
			$id = $wpdb->insert_id;
		} 
		//print_r($wpdb->last_query);
		return $id;
		
	}
	
	public function update_promotion_item($data=false){
		global $wpdb;
		$id = 0;
		
		if(!$data) return 0;
		
		$dataU['ID'] 					= intval($data['ID']);
		$dataU['sf_record_type'] 		= sanitize_text_field($data['sf_record_type']); 
		$dataU['promotion_type'] 			= sanitize_text_field($data['promotion_type']); 
		$dataU['promotion_id'] 			= sanitize_text_field($data['promotion_id']);
		$dataU['promotion_item_id'] 	= sanitize_text_field($data['promotion_item_id']);
		$dataU['promotion_item_code'] 	= sanitize_text_field($data['promotion_item_code']);
		$dataU['promotion_item_name'] 	= sanitize_text_field($data['promotion_item_name']);
		$dataU['valid_from'] 			= date ('Y-m-d H:i:s', strtotime($data['valid_from']));
		$dataU['valid_to'] 				= date ('Y-m-d H:i:s', strtotime($data['valid_to']));
		$dataU['voucher_amount'] 		= floatval($data['voucher_amount']);
		$dataU['discount'] 				= floatval($data['discount']);
		$dataU['description'] 			= sanitize_text_field($data['description']); 
		$dataU['published'] 			= sanitize_text_field($data['published']); 
		
		// KIEM TRA PROMOTION ITEM TON TAI?
		$promotion_item = $this->get_promotion_item_by_FIELD('promotion_item_id', $dataU['promotion_item_id']);		
		if($promotion_item){ $dataU['ID'] = $data['ID'] = $promotion_item->ID ; }		
		
		if($dataU['ID'] > 0){
			$id = $wpdb->update($this->tb_sf_promotion_items, $dataU, array('ID'=>$dataU['ID']));
			$id = $dataU['ID'];
		}			
		else{
			$id = $wpdb->insert($this->tb_sf_promotion_items, $dataU);
			$id = $wpdb->insert_id;
		} 
		//print_r($wpdb->last_query);
		return $id;
		
	}
	
	public function update_promotion_pack($data=false){
		global $wpdb;
		$id = 0;
		
		if(!$data) return 0;
		
		$dataU['ID'] 					= intval($data['ID']);
		$dataU['promotion_item_id'] 	= sanitize_text_field($data['promotion_item_id']); 
		$dataU['promotion_pack_code'] 	= sanitize_text_field($data['promotion_pack_code']); 
		$dataU['item_pack_id'] 			= sanitize_text_field($data['item_pack_id']);
		$dataU['promotion_pack_name'] 	= sanitize_text_field($data['promotion_pack_name']); 
		
		// KIEM TRA promotion_pack TON TAI?
		//$promotion_pack = $this->get_promotion_pack_by_FIELD('promotion_pack_code', $dataU['promotion_pack_code']);		
		//if($promotion_pack){ $dataU['ID'] = $data['ID'] = $promotion_pack->ID ; }

		// XOA DU LIEU CU
		$wpdb->delete($this->tb_sf_promotion_pack, array( 'promotion_item_id' => $dataU['promotion_item_id'] ) );
		
		if($dataU['ID'] > 0){
			$id = $wpdb->update($this->tb_sf_promotion_pack, $dataU, array('ID'=>$dataU['ID']));
			$id = $dataU['ID'];
		}			
		else{
			$id = $wpdb->insert($this->tb_sf_promotion_pack, $dataU);
			$id = $wpdb->insert_id;
		} 
		//print_r($wpdb->last_query);
		
		return $id;
		
	} 
	
	public function update_promotion_product($data=false){
		global $wpdb;
		$id = 0;
		
		if(!$data) return 0;
		 
		$dataU['ID'] 					= intval($data['ID']);
		$dataU['record_type'] 			= sanitize_text_field($data['record_type']); 
		$dataU['promotion_item_id'] 	= sanitize_text_field($data['promotion_item_id']);		
		$dataU['product_code'] 			= sanitize_text_field($data['product_code']);
		$dataU['color_code'] 			= sanitize_text_field($data['color_code']);
		$dataU['discount'] 				= floatval($data['discount']); 
		$dataU['list_price'] 			= floatval($data['list_price']); 
		$dataU['sale_price'] 			= floatval($data['sale_price']); 
		
		// KIEM TRA promotion_product TON TAI?
		$fds = array(
					['NAME'=>'promotion_item_id', 'VALUE' => $dataU['promotion_item_id']], 
					['NAME'=>'product_code', 'VALUE' => $dataU['product_code']], 
					['NAME'=>'record_type', 'VALUE' =>$dataU['record_type']] 
				);
		if(!empty($dataU['color_code']) || strtolower(($dataU['color_code'])) === 'bike'){
			$fds = array(
					['NAME'=>'promotion_item_id', 'VALUE' => $dataU['promotion_item_id']], 
					['NAME'=>'product_code', 'VALUE' => $dataU['product_code']], 
					['NAME'=>'record_type', 'VALUE' =>$dataU['record_type']],
					['NAME'=>'color_code', 'VALUE' =>$dataU['color_code']]
				);
		}
		//$promotion_product = $this->get_promotion_product_by_FIELDS($fds);	

		// XOA DU LIEU CU
		$wpdb->delete($this->tb_sf_promotion_product, array( 'promotion_item_id' => $dataU['promotion_item_id'] ) );
		
		
		//if($promotion_product){ $data['ID'] = $dataU['ID'] = $promotion_product->ID ; }
		
		// if($dataU['ID'] > 0){
		// 	$id = $wpdb->update($this->tb_sf_promotion_product, $dataU, array('ID'=>$dataU['ID']));
		// 	$id = $dataU['ID'];
		// }			
		// else{
		// 	$id = $wpdb->insert($this->tb_sf_promotion_product, $dataU);
		// 	$id = $wpdb->insert_id;
		// } 
		$id = $wpdb->insert($this->tb_sf_promotion_product, $dataU);
		$id = $wpdb->insert_id;
		
		//print_r($wpdb->last_query);
		return $id; 
	}
	
	public function get_promotion_item_by_ID($id = false){
		global $wpdb; 
		$table = $this->tb_sf_promotion_items;
		
		if(!$id) return null;
		
		$SQL = "SELECT * FROM {$table} WHERE 1=1 AND `ID` = '{$id}' ;" ;
		$data = $wpdb->get_row($SQL);
		
		return $data;
	}
	
	public function get_promotion_by_FIELD($FIELD = '', $value = false){
		global $wpdb; 
		$table = $this->tb_sf_promotions;
		
		if(!$value || $FIELD == '') return null;
		
		$SQL = "SELECT * FROM {$table} WHERE 1=1 AND `$FIELD` = '{$value}' ;" ;
		$data = $wpdb->get_row($SQL);
		
		return $data;
	}
	
	public function get_promotion_item_by_FIELD($FIELD = '', $value = false){
		global $wpdb; 
		$table = $this->tb_sf_promotion_items;
		
		if(!$value || $FIELD == '') return null;
		
		$SQL = "SELECT * FROM {$table} WHERE 1=1 AND `$FIELD` = '{$value}' ;" ;
		$data = $wpdb->get_row($SQL);
		
		return $data;
	}

	public function get_promotion_name_and_promotion_item_by_FIELD($FIELD = '', $value = false){
		global $wpdb; 
		$table = $this->tb_sf_promotion_items;
		
		if(!$value || $FIELD == '') return null;
		
		$SQL = "SELECT p.promotion_name, a.* FROM {$table} AS a 
		INNER JOIN {$this->tb_sf_promotions} AS p ON (a.promotion_id = p.promotion_id)
		 WHERE 1=1 AND a.`{$FIELD}` = '{$value}' ;" ;
		 
		$data = $wpdb->get_row($SQL);
		
		return $data;
	}

	public function get_list_promotion_items_by_FIELD($FIELD = '', $value = false){
		global $wpdb; 
		$table = $this->tb_sf_promotion_items;
		
		if(!$value || $FIELD == '') return null;
		
		$SQL = "SELECT * FROM {$table} WHERE 1=1 AND `$FIELD` = '{$value}' ;" ;
		$data = $wpdb->get_results($SQL);
		
		return $data;
	}
	
	public function get_all_promotion_item(){
		global $wpdb; 
		$table = $this->tb_sf_promotion_items;
		$SQL = "SELECT * FROM {$table} WHERE 1=1 ;" ;
		$data = $wpdb->get_results($SQL);
		
		return $data;
	}
	
	public function get_promotion_pack_by_ID($id = false){
		global $wpdb; 
		$table = $this->tb_sf_promotion_pack;
		
		if(!$id) return null;
		
		$SQL = "SELECT * FROM {$table} WHERE 1=1 AND `ID` = '{$id}' ;" ;
		$data = $wpdb->get_row($SQL);
		
		return $data;
	}
	
	public function get_promotion_pack_by_FIELD($FIELD = '', $value = false){
		global $wpdb; 
		$table = $this->tb_sf_promotion_pack;
		
		if(!$value && $FIELD == '') return null;
		
		$SQL = "SELECT * FROM {$table} WHERE 1=1 AND `$FIELD` = '{$value}' ;" ;
		$data = $wpdb->get_row($SQL);
		
		return $data;
	} 

	public function get_list_promotion_pack_ACTIVE($product_code=''){
		global $wpdb; 
		$table = $this->tb_sf_promotion_pack; 

		if($product_code=='') return false;

		$DateNow = date('Y-m-d H:i:s');

		$data = false;
		 
		$SQL = "SELECT DISTINCT it.promotion_item_name , it.voucher_amount, pro.* FROM {$this->tb_sf_promotion_pack} AS pro
				INNER JOIN {$this->tb_sf_promotion_items} AS it ON (pro.promotion_item_id = it.promotion_item_id)
				INNER JOIN {$this->tb_sf_promotion_product} AS p ON (p.promotion_item_id = it.promotion_item_id)
		 		WHERE 1=1 AND it.sf_record_type LIKE '%Bike' AND p.product_code = '$product_code' 
		 		AND '{$DateNow}' BETWEEN it.valid_from AND it.valid_to ;" ; 
		
		//$SQL = "SELECT * FROM {$table} WHERE 1=1 AND `$FIELD` = '{$value}' ;" ;
		$data = $wpdb->get_results($SQL);
		
		return $data;
	} 
	
	
	public function get_all_promotion_pack(){
		global $wpdb; 
		$table = $this->tb_sf_promotion_pack;
		$SQL = "SELECT * FROM {$table} WHERE 1=1 ;" ;
		$data = $wpdb->get_results($SQL);
		
		return $data;
	}
	
	
	public function get_promotion_product_by_ID($id = false){
		global $wpdb; 
		$table = $this->tb_sf_promotion_product;
		
		if(!$id) return null;
		
		$SQL = "SELECT * FROM {$table} WHERE 1=1 AND `ID` = '{$id}' ;" ;
		$data = $wpdb->get_row($SQL);
		
		return $data;
	}
	
	public function get_promotion_product_by_FIELD($FIELD = '', $value = false){
		global $wpdb; 
		$table = $this->tb_sf_promotion_product;
		
		if(!$value && $FIELD == '') return null;

		$DateNow = date('Y-m-d H:i:s');

		$data = false;
		 
		$SQL = "SELECT it.promotion_item_name , pro.* FROM {$this->tb_sf_promotion_product} AS pro
				INNER JOIN {$this->tb_sf_promotion_items} AS it ON (pro.promotion_item_id = it.promotion_item_id)
		 		WHERE 1=1 AND pro.`$FIELD` = '{$value}' 
		 		AND '{$DateNow}' BETWEEN it.valid_from AND it.valid_to ;" ; 
		
		//$SQL = "SELECT * FROM {$table} WHERE 1=1 AND `$FIELD` = '{$value}' ;" ;
		$data = $wpdb->get_row($SQL);
		
		return $data;
	}

	public function get_list_promotion_product_by_FIELD($FIELD = '', $value = false){ 
		global $wpdb; 
		$table = $this->tb_sf_promotion_product;
		
		if(!$value && $FIELD == '') return null;
		$DateNow = date('Y-m-d H:i:s');

		$data = false;
		 
		$SQL = "SELECT it.promotion_item_name , pro.* FROM {$this->tb_sf_promotion_product} AS pro
				INNER JOIN {$this->tb_sf_promotion_items} AS it ON (pro.promotion_item_id = it.promotion_item_id)
		 		WHERE 1=1 AND pro.`$FIELD` = '{$value}' 
		 		AND '{$DateNow}' BETWEEN it.valid_from AND it.valid_to ;" ; 
		
		//$SQL = "SELECT * FROM {$table} WHERE 1=1 AND `$FIELD` = '{$value}' ;" ;
		
		$data = $wpdb->get_results($SQL);
		
		return $data;
	}

	public function get_one_promotion_product_by_FIELD($FIELD = '', $value = false){ //$FIELD = 'product_code' , $value='BO0C500'
		global $wpdb; 
		$table = $this->tb_sf_promotion_product;
		
		if(!$value && $FIELD == '') return null;
		$DateNow = date('Y-m-d H:i:s');

		$data = false;
		 
		$SQL = "SELECT it.promotion_item_name , pro.* FROM {$this->tb_sf_promotion_product} AS pro
				INNER JOIN {$this->tb_sf_promotion_items} AS it ON (pro.promotion_item_id = it.promotion_item_id)
		 		WHERE 1=1 AND pro.`$FIELD` = '{$value}' 
		 		AND '{$DateNow}' BETWEEN it.valid_from AND it.valid_to ;" ; 
		
		//$SQL = "SELECT * FROM {$table} WHERE 1=1 AND `$FIELD` = '{$value}' ;" ;
		
		$data = $wpdb->get_row($SQL);
		
		return $data;
	}
	
	public function get_promotion_product_by_FIELDS($FIELDS = array(['NAME'=>'', 'VALUE'=>false])){
		global $wpdb; 
		$table = $this->tb_sf_promotion_product;
		 
		$condition = "";
		foreach($FIELDS as $field){
			$condition .= " AND " . $field['NAME'] . " = '" . $field['VALUE'] . "' ";
		}
		
		if($condition === "") return null; 
		
		$SQL = "SELECT * FROM $table WHERE 1=1 " . $condition . ";" ;
		//print_r($SQL); die();
		
		$data = $wpdb->get_row($SQL);
		
		return $data;
	}

	public function get_promotion_product_DEFAULT(){
		global $wpdb, $current_user, $current_user_profile;  

		date_default_timezone_set('Asia/Ho_Chi_Minh');
 
		$DateNow = date('Y-m-d H:i:s');

		$data = false;
		 
		$SQL = "SELECT it.* FROM  {$this->tb_sf_promotion_items} AS it 
		 		WHERE 1=1 AND it.published = 0 AND it.promotion_type = 'default' 
		 		AND '{$DateNow}' BETWEEN it.valid_from AND it.valid_to ;" ; 
		
		$data = $wpdb->get_results($SQL);
		
		return $data; 
	}

	public function get_list_promotion_product_by_FIELDS($FIELDS = array(['NAME'=>'', 'VALUE'=>false])){
		global $wpdb; 

		$condition = "";
		foreach($FIELDS as $field){
			$condition .= " AND " . $field['NAME'] . " = '" . $field['VALUE'] . "' ";
		}
		
		if($condition === "") return null; 
		
		$SQL = "SELECT it.promotion_item_name , pro.* FROM {$this->tb_sf_promotion_product} AS pro
				INNER JOIN {$this->tb_sf_promotion_items} AS it ON (pro.promotion_item_id = it.promotion_item_id)
		 		WHERE 1=1 AND it.published = 1 " . $condition . ";" ;
		//print_r($SQL); die();
		
		$data = $wpdb->get_results($SQL);
		
		return $data;
	}
	
	public function get_all_promotion_product(){
		global $wpdb; 
		$table = $this->tb_sf_promotion_product;
		$SQL = "SELECT * FROM {$table} WHERE 1=1 ;" ;
		$data = $wpdb->get_results($SQL);
		
		return $data;
	}
} 
global $PROMOTION;
$PROMOTION = new PROMOTION();

function ajax_get_promotion_product(){
		global $wpdb, $PROMOTION;  

		$data = $_POST['data'];

		if(isset($data['color_code']) && $data['color_code'] !== ''){
			$FIELDS = array(
						['NAME'=>'product_code', 	'VALUE'=> $data['product_code']],
						['NAME'=>'color_code', 		'VALUE'=> $data['color_code']]
					); 
		}else{
			$FIELDS = array(
						['NAME'=>'product_code', 	'VALUE'=> $data['product_code']] 
					); 
		}		
		
		$result = $PROMOTION->get_list_promotion_product_by_FIELDS($FIELDS);
		//echo $wpdb->last_query;
		wp_send_json_success($result);
		die();
	}
add_action('wp_ajax_ajax_get_promotion_product', 'ajax_get_promotion_product'); // wp_ajax_{action}
add_action('wp_ajax_nopriv_ajax_get_promotion_product', 'ajax_get_promotion_product'); // wp_ajax_nopriv_{action}

// GET AJAX_PROMOTION_PRODUCT

function ajax_get_promotion_products(){	
	global $PROMOTION, $wpdb;

	$dataRequest = $_POST['dataRequest'] ;
	$value = $dataRequest['promotion_item_id'];

	$promotion_item = $PROMOTION->get_promotion_name_and_promotion_item_by_FIELD('promotion_item_id', $value);

	$promotion_products = $PROMOTION->get_list_promotion_product_by_FIELD('promotion_item_id', $value);
 	 
	wp_send_json_success(['promotion_item'=>$promotion_item, 'promotion_product'=>$promotion_products]) ;
	die();
}

add_action('wp_ajax_ajax_get_promotion_products', 'ajax_get_promotion_products'); // wp_ajax_{action}
add_action('wp_ajax_nopriv_ajax_get_promotion_products', 'ajax_get_promotion_products'); // wp_ajax_nopriv_{action}

function ajax_get_promotion_DEFAULT(){
		global $wpdb, $PROMOTION;   

		$result = $PROMOTION->get_promotion_DEFAULT();
		//echo $wpdb->last_query;
		wp_send_json_success($result);
		
		die();
	}
add_action('wp_ajax_ajax_get_promotion_DEFAULT', 'ajax_get_promotion_DEFAULT'); // wp_ajax_{action}
add_action('wp_ajax_nopriv_ajax_get_promotion_DEFAULT', 'ajax_get_promotion_DEFAULT'); // wp_ajax_nopriv_{action}
