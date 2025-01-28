<?php
/*Add Home Page Options Panel.*/
$wp_customize->add_panel(
    'theme_home_option_panel',
    array(
        'title' => __( 'Front Page Options', 'restochef' ),
        'description' => __( 'Contains all front page settings', 'restochef'),
        'priority' => 50
    )
);
/**/
$wp_customize->add_section(
    'home_page_banner_option',
    array(
        'title'      => __( 'Main Banner Options', 'restochef' ),
        'panel'      => 'theme_home_option_panel',
    )
);

/* Home Page Layout */
$wp_customize->add_setting(
    'restochef_options[enable_banner_section]',
    array(
        'default'           => $default_options['enable_banner_section'],
        'sanitize_callback' => 'restochef_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'restochef_options[enable_banner_section]',
    array(
        'label'   => __( 'Enable Banner Section', 'restochef' ),
        'section' => 'home_page_banner_option',
        'type'    => 'checkbox',
    )
);

$wp_customize->add_setting(
    'restochef_options[number_of_slider_post]',
    array(
        'default'           => $default_options['number_of_slider_post'],
        'sanitize_callback' => 'restochef_sanitize_select',
    )
);
$wp_customize->add_control(
    'restochef_options[number_of_slider_post]',
    array(
        'label'       => __( 'Post In Slider', 'restochef' ),
        'section'     => 'home_page_banner_option',
        'type'        => 'select',
        'choices'     => array(
            '3' => __( '3', 'restochef' ),
            '4' => __( '4', 'restochef' ),
            '5' => __( '5', 'restochef' ),
            '6' => __( '6', 'restochef' ),
        ),
    )
);


$wp_customize->add_setting(
    'restochef_options[slider_post_content_alignment]',
    array(
        'default'           => $default_options['slider_post_content_alignment'],
        'sanitize_callback' => 'restochef_sanitize_select',
    )
);
$wp_customize->add_control(
    'restochef_options[slider_post_content_alignment]',
    array(
        'label'       => __( 'Slider Content Alignment', 'restochef' ),
        'section'     => 'home_page_banner_option',
        'type'        => 'select',
        'choices'     => array(
            'text-right' => __( 'Align Right', 'restochef' ),
            'text-center' => __( 'Align Center', 'restochef' ),
            'text-left' => __( 'Align Left', 'restochef' ),
        ),
    )
);

$wp_customize->add_setting(
    'restochef_options[banner_section_cat]',
    array(
        'default'           => $default_options['banner_section_cat'],
        'sanitize_callback' => 'restochef_sanitize_select',
    )
);
$wp_customize->add_control(
    'restochef_options[banner_section_cat]',
    array(
        'label'   => __( 'Choose Banner Category', 'restochef' ),
        'section' => 'home_page_banner_option',
            'type'        => 'select',
        'choices'     => restochef_post_category_list(),
    )
);

$wp_customize->add_setting(
    'restochef_options[enable_banner_post_description]',
    array(
        'default'           => $default_options['enable_banner_post_description'],
        'sanitize_callback' => 'restochef_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'restochef_options[enable_banner_post_description]',
    array(
        'label'   => __( 'Enable Post Description', 'restochef' ),
        'section' => 'home_page_banner_option',
        'type'    => 'checkbox',
    )
);

$wp_customize->add_setting(
    'restochef_options[enable_banner_cat_meta]',
    array(
        'default'           => $default_options['enable_banner_cat_meta'],
        'sanitize_callback' => 'restochef_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'restochef_options[enable_banner_cat_meta]',
    array(
        'label'   => __( 'Enable Category Meta', 'restochef' ),
        'section' => 'home_page_banner_option',
        'type'    => 'checkbox',
    )
);


$wp_customize->add_setting(
    'restochef_options[enable_banner_author_meta]',
    array(
        'default'           => $default_options['enable_banner_author_meta'],
        'sanitize_callback' => 'restochef_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'restochef_options[enable_banner_author_meta]',
    array(
        'label'   => __( 'Enable Author Meta', 'restochef' ),
        'section' => 'home_page_banner_option',
        'type'    => 'checkbox',
    )
);


$wp_customize->add_setting(
    'restochef_options[enable_banner_date_meta]',
    array(
        'default'           => $default_options['enable_banner_date_meta'],
        'sanitize_callback' => 'restochef_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'restochef_options[enable_banner_date_meta]',
    array(
        'label'   => __( 'Enable Date On Banner', 'restochef' ),
        'section' => 'home_page_banner_option',
        'type'    => 'checkbox',
    )
);

$wp_customize->add_setting(
    'restochef_options[enable_banner_overlay]',
    array(
        'default'           => $default_options['enable_banner_overlay'],
        'sanitize_callback' => 'restochef_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'restochef_options[enable_banner_overlay]',
    array(
        'label'   => __( 'Enable Banner Overlay', 'restochef' ),
        'section' => 'home_page_banner_option',
        'type'    => 'checkbox',
    )
);