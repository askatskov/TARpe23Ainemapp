<?php
/**/
$wp_customize->add_section(
    'home_page_image_option',
    array(
        'title'      => __( 'Image Gallery Section Options', 'restochef' ),
        'panel'      => 'theme_home_option_panel',
    )
);

$wp_customize->add_setting(
    'restochef_options[enable_image_gallery_section]',
    array(
        'default'           => $default_options['enable_image_gallery_section'],
        'sanitize_callback' => 'restochef_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'restochef_options[enable_image_gallery_section]',
    array(
        'label'   => __( 'Enable Image Gallery Section', 'restochef' ),
        'section' => 'home_page_image_option',
        'type'    => 'checkbox',
    )
);



$wp_customize->add_setting(
    'restochef_options[image_gallery_title]',
    array(
        'default'           => $default_options['image_gallery_title'],
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control(
    'restochef_options[image_gallery_title]',
    array(
        'label'    => __( 'Image Gallery Title', 'restochef' ),
        'section'  => 'home_page_image_option',
        'type'     => 'text',
    )
);


$wp_customize->add_setting(
    'restochef_options[image_gallery_sub_title]',
    array(
        'default'           => $default_options['image_gallery_sub_title'],
        'sanitize_callback' => 'wp_kses_post',
    )
);
$wp_customize->add_control(
    'restochef_options[image_gallery_sub_title]',
    array(
        'label'    => __( 'Image Gallery Sub Title', 'restochef' ),
        'section'  => 'home_page_image_option',
        'type'     => 'textarea',
    )
);

for ($i=1; $i <= 6 ; $i++) { 
    $wp_customize->add_setting(
        'restochef_options[upload_image_gallery_'.$i.']',
        array(
            'default'           => '',
            'sanitize_callback' => 'restochef_sanitize_image',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'restochef_options[upload_image_gallery_'.$i.']',
            array(
                'label'           => __( 'Upload Image - ', 'restochef' ). $i,
                'section'         => 'home_page_image_option',
            )
        )
    );

    $wp_customize->add_setting(
        'restochef_options[upload_image_gallery_link_'.$i.']',
        array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
        )
    );
    $wp_customize->add_control(
        'restochef_options[upload_image_gallery_link_'.$i.']',
        array(
            'label'           => __( 'Upload Image Link - ', 'restochef' ).$i,
            'section'         => 'home_page_image_option',
            'type'            => 'text',
            'description'     => __( 'Leave empty if you don\'t want the image to have a link', 'restochef' ),
        )
    );

}


