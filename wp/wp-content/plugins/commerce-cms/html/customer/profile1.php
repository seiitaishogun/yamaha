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
//$dtTable = $wpdb->prefix.'province';
//$province = $wpdb->get_results ( "SELECT * FROM $dtTable ORDER BY province_name "); 
// echo '<pre>';
// print_r($province);
// echo '</pre>';
// $k = array_search(30, array_column($province, 'province_id'));
// echo $province[array_search(30, array_column($province, 'province_id'))]->province_name;
?>

<section class="profile-page container-fluid bg-white py-5">
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-1">
                    <div class="avatar">
                    <img src="" alt=""/>
                    </div>
                </div>
                <div class="col-lg-11 align-self-center">
                    <div class="ml-3">

                        <p class="customer-name"><?=$current_user_profile->full_name ;?> <span class="ticked ml-2"><img src="<?php echo get_template_directory_uri();?>/img/ic_ticked.svg" alt=""></span></p>
                        <span class="font-weight-bold">(Đã xác thực)</span>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <form method="post" id="frmProfile" name="frmProfile">
    <div class="row mt-5">
        <div class="col-lg-6">
            <p class="font-weight-bold">THÔNG TIN CỦA BẠN</p>
            <input class="ymh-input-style w-100 my-2 " type="text" name="fullname" required placeholder="Họ tên"  value="<?=$current_user_profile->full_name?>"/>
			<input type="hidden" name="ID" value="<?=$current_user_profile->ID  ?>"/>
			<input type="hidden" name="user_id" value="<?=$current_user->ID ?>"/>
            <div class="row  mb5 mt5">
                <div class="col-lg-6">
                    <input class="ymh-input-style w-100 my-2" type="tel" required placeholder="Số điện thoại" name="phone" value="<?=$current_user_profile->phone?>"/>
                </div>
                <div class="col-lg-6 pl-0">
                    <input class="ymh-input-style w-100 my-2" type="email" required name="email"  placeholder="Địa chỉ mail"  value="<?=$current_user->user_email ?>"/>
                </div>
            </div>
            <input class="ymh-input-style w-100 my-2 " type="text" name="address" required  placeholder="Địa chỉ" value="<?=$current_user_profile->address?>"/>
            
            <input type="hidden" name="fulladdress" id="fulladdress" value="<?=$current_user_profile->address?>"/>
            
            <div class="row my-2 mt10">
                <div class="col-lg-12">
                    <div class="location-section p-3 mt5">
                        <p class="font-weight-bold">Location <span class="text-danger">*</span></p>
                        <div class="form-group">
							<select class="form-control " name="province_id" id="usrProvince" >
								<option selected="" value=""> Tỉnh / Thành</option>
								<?php if(function_exists('get_html_option_for_select')){ get_html_option_for_select($stable = 'province', $fields=array('fname'=>'province_name', 'fkey'=>'province_id'), $selected_val = $current_user_profile->province_id); } ?>
							</select>
						</div> 
						<div class="form-group">
							<select class="form-control " name="district_id" id="usrDistrict">
								<option selected="" value=""> Quận huyện</option>
							</select>
						</div> 
						<div class="form-group">
							<select class="form-control " name="ward_id" id="usrWard">
								<option selected="" value=""> Phường / Xã</option>
							</select>
						</div> 
                    </div>
                </div>
            </div>
            
        </div>
        <div class="col-lg-6">
            <p class="font-weight-bold pt10 ">Mật khẩu</p>
            <div class="form-group col-lg-12">   
				<div class="input-group mb20" >                    
					<input type="password" name="password" class="form-control tmt-pass"  placeholder="Mật khẩu" required="required">
					<div class="input-group-append tmt-pass-apend">
						<span class="input-group-text">
							<i class="fas fa-eye"></i>
						</span>
					</div>
				</div>  
			</div>
            <div class="form-group col-lg-12">   
					<div class="input-group mb20" >                    
						<input type="password" name="newpassword" id="newpassword" class="form-control tmt-pass"  placeholder="Mật khẩu mới" required="required">
						<div class="input-group-append tmt-pass-apend">
							<span class="input-group-text">
								<i class="fas fa-eye"></i>
							</span>
						</div>
					</div>  
				</div>
				<div class="form-group col-lg-12"> 
					<div class="input-group mb20" >                    
						<input type="password" name="re_password" id="re_password" class="form-control tmt-pass" placeholder="Nhập lại Mật khẩu mới" required="required">
						<div class="input-group-append tmt-pass-apend">
							<span class="input-group-text">
								<i class="fas fa-eye"></i>
							</span>
						</div>
					</div>  
				</div>

            <a href="javascript:void(0)" id="btnSaveCustomer" class="btn-clip btn-red mt-4 float-right" >Lưu</a>
        </div>
    </div>
	</form>
</section>
<?php include_once(WP_PLUGIN_DIR.'/commerce-cms/frm/province_cc.js.php'); ?>
<script type="text/javascript">
	var usrprovince = '<?=$current_user_profile->province_id?>';
	var usrdistrict = '<?=$current_user_profile->district_id?>';
	var usrward = '<?=$current_user_profile->ward_id?>';
$(document).ready(function() { 
	
	get_ajax_sub_element(pr_element = '#usrProvince', chd_element = '#usrDistrict', action_get = 'ajax_get_district', value_selected= usrdistrict, chdchd_element = '#usrWard' ); 
	
	$("#usrProvince").change(function(){
		get_ajax_sub_element(pr_element = '#usrProvince', chd_element = '#usrDistrict', action_get = 'ajax_get_district', value_selected= $(this).val(), chdchd_element = '#usrWard' );
	});
	
	$("#usrDistrict").change(function(){
		get_ajax_sub_element(pr_element = '#usrDistrict', chd_element = '#usrWard', action_get = 'ajax_get_ward', value_selected= $(this).val() );
	});
});
</script>