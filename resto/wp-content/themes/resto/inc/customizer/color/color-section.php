<?php
global $resto_sections;
global $resto_settings_controls;
global $resto_customizer_defaults;

/*defaults values*/
$resto_customizer_defaults['resto-site-identity-color'] = '#fff';
$resto_customizer_defaults['resto-footer-background-color'] = '#323044';
$resto_customizer_defaults['resto-bredcrumb-background-color'] = '#333333';
$resto_customizer_defaults['resto-menu-color'] = '#fff';
$resto_customizer_defaults['resto-primary-color'] = '#ffa800';
$resto_customizer_defaults['resto-primary-hover-color'] = '#ffa800';
$resto_customizer_defaults['resto-banner-text-color'] = '#fff';
$resto_customizer_defaults['resto-title-color'] = '#000';
$resto_customizer_defaults['resto-body-text-color'] = '#313131';
$resto_customizer_defaults['resto-link-color'] = '#ffa800';
$resto_customizer_defaults['resto-button-backgorund-color'] = '#ffa800';
$resto_customizer_defaults['resto-button-text-color'] = '#000';


$resto_customizer_defaults['resto-color-reset'] = '';


/**
 * Reset color settings to default
 * @param  $input
 *
 * @since resto 1.0
 */
if ( ! function_exists( 'resto_color_reset' ) ) :
    function resto_color_reset( $input ) {
        if ( $input == 1 ) {
            global $resto_customizer_defaults;

            /*getting fields*/
            $resto_customizer_saved_values = resto_get_all_options();

            /*setting fields */
            $resto_customizer_defaults['resto-site-identity-color'] = '#fff';
            $resto_customizer_defaults['resto-banner-text-color'] = '#fff';
            $resto_customizer_defaults['resto-link-color'] = '#ffa800';

            remove_theme_mod( 'background_color' );
            $resto_customizer_defaults['resto-color-reset'] = '';

            /*resetting fields*/
            resto_reset_options( $resto_customizer_saved_values );
        }
        else {
            return '';
        }
    }
endif;

$resto_settings_controls['resto-site-identity-color'] =
    array(
        'setting' =>     array(
            'default'              => $resto_customizer_defaults['resto-site-identity-color'],
        ),
        'control' => array(
            'label'                 =>  __( 'Site Identity Color', 'resto' ),
            'description'           =>  __( 'Site title and tagline color', 'resto' ),
            'section'               => 'colors',
            'type'                  => 'color',
            'priority'              => 20,
            'active_callback'       => ''
        )
    );

$resto_settings_controls['resto-banner-text-color'] =
    array(
        'setting' =>     array(
            'default'              => $resto_customizer_defaults['resto-banner-text-color'],
        ),
        'control' => array(
            'label'                 =>  __( 'Banner Text Color', 'resto' ),
            'description'           =>  __( 'Change the color of text over the banner image', 'resto' ),
            'section'               => 'colors',
            'type'                  => 'color',
            'priority'              => 40,
            'active_callback'       => ''
        )
    );

$resto_settings_controls['resto-link-color'] =
    array(
        'setting' =>     array(
            'default'              => $resto_customizer_defaults['resto-link-color'],
        ),
        'control' => array(
            'label'                 =>  __( 'Link Color', 'resto' ),
            'section'               => 'colors',
            'type'                  => 'color',
            'priority'              => 55,
            'active_callback'       => ''
        )
    );

$resto_settings_controls['resto-color-reset'] =
    array(
        'setting' =>     array(
            'default'              => $resto_customizer_defaults['resto-color-reset'],
            'sanitize_callback'    => 'resto_color_reset',
            'transport'            => 'postmessage',
        ),
        'control' => array(
            'label'                 =>  __( 'Reset', 'resto' ),
            'description'           =>  __( 'Caution: Reset all above color settings to default. Refresh the page after save to view the effects. ', 'resto' ),
            'section'               => 'colors',
            'type'                  => 'checkbox',
            'priority'              => 220,
            'active_callback'       => ''
        )
    );