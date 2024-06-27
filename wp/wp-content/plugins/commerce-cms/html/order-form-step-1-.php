<?php
/**
* Order Step
*
*/
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$ListBookings = get_list_Items_Cookie();

$BookingItems = false;
if(isset($ListBookings['booking_items'] ))
	$BookingItems = $ListBookings['booking_items'] ;
 
//print_r($_COOKIE['booking_cookie']  );
//print_r($_COOKIE);
?>
<script>
    console.log(<?= json_encode($ListBookings); ?>);
</script>
<form method="post" > 
	<div class="form-content ">
	<?php if ($BookingItems) : ?>
		<ul class="h__drawer-list">
		<?php  
			foreach ($BookingItems as $item) :
				  
			$color = $item['color'];
			$feature_img = $item['imgcolor'];
			$price =  $item['price'] ;
			$price = intval(str_replace(".","", $price)); 
			$quantity = intval($item['quantity']);
			$deposit = intval($item['deposit']);
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
									<p class="item-price fnt-oswald"><?php echo number_format($price, 0, '.', '.'); ?>₫</p>
									<?php if($deposit > 0) echo '<p class="deposit">('.number_format($deposit, 0, '.', '.').'Đ Deposit)</p>' ?>
									 
								</div> 
								<div class="p-detail-quantity item-cart-detail-quantity fnt-oswald">
									<span>Số lượng</span>
									<button type="button" class="btn btn-link shadow-none text-decoration-none btn-mins">-</button>
									<div class="quantity"><?php echo $quantity?></div>
									<button type="button" class="btn btn-link shadow-none text-decoration-none btn-plus">+</button>
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
						<p class="total-price sub-total"><?php echo number_format($subtotal, 0, '.', '.'); ?>₫</p>
					</div> 
				</li> 
			 <?php endforeach; ?> 
		  </ul>
	     
 <?php if(count($BookingItems) >= 1){?>
        <div class="box-bottom-form box-shadow01rem total-price total-order" style="text-align: right; margin-top: 10px;">
		
			<p>Total</p>
            <p class="total-price total-order"><?php echo number_format($total_order, 0, '.', '.'); ?>₫</p> 
            <button type="button" class="btnSubmit btnUpdate Order btn-clip btn-border-red" id="btnbtnUpdate">CẬP NHẬT GIỎ HÀNG</button>
			 
		</div> 
		<?php } ?>
		
		<div class="box-bottom-form box-shadow03rem" style="text-align: right; margin-top: 20px;">
		<?php if(count($BookingItems) >= 1){?>
			<a class="btn-clip btn-border-red" href="/bikes/" id="btnGoShop">TIẾP TỤC CHỌN</a>
			<button type="button" class="btnSubmit btnCancel Order btn-clip btn-border-red" id="btnCancelOrder">HỦY ĐƠN HÀNG</button>
			<?php } ?>
			<button type="button" class="btnSubmit btnStep Next btn-clip btn-red" id="btnNextStep">TIẾP THEO</button>
		</div> 
		<?php else: ?> 
		<a class="btn-clip btn-border-red" href="/bikes/"  id="btnBackShop">TRỞ LẠI CỬA HÀNG</a>
		<?php endif; ?> 
	</div>
</form> 
<script type="text/javascript">
$(document).ready(function() { 
	$('#btnNextStep').click(function() { 
		$(location).attr('href', '/booking/?step=<?php echo ($step+1)?>');
	});
});
</script>