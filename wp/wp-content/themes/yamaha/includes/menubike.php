<?php

$categories = get_terms(array(
    'taxonomy' => 'categories',
    'hide_empty' => false,
));
$cates = array();
foreach ($categories as $k => $c) {
    $cates[$c->parent][] = $c;
}

$args = array(
    'post_type' => 'product',
    'paged' => 1,
    'post_status' => 'publish',
    'posts_per_page' => '20',
    'suppress_filters' => true
);

$the_query = new WP_Query($args);

$posts = $the_query->posts;


$categories_slugs = wp_list_pluck($categories, 'slug');
$categories_names = wp_list_pluck($categories, 'name');


// print_r($posts);
// die;

?>
<div class="container-fluid">
    <div class="row">
        <div class="h-menu__nav" style="width: 256px">
            <label for="" class="h-menu__headline">BIKE CATEGORIES</label>
            <ul class="h-menu__category" id="scrollby">
                <?php $arrTitle = ["HYPER NAKED", "SUPER SPORT", "SPORT HERITAGE", "ADVENTURE TOURING", "SPORT TOURING", "SCOOTER"] ?>
                <?php $arrId = ["HYPER", "SUPER", "SPORT", "ADVENTURE", "SPORT-TOUR", "SCOOTER"] ?>
                <ul class="h-menu__category" id="scrollby">
                    <?php foreach ($categories_names as $k => $v) : ?>
                        <li class="<?php echo $k == 0 && "active" ?>" data-scroll="#<?php echo str_replace(' ', '', $v); ?>">
                            <span><?php echo $v; ?></span>
                            <div class="line"></div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </ul>
        </div>

        <div class="h-menu__list-item">
            <!-- ////// -->
            <div class="h-menu__sticky">
                <label for="" class="h-menu__headline change-title-js">HYPER NAKED</label>
            </div>
            <!-- ////// -->
            <div class="h-menu__wrapper">
                <div class="h-menu__content">
                    <?php foreach ($posts as $post) : ?>

                        <?php
                        $term_name = get_the_terms($post->ID, 'categories');
                        ?>

                        <div class="h-menu__section" id="<?php echo str_replace(' ', '', $term_name[0]->name); ?>" data-title="<?php echo $term_name[0]->name; ?>">
                            <label for="" class="h-menu__headline"><?php echo $term_name[0]->name; ?></label>
                            <div class="row">
                                <div class="col-3">
                                    <a href="#." class="stretched-link"></a>
                                    <img src="<?php echo get_template_directory_uri() ?>/img/moto.png" alt="">
                                    <strong><?php the_title(); ?></strong>
                                    <p class="colorGray fz14">From 69.000.000 ₫</p>
                                </div>
                            </div>
                        </div>

                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>