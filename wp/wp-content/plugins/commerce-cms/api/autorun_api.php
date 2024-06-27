<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
} 

add_filter( 'cron_schedules', 'ymh_add_every_three_minutes' );
function ymh_add_every_three_minutes( $schedules ) {
    $schedules['every_three_minutes'] = array(
            'interval'  => 60*30 ,
            'display'   => __( 'Every 1 Minutes', 'textdomain' )
    );
    return $schedules;
}

// Schedule an action if it's not already scheduled
if ( ! wp_next_scheduled( 'ymh_add_every_three_minutes' ) ) {
    wp_schedule_event( time(), 'every_three_minutes', 'ymh_add_every_three_minutes' );
}

// Viet ham get API o day - sua trong hàm every_three_minutes_event_func()
// Hook into that action that'll fire every three minutes
add_action( 'ymh_add_every_three_minutes', 'every_three_minutes_event_func' );
function every_three_minutes_event_func() {
    //$content = "Viet ham get API o day - sua trong hàm every_three_minutes_event_func()";
   // $fp = fopen($_SERVER['DOCUMENT_ROOT'] . "/test_app/".time()."-test_app.txt","wb");
   // fwrite($fp,$content);
   // fclose($fp);

        $plugin_dir = ABSPATH . 'wp-content/plugins/commerce-cms/';     
        include_once($plugin_dir.'api/cron.php');               
        $Cron = new Cron();     
        $Cron->APICheckMcInventory();       
        $Cron->APICheckPCAInventory();       
}

function log_file_api() {
    $content = "Log API";
    $fp = fopen($_SERVER['DOCUMENT_ROOT'] . "/logs/get-apilog.txt","wb");
    fwrite($fp,$content);
    fclose($fp);
}