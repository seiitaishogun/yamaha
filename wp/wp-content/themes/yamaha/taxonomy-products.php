<?php
get_header();
// $page_id = get_the_ID();
$page_id = get_queried_object_id();

$breadcrumb = [
    "0" => [
        'name' => 'MÔ TÔ',
        'slug'   => '',
        'active' => true,
    ]
];

$categories = get_terms(array(
    'taxonomy' => 'products',
    'hide_empty' => false,
));

$terms = get_term_by('id', $page_id, 'products');

$trim_name = str_replace(" ", "", $terms->name);
?>

<?php
echo get_template_part('includes/header/header-breadcrumb', 'products', $breadcrumb);
?>

<div class="container-fluid px-lg-3 px-0">
    <div class="product__banner"></div>

    <div style="height: 12px;" class="d-lg-block d-xl-block d-none"></div>

    <div class="category-menu__moto">
        <div class="row">
            <?php $default = ''; ?>

            <div class="category-menu__nav">
                <div class="category-menu__nav-stick">
                    <label for="" class="category-menu__headline">MÔ TÔ</label>
                    <ul class="category-menu__category">
                        <?php $count_check = 0; ?>
                        <?php foreach ($categories as $key => $_m) : ?>
                            <?php
                            $status = get_field('status_category', $_m);
                            if ($status > 0) :
                                $count_check++;
                                if ($count_check == 1) {
                                    $default = $_m->name;
                                }
                            ?>
                                <li class="<?php echo $count_check === 1 ? 'active' : '' ?>" data-scroll="#sec-<?php echo str_replace(" ", "", $_m->name); ?>">
                                    <span><?php echo $_m->name; ?></span>
                                    <div class="line"></div>
                                </li>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
            <div class="category-menu__list-item">
                <div class="category-menu__sticky">
                    <label for="" class="category-menu__headline category-change-title-js"><?php echo $default; ?></label>
                </div>
                <div class="category-menu__wrapper">
                    <div class="category-menu__content">
                        <?php foreach ($categories as $key => $_m) : ?>
                            <?php

                            $args = array(
                                'post_type' => 'product',
                                'post_status' => 'publish',
                                'tax_query' => array(
                                    array(
                                        'taxonomy' => 'products',
                                        'field' => 'term_id',
                                        'terms' => $_m->term_taxonomy_id,
                                    )
                                )
                            );
                            $query = new WP_Query($args);
                            $posts = $query->posts;
                            $status = get_field('status_category', $_m);

                            if ($status > 0) :
                            ?>
                                <div class="category-menu__section" id="sec-<?php echo str_replace(" ", "", $_m->name); ?>" data-title="<?php echo $_m->name; ?>">
                                    <label for="" class="category-menu__headline"><?php echo $_m->name; ?></label>
                                    <div class="row">
                                        <?php
                                        $count = 0;
                                        foreach ($posts as $post) : ?>
                                            <?php
                                            $group = get_field("feature_product", $post->ID);
                                            $price = $group['feature_price'];
                                            $count++;
                                            if ($count < 5) :
                                            ?>

                                                <div class="col-3">
                                                    <a href="<?php echo get_permalink(); ?>" class="stretched-link"></a>
                                                    <img src="<?php echo $group['feature_img']; ?>" alt="">
                                                    <strong><?php echo get_the_title(); ?></strong>
                                                    <p class="colorGray fz14">Giá từ <span class="fz20"><?php echo currencyFormat($price); ?></span></p>
                                                </div>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid d-lg-none d-xl-none d-block">

        <div class="nav-menu__content">
            <?php foreach ($categories as $key => $_m) : ?>
                <?php

                $args_mb = array(
                    'post_type' => 'product',
                    'post_status' => 'publish',
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'products',
                            'field' => 'term_id',
                            'terms' => $_m->term_taxonomy_id,
                        )
                    )
                );
                $query_mb = new WP_Query($args_mb);
                $posts_mb = $query_mb->posts;
                $status = get_field('status_category', $_m);

                if ($status > 0) :
                ?>
                    <a href="javascript:void(0)" class="btn btn__h-drawer" id="sec-mb-<?php echo str_replace(" ", "", $_m->name); ?>" aria-expanded="true" aria-controls="collapse">
                        <?php echo $_m->name; ?>
                    </a>
                    <ul class="h__drawer-list">
                        <?php
                        $count_mb = 0;
                        foreach ($posts_mb as $post) {
                            $group = get_field("feature_product", $post->ID);
                            $price = $group['feature_price'];
                            $count_mb++;
                            if ($count_mb < 5) { ?>
                                <li>
                                    <a href="<?php echo get_permalink($post->ID) ?>">
                                        <img src="<?php echo $group['feature_img']; ?>" alt="">
                                        <div>
                                            <strong class="fz16"><?php echo get_the_title(); ?></strong>
                                            <p class="colorGray fz14">Giá từ <span class="fz14"><?php echo currencyFormat($price) ?></span></p>
                                        </div>
                                    </a>
                                </li>
                        <?php }
                        } ?>
                    </ul>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>

    </div>

    <div style="height: 400px;" class="d-lg-block d-xl-block d-none"></div>
    <div style="height: 60px;" class="d-block d-lg-none d-xl-none"></div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        PageFunction.products();


        if ($(window).width() < 992) {
            console.log("aaaa");
            $('html, body').animate({
                scrollTop: $('#sec-mb-<?php echo $trim_name; ?>').offset().top - 100
            }, 500);
        } else {
            $('html, body').animate({
                scrollTop: $('#sec-<?php echo $trim_name; ?>').offset().top - 100
            }, 500);
        }
    });
</script>
<?php
get_footer();
