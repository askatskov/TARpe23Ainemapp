<?php
/**
 * Render the site title for the selective refresh partial.
 */

function presto_blog_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 */
function presto_blog_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Header Button label
*/
function presto_blog_header_button_label(){
    return esc_html( get_theme_mod( 'header_button_label', __( 'RSVP', 'presto-blog' ) ) );
}

/**
 * Banner SubTitle
*/
function presto_blog_banner_subtitle(){
    return esc_html( get_theme_mod( 'banner_subtitle', __( 'Free Blogging Course', 'presto-blog' ) ) );
}

/**
 * Banner Title
*/
function presto_blog_banner_title(){
    return esc_html( get_theme_mod( 'banner_title', __( 'Are you Ready to Start a Profitable Blog?', 'presto-blog' ) ) );
}

/**
 * Banner One label
*/
function presto_blog_banner_link_one_label(){
    return esc_html( get_theme_mod( 'banner_link_one_label', __( 'Get Started', 'presto-blog' ) ) );
}

/**
 * Banner Two label
*/
function presto_blog_banner_link_two_label(){
    return esc_html( get_theme_mod( 'banner_link_two_label', __( 'Learn More', 'presto-blog' ) ) );
}

/**
 * Related Post Title
*/
function presto_blog_get_related_title(){
    return esc_html( get_theme_mod( 'related_post_title', __( 'You Might Also Like', 'presto-blog' ) ) );
}

/**
 * Presto Home Text
*/
function presto_blog_home_text(){
    return esc_html( get_theme_mod( 'home_text', __( "Home", 'presto-blog' ) ) );
}

/**
 * Instagram Title
*/
function presto_blog_instagram_title(){
    return esc_html( get_theme_mod( 'instagram_title', __( 'I\'m on instagram', 'presto-blog' ) ) );
}

/**
 * Footer Copyright
*/
function presto_blog_get_footer_copyright(){
    $copyright = get_theme_mod( 'footer_copyright' );
    echo '<span class="copy-right">';
    if( $copyright ){
        echo wp_kses_post( $copyright );
    }else{
        esc_html_e( '&copy; Copyright ', 'presto-blog' );
        echo date_i18n( esc_html__( 'Y', 'presto-blog' ) );
        echo ' <a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html( get_bloginfo( 'name' ) ) . '</a>. ';
    }
    echo '</span>'; 
}