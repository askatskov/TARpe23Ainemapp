<?php
global $resto_panels;
global $resto_sections;
global $resto_settings_controls;
global $resto_repeated_settings_controls;
global $resto_customizer_defaults;

/*defaults values*/
$resto_customizer_defaults['resto-home-service-enable'] = 0;
$resto_customizer_defaults['resto-home-service-thumbnail-enable'] = 0;
$resto_customizer_defaults['resto-home-service-background-image'] = get_template_directory_uri().'/assets/img/food.jpg';
$resto_customizer_defaults['resto-home-service-title'] = __('Our Services','resto');
$resto_customizer_defaults['resto-home-service-selection'] = 'from-page';
$resto_customizer_defaults['resto-home-service-number'] = 6;
$resto_customizer_defaults['resto-home-service-single-words'] = 30;
$resto_customizer_defaults['resto-home-service-button-enable'] = 1;
$resto_customizer_defaults['resto-home-service-button-text'] = __('Browse more services','resto');
$resto_customizer_defaults['resto-home-service-button-link'] = esc_url( home_url( '/services' ) );

/*serviceoptions*/
$resto_sections['resto-home-service-options'] =
    array(
        'priority'       => 30,
        'title'          => __( 'Service Options', 'resto' ),
        'panel'          => 'resto-home-service',
    );

$resto_settings_controls['resto-home-service-enable'] =
    array(
        'setting' =>     array(
            'default'              => $resto_customizer_defaults['resto-home-service-enable']
        ),
        'control' => array(
            'label'                 =>  __( 'Enable Service', 'resto' ),
            'section'               => 'resto-home-service-options',
            'type'                  => 'checkbox',
            'priority'              => 10,
            'active_callback'       => ''
        )
    );

$resto_settings_controls['resto-home-service-thumbnail-enable'] =
    array(
        'setting' =>     array(
            'default'              => $resto_customizer_defaults['resto-home-service-thumbnail-enable']
        ),
        'control' => array(
            'label'                 => __( 'Enable Service Thumbnail', 'resto' ),
            'description'           => __( 'On checking this will replace the icon on service section with thumbnail image', 'resto' ),
            'section'               => 'resto-home-service-options',
            'type'                  => 'checkbox',
            'priority'              => 10,
            'active_callback'       => ''
        )
    );

$resto_settings_controls['resto-home-service-background-image'] =
    array(
        'setting' =>     array(
            'default'              => $resto_customizer_defaults['resto-home-service-background-image'],
        ),
        'control' => array(
            'label'                 =>  __( 'Background Image', 'resto' ),
            'description'           =>  __( 'Upload background image for service section', 'resto' ),
            'section'               => 'resto-home-service-options',
            'type'                  => 'image',
            'priority'              => 12,
        )
    );


$resto_settings_controls['resto-home-service-title'] =
    array(
        'setting' =>     array(
            'default'              => $resto_customizer_defaults['resto-home-service-title']
        ),
        'control' => array(
            'label'                 =>  __( 'Main Title', 'resto' ),
            'section'               => 'resto-home-service-options',
            'type'                  => 'text',
            'priority'              => 15,
            'active_callback'       => ''
        )
    );

$resto_settings_controls['resto-home-service-number'] =
    array(
        'setting' =>     array(
            'default'              => $resto_customizer_defaults['resto-home-service-number']
        ),
        'control' => array(
            'label'                 =>  __( 'Number of Service/s', 'resto' ),
            'section'               => 'resto-home-service-options',
            'type'                  => 'select',
            'choices'               => array(
                1 => __( '1', 'resto' ),
                2 => __( '2', 'resto' ),
                3 => __( '3', 'resto' ),
                4 => __( '4', 'resto' ),
                5 => __( '5', 'resto' ),
                6 => __( '6', 'resto' )
            ),
            'priority'              => 23,
            'active_callback'       => ''
        )
    );

$resto_settings_controls['resto-home-service-single-words'] =
    array(
        'setting' =>     array(
            'default'              => $resto_customizer_defaults['resto-home-service-single-words']
        ),
        'control' => array(
            'label'                 =>  __( 'Number Of Words in Single Column Content', 'resto' ),
            'description'           =>  __( 'If you do not have selected from - Custom', 'resto' ),
            'section'               => 'resto-home-service-options',
            'type'                  => 'number',
            'priority'              => 25,
            'active_callback'       => ''
        )
    );


$resto_settings_controls['resto-home-service-button-enable'] =
    array(
        'setting' =>     array(
            'default'              => $resto_customizer_defaults['resto-home-service-button-enable']
        ),
        'control' => array(
            'label'                 =>  __( 'Enable Button', 'resto' ),
            'section'               => 'resto-home-service-options',
            'type'                  => 'checkbox',
            'priority'              => 35,
            'active_callback'       => ''
        )
    );

$resto_settings_controls['resto-home-service-button-link'] =
    array(
        'setting' =>     array(
            'default'              => $resto_customizer_defaults['resto-home-service-button-link']
        ),
        'control' => array(
            'label'                 =>  __( 'Browse All Button Link', 'resto' ),
            'section'               => 'resto-home-service-options',
            'type'                  => 'url',
            'priority'              => 50,
            'active_callback'       => ''
        )
    );