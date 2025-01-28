<?php
global $resto_sections;
global $resto_settings_controls;
global $resto_repeated_settings_controls;
global $resto_customizer_defaults;

/*defaults values*/
$resto_customizer_defaults['resto-footer-logo-image-enable'] = 0;
$resto_customizer_defaults['resto-footer-logo-image'] = get_template_directory_uri().'/assets/img/logo.png';
$resto_customizer_defaults['resto-footer-sidebar-number'] = 2;
$resto_customizer_defaults['resto-copyright-text'] = __('Copyright &copy; eVisionThemes','resto');
$resto_customizer_defaults['resto-enable-theme-name'] = 1;

$resto_sections['resto-footer-options'] =
    array(
        'priority'       => 15,
        'title'          => __( 'Footer Options', 'resto' ),
        'panel'          => 'resto-theme-options'
    );

$resto_settings_controls['resto-footer-logo-image-enable'] =
    array(
        'setting' =>     array(
            'default'              => $resto_customizer_defaults['resto-footer-logo-image-enable']
        ),
        'control' => array(
            'label'                 =>  __( 'Enable Footer Logo', 'resto' ),
            'section'               => 'resto-footer-options',
            'type'                  => 'checkbox',
            'priority'              => 10,
            'active_callback'       => ''
        )
    );
$resto_settings_controls['resto-footer-logo-image'] =
    array(
        'setting' =>     array(
            'default'              => $resto_customizer_defaults['resto-footer-logo-image'],
        ),
        'control' => array(
            'label'                 =>  __( 'Footer Logo', 'resto' ),
            'section'               => 'resto-footer-options',
            'type'                  => 'image',
            'priority'              => 10,
        )
    );

$resto_settings_controls['resto-footer-sidebar-number'] =
    array(
        'setting' =>     array(
            'default'              => $resto_customizer_defaults['resto-footer-sidebar-number'],
        ),
        'control' => array(
            'label'                 =>  __( 'Number of Sidebars In Footer Area', 'resto' ),
            'section'               => 'resto-footer-options',
            'type'                  => 'select',
            'choices'               => array(
                0 => __( 'Disable footer sidebar area', 'resto' ),
                1 => __( '1', 'resto' ),
                2 => __( '2', 'resto' )
            ),
            'priority'              => 15,
            'description'           => '',
            'active_callback'       => ''
        )
    );

$resto_settings_controls['resto-copyright-text'] =
    array(
        'setting' =>     array(
            'default'              => $resto_customizer_defaults['resto-copyright-text'],
        ),
        'control' => array(
            'label'                 =>  __( 'Copyright Text', 'resto' ),
            'section'               => 'resto-footer-options',
            'type'                  => 'text_html',
            'priority'              => 20,
        )
    );