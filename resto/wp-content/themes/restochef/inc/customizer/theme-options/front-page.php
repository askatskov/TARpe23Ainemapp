<?php
$wp_customize->add_section(
    'home_page_layout_options',
    array(
        'title'      => __( 'Front Page Sidebar Options', 'restochef' ),
        'panel'      => 'restochef_option_panel',
    )
);

/* Home Page Layout */
$wp_customize->add_setting(
    'restochef_options[front_page_layout]',
    array(
        'default'           => $default_options['front_page_layout'],
        'sanitize_callback' => 'restochef_sanitize_select',
    )
);
$wp_customize->add_control(
    new Restochef_Radio_Image_Control(
        $wp_customize,
        'restochef_options[front_page_layout]',
        array(
            'label'	=> __( 'Front Page Sidebar Layout', 'restochef' ),
            'section' => 'home_page_layout_options',
            'choices' => restochef_get_general_layouts(),
        )
    )
);

// Hide Side Bar on Mobile
$wp_customize->add_setting(
    'restochef_options[hide_front_page_sidebar_mobile]',
    array(
        'default'           => $default_options['hide_front_page_sidebar_mobile'],
        'sanitize_callback' => 'restochef_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'restochef_options[hide_front_page_sidebar_mobile]',
    array(
        'label'       => __( 'Hide Front Page Sidebar on Mobile', 'restochef' ),
        'section'     => 'home_page_layout_options',
        'type'        => 'checkbox',
    )
);

// Different Sidebar for front page
$wp_customize->add_setting(
    'restochef_options[front_page_enable_sidebar]',
    array(
        'default'           => $default_options['front_page_enable_sidebar'],
        'sanitize_callback' => 'restochef_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'restochef_options[front_page_enable_sidebar]',
    array(
        'label'       => __( 'Different sidebar for the front page.', 'restochef' ),
        'section'     => 'home_page_layout_options',
        'description' => __( 'Widgets on this sidebar widget will reset if disabled.', 'restochef'),
        'type'        => 'checkbox',
    )
);