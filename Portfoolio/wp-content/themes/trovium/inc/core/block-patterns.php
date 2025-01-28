<?php

/**
 * trovium: Block Patterns
 *
 * @since trovium 1.0.0
 */

/**
 * Registers pattern categories for trovium
 *
 * @since trovium 1.0.0
 *
 * @return void
 */
function trovium_register_pattern_category()
{
	$block_pattern_categories = array(
		'trovium' => array('label' => __('Trovium', 'trovium')),
	);

	$block_pattern_categories = apply_filters('trovium_block_pattern_categories', $block_pattern_categories);

	foreach ($block_pattern_categories as $name => $properties) {
		if (!WP_Block_Pattern_Categories_Registry::get_instance()->is_registered($name)) {
			register_block_pattern_category($name, $properties);
		}
	}
}
add_action('init', 'trovium_register_pattern_category', 9);
