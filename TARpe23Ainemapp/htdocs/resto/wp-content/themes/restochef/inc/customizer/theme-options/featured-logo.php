<?php
/**/
$wp_customize->add_section(
    'home_page_logo_option',
    array(
        'title'      => __( 'Logo Section Options', 'restochef' ),
        'panel'      => 'theme_home_option_panel',
    )
);

$wp_customize->add_setting(
    'restochef_options[enable_logo_section]',
    array(
        'default'           => $default_options['enable_logo_section'],
        'sanitize_callback' => 'restochef_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'restochef_options[enable_logo_section]',
    array(
        'label'   => __( 'Enable Logo Section', 'restochef' ),
        'section' => 'home_page_logo_option',
        'type'    => 'checkbox',
    )
);


for ($i=1; $i <= 7 ; $i++) { 
    $wp_customize->add_setting(
        'restochef_options[upload_image_'.$i.']',
        array(
            'default'           => '',
            'sanitize_callback' => 'restochef_sanitize_image',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'restochef_options[upload_image_'.$i.']',
            array(
                'label'           => __( 'Upload Featured Logo - ', 'restochef' ). $i,
                'section'         => 'home_page_logo_option',
            )
        )
    );

    $wp_customize->add_setting(
        'restochef_options[upload_image_link_'.$i.']',
        array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
        )
    );
    $wp_customize->add_control(
        'restochef_options[upload_image_link_'.$i.']',
        array(
            'label'           => __( 'Upload Logo Link - ', 'restochef' ).$i,
            'section'         => 'home_page_logo_option',
            'type'            => 'text',
            'description'     => __( 'Leave empty if you don\'t want the image to have a link', 'restochef' ),
        )
    );

 }
