<?php
/**
 * Restochef Notice Handler
 *
 * @package Restochef
 * @since Restochef 1.0.0
 */

defined('ABSPATH') || exit;

/**
 * Enqueue getting started styles and scripts
 */
add_action('admin_enqueue_scripts', 'restochef_widgets_backend_enqueue');
function restochef_widgets_backend_enqueue()
{
    wp_register_script('restochef-custom-widgets', get_template_directory_uri() . '/inc/admin/dashboard/js/theme-notice.js', array('jquery'), true);
    $translation = array(
        'btn_text' => esc_html__('Processing...', 'restochef'),
        'nonce' => wp_create_nonce('restochef_demo_import_nonce'),
        'noncen' => 'restochef_demo_import_nonce',
        'adminurl' => esc_url(admin_url()),
    );
    wp_localize_script('restochef-custom-widgets', 'restochef_adi_install', $translation);
    wp_enqueue_media();
    wp_enqueue_script('restochef-custom-widgets');
}

/**
 * Class to handle notices and Advanced Demo Import
 *
 * Class Restochef_Notice_Handler
 */
class Restochef_Notice_Handler
{

    public static $nonce;
    public $theme_name;
    public $upgrade_url;
    public $demo_url;

    /**
     * Empty Constructor
     */
    public function __construct()
    {
        $theme = wp_get_theme();
        global $pagenow;
        /* activation notice */
        $this->theme_name = esc_attr($theme->get('Name'));
        $this->upgrade_url = 'https://themeinwp.com/theme/restochef-pro';
        $this->demo_url = 'https://live-demo.themeinwp.net/restochef';
        add_action('switch_theme', array($this, 'flush_dismiss_status'));
        add_action('admin_init', array($this, 'getting_started_notice_dismissed'));
        if ('index.php' === $pagenow || 'plugins.php' === $pagenow) {
            if (isset($_GET['page']) && $_GET['page'] == 'theme-dashboard') {
                return;
            }
            add_action('admin_notices', array($this, 'restochef_theme_info_welcome_admin_notice'), 3);
        }
        add_action('wp_ajax_restochef_getting_started', array($this, 'restochef_getting_started'));
    }

    /**
     * Display an admin notice linking to the about page
     */
    public function restochef_theme_info_welcome_admin_notice()
    {
        if (is_admin() && !get_user_meta(get_current_user_id(), 'gs_notice_dismissed')) {
            echo '<div class="notice notice-success restochef-notice is-dismissible getting-started">';
            if (is_plugin_active('mailchimp-for-wp/mailchimp-for-wp.php')) {
                echo('<div class="fs-notice success"><p>' . esc_html__('Plugins added successfully. You may dismiss this notice now.', 'restochef') . '</p></div>');
            } else { ?>
                <p class="notice-text">
                    <?php
                    $current_user = wp_get_current_user();

                    printf(
                    /* Translators: %1$s current user display name., %2$s this theme name., %3$s discount coupon code., %4$s discount percentage. */
                        esc_html__(
                            'Howdy, %1$s! Greetings and welcome to the world of %2$s!  We are so grateful that you have chosen our theme to enhance your website experience. Allow us to be your guide as you embark on a journey towards a beautifully designed and fully optimized website. Start now and see the magic unfold! ',
                            'restochef'
                        ),
                        '<strong>' . esc_html( $current_user->display_name ) . '</strong>',
                        '<strong>' . esc_html( $this->theme_name ) . '</strong>'
                    );
                    ?>
                </p>

                <div class="theme-admin-button-wrap theme-admin-button-group">
                    <a href="<?php echo esc_url($this->upgrade_url);?>" target="_blank" class="button button-primary theme-admin-button admin-button-secondary">
                        <span class="dashicons dashicons-thumbs-up"></span>
                        <span><?php echo esc_html__('Upgrade to Pro', 'restochef');?></span>
                    </a>
                    <a href="<?php echo admin_url('themes.php?page=theme-dashboard'); ?>" class="button theme-admin-button admin-button-primary">
                        <span class="dashicons dashicons-awards"></span>
                        <span><?php echo sprintf(esc_html__('Get started with %s', 'restochef'), $this->theme_name); ?></span>
                    </a>
                    <a href="#" class="restochef-install-plugins button theme-admin-button admin-button-primary">
                        <span class="dashicons dashicons-admin-plugins"></span>
                        <span><?php echo esc_html__('Install and activate the recommended plugins', 'restochef'); ?></span>
                    </a>
                    <a href="<?php echo esc_url($this->demo_url);?>" target="_blank" class="button theme-admin-button admin-button-secondary">
                        <span class="dashicons dashicons-welcome-view-site"></span>
                        <span><?php echo esc_html__('View Demo', 'restochef');?></span>
                    </a>
                </div>
            
            <?php }
            echo '<a href="' . esc_url(wp_nonce_url(add_query_arg('gs-notice-dismissed', 'dismiss_admin_notices'))) . '" class="getting-started-notice-dismiss">Dismiss</a>';
            echo '</div>';
        }
    }

    /**
     * Register dismissal of the getting started notification.
     * Acts on the dismiss link.
     * If clicked, the admin notice disappears and will no longer be visible to this user.
     */
    public function getting_started_notice_dismissed()
    {

        if (isset($_GET['gs-notice-dismissed'])) {
            add_user_meta(get_current_user_id(), 'gs_notice_dismissed', 'true');
        }
    }

    /**
     * Deletes the getting started notice's dismiss status upon theme switch.
     */
    public function flush_dismiss_status()
    {
        delete_user_meta(get_current_user_id(), 'gs_notice_dismissed', 'true');
    }

    /**
     * Get Started Notice
     * Active callback of wp_ajax
     * return void
     */
    public function restochef_getting_started()
    {

        check_ajax_referer('restochef_demo_import_nonce', 'security');

        $slug = $_POST['slug'];
        $plugin = $slug . '/' . $slug . '.php';
        if (isset($_POST['main_file'])) {
            $plugin = $slug . '/' . $_POST['main_file'] . '.php';
        }
        $request = $_POST['request'];


        $status = array(
            'install' => 'plugin',
            'slug' => sanitize_key(wp_unslash($slug)),
        );
        $status['redirect'] = admin_url('/themes.php?page=demo-import-kit&browse=all&at-gsm-hide-notice=welcome');

        if (is_plugin_active_for_network($plugin) || is_plugin_active($plugin)) {
            // Plugin is activated
            wp_send_json_success($status);
        }


        if (!current_user_can('install_plugins')) {
            $status['errorMessage'] = __('Sorry, you are not allowed to install plugins on this site.', 'restochef');
            wp_send_json_error($status);
        }

        if ($request > 7) {
            wp_send_json_error();
        }

        include_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';
        include_once ABSPATH . 'wp-admin/includes/plugin-install.php';

        // Looks like a plugin is installed, but not active.
        if ($request == 1 && strpos($slug, 'demo-import-kit') === false) {
            wp_send_json_error();
        }
        if ($request == 2 && strpos($slug, 'themeinwp-import-companion') === false) {
            wp_send_json_error();
        }
        if (file_exists(WP_PLUGIN_DIR . '/' . $slug)) {
            $plugin_data = get_plugin_data(WP_PLUGIN_DIR . '/' . $plugin);
            $status['plugin'] = $plugin;
            $status['pluginName'] = $plugin_data['Name'];

            if (current_user_can('activate_plugin', $plugin) && is_plugin_inactive($plugin)) {
                $result = activate_plugin($plugin);

                if (is_wp_error($result)) {
                    $status['errorCode'] = $result->get_error_code();
                    $status['errorMessage'] = $result->get_error_message();
                    wp_send_json_error($status);
                }

                wp_send_json_success($status);
            }
        }

        $api = plugins_api(
            'plugin_information',
            array(
                'slug' => sanitize_key(wp_unslash($slug)),
                'fields' => array(
                    'sections' => false,
                ),
            )
        );

        if (is_wp_error($api)) {
            $status['errorMessage'] = $api->get_error_message();
            wp_send_json_error($status);
        }

        $status['pluginName'] = $api->name;

        $skin = new WP_Ajax_Upgrader_Skin();
        $upgrader = new Plugin_Upgrader($skin);
        $result = $upgrader->install($api->download_link);

        if (defined('WP_DEBUG') && WP_DEBUG) {
            $status['debug'] = $skin->get_upgrade_messages();
        }

        if (is_wp_error($result)) {
            $status['errorCode'] = $result->get_error_code();
            $status['errorMessage'] = $result->get_error_message();
            wp_send_json_error($status);
        } elseif (is_wp_error($skin->result)) {
            $status['errorCode'] = $skin->result->get_error_code();
            $status['errorMessage'] = $skin->result->get_error_message();
            wp_send_json_error($status);
        } elseif ($skin->get_errors()->get_error_code()) {
            $status['errorMessage'] = $skin->get_error_messages();
            wp_send_json_error($status);
        } elseif (is_null($result)) {
            require_once(ABSPATH . 'wp-admin/includes/file.php');
            WP_Filesystem();
            global $wp_filesystem;

            $status['errorCode'] = 'unable_to_connect_to_filesystem';
            $status['errorMessage'] = __('Unable to connect to the filesystem. Please confirm your credentials.', 'restochef');

            // Pass through the error from WP_Filesystem if one was raised.
            if ($wp_filesystem instanceof WP_Filesystem_Base && is_wp_error($wp_filesystem->errors) && $wp_filesystem->errors->get_error_code()) {
                $status['errorMessage'] = esc_html($wp_filesystem->errors->get_error_message());
            }

            wp_send_json_error($status);
        }

        $install_status = install_plugin_install_status($api);

        if (current_user_can('activate_plugin', $install_status['file']) && is_plugin_inactive($install_status['file'])) {
            $result = activate_plugin($install_status['file']);

            if (is_wp_error($result)) {
                $status['errorCode'] = $result->get_error_code();
                $status['errorMessage'] = $result->get_error_message();
                wp_send_json_error($status);
            }
        }

        wp_send_json_success($status);
    }
}

new Restochef_Notice_Handler;