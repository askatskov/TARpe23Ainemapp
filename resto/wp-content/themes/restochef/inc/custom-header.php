<?php
/**
 * Sample implementation of the Custom Header feature
 *
 * You can add an optional custom header image to header.php like so ...
 *
 *
 * @link https://developer.wordpress.org/themes/functionality/custom-headers/
 *
 * @package Restochef
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses restochef_header_style()
 */
function restochef_custom_header_setup() {
	add_theme_support(
		'custom-header',
		apply_filters(
			'restochef_custom_header_args',
			array(
				'default-text-color' => '000000',
				'width'            => 1920,
				'height'           => 1080,
				'flex-height'      => true,
				'video'            => true,
				'wp-head-callback'   => 'restochef_header_style',
				'default-image' 		=> esc_url( get_stylesheet_directory_uri() . '/assets/images/main-banner.jpg'),
			)
		)
	);
}
add_action( 'after_setup_theme', 'restochef_custom_header_setup' );

if ( ! function_exists( 'restochef_header_style' ) ) :
	/**
	 * Styles the header image and text displayed on the blog.
	 *
	 * @see restochef_custom_header_setup().
	 */
	function restochef_header_style() {
		$header_text_color = get_header_textcolor();

		/*
		 * If no custom options for text are set, let's bail.
		 * get_header_textcolor() options: Any hex value, 'blank' to hide text. Default: add_theme_support( 'custom-header' ).
		 */
		if ( get_theme_support( 'custom-header', 'default-text-color' ) === $header_text_color ) {
			return;
		}

		// If we get this far, we have custom styles. Let's do this.
		?>
		<style type="text/css">
		<?php
		// Has the text been hidden?
		if ( ! display_header_text() ) :
			?>
			.site-title,
			.site-description {
				position: absolute;
				clip: rect(1px, 1px, 1px, 1px);
				}
			<?php
			// If the user has set a custom color for the text use that.
		else :
			?>
			.site-header a:not(:hover, :focus),
			.site-description,
      .site-header .theme-button.theme-button-transparent:not(:hover, :focus) {
				color: #<?php echo esc_attr( $header_text_color ); ?>;
			}

      .svg-icon-colormode > :is(.moon, .sun) {
        fill: #<?php echo esc_attr( $header_text_color ); ?>;
      }

      .svg-icon-colormode > .sun-beams {
        stroke: #<?php echo esc_attr( $header_text_color ); ?>;
      }
		<?php endif; ?>
		</style>
		<?php
	}
endif;
