<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Yamaha</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <!-- <link rel="shortcut icon" type="image/png" href="img/favicon.png" /> -->
    <!-- Place favicon.ico in the root directory -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox.css" />
    <link rel="stylesheet" href="css/styles.min.css">
    <script src="js/vendor/modernizr-2.8.3.min.js"></script>
    <script src="js/vendor/jquery-3.5.1.min.js"></script>

    <script src="js/vendor/pycs-layout.jquery.js"></script>

</head>

<body>
    <div class="static-hold"></div>

    <header class="h-box gradient">
        <div class="container-fluid h-box__wrapper">
            <a href="index.php" class="h-logo">
                <img src="img/logo.svg" alt="" class="h-logo-1">
                <img src="img/logo2.svg" alt="" class="h-logo-2">
            </a>

            <ul class="h-menu">
                <li class="h-menu__item d-lg-flex d-xl-flex d-none">
                    <h6><a href="index.php" class="link">HOME</a></h6>
                </li>
                <li class="h-menu__item h-menu__item--submenu d-lg-flex d-xl-flex d-none">
                    <h6><a href="javascript:void(0);" class="link">BIKES</a></h6>
                    <div class="h-menu__moto">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="h-menu__nav" style="width: 256px">
                                    <label for="" class="h-menu__headline">BIKE CATEGORIES</label>
                                    <ul class="h-menu__category" id="scrollby">
                                        <?php $arrTitle = ["HYPER NAKED", "SUPER SPORT", "SPORT HERITAGE", "ADVENTURE TOURING", "SPORT TOURING", "SCOOTER"] ?>
                                        <?php $arrId = ["hyper", "super", "sport", "adventure", "sport-tour", "scooter"] ?>
                                        <?php for ($v = 0; $v < 6; $v++) : ?>
                                            <li class="<?php echo $v === 0 ? 'active' : '' ?>" data-scroll="#<?php echo $arrId[$v]; ?>">
                                                <span><?php echo $arrTitle[$v] ?></span>
                                                <div class="line"></div>
                                            </li>
                                        <?php endfor; ?>
                                    </ul>
                                </div>
                                <div class="h-menu__list-item">
                                    <!-- ////// -->
                                    <div class="h-menu__sticky">
                                        <label for="" class="h-menu__headline change-title-js">HYPER NAKED</label>
                                    </div>
                                    <!-- ////// -->
                                    <div class="h-menu__wrapper">
                                        <div class="h-menu__content">
                                            <?php $arr = ["hyper", "super", "sport"] ?>
                                            <?php $arrCat = ["HYPER NAKED", "SUPER SPORT", "SPORT HERITAGE"] ?>
                                            <?php $arrImg = ["hyper", "super", "super"] ?>
                                            <?php for ($v = 0; $v < 3; $v++) : ?>
                                                <div class="h-menu__section" id="<?php echo $arr[$v]; ?>" data-title="<?php echo $arrCat[$v]; ?>">
                                                    <label for="" class="h-menu__headline"><?php echo $arrCat[$v]; ?></label>
                                                    <div class="row">
                                                        <?php for ($i = 0; $i < 4; $i++) : ?>
                                                            <div class="col-3">
                                                                <a href="product.php" class="stretched-link"></a>
                                                                <img src="./img/menu/img-moto-<?php echo $arrImg[$v]; ?>-<?php echo $i + 1 ?>.png" alt="">
                                                                <strong>MT 15</strong>
                                                                <p class="colorGray fz14">From <span class="fz20">69.000.000₫</span></p>
                                                            </div>
                                                        <?php endfor; ?>
                                                    </div>
                                                </div>
                                            <?php endfor; ?>
                                            <?php $arr1 = ["adventure", "sport-tour", "scooter"] ?>
                                            <?php $arrCat1 = ["ADVENTURE TOURING", "SPORT TOURING", "SCOOTER"] ?>
                                            <?php for ($v = 0; $v < 3; $v++) : ?>
                                                <div class="h-menu__section" id="<?php echo $arr1[$v]; ?>" data-title="<?php echo $arrCat1[$v]; ?>">
                                                    <label for="" class="h-menu__headline"><?php echo $arrCat1[$v]; ?></label>
                                                    <div class="row">
                                                        <div class="col-3">
                                                            <a href="product.php" class="stretched-link"></a>
                                                            <img src="./img/menu/img-moto-<?php echo $v + 1 ?>.png" alt="">
                                                            <strong>MT 15</strong>
                                                            <p class="colorGray fz14">From <span class="fz20">69.000.000₫</span></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endfor; ?>

                                            <!-- <div style="height: 50vh"></div> -->
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="h-menu__item h-menu__item--submenu d-lg-flex d-xl-flex d-none">
                    <h6><a href="service.php" class="link">SERVICES</a></h6>
                    <div class="h-menu__submenu">
                        <ul class="h__list">
                            <li><a href="service.php#book-service">
                                    <h5>BOOK A SERVICE</h5>
                                </a></li>
                            <li><a href="service.php#service-plan">
                                    <h5>SERVICE PLAN</h5>
                                </a></li>
                            <li><a href="service.php#rescue-247">
                                    <h5>RESCUE 24/7</h5>
                                </a></li>
                            <li><a href="service.php#warranty-policy">
                                    <h5>WARRANTY & POLICY</h5>
                                </a></li>
                        </ul>
                    </div>
                </li>
                <li class="h-menu__item h-menu__item--submenu d-lg-flex d-xl-flex d-none">
                    <h6><a href="apparel.php" class="link">APPARELS</a></h6>
                    <div class="h-menu__submenu">
                        <ul class="h__list">
                            <li><a href="apparel-cat.php">
                                    <h5>SWEATERS</h5>
                                </a></li>
                            <li><a href="apparel-cat.php">
                                    <h5>T-SHIRT</h5>
                                </a></li>
                            <li><a href="apparel-cat.php">
                                    <h5>PROTECTION INLAYS</h5>
                                </a></li>
                            <li><a href="apparel-cat.php">
                                    <h5>JACKETS</h5>
                                </a></li>
                            <li><a href="apparel-cat.php">
                                    <h5>RIDING GEAR</h5>
                                </a></li>
                            <li><a href="apparel-cat.php">
                                    <h5>VEST</h5>
                                </a></li>
                        </ul>
                    </div>
                </li>
                <li class="h-menu__item d-lg-flex d-xl-flex d-none">
                    <h6><a href="news.php" class="link">NEWS</a></h6>
                </li>
                <li class="h-menu__item">
                    <h6><a href="search.php"><span style="mask-image: url(img/ic_search.svg); -webkit-mask-image: url(img/ic_search.svg)" class="ic-search"></span></a></h6>
                </li>
                <li class="h-menu__item">
                    <a href="#" data-toggle="dropdown" class="nav-item nav-link dropdown-toggle mr-3" >Đăng Ký/ Đăng Nhập</a>

                    <div class="dropdown-menu login-form">
                        <form action="/examples/actions/confirmation.php" method="post">
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" class="form-control" required="required">
                            </div>
                            <div class="form-group">
                                <div class="clearfix">
                                    <label>Password</label>
                                    <a href="#" class="float-right text-muted"><small>Forgot?</small></a>
                                </div>                            
                                <input type="password" class="form-control" required="required">
                            </div>
                            <input type="submit" class="btn btn-primary btn-block" value="Login">
                        </form>					
                    </div>	
                </li>
                <li class="h-menu__item d-flex d-lg-none d-xl-none">
                    <a href="javascript:void(0)" class="icon-menu">
                        <span></span>
                        <span></span>
                    </a>
                </li>
            </ul>
        </div>
    </header>

    <div class="navmenu-accordion">
        <div class="h__accordion">
            <div class="h__accordion-item">
                <a href="index.php" class="btn btn__h-accordion">
                    Home
                </a>
            </div>
        </div>
        <div class="h__accordion">
            <div class="h__accordion-item">
                <a href="javascript:void(0)" class="btn btn__h-accordion open-menu-bikes">
                    BIKES
                    <span class="chevron-right"></span>
                </a>
            </div>
        </div>
        <div class="h__accordion">
            <div class="h__accordion-item">
                <a href="service.php" class="btn btn__h-accordion">
                    SERVICES
                </a>
                <span class="chevron-right collapsed" data-toggle="collapse" data-target="#collapse_h1" aria-expanded="false" aria-controls="collapse1"></span>
            </div>

            <div id="collapse_h1" class="collapse">
                <ul class="h__list">
                    <li><a href="service.php#book-service">
                            BOOK A SERVICE
                        </a></li>
                    <li><a href="service.php#service-plan">
                            SERVICE PLAN
                        </a></li>
                    <li><a href="service.php#rescue-247">
                            RESCUE 24/7
                        </a></li>
                    <li><a href="service.php#warranty-policy">
                            WARRANTY & POLICY
                        </a></li>
                </ul>
            </div>
        </div>
        <div class="h__accordion">
            <div class="h__accordion-item">
                <a href="apparel.php" class="btn btn__h-accordion">
                    APPARELS
                </a>
                <span class="chevron-right collapsed" data-toggle="collapse" data-target="#collapse_h2" aria-expanded="false" aria-controls="collapse1"></span>
            </div>

            <div id="collapse_h2" class="collapse">
                <ul class="h__list">
                    <li><a href="apparel-cat.php">
                            SWEATERS
                        </a></li>
                    <li><a href="apparel-cat.php">
                            T-SHIRT
                        </a></li>
                    <li><a href="apparel-cat.php">
                            PROTECTION INLAYS
                        </a></li>
                    <li><a href="apparel-cat.php">
                            JACKETS
                        </a></li>
                    <li><a href="apparel-cat.php">
                            RIDING GEAR
                        </a></li>
                    <li><a href="apparel-cat.php">
                            VEST
                        </a></li>
                </ul>
            </div>
        </div>
        <div class="h__accordion">
            <div class="h__accordion-item">
                <a href="news.php" class="btn btn__h-accordion">
                    NEWS
                </a>
            </div>
        </div>

        <div style="height: 50px;"></div>

        <div class="d-flex flex-column list-social">
            <span class="colorLGray">Follow us on</span>
            <ul class="h__social">
                <li><a href="#." class=""><span style="mask-image: url(img/ic_fb.svg); -webkit-mask-image: url(img/ic_fb.svg)" class="icon"></span></a></li>
                <li><a href="#." class=""><span style="mask-image: url(img/ic_ins.svg); -webkit-mask-image: url(img/ic_ins.svg)" class="icon"></span></a></li>
                <li><a href="#." class=""><span style="mask-image: url(img/ic_ytb.svg); -webkit-mask-image: url(img/ic_ytb.svg)" class="icon"></span></a></li>
            </ul>
        </div>
    </div>

    <div class="navmenu-drawer">
        <a href="javascript:void(0)" class="back-drawer"></a>

        <div class="navmenu-drawer__sticky">
            <a href="product-list.php#hyper" class="btn btn__h-drawer change-title-js">
                HYPER NAKED
            </a>
        </div>
        <?php $arr = ["hyper", "super", "sport"] ?>
        <?php $arrCat = ["HYPER NAKED", "SUPER SPORT", "SPORT HERITAGE"] ?>
        <?php $arrImg = ["hyper", "super", "super"] ?>
        <div class="navmenu-drawer__content">
            <?php for ($v = 0; $v < 3; $v++) : ?>
                <div class="h__drawer-item" data-title="<?php echo $arrCat[$v]; ?>">
                    <a href="product-list.php#<?php echo $arr[$v] ?>" class="btn btn__h-drawer" aria-expanded="true" aria-controls="collapse">
                        <?php echo $arrCat[$v]; ?>
                    </a>
                    <ul class="h__drawer-list">
                        <?php for ($i = 0; $i < 4; $i++) : ?>
                            <li>
                                <a href="product.php">
                                    <img src="./img/menu/img-moto-<?php echo $arrImg[$v]; ?>-<?php echo $i + 1 ?>.png" alt="">
                                    <div>
                                        <strong>MT 15</strong>
                                        <p class="colorGray fz14">From <span class="fz20">69.000.000₫</span></p>
                                    </div>
                                </a>
                            </li>
                        <?php endfor; ?>
                    </ul>
                </div>
            <?php endfor ?>

            <?php $arr1 = ["adventure", "sport-tour", "scooter"] ?>
            <?php $arrCat1 = ["ADVENTURE TOURING", "SPORT TOURING", "SCOOTER"] ?>
            <?php for ($v = 0; $v < 3; $v++) : ?>
                <div class="h__drawer-item" data-title="<?php echo $arrCat1[$v]; ?>">
                    <a href="product-list.php#<?php echo $arr1[$v] ?>" class="btn btn__h-drawer" aria-expanded="true" aria-controls="collapse">
                        <?php echo $arrCat1[$v]; ?>
                    </a>
                    <ul class="h__drawer-list">
                        <li>
                            <a href="product.php">
                                <img src="./img/menu/img-moto-<?php echo $v + 1 ?>.png" alt="">
                                <div>
                                    <strong>MT 15</strong>
                                    <p class="colorGray fz14">From <span class="fz20">69.000.000₫</span></p>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            <?php endfor ?>
            <!-- <div style="height: 80vh"></div> -->
        </div>
    </div>