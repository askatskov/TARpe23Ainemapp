<?php
/**/
$wp_customize->add_section(
    'home_page_contact_option',
    array(
        'title'      => __( 'Contact Section Options', 'restochef' ),
        'panel'      => 'theme_home_option_panel',
    )
);

$wp_customize->add_setting(
    'restochef_options[enable_contact_section]',
    array(
        'default'           => $default_options['enable_contact_section'],
        'sanitize_callback' => 'restochef_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'restochef_options[enable_contact_section]',
    array(
        'label'   => __( 'Enable Contact Section', 'restochef' ),
        'section' => 'home_page_contact_option',
        'type'    => 'checkbox',
    )
);


$wp_customize->add_setting( 'select_contact_page', array(
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'restochef_sanitize_dropdown_pages',
) );

$wp_customize->add_control( 'select_contact_page', array(
    'input_attrs'       => array(
        'style'           => 'width: 50px;'
        ),
    'label'             => __( 'Select Contact Page', 'restochef' ) ,
    'section'           => 'home_page_contact_option',
    'type'              => 'dropdown-pages',
    )
);
