<?php

$page_id = get_the_ID();

$meta_des = get_the_excerpt($page_id); 
if($meta_des=='' || is_home()){
	$meta_des='Revzone Yamaha Motor hệ thống đại lý xe phân khối lớn được vận hành chính thức bởi Yamaha Motor Vietnam. Revzone Yamaha Motor mang một diện mạo hoàn toàn độc đáo và khác biệt so với tất cả mạng lưới phân phối xe hiện tại của Yamaha tại Việt Nam.';
}
global $arrCat_apparel_Show, $arrCat_bike_Show ;
?>

<!doctype html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?php wp_title(''); ?></title>
    <meta name="description" content="<?php echo $meta_des; ?>">
    <meta property="og:image" content="<?php echo get_ymh_feature_image(); ?>">
    <meta property="og:description" content="<?php echo $meta_des; ?>">
    <meta name="keywords" content="<?php echo get_the_title(); ?>" />
    <meta name="author" content="Revzone Yamaha Motor Việt Nam" />
    <meta property="og:rich_attachment" content="true"/>

    <!-- Twitter Card -->
<meta name="twitter:card" value="summary"/>
<meta name="twitter:url" content="<?php echo get_site_url()?>"/>
<meta name="twitter:title" content="<?php echo get_the_title(); ?>"/>
<meta name="twitter:description" content="<?php echo $meta_des; ?>"/>
<meta name="twitter:image" content="<?php echo get_ymh_feature_image(); ?>"/>
<meta name="twitter:site" content="@YMH-VietNam"/>
<meta name="twitter:creator" content="@YMH-VietNam"/>
<!-- End Twitter Card -->

    <meta name="viewport" content="width=device-width, initial-scale=1,user-scalable=no">
    <link rel="icon" type="image/png" href="<?php echo get_template_directory_uri(); ?>/img/favicon.ico">
    <?php wp_head(); ?>
    <!-- <link rel="shortcut icon" type="image/png" href="<?php echo get_template_directory_uri() ?>/img/favicon.png" /> -->
    <!-- Place favicon.ico in the root directory -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox.css" />
    <!-- <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/styles.min.css?<?php echo time() ?>"> -->
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/my-work/mystyles.css?<?php echo time() ?>">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/custom.css?v=<?php echo time() ?>">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/styles.min.css?v=<?php echo time() ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="<?php echo get_template_directory_uri() ?>/js/vendor/modernizr-2.8.3.min.js"></script>
    <script src="<?php echo get_template_directory_uri() ?>/js/vendor/jquery-3.5.1.min.js"></script>
    <script src="<?php echo get_template_directory_uri() ?>/js/vendor/pycs-layout.jquery.js"></script>
    <script src="<?php echo get_template_directory_uri() ?>/js/vendor/js.cookie.min.js"></script>

    <script type="text/javascript">
        var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
        var baseurl = "<?php echo esc_url(home_url('/')) ?>";
        var url_return = "<?php echo $_SERVER['HTTP_REFERER'] ?>";
        <?php if (!isset($_COOKIE["uid"])) : ?>
            var cookie_uid = Cookies.set("uid", '<?php echo uniqid(); ?>', { expires: 365 * 10, path: '/' }); 
			//Cookies.set('name', 'value', { expires: 7, path: '' });
        <?php endif; ?>
    </script>
  <?php if(function_exists('load_header_get_formdata')) load_header_get_formdata(); //Load form Get Data script ?>   
 <!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-K5SZ25D');</script>
<!-- End Google Tag Manager -->

Paste this code immediately after the opening <body> tag:
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-K5SZ25D"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

   
</head>

<body>
   
   <?php if(function_exists('load_form_dang_ky_dang_nhap')) load_form_dang_ky_dang_nhap(); ?>
   
    <?php echo $page_id !== 5 ? '<div class="static-hold"></div>' : '' ?>

    <header class="h-box <?php echo (!is_front_page()) ? '' : 'gradient' ?>">
        <div class="container-fluid h-box__wrapper">
            <a href="<?php echo get_site_url() ?>" class="h-logo">
                <?php /*?><img src="<?php echo get_template_directory_uri() ?>/img/logo.png" alt="" class="h-logo-new"><?php */?>
                <img src="<?php echo get_template_directory_uri() ?>/img/logo.svg" alt="" class="h-logo-1">
                 <img src="<?php echo get_template_directory_uri() ?>/img/logo2.svg" alt="" class="h-logo-2"> 
            </a>
            <?php
            //  $header = wp_nav_menu(
            //     array(
            //         'theme_location' => 'header-menu',
            //         'container' => 'false',
            //         'menu_id' => 'header-menu',
            //         'menu_class' => 'h-menu',
            //     )
            // ); 
            // 
            ?>
            <ul class="h-menu">
                <?php
                $menu = wp_get_nav_menu_object(13);
                $menu = wp_get_nav_menu_items('13');

                $_menus = [];

                foreach ($menu as $m) {
                    $_menus[$m->menu_item_parent][] = $m;
                }


                foreach ($_menus[0] as $v) {
                    if (isset($_menus[$v->ID])) {

                        if (in_array("menu-product", $v->classes)) {

                            echo '<li class="h-menu__item h-menu__item--submenu d-lg-flex d-xl-flex d-none ' . ($v->object_id == $page_id ? 'active' : '') . '">
                                    <h6><a href="' . $v->url . '" class="link">' . $v->title . '</a></h6> 
                                    <div class="h-menu__moto">
                                        <div class="container-fluid">
                                            <div class="row">
                                                <div class="h-menu__nav" style="width: 256px">
                                                    <label for="" class="h-menu__headline">MÔ TÔ</label> 
                                                    <ul class="h-menu__category" id="scrollby">    
                            '; 

                            $products = get_terms(array(
                                'taxonomy' => 'products',
                                'hide_empty' => false, 
                            ));
							
                            $defaults = '';
                            $count_check = 0;
                            foreach ($products as $key => $_m) {

                                $status = get_field('status_category', $_m);
                                if ($status > 0) {
                                    $count_check++;
                                    if ($count_check == 1) {
                                        $defaults = $_m->name;
                                    }
                                    echo '<li class="' . ($key === 0 ? 'active' : '') . '" data-scroll="#' . str_replace(" ", "", $_m->name) . '">
                                            <span>' . $_m->name . '</span>
                                            <div class="line"></div>
                                    </li>';
                                }
                            }
                            echo '</ul></div>';
                            echo '<div class="h-menu__list-item">
                                    <div class="h-menu__sticky">
                                        <label for="" class="h-menu__headline change-title-js">' . $defaults . '</label>
                                    </div>
                                    <div class="h-menu__wrapper">
                                        <div class="h-menu__content">
                            ';
                            foreach ($products as $key => $_m) {
                                $args = array(
                                    'post_type' => 'product',
                                    'post_status' => 'publish',
                                    'tax_query' => array(
                                        array(
                                            'taxonomy' => 'products',
                                            'field' => 'term_id',
                                            'terms' => $_m->term_id,
                                        )
                                    )
                                );
                                $query = new WP_Query($args);
                                $posts = $query->posts;
                                $count_posts = $query->post_count;
                                $status = get_field('status_category', $_m);

                                if ($status > 0) {
                                    echo '<div class="h-menu__section" id="' . str_replace(" ", "", $_m->name) . '" data-title="' . $_m->name . '">';
                                    echo '<label for="" class="h-menu__headline">' . $_m->name . '</label>';
                                    echo '<div class="row">';
                                    $count = 0;
                                    foreach ($posts as $post) {
                                        $group = get_field("feature_product", $post->ID);
                                        $price = $group['feature_price'];
                                        $count++;
                                        //if ($count < 5) {
                                            echo '<div class="col-3">
                                            <a href="' . get_permalink($post->ID) . '" class="stretched-link"></a>
                                            <img src="' . $group['feature_img'] . '" alt="">
                                            <strong>' . get_the_title() . '</strong>
                                            <p class="colorGray fz14">Giá: <span class="fz20">' . currencyFormat($price) . '</span></p>
                                        </div>
                                    ';
                                        //}
                                    }

                                    echo '</div>';
                                }
                            }
                            ///Close bikes part right submenu
                            echo '      </div>
                                    </div>';

                            echo '<div style="height: 50vh"></div>';
                            /// Close submenu///
                            echo '          </div>
                                        </div>
                                    </div>
                            ';
                        } else if (in_array("menu-apparel", $v->classes)) {
							 
							//HYPER NAKED = 19, SUPER SPORT = 18 , SPORT TOURING = 17, ADVENTURE TOURING = 16, OFF ROAD = 41, SCOOTER=14
							
                            $apparels = get_terms(array(
                                'taxonomy' => 'apparels',
                                'hide_empty' => false,
								//'include'	=> $arrCat_apparel_Show,
                            ));

                            echo '<li class="h-menu__item h-menu__item--submenu d-lg-flex d-xl-flex d-none ' . ($v->object_id == $page_id ? 'active' : '') . '">
                                    <h6><a href="' . $v->url . '" class="link">' . $v->title . '</a></h6>   
                                    <div class="h-menu__submenu">
                                        <ul class="h__list">     
                            ';
                            foreach ($apparels as $key => $_m) {
                                $status = get_field('status_category', $_m);
                                if ($status > 0) {
                                    echo '
                                        <li><a href="' . get_term_link($_m->term_id) . '">
                                            <h5>' . $_m->name . '</h5>
                                        </a></li>';
                                }
                            }
                            echo '</ul></div>';
                        } else {
                            echo '<li class="h-menu__item h-menu__item--submenu d-lg-flex d-xl-flex d-none' . ($v->object_id == $page_id ? 'active' : '') . '">
                                    <h6><a href="' . $v->url . '" class="link">' . $v->title . '</a></h6>   
                                    <div class="h-menu__submenu menu-dichvu" id="menu_dichvu">
                                        <ul class="h__list">     
                            ';

                            foreach ($_menus[$v->ID] as $key => $_m) {
                                if (in_array('scroll-service', $_m->classes)) {
                                    echo '
                                <li><a href="' . $_m->url . '?booking=true">
                                    <h5>' . $_m->title . '</h5>
                                </a></li>';
                                } else {
                                    echo '
                                    <li><a href="' . $_m->url . '">
                                        <h5>' . $_m->title . '</h5>
                                    </a></li>';
                                }

                                // print_r($_m);
                            }
                            echo '</ul></div>';
                        }
                    } else {
                        if (in_array("search-all", $v->classes)) {
                            echo '<li class="h-menu__item mnuicon ltoright">
                            <h6><a href="' . $v->url . '"><span style="mask-image: url(' . get_template_directory_uri() . '/img/ic_search.svg); -webkit-mask-image: url(' . get_template_directory_uri() . '/img/ic_search.svg)" class="ic-search"></span></a></h6>';
                        } else {
                            echo '<li class="h-menu__item d-lg-flex d-xl-flex d-none ' . ($v->object_id == $page_id ? 'active' : '') . '">
                            <h6><a href="' . $v->url . '" class="link">' . $v->title . '</a></h6>        
                    ';
                        }
                    }

                    echo '</li>';
                }

                ?>
<?php if(function_exists('write_javascript_show_menu_wishlist_cart')) write_javascript_show_menu_wishlist_cart(); ?>
               
                <li class="h-menu__item d-flex d-lg-none d-xl-none ">
                    <a href="javascript:void(0)" class="icon-menu">
                        <span></span>
                        <span></span>
                    </a>
                </li>
 
            </ul>
        </div>
    </header> 
   
    <div class="navmenu-accordion">
        <?php if(function_exists('write_show_menu_accordion')) write_show_menu_accordion(); ?>
        <?php
        foreach ($_menus[0] as $k => $v) {

            if (isset($_menus[$v->ID])) {
                if (in_array("menu-product", $v->classes)) {
                    echo ' <div class="h__accordion">
                                <div class="h__accordion-item">
                                    <a href="javascript:void(0)" class="btn btn__h-accordion open-menu-bikes" aria-expanded="false" aria-controls="collapse1">
                                    ' . $v->title . '<span class="chevron-right"></span>
                                    </a>
                                </div>';
                } else if (in_array("menu-apparel", $v->classes)) {
                    $apparels = get_terms(array(
                        'taxonomy' => 'apparels',
                        'hide_empty' => false,
                    ));
                    echo ' <div class="h__accordion">
                               <div class="h__accordion-item">
                                <a href="' . $v->url . '" class="btn btn__h-accordion">' . $v->title . '</a>
                                    <span class="chevron-right" data-toggle="collapse" data-target="#collapse_h' . $v->ID . '" aria-expanded="false" aria-controls="collapse_h' . $v->ID . '"></span>
                                </div>';
                    echo '      <div id="collapse_h' . $v->ID . '" class="collapse"><ul class="h__list">';
                    foreach ($apparels as $key => $_m) {
                        $status = get_field('status_category', $_m);
                        if ($status > 0) {
                            echo '<li><a href="' . get_term_link($_m->term_id) . '">' . $_m->name . '</a></li>';
                        }
                    }


                    echo '      </ul></div>';
                } else {
                    echo ' <div class="h__accordion">
                                <div class="h__accordion-item">
                                <a href="' . $v->url . '" class="btn btn__h-accordion">' . $v->title . '</a>
                                    <span class="chevron-right" data-toggle="collapse" data-target="#collapse_h' . $v->ID . '" aria-expanded="false" aria-controls="collapse_h' . $v->ID . '"></span>
                                </div>';
                    echo '      <div id="collapse_h' . $v->ID . '" class="collapse"><ul class="h__list">';

                    foreach ($_menus[$v->ID] as $key => $_m) {
                        if (in_array('scroll-service', $_m->classes)) {
                            echo '<li><a href="' . $_m->url . '?booking=true">' . $_m->title . '</a></li>';
                        } else {
                            echo '<li><a href="' . $_m->url . '">' . $_m->title . '</a></li>';
                        }
                        // print_r($_m);
                    }

                    echo '      </ul></div>';
                }
            } else {

                echo ' <div class="h__accordion ' . ($v->classes[0] != "search-all" ? '' : 'hide') . '">
                    <div class="h__accordion-item">
                        <a href="' . $v->url . '" class="btn btn__h-accordion" aria-expanded="false" aria-controls="collapse' . $v->ID . '">
                        ' . $v->title . '
                        </a>
                    </div>';
            } 
			echo '</div>';
            
        }
        ?> 
        
  
		 
        
        <div style="height:10px;"></div>

        <div class="d-flex flex-column list-social">
            <span class="colorLGray">Kết nối với chúng tôi</span>
            <ul class="h__social">
                <li><a href="#." class=""><span style="mask-image: url(<?php echo get_template_directory_uri() ?>/img/ic_fb.svg); -webkit-mask-image: url(<?php echo get_template_directory_uri() ?>/img/ic_fb.svg)" class="icon"></span></a></li>
                <li><a href="#." class=""><span style="mask-image: url(<?php echo get_template_directory_uri() ?>/img/ic_ins.svg); -webkit-mask-image: url(<?php echo get_template_directory_uri() ?>/img/ic_ins.svg)" class="icon"></span></a></li>
                <li><a href="#." class=""><span style="mask-image: url(<?php echo get_template_directory_uri() ?>/img/ic_ytb.svg); -webkit-mask-image: url(<?php echo get_template_directory_uri() ?>/img/ic_ytb.svg)" class="icon"></span></a></li>
            </ul>
        </div>
    </div>

    <div class="navmenu-drawer">
        <a href="javascript:void(0)" class="back-drawer"></a>
        <?php
        $default_mb = '';
        $terms_mb = get_terms([
            'taxonomy' => "products",
        ]);
        $count_check = 0;
        $default = '';
        $slug = '';
        foreach ($terms_mb as $key => $_m) {
            $status = get_field('status_category', $_m);
            if ($status > 0) {
                $count_check++;
                if ($count_check == 1) {
                    $slug_mb = $_m->slug;
                    $default_mb = $_m->name;
                }
            }
        }
        ?>
        <div class="navmenu-drawer__sticky">
            <a href="#." class="btn btn__h-drawer change-title-js">
                <?php echo $default_mb ?>
            </a>
        </div>

        <div class="navmenu-drawer__content">

            <?php foreach ($terms_mb as $key => $_m) : ?>
                <?php

                $args_mb = array(
                    'post_type' => 'product',
                    'post_status' => 'publish',
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'products',
                            'field' => 'term_id',
                            'terms' => $_m->term_taxonomy_id,
                        )
                    )
                );
                $query_mb = new WP_Query($args_mb);
                $posts_mb = $query_mb->posts;
                $status = get_field('status_category', $_m);

                if ($status > 0) :
                ?>
                    <div class="h__drawer-item" data-title="<?php echo $_m->name; ?>">
                        <a href="javascript:void(0)" class="btn btn__h-drawer" aria-expanded="true" aria-controls="collapse">
                            <?php echo $_m->name; ?>
                        </a>
                        <ul class="h__drawer-list">
                            <?php
                            $count_mb = 0;
                            foreach ($posts_mb as $post) {
                                $group = get_field("feature_product", $post->ID);
                                $price = $group['feature_price'];
                                $count_mb++;
                                //if ($count_mb < 5) { ?>
                                    <li>
                                        <a href="<?php echo get_permalink($post->ID) ?>">
                                            <img src="<?php echo $group['feature_img']; ?>" alt="">
                                            <div>
                                                <strong class="fz16"><?php echo get_the_title(); ?></strong>
                                                <p class="colorGray fz14">Giá: <span class="fz14"><?php echo currencyFormat($price); ?> </span></p>
                                            </div>
                                        </a>
                                    </li>
                            <?php //}
                            } ?>
                        </ul>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>


            <div style="height: 80vh"></div>
        </div>
    </div>

    <div id="content">