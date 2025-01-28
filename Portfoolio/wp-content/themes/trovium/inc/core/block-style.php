<?php

/**
 * Block Styles
 *
 * @link https://developer.wordpress.org/reference/functions/register_block_style/
 *
 * @package trovium
 * @since 1.0.0
 */

if (function_exists('register_block_style')) {
    /**
     * Register block styles.
     *
     * @since 0.1
     *
     * @return void
     */
    function trovium_register_block_styles() {
        register_block_style(
            'core/button',
            array(
                'name'  => 'button-outline-hover',
                'label' => __('Hover: Outline', 'trovium')
            )
        );
        register_block_style(
            'core/button',
            array(
                'name'  => 'button-hover-opacity',
                'label' => __('Hover: Opacity', 'trovium')
            )
        );
    }
    add_action('init', 'trovium_register_block_styles');
}
