<?php
global $resto_panels;
global $resto_sections;
global $resto_settings_controls;
global $resto_repeated_settings_controls;
global $resto_customizer_defaults;

/*defaults values feature trip options*/
$resto_customizer_defaults['resto-feature-slider-enable'] = 0;
$resto_customizer_defaults['resto-feature-slider-number'] = 3;
$resto_customizer_defaults['resto-feature-slider-selection'] = 'from-page';

/*feature slider enable setting*/
$resto_sections['resto-feature-section-options'] =
    array(
        'priority'       => 10,
        'title'          => __( 'Setting Options', 'resto' ),
        'panel'          => 'resto-feature-slider',
    );

/*Feature section enable control*/
$resto_settings_controls['resto-feature-slider-enable'] =
    array(
        'setting' =>     array(
            'default'              => $resto_customizer_defaults['resto-feature-slider-enable']
        ),
        'control' => array(
            'label'                 =>  __( 'Enable Feature Slider', 'resto' ),
            'section'               => 'resto-feature-section-options',
        	'description'    		=> __( 'Enable "Feature slider" on checked' , 'resto' ),
            'type'                  => 'checkbox',
            'priority'              => 10,
            'active_callback'       => ''
        )
    );

/*No of feature slider selection*/
$resto_settings_controls['resto-feature-slider-number'] =
    array(
        'setting' =>     array(
            'default'              => $resto_customizer_defaults['resto-feature-slider-number']
        ),
        'control' => array(
            'label'                 =>  __( 'Number Of Slider', 'resto' ),
            'section'               => 'resto-feature-section-options',
            'type'                  => 'select',
            'choices'               => array(
                1 => __( '1', 'resto' ),
                2 => __( '2', 'resto' ),
                3 => __( '3', 'resto' )
            ),
            'priority'              => 20,
            'active_callback'       => ''
        )
    );