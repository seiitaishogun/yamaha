<?php
get_header();
$page_id = get_queried_object_id();

if (isset($_GET['post_id'])) {
    $post_id = $_GET['post_id'];
}

if (isset($_GET['size'])) {
    $size = $_GET['size'];
}

if (isset($_GET['color'])) {
    $color = $_GET['color'];
}

if (isset($_GET['quantity'])) {
    $quantity = $_GET['quantity'];
}
if (isset($_GET['img'])) {
    $image = $_GET['img'];
}


?>

<style type="text/css">
    @import url(https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css);
</style>

<script type="text/javascript">
    window.location.href = '<?php echo get_site_url()?>/apparels/';
</script>

<?php
echo get_template_part('includes/header/header-no-toolbar', 'headline', array(
    'title' => 'MUA TRANG PHỤC',
));
?>

<section class="buy-apparel">
    <div class="buy-apparel__wrapper mt-0">
        <div style="height: 16px;"></div>
        <div class="product-summary">
            <div class="product-summary__img">
                <?php //$items = get_field("list_image", $post_id); ?>
                <img src="<?php echo $image; ?>" alt="" id="img-pro" />
            </div>
            <div class="product-summary__content d-md-flex">
                <div class="product-summary__name">
                    <h5 id="title"><?php echo get_the_title($post_id); ?></h5>
                    <div class="d-flex align-items-center list-option">
                        <div class="p-size">
                            <span id="size">Kích thước</span>
                            <div class="dropdown">
                                <a href="javascript:void(0)" class="" id="dropdownMenuOffset" aria-haspopup="true" aria-expanded="false">
                                    <?php echo $size; ?>
                                </a>
                                <?php $sizes = get_field('size', $post_id); ?>
                                <div class="dropdown-menu dropdown-red" aria-labelledby="dropdownMenuOffset">
                                    <?php
                                    if ($sizes) :
                                        foreach ($sizes as $k => $size) :
                                    ?>
                                            <a class="dropdown-item" href="javascript:void(0)"><?php echo $size; ?></a>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="p-color">
                            <span>Màu sắc</span>
                            <span class="color" id="color" data-color="<?php echo  $color; ?>" style="background: <?php echo "#" . $color; ?>;"></span>
                        </div>
                    </div>
                </div>
                <div class="product-summary__price">
                    <?php $price = get_field('price', $post_id); ?>
                    <div class="input-group number-comp" data-price="<?php echo $price; ?>">
                        <div class="input-group-prepend">
                            <button class="btn btn-minus" type="button">-</button>
                        </div>
                        <input type="number" readonly style="background-color: transparent;" value="<?php echo  $quantity; ?>" maxlength="2" size="2" name="quantity" class="form-control" placeholder="" aria-label="" aria-describedby="basic-addon1">
                        <div class="input-group-append">
                            <button class="btn btn-plus" type="button">+</button>
                        </div>
                    </div>

                    <h5 class="price" id="price"><?php echo currencyFormat($price); ?></h5>
                </div>
            </div>
        </div>
        <form autocomplete="off" class="customer-info form-apparel">
            <h5>THÔNG TIN CỦA BẠN</h5>
            <div class="form-group form-ani">
                <input type="text" style="display:none" />
                <input type="text" name="name" />
                <label for="">Họ và Tên <span>*</span></label>
                <div class="invalid-feedback"></div>
            </div>
            <div class="wrap-form d-flex">
                <div class="form-group form-ani split">
                    <input type="text" style="display:none" />
                    <input type="text" name="phone" />
                    <label for="">Số điện thoại <span>*</span></label>
                    <div class="invalid-feedback"></div>
                </div>
                <div class="form-group form-ani split">
                    <input type="text" style="display:none" />
                    <input type="text" name="email" />
                    <label for="">Email <span>*</span></label>
                    <div class="invalid-feedback"></div>
                </div>
            </div>
            <div class="form-group form-ani">
                <input type="text" style="display:none" />
                <input type="text" name="address" />
                <label for="">Địa chỉ <span>*</span></label>
                <div class="invalid-feedback"></div>
            </div>
            <div class="find-dealer">
                <h5>TÌM ĐẠI LÝ</h5>
                <?php
                $dealers = get_field('dealers', $post_id);

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
                    <button type="button" class="btn btn-dropdown dropdown-dealer dropdown-toggle" id="dropdownDealer" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="dealer-info">
                            <!-- <p class="no-select">DEALER <span>*</span></p> -->
                            <p class="dealer-name">Chọn Đại Lý</p>
                            <p class="dealer-address"></p>
                        </div>
                    </button>
                    <script type="text/javascript">
                        var filter_dealer = {};
                    </script>
                    <div class="dropdown-menu" aria-labelledby="dropdownDealer">
                        <?php foreach ($post_dealers as $e) : ?>
                            <a class="dropdown-item" href="javascript:void(0)" data-name="<?php echo get_the_title($e->ID); ?>" data-address="<?php echo get_field("address", $e->ID); ?>">
                                <div class="dealer-info">
                                    <p class="dealer-name"><?php echo get_the_title($e->ID); ?>
                                        <?php foreach ($dealers as $i) : ?>
                                            <?php
                                            if ($e->ID === $i->ID) {
                                                $check = 1;
                                            }
                                            ?>
                                        <?php endforeach ?>
                                        <?php
                                        if ($check > 0) {
                                            echo '<span class="in-stock">In stock</span>';
                                            $check = 0;
                                        } else {
                                            echo '<span class="pre-order">Pre-order</span>';
                                        }
                                        ?>
                                    </p>
                                    <p class="dealer-address"><?php echo get_field("address", $e->ID); ?>
                                </div>
                            </a>
                        <?php endforeach ?>
                    </div>
                    <div class="invalid-feedback"></div>
                </div>

            </div>
            <div class="form-group text-area">
                <label for="">Nội dung <span class="optional">(Không bắt buộc)</span></label>
                <textarea class="form-control" rows="4" name="message"></textarea>
            </div>
            <div class="footer-form">
                <div></div>
                <button type="submit" class="btn-clip btn-red btn-buy-now" id="submit-view">XEM TRƯỚC VÀ ĐẶT MUA</button>
            </div>
        </form>
    </div>
</section>


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
                <div class="title">SẢN PHẨM</div>
                <div class="product-summary">
                    <div class="product-summary__img">
                        <img src="" alt="" id="end-img" />
                    </div>
                    <div class="product-summary__content">
                        <h5 id="end-title"></h5>
                        <div class="p-size">
                            <span>Kích thước: <strong id="end-size"></strong></span>
                            <span class="slash">|</span>
                            <span>Màu sắc: <strong class="color" id="end-color"></strong></span>
                            <span>Số lượng: <strong id="end-quantity"></strong></span>
                        </div>
                        <div class="price" id="end-price"></div>
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
                            <label>Số điện thoại</label>
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
                    <div class="customer-info">
                        <h5 class="text-uppercase">Nội dung</h5>
                        <div class="info-item">
                            <p class="fz14" id="end-message"></p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="javascript: void(0);" class="btn btn-link btn-link-red" data-dismiss="modal">HUỶ BỎ</a>
                    <a href="javascript: void(0);" class="btn-clip btn-red btn-buy-now" id="buy-now">ĐẶT MUA</a>
                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    $(document).ready(function() {

        $(document).on('submit', ".form-apparel", function(e) {
            e.preventDefault();
            var name = $("input[name=name]").val(),
                phone = $("input[name=phone]").val(),
                email = $("input[name=email]").val(),
                address = $("input[name=address]").val(),
                quantity = $("input[name=quantity]").val(),
                img = $("#img-pro").attr("src"),
                message = $("textarea[name=message]").val(),
                title = $("#title").text(),
                size = $("#dropdownMenuOffset").text(),
                color = $("#color").attr("data-color"),
                price = $("#price").text();


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
            $("#end-title").text(title);
            $("#end-size").text(size);
            $("#end-color").css("background-color", "#" + color);
            $("#end-price").text(price);
            $("#end-quantity").text(quantity);
            $("#end-name").text(name);
            $("#end-phone").text(phone);
            $("#end-email").text(email);
            $("#end-address").text(address);
            $("#end-dealer-name").text(filter_dealer.address_name);
            $("#end-dealer-address").text(filter_dealer.address);
            $("#end-message").text(message);


            $("#staticBackdrop").modal('show');
        });

        $(document).on("click", "#buy-now", function() {
            var name = $("input[name=name]").val(),
                phone = $("input[name=phone]").val(),
                email = $("input[name=email]").val(),
                address = $("input[name=address]").val(),
                quantity = $("input[name=quantity]").val(),
                img = $("#img-pro").attr("src"),
                message = $("textarea[name=message]").val(),
                title = $("#title").text(),
                size = $.trim($("#dropdownMenuOffset").text()),
                color = $("#color").attr("data-color"),
                price = $("#price").text();

            data = {
                name: name,
                phone: phone,
                email: email,
                address: address,
                dealer: filter_dealer,
                message: message,
                title: title,
                size: size,
                color: color,
                price: price,
                quantity: quantity,
            }


            $.ajax({
                url: ajaxurl, // AJAX handler
                data: {
                    'action': 'form_apparel',
                    'order': data,
                },
                type: 'POST',
                success: function(data) {

                    window.location.href = '<?php the_permalink(510); ?>';
                }
            })
        })

        $(document).on('click', '.filter-dealer .dropdown-item', function() {
            var that = $(this);
            var text = that.text();
            var name = that.attr('data-name');
            var address = that.attr('data-address');

            filter_dealer = {
                address_name: name,
                address: address,
            };

        });
    })

    let formInputList = document.querySelectorAll(".form-group input");
    formInputList.forEach(input => {
        input.addEventListener("change", function() {
            console.log('ss')
            let parentNode = this.parentElement;
            if (this.value.length > 0) {
                parentNode.classList.add("not-empty");
            } else {
                parentNode.classList.remove("not-empty");
            }
        });
    })


    //---------------
    let dropdownList = document.querySelectorAll(".dropdown");
    dropdownList.forEach(d => {
        let dropdownItems = d.querySelectorAll(".dropdown-item")

        dropdownItems.forEach(item => {
            item.addEventListener("click", function(e) {
                e.preventDefault()

                console.info(item, item.childNodes)

                d.querySelector(".btn-dropdown").innerHTML = item.innerHTML
            })
        })
    })


    //---------------
    let inputNumber = document.querySelectorAll('.number-comp')

    function updatePrice(elem, amount) {
        let price = elem.dataset.price ? elem.dataset.price : 0
        let strPrice = new Intl.NumberFormat().format(price * amount)

        let formatPrice = strPrice.replaceAll(",", ".");

        elem.parentElement.querySelector(".price").innerHTML = formatPrice + "đ"
    }

    inputNumber.forEach(elem => {
        let inputNum = elem.querySelector("input")
        elem.querySelector(".btn-minus").addEventListener("click", () => {
            if (inputNum.value - 1 > 0) {
                inputNum.value = parseInt(inputNum.value) - 1
            } else {
                inputNum.value = 1
            }

            updatePrice(elem, parseInt(inputNum.value))
        })
        elem.querySelector(".btn-plus").addEventListener("click", () => {
            inputNum.value = parseInt(inputNum.value) + 1

            updatePrice(elem, parseInt(inputNum.value))
        })
    })
</script>

<?php
get_footer();
?>