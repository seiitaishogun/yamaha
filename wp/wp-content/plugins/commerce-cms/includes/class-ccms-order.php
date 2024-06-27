<?php
/**
*  
*
*/
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
} 

 global $wpdb;

 date_default_timezone_set("Asia/Ho_Chi_Minh");

class CCMS_ORDER {

    public $current_user; 
	public $current_customer;
	public $order_id; 
	public $table = '';
	public $tableDetails = '';

	public function __construct()
    {
		global $wpdb;
		$cus = new CCMS_CUSTOMER(); 
        $this->current_user = $cus->get_current_user(); 
		$this->current_customer = $cus->get_current_customer(); 
		$this->table = $wpdb->prefix.'orders';
		$this->tableDetails = $wpdb->prefix.'order_details';
    }

    public function update_order_temp($order_id=0, $value='0'){
    	global $wpdb;
    	if($order_id>0){
    		$wpdb->update($this->table, $data=array('order_temp' => $value), $where=array('ID' => $order_id));
    	} 
    }

    public function update_single_order($data_order, $dealer = 0){
		global $wpdb, $current_user_profile, $current_user;
		
 
		$update  = false; 
		$success = -1;
		if(!$data_order) return 0;

		// Kiem Tra TON TAI
		$data_order['order_code'] = 'do_'.$dealer;

		if(intval($data_order['parent_id']) > 0){
			$fds = array(
					['NAME'=>'order_code', 	'VALUE' => $data_order['order_code']],  
					['NAME'=>'order_temp', 	'VALUE' => '1'],  
					['NAME'=>'customer_id', 'VALUE' => $data_order['customer_id']],
					['NAME'=>'parent_id', 	'VALUE' => $data_order['parent_id']]
				);
			$data_order['ID'] = $this->get_order_temp_by_FIELDS($fds);
			 
		}else{
			$data_order['ID'] = $this->get_order_temp_by_customerID($data_order['customer_id']);
		} 
		// end Kiem Tra TON TAI

		if ( ! empty( $data_order['ID'] ) ) {
			if($data_order['ID'] > 0){
				$update = true;
				$order_id = $data_order['ID'];
			}
		} 
		$insertID=$data_order['ID'];
		

		if($update  == false){ //insert data 
			$data_order['date_created'] = date("Y-m-d H:i:s");
			$success = $wpdb->insert($this->table, $data_order); 
			$insertID= $wpdb->insert_id;
		}else{ //update data 
			$data_order['date_updated'] = date("Y-m-d H:i:s");
			$success = $wpdb->update($this->table, $data_order, $where=array('ID' => $data_order['ID']));
		}
		return $insertID;
	}
	 
	 public function update_single_order_details($data_Item){
		global $wpdb, $current_user_profile, $current_user ;
		$order_details = $this->tableDetails;
		$table_orders = $this->table; 
		date_default_timezone_set("Asia/Ho_Chi_Minh");

		$order_id = $data_Item['order_id']; 
		$success = -1;

		$str_des = sanitize_text_field($data_Item['dealer_name'].'@'.$data_Item['dealer_address']) ;
		 
		 if(is_array($data_Item['promotion'])){
		 	$promotion = json_encode($data_Item['promotion']);
		 }else $promotion = $data_Item['promotion'];
		
		 
		$dataItem = array(
				'ID' 			=> intval($data_Item['ID']),
			  	'order_id'  	=> $order_id,			  	
				'dealer_id' 	=> $data_Item['dealer_id'],
				'dealer_name' 	=> sanitize_text_field($data_Item['dealer_name']),
				'dealer_address' => sanitize_text_field($data_Item['dealer_address']),
				'item_id' 		=> sanitize_text_field($data_Item['item_id']), //Item của Product
				'sku' 			=> sanitize_text_field($data_Item['item_id']), //Item của Product
			  	'quantity' 		=> intval($data_Item['quantity']),			  
			  	'deposit' 		=> floatval(str_replace(".", "", $data_Item['deposit'])),			  
			  	'price' 		=> floatval(str_replace(".", "", $data_Item['price'])),
			  	'price_old' 	=> floatval(str_replace(".", "", $data_Item['price_old'])),
			  	'sale_off' 		=> floatval(str_replace(".", "", $data_Item['sale_off'])),
			  	'sub_total' 	=> floatval($data_Item['sub_total']),
			  	'promotion' 	=> $promotion,
			  	
				'description'	=> $str_des ,
			  	'sf_order_id'  	=> $data_Item['sf_order_id'], 
				'product_type' 	=> sanitize_text_field($data_Item['product_type']),
			  	'product_code' 	=> sanitize_text_field($data_Item['product_code']),
			  	'product_name' 	=> sanitize_text_field($data_Item['the_title']),
			  	'product_url' 	=> sanitize_text_field($data_Item['product_url']),
			  	'sf_status' 	=> 1,
			  	'sf_size' 		=> sanitize_text_field($data_Item['size_code']),
			  	'sf_color' 		=> sanitize_text_field($data_Item['color_code']),			  	
			  	'size' 			=> sanitize_text_field($data_Item['size']),
			  	'color' 		=> sanitize_text_field($data_Item['color']),
			  	'image' 		=> sanitize_text_field($data_Item['image']),
				'post_ID' 		=> $data_Item['item_id'], //Item của Product
				'date_updated' 	=> date("Y-m-d H:i:s"), 
			); 

			// Kiem Tra TON TAI
			$fds = array(
					['NAME'=>'order_id', 	'VALUE' => $dataItem['order_id']], 
					['NAME'=>'dealer_id', 	'VALUE' => $dataItem['dealer_id']], 
					['NAME'=>'item_id', 	'VALUE' => $dataItem['item_id']],
					['NAME'=>'product_type','VALUE' => $dataItem['product_type']]
			);

			if(strtolower($dataItem['product_type']) == 'item' || strtolower($dataItem['product_type']) == 'apparel'){
				$dataItem['product_type'] = 'PCA';
				$fds = array(
					['NAME'=>'order_id', 	'VALUE' => $dataItem['order_id']], 
					['NAME'=>'dealer_id', 	'VALUE' => $dataItem['dealer_id']], 
					['NAME'=>'item_id', 	'VALUE' => $dataItem['item_id']],
					['NAME'=>'product_type','VALUE' => $dataItem['product_type']],
					['NAME'=>'color',		'VALUE' => $dataItem['color']],
					['NAME'=>'size',		'VALUE' => $dataItem['size']],
				);
			}
			if(strtolower($dataItem['product_type']) == 'product' || strtolower($dataItem['product_type']) == 'bike'){
				$dataItem['product_type'] = 'Bike';
				$fds = array(
					['NAME'=>'order_id', 	'VALUE' => $dataItem['order_id']], 
					['NAME'=>'dealer_id', 	'VALUE' => $dataItem['dealer_id']], 
					['NAME'=>'item_id', 	'VALUE' => $dataItem['item_id']],
					['NAME'=>'product_type','VALUE' => $dataItem['product_type']],
					['NAME'=>'color',		'VALUE' => $dataItem['color']], 
				);
			}

			$sub_total = ($dataItem['price'] * $dataItem['quantity']) - $dataItem['sale_off'];
			 
			if(intval($dataItem['deposit']>0)){
				$sub_total = ($dataItem['deposit'] * $dataItem['quantity'] ) - $dataItem['sale_off'];
			} 
			$dataItem['sub_total'] = $sub_total;
 

			$data = $this->get_order_details_by_FIELDS($fds);
			if($data){
				$dataItem['ID'] = $data->ID;
			}else{
				$dataItem['ID'] = 0;
			}
			// end Kiem Tra TON TAI
			 
			$insertID = $dataItem['ID'];
			 
			if($insertID == 0){ //insert data 
				$dataItem['date_created'] = date("Y-m-d H:i:s");
				$success  = $wpdb->insert($order_details, $dataItem); 
				$insertID = $wpdb->insert_id;
			}else{ //update data 
				$dataItem['date_updated'] = date("Y-m-d H:i:s");
				$success = $wpdb->update($order_details, $dataItem, $where=array('ID' => $dataItem['ID']));
			}  
		
		return $insertID;
	}  

	public function get_order_temp_by_customerID($customerid, $parent_id = 0 ){
		global $wpdb; $thistable  = $this->table;

		if($customerid == 0) return 0;

		$SQL = "SELECT ID AS order_id FROM $thistable WHERE 1=1 
		AND `order_temp` = '1' AND `customer_id` = '{$customerid}' AND `parent_id` = '{$parent_id}' LIMIT 1;  ";

		return intval($wpdb->get_var($SQL));
	}

	public function get_order_temp_by_FIELDS($FIELDS = array(['NAME'=>'', 'VALUE'=>false])){
		global $wpdb; 
		$table = $this->table;
		 
		$condition = "";
		foreach($FIELDS as $field){
			$condition .= " AND " . $field['NAME'] . " = '" . $field['VALUE'] . "' ";
		}
		
		if($condition === "") return null; 
		
		$SQL = "SELECT ID AS order_id FROM $table WHERE 1=1 " . $condition . " LIMIT 1;" ;
		//print_r($SQL); die();
		
		$order_id = $wpdb->get_var($SQL); 
		
		return intval($order_id);
	} 
	
	public function get_order_ID_by_FIELDS($FIELDS = array(['NAME'=>'', 'VALUE'=>false])){
		global $wpdb; 
		$table = $this->table;
		 
		$condition = "";
		foreach($FIELDS as $field){
			$condition .= " AND " . $field['NAME'] . " = '" . $field['VALUE'] . "' ";
		}
		
		if($condition === "") return null; 
		
		$SQL = "SELECT ID AS order_id FROM $table WHERE 1=1 " . $condition . " LIMIT 1;" ;
		//print_r($SQL); die();
		
		$order_id = $wpdb->get_var($SQL); 
		
		return intval($order_id);
	} 

	public  function get_order_temp_by_ItemID($customerid, $parent_id, $dealer_items = array() ){
		global $wpdb; $thistable  = $this->table; $order_details = $this->tableDetails;

		if($customerid == 0) return 0;

		$itemID = array();
		$dealerID = array();

		foreach($dealer_items as $dealer_item){
			$itemID[] = $dealer_item['item_id'];
			$dealerID[] = $dealer_item['dealer_id'];
		}

		$SQL = "SELECT o.ID AS order_id FROM $thistable as o 
			INNER JOIN $order_details as d ON(o.ID = d.order_id)
			WHERE 1=1 AND o.`order_temp` = '1' AND o.`customer_id` = '{$customerid}' 
			AND o.`parent_id` = '$parent_id' AND d.item_id IN (". implode($itemID, ', ') . ") 
				AND d.item_id IN (". implode($itemID, ", ") . ") LIMIT 1; ";

		//echo ($SQL);

		return intval($wpdb->get_var($SQL));
	}

	public function get_order_details_by_FIELDS($FIELDS = array(['NAME'=>'', 'VALUE'=>false])){
		global $wpdb; 
		$table = $this->tableDetails;
		 
		$condition = "";
		foreach($FIELDS as $field){
			$condition .= " AND " . $field['NAME'] . " = '" . $field['VALUE'] . "' ";
		}
		
		if($condition === "") return null; 
		
		$SQL = "SELECT * FROM $table WHERE 1=1 " . $condition . " LIMIT 1;" ;
		//print_r($SQL); die();
		
		$data = $wpdb->get_row($SQL); 
		
		return $data;
	}

	public function get_order_details_by_ORDER_ID($order_id = 0){
		global $wpdb; 
		$table = $this->tableDetails;
		 
		 
		if(intval($order_id) === 0 || $order_id === '') return null; 
		
		$SQL = "SELECT * FROM $table WHERE 1=1 AND `order_id` = '" . $order_id . "' ;" ;
		//print_r($SQL); die();
		
		$data = $wpdb->get_results($SQL); 
		
		return $data;
	}

	public function get_orders_temp_by_parent_ID($customerid, $parent_id = 0 ){
		global $wpdb; $thistable  = $this->table;

		if($parent_id == 0 || $customerid == 0) return 0;

		$SQL = "SELECT ID AS order_id FROM $thistable WHERE 1=1 
		AND `order_temp` = '1' AND `customer_id` = '{$customerid}' AND `parent_id` = '{$parent_id}' ;  ";

		return  $wpdb->get_var($SQL);
	}
 
	public function update_order_total($order_id=0, $order_total = 0, $paid = 0){
		global $wpdb ;

		if($order_id == 0){
			return (0);
		}

		if($order_total == 0){
			$SQL = "SELECT SUM(sub_total) as totals FROM {$this->tableDetails} WHERE 1=1 
				AND `order_id` = '{$order_id}' ; ";

			$order_total = $wpdb->get_var($SQL);
		}

		$success = $wpdb->update($this->table, array('order_total' => $order_total, 'paid' => $paid), $where=array('ID' => $order_id));

		return($success);
	}

	public function update_order_DATA($order_id=0, $dataUpdate=[]){
		global $wpdb ;

		if($order_id == 0 || count($dataUpdate) == 0){
			return (0);
		} 

		$success = $wpdb->update($this->table, $dataUpdate, $where=array('ID' => $order_id));

		return($success);
	}

	public function update_SF_order_ID($order_id=0, $dataUpdate=[]){
		global $wpdb ;

		if($order_id == 0 || count($dataUpdate) == 0){
			return (0);
		} 

		$success = $wpdb->update($this->table, $dataUpdate, $where=array('ID' => $order_id));

		return($success);
	}

	public function update_order_details_SF_by_order_ID($order_id=0, $dataUpdate=[]){
		global $wpdb ;

		if($order_id == 0 || count($dataUpdate) == 0){
			return (0);
		} 

		$success = $wpdb->update($this->tableDetails, $dataUpdate, $where=array('order_id' => $order_id));

		return($success);
	}

	
	public function update_order_status($order_id=0, $status=1){
		global $wpdb ;
		if($order_id==0){return(0);}
		$output = 0;
		$query = "UPDATE `". $this->table ."` SET order_status = {$status} WHERE order_id = '" . $order_id . "' ;";
		$wpdb->exc( $query, $output  );
		return($output);
	}

	public function delete_order($delete_ID = 0){
		global $wpdb ;
		if($delete_ID==0) return 0;
		
		$wpdb->delete($this->table, $where=array('ID' => $delete_ID));
		return $delete_ID;
	}

	public function get_customer_orders($customer_id = 0){
		global $wpdb ;
		$output = array();

		$query = "SELECT * FROM `". $this->table ."` WHERE customer_id = '" . $customer_id . "' ;";

		$output = $wpdb->get_results( $query );

		return $output; 
	}
	
	public function get_order_by_ID($order_id = 0){
		global $wpdb ;
		 
		$query = "SELECT * FROM `". $this->table ."` WHERE ID = '" . $order_id . "' ;";

		$output = $wpdb->get_row( $query );

		return $output;

	}

	public function get_order_by_parent_ID($parent_id = 0, $include_parent = false){
		global $wpdb ;
		
		if($include_parent == false)
			$query = "SELECT * FROM `". $this->table ."` WHERE 1=1 AND parent_id = '" . $parent_id . "' ;";
		else
			$query = "SELECT * FROM `". $this->table ."` WHERE 1=1 AND parent_id = '" . $parent_id . "' OR ID = '" . $parent_id . "' ;";

		$output = $wpdb->get_results( $query);

		return $output;

	} 

	public function get_list_order(){
		global $wpdb ;
		 
		$output = array();

		$query = "SELECT * FROM `". $this->table ."` WHERE 1=1;' ;";

		$output = $wpdb->get_results( $query );

		return $output;
	}

    public function get_order_status($order_id=0)
    {	global $wpdb ;
		
		$status = $wpdb->get_var( "SELECT order_status FROM ". $this->table ."` WHERE order_id = '" . $order_id . "' ;"); 
        
		return $status; 
    }

}

$C_ORDER = new CCMS_ORDER();
