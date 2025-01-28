<?php

/**
 * [restaurant_food_shop_setup code for after_setup_theme hook]
 * @return [type] [description]
 */
function restaurant_food_shop_setup() {

	// Register Overlay Menu
	register_nav_menus( array(
		'overlaymenu'	=> __( 'Overlay Menu', 'restaurant-food-shop' ),
	) );


}
add_action( 'after_setup_theme', 'restaurant_food_shop_setup' );

/**
 * [restaurant_food_shop_styles_scripts - add needed styles scripts]
 * @return [type] [description]
 */
function restaurant_food_shop_styles_scripts() {

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
    wp_enqueue_style( 'restaurant-food-shop',  get_stylesheet_directory_uri() . '/style.css', $dependency, wp_get_theme()->get('Version'), 'all' );

    // Load overlay-menu.js if overlay menu enabled in customize
    if( get_theme_mod( 'ovrly_menu_endis', '1' ) == 1 ) {
    	wp_enqueue_script( 'restaurant-food-shop-overlay-menu', get_stylesheet_directory_uri() . '/assets/js/overlay-menu.js', array( 'jquery' ), wp_get_theme()->get('Version'), true );
    }
}
add_action( 'wp_enqueue_scripts', 'restaurant_food_shop_styles_scripts' );


/**
 * [restaurant_food_shop_recomm_plugins - add Five Star Restaurant Reservations plugin in TGMPA]
 * @return [type] [description]
 */
function restaurant_food_shop_recomm_plugins() {

	$plugins = array(
		array(
				'name'      => __( 'Five Star Restaurant Reservations', 'restaurant-food-shop'),
				'slug'      => 'restaurant-reservations',
				'required'  => false,
			),
	);

	tgmpa( $plugins );
}
add_action( 'tgmpa_register', 'restaurant_food_shop_recomm_plugins' );

/**
 * [restaurant_food_shop_customize_pr_handle description]
 * @return [type] [description]
 */
function restaurant_food_shop_customize_pr_handle( $wp_customize ) {

	// For CTA
	$wp_customize->get_setting( 'bk_tbl_cta_endis' )->transport   = 'refresh';
	$wp_customize->selective_refresh->add_partial( 'bk_tbl_cta_endis', array(
		'selector'	=> '.book-tbl-otr',
	) );

	// For overlay menu
	$wp_customize->get_setting( 'ovrly_menu_endis' )->transport   = 'refresh';
	$wp_customize->selective_refresh->add_partial( 'ovrly_menu_endis', array(
		'selector'	=> '.ovrly-menu-otr',
	) );

}
add_action( 'customize_register', 'restaurant_food_shop_customize_pr_handle', 9999999 );

/**
 * [restaurant_food_shop_customizer_scripts_and_styles description]
 * @return [type] [description]
 */
function restaurant_food_shop_customizer_scripts_and_styles() {

	wp_enqueue_style( 'restaurant-food-shop-customize-preview', get_stylesheet_directory_uri() . '/assets/css/customizer.css', array( 'customize-preview', 'di-restaurant-customize-preview' ), wp_get_theme()->get('Version'), 'all' );

}
add_action( 'customize_preview_init', 'restaurant_food_shop_customizer_scripts_and_styles' );

/**
 * [restaurant_food_shop_kirki_options - Customize options]
 * @return [type] [description]
 */
function restaurant_food_shop_kirki_options() {

	// CTA - Book Table 
	Kirki::add_section( 'bk_tbl_cta', array(
		'title'          => esc_html__( 'CTA Book Table', 'restaurant-food-shop' ),
		'panel'          => 'di_restaurant_options',
		'capability'     => 'edit_theme_options',
	) );

	Kirki::add_field( 'di_restaurant_config', array(
		'type'        => 'toggle',
		'settings'    => 'bk_tbl_cta_endis',
		'label'       => esc_html__( 'CTA - Book Table', 'restaurant-food-shop' ),
		'description' => esc_html__( 'Turn on to enable: CTA - book table.', 'restaurant-food-shop' ),
		'section'     => 'bk_tbl_cta',
		'default'     => '1',
	) );

	Kirki::add_field( 'di_restaurant_config', array(
		'type'			=> 'text',
		'settings'		=> 'bk_tbl_cta_label',
		'label'			=> esc_html__( 'Label', 'restaurant-food-shop' ),
		'description' 	=> esc_html__( 'Label of CTA', 'restaurant-food-shop' ),
		'section'		=> 'bk_tbl_cta',
		'default'		=> esc_html__( 'Book Table', 'restaurant-food-shop' ),
		'active_callback'  => array(
			array(
				'setting'  => 'bk_tbl_cta_endis',
				'operator' => '==',
				'value'    => '1',
			),
		),
	) );

	Kirki::add_field( 'di_restaurant_config', array(
		'type'			=> 'url',
		'settings'		=> 'bk_tbl_cta_link',
		'label'			=> esc_html__( 'Link', 'restaurant-food-shop' ),
		'description' 	=> esc_html__( 'Link of CTA', 'restaurant-food-shop' ),
		'section'		=> 'bk_tbl_cta',
		'default'		=> esc_url( home_url( '/' ) ),
		'active_callback'  => array(
			array(
				'setting'  => 'bk_tbl_cta_endis',
				'operator' => '==',
				'value'    => '1',
			),
		),
	) );

	Kirki::add_field( 'di_restaurant_config', array(
		'type'        => 'toggle',
		'settings'    => 'bk_tbl_cta_link_trgt',
		'label'       => esc_html__( 'Link Target', 'restaurant-food-shop' ),
		'description' => esc_html__( 'Turn on to open link in new tab.', 'restaurant-food-shop' ),
		'section'     => 'bk_tbl_cta',
		'default'     => '0',
		'active_callback'  => array(
			array(
				'setting'  => 'bk_tbl_cta_endis',
				'operator' => '==',
				'value'    => '1',
			),
		),
	) );

	Kirki::add_field( 'di_restaurant_config', array(
		'type'        => 'color',
		'settings'    => 'bk_tbl_cta_clr',
		'label'       => esc_html__( 'Color', 'restaurant-food-shop' ),
		'description' => esc_html__( 'Color of the CTA button', 'restaurant-food-shop' ),
		'section'     => 'bk_tbl_cta',
		'default'     => '#ffffff',
		'choices'     => array(
			'alpha' => true,
		),
		'output' => array(
			array(
				'element'	=> '.book-tbl-otr .book-tbl',
				'property'	=> 'color',
			),
		),
		'transport' => 'auto',
		'active_callback'  => array(
			array(
				'setting'  => 'bk_tbl_cta_endis',
				'operator' => '==',
				'value'    => '1',
			),
		),
	) );

	Kirki::add_field( 'di_restaurant_config', array(
		'type'        => 'color',
		'settings'    => 'bk_tbl_cta_hvr_clr',
		'label'       => esc_html__( 'Hover Color', 'restaurant-food-shop' ),
		'description' => esc_html__( 'Hover color of the CTA button', 'restaurant-food-shop' ),
		'section'     => 'bk_tbl_cta',
		'default'     => '#ffffff',
		'choices'     => array(
			'alpha' => true,
		),
		'output' => array(
			array(
				'element'	=> '.book-tbl-otr .book-tbl:hover',
				'property'	=> 'color',
			),
		),
		'transport' => 'auto',
		'active_callback'  => array(
			array(
				'setting'  => 'bk_tbl_cta_endis',
				'operator' => '==',
				'value'    => '1',
			),
		),
	) );

	Kirki::add_field( 'di_restaurant_config', array(
		'type'        => 'typography',
		'settings'    => 'bk_tbl_cta_typog',
		'label'       => esc_html__( 'Typography', 'restaurant-food-shop' ),
		'description' => esc_html__( 'Typography of the CTA button', 'restaurant-food-shop' ),
		'section'     => 'bk_tbl_cta',
		'default'     => array(
			'font-family'    => 'Lora',
			'variant'        => 'regular',
			'font-size'      => '14px',
			'line-height'    => '0',
			'letter-spacing' => '1px',
			'text-transform' => 'capitalize',
		),
		'output'      => array(
			array(
				'element' => '.book-tbl-otr .book-tbl',
			),
		),
		'transport' => 'auto',
		'active_callback'  => array(
			array(
				'setting'  => 'bk_tbl_cta_endis',
				'operator' => '==',
				'value'    => '1',
			),
		),
	) );

	// Overlay Menu
	Kirki::add_section( 'ovrly_menu', array(
		'title'          => esc_html__( 'Overlay Menu', 'restaurant-food-shop' ),
		'panel'          => 'di_restaurant_options',
		'capability'     => 'edit_theme_options',
	) );

	Kirki::add_field( 'di_restaurant_config', array(
		'type'        => 'toggle',
		'settings'    => 'ovrly_menu_endis',
		'label'       => esc_html__( 'Overlay Menu', 'restaurant-food-shop' ),
		'description' => esc_html__( 'Turn on to enable Overlay menu. you can create or select menu, here: Dashboard > Appearance > Menu.', 'restaurant-food-shop' ),
		'section'     => 'ovrly_menu',
		'default'     => '1',
	) );

	Kirki::add_field( 'di_restaurant_config', array(
		'type'			=> 'text',
		'settings'		=> 'ovrly_menu_ttl_attr',
		'label'			=> esc_html__( 'Title', 'restaurant-food-shop' ),
		'description' 	=> esc_html__( 'Title of the menu icon', 'restaurant-food-shop' ),
		'section'		=> 'ovrly_menu',
		'default'		=> esc_html__( 'Overlay Menu', 'restaurant-food-shop' ),
		'active_callback'  => array(
			array(
				'setting'  => 'ovrly_menu_endis',
				'operator' => '==',
				'value'    => '1',
			),
		),
	) );

	Kirki::add_field( 'di_restaurant_config', array(
		'type'        => 'color',
		'settings'    => 'ovrly_menu_clr',
		'label'       => esc_html__( 'Links Color', 'restaurant-food-shop' ),
		'description' => esc_html__( 'Color of the menu items', 'restaurant-food-shop' ),
		'section'     => 'ovrly_menu',
		'default'     => '#818181',
		'choices'     => array(
			'alpha' => true,
		),
		'output' => array(
			array(
				'element'	=> 'ul.overlaymenu-class li a, .ovrly .ovrly-menu-closebtn',
				'property'	=> 'color',
			),
		),
		'transport' => 'auto',
		'active_callback'  => array(
			array(
				'setting'  => 'ovrly_menu_endis',
				'operator' => '==',
				'value'    => '1',
			),
		),
	) );

	Kirki::add_field( 'di_restaurant_config', array(
		'type'        => 'color',
		'settings'    => 'ovrly_menu_hvr_clr',
		'label'       => esc_html__( 'Links Hover Color', 'restaurant-food-shop' ),
		'description' => esc_html__( 'Hover color of the menu items', 'restaurant-food-shop' ),
		'section'     => 'ovrly_menu',
		'default'     => '#f1f1f1',
		'choices'     => array(
			'alpha' => true,
		),
		'output' => array(
			array(
				'element'	=> 'ul.overlaymenu-class li a:hover, ul.overlaymenu-class li a:focus, .ovrly .ovrly-menu-closebtn:hover',
				'property'	=> 'color',
			),
		),
		'transport' => 'auto',
		'active_callback'  => array(
			array(
				'setting'  => 'ovrly_menu_endis',
				'operator' => '==',
				'value'    => '1',
			),
		),
	) );

	Kirki::add_field( 'di_restaurant_config', array(
		'type'        => 'background',
		'settings'    => 'ovrly_menu_bg',
		'label'       => esc_html__( 'Background Property', 'restaurant-food-shop' ),
		'description' => esc_html__( 'Display background color or image.', 'restaurant-food-shop' ),
		'section'     => 'ovrly_menu',
		'default'     => array(
			'background-color'      => 'rgba(0,0,0, 0.8)',
			'background-image'      => '',
			'background-repeat'     => 'repeat',
			'background-position'   => 'center center',
			'background-size'       => 'cover',
			'background-attachment' => 'fixed',
		),
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element' => '.ovrly',
			),
		),
		'active_callback'  => array(
			array(
				'setting'  => 'ovrly_menu_endis',
				'operator' => '==',
				'value'    => '1',
			),
		),
	) );

	Kirki::add_field( 'di_restaurant_config', array(
		'type'        => 'color',
		'settings'    => 'ovrly_menu_bg_overlay',
		'label'       => esc_html__( 'Background Image Overlay Color', 'restaurant-food-shop' ),
		'description' => esc_html__( 'This color will apply over the background image.', 'restaurant-food-shop' ),
		'section'     => 'ovrly_menu',
		'default'     => '',
		'choices'     => array(
			'alpha' => true,
		),
		'output' => array(
			array(
				'element'  => '.overlay-bgoverlay-color',
				'property' => 'background-color',
			),
		),
		'transport' => 'auto',
		'active_callback'  => array(
			array(
				'setting'  => 'ovrly_menu_endis',
				'operator' => '==',
				'value'    => '1',
			),
		),
	) );

	Kirki::add_field( 'di_restaurant_config', array(
		'type'        => 'typography',
		'settings'    => 'ovrly_menu_typog',
		'label'       => esc_html__( 'Typography', 'restaurant-food-shop' ),
		'description' => esc_html__( 'Typography of the menu items', 'restaurant-food-shop' ),
		'section'     => 'ovrly_menu',
		'default'     => array(
			'font-family'    => 'Lora',
			'variant'        => 'regular',
			'font-size'      => '36px',
			'letter-spacing' => '0px',
			'text-transform' => 'inherit',
		),
		'output'      => array(
			array(
				'element' => 'ul.overlaymenu-class li',
			),
		),
		'transport' => 'auto',
		'active_callback'  => array(
			array(
				'setting'  => 'ovrly_menu_endis',
				'operator' => '==',
				'value'    => '1',
			),
		),
	) );


}
add_action( 'di_restaurant_sec_aftr_typog', 'restaurant_food_shop_kirki_options' );
