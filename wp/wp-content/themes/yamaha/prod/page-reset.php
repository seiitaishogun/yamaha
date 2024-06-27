<?php
/**
 * @author HUNG VO
 * created Date: 10/12/2021
 * project: yamaha-revzone-website
 *
 * Template Name: RESET PASS
 *
 */

get_header();

if(!isset($_GET['step']))$step = 1;
else $step = $_GET['step']; 
//

?>

<div class="navigator__breadcrumbs">
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb" >
                <li class="breadcrumb-item"><a href="<?php echo wp_get_referer() ?>"><i class="fas fa-chevron-left"></i>&nbsp; Quay lại</a></li>
            </ol>
        </nav>
    </div>
</div>

<section class="container-fluid min-vh-100 section_0" id="section_1">
    <div class="mt40 pt60" ></div>
    <div class="row justify-content-center">
        <div class="col-12 col-lg-6 reset-pw">
          <form id="frm_form_resetpass_1" action="<?=get_site_url()?>/reset-password/?step=2" method="post">
			   <div class="form_resetpass">
					<img src="<?php echo get_template_directory_uri();?>/img/reset-pw/reset-pw.svg" alt=""/>
					<p class="fz-20 fw-600 mt-3">Vui lòng nhập email của bạn</p>
					<input class="border w-100" type="email" name="emailReset" required id="emailReset" value="" placeholder="Nhập Email của bạn">
					<div class="spacer-20"></div>
					<div class="error_message text-left" id="error_message_1"></div>
					<div class="my-2">
						<button type="submit" href="javascript:void(0)" id="sendReset" class="btn-clip btn-red" ><img src="<?php echo get_template_directory_uri();?>/img/reset-pw/ic-send.svg" alt=""/>&nbsp;&nbsp;Gửi</button>
					</div>
				</div> 
            </form> 
        </div>
    </div>
</section> 

<section class="container-fluid min-vh-100 section_0" id="section_2">
    <div class="mt40 pt80" ></div>
    <div class="row justify-content-center">
        <div class="col-12 col-lg-6 reset-pw">
           <div class="form_resetpass">
				<img src="<?php echo get_template_directory_uri();?>/img/reset-pw/reset-pw.svg" alt=""/>
				<p class="fz-20 fw-600 mt-3">Vui lòng nhập email của bạn</p>
				<input class="border w-100" type="email" name="email2" required id="email2" value="<?php echo $_POST['emailReset'];?>" placeholder="Nhập Email của bạn"><div class="spacer-20"></div>
				
				<div class="my-2"> 
					<a href="javascript:void(0)" id="sendReset2" class="btn-clip btn-red" ><img src="<?php echo get_template_directory_uri();?>/img/reset-pw/ic-send.svg" alt=""/>&nbsp;&nbsp;Gửi</a>
				</div>
            </div> 
            <?php  if($step == 2){
	 
				if(isset($_POST['emailReset'])): 
					$headers = array('Content-Type: text/html; charset=UTF-8', 'from: REVZONE YAMAHA MOTOR  <noreply@revzoneyamaha-motor.com.vn>');
					$emailto = $_POST['emailReset'];
					$token = md5($emailto);
	
					$us = get_user_by( 'email', $emailto );
					if ( $us ) {
						$u_id = $us->ID;
					} else {
						$u_id = false;
					}
					if($u_id && $us->user_activation_key == $token){
						
						$subject = 'Xác nhận Email để lấy lại mật khẩu!';
						$message_body = '<p>Xác nhận cấp lại mật khẩu.</p><p> Vui lòng nhấn <a href="'. get_site_url().'/reset-password/?step=3&ui='.$u_id.'&tk='.$token.'">VÀO ĐÂY</a> để xác nhận cấp lại mật khẩu cho bạn.</p>';

						$send_success = wp_mail( $emailto, $subject, $message_body, $headers, $attachments='' );

						if($send_success){
							echo '<p class="text-danger px-5">Hệ thống vừa gửi thông tin xác nhận cấp lại mật khẩu cho bạn. Vui lòng kiểm tra email và nhấn nút <b class="colorBlue" href="'.get_site_url().'/reset-password/?step=3&ui='.$u_id.'&tk='.$token.'">xác nhận</b>.</p>';
						}else{
							echo '<div class="error_message text-left" id="error_message_2">Không gửi được email do lỗi hệ thống, Bạn vui lòng xem lại Email đã nhập.</div>';
						}
					}
					
				endif;
			} ?> 
        </div>
    </div>
</section> 

<?php  if($step == 3){
	 
	if(isset($_GET['ui'])):   
		$us = get_user_by( 'ID', $_GET['ui'] );
		if ( $us ) {
			$u_id = $us->ID;
		} else {
			$u_id = false;
		}
		
	if($u_id && $us->user_activation_key == $_GET['tk']){
?>			 
		
<section class="container-fluid min-vh-100 section_0" id="section_3">
    <div class="mt40 pt80" ></div>
    <div class="row justify-content-center">
        <div class="col-12 col-lg-6 reset-pw"> 
           	<?php /*?><form id="frm_form_resetpass_3" action="<?=get_site_url()?>/reset-password/?step=4" method="post"><?php */?>
				<img src="<?php echo get_template_directory_uri();?>/img/reset-pw/change-pw.svg" alt=""/>
				<p class="fz-20 fw-600 mt-3">Vui lòng nhập mật khẩu mới của bạn!</p>
				<input type="hidden" name="uid" required id="uid" value="<?php echo $us->ID;?>" >
				<input type="hidden" name="email3" required id="email3" value="<?php echo $us->user_email;?>" >
				<input class="border w-100 mb-3" type="password" name="password" id="password" placeholder="Mật khẩu mới">
				<input class="border w-100" type="password" name="re_password" id="re_password" placeholder="Nhập lại mật khẩu mới">
				<div class="spacer-20"></div>
				<div class="error_message text-left" id="error_message_3"></div>
				<div class="my-2">
					<button type="button" id="btnUpdatePass" class="btn-clip btn-red" >Cập nhật</button>
				</div>
			 <?php /*?></form><?php */?> 
        </div>
    </div>
 </section> 
<?php } else {?>
	<section class="container-fluid min-vh-100 section_0" id="section_3">
    <div class="mt40 pt80" ></div>
    <div class="row justify-content-center">
        <div class="col-12 col-lg-6 reset-pw"> 
           	<?php /*?><form id="frm_form_resetpass_3" action="<?=get_site_url()?>/reset-password/?step=4" method="post"><?php */?>
				<img src="<?php echo get_template_directory_uri();?>/img/reset-pw/change-pw.svg" alt=""/>
				<?php /*?><p class="fz-20 fw-600 mt-3">Vui lòng nhập mật khẩu mới của bạn!</p><?php */?>
				 
				<div class="spacer-20"></div>
				<div class="error_message active text-center" id="error_message_3">Bạn đã hoàn tất phần yêu cầu thay đổi mật khẩu này rồi!</div>
				<?php /*?><div class="my-2">
					<button type="button" id="btnUpdatePass" class="btn-clip btn-red" >Cập nhật</button>
				</div><?php */?>
			 <?php /*?></form><?php */?> 
        </div>
    </div>
 </section> 
<?php } 
	endif;
} ?> 

<section class="container-fluid min-vh-100 section_0" id="section_4">
    <div class="mt40 pt80" ></div>
    <div class="row justify-content-center"> 
        <div class="col-12 col-lg-6 reset-pw">
            <img src="<?php echo get_template_directory_uri();?>/img/reset-pw/checkmark-square.svg" alt=""/>
            <p class="fz-20 fw-600 mt-3">Cập nhật mật khẩu thành công!</p>
            <p class="text-success px-5">Bạn đã cập nhật mật khẩu mới thành công. Vui lòng quay lại màn hình <a   class="popup_login colorBlue underline fnt-16" href="javascript:void(0)">đăng nhập</a> để truy cập website</p>
            <div class="my-5">
                <a href="<?=get_site_url()?>/" class="btn-clip btn-red" >quay trở lại trang chủ</a>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript">	 
	$(".section_0").hide();
	
$(document).ready(function() {
	<?php if ($step >=2){ echo '$(".form_resetpass").addClass("disabled");'; }?>
	$("#section_<?php echo ($step); ?>").show();
	
	 $("#sendReset").click(function(){ 
		 var emailR = $("#emailReset").val();
		 if((!emailR.includes("@") || !emailR.includes(".")) && emailR !== ''){
			$("#error_message_1").show('slow');
			$("#error_message_1").addClass('active');
			$("#error_message_1").text('Email không hợp lệ!');
			return false;
		 }
		/// alert(emailR);
 		if(emailR !== '' && emailR.includes("@") && emailR.includes(".")) {  
			$('#sendReset').append(divloading);
			console.log({'user_email':emailR, 'user_login':emailR} );
				$.ajax({
					data:{
							action: 'check_user_exists_resetpass', 
							'data': {'user_email':emailR, 'user_login':emailR} 
						},
					type: 'post',
					url: ajaxurl,
					dataType: "json",
					success: function(response) { 
					console.log(response); 
					var resp = response.data ;  
					if(response.success){ $('div.loading').remove();
						if(resp.exists==true){ 							 
							$("#frm_form_resetpass_1").submit();
						}else{
							$("#error_message_1").text('Email chưa tồn tại trên hệ thống!');
							$("#error_message_1").addClass('active');
							$("#error_message_1").show('slow');
							return false;
						}
					}
					else{
						$("#error_message_1").html('Hệ thống lỗi!');
						$("#error_message_1").addClass('active');
						$("#error_message_1").show('slow');
						return false;
					} 
				} 
			}); $('div.loading').remove(); 
			return false;
		}else{
			$("#error_message_1").show('slow');
			$("#error_message_1").addClass('active');
			$("#error_message_1").text('Vui lòng nhập Email của bạn!');
			return false;
		}
		
	}); 
	$("#btnUpdatePass").click(function(){ 
		var npass = $("#password").val();
		var re_npass = $("#re_password").val();
		var email3 = $("#email3").val();
		var uid = $("#uid").val();
		
 		if(npass !== '' && re_npass !== '') { 
			//alert(re_npass);
			if(npass == re_npass ) {
				$.ajax({
					data:{
							action: 'ajax_update_password', 
							'data': {'user_email':email3, 'user_id':uid, 'user_pass': npass} 
						},
					type: 'post',
					url: ajaxurl,
					//dataType: "json",
					success: function(response) { 
						console.log(response); 
						var resp = response.data ;  
						if(response.success){ $('div.loading').remove();
							if(resp.updated > 0){ 
								showPopup('<div class="colorRed fnt-20 text-center pt40 pb40">Đã thay đổi mật khẩu thành công!</div>  ', el=$('.popup_content'));
								setTimeout(function(){hidePopup(); },3000);
								setTimeout(function(){window.location.href = '<?=get_site_url()?>/reset-password/?step=4';},200);
							}else{
								$("#error_message_3").text('Email chưa tồn tại trên hệ thống!');
								$("#error_message_3").addClass('active');
								$("#error_message_3").show('slow');
								return false;
							}
						}
						else{
							$("#error_message_1").html('Hệ thống lỗi!');
							$("#error_message_1").addClass('active');
							$("#error_message_1").show('slow');
							return false;
						} 
					} 
				}); 
			}else{
				$("#error_message_3").show('slow');
				$("#error_message_3").addClass('active');
				$("#error_message_3").text('Mật khẩu không khớp với nhau, vui lòng kiểm tra lại!');
				return false;
			}
		}else
		if(npass == '') {
			$("#error_message_3").show('slow');
			$("#error_message_3").addClass('active');
			$("#error_message_3").text('Vui lòng nhập mật khẩu mới của bạn!');
			return false;
		}else
		if(re_npass == '') {
			$("#error_message_3").show('slow');
			$("#error_message_3").addClass('active');
			$("#error_message_3").text('Vui lòng nhập lại mật khẩu mới của bạn một lần nữa!');
			return false;
		}
	});
});
</script>

<?php
get_footer(); ?>


