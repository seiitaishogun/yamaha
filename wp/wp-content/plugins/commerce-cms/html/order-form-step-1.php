<?php
/**
* Order Step
*
*/
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
global $ListBookings, $BookingItems, $cart_count, $current_user;

if(!isset($ListBookings )){
	$ListBookings = get_list_Items_Cookie();
} 
$BookingItems = false;
if(isset($ListBookings['booking_items'] )){
	$BookingItems = $ListBookings['booking_items'] ;
	$cart_count=count($BookingItems);
}

//print_r($BookingItems  );
//print_r($_COOKIE);
?> 
<form method="post" > 
	<div class="form-content" id="Booking_Table">
		<ul class="h__drawer-list" id="Booking_Items">
	<?php /*?><?php if ($BookingItems) : ?> 
		<?php  $total_order = 0;
			foreach ($BookingItems as $item) :
				$deposit = 0;
				$item_id = $item['item_id'];	  
				$color = $item['color'];
				$feature_img = $item['image'];
				$price =  $item['price'] ; 
				$price_old =  $item['price_old'] ;  
			
				$size =  $item['size'] ;
				$price = intval(str_replace(".","", $price)); 
				$price_old = intval(str_replace(".","", $price_old));
			
				$quantity = intval($item['quantity']);
				$deposit = intval(str_replace(".","", $item['deposit']));
				
				$dealer_id = $item['dealer_id'] ;
				$dealer_name = $item['dealer_name'] ;
				$dealer_address = $item['dealer_address'];
			
				$sale_off = 0;
				if(isset($item['sale_off']))
					$sale_off = intval($item['sale_off']);
			
			if($quantity==0) {$quantity=1;}
			
				$subtotal = ($price * $quantity)-(($deposit*$quantity) + $sale_off);
			if($deposit>0){
				$subtotal = ($deposit*$quantity) ;
			}
				$total_order = $total_order + $subtotal;
			
				if(isset($item['item_id'])){
				
				?>
				<li class="box-shadow01rem item-shopping-cart" data-type="<?php echo get_post_type($item_id); ?>" data-id="<?php echo $item_id;?>" data-quantity="<?php echo intval($quantity)?>" data-deposit="<?php echo intval($deposit)?>" data-price="<?php echo intval($price)?>" data-price-old="<?php echo intval($price_old)?>" data-sale_off="<?php echo intval($sale_off)?>" data-subtotal="<?php echo intval($subtotal)?>" data-dealer-id="<?php echo $dealer_id ;?>">
					<div class="row">
						<div class="col-md-2 col-12 align-self-center align-items-center item-cart-img">
							<a href="<?php echo get_permalink($item_id) ?>" class="product-link" alt="<?php echo get_the_title($item_id) ?>" >
								<img src="<?php echo $feature_img; ?>" alt="<?php echo get_the_title($item_id)?>" class="box-img lazyload" />
							</a>
						</div>
						<div class="col-md-10 col-12 align-self-center align-items-center item-cart-detail-box">
							<div class="d-lg-flex col-lg-12 col-12 align-items-center align-self-center item-cart-info-box " >
								<div class="col-md-5 col-12 align-self-center align-items-center item-cart-detail-info" data-id="<?php echo $item_id; ?>"> 
									<p class="fnt-oswald fnt-18"><?php echo get_the_title($item_id); ?></p>
									<p class="showroom dealer"><?php echo $dealer_name; ?></p>
									<p class="saleofftext"><?php echo 'Chương trình khuyến mãi'; ?></p>
								<?php //echo  get_post_type($item_id) ?>
								</div>
								<div class="col-md-4 col-12 align-self-center price item-cart-detail-price pr80 " >
									<?php if(get_post_type($item_id)=='bike' || get_post_type($item_id) == 'product'){ ?>
										<?php if($deposit>0){ ?>
										 <p class="fnt-oswald fnt-20"><span class="price"><?php echo currencyFormat($deposit); ?> </p> 
										 <?php } ?>
										<p class="deposit">(Giá niêm yết: <?php echo currencyFormat($price); ?>)</p>
									<?php } else { ?>
											<p class="fnt-oswald fnt-20"><span class="price"><?php echo currencyFormat($price); ?> </p>
									<?php } ?>
									<?php if($price_old>0){ ?>
									 <span class="fnt-oswald colorLGray price-old"><?php echo currencyFormat($price_old); ?></span> 
									 <?php } ?> 
									 <?php if((get_post_type($item_id)=='item' || get_post_type($item_id)=='apparel') && $sale_off>0){ ?> 
									 <p class="sale_off">size: <?php echo $sale_off?></p> 
									 <?php } ?>
								</div>
								<div class="col-md-1 col-12 align-self-center p-detail-quantity item-cart-detail-quantity pt20 pl20"> 
									<button type="button" class="btn btn-link btntt shadow-none text-decoration-none btn-mins">-</button> 
									<div class="quantity fnt-oswald fnt-20"><?php echo $quantity?></div>
									<button type="button" class="btn btn-link btntt shadow-none text-decoration-none btn-plus">+</button> 
								</div>
								 
								<div class="col-md-2 col-12 align-self-center subtotal item-cart-detail-price" >
									<p class="item-price subtotal fnt-oswald"><span class="price">
									<?php echo currencyFormat($subtotal); ?></span></p> 
								</div>
							</div> 
						</div> 
					</div>
					
					<div class="item-cart-delete" >
					<a class="item-cart-delete" href="javascript:void(0);" data-iddel="<?php echo $item['item_id']; ?>"><i class="fa fa-times fa-1x"></i></a> 
					</div> 
				</li> 
			 <?php } endforeach; ?>	
			<?php endif; ?>	<?php */?> 
			
		  </ul> 
		
		<div class="box-shadow00rem pd20" id="cart-action">
			<div class="row">
				<div class="col-md-5 col-12 text-left">
					<a class="link" href="<?=get_site_url()?>" id="btnGoShop"><i class="fas fa-angle-double-left"></i> Tiếp tục mua sắm</a>
				</div>
				<div class="col-md-7 col-12 pr80 text-right" > 	
					<button type="button" class="btnSubmit btnStep Next btn-clip btn-red" id="btnNextStep">THANH TOÁN &nbsp;&nbsp;<i class="fas fa-angle-right colorWhite"></i></button> 
				</div> 
			</div> 
		</div>
		
	</div>
</form> 
<script type="text/javascript"> 

DATA_CARD_SPLITED = split_Items_By_Product_Type(DATA_CARD);

console.log(DATA_CARD_SPLITED);
	
$(document).ready(function() { 
	$('#btnNextStep').click(function() { 
		$(location).attr('href', '<?=get_site_url()?>/booking/?step=<?php echo ($step+1)?>');
	});
	if( getCart_count()>0) { 
		render_booking_data(Booking_Table = $('#Booking_Table'), Booking_Items = $('#Booking_Items') );	
	}else{
		showPopup('<div class="colorRed fnt-18 text-center pt40 pb40">Giỏ hàng chưa có sản phẩm!<br><br><a class="btn-clip btn-border-red colorBlue" href="<?=get_site_url()?>">Quay lại trang mua sắm.</a></div>  ', el=$('.popup_content'));

		setTimeout(function(){hidePopup(); },4000);
		setTimeout(function(){window.location.href='<?=get_site_url()?>';},1000);
	}
}); 

</script>
<?php 
	//write_javascript_plus_minus_quantity($bookType='apparel' );
	write_javascript_update_cart($bookType='apparel' );
	write_javascript_render_booking_data();
?> 
