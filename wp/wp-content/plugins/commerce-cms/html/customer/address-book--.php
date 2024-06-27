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

$list_address = get_list_customer_address($array=false);
?>

<section class="address-book-page container-fluid bg-white py-3">
    <a id="btnNewAddress" href="javascript:void(0);"><img src="<?php echo get_template_directory_uri();?>/img/button/btn-corner-add-new.svg" alt=""></a>
    <div class="mb-5"></div>
    <div class="row my-2">
        <div class="col-lg-12">
          <?php if(count($list_address)>0) : ?>
           <?php foreach ($list_address as $item){ ?>
				<div class="single-address-item p-3 pb-4 mb-4">
                <p class="customer-name font-weight-bold"><?php echo $item->full_name; ?>
                <?php if(intval($item->default_address)>0) : ?>
                	<span class="ml-3 px-2 py-1 mark-selected font-weight-normal">mặc định</span>
                <?php endif; ?>
                </p>
                <div class="row px-3">
                    <div class="col-lg-6 py-3 bg-white info-customer">
                        <p><?php echo $item->address; ?></p>
                        <p class="font-weight-bold">Số điện thoại: <span style="color: red;">
                        	<?php echo $item->phone; ?></span>
                        </p>
                    </div>
                    <div class="col-lg-6 align-self-center text-right customer-action" data-id="<?php echo $item->ID; ?>">
                        <a id="btnEdit<?php echo $item->ID; ?>" class="btnEditAddress btnActAddress " data-act="edit" href="javascript:void(0);" style="position: relative"><img src="<?php echo get_template_directory_uri();?>/img/button/btn-corner-edit.svg" alt="" ></a>
                        <a id="btnDefault<?php echo $item->ID; ?>" class="btnDefaultAddress btnActAddress" data-act="set_default" class="mx-3" href="javascript:void(0);" style="position: relative"><img src="<?php echo get_template_directory_uri();?>/img/button/btn-corner-set-default.svg" alt=""></a>
                        <a id="btnDelete<?php echo $item->ID; ?>" class="btnDeleteAddress btnActAddress" data-act="delete" href="javascript:void(0);" style="position: relative"><img src="<?php echo get_template_directory_uri();?>/img/button/btn-corner-delete.svg" alt=""></a>
                    </div>
                </div>
            </div>
			<?php } ?>
           <?php endif; ?>  
        </div>
    </div>
</section>

<section class="create-address-book-page container-fluid bg-white py-3">
    
    <h2 class="title">Tạo sổ địa chỉ</h2> 
    <div class="row justify-content-center"> 
        <div class="col-lg-6">
             <?php include_once(WP_PLUGIN_DIR.'/commerce-cms/frm/frm_customer_address.php'); ?> 
        </div>
    </div> 
</section>
 <script type="text/javascript">
	$(document).ready(function() { 
		
		(function($){
		  $.fn.ClickedAction = function(){
			  var the_id = $(this).parent().attr('data-id');
			  var the_act = $(this).attr('data-act');
			   
			 if(the_act == 'edit'){
				 
				if($('.address-book-page').is(':visible') && !$('.create-address-book-page').is(':visible')){
                	$('.address-book-page').hide();
                	$('.create-address-book-page').show('slow');
            	}
				 //
				// var dataForm = $("#frmCustomerAddress").getFormData();
				 $.ajax({
					data:{ action: 'ajax_get_customer_address', 'the_id': the_id },
					type: 'post',
					url: ajaxurl, 
					success: function(response) { 
						console.log(response); 
						var data_return = response.data;
						if(data_return !== null){ 
							formA['ID'].value = data_return.ID;
							formA['customer_id'].value = data_return.customer_id ;
							formA['fullname'].value = data_return.full_name;
							formA['default_address'].value = data_return.default_address;
							formA['phone'].value = data_return.phone;
							formA['email'].value = data_return.email;
							formA['address'].value = data_return.address;
							formA['title'].value = data_return.title; 
							formA['province_id'].value = data_return.province_id; 
							
							get_ajax_sub_element(pr_element = '#lstProvince', chd_element = '#lstDistrict', action_get = 'ajax_get_district', value_selected= data_return.district_id, chdchd_element = '#lstWard', chdvalue_selected= data_return.ward_id);
							 
							$("#btnSaveCustomerAddress").html('<i class="fas fa-save mr5"></i>&nbsp;&nbsp;Lưu lại');
							
							$(".create-address-book-page .title").html('Sửa sổ địa chỉ');
							
							if(formA['default_address'].value === '1'){
								$('#chkDefaultAddress').prop("checked", true);
							}else{
								$('#chkDefaultAddress').prop("checked", false);
							}
						} 
					}
				});
			 }
			 
			  
			 if(the_act == 'delete' || the_act == 'set_default'){
				alert(the_act + ', ID: ' + the_id);  
				 $(this).append(divloading);
				 //
				 $.ajax({
					data:{
                    	action: 'ajax_update_delete_customer_address',
                    	'postfrm': {'action': the_act, 'the_id': the_id},
                	},
					type: 'post',
					url: ajaxurl, 
					success: function(response) {  
						console.log(response);
						$('div.loading').remove(); 
						
						if(the_act == 'set_default'){
							window.location.href = '<?=get_site_url()?>/user/?tab=list-address';
						} //else
						if(the_act == 'delete'){
							$(this).parents('div.single-address-item').remove();
							window.location.href = '<?=get_site_url()?>/user/?tab=list-address';
						} 
						
					}
				});
			 } 
			 
		  }
		})(jQuery);
		
		
		$(".btnActAddress").click(function(){
			$(this).ClickedAction();
		});
			
	});
</script>		
<?php include_once(WP_PLUGIN_DIR.'/commerce-cms/frm/province_cc.js.php'); ?> 