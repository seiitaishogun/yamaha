<?php
/** 
 * @category Users
 * @package  Customer List  
 * @since    1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class CCMS_CUSTOMER_ADDRESS extends CCMS_CUSTOMER {

    public $cusid;
	
	public function update_customer_address( $postarr, $wp_error = false){
		
		global $wpdb;

		// Capture original pre-sanitized array for passing into filters.
		$unsanitized_postarr = $postarr;

		$user_id = get_current_user_id();

		$defaults = array(
			'ID' 			=> '',
			'customer_id'	=> '',
			'title'			=> '',
			'full_name' 	=> '',
			'phone'         => '',
			'email'         => '',
			'address'       => '',
			'default'       => '0',
			'province_id'           => '',
			'district_id'         => '',
			'ward_id'               => '',
			/*'import_id'             => 0,
			'context'               => '',
			'post_date'             => '',
			'post_date_gmt'         => '',*/

			);

		$postarr = wp_parse_args( $postarr, $defaults );

		unset( $postarr['filter'] );

		$postarr = sanitize_post( $postarr, 'db' );

		// Are we updating or creating?
		$add_ID = 0;
		$update  = false;
		//$guid    = $postarr['guid'];

		if ( ! empty( $postarr['ID'] ) ) {
			$update = true;
		}

			// Get the ID and GUID.
			$add_ID     = $postarr['ID']; 

			if ( is_null( $add_ID ) ) {
				if ( $wp_error ) {
					return new WP_Error('Chưa có dữ liệu khách hàng.');
				}
				return 0;
			}
			
			/* 
8cG!Ue6w3mF!YMx */
 
 
		$post_date = wp_resolve_post_date( $postarr['post_date'], $postarr['post_date_gmt'] );
		if ( ! $post_date ) {
			if ( $wp_error ) {
				return new WP_Error( 'invalid_date', __( 'Invalid date.' ) );
			} else {
				return 0;
			}
		}

		if ( empty( $postarr['post_date_gmt'] ) || '0000-00-00 00:00:00' === $postarr['post_date_gmt'] ) {
			if ( ! in_array( $post_status, get_post_stati( array( 'date_floating' => true ) ), true ) ) {
				$post_date_gmt = get_gmt_from_date( $post_date );
			} else {
				$post_date_gmt = '0000-00-00 00:00:00';
			}
		} else {
			$post_date_gmt = $postarr['post_date_gmt'];
		}

		if ( $update || '0000-00-00 00:00:00' === $post_date ) {
			$post_modified     = current_time( 'mysql' );
			$post_modified_gmt = current_time( 'mysql', 1 );
		} else {
			$post_modified     = $post_date;
			$post_modified_gmt = $post_date_gmt;
		}


		$post_name = wp_unique_post_slug( $post_name, $post_ID, $post_status, $post_type, $post_parent );

		// Don't unslash.
		$post_mime_type = isset( $postarr['post_mime_type'] ) ? $postarr['post_mime_type'] : '';

		// Expected_slashed (everything!).
		$data = compact( 'post_author', 'post_date', 'post_date_gmt', 'post_content', 'post_content_filtered', 'post_title', 'post_excerpt', 'post_status', 'post_type', 'comment_status', 'ping_status', 'post_password', 'post_name', 'to_ping', 'pinged', 'post_modified', 'post_modified_gmt', 'post_parent', 'menu_order', 'post_mime_type', 'guid' );

		$emoji_fields = array( 'post_title', 'post_content', 'post_excerpt' );

		foreach ( $emoji_fields as $emoji_field ) {
			if ( isset( $data[ $emoji_field ] ) ) {
				$charset = $wpdb->get_col_charset( $wpdb->posts, $emoji_field );

				if ( 'utf8' === $charset ) {
					$data[ $emoji_field ] = wp_encode_emoji( $data[ $emoji_field ] );
				}
			}
		}
 
 
		return $add_ID;
	  
	}

    public function __construct($userid)
    {
        $this->cusid = $userid;
    }

    public function ccms_get_customer_status($lastorderdate)
    {
        $settingscusstatus = get_option( 'CCMS_Settings_Tab_cus_status', '31' );

        $dt = $lastorderdate;
        $date = new DateTime($dt);
        $now = new DateTime();
        $diff = $now->diff($date);

        if($diff->days < $settingscusstatus) {
            return __('Active', 'ccms-customer-list' );
        } else {
            return __('Inactive', 'ccms-customer-list' );
        }
    }

    public function ccms_get_order_average($firstorderdate, $lastorderdate, $totalcusorders)
    {
        if (!empty($firstorderdate) && !empty($lastorderdate)) {

            $date1 = new DateTime($firstorderdate);
            $date2 = new DateTime($lastorderdate);

            $diff = $date2->diff($date1)->format("%a");
        } else {
            $diff = 0;
        }

        if ($diff > 0) {
            $countco = $totalcusorders - 1;
						update_user_meta($this->cusid, 'customer_average', round($diff / $countco));
            return __('Every '.round($diff / $countco).' days', 'ccms-customer-list' );
        } else {
						update_user_meta($this->cusid, 'customer_average', 0);
            return __('No Average', 'ccms-customer-list' );
        }
    }

}
