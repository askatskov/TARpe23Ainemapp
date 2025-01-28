<?php
/**
 * Instagram Setting
 *
 * @package Presto_Blog
 */

if( ! function_exists( 'presto_blog_customize_register_instagram_section' ) ): 
function presto_blog_customize_register_instagram_section( $wp_customize ) {
    
    $wp_customize->add_section(
        'instagram_section',
        array(
            'title'           => __( 'Instagram Section', 'presto-blog' ),
            'priority'        => 60,
            'capability'      => 'edit_theme_options',
            'panel'           => 'general_settings',
            'active_callback' => 'presto_blog_is_instagram_feed'
        )
    );

    /** Instagram Section */
    $wp_customize->add_setting( 
        'ed_instagram_section', 
        array(
            'default'           => false,
            'sanitize_callback' => 'presto_blog_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
        new Presto_Blog_Toggle_Control( 
            $wp_customize,
            'ed_instagram_section',
            array(
                'section'     => 'instagram_section',
                'label'       => __( 'Instagram Section', 'presto-blog' ),
                'description' => __( 'Enable Instagram Section', 'presto-blog' ),
            )
        )
    );

    /** Instagram Title */
    $wp_customize->add_setting(
        'instagram_title',
        array(
            'default'           => __( 'I\'m on instagram', 'presto-blog' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage'
        )
    );

    $wp_customize->add_control(
        'instagram_title',
        array(
            'label'           => __( 'Instagram Title', 'presto-blog' ),
            'section'         => 'instagram_section',
            'type'            => 'text',
            'active_callback' => 'presto_blog_instagram_ac'
        )
    );

    $wp_customize->selective_refresh->add_partial( 'instagram_title', array(
        'selector'        => '.instagram-section .section-title',
        'render_callback' => 'presto_blog_instagram_title',
    ) );

    /** Instagram Shortcode */
    $wp_customize->add_setting(
        'instagram_shortcode',
        array(
            'default'           => '',
            'sanitize_callback' => 'wp_kses_post',
        )
    );
    
    $wp_customize->add_control(
        'instagram_shortcode',
        array(
            'label'           => __( 'Instagram Shortcode', 'presto-blog' ),
            'desc'            => __( 'Enter Instagram Shortcode Here', 'presto-blog' ),
            'section'         => 'instagram_section',
            'type'            => 'text',
            'active_callback' => 'presto_blog_instagram_ac'
        )
    );       
}
endif;
add_action( 'customize_register', 'presto_blog_customize_register_instagram_section' );