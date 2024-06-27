<?php
/**
* Order LIST
*
*/
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
$my_order = $_GET['order_id'];
?>
<div class="spacer-20"></div>
<section class="container-fluid min-vh-100 bg-white" id ="search_order_section">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-6 reset-pw">
            
            <p class="fz-24 fw-600 mt-3 text-uppercase ff-oswald"><strong>Nhập Mã đơn hàng</strong></p>
            <input class="border w-100" type="text" name="sorder" id="sorder" placeholder="Mã đơn hàng">
            <p class="mt-2 mb-0 colorRed" id="msgError"></p>
            <button type="submit" class="btn-corner-red mt-5 btnSearchOrder" id="btnSearchOrder">Tìm kiếm</button>
            
        </div>
    </div>
</section>
<div class="spacer-40"></div>
<section class="my-orders container-fluid bg-white py-3" id="my_orders">    
<div class="row justify-content-center ">
    <div class="col-lg-8">
        <div class="w-50 mx-auto">
            <span class="order-id">Mã đơn hàng: #<span id="sitem_id"></span></span>
            <a class="btn-copy ml-3" style="vertical-align: super;" href="javascript:copyOrderNumber();">
                <span class="mr-2 position-relative">
                    <img class="position-absolute" style="left: 2px;bottom: 2px;" src="<?php echo get_template_directory_uri();?>/img/ic_copy.svg" alt="">
                    <img src="<?php echo get_template_directory_uri();?>/img/ic_copy_bg.svg" alt="">
                </span>
            Copy</a> 
            <p class="mt-1 status-order" id="order_status"></p>
        </div>
    </div>
</div>
<div class="spacer-20"></div>
<div class="spacer-10"></div>
<div id="single-order-flow" class="carousel slide" data-bs-touch="false" data-bs-interval="false">
  <div class="carousel-inner">
    <div class="product_list" id = "product_list">
      <!-- BAO TSTTT-->
   </div>
    
  <a class="carousel-control-prev" href="#single-order-flow" role="button" data-slide="prev" style="bottom: auto;top: 80px;">
    <span class="carousel-control-prev-icon" aria-hidden="true"><img src="<?php echo get_template_directory_uri();?>/img/ic-prev.svg" alt=""></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#single-order-flow" role="button" data-slide="next" style="bottom: auto;top: 80px;">
    <span class="carousel-control-next-icon" aria-hidden="true"><img src="<?php echo get_template_directory_uri();?>/img/ic-next.svg" alt=""></span>
    <span class="sr-only">Next</span>
  </a>
</div>
	
<div class="row justify-content-center">
    <div class="col-lg-8 text-center">
        
        <a id="btnCancleOrderSearch" data-toggle="modal" data-target="#dialogCancelOrder" style="background: url('<?php echo get_template_directory_uri();?>/img/button/btn-bg-grey.svg') no-repeat;" class="btn-cancel my-4 btn_Cancel_Order" href="javascript:void(0)"  > <p>Hủy đơn hàng</p> </a>
  
        <p class="cl-red mt20" style="font-size: 14px;">Liên hệ chăm sóc khách hàng theo số: <span class="font-weight-bold">1900 1938</span></p>
    </div>
</div>	
</section>
<!-- Modal -->
<div class="modal fade" id="dialogCancelOrder" tabindex="-1" role="dialog" aria-labelledby="btnCancelOrderLabel" aria-hidden="true">
  <div class="modal-dialog" style="max-width: 651px;" role="document">
    <div class="modal-content rounded-0">
      <div class="modal-header border-0 justify-content-center">
        <h4 class="modal-title ff-oswald text-uppercase" id="exampleModalLabel"><strong>Ly do hủy đơn</strong></h4>
      </div>
      <div class="modal-body">
        <div class="custom-select-bst">
            <select id="slcOrderReason" class="form-select w-100" aria-label="Default select example">
            	<?php foreach (CANCEL_ORDER_REASON as $item=>$value) {?>
            		<option value="<?=$item?>"><?=$value?></option>
            	<?php }?>                
            </select>
            <i class="fas fa-chevron-down"></i>
        </div>
      </div>
      <div class="modal-footer border-0 justify-content-center">
        <a style="background: url('<?php echo get_template_directory_uri();?>/img/button/btn-bg-dark.svg') no-repeat;" data-dismiss="modal" class="btn-cancel-cs mb-2 shadow-color-grey" href=""> <p>Thoát</p> </a>
        <div class="mr-4"></div>
        <a style="background: url('<?php echo get_template_directory_uri();?>/img/button/btn-bg-grey.svg') no-repeat;"   class="btn-cancel-cs mb-2" id="btn_Cancel_Order" href="javascript:void(0)"> <p>Hủy đơn hàng</p>
		  </a>
      </div>
    </div>
  </div>
</div>
<!-- Order item template -->
<template id="order-item-template">
	<div class="carousel-item {active}">
		<div class="row justify-content-center">
			<div class="col-lg-8">
				<div class="row product-item">
					<div class="col-lg-3 image-view"><img src="{img}" alt=""></div>
					<div class="info-item col-lg-9 align-self-center" style="padding-left: 8px;">
						<span class="name-product">
							<div class="d-block">
								<div>{title}</div>
								<div class="fnt-14">Số lượng: {quantity}</div>
							</div>
						</span> 
						<p class="sub-total-product">{price}</p>
					</div>
				</div>
				<div class="info-follow-order text-center mt-4">
					<!-- <p class="info-shipper">Người phụ trách: <span class="cl-red">Mr. Tâm</span> | SDT: <span class="cl-red">039 475 9684</span></p> -->
					<p class="info-shipper">{dealer_name} | SĐT: <span class="cl-red">{dealer_phone}</span></p>
					<div class="status-order mt-3 mb-4 status-{status} status_{status}" >
						<p class="status-text-{status}">{title_status}</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>
<!--  -->
<script type="text/javascript">
	var sval = '<?php echo $my_order; ?>';
	var sf_order_id;
	$('#my_orders').hide();
	var result_sorder = Array();
	var ORDER_STATUS = <?php echo  json_encode(ORDER_STATUS); ?> ;
	 $('#search_order_section #sorder').val(sval) ;
	
	if(sval){
		get_search_order();
	}

	function copyOrderNumber(){
		navigator.clipboard.writeText($("#sitem_id").html());
	}
	
    $(document).ready(function() {
        $('#btnSearchOrder').click(function(){
            sval = $('#search_order_section #sorder').val();
			 
			get_search_order();
        });
		
		$('.btn-cancel-cs').click(function(){
           	$('#my_orders').hide();
			$('#search_order_section').show('');
        });
		$('#btn_Cancel_Order').click(function(){
			showPopup('<div class="colorRed fnt-18 text-center mb30">Bạn muốn hủy đơn hàng ?</div> <button type="button" value="Đồng ý" id="btnYes" class="btn-clip btn-red">Đồng ý</button> <button type="button" value="Không" id="btnNo" class="btn-clip btn-border-red">Không</button>', el=$('.popup_content'));
			
			$('#btnNo').click(function(){hidePopup();});
			
            $('#btnYes').click(function(){
			   $.ajax({
					url: ajaxurl, // AJAX handler
					data:{'action': 'cancel_order_booking', 'order_id': sval},
					type: 'POST',
					dataType: "json",
					success: function(response) {

						dataOrderCRM = $.get_API_CRM(action = 'ajax_get_API_DATA_FROM_SF', apiName = 'APIOrderCancle', dataRequest = {"orderid" : sf_order_id, "reasoncancel" : $( "#slcOrderReason option:selected" ).text()} );
						setTimeout(function(){hidePopup(); },1000);
						setTimeout(function(){ window.location.href='<?=get_site_url()?>/order-cancel/?order-id='+sval; },1000);
						
					}
				});
			});
        });
    });
	
	var proditem = function(img, title, price, dealer_name, dealer_phone, title_status, active, status, quantity){
		var sttr = $('#order-item-template').html();
		sttr = sttr.replace(/{img}/g, img);
		sttr = sttr.replace(/{title}/g, title);
		sttr = sttr.replace(/{price}/g, price);
		sttr = sttr.replace(/{dealer_name}/g, dealer_name);
		sttr = sttr.replace(/{dealer_phone}/g, dealer_phone);
		sttr = sttr.replace(/{title_status}/g, title_status);
		sttr = sttr.replace(/{active}/g, active);
		sttr = sttr.replace(/{status}/g, status);
		sttr = sttr.replace(/{quantity}/g, quantity);

		return sttr;	
	};
	
	function get_search_order(){
		 
		if(sval != ''){ 
			// $("#sitem_id").html(sval); 
			$.ajax({
				url: ajaxurl, // AJAX handler
				data:{'action': 'ajax_get_search_order', data: sval},
				type: 'POST',
				dataType: "json",
				success: function(response) {
					result_sorder = response.data;
					
					if (typeof result_sorder["ID"] === "undefined") {
						
						$('#my_orders').hide();
						$("#msgError").text('Mã đơn hàng không tồn tại trong hệ thống. Vui lòng kiểm tra lại hay nhập lại mã đơn hàng khác.');
					} else {
						$("#sitem_id").html(sval);
						$("#msgError").empty();
						fill_order_data(result_sorder);
						$('#search_order_section').hide('slow');
						$('#my_orders').show('slow');
					}
					//$('.divloading').remove();
				}
			});
			
		}else{
			$('#my_orders').hide();
		}
	}
	
	function fill_order_data(orderdata){  
		var orderm = $('#my_orders');
		var orderlist = $('#single-order-flow .product_list');
		orderlist.html('');
		orderm.find("#sitem_id").html(orderdata.ID);
		orderm.find("#order_status").html(ORDER_STATUS[orderdata.order_status]);
		if(orderdata.order_status ==1 ||  orderdata.order_status == 5 ){
			$('#btnCancleOrderSearch').show();
		} else {
			$('#btnCancleOrderSearch').hide();
		}
		sf_order_id = orderdata.sf_order_id;
		 //alert(orderdata.orderItems.min('order_status'));
		// NGUOI PHU TRACH: sf_order_handler
		for (i = 0; i< orderdata.orderItems.length; i++){
			var active = ''; if(i==0) active = 'active'; 
			
			var item = orderdata.orderItems[i];
			var pitemText = proditem(item.image, item.product_name, currency_format(item.sub_total), dealer_name = item.dealer_name, dealer_phone=item.dealer_phone, title_status = orderm.find("#order_status").html(), active = active, status =  orderdata.order_status, quantity = item.quantity  ); 
			 
			orderlist.append(pitemText); 

			//alert(orderdata.order_status);

			if(orderdata.order_status == 6){// Don hang da huy
				$('.btn_Cancel_Order').hide();
			} // Don hang da huy
		}
		
	}
</script>