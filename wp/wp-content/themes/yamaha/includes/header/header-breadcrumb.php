<div class="navigator__breadcrumbs">
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">TRANG CHỦ</a></li>
                <?php if ($args) : ?>
                    <?php for ($i = 0; $i < count($args); $i++) : ?>
                        <li class="breadcrumb-item <?php echo $args[$i]['active'] ? 'active' : '' ?>">
                            <?php if (!$args[$i]['active']) : ?>
                                <a href="<?php echo $args[$i]['slug']; ?>"><?php echo $args[$i]['name']; ?></a>
                            <?php else : ?>
                                <?php echo $args[$i]['name']; ?>
                            <?php endif; ?>
                        </li>
                    <?php endfor; ?>
                <?php endif; ?>
            </ol>
        </nav>
    </div>
</div>
<?php
if (!is_page( 'news' ) ):
?>
    <ul class="toolbar-nav dark">
        <?php
        $side_menu = wp_get_nav_menu_items('27');
        foreach ($side_menu as $k => $nav) : ?>
            <li class="toolbar-nav__<?php echo $k + 1; ?>">
                <a href="<?php echo $nav->url; ?>" class="<?php echo $nav->classes[0] ?>">
                    <span style="mask-image: url(<?php echo get_template_directory_uri() ?>/img/ic-tool-<?php echo $k + 1; ?>-white.svg); -webkit-mask-image: url(<?php echo get_template_directory_uri() ?>/img/ic-tool-<?php echo $k + 1; ?>-white.svg)" class="icon"></span> <span class="text"><?php echo $nav->post_title; ?></span>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
<?php 
endif;
?>
