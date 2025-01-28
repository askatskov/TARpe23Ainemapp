<?php
global $resto_sections;
global $resto_settings_controls;
global $resto_repeated_settings_controls;
global $resto_customizer_defaults;

$resto_customizer_defaults['resto-header-button-enable'] = 0;
$resto_customizer_defaults['resto-home-header-button-text'] = __('BOOK YOUR TABLE','resto');
$resto_customizer_defaults['resto-home-header-button-link'] = '#';


/* Feature section Enable settings*/
$resto_sections['resto-header-section'] =
    array(
        'priority'       => 10,
        'title'          => __( 'Header Section', 'resto' ),
        'panel'         => 'resto-theme-options',
    );

/*header section enable control*/
$resto_settings_controls['resto-header-button-enable'] =
    array(
        'setting' =>     array(
            'default'              => $resto_customizer_defaults['resto-header-button-enable']
        ),
        'control' => array(
            'label'                 =>  __( 'Enable Button', 'resto' ),
            'section'               => 'resto-header-section',
            'type'                  => 'checkbox',
            'priority'              => 50,
            'active_callback'       => ''
        )
    );

/*header button url*/
$resto_settings_controls['resto-home-header-button-link'] =
array(
    'setting' =>     array(
        'default'              => $resto_customizer_defaults['resto-home-header-button-link']
    ),
    'control' => array(
        'label'                 =>  __( 'Header Section Button URL', 'resto' ),
        'section'               => 'resto-header-section',
        'type'                  => 'url',
        'priority'              => 60,
        'active_callback'       => ''
    )
);
