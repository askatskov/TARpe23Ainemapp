<?php
global $resto_sections;
global $resto_settings_controls;
global $resto_customizer_defaults;

/*defaults values menu section*/
$resto_customizer_defaults['resto-menu-enable'] = 0;
$resto_customizer_defaults['resto-menu-title'] = __('OUR DELICIOUS MENU','resto');
$resto_customizer_defaults['resto-menu-category'] = 1;
$resto_customizer_defaults['resto-menu-number'] = 8;
$resto_customizer_defaults['resto-home-menu-single-words'] = 40;
$resto_customizer_defaults['resto-menu-price-enable'] = 1;
$resto_customizer_defaults['resto-menu-button-enable'] = 1;
$resto_customizer_defaults['resto-home-menu-button-text'] = __('View Detail','resto');
$resto_customizer_defaults['resto-home-menu-button-link'] = '';

/* Feature section Enable settings*/
$resto_sections['resto-menu-section'] =
    array(
        'priority'       => 210,
        'title'          => __( 'Home Menu Section', 'resto' ),
    );

/*menu section enable control*/
$resto_settings_controls['resto-menu-enable'] =
    array(
        'setting' =>     array(
            'default'              => $resto_customizer_defaults['resto-menu-enable']
        ),
        'control' => array(
            'label'                 =>  __( 'Enable Menu Section', 'resto' ),
            'description'           =>  __( 'Enable "Menu Section" on checked', 'resto' ),
            'section'               => 'resto-menu-section',
            'type'                  => 'checkbox',
            'priority'              => 10,
            'active_callback'       => ''
        )
    );

    /*menu Text control*/
    $resto_settings_controls['resto-menu-title'] =
    array(
        'setting' =>     array(
            'default'              => $resto_customizer_defaults['resto-menu-title']
        ),
        'control' => array(
            'label'                 =>  __( 'Menu Section Title', 'resto' ),
            'section'               => 'resto-menu-section',
            'type'                  => 'text',
            'priority'              => 12,
            'active_callback'       => ''
        )
    );
/*creating setting control for resto-fs-Category start*/
$resto_settings_controls['resto-menu-category'] =
    array(
        'setting' =>     array(
            'default'              => $resto_customizer_defaults['resto-menu-category']
        ),
        'control' => array(
            'label'                 =>  __( 'Select Category For Menu', 'resto' ),
            'description'           =>  __( 'you can create category on food post type given by jetpac plugin', 'resto' ),
            'section'               => 'resto-menu-section',
            'type'                  => 'category_dropdown',
            'taxonomy'              => 'nova_menu',
            'priority'              => 15,
            'active_callback'       => ''
        )
    );

/*No of menu selection*/
$resto_settings_controls['resto-menu-number'] =
    array(
        'setting' =>     array(
            'default'              => $resto_customizer_defaults['resto-menu-number']
        ),
        'control' => array(
            'label'                 =>  __( 'Number Of Menu', 'resto' ),
            'section'               => 'resto-menu-section',
            'type'                  => 'select',
            'choices'               => array(
                1 => __( '1', 'resto' ),
                2 => __( '2', 'resto' ),
                3 => __( '3', 'resto' ),
                4 => __( '4', 'resto' ),
                5 => __( '5', 'resto' ),
                6 => __( '6', 'resto' ),
                7 => __( '7', 'resto' ),
                8 => __( '8', 'resto' )
            ),
            'priority'              => 20,
            'active_callback'       => ''
        )
    );

/*String in max to be appear as description on menu*/
$resto_settings_controls['resto-home-menu-single-words'] =
    array(
        'setting' =>     array(
            'default'              => $resto_customizer_defaults['resto-home-menu-single-words']
        ),
        'control' => array(
            'label'                 =>  __( 'Number Of Words', 'resto' ),
            'description'           =>  __( 'Give number of words you wish to be appear on home page menu section', 'resto' ),
            'section'               => 'resto-menu-section',
            'type'                  => 'number',
            'priority'              => 30,
            'active_callback'       => '',
            'input_attrs' => array( 'min' => 1, 'max' => 200),

        )
    );

/*menu section enable control*/
$resto_settings_controls['resto-menu-button-enable'] =
    array(
        'setting' =>     array(
            'default'              => $resto_customizer_defaults['resto-menu-button-enable']
        ),
        'control' => array(
            'label'                 =>  __( 'Enable Button', 'resto' ),
            'section'               => 'resto-menu-section',
            'type'                  => 'checkbox',
            'priority'              => 50,
            'active_callback'       => ''
        )
    );

/*menu button url*/
$resto_settings_controls['resto-home-menu-button-link'] =
array(
    'setting' =>     array(
        'default'              => $resto_customizer_defaults['resto-home-menu-button-link']
    ),
    'control' => array(
        'label'                 =>  __( 'Menu Section Button URL', 'resto' ),
        'description'           =>  __( 'Will redirect to the costume URL ', 'resto' ),
        'section'               => 'resto-menu-section',
        'type'                  => 'url',
        'priority'              => 60,
        'active_callback'       => ''
    )
);
