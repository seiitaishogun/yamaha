<?php
get_header();

$term = get_queried_object();

$args = array(
    'post_type' => 'package',
    'paged' => 1,
    'post_status' => 'publish',
    'posts_per_page' => -1,
    // 'suppress_filters' => true,
    // 'meta_key' => 'price',
    // 'orderby' => 'meta_value',
    // 'order' => 'ASC',
    'tax_query' => array(
        array(
            'taxonomy' => 'type_services',
            'field' => 'slug',
            'terms' => $term->slug,
        ),
    )
);

$query = new WP_Query($args);

$posts = $query->posts;

$count = $query->post_count;


?>

<style type="text/css">
    @import url(https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css);
</style>

<div class="navigator__breadcrumbs">
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo get_permalink(5) ?>">Home</a></li>
                <li class="breadcrumb-item"><a href="<?php echo get_permalink(110); ?>">Service</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo get_the_title($page_id); ?></li>
            </ol>
        </nav>
    </div>
</div>

<section class="cat-banner banner-single">
    <div class="container-fluid">
        <?php $banner = get_field('banner_header', 420); ?>
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
    <div class="container-fluid">
        <div class="container-small">
            <div class="row-content justify-content-end">
                <div class="right-content full-mb">
                    <div class="top-detail">
                        <h2 class="title"><span id="count-pack"><?php echo $count ?></span> PACKAGES</h2>

                        <div class="group-dropdown">
                            <?php
                            $term_service = get_terms([
                                'taxonomy' => "type_services",
                                'hide_empty' => false,
                            ]);
                            ?>
                            <div class="dropdown dropdown--selected">
                                <a href="javascript:void(0)" class="btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <div class="label">SERVICE PACKAGE <sup>*</sup></div>
                                    <div class="title"><?php echo $term->name; ?></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <?php foreach ($term_service as $k => $item) : ?>
                                        <a class="dropdown-item" href="<?php echo get_term_link($item->term_id); ?>" ><?php echo $item->name; ?></a>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <div style="width: 8px"></div>
                            <?php
                            $term_type = get_terms([
                                'taxonomy' => "type_bike",
                                'hide_empty' => false,
                            ]);
                            ?>
                            <div class="dropdown dropdown--selected filter-type">
                                <a href="javascript:void(0)" class="btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <div class="label">BIKE TYPE <sup>*</sup></div>
                                    <div class="title">Choose type</div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <?php foreach ($term_type as $k => $item) : ?>
                                        <a class="dropdown-item" href="javascript:void(0)" data-filter="<?php echo $item->slug; ?>"><?php echo $item->name; ?></a>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-small d-md-block d-none">
            <div class="row-content">

                <div class="left-content">
                    <ul class="list-item">

                        <?php foreach ($posts as $k => $item) : ?>
                            <?php $price = get_field('price', $item->ID); ?>
                            <?php if ($item) : ?>
                                <li class="<?php echo $k == 0 ? 'active' : '' ?>"><a href="#"><?php echo get_field('name_bike', $item->ID) ?> (<?php echo currencyFormat($price) ?>)</a></li>
                            <?php endif; ?>

                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="right-content">
                    <div class="list-detail-content">
                        <?php foreach ($posts as $k => $item) : ?>
                            <?php $price = get_field('price', $item->ID); ?>
                            <?php if ($item) : ?>
                                <div class="detail-content <?php echo $k == 0 ? 'active' : '' ?>">
                                    <p class="sub-title"><?php echo get_field('name_service', $item->ID) ?></p>
                                    <h3 class="title"><?php echo get_field('name_bike', $item->ID) ?></h3>
                                    <p class="price"><?php echo currencyFormat($price) ?></p>
                                    <div class="image">
                                        <img src="<?php echo get_field('image', $item->ID) ?>" alt="img-service-package-detail" class="img-fluid">
                                    </div>
                                    <div><?php echo get_field('content', $item->ID) ?></div>
                                    <ul>
                                        <li><img src="<?php echo get_template_directory_uri() ?>/img/all-service/icons/icon-star.svg" alt="icon" class="icon"><?php echo get_field('rating', $item->ID) ?></li>
                                        <li><img src="<?php echo get_template_directory_uri() ?>/img/all-service/icons/icon-phone.svg" alt="icon" class="icon"><a href="tel:<?php echo get_field('phone_number', $item->ID) ?>"><?php echo get_field('phone_number', $item->ID) ?></a></li>
                                        <li><img src="<?php echo get_template_directory_uri() ?>/img/all-service/icons/icon-clock.svg" alt="icon" class="icon"><?php echo get_field('time_active', $item->ID) ?></li>
                                        <li><img src="<?php echo get_template_directory_uri() ?>/img/all-service/icons/icon-pin.svg" alt="icon" class="icon"><a href="#"><?php echo get_field('address', $item->ID) ?></a></li>
                                    </ul>
                                    <a href="<?php echo get_permalink(422); ?>" class="btn-clip btn-red">BOOK A SERVICE package</a>
                                </div>
                            <?php endif; ?>

                        <?php endforeach; ?>

                    </div>
                </div>
            </div>
        </div>
        <div class="list-service d-md-none">
            <div class="row sm-gutters">
                <?php $key = [1, 2, 3, 4];
                $count_key = 0; ?>
                <?php foreach ($posts as $k => $item) : ?>
                    <?php $count_key = $count_key + 1; ?>
                    <?php $price = get_field('price', $item->ID); ?>
                    <?php if ($item) : ?>
                        <div class="col-6">
                            <div class="background-image" data-toggle="modal" a="<?php echo $count_key; ?>" data-target="#packageModal<?php echo $item->ID ?>" style="background-image: url(<?php echo get_field('image', $item->ID) ?>);">
                                <div class="d-md-flex">
                                    <div class="icon"><img src="<?php echo get_template_directory_uri() ?>/img/service/icons/icon-<?php echo $key[$count_key - 1]; ?>.svg" alt="icon"></div>
                                    <div class="info">
                                        <h3 class="colorWhite exbold ff-1"><?php echo get_field('name_bike', $item->ID) ?></h3>
                                        <div style="height: 8px;"></div>
                                        <div class="colorLine fz14"><?php echo currencyFormat($price) ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php
                    if ($count_key > 3) {
                        $count_key = 0;
                    }
                    ?>

                <?php endforeach; ?>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal-add">
            <?php $count_key1 = 0; ?>
            <?php foreach ($posts as $k => $item) : ?>
                <?php $count_key1 = $count_key1 + 1; ?>
                <?php $price = get_field('price', $item->ID); ?>
                <?php if ($item) : ?>
                    <div class="modal modal-package fade" id="packageModal<?php echo $item->ID ?>" tabindex="-1" a="<?php echo $count_key1; ?>" role="dialog" aria-labelledby="packageModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header" style="background-image: url(<?php echo get_field('image', $item->ID) ?>);">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <div class="icon"><img src="<?php echo get_template_directory_uri() ?>/img/service/icons/icon-<?php echo $key[$count_key1 - 1]; ?>.svg" alt="icon"></div>
                                    <div class="modal-title">
                                        <h5 class="title"><?php echo get_field('name_bike', $item->ID) ?></h5>
                                        <p class="price"><?php echo currencyFormat($price) ?></p>
                                    </div>
                                </div>
                                <div class="modal-body">
                                    <div class="scroll">
                                        <div class="detail-content">
                                            <?php echo get_field('content', $item->ID) ?>

                                            <ul>
                                                <li><img src="<?php echo get_template_directory_uri() ?>/img/all-service/icons/icon-star.svg" alt="icon"><?php echo get_field('rating', $item->ID) ?></li>
                                                <li><img src="<?php echo get_template_directory_uri() ?>/img/all-service/icons/icon-phone.svg" alt="icon"><a href="tel:<?php echo get_field('phone_number', $item->ID) ?>"><?php echo get_field('phone_number', $item->ID) ?></a></li>
                                                <li><img src="<?php echo get_template_directory_uri() ?>/img/all-service/icons/icon-clock.svg" alt="icon"><?php echo get_field('time_active', $item->ID) ?></li>
                                                <li><img src="<?php echo get_template_directory_uri() ?>/img/all-service/icons/icon-pin.svg" alt="icon"><a href="#"><?php echo get_field('address', $item->ID) ?></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <a href="<?php echo get_permalink(422); ?>" class="btn-clip btn-border-red">BOOK A SERVICE package</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    if ($count_key1 > 3) {
                        $count_key1 = 0;
                    }
                    ?>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<script type="text/javascript">
    $(document).ready(function() {

        $('.service-detail .list-item a').click(function(e) {
            e.preventDefault();
            var $index = $(this).parent().index();
            var $item = $('.service-detail .detail-content');

            $('.service-detail .list-item li').removeClass('active');
            $(this).parent().addClass('active');

            $item.removeClass('active');
            $item.eq($index).addClass('active');
        });

        $(document).on('click', '.filter-type .dropdown-item', function() {
            var that = $(this);
            var text = that.text();
            var filter = that.attr('data-filter');

            $(".filter-type .title").text(text);


            $.ajax({ // you can also use $.post here
                url: ajaxurl, // AJAX handler
                data: {
                    'action': 'filter_bike',
                    'filter': '<?php echo $term->slug; ?>',
                    'type': filter,
                },
                type: 'POST',
                beforeSend: function(xhr) {
                    $(".list-item > li").remove();
                    $(".list-detail-content .detail-content").remove();
                    $(".list-service .row .col-6").remove();
                    $(".modal-package").remove();
                    $(".count-pack").text("");
                },
                success: function(data) {
                    var parseData = $.parseJSON(data);
                    if (parseData) {
                        $(".list-item").append(parseData[0]);
                        $(".list-detail-content").append(parseData[1]);
                        $(".count-pack").text(parseData[2]);
                        $(".list-service .row").append(parseData[3]);
                        $(".modal-add").append(parseData[4]);
                    }
                }
            });
        });
    });
</script>


<?php
get_footer();
?>