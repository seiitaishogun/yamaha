<?php include "includes/header.php" ?>

<div class="navigator__breadcrumbs">
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">BIKES</li>
            </ol>
        </nav>
    </div>
</div>

<section class="cat-banner banner-single">
    <div class="container-fluid">
        <picture>
            <source media="(min-width:768px)" srcset="./img/product-list/img-banner-bike.jpg">
            <img src="./img/product-list/img-banner-bike.jpg" alt="" class="d-block w-100"/>
        </picture>
    </div>
</section>

<div class="product-bike-list">
    <div class="category-menu__moto">
        <div class="container-fluid">
            <div class="row">
                <div class="category-menu__nav">
                    <div class="category-menu__nav-stick">
                        <label for="" class="category-menu__headline">BIKE CATEGORIES</label>
                        <ul class="category-menu__category">
                            <?php $arrTitle = ["HYPER NAKED", "SUPER SPORT", "SPORT HERITAGE", "ADVENTURE TOURING", "SPORT TOURING", "SCOOTER"] ?>
                            <?php $arrId = ["sec-hyper", "sec-super", "sec-sport", "sec-adventure", "sec-sport-tour", "sec-scooter"] ?>
                            <?php for ($v = 0; $v < 6; $v++) : ?>
                                <li class="<?php echo $v === 0 ? 'active' : '' ?>" data-scroll="#<?php echo $arrId[$v]; ?>">
                                    <span><?php echo $arrTitle[$v] ?></span>
                                    <div class="line"></div>
                                </li>
                            <?php endfor; ?>
                        </ul>
                    </div>
                </div>
                <div class="category-menu__list-item">
                    <!-- ////// -->
                    <div class="category-menu__sticky">
                        <label for="" class="category-menu__headline change-title-js">HYPER NAKED</label>
                    </div>
                    <!-- ////// -->
                    <div class="category-menu__wrapper">
                        <div class="category-menu__content">
                            <?php $arr = ["sec-hyper", "sec-super", "sec-sport"] ?>
                            <?php $arrCat = ["HYPER NAKED", "SUPER SPORT", "SPORT HERITAGE"] ?>
                            <?php $arrImg = ["hyper", "super", "super"] ?>
                            <?php for ($v = 0; $v < 3; $v++) : ?>
                                <div class="category-menu__section" id="<?php echo $arr[$v]; ?>" data-title="<?php echo $arrCat[$v]; ?>">
                                    <label for="" class="category-menu__headline"><?php echo $arrCat[$v]; ?></label>
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
                            <?php $arr1 = ["sec-adventure", "sec-sport-tour", "sec-scooter"] ?>
                            <?php $arrCat1 = ["ADVENTURE TOURING", "SPORT TOURING", "SCOOTER"] ?>
                            <?php for ($v = 0; $v < 3; $v++) : ?>
                                <div class="category-menu__section" id="<?php echo $arr1[$v]; ?>" data-title="<?php echo $arrCat1[$v]; ?>">
                                    <label for="" class="category-menu__headline"><?php echo $arrCat1[$v]; ?></label>
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
    <div class="navmenu-drawer">
        <a href="javascript:void(0)" class="back-drawer"></a>

        <div class="navmenu-drawer__sticky">
            <a href="#." class="btn btn__h-drawer change-title-js">
                HYPER NAKED
            </a>
        </div>
        <?php $arr = ["hyper", "super", "sport"] ?>
        <?php $arrCat = ["HYPER NAKED", "SUPER SPORT", "SPORT HERITAGE"] ?>
        <?php $arrImg = ["hyper", "super", "super"] ?>
        <div class="navmenu-drawer__content">
            <?php for ($v = 0; $v < 3; $v++) : ?>
                <div class="h__drawer-item" id="<?php echo $arr[$v]; ?>" data-title="<?php echo $arrCat[$v]; ?>">
                    <a href="product.php" class="btn btn__h-drawer" aria-expanded="true" aria-controls="collapse">
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
                <div class="h__drawer-item" id="<?php echo $arr1[$v]; ?>" data-title="<?php echo $arrCat1[$v]; ?>">
                    <a href="product.php" class="btn btn__h-drawer" aria-expanded="true" aria-controls="collapse">
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
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $(".h-box.gradient").css({
            background: '#1D1F21'
        });

        PageFunction.products();
    });
</script>

<?php include "includes/footer.php" ?>