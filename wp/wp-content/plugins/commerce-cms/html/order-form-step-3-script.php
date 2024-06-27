<?php
/**
* Order Step 3 Script
*
$ListBookings = get_list_Items_Cookie();

$BookingItems = false;
if(isset($ListBookings['booking_items'] ))
	$BookingItems = $ListBookings['booking_items'] ; 
$current_customer_address = get_customer_address_payment();
$customer_order = (array)$current_user_profile;
*/


?>
<?php  $customer_order['order_total'] = $total_order;  ?>

<script type="text/javascript">
	var order_id = '<?=$order_id?>';
$(document).ready(function() {
   
	$('#btnNextStep').click(function() {
		$(location).attr('href', '<?=get_site_url()?>/booking/?step=<?php echo ($step+1)?>');	 
	});
	$('#btnPrevStep').click(function() {
		$(location).attr('href', '<?=get_site_url()?>/booking/?step=<?php echo ($step-1)?>');	 
	});
	$('.chkpayments').click(function() {
		//alert($(this).val());
		$("#txt_payments").val($(this).val());
	});
	var dataOrderItem = <?php echo ( json_encode($BookingItems, true ) );  ?>;
	var dataOrder = [<?php echo ( json_encode($customer_order, true ) );  ?>];
	
	$('#btnFinish').click(function(e) {
		e.preventDefault(); 
		
		var dataHoaDon = $("#frmHoaDon").getFormData();  
		
		if($("#chkAgree").is(":checked")){
			$(this).append(divloading);
			
				$.ajax({
				data:{
						action: 'update_order_booking',
						'order_id':order_id,
						'dataorder': dataOrder, 
						'dataHoaDon': dataHoaDon
					},
				type: 'post',
				url: ajaxurl,
				//dataType: "json",
				success: function(response) {  
					response = response.toString().trim();
					response = '['+response.toString().replace('}0', '}]');
					var resp = JSON.parse(response); 
					 order_id = resp[0]["order_id"];
					 $('#order_id').val(order_id);

					update_details();
					//alert(' success: '+ resp[0]["success"] + ' order_id: ' + order_id);
					//alert(response);
					console.log(response);
					console.log(dataOrder); 
					$('div.loading').remove(); 
				} 

			});
		}else{
			alert('Vui lòng đọc và xác nhận đồng ý [Điều kiện, Chính sách] của YMH.');
			$("#chkAgree").focus();
			$("#chkAgree").attr('style','border:1px solid #f30 ;');
			return false;
			
		} 
	
	});
	
	function update_details(){
		if(parseInt(order_id) > 0){
				$.ajax({
					data:{
							action: 'update_order_booking_details',
							'order_id':order_id, 
							'dataorderItem': dataOrderItem,
						},
					type: 'post',
					url: ajaxurl,
					//dataType: "json",
					success: function(response) {  
						response = response.toString().trim();
						response = '['+response.toString().replace('}0', '}]');
						var resp = JSON.parse(response); 
						item_id = resp[0]["item_id"];

						alert(' success: '+ resp[0]["success"] + ' order_id: ' + order_id);
						console.log(response); 
						console.log(dataOrderItem);
						$('div.loading').remove(); 
						window.location.href='<?=get_site_url()?>/booking/?step=4';
					}
				});
			}
	}
	

});
</script>