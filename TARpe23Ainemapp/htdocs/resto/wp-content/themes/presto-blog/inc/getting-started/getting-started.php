<?php 
/**
 * Getting Started
 * 
 * @package Presto_Blog
 */

if( ! function_exists( 'presto_blog_theme_page' ) ):
function presto_blog_theme_page() {
    add_theme_page( __( 'Getting Started','presto-blog' ), __( 'Getting Started','presto-blog' ), 'manage_options', 'presto-blog-theme-options', 'presto_blog_getting_started_page' );
}
endif;
add_action( 'admin_menu', 'presto_blog_theme_page' );

if( ! function_exists( 'presto_blog_getting_started_page' ) ) :
function presto_blog_getting_started_page() { ?>
    <div class="st-gs-outer-wrapper">
		<div class="st-gs-inner-wrapper">
			<div class="st-gs-header">
				<div class="st-gs-header-logo">
					<?php echo presto_blog_svg_collection( 'sublime' ); ?>					
				</div>
				<p class="st-gs-subtitle"><?php esc_html_e( 'Simple, Easy, and Fast WordPress Theme.','presto-blog' ); ?></p>
			</div>
			<div class="st-gs-tab-holder">
				<ul>
					<li>
						<button class="st-gs-tab gs-dashboard active"><?php esc_html_e( 'Dashboard','presto-blog' ); ?></button>
					</li>
					<li>
						<button class="st-gs-tab gs-recommended-plugins"><?php esc_html_e( 'Recommended Plugins','presto-blog' ); ?></button>
					</li>
                    <li>
						<button class="st-gs-tab gs-free-vs-pro"><?php esc_html_e( 'Free vs Pro', 'presto-blog' ); ?></button>
					</li>
				</ul>
			</div>
			<div class="st-gs-main">
				<div class="st-gs-tab-content-holder">
                    <?php 
                        require get_template_directory() . '/inc/getting-started/tabs/dashboard.php';
                        require get_template_directory() . '/inc/getting-started/tabs/recommended-plugins.php';
                        require get_template_directory() . '/inc/getting-started/tabs/free-vs-pro.php';
                    ?>
				</div>
			</div>
			<div class="st-gs-aside">
                <?php require get_template_directory() . '/inc/getting-started/tabs/knowledge.php'; ?>
			</div>
		</div>
	</div><!-- .st-gs-outer-wrapper -->
    <?php 
}
endif;

if( ! function_exists( 'presto_blog_getting_started_scripts' ) ) :
/**
 * Load Getting Started styles in the admin
 */
function presto_blog_getting_started_scripts( $hook ){
    // Load styles only on our page
    if( 'appearance_page_presto-blog-theme-options' != $hook ) return;

    wp_enqueue_style( 'presto-blog-getting-started', get_template_directory_uri() . '/inc/getting-started/css/getting-started.css', false, PRESTO_BLOG_VERSION );

    wp_enqueue_script( 'presto-blog-getting-started', get_template_directory_uri() . '/inc/getting-started/js/getting-started.js', array( 'jquery' ), PRESTO_BLOG_VERSION, true );

    wp_enqueue_script( 'presto-blog-recommended-plugin-install', get_template_directory_uri() . '/inc/getting-started/js/recommended-plugin-install.js', array( 'jquery','plugin-install','wp-util','updates' ), PRESTO_BLOG_VERSION, true );    
    $localize = array(
        'ajaxUrl'              => admin_url( 'admin-ajax.php' ),
        'ActivatingText'       => __( 'Activating', 'presto-blog' ),
        'DeactivatingText'     => __( 'Deactivating', 'presto-blog' ),
        'PluginActivateText'   => __( 'Activate', 'presto-blog' ),
        'PluginDeactivateText' => __( 'Deactivate', 'presto-blog' ),
        'SettingsText'         => __( 'Settings', 'presto-blog' ),
    );  
    wp_localize_script( 'presto-blog-recommended-plugin-install', 'presto_blog_page', $localize );
}
endif;
add_action( 'admin_enqueue_scripts', 'presto_blog_getting_started_scripts' );

if( ! function_exists( 'presto_blog_call_plugin_api' ) ) :
/**
 * Plugin API
**/
function presto_blog_call_plugin_api( $plugin ) {
    include_once ABSPATH . 'wp-admin/includes/plugin-install.php';
    $call_api = plugins_api( 
        'plugin_information', 
            array(
            'slug'   => $plugin,
            'fields' => array(
                'downloaded'        => false,
                'rating'            => false,
                'description'       => false,
                'short_description' => true,
                'donate_link'       => false,
                'tags'              => false,
                'sections'          => true,
                'homepage'          => true,
                'added'             => false,
                'last_updated'      => false,
                'compatibility'     => false,
                'tested'            => false,
                'requires'          => false,
                'downloadlink'      => false,
                'icons'             => true
            )
        ) 
    );
    return $call_api;
}
endif;

if( ! function_exists( 'presto_blog_required_plugin_activate' ) ) :
/**
 * Required Plugin Activate
 */
function presto_blog_required_plugin_activate() {

	if ( ! current_user_can( 'install_plugins' ) || ! isset( $_POST['init'] ) || ! $_POST['init'] ) {
		wp_send_json_error(
			array(
				'success' => false,
				'message' => __( 'No plugin specified', 'presto-blog' ),
			)
		);
	}

	$plugin_init = ( isset( $_POST['init'] ) ) ? esc_attr( $_POST['init'] ) : '';

	$activate = activate_plugin( $plugin_init, '', false, true );

	if ( is_wp_error( $activate ) ) {
		wp_send_json_error(
			array(
				'success' => false,
				'message' => $activate->get_error_message(),
			)
		);
	}

	wp_send_json_success(
		array(
			'success' => true,
			'message' => __( 'Plugin Successfully Activated', 'presto-blog' ),
		)
	);

}
endif;
add_action('wp_ajax_gs-sites-plugin-activate', 'presto_blog_required_plugin_activate');
add_action('wp_ajax_nopriv_gs-sites-plugin-activate', 'presto_blog_required_plugin_activate');
	
if( ! function_exists( 'presto_blog_required_plugin_deactivate' ) ) :
/**
 * Required Plugin Activate
 */
function presto_blog_required_plugin_deactivate() {
	
    if ( ! current_user_can( 'install_plugins' ) || ! isset( $_POST['init'] ) || ! $_POST['init'] ) {
        wp_send_json_error(
            array(
                'success' => false,
                'message' => __( 'No plugin specified', 'presto-blog' ),
            )
        );
    }

    $plugin_init = ( isset( $_POST['init'] ) ) ? esc_attr( $_POST['init'] ) : '';

    $deactivate = deactivate_plugins( $plugin_init, '', false );

    if ( is_wp_error( $deactivate ) ) {
        wp_send_json_error(
            array(
                'success' => false,
                'message' => $deactivate->get_error_message(),
            )
        );
    }

    wp_send_json_success(
        array(
            'success' => true,
            'message' => __( 'Plugin Successfully Deactivated', 'presto-blog' ),
        )
    );

}
endif;
add_action('wp_ajax_gs-sites-plugin-deactivate', 'presto_blog_required_plugin_deactivate');
add_action('wp_ajax_nopriv_gs-sites-plugin-deactivate', 'presto_blog_required_plugin_deactivate');
	
if( ! function_exists( 'presto_blog_check_for_icon' ) ) :
/**
 * Check For Icon 
**/
function presto_blog_check_for_icon( $arr ) {
    if( ! empty( $arr['svg'] ) ){
        $plugin_icon_url = $arr['svg'];
    }elseif( ! empty( $arr['2x'] ) ){
        $plugin_icon_url = $arr['2x'];
    }elseif( ! empty( $arr['1x'] ) ){
        $plugin_icon_url = $arr['1x'];
    }else{
        $plugin_icon_url = $arr['default'];
    }                               
    return $plugin_icon_url;
}
endif;