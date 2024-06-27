<?php
/** 
 * @package  Orders 
 * @since    1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
global $wpdb ;

class CCMS_ORDER_DETAILS {
 
	public $ID; 
	private $table = '';

	public function __construct(){    
		global $wpdb; 
		$this->table = $wpdb->prefix.'order_details';
    }
	
	public function update_order_details( $data, $update = false){
		
		global $wpdb;
   
		if($update  == false){ //insert data 
			$ID = $wpdb->insert($this->table, $data);
		}else{ //update data 
			$wpdb->update($this->table, $data, $where=array('ID' => $ID));
		}
  		return $ID;	
	}

	public function  delete_order_details($ID = 0){
		global $wpdb, $table_prefix;
		if($ID==0) return 0;
		$wpdb->delete($this->table, $data, $where=array('ID' => $ID));
		return $ID;
	}

	public function get_order_details($ID=0){
		global $wpdb ;
		$output = array();
		
		if($ID==0)
			return ($output);
		
		$query = "SELECT * FROM `". $this->table ."` WHERE ID = '" . $ID . "' ;";

		$output = $wpdb->get_results( $query , $output  );

		return $output;

	}

	public function get_order_details_in_order($order_id=0){
		global $wpdb, $table_prefix;
		
		$output = array();
		if($order_id==0)
			return ($output);

		$query = "SELECT * FROM `". $this->table ."` WHERE order_id = '" . $order_id . "' ;";

		$output = $wpdb->get_results($query , $output);

		return $output;
	}
 
}
