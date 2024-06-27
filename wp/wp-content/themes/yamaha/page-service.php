<?php
get_header();
$page_id = get_queried_object_id();
global $arrCat_apparel_Show, $arrCat_bike_Show ;

if (isset($_GET['booking'])) {
    $booking = $_GET['booking'];
}
?>
<style type="text/css">
    @import url(https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css);
</style>

<?php echo get_template_part('includes/header/header-toolbar'); ?>

<div class="banner banner__swiper banner-service banner-full banner-full--mb">
    <div class="navigator__breadcrumbs">
        <div class="container-fluid">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo get_site_url() ?>">TRANG CHỦ</a></li>
                    <li class="breadcrumb-item active" aria-current="page">DỊCH VỤ</li>
                </ol>
            </nav>
        </div>
    </div>

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
                                    <div class="fz16"><?php echo $slider['label']; ?></div>
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
</div>

<div class="anchor" id="overview"></div>
<div class="image-text">
    <?php $overview = get_field("overview", $page_id) ?>

    <?php if ($overview) : ?>
        <div class="container-fluid">
            <div class="row row-32">
                <div class="col-md-5">
                    <div class="content">
                        <h2 class="title"><?php echo $overview['title'] ?></h2>
                        <div class="description">
                            <?php echo $overview['description'] ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="image">
                        <img src="<?php echo $overview['background_image'] ?>" alt="img-overview.jpg" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>
<div class="anchor" id="book-service"></div>

<div class="book-service">
    <?php $book_service = get_field("book_service", $page_id) ?>

    <?php if ($book_service) : ?>
        <div class="container-fluid">
            <div class="row row-32">
                <div class="col-md-6">
                    <div class="image-group">
                        <div class="row sm-gutters">
                            <?php foreach ($book_service['list_image'] as $k => $img) : ?>
                                <?php if ($k === 0) : ?>
                                    <div class="col-12">
                                        <img src="<?php echo $img['image']; ?>" alt="image" class="img-fluid">
                                    </div>
                                <?php else : ?>
                                    <div class="col-6 d-none d-md-block">
                                        <img src="<?php echo $img['image']; ?>" alt="image" class="img-fluid">
                                    </div>
                                <?php endif; ?>

                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="d-md-none" style="height: 15px"></div>
                </div>
                <div class="col-md-6">
                    <div class="d-md-none" style="height: 24px"></div>
                    <h2 class="title-h">ĐẶT DỊCH VỤ</h2>
                    <form method="post" class="form-service">
                        <label for="" class="fz14 colorWhite bold text-uppercase">Thông tin xe</label>
                        <div style="height: 8px;"></div>
                        <div class="form-row">
                            <div class="col-6">
                                <?php

                                $terms = get_terms([
                                    'taxonomy' => "products",
                                ]);
                                $count_check = 0;
                                $default = '';
                                $slug = '';
                                foreach ($terms as $key => $_m) {
                                    $status = get_field('status_category', $_m);
                                    if ($status > 0) {
                                        $count_check++;
                                        if ($count_check == 1) {
                                            $slug = $_m->slug;
                                            $default = $_m->name;
                                        }
                                    }
                                }

                                ?>
                                <div class="dropdown dropdown--selected filter-type">
                                    <a href="javascript:void(0)" class="btn custom" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <div class="label">Dòng xe <sup>*</sup></div>
                                        <div class="title btn-filter">Chọn Dòng Xe</div>
                                        <script type="text/javascript">
                                            // var filter_type = '<?php echo $default; ?>';
                                            var filter_type = '';
                                        </script>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <?php foreach ($terms as $e) : ?>
                                            <?php $status = get_field('status_category', $e); ?>
                                            <?php
                                            $args_type = array(
                                                'post_type' => 'product',
                                                'tax_query' => array(
                                                    array(
                                                        'taxonomy' => 'products',
                                                        'field' => 'term_id',
                                                        'terms' => $e->term_id,
                                                    )
                                                )
                                            );
                                            $query_type = new WP_Query($args_type);
                                            $posts_type = $query_type->posts;
                                            // print_r($posts_type);
                                            ?>
                                            <?php if ($status > 0) : ?>
                                                <a class="dropdown-item" href="javascript:void(0)" data-slug="<?php echo $e->slug ?>" data-val="<?php echo $e->name; ?>"><?php echo $e->name ?></a>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </div>
                                    <div class="invalid-feedback"></div>
                                </div>

                            </div>
                            <div class="col-6">
                                <?php

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
                                            'terms' => $slug,
                                        ),
                                    )
                                );

                                $query = new WP_Query($args);

                                $posts = $query->posts;
                                ?>
                                <div class="dropdown dropdown--selected filter-bike">
                                    <a href="javascript:void(0)" class="btn custom" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <div class="label">Mẫu xe <sup>*</sup></div>
                                        <div class="title btn-filter">Chọn Mẫu Xe</div>
                                        <script type="text/javascript">
                                            // var filter_bike = '<?php echo get_the_title($posts[0]->ID) ?>';
                                            // var filter_img = '<?php echo get_field("feature_product", $posts[0]->ID)['feature_img'] ?>';
                                            var filter_bike = '';
                                            var filter_img = '';
                                        </script>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <?php foreach ($posts as $e) : ?>
                                            <a class="dropdown-item" href="javascript:void(0)" data-img="<?php echo get_field("feature_product", $e->ID)['feature_img'] ?>" data-val="<?php echo get_the_title($e->ID) ?>"><?php echo get_the_title($e->ID) ?></a>
                                        <?php endforeach; ?>
                                    </div>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                        </div>
                        <label for="" class="fz14  colorWhite bold text-uppercase">Thông tin của bạn</label>
                        <div style="height: 8px;"></div>
                        <div class="form-group form-ani">
                            <input type="text" name="name" class="form-control" />
                            <span class="floating-label">Họ và Tên <sup>*</sup></span>
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-group form-ani">
                                    <input type="number" name="phone" class="form-control" />
                                    <span class="floating-label">Số điện thoại <sup>*</sup></span>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-ani">
                                    <input type="text" name="email" class="form-control" />
                                    <span class="floating-label">Email <sup>*</sup></span>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group form-ani">
                            <input type="text" name="address" class="form-control" />
                            <span class="floating-label">Địa chỉ <sup>*</sup></span>
                            <div class="invalid-feedback"></div>
                        </div>
                        <label for="" class="fz14 colorWhite bold text-uppercase">Ngày đặt lịch</label>
                        <div style="height: 8px;"></div>
                        <div class="form-group-important">

                            <div class="dropdown dropdown--selected dropdown--selected-date">
                                <?php $date = date('d/m/Y'); ?>
                                <a href="javascript:void(0)" class="btn" aria-haspopup="true" aria-expanded="false">
                                    <div class="label">Ngày đặt lịch <sup>*</sup></div>
                                    <div class="title" id="title-date"><?php echo $date; ?></div>
                                </a>

                                <input class="datepicker" name="date" value="<?php echo $date; ?>">
                            </div>


                        </div>

                        <label for="" class="fz14 colorWhite bold text-uppercase">THỜI GIAN</label>
                        <div style="height: 8px;"></div>
                        <div class="form-row">
                            <div class="col-6">
                                <div class="custom-control custom-radio">
                                    <input type="radio" checked id="time1" name="time" value="1" class="custom-control-input">
                                    <label class="custom-control-label" for="time1">
                                        <strong class="fz14 colorLGray">Buổi sáng</strong>
                                        <p class="fz12 colorLGray2 normal mb-0">08:00 AM - 11:00 AM</p>
                                    </label>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="time2" name="time" value="2" class="custom-control-input">
                                    <label class="custom-control-label" for="time2">
                                        <strong class="fz14 colorLGray">Buổi chiều</strong>
                                        <p class="fz12 colorLGray2 normal mb-0">01:00 PM - 09:00 PM</p>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div style="height: 8px;"></div>
                        <label for="" class="text-uppercase colorWhite bold fz14">DỊCH VỤ</label>
                        <div style="height: 8px;"></div>
                        
                        <div class="form-group-important">
                            <?php
                            $terms_service = get_terms(array(
                                'taxonomy' => 'type_services',
                                'hide_empty' => false,
                            ));
                            ?>
                            <div class="dropdown dropdown--selected filter-service">
                                <a href="javascript:void(0)" class="btn custom" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <div class="title btn-filter">Chọn Loại Dịch Vụ</div>
                                </a>
                                <script type="text/javascript">
                                    var filter_service = '';
                                </script>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                                    <?php foreach ($terms_service as $e) : ?>
                                        <a class="dropdown-item" href="javascript:void(0)" data-val="<?php echo $e->name; ?>"><?php echo $e->name; ?></a>
                                    <?php endforeach ?>
                                </div>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-12">
                                <?php

                                $args_dealer = array(
                                    'post_type' => 'dealer',
                                    'paged' => 1,
                                    'post_status' => 'publish',
                                    'posts_per_page' => -1,
                                    'suppress_filters' => true,
                                );

                                $query_dealer = new WP_Query($args_dealer);

                                $dealer = $query_dealer->posts;
                                ?>
                                <div class="dropdown dropdown-dealer dropdown--selected filter-dealer">
                                    <a href="javascript:void(0)" class="btn custom" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <div class="title">
                                            <span class="text">Chọn Đại Lý</span>
                                        </div>
                                        <div class="label" style="top: 5px;"></div>
                                    </a>
                                    <script type="text/javascript">
                                        var filter_dealer = {};
                                    </script>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <?php foreach ($dealer as $e) : ?>
                                            <a class="dropdown-item" href="javascript:void(0)" data-name="<?php echo get_the_title($e->ID); ?>" data-address="<?php echo get_field("address", $e->ID); ?>">
                                                <span class="text"><?php echo get_the_title($e->ID); ?></span>
                                                <span class="text-sm"><?php echo get_field("address", $e->ID); ?></span>
                                            </a>
                                        <?php endforeach ?>
                                    </div>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                        </div>

                        <div class="d-none d-md-block" style="height: 24px"></div>
                        <div class="row align-items-center">
                            <div class="col-md-6 capcha">
                                <!-- <?php echo do_shortcode('[bws_google_captcha]');  ?> -->
                            </div>
                            <div class="col-md-6 text-right">
                                <button type="submit" id="button-submit" class="btn-clip btn-red">Đặt ngay</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php endif; ?>

</div>

<div class="anchor" id="service-plan"></div>
<div class="service-plan" id="">
    <?php
    $service = get_field('service_package', $page_id);

    if ($service) :
    ?>
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="ff-1 colorDark text-uppercase"><?php echo $service['title']; ?></h2>
                <a href="<?php echo get_site_url(); ?>/service-package" class="fz14 colorRed text-uppercase bold d-xl-flex d-lg-flex align-items-center">XEM TẤT CẢ <span style="width: 14px"></span> <i class="ico__chev-right"></i></a>
            </div>
            <div class="description">
                <?php echo $service['description'];  ?>
            </div>
            <div class="list-service">
                <div class="row sm-gutters">
                    <?php foreach ($service['package'] as $k => $e) : ?>
                        <div class="col-6">
                            <div class="background-image" style="background-image: url(<?php echo $e['image_background']; ?>);">
                                <div class="d-md-flex">
                                    <div class="icon"><img src="<?php echo get_template_directory_uri() ?>/img/service/icons/icon-<?php echo $k + 1; ?>.svg" alt="icon"></div>
                                    <div class="info">
                                        <a href="<?php echo get_site_url(); ?>/service-package/?is_slug=maintain">
                                        <h3 class="colorWhite exbold ff-1"><?php echo $e['title']; ?></h3>
                                        </a>
                                        <div class="d-none d-md-block" style="height: 8px;"></div>
                                        <p class="price"><?php echo $e['description']; ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>

<div class="anchor" id="rescue-247"></div>
<div class="image-text" id="">
    <?php
    $rescue = get_field('rescue', $page_id);

    if ($rescue) :
    ?>
        <div class="container-fluid">
            <div class="row row-32 flex-md-row-reverse flex-column-reverse">
                <div class="col-md-5 align-self-center">
                    <div class="content">
                        <h2 class="title"><?php echo $rescue['title']; ?></h2>
                        <div class="description">
                            <?php echo $rescue['description']; ?>
                        </div>
                        <a href="<?php echo get_site_url(); ?>/service-package" class="btn-clip btn-border-red">Xem thêm <span class="ico__chev-right"></span></a>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="image">
                        <img src="<?php echo $rescue['image']; ?>" alt="img-overview.jpg" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>

<?php /*?><div class="service-card">
    <div class="container-fluid">
        <div class="row row-32">
            <div class="col-md-6" id="">
                <div class="anchor" id="warranty-policy"></div>
                <div class="card border-0">
                    <?php $left = get_field("service_other_left", $page_id)?>                    
                    <img class="card-img-top" src="<?php echo $left['image']; ?>" alt="image-cap">
                    <div class="card-body px-0">
                        <h2 class="card-title ff-1 exbold"><?php echo $left['title']; ?></h2>
                        <p class="card-text"><?php echo $left['description']; ?></p>
                        <a href="<?php echo $left['link']; ?>" class="btn-clip btn-border-red">Xem thêm <span class="ico__chev-right"></span></a>
                    </div>
                </div>
            </div>
            <div class="col-md-6" id="">
                <div class="anchor" id="yamalube"></div>
                <div class="card border-0">
                <?php $left = get_field("service_other_right", $page_id)?> 
                    <img class="card-img-top" src="<?php echo $left['image']; ?>" alt="image-cap">
                    <div class="card-body px-0">
                        <h2 class="card-title ff-1 exbold"><?php echo $left['title']; ?></h2>
                        <p class="card-text"><?php echo $left['description']; ?></p>
                        <a href="<?php echo $left['link']; ?>" class="btn-clip btn-border-red">Xem thêm <span class="ico__chev-right"></span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><?php */?>

<!-- Modal -->
<div class="modal fade confirm-modal" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">XEM TRƯỚC</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="title text-uppercase">Đặt dịch vụ</div>
                <div class="product-summary">
                    <div class="product-summary__img">
                        <img src="" id="end-img" alt="" />
                    </div>
                    <div class="product-summary__content">
                        <div class="name-p" id="end-bike"></div>
                        <p class="cat-p" id="end-type"></p>
                    </div>
                </div>
                <div class="customer-info">
                    <h5>THÔNG TIN CỦA BẠN</h5>
                    <div class="info-item">
                        <img src="<?php echo get_template_directory_uri() ?>/img/buy-apparel/user.svg" alt="" />
                        <div class="info-item__content">
                            <label>Họ và Tên</label>
                            <p id="end-name"></p>
                        </div>
                    </div>
                    <div class="info-item">
                        <img src="<?php echo get_template_directory_uri() ?>/img/buy-apparel/phone.svg" alt="" />
                        <div class="info-item__content">
                            <label>Số điện thoại </label>
                            <p id="end-phone"></p>
                        </div>
                    </div>
                    <div class="info-item">
                        <img src="<?php echo get_template_directory_uri() ?>/img/buy-apparel/email.svg" alt="" />
                        <div class="info-item__content">
                            <label>Email</label>
                            <p id="end-email"></p>
                        </div>
                    </div>
                    <div class="info-item">
                        <img src="<?php echo get_template_directory_uri() ?>/img/buy-apparel/location.svg" alt="" />
                        <div class="info-item__content">
                            <label>Địa chỉ</label>
                            <p id="end-address"></p>
                        </div>
                    </div>
                </div>
                <div class="customer-info">
                    <h5>Ngày đặt dịch vụ</h5>
                    <div class="info-item">
                        <img src="<?php echo get_template_directory_uri() ?>/img/buy-apparel/date.svg" alt="" />
                        <div class="info-item__content">
                            <label>Ngày đặt lịch</label>
                            <p id="end-date">Nov 18, 2021</p>
                        </div>
                    </div>
                    <div class="info-item">
                        <img src="<?php echo get_template_directory_uri() ?>/img/buy-apparel/time.svg" alt="" />
                        <div class="info-item__content">
                            <label>Thời gian</label>
                            <p><span id="end-time1"></span> <span id="end-time2"></span></p>
                        </div>
                    </div>
                </div>
                <div class="customer-info">
                    <h5>DỊCH VỤ & ĐẠI LÝ</h5>
                    <div class="info-item">
                        <img src="<?php echo get_template_directory_uri() ?>/img/buy-apparel/service.svg" alt="" />
                        <div class="info-item__content">
                            <label>Dịch vụ</label>
                            <p id="end-plan"></p>
                        </div>
                    </div>
                    <div class="info-item">
                        <img src="<?php echo get_template_directory_uri() ?>/img/buy-apparel/location.svg" alt="" />
                        <div class="info-item__content">
                            <label id="end-dealer-name"></label>
                            <p id="end-dealer-address"></p>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <a href="javascript: void(0);" class="btn btn-link btn-link-red" data-dismiss="modal">HUỶ BỎ</a>
                <a href="javascript:void(0);" class="btn-clip btn-red btn-buy-now" id="booking">ĐẶT DỊCH VỤ</a>
            </div>            
        </div>
    </div>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {

        <?php if ($booking === 'true') : ?>
            $("html, body").animate({
                scrollTop: $("#book-service").offset().top - 85
            });
        <?php endif; ?>

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
                //     return '<span class="' + className + '"><span class="halfclip"><span class="halfcircle clipped"></span></span><span class="halfcircle fixed"></span></span>';
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

        $('.datepicker').datepicker({
            format: 'dd/mm/yyyy'
        }).on('changeDate', function(ev) {
            var text = $('.datepicker').val();

            $("#title-date").text(text);

        });

        $(document).on('click', '.filter-type .dropdown-item', function() {
            var that = $(this);
            var text = that.text();
            var slug = that.attr('data-slug');
            var filter = that.attr('data-val');
            let id = that.attr("data-id");

            $(".filter-type .btn-filter").text(text);
            filter_type = filter;

            $.ajax({
                url: ajaxurl, // AJAX handler
                data: {
                    'action': 'filter_type',
                    'f': slug,
                },
                type: 'POST',
                beforeSend: function(xhr) {

                },
                success: function(data) {
                    if (data) {
                        var item = $.parseJSON(data);
                        // console.log(item.data);
                        $(".filter-bike .dropdown-menu .dropdown-item").remove();

                        if (item.item_show !== "") {
                            $(".filter-bike .btn-filter").html("");

                            $(".filter-bike .dropdown-menu").append(item.data);
                            $(".filter-bike .btn-filter").html("Chọn Mẫu Xe");
                            filter_bike = '';
                        } else {
                            $(".filter-bike .btn-filter").html("Chọn Mẫu Xe");
                        }

                        // $(".filter-type .btn-filter").text(data.item_show);
                    }
                }
            })

            $.ajax({
                url: ajaxurl, // AJAX handler
                data: {
                    'action': 'ajax_dealer',
                    'id': id,
                    'not_tag': 1,
                },
                type: 'POST',
                beforeSend: function(xhr) {
                    $(".filter-dealer .dropdown-menu a").remove();
                },
                success: function(data) {
                    if (data) {
                        // var item = $.parseJSON(data);

                        $(".filter-dealer .dropdown-menu").append(data);

                        let first = $(".filter-dealer .dropdown-menu .dropdown-item:first-child").html();
                        let address_f = $(".filter-dealer .dropdown-menu .dropdown-item:first-child").attr("data-address");

                        filter_dealer = {};
                        $(".filter-dealer .title").html("Chọn Đại Lý");
                        $(".filter-dealer .label").html("");
                    }
                }
            })

        });

        $(document).on('click', '.filter-bike .dropdown-item', function() {
            var that = $(this);
            var text = that.text();
            var filter = that.attr('data-val');
            let id = that.attr('data-id');

            $(".filter-bike .btn-filter").text(text);
            filter_bike = filter;
            filter_img = that.attr('data-img');

            $.ajax({
                url: ajaxurl, // AJAX handler
                data: {
                    'action': 'ajax_dealer',
                    'id': id,
                    'not_tag': 1,
                },
                type: 'POST',
                beforeSend: function(xhr) {
                    $(".filter-dealer .dropdown-menu a").remove();
                },
                success: function(data) {
                    if (data) {
                        // var item = $.parseJSON(data);

                        $(".filter-dealer .dropdown-menu").append(data);

                        let first = $(".filter-dealer .dropdown-menu .dropdown-item:first-child").html();
                        let address_f = $(".filter-dealer .dropdown-menu .dropdown-item:first-child").attr("data-address");

                        filter_dealer = {};
                        $(".filter-dealer .title").html("Chọn Đại Lý");
                        $(".filter-dealer .label").html("");
                    }
                }
            })
        });

        $(document).on('click', '.filter-service .dropdown-item', function() {
            var that = $(this);
            var text = that.text();
            var filter = that.attr('data-val');

            $(".filter-service .btn-filter").text(text);
            filter_service = filter;

        });

        $(document).on('click', '.filter-dealer .dropdown-item', function() {
            var that = $(this);
            var text = that.html();
            var name = that.attr('data-name');
            var address = that.attr('data-address');

            $(".filter-dealer .title").html(text);
            $(".filter-dealer .label").html(text);

            filter_dealer = {
                address_name: name,
                address: address,
            };

        });

        $(document).on("click", "#booking", function() {
            var name = $(".form-service input[name=name]").val(),
                phone = $(".form-service input[name=phone]").val(),
                email = $(".form-service input[name=email]").val(),
                address = $(".form-service input[name=address]").val(),
                date = $(".form-service input[name=date]").val(),
                time = $(".form-service input[name=time]:checked").val(),
                message = $(".form-service textarea[name=message]").val();

            data = {
                type: filter_type,
                model: filter_bike,
                name: name,
                phone: phone,
                email: email,
                address: address,
                date: date,
                time: time,
                plan: filter_service,
                dealer: filter_dealer,
                message: message,
            }

            // console.log(data);return ;
            $("#staticBackdrop .error-rp").remove();
            $("#staticBackdrop .btn-buy-now").addClass("disabled");
            $.ajax({
                url: ajaxurl, // AJAX handler
                data: {
                    'action': 'form_service',
                    'order': data,
                },
                dataType: 'json',
                type: 'POST',
                success: function(data) {
                    $("#staticBackdrop .btn-buy-now").removeClass("disabled");
                    if(data.responseMessage == 'Success'){
                        window.location.href = '<?php the_permalink(510); ?>?title=Đăng kí dịch vụ thành công&message=Cám ơn bạn đã đăng kí, nhân viên chăm sóc khách hàng sẽ liên hệ với bạn trong thời gian sớm nhất';
                    }else{
                        var html ='<div class="error-rp alert alert-danger" role="alert">'+data.responseMessage+'</div>';
                        $("#staticBackdrop .modal-body").append(html);
                    }
                }
            })
        })

        $(".form-service").on('submit', function(e) {
            e.preventDefault();

            var name = $(".form-service input[name=name]").val(),
                phone = $(".form-service input[name=phone]").val(),
                email = $(".form-service input[name=email]").val(),
                address = $(".form-service input[name=address]").val(),
                date = $(".form-service input[name=date]").val(),
                time = $(".form-service input[name=time]:checked").val(),
                message = $(".form-service textarea[name=message]").val();


            if (filter_type == '') {
                $(".form-service .filter-type .invalid-feedback").addClass("valid");
                $(".form-service .filter-type .invalid-feedback").html("Bạn chưa chọn dòng xe");
            } else {
                $(".form-service .filter-type .invalid-feedback").removeClass("valid");
            }

            if (filter_bike == '') {
                $(".form-service .filter-bike .invalid-feedback").addClass("valid");
                $(".form-service .filter-bike .invalid-feedback").html("Bạn chưa Chọn Mẫu Xe");
            } else {
                $(".form-service .filter-bike .invalid-feedback").removeClass("valid");
            }

            if (name == '') {
                $(".form-service input[name=name]~.invalid-feedback").addClass("valid");
                $(".form-service input[name=name]~.invalid-feedback").html("Bạn chưa nhập họ và tên");
            } else {
                $(".form-service input[name=name]~.invalid-feedback").removeClass("valid");
            }


            let reg_phone = (/0[0-9]{9}/).test(phone);
            if (phone === '') {
                $(".form-service input[name=phone]~.invalid-feedback").addClass("valid");
                $(".form-service input[name=phone]~.invalid-feedback").html("Bạn chưa nhập số điện thoại");
            } else if (phone.length != 10) {
                $(".form-service input[name=phone]~.invalid-feedback").addClass("valid");
                $(".form-service input[name=phone]~.invalid-feedback").html("Số điện thoại tối đa 10 số");
            } else if (!reg_phone) {
                $(".form-service input[name=phone]~.invalid-feedback").addClass("valid");
                $(".form-service input[name=phone]~.invalid-feedback").html("Số điện thoại không đúng định dạng");
            } else {
                $(".form-service input[name=phone]~.invalid-feedback").removeClass("valid");
            }

            let reg_email = (/^[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?$/).test(email);

            if (email == '') {
                $(".form-service input[name=email]~.invalid-feedback").addClass("valid");
                $(".form-service input[name=email]~.invalid-feedback").html("Bạn chưa nhập email");
            } else if (!reg_email) {
                $(".form-service input[name=email]~.invalid-feedback").addClass("valid");
                $(".form-service input[name=email]~.invalid-feedback").html("Email không đúng định dạng");
            } else {
                $(".form-service input[name=email]~.invalid-feedback").removeClass("valid");
            }

            if (address == '') {
                $(".form-service input[name=address]~.invalid-feedback").addClass("valid");
                $(".form-service input[name=address]~.invalid-feedback").html("Bạn chưa nhập địa chỉ");
            } else {
                $(".form-service input[name=address]~.invalid-feedback").removeClass("valid");
            }

            if (filter_service == '') {
                $(".form-service .filter-service .invalid-feedback").addClass("valid");
                $(".form-service .filter-service .invalid-feedback").html("Bạn chưa chọn loại dịch vụ");
            } else {
                $(".form-service .filter-service .invalid-feedback").removeClass("valid");
            }

            if ($.isEmptyObject(filter_dealer)) {
                $(".form-service .filter-dealer .invalid-feedback").addClass("valid");
                $(".form-service .filter-dealer .invalid-feedback").html("Bạn chưa chọn đại lý");
            } else {
                $(".form-service .filter-dealer .invalid-feedback").removeClass("valid");
            }

            let error = $(".invalid-feedback.valid").length;

            if (error != 0) {
                return false;
            }

            $("#end-img").attr("src", filter_img);
            $("#end-bike").text(filter_bike);
            $("#end-type").text(filter_type);
            $("#end-name").text(name);
            $("#end-phone").text(phone);
            $("#end-email").text(email);
            $("#end-address").text(address);
            $("#end-date").text(date);
            if (time == 1) {
                $("#end-time1").text("Buổi Sáng");
                $("#end-time2").text("08:00 AM - 11:00 AM");
            } else {
                $("#end-time1").text("Buổi Chiều");
                $("#end-time2").text("01:00 PM - 09:00 PM");
            }
            $("#end-plan").text(filter_service);
            $("#end-dealer-name").text(filter_dealer.address_name);
            $("#end-dealer-address").text(filter_dealer.address);


            $("#staticBackdrop").modal('show');
        });

        // $(".form-service").on('submit', function(e) {
        //     e.preventDefault();

        //     var name = $("input[name=name]").val(),
        //         phone = $("input[name=phone]").val(),
        //         email = $("input[name=email]").val(),
        //         address = $("input[name=address]").val(),
        //         date = $("input[name=date]").val(),
        //         time = $("input[name=time]").val(),

        //         data = {
        //             type: filter_type,
        //             model: filter_bike,
        //             name: name,
        //             phone: phone,
        //             email: email,
        //             address: address,
        //             date: date,
        //             time: time,
        //             plan: filter_service,
        //             dealer: filter_dealer
        //         }

        //     // console.log(data);

        //     $.ajax({
        //         url: ajaxurl, // AJAX handler
        //         data: {
        //             'action': 'form_service',
        //             'order': data,
        //         },
        //         type: 'POST',
        //         success: function(data) {

        //             if (data) {

        //             }
        //         }
        //     })

        // })
    });
</script>


<?php
get_footer();
?>