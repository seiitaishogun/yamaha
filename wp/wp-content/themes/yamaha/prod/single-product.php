<?php
get_header();
// $page_id = get_the_ID();
$page_id = get_queried_object_id();

$terms = get_the_terms($page_id, 'products');

gt_set_post_view();

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

<?php echo get_template_part('includes/header/header-toolbar'); ?>

<?php
$group = get_field("background_banner", $page_id);
if ($group) :
?>

    <div class="banner banner__product banner-full" style="background-image: url(<?php echo $group['background'] ?>);">
        <div class="navigator__breadcrumbs">
            <div class="container-fluid">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo get_permalink(5) ?>">TRANG CHỦ</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?php echo $terms[0]->name; ?></li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="banner-inner">
            <div class="text-content">
                <div class=""><?php echo $group['headline'] ?></div>
                <h1 class="exbold ff-1"><?php echo get_the_title($page_id); ?></h1>
                <button type="button" class="btn--scrolldown click-next-section" data-pos="#next"><img src="<?php echo get_template_directory_uri() ?>/img/ic_long-down.svg" alt=""></button>
            </div>
        </div>
    </div>
<?php endif; ?> 

<?php 
 	$overview = get_field("overview", $page_id); 
	$promotions = get_field("promotions", $page_id); 
	$price = get_field('price', $page_id); 
	$price_old = get_field('price_old', $page_id); 
	$sale_off = get_field('sale_off', $page_id);
	$deposit = get_field('deposit', $page_id);

	$deposit = ($deposit)?$deposit:10000000;

	$deposit = intval(str_replace(".","", $deposit)); 
	$price = intval(str_replace(".","", $price)); 
	$price_old = intval(str_replace(".","", $price_old));

    $product_code = get_field('sf_product_code', $page_id);
?> 
<script>
	
var $promotions = <?php echo wp_json_encode($promotions); ?>;
  
</script>
<!-- /////OVERVIEW//// -->
<div class="product product-overview product_detail_content" id="next" data-id="<?php echo $page_id ;?>" data-type="<?php echo get_post_type($page_id); ?>" data-url="<?php the_permalink($page_id) ?>" data-title="<?php echo get_the_title($page_id) ?>" product_code=<?=$product_code?> >
    <div class="d-lg-block d-xl-block d-none spacer-20"></div><div class="spacer-20"></div>
    <div class="container-fluid">
        <div class="row ">
            <?php 
            if ($overview) :
                $list_colors = $overview['list_colors'];
				$price = $list_colors[0]['price_color']; 
	 			$price = intval(str_replace(".","", $price)); 
				$price_old = intval(str_replace(".","", $price_old));

                
                $color_code = $list_colors[0]['color_code'];
            ?>  
            
            <div class="col-lg-6 col-12">
                    <h2 class="ff-1 colorDark text-uppercase">TỔNG QUAN</h2>
                    <div style="height: 24px;" class="d-lg-block d-xl-block d-none"></div>
                    <div style="height: 12px;" class="d-block d-lg-none d-xl-none"></div>
                    <div class="">

                        <?php echo $overview['overview_description']; ?>

                    </div>
                   <div class="row mb-display-show">
					<div class="col-lg-12 col-12 d-lg-flex align-items-center">
						<div class="background-image img-product d-flex mb-display" style="background-image: url(<?php echo $list_colors[0]['image_color'] ?>); width:100%; display:block;">
						</div>
						<div class="background-image background-image--product-mb d-lg-none d-flex" style="background-image: url(<?php echo $list_colors[0]['image_color'] ?>); padding: 0"></div>
						<style>.product .img-product {max-width: 100%; background-size: contain;}</style>
					</div>
					<div class="col-lg-12 col-12 " >
						<div class="spacer-20"></div> 
						<div class="mrcenter text-center" >
							<ul class="product__color mrcenter pd0">
								<?php foreach ($list_colors as $k => $color) : ?>
									<li class="<?php echo $k === 0 ? 'active' : '' ?>" data-index="<?= $k ?>" data-color="<?php echo $color['image_color'];  ?>" data-price="<?php echo str_replace(".","",$color['price_color']); ?>" data-image="<?php echo $color['image_color'];?>" color_code="<?php echo $color['color_code']; ?>">
										<div class="block-color">
											<a href="javascript: void(0)">
												<img src="<?php echo $color['image_color'];  ?>" alt="">
											</a>
										</div>
										<div><?php echo $color['name_color'];  ?></div>
									</li>
								<?php endforeach; ?>
							</ul>
							<ul class="product__color-mb color-list mrcenter pd0">
								<?php foreach ($list_colors as $k => $color) : ?>
									<li class="<?php echo $k === 0 ? 'active' : '' ?>" data-index="<?= $k ?>" data-color="<?php echo $color['color_show_mobile']; ?>" data-price="<?php echo str_replace(".","",$color['price_color']); ?>" data-img="<?php echo $color['image_color'];  ?>" data-image="<?php echo $color['image_color'];  ?>" style="background: <?php echo $color['color_show_mobile']; ?>"><span></span></li>
								<?php endforeach; ?>
							</ul>
						</div>
					</div>
			   </div> 
                    <div class="spacer-10"></div>
                    <div class="fz16 colorLGra mb-label-price">Giá</div>
                    <div class="product__price-preview p-detail-price" data-price="<?php echo $price ?>" data-price_old="<?php echo $price_old; ?>"  data-sale_off="<?php echo $sale_off; ?>"> 
                        <div class="spacer-10"></div>
                        <h4 class="ff-1 colorDark fz30 text-left mb-price" style="line-height: 33px;">
                        <span id="p-price" class="price"><?php echo currencyFormat($price); ?></span></h4> 
                        <?php if($price_old>0){ ?><div class="spacer-horizon-10"></div>
						<div class="discount-price"><?php echo currencyFormat($price_old); ?></div>
						<?php } ?> 
                        <div class="spacer-20"></div> 
                    </div>
                    <?php if ($promotions) : ?> 
                    <div class="spacer-20"></div>
                    
                    <div class="product-promotion">
                        <div class="left-top-white-border"></div>
                        <div class="left-top-red-border"></div>
                        <div class="promotion-header" style="background-image:url(<?= get_template_directory_uri() ?>/img/promotion-bg-top-left.png)">
                            Khuyến Mãi
                        </div>

                    <?php if(count($promotions) >0) : ?>
                        <ol id="promotion-list" class="colorWhite fnt-16 mr0 promotion-content pd20 pt30 pl80 pr80 w-100">
                            <?php foreach ($promotions as $item) {
                                echo '<li class="km_item">'.$item['promotion_item'].'</li>';
                            }  ?>   
                        </ol>
                    <?php endif; ?>

                        <div class="right-bottom-white-border"></div>
                        <div class="right-bottom-border">
                            <img src="<?= get_template_directory_uri() ?>/img/promotion-bg-bottom-right.png">
                        </div>
                    </div>
                  	<?php endif;?>
                  	
                <div class="spacer-10"></div>
                <div class="form-group-important product-bike-dealer">
                        
                        <?php
                        $dealers = get_field('dealers', $page_id);

                        $args_dealer = array(
                            'post_type' => 'dealer',
                            'paged' => 1,
                            'post_status' => 'publish',
                            'posts_per_page' => -1,

                        );
                        $query_dealer = new WP_Query($args_dealer);

                        $post_dealers = $query_dealer->posts;

                        $check = 0;  
						$strmsg = '<div class="promo-descrip colorRed mt5 mb5">Thời gian nhận hàng dự kiến sẽ trễ.</div>';

                        ?> 
                        <!-- <div class="spacer-20"></div>
                        <div class="dropdown filter-dealer">
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
                                        < <?php echo get_field("address", $e->ID); ?>
                                        <span class="text"><?php echo get_the_title($e->ID); ?></span>

                                        <?php foreach ($dealers as $i) : ?>
                                            <?php 
                                            if ($e->ID === $i->ID) {
                                                $check = 1;
                                            }
                                            ?>
                                        <?php endforeach ?>
                                        <?php
                                        if ($check > 0) {
                                            echo '<span class="tag in_out_stock">In stock</span>';
											$strmsg = '';
                                            $check = 0;
                                        } else {
                                            echo '<span class="tag-pre in_out_stock">Out stock</span>';
											$strmsg = '<div class="promo-descrip hide mt5 mb5">Thời gian nhận hàng dự kiến sẽ trễ.</div>';
                                        }
                                        ?>
                                        <span class="text-sm"><img src="<?php echo get_template_directory_uri();?>/img/ic_location.svg" alt="icon" style="width: 10px;margin-bottom: 3px;">&nbsp;&nbsp;<?php echo get_field("address", $e->ID); ?></span>
                                       <?php echo $strmsg; ?>
                                    </a>
                                <?php endforeach ?>
                            </div>
                            <div class="invalid-feedback"></div>
                            <div class="spacer-10"></div>
                            
                        </div>  -->
                        <div class="promo-descrip show colorRed mt5 mb5 mb-spacer"></div> 
						 <style>.promo-descrip.hide{display: none;} .promo-descrip.show{display: block; font-weight: 600;}</style>
                    </div>
                	 <div class="spacer-10 spacer-20-mb"></div>
					<div class="d-flex align-items-center mt20 mb20">
                       <!-- <a id="btn-add-to-cart" href="javascript:void(0)" data-url="<?php the_permalink(193) ?>?id=<?php echo $page_id; ?>" class="btn-buy-to-cart btn-clip btn-red btn-clip-mb" id="book" data-id="<?php the_ID() ?>" >ĐẶT CỌC</a>
						<div style="width: 14px;"></div> -->
						<a href="<?php the_permalink(195) ?>?id=<?php echo $page_id; ?>" class="btn-clip btn-border-red btn-clip-mb">
							<img src="<?php echo get_template_directory_uri() ?>/img/ic_compare.svg" alt="" class="mr-2"> SO SÁNH XE
                            <div class="triangle">
                                <div></div>
                            </div>
						</a>
						<!--Wishlist Button--> 
						<?php //if(function_exists('load_wishlist_button')){ echo '<div style="width: 20px;"></div>'; echo load_wishlist_button($page_id);} ?>
					</div>
                   <!--  <div class="spacer-20"></div>
				 	<div class="divdeposit text-left" data-value="<?php echo $deposit; ?>" > 
					<p class="deposit val colorGray fz16">Thanh toán trước khoảng <?php echo currencyFormat($deposit); ?> khi đặt cọc.</p>
					</div><div class="spacer-10"></div> -->
            <?php endif; ?>
            
        </div>
        <div class="col-lg-6 col-12 mb-display-hide"  >
			   <div class="row">
					<div class="col-lg-12 col-12 d-lg-flex align-items-center">
						<div class="background-image img-product d-flex mb-display" style="background-image: url(<?php echo $list_colors[0]['image_color'] ?>); width:100%; display:block;">
						</div>
						<div class="background-image background-image--product-mb d-lg-none d-flex" style="background-image: url(<?php echo $list_colors[0]['image_color'] ?>); padding: 0"></div>
						<style>.product .img-product {max-width: 100%; background-size: contain;}</style>
					</div>
					<div class="col-lg-12 col-12 " >
						<div class="spacer-5"></div> 
						<div class="mrcenter text-center" >
							<ul class="product__color mrcenter pd0">
								<?php foreach ($list_colors as $k => $color) : ?>
									<li class="<?php echo $k === 0 ? 'active' : '' ?>" data-index="<?= $k ?>" data-color="<?php echo $color['image_color'];  ?>" data-price="<?php echo str_replace(".","", $color['price_color']); ?>" data-image="<?php echo $color['image_color']; ?>" color_code="<?php echo $color['color_code']; ?>">
										<div class="block-color">
											<a href="javascript: void(0)">
												<img src="<?php echo $color['image_color'];  ?>" alt="">
											</a>
										</div>
										<div><?php echo $color['name_color'];  ?></div>
									</li>
								<?php endforeach; ?>
							</ul>
							<ul class="product__color-mb color-list mrcenter pd0">
								<?php foreach ($list_colors as $k => $color) : ?>
									<li class="<?php echo $k === 0 ? 'active' : '' ?>" data-index="<?= $k ?>" data-color="<?php echo $color['color_show_mobile']; ?>" data-price="<?php echo str_replace(".","", $color['price_color']); ?>" data-img="<?php echo $color['image_color'];  ?>" data-image="<?php echo $color['image_color'];?>" 
                                    color_code="<?php echo $color['color_code']; ?>" style="background: <?php echo $color['color_show_mobile']; ?>"><span></span></li>
								<?php endforeach; ?>
							</ul>
						</div>
					</div>
			   </div>                    
         </div> 
    </div>
</div>

<!-- //////FEATURE BENEFITS/// -->
   <div class="product product__featured bgGray pb-3">
    <div class="spacer-10"></div>
    <div class="container-fluid"><div class="spacer-20 col-lg-12 col-12"></div>
        <div class="d-flex justify-content-between align-items-center top-slide">
            <h2 class="ff-1 colorDark text-uppercase">TÍNH NĂNG</h2>
            <div class="swiper-navi-product">
                <div class="swiper-button-prev swiper-button-prev--custom"><img src="<?php echo get_template_directory_uri() ?>/img/ic_long-left.svg" alt=""></div>
                <div class="swiper-button-next swiper-button-next--custom"><img src="<?php echo get_template_directory_uri() ?>/img/ic_long-right.svg" alt=""></div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </div>
    <div class="spacer-20 d-lg-block d-xl-block d-none"></div> 
    <div class="swiper-wrapper-slide wrapper-left">
        <div class="swiper-container">
            <div class="swiper-wrapper">
                <?php
                $benefit = get_field("feature_benefits", $page_id);
                if ($benefit) :

                ?>
                    <?php foreach ($benefit as $k => $e) : ?>
                        <?php $k++; ?>
                        <div class="swiper-slide">
                            <img src="<?php echo $e['image'] ?>" alt="">
                            <div style="height: 10px;"></div>
                            <div class="product__featured-box">
                                <div class="fz20 bold colorDark clamp-2"><?php echo $k . ". " . $e['title'] ?></div>
                                <div style="height: 6px;"></div>
                                <div class="fz14"><?php echo $e['description'] ?></div>
                            </div>
                            <a class="link-full"></a>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
            <div class="swiper-navi-product d-lg-none d-block">
                <div class="swiper-button-prev swiper-button-prev--custom"><img src="<?php echo get_template_directory_uri() ?>/img/ic_long-left.svg" alt=""></div>
                <div class="swiper-button-next swiper-button-next--custom"><img src="<?php echo get_template_directory_uri() ?>/img/ic_long-right.svg" alt=""></div>
            </div>
        </div>
    </div>
    <div class="spacer-20 d-lg-block d-xl-block d-none"></div> 
</div>


<!-- //////SPECIFICATIONS/// -->
<?php
$specification = get_field("specification_overview", $page_id);
if ($specification) :

?>
    <div class="product">
        <!-- <div style="height: 32px;" class="d-lg-block d-xl-block d-none"></div> -->
        <div class="container-fluid px-lg-4 px-0">
            <?php  $src='';
            $iframe = $specification['video'];
            preg_match('/src="(.+?)"/', $iframe, $matches);
            if(is_array($matches) && count($matches) >1) {

            
                $src = $matches[1];
            ?>
            <div class="wrapper-container">
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe src="<?php echo $src; ?>" title="YouTube video player" class="embed-responsive-item" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
            </div>
            <?php } ?>
        </div>
        <div class="container-fluid">

            <div style="height: 32px;" class="d-lg-block d-xl-block d-none"></div>
            <div style="height: 16px;" class="d-block d-lg-none d-xl-none"></div>

            <h2 class="ff-1 colorDark text-uppercase text-lg-center">THÔNG SỐ KỸ THUẬT</h2>

            <div style="height: 40px;" class="d-lg-block d-xl-block d-none"></div>
            <div style="height: 16px;" class="d-block d-lg-none d-xl-none"></div>
            <div class="row">
                <div class="col-lg-4 col-12">
                    <div class="product__engine">
                        <?php if ($specification['engine']) : ?>
                            <div class="product__engine-item">
                                <h3 class="product__point"><span class="animate-number" data-number="<?php echo $specification['engine']; ?>">0</span> <sup>CC</sup></h3>
                                <div class="line"></div>
                                <div>Động cơ</div>
                            </div>
                        <?php endif; ?>
                        <?php if ($specification['hp_peak_power']) : ?>
                            <div class="product__engine-item">
                                <h3 class="product__point"><span class="animate-number" data-number="<?php echo $specification['hp_peak_power']; ?>">0</span> <sup>mã lực</sup></h3>
                                <div class="line"></div>
                                <div>Công suất cực đại</div>
                            </div>
                        <?php endif; ?>
                        <?php if ($specification['imu']) : ?>
                            <div class="product__engine-item">
                                <h3 class="product__point"><span class="animate-number" data-number="<?php echo $specification['imu']; ?>">0</span> <sup>Nm</sup></h3>
                                <div class="line"></div>
                                <div>Mô men xoắn cực đại</div>
                            </div>
                        <?php endif; ?>
                        <?php if ($specification['wet_weight']) : ?>
                            <div class="product__engine-item">
                                <h3 class="product__point wet-height"><span class="animate-number" data-number="<?php echo $specification['wet_weight']; ?>">0</span> <sup>kg</sup></h3>
                                <div class="line"></div>
                                <div>Trọng lượng</div>
                            </div>
                        <?php endif; ?>
                    </div>
                    <?php if ($specification['e-brochure']) : ?>
                        <a href="<?php echo $specification['e-brochure'] ?>" target="_blank" class="btn-clip btn-red link-desk"><span class="append-icon ico__download"></span> TẢI XUỐNG DANH SÁCH ĐIỆN TỬ</a>
                    <?php endif; ?>
                </div>

                <div class="col-lg-8 col-12">
                    <?php $detail = get_field("specification_detail", $page_id); ?>

                    <?php if ($detail) : ?>
                        <?php
                        foreach ($detail as $k => $el) :
                        ?>
                            <div class="product__accordion">
                                <button class="product__accordion-btn <?php echo $k !== 0 ? 'collapsed' : ''; ?>" type="button" data-toggle="collapse" data-target="#collapse_p<?php echo $k; ?>" aria-expanded="true" aria-controls="collapse_p<?php echo $k; ?>">
                                    <?php echo $el['headline']; ?> <span class="cavet"></span>
                                </button>

                                <div id="collapse_p<?php echo $k; ?>" class="collapse <?php echo $k === 0 ? 'show' : '' ?> product__accordion-content">
                                    <ul>
                                        <?php foreach ($el['specification'] as $e) : ?>
                                            <li>
                                                <strong><?php echo $e['title'] ?></strong>
                                                <span><?php echo $e['description'] ?></span>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>

                    <a href="<?php echo $specification['e-brochure'] ?>" target="_blank" class="btn-clip btn-border-red link-mb"><span class="append-icon ico__download"></span> TẢI XUỐNG DANH SÁCH ĐIỆN TỬ</a>
                </div>
            </div>

        </div>
        <div style="height: 32px;" class="d-lg-block d-xl-block d-none"></div>
        <div style="height: 40px;" class="d-block d-lg-none d-xl-none"></div>
    </div>
<?php endif; ?>


<!-- ////RECOMMENDED ///// -->

<div class="product bgGray">
    <div style="height: 32px;" class="d-lg-block d-xl-block d-none"></div>
    <div style="height: 10px;" class="d-block d-lg-none d-xl-none"></div>
    <div class="container-fluid">
        <div class="d-flex align-items-center justify-content-between">
            <h2 class="ff-1 colorDark text-uppercase">Xe cùng dòng <?php echo $terms[0]->name; ?></h2>
            <div class="swiper-navi">
                <div class="swiper-button-prev swiper-button-prev--custom"><img src="<?php echo get_template_directory_uri() ?>/img/ic_long-left.svg" alt=""></div>
                <div class="swiper-button-next swiper-button-next--custom"><img src="<?php echo get_template_directory_uri() ?>/img/ic_long-right.svg" alt=""></div>
                <div class="d-lg-none swiper-pagination"></div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div style="height: 24px;"></div>
        <div class="product__recommend">
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    <?php foreach ($products as $k => $e) : ?>
                        <?php if ($page_id == $e->ID) continue ?>

                        <div class="product__recommend-item swiper-slide">
                            <a href="<?php echo get_permalink($e->ID); ?>" class="stretched-link"></a>
                            <?php
                            $rec = get_field("feature_product", $e->ID);
                            $price = $rec['feature_price'];

                            ?>
                            <div class="block-img">
                                <img src="<?php echo $rec['feature_img']; ?>" alt="">
                            </div>
                            <div style="height: 24px;"></div>
                            <div class="fz18 bold"><?php echo $rec['feature_title']; ?></div>
                            <div class="fz14 colorLGray">Giá <span class="fz20"><?php echo currencyFormat($price); ?></span></div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="swiper-navi-mb d-lg-none">
                <div class="swiper-button-prev swiper-button-prev--custom"><img src="<?php echo get_template_directory_uri() ?>/img/ic_long-left.svg" alt=""></div>
                <div class="swiper-button-next swiper-button-next--custom"><img src="<?php echo get_template_directory_uri() ?>/img/ic_long-right.svg" alt=""></div>
            </div>
        </div>
    </div>
    <div style="height: 30px;" class="d-lg-block d-xl-block d-none"></div>
</div>


<script type="text/javascript">
	var dealer_id = '', dealer_name='', dealer_address='', color='', size='', color_code='', size_code='', image, quantity=1;
    function setPromotionSize(){
        var contentHeight = $('.product-promotion .left-top-white-border').height();
        var newRedLeftBorder = contentHeight;
        // 1 dòng có chiều cao text 24px, chiều cao nội dung 74px và left text Khuyen mai là 23px
        var newPromotionLeftText = Math.floor( ((contentHeight - 74) / 24) + 23);
        var newRightBottomBorder = 43 + (Math.floor((contentHeight - 74) / 24) * 8);
        console.log(Math.ceil((contentHeight - 74) / 24));

        $('.product-promotion .left-top-red-border').css('border-top-width', newRedLeftBorder + 'px');
        $('.product-promotion .promotion-header').css('left', newPromotionLeftText + 'px');
        $('.product-promotion .right-bottom-white-border').css('height', (contentHeight * 1.5) + 'px');
        $('.product-promotion .right-bottom-border').css('right', newRightBottomBorder + 'px');

        if ($(window).width() < 768){
            $('.product-promotion .right-bottom-white-border').css('height', (contentHeight * 1.2) + 'px');
            newRightBottomBorder = -46 + (Math.floor((contentHeight - 74) / 24) * 7);
            $('.product-promotion .right-bottom-border').css('right', newRightBottomBorder + 'px');
        }
    }
    $(document).ready(function() {
        $('.divdeposit').hide();
        $('#content').css({
            'position': 'relative',
            'margin-top': '-43px'
        });
        $(".h-box").addClass("gradient");
        const swiperLine = new Swiper('.product__recommend .swiper-container', {
            slidesPerView: 1,
            spaceBetween: 3,
            navigation: {
                nextEl: '.swiper-navi-mb .swiper-button-next',
                prevEl: '.swiper-navi-mb .swiper-button-prev',
            },
            pagination: {
                el: '.swiper-navi .swiper-pagination',
                type: 'fraction',
            },
            breakpoints: {
                // when window width is >= 640px
                960: {
                    slidesPerView: 3,
                    spaceBetween: 8,
                    navigation: {
                        nextEl: '.swiper-navi .swiper-button-next',
                        prevEl: '.swiper-navi .swiper-button-prev',
                    },
                }
            },          
        });
        if ($(window).width() > 1023 && $('.product__recommend .product__recommend-item').length < 5) {
            $('.product .swiper-navi').addClass('hide');
        }

        PageFunction.products();

        $(document).on('click', ".product__color-mb li,.product__color li", function () {
            let that = $(this);
            // console.log($(this).data('index'));
            loadDealer($(this).data('index'));
        });
        loadDealer(0);
        function loadDealer(index){
            $.ajax({
                url: ajaxurl, // AJAX handler
                data: {
                    'action': 'load_dealer_ajax_handler',
                    'i': index,
                    'type': 'product',
                    'id': '<?php echo $page_id; ?>'
                },
                type: 'POST',
                dataType: "json",
                beforeSend: function(xhr) {
                },
                success: function(data) {
                    if (data) {
                       $(".dropdown.filter-dealer .in_out_stock").removeClass("tag-pre");
                       $(".dropdown.filter-dealer .in_out_stock").removeClass("tag");
                       $(".dropdown.filter-dealer .in_out_stock").addClass("tag-pre");
                       $(".dropdown.filter-dealer .in_out_stock").text("Out stock");
                        $.each(data, function( index, value ) {
                            console.log(value['dealer_id']);
                            // value['dealer_id'] = '1021';
                            var item = $(".dropdown.filter-dealer [data-dealer_id="+value['dealer_id']+"] .in_out_stock");
                            item.removeClass('tag-pre');
                            item.addClass('tag');
                            item.text('In stock');
                        });
                    }
                }
            })
        }    
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
			
			$('.divdeposit').show();
            if($(this).find('.in_out_stock').hasClass('tag-pre')){
                $('.promo-descrip.show').html('Thời gian nhận hàng dự kiến sẽ trễ.');
            }            
			// $('.promo-descrip.show').html($(this).find('.promo-descrip.hide').text());
			$('.btn-buy-to-cart').removeAttr("disabled");

        });
        $( window ).resize(function() {
            setPromotionSize();
        });

        setPromotionSize();
		
    });
</script>
<script src="<?php echo get_template_directory_uri() ?>/js/my-work.js?v=<?php echo time(); ?>"></script>
<?php 
	$ajax_action = 'insert_cookie_cart_item'; 
	//if(is_user_logged_in()) $ajax_action = 'insert_cookie_cart_item'; 
	write_javascript_add_to_cart($bookType='bike', $ajax_action);
?>

<?php
get_footer();
