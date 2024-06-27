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


<?php include "includes/footer.php" ?>