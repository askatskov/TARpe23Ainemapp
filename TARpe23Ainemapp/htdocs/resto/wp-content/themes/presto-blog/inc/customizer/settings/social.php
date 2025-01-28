<?php
/**
 * Social Settings
 *
 * @package Presto_Blog
*/

if( ! function_exists( 'presto_blog_customize_register_social' ) ) :
function presto_blog_customize_register_social( $wp_customize ){
    
    /** Social Settings */
    $wp_customize->add_section(
        'social_settings',
        array(
            'title'    => __( 'Social Settings', 'presto-blog' ),
            'priority' => 25,
            'panel'    => 'general_settings',
        )
    );

    /** Header Social Links */
    $wp_customize->add_setting( 
        'ed_social_links', 
        array(
            'default'           => false,
            'sanitize_callback' => 'presto_blog_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
		new Presto_Blog_Toggle_Control( 
			$wp_customize,
			'ed_social_links',
			array(
				'section'     => 'social_settings',
				'label'       => esc_html__( 'Header Social Links', 'presto-blog' ),
				'description' => esc_html__( 'Enable to show social links at header.', 'presto-blog' ),
			)
		)
	);

    /** Footer Social Links */
    $wp_customize->add_setting( 
        'ed_social_links_footer', 
        array(
            'default'           => false,
            'sanitize_callback' => 'presto_blog_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
		new Presto_Blog_Toggle_Control( 
			$wp_customize,
			'ed_social_links_footer',
			array(
				'section'     => 'social_settings',
				'label'       => esc_html__( 'Footer Social Links', 'presto-blog' ),
				'description' => esc_html__( 'Enable to show social links at footer.', 'presto-blog' ),
			)
		)
	);

    /** Social Links */
    $wp_customize->add_setting( 
        new Presto_Blog_Repeater_Setting( 
            $wp_customize, 
            'social_icons_links', 
            array(
                'default' => '',
                'sanitize_callback' => array( 'Presto_Blog_Repeater_Setting', 'sanitize_repeater_setting' ),
            ) 
        ) 
    );
    
    $wp_customize->add_control(
		new Presto_Blog_Control_Repeater(
			$wp_customize,
			'social_icons_links',
			array(
				'section' => 'social_settings',
				'label'   => esc_html__( 'Social Links', 'presto-blog' ),
				'fields'  => array(
                    'icon' => array(
                        'type'    => 'select',
                        'label'   => esc_html__( 'Social Media', 'presto-blog' ),
                        'choices' => presto_blog_get_svg_icons()
                    ),
                    'link' => array(
                        'type'        => 'url',
                        'label'       => esc_html__( 'Link', 'presto-blog' ),
                        'description' => esc_html__( 'Example: https://facebook.com', 'presto-blog' ),
                    ),
                    'checkbox' => array(
                        'type'  => 'checkbox',
                        'label' => esc_html__( 'Open link in new tab', 'presto-blog' ),
                    )
                ),
                'row_label' => array(
                    'type'  => 'field',
                    'value' => esc_html__( 'social link', 'presto-blog' ),
                    'field' => 'link'
                ),
                'choices'   => array(
                    'limit' => 10
                )
			)
		)
	);
}
endif;
add_action( 'customize_register', 'presto_blog_customize_register_social' );