<?php
/**
* Order LIST
*
*/
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
$orderID = '';
if(isset($_GET['order-id'])){
	$orderID = $_GET['order-id'];
}
$list_order_details = get_order_details_of_order($order_id = $orderID);
$order = get_order_by_ID($order_id = $orderID);

$order['rec_address'] = stripslashes($order['rec_address']);
$receiver = json_decode($order['rec_address'], true);

?>
<section class="order-detail container-fluid">
	<div class="row">
		<div class="col-lg-8">
			<p class="id-order">Đơn hàng #<?= $order['ID'] ?></p>
			<p class="create-date">Ngày tạo: <?=date("d/m/Y",strtotime($order['date_created'])); ?></p>
		</div>
		<div class="col-lg-4 text-right">
			<?php if ($order['order_status'] ==1  || $order['order_status'] == 5){ ?>
			<button data-toggle="modal" data-target="#dialogCancelOrder" class="btn-cancel" id="btnCancelOrder">Hủy đơn hàng</button>
			<?php } ?>
		</div>
	</div>
	<div class="row justify-content-between mt-3">
		<div class="col-lg-6">
			<div class="info-content-box">
				<p class="label-info"><?= $receiver['name'] ?></p>
				<div class="info-content">
					<p>Địa chỉ: <?= $receiver['address'] ?></p>
					<p>Số điện thoại: <?= $receiver['phone'] ?></p>
				</div>
			</div>
		</div>
		<div class="col-lg-6">
			<div class="info-content-box">
				<p class="label-info">Phương thức thanh toán</p>
				<div class="info-content">
					<p><?= $order['payments'] ?></p>
				</div>
			</div>
		</div>
	</div>
	<div class="order-detail-list mt-3">
		<div class="d-none d-lg-block">
			<div class="row title-table">
				<div class="col-lg-6">
					<div class="row">
						<div class="col-4"></div>
						<div class="col-8">
							<p class="label-item text-left">Sản phẩm</p>
						</div>
					</div>
					
				</div>
				<div class="col-lg-6">
					<p class="label-item text-right">Tổng tiền</p>
				</div>
			</div>
		</div>
		<?php foreach($list_order_details as $order_detail) {?>
		<div class="row single-order-detail">
			<div class="col-lg-6">
				<div class="row">
					<div class="col-lg-4 text-center"><img src="<?= $order_detail['image']?>" alt=""/></div>
					<div class="col-lg-8 align-self-center"> 
						<p class="label-info name"><?= $order_detail['product_name'] ?></p>
						<p class="showroom">Số lượng: <?= $order_detail['quantity'] ?></p>
						<p class="showroom"><?= $order_detail['dealer_name'] ?></p>
						<p class="showroom">SĐT: <?= $order_detail['dealer_phone'] ?></p> 
						<p class="status mt-3 text-success"><?= ORDER_STATUS[$order_detail['order_status']] ?></p> 
					</div>
				</div>
			
			</div>
			<div class="col-lg-6 text-right align-self-center">
				<p class="price"><?= currencyFormat($order_detail['sub_total']); ?></p>
				<?php if($order_detail['order_status'] != 6 && $order_detail['order_status'] != 4){ ?>
				<a href="<?php echo get_site_url() ?>/user/?order_id=<?php echo $order_detail['order_id']; ?>#check-order" class="btn-clip btn-border-red tracking-btn">
				theo dõi đơn hàng
				</a>
				<?php } ?>
			</div>
		</div>
		<hr>
		<?php }?>
	</div>
	
	<div class="row">
		<div class="col-lg-6">
		</div>
		<div class="col-lg-6">
			<div class="info-payment-box">
				<?php /*
				<div class="row">
					<div class="col-lg-6">Tong tien chua giam</div>
					<div class="col-lg-6 text-right">1.970.000.000đ</div>
				</div>
				<div class="row">
					<div class="col-lg-6">Giam gia</div>
					<div class="col-lg-6 text-right">1.970.000.000đ</div>
				</div>
				<div class="row">
					<div class="col-lg-6">Phi van chuyen</div>
					<div class="col-lg-6 text-right">1.970.000.000đ</div>
				</div> */?>
				<div class="row">
					<div class="col-lg-6 col-6 price-label">Tổng tiền chưa giảm</div>
					<div class="col-lg-6 col-6 text-right price"><?= currencyFormat($order['totals']); ?></div>
				</div>
				<div class="row">
					<div class="col-lg-6 col-6 price-label">Giảm giá</div>
					<div class="col-lg-6 col-6 text-right price"><?= currencyFormat($order['discount']); ?></div>
				</div>
				<? /* <div class="row">
					<div class="col-lg-6 col-6 price-label">Phí vận chuyển</div>
					<div class="col-lg-6 col-6 text-right price"><?= currencyFormat($order['shipping_fee']); ?></div>
				</div> */ ?>
				<div class="row">
					<div class="col-lg-6 col-6 price-label">Tổng cộng</div>
					<div class="col-lg-6 col-6 text-right price"><?= currencyFormat($order['totals'] - $order['discount'] + $order['shipping_fee']); ?></div>
				</div>
				
			</div>
			<p style="font-size:14px" class="colorRed">Miễn phí vận chuyển cho đơn hàng thời trang và phụ kiện áp dụng trong khu vực Thành phố hồ chí minh, Các khu vực khác được tính phí riêng. Bộ phận chăm sóc khách hàng sẽ liên hệ với quý khách sau.</p>
		</div>
	</div>
	<div class="mt-5"></div>
</section>
<!-- Modal -->
<div class="modal fade" id="dialogCancelOrder" tabindex="-1" role="dialog" aria-labelledby="btnCancelOrderLabel" aria-hidden="true">
  <div class="modal-dialog" style="max-width: 651px;" role="document">
    <div class="modal-content rounded-0">
      <div class="modal-header border-0 justify-content-center">
        <h4 class="modal-title ff-oswald text-uppercase text-dark" id="exampleModalLabel"><strong>Lý do hủy đơn</strong></h4>
      </div>
      <div class="modal-body">
        <div class="custom-select-bst">
            <select id="slcOrderReason" class="form-select w-100" aria-label="Default select example">
            	<?php foreach (CANCEL_ORDER_REASON as $item=>$value) {?>
            		<option value="<?=$item?>"><?=$value?></option>
            	<?php }?>                
            </select>
            <i class="fas fa-chevron-down"></i>
        </div>
      </div>
      <div class="modal-footer border-0 justify-content-center">
        <a style="background: url('<?php echo get_template_directory_uri();?>/img/button/btn-bg-dark.svg') no-repeat;" data-dismiss="modal" class="btn-cancel-cs mb-2 shadow-color-grey" href=""> <p>Thoát</p> </a>
        <div class="mr-4"></div>
        <a style="background: url('<?php echo get_template_directory_uri();?>/img/button/btn-bg-grey.svg') no-repeat;"   class="btn-cancel-cs mb-2" id="btn_Cancel_Order" href="javascript:void(0)"> <p>Hủy đơn hàng</p>
		  </a>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
	var sval = '<?php echo $order['ID']; ?>';
    $(document).ready(function() {
		$('#btn_Cancel_Order').click(function(){
			showPopup('<div class="colorRed fnt-18 text-center mb30">Bạn muốn hủy đơn hàng ?</div> <button type="button" value="Đồng ý" id="btnYes" class="btn-clip btn-red">Đồng ý</button> <button type="button" value="Không" id="btnNo" class="btn-clip btn-border-red">Không</button>', el=$('.popup_content'));
			
			$('#btnNo').click(function(){hidePopup();});
			
            $('#btnYes').click(function(){
			   $.ajax({
					url: ajaxurl, // AJAX handler
					data:{'action': 'cancel_order_booking', 'order_id': sval},
					type: 'POST',
					dataType: "json",
					success: function(response) {

						dataOrderCRM = $.get_API_CRM(action = 'ajax_get_API_DATA_FROM_SF', apiName = 'APIOrderCancle', dataRequest = {"orderid" : '<?php echo $order['sf_order_id']; ?>', "reasoncancel" : $( "#slcOrderReason option:selected" ).text()} );
						setTimeout(function(){hidePopup(); },1000);
						setTimeout(function(){ window.location.href='<?=get_site_url()?>/order-cancel/?order-id='+sval; },1000);
						
					}
				});
			});
        });
    });
	
	
	
</script>
<?php /*
if($order){ 
	echo('<pre>');
	print_r($order) ;
	echo('</pre>');
} 	
if($list_order_details){ 
	echo('<pre>');
	print_r($list_order_details) ;
	echo('</pre>');
	
} 