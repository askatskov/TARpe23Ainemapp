<?php
/**
 * Featured Section
 *
 * @package Presto_Blog
*/

if( ! function_exists( 'presto_blog_customize_register_featured' ) ) :
function presto_blog_customize_register_featured( $wp_customize ){

    /** Featured Section */
    $wp_customize->add_section(
        'featured_section',
        array(
            'title'    => __( 'Featured Section', 'presto-blog' ),
            'priority' => 20,
            'panel'    => 'frontpage_settings',
        )
    );

    /** Featured Section */
    $wp_customize->add_setting( 
        'ed_featured_section', 
        array(
            'default'           => false,
            'sanitize_callback' => 'presto_blog_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
        new Presto_Blog_Toggle_Control( 
            $wp_customize,
            'ed_featured_section',
            array(
                'section'     => 'featured_section',
                'label'       => __( 'Featured Section', 'presto-blog' ),
                'description' => __( 'Enable this option to show featured section in home page.', 'presto-blog' ),
            )
        )
    );
    
    $wp_customize->add_setting(
        'home_featured_post',
        array(
            'default'           => '',
            'sanitize_callback' => 'presto_blog_sanitize_select',
        )
    );

    $wp_customize->add_control(
        new Presto_Blog_Select_Control(
            $wp_customize,
            'home_featured_post',
            array(
                'label'           => __( 'Select Feature Posts', 'presto-blog' ),
                'description'     => __( 'Select posts for featured section. You can rearrange the order you want.', 'presto-blog' ),
                'multiple'        => 3,
                'section'         => 'featured_section',
                'choices'         => presto_blog_get_posts( 'post' ),
                'active_callback' => 'presto_blog_featured_ac'
            )
        )
    );
}
endif;
add_action( 'customize_register', 'presto_blog_customize_register_featured' );