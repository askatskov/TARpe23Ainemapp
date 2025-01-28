<?php
global $resto_sections;
global $resto_settings_controls;
global $resto_repeated_settings_controls;
global $resto_customizer_defaults;

/*defaults values*/
$resto_customizer_defaults['resto-custom-css'] = '';
if ( version_compare( $GLOBALS['wp_version'], '4.7', '<' ) ) {
    $resto_sections['resto-custom-css'] =
        array(
            'priority'       => 120,
            'title'          => __( 'Custom CSS', 'resto' ),
            'panel'          => 'resto-theme-options'
        );

    $resto_settings_controls['resto-custom-css'] =
        array(
            'setting' =>     array(
                'default'              => $resto_customizer_defaults['resto-custom-css'],
            ),
            'control' => array(
                'label'                 =>  __( 'Custom CSS', 'resto' ),
                'section'               => 'resto-custom-css',
                'type'                  => 'textarea_css',
                'priority'              => 40,
            )
        );
}