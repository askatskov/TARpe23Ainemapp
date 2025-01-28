<?php
$wp_customize->add_section(
    'home_page_shop_option',
    array(
        'title'      => __( 'Shop  Section Options', 'restochef' ),
        'panel'      => 'theme_home_option_panel',
    )
);

/* Home Page Layout */
$wp_customize->add_setting(
    'restochef_options[enable_shop_section]',
    array(
        'default'           => $default_options['enable_shop_section'],
        'sanitize_callback' => 'restochef_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'restochef_options[enable_shop_section]',
    array(
        'label'   => __( 'Enable Shop Section', 'restochef' ),
        'section' => 'home_page_shop_option',
        'type'    => 'checkbox',
    )
);

$wp_customize->add_setting(
    'restochef_options[shop_post_title]',
    array(
        'default'           => $default_options['shop_post_title'],
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control(
    'restochef_options[shop_post_title]',
    array(
        'label'    => __( 'Shop Post Title', 'restochef' ),
        'section'  => 'home_page_shop_option',
        'type'     => 'text',
    )
);

$wp_customize->add_setting(
    'restochef_options[shop_post_description]',
    array(
        'default'           => $default_options['shop_post_description'],
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control(
    'restochef_options[shop_post_description]',
    array(
        'label'    => __( 'Shop Post Description', 'restochef' ),
        'section'  => 'home_page_shop_option',
        'type'     => 'textarea',
    )
);

$wp_customize->add_setting(
    'restochef_options[shop_select_product_from]',
    array(
        'default'           => $default_options['shop_select_product_from'],
        'sanitize_callback' => 'restochef_sanitize_select',
    )
);
$wp_customize->add_control(
    'restochef_options[shop_select_product_from]',
    array(
        'label'       => __( 'Select Product From', 'restochef' ),
        'section'     => 'home_page_shop_option',
        'type'        => 'select',
        'choices' => array(
            'custom'            => __('Custom Select', 'restochef'),
            'recent-products'   => __('Recent Products', 'restochef'),
            'popular-products'  => __('Popular Products', 'restochef'),
            'sale-products'     => __('Sale Products', 'restochef'),
        )
    )
);


$wp_customize->add_setting(
    'restochef_options[select_product_category]',
    array(
        'default'           => $default_options['select_product_category'],
        'sanitize_callback' => 'restochef_sanitize_select',
    )
);
$wp_customize->add_control(
    'restochef_options[select_product_category]',
    array(
        'label'   => __( 'Select Product Category', 'restochef' ),
        'section' => 'home_page_shop_option',
        'type'        => 'select',
        'choices'     => restochef_woocommerce_product_cat(),
        'active_callback' => 'restochef_shop_select_product_from'
    )
);

$wp_customize->add_setting(
    'restochef_options[shop_number_of_column]',
    array(
        'default'           => $default_options['shop_number_of_column'],
        'sanitize_callback' => 'restochef_sanitize_select',
    )
);
$wp_customize->add_control(
    'restochef_options[shop_number_of_column]',
    array(
        'label'       => __( 'Select Number Of Column', 'restochef' ),
        'section'     => 'home_page_shop_option',
        'type'        => 'select',
        'choices' => array(
            '2'  => __('2', 'restochef'),
            '3'  => __('3', 'restochef'),
            '4'  => __('4', 'restochef'),
        )
    )
);

$wp_customize->add_setting(
    'restochef_options[shop_number_of_product]',
    array(
        'default'           => $default_options['shop_number_of_product'],
        'sanitize_callback' => 'restochef_sanitize_select',
    )
);
$wp_customize->add_control(
    'restochef_options[shop_number_of_product]',
    array(
        'label'       => __( 'Select Number Of Product', 'restochef' ),
        'section'     => 'home_page_shop_option',
        'type'        => 'select',
        'choices' => array(
            '2'  => __('2', 'restochef'),
            '3'  => __('3', 'restochef'),
            '4'  => __('4', 'restochef'),
            '5'  => __('5', 'restochef'),
            '6'  => __('6', 'restochef'),
            '7'  => __('7', 'restochef'),
            '8'  => __('8', 'restochef'),
            '9'  => __('9', 'restochef'),
            '10'  => __('10', 'restochef'),
            '11'  => __('11', 'restochef'),
            '12'  => __('12', 'restochef'),
        )
    )
);

$wp_customize->add_setting(
    'restochef_options[shop_post_button_text]',
    array(
        'default'           => $default_options['shop_post_button_text'],
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control(
    'restochef_options[shop_post_button_text]',
    array(
        'label'    => __( 'Shop section Button Text', 'restochef' ),
        'section'  => 'home_page_shop_option',
        'type'     => 'text',
    )
);
$wp_customize->add_setting(
    'restochef_options[shop_post_button_url]',
    array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    )
);
$wp_customize->add_control(
    'restochef_options[shop_post_button_url]',
    array(
        'label'           => __( 'Button Link', 'restochef' ),
        'section'         => 'home_page_shop_option',
        'type'            => 'text',
        'description'     => __( 'Leave empty if you don\'t want the image to have a link', 'restochef' ),
    )
);