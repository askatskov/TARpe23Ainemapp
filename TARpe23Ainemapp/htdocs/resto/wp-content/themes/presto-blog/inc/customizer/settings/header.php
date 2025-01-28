<?php
/**
 * Header Settings
 *
 * @package Presto_Blog
*/

if( ! function_exists( 'presto_blog_customize_register_header' ) ) :
function presto_blog_customize_register_header( $wp_customize ){

    /** General Settings */
    $wp_customize->add_panel( 
        'general_settings',
         array(
            'priority'    => 80,
            'capability'  => 'edit_theme_options',
            'title'       => __( 'General Settings', 'presto-blog' ),
        ) 
    );
    
    /** Header Settings */
    $wp_customize->add_section(
        'header_settings',
        array(
            'title'    => __( 'Header Settings', 'presto-blog' ),
            'priority' => 10,
            'panel'    => 'general_settings',
        )
    );

    /** Header Search */
    $wp_customize->add_setting( 
        'ed_header_search', 
        array(
            'default'           => false,
            'sanitize_callback' => 'presto_blog_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
        new Presto_Blog_Toggle_Control( 
            $wp_customize,
            'ed_header_search',
            array(
                'section'     => 'header_settings',
                'label'       => __( 'Header Search', 'presto-blog' ),
                'description' => __( 'Enable to show Search button in header.', 'presto-blog' ),
            )
        )
    );

    /** WooCommerce User */
    $wp_customize->add_setting( 
        'ed_woo_user', 
        array(
            'default'           => false,
            'sanitize_callback' => 'presto_blog_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
        new Presto_Blog_Toggle_Control( 
            $wp_customize,
            'ed_woo_user',
            array(
                'section'         => 'header_settings',
                'label'           => __( 'WooCommerce User', 'presto-blog' ),
                'description'     => __( 'Enable to show WooCommerce user account page link in header.', 'presto-blog' ),
                'active_callback' => 'presto_blog_is_woocommerce_activated'
            )
        )
    );

    /** WooCommerce Cart */
    $wp_customize->add_setting( 
        'ed_header_cart', 
        array(
            'default'           => false,
            'sanitize_callback' => 'presto_blog_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
        new Presto_Blog_Toggle_Control( 
            $wp_customize,
            'ed_header_cart',
            array(
                'section'         => 'header_settings',
                'label'           => __( 'WooCommerce Cart', 'presto-blog' ),
                'description'     => __( 'Enable to show cart count in header.', 'presto-blog' ),
                'active_callback' => 'presto_blog_is_woocommerce_activated'
            )
        )
    );

    /** Header Button */
    $wp_customize->add_setting( 
        'ed_header_btn', 
        array(
            'default'           => false,
            'sanitize_callback' => 'presto_blog_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
        new Presto_Blog_Toggle_Control( 
            $wp_customize,
            'ed_header_btn',
            array(
                'section'     => 'header_settings',
                'label'       => __( 'Header Button', 'presto-blog' ),
                'description' => __( 'Enable to show custom button in header.', 'presto-blog' ),
            )
        )
    );

    /** Button Label */
    $wp_customize->add_setting(
        'header_button_label',
        array(
            'default'           => __( 'RSVP', 'presto-blog' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage',
        )
    );

    $wp_customize->add_control(
        'header_button_label',
        array(
            'section'         => 'header_settings',
            'label'           => __( 'Button Label', 'presto-blog' ),
            'type'            => 'text',
            'active_callback' => 'presto_blog_header_button_ac'
        )		
    );

    $wp_customize->selective_refresh->add_partial( 'header_button_label', array(
        'selector'        => '.header-btn .btn',
        'render_callback' => 'presto_blog_header_button_label',
    ) );

    /** Button URL */
    $wp_customize->add_setting(
        'header_button_url',
        array(
            'default'           => '#',
            'sanitize_callback' => 'esc_url_raw',
        )
    );
    
    $wp_customize->add_control(
        'header_button_url',
        array(
            'section'         => 'header_settings',
            'label'           => __( 'Button URL', 'presto-blog' ),
            'type'            => 'text',
            'active_callback' => 'presto_blog_header_button_ac'
        )		
    );
}
endif;
add_action( 'customize_register', 'presto_blog_customize_register_header' );