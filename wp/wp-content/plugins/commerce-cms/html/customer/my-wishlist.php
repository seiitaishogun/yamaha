<section class="wishlist" >
    <div class="container-fluid px-md-0">
	   <?php // print_r($current_user);
		if (is_user_logged_in() ) // is login
		{
			load_wishlist_handler(); // in plugins/app/API/functions.php
		} 
		else{ ?>
			<div class="box-shadow01rem text-center pt40 pb40 colorDark" >
				<p class="fnt-20 fw-600 pb20">Bạn cần đăng nhập để sử dụng được tính năng này.</p>
				<a class="popup_login btn-clip btn-border-red" href="javascript:void(0);">ĐĂNG NHẬP </a> 
			</div> 
	 <?php } ?>
			<div class="spacer-20"></div>  
	</div>
</section>

<script type="text/javascript">
$(document).ready(function() {
	$('.btn-remove-wishlist').click(function(){
		var this_product = $(this).parent('.product-item');
		var wl = parseInt($('.mnuicon.mwishlist_count').find('.w_count').attr('data-count'));
		
		showPopup('<div class="colorGray fnt-18 text-center mb30">Bạn muốn xóa sản phẩm này ra khỏi yêu thích ?</div> <button type="button" value="Đồng ý" id="btnYes" class="btn-clip btn-red btn-small">Đồng ý</button> <button type="button" value="Không" id="btnNo" class="btn-clip btn-border-red btn-small">Không</button>', el=$('.popup_content'));
			
			$('#btnNo').click(function(){hidePopup();});
			
            $('#btnYes').click(function(){
				this_product.remove(); 
				wl--;
				$('.mwishlist_count').find('.w_count').attr('data-count', wl);
				$('.mwishlist_count').find('.w_count').html(wl);
				
				//alert(Favorites.userFavorites);
				
				//console.log(Favorites.userFavorites); 
				
				var formData = {
				action : Favorites.formActions.favorite,
				postid : this_product.attr("data-id"),
				siteid : 1,
				status : 'inactive',
				user_consent_accepted : true
				}
				$.ajax({
					url: Favorites.jsData.ajaxurl,
					type: 'post',
					dataType: 'json',
					data: formData,
					success: function(data){
						
						console.log(data); 
						 
						Favorites.userFavorites = data.favorites; 
						showPopup('<div class="colorRed fnt-18 text-center ">Đã xóa sản phẩm yêu thích thành công!</div>  ', el=$('.popup_content'));
						setTimeout(function(){hidePopup(); },3000); 
					},
					error: function(data){
						 
						console.log(data);
					}
				});
				hidePopup();
			});
	});
})
</script>
