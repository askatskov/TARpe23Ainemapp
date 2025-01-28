<?php
global $resto_panels;
global $resto_sections;
global $resto_settings_controls;
global $resto_repeated_settings_controls;
global $resto_customizer_defaults;

/*defaults values*/
$resto_customizer_defaults['resto-blog-enable'] = 0;
$resto_customizer_defaults['resto-blog-title'] = __('LATEST NEWS','resto');
$resto_customizer_defaults['resto-blog-sticky-excerpt-number'] = 40;
$resto_customizer_defaults['resto-blog-number'] = 4;
$resto_customizer_defaults['resto-blog-excerpt-number'] = 10;
$resto_customizer_defaults['resto-blog-single-button-text'] = __('View Detail','resto');
$resto_customizer_defaults['resto-blog-enable-button'] = 1;
$resto_customizer_defaults['resto-blog-button-text'] = __('Browse more','resto');
$resto_customizer_defaults['resto-home-blog-button-link'] = '#';
$resto_customizer_defaults['resto-blog-category'] = 1;

/*aboutoptions*/
$resto_sections['resto-blog-options'] =
    array(
        'priority'       => 230,
        'title'          => __( 'Home Blog Options', 'resto' ),
    );

$resto_settings_controls['resto-blog-enable'] =
    array(
        'setting' =>     array(
            'default'              => $resto_customizer_defaults['resto-blog-enable']
        ),
        'control' => array(
            'label'                 =>  __( 'Enable Blog', 'resto' ),
            'section'               => 'resto-blog-options',
            'type'                  => 'checkbox',
            'priority'              => 10,
            'active_callback'       => ''
        )
    );

$resto_settings_controls['resto-blog-title'] =
    array(
        'setting' =>     array(
            'default'              => $resto_customizer_defaults['resto-blog-title']
        ),
        'control' => array(
            'label'                 =>  __( 'Main Title', 'resto' ),
            'section'               => 'resto-blog-options',
            'type'                  => 'text',
            'priority'              => 15,
            'active_callback'       => ''
        )
    );

/*String in max to be appear as description on menu*/
$resto_settings_controls['resto-blog-sticky-excerpt-number'] =
    array(
        'setting' =>     array(
            'default'              => $resto_customizer_defaults['resto-blog-sticky-excerpt-number']
        ),
        'control' => array(
            'label'                 =>  __( 'Number Of Words For Sticky Post', 'resto' ),
            'description'           =>  __( 'Give number of words you wish to be appear on home page sticky post section', 'resto' ),
            'section'               => 'resto-blog-options',
            'type'                  => 'number',
            'priority'              => 30,
            'active_callback'       => '',
            'input_attrs' => array( 'min' => 1, 'max' => 200),

        )
    );

$resto_settings_controls['resto-blog-number'] =
    array(
        'setting' =>     array(
            'default'              => $resto_customizer_defaults['resto-blog-number']
        ),
        'control' => array(
            'label'                 =>  __( 'Number Of Blog/s', 'resto' ),
            'description'           =>  __( 'Remember that featured post will not be counted', 'resto' ),
            'section'               => 'resto-blog-options',
            'type'                  => 'select',
            'choices'               => array(
                1 => __( '1', 'resto' ),
                2 => __( '2', 'resto' ),
                3 => __( '3', 'resto' ),
                4 => __( '4', 'resto' ),
            ),
            'priority'              => 40,
            'active_callback'       => ''
        )
    );

/*String in max to be appear as description on menu*/
$resto_settings_controls['resto-blog-excerpt-number'] =
    array(
        'setting' =>     array(
            'default'              => $resto_customizer_defaults['resto-blog-excerpt-number']
        ),
        'control' => array(
            'label'                 =>  __( 'Number Of Words For Blog Post', 'resto' ),
            'description'           =>  __( 'Give number of words you wish to be appear on home page blog post', 'resto' ),
            'section'               => 'resto-blog-options',
            'type'                  => 'number',
            'priority'              => 50,
            'active_callback'       => '',
            'input_attrs' => array( 'min' => 1, 'max' => 200),

        )
    );

$resto_settings_controls['resto-blog-enable-button'] =
    array(
        'setting' =>     array(
            'default'              => $resto_customizer_defaults['resto-blog-enable-button']
        ),
        'control' => array(
            'label'                 =>  __( 'Enable Button', 'resto' ),
            'section'               => 'resto-blog-options',
            'type'                  => 'checkbox',
            'priority'              => 52,
            'active_callback'       => ''
        )
    );

$resto_settings_controls['resto-home-blog-button-link'] =
    array(
        'setting' =>     array(
            'default'              => $resto_customizer_defaults['resto-home-blog-button-link']
        ),
        'control' => array(
            'label'                 =>  __( 'Enter URL to redirect', 'resto' ),
            'section'               => 'resto-blog-options',
            'type'                  => 'text',
            'priority'              => 53,
            'active_callback'       => ''
        )
    );

/*creating setting control for resto-fs-Category start*/
$resto_settings_controls['resto-blog-category'] =
    array(
        'setting' =>     array(
            'default'              => $resto_customizer_defaults['resto-blog-category']
        ),
        'control' => array(
            'label'                 =>  __( 'Select Category For Blog', 'resto' ),
            'description'           =>  __( 'Blog will only displayed from this category', 'resto' ),
            'section'               => 'resto-blog-options',
            'type'                  => 'category_dropdown',
            'priority'              => 70,
            'active_callback'       => ''
        )
    );
