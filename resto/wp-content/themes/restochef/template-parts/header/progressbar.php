<?php
/**
 * Displays progressbar
 *
 * @package Restochef
 */

$show_progressbar = restochef_get_option( 'show_progressbar' );

if ( $show_progressbar ) :
	$progressbar_position = restochef_get_option( 'progressbar_position' );
	echo '<div id="restochef-progress-bar" class="theme-progress-bar ' . esc_attr( $progressbar_position ) . '"></div>';
endif;
