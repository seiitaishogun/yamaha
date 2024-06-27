<?php
/* Template Name: wishlist */

get_header();
// $page_id = get_the_ID();
$page_id = get_queried_object_id();

$breadcrumb = [
    "0" => [
        'name' => 'DANH SÁCH YÊU THÍCH',
        'slug'   => '',
        'active' => true,
    ]
];

//$user_wishlist = new UserFavorites();

$us_wishlist = get_user_favorites($user_id = null, $site_id = null, $filters = null);

if(!isset($_COOKIE['simplefavorite'])) {
	$cookie = json_decode(stripslashes($_COOKIE['simplefavorites']), true);
	 
} 
 

$wishlist = get_user_favorites_list($user_id = null, $site_id = null, $include_links = true, $filters = null, $include_button = false, $include_thumbnails = true, $thumbnail_size = 'thumbnail', $include_excerpt = false);


?>

<?php
//echo  get_template_part('includes/header/header-breadcrumb', 'products', $breadcrumb);?>

<?php echo get_template_part('includes/header/header-toolbar'); ?>

<?php 
$banner = get_field("banner_header", $page_id);



if ($banner) :
?>

    <div class="banner banner__product banner-full" style="background-image: url(<?php echo $banner['image'] ?>);">
         
        <div class="banner-inner">
            <div class="text-content">
                <div class=""><?php echo $banner['title'];  ?></div>
                <h1 class="exbold ff-1"><?php echo get_the_title($page_id); ?></h1>
                <button type="button" class="btn--scrolldown click-next-section" data-pos="#next"><img src="<?php echo get_template_directory_uri() ?>/img/ic_long-down.svg" alt=""></button>
            </div>
        </div>
    </div>
<?php endif; ?>

<section class="hot-items "  id="next">
    <div class="container-fluid px-md-0">
        <div class="hot-items__title">
            <h3>SẢN PHẨM YÊU THÍCH</h3>
        </div>
         <div class="container-fluid d-lg-block d-xl-block d-block">
               <?php  //print_r($us_wishlist); 
			if ($us_wishlist) : ?>
				<ul class="h__drawer-list">
				<?php 
				$posts = $us_wishlist ;

					foreach ($posts as $k => $item) :

					$group = get_field("feature_product", $item);
							$price = $group['feature_price'];
							$count_mb++;
							if ($count_mb < 5) { ?>
								<li>
									<a href="<?php echo get_permalink($item) ?>">
										<img src="<?php echo $group['feature_img']; ?>" alt="">
										<div>
											<strong class="fz16"><?php echo get_the_title($item); ?></strong>

										</div>
									</a>
								</li>
						<?php } ?>

					 <?php endforeach; ?> 
				  </ul>
			<?php endif; ?>  
			<?php  
           //the_user_favorites_list($user_id = null, $site_id = null, $include_links = true, $filters = 'ul', $include_button = false, $include_thumbnails = true, $thumbnail_size = 'thumbnail', $include_excerpt = true);
			?> 
    </div>
    </div>
</section>
<style> .h__drawer-list li {
    padding-left: 20px;
    display: inline-block;
}</style>
<?php get_footer();?>