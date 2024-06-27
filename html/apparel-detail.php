<?php include "includes/header.php" ?>

<div class="navigator__breadcrumbs">
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="/apparel.php">APPAREL</a></li>
                <li class="breadcrumb-item active" aria-current="page">SWEATERS</li>
            </ol>
        </nav>
    </div>
</div>


<section class="apparel-detail">
    <div class="main-detail">
        <div class="main-detail__pics">
            <div class="main-pic">
                <img class="img-zoom" src="./img/apparel-detail/img-small-01.jpg"
                     data-zoom-image="./img/apparel-detail/img-large-01.jpg"  />
            </div>

            <div class="thumb-pics" id="gallery_01">
                <a  href="#" class="thumb-gallery active" data-update="" data-image="./img/apparel-detail/img-small-01.jpg"
                    data-zoom-image="./img/apparel-detail/img-large-01.jpg">
                    <img src="./img/apparel-detail/img-small-01.jpg" class="img-fluid"/></a>

                <a  href="#" class="thumb-gallery" data-update="" data-image="./img/apparel-detail/img-small-02.jpg"
                    data-zoom-image="./img/apparel-detail/img-large-02.jpg">
                    <img src="./img/apparel-detail/img-small-02.jpg" class="img-fluid"/></a>
                <a  href="#" class="thumb-gallery" data-update="" data-image="./img/apparel-detail/img-small-03.jpg"
                    data-zoom-image="./img/apparel-detail/img-large-03.jpg">
                    <img src="./img/apparel-detail/img-small-03.jpg" class="img-fluid"/></a>
                <a  href="#" class="thumb-gallery" data-update="" data-image="./img/apparel-detail/img-small-04.jpg"
                    data-zoom-image="./img/apparel-detail/img-large-04.jpg">
                    <img src="./img/apparel-detail/img-small-04.jpg" class="img-fluid"/></a>
            </div>
        </div>
        <div class="main-detail__content">
            <h5 class="p-detail-cat">SWEATERS</h5>
            <h3 class="p-detail-name">YAMAHA PADDOCK FACTORY RACING MONTER POLO</h3>
            <div class="p-detail-price">450.000đ</div>
            <div class="p-detail-color">
                <span>Color</span>
                <div class="color-list">
                    <a class="color-red active" href="javascript:void(0)" data-color="red"></a>
                    <a class="color-purple" href="javascript:void(0)" data-color="purple"></a>
                    <a class="color-black" href="javascript:void(0)" data-color="black"></a>
                    <a class="color-blue" href="javascript:void(0)" data-color="blue"></a>
                </div>
            </div>
            <div class="p-detail-size">
                <span>Size</span>
                <div class="dropdown">
                    <button type="button" class="btn btn-dropdown dropdown-toggle" id="dropdownMenuOffset" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        XL
                    </button>
                    <div class="dropdown-menu dropdown-red" aria-labelledby="dropdownMenuOffset">
                        <a class="dropdown-item" href="#">S</a>
                        <a class="dropdown-item" href="#">M</a>
                        <a class="dropdown-item" href="#">L</a>
                        <a class="dropdown-item" href="#">XL</a>
                    </div>
                </div>
            </div>
    
            <a href="buy-apparel-a.php" class="btn-clip btn-red">Book Now</a>
        </div>
    </div>
    <div class="main-info">
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-link active" id="nav-description-tab" data-toggle="tab" href="#nav-description" role="tab" aria-controls="nav-description" aria-selected="true">Description</a>
                <a class="nav-link" id="nav-size-guide-tab" data-toggle="tab" href="#nav-size-guide" role="tab" aria-controls="nav-size-guide" aria-selected="false">Size guide</a>
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-description" role="tabpanel" aria-labelledby="nav-description-tab">
                <p>Inspired by our racing professionals, but designed for you. The Paddock Blue collection was created to be worn from the race track to the city. You can choose from the Racing line, worn by our race teams, and the Casual line bringing the Yamaha racing spirit to your day to day life.</p>
                <ul>
                    <li>100% cotton t-shirt</li>
                    <li>Comfortable fit</li>
                    <li>Available in black,red and blue</li>
                </ul>
            </div>
            <div class="tab-pane fade" id="nav-size-guide" role="tabpanel" aria-labelledby="nav-size-guide-tab">
                Size guide
            </div>
        </div>
    </div>
</section>


<section class="hot-items bg-gray">
    <div class="container-fluid">
        <div class="hot-items__title">
            <h3>RECENTLY VIEWED</h3>
            <div class="swiper-navi">
                <div class="swiper-button-prev swiper-button-prev--custom"><img src="img/ic_long-left.svg" alt=""></div>
                <div class="swiper-button-next swiper-button-next--custom"><img src="img/ic_long-right.svg" alt=""></div>
            </div>
        </div>
        <div class="product-list slider-recently">
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    <?php
                    for ($i = 1; $i <= 6; $i++) :
                        $classSale = '';
                        if ($i % 4 == 0)
                            $classSale = ' sale';
                    ?>

                        <a class="swiper-slide product-item <?php echo $classSale; ?>" href="apparel-detail.php">
                            <img src="./img/apparel/product-<?php echo sprintf('%02d', $i); ?>.jpg" alt="" />
                            <div class="product-item__title">Yamaha Paddock Factory Racing Monster Polo</div>
                            <div class="product-item__price">450.000đ</div>
                        </a>
                    <?php endfor ?>
                </div>
            </div>
        </div>
        <div class="loader"></div>

    </div>
</section>

<script>
    $(".h-box.gradient").css({
        background: 'black'
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
        const quantity = 5

        if (loader.classList.contains("show"))
            return

        loader.classList.add("show")

        setTimeout(() => {
            for (let index = 0; index < quantity; index++) {
                document.querySelector(".product-list").append(createProduct())
            }

            loader.classList.remove("show")
        }, 500);
    }

    let currentColor = "red"

    function zoomGallery() {
        if ($(window).width() > 1023) {
            $(".main-pic .img-zoom").elevateZoom({
                gallery:'gallery_01',
                cursor: 'pointer',
                easing : true,
                galleryActiveClass: 'active',
                imageCrossfade: true,
                //zoomType:"inner",
                loadingIcon: 'https://www.elevateweb.co.uk/spinner.gif',
            });
        }
    }

    var swiper;

    $("document").ready(function() {
        swiper = new Swiper(".mySwiper", {
            slidesPerView: 4,
            spaceBetween: 8,
            centeredSlides: false,
            slidesPerGroupSkip: 1,
            grabCursor: true,
            keyboard: {
                enabled: true,
            },
        });

        var swiperR = new Swiper('.slider-recently .swiper-container', {
            slidesPerView: 1,
            spaceBetween: 0,
            allowTouchMove: true,
            navigation: {
                nextEl: '.swiper-navi .swiper-button-next',
                prevEl: '.swiper-navi .swiper-button-prev',
            },
            breakpoints: {
                // when window width is >= 640px
                768: {
                    slidesPerView: 5,
                    // allowTouchMove: false,
                    // centeredSlides: false,
                    // loop: false,
                }
            }
        });

        zoomGallery();
    })

    
</script>

<?php include "includes/footer.php" ?>