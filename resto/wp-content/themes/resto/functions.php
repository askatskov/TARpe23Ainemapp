<?php
/**
 * Resto functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Resto
 */

/**
 * Get the path for the file ( to support child theme )
 *
 * @since Resto 1.0.0
 *
 * @param string $file_path, path from the theme
 * @return string full path of file inside theme
 *
 */
if( !function_exists('resto_file_directory') ){
	function resto_file_directory( $file_path ){

		if( file_exists( trailingslashit( get_stylesheet_directory() ) . $file_path) ){
			return trailingslashit( get_stylesheet_directory() ) . $file_path;
		}
		else{
			return trailingslashit( get_template_directory() ) . $file_path;
		}
	}
}

/**
 * require resto int.
 */
require get_template_directory() . '/inc/init.php';

if ( ! function_exists( 'resto_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function resto_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Resto, use a find and replace
	 * to change 'resto' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'resto', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );
	/*Added image size*/
	add_image_size( 'resto-main-slider', 1360, 834, true );
	add_image_size( 'resto-home-menu', 333, 335, true );
	add_image_size( 'resto-sticky-post', 666, 333, true );
	add_image_size( 'resto-blog-post', 271, 180, true );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'resto' ),
		'social' => esc_html__( 'Social Menu', 'resto' )
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'resto_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	/*implimenting new feature from 4.5*/
	add_theme_support( 'custom-logo', array(
		'header-text' => array( 'site-title', 'site-description' ),
	) );
}
endif;
add_action( 'after_setup_theme', 'resto_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function resto_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'resto_content_width', 640 );
}
add_action( 'after_setup_theme', 'resto_content_width', 0 );

/**
 * Enqueue scripts and styles.
 */

/*Google Fonts*/
function resto_google_fonts() {
    global $resto_customizer_all_values;
	$fonts_url = '';
	$fonts     = array();

	$resto_font_family_Primary = $resto_customizer_all_values['resto-font-family-Primary'];
	$resto_font_family_site_identity = $resto_customizer_all_values['resto-font-family-site-identity'];
	$resto_font_family_heading = $resto_customizer_all_values['resto-font-family-heading'];
	$resto_font_family_title = $resto_customizer_all_values['resto-font-family-title'];
	
	$resto_fonts = array();
	$resto_fonts[]=$resto_font_family_Primary;
	$resto_fonts[]=$resto_font_family_site_identity;
	$resto_fonts[]=$resto_font_family_heading;
	$resto_fonts[]=$resto_font_family_title;

	  $resto_fonts_stylesheet = '//fonts.googleapis.com/css?family=';

	  $i  = 0;
	  for ($i=0; $i < count( $resto_fonts ); $i++) {

	    if ( 'off' !== sprintf( _x( 'on', '%s font: on or off', 'resto' ), $resto_fonts[$i] ) ) {
			$fonts[] = $resto_fonts[$i];
		}

	  }

	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' => urlencode( implode( '|', $fonts ) ),
		), 'https://fonts.googleapis.com/css' );
	}

	return $fonts_url;
}

function resto_scripts() {
		// *** STYLE ***//

		/*google font*/
		wp_enqueue_style( 'resto-google-fonts', resto_google_fonts() );

		/*animation*/
	    wp_enqueue_style( 'wow-animate-css', get_template_directory_uri() . '/assets/frameworks/wow/css/animate.min.css', array(), '3.4.0' );/*added*/

	    
		// hoverdir menu
		wp_enqueue_style( 'hoverdir-css', get_template_directory_uri() . '/assets/frameworks/hoverdir/css/style.css', array(), '' );/*added*/

		//slick main
	    wp_enqueue_style( 'slick-css', get_template_directory_uri() . '/assets/frameworks/slick/slick.css', array(), '3.4.0' );/*added*/
		
		//slick theme
	    wp_enqueue_style( 'slick-theme', get_template_directory_uri() . '/assets/frameworks/slick/slick-theme.css', array(), '3.4.0' );/*added*/
		
		// Main stylesheet
		wp_enqueue_style( 'resto-style', get_stylesheet_uri() );
	    
		// *** SCRIPT ***//

		// modernizr
		wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/assets/js/modernizr.min.js', array('jquery'), '2.8.3', true );
		
		// easing
		wp_enqueue_script('easing-js', get_template_directory_uri() . '/assets/frameworks/jquery.easing/jquery.easing.js', array('jquery'), '0.3.6', 1);

		// wow
	    wp_enqueue_script('wow', get_template_directory_uri() . '/assets/frameworks/wow/js/wow.min.js', array('jquery'), '1.1.2', 1);

	    // hoverdir
	    wp_enqueue_script('hoverdir', get_template_directory_uri() . '/assets/frameworks/hoverdir/js/jquery.hoverdir.js', array('jquery'), '1.1.0', 1);

	    wp_enqueue_script('hoverdir-custom', get_template_directory_uri() . '/assets/frameworks/hoverdir/js/modernizr.custom.97074.js', array('jquery'), '2.6.2', 1);

        // menu2016
    	wp_enqueue_script( 'menu2016-js', get_template_directory_uri() . '/assets/js/menu2016.js', array( 'jquery' ), '20120206', true );
	    	
	    // slick
	    wp_enqueue_script('slick', get_template_directory_uri() . '/assets/frameworks/slick/slick.min.js', array('jquery'), '1.6.0', 1);

	    // waypoints
	    wp_enqueue_script('waypoints', get_template_directory_uri() . '/assets/frameworks/waypoints/jquery.waypoints.min.js', array('jquery'), '4.0.0', 1);

		/*cycle*/
		wp_enqueue_script( 'cycle2-script', get_template_directory_uri() . '/assets/frameworks/cycle2/jquery.cycle2.js', array( 'jquery' ), '2.1.6', true );
		wp_enqueue_script( 'cycle2-script-flip', get_template_directory_uri() . '/assets/frameworks/cycle2/jquery.cycle2.flip.js', array( 'jquery' ), '20140128', true );
		wp_enqueue_script( 'cycle2-script-scrollVert', get_template_directory_uri() . '/assets/frameworks/cycle2/jquery.cycle2.scrollVert.js', array( 'jquery' ), '20140128', true );
		wp_enqueue_script( 'cycle2-script-shuffle', get_template_directory_uri() . '/assets/frameworks/cycle2/jquery.cycle2.shuffle.js', array( 'jquery' ), '20140128', true );

		// custom
		wp_enqueue_script('evision-custom', get_template_directory_uri() . '/assets/js/evision-custom.js', array('jquery'), '1.0.1', 1);

		// skip-link-focus-fix
		wp_enqueue_script( 'resto-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'resto_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/*update to pro link*/
require_once( trailingslashit( get_template_directory() ) . 'trt-customize-pro/resto/class-customize.php' );
