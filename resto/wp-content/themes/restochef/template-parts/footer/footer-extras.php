<?php

$enable_footer_nav = restochef_get_option('enable_footer_nav');
$footer_app_store_pay_url = restochef_get_option('footer_app_store_pay_url');
$footer_google_pay_url = restochef_get_option('footer_google_pay_url');

if (has_nav_menu( 'footer-menu' )|| $footer_app_store_pay_url || $footer_google_pay_url):
    ?>
    <div class="theme-footer-extras">
        <?php if ($enable_footer_nav): ?>
            <div class="site-footer-menu">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'footer-menu',
                    'container_class' => 'footer-navigation',
                    'fallback_cb' => false,
                    'depth' => 1,
                    'menu_class' => 'theme-footer-navigation theme-menu theme-footer-navigation'
                ));
                ?>
            </div>
        <?php endif; ?>
        <?php if ($footer_app_store_pay_url || $footer_google_pay_url) { ?>
            <div class="site-footer-appstore">
                <ul>
                    <?php if ($footer_app_store_pay_url) { ?>
                        <li class="footer-appstore-logo apple-appstore-logo"><a href="<?php echo esc_url($footer_app_store_pay_url); ?>" target="_blank"><span class="appstore-logo-image apple-logo-image"></span></a></li>
                    <?php } ?>
                    <?php if ($footer_google_pay_url) { ?>
                        <li class="footer-appstore-logo play-appstore-logo"><a href="<?php echo esc_url($footer_google_pay_url); ?>" target="_blank"><span class="appstore-logo-image play-logo-image"></span></a></li>
                    <?php } ?>

                </ul>
            </div>
        <?php } ?>
    </div><!-- .theme-footer-extras-->

<?php
endif;