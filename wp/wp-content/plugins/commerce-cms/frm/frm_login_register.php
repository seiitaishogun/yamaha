<div id="maskw" class="maskw"></div>
	<div class="login-wrapped"> 
	<div class="login-form box-shadow03rem" id="login_form">
	<button id="close_me" class="close_me"><i class="fa fa-times"></i></button> 
		<div class="form-group">
			<input type="radio" name="chklogin" value="login" class="checkbox chklogin" id="chkDN" checked > <label for="chkDN"> Tôi đã có tài khoản YMH</label><br>
			<input type="radio" name="chklogin" value="register" class="checkbox chklogin" id="chkDK"> <label for="chkDK"> Tôi chưa có tài khoản YMH</label>
		</div>
		 <div class="form-dang-nhap formm login" >
		 <form action="<?=get_site_url()?>/" method="post" id="form_dang_nhap"> 
			 <h5 class="fnt-oswald" >ĐĂNG NHẬP</h5>
			  <hr>
				<div class="form-group">Email của bạn
					<input type="text" class="form-control" name="username" placeholder="Email/Tên đăng nhập" required="required" title="Bạn phải nhập Email/Tên đăng nhập!" >
				</div>
				<div class="form-group">Mật khẩu của bạn
					<div class="input-group" >                  
						<input type="password" name="password" class="form-control tmt-pass" placeholder="Mật khẩu" required="required" title="Bạn phải nhập Mật khẩu!">
						<div class="input-group-append tmt-pass-apend">
							<span class="input-group-text">
								<i class="fas fa-eye"></i>
							</span>
						</div>
					</div>  
				</div><div class="spacer-5"></div>
				<div class="form-group">
					<input type="submit" id="btnDangNhap" class="btn tmt-login btn-primary btn-block" value="ĐĂNG NHẬP">
				</div>
			</form>
			<div class="form-group text-center"><div class="spacer-5"></div>
				<a href="<?=get_site_url()?>/reset-password" class="tmt-link">Quên mật khẩu? Click vào đây!</a>
				<hr><p class="text-center">HOẶC</p>
			</div>

			<div class="form-group text-center">
				<a href="#" class="btn btn-block btn-facebook">
					<i class="fab fa-facebook-f"></i>
					Đăng nhập bằng Facebook
				</a>
			</div>
			<div class="form-group text-center">
				<a href="#" class="btn btn-block btn-google">
				<span class="icon icon_goolge"></span>
					Đăng nhập bằng Google
				</a>
			</div> 
		</div>
		<div class="form_dang_ky formm register" >
			<form action="<?=get_site_url()?>/" method="post" id="form_dang_ky"> 
				<h5 class="fnt-oswald" >THÔNG TIN TÀI KHOẢN</h5><hr>
				<div class="form-group">
					<input type="text" class="form-control" name="fullname"  placeholder="Họ và tên" required="required" title="Bạn phải nhập Họ và tên!">
				</div>
				<div class="form-group">
					<input type="text" class="form-control" minlength="10"  maxlength="12"  name="phone" placeholder="Điện thoại" required="required" title="Bạn phải nhập Số điện thoại!">
				</div>
				<div class="form-group">
					<input type="text" class="form-control" name="email" placeholder="Địa chỉ Email" required="required" title="Bạn phải nhập địa chỉ Email hợp lệ!">
				</div> 
				<div class="form-group">   
					<div class="input-group" >                    
						<input type="password" minlength="6" name="password" class="form-control tmt-pass"  placeholder="Mật khẩu" required="required" title="Bạn phải nhập Mật khẩu, tối thiểu là 6 ký tự.">
						<div class="input-group-append tmt-pass-apend">
							<span class="input-group-text">
								<i class="fas fa-eye"></i>
							</span>
						</div>
					</div>  
				</div>
				<div class="form-group"> 
					<div class="input-group" >                    
						<input type="password" name="re_password" class="form-control tmt-pass" placeholder="Nhập lại Mật khẩu" required="required" title="Bạn phải nhập lại Mật khẩu, tối thiểu là 6 ký tự.">
						<div class="input-group-append tmt-pass-apend">
							<span class="input-group-text">
								<i class="fas fa-eye"></i>
							</span>
						</div>
					</div>  
				</div><div class="spacer-5"></div>
				<div class="form-group ">
					<input type="checkbox" name="nhanemail" value="1" class="checkbox" id="chkNhanEmail"  style="display: inline !important;"> <label for="chkNhanEmail" style="display: inline-block;"> Tôi đồng ý nhận chương trình khuyến mãi của YMH qua Email/SMS</label><br>
					<input type="checkbox" required="required" title="Bạn phải xác nhận Chính sách và điều kiện của YMH, bằng cách đánh dấu check vào ô bên cạnh."  name="dieukhoan" value="1" class="checkbox" id="chkDieuKhoan" checked  style="display: inline !important;"> <label for="chkDieuKhoan" style="display: inline-block;"> Tôi đồng ý với <a class="tmt-link underline" href="<?=get_site_url()?>/terms-of-use/" target="_csdk">Chính sách và điều kiện</a> của YMH</label>
				</div>
				<div class="form-group">
					<input type="submit" id="btnDangKy" class="btn tmt-login btn-primary btn-block" value="Đăng ký">
				</div>
			</form>
		</div>
		<div class="message"></div><div class="error_message"></div>
	 </div>
	</div>
<script type="text/javascript">
	var current_url = '<?php echo ( get_site_url().$_SERVER['REQUEST_URI']) ;?>';
	if(current_url.indexOf('reset-password')){current_url = '<?php echo get_site_url() ;?>';}
	function show_popup_login(){
		var ttt= $(document).find($("#maskw.maskw")); 
		var ttttt= $(document).find($("#login_form.login-form"));  
		if(!ttt.hasClass('active')){			
			$('.login-wrapped').show();
			$('.login-wrapped').addClass('active');
			ttt.addClass('active');
			ttt.show('slow');
			ttttt.show('slow');
		}else{
			ttt.hide('');
			ttttt.hide('');
			ttt.removeClass('active');
			$('.login-wrapped').hide();
			$('.login-wrapped').removeClass('active');
		} 
	}
	
	function hide_popup_login(){
		$("#maskw.maskw").hide();
		$("#maskw.maskw").removeClass('active');
		$("#login_form").hide();
		$(".login-wrapped").removeClass("mrcenter");
		$("#login_form").removeClass('active'); 
	}
$(document).ready(function() {
	$('.formm').hide();
	$('.login-wrapped').hide();
	$('.form-dang-nhap.formm').show();
	
	$('.message').removeClass('active');
	$('.error_message').removeClass('active');
	
	$("#login_form").hide();
	$("#maskw.maskw").hide();
	$(document).find((".login-form")).hide(); 
	
	$('.chklogin').click(function() {
		$('.formm').hide();
		$('.formm.'+$(this).val()).show('slow'); 
		$('.error_message').hide('active');
		$('.message').hide('active');
	});
	
	if($("#close_me")){
		$("#close_me").click(function(){  
			hide_popup_login();
		});
	} 
	$("#maskw.maskw").click( function(e){  
		  hide_popup_login();
	}); 
	
	$(".input-group-append.tmt-pass-apend").click(function(){
		var pri = $(this).parent().find('input.tmt-pass');
		//alert(pri.attr('type'));
		if(pri.attr('type')=='password'){
			pri.attr('type','text');
			$(this).find(".fas").addClass('fa-eye-slash');
		}else{
			pri.attr('type','password');
			$(this).find(".fas").removeClass('fa-eye-slash');
		}
			
	}); 
	
	$(".popup_login").click(function(){

		show_popup_login();
		$(".login-wrapped").addClass("mrcenter"); 
		return false;
	}); 
	
	$("a.dangky-dangnhap").click(function(){   
		show_popup_login();
		return false;
	});
	
	$(window.document).scroll(function(){
		if($(window).scrollTop() > 120){
			$('.login-wrapped.active').addClass("msticky");
		}else if($(window).scrollTop() <= 80){
			$('.login-wrapped.active').removeClass("msticky");
		}
	})
	
	$('#form_dang_nhap').submit(function(e) {
		e.preventDefault(); 
		
		var dataDN = $("#form_dang_nhap").getFormData(); 
		  
		$('#btnDangNhap').append(divloading);
		
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
				console.log(response);
				console.log(dataDN); 
				
				var resp = response.data ; 
				 
				if(response.success){
					if(resp.return.status=='success'){ 
						window.location.href = current_url;
					}else{
						$('.error_message').html(''+resp.return.text+'');
						$('.error_message').addClass('active');
						$('.error_message').show('slow');
					}
				}
				else{
					$('.error_message').html(''+resp.return.text+'');
					$('.error_message').addClass('active');
					$('.error_message').show('slow');
				}
				setTimeout(function(){$('.error_message').hide('slow');}, 100000);
            } 
		});
		return false;
    });
		
	$('#form_dang_ky').submit( function(e) {
		e.preventDefault(); 
		
		var dataDK = $("#form_dang_ky").getFormData(); 
		  
		$('#btnDangKy').append(divloading);
		
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
				
				var resp = response.data ; 
				
				if(response.success ){
					if(resp.return.status=='success'){ 
						hide_popup_login();
						showPopup('<div class="colorRed fnt-18 text-center ">Đã đăng ký tài khoản thành công! <p>Vui lòng kiểm tra Email của bạn để xác thực tài khoản.</div>  ', el=$('.popup_content'));
						setTimeout(function(){hidePopup(); },5000);		
						setTimeout(function(){window.location.href = '<?=get_site_url()?>/user/#user-info'; },500);
					}else{
						$('.error_message').html(''+resp.return.text+'');
						$('.error_message').addClass('active');
						$('.error_message').show('slow');
					}
				}
				else{
					$('.error_message').html(resp.return.text);
					$('.error_message').addClass('active');
					$('.error_message').show('slow');
				} 
				setTimeout(function(){$('.error_message').hide('slow');}, 10000);
            } 
		});
		return false;
    });
});
</script>