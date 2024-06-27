<?php
/**
* Order Step
*
*/
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

global $wpdb, $current_user, $current_user_profile, $current_customer_address;
$table = $wpdb->prefix.'customer';

$customer_list_orders = get_customer_list_orders_status($order_status = 0, $limit=1);

if(!$current_user)
	$current_user = wp_get_current_user();

// redirect to profile to active user
if($current_user->user_activation_key != ''){
	header("Location: " . get_site_url() . "/user/#user-info");
	die();
}

if(!$current_customer_address)
	$current_customer_address = get_customer_address_payment();
 
$BookingItems = false; 

$order_id = 0;
$invoice_require = 0;
$tax_number = '';
$company_info = '';
$company_address = '';
$rec_invoice_address = '';
 
$customer_order = (array)$current_user_profile;

$sf_account_id = get_user_meta($customer_order['user_id'], 'sf_account_id', true);
$customer_order['customer_id'] = $customer_order['user_id'];
$customer_order['sf_account_id'] = $sf_account_id;
$customer_order['shipping_fee'] = 30000;
$customer_order['receiver_address'] = '';
$customer_order['promotion_code'] = '';
$customer_order['voucher'] = '';


//$customer_order['order_id'] = $order_id;

//print_r($customer_list_orders);

$addressList = get_list_customer_address();
  
if($customer_list_orders){
	$order_id = $customer_list_orders[0]['ID'];
	$invoice_require = $customer_list_orders[0]['invoice_require'];
	$tax_number = $customer_list_orders[0]['tax_number'];
	$company_info = $customer_list_orders[0]['company_info'];
	$company_address = $customer_list_orders[0]['company_address'];
	$rec_invoice_address = $customer_list_orders[0]['rec_invoice_address'];
	
	$customer_order['order_id'] = $order_id;

	$OrderItems = get_order_details_of_order_status($order_id = $order_id, $order_status = 0);

	$BookingItems = (array)$OrderItems;  

}
 

if(!is_user_logged_in() ):
	 
	echo '<div class="col-lg-12 col-12 align-items-center text-center pt40 mt40 mb40">
	<h4 class="exbold ff-3 colorRed text-center">Bạn chưa Đăng nhập, Vui lòng Đăng nhập để tiến hành thanh toán! </h4> 
	<div class="col-lg-12 col-12 align-items-center text-center pt40 pb40 mb40">
	<a href="javascript:void(0);" class="popup_login btn-clip btn-red" id="btnLogin">ĐĂNG NHẬP</a>
	</div></div>';
	 
else: 
	//if(count($BookingItems) > 0){
?>
<div class="form-content details">
	<div class="row">
		<div class="col-md-6 col-12 pr10" >
			<h3 class="exbold ff-1 borderl4">THANH TOÁN</h3>
			<div class="box-shadow01rem bgwhite pt20"> 
				<h5 >THÔNG TIN CỦA BẠN</h5> 
				<div class="info-payment">
					<ul>
						<li>
							<div class="form-group"> 
								<input type="text" class="form-control" placeholder=" <?php echo 'Họ và tên' ?>" 
										value="<?php echo $current_user_profile->full_name ?>">
							</div>
						</li>
						<li>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<input type="tel" class="form-control" placeholder=" <?php echo 'Số điện thoại' ?>" 
										value="<?php echo $current_user_profile->phone ?>">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<input type="email" class="form-control" placeholder=" <?php echo 'Địa chỉ email' ?>" 
										value="<?php echo $current_user_profile->email ?>">
									</div>
								</div>
							</div>
						</li> 
					</ul>
				</div>
				<div class="spacer-20"></div>
				<h5>ĐỊA CHỈ NHẬN HÀNG</h5> 
				<div class="dropdown filter-dealer info-address">
					<a href="javascript:void(0)" class="btn btn-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<span class="choose-dealer">Chọn Địa Chỉ</span>
						<div class="top-line"></div>  
						<div class="title"></div>
						<div class="label label-fix"></div>
					</a>
					<script type="text/javascript">
						var data_receiver_address = {};
					</script>
					
					<div id="addressSelect" class="dropdown-menu" aria-labelledby="dropdownMenuButton">
						<?php foreach ($addressList as $item) : ?>
							<a class="dropdown-item" href="javascript:void(0)" data-address_id="<?= $item['ID'] ?>" data-province-id="<?= $item['province_id'] ?>" data-district-id="<?= $item['district_id'] ?>" data-ward-id="<?= $item['ward_id'] ?>" data-name="<?= $item['full_name'] ?>" data-phone="<?= $item['phone'] ?>" data-address="<?= $item['address'] ?>" data-default="<?= $item['default_address'] ?>">
								<span class="text"><?= $item['full_name'] ?> - <?= $item['phone'] ?> - <?= $item['address'] ?></span>
							</a>
						<?php endforeach ?> 
					</div> 
				</div>
				<div class="info-address ">
					<a href="javascript:void(0);" class="btn_Addnew_Address popup_add_address link underline colorBlue" >Thêm mới địa chỉ nhận hàng</a>
				</div>
				<div class="invalid-feedback"></div>
		
				<div class="spacer-20"></div>
				<?php include_once('megapay.php'); ?>
				<div class="spacer-20"></div>
				<h5 >PHƯƠNG THỨC VẬN CHUYỂN</h5> 
				<div class="info-deliver"> 
					<ul class="deliver"> 
						<li class="colorRed small">Đối với đơn hàng nội thành TP.HCM, phí vận chuyển là 0đ)</li>
						<li class="colorRed small">Đối với đơn hàng nơi khác, Phí vận chuyển sẽ apply theo biểu phí, sẽ gửi lại sau)</li>
						<li class="colorRed small">Dự kiến thời gian giao hàng 7 ngày (không tính thứ Bảy va Chủ Nhật)
						<li class="colorRed small">Phí vận chuyển chỉ áp dụng đối với sản phẩm Apparel</li>
						<li class="colorRed small">Miễn phí vận chuyển cho đơn nội thành (Quận 1, Quận 3, Quận 5,…) TP.HCM</li>
					</ul> 
				</div><div class="spacer-10"></div>
				 <h5 >THÔNG TIN HÓA ĐƠN</h5>
				  <div class="info-invoice" >  
						<form action="" name="frmHoaDon" id="frmHoaDon">
							<input type="checkbox" name="invoice_require" id="invoice_require" <?=$invoice_require==1?'checked':''?> value="<?=$invoice_require?>" ><label for="invoice_require"><?php echo 'Yêu cầu hóa đơn' ?></label>
								
							<div id="collapse_p" class="collapse_p">
								<div class="col-lg-12 form-group">
									<input type="text" name="tax_number" class="form-control mb20"  placeholder=" Mã số thuế"  id="tax_number" value="<?=$tax_number?>" >
									<input type="hidden" name="payments"  placeholder=" Phương thức thanh toán" value="Showroom" class="text_payments" id="txt_payments" >
									<input type="hidden" placeholder="order_id" name="order_id" id="order_id" value="<?=$order_id?>" />
									<input type="hidden" class="rec_address" placeholder="rec_address" name="rec_address" id="rec_address" value="<?php echo $current_customer_address->address ?>" />
								</div>
								<div class="col-lg-12 form-group">
								<input type="text" name="company_info" class="form-control mb20" id="company_info" placeholder=" Công ty" value="<?=$company_info?>" >
								</div> 
								<div class="col-lg-12 form-group">
								<input type="text" name="company_address" class="form-control mb20" placeholder=" Địa chỉ" id="company_address" value="<?=$company_address?>" >
								</div>  
								<p class="colorRed">Lưu ý: Khách hàng sẽ nhận nhiều hóa đơn theo DO/DLR đã chọn.</p>
						</div>
					</form> 
				</div>
				
			</div>
		</div> 
			
		<div class="col-md-6 col-12 pl10 mb30"> 
		<h3 class="exbold ff-1 borderl4">TÓM TẮT ĐƠN HÀNG</h3> 
			<div class="box-shadow00rem" id="Booking_Table"><!--Booking_Table--> 
				<ul class="h__drawer-list details" id="Booking_Items">
	<?php /*?><?php if ($BookingItems){ ?> 
				
		<?php  
					$finaltotal = 0;
					$saleoff = 100000;
					$shipping = 30000;
					$total_order = 0;
					
			foreach ($BookingItems as $item) :
					$deposit = 0;
				if(isset($item['item_id'])) $item_id = $item['item_id'];
				else if(isset($item['post_ID'])) $item_id = $item['post_ID'];
					   
				$color = $item['color'];
				$feature_img = '';
				if(isset($item['image'])) $feature_img = $item['image'];
				else if(isset($item['imgcolor'])) $feature_img = $item['imgcolor'];
								 
				$postType = get_post_type($item_id);
				
				$price =  $item['price'] ; 
				$price_old =  $item['price_old'] ;  
				 
				$size =  $item['size'] ;
				$price = intval(str_replace(".","", $price)); 
				$price_old = intval(str_replace(".","", $price_old));
			
				$quantity = intval($item['quantity']);
				$deposit = intval(str_replace(".","", $item['deposit']));
					
					if($quantity==0) {$quantity=1;}
				
				$dealer_id = $item['dealer_id'] ;
				$dealer_name = $item['dealer_name'] ;
				$dealer_address = $item['dealer_address'];
			
				$sale_off = 0;
				if(isset($item['sale_off']))
					$sale_off = intval($item['sale_off']);
					
				$voucherval = 1000000; $vouchercode = 'QWESADHTR';
			
				$subtotal = ($price * $quantity)-(($deposit*$quantity) + $sale_off);
					
			if($deposit>0){
				$subtotal = ($deposit*$quantity) ;
			}
					
				$total_order = $total_order + $subtotal; 
					
					if(isset($item['dealer_name'])){
						$dealer_name = $item['dealer_name'] ;
						$dealer_address = $item['dealer_address'];
					} else if(isset($item['description'])){
						$dealerarr = explode('@', $item['description']);
						$dealer_name = $dealerarr[1] ;
						$dealer_address = $dealerarr[2];
					}
					
				if(isset($item['item_id'])){ 
				?> 
				<li class="box-shadow00rem item-shopping-cart " data-type="<?php echo get_post_type($item['item_id']); ?>" data-id="<?php echo $item['item_id'];?>" data-quantity="<?php echo intval($quantity)?>" data-deposit="<?php echo intval($deposit)?>" data-price="<?php echo intval($price)?>" data-price-old="<?php echo intval($price_old)?>" data-sale_off="<?php echo intval($sale_off)?>" data-subtotal="<?php echo intval($subtotal)?>" data-dealer-id="<?php echo $dealer_id ;?>">
					<div class="row">
						<div class="col-md-3 col-lg-3 col-3 d-lg-flex align-self-center align-items-center item-cart-img ">
							<a href="<?php echo get_permalink($item['item_id']) ?>" class="product-link" alt="<?php echo get_the_title($item['item_id']) ?>" >
								<img src="<?php echo $feature_img; ?>" alt="<?php echo get_the_title($item['item_id'])?>" class="box-img lazyload" />
							</a>
						</div>
						<div class="col-md-9 col-lg-9 col-9 d-lg-flex item-cart-detail-box ">
							<div class="item-cart-info-box " >
								<div class="col-md-6 col-lg-6 col-12 align-self-center item-cart-detail-info" data-id="<?php echo $item['item_id']; ?>">
									<p class="title fnt-oswald"><?php echo get_the_title($item['item_id']); ?> X <?php echo $quantity; ?></p>
									<p class="showroom dealer colorGray"><?php echo $dealer_name; ?></p>	
								</div> 
								<div class="col-md-6 col-lg-6 col-12 align-self-center item-cart-detail-price text-right " >
									 
									<?php if($postType=='bike' || $postType == 'product'){ ?>
										<?php if($deposit>0){ ?>
										 <p class="item-price fnt-oswald fnt-20"><span class="price"><?php echo currencyFormat($deposit); ?> </p> 
										 <?php } ?>
										<p class="deposit">(Giá niêm yết: <?php echo currencyFormat($price); ?>)</p>
									<?php } else { ?>
											<p class="item-price fnt-oswald fnt-20"><span class="price"><?php echo currencyFormat($price); ?> </p>
									<?php } ?>
									
									<?php if($price_old>0){ ?>
									 <span class="fnt-oswald colorLGray price-old"><?php echo currencyFormat($price_old); ?></span> 
									 <?php } ?> 
									 
								</div>
							</div>
						</div> 
					</div>
					
					<div class="item-cart-delete" >
					<a class="item-cart-delete" href="javascript:void(0);" data-iddel="<?php echo $item_id; ?>"><i class="fas fa-times"></i></a> 
					</div> 
				</li>
			 <?php 
				}
			endforeach; 
			$finaltotal = ($total_order - $saleoff) + $shipping;		
		?> 
	  	<?php } ?> <?php */?>
		  </ul>
		  
		</div> <!--Booking_Table-->
		 
		<?php /*?> <?php if(count($BookingItems) >= 1){?>
		<div class="box-shadow00rem bgwhite "> 
				<div class="item-voucher-box align-items-center" data-code="<?php echo $vouchercode; ?>" data-value="<?php echo $voucherval; ?>">
					<div class="col-12 pd0">
				 	<div class="row">
						<div class=" col-lg-6 col-12 voucher text-left align-seft-bottom" >
							<h5 class="fnt-oswald fw400">MÃ GIẢM GIÁ<h5>
								<div class="clearfix"></div>
							<span class="colorGray small">Điền mã giảm giá của bạn vào ô bên cạnh</span>
						</div>
						<div class=" col-lg-6 col-12 voucher-code text-right align-seft-center">
							<input type="text" class="bg_eee border0 text-center fnt-oswald color333 fnt-18 fw600 height40" value="<?php //echo ($vouchercode); ?>" />
							<div class="clearfix"></div>
							<span class="colorRed small text-right">
							Bạn được giảm <?php //echo currencyFormat($voucherval); ?> từ mã giảm giá.
							</span>
						</div>
						</div>
						<div class="clearfix"></div>
					 
				</div>
			</div>
		</div>

		 
			<div class="box-bottom-form box-shadow01rem bgwhite col-md-12 pr40 pl40 pt20" > 
				<div class="col-md-12 item-cart-total-box" >
					<p>Tổng tiền</p>
					<p class="total-price total" data-value="<?php echo $total_order; ?>"><?php echo currencyFormat($total_order); ?></p>
				</div> 
				<div class="col-md-12 item-cart-total-box">
					<p>Giảm giá</p>
					<p class="total-price saleoff" data-value="<?php echo $saleoff; ?>"><?php echo currencyFormat($saleoff); ?></p>
				</div> 
				<div class="col-md-12 item-cart-total-box">
					<p>Phí vận chuyển</p>
					<p class="total-price shipping fee" data-value="<?php echo $shipping; ?>"><?php echo currencyFormat($shipping); ?></p>
				</div>
				<div class="col-md-12 item-cart-total-box">
					<p>Thành tiền</p>
					<p class="total-price f-total" data-value="<?php echo $finaltotal; ?>"><?php echo currencyFormat($finaltotal); ?></p>
				</div>
				<div class="spacer-20"></div>
				<div class="col-lg-12 pd0 mg0 text-left" style="padding: 0px; margin: 0px;"> 
				<input type="checkbox" id="chkAgree" checked class="pd0"> <label for="chkAgree"> Tôi đồng ý <a href="<?=get_site_url()?>/terms-of-use/" target="_blank" class="blue"><strong>điều khoản và chính sách mua hàng</strong></a> của YMH.</label> 
				</div>
			</div> 
		<?php } ?> <?php */?>
		 
			<div class="row">
				<div class="col-md-5 col-5 col-12 text-left" >
					<div class="g-recaptcha mrcenter" data-sitekey="6Ld_OxwTAAAAADhMzyvq5TNLE9rWI6XwO9gKJjRA"></div>
				</div>
				<div class="col-md-7 col-7 col-12 pt30" style="text-align: right;">
			<?php if(is_user_logged_in()){?> 
					<button type="button" class="btnSubmit btnStep Finish btn-clip btn-red" id="btnFinish">Tiến hành thanh toán</button>
			<?php } else{  ?>
					<a href="javascript:void(0);" class="popup_login btn-clip btn-red" id="btnLogin">Đăng nhập</a>
			<?php } ?>

				</div>  
			</div>
			
		 </div> 
		 <div class="spacer-20 d-none"></div>
	</div>	
	 
</div> 
<?php //}  ?>
<?php  endif; ?>

<?php 
	write_javascript_update_cart($bookType='apparel' );

	write_javascript_render_booking_checkout();
?>  
<script type="text/javascript"> 

	dataOrder = <?php echo ( wp_json_encode($customer_order, true) );  ?>; 

	$(document).ready(function() {
		
		if( getCart_count() > 0) { 
			render_booking_checkout(Booking_Table = $('#Booking_Table'), Booking_Items = $('#Booking_Items'), dataOrder );	
		}
		else { 
			showPopup('<div class="colorRed fnt-18 text-center pt40 pb40">Giỏ hàng chưa có sản phẩm!<br><br><a class="btn-clip btn-border-red colorBlue" href="<?=get_site_url()?>/apparels/">Quay lại trang mua sắm.</a></div>  ', el=$('.popup_content'));

			setTimeout(function(){hidePopup(); },4000);
			setTimeout(function(){window.location.href='<?=get_site_url()?>/apparels/';},500);
		} 
	});  
</script>
<?php include_once(WP_PLUGIN_DIR.'/commerce-cms/html/order-form-step-2-script.php') ; //Dieu khien cac nut ?>

    <form id="megapayForm" name="megapayForm" method="POST">
        <input type="hidden" name="invoiceNo" value="OrdNo"/>
        <input type="hidden" name="description" value="description"/>
        <input type="hidden" name="goodsNm" value="Tea milk"/>
        <input type="hidden" name="currency" value="VND">
        <input type="hidden" name="buyerPhone" value="">
        <input type="hidden" name="buyerAddr" value="">
        <input type="hidden" name="buyerCity" value="">
        <input type="hidden" name="buyerState" value=""/>
        <input type="hidden" name="buyerPostCd" value=""/>
        <input type="hidden" name="buyerCountry" value="vn"/>
        <input type="hidden" name="fee" value=""/>

        <!-- Delivery Info -->
        <input type="hidden" name="receiverFirstNm" value="">
        <input type="hidden" name="receiverLastNm" value="">
        <input type="hidden" name="receiverPhone" value="">
        <input type="hidden" name="receiverAddr" value="">
        <input type="hidden" name="receiverCity" value="">
        <input type="hidden" name="receiverState" value=""/>
        <input type="hidden" name="receiverPostCd" value=""/>
        <input type="hidden" name="receiverCountry" value="VN"/>

        <!------------------------------- Main Value ------------------------------>
        
        <!-- <input type="hidden" name="callBackUrl" value="<?=get_site_url()?>/megapay-result"/> -->
        <input type="hidden" name="callBackUrl" value="<?=get_site_url()?>/order-confirm"/>
        <!-- Notify URL -->
        <input type="hidden" name="notiUrl" value="<?=get_site_url()?>/notify.php"/>
        <!-- Merchant ID -->
        <input type="hidden" name="merId" value=''/>
        <!-- Encode Key -->
        
        <!------------------------------------------------------------------------->

        <!-- <input type="hidden" name="reqServerIP" value=""/> -->
        <!-- <input type="hidden" name="reqClientVer" value=""/> -->
        <!-- <input type="hidden" name="userIP" value="172.16.12.145"/> -->
        <!-- <input type="hidden" name="userSessionID" value=""/> -->
        <!-- <input type="hidden" name="userAgent" value="chrome"/> -->
        <!-- <input type="hidden" name="version"/> -->
        <!-- <input type="hidden" name="mer_temp01" value=""/> -->
        <!-- <input type="hidden" name="mer_temp02" value=""/> -->
        <!-- <input type="hidden" name="domesticToken"/> -->
        <!-- <input type="hidden" name="instmntMon" value=""/> -->
        <!-- <input type="hidden" name="instmntType" value=""/> -->
        <!-- <input type="hidden" name="vat" value=""/> -->
        <!-- <input type="hidden" name="notax" value=""/> -->

        <input type="hidden" name="reqDomain" value="<?=get_site_url()?>/booking/?step=2"/>
        <input type="hidden" name="userLanguage" value="VN"/>
        <input type="hidden" name="merchantToken" value=""/>
        <input type="hidden" name="payToken" id="payToken" value=""/>
        <input type="hidden" name="timeStamp" value=""/>
        <input type="hidden" name="merTrxId"/>
        <input type="hidden" name="windowType" value=""/>
        <input type='hidden' name='windowColor' value='#0B3B39'/>
        <input type="hidden" name="vaCondition" value="03"/>
        <input type="hidden" name="subappid" id="subappid" value=""/>

        <input type="hidden" name="amount" id="amount" value=""/>
        <input type="hidden" name="payOption" id="payOption" value=""/>

        <input type="hidden" name="payType" id="payType" value="DC">
    </form>	