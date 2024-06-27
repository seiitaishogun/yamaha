<?php include "includes/header.php" ?>

<div class="banner-single-full bg" style="background-image: url('./img/search/img-banner-search.jpg')">
    <div class="container-fluid">
        <div class="content-banner">
           <div class="form-search">
               <a href="#" class="button-search"><img src="./img/search/icon-search.svg" alt="icon"></a>
               <input type="text" class="form-control" value="Men collection">
               <a href="#" class="button-close"><img src="./img/search/icon-close.svg" alt="icon"></a>
           </div>
        </div>
    </div>
</div>

<div class="search-tabs">
    <div class="container-fluid">
        <ul class="tabs-nav">
            <li><a href="#bike">BIKES (4)</a></li>
            <li><a href="#apparel" class="active">APPARELS (20)</a></li>
            <li><a href="#news">NEWS (4)</a></li>
        </ul>
        <div class="tabs-content">
            <div class="tab-item" id="bike">
                <div class="product-list">
                    <?php for ($i = 0; $i < 4; $i++) : ?>
                        <div class="product-item item-25">
                            <a href="product.php" class="stretched-link"></a>
                            <div class="product__image">
                                <img src="./img/moto.png" alt="">
                            </div>
                            <div class="product__content">
                                <div class="title">MT-15</div>
                                <div class="text colorLGray">From <span class="fz20">69.000.000₫</span></div>
                            </div>
                        </div>
                    <?php endfor ?>
                </div>
            </div>
            <div class="tab-item show" id="apparel">
                <div class="product-list">
                    <?php
                    for ($i = 1; $i <= 20; $i++) :
                        $classSale = '';
                        if($i % 4 == 0)
                            $classSale = ' sale';
                        ?>

                        <a class="product-item<?php echo $classSale; ?>" href="apparel-detail.php">
                            <img src="./img/apparel/product-<?php echo sprintf('%02d', $i); ?>.jpg" alt="" />
                            <div class="product-item__title">Yamaha Paddock Factory Racing Monster Polo</div>
                            <div class="product-item__price">450.000đ</div>
                        </a>
                    <?php endfor ?>
                </div>
                <div class="loader"></div>
                <div class="text-center">
                    <a href="javascript: void(0);" onclick="loadMore()" class="btn-clip btn-border-red">
                        LOAD MORE
                    </a>
                </div>
            </div>
            <div class="tab-item" id="news">
                <div class="product-list">
                    <?php for ($i = 0; $i < 4; $i++) : ?>
                        <div class="product-item item-25 pd-16">
                            <a href="#" class="stretched-link"></a>
                            <div class="product__image">
                                <img src="./img/news/img-news-right-1.jpg" alt="">
                            </div>
                            <div class="product__content">
                                <div class="sub-title colorLGray">ACTIVITIES <strong>•</strong> <span>Jul 19</span></div>
                                <div class="title">New R7: Next generation Supersport from Yamaha</div>
                            </div>
                        </div>
                    <?php endfor ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $(".h-box.gradient").css({background: '#1D1F21'});

        $('.search-tabs .tabs-nav a').click(function () {
            $('.search-tabs .tabs-nav a').removeClass('active');
            $(this).addClass('active');
            $('.search-tabs .tab-item').removeClass('show');

            var activeTab = $(this).attr('href');
            $(activeTab).addClass('show');

            return false;
        });
    });
    
    function createProduct() {
        let num = Math.floor(Math.random() * 10) + 10
        let html = '<img src="./img/apparel/product-' + num + '.jpg" alt="" /><div class="product-item__title">Yamaha Paddock Factory Racing Monster Polo</div><div class="product-item__price">450.000đ</div>'
        let a = document.createElement('a')
        a.classList.add("product-item")
        a.href = "#"
        a.innerHTML = html

        return a
    }

    function loadMore() {
        const loader = document.querySelector(".loader")
        const quantity = 10

        if(loader.classList.contains("show"))
            return

        loader.classList.add("show")

        setTimeout(() => {
            for (let index = 0; index < 10; index++) {
                document.querySelector("#apparel .product-list").append(createProduct())
            }

            loader.classList.remove("show")
        }, 1000);
    }
</script>

<?php include "includes/footer.php" ?>