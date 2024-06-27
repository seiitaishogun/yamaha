<?php
/**
*  
*
*/
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
//require_once( ABSPATH . WPINC . '/user.php');
//global $ckbooking ; 
//define( 'PLG_PATH', plugin_dir_path( '__FILE__' ) );
//$current_user = wp_get_current_user();
//$current_user_profile = $wpdb->get_row ( "SELECT * FROM $table WHERE user_id = {$current_user->ID}");
 
//get province
//$dtTable = $wpdb->prefix.'province';
//$province = $wpdb->get_results ( "SELECT * FROM $dtTable "); 
global $wpdb, $current_user, $current_user_profile, $ListBookings, $BookingItems, $cart_count, $current_customer, $current_customer_address, $PROMOTION;

date_default_timezone_set("Asia/Ho_Chi_Minh");

function get_curent_customer(){
	global $wpdb, $current_user, $current_user_profile, $current_customer, $current_customer_address ;
	$table_customer= $wpdb->prefix.'customer';
	if(!$current_user){
		$current_user = wp_get_current_user();
	}
	if(!$current_customer){
		$current_customer = $current_user_profile = $wpdb->get_row( "SELECT * FROM {$table_customer} WHERE user_id = {$current_user->ID} LIMIT 1 ; ");
	} 
}

function get_ymh_feature_image(){

	$page_id = get_queried_object_id();

	$post_type = get_post_type($page_id);

	$image  = '';
	if($post_type == 'news'){
		$image = get_field('feature_image', $page_id);
	}
	else if( $post_type == 'product'){
		$overview = get_field("overview", $page_id); 
		$images = $overview['list_colors'];
		$image = $images[0]['image_color'] ; 
	}
	else if($post_type == 'item' || $post_type == 'apparel'){
		$images = get_field('list_image', $page_id);
		$image = $images[0]['image'][0]['sizes']['medium']; 
	}
	else if($post_type == 'package' || $post_type == 'service'){ 
		$image = get_field("image", $page_id);
	}else{
		$image = get_template_directory_uri().'/img/logo.png';
	}
	if($image=='' || empty($image)) $image = get_template_directory_uri().'/img/logo.png';
	return $image;

}

function get_curent_customer_address(){
	global $wpdb, $current_user, $current_user_profile, $current_customer, $current_customer_address;
	$table_customer = $wpdb->prefix.'customer';
	$table_customer_address = $wpdb->prefix.'customer_address';
	
	if(!$current_user){
		get_curent_customer();
	}
	 
	$SQL= "";
	if (!$current_user_profile ) {
		$SQL= "SELECT cus.*, p.province_name, d.district_name, w.ward_name FROM {$table_customer} AS cus LEFT JOIN " . $wpdb->prefix.'province' ." AS p ON (cus.province_id = p.province_id) " .
		" LEFT JOIN " . $wpdb->prefix.'districts' ." AS d ON (cus.district_id = d.district_id AND p.province_id = d.province_id) " .
		" LEFT JOIN " . $wpdb->prefix.'wards' ." AS w ON (cus.ward_id = w.ward_id AND w.district_id = d.district_id) " .
		" WHERE user_id = {$current_user->ID} LIMIT 1 ; ";
		
		$current_customer = $current_user_profile = $wpdb->get_row( $SQL); 
	}
	
	if(!$current_customer_address){
		
		$SQL= "SELECT cus.*, p.province_name, d.district_name, w.ward_name  FROM {$tableAddress} 
		 AS cus LEFT JOIN " . $wpdb->prefix.'province' ." AS p ON (cus.province_id = p.province_id) " .
			" LEFT JOIN " . $wpdb->prefix.'districts' ." AS d ON (cus.district_id = d.district_id AND p.province_id = d.province_id) " .
			" LEFT JOIN " . $wpdb->prefix.'wards' ." AS w ON (cus.ward_id = w.ward_id AND w.district_id = d.district_id) " .
		" WHERE cus.customer_id = {$current_user_profile->user_id} AND default_address = 1 LIMIT 1 ; ";

		$current_customer_address = $wpdb->get_row($SQL);
	} 
}

function get_customer_address_payment(){
	global $wpdb, $current_user_profile, $current_user, $current_customer, $current_customer_address;
	 
	if(!$current_user){
		get_curent_customer_address(); 
	}  
	
	if(!$current_customer_address)
		$current_customer_address = $current_user_profile; 
	
	return($current_customer_address );
}

/*function makewp_exclude_page_templates( $post_templates ) {
if ( version_compare( $GLOBALS['wp_version'], '4.7', '<' ) ) {
unset( $post_templates['pages/page-orderlist.php'] );
}
return $post_templates;
}
add_filter( 'theme_page_templates', 'makewp_exclude_page_templates' );*/

define('ORDER_STATUS', array('0'=>'Trạng thái đơn hàng',
								'1'=>'Đặt hàng thành công',
								'2'=>'DO/DL tiếp nhận thông tin', 
								'3'=>'Đang xử lý', 
								'4'=>'Hoàn thành', 
								'5'=>'Chưa thanh toán',
								'6'=>'Hủy thành công',
								'7'=>'Thanh toán thất bại',
								'8'=>'Thanh toán thành công',
								'9'=>'Giao hàng thành công',
								'10'=>'Hoàn tiền thành công',								
							 ));

define('CANCEL_ORDER_REASON', array(
							'0'=>'Lý do hủy đơn hàng',
							'1'=>'Muốn thay đổi phương thức thanh toán',
							'2'=>'Muốn thay đổi địa chỉ giao hàng', 
							'3'=>'Đã có sản phẩm thay thế', 
							'4'=>'Thời gian giao hàng quá lâu', 
							'5'=>'Đổi ý không muốn mua nữa',
							'6'=>'Lý do khác',
							 ));
	   
define('PRODUCT_TYPE', array('Bike', 'PCA', 'package'));

function validateDate($date, $format = 'Y-m-d H:i:s')
{
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) == $date;
}

function ccms_plugin_booking_scripts() {
	 
	$purl = plugins_url( '/commerce-cms', 'commerce-cms' );
	 
    //wp_register_style( 'booking-style',  plugin_dir_url( __FILE__ ) . 'css/booking-style.css' );
	 wp_register_style( 'checkbox-styles',  $purl . '/css/checkbox.css' );
    wp_enqueue_style( 'checkbox-styles' );
	
    wp_register_style( 'booking-style',  $purl . '/css/booking-style.css' );
    wp_enqueue_style( 'booking-style' );
	
	wp_register_style( 'login-style',  $purl . '/css/login-style.css' );
    wp_enqueue_style( 'login-style' );
	
	wp_register_style( 'customer-address-style',  $purl . '/css/customer-address-style.css' );
    wp_enqueue_style( 'customer-address-style' );
	
	//sử dụng thư viện WP Media
	//wp_enqueue_media();
	//wp_register_script( 'ccms_upload_avatar_script', $purl . '/js/upload_avatar.js', true, $ver = false );
	//wp_enqueue_script( 'ccms_upload_avatar_script' );
	 
	 
 	wp_register_script( 'ccms_gapi_recaptcha_script', 'https://www.google.com/recaptcha/api.js', true, $ver = false );
	wp_enqueue_script( 'ccms_gapi_recaptcha_script' );
}
add_action( 'wp_enqueue_scripts', 'ccms_plugin_booking_scripts', 99 );

add_action('wp_head', 'my_custom_icon_styles', 100);

function my_custom_icon_styles()
{
 	echo ' <style>
	.icon_goolge{background: url('.get_template_directory_uri().'/img/ic_goolge.svg) no-repeat center center; display: inline-block; display: inline-block;height: 22px; width: 22px; position: absolute; left: 5px; } 
	.wishlist_count{background: url('.get_template_directory_uri().'/img/ic_heart_o_w.svg) no-repeat center center;
	height: 40px; width: 40px; display: flex; position: relative;}
	i.sf-icon-love {
		background: url('.get_template_directory_uri().'/img/ic_heart_o.svg) center center no-repeat !important;
		content: "" !important;
		color: transparent !important;
		width: 30px !important;
		height: 30px!important; 
		margin: 0 auto;
		z-index: 22;font-size: 30px !important;  
		background-size: 26px auto; opacity: 0.8;
		top: -0px;
		left: -1px !important;
		position: absolute;
	} 
	.simplefavorite-button.btn-clip.btn-border-red.active.preset i.sf-icon-love{
		background: url('.get_template_directory_uri().'/img/ic_heart_o_w.svg)center center no-repeat !important;
	}
	
	button.simplefavorite-button.btn-clip.btn-border-red.preset:hover i.sf-icon-love, i.sf-icon-love:hover {
		background: url('.get_template_directory_uri().'/img/ic_heart_o_w.svg)center center no-repeat !important;  
		z-index: 22;font-size: 30px !important; 
		background-size: 27px auto; opacity: 1;
	} </style>';
}

function ymh_profile_fields() {
	global $current_user;
    $profile_pic = ($current_user!=='add-new-user') ? get_user_meta($current_user->ID, 'profile_avatar', true): false;
    if( !empty($profile_pic) ){
        $image = wp_get_attachment_image_src( $profile_pic, 'medium' );
    } ?>
    <div class="wp-core-ui nd">
		<input type="file" data-id="avatar_image_id" data-src="avatar-img" class="button avatar-image" name="file-avatar" id="avatar_upload_image" value="Tải hình lên" />
		<input type="hidden" class="button" name="avatar_image_id" id="avatar_image_id" value="<?php echo !empty($profile_pic) ? $profile_pic : ''; ?>" />
		<img id="avatar-img" src="<?php echo !empty($profile_pic) ? $image[0] : ''; ?>" style="<?php echo  empty($profile_pic) ? 'display:none;' :'' ?> width: 200px; height: auto; border:1px solid cadetblue;padding:2px;" />
	</div> 
    <?php
}
add_action( 'show_user_profile', 'ymh_profile_fields' );
add_action( 'edit_user_profile', 'ymh_profile_fields' );
//add_action( 'user_new_form', 'ymh_profile_fields' );

function ymh_profile_avatar_update($user_id, $profile_pic){
  
    if( current_user_can('administrator') || current_user_can('editor') || current_user_can('author') || current_user_can('subscriber') || current_user_can('contributor') ){ 
        update_user_meta($user_id, 'profile_avatar', $profile_pic);
    }
}
//add_action('profile_update', 'ymh_profile_avatar_update');
//add_action('user_register', 'ymh_profile_avatar_update');
 
add_filter( 'get_avatar' , 'my_profile_avatar' , 1 , 5 );
function my_profile_avatar( $avatar, $id_or_email, $size, $default, $alt ) {
    $user = false;
 
    if ( is_numeric( $id_or_email ) ) {
        $id = (int) $id_or_email;
        $user = get_user_by( 'id' , $id );
    } elseif ( is_object( $id_or_email ) ) {
        if ( ! empty( $id_or_email->user_id ) ) {
            $id = (int) $id_or_email->user_id;
            $user = get_user_by( 'id' , $id );
        }
    } else {
        $user = get_user_by( 'email', $id_or_email );
    }
    if($user){
        $custom_avatar  =   get_user_meta( $user->data->ID, 'profile_avatar', true );
 
        if( !empty($custom_avatar) ){
             
            $image  =   wp_get_attachment_image_src($custom_avatar, 'medium');
            if( $image ){
                $safe_alt = esc_attr($alt);
                $avatar = "<img alt='{$safe_alt}' src='{$image[0]}' class='avatar photo' height='90px' width='90px' />";
            }
        }
    }
    return $avatar;
}

function upload_avatar_profile(){

	if(isset($_FILES['file-avatar'])){
 		if($_FILES['file-avatar']['name']){
			$upload = wp_upload_bits( $_FILES['file-avatar']['name'], null, file_get_contents( $_FILES['file-avatar']['tmp_name'] ) );
			$wp_filetype = wp_check_filetype( basename( $upload['file'] ), null );
			$wp_upload_dir = wp_upload_dir();
			$attachment = array(
				'guid' => $wp_upload_dir['baseurl'] . _wp_relative_upload_path( $upload['file'] ),
				'post_mime_type' => $wp_filetype['type'],
				'post_title' => preg_replace('/\.[^.]+$/', '', basename( $upload['file'] )),
				'post_content'   => '',
				'post_status'    => 'inherit'
			);
			$attach_id = wp_insert_attachment( $attachment, $upload['file']);
			require_once(ABSPATH . 'wp-admin/includes/image.php');
			$attach_data = wp_generate_attachment_metadata( $attach_id, $upload['file'] );
			wp_update_attachment_metadata( $attach_id, $attach_data );
			//update_user_meta(wp_get_current_user()->id, "profile_avatar", $attach_id);
			ymh_profile_avatar_update(wp_get_current_user()->id, $attach_id); 
		}
	}	
	 
}

function ccms_plugin_loginform_scripts() {
	$purl = plugins_url( '/commerce-cms', 'commerce-cms' );
   // wp_register_style( 'loginform-styles',  plugin_dir_url( __FILE__ ) . 'css/checkbox.css' );
    wp_register_style( 'checkbox-styles',  $purl . '/css/checkbox.css' );
    wp_enqueue_style( 'checkbox-styles' );
}
//add_action( 'wp_enqueue_scripts', 'ccms_plugin_loginform_scripts', 99 );

function load_form_dang_ky_dang_nhap(){
global $wpdb, $current_user_profile, $current_user, $current_customer_address;
	 
	echo '<div id="mask_popup_site" class="mask_popup_site show" style="display:none"></div>' ;
	echo '<div id="popup_site" class="popup_site show" style="display:none"><div class="popup_content mrcenter text-center active" ></div><div class="error_message mrcenter text-center"></div></div>' ;
	?> 
<script type="text/javascript">
function isArray(obj)
{
    return obj !== undefined && obj !== null && obj.constructor == Array;
}

function isBoolean(obj)
{
    return obj !== undefined && obj !== null && obj.constructor == Boolean;
}

function isFunction(obj)
{
    return obj !== undefined && obj !== null && obj.constructor == Function;
}

function isNumber(obj)
{
    return obj !== undefined && obj !== null && obj.constructor == Number;
}

function isString(obj)
{
    return obj !== undefined && obj !== null && obj.constructor == String;
}
	function showPopup(msg, el){
						
		var popup = $('#popup_site');
		var mask_popup = $('#mask_popup_site') ;
		mask_popup.show( );
		mask_popup.removeClass('hidden'); 
		mask_popup.addClass('show');
		popup.show();
		popup.removeClass('hidden');
		popup.addClass('show'); 
		el.html(''+msg+'');
		el.addClass('active');
		el.show(); 
	}
	function hidePopup(){
		var popup = $('#popup_site');
		var mask_popup = $('#mask_popup_site') ; 
		mask_popup.hide();
		mask_popup.removeClass('show'); 
		mask_popup.addClass('hidden');
		popup.hide();
		popup.removeClass('show');
		popup.addClass('hidden');
		mask_popup.hide();

		popup.hide( "slow");

		$('#popup_site .popup_content').html('');
		$('#popup_site .popup_content').hide();
		$('#popup_site .popup_content').removeClass('active');
		$('#popup_site .error_message').html('');
		$('#popup_site .error_message').hide();
		$('#popup_site .error_message').removeClass('active');
	}
  
    $(document).ready(function() {
		$('#mask_popup_site').click(function(){
			hidePopup();
		});
	});
</script>
	
	<?php
	
	if(is_user_logged_in() && strpos($_SERVER['REQUEST_URI'],'booking') >0 ):
		include_once(WP_PLUGIN_DIR.'/commerce-cms/frm/frm_popup_customer_address.php');
	else: 
		include_once(WP_PLUGIN_DIR.'/commerce-cms/frm/frm_login_register.php');
	endif;
} 

// LOAD FORM ADDRESS BOOK

function load_form_address_book(){
	
	global $wpdb, $current_user_profile, $current_user, $current_customer_address;

	if(!is_user_logged_in()):
		echo ''; 
	else:
	 	include_once(WP_PLUGIN_DIR.'/commerce-cms/frm/frm_popup_customer_address.php');
	endif;
} 

function load_step_booking($step=1){ 
	global $arr_step_title;
	include_once(WP_PLUGIN_DIR.'/commerce-cms/html/booking-step-header.php');
}

function load_booking_form($step=1){ 
	include_once(WP_PLUGIN_DIR.'/commerce-cms/html/order-form-step-'.$step.'.php');
}

function load_order_list( ){ 
	global $wpdb, $current_user, $current_user_profile;
	include_once(WP_PLUGIN_DIR.'/commerce-cms/html/order-list.php');
}
 
function get_html_option_for_select($stable = 'province', $fields=array('fname'=>'province_name', 'fkey'=>'province_id'), $selected_val = ''){
	global $wpdb ;
	$dtTable = $wpdb->prefix.$stable;
	$rows = $wpdb->get_results ( "SELECT * FROM $dtTable ORDER BY {$fields['fname']} ", ARRAY_A); 
 	foreach( $rows as $item ) : ?>
		<option value="<?=$item[$fields['fkey']]?>" <?=$selected_val==$item[$fields['fkey']]?'selected':''?> >
			<?=$item[$fields['fname']]?>
		</option>
	<?php endforeach; ?>
<?php 
}					
?> 
<?php 
function get_list_Items_Cookie(){
	$CookieBookings = null;
	//$ckbooking = new CookieBooking();
	//$CookieBookings = $cookie = json_decode(stripslashes($_COOKIE['booking_cookie']), true); //$ckbooking->getCookieBookings();
	if(isset($_COOKIE['booking_cookie']))
		$CookieBookings = json_decode(stripslashes($_COOKIE['booking_cookie']), true); 
	
	return($CookieBookings);
}

function check_user_exists($data = null){
	require_once( ABSPATH . WPINC . '/user.php');
	
	if(!username_exists( $data['user_login'] ) && !email_exists( $data['user_email'] )){
		return false ;
	}else
		return true ;
}

function my_update_user($dataus){
	global $wp, $wpdb;
	$userID = 0;
	if($dataus){ 
		$userID = $wpdb->update($wpdb->prefix.'users', $dataus, $where = array('ID'=>$dataus['ID'])); 
	} 
	return($userID);
}

function check_user_exists_resetpass(){
	global $wpdb;
	$data = $_POST['data'];
	$ex = false ; 
	if(!username_exists( $data['user_login'] ) && !email_exists( $data['user_email'] )){
		$ex = false ;
	}else{
		$us = get_user_by( 'email', $data['user_email'] );
		$key = md5( $data['user_email']);
		$dataus = array(
			'ID' => $us->ID, 
			'user_email'=> $data['user_email'],
            'user_activation_key' => $key
        );
		$ex = true ;
		
		my_update_user($dataus);
	} 
	
	wp_send_json_success(array('exists'=> $ex, $data, $dataus, ( ABSPATH . WPINC . '/user.php'))) ; die();
}
add_action('wp_ajax_check_user_exists_resetpass', 'check_user_exists_resetpass'); // wp_ajax_{action}
add_action('wp_ajax_nopriv_check_user_exists_resetpass', 'check_user_exists_resetpass'); // wp_ajax_nopriv_{action}

function ajax_update_password(){
	global $wpdb;
	$data = $_POST['data']; 
	$dataus = array(
			'ID' => $data['user_id'],
            'user_pass' => md5($data['user_pass']),
            'user_activation_key' => ''
        );
	
	$userID = my_update_user( $dataus ); 
	//$userID=wp_set_password($data['user_pass'], $data['user_id'] );
	
	wp_send_json_success(array('updated'=> $userID, $data, $dataus)) ;
	die();
}
add_action('wp_ajax_ajax_update_password', 'ajax_update_password'); // wp_ajax_{action}
add_action('wp_ajax_nopriv_ajax_update_password', 'ajax_update_password'); // wp_ajax_nopriv_{action}

function create_update_wp_user($data = null ) {
    if ( empty($data) ) return false;
    global $wpdb, $current_user;
	
	$userdata = $data; $user = false;
	
    require_once( ABSPATH . WPINC . '/registration.php');
	require_once( ABSPATH . WPINC . '/user.php');
	
	if(!check_user_exists($userdata)){
		$user = wp_insert_user( $userdata );
	}
	else{
		//$current_user = wp_get_current_user();
		//$userdata['ID'] = $current_user->ID;
		$user = wp_update_user( $userdata );//wp_update_user( $userdata ); 
	}  
    return $user;
}

// Tao moi nguoi dung
function create_wp_user($data = null ) {
	
    if ( empty($data) ) return false; 
	
	$userdata = $data;
	
	$userID = false;
	
    require_once( ABSPATH . WPINC . '/registration.php');
	require_once( ABSPATH . WPINC . '/user.php');
	
	if(!check_user_exists($userdata)){
		$userID = wp_insert_user( $userdata );
		$us = get_user_by( 'ID', $userID );
		active_wp_user($us); 
	} 
    return $userID;
}

/**
 * render email template
 * @param $data Array of data need to pass into template
 * @param $template email template path
 * @return email html content 
 */
function render_email($data = [], $template = "") {
    ob_start();
    include $template;
    $content = ob_get_contents();
    ob_end_clean();
    return $content;
}

function active_wp_user($data = null ) {
	// global $phpmailer;
    if ( empty($data) ) return false; 
	
	$us = $data; 
	if($us && $us->ID  && $us->user_email){
		$token = $us->user_activation_key;
		$emailto = $us->user_email;
		$headers = array(
		  'Content-Type: text/html; charset=UTF-8', 
		  // 'Gửi từ: REVZONE YAMAHA MOTOR  <noreply@revzoneyamaha-motor.com.vn>',
		  'from: noreply@revzoneyamaha-motor.com.vn',
		);
		// set data for email template
        $email_data['url'] = get_site_url() . '/user/?ui=' . $us->ID . '&tk=' . $token;

        $subject = 'Xác nhận Email Đăng ký tài khoản!';
        $message_body = render_email($email_data, CCMS_ABSPATH . '/html/email/email_active_user.php');
		return wp_mail( $emailto, $subject, $message_body, $headers, $attachments='' );
		// return true;
	} 
	return false;
}
function send_email_order_to_customer($user_email, $customer_list_orders = false){
	global $current_user, $current_user_profile, $C_ORDER,$wpdb;
	$table_custommer = $wpdb->prefix.'customer';

	if($customer_list_orders){  
		$custommer = $wpdb->get_row( "SELECT * FROM {$table_custommer} WHERE user_id = {$customer_list_orders[0]->customer_id} LIMIT 1 ; ");
		if($custommer){
			$token = md5($custommer->email);
			$emailto = $custommer->email;
			$headers = array(
			  'Content-Type: text/html; charset=UTF-8', 
			  'from: REVZONE YAMAHA MOTOR  <noreply@revzoneyamaha-motor.com.vn>', 
			);
			// return $customer_list_orders[0]->rec_address;
			// set data for email template
			$receiver_address = json_decode(json_decode("\"".$customer_list_orders[0]->rec_address."\""),true);
			// var_dump($customer_list_orders[0]->rec_address);
			// var_dump($receiver_address->name);
			// die();
			// return $receiver_address;
	        $email_data['fullname'] = $custommer->full_name;
	        $email_data['email'] = $custommer->email;
	        $email_data['phone'] = $custommer->phone;
	        $email_data['rec_fullname'] = $receiver_address['name'];
	        $email_data['rec_address'] = $receiver_address['address'];
	        $email_data['rec_phone'] = $receiver_address['phone'];
	        $email_data['order_code'] = $customer_list_orders[0]->order_code;
	        $email_data['payment_method'] = $customer_list_orders[0]->payments;
	        $email_data['shipping_fee'] = $customer_list_orders[0]->shipping_fee;
	        $email_data['order_sum'] = $customer_list_orders[0];
	        // get order detail
	        $email_data['order_url'] = get_site_url() . '/user/?ui=' . $custommer->user_id . '&tk=' . $token . '#history-order';

	        $details_order = [];
	        for ($i=1; $i <count($customer_list_orders) ; $i++) { 
	        	$detail = $C_ORDER->get_order_details_by_ORDER_ID($customer_list_orders[$i]->ID);
	        	$details_order[] = [
	        		'order' => $customer_list_orders[$i],
	        		'detail'=>$detail
	        	];
	        }
	        $email_data['details_order'] = $details_order;
	        $subject = 'Thông báo đặt hàng thành công.';
	        // return $email_data['details_order'][0]['detail'][0]->ID;
	        $message_body = render_email($email_data, CCMS_ABSPATH . '/html/email/email_booking_order_success.php');
			wp_mail( $emailto, $subject, $message_body, $headers, $attachments='' );
		}

		return 1;
	}
}

function send_email_cancel_order($user_email, $order = false){
	global $current_user, $current_user_profile, $wpdb;
	$table_orders = $wpdb->prefix.'orders'; 
	if($order && $current_user){  
		$orderData = $wpdb->get_row( "SELECT * FROM {$table_orders} WHERE ID = {$order['ID']} LIMIT 1 ; ");
		if ($orderData) {
			$token = md5($current_user->user_email);
			$emailto = $user_email;
			$headers = array(
			  'Content-Type: text/html; charset=UTF-8', 
			  'from: REVZONE YAMAHA MOTOR  <noreply@revzoneyamaha-motor.com.vn>', 
			);
			// set data for email template
	        $email_data['fullname'] = $current_user_profile->full_name;
	        $email_data['order_id'] = $order['ID']; 
	        $email_data['paid'] = $orderData->paid; 
	        $email_data['token'] = $token;
	        $email_data['current_user_id'] = $current_user->ID;
	        $email_data['order_url'] = get_site_url().'/user/?order_id='.$order['ID'].'&ui='.$current_user->ID.'&tk='.$token.'#check-order';
	        
			$subject = 'Thông báo hủy đơn hàng thành công.';
			$message_body = render_email($email_data, CCMS_ABSPATH . '/html/email/order_cancellation_for_total_order.php');

			// $message_body = '<p>Chào '.$current_user_profile->full_name . ',</p>';
			// $message_body .= '<p>Bạn đã hủy đơn hàng #'.$order['ID'].' thành công từ REVZONE YAMAHA MOTOR.</p> <p>Vui lòng nhấn <a href="'. get_site_url().'/user/?order_id='.$order['ID'].'&ui='.$current_user->ID.'&tk='.$token.'#check-order">VÀO ĐÂY</a> để xem chi tiết đơn hàng của bạn.</p>';
			wp_mail( $emailto, $subject, $message_body, $headers, $attachments='' );
		}
	}
}

function send_email_order_delivered($order = false){
	global $wpdb;
	$table_custommer = $wpdb->prefix.'customer';
	if($order){  
		$custommer = $wpdb->get_row( "SELECT * FROM {$table_custommer} WHERE user_id = {$order->customer_id} LIMIT 1 ; ");

		if($custommer){
			$emailto = $custommer->email;
			$headers = array(
			  'Content-Type: text/html; charset=UTF-8', 
			  'from: REVZONE YAMAHA MOTOR  <noreply@revzoneyamaha-motor.com.vn>', 
			);
			// set data for email template
	        $email_data['order_code'] = $order->order_code;

	        $subject = 'Thông báo Đơn hàng đã giao thành công.';
	        $message_body = render_email($email_data, CCMS_ABSPATH . '/html/email/order_delivered.php');
			wp_mail( $emailto, $subject, $message_body, $headers, $attachments='' );
		}
	}
}

function send_email_refund_successfull($order = false){
	global $wpdb;
	$table_custommer = $wpdb->prefix.'customer';
	if($order){  
		$custommer = $wpdb->get_row( "SELECT * FROM {$table_custommer} WHERE user_id = {$order->customer_id} LIMIT 1 ; ");
		if($custommer){
			$emailto = $custommer->email;
			$headers = array(
			  'Content-Type: text/html; charset=UTF-8', 
			  'from: REVZONE YAMAHA MOTOR  <noreply@revzoneyamaha-motor.com.vn>', 
			);
			// set data for email template
	        $email_data['order_code'] = $order->order_code;
	        $email_data['paid'] = $order->paid;
	        $email_data['date_updated'] = $order->date_updated;
	        $email_data['full_name'] = $custommer->full_name;

	        $subject = 'Thông báo hoàn tiền thành công.';
	        $message_body = render_email($email_data, CCMS_ABSPATH . '/html/email/refund_successfull.php');
			wp_mail( $emailto, $subject, $message_body, $headers, $attachments='' );
		}

	}
}

/**
 * active user
 */
function ajax_active_user() {
	$userID =$_POST['user_id'];

	// return $userID;
    if ( empty($userID) ) return false;
    require_once( ABSPATH . WPINC . '/user.php');
    $us = get_user_by( 'ID', $userID );
    // active_wp_user($us);
    wp_send_json_success(active_wp_user($us));
}
add_action( 'wp_ajax_ajax_active_user', 'ajax_active_user' );
add_action('wp_ajax_nopriv_ajax_active_user', 'ajax_active_user');

function ajax_login_ymh(){
	global $wp, $wpdb, $current_user;
	global $error;
	 
	require_once( ABSPATH . WPINC . '/registration.php');
	require_once( ABSPATH . WPINC . '/user.php');
	
	$return = array('text'=>'', 'status'=>'success'); 

// get current url with query string.
//$current_url =  home_url( $wp->request );  
	
	if( isset($_POST['data_dangnhap']) ) {
		
		$data = $_POST['data_dangnhap'];
		
		$username = $data['username'];		
		$password = $data['password'];
		
		if ( !empty( $username ) ) {

			if(strpos($username, '@') == true) {
				$user_info = get_user_by( 'email', $username );
				if ( isset( $user_info->user_login, $user_info ) ) {
					$username = $user_info->user_login;
				}
			}

			$creds = array();
			$creds['user_login'] = $username;
			$creds['user_password'] = $password;
			$creds['remember'] = false;
			
			$user = wp_signon( $creds, false );
			
			//$user = wp_authenticate($username, $password);
     

			if (is_wp_error($user)){
				//do_action('wp_login_failed', $username);
				$return['text'] =  'Tên đăng nhập hoặc mật khẩu không đúng!.'; 
				$return['status'] = 'error'; 
				
				wp_send_json_success(array('return'=> $return, $creds)) ;

			} else {
				$return['text'] =  'Đăng nhập thành công.'; 
				$return['status'] = 'success';
				
				wp_set_auth_cookie($user->ID); 
				
				$current_user = wp_get_current_user( );
				
				wp_send_json_success(array('return'=> $return,'cur_us'=>$current_user, $_POST['data_dangnhap'])) ;  
			}
		}  
		
		} else {
			$return['text'] =  'Tên đăng nhập hoặc mật khẩu không đúng!.';  
			$return['status'] = 'error';
		wp_send_json_success(array('return'=> $return, $_POST['data_dangnhap'])) ;
	}
 	 
	//die();
}
add_action('wp_ajax_ajax_login_ymh', 'ajax_login_ymh'); // wp_ajax_{action}
add_action('wp_ajax_nopriv_ajax_login_ymh', 'ajax_login_ymh'); // wp_ajax_nopriv_{action}

// Update new password and Profile
function ajax_update_UserProfile( ) {
    global $wpdb, $current_user ,$CMS_CUSTOMER;
	require_once( ABSPATH . WPINC . '/user.php');
    require_once( ABSPATH . WPINC . '/registration.php');
	
	$data = $_POST['customer'];
	$success = 0;
	$return = array('text'=>'', 'status'=>''); 
	/// Kiem tra Mat Khau va cap nhat Mat Khau
	if(isset($data['password'])){
		$password = $data['password'];
	}
	if(isset($data['newpassword'])){
		$newpassword = $data['newpassword'];
	}
	if(isset($data['re_password'])){
		$re_password = $data['re_password'];
	}  
	
	if (!$current_user)
		$current_user = wp_get_current_user();
	 
	if ( $current_user) { 
		$data_customer = array(
			'ID' =>  intval($data['ID']),
			'user_id' => $current_user->ID,
			'full_name' => sanitize_text_field($data['fullname']),
			'phone' => sanitize_text_field($data['phone']),
			'email' => sanitize_text_field($data['email']),
			'address' => sanitize_text_field($data['address']),
			'gender' => sanitize_text_field($data['gender']),
			'province_id' => sanitize_text_field($data['province_id']),
			'district_id' => sanitize_text_field($data['district_id']),
			'ward_id' => sanitize_text_field($data['ward_id']),
			'date_updated' => current_time( $type='mysql', $gmt = true),
		);
		
		//wp_send_json_success(array('success'=>0, 'return'=>$return, $data_customer)); 
		
		
		if($re_password !== '' && $password !== ''){
			if(md5($password) == $current_user->user_pass){
				$data_user = array(
					'ID' =>  intval($data['user_id']), 
					'user_pass'  =>$password, 
				); 
				if($password !== ''){
					if($re_password !== '' && ($re_password == $newpassword) ){ 
						 
						$userID = create_update_wp_user($data_user); 
						
						if (!$userID){ 
							$return['text'] =  'Email hoặc tên người dùng đã tồn tại, vui lòng chọn địa chỉ mail khác!.'; 
							$return['status'] = 'success';  

						}
						else{ 
							$return['text'] =  'Đã cập nhật mật khẩu, vui lòng kiểm tra Email!.'; 
							$return['status'] = 'success';
						} 
					}else{
						$return['text'] =  'Mật khẩu mới không khớp với nhau!.'; 
						$return['status'] = 'danger';
					}  
				}
			}else{
				$return['text'] =  'Mật khẩu cũ không đúng!.'; 
				$return['status'] = 'danger'; 
			}
			
		}else{ 
			$success = $wpdb->update($wpdb->prefix.'customer', $data_customer, $where = array('ID'=>$data_customer['ID']));  
			$return['text'] =  'Cập nhật thông tin thành công.';
			$return['status'] = 'success';  
		} 
		
     } else{
		$return['text'] =  'Mật khẩu cũ không đúng!.'; 
		$return['status'] = 'danger';
	}
	wp_send_json_success(array('success'=>0, 'return'=>$return, $data_customer)); 
	die();
}
add_action('wp_ajax_ajax_update_UserProfile', 'ajax_update_UserProfile'); // wp_ajax_{action}
add_action('wp_ajax_nopriv_ajax_update_UserProfile', 'ajax_update_UserProfile'); // wp_ajax_nopriv_{action}

function ajax_create_Customer( ) {
    
    global $wpdb, $current_user,$CMS_CUSTOMER, $FREE_COUPON, $SFAPI;
	require_once( ABSPATH . WPINC . '/user.php');
    require_once( ABSPATH . WPINC . '/registration.php');

	$plugin_dir = ABSPATH . 'wp-content/plugins/commerce-cms/';		
	include_once($plugin_dir.'api/sf_api.php');	    
	


	$data = $_POST['customer'];
	
	$password = sanitize_text_field($data['password']);
	$re_password = sanitize_text_field($data['re_password']);
	
	$return = array('text'=>'', 'status'=>''); 
	
	if($password == $re_password  ){
		
		$data_user = array(
			//'ID' =>  intval($data['user_id']),
			'user_login' =>  sanitize_text_field($data['email']),
			'user_url'   =>  get_bloginfo('url'),
			'user_pass'  =>  $password,
			'display_name' => sanitize_text_field($data['fullname']),
			'user_email' => sanitize_text_field($data['email']),
			'user_activation_key' => md5(sanitize_text_field($data['email'])),
		);  
		if ($data_user['user_email'] !== ''){
			
			$SF_API = new SF_API();
			$data_pos = [];
			$data_pos['phoneNo'] = preg_replace('/\s+/', '', $data['phone']);
			$data_pos['email'] = sanitize_text_field($data['email']);
			$data_pos['lastname'] = sanitize_text_field($data['fullname']);
			
			//if(!check_user_exists($data_user)){
			$userID = create_wp_user($data_user); 

			$loyalty = 0;

			if ( $userID ) {

				$data_pos['websiteID'] = $userID;

				$res = $SF_API->sendPost('APICheckingAccountWebsite',$data_pos);
				if($res && $res['data']){

					if(!empty($res['data']['membership']) && $res['data']['membership'] == 'true'){
						$loyalty = 1;	
					}

					$data['sf_account'] = $res['data']['accountId'];
					if($res['data']['address']){
						$data['address'] = $res['data']['address'];
					}	
					if($res['data']['provincecode']){
						$province = $wpdb->get_row( "SELECT * FROM {$wpdb->prefix}province WHERE sf_code = {$res['data']['provincecode']} LIMIT 1 ; ");
						if($province) $data['province_id'] = $province->province_id;
					}	
					if($res['data']['districtcode']){
						$district = $wpdb->get_row( "SELECT * FROM {$wpdb->prefix}districts WHERE sf_code = {$res['data']['districtcode']} LIMIT 1 ; ");
						if($district) $data['district_id'] = $district->district_id;						
					}
					if($res['data']['unitcoupons']){
						foreach ($res['data']['unitcoupons'] as $key => $value_unitcoupons) {
							$data_coupons = [];
							$data_coupons['warranty_policy_type'] = $value_unitcoupons['WarrantyPolicyType'];
							$data_coupons['warranty_mileage'] = $value_unitcoupons['WarrantyMileage'];
							$data_coupons['warranty_expired_date'] = date ('Y-m-d H:i:s', strtotime($value_unitcoupons['WarrantyExpiredDate']));
							$data_coupons['warranty_effective_date'] = date ('Y-m-d H:i:s', strtotime($value_unitcoupons->WarrantyEffectiveDate));
							//$data_coupons['service_date'] = date ('Y-m-d H:i:s', strtotime($value_unitcoupons->ServiceDate));
							$data_coupons['mileage'] = $value_unitcoupons['Mileage'];
							$data_coupons['FrameNo'] = $value_unitcoupons['FrameNo'];
							$data_coupons['CouponCategoryLevel'] = $value_unitcoupons['CouponCategoryLevel'];
							$data_coupons['web_user_id'] = $userID;
							$data_coupons['sf_account_id'] = $data['sf_account'];
							//$data_coupons['application_dealer_code'] = $value_unitcoupons['application_dealer_code'];
							$data_coupons['free_coupon_id'] = $value_unitcoupons['imei'];
							$data_coupons['free_coupon_name'] = $value_unitcoupons['WarrantyPolicyType'];
							//$data_coupons['serial_no'] = $value_unitcoupons->serial_no;
							//$data_coupons['applied'] = $value_unitcoupons->applied;
 

							$free_coupon_id = $FREE_COUPON->update_free_coupon($data_coupons);

							$SFAPI->write_log_file_api('update_free_coupon', json_encode($data_coupons), $response= $wpdb->last_query);
						}

					}							
				}
				// wp_send_json_success(array('success'=>0, 'return'=>$res['data']['accountId']));
				// die();

				$creds = array();
				$creds['user_login'] = $data_user['user_login'];
				$creds['user_password'] = $password;
				$creds['remember'] = false; 
				//login
			 	$user = wp_signon( $creds, false ); 
				
				wp_set_auth_cookie($userID); 
				
				$current_user = wp_get_current_user();
				 
				$data_customer = array(
					//'ID' =>  intval($data['ID']),
					'user_id' => $userID,
					'full_name' => sanitize_text_field($data['fullname']),
					'sf_account' => sanitize_text_field($data['sf_account']),
					'phone' => sanitize_text_field($data['phone']),
					'email' => sanitize_text_field($data['email']),
					'address' => sanitize_text_field($data['address']),
					'gender' => sanitize_text_field($data['gender']),
					'province_id' => sanitize_text_field($data['province_id']),
					'district_id' => sanitize_text_field($data['district_id']),
					'ward_id' => sanitize_text_field($data['ward_id']),
					'loyalty' =>  $loyalty,
					'date_updated' => current_time( $type='mysql', $gmt = true),
				);  

				$customer = $CMS_CUSTOMER->get_customer_by_user_ID($user_ID = $userID);

				if($customer){
					$data_customer['ID'] = $customer->ID;
				}

				$cus_ID = false; 
				if(intval($data_customer['ID']) > 0){
					$succ = $wpdb->update($wpdb->prefix.'customer', $data_customer, array( 'ID' => $data_customer['ID'] ));
					$cus_ID = $data_customer['ID'];
					$cus_ID = $userID; // customer_id = user_id
				}
				else{			
					$data_customer['date_created'] = current_time( $type='mysql', $gmt = true );
					$cus_ID = $wpdb->insert($wpdb->prefix.'customer', $data_customer);
					$cus_ID= $wpdb->insert_id;
					$cus_ID= $userID; // customer_id = user_id
				}

				if($cus_ID && $data['address']){
					$data_customer_address = array( 
						// 'ID' =>  intval($data['ID']),
						'customer_id' => $cus_ID, // customer_id = user_id
						'title' => sanitize_text_field($data['title']),
						'full_name' => sanitize_text_field($data['fullname']),
						'phone' => sanitize_text_field($data['phone']),
						'email' => sanitize_text_field($data['email']),
						'address' => sanitize_text_field($data['address']),
						'default_address' =>1,
						'province_id' => sanitize_text_field($data['province_id']),
						'district_id' => sanitize_text_field($data['district_id']),
						'ward_id' => sanitize_text_field($data['ward_id']), 
						'date_updated' => current_time( $type='mysql', $gmt = true),
						'date_created' => current_time( $type='mysql', $gmt = true));
					$wpdb->insert($wpdb->prefix.'customer_address', $data_customer_address);
				}

				$return['text'] =  'Đăng ký thành công.'; 
				$return['status'] = 'success';  
 
			}
			else{
				$return['text'] =  'Email hoặc tên người dùng đã tồn tại, vui lòng chọn Email khác!.';
				$return['status'] = 'danger'; 
			}
	
		 } else{
			$return['text'] =  'Email hoặc tên người dùng không được để trống!.';
			$return['status'] = 'danger'; 
		} 
		
	}else
	{
		$return['text'] =  'Mật khẩu bạn nhập không khớp (Mật khẩu 2 lần nhập phải khớp với nhau.)'; 
		$return['status'] = 'danger';
	} 
	wp_send_json_success(array('return'=>$return, $data));
	die();
}
add_action('wp_ajax_ajax_create_Customer', 'ajax_create_Customer'); // wp_ajax_{action}
add_action('wp_ajax_nopriv_ajax_create_Customer', 'ajax_create_Customer'); // wp_ajax_nopriv_{action}

function ajax_create_Customer_Address( ) {
    
    global $wpdb, $current_user_profile, $current_user;

    require_once( ABSPATH . WPINC . '/registration.php');
	//require_once( ABSPATH . WPINC . '/user.php');
	
	$table_customer = $wpdb->prefix.'customer';
	$tableAddress = $wpdb->prefix.'customer_address';
	
	$data = $_POST['customeraddress']; 
	
	if(!isset($data['customer_id'])){
		echo json_encode(array('success'=>0,'address_ID'=>0));
		exit();
	}
	if(!$current_user){
		$current_user = wp_get_current_user();  
	}
	if(!$current_user_profile){
		$current_user_profile = $wpdb->get_row( "SELECT * FROM {$table_customer} WHERE user_id = {$current_user->ID} LIMIT 1 ; ");
	
	} 
 
		$data_customer_address = array( 
			'ID' =>  intval($data['ID']),
			'customer_id' => $current_user_profile->user_id,
			'title' => sanitize_text_field($data['title']),
			'full_name' => sanitize_text_field($data['fullname']),
			'phone' => sanitize_text_field($data['phone']),
			'email' => sanitize_text_field($data['email']),
			'address' => sanitize_text_field($data['address']),
			'default_address' =>intval($data['default_address']),
			//'gender' => sanitize_text_field($data['gender']),
			'province_id' => sanitize_text_field($data['province_id']),
			'district_id' => sanitize_text_field($data['district_id']),
			'ward_id' => sanitize_text_field($data['ward_id']), 
			'date_updated' => current_time( $type='mysql', $gmt = true));
	
		 $address_ID=0;
	
		if($current_user_profile->ID){
			if(intval($data['default_address']) > 0){ 
				$sqlupdate = "UPDATE `{$tableAddress}` SET `default_address` = 0 WHERE customer_id = {$current_user_profile->user_id} ; ";
				 $wpdb->query($sqlupdate);
			}
			if(intval($data['ID']) > 0  ){
				$data_customer_address['ID'] = intval($data['ID']);
				$success = $wpdb->update($tableAddress, $data_customer_address, array( 'ID' => $data['ID'] ));
			} 
			else{
				$data_customer_address['date_created'] = current_time( $type='mysql', $gmt = true );
				$success = $wpdb->insert($tableAddress, $data_customer_address);
				$address_ID= $wpdb->insert_id;
			} 
			wp_send_json_success(array('success'=>$success,'customer_ID'=>$current_user_profile->user_id,'address_ID'=>$address_ID, 'act'=>$data['action'], $data_customer_address));
		}
		 
      else{
		wp_send_json_success(array('success'=>0,'customer_ID'=>$current_user_profile->user_id,'address_ID'=>$address_ID, 'act'=>$data['action'], $data)); 
	}
    
}
add_action('wp_ajax_ajax_create_Customer_Address', 'ajax_create_Customer_Address'); // wp_ajax_{action}
add_action('wp_ajax_nopriv_ajax_create_Customer_Address', 'ajax_create_Customer_Address'); // wp_ajax_nopriv_{action}
 
function get_list_customer_address($array=true){
	global $wpdb, $current_user_profile, $current_user;
	$table_customer = $wpdb->prefix.'customer';
	$tableAddress = $wpdb->prefix.'customer_address';
	
	if(!$current_user){
		$current_user = wp_get_current_user();  
	}
	$SQL= "";
	if (!$current_user_profile ) {
		$SQL= "SELECT cus.*, p.province_name, d.type_name + ' ' + d.district_name as district_name, w.type_name + ' ' + w.ward_name as ward_name FROM {$table_customer} AS cus LEFT JOIN " . $wpdb->prefix.'province' ." AS p ON (cus.province_id = p.province_id) " .
		" LEFT JOIN " . $wpdb->prefix.'districts' ." AS d ON (cus.district_id = d.district_id AND p.province_id = d.province_id) " .
		" LEFT JOIN " . $wpdb->prefix.'wards' ." AS w ON (cus.ward_id = w.ward_id AND w.district_id = d.district_id) " .
		" WHERE cus.user_id = {$current_user->ID} LIMIT 1 ; ";
		
		$current_user_profile = $wpdb->get_row($SQL ); 
	}
	
	$SQL= "SELECT DISTINCT cus.*, p.province_name, d.type_name + ' ' + d.district_name as district_name, w.type_name + ' ' + w.ward_name as ward_name FROM {$tableAddress} 
	 AS cus LEFT JOIN " . $wpdb->prefix.'province' ." AS p ON (cus.province_id = p.province_id) " .
		" LEFT JOIN " . $wpdb->prefix.'districts' ." AS d ON (cus.district_id = d.district_id AND p.province_id = d.province_id) " .
		" LEFT JOIN " . $wpdb->prefix.'wards' ." AS w ON (cus.ward_id = w.ward_id AND w.district_id = d.district_id) " .
	" WHERE cus.customer_id = {$current_user_profile->user_id} ORDER BY cus.default_address, cus.date_updated DESC; ";
	 
	if($array==true)
		$list_customer_address = $wpdb->get_results($SQL, ARRAY_A);
	else
		$list_customer_address = $wpdb->get_results($SQL);
	 
	return($list_customer_address );
}

function get_ajax_list_customer_address(){
	global $wpdb ; 
	
	$list_customer_address = get_list_customer_address($array==false);
	
	foreach($list_customer_address as $item ) : ?>
		<option value="<?=$item['address']?>" <?=$item->default_address==1?'selected':''?>> <?=$item['address']?></option>
	<?php endforeach; 
}
add_action('wp_ajax_get_ajax_list_customer_address', 'get_ajax_list_customer_address'); // wp_ajax_{action}
add_action('wp_ajax_nopriv_get_ajax_list_customer_address', 'get_ajax_list_customer_address'); // wp_ajax_nopriv_{action}

/**
 * get Province
 */ 
if(!function_exists('get_Province')){

	function  get_Province() {
	    global $wpdb;
	    $dataTable = $wpdb->prefix.'province';

	    $Province = $wpdb->get_results ( "SELECT id, province_id, province_name, sf_code, shipping_fee 
	    	FROM $dataTable ORDER BY province_name ;" ); 
	    return $Province;
	}
}


/**
 * get district
 */  
function ajax_get_district() {
    global $wpdb;
    $dataTable = $wpdb->prefix.'districts';

    $district = $wpdb->get_results ( "SELECT id, district_id, district_name, province_id, type_name FROM $dataTable WHERE province_id = '{$_POST['province_id']}' ORDER BY district_name ;");

    wp_send_json_success($district);
}

add_action( 'wp_ajax_ajax_get_district', 'ajax_get_district' );
add_action('wp_ajax_nopriv_ajax_get_district', 'ajax_get_district');

/**
 * get Ward
 */
add_action( 'wp_ajax_ajax_get_ward', 'ajax_get_ward' );
add_action('wp_ajax_nopriv_ajax_get_ward', 'ajax_get_ward');

function ajax_get_ward() {
    global $wpdb;
    $dataTable = $wpdb->prefix.'wards';

    $wards = $wpdb->get_results ( "SELECT id, ward_id, district_id, ward_name, type_name FROM $dataTable WHERE district_id = '{$_POST['district_id']}'  ORDER BY ward_name ; ");

    wp_send_json_success($wards);
}


function get_customer_address($address_id, $array=true){
	global $wpdb, $current_user_profile, $current_user;
	$table_customer = $wpdb->prefix.'customer';
	$tableAddress = $wpdb->prefix.'customer_address';
	
	if(!$current_user){
		$current_user = wp_get_current_user();  
	}
	  
	$SQL= "SELECT DISTINCT cus.*, p.province_name, d.type_name + ' ' + d.district_name as district_name, w.type_name + ' ' + w.ward_name as ward_name FROM {$tableAddress} 
	 AS cus LEFT JOIN " . $wpdb->prefix.'province' ." AS p ON (cus.province_id = p.province_id) " .
		" LEFT JOIN " . $wpdb->prefix.'districts' ." AS d ON (cus.district_id = d.district_id AND p.province_id = d.province_id) " .
		" LEFT JOIN " . $wpdb->prefix.'wards' ." AS w ON (cus.ward_id = w.ward_id AND w.district_id = d.district_id) " .
	" WHERE cus.ID = {$address_id} ; ";
	 
	if($array==true)
		$customer_address = $wpdb->get_row($SQL, ARRAY_A);
	else
		$customer_address = $wpdb->get_row($SQL);
	
	 $customer_address->query = $SQL;
	return($customer_address );
}

function ajax_get_customer_address(){
	global $wpdb ; 
	$address_id = $_POST['the_id']; 
	 $customer_address = get_customer_address($address_id, $array=false);
	
	wp_send_json_success($customer_address);
}
add_action('wp_ajax_ajax_get_customer_address', 'ajax_get_customer_address'); // wp_ajax_{action}
add_action('wp_ajax_nopriv_ajax_get_customer_address', 'ajax_get_customer_address'); // wp_ajax_nopriv_{action}

function ajax_update_delete_customer_address(){
	 require_once( ABSPATH . WPINC . '/registration.php');
	global $wpdb, $current_user_profile, $current_user;
	$tableAddress = $wpdb->prefix.'customer_address';
	$table_customer = $wpdb->prefix.'customer';
	
	$postfrm = $_POST['postfrm'];
	$action = $postfrm['action'];
	$add_id = $postfrm['the_id'];
	
	$sqlupdate = "";
	
	if(!$current_user){
		$current_user = wp_get_current_user();  
	}
	if(!$current_user_profile){
		$current_user_profile = $wpdb->get_row( "SELECT * FROM {$table_customer} WHERE user_id = {$current_user->ID} LIMIT 1 ; "); 
	} 
	
	if($current_user_profile){
		if($action == 'delete'){
			$sqlupdate = "DELETE FROM `{$tableAddress}` WHERE `ID` = {$add_id} ; ";
			$wpdb->query($sqlupdate);
		}

		if($action == 'set_default'){
			$sqlupdate = "UPDATE `{$tableAddress}` SET `default_address` = 0 WHERE customer_id = {$current_user_profile->user_id} ; "; 
			$wpdb->query($sqlupdate);
			
			$sqlupdate = "UPDATE `{$tableAddress}` SET `default_address` = 1 WHERE `ID` = $add_id ; ";
			
			$wpdb->query($sqlupdate);
		}
	}
	 $postfrm['query'] = $sqlupdate;
	
	wp_send_json_success($postfrm);
}
add_action('wp_ajax_ajax_update_delete_customer_address', 'ajax_update_delete_customer_address'); // wp_ajax_{action}
add_action('wp_ajax_nopriv_ajax_update_delete_customer_address', 'ajax_update_delete_customer_address'); // wp_ajax_nopriv_{action}


function get_customer_list_orders_status($order_status = 1, $limit=100){
	global $wpdb, $current_user_profile, $current_user;
	$table_customer = $wpdb->prefix.'customer';
	$tableAddress = $wpdb->prefix.'customer_address';
	$table_orders = $wpdb->prefix.'orders'; 
	$table_order_details = $wpdb->prefix.'order_details'; 
	
	if(!$current_user){
		$current_user = wp_get_current_user();  
	}
	if(!$current_user){
		return false;  
	}
	if (!$current_user_profile ) {
		$current_user_profile = $wpdb->get_row( "SELECT * FROM {$table_customer} WHERE user_id = {$current_user->ID} LIMIT 1 ; ");
	} 
	$customer_list_orders = $wpdb->get_results( "SELECT o.*, count(d.ID) as item_quantity, SUM(d.sub_total) as totals 
	FROM {$table_orders} AS o
	INNER JOIN {$table_order_details} AS d ON(o.ID = d.order_id) 
	WHERE o.`customer_id` = {$current_user_profile->user_id}  AND o.order_status = {$order_status}   
	GROUP BY d.order_id
	ORDER BY o.`date_updated` DESC LIMIT {$limit}; ", ARRAY_A);
	
	//echo $wpdb->last_query;
	
	return($customer_list_orders );
}

function get_customer_list_orders($limit=1000){
	global $wpdb, $current_user_profile, $current_user;
	$table_customer = $wpdb->prefix.'customer';
	$tableAddress = $wpdb->prefix.'customer_address';
	$table_orders = $wpdb->prefix.'orders'; 
	$table_order_details = $wpdb->prefix.'order_details'; 
	
	if(!$current_user){
		$current_user = wp_get_current_user();  
	}
	if(!$current_user){
		return false;  
	}
	if (!$current_user_profile ) {
		$current_user_profile = $wpdb->get_row( "SELECT * FROM {$table_customer} WHERE user_id = {$current_user->ID} LIMIT 1 ; "); 
	} 

	$customer_list_orders = $wpdb->get_results( "SELECT o.*, count(d.ID) as item_quantity, SUM(d.sub_total) as totals 
	FROM {$table_orders} AS o
	INNER JOIN {$table_order_details} AS d ON(o.ID = d.order_id) 
	WHERE o.`customer_id` = {$current_user_profile->user_id} and o.`parent_id` > 0  
	GROUP BY d.order_id
	ORDER BY o.`date_updated` DESC LIMIT {$limit}; ", ARRAY_A);
	//echo '<script>console.log("'. $wpdb->last_query .'")</script>';
	return($customer_list_orders );
}

function get_order_by_ID($order_id = 0, $arr=true){
	global $wpdb ;
	//$table_customer = $wpdb->prefix.'customer';
	$table_order_details = $wpdb->prefix.'order_details';
	$table_orders = $wpdb->prefix.'orders'; 
	
	$SQL = "SELECT o.*, SUM(d.sub_total) as totals FROM {$table_orders} as o INNER JOIN {$table_order_details} as d ON(o.ID = d.order_id )
	WHERE o.`ID` = {$order_id} and d.`order_id` = {$order_id} 
	GROUP BY d.order_id ; ";
	 
	if($arr) $order = $wpdb->get_row($SQL , ARRAY_A);
	else
	if(!$arr) $order = $wpdb->get_row($SQL);
	//echo '<script>console.log('. json_encode($SQL) .')</script>';
	return($order);
}


function get_customer_list_order_details(){
	global $wpdb, $current_user_profile, $current_user;
	$table_customer = $wpdb->prefix.'customer';
	$table_orders = $wpdb->prefix.'orders'; 
	$table_details = $wpdb->prefix.'order_details'; 
	
	if(!$current_user){
		$current_user = wp_get_current_user();  
	}
	if (!$current_user_profile ) {
		$current_user_profile = $wpdb->get_results( "SELECT * FROM {$table_customer} WHERE user_id = {$current_user->ID} LIMIT 1 ; "); 
		$current_user_profile = $current_user_profile[0];
	} 
	$customer_list_orders = $wpdb->get_results( "SELECT DISTINCT d.*, d.post_ID as item_id, o.order_status FROM {$table_details} as d
	LEFT JOIN {$table_orders} AS o ON (d.order_id = o.ID )
	WHERE o.customer_id = {$current_user_profile->user_id} ; ", ARRAY_A);
	
	return($customer_list_orders );
}

function get_customer_list_order_details_status($order_status = 1){
	global $wpdb, $current_user_profile, $current_user;
	$table_customer = $wpdb->prefix.'customer';
	$table_orders = $wpdb->prefix.'orders'; 
	$table_details = $wpdb->prefix.'order_details'; 
	
	if(!$current_user){
		$current_user = wp_get_current_user();  
	}
	if (!$current_user_profile ) {
		$current_user_profile = $wpdb->get_results( "SELECT * FROM {$table_customer} WHERE user_id = {$current_user->ID} LIMIT 1 ; "); 
		$current_user_profile = $current_user_profile[0];
	} 
	$customer_list_orders = $wpdb->get_results( "SELECT DISTINCT d.*, d.post_ID as item_id, o.order_status FROM {$table_details} as d
	LEFT JOIN {$table_orders} AS o ON (d.order_id = o.ID )
	WHERE o.customer_id = {$current_user_profile->user_id} AND (d.sf_status = {$order_status} OR o.order_status = {$order_status}) ; ", ARRAY_A);
	
	return($customer_list_orders );
}

function get_order_details_of_order($order_id = 0){
	global $wpdb, $current_user_profile, $current_user;
	$table_customer = $wpdb->prefix.'customer';
	$table_orders = $wpdb->prefix.'orders'; 
	$table_details = $wpdb->prefix.'order_details'; 
	
	if(!$current_user){
		$current_user = wp_get_current_user();  
	}
	if (!$current_user_profile ) {
		$current_user_profile = $wpdb->get_row( "SELECT * FROM {$table_customer} WHERE user_id = {$current_user->ID} LIMIT 1 ; "); 
	} 
	$SQL="SELECT DISTINCT d.*, d.post_ID as item_id, o.order_status FROM {$table_details} as d
	LEFT JOIN {$table_orders} AS o ON (d.order_id = o.ID )
	WHERE o.customer_id = {$current_user_profile->user_id} AND d.order_id = {$order_id}  ; ";
	
	$customer_list_orders = $wpdb->get_results( $SQL, ARRAY_A);
	
	//echo '<script>console.log('. json_encode($SQL) .')</script>';
	
	$i=0; // ADD SOME FIELDS FOR DEALER INFO
	foreach($customer_list_orders as $it){
		// $customer_list_orders[$i]['product_name'] = get_the_title($it['post_ID']);
		$customer_list_orders[$i]['dealer_phone'] = get_field('phone_number', $it['dealer_id']);
		// $customer_list_orders[$i]['dealer_location'] = get_field('location', $it['dealer_id']);
		// $customer_list_orders[$i]['dealer_code'] = get_field('dealer_code', $it['dealer_id']);
		// $customer_list_orders[$i]['price_format'] = currencyFormat($it['price']);
		// $customer_list_orders[$i]['title_status'] = ORDER_STATUS[$it['sf_status']];
		$i++;
	}
	 
	return($customer_list_orders );
}

function get_order_details_of_order_status($order_id = 0, $order_status = 0){
	global $wpdb, $current_user_profile, $current_user;
	$table_customer = $wpdb->prefix.'customer';
	$table_orders = $wpdb->prefix.'orders'; 
	$table_details = $wpdb->prefix.'order_details'; 
	
	if(!$current_user){
		$current_user = wp_get_current_user();  
	}
	if (!$current_user_profile ) {
		$current_user_profile = $wpdb->get_results( "SELECT * FROM {$table_customer} WHERE user_id = {$current_user->ID} LIMIT 1 ; "); 
		$current_user_profile = $current_user_profile[0];
	} 
	
	$SQL="SELECT DISTINCT d.*, d.post_ID as item_id, o.order_status FROM {$table_details} as d
	LEFT JOIN {$table_orders} AS o ON (d.order_id = o.ID )
	WHERE o.customer_id = {$current_user_profile->user_id} AND d.order_id = {$order_id} AND (d.sf_status = {$order_status}) ; ";
	
	$customer_list_orders = $wpdb->get_results( $SQL, ARRAY_A); 
	
	$i=0; // ADD SOME FIELDS FOR DEALER INFO
	foreach($customer_list_orders as $it){
		$customer_list_orders[$i]['product_name'] = get_the_title($it['post_ID']);
		$customer_list_orders[$i]['dealer_phone'] = get_field('phone_number', $it['dealer_id']);
		$customer_list_orders[$i]['dealer_location'] = get_field('location', $it['dealer_id']);
		$customer_list_orders[$i]['price_format'] = currencyFormat($it['price']);
		$customer_list_orders[$i]['title_status'] = ORDER_STATUS[$it['sf_status']];
		$i++;
	}
	
	return($customer_list_orders );
}

// Insert/Update Order
function update_order_booking(){
	global $wpdb, $current_user_profile, $current_user;
	$thistable = $wpdb->prefix.'orders';
	
	$order_id = intval($_POST['order_id']);
	$data_order = $_POST['dataorder']; 
	$data_order1 = $data_order; 
	
	$data_orderItem = $_POST['dataorderItem'];
	
	$data_invoice = $_POST['dataHoaDon']; 
	
	$postarr = array(
			  'ID' => $order_id,
			  //'order_code' => md5($order_id, true), //length 16 characters 
			  'customer_id' => intval($data_order1['customer_id']), 
			  'order_description'=>sanitize_text_field($data_order1['full_name'] . ' đặt hàng.') ,
			  'order_status' => 0,
			  'order_total' =>$data_order1['order_total'],
			  'payments' => $data_invoice['payments'],
			  'rec_address' => sanitize_text_field($data_order1['receiver_address']),
			  'province_id' => $data_order1['province_id'],
			  'district_id' => $data_order1['district_id'],
			  'ward_id' 	=> $data_order1['ward_id'],
			  'invoice_require' => intval($data_invoice['invoice_require']),
			  'tax_number' => $data_invoice['tax_number'],
			  'company_info' =>  $data_invoice['company_info'],
			  'company_address' =>  $data_invoice['company_address'],
			  'rec_invoice_address' =>  $data_invoice['rec_invoice_address'], 
			  'date_created' => date("Y-m-d H:i:s"),
			  'date_updated' => date("Y-m-d H:i:s"),
			  'voucher' => $data_order1['voucher'],
			);
	// Are we updating or creating?
		 
		$update  = false; 

		if ( ! empty( $postarr['ID'] ) ) {
			if($postarr['ID'] > 0){
				$update = true;
				$order_id = $postarr['ID'];
			} 
		} 
	$insertID=$postarr['ID'];
	if($update  == false){ //insert data 
		$postarr['date_created'] = date("Y-m-d H:i:s");
		$success = $wpdb->insert($thistable, $postarr); 
		$insertID= $wpdb->insert_id;
	}else{ //update data 
		$postarr['date_updated'] = date("Y-m-d H:i:s");
		$success = $wpdb->update($thistable, $postarr, $where=array('ID' => $postarr['ID']));
	}
	/*
	$c_order = new CCMS_ORDER();
	$order_ID = $c_order->update_order($postarr);*/
	
	wp_send_json_success(array('order_id'=>$insertID, 'update'=>$update, $wpdb->last_query, $data_order1, 'dataItems'=>$data_orderItem )); 
	die();
}

add_action('wp_ajax_update_order_booking', 'update_order_booking'); // wp_ajax_{action}
add_action('wp_ajax_nopriv_update_order_booking', 'update_order_booking'); // wp_ajax_nopriv_{action}

function update_sub_order_and_Items($data_order, $data_Items){

	global $wpdb, $current_user_profile, $current_user, $C_ORDER;
	  
	$order_ids =[];
	$order_details_ids =[];
	$order_query =[];

	$total_all = 0;
	$total_paid = 0;
	$discount_all = 0;

	if(intval($data_order['parent_id']) > 0 ){ 
		// UPDATE ORDER & ORDER_DETAILS BIKE
		 
		if(count($data_Items['dealerBike']) > 0){
			$data_order['booktype'] = 'Bike'; 
			foreach($data_Items['dealerBike'] as $dealer_items){
				$data_item = $dealer_items[0];
				$insertID = $C_ORDER->update_single_order($data_order, $data_item['dealer_id']);	
				$order_query[]  = $wpdb->last_query;

				if($insertID > 0 && is_array($dealer_items) && count($dealer_items) > 0){
					
					$totals = 0;
					$paid = 0;
					$discount = 0;
					$promotion_code = '';

					foreach($dealer_items as $data_item){
						$data_item['order_id'] = $insertID;

						if(isset($data_item['promotion_code']) &&  $data_item['promotion_code'] !== ''){
							$promotion_code = $data_item['promotion_code'];
						}

						if(!isset($data_item['discount']) || $data_item['discount'] == ''){
							$data_item['discount'] = 0;
						}
						if(!isset($data_item['sale_off']) || $data_item['sale_off'] == ''){
							$data_item['sale_off'] = 0;
						}
						if(!isset($data_item['deposit']) || $data_item['deposit'] == ''){
							$data_item['deposit'] = 10000;
						}
						$order_ids[] = $insertID;
						$totals = 0;
						$paid = 0;
						$discount = 0;
						$order_details_ids[]  = $C_ORDER->update_single_order_details($data_item);
						$order_query[]  = $wpdb->last_query;

						// UPDATE order_total 

						$discount += floatval($data_item['discount']);
						$discount_all += $discount;

						$totals = floatval($data_item['subtotal']);	

						// FROMOTION
						//$totals = floatval($totals)	- floatval($data_item['sale_off']);
						//$totals = floatval($totals)	- floatval($discount);

						$total_all = $total_all + floatval($totals);
						$paid = floatval($data_item['deposit']) * intval($data_item['quantity']);
						$total_paid += $paid;

						// UPDATE order_total , order_temp='0', promotion_code, ...
						$dataU = [
								'order_total'=> $totals, 
								'paid' => $paid, 
								'discount' =>$discount, 
								'order_temp'=>'0', 
								'promotion_code'=> $promotion_code,
								];

						$C_ORDER->update_order_DATA($insertID, $dataU);

						//$C_ORDER->update_order_total($insertID, $totals, $paid, $discount); 
						// CAP NHAT LAI order_temp='0'
						//$C_ORDER->update_order_temp($order_id=$insertID, $value='0');
					} 
				}  
			}
		} // BIKE

		// UPDATE ORDER & ORDER_DETAILS PCA
		if(count($data_Items['dealerPCA']) > 0 ){
			$data_order['booktype'] = 'PCA'; $n=1;
			foreach($data_Items['dealerPCA'] as $dealer_items){ 

				$insertID = $C_ORDER->update_single_order($data_order, 'pca'.$n);
				$order_query[]  = $wpdb->last_query;
				$order_ids[] = $insertID;				

				if($insertID > 0 && is_array($dealer_items) && count($dealer_items) > 0 ){
										
					$totals = 0;
					$paid = 0;
					$discount = 0;
					$promotion_code = '';

					foreach($dealer_items as $data_item){
						$data_item['order_id'] = $insertID; 

						if(isset($data_item['promotion_code']) &&  $data_item['promotion_code'] !== ''){
							$promotion_code = $data_item['promotion_code'];
						}						

						if(!isset($data_item['discount']) || $data_item['discount'] == ''){
							$data_item['discount'] = 0;
						}
						if(!isset($data_item['sale_off']) || $data_item['sale_off'] == ''){
							$data_item['sale_off'] = 0;
						}
						 					 
						$order_details_ids[] = $C_ORDER->update_single_order_details($data_item);
						$order_query[]  = $wpdb->last_query;
						$totals += floatval($data_item['subtotal']);
						$paid += floatval($data_item['deposit']);
						$discount += floatval($data_item['discount']);
					}
					// UPDATE order_total
					$totals += floatval($data_order['shipping_fee']);

					// FROMOTION
					//$totals = floatval($totals)	- floatval($discount);
					//$totals = floatval($totals)	- floatval($data_item['sale_off']);

					$discount_all += $discount;

					$total_all += floatval($totals);									
					$total_paid += $paid;

					// UPDATE order_total , order_temp='0', promotion_code, ...
						$dataU = [
								'order_total'=> $totals, 
								'paid' => $paid, 
								'discount' =>$discount, 
								'order_temp'=>'0', 
								'promotion_code'=> $promotion_code,
								];

					$C_ORDER->update_order_DATA($insertID, $dataU);

					//$C_ORDER->update_order_total($insertID, $totals, $paid, $discount);
					// CAP NHAT LAI order_temp='0'
					//$C_ORDER->update_order_temp($order_id=$insertID, $value='0');
				}
				$n++;
			}
		}// PCA

		// UPDATE ORDER & ORDER_DETAILS SERIVCE PACKAGE
		if(count($data_Items['dealerPackge']) > 0 ){
			$data_order['booktype'] = 'Package'; $m=1;
			foreach($data_Items['dealerPackge'] as $dealer_items){
				$insertID = $C_ORDER->update_single_order($data_order, 'pk'.$m );
				 $order_query[]  = $wpdb->last_query;
				 $order_ids[] = $insertID;

				if($insertID > 0 && is_array($dealer_items) && count($dealer_items) > 0){
					
					$totals = 0;
					$paid = 0;
					$discount = 0;
					foreach($dealer_items as $data_item){
						$data_item['order_id'] = $insertID; 
						if(!isset($data_item['discount']) || $data_item['discount'] == ''){
							$data_item['discount'] = 0;
						}
						if(!isset($data_item['sale_off']) || $data_item['sale_off'] == ''){
							$data_item['sale_off'] = 0;
						}
						 
						$order_details_ids[] = $C_ORDER->update_single_order_details($data_item);
						$order_query[]  = $wpdb->last_query;
						$totals += floatval($data_item['subtotal']);
						$paid += floatval($data_item['deposit']);
						$discount += floatval($data_item['discount']);
					}
					// UPDATE order_total		
					//$totals += floatval($data_order['shipping_fee']);	

					// FROMOTION
					//$totals = floatval($totals)	- floatval($discount);
					//$totals = floatval($totals)	- floatval($data_item['sale_off']);

					$discount_all += $discount;

					$total_all = $total_all + floatval($totals);					
					$total_paid += $paid;

					// UPDATE order_total , order_temp='0', promotion_code, ...
						$dataU = [
								'order_total'=> $totals, 
								'paid' => $paid, 
								'discount' =>$discount, 
								'order_temp'=>'0', 
								//'promotion_code'=> $promotion_code,
								];

						$C_ORDER->update_order_DATA($insertID, $dataU);

					//$C_ORDER->update_order_total($insertID, $totals, $paid, $discount);
					// CAP NHAT LAI order_temp='0'
					//$C_ORDER->update_order_temp($order_id=$insertID, $value='0');
				} 

				$m++;
			}
		}// PK

		// UPDATE order_total All		
		$C_ORDER->update_order_total($data_order['parent_id'], $total_all, $total_paid, $discount_all);

	} 

	return [
		'order_ids'=>$order_ids, 'order_total_all'=>$total_all ,
		'order_details_ids'=>$order_details_ids, 
		'order_query' =>$order_query]; 
}
 
function update_order_booking_splited(){
	global $wpdb, $current_user_profile, $current_user, $C_ORDER;
	$thistable  = $wpdb->prefix.'orders'; 

	$data_order_full = $_POST['dataOrderFull']; 

	$data_customer = $data_order_full['DATA_CUSTOMER_ORDER'];
	$data_Items = $data_order_full['DATA_ITEM']; 

	$data_order = array(
			  'ID' 					=> 0,
			  'order_temp' 			=> '1',
			  'order_code' 			=> $data_customer['ID'],
			  'customer_id' 		=> intval($data_customer['customer_id']), 
			  'sf_account_id' 		=> sanitize_text_field($data_customer['sf_account']), 
			  'order_description'	=> sanitize_text_field($data_customer['full_name'] .' '. $data_customer['phone'] .' đặt hàng.') ,
			  'order_status' 		=> 1,
			  'order_total' 		=> floatval($data_customer['order_total']),
			  'payments' 			=> sanitize_text_field($data_customer['payments']),
			  'rec_address' 		=> sanitize_text_field($data_customer['receiver_address']),
			  'province_id' 		=> $data_customer['province_id'],
			  'district_id' 		=> $data_customer['district_id'],
			  'ward_id' 			=> $data_customer['ward_id'],
			  'invoice_require' 	=> intval($data_customer['invoice_require']),
			  'tax_number' 			=> sanitize_text_field($data_customer['tax_number']),
			  'company_info' 		=> sanitize_text_field($data_customer['company_info']),
			  'company_address' 	=> sanitize_text_field($data_customer['company_address']),
			  'rec_invoice_address' => sanitize_text_field($data_customer['company_address']),
			  'contact_name' 		=> sanitize_text_field($data_customer['contact_name']), 
			  'contact_phone' 		=> sanitize_text_field($data_customer['contact_phone']), 
			  //'promotion_code' 		=> $data_customer['promotion_code'], 
			  'voucher' 			=> $data_customer['voucher'], 
			  'discount' 			=> floatval(str_replace(".", "", $data_customer['discount'])), 
			  'order_handler' 		=> sanitize_text_field($data_customer['order_handler']), 
			  'shipping_fee' 		=> floatval(str_replace(".", "", $data_customer['shipping_fee'])), 
			  //'booktype' 			=> sanitize_text_field($data_customer['booktype']), 
			  'sf_order_id' 		=> sanitize_text_field($data_customer['sf_order_id']), 			   
			  'date_created' 		=> date("Y-m-d H:i:s"),
			  'date_updated' 		=> date("Y-m-d H:i:s"),
			  'parent_id' 			=> 0,
			); 

	$success = -1;  
	$update  = false; 
	$query = [];

	// INSERT-UPDATE DON TONG
	$insertID = $C_ORDER->update_single_order($data_order);
	$query[] = $wpdb->last_query;

	$parent_id = $insertID;
	if($parent_id>0){
		// INSERT-UPDATE DON CON
		$data_order['parent_id'] = $parent_id;
		$success = update_sub_order_and_Items($data_order, $data_Items);
		 
		 // CAP NHAT LAI order_temp='0'
		$C_ORDER->update_order_temp($order_id=$parent_id, $value='0');
		 
		 
		//$query[] = $wpdb->last_query;
	} 

	wp_send_json_success(array(
			'order_id'		=> $insertID, $success,					
			'data_order'	=> $data_order,
			'data_items'	=> $data_Items,
			'query'	=> $query 
		)
	); 

	die(); 
	 
}

add_action('wp_ajax_update_order_booking_splited', 'update_order_booking_splited'); // wp_ajax_{action}
add_action('wp_ajax_nopriv_update_order_booking_splited', 'update_order_booking_splited'); // wp_ajax_nopriv_{action}
 

// Update_order_booking_status (chua dung)
function update_order_booking_status(){
	global $wpdb, $current_user_profile, $current_user;
	$table_order_details = $wpdb->prefix.'order_details';
	$ordertable = $wpdb->prefix.'orders';
	
	$order_id=intval($_POST['order_id']);
	$order_status = intval($_POST['order_status']); 
	
	if($order_id >0)
		$wpdb->update($ordertable, array('order_status'=>$order_status), $where=array('ID' => $order_id));
	  
	$data_orderItemarr = $_POST['dataorderItem'];
	$success = 0;
	$itemid=0;
	for($i=0;$i<count($data_orderItemarr);$i++){
		
		$data_orderItem = $data_orderItemarr[$i];
		
		$itemid=intval($data_orderItem['ID']);
		$item_status = $data_orderItem['sf_status']; 

		$postarr = array(
				'ID' 		=> $itemid,  
			  	'sf_status' => sanitize_text_field($data_orderItem['sf_status']), 
				'date_updated' => current_time( $type='mysql', $gmt = true),  
			);
	 
		if($order_id > 0 && $itemid > 0){ 
			$success += $wpdb->update($table_order_details, $postarr, $where=array('ID' => $postarr['ID'])); 
		}
		
	} 
	wp_send_json_success(array('success'=>$success,'item_id'=>$data_orderItemarr)); 
	die();
}

add_action('wp_ajax_update_order_booking_status', 'update_order_booking_status'); // wp_ajax_{action}
add_action('wp_ajax_nopriv_update_order_booking_status', 'update_order_booking_status'); // wp_ajax_nopriv_{action}
 

// Cancel Order
function cancel_order_booking(){
	
	global $wpdb, $current_user_profile, $current_user;
	$order_detailstable = $wpdb->prefix.'order_details';
	$ordertable = $wpdb->prefix.'orders';
	 
	$success = false;  $order_id = 0;
	$status_cancel = 6;

	if(isset($_POST['order_id'])) {  
		$order_id = $_POST['order_id'];
		$success = $wpdb->update($ordertable, array('order_status'=>$status_cancel), $where=array('ID' => $order_id));
		$success += $wpdb->update($order_detailstable, array('sf_status'=>$status_cancel), $where=array('order_id' => $order_id)); 
	}
	
	wp_send_json_success(array('success'=>$success,'order_ID'=>$order_id)); 
}

add_action('wp_ajax_cancel_order_booking', 'cancel_order_booking'); // wp_ajax_{action}
add_action('wp_ajax_nopriv_cancel_order_booking', 'cancel_order_booking'); // wp_ajax_nopriv_{action}
 
function ajax_get_user_wishlist_count(){   
	wp_send_json_success(get_user_favorites_count($user_id = null, $site_id = null, $filters = null, $html = false)) ;
	die();
}

add_action('wp_ajax_ajax_get_user_wishlist_count', 'ajax_get_user_wishlist_count'); // wp_ajax_{action}
add_action('wp_ajax_nopriv_ajax_get_user_wishlist_count', 'ajax_get_user_wishlist_count'); // wp_ajax_nopriv_{action}

// KIEM TRA DON HANG
function ajax_get_search_order(){	
	$isearch = $_POST['data'] ; 
	$orderdata = array('orderItems'=>array());
	$orderdata = get_order_by_ID($isearch);
	$orderdata['orderItems'] = get_order_details_of_order($isearch);
	 
	wp_send_json_success($orderdata) ;
	die();
}

add_action('wp_ajax_ajax_get_search_order', 'ajax_get_search_order'); // wp_ajax_{action}
add_action('wp_ajax_nopriv_ajax_get_search_order', 'ajax_get_search_order'); // wp_ajax_nopriv_{action}


function write_javascript_add_to_cart($bookType='bike', $ajax_action='insert_cart_item'){
	/*<div class="fa-2x">
  <i class="fas fa-spinner fa-spin"></i>
  <i class="fas fa-circle-notch fa-spin"></i>
  <i class="fas fa-sync fa-spin"></i>
  <i class="fas fa-cog fa-spin"></i>
  <i class="fas fa-spinner fa-pulse"></i>
  <i class="fas fa-stroopwafel fa-spin"></i>
</div>*/
	?> 
<script type="text/javascript">
 
    
$(document).ready(function(){
		DATA_CARD = JSON.parse(localStorage.getItem('booking_cookie'));
		
		var product_item = $('.product_detail_content'); 
	
		var item_id = '<?php echo get_queried_object_id(); ?>', 
			//price = parseInt($('.p-detail-price').attr('data-price')),
			//price_old = parseInt($('.p-detail-price').attr('data-price_old')), 
			//sale_off = parseInt($('.p-detail-price').attr('data-sale_off')), 			
			//product_code = product_item.attr('product_code'), 
			product_type = product_item.attr('data-type'), 
			product_url = product_item.attr('data-url'), 
			the_title = product_item.attr('data-title'), 
			promotion = $promotions, 
			image = $(".product__color .active").attr('data-image'),
			quantity = parseInt($(".p-detail-quantity .quantity").html()) ,
			deposit = parseInt($('.divdeposit').attr('data-value'));
		var subtotal;

		console.log('1870: promotion:');	 
		console.log(promotion);	 

		 /*if(isArray(promotion)){
			 promotion = JSON.stringify(promotion);
		 }*/ 
		if(isNaN(quantity) || quantity=='' || quantity === undefined){ quantity=1;}
 
		//if(color=='' || color == 'undefined'){ color='#333';}
		//if(image=='' || image == 'undefined'){ image='NA';}
		if(isNaN(deposit) || deposit=='' || deposit === undefined){ deposit=0;}
		if(isNaN(sale_off) || sale_off=='' || sale_off == undefined){ sale_off=0;}
		if(isNaN(price_old) || price_old=='' || price_old == undefined){ price_old=0;}
		
		if(product_type=='bike' || product_type =='product'){
			deposit=10000000;
		}
		  
		subtotal = (quantity * price) ;    

		if(deposit>0){
			subtotal =  (quantity * deposit);
		}
		
		$('.btn-add-to-cart').attr("disabled", true); 
		$('.btn-buy-to-cart').attr("disabled", true); 
		  
		$('.divdeposit').hide();
		
		$(document).on('click', ".btn-add-to-cart", function(e) {
            e.preventDefault();  
			checkDealerAddToCart(); 
    });
		
	$(document).on('click', ".btn-buy-to-cart", function(e) {
        e.preventDefault();
        var redirect = checkDealerAddToCart();
        if (redirect)
			setTimeout(function(){window.location.href='<?=get_site_url()?>/booking/';}, 200);
    }); 

    function checkDealerAddToCart(){
		var item_index = -1;
		DATA_CARD = JSON.parse(localStorage.getItem('booking_cookie'));
		 
		image = $(".product__color .active").attr('data-image');
		quantity = parseInt($(".p-detail-quantity .quantity").html());


		if(isNaN(quantity) || quantity=='' || quantity === undefined){ quantity=1;} 

		subtotal = (quantity * price) ; 

		if(product_type==='bike' || product_type ==='product'){
			if(deposit === 0) deposit=10000000;
		} 

		if(deposit>0){
			subtotal =  (quantity * deposit);
		}

		data = { 
				item_id: item_id,
				product_type: product_type,
				product_code: product_code,
				product_url: product_url,
				the_title: the_title,
				promotion: promotion,
				quantity: quantity,
				price: price,
				price_old: price_old,
				sale_off: sale_off,
				deposit: deposit,
				subtotal: subtotal,
				dealer_address: dealer_address,
				dealer_id: dealer_id,
				dealer_name: dealer_name, 
				color: color,
				color_code: color_code,
				color_name: color_name,
				image: image,
				size: size,
				size_name: size_name,
				size_code: size_code,
				promotion_code: promotion_code
		};
		console.log('data INIT:');
		console.log(data);
					
		if(DATA_CARD != null && DATA_CARD.length > 0 && dealer_id !=''){
			item_index = DATA_CARD.findIndex(x => (x.dealer_id === dealer_id ));
		}
	 
		if(dealer_id==''){ 
			showPopup('<div class="colorRed fnt-20 text-center pt40 pb40">Vui lòng chọn Đại lý!</div>  ', el=$('.popup_content'));
			setTimeout(function(){hidePopup(); },4000); 
			$('#dealerSelect').focus(); return false;
		}
		else {  
			if( DATA_CARD != null && DATA_CARD.length > 0 && item_index < 0){
				showPopup('<div class="colorDark fnt-18 text-center pt20 pb40"><h4 class="colorDark fnt-oswald fnt-22 pb20">Thông báo:</h4><p>Hiện tại hệ thống kiểm tra có 2 đơn hàng khác đại lý. Thời gian xử lý 2 đơn hàng khác nhau và lâu hơn.</p></div> <button type="button" id="btnBack" class="btn-clip btn-red btn-small">Quay lại</button> <button type="button" id="btnNext" class="btn-clip btn-border-red btn-small">Tiếp tục</button>', el=$('.popup_content'));
				$('#btnBack').click(function(){hidePopup(); return false; });
				$('#btnNext').click(function(){
					hidePopup();
					addToCard(data); 
					return true;
				});
				return false;
			}else{
				addToCard(data);
			} 
		}
		return true;
	}
	
	
 });

	
function addToCard(data){
	var old_data = JSON.parse(localStorage.getItem('booking_cookie'));
	if(old_data){
		console.log(old_data);

		var item_index = -1;

		// PCA...
		if(data.product_type === 'item' || data.product_type === 'apparel' || data.product_type === 'PCA'){
 
			if(data.color_name !== undefined && data.color_name !==''){ data.the_title += ', màu ' + data.color_name ; }
			if(data.size !== undefined && data.size !==''){ data.the_title += ', size ' + data.size ; } 

			item_index = old_data.findIndex(x => (x.item_id === data.item_id && x.dealer_id === data.dealer_id && x.color === data.color && x.size === data.size));

		}
		// XE
		if(data.product_type === 'product' || data.product_type === 'Bike'){

			if(data.color_name !== undefined && data.color_name !==''){ data.the_title += ', màu ' + data.color_name ; }

			item_index = old_data.findIndex(x => (x.item_id === data.item_id && x.dealer_id === data.dealer_id && x.color === data.color ));
		} 
		// SERVICE PACKAGE
		if(data.product_type === 'package' || data.product_type === 'service'){
			item_index = old_data.findIndex(x => (x.item_id === data.item_id && x.dealer_id === data.dealer_id ));
		}
		 
		if(item_index == -1){
			old_data.push(data);
			cart_count =parseInt(cart_count) + 1; 
		}else{
			old_data[item_index].quantity = (parseInt(old_data[item_index].quantity) + 1) + '';
			var subtotal = (parseInt(old_data[item_index].quantity) * parseInt(old_data[item_index].price)) ; 
			if(parseInt(old_data[item_index].deposit) > 0 ){
				subtotal = parseInt(old_data[item_index].quantity) * parseInt(old_data[item_index].deposit);
			}
			if(parseInt(old_data[item_index].sale_off) > 0 ){
				subtotal = subtotal - parseInt(old_data[item_index].sale_off) ;
			}
			old_data[item_index].subtotal = subtotal ;
		}
		localStorage.setItem('booking_cookie', JSON.stringify(old_data));
	}else{
		cart_count =parseInt(cart_count) + 1;
		localStorage.setItem('booking_cookie', JSON.stringify([data]));
	}
	$(".mcart_count").find('.c_count').html(cart_count).show();
 }
</script>
<?php
}

function write_javascript_update_cart($bookType='apparel', $ajax_action='booking_update_cart'){ 
	?> 
<script type="text/javascript">
	function tinh_tong_cart(){
		var ttotal =0;
		$("li.item-shopping-cart").each(function(){
			var nsub  =  parseInt($(this).attr('data-subtotal'));
			//if(isNaN(nsub)) nsub = 0;
			ttotal += nsub ;
		});
		ttotal +=  get_shipping_fee();

		return ttotal;
	}
    $(document).ready(function() { 
		
		$("button.btn_plus_minus").click(function(e) {
            e.preventDefault(); 
			var current_item_cart = $(this).parents('li.item-shopping-cart') ;
           	//var qty = parseInt(current_item_cart.find($('.p-detail-quantity .quantity')).html());
           	var qty = parseInt(current_item_cart.attr('data-quantity'));
			  
			current_item_cart.attr('data-quantity', qty);
			 
			var item_id =current_item_cart.attr('data-id'),
			dealer_id = current_item_cart.attr('data-dealer-id'),
			product_type = current_item_cart.attr('data-type'),
			deposit = current_item_cart.attr('data-deposit'),
			color = current_item_cart.attr('data-color'),
			size = current_item_cart.attr('data-size'),
			price = parseInt(current_item_cart.attr('data-price')),  
			price_old = parseInt(current_item_cart.attr('data-price-old')),  
			sale_off = parseInt(current_item_cart.attr('data-sale_off')),  
			quantity = qty; //parseInt(current_item_cart.attr('data-quantity')); 

			if(deposit=='' || deposit == undefined){ deposit=0;}
			
			if((product_type =='bike' || product_type =='product') ){
				deposit = deposit==0 ? 10000000 : deposit;
				deposit = parseInt(deposit); 
			}

			if(qty<1)qty = 1;
			
			if((product_type =='bike' || product_type =='product' || product_type =='package') ){
				return false;
			} else{
				if($(this).hasClass('btn-mins')){
					if(qty>1)qty--;
				}
				else if($(this).hasClass('btn-plus')){
					if(qty<99)qty++;
				}
			}

			current_item_cart.attr('data-quantity', qty);

			quantity = qty;

			var subtotal = (quantity * price) ;  
			 
			if(deposit > 0){
				subtotal =  (quantity * deposit);
			}
			current_item_cart.attr('data-subtotal', subtotal);
			
			current_item_cart.find($(".item-price.subtotal .price")).text( currency_format(subtotal, '₫'));
			
			// TINH TONG
 
			$(".total-price.total-order").text(currency_format(tinh_tong_cart()));

			var item = {"item_id": item_id, "product_type": product_type, "color": color, "size": size, "dealer_id": dealer_id, "quantity": quantity, "price":  price, "subtotal":subtotal, "price_old":  price_old, "sale_off" : sale_off, "deposit" :deposit }

			//booking_items.push(item); 
			   
			console.log(item); 
			
			updateCard_Item(item);
			 
        });
		
    });
	
function updateCard_Item(data){ 
	var old_data = JSON.parse(localStorage.getItem('booking_cookie'));
	if(old_data){
		var item_index = old_data.findIndex(x => (x.item_id === data.item_id && x.dealer_id === data.dealer_id && x.color === data.color && x.size === data.size)); // Apparel
		// XE
		if(data.product_type == 'product' || data.product_type == 'bike'){
			item_index = old_data.findIndex(x => (x.item_id == data.item_id && x.dealer_id == data.dealer_id && x.color == data.color ));
		} 
		// SERVICE PACKAGE
		if(data.product_type == 'package' || data.product_type == 'service'){
			item_index = old_data.findIndex(x => (x.item_id == data.item_id && x.dealer_id == data.dealer_id ));
		}
		//alert(data.product_type);
		if(item_index>=0){
			//alert('new: '+data.quantity + ' old: '+old_data[item_index].quantity);
			old_data[item_index].quantity = data.quantity;
			old_data[item_index].subtotal = data.subtotal ;
			console.log(old_data[item_index]);
			localStorage.setItem('booking_cookie', JSON.stringify(old_data));
			
		}
		DATA_CARD = old_data;
		DATA_CARD = sort_DATA_CART(DATA_CARD);

		console.log(old_data);
	}
}

function update_Promotion_ToCart(data_cart, data_promotion){

	console.log('Line: 2124: Begin update_Promotion_ToCart...');
	console.log(data_cart);

	$.each(data_promotion, function(index, promotion_item){
		//alert(promotion_item.discount);

		if(promotion_item.record_type.toLowerCase() === 'bike' || promotion_item.record_type.toLowerCase() === 'product'){
			var item_index = data_cart['dealerBike'].findIndex(x =>(x.product_code == promotion_item.product_code && x.color_code === promotion_item.color_code ));
			//alert(item_index);
			if(item_index >=0){				
				var cart_item = data_cart['dealerBike'][item_index];
				console.log({'cart_itemBike':cart_item});

				var amount = 0;
				//alert(data_cart[item_index].product_code);
				amount = (promotion_item.discount * cart_item.price)/100;
				//alert(amount);
				if(amount > 0){
					cart_item.price_old = cart_item.price;
					cart_item.price -= amount;
					cart_item.sale_off = amount;					
					cart_item.subtotal -= amount * cart_item.quantity;
					data_cart['dealerBike'][item_index] = cart_item;
				} 
			}

		}
		if(promotion_item.record_type.toLowerCase() === 'pca' || promotion_item.record_type.toLowerCase() === 'item'){

			$.each(data_cart['dealerPCA'], function(index, cart_items){
				var item_index = cart_items.findIndex(x =>(x.product_code === promotion_item.product_code ));
 
				if(item_index >=0){

					var cart_item = data_cart['dealerPCA'][index][item_index];
					console.log({'cart_itemPCA':cart_item});

					var amount = 0;
					//alert(data_cart[item_index].product_code);
					amount = (promotion_item.discount * cart_item.price)/100;
					//alert(amount);
					if(amount > 0){
						cart_item.price_old = cart_item.price;
						cart_item.price -= amount;
						cart_item.sale_off = amount;
						cart_item.subtotal -= amount * cart_item.quantity;
						data_cart['dealerPCA'][index][item_index] = cart_item;
					} 
				} 

			});
			
		}		 
			
	});

	console.log('Line: 2254: End update_Promotion_ToCart...');
	console.log(data_cart);

	return data_cart;

}

 function removeToCard(data){
	var old_data = JSON.parse(localStorage.getItem('booking_cookie'));
	if(old_data){
		var item_index = old_data.findIndex(x => (x.item_id === data.item_id && x.dealer_id === data.dealer_id && x.color === data.color && x.size === data.size)); // Apparel
		// XE
		if(data.product_type == 'product' || data.product_type == 'bike'){
			item_index = old_data.findIndex(x => (x.item_id === data.item_id && x.dealer_id === data.dealer_id && x.color === data.color ));
		} 
		// SERVICE PACKAGE
		else if(data.product_type == 'package' || data.product_type == 'service'){
			item_index = old_data.findIndex(x => (x.item_id === data.item_id && x.dealer_id === data.dealer_id ));
		}

		if(item_index >= 0){		
			old_data.splice(item_index, 1);
		}
		localStorage.setItem('booking_cookie', JSON.stringify(old_data));
		cart_count = old_data.length;
	}
	if(cart_count>0){
		 $(".mcart_count").find('.c_count').html(cart_count).show();
		 $(".total-price.total-order").text(currency_format(tinh_tong_cart()));
	 }else {
	 	$(".mcart_count").find('.c_count').html(cart_count).hide();
	 	window.location.href = '<?=get_site_url()?>/apparels/';
	 }

	
 }

</script>
<?php
}	

function write_javascript_render_booking_data(){ 
	?> 
<script type="text/javascript">

DATA_CARD = JSON.parse(localStorage.getItem('booking_cookie'));
DATA_CARD = sort_DATA_CART(DATA_CARD);
DATA_CARD_SPLITED = split_Items_By_Product_Type(DATA_CARD);
	
function render_booking_data(Booking_Table = $('#Booking_Table'), Booking_Items = $('#Booking_Items') ){
	var section_total = '';
	 
	var total = 0 ;
	
	if(DATA_CARD) {
		if(DATA_CARD.length >= 1){ 
			DATA_CARD = sort_DATA_CART(DATA_CARD);

			$.each(DATA_CARD,function(index, item)
			{   //alert(item.item_id);
				Booking_Items.append(render_CartItem(item));
				total += parseFloat(item.subtotal);
			}); 

			section_total = '<div class="box-bottom-form section_total_order pr80" >';
			section_total += '	<div class="row">';
			section_total += '		<div class="col-md-8 col-12"></div>';
			section_total += '			<div class="col-md-4 col-12 box-bottom-form item-cart-total-box total-order">';
			section_total += '			<p class="fnt-oswald fnt-26">Tổng tiền</p>';
			section_total += '			<p class="fnt-oswald total-price total-order fnt-26 red" >'+currency_format(total)+'</p> ';
			section_total += '		</div> ';
			section_total += '	</div>';
			section_total += '</div>'; 

			Booking_Table.append(section_total);
	 	} 
	} 
}

function render_CartItem(Data_Item){
	var strItem = '<li class="box-shadow01rem item-shopping-cart" data-type="@datatype" data-id="@dataID" data-quantity="@quantity" data-deposit="@deposit" data-price="@price" data-price-old="@price_old" data-sale_off="@sale_off" data-subtotal="@subtotal" data-dealer-id="@dealer_id" data-color="@color" data-size="@size"> ';
	 
	strItem += '<div class="row">';
	// Hinh Anh
	strItem += '<div class="col-md-2 col-2 align-self-center align-items-center item-cart-img">';
	strItem += '<a href="@permalink" class="product-link" >';
	strItem += '<img src="@image; ?>" class="box-img lazyload" /></a>';
	strItem += '</div>';
	
	
	strItem += '<div class="col-md-7 col-7 d-lg-flex align-self-center align-items-center item-cart-detail-box">';
	strItem += '	<div class="d-lg-flex col-lg-12 col-12 align-items-center align-self-center item-cart-info-box justify-content-between" >';
	
	// Title - Dealer
	strItem += '<div class="col-md-8 col-12 align-self-center align-items-center item-cart-detail-info" > ';
	strItem += '<p class="fnt-oswald fnt-18">@the_title</p>'; // Title Sản Phẩm
	strItem += '<p class="showroom dealer">@dealer_name</p>'; // Đại lý
	strItem += '<p class="saleofftext">@promotion</p>'; // Khuyến mãi
	strItem += '</div>';


	strItem = strItem.replace('@datatype', Data_Item.product_type);
	strItem = strItem.replace('@dataID', Data_Item.item_id);
	strItem = strItem.replace('@quantity', Data_Item.quantity);
	strItem = strItem.replace('@price', Data_Item.price);
	strItem = strItem.replace('@price_old', Data_Item.price_old);
	strItem = strItem.replace('@sale_off', Data_Item.sale_off);
	strItem = strItem.replace('@deposit', Data_Item.deposit);
	strItem = strItem.replace('@dealer_id', Data_Item.dealer_id);
	strItem = strItem.replace('@dealer_name', Data_Item.dealer_name);
	strItem = strItem.replace('@dealer_address', Data_Item.dealer_address);
	strItem = strItem.replace('@image', Data_Item.image);
	strItem = strItem.replace('@permalink', Data_Item.product_url);
	strItem = strItem.replace('@subtotal', Data_Item.subtotal); 
	strItem = strItem.replace('@the_title', Data_Item.the_title);
	
	strItem = strItem.replace('@color', Data_Item.color);
	strItem = strItem.replace('@size', Data_Item.size);
	
	if(Data_Item.promotion != null && isArray(Data_Item.promotion) ){
		var $promotion = JSON.parse(JSON.stringify(Data_Item.promotion));
		 
		var $str = '';
		$.each($promotion, function( index, value ) {
			$str += '<li class="colorRed fnt-12" style="padding-left:0px; list-style:disk !important;">' + value.promotion_item + '</li>'; 
		});
		strItem = strItem.replace('@promotion', '<ul class="colorRed">'+$str+'</ul>');
	}else if(Data_Item.promotion != null && Data_Item.promotion != false){
		strItem = strItem.replace('@promotion', '<div class="colorRed fnt-12">'+Data_Item.promotion+'</div>');
	} else{strItem = strItem.replace('@promotion', '');}
	
	// Gia
	strItem += '<div class="col-md-4 col-12 align-self-center price item-cart-detail-price pr80 " > '; 
	
	if(Data_Item.product_type == 'bike' || Data_Item.product_type == 'product'){
		if(parseInt(Data_Item.deposit)>0){
			strItem += '<p class="fnt-oswald fnt-20"><span class="price">'+currency_format(Data_Item.deposit, 'đ')+'</span></p>';
		}
		strItem += '<p class="deposit">(Giá niêm yết: '+currency_format(Data_Item.price, 'đ')+') </p>';
	} else{
		strItem += '<p class="fnt-oswald fnt-20"><span class="price">'+currency_format(Data_Item.price, 'đ')+'</span></p>';
	}
	if(parseInt(Data_Item.price_old) > 0){
		strItem += '<p class="fnt-oswald"><span class="colorLGray fnt-20 price-old">'+currency_format(Data_Item.price_old, 'đ')+'</span></p>';
	}
	if(parseInt(Data_Item.sale_off) > 0){
		strItem += '<p class="sale_off">giảm giá: ' + currency_format(Data_Item.sale_off, 'đ')+' </p>';
	} 
	
	strItem += '</div>';


	strItem += '</div>';
	strItem += '</div>';
	strItem += '<div class="col-md-3 col-12 align-self-center align-items-center item-cart-detail-box item-cart-detail-box-bottom">';
	strItem += '	<div class="d-lg-flex col-lg-12 col-12 align-items-center align-self-center item-cart-info-box" >';

	// So Luong
	strItem += '<div class="col-md-1 col-6 align-self-center p-detail-quantity item-cart-detail-quantity pt20 pl20"> ';
	strItem += '	<button type="button" class="btn btn-link shadow-none text-decoration-none btn-mins btn_plus_minus">-</button> ';
	strItem += '	<div class="quantity fnt-oswald fnt-20">'+Data_Item.quantity+'</div>';
	strItem += '	<button type="button" class="btn btn-link shadow-none text-decoration-none btn-plus btn_plus_minus">+</button>'; 
	strItem += '</div>';
	// Sub Total							 
	strItem += '<div class="col-md-10 col-6 align-self-center subtotal item-cart-detail-price" >';
	strItem += '	<p class="item-price subtotal fnt-oswald"><span class="price">'+currency_format(Data_Item.subtotal)+'</span></p> ';
	strItem += '</div>';
	
	strItem += ' 		</div> '; 
	strItem += ' 	</div> ';
	
	// row
	strItem += ' </div>';
					
	strItem += ' <div class="item-cart-delete" >';
	strItem += '	<a class="item-cart-delete" href="javascript:void(0);" ><i class="fa fa-times fa-1x colorDark"></i></a> ';
	strItem += '</div> ';
	
	strItem += '</li>';
	
	return strItem;
}
</script>
<?php
}

function write_javascript_render_booking_checkout(){ 
	?> 
<script type="text/javascript">

function render_booking_checkout(Booking_Table = $('#Booking_Table'), Booking_Items = $('#Booking_Items'), data_cart_in, voucher ){
	var section_total = '';
	var section_voucher = '';

	//alert(data_cart_in['dealerBike']);

	var data_cardIN = [];

	if(isArray(data_cart_in['dealerBike'])){
		$.each(data_cart_in['dealerBike'], function(index, items){
			if(isArray(items)){
				$.each(items, function(index, item){
					data_cardIN.push(Object.assign({},item));
				});
			}else{
				data_cardIN.push(Object.assign({},items));
			}
		});
	}
	if(isArray(data_cart_in['dealerPCA'])){
		$.each(data_cart_in['dealerPCA'], function(index, items){
			if(isArray(items)){
				$.each(items, function(index, item){
					data_cardIN.push(Object.assign({},item));
				});
			}else{
				data_cardIN.push(Object.assign({},items));
			}
		});
	}
	if(isArray(data_cart_in['dealerPackge'])){
		$.each(data_cart_in['dealerPackge'], function(index, items){
			if(isArray(items)){
				$.each(items, function(index, item){
					data_cardIN.push(Object.assign({},item));
				});
			}else{
				data_cardIN.push(Object.assign({},items));
			}
		});
	}

	if (data_cardIN.length == 0 ){
		DATA_CARD = JSON.parse(localStorage.getItem('booking_cookie'));
	} else{
		DATA_CARD = data_cardIN;
	}

	//alert(DATA_CARD.length); 

	console.log('begin render_booking_checkout: ');
	console.log(DATA_CARD);

	Booking_Items.html('');
	$('#section_total_order').remove();
	$('#section_voucher').remove();

	//alert(dataOrder['shipping_fee']);
	 
	var  $finaltotal = 0, 
		 $saleoff = 0, 
		 $shipping =  get_shipping_fee(), 
		 $total_order = 0;
	var $vouchercode = (voucher !== undefined) ? voucher : '';
	var $voucherval = 0; 
 
	if(DATA_CARD.length > 0){ 
		DATA_CARD = sort_DATA_CART(DATA_CARD);

		$.each(DATA_CARD,function(index, item)
		{   //alert(item.item_id);
			Booking_Items.append(render_CartItem_checkout(item));
			$total_order += parseFloat(item.subtotal); 
		});

		section_voucher = '<div id="section_voucher" class="box-shadow00rem bgwhite ">' ;
		section_voucher += '	<div class="item-voucher-box align-items-center" data-code="'+$vouchercode+'" data-value="'+$voucherval+'">';
		
		section_voucher += '		<div class="col-12 pd0">';
		section_voucher += '		 	<div class="row">';
		section_voucher += '				<div class=" col-lg-6 col-12 voucher text-left align-seft-bottom" >';
		section_voucher += '					<h5 class="fnt-oswald fw400">MÃ GIẢM GIÁ<h5><div class="clearfix"></div>';

		section_voucher += '					<span class="colorGray small">Điền mã giảm giá của bạn vào ô bên cạnh</span>';
		section_voucher += '				</div>';
		section_voucher += '				<div class=" col-lg-6 col-12 voucher-code text-right align-seft-center">';
 
		section_voucher += '				<input type="text" id="voucher_input" onfocusout="show_button_vourcher()" class="bg_eee border0 text-center fnt-oswald color333 fnt-18 fw600 height40" placeholder="Nhập mã giảm giá" value="'+$vouchercode+'" />';
		section_voucher += '					<div class="mt-2"><button id="btn_check_voucher" onclick="check_and_load_voucher()" class="btn btn-clip btn-red hide fnt-12 pd0" >Kiểm tra</button></div>';

		section_voucher += '					<span class="txtVoucher colorRed small text-right">';
		 
		section_voucher += '					</span>';
		section_voucher += '				</div>';
		section_voucher += '				</div><div class="spacer-20"></div>';

		section_voucher += '	<div class"section_voucher_list" id="section_voucher_list"></div>'  // get_show_voucher_list();

		section_voucher += '		</div>';
		section_voucher += '	</div>';
		section_voucher += '</div>';

		Booking_Table.append(section_voucher); 
		 
		section_total = '<div id="section_total_order" class="box-bottom-form box-shadow01rem bgwhite col-md-12 pr40 pl40 pt20" > ';
		section_total += '		<div class="col-md-12 item-cart-total-box" ><p>Tổng tiền</p>'; 
		section_total += '			<p class="total-price total" data-value="'+$total_order+'"> '+currency_format($total_order)+'</p>';
		section_total += '		</div> ';

		//GIAM GIA
		// section_total += '		<div id="sale_off_section" class="col-md-12 item-cart-total-box sale_off ">';
		// if($saleoff > 0 ){			
		// 	section_total += '			<p>Giảm giá</p>';
		// 	section_total += '			<p class="total-price saleoff" data-value="' + ($saleoff) +'">';
		// 	section_total += '	' + currency_format($saleoff)+'</p>';			
		// }
		// section_total += '		</div> ';

		// SHIPPING FEE
		section_total += '		<div class="col-md-12 item-cart-total-box">';
		section_total += '			<p>Phí vận chuyển</p>';
		section_total += '			<p class="total-price shipping fee" data-value="'+$shipping+'">';
		section_total += '	' + currency_format($shipping)+'</p>';
		section_total += '		</div>';

		//$shipping = dataOrder['shipping_fee'];

		$finaltotal = parseFloat($total_order + $shipping) ;
		//alert(shipping_fee); 
		
		section_total += '		<div class="col-md-12 item-cart-total-box">';
		section_total += '			<p>Thành tiền</p>';
		section_total += '			<p class="total-price f-total" data-value="'+$finaltotal+'">';
		section_total += '	' + currency_format($finaltotal) + '</p>';
		section_total += '		</div>';
		
		section_total += '		<div class="spacer-20"></div>';
		section_total += '		<div class="col-lg-12 pd0 mg0 text-left" style="padding: 0px; margin: 0px;"> ';
		section_total += '			<input type="checkbox" id="chkAgree" checked class="pd0"> <label for="chkAgree">';
		section_total += '	Tôi đồng ý <a href="<?=get_site_url()?>/terms-of-use/" target="_blank" class="blue"><strong>điều khoản và chính sách mua hàng</strong></a> của YMH.</label> ';
		section_total += '		</div>';
				
		section_total += '	</div> ';
		
		Booking_Table.append(section_total);
		
	 } 
}

function get_value_promotion(){
	
	return 0;
}
	
function render_CartItem_checkout(Data_Item){
	var strItem = '<li class="box-shadow00rem item-shopping-cart" data-type="@datatype" data-id="@dataID" data-quantity="@quantity" data-deposit="@deposit" data-price="@price" data-price-old="@price_old" data-sale_off="@sale_off" data-subtotal="@subtotal" data-dealer-id="@dealer_id" data-color="@color" data-size="@size" product_code="@product_code" color_code="@color_code"  size_code="@size_code"> ';
	 
	strItem += '<div class="row">';
	// Hinh Anh
	strItem += '<div class="col-md-3 col-lg-3 col-3 d-lg-flex align-self-center align-items-center item-cart-img ">';
	strItem += '<a href="@permalink" class="product-link" >';
	strItem += '<img src="@image; ?>" class="box-img lazyload" /></a>';
	strItem += '</div>';
	
	
	strItem += '<div class="col-md-9 col-lg-9 col-9 d-lg-flex item-cart-detail-box ">';
	strItem += '	<div class="item-cart-info-box " >'; //cart-info-box
	
	// Title - Dealer
	strItem += '<div class="col-md-6 col-lg-6 col-12 align-self-center item-cart-detail-info pr0" > ';
	strItem += '<p class="title fnt-oswald fnt-18"><span>@the_title</span></p>'; // Title Sản Phẩm
	strItem += '<p class="showroom dealer colorGray">Số lượng : @quantity</p>'; // Đại lý
	strItem += '<p class="showroom dealer colorGray">@dealer_name</p>'; // Đại lý
	//strItem += '<p class="saleofftext">@promotion</p>'; // Khuyến mãi
	strItem += '</div>';
	
	strItem = strItem.replace('@datatype', Data_Item.product_type);
	strItem = strItem.replace('@dataID', Data_Item.item_id);
	strItem = strItem.replace(/@quantity/i, Data_Item.quantity);
	strItem = strItem.replace(/@quantity/i, Data_Item.quantity);
	strItem = strItem.replace('@price', Data_Item.price);
	strItem = strItem.replace('@price_old', Data_Item.price_old);
	strItem = strItem.replace('@sale_off', Data_Item.sale_off);
	strItem = strItem.replace('@deposit', Data_Item.deposit);
	strItem = strItem.replace('@dealer_id', Data_Item.dealer_id);
	strItem = strItem.replace('@dealer_name', Data_Item.dealer_name);
	strItem = strItem.replace('@dealer_address', Data_Item.dealer_address);
	strItem = strItem.replace('@image', Data_Item.image);
	strItem = strItem.replace('@permalink', Data_Item.product_url);
	strItem = strItem.replace('@subtotal', Data_Item.subtotal); 
	strItem = strItem.replace('@the_title', Data_Item.the_title);
	strItem = strItem.replace('@promotion', Data_Item.promotion);
	strItem = strItem.replace('@color', Data_Item.color);
	strItem = strItem.replace('@size', Data_Item.size);
	strItem = strItem.replace('@product_code', Data_Item.product_code);
	strItem = strItem.replace('@color_code', Data_Item.color_code);
	strItem = strItem.replace('@size_code', Data_Item.size_code);

	// Gia
	strItem += '<div class="col-md-6 col-lg-6 col-12 align-self-center item-cart-detail-price text-right pl0" >'; 
	
	if(Data_Item.product_type == 'bike' || Data_Item.product_type == 'product'){
		if(parseInt(Data_Item.deposit)>0){
			strItem += '<p class="item-price fnt-oswald fnt-20"><span class="price">'+currency_format(Data_Item.deposit,  'đ')+'</span></p>';
		}
		strItem += '<p class="deposit">(Giá niêm yết: '+currency_format(Data_Item.price, 'đ')+') </p>';
	} else{
		strItem += '<p class="item-price fnt-oswald fnt-20"><span class="price">'+currency_format(Data_Item.price, 'đ')+'</span></p>';
	}
	if(parseInt(Data_Item.price_old) > 0){
		strItem += '<span class="fnt-oswald colorLGray price-old">'+currency_format(Data_Item.price_old, 'đ')+'</span>';
	}
	// if(parseInt(Data_Item.sale_off) > 0){
	// 	strItem += '<p class="sale_off">giảm giá: '+currency_format(Data_Item.sale_off, 'đ')+' </p>';
	// } 
	
	strItem += '</div>';
	 
	
	//strItem += ' 		</div> '; 	
	//strItem += ' 	</div> '; //cart-info-box
	strItem += ' 	</div> '; 
	strItem += ' 	</div> ';
	
	// row
	strItem += ' </div>';
					
	strItem += ' <div class="item-cart-delete" >';
	strItem += '	<a class="item-cart-delete" href="javascript:void(0);" ><i class="fa fa-times fa-1x colorDark"></i></a> ';
	strItem += '</div> ';
	
	strItem += '</li>';
	
	return strItem;
}
</script>
<?php
}

function load_header_get_formdata(){
	?> 
<script type="text/javascript">
	
	var divloading ='<div class="divloading loading fa-1x" style="top:0;left:0;padding-top:2px;position:absolute;height:100%;width:100%;color:#f38f8f;"><i class="fas fa-circle-notch fa-spin"></div>';
	
    $(document).ready(function() { 
		(function($){
		  $.fn.getFormData = function(){
			var data = {};
			var dataArray = $(this).serializeArray();
			for(var i=0;i<dataArray.length;i++){
			  data[dataArray[i].name] = dataArray[i].value;
			}
			return data;
		  }
		})(jQuery);
	});

function sort_DATA_CART(dataArr){
	if(dataArr){
		if(isArray(dataArr)){
			dataArr.sort(function (a, b) {
			  return b.product_type - a.product_type;
			});
		}
	}
	return dataArr;
}

function split_Items_By_Dealer(dataItems){
	var data_dealer = Array(); 

	if(dataItems.length > 0){
		var temp = dataItems[0];
		var dealTmp = [], dealTmp1 = [];
  
		dealTmp = dataItems.filter(function(array_el){ 
			return temp.dealer_id === array_el.dealer_id;			   
		});
		dealTmp1 = dataItems.filter(function(array_el){ 
			return temp.dealer_id !== array_el.dealer_id;			   
		});

		if(dealTmp.length>0 || dealTmp1.length>0){			
			if(dealTmp.length>0){
				data_dealer.push(dealTmp);					
			}
			if(dealTmp1.length>0){
				data_dealer.push(dealTmp1);					
			} 
		}  
	}else{
		data_dealer = dataItems;
	} 
	return data_dealer;
}
	 
function split_Items_By_Product_Type(dataItems){
 
	var Data_Items = Array(); 

	Data_Items['bike'] = Array(); 
	Data_Items['pca'] = Array(); 
	Data_Items['package'] = Array(); 
 
	// XE
	Data_Items['bike'] = dataItems.filter(function(array_el){
		var prduct_Type = array_el.product_type.toLowerCase(); 
		return prduct_Type ==='bike' || prduct_Type === 'product';
		   
	}); 
	// PCA
	Data_Items['pca'] = dataItems.filter(function(array_el){
		var prduct_Type = array_el.product_type.toLowerCase();  
		return prduct_Type === 'item' || prduct_Type === 'pca';
		   
	});
	// SERVICE PACKAGE
	Data_Items['package'] = dataItems.filter(function(array_el){
		var prduct_Type = array_el.product_type.toLowerCase(); 
		return prduct_Type === 'package' || prduct_Type === 'service';
		   
	}); 

	var newData = {
		'dealerBike' 	: split_Items_By_Dealer(Data_Items['bike']), 
		'dealerPCA' 	: split_Items_By_Dealer(Data_Items['pca']), 
		'dealerPackge'	: split_Items_By_Dealer(Data_Items['package']) 
	}; 

	console.log('Data After Splited:');
	console.log(newData);
 
	return newData;
	
}


var DATA_PROVINCE = <?php echo wp_json_encode(get_Province(), true); ?>;

var dataOrder  ;

var shipping_fee = 0;

function set_shipping_fee(value){ 
	jQuery('.total-price.shipping.fee').html(currency_format(value)); 
	jQuery('.total-price.shipping.fee').attr('data-value', value);  
}

function get_shipping_fee(){ 
	 
	if (dataOrder && dataOrder['province_id']){
		var province_item = DATA_PROVINCE.find(x => x.province_id === dataOrder['province_id']);
		if(province_item){
			shipping_fee = province_item.shipping_fee;
		}
		
		if(shipping_fee === undefined || shipping_fee === 0) shipping_fee = 40000;

		shipping_fee = parseFloat(shipping_fee);
	}
	return shipping_fee;
}

$.extend({ 
	get_AJAX_FUNCTION: function (action = 'ajax_get_promotion_products', dataRequest){ 
	
		var dataResponse = null;

		if(!dataRequest ) {
			return false;
		}

		$.ajax({
	        data: {action: action, dataRequest},
	        type: 'POST',
	        url: ajaxurl, 
	        dataType: "json",
	        async: false,
	        success: function(response) {  
	        	//console.log(response);
	        	dataResponse = response; 
	        },
		    error: function(jqXHR, textStatus, errorThrown) {
		        // When AJAX call has failed
		        console.log('AJAX call failed.');
		        console.log(textStatus + ': ' + errorThrown);
		    },
		    complete: function() {
		        // When AJAX call is complete, will fire upon success or when error is thrown
		        console.log('AJAX call completed');
		    }
	    });
	    return dataResponse;
	}
});

$.extend({
    get_API_CRM: function(action = 'ajax_get_API_DATA_FROM_SF', apiName = 'APICheckVoucher', dataRequest) {
        // local var
        var theResponse = null;
        // jQuery ajax
        $.ajax({
            url: ajaxurl,
            type: 'POST',
            data:{ action: action, 'apiName': apiName, 'dataRequest': dataRequest},
            dataType: "json",
            async: false,
            success: function(respText) {
                theResponse = respText;
            }
        });
        // Return the response text
        return theResponse;
    }
});

function hidden_ecommerce_website(){
	// An menu
	$('.h-menu__item.mnuicon.mwishlist_count').remove();
	$('.h-menu__item.mnuicon.mcart_count').remove();
	$('.h-menu__item.mnuicon.mdk-dn').remove();
	$('.h-menu__item.h-menu__item--submenu.mnuicon').remove();

	$('.h__accordion.user_menu').remove();

	$('#menu_dichvu').remove();

	$('.book-service #button-submit').hide();


	// An button add to cart 
	$('.btn-buy-to-cart').hide();
	$('.btn-add-to-cart').hide();
	$('.simplefavorite-button').hide();

	// An So luong
	$('.p-detail-quantity').hide();

	// An Đại lý
	$('.product-bike-dealer').hide();
	//product-bike-dealer
}
 
jQuery(document).ready(function() {

	<?php if(!is_user_logged_in()) : ?>

	var today = new Date(Date.now());
	var birthday = new Date('2022-03-26 19:59:59'); 

	var ecomday = new Date('2022-04-06 07:59:59'); 

	let timebirthday = birthday.getTime();
	let timetoday = today.getTime();
	let time_ecomday = ecomday.getTime();

	console.log(birthday);
	console.log(today);

	console.log('time birthday: ' + timebirthday);
	console.log('   time today: ' + timetoday);
	 
	// if(timebirthday >= timetoday){ 
	// 	window.location.href='<?php echo get_site_url()?>/homedev/';		 
	// }

	if(time_ecomday >= timetoday){
		//hidden_ecommerce_website();
	}
	<?php endif; ?>	
});

</script>		
<?php
}

function write_javascript_remove_cart($bookType='bike', $ajax_action='remove_booking_item'){
	?> 
<script type="text/javascript">
    $(document).ready(function() { 
        
		$(document).on('click', "a.item-cart-delete", function(e) {
            //e.preventDefault(); 
			//var ind = $(this).index();
			var the_item = $(this).parents('.item-shopping-cart'); 
            var item_id = the_item.attr('data-id');  
            var productype = the_item.attr('data-type');  
			var dealer_id = the_item.attr('data-dealer-id');  
            var color = the_item.attr('data-color');  
            var size = the_item.attr('data-size');  
			
			data = { 
                item_id: item_id,  
                product_type: productype,  
                dealer_id: dealer_id,  
                color: color,  
                size: size,  
				} 
			 
			showPopup('<div class="colorGray fnt-18 text-center mb30">Bạn muốn xóa sản phẩm này ra khỏi giỏ hàng ?</div> <button type="button" value="Đồng ý" id="btnYes" class="btn-clip btn-red btn-small">Đồng ý</button> <button type="button" value="Không" id="btnNo" class="btn-clip btn-border-red btn-small">Không</button>', el=$('.popup_content'));
			
			$('#btnNo').click(function(){hidePopup();});
			
            $('#btnYes').click(function(){
            	the_item.remove();
				removeToCard(data);
				showPopup('<div class="colorRed fnt-18 text-center ">Đã xóa sản phẩm khỏi giỏ hàng!</div>  ', el=$('.popup_content'));
				setTimeout(function(){hidePopup(); },1000);
				 
			} );
			return; 
        });
		
		$(document).on('click', ".btnCancel.Order", function(e) {
            e.preventDefault(); 
            var item_id = 'cancel' ; 
               
            data = { 
                item_id: item_id,  
            } 
			$(this).append(divloading);
            $.ajax({
                url: ajaxurl, // AJAX handler
                data: {
                    'action': 'cancel_order_booking',
                    'order': data
                },
                type: 'POST',
				//dataType: "json",
                success: function(response) {
					console.log(response);
					//alert(response.success );
					$('div.loading').remove();
					$('.booking .h__drawer-list li').remove();
					$('.section_total').remove(); 
					$('#btnNextStep').remove(); 
					$('#btnCancelOrder').remove(); 
					$('#btnNextStep').remove(); 
					$('#btnGoShop').remove(); 
					$(".box-bottom-form.cart_footer").append('<a class="btn-clip btn-border-red" href="<?=get_site_url()?>/bikes/" >TRỞ LẠI CỬA HÀNG</a>');
					$(".cart_count").html('');
                }
            });
        });
    });
</script>
<?php
}

function write_show_menu_accordion(){
	global $wpdb, $ListBookings, $BookingItems, $cart_count, $current_user, $current_user_profile, $wishlist_count;
	
	$table = $wpdb->prefix.'customer';
	
	 $current_user = wp_get_current_user(); 
	if(!$current_user_profile){
		$current_user_profile = $wpdb->get_row( "SELECT * FROM $table WHERE user_id = '{$current_user->ID}'  LIMIT 1 ;");
	}
	  
	$BookingItems = false;
	if(isset($ListBookings['booking_items'] )){
		$BookingItems = $ListBookings['booking_items'] ;
		$cart_count=count($BookingItems);
	}
	$menuitem_user = '';
	$menuitem_icon = '';
	
	$wishlist_count = intval(get_user_favorites_count($user_id = null, $site_id = null, $filters = null, $html = false));
	
	if(is_user_logged_in()){
		$textColor = '#1d1f21';
		if ($current_user->user_activation_key == ''){
			$textColor = '#f70000';
		}
		 $menuitem_wishlist = '<li ><a onclick="javascript:void(0);" href="'.get_site_url().'/user/#wishlist" class="link user-link" title="Danh sách yêu thích."> Danh sách yêu thích ('. $wishlist_count . ') </a></li>';  
		
		$menuitem_user = '<div class="h__accordion user_menu"><div class="h__accordion-item"><a href="'.get_site_url().'/user/#user-info" title="Hồ sơ cá nhân." class="icon_us btn btn__h-accordion user-link" style="color:' . $textColor . '">'.$current_user->display_name.' </a><span class="chevron-right" data-toggle="collapse" data-target="#collapse_h11_'.$current_user->ID.'" aria-expanded="false" aria-controls="collapse_h11_'.$current_user->ID.'"></span></div><div id="collapse_h11_'.$current_user->ID.'" class="collapse"><ul class="h__list">'.$menuitem_wishlist.'<li><a href="'.get_site_url().'/user/#check-order" class="link user-link"> Theo dõi đơn hàng </a></li><li><a href="'.get_site_url().'/user/#history-order" class="link user-link"> Lịch sử đơn hàng </a></li><li><a href="'.get_site_url().'/user/#list-address" class="link user-link"> Sổ địa chỉ </a></li><li><a href="'.get_site_url().'/user/#user-info" class="link user-link"><h5>Hồ sơ cá nhân </a></li><li><a href="'.wp_logout_url( $redirect = ''.get_site_url().'/' ).'" class="link"><h5>Đăng xuất </a></li></ul></div> </div>'; 
		
	}else{   $menuitem_user = ''; 
		  
		$menuitem_user = '<div class="h__accordion user_menu"><div class="h__accordion-item"><a href="javascript:void(1);" class="icon_us btn btn__h-accordion dangky-dangnhap " > Đăng Ký | Đăng Nhập </a> </div></div>'; 
		 
	}
	 
	echo $menuitem_user;
	
} 

// Show Cart Item On menu
function write_javascript_show_menu_wishlist_cart(){
	global $wpdb, $ListBookings, $BookingItems, $cart_count, $current_user, $current_user_profile, $wishlist_count;
	
	$table = $wpdb->prefix.'customer';
	
	 $current_user = wp_get_current_user(); 
	if(!$current_user_profile){
		$current_user_profile = $wpdb->get_row( "SELECT * FROM $table WHERE user_id = '{$current_user->ID}'  LIMIT 1 ;");
	}
	 
	$BookingItems = false;
	if(isset($ListBookings['booking_items'] )){
		$BookingItems = $ListBookings['booking_items'] ;
		$cart_count=count($BookingItems);
	}
	$menuitem_user = '';
	$menuitem_icon = '';
	
	$wishlist_count = intval(get_user_favorites_count($user_id = null, $site_id = null, $filters = null, $html = false));
	
	if(is_user_logged_in()){ 
		/*$menuitem_user = '<li ><a href="'.get_site_url().'/user/#wishlist" class="link" title="Danh sách yêu thích."><h5> Danh sách yêu thích ('. $wishlist_count . ')</h5></a></li>'; 
		$menuitem_user .= '<li ><a href="'.get_site_url().'/booking/" class="link" title="Giỏ hàng."><h5> Giỏ hàng ('. $cart_count . ')</h5></a></li>';*/ 
		
		$menuitem_user = '<li class="h-menu__item h-menu__item--submenu mnuicon us d-lg-flex d-xl-flex d-none "><h6><a href="'.get_site_url().'/user/#user-info" title="Hồ sơ cá nhân." class="link"><i class="fas fa-user"></i>&nbsp; '.$current_user->display_name.'</a></h6> <div class="h-menu__submenu"><ul class="h__list">'.$menuitem_user.'<li><a href="'.get_site_url().'/user/#check-order" class="link"><h5>Theo dõi đơn hàng</h5></a></li><li><a href="'.get_site_url().'/user/#history-order" class="link"><h5>Lịch sử đơn hàng</h5></a></li><li><a href="'.get_site_url().'/user/#list-address"><h5>Sổ địa chỉ</h5></a></li><li><a href="'.get_site_url().'/user/#user-info" class="link"><h5>Hồ sơ cá nhân</h5></a></li><li><a href="'.wp_logout_url( $redirect = ''.get_site_url().'/' ).'" class="link"><h5>Đăng xuất</h5></a></li></ul></div></li>';
		
		$menuitem_icon = '<li class="h-menu__item mnuicon d-lg-flex d-xl-flex d-none mwishlist_count"><a href="'.get_site_url().'/user/#wishlist" title="Danh sách yêu thích." class="link"><h6><span class="wishlist_count" ></span><span class="w_count" data-count="'. $wishlist_count . '">'. $wishlist_count . '</span></h6></a></li>'; 
		$menuitem_icon .= '<li class="h-menu__item mnuicon ltoright mcart_count"><a href="'.get_site_url().'/booking/" title="Giỏ hàng." class="link"><h6><span class="shopping-cart cart_count ic-search" style="mask-image: url('.get_template_directory_uri().'/img/ic_cart.svg); -webkit-mask-image: url('.get_template_directory_uri().'/img/ic_cart.svg)"></span><span class="c_count" data-count="'. $cart_count . '">'. $cart_count . '</span></h6></a></li>';
		
		
		
	}else{   $menuitem_user = '';
		$menuitem_icon = '<li class="h-menu__item mnuicon d-lg-flex d-xl-flex d-none mwishlist_count"><a href="'.get_site_url().'/wishlist/" class="link" title="Danh sách yêu thích."><h6><span class="wishlist_count" ></span><span class="w_count" data-count="'. $wishlist_count . '">'. $wishlist_count . '</span></h6></a></li>'; 
		$menuitem_icon .= '<li class="h-menu__item mnuicon ltoright mcart_count"><a href="'.get_site_url().'/booking/" class="link" title="Giỏ hàng."><h6><span class="shopping-cart cart_count ic-search" style="mask-image: url('.get_template_directory_uri().'/img/ic_cart.svg); -webkit-mask-image: url('.get_template_directory_uri().'/img/ic_cart.svg)"></span><span class="c_count" data-count="'. $cart_count . '">'. $cart_count . '</span></h6></a></li>'; 
		$menuitem_icon .= '<li class="h-menu__item mnuicon mdk-dn us d-lg-flex d-xl-flex d-none "> <h6><a href="javascript:void(1);" class="dangky-dangnhap link" ><i class="fas fa-user"></i>&nbsp;Đăng Ký | Đăng Nhập </a></h6></li>'; 
		 
	}
	
	echo $menuitem_icon; 
	echo $menuitem_user;
?> 
<script type="text/javascript">
	var DATA_CARD = JSON.parse(localStorage.getItem('booking_cookie'));
	DATA_CARD = sort_DATA_CART(DATA_CARD);
 
	var DATA_CARD_SPLITED = split_Items_By_Product_Type(DATA_CARD);

	var wishlist_count = '<?php echo get_user_favorites_count($user_id = null, $site_id = null, $filters = null, $html = false); ?>';
	var cart_count = getCart_count();
	var menuitem = '';
	var	wishlist_loaded = false;
	var	cart_loaded = false; 
	
	$(document).ready(function() {  
		$('.user_menu .user-link').click(function(event){
			$('html, body').animate({scrollTop: '0px'}, 300);
			$('.icon-menu').click();
		})
		
	if(parseInt(cart_count) > 0){
		$(".mcart_count").find('.c_count').attr('data-count', cart_count).html(cart_count);			
	} else{
		$(".mcart_count").find('.c_count').hide();		
	} 
	if(parseInt(wishlist_count) > 0){
		$(".mwishlist_count").find('.w_count').attr('data-count', wishlist_count).html(wishlist_count);			
	} else{
		$(".mwishlist_count").find('.w_count').hide();
	}
	<?php if(is_user_logged_in()){ ?>
		
		if(parseInt(wishlist_count) > 0){
			$(".mwishlist_count").find('.w_count').attr('data-count', wishlist_count).html(wishlist_count);			
		} else{
			$(".mwishlist_count").find('.w_count').hide(); 	
		} 
	<?php }else{ //NOT LOGIN ?>
		if(parseInt(wishlist_count) > 0){
			$(".mwishlist_count").find('.w_count').attr('data-count', wishlist_count).html(wishlist_count);			
		} else{
			$(".mwishlist_count").find('.w_count').hide(); 	
		}
	<?php }  ?> 
		
		$('button.simplefavorite-button.btn-clip.btn-border-red').click(function(){
			//$(this).append(divloading); 
			var ttbtn = $(this);
			var wc = parseInt($(".mwishlist_count").find('.w_count').attr('data-count'));  
			if(ttbtn.hasClass('active')){
				wc --;
				$(".mwishlist_count").find('.w_count').attr('data-count', wc); 
				$(".mwishlist_count").find('.w_count').html(wc);
			} else{ 
				wc++;
				$(".mwishlist_count").find('.w_count').attr('data-count', wc);
				$(".mwishlist_count").find('.w_count').html(wc);
			} 
			$.ajax({
				url: ajaxurl, // AJAX handler
				data:{'action': 'ajax_get_user_wishlist_count'},
				type: 'POST',
				//dataType: "json",
				success: function(response) {
					console.log(response); 
					var cc = parseInt(response.data); 
				}
			}); 
			
			if(wc > 0){ 
				$(".mwishlist_count").find('.w_count').show();
			}else{
				$(".mwishlist_count").find('.w_count').hide();
			}
		})
	
	});
	function getCart_count(){
		var data_cart = JSON.parse(localStorage.getItem('booking_cookie'));
		if(data_cart){
			if(data_cart.length)
				return data_cart.length;
			else
				return 0; 
		} 
		return 0;
	} 
	function currency_format(val, donvi = 'đ'){
		if(parseInt(val)>0)
            return val.toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ".")+donvi;
		else return '';
	}
	function toggleUserMenu(){

	}
</script>

<?php //}
}  
function get_order_ajax_handler()
{
    //
}

add_action('wp_ajax_get_order', 'get_order_ajax_handler'); // wp_ajax_{action}
add_action('wp_ajax_nopriv_get_order', 'get_order_ajax_handler'); // wp_ajax_nopriv_{action}

function currencyFormat($number){
	$currency = '₫';
	$numberConvert = '0'.$currency;
	if($number){
		$numberConvert = number_format($number,0,'','.').$currency;
	}
	return $numberConvert;
}

function megapay_process(){
	global $wpdb ;
	$ordersTable = $wpdb->prefix.'orders';
	include(WP_PLUGIN_DIR.'/commerce-cms/api/megapay/Payment.php');
	include(WP_PLUGIN_DIR.'/commerce-cms/api/megapay/tripleDES.php');
    // include('megapay/Payment.php');
    // include('megapay/tripleDES.php');

    // $data = file_get_contents('php://input');
    // $requestObj = json_decode($data, true);
    $requestObj = $_POST ;
    // echo json_encode($requestObj);die;

    if($requestObj == null) {
    	echo json_encode(array('success' => false, 'mes' => 'Invalid request data!'));
    }

    $amount = '';
    $payOption = '';
    $userId = "";
    $orderId = "";
    $customerId = "";

    if(array_key_exists("orderId", $requestObj) && !empty($requestObj['orderId'])){
	    $orderId = $requestObj['orderId'];
    } else {
    	echo json_encode(array('success' => false, 'mes' => 'Invalid orderId: '.$orderId));
    	exit();
    }
    
	$current_order = $wpdb->get_results( "SELECT * FROM $ordersTable WHERE ID = '$orderId' LIMIT 1");

	if ( ! empty( $current_order ) ) {
		if(isset( $current_order[0]->order_total))
			$amount = $current_order[0]->order_total;
		if(isset( $current_order[0]->customer_id))
			$customerId = $current_order[0]->customer_id;
	} 
    if(!$amount){
	    echo json_encode(array('success' => false, 'mes' => 'Invalid amount: '.$amount));
	    exit();
    }

    if(array_key_exists("payOption", $requestObj) && !empty($requestObj['payOption'])){
	    $payOption = $requestObj['payOption'];
    }

    $payment = new Payment();
	

    $timeStamp = date('YmdHis');
    $merTrxId = 'MERTRXID'.$timeStamp.'_'.$orderId.'_'.rand(100,10000);
    $invoiceNo = 'Order_'.$timeStamp.'_'.$orderId.'_'.rand(100,10000);
    $description = 'TT Hoa Don: ' . $invoiceNo;

	$plainTxtToken = $timeStamp . $merTrxId . $payment::MER_ID . $amount . $payment::ENCODE_KEY;
    // echo $plainTxtToken;die();
	$token = hash('sha256', $plainTxtToken);

	$data_payment_history = array(
		'customer_id' => $customerId,
		'order_id' => $orderId,
		'description' => $description,
		'amount' => $amount,
		'merchantToken' => $token,
		'merId' => $payment::MER_ID,
		'invoiceNo' => $invoiceNo,
		'merTrxId' => $merTrxId,
		'date_updated' => current_time( $type='mysql', $gmt = true),
		'date_created' => current_time( $type='mysql', $gmt = true),
	);  
	// echo json_encode($data_payment_history);exit();
		
	$data_insert = $wpdb->insert($wpdb->prefix.'payment_history', $data_payment_history);
	$ID= $wpdb->insert_id;
	if($ID){
		$result = json_encode(array('success' => true, 'description' => $description, 'amount' => $amount, 'merchantToken' => $token, 'timeStamp' => $timeStamp, 'merId' => $payment::MER_ID, 'invoiceNo' => $invoiceNo, 'merTrxId' => $merTrxId, 'domain' => $payment::DOMAIN)); 
		echo $result;
	}
	// wp_send_json_success([$data_insert,$data_payment_history,$wpdb->last_query]);
	// // echo $ID;
	// exit();
    exit();
}
 

add_action('wp_ajax_megapay_process', 'megapay_process'); // wp_ajax_{action}
add_action('wp_ajax_nopriv_megapay_process', 'megapay_process'); // wp_ajax_nopriv_{action}	 


?>
 