<?php
/**
 * Will contain top bar menu.
 */
?>

<div class="topbar-menu">
	<?php
	if( has_nav_menu( 'topbarmenu' ) ) {
		wp_nav_menu( array(
			'theme_location'    => 'topbarmenu',
			'depth'             =>  1,
		) );
	}
	?>
</div>
