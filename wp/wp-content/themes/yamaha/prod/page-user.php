<?php
/**
 * @author HUNG VO
 * created Date: 10/12/2021
 * project: yamaha-revzone-website
 *
 * Template Name: Profile User
 *
 */

get_header();

if(!is_user_logged_in()){
	 
	echo '<script> $(document).ready(function() { 
			show_popup_login(); $(".login-wrapped").addClass("mrcenter");
		});
		</script>'; 
}
if(isset($_GET['ui']) && !empty($_GET['ui']) && isset($_GET['tk']) && !empty($_GET['tk']) ){
    // die();
    $us = get_user_by( 'ID', $_GET['ui'] );
    if($us && $us->user_activation_key == $_GET['tk']){
        $dataus = array(
            'ID' => $us->ID, 
            'user_activation_key' => '',
        );        
        wp_update_user($dataus);

        if(is_user_logged_in()){
        wp_redirect(get_site_url()."/user/#user-info" );
            //exit;
           // header("Location: ".get_site_url()."/user/#user-info"); 
            //die();
        }
    } 
}

if(is_user_logged_in()){
?>

<div class="navigator__breadcrumbs">
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">TRANG CHỦ</a></li>
                <li class="breadcrumb-item"><a class="font-weight-bold" href="">USER</a></li>
                <li class="breadcrumb-item"><a class="font-weight-bold text-dark title-tab-user" href="">USER</a></li>
                
            </ol>
        </nav>
    </div>
</div>

<section class="cat-banner banner-user" >
    <div class="container-fluid">
      
            <picture>
                <source media="(min-width:768px)" srcset="<?php echo $banner; ?>">
                <img src="<?php echo get_template_directory_uri();?>/img/sweaters/banner.jpg" alt="" class="d-block w-100" />
            </picture>
            <div class="cat-banner__caption">
                <h1 class="title-tab-user">THÔNG TIN CÁ NHÂN</h1>
            </div>
    </div>
</section>

<section class="my-account">
    <div class="container-fluid">
            <div class="main-info">
                <nav>
                    <div class="nav nav-tabs" id="nav-tab-user" role="tablist">
                        <a class="nav-link" id="user-info-tab" data-toggle="tab" href="#user-info" role="tab" aria-controls="user-info" aria-selected="false"><i class="fas fa-user"></i>Thông tin cá nhân</a>
                        <a class="nav-link" id="check-order-tab" data-toggle="tab" href="#check-order" role="tab" aria-controls="check-order" aria-selected="false"><i class="fas fa-truck"></i>Theo dõi đơn hàng</a>
                        <a class="nav-link" id="history-order-tab" data-toggle="tab" href="#history-order" role="tab" aria-controls="history-order" aria-selected="false"><i class="fas fa-clock"></i>Lịch sử đơn hàng</a>
                        <a class="nav-link" id="list-address-tab" data-toggle="tab" href="#list-address" role="tab" aria-controls="list-address" aria-selected="false"><i class="fas fa-map-marker-alt"></i>Sổ địa chỉ</a>
                        <a class="nav-link" id="wishlist-tab" data-toggle="tab" href="#wishlist" role="tab" aria-controls="wishlist" aria-selected="false"><i class="fas fa-heart"></i>Sản phẩm yêu thích</a>
                        
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade" id="user-info" role="tabpanel" aria-labelledby="user-info-tab">
                        <?php require_once( CCMS_ABSPATH.'/html/customer/profile.php' ); ?>
                    </div>
                    <div class="tab-pane fade" id="check-order" role="tabpanel" aria-labelledby="check-order-tab">
                    <?php require_once( CCMS_ABSPATH.'/html/customer/my-orders.php' ); ?>
                    </div>
                    <div class="tab-pane fade" id="history-order" role="tabpanel" aria-labelledby="history-order-tab">
                        <?php require_once( CCMS_ABSPATH.'/html/order-list.php' ); ?>
                    </div>
                    <div class="tab-pane fade" id="list-address" role="tabpanel" aria-labelledby="list-address-tab">
                        <?php require_once( CCMS_ABSPATH.'/html/customer/address-book.php' ); ?>
                    </div>
                    <div class="tab-pane fade" id="wishlist" role="tabpanel" aria-labelledby="wishlist-tab">
                        <?php require_once( CCMS_ABSPATH.'/html/customer/my-wishlist.php' ); ?>
                    </div>
                </div>
            </div>
    </div>
    <div class="spacer-50"></div>
</section>
<script type="text/javascript">
    $("document").ready(function() {
        $('#nav-tab-user > a[href="' + window.location.hash + '"]').tab('show');
        $(window).on('hashchange', function () {
            $('#nav-tab-user > a[href="' + window.location.hash + '"]').tab('show');
        });
        var title = $('.title-tab-user');
        var bg_need = $('.banner-user, .my-account');
        switch(window.location.hash) {
                case '#user-info':
                    title.text('Thông tin cá nhân');
                    break;
                case '#check-order':
                    title.text('Kiểm tra đơn hàng');
                    break;
                case '#history-order':
                    title.text('Lịch sử đơn hàng');
                    if(!bg_need.hasClass("bg-user-grey")){
                        bg_need.addClass("bg-user-grey");
                    }
                    break;
                case '#list-address':
                    title.text('Sổ địa chỉ');
                    if(!$('.create-address-book-page').is(':visible')){
                        $('.create-address-book-page').hide();
                        $('.address-book-page').show();
                    }
                    break;
                case '#wishlist':
                    title.text('Sản phẩm yêu thích');
                    if(!bg_need.hasClass("bg-user-grey")){
                        bg_need.addClass("bg-user-grey");
                    }
                    break;
                default:
                    $('#user-info-tab').click();
                    title.text('Thông tin cá nhân');
            }
        $('#nav-tab-user > a[data-toggle="tab"]').on('show.bs.tab', function(e) {
            var tabSelected = $(this).attr('href');
            
           
            bg_need.removeClass("bg-user-grey");
            window.location.hash = tabSelected;
            switch(tabSelected) {
                case '#user-info':
                    title.text('Thông tin cá nhân');
                    break;
                case '#check-order':
                    title.text('Kiểm tra đơn hàng');
                    break;
                case '#history-order':
                    title.text('Lịch sử đơn hàng');
                    if(!bg_need.hasClass("bg-user-grey")){
                        bg_need.addClass("bg-user-grey");
                    }
                    break;
                case '#list-address':
                    title.text('Sổ địa chỉ');
                    if(!$('.create-address-book-page').is(':visible')){
                        $('.create-address-book-page').hide();
                        $('.address-book-page').show();
                    }
                    break;
                case '#wishlist':
                    title.text('Sản phẩm yêu thích');
                    if(!bg_need.hasClass("bg-user-grey")){
                        bg_need.addClass("bg-user-grey");
                    }
                    break;
                default:
                    title.text('');
            }
            
            var width = $(window).width();
            if(width <= 768){
                $('.my-account .main-info .nav').removeClass('mbactive');
            }            
            });
            $( ".my-account .main-info .nav" ).on( "click", ".nav-link.active", function() {
                var width = $(window).width();
                if(width <= 768){
                    $('.my-account .main-info .nav').addClass('mbactive');
            }
        });
        
    });
</script>

<?php } ?>

<script src="<?php echo get_template_directory_uri() ?>/js/my-work.js?v=<?php echo time(); ?>"></script>
<?php
get_footer();
