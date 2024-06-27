<?php
get_header();
// $page_id = get_the_ID();
$page_id = get_queried_object_id();

$terms = get_the_terms($page_id, 'apparels');

if (get_post_type($page_id) == 'item') {
    update_post_meta($page_id, '_last_viewed', current_time('mysql'));
}

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
	$price = get_field('price', $page_id); 
	$price_old = get_field('price_old', $page_id);
	$sale_off = get_field('sale_off', $page_id); 
	$promotions = get_field("promotions", $page_id); 
	$price = intval(str_replace(".","", $price)); 
	$price_old = intval(str_replace(".","", $price_old));
	 $product_code = get_field('sf_product_code', $page_id);
?>
<script>
	
var $promotions = <?php echo wp_json_encode($promotions); ?>;
//if(isArray($promotions)){
//	$promtions = JSON.parse($promotions);
//}
//alert(isArray($promotions));
</script>
<div class="navigator__breadcrumbs">
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo get_permalink(5) ?>">TRANG CHỦ</a></li>
                <li class="breadcrumb-item"><a href="<?php echo get_permalink(108); ?>">TRANG PHỤC</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo $terms[0]->name; ?></li>
            </ol>
        </nav>
    </div>
</div>
<style>
	 .apparel-detail{max-width: 100% !important;  }
	.container-fluid .main-detail__pics,
	.container-fluid .main-detail__content{ align-self: stretch; }
	.container-fluid .main-detail__content{ margin: 0px; padding: 0px; max-width: 100%;}
	.main-detail__pics{text-align: center; display: flex; align-items: center; vertical-align: middle;}
	.main-pic{border: 1px solid #f6f6f6; align-self: center; margin: 10px auto; width: 100%}
	.main-pic img{width: 99% ; height: auto;}
	.thumb-pics{width: 100%; display: block; margin-top: 10px;}
</style>
<div class="spacer-20"></div>
<div class="container-fluid" >
  <div class="apparel-detail product_detail_content" data-id="<?php echo $page_id ;?>" data-type="<?php echo get_post_type($page_id); ?>" data-url="<?php the_permalink($page_id) ?>" data-title="<?php echo get_the_title($page_id) ?>"  product_code=<?=$product_code?>  >
   <?php /*?> <div class="main-detail"><?php */?>
    <div class="row" > 
       		<div class="main-detail__pics col-lg-6 col-12 " > 
				<?php $items = get_field("list_image", $page_id); ?> 
				<div class="row" >
					<div class="main-pic col-12">
						<img class="img-zoom img" src="<?php echo $items[0]['image'][0]['sizes']['large']; ?>" data-zoom-image="<?php echo $items[0]['image'][0]['sizes']['large']; ?>" data-image="<?php echo $items[0]['image'][0]['sizes']['large']; ?>" />
					</div> 
					<div class="thumb-pics col-12" id="gallery_01">
						<?php
						if ($items[0]['image']) :
							foreach ($items[0]['image'] as $k => $item) :
						?>
								<a href="#" class="thumb-gallery <?php echo $k === 0 ? 'active' : '' ?>" data-update="" data-image="<?php echo $item['sizes']['medium']; ?>" data-zoom-image="<?php echo $item['sizes']['large']; ?>">
									<img src="<?php echo $item['sizes']['medium']; ?>" class="img-fluid" /></a>
							<?php endforeach; ?>
						<?php endif; ?>
					</div> 
				</div>
			</div> 
    		
     		<div class="main-detail__content col-lg-6 col-12 " >
				<h5 class="p-detail-cat"><?php echo $terms[0]->name; ?></h5>
				<h3 class="p-detail-name" style="width: 100%;"><?php echo get_the_title($page_id); ?></h3>
				
				<!-- * -->
				<div class="spacer-10"></div>
				<div class="p-detail-price" data-price="<?php echo $price; ?>" data-price_old="<?php echo $price_old; ?>"  data-sale_off="<?php echo $sale_off; ?>">
					<div class="detail-price">
					<span id="p-price" class="price"><?php echo currencyFormat($price); ?></span>
					</div>
					
					<?php if($price_old>0){ ?><div class="spacer-horizon-10"></div>
						<div class="discount-price"><?php echo currencyFormat($price_old); ?></div>
					<?php } ?> 
				</div>
				<!-- /* -->
				<div class="spacer-10"></div>
				<div class="p-detail-color product__color">
					<span>Màu sắc</span>
					<div class="color-list">
						<?php
						if ($items) :
							foreach ($items as $k => $item) :
						?>
								<a class="<?php echo $k === 0 ? 'active' : '' ?> load-color" href="javascript:void(0)" data-index="<?php echo $k ?>" data-color="<?php echo $item['color']; ?>" color_code="<?php echo $item['color_code']; ?>" data-price="<?php echo $price; ?>" data-image="<?php echo $item['image'][0]['sizes']['medium']; ?>">
									<span style="background: <?php echo $item['color']; ?>;"></span>
								</a>
							<?php endforeach; ?>
						<?php endif; ?>
					</div>
				</div>
				<div class="spacer-10"></div>
				<div class="p-detail-size">
					<?php $sizes = get_field('size', $page_id); ?>
					<span>Kích thước</span>
					<ul class="list-size size-list">
						<?php
						if ($sizes) :
							foreach ($sizes as $k => $size) :
						?>
								<li size_code="<?php echo $item['size_code']; ?>"  class="<?php echo $k == 0 ? 'active' : '' ?>"><a href="javascript:void(0)"><?php echo $size; ?></a></li>
							<?php endforeach; ?>
						<?php endif; ?>
					</ul>

				</div>
				<!-- * -->
				   <div class="spacer-10"></div>
					<div class="p-detail-quantity">
						<span>Số lượng</span>
						<button type="button" class="btn btn-link shadow-none text-decoration-none btn-mins">-</button>
						<div class="quantity"></div>
						<button type="button" class="btn btn-link shadow-none text-decoration-none btn-plus">+</button>
					</div>

					 <?php if ($promotions) : ?> 
						<div class="spacer-10"></div>
						<div class="apparel__khuyenmai relative d-lg-flex align-items-center w-100"> 
							<div class="apparel_noidung_km relative colorWhite fnt-18 align-self mt5" >
							<?php //if ($promotions) : ?>  
								<ul class="colorRed fnt-16 mr0 ">
									<?php foreach ($promotions as $item) {
										echo '<li class="mb5">'.$item['promotion_item'].'</li>';
									}  ?>   
								</ul> 
							</div> 
						</div>
						<?php endif;?>


					<div class="spacer-10"></div>
					<!-- <div class="form-group-important product-bike-dealer"> 
							<?php
							$dealers = get_field('dealers', $id);

							$args_dealer = array(
								'post_type' => 'dealer',
								'paged' => 1,
								'post_status' => 'publish',
								'posts_per_page' => -1,

							);
							$query_dealer = new WP_Query($args_dealer);

							$post_dealers = $query_dealer->posts;

							$check = 0; 
							$strmsg = '<div class="promo-descrip hide mt5 mb5">Thời gian nhận hàng dự kiến sẽ trễ.</div>';

							?>  
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
											<?php //echo get_field("address", $e->ID); ?> 
											<span class="text"><?php echo get_the_title($e->ID); ?></span>

											<?php foreach ($dealers as $i) : ?>
												<?php
												if ($e->ID === $i->ID) {
													$check = 1;
													$strmsg = '';
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
												$strmsg = '<div class="promo-descrip hide mb5">Thời gian nhận hàng dự kiến sẽ trễ.</div>';
											}
											?>
											<span class="text-sm"><img src="<?php echo get_template_directory_uri();?>/img/ic_location.svg" alt="icon" style="width: 10px;margin-bottom: 3px;">&nbsp;&nbsp;<?php echo get_field("address", $e->ID); ?></span> 

											<?php echo $strmsg; ?>
										</a>
									<?php endforeach ?> 
								</div> 
							</div>
							<div class="invalid-feedback"></div>

						</div> -->
						<div class="promo-descrip show colorRed  mt20  mb5 mb-spacer"></div>
						<style>.promo-descrip.hide{display: none;} .promo-descrip.show{display: block; font-weight: 600;}</style>

				 <div class="spacer-20"></div>
				<!-- */ -->
				<div class="box-action-apparel"> 
					<!-- <a href="javascript:void(0)" class="btn-view-cart btn-buy-to-cart btn-clip btn-red btn-clip-mb">
					<span class="cart-bag"></span> MUA HÀNG
					</a>
					<div class="spacer-horizon-10"></div>
					<a id="btn-add-to-cart" href="javascript:void(0)" data-url="<?php the_permalink(193) ?>?id=<?php echo $page_id; ?>" class="btn-add-to-cart btn-clip btn-border-blue btn-clip-mb" id="book" data-id="<?php echo $page_id; ?>" >Thêm vào giỏ hàng</a> -->
					<!-- <div class="spacer-horizon-10 spacer-horizon-10-mb"></div>
					<?php echo load_wishlist_button($page_id);?> -->
				</div>
			</div>
       </div>         
    </div>         
    <?php /*?></div><?php */?>
    
    <div class="spacer-20"></div>
	<div class="main-info col-lg-12 col-12 colorGray 333 mb-padding-0" >
		<nav>
			<div class="nav nav-tabs" id="nav-tab" role="tablist">
				<a class="nav-link active" id="nav-description-tab" data-toggle="tab" href="#nav-description" role="tab" aria-controls="nav-description" aria-selected="true">Đặc điểm sản phẩm</a>
				<a class="nav-link" id="nav-size-guide-tab" data-toggle="tab" href="#nav-size-guide" role="tab" aria-controls="nav-size-guide" aria-selected="false">Hướng dẫn chọn size</a>
			</div>
		</nav><div class="spacer-20"></div>
		<div class="tab-content" id="nav-tabContent">
			<div class="tab-pane fade show active" id="nav-description" role="tabpanel" aria-labelledby="nav-description-tab">
				<?php echo get_field("description", $page_id); ?>
			</div>
			<div class="tab-pane fade" id="nav-size-guide" role="tabpanel" aria-labelledby="nav-size-guide-tab">
				<?php echo get_field("guide", $page_id); ?>
			</div>
		</div>
	</div>
</div> 
<div class="spacer-20"></div>
<div class="spacer-20"></div>
<section class="hot-items bg-gray">
    <div class="container-fluid">
        <div class="hot-items__title">
            <h3 class="ff-1">ĐÃ XEM GẦN ĐÂY </h3>
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

                    <?php $count_posts=0;
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
                        <?php endif; $count_posts++; ?>
                    <?php endforeach; ?>

                </div>
            </div>
        </div>
        <div class="loader"></div>

    </div>
</section><div class="spacer-40"></div>

<script type="text/javascript">
	var color_code='', size_code='', dealer_id = '', dealer_name='', dealer_address='', quantity=1 ;
     
    var size = $.trim($("#dropdownMenuOffset").text());
    size_code = $(".size-list .active").attr("size_code");
    var color = $(".color-list .active").attr("data-color");
    color_code = $(".color-list .active").attr("color_code");
    var image = $(".main-pic img").attr("data-image");
	
    var loading_svg = '<div class="loading-main-pic"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="margin:auto;background:#fff;display:block;" width="80px" height="80px" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid"> <g transform="rotate(0 50 50)"> <rect x="47" y="24" rx="3" ry="6" width="6" height="12" fill="#898989"> <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.9166666666666666s" repeatCount="indefinite"></animate> </rect> </g><g transform="rotate(30 50 50)"> <rect x="47" y="24" rx="3" ry="6" width="6" height="12" fill="#898989"> <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.8333333333333334s" repeatCount="indefinite"></animate> </rect> </g><g transform="rotate(60 50 50)"> <rect x="47" y="24" rx="3" ry="6" width="6" height="12" fill="#898989"> <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.75s" repeatCount="indefinite"></animate> </rect> </g><g transform="rotate(90 50 50)"> <rect x="47" y="24" rx="3" ry="6" width="6" height="12" fill="#898989"> <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.6666666666666666s" repeatCount="indefinite"></animate> </rect> </g><g transform="rotate(120 50 50)"> <rect x="47" y="24" rx="3" ry="6" width="6" height="12" fill="#898989"> <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.5833333333333334s" repeatCount="indefinite"></animate> </rect> </g><g transform="rotate(150 50 50)"> <rect x="47" y="24" rx="3" ry="6" width="6" height="12" fill="#898989"> <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.5s" repeatCount="indefinite"></animate> </rect> </g><g transform="rotate(180 50 50)"> <rect x="47" y="24" rx="3" ry="6" width="6" height="12" fill="#898989"> <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.4166666666666667s" repeatCount="indefinite"></animate> </rect> </g><g transform="rotate(210 50 50)"> <rect x="47" y="24" rx="3" ry="6" width="6" height="12" fill="#898989"> <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.3333333333333333s" repeatCount="indefinite"></animate> </rect> </g><g transform="rotate(240 50 50)"> <rect x="47" y="24" rx="3" ry="6" width="6" height="12" fill="#898989"> <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.25s" repeatCount="indefinite"></animate> </rect> </g><g transform="rotate(270 50 50)"> <rect x="47" y="24" rx="3" ry="6" width="6" height="12" fill="#898989"> <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.16666666666666666s" repeatCount="indefinite"></animate> </rect> </g><g transform="rotate(300 50 50)"> <rect x="47" y="24" rx="3" ry="6" width="6" height="12" fill="#898989"> <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.08333333333333333s" repeatCount="indefinite"></animate> </rect> </g><g transform="rotate(330 50 50)"> <rect x="47" y="24" rx="3" ry="6" width="6" height="12" fill="#898989"> <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="0s" repeatCount="indefinite"></animate> </rect> </g> </svg></div>';
     

    let currentColor = "red"

    function zoomGallery() {
        $(".main-pic .img-zoom").elevateZoom({
            gallery: 'gallery_01',
            cursor: 'pointer',
            easing: true,
            galleryActiveClass: 'active',
            imageCrossfade: true,
            //zoomType:"inner",
            loadingIcon: 'https://www.elevateweb.co.uk/spinner.gif',
        });
    }

    var swiper;

    $("document").ready(function() {

        $(document).on("click",".list-size li", function(e) {
            let that = $(this);
            let value = that.text();

            $(".list-size li").removeClass("active");
            that.addClass("active"); 
            size = value; 
        })

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
                960: {
                    slidesPerView: <?php echo $count_posts < 5 ? $count_posts : 5 ?>,
                    spaceBetween: 0,
                    navigation: {
                        nextEl: '.swiper-navi .swiper-button-next',
                        prevEl: '.swiper-navi .swiper-button-prev',
                    },
                }
            }
        });
        $(document).on("click", ".thumb-pics a", function(e) {
                e.preventDefault();
                let that = $(this);
                let img = that.attr("data-image");

                $(".thumb-pics a").removeClass("active");
                that.addClass("active");

                $(".img-zoom").attr("src", img);
            })
       // if ($(window).width() > 768) {
        //    zoomGallery();
        //} else {
            //$(document).on("click", ".thumb-pics a", function(e) {
//                e.preventDefault();
//                let that = $(this);
//                let img = that.attr("data-image");
//
//                $(".thumb-pics a").removeClass("active");
//                that.addClass("active");
//
//                $(".img-zoom").attr("src", img);
//				image = that.attr("data-image");
//            })
       //}

        $(document).on("click", ".color-list a", function() {
            var that = $(this);

            $(".color-list a").removeClass("active");
            that.addClass("active");
            color = that.attr("data-color"); 
            color_code = that.attr("color_code");
			image = $(".main-pic img").attr("data-image");
        
        });

        $(document).on("click", ".p-detail-size .dropdown-menu a", function() {
            var that = $(this);
            var value = that.text(); 
            $("#dropdownMenuOffset").html(value);
            size = value;
        })

        $(document).on("click", "#book-apparel", function(e) {
            e.preventDefault();
            let string = color.substring(1);
            quantity = $(".quantity").text();
            window.location.href = "<?php the_permalink(517); ?>/?post_id=<?php echo $page_id; ?>&size=" + size + "&color=" + string + "&quantity=" + quantity + "&img=" + image;

        });

        $(document).on("click", ".load-color", function(e) {
            let that = $(this);
            let index = that.attr("data-index");

            $.ajax({
                url: ajaxurl, // AJAX handler
                data: {
                    'action': 'load_color_ajax_handler',
                    'i': index,
                    'id': '<?php echo $page_id; ?>'
                },
                type: 'POST',
                beforeSend: function(xhr) {
                    $(".main-detail__pics").html("");
                    //$(".main-detail__pics").addClass("place");
                    $(".color-list").addClass("disable");
                    $(".main-detail__pics").append(loading_svg);
                },
                success: function(data) {
                    if (data) {
                       // $(".main-detail__pics").remove("place");

                        $(".main-detail__pics").append(data);
                        //if ($(window).width() > 768) {
                         //   zoomGallery();
                        //}
                        $(".color-list").removeClass("disable");
                        $(".loading-main-pic").remove();
                        // $("#result").text(parseData.count);

                    }
                }
            })
            loadDealer(index);
        });
        loadDealer(0);
        function loadDealer(index){
            $.ajax({
                url: ajaxurl, // AJAX handler
                data: {
                    'action': 'load_dealer_ajax_handler',
                    'i': index,
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
        	$('.promo-descrip.show').html('');
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
			if($(this).find('.in_out_stock').hasClass('tag-pre')){
				$('.promo-descrip.show').html('Thời gian nhận hàng dự kiến sẽ trễ.');
			}
			// $('.promo-descrip.show').html($(this).find('.promo-descrip.hide').text());
			$('.btn-add-to-cart').removeAttr("disabled");

        });
    })
</script>

<script src="<?php echo get_template_directory_uri() ?>/js/my-work.js?v=<?php echo time(); ?>"></script>
<?php 
	$ajax_action = 'insert_cookie_cart_item'; 
	//if(is_user_logged_in()) $ajax_action = 'update_order_booking'; 
	write_javascript_add_to_cart($bookType='apparel', $ajax_action);
?>
<?php
get_footer();
