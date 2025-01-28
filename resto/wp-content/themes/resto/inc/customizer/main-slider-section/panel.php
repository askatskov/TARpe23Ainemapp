<?php
global $resto_panels;
/*creating panel for fonts-setting*/
$resto_panels['resto-feature-slider'] =
    array(
        'title'          => __( 'Home Main Slider', 'resto' ),
        'priority'       => 200
    );

/*slider selection from slider options */
require get_template_directory().'/inc/customizer/main-slider-section/options.php';

/*slider selection from slider settings */
require get_template_directory().'/inc/customizer/main-slider-section/settings.php';

/*slider selection from slider from page */
require get_template_directory().'/inc/customizer/main-slider-section/from-page.php';
