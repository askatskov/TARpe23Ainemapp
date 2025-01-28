<?php
/**
 * Filter Hooks
 *
 * @package Presto_Blog
 */

if( ! function_exists( 'presto_blog_newsletter_bg_color' ) ) :
function presto_blog_newsletter_bg_color(){
    return '#F0E9EE';
}
endif;
add_filter( 'bt_newsletter_bg_color_setting', 'presto_blog_newsletter_bg_color' );