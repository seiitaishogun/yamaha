<?php include "includes/header/header_start.php"; ?>

<div class="navigator__breadcrumbs">
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Library</a></li>
                <li class="breadcrumb-item active" aria-current="page">Data</li>
            </ol>
        </nav>
    </div>
</div>

<ul class="toolbar-nav">
    <?php
    $arr = ["Test Ride", "Find a Dealer", "Book Service", "Live chat"];
    for ($v = 1; $v <= 4; $v++) : ?>
        <li class="toolbar-nav__<?php echo $v?>">
            <a href="#.">
                <span style="mask-image: url(img/ic_tool<?php echo $v; ?>.svg); -webkit-mask-image: url(img/ic_tool<?php echo $v; ?>.svg)" class="icon"></span> <span class="text"><?php echo $arr[$v - 1]; ?></span>
            </a>
        </li>
    <?php endfor ?>
</ul>

<?php include "includes/header/header_end.php" ?>