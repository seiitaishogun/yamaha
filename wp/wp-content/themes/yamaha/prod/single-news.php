<?php
get_header();
$id = get_the_ID();
$page_id = get_queried_object_id();

gt_set_post_view();

$breadcrumb = [
    "0" => [
        'name' => 'Tin Tức',
        'slug'   => the_permalink(95),
        'active' => false,
    ]
];

$term_name = get_the_terms($page_id, 'cate');

?>

<?php
echo get_template_part('includes/header/header-breadcrumb', 'news', $breadcrumb);
?>

<div class="news news__post-detail">
    <div class="container-fluid">
        <div class="news__container">
            <div style="height: 16px" class="d-lg-none d-md-none d-block"></div>
            <label for="" class="news__headline d-lg-none d-md-none d-flex justify-content-between"><?php echo $term_name[0]->name; ?> <span><?php echo get_the_date('d/m/Y', $page_id) ?></span></label>
            <div style="height: 10px" class=""></div>
            <h3 class="ff-1 colorDark title-news"><?php echo get_the_title($page_id); ?></h3>
            <div style="height: 5px" class=""></div>
            <div class="content-news">
                <?php echo get_field("short_description", $page_id) ?>
            </div>
            <div class="line l d-lg-none d-md-none d-block"></div>
            <div style="height: 5px" class=""></div>
            <div class="d-flex justify-content-between align-items-center">
                <label for="" class="news__headline d-lg-flex align-items-center d-md-block d-none"><?php echo $term_name[0]->name; ?> • <span><?php echo get_the_date('d/m/Y', $page_id) ?></span></label>
                <div class="news__info">
                    <?php
                    $cookie_name = "u_browser";
                    if (!isset($_COOKIE[$cookie_name])) :
                    ?>
                        <a href="<?php echo add_query_arg('post_action', 'like'); ?>" class="news__info-item">
                            <span class="ic-heart"></span>
                            <?php echo ip_get_like_count('likes') ?> thích
                        </a>
                    <?php else : ?>

                        <a href="<?php echo add_query_arg('post_action', 'dislike'); ?>" class="news__info-item <?php echo ip_get_like_count('likes') != 0 ? 'active' : '' ?>">
                            <span class="ic-heart"></span>
                            <?php echo ip_get_like_count('likes') ?> thích
                        </a>
                    <?php endif; ?>
                    <div class="news__info-item">
                        <img src="<?php echo get_template_directory_uri() ?>/img/ic_eyes.svg" alt="">
                        <?= gt_get_post_view(); ?>
                    </div>
                    <div class="news__info-item position-relative">
                        <img src="<?php echo get_template_directory_uri() ?>/img/ic_share.svg" alt="">
                        <!-- 120 share -->
                        <div id="fb-root"></div>
                        <script>
                            (function(d, s, id) {
                                var js, fjs = d.getElementsByTagName(s)[0];
                                if (d.getElementById(id)) return;
                                js = d.createElement(s);
                                js.id = id;
                                js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.0";
                                fjs.parentNode.insertBefore(js, fjs);
                            }(document, 'script', 'facebook-jssdk'));
                        </script>
                        <style>
                            .fb-share-button {
                                position: absolute;
                                left: 0;
                                top: 0;
                                width: 100%;
                                height: 100%;
                                opacity: 0;
                            }
                        </style>
                        <!-- Your share button code -->
                        <div class="fb-share-button" data-href="<?php the_permalink($page_id) ?>" data-layout="button_count">
                        </div>
                    </div>
                </div>
            </div>
            <div style="height: 10px"></div>
            <div class="news__detail-img" style="background-image: url('<?php echo get_field("feature_image", $page_id);  ?>');"></div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="wrapper-container">
            <div class="news__para news__container mt-3">
                <?php echo get_field("content", $page_id); ?>
            </div>
            <div style="height: 32px;" class="d-lg-block d-xl-block d-none"></div>
            <div style="height: 40px;" class="d-block d-lg-none d-xl-none"></div>
        </div>
    </div>
    <?php
    $_term = $term_name[0]->slug;

    $args = array(
        'post_type' => 'news',
        'paged' => -1,
        'post_status' => 'publish',
        'posts_per_page' => -1,
        'suppress_filters' => true,
        'tax_query' => array(
            array(
                'taxonomy' => 'cate',
                'field' => 'slug',
                'terms' => $_term,
            ),
        )
    );

    $query = new WP_Query($args);

    $posts = $query->posts;

    $check = 0;

    foreach ($posts as $post) {
        if ($post->ID !== $page_id) {
            $check = 1;
        }
    }

    // print_r($posts);die;
    if ($check) :
    ?>
        <div class="related-new bgLGraymb">
            <div class="container-fluid">
                <div class="line l d-lg-block d-xl-block d-none"></div>
                <div style="height: 24px"></div>
                <div class="d-flex justify-content-between align-items-center">
                    <h2 class="ff-1 colorDark text-uppercase">TIN TỨC LIÊN QUAN</h2>
                    <div class="swiper-navi">
                        <div class="swiper-button-prev swiper-button-prev--custom"><img src="<?php echo get_template_directory_uri() ?>/img/ic_long-left.svg" alt=""></div>
                        <div class="swiper-button-next swiper-button-next--custom"><img src="<?php echo get_template_directory_uri() ?>/img/ic_long-right.svg" alt=""></div>
                    </div>
                </div>

                <div style="height: 24px;"></div>

                <div class="swiper-container">
                    <div class="swiper-wrapper">
                        <?php
                        foreach ($posts as $post) :
                            $feature_image = get_field('feature_image', $post->ID);

                            if ($post->ID !== $page_id) :
                        ?>
                                <div class="swiper-slide">
                                    <div class="article hover-img">
                                        <a href="<?php echo get_permalink($post->ID); ?>" class="stretched-link"></a>
                                        <div class="wrap-hover-img">
                                            <img src="<?php echo $feature_image; ?>" alt="" class="article__img">
                                        </div>
                                        <div class="article__body">
                                            <label for="" class="news__headline d-lg-block d-none"><?php echo $term_name[0]->name; ?> <strong>•</strong> <span><?php echo get_the_date('d/m/Y', $post->ID) ?></span></label>
                                            <div style="height: 16px;" class="d-lg-block d-none"></div>
                                            <div class="article__title text-break"><?php echo $post->post_title; ?></div>
                                            <div style="height: 16px;" class="d-lg-none d-block"></div>
                                            <div style="height: 24px;" class="d-lg-block d-none"></div>
                                            <label for="" class="d-lg-none d-block fz12 colorLGray"><?php echo $term_name[0]->name; ?> <strong>•</strong> <span><?php echo get_the_date('d/m/Y', $post->ID) ?></span></label>
                                            <div class="line d-lg-block d-none"></div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div style="height: 10px;" class="d-lg-none d-block"></div>
                <div style="height: 32px;" class="d-lg-block d-xl-block d-none"></div>
            </div>
        </div>
    <?php endif; ?>
    <!-- ////RECOMMENDED ///// -->
    <?php

    $bikes = get_field('related_bike', $page_id);
    if ($bikes) :
    ?>
        <div class="product bgGray bgWhitemb">
            <div style="height: 32px;" class="d-lg-block d-xl-block d-none"></div>
            <div style="height: 20px;" class="d-block d-lg-none d-xl-none"></div>
            <div class="container-fluid">
                <div class="d-flex align-items-center justify-content-between">
                    <h2 class="ff-1 colorDark text-uppercase text-center">SẢN PHẨM LIÊN QUAN</h2>
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
                            <?php
                            foreach ($bikes as $e) :
                                setup_postdata($e);
                                $rec = get_field("feature_product", $e->ID);
                                $price = $rec['feature_price'];
                            ?>
                                <div class="product__recommend-item swiper-slide">
                                    <a href="<?php echo get_permalink($e->ID); ?>" class="stretched-link"></a>
                                    <div class="block-img">
                                        <img src="<?php echo $rec['feature_img']; ?>" alt="">
                                    </div>
                                    <div style="height: 24px;"></div>
                                    <div class="fz18 bold"><?php echo $rec['feature_title']; ?> <?php echo $rec['feature_type']; ?></div>
                                    <div class="fz14 colorLGray">Giá từ <span class="fz20"><?php echo currencyFormat($price); ?></span></div>
                                </div>
                                <?php
                                // Reset the global post object so that the rest of the page works correctly.
                                wp_reset_postdata(); ?>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="swiper-navi-mb d-lg-none">
                        <div class="swiper-button-prev swiper-button-prev--custom"><img src="<?php echo get_template_directory_uri() ?>/img/ic_long-left.svg" alt=""></div>
                        <div class="swiper-button-next swiper-button-next--custom"><img src="<?php echo get_template_directory_uri() ?>/img/ic_long-right.svg" alt=""></div>
                    </div>
                </div>
            </div>
            <div style="height: 32px;"></div>
        </div>
</div>
<?php endif; ?>

<script type="text/javascript">
    $(document).ready(function() {
        $("footer").after('<div style="height: 70px;" class="d-block d-lg-none d-xl-none"></div>');

        var swiperf = new Swiper('.related-new .swiper-container', {
            slidesPerView: "auto",
            spaceBetween: 16,
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

        var swiperLine = new Swiper('.product__recommend .swiper-container', {
            slidesPerView: 1,
            spaceBetween: 8,
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
                    slidesPerView: 4,
                    spaceBetween: 8,
                    navigation: {
                        nextEl: '.swiper-navi .swiper-button-next',
                        prevEl: '.swiper-navi .swiper-button-prev',
                    },
                }
            }
        });

        $(".news__info-item").on("click", function(e) {
            e.preventDefault;
        })
    });
</script>

<?php
get_footer();
