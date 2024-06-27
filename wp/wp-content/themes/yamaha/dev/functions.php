<?php

global $arrCat_apparel_Show, $arrCat_bike_Show ; 
//HYPER NAKED = 19, SUPER SPORT = 18 , SPORT TOURING = 17, ADVENTURE TOURING = 16, OFF ROAD = 41, SCOOTER=14
$arrCat_bike_Show = []; //[14, 16, 17, 18, 19, 41]; 
// ÁO, NON, AO KHOAT
$arrCat_apparel_Show = [];

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
            'show_in_nav_menus' => false,
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
            'show_in_nav_menus' => false,
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

    // register_post_type(
    //     'service',
    //     array(
    //         'labels' => array(
    //             'name' => __('Tin Dịch Vụ'),
    //             'singular_name' => __('Dịch Vụ')
    //         ),

    //         'public' => true,
    //         'has_archive' => false,
    //         'supports' => array('title', 'editor', 'thumbnail'),
    //     )
    // );

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
            'show_in_nav_menus' => false,
            'has_archive' => false,
            'supports' => array('title', 'editor',),
        )
    );

    register_post_type(
        'book_service_package',
        array(
            'labels' => array(
                'name' => __('Đặt Gói Dịch Vụ'),
                'singular_name' => __('Đặt Gói Dịch Vụ')
            ),
            'public' => true,
            'show_in_nav_menus' => false,
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
            'show_in_nav_menus' => false,
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
            'show_in_nav_menus' => false,
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
            'show_in_nav_menus' => false,
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
        'posts_per_page' => 6,
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
        $dot = $term_name[0]->name ? '<strong>•</strong>' : '';
        $out .= '<div class="col-lg-6 col-12 news__daily-wrapper news-load">
                        <a href="' . get_permalink($post->ID) . '" class="stretched-link"></a>
                        <div class="news__daily-img">
                            <img src="' . $feature_image . '" alt="" class="" />
                        </div>
                        <div class="news__daily-item">
                            <label for="" class="news__headline">' . $term_name[0]->name . ' ' . $dot . ' <span>' . get_the_date('d/m/Y', $post->ID) . '</span></label>
                            <div style="height: 16px;" class="d-lg-block d-xl-block d-none"></div>
                            <div style="height: 8px;" class="d-block d-lg-none d-xl-none"></div>
                            <div class="fz18 bold des">' . $post->post_title . '</div>
                            <div class="fz14 des" style="font-style:italic;">' . strip_tags(get_field('short_description', $post->ID)) . '</div>
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

    $arr = [];


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
    $count = $query->post_count;

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
        <div class="product-item__price">' . number_format($price, 0, ',', ',') . ' đ</div>
    </a>';

        $sale = '';
    }

    wp_reset_postdata();
    $arr = array('count' => $count, 'data' => $out);
    echo json_encode($arr);
    die;
}

add_action('wp_ajax_loadmoreApparel', 'loadmoreApparel_ajax_handler'); // wp_ajax_{action}
add_action('wp_ajax_nopriv_loadmoreApparel', 'loadmoreApparel_ajax_handler'); // wp_ajax_nopriv_{action}

function load_color_ajax_handler()
{
    $index = $_POST['i'];
    $id = $_POST['id'];


    $first = get_field("list_image", $id)[$index]['image'][0];
    $items = get_field("list_image", $id)[$index]['image'];
    $list_sizes = get_field("list_image", $id)[$index]['size_code_price'];
    $price_size = get_field("list_image", $id)[$index]['size_code_price'][0]['price'];
    //$price_size = $color_list[$index]['list_image'][0]['price'];

    // we need next page to be loaded

    $string = '<div class="row"><div class="main-pic col-12"><img class="img-zoom img" src="' . $first['sizes']['medium'] . '" data-zoom-image="' . $first['sizes']['large'] . '" /></div><div class="thumb-pics col-12" id="gallery_01">';
    $out = '';

    foreach ($items as $k => $item) {
        $active = '';
        if ($k == 0) {
            $active = 'active';
        }
        $out .= '<a href="#" class="thumb-gallery ' . $active . '" data-update="" data-image="' . $item['sizes']['medium'] . '" data-zoom-image="' . $item['sizes']['large'] . '"><img src="' . $item['sizes']['medium'] . '" class="img-fluid" /></a>';
    }

    $out1 = '';

    foreach ($list_sizes as $k => $item) {
        
        $active = '';
        if ($k == 0) {
            $active = 'active';
        }
        $out1 .= '
            <li class="'. $active .'">
               <a size_code="'. $item['size_code'] .'" size_name="'. $item['size_code'] .'" data-size="'. $item['size_code'] .'" data-price="'. $item['price'] . ' "data-product_code=' . $item['sf_product_code'] .'" class="'. $active .'" href="javascript:void(0)">'. $item['size_code'] .'  
               </a>
            </li>
        ';
    }

    $string = $string . $out . '</div></div>';

    $array_string = array(
        'string' => $string,
        'out1' =>  $out1,
        'out2' =>  $price_size,
        'product_code' => $list_sizes[0]['sf_product_code'],
    );    

    wp_reset_postdata();

    die(json_encode($array_string));
}

add_action('wp_ajax_load_color_ajax_handler', 'load_color_ajax_handler'); // wp_ajax_{action}
add_action('wp_ajax_nopriv_load_color_ajax_handler', 'load_color_ajax_handler'); // wp_ajax_nopriv_{action}

function load_dealer_ajax_handler()
{
    global $wpdb;
    $table_dealers_inventory = $wpdb->prefix.'dealers_inventory';


    $index = $_POST['i'];
    $id = $_POST['id'];
    $type = $_POST['type'];
    $inventory = [];
    if(isset($type) && $type == 'product'){
        $color_code = get_field("overview_list_colors", $id)[$index]['color_code'];
    }else{
        $color_code = get_field("list_image", $id)[$index]['color_code'];
    }
    $product_code = get_field('product_code', $id);
    // $product_code = 'B8D600';
    if($product_code){
        $query = "SELECT * FROM {$table_dealers_inventory} WHERE product_code = '{$product_code}'";
        if($color_code){
            $query .= " and color_code = '{$color_code}'";
        }   
        $inventory = $wpdb->get_results($query);  
        // die(json_encode($inventory));
    }else{
        // die('123456');
    }
    die(json_encode($inventory));
}

add_action('wp_ajax_load_dealer_ajax_handler', 'load_dealer_ajax_handler'); // wp_ajax_{action}
add_action('wp_ajax_nopriv_load_dealer_ajax_handler', 'load_dealer_ajax_handler'); // wp_ajax_nopriv_{action}


function loadmoreService_ajax_handler()
{
    $paged = $_POST['paged'] + 1;

    $name = $_POST['id'];
    $type = $_POST['type'];
    $bike = $_POST['bike'];

    $_tax = array();
    $arr = [];

    if ($bike === 'tat-ca' && $name === '' && $type === '') {
        if ($type) {
            $_tax = array(
                array(
                    'taxonomy' => 'type_services',
                    'field' => 'slug',
                    'terms' => $type,
                )
            );
        }

        $args_service = array(
            'post_type' => 'package',
            'paged' => 1,
            'post_status' => 'publish',
            'posts_per_page' => 6,
        );



        if (count($_tax) > 0) {
            $args_service['tax_query'] = $_tax;
        }

        $ser_post = get_posts(array(
            'post_type' => 'package',
            'paged' => 1,
            'post_status' => 'publish',
            'posts_per_page' => -1,
        ));

        $service_max = count($ser_post);
    } else if ($bike === 'tat-ca' || $name !== '' || $type !== '') {
        $args_service = array(
            'post_type' => 'package',
            'paged' => 1,
            'post_status' => 'publish',
            'posts_per_page' => 6,
            'tax_query' => array(
                array(
                    'taxonomy' => 'type_services',
                    'field' => 'slug',
                    'terms' => $type,
                ),
            )
        );

        $ser_post = get_posts(array(
            'post_type' => 'package',
            'paged' => 1,
            'post_status' => 'publish',
            'posts_per_page' => -1,
            'tax_query' => array(
                array(
                    'relation' => "AND",
                    array(
                        'taxonomy' => 'type_services',
                        'field' => 'slug',
                        'terms' => $type,
                    ),
                    array(
                        'taxonomy' => 'products',
                        'field' => 'slug',
                        'terms' => $bike,
                    ),
                )
            )
        ));

        $service_max = count($ser_post);
    } else {

        $args_service = array(
            'post_type' => 'package',
            'paged' => 1,
            'post_status' => 'publish',
            'posts_per_page' => 6,
            'tax_query' => array(
                array(
                    'relation' => "AND",
                    array(
                        'taxonomy' => 'type_services',
                        'field' => 'slug',
                        'terms' => $type,
                    ),
                    array(
                        'taxonomy' => 'products',
                        'field' => 'slug',
                        'terms' => $bike,
                    ),
                )
            )
        );

        $ser_post = get_posts(array(
            'post_type' => 'package',
            'paged' => 1,
            'post_status' => 'publish',
            'posts_per_page' => -1,
            'tax_query' => array(
                array(
                    'relation' => "AND",
                    array(
                        'taxonomy' => 'type_services',
                        'field' => 'slug',
                        'terms' => $type,
                    ),
                    array(
                        'taxonomy' => 'products',
                        'field' => 'slug',
                        'terms' => $bike,
                    ),
                )
            )
        ));

        $service_max = count($ser_post);
    }



    // we need next page to be loaded

    $ser_query = new WP_Query($args_service);

    $service = $ser_query->posts;

    $service_count = $ser_query->post_count;

    // print_r($type);die;

    $out = '';

    foreach ($service as $k => $e) {

        $item = get_field("list_service_bike", $e->ID);
        $types = get_the_terms($e->ID, 'type_services')[0];
        //  print_r($item);
        // die;
        if ($bike === 'tat-ca' && $name === '') {
            $out .= '<div class="col-6">
                        <div class="background-image" style="background-image: url(' . get_field("image", $e->ID) . ');">
                            <div class="block-service">
                                <div class="slug">
                                    <span class="one-line">' . $types->name . '<strong>&nbsp; • &nbsp;</strong></span>
                                    <span>' . get_field("number_service", $e->ID) . ' Dịch vụ <strong>&nbsp; • &nbsp;</strong></span>
                                    <span>' . get_field("month", $e->ID) . ' Tháng</span>
                                </div>
                                <div class="d-md-flex justify-content-between w-100">
                                    <div class="info">
                                        <h3 class="colorWhite exbold ff-1">' . get_the_title($e->ID) . '</h3>
                                        <p class="price">' . number_format(get_field('price', $e->ID), 0, ',', ',') . ' ₫</p>
                                    </div>
                                    <a href="' . get_permalink($e->ID) . '" class="btn-clip btn-border-white w-auto align-self-center">Xem chi tiết <span class="ico__chev-right"></span></a>
                                </div>
                            </div>
                        </div>
                    </div>';
        } else if ($bike === 'tat-ca' || $name !== '' || $type !== '') {
            foreach ($item as $key => $v) {
                if ($name == $v->ID) {
                    $out .= '<div class="col-6">
                        <div class="background-image" style="background-image: url(' . get_field("image", $e->ID) . ');">
                            <div class="block-service">
                                <div class="slug">
                                    <span class="one-line">' . $types->name . '<strong>&nbsp; • &nbsp;</strong></span>
                                    <span>' . get_field("number_service", $e->ID) . ' Dịch vụ <strong>&nbsp; • &nbsp;</strong></span>
                                    <span>' . get_field("month", $e->ID) . ' Tháng</span>
                                </div>
                                <div class="d-md-flex justify-content-between w-100">
                                    <div class="info">
                                        <h3 class="colorWhite exbold ff-1">' . get_the_title($e->ID) . '</h3>
                                        <p class="price">' . number_format(get_field('price', $e->ID), 0, ',', ',') . ' ₫</p>
                                    </div>
                                    <a href="' . get_permalink($e->ID) . '" class="btn-clip btn-border-white w-auto align-self-center">Xem chi tiết <span class="ico__chev-right"></span></a>
                                </div>
                            </div>
                        </div>
                    </div>';
                }
            }
        } else {
            foreach ($item as $key => $v) {
                if ($name == $v->ID) {
                    $out .= '<div class="col-6">
                        <div class="background-image" style="background-image: url(' . get_field("image", $e->ID) . ');">
                            <div class="block-service">
                                <div class="slug">
                                    <span class="one-line">' . $types->name . '<strong>&nbsp; • &nbsp;</strong></span>
                                    <span>' . get_field("number_service", $e->ID) . ' Dịch vụ <strong>&nbsp; • &nbsp;</strong></span>
                                    <span>' . get_field("month", $e->ID) . ' Tháng</span>
                                </div>
                                <div class="d-md-flex justify-content-between w-100">
                                    <div class="info">
                                        <h3 class="colorWhite exbold ff-1">' . get_the_title($e->ID) . '</h3>
                                        <p class="price">' . number_format(get_field('price', $e->ID), 0, ',', ',') . ' ₫</p>
                                    </div>
                                    <a href="' . get_permalink($e->ID) . '" class="btn-clip btn-border-white w-auto align-self-center">Xem chi tiết <span class="ico__chev-right"></span></a>
                                </div>
                            </div>
                        </div>
                    </div>';
                }
            }
        }
    }

    wp_reset_postdata();

    die($out);
}

add_action('wp_ajax_loadmoreService', 'loadmoreService_ajax_handler'); // wp_ajax_{action}
add_action('wp_ajax_nopriv_loadmoreService', 'loadmoreService_ajax_handler'); // wp_ajax_nopriv_{action}

function loadmoreService_mb_ajax_handler()
{
    $paged = $_POST['paged'] + 1;

    $name = $_POST['name'];
    $type = $_POST['type'];

    $_tax = array();
    $arr = [];

    $args_service = array(
        'post_type' => 'package',
        'paged' => $paged,
        'post_status' => 'publish',
        'posts_per_page' => 1,
        'suppress_filters' => true,
        'tax_query' => array(
            array(
                'taxonomy' => 'type_services',
                'field' => 'slug',
                'terms' => $type,
            ),
        )
    );

    // if ($type) {
    //     $_tax = ;
    // }

    // if (count($_tax) > 0) {
    //     $args['tax_query'] = $_tax;
    // }

    // we need next page to be loaded

    $ser_query = new WP_Query($args_service);

    $service = $ser_query->posts;

    // print_r($type);die;

    $out = '';

    foreach ($service as $k => $e) {
        $types = get_the_terms($e->ID, 'type_services')[0];
        if ($name === get_the_title($e->ID)) {
            $out .= '<div class="col-6">
        <div class="background-image" style="background-image: url(' . get_field("image", $e->ID) . ');">
            <a href="' . get_permalink($e->ID) . '" class="stretched-link"></a>
            <div class="icon">
                <img src="' . get_template_directory_uri() . '/img/service/icons/icon-' . ($k + 1 + $_POST['paged']) . '.svg" alt="">
            </div>
            <div class="block-service">
                <div class="slug">
                    <span class="one-line">' . $types->name . '<strong>&nbsp; • &nbsp;</strong></span>
                    <span>' . get_field("number_service", $e->ID) . ' Dịch vụ <strong>&nbsp; • &nbsp;</strong></span>
                    <span>' . get_field("month", $e->ID) . ' Tháng</span>
                </div>
                <div class="d-md-flex justify-content-between w-100">
                    <div class="info">
                        <h3 class="colorWhite exbold ff-1">' . get_the_title($e->ID) . '</h3>
                        <p class="price">' . number_format(get_field('price', $e->ID), 0, '.', '.') . ' ₫</p>
                    </div>
                    <a href="' . get_permalink($e->ID) . '" class="btn-clip btn-border-white w-auto align-self-center">Xem chi tiết <span class="ico__chev-right"></span></a>
                </div>
            </div>
        </div>
    </div>';
        }
    }

    wp_reset_postdata();

    die($out);
}

add_action('wp_ajax_loadmoreService_mb', 'loadmoreService_mb_ajax_handler'); // wp_ajax_{action}
add_action('wp_ajax_nopriv_loadmoreService_mb', 'loadmoreService_mb_ajax_handler'); // wp_ajax_nopriv_{action}

////////FILTER/ ////////////
function filter_items_ajax_handler()
{
    global $wpdb;

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
        <div class="product-item__price">' . number_format($price, 0, ',', ',') . ' đ</div>
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
        $engine = get_field("specification_overview", $post->ID)['engine'];
        $out .= '<a class="dropdown-item" href="javascript:void(0)" data-val="' . get_the_title($post->ID) . '" data-img="' . get_field("feature_product", $post->ID)['feature_img'] . '" data-price="' . get_field("feature_product", $post->ID)['feature_price'] . '" data-cc="' . $engine . '">' . get_the_title($post->ID) . '</a>';
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
    $check_tag = $_POST['not_tag'];

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
        $out .= '<a class="dropdown-item" href="javascript:void(0)" data-code="' . get_field("dealer_code", $e->ID) . '" data-name="' . get_the_title($e->ID) . '" data-address="' . get_field("address", $e->ID) . '">' . get_the_title($e->ID) . '';

        foreach ($dealers as $i) {

            if ($e->ID === $i->ID) {
                $check = 1;
            }
        }
        if (!$check_tag) {
            if ($check > 0) {
                $out .= '<span class="tag">In stock</span>';
                $check = 0;
            } else {
                $out .= '<span class="tag-pre">Pre-order</span>';
            }
        }

        $out .= '<span class="text-sm">' . get_field("address", $e->ID) . '</span></a>';
    }

    echo $wpdb->last_query;

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

        $nav .= '<li class="' . $active . '"><a href="#">' . get_field('name_bike', $item->ID) . ' (' . number_format($price, 0, ',', ',') . ' ₫)</a></li>';
        $content .= '<div class="detail-content ' . $active . '">
        <p class="sub-title">' . get_field('name_service', $item->ID) . '</p>
        <h3 class="title">' . get_field('name_bike', $item->ID) . '</h3>
        <p class="price">' . number_format($price, 0, ',', ',') . ' ₫</p>
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
                    <div class="colorLine fz14">' . number_format($price, 0, ',', ',') . ' ₫</div>
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
                        <p class="price">' . get_field('price', $item->ID) . ' ₫</p>
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

        $nav .= '<li class="' . $active . '"><a href="#">' . get_field('name_bike', $item->ID) . ' (' . number_format($price, 0, ',', ',') . ' ₫)</a></li>';
        $content .= '<div class="detail-content ' . $active . '">
        <p class="sub-title">' . get_field('name_service', $item->ID) . '</p>
        <h3 class="title">' . get_field('name_bike', $item->ID) . '</h3>
        <p class="price">' . number_format($price, 0, ',', ',') . ' ₫</p>
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
                    <div class="colorLine fz14">' . number_format($price, 0, ',', ',') . ' ₫</div>
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
                        <p class="price">' . number_format($price, 0, ',', ',') . ' ₫</p>
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

function get_serviceBy_type_ajax_handler()
{
    $type = $_POST['type'];
    $bike = $_POST['bike'];
    $name = $_POST['name'];

    $_tax = array();
    $arr = [];

    if ($bike === 'tat-ca' && ($name === '' ||  $name !== '') && $type === '') {

        $args_service = array(
            'post_type' => 'package',
            'paged' => 1,
            'post_status' => 'publish',
            'posts_per_page' => -1,
        );
    } else if ($bike === 'tat-ca' && $type !== '') {
        if ($type) {
            $_tax = array(
                array(
                    'taxonomy' => 'type_services',
                    'field' => 'slug',
                    'terms' => $type,
                )
            );
        }

        $args_service = array(
            'post_type' => 'package',
            'paged' => 1,
            'post_status' => 'publish',
            'posts_per_page' => -1,
        );


        if (count($_tax) > 0) {
            $args_service['tax_query'] = $_tax;
        }
    } else {

        $args_service = array(
            'post_type' => 'package',
            'paged' => 1,
            'post_status' => 'publish',
            'posts_per_page' => -1,
            'tax_query' => array(
                array(
                    'relation' => "AND",
                    array(
                        'taxonomy' => 'type_services',
                        'field' => 'slug',
                        'terms' => $type,
                    ),
                    array(
                        'taxonomy' => 'products',
                        'field' => 'slug',
                        'terms' => $bike,
                    ),
                )
            )
        );
    }



    // we need next page to be loaded

    $ser_query = new WP_Query($args_service);

    $service = $ser_query->posts;

    $service_count = $ser_query->post_count;

    // print_r($service);
    // die;
    $out = '';
    $hide = 'hide';
    $num = 0;


    foreach ($service as $k => $e) {

        $item = get_field("list_service_bike", $e->ID);
        $types = get_the_terms($e->ID, 'type_services')[0];
        //  print_r($item);
        // die;
        if ($bike === 'tat-ca' && $name === '') {
            $num++;

            $out .= '<div class="col-6 ' . ($num > 6 ? $hide : '') . '">
                        <div class="background-image" style="background-image: url(' . get_field("image", $e->ID) . ');">
                            <div class="block-service">
                                <div class="slug">
                                    <span class="one-line">' . $types->name . '<strong>&nbsp; • &nbsp;</strong></span>
                                    <span>' . get_field("number_service", $e->ID) . ' Dịch vụ <strong>&nbsp; • &nbsp;</strong></span>
                                    <span>' . get_field("month", $e->ID) . ' Tháng</span>
                                </div>
                                <div class="d-md-flex justify-content-between w-100">
                                    <div class="info">
                                        <h3 class="colorWhite exbold ff-1">' . get_the_title($e->ID) . '</h3>
                                        <p class="price">' . number_format(get_field('price', $e->ID), 0, ',', ',') . ' ₫</p>
                                    </div>
                                    <a href="' . get_permalink($e->ID) . '" class="btn-clip btn-border-white w-auto align-self-center">Xem chi tiết <span class="ico__chev-right"></span></a>
                                </div>
                            </div>
                        </div>
                    </div>';
        } else if ($bike === 'tat-ca' && $name !== '' && $type !== '') {
            foreach ($item as $key => $v) {
                if ($name == $v->ID) {
                    $num++; 
                    $out .= '<div class="col-6 ' . ($num > 6 ? $hide : '') . '">
                        <div class="background-image" style="background-image: url(' . get_field("image", $e->ID) . ');">
                            <div class="block-service">
                                <div class="slug">
                                    <span class="one-line">' . $types->name . '<strong>&nbsp; • &nbsp;' . $v->ID . '</strong></span>
                                    <span>' . get_field("number_service", $e->ID) . ' Dịch vụ <strong>&nbsp; • &nbsp;</strong></span>
                                    <span>' . get_field("month", $e->ID) . ' Tháng</span>
                                </div>
                                <div class="d-md-flex justify-content-between w-100">
                                    <div class="info">
                                        <h3 class="colorWhite exbold ff-1">' . get_the_title($e->ID) . '</h3>
                                        <p class="price">' . number_format(get_field('price', $e->ID), 0, ',', ',') . ' ₫</p>
                                    </div>
                                    <a href="' . get_permalink($e->ID) . '" class="btn-clip btn-border-white w-auto align-self-center">Xem chi tiết <span class="ico__chev-right"></span></a>
                                </div>
                            </div>
                        </div>
                    </div>';
                }
            }
        } else if ($bike === 'tat-ca' && $name !== '') {
            // print_r($item);
            foreach ($item as $key => $v) {
                // $num++;

                if ($name == $v->ID) {
                    $num++;
                    $out .= '<div class="col-6 ' . ($num > 6 ? $hide : '') . '">
                                <div class="background-image" style="background-image: url(' . get_field("image", $e->ID) . ');">
                                    <div class="block-service">
                                        <div class="slug">
                                            <span class="one-line">' . $types->name . '<strong>&nbsp; • &nbsp;' . $v->ID . '</strong></span>
                                            <span>' . get_field("number_service", $e->ID) . ' Dịch vụ <strong>&nbsp; • &nbsp;</strong></span>
                                            <span>' . get_field("month", $e->ID) . ' Tháng</span>
                                        </div>
                                        <div class="d-md-flex justify-content-between w-100">
                                            <div class="info">
                                                <h3 class="colorWhite exbold ff-1">' . get_the_title($e->ID) . '</h3>
                                                <p class="price">' . number_format(get_field('price', $e->ID), 0, ',', ',') . ' ₫</p>
                                            </div>
                                            <a href="' . get_permalink($e->ID) . '" class="btn-clip btn-border-white w-auto align-self-center">Xem chi tiết <span class="ico__chev-right"></span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>';
                }
            }
        }  else {
            foreach ($item as $key => $v) {
                
                if ($name == $v->ID) {
                    $num++; 
                    $out .= '<div class="col-6 ' . ($num > 6 ? $hide : '') . '">
                        <div class="background-image" style="background-image: url(' . get_field("image", $e->ID) . ');">
                            <div class="block-service">
                                <div class="slug">
                                    <span class="one-line">' . $types->name . '<strong>&nbsp; • &nbsp;</strong></span>
                                    <span>' . get_field("number_service", $e->ID) . ' Dịch vụ <strong>&nbsp; • &nbsp;</strong></span>
                                    <span>' . get_field("month", $e->ID) . ' Tháng</span>
                                </div>
                                <div class="d-md-flex justify-content-between w-100">
                                    <div class="info">
                                        <h3 class="colorWhite exbold ff-1">' . get_the_title($e->ID) . '</h3>
                                        <p class="price">' . number_format(get_field('price', $e->ID), 0, ',', ',') . ' ₫</p>
                                    </div>
                                    <a href="' . get_permalink($e->ID) . '" class="btn-clip btn-border-white w-auto align-self-center">Xem chi tiết <span class="ico__chev-right"></span></a>
                                </div>
                            </div>
                        </div>
                    </div>';
                }
            }
        }
    }

    if ($num > 6) {
        $out .= '<div class="text-center col-12 loadmore-desk">
                <div style="height: 10px;"></div>
                <a href="javascript: void(0);" class="btn-clip btn-border-red w-auto loadmore" data-id="" data-bike="" data-slug="">Xem Thêm</a>
            </div>';
    }


    // print_r($list);
    // die;

    wp_reset_postdata();
    die($out);
}

add_action('wp_ajax_get_serviceBy_type', 'get_serviceBy_type_ajax_handler'); // wp_ajax_{action}
add_action('wp_ajax_nopriv_get_serviceBy_type', 'get_serviceBy_type_ajax_handler'); // wp_ajax_nopriv_{action}

function get_serviceBy_type_mb_ajax_handler()
{
    $bike = $_POST['bike'];
    $name = $_POST['name'];

    $_tax = array();
    $arr = [];


    // we need next page to be loaded

    // print_r($service);die;

    $out = '';
    $head = '';

    $hide = 'hide';
    $num = 0;
    $num2 = 0;

    $package_term = get_terms(array(
        'taxonomy' => 'type_services',
        'hide_empty' => false,
    ));


    // print_r($name);

    foreach ($package_term as $key => $_m) {
        $type = $_m->slug;

        $out .= '<h2 class="colorGray ff-1 text-uppercase">' . $_m->name . '</h2>
        <div style="height: 16px"></div>
        <div class="list-service list-service-' . $_m->term_taxonomy_id . '">
            <div class="row sm-gutters">';
        if ($bike !== 'tat-ca') {

            $args_service = array(
                'post_type' => 'package',
                'paged' => 1,
                'post_status' => 'publish',
                'posts_per_page' => -1,
                'tax_query' => array(
                    array(
                        'relation' => "AND",
                        array(
                            'taxonomy' => 'type_services',
                            'field' => 'slug',
                            'terms' => $type,
                        ),
                        array(
                            'taxonomy' => 'products',
                            'field' => 'slug',
                            'terms' => $bike,
                        ),
                    )
                )
            );
        } else {
            if ($type) {
                $_tax = array(
                    array(
                        'taxonomy' => 'type_services',
                        'field' => 'slug',
                        'terms' => $type,
                    )
                );
            }

            $args_service = array(
                'post_type' => 'package',
                'paged' => 1,
                'post_status' => 'publish',
                'posts_per_page' => -1,
            );



            if (count($_tax) > 0) {
                $args_service['tax_query'] = $_tax;
            }
        }
        $ser_query = new WP_Query($args_service);

        $service = $ser_query->posts;


        foreach ($service as $k => $e) {
            if ($bike !== 'tat-ca') {
                $item = get_field("list_service_bike", $e->ID);
                $types = get_the_terms($e->ID, 'type_services')[0];
                //  print_r($_m->term_id);
                // die;
                if ($_m->term_id === $types->term_id) {

                    foreach ($item as $key => $v) {
                        $num = $key;

                        if ($name == $v->ID) {
                            $out .= '<div class="col-6 ' . ($num > 6 ? $hide : '') . '">
                        <div class="background-image" style="background-image: url(' . get_field("image", $e->ID) . ');">
                            <a href="' . get_permalink($e->ID) . '" class="stretched-link"></a>
                            <div class="caret"></div>
                            <div class="block-service">
                                <div class="slug">
                                    <span class="one-line">' . $types->name . '<strong>&nbsp; • &nbsp;</strong></span>
                                    <span>' . get_field("number_service", $e->ID) . ' Dịch vụ <strong>&nbsp; • &nbsp;</strong></span>
                                    <span>' . get_field("month", $e->ID) . ' Tháng</span>
                                </div>
                                <div class="d-md-flex justify-content-between w-100">
                                    <div class="info">
                                        <h3 class="colorWhite exbold ff-1">' . get_the_title($e->ID) . '</h3>
                                        <p class="price">' . number_format(get_field('price', $e->ID), 0, ',', ',') . ' ₫</p>
                                    </div>
                                    <a href="' . get_permalink($e->ID) . '" class="btn-clip btn-border-white w-auto align-self-center">Xem chi tiết <span class="ico__chev-right"></span></a>
                                </div>
                            </div>
                        </div>
                    </div>';
                        }
                    }
                }
            } else if ($bike === 'tat-ca' && $name !== '') {
                $item = get_field("list_service_bike", $e->ID);

                foreach ($item as $key => $v) {
                    $num = $key;

                    if ($name == $v->ID) {
                        $out .= '<div class="col-6 ' . $num . ' ' . ($num > 6 ? $hide : '') . '">
                    <div class="background-image" style="background-image: url(' . get_field("image", $e->ID) . ');">
                    <a href="' . get_permalink($e->ID) . '" class="stretched-link"></a>
                        <div class="caret"></div>
                        <div class="block-service">
                            <div class="slug">
                                <span class="one-line">' . $types->name . '<strong>&nbsp; • &nbsp;</strong></span>
                                <span>' . get_field("number_service", $e->ID) . ' Dịch vụ <strong>&nbsp; • &nbsp;</strong></span>
                                <span>' . get_field("month", $e->ID) . ' Tháng</span>
                            </div>
                            <div class="d-md-flex justify-content-between w-100">
                                <div class="info">
                                    <h3 class="colorWhite exbold ff-1">' . get_the_title($e->ID) . '</h3>
                                    <p class="price">' . number_format(get_field('price', $e->ID), 0, ',', ',') . ' ₫</p>
                                </div>
                                <a href="' . get_permalink($e->ID) . '" class="btn-clip btn-border-white w-auto align-self-center">Xem chi tiết <span class="ico__chev-right"></span></a>
                            </div>
                        </div>
                    </div>
                </div>';
                    }
                }
            } else {
                $types = get_the_terms($e->ID, 'type_services')[0];

                $num2 = $k;


                $out .= '<div class="col-6 ' . $num2 . ' ' . ($num2 > 5 ? $hide : '') . '">
                    <div class="background-image" style="background-image: url(' . get_field("image", $e->ID) . ');">
                    <a href="' . get_permalink($e->ID) . '" class="stretched-link"></a>
                        <div class="caret"></div>
                        <div class="block-service">
                            <div class="slug">
                                <span class="one-line">' . $types->name . '<strong>&nbsp; • &nbsp;</strong></span>
                                <span>' . get_field("number_service", $e->ID) . ' Dịch vụ <strong>&nbsp; • &nbsp;</strong></span>
                                <span>' . get_field("month", $e->ID) . ' Tháng</span>
                            </div>
                            <div class="d-md-flex justify-content-between w-100">
                                <div class="info">
                                    <h3 class="colorWhite exbold ff-1">' . get_the_title($e->ID) . '</h3>
                                    <p class="price">' . number_format(get_field('price', $e->ID), 0, ',', ',') . ' ₫</p>
                                </div>
                                <a href="' . get_permalink($e->ID) . '" class="btn-clip btn-border-white w-auto align-self-center">Xem chi tiết <span class="ico__chev-right"></span></a>
                            </div>
                        </div>
                    </div>
                </div>';
            }
        }
        if ($num > 6 && $bike !== 'tat-ca' || $num2 > 5 && $bike === 'tat-ca') {
            $out .= '<div class="text-center col-12 loadmore-mb">
                    <div style="height: 10px;"></div>
                    <a href="javascript: void(0);" class="btn-clip btn-border-red w-auto loadmore" data-id="' . $_m->term_taxonomy_id . '">Xem Thêm</a>
                </div>';
        }

        $out .= '</div>
        </div>';
    }

    // print_r($out);
    wp_reset_postdata();

    die($out);
}

add_action('wp_ajax_get_serviceBy_type_mb', 'get_serviceBy_type_mb_ajax_handler'); // wp_ajax_{action}
add_action('wp_ajax_nopriv_get_serviceBy_type_mb', 'get_serviceBy_type_mb_ajax_handler'); // wp_ajax_nopriv_{action}
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
            $out_bike .= '<div class="product-item item-25"><a href="' . get_permalink($post->ID) . '" class="stretched-link"></a><div class="product__image"><img src="' . get_field("feature_product", $post->ID)['feature_img'] . '" alt=""></div><div class="product__content"><div class="title">' . get_field("feature_product", $post->ID)['feature_title'] . ' ' . get_field("feature_product", $post->ID)['feature_type'] . '</div><div class="text colorLGray">From <span class="fz20">' . number_format($price, 0, ',', ',') . ' ₫</span></div></div></div>';
        }
    }
    if ($apparel) {
        $sale = '';
        $hide = '';

        foreach ($apparel as $k => $item) {
            $types = get_the_terms($item->ID, 'tag');
            $price_ap = get_field('price', $item->ID);
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
                <div class="product-item__price">' . number_format($price_ap, 0, '.', '.') . ' đ</div>
            </a>';

            $sale = '';
        }
    }
    if ($news) {
        foreach ($news as $post) {
            $feature_image = get_field('feature_image', $post->ID);
            $term_name = get_the_terms($post->ID, 'cate');
            $out_news .= '<div class="product-item item-25 pd-16"><a href="' . get_permalink($post->ID) . '" class="stretched-link"></a><div class="product__image"><img src="' . $feature_image . '" alt=""></div><div class="product__content"><div class="sub-title colorLGray">' . $term_name[0]->name . ' <strong>•</strong> <span>' . get_the_date('d/m/Y', $post->ID) . '</span></div><div class="title">' . $post->post_title . '</div></div></div>';
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
    $count = intval(get_post_meta(get_queried_object_id(), 'post_views_count', true ));
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
    $sf_url = SF_URL . '/services/apexrest/APIServiceBooking';

    $order = $_POST['order'];

    
    $data = [];
    $data['AppointmentCode'] = $order['name'];
    $data['Brand'] = $order['type'];
    $data['Model'] = $order['model'];
    $data['FullName'] = $order['name'];
    $data['Mobile'] = $order['phone'];
    $data['Email'] = $order['email'];
    $data['Adrress'] = $order['address'];

    if($order['date']){
        $array =  explode("/",$order['date']);
        $rev=array_reverse($array);
        $date=implode("-",$rev);  
          
        $rd_date =  str_replace("/","-",$date);
        $data['BookingDate'] = $rd_date;
    }


    if ($order['time'] == "1") {
        $data['BookingTime'] = 'Sáng';
    } else {
        $data['BookingTime'] = 'Chiều';
    }

    
    $data['ServiceType'] = $order['plan'];
    // $data['DoDL'] = $order['dealer_name'];
    $data['DoDL'] = $order['dealer_code'];

    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => $sf_url,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS =>json_encode($data),
      CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json'
      ),
    ));

    $response = curl_exec($curl);
    curl_close($curl);
// echo json_encode($data);  die();
    
    echo $response;    

    // $args = array(
    //     'post_type'     => 'book_service',
    //     'post_title'    => $order['name'],
    //     'post_status'   => 'publish',
    //     'post_author'   => 1,
    // );
    // $result = wp_insert_post($args);

    // if ($result && !is_wp_error($result)) {
    //     $post_id = $result;
    // }

    // wp_insert_post($args);
    // $field = [];
    // $field['name'] = $order['name'];
    // $field['type'] = $order['type'];
    // $field['model'] = $order['model'];
    // $field['phone'] = $order['phone'];
    // $field['email'] = $order['email'];
    // $field['address'] = $order['address'];
    // $field['date'] = $order['date'];
    // if ($order['time'] === "1") {
    //     $field['section_of_day'] = 1;
    //     $field['time'] = "08:00 AM - 11:00 AM";
    // } else {
    //     $field['section_of_day'] = 0;
    //     $field['time'] = "01:00 PM - 09:00 PM";
    // }

    // $field['plan'] = $order['plan'];
    // $field['dealer']['dealer_name'] = $order['dealer']['address_name'];
    // $field['dealer']['dealer_address'] = $order['dealer']['address'];
    // $field['message'] = $order['message'];

    // update_field('name', $field['name'], $post_id);
    // update_field('type', $field['type'], $post_id);
    // update_field('model', $field['model'], $post_id);
    // update_field('phone_number', $field['phone'], $post_id);
    // update_field('email_address', $field['email'], $post_id);
    // update_field('address', $field['address'], $post_id);
    // update_field('date', $field['date'], $post_id);
    // update_field('section_of_day', $field['section_of_day'], $post_id);
    // update_field('time', $field['time'], $post_id);
    // update_field('service_plan', $field['plan'], $post_id);
    // update_field('dealer_name', $field['dealer']['dealer_name'], $post_id);
    // update_field('dealer_address', $field['dealer']['dealer_address'], $post_id);
    // update_field('message', $field['message'], $post_id);


    die();
}

add_action('wp_ajax_form_service', 'form_service_ajax_handler'); // wp_ajax_{action}
add_action('wp_ajax_nopriv_form_service', 'form_service_ajax_handler'); // wp_ajax_nopriv_{action}

function form_service_package_ajax_handler()
{

    $order = $_POST['order'];

    $field = [];

    $args = array(
        'post_type'     => 'book_service_package',
        'post_title'    => $order['title'],
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
    $field['phone'] = $order['phone'];
    $field['email'] = $order['email'];
    $field['address'] = $order['address'];
    $field['date'] = $order['date'];

    $field['amount'] = $order['amount'];
    $field['dealer']['dealer_name'] = $order['dealer']['address_name'];
    $field['dealer']['dealer_address'] = $order['dealer']['address'];
    $field['message'] = $order['message'];


    update_field('name', $field['name'], $post_id);
    update_field('type', $field['type'], $post_id);
    update_field('phone_number', $field['phone'], $post_id);
    update_field('email_address', $field['email'], $post_id);
    update_field('address', $field['address'], $post_id);
    update_field('date', $field['date'], $post_id);
    update_field('amount', $field['amount'], $post_id);
    update_field('dealer_name', $field['dealer']['dealer_name'], $post_id);
    update_field('dealer_address', $field['dealer']['dealer_address'], $post_id);
    update_field('message', $field['message'], $post_id);


    exit();
}

add_action('wp_ajax_form_service_package', 'form_service_package_ajax_handler'); // wp_ajax_{action}
add_action('wp_ajax_nopriv_form_service_package', 'form_service_package_ajax_handler'); // wp_ajax_nopriv_{action}

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
    if ($order['license'] === "0") {
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
    update_field('license', $field['license'], $post_id);


    exit();
}

add_action('wp_ajax_form_test_drive', 'form_test_drive_ajax_handler'); // wp_ajax_{action}
add_action('wp_ajax_nopriv_form_test_drive', 'form_test_drive_ajax_handler'); // wp_ajax_nopriv_{action}

//////////////POST TEST DRIVE//////////////
function comparebike_ajax_handler()
{

    $data = $_POST['data'];

    if ($data) {
        $id1 = $data['bike_1'];
        $id2 = $data['bike_2'];
        $id3 = $data['bike_3'];
        if ($data['bike_1']) {
            $products[] = get_field("specification_detail", $id1);
        } else {
            $products[0] = [];
        }
        if ($data['bike_2']) {
            $products[] = get_field("specification_detail", $id2);
        } else {
            $products[1] = [];
        }
        if ($data['bike_3']) {
            $products[] = get_field("specification_detail", $id3);
        } else {
            $products[2] = [];
        }
    }


    $compare = [];
    foreach ($products as $k => $product) {

        foreach ($product as $t) {
            if (isset($t['headline'])) {


                foreach ($t['specification'] as $s) {

                    $compare[$t['headline']][$s['title']][$k] = $s['description'];
                }
            }
        }
    };

    $out = '';
    $count = 0;
    foreach ($compare as $key => $value) {
        $count++;
        $out .= '<div class="product__accordion">
            <button class="product__accordion-btn ' . ($count === 1 ? '' : 'collapsed') . '" type="button" data-toggle="collapse" data-target="#collapse_p' . $count . '" aria-expanded="' . ($count === 1 ? 'true' : 'false') . '" aria-controls="collapse' . $count . '">' . $key . ' <span class="icon-show"><img src="' . get_template_directory_uri() . '/img/compare/icons/icon-up.svg" alt="icon"></span></button>
            <div id="collapse_p' . $count . '" class="collapse ' . ($count === 1 ? 'show' : '') . '" style=""><ul>';
        foreach ($value as $k => $list) {
            $out .= '<li><strong>' . $k . '</strong><ul>';
            for ($i = 0; $i < count($products); $i++) {
                if (isset($list[$i])) {
                    $out .= '<li class="none-border-top">' . $list[$i] . '</li>';
                } else {
                    $out .= '<li class="none-border-top"></li>';
                }
            }
            $out .= '</ul></li>';
        }
        $out .= '</ul></div></div>';
    };

    echo ($out);
    // print_r($compare);
    die;
}

add_action('wp_ajax_comparebike', 'comparebike_ajax_handler'); // wp_ajax_{action}
add_action('wp_ajax_nopriv_comparebike', 'comparebike_ajax_handler'); // wp_ajax_nopriv_{action}


function city()
{
    return array(
        0 => array('Hà Nội', '5%', '4,000,000đ'),
        1 => array('Thành phố Hồ Chí Minh', '5%', '4,000,000đ'),
        2 => array('Đà Nẵng', '5%', '800,000đ'),
        3 => array('Hải Phòng', '5%', '800,000đ'),
        4 => array('Cần Thơ', '5%', '800,000đ'),
        5 => array('TP. Bà Rịa, Bà Rịa – Vũng Tàu', '5%', '800,000đ'),
        6 => array('TP. Bạc Liêu, Bạc Liêu', '5%', '800,000đ'),
        7 => array('TP. Bảo Lộc, Lâm Đồng', '5%', '800,000đ'),
        8 => array('TP. Bắc Giang, Bắc Giang', '5%', '800,000đ'),
        9 => array('TP. Bắc Kạn, Bắc Kạn', '5%', '800,000đ'),
        10 => array('TP. Bắc Ninh, Bắc Ninh', '5%', '800,000đ'),
        11 => array('TP. Bến Tre, Bến Tre', '5%', '800,000đ'),
        12 => array('TP. Biên Hòa, Đồng Nai', '5%', '800,000đ'),
        13 => array('TP. Buôn Ma Thuột, Đắk Lắk', '5%', '800,000đ'),
        14 => array('TP. Cam Ranh, Khánh Hòa', '5%', '800,000đ'),
        15 => array('TP. Cao Bằng, Cao Bằng', '5%', '800,000đ'),
        16 => array('TP. Cao Lãnh, Đồng Tháp', '5%', '800,000đ'),
        17 => array('TP. Cà Mau, Cà Mau', '5%', '800,000đ'),
        18 => array('TP. Cẩm Phả, Quảng Ninh', '5%', '800,000đ'),
        19 => array('TP. Châu Đốc, An Giang', '5%', '800,000đ'),
        20 => array('TP. Chí Linh, Hải Dương', '5%', '800,000đ'),
        21 => array('TP. Dĩ An, Bình Dương', '5%', '800,000đ'),
        22 => array('TP. Đà Lạt, Lâm Đồng', '5%', '800,000đ'),
        23 => array('TP. Điện Biên Phủ, Điện Biên', '5%', '800,000đ'),
        24 => array('TP. Đông Hà, Quảng Trị', '5%', '800,000đ'),
        25 => array('TP. Đồng Hới, Quảng Bình', '5%', '800,000đ'),
        26 => array('TP. Đồng Xoài, Bình Phước', '5%', '800,000đ'),
        27 => array('TP. Gia Nghĩa, Đắk Nông', '5%', '800,000đ'),
        28 => array('TP. Hải Dương, Hải Dương', '5%', '800,000đ'),
        29 => array('TP. Hà Giang, Hà Giang', '5%', '800,000đ'),
        30 => array('TP. Hà Tiên, Kiên Giang', '5%', '800,000đ'),
        31 => array('TP. Hà Tĩnh, Hà Tĩnh', '5%', '800,000đ'),
        32 => array('TP. Hạ Long, Quảng Ninh', '5%', '800,000đ'),
        33 => array('TP. Hòa Bình, Hòa Bình', '5%', '800,000đ'),
        34 => array('TP. Hội An, Quảng Nam', '5%', '800,000đ'),
        35 => array('TP. Hồng Ngự, Đồng Tháp', '5%', '800,000đ'),
        36 => array('TP. Huế, Thừa Thiên Huế', '5%', '800,000đ'),
        37 => array('TP. Hưng Yên, Hưng Yên', '5%', '800,000đ'),
        38 => array('TP. Kon Tum, Kon Tum', '5%', '800,000đ'),
        39 => array('TP. Lai Châu, Lai Châu', '5%', '800,000đ'),
        40 => array('TP. Lào Cai, Lào Cai', '5%', '800,000đ'),
        41 => array('TP. Lạng Sơn, Lạng Sơn', '5%', '800,000đ'),
        42 => array('TP. Long Khánh, Đồng Nai', '5%', '800,000đ'),
        43 => array('TP. Long Xuyên, An Giang', '5%', '800,000đ'),
        44 => array('TP. Móng Cái, Quảng Ninh', '5%', '800,000đ'),
        45 => array('TP. Mỹ Tho, Tiền Giang', '5%', '800,000đ'),
        46 => array('TP. Nam Định, Nam Định', '5%', '800,000đ'),
        47 => array('TP. Ngã Bảy, Hậu Giang', '5%', '800,000đ'),
        48 => array('TP. Nha Trang, Khánh Hòa', '5%', '800,000đ'),
        49 => array('TP. Ninh Bình, Ninh Bình', '5%', '800,000đ'),
        50 => array('TP. Phan Rang – Tháp Chàm, Ninh Thuận', '5%', '800,000đ'),
        51 => array('TP. Phan Thiết, Bình Thuận', '5%', '800,000đ'),
        52 => array('TP. Phú Quốc, Kiên Giang', '5%', '800,000đ'),
        53 => array('TP. Phúc Yên, Vĩnh Phúc', '5%', '800,000đ'),
        54 => array('TP. Phủ Lý, Hà Nam', '5%', '800,000đ'),
        55 => array('TP. Pleiku, Gia Lai', '5%', '800,000đ'),
        56 => array('TP. Quảng Ngãi, Quảng Ngãi', '5%', '800,000đ'),
        57 => array('TP. Quy Nhơn, Bình Định', '5%', '800,000đ'),
        58 => array('TP. Rạch Giá, Kiên Giang', '5%', '800,000đ'),
        59 => array('TP. Sa Đéc, Đồng Tháp', '5%', '800,000đ'),
        60 => array('TP. Sầm Sơn, Thanh Hóa', '5%', '800,000đ'),
        61 => array('TP. Sóc Trăng, Sóc Trăng', '5%', '800,000đ'),
        62 => array('TP. Sông Công, Thái Nguyên', '5%', '800,000đ'),
        63 => array('TP. Sơn La, Sơn La', '5%', '800,000đ'),
        64 => array('TP. Tam Điệp, Ninh Bình', '5%', '800,000đ'),
        65 => array('TP. Tam Kỳ, Quảng Nam', '5%', '800,000đ'),
        66 => array('TP. Tân An, Long An', '5%', '800,000đ'),
        67 => array('TP. Tây Ninh, Tây Ninh', '5%', '800,000đ'),
        68 => array('TP. Thanh Hóa, Thanh Hóa', '5%', '800,000đ'),
        69 => array('TP. Thái Bình, Thái Bình', '5%', '800,000đ'),
        70 => array('TP. Thái Nguyên, Thái Nguyên', '5%', '800,000đ'),
        71 => array('TP. Thủ Dầu Một, Bình Dương', '5%', '800,000đ'),
        72 => array('TP. Thuận An, Bình Dương', '5%', '800,000đ'),
        73 => array('TP. Trà Vinh, Trà Vinh', '5%', '800,000đ'),
        74 => array('TP. Tuyên Quang, Tuyên Quang', '5%', '800,000đ'),
        75 => array('TP. Tuy Hòa, Phú Yên', '5%', '800,000đ'),
        76 => array('TP. Uông Bí, Quảng Ninh', '5%', '800,000đ'),
        77 => array('TP. Việt Trì, Phú Thọ', '5%', '800,000đ'),
        78 => array('TP. Vinh, Nghệ An', '5%', '800,000đ'),
        79 => array('TP. Vị Thanh, Hậu Giang', '5%', '800,000đ'),
        80 => array('TP. Vĩnh Long, Vĩnh Long', '5%', '800,000đ'),
        81 => array('TP. Vĩnh Yên, Vĩnh Phúc', '5%', '800,000đ'),
        82 => array('TP. Vũng Tàu, Bà Rịa – Vũng Tàu', '5%', '800,000đ'),
        83 => array('TP. Yên Bái, Yên Bái', '5%', '800,000đ'),
        84 => array('Thị xã An Khê, Gia Lai', '5%', '800,000đ'),
        85 => array('Thị xã An Nhơn, Bình Định', '5%', '800,000đ'),
        86 => array('Thị xã Ayun Pa, Gia Lai', '5%', '800,000đ'),
        87 => array('Thị xã Ba Đồn, Quảng Bình', '5%', '800,000đ'),
        88 => array('Thị xã Bến Cát, Bình Dương', '5%', '800,000đ'),
        89 => array('Thị xã Bỉm Sơn, Thanh Hóa', '5%', '800,000đ'),
        90 => array('Thị xã Bình Long, Bình Phước', '5%', '800,000đ'),
        91 => array('Thị xã Bình Minh, Vĩnh Long', '5%', '800,000đ'),
        92 => array('Thị xã Buôn Hồ, Đắk Lắk', '5%', '800,000đ'),
        93 => array('Thị xã Cai Lậy, Tiền Giang', '5%', '800,000đ'),
        94 => array('Thị xã Cửa Lò, Nghệ An', '5%', '800,000đ'),
        95 => array('Thị xã Duy Tiên, Hà Nam', '5%', '800,000đ'),
        96 => array('Thị xã Duyên Hải, Trà Vinh', '5%', '800,000đ'),
        97 => array('Thị xã Điện Bàn, Quảng Nam', '5%', '800,000đ'),
        98 => array('Thị xã Đông Hòa, Phú Yên', '5%', '800,000đ'),
        99 => array('Thị xã Đông Triều, Quảng Ninh', '5%', '800,000đ'),
        100 => array('Thị xã Đức Phổ, Quảng Ngãi', '5%', '800,000đ'),
        101 => array('Thị xã Giá Rai, Bạc Liêu', '5%', '800,000đ'),
        102 => array('Thị xã Gò Công, Tiền Giang', '5%', '800,000đ'),
        103 => array('Thị xã Hòa Thành, Tây Ninh', '5%', '800,000đ'),
        104 => array('Thị xã Hoài Nhơn, Bình Định', '5%', '800,000đ'),
        105 => array('Thị xã Hoàng Mai, Nghệ An', '5%', '800,000đ'),
        106 => array('Thị xã Hồng Lĩnh, Hà Tĩnh', '5%', '800,000đ'),
        107 => array('Thị xã Hương Thủy, Thừa Thiên Huế', '5%', '800,000đ'),
        108 => array('Thị xã Hương Trà, Thừa Thiên Huế', '5%', '800,000đ'),
        109 => array('Thị xã Kiến Tường, Long An', '5%', '800,000đ'),
        110 => array('Thị xã Kinh Môn, Hải Dương', '5%', '800,000đ'),
        111 => array('Thị xã Kỳ Anh, Hà Tĩnh', '5%', '800,000đ'),
        112 => array('Thị xã La Gi, Bình Thuận', '5%', '800,000đ'),
        113 => array('Thị xã Long Mỹ, Hậu Giang', '5%', '800,000đ'),
        114 => array('Thị xã Mường Lay, Điện Biên', '5%', '800,000đ'),
        115 => array('Thị xã Mỹ Hào, Hưng Yên', '5%', '800,000đ'),
        116 => array('Thị xã Ngã Năm, Sóc Trăng', '5%', '800,000đ'),
        117 => array('Thị xã Nghi Sơn, Thanh Hóa', '5%', '800,000đ'),
        118 => array('Thị xã Nghĩa Lộ, Yên Bái', '5%', '800,000đ'),
        119 => array('Thị xã Ninh Hòa, Khánh Hòa', '5%', '800,000đ'),
        120 => array('Thị xã Phổ Yên, Thái Nguyên', '5%', '800,000đ'),
        121 => array('Thị xã Phú Mỹ, Bà Rịa – Vũng Tàu', '5%', '800,000đ'),
        122 => array('Thị xã Phú Thọ, Phú Thọ', '5%', '800,000đ'),
        123 => array('Thị xã Phước Long, Bình Phước', '5%', '800,000đ'),
        124 => array('Thị xã Quảng Trị, Quảng Trị', '5%', '800,000đ'),
        125 => array('Thị xã Quảng Yên, Quảng Ninh', '5%', '800,000đ'),
        126 => array('Thị xã Sa Pa, Lào Cai', '5%', '800,000đ'),
        127 => array('Thị xã Sông Cầu, Phú Yên', '5%', '800,000đ'),
        128 => array('Thị xã Sơn Tây, Hà Nội', '5%', '800,000đ'),
        129 => array('Thị xã Tân Châu, An Giang', '5%', '800,000đ'),
        130 => array('Thị xã Tân Uyên, Bình Dương', '5%', '800,000đ'),
        131 => array('Thị xã Thái Hòa, Nghệ An', '5%', '800,000đ'),
        132 => array('Thị xã Trảng Bàng, Tây Ninh', '5%', '800,000đ'),
        133 => array('Thị xã Từ Sơn, Bắc Ninh', '5%', '800,000đ'),
        134 => array('Thị xã Vĩnh Châu, Sóc Trăng', '5%', '800,000đ'),
        135 => array('Nơi khác', '2%', '50,000đ'),
    );
}

function search_location_ajax_handler()
{
    $find = strtolower($_POST['f']);

    $location = city();

    $found = [];

    foreach ($location as $item) {
        $i_low = strtolower($item[0]);
        if (strpos($i_low, $find)) {
            $found[] = $item;
        }
    }

    $out = '';


    foreach ($found as $k => $e) {
        $out .= '<a class="dropdown-item" href="javascript:void(0)" data-index="' . $k . '" data-fee="' . $e[1] . '" data-price="' . $e[2] . '">
            <span class="text">' . $e[0] . '</span>
        </a>';
    }

    // echo json_encode($arr);
    die($out);
}

add_action('wp_ajax_search_location', 'search_location_ajax_handler'); // wp_ajax_{action}
add_action('wp_ajax_nopriv_search_location', 'search_location_ajax_handler'); // wp_ajax_nopriv_{action}

add_action('admin_menu', 'addMenu');
function addMenu()
{
    include_once( __DIR__ . '/admin-hottool.php' );
    add_menu_page(
        "Hot Tool",
        "Hot Tool",
        "edit_posts",
        "hot_tool",
        "admin-hottool.php",
        null,
        50
    );
}