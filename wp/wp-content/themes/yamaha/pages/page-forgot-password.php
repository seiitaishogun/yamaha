<?php
/**
 * @author tmtuan
 * created Date: 12/09/2021
 * project: yamaha-revzone-website
 *
 * Template Name: Forgot Password
 *
 */


if (is_user_logged_in()) { 
    wp_redirect(get_bloginfo('home'));
    exit;
}
if (!session_id()) {
    session_start();
}

get_header();

if(isset($_POST['submit_reset'])){
    if ( empty($_POST['email']) || !email_exists($_POST['email']) ) {
        $return = array('status'=>'danger','text'=>'Email đã tồn tại!');
    } else {
        
    }
    
}
?>

<section class="forgot-pass">
    <div class="container">
        <div class="row">
            <div class="col-12">
            <form method="post" >
                <div class="form-group">
                    <input type="text" class="form-control" name="email" />
                </div>

                <div class="form-group">
                    <button type="button" name="submit_reset" class="btn-clip btn-red">Submit</button>
                </div>

            </form>
            </div>
        </div>
    </div>
</section>