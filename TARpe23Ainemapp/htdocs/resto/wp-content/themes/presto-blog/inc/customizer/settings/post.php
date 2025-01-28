<?php
/**
 * Post Settings
 *
 * @package Presto_Blog
*/

if( ! function_exists( 'presto_blog_customize_register_single_post' ) ): 
function presto_blog_customize_register_single_post( $wp_customize ){
    
    /** Single Post Page Settings */
    $wp_customize->add_section(
        'post_page_settings',
        array(
            'title'    => __( 'Post Page Settings', 'presto-blog' ),
            'priority' => 50,
        )
    );

    $wp_customize->add_setting( 
        'ed_related_post', 
        array(
            'default'           => true,
            'sanitize_callback' => 'presto_blog_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
        new Presto_Blog_Toggle_Control( 
            $wp_customize,
            'ed_related_post',
            array(
                'section'     => 'post_page_settings',
                'label'       => __( 'Related Posts', 'presto-blog' ),
                'description' => __( 'Enable this option to display related posts.', 'presto-blog' ),
            )
        )
    );

    /** Related Posts Section Title */
    $wp_customize->add_setting(
        'related_post_title',
        array(
            'default'           => __( 'You Might Also Like', 'presto-blog' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
        'related_post_title',
        array(
            'type'            => 'text',
            'section'         => 'post_page_settings',
            'label'           => __( 'Related Posts Section Title', 'presto-blog' ),
            'active_callback' => 'presto_blog_related_posts_ac'
        )
    );
    
    $wp_customize->selective_refresh->add_partial( 'related_post_title', array(
        'selector'        => '.related-posts .related-title',
        'render_callback' => 'presto_blog_get_related_title',
    ) );
    
    /** Related Post Taxonomy */    
    $wp_customize->add_setting( 
        'related_taxonomy', 
        array(
            'default'           => 'cat',
            'sanitize_callback' => 'presto_blog_sanitize_select'
        ) 
    );

    $wp_customize->add_control(
        'related_taxonomy',
        array(
            'label'       => __( 'Related Post Taxonomy', 'presto-blog' ),
            'description' => __( 'Choose Categories/Tags to display related posts in post page.', 'presto-blog' ),
            'type'        => 'select',
            'section'     => 'post_page_settings',
            'choices'     => array(
                'cat' => __( 'Category', 'presto-blog' ),
                'tag' => __( 'Tags', 'presto-blog' ),
            ),
            'active_callback' => 'presto_blog_related_posts_ac'
        )
    );
}
endif;
add_action( 'customize_register', 'presto_blog_customize_register_single_post' );