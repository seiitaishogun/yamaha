<div id="mask_popup_address" class="mask_popup_address"></div>
<div id="address_wrapped" class="address_wrapped box-shadow03rem bgwhite pb30"> 
	<div class="address_book_form " id="address_book_form">
	<h2 class="title fnt-oswald">Tạo sổ địa chỉ</h2>
	<?php include_once(WP_PLUGIN_DIR.'/commerce-cms/frm/frm_customer_address.php'); ?> 

		<div class="pmessage"></div><div class="error_pmessage"></div>
	 </div>
</div>
	
<script type="text/javascript">
$(document).ready(function() {
	 
	$('.address_wrapped').hide(); 
	
	$('.pmessage').removeClass('active');
	$('.error_pmessage').removeClass('active');
	
	$("#address_book_form").hide();
	$("#mask_popup_address").hide(); 
	
	$("#mask_popup_address").click( function(e){  
		  $(this).hide();
		  $(this).removeClass('active');
		  $("#address_book_form").hide('slow');
		  $("#address_book_form").removeClass('active'); 
		$('.address_wrapped').hide();
	}); 
	
	$(".input-group-append.tmt-pass-apend").click(function(){
		var pri = $(this).parent().find('input.tmt-pass');
		//alert(pri.attr('type'));
		if(pri.attr('type')=='password'){
			pri.attr('type','text');
		}else{pri.attr('type','password');}
			
	}); 
	 
	$("#btnAddress_book").click(function(){
		 
		$("#btnAddress_book").poupAddressClicked();
	}); 
	
	$(".popup_add_address").click(function(){  
		 $(".popup_add_address").poupAddressClicked();
	});
	
	$(window.document).scroll(function(){
		if($(window).scrollTop() > 120){ 
			$('.address_wrapped.active').addClass("addsticky");
		}else if($(window).scrollTop() <= 80){
			$('.address_wrapped.active').removeClass("addsticky"); 
		}
	})
	
	<?php /*?>$('#address_book_form').submit(function(e) {
		e.preventDefault(); 
		
		var dataDN = $("#address_book_form").getFormData(); 
		  
		$('#btnNewAddress').append(divloading);
		
		 $.ajax({
            data:{
                    action: 'ajax_login_ymh', 
					'data_dangnhap': dataDN 
                },
            type: 'post',
            url: ajaxurl,
            //dataType: "json",
            success: function(response) {  
				$('div.loading').remove(); 
				response = response.toString().trim();
				response = '['+response.toString().replace('}0', '}]');
				console.log(response);
				console.log(dataDN); 
				
				var resp = JSON.parse(response);  
				 
				if(resp[0]['success']){
					alert(resp[0]['return']["text"]);
					window.location.href = '<?=get_site_url()?>/booking/';
				}
				else{
					$('.error_message').html(''+resp[0]['return']["text"]+'');
					$('.error_message').addClass('active');
				} 
				 
            } 
		}); 
		return false;
    });<?php */?>
		
	$('#address_book_form_edit').submit( function(e) {
		e.preventDefault(); 
		
		var dataDK = $("#address_book_form_edit").getFormData(); 
		  
		$('#btnEditAddress').append(divloading);
		
		<?php /*?>$.ajax({
            data:{
                    action: 'ajax_create_Customer', 
					'customer': dataDK
                },
            type: 'post',
            url: ajaxurl,
           // dataType: "json",
            success: function(response) {  
				 $('div.loading').remove(); 
				 
				response = response.toString().trim();
				response = '['+response.toString().replace('}0', '}]');
				 console.log(response);
				console.log(dataDK);
				
				var resp = JSON.parse(response);  
				
				if(resp[0]['success']){
					alert(resp[0]['return']["text"]);
					window.location.href = '<?=get_site_url()?>/booking/';
				}
				else{
					$('.error_message').html(resp[0]['return']["text"]);
					$('.error_message').addClass('active');
				} 
            } 
		});<?php */?>
		return false;
    });
	
	<?php /*?>if($("#close_me")){
		$("#close_me").click(function(){  
			$("#mask_popup_address").hide();
		  	$("#mask_popup_address").removeClass('active');
		  	$("#address_book_form").hide('slow');
		  	$("#address_book_form").removeClass('active'); 
			$('.address_wrapped').hide(); 
		});
	}<?php */?>
	
	(function($){
	  $.fn.poupAddressClicked = function(){
		  	
		var ttt= $(document).find($("#mask_popup_address")); 
		if(!ttt.hasClass('active')){  
			ttt.show();
			$('.address_wrapped').show();
			$('.address_wrapped').addClass('active'); 
			$(".address_wrapped").addClass("mrcenter");
			$(".address_wrapped").addClass('addsticky'); 
			
			$("#address_book_form").show();
		  	$("#address_book_form").addClass('active'); 
		  	
			ttt.addClass('active');
			//window.scrollTo(100, 0);
			
		}else{
			ttt.hide();
			ttt.removeClass('active');
			$('.address_wrapped').hide();
			$('.address_wrapped').removeClass('active');
			$(".address_wrapped").removeClass("mrcenter");
			$("#address_book_form").hide();
		  	$("#address_book_form").removeClass('active');
			$(".address_wrapped").removeClass('addsticky');
		} 
		 
	  }
	})(jQuery);
	
	
});
</script>	