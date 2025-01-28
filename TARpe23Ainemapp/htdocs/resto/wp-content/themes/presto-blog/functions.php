<?php
/**
 * Presto Blog functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Presto_Blog
 */

$presto_blog_theme = wp_get_theme();
if( ! defined( 'PRESTO_BLOG_VERSION' ) ) define( 'PRESTO_BLOG_VERSION', $presto_blog_theme->get( 'Version' ) );
if( ! defined( 'PRESTO_BLOG_NAME' ) ) define( 'PRESTO_BLOG_NAME', $presto_blog_theme->get( 'Name' ) );
if( ! defined( 'PRESTO_BLOG_TEXTDOMAIN' ) ) define( 'PRESTO_BLOG_TEXTDOMAIN', $presto_blog_theme->get( 'TextDomain' ) );

/**
 * Implement Local Font Method functions.
 */
require get_template_directory() . '/inc/class-webfont-loader.php';


/**
 * Widgets
 */
require get_template_directory() . '/inc/widgets.php';

/**
 * Custom Controls
 */
require get_template_directory() . '/inc/customizer-controls/customizer-control.php';

/**
 * Presto WordPress Actions and Filters
 */
require get_template_directory() . '/inc/hooks.php';

/**
 * Helper Functions
 */
require get_template_directory() . '/inc/helpers.php';

/**
 * Presto Actions Hooks
 */
require get_template_directory() . '/inc/actions.php';

/**
 * Presto Filter Hooks
 */
require get_template_directory() . '/inc/filters.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer/customizer.php';

/**
 * Recommended Plugins
 */
require get_template_directory() . '/inc/tgmpa/recommended-plugins.php';

/**
 * WooCommerce Functions
 */
if( presto_blog_is_woocommerce_activated() ){
	require get_template_directory() . '/inc/woocommerce-functions.php';
}
/**
 * Getting Started
*/
require get_template_directory() . '/inc/getting-started/getting-started.php';