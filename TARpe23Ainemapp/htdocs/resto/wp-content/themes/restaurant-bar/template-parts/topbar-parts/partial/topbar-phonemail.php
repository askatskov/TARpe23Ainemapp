<?php
if( get_theme_mod( 'tpbr_lft_addr', __( '123 Street, NYC, US', 'restaurant-bar' ) ) ) {
?>
	<span class="topbar-phone-mail-addr-sep topbar-phone-mail-addr-sep-marker">
		<?php echo esc_html( get_theme_mod( 'tpbr_lft_addr', __( '123 Street, NYC, US', 'restaurant-bar' ) ) ); ?>
	</span>
<?php
}
?>

<?php
if( get_theme_mod( 'tpbr_lft_phne', '0123456789' ) ) {
?>
	<span class="topbar-phone-mail-addr-sep">
		<a class="topbar-phone-mail-addr-sep-phone" href="tel:<?php echo esc_attr( get_theme_mod( 'tpbr_lft_phne', '0123456789' ) ); ?>"><?php echo esc_html( get_theme_mod( 'tpbr_lft_phne', '0123456789' ) ); ?></a>
	</span>
<?php
}
?>

<?php
if( get_theme_mod( 'tpbr_lft_email', 'info@example.com' ) ) {
?>
	<span class="topbar-phone-mail-addr-sep">
		<a class="topbar-phone-mail-addr-sep-mail" href="mailto:<?php echo esc_attr( get_theme_mod( 'tpbr_lft_email', 'info@example.com' ) ); ?>"><?php echo esc_html( get_theme_mod( 'tpbr_lft_email', 'info@example.com' ) ); ?></a>
	</span>
<?php
}
