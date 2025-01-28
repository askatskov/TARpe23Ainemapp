<?php
/**
 * evision themes Theme Customizer
 *
 * @package eVision themes
 * @subpackage Resto
 * @since Resto 1.0.0
 */
/*Define Url for including css and js*/
if ( !defined( 'EVISION_CUSTOMIZER_URL' ) ) {
    define( 'EVISION_CUSTOMIZER_URL', trailingslashit( get_template_directory_uri() ) . 'inc/frameworks/evision-customizer/' );
}
/*Define path for including php files*/
if ( !defined( 'EVISION_CUSTOMIZER_PATH' ) ) {
    define( 'EVISION_CUSTOMIZER_PATH', trailingslashit( get_template_directory() ) . 'inc/frameworks/evision-customizer/' );
}

/*define constant for evision customizer name*/
if(!defined('EVISION_CUSTOMIZER_NAME')){
    define( 'EVISION_CUSTOMIZER_NAME', 'resto_options' );
}

/**
 * reset options
 * @param  array $reset_options
 * @return void
 *
 * @since resto 1.0
 */
if ( ! function_exists( 'resto_reset_options' ) ) :
    function resto_reset_options( $reset_options ) {
        set_theme_mod( EVISION_CUSTOMIZER_NAME, $reset_options );
    }
endif;

/**
 * Customizer framework added.
 */
require get_template_directory() . '/inc/frameworks/evision-customizer/evision-customizer.php';
global $resto_panels;
global $resto_sections;
global $resto_settings_controls;
global $resto_repeated_settings_controls;
global $resto_customizer_defaults;

/******************************************
Modify Site Color Options
 *******************************************/
require get_template_directory().'/inc/customizer/color/color-section.php';

/******************************************
Modify Site Font Options
 *******************************************/
require get_template_directory().'/inc/customizer/font/font-section.php';

/******************************************
Modify Slider Section Options
 *******************************************/
require get_template_directory().'/inc/customizer/main-slider-section/panel.php';

/******************************************
Modify About Section Options
 *******************************************/
require get_template_directory().'/inc/customizer/about-section/about.php';

/******************************************
Modify Menu Section Options
 *******************************************/
require get_template_directory().'/inc/customizer/menu-section/menu.php';

/******************************************
Modify Service Section Options
 *******************************************/
require get_template_directory().'/inc/customizer/service-section/panel.php';

/******************************************
Modify Blog Section Options
 *******************************************/
require get_template_directory().'/inc/customizer/blog-section/blog.php';

/******************************************
Modify Theme Option Section Options
 *******************************************/
require get_template_directory().'/inc/customizer/theme-option/option-panel.php';

/*Resetting all Values*/
/**
 * Reset color settings to default
 *
 * @since resto 1.0
 */
global $resto_customizer_defaults;
$resto_customizer_defaults['resto-customizer-reset-settings'] = '';
if ( ! function_exists( 'resto_customizer_reset' ) ) :
    function resto_customizer_reset( ) {
        global $resto_customizer_saved_values;
        $resto_customizer_saved_values = resto_get_all_options();
        if ( $resto_customizer_saved_values['resto-customizer-reset-settings'] == 1 ) {
            global $resto_customizer_defaults;
            /*getting fields*/
            $resto_customizer_defaults['resto-customizer-reset-settings'] = '';
            /*resetting fields*/
            resto_reset_options( $resto_customizer_defaults );
        }
        else {
            return '';
        }
    }
endif;
add_action( 'customize_save_after','resto_customizer_reset' );

$resto_sections['resto-customizer-reset'] =
    array(
        'priority'       => 999,
        'title'          => __( 'Reset All Options', 'resto' )
    );
$resto_settings_controls['resto-customizer-reset-settings'] =
    array(
        'setting' =>     array(
            'default'              => $resto_customizer_defaults['resto-customizer-reset-settings'],
            'sanitize_callback'    => 'evision_customizer_sanitize_checkbox',
            'transport'            => 'postmessage',
        ),
        'control' => array(
            'label'                 =>  __( 'Reset All Options', 'resto' ),
            'description'           =>  __( 'Caution: Reset all options settings to default. Refresh the page after save to view the effects. ', 'resto' ),
            'section'               => 'resto-customizer-reset',
            'type'                  => 'checkbox',
            'priority'              => 10,
            'active_callback'       => ''
        )
    );


/******************************************
Removing section setting control
 *******************************************/
/*$resto_remove_sections =
    array(
        'header_image'
    );*/
$resto_remove_settings_controls =
    array(
        'header_textcolor','display_header_text'
    );
$resto_customizer_args = array(
    'panels'            => $resto_panels, /*always use key panels */
    'sections'          => $resto_sections,/*always use key sections*/
    'settings_controls' => $resto_settings_controls,/*always use key settings_controls*/
    'repeated_settings_controls' => $resto_repeated_settings_controls,/*always use key sections*/
    'remove_settings_controls' => $resto_remove_settings_controls/*always use key remove_settings_controls*/
);

/*registering panel section setting and control start*/
function resto_add_panels_sections_settings() {
    global $resto_customizer_args;
    return $resto_customizer_args;
}
add_filter( 'evision_customizer_panels_sections_settings', 'resto_add_panels_sections_settings' );
/*registering panel section setting and control end*/

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function resto_customize_register( $wp_customize ) {
    $wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
    $wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
    $wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
}
add_action( 'customize_register', 'resto_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function resto_customize_preview_js() {
    wp_enqueue_script( 'resto_customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'resto_customize_preview_js' );


/**
 * get all saved options
 * @param  null
 * @return array saved options
 *
 * @since resto 1.0
 */
if ( ! function_exists( 'resto_get_all_options' ) ) :
    function resto_get_all_options( $merge_default = 0 ) {
        $resto_customizer_saved_values = evision_customizer_get_all_values( EVISION_CUSTOMIZER_NAME );
        if( 1 == $merge_default ){
            global $resto_customizer_defaults;
            if(is_array( $resto_customizer_saved_values )){
                $resto_customizer_saved_values = array_merge($resto_customizer_defaults, $resto_customizer_saved_values );
            }
            else{
                $resto_customizer_saved_values = $resto_customizer_defaults;
            }
        }
        return $resto_customizer_saved_values;
    }
endif;