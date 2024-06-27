

<?php
get_header();
$id = get_the_ID();
$page_id = get_queried_object_id();

$breadcrumb = [
    "0" => [
        'name' => 'Dịch Vụ',
        'slug'   => '',
        'active' => true,
    ],
    "1" => [
        'name' => get_the_title($page_id),
        'slug'   => '',
        'active' => true,
    ],
];

$term_name = get_the_terms($id, 'cate');
?>

<?php
echo get_template_part('includes/header/header-breadcrumb', 'news', $breadcrumb);
?>

<div class="news news__post-detail">
    <div class="container-fluid">
        <div class="news__container">
            <!-- <label for="" class="news__headline d-lg-none d-md-none d-flex justify-content-between"><?php echo $term_name[0]->name; ?> <span><?php echo get_the_date('d/m/Y', $page_id) ?></span></label> -->
            <div style="height: 16px" class="d-lg-none d-md-none d-block"></div>
            <div style="height: 24px" class="d-lg-block d-md-block d-none"></div>
            <h3 class="ff-1 colorDark title-news"><?php echo get_the_title($page_id); ?></h3>
            <div style="height: 16px" class="d-lg-block d-md-block d-none"></div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="wrapper-container">
        <div class="news__para news__container">
                <?php echo get_the_content(); ?>
            </div>
            <div style="height: 32px;" class="d-lg-block d-xl-block d-none"></div>
            <div style="height: 40px;" class="d-block d-lg-none d-xl-none"></div>
        </div>
    </div>
    
</div>



<script type="text/javascript">
    $(document).ready(function() {

        $(".news__info-item").on("click", function(e) {
            e.preventDefault;
        })
    });
</script>

<?php
get_footer();
