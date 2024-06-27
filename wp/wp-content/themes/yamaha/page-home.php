<?php
get_header();
// $page_id = get_the_ID();
$page_id = get_queried_object_id();
global $arrCat_apparel_Show, $arrCat_bike_Show ;
?>

<?php echo get_template_part('includes/header/header-toolbar'); ?>

<div class="banner banner__swiper banner-full">
    <!-- Slider main container -->
    <div class="swiper-container">
        <div class="swiper-wrapper">
            <!-- Additional required wrapper -->
            <?php
            $main_sliders = get_field('banner', $page_id);
            ?>
            <?php if ($main_sliders) : ?>
                <?php foreach ($main_sliders as $slider) : ?>
                    <?php
                    $swiper_auto = '';
                    if ($slider['timing_slide']) {
                        $swiper_auto = 'data-swiper-autoplay="' . $slider['timing_slide'] . '"';
                    }
                    ?>

                    <?php if ($slider['group']['choose_one'] == 1) : ?>
                        <div data-background="<?php echo $slider['group']['background_image'] ?>" class="swiper-slide swiper-lazy" <?php echo $swiper_auto; ?>>
                        <?php else : ?>
                            <div class="swiper-slide swiper-lazy" <?php echo $swiper_auto; ?>>

                                <?php
                                $re = "/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user)\/))([^\?&\"'>]+)/";
                                $str = 'https://www.youtube.com/embed/TUQNl45Hzbo?feature=oembed';

                                $iframe = $slider['group']['background_video'];
                                preg_match('/src="(.+?)"/', $iframe, $matches);
                                $src = $matches[1];
                                preg_match($re, $src, $matches2);


                                // Add extra parameters to src and replcae HTML.
                                $params = array(
                                    'autoplay'  => 1,
                                    'controls'  => 0,
                                    'mute'     => 1,
                                    'playsinline' => 1,
                                    'loop' => 1,
                                    'playlist' => $matches2[1],
                                );
                                $new_src = add_query_arg($params, $src);
                                $iframe = str_replace($src, $new_src, $iframe);

                                // Add extra attributes to iframe HTML.
                                $attributes = 'frameborder="0" allowfullscreen="0" unselectable="on"';
                                $iframe = str_replace('></iframe>', ' ' . $attributes . '></iframe>', $iframe);

                                // Display customized HTML.
                                echo $iframe;
                                ?>
                            <?php endif; ?>
                            <div class="container-fluid">
                                <div class="swiper-content">
                                    <div class="fz12"><?php echo $slider['label']; ?></div>
                                    <h1 class="exbold ff-1"><?php echo $slider['title']; ?></h1>
                                    <div style="height: 24px;"></div>
                                    <?php if ($slider['link']) : ?>
                                        <a href="<?php echo $slider['link'] ?>" class="btn-clip btn-border-white">XEM THÊM</a>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="swiper-lazy-preloader"></div>
                            </div>
                        <?php endforeach ?>

                    <?php endif ?>

                        </div>
                        <!-- If we need pagination -->
                        <div class="swiper-pagi-wrapper">
                            <div class="swiper-pagination swiper-pagination--custom"></div>

                        </div>

                        <!-- If we need navigation buttons -->
                        <!-- <div class="swiper-button-prev swiper-button-prev--custom"><img src="<?php echo get_template_directory_uri() ?>/img/ic_long-left.svg" alt=""></div>
                        <div class="swiper-button-next swiper-button-next--custom"><img src="<?php echo get_template_directory_uri() ?>/img/ic_long-right.svg" alt=""></div> -->
        </div>
    </div>


    <div class="bgGray">
        <div class="container-fluid">
            <div class="featured">
                <div style="height: 32px;" class="d-lg-block d-xl-block d-none"></div>
                <div style="height: 30px;" class="d-block d-lg-none d-xl-none"></div>
                <h2 class="ff-1 colorDark text-uppercase text-center">SẢN PHẨM NỔI BẬT</h2>

                <div class="swiper-container">
                    <div class="swiper-wrapper">
                        <?php

                        $query_posts = new WP_Query(array(
                            'post_type' => 'product',
                            'post_status' => 'publish',
                            'posts_per_page' => -1,
                        ));
                        $posts = $query_posts->posts;
                        $count_fe = 0;
                        ?>
                        <?php foreach ($posts as $k => $post) : ?>
                            <?php
                            if ($post) :
                                $featured = get_field("feature_product", $post->ID);
                                $price = $featured['feature_price'];
                                $is_featured = get_field("featured_bike");

                                if ($is_featured && $is_featured == 1) :
                                    $count_fe++;
                                    if ($count_fe < 4) :
                            ?>
                                        <div class="swiper-slide text-center">
                                            <a href="<?php echo get_permalink(); ?>" class="stretched-link"></a>
                                            <div class="featured__img">
                                                <img src="<?php echo $featured['feature_img']; ?>" alt="">
                                            </div>
                                            <h3 class="ff-1 colorGray"><?php echo $featured['feature_title']; ?></h3>
                                            <p class="colorGray mb-0"><span class="colorLGray">Giá từ</span> <span class="fz20"><?php echo currencyFormat($price) ?></span></p>
                                        </div>
                                    <?php endif; ?>
                                <?php endif; ?>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div style="height: 16px;" class=""></div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div style="height: 16px;" class=""></div>

        <div class="d-flex justify-content-lg-between justify-content-center align-items-center">
            <h2 class="ff-1 colorDark text-uppercase">TIN TỨC MỚI NHẤT</h2>
            <a href="<?php the_permalink(95) ?>" class="btn-clip btn-border-red text-uppercase bold d-xl-flex d-lg-flex align-items-center d-none ">XEM TẤT CẢ <i class="ico__chev-right"></i></a>
        </div>

        <div style="height: 24px;" class="d-lg-block d-xl-block d-none"></div>
        <div style="height: 16px;" class="d-block d-lg-none d-xl-none"></div>

        <div class="row sm-gutters">
            <?php
            $i = 0;
            $args = array(
                'post_type' => 'news',
                'post_status' => 'publish',
                'posts_per_page' => 3,
                'order' => 'DESC',
            );
            $the_query = new WP_Query($args);

            $news = $the_query->posts;

            foreach ($news as $post) :
                $feature_image = get_field('feature_image');
                $term_name = get_the_terms($post->ID, 'cate');
                $i++;
            ?>
                <div class="col-lg-4 col-12">
                    <div class="article <?php echo $i > 1 ? "article--hoz" : "" ?>">
                        <div class="article__img">
                            <img src="<?php echo $feature_image ?>" alt="" class="">
                        </div>
                        <div class="article__body">
                            <a href="<?php echo get_permalink($post->ID); ?>" class="stretched-link"></a>
                            <label for="" class="fz14 bold mb-0 text-uppercase colorLGray d-flex align-items-center"><?php echo $term_name[0]->name; ?> <strong class="mx-2">•</strong> <span class="fz12 colorLGray normal"><?php echo get_the_date('d/m/Y', $post->ID) ?></span></label>
                            <div style="height: 6px;"></div>
                            <div class="article__title text-break"><?php echo $post->post_title; ?></div>
                            <div style="height: 10px;" class="d-lg-block d-xl-block d-none"></div>
                            <!-- <p class="fz12 colorLGray d-lg-block d-xl-block d-none mb-0"><?php echo get_the_date('d/m/Y', $post->ID) ?></p> -->
                            <div class="line"></div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <a href="<?php the_permalink(95) ?>" class="btn-clip btn-border-red text-uppercase bold d-flex justify-content-center align-items-center d-lg-none d-xl-none mt-1">XEM TẤT CẢ <span style="width: 14px"></span> <i class="ico__chev-right"></i></a>

        <div style="height: 16px;" class="d-lg-none d-xl-none d-md-none d-block"></div>
        <div class="divider d-lg-none d-xl-none d-block mt-2"></div>

        <div style="height: 16px;" class="d-lg-block d-xl-block d-none"></div>
        <div style="height: 16px;" class="d-block d-lg-none d-xl-none"></div>

        <h2 class="ff-1 colorDark text-uppercase text-center">DÒNG XE</h2>

        <div style="height: 20px;" class="d-lg-block d-xl-block d-none"></div>
        

        <div class="row sm-gutters bike-category">

            <?php
            $bike = get_field("bike_categories", $page_id);

            $terms =  get_terms(array(
                'taxonomy' => 'products',
                'hide_empty' => false, 
            ));

            $count_post = 0;
            foreach ($terms as $k => $v) {
                $status = get_field('status_category', $v);
                if ($status > 0) {
                    $count_post++;
                }
            }

            $count_check = 0;
            $count_row = 1;
            ?>

            <?php foreach ($terms as $k => $v) : ?>
                <?php
                $status = get_field('status_category', $v);
                ?>
                <?php if ($status > 0) : ?>
                    <?php $count_check++; ?>
                    <?php if (($count_check % 2) == 0) { $count_row ++; } ?>
                    <?php if (($count_row % 2) > 0 && ($count_check % 2) > 0 && $count_check <= $count_post) :  ?>
                        <div class="col-lg-7 col-md-7 col-7">
                            <div class="background-image">
                                <a href="<?php echo get_term_link($v->slug, 'products'); ?>" class="stretched-link"></a>
                                <img src="<?php echo get_field('background_image', $v) ?>" alt="" class="box-img">
                                <div class="box-text">
                                    <h4 class="colorWhite exbold ff-1"><?php echo $v->name; ?></h4>
                                    <div style="height: 8px;"></div>
                                    <div class="colorLine fz14 price-fix"> <span>Giá từ&nbsp</span> <span class="fz20"><?php echo get_field('price_from', $v); ?> ₫</span></div>
                                </div>
                            </div>
                        </div>
                    <?php elseif (($count_row % 2) == 0 && ($count_check % 2) > 0  && $count_check <= $count_post) :  ?>
                        <div class="col-lg-5 col-md-5 col-5">
                            <div class="background-image">
                                <a href="<?php echo get_term_link($v->slug, 'products'); ?>" class="stretched-link"></a>
                                <img src="<?php echo get_field('background_image', $v) ?>" alt="" class="box-img">
                                <div class="box-text">
                                    <h4 class="colorWhite exbold ff-1"><?php echo $v->name; ?></h4>
                                    <div style="height: 8px;"></div>
                                    <div class="colorLine fz14 price-fix"><span>Giá từ&nbsp</span> <span class="fz20"><?php echo get_field('price_from', $v); ?> ₫</span></div>
                                </div>
                            </div>
                        </div>
                    <?php elseif (($count_row % 2) > 0 && ($count_check % 2) == 0   && $count_check <= $count_post) :  ?>
                        <div class="col-lg-7 col-md-7 col-7">
                            <div class="background-image">
                                <a href="<?php echo get_term_link($v->slug, 'products'); ?>" class="stretched-link"></a>
                                <img src="<?php echo get_field('background_image', $v) ?>" alt="" class="box-img">
                                <div class="box-text">
                                    <h4 class="colorWhite exbold ff-1"><?php echo $v->name; ?></h4>
                                    <div style="height: 8px;"></div>
                                    <div class="colorLine fz14 price-fix"><span>Giá từ&nbsp</span> <span class="fz20"><?php echo get_field('price_from', $v); ?> ₫</span></div>
                                </div>
                            </div>
                        </div> 
                    <?php elseif (($count_row % 2) == 0 && ($count_check % 2) == 0  && $count_check <= $count_post) :  ?>
                        <div class="col-lg-5 col-md-5 col-5">
                            <div class="background-image">
                                <a href="<?php echo get_term_link($v->slug, 'products'); ?>" class="stretched-link"></a>
                                <img src="<?php echo get_field('background_image', $v) ?>" alt="" class="box-img">
                                <div class="box-text">
                                    <h4 class="colorWhite exbold ff-1"><?php echo $v->name; ?></h4>
                                    <div style="height: 8px;"></div>
                                    <div class="colorLine fz14 price-fix"><span>Giá từ&nbsp</span> <span class="fz20"><?php echo get_field('price_from', $v); ?> ₫</span></div>
                                </div>
                            </div>
                        </div>
                    <?php else : ?>
                        <div class="col-lg-12 col-12 <?php // echo $i == 0 ? "col-12" : "col-md-6 col-6" ?>">
                            <div class="background-image">
                                <a href="<?php echo get_term_link($v->slug, 'products'); ?>" class="stretched-link"></a>
                                <img src="<?php echo get_field('background_image', $v) ?>" alt="" class="box-img">
                                <div class="box-text">
                                    <h4 class="colorWhite exbold ff-1"><?php echo $v->name; ?></h4>
                                    <div style="height: 8px;"></div>
                                    <div class="colorLine fz14 price-fix"><span>Giá từ&nbsp</span> <span class="fz20"><?php echo get_field('price_from', $v); ?> ₫</span></div>
                                </div>
                            </div>
                        </div>

                    <?php endif ?>  
                <?php endif ?>

            <?php endforeach ?>
        </div>

        <div style="height: 32px;" class="d-lg-block d-xl-block d-none"></div>
        <div style="height: 16px;" class="d-block d-lg-none d-xl-none"></div>

        <?php $apparel = get_field("apparel", $page_id) ?>

        <?php if ($apparel) : ?>

            <div class="row no-gutters d-md-flex d-lg-flex d-xl-flex d-none">
                <div class="col-lg-5 col-6">
                    <div class="background-image background-image--overlay">
                        <div class="background-image__blur" style="background-image: url(<?php echo $apparel['background_image']; ?>);"></div>
                        <div class="background-image__content">
                            <div class="fz16 bold"><?php echo $apparel['headline']; ?></div>
                            <div style="height: 8px;"></div>
                            <h3 class="colorWhite exbold ff-1"><?php echo $apparel['title']; ?></h3>
                            <div style="height: 8px;"></div>
                            <div class="colorLine des fz14"><?php echo $apparel['description']; ?></div>
                            <div style="height: 30px;"></div>
                            <a href="<?php echo $apparel['link'] ?>" class="btn-clip btn-border-white">XEM THÊM<span class="ico__chev-right"></span></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7 col-6">
                    <div class="background-image" style="background-image: url(<?php echo $apparel['background_image']; ?>);"></div>
                </div>
            </div>

            <h2 class="ff-1 colorDark text-uppercase text-center d-block d-lg-none d-md-none d-xl-none"><?php echo $apparel['headline']; ?></h2>
            <div style="height: 16px;" class="d-block d-lg-none d-md-none d-xl-none"></div>
            <div class="row no-gutters d-flex d-lg-none d-md-none d-xl-none">
                <div class="col-lg-7 col-12">
                    <div class="background-image background-image--service" style="background-image: url(<?php echo $apparel['background_image']; ?>);"></div>
                </div>
                <div class="col-lg-5 col-12">
                    <div class="service__content">
                        <div class="fz16 bold"><?php echo $apparel['headline']; ?></div>
                        <div style="height: 20px;"></div>
                        <h3 class="colorWhite exbold ff-1"><?php echo $apparel['title']; ?></h3>
                        <div style="height: 8px;"></div>
                        <p class="mb-0 fz14"><?php echo $apparel['description']; ?></p>
                        <div style="height: 24px;"></div>
                        <a href="<?php echo $apparel['link'] ?>" class="btn-clip btn-border-red">XEM THÊM <span class="ico__chev-right"></span></a>
                    </div>
                </div>
            </div>

        <?php endif ?>

        <div style="height: 32px;" class="d-lg-block d-xl-block d-none"></div>
        <div style="height: 16px;" class="d-block d-lg-none d-xl-none"></div>

        <?php $service = get_field("yamaha_service", $page_id) ?>


        <?php if ($service) : ?>

            <h2 class="ff-1 colorDark text-uppercase text-center d-block d-lg-none d-md-none d-xl-none"><?php echo $service['headline']; ?></h2>
            
            <div class="row no-gutters">
                <div class="col-lg-7 col-md-7 col-12">
                    <div class="background-image background-image--service" style="background-image: url(<?php echo $service['background_image']; ?>);"></div>
                </div>
                <div class="col-lg-5 col-md-5 col-12">
                    <div class="service__content">
                        <div class="fz16 bold">DỊCH VỤ</div>
                        <div style="height: 8px;"></div>
                        <h3 class="exbold ff-1 title-fix"><?php echo $service['title']; ?></h3>
                        <div style="height: 8px;"></div>
                        <p class="mb-0 fz14"><?php echo $service['description']; ?></p>
                        <div style="height: 24px;"></div>
                        <a href="<?php echo $service['link'] ?>" class="btn-clip btn-border-red">XEM THÊM <span class="ico__chev-right"></span></a>
                    </div>
                </div>
            </div>
        <?php endif ?>

        <div style="height: 32px;" class="d-lg-block d-xl-block d-none"></div>
        <div style="height: 16px;" class="d-block d-lg-none d-xl-none"></div>
    </div>

    <div class="bgGray">
        <div class="">
            <div style="height: 32px;" class="d-lg-block d-xl-block d-none"></div>
            <div style="height: 16px;" class="d-block d-lg-none d-xl-none"></div>

            <h2 class="ff-1 colorDark text-uppercase text-center">THƯ VIỆN</h2>

            <div style="height: 20px;" class="d-lg-block d-xl-block d-none"></div>
            <div style="height: 16px;" class="d-block d-lg-none d-xl-none"></div>

            <?php $gallery = get_field("gallery", $page_id) ?>

            <div class="gallery">
                <span class="arrow arrow-left disabled"><img src="<?php echo get_template_directory_uri() ?>/img/ic_long-left.svg" alt=""></span>

                <div class="gallery__wrapper wrapper-left" id="gallery__wrapper">
                    <?php $gallery = get_field("gallery", $page_id) ?>

                    <?php if ($gallery) : ?>
                        <?php
                        echo '<div class="gallery__grid">';
                        $i = 0;
                        foreach ($gallery as $item) {
                            echo '<div class="gallery__item">
                        <a href="' . $item . '" data-fancybox="gallery">
                            <img src="' . $item . '" alt="">
                        </a>
                    </div>';

                            $i++;
                            if ($i % 8 == 0 && $i != count($gallery)) {
                                echo '</div><div class="gallery__grid">';
                            }
                        }
                        echo '</div>';

                        ?>


                    <?php endif; ?>

                </div>
                <span class="arrow arrow-right"><img src="<?php echo get_template_directory_uri() ?>/img/ic_long-right.svg" alt=""></span>
            </div>

            <div style="height: 32px;" class="d-lg-block d-xl-block d-none"></div>
            <div style="height: 16px;" class="d-block d-lg-none d-xl-none"></div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            if ($(window).width > 990) {
                $(window).scroll(function(event) {
                    var scroll = $(window).scrollTop();
                    if (scroll > 1000) {
                        $('#content').css({
                            'top': 0
                        });
                    } else {
                        $('#content').css({
                            'margin-top': '-43px'
                        });
                    }
                });
            }


            $('body').addClass('page-home');

            var swiper = new Swiper('.banner__swiper .swiper-container', {
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
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                pagination: {
                    el: '.swiper-pagination',
                    type: 'bullets',
                    clickable: true,
                    // renderBullet: function(index, className) {
                    // return '<span class="' + className + '"><span class="halfclip"><span class="halfcircle clipped"></span></span><span class="halfcircle fixed"></span></span>';
                    // },
                },
                on: {
                    afterInit: function() {
                        let circle = '<div class="circle"></div>';
                        let active = $(".banner__swiper .swiper-slide-active").attr("data-swiper-autoplay");
                        let duration_circle = 5000;

                        if (typeof active !== 'undefined') {
                            duration_circle = parseInt(active);
                        }

                        $(".banner__swiper .circle").remove();
                        $(".banner__swiper .swiper-pagination-bullet-active").append(circle);

                        $(".banner__swiper .circle").circleProgress({
                            size: 16,
                            thickness: 1,
                            value: 1,
                            startAngle: -1.55,
                            emptyFill: "rgba(0, 0, 0, .001)",
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
                        let active = $(".banner__swiper .swiper-slide-active").attr("data-swiper-autoplay");
                        let duration_circle = 5000;

                        if (typeof active !== 'undefined') {
                            duration_circle = parseInt(active);
                        }

                        $(".banner__swiper .circle").remove();
                        $(".banner__swiper .swiper-pagination-bullet-active").append(circle);

                        $(".banner__swiper .circle").circleProgress({
                            size: 16,
                            thickness: 1,
                            value: 1,
                            startAngle: -1.55,
                            emptyFill: "rgba(0, 0, 0, .001)",
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

            var swiperf = new Swiper('.featured .swiper-container', {
                slidesPerView: "auto",
                spaceBetween: 24,
                centeredSlides: true,
                allowTouchMove: true,
                loop: true,
                breakpoints: {
                    // when window width is >= 630px
                    960: {
                        slidesPerView: 3,
                        spaceBetween: 30,
                        allowTouchMove: false,
                        centeredSlides: false,
                        loop: false,
                    }
                }
            });



            $('.gallery .arrow').click(function() {
                var element = document.getElementById('gallery__wrapper');
                var maxScrollLeft = element.scrollWidth - element.clientWidth;

                let scrollLeft = 0;
                var leftPos = $('.gallery__wrapper').scrollLeft();
                if ($(this).hasClass('arrow-left')) {
                    scrollLeft = leftPos - 500;
                } else {
                    scrollLeft = leftPos + 500;
                }
                $(".gallery__wrapper").animate({
                    scrollLeft: scrollLeft
                }, 800);

                if (scrollLeft >= maxScrollLeft) {
                    $('.gallery .arrow-right').addClass('disabled');
                } else {
                    $('.gallery .arrow-right').removeClass('disabled');
                }

                if (scrollLeft <= 0) {
                    $('.gallery .arrow-left').addClass('disabled');
                } else {
                    $('.gallery .arrow-left').removeClass('disabled');
                }
            });
        });
    </script>

    <?php
    get_footer();
