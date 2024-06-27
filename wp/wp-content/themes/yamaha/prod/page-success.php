<?php
get_header();

$title = 'Đặt hàng thành công!';
$message = 'Cám ơn bạn đã đặt hàng, nhân viên chăm sóc khách hàng sẽ liên hệ với bạn trong thời gian sớm nhất';

if (isset($_GET['title'])) {
    $title = $_GET['title'];
}

if (isset($_GET['message'])) {
    $message = $_GET['message'];
}
?>

<?php
echo get_template_part('includes/header/header-no-toolbar');
?>

<div class="container-fluid">
    <div class="wrapper-container wrapper-container--sm">
        <div style="height: 146px" class="d-lg-block d-md-block d-none"></div>
        <div style="height: 80px" class="d-lg-none d-md-none d-block"></div>
        <div class="text-center colorGray complete-content">
            <img src="<?php echo get_template_directory_uri() ?>/img/checkmark-square.svg" alt="">
            <div style="height: 22px"></div>
            <strong class="title"><?php echo $title; ?></strong>
            <div style="height: 8px"></div>
            <div class="message"><?php echo $message; ?></div>
            <div style="height: 24px"></div>
            <a href="<?php echo get_permalink(5) ?>" class="btn-clip btn-red" style="min-width: 140px"> Trở về trang chủ</a>
        </div>
        <div style="height: 146px"></div>
    </div>
</div>

<?php
get_footer();
?>