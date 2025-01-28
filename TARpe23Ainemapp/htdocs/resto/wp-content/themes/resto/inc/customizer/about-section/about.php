<?php
global $resto_sections;
global $resto_settings_controls;
global $resto_customizer_defaults;

/*defaults values about section*/
$resto_customizer_defaults['resto-about-enable'] = 0;
$resto_customizer_defaults['resto-about-page'] = 0;
$resto_customizer_defaults['resto-home-about-single-words'] = 40;
$resto_customizer_defaults['resto-about-button-enable'] = 1;
$resto_customizer_defaults['resto-home-about-button-text'] = __('view Our Menu','resto');
$resto_customizer_defaults['resto-home-about-button-link'] = '';


/* Feature section Enable settings*/
$resto_sections['resto-about-section'] =
    array(
        'priority'       => 210,
        'title'          => __( 'Home About Section', 'resto' ),
    );

/*about section enable control*/
$resto_settings_controls['resto-about-enable'] =
    array(
        'setting' =>     array(
            'default'              => $resto_customizer_defaults['resto-about-enable']
        ),
        'control' => array(
            'label'                 =>  __( 'Enable About Section', 'resto' ),
            'description'           =>  __( 'Enable "About Section" on checked', 'resto' ),
            'section'               => 'resto-about-section',
            'type'                  => 'checkbox',
            'priority'              => 10,
            'active_callback'       => ''
        )
    );


/*creating setting control for resto-about-page start*/
$resto_settings_controls['resto-about-page'] =
    array(
            'setting' =>     array(
                'default'              => $resto_customizer_defaults['resto-about-page'],
                ),
            'control' => array(
                'label'                 =>  __( 'Select Page For About Section', 'resto' ),
                'description'           => '',
                'section'               => 'resto-about-section',
                'type'                  => 'dropdown-pages',
                'priority'              => 20
            )
    );


/*String in max to be appear as description on about*/
$resto_settings_controls['resto-home-about-single-words'] =
    array(
        'setting' =>     array(
            'default'              => $resto_customizer_defaults['resto-home-about-single-words']
        ),
        'control' => array(
            'label'                 =>  __( 'Number Of Words', 'resto' ),
            'description'           =>  __( 'Give number of words you wish to be appear on home page about section', 'resto' ),
            'section'               => 'resto-about-section',
            'type'                  => 'number',
            'priority'              => 30,
            'active_callback'       => '',
            'input_attrs' => array( 'min' => 1, 'max' => 200),

        )
    );

/*about button url*/
$resto_settings_controls['resto-home-about-button-link'] =
array(
    'setting' =>     array(
        'default'              => $resto_customizer_defaults['resto-home-about-button-link']
    ),
    'control' => array(
        'label'                 =>  __( 'About Section Button URL', 'resto' ),
        'description'           =>  __( 'Will redirect to the costume URL ', 'resto' ),
        'section'               => 'resto-about-section',
        'type'                  => 'url',
        'priority'              => 45,
        'active_callback'       => ''
    )
);
