<?php
get_header();
$page_id = get_queried_object_id();

$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

$breadcrumb = [
    "0" => [
        'name' => 'TIN TỨC',
        'slug'   => '',
        'active' => true,
    ]
];

$args = array(
    'post_type' => 'news',
    'paged' => -1,
    'post_status' => 'publish',
    'posts_per_page' => -1,
    'suppress_filters' => true
);

$query = new WP_Query($args);

$posts = $query->posts;
$max = $query->post_count;
$current_post = get_the_ID();
$f_load_post = 0;

?>


<?php
echo get_template_part('includes/header/header-breadcrumb', 'news', $breadcrumb);
?>

<div class="news-test"></div>
<div class="news">
    <div class="container-fluid">
        <div style="height: 24px;" class="d-lg-block d-xl-block d-none"></div>
        <div class="news__header">
            <div class="row">

                <div class="col-lg-8 col-12">
                    <?php foreach ($posts as $k => $post) : ?>
                        <?php
                        $feature_image = get_field('feature_image');
                        $term_name = get_the_terms($post->ID, 'cate');
                        ?>
                        <?php if ($k == 0) : ?>
                            <div class="news__center-bg" style="background-image: url('<?php echo $feature_image; ?>')">
                                <a href="<?php echo get_permalink($post->ID); ?>" class="stretched-link" style="z-index: 2;"></a>

                                <div class="news__center-content">
                                    <label for="" class="news__headline"><?php echo $term_name[0]->name; ?> <strong>•</strong> <span><?php echo get_the_date('d/m/Y', $post->ID) ?></span></label>
                                    <div style="height: 10px"></div>
                                    <h4 class="ff-1 text-clamp-title"><?php echo $post->post_title; ?></h4>
                                    <?php /*?><div style="height: 8px"></div>
                                    <div class="news__center-des"><?php echo get_field("short_description", $post->ID); ?></div><?php */?>
                                </div>

                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
                <div class="col-lg-4 col-12">
                    <ul class="news__header-list">
                        <?php foreach ($posts as $k => $post) : ?>
                            <?php
                            $feature_image = get_field('feature_image');
                            $term_name = get_the_terms($post->ID, 'cate');
                            ?>
                            <?php if ($k > 0 && $k < 4) : ?>
                                <li class="news__header-item">
                                    <a href="<?php echo get_permalink($post->ID); ?>" class="stretched-link"></a>
                                    <div class="news__img-thumb">
                                        <img src="<?php echo $feature_image; ?>" alt="" class="">
                                    </div>
                                    <div class="news__detail-thumb">
                                        <label for="" class="news__headline"><?php echo $term_name[0]->name; ?> <strong>•</strong> <span><?php echo get_the_date('d/m/Y', $post->ID) ?></span></label>
                                        <div style="height: 4px"></div>
                                        <div class="fz16 bold text-clamp"><?php echo $post->post_title; ?></div>
                                    </div>
                                </li>
                            <?php endif; ?>
                        <?php endforeach ?>
                    </ul>
                </div>
            </div>
        </div>

    </div>

    <div class="news__mb">
        <div class="swiper-container">
            <div class="swiper-wrapper">
                <?php foreach ($posts as $k => $post) : ?>
                    <?php
                    $feature_image = get_field('feature_image');
                    $term_name = get_the_terms($post->ID, 'cate');
                    ?>
                    <?php if ($k < 3) : ?>
                        <div class="swiper-slide">
                            <div class="news__center">
                                <a href="<?php echo get_permalink($post->ID); ?>" class="stretched-link"></a>
                                <div class="news__center-img" style="background-image: url(<?php echo $feature_image; ?>);"></div>
                                <div class="news__center-content">
                                    <label for="" class="news__headline"><?php echo $term_name[0]->name; ?> <strong>•</strong> <span><?php echo get_the_date('d/m/Y', $post->ID) ?></span></label>
                                    <div style="height: 10px"></div>
                                    <h4 class="ff-1 text-clamp text-uppercase"><?php echo $post->post_title; ?></h4>
                                    <div style="height: 8px"></div>
                                    <div class="news__center-des" style="font-style:italic;"><?php echo  strip_tags(get_field("short_description", $post->ID)) ; ?></div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach ?>
            </div>

            <div class="swiper-pagi-wrapper">
                <div class="swiper-pagination swiper-pagination--custom"></div>

            </div>
        </div>
    </div>


    <div class="">

        <div class="container-fluid">
            <div style="height: 24px;" class=""></div>
            <div class="line l"></div>
            <div style="height: 20px;" class=""></div>
            <h2 class="ff-1 text-uppercase  text-lg-left text-center colorDark">TIN CHÍNH</h2>
            <div style="height: 24px;" class="d-lg-block d-xl-block d-none"></div>
            <!-- <div style="height: 14px;" class="d-block d-lg-none d-xl-none"></div> -->
            <div class="news__featured">
                <div style="height: 14px;" class="d-block d-lg-none d-xl-none"></div>
                <div class="line l d-lg-none d-block"></div>
                <div style="height: 10px" class="d-block d-lg-none d-xl-none"></div>
                <div class="row">
                    <?php
                    $args = array(
                        'post_type' => 'news',
                        'paged' => 1,
                        'post_status' => 'publish',
                        'posts_per_page' => -1,
                        'suppress_filters' => true,
                    );
                    $the_query = new WP_Query($args);

                    $news = $the_query->posts;

                    foreach ($news as $post) :
                        $feature_image = get_field('feature_image');
                        $isFeatured = get_field('featured_news', $post->ID);
                        $term_name = get_the_terms($post->ID, 'cate')[0];
                        if ($isFeatured) :
                    ?>
                            <div class="col-lg-4 col-12 news__featured-wrapper">
                                <a href="<?php echo get_permalink($post->ID); ?>" class="stretched-link">
                                <div class="news__featured-img">
                                    <img src="<?php echo $feature_image ?>" alt="" class="" />
                                </div>
                                <div class="news__featured-item">
                                    <label for="" class="news__headline"><?php echo $term_name->name; ?> <strong>•</strong> <span><?php echo get_the_date('d/m/Y', $post->ID) ?></span></label>
                                    <div style="height: 6px;" class=""></div>
                                    <div class="fz18 bold des"><?php echo get_the_title($post->ID); ?></div>
                                    <!-- <div class="d-lg-block d-none">
                                        <div style="height: 10px"></div>
                                        <div class="line"></div>
                                    </div> -->
                                </div>
                                </a>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </div>
            <div style="height: 14px;" class="d-lg-block d-xl-block d-none"></div>

            <div class="line l"></div>
        </div>
    </div>

    <div class="container-fluid">
        <div style="height: 24px;" class="d-lg-block d-xl-block d-none"></div>

        <div class="news__daily">
            <div style="height: 24px" class="d-block d-lg-none d-xl-none"></div>
            <div class="row">
                <?php
                $query_posts = new WP_Query(array(
                    'post_type' => 'news',
                    'post_status' => 'publish',
                    'posts_per_page' => 6,
                    'paged' => $paged,
                    'order' => 'DESC',
                ));
                $posts = $query_posts->posts;

                foreach ($posts as $k => $post) :
                    $feature_image = get_field('feature_image');
                    $term_name = get_the_terms($post->ID, 'cate');
                    $f_load_post++;
                ?>
                    <div class="col-lg-6 col-12 news__daily-wrapper">
                        <a href="<?php echo get_permalink($post->ID); ?>" class="stretched-link"></a>
                        <div class="news__daily-img">
                            <img src="<?php echo $feature_image ?>" alt="" class="" />
                        </div>
                        <div class="news__daily-item">
                            <label for="" class="news__headline"><?php echo $term_name[0]->name; ?> <?php echo $term_name[0]->name ? '<strong>•</strong>' : '' ?> <span><?php echo get_the_date('d/m/Y', $post->ID) ?></span></label>
                            <div style="height: 6px;" class=""></div>
                            <div class="fz18 bold des"><?php echo $post->post_title; ?></div>
                            <div class="fz14 des normal" style="font-style:italic;"><?php echo strip_tags(get_field('short_description', $post->ID)); ?></div>
                            <!-- <div class="d-lg-block d-none">
                                <div style="height: 10px"></div>
                                <div class="line"></div>
                            </div> -->
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div style="height: 16px;" class="d-lg-block d-xl-block d-none"></div>
            <div class="line l"></div>
        </div>

        <div style="height: 20px;" class="d-lg-block d-xl-block d-none"></div>
    </div>

    <div class="">
        <div style="height: 14px;" class="d-block d-lg-none d-xl-none"></div>
        <div class="container-fluid">
            <div class="news__featured news__featured--custom">
                <h2 class="ff-1 text-uppercase  text-lg-left text-center colorDark">TIN TỨC HOT</h2>
                <div style="height: 24px;" class="d-lg-block d-xl-block d-none"></div>
                <div style="height: 14px;" class="d-block d-lg-none d-xl-none"></div>
                <div class="line l d-lg-none d-block"></div>
                <div style="height: 10px" class="d-block d-lg-none d-xl-none"></div>
                <div class="row">

                    <?php
                    $arr_hot = new WP_Query(array(
                        'post_type' => 'news',
                        'post_status' => 'publish',
                        'posts_per_page' => -1,
                        'paged' => -1,
                        'order' => 'DESC',
                    ));
                    $hots = $arr_hot->posts;

                    $_hots = [];
                    $_hotpick = [];

                    foreach ($hots as $e) {
                        // print_r($e);
                        $hot = get_field('hot_news', $e->ID);
                        $view =  get_post_meta($e->ID, 'post_views_count', true);

                        $_hots[$e->ID]['post_view'] = $view;
                        $_hots[$e->ID]['post'] = $e;

                        if ($hot) {
                            $_hotpick[$e->ID]['post'] = $e;
                        }
                    }

                    arsort($_hots);

                    $_hots_slice = array_slice($_hots, 0, 3);

                    if ($_hotpick) {
                        $count_pick = 0;
                        foreach ($_hotpick as $u) {
                            $count_pick++;
                            $_hots_slice[$u->ID]['post'] = $u;
                        }
                        $_hots_slice = array_slice($_hots, $count_pick, 3);
                    }

                    // print_r($_hots_slice);
                    // die;


                    foreach ($_hots_slice as $post) :
                        $feature_image = get_field('feature_image', $post['post']->ID);
                        $term_name = get_the_terms($post['post']->ID, 'cate');
                        // $hot = get_field('hot_news', $post['post']->ID);
                    ?>
                        <pre><?php echo $hot ?></pre>
                        <div class="col-lg-4 col-12 news__featured-wrapper">
                            <a href="<?php echo get_permalink($post['post']->ID); ?>" class="stretched-link">
                            <div class="news__featured-img">
                                <img src="<?php echo $feature_image ?>" alt="" class="" />
                            </div>
                            <div class="news__featured-item">
                                <label for="" class="news__headline"><?php echo $term_name[0]->name; ?> <strong>•</strong> <span><?php echo get_the_date('d/m/Y', $post['post']->ID) ?></span></label>
                                <div style="height: 6px;" class=""></div>
                                <div class="fz18 bold des"><?php echo $post['post']->post_title; ?></div>
                                <!-- <div class="d-lg-block d-none">
                                        <div style="height: 10px"></div>
                                        <div class="line"></div>
                                    </div> -->
                            </div>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div style="height: 14px;" class="d-lg-block d-xl-block d-none"></div>
                <div class="line l"></div>
            </div>

        </div>
    </div>

    <div class="container-fluid">
        <div style="height: 24px;" class="d-lg-block d-xl-block d-none"></div>
        <div style="height: 20px;" class="d-block d-lg-none d-xl-none"></div>


        <div class="news__daily">
            <div class="row">

                <?php
                $paged = $paged + 1;
                $query_posts = new WP_Query(array(
                    'post_type' => 'news',
                    'post_status' => 'publish',
                    'posts_per_page' => 6,
                    'paged' => $paged,
                    'order' => 'DESC',
                ));
                $posts = $query_posts->posts;


                foreach ($posts as $k => $post) :
                    $feature_image = get_field('feature_image');
                    $term_name = get_the_terms($post->ID, 'cate');
                    $f_load_post++;
                ?>
                    <div class="col-lg-6 col-12 news__daily-wrapper news-load">
                        <a href="<?php echo get_permalink($post->ID); ?>" class="stretched-link"></a>
                        <div class="news__daily-img">
                            <img src="<?php echo $feature_image ?>" alt="" class="" />
                        </div>
                        <div class="news__daily-item">
                            <label for="" class="news__headline"><?php echo $term_name[0]->name; ?> <?php echo $term_name[0]->name ? '<strong>•</strong>' : '' ?> <span><?php echo get_the_date('d/m/Y', $post->ID) ?></span></label>
                            <div style="height: 6px;" class=""></div>
                            <div class="fz18 bold des"><?php echo $post->post_title; ?></div>
                            <div class="fz14 des normal" style="font-style:italic;"><?php echo strip_tags(get_field('short_description', $post->ID)); ?></div>
                            <!-- <div class="d-lg-block d-none">
                                <div style="height: 10px"></div>
                                <div class="line"></div>
                            </div> -->
                        </div>
                    </div>
                <?php endforeach; ?>

            </div>
            <div class="text-center">
                <?php if ($max > 1 && $f_load_post < $max ) : ?>
                    <a href="javascript: void(0);" id="loadmore" class="btn-clip btn-border-red">XEM THÊM</a>
                <?php endif; ?>
            </div>
        </div>


        <div style="height: 24px;" class="d-lg-block d-xl-block d-none"></div>
        <div style="height: 20px;" class="d-block d-lg-none d-xl-none"></div>
    </div>

</div>

<script type="text/javascript">
    var paged = <?php echo $paged; ?>;
    var max_page = <?php echo $max; ?>;

    $(document).ready(function() {
        // $("footer").after('<div style="height: 70px;" class="d-block d-lg-none d-xl-none"></div>');

        var swiper = new Swiper('.news__mb .swiper-container', {
            slidesPerView: 1,
            spaceBetween: 30,
            autoplay: {
                delay: 5000,
            },
            pagination: {
                el: '.swiper-pagination',
                type: 'bullets',
                clickable: true,
                renderBullet: function(index, className) {
                    return '<span class="' + className + '"><span class="halfclip"><span class="halfcircle clipped"></span></span><span class="halfcircle fixed"></span></span>';
                },
            },
        });



        $(document).on("click", "#loadmore", function() {
            var that = $(this),
                data = {
                    'action': 'loadmore',
                    'paged': paged,
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
                        that.text('XEM THÊM');
                        $(".news-load:last-child").after(data);
                        paged++;

                        if (paged == max_page) {
                            that.remove(); // if last page, remove the button
                        }
                        // you can also fire the "post-load" event here if you use a plugin that requires it
                        // $( document.body ).trigger( 'post-load' );
                    } else {
                        that.remove(); // if no data, remove the button as well
                    }
                }
            });
        });
    });
</script>

<?php
get_footer();
?>