<?php
$wp_customize->add_section(
    'pagination_options' ,
    array(
        'title' => __( 'Pagination Options', 'restochef' ),
        'panel' => 'restochef_option_panel',
    )
);

/* Pagination Type*/
$wp_customize->add_setting(
    'restochef_options[pagination_type]',
    array(
        'default'           => $default_options['pagination_type'],
        'sanitize_callback' => 'restochef_sanitize_select',
    )
);
$wp_customize->add_control(
    'restochef_options[pagination_type]',
    array(
        'label'       => __( 'Pagination Type', 'restochef' ),
        'section'     => 'pagination_options',
        'type'        => 'select',
        'choices'     => array(
            'default' => __( 'Default (Older / Newer Post)', 'restochef' ),
            'numeric' => __( 'Numeric', 'restochef' ),
            'ajax_load_on_click' => __( 'Load more post on click', 'restochef' ),
            'ajax_load_on_scroll' => __( 'Load more posts on scroll', 'restochef' ),
        ),
    )
);
