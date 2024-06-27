<?php
/**
 * Plugin Name: Commerce CMS
 * Plugin URI:
 * Description: Dedicated customers admin page with customer sales information.
 * Version: 1.0.0 
 * Author: SHUT
 * Author URI: https://minou.vn/
 *
 * Text Domain: commerce-cms
 *
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

define( 'CCMS_ABSPATH', dirname( __FILE__ ) . '/' );
 

// Enable Languages
function ccms_load_plugin_textdomain() {
	$domain = 'commerce-cms';
	$locale = apply_filters( 'plugin_locale', get_locale(), $domain );
	// wp-content/plugins/plugin-name/languages/plugin-name-de_DE.mo
	load_plugin_textdomain( $domain, FALSE, basename( dirname( __FILE__ ) ) . '/languages/' );
}
add_action( 'init', 'ccms_load_plugin_textdomain' );
// END Enable Languages

function ccms_enqueue_backend_script() {
        wp_register_script( 'ccms_backend_script', plugin_dir_url( __FILE__ ) . 'js/ajax-load.js', false, '1.0.0' );
		wp_enqueue_script( 'ccms_backend_script' );
}
add_action( 'admin_enqueue_scripts', 'ccms_enqueue_backend_script' );


/*add_action( 'init', 'prefix_nearme_rewrite_rule' );
function prefix_nearme_rewrite_rule() {
    add_rewrite_rule( 'user/([^/]+)/', 'index.php?tab=$matches[1]', 'top' );
    add_rewrite_rule( 'booking/([^/]+)/', 'index.php?step=$matches[1]', 'top' );
}
 
// Rewrite Template
add_action( 'template_redirect', 'prefix_url_rewrite_templates' );
function prefix_url_rewrite_templates() {

    if ( get_query_var( 'step' ) && is_singular( 'booking' ) ) {
        add_filter( 'template_include', function() {
            return get_template_directory() . '/pages/page-booking.php';
        });
    }
	if ( get_query_var( 'tab' ) && is_singular( 'user' ) ) {
        add_filter( 'template_include', function() {
            return get_template_directory() . '/pages/page-user.php';
        });
    }

}*/

// Add CCMS settings link
function ccms_add_settings_link( $links ) {
    $settings_link = '<a href="admin.php?page=ccms-settings&tab=settings_tab_ccms">' . __( 'Settings' ) . '</a>';
    array_push( $links, $settings_link );
  	return $links;
}
$plugin = plugin_basename( __FILE__ ); 
 
// DEV INVERONMENT
if ( ! function_exists( 'load_step_booking' ) ) {
    if(PROD ===  'dev')
	   require_once dirname( __FILE__ ) . '/api/dev/functions.php';
    else
        require_once dirname( __FILE__ ) . '/api/functions.php';
}

require_once dirname( __FILE__ ) . '/api/api.php';

/*if ( ! class_exists( 'CookieBooking' ) ) {
	require_once dirname( __FILE__ ) . '/api/CookieBooking.php';
}*/
 
// Include the CCMS_PROVINCE class
if ( ! class_exists( 'CCMS_PROVINCE' ) ) {
	require_once dirname( __FILE__ ) . '/includes/class-ccms-province.php';
}

if ( ! class_exists( 'CCMS_CUSTOMER' ) ) {
	require_once dirname( __FILE__ ) . '/includes/class-ccms-customer.php';
}
//if ( ! class_exists( 'CCMS_CUSTOMER_ADDRESS' ) ) {
//	require_once dirname( __FILE__ ) . '/includes/class-ccms-customer-list.php';
//}
if ( ! class_exists( 'CCMS_ORDER' ) ) {
	require_once dirname( __FILE__ ) . '/includes/class-ccms-order.php';
}

if ( ! class_exists( 'CCMS_ORDER_DETAILS' ) ) {
	require_once dirname( __FILE__ ) . '/includes/class-ccms-order_details.php';
}

if ( ! function_exists( 'ymh_add_every_three_minutes' ) ) {
	require_once dirname( __FILE__ ) . '/api/autorun_api.php';
}

if ( ! class_exists( 'ORDER' ) ) {
    require_once dirname( __FILE__ ) . '/api/Order.php';
}

if ( ! class_exists( 'SF_ORDER' ) ) {
    require_once dirname( __FILE__ ) . '/api/sf_Orders.php';
}

if ( ! class_exists( 'SF_API' ) ) {
    require_once dirname( __FILE__ ) . '/api/sf_api.php';
}

//CookieBooking::init(); 

// Add 'Customers' page to admin menu
add_action( 'admin_menu', 'ccms_admin_menu' );

function ccms_admin_menu() {
	
	$menu_slug = 'commerce_cms';
	$page_title = __( 'Commerce Management', 'commerce-cms' );
	$menu_title = __( 'Commerce CMS', 'commerce-cms' );
	$capability = 'manage_options';
	
	add_menu_page(
        $page_title,
        $menu_title,
        $capability,
        'commerce_cms',
        'ccms_list_customers_admin',
        'dashicons-cart',
        58  );
	
	 	$menu_title = __( 'Customers', 'commerce-cms' );
	 	add_submenu_page( $menu_slug, $menu_title, $menu_title, $capability, 'ccms_customers', 'ccms_list_customers_admin', 'dashicons-groups' );
		$menu_title = __( 'Orders', 'commerce-cms' );
		add_submenu_page( $menu_slug, $menu_title, $menu_title, $capability, 'ccms_orders', 'ccms_list_orders_admin', 'dashicons-cart' );
		$menu_title = __( 'Settings', 'commerce-cms' );
		add_submenu_page( $menu_slug, $menu_title, $menu_title, $capability, 'ccms_setings', 'ccms_settings_admin', 'dashicons-admin-generic'  );

}

function ccms_list_customers_admin() {
    require_once( CCMS_ABSPATH.'/pages/list-customers-admin.php' );
}

function ccms_list_orders_admin() {
    //require_once( CCMS_ABSPATH.'/pages/list-customers-admin.php' );
	esc_html_e( 'List orders Admin', 'commerce-cms' ); 
}

function ccms_settings_admin() {
    //require_once( CCMS_ABSPATH.'/pages/list-customers-admin.php' );
	esc_html_e( 'CCMS Settings Admin', 'commerce-cms' ); 
}

// Settings Tab within WC Settings
class CCMS_Settings_Tab {

    public static function init() {
        add_filter( 'commerce_cms_settings_tabs_array', __CLASS__ . '::add_settings_tab', 50 );
        add_action( 'commerce_cms_settings_tabs_settings_tab_ccms', __CLASS__ . '::settings_tab' );
        add_action( 'commerce_cms_update_options_settings_tab_ccms', __CLASS__ . '::update_settings' );
    }

    public static function add_settings_tab( $settings_tabs ) {
        $settings_tabs['settings_tab_ccms'] = __( 'Customer List', 'commerce-cms' );
        return $settings_tabs;
    }

    public static function settings_tab() {
        commerce_cms_admin_fields( self::get_settings() );
    }

    public static function update_settings() {
        commerce_cms_update_options( self::get_settings() );
    }

    public static function get_settings() {
        $settings = array(
            'general_section' => array(
                'name'     => __( 'General Settings', 'commerce-cms' ),
                'type'     => 'title',
                'desc'     => '',
                'id'       => 'CCMS_Settings_Tab_general_section'
            ),
            'cus_status' => array(
                'name' => __( 'Customer Activity Period (Days)', 'commerce-cms' ),
                'type' => 'number',
                'desc' => __( 'days. This is the period for which the customer is assumed Active and becomes Inactive thereafter. Defaults to 31 days if left blank.', 'commerce-cms' ),
                'id'   => 'CCMS_Settings_Tab_cus_status'
            ),
            'general_end' => array(
                 'type' => 'sectionend',
                 'id' => 'CCMS_Settings_Tab_general_end'
            )
        );
        return apply_filters( 'CCMS_Settings_Tab_settings', $settings );
    }
}
CCMS_Settings_Tab::init();
// END CCMS Settings Tab within WC Settings

// CCMS ajax calculations
add_action( 'admin_enqueue_scripts', 'CCMS_ajax_enqueue' );
function CCMS_ajax_enqueue($hook) {
	wp_enqueue_script( 'ccms-ajax-script', plugins_url( '/js/ajax-load.js', __FILE__ ), array('jquery') );

	wp_localize_script( 'ccms-ajax-script', 'ccms_ajax_object',
    array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
}

add_action( 'wp_ajax_ccms_caluot', 'ccms_caluot' );
function ccms_caluot() {
	global $wpdb;
		if (isset($_POST['customer_id']) && !empty($_POST['customer_id']) && is_numeric($_POST['customer_id'])) {
			$userid = $_POST['customer_id'];
			echo esc_html( __( ccms_get_customer_order_count($userid), 'commerce-cms' ) );
			wp_die();
		} else {
			echo esc_html( __( 'Error: No User ID', 'commerce-cms' ) );
			wp_die();
		}
}

add_action( 'wp_ajax_ccms_caluos', 'ccms_caluos' );
function ccms_caluos() {
	global $wpdb;
	if (isset($_POST['customer_id']) && !empty($_POST['customer_id']) && is_numeric($_POST['customer_id'])) {
		$userid = $_POST['customer_id'];
		echo esc_html( __( get_commerce_cms_currency_symbol().''.wc_get_customer_total_spent($userid), 'commerce-cms' ) );
		wp_die();
	} else {
		echo esc_html( __( 'Error: No User ID', 'commerce-cms' ) );
		wp_die();
	}
}
// END ajax calculations
