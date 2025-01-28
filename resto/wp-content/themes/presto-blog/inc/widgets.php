<?php
/**
 * Widget Areas
 * 
 * @link https: //developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 * @package Presto_Blog
 */

if( ! function_exists( 'presto_blog_widgets_init' ) ) :
function presto_blog_widgets_init(){    
    $sidebars = array(
        'sidebar'   => array(
            'name'        => esc_html__( 'Sidebar', 'presto-blog' ),
            'id'          => 'sidebar',
            'description' => esc_html__( 'Add widgets here.', 'presto-blog' ),
        ),
        'after-header'   => array(
            'name'        => esc_html__( 'AD After Header', 'presto-blog' ),
            'id'          => 'after-header',
            'description' => esc_html__( 'Add custom HTML for google AD.', 'presto-blog' ),
        ),
        'before-footer'   => array(
            'name'        => esc_html__( 'AD Before Footer', 'presto-blog' ),
            'id'          => 'before-footer',
            'description' => esc_html__( 'Add custom HTML for google AD.', 'presto-blog' ),
        ),
        'footer-one'=> array(
            'name'        => __( 'Footer One', 'presto-blog' ),
            'id'          => 'footer-one',
            'description' => __( 'Add footer one widgets here.', 'presto-blog' ),
        ),
        'footer-two'=> array(
            'name'        => __( 'Footer Two', 'presto-blog' ),
            'id'          => 'footer-two',
            'description' => __( 'Add footer two widgets here.', 'presto-blog' ),
        ),
        'footer-three'=> array(
            'name'        => __( 'Footer Three', 'presto-blog' ),
            'id'          => 'footer-three',
            'description' => __( 'Add footer three widgets here.', 'presto-blog' ),
        ),
        'footer-four'=> array(
            'name'        => __( 'Footer Four', 'presto-blog' ),
            'id'          => 'footer-four',
            'description' => __( 'Add footer four widgets here.', 'presto-blog' ),
        ),
    );
    
    foreach( $sidebars as $sidebar ){
        register_sidebar( array(
    		'name'          => esc_html( $sidebar['name'] ),
    		'id'            => esc_attr( $sidebar['id'] ),
    		'description'   => esc_html( $sidebar['description'] ),
    		'before_widget' => '<section id="%1$s" class="widget %2$s">',
    		'after_widget'  => '</section>',
    		'before_title'  => '<h2 class="widget-title" itemprop="name">',
    		'after_title'   => '</h2>',
    	) );
    }
}
endif;
add_action( 'widgets_init', 'presto_blog_widgets_init' );