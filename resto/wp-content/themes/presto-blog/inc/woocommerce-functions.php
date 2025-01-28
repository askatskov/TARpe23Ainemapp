<?php
/**
 * Presto Woocommerce hooks and functions.
 *
 * @link https://docs.woothemes.com/document/third-party-custom-theme-compatibility/
 *
 * @package Presto_Blog
 */

/**
 * Woocommerce related hooks
*/
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );

//adding add to cart
add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_add_to_cart', 15 );
add_action( 'presto_blog_after_woo_container', 'woocommerce_output_related_products', 10 );
add_filter( 'woocommerce_show_page_title', '__return_false' );

/**
 * Declare Woocommerce Support
*/
function presto_blog_woocommerce_support() {
    global $woocommerce;
    
    add_theme_support( 'woocommerce' );
    
    if( version_compare( $woocommerce->version, '3.0', ">=" ) ) {
        add_theme_support( 'wc-product-gallery-zoom' );
        add_theme_support( 'wc-product-gallery-lightbox' );
        add_theme_support( 'wc-product-gallery-slider' );
    }
}
add_action( 'after_setup_theme', 'presto_blog_woocommerce_support');

/**
 * Before Content
 * Wraps all WooCommerce content in wrappers which match the theme markup
*/
function presto_blog_wc_wrapper(){ ?>
    <main id="main" class="woo-site-main" role="main">
    <?php
}
add_action( 'woocommerce_before_main_content', 'presto_blog_wc_wrapper' );

/**
 * After Content
 * Closes the wrapping divs
*/
function presto_blog_wc_wrapper_end(){ ?>
    </main>
    <?php
}
add_action( 'woocommerce_after_main_content', 'presto_blog_wc_wrapper_end' );

function presto_blog_wc_img_wrapper(){
    echo '<div class="wc-img-wrapper">';
}
add_action( 'woocommerce_before_shop_loop_item_title', 'presto_blog_wc_img_wrapper', 9 );

function presto_blog_wc_img_wrapper_end(){
    echo '</div>';
}
add_action( 'woocommerce_before_shop_loop_item_title', 'presto_blog_wc_img_wrapper_end', 16 );

if ( ! function_exists( 'presto_blog_header_woo_cart' ) ) :
/**
 * Displays Header Cart.
 */
function presto_blog_header_woo_cart(){
    $cart_page      = get_option( 'woocommerce_cart_page_id' );
    $count          = WC()->cart->cart_contents_count;
    $ed_header_cart = get_theme_mod( 'ed_header_cart', false );

    if( $ed_header_cart && $cart_page ){ ?>
        <div class="header-woo-cart">
            <a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="woo-cart" title="<?php esc_attr_e( 'Cart', 'presto-blog' ); ?>">
                <?php echo presto_blog_svg_collection( 'woo-cart' ); ?>
                <span class="cart-count">(<?php echo absint( $count ); ?>)</span>
            </a>
        </div>
        <?php 
    }
}
endif;

/**
 * Filter the image size in shop and archive page
 */
function presto_blog_woo_image_size() {
    return 'presto-blog-shop';
}
add_filter( 'single_product_archive_thumbnail_size', 'presto_blog_woo_image_size' );
add_filter( 'subcategory_archive_thumbnail_size', 'presto_blog_woo_image_size' );

/**
 * Ensure cart contents update when products are added to the cart via AJAX
 * 
 * @link https://isabelcastillo.com/woocommerce-cart-icon-count-theme-header
 */
function presto_blog_add_to_cart_fragment( $fragments ){
    ob_start();
    $count = WC()->cart->cart_contents_count; ?>    
    <a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="woo-cart" title="<?php esc_attr_e( 'Cart', 'presto-blog' ); ?>">
        <?php echo presto_blog_svg_collection( 'woo-cart' ); ?>
        <span class="cart-count">(<?php echo absint( $count ); ?>)</span>
    </a>
    <?php
 
    $fragments['a.woo-cart'] = ob_get_clean();
     
    return $fragments;
}
add_filter( 'woocommerce_add_to_cart_fragments', 'presto_blog_add_to_cart_fragment' );

if ( ! function_exists( 'presto_blog_header_woo_user' ) ) :
/**
 * Displays Header User.
 */
function presto_blog_header_woo_user(){
    $ed_woo_user = get_theme_mod( 'ed_woo_user', false );
    if( $ed_woo_user ){ ?>
        <div class="header-woo-user">
            <a href="<?php the_permalink( wc_get_page_id( 'myaccount' ) ); ?>" class="woo-user" title="<?php esc_attr_e( 'My Account', 'presto-blog' ); ?>">
                <?php echo presto_blog_svg_collection( 'woo-user' ); ?>
            </a>
        </div>
        <?php 
    }
}
endif;