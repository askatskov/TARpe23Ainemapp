<?php
/**
 * Color Setting
 *
 * @package Presto_Blog
 */

if( ! function_exists( 'presto_blog_customize_register_color' ) ) :
function presto_blog_customize_register_color( $wp_customize ) {
    
    /** Styling Settings */
    $wp_customize->add_panel( 
        'styling_settings',
         array(
            'priority'    => 70,
            'capability'  => 'edit_theme_options',
            'title'       => __( 'Styling Settings', 'presto-blog' ),
        ) 
    );

    $wp_customize->add_section(
        'presto_blog_typography_section',
        array(
            'title'    => __( 'Typography Settings', 'presto-blog' ),
            'priority' => 50,
            'panel'    => 'styling_settings',
        )
    );

    $wp_customize->add_setting(
        'ed_localgoogle_fonts',
        array(
            'default'           => false,
            'sanitize_callback' => 'presto_blog_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        'ed_localgoogle_fonts',
        array(
            'label'   => __( 'Load Google Fonts Locally', 'presto-blog' ),
            'section' => 'presto_blog_typography_section',
            'type'    => 'checkbox',
        )
    );
    

    $wp_customize->add_setting(
        'flush_google_fonts',
        array(
            'default'           => '',
            'sanitize_callback' => 'wp_kses',
        )
    );

    $wp_customize->add_control(
        'flush_google_fonts',
        array(
            'label'       => __( 'Flush Local Fonts Cache', 'presto-blog' ),
            'description' => __( 'Click the button to reset the local fonts cache.', 'presto-blog' ),
            'type'        => 'button',
            'settings'    => array(),
            'section'     => 'presto_blog_typography_section',
            'input_attrs' => array(
                'value' => __( 'Flush Local Fonts Cache', 'presto-blog' ),
                'class' => 'button button-primary flush-it',
            ),
            'active_callback' => 'presto_blog_flush_fonts_callback'
        )
    );
    
    $wp_customize->get_section( 'colors' )->panel                             = 'styling_settings';
    $wp_customize->get_section( 'colors' )->title                             = __( 'Colors Settings', 'presto-blog' );
    $wp_customize->get_section( 'colors' )->priority                          = 20;
    $wp_customize->get_section( 'background_image' )->panel                   = 'styling_settings';
    $wp_customize->get_section( 'background_image' )->priority                = 30;
    $wp_customize->get_section( 'presto_blog_typography_section' )->panel    = 'styling_settings';

    $wp_customize->remove_control( 'header_textcolor' );
}
endif;
add_action( 'customize_register', 'presto_blog_customize_register_color' );

function presto_blog_flush_fonts_callback( $control ){
    $ed_localgoogle_fonts   = $control->manager->get_setting( 'ed_localgoogle_fonts' )->value();
    $control_id   = $control->id;
    
    if ( $control_id == 'flush_google_fonts' && $ed_localgoogle_fonts ) return true;
    return false;
}