<?php
/**
 * The template for displaying home page.
 * @package resto
 */

get_header();
if ( 'posts' == get_option( 'show_on_front' ) ) {
    include( get_home_template() );
    }
else{
	if (($resto_customizer_all_values['resto-feature-slider-enable'] != 1) && ($resto_customizer_all_values['resto-feature-slider-enable'] != 1 ) && ($resto_customizer_all_values['resto-feature-slider-enable'] != 1 )) {
		if ( current_user_can( 'edit_theme_options' ) ) { ?>
			<section class="wrapper display-info">
				<div class="container">
				<?php echo sprintf(
					__( 'All Section are based on page. Enable each Section from customizer for </br> slider: Home/Front Main Slider -> Setting Options -> Enable. likewise to other sections </br> %s', 'resto' ),
					'<a class="button" href="' . esc_url( admin_url( 'customize.php' ) ) . '">' . __( 'click here', 'resto' ) . '</a>'
					); ?>
				</div>
			</section>
		<?php }
	}	
	else{
	/**
	 * resto_action_front_page hook
	 * @since resto 1.0.0
	 *
	 * @hooked resto_action_front_page -  10
	 * @sub_hooked resto_action_front_page -  30
	 */
	do_action( 'resto_action_front_page' );
	}
}
get_footer();