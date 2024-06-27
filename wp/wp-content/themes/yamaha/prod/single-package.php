<?php
get_header();
$page_id = get_queried_object_id();
gt_set_post_view();
$args = array(
    'post_type' => 'package',
    'paged' => 1,
    'post_status' => 'publish',
    'posts_per_page' => -1,
    // 'suppress_filters' => true,
    // 'meta_key' => 'price',
    // 'orderby' => 'meta_value',
    // 'order' => 'ASC',
);

$query = new WP_Query($args);

$posts = $query->posts;

$count = $query->post_count;

$terms = get_terms([
    'taxonomy' => "type_bike",
    'hide_empty' => false,
]);

?>

<div class="navigator__breadcrumbs">
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">TRANG CHỦ</a></li>
                <li class="breadcrumb-item"><a href="<?php echo get_permalink(110); ?>">DỊCH VỤ</a></li>
                <li class="breadcrumb-item"><a href="<?php echo get_permalink(420); ?>">GÓI DỊCH VỤ</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo get_the_title($page_id); ?></li>
            </ol>
        </nav>
    </div>
</div>


<section class="cat-banner banner-single">
    <div class="container-fluid">
        <?php $banner = get_field('banner_header', 420); ?>
        <?php if ($banner) : ?>
            <picture>
                <source media="(min-width:768px)" srcset="<?php echo $banner['image']; ?>">
                <img src="<?php echo $banner['image']; ?>" alt="" class="d-block w-100" />
            </picture>
            <div class="cat-banner__caption">
                <h1><?php echo $banner['title']; ?></h1>
            </div>
        <?php endif; ?>
    </div>
</section>
 <?php 
	$price = get_field('price', $page_id);
	$price_old = get_field('price_old', $page_id); 
	$price = intval(str_replace(".","", $price)); 
	$price_old = intval(str_replace(".","", $price_old)); 
	$promotions = get_field("promotion", $page_id);
    $product_code = get_field('sf_product_code', $page_id);
?>
<script>
	
var $promotions = <?php echo (wp_json_encode($promotions)) ; ?>;
//if(isArray($promotions)){
//	$promtions = JSON.parse($promotions);
//}
//alert(isArray($promotions));
</script>
<section class="service-detail mb-0">
    <div class="service-detail-info product_detail_content" data-id="<?php echo $page_id ;?>" data-type="<?php echo get_post_type($page_id); ?>" data-url="<?php the_permalink($page_id) ?>" data-title="<?php echo get_the_title($page_id) ?>"  product_code=<?=$product_code?> >
        <div class="row"> 
           	<div class="col-lg-6 col-12 product__color"> 
				<div class="active" data-image="<?php echo get_field("image", $page_id); ?>" >
					<img src="<?php echo get_field("image", $page_id); ?>" class="img-info" alt="">
				</div> 
            </div>
            <div class="col-lg-6 col-12">
                <div class="service-detail-head">
                    <span><?php echo get_the_terms($page_id, 'type_services')[0]->name; ?><strong>&nbsp; • &nbsp;</strong></span>
                    <span><?php echo get_field("number_service", $page_id); ?> Dịch vụ <strong>&nbsp; • &nbsp;</strong></span>
                    <span><?php echo get_field("month", $page_id); ?> Tháng</span>
                </div>
                <h2 class="colorGray ff-1"><?php echo get_the_title($page_id); ?></h2>
               
                <!-- * -->
                <div class="p-detail-price" data-price="<?php echo ($price); ?>" data-price_old=<?php echo ($price_old); ?> >
                    <div class="detail-price">
                    <span id="p-price" class="price"><?php echo currencyFormat($price); ?></span>
                    </div>
                    <div class="spacer-horizon-10"></div>
                    <?php if($price_old != 0){ ?>
                    <div class="discount-price ff-oswald"><?php echo currencyFormat($price_old); ?></div>
                    <?php } ?>
                </div>
                <div class="promotion-text">
                    <?php echo $promotions ; ?>
                </div>
                <div class="p-detail-quantity" >
                    <span>Số lượng</span>
                    <button type="button" class="btn btn-link shadow-none text-decoration-none btn-mins">-</button>
                    <div class="quantity"></div>
                    <button type="button" class="btn btn-link shadow-none text-decoration-none btn-plus">+</button>
                </div>
            <!-- /* -->
                <div class="short-des">
                    <?php echo get_field("short_content", $page_id); ?>
                </div>
                <div class="form-group-important product-bike-dealer">
                        
                        <?php
                        $args_dealer = array(
                            'post_type' => 'dealer',
                            'paged' => 1,
                            'post_status' => 'publish',
                            'posts_per_page' => -1,

                        );
                        $query_dealer = new WP_Query($args_dealer);

                        $post_dealers = $query_dealer->posts;

                        

                        ?> 
                        <!-- <div class="dropdown filter-dealer">
                            <a href="javascript:void(0)" class="btn btn-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="choose-dealer">Chọn Đại Lý</span>
                                <div class="top-line"></div>  
                                <div class="title"></div>
                                <div class="label label-fix"></div>
                            </a>
                            <script type="text/javascript">
                                var filter_dealer = {};
                            </script>
                            <div id="dealerSelect" class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <?php foreach ($post_dealers as $e) : ?>
                                    <a class="dropdown-item" href="javascript:void(0)" data-dealer_id="<?php echo $e->ID; ?>" data-name="<?php echo get_the_title($e->ID); ?>" data-address="<?php echo get_field("address", $e->ID); ?>">
                                        <!-- <?php echo get_field("address", $e->ID); ?> -->
                                        <span class="text"><?php echo get_the_title($e->ID); ?></span>
                                        <span class="text-sm"><img src="<?php echo get_template_directory_uri();?>/img/ic_location.svg" alt="icon" style="width: 10px;margin-bottom: 3px;">&nbsp;&nbsp;<?php echo get_field("address", $e->ID); ?></span>
                                        <div class="spacer-10"></div>
                                    </a>
                                <?php endforeach ?>
                            </div>
                            <div class="invalid-feedback"></div>
                        </div> -->
                        
                    </div>
                    <div style="height: 20px;" class="col-12"></div>
                    <div class="box-action-apparel"> 
                        <!--  <a href="javascript:void(0)" class="btn-view-cart btn-buy-to-cart btn-clip btn-red">
                        <span class="cart-bag"></span> MUA HÀNG
                        </a>
                        <div class="spacer-horizon-10"></div>
                       <a id="btn-add-to-cart" href="javascript:void(0)" data-url="<?php the_permalink(193) ?>?id=<?php echo $page_id; ?>" class="btn-add-to-cart btn-clip btn-border-blue" id="book" data-id="<?php the_ID() ?>" >Thêm vào giỏ hàng</a> <?php //echo $page_id; ?> -->
                        <div class="spacer-horizon-10 spacer-horizon-10-mb"></div>
                        <?php echo load_wishlist_button($page_id);?>
                    </div>  <?php //echo get_the_ID(); ?><?php //echo $page_id; ?>                   
            </div>
        </div>
        <div style="height: 40px"></div>

        <div class="main-info colorGray">
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <a class="nav-link active" id="nav-description-tab" data-toggle="tab" href="#nav-description" role="tab" aria-controls="nav-description" aria-selected="true">Đặc điểm sản phẩm</a>
                </div>
            </nav><div class="spacer-20"></div>
            <div class="tab-content" id="nav-tabContent">
                <?php echo get_field("content", $page_id); ?>
            </div>
        </div>   
        <div style="height: 40px"></div>
    </div>


    <?php
    
    $list = get_field("list_service_bike", $page_id);
    ?>
    <div class="related-new package bgGray">
        <div class="container-fluid">
            <div class="line l d-lg-block d-xl-block d-none"></div>
            <div style="height: 24px"></div>
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="ff-1 colorDark text-uppercase">GÓI Dịch vụ LIÊN QUAN</h2>
                <div class="swiper-navi">
                    <div class="swiper-button-prev swiper-button-prev--custom"><img src="<?php echo get_template_directory_uri() ?>/img/ic_long-left.svg" alt=""></div>
                    <div class="swiper-button-next swiper-button-next--custom"><img src="<?php echo get_template_directory_uri() ?>/img/ic_long-right.svg" alt=""></div>
                </div>
            </div>

            <div style="height: 24px;"></div>
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    <?php
                    foreach ($list as $e) :
                    ?>
                        <div class="swiper-slide">
                            <div class="background-image" style="background-image: url(<?php echo get_field("image", $e->ID) ?>);">
                                <div class="icon">
                                    <img src="<?php echo get_template_directory_uri(); ?>/img/service/icons/icon-<?php echo $k + 1; ?>.svg" alt="">
                                </div>
                                <div class="block-service">
                                    <div class="slug">
                                        <span class="one-line"><?php echo get_the_title($e->ID); ?><strong>&nbsp; • &nbsp;</strong></span>
                                        <span><?php echo get_field("number_service", $e->ID); ?> Dịch vụ <strong>&nbsp; • &nbsp;</strong></span>
                                        <span><?php echo get_field("month", $e->ID); ?> Tháng</span>
                                    </div>
                                    <div class="d-md-flex justify-content-between w-100">
                                        <div class="info">
                                            <h3 class="colorWhite exbold ff-1"><?php echo get_the_title($e->ID); ?></h3>
                                            <p class="price"><?php echo currencyFormat(get_field('price', $e->ID)); ?></p>
                                        </div>
                                        <a href="<?php echo get_permalink($e->ID) ?>" class="btn-clip btn-border-white w-auto align-self-center">Xem chi tiết <span class="ico__chev-right"></span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div style="height: 10px;" class="d-lg-none d-block"></div>
            <div style="height: 32px;" class="d-lg-block d-xl-block d-none"></div>
        </div>
    </div>
</section>

<script type="text/javascript">
	 var dealer_id = '', dealer_address='', dealer_name='', color='', size='', color_code='', size_code='';
    $(document).ready(function() {

        var swiperf = new Swiper('.related-new .swiper-container', {
            slidesPerView: "auto",
            spaceBetween: 8,
            allowTouchMove: true,
            navigation: {
                nextEl: '.related-new .swiper-button-next',
                prevEl: '.related-new .swiper-button-prev',
            },
            breakpoints: {
                // when window width is >= 640px
                960: {
                    slidesPerView: 3,
                    spaceBetween: 8,
                    centeredSlides: false,
                }
            }
        });
        $(document).on('click', '.filter-dealer .dropdown-item', function() {
            var that = $(this);
            var text = that.html();
            dealer_name = that.attr('data-name');
            dealer_address = that.attr('data-address');
            dealer_id = that.attr('data-dealer_id');
			$(".filter-dealer .top-line").html('<hr class="mt-2 mb-2">');
            $(".filter-dealer .title").html(text);
            $(".filter-dealer .label").html(text);

            filter_dealer = {
				dealer_id:dealer_id,
                address_name: dealer_name,
                address: dealer_address,
            };
			
			//$('.divdeposit').show();
			$('.btn-add-to-cart').removeAttr("disabled");

        }); 

    });
</script>
<script src="<?php echo get_template_directory_uri() ?>/js/my-work.js?v=<?php echo time(); ?>"></script>
<?php 
	$ajax_action = 'insert_cookie_cart_item'; 
	//if(is_user_logged_in()) $ajax_action = 'insert_cookie_cart_item'; 
	write_javascript_add_to_cart($bookType='package', $ajax_action);
?>


<?php
get_footer();
?>