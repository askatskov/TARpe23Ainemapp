<?php
/**
 * Customizer Settings
 * 
 * @package Presto_Food_Blog
 */

function presto_blog_customize_register_banner( $wp_customize ){

    /** FrontPage Settings */
    $wp_customize->add_panel( 
        'frontpage_settings',
         array(
            'priority'    => 40,
            'capability'  => 'edit_theme_options',
            'title'       => __( 'Front Page Settings', 'presto-food-blog' ),
        ) 
    );
    
    $wp_customize->get_section( 'header_image' )->panel                    = 'frontpage_settings';
    $wp_customize->get_section( 'header_image' )->title                    = __( 'Banner Section', 'presto-food-blog' );
    $wp_customize->get_section( 'header_image' )->priority                 = 10;
    $wp_customize->get_control( 'header_image' )->active_callback          = 'presto_blog_banner_ac';
    $wp_customize->get_control( 'header_video' )->active_callback          = 'presto_blog_banner_ac';
    $wp_customize->get_control( 'external_header_video' )->active_callback = 'presto_blog_banner_ac';
    $wp_customize->get_section( 'header_image' )->description              = '';
    $wp_customize->get_setting( 'header_image' )->transport                = 'refresh';
    $wp_customize->get_setting( 'header_video' )->transport                = 'refresh';
    $wp_customize->get_setting( 'external_header_video' )->transport       = 'refresh';

    /** Banner Options */
    $wp_customize->add_setting(
        'ed_banner_section',
        array(
            'default'           => 'no_banner',
            'sanitize_callback' => 'presto_blog_sanitize_select'
        )
    );

    $wp_customize->add_control(
        'ed_banner_section',
        array(
            'label'       => __( 'Banner Options', 'presto-food-blog' ),
            'description' => __( 'Choose banner as static image/video.', 'presto-food-blog' ),
            'type'        => 'select',
            'section'     => 'header_image',
            'choices'     => array(
                'no_banner'         => __( 'Disable Banner Section', 'presto-food-blog' ),
                'static_banner'     => __( 'Banner with CTA', 'presto-food-blog' ),
                'newsletter_banner' => __( 'Banner with Newsletter', 'presto-food-blog' ),
            ),
            'priority' => 5
        )
    );

    /** Subtitle */
    $wp_customize->add_setting(
        'banner_subtitle',
        array(
            'default'           => __( 'Free Blogging Course','presto-food-blog' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
        'banner_subtitle',
        array(
            'section'         => 'header_image',
            'label'           => __( 'Subtitle', 'presto-food-blog' ),
            'active_callback' => 'presto_blog_banner_ac'
        )
    );

    $wp_customize->selective_refresh->add_partial( 'banner_subtitle', array(
        'selector'        => '.banner-static .item-content .item-content-inner .sub-title',
        'render_callback' => 'presto_blog_banner_subtitle',
    ) );

    /** Title */
    $wp_customize->add_setting(
        'banner_title',
        array(
            'default'           => __( 'Are you Ready to Start a Profitable Blog?','presto-food-blog' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage'
        )
    );

    $wp_customize->add_control(
        'banner_title',
        array(
            'section'         => 'header_image',
            'label'           => __( 'Title', 'presto-food-blog' ),
            'active_callback' => 'presto_blog_banner_ac'
        )
    );

    $wp_customize->selective_refresh->add_partial( 'banner_title', array(
        'selector'        => '.banner-static .item-content .item-title',
        'render_callback' => 'presto_blog_banner_title',
    ) );

    /** Banner link one label */
    $wp_customize->add_setting(
        'banner_link_one_label',
        array(
            'default'           => __( 'Get Started','presto-food-blog' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage'
        )
    );

    $wp_customize->add_control(
        'banner_link_one_label',
        array(
            'section'         => 'header_image',
            'label'           => __( 'Link One Label', 'presto-food-blog' ),
            'active_callback' => 'presto_blog_banner_ac'
        )
    );

    $wp_customize->selective_refresh->add_partial( 'banner_link_one_label', array(
        'selector'        => '.banner-static .item-content .btn-wrap .btn:first-child',
        'render_callback' => 'presto_blog_banner_link_one_label',
    ) );

    /** Banner link one url */
    $wp_customize->add_setting(
        'banner_link_one_url',
        array(
            'default'           => '#',
            'sanitize_callback' => 'esc_url_raw',
        )
    );

    $wp_customize->add_control(
        'banner_link_one_url',
        array(
            'section'         => 'header_image',
            'label'           => __( 'Link One URL', 'presto-food-blog' ),
            'active_callback' => 'presto_blog_banner_ac'
        )
    );

    /** Banner link two label */
    $wp_customize->add_setting(
        'banner_link_two_label',
        array(
            'default'           => __( 'Learn More','presto-food-blog' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage'
        )
    );

    $wp_customize->add_control(
        'banner_link_two_label',
        array(
            'section'         => 'header_image',
            'label'           => __( 'Link Two Label', 'presto-food-blog' ),
            'active_callback' => 'presto_blog_banner_ac'
        )
    );

    $wp_customize->selective_refresh->add_partial( 'banner_link_two_label', array(
        'selector'        => '.banner-static .item-content .btn-wrap .btn-outlined',
        'render_callback' => 'presto_blog_banner_link_two_label',
    ) );

    /** Banner link two url */
    $wp_customize->add_setting(
        'banner_link_two_url',
        array(
            'default'           => '#',
            'sanitize_callback' => 'esc_url_raw',
        )
    );

    $wp_customize->add_control(
        'banner_link_two_url',
        array(
            'section'         => 'header_image',
            'label'           => __( 'Link Two URL', 'presto-food-blog' ),
            'active_callback' => 'presto_blog_banner_ac'
        )
    );

    /** Banner Newsletter */
    $wp_customize->add_setting(
        'banner_newsletter_shortcode',
        array(
            'default'           => '',
            'sanitize_callback' => 'wp_kses_post',
        )
    );

    $wp_customize->add_control(
        'banner_newsletter_shortcode',
        array(
            'section'         => 'header_image',
            'label'           => __( 'Banner Newsletter', 'presto-food-blog' ),
            'desc'            => __( 'Enter Banner Newsletter Shortcode', 'presto-food-blog' ),
            'active_callback' => 'presto_blog_banner_ac'
        )
    );
}

/**
 * Active Callback
 */
function presto_blog_banner_ac( $control ){
    $edbanner    = $control->manager->get_setting( 'ed_banner_section' )->value();
    $control_id  = $control->id;
    
    // static banner controls
    if ( $control_id == 'header_image' && ( $edbanner == 'static_banner' || $edbanner == 'newsletter_banner' ) ) return true;
    if ( $control_id == 'header_video' && ( $edbanner == 'static_banner' || $edbanner == 'newsletter_banner' ) ) return true;
    if ( $control_id == 'external_header_video' && ( $edbanner == 'static_banner' || $edbanner == 'newsletter_banner' ) ) return true;

    // banner title and description controls
    if ( $control_id == 'banner_subtitle' && $edbanner == 'static_banner' ) return true;
    if ( $control_id == 'banner_title' && $edbanner == 'static_banner' ) return true;

    // Link button controls
    if ( $control_id == 'banner_link_one_label' && $edbanner == 'static_banner' ) return true;
    if ( $control_id == 'banner_link_one_url' && $edbanner == 'static_banner' ) return true;
    if ( $control_id == 'banner_link_two_label' && $edbanner == 'static_banner' ) return true;
    if ( $control_id == 'banner_link_two_url' && $edbanner == 'static_banner' ) return true;
    
    // newsletter banner
    if ( $control_id == 'banner_newsletter_shortcode' && $edbanner == 'newsletter_banner' ) return true;

    return false;
}