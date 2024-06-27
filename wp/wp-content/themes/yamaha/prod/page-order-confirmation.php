<?php
/**
 * @author Bao
 * created Date: 26/01/2022
 * project: yamaha-revzone-website
 *
 * Template Name: Order confirmation
 *
 */
get_header(); 
global $C_ORDER, $current_user, $current_user_profile;

if ( ! class_exists( 'CCMS_ORDER' ) ) {
	require_once CCMS_ABSPATH . '/includes/class-ccms-order.php';
}

$customer_list_orders = get_customer_list_orders_status($order_status = 1, $limit=999);
send_email_order_to_customer($current_user->user_email, $customer_list_orders);

?>

<div class="navigator__breadcrumbs">
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo wp_get_referer() ?>"><i class="fas fa-chevron-left"></i>&nbsp; Quay lại</a></li>
            </ol>
        </nav>
    </div>
</div>

<?php if (isset($_GET['order_id']) || isset($_GET['merTrxId'])): 
            $order_id = '';
            if(isset($_GET['merTrxId'])){
                $result = $_GET;
                $plugin_dir = ABSPATH . 'wp-content/plugins/commerce-cms/';
                include($plugin_dir.'api/megapay/Payment.php');
                $payment = new Payment();

                // verify merchantToken
                $check = $payment->checkToken($result);
                $error = '';
                if (!$check) {
                    $error = 'Invalid Merchant Token';
                }   

                global $wpdb ;
                $payment_historyTable = $wpdb->prefix.'payment_history';
                if(array_key_exists("merTrxId", $result)) {
                    $str = "SELECT * FROM $payment_historyTable WHERE merTrxId ='". $result['merTrxId'] ."' LIMIT 1";
                    $payment_history = $wpdb->get_results( $str);
                    // var_dump($result['merchantToken']);die();
                    if ( ! empty( $payment_history ) ) {
                        $rs = $payment_history[0];
                        if($rs->status == 0){
                            $data_payment_history = array(
                                'ID' => $rs->ID,
                                'trxId' => $result['trxId']??'',
                                'merId' => $result['merId']??'',
                                'merTrxId' => $result['merTrxId']??'',
                                'resultCd' => $result['resultCd']??'',
                                'resultMsg' => $result['resultMsg']??'',
                                'invoiceNo' => $result['invoiceNo']??'',
                                'currency' => $result['currency']??'',
                                'goodsNm' => $result['goodsNm']??'',
                                'payType' => $result['payType']??'',
                                'payToken' => $result['payToken']??'',
                                'userId' => $result['userId']??'',
                                'transDt' => $result['transDt']??'',
                                'transTm' => $result['transTm']??'',
                                'buyerFirstNm' => $result['buyerFirstNm']??'',
                                'buyerLastNm' => $result['buyerLastNm']??'',
                                // 'timeStamp' => $result['timeStamp']??'',
                                'bankId' => $result['bankId']??'',
                                'bankName' => $result['bankName']??'',
                                'cardNo' => $result['cardNo']??'',
                                'date_updated' => current_time( $type='mysql', $gmt = true),
                            );
                            if($error == ''){
                                //ss
                                $data_payment_history['status'] = 1;
                                
                                if(! empty( $rs->order_id )){
                                    $order_id = $rs->order_id;
                                    $order_ID = $wpdb->update($wpdb->prefix.'orders', array('ID'=>$rs->order_id,'order_status'=>'3'), array('ID'=>$rs->order_id));
                                }
                            }else{
                                //error
                                $data_payment_history['status'] = 2;
                            }

                            $payment_historyID = $wpdb->update($wpdb->prefix.'payment_history', $data_payment_history, array('ID'=>$rs->ID));
                        }else{
                            $error = 'Phiên Giao dịch đã hết hạn!';
                            if(! empty( $rs->order_id )){
                                $order_id = $rs->order_id;
                            }
                        }

                    }
                }                
            }
            
        endif; 
   if(isset($_GET['order_id'])) $order_id = $_GET['order_id'];         
?>

<?php 

if ($order_id): 
   		$orders = $C_ORDER->get_order_by_parent_ID($order_id = $order_id, $include_parent = true );
		//print_r($orders[0]);  die();
		if (count($orders)>1):  

			$order_sum = $orders[0]; 
               
            $receiver = json_decode(stripslashes($order_sum->rec_address), true);
?>
<section class="container-fluid status-order-page mb40">
    <div class="mt-4"></div>
    <div class="row justify-content-center">
        <div class="col-12 col-lg-4 text-right">
            <div class="row">
                <div class="offset-lg-4 col-lg-8 offset-4 col-4 text-center">
                    <div>
                        <img class="mw-100" src="<?php echo get_template_directory_uri() ?>/img/logo-black.svg" alt="">
                    </div>            
                    <img class="mw-100" src="<?php echo get_template_directory_uri();?>/img/order/success-order.svg" alt=""/>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-8 px-5">
            <p class="order-confirm-title">Xác nhận đơn hàng</p>
            <p></p>
            <div class="order-info">
				<?php for($i = 1; $i < count($orders) ; $i++){ $order = $orders[$i];  ?>
                <div class="row">
                    <div class="col-lg-6">
                        <p class="text-title">Order #<?php echo $order->ID; ?></p>
                        <p class="create-date-text">Ngày tạo: <?php echo date("d/m/Y",strtotime($order->date_created));?></p>
                    </div>
                    <div class="col-lg-6 text-right">
                        <p class="text-title">Tình trạng: <span class="status-<?php echo ($order->order_status) ?>">
							<?= ORDER_STATUS[$order->order_status]  ?></span></p>
                        <div class="spacer-10"></div>
                        <button class="btn-clip btn-border-red bg-gray btnTheoDoiDH pl-2" id="btnTheoDoiDH" href="<?php echo get_site_url() ?>/user/?order_id=<?php echo $order->ID; ?>#check-order">Theo dõi</button>
                    </div>
                </div><hr>
				<?php  }   ?>
                
                <div class="row total-order">
                    <div class="col-lg-1">
                        <p class="text-uppercase ff-1 h4">Total</p>
                    </div>
                    <div class="col-lg-11 text-right">
                        <p><?php echo currencyFormat($order_sum->order_total);  ?></p>
                    </div>
                </div>
            </div>

            <div class="info-content-box mt-4">
                <p class="label-info"><?=$receiver['name'] ?></p>
                <div class="info-content">
                    <p><span style="font-weight: 550;color: gray;">Địa chỉ: <?= $receiver['address'] ?></span></p>
                    <p style="font-weight: 550;color: gray;">Số điện thoại: <span style="color: red;"><?=$receiver['phone']  ?></span></p>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-lg-6 align-self-center">
                <a href="<?php echo get_site_url() ?>/" class="continue"><i class="fas fa-chevron-left"></i>&nbsp;Tiếp tục mua hàng</a>
                </div>
                <div class="col-lg-6 text-right">
                <button class="btn-clip btn-red mr-2 btnTheoDoiDH" id="btnTheoDoiDH" href="<?php echo get_site_url() ?>/user/#history-order">Xem lịch sử đơn hàng</button>
                </div>
            </div> 

        </div>
    </div>
</section>
<script type="text/javascript">
$(document).ready(function() {
	$('button.btnTheoDoiDH').click(function(){
		window.location.href=$(this).attr("href");
	});
});
</script>	
	<?php endif;?>
<?php endif;?>

<script src="<?php echo get_template_directory_uri() ?>/js/my-work.js?v=<?php echo time(); ?>"></script>
<?php
get_footer();
