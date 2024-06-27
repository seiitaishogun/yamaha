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

$location = city();

?>

<style type="text/css">
    @import url(https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css);
</style>

<?php
echo get_template_part('includes/header/header-no-toolbar', 'headline', array(
    'title' => 'Tra cứu giá xe lăn bánh',
));
?>

<div class="bgGray">
    <div class="container-fluid">
        <div class="wrapper-container wrapper-container--sm booking-bike">
            <!-- <div style="height: 16px;"></div>
            <h5 class="ff-1 colorDark text-uppercase">Đăng ký lái thử</h5> -->
            <div style="height: 16px;"></div>
            <form action="" method="post" class="form">
                <div class="box-white">
                    <div class="booking__info">
                        <img src="<?php echo get_template_directory_uri() ?>/img/logo.png" alt="" id="img-pro">
                        <div class="group-dropdown">

                            <div class="dropdown dropdown--selected filter-type">
                                <a href="javascript:void(0)" class="btn custom" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <div class="label">Dòng xe <sup>*</sup></div>
                                    <div class="title btn-filter">Chọn Dòng Xe</div>
                                    <script type="text/javascript">
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
                                    <div class="title btn-filter">Chọn Mẫu Xe</div>
                                    <script type="text/javascript">
                                        var filter_bike = '';
                                        var filter_img = '';
                                    </script>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div style="height: 16px;"></div>

                <div class="box-white customer-info">
                    <div style="height: 24px;"></div>
                    <label for="" class="fz14 colorDark bold text-uppercase">Đăng ký & bảo hiểm</label>
                    <div style="height: 16px;"></div>

                    <div class="form-group-important">
                        <label for="" class="text-uppercase">Chọn địa điểm</label>

                        <div class="dropdown filter-location">
                            <a href="javascript:void(0)" class="btn btn-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <div class="title">
                                    <span class="text">Chọn Địa Điểm</span>
                                </div>
                                <div class="label"></div>
                            </a>

                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <div class="dropdown-search">
                                    <input type="text" class="field-search" placeholder="Tìm Địa Điểm">
                                </div>
                                <?php foreach ($location as $k => $e) : ?>
                                    <a class="dropdown-item" href="javascript:void(0)" data-index="<?php echo $k; ?>" data-fee="<?php echo $e[1] ?>" data-price="<?php echo $e[2] ?>">
                                        <span class="text"><?php echo $e[0]; ?></span>
                                    </a>
                                <?php endforeach ?>
                            </div>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>

                    <div style="height: 8px;"></div>

                    <div class="form-group-important">
                        <label for="" class="text-uppercase">Bảo hiểm trách nhiệm dân sự</label>
                        <div class="dropdown filter-dealer">
                            <a href="javascript:void(0)" class="btn btn-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <div class="title">
                                    <span class="text">Chọn Loại Bảo Hiểm</span>
                                </div>
                                <div class="label"></div>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                                <a class="dropdown-item" href="javascript:void(0)" data-fee-insurance="66000">
                                    <span class="text">Bảo hiểm trách nhiệm dân sự</span>
                                    <span class="text-sm">66,000 đồng/1 năm</span>
                                </a>
                                <a class="dropdown-item" href="javascript:void(0)" data-fee-insurance="86000">
                                    <span class="text">Bảo hiểm trách nhiệm dân sự + Bảo hiểm tai nạn cho 2 người ngồi trên xe (mức 10 triệu /người)</span>
                                    <span class="text-sm">86,000 đồng/1 năm</span>
                                </a>
                                <a class="dropdown-item" href="javascript:void(0)" data-fee-insurance="106000">
                                    <span class="text">Bảo hiểm trách nhiệm dân sự + Bảo hiểm tai nạn cho 2 người ngồi trên xe (mức 20 triệu /người)</span>
                                    <span class="text-sm">106,000 đồng/1 năm</span>
                                </a>

                            </div>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>

                    <div style="height: 8px;"></div>

                </div>

                <div style="height: 16px;"></div>

                <div class="box-white customer-info">
                    <div style="height: 20px;"></div>
                    <div class="price-description">
                        <p>Giá niêm yết</p>
                        <p class="bold" id="bike-price"></p>
                        <p id="fee">Phí trước bạ <strong></strong></p>
                        <p id="fee-price" class="bold"></p>
                        <p id="fee-num">Phí biển số xe <strong></strong></p>
                        <p id="fee-num-price" class="bold"></p>
                        <p>Bảo hiểm trách nhiệm nhân sự</p>
                        <p id="insurance" class="bold"></p>

                    </div>
                    <div class="price-total active">
                        <p class="text-uppercase bold">Tổng cộng</p>
                        <p><b class="colorRed fz18" id="total"></b></p>
                    </div>
                    <p class="colorRed fz14 "><span id="price-service"></span></p>
                    <div style="height: 16px;"></div>

                    <div class="row align-items-center">
                        <div class="col-md-6 capcha">
                            <!-- <img src="./img/service/img-capcha.jpg" alt="img-capcha"> -->
                            <div class="d-lg-none" style="height: 32px;"></div>
                        </div>
                        <!-- <div class="col-md-6 text-right">
                            <button type="submit" class="btn-clip btn-red" style="min-width: 140px">KẾ TIẾP</button>
                        </div> -->
                    </div>

                    <div style="height: 32px;"></div>
                </div>
            </form>
            <div style="height: 40px;"></div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

<script type="text/javascript">
    var price_bike = 0;
    var price_board = 0;
    var price_tax = 0;
    var price_insurance = 0;
    var city = <?php echo json_encode($location); ?>;
    var dropdown = '';

    city.map(e => {
        dropdown += '<a class="dropdown-item" href="javascript:void(0)" data-index="' + e[0] + '" data-fee="' + e[1] + '" data-price="<?php echo $e[2] ?>"><span class="text">' + e[0] + '</span></a>'
    })


    function numberWithCommas(x) {
        return x.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
    }

    function Total() {
        let total = price_bike + price_board + price_tax + price_insurance;

        $("#total").html(numberWithCommas(total) + " ₫");
        return total;
    }

    function delay(callback, ms) {
        var timer = 0;
        return function() {
            var context = this,
                args = arguments;
            clearTimeout(timer);
            timer = setTimeout(function() {
                callback.apply(context, args);
            }, ms || 0);
        };
    }
    $(document).ready(function() {

        PageFunction.booking();

        $('.datepicker').datepicker({
            format: 'dd/mm/yyyy',
            startDate: '+1d'
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

                        $("#total").text("");
                        $("#bike-price").text("");
                        $("#fee-price").text("");
                        $("#fee-num-price").text("");
                        $("#fee-num strong").text("");
                        $("#insurance").text("");
                        $("#fee strong").text("");
                        $(".filter-location .title").html("Chọn Địa Điểm");
                        $(".filter-dealer .title").html("Chọn Loại Bảo Hiểm");
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
            let cc = that.attr('data-cc');

            $(".filter-bike .btn-filter").text(text);
            $("#img-pro").attr("src", img);
            $("#img-pro").addClass("src");
            filter_bike = filter;
            price_bike = parseInt(that.attr('data-price'));


            $("#total").text("");
            $("#bike-price").text("");
            $("#fee-price").text("");
            $("#fee-num-price").text("");
            $("#fee-num strong").text("");
            $("#insurance").text("");
            $("#fee strong").text("");
            $(".filter-location .title").html("Chọn Địa Điểm");
            $(".filter-dealer .title").html("Chọn Loại Bảo Hiểm");
            $(".filter-dealer .label").html("");

            $("#bike-price").text(numberWithCommas(price_bike) + " ₫");
            $("#total").text(numberWithCommas(price_bike) + " ₫");
            $(".filter-location .title").html("Chọn Địa Điểm");


            if (parseInt(cc) > 175) {
                $("#price-service").text("*Revzone Yamaha Motor sẽ hỗ trợ đăng ký xe hộ bạn với chi phí 1,500,000 ₫ (tùy địa phương).");
            } else {
                $("#price-service").text("*Revzone Yamaha Motor sẽ hỗ trợ đăng ký xe hộ bạn với chi phí 1,000,000 ₫ (tùy địa phương).");
            }

            Total();
        });

        $(document).on('click', '.filter-dealer .dropdown-item', function() {
            let that = $(this);
            let text = that.html();
            let name = that.attr('data-name');
            let address = that.attr('data-address');
            let insurance = that.attr('data-fee-insurance');

            $(".filter-dealer .title").html(text);
            $(".filter-dealer .label").html(text);

            price_insurance = parseInt(insurance);
            $("#insurance").html(numberWithCommas(insurance) + " ₫");

            Total();
        });

        $(document).on('click', '.filter-location .dropdown-item', function() {
            let that = $(this);
            let text = that.text();
            let filter = that.attr('data-val');
            let fee = that.attr("data-fee");
            let price_format = that.attr('data-price').replace(/đ/g, "");

            price_board = parseInt(that.attr('data-price').replace(/đ/g, "").split(",").join(""));


            $(".filter-location .title").html(text);
            $("#fee strong").html("(" + fee + ")");

            price_tax = price_bike * 0.05;
            let price_fee = numberWithCommas(price_bike * 0.05);
            $("#fee-price").html(price_fee + " ₫");

            $("#fee-num-price").html(price_format + " ₫");

            $("#fee-num strong").html("(Khu vực " + $.trim(text) + ")");

            Total();
        });

        $("form").on("submit", function(e) {
            e.preventDefault();

            var name = $("input[name=name]").val(),
                phone = $("input[name=phone]").val(),
                email = $("input[name=email]").val(),
                address = $("input[name=address]").val(),
                date = $("input[name=date]").val(),
                time = $("input[name=time]:checked").val(),
                img = $("#img-pro").attr("src"),
                license = $("input[name=license]:checked").val();


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
            $("#end-date").text(date);
            if (time == 1) {
                $("#end-time1").text("Buổi Sáng");
                $("#end-time2").text("08:00 AM - 11:00 AM");
            } else {
                $("#end-time1").text("Buổi Chiều");
                $("#end-time2").text("01:00 PM - 09:00 PM");
            }
            console.log(license);
            if (license == 1) {
                $("#end-license").text("Đã có bằng lái rồi");
            } else {
                $("#end-license").text("Chưa có bằng lái");
            }
            $("#end-dealer-name").text(filter_dealer.address_name);
            $("#end-dealer-address").text(filter_dealer.address);

            $("#staticBackdrop").modal('show');
        });

        $(document).on('click', "#booking-bike", function(e) {
            e.preventDefault();
            var name = $("input[name=name]").val(),
                phone = $("input[name=phone]").val(),
                email = $("input[name=email]").val(),
                address = $("input[name=address]").val(),
                date = $("input[name=date]").val(),
                license = $("input[name=license]:checked").val();

            data = {
                type: filter_type,
                model: filter_bike,
                name: name,
                phone: phone,
                email: email,
                address: address,
                date: date,
                dealer: filter_dealer,
                license: license,
            }

            // console.log(data);

            $.ajax({
                url: ajaxurl, // AJAX handler
                data: {
                    'action': 'form_test_drive',
                    'order': data,
                },
                type: 'POST',
                success: function(data) {

                    window.location.href = '<?php the_permalink(510); ?>?title=Đăng kí lái thử thành công&message=Cám ơn bạn đã đăng kí, nhân viên chăm sóc khách hàng sẽ liên hệ với bạn trong thời gian sớm nhất';
                }
            })
        })

        $('.filter-location').on('hidden.bs.dropdown', function() {
            $(".field-search").val("");
            $(".filter-location .dropdown-menu .dropdown-item").remove();
            $(".filter-location .dropdown-menu .dropdown-search").after(dropdown);
        })

        $(document).on("keypress", ".field-search", delay(function(e) {
            e.preventDefault();
            var that = $(this);
            var val = that.val();
            console.log(val);

            if (val.length > 0) {
                $.ajax({
                    url: ajaxurl, // AJAX handler
                    data: {
                        'action': 'search_location',
                        'f': val,
                    },
                    type: 'POST',
                    beforeSend: function(xhr) {

                    },
                    success: function(data) {
                        if (data) {
                            $(".filter-location .dropdown-menu .dropdown-item").remove();
                            $(".filter-location .dropdown-menu .dropdown-search").after(data);
                        }
                    }
                })

            }

        }));

    });
</script>


<?php
get_footer();
?>