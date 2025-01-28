<div class="social-div">

	<span class="woo-social-div-pr">
		<?php
		if( class_exists( 'WooCommerce' ) ) {
			echo "<span class='woo_icons_ctmzr'>";
			if( get_theme_mod( 'shop_icon_endis', '1' ) ) {
				?>
				<a title="<?php esc_attr_e( 'Shop', 'restaurant-food-shop' ); ?>" class="social-icon" href="<?php echo esc_url( get_permalink( get_option('woocommerce_shop_page_id') ) ); ?>"><span class="fa fa-shopping-bag bgtoph-icon-clr"></span></a>
				<?php
			}

			if( get_theme_mod( 'cart_icon_endis', '1' ) ) {
				?>
				<a title="<?php esc_attr_e( 'Cart', 'restaurant-food-shop' ); ?>" class="social-icon" href="<?php echo esc_url( get_permalink( get_option('woocommerce_cart_page_id') ) ); ?>"><span class="fa fa-shopping-cart bgtoph-icon-clr"></span></a>
				<?php
			}

			if( get_theme_mod( 'myaccount_icon_endis', '1' ) ) {
				?>
				<a title="<?php esc_attr_e( 'My Account', 'restaurant-food-shop' ); ?>" class="social-icon" href="<?php echo esc_url( get_permalink( get_option('woocommerce_myaccount_page_id') ) ); ?>"><span class="fa fa-user bgtoph-icon-clr"></span></a>
				<?php
			}
			echo "</span>";
		}
		?>
	</span>


	<?php
	if( get_theme_mod( 'sprofile_link_endis', '1' ) == 1 ) {

		if( get_theme_mod( 'sprofile_link_ntabs', '1' ) == 1 ) {
			$s_link_tab = 'target="_blank"';
		} else {
			$s_link_tab = '';
		}
	?>

	<span class="icons-social-div-pr">

		<?php
		if( get_theme_mod( 'sprofile_link_facebook', 'http://facebook.com' ) ) {
			?>
			<a title="<?php esc_attr_e( 'Facebook', 'restaurant-food-shop' ); ?>" rel="nofollow" <?php echo $s_link_tab; ?> class="social-icon" href="<?php echo esc_url( get_theme_mod( 'sprofile_link_facebook', 'http://facebook.com' ) ); ?>"><span class="fa fa-facebook bgtoph-icon-clr"></span></a>
			<?php
		}
		?>

		<?php
		if( get_theme_mod( 'sprofile_link_twitter', 'http://twitter.com' ) ) {
			?>
			<a title="<?php esc_attr_e( 'Twitter', 'restaurant-food-shop' ); ?>" rel="nofollow" <?php echo $s_link_tab; ?> class="social-icon" href="<?php echo esc_url( get_theme_mod( 'sprofile_link_twitter', 'http://twitter.com' ) ); ?>"><span class="fa fa-twitter bgtoph-icon-clr"></span></a>
			<?php
		}
		?>

		<?php
		if( get_theme_mod( 'sprofile_link_youtube', 'http://youtube.com' ) ) {
			?>
			<a title="<?php esc_attr_e( 'YouTube', 'restaurant-food-shop' ); ?>" rel="nofollow" <?php echo $s_link_tab; ?> class="social-icon" href="<?php echo esc_url( get_theme_mod( 'sprofile_link_youtube', 'http://youtube.com' ) ); ?>"><span class="fa fa-youtube bgtoph-icon-clr"></span></a>
			<?php
		}
		?>

		<?php
		if( get_theme_mod( 'sprofile_link_vk' ) ) {
			?>
			<a title="<?php esc_attr_e( 'VK', 'restaurant-food-shop' ); ?>" rel="nofollow" <?php echo $s_link_tab; ?> class="social-icon" href="<?php echo esc_url( get_theme_mod( 'sprofile_link_vk' ) ); ?>"><span class="fa fa-vk bgtoph-icon-clr"></span></a>
			<?php
		}
		?>

		<?php
		if( get_theme_mod( 'sprofile_link_okru' ) ) {
			?>
			<a title="<?php esc_attr_e( 'Ok.ru', 'restaurant-food-shop' ); ?>" rel="nofollow" <?php echo $s_link_tab; ?> class="social-icon" href="<?php echo esc_url( get_theme_mod( 'sprofile_link_okru' ) ); ?>"><span class="fa fa-odnoklassniki bgtoph-icon-clr"></span></a>
			<?php
		}
		?>

		<?php
		if( get_theme_mod( 'sprofile_link_linkedin' ) ) {
			?>
			<a title="<?php esc_attr_e( 'Linkedin', 'restaurant-food-shop' ); ?>" rel="nofollow" <?php echo $s_link_tab; ?> class="social-icon" href="<?php echo esc_url( get_theme_mod( 'sprofile_link_linkedin' ) ); ?>"><span class="fa fa-linkedin bgtoph-icon-clr"></span></a>
			<?php
		}
		?>

		<?php
		if( get_theme_mod( 'sprofile_link_pinterest' ) ) {
			?>
			<a title="<?php esc_attr_e( 'Pinterest', 'restaurant-food-shop' ); ?>" rel="nofollow" <?php echo $s_link_tab; ?> class="social-icon" href="<?php echo esc_url( get_theme_mod( 'sprofile_link_pinterest' ) ); ?>"><span class="fa fa-pinterest bgtoph-icon-clr"></span></a>
			<?php
		}
		?>

		<?php
		if( get_theme_mod( 'sprofile_link_instagram' ) ) {
			?>
			<a title="<?php esc_attr_e( 'Instagram', 'restaurant-food-shop' ); ?>" rel="nofollow" <?php echo $s_link_tab; ?> class="social-icon" href="<?php echo esc_url( get_theme_mod( 'sprofile_link_instagram' ) ); ?>"><span class="fa fa-instagram bgtoph-icon-clr"></span></a>
			<?php
		}
		?>

		<?php
		if( get_theme_mod( 'sprofile_link_telegram' ) ) {
			?>
			<a title="<?php esc_attr_e( 'Telegram', 'restaurant-food-shop' ); ?>" rel="nofollow" <?php echo $s_link_tab; ?> class="social-icon" href="<?php echo esc_url( get_theme_mod( 'sprofile_link_telegram' ) ); ?>"><span class="fa fa-telegram bgtoph-icon-clr"></span></a>
			<?php
		}
		?>

		<?php
		if( get_theme_mod( 'sprofile_link_snapchat' ) ) {
			?>
			<a title="<?php esc_attr_e( 'Snapchat', 'restaurant-food-shop' ); ?>" rel="nofollow" <?php echo $s_link_tab; ?> class="social-icon" href="<?php echo esc_url( get_theme_mod( 'sprofile_link_snapchat' ) ); ?>"><span class="fa fa-snapchat bgtoph-icon-clr"></span></a>
			<?php
		}
		?>

		<?php
		if( get_theme_mod( 'sprofile_link_flickr' ) ) {
			?>
			<a title="<?php esc_attr_e( 'Flickr', 'restaurant-food-shop' ); ?>" rel="nofollow" <?php echo $s_link_tab; ?> class="social-icon" href="<?php echo esc_url( get_theme_mod( 'sprofile_link_flickr' ) ); ?>"><span class="fa fa-flickr bgtoph-icon-clr"></span></a>
			<?php
		}
		?>

		<?php
		if( get_theme_mod( 'sprofile_link_reddit' ) ) {
			?>
			<a title="<?php esc_attr_e( 'Reddit', 'restaurant-food-shop' ); ?>" rel="nofollow" <?php echo $s_link_tab; ?> class="social-icon" href="<?php echo esc_url( get_theme_mod( 'sprofile_link_reddit' ) ); ?>"><span class="fa fa-reddit bgtoph-icon-clr"></span></a>
			<?php
		}
		?>

		<?php
		if( get_theme_mod( 'sprofile_link_tumblr' ) ) {
			?>
			<a title="<?php esc_attr_e( 'Tumblr', 'restaurant-food-shop' ); ?>" rel="nofollow" <?php echo $s_link_tab; ?> class="social-icon" href="<?php echo esc_url( get_theme_mod( 'sprofile_link_tumblr' ) ); ?>"><span class="fa fa-tumblr bgtoph-icon-clr"></span></a>
			<?php
		}
		?>

		<?php
		if( get_theme_mod( 'sprofile_link_yelp' ) ) {
			?>
			<a title="<?php esc_attr_e( 'Yelp', 'restaurant-food-shop' ); ?>" rel="nofollow" <?php echo $s_link_tab; ?> class="social-icon" href="<?php echo esc_url( get_theme_mod( 'sprofile_link_yelp' ) ); ?>"><span class="fa fa-yelp bgtoph-icon-clr"></span></a>
			<?php
		}
		?>

		<?php
		if( get_theme_mod( 'sprofile_link_whatsappno' ) ) {
			?>
			<a class="whatsapp-large social-icon" rel="nofollow" title="<?php esc_attr_e( 'WhatsApp', 'restaurant-food-shop' ); ?>" <?php echo $s_link_tab; ?> href="https://web.whatsapp.com/send?text=&phone=<?php echo esc_attr( get_theme_mod( 'sprofile_link_whatsappno' ) ); ?>&abid=<?php echo esc_attr( get_theme_mod( 'sprofile_link_whatsappno' ) ); ?>"><span class="fa fa-whatsapp bgtoph-icon-clr"></span></a>

			<a class="whatsapp-small social-icon" rel="nofollow" title="<?php esc_attr_e( 'WhatsApp', 'restaurant-food-shop' ); ?>" <?php echo $s_link_tab; ?> href="whatsapp://send?text=&phone=<?php echo esc_attr( get_theme_mod( 'sprofile_link_whatsappno' ) ); ?>&abid=<?php echo esc_attr( get_theme_mod( 'sprofile_link_whatsappno' ) ); ?>"><span class="fa fa-whatsapp bgtoph-icon-clr"></span></a>
			<?php
		}
		?>

		<?php
		if( get_theme_mod( 'sprofile_link_skype' ) ) {
			?>
			<a class="social-icon" title="<?php esc_attr_e( 'Skype', 'restaurant-food-shop' ); ?>" rel="nofollow" <?php echo $s_link_tab; ?> href="skype:<?php echo esc_attr( get_theme_mod( 'sprofile_link_skype' ) ); ?>?add"><span class="fa fa-skype bgtoph-icon-clr"></span></a>
			<?php
		}
		?>

		</span>

	<?php
	}
	?>

	<?php
	// Render overlay menu icon if enabled in customize
	if( get_theme_mod( 'ovrly_menu_endis', '1' ) == 1 ) {
		?>
		<span class="ovrly-menu-otr">
			<a class="ovrly-menu" title="<?php echo esc_attr( get_theme_mod( 'ovrly_menu_ttl_attr', __( 'Overlay Menu', 'restaurant-food-shop' ) ) ); ?>" href="javascript:void(0)">
				<span class="fa fa-bars bgtoph-icon-clr"></span>
			</a>
		</span>
		<?php
	}
	?>
	
	<?php
	// CTA on header
	if( get_theme_mod( 'bk_tbl_cta_endis', '1' ) == 1 ) {

		$cta_trgt = '';
		if( get_theme_mod( 'bk_tbl_cta_link_trgt', '0' ) == 1 ) {
			$cta_trgt = 'target="_blank"';
		}
		?>
		<span class="book-tbl-otr">
			<a class="book-tbl" href="<?php echo esc_url( get_theme_mod( 'bk_tbl_cta_link', home_url( '/' ) ) ); ?>" <?php echo $cta_trgt; ?> >
				<?php echo esc_html( get_theme_mod( 'bk_tbl_cta_label', __( 'Book Table', 'restaurant-food-shop' ) ) ); ?>
			</a>
		</span>
		<?php
	}
	?>

</div>
