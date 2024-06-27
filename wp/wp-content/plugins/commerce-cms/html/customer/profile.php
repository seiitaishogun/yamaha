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

$authenticated = '(Chưa xác thực). Vui lòng kiểm tra Email của bạn để xác thực Email!';
if($current_user->user_activation_key == ''){
	$authenticated = '(Đã xác thực)';
}
/*if(isset($_POST['avatar_image_id'])){
	if($_POST['avatar_image_id'] !=''){
		upload_avatar_profile();
	}
}*/
upload_avatar_profile();
?>

<section class="profile-page container-fluid bg-white py-3">
   <form method="post" id="frmAvatar" name="frmAvatar" enctype="multipart/form-data">
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-1 col-md-1 col-3 pl0 pr0">
                    <div class="avatar profile_avatar " style="display: flex; align-items: center; overflow: hidden; z-index: 6; background: rgba(132,23,25,1); position: relative;">
                    <?php  $profile_pic = ($current_user!=='add-new-user') ? get_user_meta($current_user->ID, 'profile_avatar', true): false;
					if( $profile_pic ){
						$image = wp_get_attachment_image_src( $profile_pic, 'thumbnail' ); 
					} ?> <?php if(!$image){ ?> 
							 <div id="mask_avatar" class="text-center colorWhite" style="position: absolute; display: flex; align-items: center; top:0; left: 0; width: 100%; height: 100%;z-index: 99;  cursor: pointer; background:transparent; bottom: 0; padding: 15px;"><span>Tải hình lên</span></div>
							 <?php } else if($image){ ?> 
							 <div id="mask_avatar" class="text-center colorWhite" style="position: absolute; display: flex; align-items: center; top:0; left: 0; width: 100%; height: 100%;z-index: 99;  cursor: pointer; background:transparent; bottom: 0; padding: 15px;" title="Tải hình lên"></div>
							 <?php } ?>  
							 <div style="width: 140px; display: flex; align-items: center; height: 140px;  position: absolute align-self: center; overflow: hidden; top:-10px; left: -10px; ">
								<input type="file" data-id="avatar_image_id" data-src="avatar-img" class="avatar-image" name="file-avatar" style="z-index:-1; opacity:0; width:0px; height: 0px; padding: 0px;" id="avatar_upload_image" value="" accept="image/png, image/gif, image/jpeg" />
								<input type="hidden" class="button" name="avatar_image_id" id="avatar_image_id" value="<?php echo !empty($profile_pic) ? $profile_pic : ''; ?>" /> 
		<img id="avatar-img" class="align-sefl-center" src="<?php echo $image[0] ; ?>" style="<?php echo  empty($profile_pic) ? 'display:none;' :''; ?> width:140px; height:140px; border:0px ;padding:0px; object-fit: cover;" /> 
                   		 	</div>
                    </div>
                </div>
                <div class="col-lg-11 col-md-11 col-9 align-self-center">
                    <div class="ml-3">
						<?php /*?><span class="font-weight-bold"><?php print_r($current_user) ;?></span><?php */?>
                        <p class="customer-name pb0"><?=$current_user_profile->full_name ;?> 
							<?php if($current_user->user_activation_key == ''){ ?>
							<span class="ticked ml-2"><img src="<?php echo get_template_directory_uri();?>/img/ic_ticked_green.svg" alt=""></span>
							 <?php }?></p>
							<span class="font-weight-bold "><?php echo $authenticated ;?></span>
							<?php if($current_user->user_activation_key != ''){ ?>
								<a href="#" id="btnActiveUser" class="colorRed">Gửi lại email.</a>
						   <?php }?> 
                    </div>
		                             
                </div>
            </div> 
        </div>
    </div> 
	</form>
    <form method="post" id="frmProfile" name="frmProfile" enctype="multipart/form-data">
    <div class="row mt-5">
        <div class="col-lg-6">
            <p class="font-weight-bold">THÔNG TIN CỦA BẠN</p>
            <div class="form-group">                   
				<input class="form-control" type="text" name="fullname" required placeholder="Họ tên"  value="<?=$current_user_profile->full_name?>"/>
			</div>
			<input type="hidden" name="ID" value="<?=$current_user_profile->ID  ?>"/>
			<input type="hidden" name="user_id" value="<?=$current_user->ID ?>"/> 
            <div class="row">
            	<div class="col-lg-6">
            		<div class="form-group">
            			<input class="form-control" type="tel" required placeholder="Số điện thoại" name="phone" value="<?=$current_user_profile->phone?>"/>
            		</div>
            	</div>
            	<div class="col-lg-6">
            		<div class="form-group">
            			<input class="form-control" type="email" required name="email"  placeholder="Địa chỉ mail"  value="<?=$current_user->user_email ?>"/>
            		</div>
            	</div>
            </div>
            
		    <div class="row">
            	<div class="col-lg-12">
		            <div class="form-group">
			            <input class="form-control" type="text" name="address" required  placeholder="Địa chỉ" value="<?=$current_user_profile->address?>"/>
			        </div>
			    </div>
			</div>
            <input type="hidden" name="fulladdress" id="fulladdress" value="<?=$current_user_profile->address?>"/>
            <input type="hidden" name="gender" id="gender" value="<?=$current_user_profile->gender?>"/>
            <div class="spacer-10"></div>
            <div class="row my-2">
                <div class="col-lg-12">
                    <div class="location-section p-3">
                        <p class="font-weight-bold">Địa điểm <span class="text-danger">*</span></p>

						<div class="custom-select-bst my-2">
							<select class="form-select w-100 fz-14 f-color-grey" name="province_id" id="usrProvince" aria-label="Default select example">
								<option selected="" value="">Tỉnh / Thành</option>
								<?php if(function_exists('get_html_option_for_select')){ get_html_option_for_select($stable = 'province', $fields=array('fname'=>'province_name', 'fkey'=>'province_id'), $selected_val = $current_user_profile->province_id); } ?>
							</select>
							<img src="<?php echo get_template_directory_uri();?>/img/ic_dropdown_arrow.svg" alt="" required="required">
						</div><div class="spacer-5"></div>
							
						<div class="custom-select-bst my-2">
							<select class="form-select w-100 fz-14 f-color-grey" name="district_id" id="usrDistrict" aria-label="Default select example">
								<option selected="" value="">Quận huyện</option>
							</select>
							<img src="<?php echo get_template_directory_uri();?>/img/ic_dropdown_arrow.svg" alt="" required="required">
						</div><div class="spacer-5"></div>
                        <div class="custom-select-bst my-2">
							<select class="form-select w-100 fz-14 f-color-grey" name="ward_id" id="usrWard" aria-label="Default select example">
								<option selected="" value="">Phường / Xã</option>
							</select>
							<img src="<?php echo get_template_directory_uri();?>/img/ic_dropdown_arrow.svg" alt="" >
						</div>
						
                    </div>
                </div>
            </div>
            
        </div>
        <div class="col-lg-6">
		<p class="font-weight-bold">MẬT KHẨU CỦA BẠN</p> 
           <div class="form-group col-lg-12 mt5"> 
					<div class="input-group" >                    
						<input type="password" name="password" id="password" class="form-control tmt-pass"  placeholder="Mật khẩu cũ" >
						<div class="input-group-append tmt-pass-apend">
							<span class="input-group-text">
								<i class="fas fa-eye"></i>
							</span>
						</div> 
				</div>  
			</div><div class="clearfix"></div>
            <div class="form-group col-lg-12 border-0 mb5">   
					<div class="input-group" >                    
						<input type="password" name="newpassword" id="newpassword" class="form-control tmt-pass"  placeholder="Mật khẩu mới" >
						<div class="input-group-append tmt-pass-apend">
							<span class="input-group-text">
								<i class="fas fa-eye"></i>
							</span>
						</div>
					</div>  
				</div><div class="clearfix"></div>
				<div class="form-group col-lg-12 border-0"> 
					<div class="input-group" >                    
						<input type="password" name="re_password" id="re_password" class="form-control tmt-pass" placeholder="Nhập lại Mật khẩu mới" >
						<div class="input-group-append tmt-pass-apend">
							<span class="input-group-text">
								<i class="fas fa-eye"></i>
							</span>
						</div>
					</div>  
				</div> 
            <button type="submit" id="btnSaveProfile" class="btn-clip btn-red mt-4 float-right" >Lưu</button>          
        </div>
    </div>
	</form>
</section>
<template id="email-success-template">
	<div class="colorGray">
		Đã gửi email xác thực thành công.
	</div>
</template>
<?php include_once(WP_PLUGIN_DIR.'/commerce-cms/frm/province_cc.js.php'); ?>
<script type="text/javascript">
	var usrprovince = '<?=$current_user_profile->province_id?>';
	var usrdistrict = '<?=$current_user_profile->district_id?>';
	var usrward = '<?=$current_user_profile->ward_id?>';
$(document).ready(function() { 
	 
	get_ajax_sub_element(pr_element = '#usrProvince', chd_element = '#usrDistrict', action_get = 'ajax_get_district', value_selected= usrdistrict, chdchd_element = '#usrWard', chdvalue_selected= usrward ); 
	
	$("#usrProvince").change(function(){
		get_ajax_sub_element(pr_element = '#usrProvince', chd_element = '#usrDistrict', action_get = 'ajax_get_district', value_selected= $(this).val(), chdchd_element = '#usrWard' );
	});
	
	$("#usrDistrict").change(function(){
		get_ajax_sub_element(pr_element = '#usrDistrict', chd_element = '#usrWard', action_get = 'ajax_get_ward', value_selected= $(this).val() );
	});

	$("#btnActiveUser").click(function(){
		$.ajax({
            data:{
                    action: 'ajax_active_user',
                    'user_id': <?=$current_user->ID ?>,
                },
            type: 'post',
            url: ajaxurl,
            //dataType: "json",
            success: function(response) {  
				var popupContent = $("#email-success-template").html();
				$('div.loading').remove(); 
				showPopup(popupContent, $('.popup_site .popup_content'));
				// window.location.href = '<?php the_permalink(510); ?>?title=Xác Thực Thành Công&message=Cám ơn bạn đã đăng kí, hãy kiểm tra email để nhận link xác thực!';
            }
        });  
	});
	 
	$('form#frmProfile').submit(function(e) {
		e.preventDefault(); 
		
		var dataForm = $("#frmProfile").getFormData(); 
		 
		customer = dataForm; 
		
		//$("#btnSaveProfile").append(divloading);
		
		$.ajax({
            data:{
                    action: 'ajax_update_UserProfile',
                    'customer': dataForm,
                },
            type: 'post',
            url: ajaxurl,
            //dataType: "json",
            success: function(response) {  
				console.log(response); 
				$('div.loading').remove(); 
				var resp = response.data ;  
				//Hien thi popup cap nhat thanh cong  
				if(response.success){
					if(resp.return.status=='success'){  
						showPopup(resp.return.text, $('.popup_site .popup_content'));  
						//window.location.reload() ; //window.location.href = '<?=get_site_url()?>';
					}else{
						showPopup(resp.return.text, $('.popup_site .error_message')); 
					}
				}
				else{
					showPopup(resp.return.text, $('.popup_site .error_message')); 
				}
				
				//window.location.reload(); //= '<?=get_site_url()?>/user/?tab=list-address';
            }
        });
		return false;
	});
	
	$('#mask_avatar').click(function(){ 
		$('#avatar_upload_image').click();
		//return false;
	});
	$('#avatar_upload_image').change(function(){ 
		if($('#avatar_upload_image').val() !=''){
			$('#frmAvatar').submit();
		} 
	});
	
});

</script>