<!-- Top Bar codes -->
<?php
if( get_theme_mod( 'display_top_bar', '1' ) == 1 ) {
?>
<div class="container-fluid bgtoph">
	<div class="container">
		<div class="row bgtoph-row">
		
			<div class="col-md-6">
				<div class="topbar-left-side">
					<?php
					$tpbr_left_view = get_theme_mod( 'tpbr_left_view', '1' );
					if( $tpbr_left_view == '1' ) {
						get_template_part( 'template-parts/topbar-parts/topbar', 'phonemail' );
					} else if ( $tpbr_left_view == '2' ) {
						get_template_part( 'template-parts/topbar-parts/topbar', 'lefttexthtml' );
					} else if ( $tpbr_left_view == '3' ) {
						get_template_part( 'template-parts/topbar-parts/topbar', 'menu' );
					} else if ( $tpbr_left_view == '4' ) {
						get_template_part( 'template-parts/topbar-parts/topbar', 'cta' );
					} else {
						// Disabled
					}
					?>
				</div>
			</div>
			
			<div class="col-md-6">
				<div class="topbar-right-side">
					<?php
					$tpbr_right_view = get_theme_mod( 'tpbr_right_view', '4' );
					if( $tpbr_right_view == '1' ) {
						get_template_part( 'template-parts/topbar-parts/topbar', 'phonemail' );
					} else if ( $tpbr_right_view == '2' ) {
						get_template_part( 'template-parts/topbar-parts/topbar', 'righttexthtml' );
					} else if ( $tpbr_right_view == '3' ) {
						get_template_part( 'template-parts/topbar-parts/topbar', 'menu' );
					} else if ( $tpbr_right_view == '4' ) {
						get_template_part( 'template-parts/topbar-parts/topbar', 'cta' );
					} else {
						// Disabled
					}
					?>
				</div>
			</div>
			
		</div>
	</div>
</div>
<?php
}
?>
<!-- Top Bar codes END -->

<!-- Logo + Menu + Icons -->
<div id="navbarouter" class="navbarouter">
	<nav id="navbarprimary" class="navbar navbar-expand-md navbarprimary">
		<div class="container">
			<div class="navbar-header">

				<div class="navbar-brand">
					<?php
					if( has_custom_logo() ) {
						the_custom_logo();
					} else {
						echo "<a href='" . esc_url( home_url( '/' ) ) . "' rel='home' >";
						echo "<h3 class='site-name-pr'>" . esc_html( get_bloginfo( 'name' ) ) . "</h3>";
						echo "</a>";
					}
					?>
				</div>

				<button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#collapse-navbarprimary">
					<span class="navbar-toggler-icon"></span>
				</button>
			</div>

			<?php
			wp_nav_menu( array(
				'theme_location'    => 'primary',
				'depth'             =>  3,
				'container'         => 'div',
				'container_id'      => 'collapse-navbarprimary',
				'container_class'   => 'collapse navbar-collapse',
				'menu_id' 			=> 'primary-menu',
				'menu_class'        => 'nav navbar-nav primary-menu',
				'fallback_cb'       => 'Di_Restaurant_Topmain_Nav_Walker::nav_fallback',
				'walker'            => new Di_Restaurant_Topmain_Nav_Walker()
				));
			?>

			<?php get_template_part( 'template-parts/header', 'social-icons' ); ?>

		</div>
	</nav>
</div>
<!-- Logo + Menu + Icons END -->
