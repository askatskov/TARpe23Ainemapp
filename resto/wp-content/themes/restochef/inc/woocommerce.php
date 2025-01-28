<?php
/**
 * WooCommerce Compatibility File
 *
 * @link https://woocommerce.com/
 *
 * @package Restochef
 */

/**
 * WooCommerce setup function.
 *
 * @link https://docs.woocommerce.com/document/third-party-custom-theme-compatibility/
 * @link https://github.com/woocommerce/woocommerce/wiki/Enabling-product-gallery-features-(zoom,-swipe,-lightbox)
 * @link https://github.com/woocommerce/woocommerce/wiki/Declaring-WooCommerce-support-in-themes
 *
 * @return void
 */
remove_action( 'woocommerce_sidebar',             'woocommerce_get_sidebar', 10 );
function restochef_woocommerce_setup() {
    global $woocommerce;

    add_theme_support(
        'woocommerce',
        array(
            'thumbnail_image_width' => 570,
            'single_image_width'    => 665,
            'product_grid'          => array(
                'default_rows'    => 3,
                'min_rows'        => 1,
                'default_columns' => 4,
                'min_columns'     => 1,
                'max_columns'     => 6,
            ),
        )
    );

    if( version_compare( $woocommerce->version, '3.0', ">=" ) ) {
        add_theme_support( 'wc-product-gallery-zoom' );
        add_theme_support( 'wc-product-gallery-lightbox' );
        add_theme_support( 'wc-product-gallery-slider' );
    }
}
add_action( 'after_setup_theme', 'restochef_woocommerce_setup' );

/**
 * Woocommerce Sidebar
*/
function restochef_woocoommerce_widgets_init(){
    register_sidebar( array(
		'name'          => esc_html__( 'Shop Sidebar', 'restochef' ),
		'id'            => 'shop-sidebar',
		'description'   => esc_html__( 'Sidebar displaying only in woocommerce pages.', 'restochef' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );    
}
add_action( 'widgets_init', 'restochef_woocoommerce_widgets_init' );


/**
 * WooCommerce specific scripts & stylesheets.
 *
 * @return void
 */
function restochef_woocommerce_scripts() {
	wp_enqueue_style( 'restochef-woocommerce-style', get_template_directory_uri() . '/assets/css/woocommerce.css', array(), _S_VERSION );

}
add_action( 'wp_enqueue_scripts', 'restochef_woocommerce_scripts' );

/**
 * Add 'woocommerce-active' class to the body tag.
 *
 * @param  array $classes CSS classes applied to the body tag.
 * @return array $classes modified to include 'woocommerce-active' class.
 */
function restochef_woocommerce_active_body_class( $classes ) {
	$classes[] = 'woocommerce-active';

	return $classes;
}
add_filter( 'body_class', 'restochef_woocommerce_active_body_class' );

/**
 * Related Products Args.
 *
 * @param array $args related products args.
 * @return array $args related products args.
 */
function restochef_woocommerce_related_products_args( $args ) {
	$defaults = array(
		'posts_per_page' => 3,
		'columns'        => 3,
	);

	$args = wp_parse_args( $defaults, $args );

	return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'restochef_woocommerce_related_products_args' );

/**
 * Remove default WooCommerce wrapper.
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

if (!function_exists('restochef_woocommerce_wrapper_before')) {
    /**
     * Before Content.
     *
     * Wraps all WooCommerce content in wrappers which match the theme markup.
     *
     * @return void
     */
    function restochef_woocommerce_wrapper_before()
    {
        ?>
        <main id="site-content" role="main">
        <div class="wrapper">
        <div id="primary" class="content-area">
        <?php
    }
}
add_action('woocommerce_before_main_content', 'restochef_woocommerce_wrapper_before');

if (!function_exists('restochef_woocommerce_wrapper_after')) {
    /**
     * After Content.
     *
     * Closes the wrapping divs.
     *
     * @return void
     */
    function restochef_woocommerce_wrapper_after()
    {
        ?>
        </div>
        <?php do_action('restochef_woocommerce_sidebar'); ?>
        </div>
        </main><!-- #main -->
        <?php

    }
}
add_action('woocommerce_after_main_content', 'restochef_woocommerce_wrapper_after');

/**
 * Callback function for Shop sidebar
*/
function restochef_woocommerce_sidebar_cb(){
    if( is_active_sidebar( 'shop-sidebar' ) ){
        echo '<aside id="secondary" class="widget-area" role="complementary">';
        dynamic_sidebar( 'shop-sidebar' );
        echo '</aside>'; 
    }
}
add_action( 'restochef_woocommerce_sidebar', 'restochef_woocommerce_sidebar_cb' );



/**
 * Removes the "shop" title on the main shop page
*/
add_filter( 'woocommerce_show_page_title' , '__return_false' );

if( ! function_exists( 'restochef_woocommerce_cart_count' ) ) :
/**
 * Woocommerce Cart Count
 * 
 * @link https://isabelcastillo.com/woocommerce-cart-icon-count-theme-header 
*/
function restochef_woocommerce_cart_count(){
    $cart_page = get_option( 'woocommerce_cart_page_id' );
    $count = WC()->cart->cart_contents_count;
    if( $cart_page ){ ?>
    <a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="cart theme-button theme-button-transparent" title="<?php esc_attr_e( 'View your shopping cart', 'restochef' ); ?>">
        <?php restochef_theme_svg('cart'); ?>

        <span class="number"><?php echo absint( $count ); ?></span>
    </a>
    <?php
    }
}
endif;

/**
 * Ensure cart contents update when products are added to the cart via AJAX
 * 
 * @link https://isabelcastillo.com/woocommerce-cart-icon-count-theme-header
 */
function restochef_woocommerce_add_to_cart_fragment( $fragments ){
    ob_start();
    $count = WC()->cart->cart_contents_count; ?>
    <a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="cart theme-button theme-button-transparent" title="<?php esc_attr_e( 'View your shopping cart', 'restochef' ); ?>">

        <?php restochef_theme_svg('cart'); ?>

        <span class="number"><?php echo absint( $count ); ?></span>
    </a>
    <?php
 
    $fragments['a.cart'] = ob_get_clean();
     
    return $fragments;
}
add_filter( 'woocommerce_add_to_cart_fragments', 'restochef_woocommerce_add_to_cart_fragment' );

/**
 * Ajax Callback for adding product in cart
 * 
*/
function restochef_woocommerce_add_cart_ajax() {
	global $woocommerce;
    
    $product_id = $_POST['product_id'];

	WC()->cart->add_to_cart( $product_id, 1 );
	$count = WC()->cart->cart_contents_count;
	$cart_url = $woocommerce->cart->get_cart_url(); 
    
    ?>
    <a href="<?php echo esc_url( $cart_url ); ?>" rel="bookmark" class="btn-add-to-cart"><?php esc_html_e( 'View Cart', 'restochef' ); ?></a>
    <input type="hidden" id="<?php echo esc_attr( 'cart' . $product_id ); ?>" value="<?php echo esc_attr( $count ); ?>" />
    <?php
    die();
}
add_action( 'wp_ajax_restochef_woocommerce_add_cart_single', 'restochef_woocommerce_add_cart_ajax' );
add_action( 'wp_ajax_nopriv_restochef_woocommerce_add_cart_single', 'restochef_woocommerce_add_cart_ajax' );
