<?php
/**
 * Newsletter Setting
 *
 * @package Presto_Blog
 */

if( ! function_exists( 'presto_blog_customize_register_newsletter_section' ) ) :
function presto_blog_customize_register_newsletter_section( $wp_customize ) {
    
    $wp_customize->add_section(
        'newsletter_section',
        array(
            'title'           => __( 'Newsletter Section', 'presto-blog' ),
            'priority'        => 50,
            'capability'      => 'edit_theme_options',
            'panel'           => 'general_settings',
            'active_callback' => 'presto_blog_is_btnw_activated'
        )
    );
    
    /** Newsletter SEction */
    $wp_customize->add_setting( 
        'ed_newsletter_section', 
        array(
            'default'           => false,
            'sanitize_callback' => 'presto_blog_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
        new Presto_Blog_Toggle_Control( 
            $wp_customize,
            'ed_newsletter_section',
            array(
                'section'     => 'newsletter_section',
                'label'       => __( 'NewsLetter Section', 'presto-blog' ),
                'description' => __( 'Enable NewsLetter Section', 'presto-blog' ),
            )
        )
    );

    /** Newsletter Title */
    $wp_customize->add_setting(
        'newsletter_shortcode',
        array(
            'default'           => '',
            'sanitize_callback' => 'wp_kses_post',
        )
    );
    
    $wp_customize->add_control(
        'newsletter_shortcode',
        array(
            'label'           => __( 'Newsletter Shortcode', 'presto-blog' ),
            'desc'            => __( 'Enter Newsletter Shortcode Here', 'presto-blog' ),
            'section'         => 'newsletter_section',
            'type'            => 'text',
            'active_callback' => 'presto_blog_newsletter_ac'
        )
    );  
}
endif;
add_action( 'customize_register', 'presto_blog_customize_register_newsletter_section' );