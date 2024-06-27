<?php
get_header();

$term = get_queried_object();

$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

$args = array(
    'post_type' => 'item',
    'paged' => $paged,
    'post_status' => 'publish',
    'posts_per_page' => 10,
    'meta_key' => 'price',
    'orderby' => 'meta_value_num',
    'order' => 'ASC',
    'tax_query' => array(
        array(
            'taxonomy' => 'apparels',
            'field' => 'slug',
            'terms' => $term->slug,
        ),
    )
);

$query = new WP_Query($args);

$posts = $query->posts;
$count = $query->post_count;

$query_count = get_posts(array(
    'post_type'  => 'item',
    'post_status' => 'publish',
    'posts_per_page' => -1,
    'tax_query' => array(
        array(
            'taxonomy' => 'apparels',
            'field' => 'slug',
            'terms' => $term->slug,
        ),
    )
));

$count_max = count($query_count);

$terms = get_terms([
    'taxonomy' => "apparels",
    'hide_empty' => false,
]);

?>

<?php echo get_template_part('includes/header/header-toolbar'); ?>

<div class="navigator__breadcrumbs">
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">TRANG CHỦ</a></li>
                <li class="breadcrumb-item"><a href="<?php echo get_permalink(108); ?>">TRANG PHỤC</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo $term->name; ?></li>
            </ol>
        </nav>
    </div>
</div>

<section class="cat-banner">
    <div class="container-fluid">
        <?php
        $banner = get_field("banner_background", $term);
        $title = get_field("title", $term);
        if ($banner) :
        ?>
            <picture>
                <source media="(min-width:768px)" srcset="<?php echo $banner; ?>">
                <img src="<?php echo $banner ?>" alt="" class="d-block w-100" />
            </picture>
            <div class="cat-banner__caption">
                <h1><?php echo $title; ?></h1>
            </div>
        <?php endif ?>
    </div>
</section>


<section class="hot-items">
    <div class="container-fluid">
        <div class="hot-items__title">
            <h3><span id="num-item"><?php echo $count_max; ?></span> mặt hàng</h3>
            <div class="list-dropdown d-flex align-items-center">
                <div class="dropdown filter-price">

                    <button type="button" class="btn btn-filter dropdown-toggle" id="dropdownMenuOffset" data-display="static" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Giá: Thấp - Cao
                    </button>
                    <div class="dropdown-menu dropdown-red dropdown-menu-right" aria-labelledby="dropdownMenuOffset">
                        <a class="dropdown-item" href="javascript:void(0)" data-filter="price-to-high">Giá: Thấp - Cao</a>
                        <a class="dropdown-item" href="javascript:void(0)" data-filter="price-to-low">Giá: Cao - Thấp</a>
                    </div>
                </div>


                <div class="dropdown">
                    <button type="button" class="btn btn-filter dropdown-toggle" id="dropdownMenuOffset" data-display="static" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?php echo $term->name; ?>
                    </button>
                    <div class="dropdown-menu dropdown-red dropdown-menu-right" aria-labelledby="dropdownMenuOffset">
                        <?php $categories = get_terms(array(
                            'taxonomy' => 'apparels',
                            'hide_empty' => false,
                        ));
                        if ($categories) :
                            foreach ($categories as $k => $item) :
                                $status = get_field('status_category', $item);
                                if ($status > 0) :
                                    $args_item = array(
                                        'post_type' => 'item',
                                        'paged' => -1,
                                        'post_status' => 'publish',
                                        'posts_per_page' => -1,
                                        'suppress_filters' => true,
                                        'tax_query' => array(
                                            array(
                                                'taxonomy' => 'apparels',
                                                'field' => 'id',
                                                'terms' => $item->term_id,
                                            ),
                                        )
                                    );

                                    $query_item = new WP_Query($args_item);

                                    $count_item = $query_item->post_count;
                        ?>
                                    <a class="dropdown-item" href="<?php echo get_term_link($item->term_id); ?>"><?php echo $item->name ?> <?php echo $count_item > 0 ? '(' . $count_item . ')' : '' ?></a>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
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
        <!-- <div class="text-center">
            <a href="javascript: void(0);" onclick="loadMore()" class="btn--border-red fz14 bold text-uppercase d-inline-flex justify-content-center btn-exp-more red">
                LOAD MORE
            </a>
        </div> -->

        <div class="text-center">
            <?php if ($count >= 10) : ?>
            <a href="javascript: void(0);" id="loadmore" class="btn-clip btn-border-red w-auto">Xem Thêm</a>
            <?php endif ?>
        </div>
    </div>
</section>

<script>
    var paged = <?php echo $paged; ?>;
    var max_page = <?php echo $count_max; ?>;
    var loading_svg = '<div class="w-100"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="margin:auto;background:#fff;display:block;" width="80px" height="80px" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid"> <g transform="rotate(0 50 50)"> <rect x="47" y="24" rx="3" ry="6" width="6" height="12" fill="#898989"> <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.9166666666666666s" repeatCount="indefinite"></animate> </rect> </g><g transform="rotate(30 50 50)"> <rect x="47" y="24" rx="3" ry="6" width="6" height="12" fill="#898989"> <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.8333333333333334s" repeatCount="indefinite"></animate> </rect> </g><g transform="rotate(60 50 50)"> <rect x="47" y="24" rx="3" ry="6" width="6" height="12" fill="#898989"> <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.75s" repeatCount="indefinite"></animate> </rect> </g><g transform="rotate(90 50 50)"> <rect x="47" y="24" rx="3" ry="6" width="6" height="12" fill="#898989"> <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.6666666666666666s" repeatCount="indefinite"></animate> </rect> </g><g transform="rotate(120 50 50)"> <rect x="47" y="24" rx="3" ry="6" width="6" height="12" fill="#898989"> <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.5833333333333334s" repeatCount="indefinite"></animate> </rect> </g><g transform="rotate(150 50 50)"> <rect x="47" y="24" rx="3" ry="6" width="6" height="12" fill="#898989"> <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.5s" repeatCount="indefinite"></animate> </rect> </g><g transform="rotate(180 50 50)"> <rect x="47" y="24" rx="3" ry="6" width="6" height="12" fill="#898989"> <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.4166666666666667s" repeatCount="indefinite"></animate> </rect> </g><g transform="rotate(210 50 50)"> <rect x="47" y="24" rx="3" ry="6" width="6" height="12" fill="#898989"> <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.3333333333333333s" repeatCount="indefinite"></animate> </rect> </g><g transform="rotate(240 50 50)"> <rect x="47" y="24" rx="3" ry="6" width="6" height="12" fill="#898989"> <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.25s" repeatCount="indefinite"></animate> </rect> </g><g transform="rotate(270 50 50)"> <rect x="47" y="24" rx="3" ry="6" width="6" height="12" fill="#898989"> <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.16666666666666666s" repeatCount="indefinite"></animate> </rect> </g><g transform="rotate(300 50 50)"> <rect x="47" y="24" rx="3" ry="6" width="6" height="12" fill="#898989"> <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.08333333333333333s" repeatCount="indefinite"></animate> </rect> </g><g transform="rotate(330 50 50)"> <rect x="47" y="24" rx="3" ry="6" width="6" height="12" fill="#898989"> <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="0s" repeatCount="indefinite"></animate> </rect> </g> </svg></div>';
    var filter_tag = '';
    $(document).ready(function() {

        $(document).on('click', '.filter-price .dropdown-item', function() {
            var that = $(this);
            var text = that.text();
            var filter = that.attr('data-filter');

            $(".filter-price .btn-filter").text(text);
            filter_tag = filter;
            $("#loadmore").show();
            paged = 1;

            $.ajax({ // you can also use $.post here
                url: ajaxurl, // AJAX handler
                data: {
                    'action': 'filter_items',
                    'filter': filter,
                    'type': '<?php echo $term->slug; ?>',
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
        });

        $(document).on("click", "#loadmore", function() {
            var that = $(this),
                data = {
                    'action': 'loadmoreApparel',
                    'paged': paged,
                    'filter': filter_tag,
                    'type': '<?php echo $term->slug; ?>',
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
                        // let count_item = parseInt($("#num-item").text()) + res.count;
                        // $("#num-item").text(count_item);
                        paged++;
                        let num = $(".product-list .product-item").length;
                        // console.log(num + "  " + max_page);
                        if (num == max_page) {
                            that.text('Xem Thêm');
                            that.hide(); // if last page, remove the button
                        }

                        filter_tag = '';
                        // you can also fire the "post-load" event here if you use a plugin that requires it
                        // $( document.body ).trigger( 'post-load' );
                    } else {
                        that.text('Xem Thêm');
                        that.hide(); // if no data, remove the button as well
                    }
                }
            });

        });

    })
</script>

<?php
get_footer();
