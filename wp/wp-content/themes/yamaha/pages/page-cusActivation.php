<?php
/**
 * @author tmtuan
 * created Date: 12/07/2021
 * project: yamaha-revzone-website
 *
 * Template Name: Customer Activation
 *
 */


if (is_user_logged_in()) { 
    wp_redirect(get_bloginfo('home'));
    exit;
}
if (!session_id()) {
    session_start();
}

global $wpdb;
$table = $wpdb->prefix.'customer';

$user_id = filter_input( INPUT_GET, 'user', FILTER_VALIDATE_INT, array( 'options' => array( 'min_range' => 1 ) ) ); 
if ( $user_id ) {
    // get user meta activation hash field
    $code = get_user_meta( $user_id, 'has_to_be_activated', true );

    if ( !isset($code) || empty($code) ) {
        $_SESSION['err_msg'] = 'Invalid Activation code!';
        wp_redirect(site_url('dang-nhap'));
    }


    if ( $code == filter_input( INPUT_GET, 'key' ) ) {
        delete_user_meta( $user_id, 'has_to_be_activated' );
        $_SESSION['err_msg'] = 'Kích hoạt thành công! Vui lòng đăng nhập';
        wp_redirect(site_url('dang-nhap'));
    } else {
        $_SESSION['err_msg'] = 'Invalid Activation code!';
        wp_redirect(site_url('dang-nhap'));
    }
}
