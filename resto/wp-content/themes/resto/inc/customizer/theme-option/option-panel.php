<?php
global $resto_panels;
/*creating panel for theme settings*/
$resto_panels['resto-theme-options'] =
    array(
        'title'          => __( 'Theme Options', 'resto' ),
        'priority'       => 235
    );

/*header options */
require get_template_directory().'/inc/customizer/theme-option/header.php';

/*footer options */
require get_template_directory().'/inc/customizer/theme-option/footer.php';

/*layout options */
require get_template_directory().'/inc/customizer/theme-option/layout-options.php';

/*breadcrumb options */
require get_template_directory().'/inc/customizer/theme-option/breadcrumb.php';

/*back to top options */
require get_template_directory().'/inc/customizer/theme-option/back-to-top.php';

/*custom css options */
require get_template_directory().'/inc/customizer/theme-option/custom-css.php';