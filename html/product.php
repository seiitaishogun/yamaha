<?php include "includes/header.php" ?>

<div class="banner banner__product banner-full" style="background-image: url(./img/product/img-banner-product.png);">
    <div class="navigator__breadcrumbs">
        <div class="container-fluid">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">HYER NAKED</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="banner-inner">
        <div class="text-content">
            <div class="">REVOLUTION OF THE ICON</div>
            <h1 class="exbold ff-1">MT 09</h1>
            <button type="button" class="btn--scrolldown click-next-section" data-pos="#next"><img src="img/ic_long-down.svg" alt=""></button>
        </div>
    </div>
</div>

<!-- /////OVERVIEW//// -->
<div class="product" id="next">
    <div style="height: 32px;" class="d-lg-block d-xl-block d-none"></div>
    <div style="height: 40px;" class="d-block d-lg-none d-xl-none"></div>
    <div class="container-fluid">
        <div class="row flex-lg-row-reverse">

            <div class="col-7 d-lg-block d-none">
                <div class="background-image img-product" style="background-image: url(img/moto-2.png);"></div>
            </div>
            <div class="col-lg-5 col-12">
                <h2 class="ff-1 colorDark text-uppercase">OVERVIEW</h2>
                <div style="height: 24px;"></div>
                <div class="">
                    Yamaha has reinforced its dominance in the Hyper Naked category with the all-new MT-09 for 2021.<br>
                    Lighter, more powerful, and more technologically advanced in every area, this dynamic new motorcycle is the purest a of the core values that make the MT range such a huge hit.
                </div>
                <div style="height: 12px;"></div>
                <div class="background-image background-image--product-mb d-lg-none d-flex" style="background-image: url(img/moto.png); padding: 0"></div>
                <ul class="product__color">
                    <?php for ($i = 0; $i < 3; $i++) : ?>
                        <li class="<?php echo $i == 0 ? "active" : "" ?>" data-color="img/moto2.png">
                            <div class="block-color">
                                <img src="img/moto.png" alt="">
                            </div>
                            <div>Storm Fluo</div>
                        </li>
                    <?php endfor; ?>
                </ul>
                <ul class="product__color-mb">
                    <li class="active" data-color="#27249B" data-img="img/moto2.png" style="background: #27249B"><span></span></li>
                    <li data-color="#27249B" data-img="img/moto2.png" style="background: #27249B"><span></span></li>
                    <li data-color="#333333" data-img="img/moto2.png" style="background: #333333"><span></span></li>
                </ul>
                <div style="height: 12px;"></div>
                <div class="product__price-preview">
                    <div class="fz14 colorLGray text-start">Starting at</div>
                    <h4 class="ff-1 colorDark" style="line-height: 33px;"><span class="fz30">306.000.000₫</span></h4>
                    <div style="height: 24px;"></div>
                    <div class="d-lg-flex align-items-center">
                        <a href="booking.php" class="btn-clip btn-red">BOOKING</a>
                        <div style="width: 50px;"></div>
                        
                        <a href="compare-add.php" class="btn-clip btn-border-red">
                            <img src="img/ic_compare.svg" alt="" class="mr-2"> COMPARE BIKES
                        </a>

                    </div>
                </div>

            </div>
        </div>
    </div>
    <div style="height: 32px;" class="d-lg-block d-xl-block d-none"></div>
    <div style="height: 40px;" class="d-block d-lg-none d-xl-none"></div>
</div>

<!-- //////FEATURE BENEFITS/// -->
<div class="product product__featured bgGray">
    <div style="height: 32px;" class="d-lg-block d-xl-block d-none"></div>
    <div style="height: 40px;" class="d-block d-lg-none d-xl-none"></div>
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center top-slide">
            <h2 class="ff-1 colorDark text-uppercase">FEATURE BENEFITS</h2>
            <div class="swiper-navi-product">
                <div class="swiper-button-prev swiper-button-prev--custom"><img src="img/ic_long-left.svg" alt=""></div>
                <div class="swiper-button-next swiper-button-next--custom"><img src="img/ic_long-right.svg" alt=""></div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </div>
    <div style="height: 24px;"></div>
    <div class="swiper-wrapper-slide wrapper-left">
        <div class="swiper-container">
            <div class="swiper-wrapper">
                <?php for ($i = 0; $i < 6; $i++) : ?>
                    <div class="swiper-slide">
                        <img src="./img/product/img-featured-<?php echo $i + 1 ?>.jpg" alt="">
                        <div style="height: 24px;"></div>
                        <div class="pr-lg-5 pr-0">
                            <div class="fz20 bold colorDark clamp-2"><?php echo $i + 1 ?>. Die-Cast Aluminum Deltabox</div>
                            <div style="height: 8px;"></div>
                            <div class="fz14 clamp-4">The Yamaha Deltabox frame is a patented motorcycle chassis produced by Yamaha Motor Company of Iwata, Shizuoka, Japan. The first road version of the Deltabox Frame, for general public appeared in 1987 on the Yamaha FZR1000. </div>
                        </div>
                        <a href="#" class="link-full"></a>
                    </div>
                <?php endfor; ?>
            </div>
            <div class="swiper-navi-product d-lg-none d-block">
                <div class="swiper-button-prev swiper-button-prev--custom"><img src="img/ic_long-left.svg" alt=""></div>
                <div class="swiper-button-next swiper-button-next--custom"><img src="img/ic_long-right.svg" alt=""></div>
            </div>
        </div>
    </div>
    <div style="height: 32px;" class="d-lg-block d-xl-block d-none"></div>
    <div style="height: 40px;" class="d-block d-lg-none d-xl-none"></div>
</div>

<!-- //////SPECIFICATIONS/// -->

<div class="product">
    <div style="height: 32px;" class="d-lg-block d-xl-block d-none"></div>
    <div style="height: 40px;" class="d-block d-lg-none d-xl-none"></div>
    <div class="container-fluid px-lg-4 px-0">
        <div class="wrapper-container">
            <div class="embed-responsive embed-responsive-16by9">
                <iframe src="https://www.youtube.com/embed/TUQNl45Hzbo?controls=0" title="YouTube video player" class="embed-responsive-item" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
        </div>
    </div>
    <div class="container-fluid">

        <div style="height: 32px;" class="d-lg-block d-xl-block d-none"></div>
        <div style="height: 40px;" class="d-block d-lg-none d-xl-none"></div>

        <h2 class="ff-1 colorDark text-uppercase text-lg-center">SPECIFICATIONS</h2>

        <div style="height: 40px;" class=""></div>
        <div class="row">
            <div class="col-lg-4 col-12">
                <div class="product__engine">
                    <div class="product__engine-item">
                        <h3 class="product__point"><span class="animate-number" data-number="890">0</span> <sup>CC</sup></h3>
                        <div class="line"></div>
                        <div>Engine</div>
                    </div>
                    <div class="product__engine-item">
                        <h3 class="product__point"><span class="animate-number" data-number="177">0</span> <sup>HP</sup></h3>
                        <div class="line"></div>
                        <div>HP Peak Power</div>
                    </div>
                    <div class="product__engine-item">
                        <h3 class="product__point"><span class="animate-number" data-number="6">0</span> <sup>AXIS</sup></h3>
                        <div class="line"></div>
                        <div>IMU</div>
                    </div>
                    <div class="product__engine-item">
                        <h3 class="product__point wet-height"><span class="animate-number" data-number="417">0</span> <sup>POUND</sup></h3>
                        <div class="line"></div>
                        <div>Wet Weight</div>
                    </div>
                </div>
                <a href="#." class="btn-clip btn-red link-desk"><span class="append-icon ico__download"></span> DOWNLOAD E-BROCHURE</a>
            </div>

            <div class="col-lg-8 col-12">
                <div class="product__accordion" id="product__accordion">
                    <button class="product__accordion-btn" type="button" data-toggle="collapse" data-target="#collapse_p1" aria-expanded="true" aria-controls="collapse1">
                        ENGINE <span class="cavet"></span>
                    </button>

                    <div id="collapse_p1" class="collapse show product__accordion-content">
                        <ul>
                            <li>
                                <strong>Engine Type</strong>
                                <span>3-Cylinder, liquid-cooled, 4-stroke, DOHC, 4-valves</span>
                            </li>
                            <li>
                                <strong>Displacement</strong>
                                <span>847 cm³</span>
                            </li>
                            <li>
                                <strong>Bore x stroke</strong>
                                <span>78.0 mm x 59.1 mm</span>
                            </li>
                            <li>
                                <strong>Compression ratio</strong>
                                <span>11.5 : 1</span>
                            </li>
                            <li>
                                <strong>Maximum power</strong>
                                <span>84.6 kW (115PS) @ 10.000 rpm</span>
                            </li>
                            <li>
                                <strong>Limited power version</strong>
                                <span>N/A</span>
                            </li>
                            <li>
                                <strong>Maximum torque</strong>
                                <span>87.5 Nm (8.9 kg-m) @ 8.500 rpm</span>
                            </li>
                            <li>
                                <strong>Lubrication system</strong>
                                <span>Wet sump</span>
                            </li>
                            <li>
                                <strong>Clutch type</strong>
                                <span>Wet, Multiple Disc</span>
                            </li>
                            <li>
                                <strong>Ignition system</strong>
                                <span>TCI</span>
                            </li>

                            <li>
                                <strong>Starter system</strong>
                                <span>Electric</span>
                            </li>

                            <li>
                                <strong>Transmission system</strong>
                                <span>Constant Mesh, 6-speed</span>
                            </li>

                            <li>
                                <strong>Final transmission</strong>
                                <span>Chain</span>
                            </li>
                            <li>
                                <strong>Fuel consumption</strong>
                                <span>5.5 l/100km</span>
                            </li>
                            <li>
                                <strong>CO2 emission</strong>
                                <span>127 g/km</span>
                            </li>

                        </ul>
                    </div>
                </div>

                <div class="product__accordion">
                    <button class="product__accordion-btn collapsed" type="button" data-toggle="collapse" data-target="#collapse_p2" aria-expanded="true" aria-controls="collapse1">
                        CHASSIS <span class="cavet"></span>
                    </button>

                    <div id="collapse_p2" class="collapse product__accordion-content">
                        <ul>
                            <li>
                                <strong>Frame</strong>
                                <span>Diamond</span>
                            </li>
                            <li>
                                <strong>Front travel</strong>
                                <span>137 mm</span>
                            </li>
                            <li>
                                <strong>Caster angle</strong>
                                <span>24º</span>
                            </li>
                            <li>
                                <strong>Trail</strong>
                                <span>100 mm</span>
                            </li>
                            <li>
                                <strong>Front suspension system</strong>
                                <span>Telescopic forks</span>
                            </li>
                            <li>
                                <strong>Rear suspension system</strong>
                                <span>Swingarm, (Link type suspension)</span>
                            </li>
                            <li>
                                <strong>Rear travel</strong>
                                <span>142 mm</span>
                            </li>
                            <li>
                                <strong>Front brake</strong>
                                <span>Hydraulic dual disc, Ø 298 mm</span>
                            </li>
                            <li>
                                <strong>Rear brake</strong>
                                <span>Hydraulic single disc, Ø 245 mm</span>
                            </li>
                            <li>
                                <strong>Front tyre</strong>
                                <span>120/70ZR17M/C (58W)</span>
                            </li>
                            <li>
                                <strong>Rear tyre</strong>
                                <span>180/55ZR17M/C (73W)</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="product__accordion">
                    <button class="product__accordion-btn collapsed" type="button" data-toggle="collapse" data-target="#collapse_p3" aria-expanded="true" aria-controls="collapse1">
                        DIMENTIONS <span class="cavet"></span>
                    </button>
                    <div id="collapse_p3" class="collapse product__accordion-content">
                        <ul>
                            <li>
                                <strong>Overall length</strong>
                                <span>2.160 mm</span>
                            </li>
                            <li>
                                <strong>Overall width</strong>
                                <span>850 mm</span>
                            </li>
                            <li>
                                <strong>Overall height</strong>
                                <span>1.375 mm max 1.430 mm</span>
                            </li>
                            <li>
                                <strong>Seat height</strong>
                                <span>850 mm max 865 mm</span>
                            </li>
                            <li>
                                <strong>Wheel base</strong>
                                <span>1.500 mm</span>
                            </li>
                            <li>
                                <strong>Minimum ground clearance</strong>
                                <span>135 mm</span>
                            </li>
                            <li>
                                <strong>Wet weight (including full oil and fuel tank)</strong>
                                <span>214 kg</span>
                            </li>
                            <li>
                                <strong>Fuel tank capacity</strong>
                                <span>18 L</span>
                            </li>
                            <li>
                                <strong>Oil tank capacity</strong>
                                <span>3.4 L</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <a href="#." class="btn-clip btn-border-red link-mb"><span class="append-icon ico__download"></span> DOWNLOAD E-BROCHURE</a>
            </div>
        </div>

    </div>
    <div style="height: 32px;" class="d-lg-block d-xl-block d-none"></div>
    <div style="height: 40px;" class="d-block d-lg-none d-xl-none"></div>
</div>


<!-- ////RECOMMENDED ///// -->

<div class="product bgGray">
    <div style="height: 32px;" class="d-lg-block d-xl-block d-none"></div>
    <div style="height: 20px;" class="d-block d-lg-none d-xl-none"></div>
    <div class="container-fluid">
        <div class="d-flex align-items-center justify-content-between">
            <h2 class="ff-1 colorDark text-uppercase text-center">HYPER NAKED LINE UP</h2>
            <div class="swiper-navi">
                <div class="swiper-button-prev swiper-button-prev--custom"><img src="img/ic_long-left.svg" alt=""></div>
                <div class="swiper-button-next swiper-button-next--custom"><img src="img/ic_long-right.svg" alt=""></div>
                <div class="d-lg-none swiper-pagination"></div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div style="height: 24px;"></div>
        <div class="product__recommend">
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    <?php for ($i = 0; $i < 6; $i++) : ?>
                        <div class="product__recommend-item swiper-slide">
                            <div class="block-img">
                                <img src="img/moto-3.png" alt="">
                            </div>
                            <div style="height: 24px;"></div>
                            <div class="fz18 bold">MT-15</div>
                            <div class="fz14 colorLGray">Starting at <span class="fz20">69.000.000₫</span></div>
                        </div>
                    <?php endfor ?>
                </div>
            </div>
            <div class="swiper-navi-mb d-lg-none">
                <div class="swiper-button-prev swiper-button-prev--custom"><img src="img/ic_long-left.svg" alt=""></div>
                <div class="swiper-button-next swiper-button-next--custom"><img src="img/ic_long-right.svg" alt=""></div>
            </div>
        </div>
    </div>
    <div style="height: 32px;"></div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('#content').css({
            'position': 'relative',
            'margin-top': '-43px'
        });
        var swiperLine = new Swiper('.product__recommend .swiper-container', {
            slidesPerView: 1,
            spaceBetween: 8,
            navigation: {
                nextEl: '.swiper-navi-mb .swiper-button-next',
                prevEl: '.swiper-navi-mb .swiper-button-prev',
            },
            pagination: {
                el: '.swiper-navi .swiper-pagination',
                type: 'fraction',
            },
            breakpoints: {
                // when window width is >= 640px
                960: {
                    slidesPerView: 4,
                    spaceBetween: 8,
                    navigation: {
                        nextEl: '.swiper-navi .swiper-button-next',
                        prevEl: '.swiper-navi .swiper-button-prev',
                    },
                }
            }
        });
        PageFunction.products();
    });
</script>

<?php include "includes/footer.php" ?>