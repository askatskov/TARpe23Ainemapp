<?php
global $resto_panels;
global $resto_sections;
global $resto_settings_controls;
global $resto_repeated_settings_controls;
global $resto_customizer_defaults;

/*defaults values*/
$resto_customizer_defaults['resto-home-service-pages'] = 0;

/*page selection*/
$resto_sections['resto-home-service-pages'] =
    array(
        'priority'       => 40,
        'title'          => __( 'Select Service From Page', 'resto' ),
        'description'    => __( 'This option only work when you have selected "Page" in "Service selection Options".', 'resto' ),
        'panel'          => 'resto-home-service',
    );

/*creating setting control for resto-home-service-page start*/
$resto_repeated_settings_controls['resto-home-service-pages'] =
    array(
        'repeated' => 6,
        'resto-home-service-pages-ids' => array(
            'setting' =>     array(
                'default'              => $resto_customizer_defaults['resto-home-service-pages'],
            ),
            'control' => array(
                'label'                 =>  __( 'Select Page For Service %s', 'resto' ),
                'section'               => 'resto-home-service-pages',
                'type'                  => 'dropdown-pages',
                'priority'              => 10,
                'description'           => ''
            )
        ),
        'resto-home-service-pages-divider' => array(
            'control' => array(
                'section'               => 'resto-home-service-pages',
                'type'                  => 'message',
                'priority'              => 20,
                'description'           => '<br /><hr />'
            )
        )
    );