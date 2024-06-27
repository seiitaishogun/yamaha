<?php
/**
* ORDER FORM 
*
*/
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

global $wpdb; 

$step = 1;
if (isset($_REQUEST['step'])) $step = intval($_REQUEST['step']);

?>
<div class="wrap">
	<h1 class="wp-heading-inline"><?php _e('ĐẶT HÀNG', 'commerce-ccms' ); ?></h1>
	<?php include_once('order-form-header.php'); ?>
	<div class="order_form"> 
	<?php include_once('order-form-step_{$step}.php'); ?> 
	</div>
</div>