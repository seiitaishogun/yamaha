<?php
get_header();
$page_id = get_queried_object_id();

?>

<div class="banner-single-full bg" style="background-image: url('<?php echo get_template_directory_uri() ?>/img/search/img-banner-search.jpg')">
    <div class="container-fluid">
        <div class="content-banner">
            <div class="form-search">
                <a href="javascript: void(0)" class="button-search"><img src="<?php echo get_template_directory_uri() ?>/img/search/icon-search.svg" alt="icon"></a>
                <input type="text" class="form-control" name="finder" placeholder="Bạn cần tìm gì ?" value="">
                <a href="javascript: void(0)" class="button-close"><img src="<?php echo get_template_directory_uri() ?>/img/search/icon-close.svg" alt="icon"></a>
            </div>
        </div>
    </div>
</div>

<div class="search-tabs">
    <div class="container-fluid">
        <ul class="tabs-nav">
            <li><a href="#bike" class="active" id="bikes-num">MÔ TÔ <span class="num"></span></a></li>
            <li><a href="#apparel" id="apparels-num">TRANG PHỤC <span class="num"></span></a></li>
            <li><a href="#news" id="news-num">TIN TỨC <span class="num"></span></a></li>
        </ul>
        <div class="tabs-content">
            <div class="tab-item show" id="bike">
                <div class="product-list">
                    <div style="height: 200px; width: 100%; display: flex; justify-content: center; align-items: center;color: var(--l-gray);font-size: 18px;" class="nothing">Không có dữ liệu</div>
                </div>
            </div>
            <div class="tab-item" id="apparel">
                <div class="product-list">
                    <div style="height: 200px; width: 100%; display: flex; justify-content: center; align-items: center;color: var(--l-gray);font-size: 18px;" class="nothing">Không có dữ liệu</div>
                </div>
                <div class="text-center">
                    <a href="javascript: void(0);" id="loadmore" style="display: none;" class="btn-clip btn-border-red">
                        XEM THÊM
                    </a>
                </div>
            </div>
            <div class="tab-item" id="news">
                <div class="product-list">
                    <div style="height: 200px; width: 100%; display: flex; justify-content: center; align-items: center;color: var(--l-gray);font-size: 18px;" class="nothing">Không có dữ liệu</div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var paged = 0;
    $(document).ready(function() {

        $('.search-tabs .tabs-nav a').click(function() {
            $('.search-tabs .tabs-nav a').removeClass('active');
            $(this).addClass('active');
            $('.search-tabs .tab-item').removeClass('show');

            var activeTab = $(this).attr('href');
            $(activeTab).addClass('show');

            return false;
        });

        $(document).on('click', '.button-close', function() {
            var that = $(this);

            $("input[name=finder]").val('');
        });

        $(document).on('click', '.button-search', function() {
            var search = $("input[name=finder]").val();

            $.ajax({
                url: ajaxurl, // AJAX handler
                data: {
                    'action': 'find',
                    'f': search,
                },
                type: 'POST',
                beforeSend: function(xhr) {
                    $("#bikes-num .num, #apparels-num .num, #news-num .num").text("");
                    $("#bike .nothing, #apparel .nothing, #news .nothing").show();
                    $("#bike .product-list .product-item, #apparel .product-list .product-item, #news .product-item").remove();
                },
                success: function(data) {
                    var parseData = $.parseJSON(data);

                    if (data) {
                        if (parseData[0].length > 0) {
                            $("#bike .nothing").hide();
                            $("#bikes-num .num").text("(" + parseData[0].length + ")");
                            $("#bike .product-list").append(parseData[0].data);
                        }
                        if (parseData[1].length > 0) {
                            $("#apparel .nothing").hide();
                            $("#apparels-num .num").text("(" + parseData[1].length + ")");
                            $("#apparel .product-list").append(parseData[1].data);
                            $("#loadmore").show();
                            paged++;
                        }
                        if (parseData[2].length > 0) {
                            $("#news .nothing").hide();
                            $("#news-num .num").text("(" + parseData[2].length + ")");
                            $("#news .product-list").append(parseData[2].data);
                        }
                    }
                    $("input[name=finder]").blur();
                }
            })
        });
    });

    $(document).on('keyup', 'input[name=finder]', function(e) {
        var search = $(this).val();


        var code = e.key; // recommended to use e.key, it's normalized across devices and languages
        if (code === "Enter" || e.keyCode === 13) {
            $.ajax({
                url: ajaxurl, // AJAX handler
                data: {
                    'action': 'find',
                    'f': search,
                },
                type: 'POST',
                beforeSend: function(xhr) {
                    $("#bikes-num .num, #apparels-num .num, #news-num .num").text("");
                    $("#bike .nothing, #apparel .nothing, #news .nothing").show();
                    $("#bike .product-list .product-item, #apparel .product-list .product-item, #news .product-item").remove();
                },
                success: function(data) {
                    var parseData = $.parseJSON(data);

                    if (data) {
                        if (parseData[0].length > 0) {
                            $("#bike .nothing").hide();
                            $("#bikes-num .num").text("(" + parseData[0].length + ")");
                            $("#bike .product-list").append(parseData[0].data);
                        }
                        if (parseData[1].length > 0) {
                            $("#apparel .nothing").hide();
                            $("#apparels-num .num").text("(" + parseData[1].length + ")");
                            $("#apparel .product-list").append(parseData[1].data);
                            $("#loadmore").show();
                            paged++;
                        }
                        if (parseData[2].length > 0) {
                            $("#news .nothing").hide();
                            $("#news-num .num").text("(" + parseData[2].length + ")");
                            $("#news .product-list").append(parseData[2].data);
                        }
                    }
                }
            })
        }


    });

    $(document).on("click", "#loadmore", function() {
        paged++;

        let load_more = paged * 10;
        let len = $("#apparel .product-item").length;

        $("#apparel .product-item").each(function(i, v) {
            if (i < load_more) {   
                $(this).removeClass("hide");
            }
        });

        if (load_more > len) {
            $("#loadmore").hide();
        }
        
        console.log(len);
    });

    // function createProduct() {
    //     let num = Math.floor(Math.random() * 10) + 10
    //     let html = '<img src="./img/apparel/product-' + num + '.jpg" alt="" /><div class="product-item__title">Yamaha Paddock Factory Racing Monster Polo</div><div class="product-item__price">450.000đ</div>'
    //     let a = document.createElement('a')
    //     a.classList.add("product-item")
    //     a.href = "#"
    //     a.innerHTML = html

    //     return a
    // }

    // function loadMore() {
    //     const loader = document.querySelector(".loader")
    //     const quantity = 10

    //     if (loader.classList.contains("show"))
    //         return

    //     loader.classList.add("show")

    //     setTimeout(() => {
    //         for (let index = 0; index < 10; index++) {
    //             document.querySelector("#apparel .product-list").append(createProduct())
    //         }

    //         loader.classList.remove("show")
    //     }, 1000);
    // }
</script>


<?php
get_footer();
?>