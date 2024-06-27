<?php
/**
* @author tmtuan
* created Date: 11/30/2021
* project: yamaha-revzone-website
*
* Template Name: DangKy
*
*/

global $wpdb;
$dtTable = $wpdb->prefix.'province';

if (is_user_logged_in()) { 
	wp_redirect(get_bloginfo('home')); 
	exit;
} else {
	$show = true;

	$province = $wpdb->get_results ( "SELECT * FROM $dtTable ");
	
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php wp_title(); ?></title>
	<link rel="shortcut icon" type="image/png" href="<?php bloginfo('url')?>/asset/icon.png"/>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Bootstrap -->
    <link href="<?php bloginfo('template_url'); ?>/css/styles.min.css" rel="stylesheet">
    
	<style>
		.divider-text {
    position: relative;
    text-align: center;
    margin-top: 15px;
    margin-bottom: 15px;
}
.divider-text span {
    padding: 7px;
    font-size: 12px;
    position: relative;   
    z-index: 2;
}
.divider-text:after {
    content: "";
    position: absolute;
    width: 100%;
    border-bottom: 1px solid #ddd;
    top: 55%;
    left: 0;
    z-index: 1;
}

.btn-facebook {
    background-color: #405D9D;
    color: #fff;
}
.btn-twitter {
    background-color: #42AEEC;
    color: #fff;
}
	</style>
	
	<!-- jQuery -->
    <script src="<?php bloginfo('template_url'); ?>/js/vendor/jquery-3.5.1.min.js"></script>
</head>
  
<body class="login">

<div class="card bg-light">
	<?php
		if(isset($_POST['submit_dk'])){
			if( email_exists($_POST['email_reg']) ) {
				$return = array('status'=>'danger','text'=>'Email đã tồn tại!');
			} else {
				//check user login exist
				$username_reg = $_POST['email_reg'];

				if (username_exists( $username_reg )) {
					$return = array('status'=>'danger','text'=>'User này đã tồn tại!');
				} else {
					//check password
					if ( $_POST['password_confirm'] != $_POST['password_reg']) {
						$return = array('status'=>'danger','text'=>'Mật khẩu không trùng khớp!');
					} else {						
						$userdata = array(
							'user_login' =>  $username_reg,
							'user_url'   =>  get_bloginfo('url'),
							'user_pass'  =>  sanitize_text_field($_POST['password_reg']),
							'display_name' => sanitize_text_field($_POST['fullname']),
							'user_email' => sanitize_text_field($_POST['email_reg']),
						);
						$user_id = wp_insert_user( $userdata );

						//generate activation
						$salt = wp_generate_password(20);
						$code = sha1($salt . $user_id . uniqid(time(), true));
						$activation_link = add_query_arg( array( 'key' => $code, 'user' => $user_id ), get_permalink( 1228 ));
						add_user_meta( $user_id, 'has_to_be_activated', $code, true );
						wp_mail( $_POST['email_reg'], 'ACTIVATION SUBJECT', 'CONGRATS BLA BLA BLA. HERE IS YOUR ACTIVATION LINK: ' . $activation_link );
						
						$data_user = array( 
							'user_id' => $user_id,
							'full_name' => sanitize_text_field($_POST['fullname']),
							'phone' => sanitize_text_field($_POST['phone']), 
							// 'address' => sanitize_text_field($_POST['address']),
							// 'gender' => sanitize_text_field($_POST['gender']),
							// 'province_id' => $_POST['province_id'],
							// 'district_id' => $_POST['district_id'],
							// 'ward_id' => $_POST['ward_id'],
						);
						$wpdb->insert($wpdb->prefix.'customer', $data_user);
						$creds = array();
						$creds['user_login'] = $username_reg;
						$creds['user_password'] = $_POST['password_reg'];
						$creds['remember'] = true;
						$user = wp_signon($creds, false);
						if (!is_wp_error($user)) {
							$show = false;
							$return= array('status'=>'success','text'=>'Đăng ký thành công! Vui lòng chờ giây lát...');
						?>
							<script>
								setTimeout(function(){
									window.location.replace("<?php echo bloginfo('url'); ?>");	
								}, 2000);
							</script>
						<?php 							
						}
					}
				}
			}					
		}
	?>

	<?php if($return != null) { ?>
		<div class="alert alert-<?=$return['status']?> mb-4">
			<?=$return['text']; $return = null; ?>
		</div>
	<?php } ?>

	<article class="card-body mx-auto" style="max-width: 400px;">
		<h4 class="card-title mt-3 text-center">Create Account</h4>
		<p class="text-center">Get started with your free account</p>
		<p>
			<a href="" class="btn btn-block btn-twitter"> <i class="fab fa-twitter"></i> &nbsp; Login via Twitter</a>
			<a href="" class="btn btn-block btn-facebook"> <i class="fab fa-facebook-f"></i> &nbsp; Login via facebook</a>
		</p>
		<p class="divider-text">
			<span class="bg-light">OR</span>
		</p>
		<form method="post" >

			<div class="form-group input-group">
				<div class="input-group-prepend">
					<span class="input-group-text"> <i class="fa fa-user"></i> </span>
				</div>
				<input name="fullname" class="form-control" placeholder="Full name" type="text">
			</div> <!-- form-group// -->

			<div class="form-group input-group">
				<div class="input-group-prepend">
					<span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
				</div>
				<input name="email_reg" class="form-control" placeholder="Email address" type="email">
			</div> <!-- form-group// -->

			<div class="form-group input-group">
				<div class="input-group-prepend">
					<span class="input-group-text"> <i class="fa fa-phone"></i> </span>
				</div>
				<input name="phone" class="form-control" placeholder="Phone Number" type="text">
			</div> <!-- form-group// -->

			<!-- <div class="form-group">
				<select class="form-control" name="gender">
					<option selected=""> Select gender type</option>
					<option value="1" >Nam</option>
					<option value="0" >Nữ</option>
				</select>
			</div>  -->
			<!-- form-group end.// -->

			<!-- <div class="form-group input-group">
				<div class="input-group-prepend">
					<span class="input-group-text"> <i class="fas fa-map-marker-alt"></i> </span>
				</div>
				<input name="address" class="form-control" placeholder="Address" type="text">
			</div>  -->
			<!-- form-group// -->


			<!-- <div class="form-group">
				<select class="form-control" name="province_id" id="tmtProvince" >
					<option selected=""> Select City</option>
					<?php foreach( $province as $item ) : ?>
						<option value="<?=$item->province_id?>"> <?=$item->province_name?></option>
					<?php endforeach; ?>
				</select>
			</div>  -->
			<!-- form-group end.// -->

			<!-- <div class="form-group">
				<select class="form-control" name="district_id" id="tmtDistrict">
					<option selected=""> Select District</option>
				</select>
			</div>  -->
			<!-- form-group end.// -->

			<!-- <div class="form-group">
				<select class="form-control" name="ward_id" id="tmtWard">
					<option selected=""> Select Ward</option>
				</select>
			</div>  -->
			<!-- form-group end.// -->

			<!--login info-->
			<div class="form-group input-group">
				<div class="input-group-prepend">
					<span class="input-group-text"> <i class="fa fa-lock"></i> </span>
				</div>
				<input class="form-control" name="password_reg" placeholder="Create password" type="password">
			</div> <!-- form-group// -->
			<div class="form-group input-group">
				<div class="input-group-prepend">
					<span class="input-group-text"> <i class="fa fa-lock"></i> </span>
				</div>
				<input class="form-control" name="password_confirm" placeholder="Repeat password" type="password">
			</div> <!-- form-group// -->     

			<div class="form-group">
				<button type="submit" name="submit_dk" class="btn btn-primary btn-block"> Create Account  </button>
			</div> <!-- form-group// -->      
			<p class="text-center">Have an account? <a href="">Log In</a> </p>                                                                 
		</form>
	</article>
</div>

<?php }  ?>

<script type="text/javascript">
$(document).ready(function() {
    //get district
	$('#tmtProvince').on('change', function() {
        var ajxUrl = '<?php echo admin_url( 'admin-ajax.php' ) ?>';
        $.ajax({
            data: {
                action: 'get_district',
                province_id: $('#tmtProvince').val(),
            },
            type: 'post',
            url: ajxUrl,
            dataType: "json",
            success: function(response) {
                $('#tmtDistrict').find('option')
                    .remove();
                $.each(response.data,function(index, item)
                { console.log(item);
                    $("#tmtDistrict").append('<option value=' + item.district_id + '>' + item.type_name + ' ' + item.district_name + '</option>');
                });
            }
        });
	});

	//get wards
    $('#tmtDistrict').on('change', function() {
        var ajxUrl = '<?php echo admin_url( 'admin-ajax.php' ) ?>';
        $.ajax({
            data: {
                action: 'get_ward',
                district_id: $('#tmtDistrict').val(),
            },
            type: 'post',
            url: ajxUrl,
            dataType: "json",
            success: function(response) {
                $('#tmtWard').find('option')
                    .remove();
                $.each(response.data,function(index, item)
                {
                    $("#tmtWard").append('<option value=' + item.ward_id + '>' + item.type_name + ' ' + item.ward_name + '</option>');
                });
            }
        });
    });

});
</script>