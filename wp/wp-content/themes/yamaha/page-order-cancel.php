<?php
/**
 * @author Bao
 * created Date: 26/01/2022
 * project: yamaha-revzone-website
 *
 * Template Name: Order cancel
 *
 */
get_header();

$orderID = '';
if(isset($_GET['order-id'])){
	$orderID = $_GET['order-id'];
}
$list_order_details = get_order_details_of_order($order_id = $orderID);
$order = get_order_by_ID($order_id = $orderID);

send_email_cancel_order($current_user->user_email, $order );
 
$receiver = json_decode(stripslashes($order['rec_address']), true);

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

<section class="container-fluid min-vh-100 status-order-page mb40">
    <div class="mt80 spacer-20"></div>
    <div class="row justify-content-center">
        <div class="col-12 col-lg-4 text-right">
            <div class="row">
                <div class="offset-lg-4 col-lg-8 offset-4 col-4 text-center">
                    <div>
                        <img class="mw-100" src="<?php echo get_template_directory_uri() ?>/img/logo-black.svg" alt="">
                    </div>            
                    <img class="mw-100" src="<?php echo get_template_directory_uri();?>/img/order/cancel-order.svg" alt=""/>
                </div>
            </div>
           <? /* <div>
                    <img src="<?php echo get_template_directory_uri() ?>/img/logo-footer.svg" alt="">
            </div>
            <img src="<?php echo get_template_directory_uri();?>/img/order/cancel-order.svg" alt=""/> */?>
        </div>
        <div class="col-12 col-lg-8 px-5">
            <p class="order-confirm-title">Đã hủy đơn hàng</p>
            <!-- <p style="font-size: 14px;"><?=ORDER_STATUS[$order['order_status']]?></p> -->
            <p>Đơn hàng đã hủy thành công. Bộ phận chăm sóc khách hàng sẽ liên hệ đến quý khách trong thời gian sớm nhất.</p>
            <p></p>
            <div class="row mb-4">
                <div class="col-lg-12 ">
                    <a href="<?php echo get_site_url() ?>">
                <button class="btn-corner-red" id="btnBackHome"><i class="fas fa-chevron-left" style="font-size: 8px;vertical-align: middle;"></i>
                    &nbsp;Quay về trang chủ
                    
                </button>
                </a>
                </div>
            </div>
            <div class="order-cancel-info">
                <div class="single-order">
                    <div class="row info-order">
                        <div class="col-lg-6">
                            <p class="text-title">Order #<?=$order['ID'] ?></p>
                            <p class="create-date-text">Ngày tạo: <?=date("d/m/Y",strtotime($order['date_created'])); ?></p>
                        </div>
                        <div class="col-lg-6 text-right">
                            <p class="text-title">Tình trạng: <span style="color: red;" class="status-<?=$order['order_status']?>"><?=ORDER_STATUS[$order['order_status']]?></span></p>
                        </div>
                    </div>
                    <div class="row header-list">
                        <div class="col-lg-6">
                            <p>Sản phẩm</p>
                        </div>
                        <div class="col-lg-6 text-right">
                            <p>Giá</p>
                        </div>
                    </div>
                    <?php foreach($list_order_details as $order_detail) {?>
                        <div class="order-cancel-item">
                            <a class="row single-item">
                                <div class="col-lg-6">
                                    <p class="name"><?= get_the_title($order_detail['post_ID'])?> x <?= $order_detail['quantity']?></p>
                                    <p class="info"> </p>
                                </div>
                                <div class="col-lg-6 text-right">
                                    <p class="price"><?= currencyFormat($order_detail['sub_total']); ?></p>
                                </div>
                            </a>
                        </div>
                    <?php }?>
                     
                </div> 
                <div class="row total-order">
                    <div class="col-lg-1">
                        <p class="text-uppercase ff-1 h4">Total</p>
                    </div>
                    <div class="col-lg-11 text-right">
                        <p><?= currencyFormat($order['order_total']); ?></p>
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
        </div>
    </div>
</section>
<div class="spacer-20"></div>

<script type="text/javascript">
	var orderID = '<?php echo $orderID; ?>';
	 
    $(document).ready(function() {
		$('#btnBackHome').click(function(){
			window.location.href='<?=get_site_url()?>';
		});
	});
	
</script>

<script src="<?php echo get_template_directory_uri() ?>/js/my-work.js?v=<?php echo time(); ?>"></script>
<?php
get_footer();
