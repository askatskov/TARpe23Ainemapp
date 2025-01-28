<?php
global $resto_panels;
global $resto_sections;
global $resto_settings_controls;
global $resto_repeated_settings_controls;
global $resto_customizer_defaults;

/*defaults values*/
$resto_customizer_defaults['resto-fs-single-words'] = 30;
$resto_customizer_defaults['resto-fs-slider-mode'] = 'fadeout';
$resto_customizer_defaults['resto-fs-slider-time'] = 2;
$resto_customizer_defaults['resto-fs-slider-pause-time'] = 7;
$resto_customizer_defaults['resto-fs-enable-arrow'] = 0;
$resto_customizer_defaults['resto-fs-enable-pager'] = 1;
$resto_customizer_defaults['resto-fs-enable-autoplay'] = 1;
$resto_customizer_defaults['resto-fs-enable-title'] = 1;
$resto_customizer_defaults['resto-fs-enable-caption'] = 1;
$resto_customizer_defaults['resto-fs-enable-button'] = 1;
$resto_customizer_defaults['resto-fs-button-text'] = __('LEARN MORE','resto');

/*fs options*/
$resto_sections['resto-fs-slider-options'] =
    array(
        'priority'       => 80,
        'title'          => __( 'Slider Property', 'resto' ),
        'panel'          => 'resto-feature-slider',
    );

$resto_settings_controls['resto-fs-single-words'] =
    array(
        'setting' =>     array(
            'default'              => $resto_customizer_defaults['resto-fs-single-words']
        ),
        'control' => array(
            'label'                 =>  __( 'Single Slider- Number Of Words', 'resto' ),
            'description'           =>  __( 'If you do not have selected from - Custom', 'resto' ),
            'section'               => 'resto-fs-slider-options',
            'type'                  => 'number',
            'priority'              => 5,
            'active_callback'       => '',
            'input_attrs' => array( 'min' => 1, 'max' => 200),
        )
    );

$resto_settings_controls['resto-fs-slider-mode'] =
    array(
        'setting' =>     array(
            'default'              => $resto_customizer_defaults['resto-fs-slider-mode']
        ),
        'control' => array(
            'label'                 =>  __( 'Slider Mode', 'resto' ),
            'section'               => 'resto-fs-slider-options',
            'type'                  => 'select',
            'choices'               => array(
                'scrollHorz' => __( 'Default', 'resto' ),
                'fade' => __( 'Fade', 'resto' ),
                'fadeout' => __( 'Fade-Out', 'resto' )
            ),
            'priority'              => 10,
            'active_callback'       => ''
        )
    );

$resto_settings_controls['resto-fs-enable-arrow'] =
    array(
        'setting' =>     array(
            'default'              => $resto_customizer_defaults['resto-fs-enable-arrow']
        ),
        'control' => array(
            'label'                 =>  __( 'Enable Arrow', 'resto' ),
            'section'               => 'resto-fs-slider-options',
            'type'                  => 'checkbox',
            'priority'              => 50,
            'active_callback'       => ''
        )
    );

$resto_settings_controls['resto-fs-enable-pager'] =
    array(
        'setting' =>     array(
            'default'              => $resto_customizer_defaults['resto-fs-enable-pager']
        ),
        'control' => array(
            'label'                 =>  __( 'Enable Pager', 'resto' ),
            'section'               => 'resto-fs-slider-options',
            'type'                  => 'checkbox',
            'priority'              => 55,
            'active_callback'       => ''
        )
    );

$resto_settings_controls['resto-fs-enable-autoplay'] =
    array(
        'setting' =>     array(
            'default'              => $resto_customizer_defaults['resto-fs-enable-autoplay']
        ),
        'control' => array(
            'label'                 =>  __( 'Enable Autoplay', 'resto' ),
            'section'               => 'resto-fs-slider-options',
            'type'                  => 'checkbox',
            'priority'              => 60,
            'active_callback'       => ''
        )
    );

$resto_settings_controls['resto-fs-enable-button'] =
    array(
        'setting' =>     array(
            'default'              => $resto_customizer_defaults['resto-fs-enable-button']
        ),
        'control' => array(
            'label'                 =>  __( 'Enable Button', 'resto' ),
            'section'               => 'resto-fs-slider-options',
            'type'                  => 'checkbox',
            'priority'              => 85,
            'active_callback'       => ''
        )
    );