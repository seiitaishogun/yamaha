<?php
/**
* Order LIST
*
*/
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
// echo '<pre>';
// print_r($current_user_profile);
// echo '</pre>';
$dtTable = $wpdb->prefix.'province';
$province = $wpdb->get_results ( "SELECT * FROM $dtTable ORDER BY province_name "); 
// echo '<pre>';
// print_r($province);
// echo '</pre>';
// $k = array_search(30, array_column($province, 'province_id'));
// echo $province[array_search(30, array_column($province, 'province_id'))]->province_name;
?>

<section class="address-book-page container-fluid bg-white py-5">
    <a id="btnAddAdress" href="javascript:void(0);"><img src="<?php echo get_template_directory_uri();?>/img/button/btn-corner-add-new.svg" alt=""></a>
    <div class="mb-5"></div>
    <div class="row my-2">
        <div class="col-lg-12">
            <div class="single-address-item p-3 pb-4 mb-4">
                <p class="customer-name font-weight-bold">Vuong Lee Wang<span class="ml-3 px-2 py-1 mark-selected font-weight-normal">Default</span></p>
                <div class="row px-3">
                    <div class="col-lg-6 py-3 bg-white info-customer">
                        <p>384/1C Nam Ky Khoi Nghia, Phuong Vo Thi Sau, Q3, HCMC</p>
                        <p class="font-weight-bold">Số điện thoại: <span style="color: red;">083 848 8283</span></p>
                    </div>
                    <div class="col-lg-6 align-self-center text-right customer-action">
                        <a href="javascript:void(0);"><img src="<?php echo get_template_directory_uri();?>/img/button/btn-corner-edit.svg" alt=""></a>
                        <a class="mx-3" href="javascript:void(0);"><img src="<?php echo get_template_directory_uri();?>/img/button/btn-corner-set-default.svg" alt=""></a>
                        <a href="javascript:void(0);"><img src="<?php echo get_template_directory_uri();?>/img/button/btn-corner-delete.svg" alt=""></a>
                    </div>
                </div>
            </div>
            <div class="single-address-item p-3 pb-4 mb-4">
                <p class="customer-name font-weight-bold">Vuong Lee Wang</p>
                <div class="row px-3">
                    <div class="col-lg-6 py-3 bg-white info-customer">
                        <p>384/1C Nam Ky Khoi Nghia, Phuong Vo Thi Sau, Q3, HCMC</p>
                        <p class="font-weight-bold">Số điện thoại: <span style="color: red;">083 848 8283</span></p>
                    </div>
                    <div class="col-lg-6 align-self-center text-right customer-action">
                        <a href="javascript:void(0);"><img src="<?php echo get_template_directory_uri();?>/img/button/btn-corner-edit.svg" alt=""></a>
                        <a class="mx-3" href="javascript:void(0);"><img src="<?php echo get_template_directory_uri();?>/img/button/btn-corner-set-default.svg" alt=""></a>
                        <a href="javascript:void(0);"><img src="<?php echo get_template_directory_uri();?>/img/button/btn-corner-delete.svg" alt=""></a>
                    </div>
                </div>
            </div>
            <div class="single-address-item p-3 pb-4 mb-4">
                <p class="customer-name font-weight-bold">Vuong Lee Wang</p>
                <div class="row px-3">
                    <div class="col-lg-6 py-3 bg-white info-customer">
                        <p>384/1C Nam Ky Khoi Nghia, Phuong Vo Thi Sau, Q3, HCMC</p>
                        <p class="font-weight-bold">Số điện thoại: <span style="color: red;">083 848 8283</span></p>
                    </div>
                    <div class="col-lg-6 align-self-center text-right customer-action">
                        <a href="javascript:void(0);"><img src="<?php echo get_template_directory_uri();?>/img/button/btn-corner-edit.svg" alt=""></a>
                        <a class="mx-3" href="javascript:void(0);"><img src="<?php echo get_template_directory_uri();?>/img/button/btn-corner-set-default.svg" alt=""></a>
                        <a href="javascript:void(0);"><img src="<?php echo get_template_directory_uri();?>/img/button/btn-corner-delete.svg" alt=""></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>

<section class="create-address-book-page container-fluid bg-white py-5">
    
    <h2 class="title">Tạo sổ địa chỉ</h2>
        
    <div class="row justify-content-center">
        
        <div class="col-lg-6">
            <input class="ymh-input-style w-100 my-1" type="text" name="" id="" placeholder="Full Name" value="<?= $current_user_profile->email ;?>">
            <input class="ymh-input-style w-100 my-1" type="text" name="" id="" placeholder="Phone Number" value="<?= $current_user_profile->email ;?>">
            <input class="ymh-input-style w-100 my-1" type="text" name="" id="" placeholder="Address" value="<?= $current_user_profile->email ;?>">
            <div class="row my-2">
                <div class="col-lg-12">
                    <div class="location-section p-3">
                        <p class="font-weight-bold">Location</p>
                        <div class="dropdown">
                            <div class="cs-select-style">
                                <a class="btn border w-100 py-3 text-left bg-white text dropdown-toggle d-flex justify-content-between my-2" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                City
                                </a>
                                <div class="dropdown-menu w-100 rounded-0" aria-labelledby="dropdownMenuLink">
                                    <?php foreach( $province as $item ) : ?>
                                    <a class="dropdown-item" href="javascript:void(0);"><?=$item->province_name?></a>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            
                            <div class="cs-select-style">
                                <a class="btn border w-100 py-3 text-left bg-white text dropdown-toggle d-flex justify-content-between my-2" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                District
                                </a>
                                <div class="dropdown-menu w-100 rounded-0" aria-labelledby="dropdownMenuLink">
                                    <a class="dropdown-item" href="javascript:void(0);">Action</a>
                                    <a class="dropdown-item" href="javascript:void(0);">Another action</a>
                                    <a class="dropdown-item" href="javascript:void(0);">Something else here</a>
                                </div>
                            </div>

                            <div class="cs-select-style">
                                <a class="btn border w-100 py-3 text-left bg-white text dropdown-toggle d-flex justify-content-between my-2" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Quarter
                                </a>
                                <div class="dropdown-menu w-100 rounded-0" aria-labelledby="dropdownMenuLink">
                                    <a class="dropdown-item" href="javascript:void(0);">Action</a>
                                    <a class="dropdown-item" href="javascript:void(0);">Another action</a>
                                    <a class="dropdown-item" href="javascript:void(0);">Something else here</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center mt-3">
        <div class="col-lg-6">
            <div class="row">
                <div class="col-lg-6">
                    <label class="ct-radio-input mt-2">
                        <input type="checkbox" name="chklogin" value="login" checked>
                        <span class="chk-content">Đặt làm địa chỉ mặc định</span>
                    </label>
                </div>
                <div class="col-lg-6 text-right">
                    <a href="javascript:void(0);"><img src="<?php echo get_template_directory_uri();?>/img/button/btn-corner-add-new.svg" alt=""></a>
                </div>
            </div>
        </div>                 
    </div>
    
      	
</section>

<script type="text/javascript">
    $(document).ready(function() {
        $('.create-address-book-page').hide();
        $('#btnAddAdress').click(function(){
            if($('.address-book-page').is(':visible') && !$('.create-address-book-page').is(':visible')){
                $('.address-book-page').hide();
                $('.create-address-book-page').show();
            }
        });
    });
</script>