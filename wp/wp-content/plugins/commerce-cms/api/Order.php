<?php 
 
class ORDER extends CCMS_ORDER 
{
	 
	private $order = array(); 

	public function __construct()
	{
		date_default_timezone_set("Asia/Ho_Chi_Minh");
	} 
	
	public function setDataOrderForUpdate($data=[]){
		date_default_timezone_set("Asia/Ho_Chi_Minh");
		$DataOrder = array(
			'ID' 					=> intval($data['ID']),
			'order_code' 			=> sanitize_text_field($data['sf_order_id']), 
			'order_temp' 			=> '0', 
			'customer_id' 			=> intval($data['customer_id']), 
			'order_description'		=> sanitize_text_field($data['full_name'] . ' đặt hàng.') ,
			'order_status' 			=> intval($data['invoice_require']),
			'order_total' 			=> floatval($data['order_status']),
			'payments' 				=> sanitize_text_field($data['payments']),
			'rec_address' 			=> sanitize_text_field($data['receiver_address']),
			'province_id' 			=> $data['province_id'],
			'district_id' 			=> $data['district_id'],
			'ward_id' 				=> $data['ward_id'],
			'invoice_require' 		=> intval($data['invoice_require']),
			'tax_number' 			=> sanitize_text_field($data['tax_number']),
			'company_info' 			=> sanitize_text_field($data['company_info']),
			'company_address' 		=> sanitize_text_field($data['company_address']),
			'rec_invoice_address'	=> sanitize_text_field($data['company_address']), 
			'date_created' 			=> date("Y-m-d H:i:s"),
			'date_updated' 			=> date("Y-m-d H:i:s"),
			'promotion'				=> sanitize_text_field($data['promotion']),
			'voucher' 				=> sanitize_text_field($data['voucher']),			 
			'discount' 				=> floatval($data['discount']),			 
			'shipping_fee' 			=> floatval($data['shipping_fee']),			 
			'order_handler' 		=> sanitize_text_field($data['order_handler']),
			'sf_order_id' 			=> sanitize_text_field($data['sf_order_id']),
			'sf_account_id' 		=> sanitize_text_field($data['sf_account_id']),
			//'booktype' 				=> sanitize_text_field($data['product_type']),
			'contact_name' 			=> sanitize_text_field($data['contact_name']),
			'contact_phone' 		=> sanitize_text_field($data['phone']),
			'parent_id' 			=> intval($data['parent_id']),
		);
		
		return($DataOrder);
	}
	
	public function get_order_id_by_ID($id = false){
		global $wpdb; 
		$table = $this->table;
		
		if(!$id) return 0;
		
		$SQL = "SELECT * FROM {$table} WHERE 1=1 AND `ID` = '{$id}' ;" ;
		$data = $wpdb->get_row($SQL);
		
		return $data;
	}
 
	/**
	* Get  Orders by User ID 
	* @return array (flat)
	*/
	public function getOrdersByUser($user_id = null )
	{
		$Orders = false;
		if ( is_user_logged_in() && !$user_id ) $user_id = get_current_user_id();
		if ( $user_id ) {
			$Orders = $this->get_customer_orders($customer_id );
		}  
		return $Orders;
	}
	
	public function getOrdersByCustomer($customer_id = null )
	{
		$Orders = false;
		if ( is_user_logged_in() && !$customer_id ) $user_id = get_current_user_id();
		
		if ( $user_id ) {
			$current_customer = get_current_customer();
			$Orders = $this->get_customer_orders($current_customer->ID );
		}  
		return $Orders;
	}
	
	public function getOrder($order_id = null, &$order = array() )
	{
		if ( !$order_id ) return($order);
		 
		$this->order = $order = $this->get_customer_order($order_id ); 
		  
		return($order);
	}
 
}