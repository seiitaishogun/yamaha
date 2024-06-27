<div class="navigator__back">
    <div class="container-fluid">
        <div class="headline-bar-center">
            <a href="#." onclick="window.history.back()"><span class="ico__chev-left"></span> Trở lại <div></div></a>
            <?php
            if ($args['title']) {
                echo '<h5 class="ff-1 colorDark text-uppercase align-self-center">' . $args['title'] . '</h5>';
            }
            ?>
            <span></span>
        </div>
    </div>
</div>