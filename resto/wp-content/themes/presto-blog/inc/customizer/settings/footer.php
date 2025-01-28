<?php
/**
 * Footer Setting
 *
 * @package Presto_Blog
 */

if( ! function_exists( 'presto_blog_customize_register_footer' ) ): 
function presto_blog_customize_register_footer( $wp_customize ) {
    
    $wp_customize->add_section(
        'footer_settings',
        array(
            'title'    => __( 'Footer Settings', 'presto-blog' ),
            'priority' => 85,
            'panel'    => 'general_settings',
        )
    );
    
    /** Footer Copyright */
    $wp_customize->add_setting(
        'footer_copyright',
        array(
            'default'           => '',
            'sanitize_callback' => 'wp_kses_post',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->selective_refresh->add_partial( 'footer_copyright', array(
        'selector'        => '.bottom-footer .copyright .copy-right',
        'render_callback' => 'presto_blog_get_footer_copyright',
    ) );

    $wp_customize->add_control(
        'footer_copyright',
        array(
            'label'       => __( 'Footer Copyright Text', 'presto-blog' ),
            'description' => __( 'You can change footer copyright and use your own custom text from here.', 'presto-blog' ),
            'section'     => 'footer_settings',
            'type'        => 'textarea',
        )
    );
}
endif;
add_action( 'customize_register', 'presto_blog_customize_register_footer' );