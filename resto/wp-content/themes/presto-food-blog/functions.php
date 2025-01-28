<?php
/**
 * Theme functions and definitions
 *
 * @package presto_food_blog
 */

/**
 * Customizer
 */
require get_stylesheet_directory() . '/inc/customizer.php';

/**
 * After setup theme hook
 */
function presto_food_blog_theme_setup(){
    /*
     * Make child theme available for translation.
     * Translations can be filed in the /languages/ directory.
     */
    load_child_theme_textdomain( 'presto-food-blog', get_stylesheet_directory() . '/languages' );  
    
}
add_action( 'after_setup_theme', 'presto_food_blog_theme_setup' );

/**
 * Load assets.
 */
function presto_food_blog_enqueue_styles() {
    // Use minified libraries if SCRIPT_DEBUG is false
    $suffix      = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
    $slider_auto = get_theme_mod( 'slider_auto', false );

    if( presto_blog_is_woocommerce_activated() ){
        $dependency = array( 'presto-blog-google-fonts', 'presto-blog-gutenberg', 'presto-blog-woo', 'presto-blog-style' );
    }else{
        $dependency = array( 'presto-blog-google-fonts', 'presto-blog-gutenberg', 'presto-blog-style' );
    }

    wp_enqueue_style( 'presto-food-blog', get_stylesheet_directory_uri() . '/style.css', $dependency, PRESTO_BLOG_VERSION );
	
	wp_enqueue_script( 'presto-food-blog-custom', get_stylesheet_directory_uri() . '/assets/js/custom' . $suffix . '.js', array( 'jquery', 'presto-blog-accessibility', 'presto-blog-custom' ), PRESTO_BLOG_VERSION, true );

    wp_localize_script( 
        'presto-food-blog-custom', 
        'presto_food_blog_custom',
        array(
            'slider_auto' => $slider_auto,
        )
    );

}
add_action( 'wp_enqueue_scripts', 'presto_food_blog_enqueue_styles' );

function presto_blog_body_classes( $classes ) {	
	$editor_options      = get_option( 'classic-editor-replace' );
	$allow_users_options = get_option( 'classic-editor-allow-users' );
	$ed_banner_section   = get_theme_mod( 'ed_banner_section', 'no_banner' );
 
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

    $classes[] = 'header-layout-seven';

    if( $ed_banner_section == 'static_banner' ){
        $classes[] = 'hs-static-banner static-banner-layout-one';        
    }elseif( $ed_banner_section == 'newsletter_banner' ){
        $classes[] = 'hs-static-newsletter-banner static-banner-newslayout-one';        
    }

    if( is_single() ){
        $classes[] = 'single-layout1';
    }
    
	if ( ! is_singular() && !( presto_blog_is_woocommerce_activated() && ( is_shop() || is_product_category() || is_product_tag() ) ) && !is_404() ) {	
		$classes[] = 'post-list-style4';
	}

	if ( !presto_blog_is_classic_editor_activated() || ( presto_blog_is_classic_editor_activated() && $editor_options == 'block' ) || ( presto_blog_is_classic_editor_activated() && $allow_users_options == 'allow' && has_blocks() ) ) {
        $classes[] = 'presto-blog-has-blocks';
    }

	$classes[] = presto_blog_sidebar( true );

	return $classes;
}

function presto_blog_header(){ 
    get_template_part( 'headers/seven' );    
}

/**
 * Displays HomePage Banner
 */
function presto_blog_banner(){
	$ed_banner                   = get_theme_mod( 'ed_banner_section', 'no_banner' );
	$banner_subtitle             = get_theme_mod( 'banner_subtitle', __( 'Free Blogging Course','presto-food-blog' ) );
	$banner_title                = get_theme_mod( 'banner_title', __( 'Are you Ready to Start a Profitable Blog?','presto-food-blog' ) );
	$banner_link_one_label       = get_theme_mod( 'banner_link_one_label', __( 'Get Started','presto-food-blog' ) );
	$banner_link_one_url         = get_theme_mod( 'banner_link_one_url','#' );
	$banner_link_two_label       = get_theme_mod( 'banner_link_two_label', __( 'Learn More','presto-food-blog' ) );
	$banner_link_two_url         = get_theme_mod( 'banner_link_two_url','#' );
	$banner_newsletter_shortcode = get_theme_mod( 'banner_newsletter_shortcode' );

	if( is_front_page() ){
		if( has_custom_header() && ( $ed_banner == 'static_banner' || $ed_banner == 'newsletter_banner' ) ){ 
            $class       = ( $ed_banner == 'static_banner' ) ? ' banner-static' : ' newsletter_section';
            $video_class = ( is_header_video_active() && has_header_video() ) ? ' hs-video' : '';
            if( $ed_banner == 'static_banner' ){
                $banner_layout = ' layout-one';
            }elseif( $ed_banner == 'newsletter_banner' ){
                $banner_layout = ' newslayout-one';
            } ?>
            <div id="banner_section" class="site-banner<?php echo esc_attr( $banner_layout . $class . $video_class ); ?>">
                <div class="banner-items">
                    <div class="banner-item">
                        <?php 
                            the_custom_header_markup();
                            
                            if( $ed_banner == 'static_banner' && ( $banner_subtitle || $banner_title || ( $banner_link_one_label && $banner_link_one_url )  || ( $banner_link_two_label && $banner_link_two_url ) ) ){ ?>
                                <div class="item-content">
                                    <div class="container">
                                        <div class="item-content-inner">
                                            <?php 
                                                if( $banner_subtitle ){ ?>
                                                    <span class="sub-title"><?php echo esc_html( $banner_subtitle ); ?></span>
                                                    <?php 
                                                }
                                                if( $banner_title ){ ?>
                                                    <h2 class="item-title"><?php echo esc_html( $banner_title ); ?></h2>
                                                    <?php 
                                                }
                                                
                                                if( ( $banner_link_one_label && $banner_link_one_url ) || ( $banner_link_two_label && $banner_link_two_url ) ){ ?>
                                                    <div class="banner-desc-wrap">
                                                        <div class="btn-wrap">
                                                            <?php 
                                                                if( $banner_link_one_label && $banner_link_one_url ) { ?>
                                                                    <a href="<?php echo esc_url( $banner_link_one_url ); ?>" class="btn"><?php echo esc_html( $banner_link_one_label ); ?></a>
                                                                    <?php 
                                                                }
                                                                if( $banner_link_two_label && $banner_link_two_url ) { ?>
                                                                    <a href="<?php echo esc_url( $banner_link_two_url ); ?>" class="btn btn-outlined"><?php echo esc_html( $banner_link_two_label ); ?></a>
                                                                    <?php 
                                                                } 
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <?php 
                                                }       
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <?php 
                            }

                            if( $ed_banner == 'newsletter_banner' && $banner_newsletter_shortcode ){ ?>
                                <div class="newsletterwrap">
                                    <?php echo do_shortcode( wp_kses_post( $banner_newsletter_shortcode ) ); ?>
                                </div>
                                <?php
                            }
                        ?>
                    </div>
                </div>
            </div><!-- .site-banner -->
		    <?php 
		}
	}
}

function presto_blog_instagram(){
    $ed_instagram_section       = get_theme_mod( 'ed_instagram_section', false );
    $instagram_title            = get_theme_mod( 'instagram_title',__( 'I\'m on instagram', 'presto-food-blog' ) );
    $instagram_shortcode        = get_theme_mod( 'instagram_shortcode' );
    if( $ed_instagram_section && $instagram_title && $instagram_shortcode ){ ?>
        <div class="instagram-section insta-layout-6">
            <?php if( $instagram_title ) echo '<h2 class="section-title">' . esc_html( $instagram_title ). '</h2>'; ?>
            <?php if( $instagram_shortcode ) echo do_shortcode( wp_kses_post( $instagram_shortcode ) ); ?>
        </div>
        <?php 
    }
}

function presto_blog_google_fonts_url() {
    $fonts_url = '';
    $fonts     = array();

    /*
    * translators: If there are characters in your language that are not supported
    * by DM Sans, translate this to 'off'. Do not translate into your own language.
    */
    if ( 'off' !== _x( 'on', 'DM Sans font: on or off', 'presto-food-blog' ) ) {
        $fonts[] = 'DM Sans:regular,italic,500,500italic,700,700italic';
    }

    /*
    * translators: If there are characters in your language that are not supported
    * by Bodoni Moda:, translate this to 'off'. Do not translate into your own language.
    */
    if ( 'off' !== _x( 'on', 'DM Serif Display: font: on or off', 'presto-food-blog' ) ) {
        $fonts[] = 'DM Serif Display:regular,italic,600,600italic';
    }

    if ( $fonts ) {
        $fonts_url = add_query_arg(
            array(
                'family'  => urlencode( implode( '|', $fonts ) ),
                'display' => urlencode( 'swap' ),
            ),
            'https://fonts.googleapis.com/css'
        );
    }

    return esc_url( $fonts_url );
}

function presto_blog_author_link(){    
    echo '<span class="author-link">'; 
    esc_html_e( ' Presto Food Blog | Developed By ', 'presto-food-blog' );
    echo '<a href="' . esc_url( 'https://sublimetheme.com/' ) .'" rel="nofollow" target="_blank">' . esc_html__( 'SublimeTheme', 'presto-food-blog' ) . '</a></span>.';
}

/**
 * Custom Header Argument Filter
 */
function presto_food_blog_custom_header_args(){
    return array(
        'default-image'    => get_stylesheet_directory_uri().'/assets/images/banner-img.jpg',
        'width'            => 1440,
        'height'           => 800,
        'video'            => true,
        'wp-head-callback' => 'presto_blog_header_style',
    );
}
add_filter( 'presto_blog_custom_header_args', 'presto_food_blog_custom_header_args' );