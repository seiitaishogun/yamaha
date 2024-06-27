<?php
/**
 * @author HUNG VO
 * created Date: 10/12/2021
 * project: yamaha-revzone-website
 *
 Template Name: Booking-List layout
Template Post Type: post, page, event
 *
 */

get_header();
 
global $wpdb;
$table = $wpdb->prefix.'customer'; 

$page_id = get_queried_object_id();
$step = 1;
if(isset($_REQUEST['step'])) $step = intval($_REQUEST['step']);
$arr_page_title = array('GIỎ HÀNG', 'THANH TOÁN', 'HOÀN TẤT');
$arr_step_title = array('GIỎ HÀNG', 'THANH TOÁN', 'HOÀN TẤT');

$breadcrumb = [
    "0" => [
        'name' => 'ĐẶT HÀNG / DANH SÁCH' ,
        'slug'   => 'booking/list',
        'active' => true,
    ]]; 
?> 
   
<?php echo  get_template_part('includes/header/header-breadcrumb', '', $breadcrumb);?>
<section class="cat-banner"  style="background: url(<?php echo get_template_directory_uri();?>/img/sweaters/banner.jpg) no-repeat ;
           background-size:cover; ">
    <div class="container-fluid"> 
            <picture>
                <source media="(min-width:768px)" srcset="<?php echo $banner; ?>">
                <img style="opacity: 0;" src="<?php echo get_template_directory_uri();?>/img/sweaters/banner.jpg" alt="" class="d-block w-100" />
            </picture>
            <div class="cat-banner__caption">
                <h1><?php echo 'ĐẶT HÀNG / DANH SÁCH'; ?></h1>
            </div>
    </div>
</section>
<section class="hot-items booking" id="next">
    <div class="container-fluid "> 
         
         <div class="box-shadow03rem" style="color: #171717">
               <?php load_order_list(); ?>
    	</div>
    </div>
</section>
 
 <style>.booking .h__drawer-list li {display: block;} 
	.box-shadow03rem { margin:20px auto  ;
	 padding:20px 20px;
	box-shadow: 0 0 0.3rem 1px rgba(0, 0, 0, 0.18);
	transform: translateY(0);
	transition: transform 0.25s ease-in-out, box-shadow 0.1s 0.25s linear;} 
	 
	 .box-shadow02rem { margin:10px auto  ;
	 padding:20px 20px;
	box-shadow: 0 0 0.1rem 1px rgba(0, 0, 0, 0.16);
	transform: translateY(0);
	transition: transform 0.25s ease-in-out, box-shadow 0.1s 0.25s linear;} 
	 .box-shadow01rem { margin:10px auto  ;
	 padding:20px 20px;
	box-shadow: 0 0 0.1rem 0px rgba(0, 0, 0, 0.14);
	transform: translateY(0);
	transition: transform 0.25s ease-in-out, box-shadow 0.1s 0.25s linear;} 
	 
	 .booking .h__drawer-list li:first-child {margin-top: 0px !important;} 
	 
	.booking .h__drawer-list li img { 
    min-width: 170px !important;}
	 div.item-cart-delete{display:grid; float: right;  text-align: center;}
	 a.item-cart-delete {border: 1px solid #EEE; padding: 4px 1px !important; height: 45px; width: 45px !important; box-shadow: 1px 0px 3px 0px #EEE; text-align: center; }
	 a.item-cart-delete i{max-width:  45px !important; }
@media (max-width:768px){
		 .banner-step{display: none;}
	.box-shadow02rem, .box-shadow01rem, .box-shadow03rem{padding: 0px;}
	.item-cart-detail-info, .item-cart-detail-price, .item-cart-detail-box{float: none; width: 100%; text-align: center ;}
	.item-cart-total-box >p{display: none;}
	 }
</style>
<script src="<?php echo get_template_directory_uri() ?>/js/my-work.js?v=<?php echo time(); ?>"></script>

<?php 
	//$ajax_action = 'remove_cookie_booking_item'; 
	//if(is_user_logged_in()) $ajax_action = 'update_order_booking'; 
	//write_javascript_remove_cart($bookType='bike', $ajax_action );
?>
<?php
get_footer();
?>