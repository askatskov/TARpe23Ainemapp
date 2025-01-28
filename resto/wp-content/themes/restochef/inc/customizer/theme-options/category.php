<?php
/**/
$wp_customize->add_section(
    'home_page_category_option',
    array(
        'title'      => __( 'Menu Categories Grid Options', 'restochef' ),
        'panel'      => 'theme_home_option_panel',
    )
);

$wp_customize->add_setting(
    'restochef_options[enable_category_section]',
    array(
        'default'           => $default_options['enable_category_section'],
        'sanitize_callback' => 'restochef_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'restochef_options[enable_category_section]',
    array(
        'label'   => __( 'Enable Menu Category Section', 'restochef' ),
        'section' => 'home_page_category_option',
        'type'    => 'checkbox',
    )
);

$wp_customize->add_setting(
    'restochef_options[category_section_title]',
    array(
        'default'           => $default_options['category_section_title'],
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control(
    'restochef_options[category_section_title]',
    array(
        'label'    => __( 'Menu Category Section Title', 'restochef' ),
        'section'  => 'home_page_category_option',
        'type'     => 'text',
    )
);


$wp_customize->add_setting(
    'restochef_options[category_section_content]',
    array(
        'default'           => $default_options['category_section_content'],
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control(
    'restochef_options[category_section_content]',
    array(
        'label'    => __( 'Menu Category Section Content', 'restochef' ),
        'section'  => 'home_page_category_option',
        'type'     => 'text',
    )
);

for ( $i=1; $i <=  6 ; $i++ ) {
        $wp_customize->add_setting( 'select_featured_cat_'. $i, array(
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'restochef_sanitize_select',
            
        ) );

        $wp_customize->add_control( 'select_featured_cat_'. $i, array(
            'input_attrs'       => array(
                'style'           => 'width: 50px;'
                ),
            'label'             => __( 'Select Menu Category', 'restochef' ) . ' - ' . $i ,
            'section'           => 'home_page_category_option',
                            'type'        => 'select',
            'choices'     => restochef_post_category_list(),
            )
        );
    }



    $wp_customize->add_setting(
        'restochef_options[category_section_bg_image]',
        array(
            'default'           => '',
            'sanitize_callback' => 'restochef_sanitize_image',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'restochef_options[category_section_bg_image]',
            array(
                'label'           => __( 'Section Background Image', 'restochef' ),
                'section'         => 'home_page_category_option',
            )
        )
    );


    $wp_customize->add_setting(
        'restochef_options[enable_image_fix_option]',
        array(
            'default'           => $default_options['enable_image_fix_option'],
            'sanitize_callback' => 'restochef_sanitize_checkbox',
        )
    );
    $wp_customize->add_control(
        'restochef_options[enable_image_fix_option]',
        array(
            'label'   => __( 'Enable Image Fix', 'restochef' ),
            'section' => 'home_page_category_option',
            'type'    => 'checkbox',
        )
    );
