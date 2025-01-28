<?php

/**
 * [restaurant_bar_setup add top bar menu]
 * @return [type] [description]
 */
function restaurant_bar_setup() {

	// Register Top Bar menu
	register_nav_menus( array(
		'topbarmenu'	=> __( 'Top Bar Menu', 'restaurant-bar' ),
	) );


}
add_action( 'after_setup_theme', 'restaurant_bar_setup' );


/**
 * [restaurant_bar_styles_scripts add needed css and js]
 * @return [type] [description]
 */
function restaurant_bar_styles_scripts() {

	$dependency = array( 'bootstrap', 'font-awesome', 'di-restaurant-style-default', 'di-restaurant-style-core' );
	if( class_exists( 'WooCommerce' ) ) {
		$dependency = array( 'bootstrap', 'font-awesome', 'di-restaurant-style-default', 'di-restaurant-style-core', 'di-restaurant-style-woo' ); 
	}

	/**
	 * Add the default/main css file of parent theme.
	 */
    wp_enqueue_style( 'di-restaurant-style-default', get_template_directory_uri() . '/style.css' );

    /**
	 * Add the main css file of the child theme after all css files of parent theme.
	 */
    wp_enqueue_style( 'restaurant-bar',  get_stylesheet_directory_uri() . '/style.css', $dependency, wp_get_theme()->get('Version'), 'all' );
}
add_action( 'wp_enqueue_scripts', 'restaurant_bar_styles_scripts' );

/**
 * [restaurant_bar_customize_pr_handle add shortcut to customizer]
 * @param  [type] $wp_customize [description]
 * @return [type]               [description]
 */
function restaurant_bar_customize_pr_handle( $wp_customize ) {
	$wp_customize->get_setting( 'bk_tbl_cta_label' )->transport   = 'refresh';
	$wp_customize->selective_refresh->add_partial( 'bk_tbl_cta_label', array(
		'selector'	=> '.book-tbl',
	) );
}
add_action( 'customize_register', 'restaurant_bar_customize_pr_handle', 9999999 );

/**
 * [restaurant_bar_kirki_options add customizer options]
 * @return [type] [description]
 */
function restaurant_bar_kirki_options() {

	// Top bar
	Kirki::add_section( 'top_bar', array(
		'title'          => esc_html__( 'Top Bar Options', 'restaurant-bar' ),
		'panel'          => 'di_restaurant_options',
		'capability'     => 'edit_theme_options',
	) );

	Kirki::add_field( 'di_restaurant_config', array(
		'type'        => 'toggle',
		'settings'    => 'display_top_bar',
		'label'       => esc_html__( 'Top Bar', 'restaurant-bar' ),
		'description' => esc_html__( 'Enable/Disable Top Bar', 'restaurant-bar' ),
		'section'     => 'top_bar',
		'default'     => '1',
	) );

	Kirki::add_field( 'di_restaurant_config', array(
		'type'        => 'select',
		'settings'    => 'tpbr_left_view',
		'label'       => esc_html__( 'Top Bar Left Content View', 'restaurant-bar' ),
		'section'     => 'top_bar',
		'default'     => '1',
		'choices'     => array(
			'1' => esc_html__( 'Address, Phone and Email', 'restaurant-bar' ),
			'2' => esc_html__( 'Text / HTML', 'restaurant-bar' ),
			'3' => esc_html__( 'Top Bar Menu', 'restaurant-bar' ),
			'4' => esc_html__( 'CTA', 'restaurant-bar' ),
			'5' => esc_html__( 'Disable', 'restaurant-bar' ),
		),
		'active_callback'  => array(
			array(
				'setting'  => 'display_top_bar',
				'operator' => '==',
				'value'    => 1,
			),
		)
	) );

	Kirki::add_field( 'di_restaurant_config', array(
		'type'        => 'editor',
		'settings'    => 'top_bar_left_content',
		'label'       => esc_html__( 'Top Bar Left Content', 'restaurant-bar' ),
		'description' => esc_html__( 'Text / HTML of Top Bar Left', 'restaurant-bar' ),
		'section'     => 'top_bar',
		'default'     => '</p>' . esc_html__( 'Left Contents.', 'restaurant-bar' ) . '</p>',
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'element'  => '.topbar_ctmzr_left',
				'function' => 'html',
			),
		),
		'partial_refresh' => array(
			'top_bar_left_content' => array(
				'selector'        => '.topbar_ctmzr_left',
				'render_callback' => function() {
					echo wp_kses_post( get_theme_mod( 'top_bar_left_content', '</p>' . __( 'Left Contents.', 'restaurant-bar' ) . '</p>' ) );
				},
			),
		),
		'active_callback'  => array(
			array(
				'setting'  => 'display_top_bar',
				'operator' => '==',
				'value'    => 1,
			),
			array(
				'setting'  => 'tpbr_left_view',
				'operator' => '==',
				'value'    => 2,
			),
		)
	) );

	Kirki::add_field( 'di_restaurant_config', array(
		'type'        => 'select',
		'settings'    => 'tpbr_right_view',
		'label'       => esc_html__( 'Top Bar Right Content View', 'restaurant-bar' ),
		'section'     => 'top_bar',
		'default'     => '4',
		'choices'     => array(
			'1' => esc_html__( 'Address, Phone and Email', 'restaurant-bar' ),
			'2' => esc_html__( 'Text / HTML', 'restaurant-bar' ),
			'3' => esc_html__( 'Top Bar Menu', 'restaurant-bar' ),
			'4' => esc_html__( 'CTA', 'restaurant-bar' ),
			'5' => esc_html__( 'Disable', 'restaurant-bar' ),
		),
		'active_callback'  => array(
			array(
				'setting'  => 'display_top_bar',
				'operator' => '==',
				'value'    => 1,
			),
		)
	) );

	Kirki::add_field( 'di_restaurant_config', array(
		'type'        => 'editor',
		'settings'    => 'top_bar_right_content',
		'label'       => esc_html__( 'Top Bar Right Content', 'restaurant-bar' ),
		'description' => esc_html__( 'Text / HTML of Top Bar Right', 'restaurant-bar' ),
		'section'     => 'top_bar',
		'default'     => '</p>' . esc_html__( 'Right Contents.', 'restaurant-bar' ) . '</p>',
		'js_vars'   => array(
			array(
				'element'  => '.topbar_ctmzr_right',
				'function' => 'html',
			),
		),
		'partial_refresh' => array(
			'top_bar_right_content' => array(
				'selector'        => '.topbar_ctmzr_right',
				'render_callback' => function() {
					echo wp_kses_post( get_theme_mod( 'top_bar_right_content', '</p>' . __( 'Right Contents.', 'restaurant-bar' ) . '</p>' ) );
				},
			),
		),
		'active_callback'  => array(
			array(
				'setting'  => 'display_top_bar',
				'operator' => '==',
				'value'    => 1,
			),
			array(
				'setting'  => 'tpbr_right_view',
				'operator' => '==',
				'value'    => 2,
			),
		)
	) );

	Kirki::add_field( 'di_restaurant_config', array(
		'type'			=> 'text',
		'settings'		=> 'tpbr_lft_addr',
		'label'			=> esc_html__( 'Address', 'restaurant-bar' ),
		'description' 	=> esc_html__( 'Leave empty for disable.', 'restaurant-bar' ),
		'section'		=> 'top_bar',
		'default'		=> esc_html__( '123 Street, NYC, US', 'restaurant-bar' ),
		'partial_refresh' => array(
			'tpbr_lft_addr' => array(
				'selector'        => '.tpbr_lft_phne_ctmzr',
				'render_callback' => function() {
					get_template_part( 'template-parts/topbar-parts/partial/topbar', 'phonemail' );
				},
			),
		),
		'active_callback'  => 'restaurant_bar_phonemail_active_callback',
	) );

	Kirki::add_field( 'di_restaurant_config', array(
		'type'			=> 'text',
		'settings'		=> 'tpbr_lft_phne',
		'label'			=> esc_html__( 'Phone Number', 'restaurant-bar' ),
		'description' 	=> esc_html__( 'Leave empty for disable.', 'restaurant-bar' ),
		'section'		=> 'top_bar',
		'default'		=> esc_html__( '0123456789', 'restaurant-bar' ),
		'partial_refresh' => array(
			'tpbr_lft_phne' => array(
				'selector'        => '.tpbr_lft_phne_ctmzr',
				'render_callback' => function() {
					get_template_part( 'template-parts/topbar-parts/partial/topbar', 'phonemail' );
				},
			),
		),
		'active_callback'  => 'restaurant_bar_phonemail_active_callback',
	) );

	Kirki::add_field( 'di_restaurant_config', array(
		'type'			=> 'text',
		'settings'		=> 'tpbr_lft_email',
		'label'			=> esc_html__( 'Email Address', 'restaurant-bar' ),
		'description' 	=> esc_html__( 'Leave empty for disable.', 'restaurant-bar' ),
		'section'		=> 'top_bar',
		'default'		=> esc_html__( 'info@example.com', 'restaurant-bar' ),
		'partial_refresh' => array(
			'tpbr_lft_email' => array(
				'selector'        => '.tpbr_lft_phne_ctmzr',
				'render_callback' => function() {
					get_template_part( 'template-parts/topbar-parts/partial/topbar', 'phonemail' );
				},
			),
		),
		'active_callback'  => 'restaurant_bar_phonemail_active_callback',
	) );

	Kirki::add_field( 'di_restaurant_config', array(
		'type'			=> 'text',
		'settings'		=> 'bk_tbl_cta_label',
		'label'			=> esc_html__( 'CTA Label', 'restaurant-bar' ),
		'section'		=> 'top_bar',
		'default'		=> esc_html__( 'Book Table', 'restaurant-bar' ),
		'active_callback'  => 'restaurant_bar_cta_active_callback',
	) );

	Kirki::add_field( 'di_restaurant_config', array(
		'type'			=> 'url',
		'settings'		=> 'bk_tbl_cta_link',
		'label'			=> esc_html__( 'CTA Link', 'restaurant-bar' ),
		'section'		=> 'top_bar',
		'default'		=> esc_url( home_url( '/' ) ),
		'active_callback'  => 'restaurant_bar_cta_active_callback',
	) );

	Kirki::add_field( 'di_restaurant_config', array(
		'type'        => 'toggle',
		'settings'    => 'bk_tbl_cta_link_trgt',
		'label'       => esc_html__( 'CTA Link Target', 'restaurant-bar' ),
		'description' => esc_html__( 'Tern on to open CTA link in new Tab', 'restaurant-bar' ),
		'section'     => 'top_bar',
		'default'     => '0',
		'active_callback'  => 'restaurant_bar_cta_active_callback',
	) );

	Kirki::add_field( 'di_restaurant_config', array(
		'type'			=> 'text',
		'settings'		=> 'cta_top_btm_mrgn',
		'label'			=> esc_html__( 'Top Bar Margin', 'restaurant-bar' ),
		'description'   => esc_html__( 'Top bottom margin i.e. 10px', 'restaurant-bar' ),
		'section'		=> 'top_bar',
		'default'		=> '10px',
		'output' => array(
			array(
				'element'  => '.bgtoph .bgtoph-row',
				'property' => 'padding-top',
			),
			array(
				'element'  => '.bgtoph .bgtoph-row',
				'property' => 'padding-bottom',
			),
		),
		'transport' => 'auto',
		'active_callback'  => array(
			array(
				'setting'  => 'display_top_bar',
				'operator' => '==',
				'value'    => 1,
			),
		),
	) );

	Kirki::add_field( 'di_restaurant_config', array(
		'type'        => 'color',
		'settings'    => 'top_bar_color',
		'label'       => esc_html__( 'Top Bar Color', 'restaurant-bar' ),
		'section'     => 'top_bar',
		'default'     => '#ffffff',
		'choices'     => array(
			'alpha' => true,
		),
		'output' => array(
			array(
				'element'  => '.bgtoph',
				'property' => 'color',
			),
		),
		'transport' => 'auto',
		'active_callback'  => array(
			array(
				'setting'  => 'display_top_bar',
				'operator' => '==',
				'value'    => 1,
			),
		)
	) );

	Kirki::add_field( 'di_restaurant_config', array(
		'type'        => 'color',
		'settings'    => 'top_bar_bg_color',
		'label'       => esc_html__( 'Top Bar Background Color', 'restaurant-bar' ),
		'section'     => 'top_bar',
		'default'     => '#020202',
		'choices'     => array(
			'alpha' => true,
		),
		'output' => array(
			array(
				'element'  => '.bgtoph',
				'property' => 'background-color',
			),
		),
		'transport' => 'auto',
		'active_callback'  => array(
			array(
				'setting'  => 'display_top_bar',
				'operator' => '==',
				'value'    => 1,
			),
		)
	) );

	Kirki::add_field( 'di_restaurant_config', array(
		'type'        => 'color',
		'settings'    => 'top_bar_links_color',
		'label'       => esc_html__( 'Links Color', 'restaurant-bar' ),
		'section'     => 'top_bar',
		'default'     => '#ffffff',
		'choices'     => array(
			'alpha' => true,
		),
		'output' => array(
			array(
				'element'  => '.bgtoph a',
				'property' => 'color',
			),
		),
		'transport' => 'auto',
		'active_callback'  => array(
			array(
				'setting'  => 'display_top_bar',
				'operator' => '==',
				'value'    => 1,
			),
		)
	) );

	Kirki::add_field( 'di_restaurant_config', array(
		'type'        => 'color',
		'settings'    => 'top_bar_mover_link_color',
		'label'       => esc_html__( 'Hover Links Color', 'restaurant-bar' ),
		'section'     => 'top_bar',
		'default'     => '#009999',
		'choices'     => array(
			'alpha' => true,
		),
		'output' => array(
			array(
				'element'  => '.bgtoph a:hover, .bgtoph a:focus',
				'property' => 'color',
			),
		),
		'transport' => 'auto',
		'active_callback'  => array(
			array(
				'setting'  => 'display_top_bar',
				'operator' => '==',
				'value'    => 1,
			),
		)
	) );

	Kirki::add_field( 'di_restaurant_config', array(
		'type'        => 'typography',
		'settings'    => 'top_bar_typog',
		'label'       => esc_html__( 'Top Bar Typography', 'restaurant-bar' ),
		'section'     => 'top_bar',
		'default'     => array(
			'font-family'    => 'Roboto',
			'variant'        => 'regular',
			'font-size'      => '14px',
			'line-height'    => '20px',
			'letter-spacing' => '0px',
			'text-transform' => 'inherit',
		),
		'output'      => array(
			array(
				'element' => '.bgtoph',
			),
		),
		'transport' => 'auto',
		'active_callback'  => array(
			array(
				'setting'  => 'display_top_bar',
				'operator' => '==',
				'value'    => 1,
			),
		),
	) );

	Kirki::add_field( 'di_restaurant_config', array(
		'type'        => 'typography',
		'settings'    => 'cta_typog',
		'label'       => esc_html__( 'Top Bar CTA Typography', 'restaurant-bar' ),
		'section'     => 'top_bar',
		'default'     => array(
			'font-family'    => 'Lora',
			'variant'        => 'regular',
			'font-size'      => '14px',
			'line-height'    => '0',
			'letter-spacing' => '1px',
			'text-transform' => 'uppercase',
		),
		'output'      => array(
			array(
				'element' => '.bgtoph .book-tbl .book-tbl-a',
			),
		),
		'transport' => 'auto',
		'active_callback'  => array(
			array(			// &&
				'setting'  => 'display_top_bar',
				'operator' => '==',
				'value'    => '1',
			),
			array(
				array(		// ||
					'setting'  => 'tpbr_left_view',
					'operator' => '==',
					'value'    => '4',
				),
				array(		// ||
					'setting'  => 'tpbr_right_view',
					'operator' => '==',
					'value'    => '4',
					
				),
			),
		),
	) );

}
add_action( 'di_restaurant_sec_aftr_typog', 'restaurant_bar_kirki_options' );

/**
 * [restaurant_bar_phonemail_active_callback active callback for phone mail part]
 * @return [type] [description]
 */
function restaurant_bar_phonemail_active_callback() {
	$topbar = get_theme_mod( 'display_top_bar', '1' );
	$left = get_theme_mod( 'tpbr_left_view', '1' );
	$right = get_theme_mod( 'tpbr_right_view', '4' );
	if( $topbar == 1 && ( $left == 1 || $right == 1 ) ) {
		return true;
	} else {
		return false;
	}
}

/**
 * [restaurant_bar_cta_active_callback active callback for CTA]
 * @return [type] [description]
 */
function restaurant_bar_cta_active_callback() {
	$topbar = get_theme_mod( 'display_top_bar', '1' );
	$left = get_theme_mod( 'tpbr_left_view', '1' );
	$right = get_theme_mod( 'tpbr_right_view', '4' );
	if( $topbar == 1 && ( $left == 4 || $right == 4 ) ) {
		return true;
	} else {
		return false;
	}
}

/**
 * [restaurant_bar_recomm_plugins recommend Restaurant Reservation plugin]
 * @return [type] [description]
 */
function restaurant_bar_recomm_plugins() {

	$plugins = array(
		array(
				'name'      => esc_html__( 'Five Star Restaurant Reservations', 'restaurant-bar'),
				'slug'      => 'restaurant-reservations',
				'required'  => false,
			),
	);

	tgmpa( $plugins );
}
add_action( 'tgmpa_register', 'restaurant_bar_recomm_plugins' );
