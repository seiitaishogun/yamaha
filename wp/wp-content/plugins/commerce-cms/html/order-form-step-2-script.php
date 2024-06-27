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

//print_r($customer_order);
?>
<?php  $customer_order['voucher'] = '';  ?>

<script type="text/javascript"> 
	DATA_CARD = JSON.parse(localStorage.getItem('booking_cookie')); 
	DATA_CARD = sort_DATA_CART(DATA_CARD);

	var order_id = '<?=$order_id?>';
	var order_ids = <?php echo wp_json_encode($order_id, true); ?>;

	var dataOrderItem = DATA_CARD; 

	var DataItemsSplited = split_Items_By_Product_Type(dataOrderItem);
	var DataCustomer;
	var dataOrderFull;
	var dataHoaDon;

	var promotion_products; 
	var voucher_input = Array(); 
	var promotion_item_id = '';
  

$(document).ready(function() { 
	

	//load_data_address_list(element_select = '#lst_rec_address');
   	$("#collapse_p").hide();
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
	
	$("#invoice_require").click(function() {
		
		if($(this).is(":checked")){
			$("#collapse_p").show('slow');
			$("#invoice_require").val('1');
		}else{
			$("#invoice_require").val('0');
			$("#collapse_p").hide('slow');
		}
	});

	// set default address
	$('.filter-dealer .dropdown-item').each(function(index){
		if ($(this).attr('data-default') == 1){
			var text = $(this).html();
	        var name = $(this).attr('data-name');
	        var address = $(this).attr('data-address');
	        var phone = $(this).attr('data-phone');
	        var province_id = $(this).attr('data-province-id');
	        var district_id = $(this).attr('data-district-id');
	        var ward_id = $(this).attr('data-ward-id');
	        var address_id = $(this).attr('data-address_id');

	        set_receiver_address(name, phone, address, address_id, province_id, district_id, ward_id, text );
		}
	}); 
 
 	// dataHoaDon = $("#frmHoaDon").getFormData();

 	// $("#tax_number").focusout(function(){
 	// 	dataHoaDon = $("#frmHoaDon").getFormData();
 	// }); 
	
	$('#btnFinish').click(function(e) {
		// payment('test','',49);return;
		e.preventDefault(); 
		
		dataHoaDon = $("#frmHoaDon").getFormData(); 

		DataCustomer = Object.assign(dataOrder, dataHoaDon);

		dataOrderFull = {
			'DATA_CUSTOMER_ORDER': DataCustomer, 
			'DATA_ITEM': DataItemsSplited,
		}; 
		
		console.log(dataOrderFull);
		
		var response = grecaptcha.getResponse();  
		
		if( !dataOrderItem.length ){
			showPopup('<div class="colorRed fnt-18 text-center pt20 pb20 mt60">Giỏ hàng chưa có sản phẩm!<br><br><a class="btn-clip btn-border-red colorBlue" href="<?=get_site_url()?>/apparels/">Quay lại trang mua sắm.</a></div>  ', el=$('.popup_content'));

			setTimeout(function(){hidePopup(); },3000);
			
			setTimeout(function(){window.location.href='<?=get_site_url()?>/apparels/';},100);
			
		} else if (data_receiver_address.address_id == undefined){
			showPopup('<div class="colorRed fnt-18 text-center pt20 pb20 mt60">Vui lòng chọn hoặc tạo địa chỉ nhận hàng.</div>  ', el=$('.popup_content'));
			setTimeout(function(){hidePopup(); },3000);
		} else if( !response.length ){
			 
			showPopup('<div class="colorRed fnt-18 text-center pt20 pb20 mt60">Vui lòng xác nhận tôi không phải người máy.</div>  ', el=$('.popup_content'));
			setTimeout(function(){hidePopup(); },3000);
			return false; 
		}else if(!$("#chkAgree").is(":checked")){ 
			showPopup('<div class="colorRed fnt-18 text-center pt20 pb20 mt60">Vui lòng đọc và xác nhận đồng ý [Điều kiện, Chính sách] của YMH.</div>  ', el=$('.popup_content'));
			setTimeout(function(){hidePopup(); },3000);
			$("#chkAgree").focus(); 
			return false; 
		} 

		// response = [1];
		if($("#chkAgree").is(":checked") && response.length && dataOrderItem.length  > 0){
			$(this).append(divloading);
			update_order_booking_splited(dataOrderFull, voucher_input );	
		} 
	
	});

	$(document).on('click', '.filter-dealer .dropdown-item', function() {
        var that = $(this);
        var text = that.html();
        var name = that.attr('data-name');
        var address = that.attr('data-address');
        var phone = that.attr('data-phone');
        var province_id = $(this).attr('data-province-id');
        var district_id = $(this).attr('data-district-id');
        var ward_id = $(this).attr('data-ward-id');
        var address_id = $(this).attr('data-address_id');

        set_receiver_address(name, phone, address, address_id, province_id, district_id, ward_id, text);
    }); 

    $('input#voucher_input').focusout(function(){

    	//alert($(this).val());
    	if($(this).val() !== ''){ 
    		$('#btn_check_voucher').removeClass('hide').show();
    	}else{
    		$('#btn_check_voucher').hide('');
    	} 
    });

    $('#btn_check_voucher').click(function() {
        var dataPromotionItem;   // {"voucherCode" : "MK01Ypo-Y9WLQ"}
        var promo_products;
        var voucher = $('input#voucher_input').val(); 

        

       $(this).hide('');

        check_and_load_voucher(voucher);
 
    }); 


    $("#btnTESTAPI").click(function(){
    	call_API_CRM_UPDATE_ORDER(order_ids=[63,64,65]);
    });
 
	
	//dataOrder['invoice'] = dataHoaDon; 

	function update_order_booking_splited(dataFull, voucherCode = '' ){
		var payment_option = $("input[name='payments']:checked").val();
		$.ajax({
			data:{
					'action': 'update_order_booking_splited',
					'order_ids': order_ids,
					'dataOrderFull': dataFull, 
				},
			type: 'post',
			url: ajaxurl,
			dataType: "json",
			success: function(response) { 
				console.log(response); 
				$('div.loading').remove();

				var resp = response.data; 				   
				 order_id = resp.order_id;
				 $('#order_id').val(order_id);
				 order_ids = JSON.stringify(resp[0].order_ids); 

				if(resp[0].order_ids.length > 0){
					var callCRMAPI = call_API_CRM_UPDATE_ORDER(resp[0].order_ids); 

					 if(parseInt(order_id) > 0){
						if(payment_option == 'Showroom'){
							//window.localStorage.removeItem('booking_cookie');  

							if(callCRMAPI===true){
								showPopup('<div class="colorRed fnt-18 text-center pt40 pb40">Đặt hàng thành công!.</div>  ', el=$('.popup_content'));
								setTimeout(function(){hidePopup(); },2000);
								setTimeout(function(){window.location.href='<?=get_site_url()?>/order-confirm/?order_id='+order_id + '&order_ids=' + order_ids;},300);
							}
								
						}else{ 
							payment('test','',order_id);
							//window.localStorage.removeItem('booking_cookie');

							// if(callCRMAPI===true){
							// 	showPopup('<div class="colorRed fnt-18 text-center pt40 pb40">Đặt hàng thành công!.</div>  ', el=$('.popup_content'));
							// 	setTimeout(function(){hidePopup(); },2000);
							// 	setTimeout(function(){window.location.href='<?=get_site_url()?>/order-confirm/?order_id='+order_id + '&order_ids=' + order_ids;},300);
							// }
						}
										
					}
					
				}
			}

		});		
	} 

	
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


	function call_API_CRM_UPDATE_ORDER(myorder_ids=[]){

		// $.each (order_ids, function(index, order_id){
		// 	dataOrder={
		// 		"web_order_id" : "6",
		// 	    "customer_id" : "12121",
		// 	    "receive_address" : "Cach mang t8",
		// 	    "recevie_province" : "Sai gon",
		// 	    "receive_district" : " Q.3",
		// 	    "receive_ward" : "P11",
		// 	    "invoice_require" : "112121212",
		// 	    "tax_number" : "12121212",
		// 	    "company_info" : "omi1",
		// 	    "company_address" : "",
		// 	    "dealer_code" : "11111",
		// 	    "payment_method" : "Tra gop",
		// 	    "promotion_code" : "123",
		// 	    "vouchers" : [voucherCode],
		// 	    "orderProducts" : [
		// 	        {
		// 	            "productcode" : "MT10",
		// 	            "quantity" : 1,
		// 	            "sizecode" : "",
		// 	            "colorcode" : "Black" ,
		// 	            "price" : 250000000,
		// 	            "sale_off" : 2.5
		// 	        }
		// 	    ]
		// 	};
		// });  
		var success = true;

		if(myorder_ids.length>0){			
 			
 			//GET ORDER_FULL & UPDATE promotion_code
			var dataSFOrderFull = $.get_AJAX_FUNCTION(action = 'ajax_get_Full_Order_for_SF', dataRequest = {
				'myorder_ids' : myorder_ids, 
				'promotion_code' : promotion_item_id} );

			console.log('dataSFOrderFull before SEND: ');
			console.log(dataSFOrderFull);
 
			if(dataSFOrderFull){ //ORDER FULL

				var SF_dataRequest = dataSFOrderFull.data.ajax_get_Full_Order_for_SF;

				console.log({'SF_dataRequest: ':SF_dataRequest});

				// SEND ORDER FULL TO CRM
				var dataSF_RESPONSE = $.get_API_CRM(action = 'ajax_get_API_DATA_FROM_SF', apiName = 'APIOrderAndOrderItemModel', dataRequest = SF_dataRequest );

				//dataSF_RESPONSE.data[1].data;
				console.log('dataSF_RESPONSE: ');
				console.log(dataSF_RESPONSE);

				var sf_order_ids = dataSF_RESPONSE.data[1].data;

				console.log(sf_order_ids);

				if(sf_order_ids !== 'null'){
					//if(sf_order_ids.length > 0){ // CAP NHAT SF_ORDER_IDS
						var lastResponse = $.get_AJAX_FUNCTION(
				 					action = 'ajax_update_order_for_SF_ID', 
				 					dataRequest = {"web_order_ids": myorder_ids, "sf_order_ids": sf_order_ids, "promotion_code" : promotion_item_id });

		 				console.log({'web_lastResponse' : lastResponse});

		 				success = true;
					//}else{
		 				//showPopup('<div class="colorRed fnt-18 text-center pt40 pb40">Gửi đơn hàng # '+JSON.stringify(myorder_ids)+'  không thành công! Có lỗi về kỹ thuật. <hr>' +dataSF_RESPONSE.data[1].responseMessage+ '</div>  ', el=$('.popup_content'));
		 				// success = (success && false);
				 	//}

				}else{
		 				showPopup('<div class="colorRed fnt-18 text-center pt40 pb40">Gửi đơn hàng: # '+JSON.stringify(myorder_ids)+' không thành công! Có lỗi về kỹ thuật. <hr>' +dataSF_RESPONSE.data[1].responseMessage+ '</div>  ', el=$('.popup_content'));
		 				 success = (success && false);
				 	}
			}
		}else{
			success = (success && false);
		}
		return success;

	} 
});
 
// show selected address on screen
function set_receiver_address(name, phone, address, address_id, province_id, district_id, ward_id, display_address ){
	$(".filter-dealer .top-line").html('<hr class="mt-2 mb-2">');
    $(".filter-dealer .title").html(display_address);
    $(".filter-dealer .label").html(display_address);
    
    data_receiver_address = {
		name: name,
        phone: phone,
        address: address,
        address_id : address_id 
    };

	dataOrder['receiver_address'] = '{ "name" : "' + name + '", "phone" : "' + phone + '", "address" : "' + address + '" }';
	dataOrder['province_id'] = province_id;
	dataOrder['district_id'] = district_id;
	dataOrder['ward_id'] = ward_id;

	province_Item = DATA_PROVINCE.find(x => x.province_id == province_id);

	//alert(dataOrder['shipping_fee']);

	if(province_Item){
		dataOrder['shipping_fee'] = province_Item.shipping_fee;
		 
		set_shipping_fee(province_Item.shipping_fee);

		DataCustomer = Object.assign(dataOrder, dataHoaDon);

		dataOrderFull = {
			'DATA_CUSTOMER_ORDER': DataCustomer, 
			'DATA_ITEM': DataItemsSplited,
		};

		dataOrderFull.DATA_CUSTOMER_ORDER = DataCustomer;
			 
		console.log(dataOrderFull);
	} 
	//alert(dataOrder['shipping_fee']); 
	 
}

function check_and_load_voucher(){
	var dataPromotionItem;   // {"voucherCode" : "MK01Ypo-Y9WLQ"}
    var promo_products;
    var voucher = $('input#voucher_input').val();   
  

	//get_API_CRM: function(action = 'ajax_get_API_DATA_FROM_SF', apiName = 'APICheckVoucher', dataRequest) 
    dataPromotionItem = $.get_API_CRM(action = 'ajax_get_API_DATA_FROM_SF', apiName = 'APICheckVoucher', dataRequest = {"voucherCode" : voucher } );

    //response = JSON.parse(response);

    if(dataPromotionItem){
    	//dataPromotionItem = JSON.parse(dataPromotionItem);
    	console.log(dataPromotionItem.data[1]);

    	promotion_item_id='';

		if(dataPromotionItem.data[1].promotionItemId){
			promotion_item_id = dataPromotionItem.data[1].promotionItemId;
		}

    	if(promotion_item_id !== null && promotion_item_id !== ''){
    		//get_AJAX_FUNCTION: function (action = 'ajax_get_API_DATA_FROM_SF', dataRequest={})
	        promo_products = $.get_AJAX_FUNCTION( 
	        			action = "ajax_get_promotion_products",
	        			{"promotion_item_id" : promotion_item_id}
	        			); 

			if(promo_products === null ){
				$('.item-voucher-box .txtVoucher').html('Voucher ['+voucher+'] không tồn tại hoặc chương trình KM đã hết hạn.');
			}else{

				if(!voucher_input.includes(voucher)){
			    	voucher_input.push(voucher); 			     

					promotion_products = promo_products.data; 
					console.log(promotion_products);  

					dataOrderFull['DATA_CUSTOMER_ORDER'].voucher = JSON.stringify(voucher_input);
					dataOrderFull['DATA_CUSTOMER_ORDER'].promotion_code = promotion_item_id;

					// Show Popup 
					show_popup_promotion();

					// UPDATE DATA CART ITEM
					console.log('DATA CART ITEM: ');
					console.log(dataOrderFull['DATA_ITEM']);
					//alert(dataOrderFull['DATA_ITEM'] );

					dataOrderFull['DATA_ITEM'] = update_Promotion_ToCart(dataOrderFull['DATA_ITEM'], promotion_products['promotion_product']);

					// UPDATE booking_checkout
					console.log('After UPDATE DATA CART ITEM: dataOrderFull[\'DATA_ITEM\']');
					console.log(dataOrderFull['DATA_ITEM']);

					render_booking_checkout(Booking_Table = $('#Booking_Table'), Booking_Items = $('#Booking_Items'), dataOrderFull['DATA_ITEM'], voucher); 

				} 

		        $("#section_voucher_list").html(get_show_voucher_list());
		        
		        $('.item-voucher-box .txtVoucher').html(promotion_products['promotion_item'].promotion_name + ' '+ promotion_products['promotion_item'].promotion_item_name + ': ' + 
					currency_format(promotion_products['promotion_item'].voucher_amount)); 

			} 
    	}else{
    		$('.item-voucher-box .txtVoucher').html('Voucher ['+voucher+'] không tồn tại hoặc chương trình Khuyến mãi đã hết hạn.');
    	}
       
    } 
}

function show_button_vourcher(){ 
 
	if($('input#voucher_input').val() !== ''){ 
		$('#btn_check_voucher').removeClass('hide').show();
	}else{
		$('#btn_check_voucher').hide('');
	}  
}

function show_popup_promotion(){

	if(promotion_products !== null){
		var strTmp = '<ol class="align-left">';

		$.each(promotion_products['promotion_product'], function(index, item)
		{   
			strTmp += '<li class="align-left" style="text-align:left;">' + item.record_type + ': ' + item.product_code + ' ' + 
		 	item.color_code + ': discount: ' + item.discount + '%</li>';
		});

		strTmp += '</ol>';

		showPopup('<div class="colorRed fnt-18 text-center pt20 pb20 mt40"><div>' + 
			promotion_products['promotion_item'].promotion_name + ' <br/> ' + 
			promotion_products['promotion_item'].promotion_item_name + ': ' + 
			currency_format(promotion_products['promotion_item'].voucher_amount) + 
			'</div><div class="fnt-14 align-left pt20 pb20">' + 
			strTmp + 
			'</div></div>', el=$('.popup_content')); 
	}
	
} 

function get_show_voucher_list(){
    	strTmp = '';
    	//alert(voucher_input);
    	if(voucher_input.length > 0){
    		var strTmp = '<ul class="align-left">';
 
			$.each(voucher_input, function(index, item)
			{   
				strTmp += '<li class="relative align-right fnt-oswald fnt-18 voucher_item" ><span class="align-left">' + 'Mã giảm giá: ' + '</span><span  class="align-right">' + item + ' ' + '<a href="javascript:void(0);" class"absolute remove_voucher"><i class="fa fa-times"></i></a><hr/></li>';
			});

			strTmp += '</ul>'; 
    	}
    	return strTmp;    	
    }
</script>