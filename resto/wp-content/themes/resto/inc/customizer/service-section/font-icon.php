<?php
global $resto_panels;
global $resto_sections;
global $resto_settings_controls;
global $resto_repeated_settings_controls;
global $resto_customizer_defaults;

/*defaults values*/
$resto_customizer_defaults['resto-home-service-page-icon'] = 'fa-cutlery';


/*font selection*/
$resto_sections['resto-home-service-font-icon'] =
    array(
        'priority'       => 35,
        'title'          => __( 'Service Icons', 'resto' ),
        'description'    => __( 'This will let you choose font icon for service page".', 'resto' ),
        'panel'          => 'resto-home-service',
    );



$resto_repeated_settings_controls['resto-home-service-font-icon'] =
    array(
        'repeated' => 6,
        'resto-home-service-page-icon' => array(
            'setting' =>     array(
                'default'              => $resto_customizer_defaults['resto-home-service-page-icon'],
            ),
            'control' => array(
                'label'                 =>  __( 'Icon %s', 'resto' ),
                'section'               => 'resto-home-service-font-icon',
                'type'                  => 'text',
                'priority'              => 5,
                'description'           => sprintf( __( 'Use font awesome icon: Eg: %s. %sSee more here%s', 'resto' ), 'fa-desktop','<a href="'.esc_url('http://fontawesome.io/cheatsheet/').'" target="_blank">','</a>' ),
            )
        ),
            'resto-home-service-font-icon-divider' => array(
                'control' => array(
                    'section'               => 'resto-home-service-font-icon',
                    'type'                  => 'message',
                    'priority'              => 20,
                    'description'           => '<br /><hr />'
                )
            )
        );