<?php
/**
 * WordPress Actions and Filters
 *
 * @package Presto_Blog
 */

if ( ! function_exists( 'presto_blog_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function presto_blog_setup() {
    /*
    * Make theme available for translation.
    * Translations can be filed in the /languages/ directory.
    * If you're building a theme based on presto, use a find and replace
    * to change 'presto' to the name of your theme in all the template files.
    */
    load_theme_textdomain( 'presto-blog', get_template_directory() . '/languages' );

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

    // This theme uses wp_nav_menu() in one location.
    register_nav_menus(
        array(
            'primary'   => esc_html__( 'Primary', 'presto-blog' ),
            'secondary' => esc_html__( 'Secondary', 'presto-blog' ),
        )
    );

    /*
    * Switch default core markup for search form, comment form, and comments
    * to output valid HTML5.
    */
    add_theme_support(
        'html5',
        array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            'style',
            'script',
        )
    );

    // Set up the WordPress core custom background feature.
    add_theme_support(
        'custom-background',
        apply_filters(
            'presto_blog_custom_background_args',
            array(
                'default-color' => 'ffffff',
                'default-image' => '',
            )
        )
    );

    // Add theme support for selective refresh for widgets.
    add_theme_support( 'customize-selective-refresh-widgets' );

    //adding exceprt feature on the page
    add_post_type_support( 'page', 'excerpt' );

    // Add support for full and wide align images.
    add_theme_support( 'align-wide' );

    // Add support for block editor styles.
    add_theme_support( 'wp-block-styles' );
    
    // Add support for responsive embeds.
    add_theme_support( 'responsive-embeds' );

    /**
     * Add support for core custom logo.
     *
     * @link https://codex.wordpress.org/Theme_Logo
     */
    add_theme_support(
        'custom-logo',
        array(
            'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
            'header-text' => array( 'site-title', 'site-description' ) 
        )
    );

    add_theme_support( 
        'custom-header', 
        apply_filters( 'presto_blog_custom_header_args',
            array(
                'default-image'    => get_template_directory_uri().'/assets/images/banner-img.jpg',
                'width'            => 1440,
                'height'           => 800,
                'video'            => true,
                'wp-head-callback' => 'presto_blog_header_style',
            ) 
        ) 
    );

    register_default_headers( 
        array(
            'default-image' => array(
                'url'           => '%s/assets/images/banner-img.jpg',
                'thumbnail_url' => '%s/assets/images/banner-img.jpg',
                'description'   => __( 'Default Header Image', 'presto-blog' ),
            ),
        ) 
    );


    //Image Sizes    
    add_image_size( 'presto-blog-featured-home-posts', 400, 280, true );
    add_image_size( 'presto-blog-full', 1260, 602, true ); //single post, page, shop page
    add_image_size( 'presto-blog-shop', 285, 428, true );

    // Add theme support for Responsive Videos.
	add_theme_support( 'jetpack-responsive-videos' );
}
endif;
add_action( 'after_setup_theme', 'presto_blog_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function presto_blog_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'presto_blog_content_width', 844 );
}
add_action( 'after_setup_theme', 'presto_blog_content_width', 0 );

if( ! function_exists( 'presto_blog_template_redirect_content_width' ) ) :
/**
* Adjust content_width value according to template.
*
* @return void
*/
function presto_blog_template_redirect_content_width(){
    if( is_active_widget( 'sidebar' ) ){	   
        $GLOBALS['content_width'] = 844;
    }else{
        if( is_singular() ){
            if( presto_blog_sidebar( true ) === 'fullwidth-centered' ){
                $GLOBALS['content_width'] = 700;
            }else{
                $GLOBALS['content_width'] = 1260;         
            }                
        }else{
            $GLOBALS['content_width'] = 1260;
        }
    }
}
endif;
add_action( 'template_redirect', 'presto_blog_template_redirect_content_width' );

if( ! function_exists( 'presto_blog_scripts' ) ) :
/**
 * Enqueue scripts and styles.
 */
function presto_blog_scripts() {
	// Use minified libraries if SCRIPT_DEBUG is false
    $suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
    
    if( get_theme_mod( 'ed_localgoogle_fonts',false ) && ! is_customize_preview() && ! is_admin() ){

        wp_enqueue_style( 'presto-blog-google-fonts', presto_blog_get_webfont_url( presto_blog_google_fonts_url() ) );
    }else{
        wp_enqueue_style( 'presto-blog-google-fonts', presto_blog_google_fonts_url(), array(), null );
    }
	wp_enqueue_style( 'presto-blog-gutenberg', get_template_directory_uri(). '/assets/css/gutenberg' . $suffix . '.css', array(), PRESTO_BLOG_VERSION );
	
	if( presto_blog_is_woocommerce_activated() ){
		wp_enqueue_style( 'presto-blog-woo', get_template_directory_uri(). '/assets/css/woocommerce' . $suffix . '.css', array(), PRESTO_BLOG_VERSION );
	}

    wp_enqueue_style( 'presto-blog-style', get_template_directory_uri() . '/style.css', array(), PRESTO_BLOG_VERSION );
	wp_style_add_data( 'presto-blog-style', 'rtl', 'replace' );

    wp_enqueue_script( 'presto-blog-accessibility', get_template_directory_uri() . '/assets/js/modal-accessibility' . $suffix . '.js', array(), PRESTO_BLOG_VERSION, true );
	wp_enqueue_script( 'presto-blog-custom', get_template_directory_uri() . '/assets/js/custom' . $suffix . '.js', array( 'jquery' ), PRESTO_BLOG_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
endif;
add_action( 'wp_enqueue_scripts', 'presto_blog_scripts' );

if( ! function_exists( 'presto_blog_block_editor_styles' ) ) :
/**
 * Enqueue editor styles for Gutenberg
 */
function presto_blog_block_editor_styles() {
    $suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
    // Block styles.
    wp_enqueue_style( 'presto-blog-block-editor-style', get_template_directory_uri() . '/assets/css/editor-block' . $suffix . '.css' );

    // Add custom fonts.
    wp_enqueue_style( 'presto-blog-google-fonts', presto_blog_google_fonts_url(), array(), null );
}
endif;
add_action( 'enqueue_block_editor_assets', 'presto_blog_block_editor_styles' );

if( ! function_exists( 'presto_blog_admin_scripts' ) ) :
/**
 * Enqueue admin scripts and styles.
*/
function presto_blog_admin_scripts( $hook ){
    $suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
    if( $hook == 'themes.php' ){
        wp_enqueue_style( 'presto-blog-admin', get_template_directory_uri() . '/assets/css/admin' . $suffix . '.css', '', PRESTO_BLOG_VERSION );
    }
}
endif; 
add_action( 'admin_enqueue_scripts', 'presto_blog_admin_scripts' );

if( ! function_exists( 'presto_blog_body_classes' ) ) :
/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function presto_blog_body_classes( $classes ) {	
	$editor_options      = get_option( 'classic-editor-replace' );
	$allow_users_options = get_option( 'classic-editor-allow-users' );
	$ed_banner_section   = get_theme_mod( 'ed_banner_section', 'no_banner' );
 
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

    $classes[] = 'header-layout-one';

    if( $ed_banner_section == 'static_banner' ){
        $classes[] = 'hs-static-banner static-banner-layout-one';        
    }

    if( is_single() ){
        $classes[] = 'single-layout1';
    }
    
	if ( ! is_singular() && !( presto_blog_is_woocommerce_activated() && ( is_shop() || is_product_category() || is_product_tag() ) ) && !is_404() ) {	
		$classes[] = 'post-list-style2';
	}

	if ( !presto_blog_is_classic_editor_activated() || ( presto_blog_is_classic_editor_activated() && $editor_options == 'block' ) || ( presto_blog_is_classic_editor_activated() && $allow_users_options == 'allow' && has_blocks() ) ) {
        $classes[] = 'presto-blog-has-blocks';
    }

	$classes[] = presto_blog_sidebar( true );

	return $classes;
}
endif;
add_filter( 'body_class', 'presto_blog_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function presto_blog_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'presto_blog_pingback_header' );

if( ! function_exists( 'presto_blog_get_the_archive_title' ) ) :
/**
 * Filter Archive Title
*/
function presto_blog_get_the_archive_title( $title ){
    $query_obj = get_queried_object();
    if( is_author() ){
        /* translators: Author archive title. 1: Author name */
        $title = sprintf( __( '%1$sPosts By Author%2$s %3$s', 'presto-blog' ), '<span class="sub-title">', '</span>', '<h1 class="page-title">' . esc_html( $query_obj->display_name ) . '</h1>' );
        $title .= '<span class="post-count">' . sprintf( __( '%d POSTS', 'presto-blog' ), count_user_posts( $query_obj->ID ) ) . '</span>';
    }elseif( is_category() ){
        /* translators: Category archive title. 1: Category name */
        $title = sprintf( __( '%1$sCategory%2$s %3$s', 'presto-blog' ), '<span class="sub-title">', '</span>', '<h1 class="page-title">' . single_cat_title( '', false ) . '</h1>' );
        $title .= '<span class="post-count">' . sprintf( __( '%d POSTS', 'presto-blog' ), $query_obj->count ) . '</span>';
    }elseif( is_tag() ){
        /* translators: Tag archive title. 1: Tag name */
        $title = sprintf( __( '%1$sTag%2$s %3$s', 'presto-blog' ), '<span class="sub-title">', '</span>', '<h1 class="page-title">' . single_tag_title( '', false ) . '</h1>' );
        $title .= '<span class="post-count">' . sprintf( __( '%d POSTS', 'presto-blog' ), $query_obj->count ) . '</span>';
    }elseif( is_year() ){
        /* translators: Yearly archive title. 1: Year */
        $title = sprintf( __( '%1$sYear%2$s %3$s', 'presto-blog' ), '<span class="sub-title">', '</span>', '<h1 class="page-title">' . get_the_date( _x( 'Y', 'yearly archives date format', 'presto-blog' ) ) . '</h1>' );
    }elseif( is_month() ){
        /* translators: Monthly archive title. 1: Month name and year */
        $title = sprintf( __( '%1$sMonth%2$s %3$s', 'presto-blog' ), '<span class="sub-title">', '</span>', '<h1 class="page-title">' . get_the_date( _x( 'F Y', 'monthly archives date format', 'presto-blog' ) ) . '</h1>' );
    }elseif( is_day() ){
        /* translators: Daily archive title. 1: Date */
        $title = sprintf( __( '%1$sDay%2$s %3$s', 'presto-blog' ), '<span class="sub-title">', '</span>', '<h1 class="page-title">' . get_the_date( _x( 'F j, Y', 'daily archives date format', 'presto-blog' ) ) . '</h1>' );
    }elseif( is_post_type_archive() ) {
        if( is_post_type_archive( 'product' ) ){
            $title = '<h1 class="page-title">' . get_the_title( get_option( 'woocommerce_shop_page_id' ) ) . '</h1>';
        }else{
            /* translators: Post type archive title. 1: Post type name */
            $title = sprintf( __( '%1$sArchives%2$s %3$s', 'presto-blog' ), '<span class="sub-title">', '</span>', '<h1 class="page-title">' . post_type_archive_title( '', false ) . '</h1>' );
        }
    }elseif( is_tax() ) {
        $tax = get_taxonomy( get_queried_object()->taxonomy );
        /* translators: Taxonomy term archive title. 1: Taxonomy singular name, 2: Current taxonomy term */
        $title = '<span class="sub-title">' . esc_html( $tax->labels->singular_name ) . '</span><h1 class="page-title">' . single_term_title( '', false ) . '</h1>';
    }else {
        $title = sprintf( __( '%1$sArchives%2$s', 'presto-blog' ), '<h1 class="page-title">', '</h1>' );
    }
    return $title;
}
endif;
add_filter( 'get_the_archive_title', 'presto_blog_get_the_archive_title' );

if( ! function_exists( 'presto_blog_exclude_cat' ) ) :
/**
 * Exclude post with Category from blog and archive page. 
*/
function presto_blog_exclude_cat( $query ){
    $home_featured_post = get_theme_mod( 'home_featured_post' );
    $excludes           = array();
    
    if( ! is_admin() && $query->is_main_query() && $query->is_home() ){        

        if( $home_featured_post ){
            $home_featured_post = array_map( 'intval', $home_featured_post );
            $excludes = array_diff( array_unique( array_merge( $excludes, $home_featured_post ) ), array('') );
        }

        $query->set( 'post__not_in', $excludes );
    }      
}
endif;
add_filter( 'pre_get_posts', 'presto_blog_exclude_cat' );

if( ! function_exists( 'presto_blog_admin_notice' ) ) :
/**
 * Addmin notice for getting started page
*/
function presto_blog_admin_notice(){
    global $pagenow;
    $meta            = get_option( 'presto_blog_admin_notice' );
    $current_screen  = get_current_screen();
    
    if( 'themes.php' == $pagenow && !$meta ){
        
        if( $current_screen->id !== 'dashboard' && $current_screen->id !== 'themes' ){
            return;
        }

        if( is_network_admin() ){
            return;
        }

        if( ! current_user_can( 'manage_options' ) ){
            return;
        } ?>

        <div class="notice-info st-gs-info notice is-dismissible"> 
            <div class="st-gs-notice">
                <div class="st-gs-logo">
                    <svg width="80" height="80" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M78.1557 33.2405C72.7057 2.31768 63.8756 -3.62488 33.2254 1.77517H33.2279C2.58012 7.18272 -3.68493 15.7803 1.76761 46.7106C7.22265 77.6409 15.3327 83.701 46.698 78.1734C78.0607 72.6409 83.6083 64.1608 78.1557 33.2405ZM33.1328 50.2253L29.1069 57.1983C28.8237 57.8184 28.6844 58.5082 28.7212 59.2109C28.7356 59.49 28.7771 59.7704 28.8491 60.0507C29.2157 61.4798 30.2709 62.5337 31.5649 62.9542C32.3103 63.1973 33.1371 63.2301 33.9581 63.0004L51.0136 58.2433C56.8451 56.6159 60.3507 50.544 58.8444 44.68C57.3387 38.8164 51.3906 35.3823 45.5597 37.0101L35.0012 39.9568C31.8603 40.8322 28.6581 38.9835 27.8471 35.8264C27.0372 32.669 28.925 29.3992 32.0636 28.5233L47.1506 24.3123L44.7409 28.4859L32.9023 31.7904C31.5563 32.166 30.7478 33.5664 31.0955 34.9198C31.4432 36.2733 32.8148 37.0652 34.1615 36.69L46.3426 33.2904C47.3933 32.9972 48.2463 32.3298 48.7985 31.4711L52.6215 24.8495C52.9655 24.1829 53.1371 23.4265 53.0967 22.6534C53.0823 22.3743 53.0407 22.0939 52.9688 21.8136C52.6029 20.3893 51.5556 19.3383 50.2669 18.9146C49.5167 18.6678 48.6849 18.6331 47.8597 18.864L30.8046 23.622C24.9734 25.2488 21.4678 31.3207 22.9742 37.1847C24.4805 43.0487 30.4279 46.4824 36.2594 44.8549L46.818 41.9083C49.9582 41.0325 53.1611 42.8816 53.9714 46.0383C54.782 49.196 52.8942 52.4659 49.755 53.3414L34.688 57.5463L37.0973 53.3732L48.9148 50.0752C50.2608 49.6996 51.0697 48.2986 50.722 46.9452C50.3743 45.5917 49.0027 44.7998 47.6561 45.175L35.4745 48.5752C34.4943 48.8488 33.686 49.4479 33.1328 50.2253Z" fill="#212327"/>
                    </svg>
                </div>
                <div class="st-gs-cb">
                    <h3><?php printf( esc_html__( 'Thank you for choosing %1$s, you rock!!!', 'presto-blog' ), PRESTO_BLOG_NAME ); ?></h3>
                    <p><?php printf( __( '%1$s is now installed and ready to use. Click below to see theme documentation and other details to get started.', 'presto-blog' ), PRESTO_BLOG_NAME ) ; ?></p>
                    <div class="st-gs-btns">                        
                        <a href="<?php echo esc_url( admin_url( 'themes.php?page=presto-blog-theme-options' ) ); ?>" class="button st-btn-dashboard">
                            <span class="dashicons dashicons-dashboard"></span><?php esc_html_e( 'Getting Started', 'presto-blog' ); ?>
                        </a>
                    </div>
                </div>
            </div>
            <a href="?presto_blog_admin_notice=1" class="notice-dismiss"><span class="screen-reader-text"><?php esc_html_e( 'Dismiss', 'presto-blog' ); ?></span></a>
        </div>
    <?php }
}
endif;
add_action( 'admin_notices', 'presto_blog_admin_notice' );

if( ! function_exists( 'presto_blog_update_admin_notice' ) ) :
/**
 * Updating admin notice on dismiss
*/
function presto_blog_update_admin_notice(){
    if ( isset( $_GET['presto_blog_admin_notice'] ) && $_GET['presto_blog_admin_notice'] = '1' ) {
        update_option( 'presto_blog_admin_notice', true );
    }
}
endif;
add_action( 'admin_init', 'presto_blog_update_admin_notice' );

if( ! function_exists( 'presto_blog_change_comment_form_default_fields' ) ) :
    /**
     * Change Comment form default fields i.e. author, email & url.
    */
    function presto_blog_change_comment_form_default_fields( $fields ){    
        // get the current commenter if available
        $commenter = wp_get_current_commenter();
     
        // core functionality
        $req = get_option( 'require_name_email' );
        $aria_req = ( $req ? " aria-required='true'" : '' );    
     
        // Change just the author field
        $fields['author'] = '<p class="comment-form-author"><label for="author" class="screen-reader-text">' . esc_html__( 'Name', 'presto-blog' ) . '<span class="required">*</span></label><input id="author" name="author" placeholder="' . esc_attr__( 'Name*', 'presto-blog' ) . '" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></p>';
        
        $fields['email'] = '<p class="comment-form-email"><label for="email" class="screen-reader-text">' . esc_html__( 'Email', 'presto-blog' ) . '<span class="required">*</span></label><input id="email" name="email" placeholder="' . esc_attr__( 'Email*', 'presto-blog' ) . '" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></p>';
        
        $fields['url'] = '<p class="comment-form-url"><label for="url" class="screen-reader-text">' . esc_html__( 'Website', 'presto-blog' ) . '</label><input id="url" name="url" placeholder="' . esc_attr__( 'Website', 'presto-blog' ) . '" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p>'; 
        
        return $fields;    
    }
    endif;
    add_filter( 'comment_form_default_fields', 'presto_blog_change_comment_form_default_fields' );
    
    if( ! function_exists( 'presto_blog_change_comment_form_defaults' ) ) :
    /**
     * Change Comment Form defaults
    */
    function presto_blog_change_comment_form_defaults( $defaults ){    
        $defaults['comment_field'] = '<p class="comment-form-comment"><label for="comment" class="screen-reader-text">' . esc_html__( 'Comment', 'presto-blog' ) . '</label><textarea id="comment" name="comment" placeholder="' . esc_attr__( 'Comment', 'presto-blog' ) . '" cols="45" rows="8" aria-required="true"></textarea></p>';
        
        return $defaults;    
    }
    endif;
    add_filter( 'comment_form_defaults', 'presto_blog_change_comment_form_defaults' );