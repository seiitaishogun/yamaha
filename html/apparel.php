<?php include "includes/header.php" ?>
<section class="banner slider banner-full">
    <div class="navigator__breadcrumbs">
        <div class="container-fluid">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">APPAREL</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="swiper-container-fluid mySwiper">
        <div class="swiper-wrapper">
            <div class="swiper-slide active">
                <picture>
                    <source media="(min-width:768px)" srcset="./img/apparel/slider.jpg">
                    <img src="./img/apparel/slider_sp.jpg" alt="" class="d-block w-100" />
                </picture>
                <div class="carousel-caption">
                    <h5>APPAREL</h5>
                    <h3>WOMEN’S VESTS AND JACKETS</h3>
                    <button type="button" class="btn-clip btn-border-white w-auto">EXPLORE MORE</button>
                </div>
            </div>
            <div class="swiper-slide">
                <picture>
                    <source media="(min-width:768px)" srcset="./img/apparel/slider.jpg">
                    <img src="./img/apparel/slider_sp.jpg" alt="" class="d-block w-100" />
                </picture>
                <div class="carousel-caption">
                    <h5>APPAREL</h5>
                    <h3>WOMEN’S VESTS AND JACKETS</h3>
                    <button type="button" class="btn-clip btn-border-white">EXPLORE MORE</button>
                </div>
            </div>
        </div>
        <div class="swiper-pagination"></div>
    </div>
</section>


<section class="categories-block">
    <div class="container-fluid">
        <div class="categories-block__title">
            <h3>CATEGORIES</h3>
            <div class="swiper-navi">
                <div class="swiper-button-prev swiper-button-prev--custom"><img src="img/ic_long-left.svg" alt=""></div>
                <div class="swiper-button-next swiper-button-next--custom"><img src="img/ic_long-right.svg" alt=""></div>
            </div>
        </div>
        <div class="categories-list d-none d-md-block">
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    <?php
                    $cats = [
                        'SWEATERS (10)',
                        'T-SHIRT (16)',
                        'PROTECTION INLAYS (4)',
                        'JACKETS (8)',
                        'RIDING GEAR (6)',
                        'VEST (4)',
                    ];
                    for ($i = 1; $i <= 6; $i++) :
                        ?>
                        <a href="#" class="categories-item swiper-slide">
                            <img src="./img/apparel/cat-<?php echo sprintf('%02d', $i); ?>.png" alt="" />
                            <div class="categories-item__title"><?php echo $cats[$i - 1] ?></div>
                        </a>

                    <?php endfor; ?>
                    <a href="#" class="categories-item swiper-slide">
                        <img src="./img/apparel/cat-01.png" alt="" />
                        <div class="categories-item__title">SWEATERS (10)</div>
                    </a>
                </div>
            </div>
        </div>
        <div class="categories-list d-md-none">
            <?php
            $cats = [
                'SWEATERS (10)',
                'T-SHIRT (16)',
                'PROTECTION INLAYS (4)',
                'JACKETS (8)',
                'RIDING GEAR (6)',
                'VEST (4)',
            ];
            for ($i = 1; $i <= 6; $i++) :
                ?>
                <a href="#" class="categories-item swiper-slide">
                    <img src="./img/apparel/cat-<?php echo sprintf('%02d', $i); ?>.png" alt="" />
                    <div class="categories-item__title"><?php echo $cats[$i - 1] ?></div>
                </a>

            <?php endfor; ?>
        </div>
        <div class="view-more d-block d-md-none">
            <button type="button" onclick="showCat()" class="btn-clip btn-red w-auto btn-viewall">VIEW ALL</button>
        </div>
    </div>
</section>




<section class="hot-items">
    <div class="container-fluid px-md-0">
        <div class="hot-items__title">
            <h3>HOT ITEMS</h3>
            <div class="dropdown">
                <button type="button" class="btn btn-filter dropdown-toggle" id="dropdownMenuOffset" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Price: Low to High
                </button>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuOffset">
                    <a class="dropdown-item" href="#">Price: Low to High</a>
                    <a class="dropdown-item" href="#">Price: High to Low</a>
                    <a class="dropdown-item" href="#">Hot items (Pick from CMS)</a>
                    <a class="dropdown-item" href="#">All Categories</a>
                </div>
            </div>
        </div>
        <div class="product-list">
            <?php
            for ($i = 1; $i <= 25; $i++) :
                $classSale = '';
                if ($i % 4 == 0)
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
            <a href="javascript: void(0);" onclick="loadMore()" id="loadmore" class="btn-clip btn-border-red w-auto">LOAD more</a>
        </div>

    </div>
</section>

<script src="./js/vendor/swiper-bundle.min.js"></script>

<script>
    $(".h-box.gradient").css({
        background: '#1D1F21'
    });

    var swiper = new Swiper(".mySwiper", {
        // Disable preloading of all images
        preloadImages: false,
        // Enable lazy loading
        lazy: true,
        loop: true,
        effect: 'fade',
        autoplay: {
            delay: 5000,
        },
        fadeEffect: {
            crossFade: true
        },
        navigation: {
            nextEl: '.mySwiper .swiper-button-next',
            prevEl: '.mySwiper .swiper-button-prev',
        },
        pagination: {
            el: '.mySwiper .swiper-pagination',
            type: 'bullets',
            clickable: true,
            renderBullet: function(index, className) {
                return '<span class="' + className + '"><span class="halfclip"><span class="halfcircle clipped"></span></span><span class="halfcircle fixed"></span></span>';
            },
        },
    });

    var swiperCat = new Swiper('.categories-list .swiper-container', {
        slidesPerView: 6,
        spaceBetween: 8,
        navigation: {
            nextEl: '.swiper-navi .swiper-button-next',
            prevEl: '.swiper-navi .swiper-button-prev',
        }
    });

    function showCat() {
        $('.btn-viewall').remove();
        document.querySelectorAll(".categories-item").forEach(elem => {
            elem.classList.remove("hidden")
        })
    }

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

        if (loader.classList.contains("show"))
            return

        loader.classList.add("show")

        setTimeout(() => {
            for (let index = 0; index < quantity; index++) {
                document.querySelector(".product-list").append(createProduct())
            }

            loader.classList.remove("show")
        }, 1000);
    }
</script>

<?php include "includes/footer.php" ?>