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
]; ?> 

<?php echo get_template_part('includes/header/header-toolbar'); ?>

<?php 
$banner = get_field("banner_header", $page_id);
  global $wishlist_count;
 
?> 
<?php echo  get_template_part('includes/header/header-breadcrumb', '', $breadcrumb);?> 
<section class="cat-banner" style="background: url(<?php echo $banner['image'] ?>)  no-repeat ;
	   background-size:cover;  ">

	<div class="container-fluid"> 
		<picture>
			<source media="(min-width:768px)" srcset="<?php echo $banner; ?>">
			<img style="opacity: 0;" src="<?php echo get_template_directory_uri();?>/img/sweaters/banner.jpg" alt="" class="d-block w-100" />
		</picture>
		<div class="cat-banner__caption">
			<h2><?php echo (get_the_title($page_id)); echo ($wishlist_count>0)?' ('.$wishlist_count.')':''; ?></h2>
		</div>
	</div>
</section> 

<section class="hot-items wishlist"  id="next">
    <div class="container-fluid px-md-0">
        <div class="hot-items__title">
            <h3 class="wislist_title"><i class="sf-icon-love" style="color: #171717"></i> SẢN PHẨM YÊU THÍCH <?php echo ($wishlist_count>0)?' ('.$wishlist_count.')':''; ?></h3>
        </div>
         <div class="container-fluid d-lg-block d-xl-block d-block">
               <?php require_once( CCMS_ABSPATH.'/html/customer/my-wishlist.php' ); ?>
			<div class="spacer-20"></div> 
    	</div>
    </div>
</section> 

<?php get_footer();?>