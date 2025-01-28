<?php
if ( ! function_exists( 'resto_set_global' ) ) :
/**
 *
 * @since Resto 1.0.0
 *
 * @param null
 * @return null
 *
 */
function resto_set_global() {
    $GLOBALS['resto_customizer_all_values'] = resto_get_all_options(1);
}
endif;
add_action( 'resto_action_before_head', 'resto_set_global', 0 );

if ( ! function_exists( 'resto_doctype' ) ) :
/**
 * Doctype Declaration
 *
 * @since Resto 1.0.0
 *
 * @param null
 * @return null
 *
 */
function resto_doctype() {
    ?>
    <!DOCTYPE html><html <?php language_attributes(); ?>>
<?php
}
endif;
add_action( 'resto_action_before_head', 'resto_doctype', 10 );

if ( ! function_exists( 'resto_before_wp_head' ) ) :
/**
 * Before wp head codes
 *
 * @since Resto 1.0.0
 *
 * @param null
 * @return null
 *
 */
function resto_before_wp_head() {
    ?>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php
}
endif;
add_action( 'resto_action_before_wp_head', 'resto_before_wp_head', 10 );

if( ! function_exists( 'resto_default_layout' ) ) :
    /**
     * Resto default layout function
     *
     * @since  Resto 1.0.0
     *
     * @param int
     * @return string
     */
    function resto_default_layout( $post_id = null ){

        global $resto_customizer_all_values,$post;
        $resto_default_layout = $resto_customizer_all_values['resto-default-layout'];
        if( is_home()){
            $post_id = get_option( 'page_for_posts' );
        }
        if( null == $post_id && isset ( $post->ID ) ){
            $post_id = $post->ID;
        }
        $resto_default_layout_meta = get_post_meta( $post_id, 'resto-default-layout', true );

        if( false != $resto_default_layout_meta ) {
            $resto_default_layout = $resto_default_layout_meta;
        }
        return $resto_default_layout;
    }
endif;

if ( ! function_exists( 'resto_body_class' ) ) :
/**
 * add body class
 *
 * @since Resto 1.0.0
 *
 * @param null
 * @return null
 *
 */
function resto_body_class( $resto_body_classes ) 
{
    if(!is_front_page() || ( is_front_page() )){
        $resto_default_layout = resto_default_layout();
        if( !empty( $resto_default_layout ) ){
            if( 'left-sidebar' == $resto_default_layout ){
                $resto_body_classes[] = 'evision-left-sidebar';
            }
            elseif( 'right-sidebar' == $resto_default_layout ){
                $resto_body_classes[] = 'evision-right-sidebar';
            }
            elseif( 'both-sidebar' == $resto_default_layout ){
                $resto_body_classes[] = 'evision-both-sidebar';
            }
            elseif( 'no-sidebar' == $resto_default_layout ){
                $resto_body_classes[] = 'evision-no-sidebar';
            }
            else{
                $resto_body_classes[] = 'evision-right-sidebar';
            }
        }
        else{
            $resto_body_classes[] = 'evision-right-sidebar';
        }
    }
    return $resto_body_classes;
}
endif;
add_action( 'body_class', 'resto_body_class', 10, 1);

if ( ! function_exists( 'resto_before_page_start' ) ) :
/**
 * intro loader
 *
 * @since Resto 1.0.0
 *
 * @param null
 * @return null
 *
 */
function resto_before_page_start() {
    /*intro loader*/
}
endif;
add_action( 'resto_action_before', 'resto_before_page_start', 10 );

if ( ! function_exists( 'resto_page_start' ) ) :
/**
 * page start
 *
 * @since Resto 1.0.0
 *
 * @param null
 * @return null
 *
 */
function resto_page_start() {
?>
    <div id="page" class="hfeed site">
<?php
}
endif;
add_action( 'resto_action_before', 'resto_page_start', 15 );

if ( ! function_exists( 'resto_skip_to_content' ) ) :
/**
 * Skip to content
 *
 * @since Resto 1.0.0
 *
 * @param null
 * @return null
 *
 */
function resto_skip_to_content() {
    ?>
    <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'resto' ); ?></a>
<?php
}
endif;
add_action( 'resto_action_before_header', 'resto_skip_to_content', 10 );

if ( ! function_exists( 'resto_header' ) ) :
/**
 * Main header
 *
 * @since Resto 1.0.0
 *
 * @param null
 * @return null
 *
 */
function resto_header() {
/*header goes here  */
global $resto_customizer_all_values;
$resto_slider_off = 'no-slider';
?>
<header id="masthead" class="wrapper wrap-head site-header" role="banner">
    <div class="wrapper wrapper-site-identity <?php if ($resto_customizer_all_values['resto-feature-slider-enable'] != 1)
{
    echo esc_attr( $resto_slider_off );
} ?>">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="site-branding">
                        <?php resto_the_custom_logo(); ?>
                        <?php
                        if ( is_front_page() && is_home() ) : ?>
                            <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                        <?php else : ?>
                            <p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
                        <?php
                        endif;

                        $description = get_bloginfo( 'description', 'display' );
                        if ( $description || is_customize_preview() ) : ?>
                            <p class="site-description"><?php echo esc_html($description); /* WPCS: xss ok. */ ?></p>
                        <?php
                        endif; ?>
                    </div><!-- .site-branding -->
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="nav-holder">
                        <?php 
                            $resto_header_button_text = $resto_customizer_all_values['resto-home-header-button-text'];
                            $resto_header_button_url = $resto_customizer_all_values['resto-home-header-button-link'];
                            if (1 == $resto_customizer_all_values['resto-header-button-enable']){ ?>
                                <span class="header-btn">
                                    <a href="<?php echo esc_url($resto_header_button_url); ?>" class="button">
                                        <?php echo esc_html( $resto_header_button_text); ?>
                                    </a>
                                </span>
                            <?php }
                        ?>

                        <button id="menu-toggle" class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><span class="fa fa-bars"></span></button>
                        <div id="site-header-menu" class="site-header-menu">
                            <div class="container">
                                <div class="row">
                                    <div class="col-sm-10 col-sm-offset-1">
                                        <button id="menu-toggle-close" class="menu-toggle" aria-controls="primary-menu"><span class="fa fa-close"></span></button>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-10 col-sm-offset-1">
                                        <nav id="site-navigation" class="main-navigation" role="navigation" aria-label="primary-menu">
                                        <?php
                                            wp_nav_menu( array(
                                                'theme_location' => 'primary',
                                                'menu_id'        => 'primary-menu',
                                                'menu_class'     => 'primary-menu',
                                            ) );
                                        ?>
                                        </nav><!-- #site-navigation -->
                                    </div>
                                </div>
                            </div>
                        </div><!-- site-header-menu -->
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
}
endif;
add_action( 'resto_action_header', 'resto_header', 10 );


if( ! function_exists( 'resto_main_slider_setion' ) ) :
/**
 * Main slider
 *
 * @since resto 1.0.0
 *
 * @param null
 * @return null
 *
 */
    function resto_main_slider_setion(){
        if (  is_front_page() && !is_home() ) {
            do_action('resto_action_main_slider');
        }
        else {
            do_action('resto-page-inner-title');
        }
    }
endif;
add_action( 'resto_action_on_header', 'resto_main_slider_setion', 10 );

if ( ! function_exists( 'resto_end_of_header' ) ) :
/**
 * Main Slider
 *
 * @since Resto 1.0.0
 *
 * @param null
 * @return null
 *
 */
function resto_end_of_header() { ?>
    </header><!-- #masthead -->
<?php }
endif;
add_action( 'resto_action_header_close', 'resto_end_of_header', 10 );


if ( ! function_exists( 'resto_content_start' ) ) :
/**
 * Main Slider
 *
 * @since Resto 1.0.0
 *
 * @param null
 * @return null
 *
 */
function resto_content_start() { ?>
    <div id="content" class="wrapper site-content">
<?php }
endif;
add_action( 'resto_action_after', 'resto_content_start', 10 );


if( ! function_exists( 'resto_add_breadcrumb' ) ) :

/**
 * Breadcrumb
 *
 * @since Resto 1.0.0
 *
 * @param null
 * @return null
 *
 */
    function resto_add_breadcrumb(){
        global $resto_customizer_all_values;
        // Bail if Breadcrumb disabled
        $breadcrumb_enable_breadcrumb = $resto_customizer_all_values['resto-enable-breadcrumb' ];
        if ( 1 != $breadcrumb_enable_breadcrumb ) {
            return;
        }
        // Bail if Home Page
        if ( is_front_page() || is_home() ) {
            return;
        }
        echo '<div id="breadcrumb" class="wrapper wrap-breadcrumb"><div class="container">';
         resto_simple_breadcrumb();
        echo '</div><!-- .container --></div><!-- #breadcrumb -->';
        return;
    }
endif;
add_action( 'resto_action_after_header', 'resto_add_breadcrumb', 10 );


