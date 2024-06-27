<?php
/**
*  
*
*/
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
} 

global $C_ORDER;
date_default_timezone_set("Asia/Ho_Chi_Minh");

class SF_ORDER { 
	
	public function __construct()
	{ 
		global $wpdb;
	}

	function get_Full_Order_for_SF($order_ids = array(), $promotion_code='' ){
		global $C_ORDER, $wpdb, $PROVINCE;
 
		$OrderDetails = false;

		$OrderFull = ['orders'=>[]];

		$query = [];

		// $dataOrder = {
		// 		"web_order_id" 		=> "6",
		// 	    "customer_id" 		=> "12121",
		// 	    "receive_address" 	=> "Cach mang t8",
		// 	    "recevie_province"  => "Sai gon",
		// 	    "receive_district"  => "Q.3",
		// 	    "receive_ward" 		=> "P11",
		// 	    "invoice_require" 	=> "112121212",
		// 	    "tax_number" 		=> "12121212",
		// 	    "company_info" 		=> "omi1",
		// 	    "company_address" 	=> "NKKN",
		// 	    "dealer_code" 		=> "11111",
		// 	    "payment_method" 	=> "Tra gop",
		// 	    "promotion_code" 	=> "123",
		// 	    "vouchers" 			=> [$voucherCode],
		// 	    "orderProducts" 	=> [
		// 	        {
		// 	            "productcode" 	=> "MT10",
		// 	            "quantity" 		=> 1,
		// 	            "sizecode"  	=> "",
		// 	            "colorcode"		=> "Black" ,
		// 	            "price" 		=> 250000000,
		// 	            "sale_off"		=> 2.5
		// 	        }
		// 	    ]
		// 	};

		if(count($order_ids)>0){
			foreach($order_ids as $order_id){

				$orderProducts=[]; 

				// Get OrderDetails From Database
				$OrderDetails = $C_ORDER->get_order_details_by_ORDER_ID($order_id = $order_id);

				if($OrderDetails){
					 
					$dealer_id = $OrderDetails[0]->dealer_id;
					$dealer_code = get_field('dealer_code', $dealer_id);
					 
					if(empty($dealer_code) || $dealer_code ===''){
						$dealer_code = 'RY01A';
					}					

					$C_ORDER->update_order_DATA($order_id, 
						array(
							'dealer_code'		=> $dealer_code, 
							'dealer_id'			=> $dealer_id, 
							'promotion_code' 	=> $promotion_code,
						) 
					); 	

					$query[] = $wpdb->last_query; 
	 
					foreach($OrderDetails as $order_item ){
						$orderProducts[] = [
							"productcode" 	=> $order_item->product_code,
				            "quantity" 		=> $order_item->quantity,
				            "sizecode"  	=> $order_item->sf_zise,
				            "colorcode"		=> $order_item->sf_color,
				            "price" 		=> $order_item->price,
				            "sale_off"		=> $order_item->sale_off
						];
					}
				}

				// Get Order From Database
				$Order = $C_ORDER->get_order_by_ID($order_id = $order_id); 

				$vouchers = [''];

				if(isset($Order->voucher) && $Order->voucher !== ''){
					$vouchers = json_decode(stripslashes($Order->voucher), true);
				}

				$arr_rec_address = json_decode(stripslashes($Order->rec_address), true);
				$rec_address = '';
				if(count($arr_rec_address) > 0){
					$rec_address = $arr_rec_address['name'] . ' - ' . 
					$arr_rec_address['phone'] . ' - ' . $arr_rec_address['address'];
				}

				$provinceData = $PROVINCE->get_single_province_by_FIELD($FIELD = 'province_id', $VALUE = $Order->province_id);
				$districtData = $PROVINCE->get_single_district_by_FIELD($FIELD = 'district_id', $VALUE = $Order->district_id);
				$wardData = $PROVINCE->get_single_ward_by_FIELD($FIELD = 'ward_id', $VALUE = $Order->ward_id);

				if(!$wardData->sf_code){
					$wardData->sf_code = $wardData->ward_id;
				} 

				$query[] = $wpdb->last_query; 

				$OrderFull['orders'][] = [
					"web_order_id" 		=> $Order->ID,
				    "customer_id" 		=> $Order->customer_id,
				   // "sf_account_id" 	=> $Order->sf_account_id,
				    "receive_address" 	=> $rec_address,
				    "recevie_province"  => $provinceData->sf_code,
				    "receive_district"  => $districtData->sf_code,
				    "receive_ward" 		=> $wardData->ward_name,
				    "invoice_require" 	=> $Order->invoice_require,
				    "tax_number" 		=> $Order->tax_number,
				    "company_info" 		=> $Order->company_info,
				    "company_address" 	=> $Order->company_address,
				    "company_address__c" => $Order->company_address,
				    "dealer_code" 		=> $Order->dealer_code,
				    "payment_method" 	=> $Order->payments,
				    "promotion_code" 	=> $Order->promotion_code,
				    "vouchers" 			=> $vouchers,

				    "orderProducts" 	=> $orderProducts,
				    //"last_query"		=> $query,
				];
				 
			}
		}
		return $OrderFull;
	}

} 

$SF_ORDER = new SF_ORDER();

 
function ajax_get_Full_Order_for_SF(){
	global $SF_ORDER;
 
	$OrderFull = []; 


	$data = $_POST['dataRequest'];

	$order_ids = $data['myorder_ids'];

	$promotion_code = $data['promotion_code'];

	if(count($order_ids)>0){
		 $OrderFull = $SF_ORDER->get_Full_Order_for_SF($order_ids, $promotion_code);
	}
	wp_send_json_success(['ajax_get_Full_Order_for_SF'=>$OrderFull, '$order_ids'=>$order_ids]);
}
add_action('wp_ajax_ajax_get_Full_Order_for_SF', 'ajax_get_Full_Order_for_SF'); // wp_ajax_{action}
add_action('wp_ajax_nopriv_ajax_get_Full_Order_for_SF', 'ajax_get_Full_Order_for_SF'); // wp_ajax_nopriv_{action}

function ajax_update_order_for_SF_ID(){
	global $C_ORDER, $wpdb;  

	$data = $_POST['dataRequest']; 

	$success = 0;
	$SQL = [];
	$dataUpdate =[];

	//if(count($data)>0){
		$web_order_ids = $data['web_order_ids'];
		$sf_order_ids = $data['sf_order_ids'];
		$date_update = date("Y-m-d H:i:s");

		$promotion_code = $data['promotion_code'];
		for( $i = 0; $i < count($sf_order_ids); $i++){
			$order_id = $web_order_ids[$i];
			$sf_order_id = $sf_order_ids[$i]['orderId'];

			$dataUpdate = ['ID' => $order_id, 'sf_order_id' => $sf_order_id, 'date_updated' => $date_update];

			// UPDATE sf_order_id on Order & order_details
			$success = $C_ORDER->update_SF_order_ID($order_id, $dataUpdate );
			$SQL[] = $wpdb->last_query;

			$C_ORDER->update_order_details_SF_by_order_ID($order_id, ['order_id' => $order_id, 'sf_order_id' => $data['sf_order_id'], 'date_updated' => $date_update] );
			$SQL[] = $wpdb->last_query;
		}
		
	//}
	wp_send_json_success(['ajax_update_order_for_SF_ID'=>$dataUpdate,'update_success'=>$data, '$SQL'=>$SQL]);
}
add_action('wp_ajax_ajax_update_order_for_SF_ID', 'ajax_update_order_for_SF_ID'); // wp_ajax_{action}
add_action('wp_ajax_nopriv_ajax_update_order_for_SF_ID', 'ajax_update_order_for_SF_ID'); // wp_ajax_nopriv_{action}

function ajax_update_order_Data(){
	global $C_ORDER, $wpdb;  

	$data = $_POST['dataRequest']; 

	$success = 0; 
	$dataUpdate =[];

	if(count($data)>0){
		$order_id = $data['web_order_id'];
		$date_update = date("Y-m-d H:i:s");

		$promotion_code = $data['promotion_code'];

		$dataUpdate = ['ID' => $order_id, 'sf_order_id' => $data['sf_order_id'], 'promotion_code' => $data['promotion_code'], 'date_updated' => $date_update];

		$success = $C_ORDER->update_SF_order_ID($order_id, $dataUpdate );
		$SQL = $wpdb->last_query;
	}
	wp_send_json_success(['ajax_update_order_Data'=>$dataUpdate,'update_success'=>$success, '$SQL'=>$SQL]);
}
add_action('wp_ajax_ajax_update_order_Data', 'ajax_update_order_Data'); // wp_ajax_{action}
add_action('wp_ajax_nopriv_ajax_update_order_Data', 'ajax_update_order_Data'); // wp_ajax_nopriv_{action}