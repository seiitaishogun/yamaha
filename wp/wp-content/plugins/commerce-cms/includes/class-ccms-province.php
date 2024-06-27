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

class CCMS_PROVINCE {
 
	private $tb_province = '';
	private $tb_districts = '';
	private $tb_wards = ''; 

	public function __construct()
    {
		global $wpdb; 
        
		$this->tb_province = $wpdb->prefix.'province';
		$this->tb_districts = $wpdb->prefix.'districts';
		$this->tb_wards = $wpdb->prefix.'wards';
    } 
 

	public function get_single_province_by_FIELD($FIELD = 'id', $VALUE = ''){
		global $wpdb; 
		$table = $this->tb_province; 

		if($VALUE === '') return null; 
		
		$SQL = "SELECT * FROM $table WHERE 1=1 AND `{$FIELD}` = '{$VALUE}' LIMIT 1;" ;
				
		$data = $wpdb->get_row($SQL);
		//echo $SQL; die();
		
		return $data;
	}

	public function get_single_district_by_FIELD($FIELD = 'id', $VALUE = ''){
		global $wpdb; 
		$table = $this->tb_districts; 

		if($VALUE === '') return null; 
		
		$SQL = "SELECT * FROM $table WHERE 1=1 AND `{$FIELD}` = '{$VALUE}' LIMIT 1;" ;
				
		$data = $wpdb->get_row($SQL); //echo $SQL; die();
		
		return $data;
	}

	public function get_districts_by_FIELD($FIELD = 'id', $VALUE = ''){
		global $wpdb; 
		$table = $this->tb_districts; 

		if($VALUE === '') return null; 
		
		$SQL = "SELECT * FROM $table WHERE 1=1 AND `{$FIELD}` = '{$VALUE}' LIMIT 1;" ;
				
		$data = $wpdb->get_results($SQL);  
		
		return $data;
	}

	public function get_single_ward_by_FIELD($FIELD = 'id', $VALUE = ''){
		global $wpdb; 
		$table = $this->tb_wards; 

		if($VALUE === '') return null; 
		
		$SQL = "SELECT * FROM $table WHERE 1=1 AND `{$FIELD}` = '{$VALUE}' LIMIT 1;" ;
				
		$data = $wpdb->get_row($SQL); 
		
		return $data;
	}

 	public function get_wards_by_FIELD($FIELD = 'id', $VALUE = ''){
		global $wpdb; 
		$table = $this->tb_wards; 

		if($VALUE === '') return null; 
		
		$SQL = "SELECT * FROM $table WHERE 1=1 AND `{$FIELD}` = '{$VALUE}' LIMIT 1;" ;
				
		$data = $wpdb->get_results($SQL); 
		
		return $data;
	}

}

global $PROVINCE;
$PROVINCE = new CCMS_PROVINCE();
