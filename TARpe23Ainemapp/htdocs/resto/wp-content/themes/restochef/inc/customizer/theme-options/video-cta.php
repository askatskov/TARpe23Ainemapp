<?php
$wp_customize->add_section(
    'home_page_video_cta_option',
    array(
        'title'      => __( 'Video CTA Section Options', 'restochef' ),
        'panel'      => 'theme_home_option_panel',
    )
);

$wp_customize->add_setting(
    'restochef_options[enable_video_cta_section]',
    array(
        'default'           => $default_options['enable_video_cta_section'],
        'sanitize_callback' => 'restochef_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'restochef_options[enable_video_cta_section]',
    array(
        'label'   => __( 'Enable Video CTA Section', 'restochef' ),
        'section' => 'home_page_video_cta_option',
        'type'    => 'checkbox',
    )
);

$wp_customize->add_setting(
    'restochef_options[video_cta_post_title]',
    array(
        'default'           => $default_options['video_cta_post_title'],
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control(
    'restochef_options[video_cta_post_title]',
    array(
        'label'    => __( 'Video CTA Posts Title', 'restochef' ),
        'section'  => 'home_page_video_cta_option',
        'type'     => 'text',
    )
);

$wp_customize->add_setting(
    'restochef_options[video_cta_post_sub_title]',
    array(
        'default'           => $default_options['video_cta_post_sub_title'],
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control(
    'restochef_options[video_cta_post_sub_title]',
    array(
        'label'    => __( 'Video CTA Posts Sub Title', 'restochef' ),
        'section'  => 'home_page_video_cta_option',
        'type'     => 'text',
    )
);

$wp_customize->add_setting(
    'restochef_options[upload_video_image_1]',
    array(
        'default'           => '',
        'sanitize_callback' => 'restochef_sanitize_image',
    )
);
$wp_customize->add_control(
    new WP_Customize_Image_Control(
        $wp_customize,
        'restochef_options[upload_video_image_1]',
        array(
            'label'           => __( 'Upload Background Image', 'restochef' ),
            'section'         => 'home_page_video_cta_option',
        )
    )
);



$wp_customize->add_setting(
    'restochef_options[video_url_link]',
    array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    )
);
$wp_customize->add_control(
    'restochef_options[video_url_link]',
    array(
        'label'           => __( 'Video URL Link:', 'restochef' ),
        'section'         => 'home_page_video_cta_option',
        'type'            => 'text',
        'description'     => __( 'Leave empty if you don\'t want the have a this link', 'restochef' ),
    )
);


$wp_customize->add_setting(
    'restochef_options[video_cta_button_text]',
    array(
        'default'           => $default_options['video_cta_button_text'],
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control(
    'restochef_options[video_cta_button_text]',
    array(
        'label'    => __( 'Video Cta Button Text', 'restochef' ),
        'section'  => 'home_page_video_cta_option',
        'type'     => 'text',
    )
);

$wp_customize->add_setting(
    'restochef_options[video_cta_button_url]',
    array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    )
);
$wp_customize->add_control(
    'restochef_options[video_cta_button_url]',
    array(
        'label'           => __( 'Video Cta Button URL:', 'restochef' ),
        'section'         => 'home_page_video_cta_option',
        'type'            => 'text',
        'description'     => __( 'Leave empty if you don\'t want the have a this link', 'restochef' ),
    )
);
