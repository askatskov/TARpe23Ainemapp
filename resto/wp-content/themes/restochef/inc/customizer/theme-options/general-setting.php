<?php
/*Header Options*/
$wp_customize->add_section(
    'general_settings' ,
    array(
        'title' => __( 'General Settings', 'restochef' ),
        'panel' => 'restochef_option_panel',
    )
);

/*Show Preloader*/
$wp_customize->add_setting(
    'restochef_options[show_lightbox_image]',
    array(
        'default'           => $default_options['show_lightbox_image'],
        'sanitize_callback' => 'restochef_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'restochef_options[show_lightbox_image]',
    array(
        'label'    => __( 'Show LightBox Image', 'restochef' ),
        'section'  => 'general_settings',
        'type'     => 'checkbox',
    )
);


$wp_customize->add_setting(
    'restochef_options[enable_cursor_dot_outline]',
    array(
        'default' => $default_options['enable_cursor_dot_outline'],
        'sanitize_callback' => 'restochef_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'restochef_options[enable_cursor_dot_outline]',
    array(
        'label' => esc_html__('Enable Cursor Dot Outline', 'restochef'),
        'section' => 'general_settings',
        'type' => 'checkbox',
    )
);
