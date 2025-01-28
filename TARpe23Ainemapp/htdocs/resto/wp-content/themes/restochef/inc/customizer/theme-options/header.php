<?php

$wp_customize->add_setting('header_dark_logo',
    array(
        'default' => '',
        'sanitize_callback' => 'restochef_sanitize_image'
    )
);
$wp_customize->add_control( new WP_Customize_Image_Control(
        $wp_customize,
        'header_dark_logo',
        array(
            'label'      => esc_html__( 'Logo for Dark Mode', 'restochef' ),
            'section'    => 'title_tagline',
        )
    )
);

$wp_customize->add_setting( 'header_banner_title',
    array(
    'default'           => $default_options['header_banner_title'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control( 'header_banner_title',
    array(
    'label'       => esc_html__( 'Header Section Title', 'restochef' ),
    'section'     => 'header_image',
    'type'        => 'text',
    )
);

$wp_customize->add_setting( 'header_banner_sub_title',
    array(
    'default'           => $default_options['header_banner_sub_title'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control( 'header_banner_sub_title',
    array(
    'label'       => esc_html__( 'Header Section Sub Title', 'restochef' ),
    'section'     => 'header_image',
    'type'        => 'text',
    )
);

$wp_customize->add_setting( 'header_banner_button_label',
    array(
    'default'           => $default_options['header_banner_button_label'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control( 'header_banner_button_label',
    array(
    'label'       => esc_html__( 'Header Section Button Text', 'restochef' ),
    'section'     => 'header_image',
    'type'        => 'text',
    )
);

$wp_customize->add_setting( 'header_banner_button_link',
    array(
    'default'           => '',
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'esc_url_raw',
    )
);
$wp_customize->add_control( 'header_banner_button_link',
    array(
    'label'       => esc_html__( 'Header Section Button Link', 'restochef' ),
    'section'     => 'header_image',
    'type'        => 'text',
    )
);

$wp_customize->add_setting('ed_open_link_new_tab',
    array(
        'default' => '',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'restochef_sanitize_checkbox',
    )
);

$wp_customize->add_control('ed_open_link_new_tab',
    array(
        'label' => esc_html__('Open In New Tab', 'restochef'),
        'section' => 'header_image',
        'type' => 'checkbox',
    )
 );

/*Header Options*/
$wp_customize->add_section(
    'header_options' ,
    array(
        'title' => __( 'Header Options', 'restochef' ),
        'panel' => 'restochef_option_panel',
    )
);

$wp_customize->add_setting(
    'restochef_section_seperator_header_1',
    array(
        'default'           => '',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field'
    )
);

$wp_customize->add_control(
    new Restochef_Seperator_Control(
        $wp_customize,
        'restochef_section_seperator_header_1',
        array(
            'settings' => 'restochef_section_seperator_header_1',
            'section' => 'header_options',
        )
    )
);

/* Header Style */
$wp_customize->add_setting(
    'restochef_options[header_style]',
    array(
        'default'           => $default_options['header_style'],
        'sanitize_callback' => 'restochef_sanitize_select',
    )
);
$wp_customize->add_control(
    'restochef_options[header_style]',
    array(
        'label'       => __( 'Header Style', 'restochef' ),
        'description' => __( 'Some options related to header may not show in the front-end based on header style chosen.', 'restochef' ),

        'section'     => 'header_options',
        'type'        => 'select',
        'choices'     => array(
            'header_style_1' => __( 'Header Banner With Slider', 'restochef' ),
            'header_style_2' => __( 'Header Banner With Video', 'restochef' ),
        ),
    )
);

$wp_customize->add_setting(
    'restochef_section_seperator_header_2',
    array(
        'default'           => '',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field'
    )
);

$wp_customize->add_control(
    new Restochef_Seperator_Control(
        $wp_customize,
        'restochef_section_seperator_header_2',
        array(
            'settings' => 'restochef_section_seperator_header_2',
            'section' => 'header_options',
        )
    )
);

$wp_customize->add_setting(
    'restochef_options[header_button_label]',
    array(
        'default'           => $default_options['header_button_label'],
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control(
    'restochef_options[header_button_label]',
    array(
        'label'    => __( 'Header Button Label', 'restochef' ),
        'section'  => 'header_options',
        'type'     => 'text',
    )
);


$wp_customize->add_setting( 'header_button_url',
    array(
    'default'           => '',
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'esc_url_raw',
    )
);
$wp_customize->add_control( 'header_button_url',
    array(
    'label'       => esc_html__( 'Header Button URL', 'restochef' ),
    'section'     => 'header_options',
    'type'        => 'text',
    )
);

/*Enable Sticky Menu*/
$wp_customize->add_setting(
    'restochef_options[enable_sticky_menu]',
    array(
        'default'           => $default_options['enable_sticky_menu'],
        'sanitize_callback' => 'restochef_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'restochef_options[enable_sticky_menu]',
    array(
        'label'    => __( 'Enable Sticky Menu', 'restochef' ),
        'section'  => 'header_options',
        'type'     => 'checkbox',
    )
);


$wp_customize->add_setting(
    'restochef_section_seperator_header_4',
    array(
        'default'           => '',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field'
    )
);

$wp_customize->add_control(
    new Restochef_Seperator_Control(
        $wp_customize,
        'restochef_section_seperator_header_4',
        array(
            'settings' => 'restochef_section_seperator_header_4',
            'section' => 'header_options',
        )
    )
);

if(class_exists( 'WooCommerce' )){
    
    /*Enable Mini Cart Icon on header*/
    $wp_customize->add_setting(
        'restochef_options[enable_mini_cart_header]',   
        array(
            'default'           => $default_options['enable_mini_cart_header'],
            'sanitize_callback' => 'restochef_sanitize_checkbox',
        )
    );
    $wp_customize->add_control(
        'restochef_options[enable_mini_cart_header]',
        array(
            'label'    => __( 'Enable Mini Cart Icon', 'restochef' ),
            'section'  => 'header_options',
            'type'     => 'checkbox',
        )
    );

    /*Enable Myaccount Link*/
    $wp_customize->add_setting(
        'restochef_options[enable_woo_my_account]',   
        array(
            'default'           => $default_options['enable_woo_my_account'],
            'sanitize_callback' => 'restochef_sanitize_checkbox',
        )
    );
    $wp_customize->add_control(
        'restochef_options[enable_woo_my_account]',
        array(
            'label'    => __( 'Enable My Account Icon', 'restochef' ),
            'section'  => 'header_options',
            'type'     => 'checkbox',
        )
    );
}