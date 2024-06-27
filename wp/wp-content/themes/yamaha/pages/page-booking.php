<?php
/**
 * @author HUNG VO
 * created Date: 10/12/2021
 * project: yamaha-revzone-website
 *
 * Template Name: BOOKING ORDER PAGE
 *
 */

get_header();
 
global $wpdb, $current_user, $current_user_profile, $current_customer_address;

$table = $wpdb->prefix.'customer'; 

$page_id = get_queried_object_id();
$step = 1;
if(isset($_REQUEST['step'])) $step = intval($_REQUEST['step']);
$arr_page_title = array('GIỎ HÀNG', 'THANH TOÁN', 'HOÀN TẤT', "XÁC NHẬN ĐẶT HÀNG");
$arr_step_title = array('GIỎ HÀNG', 'THANH TOÁN', 'HOÀN TẤT', "XÁC NHẬN ĐẶT HÀNG");

$breadcrumb = [
    "0" => [
        'name' => '' . $arr_step_title[$step-1],
        'slug'   => 'booking',
        'active' => true,
    ]]; 

if(!is_user_logged_in()){
		//wp_redirect( esc_url_raw( home_url( '/wp-login.php?url_redirect=/booking/?step=2' ) ) );
		// Hien thi Popup Dang Nhap
	if($step == 2){
		echo '<script> $(document).ready(function() { 
				show_popup_login(); $(".login-wrapped").addClass("mrcenter");
			});
			</script>';
	}
	if($step == 3){
		//echo '<script>window.location.href = "' . get_site_url() . '/booking/?step=2"; </script>';
	} 
}

$terms = get_the_terms(782, 'products');


$_tax = array();


$find = isset($_GET['find']) ? $_GET['find'] : '';

$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$order = isset($_GET['order']) ? $_GET['order'] : '';


if (!isset($find)) {
    $find = '';
}

if (!isset($_term)) {
    $_term = '';
}


if (!isset($tag)) {
    $tag = '';
}
$_term = $terms[0]->slug;

$query = bikes($paged, $find, $_term, $tag, $order);

$products = $query['query']->posts;
?>

<div class="booking bg_all">
  
<?php echo  get_template_part('includes/header/header-breadcrumb', '', $breadcrumb);?>

<?php if($step <=1){?>
<section class="cat-banner" >
    <div class="container-fluid"> 
            <picture>
                <source media="(min-width:768px)" srcset="<?php echo $banner; ?>">
                <img src="<?php echo get_template_directory_uri();?>/img/sweaters/banner.jpg" alt="" class="d-block w-100" />
            </picture>
            <div class="cat-banner__caption">
                <h1><?php echo $arr_step_title[$step-1]; ?></h1>
            </div>
    </div>
</section>
<?php }?> 
	<section class="hot-items " id="next">
		<div class="container-fluid colorDark">
			 <div class="box-shadow00rem" >
				   <?php load_booking_form($step); ?>
			</div>
		</div>
	</section>

	<?php if($step < 2): ?>
	<!-- ////RECOMMENDED  YOU MIGHT INTEREST///// -->
	 <section class="hot-items bg-gray">
		<div class="container-fluid">
			<div class="hot-items__title">
				<h3 class="ff-1">CÓ THỂ BẠN QUAN TÂM</h3>
				<div class="swiper-navi">
					<div class="swiper-button-prev swiper-button-prev--custom"><img src="<?php echo get_template_directory_uri() ?>/img/ic_long-left.svg" alt=""></div>
					<div class="swiper-button-next swiper-button-next--custom"><img src="<?php echo get_template_directory_uri() ?>/img/ic_long-right.svg" alt=""></div>
				</div>
			</div>
			<div class="product-list slider-recently">
				<div class="swiper-container">
					<div class="swiper-wrapper">
						<?php
						$args = array(
							'post_type' => 'item',
							'posts_per_page' => -1,
							'meta_key' => '_last_viewed',
							'orderby' => 'meta_value',
							'order' => 'DESC',
						);
						$query = new WP_Query($args);
						$sale = '';
						$posts = $query->posts;
						$count_posts = $query->post_count;
						?>

						<?php
						foreach ($posts as $post) :
							if ($post) :
						?>
								<?php $types = get_the_terms($post->ID, 'tag'); ?>
								<?php
								foreach ($types as $type) {
									if ($type->slug === 'sale-off') {
										$sale = 'sale';
									}
								}
								$price = get_field('price', $post->ID);
								?>
								<a class="swiper-slide product-item <?php echo $sale;
																	$sale = ''; ?>" href="<?php echo get_permalink($post->ID); ?>">
									<img src="<?php echo get_field("list_image", $post->ID)[0]['image'][0]['sizes']['medium']; ?>" alt="" />
									<div class="product-item__title"><?php echo get_the_title($post->ID); ?></div>
									<div class="product-item__price"><?php echo currencyFormat($price); ?></div>
								</a>
							<?php endif; ?>
						<?php endforeach; ?>

					</div>
				</div>
			</div>
			<div class="loader"></div>

		</div>
	</section> 
	
	<script type="text/javascript"> 
	 
    $(document).ready(function() {
	 
		swiper = new Swiper(".mySwiper", {
            slidesPerView: 4,
            spaceBetween: 8,
            centeredSlides: false,
            slidesPerGroupSkip: 1,
            grabCursor: true,
            keyboard: {
                enabled: true,
            },
        });

        var swiperR = new Swiper('.slider-recently .swiper-container', {
            slidesPerView: 1,
            spaceBetween: 0,
            allowTouchMove: true,
            navigation: {
                nextEl: '.swiper-navi .swiper-button-next',
                prevEl: '.swiper-navi .swiper-button-prev',
            },
            breakpoints: {
                // when window width is >= 640px
                768: {
                    slidesPerView: <?php echo $count_posts < 5 ? $count_posts : 5 ?>,
                    // allowTouchMove: false,
                    // centeredSlides: false,
                    // loop: false,
                }
            }
        }); 
	 
});
</script>

	<?php endif; ?>
</div> 
<?php
get_footer();
?>
<script type="text/javascript"> 
 //history.pushState(url='<?=get_site_url()?>/order-confirm/', '', url='<?=get_site_url()?>/booking/?step=2');
 if(performance.navigation.type == 2){
   window.location.reload();
}
 
</script>


<?php 
	$ajax_action = 'remove_cookie_booking_item'; 
	//if(is_user_logged_in()) $ajax_action = 'update_order_booking'; 
	write_javascript_remove_cart($bookType='product', $ajax_action );
?>
<script src="<?php echo get_template_directory_uri() ?>/js/my-work.js?v=<?php echo time(); ?>"></script>
