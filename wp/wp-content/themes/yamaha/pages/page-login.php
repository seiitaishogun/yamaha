<?php
/**
* @author tmtuan
* created Date: 11/30/2021
* project: yamaha-revzone-website
* Template Name: DangNhap
*
*/

if (!session_id()) {
    session_start();
}

if (is_user_logged_in()) { 
	wp_redirect(get_bloginfo('home')); 
	exit;
} else {
	$show = true;

	/**
	 * get FB Login
	 */

	require_once ABSPATH . '/vendor/Facebook/autoload.php'; // change path as needed

	$fb = new \Facebook\Facebook([
	'app_id' => '1082479382583121',
	'app_secret' => '0b8fd528077d17e14f751973d1a09ab3',
	'default_graph_version' => 'v5.0',
	//'default_access_token' => '{access-token}', // optional
	]);

	$helper = $fb->getRedirectLoginHelper();

	$permissions = ['public_profile', 'email']; // Optional permissions
	$loginUrl = $helper->getLoginUrl('https://ymh.thuthuat247.com/facebook-login/', $permissions);

    /**
     * get Google Login
     */
    require_once ABSPATH . 'vendor/Google/vendor/autoload.php'; // change path as needed

    $client_id = '553440750000-8r4bhhqo7i550c0cqsmtrahei5pienfb.apps.googleusercontent.com';
    $client_secret = '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';
    $redirect_uri = site_url('google-login');

    $client = new Google\Client();

    $client->setClientId($client_id);
    $client->setClientSecret($client_secret);
    $client->setRedirectUri($redirect_uri);
    $client->setScopes(array(
            "https://www.googleapis.com/auth/plus.login",
            "https://www.googleapis.com/auth/plus.me",
            "https://www.googleapis.com/auth/userinfo.email",
            "https://www.googleapis.com/auth/userinfo.profile"
        )
    );
    $client->setPrompt('select_account consent');

    $ggLoginUrl = $client->createAuthUrl();
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
    
	<!-- jQuery -->
    <script src="<?php bloginfo('template_url'); ?>/js/vendor/jquery-3.5.1.min.js"></script>

</head>
  
<body class="login">


<div>
      
	<div class="login_wrapper" style="margin-left: auto; margin-right:auto; width: 500px;">
		<div class="animate form login_form justify-content-center">
			<section class="login_content" >
				<?php 
				if( isset($_POST['submit_dn']) ) {
					$username = $_POST['username'];				
					if ( !empty( $username ) ) {

						if(strpos($username, '@') == TRUE) {
							$user_info = get_user_by( 'email', $username );
							if ( isset( $user_info->user_login, $user_info ) ) {
								$username = $user_info->user_login;
							}
						}

						$creds = array();
						$creds['user_login'] = $username;
						$creds['user_password'] = $_POST['password'];
						$creds['remember'] = true;
						//$user = wp_signon( $creds, false );

						$user = apply_filters('authenticate', null, $username, $_POST['password']);
						
						if ( $user == null ) {
							$return['text'] =  'Invalid username or incorrect password.'; 
							$return['status'] = 'danger';
							$user = new WP_Error('activation_failed', __('Invalid username or incorrect password'));
						} elseif ( get_user_meta( $user->ID, 'has_to_be_activated', true ) != false ) {
							$return['text'] =  'Vui lòng kích hoạt tài khoản trước khi đăng nhập'; 
							$return['status'] = 'danger';
							$user = new WP_Error('activation_failed', __('User is not activated.'));
						} 

						if (is_wp_error($user)){
							do_action('wp_login_failed', $username);
							$return['text'] =  $user->get_error_message(); 
							$return['status'] = 'danger';
							
						} else {
							wp_set_auth_cookie($user->ID);
							do_action('wp_login', 'guest');
							$show = false;
							?>
							<div class="alert alert-success mb-4">Đăng nhập thành công1</div>
							<script>
								setTimeout(function(){
									window.location.replace("<?php echo get_bloginfo('home'); ?>");	
								}, 1000);
							</script>
						<?php 
						}
					} 
					
					
				} ?>

                <?php
                    if (isset($_SESSION['err_msg'])) :
                        $err = $_SESSION['err_msg'];
                        unset($_SESSION['err_msg']);
                ?>
                    <div class="alert alert-danger mb-4">
                        <?=$err ?>
                    </div>
                <?php endif; ?>

                <?php if( isset($return) && $return != null) { ?>
				<div class="alert alert-<?=$return['status']?> mb-4">
					<?=$return['text']; $return = null; ?>
				</div>
				<?php } ?>
				<?php if($show) { ?>
				<form id="login_form" method="post">
					<h1>Đăng nhập</h1>
					<div class="form-group">
						<input type="text" name="username" class="form-control" placeholder="Email" required="" />
					</div>
					<div class="form-group">
						<input type="password" name="password" class="form-control" placeholder="Password" required="" />
					</div>
					
					<div class="row text-center">
						<div class="col-md-6 col-xs-6">
							<a href="#signup"  class="btn btn-danger form-control"> Đăng ký </a>
						</div>
						
						<div class="col-md-6 col-xs-6">
							<input class="btn btn-success" type="submit" name="submit_dn" value="Đăng Nhập">
						</div>				
					</div>

					<div class="clearfix"></div>

					<div class="separator text-center">
						<p class="change_link">
							<a href="<?php echo wp_lostpassword_url(get_bloginfo('home')) ?>" class="to_register"> Quên mật khẩu </a>
						</p>
						<p class="change_link">
							<a href="<?php echo $loginUrl ?>" class="to_register"> Login bằng Facebook </a>
						</p>
                        <p class="change_link">
							<a href="<?php echo $ggLoginUrl ?>" class="to_register"> Login bằng Google </a>
						</p>
						<div class="clearfix"></div>
						
					</div>
				</form>
				<?php } ?>
			</section>
        </div>		
		
		
	</div>
</div>

</body>
</html>
<?php }  ?>