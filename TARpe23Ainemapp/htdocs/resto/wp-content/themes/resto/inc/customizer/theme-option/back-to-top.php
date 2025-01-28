<?php
global $resto_sections;
global $resto_settings_controls;
global $resto_repeated_settings_controls;
global $resto_customizer_defaults;

/*defaults values*/
$resto_customizer_defaults['resto-enable-back-to-top'] = 1;

$resto_sections['resto-back-to-top-options'] =
    array(
        'priority'       => 80,
        'title'          => __( 'Back To Top Options', 'resto' ),
        'panel'          => 'resto-theme-options'
    );

$resto_settings_controls['resto-enable-back-to-top'] =
    array(
        'setting' =>     array(
            'default'              => $resto_customizer_defaults['resto-enable-back-to-top'],
        ),
        'control' => array(
            'label'                 =>  __( 'Enable Back To Top', 'resto' ),
            'section'               => 'resto-back-to-top-options',
            'type'                  => 'checkbox',
            'priority'              => 50,
        )
    );