<?php include "includes/header.php" ?>

<style type="text/css">
    @import url(https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css);
</style>

<div class="banner banner__swiper banner-service banner-full">
    <div class="navigator__breadcrumbs">
        <div class="container-fluid">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">SERVICE</li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Slider main container -->
    <div class="swiper-container">
        <div class="swiper-wrapper">
            <!-- Additional required wrapper -->

            <?php for ($i = 0; $i < 5; $i++) : ?>
                <div data-background="./img/service/img-banner-service.jpg" class="swiper-slide swiper-lazy">
                    <div class="container-fluid">
                        <div class="swiper-content">
                            <div class="fz16">YAMAHA SERVICE</div>
                            <h1 class="exbold ff-1">PROTECT YOUR<br>
                                YAMAHA TODAY</h1>
                            <div style="height: 24px;"></div>
                            <a href="#" class="btn-clip btn-border-white">LEARN MORE</a>
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

<div class="anchor" id="overview"></div>
<div class="image-text">
    <div class="container-fluid">
        <div class="row row-32">
            <div class="col-md-5">
                <div class="content">
                    <h2 class="title">OVERVIEW</h2>
                    <div class="description">
                        <p>Yamaha Motor Services is a full range of premium services that makes every aspect of
                            buying and owning a Yamaha even easier. We want to ensure that you always have an
                            enjoyable experience whenever you come across a Yamaha product.</p>
                        <p>YOU Services make the purchase of every Yamaha more accessible – and Yamaha owners can
                            benefit from the peace of mind that comes with every YOU product.</p>
                        <p>Take a closer look at the range of YOU services, and you’ll see that it is more than
                            buying a Yamaha, but the beginning of a long and lasting relationship.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <div class="image">
                    <img src="./img/service/img-overview.jpg" alt="img-overview.jpg" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
</div>
<div class="anchor" id="book-service"></div>
<div class="book-service">
    <div class="container-fluid">
        <div class="row row-32">
            <div class="col-md-6">
                <div class="image-group">
                    <div class="row sm-gutters">
                        <div class="col-12">
                            <img src="./img/service/img-book-service.jpg" alt="image" class="img-fluid">
                        </div>
                        <div class="col-6 d-none d-md-block">
                            <img src="./img/service/img-book-service-1.jpg" alt="image" class="img-fluid">
                        </div>
                        <div class="col-6 d-none d-md-block">
                            <img src="./img/service/img-book-service-2.jpg" alt="image" class="img-fluid">
                        </div>
                    </div>
                </div>
                <div class="d-md-none" style="height: 15px"></div>
            </div>
            <div class="col-md-6">
                <div class="d-md-none" style="height: 24px"></div>
                <h2 class="title-h">BOOK SERVICE</h2>
                <div class="form-service">
                    <label for="" class="fz14 colorWhite bold">YOUR BIKE</label>
                    <div style="height: 8px;"></div>
                    <div class="form-row">
                        <div class="col-6">
                            <div class="dropdown dropdown--selected">
                                <a href="javascript:void(0)" class="btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <div class="label">type <sup>*</sup></div>
                                    <div class="title">Hyper Naked</div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="javascript:void(0)" data-val="action">Action</a>
                                    <a class="dropdown-item" href="javascript:void(0)" data-val="Another action">Another
                                        action</a>
                                    <a class="dropdown-item" href="javascript:void(0)" data-val="Something else here"></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="dropdown dropdown--selected">
                                <a href="javascript:void(0)" class="btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <div class="label">model <sup>*</sup></div>
                                    <div class="title">MT 09</div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="javascript:void(0)" data-val="action">Action</a>
                                    <a class="dropdown-item" href="javascript:void(0)" data-val="action">Another
                                        action</a>
                                    <a class="dropdown-item" href="javascript:void(0)" data-val="action">Something
                                        else here</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <label for="" class="fz14  colorWhite bold">YOUR INFORMATION</label>
                    <div style="height: 8px;"></div>
                    <div class="form-group">

                        <input type="text" class="form-control" required />
                        <span class="floating-label">Name <sup>*</sup></span>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" class="form-control" required />
                                <span class="floating-label">Phone number <sup>*</sup></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group ">
                                <input type="text" class="form-control" required />
                                <span class="floating-label">Email address <sup>*</sup></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" required />
                        <span class="floating-label">Your Address <span>optional</span></span>
                    </div>
                    <label for="" class="fz14 colorWhite bold">DATE</label>
                    <div style="height: 8px;"></div>
                    <div class="form-group-important">
                        <div class="dropdown dropdown--selected dropdown--selected-date">
                            <a href="javascript:void(0)" class="btn" aria-haspopup="true" aria-expanded="false">
                                <div class="label">Date <sup>*</sup></div>
                                <div class="title" id="title-date">20-07-2021</div>
                            </a>
                            <?php $date = date('Y-m-d'); ?>
                            <input class="datepicker" value="20-07-2021">
                        </div>


                    </div>

                    <label for="" class="fz14 colorWhite bold">TIME / SECTION OF DAY</label>
                    <div style="height: 8px;"></div>
                    <div class="form-row">
                        <div class="col-6">
                            <div class="custom-control custom-radio">
                                <input type="radio" checked id="time1" name="customRadio" class="custom-control-input">
                                <label class="custom-control-label" for="time1">
                                    <strong class="fz14">Morning</strong>
                                    <p class="fz12 colorLGray2 normal mb-0">08:00 AM - 11:00 AM</p>
                                </label>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="custom-control custom-radio">
                                <input type="radio" id="time2" name="customRadio" class="custom-control-input">
                                <label class="custom-control-label" for="time2">
                                    <strong class="fz14">Afternoon</strong>
                                    <p class="fz12 colorLGray2 normal mb-0">01:00 PM - 09:00 PM</p>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group-important">
                        <label for="">SERVICE & DEALER</label>
                        <div class="dropdown dropdown--selected">
                            <a href="javascript:void(0)" class="btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <div class="title">Service Plan A</div>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="javascript:void(0)" data-val="action">Action</a>
                                <a class="dropdown-item" href="javascript:void(0)" data-val="Another action">Another
                                    action</a>
                                <a class="dropdown-item" href="javascript:void(0)" data-val="Something else here"></a>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-12">
                            <div class="dropdown dropdown-dealer dropdown--selected">
                                <a href="javascript:void(0)" class="btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <div class="title">Yamaha 3S Hanh Lam </div>
                                    <div class="label" style="top: 5px;">143C Khánh Hội, Phường 3, Quận 4, TP. Hồ Chí Minh</div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="javascript:void(0)" data-val="action">Action</a>
                                    <a class="dropdown-item" href="javascript:void(0)" data-val="Another action">Another
                                        action</a>
                                    <a class="dropdown-item" href="javascript:void(0)" data-val="Something else here"></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-none d-md-block" style="height: 24px"></div>
                    <div class="row align-items-center">
                        <div class="col-md-6 capcha">
                            <img src="./img/service/img-capcha.jpg" alt="img-capcha">
                        </div>
                        <div class="col-12 d-md-none" style="height: 32px"></div>
                        <div class="col-md-6 text-right">
                            <a href="#" class="btn-clip btn-red"> Book now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="anchor" id="service-plan"></div>
<div class="service-plan" id="">
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="ff-1 colorDark text-uppercase">SERVICE PLAN</h2>
            <a href="#" class="fz14 colorRed text-uppercase bold d-xl-flex d-lg-flex align-items-center">VIEW
                ALL <span style="width: 14px"></span> <i class="ico__chev-right"></i></a>
        </div>
        <div class="description">
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore
                et dolore magna aliqua.</p>
        </div>
        <div class="list-service">
            <div class="row sm-gutters">
                <div class="col-6">
                    <div class="background-image" style="background-image: url(./img/service/img-service-plan.jpg);">
                        <div class="d-md-flex">
                            <div class="icon"><img src="./img/service/icons/icon-1.svg" alt="icon"></div>
                            <div class="info">
                                <h3 class="colorWhite exbold ff-1">MT 09</h3>
                                <div class="d-none d-md-block" style="height: 8px;"></div>
                                <p class="price">8.000.000₫</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="background-image" style="background-image: url(./img/service/img-service-plan.jpg);">
                        <div class="d-md-flex">
                            <div class="icon"><img src="./img/service/icons/icon-2.svg" alt="icon"></div>
                            <div class="info">
                                <h3 class="colorWhite exbold ff-1">MT 08</h3>
                                <div class="d-none d-md-block" style="height: 8px;"></div>
                                <p class="price">8.000.000₫</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="background-image" style="background-image: url(./img/service/img-service-plan.jpg);">
                        <div class="d-md-flex">
                            <div class="icon"><img src="./img/service/icons/icon-3.svg" alt="icon"></div>
                            <div class="info">
                                <h3 class="colorWhite exbold ff-1">MT 07</h3>
                                <div class="d-none d-md-block" style="height: 8px;"></div>
                                <p class="price">8.000.000₫</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="background-image" style="background-image: url(./img/service/img-service-plan.jpg);">
                        <div class="d-md-flex">
                            <div class="icon"><img src="./img/service/icons/icon-4.svg" alt="icon"></div>
                            <div class="info">
                                <h3 class="colorWhite exbold ff-1">MT 06</h3>
                                <div class="d-none d-md-block" style="height: 8px;"></div>
                                <p class="price">8.000.000₫</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="anchor" id="rescue-247"></div>
<div class="image-text" id="">
    <div class="container-fluid">
        <div class="row row-32 flex-md-row-reverse flex-column-reverse">
            <div class="col-md-5">
                <div class="content">
                    <h2 class="title">RESCUE 24/7</h2>
                    <div class="description">
                        <p>You can start a live chat session with a Yamaha Support Agent on the Yamaha Contact
                            page.</p>

                        <p>To speak with a live agent, you need to choose your topic of support and press the “Chat”
                            button. Chat is available from from 7am to 5pm PST Monday-Friday, Saturday-Sunday
                            closed.</p>

                        <p><b>HOTLINE: (02)9421 0645.</b></p>
                    </div>
                    <a href="#" class="btn-clip btn-border-red">EXPLORE more <span class="ico__chev-right"></span></a>
                </div>
            </div>
            <div class="col-md-7">
                <div class="image">
                    <img src="./img/service/img-overview.jpg" alt="img-overview.jpg" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
</div>

<div class="service-card">
    <div class="container-fluid">
        <div class="row row-32">
            <div class="col-md-6" id="">
                <div class="anchor" id="warranty-policy"></div>
                <div class="card border-0">
                    <img class="card-img-top" src="./img/service/img-service-card-1.jpg" alt="image-cap">
                    <div class="card-body px-0">
                        <h2 class="card-title ff-1 exbold">WARRANTY & POLICY</h2>
                        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam...</p>
                        <a href="#" class="btn-clip btn-border-red">EXPLORE more <span class="ico__chev-right"></span></a>
                    </div>
                </div>
            </div>
            <div class="col-md-6" id="">
                <div class="anchor" id="yamalube"></div>
                <div class="card border-0">
                    <img class="card-img-top" src="./img/service/img-service-card-2.jpg" alt="image-cap">
                    <div class="card-body px-0">
                        <h2 class="card-title ff-1 exbold">YAMALUBE</h2>
                        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam...</p>
                        <a href="#" class="btn-clip btn-border-red">EXPLORE more <span class="ico__chev-right"></span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $(".h-box.gradient").css({
            background: '#1D1F21'
        });


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

        $('.datepicker').datepicker({
            format: 'M ,dd ,yyyy'
        }).on('changeDate', function(ev) {
            var text = $('.datepicker').val();

            $("#title-date").text(text);

        });
    });
</script>

<?php include "includes/footer.php" ?>