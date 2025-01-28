<?php
/**
 * Customizer Control
 * 
 * @package Presto_Blog
*/

if( ! function_exists( 'presto_blog_register_custom_controls' ) ) :
/**
 * Register Custom Controls
*/
function presto_blog_register_custom_controls( $wp_customize ){    
    // Load our custom control.
    require_once get_template_directory() . '/inc/customizer-controls/note/class-note-control.php';
    require_once get_template_directory() . '/inc/customizer-controls/radioimg/class-radio-image-control.php';
    require_once get_template_directory() . '/inc/customizer-controls/repeater/class-repeater-setting.php';
    require_once get_template_directory() . '/inc/customizer-controls/repeater/class-control-repeater.php';
    require_once get_template_directory() . '/inc/customizer-controls/select/class-select-control.php';
    require_once get_template_directory() . '/inc/customizer-controls/toggle/class-toggle-control.php';
    require_once get_template_directory() . '/inc/customizer-controls/slider/class-slider-control.php';
            
    // Register the control type.
    $wp_customize->register_control_type( 'Presto_Blog_Radio_Image_Control' );
    $wp_customize->register_control_type( 'Presto_Blog_Select_Control' );
    $wp_customize->register_control_type( 'Presto_Blog_Toggle_Control' );
    $wp_customize->register_control_type( 'Presto_Blog_Slider_Control' );
}
endif;
add_action( 'customize_register', 'presto_blog_register_custom_controls' );