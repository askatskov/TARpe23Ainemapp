<?php
global $resto_sections;
global $resto_settings_controls;
global $resto_repeated_settings_controls;
global $resto_customizer_defaults;

/*defaults values*/
$resto_customizer_defaults['resto-default-banner-image'] = get_template_directory_uri().'/assets/img/banner.jpg';
$resto_customizer_defaults['resto-default-layout'] = 'right-sidebar';
$resto_customizer_defaults['resto-single-post-image-align'] = 'full';
$resto_customizer_defaults['resto-excerpt-length'] = '50';
$resto_customizer_defaults['resto-archive-layout'] = 'thumbnail-and-excerpt';
$resto_customizer_defaults['resto-archive-image-align'] = 'full';

$resto_sections['resto-layout-options'] =
    array(
        'priority'       => 20,
        'title'          => __( 'Layout Options', 'resto' ),
        'panel'          => 'resto-theme-options',
    );

/*layout-options option responsive lodader start*/
/*creating setting control for resto-layout-options start*/
$resto_settings_controls['resto-default-banner-image'] =
    array(
        'setting' =>     array(
            'default'              => $resto_customizer_defaults['resto-default-banner-image'],
        ),
        'control' => array(
            'label'                 =>  __( 'Default Banner Image', 'resto' ),
            'description'           =>  __( 'Please note that if you remove this image default banner image will appear', 'resto' ),
            'section'               => 'resto-layout-options',
            'type'                  => 'image',
            'priority'              => 20,
        )
    );

$resto_settings_controls['resto-default-layout'] =
    array(
        'setting' =>     array(
            'default'              => $resto_customizer_defaults['resto-default-layout'],
        ),
        'control' => array(
            'label'                 =>  __( 'Default Layout', 'resto' ),
            'description'           =>  __( 'Please note that this setting can be override from individual post/page', 'resto' ),
            'section'               => 'resto-layout-options',
            'type'                  => 'select',
            'choices'               => array(
                'right-sidebar' => __( 'Content - Primary Sidebar', 'resto' ),
                'left-sidebar' => __( 'Primary Sidebar - Content', 'resto' ),
                'no-sidebar' => __( 'No Sidebar', 'resto' )
            ),
            'priority'              => 10,
            'active_callback'       => ''
        )
    );

    $resto_settings_controls['resto-excerpt-length'] =
        array(
            'setting' =>     array(
                'default'              => $resto_customizer_defaults['resto-excerpt-length'],
            ),
            'control' => array(
                'label'                 =>  __( 'Excerpt Length (in words)', 'resto' ),
                'section'               => 'resto-layout-options',
                'type'                  => 'number',
                'priority'              => 40,
            )
        );