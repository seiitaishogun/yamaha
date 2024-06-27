<?php

function bikes($page = 1, $find = '', $_term = '', $tag = '', $order = 'newest')
{
    $_tax = array();

    if ($_term) {
        $_tax = array(
            array(
                'taxonomy' => 'products',
                'field' => 'slug',
                'terms' => $_term,
            ),
        );
    }


    $args = array(
        'post_type' => 'product',
        'paged' => $page,
        'post_status' => 'publish',
        'posts_per_page' => '18',
        's' => $find,
        'suppress_filters' => true
    );



    if (count($_tax) > 0) {
        $args['tax_query'] = $_tax;
    }

    $the_query = new WP_Query($args);

    $count_posts = $the_query->post_count;

    wp_reset_query();
    wp_reset_postdata();


    return array('query' => $the_query, 'count' => $count_posts);
}


// Add taxonomy
add_action('init', 'add_taxonomy');

function add_taxonomy()
{
    register_taxonomy(
        'products',
        'products',
        array(
            'label' => __('Dòng Sản Phẩm Xe'),
            'rewrite' => array('slug' => 'categories'),
            'hierarchical' => true,
            'show_admin_column' => true,
        )
    );

    register_taxonomy(
        'cate',
        'cate',
        array(
            'label' => __('Loại Tin Tức'),
            'rewrite' => array('slug' => 'category'),
            'hierarchical' => true,
            'show_admin_column' => true,
        )
    );

    register_taxonomy(
        'apparels',
        'apparels',
        array(
            'label' => __('Dòng Trang Phục'),
            'rewrite' => array('slug' => 'apparels'),
            'hierarchical' => true,
            'show_admin_column' => true,
            'include_children' => false
        )
    );

    register_taxonomy(
        'tag',
        'tag',
        array(
            'label' => __('Phân Loại Trang Phục'),
            'rewrite' => array('slug' => 'tag'),
            'hierarchical' => true,
            'show_admin_column' => true,
        )
    );

    register_taxonomy(
        'type_services',
        'type_services',
        array(
            'label' => __('Các Loại Dịch Vụ'),
            'rewrite' => array('slug' => 'service-package'),
            'hierarchical' => true,
            'show_admin_column' => true,
        )
    );

    register_taxonomy(
        'location',
        'location',
        array(
            'label' => __('Khu Vực'),
            'hierarchical' => true,
            'show_admin_column' => false,
        )
    );
}


add_action('init', 'create_post_type');
function create_post_type()
{

    register_post_type(
        'news',
        array(
            'labels' => array(
                'name' => __('Tin Tức'),
                'singular_name' => __('Tin Tức')
            ),

            'public' => true,
            'has_archive' => false,
            'supports' => array('title', 'editor', 'thumbnail'),
            'taxonomies' => array('cate'),
        )
    );

    register_post_type(
        'service',
        array(
            'labels' => array(
                'name' => __('Tin Dịch Vụ'),
                'singular_name' => __('Dịch Vụ')
            ),

            'public' => true,
            'has_archive' => false,
            'supports' => array('title', 'editor', 'thumbnail'),
        )
    );

    register_post_type(
        'dealer',
        array(
            'labels' => array(
                'name' => __('Đại Lý'),
                'singular_name' => __('Đại Lý')
            ),

            'public' => true,
            'has_archive' => false,
            'supports' => array('title', 'editor', 'thumbnail'),
            'taxonomies' => array('location'),
        )
    );

    register_post_type(
        'product',
        array(
            'labels' => array(
                'name' => __('Sản phẩm Xe'),
                'singular_name' => __('Sản phẩm Xe')
            ),
            'rewrite' => array(
                'slug' => 'bikes/model',
            ),
            'public' => true,
            'has_archive' => false,
            'supports' => array('title', 'editor', 'thumbnail'),
            'taxonomies' => array('products'),
        )
    );



    register_post_type(
        'item',
        array(
            'labels' => array(
                'name' => __('Trang Phục'),
                'singular_name' => __('Trang Phục')
            ),
            'rewrite' => array(
                'slug' => 'apparels/model',
            ),
            'public' => true,
            'has_archive' => false,
            'supports' => array('title', 'editor', 'thumbnail'),
            'taxonomies' => array('apparels', 'tag'),
        )
    );

    register_post_type(
        'package',
        array(
            'labels' => array(
                'name' => __('Gói Dịch Vụ'),
                'singular_name' => __('Gói Dịch Vụ')
            ),
            'public' => true,
            'has_archive' => false,
            'supports' => array('title', 'editor', 'thumbnail'),
            'taxonomies' => array('type_services', 'products'),
        )
    );

    register_post_type(
        'book_service',
        array(
            'labels' => array(
                'name' => __('Đặt Dịch Vụ'),
                'singular_name' => __('Đặt Dịch Vụ')
            ),
            'public' => true,

            'has_archive' => false,
            'supports' => array('title', 'editor',),
        )
    );

    register_post_type(
        'book_buy_bike',
        array(
            'labels' => array(
                'name' => __('Đặt Mua Xe'),
                'singular_name' => __('Đặt Mua Xe')
            ),
            'public' => true,
            'has_archive' => false,
            'supports' => array('title', 'editor',),
        )
    );

    register_post_type(
        'book_buy_apparel',
        array(
            'labels' => array(
                'name' => __('Đặt Mua Trang Phục'),
                'singular_name' => __('Đặt Mua Trang Phục')
            ),
            'public' => true,
            'has_archive' => false,
            'supports' => array('title', 'editor',),
        )
    );

    register_post_type(
        'book_test_drive',
        array(
            'labels' => array(
                'name' => __('Đặt Lịch Lái Thử'),
                'singular_name' => __('Đặt Lịch Lái Thử')
            ),
            'public' => true,
            'has_archive' => false,
            'supports' => array('title', 'editor',),
        )
    );
}

///////MENU ///////////

function register_my_menu()
{
    register_nav_menu('header-menu', __('Menu Main'));
    register_nav_menu('footer-menu', __('Menu Footer'));
}
add_action('init', 'register_my_menu');


//// LOAD MORE //////

function loadmore_ajax_handler()
{
    $paged = $_POST['paged'] + 1;

    $args = array(
        'post_type' => 'news',
        'posts_per_page' => 3,
        'order' => 'DESC',
        'post_status' => 'publish',
        'paged' => $paged,
    );

    // $args = json_decode( stripslashes( $_POST['query'] ), true );
    // we need next page to be loaded


    $query = new WP_Query($args);

    $posts = $query->posts;

    $out = '';

    foreach ($posts as $post) {
        $feature_image = get_field('feature_image', $post->ID);
        $term_name = get_the_terms($post->ID, 'cate');
        $out .= '<div class="col-lg-4 col-12 news__daily-wrapper news-load">
                        <a href="' . get_permalink($post->ID) . '" class="stretched-link"></a>
                        <div class="news__daily-img">
                            <img src="' . $feature_image . '" alt="" class="" />
                        </div>
                        <div class="news__daily-item">
                            <label for="" class="news__headline">' . $term_name[0]->name . ' <strong>•</strong> <span>' . get_the_date('d/m/Y', $post->ID) . '</span></label>
                            <div style="height: 16px;" class="d-lg-block d-xl-block d-none"></div>
                            <div style="height: 8px;" class="d-block d-lg-none d-xl-none"></div>
                            <div class="fz18 bold des">' . $post->post_title . '</div>
                            <div class="d-lg-block d-none">
                                <div style="height: 24px"></div>
                                <div class="line"></div>
                            </div>
                        </div>
                    </div>';
    }

    wp_reset_postdata();
    die($out);
}

add_action('wp_ajax_loadmore', 'loadmore_ajax_handler'); // wp_ajax_{action}
add_action('wp_ajax_nopriv_loadmore', 'loadmore_ajax_handler'); // wp_ajax_nopriv_{action}


function loadmoreApparel_ajax_handler()
{
    $paged = $_POST['paged'] + 1;
    $filter = $_POST['filter'];
    $type = $_POST['type'];


    if ($filter == 'hot') {
        $_tax[0] = array(
            'taxonomy' => 'tag',
            'field' => 'slug',
            'terms' => $filter,
        );
    }

    if ($type) {
        $_tax[1] =
            array(
                'taxonomy' => 'apparels',
                'field' => 'slug',
                'terms' => $type,
            );
    }

    $args = array(
        'post_type' => 'item',
        'posts_per_page' => 10,
        'post_status' => 'publish',
        'paged' => $paged,
        // 'suppress_filters' => true,
    );

    if ($filter == 'price-to-high') {
        $args['meta_key'] = 'price';
        $args['orderby'] = 'meta_value_num';
        $args['order'] = 'ASC';
    }
    if ($filter == 'price-to-low') {
        $args['meta_key'] = 'price';
        $args['orderby'] = 'meta_value_num';
        $args['order'] = 'DESC';
    }


    if (count($_tax) > 0) {
        $args['tax_query'] = $_tax;
    }

    // print_r($filter);

    $query = new WP_Query($args);

    $posts = $query->posts;

    $out = '';

    $sale = '';


    foreach ($posts as $item) {
        $types = get_the_terms($item->ID, 'tag');

        foreach ($types as $type) {
            if ($type->slug === 'sale-off') {
                $sale = 'sale';
            }
        }

        $price = get_field('price', $item->ID);

        $out .= '<a class="product-item product-last ' . $sale . '" href="' . get_permalink($item->ID) . '">
        <img src="' . get_field("list_image", $item->ID)[0]['image'][0]['sizes']['medium'] . '" alt="" />
        <div class="product-item__title">' . get_the_title($item->ID) . '</div>
        <div class="product-item__price">' . number_format($price, 0, '.', '.') . 'đ</div>
    </a>';

        $sale = '';
    }

    wp_reset_postdata();
    die($out);
}

add_action('wp_ajax_loadmoreApparel', 'loadmoreApparel_ajax_handler'); // wp_ajax_{action}
add_action('wp_ajax_nopriv_loadmoreApparel', 'loadmoreApparel_ajax_handler'); // wp_ajax_nopriv_{action}

function load_color_ajax_handler()
{
    $index = $_POST['i'];
    $id = $_POST['id'];


    $first = get_field("list_image", $id)[$index]['image'][0];
    $items = get_field("list_image", $id)[$index]['image'];

    // we need next page to be loaded

    $string = '<div class="main-pic"><img class="img-zoom" src="' . $first['sizes']['medium'] . '" data-zoom-image="' . $first['sizes']['large'] . '" /></div><div class="thumb-pics" id="gallery_01">';
    $out = '';

    foreach ($items as $k => $item) {
        $active = '';
        if ($k == 0) {
            $active = 'active';
        }
        $out .= '<a href="#" class="thumb-gallery ' . $active . '" data-update="" data-image="' . $item['sizes']['medium'] . '" data-zoom-image="' . $item['sizes']['large'] . '"><img src="' . $item['sizes']['medium'] . '" class="img-fluid" /></a>';
    }


    $string = $string . $out . '</div>';


    wp_reset_postdata();

    die($string);
}

add_action('wp_ajax_load_color', 'load_color_ajax_handler'); // wp_ajax_{action}
add_action('wp_ajax_nopriv_load_color', 'load_color_ajax_handler'); // wp_ajax_nopriv_{action}

////////FILTER/ ////////////
function filter_items_ajax_handler()
{

    $filter = $_POST['filter'];
    $type = $_POST['type'];
    $_tax = array();

    if ($filter == 'hot') {
        $_tax = array(
            array(
                'taxonomy' => 'tag',
                'field' => 'slug',
                'terms' => $filter,
            ),
        );
    }

    if ($type) {
        $_tax = array(
            array(
                'taxonomy' => 'apparels',
                'field' => 'slug',
                'terms' => $type,
            ),
        );
    }

    $args = array(
        'post_type' => 'item',
        'paged' => 1,
        'post_status' => 'publish',
        'posts_per_page' => 10,
        'suppress_filters' => true
    );


    if ($filter == 'price-to-high') {
        $args['meta_key'] = 'price';
        $args['orderby'] = 'meta_value_num';
        $args['order'] = 'ASC';
    }
    if ($filter == 'price-to-low') {
        $args['meta_key'] = 'price';
        $args['orderby'] = 'meta_value_num';
        $args['order'] = 'DESC';
    }


    if (count($_tax) > 0) {
        $args['tax_query'] = $_tax;
    }



    $the_query = new WP_Query($args);

    $posts = $the_query->posts;

    $count_posts = $the_query->post_count;

    $sale = '';
    $out = '';

    foreach ($posts as $item) {
        $types = get_the_terms($item->ID, 'tag');

        foreach ($types as $type) {
            if ($type->slug === 'sale-off') {
                $sale = 'sale';
            }
        }
        $price = get_field('price', $item->ID);

        $out .= '<a class="product-item product-last ' . $sale . '" href="' . get_permalink($item->ID) . '">
        <img src="' . get_field("list_image", $item->ID)[0]['image'][0]['sizes']['medium'] . '" alt="" />
        <div class="product-item__title">' . get_the_title($item->ID) . '</div>
        <div class="product-item__price">' . number_format($price, 0, '.', '.') . 'đ</div>
    </a>';

        $sale = '';
    }

    wp_reset_query();
    wp_reset_postdata();


    die($out);
}

add_action('wp_ajax_filter_items', 'filter_items_ajax_handler'); // wp_ajax_{action}
add_action('wp_ajax_nopriv_filter_items', 'filter_items_ajax_handler'); // wp_ajax_nopriv_{action}

function filter_type_ajax_handler()
{
    $term = $_POST['f'];

    if ($term) {
        $args = array(
            'post_type' => 'product',
            'paged' => 1,
            'post_status' => 'publish',
            'posts_per_page' => -1,
            'suppress_filters' => true,
            'tax_query' => array(
                array(
                    'taxonomy' => 'products',
                    'field' => 'slug',
                    'terms' => $term,
                ),
            )
        );
    }

    // $args = json_decode( stripslashes( $_POST['query'] ), true );
    // we need next page to be loaded


    $query = new WP_Query($args);

    $posts = $query->posts;

    $out = '';


    foreach ($posts as $post) {
        $out .= '<a class="dropdown-item" href="javascript:void(0)" data-val="' . get_the_title($post->ID) . '" data-img="' . get_field("feature_product", $post->ID)['feature_img'] . '">' . get_the_title($post->ID) . '</a>';
    }

    wp_reset_postdata();

    $arr = array('item_show' => get_the_title($posts[0]->ID), 'data' => $out);

    echo json_encode($arr);
    die;
}

add_action('wp_ajax_filter_type', 'filter_type_ajax_handler'); // wp_ajax_{action}
add_action('wp_ajax_nopriv_filter_type', 'filter_type_ajax_handler'); // wp_ajax_nopriv_{action}

function ajax_dealer_ajax_handler()
{
    $id = $_POST['id'];

    $args = array(
        'post_type' => 'dealer',
        'paged' => 1,
        'post_status' => 'publish',
        'posts_per_page' => -1,
    );

    $dealers = get_field('dealers', $id);


    // $args = json_decode( stripslashes( $_POST['query'] ), true );
    // we need next page to be loaded


    $query = new WP_Query($args);

    $posts = $query->posts;

    $out = '';

    $check = 0;

    // print_r($dealers);die;

    foreach ($posts as $e) {
        $out .= '<a class="dropdown-item" href="javascript:void(0)" data-name="' . get_the_title($e->ID) . '" data-address="' . get_field("address", $e->ID) . '">' . get_the_title($e->ID) . '';

        foreach ($dealers as $i) {

            if ($e->ID === $i->ID) {
                $check = 1;
            }
        }

        if ($check > 0) {
            $out .= '<span class="tag">In stock</span>';
            $check = 0;
        } else {
            $out .= '<span class="tag-pre">Pre-order</span>';
        }
        $out .= '</a>';
    }

    wp_reset_postdata();

    die($out);
}

add_action('wp_ajax_ajax_dealer', 'ajax_dealer_ajax_handler'); // wp_ajax_{action}
add_action('wp_ajax_nopriv_ajax_dealer', 'ajax_dealer_ajax_handler'); // wp_ajax_nopriv_{action}

function filter_package_ajax_handler()
{

    $filter = $_POST['filter'];
    $type = $_POST['type'];
    $_tax = array();

    if ($filter) {
        $_tax = array(
            array(
                'taxonomy' => 'type_services',
                'field' => 'slug',
                'terms' => $filter,
            ),
            array(
                'taxonomy' => 'type_bike',
                'field' => 'slug',
                'terms' => $type,
            ),
        );
    }

    $args = array(
        'post_type' => 'package',
        'paged' => 1,
        'post_status' => 'publish',
        'posts_per_page' => -1,
        'suppress_filters' => true
    );


    if (count($_tax) > 0) {
        $args['tax_query'] = $_tax;
    }

    $the_query = new WP_Query($args);

    $posts = $the_query->posts;

    $count_posts = $the_query->post_count;

    $nav = '';
    $content = '';
    $mb = '';
    $mb_content = '';
    $key = [1, 2, 3, 4];
    $count_key = 0;


    foreach ($posts as $k => $item) {
        $active = $k == 0 ? 'active' : '';
        $count_key = $count_key + 1;
        $price = get_field('price', $item->ID);

        $nav .= '<li class="' . $active . '"><a href="#">' . get_field('name_bike', $item->ID) . ' (' . number_format($price, 0, '.', '.') . '₫)</a></li>';
        $content .= '<div class="detail-content ' . $active . '">
        <p class="sub-title">' . get_field('name_service', $item->ID) . '</p>
        <h3 class="title">' . get_field('name_bike', $item->ID) . '</h3>
        <p class="price">' . number_format($price, 0, '.', '.') . '₫</p>
        <div class="image">
            <img src="' . get_field('image', $item->ID) . '" alt="img-service-package-detail" class="img-fluid">
        </div>
        <div>' . get_field('content', $item->ID) . '</div>
        <ul>
            <li><img src="' . get_template_directory_uri() . '/img/all-service/icons/icon-star.svg" alt="icon" class="icon">' . get_field('rating', $item->ID) . '</li>
            <li><img src="' . get_template_directory_uri() . '/img/all-service/icons/icon-phone.svg" alt="icon" class="icon"><a href="tel:' . get_field('phone_number', $item->ID) . '">' . get_field('phone_number', $item->ID) . '</a></li>
            <li><img src="' . get_template_directory_uri() . '/img/all-service/icons/icon-clock.svg" alt="icon" class="icon">' . get_field('time_active', $item->ID) . '</li>
            <li><img src="' . get_template_directory_uri() . '/img/all-service/icons/icon-pin.svg" alt="icon" class="icon"><a href="#">' . get_field('address', $item->ID) . '</a></li>
        </ul>
        <a href="' . get_permalink(422) . '" class="btn-clip btn-red">BOOK A SERVICE package</a>
    </div>';

        $mb .= '<div class="col-6">
        <div class="background-image" data-toggle="modal" data-target="#packageModal' . $item->ID . '" style="background-image: url(' . get_field('image', $item->ID) . ');">
            <div class="d-md-flex">
                <div class="icon"><img src="' . get_template_directory_uri() . '/img/service/icons/icon-' . $key[$count_key - 1] . '.svg" alt="icon"></div>
                <div class="info">
                    <h3 class="colorWhite exbold ff-1">' . get_field('name_bike', $item->ID) . '</h3>
                    <div style="height: 8px;"></div>
                    <div class="colorLine fz14">' . number_format($price, 0, '.', '.') . '₫</div>
                </div>
            </div>
        </div>
    </div>';

        $mb_content .= '<div class="modal modal-package fade" id="packageModal' . $item->ID . '" tabindex="-1" role="dialog" aria-labelledby="packageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background-image: url(' . get_field('image', $item->ID) . ');">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <div class="icon"><img src="' . get_template_directory_uri() . '/img/service/icons/icon-' . $key[$count_key - 1] . '.svg" alt="icon"></div>
                    <div class="modal-title">
                        <h5 class="title">' . get_field('name_bike', $item->ID) . '</h5>
                        <p class="price">' . get_field('price', $item->ID) . '₫</p>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="scroll">
                        <div class="detail-content">
                            ' . get_field('content', $item->ID) . '

                            <ul>
                                <li><img src="' . get_template_directory_uri() . '/img/all-service/icons/icon-star.svg" alt="icon">' . get_field('rating', $item->ID) . '</li>
                                <li><img src="' . get_template_directory_uri() . '/img/all-service/icons/icon-phone.svg" alt="icon"><a href="tel:' . get_field('phone_number', $item->ID) . '">' . get_field('phone_number', $item->ID) . '</a></li>
                                <li><img src="' . get_template_directory_uri() . '/img/all-service/icons/icon-clock.svg" alt="icon">' . get_field('time_active', $item->ID) . '</li>
                                <li><img src="' . get_template_directory_uri() . '/img/all-service/icons/icon-pin.svg" alt="icon"><a href="#">' . get_field('address', $item->ID) . '</a></li>
                            </ul>
                        </div>
                    </div>
                    <a href="' . get_permalink(422) . '" class="btn-clip btn-border-red">BOOK A SERVICE package</a>
                </div>
            </div>
        </div>
    </div>';

        if ($count_key > 3) {
            $count_key = 0;
        }
    }

    wp_reset_query();
    wp_reset_postdata();

    $arr = [];
    $arr[0] = $nav;
    $arr[1] = $content;
    $arr[2] = $count_posts;
    $arr[3] = $mb;
    $arr[4] = $mb_content;

    echo json_encode($arr);
    die;
}

add_action('wp_ajax_filter_package', 'filter_package_ajax_handler'); // wp_ajax_{action}
add_action('wp_ajax_nopriv_filter_package', 'filter_package_ajax_handler'); // wp_ajax_nopriv_{action}

function filter_bike_ajax_handler()
{

    $filter = $_POST['filter'];
    $type = $_POST['type'];
    $_tax = array();

    if ($type) {
        $_tax = array(
            array(
                'taxonomy' => 'type_services',
                'field' => 'slug',
                'terms' => $filter,
            ),
            array(
                'taxonomy' => 'type_bike',
                'field' => 'slug',
                'terms' => $type,
            ),
        );
    }

    $args = array(
        'post_type' => 'package',
        'paged' => 1,
        'post_status' => 'publish',
        'posts_per_page' => -1,
        'suppress_filters' => true
    );


    if (count($_tax) > 0) {
        $args['tax_query'] = $_tax;
    }

    $the_query = new WP_Query($args);

    $posts = $the_query->posts;

    $count_posts = $the_query->post_count;

    $nav = '';
    $content = '';
    $mb = '';
    $mb_content = '';
    $key = [1, 2, 3, 4];
    $count_key = 0;


    foreach ($posts as $k => $item) {
        $active = $k == 0 ? 'active' : '';
        $count_key = $count_key + 1;
        $price = get_field('price', $item->ID);

        $nav .= '<li class="' . $active . '"><a href="#">' . get_field('name_bike', $item->ID) . ' (' . number_format($price, 0, '.', '.') . '₫)</a></li>';
        $content .= '<div class="detail-content ' . $active . '">
        <p class="sub-title">' . get_field('name_service', $item->ID) . '</p>
        <h3 class="title">' . get_field('name_bike', $item->ID) . '</h3>
        <p class="price">' . number_format($price, 0, '.', '.') . '₫</p>
        <div class="image">
            <img src="' . get_field('image', $item->ID) . '" alt="img-service-package-detail" class="img-fluid">
        </div>
        <div>' . get_field('content', $item->ID) . '</div>
        <ul>
            <li><img src="' . get_template_directory_uri() . '/img/all-service/icons/icon-star.svg" alt="icon" class="icon">' . get_field('rating', $item->ID) . '</li>
            <li><img src="' . get_template_directory_uri() . '/img/all-service/icons/icon-phone.svg" alt="icon" class="icon"><a href="tel:' . get_field('phone_number', $item->ID) . '">' . get_field('phone_number', $item->ID) . '</a></li>
            <li><img src="' . get_template_directory_uri() . '/img/all-service/icons/icon-clock.svg" alt="icon" class="icon">' . get_field('time_active', $item->ID) . '</li>
            <li><img src="' . get_template_directory_uri() . '/img/all-service/icons/icon-pin.svg" alt="icon" class="icon"><a href="#">' . get_field('address', $item->ID) . '</a></li>
        </ul>
        <a href="' . get_permalink(422) . '" class="btn-clip btn-red">BOOK A SERVICE package</a>
    </div>';

        $mb .= '<div class="col-6">
        <div class="background-image" data-toggle="modal" data-target="#packageModal' . $item->ID . '" style="background-image: url(' . get_field('image', $item->ID) . ');">
            <div class="d-md-flex">
                <div class="icon"><img src="' . get_template_directory_uri() . '/img/service/icons/icon-' . $key[$count_key - 1] . '.svg" alt="icon"></div>
                <div class="info">
                    <h3 class="colorWhite exbold ff-1">' . get_field('name_bike', $item->ID) . '</h3>
                    <div style="height: 8px;"></div>
                    <div class="colorLine fz14">' . number_format($price, 0, '.', '.') . '₫</div>
                </div>
            </div>
        </div>
    </div>';

        $mb_content .= '<div class="modal modal-package fade" id="packageModal' . $item->ID . '" tabindex="-1" role="dialog" aria-labelledby="packageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background-image: url(' . get_field('image', $item->ID) . ');">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <div class="icon"><img src="' . get_template_directory_uri() . '/img/service/icons/icon-' . $key[$count_key - 1] . '.svg" alt="icon"></div>
                    <div class="modal-title">
                        <h5 class="title">' . get_field('name_bike', $item->ID) . '</h5>
                        <p class="price">' . number_format($price, 0, '.', '.') . '₫</p>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="scroll">
                        <div class="detail-content">
                            ' . get_field('content', $item->ID) . '

                            <ul>
                                <li><img src="' . get_template_directory_uri() . '/img/all-service/icons/icon-star.svg" alt="icon">' . get_field('rating', $item->ID) . '</li>
                                <li><img src="' . get_template_directory_uri() . '/img/all-service/icons/icon-phone.svg" alt="icon"><a href="tel:' . get_field('phone_number', $item->ID) . '">' . get_field('phone_number', $item->ID) . '</a></li>
                                <li><img src="' . get_template_directory_uri() . '/img/all-service/icons/icon-clock.svg" alt="icon">' . get_field('time_active', $item->ID) . '</li>
                                <li><img src="' . get_template_directory_uri() . '/img/all-service/icons/icon-pin.svg" alt="icon"><a href="#">' . get_field('address', $item->ID) . '</a></li>
                            </ul>
                        </div>
                    </div>
                    <a href="' . get_permalink(422) . '" class="btn-clip btn-border-red">BOOK A SERVICE package</a>
                </div>
            </div>
        </div>
    </div>';

        if ($count_key > 3) {
            $count_key = 0;
        }
    }

    wp_reset_query();
    wp_reset_postdata();

    $arr = [];
    $arr[0] = $nav;
    $arr[1] = $content;
    $arr[2] = $count_posts;
    $arr[3] = $mb;
    $arr[4] = $mb_content;

    echo json_encode($arr);
    die;
}

add_action('wp_ajax_filter_bike', 'filter_bike_ajax_handler'); // wp_ajax_{action}
add_action('wp_ajax_nopriv_filter_bike', 'filter_bike_ajax_handler'); // wp_ajax_nopriv_{action}


function filter_dealer_ajax_handler()
{
    $provine = $_POST['provine'];

    $_tax = array();
    $arr = [];

    $args = array(
        'post_type' => 'dealer',
        'paged' => 1,
        'post_status' => 'publish',
        'posts_per_page' => -1,

    );


    $term_child = get_term_children($provine, 'location');
    $nav = '';

    foreach ($term_child as $child) {
        $term = get_term_by('id', $child, 'location');

        $nav .= '<a class="dropdown-item" href="javascript:void(0)" data-town="' . $term->term_id . '">' . $term->name . '</a>';
    }


    if ($provine) {
        $_tax = array(
            array(
                'key'     => 'location',
                'value'   => join(',', $term_child),
                'compare' => 'IN'
            ),
        );
    }


    if (count($_tax) > 0) {
        $args['meta_query'] = $_tax;
    }
    $query = new WP_Query($args);

    $posts = $query->posts;
    $count = $query->post_count;


    // we need next page to be loaded

    $out = '';
    foreach ($posts as $k => $post) {

        $out .= '<div class="item-address ' . ($k == 0 ? 'active' : '') . '" data-address="' . get_field('address', $post->ID) . '"><p><strong>' . get_the_title($post->ID) . '</strong></p><p><img src="' . get_template_directory_uri() . '/img/dealers/icon-pin.svg" alt="icon">' . get_field('address', $post->ID) . '</p><p><img src="' . get_template_directory_uri() . '/img/dealers/icon-phone.svg" alt="icon"><a href="tel:' . get_field('phone_number', $post->ID) . '">' . get_field('phone_number', $post->ID) . '</a></p></div>';
    }


    // print_r($posts);

    wp_reset_postdata();

    $arr = array('count' => $count, 'nav' => $nav, 'data' => $out);


    echo json_encode($arr);
    die();
}

add_action('wp_ajax_filter_dealer', 'filter_dealer_ajax_handler'); // wp_ajax_{action}
add_action('wp_ajax_nopriv_filter_dealer', 'filter_dealer_ajax_handler'); // wp_ajax_nopriv_{action}

function filter_dealer_town_ajax_handler()
{
    $provine = $_POST['provine'];
    $town = $_POST['town'];

    $_tax = array();
    $arr = [];

    $args = array(
        'post_type' => 'dealer',
        'paged' => 1,
        'post_status' => 'publish',
        'posts_per_page' => -1,

    );


    $term_child = get_term_children($provine, 'location');
    $nav = '';

    foreach ($term_child as $child) {
        $term = get_term_by('id', $child, 'location');

        $nav .= '<a class="dropdown-item" href="javascript:void(0)" data-town="' . $term->term_id . '">' . $term->name . '</a>';
    }


    if ($provine) {
        $_tax = array(
            array(
                'key'     => 'location',
                'value'   => join(',', $term_child),
                'compare' => 'IN'
            ),
        );
    }


    if (count($_tax) > 0) {
        $args['meta_query'] = $_tax;
    }
    $query = new WP_Query($args);

    $posts = $query->posts;
    $count = $query->post_count;

    // we need next page to be loaded

    $out = '';
    $count_town_filter = 0;

    // print_r($posts);

    foreach ($posts as $k => $post) {
        $term_list = get_field('location', $post->ID);
        if ($term_list->term_id == $town) {

            $count_town_filter++;
            $out .= '<div class="item-address ' . ($k == 0 ? 'active' : '') . '" data-address="' . get_field('address', $post->ID) . '"><p><strong>' . get_the_title($post->ID) . '</strong></p><p><img src="' . get_template_directory_uri() . '/img/dealers/icon-pin.svg" alt="icon">' . get_field('address', $post->ID) . '</p><p><img src="' . get_template_directory_uri() . '/img/dealers/icon-phone.svg" alt="icon"><a href="tel:' . get_field('phone_number', $post->ID) . '">' . get_field('phone_number', $post->ID) . '</a></p></div>';
        }
    }



    wp_reset_postdata();

    $arr = array('count' => $count_town_filter, 'data' => $out);


    echo json_encode($arr);
    die();
}

add_action('wp_ajax_filter_dealer_town', 'filter_dealer_town_ajax_handler'); // wp_ajax_{action}
add_action('wp_ajax_nopriv_filter_dealer_town', 'filter_dealer_town_ajax_handler'); // wp_ajax_nopriv_{action}


/////FIND ///////

function find_ajax_handler()
{
    $find = $_POST['f'];

    $args_bike1 = array(
        'post_type' => 'product',
        'paged' => 1,
        'post_status' => 'publish',
        'posts_per_page' => -1,
        's' => $find,
        'suppress_filters' => false,
    );
    $args_bike2 = array(
        'post_type' => 'product',
        'paged' => 1,
        'post_status' => 'publish',
        'posts_per_page' => -1,
        'suppress_filters' => false,
        'tax_query' => array(
            array(
                'taxonomy' => 'products',
                'field' => 'name',
                'terms' => $find
            ),
        )
    );


    $query_bike1 = new WP_Query($args_bike1);
    $query_bike2 = new WP_Query($args_bike2);

    $loop = new WP_Query();
    $loop->posts = array_merge($query_bike1->posts, $query_bike2->posts);

    $bikes = $loop->posts;

    $out_bike = '';
    $loop->post_count = $query_bike1->post_count + $query_bike2->post_count;;
    $len_bike = $loop->post_count;

    $args_apparel1 = array(
        'post_type' => 'item',
        'paged' => 1,
        'post_status' => 'publish',
        'posts_per_page' => -1,
        's' => $find,
        'suppress_filters' => true,
    );
    $args_apparel2 = array(
        'post_type' => 'item',
        'paged' => 1,
        'post_status' => 'publish',
        'posts_per_page' => -1,
        'suppress_filters' => true,
        'tax_query' => array(
            array(
                'taxonomy' => 'apparels',
                'field' => 'name',
                'terms' => $find
            ),
        )
    );

    $query_apparel1 = new WP_Query($args_apparel1);
    $query_apparel2 = new WP_Query($args_apparel2);

    $loop2 = new WP_Query();
    $loop2->posts = array_merge($query_apparel1->posts, $query_apparel2->posts);
    $apparel = $loop2->posts;

    $out_apparel = '';

    $loop2->post_count = $query_apparel1->post_count + $query_apparel2->post_count;;

    $len_apparel = $loop2->post_count;

    $args_news = array(
        'post_type' => 'news',
        'paged' => 1,
        'post_status' => 'publish',
        'posts_per_page' => -1, //4
        's' => $find,
        'suppress_filters' => true
    );

    $query_news = new WP_Query($args_news);

    $news = $query_news->posts;

    $out_news = '';
    $len_news = $query_news->post_count;



    if ($bikes) {
        foreach ($bikes as $post) {
            $price = get_field("feature_product", $post->ID)['feature_price'];
            $out_bike .= '<div class="product-item item-25"><a href="' . get_permalink($post->ID) . '" class="stretched-link"></a><div class="product__image"><img src="' . get_field("feature_product", $post->ID)['feature_img'] . '" alt=""></div><div class="product__content"><div class="title">' . get_field("feature_product", $post->ID)['feature_title'] . '</div><div class="text colorLGray">From <span class="fz20">' . number_format($price, 0, '.', '.') . '₫</span></div></div></div>';
        }
    }
    if ($apparel) {
        $sale = '';
        $hide = '';

        foreach ($apparel as $k => $item) {
            $types = get_the_terms($item->ID, 'tag');

            foreach ($types as $type) {
                if ($type->slug === 'sale-off') {
                    $sale = 'sale';
                }
            }

            if ($k > 9) {
                $hide = 'hide';
            }

            $out_apparel .= '<a class="product-item ' . $sale . ' ' . $hide . '" href="' . get_permalink($item->ID) . '">
                <img src="' . get_field("list_image", $item->ID)[0]['image'][0]['sizes']['medium'] . '" alt="" />
                <div class="product-item__title">' . get_the_title($item->ID) . '</div>
                <div class="product-item__price">' . get_field('price', $item->ID) . '</div>
            </a>';

            $sale = '';
        }
    }
    if ($news) {
        foreach ($news as $post) {
            $feature_image = get_field('feature_image', $post->ID);
            $term_name = get_the_terms($post->ID, 'cate');
            $out_news .= '<div class="product-item item-25 pd-16"><a href="' . get_permalink($post->ID) . '" class="stretched-link"></a><div class="product__image"><img src="' . $feature_image . '" alt=""></div><div class="product__content"><div class="sub-title colorLGray">' . $term_name[0]->name . ' <strong>•</strong> <span>' . get_the_date('M j, Y', $post->ID) . '</span></div><div class="title">' . $post->post_title . '</div></div></div>';
        }
    }

    wp_reset_postdata();


    $arr = [];
    $arr[0]['data'] = $out_bike;
    $arr[0]['length'] = $len_bike;
    $arr[1]['data'] = $out_apparel;
    $arr[1]['length'] = $len_apparel;
    $arr[2]['data'] = $out_news;
    $arr[2]['length'] = $len_news;

    echo json_encode($arr);
    die;
}

add_action('wp_ajax_find', 'find_ajax_handler'); // wp_ajax_{action}
add_action('wp_ajax_nopriv_find', 'find_ajax_handler'); // wp_ajax_nopriv_{action}


/////GET POST VIEW ////

function gt_get_post_view()
{
    $count = get_post_meta(get_queried_object_id(), 'post_views_count', true);
    return "$count lượt xem";
}
function gt_set_post_view()
{
    $key = 'post_views_count';
    $post_id = get_queried_object_id();
    $count = (int) get_post_meta($post_id, $key, true);
    $count++;
    update_post_meta($post_id, $key, $count);
}
function gt_posts_column_views($columns)
{
    $columns['post_views'] = 'Views';
    return $columns;
}
function gt_posts_custom_column_views($column)
{
    if ($column === 'post_views') {
        echo gt_get_post_view();
    }
}

add_filter('manage_posts_columns', 'gt_posts_column_views');
add_action('manage_posts_custom_column', 'gt_posts_custom_column_views');

function ip_get_like_count($type = 'likes')
{
    $current_count = get_post_meta(get_queried_object_id(), $type, true);

    return ($current_count ? $current_count : 0);
}

function ip_process_like()
{
    $processed_like = false;
    $redirect       = false;

    // Check if like or dislike
    if (isset($_GET['post_action'])) {
        // Like
        $like_count = get_post_meta(get_queried_object_id(), 'likes', true);
        if ($_GET['post_action'] == 'like') {

            $cookie_name = "u_browser";
            if (isset($_COOKIE['uid'])) {
                $cookie_value = $_COOKIE['uid'];
                setcookie($cookie_name, $cookie_value, time() + (86400 * 365 * 10), "/");
            }

            if ($like_count) {
                $like_count = $like_count + 1;
            } else {
                $like_count = 1;
            }

            $processed_like = update_post_meta(get_queried_object_id(), 'likes', $like_count);
        } elseif ($_GET['post_action'] == 'dislike') {
            // Dislike


            if ($like_count > 0) {
                $like_count = $like_count - 1;
            } else {
                $like_count = 0;
            }
            unset($_COOKIE['u_browser']);
            setcookie('u_browser', null, -1, '/');

            $processed_like = update_post_meta(get_the_id(), 'likes', $like_count);
        }


        if ($processed_like) {
            $redirect = get_the_permalink();
        }
    }

    // Redirect
    if ($redirect) {
        wp_redirect($redirect);
        die;
    }
}

add_action('template_redirect', 'ip_process_like');


//////////////POST SERVICE//////////////

function form_service_ajax_handler()
{

    $order = $_POST['order'];

    $field = [];

    $args = array(
        'post_type'     => 'book_service',
        'post_title'    => $order['name'],
        'post_status'   => 'publish',
        'post_author'   => 1,
    );

    $result = wp_insert_post($args);

    if ($result && !is_wp_error($result)) {
        $post_id = $result;
    }

    // wp_insert_post($args);

    $field['name'] = $order['name'];
    $field['type'] = $order['type'];
    $field['model'] = $order['model'];
    $field['phone'] = $order['phone'];
    $field['email'] = $order['email'];
    $field['address'] = $order['address'];
    $field['date'] = $order['date'];
    if ($order['time'] === "1") {
        $field['section_of_day'] = 1;
        $field['time'] = "08:00 AM - 11:00 AM";
    } else {
        $field['section_of_day'] = 0;
        $field['time'] = "01:00 PM - 09:00 PM";
    }

    $field['plan'] = $order['plan'];
    $field['dealer']['dealer_name'] = $order['dealer']['address_name'];
    $field['dealer']['dealer_address'] = $order['dealer']['address'];
    $field['message'] = $order['message'];


    update_field('name', $field['name'], $post_id);
    update_field('type', $field['type'], $post_id);
    update_field('model', $field['model'], $post_id);
    update_field('phone_number', $field['phone'], $post_id);
    update_field('email_address', $field['email'], $post_id);
    update_field('address', $field['address'], $post_id);
    update_field('date', $field['date'], $post_id);
    update_field('section_of_day', $field['section_of_day'], $post_id);
    update_field('time', $field['time'], $post_id);
    update_field('service_plan', $field['plan'], $post_id);
    update_field('dealer_name', $field['dealer']['dealer_name'], $post_id);
    update_field('dealer_address', $field['dealer']['dealer_address'], $post_id);
    update_field('message', $field['message'], $post_id);


    exit();
}

add_action('wp_ajax_form_service', 'form_service_ajax_handler'); // wp_ajax_{action}
add_action('wp_ajax_nopriv_form_service', 'form_service_ajax_handler'); // wp_ajax_nopriv_{action}

//////////////POST BIKE//////////////
function form_bike_ajax_handler()
{

    $order = $_POST['order'];

    $field = [];

    $args = array(
        'post_type'     => 'book_buy_bike',
        'post_title'    => $order['name'],
        'post_status'   => 'publish',
        'post_author'   => 1,
    );

    $result = wp_insert_post($args);

    if ($result && !is_wp_error($result)) {
        $post_id = $result;
        // Do something else
    }

    // wp_insert_post($args);

    $field['name'] = $order['name'];
    $field['type'] = $order['type'];
    $field['model'] = $order['model'];
    $field['phone'] = $order['phone'];
    $field['email'] = $order['email'];
    $field['address'] = $order['address'];
    $field['dealer']['dealer_name'] = $order['dealer']['address_name'];
    $field['dealer']['dealer_address'] = $order['dealer']['address'];
    $field['message'] = $order['message'];


    update_field('name', $field['name'], $post_id);
    update_field('type', $field['type'], $post_id);
    update_field('model', $field['model'], $post_id);
    update_field('phone_number', $field['phone'], $post_id);
    update_field('email_address', $field['email'], $post_id);
    update_field('address', $field['address'], $post_id);
    update_field('dealer_name', $field['dealer']['dealer_name'], $post_id);
    update_field('dealer_address', $field['dealer']['dealer_address'], $post_id);
    update_field('message', $field['message'], $post_id);


    exit();
}

add_action('wp_ajax_form_bike', 'form_bike_ajax_handler'); // wp_ajax_{action}
add_action('wp_ajax_nopriv_form_bike', 'form_bike_ajax_handler'); // wp_ajax_nopriv_{action}


//////////////POST APPAREL//////////////

function form_apparel_ajax_handler()
{

    $order = $_POST['order'];

    $field = [];

    $args = array(
        'post_type'     => 'book_buy_apparel',
        'post_title'    => $order['name'],
        'post_status'   => 'publish',
        'post_author'   => 1,
    );

    $result = wp_insert_post($args);

    if ($result && !is_wp_error($result)) {
        $post_id = $result;
        // Do something else
    }

    // wp_insert_post($args);

    $field['name'] = $order['name'];
    $field['phone'] = $order['phone'];
    $field['email'] = $order['email'];
    $field['address'] = $order['address'];
    $field['dealer']['dealer_name'] = $order['dealer']['address_name'];
    $field['dealer']['dealer_address'] = $order['dealer']['address'];
    $field['message'] = $order['message'];
    $field['address'] = $order['address'];
    $field['title'] = $order['title'];
    $field['size'] = $order['size'];
    $field['color'] = '#' . $order['color'];
    $field['price'] = $order['price'];
    $field['quantity'] = $order['quantity'];


    update_field('name', $field['name'], $post_id);
    update_field('phone_number', $field['phone'], $post_id);
    update_field('email_address', $field['email'], $post_id);
    update_field('address', $field['address'], $post_id);
    update_field('dealer_name', $field['dealer']['dealer_name'], $post_id);
    update_field('dealer_address', $field['dealer']['dealer_address'], $post_id);
    update_field('message', $field['message'], $post_id);
    update_field('title', $field['title'], $post_id);
    update_field('size', $field['size'], $post_id);
    update_field('color', $field['color'], $post_id);
    update_field('price', $field['price'], $post_id);
    update_field('quantity', $field['quantity'], $post_id);


    exit();
}

add_action('wp_ajax_form_apparel', 'form_apparel_ajax_handler'); // wp_ajax_{action}
add_action('wp_ajax_nopriv_form_apparel', 'form_apparel_ajax_handler'); // wp_ajax_nopriv_{action}

//////////////POST TEST DRIVE//////////////
function form_test_drive_ajax_handler()
{

    $order = $_POST['order'];

    $field = [];

    $args = array(
        'post_type'     => 'book_test_drive',
        'post_title'    => $order['name'],
        'post_status'   => 'publish',
        'post_author'   => 1,
    );

    $result = wp_insert_post($args);

    if ($result && !is_wp_error($result)) {
        $post_id = $result;
        // Do something else
    }

    // wp_insert_post($args);

    $field['name'] = $order['name'];
    $field['type'] = $order['type'];
    $field['model'] = $order['model'];
    $field['phone'] = $order['phone'];
    $field['email'] = $order['email'];
    $field['address'] = $order['address'];
    $field['dealer']['dealer_name'] = $order['dealer']['address_name'];
    $field['dealer']['dealer_address'] = $order['dealer']['address'];
    $field['date'] = $order['date'];
    if ($order['time'] === "1") {
        $field['section_of_day'] = 1;
        $field['time'] = "08:00 AM - 11:00 AM";
    } else {
        $field['section_of_day'] = 0;
        $field['time'] = "01:00 PM - 09:00 PM";
    }
    if ($order['lincense'] === "0") {
        $field['license'] = 0;
    } else {
        $field['license'] = 1;
    }


    update_field('name', $field['name'], $post_id);
    update_field('type', $field['type'], $post_id);
    update_field('model', $field['model'], $post_id);
    update_field('phone_number', $field['phone'], $post_id);
    update_field('email_address', $field['email'], $post_id);
    update_field('address', $field['address'], $post_id);
    update_field('date', $field['date'], $post_id);
    update_field('section_of_day', $field['section_of_day'], $post_id);
    update_field('time', $field['time'], $post_id);
    update_field('service_plan', $field['plan'], $post_id);
    update_field('dealer_name', $field['dealer']['dealer_name'], $post_id);
    update_field('dealer_address', $field['dealer']['dealer_address'], $post_id);
    update_field('license', $field['lincense'], $post_id);


    exit();
}

add_action('wp_ajax_form_test_drive', 'form_test_drive_ajax_handler'); // wp_ajax_{action}
add_action('wp_ajax_nopriv_form_test_drive', 'form_test_drive_ajax_handler'); // wp_ajax_nopriv_{action}