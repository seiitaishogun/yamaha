 <div class="spacer-50"></div><div class="spacer-20"></div>
 <div class="form_register register dark" style="color: #1D1F21;" >
	<form action="<?=get_site_url()?>/" method="post" id="form_register"> 
		<div class="row">
			<div class="col-lg-6 col-12">
				<h5 class="fnt-oswald" >THÔNG TIN CỦA BẠN</h5><div class="spacer-10"></div> 
				<div class="form-group">
					<input type="text" class="form-control" name="fullname"  placeholder="Họ và tên" required="required">
				</div>
				<div class="row">
					<div class="col-lg-6 col-6 pr0">
						<div class="form-group">
							<input type="text" class="form-control" minlength="10"  maxlength="12"  name="phone" placeholder="Điện thoại" required="required">
						</div>
					</div>
					<div class="col-lg-6 col-6 pl-0">
						<div class="form-group">
							<input type="text" class="form-control" name="email" placeholder="Địa chỉ Email" required="required">
						</div> 
					</div> 
				</div>
			</div>
			<div class="col-lg-6 col-12">
				<h5 class="fnt-oswald" >MẬT KHẨU CỦA BẠN</h5><div class="spacer-10"></div>
				<div class="row">
					<div class="col-lg-12 col-12">
						<div class="form-group">   
							<div class="input-group" >                    
								<input type="password" minlength="6" name="password" class="form-control tmt-pass"  placeholder="Mật khẩu" required="required">
								<div class="input-group-append tmt-pass-apend">
									<span class="input-group-text">
										<i class="fas fa-eye"></i>
									</span>
								</div>
							</div>  
						</div>
					</div>
					<div class="col-lg-12 col-12">
						<div class="form-group"> 
							<div class="input-group" >                    
								<input type="password" name="re_password" class="form-control tmt-pass" placeholder="Nhập lại Mật khẩu" required="required">
								<div class="input-group-append tmt-pass-apend">
									<span class="input-group-text">
										<i class="fas fa-eye"></i>
									</span>
								</div>
							</div>  
						</div>
					</div>
				</div>  
			</div>  
		</div>
		<div class="spacer-20"></div>
		<div class="form-group text-right">
			<input type="checkbox" name="nhanemail" value="1" required="required" class="checkbox" id="chkrNhanEmail" > <label for="chkrNhanEmail" style="display: inline-block;"> Tôi đồng ý nhận chương trình khuyến mãi của YMH qua Email/SMS</label><br>
			<input type="checkbox" required="required" name="dieukhoan" value="1" class="checkbox" id="chkrDieuKhoan" checked  > <label for="chkrDieuKhoan" style="display: inline-block;"> Tôi đồng ý với <a class="tmt-link colorBlue underline" href="<?=get_site_url()?>/terms-of-use/" target="_csdk">Chính sách và điều kiện</a> của YMH</label> 
		</div><div class="spacer-10"></div>
		<div class="form-group text-right">
			<button type="submit" id="btnRegister" class="btn-clip btn-red" >Đăng ký</button>
		</div>
	</form>
</div><div class="message"></div><div class="error_message"></div>
		 
<script type="text/javascript">
$(document).ready(function() {
	 
	$('#form_register').submit( function(e) {
		e.preventDefault(); 
		
		var dataDK = $("#form_register").getFormData(); 
		  
		$('#btnRegister').append(divloading);
		
		$.ajax({
            data:{
                    action: 'ajax_create_Customer', 
					'customer': dataDK
                },
            type: 'post',
            url: ajaxurl,
           // dataType: "json",
            success: function(response) {  
				 $('div.loading').remove(); 
				  
				 console.log(response);
				console.log(dataDK);
				
				var resp=response ;  
				
				if(resp.success ){
					//alert(resp[0]['return']["text"]);
					window.location.href = '<?=get_site_url()?>';
				}
				else{
					$('.error_message').html(resp.return.text);
					$('.error_message').addClass('active');
				} 
            } 
		});
		return false;
    });
});
</script>