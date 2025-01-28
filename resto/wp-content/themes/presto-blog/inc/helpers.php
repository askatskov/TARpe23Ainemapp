<?php
/**
 * Helper Functions
 *
 * @package Presto_Blog
 */

if ( ! function_exists( 'wp_body_open' ) ) :
/**
 * Shim for sites older than 5.2.
 *
 * @link https://core.trac.wordpress.org/ticket/12563
 */
function wp_body_open() {
    do_action( 'wp_body_open' );
}
endif;

if ( ! function_exists( 'presto_blog_site_branding' ) ) :
/**
 * Displays Site Branding.
 */
function presto_blog_site_branding( $mobile = false){ ?>
    <div class="site-branding hide-element" <?php if( ! $mobile ) presto_blog_microdata( 'organization' ); ?>>
        <?php
            the_custom_logo();
            
            if ( is_front_page() && ! $mobile ) : ?>
                <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                <?php
            else : ?>
                <p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
                <?php
            endif;
            
            $presto_blog_description = get_bloginfo( 'description', 'display' );

            if ( $presto_blog_description || is_customize_preview() ) : ?>
                <p class="site-description"><?php echo $presto_blog_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
                <?php 
            endif; 
        ?>
    </div><!-- .site-branding -->
    <?php 
}
endif;

if ( ! function_exists( 'presto_blog_main_navigation' ) ) :
/**
 * Displays Main Navigation
 */
function presto_blog_main_navigation(){ ?>
    <nav id="site-navigation" class="main-navigation" <?php presto_blog_microdata( 'navigation' ); ?>> 
        <button class="toggle-button" aria-controls="primary-menu" data-toggle-target=".main-menu-modal" data-toggle-body-class="showing-main-menu-modal" aria-expanded="false" data-set-focus=".close-main-nav-toggle">
            <span class="toggle-bar"></span>
            <span class="toggle-bar"></span>
            <span class="toggle-bar"></span>
        </button>
        <div class="primary-menu-list main-menu-modal cover-modal" data-modal-target-string=".main-menu-modal">
            <button class="close close-main-nav-toggle" data-toggle-target=".main-menu-modal" data-toggle-body-class="showing-main-menu-modal" aria-expanded="false" data-set-focus=".main-menu-modal">
                <span class="toggle-bar"></span>
                <span class="toggle-text"><?php esc_html_e( 'Close', 'presto-blog' ); ?></span>
            </button>
            <div class="mobile-menu" aria-label="<?php esc_attr_e( 'Mobile', 'presto-blog' ); ?>">
                <?php
                    wp_nav_menu(
                        array(
                            'theme_location' => 'primary',
                            'menu_id'        => 'primary-menu',
                            'fallback_cb'    => 'presto_blog_primary_menu_fallback',
                            'menu_class'	 => 'menu main-menu-modal'
                        )
                    );
                ?>
            </div>
        </div>
    </nav><!-- #site-navigation -->
    <?php 
}
endif;

if( ! function_exists( 'presto_blog_primary_menu_fallback' ) ) :
/**
 * Primary Menu Fallback
*/
function presto_blog_primary_menu_fallback(){
    if( current_user_can( 'manage_options' ) ){
        echo '<ul id="primary-menu" class="menu">';
        echo '<li><a href="' . esc_url( admin_url( 'nav-menus.php' ) ) . '">' . esc_html__( 'Click here to add a menu', 'presto-blog' ) . '</a></li>';
        echo '</ul>';
    }
}
endif;

if ( ! function_exists( 'presto_blog_secondary_navigation' ) ) :
/**
 * Displays Main Navigation
 */
function presto_blog_secondary_navigation( $mobile = false ){ 
    $id      = $mobile ? 'mobile-secondary-navigation' : 'secondary-navigation';
    $menu_id = $mobile ? 'mobile-secondary-menu' : 'secondary-menu'; ?>
    <nav id="<?php echo esc_attr( $id ); ?>" class="secondary-navigation"> 
        <div class="secondary-menu-list">
            <?php
                wp_nav_menu(
                    array(
                        'theme_location' => 'secondary',
                        'menu_id'        => $menu_id,
                        'fallback_cb'    => 'presto_blog_secondary_menu_fallback',
                        'menu_class'	 => 'menu secondary-menu'
                    )
                );
            ?>
        </div>
    </nav><!-- #site-navigation -->
    <?php 
}
endif;

if( ! function_exists( 'presto_blog_secondary_menu_fallback' ) ) :
/**
 * Primary Menu Fallback
*/
function presto_blog_secondary_menu_fallback(){
    if( current_user_can( 'manage_options' ) ){
        echo '<ul id="secondary-menu" class="menu secondary-menu">';
        echo '<li><a href="' . esc_url( admin_url( 'nav-menus.php' ) ) . '">' . esc_html__( 'Click here to add a menu', 'presto-blog' ) . '</a></li>';
        echo '</ul>';
    }
}
endif;

if ( ! function_exists( 'presto_blog_header_social' ) ) :
/**
 * Displays Header Social.
 */
function presto_blog_header_social(){ 
    $ed_social = get_theme_mod( 'ed_social_links', false ); 
    if( $ed_social ) { ?>
        <div class="header-left">
            <div class="header-social">
                <?php presto_blog_social_links(); ?>
            </div>
        </div>
        <?php  
    }
}
endif;

if ( ! function_exists( 'presto_blog_header_search' ) ) :
/**
 * Displays Header Search.
 */
function presto_blog_header_search(){
    $ed_header_search = get_theme_mod( 'ed_header_search', false );
    if( $ed_header_search ){ ?>
        <div class="header-search">
            <button class="search-toggle" data-toggle-target=".search-modal" data-toggle-body-class="showing-search-modal" data-set-focus=".search-modal .search-field" aria-expanded="false">
                <?php echo presto_blog_svg_collection( 'search-toggle' ); ?>
            </button>
            <div class="header-search-wrap search-modal cover-modal" data-modal-target-string=".search-modal">
                <div class="header-search-wrap-inner">
                    <?php get_search_form(); ?>
                    <div class="popular-search-cat">
                        <strong class="popular-search-cat-title"><?php esc_html_e( 'Browse Categories','presto-blog' ); ?></strong>
                        <?php $cats = get_categories(); 
                            if( $cats ){ ?>
                                <ul>
                                    <?php foreach( $cats as $cat ){ ?>
                                        <li>
                                            <a href="<?php echo esc_url( get_term_link( $cat->term_id ) ); ?>"><?php echo esc_html( $cat->name ); ?></a>
                                        </li>
                                    <?php } ?>
                                </ul>
                            <?php 
                            }
                        ?>
                    </div>
                    <button class="close" data-toggle-target=".search-modal" data-toggle-body-class="showing-search-modal" data-set-focus=".search-modal .search-field" aria-expanded="true"></button>
                </div>
            </div>
        </div>
        <?php 
    }
}
endif;

if ( ! function_exists( 'presto_blog_header_button' ) ) :
/**
 * Displays Header Button.
 */
function presto_blog_header_button(){
    $ed_header_btn       = get_theme_mod( 'ed_header_btn', false );
    $header_button_label = get_theme_mod( 'header_button_label', __( 'RSVP', 'presto-blog' ) );
    $header_button_url   = get_theme_mod( 'header_button_url', '#' );
    if( $ed_header_btn && ( $header_button_label || $header_button_url ) ){ ?>
        <div class="header-btn">
            <a href="<?php echo esc_url( $header_button_url ); ?>" class="btn"><?php echo esc_html( $header_button_label ); ?></a>
        </div>
        <?php 
    }
}
endif;

if( ! function_exists( 'presto_blog_mobile_header' ) ) :
/**
 * Mobile Header
 */
function presto_blog_mobile_header(){ ?>
    <header id="mblheader" class="mobile-header">
        <div class="container">
            <?php presto_blog_site_branding( true ); ?>
            <div class="mbl-header-utilities">
                <button class="toggle-button" aria-controls="mbl-primary-menu" data-toggle-target=".mbl-main-menu-modal" data-toggle-body-class="mbl-showing-main-menu-modal" aria-expanded="false" data-set-focus=".mbl-close-main-nav-toggle">
                    <span class="toggle-bar"></span>
                    <span class="toggle-bar"></span>
                    <span class="toggle-bar"></span>
                </button>
                <div class="mbl-primary-menu-list mbl-main-menu-modal cover-modal" data-modal-target-string=".mbl-main-menu-modal">
                    <button class="close mbl-close-main-nav-toggle" data-toggle-target=".mbl-main-menu-modal" data-toggle-body-class="mbl-showing-main-menu-modal" aria-expanded="false" data-set-focus=".mbl-main-menu-modal">
                        <span class="toggle-bar"></span>
                        <span class="toggle-text"><?php esc_html_e( 'Close', 'presto-blog' ); ?></span>
                    </button>
                    <div class="mobile-menu" aria-label="<?php esc_attr_e( 'Mobile', 'presto-blog' ); ?>">
                        <div class="mbl-main-menu-modal">
                            <?php
                                get_search_form();

                                wp_nav_menu(
                                    array(
                                        'theme_location' => 'primary',
                                        'menu_id'        => 'mbl-primary-menu',
                                        'fallback_cb'    => 'presto_blog_primary_menu_fallback',
                                        'menu_class'	 => 'menu'
                                    )
                                );                            
                            
                                presto_blog_secondary_navigation( true );

                                presto_blog_header_button();
                                
                                if( presto_blog_is_woocommerce_activated() ){
                                    presto_blog_header_woo_user();
                                    presto_blog_header_woo_cart();
                                }

                                presto_blog_header_social();
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <?php
}
endif;

if( ! function_exists( 'presto_blog_breadcrumb' ) ) :
/**
 * Breadcrumbs
*/
function presto_blog_breadcrumb(){ 
    global $post;
    $post_page  = get_option( 'page_for_posts' ); //The ID of the page that displays posts.
    $show_front = get_option( 'show_on_front' ); //What to show on the front page    
    $home       = get_theme_mod( 'home_text', __( 'Home', 'presto-blog' ) ); // text for the 'Home' link
    $delimiter  = '<span class="separator"></span>';
    $before     = '<span class="current" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">'; // tag before the current crumb
    $after      = '</span>'; // tag after the current crumb
    
    if( get_theme_mod( 'ed_breadcrumb', true ) && ! is_front_page() ){
        $depth = 1;
        echo '<div class="breadcrumb-wrapper"><div class="container"><div id="crumbs" itemscope itemtype="http://schema.org/BreadcrumbList">
                <span itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
                    <a href="' . esc_url( home_url() ) . '" itemprop="item"><span class="breadcrumb_home" itemprop="name">' . esc_html( $home ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" />' . $delimiter . '</span>';
        
        if( is_home() ){ 
            $depth = 2;                       
            echo $before . '<a itemprop="item" href="'. esc_url( get_the_permalink() ) .'"><span itemprop="name">' . esc_html( single_post_title( '', false ) ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" />' . $after;            
        }elseif( is_category() ){  
            $depth = 2;          
            $thisCat = get_category( get_query_var( 'cat' ), false );            
            if( $show_front === 'page' && $post_page ){ //If static blog post page is set
                $p = get_post( $post_page );
                echo '<span itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a href="' . esc_url( get_permalink( $post_page ) ) . '" itemprop="item"><span itemprop="name">' . esc_html( $p->post_title ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" />' . $delimiter . '</span>';
                $depth++;  
            }            
            if( $thisCat->parent != 0 ){
                $parent_categories = get_category_parents( $thisCat->parent, false, ',' );
                $parent_categories = explode( ',', $parent_categories );
                foreach( $parent_categories as $parent_term ){
                    $parent_obj = get_term_by( 'name', $parent_term, 'category' );
                    if( is_object( $parent_obj ) ){
                        $term_url  = get_term_link( $parent_obj->term_id );
                        $term_name = $parent_obj->name;
                        echo '<span itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="' . esc_url( $term_url ) . '"><span itemprop="name">' . esc_html( $term_name ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" />' . $delimiter . '</span>';
                        $depth++;
                    }
                }
            }
            echo $before . '<a itemprop="item" href="' . esc_url( get_term_link( $thisCat->term_id) ) . '"><span itemprop="name">' .  esc_html( single_cat_title( '', false ) ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" />' . $after;       
        }elseif( presto_blog_is_woocommerce_activated() && ( is_product_category() || is_product_tag() ) ){ //For Woocommerce archive page
            $depth = 2;
            $current_term = $GLOBALS['wp_query']->get_queried_object();            
            if( wc_get_page_id( 'shop' ) ){ //Displaying Shop link in woocommerce archive page
                $_name = wc_get_page_id( 'shop' ) ? get_the_title( wc_get_page_id( 'shop' ) ) : '';
                if ( ! $_name ) {
                    $product_post_type = get_post_type_object( 'product' );
                    $_name = $product_post_type->labels->singular_name;
                }
                echo '<span itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a href="' . esc_url( get_permalink( wc_get_page_id( 'shop' ) ) ) . '" itemprop="item"><span itemprop="name">' . esc_html( $_name ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" />' . $delimiter . '</span>';
                $depth++;
            }
            if( is_product_category() ){
                $ancestors = get_ancestors( $current_term->term_id, 'product_cat' );
                $ancestors = array_reverse( $ancestors );
                foreach ( $ancestors as $ancestor ) {
                    $ancestor = get_term( $ancestor, 'product_cat' );    
                    if ( ! is_wp_error( $ancestor ) && $ancestor ) {
                        echo '<span itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a href="' . esc_url( get_term_link( $ancestor ) ) . '" itemprop="item"><span itemprop="name">' . esc_html( $ancestor->name ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" />' . $delimiter . '</span>';
                        $depth++;
                    }
                }
            }
            echo $before . '<a itemprop="item" href="' . esc_url( get_term_link( $current_term->term_id ) ) . '"><span itemprop="name">' . esc_html( $current_term->name ) .'</span></a><meta itemprop="position" content="'. absint( $depth ).'" />' . $after;
        }elseif( presto_blog_is_woocommerce_activated() && is_shop() ){ //Shop Archive page
            $depth = 2;
            if( get_option( 'page_on_front' ) == wc_get_page_id( 'shop' ) ){
                return;
            }
            $_name    = wc_get_page_id( 'shop' ) ? get_the_title( wc_get_page_id( 'shop' ) ) : '';
            $shop_url = ( wc_get_page_id( 'shop' ) && wc_get_page_id( 'shop' ) > 0 )  ? get_the_permalink( wc_get_page_id( 'shop' ) ) : home_url( '/shop' );
            if( ! $_name ){
                $product_post_type = get_post_type_object( 'product' );
                $_name             = $product_post_type->labels->singular_name;
            }
            echo $before . '<a itemprop="item" href="' . esc_url( $shop_url ) . '"><span itemprop="name">' . esc_html( $_name ) . '</span></a><meta itemprop="position" content="' . absint( $depth ) . '" />' . $after;
        }elseif( is_tag() ){ 
            $depth          = 2;
            $queried_object = get_queried_object();
            echo $before . '<a itemprop="item" href="' . esc_url( get_term_link( $queried_object->term_id ) ) . '"><span itemprop="name">' . esc_html( single_tag_title( '', false ) ) . '</span></a><meta itemprop="position" content="' . absint( $depth ). '" />'. $after;
        }elseif( is_author() ){  
            global $author;
            $depth    = 2;
            $userdata = get_userdata( $author );
            echo $before . '<a itemprop="item" href="' . esc_url( get_author_posts_url( $author ) ) . '"><span itemprop="name">' . esc_html( $userdata->display_name ) .'</span></a><meta itemprop="position" content="' . absint( $depth ) . '" />' . $after;     
        }elseif( is_search() ){ 
            $depth       = 2;
            $request_uri = $_SERVER['REQUEST_URI'];
            echo $before . '<a itemprop="item" href="'. esc_url( $request_uri ) . '"><span itemprop="name">' . sprintf( __( 'Search Results for "%s"', 'presto-blog' ), esc_html( get_search_query() ) ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" />' . $after;        
        }elseif( is_day() ){            
            $depth = 2;
            echo '<span itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a href="' . esc_url( get_year_link( get_the_time( __( 'Y', 'presto-blog' ) ) ) ) . '" itemprop="item"><span itemprop="name">' . esc_html( get_the_time( __( 'Y', 'presto-blog' ) ) ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" />' . $delimiter . '</span>';
            $depth++;
            echo '<span itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a href="' . esc_url( get_month_link( get_the_time( __( 'Y', 'presto-blog' ) ), get_the_time( __( 'm', 'presto-blog' ) ) ) ) . '" itemprop="item"><span itemprop="name">' . esc_html( get_the_time( __( 'F', 'presto-blog' ) ) ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" />' . $delimiter . '</span>';
            $depth++;
            echo $before . '<a itemprop="item" href="' . esc_url( get_day_link( get_the_time( __( 'Y', 'presto-blog' ) ), get_the_time( __( 'm', 'presto-blog' ) ), get_the_time( __( 'd', 'presto-blog' ) ) ) ) . '"><span itemprop="name">' . esc_html( get_the_time( __( 'd', 'presto-blog' ) ) ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" />' . $after;        
        }elseif( is_month() ){            
            $depth = 2;
            echo '<span itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a href="' . esc_url( get_year_link( get_the_time( __( 'Y', 'presto-blog' ) ) ) ) . '" itemprop="item"><span itemprop="name">' . esc_html( get_the_time( __( 'Y', 'presto-blog' ) ) ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" />' . $delimiter . '</span>';
            $depth++;
            echo $before . '<a itemprop="item" href="' . esc_url( get_month_link( get_the_time( __( 'Y', 'presto-blog' ) ), get_the_time( __( 'm', 'presto-blog' ) ) ) ) . '"><span itemprop="name">' . esc_html( get_the_time( __( 'F', 'presto-blog' ) ) ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" />' . $after;        
        }elseif( is_year() ){ 
            $depth = 2;
            echo $before .'<a itemprop="item" href="' . esc_url( get_year_link( get_the_time( __( 'Y', 'presto-blog' ) ) ) ) . '"><span itemprop="name">'. esc_html( get_the_time( __( 'Y', 'presto-blog' ) ) ) .'</span></a><meta itemprop="position" content="'. absint( $depth ).'" />'. $after;  
        }elseif( is_single() && !is_attachment() ){   
            $depth = 2;         
            if( presto_blog_is_woocommerce_activated() && 'product' === get_post_type() ){ //For Woocommerce single product
                if( wc_get_page_id( 'shop' ) ){ //Displaying Shop link in woocommerce archive page
                    $_name = wc_get_page_id( 'shop' ) ? get_the_title( wc_get_page_id( 'shop' ) ) : '';
                    if ( ! $_name ) {
                        $product_post_type = get_post_type_object( 'product' );
                        $_name = $product_post_type->labels->singular_name;
                    }
                    echo '<span itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a href="' . esc_url( get_permalink( wc_get_page_id( 'shop' ) ) ) . '" itemprop="item"><span itemprop="name">' . esc_html( $_name ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" />' . $delimiter . '</span>';
                    $depth++;                    
                }           
                if( $terms = wc_get_product_terms( $post->ID, 'product_cat', array( 'orderby' => 'parent', 'order' => 'DESC' ) ) ){
                    $main_term = apply_filters( 'woocommerce_breadcrumb_main_term', $terms[0], $terms );
                    $ancestors = get_ancestors( $main_term->term_id, 'product_cat' );
                    $ancestors = array_reverse( $ancestors );
                    foreach ( $ancestors as $ancestor ) {
                        $ancestor = get_term( $ancestor, 'product_cat' );    
                        if ( ! is_wp_error( $ancestor ) && $ancestor ) {
                            echo '<span itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a href="' . esc_url( get_term_link( $ancestor ) ) . '" itemprop="item"><span itemprop="name">' . esc_html( $ancestor->name ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" />' . $delimiter . '</span>';
                            $depth++;
                        }
                    }
                    echo '<span itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a href="' . esc_url( get_term_link( $main_term ) ) . '" itemprop="item"><span itemprop="name">' . esc_html( $main_term->name ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" />' . $delimiter . '</span>';
                    $depth++;
                }
                echo $before . '<a href="' . esc_url( get_the_permalink() ) . '" itemprop="item"><span itemprop="name">' . esc_html( get_the_title() ) .'</span></a><meta itemprop="position" content="'. absint( $depth ).'" />' . $after;
            }elseif( get_post_type() != 'post' ){                
                $post_type = get_post_type_object( get_post_type() );                
                if( $post_type->has_archive == true ){// For CPT Archive Link                   
                    // Add support for a non-standard label of 'archive_title' (special use case).
                    $label = !empty( $post_type->labels->archive_title ) ? $post_type->labels->archive_title : $post_type->labels->name;
                    echo '<span itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a href="' . esc_url( get_post_type_archive_link( get_post_type() ) ) . '" itemprop="item"><span itemprop="name">' . esc_html( $label ) . '</span></a><meta itemprop="position" content="' . absint( $depth ) . '" />' . $delimiter . '</span>';
                    $depth++;    
                }
                echo $before . '<a href="' . esc_url( get_the_permalink() ) . '" itemprop="item"><span itemprop="name">' . esc_html( get_the_title() ) . '</span></a><meta itemprop="position" content="' . absint( $depth ) . '" />' . $after;
            }else{ //For Post                
                $cat_object       = get_the_category();
                $potential_parent = 0;
                
                if( $show_front === 'page' && $post_page ){ //If static blog post page is set
                    $p = get_post( $post_page );
                    echo '<span itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a href="' . esc_url( get_permalink( $post_page ) ) . '" itemprop="item"><span itemprop="name">' . esc_html( $p->post_title ) . '</span></a><meta itemprop="position" content="' . absint( $depth ) . '" />' . $delimiter . '</span>';  
                    $depth++; 
                }
                
                if( $cat_object ){ //Getting category hierarchy if any        
                    //Now try to find the deepest term of those that we know of
                    $use_term = key( $cat_object );
                    foreach( $cat_object as $key => $object ){
                        //Can't use the next($cat_object) trick since order is unknown
                        if( $object->parent > 0  && ( $potential_parent === 0 || $object->parent === $potential_parent ) ){
                            $use_term         = $key;
                            $potential_parent = $object->term_id;
                        }
                    }                    
                    $cat  = $cat_object[$use_term];              
                    $cats = get_category_parents( $cat, false, ',' );
                    $cats = explode( ',', $cats );
                    foreach ( $cats as $cat ) {
                        $cat_obj = get_term_by( 'name', $cat, 'category' );
                        if( is_object( $cat_obj ) ){
                            $term_url  = get_term_link( $cat_obj->term_id );
                            $term_name = $cat_obj->name;
                            echo '<span itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="' . esc_url( $term_url ) . '"><span itemprop="name">' . esc_html( $term_name ) . '</span></a><meta itemprop="position" content="' . absint( $depth ). '" />' . $delimiter . '</span>';
                            $depth++;
                        }
                    }
                }
                echo $before . '<a itemprop="item" href="' . esc_url( get_the_permalink() ) . '"><span itemprop="name">' . esc_html( get_the_title() ) . '</span></a><meta itemprop="position" content="' . absint( $depth ) . '" />' . $after;   
            }        
        }elseif( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ){ //For Custom Post Archive
            $depth     = 2;
            $post_type = get_post_type_object( get_post_type() );
            if( get_query_var('paged') ){
                echo '<span itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a href="' . esc_url( get_post_type_archive_link( $post_type->name ) ) . '" itemprop="item"><span itemprop="name">' . esc_html( $post_type->label ) . '</span></a><meta itemprop="position" content="' . absint( $depth ) . '" />' . $delimiter . '/</span>';
                echo $before . sprintf( __('Page %s', 'presto-blog'), get_query_var('paged') ) . $after; //@todo need to check this
            }else{
                echo $before . '<a itemprop="item" href="' . esc_url( get_post_type_archive_link( $post_type->name ) ) . '"><span itemprop="name">' . esc_html( $post_type->label ) . '</span></a><meta itemprop="position" content="' . absint( $depth ). '" />' . $after;
            }    
        }elseif( is_attachment() ){ 
            $depth = 2;           
            echo $before . '<a itemprop="item" href="' . esc_url( get_the_permalink() ) . '"><span itemprop="name">' . esc_html( get_the_title() ) . '</span></a><meta itemprop="position" content="' . absint( $depth ) . '" />' . $after;
        }elseif( is_page() && !$post->post_parent ){            
            $depth = 2;
            echo $before . '<a itemprop="item" href="' . esc_url( get_the_permalink() ) . '"><span itemprop="name">' . esc_html( get_the_title() ) . '</span></a><meta itemprop="position" content="' . absint( $depth ) . '" />' . $after;
        }elseif( is_page() && $post->post_parent ){            
            $depth       = 2;
            $parent_id   = $post->post_parent;
            $breadcrumbs = array();
            while( $parent_id ){
                $current_page  = get_post( $parent_id );
                $breadcrumbs[] = $current_page->ID;
                $parent_id     = $current_page->post_parent;
            }
            $breadcrumbs = array_reverse( $breadcrumbs );
            for ( $i = 0; $i < count( $breadcrumbs) ; $i++ ){
                echo '<span itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a href="' . esc_url( get_permalink( $breadcrumbs[$i] ) ) . '" itemprop="item"><span itemprop="name">' . esc_html( get_the_title( $breadcrumbs[$i] ) ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" />' . $delimiter . '</span>';
                $depth++;
            }
            echo $before . '<a href="' . get_permalink() . '" itemprop="item"><span itemprop="name">' . esc_html( get_the_title() ) . '</span></a><meta itemprop="position" content="' . absint( $depth ) . '" /></span>' . $after;
        }elseif( is_404() ){
            $depth = 2;
            echo $before . '<a itemprop="item" href="' . esc_url( home_url() ) . '"><span itemprop="name">' . esc_html__( '404 Error - Page Not Found', 'presto-blog' ) . '</span></a><meta itemprop="position" content="' . absint( $depth ). '" />' . $after;
        }
        
        if( get_query_var('paged') ) printf( __( ' (Page %s)', 'presto-blog' ), get_query_var('paged') );
        
        echo '</div></div></div><!-- .breadcrumb-wrapper -->';
        
    }                
}
endif;

if ( ! function_exists( 'presto_blog_content_header' ) ) :
/**
 * Section Displays after header section
 */
function presto_blog_content_header(){
    if( is_404() || is_home() || ( presto_blog_is_woocommerce_activated() && ( is_cart() || is_singular( 'product' ) ) ) ) return;

    if( is_single() ){
        $class = 'entry-header';
    }else{
        $class = 'page-header';
    }
    ?>
    <header class="<?php echo esc_attr( $class ); ?>">        
        <?php 
            if( is_single() ){ ?>                
                <div class="container">
                    <?php
                        presto_blog_category();                        
                        the_title( '<h1 class="entry-title">','</h1>' ); 
                    ?>
                    <div class="entry-meta">
                        <?php 
                            presto_blog_posted_by();
                            presto_blog_posted_on();                            
                        ?>
                    </div>
                </div>
                <?php                
                presto_blog_post_thumbnail();
            }

            if( is_page() ){ ?>
                <div class="container">
                    <?php 
                        the_title( '<h1 class="page-title">', '</h1>' );
                        presto_blog_post_thumbnail();
                    ?>
                </div>
                <?php
            }
            
            if( is_search() ){ ?>
                <div class="container">
                    <span class="sub-title"><?php esc_html_e( 'Search Results For','presto-blog' ); ?></span>
                    <h1 class="page-title"><?php echo esc_html( get_search_query() ); ?></h1>
                </div>
                <?php 
            }  
            
            if( is_archive() ){
                echo '<div class="container">';
                if( presto_blog_is_woocommerce_activated() && is_shop() ){
                    $thumb = wp_get_attachment_image_url( get_post_thumbnail_id( wc_get_page_id( 'shop' ) ), 'presto-blog-full' ); ?>
                    <div class="woo-postthumbnail" style="background-image: url('<?php echo esc_url( $thumb ); ?>')">
                        <div class="container">
                            <?php 
                                the_archive_title();
                                the_archive_description( '<p class="page-desc">', '</p>' );
                            ?>
                        </div>
                    </div>
                    <?php 
                }else{
                    the_archive_title();
                    the_archive_description( '<div class="archive-description">', '</div>' );
                }
                echo '</div>';
            }
        ?>
    </header>
    <?php 
}
endif;

if ( ! function_exists( 'presto_blog_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time.
 */
function presto_blog_posted_on() {
    if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {			
        $time_string = '<time class="entry-date published" datetime="%1$s" itemprop="datePublished">%2$s</time><time class="updated" datetime="%3$s" itemprop="dateModified">%4$s</time>';
    }else{
        $time_string = '<time class="entry-date published updated" datetime="%1$s" itemprop="datePublished">%2$s</time>';
    }

    $time_string = sprintf( $time_string,
        esc_attr( get_the_date( 'c' ) ),
        esc_html( get_the_date() ),
        esc_attr( get_the_modified_date( 'c' ) ),
        esc_html( get_the_modified_date() )
    );
    
    $posted_on = sprintf( '%1$s','<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>' );
    
    echo '<span class="posted-on">' . $posted_on . '</span>'; // WPCS: XSS OK.

}
endif;

if ( ! function_exists( 'presto_blog_posted_by' ) ) :
/**
 * Prints HTML with meta information for the current author.
 */
function presto_blog_posted_by() {
    global $post;
    
    $byline = sprintf(
        /* translators: %s: post author. */
        esc_html_x( 'By %s', 'post author', 'presto-blog' ),
        '<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID', $post->post_author ) ) ) . '">' . esc_html( get_the_author_meta('display_name', $post->post_author ) ) . '</a></span>'
    );
    ?>
    <span class="byline" <?php presto_blog_microdata( 'person' ); ?>>
        <?php echo $byline; ?>
    </span>
    <?php 
}
endif;

if ( ! function_exists( 'presto_blog_category' ) ) :
/**
 * Category
 */
function presto_blog_category( $post_id = false ) {
    if ( 'post' === get_post_type() ) {
        $categories_list = get_the_category_list( ' ', '', $post_id );
        if ( $categories_list ) {
            echo '<span class="category">' . $categories_list . '</span>';
        }
    }	
}
endif;

if ( ! function_exists( 'presto_blog_tag' ) ) :
/**
 * Prints tags
 */
function presto_blog_tag(){
    $tags_list = get_the_tag_list( '', ' ' );
    if( $tags_list ){
        echo '<span class="post-tags" itemprop="about">' . $tags_list . '</span>';
    }
}
endif;

if ( ! function_exists( 'presto_blog_post_thumbnail' ) ) :
/**
 * Displays an optional post thumbnail.
 *
 * Wraps the post thumbnail in an anchor element on index views, or a div
 * element when on single views.
 */
function presto_blog_post_thumbnail() {
    if ( post_password_required() || is_attachment() ) {
        return;
    }
    
    if( is_singular() ){ 
        if( is_single() ){
            if( has_post_thumbnail() ){
                echo '<figure class="post-thumbnail">';
                echo '<div class="container">';
                the_post_thumbnail( 'presto-blog-full', array( 'itemprop' => 'image' ) );                
                echo '</div>';
                echo '</figure>';
            }
        }else{
            if( has_post_thumbnail() ){
                echo '<figure class="post-thumbnail">';
                the_post_thumbnail( 'presto-blog-full', array( 'itemprop' => 'image' ) );
                echo '</figure>';
            }
        }
    }elseif( is_home() || is_archive() || is_search() || is_author() ){
        echo '<figure class="post-thumbnail"><a href="' . esc_url( get_permalink() ) . '">';
        if( has_post_thumbnail() ){   
            the_post_thumbnail( 'full', array( 'itemprop' => 'image' ) );
        }else{
            presto_blog_get_fallback_svg( 'thumbnail' );
        }        
        echo '</a></figure>';
    }else{ ?>
        <figure class="post-thumbnail">
            <a href="<?php the_permalink(); ?>">
                <?php the_post_thumbnail( 'full', array( 'itemprop' => 'image' ) ); ?>
            </a>
        </figure><!-- .post-thumbnail -->
        <?php
    }
}
endif;

if( ! function_exists( 'presto_blog_get_microdata' ) ) :
/**
 * Microdata Schema
 * 
 * @param string $context The element to target
 * @return string final attribute
 */
function presto_blog_get_microdata( $context ){
    $data = false;

    if( 'head' === $context ){
        $data = 'itemtype="http://schema.org/WebSite" itemscope';
    }

    if ( 'body' === $context ) {
        $type = 'WebPage';

        if ( is_home() || is_archive() || is_attachment() || is_tax() || is_single() ) {
            $type = 'Blog';
        }

        if ( is_search() ) {
            $type = 'SearchResultsPage';
        }

        $data = sprintf(
            'itemtype="https://schema.org/%s" itemscope',
            esc_html( $type )
        );
    }

    if ( 'header' === $context ) {
        $data = 'itemtype="https://schema.org/WPHeader" itemscope';
    }

    if ( 'navigation' === $context ) {
        $data = 'itemtype="https://schema.org/SiteNavigationElement" itemscope';
    }

    if ( 'organization' === $context ) {
        $data = 'itemtype="https://schema.org/Organization" itemscope';
    }
    
    if ( 'person' === $context ) {
        $data = 'itemtype="https://schema.org/Person" itemscope';
    }

    if ( 'article' === $context ) {        
        $data = 'itemtype="https://schema.org/CreativeWork" itemscope';
    }

    if ( 'post-author' === $context ) {
        $data = 'itemprop="author" itemtype="https://schema.org/Person" itemscope';
    }

    if ( 'comment-body' === $context ) {
        $data = 'itemtype="https://schema.org/UserComments" itemscope';
    }

    if ( 'comment-author' === $context ) {
        $data = 'itemprop="creator" itemtype="https://schema.org/Person" itemscope';
    }

    if ( 'sidebar' === $context ) {
        $data = 'itemtype="https://schema.org/WPSideBar" itemscope';
    }

    if ( 'footer' === $context ) {
        $data = 'itemtype="https://schema.org/WPFooter" itemscope';
    }

    if ( $data ) {
        return $data;
    }
}
endif;
    
if( ! function_exists( 'presto_blog_microdata' ) ) :
/**
 * Output our microdata for an element.
 *
 * @param $context The element to target.
 * @return string The microdata.
 */
function presto_blog_microdata( $context ) {
    echo presto_blog_get_microdata( $context ); // WPCS: XSS ok, sanitization ok.
}
endif;
    
if( ! function_exists( 'presto_blog_social_links' ) ) :
/**
 * Social Links 
*/
function presto_blog_social_links(){
    $social_links = get_theme_mod( 'social_icons_links' );        
    if( $social_links ){ ?>
        <ul class="social-list">
            <?php 
                foreach( $social_links as $link ){
                    $new_tab = $link['checkbox'] ? '_blank' : '_self';
                    if( $link['link'] ){ ?>
                        <li>
                            <a href="<?php echo esc_url( $link['link'] ); ?>" target="<?php echo esc_attr( $new_tab ); ?>" rel="nofollow noopener">
                                <?php echo wp_kses( presto_blog_social_icons_svg_list( $link['icon'] ), presto_blog_get_kses_extended_ruleset() ); ?>
                                <span class="social-name"><?php echo esc_html( ucfirst( str_replace( '_', ' ', $link['icon'] ) ) );?></span>
                            </a>
                        </li>    	   
                        <?php
                    } 
                }
            ?>
        </ul>
        <?php    
    }                                    
}
endif;

if( ! function_exists( 'presto_blog_get_image_sizes' ) ) :
/**
 * Get information about available image sizes
 */
function presto_blog_get_image_sizes( $size = '' ) {
    
    global $_wp_additional_image_sizes;
    
    $sizes = array();
    $get_intermediate_image_sizes = get_intermediate_image_sizes();
    
    // Create the full array with sizes and crop info
    foreach( $get_intermediate_image_sizes as $_size ) {
        if ( in_array( $_size, array( 'thumbnail', 'medium', 'medium_large', 'large' ) ) ) {
            $sizes[ $_size ]['width'] = get_option( $_size . '_size_w' );
            $sizes[ $_size ]['height'] = get_option( $_size . '_size_h' );
            $sizes[ $_size ]['crop'] = (bool) get_option( $_size . '_crop' );
        } elseif ( isset( $_wp_additional_image_sizes[ $_size ] ) ) {
            $sizes[ $_size ] = array( 
                'width' => $_wp_additional_image_sizes[ $_size ]['width'],
                'height' => $_wp_additional_image_sizes[ $_size ]['height'],
                'crop' =>  $_wp_additional_image_sizes[ $_size ]['crop']
            );
        }
    } 
    // Get only 1 size if found
    if ( $size ) {
        if( isset( $sizes[ $size ] ) ) {
            return $sizes[ $size ];
        } else {
            return false;
        }
    }
    return $sizes;
}
endif;
	
if ( ! function_exists( 'presto_blog_get_fallback_svg' ) ) :    
/**
 * Get Fallback SVG
*/
function presto_blog_get_fallback_svg( $post_thumbnail ) {
    if( ! $post_thumbnail ){
        return;
    }
    
    $image_size = presto_blog_get_image_sizes( $post_thumbnail );
        
    if( $image_size ){ ?>
        <div class="svg-holder">
            <svg class="fallback-svg" viewBox="0 0 <?php echo esc_attr( $image_size['width'] ); ?> <?php echo esc_attr( $image_size['height'] ); ?>" preserveAspectRatio="none">
                <rect width="<?php echo esc_attr( $image_size['width'] ); ?>" height="<?php echo esc_attr( $image_size['height'] ); ?>" style="fill:#b2b2b2;"></rect>
            </svg>
            <span class="fallback-text">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" preserveAspectRatio="xMidYMid" width="943" height="145" viewBox="0 0 943 145"><defs><style>.cls-1{filter:url(#drop-shadow-1);}.cls-1,.cls-2{font-size: 156.781px;}.cls-2{fill: #fff;text-anchor: middle;font-family: "Myriad Pro";}</style><filter id="drop-shadow-1" filterUnits="userSpaceOnUse"><feOffset dy="1" in="SourceAlpha"/><feGaussianBlur stdDeviation="1.732" result="dropBlur"/><feFlood flood-opacity="0.2"/><feComposite operator="in" in2="dropBlur" result="dropShadowComp"/><feComposite in="SourceGraphic" result="shadowed"/></filter></defs><text x="468" y="108" class="cls-1"><tspan x="466" class="cls-2"><?php esc_html_e( 'Feature Image', 'presto-blog' ); ?></tspan></text></svg>
            </span>
        </div>
        <?php
    }
}
endif;

if ( ! function_exists( 'presto_blog_svg_collection' ) ) :    
/**
 * Get SVG Image
*/
function presto_blog_svg_collection( $svg_name ){

    if( !$svg_name ){
        return;
    }
    switch ( $svg_name ) {

        case 'sublime': 
            return '<svg width="186" height="79" viewBox="0 0 186 79" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M115.394 19.9443C112.123 1.3906 106.825 -2.17493 88.4353 1.0651H88.4368C70.0481 4.30963 66.289 9.46818 69.5606 28.0264C72.8336 46.5845 77.6997 50.2206 96.5188 46.904C115.337 43.5845 118.665 38.4965 115.394 19.9443ZM88.3797 30.1352L85.9642 34.319C85.7943 34.691 85.7107 35.1049 85.7327 35.5266C85.7414 35.694 85.7663 35.8622 85.8095 36.0304C86.0295 36.8879 86.6626 37.5202 87.439 37.7725C87.8862 37.9184 88.3823 37.938 88.8749 37.8002L99.1082 34.946C102.607 33.9695 104.71 30.3264 103.807 26.808C102.903 23.2898 99.3344 21.2294 95.8359 22.2061L89.5008 23.9741C87.6162 24.4993 85.6949 23.3901 85.2083 21.4958C84.7223 19.6014 85.855 17.6395 87.7382 17.114L96.7904 14.5874L95.3446 17.0916L88.2414 19.0742C87.4338 19.2996 86.9487 20.1398 87.1573 20.9519C87.366 21.764 88.1889 22.2391 88.9969 22.014L96.3056 19.9743C96.936 19.7983 97.4478 19.3979 97.7792 18.8827L100.073 14.9097C100.279 14.5098 100.382 14.0559 100.358 13.592C100.349 13.4246 100.325 13.2564 100.281 13.0882C100.062 12.2336 99.4334 11.603 98.6602 11.3488C98.2101 11.2007 97.711 11.1799 97.2159 11.3184L86.9828 14.1732C83.4841 15.1493 81.3807 18.7924 82.2845 22.3108C83.1883 25.8292 86.7568 27.8894 90.2557 26.913L96.5908 25.145C98.475 24.6195 100.397 25.729 100.883 27.623C101.369 29.5176 100.237 31.4795 98.353 32.0049L89.3129 34.5278L90.7584 32.0239L97.8489 30.0451C98.6565 29.8198 99.1419 28.9792 98.9332 28.1671C98.7246 27.355 97.9017 26.8799 97.0937 27.105L89.7847 29.1451C89.1966 29.3093 88.7116 29.6687 88.3797 30.1352Z" fill="#212327"/><path d="M7.82993 78.9992C11.4048 78.9992 15.3101 77.2591 15.25 73.2185C15.25 66.3466 4.01476 68.6176 4.0448 64.5475C4.01476 63.1613 5.33655 61.9521 7.70976 61.9521C9.78257 61.9521 10.9241 62.365 12.4562 63.1613C12.6965 63.2793 12.9669 63.3678 13.2072 63.3678C13.9883 63.3678 14.7393 62.7189 14.7393 61.8931C14.7693 61.2737 14.3788 60.8314 13.9883 60.5954C12.6064 59.6811 9.96282 58.7373 7.70976 58.7373C3.8946 58.7373 0.5 60.7134 0.5 64.695C0.5 71.9208 11.7352 69.6498 11.7352 73.4544C11.7352 74.8996 10.083 75.9024 7.67973 75.8434C5.8172 75.8139 4.46537 75.1945 3.20366 74.5752C2.9333 74.4277 2.60285 74.3687 2.45264 74.3687C1.61151 74.3687 0.800407 75.0471 0.770366 76.0204C0.740325 76.6102 1.10081 77.0821 1.58146 77.4065C2.90325 78.2618 5.36659 79.0287 7.82993 78.9992Z" fill="black"/><path d="M28.4151 64.5475C27.4538 64.5475 26.7028 65.3143 26.7028 66.2286V72.5402C26.7028 74.5162 25.2308 75.9319 23.3682 75.9319C21.6259 75.9319 20.1238 74.7227 20.1238 72.6876V66.2286C20.1238 65.2848 19.3728 64.5475 18.4416 64.5475C17.5103 64.5475 16.7292 65.3143 16.7292 66.2286V73.189C16.7292 76.8757 19.0123 78.9992 22.2567 78.9992C24.1793 78.9992 25.7114 78.2913 26.7028 77.0526V77.1706C26.7028 78.0849 27.4538 78.8222 28.4151 78.8222C29.3463 78.8222 30.0974 78.0849 30.0974 77.1706V66.2286C30.0974 65.3143 29.3463 64.5475 28.4151 64.5475Z" fill="black"/><path d="M40.2382 64.3705C38.4658 64.3705 36.8736 65.0784 35.702 66.2876V59.7106C35.702 58.7668 34.921 58 33.9897 58C33.0284 58 32.2474 58.7668 32.2474 59.7106V77.1411C32.2474 78.0849 33.0284 78.8222 33.9897 78.8222C34.921 78.8222 35.702 78.0849 35.702 77.1411V77.1116C36.8736 78.3208 38.4658 78.9992 40.2382 78.9992C43.8731 78.9992 46.8471 75.9614 46.8471 71.6849C46.8471 67.4083 43.8731 64.3705 40.2382 64.3705ZM39.4571 75.9319C37.3242 75.9319 35.5819 74.1623 35.5819 71.6849C35.5819 69.2074 37.3242 67.4378 39.4571 67.4378C41.59 67.4378 43.3324 69.2074 43.3324 71.6849C43.3324 74.1623 41.59 75.9319 39.4571 75.9319Z" fill="black"/><path d="M50.4717 78.8222C51.403 78.8222 52.1841 78.0849 52.1841 77.1411V59.7106C52.1841 58.7668 51.403 58 50.4717 58C49.5104 58 48.7294 58.7668 48.7294 59.7106V77.1411C48.7294 78.0849 49.5104 78.8222 50.4717 78.8222Z" fill="black"/><path d="M56.3339 62.9549C57.4154 62.9549 58.3166 62.1291 58.3166 60.9493C58.3166 59.7991 57.4154 58.9733 56.3339 58.9733C55.2224 58.9733 54.3212 59.7991 54.3212 60.9493C54.3212 62.1291 55.2224 62.9549 56.3339 62.9549ZM56.3339 78.8222C57.2652 78.8222 58.0462 78.0849 58.0462 77.1411V66.2286C58.0462 65.3143 57.2652 64.5475 56.3339 64.5475C55.3726 64.5475 54.6216 65.3143 54.6216 66.2286V77.1411C54.6216 78.0849 55.3726 78.8222 56.3339 78.8222Z" fill="black"/><path d="M78.1441 64.3705C75.831 64.3705 74.0286 65.3438 72.9771 66.8775C72.0459 65.2553 70.3636 64.3705 68.2608 64.3705C66.3382 64.3705 64.8361 65.1079 63.8147 66.3466V66.1991C63.8147 65.2848 63.0637 64.5475 62.1325 64.5475C61.2012 64.5475 60.4201 65.2848 60.4201 66.1991V77.1706C60.4201 78.0849 61.2012 78.8222 62.1325 78.8222C63.0637 78.8222 63.8147 78.0849 63.8147 77.1706V70.859C63.8147 68.883 65.2867 67.4378 67.1493 67.4378C68.8916 67.4378 70.3937 68.6765 70.3937 70.7116V77.1706C70.3937 78.0849 71.1447 78.8222 72.106 78.8222C73.0372 78.8222 73.7882 78.0849 73.7882 77.1706V70.859C73.7882 68.883 75.2602 67.4378 77.1228 67.4378C78.8651 67.4378 80.3672 68.6765 80.3672 70.7116V77.1706C80.3672 78.0849 81.1182 78.8222 82.0795 78.8222C83.0107 78.8222 83.7618 78.0849 83.7618 77.1706V70.2102C83.7317 66.4056 81.4486 64.3705 78.1441 64.3705Z" fill="black"/><path d="M92.5182 78.9697C94.1103 78.9402 95.5823 78.5863 97.0843 77.9669C97.6551 77.731 98.0757 77.1706 98.0757 76.5217C98.0757 75.6664 97.3847 74.9881 96.5136 74.9881C96.3033 74.9881 96.093 75.0176 95.9127 75.1061C94.7712 75.6075 93.6897 75.9024 92.5182 75.9024C90.6556 75.9024 89.424 74.8406 89.0034 73.2185H97.595C98.4061 73.2185 99.037 72.5697 99.037 71.8028C99.067 67.6738 96.2732 64.3705 92.2478 64.3705C88.4927 64.3705 85.4286 67.4673 85.4286 71.7733C85.4286 76.0204 88.3425 78.9992 92.5182 78.9697ZM89.0034 70.3577C89.2738 68.6176 90.7458 67.4673 92.2478 67.4673C93.7198 67.4673 95.1617 68.6471 95.4021 70.3577H89.0034Z" fill="black"/><path d="M113.424 58.8848C113.644 58.8848 113.825 58.9634 113.965 59.1207C114.125 59.2584 114.205 59.4353 114.205 59.6516C114.205 59.8482 114.125 60.0252 113.965 60.1825C113.825 60.3398 113.644 60.4184 113.424 60.4184H107.837V77.9964C107.837 78.2127 107.746 78.4093 107.566 78.5863C107.406 78.7436 107.216 78.8222 106.995 78.8222C106.775 78.8222 106.575 78.7436 106.395 78.5863C106.234 78.4093 106.154 78.2127 106.154 77.9964V60.4184H100.567C100.366 60.4184 100.186 60.3398 100.026 60.1825C99.8658 60.0252 99.7857 59.8482 99.7857 59.6516C99.7857 59.4353 99.8658 59.2584 100.026 59.1207C100.186 58.9634 100.366 58.8848 100.567 58.8848H113.424Z" fill="black"/><path d="M122.438 64.1346C123.519 64.1346 124.51 64.3804 125.412 64.8719C126.333 65.3635 127.054 66.0811 127.574 67.0249C128.115 67.949 128.386 69.0403 128.386 70.2987V78.0259C128.386 78.2422 128.305 78.429 128.145 78.5863C127.985 78.7436 127.795 78.8222 127.574 78.8222C127.354 78.8222 127.164 78.7436 127.004 78.5863C126.843 78.429 126.763 78.2422 126.763 78.0259V70.2692C126.763 68.8142 126.323 67.6738 125.442 66.848C124.56 66.0222 123.469 65.6093 122.167 65.6093C121.266 65.6093 120.455 65.8157 119.734 66.2286C119.013 66.6415 118.442 67.2215 118.022 67.9687C117.601 68.6962 117.391 69.522 117.391 70.4461V78.0259C117.391 78.2422 117.311 78.429 117.15 78.5863C116.99 78.7436 116.8 78.8222 116.58 78.8222C116.359 78.8222 116.169 78.7436 116.009 78.5863C115.849 78.429 115.768 78.2422 115.768 78.0259V58.7963C115.768 58.58 115.849 58.3932 116.009 58.2359C116.169 58.0786 116.359 58 116.58 58C116.8 58 116.99 58.0786 117.15 58.2359C117.311 58.3932 117.391 58.58 117.391 58.7963V66.7595C117.931 65.9337 118.642 65.2947 119.524 64.8424C120.405 64.3705 121.376 64.1346 122.438 64.1346Z" fill="black"/><path d="M137.328 78.9992C136.046 78.9992 134.874 78.6748 133.813 78.0259C132.771 77.3574 131.94 76.4628 131.319 75.342C130.719 74.2016 130.418 72.9432 130.418 71.5669C130.418 70.1512 130.719 68.883 131.319 67.7623C131.94 66.6219 132.771 65.7371 133.813 65.1079C134.854 64.459 136.006 64.1346 137.268 64.1346C138.609 64.1346 139.801 64.4787 140.842 65.1669C141.904 65.855 142.715 66.7988 143.276 67.9982C143.856 69.1779 144.137 70.4756 144.117 71.8913C144.117 72.0879 144.047 72.2649 143.906 72.4222C143.766 72.5598 143.586 72.6286 143.366 72.6286H132.161C132.381 74.064 132.972 75.2437 133.933 76.1678C134.894 77.0723 136.036 77.5245 137.358 77.5245C138.279 77.5245 139.1 77.3869 139.821 77.1116C140.542 76.8363 141.363 76.4333 142.284 75.9024C142.384 75.8237 142.515 75.7844 142.675 75.7844C142.895 75.7844 143.075 75.8631 143.216 76.0204C143.376 76.158 143.456 76.3251 143.456 76.5217C143.456 76.797 143.326 77.0133 143.065 77.1706C142.044 77.7605 141.093 78.2127 140.211 78.5273C139.35 78.8419 138.389 78.9992 137.328 78.9992ZM142.434 71.154C142.374 70.0922 142.104 69.1386 141.623 68.2931C141.163 67.4477 140.542 66.789 139.761 66.3171C139 65.8452 138.169 65.6093 137.268 65.6093C136.366 65.6093 135.525 65.8452 134.744 66.3171C133.983 66.789 133.362 67.4477 132.882 68.2931C132.421 69.1386 132.161 70.0922 132.101 71.154H142.434Z" fill="black"/><path d="M163.811 64.1346C164.892 64.1346 165.883 64.3804 166.785 64.8719C167.706 65.3635 168.427 66.0811 168.948 67.0249C169.488 67.949 169.759 69.0403 169.759 70.2987V78.0259C169.759 78.2422 169.679 78.429 169.518 78.5863C169.358 78.7436 169.168 78.8222 168.948 78.8222C168.727 78.8222 168.537 78.7436 168.377 78.5863C168.217 78.429 168.136 78.2422 168.136 78.0259V70.2692C168.136 68.8142 167.696 67.6738 166.815 66.848C165.933 66.0222 164.842 65.6093 163.54 65.6093C162.639 65.6093 161.828 65.8157 161.107 66.2286C160.386 66.6415 159.815 67.2215 159.395 67.9687C158.974 68.6962 158.764 69.522 158.764 70.4461V78.0259C158.764 78.2422 158.684 78.429 158.523 78.5863C158.363 78.7436 158.173 78.8222 157.953 78.8222C157.732 78.8222 157.542 78.7436 157.382 78.5863C157.222 78.429 157.142 78.2422 157.142 78.0259V70.2692C157.142 68.8142 156.701 67.6738 155.82 66.848C154.939 66.0222 153.847 65.6093 152.545 65.6093C151.644 65.6093 150.833 65.8157 150.112 66.2286C149.391 66.6415 148.82 67.2215 148.4 67.9687C147.979 68.6962 147.769 69.522 147.769 70.4461V78.0259C147.769 78.2422 147.689 78.429 147.529 78.5863C147.368 78.7436 147.178 78.8222 146.958 78.8222C146.737 78.8222 146.547 78.7436 146.387 78.5863C146.227 78.429 146.147 78.2422 146.147 78.0259V65.1079C146.147 64.8916 146.227 64.7048 146.387 64.5475C146.547 64.3902 146.737 64.3116 146.958 64.3116C147.178 64.3116 147.368 64.3902 147.529 64.5475C147.689 64.7048 147.769 64.8916 147.769 65.1079V66.7595C148.31 65.9337 149.021 65.2947 149.902 64.8424C150.783 64.3705 151.754 64.1346 152.816 64.1346C153.997 64.1346 155.069 64.4295 156.03 65.0194C156.991 65.6093 157.712 66.4252 158.193 67.4673C158.694 66.4449 159.445 65.6387 160.446 65.0489C161.447 64.4394 162.569 64.1346 163.811 64.1346Z" fill="black"/><path d="M178.71 78.9992C177.428 78.9992 176.256 78.6748 175.195 78.0259C174.154 77.3574 173.323 76.4628 172.702 75.342C172.101 74.2016 171.8 72.9432 171.8 71.5669C171.8 70.1512 172.101 68.883 172.702 67.7623C173.323 66.6219 174.154 65.7371 175.195 65.1079C176.236 64.459 177.388 64.1346 178.65 64.1346C179.992 64.1346 181.183 64.4787 182.225 65.1669C183.286 65.855 184.097 66.7988 184.658 67.9982C185.239 69.1779 185.519 70.4756 185.499 71.8913C185.499 72.0879 185.429 72.2649 185.289 72.4222C185.149 72.5598 184.968 72.6286 184.748 72.6286H173.543C173.763 74.064 174.354 75.2437 175.315 76.1678C176.277 77.0723 177.418 77.5245 178.74 77.5245C179.661 77.5245 180.482 77.3869 181.203 77.1116C181.924 76.8363 182.745 76.4333 183.667 75.9024C183.767 75.8237 183.897 75.7844 184.057 75.7844C184.277 75.7844 184.458 75.8631 184.598 76.0204C184.758 76.158 184.838 76.3251 184.838 76.5217C184.838 76.797 184.708 77.0133 184.448 77.1706C183.426 77.7605 182.475 78.2127 181.594 78.5273C180.733 78.8419 179.771 78.9992 178.71 78.9992ZM183.817 71.154C183.757 70.0922 183.486 69.1386 183.006 68.2931C182.545 67.4477 181.924 66.789 181.143 66.3171C180.382 65.8452 179.551 65.6093 178.65 65.6093C177.749 65.6093 176.907 65.8452 176.126 66.3171C175.365 66.789 174.744 67.4477 174.264 68.2931C173.803 69.1386 173.543 70.0922 173.483 71.154H183.817Z" fill="black"/></svg>';
        break;

        case 'gototop':
            return '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M15.5 6.83366L12 3.16699L8.5 6.83366" stroke="white" stroke-opacity="0.8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M12 20.6663L12 3.33301" stroke="white" stroke-opacity="0.8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>';
        break;

        case 'search-toggle':
            return '<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M9.16634 3.95801C6.28986 3.95801 3.95801 6.28986 3.95801 9.16634C3.95801 12.0428 6.28986 14.3747 9.16634 14.3747C12.0428 14.3747 14.3747 12.0428 14.3747 9.16634C14.3747 6.28986 12.0428 3.95801 9.16634 3.95801Z" stroke="white" stroke-width="1.5"/><path d="M16.042 16.042L12.917 12.917" stroke="white" stroke-width="1.5" stroke-linecap="round"/></svg>';
        break;

        case 'woo-user':
            return '<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12.7087 6.66634C12.7087 8.16212 11.4961 9.37467 10.0003 9.37467C8.50458 9.37467 7.29199 8.16212 7.29199 6.66634C7.29199 5.17057 8.50458 3.95801 10.0003 3.95801C11.4961 3.95801 12.7087 5.17057 12.7087 6.66634Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M5.70635 16.042H14.2939C15.2455 16.042 15.9785 15.2237 15.534 14.3823C14.8804 13.1446 13.3901 11.667 10.0001 11.667C6.61011 11.667 5.11982 13.1446 4.46613 14.3823C4.02174 15.2237 4.75476 16.042 5.70635 16.042Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>';
        break;

        case 'woo-cart':
            return '<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M6.45801 6.45801L5.83301 3.95801H3.95801M6.45801 6.45801H16.0413L14.677 12.2564C14.4998 13.0093 13.8281 13.5413 13.0547 13.5413H9.61592C8.85967 13.5413 8.19823 13.0322 8.00472 12.3012L6.45801 6.45801Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M8.75033 15.8337C8.75033 16.0637 8.56374 16.2503 8.33366 16.2503C8.10354 16.2503 7.91699 16.0637 7.91699 15.8337C7.91699 15.6036 8.10354 15.417 8.33366 15.417C8.56374 15.417 8.75033 15.6036 8.75033 15.8337Z" stroke="white"/><path d="M14.5833 15.8337C14.5833 16.0637 14.3968 16.2503 14.1667 16.2503C13.9366 16.2503 13.75 16.0637 13.75 15.8337C13.75 15.6036 13.9366 15.417 14.1667 15.417C14.3968 15.417 14.5833 15.6036 14.5833 15.8337Z" stroke="white"/></svg>';
        break;

        case 'pagination-prev':
            return '<svg width="28" height="13" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M6.5 1L1 6.25l5.5 5.25M27.25 6.25h-26" stroke="var(--st-heading-color)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>';
        break;
            
        case 'pagination-next':
            return '<svg width="28" height="13" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M21.75 1l5.5 5.25-5.5 5.25M27 6.25H1" stroke="var(--st-heading-color)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>';
        break;

        case 'swiper-prev':
            return '<svg width="28" height="13" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M6.5 1L1 6.25l5.5 5.25M27.25 6.25h-26" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>';
        break;

        case 'swiper-next':
            return '<svg width="28" height="13" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M21.75 1l5.5 5.25-5.5 5.25M27 6.25H1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>';
        break;
    }
}
endif;
    
if( ! function_exists( 'presto_blog_get_svg_icons' ) ) :
/**
 * Fuction to list Custom Post Type
*/
function presto_blog_get_svg_icons(){
    $social_media = [ 'facebook', 'twitter', 'digg', 'instagram', 'pinterest', 'telegram', 'getpocket', 'dribbble', 'behance', 'unsplash', 'five_hundred_px', 'linkedin', 'wordpress', 'parler', 'mastodon', 'medium', 'slack', 'codepen', 'reddit', 'twitch', 'tiktok', 'snapchat', 'spotify', 'soundcloud', 'apple_podcast', 'patreon', 'alignable', 'skype', 'github', 'gitlab', 'youtube', 'vimeo', 'dtube', 'vk', 'ok', 'rss', 'facebook_group', 'discord', 'tripadvisor', 'foursquare', 'yelp', 'hacker_news', 'xing', 'flipboard', 'weibo', 'tumblr', 'qq', 'strava', 'flickr' ];
    
    // Initate an empty array
    $svg_options = array();
    $svg_options[''] = __( ' -- Choose -- ', 'presto-blog' );
    
    foreach ( $social_media as $svg ) {			
        $svg_options[ $svg ] = esc_html( ucfirst( str_replace( '_', ' ', $svg ) ) );
    }
    
    return $svg_options;
}
endif;
    
if ( ! function_exists( 'presto_blog_social_icons_svg_list' ) ) :    
/**
 * Get SVG Image
*/
function presto_blog_social_icons_svg_list( $social ){

    if( !$social ){
        return;
    }

    switch ( $social ) {
        case 'facebook':
            return '<svg class="st-icon" width="20px" height="20px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" aria-label="' . esc_attr__( 'Facebook Icon', 'presto-blog' ) . '"><path fill="currentColor" d="M279.14 288l14.22-92.66h-88.91v-60.13c0-25.35 12.42-50.06 52.24-50.06h40.42V6.26S260.43 0 225.36 0c-73.22 0-121.08 44.38-121.08 124.72v70.62H22.89V288h81.39v224h100.17V288z"></path></svg>';
        break;
        case 'twitter':
            return '<svg class="st-icon" width="20px" height="20px" viewBox="0 0 20 20" aria-label="' . esc_attr__( 'Twitter Icon', 'presto-blog' ) . '"><path fill="currentcolor" d="M20,3.8c-0.7,0.3-1.5,0.5-2.4,0.6c0.8-0.5,1.5-1.3,1.8-2.3c-0.8,0.5-1.7,0.8-2.6,1c-0.7-0.8-1.8-1.3-3-1.3c-2.3,0-4.1,1.8-4.1,4.1c0,0.3,0,0.6,0.1,0.9C6.4,6.7,3.4,5.1,1.4,2.6C1,3.2,0.8,3.9,0.8,4.7c0,1.4,0.7,2.7,1.8,3.4C2,8.1,1.4,7.9,0.8,7.6c0,0,0,0,0,0.1c0,2,1.4,3.6,3.3,4c-0.3,0.1-0.7,0.1-1.1,0.1c-0.3,0-0.5,0-0.8-0.1c0.5,1.6,2,2.8,3.8,2.8c-1.4,1.1-3.2,1.8-5.1,1.8c-0.3,0-0.7,0-1-0.1c1.8,1.2,4,1.8,6.3,1.8c7.5,0,11.7-6.3,11.7-11.7c0-0.2,0-0.4,0-0.5C18.8,5.3,19.4,4.6,20,3.8z"/></svg>';
        break;
        case 'instagram':
            return '<svg class="st-icon" width="20px" height="20px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" aria-label="' . esc_attr__( 'Instagram Icon', 'presto-blog' ) . '"><path fill="currentColor" d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z"></path></svg>';
        break;
        case 'pinterest':
            return '<svg class="st-icon" width="20px" height="20px" viewBox="0 0 20 20" aria-label="' . esc_attr__( 'Pinterest Icon', 'presto-blog' ) . '"><path fill="currentcolor" d="M10,0C4.5,0,0,4.5,0,10c0,4.1,2.5,7.6,6,9.2c0-0.7,0-1.5,0.2-2.3c0.2-0.8,1.3-5.4,1.3-5.4s-0.3-0.6-0.3-1.6c0-1.5,0.9-2.6,1.9-2.6c0.9,0,1.3,0.7,1.3,1.5c0,0.9-0.6,2.3-0.9,3.5c-0.3,1.1,0.5,1.9,1.6,1.9c1.9,0,3.2-2.4,3.2-5.3c0-2.2-1.5-3.8-4.2-3.8c-3,0-4.9,2.3-4.9,4.8c0,0.9,0.3,1.5,0.7,2C6,12,6.1,12.1,6,12.4c0,0.2-0.2,0.6-0.2,0.8c-0.1,0.3-0.3,0.3-0.5,0.3c-1.4-0.6-2-2.1-2-3.8c0-2.8,2.4-6.2,7.1-6.2c3.8,0,6.3,2.8,6.3,5.7c0,3.9-2.2,6.9-5.4,6.9c-1.1,0-2.1-0.6-2.4-1.2c0,0-0.6,2.3-0.7,2.7c-0.2,0.8-0.6,1.5-1,2.1C8.1,19.9,9,20,10,20c5.5,0,10-4.5,10-10C20,4.5,15.5,0,10,0z"/></svg>';
        break;
        case 'digg':
            return '<svg class="st-icon" width="20px" height="20px" aria-label="' . esc_attr__( 'Digg Icon', 'presto-blog' ) . '" viewBox="0 0 512 512" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill="currentcolor" d="M81.7 172.3H0V346.7H132.7V96H81.7V172.3V172.3ZM81.7 305.7H50.9V213.4H81.7V305.7ZM378.9 172.3V346.7H460.7V375.2H378.9V416H512V172.3H378.9V172.3ZM460.7 305.7H429.9V213.4H460.7V305.7ZM225.1 346.7H307.2V375.2H225.1V416H358.4V172.3H225.1V346.7ZM276.3 213.4H307.1V305.7H276.3V213.4ZM153.3 96H204.6V147H153.3V96ZM153.3 172.3H204.6V346.7H153.3V172.3Z"/></svg>';
        break;
        case 'telegram':
            return '<svg width="20px" height="20px" aria-label="' . esc_attr__( 'Telegram Icon', 'presto-blog' ) . '" viewBox="0 0 448 512" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill="currentcolor" d="M446.7 98.6L379.1 417.4C374 439.9 360.7 445.5 341.8 434.9L238.8 359L189.1 406.8C183.6 412.3 179 416.9 168.4 416.9L175.8 312L366.7 139.5C375 132.1 364.9 128 353.8 135.4L117.8 284L16.1998 252.2C-5.90022 245.3 -6.30022 230.1 20.7998 219.5L418.2 66.4C436.6 59.5 452.7 70.5 446.7 98.6V98.6Z"/></svg>';
        break;
        case 'getpocket':
            return '<svg width="20px" height="20px" aria-label="' . esc_attr__( 'GetPocket Icon', 'presto-blog' ) . '" viewBox="0 0 448 512" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill="currentcolor" d="M407.6 64H40.6C18.5 64 0 82.5 0 104.6V239.8C0 364.5 99.7 464 224.2 464C348.2 464 448 364.5 448 239.8V104.6C448 82.2 430.3 64 407.6 64V64ZM245.6 332.5C233.2 344.3 214.2 343.6 203.2 332.5C89.5 223.6 88.3 227.4 88.3 209.3C88.3 192.4 102.1 178.6 119 178.6C136 178.6 135.1 182.4 224.2 267.9C314.8 181 312.8 178.6 329.7 178.6C346.6 178.6 360.4 192.4 360.4 209.3C360.4 227.1 357.5 225 245.6 332.5V332.5Z"/></svg>';
        break;
        case 'dribbble':
            return '<svg class="st-icon" width="20" height="20" viewBox="0 0 20 20" aria-label="' . esc_attr__( 'Dribbble Icon', 'presto-blog' ) . '"><path fill="currentcolor" d="M10,0C4.5,0,0,4.5,0,10c0,5.5,4.5,10,10,10c5.5,0,10-4.5,10-10C20,4.5,15.5,0,10,0 M16.1,5.2c1,1.2,1.6,2.8,1.7,4.4c-1.1-0.2-2.2-0.4-3.2-0.4v0h0c-0.8,0-1.6,0.1-2.3,0.2c-0.2-0.4-0.3-0.8-0.5-1.2C13.4,7.6,14.9,6.6,16.1,5.2 M10,2.2c1.8,0,3.5,0.6,4.9,1.7c-1,1.2-2.4,2.1-3.8,2.7c-1-2-2-3.4-2.7-4.3C8.9,2.3,9.4,2.2,10,2.2 M6.6,3c0.5,0.6,1.6,2,2.8,4.2C7,8,4.6,8.1,3.2,8.1c0,0-0.1,0-0.1,0h0c-0.2,0-0.4,0-0.6,0C3,5.9,4.5,4,6.6,3 M2.2,10c0,0,0-0.1,0-0.1c0.2,0,0.5,0,0.9,0h0c1.6,0,4.3-0.1,7.1-1c0.2,0.3,0.3,0.7,0.4,1c-1.9,0.6-3.3,1.6-4.4,2.6c-1,0.9-1.7,1.9-2.2,2.5C2.9,13.7,2.2,11.9,2.2,10 M10,17.8c-1.7,0-3.3-0.6-4.6-1.5c0.3-0.5,0.9-1.3,1.8-2.2c1-0.9,2.3-1.9,4.1-2.5c0.6,1.7,1.1,3.6,1.5,5.7C11.9,17.6,11,17.8,10,17.8M14.4,16.4c-0.4-1.9-0.9-3.7-1.4-5.2c0.5-0.1,1-0.1,1.6-0.1h0h0h0c0.9,0,2,0.1,3.1,0.4C17.3,13.5,16.1,15.3,14.4,16.4"/></svg>';
        break;
        case 'behance':
            return '<svg class="st-icon" width="20" height="20" viewBox="0 0 20 20" aria-label="' . esc_attr__( 'Behance Icon', 'presto-blog' ) . '"><path fill="currentcolor" d="M15.2,10.3h-2.7c0,0,0.2-1.3,1.5-1.3C15.2,9,15.2,10.3,15.2,10.3z M7.7,10.3H5.3v2.2h2.2c0,0,0.1,0,0.2,0c0.3,0,1-0.1,1-1.1C8.6,10.3,7.7,10.3,7.7,10.3zM20,10c0,5.5-4.5,10-10,10C4.5,20,0,15.5,0,10S4.5,0,10,0C15.5,0,20,4.5,20,10zM12.1,7.2h3.4v-1h-3.4V7.2z M8.8,9.5c0,0,1.3-0.1,1.3-1.6S9,5.7,7.7,5.7H5.3H5.2H3.4V14h1.8h0.1h2.4c0,0,2.6,0.1,2.6-2.5C10.4,11.5,10.5,9.5,8.8,9.5zM13.9,7.8c-3.2,0-3.2,3.2-3.2,3.2s-0.2,3.2,3.2,3.2c0,0,2.9,0.2,2.9-2.2h-1.5c0,0,0,0.9-1.3,0.9c0,0-1.5,0.1-1.5-1.5h4.3C16.8,11.4,17.3,7.8,13.9,7.8z M8.3,8c0-0.9-0.6-0.9-0.6-0.9H7.4H5.3V9h2.3C8,9,8.3,8.9,8.3,8z"/></svg>';
        break;
        case 'unsplash':
            return '<svg class="st-icon" width="20" height="20" viewBox="0 0 20 20" aria-label="' . esc_attr__( 'Unsplash Icon', 'presto-blog' ) . '"><path fill="currentcolor" d="M6.2 5.6V0h7.5v5.6H6.2zm7.6 3.2H20V20H0V8.8h6.2v5.6h7.5V8.8z"/></svg>';
        break;
        case 'five_hundred_px':
            return '<svg class="st-icon" width="20" height="20" viewBox="0 0 20 20" aria-label="' . esc_attr__( '500PX Icon', 'presto-blog' ) . '"><path fill="currentcolor" d="M17.7 17.3c-.9.9-1.9 1.6-3 2-1.1.5-2.3.7-3.5.7-1.2 0-2.4-.2-3.5-.7-1.1-.5-2.1-1.1-2.9-2-.8-.8-1.5-1.8-2-2.9-.3-.8-.5-1.5-.6-2.1 0-.2.1-.3.5-.4.4-.1.6 0 .6.2.1.7.3 1.3.5 1.8.4.9.9 1.8 1.7 2.5.7.7 1.6 1.3 2.5 1.7 1 .4 2 .6 3.1.6s2.1-.2 3.1-.6c1-.4 1.8-1 2.5-1.7l.1-.1c.1-.1.2-.1.3-.1.1 0 .2.1.4.2.3.5.3.7.2.9zm-5.3-6.9l-.7.7.7.7c.2.2.1.3-.1.5-.1.1-.2.2-.4.2-.1 0-.1 0-.2-.1l-.7-.7-.7.7s-.1.1-.2.1-.2-.1-.3-.2c-.1-.1-.2-.2-.2-.3 0-.1 0-.1.1-.2l.7-.7-.7-.7c-.1-.1-.1-.3.2-.5.1-.1.2-.2.3-.2 0 0 .1 0 .1.1l.7.7.7-.7c.1-.1.3-.1.5.1.3.2.4.4.2.5zm5.3.6c0 .9-.2 1.7-.5 2.5s-.8 1.5-1.4 2.1c-.6.6-1.3 1.1-2.1 1.4-.8.3-1.6.5-2.5.5-.9 0-1.7-.2-2.5-.5s-1.5-.8-2.1-1.4c-.6-.6-1.1-1.3-1.4-2.1l-.2-.4c-.1-.2.1-.4.5-.5.4-.1.6-.1.7.1.3.7.6 1.4 1.1 1.9v-3.8c0-1 .4-1.9 1.1-2.6.8-.8 1.7-1.1 2.8-1.1 1.1 0 2 .4 2.8 1.1.8.8 1.2 1.7 1.2 2.8 0 1.1-.4 2-1.2 2.8-.8.8-1.7 1.2-2.8 1.2-.4 0-.8-.1-1.2-.2-.2-.1-.3-.3-.1-.7.1-.4.3-.5.5-.5h.2c.1 0 .2 0 .4.1s.3 0 .3 0c.8 0 1.4-.3 2-.8.5-.5.8-1.2.8-1.9 0-.8-.3-1.4-.8-1.9s-1.2-.8-2-.8-1.5.3-2 .9c-.7.6-.9 1.2-.9 1.8v4.6c.8.5 1.7.7 2.7.7.7 0 1.4-.1 2.1-.4.7-.3 1.2-.7 1.7-1.2s.9-1.1 1.2-1.7c.3-.7.4-1.3.4-2 0-1.5-.5-2.7-1.6-3.8-1-1-2.3-1.6-3.8-1.6s-2.8.5-3.8 1.6c-.4.4-.7.8-.8 1l-.2.2s-.1.1-.2.1h-.4c-.2 0-.3-.1-.4-.2S5 8.1 5 8V.4c0-.1 0-.2.1-.3s.2-.1.4-.1h9.8c.2 0 .3.2.3.6s-.1.6-.3.6H6.2v5.4c.3-.3.7-.6 1.2-.9.4-.3.8-.6 1.2-.7.8-.3 1.7-.5 2.6-.5.9 0 1.7.2 2.5.5s1.5.8 2.1 1.4c.6.6 1.1 1.3 1.4 2.1.3.8.5 1.7.5 2.5zm-.4-6.4c.1.1.1.1.1.2s0 .1-.1.2l-.2.2c-.2.2-.3.3-.4.3-.1 0-.1 0-.2-.1-.8-.7-1.6-1.2-2.3-1.5-1-.4-2-.6-3.1-.6-1 0-2 .2-2.9.5-.1.1-.3 0-.4-.4-.1-.2-.1-.3-.1-.4 0-.1.1-.2.2-.2 1-.4 2.1-.6 3.3-.6 1.2 0 2.4.2 3.5.7 1 .4 1.9 1 2.6 1.7z"/></svg>';
        break;
        case 'linkedin':
            return '<svg class="st-icon" width="20px" height="20px" viewBox="0 0 20 20" aria-label="' . esc_attr__( 'LinkedIn Icon', 'presto-blog' ) . '"><path fill="currentcolor" d="M18.6,0H1.4C0.6,0,0,0.6,0,1.4v17.1C0,19.4,0.6,20,1.4,20h17.1c0.8,0,1.4-0.6,1.4-1.4V1.4C20,0.6,19.4,0,18.6,0z M6,17.1h-3V7.6h3L6,17.1L6,17.1zM4.6,6.3c-1,0-1.7-0.8-1.7-1.7s0.8-1.7,1.7-1.7c0.9,0,1.7,0.8,1.7,1.7C6.3,5.5,5.5,6.3,4.6,6.3z M17.2,17.1h-3v-4.6c0-1.1,0-2.5-1.5-2.5c-1.5,0-1.8,1.2-1.8,2.5v4.7h-3V7.6h2.8v1.3h0c0.4-0.8,1.4-1.5,2.8-1.5c3,0,3.6,2,3.6,4.5V17.1z"/></svg>';
        break;
        case 'wordpress':
            return '<svg class="st-icon" width="20px" height="20px" viewBox="0 0 20 20" aria-label="' . esc_attr__( 'WordPress Icon', 'presto-blog' ) . '"><path fill="currentcolor" d="M1.9 4.1C3.7 1.6 6.7 0 10 0c2.4 0 4.6.9 6.3 2.3-.7.2-1.2 1-1.2 1.7 0 .9.5 1.6 1 2.4.5.7.9 1.6.9 2.9 0 .9-.3 2-.8 3.4l-1 3.5-3.8-11.3c.6 0 1.2-.1 1.2-.1.6 0 .5-.8 0-.8 0 0-1.7.1-2.8.1-1 0-2.7-.1-2.7-.1-.6 0-.7.8-.1.8 0 0 .5.1 1.1.1l1.6 4.4-2.3 6.8L3.7 4.9c.6 0 1.2-.1 1.2-.1.5 0 .4-.8-.1-.8 0 0-1.7.1-2.9.1.1 0 .1 0 0 0zM.8 6.2C.3 7.4 0 8.6 0 10c0 3.9 2.2 7.2 5.4 8.9L.8 6.2zm9.4 4.5l-3 8.9c.9.3 1.8.4 2.8.4 1.2 0 2.3-.2 3.4-.6l-3.2-8.7zm9-4.6c0 1-.2 2.2-.8 3.6l-3 8.8c2.8-1.8 4.6-4.9 4.6-8.4 0-1.5-.3-2.8-.8-4z"/></svg>';
        break;
        case 'parler':
            return '<svg class="st-icon" width="20px" height="20px" viewBox="0 0 20 20" aria-label="' . esc_attr__( 'Parler Icon', 'presto-blog' ) . '"><path fill="currentcolor" d="M11.7,16.7h-5V15c0-0.9,0.7-1.6,1.6-1.6h3.4c2.8,0,5-2.2,5-5s-2.2-5-5-5h0l-1.1,0H0C0,1.5,1.5,0,3.3,0h7.3l1.1,0C16.3,0,20,3.8,20,8.4S16.3,16.7,11.7,16.7z M3.3,20C1.5,20,0,18.5,0,16.7V9.9c0-1.8,1.4-3.2,3.2-3.2h8.4c0.9,0,1.7,0.7,1.7,1.7c0,0.9-0.7,1.7-1.7,1.7H5c-0.9,0-1.6,0.7-1.6,1.6V20z"/></svg>';
        break;
        case 'mastodon':
            return '<svg class="st-icon" width="20px" height="20px" viewBox="0 0 20 20" aria-label="' . esc_attr__( 'Mastodon Icon', 'presto-blog' ) . '"><path fill="currentcolor" d="M19.3 6.6c0-4.3-2.8-5.6-2.8-5.6C13.7-.3 6.3-.3 3.5 1 3.5 1 .7 2.3.7 6.6c0 5.2-.3 11.6 4.7 12.9 1.8.5 3.4.6 4.6.5 2.3-.1 3.5-.8 3.5-.8l-.1-1.6s-1.6.5-3.4.5c-1.8-.1-3.7-.2-4-2.4v-.6c3.8.9 7.1.4 8 .3 2.5-.3 4.7-1.8 5-3.3.4-2.3.3-5.5.3-5.5zM16 12.2h-2.1V7.1c0-2.2-2.9-2.3-2.9.3v2.8H9V7.4c0-2.6-2.9-2.5-2.9-.3v5.1H4c0-5.4-.2-6.6.8-7.8C6 3.1 8.4 3 9.5 4.6l.5.9.5-.9c1.1-1.6 3.5-1.5 4.7-.3 1 1.3.8 2.4.8 7.9z"/></svg>';
        break;
        case 'medium':
            return '<svg class="st-icon" width="20" height="20" viewBox="0 0 20 20" aria-label="' . esc_attr__( 'Medium Icon', 'presto-blog' ) . '"><path fill="currentcolor" d="M2.4,5.3c0-0.2-0.1-0.5-0.3-0.7L0.3,2.4V2.1H6l4.5,9.8l3.9-9.8H20v0.3l-1.6,1.5c-0.1,0.1-0.2,0.3-0.2,0.4v11.2c0,0.2,0,0.3,0.2,0.4l1.6,1.5v0.3h-7.8v-0.3l1.6-1.6c0.2-0.2,0.2-0.2,0.2-0.4V6.5L9.4,17.9H8.8L3.6,6.5v7.6c0,0.3,0.1,0.6,0.3,0.9L6,17.6v0.3H0v-0.3L2.1,15c0.2-0.2,0.3-0.6,0.3-0.9V5.3z"/></svg>';
        break;
        case 'slack':
            return '<svg class="st-icon" width="20" height="20" viewBox="0 0 20 20" aria-label="' . esc_attr__( 'Slack Icon', 'presto-blog' ) . '"><path fill="currentcolor" d="M7.4,0C6.2,0,5.2,1,5.2,2.2s1,2.2,2.2,2.2h2.2V2.2C9.6,1,8.6,0,7.4,0zM12.6,0c-1.2,0-2.2,1-2.2,2.2v5.2c0,1.2,1,2.2,2.2,2.2s2.2-1,2.2-2.2V2.2C14.8,1,13.8,0,12.6,0z M2.2,5.2C1,5.2,0,6.2,0,7.4s1,2.2,2.2,2.2h5.2c1.2,0,2.2-1,2.2-2.2s-1-2.2-2.2-2.2H2.2zM17.8,5.2c-1.2,0-2.2,1-2.2,2.2v2.2h2.2c1.2,0,2.2-1,2.2-2.2S19,5.2,17.8,5.2z M2.2,10.4c-1.2,0-2.2,1-2.2,2.2s1,2.2,2.2,2.2s2.2-1,2.2-2.2v-2.2H2.2zM7.4,10.4c-1.2,0-2.2,1-2.2,2.2v5.2c0,1.2,1,2.2,2.2,2.2s2.2-1,2.2-2.2v-5.2C9.6,11.4,8.6,10.4,7.4,10.4z M12.6,10.4c-1.2,0-2.2,1-2.2,2.2s1,2.2,2.2,2.2h5.2c1.2,0,2.2-1,2.2-2.2s-1-2.2-2.2-2.2H12.6zM10.4,15.7v2.2c0,1.2,1,2.2,2.2,2.2s2.2-1,2.2-2.2c0-1.2-1-2.2-2.2-2.2H10.4z"/> </svg>';
        break;
        case 'codepen':
            return '<svg class="st-icon" width="20" height="20" viewBox="0 0 20 20" aria-label="' . esc_attr__( 'CodePen Icon', 'presto-blog' ) . '"><path fill="currentcolor" d="M10,0L0,6.4v7.3L10,20l10-6.4V6.4L10,0z M10,12l-2.8-2L10,8.1l2.8,1.9L10,12z M11,6.5V2.8l6.4,4.1l-2.9,2L11,6.5z M9,6.5L5.5,8.9l-2.9-2L9,2.8V6.5z M3.9,10l-1.9,1.3V8.7L3.9,10z M5.5,11.2L9,13.6v3.5l-6.4-4.1L5.5,11.2z M11,13.6l3.5-2.5l2.8,1.9L11,17.2V13.6z M16.1,10l1.9-1.4v2.7L16.1,10z"/></svg>';
        break;
        case 'reddit':
            return '<svg class="st-icon" width="20px" height="20px" viewBox="0 0 20 20" aria-label="' . esc_attr__( 'Reddit Icon', 'presto-blog' ) . '"><path fill="currentcolor" d="M11.7,0.9c-0.9,0-2,0.7-2.1,3.9c0.1,0,0.3,0,0.4,0c0.2,0,0.3,0,0.5,0c0.1-1.9,0.6-3.1,1.3-3.1c0.3,0,0.5,0.2,0.8,0.5c0.4,0.4,0.9,0.9,1.8,1.1c0-0.1,0-0.2,0-0.4c0-0.2,0-0.4,0.1-0.5c-0.6-0.2-0.9-0.5-1.2-0.8C12.8,1.3,12.4,0.9,11.7,0.9z M16.9,1.3c-1,0-1.7,0.8-1.7,1.7s0.8,1.7,1.7,1.7s1.7-0.8,1.7-1.7S17.9,1.3,16.9,1.3z M10,5.7c-5.3,0-9.5,2.7-9.5,6.5s4.3,6.9,9.5,6.9s9.5-3.1,9.5-6.9S15.3,5.7,10,5.7z M2.4,6.1c-0.6,0-1.2,0.3-1.7,0.7C0,7.5-0.2,8.6,0.2,9.5C0.9,8.2,2,7.1,3.5,6.3C3.1,6.2,2.8,6.1,2.4,6.1z M17.6,6.1c-0.4,0-0.7,0.1-1.1,0.3c1.5,0.8,2.6,1.9,3.2,3.2c0.4-0.9,0.3-2-0.5-2.7C18.8,6.3,18.2,6.1,17.6,6.1z M6.5,9.6c0.7,0,1.3,0.6,1.3,1.3s-0.6,1.3-1.3,1.3s-1.3-0.6-1.3-1.3S5.8,9.6,6.5,9.6z M13.5,9.6c0.7,0,1.3,0.6,1.3,1.3s-0.6,1.3-1.3,1.3s-1.3-0.6-1.3-1.3S12.8,9.6,13.5,9.6z M6.1,14.3c0.1,0,0.2,0.1,0.3,0.2c0,0.1,1.1,1.4,3.6,1.4c2.6,0,3.6-1.4,3.6-1.4c0.1-0.2,0.4-0.2,0.6-0.1c0.2,0.1,0.2,0.4,0.1,0.6c-0.1,0.1-1.3,1.8-4.3,1.8c-3,0-4.2-1.7-4.3-1.8c-0.1-0.2-0.1-0.5,0.1-0.6C5.9,14.4,6,14.3,6.1,14.3z"/></svg>';
        break;
        case 'twitch':
            return '<svg class="st-icon" width="20px" height="20px" viewBox="0 0 20 20" aria-label="' . esc_attr__( 'Twitch Icon', 'presto-blog' ) . '"><path fill="currentcolor" d="M1.5,0L0,4.1v12.8h4.6V20h2.1l3.8-3.1h4.1l5.4-5.8V0H1.5zM3.1,1.5h15.4v8.8l-3.3,3.5H9.5l-3.4,2.9v-2.9H3.1V1.5z M7.7,4.6v6.2h1.5V4.6H7.7z M12.3,4.6v6.2h1.5V4.6H12.3z"/></svg>';
        break;
        case 'tiktok':
            return '<svg class="st-icon" width="20px" height="20px" viewBox="0 0 20 20" aria-label="' . esc_attr__( 'TikTok Icon', 'presto-blog' ) . '"><path fill="currentcolor" d="M18.2 4.5c-2.3-.2-4.1-1.9-4.4-4.2V0h-3.4v13.8c0 1.4-1.2 2.6-2.8 2.6-1.4 0-2.6-1.1-2.6-2.6s1.1-2.6 2.6-2.6h.2l.5.1V7.5h-.7c-3.4 0-6.2 2.8-6.2 6.2S4.2 20 7.7 20s6.2-2.8 6.2-6.2v-7c1.1 1.1 2.4 1.6 3.9 1.6h.8V4.6l-.4-.1z"/></svg>';
        break;
        case 'snapchat':
            return '<svg class="st-icon" width="20px" height="20px" viewBox="0 0 20 20" aria-label="' . esc_attr__( 'Snapchat Icon', 'presto-blog' ) . '"><path fill="currentcolor" d="M10,0.5c-6,0-6,6-6,6v1c0,0,0,0-0.1,0C3.6,7.5,2,7.6,2,8.9c0,1.5,1.7,1.6,2,1.6c0,0,0,0,0,0c0,1-1.7,2.2-2.7,2.4C0.3,13.3,0,14,0,14.5c0,0.3,0.1,0.5,0.1,0.6c0.4,0.9,1.5,1.3,2.6,1.3c0,1.4,1.1,2,1.8,2c0.8,0,1.6-0.4,1.6-0.4c0,0,1.3,1.4,3.9,1.4s3.9-1.4,3.9-1.4c0,0,0.8,0.4,1.6,0.4c0.7,0,1.7-0.6,1.8-2c1.1,0,2.2-0.5,2.6-1.3c0-0.1,0.1-0.3,0.1-0.6c0-0.5-0.3-1.2-1.3-1.6c-1.1-0.3-2.7-1.4-2.7-2.4c0,0,0,0,0,0c0.3,0,2-0.1,2-1.6c0-1.3-1.6-1.4-1.9-1.4c0,0-0.1,0-0.1,0v-1C16,6.5,16,0.5,10,0.5L10,0.5z"/></svg>';
        break;
        case 'spotify':
            return '<svg class="st-icon" width="20px" height="20px" viewBox="0 0 20 20" aria-label="' . esc_attr__( 'Spotify Icon', 'presto-blog' ) . '"><path fill="currentcolor" d="M10,0C4.5,0,0,4.5,0,10s4.5,10,10,10s10-4.5,10-10S15.5,0,10,0z M14.2,14.5c-0.1,0.2-0.3,0.3-0.5,0.3c-0.1,0-0.2,0-0.4-0.1c-1.1-0.7-2.9-1.2-4.4-1.2c-1.6,0-2.8,0.4-2.8,0.4c-0.3,0.1-0.7-0.1-0.8-0.4c-0.1-0.3,0.1-0.7,0.4-0.8c0.1,0,1.4-0.5,3.2-0.5c1.5,0,3.6,0.4,5.1,1.4C14.4,13.8,14.4,14.2,14.2,14.5z M15.5,11.8c-0.1,0.2-0.4,0.4-0.6,0.4c-0.1,0-0.3,0-0.4-0.1c-1.9-1.2-4-1.5-5.7-1.5c-1.9,0-3.5,0.4-3.5,0.4c-0.4,0.1-0.8-0.1-0.9-0.5c-0.1-0.4,0.1-0.8,0.5-0.9c0.1,0,1.7-0.4,3.8-0.4c1.9,0,4.4,0.3,6.6,1.7C15.6,11,15.8,11.5,15.5,11.8z M16.8,8.7c-0.2,0.3-0.5,0.4-0.8,0.4c-0.1,0-0.3,0-0.4-0.1c-2.3-1.3-5-1.6-6.9-1.6c0,0,0,0,0,0c-2.3,0-4.1,0.4-4.1,0.4c-0.5,0.1-0.9-0.2-1-0.6c-0.1-0.5,0.2-0.9,0.6-1c0.1,0,2-0.5,4.5-0.5c0,0,0,0,0,0c2.1,0,5.2,0.3,7.8,1.9C16.9,7.8,17.1,8.3,16.8,8.7z"/></svg>';
        break;
        case 'soundcloud':
            return '<svg class="st-icon" width="20px" height="20px" viewBox="0 0 20 20" aria-label="' . esc_attr__( 'SoundCloud Icon', 'presto-blog' ) . '"><path fill="currentcolor" d="M20 12.7c0 1.5-1.2 2.7-2.7 2.7h-6c-.4 0-.7-.3-.7-.7V5.3c0-.4.3-.7.7-.7h.7c3.3 0 6 2.7 4.7 5.3h.7c1.4.1 2.6 1.3 2.6 2.8zM.7 9.9c-.4 0-.7.3-.7.7v4.1c0 .4.3.7.7.7.4 0 .7-.3.7-.7v-4.1c-.1-.4-.4-.7-.7-.7zM6 5.3c-.4 0-.7.3-.7.7v8.7c0 .4.3.7.7.7s.7-.3.7-.7V6c0-.4-.3-.7-.7-.7zm2.7 2c-.4 0-.7.3-.7.7v6.7c0 .4.3.7.7.7.4 0 .7-.3.7-.7V8c-.1-.4-.4-.7-.7-.7zM3.3 8c-.3 0-.6.3-.6.7v6c0 .4.3.7.7.7.3-.1.6-.4.6-.7v-6c0-.4-.3-.7-.7-.7z"/></svg>';
        break;
        case 'apple_podcast':
            return '<svg class="st-icon" width="20px" height="20px" viewBox="0 0 20 20" aria-label="' . esc_attr__( 'Apple Podcasts Icon', 'presto-blog' ) . '"><path fill="currentcolor" d="M10 0C5.1 0 1.1 4 1.1 8.9c0 2.9 1.4 5.5 3.6 7.1.3.2.5.4.8.5.3.2.8.1 1-.2.2-.3.1-.8-.2-1-.2-.1-.5-.3-.7-.5-1.8-1.4-3-3.6-3-6 0-4.2 3.4-7.5 7.5-7.5s7.5 3.4 7.5 7.5c0 2.5-1.2 4.7-3 6-.2.2-.5.3-.7.5-.3.2-.5.6-.3 1 .2.3.6.5 1 .3.3-.2.6-.4.8-.6 2.2-1.6 3.6-4.2 3.6-7.2C18.9 4 14.9 0 10 0zm0 2.8c-3.4 0-6.1 2.7-6.1 6.1 0 1.7.7 3.2 1.8 4.3.3.3.7.3 1 0s.3-.7 0-1c-.9-.9-1.4-2-1.4-3.3 0-2.6 2.1-4.7 4.7-4.7s4.7 2.1 4.7 4.7c0 1.3-.5 2.5-1.4 3.3-.3.3-.3.7 0 1 .3.3.7.3 1 0 1.1-1.1 1.8-2.6 1.8-4.3 0-3.3-2.7-6.1-6.1-6.1zm0 3.8C8.7 6.6 7.6 7.7 7.6 9s1.1 2.4 2.4 2.4 2.4-1.1 2.4-2.4-1.1-2.4-2.4-2.4zm0 5.6c-1.3 0-2.4 1.1-2.4 2.4v.5l.9 3.7c.2.7.8 1.2 1.5 1.2s1.3-.5 1.4-1.1l.9-3.7v-.1-.4c.1-1.4-1-2.5-2.3-2.5z"/></svg>';
        break;
        case 'patreon':
            return '<svg class="st-icon" width="20" height="20" viewBox="0 0 20 20" aria-label="' . esc_attr__( 'Patreon Icon', 'presto-blog' ) . '"><path fill="currentcolor" d="M20,7.6c0,4-3.2,7.2-7.2,7.2c-4,0-7.2-3.2-7.2-7.2c0-4,3.2-7.2,7.2-7.2C16.8,0.4,20,3.6,20,7.6z M0,19.6h3.5V0.4H0V19.6z"/></svg>';
        break;
        case 'alignable':
            return '<svg class="st-icon" width="20" height="20" viewBox="0 0 20 20" aria-label="' . esc_attr__( 'Alignable Icon', 'presto-blog' ) . '"><path fill="currentcolor" d="M19.5 6.7C18.1 2.8 14.3 0 9.9 0c-.7 0-1.4.1-2.1.3L6.6.6c.1.1.1.3.2.4.2.8.5 1.6.7 2.4.2.4.4.9.5 1.4.5 1.5 1.1 2.8 1.7 3.8.2.4.5.8.8 1.1.4.4.8.7 1.3.7.7 0 1.3-.6 1.9-1.4.5 1 1.1 2.3 1.5 3.5-.9.8-2 1.3-3.3 1.3-1 0-1.8-.3-2.6-.8-.3-.2-.7-.5-1-.8-1-.9-1.7-2.2-2.4-3.6-.3-.5-.5-1-.7-1.6C4.5 5.5 4 3.9 3.6 2.3c-.4.2-.7.6-1 .9C1 5 0 7.4 0 10c0 2.3.7 4.4 2 6.1.2.4.6.8.9 1.1.3-1.1.7-2.1 1-3.1.4-1.3.8-2.6 1.3-3.9.7 1.3 1.5 2.5 2.5 3.3-.2.6-.4 1.2-.6 1.7-.5 1.3-.9 2.7-1.4 4 .4.1.8.3 1.2.4 1 .3 2 .4 3 .4 2.7 0 5.2-1.1 7-2.8.4-.4.7-.7 1-1.1-.1-.3-.2-.7-.3-1-.3-.7-.5-1.5-.8-2.3-.2-.5-.3-.9-.5-1.4-.5-1.5-1.1-2.8-1.7-3.8-.2-.4-.5-.8-.8-1.1l-.3-.3c-.3-.3-.7-.4-1-.4-.7 0-1.3.6-1.9 1.4-.6-1-1.2-2.3-1.6-3.5.1-.1.2-.2.4-.3.9-.6 1.9-1 3-1 1 0 1.8.3 2.6.8.3.2.7.5 1 .8.9.9 1.7 2.2 2.3 3.5.3.5.5 1.1.7 1.6.3.7.6 1.4.8 2.1.2-.4.2-.8.2-1.2 0-1.1-.2-2.2-.5-3.3z"/></svg>';
        break;
        case 'skype':
            return '<svg class="st-icon" width="20" height="20" viewBox="0 0 20 20" aria-label="' . esc_attr__( 'Skype Icon', 'presto-blog' ) . '"><path fill="currentcolor" d="M5.7 0C2.6 0 0 2.5 0 5.6c0 1 .2 1.9.7 2.7-.1.6-.2 1.2-.2 1.8 0 5.2 4.3 9.4 9.6 9.4.5 0 1.1 0 1.6-.1.8.4 1.7.6 2.6.6 3.1 0 5.7-2.5 5.7-5.6 0-.8-.2-1.6-.5-2.4.1-.6.2-1.2.2-1.9 0-5.2-4.3-9.4-9.6-9.4-.5 0-1 0-1.5.1C7.7.3 6.7 0 5.7 0zM10 3.8c.8 0 1.5.1 2.1.3.6.2 1.1.4 1.5.7.4.3.7.6.9 1 .2.3.3.7.3 1 0 .3-.1.6-.4.9s-.5.3-.8.3c-.3 0-.6-.1-.8-.2-.2-.2-.4-.4-.6-.7-.2-.4-.5-.8-.8-1-.3-.2-.8-.3-1.5-.3s-1.2.1-1.6.4c-.4.2-.6.5-.6.8 0 .2.1.4.2.5.1.2.3.3.5.4.3.1.5.2.8.3.3.1.7.2 1.3.3.7.2 1.4.3 2 .5.6.2 1.1.4 1.6.7.4.3.8.6 1 1.1s.4 1 .4 1.6c0 .7-.2 1.4-.6 2-.4.6-1.1 1.1-1.9 1.4-.8.3-1.8.5-2.9.5-1.3 0-2.4-.2-3.3-.7-.6-.3-1.1-.8-1.5-1.3-.4-.6-.6-1.1-.6-1.6 0-.3.1-.6.4-.9.3-.2.6-.3.9-.3.3 0 .6.1.8.3.2.2.4.4.5.8.2.4.3.7.5.9.2.2.4.4.8.6.3.2.8.2 1.3.2.8 0 1.4-.2 1.8-.5.5-.3.7-.7.7-1.1 0-.4-.1-.6-.4-.9-.2-.2-.6-.4-1-.5-.4-.1-1-.3-1.7-.4-.9-.2-1.8-.4-2.4-.7-.4-.3-1-.7-1.3-1.2-.4-.5-.7-1.1-.7-1.8s.2-1.3.6-1.8c.4-.5 1-.9 1.8-1.2.8-.3 1.7-.4 2.7-.4z"/></svg>';
        break;
        case 'github':
            return '<svg class="st-icon" width="20" height="20" viewBox="0 0 20 20" aria-label="' . esc_attr__( 'GitHub Icon', 'presto-blog' ) . '"><path fill="currentcolor" d="M8.9,0.4C4.3,0.9,0.6,4.6,0.1,9.1c-0.5,4.7,2.2,8.9,6.3,10.5C6.7,19.7,7,19.5,7,19.1v-1.6c0,0-0.4,0.1-0.9,0.1c-1.4,0-2-1.2-2.1-1.9c-0.1-0.4-0.3-0.7-0.6-1C3.1,14.6,3,14.6,3,14.5c0-0.2,0.3-0.2,0.4-0.2c0.6,0,1.1,0.7,1.3,1c0.5,0.8,1.1,1,1.4,1c0.4,0,0.7-0.1,0.9-0.2c0.1-0.7,0.4-1.4,1-1.8c-2.3-0.5-4-1.8-4-4c0-1.1,0.5-2.2,1.2-3C5.1,7.1,5,6.6,5,5.9c0-0.4,0-1,0.3-1.6c0,0,1.4,0,2.8,1.3C8.6,5.4,9.3,5.3,10,5.3s1.4,0.1,2,0.3c1.3-1.3,2.8-1.3,2.8-1.3C15,4.9,15,5.5,15,5.9c0,0.8-0.1,1.2-0.2,1.4c0.7,0.8,1.2,1.8,1.2,3c0,2.2-1.7,3.5-4,4c0.6,0.5,1,1.4,1,2.3v2.6c0,0.3,0.3,0.6,0.7,0.5c3.7-1.5,6.3-5.1,6.3-9.3C20,4.4,14.9-0.3,8.9,0.4z"/></svg>';
        break;
        case 'gitlab':
            return '<svg class="st-icon" width="20" height="20" viewBox="0 0 20 20" aria-label="' . esc_attr__( 'GitLab Icon', 'presto-blog' ) . '"><path fill="currentcolor" d="M15.7.9c-.2 0-.4.1-.4.3l-2.2 6.7H6.9L4.8 1.2C4.7 1 4.5.9 4.4.9c-.2 0-.4.1-.5.3l-2.6 7L0 11.6c0 .2 0 .4.2.5l9.6 7h.1l9.6-7c.5-.1.5-.3.5-.5l-1.3-3.5-2.6-7c-.1-.1-.3-.2-.4-.2zM2.6 8.7h3.7l2.5 7.8-6.2-7.8zm11.1 0h3.7l-6.2 7.8 2.5-7.8zm-11.8.4l5.8 7.3L1 11.6l.9-2.5zm16.2 0l.9 2.4-6.7 4.9 5.8-7.3z"/></svg>';
        break;
        case 'youtube':
            return '<svg class="st-icon" width="20" height="20" viewbox="0 0 20 20" aria-label="' . esc_attr__( 'YouTube Icon', 'presto-blog' ) . '"><path fill="currentcolor" d="M15,0H5C2.2,0,0,2.2,0,5v10c0,2.8,2.2,5,5,5h10c2.8,0,5-2.2,5-5V5C20,2.2,17.8,0,15,0z M14.5,10.9l-6.8,3.8c-0.1,0.1-0.3,0.1-0.5,0.1c-0.5,0-1-0.4-1-1l0,0V6.2c0-0.5,0.4-1,1-1c0.2,0,0.3,0,0.5,0.1l6.8,3.8c0.5,0.3,0.7,0.8,0.4,1.3C14.8,10.6,14.6,10.8,14.5,10.9z"/></svg>';
        break;
        case 'vimeo':
            return '<svg class="st-icon" width="20" height="20" viewBox="0 0 20 20" aria-label="' . esc_attr__( 'Vimeo Icon', 'presto-blog' ) . '"><path fill="currentcolor" d="M20,5.3c-0.1,1.9-1.4,4.6-4.1,8c-2.7,3.5-5,5.3-6.9,5.3c-1.2,0-2.2-1.1-3-3.2C4.5,9.7,3.8,6.3,2.5,6.3c-0.2,0-0.7,0.3-1.6,0.9L0,6c2.3-2,4.5-4.3,5.9-4.4c1.6-0.2,2.5,0.9,2.9,3.2c1.3,8.1,1.8,9.3,4.2,5.7c0.8-1.3,1.3-2.3,1.3-3c0.2-2-1.6-1.9-2.8-1.4c1-3.2,2.9-4.8,5.6-4.7C19.1,1.4,20.1,2.7,20,5.3L20,5.3z"/></svg>';
        break;
        case 'dtube':
            return '<svg class="st-icon" width="20" height="20" viewBox="0 0 20 20" aria-label="' . esc_attr__( 'DTube Icon', 'presto-blog' ) . '"><path fill="currentcolor" d="M18.2,6c-0.4-1.2-1.1-2.3-1.9-3.2c-0.8-0.9-1.8-1.6-2.9-2C12.3,0.2,11,0,9.6,0H1.1v20h8.2c1.3,0,2.4-0.2,3.4-0.5c1-0.3,1.9-0.8,2.7-1.4c1.1-0.9,2-2,2.6-3.3c0.6-1.4,0.9-2.9,0.9-4.7C18.9,8.6,18.7,7.2,18.2,6z M6.1,14.5v-9l7.8,4.5L6.1,14.5z"/></svg>';
        break;
        case 'vk':
            return '<svg class="st-icon" width="20px" height="20px" viewBox="0 0 20 20" aria-label="' . esc_attr__( 'VKontakte Icon', 'presto-blog' ) . '"><path fill="currentcolor" d="M19.2,4.8H16c-0.3,0-0.5,0.1-0.6,0.4c0,0-1.3,2.4-1.7,3.2c-1.1,2.2-1.8,1.5-1.8,0.5V5.4c0-0.6-0.5-1.1-1.1-1.1H8.2C7.6,4.3,6.9,4.6,6.5,5.1c0,0,1.2-0.2,1.2,1.5c0,0.4,0,1.6,0,2.6c0,0.4-0.3,0.7-0.7,0.7c-0.2,0-0.4-0.1-0.6-0.2c-1-1.4-1.8-2.9-2.5-4.5C4,5,3.7,4.8,3.5,4.8c-0.7,0-2.1,0-2.9,0C0.2,4.8,0,5,0,5.3c0,0.1,0,0.1,0,0.2C0.9,8,4.8,15.7,9.2,15.7H11c0.4,0,0.7-0.3,0.7-0.7v-1.1c0-0.4,0.3-0.7,0.7-0.7c0.2,0,0.4,0.1,0.5,0.2l2.2,2.1c0.2,0.2,0.5,0.3,0.7,0.3h2.9c1.4,0,1.4-1,0.6-1.7c-0.5-0.5-2.5-2.6-2.5-2.6c-0.3-0.4-0.4-0.9-0.1-1.3c0.6-0.8,1.7-2.2,2.1-2.8C19.6,6.5,20.7,4.8,19.2,4.8z"/></svg>';
        break;
        case 'ok':
            return '<svg class="st-icon" width="20px" height="20px" viewBox="0 0 20 20" aria-label="' . esc_attr__( 'Odnoklassniki Icon', 'presto-blog' ) . '"><path fill="currentcolor" d="M8.2,6.5c0-1,0.8-1.8,1.8-1.8s1.8,0.8,1.8,1.8c0,1-0.8,1.8-1.8,1.8S8.2,7.5,8.2,6.5L8.2,6.5z M20,2.1v15.7c0,1.2-1,2.1-2.1,2.1H2.1C1,20,0,19,0,17.9V2.1C0,1,1,0,2.1,0h15.7C19,0,20,1,20,2.1z M6.4,6.5c0,2,1.6,3.6,3.6,3.6s3.6-1.6,3.6-3.6c0-2-1.6-3.6-3.6-3.6S6.4,4.5,6.4,6.5z M14.2,10.5c-0.2-0.4-0.8-0.8-1.5-0.2c0,0-1,0.8-2.6,0.8s-2.6-0.8-2.6-0.8C6.6,9.8,6,10.1,5.8,10.5c-0.4,0.7,0,1.1,1,1.7c0.8,0.5,1.8,0.7,2.5,0.8l-0.6,0.6c-0.8,0.8-1.6,1.6-2.1,2.1c-0.8,0.8,0.5,2,1.3,1.3l2.1-2.1c0.8,0.8,1.6,1.6,2.1,2.1c0.8,0.8,2.1-0.5,1.3-1.3l-2.1-2.1l-0.6-0.6c0.7-0.1,1.7-0.3,2.5-0.8C14.1,11.6,14.5,11.2,14.2,10.5z"/></svg>';
        break;
        case 'rss':
            return '<svg class="st-icon" width="20" height="20" viewBox="0 0 20 20" aria-label="' . esc_attr__( 'RSS Icon', 'presto-blog' ) . '"><path fill="currentcolor" d="M17.9,0H2.1C1,0,0,1,0,2.1v15.7C0,19,1,20,2.1,20h15.7c1.2,0,2.1-1,2.1-2.1V2.1C20,1,19,0,17.9,0z M5,17.1c-1.2,0-2.1-1-2.1-2.1s1-2.1,2.1-2.1s2.1,1,2.1,2.1S6.2,17.1,5,17.1z M12,17.1h-1.5c-0.3,0-0.5-0.2-0.5-0.5c-0.2-3.6-3.1-6.4-6.7-6.7c-0.3,0-0.5-0.2-0.5-0.5V8c0-0.3,0.2-0.5,0.5-0.5c4.9,0.3,8.9,4.2,9.2,9.2C12.6,16.9,12.3,17.1,12,17.1L12,17.1z M16.6,17.1h-1.5c-0.3,0-0.5-0.2-0.5-0.5c-0.2-6.1-5.1-11-11.2-11.2c-0.3,0-0.5-0.2-0.5-0.5V3.4c0-0.3,0.2-0.5,0.5-0.5c7.5,0.3,13.5,6.3,13.8,13.8C17.2,16.9,16.9,17.1,16.6,17.1L16.6,17.1z"/></svg>';
        break;
        case 'facebook_group':
            return '<svg class="st-icon" width="20px" height="20px" viewBox="0 0 20 20" aria-label="' . esc_attr__( 'Facebook Group Icon', 'presto-blog' ) . '"><path fill="currentcolor" d="M3.3,18.4c-0.2-0.5,0.3-2.8,0.7-3.7c0.5-1.1,1.6-2,2.5-2.3c0.6-0.2,0.7-0.2,2.1,0.5l1.4,0.7l1.4-0.7c0.8-0.4,1.5-0.7,1.8-0.7c0.5,0,1.8,0.9,2.4,1.6c0.6,0.9,1.1,2.3,1.2,3.7l0,1.1l-6.7,0C4,18.7,3.4,18.6,3.3,18.4z M0.1,12.8c-0.4-0.9,0.6-3.4,1.6-4.1c0.8-0.5,1.5-0.5,2.5,0.1c0.6,0.4,0.9,0.5,1.1,0.3C5.6,9,5.7,9,5.9,9.3c0.2,0.2,0.6,0.6,0.9,1c0.6,0.6,0.6,0.7-0.4,1.1c-0.4,0.1-1.1,0.5-1.6,1l-0.9,0.7H2.1C0.5,13.1,0.2,13,0.1,12.8z M15.3,12.4c-0.4-0.4-1.1-0.8-1.5-1c-1.1-0.4-1.1-0.5-0.5-1.1c0.3-0.3,0.7-0.7,0.9-1C14.4,9,14.5,9,14.8,9.1c0.2,0.1,0.5,0,1.1-0.3c0.5-0.3,1.1-0.5,1.4-0.5c1.3,0,2.6,1.8,2.7,3.7l0,1l-2,0l-2,0L15.3,12.4z M8.4,10.6C7,9.9,6,8.4,6,6.9c0-2.1,2-4.1,4.1-4.1s4.1,2,4.1,4.1S12.1,11,10,11C9.6,11,8.9,10.8,8.4,10.6z M3.5,6.8c-1.7-1-1.9-3.5-0.4-4.7c1.1-0.9,2.5-1,3.6-0.2c1,0.7,1,0.9,0.2,1.6c-0.8,0.7-1.4,1.8-1.5,3C5.2,7.2,5.2,7.3,4.7,7.3C4.4,7.3,3.9,7.1,3.5,6.8z M14.8,6.5c-0.2-1.2-0.7-2.3-1.5-3c-0.8-0.7-0.8-0.9,0.2-1.6C15.4,0.6,18,2,18,4.3c0,1.5-1.4,3-2.7,3C14.9,7.3,14.9,7.2,14.8,6.5z"/></svg>';
        break;
        case 'discord':
            return '<svg class="st-icon" width="20px" height="20px" viewBox="0 0 20 20" aria-label="' . esc_attr__( 'Discord Icon', 'presto-blog' ) . '"><path fill="currentcolor" d="M17.2,4.2c-1.7-1.4-4.5-1.6-4.6-1.6c-0.2,0-0.4,0.1-0.4,0.3c0,0-0.1,0.1-0.1,0.4c1.1,0.2,2.6,0.6,3.8,1.4C16.1,4.7,16.2,5,16,5.2c-0.1,0.1-0.2,0.2-0.4,0.2c-0.1,0-0.2,0-0.2-0.1C13.3,4,10.5,3.9,10,3.9S6.7,4,4.6,5.3C4.4,5.5,4.1,5.4,4,5.2C3.8,5,3.9,4.7,4.1,4.6c1.3-0.8,2.7-1.2,3.8-1.4C7.9,3,7.8,2.9,7.8,2.9C7.7,2.7,7.5,2.6,7.4,2.6c-0.1,0-2.9,0.2-4.6,1.7C1.8,5.1,0,10.1,0,14.3c0,0.1,0,0.2,0.1,0.2c1.3,2.2,4.7,2.8,5.5,2.8c0,0,0,0,0,0c0.1,0,0.3-0.1,0.4-0.2l0.8-1.1c-2.1-0.6-3.2-1.5-3.3-1.6c-0.2-0.2-0.2-0.4,0-0.6c0.2-0.2,0.4-0.2,0.6,0c0,0,2,1.7,6,1.7c4,0,6-1.7,6-1.7c0.2-0.2,0.5-0.1,0.6,0c0.2,0.2,0.1,0.5,0,0.6c-0.1,0.1-1.2,1-3.3,1.6l0.8,1.1c0.1,0.1,0.2,0.2,0.4,0.2c0,0,0,0,0,0c0.8,0,4.2-0.6,5.5-2.8c0-0.1,0.1-0.1,0.1-0.2C20,10.1,18.2,5.1,17.2,4.2z M7.2,12.6c-0.8,0-1.5-0.8-1.5-1.7s0.7-1.7,1.5-1.7c0.8,0,1.5,0.8,1.5,1.7S8,12.6,7.2,12.6z M12.8,12.6c-0.8,0-1.5-0.8-1.5-1.7s0.7-1.7,1.5-1.7c0.8,0,1.5,0.8,1.5,1.7S13.7,12.6,12.8,12.6z"/></svg>';
        break;
        case 'tripadvisor':
            return '<svg class="st-icon" width="20px" height="20px" viewBox="0 0 20 20" aria-label="' . esc_attr__( 'TripAdvisor Icon', 'presto-blog' ) . '"><path fill="currentcolor" d="M5.9 10.7c0 .4-.4.8-.8.8s-.8-.4-.8-.8.4-.8.8-.8.8.3.8.8zm1.7 0c0 1.3-1.1 2.4-2.4 2.4S2.7 12 2.7 10.7c0-1.3 1.1-2.4 2.4-2.4s2.5 1 2.5 2.4zm-.9 0c0-.9-.7-1.6-1.6-1.6-.9 0-1.6.7-1.6 1.6 0 .9.7 1.6 1.6 1.6.9 0 1.6-.7 1.6-1.6zm8.2-.8c-.4 0-.8.4-.8.8s.4.8.8.8.8-.4.8-.8c0-.5-.4-.8-.8-.8zm2.4.8c0 1.3-1.1 2.4-2.4 2.4s-2.4-1.1-2.4-2.4c0-1.3 1.1-2.4 2.4-2.4s2.4 1 2.4 2.4zm-.8 0c0-.9-.7-1.6-1.6-1.6-.9 0-1.6.7-1.6 1.6 0 .9.7 1.6 1.6 1.6.9 0 1.6-.7 1.6-1.6zm1.6 4.1c-2.1 1.7-5.2 1.3-6.9-.8l-.9 1.5c0 .1-.1.1-.1.1-.2.1-.4.1-.6-.1L8.7 14c-1.7 2.1-4.7 2.5-6.9.8-2-1.7-2.4-4.8-.8-6.9-.1-.5-.4-1-.7-1.4 0-.1-.1-.2-.1-.3 0-.2.2-.4.4-.4h3.1c3.9-2.2 8.7-2.2 12.6 0h3.1c.1 0 .2 0 .3.1.2.1.2.4 0 .6-.3.4-.6.9-.8 1.4 1.7 2.1 1.3 5.2-.8 6.9zm-8.9-4.1c0-2.2-1.8-4.1-4.1-4.1h-1C2.3 7.1 1 8.8 1 10.7c0 2.2 1.9 4 4.1 4 2.3.1 4.1-1.8 4.1-4zm6.6-4h-.2c-.2 0-.5-.1-.7-.1-2.2 0-4 1.7-4.1 3.9 0 .7.2 1.4.5 2.1.1.1.1.2.2.3.8 1.1 2 1.8 3.4 1.8 1.9 0 3.5-1.3 3.9-3.1.5-2.1-.8-4.3-3-4.9z"/></svg>';
        break;
        case 'foursquare':
            return '<svg class="st-icon" width="20px" height="20px" viewBox="0 0 20 20" aria-label="' . esc_attr__( 'Foursquare Icon', 'presto-blog' ) . '"><path fill="currentcolor" d="M14.8 2.9l-.4 2.3c-.1.3-.4.5-.7.5H9.5c-.5 0-.8.4-.8.8V7c0 .5.3.8.8.8H13c.3 0 .7.4.6.7l-.4 2.3c0 .2-.3.5-.7.5H9.6c-.5 0-.7.1-1 .5-.3.4-3.5 4.2-3.5 4.2H5V2.8c0-.3.3-.6.6-.6h8.6c.4 0 .7.3.6.7zm.3 9.1c.1-.5 1.5-7.3 1.9-9.5M15.4 0H4.7C3.3 0 2.8 1.1 2.8 1.8v16.9c0 .8.4 1.1.7 1.2.2.1.9.2 1.3-.3 0 0 5-5.8 5.1-5.9.1-.1.1-.1.3-.1h3.3c1.4 0 1.6-1 1.7-1.5.1-.5 1.5-7.3 1.9-9.5C17.4.9 17 0 15.4 0z"/></svg>';
        break;
        case 'yelp':
            return '<svg class="st-icon" width="20px" height="20px" viewBox="0 0 20 20" aria-label="' . esc_attr__( 'Yelp Icon', 'presto-blog' ) . '"><path fill="currentcolor" d="M18.8 14.4c0 .4-.3.8-.3.9l-2.1 2.9-.1.1c-.1 0-.5.3-1 .3s-1-.6-1.1-.7l-2.7-4.2c-.3-.3-.3-1 .1-1.5.3-.3.5-.3.9-.3h.3l5 1.5c.3.1 1 .3 1 1zm-6.1-3.3l5-1.4c.2-.1.9-.3 1-.9.2-.5-.1-1-.2-1 0 0 0-.1-.1-.1L16 5.2c0-.1-.3-.5-1-.5s-1 .6-1 .7l-2.8 4.2c-.2.3-.3.8 0 1.2.3.2.6.3 1.1.3h.4zM9.9.2C9.3 0 8.9 0 8.6.1L4.4 1.4c-.1 0-.5.2-.9.6-.4.8.4 1.6.4 1.6l4.4 5.5c.1.1.4.4 1 .4h.3c.7-.2 1-.9 1-1.3V1.6c-.1-.2-.2-1.1-.7-1.4zM8 12.6c.3-.1.7-.3.7-1.1s-.8-1.1-.9-1.2L3.4 8.2c-.1 0-1-.3-1.3-.1-.2.1-.7.5-.7.9l-.3 3.3c0 .2 0 .7.2 1 .1.2.3.4.8.4.3 0 .6-.1.6-.1l5.1-1c.2.1.2 0 .2 0zm1.8.3c-.2-.1-.3-.1-.4-.1-.5 0-1 .3-1 .4l-3.5 3.6c-.1.2-.5.8-.3 1.3.2.4.3.7.8.9l3.5 1h.4c.2 0 .3 0 .4-.1.5-.2.7-.8.7-1.2l.1-4.9c0-.2-.2-.7-.7-.9z"/></svg>';
        break;
        case 'hacker_news':
            return '<svg class="st-icon" width="20px" height="20px" viewBox="0 0 20 20" aria-label="' . esc_attr__( 'Hacker News Icon', 'presto-blog' ) . '"><path fill="currentcolor" d="M0,0v20h20V0H0z M11.2,11.8v4.7H8.8v-4.7L4.7,4.1h1.9l3.4,6l3.4-6h1.9L11.2,11.8z"/></svg>';
        break;
        case 'xing':
            return '<svg class="st-icon" width="20" height="20" viewBox="0 0 20 20" aria-label="' . esc_attr__( 'Xing Icon', 'presto-blog' ) . '"><path fill="currentcolor" d="M16.8,0H3.2C1.4,0,0,1.4,0,3.2v13.6C0,18.6,1.4,20,3.2,20h13.6c1.8,0,3.2-1.4,3.2-3.2V3.2C20,1.4,18.6,0,16.8,0z M6.2,13.3H3.8c-0.2,0-0.3-0.3-0.3-0.4L6,8.4c0.1-0.1,0.1-0.2,0-0.3L4.5,5.4C4.4,5.3,4.5,5,4.7,5H7c0.1,0,0.2,0.1,0.3,0.2L9,8.2c0.1,0.1,0.1,0.2,0,0.3l-2.6,4.7C6.4,13.2,6.2,13.3,6.2,13.3z M16.3,2.9l-4.7,8.6c-0.1,0.1-0.1,0.2,0,0.3l3,5.3c0.1,0.2,0,0.4-0.3,0.4h-2.3c-0.1,0-0.2-0.1-0.3-0.2l-3.2-5.6c-0.1-0.1-0.1-0.2,0-0.3l4.8-8.9c0.1,0,0.3-0.1,0.3-0.1h2.3C16.3,2.5,16.4,2.8,16.3,2.9z"/></svg>';
        break;
        case 'whatsapp':
            return '<svg class="st-icon" width="20px" height="20px" viewBox="0 0 20 20" aria-label="' . esc_attr__( 'WhatsApp Icon', 'presto-blog' ) . '"><path fill="currentcolor" d="M10,0C4.5,0,0,4.5,0,10c0,1.9,0.5,3.6,1.4,5.1L0.1,20l5-1.3C6.5,19.5,8.2,20,10,20c5.5,0,10-4.5,10-10S15.5,0,10,0zM6.6,5.3c0.2,0,0.3,0,0.5,0c0.2,0,0.4,0,0.6,0.4c0.2,0.5,0.7,1.7,0.8,1.8c0.1,0.1,0.1,0.3,0,0.4C8.3,8.2,8.3,8.3,8.1,8.5C8,8.6,7.9,8.8,7.8,8.9C7.7,9,7.5,9.1,7.7,9.4c0.1,0.2,0.6,1.1,1.4,1.7c0.9,0.8,1.7,1.1,2,1.2c0.2,0.1,0.4,0.1,0.5-0.1c0.1-0.2,0.6-0.7,0.8-1c0.2-0.2,0.3-0.2,0.6-0.1c0.2,0.1,1.4,0.7,1.7,0.8s0.4,0.2,0.5,0.3c0.1,0.1,0.1,0.6-0.1,1.2c-0.2,0.6-1.2,1.1-1.7,1.2c-0.5,0-0.9,0.2-3-0.6c-2.5-1-4.1-3.6-4.2-3.7c-0.1-0.2-1-1.3-1-2.6c0-1.2,0.6-1.8,0.9-2.1C6.1,5.4,6.4,5.3,6.6,5.3z"/></svg>';
        break;
        case 'flipboard':
            return '<svg class="st-icon" width="20px" height="20px" viewBox="0 0 20 20" aria-label="' . esc_attr__( 'Flipboard Icon', 'presto-blog' ) . '"><path fill="currentcolor" d="M0 0v20h20V0H0zm16 8h-4v4H8v4H4V4h12v4z"/></svg>';
        break;
        case 'viber':
            return '<svg class="st-icon" width="20px" height="20px" viewBox="0 0 20 20" aria-label="' . esc_attr__( 'Viber Icon', 'presto-blog' ) . '"><path fill="currentcolor" d="M18.6,4.4c-0.3-1.2-1-2.2-2-2.9c-1.2-0.9-2.7-1.2-3.9-1.4C11,0,9.4-0.1,8,0.1C6.6,0.3,5.5,0.6,4.6,1c-1.9,0.9-3,2.2-3.3,4.1C1.1,6,1,6.9,0.9,7.6c-0.2,1.8,0,3.4,0.4,4.9c0.4,1.5,1.2,2.5,2.2,3.2c0.3,0.2,0.6,0.3,1,0.4c0.2,0.1,0.3,0.1,0.5,0.2v2.9C5,19.7,5.3,20,5.7,20l0,0c0.2,0,0.4-0.1,0.5-0.2l2.7-2.6C9,17,9,17,9.1,17c0.9,0,1.9-0.1,2.8-0.1c1.1-0.1,2.5-0.2,3.7-0.7c1.1-0.5,2-1.2,2.5-2.2c0.5-1.1,0.8-2.2,0.9-3.5C19.3,8.2,19.1,6.2,18.6,4.4z M13.9,13.1c-0.3,0.4-0.7,0.8-1.2,1c-0.4,0.1-0.7,0.1-1.1,0C8.8,12.8,6.5,10.9,5,8.1C4.7,7.5,4.5,6.9,4.2,6.3C4.2,6.2,4.2,6,4.2,5.9c0-1,0.8-1.5,1.5-1.7c0.3-0.1,0.5,0,0.8,0.2c0.6,0.6,1.1,1.2,1.4,2C8,6.7,8,7,7.7,7.2C7.6,7.3,7.6,7.3,7.5,7.4C6.9,7.8,6.8,8.2,7.2,8.9c0.5,1.2,1.5,1.9,2.6,2.4c0.3,0.1,0.6,0.1,0.8-0.2c0,0,0.1-0.1,0.1-0.1c0.5-0.8,1.1-0.7,1.8-0.3c0.4,0.3,0.8,0.6,1.2,0.9C14.3,12.1,14.3,12.5,13.9,13.1z M10.4,5.1c-0.2,0-0.3,0-0.5,0C9.7,5.2,9.5,5,9.4,4.8c0-0.3,0.1-0.5,0.4-0.5c0.2,0,0.4-0.1,0.6-0.1c2.1,0,3.7,1.7,3.7,3.7c0,0.2,0,0.4-0.1,0.6c0,0.2-0.2,0.4-0.5,0.4c0,0-0.1,0-0.1,0c-0.3,0-0.4-0.3-0.4-0.5c0-0.2,0-0.3,0-0.5C13.2,6.4,12,5.1,10.4,5.1z M12.5,8.2c0,0.3-0.2,0.5-0.5,0.5s-0.5-0.2-0.5-0.5c0-0.8-0.6-1.4-1.4-1.4c-0.3,0-0.5-0.2-0.5-0.5c0-0.3,0.2-0.5,0.5-0.5C11.4,5.8,12.5,6.9,12.5,8.2zM15.7,8.8c-0.1,0.2-0.2,0.4-0.5,0.4c0,0-0.1,0-0.1,0c-0.3-0.1-0.4-0.3-0.4-0.6c0.1-0.3,0.1-0.6,0.1-0.9c0-2.3-1.9-4.2-4.2-4.2c-0.3,0-0.6,0-0.9,0.1C9.5,3.6,9.2,3.5,9.2,3.2C9.1,2.9,9.3,2.7,9.5,2.6c0.4-0.1,0.8-0.1,1.1-0.1c2.8,0,5.2,2.3,5.2,5.2C15.8,8,15.8,8.4,15.7,8.8z"/></svg>';
        break;
        case 'line':
            return '<svg class="st-icon" width="20px" height="20px" viewBox="0 0 20 20" aria-label="' . esc_attr__( 'Line Icon', 'presto-blog' ) . '"><path fill="currentcolor" d="M16.1 8.2c.3 0 .5.2.5.5s-.2.5-.5.5h-1.5v.9h1.5c.3 0 .5.2.5.5s-.2.5-.5.5h-2c-.3 0-.5-.2-.5-.5v-4c0-.3.2-.5.5-.5h2c.3 0 .5.2.5.5s-.2.5-.5.5h-1.5V8h1.5zm-3.2 2.5c0 .2-.1.4-.4.5h-.2c-.2 0-.3-.1-.4-.2l-2-2.8v2.5c0 .3-.2.5-.5.5s-.5-.2-.5-.5v-4c0-.2.1-.4.4-.5h.2c.2 0 .3.1.4.2L12 9.2V6.8c0-.3.2-.5.5-.5s.5.2.5.5v3.9zm-4.8 0c0 .3-.2.5-.5.5s-.5-.2-.5-.5v-4c0-.3.2-.5.5-.5s.5.2.5.5v4zm-2 .6h-2c-.3 0-.5-.2-.5-.5v-4c0-.3.2-.5.5-.5s.5.2.5.5v3.5h1.5c.3 0 .5.2.5.5 0 .2-.2.5-.5.5M20 8.6C20 4.1 15.5.5 10 .5S0 4.1 0 8.6c0 4 3.6 7.4 8.4 8 .3.1.8.2.9.5.1.3.1.6 0 .9l-.1.9c0 .3-.2 1 .9.5 1.1-.4 5.8-3.4 7.9-5.8 1.3-1.6 2-3.2 2-5"/></svg>';
        break;
        case 'weibo':
            return '<svg class="st-icon" width="20" height="20" viewBox="0 0 20 20" aria-label="' . esc_attr__( 'Weibo Icon', 'presto-blog' ) . '"><path fill="currentcolor" d="M15.9,7.6c0.3-0.9-0.5-1.8-1.5-1.6c-0.9,0.2-1.1-1.1-0.3-1.3c2-0.4,3.6,1.4,3,3.3C16.9,8.8,15.6,8.4,15.9,7.6z M8.4,18.1c-4.2,0-8.4-2-8.4-5.3C0,11,1.1,9,3,7.2c3.9-3.9,7.9-3.9,6.8-0.2c-0.2,0.5,0.5,0.2,0.5,0.2c3.1-1.3,5.5-0.7,4.5,2c-0.1,0.4,0,0.4,0.3,0.5C20.3,11.3,16.4,18.1,8.4,18.1L8.4,18.1zM14,12.4c-0.2-2.2-3.1-3.7-6.4-3.3C4.3,9.4,1.8,11.4,2,13.6s3.1,3.7,6.4,3.3C11.7,16.6,14.2,14.6,14,12.4zM13.6,2c-1,0.2-0.7,1.7,0.3,1.5c2.8-0.6,5.3,2.1,4.4,4.8c-0.3,0.9,1.1,1.4,1.5,0.5C21,4.9,17.6,1.2,13.6,2L13.6,2z M10.5,14.2c-0.7,1.5-2.6,2.3-4.3,1.8c-1.6-0.5-2.3-2.1-1.6-3.5c0.7-1.4,2.5-2.2,4-1.8C10.4,11.1,11.2,12.7,10.5,14.2zM7.2,13c-0.5-0.2-1.2,0-1.5,0.5C5.3,14,5.5,14.6,6,14.8c0.5,0.2,1.2,0,1.5-0.5C7.8,13.8,7.7,13.2,7.2,13zM8.4,12.5c-0.2-0.1-0.4,0-0.6,0.2c-0.1,0.2-0.1,0.4,0.1,0.5c0.2,0.1,0.5,0,0.6-0.2C8.7,12.8,8.6,12.6,8.4,12.5z"/></svg>';
        break;
        case 'tumblr':
            return '<svg class="st-icon" width="20" height="20" viewBox="0 0 20 20" aria-label="' . esc_attr__( 'Tumblr Icon', 'presto-blog' ) . '"><path fill="currentcolor" d="M18,0H2C0.9,0,0,0.9,0,2v16c0,1.1,0.9,2,2,2h16c1.1,0,2-0.9,2-2V2C20,0.9,19.1,0,18,0z M15,15.9c0,0,0,0.1-0.1,0.1c0,0-1.4,1-3.9,1c-3,0-3-3.6-3-4V9H6.2C6.1,9,6,8.9,6,8.8V7.2C6,7.1,6,7,6.1,7C6.1,7,9,5.7,9,3.2C9,3.1,9.1,3,9.2,3h1.7C10.9,3,11,3.1,11,3.2V7h2.8C13.9,7,14,7.1,14,7.2v1.7C14,8.9,13.9,9,13.8,9H11v4c0,0.1-0.1,1.3,1.2,1.3c1.1,0,2.5-0.3,2.5-0.3c0.1,0,0.1,0,0.2,0c0.1,0,0.1,0.1,0.1,0.2V15.9z"/></svg>';
        break;
        case 'qq':
            return '<svg class="st-icon" width="20" height="20" viewBox="0 0 20 20" aria-label="' . esc_attr__( 'QQ Icon', 'presto-blog' ) . '"><path fill="currentcolor" d="M18.2,16.4c-0.5,0.1-1.8-2.1-1.8-2.1c0,1.2-0.6,2.8-2,4c0.7,0.2,2.1,0.7,1.8,1.3C16,20.2,11.3,20,10,19.8c-1.3,0.2-5.9,0.3-6.2-0.2c-0.4-0.6,1.1-1.1,1.8-1.3c-1.4-1.2-2-2.8-2-4c0,0-1.3,2.1-1.8,2.1c-0.2,0-0.5-1.2,0.4-3.9c0.4-1.3,0.9-2.4,1.6-4.1C3.6,3.8,5.5,0,10,0c4.4,0,6.4,3.8,6.3,8.4c0.7,1.8,1.2,2.8,1.6,4.1C18.7,15.3,18.4,16.4,18.2,16.4L18.2,16.4z"/></svg>';
        break;
        case 'wechat':
            return '<svg class="st-icon" width="20" height="20" viewBox="0 0 20 20" aria-label="' . esc_attr__( 'WeChat Icon', 'presto-blog' ) . '"><path fill="currentcolor" d="M13.5,6.8c0.2,0,0.5,0,0.7,0c-0.6-2.9-3.7-5-7.1-5C3.2,1.9,0,4.5,0,7.9c0,1.9,1.1,3.5,2.8,4.8l-0.7,2.1l2.5-1.2c0.9,0.2,1.6,0.4,2.5,0.4c0.2,0,0.4,0,0.7,0c-0.1-0.5-0.2-1-0.2-1.5C7.5,9.3,10.2,6.8,13.5,6.8L13.5,6.8zM9.7,4.9c0.5,0,0.9,0.4,0.9,0.9c0,0.5-0.4,0.9-0.9,0.9c-0.5,0-1.1-0.4-1.1-0.9C8.7,5.2,9.2,4.9,9.7,4.9zM4.8,6.6c-0.5,0-1.1-0.4-1.1-0.9c0-0.5,0.5-0.9,1.1-0.9c0.5,0,0.9,0.4,0.9,0.9C5.7,6.3,5.3,6.6,4.8,6.6z M20,12.3c0-2.8-2.8-5.1-6-5.1c-3.4,0-6,2.3-6,5.1s2.6,5.1,6,5.1c0.7,0,1.4-0.2,2.1-0.4l1.9,1.1l-0.5-1.8C18.9,15.3,20,13.9,20,12.3zM12,11.4c-0.4,0-0.7-0.4-0.7-0.7c0-0.4,0.4-0.7,0.7-0.7c0.5,0,0.9,0.4,0.9,0.7C12.9,11.1,12.6,11.4,12,11.4zM15.9,11.4c-0.4,0-0.7-0.4-0.7-0.7c0-0.4,0.4-0.7,0.7-0.7c0.5,0,0.9,0.4,0.9,0.7C16.8,11.1,16.5,11.4,15.9,11.4z"/></svg>';
        break;
        case 'strava':
            return '<svg class="st-icon" width="20" height="20" viewBox="0 0 20 20" aria-label="' . esc_attr__( 'Strava Icon', 'presto-blog' ) . '"><path fill="currentcolor" d="M12.3,13.9l-1.4-2.7h2.8L12.3,13.9z M20,3v14c0,1.7-1.3,3-3,3H3c-1.7,0-3-1.3-3-3V3c0-1.7,1.3-3,3-3h14C18.7,0,20,1.3,20,3zM15.8,11.1h-2.1L9,2l-4.7,9.1H7L9,7.5l1.9,3.6H8.8l3.5,6.9L15.8,11.1z"/></svg>';
        break;
        case 'flickr':
            return '<svg class="st-icon" width="20" height="20" viewBox="0 0 20 20" aria-label="' . esc_attr__( 'Flickr Icon', 'presto-blog' ) . '"><path fill="currentcolor" d="M4.7 14.7C2.1 14.8 0 12.6 0 10c0-2.5 2.1-4.7 4.8-4.7 2.6 0 4.7 2.1 4.7 4.8 0 2.6-2.2 4.7-4.8 4.6z"/><path fill="currentcolor" d="M15.3 5.3C18 5.3 20 7.5 20 10c0 2.6-2.1 4.7-4.7 4.7-2.5 0-4.7-2-4.7-4.7-.1-2.6 2-4.7 4.7-4.7z"/></svg>';
        break;
        case 'phone':
            return '<svg class="st-icon" width="20" height="20" viewBox="0 0 20 20" aria-label="' . esc_attr__( 'Phone Icon', 'presto-blog' ) . '"><path fill="currentcolor" d="M4.8,0C2.1,0,0,2.1,0,4.8v10.5C0,17.9,2.1,20,4.8,20h10.5c2.6,0,4.8-2.1,4.8-4.8V4.8C20,2.1,17.9,0,15.2,0H4.8z M6.7,3.8C7,3.8,7.2,4,7.4,4.3C7.6,4.6,7.9,5,8.3,5.6c0.3,0.5,0.4,1.2,0.1,1.8l-0.7,1C7.4,8.7,7.4,9,7.5,9.3c0.2,0.5,0.6,1.2,1.3,1.9c0.7,0.7,1.4,1.1,1.9,1.3c0.3,0.1,0.6,0.1,0.9-0.1l1-0.7c0.6-0.3,1.3-0.3,1.8,0.1c0.6,0.4,1.1,0.7,1.3,0.9c0.3,0.2,0.4,0.4,0.4,0.7c0.1,1.7-1.2,2.4-1.6,2.4c-0.3,0-3.4,0.4-7-3.2s-3.2-6.8-3.2-7C4.3,5.1,5,3.8,6.7,3.8z"/></svg>';
        break;
        case 'email':
            return '<svg class="st-icon" width="20" height="20" viewBox="0 0 20 20" aria-label="' . esc_attr__( 'Email Icon', 'presto-blog' ) . '"><path fill="currentcolor" d="M10,10.1L0,4.7C0.1,3.2,1.4,2,3,2h14c1.6,0,2.9,1.2,3,2.8L10,10.1z M10,11.8c-0.1,0-0.2,0-0.4-0.1L0,6.4V15c0,1.7,1.3,3,3,3h4.9h4.3H17c1.7,0,3-1.3,3-3V6.4l-9.6,5.2C10.2,11.7,10.1,11.7,10,11.8z"/></svg>';
        break;
    }
}
endif;

if( ! function_exists( 'presto_blog_sidebar' ) ) :
/**
 * Return sidebar layouts for pages/posts
*/
function presto_blog_sidebar( $class = false ){
    $return = false;
    $layout = get_theme_mod( 'layout_style', 'no-sidebar' );
    
    if( ( is_front_page() && is_home() ) || is_home() ){ 
        $home_layout  = get_theme_mod( 'blog_sidebar_layout', 'no-sidebar' );
        if( $home_layout == 'no-sidebar' ){
            $return = $class ? 'full-width' : false;
        }elseif( is_active_sidebar( 'sidebar' ) ){                       
            if( $class ){                
                if( $home_layout == 'right-sidebar' ) $return = 'rightsidebar';
                if( $home_layout == 'left-sidebar' ) $return = 'leftsidebar';
            }else{
                $return = 'sidebar';
            } 
        }else{
            $return = $class ? 'full-width' : false;
        }        
    }

    if( is_archive() || is_search() ){
        if( presto_blog_is_woocommerce_activated() && ( is_shop() || is_product_category() || is_product_tag() ) ){           
            $return = $class ? 'full-width' : false;
        }else{
            if( $layout == 'no-sidebar' ){
                $return = $class ? 'full-width' : false;
            }elseif( is_active_sidebar( 'sidebar' ) ){
                if( $class ){                
                    if( $layout == 'right-sidebar' ) $return = 'rightsidebar';
                    if( $layout == 'left-sidebar' ) $return = 'leftsidebar';
                }else{
                    $return = 'sidebar';
                }
            }else{
                $return = $class ? 'full-width' : false;
            }                      
        }        
    }
    
    if( is_singular() ){         
        $page_layout  = get_theme_mod( 'page_sidebar_layout', 'no-sidebar' );
        $post_layout  = get_theme_mod( 'post_sidebar_layout', 'no-sidebar' );     
        
        if( is_page() ){
            if( $page_layout == 'no-sidebar' ){
                $return = $class ? 'full-width' : false;
            }elseif( $page_layout == 'centered' ){
                $return = $class ? 'fullwidth-centered' : false;
            }elseif( is_active_sidebar( 'sidebar' ) ){
                if( $class ){                
                    if( $page_layout == 'right-sidebar' ) $return = 'rightsidebar';
                    if( $page_layout == 'left-sidebar' ) $return = 'leftsidebar';
                }else{
                    $return = 'sidebar';
                }
            }else{
                $return = $class ? 'full-width' : false;
            }
        }
        
        if( is_single() ){
            if( 'product' === get_post_type() ){ 
                $return = $class ? 'full-width' : false;
            }else{ 
                if( $post_layout == 'no-sidebar' ){
                    $return = $class ? 'full-width' : false;
                }elseif( $post_layout == 'centered' ){
                    $return = $class ? 'fullwidth-centered' : false;
                }elseif( is_active_sidebar( 'sidebar' ) ){
                    if( $class ){                
                        if( $post_layout == 'right-sidebar' ) $return = 'rightsidebar';
                        if( $post_layout == 'left-sidebar' ) $return = 'leftsidebar';
                    }else{
                        $return = 'sidebar';
                    }
                }else{
                    $return = $class ? 'full-width' : false;
                }
            }
        }
    }
        
    return $return; 
}
endif;

if( ! function_exists( 'presto_blog_get_posts' ) ) :
/**
 * Fuction to list Custom Post Type
*/
function presto_blog_get_posts( $post_type = 'post', $slug = false ){    
    $args = array(
    	'posts_per_page'   => -1,
    	'post_type'        => $post_type,
    	'post_status'      => 'publish',
    	'suppress_filters' => true 
    );
    $posts_array = get_posts( $args );
    
    // Initate an empty array
    $post_options = array();
    $post_options[''] = __( ' -- Choose -- ', 'presto-blog' );
    if ( ! empty( $posts_array ) ) {
        foreach ( $posts_array as $posts ) {
            if( $slug ){
                $post_options[ $posts->post_title ] = $posts->post_title;
            }else{
                $post_options[ $posts->ID ] = $posts->post_title;    
            }
        }
    }
    return $post_options;
    wp_reset_postdata();
}
endif;

if( ! function_exists( 'presto_blog_author_link' ) ) :
/**
 * Show/Hide Author link in footer
*/
function presto_blog_author_link(){    
    echo '<span class="author-link">'; 
    esc_html_e( ' Presto Blog | Developed By ', 'presto-blog' );
    echo '<a href="' . esc_url( 'https://sublimetheme.com/' ) .'" rel="nofollow" target="_blank">' . esc_html__( 'SublimeTheme', 'presto-blog' ) . '</a></span>.';
}
endif;

if( ! function_exists( 'presto_blog_wp_link' ) ) :
/**
 * Show/Hide WordPress link in footer
*/
function presto_blog_wp_link(){
    printf( esc_html__( '%1$s Powered by %2$s%3$s', 'presto-blog' ), '<span class="wp-link">', '<a href="'. esc_url( __( 'https://wordpress.org/', 'presto-blog' ) ) .'" target="_blank">WordPress</a>.', '</span>' );
}
endif;

if( ! function_exists( 'presto_blog_get_footer_social' ) ) :
/**
 * Footer Social
*/
function presto_blog_get_footer_social(){
    $ed_social = get_theme_mod( 'ed_social_links_footer', false ); 
    if( $ed_social ){ ?>
        <div class="footer-social">
            <?php presto_blog_social_links(); ?>	
        </div>
    <?php }
}
endif;

if ( ! function_exists( 'presto_blog_header_style' ) ) :
/**
 * Show/Hide Site title & description
 */
function presto_blog_header_style() { ?>
    <style type="text/css">
        <?php
            // Has the text been hidden?
            if ( ! display_header_text() ){ ?>
                .site-title,
                .site-description {
                    position: absolute;
                    clip: rect(1px, 1px, 1px, 1px);
                    }
                <?php 
            }
        ?>
    </style>
    <?php
}
endif;

if ( ! function_exists( 'presto_blog_google_fonts_url' ) ) :	
/**
 * Google Fonts url
 */
function presto_blog_google_fonts_url() {
    $fonts_url = '';
    $fonts     = array();

    /*
    * translators: If there are characters in your language that are not supported
    * by DM Sans, translate this to 'off'. Do not translate into your own language.
    */
    if ( 'off' !== _x( 'on', 'DM Sans font: on or off', 'presto-blog' ) ) {
        $fonts[] = 'DM Sans:regular,italic,500,500italic,700,700italic';
    }

    /*
    * translators: If there are characters in your language that are not supported
    * by Bodoni Moda:, translate this to 'off'. Do not translate into your own language.
    */
    if ( 'off' !== _x( 'on', 'Bodoni Moda: font: on or off', 'presto-blog' ) ) {
        $fonts[] = 'Bodoni Moda:regular,italic,500,500italic,700,600,600italic,700italic,800,900';
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
endif;

if( ! function_exists( 'presto_blog_flush_local_google_fonts' ) ){
	/**
	 * Ajax Callback for flushing the local font
	 */
  	function presto_blog_flush_local_google_fonts() {
		$WebFontLoader = new Presto_Blog_WebFont_Loader();
		//deleting the fonts folder using ajax
		$WebFontLoader->delete_fonts_folder();
		die();
  	}
}
add_action( 'wp_ajax_flush_local_google_fonts', 'presto_blog_flush_local_google_fonts' );
add_action( 'wp_ajax_nopriv_flush_local_google_fonts', 'presto_blog_flush_local_google_fonts' );

/**
 * Checks if classic editor is active or not
*/
function presto_blog_is_classic_editor_activated(){
    return class_exists( 'Classic_Editor' ) ? true : false; 
}

/**
 * Query WooCommerce activation
 */
function presto_blog_is_woocommerce_activated() {
	return class_exists( 'woocommerce' ) ? true : false;
}

/**
 * Is BlossomThemes Email Newsletters active or not
*/
function presto_blog_is_btnw_activated(){
    return class_exists( 'Blossomthemes_Email_Newsletter' ) ? true : false;        
}

/**
 * Is Instagram Feed active or not
 */
function presto_blog_is_instagram_feed(){
    return class_exists( 'SB_Instagram_Feed' ) ? true : false;
}