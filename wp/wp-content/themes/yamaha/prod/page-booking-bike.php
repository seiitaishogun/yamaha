<?php
get_header();
$page_id = get_queried_object_id();

$terms = get_terms([
    'taxonomy' => "products",
    'hide_empty' => false,
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


if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $default = get_the_terms($id, 'products')[0]->name;
    $slug = get_the_terms($id, 'products')[0]->slug;

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
        ),
    );

    $query = new WP_Query($args);

    $posts = $query->posts;
} else {
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
        ),
    );

    $query = new WP_Query($args);

    $posts = $query->posts;

    $id = $posts[0]->ID;
}


if (isset($_GET['img'])) {
    $img = $_GET['img'];
} else {
    $img = get_field("feature_product", $id)['feature_img'];
}

?>

<script type="text/javascript">
    window.location.href = '<?php echo get_site_url()?>/bikes/';
</script>

<style type="text/css">
    @import url(https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css);
</style>

<?php
echo get_template_part('includes/header/header-no-toolbar', 'headline', array(
    'title' => 'ĐẶT XE',
));
?>


<div class="bgGray">
    <div class="container-fluid">
        <div class="wrapper-container wrapper-container--sm booking-bike">
            <!-- <div style="height: 16px;"></div>
            <h5 class="ff-1 colorDark text-uppercase">ĐẶT XE</h5> -->
            <div style="height: 16px;"></div>
            <form action="" method="post" class="form-bike">
                <div class="box-white">
                    <div class="booking__info">
                        <img src="<?php echo $img; ?>" alt="" id="img-pro">
                        <div class="group-dropdown">

                            <div class="dropdown dropdown--selected filter-type">
                                <a href="javascript:void(0)" class="btn custom" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <div class="label">Dòng xe <sup>*</sup></div>
                                    <div class="title btn-filter"><?php echo $default; ?></div>
                                    <script type="text/javascript">
                                        var filter_type = '<?php echo $default; ?>';
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
                                            <a class="dropdown-item" href="javascript:void(0)" data-id="<?php echo $posts_type[0]->ID; ?>" data-slug="<?php echo $e->slug ?>" data-val="<?php echo $e->name; ?>"><?php echo $e->name ?></a>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <div style="width: 8px"></div>

                            <div class="dropdown dropdown--selected filter-bike">
                                <a href="javascript:void(0)" class="btn custom" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <div class="label">Mẫu xe <sup>*</sup></div>
                                    <div class="title btn-filter"><?php echo get_the_title($id); ?></div>
                                    <script type="text/javascript">
                                        var filter_bike = '<?php echo get_the_title($id) ?>';
                                    </script>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <?php foreach ($posts as $e) : ?>
                                        <a class="dropdown-item" href="javascript:void(0)" data-id="<?php echo $e->ID; ?>" data-val="<?php echo get_the_title($e->ID) ?>" data-img="<?php echo get_field("feature_product", $e->ID)['feature_img']; ?>"><?php echo get_the_title($e->ID) ?></a>
                                    <?php endforeach; ?>
                                </div>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div style="height: 16px;"></div>

                <div class="box-white customer-info">
                    <div style="height: 24px;" class="d-lg-block d-none"></div>
                    <div style="height: 12px;" class="d-lg-none d-block"></div>
                    <label for="" class="fz14 colorDark bold text-uppercase">Thông tin của bạn</label>
                    <div style="height: 16px;"></div>
                    <div class="form-group form-ani">
                        <input type="text" name="name" />
                        <label for="">Họ và Tên <span>*</span></label>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="wrap-form d-flex">
                        <div class="form-group form-ani split">
                            <input type="text" name="phone" />
                            <label for="">Số điện thoại <span>*</span></label>
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="form-group form-ani split">
                            <input type="text" name="email" />
                            <label for="">Email <span>*</span></label>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>

                    <div class="form-group form-ani">
                        <input type="text" name="address" />
                        <label for="">Địa chỉ <span>*</span></label>
                        <div class="invalid-feedback"></div>
                    </div>

                    <div class="form-group-important">
                        <label for="">TÌM ĐẠI LÝ</label>
                        <?php
                        $dealers = get_field('dealers', $id);

                        $args_dealer = array(
                            'post_type' => 'dealer',
                            'paged' => 1,
                            'post_status' => 'publish',
                            'posts_per_page' => -1,

                        );
                        $query_dealer = new WP_Query($args_dealer);

                        $post_dealers = $query_dealer->posts;

                        $check = 0;

                        ?>
                        <div class="dropdown filter-dealer">
                            <a href="javascript:void(0)" class="btn btn-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <div class="title">
                                    <span class="text">Chọn Đại Lý</span>
                                </div>
                                <div class="label"></div>
                            </a>
                            <script type="text/javascript">
                                var filter_dealer = {};
                            </script>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <?php foreach ($post_dealers as $e) : ?>
                                    <a class="dropdown-item" href="javascript:void(0)" data-name="<?php echo get_the_title($e->ID); ?>" data-address="<?php echo get_field("address", $e->ID); ?>">
                                        <!-- <?php echo get_field("address", $e->ID); ?> -->
                                        <span class="text"><?php echo get_the_title($e->ID); ?></span>

                                        <?php foreach ($dealers as $i) : ?>
                                            <?php
                                            if ($e->ID === $i->ID) {
                                                $check = 1;
                                            }
                                            ?>
                                        <?php endforeach ?>
                                        <?php
                                        if ($check > 0) {
                                            echo '<span class="tag">In stock</span>';
                                            $check = 0;
                                        } else {
                                            echo '<span class="tag-pre">Pre-order</span>';
                                        }
                                        ?>
                                        <span class="text-sm"><?php echo get_field("address", $e->ID); ?></span>
                                    </a>
                                <?php endforeach ?>
                            </div>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>

                    <div style="height: 8px;"></div>

                    <div class="form-group-important hide">
                        <label for="">Ngày đặt lịch</label>
                        <div class="dropdown dropdown--selected dropdown--selected-date">
                            <a href="javascript:void(0)" class="btn" aria-haspopup="true" aria-expanded="false">
                                <div class="label">Ngày đặt lịch <sup>*</sup></div>
                                <div class="title" id="title-date">&nbsp;</div>
                            </a>
                            <?php $date = date('Y-m-d'); ?>
                            <input class="datepicker" name="date" value="<?php echo $date; ?>">
                        </div>

                        <div style="height: 11px;"></div>

                        <label for="">Ngày đặt lịch</label>
                        <div class="form-row">
                            <div class="col-6">
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="time1" name="time" value="1" class="custom-control-input">
                                    <label class="custom-control-label" for="time1">
                                        <strong class="fz14">Buổi sáng</strong>
                                        <p class="fz12 colorLGray normal mb-0">08:00 AM - 11:00 AM</p>
                                    </label>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="time2" name="time" value="2" class="custom-control-input">
                                    <label class="custom-control-label" for="time2">
                                        <strong class="fz14">Buổi chiều</strong>
                                        <p class="fz12 colorLGray normal mb-0">01:00 PM - 09:00 PM</p>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div style="height: 8px;"></div>

                    <div class="form-group">
                        <label for="">Nội dung <strong class="fz12 colorLine">(Không bắt buộc)</strong></label>
                        <textarea class="form-control" id="" name="message" rows="3" placeholder="Nội dung"></textarea>
                    </div>

                    <div style="height: 8px;"></div>

                    <div class="row align-items-center">
                        <div class="col-md-6 capcha">
                            <!-- <img src="./img/service/img-capcha.jpg" alt="img-capcha"> -->
                            <div class="d-lg-none" style="height: 32px;"></div>
                        </div>
                        <div class="col-md-6 text-right">
                            <button type="submit" class="btn-clip btn-red" style="min-width: 140px" id="booking">XEM TRƯỚC VÀ ĐẶT XE</button>
                        </div>
                    </div>

                    <div style="height: 32px;"></div>

                </div>
            </form>
            <div style="height: 40px;"></div>
        </div>
    </div>
</div>

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
                <div class="title text-uppercase">Đặt xe</div>
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
                    <h5>ĐẠI LÝ</h5>
                    <div class="info-item">
                        <img src="<?php echo get_template_directory_uri() ?>/img/buy-apparel/location.svg" alt="" />
                        <div class="info-item__content">
                            <label id="end-dealer-name"></label>
                            <p id="end-dealer-address"></p>
                        </div>
                    </div>
                </div>
                <div class="customer-info">
                    <h5 class="text-uppercase">Nội dung</h5>
                    <div class="info-item">
                        <p class="fz14" id="end-message"></p>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="javascript: void(0);" class="btn btn-link btn-link-red" data-dismiss="modal">HUỶ BỎ</a>
                    <a href="javascript:void(0);" class="btn-clip btn-red btn-buy-now" id="booking-bike">ĐẶT XE</a>
                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    $(document).ready(function() {

        PageFunction.booking();

        // $('.datepicker').datepicker({
        //     format: 'M ,dd ,yyyy'
        // }).on('changeDate', function(ev) {
        //     var text = $('.datepicker').val();

        //     $("#title-date").text(text);

        // });

        $(document).on('click', '.filter-type .dropdown-item', function() {
            var that = $(this);
            var text = that.text();
            var slug = that.attr('data-slug');
            var filter = that.attr('data-val');
            let id = that.attr("data-id")

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
                            $(".filter-bike .btn-filter").text("");

                            $(".filter-bike .dropdown-menu").append(item.data);

                            $(".filter-bike .btn-filter").text(item.item_show);

                            let img_f = $(".filter-bike .dropdown-menu .dropdown-item:first-child").attr("data-img");
                            $("#img-pro").attr("src", img_f);

                        } else {
                            $(".filter-bike .btn-filter").html("&nbsp;");
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
            var img = that.attr('data-img');
            let id = that.attr('data-id');

            $(".filter-bike .btn-filter").text(text);
            $("#img-pro").attr("src", img);
            $("#img-pro").addClass("src");
            filter_bike = filter;

            $.ajax({
                url: ajaxurl, // AJAX handler
                data: {
                    'action': 'ajax_dealer',
                    'id': id,
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

                        $(".filter-dealer .title").html(first);
                        $(".filter-dealer .label").html(address_f);
                    }
                }
            })
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


        $(document).on("submit", "form", function(e) {
            e.preventDefault();

            var name = $("input[name=name]").val(),
                phone = $("input[name=phone]").val(),
                email = $("input[name=email]").val(),
                address = $("input[name=address]").val(),
                date = $("input[name=date]").val(),
                time = $("input[name=time]:checked").val(),
                img = $("#img-pro").attr("src"),
                message = $("textarea[name=message]").val();


            if (name == '') {
                $("input[name=name]~.invalid-feedback").addClass("valid");
                $("input[name=name]~.invalid-feedback").html("Bạn chưa nhập họ và tên");
            } else {
                $("input[name=name]~.invalid-feedback").removeClass("valid");
            }


            let reg_phone = (/0[0-9]{9}/).test(phone);
            if (phone === '') {
                $("input[name=phone]~.invalid-feedback").addClass("valid");
                $("input[name=phone]~.invalid-feedback").html("Bạn chưa nhập số điện thoại");
            } else if (phone.length != 10) {
                $("input[name=phone]~.invalid-feedback").addClass("valid");
                $("input[name=phone]~.invalid-feedback").html("Số điện thoại tối đa 10 số");
            } else if (!reg_phone) {
                $("input[name=phone]~.invalid-feedback").addClass("valid");
                $("input[name=phone]~.invalid-feedback").html("Số điện thoại không đúng định dạng");
            } else {
                $("input[name=phone]~.invalid-feedback").removeClass("valid");
            }

            let reg_email = (/^[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?$/).test(email);

            if (email == '') {
                $("input[name=email]~.invalid-feedback").addClass("valid");
                $("input[name=email]~.invalid-feedback").html("Bạn chưa nhập email");
            } else if (!reg_email) {
                $("input[name=email]~.invalid-feedback").addClass("valid");
                $("input[name=email]~.invalid-feedback").html("Email không đúng định dạng");
            } else {
                $("input[name=email]~.invalid-feedback").removeClass("valid");
            }

            if (address == '') {
                $("input[name=address]~.invalid-feedback").addClass("valid");
                $("input[name=address]~.invalid-feedback").html("Bạn chưa nhập địa chỉ");
            } else {
                $("input[name=address]~.invalid-feedback").removeClass("valid");
            }

            if ($.isEmptyObject(filter_dealer)) {
                $(".filter-dealer .invalid-feedback").addClass("valid");
                $(".filter-dealer .invalid-feedback").html("Bạn chưa chọn đại lý");
            } else {
                $(".filter-dealer .invalid-feedback").removeClass("valid");
            }

            let error = $(".invalid-feedback.valid").length;

            if (error != 0) {
                return false;
            }

            $("#end-img").attr("src", img);
            $("#end-bike").text(filter_bike);
            $("#end-type").text(filter_type);
            $("#end-name").text(name);
            $("#end-phone").text(phone);
            $("#end-email").text(email);
            $("#end-address").text(address);
            $("#end-dealer-name").text(filter_dealer.address_name);
            $("#end-dealer-address").text(filter_dealer.address);

            let content = message.replace(/(?:\r\n|\r|\n)/g, '<br>');
            $("#end-message").html(content);


            $("#staticBackdrop").modal('show');
        });

        $(document).on('click', "#booking-bike", function(e) {
            e.preventDefault();
            var name = $("input[name=name]").val(),
                phone = $("input[name=phone]").val(),
                email = $("input[name=email]").val(),
                address = $("input[name=address]").val(),
                message = $("textarea[name=message]").val();

            data = {
                type: filter_type,
                model: filter_bike,
                name: name,
                phone: phone,
                email: email,
                address: address,
                dealer: filter_dealer,
                message: message,
            }

            console.log(data);

            $.ajax({
                url: ajaxurl, // AJAX handler
                data: {
                    'action': 'form_bike',
                    'order': data,
                },
                type: 'POST',
                success: function(data) {

                    window.location.href = '<?php the_permalink(510); ?>';
                }
            })
        })

    });
</script>

<?php
get_footer();
?>