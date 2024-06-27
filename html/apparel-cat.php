<?php include "includes/header.php" ?>

<?php
$cats = [
    'SWEATERS (10)',
    'T-SHIRT (16)',
    'PROTECTION INLAYS (4)',
    'JACKETS (8)',
    'RIDING GEAR (6)',
    'VEST (4)'
];
?>

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

<section class="cat-banner">
    <div class="container-fluid">
        <picture>
            <source media="(min-width:768px)" srcset="./img/sweaters/banner.jpg">
            <img src="./img/sweaters/banner_sp.jpg" alt="" class="d-block w-100" />
        </picture>
        <div class="cat-banner__caption">
            <h1>Sweaters</h1>
        </div>
    </div>
</section>


<section class="hot-items">
    <div class="container-fluid">
        <div class="hot-items__title">
            <h3>10 items</h3>
            <div class="list-dropdown d-flex align-items-center">
                <div class="dropdown">
                    <button type="button" class="btn btn-filter dropdown-toggle" id="dropdownMenuOffset" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Price: low to high
                    </button>
                    <div class="dropdown-menu dropdown-red dropdown-menu-right" aria-labelledby="dropdownMenuOffset">
                        <a class="dropdown-item" href="#">Price: low to high</a>
                        <a class="dropdown-item" href="#">Price: high to low</a>
                    </div>
                </div>
                <div class="dropdown">
                    <button type="button" class="btn btn-filter dropdown-toggle" id="dropdownMenuOffset" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        T-Shirt
                    </button>
                    <div class="dropdown-menu dropdown-red dropdown-menu-right" aria-labelledby="dropdownMenuOffset">
                        <a class="dropdown-item" href="#">Sweaters (10)</a>
                        <a class="dropdown-item" href="#">T-Shirt (16)</a>
                        <a class="dropdown-item" href="#">Protection inlays (4)</a>
                        <a class="dropdown-item" href="#">Jeackets (8)</a>
                        <a class="dropdown-item" href="#">Riding Gear (6)</a>
                        <a class="dropdown-item" href="#">Vest (4)</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="product-list">
            <?php
                for ($i = 1; $i <= 30; $i++) :
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
        <!-- <div class="text-center">
            <a href="javascript: void(0);" onclick="loadMore()" class="btn--border-red fz14 bold text-uppercase d-inline-flex justify-content-center btn-exp-more red">
                LOAD MORE
            </a>
        </div> -->

        <div class="text-center">
            <a href="javascript: void(0);" onclick="loadMore()" id="loadmore" class="btn-clip btn-border-red w-auto">LOAD more</a>
        </div>
    </div>
</section>

<script>
    $(".h-box.gradient").css({background: '#1D1F21'});
    
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
                document.querySelector(".product-list").append(createProduct())
            }

            loader.classList.remove("show")
        }, 1000);
    }
</script>

<?php include "includes/footer.php" ?>