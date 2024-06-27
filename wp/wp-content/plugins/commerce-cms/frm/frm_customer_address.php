<?php
/**
* FORM Customer
*
*/
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

global $wpdb, $current_user, $current_user_profile, $current_customer_address;

$current_customer_address = get_customer_address_payment();
$step = $_GET['step'] ? $_GET['step'] : 0;
?>
<div class="form_CustomerAddress">
	<form method="post" id="frmCustomerAddress" name="frmCustomerAddress" > 
		<?php /*?><div class="row">
			<div class="col-4"> 
				<input type="checkbox" id="sameCustomer" value=""/>	<label for="sameCustomer">Lấy thông tin người mua.</label>
			</div>
			<div class="col-4"> 
				<input type="checkbox" id="chkDefaultAddress" 
			<?=$current_customer_address->default_address==1?'checked':''?> value="<?=$current_customer_address->default_address?>"/>
			<label for="chkDefaultAddress">Làm địa chỉ mặc định.</label>
			</div>
			<div class="col-4" style="text-align: right;"> 
				
			</div>
		</div><hr><?php */?>
		<div class="toggle mt5">
		  
		<div class="form-group">
			<input type="text" name="fullname" class="form-control " required  placeholder="Họ tên" value=""/>
			<input type="hidden" class="form-control " name="title" value="<?=($current_customer_address->title?$current_customer_address->title:'ĐỊA CHỈ GIAO HÀNG');?>"/>
			<input type="hidden" name="action" value="update"/> 
			<input type="hidden" name="ID" value=""/> 
			<input type="hidden" name="user_id" value="<?=$current_user->ID ?>"/>
			<input type="hidden" name="customer_id" value="<?=$current_customer_address->customer_id?>"/>
			<input type="hidden" name="default_address" value=""/>
		</div> 
		<div class="form-group">
			<input type="tel" class="form-control" minlength="10"  maxlength="12" required placeholder="Số điện thoại" name="phone" value=""/>
		</div>
		<?php /*?><div class="row">
			<div class="col-6">
				<div class="form-group">
					<input type="tel" class="form-control " maxlength="12" required placeholder="Số điện thoại" name="phone" value=""/>
				</div>
			</div>
			<div class="col-6">
				<div class="form-group">
					<input type="email" class="form-control " required name="email"  placeholder="Địa chỉ mail" value=""/> 
				</div>
			</div>
		</div><?php */?>
		<div class="form-group"> 
			<input type="hidden" class="form-control " name="email"  placeholder="Địa chỉ mail" value=""/>
			<input type="text" name="address" class="form-control "  required placeholder="Địa chỉ "  value=""/>
		</div><div class="spacer-10"></div>
		<div class="location-group bg_all pd20 mt5">
			<p class="font-weight-bold">Địa điểm <span class="text-danger">*</span></p>
			 
			<div class="custom-select-bst my-2">
				<select class="form-select w-100 fz-14 f-color-grey" name="province_id" id="lstProvince" aria-label="Default select example">
					<option selected="" value="">Tỉnh / Thành</option>
					<?php if(function_exists('get_html_option_for_select')){ get_html_option_for_select($stable = 'province', $fields=array('fname'=>'province_name', 'fkey'=>'province_id'), $selected_val = $current_user_profile->province_id); } ?>
				</select>
				<img src="<?php echo get_template_directory_uri();?>/img/ic_dropdown_arrow.svg" alt="" required="required">
			</div>

			<div class="custom-select-bst my-2">
				<select class="form-select w-100 fz-14 f-color-grey" name="district_id" id="lstDistrict" aria-label="Default select example">
					<option selected="" value="">Quận huyện</option>
				</select>
				<img src="<?php echo get_template_directory_uri();?>/img/ic_dropdown_arrow.svg" alt="" required="required">
			</div>

			<div class="custom-select-bst my-2">
				<select class="form-select w-100 fz-14 f-color-grey" name="ward_id" id="lstWard" aria-label="Default select example">
					<option selected="" value="">Phường / Xã</option>
				</select>
				<img src="<?php echo get_template_directory_uri();?>/img/ic_dropdown_arrow.svg" alt="" >
			</div>
		</div>
		
		<div class="row justify-content-center mt-3">
			<div class="col-lg-12">
				<div class="row">
					<div class="col-lg-6">
						<label class="ct-radio-input mt-2">
							<input type="checkbox" id="chkDefaultAddress" value="0" >
							<span class="chk-content">Đặt làm địa chỉ mặc định</span>
						</label>
					</div>
					<div class="col-lg-6 text-right">
						<?php /*?><button id="btnSaveCustomerAddress" type="submit" href="javascript:void(0);" style="border: 0px !important; margin: 0; padding: 0; background-color: transparent;"><img src="<?php echo get_template_directory_uri();?>/img/button/btn-corner-add-new.svg" alt=""></button> <?php */?>
						<button type="button" id="btnCancelCustomerAddress" class="btn-clip btn-border-red text-center btn-small" style="display: <?= $step == 2 ? 'none' : 'inline' ?>;">Hủy</button>
					 	<button type="submit" id="btnSaveCustomerAddress" class="btn-clip btn-border-green text-center btn-small"><i class="fas fa-plus"></i> Lưu</button>
					</div>
				</div>
			</div>                 
		</div>
		
	</div> 
	</form>
</div>
<?php include_once(WP_PLUGIN_DIR.'/commerce-cms/frm/province_cc.js.php'); ?>

<script type="text/javascript">
	var province1 = '<?=$current_customer_address->province_id?>';
	var district1 = '<?=$current_customer_address->district_id?>';
	var ward1 = '<?=$current_customer_address->ward_id?>';
	var formA = document.forms['frmCustomerAddress'];
	
$(document).ready(function() {
	
	$('.create-address-book-page').hide();  
	
	get_ajax_sub_element(pr_element = '#lstProvince', chd_element = '#lstDistrict', action_get = 'ajax_get_district', value_selected= district1, chdchd_element = '#lstWard' ); 
	
	$("#lstProvince").change(function(){
		get_ajax_sub_element(pr_element = '#lstProvince', chd_element = '#lstDistrict', action_get = 'ajax_get_district', value_selected= $(this).val(), chdchd_element = '#lstWard' );
	});
	
	$("#lstDistrict").change(function(){
		get_ajax_sub_element(pr_element = '#lstDistrict', chd_element = '#lstWard', action_get = 'ajax_get_ward', value_selected= $(this).val() );
	});
	
	//var data_address = $("#frmCustomer").getFormData(); 
	var data_address = <?php echo json_encode((array)$current_user_profile); ?>; 
	 
	formA['user_id'].value = data_address['user_id'];
	formA['customer_id'].value = data_address['ID'];
	
	$("#btnNewAddress").click(function(){ 
		if($('.address-book-page').is(':visible') && !$('.create-address-book-page').is(':visible')){
                $('.address-book-page').hide();
                $('.create-address-book-page').show('slow');
            }
		$('#frmCustomerAddress').serialize(); //.reset(); 
		formA['ID'].value = '0';
		formA['user_id'].value = data_address['user_id'];
		formA['customer_id'].value = data_address['ID'];
		formA['default_address'].value = '0';
		formA['fullname'].value = '';
		formA['phone'].value = ''; 
		formA['address'].value = '';
		$("#btnSaveCustomerAddress").html('<i class="fas fa-plus mr5"></i>&nbsp;&nbsp;Thêm mới');
		$(".create-address-book-page .title").html('Tạo sổ địa chỉ');
	}); 
	
	//load_data_address_list(element_select = '#lst_rec_address');
	
	$("#lst_rec_address").change(function(){
		$(document).find($("span.rec_address")).text($(this).val());
		$(document).find($("input.rec_address")).val($(this).val());
		//$(document).find($("#mask_popup_address")).click();
	});
	
	$('#sameCustomer').click(function() {
		if($(this).is(":checked") ){
			   
			formA['user_id'].value = data_address['user_id'];
			formA['customer_id'].value = data_address['ID'];
			formA['fullname'].value = data_address['full_name'];
			formA['phone'].value = data_address['phone'];
			//formA['email'].value = data_address['email'];
			formA['address'].value = data_address['address']; 
			
			province1 = data_address['province_id'];
			district1 = data_address['district_id'];
			ward1 = data_address['ward_id'];
			
			get_ajax_sub_element(pr_element = '#lstProvince', chd_element = '#lstDistrict', action_get = 'ajax_get_district', value_selected= district1, chdchd_element = '#lstWard' );
	
			 $('#lstDistrict').val(district1); 
		} 
	}); 

	function updateAddressList(fullname, default_address, address, phone, ID){
		// create new address
		if (formA['ID'].value == 0){
			if ($('#address-info-template')){
				var template = $('#address-info-template').html();
				template = template.replace(/{full_name}/g, fullname);
				if (default_address > 0){
					$('span[id^="address-default"]').css('display', 'none');
					$('a[id^="btnDefault"]').css('display', 'inline');
				}
				template = template.replace(/{default_address}/g, default_address > 0 ? "inline" : "none");
				template = template.replace(/{btn_default_address}/g, default_address > 0 ? "none" : "inline");
				template = template.replace(/{address}/g, address);
				template = template.replace(/{phone}/g, phone);
				template = template.replace(/{ID}/g, ID);
				$('#addressList').append(template);
				$(".btnActAddress").click(function(){
					$(this).ClickedAction();
				});
			}
		}
		// edit address
		else{

			$('#address-fullname-' + ID).html(fullname);
			if (default_address > 0){
				$('span[id^="address-default"]').css('display', 'none');
				$('a[id^="btnDefault"]').css('display', 'inline');

				$('#address-default-' + ID).css('display', 'inline');
				$('#btnDefault' + ID).css('display', 'none');
			}
			else{
				$('#address-default-' + ID).css('display', 'none');
				$('#btnDefault' + ID).css('display', 'inline');
			}
			$('#address-address-' + ID).html(address);
			$('#address-phone-' + ID).html(phone);
		}
	}

	$("#btnCancelCustomerAddress").click(function(){
		$('.address-book-page').show();
		$('.create-address-book-page').hide();
	});
	
	$('form#frmCustomerAddress').submit(function(e) {
		e.preventDefault(); 
		
		var dataForm = $("#frmCustomerAddress").getFormData();
		
		//console.log(dataForm);
		 
		customer = dataForm; 
		
		//$("button#btnSaveCustomerAddress").append(divloading);
		
		$.ajax({
            data:{
                    action: 'ajax_create_Customer_Address',
                    'customeraddress': dataForm,
                },
            type: 'post',
            url: ajaxurl,
            //dataType: "json",
            success: function(response) {  
				console.log(response); 
				var resp = response.data; 
				address_id = resp[0].ID ;
				if (address_id == 0){
					address_id = resp.address_ID;
				}
				var name = resp[0].full_name;
				var address = resp[0].address;
				var phone = resp[0].phone;
				var province_id = resp[0].province_id;
				var district_id = resp[0].district_id;
				var ward_id = resp[0].ward_id;
				var default_address = resp[0].default_address;

				//alert(address_id);
				 $('#frmCustomerAddress #ID').val(address_id);

				// append new address into dropdown
				var new_address = '<a class="dropdown-item" href="javascript:void(0)" data-address_id="' + address_id + '" data-name="' + name + '" data-phone="' + phone + '" data-address="' + address +'"><span class="text">' + name + ' - ' + phone + ' - ' + address + '</span></a>';
				$('#addressSelect').append(new_address);
				
				showPopup('<div class="colorGray fnt-18 text-center pt40 pb40">Đã lưu sổ địa chỉ thành công!</div>  ', el=$('.popup_content'));
				setTimeout(function(){hidePopup(); },5000);
				// hide popup add address form
				if ($(".popup_add_address").length == 1){
					// show address if it is default address
					if (default_address == 1)
						set_receiver_address(name, phone, address, address_id, province_id, district_id, ward_id , name + ' - ' + phone + ' - ' + address);
					$(".popup_add_address").poupAddressClicked();
				}
				else{
					$('.address-book-page').show();
					$('.create-address-book-page').hide();
					
					// add new address into list
					updateAddressList(name, default_address, address, phone, address_id);
				}
				// setTimeout(function(){location.reload(); },500); 
            }
        });
		return false;
	});
	
	function load_data_address_list(element_select = '#lst_rec_address'){
		$.ajax({
            data:{ action: 'get_ajax_list_customer_address'},
            type: 'post',
            url: ajaxurl, 
            success: function(response) {  
				 $(element_select).html(response);
            }
        });
	}
	 
	$('#chkDefaultAddress').click(function() {
		if($(this).is(":checked") ){ 
			formA['default_address'].value = '1'; 
		}			
		else { 
			formA['default_address'].value = '0'; 
		} 
	});
	
	
	 
});
</script>
