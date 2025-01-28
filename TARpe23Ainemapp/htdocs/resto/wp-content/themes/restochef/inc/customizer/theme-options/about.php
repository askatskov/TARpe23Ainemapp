<?php
/**/
$wp_customize->add_section(
    'home_page_about_option',
    array(
        'title'      => __( 'About Section Options', 'restochef' ),
        'panel'      => 'theme_home_option_panel',
    )
);

$wp_customize->add_setting(
    'restochef_options[enable_about_section]',
    array(
        'default'           => $default_options['enable_about_section'],
        'sanitize_callback' => 'restochef_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'restochef_options[enable_about_section]',
    array(
        'label'   => __( 'Enable About Section', 'restochef' ),
        'section' => 'home_page_about_option',
        'type'    => 'checkbox',
    )
);

$wp_customize->add_setting(
    'restochef_options[about_post_title]',
    array(
        'default'           => $default_options['about_post_title'],
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control(
    'restochef_options[about_post_title]',
    array(
        'label'    => __( 'About Posts Title', 'restochef' ),
        'section'  => 'home_page_about_option',
        'type'     => 'text',
    )
);

$wp_customize->add_setting( 'select_about_page', array(
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'restochef_sanitize_dropdown_pages',
) );

$wp_customize->add_control( 'select_about_page', array(
    'input_attrs'       => array(
        'style'           => 'width: 50px;'
        ),
    'label'             => __( 'Select About Page', 'restochef' ) ,
    'section'           => 'home_page_about_option',
    'type'              => 'dropdown-pages',
    )
);

$wp_customize->add_setting(
    'restochef_options[about_section_button_text]',
    array(
        'default'           => $default_options['about_section_button_text'],
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control(
    'restochef_options[about_section_button_text]',
    array(
        'label'    => __( 'About Section Button Text', 'restochef' ),
        'section'  => 'home_page_about_option',
        'type'     => 'text',
    )
);

$wp_customize->add_setting(
    'restochef_options[about_section_button_url]',
    array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    )
);
$wp_customize->add_control(
    'restochef_options[about_section_button_url]',
    array(
        'label'           => __( 'About Section Button URL:', 'restochef' ),
        'section'         => 'home_page_about_option',
        'type'            => 'text',
        'description'     => __( 'Leave empty if you don\'t want to have a link', 'restochef' ),
    )
);

