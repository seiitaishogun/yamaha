<?php include "includes/header/header_start.php"; ?>

<div class="navigator__breadcrumbs">
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">News</li>
            </ol>
        </nav>
    </div>
</div>

<ul class="toolbar-nav">
    <?php
    $arr = ["Test Ride", "Find a Dealer", "Book Service", "Live chat"];
    for ($v = 1; $v <= 4; $v++) : ?>
        <li class="toolbar-nav__<?php echo $v ?>">
            <a href="#.">
                <span style="mask-image: url(img/ic_tool<?php echo $v; ?>.svg); -webkit-mask-image: url(img/ic_tool<?php echo $v; ?>.svg)" class="icon"></span> <span class="text"><?php echo $arr[$v - 1]; ?></span>
            </a>
        </li>
    <?php endfor ?>
</ul>

<?php include "includes/header/header_end.php" ?>

<div class="news">
    <div class="container-fluid">
        <div style="height: 24px;" class="d-lg-block d-xl-block d-none"></div>
        <div class="news__header">
            <div class="row">

                <div class="col-lg-8 col-12">
                    <div class="news__center-bg" style="background-image: url('./img/news/img-news-center.jpg')">
                        <a href="#" class="stretched-link"></a>

                        <div class="news__center-content">
                            <label for="" class="news__headline">ACTIVITIES <strong>•</strong> <span>Sep 8, 2021</span></label>
                            <div style="height: 10px"></div>
                            <h4 class="ff-1 text-clamp">1 MONSTER ENERGY YAMAHA FACTORY RACING’S JUSTIN BARCIA BATTLES TO A TOP - FIVE FINISH AT THE 2018</h4>
                            <div style="height: 8px"></div>
                            <div class="news__center-des"><p>The Monster Energy/Yamaha Factory Racing Team switched gears to supercross racing on Saturday as Justin Barcia took on the 2018 Monster Energy Cup (MEC) in Las Vegas. In a unique format of three, 10-lap Main Events, Barcia overcame rough starts and a crash in the final race to ultimately battle his way to a top-five finish in the premier Cup Class.</p>
                                <p>In Main Event 1, Barcia got off to a sixth-place start and immediately went to work moving into fifth position. He battled just outside podium contention for a majority of the race, making a valiant last-lap pass to finish fourth. In Main 2, Barcia had a great jump aboard his YZ450F but he got pinched off before the first turn. Beginning his charge from outside the top-five, Barcia fought his way through the pack to finish second in race two. As the gate dropped for the third and final Main Event, Barcia got pinched off once again and went down in the first turn. Quickly remounting, he charged his way from nearly last on the opening lap to ultimately climb his way up to a seventh-place finish.</p>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-lg-4 col-12">
                    <ul class="news__header-list">
                        <li class="news__header-item">
                            <a href="http://yamaha-wp.local/news/monster-energy-yamaha-factory-racings-justin-barcia-battles-to-a-top-five-finish-at-the-2018-7/" class="stretched-link"></a>
                            <div class="news__img-thumb">
                                <img src="./img/news/img-news-center.jpg" alt="" class="">
                            </div>
                            <div class="news__detail-thumb">
                                <label for="" class="news__headline">ACTIVITIES <strong>•</strong> <span>Aug 10, 2021</span></label>
                                <div style="height: 4px"></div>
                                <div class="fz16 bold text-clamp">2MONSTER ENERGY YAMAHA FACTORY RACING’S JUSTIN BARCIA BATTLES TO A TOP - FIVE FINISH AT THE 2018</div>
                            </div>
                        </li>
                        <li class="news__header-item">
                            <a href="http://yamaha-wp.local/news/monster-energy-yamaha-factory-racings-justin-barcia-battles-to-a-top-five-finish-at-the-2018-6/" class="stretched-link"></a>
                            <div class="news__img-thumb">
                                <img src="./img/news/img-news-center.jpg" alt="" class="">
                            </div>
                            <div class="news__detail-thumb">
                                <label for="" class="news__headline">ACTIVITIES <strong>•</strong> <span>Aug 10, 2021</span></label>
                                <div style="height: 4px"></div>
                                <div class="fz16 bold text-clamp">3MONSTER ENERGY YAMAHA FACTORY RACING’S JUSTIN BARCIA BATTLES TO A TOP - FIVE FINISH AT THE 2018</div>
                            </div>
                        </li>
                        <li class="news__header-item">
                            <a href="http://yamaha-wp.local/news/monster-energy-yamaha-factory-racings-justin-barcia-battles-to-a-top-five-finish-at-the-2018-5/" class="stretched-link"></a>
                            <div class="news__img-thumb">
                                <img src="./img/news/img-news-center.jpg" alt="" class="">
                            </div>
                            <div class="news__detail-thumb">
                                <label for="" class="news__headline">ACTIVITIES <strong>•</strong> <span>Aug 10, 2021</span></label>
                                <div style="height: 4px"></div>
                                <div class="fz16 bold text-clamp">4MONSTER ENERGY YAMAHA FACTORY RACING’S JUSTIN BARCIA BATTLES TO A TOP - FIVE FINISH AT THE 2018</div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div style="height: 32px;" class="d-lg-block d-xl-block d-none"></div>
    </div>

    <div class="news__mb">
        <div class="swiper-container">
            <div class="swiper-wrapper">
                <?php for ($i = 0; $i < 3; $i++) : ?>
                    <div class="swiper-slide">
                        <div class="news__center">
                            <a href="#" class="stretched-link"></a>
                            <div class="news__center-img" style="background-image: url('./img/news/img-news-featured-<?php echo $i + 1  ?>.jpg');"></div>
                            <div class="news__center-content">
                                <label for="" class="news__headline">ACTIVITIES <strong>•</strong> <span>Oct 20, 2021</span></label>
                                <div style="height: 10px"></div>
                                <h4 class="ff-1 text-clamp text-uppercase"><a href="news-detail.php">Monster Energy Yamaha Factory Racing’s Justin Barcia Battles to a Top-Five Finish at the 2018 </a></h4>
                                <div style="height: 8px"></div>
                                <div class="news__center-des">As tough as the desert where it was born, the Ténéré700 Rally Edition comes with new features to go wherever adventure takes you. 40 years on, the Yamaha Ténéré 700 is capturing the imagination of a new generation of riders...</div>
                            </div>
                        </div>
                    </div>
                <?php endfor; ?>
            </div>

            <!-- If we need pagination -->
            <div class="swiper-pagi-wrapper">
                <div class="swiper-pagination swiper-pagination--custom"></div>

            </div>
        </div>
    </div>


    <div class="bgDark">
        <div style="height: 32px;" class="d-lg-block d-xl-block d-none"></div>
        <div style="height: 14px;" class="d-block d-lg-none d-xl-none"></div>
        <div class="container-fluid">
            <div class="news__featured">
                <div style="height: 14px;" class="d-block d-lg-none d-xl-none"></div>
                <div class="line d-lg-none d-block"></div>
                <div style="height: 24px"></div>
                <div class="row">
                    <?php for ($i = 0; $i < 3; $i++) : ?>
                        <div class="col-lg-4 col-12 news__featured-wrapper">
                            <div class="news__featured-img">
                                <img src="./img/news/img-news-featured-<?php echo $i + 1 ?>.jpg" alt="" class="" />
                            </div>
                            <div class="news__featured-item">
                                <label for="" class="news__headline">ACTIVITIES <strong>•</strong> <span>Oct 20, 2021</span></label>
                                <div style="height: 16px;" class="d-lg-block d-xl-block d-none"></div>
                                <div style="height: 8px;" class="d-block d-lg-none d-xl-none"></div>
                                <div class="fz18 bold des colorWhite"><a href="news-detail.php">Yamaha Motor Europe Extends Warranty Period in response to Coronavirus Restrictions</a></div>
                                <div class="d-lg-block d-none">
                                    <div style="height: 24px"></div>
                                    <div class="line"></div>
                                </div>
                            </div>
                        </div>
                    <?php endfor ?>
                </div>
            </div>

        </div>
        <div style="height: 32px;" class="d-lg-block d-xl-block d-none"></div>
    </div>

    <div class="container-fluid">
        <div style="height: 32px;" class="d-lg-block d-xl-block d-none"></div>
        <div style="height: 40px;" class="d-block d-lg-none d-xl-none"></div>


        <div class="news__daily">
            <div class="row">
                <?php for ($i = 0; $i < 3; $i++) : ?>
                    <div class="col-lg-4 col-12 news__daily-wrapper">
                        <div class="news__daily-img">
                            <img src="./img/news/img-news-daily-<?php echo $i + 1 ?>.jpg" alt="" class="" />
                        </div>
                        <div class="news__daily-item">
                            <label for="" class="news__headline">ACTIVITIES <strong>•</strong> <span>Oct 20, 2021</span></label>
                            <div style="height: 16px;" class="d-lg-block d-xl-block d-none"></div>
                            <div style="height: 8px;" class="d-block d-lg-none d-xl-none"></div>
                            <div class="fz18 bold des"><a href="news-detail.php">Yamaha Motor Europe Extends Warranty Period in response to Coronavirus Restrictions</a></div>
                            <div class="d-lg-block d-none">
                                <div style="height: 24px"></div>
                                <div class="line"></div>
                            </div>
                        </div>
                    </div>
                <?php endfor ?>
            </div>
        </div>


        <div style="height: 32px;" class="d-lg-block d-xl-block d-none"></div>
        <div style="height: 40px;" class="d-block d-lg-none d-xl-none"></div>
    </div>


    <div class="bgDark">
        <div style="height: 32px;" class="d-lg-block d-xl-block d-none"></div>
        <div style="height: 14px;" class="d-block d-lg-none d-xl-none"></div>
        <div class="container-fluid">
            <div class="news__featured news__featured--custom">
                <h2 class="ff-1 text-uppercase  text-lg-left text-center">HOT NEWS</h2>
                <div style="height: 14px;" class="d-block d-lg-none d-xl-none"></div>
                <div class="line d-lg-none d-block"></div>
                <div style="height: 24px"></div>
                <div class="row">
                    <?php for ($i = 0; $i < 3; $i++) : ?>
                        <div class="col-lg-4 col-12 news__featured-wrapper">
                            <div class="news__featured-img">
                                <img src="./img/news/img-news-hot-<?php echo $i + 1 ?>.jpg" alt="" class="" />
                            </div>
                            <div class="news__featured-item">
                                <label for="" class="news__headline">ACTIVITIES <strong>•</strong> <span>Oct 20, 2021</span></label>
                                <div style="height: 16px;" class="d-lg-block d-xl-block d-none"></div>
                                <div style="height: 8px;" class="d-block d-lg-none d-xl-none"></div>
                                <div class="fz18 bold des colorWhite"><a href="news-detail.php">Yamaha Motor Europe Extends Warranty Period in response to Coronavirus Restrictions</a></div>
                                <div class="d-lg-block d-none">
                                    <div style="height: 24px"></div>
                                    <div class="line"></div>
                                </div>
                            </div>
                        </div>
                    <?php endfor ?>
                </div>
            </div>

        </div>
        <div style="height: 32px;" class="d-lg-block d-xl-block d-none"></div>
    </div>

    <div class="container-fluid">
        <div style="height: 32px;" class="d-lg-block d-xl-block d-none"></div>
        <div style="height: 40px;" class="d-block d-lg-none d-xl-none"></div>


        <div class="news__daily">
            <div class="row">
                <?php for ($i = 0; $i < 3; $i++) : ?>
                    <div class="col-lg-4 col-12 news__daily-wrapper">
                        <div class="news__daily-img">
                            <img src="./img/news/img-news-daily-<?php echo $i + 1 ?>.jpg" alt="" class="" />
                        </div>
                        <div class="news__daily-item">
                            <label for="" class="news__headline">ACTIVITIES <strong>•</strong> <span>Oct 20, 2021</span></label>
                            <div style="height: 16px;" class="d-lg-block d-xl-block d-none"></div>
                            <div style="height: 8px;" class="d-block d-lg-none d-xl-none"></div>
                            <div class="fz18 bold des"><a href="news-detail.php">Yamaha Motor Europe Extends Warranty Period in response to Coronavirus Restrictions</a></div>
                            <div class="d-lg-block d-none">
                                <div style="height: 24px"></div>
                                <div class="line"></div>
                            </div>
                        </div>
                    </div>
                <?php endfor ?>
            </div>
            <div class="d-lg-block d-none" style="height: 40px"></div>
            <div class="text-center">
                <a href="javascript: void(0);" id="loadmore" class="btn-clip btn-border-red">LOAD more</a>
            </div>
        </div>


        <div style="height: 32px;"></div>
    </div>

</div>

<script type="text/javascript">
    $(".h-box.gradient").css({
        background: '#1D1F21'
    });

    $(document).ready(function() {
        var swiper = new Swiper('.news__mb .swiper-container', {
            slidesPerView: 1,
            spaceBetween: 30,
            autoplay: {
                delay: 5000,
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
    });
</script>

<?php include "includes/footer.php" ?>