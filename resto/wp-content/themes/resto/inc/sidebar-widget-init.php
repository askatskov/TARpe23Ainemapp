<?php

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function resto_widgets_init() {
	register_sidebar( array(
		'name'          =>  esc_html__( 'Sidebar', 'resto' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

    register_sidebar( array(
        'name'          =>  esc_html__( 'Footer Area Full Widgets', 'resto' ),
        'id'            => 'blank-full-widgets',
        'description'   => '',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h1 class="widget-title">',
        'after_title'   => '</h1>',
    ) );

    $resto_get_all_options = resto_get_all_options(1);
    $resto_footer_widgets_number = $resto_get_all_options['resto-footer-sidebar-number'];

    if( $resto_footer_widgets_number > 0 ){
        register_sidebar(array(
            'name' => __('Footer Column One', 'resto'),
            'id' => 'footer-col-one',
            'description' => __('Displays items on footer section.','resto'),
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget' => '</aside>',
            'before_title'  => '<h1 class="widget-title">',
            'after_title'   => '</h1>',
        ));
        if( $resto_footer_widgets_number > 1 ){
            register_sidebar(array(
                'name' => __('Footer Column Two', 'resto'),
                'id' => 'footer-col-two',
                'description' => __('Displays items on footer section.','resto'),
                'before_widget' => '<aside id="%1$s" class="widget %2$s">',
                'after_widget' => '</aside>',
                'before_title'  => '<h1 class="widget-title">',
                'after_title'   => '</h1>',
            ));
        }
        if( $resto_footer_widgets_number > 2 ){
            register_sidebar(array(
                'name' => __('Footer Column Three', 'resto'),
                'id' => 'footer-col-three',
                'description' => __('Displays items on footer section.','resto'),
                'before_widget' => '<aside id="%1$s" class="widget %2$s">',
                'after_widget' => '</aside>',
                'before_title'  => '<h1 class="widget-title">',
                'after_title'   => '</h1>',
            ));
        }
        if( $resto_footer_widgets_number > 3 ){
            register_sidebar(array(
                'name' => __('Footer Column Four', 'resto'),
                'id' => 'footer-col-four',
                'description' => __('Displays items on footer section.','resto'),
                'before_widget' => '<aside id="%1$s" class="widget %2$s">',
                'after_widget' => '</aside>',
                'before_title'  => '<h1 class="widget-title">',
                'after_title'   => '</h1>',
            ));
        }
    }
}
add_action( 'widgets_init', 'resto_widgets_init' );

