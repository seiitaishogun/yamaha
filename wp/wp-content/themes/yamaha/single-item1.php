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


<section class="apparel-detail">
    <div class="main-detail">
        <div class="main-detail__pics place">

            <?php $items = get_field("list_image", $page_id); ?>

            <div class="main-pic">
                <img class="img-zoom" src="<?php echo $items[0]['image'][0]['sizes']['medium']; ?>" data-zoom-image="<?php echo $items[0]['image'][0]['sizes']['large']; ?>" />
            </div>

            <div class="thumb-pics" id="gallery_01">
                <?php
                if ($items[0]['image']) :
                    foreach ($items[0]['image'] as $k => $item) :
                ?>
                        <a href="#" class="thumb-gallery <?php echo $k === 0 ? 'active' : '' ?>" data-update="" data-image="<?php echo $item['sizes']['medium']; ?>" data-zoom-image="<?php echo $item['sizes']['large']; ?>">
                            <img src="<?php echo $item['sizes']['medium']; ?>" class="img-fluid" /></a>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
            <div class="spacer-20"></div>
            <div class="main-info">
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <a class="nav-link active" id="nav-description-tab" data-toggle="tab" href="#nav-description" role="tab" aria-controls="nav-description" aria-selected="true">Đặc điểm sản phẩm</a>
                        <a class="nav-link" id="nav-size-guide-tab" data-toggle="tab" href="#nav-size-guide" role="tab" aria-controls="nav-size-guide" aria-selected="false">Hướng dẫn chọn size</a>
                    </div>
                </nav>
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
        <div class="main-detail__content">
            <h5 class="p-detail-cat"><?php echo $terms[0]->name; ?></h5>
            <h3 class="p-detail-name"><?php echo get_the_title($page_id); ?></h3>
            <?php $price = get_field('price', $page_id); ?>
            <!-- * -->
                <div class="p-detail-price">
                    <div class="detail-price">
                    <span id="p-price" class="price"><?php echo number_format($price, 0, '.', '.'); ?></span>đ
                    </div>
                    <div class="spacer-horizon-10"></div>
                    <div class="discount-price"><?php echo number_format($price, 0, '.', '.'); ?>đ</div>
                </div>
            <!-- /* -->
            <div class="p-detail-color product__color">
                <span>Màu sắc</span>
                <div class="color-list">
                    <?php
                    if ($items) :
                        foreach ($items as $k => $item) :
                    ?>
                            <a class="<?php echo $k === 0 ? 'active' : '' ?> load-color" href="javascript:void(0)" data-index="<?php echo $k ?>" data-color="<?php echo $item['color']; ?>" data-price="<?php echo $price; ?>" data-image="<?php echo $item['image'][0]['sizes']['medium']; ?>">
                                <span style="background: <?php echo $item['color']; ?>;"></span>
                            </a>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
            <div class="p-detail-size">
                <?php $sizes = get_field('size', $page_id); ?>
                <span>Kích thước</span>
                <ul class="list-size">
                    <?php
                    if ($sizes) :
                        foreach ($sizes as $k => $size) :
                    ?>
                            <li class="<?php echo $k == 0 ? 'active' : '' ?>"><a href="javascript:void(0)"><?php echo $size; ?></a></li>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </ul>
                
            </div>
            <!-- * -->
                <div class="p-detail-quantity">
                    <span>Số lượng</span>
                    <button type="button" class="btn btn-link shadow-none text-decoration-none btn-mins">-</button>
                    <div class="quantity"></div>
                    <button type="button" class="btn btn-link shadow-none text-decoration-none btn-plus">+</button>
                </div>
                <div class="spacer-10"></div>
                <p class="promo-descrip">Chương trình giảm giá với nhiều món quà khuyến mãi đặc biệt. Áp dụng từ 16/10/2021 đến 30/10/2021.</p>
                <div class="spacer-10"></div>

                        <div class="form-group-important product-bike-dealer">
                        
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

                            ?>
                            <div id="dealerSelect" class="dropdown filter-dealer">
                                <a href="javascript:void(0)" class="btn btn-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <div class="title">
                                        <span class="text">Chọn Đại Lý</span>
                                    </div>
                                    <div class="label"></div>
                                </a>
                                <script type="text/javascript">
                                    var filter_dealer = {};
                                </script>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <?php foreach ($post_dealers as $e) : ?>
                                        <a class="dropdown-item" href="javascript:void(0)"  data-dealer_id="<?php echo $e->ID; ?>" data-name="<?php echo get_the_title($e->ID); ?>" data-address="<?php echo get_field("address", $e->ID); ?>">
                                            <!-- <?php echo get_field("address", $e->ID); ?> -->
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
                                                echo '<span class="tag">In stock</span>';
                                                $check = 0;
                                            } else {
                                                echo '<span class="tag-pre">Pre-order</span>';
                                            }
                                            ?>
                                            <span class="text-sm"><?php echo get_field("address", $e->ID); ?></span>
                                        </a>
                                    <?php endforeach ?>
                                </div>
                                <div class="invalid-feedback"></div>
                            </div>   
                        </div>

                        <div class="spacer-10"></div>
            <!-- */ -->
            <div class="box-action-apparel">   
                <a id="btn-add-to-cart" href="javascript:void(0)" data-url="<?php the_permalink(193) ?>?id=<?php echo $page_id; ?>" class="btn-add-to-cart btn-clip btn-red" id="book" data-id="<?php the_ID() ?>" data-color="javascript:$('.product__color-mb .acive').attr('data-color');" data-price="javascript:$('.product__color-mb .acive').attr('data-price');" data-quantity="1" data-size="M" data-dealer_id="javascript:dealer_id;">Thêm vào giỏ hàng</a>
                <div class="spacer-horizon-10"></div>
                <?php echo load_wishlist_button();?>
            </div>
            
            <div class="col-lg-12 col-12 align-items-center" style="margin-top: 20px; clear:both;">
					<a href="/booking" class="btn-view-cart btn-clip btn-border-red">
					<i class="fa fa-shopping-cart" aria-hidden="true" style="color: #171717"></i> XEM GIỎ HÀNG
				</a>
			</div>
        </div>
        
    </div>
    
</section>


<section class="hot-items bg-gray">
    <div class="container-fluid">
        <div class="hot-items__title">
            <h3 class="ff-1">ĐÃ XEM GẦN ĐÂY</h3>
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
                                <div class="product-item__price"><?php echo number_format($price, 0, ',', ','); ?> đ</div>
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
	var dealer_id = '', dealer_name='', dealer_address='', quantity=1 ;
    // var img = "<?php echo get_field("list_image", $page_id)[0]['image_zoom'] ?>";
    // var title = $(".p-detail-name").text();
    var size = $.trim($("#dropdownMenuOffset").text());
    var color = $(".color-list a.active").attr("data-color");
    var image = $(".color-list a.active").attr("data-image");
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
                768: {
                    slidesPerView: <?php echo $count_posts < 5 ? $count_posts : 5 ?>,
                    // allowTouchMove: false,
                    // centeredSlides: false,
                    // loop: false,
                }
            }
        });

        if ($(window).width() > 768) {
            zoomGallery();
        } else {
            $(document).on("click", ".thumb-pics a", function(e) {
                e.preventDefault();
                let that = $(this);
                let img = that.attr("data-image");

                $(".thumb-pics a").removeClass("active");
                that.addClass("active");

                $(".img-zoom").attr("src", img);
            })
        }

        $(document).on("click", ".color-list a", function() {
            var that = $(this);

            $(".color-list a").removeClass("active");
            that.addClass("active");
            color = that.attr("data-color");
            image = that.attr("data-image");
        
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
                    'action': 'load_color',
                    'i': index,
                    'id': '<?php echo $page_id; ?>'
                },
                type: 'POST',
                beforeSend: function(xhr) {
                    $(".main-detail__pics").html("");
                    $(".main-detail__pics").addClass("place");
                    $(".color-list").addClass("disable");
                    $(".main-detail__pics").append(loading_svg);
                },
                success: function(data) {
                    if (data) {
                        $(".main-detail__pics").remove("place");

                        $(".main-detail__pics").append(data);
                        if ($(window).width() > 768) {
                            zoomGallery();
                        }
                        $(".color-list").removeClass("disable");
                        $(".loading-main-pic").remove();
                        // $("#result").text(parseData.count);

                    }
                }
            })
        });
        $(document).on('click', '.filter-dealer .dropdown-item', function() {
            var that = $(this);
            var text = that.html();
            dealer_name = that.attr('data-name');
            dealer_address = that.attr('data-address');

            dealer_id = that.attr('data-dealer_id');
			
            $(".filter-dealer .title").html(text);
            $(".filter-dealer .label").html(text);

            filter_dealer = {
				dealer_id:dealer_id,
                address_name: dealer_name,
                address: dealer_address,
            };
			$('.divdeposit').show();
			$('.btn-add-to-cart').removeAttr("disabled");

        });
    })
</script>

<script src="<?php echo get_template_directory_uri() ?>/js/my-work.js?v=<?php echo time(); ?>"></script>
<?php 
	$ajax_action = 'update_cookie_booking_item'; 
	if(is_user_logged_in()) $ajax_action = 'update_order_booking'; 
	write_javascript_add_to_cart($bookType='bike', $ajax_action);
?>
<?php
get_footer();
