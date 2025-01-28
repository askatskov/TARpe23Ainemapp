<?php
/**
 * Recommended plugins.
 *
 * @package resto
 */

add_action( 'tgmpa_register', 'resto_activate_recommended_plugins' );

/**
 * Register recommended plugins.
 *
 * @since 1.0.0
 */
function resto_activate_recommended_plugins() {

	$plugins = array(
		array(
			'name'     => __( 'Jetpack', 'resto' ),
			'slug'     => 'jetpack',
			'required' => false,
		),
	);

	$config = array();

	tgmpa( $plugins, $config );

}
