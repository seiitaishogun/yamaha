<?php
/**
* Order Step
*
*/
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

global $wpdb, $current_user, $current_user_profile;
$table = $wpdb->prefix.'customer';
if(!$current_user)
	$current_user = wp_get_current_user();
if(!$current_user_profile)
	$current_user_profile = $wpdb->get_row ( "SELECT * FROM $table WHERE user_id = {$current_user->ID} ;");

$ListBookings = get_list_Items_Cookie();

$BookingItems = false;
if(isset($ListBookings['booking_items'] ))
	$BookingItems = $ListBookings['booking_items'] ;
 
$current_customer_address = get_customer_address_payment();

$customer_order = (array)$current_user_profile;
?>
 
<div class="form-content ">
	<div class="row">
		<div class="col-md-12"> 
			<div class="form-content box-shadow02rem">
			<h2 class="exbold ff-1">CHI TIẾT ĐƠN HÀNG</h2><hr>
			
	<?php if ($BookingItems) : ?> <div class="spacer-20"></div>
		<ul class="h__drawer-list">
		<?php  
			foreach ($BookingItems as $item) :
				  
			$feature_img = $item['color'];
			$price =  $item['price'] ;
			$price = intval(str_replace(".","", $price)); 
			$quantity = intval($item['quantity']);
			$subtotal = $price * $quantity;
			$total_order += $subtotal;
			$dealer_name = $item['dealer_name'] ;
			$dealer_address = $item['dealer_address'] ;
				?>
				<li class="box-shadow01rem item-shopping-cart">
					<div class="row">
						<div class="d-lg-flex col-lg-2 col-12 align-items-center item-cart-img" style="float: left;">
							<a href="<?php echo get_permalink($item['item_id']) ?>" class="product-link" alt="<?php echo get_the_title($item['item_id']) ?>" >
								<img src="<?php echo $feature_img; ?>" alt="<?php echo get_the_title($item['item_id'])?>" class="box-img lazyload" />
							</a>
						</div>
						<div class=" col-lg-9 col-12 item-cart-detail-box" style="float: right;">
							<div class="item-cart-info-box d-lg-flex col-lg-12 col-12 align-items-center " >
								<div class="item-cart-detail-info" data-id="<?php echo $item['item_id']; ?>">
								<?php /*?><a href="<?php echo get_permalink($item['item_id']) ?>" alt="<?php echo get_the_title($item['item_id']) ?>" > <?php */?>
									<p class="name fnt-oswald"><?php echo get_the_title($item['item_id']); ?></p>
									<p class="showroom dealer"><?php echo $dealer_name; ?></p>
									
								<?php /*?></a>  <?php */?>
								</div>
								<div class="item-cart-detail-price" > 
									<p class="label colorGray">Giá</p>
									<p class="item-price fnt-oswald"><?php echo currencyFormat($price); ?></p>
									<!-- <p class="deposit">(10.000.000Đ Deposit)</p> -->
								</div> 
								<div class="p-detail-quantity item-cart-detail-quantity fnt-oswald">
									<span>Số lượng</span> 
									<div class="quantity"><?php echo $quantity?></div> 
								</div>
								<div class="item-cart-delete" >
								<a class="item-cart-delete" href="javascript:void(0);" data-iddel="<?php echo $item['item_id']; ?>"><i class="fa fa-times fa-2x"></i></a>	
								</div>
							</div>
						</div> 
					</div>
					<hr style="height: 1px; color:rgba(233,233,233,0.6)">
					<div class="col-12 item-cart-total-box">
						<p>Sub total</p>
						<p class="total-price sub-total"><?php echo currencyFormat($subtotal); ?></p>
					</div> 
				</li> 
			 <?php endforeach; ?> 
		  </ul>
	     
		 <?php if(count($BookingItems) > 1){?>
			<div class="box-bottom-form box-shadow01rem" style="text-align: right; margin-top: 10px;">

				<p>Total</p>
				<p class="total-price total-order"><?php echo currencyFormat($total_order); ?></p> 

			</div> 
		<?php } ?>
		 
		<?php endif; ?>
			</div>
		</div>
		<div class="col-md-12">
			<div class="form-content box-shadow02rem">
			<h2 class="exbold ff-1">THÔNG TIN THANH TOÁN</h2><hr>
<?php			
	
 	print_r($current_customer_address);  
			?>
				<div class="product__accordion custom-info-payment">
					<ul>
						<li>
							<strong><?php echo 'Họ và tên' ?></strong>
							<span><?php echo $current_customer_address->full_name ?></span>
						</li>
						<li>
							<strong><?php echo 'Số điện thoại' ?></strong>
							<span><?php echo $current_customer_address->phone ?></span>
						</li>
						<li>
							<strong><?php echo 'Địa chỉ email' ?></strong>
							<span><?php echo $current_customer_address->email ?></span>
						</li>
						<li>
							<strong><?php echo 'Giới tính' ?></strong>
							<span><?php echo $current_customer_address->gender ?></span>
						</li>
						<li>
							<strong><?php echo 'Tỉnh thành' ?></strong>
							<span><?php echo $current_customer_address->province_id ?></span>
						</li>
						<li>
							<strong><?php echo 'Quận/huyện' ?></strong>
							<span><?php echo $current_customer_address->district_id ?></span>
						</li>
						<li>
							<strong><?php echo 'Phường/xã' ?></strong>
							<span><?php echo $current_customer_address->ward_id ?></span>
						</li>
						
					</ul>
				</div>
			</div>
		</div>
	</div>

	<div class="box-bottom-form" style="text-align: right; margin-top: 20px;">
		<button type="button" class="btnSubmit btnStep Prev btn-clip btn-border-red" id="btnPrevStep">QUAY LẠI</button>
		<button type="button" class="btnSubmit btnCancel Order btn-clip btn-border-red" id="btnCancelOrder">HỦY ĐƠN HÀNG</button>
		<button type="button" class="btnSubmit btnStep Next btn-clip btn-red" id="btnFinish">HOÀN TẤT</button>
	</div> 
</div> 

<?php include_once(WP_PLUGIN_DIR.'/commerce-cms/html/order-form-step-3-script.php') ; //Dieu khien cac nut ?>
