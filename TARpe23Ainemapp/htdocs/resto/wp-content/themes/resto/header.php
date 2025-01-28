<?php
/**
 * The default template for displaying header
 *
 * @package eVision themes
 * @subpackage Resto
 * @since Resto 1.0.0
 */

/**
 * resto_action_before_head hook
 * @since Resto 1.0.0
 *
 * @hooked resto_set_global -  0
 * @hooked resto_doctype -  10
 */
do_action( 'resto_action_before_head' );?>
<head>

	<?php
	/**
	 * resto_action_before_wp_head hook
	 * @since Resto 1.0.0
	 *
	 * @hooked resto_before_wp_head -  10
	 */
	do_action( 'resto_action_before_wp_head' );

	wp_head();

	/**
	 * resto_action_after_wp_head hook
	 * @since Resto 1.0.0
	 *
	 * @hooked null
	 */
	do_action( 'resto_action_after_wp_head' );
	?>

</head>
<body <?php body_class(); ?>>
<?php
/**
 * resto_action_before hook
 * @since Resto 1.0.0
 *
 * @hooked resto_page_start - 15
 */
do_action( 'resto_action_before' );

/**
 * resto_action_before_header hook
 * @since Resto 1.0.0
 *
 * @hooked resto_skip_to_content - 10
 */
do_action( 'resto_action_before_header' );


/**
 * resto_action_header hook
 * @since Resto 1.0.0
 *
 * @hooked resto_after_header - 10
 */
do_action( 'resto_action_header' );


/**
 * resto_action_main_slider hook
 * @since Resto 1.0.0
 *
 * @hooked resto_action_main_slider - 10
 */
do_action( 'resto_action_on_header' );


/**
 * resto_action_header_close hook
 * @since Resto 1.0.0
 *
 * @hooked null
 */
do_action( 'resto_action_header_close' );

/**
 * resto_action_after_header hook
 * @since Resto 1.0.0
 *
 * @hooked null
 */
do_action( 'resto_action_after_header' );


/**
 * resto_action_before_content hook
 * @since Resto 1.0.0
 *
 * @hooked null
 */
do_action( 'resto_action_before_content' );
