<?php

if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit();
}

function ccms_delete() {
	delete_option( 'CCMS_Settings_Tab_cus_status' );
}

ccms_delete();
