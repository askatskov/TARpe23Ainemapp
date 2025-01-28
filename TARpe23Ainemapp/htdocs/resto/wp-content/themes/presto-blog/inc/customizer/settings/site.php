<?php
/**
 * Site Title
 *
 * @package Presto_Blog
*/

if( ! function_exists( 'presto_blog_customize_register_site' ) ) :
function presto_blog_customize_register_site( $wp_customize ) {
    
    $wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
    $wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
    $wp_customize->get_setting( 'background_color' )->transport = 'refresh';
    $wp_customize->get_setting( 'background_image' )->transport = 'refresh';
    
    $wp_customize->selective_refresh->add_partial( 'blogname', array(
        'selector'        => '.site-title a',
        'render_callback' => 'presto_blog_customize_partial_blogname',
    ) );
    $wp_customize->selective_refresh->add_partial( 'blogdescription', array(
        'selector'        => '.site-description',
        'render_callback' => 'presto_blog_customize_partial_blogdescription',
    ) );
}
endif;
add_action( 'customize_register', 'presto_blog_customize_register_site' );