<?php
/**/
$wp_customize->add_section(
    'home_page_featured_menu_option',
    array(
        'title'      => __( 'Menu Featured Menu Options', 'restochef' ),
        'panel'      => 'theme_home_option_panel',
    )
);

$wp_customize->add_setting(
    'restochef_options[enable_featured_menu_section]',
    array(
        'default'           => $default_options['enable_featured_menu_section'],
        'sanitize_callback' => 'restochef_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'restochef_options[enable_featured_menu_section]',
    array(
        'label'   => __( 'Enable Menu Category Section', 'restochef' ),
        'section' => 'home_page_featured_menu_option',
        'type'    => 'checkbox',
    )
);

$wp_customize->add_setting(
    'restochef_options[featured_menu_section_title]',
    array(
        'default'           => $default_options['featured_menu_section_title'],
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control(
    'restochef_options[featured_menu_section_title]',
    array(
        'label'    => __( 'Menu Category Section Title', 'restochef' ),
        'section'  => 'home_page_featured_menu_option',
        'type'     => 'text',
    )
);

$wp_customize->add_setting(
    'restochef_options[select_featured_menu_option_cat]',
    array(
        'default'           => $default_options['select_featured_menu_option_cat'],
        'sanitize_callback' => 'restochef_sanitize_select',
    )
);
$wp_customize->add_control(
    'restochef_options[select_featured_menu_option_cat]',
    array(
        'label'   => __( 'Choose Footer Related Post Category', 'restochef' ),
        'section' => 'home_page_featured_menu_option',
            'type'        => 'select',
        'choices'     => restochef_post_category_list(),
    )
);
