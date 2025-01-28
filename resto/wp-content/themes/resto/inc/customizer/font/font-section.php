<?php
global $resto_panels;
global $resto_sections;
global $resto_settings_controls;
global $resto_repeated_settings_controls;
global $resto_customizer_defaults;

/*font array*/
global $resto_google_fonts;
$resto_google_fonts = array(
    'Archivo+Narrow:400,400italic,700' => 'Archivo Narrow',
    'Bitter:400,400italic,700' => 'Bitter',
    'Cookie' => 'Cookie',
    'Exo:400,300,400italic,600,800' => 'Exo',
    'Kreon:400,300,700' => 'Kreon',
    'Lato:400,300,400italic,900,700' => 'Lato',
    'News+Cycle:400,700' => 'News Cycle',
    'Oxygen:400,300,700' => 'Oxygen',
    'Playball' => 'Playball',
    'Ropa+Sans:400,400italic' => 'Ropa Sans',
    'Squada+One' => 'Squada One',
    'Tangerine:400,700' => 'Tangerine',
    'Ubuntu:400,400italic,500,700' => 'Ubuntu',
    'Varela+Round' => 'Varela Round',
    'Yanone+Kaffeesatz:400,300,700' => 'Yanone Kaffeesatz',
);

/*defaults values*/
$resto_customizer_defaults['resto-font-family-Primary'] = 'Ubuntu:400,400italic,500,700';
$resto_customizer_defaults['resto-font-family-site-identity'] = 'Lato:400,300,400italic,900,700';
$resto_customizer_defaults['resto-font-family-heading'] = 'Lato:400,300,400italic,900,700';
$resto_customizer_defaults['resto-font-family-title'] = 'Lato:400,300,400italic,900,700';


/*section*/
$resto_sections['resto-family'] =
    array(
        'priority'       => 20,
        'title'          => __( 'Font Family', 'resto' ),
    );

$resto_settings_controls['resto-font-family-site-identity'] =
    array(
        'setting' =>     array(
            'default'              => $resto_customizer_defaults['resto-font-family-site-identity'],
            
        ),
        'control' => array(
            'label'                 => __( 'Site Identity/Logo', 'resto' ),
            'description'           => __( 'Site Identity font family', 'resto' ),
            'section'               => 'resto-family',
            'type'                  => 'select',
            'choices'               => $resto_google_fonts,
            'priority'              => 10,
            'active_callback'       => ''
        )
    );


$resto_settings_controls['resto-font-family-heading'] =
    array(
        'setting' =>     array(
            'default'              => $resto_customizer_defaults['resto-font-family-heading'],
            
        ),
        'control' => array(
            'label'                 => __( 'Heading', 'resto' ),
            'description'           => __('will change the font of all the heading titles', 'resto'),
            'section'               => 'resto-family',
            'type'                  => 'select',
            'choices'               => $resto_google_fonts,
            'priority'              => 20,
            'active_callback'       => ''
        )
    );