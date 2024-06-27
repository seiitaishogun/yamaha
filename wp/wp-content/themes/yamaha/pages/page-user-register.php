<?php
/** 
* created Date: 12/30/2021
* project: yamaha-revzone-website
*
* Template Name: Page User Register 
*
*/
get_header();
?>

<div class="navigator__breadcrumbs">
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">TRANG CHỦ</a></li>
                <li class="breadcrumb-item"><a class="font-weight-bold text-dark" href="">ĐĂNG KÝ</a></li>
                
            </ol>
        </nav>
    </div>
</div>
<section class="my-account">
    <div class="container-fluid">
         <?php include_once(WP_PLUGIN_DIR.'/commerce-cms/frm/frm_register.php'); ?>    
    </div>
    <div class="spacer-50"></div>
</section> 
 
 <?php
get_footer();
  