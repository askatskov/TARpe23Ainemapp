</div>

<?php get_template_part( 'template-parts/footer', 'widgets' ); ?>

<?php get_template_part( 'template-parts/footer', 'copyright' ); ?>

<?php get_template_part( 'template-parts/footer', 'backtotop' ); ?>

<?php
// Render overlay menu if enabled in customize
if( get_theme_mod( 'ovrly_menu_endis', '1' ) == 1 ) {
	?>
	<div id="ovrlyNav" class="ovrly">
		<div class="overlay-bgoverlay-color"></div>
		<a href="javascript:void(0)" class="ovrly-menu-closebtn">&times;</a>
		<div class="ovrly-content">
			
			<?php
			if( has_nav_menu( 'overlaymenu' ) ) {
			?>
			<?php
				wp_nav_menu( array(
					'theme_location'    => 'overlaymenu',
					'depth'             =>  1,
					'container'         => 'ul',
					'menu_id' 			=> 'overlaymenu-id',
					'menu_class'        => 'overlaymenu-class',
					));
				?>
			<?php
			} else {
				if( current_user_can( 'manage_options' ) ) {
					?>
					<ul id="overlaymenu-id" class="overlaymenu-class">
						<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'restaurant-food-shop' ); ?></a></li>
						<li><a target="_blank" href="<?php echo esc_url( get_dashboard_url() . 'nav-menus.php?action=locations' ); ?>"><?php esc_html_e( 'Edit Menu >', 'restaurant-food-shop' ); ?></a></li>
					</ul>
					<?php
				} else {
					?>
					<ul id="overlaymenu-id" class="overlaymenu-class">
						<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'restaurant-food-shop' ); ?></a></li>
					</ul>
					<?php
				}
			}
			?>

		</div>
	</div>
	<?php
}
?>

<?php wp_footer(); ?>
</body>
</html>
