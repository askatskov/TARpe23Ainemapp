<?php
/*Add header add option*/
$wp_customize->add_section(
    'site_add_options' ,
    array(
        'title' => __( 'Welcome Screen', 'restochef' ),
        'panel' => 'restochef_option_panel',
    )
);


/*Enable advertisement*/
$wp_customize->add_setting(
    'restochef_options[ed_header_ad]',
    array(
        'default'           => $default_options['ed_header_ad'],
        'sanitize_callback' => 'restochef_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'restochef_options[ed_header_ad]',
    array(
        'label'    => __( 'Enable Welcome Screen', 'restochef' ),
        'section'  => 'site_add_options',
        'type'     => 'checkbox',
    )
);


$wp_customize->add_setting(
    'restochef_options[ed_header_type]',
    array(
        'default'           => $default_options['ed_header_type'],
        'sanitize_callback' => 'restochef_sanitize_select',
    )
);
$wp_customize->add_control(
    'restochef_options[ed_header_type]',
    array(
        'label'       => __( 'Advertisement Design Layout', 'restochef' ),
        'section'     => 'site_add_options',
        'type'        => 'select',
        'choices'     => array(
            'welcome-banner-full-viewport'  => esc_html__( 'Full Viewport', 'restochef' ),
            'welcome-banner-default'  => esc_html__( 'Default', 'restochef' ),
        ),
    )
);

$wp_customize->add_setting(
    'restochef_options[advertisement_section_title]',
    array(
        'default'           => $default_options['advertisement_section_title'],
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control(
    'restochef_options[advertisement_section_title]',
    array(
        'label'    => __( 'Welcome Message', 'restochef' ),
        'section'  => 'site_add_options',
        'type'     => 'text',
    )
);

$wp_customize->add_setting(
    'restochef_options[upload_add_image]',
    array(
        'default'           => '',
        'sanitize_callback' => 'restochef_sanitize_image',
    )
);
$wp_customize->add_control(
    new WP_Customize_Image_Control(
        $wp_customize,
        'restochef_options[upload_add_image]',
        array(
            'label'           => __( 'Upload Advertisement Image', 'restochef' ),
            'section'         => 'site_add_options',
        )
    )
);

$wp_customize->add_setting(
    'restochef_options[ad_banner_link]',
    array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    )
);
$wp_customize->add_control(
    'restochef_options[ad_banner_link]',
    array(
        'label'           => __( 'Advertisement Link', 'restochef' ),
        'section'         => 'site_add_options',
        'type'            => 'text',
        'description'     => __( 'Leave empty if you don\'t want the image to have a link', 'restochef' ),
    )
);
