<?php
global $resto_sections;
global $resto_settings_controls;
global $resto_repeated_settings_controls;
global $resto_customizer_defaults;

/*defaults values*/
$resto_customizer_defaults['resto-enable-breadcrumb'] = 1;

$resto_sections['resto-breadcrumb-options'] =
    array(
        'priority'       => 50,
        'title'          => __( 'Breadcrumb Options', 'resto' ),
        'panel'          => 'resto-theme-options',
    );

$resto_settings_controls['resto-enable-breadcrumb'] =
    array(
        'setting' =>     array(
            'default'              => $resto_customizer_defaults['resto-enable-breadcrumb'],
        ),
        'control' => array(
            'label'                 =>  __( 'Enable Breadcrumb', 'resto' ),
            'section'               => 'resto-breadcrumb-options',
            'type'                  => 'checkbox',
            'priority'              => 10,
        )
    );