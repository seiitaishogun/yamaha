<?php
/**
* Order Step Header
*
*/
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
global $arr_step_title, $wpdb, $current_user, $current_user_profile, $current_customer_address; 
?> 
<?php if($step < 4) : ?>
<div class="stepnav align-items-center" style="text-align: right;"> 
	<ol class="order_step align-items-center"> 
		<?php 
			for ($i = 0; $i<3 ; $i++ ){
				$class="step";
				if ($i==($step-1)) $class="step active";
				echo '<li class="'.$class.'"><a href="/booking/?step='.($i+1).'">'.$arr_step_title[$i].'</a></li>';	
			} 
		?>
	</ol>
</div> 
<style>ol.order_step {counter-reset: section;list-style-type: none;padding-left:0;margin-bottom: 0;}
ol.order_step li {counter-increment: section;font-weight:700; display: inline-flex; align-items: center; margin-right: 20px;}
ol.order_step li:last-child {margin-right: 0px;}
ol.order_step li:before {content: counters(section, " ") " "; font-size:1.2em; border:1px solid #666; background: #ECEBEB; padding:6px 14px; border-radius: 100%; height: 40px; width: 40px; align-items: center; margin-right: 10px;}
ol.order_step li.active, ol.order_step li.active:before{color: #DD0C0F;}
ol.order_step li.active:before {font-size:1.3em; border:1px solid #DD0C0F; background: #ECEBEB; padding:6px 14px; height: 42px; width: 42px; align-items: center; }	
ol.order_step li ol {padding-left:15px}
ol.order_step li ol li {margin:10px 0}
ul.order_step {list-style-type:lower-alpha}
ul.order_step li:before {content: ""}</style>

<?php endif ?>