<?php
/**
 * Theme activation.
 * @package Restochef
 * Theme Dashboard [Free VS Pro]
 */
function restochef_free_vs_pro_html() {
	ob_start();
	?>
	<div class="theme-admin-title"><?php esc_html_e( 'Differences between Restochef and Restochef Pro', 'restochef' ); ?></div>
	<div class="theme-admin-description"><?php esc_html_e( 'Here are some of the differences between Restochef and Restochef Pro:', 'restochef' ); ?></div>

	<table class="freemium-comparison-table">
		<thead>
			<tr>
				<th><?php esc_html_e( 'Feature', 'restochef' ); ?></th>
				<th><?php esc_html_e( 'Restochef', 'restochef' ); ?></th>
				<th><?php esc_html_e( 'Restochef Pro', 'restochef' ); ?></th>
			</tr>
		</thead>
		<tbody>
            <tr>
                <td><?php esc_html_e( 'Responsive Design', 'restochef' ); ?></td>
                <td><span class="theme-dashboard-badge theme-badge-primary"><i class="dashicons dashicons-saved"></i></span></td>
                <td><span class="theme-dashboard-badge theme-badge-primary"><i class="dashicons dashicons-saved"></i></span></td>
            </tr>
            <tr>
                <td><?php esc_html_e( 'Multiple Blog Layouts', 'restochef' ); ?></td>
                <td><span class="theme-dashboard-badge theme-badge-primary"><i class="dashicons dashicons-saved"></i></span></td>
                <td><span class="theme-dashboard-badge theme-badge-primary"><i class="dashicons dashicons-saved"></i></span></td>
            </tr>
            <tr>
                <td><?php esc_html_e( 'Live editing in Customizer', 'restochef' ); ?></td>
                <td><span class="theme-dashboard-badge theme-badge-primary"><i class="dashicons dashicons-saved"></i></span></td>
                <td><span class="theme-dashboard-badge theme-badge-primary"><i class="dashicons dashicons-saved"></i></span></td>
            </tr>
            <tr>
                <td><?php esc_html_e( 'One Click Demo Import', 'restochef' ); ?></td>
                <td><span class="theme-dashboard-badge theme-badge-primary"><i class="dashicons dashicons-saved"></i></span></td>
                <td><span class="theme-dashboard-badge theme-badge-primary"><i class="dashicons dashicons-saved"></i></span></td>
            </tr>

            <tr>
                <td><?php esc_html_e( 'Access to all Google Fonts', 'restochef' ); ?></td>
                <td><span class="theme-dashboard-badge theme-badge-tertiary"><i class="dashicons dashicons-no-alt"></i></span></td>
                <td><span class="theme-dashboard-badge theme-badge-primary"><i class="dashicons dashicons-saved"></i></span></td>
            </tr>
            <tr>
                <td><?php esc_html_e( 'Access to Color Options', 'restochef' ); ?></td>
                <td><span class="theme-dashboard-badge theme-badge-tertiary"><i class="dashicons dashicons-no-alt"></i></span></td>
                <td><span class="theme-dashboard-badge theme-badge-primary"><i class="dashicons dashicons-saved"></i></span></td>
            </tr>
			<tr>
				<td><?php esc_html_e( 'Preloader Option', 'restochef' ); ?></td>
				<td><span class="theme-dashboard-badge">2</span></td>
				<td><span class="theme-dashboard-badge">5</span></td>
			</tr>
			<tr>
				<td><?php esc_html_e( 'Multiple Header Options', 'restochef' ); ?></td>
				<td><span class="theme-dashboard-badge">3 Layouts</span></td>
				<td><span class="theme-dashboard-badge">5 Layouts</span></td>
			</tr>
            <tr>
                <td><?php esc_html_e( 'Logo and Title Customization', 'restochef' ); ?></td>
                <td><span class="theme-dashboard-badge theme-badge-primary"><i class="dashicons dashicons-saved"></i></span></td>
                <td><span class="theme-dashboard-badge theme-badge-primary"><i class="dashicons dashicons-saved"></i></span></td>
            </tr>
            <tr>
                <td><?php esc_html_e( 'Header Image', 'restochef' ); ?></td>
                <td><span class="theme-dashboard-badge theme-badge-primary"><i class="dashicons dashicons-saved"></i></span></td>
                <td><span class="theme-dashboard-badge theme-badge-primary"><i class="dashicons dashicons-saved"></i></span></td>
            </tr>
            <tr>
                <td><?php esc_html_e( 'Custom Widgets', 'restochef' ); ?></td>
                <td><span class="theme-dashboard-badge theme-badge-primary"><i class="dashicons dashicons-saved"></i></span></td>
                <td><span class="theme-dashboard-badge theme-badge-primary"><i class="dashicons dashicons-saved"></i></span></td>
            </tr>
            <tr>
                <td><?php esc_html_e( 'Frontpage Banner', 'restochef' ); ?></td>
                <td><span class="theme-dashboard-badge">2 Layouts</span></td>
                <td><span class="theme-dashboard-badge">3 Layouts</span></td>
            </tr>
			<tr>
				<td><?php esc_html_e( 'Hide Theme Credit Link', 'restochef' ); ?></td>
				<td><span class="theme-dashboard-badge theme-badge-tertiary"><i class="dashicons dashicons-no-alt"></i></span></td>
				<td><span class="theme-dashboard-badge theme-badge-primary"><i class="dashicons dashicons-saved"></i></span></td>
			</tr>
			<tr>
				<td><?php esc_html_e( 'Extra Widget Area', 'restochef' ); ?></td>
				<td><span class="theme-dashboard-badge theme-badge-tertiary"><i class="dashicons dashicons-no-alt"></i></span></td>
				<td><span class="theme-dashboard-badge theme-badge-primary"><i class="dashicons dashicons-saved"></i></span></td>
			</tr>
			<tr>
				<td><?php esc_html_e( 'Instagram Module', 'restochef' ); ?></td>
				<td><span class="theme-dashboard-badge theme-badge-tertiary"><i class="dashicons dashicons-no-alt"></i></span></td>
				<td><span class="theme-dashboard-badge theme-badge-primary"><i class="dashicons dashicons-saved"></i></span></td>
			</tr>
			<tr>
				<td><?php esc_html_e( 'Twitter Module', 'restochef' ); ?></td>
				<td><span class="theme-dashboard-badge theme-badge-tertiary"><i class="dashicons dashicons-no-alt"></i></span></td>
				<td><span class="theme-dashboard-badge theme-badge-primary"><i class="dashicons dashicons-saved"></i></span></td>
			</tr>
			<tr>
				<td><?php esc_html_e( 'Table of Contents', 'restochef' ); ?></td>
				<td><span class="theme-dashboard-badge theme-badge-tertiary"><i class="dashicons dashicons-no-alt"></i></span></td>
				<td><span class="theme-dashboard-badge theme-badge-primary"><i class="dashicons dashicons-saved"></i></span></td>
			</tr>
			<tr>
				<td><?php esc_html_e( 'Share Buttons', 'restochef' ); ?></td>
				<td><span class="theme-dashboard-badge theme-badge-tertiary"><i class="dashicons dashicons-no-alt"></i></span></td>
				<td><span class="theme-dashboard-badge theme-badge-primary"><i class="dashicons dashicons-saved"></i></span></td>
			</tr>
			<tr>
				<td><?php esc_html_e( 'Maintenance mode', 'restochef' ); ?></td>
				<td><span class="theme-dashboard-badge theme-badge-tertiary"><i class="dashicons dashicons-no-alt"></i></span></td>
				<td><span class="theme-dashboard-badge theme-badge-primary"><i class="dashicons dashicons-saved"></i></span></td>
			</tr>
			<tr>
				<td><?php esc_html_e( 'Hooks system', 'restochef' ); ?></td>
				<td><span class="theme-dashboard-badge theme-badge-tertiary"><i class="dashicons dashicons-no-alt"></i></span></td>
				<td><span class="theme-dashboard-badge theme-badge-primary"><i class="dashicons dashicons-saved"></i></span></td>
			</tr>
            <tr>
                <td><?php esc_html_e( 'Translations Ready', 'restochef' ); ?></td>
                <td><span class="theme-dashboard-badge theme-badge-primary"><i class="dashicons dashicons-saved"></i></span></td>
                <td><span class="theme-dashboard-badge theme-badge-primary"><i class="dashicons dashicons-saved"></i></span></td>
            </tr>
            <tr>
                <td><?php esc_html_e( 'SEO Optimized', 'restochef' ); ?></td>
                <td><span class="theme-dashboard-badge theme-badge-primary"><i class="dashicons dashicons-saved"></i></span></td>
                <td><span class="theme-dashboard-badge theme-badge-primary"><i class="dashicons dashicons-saved"></i></span></td>
            </tr>
            <tr>
                <td><?php esc_html_e( 'RTL Compatibility', 'restochef' ); ?></td>
                <td><span class="theme-dashboard-badge theme-badge-primary"><i class="dashicons dashicons-saved"></i></span></td>
                <td><span class="theme-dashboard-badge theme-badge-primary"><i class="dashicons dashicons-saved"></i></span></td>
            </tr>
            <tr>
                <td><?php esc_html_e( 'WooCommerce Compatibility', 'restochef' ); ?></td>
                <td><span class="theme-dashboard-badge theme-badge-primary"><i class="dashicons dashicons-saved"></i></span></td>
                <td><span class="theme-dashboard-badge theme-badge-primary"><i class="dashicons dashicons-saved"></i></span></td>
            </tr>
            <tr>
                <td><?php esc_html_e( 'Breadcrumbs Module', 'restochef' ); ?></td>
                <td><span class="theme-dashboard-badge theme-badge-tertiary"><i class="dashicons dashicons-no-alt"></i></span></td>
                <td><span class="theme-dashboard-badge theme-badge-primary"><i class="dashicons dashicons-saved"></i></span></td>
            </tr>
            <tr>
                <td><?php esc_html_e( 'Gutenberg Compatibility', 'restochef' ); ?></td>
                <td><span class="theme-dashboard-badge theme-badge-primary"><i class="dashicons dashicons-saved"></i></span></td>
                <td><span class="theme-dashboard-badge theme-badge-primary"><i class="dashicons dashicons-saved"></i></span></td>
            </tr>
            <tr>
                <td><?php esc_html_e( 'Footer Widgets Section', 'restochef' ); ?></td>
                <td><span class="theme-dashboard-badge theme-badge-primary"><i class="dashicons dashicons-saved"></i></span></td>
                <td><span class="theme-dashboard-badge theme-badge-primary"><i class="dashicons dashicons-saved"></i></span></td>
            </tr>
            <tr>
                <td><?php esc_html_e( 'Display Related Posts', 'restochef' ); ?></td>
                <td><span class="theme-dashboard-badge theme-badge-primary"><i class="dashicons dashicons-saved"></i></span></td>
                <td><span class="theme-dashboard-badge theme-badge-primary"><i class="dashicons dashicons-saved"></i></span></td>
            </tr>
			<tr>
				<td><?php esc_html_e( 'Support', 'restochef' ); ?></td>
				<td><span class="theme-dashboard-badge">Normal Support</span></td>
				<td><span class="theme-dashboard-badge">Dedicated Priority Support</span></td>
			</tr>
		</tbody>
	</table>

	<div class="theme-admin-separator"></div>

	<h4>
		<a href="https://www.themeinwp.com/theme/restochef-pro/#compare-all-features" target="_blank">
			<?php esc_html_e( 'How Restochef and Restochef Pro are different from each other - here\'s the complete list.', 'restochef' ); ?>
		</a>
	</h4>

	<div class="theme-admin-separator"></div>

    <div class="theme-admin-button-wrap">
		<a href="https://www.themeinwp.com/theme/restochef-pro/" class="button theme-admin-button admin-button-primary">
			<?php esc_html_e( 'Get Restochef Pro Today', 'restochef' ); ?>
		</a>
    </div>
	<?php
	return ob_get_clean();
}

/**
 * Theme Dashboard Settings
 *
 * @param array $settings The settings.
 */
function restochef_dashboard_settings( $settings ) {

	// Starter.

	// Hero.
	$settings['hero_title']       = esc_html__( 'Welcome to Restochef', 'restochef' );
	$settings['hero_themes_desc'] = esc_html__( 'Your installation of Restochef is complete and ready for use. We\'ve prepared a unique onboarding process through our Getting started page. It helps you get started and configure your upcoming website with ease. Let\'s make it shine!', 'restochef' );
	$settings['hero_desc']        = esc_html__( 'Restochef is now installed and ready to go. To help you with the next step, we\'ve gathered together on this page all the resources you might need. We hope you enjoy using Restochef.', 'restochef' );
	$settings['hero_image']       = get_template_directory_uri() . '/inc/admin/dashboard/images/welcome-banner.png';

	// Tabs.
	$settings['tabs'] = array(
		array(
			'name'    => esc_html__( 'Theme Features', 'restochef' ),
			'type'    => 'features',
			'visible' => array( 'free', 'pro' ),
			'data' => array(
                array(
                    'name' => esc_html__('Add Background Image', 'restochef'),
                    'type' => 'free',
                    'customize_uri' => admin_url('/customize.php?autofocus[section]=background_image'),
                ),
                array(
                    'name' => esc_html__('Add Widgets', 'restochef'),
                    'type' => 'free',
                    'customize_uri' => admin_url('/customize.php?autofocus[panel]=widgets'),
                ),
                array(
                    'name' => esc_html__('Change Site Title or Logo', 'restochef'),
                    'type' => 'free',
                    'customize_uri' => admin_url('/customize.php?autofocus[section]=title_tagline'),
                ),
                array(
                    'name' => esc_html__('Topbar Options', 'restochef'),
                    'type' => 'free',
                    'customize_uri' => admin_url('/customize.php?autofocus[section]=topbar_options'),
                ),
                array(
                    'name' => esc_html__('Header Options', 'restochef'),
                    'type' => 'free',
                    'customize_uri' => admin_url('/customize.php?autofocus[section]=header_options'),
                ),
                array(
                    'name' => esc_html__('Progressbar Options', 'restochef'),
                    'type' => 'free',
                    'customize_uri' => admin_url('/customize.php?autofocus[section]=progressbar_options'),
                ),
                array(
                    'name' => esc_html__('Color Options', 'restochef'),
                    'type' => 'free',
                    'customize_uri' => admin_url('/customize.php?autofocus[section]=colors'),
                ),
                array(
                    'name' => esc_html__('Archive Options', 'restochef'),
                    'type' => 'free',
                    'customize_uri' => admin_url('/customize.php?autofocus[section]=archive_options'),
                ),
                array(
                    'name' => esc_html__('Single Options', 'restochef'),
                    'type' => 'free',
                    'customize_uri' => admin_url('/customize.php?autofocus[section]=single_options'),
                ),
                array(
                    'name' => esc_html__('Pagination Options', 'restochef'),
                    'type' => 'free',
                    'customize_uri' => admin_url('/customize.php?autofocus[section]=pagination_options'),
                ),
                array(
                    'name' => esc_html__('Footer Options', 'restochef'),
                    'type' => 'free',
                    'customize_uri' => admin_url('/customize.php?autofocus[section]=footer_options'),
                ),
                array(
                    'name' => esc_html__('Read Time Options', 'restochef'),
                    'type' => 'free',
                    'customize_uri' => admin_url('/customize.php?autofocus[section]=read_time_options'),
                ),
                array(
                    'name' => esc_html__('Dark/Light Mode Options', 'restochef'),
                    'type' => 'free',
                    'customize_uri' => admin_url('/customize.php?autofocus[section]=dark_mode_options'),
                ),
                array(
                    'name' => esc_html__('Preloader Options', 'restochef'),
                    'type' => 'free',
                    'customize_uri' => admin_url('/customize.php?autofocus[section]=preloader_options'),
                ),
            ),
		),
		array(
			'name'    => esc_html__( 'Free vs PRO', 'restochef' ),
			'type'    => 'html',
			'visible' => array( 'free' ),
			'data'    => restochef_free_vs_pro_html(),
		),
		array(
			'name'    => esc_html__( 'Performance optimization tools', 'restochef' ),
			'type'    => 'performance',
			'visible' => array( 'free', 'pro' ),
		),
	);
	
	$settings['tabs'][0]['data'] = array_merge( $settings['tabs'][0]['data'], array(
		array(
			'name'          => esc_html__( 'Typography Option', 'restochef' ),
			'type'          => 'pro',
			'customize_uri' => '/wp-admin/customize.php?autofocus[section]=typography_options',
		),
        array(
            'name'          => esc_html__( 'Remove Footer credits', 'restochef' ),
            'type'          => 'pro',
            'customize_uri' => admin_url( '/customize.php?autofocus[section]=footer_options' ),
        ),
		array(
			'name'          => esc_html__( 'Extra Widget Area', 'restochef' ),
			'type'          => 'pro',
            'customize_uri' => admin_url('/customize.php?autofocus[panel]=widgets'),
		),
		array(
			'name'          => esc_html__( 'Google Maps', 'restochef' ),
			'type'          => 'pro',
			'customize_uri' => '/wp-admin/customize.php?autofocus[section]=restochef_pro_maps',
		),
        array(
            'name'          => esc_html__( 'Instagram Module', 'restochef' ),
            'type'          => 'pro',
            'customize_uri' => '/wp-admin/options-general.php?page=premiumkits_connect',
            'text'			=> __( 'Display the Instagram feed in your website', 'restochef' ) . '<div><a target="_blank" href="https://docs.themeinwp.com/docs/premiumkits/social-integrations/instagram-integration/">' . __( 'Documentation article', 'restochef' ) . '</a></div>',
        ),
        array(
            'name'          => esc_html__( 'Twitter Module', 'restochef' ),
            'type'          => 'pro',
            'customize_uri' => '/wp-admin/options-general.php?page=premiumkits_connect&tab=twitter',
            'text'			=> __( 'Display the Twitter feed in your website', 'restochef' ) . '<div><a target="_blank" href="https://docs.themeinwp.com/docs/premiumkits/social-integrations/twitter-integration/">' . __( 'Documentation article', 'restochef' ) . '</a></div>',
        ),
        array(
            'name'          => esc_html__( 'Table of Contents', 'restochef' ),
            'type'          => 'pro',
            'customize_uri' => '/wp-admin/options-general.php?page=premiumkits_table_of_contents',
            'text'			=> __( 'Display table of contents automatically on single post based on the headings tags.', 'restochef' ) . '<div><a target="_blank" href="https://docs.themeinwp.com/docs/premiumkits/content-presentation/table-of-contents/">' . __( 'Documentation article', 'restochef' ) . '</a></div>',
        ),
        array(
            'name'          => esc_html__( 'Share Buttons', 'restochef' ),
            'type'          => 'pro',
            'customize_uri' => '/wp-admin/options-general.php?page=premiumkits_share_buttons',
            'text'			=> __( 'Allow visitors to share your content via email and social media.', 'restochef' ) . '<div><a target="_blank" href="https://docs.themeinwp.com/docs/premiumkits/social-integrations/share-buttons/">' . __( 'Documentation article', 'restochef' ) . '</a></div>',
        ),
        array(
            'name'          => esc_html__( 'Maintenance mode', 'restochef' ),
            'type'          => 'pro',
            'customize_uri' => '/wp-admin/options-general.php?page=premiumkits_coming_soon',
            'text'			=> __( 'Display a user-friendly coming soon notice to visitors ', 'restochef' ) . '<div><a target="_blank" href="https://docs.themeinwp.com/docs/premiumkits/utilities/coming-soon/">' . __( 'Documentation article', 'restochef' ) . '</a></div>',
        ),
	) );

	// Documentation.
	$settings['documentation_link'] = 'https://docs.themeinwp.com/docs/restochef/';

	// Promo.
	$settings['promo_title']  = esc_html__( 'Upgrade to Pro', 'restochef' );
	$settings['promo_desc']   = esc_html__( 'Take Restochef to a whole other level by upgrading to the Pro version.', 'restochef' );
	$settings['promo_button'] = esc_html__( 'Discover Restochef Pro', 'restochef' );
	$settings['promo_link']   = 'https://themeinwp.com/theme/restochef-pro';

	// Review.
	$settings['review_link']       = 'https://wordpress.org/support/theme/restochef/reviews/';
	$settings['suggest_idea_link'] = 'https://www.themeinwp.com/contact-us/';

	// Support.
	$settings['support_link']     = 'https://wordpress.org/support/theme/restochef/';
	$settings['support_pro_link'] = 'https://www.themeinwp.com/support/';

	// Community.
	$settings['community_link'] = 'https://www.facebook.com/themeinwp/';

	$theme = wp_get_theme();
	// Changelog.
	$settings['changelog_version'] = $theme->version;
	$settings['changelog_link']    = 'https://themeinwp.com/changelog/restochef/';

	return $settings;
}
add_filter( 'thd_register_settings', 'restochef_dashboard_settings' );