<?php
/**
 * BreadCrumb Settings
 *
 * @package Presto_Blog
*/

if( ! function_exists( 'presto_blog_customize_register_breadcrumb' ) ) :
function presto_blog_customize_register_breadcrumb( $wp_customize ) {
    
    /** BreadCrumb Settings */
    $wp_customize->add_section(
        'breadcrumb_settings',
        array(
            'title'    => __( 'BreadCrumb Settings', 'presto-blog' ),
            'priority' => 20,
            'panel'    => 'general_settings',
        )
    );
    
    /** BreadCrumb */
    $wp_customize->add_setting( 
        'ed_breadcrumb', 
        array(
            'default'           => true,
            'sanitize_callback' => 'presto_blog_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
        new Presto_Blog_Toggle_Control( 
            $wp_customize,
            'ed_breadcrumb',
            array(
                'section'     => 'breadcrumb_settings',
                'label'       => __( 'BreadCrumb', 'presto-blog' ),
                'description' => __( 'Enable this option to show breadcrumb in inner pages.', 'presto-blog' ),
            )
        )
    );

    /** BreadCrumb Home Text */
    $wp_customize->add_setting(
        'home_text',
        array(
            'default'           => __( 'Home', 'presto-blog' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
        'home_text',
        array(
            'type'    => 'text',
            'section' => 'breadcrumb_settings',
            'label'   => __( 'BreadCrumb Home Text', 'presto-blog' ),
        )
    );

    $wp_customize->selective_refresh->add_partial( 'home_text', array(
        'selector'        => '#crumbs .breadcrumb_home',
        'render_callback' => 'presto_blog_home_text',
    ) );
}
endif;
add_action( 'customize_register', 'presto_blog_customize_register_breadcrumb' );