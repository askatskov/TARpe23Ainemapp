<?php
/**/
$wp_customize->add_section(
    'home_page_time_bar_option',
    array(
        'title'      => __( 'Time Bar Section Options', 'restochef' ),
        'panel'      => 'theme_home_option_panel',
    )
);

$wp_customize->add_setting(
    'restochef_options[enable_time_bar_section]',
    array(
        'default'           => $default_options['enable_time_bar_section'],
        'sanitize_callback' => 'restochef_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'restochef_options[enable_time_bar_section]',
    array(
        'label'   => __( 'Enable Time Bar Section', 'restochef' ),
        'section' => 'home_page_time_bar_option',
        'type'    => 'checkbox',
    )
);


$wp_customize->add_setting(
    'restochef_options[enable_time_bar_fullwidth]',
    array(
        'default'           => $default_options['enable_time_bar_fullwidth'],
        'sanitize_callback' => 'restochef_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'restochef_options[enable_time_bar_fullwidth]',
    array(
        'label'   => __( 'Enable Time Bar Full Width', 'restochef' ),
        'section' => 'home_page_time_bar_option',
        'type'    => 'checkbox',
    )
);


$wp_customize->add_setting(
    'restochef_options[time_bar_title_1]',
    array(
        'default'           => $default_options['time_bar_title_1'],
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control(
    'restochef_options[time_bar_title_1]',
    array(
        'label'    => __( 'Time Bar Title - 1', 'restochef' ),
        'section'  => 'home_page_time_bar_option',
        'type'     => 'text',
    )
);

$wp_customize->add_setting(
    'restochef_options[time_bar_content_1]',
    array(
        'default'           => $default_options['time_bar_content_1'],
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control(
    'restochef_options[time_bar_content_1]',
    array(
        'label'    => __( 'Time Bar Content - 1', 'restochef' ),
        'section'  => 'home_page_time_bar_option',
        'type'     => 'text',
    )
);


$wp_customize->add_setting(
    'restochef_options[time_bar_title_2]',
    array(
        'default'           => $default_options['time_bar_title_2'],
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control(
    'restochef_options[time_bar_title_2]',
    array(
        'label'    => __( 'Time Bar Title - 2', 'restochef' ),
        'section'  => 'home_page_time_bar_option',
        'type'     => 'text',
    )
);

$wp_customize->add_setting(
    'restochef_options[time_bar_content_2]',
    array(
        'default'           => $default_options['time_bar_content_2'],
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control(
    'restochef_options[time_bar_content_2]',
    array(
        'label'    => __( 'Time Bar Content - 2', 'restochef' ),
        'section'  => 'home_page_time_bar_option',
        'type'     => 'text',
    )
);


$wp_customize->add_setting(
    'restochef_options[time_bar_title_3]',
    array(
        'default'           => $default_options['time_bar_title_3'],
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control(
    'restochef_options[time_bar_title_3]',
    array(
        'label'    => __( 'Time Bar Title - 3', 'restochef' ),
        'section'  => 'home_page_time_bar_option',
        'type'     => 'text',
    )
);

$wp_customize->add_setting(
    'restochef_options[time_bar_content_3]',
    array(
        'default'           => $default_options['time_bar_content_3'],
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control(
    'restochef_options[time_bar_content_3]',
    array(
        'label'    => __( 'Time Bar Content - 3', 'restochef' ),
        'section'  => 'home_page_time_bar_option',
        'type'     => 'text',
    )
);


$wp_customize->add_setting(
    'restochef_options[time_bar_button_text]',
    array(
        'default'           => $default_options['time_bar_button_text'],
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control(
    'restochef_options[time_bar_button_text]',
    array(
        'label'    => __( 'Time Bar Button Text', 'restochef' ),
        'section'  => 'home_page_time_bar_option',
        'type'     => 'text',
    )
);

$wp_customize->add_setting(
    'restochef_options[time_bar_button_url]',
    array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    )
);
$wp_customize->add_control(
    'restochef_options[time_bar_button_url]',
    array(
        'label'           => __( 'Time Bar Button URL:', 'restochef' ),
        'section'         => 'home_page_time_bar_option',
        'type'            => 'text',
        'description'     => __( 'Leave empty if you don\'t want the have a this link', 'restochef' ),
    )
);

