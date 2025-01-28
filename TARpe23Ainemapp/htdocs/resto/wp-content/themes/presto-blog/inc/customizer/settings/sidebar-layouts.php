<?php
/**
 * Sidebar Layouts
 *
 * @package Presto_Blog
*/

if( ! function_exists( 'presto_blog_customize_register_sidebar_layouts' ) ) :
function presto_blog_customize_register_sidebar_layouts( $wp_customize ) {
    
    /** Sidebar Layouts */
    $wp_customize->add_section(
        'sidebar_layouts',
        array(
            'title'    => __( 'Sidebar Layouts', 'presto-blog' ),
            'priority' => 60,
        )
    );

    $wp_customize->add_setting(
        'page_sidebar_layout',
        array(
            'default'           => 'no-sidebar',
            'sanitize_callback' => 'presto_blog_sanitize_select',
        )
    );
    
    $wp_customize->add_control(
        new Presto_Blog_Radio_Image_Control(
            $wp_customize,
            'page_sidebar_layout',
            array(
                'section'     => 'sidebar_layouts',
                'label'       => __( 'Page Sidebar Layout', 'presto-blog' ),
                'description' => __( 'This is the general sidebar layout for pages.', 'presto-blog' ),
                'class'       => 'two-columns',
                'choices'     => array(
                    'no-sidebar'    => get_template_directory_uri() . '/assets/images/layouts/fullwidth.jpg',
                    'centered'      => get_template_directory_uri() . '/assets/images/layouts/centered.jpg',
                    'left-sidebar'  => get_template_directory_uri() . '/assets/images/layouts/sidebar-left.jpg',
                    'right-sidebar' => get_template_directory_uri() . '/assets/images/layouts/sidebar-right.jpg',
                )
            )
        )
    );
    
    /** Post Sidebar layout */
    $wp_customize->add_setting( 
        'post_sidebar_layout', 
        array(
            'default'           => 'no-sidebar',
            'sanitize_callback' => 'presto_blog_sanitize_radio'
        ) 
    );

    $wp_customize->add_control(
        new Presto_Blog_Radio_Image_Control(
            $wp_customize,
            'post_sidebar_layout',
            array(
                'section'     => 'sidebar_layouts',
                'label'       => __( 'Post Sidebar Layout', 'presto-blog' ),
                'description' => __( 'This is the general sidebar layout for posts & custom post.', 'presto-blog' ),
                'class'       => 'two-columns',
                'choices'     => array(
                    'no-sidebar'    => get_template_directory_uri() . '/assets/images/layouts/fullwidth.jpg',
                    'centered'      => get_template_directory_uri() . '/assets/images/layouts/centered.jpg',
                    'left-sidebar'  => get_template_directory_uri() . '/assets/images/layouts/sidebar-left.jpg',
                    'right-sidebar' => get_template_directory_uri() . '/assets/images/layouts/sidebar-right.jpg',
                )
            )
        )
    );
    
    /** Blog Sidebar layout */
    $wp_customize->add_setting( 
        'blog_sidebar_layout', 
        array(
            'default'           => 'no-sidebar',
            'sanitize_callback' => 'presto_blog_sanitize_radio'
        ) 
    );

    $wp_customize->add_control(
        new Presto_Blog_Radio_Image_Control(
            $wp_customize,
            'blog_sidebar_layout',
            array(
                'section'     => 'sidebar_layouts',
                'label'       => __( 'Blog Sidebar Layout', 'presto-blog' ),
                'description' => __( 'This is blog home page sidebar layout.', 'presto-blog' ),
                'class'       => 'two-columns',
                'choices'     => array(
                    'no-sidebar'    => get_template_directory_uri() . '/assets/images/layouts/fullwidth.jpg',
                    'left-sidebar'  => get_template_directory_uri() . '/assets/images/layouts/sidebar-left.jpg',
                    'right-sidebar' => get_template_directory_uri() . '/assets/images/layouts/sidebar-right.jpg',
                )
            )
        )
    );
    
    /** Default Sidebar layout */
    $wp_customize->add_setting( 
        'layout_style', 
        array(
            'default'           => 'no-sidebar',
            'sanitize_callback' => 'presto_blog_sanitize_radio'
        ) 
    );

    $wp_customize->add_control(
        new Presto_Blog_Radio_Image_Control(
            $wp_customize,
            'layout_style',
            array(
                'section'     => 'sidebar_layouts',
                'label'       => __( 'Default Sidebar Layout', 'presto-blog' ),
                'description' => __( 'This is the general sidebar layout for whole site. This sidebar layout applies to search and archive pages.', 'presto-blog' ),
                'class'       => 'two-columns',
                'choices'     => array(
                    'no-sidebar'    => get_template_directory_uri() . '/assets/images/layouts/fullwidth.jpg',
                    'left-sidebar'  => get_template_directory_uri() . '/assets/images/layouts/sidebar-left.jpg',
                    'right-sidebar' => get_template_directory_uri() . '/assets/images/layouts/sidebar-right.jpg',
                )
            )
        )
    );
    
}
endif;
add_action( 'customize_register', 'presto_blog_customize_register_sidebar_layouts' );