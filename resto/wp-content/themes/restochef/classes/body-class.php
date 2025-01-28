<?php
/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function restochef_body_classes( $classes ) {
    global $post;
    $post_type = "";
    if (!empty($post)) {
        $post_type = get_post_type($post->ID);
    }
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}
    $header_style = restochef_get_option('header_style');
    $classes[] = ' restochef-'.$header_style;
    // Get the color mode of the site.
    $enable_dark_mode = restochef_get_option( 'enable_dark_mode' );
    if ( $enable_dark_mode ) {
        $classes[] = 'restochef-dark-mode';
    } else {
        $classes[] = 'restochef-light-mode';
    }

    $enable_banner_section = restochef_get_option('enable_banner_section');
    if (is_front_page() && $enable_banner_section === true) {
        $classes[] = 'has-header-overlap';
    }

    if ($post_type == 'product') {
        if ( ! is_active_sidebar( 'shop-sidebar' ) ) {
            $classes[] = 'no-sidebar';
        } else {
            $page_layout = restochef_get_page_layout();
            if('no-sidebar' != $page_layout ){
                $classes[] = 'has-sidebar '.esc_attr($page_layout);
            }
        }
    } else {
        if ($post_type != 'page') { 
        	$page_layout = restochef_get_page_layout();
            if('no-sidebar' != $page_layout ){
                $classes[] = 'has-sidebar '.esc_attr($page_layout);
            }else{

                $classes[] = esc_attr($page_layout);
            }
        }
    }


	return $classes;
}
add_filter( 'body_class', 'restochef_body_classes' );
