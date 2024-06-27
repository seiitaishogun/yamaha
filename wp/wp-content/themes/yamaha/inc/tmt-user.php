<?php
/**
 * @author tmtuan
 * created Date: 12/3/2021
 * project: yamaha-revzone-website
 */

/**
 * Restrict Admin
 */
function restrict_admin(){
    if(!current_user_can('administrator') && !defined('DOING_AJAX') )  {
         wp_redirect(get_bloginfo('home'));
         exit;
     }
 }
 add_action( 'admin_init', 'restrict_admin', 1 );

/**
 * Create new WP user  
 */ 
function createUser($data = null, $profile = 'facebook') {
    if ( empty($data) ) return false;
    global $wpdb;

    require_once( ABSPATH . WPINC . '/registration.php');

    $userdata = array(
        'user_login' =>  $data['email'],
        'user_url'   =>  get_bloginfo('url'),
        'user_pass'  =>  sanitize_text_field($data['id']),
        'display_name' => sanitize_text_field($data['name']),
        'user_email' => sanitize_text_field($data['email']),
    );
    $user_id = wp_insert_user( $userdata );

    if ( $profile == 'facebook' ) {
        $data_user_profile = array(
            'user_id' => $user_id,
            'full_name' => sanitize_text_field($data['name']),
            'fb_id' => sanitize_text_field($data['id']),
            'fb_access_token' => sanitize_text_field($data['access_token']),
        );
    } elseif ( $profile == 'google' ) {
        $data_user_profile = array(
            'user_id' => $user_id,
            'full_name' => sanitize_text_field($data['name']),
            'gg_id' => sanitize_text_field($data['id']),
            'gg_access_token' => sanitize_text_field($data['access_token']),
        );
    } else {
        $data_user_profile = array(
            'user_id' => $user_id,
            'full_name' => sanitize_text_field($data['name']),
        );
    }


    
    $wpdb->insert($wpdb->prefix.'customer', $data_user_profile);
    $user = get_user_by('ID', $user_id);
    return $user;
}

/**
 * Check user exist with FB id
 */
function fb_login_user($fb_data)
{
    global $wpdb;
    $table = $wpdb->prefix . 'customer';
    $user_profile = $wpdb->get_row("SELECT * FROM $table WHERE fb_id = {$fb_data['id']}");
    if (isset($user_profile->id)) {
        $user = get_user_by('ID', $user_profile->user_id);

        $wpdb->query( "UPDATE {$table} SET fb_access_token = {$fb_data['access_token']} WHERE user_id = {$user_profile->user_id} " );

        //login
        wp_set_current_user($user->ID, 'guest');
        wp_set_auth_cookie($user->ID);
        do_action('wp_login', 'guest');
        return true;
    } else {
        if (email_exists($fb_data['email'])) {
            $user = get_user_by('user_email', $fb_data['email']);

            //login
            wp_set_current_user($user->ID, 'guest');
            wp_set_auth_cookie($user->ID);
            do_action('wp_login', 'guest');
            return true;
        } else {
            $user = createUser($fb_data, 'facebook');

            if ( $user ) {
                //login
                wp_set_current_user($user->ID, 'guest');
                wp_set_auth_cookie($user->ID);
                do_action('wp_login', 'guest');
                return true;
            }
        }
    }
}

function gg_login_user($gg_data) {
    global $wpdb;
    $table = $wpdb->prefix . 'customer';
    $user_profile = $wpdb->get_row("SELECT * FROM $table WHERE gg_id = {$gg_data['id']}");
    if (isset($user_profile->id)) {
        $user = get_user_by('ID', $user_profile->user_id);

        $wpdb->query( "UPDATE {$table} SET gg_access_token = {$gg_data['access_token']} WHERE user_id = {$user_profile->user_id} " );

        //login
        wp_set_current_user($user->ID, 'guest');
        wp_set_auth_cookie($user->ID);
        do_action('wp_login', 'guest');
        return true;
    } else {
        if (email_exists($gg_data['email'])) {
            $user = get_user_by('user_email', $gg_data['email']);

            // $user_profile = $wpdb->get_row("SELECT * FROM $table WHERE user_id = {$user->ID} AND gg_id = '{$gg_data['id']}' ");

            // if ( empty($user_profile->gg_id) || $user_profile->gg_id == '' ) {
            //     $wpdb->query( "UPDATE {$table} SET gg_id = {$gg_data['id']}, gg_access_token = '{$gg_data['access_token']}' WHERE user_id = {$user->ID} " );
            // }

            //login
            wp_set_current_user($user->ID, 'guest');
            wp_set_auth_cookie($user->ID);
            do_action('wp_login', 'guest');
            return true;
        } else {
            $user = createUser($gg_data, 'google');

            if ( $user ) {
                //login
                wp_set_current_user($user->ID, 'guest');
                wp_set_auth_cookie($user->ID);
                do_action('wp_login', 'guest');
                return true;
            }
        }
    }
}