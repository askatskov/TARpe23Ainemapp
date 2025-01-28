<?php
/**
 * Will contain CTA.
 */

$cta_trgt = '';
if( get_theme_mod( 'bk_tbl_cta_link_trgt', '0' ) == 1 ) {
	$cta_trgt = 'target="_blank"';
}
?>

<div class="book-tbl">
	<a class="book-tbl-a" href="<?php echo esc_url( get_theme_mod( 'bk_tbl_cta_link', home_url( '/' ) ) ); ?>" <?php echo $cta_trgt; ?> >
	<?php echo esc_html( get_theme_mod( 'bk_tbl_cta_label', __( 'Book Table', 'restaurant-bar' ) ) ); ?>
	</a>
</div>
