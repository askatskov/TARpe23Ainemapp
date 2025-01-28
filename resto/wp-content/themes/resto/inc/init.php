<?php
/**
 * evision themes init file
 *
 * @package eVision themes
 * @subpackage Resto
 * @since Resto 1.0.0
 */

/**
 * Load TGM pluin activation file.
 */
require_once get_template_directory() . '/inc/function/class-tgm-plugin-activation.php';
require_once get_template_directory() . '/inc/hooks/tgm.php';

/**
 * Customizer additions.
 */
require get_template_directory().'/inc/customizer/customizer.php';

/**
* Additional functions.
*/
require get_template_directory() . '/inc/function/header-logo.php';

require get_template_directory() . '/inc/function/words-count.php';

require get_template_directory() . '/inc/function/inner-head.php';

require get_template_directory() . '/inc/function/breadcrumb.php';

require get_template_directory() . '/inc/function/feature-image-align.php';

require get_template_directory() . '/inc/sidebar-widget-init.php';

/**
 * Init hooks.
 */
require get_template_directory() . '/inc/hooks/header.php';

require get_template_directory() . '/inc/hooks/footer.php';

require get_template_directory() . '/inc/hooks/homepage-slider.php';

require get_template_directory() . '/inc/hooks/homepage-about.php';

require get_template_directory() . '/inc/hooks/homepage-menu.php';

require get_template_directory() . '/inc/hooks/homepage-service.php';

require get_template_directory() . '/inc/hooks/homepage-blog.php';

require get_template_directory().'/inc/hooks/wp-head.php';



/**
*layout meta
*/
require get_template_directory().'/inc/post-meta/layout-meta.php';