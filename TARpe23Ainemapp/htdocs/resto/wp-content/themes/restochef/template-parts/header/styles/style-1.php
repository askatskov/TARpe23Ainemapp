<?php
$wrapper_classes = 'site-header theme-site-header';

$is_sticky = restochef_get_option('enable_sticky_menu');
$enable_dark_mode = restochef_get_option('enable_dark_mode');
$enable_dark_mode_switcher = restochef_get_option('enable_dark_mode_switcher');
$is_banner_section = restochef_get_option('enable_banner_section');

?>

<header id="masthead" class="<?php echo esc_attr($wrapper_classes); ?>" role="banner">
    <div class="masthead-main-navigation <?php echo ($is_sticky) ? 'has-sticky-header' : ''; ?>">
        <div class="wrapper">
            <div class="site-header-wrapper">
                <div class="site-header-left">
                    <?php get_template_part('template-parts/header/site-branding'); ?>
                </div>
                <div class="site-header-center">
                    <div id="site-navigation" class="main-navigation theme-primary-menu">
                        <?php
                        if (has_nav_menu('primary-menu')) {
                            ?>
                            <nav class="primary-menu-wrapper"
                                 aria-label="<?php echo esc_attr_x('Primary', 'menu', 'restochef'); ?>">
                                <ul class="primary-menu reset-list-style">
                                    <?php
                                    wp_nav_menu(
                                        array(
                                            'container' => '',
                                            'items_wrap' => '%3$s',
                                            'theme_location' => 'primary-menu'
                                        )
                                    );
                                    ?>
                                </ul>
                            </nav><!-- .primary-menu-wrapper -->
                            <?php
                        } else { ?>
                            <nav class="primary-menu-wrapper"
                                 aria-label="<?php echo esc_attr_x('Primary', 'menu', 'restochef'); ?>">
                                <ul class="primary-menu reset-list-style">
                                    <?php
                                    wp_list_pages(
                                        array(
                                            'match_menu_classes' => true,
                                            'show_sub_menu_icons' => true,
                                            'title_li' => false,
                                        )
                                    );

                                    ?>
                                </ul>
                            </nav><!-- .primary-menu-wrapper -->

                        <?php } ?>
                    </div><!-- .main-navigation -->
                </div>
                <div class="site-topbar-item site-header-right">
                    <?php $blog_mini_cart = restochef_get_option('enable_mini_cart_header');
                    if ($blog_mini_cart && class_exists('WooCommerce')) {
                        restochef_woocommerce_cart_count();
                    } ?>


                    <?php
                    $header_button_label = restochef_get_option('header_button_label');
                    $header_button_url = restochef_get_option('header_button_url');

                    if ($header_button_label) { ?>

                        <a href="<?php echo esc_url($header_button_url); ?>" class="theme-primary-btn hidden-xs-screen">
                            <?php echo esc_html($header_button_label); ?>
                        </a>

                    <?php } ?>

                    <button id="theme-toggle-offcanvas-button"
                            class="hide-on-desktop theme-button theme-button-transparent theme-button-offcanvas"
                            aria-expanded="false" aria-controls="theme-offcanvas-navigation">
                        <span class="screen-reader-text"><?php _e('Menu', 'restochef'); ?></span>
                        <span class="toggle-icon"><?php restochef_theme_svg('menu'); ?></span>
                    </button>

                    <?php if ($enable_dark_mode && $enable_dark_mode_switcher) : ?>
                        <button id="theme-toggle-mode-button"
                                class="theme-button theme-button-transparent theme-button-colormode"
                                title="<?php _e('Toggle light/dark mode', 'restochef'); ?>" aria-label="auto"
                                aria-live="polite">
                            <span class="screen-reader-text"><?php _e('Switch color mode', 'restochef'); ?></span>
                            <svg class="svg-icon svg-icon-colormode" aria-hidden="true" width="24" height="24"
                                 viewBox="0 0 24 24">
                                <mask class="moon" id="moon-mask">
                                    <rect x="0" y="0" width="100%" height="100%" fill="white"/>
                                    <circle cx="24" cy="10" r="6" fill="black"/>
                                </mask>
                                <circle class="sun" cx="12" cy="12" r="6" mask="url(#moon-mask)" fill="currentColor"/>
                                <g class="sun-beams" stroke="currentColor">
                                    <line x1="12" y1="1" x2="12" y2="3"/>
                                    <line x1="12" y1="21" x2="12" y2="23"/>
                                    <line x1="4.22" y1="4.22" x2="5.64" y2="5.64"/>
                                    <line x1="18.36" y1="18.36" x2="19.78" y2="19.78"/>
                                    <line x1="1" y1="12" x2="3" y2="12"/>
                                    <line x1="21" y1="12" x2="23" y2="12"/>
                                    <line x1="4.22" y1="19.78" x2="5.64" y2="18.36"/>
                                    <line x1="18.36" y1="5.64" x2="19.78" y2="4.22"/>
                                </g>
                            </svg>
                        </button>
                    <?php endif; ?>

                    <button id="theme-toggle-search-button"
                            class="theme-button theme-button-transparent theme-button-search" aria-expanded="false"
                            aria-controls="theme-header-search">
                        <span class="screen-reader-text"><?php _e('Search', 'restochef'); ?></span>
                        <?php restochef_theme_svg('search'); ?>
                    </button>
                </div>

            </div>
        </div>

    </div>
</header><!-- #masthead -->
<?php if ($is_banner_section && (is_home() || is_front_page()) && !is_paged()) {
    //get_template_part('template-parts/front-page/banner-section');
}
?>
