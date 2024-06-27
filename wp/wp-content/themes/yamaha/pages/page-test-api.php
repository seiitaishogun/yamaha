<?php
/**
 * @author HUNG VO
 * created Date: 10/12/2021
 * project: yamaha-revzone-website
 *
 * Template Name: TEST API
 *
 */ 
get_header();
?>
<script>
	$(document).ready(function(){
		var dataOrder = {'web_order_id':144, 'sf_order_id':'1234'};
		//console.log(dataOrder);
		$.ajax({
		   method: "POST",
		   url: '<?=get_site_url()?>' + '/wp-json/api-cms/v1/updateOrderStatus',
		   data : dataOrder,
		   contentType: 'applcation/json',
		   beforeSend: function (xhr){
			   xhr.setRequestHeader("X-WP-None", "application/json");
			   console.log('beforeSend');
		   },
		   success: function(response){
			   console.log("success" + response);
		   },
		   fail: function (response){
			   console.log("fail" + response);
		   }
		});
	});
</script>

<?php
get_footer();
?>