<?php
/**
* PROVINCE SELECT JAVASCRIPT
*
*/
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
} 
?>

<script type="text/javascript"> 

function get_ajax_sub_element(pr_element = '#lstProvince', chd_element = '#lstDistrict', action_get = 'ajax_get_district', value_selected = '', chdchd_element = '#lstWard', chdvalue_selected = '' ){
		  
			if(action_get=='ajax_get_district'){ 
				 
				var selected = '';
					$.ajax({
					data: {
						action: action_get,
						province_id: $(pr_element).val(),
					},
					type: 'post',
					url: ajaxurl,
					dataType: "json",
					success: function(response) {
						$(chd_element).find('option').remove();
						$(chd_element).append('<option selected value="">Quận / Huyện</option>'); 

						$.each(response.data,function(index, item)
						{  //console.log(item); 
							selected = '';
							if(item.district_id==value_selected)  selected = ' selected ' ;	
							$(chd_element).append('<option ' + selected + ' value=' + item.district_id + '>' + item.type_name + ' ' + item.district_name + '</option>'); 					 
						});
						 
						if(parseInt(value_selected)>0 && action_get=='ajax_get_district'){
							// $(chd_element).val(value_selected);
							get_ajax_sub_element(pr_element = chd_element , chd_element = chdchd_element, action_get = 'ajax_get_ward', value_selected= chdvalue_selected );
						}
					}
				});
			} 
			if(action_get=='ajax_get_ward'){  
				var selected = '';
				
					$.ajax({
					data: {
						action: action_get,
						district_id: $(pr_element).val(),
					},
					type: 'post',
					url: ajaxurl,
					dataType: "json",
					success: function(response) {
						$(chd_element).find('option').remove();
						$(chd_element).append('<option value="">Phường / Xã</option>'); 
						console.log(response);
						$.each(response.data,function(index, item)
						{  //console.log(item);
							selected = ''
							if(item.ward_id==value_selected) selected = ' selected ' ;					 	 
							$(chd_element).append('<option ' + selected + ' value=' + item.ward_id + '>' + item.type_name + ' ' + item.ward_name + '</option>'); 						 
						});
					}
				});
			}  
	} 
</script>