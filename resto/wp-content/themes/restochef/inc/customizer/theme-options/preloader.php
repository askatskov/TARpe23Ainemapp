<?php
/*Preloader Options*/
$wp_customize->add_section(
    'preloader_options' ,
    array(
        'title' => __( 'Preloader Options', 'restochef' ),
        'panel' => 'restochef_option_panel',
    )
);

/*Show Preloader*/
$wp_customize->add_setting(
    'restochef_options[show_preloader]',
    array(
        'default'           => $default_options['show_preloader'],
        'sanitize_callback' => 'restochef_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'restochef_options[show_preloader]',
    array(
        'label'    => __( 'Show Preloader', 'restochef' ),
        'section'  => 'preloader_options',
        'type'     => 'checkbox',
    )
);

$wp_customize->add_setting(
    'restochef_options[preloader_style]',
    array(
        'default'           => $default_options['preloader_style'],
        'sanitize_callback' => 'restochef_sanitize_select',
    )
);
$wp_customize->add_control(
    'restochef_options[preloader_style]',
    array(
        'label'       => __( 'Preloader Style', 'restochef' ),
        'section'     => 'preloader_options',
        'type'        => 'select',
        'choices'     => array(
            'theme-preloader-spinner-1' => __( 'Style 1', 'restochef' ),
            'theme-preloader-spinner-2' => __( 'Style 2', 'restochef' ),
        ),
        'active_callback' => 'restochef_is_show_preloader',

    )
);
