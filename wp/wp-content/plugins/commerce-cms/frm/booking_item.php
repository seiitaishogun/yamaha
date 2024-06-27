<li class="box-shadow01rem item-shopping-cart" data-type="@postType" data-id="@dataID" data-quantity="<?php echo intval($quantity)?>" data-deposit="@deposit" data-price="@price" data-price-old="@price_old" data-sale_off="@price_off" data-subtotal="@subtotal" data-dealer-id="@dealer_id">
	<div class="row">
		<div class="col-md-2 col-12 align-self-center align-items-center item-cart-img">
			<a href="@get_permalink" class="product-link" >
				<img src="@image_url" class="box-img lazyload" />
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
					<button type="button" class="btn btn-link btn_plus_minus shadow-none text-decoration-none btn-mins">-</button> 
					<div class="quantity fnt-oswald fnt-20"><?php echo $quantity?></div>
					<button type="button" class="btn btn-link btn_plus_minus shadow-none text-decoration-none btn-plus">+</button> 
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