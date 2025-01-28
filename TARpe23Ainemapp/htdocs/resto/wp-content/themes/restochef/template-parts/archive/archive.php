<?php
/**
 * Show the excerpt.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Restochef
 * @since Restochef 1.0.0
 */
if ( absint(restochef_get_option( 'excerpt_length' )) != '0'){
    the_excerpt();
}