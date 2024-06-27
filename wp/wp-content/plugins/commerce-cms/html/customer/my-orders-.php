<?php
/**
* Order LIST
*
*/
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

?>
<section class="container-fluid min-vh-100 bg-white">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-6 reset-pw">
            
            <p class="fz-24 fw-600 mt-5 text-uppercase ff-oswald"><strong>Nhập ID đơn hàng</strong></p>
            <input class="border w-100" type="text" name="" id="" placeholder="ID đơn hàng">
            
            <button class="btn-corner-red mt-5">Tìm kiếm</button>
            
        </div>
    </div>
</section>
<section class="my-orders container-fluid bg-white py-3">
    
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="w-50 mx-auto">
            <span class="order-id">Order #asdasdas</span> 
            <a class="btn-copy ml-3" style="vertical-align: super;" href="">
                <span class="mr-2 position-relative">
                    <img class="position-absolute" style="left: 2px;bottom: 2px;" src="<?php echo get_template_directory_uri();?>/img/ic_copy.svg" alt="">
                    <img src="<?php echo get_template_directory_uri();?>/img/ic_copy_bg.svg" alt="">
                </span>
            Copy</a> 
            <p class="mt-1 status-order">Đơn hàng thành công</p>
        </div>
    </div>
</div>

<div id="single-order-flow" class="carousel slide" data-ride="false">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="row product-item">
                <div class="col-lg-3">
                    <img src="<?php echo get_template_directory_uri();?>/img/compare/img-bike-1.png" alt="">
                </div>
                <div class="col-lg-5 align-self-center" style="padding-left: 8px;">
                    <p class="name-product">MT-09 Storm Fluo x2</p>
                </div>
                <div class="col-lg-4 align-self-center">
                    <p class="sub-total-product"><?= currencyFormat('99000000'); ?></p>
                </div>
            </div>
            <div class="row product-item">
                <div class="col-lg-3">
                    <img src="<?php echo get_template_directory_uri();?>/img/compare/img-bike-1.png" alt="">
                </div>
                <div class="col-lg-5 align-self-center" style="padding-left: 8px;">
                    <p class="name-product">MT-09 Storm Fluo x2</p>
                </div>
                <div class="col-lg-4 align-self-center">
                    <p class="sub-total-product"><?= currencyFormat('99000000'); ?></p>
                </div>
            </div>
            <div class="info-follow-order text-center mt-4">
                    <p class="info-shipper">Người phụ trách: <span class="cl-red">Mr. tam</span> | SDT: <span class="cl-red">039 475 9684</span></p> 
                    
                    <p class="info-shipper">Dealer | SDT: <span class="cl-red">039 475 9684</span></p> 
                    
                    <div class="status-follow my-4">
                        <div class="step-four d-flex active-status">
                            <div class="step-three d-flex">
                                <div class="step-two d-flex">
                                    <div class="step-one d-flex">
                                        <div class="status-line w-33"></div>
                                        <div class="text-status">
                                            <img class="none-check" src="<?php echo get_template_directory_uri();?>/img/my-order/ic_check.svg" alt="">
                                            <img class="checked" src="<?php echo get_template_directory_uri();?>/img/my-order/ic_check_red.svg" alt="">
                                            
                                            <p>Đã xác nhận</p>
                                            
                                        </div>
                                            
                                    </div>
                                    <div class="status-line w-102"></div>
                                    <div class="text-status">
                                        <img class="none-check" src="<?php echo get_template_directory_uri();?>/img/my-order/ic_business.svg" alt="">
                                        <img class="checked" src="<?php echo get_template_directory_uri();?>/img/my-order/ic_business_red.svg" alt="">
                                        <p>Đã nhập hàng</p>
                                    </div>
                                </div>
                                <div class="status-line w-102"></div>
                                <div class="text-status">
                                    <img class="none-check" src="<?php echo get_template_directory_uri();?>/img/my-order/ic_package.svg" alt="">
                                    <img class="checked" src="<?php echo get_template_directory_uri();?>/img/my-order/ic_package_red.svg" alt="">
                                    <p>Đã đóng hàng</p>
                                </div>
                                </div>  
                            <div class="status-line w-102"></div>
                                <div class="text-status">
                                    <img class="none-check" src="<?php echo get_template_directory_uri();?>/img/my-order/ic_truct.svg" alt="">
                                    <img class="checked" src="<?php echo get_template_directory_uri();?>/img/my-order/ic_truct_red.svg" alt="">
                                    <p>Đang giao hàng</p>
                                </div>
                                <div class="status-line w-33"></div>
                        </div>
                    </div>
                    
            </div>
        </div>
      </div>
    </div>
    <div class="carousel-item">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="row product-item">
                <div class="col-lg-3">
                    <img src="<?php echo get_template_directory_uri();?>/img/compare/img-bike-1.png" alt="">
                </div>
                <div class="col-lg-5 align-self-center" style="padding-left: 8px;">
                    <p class="name-product">MT-09 Storm Fluo x2</p>
                </div>
                <div class="col-lg-4 align-self-center">
                    <p class="sub-total-product"><?= currencyFormat('99000000'); ?></p>
                </div>
            </div>
            <div class="info-follow-order text-center mt-4">
                    <p class="info-shipper">Người phụ trách: <span class="cl-red">Mr. tam</span> | SDT: <span class="cl-red">039 475 9684</span></p> 
                    
                    <p class="info-shipper">Dealer | SDT: <span class="cl-red">039 475 9684</span></p> 
                    
                    <div class="status-follow my-4">
                        <div class="step-four d-flex">
                            <div class="step-three d-flex active-status">
                                <div class="step-two d-flex">
                                    <div class="step-one d-flex">
                                        <div class="status-line w-33"></div>
                                        <div class="text-status">
                                            <img class="none-check" src="<?php echo get_template_directory_uri();?>/img/my-order/ic_check.svg" alt="">
                                            <img class="checked" src="<?php echo get_template_directory_uri();?>/img/my-order/ic_check_red.svg" alt="">
                                            <p>Đã xác nhận</p>
                                        </div>
                                            
                                    </div>
                                    <div class="status-line w-102"></div>
                                    <div class="text-status">
                                        <img class="none-check" src="<?php echo get_template_directory_uri();?>/img/my-order/ic_business.svg" alt="">
                                        <img class="checked" src="<?php echo get_template_directory_uri();?>/img/my-order/ic_business_red.svg" alt="">
                                        <p>Đã nhập hàng</p>
                                    </div>
                                </div>
                                <div class="status-line w-102"></div>
                                <div class="text-status">
                                    <img class="none-check" src="<?php echo get_template_directory_uri();?>/img/my-order/ic_package.svg" alt="">
                                    <img class="checked" src="<?php echo get_template_directory_uri();?>/img/my-order/ic_package_red.svg" alt="">
                                    <p>Đã đóng hàng</p>
                                </div>
                                </div>  
                            <div class="status-line w-102"></div>
                                <div class="text-status">
                                    <img class="none-check" src="<?php echo get_template_directory_uri();?>/img/my-order/ic_truct.svg" alt="">
                                    <img class="checked" src="<?php echo get_template_directory_uri();?>/img/my-order/ic_truct_red.svg" alt="">
                                    <p>Đang giao hàng</p>
                                </div>
                                <div class="status-line w-33"></div>
                        </div>
                    </div>
                    
            </div>
        </div>
      </div>
    </div>
  </div>
  <a class="carousel-control-prev" href="#single-order-flow" role="button" data-slide="prev" style="bottom: auto;top: 80px;">
    <span class="carousel-control-prev-icon" aria-hidden="true"><img src="<?php echo get_template_directory_uri();?>/img/ic-prev.svg" alt=""></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#single-order-flow" role="button" data-slide="next" style="bottom: auto;top: 80px;">
    <span class="carousel-control-next-icon" aria-hidden="true"><img src="<?php echo get_template_directory_uri();?>/img/ic-next.svg" alt=""></span>
    <span class="sr-only">Next</span>
  </a>
</div>
<div class="row justify-content-center">
    <div class="col-lg-8 text-center">
        
        <a data-toggle="modal" data-target="#btnCancelOrder" style="background: url('<?php echo get_template_directory_uri();?>/img/button/btn-bg-grey.svg') no-repeat;" class="btn-cancel my-4"  href=""> <p>Hủy đơn hàng</p> </a>
  
        <p class="cl-red" style="font-size: 14px;">Liên hệ chăm sóc khách hàng theo số: <span class="font-weight-bold">1900 1938</span></p>
    </div>
</div>	
</section>
<!-- Modal -->
<div class="modal fade" id="btnCancelOrder" tabindex="-1" role="dialog" aria-labelledby="btnCancelOrderLabel" aria-hidden="true">
  <div class="modal-dialog" style="max-width: 651px;" role="document">
    <div class="modal-content rounded-0">
      <div class="modal-header border-0 justify-content-center">
        <h4 class="modal-title ff-oswald text-uppercase" id="exampleModalLabel"><strong>Ly do hủy đơn</strong></h4>
      </div>
      <div class="modal-body">
        <div class="custom-select-bst">
            <select class="form-select w-100" aria-label="Default select example">
                <option selected>Tôi không thích</option>
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
            </select>
            <i class="fas fa-chevron-down"></i>
        </div>
        
      </div>
      <div class="modal-footer border-0 justify-content-center">
        <a style="background: url('<?php echo get_template_directory_uri();?>/img/button/btn-bg-dark.svg') no-repeat;" data-dismiss="modal" class="btn-cancel-cs mb-2 shadow-color-grey"  href=""> <p>Thoat</p> </a>
        <div class="mr-4"></div>
        <a style="background: url('<?php echo get_template_directory_uri();?>/img/button/btn-bg-grey.svg') no-repeat;" class="btn-cancel-cs mb-2"  href=""> <p>Hủy đơn hàng</p> </a>
      </div>
    </div>
  </div>
</div>
<!--  -->
<script type="text/javascript">
    $(document).ready(function() {
        $('#btn-cancel-order').click(function(){
           
        });
    });
</script>