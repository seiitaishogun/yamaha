<?php
get_header();
$page_id = get_queried_object_id();

?>

<div class="navigator__breadcrumbs">
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo get_permalink(5) ?>">TRANG CHỦ</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo get_the_title($page_id); ?></li>
            </ol>
        </nav>
    </div>
</div>

<div class="policy">
    <div class="container-sm">
        <div class="row">
            <div class="left-content">
                <ul class="list-item">
                    <li data-title="Điều Khoản Sử Dụng"><a href="<?php the_permalink(496) ?>">Điều Khoản Sử Dụng</a></li>
                    <li data-title="Chính Sách Bảo Mật"><a href="<?php the_permalink(494) ?>">Chính Sách Bảo Mật</a></li>
                    <li data-title="Chính Sách Cookies" class="active"><a href="<?php the_permalink(498) ?>">Chính Sách Cookies</a></li>
                    <li data-title="Chính Sách Đổi Trả"><a href="<?php the_permalink(500) ?>">Chính Sách Đổi Trả</a></li>
                </ul>
            </div>
            <div class="right-content">
                <div class="list-policy">
                    <div class="item">
                        <?php echo get_field('content', 496); ?>
                    </div>
                    <div class="item">
                        <?php echo get_field('content', 494); ?>
                    </div>
                    <div class="item show">
                        <?php echo get_field('content', 498); ?>
                    </div>
                    <div class="item">
                        <?php echo get_field('content', 500); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {

        $('.policy .list-item a').click(function(e) {
            e.preventDefault();
            var $index = $(this).parent().index();
            var $item = $('.list-policy .item');
            var $title = $(this).parent().attr("data-title");

            $(".breadcrumb-item.active").text($title);
            $('.policy .list-item li').removeClass('active');
            $(this).parent().addClass('active');

            $item.removeClass('show');
            $item.eq($index).addClass('show');
        });

        $('.collapse-item .title-sm').click(function() {
            if ($(window).width() < 768) {
                $(this).parent().toggleClass('active').siblings().removeClass('active');
            }
        });
    });
</script>

<?php
get_footer();
?>