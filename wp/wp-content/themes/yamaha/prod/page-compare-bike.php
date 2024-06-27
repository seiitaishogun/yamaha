<?php
get_header();
// $page_id = get_the_ID();
$page_id = get_queried_object_id();

$categories = get_terms(array(
    'taxonomy' => 'products',
    'hide_empty' => false,
));

$terms = get_term_by('id', $page_id, 'products');

if (isset($_GET['id'])) {
    $bike_id = $_GET['id'];
}


?>

<?php
$group = get_field("banner", $page_id);
if ($group) :
?>
    <div class="banner-single-full bg" style="background-image: url('<?php echo $group['image'] ?>')">
        <div class="container-fluid">
            <div class="content-banner">
                <h1 class="title ff-1"><?php echo $group['title'] ?></h1>
            </div>
        </div>
    </div>
<?php endif; ?>

<div class="compare-table">
    <div class="container-fluid">
        <div class="list-product">
            <div class="row row-0">
                <div class="col-md-4 col-6 n-index" data-index="0">
                    <?php if ($bike_id) : ?>
                        <?php
                        $overview = get_field("overview", $bike_id);
                        if ($overview) :
                            $list_colors = $overview['list_colors'];
                            $group = get_field("feature_product", $bike_id);
                        ?>
                            <div class="product-item has-pick" id="bike-<?php echo $bike_id; ?>">
                                <a href="javascript: void(0)" class="btn-close" data-id="<?php echo $bike_id; ?>"><img src="<?php echo get_template_directory_uri() ?>/img/compare/icons/icon-close.svg" alt="icon"></a>
                                <img src="<?php echo $group['feature_img']; ?>" alt="img-bike" class="img-fluid">
                                <div class="content">
                                    <h4 class="title ff-1"><?php echo get_the_title($bike_id); ?></h4>
                                    <p class="price mb-0">Giá từ <span><?php echo $list_colors[0]['price_color'] ?> ₫</span></p>
                                </div>
                                <a href="<?php the_permalink(193) ?>?id=<?php echo $bike_id; ?>" class="colorRed text-uppercase fz14 bold d-xl-flex d-lg-flex align-items-center link-red">Đặt <span style="width: 14px"></span> <i class="ico__chev-right"></i></a>
                            </div>

                        <?php endif; ?>
                    <?php endif ?>
                    <!-- <div class="product-item">
                        <img src="<?php echo get_template_directory_uri() ?>/img/compare/img-bike-add.png" alt="img-bike" class="img-fluid">
                        <a href="#" class="link-add" data-toggle="modal" data-target="#addBikeModal"><span class="icon"><img src="<?php echo get_template_directory_uri() ?>/img/compare/icons/icon-add.svg" alt="icon"></span></a>
                    </div> -->

                </div>

                <div class="col-md-4 col-6 n-index" data-index="1">

                    <div class="product-item">
                        <img src="<?php echo get_template_directory_uri() ?>/img/compare/img-bike-add.png" alt="img-bike" class="img-fluid">
                        <a href="#" class="link-add"><span class="icon"><img src="<?php echo get_template_directory_uri() ?>/img/compare/icons/icon-add.svg" alt="icon"></span></a>
                    </div>
                </div>
                <div class="col-md-4 col-6 d-md-block d-none n-index" data-index="2">

                    <div class="product-item">
                        <img src="<?php echo get_template_directory_uri() ?>/img/compare/img-bike-add.png" alt="img-bike" class="img-fluid">
                        <a href="#" class="link-add"><span class="icon"><img src="<?php echo get_template_directory_uri() ?>/img/compare/icons/icon-add.svg" alt="icon"></span></a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal preview-modal fade" id="addBikeModal" tabindex="-1" aria-labelledby="addBikeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addBikeModalLabel">XEM TRƯỚC</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body d-md-flex d-none">
                        <ul class="h-menu__category non-scroll">
                            <?php foreach ($categories as $key => $_m) : ?>
                                <?php
                                if ($key === 0) {
                                    $default = $_m->name;
                                }
                                ?>
                                <li class="<?php echo $key === 0 ? 'tab-item active' : 'tab-item' ?>">
                                    <span><?php echo $_m->name; ?></span>
                                    <div class="line"></div>
                                </li>

                            <?php endforeach; ?>
                        </ul>
                        <div class="h-menu__content">
                            <?php foreach ($categories as $key => $_m) : ?>
                                <?php

                                $args = array(
                                    'post_type' => 'product',
                                    'tax_query' => array(
                                        array(
                                            'taxonomy' => 'products',
                                            'field' => 'term_id',
                                            'terms' => $_m->term_taxonomy_id,
                                        )
                                    )
                                );
                                $query = new WP_Query($args);
                                $posts = $query->posts;

                                ?>
                                <div class="<?php echo $key === 0 ? 'h-menu__section active' : 'h-menu__section' ?>">
                                    <div class="row">
                                        <?php
                                        foreach ($posts as $post) :
                                            $group = get_field("feature_product", $post->ID);
                                            $price = $group['feature_price'];
                                            $spec = get_field("specification_detail", $post->ID);
                                        ?>
                                            <div class="col-6">
                                                <a href="javascript: void(0)" data-id="<?php echo $post->ID ?>" data-title="<?php echo get_the_title(); ?>" data-img="<?php echo $group['feature_img']; ?>" data-price="<?php echo number_format($price, 0, ',', ','); ?>" data-spec='<?php echo json_encode($spec); ?>' class="stretched-link get-item"></a>
                                                <img src="<?php echo $group['feature_img']; ?>" alt="">
                                                <strong><?php echo get_the_title(); ?></strong>
                                                <p class="colorGray fz14">Giá từ <span class="fz20"><?php echo currencyFormat($price); ?></span></p>
                                            </div>

                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>

                        </div>
                    </div>

                    <div class="modal-body d-md-none">

                        <div class="navmenu-drawer__content">

                            <?php foreach ($categories as $key => $_m) : ?>
                                <?php

                                $args = array(
                                    'post_type' => 'product',
                                    'tax_query' => array(
                                        array(
                                            'taxonomy' => 'products',
                                            'field' => 'term_id',
                                            'terms' => $_m->term_taxonomy_id,
                                        )
                                    )
                                );
                                $query = new WP_Query($args);
                                $posts = $query->posts;
                                $count = 0;

                                ?>
                                <div class="h__drawer-item" data-title="<?php echo $_m->title; ?>">
                                    <a href="javascript:void(0)" class="btn btn__h-drawer" data-toggle="collapse" data-target="#collapse_h<?php echo $_m->term_taxonomy_id ?>" aria-expanded="" aria-controls="collapse">
                                        <?php echo $_m->name; ?>
                                    </a>

                                    <ul class="h__drawer-list collapse <?php echo $key === 0 ? 'show' : '' ?>" id="collapse_h<?php echo $_m->term_taxonomy_id; ?>">
                                        <?php foreach ($posts as $post) :
                                            $count++;
                                            $group = get_field("feature_product", $post->ID);
                                            $price = $group['feature_price'];
                                            if ($count < 5) : ?>
                                                <li class="position-relative">
                                                    <a href="javascript: void(0)" data-id="<?php echo $post->ID ?>" data-title="<?php echo get_the_title(); ?>" data-img="<?php echo $group['feature_img']; ?>" data-price="<?php echo number_format($price, 0, ',', ','); ?>" data-spec='<?php echo json_encode($spec); ?>' class="stretched-link get-item"></a>
                                                    <img src="<?php echo $group['feature_img']; ?>" alt="">
                                                    <div>
                                                        <strong class="fz16"><?php echo get_the_title(); ?></strong>
                                                        <p class="colorGray fz14">Giá từ <span class="fz14"><?php echo currencyFormat($price) ?></span></p>
                                                    </div>

                                                </li>
                                        <?php endif;
                                        endforeach; ?>

                                    </ul>
                                </div>
                            <?php endforeach; ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="specifications-accordion" id="accordionExample">
            <?php if ($bike_id) : ?>

                <?php $detail = get_field("specification_detail", $bike_id); ?>
                <?php if ($detail) : ?>
                    <?php
                    foreach ($detail as $k => $el) :
                    ?>
                        <div class="product__accordion">
                            <button class="product__accordion-btn <?php echo $k == 0 ? '' : 'collapsed' ?>" type="button" data-toggle="collapse" data-target="#collapse_p<?php echo $k; ?>" aria-expanded="<?php echo $k === 0 ? 'true' : 'false' ?>" aria-controls="collapse<?php echo $k; ?>">
                                <?php echo $el['headline']; ?> <span class="icon-show"><img src="<?php echo get_template_directory_uri() ?>/img/compare/icons/icon-up.svg" alt="icon"></span>
                            </button>

                            <div id="collapse_p<?php echo $k; ?>" class="collapse <?php echo $k === 0 ? 'show' : '' ?>" style="">

                                <ul>
                                    <?php foreach ($el['specification'] as $e) : ?>
                                        <li>
                                            <strong><?php echo $e['title'] ?></strong>
                                            <ul>
                                                <li class="none-border-top"><?php echo $e['description'] ?></li>
                                            </ul>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            <?php endif; ?>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/lodash@4.17.21/lodash.min.js"></script>

<script type="text/javascript">
    var n_index = "";
    var id1 = id2 = id3 = 0;
    id1 = '<?php echo $bike_id ? $bike_id : 0 ?>';

    function computeStiky() {
        let containerWidth = $('.container-fluid').width();
        $('.list-product').width(containerWidth);

        let top = $(window).scrollTop();
        let topFooter = $('.f__block-social').offset().top;

        if (top > 400) {
            $('.list-product').addClass('fixed');
        } else {
            $('.list-product').removeClass('fixed');
        }

        let windowWidth = $(window).width();

        if (windowWidth < 960) {
            if ((top + 300) >= topFooter) {
                $('.list-product').hide();
            } else {
                $('.list-product').show();
            }
        }
    }



    $(document).ready(function() {

        computeStiky();

        $(window).scroll(function() {
            computeStiky();
        });

        $(window).resize(function() {
            computeStiky();
        });

        $(document).on("click", ".btn-close", function(e) {
            var that = $(this);
            var id = that.attr("data-id");
            var item_add = '<div class="product-item"><img src="<?php echo get_template_directory_uri() ?>/img/compare/img-bike-add.png" alt="img-bike" class="img-fluid"><a href="#" class="link-add" data-toggle="modal" data-target="#addBikeModal"><span class="icon"><img src="<?php echo get_template_directory_uri() ?>/img/compare/icons/icon-add.svg" alt="icon"></span></a></div>';

            n_index = that.closest(".n-index").attr("data-index");
            that.parents('.n-index').empty();
            $(".n-index:eq(" + n_index + ")").append(item_add);

            let count_pick = $(".product-item.has-pick").length;

            if (count_pick < 1) {
                $(".product__accordion .collapse > ul").remove();
            } 
            switch (n_index) {
                case "0":
                    id1 = 0;
                    break;
                case "1":
                    id2 = 0;
                    break;
                case "2":
                    id3 = 0;
                    break;
                default:
                    break;
            }

            $(".product__accordion .collapse > ul > li > ul > li:nth-child(" + (parseInt(n_index) + 1) + ")").html("");

        });

        $(document).on("click", ".list-product .product-item .link-add", function(e) {
            e.preventDefault();
            var that = $(this);
            n_index = that.closest(".n-index").attr("data-index");
            $("#addBikeModal").modal('show');
        });

        $(document).on("click", ".get-item", function(e) {
            let that = $(this);
            let id = that.attr('data-id');
            let title = that.attr('data-title');
            let img = that.attr('data-img');
            let price = that.attr('data-price');
            let spec = that.attr('data-spec');
            let data_spec = JSON.parse(decodeURIComponent(spec));
            let compare_bike = '<div class="product-item has-pick" id="bike-' + id + '"><a href="javascript: void(0)" class="btn-close" data-id="' + id + '"><img src="<?php echo get_template_directory_uri() ?>/img/compare/icons/icon-close.svg" alt="icon"></a><img src="' + img + '" alt="img-bike" class="img-fluid"><div class="content"><h4 class="title ff-1">' + title + '</h4><p class="price mb-0">Giá từ <span>' + price + ' ₫</span></p></div><a href="<?php the_permalink(193) ?>?id=' + id + '" class="colorRed text-uppercase fz14 bold d-xl-flex d-lg-flex align-items-center link-red">Đặt <span style="width: 14px"></span> <i class="ico__chev-right"></i></a></div>';

            let data = {};
            $(".n-index").eq(n_index).empty();
            $(".n-index").eq(n_index).append(compare_bike);
            switch (n_index) {
                case "0":

                    id1 = id;
                    data = {
                        bike_1: id1,
                        bike_2: id2,
                        bike_3: id3,
                    }
                    break;
                case "1":

                    id2 = id;
                    data = {
                        bike_1: id1,
                        bike_2: id2,
                        bike_3: id3,
                    }
                    break;
                case "2":

                    id3 = id;
                    data = {
                        bike_1: id1,
                        bike_2: id2,
                        bike_3: id3,
                    }
                    break;
                default:
                    break;
            }

            $("#addBikeModal").modal('hide');


            // console.log(data);
            // return;

            $.ajax({
                url: ajaxurl, // AJAX handler
                data: {
                    'action': 'comparebike',
                    'data': data,
                },
                type: 'POST',
                beforeSend: function(xhr) {
                    $(".specifications-accordion").empty();
                },
                success: function(res) {
                    if (res) {
                        $(".specifications-accordion").append(res);
                    }
                }
            })
        });

    });
</script>

<?php
get_footer();
