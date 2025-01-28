<?php
/**
 * Will contain left custom text/HTML.
 */
?>

<div class="topbar_ctmzr_left">
	<?php
	echo wp_kses_post( get_theme_mod( 'top_bar_left_content', '</p>' . __( 'Left Contents.', 'restaurant-bar' ) . '</p>' ) );
	?>
</div>