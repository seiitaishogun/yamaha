<?php
/**  
 * @package  Customer Address
 * @since    1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
global $wpdb, $table_prefix;

class CCMS_CUSTOMER extends WP_User {

    public $cusid;
	public $tb_customer = '';
	public $tb_customer_address = '';
	
	public function __construct()
    {
		global $table_prefix;
        $this->cusid = get_current_user_id();
		$this->tb_customer_address = $table_prefix.'customer_address';
		$this->tb_customer = $table_prefix.'customer';
    }
	
	public function update_customer_address( $postarr, $wp_error = false){
		
		global $wpdb, $table_prefix;

		// Capture original pre-sanitized array for passing into filters.
		$unsanitized_postarr = $postarr;

		$user_id = get_current_user_id();

		$defaults = array(
			'ID' 			=> '',
			'customer_id'	=> '',
			'title'			=> '',
			'full_name' 	=> '',
			'phone'         => '',
			'email'         => '',
			'address'       => '',
			'default'       => '0',
			'province_id'   => '',
			'district_id'   => '',
			'ward_id'       => '', 
			);

		$postarr = wp_parse_args( $postarr, $defaults );

		unset( $postarr['filter'] );

		$postarr = sanitize_post( $postarr, 'db' );
  
		// Are we updating or creating?
		$add_ID = 0;
		$update  = false; 

		if ( ! empty( $postarr['ID'] ) ) {
			$update = true;
			$add_ID = $postarr['ID'];
		}

		// Get customer_id.
		$customer_id = $postarr['customer_id']; 

		if ( is_null( $customer_id ) ) {
			if ( $wp_error ) {
				return new WP_Error('Chưa có dữ liệu khách hàng.');
			}
			return 0;
		}
		 
		// Expected_slashed (everything!).
		$data = compact( 'customer_id', 'title', 'full_name', 'phone', 'email', 'address', 'default', 'province_id', 'district_id', 'ward_id');

		$emoji_fields = array( 'title', 'full_name', 'address' );

		foreach ( $emoji_fields as $emoji_field ) {
			if ( isset( $data[ $emoji_field ] ) ) {
				$charset = $wpdb->get_col_charset( $this->tb_customer_address, $emoji_field );

				if ( 'utf8' === $charset ) {
					$data[ $emoji_field ] = wp_encode_emoji( $data[ $emoji_field ] );
				}
			}
		}

		if($update  == false){ //insert data 
			$add_ID = $wpdb->insert($this->tb_customer_address, $data);
		}else{ //update data 
			$wpdb->update($this->tb_customer_address, $data, $where=array('ID' => $add_ID));
		}
  		return $add_ID;	
	}

	public function get_customer_by_ID($ID = 0){
		global $wpdb;
		if($ID=== 0){
			return false;
		}else{
			$query = "SELECT * FROM `". $this->tb_customer ."` WHERE ID = '" . $ID . "' ;";

			$output = $wpdb->get_row( $query);
			return $output;
		}
	}

	public function get_customer_by_user_ID($user_ID = 0){
		global $wpdb;
		if($user_ID === 0){
			return false;
		}else{
			$query = "SELECT * FROM `". $this->tb_customer ."` WHERE user_id = '" . $user_ID . "' ;";

			$output = $wpdb->get_row( $query);
			return $output;
		}
	}

	public function get_customer_address_by_ID($ID = 0){
		global $wpdb;
		if($ID === 0){
			return false;
		}else{
			$query = "SELECT * FROM `". $this->tb_customer_address ."` WHERE ID = '" . $ID . "' ;";

			$output = $wpdb->get_row( $query);
			return $output;
		}
	}

	public function get_customer_address_by_user_ID($user_ID = 0){
		global $wpdb;
		if($user_ID === 0){
			return false;
		}else{
			$query = "SELECT * FROM `". $this->tb_customer_address ."` WHERE customer_id = '" . $user_ID . "' ;";

			$output = $wpdb->get_results( $query);
			return $output;
		}
	}

	public function  delete_customer_address($add_ID = 0){
		global $wpdb, $table_prefix;
		if($add_ID>0)
			$wpdb->delete($this->tb_customer_address, $data, $where=array('ID' => $add_ID));
		return $add_ID;
	}

	public function get_customer_address($customer_id = 0){
		global $wpdb ;
		$output = array();
		if($customer_id==0)
			return ($output);
		
		$query = "SELECT * FROM `". $this->tb_customer_address ."` WHERE customer_id = '" . $customer_id . "' ;";

		$output = $wpdb->get_results( $query , $output  );

		return $output;

	}

	public function get_list_customer(){
		global $wpdb ;
		$table = $table_prefix.'customer';
		$output = array();

		$query = "SELECT * FROM `". $table ."` WHERE 1=1;' ;";

		$output = $wpdb->get_results( $query , $output  );

		return $output;
	} 

}

global $CMS_CUSTOMER ;
$CMS_CUSTOMER = new CCMS_CUSTOMER();