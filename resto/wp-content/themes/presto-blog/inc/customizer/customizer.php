<?php
/**
 * Sublime Blog Theme Customizer
 *
 * @package Presto_Blog
*/

$presto_blog_settings = array( 'info', 'site', 'banner', 'featured', 'post', 'sidebar-layouts', 'color', 'header', 'breadcrumb', 'social', 'instagram', 'newsletter', 'footer' );

foreach( $presto_blog_settings as $setting ){
    require get_template_directory() . '/inc/customizer/settings/' . $setting . '.php';
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function presto_blog_customize_preview_js() {
	// Use minified libraries if SCRIPT_DEBUG is false
    $suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
	wp_enqueue_script( 'presto-blog-customizer', get_template_directory_uri() . '/assets/js/customizer' . $suffix . '.js', array( 'customize-preview' ), PRESTO_BLOG_VERSION, true );
}
add_action( 'customize_preview_init', 'presto_blog_customize_preview_js' );

/**
 * Add misc inline scripts to our controls.
 *
 * We don't want to add these to the controls themselves, as they will be repeated
 * each time the control is initialized.
 */
function presto_blog_control_inline_scripts() {
    $suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
	wp_enqueue_style( 'presto-blog-customize', get_template_directory_uri() . '/assets/css/customize' . $suffix . '.css', array(), PRESTO_BLOG_VERSION );
	wp_enqueue_script( 'presto-blog-customize', get_template_directory_uri() . '/assets/js/customize' . $suffix . '.js', array( 'jquery', 'customize-controls' ), PRESTO_BLOG_VERSION, true );

	$presto_blog_array = array(
    	'ajax_url'   => admin_url( 'admin-ajax.php' ),
    	'flushit'    => __( 'Successfully Flushed!','presto-blog' ),
    	'nonce'      => wp_create_nonce('ajax-nonce')
	);
	wp_localize_script( 'presto-blog-customize', 'presto_blog_data', $presto_blog_array );
}

add_action( 'customize_controls_enqueue_scripts', 'presto_blog_control_inline_scripts', 100 );

/**
 * Sanitization Functions 
*/
require get_template_directory() . '/inc/customizer/sanitization-callback.php';

/**
 * Active Callback Functions 
*/
require get_template_directory() . '/inc/customizer/active-callback.php';

/**
 * Partial Refresh
*/
require get_template_directory() .'/inc/customizer/partials.php';

/**
 * Upgrade
 */
require get_template_directory() .'/inc/customizer/upgrade/class-upgrade.php';