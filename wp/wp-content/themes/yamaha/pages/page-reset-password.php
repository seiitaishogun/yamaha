<?php
/**
 * @author tmtuan
 * created Date: 12/09/2021
 * project: yamaha-revzone-website
 *
 * Template Name: Reset Password
 *
 */


if (is_user_logged_in()) { 
    wp_redirect(get_bloginfo('home'));
    exit;
}
if (!session_id()) {
    session_start();
}
