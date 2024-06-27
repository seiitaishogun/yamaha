<?php
/**
* @author tmtuan
* created Date: 12/03/2021
* project: yamaha-revzone-website
* Template Name: Facebook Login
*
*/

/**
 * get FB Login
 */
if (!session_id()) {
    session_start();
}

require_once ABSPATH . '/vendor/Facebook/autoload.php'; // change path as needed

$fb = new \Facebook\Facebook([
'app_id' => '1082479382583121',
'app_secret' => '0b8fd528077d17e14f751973d1a09ab3',
'default_graph_version' => 'v5.0',
//'default_access_token' => '{access-token}', // optional
]);

$helper = $fb->getRedirectLoginHelper();

try {
    $accessToken = $helper->getAccessToken();
} catch(Facebook\Exceptions\FacebookResponseException $e) {
    // When Graph returns an error
    $_SESSION['err_msg'] = 'Graph returned an error: ' . $e->getMessage();
    wp_redirect(site_url('dang-nhap'));
} catch(Facebook\Exceptions\FacebookSDKException $e) {
    // When validation fails or other local issues
    $_SESSION['err_msg'] = 'Facebook SDK returned an error: ' . $e->getMessage();
    wp_redirect(site_url('dang-nhap'));
}

if ( !empty($accessToken) ) {

    try {
        // Returns a `Facebook\FacebookResponse` object
        $response = $fb->get('/me?fields=id,name,email,birthday,link,gender,locale,cover,picture,address', $accessToken->getValue());
    } catch (Facebook\Exceptions\FacebookResponseException $e) {
        $_SESSION['err_msg'] = 'Graph returned an error: ' . $e->getMessage();
        wp_redirect(site_url('dang-nhap'));
    } catch (Facebook\Exceptions\FacebookSDKException $e) {
        $_SESSION['err_msg'] = 'Facebook SDK returned an error: ' . $e->getMessage();
        wp_redirect(site_url('dang-nhap'));
    }

    $oauthInfo = $response->getGraphUser();
    $oauthInfo['access_token'] = $accessToken->getValue();

    $login = fb_login_user($oauthInfo);

    if($login) wp_redirect(home_url());
    else {
        $_SESSION['err_msg'] = 'Error! Please try to login again';
        wp_redirect(site_url('dang-nhap'));
    }

} else {
    $_SESSION['err_msg'] = 'Invalid token! Please try to login again';
    wp_redirect(site_url('dang-nhap'));
}