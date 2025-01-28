<?php
/**
 * Displays Offcanvas menu
 *
 * @package Restochef
 */
?>


<div class="theme-offcanvas-panel theme-offcanvas-panel-menu">
    <div class="theme-offcanvas-header">
        <button id="theme-offcanvas-close" class="theme-button theme-button-transparent" aria-expanded="false">
            <span class="screen-reader-text"><?php _e('Close', 'restochef'); ?></span>
            <?php restochef_theme_svg('close'); ?>
        </button><!-- .nav-toggle -->
    </div>

    <div class="theme-offcanvas-content">
        <nav aria-label="<?php echo esc_attr_x('Mobile', 'menu', 'restochef'); ?>" role="navigation">
            <ul id="theme-offcanvas-navigation" class="theme-offcanvas-menu reset-list-style">
                <?php
                if (has_nav_menu('primary-menu')) {
                    ?>

                    <?php
                    wp_nav_menu(
                        array(
                            'container' => '',
                            'items_wrap' => '%3$s',
                            'show_toggles' => true,
                            'theme_location' => 'primary-menu'
                        )
                    );
                    ?>

                    <?php
                } else {
                    wp_list_pages(
                        array(
                            'match_menu_classes' => true,
                            'show_sub_menu_icons' => true,
                            'title_li' => false,
                        )
                    );
                } ?>

            </ul><!-- .theme-offcanvas-navigation -->
        </nav>
    </div>
</div> <!-- theme-offcanvas-panel-menu -->
