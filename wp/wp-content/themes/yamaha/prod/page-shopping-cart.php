<?php
get_header();

// $term = get_queried_object();

// $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

// $args = array(
//     'post_type' => 'item',
//     'paged' => $paged,
//     'post_status' => 'publish',
//     'posts_per_page' => 10,
//     'meta_key' => 'price',
//     'orderby' => 'meta_value_num',
//     'order' => 'ASC',
//     'tax_query' => array(
//         array(
//             'taxonomy' => 'apparels',
//             'field' => 'slug',
//             'terms' => $term->slug,
//         ),
//     )
// );

// $query = new WP_Query($args);

// $posts = $query->posts;

// $count = $query->post_count;

// $terms = get_terms([
//     'taxonomy' => "apparels",
//     'hide_empty' => false,
// ]);

?>

<?php echo get_template_part('includes/header/header-toolbar'); ?>

<div class="navigator__breadcrumbs">
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">TRANG CHỦ</a></li>
                <li class="breadcrumb-item"><a href="">SHOPPING CART</a></li>
                
            </ol>
        </nav>
    </div>
</div>

<section class="cat-banner" style="background-color: #E5E5E5;">
    <div class="container-fluid">
      
            <picture>
                <source media="(min-width:768px)" srcset="<?php echo $banner; ?>">
                <img src="<?php echo get_template_directory_uri();?>/img/sweaters/banner.jpg" alt="" class="d-block w-100" />
            </picture>
            <div class="cat-banner__caption">
                <h1>Giỏ hàng</h1>
            </div>
       
    </div>
</section>

<section class="shopping-cart">
    <div class="container-fluid">
    <div class="spacer-50"></div>
        <div class="item-shopping-cart">
            <div class="item-cart-img"><img src="<?php echo get_template_directory_uri();?>/img/compare/img-bike-1.png" alt=""/></div>
            
            <div class="item-cart-detail-box">
                <div class="item-cart-info-box">
                    <div class="item-cart-detail-info">
                        <p class="name fnt-oswald">MT-09 Storm Fluo</p>
                        <p class="showroom">showroom abc</p>
                        <a href="">Delete</a>
                    </div>
                    <div class="item-cart-detail-price">
                        <p class="label">Giá</p>
                        <p class="item-price fnt-oswald">990.000.000đ</p>
                        <p class="deposit">(10.000.000Đ Deposit)</p>
                    </div>
                    <div class="item-cart-detail-quantity p-detail-quantity fnt-oswald">
                    
                    <button type="button" class="btn btn-link shadow-none text-decoration-none btn-mins">-</button>
                    <div class="quantity">01</div>
                    <button type="button" class="btn btn-link shadow-none text-decoration-none btn-plus">+</button>
                    </div>
                </div>
                <hr>
                <div class="item-cart-total-box">
                    <p>Total</p>
                    <p class="total-price">99.000.000đ</p>
                </div>
            </div>
            
        </div>
        <div class="spacer-20"></div>
        <div class="item-shopping-cart">
            <div class="item-cart-img"><img src="<?php echo get_template_directory_uri();?>/img/apparel/product-10.jpg" alt=""/></div>
            
            <div class="item-cart-detail-box">
                <div class="item-cart-info-box">
                    <div class="item-cart-detail-info">
                        <p class="name fnt-oswald">YAMAHA PADDOCK FACTORY RACING MONTER POLO</p>
                        <p class="showroom">showroom abc</p>
                        <a href="">Delete</a>
                    </div>
                    <div class="item-cart-detail-price">
                        <p class="label">Giá</p>
                        <p class="item-price fnt-oswald">990.000.000đ</p>
                        <!-- <p class="deposit">(10.000.000Đ Deposit)</p> -->
                    </div>
                    <div class="item-cart-detail-quantity p-detail-quantity fnt-oswald">
                    
                    <button type="button" class="btn btn-link shadow-none text-decoration-none btn-mins">-</button>
                    <div class="quantity">01</div>
                    <button type="button" class="btn btn-link shadow-none text-decoration-none btn-plus">+</button>
                    </div>
                </div>
                <hr>
                <div class="item-cart-total-box">
                    <p>Total</p>
                    <p class="total-price">99.000.000đ</p>
                </div>
            </div>
            
        </div>

        <div class="spacer-20"></div>

        <div class="total-price-box">
            <p>Total</p>
            <p class="total-price">99.000.000đ</p>
            <hr class="hr-custom">
            <a href="" id="check-out" class="btn-clip btn-red">CHECK OUT &nbsp<i class="fas fa-chevron-right" style="color:white;"></i></a>
            
        </div>
        <a><i class="fas fa-chevron-left"></i>&nbsp<i class="fas fa-chevron-left"></i>&nbspContinue Shopping</a>
    </div>
    <div class="spacer-50"></div>
</section>




<script src="<?php echo get_template_directory_uri() ?>/js/my-work.js?v=<?php echo time(); ?>"></script>
<?php
get_footer();
