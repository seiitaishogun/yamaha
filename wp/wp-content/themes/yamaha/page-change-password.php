<?php
/**
 * @author HUNG VO
 * created Date: 10/12/2021
 * project: yamaha-revzone-website
 *
 * Template Name: Change New Pass
 *
 */

get_header();

?>

<section class="container-fluid min-vh-100">
    <div style="margin-top: 166px;"></div>
    <div class="row justify-content-center">
        <div class="col-12 col-lg-6 reset-pw">
            <img src="<?php echo get_template_directory_uri();?>/img/reset-pw/change-pw.svg" alt=""/>
            <p class="fz-20 fw-600 mt-3">Vui lòng nhập mật khẩu mới của bạn!</p>
            <input class="border w-100 mb-3" type="password" name="" id="" placeholder="Mật khẩu mới">
            <input class="border w-100" type="password" name="" id="" placeholder="Nhập lại mật khẩu mới">
            <div class="my-5">
                <a href="javascript:void(0)" class="btn-clip btn-red" >Cập nhật</a>
            </div>
        </div>
    </div>
</section>
<?php // --------------------------------------Success Change password------------------------------------------------- ?>
<section class="container-fluid min-vh-100">
    <div style="margin-top: 166px;"></div>
    <div class="row justify-content-center">
        <div class="col-12 col-lg-6 reset-pw">
            <img src="<?php echo get_template_directory_uri();?>/img/reset-pw/checkmark-square.svg" alt=""/>
            <p class="fz-20 fw-600 mt-3">Cập nhật mật khẩu thành công!</p>
            <p class="text-success px-5">Bạn đã cập nhật mật khẩu mới thành công. Vui lòng quay lại màn hình <a style="color: #0A2D82;font-weight: 600; border-bottom: 1px solid #0A2D82;" class="" href="">đăng nhập</a> để truy cập website</p>
            <div class="my-5">
                <a href="javascript:void(0)" class="btn-clip btn-red" >quay trở lại trang chủ</a>
            </div>
        </div>
    </div>
</section>


<?php
get_footer();
