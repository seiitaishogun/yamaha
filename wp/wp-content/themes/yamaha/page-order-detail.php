<?php
/**
 * @author HUNG VO
 * created Date: 10/12/2021
 * project: yamaha-revzone-website
 *
 * Template Name: Profile User
 *
 */

get_header();

?>

<div class="navigator__breadcrumbs">
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo wp_get_referer() ?>"><i class="fas fa-chevron-left"></i>&nbsp Quay lại</a></li>
            </ol>
        </nav>
    </div>
</div>

<?php require_once( CCMS_ABSPATH.'/html/order-detail.php' ); ?>
 
<script src="<?php echo get_template_directory_uri() ?>/js/my-work.js?v=<?php echo time(); ?>"></script>
<?php
get_footer();
