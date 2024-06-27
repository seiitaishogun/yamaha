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
if(!$current_user_profile)
	$current_customer_address = get_customer_address_payment();

$ListBookings = get_list_Items_Cookie();

$BookingItems = false; 
 
$customer_order = (array)$current_user_profile;

$order_id = 0;
$invoice_require = 0;
 
//print_r($customer_list_orders);
 
if(isset($ListBookings['booking_items'] )){
		$BookingItems = $ListBookings['booking_items'];
}else{
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
}
/* 
if(isset($ListBookings['booking_items'] ))
	$BookingItems = $ListBookings['booking_items'];*/
 
?>
<div class="form-content details">
	<div class="row">
		<div class="col-md-6">
			<h3 class="exbold ff-1">THANH TOÁN</h3>
			<div class="box-shadow02rem"> 
				<h5 >THÔNG TIN CỦA BẠN</h5> 
				<div class="info-payment">
					<ul>
						<li><div class="form-group"> 
								<input type="text" class="form-control" placeholder=" <?php echo 'Họ và tên' ?>" 
										value="<?php echo $current_user_profile->full_name ?>">
							</div>
						</li>
						<li><div class="row">
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
				<div class="info-address">
					<ul> 
						<li><div class="form-group">
							<strong><span class="rec_address"><?php echo $current_customer_address->address ?></span></strong>
							</div>
						</li> 
					</ul>
					<button class="btn_Addnew_Address link popup_add_address btn-clip btn-border-red" >Thêm mới</button>
				</div>
				<div class="spacer-20"></div>
				<h5 >PHƯƠNG THỨC THANH TOÁN</h5> 
				<div class="form-group">
					<input type="radio" name="payments" value="Showroom" class="checkbox chkpayments" id="chkPTTT1" checked="checked">
							<label for="chkPTTT1"> Showroom YMH </label><br>
					 <input type="radio" name="payments" value="Domestic Card" class="checkbox chkpayments" id="chkPTTT2" >
						<label for="chkPTTT2"> Domestic Card (ATM/NAPAS) </label><br>
					<input type="radio" name="payments" value="Credit/Debit Card" class="checkbox chkpayments" id="chkPTTT3" >
					<label for="chkPTTT3"> Credit/Debit Card </label><br>
					<input type="radio" name="payments" value="Installment" class="checkbox chkpayments" id="chkPTTT4" >
					<label for="chkPTTT4"> Installment </label> 
				</div>
				<div class="spacer-20"></div>
				<h5 >PHƯƠNG THỨC VẬN CHUYỂN</h5><hr> 
				<div class="info-deliver">
					<ul class="deliver"> 
						<li class="colorRed">Đối với đơn hàng Tp. HCM, phí vận chuyển là 0đ</li>
						<li class="colorRed">Đối với đơn hàng nơi khác, phí vận chuyển tùy vào địa điểm</li>
					</ul> 
				</div><hr>
				<button class="product__accordion-btn" type="button" data-toggle="collapse" data-target="#collapse_p" aria-expanded="false" aria-controls="collapse_p">
							<h5 >THÔNG TIN HÓA ĐƠN</h5> <span class="cavet"></span>
						</button>
				<form action="" name="frmHoaDon" id="frmHoaDon">
					<div class="info-invoice"  style="background: #FFF;"> 
						<div id="collapse_p" class="collapse ">
							<div  style="background: #FFF;">
								<div class="form-group">
									<input type="checkbox" name="invoice_require" id="invoice_require" <?=$invoice_require==1?'checked':''?> value="<?=$invoice_require?>" >
									<label for="invoice_require"><strong><?php echo 'Yêu cầu hóa đơn' ?></strong></label>
								</div>

								<div class="form-group">
								<input type="text" name="tax_number"  class="form-control" placeholder=" Mã số thuế"  id="tax_number" value="<?=$tax_number?>" >
									<input type="hidden" name="payments"  placeholder=" Phương thức thanh toán" value="Showroom" class="text payments" id="txt_payments" >
									<input type="hidden"  placeholder="order_id" name="order_id" id="order_id" value="<?=$order_id?>" />
									<input type="hidden" class="rec_address" placeholder="rec_address" name="rec_address" id="rec_address" value="<?php echo $current_customer_address->address ?>" />
								</div>

								<div class="form-group">
								<input type="text" name="company_info" id="company_info" class="form-control" placeholder=" Công ty" value="<?=$company_info?>" >
								</div>

								<div class="form-group">
								<input type="text" name="company_address" class="form-control" placeholder=" Địa chỉ" id="company_address" value="<?=$company_address?>" >
								</div>

							</div> 
						</div>
					</div>
				</form> 
			</div>
		</div>
			
		<div class="col-md-6">
		<h3 class="exbold ff-1">TÓM TẮT ĐƠN HÀNG</h3> 
			<div class="box-shadow00rem"> 
			
	<?php if ($BookingItems) : //print_r($BookingItems) ; ?> 
				<ul class="h__drawer-list details">
		<?php  
					$finaltotal = 0;
					$saleoff = 100000;
					$shipping = 30000;
					
			foreach ($BookingItems as $item) :
				if(isset($item['item_id'])) $item_id = $item['item_id'];
				else if(isset($item['post_ID'])) $item_id = $item['post_ID'];
					   
				$color = $item['color'];
				$feature_img = '';
				if(isset($item['image'])) $feature_img = $item['image'];
				else if(isset($item['imgcolor'])) $feature_img = $item['imgcolor'];
				
				$price =  $item['price'] ;
				$size =  $item['size'] ;
				$price = intval(str_replace(".","", $price)); 
					
				//$quantity = 1; 
				if(isset($item['quantity'])) $quantity = $item['quantity'];
				else if(isset($item['qty'])) $quantity = $item['qty']; 
				
				$deposit = intval(str_replace(".","", $item['deposit']));
				$subtotal = ($price * intval($quantity))-$deposit;
				$total_order += $subtotal;
					
					if(isset($item['dealer_name'])){
						$dealer_name = $item['dealer_name'] ;
						$dealer_address = $item['dealer_address'];
					} else if(isset($item['description'])){
						$dealerarr = explode('@', $item['description']);
						$dealer_name = $dealerarr[1] ;
						$dealer_address = $dealerarr[2];
					}
				?>
				<li class="box-shadow00rem item-shopping-cart " style="position: relative;">
					<div class="row"> 
						<div class="d-lg-flex col-lg-3 col-md-3 col-12 align-items-center item-cart-img" >
							<a href="<?php echo get_permalink($item['item_id']) ?>" class="product-link" alt="<?php echo get_the_title($item['item_id']) ?>" >
								<img src="<?php echo $feature_img; ?>" alt="<?php echo get_the_title($item['item_id'])?>" class="box-img lazyload" />
							</a>
						</div>
						<div class="d-lg-flex col-lg-9 col-md-9 col-12 item-cart-detail-box"> 
								<div class="item-cart-detail-info col-md-7 col-lg-7" data-id="<?php echo $item['item_id']; ?>">	
									<p class="fnt-oswald"><?php echo get_the_title($item['item_id']); ?></p>
									<p class="showroom dealer"><?php echo $dealer_name; ?></p>
								</div>
								<div class="item-cart-detail-price col-md-5 text-right" >  
									<span class="item-price fnt-oswald"><span class="price"><?php echo number_format($subtotal, 0, '.', '.'); ?></span>₫</span><br>
									<?php if($deposit>0){ ?>
									 <p class="deposit">(<?php echo number_format($deposit, 0, '.', '.'); ?>₫ Deposit)</p> 
									 <?php } ?>
								</div>
								<?php /*?><div class="p-detail-quantity item-cart-detail-quantity col-md-2 fnt-oswald" data-type="<?php echo get_post_type($item['item_id']); ?>" data-id="<?php echo $item['item_id'];?>" data-quantity="<?php echo intval($quantity)?>" data-deposit="<?php echo intval($deposit)?>" data-price="<?php echo intval($price)?>" > 
								</div><?php */?> 
						</div> 
					</div>
					
					<div class="item-cart-delete" >
						<a class="item-cart-delete" href="javascript:void(0);" data-iddel="<?php echo $item['item_id']; ?>"><i class="fa fa-times fa-1x"></i></a> 
					</div> 
				</li> 
			 <?php endforeach; 
					$finaltotal = ($total_order - $saleoff) + $shipping;		
				?> 
		  </ul>
		  </div> 

		 <?php if(count($BookingItems) >= 1){?>
			<div class="box-bottom-form box-shadow01rem col-md-12" style="text-align: right; margin-top: 10px; font-size: 16px !important"> 
				<div class="col-md-12 item-cart-total-box" style="clear:both;">
					<p>Tổng tiền</p>
					<p class="total-price total" data-value="<?php echo $total_order; ?>"><?php echo number_format($total_order, 0, '.', '.'); ?>₫</p>
				</div><hr style="height: 1px; color:rgba(233,233,233,0.6)">
				<div class="col-md-12 item-cart-total-box">
					<p>Giảm giá</p>
					<p class="total-price $saleoff" data-value="<?php echo $saleoff; ?>"><?php echo number_format($saleoff, 0, '.', '.'); ?>₫</p>
				</div><hr style="height: 1px; color:rgba(233,233,233,0.6)">
				<div class="col-md-12 item-cart-total-box">
					<p>Phí vận chuyển</p>
					<p class="total-price shipping fee" data-value="<?php echo $shipping; ?>"><?php echo number_format($shipping, 0, '.', '.'); ?>₫</p>
				</div><hr style="height: 1px; color:rgba(233,233,233,0.6)">
				<div class="col-md-12 item-cart-total-box">
					<p>Thành tiền</p>
					<p class="total-price f-total" data-value="<?php echo $finaltotal; ?>"><?php echo number_format($finaltotal, 0, '.', '.'); ?>₫</p>
				</div> 
			</div> 
		<?php } ?> 
		<?php endif; ?> 
			<input type="checkbox" id="chkAgree" checked>  <label for="chkAgree"> Tôi đồng ý <a href="<?=get_site_url()?>/terms-of-use/" target="_blank"><strong>điều khoản và chính sách mua hàng</strong></a> của YMH.</label>
		 </div>
	</div>	
	 
	<div class="box-bottom-form" style="text-align: right; margin-top: 20px;">
		<button type="button" class="btnSubmit btnStep Prev btn-clip btn-border-red" id="btnPrevStep">QUAY LẠI</button>
		<button type="button" class="btnSubmit btnCancel Order btn-clip btn-border-red" id="btnCancelOrder">HỦY ĐƠN HÀNG</button>
		<button type="button" class="btnSubmit btnStep Finish btn-clip btn-red" id="btnFinish">XÁC NHẬN ĐƠN HÀNG</button>
	</div> 
</div> 
<style> 
	.details .h__drawer-list li{padding: 5px 0px; }
	.details .h__drawer-list li div{ margin: 0px; }
	.details .h__drawer-list li img{height:auto !important; max-width: 120px; margin:5px auto;}
	.item-cart-img, .item-cart-info-box{margin:0; padding:3px;} 
	
	.item-cart-detail-info{display:block;/*border: 1px solid;padding: 0; margin: 0;*/}
	
	.item-cart-detail-price{display:block; text-align: right; /*padding: 0; margin: 0; border: 1px solid;*/}
	
	.item-cart-detail-price .item-price {
    font-size: 23px; clear: both }
	.text-right{text-align: right;}
	.booking .h__drawer-list li a {
		display: block;
		grid-template-columns: ;
		grid-auto-rows: auto;
		align-items: center;
		margin-bottom: 3px;
	}
	.details div.item-cart-delete{display:flex; text-align: center; border: 1px solid #EEE; box-shadow: 1px 0px 3px 0px #EEE;  height:20px ; width:20px ; position: absolute; top:0; right: 0px; padding: 2px; }
	 .details a.item-cart-delete {display:block; text-align: center; position: relative; padding: 2px 6px !important; }
	 
	.details a.item-cart-delete i{max-width: 15px ; font-size: .9em;}
	
	.booking hr{padding: 0; height: 2px; margin: 5px auto}
	
	.info-deliver ul{padding-left: 15px; list-style: disc; margin: 10px 10px;}
	
	@media (max-width:768){
		.details .h__drawer-list li img{height:auto !important; max-width: 90%; margin:20px auto;}
	}
</style>
<?php include_once(WP_PLUGIN_DIR.'/commerce-cms/html/order-form-step-3-script.php') ; //Dieu khien cac nut ?>
