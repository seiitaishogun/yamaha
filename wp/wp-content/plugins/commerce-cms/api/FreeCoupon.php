<?php
/**
*  
*
*/
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
} 
date_default_timezone_set("Asia/Ho_Chi_Minh");

class FREE_COUPON {
	
	public $free_coupon_data = array(); 
	
	public function __construct()
	{ 
		global $wpdb;
		$this->DOMAIN = get_site_url();
		$this->JSON_URL = 'wp-json';
		$this->NAMESPACE = 'freeCupon';
		$this->GET_URL = $this->NAMESPACE.'/getCupon'; 
		$this->UPDATE_URL = $this->NAMESPACE.'/updateCupon/'; 
		$this->CREATE_URL = $this->NAMESPACE.'/createCupon/'; 
		$this->DELETE_URL = $this->NAMESPACE.'/deleteCupon/'; 
		
		
		
		$this->tb_table = $wpdb->prefix.'sf_free_coupon'; 
		
		
		$this->free_coupon_data = array(
			'ID' => 0,
			'free_coupon_id' => 0,
			'free_coupon_name' => '', 
			'mileage' => '',
			'serial_no' => '',
			'warranty_effective_date'  => null,
			'warranty_expired_date' => null,
			'warranty_mileage' => null,
			'warranty_policy_type' => '',
			'service_date' => null,
			'applied' => '',
			'sf_account_id' => '',
			'web_user_id' => '',
			'application_dealer_code' => '',
		) ;  
		
	} 
	public function update_free_coupon($data=[]){
		global $wpdb;
		 
		$id = 0;
		
		if(count($data) == 0) return 0;
		
		$free_cupon_data['ID'] 						= intval($data['ID']);
		$free_cupon_data['free_coupon_id'] 			= sanitize_text_field($data['free_coupon_id']);
		$free_cupon_data['free_coupon_name'] 		= sanitize_text_field($data['free_coupon_name']);
		$free_cupon_data['mileage']	 				= sanitize_text_field($data['mileage']);
		$free_cupon_data['serial_no'] 				= sanitize_text_field($data['serial_no']);
		$free_cupon_data['warranty_effective_date'] = date ('Y-m-d H:i:s', strtotime($data['warranty_effective_date']));
		$free_cupon_data['warranty_expired_date'] 	= date ('Y-m-d H:i:s', strtotime($data['warranty_expired_date']));
		$free_cupon_data['warranty_mileage'] 		= sanitize_text_field($data['warranty_mileage']);
		$free_cupon_data['warranty_policy_type']	= sanitize_text_field($data['warranty_policy_type']);
		$free_cupon_data['service_date'] 			= date ('Y-m-d H:i:s', strtotime($data['service_date']));
		$free_cupon_data['applied'] 				= sanitize_text_field($data['applied']);
		$free_cupon_data['sf_account_id'] 			= sanitize_text_field($data['sf_account_id']);
		$free_cupon_data['web_user_id'] 			= sanitize_text_field($data['web_user_id']);
		$free_cupon_data['application_dealer_code'] = sanitize_text_field($data['application_dealer_code']);
		$free_cupon_data['FrameNo'] 				= sanitize_text_field($data['FrameNo']);
		$free_cupon_data['CouponCategoryLevel'] 	= sanitize_text_field($data['CouponCategoryLevel']);
		
		//current_time( $type='mysql', $gmt = true); date ('Y-m-d H:i:s'", strtotime($date_old));
		
		// KIEM TRA free_coupon TON TAI?
		$free_coupon = $this->get_sf_free_coupon_by_ID($free_cupon_data['free_coupon_id']);	
		
		if( !empty($free_coupon) ){ $free_cupon_data['ID'] = intval($free_coupon->ID ); } 
		
		if($free_cupon_data['ID'] > 0){
			$id = $wpdb->update($this->tb_table, $free_cupon_data, array('ID'=>$free_cupon_data['ID'], 'free_coupon_id'=> $free_cupon_data['free_coupon_id']));
			
			$id = $free_cupon_data['ID'];
		}			
		else{
			$id = $wpdb->insert($this->tb_table, $free_cupon_data);
			$id = $wpdb->insert_id;
		} 
		
		//print_r( $wpdb->last_query);
		
		return $id;
		
	}
	  
	public function get_sf_free_coupon_by_ID($free_coupon_id = ''){
		global $wpdb; 
		$table = $this->tb_table;
		
		if($free_coupon_id == '') return null;
		
		$SQL = "SELECT * FROM {$table} WHERE 1=1 AND `free_coupon_id` = '{$free_coupon_id}' ;" ;
		 
		$data = $wpdb->get_row($SQL);
		
		//print_r( $SQL);
		
		return $data;
	}
	
	public function get_free_coupon_by_ID($id = 0){
		global $wpdb; 
		$table = $this->tb_table;
		
		if($id == 0) return null;
		
		$SQL = "SELECT * FROM {$table} WHERE 1=1 AND `ID` = '{$id}' ;" ;
		 
		$data = $wpdb->get_row($SQL);
		
		return $data;
	}
	
	public function get_free_cupon_by_FIELD($FIELD = '', $value = false){
		global $wpdb; 
		$table = $this->tb_table;
		
		if(!$value && $FIELD == '') return null;
		
		$SQL = "SELECT * FROM {$table} WHERE 1=1 AND `$FIELD` = '{$value}' ;" ;
		$data = $wpdb->get_row($SQL);
		
		return $data;
	} 

	public function get_free_coupons_by_FIELD($FIELD = '', $value = false){
		global $wpdb; 
		$table = $this->tb_table;
		
		if(!$value && $FIELD == '') return null;
		
		$SQL = "SELECT * FROM {$table} WHERE 1=1 AND `$FIELD` = '{$value}' ;" ;
		$data = $wpdb->get_results($SQL);
		
		return $data;
	} 
	
	public function get_all_free_cupon(){
		global $wpdb; 
		$table = $this->tb_table;
		$SQL = "SELECT * FROM {$table} WHERE 1=1 ;" ;
		$data = $wpdb->get_results($SQL);
		
		return $data;
	} 

	public function get_free_cupon_of_customer($user = 0){
		global $wpdb; 
		$table = $this->tb_table;
		if (!is_user_logged_in() || $user == 0)
			return null;
		$SQL = "SELECT * FROM {$table} WHERE 1=1 AND `web_user_id` = '{$user}' ;" ;
		$data = $wpdb->get_results($SQL);
		
		return $data;
	} 
} 

global $FREE_COUPON;
$FREE_COUPON = new FREE_COUPON();