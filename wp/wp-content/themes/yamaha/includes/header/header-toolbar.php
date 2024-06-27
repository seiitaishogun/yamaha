<?php
$side_menu = wp_get_nav_menu_items('27');
?>

<ul class="toolbar-nav dark">
    <?php foreach ($side_menu as $k => $nav) : ?>
        <li class="toolbar-nav__<?php echo $k + 1; ?>">
            <a href="<?php echo $nav->url; ?>" class="<?php echo $nav->classes[0] ?>">
                <span style="mask-image: url(<?php echo get_template_directory_uri() ?>/img/ic-tool-<?php echo $k + 1; ?>-white.svg); -webkit-mask-image: url(<?php echo get_template_directory_uri() ?>/img/ic-tool-<?php echo $k + 1; ?>-white.svg)" class="icon"></span> <span class="text"><?php echo $nav->post_title; ?></span>
            </a>
        </li>
    <?php endforeach; ?>
</ul>

<script type="text/javascript">
    $(document).ready(function() {
        $("footer").after('<div style="height: 70px;" class="d-block d-lg-none d-xl-none"></div>');

    })
</script>