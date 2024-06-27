<?php
/**
 * @author tmtuan
 * created Date: 11/29/2021
 * project: yamaha-revzone-website
 */


/**
 * get district
 */

add_action( 'wp_ajax_get_district', 'tmt_get_district' );
add_action('wp_ajax_nopriv_get_district', 'tmt_get_district');

function tmt_get_district() {
    global $wpdb;
    $dataTable = $wpdb->prefix.'districts';

    $district = $wpdb->get_results ( "SELECT id, district_id, district_name, province_id, type_name FROM $dataTable WHERE province_id = {$_POST['province_id']}");

    wp_send_json_success($district);
}

/**
 * get Ward
 */
add_action( 'wp_ajax_get_ward', 'tmt_get_ward' );
add_action('wp_ajax_nopriv_get_ward', 'tmt_get_ward');

function tmt_get_ward() {
    global $wpdb;
    $dataTable = $wpdb->prefix.'wards';

    $wards = $wpdb->get_results ( "SELECT id, ward_id, district_id, ward_name, type_name FROM $dataTable WHERE district_id = {$_POST['district_id']}");

    wp_send_json_success($wards);
}