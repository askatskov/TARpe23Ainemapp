<?php
global $resto_panels;
/*creating panel for fonts-setting*/
$resto_panels['resto-home-service'] =
    array(
        'title'          => __( 'Home Service Section', 'resto' ),
        'priority'       => 220
    );
/*enable service options */
require get_template_directory().'/inc/customizer/service-section/service-options.php';

/*service selection from custom options */
require get_template_directory().'/inc/customizer/service-section/font-icon.php';

/*service selection from page options */
require get_template_directory().'/inc/customizer/service-section/from-page.php';