<?php
/**
* Order LIST
*
*/
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
$freeCoupon = $FREE_COUPON->get_free_cupon_of_customer($current_user_profile->user_id);
// echo '<pre>';
// print_r($freeCoupon);
// echo '</pre>';
?>
<section class="my-free-coupon container-fluid" id="my_orders">
    <div class="mt-4 pt-1"></div>
    <?php 
    if($freeCoupon) {
    foreach($freeCoupon as $single_fc) {?>
    <div class="row free-coupon <?= ($single_fc->applied) ? 'fc-used' : '' ;?>">
        <div class="col-4 col-lg-2 free-icon"></div>
        <div class="col-8 col-lg-10 free-cp-content">
            <div class="row">
                <div class="col-lg-9 fc-detail">
                    <p class="code ff-1"><?= $single_fc->free_coupon_name ;?></p>
                    <p class="descrip">Mô tả coupon</p>
                    <div class="d-flex justify-content-between">
                        <p class="date">HSD: <?=date("d/m/Y",strtotime($single_fc->warranty_expired_date)); ?></p>
                        <p class="fc-status d-block d-sm-none"><?= ($single_fc->applied) ? 'Đã sử dụng' : 'Chưa sử dụng' ;?></p>
                    </div>
                    
                </div>
                <div class="col-lg-3 fc-status d-none d-sm-block">
                    <p><?= ($single_fc->applied) ? 'Đã sử dụng' : 'Chưa sử dụng' ;?></p>
                </div>    
            </div>
        </div>
        
    </div>
    <?php } } else {?>
        <div class="h-100 ">
            <h4 class="ff-1 text-muted text-center">Bạn chưa có phiếu giảm giá.</h4>
        </div>
        
        <?php }?>
    
</section>