<?php
global $resto_panels;
global $resto_sections;
global $resto_settings_controls;
global $resto_repeated_settings_controls;
global $resto_customizer_defaults;

/*defaults values*/
$resto_customizer_defaults['resto-featured-slider-pages'] = 0;

/*page selection*/
$resto_sections['resto-feature-slider-pages'] =
    array(
        'priority'       => 40,
        'title'          => __( 'Select From Page', 'resto' ),
        'description'    => __( 'This option only work when you have selected "Page" in "Settings Options".', 'resto' ),
        'panel'          => 'resto-feature-slider',
    );

/*creating setting control for resto-feature-slider-page start*/
$resto_repeated_settings_controls['resto-featured-slider-pages'] =
    array(
        'repeated' => 3,
        'resto-feature-slider-pages-ids' => array(
            'setting' =>     array(
                'default'              => $resto_customizer_defaults['resto-featured-slider-pages'],
            ),
            'control' => array(
                'label'                 =>  __( 'Select Page For Slide %s', 'resto' ),
                'section'               => 'resto-feature-slider-pages',
                'type'                  => 'dropdown-pages',
                'priority'              => 60,
                'description'           => ''
            )
        ),
        'resto-feature-slider-pages-divider' => array(
            'control' => array(
                'section'               => 'resto-feature-slider-pages',
                'type'                  => 'message',
                'priority'              => 60,
                'description'           => '<br /><hr />'
            )
        )
    );

