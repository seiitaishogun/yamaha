<?php
get_header();
$page_id = get_queried_object_id();
global $arrCat_apparel_Show, $arrCat_bike_Show;

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
    'hide_empty' => true,
    'include' => $arrCat_bike_Show
]);

?>

<script type="text/javascript">    
    window.location.href='https://www.revzoneyamaha-motor.com.vn/service/';
</script>

<style type="text/css">
    @import url(https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css);
</style>

<div class="navigator__breadcrumbs">
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">TRANG CHỦ</a></li>
                <li class="breadcrumb-item"><a href="<?php echo get_permalink(110); ?>">DỊCH VỤ</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo get_the_title($page_id); ?></li>
            </ol>
        </nav>
    </div>
</div>

<section class="cat-banner banner-single">
    <div class="container-fluid">
        <?php $banner = get_field('banner_header', $page_id); ?>
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



<section class="service-detail">
    <!-- <div class="serive-package-all-mb">
        <div class="swiper-list-item swiper-container">
            <div class="swiper-wrapper">
                <?php
                $args = array(
                    'post_type' => 'product',
                    'post_status' => 'publish',
                );
                $query = new WP_Query($args);
                $posts = $query->posts;


                foreach ($posts as $key => $item) :
                    $group = get_field("feature_product", $item->ID);
                ?>
                    <div class="swiper-slide <?php echo $key === 0 ? 'active' : '' ?>" data-name="<?php echo get_the_title($item->ID) ?>">
                        <img src="<?php echo $group['feature_img']; ?>" alt="">
                        <strong><?php echo get_the_title($item->ID); ?></strong>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
    </div> -->
    <div class="container-fluid">
        <div class="category-menu__moto">
            <div class="row">
                <?php
                $package_term = get_terms(array(
                    'taxonomy' => 'type_services',
                    'hide_empty' => false,
                ));
                ?>

                <div class="category-menu__nav">
                    <div class="category-menu__nav-stick">
                        <label for="" class="category-menu__headline">Loại Dịch Vụ</label>
                        <ul class="category-menu__category">
                            <?php $count_check = 0;
                            $is_slug = isset($_GET['is_slug']) ? $_GET['is_slug'] : '';
                            ?>
                            <input type="hidden" class="is_slug" name="is_slug" value="<?php echo $is_slug; ?>" />

                            <?php foreach ($package_term as $key => $_m) : ?>
                                <?php
                                $count_check++;
                                if ($count_check == 1) {
                                    $type = $_m->slug;
                                }
                                ?>
                                <!-- <a href="#<?php echo $_m->slug ?>"> -->
                                <a href="?is_slug=<?php echo $_m->slug ?>">
                                    <li class="<?php echo $is_slug == $_m->slug ? 'active' : '' ?>" data-slug="<?php echo $_m->slug ?>">
                                        <span><?php echo $_m->name; ?></span>
                                        <div class="line"></div>
                                    </li>
                                </a>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
                
                <div class="category-menu__list-item">
                    <section class="menu-all-service">
                        <?php
                        $terms =  get_terms(array(
                            'taxonomy' => 'products',
                            'hide_empty' => false,
                        ));
                        $check = 0;
                        $check2 = 0;
                        $first = '';
                        ?>
                        <div class="menuSwiper">
                            <ul class="main-menu swiper-wrapper">
                                <li class="swiper-slide main-menu__item is-active" data-id="tab-all" data-model="tat-ca"><a href="#tab-all" data-toggle="tab">Tất cả</a></li>
                                <?php foreach ($terms as $k => $v) : ?>
                                    <?php
                                    $status = get_field('status_category', $v);
                                    ?>
                                    <?php if ($status > 0) :

                                        $f_post = get_posts(array(
                                            'post_type' => 'product',
                                            'post_status' => 'publish',
                                            'tax_query' => array(
                                                array(
                                                    'taxonomy' => 'products',
                                                    'field' => 'slug',
                                                    'terms' =>  $v->slug,
                                                )
                                            )
                                        ));
                                        $p_f_post = $f_post[0]->ID;
                                        // print_r($f_post);die;
                                    ?>
                                        <li class="swiper-slide main-menu__item" data-type="<?php echo $package_term[0]->slug; ?>" data-selector="tab-<?php echo str_replace(" ", "", $v->name) ?>" data-name="<?php echo $p_f_post; ?>" data-model="<?php echo $v->slug; ?>"><a href="#tab-<?php echo str_replace(" ", "", $v->name) ?>" data-toggle="tab"><?php echo $v->name; ?></a></li>
                                    <?php endif ?>

                                <?php endforeach ?>
                            </ul>
                        </div>
                        <div class="swiper-scrollbar"></div>
                    </section>

                    <script>
                        var name = '';
                    </script>

                    <div class="service-package-tab tab-content">
                        <div class="tab-pane fade show active" id="tab-all" role="tabpanel" aria-labelledby="TATCA-tab">
                        </div>
                        <?php foreach ($terms as $k => $v) : ?>
                            <?php
                            $status = get_field('status_category', $v);
                            ?>
                            <?php if ($status > 0) :
                                $check2++;
                            ?>
                                <div class="mb-mobile-svpack tab-pane fade" id="tab-<?php echo str_replace(" ", "", $v->name) ?>" role="tabpanel" aria-labelledby="<?php echo str_replace(" ", "", $v->name) ?>-tab">
                                    <div class="swiper-list-item swiper-container">
                                        <div class="swiper-wrapper">
                                            <?php
                                            $args = array(
                                                'post_type' => 'product',
                                                'post_status' => 'publish',
                                                'tax_query' => array(
                                                    array(
                                                        'taxonomy' => 'products',
                                                        'field' => 'term_id',
                                                        'terms' => $v->term_taxonomy_id,
                                                    ),
                                                )
                                            );
                                            $query = new WP_Query($args);
                                            $posts = $query->posts;

                                            foreach ($posts as $key => $item) :
                                                $group = get_field("feature_product", $item->ID);
                                            ?>
                                                <div class="swiper-slide" data-name="<?php echo $item->ID; ?>">
                                                    <img src="<?php echo $group['feature_img']; ?>" alt="">
                                                    <strong><?php echo get_the_title($item->ID); ?></strong><span><?php echo $bike ?></span>
                                                </div>
                                            <?php endforeach ?>
                                        </div>
                                    </div>

                                </div>
                            <?php endif ?>

                        <?php endforeach ?>
                        <script type="text/javascript">
                            var bike = 'tat-ca';
                            var type = ''
                        </script>

                        <div class="list-service">
                            <div class="row sm-gutters">
                                <?php foreach ($service['package'] as $k => $e) : ?>
                                    <div class="col-6">
                                        <div class="background-image" style="background-image: url(<?php echo $e['image_background']; ?>);">
                                            <div class="d-md-flex">
                                                <div class="icon"><img src="<?php echo get_template_directory_uri() ?>/img/service/icons/icon-<?php echo $k + 1; ?>.svg" alt="icon"></div>
                                                <div class="info">
                                                    <h3 class="colorWhite exbold ff-1"><?php echo $e['title']; ?></h3>
                                                    <div class="d-none d-md-block" style="height: 8px;"></div>
                                                    <p class="price"><?php echo number_format($e['price'], 0, ',', ','); ?> ₫</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>

                    <div class="d-none d-md-block" style="height: 24px;"></div>

                    <div class="service-package-list">
                        <div class="list-service">
                            <div class="row sm-gutters">

                                <?php


                                $args_service = array(
                                    'post_type' => 'package',
                                    'paged' => 1,
                                    'post_status' => 'publish',
                                    'posts_per_page' => -1,
                                    'suppress_filters' => true,

                                );
                                $ser_query = new WP_Query($args_service);

                                $service = $ser_query->posts;
                                $service_count = $ser_query->post_count;
                                $read = 0;
                                // print_r($service_count);die;
                                ?>
                                <?php
                                if (count($service) > 0) {
                                    foreach ($service as $k => $e) : ?>
                                        <?php
                                        if ($k > 5) {
                                            $read = 1;
                                        }

                                        ?>
                                        <div class="col-6 <?php echo $k > 5 ? 'hide' : '' ?>">
                                            <div class="background-image" style="background-image: url(<?php echo get_field("image", $e->ID); ?>);">
                                                <div class="block-service">
                                                    <div class="slug">
                                                        <span class="one-line"><?php echo get_the_terms($e->ID, 'type_services')[0]->name ?><strong>&nbsp; • &nbsp;</strong></span>
                                                        <span><?php echo get_field("number_service", $e->ID); ?> Dịch vụ <strong>&nbsp; • &nbsp;</strong></span>
                                                        <span><?php echo get_field("month", $e->ID); ?> Tháng</span>
                                                    </div>
                                                    <div class="d-md-flex justify-content-between w-100">
                                                        <div class="info">
                                                            <h3 class="colorWhite exbold ff-1"><?php echo get_the_title($e->ID); ?></h3>
                                                            <p class="price"><?php echo number_format(get_field('price', $e->ID), 0, ',', ','); ?> ₫</p>
                                                        </div>
                                                        <a href="<?php echo get_permalink($e->ID) ?>" class="btn-clip btn-border-white w-auto align-self-center">Xem chi tiết <span class="ico__chev-right"></span></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach;
                                } else { ?>
                                    <div style="color: #000">Chưa có gói dịch vụ</div>
                                <?php } ?>

                                <div class="text-center col-12 loadmore-desk <?php echo $read != 0 ? '' : 'hide' ?>">
                                    <div style="height: 10px;"></div>
                                    <a href="javascript: void(0);" class="btn-clip btn-border-red w-auto loadmore" data-id="" data-bike="" data-slug="">Xem Thêm</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="service-package-list-mb">
                        <?php foreach ($package_term as $key => $_m) : ?>
                            <h2 class="colorGray ff-1 text-uppercase" id="<?php echo $_m->slug ?>"><?php echo $_m->name; ?></h2>
                            <div style="height: 16px"></div>
                            <div class="list-service list-service-<?php echo $_m->term_taxonomy_id; ?>">
                                <div class="row sm-gutters">
                                    <?php

                                    // $first_mb_slug = get_the_terms($_m->term_taxonomy_id, 'type_services');

                                    $args_service_mb = array(
                                        'post_type' => 'package',
                                        'paged' => 1,
                                        'post_status' => 'publish',
                                        'posts_per_page' => -1,
                                        'suppress_filters' => true,
                                        'tax_query' => array(
                                            array(
                                                'taxonomy' => 'type_services',
                                                'field' => 'slug',
                                                'terms' => $_m->slug,
                                            )
                                        )
                                    );

                                    $ser_query_mb = new WP_Query($args_service_mb);

                                    $service_mb = $ser_query_mb->posts;
                                    $service_mb_count = $ser_query_mb->post_count;
                                    $service_mb_max = $ser_query_mb->max_num_pages;
                                    $read_mb = 0;
                                    // print_r($service_mb);die;


                                    ?>
                                    <?php foreach ($service_mb as $k => $e) : ?>
                                        <?php
                                        $types = get_the_terms($e->ID, 'type_services')[0];
                                        if ($k > 5) {
                                            $read_mb = 1;
                                        }

                                        ?>
                                        <div class="col-6 <?php echo $k > 5 ? 'hide' : '' ?>">
                                            <div class="background-image" style="background-image: url(<?php echo get_field("image", $e->ID); ?>);">
                                                <a href="<?php echo get_permalink($e->ID) ?>" class="stretched-link"></a>
                                                <div class="caret"></div>
                                                <div class="block-service">
                                                    <div class="slug">
                                                        <span class="one-line"><?php echo $types->name ?><strong>&nbsp; • &nbsp;</strong></span>
                                                        <span><?php echo get_field("number_service", $e->ID); ?> Dịch vụ <strong>&nbsp; • &nbsp;</strong></span>
                                                        <span><?php echo get_field("month", $e->ID); ?> Tháng</span>
                                                    </div>
                                                    <div class="d-md-flex justify-content-between w-100">
                                                        <div class="info">
                                                            <h3 class="colorWhite exbold ff-1"><?php echo get_the_title($e->ID); ?></h3>
                                                            <p class="price"><?php echo number_format(get_field('price', $e->ID), 0, ',', ','); ?> ₫</p>
                                                        </div>
                                                        <a href="<?php echo get_permalink($e->ID) ?>" class="btn-clip btn-border-white w-auto align-self-center">Xem chi tiết <span class="ico__chev-right"></span></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                    <?php wp_reset_query(); ?>
                                    <div class="text-center col-12 loadmore-mb <?php echo $read_mb != 0 ? '' : 'hide' ?>">
                                        <div style="height: 10px;"></div>
                                        <a href="javascript: void(0);" class="btn-clip btn-border-red w-auto loadmore" data-id="<?php echo $_m->term_taxonomy_id ?>">Xem Thêm</a>
                                    </div>
                                    <?php $read_mb = 0 ?>
                                </div>
                            </div>
                        <?php endforeach ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript">
    var size = '';
    $(document).ready(function() {

        var swiper = new Swiper(".menu-all-service .menuSwiper", {
            slidesPerView: "auto",
            spaceBetween: 30,
            // breakpoints: {
            //     768: {
            //         slidesPerView: 5,
            //     }
            // }
        });

        new Swiper(".swiper-list-item.swiper-container", {
            slidesPerView: "auto",
            spaceBetween: 10,
            observer: true,
            observeParents: true,
        });

        $(document).on('click', '.main-menu a', function(event) {
            event.preventDefault();

            var href = $(this).attr('href').substr(1);

            $(".service-package-tab .tab-pane").removeClass("show active");
            $("#" + href).addClass("show active");
        });

        $(document).on('click', '.menu-all-service .main-menu__item', function() {
            var that = $(this);
            var item = that.attr("data-name");
            var model = that.attr("data-model");
            var e = that.attr("data-selector");
            var slug = $('.is_slug').val();

            //set localStorage
            localStorage.setItem("clicked", $(this).index());

            $(".category-menu__category a li").removeClass("active");
            $(".service-package-tab .swiper-list-item .swiper-slide").removeClass("active");

            $(".menu-all-service .main-menu__item").removeClass("is-active");
            that.addClass("is-active");

            if (slug) {
                type = slug;
                name = item;
                $(".category-menu__category a li[data-slug=" + slug + "]").addClass("active");
                if (model !== "tat-ca") {
                    $("#" + e + " .swiper-list-item .swiper-slide:first-child").addClass("active");
                } else {
                    name = "";
                }
            } else {
                if (model !== "tat-ca") {
                    $(".category-menu__category a:first-child li").addClass("active");

                    type = that.attr("data-type");
                    name = item;

                    $("#" + e + " .swiper-list-item .swiper-slide:first-child").addClass("active");
                } else {
                    type = "";
                    name = "";
                }
            }

            bike = model;


            if ($(window).width() > 1024) {
                $.ajax({
                    url: ajaxurl, // AJAX handler
                    data: {
                        'action': 'get_serviceBy_type',
                        'type': type,
                        'bike': bike,
                        'name': name,
                    },
                    type: 'POST',
                    beforeSend: function(xhr) {
                        $(".service-package-list .loadmore-desk").remove();
                        $(".service-package-list .list-service .row .col-6").remove();
                        $(".service-package-list .list-service .row .nodata").remove();
                    },
                    success: function(data) {
                        if (data) {
                            // var item = $.parseJSON(data);

                            $(".service-package-list .list-service .row").append(data);

                        } else {
                            $(".service-package-list .list-service .row").append('<div class="nodata" style=" color: #000; padding-left: 20px;">Chưa có gói dịch vụ</div>');
                        }
                    }
                })
            } else {
                $.ajax({
                    url: ajaxurl, // AJAX handler
                    data: {
                        'action': 'get_serviceBy_type_mb',
                        'name': name,
                        'type': type,
                        'bike': bike,
                    },
                    type: 'POST',
                    beforeSend: function(xhr) {
                        $(".service-package-list-mb").empty();
                    },
                    success: function(data) {
                        if (data) {
                            // var item = $.parseJSON(data);

                            $(".service-package-list-mb").append(data);


                        }
                    }
                })
            }




        })

        $(document).on('click', '.service-package-tab .swiper-list-item .swiper-slide', function() {
            var that = $(this);
            var item = that.attr("data-name");

            name = item.replaceAll(" ", '');

            $(".swiper-list-item .swiper-slide").removeClass("active");
            that.addClass("active");


            $.ajax({
                url: ajaxurl, // AJAX handler
                data: {
                    'action': 'get_serviceBy_type',
                    'type': type,
                    'bike': bike,
                    'name': name,
                },
                type: 'POST',
                beforeSend: function(xhr) {
                    $(".service-package-list .list-service .row .col-6").remove();
                },
                success: function(data) {
                    if (data) {
                        // var item = $.parseJSON(data);

                        $(".service-package-list .list-service .row").append(data);

                        // let first = $(".filter-dealer .dropdown-menu .dropdown-item:first-child").html();
                        // let address_f = $(".filter-dealer .dropdown-menu .dropdown-item:first-child").attr("data-address");

                        // filter_dealer = {};
                        // $(".filter-dealer .title").html("Chọn Đại Lý");
                        // $(".filter-dealer .label").html("");
                    }
                }
            })
        })

        $(document).on('click', '.category-menu__category li', function() {
            var that = $(this);
            var text = that.text();
            type = that.attr('data-slug');

            $('.category-menu__category li').removeClass('active');
            $(this).addClass('active');

            // console.log(name);
            $.ajax({
                url: ajaxurl, // AJAX handler
                data: {
                    'action': 'get_serviceBy_type',
                    'type': type,
                    'bike': bike,
                    'name': name,
                },
                type: 'POST',
                beforeSend: function(xhr) {
                    $(".service-package-list .list-service .row .col-6").remove();
                },
                success: function(data) {
                    if (data) {
                        // var item = $.parseJSON(data);

                        $(".service-package-list .list-service .row").append(data);

                        // let first = $(".filter-dealer .dropdown-menu .dropdown-item:first-child").html();
                        // let address_f = $(".filter-dealer .dropdown-menu .dropdown-item:first-child").attr("data-address");

                        // filter_dealer = {};
                        // $(".filter-dealer .title").html("Chọn Đại Lý");
                        // $(".filter-dealer .label").html("");
                    }
                }
            })
        });


        $(document).on("click", ".loadmore-desk .loadmore", function(e) {
            e.preventDefault();

            $(".service-package-list .row .col-6.hide").each(function(i, v) {
                var that = $(this);
                if (i < 5) {
                    that.removeClass("hide");
                }
                if ($(".service-package-list .row .col-6.hide").length == 0) {
                    $(".service-package-list .loadmore-desk").remove();
                }
            })

        });

        $(document).on("click", ".loadmore-mb .loadmore", function(e) {
            e.preventDefault();
            var $this = $(this);
            var id = $this.attr("data-id");

            $(".list-service-" + id + " .row .col-6.hide").each(function(i, v) {
                var that = $(this);
                if (i < 5) {
                    that.removeClass("hide");
                }
                if ($(".list-service-" + id + " .row .col-6.hide").length == 0) {
                    $(".list-service-" + id + " .loadmore-mb").remove();
                }
            })

        });
    });
</script>

<?php
get_footer();
?>