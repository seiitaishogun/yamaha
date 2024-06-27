<?php
/**
* FORM Customer
*
*/
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
//print_r($current_user_profile);
?>
<div class="form_Customer">
	<form method="post" id="frmCustomer" > 
		<div class="title">
			<h6>THÔNG TIN NGƯỜI ĐẶT HÀNG</h6>
		</div>
		<div class="form-group">
			<input type="text" class="form-control" name="fullname"  required placeholder="Họ tên"  value="<?=$current_user_profile->full_name?>"/>
			<input type="hidden" name="ID" value="<?=$current_user_profile->ID  ?>"/>
			<input type="hidden" name="user_id" value="<?=$current_user->ID ?>"/>

		</div>
		<div class="row">
			<div class="col-6">
				<div class="form-group">
					<input type="tel" class="form-control" required placeholder="Số điện thoại" name="phone" value="<?=$current_user_profile->phone?>"/>
				</div>
			</div>
			<div class="col-6">
				<div class="form-group">
					<input class="form-control" type="email" required name="email"  placeholder="Địa chỉ mail"  value="<?=$current_user->user_email ?>"/>

				</div>
			</div>
		</div>
		<div class="form-group">
			<input type="text" class="form-control" name="address" required  placeholder="Địa chỉ" value="<?=$current_user_profile->address?>"/>
			<input type="hidden" name="fulladdress" id="fulladdress" value="<?=$current_user_profile->address?>"/>
		</div>
		<div class="form-group">
			<select class="form-control" name="gender">
				<option value="1" <?=$current_user_profile->gender==1?'selected':''?> >Nam</option>
				<option value="0" <?=$current_user_profile->gender==0?'selected':''?> >Nữ</option>
			</select>
		</div>

		<div class="location-group mb-3">
			<h5>Địa điểm <span class="text-danger">*</span></h5>

			<div class="form-group">
				<select class="form-control" name="province_id" id="cusProvince" >
					<?php if(function_exists('get_html_option_for_select')){ get_html_option_for_select($stable = 'province', $fields=array('fname'=>'province_name', 'fkey'=>'province_id'), $selected_val = $current_user_profile->province_id); } ?>
				</select>
			</div>  

			<div class="form-group">
				<select class="form-control" name="district_id" id="cusDistrict">
					<option selected="" value=""> Quận / Huyện</option>
				</select>
			</div> 

			<div class="form-group">
				<select class="form-control" name="ward_id" id="cusWard">
					<option selected="" value=""> Phường / Xã</option>
				</select>
			</div> 
		</div> 
		<button type="button" id="btnSaveCustomer" class="btn-clip btn-red">LƯU</button> 
		<button type="button" id="btnAddress_book" class="btn-clip btn-border-red">SỔ ĐỊA CHỈ</button> 
		</form>
	</div>
<?php include_once(WP_PLUGIN_DIR.'/commerce-cms/frm/province_cc.js.php'); ?>

<script type="text/javascript">
	var cusprovince = '<?=$current_user_profile->province_id?>';
	var cusdistrict = '<?=$current_user_profile->district_id?>';
	var cusward = '<?=$current_user_profile->ward_id?>';
$(document).ready(function() { 
	
	get_ajax_sub_element(pr_element = '#cusProvince', chd_element = '#cusDistrict', action_get = 'ajax_get_district', value_selected= cusdistrict, chdchd_element = '#cusWard', chdchd_val = cusward ); 
	
	$("#cusProvince").change(function(){
		get_ajax_sub_element(pr_element = '#cusProvince', chd_element = '#cusDistrict', action_get = 'ajax_get_district', value_selected= $(this).val(), chdchd_element = '#cusWard' );
	});
	
	$("#cusDistrict").change(function(){
		get_ajax_sub_element(pr_element = '#cusDistrict', chd_element = '#cusWard', action_get = 'ajax_get_ward', value_selected= $(this).val() );
	});
	
	$('form#frmCustomer').submit(function(e) {
		e.preventDefault(); 
		
		var dataForm = $("#frmCustomer").getFormData();
		
		//console.log(dataForm);
		 
		customer = dataForm; 
		
		$("button#btnSaveCustomer").append(divloading);
		
		$.ajax({
            data:{
                    action: 'ajax_create_Customer',
                    'customer': dataForm,
                },
            type: 'post',
            url: ajaxurl,
            //dataType: "json",
            success: function(response) {  
				console.log(response); 
				var resp = response.data; 
				 address_id = resp.address_ID;
				//alert(address_id);
				 $('#frmCustomer #ID').val(address_id);
				
				showPopup('<div class="colorRed fnt-18 text-center pt40 pb40">Đã cập nhật hồ sơ thành công!</div>  ', el=$('.popup_content'));
				setTimeout(function(){hidePopup(); },5000);
				setTimeout(function(){location.reload(); },500); 
            }
        });
		return false;
	});
});
</script>
