<?php
/**
* @author tmtuan
* created Date: 12/03/2021
* project: yamaha-revzone-website
* Template Name: Google Login
*
*/

/**
 * get Google Login
 */
if (!session_id()) {
    session_start();
}

require_once ABSPATH . 'vendor/Google/vendor/autoload.php'; // change path as needed

$client_id = '553440750000-8r4bhhqo7i550c0cqsmtrahei5pienfb.apps.googleusercontent.com';
$client_secret = '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';
$redirect_uri = site_url('google-login');

$client = new Google_Client();
$client->setClientId($client_id);
$client->setClientSecret($client_secret);
$client->setRedirectUri($redirect_uri);
$client->setScopes(array(
        "https://www.googleapis.com/auth/userinfo.profile"
    )
);
$client->setScopes(Google_Service_Gmail::GMAIL_READONLY);
$client->setPrompt('select_account consent');

// Send Client Request
$objOAuthService = new Google_Service_Oauth2($client);
$code = $_GET['code'];

// Add Access Token to Session
$access_token = '';
if (isset($code) ) {
    $client->authenticate($code);
    $access_token = $client->getAccessToken();
    if (isset($access_token) && $access_token) {
        $q = 'https://www.googleapis.com/oauth2/v1/userinfo?access_token='.$access_token['access_token'];
        $json = file_get_contents($q);
        $userInfo = json_decode($json,true);
        $userInfo['access_token'] = $access_token['access_token'];
        
        //Log user in
        $login = gg_login_user($userInfo);

        if($login) wp_redirect(home_url());
        else {
            $_SESSION['err_msg'] = 'Error! Please try to login again';
            wp_redirect(site_url('dang-nhap'));
        }
    }

} else {
    // When auth fails 
    $_SESSION['err_msg'] = 'Access deny';
    wp_redirect(site_url('dang-nhap'));
}
