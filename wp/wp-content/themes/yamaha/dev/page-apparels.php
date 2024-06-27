<?php
get_header();
// $page_id = get_the_ID();
$page_id = get_queried_object_id();

$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

global $arrCat_apparel_Show, $arrCat_bike_Show ;

$argc = array(
    'post_type' => 'item',
    'post_status' => 'publish',
    'posts_per_page' => -1,
    'meta_key' => 'price',
    'orderby' => 'meta_value_num',
    'order' => 'ASC',
    'suppress_filters' => true,
	'tax_query' => array(
					'taxonomy' => 'apparels',
					'field' => 'term_id',
					'terms' =>  $arrCat_apparel_Show
				)
);

$args = array(
    'post_type' => 'item',
    'paged' => $paged,
    'post_status' => 'publish',
    'posts_per_page' => 10,
    'meta_key' => 'price',
    'orderby' => 'meta_value_num',
    'order' => 'ASC',
    'suppress_filters' => true, 
	'tax_query' => array(
					'taxonomy' => 'apparels',
					'field' => 'term_id',
					'terms' =>  $arrCat_apparel_Show
				)
			 
);

$query = new WP_Query($args);
$queryc = new WP_Query($argc);

$posts = $query->posts;

// print_r($paged);die;

$max = $queryc->post_count;
$f_load_post = 0;

?>

<?php echo get_template_part('includes/header/header-toolbar'); ?>

<section class="banner slider banner-full banner-full--mb">
    <div class="navigator__breadcrumbs">
        <div class="container-fluid">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo get_permalink(5) ?>">TRANG CHỦ</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?php echo get_the_title($page_id); ?></li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="swiper-container-fluid mySwiper">
        <div class="swiper-wrapper">
            <?php
            $banner = get_field("banner_background", $page_id);
            if ($banner) :
                foreach ($banner as $k => $item) :

                    $swiper_auto = '';
                    if ($slider['timing_slide']) {
                        $swiper_auto = 'data-swiper-autoplay="' . $slider['timing_slide'] . '"';
                    }

            ?>
                    <div class="swiper-slide <?php echo $k === 0 ? 'active' : '' ?>" <?php echo $swiper_auto; ?>>
                        <picture>
                            <source media="(min-width:768px)" srcset="<?php echo $item['image_background']; ?>">
                            <img src="<?php echo $item['image_model']; ?>" alt="" class="d-block w-100" />
                        </picture>
                        <div class="carousel-caption">
                            <h5>TRANG PHỤC</h5>
                            <h3><?php echo $item['headline']; ?></h3>
                            <?php if ($item['link']) : ?>
                                <button type="button" class="btn-clip btn-border-white w-auto" onclick="location.href='<?php echo $item['link'] ?>'">Xem thêm</button>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach;  ?>
            <?php endif;  ?>
        </div>
        <div class="swiper-pagination"></div>
    </div>
</section>


<section class="categories-block">
    <div class="container-fluid">
        <div class="categories-block__title">
            <h3 class="text-uppercase">Danh mục sản phẩm</h3>
            <div class="swiper-navi">
                <div class="swiper-button-prev swiper-button-prev--custom"><img src="<?php echo get_template_directory_uri() ?>/img/ic_long-left.svg" alt=""></div>
                <div class="swiper-button-next swiper-button-next--custom"><img src="<?php echo get_template_directory_uri() ?>/img/ic_long-right.svg" alt=""></div>
            </div>
        </div>
        <div class="categories-list d-none d-md-block">
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    <?php
                    // $cate = get_field("categories", $page_id);
                    $categories = get_terms(array(
                        'taxonomy' => 'apparels',
                        'hide_empty' => false, 
						'include' => $arrCat_apparel_Show
                    ));
                    if ($categories) :
                        foreach ($categories as $k => $item) :
                            $status = get_field('status_category', $item);
                            if ($status > 0) :
                    ?>
                                <a href="<?php echo get_term_link($item->slug, 'apparels'); ?>" class="categories-item swiper-slide">
                                    <img src="<?php echo get_field('image_category', $item) ?>" alt="" />
                                    <div class="categories-item__title"><?php echo $item->name; ?></div>
                                </a>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="categories-list d-md-none">
            <?php
            $count_k = 0;
            if ($categories) :
                foreach ($categories as $k => $item) :
                    $status = get_field('status_category', $item);
                    if ($status > 0) :
                        $count_k++;
            ?>
                        <a href="<?php echo get_term_link($item->slug, 'apparels'); ?>" class="categories-item swiper-slide <?php echo $count_k > 4 ? 'hide' : '' ?>">
                            <img src="<?php echo get_field('image_category', $item) ?>" alt="" />
                            <div class="categories-item__title"><?php echo $item->name; ?></div>
                        </a>

                    <?php endif; ?>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        <div class="view-more d-block d-md-none">
            <button type="button" onclick="showCat()" class="btn-clip btn-red w-auto btn-viewall">XEM TẤT CẢ</button>
        </div>
    </div>
</section>

<section class="hot-items">
    <div class="container-fluid px-md-0">
        <div class="hot-items__title">
            <h3>SẢN PHẨM BÁN CHẠY</h3>
            <div class="dropdown filter">
                <button type="button" class="btn btn-filter dropdown-toggle" id="dropdownMenuOffset" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Giá từ: Thấp - Cao
                </button>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuOffset">
                    <a class="dropdown-item" href="javascript:void(0)" data-filter="price-to-high">Giá từ: Thấp - Cao</a>
                    <a class="dropdown-item" href="javascript:void(0)" data-filter="price-to-low">Giá từ: Cao - Thấp</a>
                    <!-- <a class="dropdown-item" href="javascript:void(0)" data-filter="hot">Sản phẩm bán chạy</a>
                    <a class="dropdown-item" href="javascript:void(0)" data-filter="all">Tất cả sản phẩm</a> -->
                </div>
            </div>
        </div>
        <div class="product-list">
            <?php
            $sale = '';
            ?>
            <?php foreach ($posts as $item) : ?>
                <?php $types = get_the_terms($item->ID, 'tag'); ?>
                <?php
                foreach ($types as $type) {
                    if ($type->slug === 'sale-off') {
                        $sale = 'sale';
                    }
                }
                $price = get_field('price', $item->ID);
                ?>
                <a class="product-item product-last <?php echo $sale;
                                                    $sale = ''; ?>" href="<?php echo get_permalink($item->ID); ?>">
                    <img src="<?php echo get_field("list_image", $item->ID)[0]['image'][0]['sizes']['medium']; ?>" alt="" />
                    <div class="product-item__title"><?php echo get_the_title($item->ID); ?></div>
                    <div class="product-item__price"><?php echo currencyFormat($price); ?></div>
                </a>
            <?php endforeach; ?>
        </div>
        <div class="loader"></div>


        <div class="text-center">
            <?php if ($max >= 10) : ?>
                <a href="javascript: void(0);" id="loadmore" class="btn-clip btn-border-red w-auto">XEM THÊM</a>
            <?php endif ?>
        </div>

    </div>
</section>

<script type="text/javascript">
    var paged = <?php echo $paged; ?>;
    var max_page = <?php echo $max; ?>;
    var loading_svg = '<div class="w-100"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="margin:auto;background:#fff;display:block;" width="80px" height="80px" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid"> <g transform="rotate(0 50 50)"> <rect x="47" y="24" rx="3" ry="6" width="6" height="12" fill="#898989"> <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.9166666666666666s" repeatCount="indefinite"></animate> </rect> </g><g transform="rotate(30 50 50)"> <rect x="47" y="24" rx="3" ry="6" width="6" height="12" fill="#898989"> <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.8333333333333334s" repeatCount="indefinite"></animate> </rect> </g><g transform="rotate(60 50 50)"> <rect x="47" y="24" rx="3" ry="6" width="6" height="12" fill="#898989"> <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.75s" repeatCount="indefinite"></animate> </rect> </g><g transform="rotate(90 50 50)"> <rect x="47" y="24" rx="3" ry="6" width="6" height="12" fill="#898989"> <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.6666666666666666s" repeatCount="indefinite"></animate> </rect> </g><g transform="rotate(120 50 50)"> <rect x="47" y="24" rx="3" ry="6" width="6" height="12" fill="#898989"> <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.5833333333333334s" repeatCount="indefinite"></animate> </rect> </g><g transform="rotate(150 50 50)"> <rect x="47" y="24" rx="3" ry="6" width="6" height="12" fill="#898989"> <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.5s" repeatCount="indefinite"></animate> </rect> </g><g transform="rotate(180 50 50)"> <rect x="47" y="24" rx="3" ry="6" width="6" height="12" fill="#898989"> <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.4166666666666667s" repeatCount="indefinite"></animate> </rect> </g><g transform="rotate(210 50 50)"> <rect x="47" y="24" rx="3" ry="6" width="6" height="12" fill="#898989"> <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.3333333333333333s" repeatCount="indefinite"></animate> </rect> </g><g transform="rotate(240 50 50)"> <rect x="47" y="24" rx="3" ry="6" width="6" height="12" fill="#898989"> <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.25s" repeatCount="indefinite"></animate> </rect> </g><g transform="rotate(270 50 50)"> <rect x="47" y="24" rx="3" ry="6" width="6" height="12" fill="#898989"> <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.16666666666666666s" repeatCount="indefinite"></animate> </rect> </g><g transform="rotate(300 50 50)"> <rect x="47" y="24" rx="3" ry="6" width="6" height="12" fill="#898989"> <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.08333333333333333s" repeatCount="indefinite"></animate> </rect> </g><g transform="rotate(330 50 50)"> <rect x="47" y="24" rx="3" ry="6" width="6" height="12" fill="#898989"> <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="0s" repeatCount="indefinite"></animate> </rect> </g> </svg></div>';
    var filter_tag = 'price-to-high';

    $(document).ready(function() {
        var swiper = new Swiper(".mySwiper", {
            // Disable preloading of all images
            preloadImages: false,
            // Enable lazy loading
            lazy: true,
            loop: true,
            effect: 'fade',
            <?php
            $autoplay_slider = get_field('autoplay_slider', $page_id);
            ?>
            <?php if ($autoplay_slider) : ?>
                autoplay: {
                    delay: 5000,
                    disableOnInteraction: false,
                },
            <?php endif; ?>
            fadeEffect: {
                crossFade: true
            },
            navigation: {
                nextEl: '.mySwiper .swiper-button-next',
                prevEl: '.mySwiper .swiper-button-prev',
            },
            pagination: {
                el: '.mySwiper .swiper-pagination',
                type: 'bullets',
                clickable: true,
                // renderBullet: function(index, className) {
                //     return '<span class="' + className + '"><span class="halfclip"><span class="halfcircle clipped"></span></span><span class="halfcircle fixed"></span></span>';
                // },
            },
            on: {
                afterInit: function() {
                    let circle = '<div class="circle"></div>';
                    let active = $(".mySwiper .swiper-slide-active").attr("data-swiper-autoplay");
                    let duration_circle = 5000;

                    if (typeof active !== 'undefined') {
                        duration_circle = parseInt(active);
                    }

                    $(".mySwiper .circle").remove();
                    $(".mySwiper .swiper-pagination-bullet-active").append(circle);

                    $(".mySwiper .circle").circleProgress({
                        size: 16,
                        thickness: 1,
                        value: 1,
                        startAngle: -1.55,
                        emptyFill: 'rgba(0, 0, 0, .001)',
                        fill: {
                            color: '#ff0000'
                        },
                        animation: {
                            duration: duration_circle
                        }
                    });
                },
                slideChangeTransitionEnd: function() {
                    let circle = '<div class="circle"></div>';
                    let active = $(".mySwiper .swiper-slide-active").attr("data-swiper-autoplay");
                    let duration_circle = 5000;

                    if (typeof active !== 'undefined') {
                        duration_circle = parseInt(active);
                    }

                    $(".mySwiper .circle").remove();
                    $(".mySwiper .swiper-pagination-bullet-active").append(circle);

                    $(".mySwiper .circle").circleProgress({
                        size: 16,
                        thickness: 1,
                        value: 1,
                        startAngle: -1.55,
                        emptyFill: 'rgba(0, 0, 0, .001)',
                        fill: {
                            color: '#ff0000'
                        },
                        animation: {
                            duration: duration_circle
                        }
                    });
                }
            }
        });

        var swiperCat = new Swiper('.categories-list .swiper-container', {
            slidesPerView: 5,
            spaceBetween: 8,
            navigation: {
                nextEl: '.swiper-navi .swiper-button-next',
                prevEl: '.swiper-navi .swiper-button-prev',
            }
        });

        //$('.filter .dropdown-item').eq(0).attr('data-filter');
        load_ajax_data_filter(filterData = $('.filter .dropdown-item').eq(0).attr('data-filter'));

        $(document).on('click', '.filter .dropdown-item', function() {
            var that = $(this);
            var text = that.text();
            var filter = that.attr('data-filter');

            $(".btn-filter").text(text);
            filter_tag = filter;
            paged = 1;

            load_ajax_data_filter(filterData = filter);

            /*$.ajax({ // you can also use $.post here
                url: ajaxurl, // AJAX handler
                data: {
                    'action': 'filter_items',
                    'filter': filter,
                },
                type: 'POST',
                beforeSend: function(xhr) {
                    $(".product-list .product-item").remove();
                    $("#loadmore").hide();
                    $(".product-list").append(loading_svg);
                },
                success: function(data) {

                    if (data) {
                        $(".product-list").append(data);

                        $(".product-list .w-100").remove();
                        $("#loadmore").show();
                    }
                }
            });*/
        });

        function load_ajax_data_filter(filterData){
             $.ajax({ // you can also use $.post here
                url: ajaxurl, // AJAX handler
                data: {
                    'action': 'filter_items',
                    'filter': filterData,
                },
                type: 'POST',
                beforeSend: function(xhr) {
                    $(".product-list .product-item").remove();
                    $("#loadmore").hide();
                    $(".product-list").append(loading_svg);
                },
                success: function(data) {

                    if (data) {
                        $(".product-list").append(data);

                        $(".product-list .w-100").remove();
                        $("#loadmore").show();
                    }
                }
            });
        }

        $(document).on("click", "#loadmore", function() {
            var that = $(this),
                data = {
                    'action': 'loadmoreApparel',
                    'paged': paged,
                    'filter': filter_tag,
                };

            $.ajax({ // you can also use $.post here
                url: ajaxurl, // AJAX handler
                data: data,
                type: 'POST',
                beforeSend: function(xhr) {
                    that.text('Đang tải...'); // change the button text, you can also add a preloader image
                },
                success: function(data) {
                    if (data) {
                        let res = $.parseJSON(data);
                        that.text('XEM THÊM');
                        $(".product-last:last-child").after(res.data);
                        paged++;


                        let items = $(".product-list .product-item").length;
                        // console.log(paged + "  " + max_page);
                        if (items < max_page) {
                            that.text('Xem Thêm');

                        } else {
                            that.hide(); // if last page, remove the button
                        }

                        // filter_tag = '';
                        // you can also fire the "post-load" event here if you use a plugin that requires it
                        // $( document.body ).trigger( 'post-load' );
                    } else {
                        that.text('Xem Thêm');
                        //that.hide(); // if no data, remove the button as well
                    }
                }
            });

        });

    });



    function showCat() {
        $('.btn-viewall').remove();
        // document.querySelectorAll(".categories-item").forEach(elem => {
        //     elem.classList.remove("hidden")
        // })
        $(".categories-list .categories-item").removeClass("hide");
    }
</script>

<?php
get_footer();
