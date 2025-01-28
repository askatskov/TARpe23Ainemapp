<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package eVision themes
 * @subpackage Resto
 * @since Resto 1.0.0
 */

/**
 * resto_action_after_content hook
 * @since Resto 1.0.0
 *
 * @hooked null
 */
do_action( 'resto_action_after_content' );

/**
 * resto_action_before_footer hook
 * @since Resto 1.0.0
 *
 * @hooked resto_before_footer - 10
 */
do_action( 'resto_action_before_footer' );

/**
 * resto_action_footer hook
 * @since Resto 1.0.0
 *
 * @hooked resto_footer - 10
 */
do_action( 'resto_action_footer' );

/**
 * resto_action_after_footer hook
 * @since Resto 1.0.0
 *
 * @hooked null
 */
do_action( 'resto_action_after_footer' );

/**
 * resto_action_after_footer hook
 * @since Resto 1.0.0
 *
 * @hooked resto_page_end - 10
 */
do_action( 'resto_action_after_footer' );
?>
<?php wp_footer(); ?>
</body>
</html>
