<?php include "includes/header_no_toolbar.php" ?>

<section class="buy-apparel done">
    <div class="buy-apparel__wrapper">
        <div class="buy-apparel__title">
            <img class="arrow-left" src="./img/buy-apparel/arrow-left.svg" alt="" />
            <h3>BUY APPAREL</h3>
        </div>
        <div class="done-content">
            <img src="./img/buy-apparel/checkmark.svg" alt="" />
            <h5>Congratulations!</h5>
            <p>Your submission was sent successfully. We will contact you via email <strong>an.nguyen@email.com</strong> and your phone number <strong>0985123456</strong> to confirm your order. Thank you!</p>
        </div>
        <div class="product-summary">
            <div class="footer-form">
                <a href="index.php" class="btn-clip btn-red">RETURN TO HOMEPAGE</a>
            </div>
        </div>
    </div>
</section>

<script>
    $('.navigator__back').css({
        display: 'none'
    });
    $(".h-box.gradient").css({
        background: 'black'
    });
</script>

<?php include "includes/footer.php" ?>