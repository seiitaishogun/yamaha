<?php
/**
*  
*
*/
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
} 

$plugin_dir = ABSPATH . 'wp-content/plugins/commerce-cms/';		
include_once($plugin_dir.'api/Promotion.php');
include_once($plugin_dir.'api/FreeCoupon.php');

class eccAPI {
	
	// Check Token Response
    private $SITE_ID = 'YHM';
    private $ENCODE_KEY = 'rf8whwaejNhJiQG2bsFubSzccfRc/iRYyGUn6SPmT6y/L7A2XABbu9y4GvCoSTOTpvJykFi6b1G0crU8et2O0Q==';
    private $CANCEL_PASSWORD = 'WfP7i2r/lMbcW6JyL6H6p8jnF7EiTUu3mCf2KDELqieic3JwT99M3TrBqlFjdg5v2oBXED9XcILVSxalBIexhg==';
    private $DOMAIN = 'https://ymh.thuthuat247.com';
    private $ORDER_URL = 'https://ymh.thuthuat247.com/getOrderStatus/';
    private $CRM_API_URL = 'https://ymh.thuthuat247.com/getOrderStatus/';
    private $CANCEL_ORDER_URL = 'https://ymh.thuthuat247.com/orderCancel/';
	private $UPDATE_ORDER_URL = 'https://ymh.thuthuat247.com/orderUpdateStatus/';
	private $CREATE_ORDER_URL = 'https://ymh.thuthuat247.com/orderCreate/';
    private $KEY3DES_ENCRYPT = 'pvJykFi6b1G0crU8et2O0Q==';
    private $KEY3DES_DECRYPT = 'rf8whwaejNhJiQG2bsFubSzc';
	
	public function __construct()
	{
		include_once(ABSPATH . WPINC . '/rest-api.php');
		$this->DOMAIN = get_site_url();
		$this->ORDER_URL = get_site_url().'/order/getOrderStatus/';
		$this->CANCEL_ORDER_URL = get_site_url().'/cancel/orderCancel/'; 
		$this->UPDATE_ORDER_URL = get_site_url().'/cancel/orderUpdate/'; 
		$this->CREATE_ORDER_URL = get_site_url().'/orderCreate/'; 
	} 
	
	public function checkToken($data)
    {
        $timeStamp = $data['timeStamp'];
        $OrderId = $data['OrderId'];
        $userId = $data['userId']; 

        if(array_key_exists("cmsToken", $data)){
            $str =  $data['cmsToken'] ;
        } else {
            $str = $timeStamp . self::SITE_ID . $userId . $OrderId  . self::ENCODE_KEY;
        }
        
        $token = hash('sha256', $str);
        
        $tokenResponse = $data['cmsToken'];

        if ($token != $tokenResponse) {
            return false;
        }

        return true;
    }
	
	private function sendRequest($dataRequest, $url){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataRequest);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 180); 
        curl_setopt($ch, CURLOPT_TIMEOUT, 180);
        try {
            $result = curl_exec($ch);
            $curlErrno = curl_errno($ch);
            $curlError = curl_error($ch);
            if($result === false || $curlErrno > 0 || $curlError){
                return $curlErrno;
            }else{
                return $result;
            }
            curl_close($ch);
        } catch (Exception $e) {
            return $e;
        }
    }
	
}
 

class My_REST_ECC_Controller extends WP_REST_Controller { 
	 
	protected $namespace = 'api-cms';
    protected $tborders = 'orders';
    protected $tborder_details = 'order_details';
    private $base = 'items';
    private $base_type = 'item_types';
    private $resource_name = 'cms';
	protected $server ;
	protected $FULL_URL = ''; 
	protected $PARA_TYPE = 'FORM_DATA';
	 
    // Here initialize our namespace and resource name.
    public function __construct() {
		global $wpdb, $current_user, $current_user_profile; 
		//include_once(ABSPATH . WPINC . '/rest-api.php');
        $this->server     = new WP_REST_Server;
        $this->namespace     = 'api-cms/v1';
        $this->resource_name = 'cms';
        $this->tborders = $wpdb->prefix.'orders';
        $this->tborder_details = $wpdb->prefix.'order_details';
		$this->FULL_URL = get_site_url().'/wp-json/api-cms/v1';
    }
	
	private function sendRequest($dataRequest, $url){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataRequest);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 180); 
        curl_setopt($ch, CURLOPT_TIMEOUT, 180);
        try {
            $result = curl_exec($ch);
            $curlErrno = curl_errno($ch);
            $curlError = curl_error($ch);
            if($result === false || $curlErrno > 0 || $curlError){
                return $curlErrno;
            }else{
                return $result;
            }
            curl_close($ch);
        } catch (Exception $e) {
            return $e;
        }
    }
	
	protected function create_and_get_request($route = '', $json_params = array(), $method = 'POST', $params = array())
	 {
		 $request = new WP_REST_Request($method, $this->namespace. "/{$route}");
		 $request->set_header('content-type', 'application/json');
		 if (isset($json_params)) {
			 $request->set_body(json_encode($json_params));
		 }
		 if (isset($params) && is_array($params)) {
			 foreach ($params as $key => $value) {
				 $request->set_param($key, $value);
			 }
		 }
		 return $this->server->dispatch($request);
	 }
	
	protected function create_and_send_request($route = '', $json_params = array(), $method = 'POST', $params = array())
	 {
		 $request = new WP_REST_Request($method, $this->namespace. "/{$route}");
		 $request->set_header('content-type', 'application/json');
		 if (isset($json_params)) {
			 $request->set_body(json_encode($json_params));
		 }
		 if (isset($params) && is_array($params)) {
			 foreach ($params as $key => $value) {
				 $request->set_param($key, $value);
			 }
		 }
		 return $this->server->dispatch($request);
	 }
 
    // Register our routes.
    public function register_routes() {
     
				
		register_rest_route( $this->namespace, '/updateOrderStatus', array( 
            array(
                'methods'   => WP_REST_Server::EDITABLE,
                'callback'  => array( $this, 'update_order_status' ), 
				'permission_callback' => array( $this, 'get_permissions_check' ), 
			) ));
		
		register_rest_route( $this->namespace, '/updatePromotion', array( 
            array(
                'methods'   => WP_REST_Server::EDITABLE,
                'callback'  => array( $this, 'update_promotions' ), 
				'permission_callback' => array( $this, 'get_permissions_check' ), 
			) ));
		
		register_rest_route( $this->namespace, '/updateFreeCoupon', array( 
            array(
                'methods'   => WP_REST_Server::EDITABLE,
                'callback'  => array( $this, 'update_free_coupon' ), 
				'permission_callback' => array( $this, 'get_permissions_check' ), 
			) ));
		
		register_rest_route( $this->namespace, '/disabledProducts', array( 
            array(
                'methods'   => WP_REST_Server::EDITABLE,
                'callback'  => array( $this, 'update_disabled_products' ), 
				'permission_callback' => array( $this, 'get_permissions_check' ),
				 
			) )); 
		
		register_rest_route( $this->namespace, '/updateLoyalty', array( 
            array(
                'methods'   => WP_REST_Server::EDITABLE,
                'callback'  => array( $this, 'update_update_loyalty' ), 
				'permission_callback' => array( $this, 'get_permissions_check' ), 
			) )); 

		register_rest_route( $this->namespace, '/updatePromotionDefault', array( 
            array(
                'methods'   => WP_REST_Server::EDITABLE,
                'callback'  => array( $this, 'update_Promotion_Default' ), 
				'permission_callback' => array( $this, 'get_permissions_check' ), 
			) ));
		
		register_rest_route( $this->namespace, '/getTest', array( 

            array(
                'methods'   => WP_REST_Server::READABLE,
                'callback'  => array( $this, 'Test' ), 
				'permission_callback' => array( $this, 'get_permissions_check' ),
				//'args' => array('context' => $this->get_context_param(array('default' => 'view')))
			) ));
		
		/* register_rest_route( $this->namespace, '/getOrderInvoice', array( 
            array(
                'methods'   => WP_REST_Server::READABLE,
                'callback'  => array( $this, 'get_order_invoice' ), 
				'permission_callback' => array( $this, 'get_permissions_check' ),
				//'args' => array('context' => $this->get_context_param(array('default' => 'view')))
			) )); */
 
    }

	public function Test(){
		global $wpdb, $C_ORDER;
		$params = array(
			'sf_order_id' => '1456',
			'web_order_id'=>144, 
			'order_status'=>3);
		$plugin_dir = ABSPATH . 'wp-content/plugins/commerce-cms/';		
		include_once($plugin_dir.'api/cron.php');	 			
		$Cron = new Cron();		
		 // $Cron->APICheckMcInventory();	 
		return $Cron->APICheckPCAInventory();

		// $data = new stdClass();
		// $data->ID = 66;
		// $data->user_email = 'son.nguyen@itk.com.vn';
		// $data->user_activation_key = '0bad355f65cb7f508df24bb4386df212';
		// $data = [
		// 	[
		// 		'ID' => 1,
		// 		'rec_address' => '1232456',
		// 		'shipping_fee' => '123',				
		// 	],
		// 	[
		// 		'ID' => 2,
		// 		'rec_address' => '1232456',
		// 		'shipping_fee' => '123',				
		// 	],
		// ];
		// $data = $C_ORDER->get_order_by_parent_ID(1, $include_parent = true );

		// return(send_email_order_to_customer('son.nguyen@itk.com.vn',$data));	

		return($params);

		// $web_id = 1;
		// $data['order_status'] = 10;
		// if ($data['order_status'] == 9) {
		// 	$order = $C_ORDER->get_order_by_ID($web_id);
		// 	send_email_order_delivered($order);
		// }
		// if ($data['order_status'] == 10) {
		// 	$order = $C_ORDER->get_order_by_ID($web_id);
		// 	send_email_refund_successfull($order);
		// }	
	}

	public function get_order_Status_Params(){
		
		$params = array(
			'sf_order_id' => '145',
			'web_order_id'=>144, 
			'order_status'=>3);
			 
		return($params);
		
	}
	
	public function get_loyalty_Params(){
		
		$params = array(
			'web_user_id' => '145', 
			'first_bike'=>true,
		);
			 
		return($params);
		
	}
	
	public function get_Product_Params(){
		
		$params = array(
			'record_type' => 'PCA', 
			'product_code'=>'6554',	
			'disabled'=>true,
		);
			 
		return($params);
		
	}
	
   function get_all_type_parameters( WP_REST_Request $request ) {
	  $parameters = [];
	   
	  // The individual sets of parameters are also available, if needed:
	  if(count($parameters) == 0 || empty($parameters)){
		  $parameters = $request->get_url_params();
		  $this->PARA_TYPE = 'URL';
		  if(count($parameters)> 0){
		   	$parameters =  [$parameters] ;
		   }
	   }
	  if(count($parameters) == 0 || empty($parameters)){
		   $parameters = $request->get_query_params();
		  $this->PARA_TYPE = 'QUERY';
		   if(count($parameters)> 0){
		   		$parameters =  [$parameters] ;
		   }
	   }
	   if(count($parameters) == 0 || empty($parameters)){
		   $parameters = $request->get_body_params();
		   $this->PARA_TYPE = 'FORM_DATA';
		   if(count($parameters)> 0){
		   	$parameters =  [$parameters] ;
		   }
		  // print_r($parameters ); 
	   }
	  if(count($parameters) == 0 || empty($parameters)){
		  $this->PARA_TYPE = 'JSON';
		  $parameters = $request->get_json_params();
		  
	   }
	  if(count($parameters) == 0 || empty($parameters)){
		  $this->PARA_TYPE = 'DEFAULT';
		  $parameters = $request->get_default_params();
		  if(count($parameters)> 0){
		   	$parameters =  [$parameters] ;
		   } 
	   }

	  // Uploads aren't merged in, but can be accessed separately:
	   if(count($parameters) == 0 || empty($parameters)){
		  $this->PARA_TYPE = 'FILE';
		  $parameters = $request->get_file_params();		   
	   } 
	   // You can get the combined, merged set of parameters:
	   if(count($parameters) == 0 || empty($parameters)){
		  $this->PARA_TYPE = 'ALL';
		  $parameters = $request->get_params(); 
		  if(count($parameters)> 0){
		   	$parameters =  [$parameters] ;
		   } 
	   } 
	   
	   return($parameters);	   
	}
	 
	// Update Order status 
    function update_order_status($request ) {

		global $current_user, $SFAPI; 		
				
		$parameters = $this->get_all_type_parameters($request); 
		$resPonseData;
		
		if(is_array($parameters) && count($parameters) > 0){
			foreach($parameters as $item_data){
				$err_msg = $this->Validate_Update_OrderStatus($item_data); 
				if ( count($err_msg) > 0){
					$errmsg[] = $err_msg;
				}
			} 
		}else{
			$errmsg[] = 'Data Order Status is requied.';
		}		
		
		//print_r($updated);
 
        if ( count($errmsg) > 0) {
            $resPonseData =  WP_Error('error', __('Update Order status fail.'), array('status' => 400, 'Data_Response'=>$errmsg));
        }

        $resPonseData = new WP_REST_Response( array('status' => 200, 'data_org'=>$parameters) );
		 
		$SFAPI->write_log_file_api('updateOrderStatus', json_encode($parameters), json_encode($resPonseData));

		return $resPonseData;
		 
    } 
	
	// Validate and Update Order status 
	function Validate_Update_OrderStatus($data){
		global $wpdb, $C_ORDER;
		 
		$errmsg = [];
		/*if(empty($data['web_order_id'])){
			$errmsg[] = 'Web Order ID (web_order_id) is requied.';
		}*/
		if(empty($data['sf_order_id'])){
			$errmsg[] = 'SF Order ID (sf_order_id) is requied.';
		}
		if(empty($data['order_status'])){
			$errmsg[] = 'Order status (order_status) is requied.';
		} 
		
		if($errmsg){
			return $errmsg;
		}
		
		$web_order_id = $data['web_order_id'];
		$sf_order_id = $data['sf_order_id'];
		
		$date_update = array(
			//'ID'=>$web_order_id,
			'sf_order_id'=>$sf_order_id,
			'order_status'=>$data['order_status'],
		); 
		$rs = -1; $web_id = 0;
		if($data){
			
			$web_id = $C_ORDER->get_order_ID_by_FIELDS($FIELDS = array(['NAME'=>'sf_order_id', 'VALUE'=>$sf_order_id]));
			$sql = $wpdb->last_query ; 
			if(intval($web_id) <= 0) {
				$web_id = $C_ORDER->get_order_ID_by_FIELDS($FIELDS = array(['NAME'=>'ID', 'VALUE'=>$web_order_id]));
			}
			$sql .= $wpdb->last_query ; 
			 
			if(intval($web_id) > 0){
				$rs = $wpdb->update($this->tborders, $date_update, array('ID'=>$web_id) );
				$sql .= $wpdb->last_query ;
				// call function send mail: 
					// '9'=>'Giao hàng thành công'
					// '10'=>'Hoàn tiền thành công'
				if ($data['order_status'] == 9) {
					$order = $C_ORDER->get_order_by_ID($web_id);
					send_email_order_delivered($order);
				}
				if ($data['order_status'] == 10) {
					$order = $C_ORDER->get_order_by_ID($web_id);
					send_email_refund_successfull($order);
				}				
				
			}
			else if(intval($web_id) <= 0){
				$errmsg[] = 'Order (sf_order_id/web_order_id) is not found.'   ;
			}
		}
		if($rs == -1){
			$errmsg[] = 'Update Order status fail.';
		}
		
		return $errmsg;
	}
	 
	//update_update_loyalty
	public function update_update_loyalty($request){
		global $wpdb, $current_user, $SFAPI; 
		
		$parameters = $this->get_all_type_parameters($request); 

		if(is_array($parameters) && count($parameters) > 0){
			foreach($parameters as $item_data){			
				$err_msg = $this->Validate_Update_UserLoyalty($item_data);
				
				if ( count($err_msg) > 0){
					$errmsg[] = $err_msg;
				}
			}  
		}else{
			$errmsg[] = 'Loyalty Data is required.';
		}
		
		//print_r($parameters);
 		$resPonseData;
        if ( count($errmsg) > 0 ) {
            $resPonseData = new WP_Error('error', __('Loyalty update fail.'), array('status' => 400, 'Data_Required'=>$errmsg));
        }

        $resPonseData = new WP_REST_Response( array('status' => 200, 'data_org'=>$parameters) );
		 
		$SFAPI->write_log_file_api('updateLoyalty', json_encode($parameters), json_encode($resPonseData));

		return $resPonseData; 
  
	}
	
	//Validate and Update Loyalty
	function Validate_Update_UserLoyalty($data){
		global $wpdb;
		require_once( ABSPATH . WPINC . '/user.php');
		require_once( ABSPATH . WPINC . '/meta.php');
		
		//print_r($wpdb); 
		$errmsg = [];
		if(empty($data['web_user_id'])){
			$errmsg[] = 'Web User ID is requied.';
		}
	/*if(empty($data['sf_account_id'])){
			$errmsg[] = 'SF Account ID is requied.';
		}*/
		if(empty($data['first_bike']) || $data['first_bike'] == ''){
			$errmsg[] = 'The first bike flag is requied.';
		}
		 
		
		if(count($errmsg)>0){ 
			return $errmsg; 
		}
		
		$web_user_id = $data['web_user_id'];
		$sf_account_id = $data['sf_account_id'];
		$first_bike = $data['first_bike'];
		
		//$web_user_id = get_field('sf_account_id');
		 
		$user = get_user_by('ID', $web_user_id);
		
		//print_r($user);
		$rs = -1;
		if($data){
			
			if($user){ $rs = 0;
//				$rs = update_user_meta($web_user_id, 'web_user_id', $web_user_id );
				$rs += update_user_meta($web_user_id, 'sf_account_id', $sf_account_id);
//				$rs += update_user_meta($web_user_id, 'sf_applied', $applied );
				$rs +=  update_user_meta($web_user_id, 'sf_first_bike', $first_bike );

				$wpdb->update( $wpdb->frefix.'customer', 
					array('user_id' => $web_user_id, 'loyalty' => $data['first_bike']), array('user_id' => $web_user_id));
			} else{
				$errmsg[]="User not found.";
			}
		}
		
		if($rs == -1) {
			$errmsg[]="Update Loyalty fail.";
		}
		//print_r ($wpdb->last_query);  		
		//print_r($data);  echo $data['web_user_id']; die();
		
		return $errmsg;
	}
	
	// Disabled Product 
	public function update_disabled_products( $request ) {
		global $wpdb, $current_user, $SFAPI;
		
        $parameters = $this->get_all_type_parameters($request);
		
		//print_r($parameters); //die();
		
		if(is_array($parameters) && count($parameters) > 0){
			foreach($parameters as $item_data){
				$err_msg = $this->Validate_Update_DisabledProduct($item_data);
				if ( count($err_msg) > 0){
					$errmsg[]=$err_msg;
				}
			}  
		}else{
			$errmsg[] = 'Product disabled is requied.';
		} 
		//print_r($parameters);  
 		$resPonseData;
        if ( count($errmsg) > 0 ) {
            $resPonseData = new WP_Error('error', __('Product disabled update fail.'), array('status' => 400, 'Data_Required'=> $errmsg));
        }
		  
		$resPonseData = new WP_REST_Response( array('status' => 200, 'data_org'=>$parameters) );
		 
		$SFAPI->write_log_file_api('updateLoyalty', json_encode($parameters), json_encode($resPonseData));

		return $resPonseData;
    }
	
	function Validate_Update_DisabledProduct($data){
		global $wpdb;
		//require_once( ABSPATH . WPINC . '/user.php');
		require_once( ABSPATH . WPINC . '/meta.php');
		
		//print_r($data); 
		$errmsg = [];
		if(empty($data['record_type'])){
			$errmsg[] = 'Record type (record_type) is requied.';
		}
		if(!isset($data['disabled']) && $data['disabled'] == '' ){
			$errmsg[] = 'Disabled flag (disabled) is requied.';
		}
		if(empty($data['sf_product_code'])){
			$errmsg[] = 'Product code (sf_product_code) is requied.';
		}
		
		$post_type = 'package';
		
		if(($data['record_type'] == 'PCA')){
			$post_type = 'item';
			/*if(empty($data['sf_color_code'])){
				$errmsg[] = 'Color code is requied.';
			}
			if(empty($data['sf_size_code'])){
				$errmsg[] = 'Size code (sf_size_code) is requied.';
			}*/
		}
		
		if(strtolower($data['record_type']) == 'bike'){
			if(empty($data['sf_product_code'])){
				$errmsg[] = 'Model code (sf_product_code) is requied.';
			}
			if(empty($data['sf_color_code'])){
				$errmsg[] = 'Color code (sf_color_code) is requied.';
			}
			$post_type = 'product';
		}
		
		if(count($errmsg) > 0){
			//return new WP_REST_Response(array('status' => 400), $errmsg );
			
			return $errmsg;
		}
		
		
		$record_type = $data['record_type'];
		//$web_product_code = $data['web_product_code'];
		$sf_product_code = $data['sf_product_code'];
		$sf_color_code = $data['sf_color_code'];
		//$size_code = $data['sf_size_code'];
		$disabled = true;
		$disabled = ($data['disabled'] === true || strtolower($data['disabled']) === 'true') ? true : false;
		
		$post_status = 'publish';
		
		if($disabled){
			$post_status = 'draft';
		} 
		
		// Get post_ID from ACF sf_product_code
		$web_post_ID = $this->get_post_by_acf($field_name = 'sf_product_code', $field_value = $sf_product_code, $post_type=$post_type); //

		// Get post_ID from ACF sf_color_code

		
		$post_ID = $this->get_post_by_acf($field_name = 'color_code', $field_value = $color_code, $post_type=$post_type); //

		//get_field('sf_product_code');
		  
		//print_r('$web_product_code:' . $web_product_code); //die();
		$rs = -1;
		if($data){
			
			if($web_post_ID > 0){
				$webcolor_code == '';

				if($post_type == 'product'){
					
					$overview = get_field('overview', $web_post_ID);

					//$group_data = get_field( $group, $post_id );
					if ( is_array( $overview ) && array_key_exists( 'list_colors', $overview ) ) {
						$list_colors = $overview[ 'list_colors' ];

						if ( is_array( $list_colors ) && array_key_exists( 'color_code', $list_colors ) ) {
							$webcolor_code = $list_colors[ 'color_code' ];
						}
					}

					if( $webcolor_code !== $sf_color_code){
						$errmsg[] = 'Product code (sf_color_code): '.$sf_color_code.' not found.';
					}
					else{

					}

				}
				

				//$rs = update_post_meta($web_product_code, 'web_product_code', 	$web_product_code );
				//$rs = update_post_meta($web_post_ID, 'sf_product_code', 	$sf_product_code );		 
				//$rs += update_post_meta($web_post_ID, 'record_type', $record_type );
				//$rs += update_post_meta($web_post_ID, 'sf_color_code', $color_code ); 
				 
				$tbpost = $wpdb->prefix.'posts';
				 	
				// $rs += wp_update_post(array(
				// 		'ID'    =>  $web_product_code,
				// 		'post_status'   =>  $post_status
				// 	));
			} 
			else{
				$errmsg[] = 'Product code (sf_product_code): '.$sf_product_code.' not found.';
			}
		} 
		
		if($rs == -1) {
			$errmsg[]="Update Disabled Product fail.";
		}
		
		return $errmsg;
	}
	
	function get_post_by_acf($field_name, $field_value, $post_type='product'){
		
		global $wpdb;
		
		$posts = get_posts(array(
			'numberposts'		=> 1,
			'post_type'			=> $post_type,
			'post_status'		=> array('publish', 'draft'),
			'meta_query'		=> array(
				'relation'		=> 'AND',
				array(
					'key'	 	=> $field_name,
					'value'	  	=> $field_value,
					'compare' 	=> '=',
				) 
			),
		)); 
		
		if(!$posts ) return 0;
		
		return $posts[0]->ID;
	}
	
	// Update Promotion
	function update_promotions($request){ 
		global $wpdb, $current_user, $SFAPI;   
		
		$data = $this->get_all_type_parameters($request); //$request->get_body_params();

		//print_r($data); die();
		 
		if(is_array($data['promotion_data']) && count($data['promotion_data']) >0 ){
			 
			foreach($data['promotion_data'] as $promotion_data){ 
				// promotion data				 
				$error_msg = $this->Validate_Promotion_And_Update($promotion_data);
				if(count($error_msg) > 0){
					$errormsg['promotion_data_required'][] = $error_msg;
				}
				// promotion item data
//				$promotion_item_data = $promotion_data['promotion_item_data'];
				if(is_array($promotion_data['promotion_item_data']) && count($promotion_data['promotion_item_data']) > 0 ) {
					foreach( $promotion_data['promotion_item_data'] as $promotion_item_data){
						//$promotion_item_data = $promotion_data['promotion_item_data']
						 
						$promotion_item_data['promotion_id'] 		= $promotion_data['promotion_id']; 
						$error_msg = $this->Validate_Promotion_Item_And_Update($promotion_item_data);

						if(count($error_msg) > 0){
								$errormsg['promotion_item_data_required'][] = $error_msg;
							}
						// promotion pack data
						//$promotion_pack_data = $promotion_item_data['promotion_pack_data'][0];
						if(is_array($promotion_item_data['promotion_pack_data']) && count($promotion_item_data['promotion_pack_data']) > 0 ){
							foreach ($promotion_item_data['promotion_pack_data'] as $promotion_pack_data){
								 
								$promotion_pack_data['promotion_item_id'] 	= $promotion_item_data['promotion_item_id'];
								$error_msg = $this->Validate_Promotion_Pack_And_Update($promotion_pack_data);

								if(count($error_msg) > 0){
									$errormsg['promotion_pack_data_required'][] = $error_msg;
								}
							}
						}
						else{ 
							//$errormsg['promotion_pack_data_required'][] = 'promotion_pack_data is required!';
						}
						
						// promotion Product data
						//$promotion_product_data = $promotion_item_data['promotion_product_data'][0];

						if(is_array($promotion_item_data['promotion_product_data']) && count($promotion_item_data['promotion_product_data']) > 0 ){
							foreach($promotion_item_data['promotion_product_data'] as $promotion_product_data){
								$promotion_product_data['promotion_item_id'] 	= $promotion_item_data['promotion_item_id'];
								$promotion_product_data['promotion_id'] 	= $promotion_data['promotion_id'];
								
								 
								$error_msg	= $this->Validate_Promotion_Product_And_Update($promotion_product_data);
								if(count($error_msg) > 0){
									$errormsg['promotion_product_data_required'][] = $error_msg;
								}
							}
							
						}
						else{
							$errormsg['promotion_product_data_required'][] = 'promotion_product_data is required!';
						}
					}

				}
				else{
					$errormsg['promotion_item_data_required'][] = 'promotion_item_data is required!';
				}
			}
			
		} else{
				$errormsg['promotion_data_required'][] = 'promotion_data is required!';
		}

		 $resPonseData;
		if ( count($errormsg) > 0 ) {
            $resPonseData = new WP_Error('error', __('Promotion update fail.'), array('status' => 400, 'Data_Required'=> $errormsg));
        }
		 

		$resPonseData = new WP_REST_Response(array('status' => 200, 'data_org'=> $data)); 
		 
		$SFAPI->write_log_file_api('updatePromotion', json_encode($data), json_encode($resPonseData));

		return $resPonseData; 
	}
	
	// Validate Promotion and Update Data
	function Validate_Promotion_And_Update($data){
		global $wpdb;
		//require_once( ABSPATH . WPINC . '/user.php');
		//require_once( ABSPATH . WPINC . '/meta.php');
		
		/*$this->promotion_data = array(
			'ID' => 0,
			'promotion_id' => '', 
			'promotion_code' => '',
			'promotion_name' => '' 
		) ;		
		*/
		 
		$promotion = new PROMOTION();
		//$promotion_data = $promotion->promotion_data;
		
		$errmsg = []; 

		// if(empty($data['record_type'])){
		// 	$errmsg[] = 'Record type of Promotion (record_type) is requied. (eg: standard/default)';
		// }

		if(empty($data['promotion_id'])){
			$errmsg[] = 'Promotion id (promotion_id) is requied.';
		}
		
		if(empty($data['promotion_code'])){
			$errmsg[] = 'Promotion code (promotion_code) is requied.';
		} 
		if(empty($data['promotion_name'])){
			$errmsg[] = 'Promotion name (promotion_name) is requied.';
		}
		
		if(count($errmsg) > 0){ 
			
			return $errmsg;
		}
		
		$rs = -1;
		
		
		if( $data  ){   
			$rs = $id = $promotion->update_promotion($data); 
		} 
		// print_r($data); 
		
		if($rs == -1) {
			$errmsg[]="Update Promotion fail.";
		}
		
		return $errmsg;
	}
	
	// Validate Promotion Item and Update Data
	// Validate Promotion Item and Update Data
	function Validate_Promotion_Item_And_Update($data){
		global $wpdb;
		//require_once( ABSPATH . WPINC . '/user.php');
		//require_once( ABSPATH . WPINC . '/meta.php');
		
		/*$this->promotion_item_data = array(
			'ID' => 0,
			'sf_record_type' => '', 
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
		*/
		 
		$promotion = new PROMOTION();
		$promotion_data = $promotion->promotion_item_data;
		
		$errmsg = [];  
		if(empty($data['sf_record_type'])){  
			$errmsg[] = 'Record type (sf_record_type) is requied.';
		} 
		if(empty($data['promotion_type'])){ // promotion type
			$errmsg[] = 'Promotion type (promotion_type) is requied. (eg: DEFAULT/STANDARD)';
		}
		
		if(empty($data['promotion_id'])){
			$errmsg[] = 'Promotion id (promotion_id) is requied.';
		} 
		if(empty($data['promotion_item_id'])){
			$errmsg[] = 'Promotion item id (promotion_item_id) is requied.';
		}
		if(empty($data['promotion_item_code'])){
			$errmsg[] = 'Promotion item code (promotion_item_code) is requied.';
		}
		if(empty($data['promotion_item_name'])){
			$errmsg[] = 'Promotion item name (promotion_item_name) is requied.';
		}
		if(empty($data['valid_from'])){
			$errmsg[] = 'Valid from (valid_from) is requied.';
		}
		if(empty($data['valid_to'])){
			$errmsg[] = 'Valid to (valid_to) is requied.';
		} 
		if(empty($data['published'])){  
			$errmsg[] = 'published (published) is requied.'; 
		}
		
		if(count($errmsg) > 0){ 
			
			return $errmsg;
		}
		
		$rs = -1;
		if( $data  ){   
			$rs = $id = $promotion->update_promotion_item($data);
		} 
		
		if($rs == -1) {
			$errmsg[]="Update Promotion item fail.";
		}
		
		return $errmsg;
	}
	
	// Validate Promotion pack and Update Data
	function Validate_Promotion_Pack_And_Update($data){
		global $wpdb;
		//require_once( ABSPATH . WPINC . '/user.php');
		//require_once( ABSPATH . WPINC . '/meta.php');
		
		/*$this->promotion_pack_data = array(
			'ID' => 0, 
			'promotion_item_id' => '',
			'item_pack_id' => '',
			'promotion_pack_code' => '', 
			'promotion_pack_name' => '' 
		) ; 
		*/
		 
		
		$promotion = new PROMOTION();
		//$promotion_data = $promotion->promotion_item_data;
		
		$errmsg = [];  
		
		if(empty($data['promotion_item_id'])){
			$errmsg[] = 'Promotion item id (promotion_item_id) is requied.';
		}
		if(empty($data['item_pack_id'])){
			$errmsg[] = 'Item pack id (item_pack_id) is requied.';
		}
		if(empty($data['promotion_pack_code'])){
			$errmsg[] = 'Promotion pack code (promotion_pack_code) is requied.';
		}
		if(empty($data['promotion_pack_name'])){
			$errmsg[] = 'Promotion pack name (promotion_pack_name) is requied.';
		}
				
		if(count($errmsg) > 0){ 
			
			return $errmsg;
		}
		
		$rs = -1;
		if( $data  ){   
			$rs = $id = $promotion->update_promotion_pack($data); 
		} 
		
		if($rs == -1) {
			$errmsg[]="Update Promotion pack fail.";
		}
		
		return $errmsg;
	}
	
	// Validate Promotion Product and Update Data
	function Validate_Promotion_Product_And_Update($data){
		global $wpdb;
		//require_once( ABSPATH . WPINC . '/user.php');
		//require_once( ABSPATH . WPINC . '/meta.php');
		/* 
		$this->promotion_product_data = array(
			'ID' => 0,
			'record_type' => '',
			'promotion_item_id' => '',
			'product_code' => '', 
			'color_code' => '',
			'discount' => '',
			'list_price' => 0,
			'sale_price' => 0 
		) ; */
		 
		$promotion = new PROMOTION();
		//$promotion_data = $promotion->promotion_item_data;
		
		$errmsg = [];  
		
		if(empty($data['record_type'])){ // product type
			$errmsg[] = 'Record type (record_type) is requied.';
		}
		if(empty($data['promotion_item_id'])){
			$errmsg[] = 'Promotion item id (promotion_item_id) is requied.';
		}
		if(empty($data['product_code'])){
			$errmsg[] = 'Product code (product_code) is requied.';
		}
		if(strtolower($data['record_type'])=='bike'){
			if(empty($data['color_code'])){
				$errmsg[] = 'Color code (color_code) for record_type = "Bike" is requied.';
			}
		} 
		
		if(count($errmsg) > 0){ 	
			return $errmsg;
		}
		
		$rs = -1;
		if( $data  ){   
			$rs = $id = $promotion->update_promotion_product($data); 
		} 
		
		if($rs == -1) {
			$errmsg[]="Update Promotion Product fail.";
		}
		
		return $errmsg;
	}	
	// end PROMOTION


	// Update Promotion
	function update_Promotion_Default($request){ 
		global $wpdb, $current_user, $SFAPI;   
		
		$data = $this->get_all_type_parameters($request); //$request->get_body_params();

		//print_r($data); die();
		 
		if(is_array($data['promotion_data']) && count($data['promotion_data']) >0 ){
			 
			foreach($data['promotion_data'] as $promotion_data){ 
				// promotion data				 
				$error_msg = $this->Validate_Promotion_And_Update($promotion_data);
				if(count($error_msg) > 0){
					$errormsg['promotion_data_required'][] = $error_msg;
				}
				// promotion item data
//				$promotion_item_data = $promotion_data['promotion_item_data'];
				if(is_array($promotion_data['promotion_item_data']) && count($promotion_data['promotion_item_data']) > 0 ) {
					foreach( $promotion_data['promotion_item_data'] as $promotion_item_data){
						//$promotion_item_data = $promotion_data['promotion_item_data']
						 
						$promotion_item_data['promotion_id'] 		= $promotion_data['promotion_id']; 
						$error_msg = $this->Validate_Promotion_Item_And_Update($promotion_item_data);

						if(count($error_msg) > 0){
								$errormsg['promotion_item_data_required'][] = $error_msg;
							}
						// promotion pack data
						//$promotion_pack_data = $promotion_item_data['promotion_pack_data'][0];
						if(is_array($promotion_item_data['promotion_pack_data']) && count($promotion_item_data['promotion_pack_data']) > 0 ){
							foreach ($promotion_item_data['promotion_pack_data'] as $promotion_pack_data){
								 
								$promotion_pack_data['promotion_item_id'] 	= $promotion_item_data['promotion_item_id'];
								$error_msg = $this->Validate_Promotion_Pack_And_Update($promotion_pack_data);

								if(count($error_msg) > 0){
									$errormsg['promotion_pack_data_required'][] = $error_msg;
								}
							}
						}
						else{ 
							//$errormsg['promotion_pack_data_required'][] = 'promotion_pack_data is required!';
						}
						
						// promotion Product data
						//$promotion_product_data = $promotion_item_data['promotion_product_data'][0];

						if(is_array($promotion_item_data['promotion_product_data']) && count($promotion_item_data['promotion_product_data']) > 0 ){
							foreach($promotion_item_data['promotion_product_data'] as $promotion_product_data){
								$promotion_product_data['promotion_item_id'] 	= $promotion_item_data['promotion_item_id'];
								$promotion_product_data['promotion_id'] 	= $promotion_data['promotion_id'];
								
								 
								$error_msg	= $this->Validate_Promotion_Product_And_Update($promotion_product_data);
								if(count($error_msg) > 0){
									$errormsg['promotion_product_data_required'][] = $error_msg;
								}
							}
							
						}
						else{
							$errormsg['promotion_product_data_required'][] = 'promotion_product_data is required!';
						}
					}

				}
				else{
					$errormsg['promotion_item_data_required'][] = 'promotion_item_data is required!';
				}
			}
			
		} else{
				$errormsg['promotion_data_required'][] = 'promotion_data is required!';
		}

		 $resPonseData;
		if ( count($errormsg) > 0 ) {
            $resPonseData = new WP_Error('error', __('Promotion update fail.'), array('status' => 400, 'Data_Required'=> $errormsg));
        }
		 

		$resPonseData = new WP_REST_Response(array('status' => 200, 'data_org'=> $data)); 
		 
		$SFAPI->write_log_file_api('updatePromotionDefault', json_encode($data), json_encode($resPonseData));

		return $resPonseData; 
	}
	
	// UPDATE FREE COUPON 	
	 function update_free_coupon($request){
		global $wpdb, $current_user, $SFAPI; 
		
		$data = $this->get_all_type_parameters($request); 
		// print_r($data);
		if(is_array($data) && count($data) > 0){
			foreach($data as $item_data){ 
			  
			  $error_msg = $this->Validate_Free_Coupon_And_Update($item_data);
			  if ( count($error_msg) > 0 ) {
				  $errormsg[] = $error_msg;
			  }
		  } 
		}else{
			$errormsg[] = 'Free Coupon Data is requied.';
		}
		  
		 $resPonseData;

		if ( count($errormsg) > 0 ) {
            $resPonseData = new WP_Error('error', __('Free Coupon update fail.'), array('status' => 400, 'data_required'=> $errormsg));
        }
		  
		$resPonseData = new WP_REST_Response(array('status' => 200, 'data_org'=> $data)); 
		 
		$SFAPI->write_log_file_api('updateFreeCoupon', json_encode($data), json_encode($resPonseData));

		return $resPonseData;
		 
	} 
	
	function Validate_Free_Coupon_And_Update($data){
		global $wpdb;
		//require_once( ABSPATH . WPINC . '/user.php');
		//require_once( ABSPATH . WPINC . '/meta.php');
		
		/*$this->free_coupon_data = array(
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
		) ;*/
		 
		$free_coupon = new FREE_COUPON();
		//$free_coupon_data = $free_coupon->free_coupon_data;
		
		$errmsg = [];
		if(empty($data['free_coupon_id'])){
			$errmsg[] = 'Free coupon id (free_coupon_id) is requied.';
		}
		if(empty($data['free_coupon_name'])){
			$errmsg[] = 'Free coupon name (free_coupon_name) is requied.';
		}		
		if(empty($data['web_user_id'])){
			$errmsg[] = 'Web User ID (web_user_id) is requied.';
		}
		
		if($data['web_user_id'] != ''){
			$us = get_user_by( 'ID', $value = $data['web_user_id']) ;
			if(!$us){
				$errmsg[] = 'Web User (web_user_id) not exists.';
			}
		}
		/*if(empty($data['warranty_effective_date'])){
			$errmsg[] = 'Warranty Effective Date (warranty_effective_date) is requied.';
		}
		if(empty($data['warranty_expired_date'])){
			$errmsg[] = 'Warranty Expired Date (warranty_expired_date) is requied.';
		} 
		if(empty($data['warranty_policy_type'])){
			$errmsg[] = 'warranty_policy_type is requied.';
		}
		if(empty($data['application_dealer_code'])){
			$errmsg[] = '(application_dealer_code) is requied.';
		} 
		if(empty($data['service_date'])){
			$errmsg[] = '(service_date) is requied.';
		} 
		if(empty($data['serial_no'])){
			$errmsg[] = '(serial_no) is requied.';
		} 
		if(empty($data['mileage'])){
			$errmsg[] = '(mileage) is requied.';
		} 
		if(empty($data['applied'])){
			$errmsg[] = '(applied) is requied.';
		} */
		
		if(count($errmsg) > 0){ 
			
			return $errmsg;
		}
		
		$rs = -1;
		if( $data ){  
			$rs = $free_coupon->update_free_coupon($data); 
		} 
		
		if($rs == -1) {
			$errmsg[]="Update Free Coupon fail.";
		}
		
		return $errmsg;
	}
	// end UPDATE FREE COUPON  
	 
 
    /**
     * Check permissions  .
     *
     * @param WP_REST_Request $request Current request.
     */
    public function get_items_permissions_check( $request ) {
        if ( ! current_user_can( 'read' ) ) {
            return new WP_Error( 'rest_forbidden', esc_html__( 'You cannot view the post resource.' ), array( 'status' => $this->authorization_status_code() ) );
        }
        return true;
    }
 
    public function get_permissions_check( $request ) {
        $user_id = wp_validate_auth_cookie( $_COOKIE[LOGGED_IN_COOKIE], 'logged_in' );
       /* if (!$user_id) {
            //         if (!$user_id || !user_can($user_id, 'administrator')) {
            return new WP_Error( 'error', __( 'permission denied' ), array( 'status' => 550 ) );
        }*/
        return true;
    } 
  
    public function prepare_order_status_for_response( $order, $request ) {
        $order_data = array();
		$order_data['order_id'] = (int) $order['ID']; 
		$order_data['order_code'] = $order['order_code']; 
		$order_data['order_status'] = $order['order_status']; 
		$order_data['status'] = 200; 
        return $order_data;// json_encode( $order_data, $request );
    }
  
    public function prepare_response_for_collection( $response ) {
        if ( ! ( $response instanceof WP_REST_Response ) ) {
            return $response;
        }
 
        $data = (array) $response->get_data();
        $server = rest_get_server();
 
        if ( method_exists( $server, 'get_compact_response_links' ) ) {
            $links = call_user_func( array( $server, 'get_compact_response_links' ), $response );
        } else {
            $links = call_user_func( array( $server, 'get_response_links' ), $response );
        }
 
        if (!isset( $links ) ) {
            $data['_links'] = $links;
        }
 
        return $data;
    } 
	
    // Sets up the proper HTTP status code for authorization.
    public function authorization_status_code() {
 
        $status = 401;
 
        if ( is_user_logged_in() ) {
            $status = 403;
        }
 
        return $status;
    }
}
 
// Function to register our new routes from the controller.
function prefix_register_my_rest_routes() {
    $controller = new My_REST_ECC_Controller();
    $controller->register_routes();
} 
add_action( 'rest_api_init', 'prefix_register_my_rest_routes' );
?>
