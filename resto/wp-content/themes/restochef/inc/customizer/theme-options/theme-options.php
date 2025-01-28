<?php
$wp_customize->remove_setting('display_header_text');
$wp_customize->remove_control('display_header_text');
$wp_customize->add_setting(
    'restochef_options[hide_title]',
    array(
        'default' => $default_options['hide_title'],
        'sanitize_callback' => 'restochef_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'restochef_options[hide_title]',
    array(
        'type' => 'checkbox',
        'label' => __( 'Hide Site Title', 'restochef' ),
        'section' => 'title_tagline',
        'priority' => 10,
    )
);

$wp_customize->add_setting(
    'restochef_options[hide_tagline]',
    array(
        'default' => $default_options['hide_tagline'],
        'sanitize_callback' => 'restochef_sanitize_checkbox',
    )
);

$wp_customize->add_control(
    'restochef_options[hide_tagline]',
    array(
        'type' => 'checkbox',
        'label' => __( 'Hide Tagline', 'restochef' ),
        'section' => 'title_tagline',
        'priority' => 10,
    )
);

/*Site title text size*/
$wp_customize->add_setting(
    'restochef_options[site_title_text_size]',
    array(
        'default' => $default_options['site_title_text_size'],
        'sanitize_callback' => 'absint',
    )
);
$wp_customize->add_control(
    'restochef_options[site_title_text_size]',
    array(
        'label' => __('Site Title Text Size', 'restochef'),
        'description' => __('( Default: 42px ) Changes\'re only applicable to desktop version.', 'restochef'),
        'section' => 'title_tagline',
        'type' => 'number',
        'input_attrs' => array('min' => 1, 'max' => 100, 'style' => 'width: 150px;'),
    )
);
$wp_customize->add_setting(
    'restochef_options[site_tagline_text_size]',
    array(
        'default' => $default_options['site_tagline_text_size'],
        'sanitize_callback' => 'absint',
    )
);
$wp_customize->add_control(
    'restochef_options[site_tagline_text_size]',
    array(
        'label' => __('Site Tagline Text Size', 'restochef'),
        'description' => __('( Default: 16px ) Changes\'re only applicable to desktop version.', 'restochef'),
        'section' => 'title_tagline',
        'type' => 'number',
        'input_attrs' => array('min' => 1, 'max' => 100, 'style' => 'width: 150px;'),
    )
);
/**/

/*Add Theme Options Panel.*/
$wp_customize->add_panel(
    'restochef_option_panel',
    array(
        'title' => __( 'Theme Options', 'restochef' ),
        'description' => __( 'Contains all theme settings', 'restochef'),
        'priority' => 200
    )
);
/**/