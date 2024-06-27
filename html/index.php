<?php include "includes/header.php" ?>

<div class="banner banner__swiper banner-full">
    <!-- Slider main container -->
    <div class="swiper-container">
        <div class="swiper-wrapper">
            <!-- Additional required wrapper -->

            <?php for ($i = 0; $i < 3; $i++) : ?>
                <div data-background="./img/home.png" class="swiper-slide swiper-lazy">
                    <div class="container-fluid">
                        <div class="swiper-content">
                            <div class="fz16">HYER NAKED</div>
                            <h1 class="exbold ff-1">MT-09 REVOLUTION OF THE ICON</h1>
                            <div style="height: 24px;"></div>
                            <a href="product.php" class="btn-clip btn-border-white">EXPLORE MORE</a>
                        </div>
                    </div>
                    <div class="swiper-lazy-preloader"></div>
                </div>
            <?php endfor ?>

        </div>
        <!-- If we need pagination -->
        <div class="swiper-pagi-wrapper">
            <div class="swiper-pagination swiper-pagination--custom"></div>

        </div>

        <!-- If we need navigation buttons -->
        <div class="swiper-button-prev swiper-button-prev--custom"><img src="img/ic_long-left.svg" alt=""></div>
        <div class="swiper-button-next swiper-button-next--custom"><img src="img/ic_long-right.svg" alt=""></div>
    </div>
</div>
<div class="bgGray">
    <div class="container-fluid">
        <div class="featured">
            <div style="height: 32px;" class="d-lg-block d-xl-block d-none"></div>
            <div style="height: 40px;" class="d-block d-lg-none d-xl-none"></div>
            <h2 class="ff-1 colorDark text-uppercase text-center">FEATURED PRODUCT</h2>

            <div class="swiper-container">
                <div class="swiper-wrapper">
                    <?php for ($i = 0; $i < 3; $i++) : ?>
                        <div class="swiper-slide text-center">
                            <div class="featured__img">
                                <a href="product.php">
                                <img src="./img/home/img-fetured-<?php echo $i + 1 ?>.png" alt="">
                                </a>
                            </div>
                            <h3 class="ff-1 colorGray"><a href="product.php">2021 MT-09</a></h3>
                            <p class="colorGray"><span class="colorLGray">Starting at</span> <span class="fz20">306.000.000₫</span></p>
                        </div>
                    <?php endfor; ?>
                </div>
            </div>
            <div style="height: 40px;" class="d-lg-block d-xl-block d-none"></div>
            <div style="height: 20px;" class="d-block d-lg-none d-xl-none"></div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div style="height: 32px;" class="d-lg-block d-xl-block d-none"></div>
    <div style="height: 40px;" class="d-block d-lg-none d-xl-none"></div>

    <div class="d-flex justify-content-lg-between justify-content-center align-items-center">
        <h2 class="ff-1 colorDark text-uppercase">LATEST NEWS</h2>
        <a href="news.php" class="colorRed text-uppercase bold d-xl-flex d-lg-flex align-items-center d-none ">VIEW ALL NEWS <span style="width: 14px"></span> <i class="ico__chev-right"></i></a>
    </div>

    <div style="height: 24px;"></div>

    <div class="row sm-gutters">
        <?php for ($i = 0; $i < 3; $i++) : ?>
            <div class="col-lg-4 col-12">
                <div class="article <?php echo $i > 0 ? "article--hoz" : "" ?>">
                    <div class="article__img">
                        <a href="news-detail.php">
                        <img src="./img/home/img-news-<?php echo $i + 1 ?>.png" alt="" class="">
                        </a>
                    </div>
                    <div class="article__body">
                        <label for="" class="fz14 bold mb-0 text-uppercase colorLGray d-lg-block d-xl-block d-flex justify-content-between">PROMOTION <span class="fz12 colorLGray d-block d-lg-none d-xl-none">JUN 8, 2021</span></label>
                        <div style="height: 16px;"></div>
                        <div class="article__title text-break"><a href="news-detail.php">Monster Energy Yamaha Factory Racing’s Justin Barcia Battles to a Top-Five Finish at the 2018 Top-Five Finish at the 2018 </a></div>
                        <div style="height: 24px;" class="d-lg-block d-xl-block d-none"></div>
                        <p class="fz12 colorLGray d-lg-block d-xl-block d-none">JUN 8, 2021</p>
                        <div class="line"></div>
                    </div>
                </div>
            </div>
        <?php endfor; ?>
    </div>

    <a href="news.php" class="colorRed text-uppercase bold d-flex justify-content-center align-items-center d-lg-none d-xl-none mt-4">VIEW ALL NEWS <span style="width: 14px"></span> <i class="ico__chev-right"></i></a>

    <div class="divider d-lg-none d-xl-none d-block mt-4"></div>

    <div style="height: 32px;" class="d-lg-block d-xl-block d-none"></div>
    <div style="height: 40px;" class="d-block d-lg-none d-xl-none"></div>

    <h2 class="ff-1 colorDark text-uppercase text-center">BIKE CATEGORIES</h2>

    <div style="height: 24px;"></div>

    <div class="row sm-gutters bike-category">
        <div class="col-lg-7 col-md-6 col-6">
            <div class="background-image">
                <img src="./img/home/img-category-1.png" alt="" class="box-img">
                <div class="box-text">
                    <h4 class="colorWhite exbold ff-1"><a href="product-list.php#hyper">HYPER NAKED</a></h4>
                    <div style="height: 8px;"></div>
                    <div class="colorLine fz14">From <span class="fz20">69.000.000₫</span></div>
                </div>
            </div>
        </div>
        <div class="col-lg-5 col-md-6 col-6">
            <div class="background-image">
                <img src="./img/home/img-category-2.png" alt="" class="box-img">
                <div class="box-text">
                    <h4 class="colorWhite exbold ff-1"><a href="product-list.php#super">SUPERSPORT</a></h4>
                    <div style="height: 8px;"></div>
                    <div class="colorLine fz14">From <span class="fz20">70.000.000₫</span></div>
                </div>
            </div>
        </div>
        <?php $arr_id = ["adventure", "scooter", "sport-tour"] ?>
        <?php $arr_cate = ["ADVENTURE TOURING", "SCOOTER", "SPORT TOURING"] ?>
        <?php for ($i = 0; $i < 3; $i++) : ?>
            <div class="col-lg-4 <?php echo $i == 0 ? "col-12" : "col-md-6 col-6" ?>">
                <div class="background-image">
                    <img src="./img/home/img-category-small-<?php echo $i + 1 ?>.png" class="box-img" alt="">
                    <div class="box-text">
                        <h4 class="colorWhite exbold ff-1"><a href="product-list.php#<?php echo $arr_id[$i] ?>"><?php echo $arr_cate[$i] ?></a></h4>
                        <div style="height: 8px;"></div>
                        <div class="colorLine fz14">From <span class="fz20">69.000.000₫</span></div>
                    </div>
                </div>
            </div>
        <?php endfor; ?>
    </div>

    <div style="height: 32px;" class="d-lg-block d-xl-block d-none"></div>
    <div style="height: 40px;" class="d-block d-lg-none d-xl-none"></div>

    <div class="row no-gutters d-md-flex d-lg-flex d-xl-flex d-none">
        <div class="col-lg-5 col-6">
            <div class="background-image background-image--overlay">
                <div class="background-image__blur" style="background-image: url(img/home/apparel.jpg);"></div>
                <div class="background-image__content">
                    <div class="fz16 bold">APPAREL</div>
                    <div style="height: 8px;"></div>
                    <h3 class="colorWhite exbold ff-1">RIDING GEAR</h3>
                    <div style="height: 8px;"></div>
                    <div class="colorLine fz14">Get the latest men's Yamaha t-shirts, jackets and hoodies.</div>
                    <div style="height: 30px;"></div>
                    <a href="apparel.php" class="btn-clip btn-border-white">EXPLORE MORE <span class="ico__chev-right"></span></a>
                </div>
            </div>
        </div>
        <div class="col-lg-7 col-6">
            <div class="background-image background-image__clip" style="background-image: url(img/home/apparel.jpg);"></div>
        </div>
    </div>

    <h2 class="ff-1 colorDark text-uppercase text-center d-block d-lg-none d-md-none d-xl-none">APPAREL</h2>
    <div style="height: 20px;" class="d-block d-lg-none d-md-none d-xl-none"></div>
    <div class="row no-gutters d-flex d-lg-none d-md-none d-xl-none">
        <div class="col-lg-7 col-12">
            <div class="background-image background-image--service" style="background-image: url(./img/home/img-apparel.png);"></div>
        </div>
        <div class="col-lg-5 col-12">
            <div class="service__content">
                <div class="fz16 bold">APPAREL</div>
                <div style="height: 8px;"></div>
                <h3 class="colorWhite exbold ff-1">RIDING GEAR</h3>
                <div style="height: 8px;"></div>
                <p class="mb-0 fz14">Get the latest men's Yamaha t-shirts, jackets and hoodies.</p>
                <div style="height: 24px;"></div>
                <!-- <button type="button" class="btn--full-red btn--mb-b-red text-uppercase">EXPLORE more <span class="ico__chev-right"></span></button> -->

                <a href="apparel.php" class="btn-clip btn-border-red">EXPLORE more <span class="ico__chev-right"></span></a>

            </div>
        </div>
    </div>

    <div style="height: 32px;" class="d-lg-block d-xl-block d-none"></div>
    <div style="height: 40px;" class="d-block d-lg-none d-xl-none"></div>

    <h2 class="ff-1 colorDark text-uppercase text-center d-block d-lg-none d-md-none d-xl-none">YAMAHA SERVICE</h2>
    <div style="height: 20px;" class="d-block d-lg-none d-md-none d-xl-none"></div>
    <div class="row no-gutters">
        <div class="col-lg-7 col-md-7 col-12">
            <div class="background-image background-image--service" style="background-image: url(./img/home/img-protect.png);"></div>
        </div>
        <div class="col-lg-5 col-md-5 col-12">
            <div class="service__content">
                <div class="fz16 bold">YAMAHA SERVICE</div>
                <div style="height: 8px;"></div>
                <h3 class="exbold ff-1">PROTECT YOUR YAMAHA TODAY</h3>
                <div style="height: 8px;"></div>
                <p class="mb-0 fz14">Yamaha Motor Services is a full range of premium services that makes every aspect of buying and owning a Yamaha even easier. We want to ensure that you always have an enjoyable experience whenever you come across a Yamaha product.</p>
                <div style="height: 24px;"></div>
                <a href="service.php" class="btn-clip btn-border-red">EXPLORE more <span class="ico__chev-right"></span></a>
            </div>
        </div>
    </div>

    <div style="height: 32px;" class="d-lg-block d-xl-block d-none"></div>
    <div style="height: 40px;" class="d-block d-lg-none d-xl-none"></div>
</div>

<div class="bgGray">
    <div class="">
        <div style="height: 32px;" class="d-lg-block d-xl-block d-none"></div>
        <div style="height: 40px;" class="d-block d-lg-none d-xl-none"></div>

        <h2 class="ff-1 colorDark text-uppercase text-center">GALLERY</h2>

        <div style="height: 24px;"></div>
        
        <div class="gallery">
            <span class="arrow arrow-left disabled"><img src="img/ic_long-left.svg" alt=""></span>
        
            <div class="gallery__wrapper wrapper-left" id="gallery__wrapper">
                
                <div class="gallery__grid">
                    <?php for ($i = 1; $i < 9; $i++) : ?>
                        <div class="gallery__item">
                            <a href="img/home/gallery_<?php echo $i ?>.jpg" data-fancybox="gallery" data-caption="Optional caption">
                                <img src="img/home/gallery_<?php echo $i ?>.jpg" alt="">
                            </a>

                        </div>

                    <?php endfor; ?>
                </div>
                <div class="gallery__grid">
                    <?php for ($i = 1; $i < 9; $i++) : ?>
                        <div class="gallery__item">
                            <a href="img/home/gallery_<?php echo $i ?>.jpg" data-fancybox="gallery" data-caption="Optional caption">
                                <img src="img/home/gallery_<?php echo $i ?>.jpg" alt="">
                            </a>
                        </div>
                    <?php endfor; ?>
                </div>
                
            </div>
            <span class="arrow arrow-right"><img src="img/ic_long-right.svg" alt=""></span>
        </div>

        <div style="height: 32px;" class="d-lg-block d-xl-block d-none"></div>
        <div style="height: 40px;" class="d-block d-lg-none d-xl-none"></div>
    </div>
</div>

<!-- <script src="test/js/gallery.js"></script> -->

<script type="text/javascript">
    $(document).ready(function() {
        $('#content').css({
            'position': 'relative',
            'margin-top': '-43px'
        });

        $(window).scroll(function(event) {
            var scroll = $(window).scrollTop();
            if (scroll > 1000) {
                $('#content').css({
                    'top': 0
                });
            } else {
                $('#content').css({
                    'margin-top': '-43px'
                });
            }
        });

        $('body').addClass('page-home');

        var swiper = new Swiper('.banner__swiper .swiper-container', {
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
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            pagination: {
                el: '.swiper-pagination',
                type: 'bullets',
                clickable: true,
                renderBullet: function(index, className) {
                    return '<span class="' + className + '"><span class="halfclip"><span class="halfcircle clipped"></span></span><span class="halfcircle fixed"></span></span>';
                },
            },
        });

        var swiperf = new Swiper('.featured .swiper-container', {
            slidesPerView: "auto",
            spaceBetween: 24,
            centeredSlides: true,
            allowTouchMove: true,
            loop: true,
            breakpoints: {
                // when window width is >= 640px
                960: {
                    slidesPerView: 3,
                    spaceBetween: 30,
                    allowTouchMove: false,
                    centeredSlides: false,
                    loop: false,
                }
            }
        });

        

        $('.gallery .arrow').click(function(){
            var element = document.getElementById('gallery__wrapper');
            var maxScrollLeft = element.scrollWidth - element.clientWidth;

            let scrollLeft = 0;
            var leftPos = $('.gallery__wrapper').scrollLeft();
            if($(this).hasClass('arrow-left')){
                scrollLeft = leftPos - 500;
            }else{
                scrollLeft = leftPos + 500;
            }
            $(".gallery__wrapper").animate({scrollLeft: scrollLeft}, 800);

            if(scrollLeft >= maxScrollLeft){
                $('.gallery .arrow-right').addClass('disabled');
            }else{
                $('.gallery .arrow-right').removeClass('disabled');
            }

            if(scrollLeft <= 0){
                $('.gallery .arrow-left').addClass('disabled');
            }else{
                $('.gallery .arrow-left').removeClass('disabled');
            }
        });
    });
</script>

<?php include "includes/footer.php" ?>