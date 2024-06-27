<?php
/**
*  
*
*/
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
} 
class SF_API {
    private $DOMAIN = 'https://dev-ymvnapi.cs5.force.com/services/apexrest/';
	
	public function __construct()
	{
		// include_once(ABSPATH . WPINC . '/rest-api.php');
		// $this->DOMAIN = get_site_url();
	} 

	public function sendPost($api,$data){
		try {
			$curl = curl_init();
			// return $this->DOMAIN.$api;
			curl_setopt_array($curl, array(
			  CURLOPT_URL => $this->DOMAIN.$api,
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => '',
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 0,
			  CURLOPT_FOLLOWLOCATION => true,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => 'POST',
			  CURLOPT_POSTFIELDS =>json_encode($data),
			  CURLOPT_HTTPHEADER => array(
			    'Content-Type: application/json'
			  ),
			));

			$response = curl_exec($curl); 

			curl_close($curl);
			// return $response;
			//return $response;

			$this->write_log_file_api($apiname = $api, $request = json_encode($data), $response =  $response);
			return json_decode($response, true);
		} catch (Exception $e) {
			return $e;
		}
	}

	public function write_log_file_api($apiname, $request, $response='')
	 {
	 	date_default_timezone_set('Asia/Ho_Chi_Minh');
 
		$time = date('d-m-Y H:i:s');

		//$file = $_SERVER['DOCUMENT_ROOT'] . '/logs_api/api_'.$apiname.'_'.$time.'.txt';
		$file1 = $_SERVER['DOCUMENT_ROOT'] . '/logs_api/api_'.$apiname.'_'.date('d-m-Y').'.txt';
		
		$content =  $time.": ".$apiname."\n Request: ".$request."\n Response: " . $response . "\n";

		// $fp = fopen($file,"wb");
	 //    fwrite($fp,$content);
	 //    fclose($fp);

		if (file_exists($file1)) {
			$current = file_get_contents($file1);
			$current .= PHP_EOL . $content;
			file_put_contents($file1, $current);
		    //echo "Đã thêm log ".$apiname;
		} else {
			file_put_contents($file1, $content);
		    //echo "Đã tạo mới file log ".$apiname;
		}
	 }
}

global $SFAPI;
$SFAPI = new SF_API();

	// $plugin_dir = ABSPATH . 'wp-content/plugins/commerce-cms/';		
	// include_once($plugin_dir.'api/sf_api.php');	
 //    $SF_API = new SF_API();
 //    $data_pos = [
 //    "phoneNo" => "0933567777",
 //    "districtcode" => "",
 //    "provincecode" => "",
 //    "addressno" => "381 Cách mạng tháng 8",
 //    "gender" => "Female",
 //    "firstname" => "Hòn ngọc",
 //    "lastname" => "Viễn Đông",
 //    "email" => "viendong@gmail.com",
 //    "websiteID" => "199218281828121"
	// ];
 //    $res = $SF_API->sendPost('APICheckingAccountWebsite',$data_pos);
 //    wp_send_json_success(array('success'=>0, 'return'=>$res)); 

function get_API_DATA_FROM_SF($api, $dataRequest = []){ // $dataRequest: array()
	global $SFAPI;
	$dataResponse = json_encode($SFAPI->sendPost($api, $dataRequest));
	return $dataResponse;
}

function ajax_get_API_DATA_FROM_SF(){

//https://dev-ymvnapi.cs5.force.com/services/apexrest/APICheckVoucher
	global $SFAPI;
	$dataRequest = $_POST['dataRequest'];
	$apiName = $_POST['apiName']; 

	$dataResponse = $SFAPI->sendPost($apiName, $dataRequest );
	//$dataResponse =  $dataResponse;

	wp_send_json_success(array($apiName, $dataResponse, $dataRequest));
	die();
}
add_action('wp_ajax_ajax_get_API_DATA_FROM_SF', 'ajax_get_API_DATA_FROM_SF'); // wp_ajax_{action}
add_action('wp_ajax_nopriv_ajax_get_API_DATA_FROM_SF', 'ajax_get_API_DATA_FROM_SF'); // wp_ajax_nopriv_{action}


?>
