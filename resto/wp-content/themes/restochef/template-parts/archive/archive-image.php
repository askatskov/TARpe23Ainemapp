<?php
/**
 * Show the appropriate content for the Image post format.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Restochef
 * @since Restochef 1.0.0
 */

// If there is no featured-image, print the first image block found.
if (has_block( 'core/image', get_the_content() )) {
	restochef_print_first_instance_of_block( 'core/image', get_the_content() );
}
    if ( absint(restochef_get_option( 'excerpt_length' )) != '0'){

        the_excerpt();
    }