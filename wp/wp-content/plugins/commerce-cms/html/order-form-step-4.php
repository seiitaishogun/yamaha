<?php
/**
* Order LIST
*
*/
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
$customer_list_orders = get_customer_list_orders_status($order_status = 0, $limit=1);

$customer_list_order_details = get_order_details_of_order_status($order_id = $customer_list_orders[0]['ID'], $order_status = 0);
//$list_order_details = get_order_details_of_order($order_id = 9 );

if($customer_list_orders){ 
	$order = $customer_list_orders[0];
	echo('<textarea rows="2" style="overflow:auto; width:100%;"><pre>');
	print_r($customer_list_orders) ;
	echo('</pre><pre>');
	print_r($customer_list_order_details) ;
	echo('</pre></textarea>');
} 
?>

<section class="order-list container-fluid">

<div class="spacer-50 box-shadow01rem" style="margin: 0 auto; text-align: center; padding: 30px 10px;">
 <h4>Bạn có 10 phút để xác nhận Đặt hàng.</h4>
 <div class="spacer-20"></div>
 <button id="btnConfirmOrder" class="btnSubmit btnConfirmOrder btn-clip btn-red" style="position: relative;" >XÁC NHẬN ĐẶT HÀNG!</button>
 <div class="message" style="color: rgba(252,5,9,1.00); font-size: 1.2em"></div>
</div>
 <div class="spacer-20"></div>
  
  <div class="spacer-20"></div> 
</section> 

<script type="text/javascript">
 
$(document).ready(function() {
    var timeOrderOut = 1 * 60 * 1000; // 10 * 60 * 1000 (10 phut)
	setTimeout(function(){$("#btnConfirmOrder").removeClass('btn-red'); $("#btnConfirmOrder").prop('disabled', true); alert('Hết thời gian!');}, timeOrderOut); 
	
	$("#btnConfirmOrder").click(function(){
		$(this).append(divloading);
		
		$.ajax({
            data:{
                    action: 'update_order_confirm_booking',
					'order_id': '<?= $order['ID']; ?>',
                    'order_status': 1 
                },
            type: 'post',
            url: ajaxurl,
            //dataType: "json",
            success: function(response) {  
				response = response.toString().trim();
				response = '['+response.toString().replace('}0', '}]');
				var resp = JSON.parse(response);  
				
				alert("CÁM ƠN BẠN ĐÃ XÁC NHẬN ĐẶT HÀNG");
				console.log(response); 
				$('div.loading').remove(); 
				if(parseInt(resp[0]['success']) > 0){
					window.location.href='<?=get_site_url()?>/user/?tab=history-order';
				}
            } 
			
        });
		
	});
});
</script>